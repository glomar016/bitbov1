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
		<li class="breadcrumb-item"><a href="javascript:;">Barangay Business Permit</a></li>
	</ol>
	<h1 class="page-header">Barangay Business Permit<small>DILG Requirements</small></h1>
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			</div>
			<h4 class="panel-title">Barangay Business Permit</h4>
		</div>
		<div class="alert alert-yellow fade show">
			<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">&times;</span>
			</button>
			The following are the existing records of the businesses within the system.
		</div>
		<div class="panel-body">
			<table id="tbl_business_lst" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th width="10%">Business Number</th>
						<th width="20%">Trade Name</th>
						<th width="20%">Business Name</th>
						<th width="30%">Business Address</th>
						<th width="20%">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($businessBusinessPermit as $row)
					<tr class="gradeC" id="{{$row->BUSINESS_ID}}">
						<td>{{ $row->BUSINESS_OR_NUMBER }}</td>
						<td>{{ $row->TRADE_NAME }}</td>
						<td>{{ $row->BUSINESS_NAME }}</td>
						<td>{{ $row->BUSINESS_ADDRESS }}</td>
						<td>
							<a id="btnPrint" class="btn btn-yellow m-r-5 m-b-5" data-toggle="modal" data-target="#modal-generateBarangayID" style="color: #000">
								<i class="fa fa-edit" style="color:#000"></i>Print Business Permit
							</a>
							
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="fillers" id="fillers" hidden>
		<input type="text" id="txt_business_no"  />	
		@include('certificateandforms.fm_bbp_001_printable')
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
	
	$('#tbl_business_lst').on('click', '#btnPrint', function(){
		document.body.onfocus = onmousemove; 
		let row = $(this).closest("tr")
		$("input[id='txt_business_no']").val(row.attr("id"));

		let data = {
			'_token' : " {{ csrf_token() }}"
			,'busines_permit_applicant_id' : $("input[id='txt_business_no']").val()
		};

		var busines_permit_applicant_id, trade_name, business_address, line_of_business, date_time, payment_or_number, payment_or_date, permit_fee_amount,gross_sales_tax_amount, permit_fee_amount,signboard_tax_amount,community_tax_certificate_amount,payment_or_amount, garbage_charge_amount;

		$.ajax({
			url : "{{ route('BarangayBusinessPermit.Print') }}",
			method : 'POST',
			data : data,
			success : function(response) {

			//get data here
			$.each(response["specific_business"], function(){
				busines_permit_applicant_id = this["BUSINESS_ID"];
				trade_name = this["TRADE_NAME"];
				business_address = this["BUSINESS_ADDRESS"];
				line_of_business = this["LINE_OF_BUSINESS_NAME"];
				payment_or_number = this["OR_NUMBER"];
				payment_or_date = this["OR_DATE"];
				permit_fee_amount = this["PERMIT_FEE_AMOUNT"];
				payment_or_amount = this["AMOUNT"];
				gross_sales_tax_amount = this["GROSS_SALES_TAX_AMOUNT"];
				permit_fee_amount = this["PERMIT_FEE_AMOUNT"];
				signboard_tax_amount = this["SIGNBOARD_RENEWAL_FEE_AMOUNT"];
				community_tax_certificate_amount = this["CTC_AMOUNT"];
				garbage_charge_amount = this["GARBAGE_CHARGE_AMOUNT"];
			});
			
	   		//set value here
	   		$("#lbl_company_name").text(trade_name);
	   		$("#lbl_business_address").text(business_address);
	   		$("#lbl_line_business").text(line_of_business);
	   		$("#lbl_or_number").text(payment_or_number);
	   		$("#lbl_or_date").text(payment_or_date);
	   		$("#lbl_or_amount").text(payment_or_amount);
	   		$("#lbl_barangay_permit").text(permit_fee_amount);
	   		$("#lbl_business_tax").text(gross_sales_tax_amount);
	   		$("#lbl_garbage_fee").text(garbage_charge_amount);
	   		$("#lbl_signboard").text(signboard_tax_amount);
	   		$("#lbl_ctc").text(community_tax_certificate_amount);

	   		//swal
		   	swal({
	            title: "Are you sure?",
	            text: "Generate Barangay Business Permit",
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



	function doneyet() {
		document.body.onmousemove  = ""; 
	  alert("This document is now being printed");
	}
</script>

<script>

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