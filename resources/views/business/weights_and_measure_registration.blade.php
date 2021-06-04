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

@section('page-js')
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>

<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.js')}}"></script>
<script src="{{asset('assets/js/demo/form-wizards.demo.min.js')}}"></script>
<script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->

<script src="{{asset('assets/plugins/highlight/highlight.common.js')}}"></script>
<script src="{{asset('assets/js/demo/render.highlight.js')}}"></script>
<script src="{{asset('assets/js/moment.js')}}"></script>


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
                            <table id="tbl_business_lst" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 12%">
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
                                    @foreach($weights_and_measure as $row)
                                        <tr class="gradeC" id="{{$row->WEIGHTS_AND_MEASURE_ID}}">
                                            <td>{{$row->BUSINESS_ID}}</td>
                                            <td style="text-transform: uppercase;">{{$row->LICENSE_NO == '' ? 'NOT STATED' : $row->BUSINESS_NAME}}</td>
                                            <td>{{$row->LICENSE_DATE}}</td>
                                            <td>{{$row->DEVICE_TYPE}}</td>
                                            <td>{{$row->BRAND}}</td>
                                            <td>{{$row->MODEL}}</td>
                                            <td>{{$row->CAPACITY}}</td>
                                            <td>{{$row->SERIAL_NO}}</td>
                                            
                                            <td>
                                                <div class="btn-group m-r-5 m-b-5">
                                                    <a href="javascript:;" class="btn btn-info">Action</a>
                                                    <a href="javascript:;" data-toggle="dropdown" class="btn btn-info dropdown-toggle"></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a data-toggle='modal' data-target='#modal-Edit' id="btnRenewOpen" style="cursor: pointer;">Edit</a></li>
                                                        <li><a id="btn_view" style="cursor: pointer;">View</a></li>
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
			

			<!-- begin row -->
			
			<!-- end row -->
		</div>
		<!-- end #content -->
	
@endsection

