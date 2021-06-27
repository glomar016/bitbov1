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
		<li class="breadcrumb-item"><a href="javascript:;">Elderly</a></li>
	</ol>

	<h1 class="page-header">Elderly <small>DILG Requirements</small></h1>
	{{-- nav pills --}}
	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active">
				<span class="d-sm-block d-none">Elderly with no Record</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >
				<span class="d-sm-block d-none">Elderly with Record</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" id="btnExport">

				<span class="d-sm-block d-none">Export</span>
			</a>
		</li>
	</ul>


	<div class="tab-content">
		<div class="tab-pane fade active show" id="nav-pills-tab-1">

			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Tag as Elderly</h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<div class="panel-body">
					<table id="tbl_resident_elderly_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($elderly as $row)
							<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<button type="button" class="btn btn-lime m-r-5 m-b-5" id="btnAddElderly" data-toggle="modal" data-target="#modal-addElderly">
										<i class="fas fa-lg fa-fw m-r-10 fa-tag"></i>Add Elderly Record
									</button>
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
			{{-- NAV PILLS TAB 2 - RECORDS --}}
		<div class="tab-pane fade " id="nav-pills-tab-2">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Tag as Elderly</h4>
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
							@foreach($elderly as $row)
							<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<button type="button" class="btn btn-sucess m-r-5 m-b-5" id="btnUpdateElderly" data-toggle="modal" data-target="#modal-addElderly">
										<i class="fas fa-lg fa-fw m-r-10 fa-tag"></i>Update Elderly Record
									</button>
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
	</div>
	{{-- addAdolescent modal --}}
		<div class="modal fade" id="modal-addElderly" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header"  style="background: #90CA4B" >
						<h4 class="modal-title" style="color: #fff">Add Elderly Record</h4>
						<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
					</div>
					<div class="modal-body">
						<h3><b><label id="txt_resname" >Resident:</label></b></h3>
						<input type="text" id="txt_resid" hidden>
						<input type="text" id="txt_date_birth" hidden>
						<div class="col-md-10">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="chk_flue_vaccine"  unchecked onchange="checkFlueVaccine(this)" value="0" >
								<label for="chk_flue_vaccine">Had Flue Vaccine?</label>
							</div> <input type="text" id="txt_chk_flue_vaccine" value="0" hidden>
						</div>
						
						<div class="col-md-10">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="chk_pneumoccocal"  unchecked onchange="checkPneumoccocal(this)" value="0" >
								<label for="chk_pneumoccocal">Had Pneumoccocal?</label>
							</div> <input type="text" id="txt_chk_pneumoccocal" value="0" hidden>							
						</div>

						<br>
						<div class="col-md-10">
							<label>Remarks</label>
							<input type="text" class="form-control" id="txtarea_remarks"/>
						</div>
						<legend class="m-t-10"></legend>
						<div align="right">
							<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
							<button  onclick = "AddElderly()" class="btn btn-lime m-r-9" style="background: #90CA4B">Add</button>
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
			$("table[id='tbl_elderly_lst']").DataTable();
			$("table[id='tbl_resident_elderly_lst']").DataTable();
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
              window.location.href = "{{route('ElderlyExport')}}";
            } else {
               Cancelled();
            }
        });
	});

	//get res_id
	$('#tbl_resident_elderly_lst').on('click', '#btnAddElderly', function(){
		let row = $(this).closest("tr"),
		name =  $(row.find("td")[0]).text();

		$("input[id='txt_resid']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;
		
	});

	$('#tbl_elderly_lst').on('click', '#btnAddElderly', function(){
		let row = $(this).closest("tr"),
		name =  $(row.find("td")[0]).text();

		$("input[id='txt_resid']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;
		
	});

	function AddElderly(){
		let data = {
			'_token' : "{{ csrf_token() }}"
			,'resident_id' : $("input[id='txt_resid']").val()
			,'had_flue_vaccine' : $("input[id='txt_chk_flue_vaccine']").val()
			,'had_pneumoccocal' : $("input[id='txt_chk_pneumoccocal']").val()
			,'remarks' : $("input[id='txtarea_remarks']").val()
		};
		// alert($("input[id='txtarea_remarks']").val())
		$.ajax({
			url : "{{ route('CRUDElderly') }}",
			method : 'POST',
			data : data,

			success : function(response) {
				$('#modal-addElderly').modal('hide');
				swal({
					title: 'Success',
					text: 'Saved Record!',
					icon: 'success',
				});
				window.location.reload();
			},
			error : function(error){
				$('#modal-addElderly').modal('hide');
				swal({
					title: 'Error',
					text: 'An Error occured!',
					icon: 'error',
				});
			}
		});
	}

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
	function checkFlueVaccine(){if($('#chk_flue_vaccine').is(":checked")){$("#txt_chk_flue_vaccine").val(1);}else{$("#txt_chk_flue_vaccine").val(0);}}
	function checkPneumoccocal(){if($('#chk_pneumoccocal').is(":checked")){$("#txt_chk_pneumoccocal").val(1);}else{$("#txt_chk_pneumoccocal").val(0);}}

	// for modal
	function hideModal(){$('#modal-addElderly').modal('hide');}
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