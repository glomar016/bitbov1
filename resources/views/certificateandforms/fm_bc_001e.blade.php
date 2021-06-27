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
		<li class="breadcrumb-item"><a href="javascript:;">Barangay Clearance General Purpose</a></li>
	</ol>
	<h1 class="page-header">Barangay Clearance General Purpose<small>DILG Requirements</small></h1>
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			</div>
			<h4 class="panel-title">Barangay Clearance General Purpose</h4>
		</div>
		<div class="alert alert-yellow fade show">
			<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">&times;</span>
			</button>
			Fill out the following fields to generate clearance.
		</div>
		<div class="panel-body">
			<div class="panel-body p-t-10">
                        	<div class="row row-space-10">
                        		<div class="col-md-6">
                        			<div class="form-group m-b-10">
                        				<label>Activity</label>
                            			<input class="form-control" type="text" placeholder="" id="txt_activity">
                            		</div>
                            		<br>
                        			<div class="form-group m-b-10">
                            			<label>Company Name</label>
                            			<input class="form-control" type="text" placeholder="" id="txt_company">
                            		</div>
                            		<br>
                        			<div class="form-group m-b-10">
                        				<label>Address</label>
                            			<input class="form-control" type="text" placeholder="" id="txt_addres">
                            		</div>
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
                        	<legend class="m-t-10"></legend>
					<div align="right">
						<button  id="btnPrint" class="btn btn-inverse m-r-9" style="background: #000">Generate</button>
					</div>	
                        </div>
		</div>
	</div>
			<div class="fillers" id="fillers" hidden>
				<input type="text" id="txt_business_main_id" hidden />
				@include('certificateandforms.fm_bc_001e_printable')
				{{-- @include('certificateandforms.fm_bc_001e_printable') --}}
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
		let row = $(this).closest("tr");
		$("input[id='txt_business_main_id']").val(row.attr("id"));

		let data = {
			'_token' : " {{ csrf_token() }}"
		};

		$.ajax({
				url : "{{ route('BarangayClearanceGeneralPurposes.Print') }}",
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
				});

				var control_no = response["issuance_number"];
		   		//set value here
		   		$("#lbl_control_no_e").text(control_no);
		   		$("#lbl_or_no_e").text($('#txt_or_no').val());
		   		$("#lbl_or_date_e").text($('#txt_or_date').val());
		   		$("#lbl_amount_e").text($('#txt_or_amount').val());
		   		$("#lbl_company_name_e").text($('#txt_company').val());
		   		$("#lbl_address_e").text($('#txt_addres').val());
		   		$("#lbl_activity").text($('#txt_activity').val());

		   		//swal
			   	swal({
		            title: "Are you sure?",
		            text: "Generate Barangay Clearance General Purposes",
		            icon: "warning",
		            buttons: [true, "Yes"],
		            dangerMode: true,
		         })
			   	.then((willDelete) => {
		            if (willDelete) {
		              console.log("Printing");
		            //print here
			   		$("#fmbc001e").printThis({
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
{{-- Print --}}
<script src="{{asset('custom/printPage/printPage.js')}}"></script>
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