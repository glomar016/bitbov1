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
		<li class="breadcrumb-item"><a href="javascript:;">Barangay Clearance Tricycle</a></li>
	</ol>
	<h1 class="page-header">Barangay Clearance Tricycle<small>DILG Requirements</small></h1>
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			</div>
			<h4 class="panel-title">Barangay Clearance Tricycle</h4>
		</div>
		<div class="alert alert-yellow fade show">
			<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">&times;</span>
			</button>
			The following are the existing records of the businesses within the system.
		</div>
		<div class="panel-body">
			<div class="row row-space-10">
                        		<div class="col-md-6">
                        			<div class="form-group m-b-10">
                        				<label>Tricycle Operator</label>
                            			<input class="form-control" type="text" placeholder="" id="txt_trike_operator">
                            		</div>
                            		<br>
                            		<div class="form-group m-b-10">
                        				<label>Company Name</label>
                            			<input class="form-control" type="text" placeholder="" id="txt_company_name">
                            		</div>
                            		<br>
                            		<div class="form-group m-b-10">
                        				<label>Address</label>
                            			<input class="form-control" type="text" placeholder="" id="txt_address">
                            		</div>
                            		<br>
                            		<div class="form-group m-b-10">
                        				<label>Driver’s License No</label>
                            			<input class="form-control" type="text" placeholder="" id="txt_drivers_liscence">
                            		</div>
                            		<br>
                            		<div class="form-group m-b-10">
                        				<label>Mudguard/Body No</label>
                            			<input class="form-control" type="text" placeholder="" id="txt_mudguard">
                            		</div>
                            		<br>
                            		<div class="form-group m-b-10">
                        				<label>CR No</label>
                            			<input class="form-control" type="text" placeholder="" id="txt_cr_no">
                            		</div>
                            		<br>
                            		<div class="form-group m-b-10">
                        				<label>OR No</label>
                            			<input class="form-control" type="text" placeholder="" id="txt_or_no_driver">
                            		</div>
                            		<br>
                        			
                        		</div>
                        		<div class="col-md-6">
                        			<div class="form-group m-b-10">
                        				<label>OR No</label>
                            			<input class="form-control" type="text" placeholder="" id="txt_or_no">
                            		</div>
                            		<br>
                        			<div class="form-group m-b-10">
                        				<label>OR Amount</label>
                            			<input class="form-control" type="text" placeholder="" id="txt_or_amount">
                            		</div>
                            		<br>
                        			<div class="form-group m-b-10">
                        				<label>OR Date</label>
                            			<input class="form-control" type="date" placeholder="" id="txt_or_date">
                            		</div>
                        		</div>

                        	</div>
                        	<div align="right">
						<button  id="btnPrint" class="btn btn-inverse m-r-9" style="background: #000">Generate</button>
					</div>	
			<div class="fillers" id="fillers" hidden>
				<input type="text" id="txt_business_main_id" hidden />
				@include('certificateandforms.fm_bc_001d_printable')
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
	});

	$('#btnPrint').on('click', function(){
		let data = {
			'_token' : " {{ csrf_token() }}"
		};

		var control_no, or_no, or_date, or_amount, tricycle_operator, company_name, address, driver_licsence, mudguard, cr_no;

		$.ajax({
			url : "{{ route('BarangayClearanceTricycle.Print') }}",
			method : 'POST',
			data : data,
			success : function(response) {
			//get data here
			$.each(response["specific_business"], function(){
				control_no = this["ISSUANCE_NUMBER"];
				or_no = this["OR_NUMBER"];
				or_date = this["OR_DATE"];
				or_amount = this["AMOUNT"];
				company_name = this["BUSINESS_OWNER"];
				address = this["BUSINESS_ADDRESS"];
				cr_no = this["OR_OF_TRICYCLE_AGENCY"];
			});

			var control_no = response["issuance_number"];
	   		//set value here
	   		$("#lbl_control_no").text(control_no);
	   		$("#lbl_or_no").text($('#txt_or_no').val());
	   		$("#lbl_or_date").text($('#txt_or_date').val());
	   		$("#lbl_amount").text($('#txt_or_amount').val());
	   		$("#lbl_company_name").text($('#txt_company_name').val());
	   		$("#lbl_address").text($('#txt_address').val());
	   		$("#lbl_cr_no").text($('#txt_cr_no').val());
	   		$('#lbl_drivers_license').text($('#txt_drivers_liscence').val());
	   		$("#lbl_or_no_driver").text($('#txt_or_no_driver').val());
	   		$("#lbl_mudguard_no").text($('#txt_mudguard').val())
	   		$("#lbl_tricycle_operator").text($('#txt_trike_operator').val())


	   		///swal
		   	swal({
	            title: "Are you sure?",
	            text: "Generate Barangay Clearance Tricycle",
	            icon: "warning",
	            buttons: [true, "Yes"],
	            dangerMode: true,
	         })
		   	.then((willDelete) => {
	            if (willDelete) {
	              console.log("Printing");
	            //print here
		   		$("#print_form").printThis({
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

	});
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
{{-- Print --}}
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