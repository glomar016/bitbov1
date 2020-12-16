@extends('global.main')

@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />

{{-- Wizard Form --}}
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/parsley.css') }}" rel="stylesheet" />

{{-- Bootstrap Combobox --}}
{{-- <link href="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css') }}" rel="stylesheet" /> --}}
	{{-- <link href="../assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" /> --}}


@endsection

@section('content')

<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Business</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Business Registration</a></li>
		{{-- <li class="breadcrumb-item active">Wizards + Validation</li> --}}
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Business Registration<small></small></h1>
	<!-- end page-header -->

	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link" >

				<span class="d-sm-block d-none">Businesses</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >

				<span class="d-sm-block d-none">Add New Business</span>
			</a>
		</li>
	</ul>

	{{-- TAB CONTENT --}}
	<div class="tab-content">
		{{-- NAV PILLS TAB 1 --}}
		<div class="tab-pane fade active show" id="nav-pills-tab-1">
			<!-- begin panel -->
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
							@foreach($approved_business as $row)
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
							<h5><span class="label label-purple">Renewed Business</span></h5>
						</td>

						@endif
								<td>
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="">
										<i class="fa fa-eye"></i> View
									</button>
									<button type="button" class="btn btn-yellow" id="btnRenewOpen">
										<i class="fa fa-circle"></i> Renew
									</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
			</div>        	
		</div>
		{{-- NAV PILLS TAB 2 --}}
		<div class="tab-pane fade " id="nav-pills-tab-2">
			<div class="panel panel-inverse">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Business Application </h4> 
				</div>
				<!-- end panel-heading -->
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">×</span>
					</button>
					Fill out the following field for Business Application.
				</div>
				
				<!-- begin panel-body -->
				<div class="panel-body">
					<!-- begin wizard-form -->
					<form id="frm_Business" name="form-wizard" class="form-control-with-bg">
						<!-- begin wizard -->
						<div id="wizard">
							<!-- begin wizard-step -->
							<ul>
								<li class="col-md-3 col-sm-4 col-6">
									<a href="#step-1">
										<span class="number">1</span> 
										<span class="info text-ellipsis">
											Business Basic Info
											<small class="text-ellipsis">Business Name, Address, Business Type</small>
										</span>
									</a>
								</li>
								<li class="col-md-3 col-sm-4 col-6">
									<a href="#step-2">
										<span class="number">2</span> 
										<span class="info text-ellipsis">
											Business Activity
											<small class="text-ellipsis">Lines of business, Unit</small>
										</span>
									</a>
								</li>
								<li class="col-md-3 col-sm-4 col-6">
									<a href="#step-3">
										<span class="number">3</span>
										<span class="info text-ellipsis">
											Rented Business Place
											<small class="text-ellipsis">Lessor Name, Address, Monthly Rental</small>
										</span>
									</a>
								</li>
								<li class="col-md-3 col-sm-4 col-6">
									<a href="#step-4">
										<span class="number">4</span> 
										<span class="info text-ellipsis">
											Completed
											<small class="text-ellipsis">Complete Business Registration</small>
										</span>
									</a>
								</li>
							</ul>
							<!-- end wizard-step -->
							<!-- begin wizard-content -->
							<div>
								<!-- begin step-1 -->
								<div id="step-1">
									<!-- begin fieldset -->
									<fieldset>
										<!-- begin row -->
										<div class="row">
											<!-- begin col-8 -->
											<div class="col-md-8 offset-md-2">
												<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Business Basic Info</legend>
												<!-- begin form-group -->
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Business Number <span class="text-danger">*</span></label>
													<div class="col-md-6">
														<input type="text" placeholder="BSN-321938" data-parsley-group="step-1"  class="form-control"  id="txt_business_number" data-parsley-required="true"/>
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Business Name</label>
													<div class="col-md-6">
														<input type="text" placeholder="XYZ Computer Stuffs" data-parsley-group="step-1"  class="form-control"  id="txt_business_name" data-parsley-required="true"/>
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Trade Name <span class="text-danger">*</span></label>
													<div class="col-md-6">
														<input type="text" placeholder="XYZ Computer Stuffs" data-parsley-group="step-1"  class="form-control"  id="txt_trade_name" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Business Category <span class="text-danger" >*</span></label>
													<div class="col-md-6">
														<select class="form-control" id="sel_business_nature" data-parsley-required="true" >
															<option>-- Nature of Business --</option>
															@foreach($business_nature as $row)

															<option id="{{$row->BUSINESS_NATURE_ID}}">{{$row->BUSINESS_NATURE_NAME}}</option>
															@endforeach

														</select>
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Type of Business<span class="text-danger" >*</span></label>
													<div class="col-md-6">
														<select class="form-control" id="sel_business_type" data-parsley-required="true">
															<option >-- Type of Business --</option>
															<option value="Single">Single</option>
															<option value="Partnership">Partnership</option>
															<option value="Corporation">Corporation</option>
															<option value="Cooperative">Cooperative</option>
														</select>
													</div>
												</div>
												<!-- end form-group -->

												<!-- begin form-group -->
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Applicant/Tax Payer Name<span class="text-danger">*</span><span class="text-danger">&nbsp;</span></label>
													<div class="col-md-6">
														<div class="row row-space-6">
															<div class="col-4">
																{{-- <div class="col-md-6"> --}}
																	<input type="text" placeholder="First Name" data-parsley-group="step-1" class="form-control" id="txt_firstname" data-parsley-required="true"/>
																{{-- </div> --}}
															</div>
															<div class="col-4">
																{{-- <div class="col-md-6"> --}}
																	<input type="text" placeholder="Middle Name" data-parsley-group="step-1"  class="form-control" id="txt_middlename" />
																{{-- </div> --}}
															</div>
															<div class="col-4">
																{{-- <div class="col-md-6"> --}}
																	<input type="text" placeholder="Last Name" data-parsley-group="step-1"  class="form-control" id="txt_lastname" data-parsley-required="true"/>
																{{-- </div> --}}
															</div>
														</div>
													</div>
												</div>
												<!-- end form-group -->
												<!-- begin form-group -->
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">TIN No.</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_tin_no" data-mask="00/00/0000" data-mask-clearifnotmatch="true"/>
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">DTI/SEC/CDA Registration No.</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_dti_no" />
													</div>
												</div>
												<div class="form-group row m-b-10" hidden>
													<label class="col-md-3 col-form-label text-md-right">Business Address<span class="text-danger">*</span></label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_business_address" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Business Address<span class="text-danger">*</span><span class="text-danger">&nbsp;</span></label>
													<div class="col-md-6">
														<div class="row row-space-6">
															<div class="col-4">
																{{-- <div class="col-md-6"> --}}
																	<input type="text" placeholder="Building Number" data-parsley-group="step-1" class="form-control" id="txt_bldg_no">
																{{-- </div> --}}
															</div>
															<div class="col-4">
																{{-- <div class="col-md-6"> --}}
																	<input type="text" placeholder="Building Name" data-parsley-group="step-1"  class="form-control" id="txt_bldg_name" />
																{{-- </div> --}}
															</div>
															<div class="col-4">
																{{-- <div class="col-md-6"> --}}
																	<input type="text" placeholder="Unit Number" data-parsley-group="step-1"  class="form-control" id="txt_unit_no">
																{{-- </div> --}}
															</div>
														</div>
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right"><span class="text-danger"></span><span class="text-danger">&nbsp;</span></label>
													<div class="col-md-6">
														<div class="row row-space-6">
															<div class="col-4">
																{{-- <div class="col-md-6"> --}}
																	<input type="text" placeholder="Street" data-parsley-group="step-1" class="form-control" id="txt_street">
																{{-- </div> --}}
															</div>
															<div class="col-4">
																{{-- <div class="col-md-6"> --}}
																	<input type="text" placeholder="Sitio" data-parsley-group="step-1"  class="form-control" id="txt_sitio" />
																{{-- </div> --}}
															</div>
															<div class="col-4">
																{{-- <div class="col-md-6"> --}}
																	<input type="text" placeholder="Subdivision" data-parsley-group="step-1"  class="form-control" id="txt_subdivision"/>
																{{-- </div> --}}
															</div>
														</div>
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Business Postal<span class="text-danger">*</span></label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_business_postal" data-parsley-required="true"/>
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Business Email Address</label>
													<div class="col-md-6">
														<input type="email" name="email" placeholder="someone@example.com" data-parsley-type="email" class="form-control" data-parsley-group="step-1" id="txt_business_email"/>
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Business Telephone No.</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_business_telephone" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Business Mobile No.</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_business_mobile" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Owner Address</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_owner_address" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Owner Postal</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_owner_postal"/>
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Owner Email Address</label>
													<div class="col-md-6">
														<input type="email" name="email" placeholder="someone@example.com" data-parsley-type="email" class="form-control" data-parsley-group="step-1" id="txt_owner_email" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Owner Telephone No.</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_owner_telephone" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Owner Mobile No.</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_owner_mobile" />
													</div>
												</div>
												<!-- begin form-group -->
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Number of Employees<span class="text-danger">&nbsp;</span></label>
													<div class="col-md-6">
														<div class="row row-space-6">

															<div class="col-6">
																{{-- <div class="col-md-6"> --}}
																	<input type="text" placeholder="Total number of employees in Establishment" data-parsley-group="step-1" class="form-control" id="txt_employee_establishment" />
																{{-- </div> --}}
															</div>
															<div class="col-6">
																{{-- <div class="col-md-6"> --}}
																	<input type="text" placeholder="Number of employees residing within LGU" data-parsley-group="step-1"  class="form-control" id="txt_employee_lgu" />
																{{-- </div> --}}
															</div>
														</div>
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Business Area</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_business_area" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Emergency Contact Person</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_emergency_contact_person" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Emergency Contact Person's Contact No</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_emergency_person_contact" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Emergency Contact Person's Email</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_emergency_person_email" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Date Acquired</label>
													<div class="col-md-6">
														<input type="date" placeholder="" class="form-control" data-parsley-group="step-1" id="txt_date_acquired" />
													</div>
												</div>
												<!-- end form-group -->
											</div>
											<!-- end col-8 -->

											<div class="col-md-8 offset-md-2">

											</div>
										</div>

										<!-- end row -->
									</fieldset>
									<!-- end fieldset -->
								</div>
								<!-- end step-1 -->
								<!-- begin step-2 -->
								<div id="step-2">
									<!-- begin fieldset -->
									<fieldset>
										<!-- begin row -->
										<div class="row">
											<div class="col-md-8 offset-md-2">
												<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Business Activity</legend>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right" data-parsley-required="true">Line of Business<span class="text-danger">*</span></label>
													<div class="col-md-6">
														<select class="form-control" id="sel_line_of_business">
															<option>-- Line of Business --</option>
															@foreach($line_of_business as $row)
															<option id="{{$row->LINE_OF_BUSINESS_ID}}">{{$row->LINE_OF_BUSINESS_NAME}}</option>
															@endforeach

														</select>
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">No of. Unit</label>
													<div class="col-md-6">
														<input type="number" placeholder="" class="form-control" data-parsley-group="step-2" id="txt_no_unit" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Capitalization (New Business)</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-2" id="txt_capitalization" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Gross/Sales Receipts Essential(For Renewal)</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-2" id="txt_sales_receipt_essential" readonly hidden />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Gross/Sales Receipts Non-Essential (For Renewal)</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-2" id="txt_sales_receipt_nonessential" readonly hidden />
													</div>
												</div>
											</div>
										</div>
										<!-- end row -->
									</fieldset>
									<!-- end fieldset -->
								</div>
								<!-- end step-2 -->
								<!-- begin step-3 -->
								<div id="step-3">
									<!-- begin fieldset -->
									<fieldset>
										<!-- begin row -->
										<div class="row">
											<!-- begin col-8 -->
											<div class="col-md-8 offset-md-2">
												<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Note:  Fill up only if business place is rented/not owned</legend>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Lessor Full Name</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-3" id="txt_lessor_name" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Lessor/Owner Address</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-3" id="txt_lessor_address" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Lessor/Owner Postal</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-3" id="txt_lessor_postal" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Lessor/Owner Email Address</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-3" id="txt_lessor_email" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Lessor/Owner Telephone No.</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-3" id="txt_lessor_telephone" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Lessor/Owner Mobile No.</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-3" id="txt_lessor_mobile" />
													</div>
												</div>
												<div class="form-group row m-b-10">
													<label class="col-md-3 col-form-label text-md-right">Monthly Rental</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" data-parsley-group="step-3" id="txt_monthly_rental" />
													</div>
												</div>
											</div>
											<!-- end col-8 -->
										</div>
										<!-- end row -->
									</fieldset>
									<!-- end fieldset -->
								</div>
								<!-- end step-3 -->
								<!-- begin step-4 -->
								<div id="step-4">
									<div class="jumbotron m-b-0 text-center">
										<h2 class="text-inverse">Register Successfully</h2>
										<p class="m-b-30 f-s-16">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat commodo porttitor. <br />Vivamus eleifend, arcu in tincidunt semper, lorem odio molestie lacus, sed malesuada est lacus ac ligula. Aliquam bibendum felis id purus ullamcorper, quis luctus leo sollicitudin. </p>
										<p><a id="btnSubmitBusiness" href="#" class="btn btn-primary btn-lg">Proceed to Business Profile</a></p>
									</div>
								</div>
								<!-- end step-4 -->
							</div>
							<!-- end wizard-content -->
						</div>
						<!-- end wizard -->
					</form>
					<!-- end wizard-form -->
				</div>
				<!-- end panel-body -->
			</div> 
		</div>

		

	</div>
	{{-- TAB CONTENT --}}
	<div class="modal fade" id="modal-Renew" data-backdrop="static">
		<div class="modal-dialog" style="max-width: 50%">
			<form id="EditForm">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #ffd900">
						<h4 class="modal-title" style="color: black">Renew Business</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
					</div>
					<div class="modal-body">
						<input type="text" id="txt_business_id" hidden><h3><label id="lbl_business_name">WBB Toy Shop</label></h3>
						{{--modal body start--}}
						<h4>Business Details</h4>
						{{-- 1 --}}
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_buiness_number_renew">Business Number<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_buiness_number_renew"  placeholder="" readonly value="XXXXX-XXXXX" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_business_name_renew">Business Name<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_business_name_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_trade_name_renew">Trade Name<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_trade_name_renew"  placeholder=""  />
								</div>
							</div>
						</div> <br>
						{{-- 2 --}}
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Type of Business<span class="text-danger"></span></label> 
									<select class="form-control" id="sel_business_type_renew" data-parsley-required="true">
                                        <option >-- Type of Business --</option>
                                        <option value="Single">Single</option>
                                        <option value="Partnership">Partnership</option>
                                        <option value="Corporation">Corporation</option>
                                        <option value="Cooperative">Cooperative</option>
                                    </select>

								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">TIN No.<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_tin_no_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">DTI/SEC/CDA Registration No.<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_dti_renew"  placeholder=""  />
								</div>
							</div>
						</div> <br>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Address<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_building_number_renew"  placeholder="Building Number"  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">&nbsp <span class="text-danger"></span></label> 
									<input class="form-control" id="txt_building_name_renew"  placeholder="Building Name"  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_"> &nbsp  <span class="text-danger">  </span></label> 
									<input class="form-control" id="txt_unit_no_renew"  placeholder="Unit Number"  />
								</div>
							</div>
						</div> 
						<div class="row">
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_"><span class="text-danger"></span></label> 
									<input class="form-control" id="txt_street_renew"  placeholder="Street"  />
								</div>
							</div>
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_"><span class="text-danger"></span></label> 
									<input class="form-control" id="txt_sitio_renew"  placeholder="Sitio"  />
								</div>
							</div>
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_"><span class="text-danger"></span></label> 
									<input class="form-control" id="txt_subdivision_renew"  placeholder="Subdivision"  />
								</div>
							</div>
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_"><span class="text-danger"></span></label> 
									<input class="form-control" id="txt_postal_renew"  placeholder="Postal"  />
								</div>
							</div>
						</div> <br>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Business Email Address<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_business_email_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Business Telephone No.<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_business_telephone_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Business Mobile No.<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_business_mobile_renew"  placeholder=""  />
								</div>
							</div>
						</div> <br>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Total number of employees in Establishment<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_total_employee_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Number of employees residing within LGU<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_total_lgu_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Business Area<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_business_area_renew"  placeholder=""  />
								</div>
							</div>
						</div> <br>
						<h4>Owner Information</h4>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">First Name<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_owner_firstname_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Middle Name<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_middlename_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Last Name<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_lastname_renew"  placeholder=""  />
								</div>
							</div>
						</div> <br>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Owner Address<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_owner_address_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Owner Postal<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_owner_postal_renew"  placeholder=""  />
								</div>
							</div>
						</div> <br>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Owner Email Address<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_owner_email_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Owner Telephone No.<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_owner_telephone_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Owner Mobile No.<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_owner_mobile_renew"  placeholder=""  />
								</div>
							</div>
						</div> <br>
						<h4>Incase of emergency</h4>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Emergency Contact Person<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_emergency_contact_person_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Emergency Contact Person's Contact No<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_emergency_person_contact_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Emergency Contact Person's Email<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_emergency_person_email_renew"  placeholder=""  />
								</div>
							</div>
						</div> <br>
						<h4>Business Activity</h4>
						<div class="row">
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_">Line of Business<span class="text-danger"></span></label> 
									{{-- <input class="form-control" id="txt_"  placeholder=""  /> --}}
									<select class="form-control" id="sel_line_of_business_renew">
                                        <option>-- Line of Business --</option>
                                        @foreach($line_of_business as $row)
                                        <option id="{{$row->LINE_OF_BUSINESS_ID}}">{{$row->LINE_OF_BUSINESS_NAME}}</option>
                                        @endforeach

                                    </select>
								</div>
							</div>
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_">No of. Unit<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_no_unit_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_">Gross/Sales Receipts Essential<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_gross_essential_renew"  placeholder=""  />
								</div>
							</div>
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_">Gross/Sales Receipts Non-Essential<span class="text-danger"></span></label> 
									<input class="form-control" id="txt_gross_nonessential_renew"  placeholder=""  />
								</div>
							</div>
						</div> <br>
						<h4>Rented Business Place</h4>
						<div class="divRent">
							<div class="row">
								<div class="col-lg-4 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Full Name<span class="text-danger"></span></label> 
										<input class="form-control" id="txt_lessor_name_renew"  placeholder=""  />
									</div>
								</div>
								<div class="col-lg-4 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Address<span class="text-danger"></span></label> 
										<input class="form-control" id="txt_lessor_Address_renew"  placeholder=""  />
									</div>
								</div>
								<div class="col-lg-4 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Postal<span class="text-danger"></span></label> 
										<input class="form-control" id="txt_lessor_postal_renew"  placeholder=""  />
									</div>
								</div>
							</div> <br>

							<div class="row">
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Email Address <span class="text-danger"></span></label> 
										<input class="form-control" id="txt_lessor_email_renew"  placeholder=""  />
									</div>
								</div>
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Telephone No.<span class="text-danger"></span></label> 
										<input class="form-control" id="txt_lessor_telephone_renew"  placeholder=""  />
									</div>
								</div>
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Mobile No.<span class="text-danger"></span></label> 
										<input class="form-control" id="txt_lessor_mobile_renew"  placeholder=""  />
									</div>
								</div>
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label for="txt_">Monthly Rental<span class="text-danger"></span></label> 
										<input class="form-control" id="txt_monthly_rental_renew"  placeholder=""  />
									</div>
								</div>
							</div> <br>
						</div>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<a id="btnBusinessRenewal" href="javascript:;" class="btn btn-yellow">Renew</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end #content -->



@endsection

@section('page-js')

<script>
	$(document).ready(function() {
		App.init();
		FormWizardValidation.init();
		TableManageDefault.init();
			// FormPlugins.init();

		$('#tbl_business_lst').DataTable();
	});

	$('#btnBusinessRenewal').on('click', function(){
		
		var   BusinessNumber = $('#txt_buiness_number_renew').val()
			, BusinessName = $('#txt_business_name_renew').val()
			, TradeName = $('#txt_trade_name_renew').val()
			, BusinessType  = $('#sel_business_type_renew option:selected').text()
			, FirstName =  $('#txt_owner_firstname_renew').val()
			, MiddleName =  $('#txt_middlename_renew').val()
			, LastName =  $('#txt_lastname_renew').val()
			, TinNo =  $('#txt_tin_no_renew').val()
			, DtiNo =  $('#txt_dti_renew').val()
			, BusinessPostal =  $('#txt_postal_renew').val()
			, BusinessEmail =  $('#txt_business_email_renew').val()
			, BusinessTelNo =  $('#txt_business_telephone_renew').val()
			, BusinessMobileNo =  $('#txt_business_mobile_renew').val()
			, OwnerAddress =  $('#txt_owner_address_renew').val()
			, OwnerPostal =  $('#txt_owner_postal_renew').val()
			, OwnerEmail =  $('#txt_owner_email_renew').val()
			, OwnerTelNo =  $('#txt_owner_telephone_renew').val()
			, OwnerMobileNo =  $('#txt_owner_mobile_renew').val()
			, EmployeeEstablishment =  $('#txt_total_employee_renew').val()
			, EmployeeLgu =  $('#txt_total_lgu_renew').val()
			, BusinessArea =  $('#txt_business_area_renew').val()
			, EmergencyPerson = $('#txt_emergency_contact_person_renew').val()
			, EmergencyPersonContact = $('#txt_emergency_person_contact_renew').val()
			, EmergencyPersonEmail =$('#txt_emergency_person_email_renew').val()
			, LineOfBusiness  = $('#sel_line_of_business_renew').children(':selected').attr("id")
			, NoUnit =  $('#txt_no_unit_renew').val()
			, SalesReceiptEssential =  $('#txt_gross_essential_renew').val()
			, SalesReceiptNonEssential =  $('#txt_gross_nonessential_renew').val()
			, LessorName = $('#txt_lessor_name_renew').val()
			, LessorAddress =  $('#txt_lessor_Address_renew').val()
			, LessorPostal =  $('#txt_lessor_postal_renew').val()
			, LessorEmail =  $('#txt_lessor_email_renew').val()
			, LessorTelephone =  $('#txt_lessor_telephone_renew').val()
			, LessorMobile =  $('#txt_lessor_mobile_renew').val()
			, MonthlyRental =  $('#txt_monthly_rental_renew').val()
			// Business Address
			, BuildingNumber = $('#txt_building_number_renew').val()
			, BuildingName = $('#txt_building_name_renew').val()
			, UnitNo = $('#txt_unit_no_renew').val()
			, Street = $('#txt_street_renew').val()
			, Sitio = $('#txt_sitio_renew').val()
			, Subdivision = $('#txt_subdivision_renew').val()

			, BusinessID = $('#txt_business_id').val()
			;

		let data = {
			'_token' : " {{ csrf_token() }}"
			,'BUSINESS_NAME' : BusinessName
			,'TRADE_NAME' : TradeName
			,'BUSINESS_OWNER_FIRSTNAME' : FirstName
			,'BUSINESS_OWNER_MIDDLENAME' : MiddleName
			,'BUSINESS_OWNER_LASTNAME' : LastName
			,'BUSINESS_OR_NUMBER' : BusinessNumber
			,'TIN_NO' : TinNo
			,'DTI_REGISTRATION_NO' : DtiNo
			,'TYPE_OF_BUSINESS' : BusinessType
			,'BUSINESS_POSTAL_CODE' : BusinessPostal
			,'BUSINESS_EMAIL_ADD' : BusinessEmail
			,'BUSINESS_TELEPHONE_NO' : BusinessTelNo
			,'BUSINESS_MOBILE_NO' : BusinessMobileNo
			,'OWNER_ADDRESS' : OwnerAddress
			,'OWNER_POSTAL_CODE' : OwnerPostal
			,'OWNER_EMAIL_ADD' : OwnerEmail
			,'OWNER_TELEPHONE_NO' : OwnerTelNo
			,'OWNER_MOBILE_NO' : OwnerMobileNo
			,'EMERGENCY_CONTACT_PERSON' : EmergencyPerson
			,'EMERGENCY_PERSON_CONTACT_NO' : EmergencyPersonContact
			,'EMERGENCY_PERSON_EMAIL_ADD' : EmergencyPersonEmail
			,'BUSINESS_AREA' : BusinessArea
			,'NO_EMPLOYEE_ESTABLISHMENT' : EmployeeEstablishment
			,'NO_EMPLOYEE_LGU' : EmployeeLgu
			,'LESSOR_NAME' : LessorName
			,'LESSOR_ADDRESS' : LessorAddress
			,'LESSOR_CONTACT_NO' : LessorTelephone
			,'LESSOR_EMAIL_ADD' : LessorEmail
			,'MONTHLY_RENTAL' : MonthlyRental
			,'LINE_OF_BUSINESS_ID' : LineOfBusiness		
			,'NO_OF_UNITS' : NoUnit
			,'GROSS_RECEIPTS_ESSENTIAL' : SalesReceiptEssential
			,'GROSS_RECEIPTS_NON_ESSENTIAL' : SalesReceiptNonEssential
			// BUSINESS ADDRESS
			,'BUILDING_NUMBER' : BuildingNumber
			,'BUILDING_NAME' : BuildingName
			,'UNIT_NO' : UnitNo
			,'STREET' : Street
			,'SITIO' : Sitio
			,'SUBDIVISION' : Subdivision 
			// ADDED
			,'REFERENCED_BUSINESS_ID': BusinessID
			,'NEW_RENEW_STATUS': 'Renew'
		};

		console.log(data);


		$.ajax({
			url : "{{ route('CRUDBusinessApplication') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				swal({
					title: 'Success',
					text: 'Saved Record!',
					icon: 'success',
				});


			},
			error : function(error){
				console.log("error: " + error);
			}
		});	
	});


	$('#frm_Business').on('click', '#btnSubmitBusiness', function(){
		var   BusinessNumber = $('#txt_business_number').val()
		, BusinessName = $('#txt_business_name').val()
		, TradeName = $('#txt_trade_name').val()
		, BusinessType  = $('#sel_business_type option:selected').text()
		, BusinessNature  = $('#sel_business_nature').children(':selected').attr("id")
		, FirstName =  $('#txt_firstname').val()
		, MiddleName =  $('#txt_middlename').val()
		, LastName =  $('#txt_lastname').val()
		, TinNo =  $('#txt_tin_no').val()
		, DtiNo =  $('#txt_dti_no').val()
		, BusinessAddress =  $('#txt_business_address').val()
		, BusinessPostal =  $('#txt_business_postal').val()
		, BusinessEmail =  $('#txt_business_email').val()
		, BusinessTelNo =  $('#txt_business_telephone').val()
		, BusinessMobileNo =  $('#txt_business_mobile').val()
		, OwnerAddress =  $('#txt_owner_address').val()
		, OwnerPostal =  $('#txt_owner_postal').val()
		, OwnerEmail =  $('#txt_owner_email	').val()
		, OwnerTelNo =  $('#txt_owner_telephone').val()
		, OwnerMobileNo =  $('#txt_owner_mobile').val()
		, EmployeeEstablishment =  $('#txt_employee_establishment').val()
		, EmployeeLgu =  $('#txt_employee_lgu').val()
		, BusinessArea =  $('#txt_business_area').val()
		, EmergencyPerson = $('#txt_emergency_contact_person').val()
		, EmergencyPersonContact = $('#txt_emergency_person_contact').val()
		, EmergencyPersonEmail =$('#txt_emergency_person_email').val()
		, LineOfBusiness  = $('#sel_line_of_business').children(':selected').attr("id")
		, NoUnit =  $('#txt_no_unit').val()
		, Capitalization =  $('#txt_capitalization').val()
		, SalesReceiptEssential =  $('#txt_sales_receipt_essential').val()
		, SalesReceiptNonEssential =  $('#txt_sales_receipt_nonessential').val()
		, LessorName = $('#txt_lessor_name').val()
		, LessorAddress =  $('#txt_lessor_address').val()
		, LessorPostal =  $('#txt_lessor_postal').val()
		, LessorEmail =  $('#txt_lessor_email').val()
		, LessorTelephone =  $('#txt_lessor_telephone').val()
		, LessorMobile =  $('#txt_lessor_mobile').val()
		, MonthlyRental =  $('#txt_monthly_rental').val()
		, DateAcquired = $('#txt_date_acquired').val()
		// Business Address
		, BuildingNumber = $('#txt_bldg_no').val()
		, BuildingName = $('#txt_bldg_name').val()
		, UnitNo = $('#txt_unit_no').val()
		, Street = $('#txt_street').val()
		, Sitio = $('#txt_sitio').val()
		, Subdivision = $('#txt_subdivision').val()
		;

		
		let data = {
			'_token' : " {{ csrf_token() }}"
			,'BUSINESS_NAME' : BusinessName
			,'TRADE_NAME' : TradeName
			,'BUSINESS_NATURE_ID' : BusinessNature
			,'BUSINESS_OWNER_FIRSTNAME' : FirstName
			,'BUSINESS_OWNER_MIDDLENAME' : MiddleName
			,'BUSINESS_OWNER_LASTNAME' : LastName
			,'BUSINESS_ADDRESS' : BusinessAddress
			,'BUSINESS_OR_NUMBER' : BusinessNumber
			,'TIN_NO' : TinNo
			,'DTI_REGISTRATION_NO' : DtiNo
			,'TYPE_OF_BUSINESS' : BusinessType
			,'BUSINESS_POSTAL_CODE' : BusinessPostal
			,'BUSINESS_EMAIL_ADD' : BusinessEmail
			,'BUSINESS_TELEPHONE_NO' : BusinessTelNo
			,'BUSINESS_MOBILE_NO' : BusinessMobileNo
			,'OWNER_ADDRESS' : OwnerAddress
			,'OWNER_POSTAL_CODE' : OwnerPostal
			,'OWNER_EMAIL_ADD' : OwnerEmail
			,'OWNER_TELEPHONE_NO' : OwnerTelNo
			,'OWNER_MOBILE_NO' : OwnerMobileNo
			,'EMERGENCY_CONTACT_PERSON' : EmergencyPerson
			,'EMERGENCY_PERSON_CONTACT_NO' : EmergencyPersonContact
			,'EMERGENCY_PERSON_EMAIL_ADD' : EmergencyPersonEmail
			,'BUSINESS_AREA' : BusinessArea
			,'NO_EMPLOYEE_ESTABLISHMENT' : EmployeeEstablishment
			,'NO_EMPLOYEE_LGU' : EmployeeLgu
			,'LESSOR_NAME' : LessorName
			,'LESSOR_ADDRESS' : LessorAddress
			,'LESSOR_CONTACT_NO' : LessorTelephone
			,'LESSOR_TELEPHONE' : LessorTelephone
			,'LESSOR_MOBILE_NO' : LessorMobile
			,'LESSOR_EMAIL_ADD' : LessorEmail
			,'MONTHLY_RENTAL' : MonthlyRental
			,'BUSINESS_OR_ACQUIRED_DATE' : DateAcquired
			,'LINE_OF_BUSINESS_ID' : LineOfBusiness		
			,'NO_OF_UNITS' : NoUnit
			,'CAPITALIZATION' : Capitalization
			,'GROSS_RECEIPTS_ESSENTIAL' : SalesReceiptEssential
			,'GROSS_RECEIPTS_NON_ESSENTIAL' : SalesReceiptNonEssential
			// BUSINESS ADDRESS
			,'BUILDING_NUMBER' : BuildingNumber
			,'BUILDING_NAME' : BuildingName
			,'UNIT_NO' : UnitNo
			,'STREET' : Street
			,'SITIO' : Sitio
			,'SUBDIVISION' : Subdivision 
			,'NEW_RENEW_STATUS': 'New'
		};

		$.ajax({
			url : "{{ route('CRUDBusinessApplication') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				swal({
					title: 'Success',
					text: 'Saved Record!',
					icon: 'success',
				});


			},
			error : function(error){
				console.log("error: " + error);
			}
		});	
	
	});


	$('#tbl_business_lst').on('click', '#btnRenewOpen', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();
		$('#modal-Renew').modal('show');
		$('#txt_business_id').val(row.attr("id"));
		var business_id = row.attr("id");


		let data = {
			'_token' : " {{ csrf_token() }}"
			,'BUSINESS_ID' : business_id
		};

		$.ajax({
			url : "{{ route('SpecificBusinessApplication') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				$.each(response["specific_business"], function(){
					$('#txt_business_name_renew').val(this["BUSINESS_NAME"]);
					$('#txt_buiness_number_renew').val(this["BUSINESS_OR_NUMBER"]);
					$('#txt_tin_no_renew').val(this["TIN_NO"]);
					$('#txt_dti_renew').val(this["DTI_REGISTRATION_NO"]);
					$('#txt_building_number_renew').val(this["BUILDING_NUMBER"]);
					$('#txt_building_name_renew').val(this["BUILDING_NAME"]);
					$('#txt_unit_no_renew').val(this["UNIT_NO"]);
					$('#txt_street_renew').val(this["STREET"]);
					$('#txt_sitio_renew').val(this["SITIO"]);
					$('#txt_subdivision_renew').val(this["SUBDIVISION"]);
					$('#txt_postal_renew').val(this["BUSINESS_POSTAL_CODE"]);
					$('#txt_business_email_renew').val(this["BUSINESS_EMAIL_ADD"]);
					$('#txt_business_telephone_renew').val(this["BUSINESS_TELEPHONE_NO"]);
					$('#txt_business_mobile_renew').val(this["BUSINESS_MOBILE_NO"]);
					$('#txt_total_employee_renew').val(this["NO_EMPLOYEE_ESTABLISHMENT"]);
					$('#txt_total_lgu_renew').val(this["NO_EMPLOYEE_LGU"]);
					$('#txt_owner_firstname_renew').val(this["BUSINESS_OWNER_FIRSTNAME"]);
					$('#txt_middlename_renew').val(this["BUSINESS_OWNER_MIDDLENAME"]);
					$('#txt_lastname_renew').val(this["BUSINESS_OWNER_LASTNAME"]);
					$('#txt_owner_address_renew').val(this["OWNER_ADDRESS"]);
					$('#txt_owner_postal_renew').val(this["OWNER_POSTAL_CODE"]);
					$('#txt_owner_email_renew').val(this["OWNER_EMAIL_ADD"]);
					$('#txt_owner_telephone_renew').val(this["OWNER_TELEPHONE_NO"]);
					$('#txt_owner_mobile_renew').val(this["OWNER_MOBILE_NO"]);
					$('#txt_emergency_contact_person_renew').val(this["EMERGENCY_CONTACT_PERSON"]);
					$('#txt_emergency_person_contact_renew').val(this["EMERGENCY_PERSON_CONTACT_NO"]);
					$('#txt_emergency_person_email_renew').val(this["EMERGENCY_PERSON_EMAIL_ADD"]);
					$('#txt_no_unit_renew').val(this["NO_OF_UNITS"]);
					$('#txt_gross_essential_renew').val(this["GROSS_RECEIPTS_ESSENTIAL"]);
					$('#txt_gross_nonessential_renew').val(this["GROSS_RECEIPTS_NON_ESSENTIAL"]);
					$('#txt_lessor_name_renew').val(this["LESSOR_NAME"]);
					$('#txt_lessor_Address_renew').val(this["LESSOR_ADDRESS"]);
					$('#txt_lessor_postal_renew').val(this["LESSOR_POSTAL"]);
					$('#txt_lessor_email_renew').val(this["LESSOR_EMAIL_ADD"]);
					$('#txt_lessor_telephone_renew').val(this["LESSOR_TELEPHONE"]);
					$('#txt_lessor_mobile_renew').val(this["LESSOR_MOBILE_NO"]);
					$('#txt_monthly_rental_renew').val(this["MONTHLY_RENTAL"]);
					$('#sel_line_of_business_renew').val(this["LINE_OF_BUSINESS_NAME"]).change();
					$('#sel_business_type_renew').val(this["TYPE_OF_BUSINESS"]).change();
					$('#lbl_business_name').text(this["BUSINESS_NAME"]);

					// KULANG
					$('#txt_trade_name_renew').val(this["TRADE_NAME"]);
					$('#txt_business_area_renew').val(this["BUSINESS_AREA"]);
					// $('#txt_lessor_postal_renew').val(this["LESSOR_POSTAL"]);
				});

			},
			error : function(error){
				console.log("error: " + error);
			}
		});	
			
	});
		


</script>


<script src="{{asset('custom/jasonday-printThis-edc43df/printThis.js')}}"></script>
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

{{-- Bootstrap Combobox --}}
{{-- <script src="{{asset('assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/dist/js/select2.min.js')}}"></script>

<script src="{{asset('assets/plugins/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/assets/plugins/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/assets/js/theme/default.min.js')}}"></script>
<script src="{{asset('assets/assets/js/apps.min.js')}}"></script>
 --}}

@endsection


{{-- 
txt_buiness_number_renew
txt_business_name_renew
txt_trade_name_renew
sel_business_type_renew
txt_tin_no_renew
txt_dti_renew
txt_building_number_renew
txt_building_name_renew
txt_unit_no_renew
txt_street_renew
txt_sitio_renew
txt_subdivision_renew
txt_postal_renew		////
txt_business_email_renew
txt_business_telephone_renew
txt_business_mobile_renew
txt_total_employee_renew
txt_total_lgu_renew
txt_business_area_renew
txt_owner_firstname_renew
txt_middlename_renew
txt_lastname_renew
txt_owner_address_renew
txt_owner_postal_renew
txt_owner_email_renew
txt_owner_telephone_renew
txt_owner_mobile_renew
txt_emergency_contact_person_renew
txt_emergency_person_contact_renew
txt_emergency_person_email_renew
txt_no_unit_renew
txt_gross_essential_renew
txt_gross_nonessential_renew
txt_lessor_name_renew
txt_lessor_Address_renew
txt_lessor_postal_renew
txt_lessor_email_renew
txt_lessor_telephone_renew
txt_lessor_mobile_renew
txt_monthly_rental_renew
 --}}