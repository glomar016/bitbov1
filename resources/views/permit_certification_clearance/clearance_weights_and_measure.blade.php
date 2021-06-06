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
                <li class="breadcrumb-item"><a href="javascript:;">Permit/Certification/Clearance</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Request</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Clearance</a></li>
			</ol>
			<!-- end breadcrumb -->

			<!-- begin page-header -->
            <h1 class="page-header">Request Clearance <small>DILG Requirements</small></h1>
			<!-- end page-header -->
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
                                            <center>Business Number</center>
                                        </th>
                                        <th>
                                            <center>LICENSE_NO </center>
                                        </th>
                                        <th>
                                            <center>LICENSE_DATE</center>
                                        </th>
                                        <th>
                                            <center>DEVICE_TYPE</center>
                                        </th>
                                        <th>
                                            <center>BRAND</center>
                                        </th>
                                        <th>
                                            <center>MODEL </center>
                                        </th>
                                        <th>
                                            <center>CAPACITY  </center>
                                        </th>
                                        <th>
                                            <center>SERIAL_NO   </center>
                                        </th>
                                        {{-- <th>Period</th> --}}
                                        <th>
                                            <center>Action</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                        <!-- end panel-body -->
                    </div>
                </div>


            </div>

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
    });
</script>

<script src="{{asset('custom/jasonday-printThis-edc43df/printThis.js')}}"></script>
{{-- For table --}}
<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></scrip>
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

