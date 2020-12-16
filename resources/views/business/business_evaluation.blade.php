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
					<h4 class="panel-title">Evaluate Business</h4>
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
								<th>Business Number</th>
								<th>Business Name</th>
								<th>Address</th>
								<th>Owner's Name</th>
								<th>Status</th>
								{{-- <th>Period</th> --}}
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($businessNotApproved as $row)
							<tr class="gradeC" id="{{$row->BUSINESS_ID}}">
								<td>{{$row->BUSINESS_OR_NUMBER}}</td>
								<td>{{$row->BUSINESS_NAME}} <br> ( {{$row->BUSINESS_NATURE_NAME}})</td>
								<td>{{$row->BUSINESS_ADDRESS}}</td>
								<td>{{$row->BUSINESS_OWNER_LASTNAME}}, {{$row->BUSINESS_OWNER_FIRSTNAME}}, {{$row->BUSINESS_OWNER_MIDDLENAME}}</td>
								{{-- <td>{{$row->BUSINESS_OR_ACQUIRED_DATE}}</td> --}}
								@if($row->NEW_RENEW_STATUS == "New")
						<td><h5><span class="label label-success">New Business</span></h5>
						</td>		
						@else
						<td>
							<h5><span class="label label-purple">For Renewal</span></h5>
						</td>

						@endif
								<td>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="modal-Approval" id="btnEvaluateBusinessRequest">
										<i class="fa fa-eye"></i> Evaluate
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
	{{-- modal Approval - Business --}}
	<div class="modal fade" id="modal-Approval" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background: #2A72B5" >
					<h4 class="modal-title" style="color: #fff">Evaluate</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					{{-- <div class="panel-body"> --}}
						
						
						<form>
							{{-- <div id="divBusiness"> --}}
								<h3><b><label id="lbl_business_name" >Business:</label></b></h3>
								<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_business_id" hidden>
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Business No.</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_business_or_no">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Address</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" readonly="" id="txt_trade_name">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Owner</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" readonly="" id="txt_line_of_business">
									</div>
								</div>
							{{-- </div> --}}
							

							<h4>Evaluate</h4>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Status</label>
								<div class="col-sm-9">
									<select class="form-control" id="sel_status" style="color: black;" >
										<option selected disabled value="">Pending</option>
										<option value="Approved">Approved</option>
										<option value="Decline">Declined</option>
									</select>
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Approved By</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" placeholder="Full Name" id="txt_evaluate_by">
								</div>
							</div>
						</form>
					{{-- </div> --}}
					<legend class="m-t-10"></legend>
					<div align="right">
						<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
						<button  class="btn btn-lime m-r-9" style="background: #2A72B5" id="btnEvaluate">Evaluate</button>
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
		$("table[id='tbl_business_lst']").DataTable();
		// $("table[id='tbl_pending_issuance']").DataTable();
		// $("table[id='tbl_pending_issuance_resident']").DataTable();
		// tbl_pending_issuance_resident
	});



	$('#btnEvaluateIssuance').on('click', function(){
		
		var or_number = $('#txt_or_number').val()
		, or_amount = $('#txt_or_amount').val()
		, or_date = $('#txt_or_date').val()
		, status = $('#sel_status_issuance option:selected').text()
		, remarks  = $('#txt_remarks').val()
		, approved_by = $('#txt_evaluate_by_issuance').val()
		, requested_paper_id = $('#txt_requested_paper_id').val()
		, form_id = $('#txt_form_id').val()
		, business_id = $('#txt_business_id_issuance').val()
		, resident_id = $('#txt_resident_id').val()
		;

		let data = {
			'_token' : " {{ csrf_token() }}"
			,'OR_NO' : or_number
			,'OR_DATE' : or_date
			,'OR_AMOUNT' : or_amount
			,'FORM_ID' : form_id
			,'PAPER_TYPE_ID' : requested_paper_id
			,'EVALUATED_BY' : approved_by
			,'EVALUATION_STATUS' : status
			,'REMARKS': remarks
			,'BUSINESS_ID' : business_id
			,'RESIDENT_ID' : resident_id
		};

		console.log(data);

		$.ajax({
			url : "{{ route('IssuanceEvaluation') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				swal({
					title: 'Success',
					text: 'Saved Record!',
					icon: 'success',
				});
				window.location.reload();
			},
			error : function(error){
				console.log("error: " + error);
			}
		});	
		
	});

	$('#tbl_business_lst').on('click', '#btnEvaluateBusinessRequest', function(){
		let row = $(this).closest("tr")
		,business_no =  $(row.find("td")[0]).text()
		,business_name =  $(row.find("td")[1]).text()
		,trade_name =  $(row.find("td")[2]).text()
		,line_of_business =  $(row.find("td")[3]).text();

		$("#lbl_business_name").text(business_name);
		$("#txt_business_or_no").val(business_no);
		$("#txt_trade_name").val(trade_name);
		$("#txt_line_of_business").val(line_of_business);
		$("#txt_business_id").val(row.attr("id"));

		$('#modal-Approval').modal('show');

	});

	$('#modal-Approval').on('click', '#btnEvaluate', function(){
		var Status = $('#sel_status option:selected').text()
		,ApprovedBy = $('#txt_evaluate_by').val()
		,BusinessId = $('#txt_business_id').val() ;

		console.log(Status, ApprovedBy, BusinessId);

		let data = {
			'_token' :" {{ csrf_token() }}"
			,'STATUS' : Status
			,'APPROVED_BY' : ApprovedBy
			,'BUSINESS_ID' : BusinessId
		};

		$.ajax({
			url : "{{ route('CRUDBusinessApproval') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				swal({
					title: 'Success',
					text: 'Saved Record!',
					icon: 'success',
				});
				window.location.reload();
			},
			error : function(error){
				console.log("error: " + error);
				alert('may mali');
			}
		});	
	});


	// for modal
	function hideModal(){$('#modal-Approval').modal('hide');$('#modal-Evaluate').modal('hide');$('#modal-PrintClearance').modal('hide');}
	
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
