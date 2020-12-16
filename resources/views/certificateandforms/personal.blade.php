@extends('global.main')

@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />


@endsection

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Permit/Certification/Clearance</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Certification (Residency)</a></li>
	</ol>

	<h1 class="page-header">Certification<small>DILG Requirements</small></h1>

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			</div>
			<h4 class="panel-title">Certification</h4>
		</div>
		<div class="alert alert-yellow fade show">
			<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">&times;</span>
			</button>
			The following are the existing records of the residents within the system.
		</div>
		<div class="panel-body">
			<table id="tbl_resident_lst" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th width="10%">Name</th>
						<th width="20%">Address</th>
						<th>Birthdate</th>
						<th width="25%">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($resident as $row)
					<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
						<td>{{ $row->FIRSTNAME }} {{ $row->MIDDLENAME }} {{ $row->LASTNAME }}</td>
						<td>{{ $row->ADDRESS_UNIT_NO }} {{ $row->ADDRESS_PHASE }} {{ $row->ADDRESS_BLOCK_NO }} {{ $row->ADDRESS_HOUSE_NO }} {{ $row->ADDRESS_STREET }} {{ $row->ADDRESS_SUBDIVISION }} {{ $row->ADDRESS_BUILDING }}</td>
						<td id="birthday">{{ $row->DATE_OF_BIRTH }}</td>
						<td>
							<a id="btnViewForms" class="btn btn-inverse m-r-5 m-b-5" data-toggle="modal" data-target="#modal-SelectCertificate" style="color: #fff">
								<i class="fa fa-edit" style="color:#fff"></i>&nbsp;Select a Certificate to generate</a>	
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="fillers" id="fillers" hidden>

			@include('certificateandforms.fm_bcert_001a_printable')
			@include('certificateandforms.fm_bcert_001b_printable')
			@include('certificateandforms.fm_bcert_001c_printable')
			@include('certificateandforms.fm_bcert_001d_printable')
			@include('certificateandforms.fm_bcert_001e_printable')
			@include('certificateandforms.fm_bcert_001f_printable')
		</div>
		<input type="text" id="txt_resident_no"  hidden />	
		<input type="text" id="txt_issuance_type" hidden/>

		{{-- SELECT FORMS --}}
		<div class="modal fade" id="modal-SelectCertificate" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header"  style="background: #000" id="modalHeader">
						<h4 class="modal-title" style="color: #fff"> Generate Resident Certificate</h4>
						<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
					</div>
					<div class="modal-body">
						<h2 id="lbl_resname" >Resident:</h2>
						<input type="text" id="txt_resid" hidden/>
						<div class="col-md-10">
							<label>Select Certificate:</label>
							<select class="form-control" id="sel_certificate_type" style="color: black;" >
								<option selected disabled value=""></option>
								<option value="">Barangay Certificate Residency</option>
								<option value="">Barangay Certificate Calamity Loan SSS-GSIS</option>
								<option value="">Barangay Certificate Calamity Loan OFW</option>
								<option value="">Barangay Certificate SPES</option>
								<option value="">Barangay Certificate Solo Parent</option>
								<option value="">Barangay Certificate Indigency</option>
							</select>
						</div>
				

						{{-- Residency --}}
						<div class="col-md-10" id="divResidency">
							<legend class="m-t-10"></legend>
							<h5 id="divFilloutInstruction">Fill out the following information:</h5>

							<label>Purpose</label> 
							<textarea class="form-control" id="txtarea_purpose_residency"></textarea>
						</div>
						{{-- Loan SSS-GSIS --}}
						<div class="col-md-10" id="divLoanSSSGSIS">
							<legend class="m-t-10"></legend>
							<h5 id="divFilloutInstruction">Fill out the following information:</h5>

							<label>SSS/GSIS No</label>
							<input type="text" id="txt_sssgsis_no_loansssgsis" class="form-control">
							<br>
							<label>Name of Calamity/Disaster</label>
							<input type="text" id="txt_calamityname_loansssgsis" class="form-control">
							<br>
							<label>Date of Calamity/Disaster</label>
							<input type="date" id="txt_calamitydate_loansssgsis" class="form-control">
						</div>
						{{-- Loan OFW --}}
						<div class="col-md-10" id="divLoanOFW">
							<legend class="m-t-10"></legend>
							<h5 id="divFilloutInstruction">Fill out the following information:</h5>

							<label>SSS No</label>
							<input type="text" id="txt_sss_loanofw" class="form-control">
							<br>
							<label>Name of Calamity/Disaster</label>
							<input type="text" id="txt_calamityname_loanofw" class="form-control">
							<br>
							<label>Date of Calamity/Disaster</label>
							<input type="date" id="txt_calamitydate_loanofw" class="form-control">
							<br>
							<label>Country</label>
							<input type="text" id="txt_country_loanofw" class="form-control">
						</div>
						{{-- Solo Parent --}}
						<div class="col-md-10" id="divSoloParent">
							<legend class="m-t-10"></legend>
							<h5 id="divFilloutInstruction">Fill out the following information:</h5>

							<label>Category of Single Parent</label>
							<input type="text" id="txt_single_parent_category" class="form-control">
							<br>
							<label>Requestor name</label>
							<input type="text" id="txt_requester_name" class="form-control">

							<br>
							<label>Child/ren under custody</label>
							<div class="row">
								<div class="col-md-10">
									<p><button type="button" id="btnAddCustody" class="btn btn-primary">Add</button></p>
								</div>
							</div>

							<div id="divChildCustody_1" class="row-control"> Child 1<br>
								<input type="text"  class="form-control" placeholder="Name" id="lbl_child_name_1">
								<br>
								<input type="text"  class="form-control" placeholder="Age" id="lbl_child_age_1">
								<br>
								<div class="col-md-8" class="form-control">
									<label>Is PWD? &nbsp</label>
                                    	<div class="radio radio-css radio-inline" >
                                            <input type="radio" id="radiobtn_yes_1" name="group1" value="option1" >
											<label for="radiobtn_yes_1">Yes</label>
										</div>
                                    	<div class="radio radio-css radio-inline">
                                            <input type="radio"  id="radiobtn_no_1" name="group1" value="option2" >
                                            <label for="radiobtn_no_1">No</label>
                                        </div>
                                    </div>
							</div>

							<div id="divChildCustody_2" class="row-control"><legend class="m-t-8"></legend> Child 2<br>
								
								<input type="text"  class="form-control" placeholder="Name" id="lbl_child_name_2">
								<br>
								<input type="text" class="form-control" placeholder="Age" id="lbl_child_age_2">
								<br>
								<div class="col-md-8" class="form-control">
									<label>Is PWD? &nbsp</label>
                                    	<div class="radio radio-css radio-inline">
                                            <input type="radio" id="radiobtn_yes_2" value="option1" name="group2">
											<label for="radiobtn_yes_2">Yes</label>
										</div>
                                    	<div class="radio radio-css radio-inline">
                                            <input type="radio"  id="radiobtn_no_2" value="option2" name="group2" >
                                            <label for="radiobtn_no_2">No</label>
                                        </div>
                                    </div>
								<div align="right"><button type="button" class="btn btn-danger btnRemoveCustody2" id="btnRemoveCustody_2" align="right">Remove</button></div>
								<br>
								
							</div>

						</div>
						{{-- Indigency --}}
						<div class="col-md-10" id="divIndigency">
							<legend class="m-t-10"></legend>
							<h5 id="divFilloutInstruction">Fill out the following information:</h5>

							<label>Purpose</label> 
							<textarea class="form-control" id="txtarea_purpose_indigency"></textarea>
						</div>

						<legend class="m-t-10"></legend>
						{{-- OR DETAILS --}}
						<div class="col-md-10">
							<h5>OR Details</h5>

							<label>OR Number</label>
							<input type="text" id="txt_or_number" class="form-control"/>
							<label>OR Amount</label>
							<input type="text" id="txt_or_amount" class="form-control"/>
						</div>
						
					
						<legend class="m-t-10"></legend>
						<div align="right">
							<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
							<button  id="btnGenerate" class="btn btn-inverse m-r-9" style="background: #000">Generate</button>
						</div>				
					</div>
				</div>
			</div>
		</div>



	</div>
@endsection

@section('page-js')
<script src="{{asset('custom/jasonday-printThis-edc43df/printThis.js')}}"></script>
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

<script>
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		$("table[id='tbl_resident_lst']").DataTable();	

		$('#divResidency').hide();
		$('#divLoanSSSGSIS').hide();
		$('#divLoanOFW').hide();
		$('#divSoloParent').hide()
		$('#divIndigency').hide();
		$('#divChildCustody_2').hide();
	});

	
	//ADD CHILD CUSTODY
	$('#btnAddCustody').on('click', function(){
		$('#divChildCustody_2').show();
	});

	$('#btnRemoveCustody_2').on('click', function(){
		$('#divChildCustody_2').hide();
		$('#lbl_child_name_2').val("");
		$('#lbl_child_age_2').val("");
		$("#radiobtn_yes_2").prop("checked", false);
		$("#radiobtn_no_2").prop("checked", false);
	});
	//VIEW CERTIFICATE
	$('#tbl_resident_lst').on('click', '#btnViewForms', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$("input[id='txt_resid']").val(row.attr("id"));
		$('#lbl_resname').text(name);
	});
	//SELECT CERTIFICATE
	$('#sel_certificate_type').on('change', function(){
			var certificate_type = $('#sel_certificate_type option:selected').text();
			if(certificate_type == "Barangay Certificate Residency"){
				//show
				$('#divResidency').show();
				//hide
				$('#divLoanSSSGSIS').hide();
				$('#divLoanOFW').hide();
				$('#divSoloParent').hide()
				$('#divIndigency').hide();
			}

			else if(certificate_type == "Barangay Certificate Calamity Loan SSS-GSIS"){
				//show
				$('#divLoanSSSGSIS').show();
				// hide
				$('#divResidency').hide();
				$('#divLoanOFW').hide();
				$('#divSoloParent').hide()
				$('#divIndigency').hide();
			}

			else if(certificate_type == "Barangay Certificate Calamity Loan OFW"){
				//show
				$('#divLoanOFW').show();
				//hide
				$('#divResidency').hide();
				$('#divLoanSSSGSIS').hide();
				$('#divSoloParent').hide()
				$('#divIndigency').hide();
			}
			else if(certificate_type == "Barangay Certificate SPES"){
				//show
				$('#divResidency').hide();
				$('#divLoanSSSGSIS').hide();
				$('#divLoanOFW').hide();
				$('#divSoloParent').hide()
				$('#divIndigency').hide();
				//hide
			}
			else if(certificate_type == "Barangay Certificate Solo Parent"){
				//hide
				$('#divResidency').hide();
				$('#divLoanSSSGSIS').hide();
				$('#divLoanOFW').hide();
				$('#divIndigency').hide();
				//show
				$('#divSoloParent').show()
			}
			else if(certificate_type == "Barangay Certificate Indigency"){
				//show
				$('#divIndigency').show();
				//hide
				$('#divResidency').hide();
				$('#divLoanSSSGSIS').hide();
				$('#divLoanOFW').hide();
				$('#divSoloParent').hide()
			}
	});

	//PRINT CERTIFICATE
	$('#btnGenerate').on('click', function(){
		
		var certificate_type = $('#sel_certificate_type option:selected').text();
		//Barangay Certificate Residency
		if(certificate_type == "Barangay Certificate Residency"){
			let data = {
				'_token' : " {{ csrf_token() }}"
				,'RESIDENT_ID': $("input[id='txt_resid']").val()
				,'ISSUANCE_TYPE' : certificate_type
				,'PURPOSE' : $("#txtarea_purpose_residency").val()
				,'OR_NUMBER': $("input[id='txt_or_number']").val()
				,'OR_AMOUNT': $("input[id='txt_or_amount']").val()
				,'REMARKS_CONTENT' : $("#txtarea_purpose_residency").val()
			};

			var firstname, middlename,lastname, civilstatus, unit, phase, block, house, street, subdivision, building;

			$.ajax({
				url : "{{ route('PersonalPrintableData') }}",
				method : 'POST',
				data : data,
				success : function(response) {
						
					$.each(response["specific_person"], function(){
						//GET DATA
						firstname = this["FIRSTNAME"];
						middlename = this["MIDDLENAME"];
						lastname = this["LASTNAME"];
						civilstatus = this["CIVIL_STATUS"];
						unit = this["ADDRESS_UNIT_NO"];
						phase = this["ADDRESS_PHASE"];
						block = this["ADDRESS_BLOCK_NO"];
						house = this["ADDRESS_HOUSE_NO"];
						street = this["ADDRESS_STREET"];
						subdivision = this["ADDRESS_SUBDIVISION"];
						building = this["ADDRESS_BUILDING"];
					});

					// alert(response["issuance_number"]);

					if(unit==null){unit = "";} if(phase==null){phase = "";} if(block==null){block = "";} if(house==null){house = "";} if(street==null){street = "";} if(subdivision==null){subdivision = "";}  if(building==null){building = "";} 
					
					$("#lbl_applicant").text(firstname + " " + middlename + " " + lastname);
					$("#lbl_applicant2").text(firstname + " " + middlename + " " + lastname);
					$("#lbl_civil_status").text(civilstatus);
					$("#lbl_address").text(unit + " " + phase + " " + block  + " " + house  + " " + street + " " + subdivision + " " + building);
					$("#lbl_purpose").text($("#txtarea_purpose_residency").val());
					$("#lbl_or_no").text($("input[id='txt_or_number']").val());
					$("#lbl_amount").text($("input[id='txt_or_amount']").val());
					$("#lbl_control_no_a").text(response["issuance_number"]);
					$("#fmbcert001a").printThis({
								 debug: false,               
								 debug: false,              
						         importCSS: true,           
						         importStyle:true,         
						         loadCSS: "",             
						         pageTitle: "fdas",             
						         removeInline: false,       
						         printDelay: 1000,           
						         header: null,        
						         footer: "",       
						         base: false ,             
						         formValues: true,     
						         canvas: false,           
						         doctypeString: null,      
						         removeScripts: false,  
						         copyTagClasses: false     	        
					     });

				},
				error : function(error){
					console.log("error: " + error);
					Cancelled();
				}
			});	
		}
		// Barangay Certificate Calamity Loan SSS-GSIS
		else if (certificate_type == "Barangay Certificate Calamity Loan SSS-GSIS"){
			let data = {
				'_token' : " {{ csrf_token() }}"
				,'RESIDENT_ID': $("input[id='txt_resid']").val()
				,'ISSUANCE_TYPE' : certificate_type
				,'PURPOSE' : 'Calamity Loan SSS-GSIS'
				,'SSS_GSIS': $("input[id='txt_sssgsis_no_loansssgsis']").val()
				,'CALAMITY_NAME': $("input[id='txt_calamityname_loansssgsis']").val()
				,'CALAMITY_DATE': $("input[id='txt_calamitydate_loansssgsis']").val()
				,'OR_NUMBER': $("input[id='txt_or_number']").val()
				,'OR_AMOUNT': $("input[id='txt_or_amount']").val()
				,'REMARKS_CONTENT' : 'For ' + $("input[id='txt_calamityname_loansssgsis']").val() + ' occured on ' + $("input[id='txt_calamitydate_loansssgsis']").val()

			};

			var firstname, middlename,lastname, civilstatus, unit, phase, block, house, street, subdivision, building, gsis,sss;

			$.ajax({
				url : "{{ route('PersonalPrintableData') }}",
				method : 'POST',
				data : data,
				success : function(response) {
						
					$.each(response["specific_person"], function(){
							//GET DATA
				          firstname = this["FIRSTNAME"];
				          middlename = this["MIDDLENAME"];
				          lastname = this["LASTNAME"];
				          civilstatus = this["CIVIL_STATUS"];
				          unit = this["ADDRESS_UNIT_NO"];
				          phase = this["ADDRESS_PHASE"];
				          block = this["ADDRESS_BLOCK_NO"];
				          house = this["ADDRESS_HOUSE_NO"];
				          street = this["ADDRESS_STREET"];
				          subdivision = this["ADDRESS_SUBDIVISION"];
				          building = this["ADDRESS_BUILDING"];
				          gsis = this["GSIS_NO"];
				          sss = this["SSS_NO"]
					});

					if(unit==null){unit = "";} if(phase==null){phase = "";} if(block==null){block = "";} if(house==null){house = "";} if(street==null){street = "";} if(subdivision==null){subdivision = "";}  if(building==null){building = "";} 
					
					$("#lbl_applicantB").text(firstname + " " + middlename + " " + lastname);
			        $("#lbl_civil_statusB").text(civilstatus);
			        $("#lbl_addressB").text(unit + " " + phase + " " + block  + " " + house  + " " + street + " " + subdivision + " " + building);
	        		$('#lbl_sss_gsisB').text($("input[id='txt_sssgsis_no_loansssgsis']").val());
	        		$('#lbl_calamity_name').text($("input[id='txt_calamityname_loansssgsis']").val());
	        		$('#lbl_calamity_date').text($("input[id='txt_calamitydate_loansssgsis']").val());
	        		$("#lbl_or_no_b").text($("input[id='txt_or_number']").val())
					$("#lbl_amount_b").text($("input[id='txt_or_amount']").val())
					$("#lbl_control_no_b").text(response["issuance_number"]);
					console.log(response["message"]);

					$("#fmbcert001b").printThis({
								 debug: false,               
								 debug: false,              
						         importCSS: true,           
						         importStyle:true,         
						         loadCSS: "",             
						         pageTitle: "fdas",             
						         removeInline: false,       
						         printDelay: 1000,           
						         header: null,        
						         footer: "",       
						         base: false ,             
						         formValues: true,     
						         canvas: false,           
						         doctypeString: null,      
						         removeScripts: false,  
						         copyTagClasses: false     	        
					     });

				},
				error : function(error){
					console.log("error: " + error);
					Cancelled();
				}
			});	
		}
		//Barangay Certificate Calamity Loan OFW
		else if(certificate_type == "Barangay Certificate Calamity Loan OFW"){
			let data = {
				'_token' : " {{ csrf_token() }}"
				,'RESIDENT_ID': $("input[id='txt_resid']").val()
				,'ISSUANCE_TYPE' : certificate_type
				,'SSS_GSIS': $("input[id='txt_sss_loanofw']").val()
				,'CALAMITY_NAME': $("input[id='txt_calamityname_loanofw']").val()
				,'CALAMITY_DATE': $("input[id='txt_calamitydate_loanofw']").val()
				,'COUNTRY': $("input[id='txt_country_loanofw']").val()
				,'OR_NUMBER': $("input[id='txt_or_number']").val()
				,'OR_AMOUNT': $("input[id='txt_or_amount']").val()
				,'REMARKS_CONTENT': 'OFW from ' + $("input[id='txt_country_loanofw']").val() + ' for the calamity '+ $("input[id='txt_calamityname_loanofw']").val() +' occured on ' +  $("input[id='txt_calamitydate_loanofw']").val()
			};

			var firstname, middlename,lastname, civilstatus, unit, phase, block, house, street, subdivision, building, sss;

			$.ajax({
				url : "{{ route('PersonalPrintableData') }}",
				method : 'POST',
				data : data,
				success : function(response) {
						
					$.each(response["specific_person"], function(){
							//GET DATA
				         firstname = this["FIRSTNAME"];
				          middlename = this["MIDDLENAME"];
				          lastname = this["LASTNAME"];
				          civilstatus = this["CIVIL_STATUS"];
				          unit = this["ADDRESS_UNIT_NO"];
				          phase = this["ADDRESS_PHASE"];
				          block = this["ADDRESS_BLOCK_NO"];
				          house = this["ADDRESS_HOUSE_NO"];
				          street = this["ADDRESS_STREET"];
				          subdivision = this["ADDRESS_SUBDIVISION"];
				          building = this["ADDRESS_BUILDING"];
				          sss = this["SSS_NO"]
					});

					if(unit==null){unit = "";} if(phase==null){phase = "";} if(block==null){block = "";} if(house==null){house = "";} if(street==null){street = "";} if(subdivision==null){subdivision = "";}  if(building==null){building = "";} 
					
					$("#lbl_applicantC").text(firstname + " " + middlename + " " + lastname);
			        $("#lbl_applicant2C").text(firstname + " " + middlename + " " + lastname);
			        $("#lbl_civil_statusC").text(civilstatus);
			        $("#lbl_addressC").text(unit + " " + phase + " " + block  + " " + house  + " " + street + " " + subdivision + " " + building);
			        $('#lbl_sss_noC').text($("input[id='txt_sss_loanofw']").val());
			        $('#lbl_calamity_name_c').text($("input[id='txt_calamityname_loanofw']").val());
			        $('#lbl_calamity_date_c').text($("input[id='txt_calamitydate_loanofw']").val());
			        $('#lbl_country').text($("input[id='txt_country_loanofw']").val());
			        $("#lbl_or_no_c").text($("input[id='txt_or_number']").val())
					$("#lbl_amount_c").text($("input[id='txt_or_amount']").val())
					$("#lbl_control_no_c").text(response["issuance_number"]);
					
					console.log(response["message"]);

					$("#fmbcert001c").printThis({
								 debug: false,               
								 debug: false,              
						         importCSS: true,           
						         importStyle:true,         
						         loadCSS: "",             
						         pageTitle: "fdas",             
						         removeInline: false,       
						         printDelay: 1000,           
						         header: null,        
						         footer: "",       
						         base: false ,             
						         formValues: true,     
						         canvas: false,           
						         doctypeString: null,      
						         removeScripts: false,  
						         copyTagClasses: false     	        
					     });

				},
				error : function(error){
					console.log("error: " + error);
					Cancelled();
				}
			});	
		}
		//Barangay Certificate SPES
		else if(certificate_type == "Barangay Certificate SPES"){
			let data = {
				'_token' : " {{ csrf_token() }}"
				,'RESIDENT_ID': $("input[id='txt_resid']").val()
				,'ISSUANCE_TYPE' : certificate_type
				,'OR_NUMBER': $("input[id='txt_or_number']").val()
				,'OR_AMOUNT': $("input[id='txt_or_amount']").val()
				,'REMARKS_CONTENT': 'For Special Program for the Employment of Students'
			};

			var firstname, middlename,lastname, civilstatus, unit, phase, block, house, street, subdivision, building, sex;

			$.ajax({
				url : "{{ route('PersonalPrintableData') }}",
				method : 'POST',
				data : data,
				success : function(response) {
						
					$.each(response["specific_person"], function(){
						//GET DATA
				          firstname = this["FIRSTNAME"];
				          middlename = this["MIDDLENAME"];
				          lastname = this["LASTNAME"];
				          civilstatus = this["CIVIL_STATUS"];
				          unit = this["ADDRESS_UNIT_NO"];
				          phase = this["ADDRESS_PHASE"];
				          block = this["ADDRESS_BLOCK_NO"];
				          house = this["ADDRESS_HOUSE_NO"];
				          street = this["ADDRESS_STREET"];
				          subdivision = this["ADDRESS_SUBDIVISION"];
				          building = this["ADDRESS_BUILDING"];
				          sex = this["SEX"];
					});
					if(unit==null){unit = "";} if(phase==null){phase = "";} if(block==null){block = "";} if(house==null){house = "";} if(street==null){street = "";} if(subdivision==null){subdivision = "";}  if(building==null){building = "";} 
					
					//SET DATA
					$("#lbl_applicantD").text(firstname + " " + middlename + " " + lastname);
			        $("#lbl_addressD").text(unit + " " + phase + " " + block  + " " + house  + " " + street + " " + subdivision + " " + building);
			        if(sex == "Female"){
			          $("#lbl_sexD").text("her");
			          $("#lbl_sex2D").text("her");
			        }
			        else if(sex == "Male"){
			          $("#lbl_sexD").text("his");
			          $("#lbl_sex2D").text("his");
			        }
			        else{
			          $("#lbl_sexD").text("his/her");
			          $("#lbl_sex2D").text("his/her");
			        }
			        $("#lbl_or_no_d").text($("input[id='txt_or_number']").val());
					$("#lbl_amount_d").text($("input[id='txt_or_amount']").val());
					$("#lbl_control_no_d").text(response["issuance_number"]);

					
					console.log(response["message"]);

					$("#fmbcert001d").printThis({
								 debug: false,               
								 debug: false,              
						         importCSS: true,           
						         importStyle:true,         
						         loadCSS: "",             
						         pageTitle: "fdas",             
						         removeInline: false,       
						         printDelay: 1000,           
						         header: null,        
						         footer: "",       
						         base: false ,             
						         formValues: true,     
						         canvas: false,           
						         doctypeString: null,      
						         removeScripts: false,  
						         copyTagClasses: false     	        
					     });

				},
				error : function(error){
					console.log("error: " + error);
					Cancelled();
				}
			});	
		}

		//Barangay Certificate Solo Parent
		else if(certificate_type == "Barangay Certificate Solo Parent"){
			let data = {
				'_token' : " {{ csrf_token() }}"
				,'RESIDENT_ID': $("input[id='txt_resid']").val()
				,'ISSUANCE_TYPE' : certificate_type
				,'OR_NUMBER': $("input[id='txt_or_number']").val()
				,'OR_AMOUNT': $("input[id='txt_or_amount']").val()
				,'REMARKS_CONTENT': 'Certificate for Solo Parent'
			};

			var firstname, middlename,lastname, civilstatus, unit, phase, block, house, street, subdivision, building, sss, birthdate, age;

			$.ajax({
				url : "{{ route('PersonalPrintableData') }}",
				method : 'POST',
				data : data,
				success : function(response) {
						
					$.each(response["specific_person"], function(){
						  //GET DATA
			          firstname = this["FIRSTNAME"];
			          middlename = this["MIDDLENAME"];
			          lastname = this["LASTNAME"];
			          civilstatus = this["CIVIL_STATUS"];
			          unit = this["ADDRESS_UNIT_NO"];
			          phase = this["ADDRESS_PHASE"];
			          block = this["ADDRESS_BLOCK_NO"];
			          house = this["ADDRESS_HOUSE_NO"];
			          street = this["ADDRESS_STREET"];
			          subdivision = this["ADDRESS_SUBDIVISION"];
			          building = this["ADDRESS_BUILDING"];
			          sss = this["SSS_NO"];
			          birthdate = this["DATE_OF_BIRTH"];
					});

					if(unit==null){unit = "";} if(phase==null){phase = "";} if(block==null){block = "";} if(house==null){house = "";} if(street==null){street = "";} if(subdivision==null){subdivision = "";}  if(building==null){building = "";} 
					
					//SET DATA
					$("#lbl_applicantE").text(firstname + " " + middlename + " " + lastname);
			        $("#lbl_applicant2E").text(firstname + " " + middlename + " " + lastname);
			        $("#lbl_addressE").text(unit + " " + phase + " " + block  + " " + house  + " " + street + " " + subdivision + " " + building);
			        age = getAge(birthdate);
			        $("#lbl_ageE").text(age);
			        $("#lbl_or_no_e").text($("input[id='txt_or_number']").val());
					$("#lbl_amount_e").text($("input[id='txt_or_amount']").val());
					$("#lbl_child_name1").text($('#lbl_child_name_1').val());
					$("#lbl_child_age1").text($('#lbl_child_age_1').val());
					$("#lbl_child_name2").text($('#lbl_child_name_2').val());
					$("#lbl_child_age2").text($('#lbl_child_age_2').val());
					$("#lbl_requestor_name").text($('#txt_requester_name').val());
					$("#lbl_single_parent_category").text($('#txt_single_parent_category').val());
					$("#lbl_control_no_e").text(response["issuance_number"]);

					var isCheckedYes1 = $('#radiobtn_yes_1:checked').val()?true:false;
					 var isCheckedYes2 = $('#radiobtn_yes_2:checked').val()?true:false;
					 var isCheckedNo1 = $('#radiobtn_no_1:checked').val()?true:false;
					 var isCheckedNo2 = $('#radiobtn_no_2:checked').val()?true:false;

					 if(isCheckedYes1 == true)
					 	$("#lbl_child_pwd1").text("Yes");
					 else if (isCheckedNo1 == true)
					 	$("#lbl_child_pwd1").text("No");
					 else
					 	$("#lbl_child_pwd1").text("");

					  if(isCheckedYes2 == true)
					 	$("#lbl_child_pwd2").text("Yes");
					 else if (isCheckedNo2 == true)
					 	$("#lbl_child_pwd2").text("No");
					 else
					 	$("#lbl_child_pwd2").text("");

					

					
					console.log(response["message"]);

					$("#fmbcert001e").printThis({
								 debug: false,               
								 debug: false,              
						         importCSS: true,           
						         importStyle:true,         
						         loadCSS: "",             
						         pageTitle: "fdas",             
						         removeInline: false,       
						         printDelay: 1000,           
						         header: null,        
						         footer: "",       
						         base: false ,             
						         formValues: true,     
						         canvas: false,           
						         doctypeString: null,      
						         removeScripts: false,  
						         copyTagClasses: false     	        
					     });

				},
				error : function(error){
					console.log("error: " + error);
					Cancelled();
				}
			});	
		}
		//Barangay Certificate Indigency
		else if(certificate_type == "Barangay Certificate Indigency"){
			let data = {
				'_token' : " {{ csrf_token() }}"
				,'RESIDENT_ID': $("input[id='txt_resid']").val()
				,'ISSUANCE_TYPE' : certificate_type
				,'PURPOSE' : $("#txtarea_purpose_indigency").val()
				,'OR_NUMBER': $("input[id='txt_or_number']").val()
				,'OR_AMOUNT': $("input[id='txt_or_amount']").val()
				,'REMARKS_CONTENT' : $("#txtarea_purpose_indigency").val()
			};

			var firstname, middlename,lastname, civilstatus, unit, phase, block, house, street, subdivision, building, sex, birthdate, age;

			$.ajax({
				url : "{{ route('PersonalPrintableData') }}",
				method : 'POST',
				data : data,
				success : function(response) {
						
					$.each(response["specific_person"], function(){
			           //GET DATA
				          firstname = this["FIRSTNAME"];
				          middlename = this["MIDDLENAME"];
				          lastname = this["LASTNAME"];
				          civilstatus = this["CIVIL_STATUS"];
				          unit = this["ADDRESS_UNIT_NO"];
				          phase = this["ADDRESS_PHASE"];
				          block = this["ADDRESS_BLOCK_NO"];
				          house = this["ADDRESS_HOUSE_NO"];
				          street = this["ADDRESS_STREET"];
				          subdivision = this["ADDRESS_SUBDIVISION"];
				          building = this["ADDRESS_BUILDING"];
				          birthdate = this["DATE_OF_BIRTH"];
				          sex = this["SEX"];
					});
					if(unit==null){unit = "";} if(phase==null){phase = "";} if(block==null){block = "";} if(house==null){house = "";} if(street==null){street = "";} if(subdivision==null){subdivision = "";}  if(building==null){building = "";} 
					
					//SET DATA
					$("#lbl_applicantF").text(firstname + " " + middlename + " " + lastname);
			        $("#lbl_civil_statusF").text(civilstatus);
			        $("#lbl_addressF").text(unit + " " + phase + " " + block  + " " + house  + " " + street + " " + subdivision + " " + building);
			        age = getAge(birthdate);
			        $("#lbl_ageF").text(age);
			        $("#lbl_purposeF").text($('#txtarea_purpose_indigency').val());
			        $("#lbl_control_no_f").text(response["issuance_number"]);
			        if(sex == "Female"){
			          $("#lbl_sexF").text("her");
			        }
			        else if(sex == "Male"){
			          $("#lbl_sexF").text("his");
			        }
			        else{
			          $("#lbl_sexF").text("his/her");
	        		}

	        		$("#lbl_or_no_f").text($("input[id='txt_or_number']").val())
					$("#lbl_amount_f").text($("input[id='txt_or_amount']").val())

					
					console.log(response["message"]);

					$("#fmbcert001f").printThis({
								 debug: false,               
								 debug: false,              
						         importCSS: true,           
						         importStyle:true,         
						         loadCSS: "",             
						         pageTitle: "fdas",             
						         removeInline: false,       
						         printDelay: 1000,           
						         header: null,        
						         footer: "",       
						         base: false ,             
						         formValues: true,     
						         canvas: false,           
						         doctypeString: null,      
						         removeScripts: false,  
						         copyTagClasses: false     	        
					     });

				},
				error : function(error){
					console.log("error: " + error);
					Cancelled();
				}
			});	
		}
	});
	//PRINT CERTIFICATE END




	function Cancelled(){
		swal({
			title: 'Cancelled',
			text: "Cancelled Generating Certificate",
			icon:'error',
			buttons: false,
			timer: 1000,
		});
	};

	function getAge(dateString) {
		var today = new Date();
		var birthDate = new Date(dateString);
		var age = today.getFullYear() - birthDate.getFullYear();
		var m = today.getMonth() - birthDate.getMonth();
		if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
			age--;
		}
		return age;
	}

	function hideModal(){

		$("#modal-SelectCertificate").modal('hide');
	}

	</script>
	
	@endsection
