@extends('global.main')


@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="content" id="content">
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Health Services</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Patient</a></li>
	</ol>

	<h1 class="page-header">Patient</h1>
	<input type="text" id="txt_CRUD_status" hidden>
	<div class="input-group input-group-lg m-b-20 search_header" >
		<input type="text" class="form-control input-white " placeholder="Search Resident/Inhabitant" id="stext"/>
		<div class="input-group-append">
			<button  type="button" class="btn btn-primary search_btn" ><i class="fa fa-search fa-fw"></i> Search</button>
			
		</div>
	</div>

	<div class="clear_search">
		<ul class="result-list">
			<br><br>
			
			





		</ul>

	</div>

	<!-- end result-list -->
	<!-- begin pagination -->
	<div class="clearfix m-t-20">
		<ul class="pagination pull-right">
			<li class="disabled"><a href="javascript:;" class="page-link">«</a></li>
			<li class="active"><a href="javascript:;" class="page-link">1</a></li>
			<li class="page-item"><a href="javascript:;" class="page-link">2</a></li>
			<li class="page-item"><a href="javascript:;" class="page-link">3</a></li>
			<li class="page-item"><a href="javascript:;" class="page-link">4</a></li>
			<li class="page-item"><a href="javascript:;" class="page-link">5</a></li>
			<li class="page-item"><a href="javascript:;" class="page-link">6</a></li>
			<li class="page-item"><a href="javascript:;" class="page-link">7</a></li>
			<li class="page-item"><a href="javascript:;" class="page-link">»</a></li>
		</ul>
	</div>
	<!-- end pagination -->





			<!-- Patient Modal -->
			<div class="modal fade" id="show_patient_modal">
				<div class="modal-dialog" style="max-width: 80%">
					<form id="PatientForm" method="post">
						{{csrf_field()}}

						<div class="modal-content">
							<div class="modal-header" style="background-color: #00acad">
								<h4 class="modal-title" style="color: white; display: block; text-align: center;">Add Patient</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
							</div>
							<div class="modal-body">
								{{--modal body start--}}
								{{--<h2 id="ViewBarangayName" align="center"></h2>--}}
								<input type="text" name="PatientID" id="PatientID" hidden >           
							{{-- patient information --}}
							<div class="note note-warning">
								<div class="note-icon"><i class="fas fa-address-card"></i></div>
								<div class="note-content">
									<h4><b>Patient Information</b></h4>
							
								</div>
							</div>
							<div class="row">
									<div class="col-lg-12 col-md-6">
										<div class="stats-content">
										<label style="display: block; text-align: left">Patient Name</label>
										<input type="text" id="patient_name_txt" name="patient_name_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='' class="form-control" readonly >
									</div>
								</div>
							</div> 
							
							<br>
							<div class="row">
								<div class="col-lg-4 col-md-6">
									<div class="stats-content">
										<label style="display: block; text-align: left">Gender</label>
										<input type="text" id="patient_gender_txt" name="patient_gender_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='' class="form-control" readonly >
									</div>
								</div>
								<div class="col-lg-2 col-md-6">
									<div class="stats-content">
										<label style="display: block; text-align: left">Age</label>
										<input type="text" id="patient_age_txt" name="patient_age_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='' class="form-control" readonly >
									</div>
									
								</div>	
								<div class="col-lg-2 col-md-6">
									<div class="stats-content">
										<label style="display: block; text-align: left">&nbsp;</label>
										<div class=" checkbox checkbox-css ">
											<input type="checkbox" id="cssCheckbox1" class="pregnant_chk"   />
											<label for="cssCheckbox1"> Is Pregnant?</label>
										</div>
									</div>
									
								</div>	
								
															
								
							</div>
							<br>
							{{-- mother info --}}
							<div class="mother_info_panel " style="display:none" >
							<div class="note note-lime">
								<div class="note-icon"><i class="fas fa-female"></i></div>
								<div class="note-content">
								  <h4><b>For Pregnant Mother</b></h4>
							
								</div>
							  </div>
							  <br>
							  <div class="row">
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Last Menstrual Period</label>
										<div class="input-group date" id="datetimepicker1">
                                            <input type="date" class="form-control" id="lmp_txt"/>                                           
                                        </div>
									</div>
								</div>
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Estimated Date of Conception</label>
										<div class="input-group date" id="datetimepicker1">
                                            <input type="date" class="form-control" id="edc_txt"/>
                                        </div>
									</div>
								</div>								
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Estimated Date of Delivery</label>
										<div class="input-group date" id="datetimepicker1">
                                            <input type="date" class="form-control" id="edd_txt"/>
                                        </div>
									</div>
								</div>								
															
							</div> 
							</div>
							{{-- patient vital signs --}}
							<br>
							<div class="note note-primary">
								<div class="note-icon"><i class="fas fa-stethoscope"></i></div>
								<div class="note-content">
								  <h4><b>Vital Signs</b></h4>
							
								</div>
							  </div>
							<br>
							<div class="row">
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Body Temperature (°C)</label>
										<input type="text" id="patient_body_temp_txt" name="patient_body_temp_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='Body Temperature' class="form-control numbers-only" required >
									</div>
								</div>
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Blood Pressure</label>
										<input type="text" id="patient_blood_pressure_txt" name="patient_blood_pressure_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='Blood Pressure' class="form-control" oninput="this.value = this.value.replace(/[^\d\/\d.]/g, '');">
									</div>
								</div>								
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Pulse Rate</label>
										<input type="text" id="patient_pulse_rate_txt" name="patient_pulse_rate_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='Pulse Rate' class="form-control numbers-only"  >
									</div>
								</div>								
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Respiratory Rate</label>
										<input type="text" id="patient_respiratory_rate_txt" name="patient_respiratory_rate_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='Respiratory Rate' class="form-control numbers-only"  >
									</div>
								</div>								
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Weight (kg)</label>
										<input type="text" id="patient_weight_txt" name="patient_weight_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='Weight (kg)' class="form-control"  >
									</div>
								</div>								
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Height (cm)</label>
										<input type="text" id="patient_height_txt" name="patient_height_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='Height (cm)' class="form-control"  >
									</div>
								</div>								
							</div> 
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
					<a href="javascript:;" class="btn btn-success" id="AddBtn">Add</a>

				</div>
			</div>
		</form>
		</div>
		</div>
		<!-- #modal-view-end -->
	
</div>
@endsection


@section('page-js')

<script>
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		$("table[id='tbl_resident_lst']").DataTable();
		$("table[id='tbl_child_lst']").DataTable();

		$('#txt_nonresident_birthdate').datepicker({
            maxDate:-4015,
            dateFormat: "yy-mm-dd"
        });
	});

	$(".pregnant_chk").change(function(){
		$(".mother_info_panel").show();
		if($(this).is(':checked') == true)
		{
			$(".mother_info_panel").show();
		}else{
			$(".mother_info_panel").hide();
		}
	});

	$(document).on('click','.show_modal_btn',function(){
		$("#PatientID").val($(this).closest('div').find('#resident_id').text());
		$("#patient_name_txt").val($(this).closest('div').find('h4').text());
		$("#patient_age_txt").val($(this).closest('div').find('#age').text());
		$("#patient_gender_txt").val($(this).closest('div').find('#gender').text());

		if($(this).closest('div').find('#gender').text()=='Female' && $(this).closest('div').find('#age').text()>=12)
		{
			$(".pregnant_chk").show();
		}else{
			$(".pregnant_chk").hide();
		}

	});

	// search btn
	$(document).on('click','.search_btn',function() {
        
        $('.list-of-residents').remove();
        var searchval = $('#stext').val();
        var faddress = "";
        var profilepic = "";
        $.ajax({
            url: "{{route('ResidentsSearch')}}",
            type: "post",
            dataType:'json',
            data: { searchval: searchval, _token: "{{csrf_token()}}" },
            async:false,
            success:function(data)
            {

               
                if(data.length > 0) {
					
                    data.map( value => {
						console.warn(value['listofresidents'])
						if(value['listofresidents'].length != 0){
                        value['listofresidents'].map( residents => {
                            fullname = residents['FULLNAME'];
                            profilepic = residents['PROFILE_PICTURE'];
                            image = 'background-image:url("{{asset("upload/residentspics/")}}/'+profilepic+'")';
                            resident_id = residents['RESIDENT_ID'];
                            residents['FULL_ADDRESS'] == null ? faddress = "" : faddress = residents['FULL_ADDRESS']
							
                           $('.result-list').append(
                            '<li class="list-of-residents">\n'

                            +'<a href="#" class="result-image"></a>\n'

                            +'<div class="result-info">\n'
                                +'<h4 class="title "><a href="javascript:;">'+residents['FULLNAME']+'</a></h4>\n'                                
								+'<h3 id="age" hidden>'+residents['AGE']+'</a></h4>\n'                                
								+'<h3 id="gender" hidden>'+residents['SEX']+'</a></h4>\n'                                
								+'<h3 id="resident_id" hidden>'+residents['RESIDENT_ID']+'</a></h4>\n'                                
                                 +'<button data-toggle="modal" data-target="#show_patient_modal" class="btn btn-success btn-block show_modal_btn " id="ab_btn"> <i class="fa fa-user-circle "></i> Add Patient</button>\n'
                            +'</div>\n'

                            // +'<div class="result-price" >Resident\n'
                           
                            // +'</div>\n'
                            +'</li>'
                            );

                       })
					}else{
						swal({
								title: "Information",
								text: "Resident name doesn't exist!",
								icon: 'info',
							});

					}
                    });
                }
                
                
                
            }
            ,
            error:function(error)
            {
                console.log(error)
            }

        });	
        
		//add patient button
		$("#AddBtn").click(function(){
					
					
			var my_function =  function()
			{
				body_temp=$("#patient_body_temp_txt").val()
				blood_pressure=$("#patient_blood_pressure_txt").val()
				pulse_rate=$("#patient_pulse_rate_txt").val()
				respiratory_rate=$("#patient_respiratory_rate_txt").val()
				weight=$("#patient_weight_txt").val()
				height=$("#patient_height_txt").val()
				resident_id=$("#PatientID").val()
				is_pregnant=$(".pregnant_chk").is(':checked');
				lmp=$("#lmp_txt").val()
				edc=$("#edc_txt").val()
				edd=$("#edd_txt").val()
				


				$.ajax({
				url: "{{route('AddPatient')}}",
				type: "post",	
				data: { 
						body_temp: body_temp,
						blood_pressure: blood_pressure,
						pulse_rate: pulse_rate,
						respiratory_rate: respiratory_rate,
						weight: weight,
						height: height,
						resident_id: resident_id,
						is_pregnant : is_pregnant == true ? 1 : 0,
						lmp:lmp,
						edc:edc,
						edd:edd,
						_token: "{{csrf_token()}}" },			
				success:function(data)
				{

					show_message('Success','Adding patient successfull!','success');
					location.reload();
							
							
							
				}
				,
				error:function(error)
				{
					alert(error)
				}

			});
		}

		show_confirmation('Do you want to add this patient?',my_function);

		});



        $('.result-image').attr('style',image);

    });
</script>
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
	@endsection