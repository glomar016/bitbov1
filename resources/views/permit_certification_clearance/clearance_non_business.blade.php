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
		<li class="breadcrumb-item"><a href="javascript:;">Request</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Certification</a></li>
	</ol>

	<h1 class="page-header">Request Clearance<small>DILG Requirements</small></h1>

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			</div>
			<h4 class="panel-title">Resident</h4>
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
						<th hidden>
							<center>Building id</center>
						</th>{{--0--}}
						<th style="width: 12%">
							<center>Building and Lot Number</center>
						</th>{{--1--}}
						<th style="width: 12%">
							<center>Project Type</center>
						</th>{{--1--}}
						<th>
							<center>Building Name</center>
						</th>{{--2--}}
						<th>
							<center>Applicant Name</center>
						</th>{{--3--}}
						<th>
							<center>Project Location</center>
						</th>{{--4--}}
						<th>
							<center>Action</center>
						</th>{{--5--}}
						<th hidden>Cost</th>{{--6--}}
						<th hidden>Enterprise Name</th>{{--7--}}
						<th hidden>Scope</th>{{--8--}}
						<th hidden>Transaction ID</th>{{--8--}}
					</tr>
				</thead>
				<tbody>

					@foreach($buildings as $value)
					<tr>
						<td hidden>{{$value->TRANSACTION_ID}}</td>
						<td style="text-align: center; text-transform: uppercase;">{{$value->BUILDING_ID_NUMBER}}-{{$value->LOT_NUMBER}}</td>
						<td style="text-align: center; text-transform: uppercase;">{{$value->PROJECT_TYPE}}</td>
						<td style="text-align: center; text-transform: uppercase;">{{$value->BUILDING_NAME}}</td>
						<td style="text-align: center; text-transform: uppercase;">{{$value->APPLICANT_NAME}}</td>
						<td style="text-align: center; text-transform: uppercase;">{{$value->PROJECT_LOCATION}}</td>
						<td style="text-align: center; ">
							<a id="btnViewForms" class="btn btn-primary m-r-5 m-b-5" data-toggle="modal" data-target="#modal-SelectCertificate" style="color: #fff">
								<i class="fa fa-file-alt" id="btn_request" style="color:#fff">&nbsp;</i>Request Clearance</a>
						</td>
						<td hidden style="text-align: center; text-transform: uppercase;">{{$value->PROJECT_COST}}</td>
						<td hidden style="text-align: center; text-transform: uppercase;">{{$value->ENTERPRISE_NAME}}</td>
						<td hidden style="text-align: center; text-transform: uppercase;">{{$value->SCOPE_OF_WORK}}</td>
						<td hidden style="text-align: center; text-transform: uppercase;">{{$value->TRANSACTION_ID}}</td>
					</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>

	<input type="text" id="txt_resident_no" hidden />
	<input type="text" id="txt_issuance_type" hidden />

	{{-- SELECT FORMS --}}
	<div class="modal fade" id="modal-SelectCertificate">
		<div class="modal-dialog" style="max-width: 70%">
			<div class="modal-content">
				<div class="modal-header" style="background: #2A72B5" id="modalHeader">
					<h4 class="modal-title" style="color: #fff"> Generate Building Clearance</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">

					<input type="text" id="txt_resid" hidden />
					<div class="col-md-10">
						<h4 id="lbl_resname"></h4>
						<h5 id="lbl_appllicant_name"></h5>
						<h5 id="lbl_proj_location"></h5>
						<h5 id="lbl_enterprise"></h5>
						<label>Select Clearance:</label>
						<select class="form-control" id="sel_certificate_type" style="color: black;">
							<option selected disabled value=""></option>

							<!-- <option value="Barangay Clearance For Individual">Barangay Clearance For Individual</option> -->
							<option value="Barangay Clearance Building (Non-Business)">Barangay Clearance Building (Non-Business)</option>
						</select>
					</div>




					{{-- Clearance Individual --}}

					<div class="col-md-12" id="divMaiden">
						<div class="form-group m-b-10"></div>
						<div class="form-group m-b-10">
							<label>Maiden Name</label>

							<input style="text-transform: capitalize;" type="text" class="form-control" name="txt_maiden_name"></input>
						</div>


					</div>

					{{-- Clearance Building Non Business --}}
					<div class="col-md-10" id="divIndividualNonBusiness">
						<legend class="m-t-10"></legend>
						<h5 id="divFilloutInstruction">Fill out the following information:</h5>

						<div class="row row-space-10">
							<div class="col-md-6">
								{{--<div class="form-group m-b-10 p-t-5">
											<label>Project Type</label> 
											<input style="text-transform: uppercase;" class="form-control" id="txtarea_ptype"/>

										</div>--}}
								{{--<div class="form-group m-b-10 p-t-5">
											<label>Scope of Work</label>
											<select class="form-control" id="sel_scope_of_work_a">
												<option disabled=""></option>
												<option>Construction</option>
												<option>Addition</option>
												<option>Repair</option>
												<option>Renovation</option>
												<option>Demolition</option>
												<option>Installation</option>
												<option>Attachment</option>
												<option>Painting</option>
											</select>

										</div>
										<div class="form-group m-b-10 p-t-5">
											<label>User or Type of Occupancy</label> 
											<input style="text-transform: uppercase;" class="form-control" id="txtarea_poccupancy"/>
										</div>--}}


								<div class="form-group m-b-10 p-t-5">
									<label>Land Tenancy</label>
									<input style="text-transform: uppercase;" class="form-control" id="txt_tenancy">
								</div>


							</div>

							<div class="col-md-6">
								{{--<div class="form-group m-b-10 p-t-5">
											<label>Project Tenure</label> 
											<input style="text-transform: uppercase;" class="form-control" id="txtarea_ptenure"/>
										</div>
										<div class="form-group m-b-10 p-t-5">
											<label>Project Existing Land Use</label> 
											<input style="text-transform: uppercase;" class="form-control" id="txtarea_pland_use"/>
										</div>
										<div class="form-group m-b-10 p-t-5" >
											<label>Project Cost</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text">₱</span>
												</div>
												<input class="form-control" id="txtarea_pcost" type="number" />
											</div>
										</div>
										<div class="form-group m-b-10 p-t-5" style="margin-top: -6px">
											<label>Project Details</label> 
											<textarea style="text-transform: uppercase;" class="form-control" id="txtarea_details"></textarea>
										</div>--}}

							</div>
						</div>

					</div>
					{{-- Indigency --}}
					<div class="col-md-12">

						<br>
						<label>Purpose</label>
						<textarea style="text-transform: uppercase;" class="form-control" id="txtarea_purpose_indigency"></textarea>


					</div>
					<div class="col-md-12" id="divHistory">
						<br>
						<div class="alert alert-danger fade show">
							<button type="button" class="close" data-dismiss="alert">
								<span aria-hidden="true">&times;</span>
							</button>
							<center>THE FOLLOWING SHOWS THE LIST OF PEOPLE WHO HAS THE SAME NAME RECORED IN BARANGAY BLOTTER.</center>
						</div>

						<table id="deregatory-table" class="table table-striped table-bordered ">
							<thead>
								<tr>
									<th hidden>
										<center>Blotter ID</center>
									</th>
									<th>
										<center>Blotter No.</center>
									</th>
									<th>
										<center>Date Filed</center>
									</th>
									<th>
										<center>Complainant Name</center>
									</th>
									<th>
										<center>Respondent</center>
									</th>
									<th>
										<center>Blotter Subject</center>
									</th>
									<th>
										<center>Action</center>
									</th>
								</tr>
							</thead>

							<tbody>

							</tbody>
						</table>


					</div>
					<div class="col-md-12" id="divNoDeregatory">
						<br>
						<div class="alert alert-lime fade show">
							<button type="button" class="close" data-dismiss="alert">
								<span aria-hidden="true">&times;</span>
							</button>
							No Deregatory Record.
						</div>

					</div>


					<div id="divApplicantName">
						<br>
						<legend class="m-t-10"></legend>
						<div class="col-md-12" id="divBusinessPermit">
							<label>Applicant's Name</label>
							<input type="text" id="txt_applicant_name" class="form-control" style="background-color: white;font-weight: bold; color: black; text-transform: uppercase;">
						</div>
					</div>
					<legend class="m-t-10"></legend>
					<div align="right">
						<a onclick="hideModal()" class="btn btn-white m-r-5">Close</a>

						<button class="btn btn-lime m-r-9" style="background: #2A72B5" id="btnRequest">Request</button>
					</div>


					<input type="text" name="count_id" hidden>
				</div>
			</div>
		</div>
	</div>



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

<script>
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		// $("table[id='tbl_resident_lst']").DataTable();	
		$("table[id='tbl_resident_lst']").DataTable({
			"bSort": false
		});
		$("table[id='deregatory-table']").DataTable({
			"bSort": false
		});


		$('#divIndividualNonBusiness').hide();

		$('#divMaiden').hide();
		$('#divHistory').hide();
		$('#divNoDeregatory').hide();
		$('#divIndigency').hide();
	});


	var civil_status, gender, building_id, transaction_id;
	//VIEW CERTIFICATE


	$('#tbl_resident_lst').on('click', '#btnViewForms', function() {

		var table = $("table[id='deregatory-table'] tbody");
		let row = $(this).closest("tr")
		building_id = $(row.find("td")[0]).text(), project_type = $(row.find("td")[1]).text(), applicant_name = $(row.find("td")[4]).text(), proj_location = $(row.find("td")[5]).text(), enterprise = $(row.find("td")[8]).text()
		transaction_id = $(row.find("td")[10]).text()
		var split = applicant_name.split(" ");
		var firstname = split[0] == null ? '' : split[0];
		var middlename = split[1] == null ? '' : split[1];
		var lastname = split[2] == null ? '' : split[2];


		$("input[id='txt_resid']").val(row.attr("id"));
		$('#lbl_resname').text(project_type.toUpperCase());
		$('#lbl_proj_location').text(proj_location.toUpperCase());
		$('#lbl_enterprise').text(enterprise.toUpperCase());


		$('#lbl_appllicant_name').text(applicant_name.toUpperCase());
		$('#txt_applicant_name').val(applicant_name.toUpperCase());

		$.ajax({
			url: "{{route('searchDeregatory')}}",
			method: 'post',
			data: {
				firstname: firstname,
				middlename: middlename,
				lastname: lastname,
				_token: "{{csrf_token()}}"
			},
			success: function(response) {

				if (!$.trim(response['search_data'])) {
					$('#divNoDeregatory').show();
					$('#divHistory').hide();
				} else {
					var i = 0,
						j = 0;
					var actions = [];
					$("table[id='deregatory-table'] tbody tr").remove();

					for (var y = 0; y < response['search_data'].length; y++) {

						var return_first = function() {
							var tmp = null;
							$.ajax({
								async: false,
								type: "POST",
								'global': false,
								url: "{{route('checkDeragatory')}}",
								data: {
									blot_id: response['search_data'][y]['BLOTTER_ID'],
									_token: "{{csrf_token()}}"
								},
								'success': function(data) {
									tmp = data['count'];
								}
							});
							return tmp;
						}();

						if (parseInt(return_first) > 0) {
							actions[j] = '<a class="btn btn-success m-r-5 m-b-5" style="color: #fff; pointer-events:none; cursor:default;" ><i class="fa fa-thumbs-up"  style="color:#fff">&nbsp;</i>Confirmed</a>';
						} else {
							actions[j] = '<a class="btn btn-danger m-r-5 m-b-5 " style="color: #fff" id="btn_confirm"><i class="fa fa-thumbs-up" style="color:#fff">&nbsp;</i>Confirm Deregatory</a>';
						}


						table.append('<tr >' +
							'<td hidden><center>' + response['search_data'][y]['BLOTTER_ID'] + '</center></td>' +
							'<td style="width: 16%;"><center>' + response['search_data'][y]['BLOTTER_CODE'] + '</center></td>' +
							'<td style="width: 12%"><center>' + response['search_data'][y]['INCIDENT_DATE'] + '</center></td>' +
							'<td style="width: 15%"><center>' + response['search_data'][y]['COMPLAINT_NAME'] + '</center></td>' +
							'<td style="width: 15%"><center>' + response['respondents'][i] + '</center></td>' +
							'<td style="width: 12%"><center>' + response['search_data'][y]['BLOTTER_SUBJECT'] + '</center></td>' +
							'<td style="width: 12%">' +
							'<center>' +
							actions[j] +
							'</center></td>' +
							'</tr>');
						i++;
						j++;
					}

					$('#divHistory').show();
					$('#divNoDeregatory').hide();
				}
			},
			error: function(response) {

			}
		});


	});
	$('#deregatory-table').on('click', '#btn_confirm', function() {
		let row = $(this).closest("tr"),
			blot_id = $(row.find("td")[0]).text();


		swal({
				title: "Wait!",
				text: "This person will have deregatory record, continue?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willResolve) => {
				if (willResolve) {
					swal("Data have been successfully added!", {
						icon: "success",
						buttons: false,
						timer: 600
					});

					$.ajax({
						url: "{{route('addDeregatory')}}",
						method: 'post',
						data: {
							blot_id: blot_id,
							building_id: building_id,
							_token: "{{csrf_token()}}"
						},
						success: function(response) {
							console.log(response)

						},
						error: function(response) {
							console.log(response)
						},
					});
				} else {
					swal("Operation Cancelled.", {
						icon: "error",
						buttons: false,
						timer: 600
					});
				}
			})
	});
	//SELECT CERTIFICATE
	$('#sel_certificate_type').on('change', function() {

		var certificate_type = $('#sel_certificate_type option:selected').text();

		if (certificate_type == "Barangay Clearance For Individual") {
			$('#divMaiden').show();

			//show
			$('#divValidUntil').show();
			$('#divIndigency').show();
			$("#divApplicantName").show();
			$('#divIndividualNonBusiness').hide();

		} else if (certificate_type == "Barangay Clearance Building (Non-Business)") {

			//show
			$('#divIndividualNonBusiness').show();
			$("#divApplicantName").show();
			$('#divMaiden').hide();
			$('#divValidUntil').hide();
			$('#divIndigency').show();


		}
	});

	$('#btnRequest').on('click', function() {

		var certificate_type = $('#sel_certificate_type option:selected').text();
		var form_type = "Request Barangay Clearance Form";


		let data = {

			'PURPOSE': $('#txtarea_purpose_indigency').val(),
			'PROJECT_LAND_USE': $('#txt_tenancy').val(),
			'APPLICANT_NAME': $('#txt_applicant_name').val(),
			'BUILDING_ID': building_id,
			'TRANSACTION_ID': transaction_id,
			'PAPER_TYPE_CLEARANCE': certificate_type,
			'_token': " {{ csrf_token() }}"
		};


		$.ajax({
			url: "{{ route('CRUDRequestClearance') }}",
			method: 'POST',
			data: data,
			success: function(response) {
				swal({
					title: 'Success',
					text: 'Request Done!',
					icon: 'success',
					buttons: false,
					timer: 1000,
				});
				window.location.reload();

			},
			error: function(error) {
				console.log("error: " + error);
			}
		});

	});

	function Cancelled() {
		swal({
			title: 'Cancelled',
			text: "Cancelled Generating Certificate",
			icon: 'error',
			buttons: false,
			timer: 1000,
		});
	};

	function hideModal() {

		$("#modal-SelectCertificate").modal('hide');
	}
</script>

@endsection