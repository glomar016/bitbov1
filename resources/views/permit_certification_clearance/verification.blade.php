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
		<li class="breadcrumb-item"><a href="javascript:;">Application Evaluation</a></li>
	</ol>

	<h1 class="page-header">Application Evaluation<small>DILG Requirements</small></h1>

	<ul class="nav nav-pills">
		<li class="nav-items" hidden>
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link" >

				<span class="d-sm-block d-none">Business Evaluation</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" id="">

				<span class="d-sm-block d-none">Business Application</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-3" data-toggle="tab" class="nav-link" id="">

				<span class="d-sm-block d-none">Resident Application</span>
			</a>
		</li>
	</ul>

	<div class="tab-content">	
		{{-- NAV PILLS TAB 1 --}}
		<div class="tab-pane fade active show" id="nav-pills-tab-1" hidden>
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
								<td>{{$row->BUSINESS_NAME}} <br> ( {{$row->LINE_OF_BUSINESS_NAME}})</td>
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

		{{-- NAV PILLS TAB 2 --}}
		<div class="tab-pane fade  active show" id="nav-pills-tab-2">
			<div class="panel panel-inverse">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Issuance Verification </h4>
				</div>
				<!-- end panel-heading -->
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">×</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="tbl_pending_issuance" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Business Number</th>
								<th>Business Name</th>
								<th>Address</th>
								<th>Owner's Name</th>
								<th>Requested Date</th>
								<th>Requested Clearance</th>
								<th >Action</th>
								<th hidden >REQUESTED_PAPER_TYPE</th>
								<th hidden >FORM_PAPER_TYPE</th>
								<th hidden >BUSINESS_NATURE_NAME</th>
								<th hidden >FORM_ID</th>
								<th hidden >REQUESTED_PAPER_TYPE</th>
								<th>FORM date</th>
								<th hidden>Business ID</th>
							</tr>
						</thead>
						<tbody>
							@foreach($pending_application_form as $row)
							<tr class="gradeC" id="{{$row->BUSINESS_ID}}">
								<td>{{$row->BUSINESS_OR_NUMBER}}</td> {{-- 0 --}}
								<td>{{$row->BUSINESS_NAME}}</td> {{-- 1 --}}
								<td>{{$row->BUSINESS_ADDRESS}}</td> {{-- 2 --}}
								<td>{{$row->BUSINESS_OWNER_FIRSTNAME}} {{$row->BUSINESS_OWNER_MIDDLENAME}} {{$row->BUSINESS_OWNER_LASTNAME}} </td> {{-- 3 --}}
								<td>{{$row->REQUESTED_DATE}}</td>
								<td >{{$row->REQUESTED_PAPER_TYPE}}</td>{{-- 5 --}}
								<td>
									<button type="button" class="btn btn-primary" id="btnEvaluateApplication"  data-toggle="modal">
										<i class="fa fa-circle"></i> Evaluate Application Form
									</button>
								</td> {{-- 6 --}}
								<td hidden>{{$row->REQUESTED_PAPER_TYPE}}</td> {{-- 7 --}}
								<td hidden>{{$row->FORM_PAPER_TYPE}}</td> {{-- 8 --}}
								<td hidden>{{$row->BUSINESS_NATURE_NAME}}</td> {{-- 9 --}}
								<td hidden>{{$row->FORM_ID}}</td> {{-- 10 --}}
								<td hidden>{{$row->REQUESTED_PAPER_TYPE_ID}}</td> {{-- 11 --}}
								<td>{{$row->FORM_DATE}}</td>
								<td hidden>{{$row->BUSINESS_ID}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
			</div> 
		</div>
		{{-- NAV PILLS TAB 3 --}}
		<div class="tab-pane fade" id="nav-pills-tab-3">
			<div class="panel panel-inverse">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Issuance Verification </h4>
				</div>
				<!-- end panel-heading -->
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">×</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="tbl_pending_issuance_resident" class="table table-striped table-bordered">
						<thead>
							<tr id="">
								<th>Resident Name</th> 
								<th>Address</th>
								<th>Age</th>
								<th>Civil Status</th>
								<th>Sex</th>
								<th>Requested Certificate</th>
								<th >Action</th>
								<th hidden >REQUESTED_PAPER_TYPE</th>
								<th hidden >FORM_PAPER_TYPE</th>
								<th hidden >FORM_ID</th>
								<th hidden >REQUESTED_PAPER_TYPE</th>
							</tr>
						</thead>
						<tbody>
							@foreach($application_form_resident as $row)
							<tr id="{{$row->RESIDENT_ID}}">
								<td>{{$row->RESIDENT_NAME}}</td> {{-- 0 --}}
								<td>{{$row->ADDRESS}}</td> {{-- 1 --}}
								<td>{{$row->AGE}}</td> {{-- 2 --}}
								<td>{{$row->CIVIL_STATUS}}</td>
								<td>{{$row->SEX}}</td>
								<td>{{$row->REQUESTED_PAPER_TYPE}}</td>
								<td><button type="button" class="btn btn-primary" id="btnEvaluateResidentIssuance" data-toggle="modal">
										<i class="fa fa-circle"></i> Evaluate Application Form
									</button></td>
								<td hidden>{{$row->REQUESTED_PAPER_TYPE}}</td> 
								<td hidden>{{$row->FORM_PAPER_TYPE}}</td> 
								<td hidden>{{$row->FORM_ID}}</td> 
								<td hidden>{{$row->REQUESTED_PAPER_TYPE_ID}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
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
									<input type="text" class="form-control" placeholder="Full Name" id="txt_evaluate_by" value="">
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

	{{-- modal Evaluate - Issuance --}}
	<div class="modal fade" id="modal-Evaluate" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background: #2A72B5" >
					<h4 class="modal-title" style="color: #fff">Evaluate Application Form</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					{{-- <div class="panel-body"> --}}
								<input type="text" id="txt_form_id" hidden="">
								<input type="text" id="txt_requested_paper_id" hidden="">
						
						<div id="divBusiness">
							<h3><b><label id="lbl_business_name_issuance" >Business:</label></b></h3>
							<form>
								<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_business_id_issuance" hidden>

								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Business No.</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_business_no">
									</div>
								</div>

								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Owner</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_owner">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Requested Clearance</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_requested_clearance">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Business Nature</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_business_nature">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Address</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_address">
									</div>
								</div>
						</div>

						<div id="divResident">
							<h3><b><label id="lbl_resident_name" >Resident</label></b></h3>
							<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_resident_id" hidden>
							
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Address</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" readonly="" id="txt_resident_address">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Civil Status</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  readonly="" id="txt_civil_status">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Sex</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" readonly="" id="txt_sex">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Age</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" readonly="" id="txt_age">
								</div>
							</div>
						</div>
							

							{{-- OR DETAILS --}}
							<legend class="m-t-10"></legend>
							<h4>OR Details</h4>

							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">OR Number</label>
								<div class="col-sm-9">
									<input type="text" class="form-control"  id="txt_or_number">
									
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">OR Amount</label>
								<div class="col-sm-9">
									<div class="input-group mb-3">
									  <div class="input-group-prepend">
									    <span class="input-group-text">₱</span>
									  </div>
										<input type="text" class="form-control"  id="txt_or_amount">
									  
									  <div class="input-group-append">
									    <span class="input-group-text">.00</span>
									  </div>
									</div>
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">OR Date</label>
								<div class="col-sm-9">
									<input type="date" class="form-control"  id="txt_or_date" value="<?php echo date('Y-m-d')?>">
								</div>
							</div>

							{{-- Evaluate --}}
							<legend class="m-t-10"></legend>
							<h4>Evaluate</h4>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Status</label>
								<div class="col-sm-9">
									<select class="form-control" id="sel_status_issuance" style="color: black;" >
										<option selected disabled value="">Pending</option>
										<option value="Approved">Approved</option>
										<option value="Decline">Declined</option>
									</select>
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Remarks</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" placeholder="" id="txt_remarks">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Approved By</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" placeholder="" id="txt_evaluate_by_issuance" value="{{session('session_full_name')}}" readonly>
								</div>
							</div>


						</form>
					{{-- </div> --}}
					<legend class="m-t-10"></legend>
					<div align="right">
						<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
						<button  class="btn btn-primary m-r-9" style="background: #2A72B5" id="btnEvaluateIssuance">Evaluate</button>
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
		$("table[id='tbl_pending_issuance']").DataTable({
			"bSort" : false
		});
		$("table[id='tbl_pending_issuance_resident']").DataTable();
		// tbl_pending_issuance_resident
		// moment().subtract(1, 'days').calendar();
		// moment().startOf('day').fromNow();
		console.log(moment("2019-11-23 12:34:00", "YYYY-MM-DD h:mm:ss").fromNow())
		

		//$('#tdFormDateMomentJs').text('');
	});


	$('#tbl_pending_issuance').on('click', '#btnEvaluateApplication', function(){
		// alert('here at wtih table');
		$('#txt_resident_or_business').val('Resident');

		$('#divResident').hide();
		let row = $(this).closest("tr")
		, business_or = $(row.find("td")[0]).text()
		, business_name =  $(row.find("td")[1]).text()
		, business_address = $(row.find("td")[2]).text()
		, business_owner = $(row.find("td")[3]).text()
		, requested_paper = $(row.find("td")[7]).text()
		, business_nature = $(row.find("td")[9]).text()
		, form_id = $(row.find("td")[10]).text()
		, requested_paper_type_id =  $(row.find("td")[11]).text()
		;
		
		
		$("#txt_business_id_issuance").val(row.attr("id"));
		$('#txt_requested_paper_id').val(requested_paper_type_id);
		$('#txt_form_id').val(form_id);

		$('#lbl_business_name_issuance').text(business_name);
		$('#txt_business_no').val(business_or);
		$('#txt_address').val(business_address);
		$('#txt_owner').val(business_owner);
		$('#txt_requested_clearance').val(requested_paper);
		$('#txt_business_nature').val(business_nature);

		$('#modal-Evaluate').modal('show');
	});

	$('#tbl_pending_issuance_resident').on('click', '#btnEvaluateResidentIssuance', function(){
		$('#txt_resident_or_business').val('Business');
		$('#divBusiness').hide();
		$('#modal-Evaluate').modal('show');

		let row = $(this).closest("tr")
		, resident_name = $(row.find("td")[0]).text()
		, resident_address = $(row.find("td")[1]).text()
		, resident_age = $(row.find("td")[2]).text()
		, resident_civil_status = $(row.find("td")[3]).text()
		, resident_sex = $(row.find("td")[4]).text()
		, resident_form_id = $(row.find("td")[9]).text()
		, resident_requested_paper_id = $(row.find("td")[10]).text()
		;
		
		$("#txt_resident_id").val(row.attr("id"));
		$('#txt_requested_paper_id').val(resident_requested_paper_id);
		$('#txt_form_id').val(resident_form_id);
		$('#lbl_resident_name').text(resident_name);

		$('#txt_resident_address').val(resident_address);
		$('#txt_civil_status').val(resident_civil_status);
		$('#txt_sex').val(resident_sex);
		$('#txt_age').val(resident_age);




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
		, resident_id = $('#txt_resident_id').val();

		var year_month = <?php echo date("Y"); ?> + '-' + <?php echo date("m"); ?>

		
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
			,'YEAR_MONTH' : year_month
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

<script src="{{asset('custom/momentjs/moment.min.js')}}"></script>

@endsection
