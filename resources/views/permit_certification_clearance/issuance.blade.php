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
{{-- <script src="../assets/plugins/pace/pacgsise.min.js"></script> --}}
@endsection

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Permit/Certification/Clearance</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Issuance</a></li>
	</ol>

	<h1 class="page-header">Issuance <small>DILG Requirements</small></h1>

	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link">

				<span class="d-sm-block d-none">Businesses</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link">

				<span class="d-sm-block d-none">Buildings</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-3" data-toggle="tab" class="nav-link" id="">

				<span class="d-sm-block d-none">Residents</span>
			</a>
		</li>
	</ul>

	<div class="tab-content">
		{{-- NAV PILLS TAB 1 --}}
		<div class="tab-pane fade active show" id="nav-pills-tab-1">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Issuance Verification </h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<div class="panel-body">
					<table id="tbl_business_approved_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								{{-- <th>Form Number</th> --}}
								<th style="width: 12%">
									<center>Business Number</center>
								</th>
								<th style="width: 20%">
									<center>Business Name</center>
								</th>
								<th>
									<center>Applicant's Name</center>
								</th>
								<th>
									<center>Owner's Name</center>
								</th>
								<th hidden>
									<center>Requested Date</center>
								</th>
								<th>
									<center>Requested Clearance</center>
								</th>
								<th>
									<center>Action</center>
								</th>
								<th hidden>FORM_ID</th>
								<th hidden>CLEARANCE_ID</th>
							</tr>
						</thead>
						<tbody>
							@foreach($approved_application_form as $row)
							<tr class="gradeC" id="	">
								{{-- <th>{{$row->FORM_NUMBER}}</th> --}}
								<td>{{$row->BUSINESS_OR_NUMBER}}</td> {{-- 0 --}}
								<td>{{$row->BUSINESS_NAME}}</td> {{-- 1 --}}
								@if($row->REQUESTED_PAPER_TYPE == 'Barangay Clearance Tricycle')
								<td style="text-transform: uppercase;">{{$row->OPERATOR_NAME}}</td> {{-- 2 --}}
								@else
								<td style="text-transform: uppercase;>" {{$row->APPLICANT_NAME}}</td> {{-- 2 --}}
									@endif
								<td>{{$row->BUSINESS_OWNER_FIRSTNAME}} {{$row->BUSINESS_OWNER_MIDDLENAME}} {{$row->BUSINESS_OWNER_LASTNAME}} </td> {{-- 3 --}}
								<td hidden>{{$row->FORM_DATE}}</td>
								<td style="text-transform: uppercase;">{{$row->REQUESTED_PAPER_TYPE}}</td>{{-- 5 --}}
								<td>
									<button type="button" class="btn btn-yellow form-control" id="btnPrintClearance" data-toggle="modal">
										<i class="fa fa-file-alt">&nbsp;</i> Print
									</button>
								</td> {{-- 6 --}}
								<td hidden>{{$row->FORM_ID}}</td> {{-- 7 --}}
								<td hidden>{{$row->REQUESTED_PAPER_TYPE_ID}}</td>{{-- 8 --}}
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

		{{-- NAV PILLS TAB 2 --}}
		<div class="tab-pane fade" id="nav-pills-tab-2">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Issuance Verification </h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the buildings within the system.
				</div>
				<div class="panel-body">
					<table id="tbl_building_approved_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Control Number</th>
								<th>
									<center>Project Type</center>
								</th>
								<th hidden="">
									<center>Building Name</center>
								</th>
								<th>
									<center>Applicant Name</center>
								</th>
								<th hidden="">
									<center>Project Location</center>
								</th>
								<th hidden="">
									<center>Requested Date</center>
								</th>
								<th>
									<center>Requested Clearance</center>
								</th>
								<th>
									<center>Action</center>
								</th>
								<th hidden>FORM_ID</th>
								<th hidden>CLEARANCE_ID</th>
								<th hidden>
									<center>Requested Clearance</center>
								</th>
							</tr>
						</thead>


						<tbody>
							@foreach($approved_buildings as $row)
							@php
							$control_no_real = '';
							$control_no = explode('-', $row->CONTROL_NO);

							if(isset($control_no[4])) {
							if($control_no[4] <= 9) { $control_no[4]='0000' . $control_no[4]; } else if($control_no[4] <=99) { $control_no[4]='000' . $control_no[4]; } else if($control_no[4] <=999) { $control_no[4]='00' . $control_no[4]; } else if($control_no[4] <=9999) { $control_no[4]='0' . $control_no[4]; } if($control_no[3] <=9) { $control_no[3]='0' . $control_no[3]; } $control_no_real=$control_no[0] . '-' . $control_no[1] . '-' . $control_no[2] . '-' . $control_no[3] . '-' . $control_no[4]; } else { if(isset($control_no[3])) { if($control_no[3] <=9) { $control_no[3]='0' . $control_no[3]; } $control_no_real=$control_no[0] . '-' . $control_no[1] . '-' . $control_no[2] . '-' . $control_no[3]; } else { $control_no_real=$control_no[0] . '-' . $control_no[1] . '-' . $control_no[2]; } } @endphp <tr class="gradeC">
								<td style="text-transform: uppercase; width: 20%">{{$control_no_real}}</td> {{-- 0 --}}
								<td style="text-transform: uppercase; width: 25%">{{$row->PROJECT_TYPE}}</td> {{-- 1 --}}
								<td style="text-transform: uppercase;" hidden="">{{$row->BUILDING_NAME}}</td> {{-- 2 --}}

								<td style="text-transform: uppercase; width: 25%">{{$row->APPLICANT_NAME}}</td> {{-- 3--}}
								<td hidden="">{{$row->PROJECT_LOCATION}}</td>
								<td hidden="">{{$row->FORM_DATE}}</td>
								<td style="text-transform: uppercase; width: 25%">{{substr($row->REQUESTED_PAPER_TYPE,0,28)}} -{{$row->PURPOSE}}</td>{{-- 5 --}}

								<td>
									<button type="button" class="btn btn-yellow form-control" id="btnPrintClearanceBuilding" data-toggle="modal">
										<i class="fa fa-file-alt">&nbsp</i> Print

									</button>
								</td> {{-- 6 --}}
								<td hidden>{{$row->FORM_ID}}</td> {{-- 7 --}}
								<td hidden>{{$row->REQUESTED_PAPER_TYPE_ID}}</td>{{-- 8 --}}
								<td hidden>{{$row->REQUESTED_PAPER_TYPE}}</td>{{-- 8 --}}
								</tr>
								@endforeach
						</tbody>

					</table>
				</div>
			</div>
		</div>

		{{-- NAV PILLS TAB 2 --}}
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
					<table id="tbl_approved_issuance_resident" class="table table-striped table-bordered">
						<thead>
							<tr id="">
								<th>
									<center>Resident Name</center>
								</th>
								<th>
									<center>Address</center>
								</th>
								<th hidden>
									<center>Age</center>
								</th>
								<th hidden>
									<center>Civil Status</center>
								</th>
								<th>
									<center>Sex</center>
								</th>
								<th>
									<center>Requested Certificate</center>
								</th>
								<th>
									<center>Action</center>
								</th>
								<th hidden>REQUESTED_PAPER_TYPE</th>
								<th hidden>FORM_PAPER_TYPE</th>
								<th hidden>FORM_ID</th>
								<th hidden>REQUESTED_PAPER_TYPE</th>
								<th hidden>RESIDENT_ID</th>

							</tr>
						</thead>
						<tbody>
							@foreach($application_form_resident as $row)
							<tr id="{{$row->updated_at}}">
								<td>{{$row->RESIDENT_NAME}}</td> {{-- 0 --}}
								<td>{{$row->ADDRESS}}</td> {{-- 1 --}}
								<td hidden>{{$row->AGE}}</td> {{-- 2 --}}
								<td hidden>{{$row->CIVIL_STATUS}}</td>
								<td>{{$row->SEX}}</td>
								<td style="text-transform: uppercase;">{{$row->REQUESTED_PAPER_TYPE}}</td>
								<td><button type="button" class="btn btn-yellow" id="btnPrintCertificate">
										<i class="fa fa-circle"></i> Print
									</button></td>
								<td hidden>{{$row->REQUESTED_PAPER_TYPE}}</td>
								<td hidden>{{$row->FORM_PAPER_TYPE}}</td>
								<td hidden>{{$row->FORM_ID}}</td>
								<td hidden>{{$row->REQUESTED_PAPER_TYPE_ID}}</td>
								<td hidden>{{$row->RESIDENT_ID}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
			</div>
		</div>

	</div>

	{{-- modal Print --}}
	<div class="modal fade" id="modal-PrintClearance" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background: #FFD900">
					<h4 class="modal-title" style="color: #fff">Print</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					<h3><b><label id="lbl_approved_business_name">Business:</label></b></h3>
					<form>
						<input class="form-control" type="text" readonly="" id="txt_approved_business_id">
						<input class="form-control" type="text" readonly="" id="txt_approved_form_id">
						<input class="form-control" type="text" readonly="" id="txt_clearance_id">
					</form>
					{{-- </div> --}}
					<legend class="m-t-10"></legend>
					<div align="right">
						<a onclick="hideModal()" class="btn btn-white m-r-5">Close</a>
						<button class="btn btn-yellow m-r-9" style="background: #FFD900" id="btnEvaluate">Print</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="fillers" id="fillers" hidden>


	@include('certificateandforms.fm_bbp_001_printable')
	@include('certificateandforms.fm_bc_001a_printable')
	@include('certificateandforms.fm_bc_001b_printable')
	@include('certificateandforms.fm_bc_001c_printable')
	@include('certificateandforms.fm_bc_001d_printable')
	@include('certificateandforms.fm_bc_001e_printable')

	@include('certificateandforms.fm_bcert_qtp_printable')
	@include('certificateandforms.fm_bcert_001a_printable')
	@include('certificateandforms.fm_bcert_001b_printable')
	@include('certificateandforms.fm_bcert_001c_printable')
	@include('certificateandforms.fm_bcert_001d_printable')
	@include('certificateandforms.fm_bcert_001e_printable')
	@include('certificateandforms.fm_bcert_001f_printable')

	@include('certificateandforms.fm_bcfi_printable')
	@include('certificateandforms.fm_bcfwm_printable')
	@include('certificateandforms.fm_non_business_printable')

</div>

@endsection

@section('page-js')

<script>
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		$("table[id='tbl_pending_issuance']").DataTable();
		$("table[id='tbl_business_approved_lst']").DataTable({
			"bSort": false

		});
		$("table[id='tbl_building_approved_lst']").DataTable({
			"bSort": false

		});
		$("table[id='tbl_approved_issuance_resident']").DataTable({
			"bSort": false
		});



	});

	function formatCtrlNo(control_no) {

		if (control_no != null) {
			control_no = control_no.split("-")
			if (control_no[4] <= 9) {
				control_no[4] = '0000' + control_no[4]
			} else if (control_no[4] <= 99) {
				control_no[4] = '000' + control_no[4]
			} else if (control_no[4] <= 999) {
				control_no[4] = '00' + control_no[4]
			} else if (control_no[4] <= 9999) {
				control_no[4] = '0' + control_no[4]
			}
			if (control_no[3] <= 9) {
				control_no[3] = '0' + control_no[3]
			}

			return control_no[0] + '-' + control_no[1] + '-' + control_no[2] + '-' + control_no[3] + '-' + control_no[4];
		} else
			return '';

	}



	$('#tbl_building_approved_lst').on('click', '#btnPrintClearanceBuilding', function() {


		let row = $(this).closest("tr")

			,
			requested_paper_type = $(row.find("td")[10]).text()

			,
			form_id = $(row.find("td")[8]).text();


		let data = {
			'_token': " {{ csrf_token() }}",
			'FORM_ID': form_id,
			'REQUESTED_PAPER_TYPE': requested_paper_type
		};


		$.ajax({
			url: "{{ route('SpecificBusiness') }}",
			method: 'POST',
			data: data,
			success: function(response) {

				var request_paper = response["requested_paper_type"];
				var account_no = '';
				if (request_paper == "Barangay Clearance Building (Non-Business)") {
					var occupancy = '';
					$.each(response["barangay_clearance"], function() {
						control_no = this['CONTROL_NO'];
						purpose = this['PURPOSE'];
						or_no = this['OR_NO'];

						amount = this['OR_AMOUNT'];
						remarks = this['REMARKS'];
						or_date = this['OR_DATE'];
						building_no = this['BUILDING_ID_NUMBER'];
						lot_no = this['LOT_NUMBER'];
						applicant = this['OWNER_NAME'].toUpperCase();
						address = this['APPLICANT_ADDRESS'].toUpperCase();
						proj_type = this['PROJECT_TYPE'];
						scope_or_work = this['SCOPE_OF_WORK'] == '-- Scope of Work --' ? '' : this['SCOPE_OF_WORK'].toUpperCase();
						project_location = this['PROJECT_LOCATION'] == null ? '' : this['PROJECT_LOCATION'].toUpperCase();
						project_area = this['PROJECT_LOT_AREA'] == null ? '' : this['PROJECT_LOT_AREA'].toUpperCase() + ' SQM';
						existing_land_use = this['LAND_USE'] == null ? '' : this['LAND_USE'].toUpperCase();
						project_cost = this['PROJECT_COST'] == null ? '' : this['PROJECT_COST'];
						purpose = this['PURPOSE'].toUpperCase();
					});


					var len = response["building_occupancy"].length;
					if (len != 0) {

						$.each(response["building_occupancy"], function(index) {
							var temp_occu = this['OCCUPANCY'];
							if (index !== len - 1) {
								occupancy += temp_occu + ' (' + this['TOTAL'] + '), ';
							} else {
								occupancy += temp_occu + ' (' + this['TOTAL'] + ') ';
							}
							occupancy.toUpperCase();
						});
					} else {

						occupancy = 'NOT STATED'
					}


					control_no = formatCtrlNo(control_no);
					if (building_no == null) {
						account_no = lot_no;
					}
					if (building_no != null && lot_no != null) {
						account_no = lot_no + '-' + building_no;
					}



					$('#lbl_control_no_n').text(control_no)
					$('#lbl_or_no_n').text(or_no)
					$('#lbl_or_date_n').text(or_date)
					$('#lbl_amount_n').text(amount)
					$('#lbl_account_n').text(account_no)
					$('#lbl_applicant_name').text(applicant)
					$('#lbl_postal_address').text(address)
					$('#lbl_project_type').text(proj_type)
					$('#lbl_scope_work').text(scope_or_work)
					$('#lbl_occupancy').text(occupancy)
					$('#lbl_project_location').text(project_location)
					$('#lbl_project_area').text(project_area)
					$('#lbl_existing_landuse').text(existing_land_use)
					$('#lbl_project_cost').text(project_cost)
					$('#lbl_building_purpose').text(purpose)


					$("#fmbcertnonbusiness").printThis({
						debug: false,

						importCSS: true,
						importStyle: true,
						loadCSS: "",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				}
			},
			error: function(response) {

			},
		});

	});

	$('#tbl_business_approved_lst').on('click', '#btnPrintClearance', function() {

		let row = $(this).closest("tr"),
			business_name = $(row.find("td")[2]).text(),
			requested_paper_type = $(row.find("td")[5]).text(),
			clearance_id = $(row.find("td")[9]).text(),
			form_id = $(row.find("td")[7]).text();

		$("#txt_approved_business_id").val(row.attr("id"));
		$('#lbl_approved_business_name').text(business_name);
		$('#txt_approved_form_id').val(form_id);
		$('#txt_clearance_id').val(clearance_id);



		let data = {
			'_token': " {{ csrf_token() }}",
			'FORM_ID': form_id,
			'REQUESTED_PAPER_TYPE': requested_paper_type
		};


		$.ajax({
			url: "{{ route('SpecificBusiness') }}",
			method: 'POST',
			data: data,
			success: function(response) {
				var request_paper = response["requested_paper_type"];

				// alert(request_paper);
				if (request_paper == "Barangay Business Permit") {
					// alert(response)
					var company_name, address, nature_business, tax_year, quarter, or_no, or_date, or_amount, barangay_permit, business_tax, garbage_fee, signboard, ctc, line_of_business_name_clear = '',
						line_of_business_name = [];
					$.each(response["business_permit"], function() {

						company_name = this["BUSINESS_NAME"];
						address = this["BUSINESS_ADDRESS"];
						nature_business = this["BUSINESS_NATURE_NAME"];
						tax_year = this["TAX_YEAR"];
						quarter = this["QUARTER"];
						or_no = this["OR_NO"];
						or_date = this["OR_DATE"];
						or_amount = this["OR_AMOUNT"];
						barangay_permit = this["BARANGAY_PERMIT"];
						business_tax = this["BUSINESS_TAX"];
						garbage_fee = this["GARBAGE_FEE"];
						signboard = this["SIGNBOARD"];
						ctc = this["CTC"];
						control_no = this["CONTROL_NO"];
						issued_date = this['ISSUED_DATE'];
						account_no = this['BUSINESS_OR_NUMBER'];
						b_plate_no = this['PLATE_NO'];
						b_plate_fee = this['PLATE_FEE'];
						sticker = this['STICKER'];
						total_amount = this['TOTAL_AMOUNT'];

					});
					var i = 0;
					$.each(response["line_of_business"], function() {
						line_of_business_name[i] = this["LINE_OF_BUSINESS_NAME"];
						i++;
					});

					for (var j = 0; j < line_of_business_name.length; j++) {

						if ((j + 1) == (line_of_business_name.length)) {
							line_of_business_name_clear += line_of_business_name[j];
						} else {
							line_of_business_name_clear += line_of_business_name[j] + ', ';
						}
					}

					// original format


					valid_until = moment().add(1, 'Y').format('YYYY');
					control_no = formatCtrlNo(control_no);

					//set value here
					$("#lbl_control_no_b_r").text(control_no);
					$('#lbl_account_no_p').text('Account No: ' + account_no);
					$("#lbl_company_name").text(company_name);
					$("#lbl_business_address").text(address);
					$("#lbl_line_business").text('(' + line_of_business_name_clear + ')');
					$("#lbl_or_number").text(or_no);
					$("#lbl_or_date").text(or_date);
					$("#lbl_amount_p").text(or_amount);
					$("#lbl_barangay_permit").text(barangay_permit);
					$("#lbl_business_tax").text(business_tax);
					$("#lbl_garbage_fee").text(garbage_fee);
					$("#lbl_signboard").text(signboard);
					$("#lbl_ctc").text(ctc);
					$("#lbl_tax_year").text(tax_year);
					$("#lbl_qtr").text(quarter);
					$('#lbl_issued_date').text(issued_date);
					$('#lbl_b_plate_no').text(b_plate_fee);
					$('#lbl_sticker').text(sticker);
					$('#lbl_plate_no_b_r').text(b_plate_no);
					$('#lbl_total_amount_p').text(total_amount + '.00');

					//print here

					$("#fmbbp001").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				} else if (request_paper == "Barangay Clearance Building") {
					var owner, address, project_name, project_location, or_no, or_date, or_amount, control_no;
					console.log(response)

					$.each(response["barangay_clearance"], function() {
						owner = this["BUSINESS_OWNER"];
						address = this["BUSINESS_ADDRESS"];
						project_name = this["SCOPE_OF_WORK_NAME"];
						project_location = this["PROJECT_LOCATION"];
						or_no = this["OR_NO"];
						or_date = this["OR_DATE"];
						or_amount = this["OR_AMOUNT"];
						control_no = this["CONTROL_NO"];
					});

					//set value here
					control_no = formatCtrlNo(control_no);

					$("#lbl_control_no_a").text(control_no);
					$("#lbl_or_no_a").text(or_no);
					// $("#lbl_issued_date_a").text();
					$("#lbl_or_date_a").text(or_date);
					$("#lbl_amount_a").text(or_amount);
					$("#lbl_applicant_a").text(owner);
					$("#lbl_scope_of_work_name_a").text(project_name);
					$("#lbl_address_a").text(address);
					$('#lbl_address_a').css('text-transform', 'capitalize');
					// $("#lbl_wordings_a").text();
					$("#lbl_construction_location_a").text(project_location);

					//print here
					$("#fmbc001a").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				} else if (request_paper == "Barangay Clearance Business") {
					console.log(response);
					var company_name, address, nature_business, or_no, or_date, or_amount, control_no, line, gross_total,
						line_of_business_name_clear = '',
						line_of_business_name = [];

					$.each(response["barangay_clearance"], function() {

						or_no = this["OR_NO"];
						or_date = this["OR_DATE"];
						or_amount = this["OR_AMOUNT"];
						control_no = this["CONTROL_NO"];
						company_name = this["BUSINESS_NAME"];
						address = this["BUSINESS_ADDRESS"];
						account_no = this["BUSINESS_OR_NUMBER"];

					});
					$.each(response["gross_total"], function() {
						gross_total = this["GROSS_TOTAL"];

					});

					var i = 0;
					$.each(response["line_of_business"], function() {
						line_of_business_name[i] = this["LINE_OF_BUSINESS_NAME"];
						i++;
					});

					for (var j = 0; j < line_of_business_name.length; j++) {

						if ((j + 1) == (line_of_business_name.length)) {
							line_of_business_name_clear += line_of_business_name[j];
						} else {
							line_of_business_name_clear += line_of_business_name[j] + ', ';
						}
					}
					gross_total = parseInt(gross_total);
					control_no = formatCtrlNo(control_no);
					//set value here
					$('#lbl_account_no_b').text(account_no);
					$("#lbl_control_no_b").text(control_no);
					$("#lbl_or_no_b").text(or_no);
					$("#lbl_or_date_b").text(or_date);
					$("#lbl_amount_b").text(or_amount);
					$("#lbl_company_name_b").text(company_name);
					$("#lbl_address_b").text(address);

					$("#lbl_address_b").css('text-transform', 'capitalize');
					$("#lbl_nature_of_business_b").text(line_of_business_name_clear);
					$('#lbl_gross_total_b').text('₱ ' + Number((gross_total).toFixed(1)).toLocaleString());

					//print here
					$("#fmbc001b").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});

				} else if (request_paper == "Barangay Clearance Zonal") {
					var oct_tct, tax_declaration, area, location, registered_owner, area_classification, address, purpose, or_no, or_date, or_amount, control_no;

					$.each(response["barangay_clearance"], function() {

						oct_tct = this["OCT_TCT_NUMBER"];
						tax_declaration = this["TAX_DECLARATION"];
						area = this["BUSINESS_AREA"];
						location = this["PROJECT_LOCATION"];
						registered_owner = this["BUSINESS_OWNER"];
						area_classification = this["AREA_CLASSIFICATION"];
						address = this["BUSINESS_ADDRESS"];
						purpose = this["PURPOSE"];
						or_no = this["OR_NO"];
						or_date = this["OR_DATE"];
						or_amount = this["OR_AMOUNT"];
						control_no = this["CONTROL_NO"];

					});
					//set value here
					$("#lbl_control_no_c").text(control_no);
					$("#lbl_or_no_c").text(or_no);
					$("#lbl_or_date_c").text(or_date);
					$("#lbl_amount_c").text(or_amount);
					$("#lbl_oct_tct_c").text(oct_tct);
					$("#lbl_tax_declaration_c").text(tax_declaration);
					$("#lbl_area_c").text(area);
					$("#lbl_location_c").text(location);
					$("#lbl_registered_owner_c").text(registered_owner);
					$("#lbl_area_classification_c").text(area_classification);
					$("#lbl_owner_c").text(registered_owner);
					$("#lbl_address_c").text(address);
					$("#lbl_purpose_c").text(purpose);

					//print here
					$("#fmbc001c").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				} else if (request_paper == "Barangay Clearance Tricycle") {
					var tricycle_operator, company_name, address, driver_license, mudguard_no, cr_no, or_no_driver, or_no, or_date, or_amount, control_no;

					$.each(response["barangay_clearance"], function() {
						tricycle_operator = this["OPERATOR_NAME"];
						company_name = this["BUSINESS_NAME"];
						address = this["BUSINESS_ADDRESS"];
						driver_license = this["D_DRIVER_LICENSE_NO"];
						mudguard_no = this["D_MUDGUARD_NO"];
						cr_no = this["D_CR_NO"];
						or_no_driver = this["D_OR_NO"];
						or_date_d = this["D_OR_DATE"];
						or_no = this["OR_NO"];
						or_date = this["OR_DATE"];
						or_amount = this["OR_AMOUNT"];
						control_no = this["CONTROL_NO"];
						make = this['MAKE'];
						plate_no = this['PLATE_NO'];
						cr_date = this['DTI_NO_DATE'];
						account_no = this['BUSINESS_OR_NUMBER'];
						owners_address = this['OWNER_ADDRESS']
					});
					//set value here


					control_no = formatCtrlNo(control_no);


					$("#lbl_control_no_d").text(control_no);
					$('#lbl_or_no_d').text(or_no)
					$("#lbl_or_date_d").text(or_date);

					$("#lbl_or_cr_d").text(or_no_driver);

					$("#lbl_tricycle_operator_d").text(tricycle_operator);

					$("#lbl_address_d").text(owners_address);
					$('#lbl_address_d').css('text-transform', 'capitalize');
					$("#lbl_drivers_license_d").text(driver_license);
					$("#lbl_mudguard_no_d").text(mudguard_no);
					$("#lbl_cr_no_d").text(cr_no);

					$("#lbl_make").text(make)
					$('#lbl_plate_no_d').text(plate_no);
					$('#lbl_cr_date').text(cr_date);
					$('#lbl_accountno_d').text(account_no);
					$('#lbl_garage').text(address);
					$('#lbl_amount_d').text(or_amount);

					$('#lbl_d_or_date_d').text(or_date_d);
					//print here
					$("#fmbc001d").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				} else if (request_paper == "Barangay Clearance General Purposes") {
					// alert('General Purposes!');
					var activity, company_name, address, or_no, or_date, or_amount, control_no;

					$.each(response["barangay_clearance"], function() {

						activity = this["PURPOSE"];
						company_name = this["BUSINESS_NAME"];
						address = this["BUSINESS_ADDRESS"];
						or_no = this["OR_NO"];
						or_date = this["OR_DATE"];
						or_amount = this["OR_AMOUNT"];
						control_no = this["CONTROL_NO"];
					});
					//set value here
					$("#lbl_control_no_e").text(control_no);
					$("#lbl_or_no_e").text(or_no);
					$("#lbl_or_date_e").text(or_date);
					$("#lbl_amount_e").text(or_amount);
					$("#lbl_activity_e").text(activity);
					$("#lbl_company_name_e").text(company_name);
					$("#lbl_address_e").text(address);


					//print here
					$("#fmbc001e").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				} else if (request_paper == "Barangay Clearance Weights and Measure") {

					var activity, company_name, address, or_no, or_date, or_amount, control_no;

					$.each(response["barangay_clearance"], function() {

						business_name = this["BUSINESS_NAME"];
						address = this["BUSINESS_ADDRESS"];
						or_no = this["OR_NO"];
						or_date = this["OR_DATE"];
						or_amount = this["OR_AMOUNT"];
						control_no = formatCtrlNo(this["CONTROL_NO"]);
						account_no = this["BUSINESS_OR_NUMBER"];
						owners_name = this["BUSINESS_OWNER"];
						owners_address = this["OWNER_ADDRESS"];
					});


					$('#lbl_or_no_f').text(or_no);
					$('#lbl_control_no_f').text(control_no);
					$('#lbl_or_date_f').text(or_date);
					$('#lbl_amount_f').text(or_amount);
					$('#lbl_account_no_f').text(account_no);

					$('#lbl_owners_name').text(owners_name);
					$('#lbl_owners_address').text(owners_address);



					$("#fmbcfwm").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				}


			},
			error: function(error) {
				console.log("error: " + error);
			}
		});
	});

	function getAge(dateString) {
		var today = new Date();
		var birthDate = new Date(dateString);
		var age = today.getFullYear() - birthDate.getFullYear();
		var m = today.getMonth() - birthDate.getMonth();
		if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
			age--;
		}
		return age;
	}

	moment.addRealMonth = function addRealMonth(d) {

		var fm = moment(d).add(1, 'M');
		var fmEnd = moment(fm).endOf('month');
		return d.date() != fm.date() && fm.isSame(fmEnd.format('YYYY-MM-DD')) ? fm.add(1, 'd') : fm;
	}



	$('#tbl_approved_issuance_resident').on('click', '#btnPrintCertificate', function() {
		let row = $(this).closest("tr"),
			resident_name = $(row.find("td")[0]).text(),
			requested_paper_type = $(row.find("td")[5]).text(),
			certificate_id = $(row.find("td")[10]).text(),
			form_id = $(row.find("td")[9]).text(),
			resident_id = $(row.find("td")[11]).text();
		$("#txt_approved_business_id").val(row.attr("id"));
		$('#txt_approved_form_id').val(form_id);
		$('#txt_clearance_id').val(certificate_id);


		let data = {
			'_token': " {{ csrf_token() }}",
			'FORM_ID': form_id,
			'REQUESTED_PAPER_TYPE': requested_paper_type,
			'RESIDENT_ID': resident_id
		};

		$.ajax({
			url: "{{ route('SpecificResident') }}",
			method: 'POST',
			data: data,
			success: function(response) {

				var request_paper = response["requested_paper_type"];

				// 	A
				if (request_paper == "Barangay Certificate Residency") {
					var civil_status, address, sex, purpose;
					var control_no, or_no, or_date, or_amount, applicant;
					$.each(response["barangay_certificate"], function() {
						control_no = this["CONTROL_NO"];
						or_no = this["OR_NO"];
						or_date = this["OR_DATE"];
						or_amount = this["OR_AMOUNT"];
						var str = this["RESIDENT_NAME"]
						var res = str.split(" ")
						fname = res[0]
						mname = res[1]
						lname = res[2]
						applicant = fname + ' ' + mname + ' ' + lname
						place_of_birth = this["PLACE_OF_BIRTH"];
						civil_status = this["CIVIL_STATUS"].toLowerCase();
						address = this["ADDRESS"];
						sex = this["SEX_ADDRESS"];
						purpose = this["PURPOSE"];
						citizenship = this["CITIZENSHIP"];
						date_of_birth = this["DATE_OF_BIRTH"]
						purpose = this["PURPOSE"]
						remarks = this["remarks"]

					});
					// console.log(sex)
					or_date = or_date.split(" ")

					control_no = formatCtrlNo(control_no);

					//set value here
					$("#lbl_control_no_a_r").text(control_no);
					$("#lbl_applicant_a_r").text(applicant)
					$("#lbl_civil_status_a_r").text(civil_status)
					$("#lbl_address_a_r").text(address)
					$("#lbl_purpose_a_r").text(purpose)
					$("#lbl_applicant2_a_r").text(applicant)

					$("#lbl_or_no_a_r").text(or_no);
					$("#lbl_or_date_a_r").text(or_date[0]);
					$("#lbl_amount_a_r").text(or_amount);

					$("#lbl_sex_a_r").text(sex);


					//print here
					$("#fmbcert001a").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				}
				// B
				else if (request_paper == "Barangay Certificate Calamity Loan SSS-GSIS") {
					var sss, civil_status, address, calamity_name, calamity_date;
					var control_no, or_no, or_date, or_amount, applicant, test;

					$.each(response["barangay_certificate"], function() {

						or_no = this["OR_NO"];
						or_date = this["OR_DATE"];
						or_amount = this["OR_AMOUNT"];
						applicant = this["RESIDENT_NAME"];
						sss = this["SSS_NO"];
						civil_status = this["CIVIL_STATUS"].toLowerCase();
						address = this["ADDRESS"].toLowerCase();
						calamity_name = this["CALAMITY_NAME"];
						calamity_date = this["CALAMITY_DATE"];
						control_no = this["CONTROL_NO"];
					});

					or_date = or_date.split(" ")
					control_no = formatCtrlNo(control_no);
					$('#lbl_addressB_r').css('text-transform', 'capitalize');
					//set value here
					$("#lbl_control_n").text(control_no);
					$("#lbl_or_no_b_r").text(or_no);
					$("#lbl_or_date_b_r").text(or_date[0]);
					$("#lbl_amount_b_r").text(or_amount);
					$("#lbl_applicantB_r").text(applicant);
					$("#lbl_sss_gsisB_r").text(sss);
					$("#lbl_civil_statusB_r").text(civil_status);
					$("#lbl_addressB_r").text(address);
					$("#lbl_calamity_name_r").text(calamity_name);
					$("#lbl_calamity_date_r").text(calamity_date);

					//print here
					$("#fmbcert001b").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				}
				// C
				else if (request_paper == "Barangay Certificate Calamity Loan OFW") {
					var sss, civil_status, address, calamity_name, calamity_date, country;
					var control_no, or_no, or_date, or_amount, applicant;
					$.each(response["barangay_certificate"], function() {
						control_no = this["CONTROL_NO"];
						or_no = this["OR_NO"];
						or_date = this["OR_DATE"];
						or_amount = this["OR_AMOUNT"];
						applicant = this["RESIDENT_NAME"]
						sss = this["SSS_NO"];
						civil_status = this["CIVIL_STATUS"].toLowerCase();
						address = this["ADDRESS"].toLowerCase();
						calamity_name = this["CALAMITY_NAME"];
						calamity_date = this["CALAMITY_DATE"];
						country = this["COUNTRY"];
					});
					or_date = or_date.split(" ")
					control_no = formatCtrlNo(control_no);
					$('#lbl_addressC_r').css('text-transform', 'capitalize');
					//set value here
					$("#lbl_control_no_c_r").text(control_no);
					$("#lbl_or_no_c_r").text(or_no);
					$("#lbl_or_date_c_r").text(or_date[0]);
					$("#lbl_amount_c_r").text(or_amount);
					$("#lbl_sss_noC_r").text(sss);
					$("#lbl_civil_statusC_r").text(civil_status);
					$("#lbl_addressC_r").text(address);
					$("#lbl_calamity_name_c_r").text(calamity_name);
					$("#lbl_calamity_date_c_r").text(calamity_date);
					$("#lbl_applicant2C_r").text(applicant);
					$("#lbl_applicantC_r").text(applicant);
					$("#lbl_country_c_r").text(country);

					// //print here
					$("#fmbcert001c").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				}
				// D
				else if (request_paper == "Barangay Certificate SPES") {
					var address, sex_address;
					var control_no, or_no, or_date, or_amount, applicant;
					$.each(response["barangay_certificate"], function() {
						control_no = this["CONTROL_NO"];
						or_no = this["OR_NO"];
						or_date = this["OR_DATE"];
						or_amount = this["OR_AMOUNT"];
						// fname = this["fname"];
						// mname = this["mname"];
						// lname = this["lname"];
						// applicant = fname + ' ' + mname + ' ' + lname
						applicant = this["RESIDENT_NAME"];
						address = this["ADDRESS"];
						sex_address = this["SEX_ADDRESS"];
					});
					var he_she;
					if (sex_address == "her")
						he_she = "she";
					else
						he_she = "he";
					or_date = or_date.split(" ")
					control_no = formatCtrlNo(control_no);


					//set value here
					$("#lbl_control_no_d_r").text(control_no);
					$("#lbl_or_no_d_r").text(or_no);
					$("#lbl_or_date_d_r").text(or_date[0]);
					$("#lbl_amount_d_r").text(or_amount);
					$("#lbl_addressD_r").text(address);
					$("#lbl_sexD_r").text(he_she);
					$("#lbl_sex2D_r").text(sex_address);
					$("#lbl_applicantD_r").text(applicant);

					//print here
					$("#fmbcert001d").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				}
				// E
				else if (request_paper == "Barangay Certificate Solo Parent") {
					var age, address, requestor, single_parent_category, child_name, chile_age, child_pwd, child_name_2, chile_age_2, child_pwd_2;
					var control_no, or_no, or_date, or_amount, applicant;
					$.each(response["barangay_certificate"], function() {
						control_no = this["CONTROL_NO"];
						or_no = this["OR_NO"];
						or_date = this["OR_DATE"];
						or_amount = this["OR_AMOUNT"];
						// fname = this["fname"];
						// mname = this["mname"];
						// lname = this["lname"];
						// applicant = fname + ' ' + mname + ' ' + lname
						applicant = this["RESIDENT_NAME"]
						age = this["AGE"];
						address = this["ADDRESS"];
						requestor = this["REQUESTOR_NAME"];
						single_parent_category = this["CATEGORY_SINGLE_PARENT"];

						child_pwd = this["IS_PWD"];

						child_pwd_2 = this["IS_PWD_2"];
						sex_address = this["SEX_ADDRESS"];
					});

					child_name = response['child'][0]["FIRSTNAME"] + ' ' + response['child'][0]["LASTNAME"]
					chile_age = getAge(response['child'][0]['DATE_OF_BIRTH'])
					if (response['child'].length == '2') {
						child_name_2 = response['child'][1]["FIRSTNAME"] + ' ' + response['child'][1]["FIRSTNAME"]
						chile_age_2 = getAge(response['child'][1]['DATE_OF_BIRTH'])

					} else {
						child_name_2 = ''
						chile_age_2 = ''
					}


					var he_she;
					if (sex_address == "her")
						he_she = "she";
					else
						he_she = "he";

					or_date = or_date.split(" ")
					control_no = formatCtrlNo(control_no);


					//set value here
					$("#lbl_control_no_e_r").text(control_no);
					$("#lbl_or_no_e_r").text(or_no);
					$("#lbl_or_date_e_r").text(or_date[0]);
					$("#lbl_amount_e_r").text(or_amount);
					$("#lbl_applicantE_r").text(applicant);
					$("#lbl_ageE_r").text(age);
					$("#lbl_addressE_r").text(address);
					$("#lbl_sex_e_r").text(he_she)
					$("#lbl_applicant2E_r").text(applicant);
					$("#lbl_single_parent_category_r").text(single_parent_category);
					$("#lbl_child_name1").text(child_name);
					$("#lbl_child_age1").text(chile_age);
					$("#lbl_child_pwd1").text(child_pwd);
					$("#lbl_child_name2").text(child_name_2);
					$("#lbl_child_age2").text(chile_age_2);
					$("#lbl_child_pwd2").text(child_pwd_2);
					$("#lbl_requestor_name_e_r").text(requestor);

					//print here
					$("#fmbcert001e").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				}
				// F
				else if (request_paper == "Barangay Certificate Indigency") {
					var age, civil_status, address, sex_address, purpose;
					var control_no, or_no, or_date, or_amount, applicant;
					$.each(response["barangay_certificate"], function() {

						control_no = this["CONTROL_NO"];
						or_no = this["OR_NO"];
						or_date = this["OR_DATE"];
						or_amount = this["OR_AMOUNT"];

						applicant = this["RESIDENT_NAME"];
						age = this["AGE"];
						civil_status = this["CIVIL_STATUS"].toLowerCase();
						address = this["ADDRESS"].toLowerCase();
						sex_address = this["SEX_ADDRESS"];
						purpose = this["PURPOSE"].toUpperCase();

					});
					or_date = or_date.split(" ")
					control_no = formatCtrlNo(control_no);

					//set value here

					$('#lbl_addressF_r').css('text-transform', 'capitalize');

					$('#lbl_applicantF_r').css('text-transform', 'capitalize');
					$("#lbl_control_no_f_r").text(control_no);
					$("#lbl_or_no_f_r").text(or_no);
					$("#lbl_or_date_f_r").text(or_date[0]);
					$("#lbl_amount_f_r").text(or_amount);
					$("#lbl_applicantF_r").text(applicant);
					$("#lbl_ageF_r").text(age);
					$("#lbl_civil_statusF_r").text(civil_status);
					$("#lbl_addressF_r").text(address);
					$("#lbl_sexF_r").text(sex_address);
					$("#lbl_purposeF_r").text(purpose);

					//print here
					$("#fmbcert001f").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				} else if (request_paper == "Barangay Certificate Travel") {
					var place_destination, dateStr, destination_address, travel_date, date_return, address;
					var control_no, or_no, or_date, or_amount, applicant;
					$.each(response["barangay_certificate"], function() {
						control_no = this["CONTROL_NO"];
						address = this["ADDRESS"];
						// fname = this["fname"];
						// mname = this["mname"];
						// lname = this["lname"];
						// applicant = fname + ' ' + mname + ' ' + lname
						applicant = this["RESIDENT_NAME"]
						place_destination = this["place_destination"];
						destination_address = this["destination_address"];
						travel_date = this["travel_date"];
						date_return = this["return_date"];
						purpose = this["PURPOSE"];
					});

					var d = new Date();
					var date = d.getDate();
					var month = d.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
					var year = d.getFullYear();
					dateStr = date + "/" + month + "/" + year;
					control_no = formatCtrlNo(control_no);

					//set value here
					$(".ctrl_no").text(control_no);
					$(".date_issued").text(dateStr);
					$(".itinerant_name").text(applicant);
					$(".address").text(address)
					$(".place_destination").text(place_destination);
					$(".destination_address").text(destination_address);
					$(".date_travel").text(travel_date);
					$(".return_date").text(date_return);
					$(".purpose_travel").text(purpose);


					//print here
					$("#fmbcqtp").printThis({
						debug: false,
						debug: false,
						importCSS: true,
						importStyle: true,
						loadCSS: "",
						pageTitle: "fdas",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});
				} else if (request_paper == "Barangay Clearance For Individual") {

					var family_name, first_name, middle_name, husbands_surname;

					$.each(response["barangay_certificate"], function() {
						var resident_id = this["RESIDENT_ID"];
						var str = this["RESIDENT_NAME"];
						var res = str.split(" ");
						fname = res[0];
						mname = res[1];
						lname = res[2];
						control_no = this['CONTROL_NO'];
						valid_until = this['VALID_UNTIL'];
						family_name = this['MAIDEN_NAME'] == null ? family_name = '' : family_name = this['MAIDEN_NAME'];
						gender = this['SEX'];
						civil_status = this['CIVIL_STATUS'];
						address = this['ADDRESS'];
						date_of_birth = this['DATE_OF_BIRTH'];
						place_of_birth = this['PLACE_OF_BIRTH'];
						citizenship = this['CITIZENSHIP'];
						civil_status = this['CIVIL_STATUS'];
						purpose = this['PURPOSE'];
						date_issued = this['ISSUED_DATE'];
						or_no = this['OR_NO'];

						amount = this['OR_AMOUNT'];
						remarks = this['REMARKS'];
						or_date = this['OR_DATE'];
						image = "{{asset('upload/residentspics/')}}/" + this['PROFILE_PICTURE'];
					});



					$('#lbl_family_name').css('text-transform', 'uppercase');
					$('#lbl_address').css('text-transform', 'uppercase');
					$('#lbl_place_of_birth').css('text-transform', 'uppercase');
					$('#lbl_citizenship').css('text-transform', 'uppercase');
					$('#lbl_civil_status').css('text-transform', 'uppercase');
					$('#lbl_gender').css('text-transform', 'uppercase');
					$('#lbl_purpose').css('text-transform', 'uppercase');
					$('#lbl_remarks').css('text-transform', 'uppercase');
					$('.profile_picture').attr('style', "width:200px; height:auto;");
					$('.profile_picture').attr('src', image);


					control_no = formatCtrlNo(control_no);
					adddress_cap = address.charAt(0).toUpperCase() + name.slice(1)
					var nextMonth = moment.addRealMonth(moment(date_issued)).format('YYYY-MM-DD');

					if (Object.keys(response['deregatory_record']).length == 0) {
						$('#lbl_remarks').text('NO DEREGATORY RECORD');
					} else {
						$.each(response['deregatory_record'], function() {

							$('#lbl_remarks').text('WITH PENDING CASE: ' + this['BLOTTER_CODE']);
						});

					}
					$('#lbl_control_no').text(control_no);
					$('#lbl_valid_until').text(nextMonth);
					$('#lbl_address').text(address);
					$('#lbl_date_of_birth').text(date_of_birth);
					$('#lbl_place_of_birth').text(place_of_birth);
					$('#lbl_citizenship').text(citizenship);
					$('#lbl_civil_status').text(civil_status);
					$('#lbl_gender').text(gender);

					//$('#lbl_issued_date').text(date_issued);
					$('#lbl_or_no').text(or_no);
					$('#lbl_or_dates').text(or_date);
					$('#lbl_amount').text(amount);
					$('#lbl_purpose').text(purpose);



					if (gender == "Female" && civil_status == "Married") {
						$('#lbl_family_name').text(family_name);
						$('#lbl_firstname').text(fname);
						$('#lbl_middle_name').text(mname);
						$('#lbl_husbands_name').text(lname);
					} else
					if (gender == "Male" && civil_status == "Married") {
						$('#lbl_family_name').text(lname);
						$('#lbl_firstname').text(fname);
						$('#lbl_middle_name').text(mname);
						$('#lbl_husbands_name').text(lname);
					} else {
						$('#lbl_family_name').text(lname);
						$('#lbl_firstname').text(fname);
						$('#lbl_middle_name').text(mname);
						$('#lbl_husbands_name').text('');
					}




					$("#fmbcfi").printThis({
						debug: false,

						importCSS: true,
						importStyle: true,
						loadCSS: "",
						removeInline: false,
						printDelay: 1000,
						header: null,
						footer: "",
						base: false,
						formValues: true,
						canvas: false,
						doctypeString: null,
						removeScripts: false,
						copyTagClasses: false
					});

				}

			},
			error: function(error) {
				console.log("error: " + error);
			}
		});

	});

	// for modal
	function hideModal() {
		$('#modal-Evaluate').modal('hide');
		$('#modal-PrintClearance').modal('hide');
	}
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