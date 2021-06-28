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
                                        <th width="20%">
                                            <center>Action</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($weights_and_measure as $row)
                                        <tr class="gradeC" id="{{$row->WEIGHTS_AND_MEASURE_ID}}">
                                            <td>{{$row->BUSINESS_OR_NUMBER}}</td>
                                            <td>{{$row->LICENSE_NO}}</td>
                                            <td>{{$row->LICENSE_DATE}}</td>
                                            <td>{{$row->DEVICE_TYPE}}</td>
                                            <td>{{$row->BRAND}}</td>
                                            <td>{{$row->MODEL}}</td>
                                            <td>{{$row->CAPACITY}}</td>
                                            <td>{{$row->SERIAL_NO}}</td>

                                            <td>
                                                <button type="button" class="btn btn-primary form-control btnRequestWeightsAndMeasure" id="{{$row->WEIGHTS_AND_MEASURE_ID}}"  data-toggle="modal">
                                                    <i class="fa fa-file-alt">&nbsp</i> Request Weighing and Measuring Devices Clearance
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


            </div>

			<!-- begin row -->
			
			<!-- end row -->
		</div>
		<!-- end #content -->

        <div class="modal fade" id="modal-ChooseApplication" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background: #2A72B5" >
					<h4 class="modal-title" style="color: #fff">Issuance Request</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					{{-- <div class="panel-body"> --}}
						<h3><b><label id="lbl_business_name" >Business:</label></b></h3> <input type="text" hidden> <input type="text" id="txt_form_type" hidden>
                        <form>
							{{-- F - Clearance Weights and Measure  --}}
							<div class="col-md-10" id="divClearanceWeightsAndMeasure">
								<legend class="m-t-10"></legend>
								<h5 id="divFilloutInstruction">Fill out the following information:</h5><br>
								<input type="text" id="txt_weights_and_measure_id" hidden>
								<input type="text" id="txt_business_id" hidden>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Business No.</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_business_no_f" name="txt_business_no_f" readonly>
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Business Address.</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_business_address_f" name="txt_business_address_f" readonly>
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">License No.</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_license_no_f" name="txt_license_no_f" readonly>
									</div>
								</div>

								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Device Type</label>
									<div class="col-md-8">
										<input class="form-control" id="txt_device_type_f" name="txt_device_type_f" readonly/>
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Device Brand</label>
									<div class="col-md-8">
										<input class="form-control" id="txt_device_brand_f" name="txt_device_brand_f" readonly/>
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Device Model</label>
									<div class="col-md-8">
										<input class="form-control" id="txt_device_model_f" name="txt_device_model_f" readonly/>
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Capacity</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_capacity_f" name="txt_capacity_f" readonly>
									</div>
								</div>
								<div class="form-group row m-b-10">
									<label class="col-md-4 col-form-label text-md-right">Serial No.</label>
									<div class="col-md-8">
										<input type="text"  class="form-control" id="txt_serial_no_f" name="txt_serial_no_f" readonly>
									</div>
								</div>

                                <div id="divApplicantName">
                                    <br><legend class="m-t-10"></legend>
                                    <div class="col-md-10" id="divBusinessPermit">
                                        <label>Applicant's Name</label>
                                        <input type="text" id="txt_applicant_name" class="form-control" style="background-color: white;font-weight: bold; color: black;">
                                    </div>
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

    
@endsection

@section('page-js')

<script>
    $(document).ready(function() {
        App.init();
        FormWizardValidation.init();
        TableManageDefault.init();
        $("table[id='tbl_weights_and_measure_list']").DataTable({
			"bSort" : false
		});
    });


    $(".btnRequestWeightsAndMeasure").on('click', function(e){
        e.preventDefault();

        var weights_and_measure_id = this.id;

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
                $('#txt_weights_and_measure_id').val(newData[0].WEIGHTS_AND_MEASURE_ID);
                $('#txt_business_id').val(newData[0].BUSINESS_ID);
                $('#txt_applicant_name').val(newData[0].BUSINESS_OWNER_FIRSTNAME + " " + newData[0].BUSINESS_OWNER_MIDDLENAME + " " + newData[0].BUSINESS_OWNER_LASTNAME);
                $('#lbl_business_name').html(newData[0].BUSINESS_NAME);
                $('#txt_business_no_f').val(newData[0].BUSINESS_OR_NUMBER);
                $('#txt_business_address_f').val(newData[0].BUSINESS_ADDRESS);
                $('#txt_license_no_f').val(newData[0].LICENSE_NO);
                $('#txt_device_type_f').val(newData[0].DEVICE_TYPE);
                $('#txt_device_brand_f').val(newData[0].BRAND);
                $('#txt_device_model_f').val(newData[0].MODEL);
                $('#txt_capacity_f').val(newData[0].CAPACITY);
                $('#txt_serial_no_f').val(newData[0].SERIAL_NO);
                $('#modal-ChooseApplication').modal('show');
			},
			error:function(error) {
				console.log(error)
			}
		});

    })

    $("#btnRequest").on('click', function(e){
        e.preventDefault(e);
        let WEIGHTS_AND_MEASURE_ID = $('#txt_weights_and_measure_id').val()
        let BUSINESS_ID = $('#txt_business_id').val()
        let APPLICANT_NAME = $('#txt_applicant_name').val()
        let data = {
			'_token' : " {{ csrf_token() }}"

			// Weights and Measure - F
			,'F_LICENSE_NO' : $("#txt_license_no_f").val() // license no
			,'F_DEVICE_TYPE' : $("#txt_device_type_f").val() // device type
			,'F_CAPACITY' : $("#txt_capacity_f").val() // capacity
			,'F_SERIAL_NO' : $("#txt_serial_no_f").val() // serial no 
			,'F_BRAND' : $("#txt_device_brand_f").val() // serial no 
			,'F_MODEL' : $("#txt_device_model_f").val() // serial no 
			,'F_WEIGHTS_AND_MEASURE_ID' : WEIGHTS_AND_MEASURE_ID // serial no 

			//General
			,'BUSINESS_ID' : BUSINESS_ID
			,'WEIGHTS_AND_MEASURE_ID' : WEIGHTS_AND_MEASURE_ID
			,'APPLICANT_NAME' : APPLICANT_NAME
            ,'PAPER_TYPE_CLEARANCE': 'Barangay Clearance Weights and Measure'
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
    })
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

