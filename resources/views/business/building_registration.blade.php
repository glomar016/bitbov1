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


{{-- Bootstrap Combobox --}}
{{-- <link href="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css') }}" rel="stylesheet" /> --}}
{{-- <link href="../assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" /> --}}

<style type="text/css">
	.is-valid {}
</style>

@endsection


@section('content')

<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Building</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Building Registration</a></li>
		{{-- <li class="breadcrumb-item active">Wizards + Validation</li> --}}
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Building Registration<small></small></h1>
	<!-- end page-header -->

	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link">

				<span class="d-sm-block d-none">Buildings</span>
			</a>
		</li>
		{{--<li class="nav-items">
			<a href="#nav-pills-tab-3" data-toggle="tab" class="nav-link">

				<span class="d-sm-block d-none">Transactions</span>
			</a>
		</li>--}}

		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link">

				<span class="d-sm-block d-none">Add New Building</span>
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
					<h4 class="panel-title">Buildings</h4>
				</div>
				<!-- end panel-heading -->
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">×</span>
					</button>
					The following are the existing records of buildings in the barangay.
				</div>

				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="tbl_business_lst" class="table table-striped table-bor	d">
						<thead>
							<tr>
								<th hidden>
									<center>Building id</center>
								</th>
								<th hidden>
									<center>Lot Number</center>
								</th>
								<th hidden>
									<center>Building Number</center>
								</th>
								<th style="width: 20%">
									<center>Lot Number - Building Number</center>
								</th>
								<th hidden>
									<center>Building Name</center>
								</th>
								<th style="width: 20%">
									<center>Applicant Name</center>
								</th>
								<th hidden>
									<center>Lot Area</center>
								</th>
								<th style="width: 20%">
									<center>Project Location</center>
								</th>
								<th style="width: 20%" hidden>
									<center>Transaction ID</center>
								</th>
								<th style="width: 20%">
									<center>Project Type</center>
								</th>
								<th style="width: 10%">
									<center>Action</center>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($buildings as $value)
							<tr>
								<td style="text-align: center; text-transform: uppercase;" hidden>{{$value->BUILDING_ID}}</td>
								<td style="text-align: center; text-transform: uppercase;" hidden>{{$value->LOT_NUMBER}}</td>
								<td style="text-align: center; text-transform: uppercase;" hidden>{{$value->BUILDING_ID_NUMBER}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$value->LOT_NUMBER}} - {{$value->BUILDING_ID_NUMBER}}</td>
								<td style="text-align: center; text-transform: uppercase;" hidden>{{$value->BUILDING_NAME}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$value->APPLICANT_NAME}}</td>
								<td style="text-align: center; text-transform: uppercase;" hidden>{{$value->PROJECT_LOT_AREA}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$value->PROJECT_LOCATION}}</td>
								<td hidden>{{$value->TRANSACTION_ID}}</td>
								<td style="text-align: center; text-transform: uppercase;">{{$value->PROJECT_TYPE}}</td>
								<td>

									<div class="btn-group m-r-5 m-b-5">
                                        <a href="javascript:;" class="btn btn-info">Action</a>
                                        <a href="javascript:;" data-toggle="dropdown" class="btn btn-info dropdown-toggle"></a>
                                        <ul class="dropdown-menu">
                                            <li><a data-toggle='modal' data-target='#modal_improvement' id="btn_improvement" style="cursor: pointer;">Improvement</a></li>
                                            <li><a id="btn_view" style="cursor: pointer;">View</a></li>
                                            <li><a data-toggle='modal' data-target='#modal_edit' id="btn_edit" style="cursor: pointer;">Edit</a></li>
                                            <li class="divider"></li>
                                            
                                        </ul>
                                    </div>
								</td>
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
					<h4 class="panel-title">Improvement List</h4>
				</div>
				<!-- end panel-heading -->
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">×</span>
					</button>
					The following are the existing records of buildings in the barangay.
				</div>

				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="tbl_improve_lst" class="table table-striped table-bor	d">
					<thead>
							<tr>
								
								<th >
									<center>Lot Number - Building Number</center>
								</th>
								
								<th >
									<center>Applicant Name</center>
								</th>
								
								<th >
									<center>Project Location</center>
								</th>
								
								<th >
									<center>Project Type</center>
								</th>
								<th  hidden>
									<center>Transaction ID</center>
								</th>
								<th  hidden>
									<center>Building ID</center>
								</th>
								<th >
									<center>Action</center>
								</th>
							</tr>
						</thead>
						<tbody>
						@foreach($improvements as $imp)
							<tr>
								<td style="text-align: center; text-transform: uppercase; width:20%">{{$imp->LOT_NUMBER}} - {{$value->BUILDING_ID_NUMBER}}</td>
								<td style="text-align: center; text-transform: uppercase; width:20%">{{$imp->APPLICANT_NAME}}</td>
								<td style="text-align: center; text-transform: uppercase; width:20%">{{$imp->PROJECT_LOCATION}}</td>
								<td style="text-align: center; text-transform: uppercase; width:20%">{{$imp->PROJECT_TYPE}}</td>
								<td hidden>{{$imp->TRANSACTION_ID}}</td>
								<td hidden>{{$imp->BUILDING_ID}}</td>
								<td style="width: 10%">
									<a href="javascript:;" class="btn btn-info" data-toggle='modal' data-target='#modal_edit_imp' id="btn_edit_imp">Edit improvement&nbsp;
									<i class="fa fa-edit"></i></a>
									
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
					<h4 class="panel-title">Building Application </h4>
				</div>
				<!-- end panel-heading -->


				<!-- begin panel-body -->
				<div class="panel-body">
					{{-- Business Form --}}
					@include('business.form.building_related')
				</div>
				<!-- end panel-body -->
			</div>
		</div>

	</div>
	<!-- Edit Modal -->
	<div class="modal fade" id="modal_edit_imp">
		<div class="modal-dialog" style="max-width: 70%; ">
			<form id="PatientForm" method="post">
				{{csrf_field()}}

				<div class="modal-content">
					<div class="modal-header" style="background-color: #49b6d6">
						<h4 class="modal-title" style="color: white; display: block; text-align: center;">Edit Occupancy</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
					</div>
					<div class="modal-body">
						{{--modal body start--}}
						{{--<h2 id="ViewBarangayName" align="center"></h2>--}}
						<input type="text" id="transaction_id_edit" hidden>

		
					
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<table class="table table-striped table-bordered" id="tbl_edit_imp">

									<thead>
										<tr>
											<th style="text-align: center;" width="25%">Buidling Occupancy</th>

											<th style="text-align: center;" width="20%">Storey Number</th>
											<th style="text-align: center;" width="20%">Unit Number</th>
											<th style="text-align: center;" width="20%">Unit Floor Area</th>
											<th style="text-align: center;">Action</th>

										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								{{-- add tbody --}}
								<div class="clearfix">
									<div class="btn-group">
										{{--<button type="button" class="btn btn-success add btn-sm" id="">
											<i class="fa fa-plus"></i>
										</button>--}}
									</div>
								</div>
							</div>
						</div><br>
						
					
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<a href="javascript:;" class="btn btn-success" id="btn_submit_imp" style="background-color: #49b6d6">Submit</a>

					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Edit Modal -->
	<div class="modal fade" id="modal_edit">
		<div class="modal-dialog" style="max-width: 70%; ">
			<form id="PatientForm" method="post">
				{{csrf_field()}}

				<div class="modal-content">
					<div class="modal-header" style="background-color: #49b6d6">
						<h4 class="modal-title" style="color: white; display: block; text-align: center;">Edit Information</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
					</div>
					<div class="modal-body">
						{{--modal body start--}}
						{{--<h2 id="ViewBarangayName" align="center"></h2>--}}
						<input type="text" id="transaction_id" hidden>

						<div class="row">
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Lot Number</label>
									<input type="text" id="lot_number_txt_edit" style="display: block; text-align: left; color:black; background-color:white;text-transform: uppercase;" placeholder='LOT-00001' class="form-control">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Building Number</label>
									<input type="text" id="building_no_txt_edit" style="display: block; text-align: left; color:black; background-color:white; text-transform: uppercase;" placeholder='BLDG-00001' class="form-control">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Building Name</label>
									<input type="text" id="building_name_txt_edit" style="display: block; text-align: left; color:black; background-color:white; text-transform: uppercase;" placeholder='The gables building' class="form-control">
								</div>
							</div>




						</div> <br>
						<div class="row">
							<div class="col-lg-4 col-md-4">
								<div class="stats-content">
									<label style="display: block; text-align: left">Owner</label>
									<input type="text" id="owner_txt_edit" style="display: block; text-align: left; color:black; background-color:white; text-transform: uppercase;" class="form-control">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Owner's Address</label>
									<textarea type="text" id="owner_address_imp_txt_edit" style="display: block; text-align: left; color:black; background-color:white;text-transform: uppercase;" class="form-control"></textarea>
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label>Project Type</label>
									<textarea type="text" class="form-control" placeholder="2-Storey 4 classroom" id="project_type_txt_edit" style="text-transform: uppercase;"></textarea>
								</div>
							</div>
						</div><br>

						<div class="row">


							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Project Location</label>
									<textarea type="text" id="project_loc_imp_txt_edit" style="display: block; text-align: left; color:black; background-color:white;text-transform: uppercase;" class="form-control"></textarea>

								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Project Cost</label>
									<input type="text" id="project_cost_txt_edit" style="display: block; text-align: left; color:black; background-color:white;text-transform: uppercase;" class="form-control">

								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								{{--<div class="stats-content">
									<label>Scope of Work</label>
									<select class="form-control" id="sel_scopeof_work_improved_edit">

										<option>Land Related</option>
										<option>New Construction</option>

										<option>Erection</option>
										<option>Addition</option>
										<option>Alteration</option>
										<option>Renovation</option>
										<option>Conversion</option>
										<option>Repair</option>
										<option>Moving</option>
										<option>Raising</option>
										<option>Demolition</option>
										<option>Accessory Building/Structure</option>\
										<option>New Installation</option>
										<option>Annual Inspection</option>
										<option>Temporary</option>
										<option>Reconnection of Service Entrance</option>
										<option>Separation of Service Entrance</option>
										<option>Upgrading of Service Entrance</option>
										<option>Relocation of Service Entrance</option>
									</select>
								</div>--}}
							</div>
						</div><br>

						<div class="row">

							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Lot Area (in SQM)</label>
									<input type="text" id="lot_area_txt_edit" style="display: block; text-align: left; color:black; background-color:white;text-transform: uppercase;" placeholder='LOT-00001' class="form-control">

								</div>
							</div>

							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Floor Area (in SQM)</label>
									<input type="text" id="floor_area_txt_edit" style="display: block; text-align: left; color:black; background-color:white;text-transform: uppercase;" class="form-control">

								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Land Use</label>

									<select class="form-control sel_landuse_txt_edit" id="sel_landuse_txt_edit">
										<option value="-- Form of Ownership --"> -- Land Use --</option>
										<option value="Residential">Residential</option>
										<option value="Institutional">Institutional</option>
										<option value="Commercial">Commercial</option>
										<option value="Agricultural">Agricultural</option>

									</select>
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<table class="table table-striped table-bordered" id="tbl_edit_acitivity">

									<thead>
										<tr>
											<th style="text-align: center;" width="25%">Buidling Occupancy</th>

											<th style="text-align: center;" width="20%">Storey Number</th>
											<th style="text-align: center;" width="20%">Unit Number</th>
											<th style="text-align: center;" width="20%">Unit Floor Area</th>
											<th style="text-align: center;">Action</th>

										</tr>

									</thead>
									<tbody>



									</tbody>
								</table>
								{{-- add tbody --}}
								<div class="clearfix">
									<div class="btn-group">
									{{--<button type="button" class="btn btn-success add btn-sm" id="btnEdit">
											<i class="fa fa-plus"></i>
										</button>&nbsp;&nbsp;
										<button type="button" class="btn btn-warning add btn-sm" id="btnRemimprovement">
											<i class="fa fa-minus"></i>
										</button>--}}
									</div>
								</div>
								
							</div>
						</div><br>
						<div class="row">
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label>Applicant's Full Name</label>
									<input type="text" class="form-control" id="applicant_name_txt_edit" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label>Applicant's Address</label>
									<textarea type="text" class="form-control" id="applicant_address_txt_edit" style="text-transform: uppercase;"></textarea>
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label>Applicant's Telephone No.</label>
									<input type="text" class="form-control" id="applicant_phone_txt_edit">
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label>Applicant Mobile No.</label>
									<input type="text" class="form-control" id="applicant_mobile_txt_edit" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label>Applicant's Email Address</label>
									<input type="text" class="form-control" id="applicant_email_txt_edit">
								</div>
							</div>
							<div class="col-lg-2 col-md-6">
								<div class="stats-content">
									<label>Postal Code</label>
									<input type="number" class="form-control" id="applicant_postal_txt_edit">
								</div>
							</div>
						</div><br>

						<div class="row">
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label>Lessor's Full Name</label>
									<input type="text" class="form-control" id="lessor_name_txt_edit" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label>Lessor's Address</label>
									<textarea type="text" class="form-control" id="lessor_address_txt_edit" style="text-transform: uppercase;"></textarea>
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label>Lessor's Telephone/Mobile no.</label>
									<input type="text" class="form-control" id="lessor_phone_txt_edit">
								</div>
							</div>
						</div><br>
						<div class="row">

							<div class="col-lg-3 col-md-6">
								<div class="stats-content">
									<label>Lessor’s Email Address</label>
									<input type="text" class="form-control" id="lessor_email_txt_edit">
								</div>
							</div>
							<div class="col-lg-3col-md-6">
								<div class="stats-content">
									<label>Monthly Rental</label>
									<input type="number" class="form-control" id="lessor_rental_txt_edit" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="stats-content">
									<label>Enterprise Name</label>
									<input type="text" class="form-control" id="enterprise_txt_edit" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="stats-content">
									<label>Form Ownership</label>
									<select class="form-control sel_form_owner_edit" id="sel_form_owner_edit">
										<option selected value="-- Form of Ownership --"> -- Form of Ownership --</option>

										<option value="Single">Single</option>
										<option value="Partnership">Partnership</option>
										<option value="Government Corporation">Government Corporation</option>
										<option value="Private Corporation">Private Corporation</option>
										<option value="Cooperative Corporation">Cooperative Corporation</option>
									</select>
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<a href="javascript:;" class="btn btn-success" id="btn_submit_edit" style="background-color: #49b6d6">Submit</a>

					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Improvement Modal -->
	<div class="modal fade" id="modal_improvement">
		<div class="modal-dialog" style="max-width: 70%; ">
			<form id="PatientForm" method="post">
				{{csrf_field()}}

				<div class="modal-content">
					<div class="modal-header" style="background-color: #ffd900">
						<h4 class="modal-title" style="color: white; display: block; text-align: center;">Improvement</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
					</div>
					<div class="modal-body">
						{{--modal body start--}}
						<input type="text" id="transaction_id_imp" hidden>
						
						<div class="row">
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Lot Number</label>
									<input type="text" id="lot_number_txt" style="display: block; text-align: left; color:black; background-color:white;text-transform: uppercase;" placeholder='LOT-00001' class="form-control">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Building Number</label>
									<input type="text" id="building_no_txt" style="display: block; text-align: left; color:black; background-color:white; text-transform: uppercase;" placeholder='BLDG-00001' class="form-control">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Building Name</label>
									<input type="text" id="building_name_txt" style="display: block; text-align: left; color:black; background-color:white; text-transform: uppercase;" placeholder='The gables building' class="form-control">
								</div>
							</div>




						</div> <br>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Owner</label>
									<input type="text" id="owner_txt" style="display: block; text-align: left; color:black; background-color:white; text-transform: uppercase;" class="form-control">
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Owner's Address</label>
									<textarea type="text" id="owner_address_imp_txt" style="display: block; text-align: left; color:black; background-color:white;text-transform: uppercase;" class="form-control"></textarea>
								</div>
							</div>

						</div><br>

						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="stats-content">
									<label>Project Type</label>
									<textarea type="text" class="form-control" placeholder="2-Storey 4 classroom" id="project_type_txt" style="text-transform: uppercase;"></textarea>
								</div>
							</div>

							<div class="col-lg-6 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Project Location</label>
									<textarea type="text" id="project_loc_imp_txt" style="display: block; text-align: left; color:black; background-color:white;text-transform: uppercase;" class="form-control"></textarea>

								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Project Cost</label>
									<input type="text" id="project_cost_txt" style="display: block; text-align: left; color:black; background-color:white;text-transform: uppercase;" class="form-control">

								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="stats-content">
									<label>Scope of Work</label>
									<select class="form-control" id="sel_scopeof_work_improved">

										<option>Land Related</option>
										<option>New Construction</option>

										<option>Erection</option>
										<option>Addition</option>
										<option>Alteration</option>
										<option>Renovation</option>
										<option>Conversion</option>
										<option>Repair</option>
										<option>Moving</option>
										<option>Raising</option>
										<option>Demolition</option>
										<option>Accessory Building/Structure</option>\
										<option>New Installation</option>
										<option>Annual Inspection</option>
										<option>Temporary</option>
										<option>Reconnection of Service Entrance</option>
										<option>Separation of Service Entrance</option>
										<option>Upgrading of Service Entrance</option>
										<option>Relocation of Service Entrance</option>
									</select>
								</div>
							</div>

						</div><br>
						<div class="row">
							<div class="col-lg-6 col-md-6">

							</div>
							<div class="alert alert-yellow fade show col-lg-6 col-md-6">
								<label style="display: block; text-align: left">Recent scope of work</label>
								<ul id="ul_scope">

								</ul>
							</div>

						</div><br>
						<div class="row">

							<div class="col-lg-6 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Lot Area (in SQM)</label>
									<input type="text" id="lot_area_txt" style="display: block; text-align: left; color:black; background-color:white;text-transform: uppercase;" placeholder='LOT-00001' class="form-control">

								</div>
							</div>

							<div class="col-lg-6 col-md-6">
								<div class="stats-content">
									<label style="display: block; text-align: left">Floor Area (in SQM)</label>
									<input type="text" id="floor_area_txt" style="display: block; text-align: left; color:black; background-color:white;text-transform: uppercase;" class="form-control">

								</div>
							</div>
						</div><br>


						<div class="row">
							<div class="col-lg-12 col-md-12">
								<table class="table table-striped table-bordered" id="tbl_improvement_acitivity">

									<thead>
										<tr>
											<th style="text-align: center;" width="25%">Buidling Occupancy</th>

											<th style="text-align: center;" width="20%">Storey Number</th>
											<th style="text-align: center;" width="20%">Unit Number</th>
											<th style="text-align: center;" width="20%">Unit Floor Area</th>
											<th style="text-align: center;">Action</th>

										</tr>

									</thead>
									<tbody>



									</tbody>
								</table>
								{{-- add tbody --}}
								<div class="clearfix">
									<div class="btn-group">
										<button type="button" class="btn btn-success add btn-sm" id="btnAddimprovement">
											<i class="fa fa-plus"></i>
										</button>&nbsp;&nbsp;
										<button type="button" class="btn btn-warning add btn-sm" id="btnRemimprovement">
											<i class="fa fa-minus"></i>
										</button>
									</div>
								</div>
								
							</div>
						</div><br>

						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="stats-content">
									<label>Lessor's Full Name</label>
									<input type="text" class="form-control" id="lessor_name_txt" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="stats-content">
									<label>Lessor's Address</label>
									<input type="text" class="form-control" id="lessor_address_txt" style="text-transform: uppercase;">
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label>Lessor's Telephone/Mobile no.</label>
									<input type="text" class="form-control" id="lessor_phone_txt">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label>Lessor’s Email Address</label>
									<input type="text" class="form-control" id="lessor_email_txt">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="stats-content">
									<label>Monthly Rental</label>
									<input type="number" class="form-control" id="lessor_rental_txt" style="text-transform: uppercase;">
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<a href="javascript:;" class="btn btn-success" id="btn_submit" style="background-color: #49b6d6">Submit</a>

					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- #modal-view-end -->
	<div class="modal fade" id="modal-View">
		<div class="modal-dialog" style="max-width: 50%; ">
			<form id="EditForm">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #f59c1a">
						<h4 class="modal-title" style="color: white"> Building Information</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
					</div>
					<div class="modal-body">
						<input type="text" hidden>
						<h3><label class="lbl_project_type" style="text-transform: capitalize;">WBB Toy Shop</label></h3>
						{{--modal body start--}}
						<h4>Building Details</h4>
						{{-- 1 --}}
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_building_name">Building Name<span class="text-danger"></span></label> <br>
									<label class="txt_building_name" style="font-weight: normal; text-transform: capitalize;">asd</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_building_no">Building No<span class="text-danger"></span></label> <br>
									<label class="txt_building_no" style="font-weight: normal;">asd</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_trade_name_renew">Enterprise Name<span class="text-danger"></span></label><br>
									<label class="txt_enterprise" style="font-weight: normal;">asd</label>

								</div>
							</div>
						</div> <br>
						{{-- 2 --}}
						<div class="row">
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Building Occupancy<span class="text-danger"></span></label><br>
									<label class="txt_occupancy" style="font-weight: normal;">asd</label>

								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Land Use<span class="text-danger"></span></label> <br>
									<label class="txt_landuse" style="font-weight: normal;">asd</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Scope of Work<span class="text-danger"></span></label> <br>
									<label class="txt_scope_of_work" style="font-weight: normal;">asd</label>
								</div>
							</div>
						</div> <br>

						<h4>Project Details</h4>
						<div class="row">

							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_project_location_view">Project Location<span class="text-danger"></span></label> <br>
									<label class="txt_project_location_view" style="font-weight: normal; text-transform: capitalize;">asd</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_project_cost">Project Cost<span class="text-danger"></span></label> <br>
									<label class="txt_project_cost" style="font-weight: normal;">1000000</label>
								</div>
							</div>

							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_form_ownership">Form Ownership<span class="text-danger"></span></label> <br>
									<label class="txt_form_ownership" style="font-weight: normal;"></label>
								</div>
							</div>


							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_project_floor">Project Floor Area<span class="text-danger"></span></label> <br>
									<label class="txt_project_floor" style="font-weight: normal;">1000000</label>
								</div>
							</div>

							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_project_lot">Project Lot Area<span class="text-danger"></span></label> <br>
									<label class="txt_project_lot" style="font-weight: normal;">1000000</label>
								</div>
							</div>

							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_postal_code">Postal Code<span class="text-danger"></span></label> <br>
									<label class="txt_postal_code" style="font-weight: normal;">9999</label>
								</div>
							</div>
						</div>

						<h4>Contact Information</h4>
						<div class="row">

							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Full Name<span class="text-danger"></span></label><br>
									<label class="txt_fullname" style="font-weight: normal; text-transform: capitalize;">asd</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Applicant/Owner Email Address<span class="text-danger"></span></label><br>
									<label class="txt_email" style="font-weight: normal;">asd</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Applicant/Owner Telephone No.<span class="text-danger"></span></label><br>
									<label class="txt_telephone" style="font-weight: normal;">asd</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-8">
								<div class="stats-content">
									<label for="txt_">Applicant/Owner Mobile No.<span class="text-danger"></span></label><br>
									<label class="txt_mobile" style="font-weight: normal;">asd</label>
								</div>
							</div>
						</div> <br>




						{{--<h4>Rented Business Place</h4>
						<div class="divRent">
							<div class="row">
								<div class="col-lg-4 col-md-8">
									<div class="stats-content">
										<label for="txt_">Lessor Full Name<span class="text-danger"></span></label><br>
									<label class="txt_lessor_name"  style="font-weight: normal;">asd</label> 

									</div>
								</div>
								<div class="col-lg-4 col-md-8">
									<div class="stats-content">
										<label >Lessor Address<span class="text-danger"></span></label><br>
										<label class="txt_lessor_Address" style="font-weight: normal;">asd</label> 
									</div>
								</div>
								
							</div> <br>

							<div class="row">
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label >Lessor Email Address <span class="text-danger"></span></label><br>
										<label class="txt_lessor_email"  style="font-weight: normal;">asd</label> 
										
									</div>
								</div>
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label >Lessor Telephone No.<span class="text-danger"></span></label><br>
										<label class="txt_lessor_telephone" style="font-weight: normal;">asd</label> 
										
									</div>
								</div>
								
								<div class="col-lg-3 col-md-8">
									<div class="stats-content">
										<label >Monthly Rental<span class="text-danger"></span></label><br>
									<label class="txt_monthly_rental" style="font-weight: normal;">asd</label> 
									</div>
								</div>
							</div> <br>
						</div>--}}
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
					</div>
			</form>
		</div>
	</div>
</div>
</div>
<!-- end #content -->
@endsection

@section('page-js')
<script src="{{asset('js/building-validator.js')}}"></script>
<script>
	$(document).ready(function() {
		App.init();
		FormWizardValidation.init();
		TableManageDefault.init();
		$('#tbl_business_lst').DataTable({
			"bSort": false
		});
		$('#tbl_improve_lst').DataTable({
			"bSort": false
		});
		InputFormat();
	});


	function InputFormat() {
		$("#txt_applicant_telephone").mask("999-9999");

		$("#txt_business_postal").mask("9999");
		$("#txt_applicant_postal").mask("9999");
		$("#txt_applicant_mobile").mask("9999-999-9999");

	}
	$('#btnRemimprovement').on('click', function(){
		$("table[id=tbl_improvement_acitivity] tbody tr").remove();
	});
	
	$('#btnAddimprovement').on('click', function() {
		
		$('#tbl_improvement_acitivity').find('tbody').append(
			'<tr class="classTrBusinessActivity">\n' +
			'<td><select class="form-control lineofbusiness_imp" >\n' +
			'<option>-- Building Occupancy --</option>\n' +
			'<option>Not Stated</option>\n' +
			'<option >Residential</option>\n' +
			'<option >Commercial</option>\n' +
			'<option >Residential, Dwelling</option>\n' +
			'<option >Residential, Hotel/Apartment</option>\n' +
			'<option >Education, Recreation</option>\n' +
			'<option >Institutional</option>\n' +
			'<option >Business and Mercantile</option>\n' +
			'<option >Industrial</option>\n' +
			'<option >Industrial, Storage and Hazardous</option>\n' +
			'<option >Recreational Assembly</option>\n' +
			'<option >Agricultural Accessory</option>\n' +
			'</select>\n' +
			'</td> \n'

			+
			'<td><input type="text" class="form-control noofstorey"></td> \n' +
			'<td><input type="text" class="form-control noofunit"></td> \n' +
			'<td><input type="text" class="form-control unitfarea"></td> \n' +
			'<td style="text-align: center;"><a class="btn btn-danger" onclick="if($(\'#tbl_improvement_acitivity tbody tr\').length>=1)$(this).closest(\'tr\').remove()"><i class="fa fa-minus text-white"></i></a></td>\n' +
			'</tr> \n'
		);

		let data = {
			'_token': " {{ csrf_token() }}"
		};

	});

	$('#btnAddBusinessActivity').on('click', function() {

		$('#tbl_business_acitivity').find('tbody').append(
			'<tr class="classTrBusinessActivity">\n' +
			'<td><select class="form-control lineofbusiness" >\n' +
			'<option>-- Building Occupancy --</option>\n' +
			'<option>Not Stated</option>\n' +
			+'<option >Residential</option>\n' +
			'<option >Commercial</option>\n' +
			'<option >Residential, Dwelling</option>\n' +
			'<option >Residential, Hotel/Apartment</option>\n' +
			'<option >Education, Recreation</option>\n' +
			'<option >Institutional</option>\n' +
			'<option >Business and Mercantile</option>\n' +
			'<option >Industrial</option>\n' +
			'<option >Industrial, Storage and Hazardous</option>\n' +
			'<option >Recreational Assembly</option>\n' +
			'<option >Agricultural Accessory</option>\n' +
			'</select>\n' +
			'</td> \n'

			+
			'<td><input type="text" class="form-control noofstorey"></td> \n' +
			'<td><input type="text" class="form-control noofunit"></td> \n' +
			'<td><input type="text" class="form-control unitfarea"></td> \n' +
			'<td style="text-align: center;"><a class="btn btn-danger" onclick="if($(\'#tbl_business_acitivity tbody tr\').length>=1)$(this).closest(\'tr\').remove()"><i class="fa fa-minus text-white"></i></a></td>\n' +
			'</tr> \n'
		);

		let data = {
			'_token': " {{ csrf_token() }}"
		};

		$.ajax({
			url: "{{route('getLineofBusiness')}}",
			type: 'get',
			data: data,
			success: function(response) {

			}
		});

	});


	$('#btnSubmitBuildingRegistration').on('click', function() {


		var ProjectType = $('#txt_project_type').val(),
			BuildingName = $('#txt_building_name').val(),
			BuildingNo = $('#txt_building_id').val(),
			BuildingOccupancy = $('#sel_b_occupancy option:selected').text(),
			LandUse = $('#sel_land_use option:selected').text(),
			ScopeofWork = $('#sel_scopeof_work option:selected').text(),
			NameofApplicant = $('#txt_applicant_fullname').val(),
			ProjectLocation = $('#txt_project_location').val(),
			ProjectCost = $('#txt_project_cost').val(),
			ApplicantsTelephone = $('#txt_applicant_telephone').val(),
			ApplicantsMobile = $('#txt_applicant_mobile').val(),
			ApplicantsEmail = $('#txt_applicant_email').val(),
			PostalCode = $('#txt_applicant_postal').val(),
			ProjectFloorArea = $('#txt_floor_area').val(),
			ProjectLotArea = $('#txt_lot_area').val(),
			FormOwnership = $('#sel_form_owner option:selected').text(),
			Enterprise = $('#txt_enterprise_name').val(),
			txt_lessor_name = $('#txt_lessor_name').val(),
			txt_lessor_address = $('#txt_lessor_address').val(),
			txt_lessor_telephone = $('#txt_lessor_telephone').val(),
			txt_lessor_email = $('#txt_lessor_email').val(),
			txt_monthly_rental = $('#txt_monthly_rental').val(),
			txt_applicant_address = $('#txt_applicant_address').val(),
			txt_lot_no = $('#txt_lot_no').val()

		var occupancy = [],
			no_of_storey = [],
			no_of_unit = [],
			unit_f_area = [];
		$('.lineofbusiness option:selected').each(function() {
			occupancy.push($(this).text())
		});
		$('.noofstorey').each(function() {
			no_of_storey.push($(this).val())
		});
		$('.noofunit').each(function() {
			no_of_unit.push($(this).val())
		});
		$('.unitfarea').each(function() {
			unit_f_area.push($(this).val())
		});

		let data = {
			'_token': " {{ csrf_token() }}",
			'PROJECT_TYPE': ProjectType,
			'BUILDING_NAME': BuildingName,
			'BUILDING_ID_NUMBER': BuildingNo,
			'BUILDING_OCCUPANCY': BuildingOccupancy,
			'LAND_USE': LandUse,
			'SCOPE_OF_WORK': ScopeofWork,
			'APPLICANT_NAME': NameofApplicant,
			'APPLICANT_TELEPHONE_NO': ApplicantsTelephone,
			'APPLICANT_MOBILE_NO': ApplicantsMobile,
			'APPLICANT_EMAIL': ApplicantsEmail,
			'PROJECT_LOCATION': ProjectLocation,
			'PROJECT_COST': ProjectCost,
			'PROJECT_FLOOR_AREA': ProjectFloorArea,
			'PROJECT_LOT_AREA': ProjectLotArea,
			'POSTAL_CODE': PostalCode,
			'FORM_OWNERSHIP': FormOwnership,
			'ENTERPRISE_NAME': Enterprise,
			'LESSOR_NAME': txt_lessor_name,
			'LESSOR_ADDRESS': txt_lessor_address,
			'LESSOR_NO': txt_lessor_telephone,
			'LESSOR_EMAIL': txt_lessor_email,
			'MONTHLY_RENTAL': txt_monthly_rental,
			'OCCUPANCY': occupancy,
			'NO_OF_STOREY': no_of_storey,
			'NO_OF_UNIT': no_of_unit,
			'UNIT_FLOOR_AREA': unit_f_area,
			'APPLICANT_ADDRESS': txt_applicant_address,
			'LOT_NUMBER': txt_lot_no
		};
		
		$.ajax({
			url: "{{ route('CRUDBuildingApplication') }}",
			method: 'POST',
			data: data,
			success: function(response) {
				swal({
					title: 'Success',
					text: 'Saved Record!',
					icon: 'success',
					timer: 1000,
					button: false
				});
				window.location.reload();
				//console.log(response);
			},
			error: function(error) {
				console.log("error: " + error);
			}
		});


	});
	var building_id = '';
	// $('#tbl_improve_lst').on('click', '#btn_edit_imp', function() {
	// 	var row = $(this).closest("tr");
	// 	$('#transaction_id_edit').val($(row.find("td")[4]).text())
	// 	building_id = $(row.find("td")[5]).text()
		
	// 	data = {

	// 		BUILDING_ID: building_id,
	// 		TRANSACTION_ID: $(row.find("td")[4]).text(),
	// 		TYPE: 'building',
	// 		STATUS: 'edit',
	// 		_token: "{{csrf_token()}}"
	// 	}
	// 	occupancy('tbl_edit_imp', data);
	// });
	$('#btn_submit_imp').on('click', function(){
		var occupancy = [],
			no_of_storey = [],
			no_of_unit = [],
			unit_f_area = [];
		$('.lineofbusiness_imp option:selected').each(function() {
			occupancy.push($(this).text())
		});
		
		$('.noofstorey').each(function() {
			no_of_storey.push($(this).val())
		});
		$('.noofunit').each(function() {
			no_of_unit.push($(this).val())
		});
		$('.unitfarea').each(function() {
			unit_f_area.push($(this).val())
		});
		data = {
			'TRANSACTION_ID': $('#transaction_id_edit').val(),
			'BUILDING_ID': building_id,
			'occupancy' : occupancy,
			'no_of_storey' : no_of_storey,
			'no_of_unit' : no_of_unit,
			'unit_f_area' : unit_f_area,
			_token: "{{csrf_token()}}"
		}
		swal({
			title: 'Success',
			text: 'Saved Record!',
			icon: 'success',
			timer: 1000,
			button: false
		});
		setTimeout(() => {
			$.ajax({
				url: "{{route('editImprovement')}}",
				method: 'POST',
				data: data,
				success: function(response) {
					console.log(response)
					location.reload();
				},
				error: function(response) {
					console.log(response)
				}
			});
		}, 1000);
	});
	$('#tbl_business_lst').on('click', '#btn_edit', function() {
		var row = $(this).closest("tr");

		building_id = $(row.find("td")[0]).text();
		lot_number = $(row.find("td")[1]).text();
		building_no = $(row.find("td")[2]).text();
		building_name = $(row.find("td")[4]).text();
		owners_name = $(row.find("td")[5]).text();
		lot_area = $(row.find("td")[6]).text();
		//$('#transaction_id').val($(row.find("td")[8]).text())
		
		data = {

			BUILDING_ID: building_id,
			TYPE: 'building',
			STATUS: 'none',
			_token: "{{csrf_token()}}"
		}

		$.ajax({
			url: "{{route('SpecificBuilding')}}",
			method: 'POST',
			data: data,
			success: function(response) {
				$('#lot_number_txt_edit').val(lot_number);
				$('#building_no_txt_edit').val(building_no);
				$('#building_name_txt_edit').val(building_name);
				$('#owner_txt_edit').val(owners_name);
				$("#lot_area_txt_edit").val(lot_area);
				
				$.each(response["specific_business"], function() {

					$('#owner_address_imp_txt_edit').val(this['APPLICANT_ADDRESS']);
					$('#project_loc_imp_txt_edit').val(this['PROJECT_LOCATION']);
					$('#project_type_txt_edit').val(this['PROJECT_TYPE']);
					$('#project_cost_txt_edit').val(this['PROJECT_COST']);
					$('#lessor_name_txt_edit').val(this['LESSOR_NAME']);
					$('#lessor_address_txt_edit').val(this['LESSOR_ADDRESS']);
					$('#lessor_phone_txt_edit').val(this['LESSOR_NO']);
					$('#lessor_email_txt_edit').val(this['LESSOR_EMAIL']);
					$('#lessor_rental_txt_edit').val(this['MONTHLY_RENTAL']);
					$("#floor_area_txt_edit").val(this['PROJECT_FLOOR_AREA']);
					$('#applicant_name_txt_edit').val(this['APPLICANT_NAME']);
					$('#applicant_address_txt_edit').val(this['APPLICANT_ADDRESS']);
					$('#applicant_phone_txt_edit').val(this['APPLICANT_TELEPHONE_NO']);
					$('#applicant_mobile_txt_edit').val(this['APPLICANT_MOBILE_NO']);
					$('#applicant_email_txt_edit').val(this['APPLICANT_EMAIL']);
					$('#applicant_postal_txt_edit').val(this['POSTAL_CODE']);
					$('#enterprise_txt_edit').val(this['ENTERPRISE_NAME']);


					if (this['SCOPE_OF_WORK'] != '-- Scope of Work --') {
						$("#ul_scope").append('<li>' + this['SCOPE_OF_WORK'] + '</li>');
					}
					$('.sel_landuse_txt_edit option')
						.removeAttr('selected')
						.filter('[value=' + this['LAND_USE'] + ']')
						.attr('selected', true);
					var form_own = this['FORM_OWNERSHIP'] == '-- Form of Ownership --' ? 'Single' : this['FORM_OWNERSHIP'];
					$('.sel_form_owner_edit option')
						.removeAttr('selected')
						.filter('[value=' + form_own + ']')
						.attr('selected', true);
				});
			},
			error: function(response) {
				console.log(response)
			}
		});
		occupancy('tbl_edit_acitivity', data);

	});
	$('#tbl_business_lst').on('click', '#btn_improvement', function() {
		var row = $(this).closest("tr");

		building_id = $(row.find("td")[0]).text();
		lot_number = $(row.find("td")[1]).text();
		building_no = $(row.find("td")[2]).text();
		building_name = $(row.find("td")[4]).text();
		owners_name = $(row.find("td")[5]).text();
		lot_area = $(row.find("td")[6]).text();
		transaction_id = $(row.find("td")[8]).text()
		
		data = {

			BUILDING_ID: building_id,
			TRANSACTION_ID: transaction_id,
			TYPE: 'building',
			STATUS: 'edit',
			_token: "{{csrf_token()}}"
		}

		$.ajax({

			url: "{{route('SpecificBusinessApplication')}}",
			method: 'POST',
			data: data,
			success: function(response) {
				$('#lot_number_txt').val(lot_number);
				$('#building_no_txt').val(building_no);
				$('#building_name_txt').val(building_name);
				$('#owner_txt').val(owners_name);
				$("#lot_area_txt").val(lot_area);

				$.each(response["specific_business"], function() {

					$('#owner_address_imp_txt').val(this['APPLICANT_ADDRESS']);
					$('#project_loc_imp_txt').val(this['PROJECT_LOCATION']);
					$('#project_type_txt').val(this['PROJECT_TYPE']);
					$('#project_cost_txt').val(this['PROJECT_COST']);
					$('#lessor_name_txt').val(this['LESSOR_NAME']);
					$('#lessor_address_txt').val(this['LESSOR_ADDRESS']);
					$('#lessor_phone_txt').val(this['LESSOR_NO']);
					$('#lessor_email_txt').val(this['LESSOR_EMAIL']);
					$('#lessor_rental_txt').val(this['MONTHLY_RENTAL']);
					$("#floor_area_txt").val(this['PROJECT_FLOOR_AREA']);
					$("#ul_scope li").remove();
					if (this['SCOPE_OF_WORK'] != '-- Scope of Work --') {
						$("#ul_scope").append('<li>' + this['SCOPE_OF_WORK'] + '</li>');
					}
				});
			},
			error: function(response) {
				console.log(response)
			}
		});

		occupancy('tbl_improvement_acitivity', data);
	});
	function occupancy(table, data) {
		$.ajax({
			url: "{{route('get_occupancy')}}",
			method: 'POST',
			data: data,
			success: function(response) 
			{
				console.log(response['occupancy'])
				var ns, re, co, red, reha, er, ins, bam, ind, indsh, ra, aa;
				$("table[id='"+table+"'] tbody tr").remove();
				for (i = 0; i < response['occupancy'].length; i++) 
				{

					ns = response['occupancy'][i]['OCCUPANCY'] == 'Not Stated' ? 'selected' : '';
					re = response['occupancy'][i]['OCCUPANCY'] == 'Residential' ? 'selected' : '';
					co = response['occupancy'][i]['OCCUPANCY'] == 'Commercial' ? 'selected' : '';
					red = response['occupancy'][i]['OCCUPANCY'] == 'Residential, Dwelling' ? 'selected' : '';
					reha = response['occupancy'][i]['OCCUPANCY'] == 'Residential, Hotel/Apartment' ? 'selected' : '';
					er = response['occupancy'][i]['OCCUPANCY'] == 'Education, Recreation' ? 'selected' : '';
					ins = response['occupancy'][i]['OCCUPANCY'] == 'Institutional' ? 'selected' : '';
					bam = response['occupancy'][i]['OCCUPANCY'] == 'Business and Mercantile' ? 'selected' : '';
					ind = response['occupancy'][i]['OCCUPANCY'] == 'Industrial' ? 'selected' : '';
					indsh = response['occupancy'][i]['OCCUPANCY'] == 'Industrial, Storage and Hazardous' ? 'selected' : '';
					ra = response['occupancy'][i]['OCCUPANCY'] == 'Recreational Assembly' ? 'selected' : '';
					aa = response['occupancy'][i]['OCCUPANCY'] == 'Agricultural Accessory' ? 'selected' : '';

					$('#'+table).find('tbody').append(
						'<tr >\n' +
						'<td><select class="form-control lineofbusiness_imp" >\n' +
						'<option >-- Building Occupancy --</option>\n' +
						'<option ' + ns + '>Not Stated</option>\n' +
						'<option ' + re + '>Residential</option>\n' +
						'<option ' + co + '>Commercial</option>\n' +
						'<option ' + red + '>Residential, Dwelling</option>\n' +
						'<option ' + reha + '>Residential, Hotel/Apartment</option>\n' +
						'<option ' + er + '>Education, Recreation</option>\n' +
						'<option ' + ins + '>Institutional</option>\n' +
						'<option ' + bam + '>Business and Mercantile</option>\n' +
						'<option ' + ind + '>Industrial</option>\n' +
						'<option ' + indsh + '>Industrial, Storage and Hazardous</option>\n' +
						'<option ' + ra + '>Recreational Assembly</option>\n' +
						'<option ' + aa + '>Agricultural Accessory</option>\n' +

						'</select>\n' +
						'</td> \n' +

						'<td><input type="text" class="form-control noofstorey" value=' + response['occupancy'][i]['STOREY_NO'] + '></td> \n' +
						'<td><input type="text" class="form-control noofunit" value=' + response['occupancy'][i]['UNIT_NO'] + '></td> \n' +
						'<td><input type="text" class="form-control unitfarea" value=' + response['occupancy'][i]['UNIT_FLOOR_AREA'] + '></td> \n' +
						'<td style="text-align: center;"><a class="btn btn-danger" onclick="if($(\'#'+table+' tbody tr\').length>=1)$(this).closest(\'tr\').remove()"><i class="fa fa-minus text-white"></i></a></td>\n' +
						'</tr> \n'
					);

					$('#transaction_id_imp').val(response['occupancy'][0]['TRANSACTION_ID']);
					$('#transaction_id').val(response['occupancy'][0]['TRANSACTION_ID']);
				}
				
			},
			error: function(response) {
				console.log(response);
			}
		});
	}
	$('#btn_submit_edit').on('click', function() {
		
		var occupancy = [],
			no_of_storey = [],
			no_of_unit = [],
			unit_f_area = [];
		$('.lineofbusiness_imp option:selected').each(function() {
			occupancy.push($(this).text())
		});
		
		$('.noofstorey').each(function() {
			no_of_storey.push($(this).val())
		});
		$('.noofunit').each(function() {
			no_of_unit.push($(this).val())
		});
		$('.unitfarea').each(function() {
			unit_f_area.push($(this).val())
		});

		data = {
			'LOT_NUMBER': $('#lot_number_txt_edit').val(),
			'BUILDING_NO': $('#building_no_txt_edit').val(),
			'BUILDING_NAME': $('#building_name_txt_edit').val(),
			'OWNER': $('#owner_txt_edit').val(),
			'LOT_AREA': $("#lot_area_txt_edit").val(),
			'OWNER_ADDRESS': $('#owner_address_imp_txt_edit').val(),
			'PROJECT_LOCATION': $('#project_loc_imp_txt_edit').val(),
			'PROJECT_TYPE': $('#project_type_txt_edit').val(),
			'PROJECT_COST': $('#project_cost_txt_edit').val(),
			'LESSOR_NAME': $('#lessor_name_txt_edit').val(),
			'LESSOR_ADDRESS': $('#lessor_address_txt_edit').val(),
			'LESSOR_PHONE': $('#lessor_phone_txt_edit').val(),
			'LESSOR_EMAIL': $('#lessor_email_txt_edit').val(),
			'MONTLY_RENTAL': $('#lessor_rental_txt_edit').val(),
			'FLOOR_AREA': $("#floor_area_txt_edit").val(),
			'APPLICANT_NAME': $('#applicant_name_txt_edit').val(),
			'APPLICANT_ADDRESS': $('#applicant_address_txt_edit').val(),
			'APPLICANT_PHONE': $('#applicant_phone_txt_edit').val(),
			'APPLICANT_MOBILE': $('#applicant_mobile_txt_edit').val(),
			'APPLICANT_EMAIL': $('#applicant_email_txt_edit').val(),
			'POSTAL_CODE': $('#applicant_postal_txt_edit').val(),
			'ENTERPRISE': $('#enterprise_txt_edit').val(),
			'LAND_USE': $('#sel_landuse_txt_edit option:selected').text(),
			'FORM_OWNERSHIP': $('#sel_form_owner_edit option:selected').text(),
			'BUILDING_ID': building_id,
			'TRANSACTION_ID': $('#transaction_id').val(),
			'occupancy' : occupancy,
			'no_of_storey' : no_of_storey,
			'no_of_unit' : no_of_unit,
			'unit_f_area' : unit_f_area,
			_token: "{{csrf_token()}}"
		}

		swal({
			title: 'Success',
			text: 'Saved Record!',
			icon: 'success',
			timer: 1000,
			button: false
		});
		setTimeout(() => {
			$.ajax({
				url: "{{route('EditBuilding')}}",
				method: 'POST',
				data: data,
				success: function(response) {
					console.log(response)
					location.reload();
				},
				error: function(response) {
					console.log(response)
				}
			});
		}, 1000);
		

	});
	$("#btn_submit").on('click', function() {

		var scope_of_work = $('#sel_scopeof_work_improved option:selected').text()
		var building_no = $('#building_no_txt').val();
		var building_name = $('#building_name_txt').val();
		var lot_number = $('#lot_number_txt').val();
		var owners_name = $('#owner_txt').val();
		var lot_area = $("#lot_area_txt").val();
		var floor_area = $("#floor_area_txt").val();
		var occupancy = [],
			no_of_storey = [],
			no_of_unit = [],
			unit_f_area = [];
		var transaction_id_imp = $('#transaction_id_imp').val();
		
		$('.lineofbusiness_imp option:selected').each(function() {
			occupancy.push($(this).text())
		});
		console.log(occupancy)
		$('.noofstorey').each(function() {
			no_of_storey.push($(this).val())
		});
		$('.noofunit').each(function() {
			no_of_unit.push($(this).val())
		});
		$('.unitfarea').each(function() {
			unit_f_area.push($(this).val())
		});

		data = {
			building_id: building_id,
			scope_of_work: scope_of_work,
			building_no: building_no,
			building_name: building_name,
			lot_number: lot_number,
			owners_name: owners_name,
			lot_area: lot_area,
			floor_area: floor_area,
			occupancy: occupancy,
			no_of_storey: no_of_storey,
			no_of_unit: no_of_unit,
			unit_f_area: unit_f_area,
			owner_address: $('#owner_address_imp_txt').val(),
			project_loc: $('#project_loc_imp_txt').val(),
			project_type: $('#project_type_txt').val(),
			lessor_name: $('#lessor_name_txt').val(),
			lessor_address: $('#lessor_address_txt').val(),
			lessor_phone: $('#lessor_phone_txt').val(),
			lessor_email: $('#lessor_email_txt').val(),
			lessor_rental: $('#lessor_rental_txt').val(),
			project_cost: $('#project_cost_txt').val(),
			transaction_id_imp : transaction_id_imp,
			_token: "{{csrf_token()}}"
		}

		swal({
			title: 'Success',
			text: 'Saved Record!',
			icon: 'success',
			timer: 1000,
			button: false
		});
		setTimeout(() => {
			$.ajax({
				url: "{{route('improvement_building')}}",
				method: 'POST',
				data: data,
				success: function(response) {
					console.log(response)
					location.reload();
				},
				error: function(response) {
					console.log(response)
				}
			});
		}, 1000);
	});

	$('#tbl_business_lst').on('click', '#btn_view', function() {
		let row = $(this).closest("tr"),
			building_id = $(row.find("td")[0]).text();

		let data = {
			'_token': " {{ csrf_token() }}",
			'BUILDING_ID': building_id,
			'TYPE': 'building'
		};


		$.ajax({
			url: "{{ route('SpecificBusinessApplication') }}",
			method: 'POST',
			data: data,
			success: function(response) {
				console.log(response)

				$.each(response["specific_business"], function() {
					//building information
					var building_no, lot_number;
					if (this['BUILDING_ID_NUMBER'] == null || this['BUILDING_ID_NUMBER'] == '') building_no = '';
					else building_no = this['BUILDING_ID_NUMBER'];
					if (this['LOT_NUMBER'] == null) lot_number = '';
					else lot_number = "-" + this['LOT_NUMBER'];
					$('.lbl_project_type').text(this['PROJECT_TYPE']);
					$('.txt_building_name').text(this['BUILDING_NAME']);
					$('.txt_building_no').text(building_no + lot_number);
					$('.txt_enterprise').text(this['ENTERPRISE_NAME']);
					$('.txt_occupancy').text(this['BUILDING_OCCUPANCY']);
					$('.txt_landuse').text(this['LAND_USE']);
					$('.txt_scope_of_work').text(this['SCOPE_OF_WORK'] == '-- Scope of Work --' ? '' : this['SCOPE_OF_WORK']);
					//project information
					$('.txt_project_location_view').text(this['PROJECT_LOCATION']);
					$('.txt_project_cost').text(this['PROJECT_COST']);
					$('.txt_form_ownership').text(this['FORM_OWNERSHIP'] == '-- Form of Ownership --' ? '' : this['FORM_OWNERSHIP']);
					$('.txt_project_floor').text(this['PROJECT_FLOOR_AREA'] == null ? '' : this['PROJECT_FLOOR_AREA'] + 'SQM');
					$('.txt_project_lot').text(this['PROJECT_LOT_AREA'] == null ? '' : this['PROJECT_LOT_AREA'] + ' SQM');
					$('.txt_postal_code').text(this['POSTAL_CODE']);
					// applicant information
					$('.txt_fullname').text(this['APPLICANT_NAME']);
					$('.txt_email').text(this['APPLICANT_EMAIL']);
					$('.txt_telephone').text(this['APPLICANT_TELEPHONE_NO']);
					$('.txt_mobile').text(this['APPLICANT_MOBILE_NO']);
					$('.txt_f_area').text(this['PROJECT_FLOOR_AREA']);
					$('.txt_l_area').text(this['PROJECT_LOT_AREA']);
				});
			}
		});
		$('#modal-View').modal('show');

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