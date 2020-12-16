{{-- @if(session('session_position') != 'Secretary')
    <script type="text/javascript">location.href='{{route("Login")}}'</script>
@endif --}}

@extends('global.main')


@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@endsection


@section('content')
<div class="content" id="content">
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Health Services</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Adolescent</a></li>
	</ol>

	<h1 class="page-header">Adolescent <small>DILG Requirements</small></h1>
	{{-- nav pills --}}
	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active">
				<span class="d-sm-block d-none">Adolescent with no Record</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >
				<span class="d-sm-block d-none">Adolescent with Record</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" id="btnExport">

				<span class="d-sm-block d-none">Export</span>
			</a>
		</li>
	</ul>

	<div class="tab-content">
				{{-- Adolescent --}}
		<div class="tab-pane fade active show" id="nav-pills-tab-1">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Tag as Adolescent</h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<div class="panel-body">
					<table id="tbl_adolescent_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($adolescentResident as $row)
							<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<button type="button" class="btn btn-lime m-r-5 m-b-5" id="btnAdolescent"  data-toggle="modal" data-target="#modal-addAdolescent">
										<i class="fas fa-lg fa-fw m-r-10 fa-tag"></i>Add Adolescent Record
									</button>
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="tab-pane fade " id="nav-pills-tab-2">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Tag as Adolescent</h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<div class="panel-body">
					<table id="tbl_elderly_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($adolescent as $row)
							<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<button type="button" class="btn btn-success m-r-5 m-b-5" id="btnAdolescent"  data-toggle="modal" data-target="#modal-addAdolescent">
										<i class="fas fa-lg fa-fw m-r-10 fa-tag"></i>Updat Adolescent 
									</button>
								</td>
							</tr>
							@endforeach
							
							
						</tbody>
					</table>
				</div>
			</div>
		</div>

		{{-- addAdolescent modal --}}
		<div class="modal fade" id="modal-addAdolescent" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header"  style="background: #90CA4B" >
						<h4 class="modal-title" style="color: #fff">Adolescent </h4>
						<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
					</div>
					<div class="modal-body">
						<h3><b><label id="txt_resname">Resident:</label></b></h3>
						<input type="text" id="txt_resid" hidden>
						<input type="text" id="txt_date_birth" hidden>
						
						<br>
						<div class="col-md-10">
							<label>Date of Visit</label>
							<input type="date" class="form-control" style="width: 250px;" id="txt_date_visit" />
						</div>
						<br>
						<div class="col-md-10">
							<div class="checkbox checkbox-css">
								{{-- <input type="checkbox" id="chkMMRTD"  unchecked onchange="checkMMRTD(this)" value="0"> --}}
								<input type="checkbox" id="chkMMRTD"  unchecked value="0">
								<label for="chkMMRTD">Nabigyan ng MMR-TD ?</label>
							</div> <input type="text" id="txt_chkMMRTD" value="0" hidden>
						</div>
						<div class="col-md-10"  id="divMMRTDtrue" style="display: block;">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="chk_isRefer"  unchecked onchange="checkisRefer(this)" value="0" >
								<label for="chk_isRefer">Nirefer sa Health Center ?</label>
							</div> <input type="text" id="txt_chk_isRefer" value="0" hidden>
							<br>
							<label>MMR-TD Date</label>
							<input type="date" class="form-control" style="width: 250px;" id="txt_mmrtd_date"  />
						</div>
						<br>
						<div class="col-md-10">
							<label>Civil Status</label>
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="chk_cs_diabetic"  unchecked onchange="checkCSDiabetic(this)" value="0" >
								<label for="chk_cs_diabetic">Diabetic</label>
							</div> <input type="text" id="txt_chk_cs_diabetic" value="0" hidden>
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="chk_cs_matass_presyon"  unchecked onchange="checkMataasPresyon(this)" value="0" >
								<label for="chk_cs_matass_presyon">Mataas na Presyon</label>
							</div> <input type="text" id="txt_chk_cs_matass_presyon" value="0" hidden>
							
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="chk_cs_cancer"  unchecked onchange="checkCancer(this)" value="0" >
								<label for="chk_cs_cancer">Cancer</label>
							</div> <input type="text" id="txt_chk_cs_cancer" value="0" hidden>
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="chk_bukol"  unchecked onchange="checkBukol(this)" value="0" >
								<label for="chk_bukol">Bukol sa Katawan</label>
							</div> <input type="text" id="txt_chk_bukol" value="0" hidden>
						</div>
						<br>
						<div class="col-md-10">
							<label>Remarks</label>
							<input type="text" class="form-control" id="txtarea_remarks"/>
						</div>
						<legend class="m-t-10"></legend>
						<div align="right">
							<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
							<button  onclick ="addAdolescent()" class="btn btn-lime m-r-9" style="background: #90CA4B">Add</button>
						</div>				
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('page-js')
<script>
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
			$("table[id='tbl_adolescent_lst']").DataTable();
		});

	$('#btnExport').on('click', function(){
		//swal
	   	swal({
            title: "Are you sure?",
            text: "Generate Newborn Record",
            icon: "warning",
            buttons: [true, "Yes"],
            dangerMode: true,
          })
	   	.then((willDelete) => {
            if (willDelete) {
              console.log("Printing");
              window.location.href = "{{route('AdolescentExport')}}";
            } else {
               Cancelled();
            }
        });
	});


		$('#tbl_adolescent_lst').on('click', '#btnAdolescent', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$("input[id='txt_resid']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;
		$("#txt_date_birth").val(date_birth);

		});

		//CRUD
		function addAdolescent(){
			let data = {

				'_token' : "{{ csrf_token() }}"
				, 'resident_id' : $("input[id='txt_resid']").val()
				, 'mmrtd_date' : $("input[id='txt_mmrtd_date']").val()
				, 'is_referred' : $("input[id='txt_chk_isRefer']").val()
				, 'date_of_visit' : $("input[id='txt_date_visit']").val()
				, 'remarks' : $("input[id='txtarea_remarks']").val()
				, 'cs_diabetic' : $("input[id='txt_chk_cs_diabetic']").val()
				, 'cs_mataas_presyon' : $("input[id='txt_chk_cs_matass_presyon']").val()
				, 'cs_cancer' : $("input[id='txt_chk_cs_cancer']").val()
				, 'cs_bukol' : $("input[id='txt_chk_bukol']").val()
			};

			var date_of_birth = $("input[id='txt_date_birth']").val();
			// alert($("input[id='txt_chk_cs_cancer']").val())
			$.ajax({
					url : "{{ route('CRUDAdolescent') }}",
					method : 'POST',
					data : data,

					success : function(response) {
						$('#modal-addAdolescent').modal('hide');
							swal({
								title: 'Adolescent Success',
								text: 'Succesfully Added Adolescent Information',
								icon: 'success',
							});
								window.location.reload();
							},
							error : function(error){
							}
			});

		}

		function checkMMRTD(){
			$('#divMMRTDtrue').props("hidden",false);
			if($('#chkMMRTD ').is(":checked")){
				$("#txt_chkMMRTD").val(1);
				
			}
			else{
				$("#txt_chkMMRTD").val(0);}
			}
// $("#divMMRTDtrue").hide();
		$("#chkMMRTD").change(function(){

			if($(this).is(':checked'))
			{
				$("#divMMRTDtrue").show();
			}
			else
			{
				$("#divMMRTDtrue").hide();
			}
		})	
		function Cancelled(){
		swal({
	      	title: 'Cancelled',
			text: "Cancelled Generating Certificate",
			icon:'error',
			buttons: false,
				timer: 1000,
	      });
	};

		//for checkbox
		function checkCSDiabetic(){if($('#chk_cs_diabetic').is(":checked")){$("#txt_chk_cs_diabetic").val(1);}else{$("#txt_chk_cs_diabetic ").val(0);}}
		function checkMataasPresyon(){if($('#chk_cs_matass_presyon').is(":checked")){$("#txt_chk_cs_matass_presyon").val(1);}else{$("#txt_chk_cs_matass_presyon").val(0);}}
		function checkCancer(){if($('#chk_cs_cancer').is(":checked")){$("#txt_chk_cs_cancer").val(1);}else{$("#txt_chk_cs_cancer").val(0);}}
		function checkBukol(){if($('#chk_bukol').is(":checked")){$("#txt_chk_bukol").val(1);}else{$("#txt_chk_bukol").val(0);}}
		function checkisRefer(){if($('#chk_isRefer').is(":checked")){$("#txt_chk_isRefer").val(1);}else{$("#txt_chk_isRefer").val(0);}}
		// for modal
		function hideModal(){$('#modal-addAdolescent').modal('hide');}
	</script>
	{{-- Tables --}}
	<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
	<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>
	{{--Modals--}}
	<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
	<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
	<script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>
	@endsection