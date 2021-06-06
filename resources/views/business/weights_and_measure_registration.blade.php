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
                                            <td>{{$row->WEIGHTS_AND_MEASURE_ID}}</td>
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

@section('page-js')

<script>
    $(document).ready(function() {
        App.init();
        FormWizardValidation.init();
        TableManageDefault.init();

        $('#tbl_weights_and_measure_list').DataTable({ "bSort": false });
    });

    $("#btnSubmitWeightsAndMeasureRegistration").on('click', function(e){
        var BUSINESS_ID = [],
            LICENSE_NO = [],
			LICENSE_DATE = [],
			DEVICE_TYPE = [],
			BRAND = [];
			MODEL = [];
			CAPACITY = [];
			SERIAL_NO = [];

		$(".business_number_list option:selected").each(function() {
			BUSINESS_ID.push($(this).val());
		});

		$("input[name='LICENSE_NO[]']").each(function() {
			LICENSE_NO.push($(this).val());
		});
		$("input[name='LICENSE_DATE[]']").each(function() {
			LICENSE_DATE.push($(this).val());
		});
		$("input[name='DEVICE_TYPE[]']").each(function() {
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

        console.log(BUSINESS_ID);
        console.log(LICENSE_NO);
        console.log(LICENSE_DATE);
        console.log(DEVICE_TYPE);
        console.log(BRAND);
        console.log(MODEL);
        console.log(CAPACITY);
        console.log(SERIAL_NO);

        swal({
				title: 'Success',
				text: 'Saved Record!',
				icon: 'success',
				timer: 1000
			});
		setTimeout(() => {
            window.location.reload();
		}, 1000);
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
                $('#tbl_weights_and_measure_activity').find('tbody').append(
                    `
                    <tr class="classTrWeightsAndMeasureActivity">
                        <td>
                            <select class="business_number_list" name="BUSINESS_ID[]">
                                <option>-- Business Number --</option>
                            </select>
                        </td>
                    <td><input type="text" name="LICENSE_NO[]" class="form-control"></td> \n'
                    <td><input type="text" name="LICENSE_DATE[]" class="form-control"></td> \n'
                    <td><input type="text" name="DEVICE_TYPE[]" class="form-control"></td> \n'
                    <td><input type="text" name="BRAND[]" class="form-control"></td> \n'
                    <td><input type="text" name="MODEL[]" class="form-control"></td> \n'
                    <td><input type="text" name="CAPACITY[]" class="form-control"></td> \n'
                    <td><input type="text" name="SERIAL_NO[]" class="form-control"></td> \n'
                    <td><a class="btn btn-danger" onclick="if($(\'#tbl_weights_and_measure_activity tbody tr\').length>=1)$(this).closest(\'tr\').remove()"><i class="fa fa-minus text-white"></i></a></td>\n
                    </tr>
                    `
                );

                $.each(data["business_number"], function() {
					$('.business_number_list').append(`<option class="business_number_list_val" value="${this['BUSINESS_ID']}"> 
                                   ${this['BUSINESS_OR_NUMBER']} 
                              </option>`);
				});
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

