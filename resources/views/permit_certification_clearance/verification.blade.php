@extends('global.main')

@section('page-css')
{{-- For table --}}

<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />

{{-- Wizard Form --}}

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
		
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link" >

				<span class="d-sm-block d-none">Business Application</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >

				<span class="d-sm-block d-none">Building Application</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-3" data-toggle="tab" class="nav-link" >

				<span class="d-sm-block d-none">Resident Application</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-4" data-toggle="tab" class="nav-link" >

				<span class="d-sm-block d-none">Weights and Measure Application</span>
			</a>
		</li>
	</ul>

	<div class="tab-content">	
		
		

		{{-- NAV PILLS TAB 1 --}}
		<div class="tab-pane fade  active show" id="nav-pills-tab-1">
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
					The following are the existing records of the businesses within the system.
				</div>
				
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="tbl_pending_issuance" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th style="width: 15%"><center>Business Number<center></th>
								<th><center>Business Name</center></th>
								<th><center>Address</center></th>
								<th><center>Owner's Name</center></th>
								<th style="width: 15%"><center>Requested Date</center></th>
								<th><center>Clearance Type</center></th>
								<th><center>Action</center></th>
								<th hidden >REQUESTED_PAPER_TYPE</th>
								<th hidden >FORM_PAPER_TYPE</th>
								<th hidden >BUSINESS_NATURE_NAME</th>
								<th hidden >FORM_ID</th>
								<th hidden >REQUESTED_PAPER_TYPE</th>
								<th hidden>FORM date</th>
								<th hidden>Business ID</th>
							</tr>
						</thead>
						<tbody>
							@foreach($pending_application_form as $row)
							<tr class="gradeC" id="{{$row->BUSINESS_ID}}">
								<td><center>{{$row->BUSINESS_OR_NUMBER}}</center></td> {{-- 0 --}}
								<td><center>{{$row->BUSINESS_NAME}}</center></td> {{-- 1 --}}
								<td><center>{{$row->BUSINESS_ADDRESS}}</center></td> {{-- 2 --}}
								<td><center>{{$row->BUSINESS_OWNER_FIRSTNAME}} {{$row->BUSINESS_OWNER_MIDDLENAME}} {{$row->BUSINESS_OWNER_LASTNAME}}</center></td> {{-- 3 --}}
								<td><center>{{$row->REQUESTED_DATE}}</center></td>
								<td><center>{{$row->REQUESTED_PAPER_TYPE}}</center></td>
								<td>
									<button type="button" class="btn btn-primary" id="btnEvaluateApplication"  data-toggle="modal">
										<i class="fa fa-circle"></i> Evaluate 
									</button>
								</td> {{-- 6 --}}
								<td hidden>{{$row->REQUESTED_PAPER_TYPE}}</td> {{-- 7 --}}
								<td hidden>{{$row->FORM_PAPER_TYPE}}</td> {{-- 8 --}}
								<td hidden>{{$row->BUSINESS_NATURE_NAME}}</td> {{-- 9 --}}
								<td hidden>{{$row->FORM_ID}}</td> {{-- 10 --}}
								<td hidden>{{$row->REQUESTED_PAPER_TYPE_ID}}</td> {{-- 11 --}}
								<td hidden>{{$row->FORM_DATE}}</td>
								<td hidden>{{$row->BUSINESS_ID}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
			</div> 
		</div>
		{{-- NAV PILLS TAB 2 --}}
		<div class="tab-pane fade" id="nav-pills-tab-2">
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
					The following are the existing records of the buildings within the system.
				</div>
				
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="tbl_building_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th hidden><center>Building id</center></th>
								<th style="width: 20%"><center>Lot Number</center></th>
								<th style="width: 20%"><center>Building Number</center></th>
								<th style="width: 20%"><center>Project Type</center></th>

								<th style="width: 20%"><center>Project Location</center></th>
								<th style="width: 20%"><center>Applicant Name</center></th>
								<th style="width: 17%"><center>Action</center></th>
								<th hidden>Cost</th>
								<th hidden>Enterprise Name</th>
								<th hidden>Scope</th>
								<th hidden>Building No</th>
								<th hidden>Requested Paper</th>
								<th hidden>Requested Paper ID</th>
								<th hidden>Form ID</th>
							</tr>
						</thead>
						<tbody>

							@foreach($pending_buildings as $value)
							<tr>
								<td hidden>{{$value->BUILDING_ID}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$value->LOT_NUMBER}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$value->BUILDING_ID_NUMBER}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$value->PROJECT_TYPE}}</td>
								
								<td style="text-align: center; text-transform: uppercase;">{{$value->PROJECT_LOCATION}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$value->APPLICANT_NAME}}</td>
								<td style="text-align: center; ">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="modal-Approval" id="btnEvaluateBuildingRequest">
										<i class="fa fa-eye"></i> Evaluate
									</button>
								</td>
								<td hidden style="text-align: center; text-transform: uppercase;">{{$value->PROJECT_COST}}</td>
								<td hidden style="text-align: center; text-transform: uppercase;">{{$value->ENTERPRISE_NAME}}</td>
								<td hidden style="text-align: center; text-transform: uppercase;">{{$value->SCOPE_OF_WORK}}</td>
								<td hidden style="text-align: center; text-transform: uppercase;">{{$value->BUILDING_ID_NUMBER}}</td>
								<td hidden style="text-align: center; text-transform: uppercase;">{{$value->PAPER_TYPE_NAME}}</td>
								<td hidden style="text-align: center; text-transform: uppercase;">{{$value->REQUESTED_PAPER_TYPE_ID}}</td>
								<td hidden style="text-align: center; text-transform: uppercase;">{{$value->FORM_ID}}</td>
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
								<th ><center>Resident Name</center></th> 
								<th><center>Address</center></th>
								<th><center>Age</center></th>
								<th ><center>Civil Status</center></th>
								<th><center>Sex</center></th>
								<th><center>Requested Certificate</center></th>
								<th><center>Action</center></th>
								<th hidden >REQUESTED_PAPER_TYPE</th>
								<th hidden >FORM_PAPER_TYPE</th>
								<th hidden >FORM_ID</th>
								<th hidden >REQUESTED_PAPER_TYPE</th>
							</tr>
						</thead>
						<tbody>
							@foreach($application_form_resident as $row)
							<tr id="{{$row->RESIDENT_ID}}">
								<td><center>{{$row->RESIDENT_NAME}}</center></td> {{-- 0 --}}
								<td><center>{{$row->ADDRESS}}</center></td> {{-- 1 --}}
								<td><center>{{$row->AGE}}</center></td> {{-- 2 --}}
								<td style="width: 15%"><center>{{$row->CIVIL_STATUS}}</center></td>
								<td><center>{{$row->SEX}}</center></td>
								<td><center>{{$row->REQUESTED_PAPER_TYPE}}</center></td>
								<td><center><button type="button" class="btn btn-primary" id="btnEvaluateResidentIssuance" data-toggle="modal">
										<i class="fa fa-circle"></i> Evaluate Application Form
									</button>
								</center></td>
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

		{{-- NAV PILLS TAB 4 --}}
		<div class="tab-pane fade" id="nav-pills-tab-4">
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
					The following are the existing records of the businesses within the system.
				</div>
				
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="tbl_pending_weights_and_measure" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th style="width: 15%"><center>Business Number<center></th>
								<th><center>Business Name</center></th>
								<th><center>Device Number</center></th>
								<th><center>License Number</center></th>
								<th><center>Device Type</center></th>
								<th><center>Capacity</center></th>
								<th><center>Serial No</center></th>
								<th><center>Requested Date</center></th>
								<th><center>Action</center></th>
								<th hidden >REQUESTED_PAPER_TYPE</th>
								<th hidden >FORM_PAPER_TYPE</th>
								<th hidden >BUSINESS_NATURE_NAME</th>
								<th hidden >FORM_ID</th>
								<th hidden >REQUESTED_PAPER_TYPE</th>
								<th hidden>FORM date</th>
								<th hidden>Business ID</th>
							</tr>
						</thead>
						<tbody>
							@foreach($pending_weights_and_measure as $row)
							<tr class="gradeC" id="{{$row->BUSINESS_ID}}">
								<td><center>{{$row->BUSINESS_OR_NUMBER}}</center></td> {{-- 0 --}}
								<td><center>{{$row->BUSINESS_NAME}}</center></td> {{-- 1 --}}
								<td><center>{{$row->DEVICE_NUMBER}}</center></td> {{-- 2 --}}
								<td><center>{{$row->LICENSE_NO}}</center></td> {{-- 2 --}}
								@if($row->DEVICE_TYPE == "LM")
								<td>Linear Measure (Tape Measure, Yardstick, Caliper, Gauge, etc)</td>
								@elseif($row->DEVICE_TYPE == "MC")
								<td>Measure of Capacity (Fuel Dispensing Pump, calibration bucket, etc) </td>
								@elseif($row->DEVICE_TYPE == "GS")
								<td>Graduated Scale Balance (Weighing Scales, etc)</td>
								@elseif($row->DEVICE_TYPE == "AB")
								<td>Apothecary Balances (Mineral and Medicinal Uses)</td>
								@else
								<td></td>
								@endif
								<td><center>{{$row->CAPACITY}} kg</center></td> {{-- 6 --}}
								<td><center>{{$row->SERIAL_NO}}</center></td> {{-- 7 --}}
								<td><center>{{$row->FORM_DATE}}</center></td> {{-- 7 --}}
								<td>
									<button type="button" class="btn btn-primary btnEvaluateWeightsAndMeasure" id="{{$row->WEIGHTS_AND_MEASURE_ID}}"  data-toggle="modal">
										<i class="fa fa-circle"></i> Evaluate 
									</button>
								</td> {{-- 6 --}}
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
										<input class="form-control" type="text" id="txt_business_or_no" style="background-color: white;">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Address</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" readonly="" id="txt_trade_name" style="background-color: white;">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Owner</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" readonly="" id="txt_line_of_business" style="background-color: white;">
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
	<div class="modal fade" id="modal-Evaluate" >
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
						<div id="divBuilding">
							<input class="form-control" type="text" readonly="" id="txt_building_id" hidden>
							<h3><b><label id="lbl_project_type" style="text-transform: uppercase;"></label></b></h3>
							<div class="form-group row m-b-10 divBuildingNo" >
									<label class="col-sm-3 col-form-label">Building No</label>
									<div class="col-sm-9">
										<input  style="background-color: white;font-weight: bold; color: black; text-transform: uppercase;" class="form-control" type="text" readonly="" id="txt_building_no">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Applicant/Owner</label>
									<div class="col-sm-9">
										<input  style="background-color: white;font-weight: bold; color: black; text-transform: uppercase;" class="form-control" type="text" readonly="" id="txt_owners_name">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Requested Clearance</label>
									<div class="col-sm-9">
										<input  style="background-color: white;font-weight: bold; color: black; text-transform: uppercase;" class="form-control" type="text" readonly="" id="txt_requested_clearance_b">
									</div>
								</div>
								{{--<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Project Type</label>
									<div class="col-sm-9">
										<input  style="background-color: white;font-weight: bold; color: black; text-transform: uppercase;" class="form-control" type="text" readonly="" id="txt_project_type"/>
									</div>
								</div>--}}
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Project Location</label>
									<div class="col-sm-9">
										<textarea  style="background-color: white;font-weight: bold; color: black; text-transform: uppercase;" class="form-control" type="text" readonly="" id="txt_project_loc"></textarea>
									</div>
								</div>
						</div>
						<div id="divBusiness">
							<h3><b><label id="lbl_business_name_issuance" >Business:</label></b></h3>
							<form>
								<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_business_id_issuance" hidden>

								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Business No.</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_business_no" style="background-color: white; font-weight: bold; color: black;">
									</div>
								</div>

								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Owner</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_owner" style="background-color: white;font-weight: bold; color: black;">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Requested Clearance</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_requested_clearance" style="background-color: white;font-weight: bold; color: black;">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Business Nature</label>
									<div class="col-sm-9">
										<textarea class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_business_nature" style="background-color: white;font-weight: bold; color: black;"></textarea>
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-sm-3 col-form-label">Address</label>
									<div class="col-sm-9">
										<textarea class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_address" style="background-color: white;font-weight: bold; color: black;"></textarea>
									</div>
								</div>
						</div>

						<div id="divResident">
							<h3><b><label id="lbl_resident_name" >Resident</label></b></h3>
							<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_resident_id" hidden>
							
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Address</label>
								<div class="col-sm-9">
									<textarea class="form-control" type="text" readonly="" id="txt_resident_address" style="background-color: white;font-weight: bold; color: black;"></textarea>
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Civil Status</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  readonly="" id="txt_civil_status" style="background-color: white;font-weight: bold; color: black;">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Sex</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" readonly="" id="txt_sex" style="background-color: white;font-weight: bold; color: black;">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Age</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" readonly="" id="txt_age" style="background-color: white;font-weight: bold; color: black;">
								</div>
							</div>
						</div>

						<div id="divWeightsAndMeasure">
							<h3><b><label id="lbl_resident_name" >Weights and Measure</label></b></h3>
							<input class="form-control" type="text" placeholder="Readonly input here…" readonly="" id="txt_weights_and_measure_form_id" hidden>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Device Number</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  readonly="" id="txt_device_number" style="background-color: white;font-weight: bold; color: black;">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Business No.</label>
								<div class="col-sm-9">
									<textarea class="form-control" type="text" readonly="" id="txt_wm_business_no" style="background-color: white;font-weight: bold; color: black;"></textarea>
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Business Name</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  readonly="" id="txt_wm_business_name" style="background-color: white;font-weight: bold; color: black;">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Business Address</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  readonly="" id="txt_business_address" style="background-color: white;font-weight: bold; color: black;">
								</div>
							</div>
							
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">License No.</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" readonly="" id="txt_license_no" style="background-color: white;font-weight: bold; color: black;">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Device Type</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" readonly="" id="txt_device_type" style="background-color: white;font-weight: bold; color: black;">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Brand</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" readonly="" id="txt_brand" style="background-color: white;font-weight: bold; color: black;">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Model</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" readonly="" id="txt_model" style="background-color: white;font-weight: bold; color: black;">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Capacity</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" readonly="" id="txt_capacity" style="background-color: white;font-weight: bold; color: black;">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-sm-3 col-form-label">Serial No</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" readonly="" id="txt_serial_no" style="background-color: white;font-weight: bold; color: black;">
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
										<input type="text" class="form-control txt_or_amount"  id="txt_or_amount">
									  
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
									<input  style="background-color: white;font-weight: bold; color: black;" type="text" class="form-control" placeholder="" id="txt_evaluate_by_issuance" value="{{session('session_full_name')}}" readonly>
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
		$("table[id='tbl_business_lst']").DataTable({
			"bSort" : false
		});

		$("table[id='tbl_building_lst']").DataTable({
			"bSort" : false
		});
		$("table[id='tbl_pending_issuance']").DataTable({
			"bSort" : false
		});
		$("table[id='tbl_pending_issuance_resident']").DataTable({
			"bSort" : false
		});
		$("table[id='tbl_pending_weights_and_measure']").DataTable({
			"bSort" : false
		});
		// tbl_pending_issuance_resident
		// moment().subtract(1, 'days').calendar();
		// moment().startOf('day').fromNow();
		console.log(moment("2019-11-23 12:34:00", "YYYY-MM-DD h:mm:ss").fromNow())
		$('#divBuilding').hide();

		$('#txt_or_amount').val('');
	});

	function addZeroes(num) {
	  const dec = num.split('.')[1]
	  const len = dec && dec.length > 2 ? dec.length : 2
	  return Number(num).toFixed(len)
	}

	$(document).on("mouseout", "#txt_or_amount", function() {
	    
	    value = $('#txt_or_amount').val();
	    $('.txt_or_amount').val(addZeroes(value));	
	    
	});

	$('#tbl_building_lst').on('click', '#btnEvaluateBuildingRequest', function(){
		let row = $(this).closest("tr")
		, proj_type = $(row.find("td")[3]).text()
		, lot_no = $(row.find("td")[1]).text() == '' ? '' : $(row.find("td")[1]).text()
		, building_no = $(row.find("td")[2]).text() == '' ? '' : ' - ' + $(row.find("td")[2]).text()
		, applicant_name = $(row.find("td")[5]).text()
		, paper_name = $(row.find("td")[11]).text()
		
		, proj_loc = $(row.find("td")[4]).text()
		, paper_id = $(row.find("td")[12]).text()
		, form_id = $(row.find("td")[13]).text()
		, building_id = $(row.find("td")[0]).text()


		$('#lbl_project_type').text(proj_type);
		$('#txt_building_no').val(lot_no+building_no);
		$('#txt_owners_name').val(applicant_name);
		$('#txt_requested_clearance_b').val(paper_name);
		$('#txt_project_loc').val(proj_loc);
		$('#txt_building_id').val(building_id);
		$('#txt_requested_paper_id').val(paper_id);
		$('#txt_form_id').val(form_id);

		$('#divBusiness').hide();
		$('#divResident').hide();
		$('#divWeightsAndMeasure').hide();
		$('#divBuilding').show();
		
		$('#modal-Evaluate').modal('show');
	});

	$('#tbl_pending_issuance').on('click', '#btnEvaluateApplication', function(){
		// alert('here at wtih table');
		$('#txt_resident_or_business').val('Resident');

		$('#divResident').hide();
		$('#divBuilding').hide();
		$('#divWeightsAndMeasure').hide();
		$('#divBusiness').show();
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
		$('#divWeightsAndMeasure').hide();
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


	$('.btnEvaluateWeightsAndMeasure').on('click', function(e){
		e.preventDefault();
		var WEIGHTS_AND_MEASURE_ID = this.id;

		let data = {
			'_token': " {{ csrf_token() }}",
			'WEIGHTS_AND_MEASURE_ID': WEIGHTS_AND_MEASURE_ID,
			'TYPE': 'weightsandmeasure'
		};

		$.ajax({
			url: "{{route('getWeightsAndMeasureApplicationForm')}}",
			type: "POST",
			data: data,

			success: function(response){	
				let wmData = response.pending_weights_and_measure;
				console.log(wmData);
				let deviceType;

				if(wmData[0].DEVICE_TYPE == "LM")
					deviceType = "Linear Measure (Tape Measure, Yardstick, Caliper, Gauge, etc)"
				else if(wmData[0].DEVICE_TYPE == "MC")
					deviceType = "Measure of Capacity (Fuel Dispensing Pump, calibration bucket, etc)"
				else if(wmData[0].DEVICE_TYPE == "GS")
					deviceType = "Graduated Scale Balance (Weighing Scales, etc)"
				else if(wmData[0].DEVICE_TYPE == "AB")
					deviceType = "Apothecary Balances (Mineral and Medicinal Uses)"

				$('#txt_form_id').val(wmData[0].FORM_ID);
				$('#txt_wm_business_no').val(wmData[0].BUSINESS_OR_NUMBER);
				$('#txt_wm_business_name').val(wmData[0].BUSINESS_NAME);
				$('#txt_business_address').val(wmData[0].BUSINESS_ADDRESS);
				$('#txt_device_number').val(wmData[0].DEVICE_NUMBER);
				$('#txt_license_no').val(wmData[0].LICENSE_NO);
				$('#txt_device_type').val(deviceType);
				$('#txt_brand').val(wmData[0].BRAND);
				$('#txt_model').val(wmData[0].MODEL);
				$('#txt_capacity').val(wmData[0].CAPACITY + ' kg');
				$('#txt_serial_no').val(wmData[0].SERIAL_NO);

				$('#divResident').hide();
				$('#divBuilding').hide();
				$('#divBusiness').hide();
				$('#divWeightsAndMeasure').show();
				$('#modal-Evaluate').modal('show');
			}
		})

		

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
		, building_id = $('#txt_building_id').val()
		, weights_and_measure_id = $('#txt_weights_and_measure_id').val();

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
			,'BUILDING_ID' : building_id
			,'WEIGHTS_AND_MEASURE_ID' : weights_and_measure_id
			,'YEAR_MONTH' : year_month
		};

		

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


<script src="{{asset('custom/momentjs/moment.min.js')}}"></script>

@endsection
