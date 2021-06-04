@extends('global.main')

@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />

{{-- Wizard Form --}}
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/parsley.css') }}" rel="stylesheet" />
{{-- <link href="{{ asset('assets/plugins/pace/pace.min.js') }}" rel="stylesheet" /> --}}
<script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>
{{-- <link href="../assets/plugins/jquery-smart-wizard/src/css/smart_wizard.css" rel="stylesheet" /> --}}
{{-- <script src="../assets/plugins/pace/pace.min.js"></script> --}}
@endsection

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Permit/Certification/Clearance</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Business Evaluation</a></li>
	</ol>

	<h1 class="page-header">Business Evaluation<small>DILG Requirements</small></h1>



	<div class="tab-content">
		{{-- NAV PILLS TAB 1 --}}
		<div class="tab-pane fade active show" id="nav-pills-tab-1">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Evaluate Building</h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the business within the system.
				</div>
				<div class="panel-body">
					<table id="tbl_business_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th hidden>
									<center>Building id</center>
								</th>
								<th style="width: 10%; text-align: center;">Lot Number</th>
								<th style="width: 10%; text-align: center;">Building Number</th>
								<th style="width: 20%; text-align: center;">Scope of Work</th>
								<th style="width: 20%; text-align: center;">Project Type</th>


								<th style="width: 25%; text-align: center;">Project Location</th>
								<th style="width: 20%; text-align: center;">Applicant Name</th>
								<th style="width: 20%; text-align: center;">Status</th>
								<th>
									<center>Action</center>
								</th>
								<th hidden>Cost</th>
								<th hidden>Enterprise Name</th>
								<th hidden>Scope</th>
								<th hidden>Transaction ID</th>
							</tr>
						</thead>
						<tbody>

							@foreach($buildingsNotApproved as $value)
							@php
							$scope = $value->SCOPE_OF_WORK == '-- Scope of Work --' ? 'N/A' : $value->SCOPE_OF_WORK;
							@endphp
							<tr>
								<td hidden>{{$value->BUILDING_ID}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$value->LOT_NUMBER}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$value->BUILDING_ID_NUMBER}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$scope}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$value->PROJECT_TYPE}}</td>


								<td style="text-align: center; text-transform: uppercase;">{{$value->PROJECT_LOCATION}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$value->APPLICANT_NAME}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$value->T_IS_IMPROVEMENT == 0 ? 'FOR REQUEST' : 'IMPROVEMENT'}}</td>
								<td style="text-align: center; ">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="modal-Approval" id="btnEvaluateBusinessRequest">
										<i class="fa fa-eye"></i> Evaluate
									</button>
								</td>
								<td hidden style="text-align: center; text-transform: uppercase;">{{$value->PROJECT_COST}}</td>
								<td hidden style="text-align: center; text-transform: uppercase;">{{$value->ENTERPRISE_NAME}}</td>
								<td hidden style="text-align: center; text-transform: uppercase;">{{$value->SCOPE_OF_WORK}}</td>
								<td hidden style="text-align: center; text-transform: uppercase;">{{$value->TRANSACTION_ID}}</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>


	</div>
	{{-- modal Approval - Business --}}
	<div class="modal fade" id="modal-Approval">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background: #2A72B5">
					<h4 class="modal-title" style="color: #fff">Evaluate</h4>
					<button type="button" onclick="hideModal()" class="close" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					{{-- <div class="panel-body"> --}}


					<form>
						{{-- <div id="divBusiness"> --}}
						<h2><b><label id="lbl_project_type" style="text-transform: uppercase;"></label></b></h2>
						<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_building_id" hidden>
						<div class="form-group row m-b-10">
							<label class="col-sm-3 col-form-label">Applicant/Owner</label>
							<div class="col-sm-9">
								<input style="background-color: white;font-weight: bold; color: black; text-transform: uppercase;" class="form-control" type="text" readonly="" id="txt_owners_name">
							</div>
						</div>
						<div class="form-group row m-b-10">
							<label class="col-sm-3 col-form-label">Enterprise Name</label>
							<div class="col-sm-9">
								<input style="background-color: white;font-weight: bold; color: black; text-transform: uppercase;" class="form-control" type="text" readonly="" id="txt_enterprise">
							</div>
						</div>
						<div class="form-group row m-b-10">
							<label class="col-sm-3 col-form-label">Project Location</label>
							<div class="col-sm-9">
								<textarea style="background-color: white;font-weight: bold; color: black; text-transform: uppercase;" class="form-control" type="text" readonly="" id="txt_project_loc"></textarea>
							</div>
						</div>

						<div class="form-group row m-b-10">
							<label class="col-sm-3 col-form-label">Project Cost</label>
							<div class="col-sm-9">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">₱</span>
									</div>
									<input style="background-color: white;font-weight: bold; color: black;" type="text" class="form-control" id="txt_project_cost" readonly="">

									<div class="input-group-append">
										<span class="input-group-text">.00</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row m-b-10">
							<label class="col-sm-3 col-form-label">Scope of Work</label>
							<div class="col-sm-9">
								<textarea style="background-color: white;font-weight: bold; color: black; text-transform: uppercase;" class="form-control" type="text" readonly="" id="txt_scope"></textarea>
							</div>
						</div>

						{{-- </div> --}}


						<h4>Evaluate</h4>
						<div class="form-group row m-b-10">
							<label class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-9">
								<select class="form-control" id="sel_status" style="color: black;">
									<option selected disabled value="">Pending</option>
									<option value="Approved">Approved</option>
									<option value="Decline">Declined</option>
								</select>
							</div>
						</div>
						<div class="form-group row m-b-10">
							<label class="col-sm-3 col-form-label">Approved By</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" placeholder="Full Name" id="txt_evaluate_by" value="{{session('session_full_name')}}" style="background-color: white;font-weight: bold; color: black;" readonly>
							</div>
						</div>
					</form>
					{{-- </div> --}}
					<legend class="m-t-10"></legend>
					<div align="right">
						<a onclick="hideModal()" class="btn btn-white m-r-5">Close</a>
						<button class="btn btn-lime m-r-9" style="background: #2A72B5" id="btnEvaluate">Evaluate</button>
					</div>
				</div>
			</div>
		</div>
	</div>


	<input type="text" id="txt_resident_or_business" hidden />
</div>


@endsection

@section('page-js')

<script>
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		$("table[id='tbl_business_lst']").DataTable({
			'bSort': false
		});

	});

	function hideModal() {
		$('#modal-Approval').modal('hide');
	}

	var transaction_id = '';
	$('#tbl_business_lst').on('click', '#btnEvaluateBusinessRequest', function() {


		let row = $(this).closest("tr"),
			building_id = $(row.find("td")[0]).text(),
			lot_no = $(row.find("td")[1]).text() == '' ? '' : $(row.find("td")[1]).text(),
			building_no = $(row.find("td")[2]).text() == '' ? '' : ' - ' + $(row.find("td")[2]).text(),
			proj_type = $(row.find("td")[4]).text() == '' ? '' : ' - ' + $(row.find("td")[4]).text(),
			owner = $(row.find("td")[6]).text(),
			enterprise = $(row.find("td")[10]).text(),
			proj_location = $(row.find("td")[5]).text(),
			proj_cost = $(row.find("td")[9]).text(),
			scope = $(row.find("td")[11]).text() == '-- Scope of Work --' ? 'N/A' : $(row.find("td")[11]).text();

		transaction_id = $(row.find("td")[12]).text();


		$("#txt_building_id").val(building_id);
		$("#lbl_project_type").text(lot_no + building_no + proj_type);
		$("#txt_owners_name").val(owner);
		$("#txt_enterprise").val(enterprise);
		$("#txt_project_loc").val(proj_location);
		$("#txt_project_cost").val(proj_cost);
		$("#txt_scope").val(scope);
		$('#modal-Approval').modal('show');

	});

	$('#modal-Approval').on('click', '#btnEvaluate', function() {
		var Status = $('#sel_status option:selected').text(),
			ApprovedBy = $('#txt_evaluate_by').val(),
			BuildingId = $('#txt_building_id').val()





		let data = {
			'_token': " {{ csrf_token() }}",
			'STATUS': Status,
			'APPROVED_BY': ApprovedBy,
			'BUILDING_ID': BuildingId,
			'BUSINESS_ID': '',
			'TYPE': 'building',
			'TRANSACTION_ID': transaction_id
		};


		$.ajax({
			url: "{{ route('CRUDBusinessApproval') }}",
			method: 'POST',
			data: data,
			success: function(response) {
				swal({
					title: 'Success',
					text: 'Saved Record!',
					icon: 'success',
					timer: 1000,
					buttons: false
				});
				window.location.reload();
			},
			error: function(error) {
				console.log("error: " + error);
				alert('may mali');
			}
		});
	});


	// for modal
</script>




<script src="{{asset('custom/jasonday-printThis-edc43df/printThis.js')}}"></script>
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
{{-- Wizard Form --}}

<script src="{{asset('assets/plugins/parsley/dist/parsley.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.js')}}"></script>
<script src="{{asset('assets/js/demo/form-wizards-validation.demo.min.js')}}"></script>

@endsection