@extends('global.main')


@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{asset('assets/plugins/parsley/src/parsley.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="content" id="content">
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Health Services</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">PWD</a></li>
	</ol>

	<h1 class="page-header">Person with Disabilities <small>DILG Requirements</small></h1>
	{{-- nav pills --}}
	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active">
				<span class="d-sm-block d-none">Resident</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >
				<span class="d-sm-block d-none">PWD Record</span>
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
				<h4 class="panel-title">Tag as PWD</h4>
			</div>
			<div class="alert alert-yellow fade show">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span>
				</button>
				The following are the existing records of the residents within the system.
			</div>
			<div class="panel-body">
				<table id="tbl_resident_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($resident as $row)
							<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<button type="button" class="btn btn-lime m-r-5 m-b-5" id="btnAddPWDRecord"  data-toggle="modal" data-target="#modal-addPWD">
										<i class="fas fa-lg fa-fw m-r-10 fa-tag"></i>Add PWD Record
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
				<h4 class="panel-title">PWD Record</h4>
			</div>
			<div class="alert alert-yellow fade show">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span>
				</button>
				The following are the existing records of the residents within the system.
			</div>
			<div class="panel-body">
				<table id="tbl_pwd_lst" class="table table-striped table-bordered">
					<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($pwd as $row)
							<tr class="gradeC" id="{{$row->PWD_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<button type="button" class="btn btn-success m-r-5 m-b-5" id="btnUpdatePWDRecord"  data-toggle="modal" data-target="#modal-addPWD">
										<i class="fas fa-lg fa-fw m-r-10 fa-tag"></i>PWD Record
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


	{{-- addPWD modal --}}
	<div class="modal fade" id="modal-addPWD" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background: #90CA4B" id="modalHeader">
					<h4 class="modal-title" style="color: #fff">Tag Resident as PWD</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					<h3><b><label id="txt_resname" >Resident:</label></b></h3>
					<input type="text" id="txt_resid" hidden>
					{{-- <br> --}}
					<div class="col-md-10">
						<label>Disabilty</label>
						<select class="form-control" id="sel_disability" style="color: black;" onchange="SelDisability()" data-parsley-required="true" data-parsley-id="21">
							<option selected disabled value=""></option>
							<option value="Deaf">Deaf</option>
							<option value="Blind">Blind</option>
							<option value="Unable to Walk">Unable to Walk</option>
							<option value="Mental Illness">Blind</option>
							<option value="Others">Others</option>
						</select>
						<input type="text" id="txt_sel_disability" hidden>
					</div>
					<br>
					<div class="col-md-10">
						<div class="col-md-4">
							<label>Death Date</label>
							<input type="date" class="form-control" style="width: 150px;" id="txt_death_date" />
						</div>
					</div>
					<br>

					<div class="col-md-10">
						<label>Reason of Death</label>
						<input type="text" class="form-control" id="txtarea_reason" data-parsley-required="true"/>
					</div>
					<legend class="m-t-10"></legend>
					<div align="right">
						<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
						<button  onclick = "AddPWD()" class="btn btn-lime m-r-9" id="btnPWD" style="background: #90CA4B">Tag</button>
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
		Highlight.init();
		$("table[id='tbl_resident_lst']").DataTable();
		$("table[id='tbl_pwd_lst']").DataTable();
		// 
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
              window.location.href = "{{route('PWDExport')}}";
            } else {
               Cancelled();
            }
        });
	});

	//resident table
	$('#tbl_resident_lst').on('click', '#btnAddPWDRecord', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$("input[id='txt_resid']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;

		//modal,button UI change
		$('#modal-newBornRecord').modal('show');
		$('#btnPWD').css({ 'background' : '#90CA4B'});
		$('#btnPWD').attr('class', 'btn btn-lime m-r-9');
		$('#btnPWD').text('Add');
		$('#modalHeader').css({ 'background' : '#90CA4B'});
	});

	$('#tbl_pwd_lst').on('click', '#btnUpdatePWDRecord', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$("input[id='txt_resid']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;

		//modal,button UI change
		$('#btnPWD').css({ 'background' : '#008A8A'});
		$('#btnPWD').attr('class', 'btn btn-success m-r-9');
		$('#btnPWD').text('Update');
		$('#modalHeader').css({ 'background' : '#008A8A'});
	});

	//CRUD
	function AddPWD(){
		let data = {
			'_token' : "{{ csrf_token() }}"
			,'resident_id' : $("input[id='txt_resid']").val()
			,'disability' : $("input[id='txt_sel_disability']").val()
			,'date_of_death' : $("input[id='txt_death_date']").val()
			,'reason_of_death' : $("input[id='txtarea_reason']").val()
		};

		$.ajax({
			url : "{{ route('CRUDPWD') }}",
			method : 'POST',
			data : data,

			success : function(response) {
				$('#modal-addPWD').modal('hide');
				swal({
					title: 'PWD Success',
					text: 'Succesfully Added PWD Information',
					icon: 'success',
				});
				window.location.reload();
			},
			error : function(error){
				$('#modal-addPWD').modal('hide');
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

	//for modal
	function hideModal(){$('#modal-addPWD').modal('hide');}
	//for select
	function SelDisability(){var disability = document.getElementById('sel_disability').value;$("#txt_sel_disability").val(disability);}
</script>

<script src="{{asset('assets/plugins/parsley/dist/parsley.js')}}"></script>
<script src="{{asset('assets/plugins/highlight/highlight.common.js')}}"></script>
	<script src="{{asset('assets/js/demo/render.highlight.js')}}"></script>
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