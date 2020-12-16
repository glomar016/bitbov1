@extends('global.main')

@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Certificates and Forms</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Business</a></li>
	</ol>

	<h1 class="page-header">Business<small>DILG Requirements</small></h1>

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			</div>
			<h4 class="panel-title">Business</h4>
		</div>
		<div class="alert alert-yellow fade show">
			<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">&times;</span>
			</button>
			The following are the existing records of the residents within the system.
		</div>
		<div class="panel-body">
			<table id="tbl_business_lst" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th >Business Number</th>
						<th >Trade Name</th>
						<th >Business Name</th>
						<th >Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($business as $row)
					<tr class="gradeC" id="{{$row->BUSINESS_ID}}">
						<td >{{ $row->BUSINESS_OR_NUMBER }}</td>
						<td>{{ $row->TRADE_NAME }}</td>
						<td>{{ $row->BUSINESS_NAME }}</td>
						<td>
							<a id="btnSelectClearance" class="btn btn-inverse m-r-5 m-b-5" data-toggle="modal" data-target="#modal-SelectClearance" style="color: #fff">
								<i class="fa fa-edit" style="color:#fff">&nbsp&nbsp</i>Select a Clearance to generate
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="fillers" id="fillers" hidden>
		<input type="text" id="txt_business_no" hidden />	
		@include('certificateandforms.fm_bbp_001_printable')
		@include('certificateandforms.fm_bc_001a_printable')
		@include('certificateandforms.fm_bc_001b_printable')
		@include('certificateandforms.fm_bc_001c_printable')
		@include('certificateandforms.fm_bc_001d_printable')
		@include('certificateandforms.fm_bc_001e_printable')
	</div>

	<div class="modal fade" id="modal-SelectClearance" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background: #000" id="modalHeader">
					<h4 class="modal-title" style="color: #fff"> Generate Resident Certificate</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					<h2 id="lbl_business_name" >Business</h2>
					<input type="text" id="txt_business_id" hidden />
					<div class="col-md-10">
						<label>Select Clearance:</label>
						<select class="form-control" id="sel_clearance_type" style="color: black;" >
							<option selected disabled value=""></option>
							<option value="">Barangay Clearance Building</option>
							<option value="">Barangay Clearance Business</option>
							<option value="">Barangay Clearance Zonal</option>

						</select>
					</div>
					{{-- BarangayClearanceZonal --}}
					<div class="col-md-10" id="divZonal">
							<legend class="m-t-10"></legend>
							<h5 id="divFilloutInstruction">Fill out the following information:</h5>

							<label>OCT/TCT Number</label>
							<input type="text" class="form-control" id="txt_tct_no">

							<label>Tax Declaration Number</label>
							<input type="text" class="form-control" id="txt_tax_declaration_no">

							<label>Area</label>
							<input type="text" class="form-control" id="txt_area">

							<label>Location</label>
							<input type="text" class="form-control" id="txt_location">

							<label>Area Classification</label>
							<input type="text" class="form-control" id="txt_area_classification">		
					</div>

					{{-- BarangayClearanceGeneralPurpose --}}
					<div class="col-md-10" id="divGeneral">
						
						<label>Activity</label>
						<input type="text" class="form-control" id="txt_acitivity">

						<label>Company Name</label>
						<input type="text" class="form-control" id="txt_company_name">

						<label>Address</label> 
							<textarea class="form-control" id="txtarea_address"></textarea>
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
<script>
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		$("table[id='tbl_business_lst']").DataTable();

		$('#divZonal').hide();
		$('#divGeneral').hide();
	});
	 $('#tbl_business_lst').on('click', '#btnPrint', function(){
		$('#modal-SelectCertificate').modal('show');
	});


	$('#tbl_business_lst').on('click','#btnSelectClearance' ,function(){
		
		let row = $(this).closest("tr");
		$("input[id='txt_business_id']").val(row.attr("id"));
	
	});

	$('#btnGenerate').on('click', function(){
		var business_id = $('#txt_business_id').val();
		var clearance_type = $('#sel_clearance_type option:selected').text();

		if(clearance_type == "Barangay Clearance Building"){
			//hide
			$('#divZonal').hide();
			let data = {
				'_token' : " {{ csrf_token() }}"
				,'business_main_id' : business_id
			};

			var control_no, or_no, or_date, or_amount, applicant_lastname, applicant_firstname, address, project_name, project_wordings, project_location;

			$.ajax({
				url : "{{ route('BarangayClearanceBuilding.Print') }}",
				method : 'POST',
				data : data,
				success : function(response) {
				//get data here
				$.each(response["specific_business"], function(){
					control_no = this["ISSUANCE_NUMBER"];
					or_no = this["OR_NUMBER"];
					or_date = this["OR_DATE"];
					or_amount = this["AMOUNT"];
					applicant_lastname = this["BUSINESS_OWNER_FIRSTNAME"] + " " + this["BUSINESS_OWNER_LASTNAME"];
					// applicant_firstname = this["applicant_firstname"];
					address = this["BUSINESS_ADDRESS"];
					project_name = this["SCOPE_OF_WORK_NAME"];
					project_wordings = this["SCOPE_OF_WORK_SPECIFY"];
					project_location = this["CONSTRUCTION_ADDRESS"];
				});

		   		//set value here
		   		$("#lbl_control_no_a").text(control_no);
		   		$("#lbl_or_no_a").text(or_no);
		   		$("#lbl_or_date_a").text(or_date);
		   		$("#lbl_amount_a").text(or_amount);
		   		$("#lbl_applicant_a").text(applicant_lastname);
		   		$("#lbl_scope_of_work_name_a").text(project_name);
		   		$("#lbl_wordings_a").text(project_wordings);
		   		$("#lbl_construction_location_a").text(project_location);
		   		$("#lbl_address_a").text(address);
		   		
		   		//swal
			   	swal({
		            title: "Are you sure?",
		            text: "Generate Barangay Clearance Building",
		            icon: "warning",
		            buttons: [true, "Yes"],
		            dangerMode: true,
		          })
			   	.then((willDelete) => {
		            if (willDelete) {
		              console.log("Printing");
		            //print here
			   		$("#fmbc001a").printThis({
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
		            } else {
		               Cancelled();
		            }
	        });	   		
		   	},
		   	error : function(error){
		   		alert('failed');
		   	}
		   });
		}

		else if(clearance_type == "Barangay Clearance Business"){
			//hide
			$('#divZonal').hide();

			let data = {
				'_token' : " {{ csrf_token() }}"
				,'business_main_id' : business_id
			};

			var control_no, or_no, or_date, or_amount, company_name, address, nature_of_business, year;

			$.ajax({
				url : "{{ route('BarangayClearanceBuildingB.Print') }}",
				method : 'POST',
				data : data,
				success : function(response) {
				//get data here
				$.each(response["specific_business"], function(){
					control_no = this["ISSUANCE_NUMBER"];
					or_no = this["OR_NUMBER"];
					or_date = this["OR_DATE"];
					or_amount = this["AMOUNT"];
					company_name = this["TRADE_NAME"];
					address = this["BUSINESS_ADDRESS"];
					nature_of_business = this["LINE_OF_BUSINESS_NAME"];
				});

		   		//set value here
		   		$("#lbl_control_no_b").text(control_no);
		   		$("#lbl_or_no_b").text(or_no);
		   		$("#lbl_or_date_b").text(or_date);
		   		$("#lbl_amount_b").text(or_amount);
		   		$("#lbl_company_name_b").text(company_name);
		   		$("#lbl_address_b").text(address);
		   		$("#lbl_nature_of_business_b").text(nature_of_business);
		   		//swal
			   	swal({
		            title: "Are you sure?",
		            text: "Generate Barangay Clearance Business",
		            icon: "warning",
		            buttons: [true, "Yes"],
		            dangerMode: true,
		          })
			   	.then((willDelete) => {
		            if (willDelete) {
		              console.log("Printing");
		            //print here
				   		$("#fmbc001b").printThis({
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
		            } 
		            else {
		               Cancelled();
		            }
	        	});
			   	},
			   	error : function(error){
			   		alert('failed');
			   	}
	   		});
		}

		else if(clearance_type == "Barangay Clearance Zonal"){
			let data = {
				'_token' : " {{ csrf_token() }}"
				,'business_main_id' : business_id
			};

			var control_no, or_no, or_date, or_amount, oct_tct_no, tax_declaration_no, area, location,applicant_lastname, applicant_firstname, address, scope_work_name, scope_work_specify;
			$.ajax({
				url : "{{ route('BarangayClearanceZonal.Print') }}",
				method : 'POST',
				data : data,
				success : function(response) {
				//get data here
				$.each(response["specific_business"], function(){
					control_no = this["ISSUANCE_NUMBER"];
					or_no = this["OR_NUMBER"];
					or_date = this["OR_DATE"];
					or_amount = this["AMOUNT"];
					applicant_lastname = this["BUSINESS_OWNER_FIRSTNAME"] + " " + this["BUSINESS_OWNER_LASTNAME"];
					oct_tct_no = this["ORIGINAL_TRANSFER_CERTIFICATE_AGENCY"];
					tax_declaration_no = this["TAX_DECLARATION_AGENCY"];
					area = this["BUSINESS_AREA"];
					location = this["CONSTRUCTION_ADDRESS"];
					address = this["BUSINESS_ADDRESS"];
					scope_work_name = this["SCOPE_OF_WORK_NAME"];
					scope_work_specify = this["SCOPE_OF_WORK_SPECIFY"];
				});

		   		//set value here
	   			$("#lbl_control_no_c").text(control_no);
		   		$("#lbl_or_no_c").text(or_no);
		   		$("#lbl_or_date_c").text(or_date);
		   		$("#lbl_amount_c").text(or_amount);
		   		$("#lbl_registered_owner_c").text(applicant_lastname);
		   		$("#lbl_oct_tct_c").text($('#txt_tct_no').val());
		   		$("#lbl_tax_declaration_c").text($('#txt_tax_declaration_no').val());
		   		$("#lbl_area_c").text($('#txt_area').val());
		   		$("#lbl_location_c").text($('#txt_location').val());
		   		$("#lbl_owner_c").text(applicant_lastname);
		   		$("#lbl_address_c").text(address);
		   		$("#lbl_purpose_c").text(scope_work_name + " of " + scope_work_specify);
		   		$('#lbl_area_classification_c').text($('#txt_area_classification').val());
		   			
		   		//swal
			   	swal({
		            title: "Are you sure?",
		            text: "Generate Barangay Clearance Zonal",
		            icon: "warning",
		            buttons: [true, "Yes"],
		            dangerMode: true,
		         })
			   	.then((willDelete) => {
		            if (willDelete) {
		              console.log("Printing");
		            //print here
			   		$("#fmbc001c").printThis({
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
		            } else {
		               Cancelled();
		            }
	        	});
		   	},
		   	error : function(error){
		   		alert('failed');
		   	}
		 });
		}

	});	


	$('#sel_clearance_type').on('change',function(){
		var clearance_type = $('#sel_clearance_type option:selected').text();

		if(clearance_type == "Barangay Clearance Building"){
			//hide
			$('#divZonal').hide();
			$('#divGeneral').hide();
		}

		else if(clearance_type == "Barangay Clearance Business"){
			//hide
			$('#divZonal').hide();
			$('#divGeneral').hide();
		}

		else if(clearance_type == "Barangay Clearance Zonal"){
			
			//show
			$('#divZonal').show();

			//hide
			$('#divGeneral').hide();
		}

	

	});

	function hideModal(){$("#modal-SelectClearance").modal('hide');}
	function Cancelled(){
		swal({
	      	title: 'Cancelled',
			text: "Cancelled Generating Certificate",
			icon:'error',
			buttons: false,
				timer: 1000,
	      });
	};
</script>
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

@endsection
