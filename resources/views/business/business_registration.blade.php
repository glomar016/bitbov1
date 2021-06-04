@extends('global.main')

@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />

{{-- Wizard Form --}}
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/parsley.css') }}" rel="stylesheet" />
{{-- Select 2 --}}
<link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />

{{-- <script src="../assets/plugins/pace/pace.min.js"></script> --}}


{{-- <link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" /> --}}

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
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link">

				<span class="d-sm-block d-none">Businesses</span>
			</a>
		</li>

		<li class="nav-items">
			<a href="#nav-pills-tab-3" data-toggle="tab" class="nav-link">

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
								<th style="width: 12%">
									<center>Business Number</center>
								</th>
								<th>
									<center>Business Name</center>
								</th>
								<th>
									<center>Trade Name/Franchise</center>
								</th>
								<th>
									<center>Address</center>
								</th>
								<th>
									<center>Owner's Name</center>
								</th>
								<th>
									<center>Status</center>
								</th>
								{{-- <th>Period</th> --}}
								<th>
									<center>Action</center>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($approved_business as $row)
							<tr class="gradeC" id="{{$row->BUSINESS_ID}}">
								<td>{{$row->BUSINESS_OR_NUMBER}}</td>
								<td style="text-transform: uppercase;">{{$row->BUSINESS_NAME == '' ? 'NOT STATED' : $row->BUSINESS_NAME}}</td>
								<td style="text-transform: uppercase;">{{$row->TRADE_NAME == '' ? 'NOT STATED' : $row->TRADE_NAME}}</td>
								<td>{{$row->BUSINESS_ADDRESS}}</td>
								<td>{{$row->BUSINESS_OWNER_LASTNAME}}, {{$row->BUSINESS_OWNER_FIRSTNAME}} {{$row->BUSINESS_OWNER_MIDDLENAME}}</td>
								{{-- <td>{{$row->BUSINESS_OR_ACQUIRED_DATE}}</td> --}}
								@php
								$gross = DB::table('v_get_gross')
								->where('BUSINESS_ID',$row->BUSINESS_ID)
								->get();
								@endphp
								@if($row->NEW_RENEW_STATUS == "New")
								<td>

									<h5><span class="label label-success">New Business</span></h5>
									<h6>Gross Receipt: ₱{{$gross[0]->GROSS_TOTAL}}</h6>
								</td>
								@else
								<td>
									<h5><span class="label label-purple">Renewed Business</span></h5>
									<h6>Gross Receipt: ₱{{$gross[0]->GROSS_TOTAL}}</h6>
								</td>
								@endif

								<td>

									<div class="btn-group m-r-5 m-b-5">
										<a href="javascript:;" class="btn btn-info">Action</a>
										<a href="javascript:;" data-toggle="dropdown" class="btn btn-info dropdown-toggle"></a>
										<ul class="dropdown-menu">
											<li><a data-toggle='modal' data-target='#modal-Edit' id="btnRenewOpen" style="cursor: pointer;">Edit</a></li>
											<li><a id="btn_view" style="cursor: pointer;">View</a></li>
											@if((date('j') == '1') && date('n') > 1 && date('n') < 20 && $row->NEW_RENEW_STATUS == "New")
											<li><a data-toggle='modal' data-target='#modal-Renew' id="btn_renew" style="cursor: pointer;">Renew</a></li>
											@else
											<li><a data-toggle='modal' data-target='#modal-Renew' id="btn_renew" style="cursor: pointer;">Renew (Has Penalty)</a></li>
											@endif
											<li class="divider"></li>

										</ul>
									</div>
								</td>

								@if((date('j') == '1') && date('n') > 1 && date('n') < 20 && $row->NEW_RENEW_STATUS == "New")

									@else
									{{--<span class="label label-danger">Penalty</span> 
										<button type="button" class="btn btn-yellow" id="btnRenewOpen">
										<i class="fa fa-circle"></i> Renew (Penalty)
										</button>
										--}}
									@endif



							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
			</div>
		</div>


		{{-- NAV PILLS TAB 3 --}}
		<div class="tab-pane fade " id="nav-pills-tab-3">
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


				<!-- begin panel-body -->
				<div class="panel-body">
					{{-- Business Form --}}
					@include('business.form.business_form')
				</div>
				<!-- end panel-body -->
			</div>
		</div>


	</div>



	<div class="modal fade" id="modal-Edit">
		<div class="modal-dialog" style="max-width: 80%;">
			<form>
				<div class="modal-content">
					<div class="modal-header" style="background-color: #17a2b8">
						<h4 class="modal-title" style="color: white">Edit Business</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
					</div>
					<div class="modal-body">
						<input type="text" hidden>
						<h3><label id="lbl_business_name">WBB Toy Shop</label></h3>
						{{--modal body start--}}
						<h4>Business Details</h4>
						{{-- 1 --}}
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_buiness_number_edit">Business Number<span class="text-danger"></span></label>
									<input class="form-control" id="txt_buiness_number_edit" placeholder="" readonly value="XXXXX-XXXXX" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_business_name_renew">Business Name<span class="text-danger"></span></label>
									<input class="form-control" id="txt_business_name_edit" placeholder="" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_trade_name_edit">Trade Name<span class="text-danger"></span></label>
									<input class="form-control" id="txt_trade_name_edit" placeholder="" />
								</div>
							</div>
						</div> <br>
						{{-- 2 --}}
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Type of Business<span class="text-danger"></span></label>
									<select class="form-control" id="sel_business_type_edit" data-parsley-required="true">
										<option>-- Type of Business --</option>
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
									<input class="form-control" id="txt_tin_no_edit" placeholder="" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">DTI/SEC/CDA Registration No.<span class="text-danger"></span></label>
									<input class="form-control" id="txt_dti_edit" placeholder="" />
								</div>
							</div>
						</div> <br>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Address<span class="text-danger"></span></label>
									<input class="form-control" id="txt_building_number_edit" placeholder="Building Number" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">&nbsp <span class="text-danger"></span></label>
									<input class="form-control" id="txt_building_name_edit" placeholder="Building Name" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_"> &nbsp <span class="text-danger"> </span></label>
									<input class="form-control" id="txt_unit_no_edit" placeholder="Unit Number" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_"><span class="text-danger"></span></label>
									<input class="form-control" id="txt_street_edit" placeholder="Street" />
								</div>
							</div>
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_"><span class="text-danger"></span></label>
									<input class="form-control" id="txt_sitio_edit" placeholder="Sitio" />
								</div>
							</div>
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_"><span class="text-danger"></span></label>
									<input class="form-control" id="txt_subdivision_edit" placeholder="Subdivision" />
								</div>
							</div>
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_"><span class="text-danger"></span></label>
									<input class="form-control" id="txt_postal_edit" placeholder="Postal" />
								</div>
							</div>
						</div> <br>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Business Email Address<span class="text-danger"></span></label>
									<input class="form-control" id="txt_business_email_edit" placeholder="" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Business Telephone No.<span class="text-danger"></span></label>
									<input class="form-control" id="txt_business_telephone_edit" placeholder="" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Business Mobile No.<span class="text-danger"></span></label>
									<input class="form-control" id="txt_business_mobile_edit" placeholder="" />
								</div>
							</div>
						</div> <br>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Total number of employees in Establishment<span class="text-danger"></span></label>
									<input class="form-control" id="txt_total_employee_edit" placeholder="" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Number of employees residing within LGU<span class="text-danger"></span></label>
									<input class="form-control" id="txt_total_lgu_edit" placeholder="" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Business Area<span class="text-danger"></span></label> <br>
									<input class="form-control" id="txt_business_area_edit" placeholder="" />
								</div>
							</div>
						</div> <br>
						<h4>Owner Information</h4>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">First Name<span class="text-danger"></span></label>
									<input class="form-control" id="txt_owner_firstname_edit" placeholder="" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Middle Name<span class="text-danger"></span></label>
									<input class="form-control" id="txt_middlename_edit" placeholder="" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Last Name<span class="text-danger"></span></label>
									<input class="form-control" id="txt_lastname_edit" placeholder="" />
								</div>
							</div>
						</div> <br>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Owner Address<span class="text-danger"></span></label>
									<input class="form-control" id="txt_owner_address_edit" placeholder="" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Owner Postal<span class="text-danger"></span></label>
									<input class="form-control" id="txt_owner_postal_edit" placeholder="" />
								</div>
							</div>
						</div> <br>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Owner Email Address<span class="text-danger"></span></label>
									<input class="form-control" id="txt_owner_email_edit" placeholder="" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Owner Telephone No.<span class="text-danger"></span></label>
									<input class="form-control" id="txt_owner_telephone_edit" placeholder="" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Owner Mobile No.<span class="text-danger"></span></label>
									<input class="form-control" id="txt_owner_mobile_edit" placeholder="" />
								</div>
							</div>
						</div> <br>
						<h4>Incase of emergency</h4>
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Emergency Contact Person<span class="text-danger"></span></label>
									<input class="form-control" id="txt_emergency_contact_person_edit" placeholder="" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Emergency Contact Person's Contact No<span class="text-danger"></span></label>
									<input class="form-control" id="txt_emergency_person_contact_edit" placeholder="" />
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Emergency Contact Person's Email<span class="text-danger"></span></label>
									<input class="form-control" id="txt_emergency_person_email_edit" placeholder="" />
								</div>
							</div>
						</div> <br>

						<h4>Rented Business Place</h4>
						<div class="divRent">
							<div class="row">
								<div class="col-lg-4 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Full Name<span class="text-danger"></span></label>
										<input class="form-control" id="txt_lessor_name_edit" placeholder="" />
									</div>
								</div>
								<div class="col-lg-4 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Address<span class="text-danger"></span></label>
										<input class="form-control" id="txt_lessor_address_edit" placeholder="" />
									</div>
								</div>
								<div class="col-lg-4 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Postal<span class="text-danger"></span></label>
										<input class="form-control" id="txt_lessor_postal_edit" placeholder="" />
									</div>
								</div>
							</div> <br>

							<div class="row">
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Email Address <span class="text-danger"></span></label>
										<input class="form-control" id="txt_lessor_email_edit" placeholder="" />
									</div>
								</div>
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Telephone No.<span class="text-danger"></span></label>
										<input class="form-control" id="txt_lessor_telephone_edit" placeholder="" />
									</div>
								</div>
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Mobile No.<span class="text-danger"></span></label>
										<input class="form-control" id="txt_lessor_mobile_edit" placeholder="" />
									</div>
								</div>
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label for="txt_">Monthly Rental<span class="text-danger"></span></label>
										<input class="form-control" id="txt_monthly_rental_edit" placeholder="" />
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

<div class="modal fade" id="modal-View">
	<div class="modal-dialog" style="max-width: 50%">
		<form id="EditForm">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #f59c1a">
					<h4 class="modal-title" style="color: white"> Business Information</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
				</div>
				<div class="modal-body">
					<input type="text" id="txt_business_id" hidden>
					<h3><label class="lbl_business_name">WBB Toy Shop</label></h3>
					{{--modal body start--}}
					<h4>Business Details</h4>
					{{-- 1 --}}
					<div class="row">
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_buiness_number_renew">Business Number<span class="text-danger"></span></label> <br>
								<label class="txt_buiness_number_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_business_name_renew">Business Name<span class="text-danger"></span></label> <br>
								<label class="txt_business_name_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_trade_name_renew">Trade Name<span class="text-danger"></span></label><br>
								<label class="txt_trade_name_renew" style="font-weight: normal;">asd</label>

							</div>
						</div>
					</div> <br>
					{{-- 2 --}}
					<div class="row">
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Type of Business<span class="text-danger"></span></label><br>
								<label class="sel_business_type_renew" style="font-weight: normal;">asd</label>

							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">TIN No.<span class="text-danger"></span></label> <br>
								<label class="txt_tin_no_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">DTI/SEC/CDA Registration No.<span class="text-danger"></span></label> <br>
								<label class="txt_dti_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
					</div> <br>
					<h4>Address</h4>
					<div class="row">
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Building No.<span class="text-danger"></span></label>
								<br>
								<label class="txt_building_number_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Building Name <span class="text-danger"></span></label> <br>
								<label class="txt_building_name_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Unit <span class="text-danger"> </span></label> <br>
								<label class="txt_unit_no_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 col-md-8">
							<div class="stats-content">
								<label for="txt_">Street<span class="text-danger"></span></label> <br>
								<label class="txt_street_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-3 col-md-8">
							<div class="stats-content">
								<label for="txt_">Sitio<span class="text-danger"></span></label> <br>
								<label class="txt_sitio_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-3 col-md-8">
							<div class="stats-content">
								<label for="txt_">Subdivision<span class="text-danger"></span></label> <br>
								<label class="txt_subdivision_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-3 col-md-8">
							<div class="stats-content">
								<label for="txt_">Postal Code<span class="text-danger"></span></label> <br>
								<label class="txt_postal_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
					</div> <br>
					<h4>Contact Information</h4>
					<div class="row">
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Business Email Address<span class="text-danger"></span></label><br>
								<label class="txt_business_email_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Business Telephone No.<span class="text-danger"></span></label><br>
								<label class="txt_business_telephone_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Business Mobile No.<span class="text-danger"></span></label><br>
								<label class="txt_business_mobile_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
					</div> <br>
					<div class="row">
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Total number of employees in Establishment<span class="text-danger"></span></label> <br>
								<label class="txt_total_employee_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Number of employees residing within LGU<span class="text-danger"></span></label> <br>
								<label class="txt_total_lgu_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Business Area<span class="text-danger"></span></label><br> <br>
								<label class="txt_business_area_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
					</div> <br>
					<h4>Owner Information</h4>
					<div class="row">
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">First Name<span class="text-danger"></span></label><br>
								<label class="txt_owner_firstname_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Middle Name<span class="text-danger"></span></label><br>
								<label class="txt_middlename_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Last Name<span class="text-danger"></span></label> <br>
								<label class="txt_lastname_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
					</div> <br>
					<div class="row">
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Owner Address<span class="text-danger"></span></label><br>
								<label class="txt_owner_address_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Owner Postal<span class="text-danger"></span></label><br>
								<label class="txt_owner_postal_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
					</div> <br>
					<div class="row">
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Owner Email Address<span class="text-danger"></span></label><br>
								<label class="txt_owner_email_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Owner Telephone No.<span class="text-danger"></span></label><br>
								<label class="txt_owner_telephone_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Owner Mobile No.<span class="text-danger"></span></label><br>
								<label class="txt_owner_mobile_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
					</div> <br>
					<h4>Incase of emergency</h4>
					<div class="row">
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Emergency Contact Person<span class="text-danger"></span></label><br>
								<label class="txt_emergency_contact_person_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Emergency Contact Person's Contact No<span class="text-danger"></span></label> <br>
								<label class="txt_emergency_person_contact_renew" style="font-weight: normal;">asd</label>

							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Emergency Contact Person's Email<span class="text-danger"></span></label> <br>
								<label class="txt_emergency_person_email_renew" style="font-weight: normal;">asd</label>
							</div>
						</div>
					</div> <br>

					<h4>Rented Business Place</h4>
					<div class="divRent">
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Lessor Full Name<span class="text-danger"></span></label><br>
									<label class="txt_lessor_name_renew" style="font-weight: normal;">asd</label>

								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Lessor Address<span class="text-danger"></span></label><br>
									<label class="txt_lessor_Address_renew" style="font-weight: normal;">asd</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Lessor Postal<span class="text-danger"></span></label> <br>
									<label class="txt_lessor_postal_renew" style="font-weight: normal;">asd</label>

								</div>
							</div>
						</div> <br>

						<div class="row">
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_">Lessor Email Address <span class="text-danger"></span></label><br>
									<label class="txt_lessor_email_renew" style="font-weight: normal;">asd</label>

								</div>
							</div>
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_">Lessor Telephone No.<span class="text-danger"></span></label><br>
									<label class="txt_lessor_telephone_renew" style="font-weight: normal;">asd</label>

								</div>
							</div>
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_">Lessor Mobile No.<span class="text-danger"></span></label><br>
									<label class="txt_lessor_mobile_renew" style="font-weight: normal;">asd</label>

								</div>
							</div>
							<div class="col-lg-3 col-md-8">
								<div class="stats-content">
									<label for="txt_">Monthly Rental<span class="text-danger"></span></label><br>
									<label class="txt_monthly_rental_renew" style="font-weight: normal;">asd</label>
								</div>
							</div>
						</div> <br>
					</div>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
				</div>
		</form>
	</div>
</div>
</div>
<div class="modal fade" id="modal-Renew">
	<div class="modal-dialog" style="max-width: 80%">
		<form id="EditForm">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #ffd900">
					<h4 class="modal-title" style="color: white"> Renew Business</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Business Address<span class="text-danger"></span></label>
								<textarea class="form-control" id="txt_business_address_renew" placeholder="Building Number"></textarea>
							</div>
						</div>
						<div class="col-lg-3 col-md-8">
							<div class="stats-content">
								<label for="txt_">Business Email Address<span class="text-danger"></span></label>
								<input class="form-control" id="txt_business_email_renew" placeholder="" />
							</div>
						</div>
						<div class="col-lg-3 col-md-8">
							<div class="stats-content">
								<label for="txt_">Business Telephone No.<span class="text-danger"></span></label>
								<input class="form-control" id="txt_business_telephone_renew" placeholder="" />
							</div>
						</div>
						<div class="col-lg-2 col-md-8">
							<div class="stats-content">
								<label for="txt_">Postal Code<span class="text-danger"></span></label>
								<input class="form-control" id="txt_business_postal_renew" placeholder="" />
							</div>
						</div>
					</div><br>
					<div class="row">
						
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Business Mobile No.<span class="text-danger"></span></label>
								<input class="form-control" id="txt_business_mobile_renew" placeholder="" />
							</div>
						</div>
					</div> <br>
					<h4>Incase of emergency</h4>
					<div class="row">
					<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Emergency Contact Person<span class="text-danger"></span></label>
								<input class="form-control" id="txt_emergency_person_contact_renew" placeholder="" />
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Emergency Contact Person's Contact No<span class="text-danger"></span></label>
								<input class="form-control" id="txt_emergency_person_contact_no_renew" placeholder="" />
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_">Emergency Contact Person's Email<span class="text-danger"></span></label>
								<input class="form-control" id="txt_emergency_person_email_renew" placeholder="" />
							</div>
						</div>
					</div> <br>
					<h5>Total number of employees in Establishment / Number of employees residing within LGU</h5>
					<div class="row">
						<div class="col-lg-2 col-md-8">
							<div class="stats-content">
								<label for="txt_total_employee_male_renew">Male<span class="text-danger"></span></label>
								<input class="form-control" id="txt_total_employee_male_renew" placeholder="" />
							</div>
						</div>
						<div class="col-lg-2 col-md-8">
							<div class="stats-content">
								<label for="txt_total_employee_female_renew">Female<span class="text-danger"></span></label>
								<input class="form-control" id="txt_total_employee_female_renew" placeholder="" />
							</div>
						</div>
						<div class="col-lg-2 col-md-8">
							<div class="stats-content">
								<label for="txt_total_lgu_male_renew">Male<span class="text-danger"></span></label>
								<input class="form-control" id="txt_total_lgu_male_renew" placeholder="" />
							</div>
						</div>
						<div class="col-lg-2 col-md-8">
							<div class="stats-content">
								<label for="txt_total_lgu_female_renew">Female<span class="text-danger"></span></label>
								<input class="form-control" id="txt_total_lgu_female_renew" placeholder="" />
							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="stats-content">
								<label for="txt_business_area_renew">Business Area (SQM)<span class="text-danger"></span></label> <br>
								<input class="form-control" id="txt_business_area_renew" placeholder="" />
							</div>
						</div>
					</div> <br>
					<h4>Rented Business Place</h4>
						<div class="divRent">
							<div class="row">
								<div class="col-lg-4 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Full Name<span class="text-danger"></span></label>
										<input class="form-control" id="txt_lessor_name_renew" placeholder="" />
									</div>
								</div>
								<div class="col-lg-4 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Address<span class="text-danger"></span></label>
										<input class="form-control" id="txt_lessor_Address_renew" placeholder="" />
									</div>
								</div>
								<div class="col-lg-4 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Postal<span class="text-danger"></span></label>
										<input class="form-control" id="txt_lessor_postal_renew" placeholder="" />
									</div>
								</div>
							</div> <br>

							<div class="row">
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Email Address <span class="text-danger"></span></label>
										<input class="form-control" id="txt_lessor_email_renew" placeholder="" />
									</div>
								</div>
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Telephone No.<span class="text-danger"></span></label>
										<input class="form-control" id="txt_lessor_telephone_renew" placeholder="" />
									</div>
								</div>
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Mobile No.<span class="text-danger"></span></label>
										<input class="form-control" id="txt_lessor_mobile_renew" placeholder="" />
									</div>
								</div>
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label for="txt_">Monthly Rental<span class="text-danger"></span></label>
										<input class="form-control" id="txt_monthly_rental_renew" placeholder="" />
									</div>
								</div>
							</div> <br>
						</div>
					<table class="table table-striped table-bordered" id="tbl_business_acitivity_renew">

						<thead>
							<tr>
								<th style="text-align: center;">Line of Business</th>
								<th style="text-align: center;" width="10%">No of units</th>
								<th style="text-align: center;">Capitalization (for new business) </th>
								<th style="text-align: center;" colspan="2">Gross/Sales Receipts</th>
								<th style="text-align: center;">Action</th>

							</tr>
							<tr>

								<th></th>
								<th></th>
								<th></th>
								<th style="text-align: center;">ESSENTIAL</th>
								<th style="text-align: center;">NON-ESSENTIAL</th>
								<th></th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
					<div class="clearfix">
						<div class="btn-group">
							<button type="button" class="btn btn-success add btn-sm" id="btnRenewBusinessActivity">
								<i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
					<a style="background-color: #ffd900;" href="javascript:;" class="btn btn-white" id="btnRenewSubmit">Renew</a>
				</div>
		</form>
	</div>
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

		$('#tbl_business_lst').DataTable({ "bSort": false });
		// $('#tbl_business_acitivity').DataTable({ "bSort": false });
		// $('#tbl_business_acitivity_renew').DataTable({  });
		InputFormat();
	});

	function InputFormat() {
		$("#txt_business_telephone").mask("999-9999");
		$("#txt_owner_telephone").mask("999-9999");
		$("#txt_business_postal").mask("9999");
		$("#txt_owner_postal").mask("9999");
		$("#txt_business_mobile").mask("9999-999-9999")
		$("#txt_owner_mobile").mask("9999-999-9999")
	}
	$('#btnRenewSubmit').click(function() {
		var capitalization = [], 
			e_grossreceipt = [], 
			occupancy = [],
			noofunit = [],
			n_grossreceipt = [];

		$('.lineofbusiness option:selected').each(function() {
			occupancy.push($(this).attr('value'))
		});
		$('.noofunit').each(function() {
			noofunit.push($(this).val())
		});
		$('.capitalization').each(function() {
			capitalization.push($(this).val())
		});
		$('.e_grossreceipt').each(function() {
			e_grossreceipt.push($(this).val())
		});
		$('.n_grossreceipt').each(function() {
			n_grossreceipt.push($(this).val())
		});
	
		data = {
			BUSINESS_ID: business_id,
			BUSINESS_ADDRESS: $('#txt_business_address_renew').val(),
			BUSINESS_EMAIL_ADD: $('#txt_business_email_renew').val(),
			BUSINESS_TELEPHONE_NO: $('#txt_business_telephone_renew').val(),
			BUSINESS_MOBILE_NO: $('#txt_business_email_renew').val(),
			BUSINESS_POSTAL_CODE: $('#txt_business_postal_renew').val(),
			BUSINESS_MOBILE_NO: $('#txt_business_mobile_renew').val(),
			EMERGENCY_CONTACT_PERSON: $('#txt_emergency_person_contact_renew').val(),
			EMERGENCY_PERSON_CONTACT_NO: $('#txt_emergency_person_contact_no_renew').val(),
			EMERGENCY_PERSON_EMAIL_ADD: $('#txt_emergency_person_email_renew').val(),
			NO_MALE_EMPLOYEE: $('#txt_total_employee_male_renew').val(),
			NO_FEMALE_EMPLOYEE: $('#txt_total_employee_female_renew').val(),
			NO_MALE_LGU: $('#txt_total_lgu_male_renew').val(),
			NO_FEMALE_LGU: $('#txt_total_lgu_female_renew').val(),
			BUSINESS_AREA: $('#txt_business_area_renew').val(),
			LINE_OF_BUSINESS_ID: occupancy,
			NO_OF_UNITS: noofunit,
			CAPITALIZATION: capitalization,
			GROSS_RECEIPTS_ESSENTIAL: e_grossreceipt,
			GROSS_RECEIPTS_NON_ESSENTIAL: n_grossreceipt,
			'_token': " {{ csrf_token() }}"
		}
		
		swal({
				title: 'Success',
				text: 'Saved Record!',
				icon: 'success',
				timer: 1000
			});

		console.log(data)
		setTimeout(() => {
			$.ajax({
				url: "{{ route('renew_business') }}",
				method: 'POST',
				data: data,
				success: function(response) {
					window.location.reload();
				},
				error: function(error) {
					console.log(error);
				}
			});
			
		}, 1000);
		
	});
	$('#tbl_business_lst').on('click', '#btn_renew', function() {
		
		var row = $(this).closest("tr");
		business_id = $(this).closest('tr').attr('id');
		let data = {
			'business_id': business_id
			,'_token': " {{ csrf_token() }}"
		};
		$.ajax({
			url: "{{route('getGross')}}",
			type: 'post',
			data: data,
			success:function(response) {
				$("table[id=tbl_business_acitivity_renew] tbody tr").remove();
				for (i = 0; i < response['gross'].length; i++) 
				{
					gross_ess = response['gross'][i]['GROSS_RECEIPTS_ESSENTIAL'] == null ? '' : response['gross'][i]['GROSS_RECEIPTS_ESSENTIAL'];
					gross_non_ess = response['gross'][i]['GROSS_RECEIPTS_NON_ESSENTIAL'] == null ? '' : response['gross'][i]['GROSS_RECEIPTS_NON_ESSENTIAL'];
					capital = response['gross'][i]['CAPITALIZATION'] == null ? '' : response['gross'][i]['CAPITALIZATION'];
					no_of_units = response['gross'][i]['NO_OF_UNITS'] == null ? '' : response['gross'][i]['NO_OF_UNITS'];
					$('#tbl_business_acitivity_renew').find('tbody').append(
					'<tr class="classTrBusinessActivity">\n' +
					'<td><select class="form-control lineofbusiness"  >\n'

					+
					'</select>\n' +
					'</td> \n' +
					'<td><input type="text" name="noofunit[]" class="form-control noofunit" value="'+no_of_units+'"></td> \n' +
					'<td><input type="text" name="capitalization[]" class="form-control capitalization" value="'+capital+'"></td> \n' +
					'<td><input type="text" name="e_grossreceipt[]" class="form-control e_grossreceipt" value="'+gross_ess+'"></td> \n' +
					'<td><input type="text" name="n_grossreceipt[]" class="form-control n_grossreceipt" value="'+gross_non_ess+'"></td> \n' +
					'<td><a class="btn btn-danger" onclick="if($(\'#tbl_business_acitivity_renew tbody tr\').length>=1)$(this).closest(\'tr\').remove()"><i class="fa fa-minus text-white"></i></a></td>\n' +
					'</tr> \n'
					);

					$.each(response["line_of_business"], function() {
						$('.lineofbusiness').append(`<option class="lineofbusiness_val" value="${this['BUSINESS_NATURE_ID']}"> 
									${this['BUSINESS_NATURE_NAME']} 
								</option>`);
					});

					$('.lineofbusiness option')
					.removeAttr('selected')
					.filter('[value=' + response['gross'][i]['LINE_OF_BUSINESS_ID'] + ']')
					.attr('selected', true);
				}
				console.log(response["business_info"])
				$.each(response["business_info"], function() {

					$('#txt_business_address_renew').val(this['BUSINESS_ADDRESS']);
					$('#txt_business_email_renew').val(this['BUSINESS_EMAIL_ADD']);
					$('#txt_business_telephone_renew').val(this['BUSINESS_TELEPHONE_NO']);
					$('#txt_business_email_renew').val(this['BUSINESS_MOBILE_NO']);
					$('#txt_business_postal_renew').val(this['BUSINESS_POSTAL_CODE']);
					$('#txt_business_mobile_renew').val(this['BUSINESS_MOBILE_NO']);
					$('#txt_emergency_person_contact_renew').val(this['EMERGENCY_CONTACT_PERSON']);
					$('#txt_emergency_person_contact_no_renew').val(this['EMERGENCY_PERSON_CONTACT_NO']);
					$('#txt_emergency_person_email_renew').val(this['EMERGENCY_PERSON_EMAIL_ADD']);
					$('#txt_total_employee_male_renew').val(this['NO_MALE_EMPLOYEE']);
					$('#txt_total_employee_female_renew').val(this['NO_FEMALE_EMPLOYEE']);
					$('#txt_total_lgu_male_renew').val(this['NO_MALE_LGU']);
					$('#txt_total_lgu_female_renew').val(this['NO_FEMALE_LGU']);
					$('#txt_business_area_renew').val(this['BUSINESS_AREA']);
					
				});
			},
			error:function(error) {
				console.log(error)
			}
		});
	});

	$('#tbl_business_lst').on('click', '#btn_view', function() {
		let row = $(this).closest("tr"),
			name = $(row.find("td")[0]).text();

		$('#txt_business_id').val(row.attr("id"));
		var business_id = row.attr("id");


		let data = {
			'_token': " {{ csrf_token() }}",
			'BUSINESS_ID': business_id,
			'TYPE': 'business'
		};

		$.ajax({
			url: "{{ route('SpecificBusinessApplication') }}",
			method: 'POST',
			data: data,
			success: function(response) {
				console.log(response)
				$.each(response["specific_business"], function() {
					$('.txt_business_name_renew').text(this["BUSINESS_NAME"]);
					$('.txt_buiness_number_renew').text(this["BUSINESS_OR_NUMBER"]);
					$('.txt_tin_no_renew').val(this["TIN_NO"]);
					$('.txt_dti_renew').text(this["DTI_REGISTRATION_NO"]);
					$('.txt_building_number_renew').text(this["BUILDING_NUMBER"]);
					$('.txt_building_name_renew').text(this["BUILDING_NAME"]);
					$('.txt_unit_no_renew').text(this["UNIT_NO"]);
					$('.txt_street_renew').text(this["STREET"]);
					$('.txt_sitio_renew').text(this["SITIO"]);
					$('.txt_subdivision_renew').text(this["SUBDIVISION"]);
					$('.txt_postal_renew').text(this["BUSINESS_POSTAL_CODE"]);
					$('.txt_business_email_renew').text(this["BUSINESS_EMAIL_ADD"]);
					$('.txt_business_telephone_renew').text(this["BUSINESS_TELEPHONE_NO"]);
					$('.txt_business_mobile_renew').text(this["BUSINESS_MOBILE_NO"]);
					$('.txt_total_employee_renew').text(this["NO_EMPLOYEE_ESTABLISHMENT"]);
					$('.txt_total_lgu_renew').text(this["NO_EMPLOYEE_LGU"]);
					$('.txt_owner_firstname_renew').text(this["BUSINESS_OWNER_FIRSTNAME"]);
					$('.txt_middlename_renew').text(this["BUSINESS_OWNER_MIDDLENAME"]);
					$('.txt_lastname_renew').text(this["BUSINESS_OWNER_LASTNAME"]);
					$('.txt_owner_address_renew').text(this["OWNER_ADDRESS"]);
					$('.txt_owner_postal_renew').text(this["OWNER_POSTAL_CODE"]);
					$('.txt_owner_email_renew').text(this["OWNER_EMAIL_ADD"]);
					$('.txt_owner_telephone_renew').text(this["OWNER_TELEPHONE_NO"]);
					$('.txt_owner_mobile_renew').text(this["OWNER_MOBILE_NO"]);
					$('.txt_emergency_contact_person_renew').text(this["EMERGENCY_CONTACT_PERSON"]);
					$('.txt_emergency_person_contact_renew').text(this["EMERGENCY_PERSON_CONTACT_NO"]);
					$('.txt_emergency_person_email_renew').text(this["EMERGENCY_PERSON_EMAIL_ADD"]);
					$('.txt_no_unit_renew').text(this["NO_OF_UNITS"]);
					$('.txt_gross_essential_renew').text(this["GROSS_RECEIPTS_ESSENTIAL"]);
					$('.txt_gross_nonessential_renew').text(this["GROSS_RECEIPTS_NON_ESSENTIAL"]);
					$('.txt_lessor_name_renew').text(this["LESSOR_NAME"]);
					$('.txt_lessor_Address_renew').text(this["LESSOR_ADDRESS"]);
					$('.txt_lessor_postal_renew').text(this["LESSOR_POSTAL"]);
					$('.txt_lessor_email_renew').text(this["LESSOR_EMAIL_ADD"]);
					$('.txt_lessor_telephone_renew').text(this["LESSOR_TELEPHONE"]);
					$('.txt_lessor_mobile_renew').text(this["LESSOR_MOBILE_NO"]);
					$('.txt_monthly_rental_renew').text(this["MONTHLY_RENTAL"]);
					$('.sel_line_of_business_renew').text(this["LINE_OF_BUSINESS_NAME"]).change();
					$('.sel_business_type_renew').text(this["TYPE_OF_BUSINESS"]).change();
					$('.lbl_business_name').text(this["BUSINESS_NAME"]);
					// KULANG
					$('.txt_trade_name_renew').text(this["TRADE_NAME"]);
					$('.txt_business_area_renew').text(this["BUSINESS_AREA"]);
					// $('#txt_lessor_postal_renew').val(this["LESSOR_POSTAL"]);
					$('#modal-View').modal('show');
				});
			},
			error: function(error) {
				console.log("error: " + error);
			}
		});
	});

	$('#btnSubmitBusinessRegistration').on('click', function() {


		var lineofbusiness = [],
			noofunit = [],
			capitalization = [],
			e_grossreceipt = [],
			n_grossreceipt = [];

		$(".lineofbusiness option:selected").each(function() {
			lineofbusiness.push($(this).val());
		});

		$("input[name='noofunit[]']").each(function() {
			noofunit.push($(this).val());
		});
		$("input[name='capitalization[]']").each(function() {
			capitalization.push($(this).val());
		});
		$("input[name='e_grossreceipt[]']").each(function() {
			e_grossreceipt.push($(this).val());
		});
		$("input[name='n_grossreceipt[]']").each(function() {
			n_grossreceipt.push($(this).val());
		});



		var BusinessNumber = $('#txt_business_number').val(),
			BusinessName = $('#txt_business_name').val(),
			TradeName = $('#txt_tradename').val(),
			BusinessType = $('#sel_business_type option:selected').text(),
			BusinessNature = $('#sel_business_nature').children(':selected').attr("id"),
			FirstName = $('#txt_firstname').val(),
			MiddleName = $('#txt_middlename').val(),
			LastName = $('#txt_lastname').val(),
			TinNo = $('#txt_tin_no').val(),
			DtiNo = $('#txt_dti_no').val(),
			DtiNoDate = $('#txt_dti_no_date').val(),
			BusinessPostal = $('#txt_business_postal').val(),
			BusinessEmail = $('#txt_business_email').val(),
			BusinessTelNo = $('#txt_business_telephone').val(),
			BusinessMobileNo = $('#txt_business_mobile').val(),
			OwnerAddress = $('#txt_owner_address').val(),
			OwnerPostal = $('#txt_owner_postal').val(),
			OwnerEmail = $('#txt_owner_email').val(),
			OwnerTelNo = $('#txt_owner_telephone').val(),
			OwnerMobileNo = $('#txt_owner_mobile').val()

			,
			NoFemaleEmployee = $('#txt_female_establishment').val(),
			NoMaleEmployee = $('#txt_male_establishment').val(),
			NoFemaleLGU = $('#txt_female_lgu').val(),
			NoMaleLGU = $('#txt_male_lgu').val(),
			BusinessArea = $('#txt_business_area').val(),
			EmergencyPerson = $('#txt_emergency_person').val(),
			EmergencyPersonContact = $('#txt_emergency_contact').val(),
			EmergencyPersonEmail = $('#txt_emergency_email').val()

			,
			LessorName = $('#txt_lessor_name').val(),
			LessorAddress = $('#txt_lessor_address').val(),
			LessorEmail = $('#txt_lessor_email').val(),
			LessorTelephone = $('#txt_lessor_telephone').val(),
			MonthlyRental = $('#txt_monthly_rental').val()
			// Business Address
			,
			BusinessAddress = $('#txt_business_address').val()
		//, BuildingNumber = $('#txt_building_no').val()
		//, BuildingName = $('#txt_building_name').val()
		//, UnitNo = $('#txt_unit_no').val()
		//, Street = $('#txt_street').val()

		;

		let data = {
			'_token': " {{ csrf_token() }}",
			'BUSINESS_NAME': BusinessName,
			'TRADE_NAME': TradeName,
			'BUSINESS_NATURE_ID': BusinessNature,
			'BUSINESS_OWNER_FIRSTNAME': FirstName,
			'BUSINESS_OWNER_MIDDLENAME': MiddleName,
			'BUSINESS_OWNER_LASTNAME': LastName
				// ,'BUSINESS_ADDRESS' : BusinessAddress
				,
			'BUSINESS_OR_NUMBER': BusinessNumber,
			'TIN_NO': TinNo,
			'DTI_REGISTRATION_NO': DtiNo,
			'DTI_NO_DATE': DtiNoDate,
			'TYPE_OF_BUSINESS': BusinessType,
			'BUSINESS_POSTAL_CODE': BusinessPostal,
			'BUSINESS_EMAIL_ADD': BusinessEmail,
			'BUSINESS_TELEPHONE_NO': BusinessTelNo,
			'BUSINESS_MOBILE_NO': BusinessMobileNo,
			'OWNER_ADDRESS': OwnerAddress,
			'OWNER_POSTAL_CODE': OwnerPostal,
			'OWNER_EMAIL_ADD': OwnerEmail,
			'OWNER_TELEPHONE_NO': OwnerTelNo,
			'OWNER_MOBILE_NO': OwnerMobileNo,
			'EMERGENCY_CONTACT_PERSON': EmergencyPerson,
			'EMERGENCY_PERSON_CONTACT_NO': EmergencyPersonContact,
			'EMERGENCY_PERSON_EMAIL_ADD': EmergencyPersonEmail,
			'BUSINESS_AREA': BusinessArea
				// ,'NO_EMPLOYEE_ESTABLISHMENT' : EmployeeEstablishment
				// ,'NO_EMPLOYEE_LGU' : EmployeeLgu
				,
			'NO_FEMALE_EMPLOYEE': NoFemaleEmployee,
			'NO_MALE_EMPLOYEE': NoFemaleLGU,
			'NO_FEMALE_LGU': NoFemaleLGU,
			'NO_MALE_LGU': NoMaleLGU,
			'LESSOR_NAME': LessorName,
			'LESSOR_ADDRESS': LessorAddress,
			'LESSOR_CONTACT_NO': LessorTelephone

				// ,'LESSOR_MOBILE_NO' : LessorMobile
				,
			'LESSOR_EMAIL_ADD': LessorEmail,
			'MONTHLY_RENTAL': MonthlyRental

				,
			'LINE_OF_BUSINESS_ID': lineofbusiness,
			'NO_OF_UNITS': noofunit,
			'CAPITALIZATION': capitalization,
			'GROSS_RECEIPTS_ESSENTIAL': e_grossreceipt,
			'GROSS_RECEIPTS_NON_ESSENTIAL': n_grossreceipt,
			'BUSINESS_ADDRESS': BusinessAddress,
			'NEW_RENEW_STATUS': 'New'
		};

		swal({
				title: 'Success',
				text: 'Saved Record!',
				icon: 'success',
				timer: 1000
			});
		setTimeout(() => {
			$.ajax({
				url: "{{ route('CRUDBusinessApplication') }}",
				method: 'POST',
				data: data,
				success: function(response) {
					window.location.reload();
				},
				error: function(error) {
					console.log("error: " + error);
				}
			});
		}, 1000);
		


	});
	function get_lineofbusiness(table) {

		let data = {
			'_token': " {{ csrf_token() }}"
		};

		$.ajax({
			url: "{{route('getLineofBusiness')}}",
			type: 'get',
			data: data,
			success: function(response) {


				$('#'+table).find('tbody').append(
					'<tr class="classTrBusinessActivity">\n' +
					'<td><select class="form-control lineofbusiness"  >\n'

					+
					'</select>\n' +
					'</td> \n' +
					'<td><input type="text" name="noofunit[]" class="form-control"></td> \n' +
					'<td><input type="text" name="capitalization[]" class="form-control"></td> \n' +
					'<td><input type="text" name="e_grossreceipt[]" class="form-control"></td> \n' +
					'<td><input type="text" name="n_grossreceipt[]" class="form-control"></td> \n' +
					'<td><a class="btn btn-danger" onclick="if($(\'#'+table+' tbody tr\').length>=1)$(this).closest(\'tr\').remove()"><i class="fa fa-minus text-white"></i></a></td>\n' +
					'</tr> \n'
				);

				$.each(response["line_of_business"], function() {
					$('.lineofbusiness').append(`<option class="lineofbusiness_val" value="${this['BUSINESS_NATURE_ID']}"> 
                                   ${this['BUSINESS_NATURE_NAME']} 
                              </option>`);
				});
			}
		});
	}
	$('#btnAddBusinessActivity').on('click', function() {
		get_lineofbusiness('tbl_business_acitivity');
	});
	$('#btnRenewBusinessActivity').on('click', function() {
		
		get_lineofbusiness('tbl_business_acitivity_renew');
	});
	

	$('#btnBusinessRenewal').on('click', function() {

		var BusinessNumber = $('#txt_buiness_number_renew').val(),
			BusinessName = $('#txt_business_name_renew').val(),
			TradeName = $('#txt_trade_name_renew').val(),
			BusinessType = $('#sel_business_type_renew option:selected').text(),
			FirstName = $('#txt_owner_firstname_renew').val(),
			MiddleName = $('#txt_middlename_renew').val(),
			LastName = $('#txt_lastname_renew').val(),
			TinNo = $('#txt_tin_no_renew').val(),
			DtiNo = $('#txt_dti_renew').val(),
			BusinessPostal = $('#txt_postal_renew').val(),
			BusinessEmail = $('#txt_business_email_renew').val(),
			BusinessTelNo = $('#txt_business_telephone_renew').val(),
			BusinessMobileNo = $('#txt_business_mobile_renew').val(),
			OwnerAddress = $('#txt_owner_address_renew').val(),
			OwnerPostal = $('#txt_owner_postal_renew').val(),
			OwnerEmail = $('#txt_owner_email_renew').val(),
			OwnerTelNo = $('#txt_owner_telephone_renew').val(),
			OwnerMobileNo = $('#txt_owner_mobile_renew').val(),
			EmployeeEstablishment = $('#txt_total_employee_renew').val(),
			EmployeeLgu = $('#txt_total_lgu_renew').val(),
			BusinessArea = $('#txt_business_area_renew').val(),
			EmergencyPerson = $('#txt_emergency_contact_person_renew').val(),
			EmergencyPersonContact = $('#txt_emergency_person_contact_renew').val(),
			EmergencyPersonEmail = $('#txt_emergency_person_email_renew').val()

			,
			LessorName = $('#txt_lessor_name_renew').val(),
			LessorAddress = $('#txt_lessor_Address_renew').val(),
			LessorPostal = $('#txt_lessor_postal_renew').val(),
			LessorEmail = $('#txt_lessor_email_renew').val(),
			LessorTelephone = $('#txt_lessor_telephone_renew').val(),
			LessorMobile = $('#txt_lessor_mobile_renew').val(),
			MonthlyRental = $('#txt_monthly_rental_renew').val()
			// Business Address
			,
			BuildingNumber = $('#txt_building_number_renew').val(),
			BuildingName = $('#txt_building_name_renew').val(),
			UnitNo = $('#txt_unit_no_renew').val(),
			Street = $('#txt_street_renew').val(),
			Sitio = $('#txt_sitio_renew').val(),
			Subdivision = $('#txt_subdivision_renew').val()

			,
			BusinessID = $('#txt_business_id').val();

		let data = {
			'_token': " {{ csrf_token() }}",
			'BUSINESS_NAME': BusinessName,
			'TRADE_NAME': TradeName,
			'BUSINESS_OWNER_FIRSTNAME': FirstName,
			'BUSINESS_OWNER_MIDDLENAME': MiddleName,
			'BUSINESS_OWNER_LASTNAME': LastName,
			'BUSINESS_OR_NUMBER': BusinessNumber,
			'TIN_NO': TinNo,
			'DTI_REGISTRATION_NO': DtiNo,
			'TYPE_OF_BUSINESS': BusinessType,
			'BUSINESS_POSTAL_CODE': BusinessPostal,
			'BUSINESS_EMAIL_ADD': BusinessEmail,
			'BUSINESS_TELEPHONE_NO': BusinessTelNo,
			'BUSINESS_MOBILE_NO': BusinessMobileNo,
			'OWNER_ADDRESS': OwnerAddress,
			'OWNER_POSTAL_CODE': OwnerPostal,
			'OWNER_EMAIL_ADD': OwnerEmail,
			'OWNER_TELEPHONE_NO': OwnerTelNo,
			'OWNER_MOBILE_NO': OwnerMobileNo,
			'EMERGENCY_CONTACT_PERSON': EmergencyPerson,
			'EMERGENCY_PERSON_CONTACT_NO': EmergencyPersonContact,
			'EMERGENCY_PERSON_EMAIL_ADD': EmergencyPersonEmail,
			'BUSINESS_AREA': BusinessArea,
			'NO_EMPLOYEE_ESTABLISHMENT': EmployeeEstablishment,
			'NO_EMPLOYEE_LGU': EmployeeLgu,
			'LESSOR_NAME': LessorName,
			'LESSOR_ADDRESS': LessorAddress,
			'LESSOR_CONTACT_NO': LessorTelephone,
			'LESSOR_EMAIL_ADD': LessorEmail,
			'MONTHLY_RENTAL': MonthlyRental
				// ,'LINE_OF_BUSINESS_ID' : LineOfBusiness		
				// ,'NO_OF_UNITS' : NoUnit
				// ,'GROSS_RECEIPTS_ESSENTIAL' : SalesReceiptEssential
				// ,'GROSS_RECEIPTS_NON_ESSENTIAL' : SalesReceiptNonEssential
				// BUSINESS ADDRESS
				,
			'BUILDING_NUMBER': BuildingNumber,
			'BUILDING_NAME': BuildingName,
			'UNIT_NO': UnitNo,
			'STREET': Street,
			'SITIO': Sitio,
			'SUBDIVISION': Subdivision
				// ADDED
				,
			'REFERENCED_BUSINESS_ID': BusinessID,
			'NEW_RENEW_STATUS': 'Renew'
		};

		console.log(data);

		alert('renew')
		// $.ajax({
		// 	url : "{{ route('CRUDBusinessApplication') }}",
		// 	method : 'POST',
		// 	data : data,
		// 	success : function(response) {
		// 		swal({
		// 			title: 'Success',
		// 			text: 'Saved Record!',
		// 			icon: 'success',
		// 		});
		// 		window.location.reload();
		// 	},
		// 	error : function(error){
		// 		console.log("error: " + error);
		// 	}
		// });	
	});


	$('#tbl_business_lst').on('click', '#btnRenewOpen', function() {
		let row = $(this).closest("tr"),
			name = $(row.find("td")[0]).text();

		$('#txt_business_id').val(row.attr("id"));
		var business_id = row.attr("id");


		let data = {
			'_token': " {{ csrf_token() }}",
			'BUSINESS_ID': business_id
		};

		$.ajax({
			url: "{{ route('SpecificBusinessApplication') }}",
			method: 'POST',
			data: data,
			success: function(response) {
				$.each(response["specific_business"], function() {
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
			error: function(error) {
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

{{-- SELECT 2 --}}
<script src="{{asset('assets/plugins/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/demo/form-plugins.demo.min.js')}}"></script>
<link href="{{ asset('assets/plugins/pace/pace.min.js')}}" />

<script src="{{asset('assets/plugins/masked-input/masked-input.min.js')}}"></script>

@endsection