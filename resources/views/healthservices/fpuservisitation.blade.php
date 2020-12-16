@extends('global.main')

@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
	<div id="content" class="content">
		<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Health Services</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Family Planning</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">FP User Visitation</a></li>
	</ol>
	<h1 class="page-header">Family Planning <small>DILG Requirements</small></h1>

	{{-- nav pills --}}
	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active">
				<span class="d-sm-block d-none">Add Visitation</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >
				<span class="d-sm-block d-none">Visitation Record</span>
			</a>
		</li>
	</ul>

	<div class="tab-content">
		{{-- NAV PILLS TAB 1 - ADD VISITATION --}}
		<div class="tab-pane fade active show" id="nav-pills-tab-1">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Add Visitation</h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<div class="panel-body">
					<table id="tbl_fpuser_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($residentFP as $row)
							<tr class="gradeC" id="{{$row->FD_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<a  id="btnAddVisitation" class='btn btn-lime m-r-5 m-b-5' data-toggle='modal' data-target='#modal-FPuserVisitation' style="color: #fff">
										<i class='fa fa-edit' style="color: #fff"></i> Add Visitation
									</a>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

		{{-- NAV PILLS TAB 2 - VIEW FP USER VISITATION --}}
		<div class="tab-pane fade " id="nav-pills-tab-2">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Visitation Record</h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<div class="panel-body">
					<table id="tbl_visitation_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="20%">Name</th>
								<th width="20%">Visit Date</th>
								<th width="20%">Visit Remarks</th>
								<th width="20%"> Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($visitation as $row)
							<tr class="gradeC" id="{{$row->FD_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<a  id="btnAddVisitation" class='btn btn-lime m-r-5 m-b-5' data-toggle='modal' data-target='#modal-FPuserVisitation' style="color: #fff">
										<i class='fa fa-edit' style="color: #fff"></i> Add Visitation
									</a>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>			
		</div>

	{{-- addVisitation modal --}}
	<div class="modal fade" id="modal-FPuserVisitation" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background: #90CA4B" >
					<h4 class="modal-title" style="color: #fff">FP User Visistation</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					<h3><b><label id="txt_resname" >Resident:</label></b></h3>
					<input type="text" id="txt_fp_id" hidden>

					<div class="col-md-10">
						<label>Visitation Date</label>
						<input type="date" class="form-control" style="width: 250px;" id="txt_visitDate" />
					</div>
					<br>
					<div class="col-md-10">
						<label>Visitation Remarks</label>
						<input type="text" class="form-control" id="txtarea_remarks">
						
					</div>
					<br>
					<legend class="m-t-10"></legend>
					<div align="right">
						<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
						<button  onclick = "AddVisitation()" class="btn btn-lime m-r-9" style="background: #90CA4B">Tag</button>
					</div>				
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
@endsection


@section('page-js')
<script >
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		$("table[id='tbl_fpuser_lst']").DataTable();
		$("table[id='tbl_visitation_lst']").DataTable();
	});

	// click table to modal get data

	$('#tbl_fpuser_lst').on('click', '#btnAddVisitation', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$("input[id='txt_fp_id']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;
	});

	//CRUD
	function AddVisitation(){
		let data = {
			'_token' : "{{ csrf_token() }}"
			,'fp_id' : $("input[id='txt_fp_id']").val()
			,'visitation_date' : $("input[id='txt_visitDate']").val()
			,'visitation_remarks' : $("input[id='txtarea_remarks']").val()
		};

		$.ajax({
			url : " {{ route('CRUDFPVisitation') }} ",
			method : 'POST',
			data : data,
			success : function(response){
				$('#modal-addVisitation').modal('hide');
				swal({
					title : 'Success',
					text : response["message"],
					icon : 'success',
				});
				window.location.reload();
			},
			error : function(error){
					alert('may mali');
				}
		});

	}
	// for modal
	function hideModal(){$('#modal-FPuserVisitation').modal('hide');}
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