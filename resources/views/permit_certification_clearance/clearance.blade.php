@extends('global.main')

@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />

{{-- Wizard Form --}}
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/parsley.css') }}" rel="stylesheet" />



@endsection

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Permit/Certification/Clearance</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Request</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Clearance</a></li>
	</ol>

	<h1 class="page-header">Request Clearance <small>DILG Requirements</small></h1>



	<div class="panel panel-inverse">
		<!-- begin panel-heading -->
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
			</div>
			<h4 class="panel-title">Business</h4>
		</div>
		<!-- end panel-heading -->
		<div class="alert alert-yellow fade show">
			<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">×</span>
			</button>
			The following are the existing records of businesses in the barangay.
		</div>

		<!-- begin panel-body -->
		<div class="panel-body">
			<table id="tbl_business_lst" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th><center>Business Number</center></th>
						<th><center>Business Name</center></th>
						<th><center>Business Nature</center></th>
						<th><center>Address</center></th>
						<th><center>Owner's Name</center></th>
						<th><center>Status</center></th>
						
						<th><center>Action</center></th>
						<th hidden>Area</th>
						
						
						<th hidden>DTI Reg no.</th>
					</tr>
				</thead>
				<tbody>
					@foreach($approved_business as $row)
					<tr class="gradeC" id="{{$row->BUSINESS_ID}}">
						<td>{{$row->BUSINESS_OR_NUMBER}}</td>
						<td>{{$row->BUSINESS_NAME}}</td>
						<td>{{$row->BUSINESS_NATURE_NAME}}</td>
						<td>{{$row->BUSINESS_ADDRESS}}</td>
						<td>{{$row->BUSINESS_OWNER_FIRSTNAME}} {{$row->BUSINESS_OWNER_MIDDLENAME}} {{$row->BUSINESS_OWNER_LASTNAME}} </td>
						{{-- <td>{{$row->NEW_RENEW_STATUS}}</td> --}}
						@php
							$gross = DB::table('v_get_gross')
									->where('BUSINESS_ID',$row->BUSINESS_ID)
									->get();
						@endphp
									
						@if($row->NEW_RENEW_STATUS == "New")
						<td><h5><span class="label label-success">New Business</span></h5>
							<h6>Gross Receipt: ₱{{$gross[0]->GROSS_TOTAL}}</h6>
						</td>
						@else
						
						
						<td>
							<h5><span class="label label-purple">Renewed Business</span></h5>
							<h6>Gross Receipt: ₱{{$gross[0]->GROSS_TOTAL}}</h6>
							{{-- <label ></label> --}}
						</td>

						@endif
						<td>
							<button type="button" class="btn btn-primary form-control" id="btnChooseApplication"  data-toggle="modal">
								<i class="fa fa-file-alt">&nbsp</i> Request Business Clearance
							</button>
						</td>
						<td hidden> {{$row->BUSINESS_AREA}}</td>
						{{--
						<td hidden>{{$row->GROSS_RECEIPTS_ESSENTIAL}}</td>
						<td hidden>{{$row->GROSS_RECEIPTS_NON_ESSENTIAL}}</td>
						--}}
						<td hidden>{{$row->DTI_REGISTRATION_NO}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- end panel-body -->
	</div>  


	<div class="modal fade" id="modal-ChooseApplication" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background: #2A72B5" >
					<h4 class="modal-title" style="color: #fff">Issuance Request</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					{{-- <div class="panel-body"> --}}
						<h3><b><label id="lbl_business_name" >Business:</label></b></h3> <input type="text" id="txt_business_id" hidden> <input type="text" id="txt_form_type" hidden>
						<form>
							<div class="col-md-10">
								<label>Select Clearance:</label>
								<select class="form-control" id="sel_clearance_type" style="color: black;" >
									<option selected disabled value=""></option>
									<option hidden>Barangay Business Permit</option>
									<option>Barangay Clearance Building</option>
									<option>Barangay Clearance Business</option>
									<option>Barangay Clearance Zonal</option>
									<option>Barangay Clearance Tricycle</option>
									<option>Barangay Clearance General Purposes</option>	
									<option>Barangay Clearance Weights and Measure</option>
									<option>Barangay Clearance Fishery Rental and Privellege</option>
								</select>
							</div>
							{{-- Business Permit --}}
							<div class="col-md-10" id="divBusinessPermit">
								<legend class="m-t-10"></legend>
								<h5 id="divFilloutInstruction">Fill out the following information:</h5>

								<div class="row row-space-10">
									<div class="col-md-6">
										<div class="form-group m-b-10 p-t-5">
											<label>Tax Year</label>
											<input type="text" id="txt_tax_year" class="form-control" value="<?php echo date("Y"); ?>">

										</div>
										<div class="form-group m-b-10">
											<label>Quarter</label>
											<input type="text" id="txt_quarter" class="form-control">

										</div>
										<div class="form-group m-b-10">
											<label>Barangay Permit</label>
											<input type="text" id="txt_barangay_permit" class="form-control">
										</div>
										<div class="form-group m-b-10">
											<label>Business Tax</label>
											<input type="text" id="txt_business_tax" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group m-b-10 p-t-5">
											<label>Garbage Fee</label>
											<input type="text" id="txt_garbage_fee" class="form-control">
										</div>
										<div class="form-group m-b-10">
											<label>Signboard</label>
											<input type="text" id="txt_signboard" class="form-control">
										</div>
										<div class="form-group m-b-10">
											<label>CTC</label>
											<input type="text" id="txt_ctc" class="form-control">
										</div>
									</div>
								</div>
							</div>

							<div id="divBusinessPermit_message">
								<br>
								<div class="col-md-10" >
									<h4> The gross receipt sales is less than ₱30,000. Request for Business Permit <a href="{{route('RequestPermit')}}">here</a></h4>

								</div>
							</div>

							{{--  A - Clearance Building  --}}
							<div class="col-md-10" id="divClearanceBuilding">
								<legend class="m-t-10"></legend>
								<h5 id="divFilloutInstruction">Fill out the following information:</h5>
								<div class="form-group m-b-10 p-t-5">
									<label>Owner/Applicant</label>
									<input type="text" id="txt_owner_applicant_a" class="form-control" >

								</div>
								<div class="form-group m-b-10">
									<label>Address</label>
									<textarea id="txt_address_a" class="form-control"></textarea>

								</div>

								<div class="form-group m-b-10">
									<label>Scope of Work</label>
									<select class="form-control" id="sel_scope_of_work_a">
										<option disabled=""></option>
										<option>Construction</option>
										<option>Addition</option>
										<option>Repair</option>
										<option>Renovation</option>
										<option>Demolition</option>
										<option>Installation</option>
										<option>Attachment</option>
										<option>Painting</option>
									</select>

								</div>
								<div class="form-group m-b-10">
									<label>Scope of Work details</label>
									<textarea id="txt_scope_of_work_details_a" class="form-control" placeholder="Project Name and Wordings"></textarea>

								</div>

								<div class="form-group m-b-10">
									<label>Project Location</label>
									<input type="text" id="txt_project_location_a" class="form-control">
								</div>
							</div>

							

							{{-- B - Clearance Business --}}
							<div class="col-md-10" id="divClearanceBusiness">
								<legend class="m-t-10"></legend>
								<h5 id="divFilloutInstruction">Fill out the following information:</h5>
								<div class="form-group m-b-10 p-t-5">
									<label>Company Name</label>
									<input type="text" id="txt_company_name_b" class="form-control" >
								</div>
								<div class="form-group m-b-10">
									<label>Address</label>
									<textarea id="txt_address_b" class="form-control"></textarea>

								</div>
								<div class="form-group m-b-10" hidden>
									<label>Business Nature</label>
									<select class="form-control" id="sel_business_nature_b" data-parsley-required="true">
										<option>-- Nature of Business --</option>
										@foreach($business_nature as $row)
										<option id="{{$row->BUSINESS_NATURE_ID}}">{{$row->BUSINESS_NATURE_NAME}}</option>
										@endforeach

									</select>

								</div>								
							</div>

							{{-- C - Clearance Zonal --}}
							<div class="col-md-10" id="divClearanceZonal">
								<legend class="m-t-10"></legend>
								<h5 id="divFilloutInstruction">Fill out the following information:</h5>

								<br>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">OCT/TCT Number</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_oct_no_c">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Tax Declaration Number</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_tax_declaration_no_c">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Area</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_area_c">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Location</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_location_c">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Registered Owner</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_registered_owner_c">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Area Classification</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_area_classification_c">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Address</label>
									<div class="col-md-8">
										<textarea class="form-control" id="txt_address_c"></textarea>
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Purpose</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_purpose_c">
									</div>
								</div>
							</div>

							{{-- D - Clearance Tricycle --}}
							<div class="col-md-10" id="divClearanceTricycle">
								<legend class="m-t-10"></legend>
								<h5 id="divFilloutInstruction">Fill out the following information:</h5>

								<br>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Tricycle Operator</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_tricycle_operator_d">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Company Name</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_company_name_d">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Address</label>
									<div class="col-md-8">
										<textarea class="form-control" id="txt_address_d"></textarea>
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Driver’s License No</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_driver_license_d">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Mudguard/Body No</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_mudguard_d">
									</div>
								</div>
								<div class="form-group row m-b-10" hidden>
									<label class="col-md-4 col-form-label text-md-right">CR No</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_cr_d">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">OR No</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_or_d">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">OR Date</label>
									<div class="col-md-8">
										<input type="date"  class="form-control" id="txt_or_date_d">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Make</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_make">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Plate No</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_plate">
									</div>
								</div>

							</div>

							{{-- E - Clearance General Purpose --}}
							<div class="col-md-10" id="divClearanceGeneralPurpose">
								<legend class="m-t-10"></legend>
								<h5 id="divFilloutInstruction">Fill out the following information:</h5>

								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Company Name</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_company_name_e">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Address</label>
									<div class="col-md-8">
										<textarea class="form-control" id="txt_address_e"></textarea>
									</div>
								</div>

								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Activity</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_activity_e">
									</div>
								</div>
							</div>

							{{-- F - Clearance Weights and Measure  --}}
							<div class="col-md-10" id="divClearanceWeightsAndMeasure">
								<legend class="m-t-10"></legend>
								<h5 id="divFilloutInstruction">Fill out the following information:</h5>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Company Name</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_company_name_f">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Address</label>
									<div class="col-md-8">
										<textarea type="text" class="form-control" id="txt_address_f"></textarea>
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Registration No.</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_reg_no_f">
									</div>
								</div>
								
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">License No.</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_license_no_f">
									</div>
								</div>

								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Device Type</label>
									<div class="col-md-8">
										<input class="form-control" id="txt_device_type_f"/>
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Device Brand</label>
									<div class="col-md-8">
										<input class="form-control" id="txt_device_brand_f"/>
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Device Model</label>
									<div class="col-md-8">
										<input class="form-control" id="txt_device_model_f"/>
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Capacity</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_capacity_f">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Serial No.</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_serial_no_f">
									</div>
								</div>
							</div>

							{{-- Clearance Fishery Rental and Privellege --}}
							<div class="col-md-10" id="divClearanceFisheryAndPrivellege">
								<legend class="m-t-10"></legend>
								<h5 id="divFilloutInstruction">Fill out the following information:</h5>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Company Name</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_company_name_g">
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Address</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_address_g">
									</div>
								</div>
							</div>
							


							<div id="divApplicantName">
								<br><legend class="m-t-10"></legend>
								<div class="col-md-10" id="divBusinessPermit">
									<label>Applicant's Name</label>
									<input type="text" id="txt_applicant_name" class="form-control" style="background-color: white;font-weight: bold; color: black;">
								</div>
							</div>


						</form>
					{{-- </div> --}}
					<legend class="m-t-10"></legend>
					<div align="right">
						<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
						<button  class="btn btn-lime m-r-9" style="background: #2A72B5" id="btnRequest">Request</button>
					</div>		
				</div>
			</div>
		</div>
	</div>
	<input type="text" id="txt_gross_essential" hidden>
	<input type="text" id="txt_gross_nonessential" hidden>
	<input type="text" id="txt_business_nature" hidden>
</div>

@endsection

@section('page-js')

<script>
	var resident_id;
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		// $("table[id='tbl_business_lst']").DataTable();
		$("table[id='tbl_business_lst']").DataTable({
			"bSort" : false
		});

		//hide
		$('#divBusinessPermit').hide();
		$('#divClearanceBuilding').hide();
		$('#divClearanceBusiness').hide();
		$('#divClearanceZonal').hide();
		$('#divClearanceTricycle').hide();
		$('#divClearanceGeneralPurpose').hide();
		$('#divBusinessPermit_message').hide();
		$('#divClearanceWeightsAndMeasure').hide();
		$('#divClearanceFisheryAndPrivellege').hide();
	});

	$('#tbl_business_lst').on('click', '#btnChooseApplication',function (){
		let row = $(this).closest("tr")
		,resident_id =  $(row.find("td")[0]).text()
		,business_name =  $(row.find("td")[1]).text()
		,business_address = $(row.find("td")[3]).text()
		, business_owner = $(row.find("td")[4]).text()
		, business_nature = $(row.find("td")[2]).text()
		, business_area = $(row.find("td")[7]).text()
		, gross_essential = $(row.find("td")[8]).text()
		, gross_nonessential = $(row.find("td")[9]).text()
		, dti_reg = $(row.find("td")[10]).text()
		;
		
		
		$('#txt_applicant_name').val(business_owner);		
		$('#txt_business_nature').val(business_nature);
		$('#txt_gross_essential').val(gross_essential);
		$('#txt_gross_nonessential').val(gross_nonessential);
		//General
		$("#txt_business_id").val(row.attr("id"));
		$('#modal-ChooseApplication').modal('show');
		$('#lbl_business_name').text(business_name);

		//Clearance Building
		$("#txt_address_a").val(business_address);
		$("#txt_owner_applicant_a").val(business_owner);
		$("#txt_project_location_a").val(business_address)	

		//Clearance Business
		$('#sel_business_nature_b').val(business_nature).change();
		$("#txt_address_b").val(business_address);
		$('#txt_company_name_b').val(business_name);

		//Clearance Zonal
		$('#txt_registered_owner_c').val(business_owner);
		$('#txt_area_c').val(business_area);
		$('#txt_address_c').val(business_address);

		//Clearance Tricycle
		$('#txt_company_name_d').val(business_name);
		$('#txt_address_d').val(business_address);
		$('#txt_tricycle_operator_d').val(business_owner);
		$('#txt_cr_d').val(dti_reg)
		//Clearance General Purpose
		$('#txt_company_name_e').val(business_name);
		$('#txt_address_e').val(business_address);

		//Clearance Weight and Measure)
		$('#txt_company_name_f').val(business_name);
		$('#txt_address_f').val(business_address);

		//Clearance Fishery Rental and Privellege
		$('#txt_company_name_g').val(business_name);
		$('#txt_address_g').val(business_address);
	});

	$('#sel_clearance_type').on('change', function(){
		var clearance_type = $('#sel_clearance_type option:selected').text();

		if(clearance_type == "Barangay Business Permit"){
			$('#txt_form_type').val('Application Barangay Business Permit Form');
			//show
			$('#divBusinessPermit').show();
			//hide
			$('#divClearanceBuilding').hide();
			$('#divClearanceBusiness').hide();
			$('#divClearanceZonal').hide();
			$('#divClearanceTricycle').hide();
			$('#divClearanceGeneralPurpose').hide();
			$('#divClearanceWeightsAndMeasure').hide();
			$('#divClearanceFisheryAndPrivellege').hide();

		}

		else if (clearance_type == "Barangay Clearance Building"){
			$('#txt_form_type').val('Application Barangay Clearance Form');
			//show
			$('#divClearanceBuilding').show();
			//hide
			$('#divBusinessPermit').hide();
			$('#divClearanceBusiness').hide();
			$('#divClearanceZonal').hide();
			$('#divClearanceTricycle').hide();
			$('#divClearanceGeneralPurpose').hide();
			$('#divClearanceWeightsAndMeasure').hide();
			$('#divClearanceFisheryAndPrivellege').hide();


		}
		else if (clearance_type == "Barangay Clearance Business"){
			$('#txt_form_type').val('Application Barangay Clearance Form');
			//show
			// $('#divClearanceBusiness').show();

			//hide
			$('#divBusinessPermit').hide();
			$('#divClearanceBuilding').hide();
			$('#divClearanceZonal').hide();
			$('#divClearanceTricycle').hide();
			$('#divClearanceGeneralPurpose').hide();
			$('#divClearanceWeightsAndMeasure').hide();
			$('#divClearanceFisheryAndPrivellege').hide();

			//if Retailer 
			var ess, noness, total_gross, business_nature;
			ess = Number($('#txt_gross_essential').val());
			noness = Number($('#txt_gross_nonessential').val());
			total_gross = ess + noness;
			business_nature = $('#txt_business_nature').val();

			if(business_nature == "Retailer"){
				// total gross = 1-30,000
				if(total_gross < 30000 && total_gross >= 1){
					// $('#divBusinessPermit').show();
					$('#divClearanceBusiness').hide()
					$('#divBusinessPermit_message').show();
					console.log('business permit');
				}
				// total gross = 30,000 and above
				else if(total_gross > 30000){
					// $('#divBusinessPermit').hide();
					$('#divBusinessPermit_message').hide();

					$('#divClearanceBusiness').show();
					console.log('businessclearance');
				}
				// total gross = 0
				else if (total_gross == 0){
					$('#divClearanceBusiness').show();

				}
			}
			else{
					$('#divClearanceBusiness').show();

			}
			
		}
		else if (clearance_type == "Barangay Clearance Zonal"){
			$('#txt_form_type').val('Application Barangay Clearance Form');
			//show
			$('#divClearanceZonal').show();
			//hide
			$('#divBusinessPermit').hide();
			$('#divClearanceBuilding').hide();
			$('#divClearanceBusiness').hide();
			$('#divClearanceTricycle').hide();
			$('#divClearanceGeneralPurpose').hide();
			$('#divClearanceWeightsAndMeasure').hide();
			$('#divClearanceFisheryAndPrivellege').hide();

		}
		else if (clearance_type == "Barangay Clearance Tricycle"){
			$('#txt_form_type').val('Application Barangay Clearance Form');
			//show
			$('#divClearanceTricycle').show();

			//hide
			$('#divBusinessPermit').hide();
			$('#divClearanceBuilding').hide();
			$('#divClearanceBusiness').hide();
			$('#divClearanceZonal').hide();
			$('#divClearanceGeneralPurpose').hide();
			$('#divClearanceWeightsAndMeasure').hide();
			$('#divClearanceFisheryAndPrivellege').hide();

		}
		else if (clearance_type == "Barangay Clearance General Purposes"){
			$('#txt_form_type').val('Application Barangay Clearance Form');
			//show
			$('#divClearanceGeneralPurpose').show();
			
			//hide
			$('#divBusinessPermit').hide();
			$('#divClearanceBuilding').hide();
			$('#divClearanceBusiness').hide();
			$('#divClearanceZonal').hide();
			$('#divClearanceTricycle').hide();
			$('#divClearanceWeightsAndMeasure').hide();
			$('#divClearanceFisheryAndPrivellege').hide();

		}

		else if (clearance_type == "Barangay Clearance Weights and Measure"){
			$('#txt_form_type').val('Application Barangay Clearance Form');
			//show
			$('#divClearanceWeightsAndMeasure').show();
			//hide
			$('#divClearanceGeneralPurpose').hide();
			$('#divBusinessPermit').hide();
			$('#divClearanceBuilding').hide();
			$('#divClearanceBusiness').hide();
			$('#divClearanceZonal').hide();
			$('#divClearanceTricycle').hide();
			$('#divClearanceFisheryAndPrivellege').hide();

		}

		else if (clearance_type == "Barangay Clearance Fishery Rental and Privellege"){
			$('#txt_form_type').val('Application Barangay Clearance Form');
			//show
			$('#divClearanceFisheryAndPrivellege').show();
			
			//hide
			$('#divClearanceGeneralPurpose').hide();
			$('#divBusinessPermit').hide();
			$('#divClearanceBuilding').hide();
			$('#divClearanceBusiness').hide();
			$('#divClearanceZonal').hide();
			$('#divClearanceTricycle').hide();
			$('#divClearanceWeightsAndMeasure').hide();
			

		}
	});

	$('#btnRequest').on('click', function(){
		var clearance_type = $('#sel_clearance_type option:selected').text();
		var form_type = $('#txt_form_type').val();
		var business_id = $('#txt_business_id').val();
		// Business Permit Requirement
		var tax_year = $('#txt_tax_year').val()
		, quarter = $('#txt_quarter').val()
		, barangay_permit = $('#txt_barangay_permit').val()
		, garbage_fee = $('#txt_garbage_fee').val()
		, signboard = $('#txt_signboard').val()
		, ctc = $('#txt_ctc').val()
		, business_tax = $('#txt_business_tax').val()
		, applicant_name = $('#txt_applicant_name').val()
		, make = $('#txt_make').val()
		, plate_no = $('#txt_plate').val()
		

		let data = {
			'_token' : " {{ csrf_token() }}"
			,'TAX_YEAR' : tax_year
			,'QUARTER' : quarter
			,'BARANGAY_PERMIT' : barangay_permit 
			,'GARBAGE_FEE' : garbage_fee
			,'SIGNBOARD' : signboard
			,'CTC' : ctc
			,'BUSINESS_TAX' : business_tax
			
			//Building - A
			,'A_APPLICANT_NAME' : $("input[id='txt_owner_applicant_a']").val() // applicant name
			,'A_CONSTRUCTION_ADDRESS' : $('#txt_address_a').val() // address
			,'A_SCOPE_OF_WORK_NAME' : $("#sel_scope_of_work_a option:selected").text() //project name
			,'A_SCOPE_OF_WORK_SPECIFY' : $('#txt_scope_of_work_details_a').val() // project specify
			,'A_PROJECT_LOCATION' : $("input[id='txt_project_location_a']").val() // project location
			
			//Business - B
			,'B_REGISTERED_NAME' : $("input[id='txt_company_name_b']").val() //company name
			,'B_CONSTRUCTION_ADDRESS' : $('#txt_address_b').val() // address
			
			// Zonal - C
			,'C_OCT_TCT_NUMBER' : $("input[id='txt_oct_no_c']").val() //oct number
			,'C_TAX_DECLARATION' : $("input[id='txt_tax_declaration_no_c']").val() // tax declaration number
			,'C_BUSINESS_AREA' : $("input[id='txt_area_c']").val() //area 
			,'C_AREA_CLASSIFICATION' : $("input[id='txt_area_classification_c']").val() // area classification
			,'C_PROJECT_LOCATION' : $("input[id='txt_location_c']").val() //location
			,'C_PURPOSE' : $("input[id='txt_purpose_c']").val() //purpose
			,'C_APPLICANT_NAME' : $("input[id='txt_registered_owner_c']").val() //registered owner
			,'C_CONSTRUCTION_ADDRESS' : $('#txt_address_c').val() // address
			
			//Tricycle - D
			,'D_APPLICANT_NAME' : $("#txt_tricycle_operator_d").val() //tricycle operator
			,'D_REGISTERED_NAME' : $("#txt_company_name_d").val() // company
			,'D_CONSTRUCTION_ADDRESS' : $("#txt_address_d").val() // address
			,'D_DRIVER_LICENSE_NO' : $("#txt_driver_license_d").val()//driver's license
			,'D_MUDGUARD_NO' : $("#txt_mudguard_d").val()//mudguard no
			,'D_CR_NO' : $("#txt_cr_d").val()//cr no
			,'D_OR_NO' : $("#txt_or_d").val()//or no
			,'D_OR_DATE' : $('#txt_or_date_d').val() // or date
			,'D_MAKE' : make
			,'D_PLATE' : plate_no

			// General Purpose - E
			,'E_PURPOSE' : $("input[id='txt_activity_e']").val()
			,'E_REGISTERED_NAME' : $("input[id='txt_company_name_e']").val()
			,'E_CONSTRUCTION_ADDRESS' : $('#txt_address_e').val() // address

			// Weights and Measure - F
			,'F_REGISTRATION_NUMBER' : $("#txt_reg_no_f").val()
			,'F_REGISTERED_NAME' : $("#txt_company_name_f").val()
			,'F_CONSTRUCTION_ADDRESS' : $('#txt_address_f').val() // address
			,'F_LICENSE_NO' : $("#txt_license_no_f").val() // license no
			,'F_DEVICE_TYPE' : $("#txt_device_type_f").val() // device type
			,'F_CAPACITY' : $("#txt_capacity_f").val() // capacity
			,'F_SERIAL_NO' : $("#txt_serial_no_f").val() // serial no 
			,'F_BRAND' : $("#txt_device_brand_f").val() // serial no 
			,'F_MODEL' : $("#txt_device_model_f").val() // serial no 


			// Fishery Rental and Privellege
			,'G_REGISTERED_NAME' : $("input[id='txt_company_name_g']").val() // company name
			,'G_CONSTRUCTION_ADDRESS' : $("#txt_address_g").val() // address

			//General
			,'BUSINESS_ID' : business_id
			,'PAPER_TYPE_CLEARANCE' : clearance_type
			,'PAPER_TYPE_FORM' : form_type
			,'APPLICANT_NAME' : applicant_name


		};
		
		
		
		$.ajax({
			url : "{{ route('CRUDRequestClearance') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				swal({
					title: 'Success',
					text: 'Request Done!',
					icon: 'success',
				});

				window.location.reload();
				
			},
			error : function(error){
				console.log("error: " + error);
			}
		});	
	});


	// for modal
	function hideModal(){$('#modal-ChooseApplication').modal('hide');
		$('#sel_clearance_type').val('').change();
		$('#divBusinessPermit').hide();
		$('#divClearanceBuilding').hide();
		$('#divClearanceBusiness').hide();
		$('#divClearanceZonal').hide();
		$('#divClearanceTricycle').hide();
		$('#divClearanceGeneralPurpose').hide();
		$('#divClearanceWeightsAndMeasure').hide();
		$('#divBusinessPermit_message').hide();
		$('#divClearanceFisheryAndPrivellege').hide();
}
</script>


<script src="{{asset('custom/jasonday-printThis-edc43df/printThis.js')}}"></script>
{{-- Tables --}}
{{-- For table --}}
<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>
{{--Modals--}}
<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>
{{-- Wizard Form --}}

<script src="{{asset('assets/plugins/parsley/dist/parsley.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.js')}}"></script>
<script src="{{asset('assets/js/demo/form-wizards-validation.demo.min.js')}}"></script>

<script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>

@endsection
