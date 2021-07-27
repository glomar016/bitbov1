@extends('global.main')

@section('page-css')

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{asset('assets/plugins/jquery-smart-wizard/src/css/smart_wizard.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/parsley/src/parsley.css')}}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

@endsection

@section('content')
	
	
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Business</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Weights and Measure</a></li>
			</ol>
			<!-- end breadcrumb -->


			<!-- begin page-header -->
            <h1 class="page-header">Weights and Measure Registration<small></small></h1>
			<!-- end page-header -->
            
            <ul class="nav nav-pills">
                <li class="nav-items">
                    <a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link">

                        <span class="d-sm-block d-none">Weights and Measure</span>
                    </a>
                </li>

                <li class="nav-items">
                    <a href="#nav-pills-tab-3" data-toggle="tab" class="nav-link">

                        <span class="d-sm-block d-none">Add New Weights and Measure</span>
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
                            <h4 class="panel-title">Weights and Measure</h4>
                        </div>
                        <!-- end panel-heading -->

                        <div class="alert alert-yellow fade show">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">×</span>
                            </button>
                            The following are the existing records of weights and measure in the barangay.
                        </div>

                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <table id="tbl_weights_and_measure_list" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 12%" hidden>
                                            <center>Weights and Measure ID</center>
                                        </th>
                                        <th>
                                            <center>Device Registration Number </center>
                                        </th>
                                        <th>
                                            <center>Device Type</center>
                                        </th>
                                        <th>
                                            <center>Brand</center>
                                        </th>
                                        <th>
                                            <center>Model </center>
                                        </th>
                                        <th>
                                            <center>Capacity</center>
                                        </th>
                                        <th>
                                            <center>Serial Number   </center>
                                        </th>
                                        <th>
                                            <center>Sales Invoice</center>
                                        </th>
                                        <th>
                                            <center>License Number </center>
                                        </th>
                                        <th>
                                            <center>Business Name</center>
                                        </th>
                                        <th>
                                            <center>Status   </center>
                                        </th>
                                        {{-- <th>Period</th> --}}
                                        <th>
                                            <center>Action</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($weights_and_measure as $row)               
                                        <tr class="gradeC" id="{{$row->WEIGHTS_AND_MEASURE_ID}}">
                                            <td hidden>{{$row->WEIGHTS_AND_MEASURE_ID}}</td>
                                            <td>{{$row->DEVICE_NUMBER}}</td>
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
                                            <td>{{$row->BRAND}}</td>
                                            <td>{{$row->MODEL}}</td>
                                            <td>{{$row->CAPACITY}} kg</td>
                                            <td>{{$row->SERIAL_NO}}</td>
                                            <td>{{$row->SALES_INVOICE}}</td>
                                            <td>{{$row->LICENSE_NO}}</td>
                                            <td>{{$row->BUSINESS_NAME}}</td>
                                            @if($row->WM_NEW_RENEW_STATUS == "New")
                                            <td>
                                                <h5><span class="label label-success">New</span></h5>
                                            </td>
                                            @elseif($row->WM_NEW_RENEW_STATUS == "Revoke")
                                            <td>
                                                <h5><span class="label label-danger">Revoked</span></h5>
                                            </td>
                                            @else
                                            <td>
                                                <h5><span class="label label-purple">Renewed</span></h5>
                                            </td>
                                            @endif
                                            <td>
                                                <div class="btn-group m-r-5 m-b-5">
                                                    <a href="javascript:;" class="btn btn-info">Action</a>
                                                    <a href="javascript:;" data-toggle="dropdown" class="btn btn-info dropdown-toggle"></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a data-toggle='modal' data-target='#modal-Edit' class="btnEdit" style="cursor: pointer;">Edit</a></li>
                                                        <li><a data-toggle='modal' data-target='#modal-View' class="btnView" style="cursor: pointer;">View</a></li>
                                                        <li><a data-toggle='modal' id="{{$row->WEIGHTS_AND_MEASURE_ID}}" class="btnDeactivate" style="cursor: pointer;">Deactivate</a></li>
                                                        <li><a data-toggle='modal' id="{{$row->WEIGHTS_AND_MEASURE_ID}}" class="btnRevoke" style="cursor: pointer;">Revocation</a></li>
                                                        @if(date('Y', strtotime($row->WM_CREATED_AT)) <= date('Y'))
                                                        <!-- <li><a data-toggle='modal' data-target='#modal-Renew' class="btn_renew" style="cursor: pointer;">Renew</a></li> -->
                                                        @else
                                                        <li><a data-toggle='modal' data-target='#modal-Renew' class="btn_renew" style="cursor: pointer;">Renew</a></li>
                                                        @endif
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
                            <h4 class="panel-title">Weights and Measure Application </h4>
                        </div>
                        <!-- end panel-heading -->


                        <!-- begin panel-body -->
                        <div class="panel-body">
                            @include('business.form.weights_and_measure_form')
                        </div>
                        <!-- end panel-body -->
                    </div>
                </div>

            </div>

            <div><!-- MODALS -->
                <div class="modal fade" id="modal-Edit">
                    <div class="modal-dialog" style="max-width: 80%;">
                        <form id="weightsandmeasure_form">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #17a2b8">
                                    <h4 class="modal-title" style="color: white">Edit Weights and Measure</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                </div>
                                
                                <div class="modal-body">
                                    <h3><label id="lbl_weights_and_measure_number">WBB Toy Shop</label></h3>
                                    <input type="text" id="txt_weights_and_measure_id" name="txt_weights_and_measure_id" hidden>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_business_number">Business Number<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_business_number" name="txt_business_number" placeholder="" readonly value="XXXXX-XXXXX" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_business_name">Business Name<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_business_name" name="txt_business_name" placeholder="" readonly value="Test Name" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_business_address">Business Address<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_business_address" name="txt_business_address" placeholder="" readonly value="Test Name" />
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_license_no_edit">License No.<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_license_no_edit" name="txt_license_no_edit" placeholder=""/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_license_date_edit">License Date<span class="text-danger"></span></label>
                                                <input class="form-control" type="date" id="txt_license_date_edit" name="txt_license_date_edit" placeholder="" />
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_device_type_edit">Device Type<span class="text-danger"></span></label><br>
                                                <select id="txt_device_type_edit">
                                                    <option disabled selected> -- Select Device Type -- </option>
                                                    <option value="LM">Linear Measure (Tape Measure, Yardstick, Caliper, Gauge, etc.)</option>
                                                    <option value="MC">Measure of Capacity (Fuel Dispensing Pump, calibration bucket, etc) </option>
                                                    <option value="GS">Graduated Scale Balance (Weighing Scales, etc)</option>
                                                    <option value="AB">Apothecary Balances (Mineral and Medicinal Uses)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_brand_edit">Brand<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_brand_edit" name="txt_brand_edit" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_model_edit">Model<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_model_edit" name="txt_model_edit" placeholder="" />
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_capacity_edit">Capacity<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_capacity_edit" name="txt_capacity_edit" placeholder=""  />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_serial_no_edit">Serial No<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_serial_no_edit" name="txt_serial_no_edit" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_sales_invoice_edit">Sales Invoice<span class="text-danger"></span></label>
                                                <input class="form-control" type="text" id="txt_sales_invoice_edit" name="txt_sales_invoice_edit" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_sales_invoice_date_edit">Sales Invoice Date<span class="text-danger"></span></label>
                                                <input class="form-control" type="text" id="txt_sales_invoice_date_edit" name="txt_sales_invoice_date_edit" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                    <input id="btnWeightsAndMeasureUpdate" class="btn btn-yellow" type="submit" value="Update">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            

            
                <div>
                    <div class="modal fade" id="modal-Deactivate">
                        <div class="modal-dialog" style="max-width: 35%;">
                            <form id="weightsandmeasure_form_deactivate">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #17a2b8">
                                        <h4 class="modal-title" style="color: white">Deactivate Weights and Measure Device</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <input type="text" id="txt_weights_and_measure_id_deactivate" name="txt_weights_and_measure_id_deactivate" hidden>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-8">
                                                <div class="stats-content">
                                                    <label for="txt_reason">Deactivation Reason: <span class="text-danger"></span></label>
                                                    <select id="txt_reason">
                                                        <option selected disabled>-- Select Deactivation Reason --</option>
                                                        <option value="Worn-out/Replaced">Worn-out/Replaced</option>
                                                        <option value="Ownership transferred">Ownership transferred</option>
                                                        <option value="Business closure">Business closure</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                        <input id="btnWeightsAndMeasureDeactivate" class="btn btn-danger" type="submit" value="Deactivate">
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="modal fade" id="modal-Revoke">
                        <div class="modal-dialog" style="max-width: 35%;">
                            <form id="weightsandmeasure_form_revoke">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #17a2b8">
                                        <h4 class="modal-title" style="color: white">Revocation</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <input type="text" id="txt_weights_and_measure_id_revoke" name="txt_weights_and_measure_id_revoke" hidden>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-8">
                                                <div class="stats-content">
                                                    <label for="txt_revokereason">Revoked Due: <span class="text-danger"></span></label>
                                                    <textarea class="form-control" id="txt_revokereason" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                        <input id="btnWeightsAndMeasureRevoke" class="btn btn-danger" type="submit" value="Revoke">
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            
            
            
            
            <div>
                <!-- MODALS -->
                <div class="modal fade" id="modal-View">
                    <div class="modal-dialog" style="max-width: 50%;">
                        <form id="viewForm">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #28a745">
                                    <h4 class="modal-title" style="color: black">View Weights and Measure</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                </div>
                                
                                <div class="modal-body">
                                    <h3><label id="lbl_weights_and_measure_number_view">WBB Toy Shop</label></h3>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_business_number_view">Business Number<span class="text-danger"></span></label><br>
                                                <label class="txt_business_number_view" style="font-weight: normal;">asd</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_business_name_view">Business Name<span class="text-danger"></span></label><br>
                                                <label class="txt_business_name_view" style="font-weight: normal;">asd</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_business_address_view">Business Address<span class="text-danger"></span></label><br>
                                                <label class="txt_business_address_view" style="font-weight: normal;">asd</label>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_device_number_view">Device No.<span class="text-danger"></span></label><br>
                                                <label class="txt_device_number_view" style="font-weight: normal;">asd</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_license_no_view">License No.<span class="text-danger"></span></label><br>
                                                <label class="txt_license_no_view" style="font-weight: normal;">asd</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_license_date_view">License Date<span class="text-danger"></span></label><br>
                                                <label class="txt_license_date_view" style="font-weight: normal;">asd</label>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_device_type_view">Device Type<span class="text-danger"></span></label><br>
                                                <label class="txt_device_type_view" style="font-weight: normal;">asd</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_brand_view">Brand<span class="text-danger"></span></label><br>
                                                <label class="txt_buiness_number_renew" style="font-weight: normal;">asd</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_model_view">Model<span class="text-danger"></span></label><br>
                                                <label class="txt_model_view" style="font-weight: normal;">asd</label>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_capacity_view">Capacity<span class="text-danger"></span></label><br>
                                                <label class="txt_capacity_view" style="font-weight: normal;">asd</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_serial_no_view">Serial No<span class="text-danger"></span></label><br>
                                                <label class="txt_serial_no_view" style="font-weight: normal;">asd</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_sales_invoice_view">Sales Invoice<span class="text-danger"></span></label><br>
                                                <label class="txt_sales_invoice_view" style="font-weight: normal;">asd</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_sales_invoice_date_view">Sales Invoice Date<span class="text-danger"></span></label><br>
                                                <label class="txt_sales_invoice_date_view" style="font-weight: normal;">asd</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

        
            <div>
                <div class="modal fade" id="modal-Renew">
                    <div class="modal-dialog" style="max-width: 80%">
                        <form id="weightsandmeasure_renew_form">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #f59c1a">
                                    <h4 class="modal-title" style="color: white"> Weights and Measure Information</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                </div>
                                
                                <div class="modal-body">
                                    <h3><label id="lbl_weights_and_measure_number_renew">WBB Toy Shop</label></h3>
                                    <input type="text" id="txt_weights_and_measure_id_renew" name="txt_weights_and_measure_id_renew" hidden>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_business_number_renew">Business Number<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_business_number_renew" name="txt_business_number_renew" placeholder="" readonly value="XXXXX-XXXXX" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_business_name_renew">Business Name<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_business_name_renew" name="txt_business_name_renew" placeholder="" readonly value="Test Name" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_business_address_renew">Business Address<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_business_address_renew" name="txt_business_address_renew" placeholder="" readonly value="Test Name" />
                                        </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_device_number_renew">Device No.<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_device_number_renew" name="txt_device_number_renew"  readonly  placeholder=""/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_license_no_edit_renew">License No.<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_license_no_edit_renew" name="txt_license_no_edit_renew"  readonly  placeholder=""/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_license_date_edit_renew">License Date<span class="text-danger"></span></label>
                                                <input class="form-control" type="date" id="txt_license_date_edit_renew" name="txt_license_date_edit_renew"   readonly placeholder="" />
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_device_type_edit_renew">Device Type<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_device_type_edit_renew" name="txt_device_type_edit_renew"  readonly placeholder=""  />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_brand_edit_renew">Brand<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_brand_edit_renew" name="txt_brand_edit_renew"  readonly placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_model_edit_renew">Model<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_model_edit_renew" name="txt_model_edit_renew"  readonly placeholder="" />
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_capacity_edit_renew">Capacity<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_capacity_edit_renew" name="txt_capacity_edit_renew" readonly  placeholder=""  />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_serial_no_edit_renew">Serial No<span class="text-danger"></span></label>
                                                <input class="form-control" id="txt_serial_no_edit_renew" name="txt_serial_no_edit_renew" readonly  placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_sales_invoice_edit_renew">Sales Invoice<span class="text-danger"></span></label>
                                                <input class="form-control" type="text" id="txt_sales_invoice_edit_renew" name="txt_sales_invoice_edit_renew"   readonly placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="stats-content">
                                                <label for="txt_sales_invoice_date_edit_renew">Sales Invoice Date<span class="text-danger"></span></label>
                                                <input class="form-control" type="date" id="txt_sales_invoice_date_edit_renew" name="txt_sales_invoice_date_edit_renew"   readonly placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                    <input id="btnWeightsAndMeasureRenew" class="btn btn-success" type="submit" value="Renew">
                                </div>
                        </form>
                    </div>
                </div>

            </div>
            
            
            

            <!-- END OF MODALS -->
			

			<!-- begin row -->
			
			<!-- end row -->
		</div>
		<!-- end #content -->

            

    
@endsection

@section('page-js')

<script>
    $(document).ready(function() {
        App.init();
        FormWizardValidation.init();
        TableManageDefault.init();

        $('#tbl_weights_and_measure_list').DataTable({ "order": [[ 0, "desc" ]], "bSort": true });

        let data = {
			'_token': " {{ csrf_token() }}"
		};

        $.ajax({
            url: "{{route('getBusinessNumber')}}",
            type: 'GET',
            data: data,

            success: function(data){
                $.each(data["business_number"], function() {
					$('.business_name_list').append(`<option class="business_name_list_val" value="${this['BUSINESS_ID']}"> 
                                   ${this['BUSINESS_NAME']} 
                              </option>`);
				});
            }
        })
    });

    $("#btnSubmitWeightsAndMeasureRegistration").on('click', function(e){
        var BUSINESS_ID,
            LICENSE_NO = [],
			LICENSE_DATE = [],
			SALES_INVOICE = [],
			SI_DATE = [],
			DEVICE_TYPE = [],
			BRAND = [];
			MODEL = [];
			CAPACITY = [];
			SERIAL_NO = [];

		BUSINESS_ID = $(".business_name_list option:selected").val()
        

		$("input[name='LICENSE_NO[]']").each(function() {
			LICENSE_NO.push($(this).val());
		});
		$("input[name='LICENSE_DATE[]']").each(function() {
			LICENSE_DATE.push($(this).val());
		});
		$("input[name='SALES_INVOICE[]']").each(function() {
			SALES_INVOICE.push($(this).val());
		});
        $("input[name='SI_DATE[]']").each(function() {
			SI_DATE.push($(this).val());
		});
		$(".device_type_list option:selected").each(function() {
			DEVICE_TYPE.push($(this).val());
		});
		$("input[name='BRAND[]']").each(function() {
			BRAND.push($(this).val());
		});
		$("input[name='MODEL[]']").each(function() {
			MODEL.push($(this).val());
		});
		$("input[name='CAPACITY[]']").each(function() {
			CAPACITY.push($(this).val());
		});
		$("input[name='SERIAL_NO[]']").each(function() {
			SERIAL_NO.push($(this).val());
		});


        let data = { 
            '_token': " {{ csrf_token() }}"
            , 'BUSINESS_ID': BUSINESS_ID
            , 'LICENSE_NO': LICENSE_NO
            , 'LICENSE_DATE': LICENSE_DATE
            , 'SALES_INVOICE': SALES_INVOICE
            , 'SI_DATE': SI_DATE
            , 'DEVICE_TYPE': DEVICE_TYPE
            , 'BRAND': BRAND
            , 'MODEL': MODEL
            , 'CAPACITY': CAPACITY
            , 'SERIAL_NO': SERIAL_NO
        };

        console.log(data)

        swal({
				title: 'Success',
				text: 'Saved Record!',
				icon: 'success',
				timer: 1000
			});

            $.ajax({
                url: "{{ route('CRUDWeightsAndMeasureApplication') }}",
                method: "POST",
                data: data,
                success: function(data) {
					window.location.reload();
				},
				error: function(error) {
					console.log("error: " + error);
				}
            })
    })

    $("#btnAddWeightsAndMeasureActivity").on('click', function(e){
        e.preventDefault();

        let data = {
			'_token': " {{ csrf_token() }}"
		};

        $.ajax({
            url: "{{route('getBusinessNumber')}}",
            type: 'GET',
            data: data,

            success: function(data){
                console.log(data)
                $('#tbl_weights_and_measure_activity').find('tbody').append(
                    `
                    <tr class="classTrWeightsAndMeasureActivity">
                    <td><input type="text" name="LICENSE_NO[]" class="form-control"></td> \n'
                    <td><input type="date" name="LICENSE_DATE[]" class="form-control"></td> \n'
                    <td><input type="text" name="SALES_INVOICE[]" class="form-control"></td> \n'
                    <td><input type="date" name="SI_DATE[]" class="form-control"></td> \n'
                    <td>
                        <select class="device_type_list" name="DEVICE_TYPE[]">
                            <option disabled selected> -- Select Device Type -- </option>
                            <option value="LM">Linear Measure (Tape Measure, Yardstick, Caliper, Gauge, etc.)</option>
                            <option value="MC">Measure of Capacity (Fuel Dispensing Pump, calibration bucket, etc) </option>
                            <option value="GS">Graduated Scale Balance (Weighing Scales, etc)</option>
                            <option value="AB">Apothecary Balances (Mineral and Medicinal Uses)</option>
                        </select>
                    </td> \n'
                    <td><input type="text" name="BRAND[]" class="form-control"></td> \n'
                    <td><input type="text" name="MODEL[]" class="form-control"></td> \n'
                    <td><input type="text" name="CAPACITY[]" class="form-control"></td> \n'
                    <td><input type="text" name="SERIAL_NO[]" class="form-control"></td> \n'
                    <td><a class="btn btn-danger" onclick="if($(\'#tbl_weights_and_measure_activity tbody tr\').length>=1)$(this).closest(\'tr\').remove()"><i class="fa fa-minus text-white"></i></a></td>\n
                    </tr>
                    `
                );

                $.each(data["business_number"], function() {
					$('.business_name_list').append(`<option class="business_name_list_val" value="${this['BUSINESS_ID']}"> 
                                   ${this['BUSINESS_NAME']} 
                    </option>`);
				});
            }
        })
    })

    $('.btnView').on('click', function(e) {
        e.preventDefault();
		
		var row = $(this).closest("tr");
		weights_and_measure_id = $(this).closest('tr').attr('id');

        console.log(weights_and_measure_id);

		let data = {
			'_token': " {{ csrf_token() }}",
			'WEIGHTS_AND_MEASURE_ID': weights_and_measure_id,
			'TYPE': 'weightsandmeasure'
		};
		$.ajax({
			url: "{{route('SpecificBusinessApplication')}}",
			type: 'post',
			data: data,
			success:function(response) {
                let newData = response.specific_business;
                $('#lbl_weights_and_measure_number_view').html(newData[0].DEVICE_NUMBER);
                $('.txt_business_number_view').html(newData[0].BUSINESS_OR_NUMBER);
                $('.txt_business_name_view').html(newData[0].BUSINESS_NAME);
                $('.txt_business_address_view').html(newData[0].BUSINESS_ADDRESS);
                $('.txt_license_no_view').html(newData[0].LICENSE_NO);
                if(newData[0].DEVICE_TYPE == "LM"){
                    $('.txt_device_type_view').html('Linear Measure')
                }
                else if(newData[0].DEVICE_TYPE == "MC"){
                    $('.txt_device_type_view').html('Measure of Capacity')
                }
                else if(newData[0].DEVICE_TYPE == "GS"){
                    $('.txt_device_type_view').html('Graduated Scale Balance')
                }
                else if(newData[0].DEVICE_TYPE == "AB"){
                    $('.txt_device_type_view').html('Apothecary Balances')
                }
                $('.txt_license_date_view').html(newData[0].LICENSE_DATE);
                $('.txt_sales_invoice_view').html(newData[0].SALES_INVOICE);
                $('.txt_sales_invoice_date_view').html(newData[0].SI_DATE);
                $('.txt_device_number_view').html(newData[0].DEVICE_NUMBER);
                $('.txt_brand_view').html(newData[0].BRAND);
                $('.txt_model_view').html(newData[0].MODEL);
                $('.txt_capacity_view').html(newData[0].CAPACITY);
                $('.txt_serial_no_view').html(newData[0].SERIAL_NO);
			},
			error:function(error) {
				console.log(error)
			}
		});
	});
    $('.btnEdit').on('click', function(e) {
        e.preventDefault();
		
		var row = $(this).closest("tr");
		weights_and_measure_id = $(this).closest('tr').attr('id');

        console.log(weights_and_measure_id);

		let data = {
			'_token': " {{ csrf_token() }}",
			'WEIGHTS_AND_MEASURE_ID': weights_and_measure_id,
			'TYPE': 'weightsandmeasure'
		};
		$.ajax({
			url: "{{route('SpecificBusinessApplication')}}",
			type: 'post',
			data: data,
			success:function(response) {
                let newData = response.specific_business;
                $('#lbl_weights_and_measure_number').html(newData[0].DEVICE_NUMBER);
                $('#txt_weights_and_measure_id').val(newData[0].WEIGHTS_AND_MEASURE_ID);
                $('#txt_business_number').val(newData[0].BUSINESS_OR_NUMBER);
                $('#txt_business_name').val(newData[0].BUSINESS_NAME);
                $('#txt_business_address').val(newData[0].BUSINESS_ADDRESS);
                $('#txt_license_no_edit').val(newData[0].LICENSE_NO);
                $('#txt_license_date_edit').val(newData[0].LICENSE_DATE);
                $('#txt_sales_invoice_edit').val(newData[0].SALES_INVOICE);
                $('#txt_sales_invoice_date_edit').val(newData[0].SI_DATE);
                $('#txt_device_type_edit').val(newData[0].DEVICE_TYPE);
                $('#txt_brand_edit').val(newData[0].BRAND);
                $('#txt_device_number_edit').val(newData[0].DEVICE_NUMBER);
                $('#txt_model_edit').val(newData[0].MODEL);
                $('#txt_capacity_edit').val(newData[0].CAPACITY);
                $('#txt_serial_no_edit').val(newData[0].SERIAL_NO);
			},
			error:function(error) {
				console.log(error)
			}
		});
	});

    $('.btnDeactivate').on('click', function(e){
        e.preventDefault();

        let weights_and_measure_id = this.id;
        console.log(weights_and_measure_id)
        $('#txt_weights_and_measure_id_deactivate').val(weights_and_measure_id)

        $('#modal-Deactivate').modal()
    })

    $('.btnRevoke').on('click', function(e){
        e.preventDefault();

        let weights_and_measure_id = this.id;
        console.log(weights_and_measure_id)
        $('#txt_weights_and_measure_id_revoke').val(weights_and_measure_id)

        $('#modal-Revoke').modal()
    })

    $('#weightsandmeasure_form_deactivate').on('submit', function(e){
        e.preventDefault();

        let weights_and_measure_id = $('#txt_weights_and_measure_id_deactivate').val();
        let deactivation_reason = $('#txt_reason').val();

        let data = {
            '_token': " {{ csrf_token() }}",
            'TYPE': "DEACTIVATE",
            'WEIGHTS_AND_MEASURE_ID': weights_and_measure_id,
            'REASON': deactivation_reason
        }
        
        $.ajax({
            url: "{{route('UpdateWeightsAndMeasure')}}",
            type: "post",
            data: data,

            success: function(response){
                swal({
                    title: 'Success',
                    text: 'Record updated!',
                    icon: 'success',
                    timer: 1000
                });
                window.location.reload();
            },
            error: function(error){
                console.log(error)
            }
        })
    })

    $('#weightsandmeasure_form_revoke').on('submit', function(e){
        e.preventDefault();

        let weights_and_measure_id = $('#txt_weights_and_measure_id_revoke').val();
        let revoke_reason = $('#txt_revokereason').val();
        console.log(revoke_reason)

        let data = {
            '_token': " {{ csrf_token() }}",
            'TYPE': "REVOKE",
            'WEIGHTS_AND_MEASURE_ID': weights_and_measure_id,
            'REASON': revoke_reason
        }
        
        $.ajax({
            url: "{{route('UpdateWeightsAndMeasure')}}",
            type: "post",
            data: data,

            success: function(response){
                swal({
                    title: 'Success',
                    text: 'Record updated!',
                    icon: 'success',
                    timer: 1000
                });
                window.location.reload();
            },
            error: function(error){
                console.log(error)
            }
        })
    })

    $('.btn_renew').on('click', function(e) {
        e.preventDefault();
		
		var row = $(this).closest("tr");
		weights_and_measure_id = $(this).closest('tr').attr('id');

		let data = {
			'_token': " {{ csrf_token() }}",
			'WEIGHTS_AND_MEASURE_ID': weights_and_measure_id,
			'TYPE': 'weightsandmeasure'
		};
		$.ajax({
			url: "{{route('SpecificBusinessApplication')}}",
			type: 'post',
			data: data,
			success:function(response) {
                let newData = response.specific_business;
                $('#lbl_weights_and_measure_number_renew').html(newData[0].DEVICE_NUMBER)
                $('#txt_weights_and_measure_id_renew').val(newData[0].WEIGHTS_AND_MEASURE_ID);
                $('#txt_business_number_renew').val(newData[0].BUSINESS_OR_NUMBER);
                $('#txt_business_name_renew').val(newData[0].BUSINESS_NAME);
                $('#txt_business_address_renew').val(newData[0].BUSINESS_ADDRESS);
                $('#txt_license_no_edit_renew').val(newData[0].LICENSE_NO);
                if(newData[0].DEVICE_TYPE == "LM"){
                    $('#txt_device_type_edit_renew').val('Linear Measure')
                }
                else if(newData[0].DEVICE_TYPE == "MC"){
                    $('#txt_device_type_edit_renew').val('Measure of Capacity')
                }
                else if(newData[0].DEVICE_TYPE == "GS"){
                    $('#txt_device_type_edit_renew').val('Graduated Scale Balance')
                }
                else if(newData[0].DEVICE_TYPE == "AB"){
                    $('#txt_device_type_edit_renew').val('Apothecary Balances')
                }
                $('#txt_license_date_edit_renew').val(newData[0].LICENSE_DATE);
                $('#txt_sales_invoice_edit_renew').val(newData[0].SALES_INVOICE);
                $('#txt_sales_invoice_date_edit_renew').val(newData[0].SI_DATE);
                $('#txt_device_number_renew').val(newData[0].DEVICE_NUMBER);
                $('#txt_brand_edit_renew').val(newData[0].BRAND);
                $('#txt_model_edit_renew').val(newData[0].MODEL);
                $('#txt_capacity_edit_renew').val(newData[0].CAPACITY);
                $('#txt_serial_no_edit_renew').val(newData[0].SERIAL_NO);
			},
			error:function(error) {
				console.log(error)
			}
		});
	});

    $("#weightsandmeasure_form").on('submit', function(e){
        e.preventDefault();
        var form = $("#weightsandmeasure_form").serializeArray();
        let data = {
            '_token': " {{ csrf_token() }}",
            'TYPE': "NEW",
        }

        
        $.each(form, function(){
            data[[this.name]] = this.value;
        })

        $.ajax({
            url: "{{route('UpdateWeightsAndMeasure')}}",
            type: "post",
            data: data,

            success: function(response){
                swal({
                    title: 'Success',
                    text: 'Saved Record!',
                    icon: 'success',
                    timer: 1000
                });
                window.location.reload();
            },
            error: function(error){
                console.log(error)
            }
        })

    })
    
    $("#weightsandmeasure_renew_form").on('submit', function(e){
        e.preventDefault();
        let data = {
            '_token': " {{ csrf_token() }}",
            'NEW_RENEW_STATUS': "Renew",
            'TYPE': "RENEW",
            'WEIGHTS_AND_MEASURE_ID': $('#txt_weights_and_measure_id_renew').val()
        }

        console.log(data);

        $.ajax({
            url: "{{route('UpdateWeightsAndMeasure')}}",
            type: "post",
            data: data,

            success: function(response){
                swal({
                    title: 'Success',
                    text: 'Saved Record!',
                    icon: 'success',
                    timer: 1000
                });
                window.location.reload();
            },
            error: function(error){
                console.log(error)
            }
        })

    })

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

