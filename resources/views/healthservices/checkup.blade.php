@extends('global.main')


@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/lightbox/css/lightbox.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="content" id="content">
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Health Services</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Checkup</a></li>
	</ol>

	<h1 class="page-header">Checkup</h1>
	<input type="text" id="txt_CRUD_status" hidden>
	<div class="input-group input-group-lg m-b-20 search_header" >
		<input type="text" class="form-control input-white " placeholder="Search Patient" id="stext"/>
		<div class="input-group-append">
			<button  type="button" class="btn btn-primary search_btn" ><i class="fa fa-search fa-fw"></i> Search</button>
			
		</div>
	</div>

	<div style="background-color: white">
		<div class="result-list" style="padding: 20px; ">

		</div>
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
								<h4 class="modal-title" style="color: white; display: block; text-align: center;">Checkup Patient</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
							</div>
							<div class="modal-body">
								{{--modal body start--}}
								{{--<h2 id="ViewBarangayName" align="center"></h2>--}}
								<input type="text" name="PatientID" id="PatientID" hidden >           
								
							<div class="note note-warning">
								<div class="note-icon"><i class="fas fa-address-card"></i></div>
								<div class="note-content">
									<h4><b>Patient Information</b></h4>
							
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-md-6">
									<div class="stats-content">
									<label style="display: block; text-align: left">Patient Name</label>
									<input type="text" id="patient_name_txt" name="patient_name_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='' class="form-control" readonly >
									</div>
								</div>
								<div class="col-lg-4 col-md-6">
									<div class="stats-content">
										<label style="display: block; text-align: left">Gender</label>
										<input type="text" id="patient_gender_txt" name="patient_gender_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='' class="form-control" readonly >
									</div>
								</div>
								<div class="col-lg-4 col-md-6">
									<div class="stats-content">
										<label style="display: block; text-align: left">Age</label>
										<input type="text" id="patient_age_txt" name="patient_age_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='' class="form-control" readonly >
									</div>
								</div>	
							</div> 
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
										<label style="display: block; text-align: left">Body Temperature</label>
										<input type="text" id="patient_body_temp_txt" name="patient_body_temp_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='Body Temperature' class="form-control numbers-only" readonly >
									</div>
								</div>
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Blood Pressure</label>
										<input type="text" id="patient_blood_pressure_txt" name="patient_blood_pressure_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='Blood Pressure' class="form-control numbers-only" readonly >
									</div>
								</div>								
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Pulse Rate</label>
										<input type="text" id="patient_pulse_rate_txt" name="patient_pulse_rate_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='Pulse Rate' class="form-control numbers-only" readonly >
									</div>
								</div>								
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Respiratory Rate</label>
										<input type="text" id="patient_respiratory_rate_txt" name="patient_respiratory_rate_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='Respiratory Rate' class="form-control numbers-only" readonly >
									</div>
								</div>								
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Weight (kg)</label>
										<input type="text" id="patient_weight_txt" name="patient_weight_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='Weight (kg)' class="form-control" readonly >
									</div>
								</div>								
								<div class="col-lg-2 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Height (cm)</label>
										<input type="text" id="patient_height_txt" name="patient_height_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='Height (cm)' class="form-control" readonly >
									</div>
								</div>								
							</div> 

							<br>
							<div class="note note-success">
								<div class="note-icon"><i class="fas fa-hospital"></i></div>
								<div class="note-content">
								  <h4><b>Checkup</b></h4>							
								</div>
							  </div>
							<br>
							<div class="row">
							<div class="col-lg-4 col-md-4">
								<div class="stats-content">
									<label style="display: block; text-align: left">Chief Complaint</label>									
									<textarea class="form-control " id="cc_txt" rows="3"></textarea>
								</div>
							</div>

							<div class="col-lg-4 col-md-4">
								<div class="stats-content">
									<label style="display: block; text-align: left">Diagnosis</label>
									<textarea class="form-control " id="diagnosis_txt" rows="3"></textarea>
								</div>
							</div>

							<div class="col-lg-4 col-md-4">
								<div class="stats-content">
									<label style="display: block; text-align: left">Medication Treatment</label>
									<textarea class="form-control " id="mt_txt" rows="3"></textarea>
								</div>
							</div>

							
							</div>
							<br>
							<div class="row">
								<div class="col-lg-4 col-md-4">
									<div class="stats-content">
										<label style="display: block; text-align: left">Health Insurance</label>
										<select class="form-control"  target="1"  data-style="btn-lime" id="healthInsurance" name="healthInsurance">
											<option value="None" selected>None</option>
	                                        <option value="Philhealth Paying Member">Philhealth Paying Member</option>
	                                        <option value="Philhealth Dependent of Paying Member">Philhealth Dependent of Paying Member</option>
	                                        <option value="Philhealth Indigent Member">Philhealth Indigent Member</option>
	                                        <option value="Philhealth Dependent of Indigent Member">Philhealth Dependent of Indigent Member</option>
	                                        <option value="GSIS">GSIS</option>
	                                        <option value="SSS">SSS</option>
	                                        <option value="Private/HMO">Private/HMO</option>
	                                        <option value="Other">Other</option>
	                                    </select>
									</div>
								</div>
								<div id="other_txt" class="col-lg-3 col-md-4" style="display: none">
									<div class="stats-content">
										<label style="display: block; text-align: left">Other</label>
										<input class="form-control " id="healthInsurance_txt" id="healthInsurance_txt"/>
									</div>
								</div>
							</div>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
					<a href="javascript:;" class="btn btn-success add_btn" id="AddBtn">Add</a>

				</div>
			</div>
		</form>
		</div>
		</div>
		<!-- #modal-view-end -->
	
</div>
@endsection


@section('page-js')
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

	<script src="{{ asset('assets/plugins/lightbox/js/lightbox.min.js') }}"></script>
<script>
	$('#healthInsurance').change(function () {
        var healthInsurance = $('#healthInsurance').children(":selected").attr("value");
        if(healthInsurance == "Other") {
            $('#other_txt').show();
        } else {
            $('#other_txt').hide();
            $('#healthInsurance_txt').clear();
        }

    });

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


	
	$.ajax({
            url: "{{route('LoadPatients')}}",
            type: "get",
            dataType:'json',
            data: { _token: "{{csrf_token()}}" },            
            success:function(data)
            {

               
                if(data.length > 0) {
					
                    data.map( value => {
						console.warn(value['listofpatients'])
						if(value['listofpatients'].length != 0){
                        value['listofpatients'].map( residents => {
							
                            fullname = residents['FULLNAME'];
                            profilepic = residents['PROFILE_PICTURE'];					
                            image = 'background-image:url("{{asset("upload/residentspics/")}}/'+profilepic+'")';
                            profile_image = "{{asset('upload/residentspics/')}}/"+profilepic;
                            resident_id = residents['PATIENT_ID'];
                            residents['FULL_ADDRESS'] == null ? faddress = "" : faddress = residents['FULL_ADDRESS']
							
                           $('.result-list').append(
                            '<li class="list-of-residents">\n'

                            +'<a class="result-image" data-lightbox="gallery">\n'
                            	+'<img id="profile-image" src="" alt="" />&nbsp;</a>\n'

                            +'<div class="result-info">\n'
                                +'<h4 class="title "><a href="javascript:;">'+residents['FULLNAME']+'</a></h4>\n'                                
								+'<h3 id="age" hidden>'+residents['AGE']+'</a></h3>\n'                                
								+'<h3 id="gender" hidden>'+residents['SEX']+'</a></h3>\n'                                
								+'<h3 id="resident_id" hidden>'+residents['PATIENT_ID']+'</a></h3>\n' 
								
								+'<h3 id="body_temp" hidden>'+residents['BODY_TEMPERATURE']+'</a></h3>\n' 
								+'<h3 id="blood_pressure" hidden>'+residents['BLOOD_PRESSURE']+'</a></h3>\n' 
								+'<h3 id="pulse_rate" hidden>'+residents['PULSE_RATE']+'</a></h3>\n' 
								+'<h3 id="respiratory_rate" hidden>'+residents['RESPIRATORY_RATE']+'</a></h3>\n' 
								+'<h3 id="weight" hidden>'+residents['WEIGHT']+'</a></h3>\n' 
								+'<h3 id="height" hidden>'+residents['HEIGHT']+'</a></h3>\n' 
									                               
                                 +'<br><button data-toggle="modal" data-target="#show_patient_modal" class="btn btn-success btn-block show_modal_btn" id="ab_btn"> <i class="fa fa-user-circle "></i> Checkup</button>\n'
                            +'</div>\n'

                            // +'<div class="result-price" >Resident\n'
                           
                            // +'</div>\n'
                            +'</li>'
                            );

                       })
					}else{
						swal({
								title: "Information",
								text: "Patient name doesn't exist!",
								icon: 'info',
							});

					}
                    });
                }
                
                $('.result-image').attr('href',profile_image);
                $('#profile-image').attr('src',profile_image);
                $('#profile-image').attr('style',"width:240px; height:auto;");
                
            }
            ,
            error:function(error)
            {
                console.log(error)
            }

        });	
	

	$(document).on('click','.show_modal_btn',function(){
		$("#PatientID").val($(this).closest('div').find('#resident_id').text());
		$("#patient_name_txt").val($(this).closest('div').find('h4').text());
		$("#patient_age_txt").val($(this).closest('div').find('#age').text());
		$("#patient_gender_txt").val($(this).closest('div').find('#gender').text());
		

		$("#patient_body_temp_txt").val($(this).closest('div').find('#body_temp').text());
		$("#patient_blood_pressure_txt").val($(this).closest('div').find('#blood_pressure').text());
		$("#patient_pulse_rate_txt").val($(this).closest('div').find('#pulse_rate').text());
		$("#patient_respiratory_rate_txt").val($(this).closest('div').find('#respiratory_rate').text());
		$("#patient_weight_txt").val($(this).closest('div').find('#weight').text());
		$("#patient_height_txt").val($(this).closest('div').find('#height').text());

	});






	// search btn
	$(document).on('click','.search_btn',function() {
        
        $('.list-of-residents').remove();
        var searchval = $('#stext').val();
        var faddress = "";
        var profilepic = "";
        $.ajax({
            url: "{{route('SearchPatient')}}",
            type: "post",
            dataType:'json',
            data: { searchval: searchval, _token: "{{csrf_token()}}" },
            async:false,
            success:function(data)
            {

               
                if(data.length > 0) {
					
                    data.map( value => {
						console.warn(value['listofpatients'])
						if(value['listofpatients'].length != 0){
                        value['listofpatients'].map( residents => {
                            fullname = residents['FULLNAME'];
                            profilepic = residents['PROFILE_PICTURE'];
                            image = 'background-image:url("{{asset("upload/residentspics/")}}/'+profilepic+'")';
                            resident_id = residents['PATIENT_ID'];
                            residents['FULL_ADDRESS'] == null ? faddress = "" : faddress = residents['FULL_ADDRESS']
							
                           $('.result-list').append(
                            '<li class="list-of-residents">\n'

                            +'<a href="#" class="result-image"></a>\n'

                            +'<div class="result-info">\n'
                                +'<h4 class="title "><a href="javascript:;">'+residents['FULLNAME']+'</a></h4>\n'                                
								+'<h3 id="age" hidden>'+residents['AGE']+'</a></h4>\n'                                
								+'<h3 id="gender" hidden>'+residents['SEX']+'</a></h4>\n'                                
								+'<h3 id="resident_id" hidden>'+residents['PATIENT_ID']+'</a></h4>\n' 
								
								+'<h3 id="body_temp" hidden>'+residents['BODY_TEMPERATURE']+'</a></h3>\n' 
								+'<h3 id="blood_pressure" hidden>'+residents['BLOOD_PRESSURE']+'</a></h3>\n' 
								+'<h3 id="pulse_rate" hidden>'+residents['PULSE_RATE']+'</a></h3>\n' 
								+'<h3 id="respiratory_rate" hidden>'+residents['RESPIRATORY_RATE']+'</a></h3>\n' 
								+'<h3 id="weight" hidden>'+residents['WEIGHT']+'</a></h3>\n' 
								+'<h3 id="height" hidden>'+residents['HEIGHT']+'</a></h3>\n'
                                 +'<button data-toggle="modal" data-target="#show_patient_modal" class="btn btn-success btn-block show_modal_btn" id="ab_btn"> <i class="fa fa-user-circle "></i>Checkup</button>\n'
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
        
		



        $('.result-image').attr('style',image);

    });

    //add checkup button
	$("#AddBtn").click(function(){
		var my_function =  function()
		{
			healthInsurance = $("#healthInsurance").children(':selected').attr("value");
			if (healthInsurance == "Other"){
				healthInsurance = $("#healthInsurance_txt").val();
			}
			
			patient_id=$("#PatientID").val();				
			cc=$("#cc_txt").val();				
			diagnosis=$("#diagnosis_txt").val();				
			mt=$("#mt_txt").val();
			patient_id=$("#PatientID").val();


			$.ajax({
			url: "{{route('AddCheckup')}}",
			type: "post",	
			data: { 
					cc:cc,
					diagnosis:diagnosis,
					mt:mt,	
					healthInsurance:healthInsurance,					
					patient_id: patient_id,
					_token: "{{csrf_token()}}" },			
			success:function(data)
			{

				show_message('Success','Checkup successfull!','success');
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
</script>

	@endsection