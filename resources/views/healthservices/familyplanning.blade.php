@extends('global.main')

@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Health Services</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Family Planning</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">FP Users & Non-users</a></li>
	</ol>
	<h1 class="page-header">Family Planning <small>DILG Requirements</small></h1>
	<input type="text" id="txt_CRUD_status" hidden="true">

	{{-- nav pills --}}
	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active">
				<span class="d-sm-block d-none">Residents</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >

				<span class="d-sm-block d-none">FP Users/Non-users</span>
			</a>
		</li>
	</ul>
	<div class="tab-content">
		{{-- NAV PILLS TAB 1 - TAG FP USER --}}
		<div class="tab-pane fade active show" id="nav-pills-tab-1">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Residents</h4>
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
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($residentFP as $row)
							<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>

								<td >
									<a  id="btnAddFPUser" class='btn btn-lime m-r-5 m-b-5' data-toggle='modal' data-target='#modal-FPUser' style="color: #fff">
										<i class='fa fa-tag' style="color: #fff"></i> FP User
									</a>
									<a  id="btnAddNonFPuser" class='btn btn-lime m-r-5 m-b-5' data-toggle='modal' data-target='#modal-NonFPUser' style="color: #fff">
										<i class='fa fa-tag' style="color: #fff"></i> Non FP User
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		{{-- NAV PILLS TAB 2 - TAG NON-FP USER --}}
		<div class="tab-pane fade " id="nav-pills-tab-2">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">FP Users/Non-users</h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the FP users and non-users within the system.
				</div>
				<div class="panel-body">
					<table id="tbl_resident01_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Status</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($FPnNFPuser as $row)
							<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
								@if($row->USER_TYPE == "NON_FP_USER")
									<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
									<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
									<td>{{$row->DATE_OF_BIRTH}}</td>
									<td>
										<a class="btn btn-xs btn-warning m-l-3" style="color: #fff">Non Family Planning User</a>	
									</td>
									<td >
										<a  id="btnTagResidentAsFPuser" class='btn btn-success m-r-5 m-b-5' data-toggle='modal' data-target='#modal-changeToFPUser' style="color: #fff">
										<i class='fa fa-tag' style="color: #fff"></i> FP User</a>
									</td>
								@elseif($row->USER_TYPE == "FP_USER")
									<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
									<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
									<td>{{$row->DATE_OF_BIRTH}}</td>
									<td>
										<a class="btn btn-xs btn-primary m-l-3" style="color: #fff">Family Planning User</a>
									</td>
									<td >
										<a  id="btnTagResidentAsNonFPuser" class='btn btn-success m-r-5 m-b-5' data-toggle='modal' data-target='#modal-changeToNonFPUser' style="color: #fff">
											<i class='fa fa-tag' style="color: #fff"></i> Non-FP User</a>
									</td>
									@endif
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		{{-- tagResidentAsFPuser modal --}}
		<div class="modal fade" id="modal-FPUser" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header"  style="background: #90CA4B" >
						<h4 class="modal-title" style="color: #fff">Tag as FP User</h4>
						<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
					</div>
					<div class="modal-body">
						<h3><b><label id="txt_resname" >Resident:</label></b></h3>
						<input type="text" id="txt_resid" hidden>
						<div class="col-md-10">
							<label>Family Planning Method: </label>
							<select class="form-control" id="sel_familyPlanningMethod" style="color: black;" >
								<option selected disabled value=""></option>
								<option value="Ligation">Ligation</option>
								<option value="Vasectomy">Vasectomy</option>
								<option value="Pills">Pills</option>
								<option value="Intra-Uterine Device">Intra-Uterine Device</option>
								<option value="">Condom</option>
								<option value="Condom">DMPA/Injectable/DEPO</option>
								<option value="CM">Cervical Mucus (CM)</option>
								<option value="BBT">Basal Body Temperature (BBT)</option>
								<option value="STM">Sympotothermal Method (STM)</option>
								<option value="SDM">Standard Day Method (SDM)</option>
								<option value="LAM">Lactational Amenorrhea Method (LAM)</option>
							</select>
						</div>	
						<br>
						<div class="col-md-10">
							<label>Family Planning Source: </label>
							<input type="text" class="form-control"  id="txt_FPSource"/>
						</div>
						<legend class="m-t-10"></legend>
						<div align="right">
							<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
							<button  id="btnFPUser" class="btn btn-success m-r-9" style="background: #90CA4B">Tag</button>
						</div>				
					</div>
				</div>
			</div>
		</div>

		{{-- tagResidentAsNonFPuser modal --}}
		<div class="modal fade" id="modal-NonFPUser" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header"  style="background: #90CA4B" >
						<h4 class="modal-title" style="color: #fff">Tag as Non-FP User</h4>
						<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
					</div>
					<div class="modal-body">
						<h3><b><label id="txt_resname_01" >Resident:</label></b></h3>
						<input type="text" id="txt_resid_01" hidden="true">

						<div class="col-md-10">
							<label>Date of Visit</label>
							<input type="date" class="form-control" style="width: 150px;" id="txt_visitDate" />
						</div>
						<br>
						<div class="col-md-10">
							<label>Reason of Not Using FP</label>
							<textarea type="text" class="form-control" id="txtarea_reason"></textarea>
							{{-- <input type="text" class="form-control" id="txtarea_reason"> --}}
						</div>
						<br>
						<div class="col-md-10">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="chk_interestedInFP" unchecked 	>
								<label for="chk_interestedInFP">Interested in using Family Planning?</label>

							</div>
						</div>
						<legend class="m-t-10"></legend>
						<div align="right">
							<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
							<button  id="btnNonFPUser" class="btn btn-lime m-r-9" style="background: #90CA4B">Tag</button>
						</div>				
					</div>
				</div>
			</div>
		</div>

		{{-- changeResidentTagToUser modal --}}
		<div class="modal fade" id="modal-changeToFPUser" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header"  style="background: #069fa1" >
						<h4 class="modal-title" style="color: #fff">Tag as FP User</h4>
						<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
					</div>
					<div class="modal-body">
						<h3><b><label id="txt_resNameNonuser" >Resident:</label></b></h3>
						<input type="text" id="txt_residNonuser" hidden>
						<div class="col-md-10">
							<label>Family Planning Method: </label>
							<select class="form-control" id="toFPMethod" style="color: black;" >
								<option selected disabled value=""></option>
								<option value="Ligation">Ligation</option>
								<option value="Vasectomy">Vasectomy</option>
								<option value="Pills">Pills</option>
								<option value="Intra-Uterine Device">Intra-Uterine Device</option>
								<option value="">Condom</option>
								<option value="Condom">DMPA/Injectable/DEPO</option>
								<option value="CM">Cervical Mucus (CM)</option>
								<option value="BBT">Basal Body Temperature (BBT)</option>
								<option value="STM">Sympotothermal Method (STM)</option>
								<option value="SDM">Standard Day Method (SDM)</option>
								<option value="LAM">Lactational Amenorrhea Method (LAM)</option>
							</select>
						</div>	
						<br>
						<div class="col-md-10">
							<label>Family Planning Source: </label>
							<input type="text" class="form-control"  id="toFPSource"/>
						</div>
						<legend class="m-t-10"></legend>
						<div align="right">
							<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
							<button  id="btnToUser" class="btn btn-success m-r-9">Tag</button>
						</div>				
					</div>
				</div>
			</div>
		</div>

		{{-- changeResidentTagToNonuser modal --}}
		<div class="modal fade" id="modal-changeToNonFPUser" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header"  style="background: #069fa1" >
						<h4 class="modal-title" style="color: #fff">Tag as Non-FP User</h4>
						<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
					</div>
					<div class="modal-body">
						<h3><b><label id="txt_resNameUser" >Resident:</label></b></h3>
						<input type="text" id="txt_residUser" hidden="true">

						<div class="col-md-10">
							<label>Date of Visit</label>
							<input type="date" class="form-control" style="width: 150px;" id="toNFPvisitDate" />
						</div>
						<br>
						<div class="col-md-10">
							<label>Reason of Not Using FP</label>
							<textarea type="text" class="form-control" id="toNFPreason"></textarea>
							{{-- <input type="text" class="form-control" id="txtarea_reason"> --}}
						</div>
						<br>
						<legend class="m-t-10"></legend>
						<div align="right">
							<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
							<button  id="btnToNonuser" class="btn btn-success m-r-9">Tag</button>
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
			$("table[id='tbl_resident_lst']").DataTable();
			$("table[id='tbl_resident01_lst']").DataTable();
		});

	//Resident Table
	$('#tbl_resident_lst').on('click', '#btnAddFPUser', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$('#txt_CRUD_status').val('Add_FP');
		$("input[id='txt_resid']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;
	});

	$('#tbl_resident_lst').on('click', '#btnAddNonFPuser', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$('#txt_CRUD_status').val('Add_NonFP');
		$("input[id='txt_resid_01']").val(row.attr("id"));
		document.getElementById("txt_resname_01").innerHTML = name;
	});

	//FP Users/Non-users Table
	$('#tbl_resident01_lst').on('click', '#btnTagResidentAsFPuser', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$('#txt_CRUD_status').val('ChangeToUser');
		$("input[id='txt_residNonuser']").val(row.attr("id"));
		document.getElementById("txt_resNameNonuser").innerHTML = name;
	});

	$('#tbl_resident01_lst').on('click', '#btnTagResidentAsNonFPuser', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$('#txt_CRUD_status').val('ChangeToNonuser');
		$("input[id='txt_residUser']").val(row.attr("id"));
		document.getElementById("txt_resNameUser").innerHTML = name;
	});

	//CRUD
	$('#modal-FPUser').on('click', '#btnFPUser', function(){
		var FamilyPlanningMMethod, FPSource, CRUDStatus, Resident_ID;

		FamilyPlanningMMethod = $('#sel_familyPlanningMethod option:selected').text();
		FPSource = $('#txt_FPSource').val();
		CRUDStatus = $('#txt_CRUD_status').val();
		Resident_ID = $('#txt_resid').val();

		console.log(FamilyPlanningMMethod, FPSource, CRUDStatus, Resident_ID);

		let data_fp = {
			'_token' : "{{ csrf_token() }}"
			,'RESIDENT_ID' : Resident_ID
			,'FP_METHOD' : FamilyPlanningMMethod
			,'FP_SOURCE' : FPSource
			,'CRUD_STATUS' : CRUDStatus
		};

		if (CRUDStatus == "Add_FP"){
			// alert(" ADD FP TO!");
			$.ajax({
				url : "{{ route('CRUDFamilyPlanning') }}",
				method : 'POST',
				data : data_fp,
				success : function(response) {
					swal({
						title: 'Success',
						text: 'Saved Record!',
						icon: 'success',
					});
					console.log	(response["message"]);
					window.location.reload();
				},
				error : function(error){
					console.log("error: " + error);
					alert('may mali');
				}
			});	
		}
	});

	$('#modal-NonFPUser').on('click', '#btnNonFPUser', function(){
		var InterestedInFP, ReasonForNotUsing, DateOfVisit, CRUDStatus, Resident_ID;

		if ($('#chk_interestedInFP').is(":checked")){InterestedInFP =1;}else{InterestedInFP =0;}
		ReasonForNotUsing = $('#txtarea_reason').val();
		DateOfVisit = $('#txt_visitDate').val();
		CRUDStatus = $('#txt_CRUD_status').val();
		Resident_ID = $('#txt_resid_01').val();

		console.log(InterestedInFP, ReasonForNotUsing, DateOfVisit, CRUDStatus, Resident_ID);

		let data_nfp = {
			'_token' : "{{ csrf_token() }}"
			,'RESIDENT_ID' : Resident_ID
			,'IS_INTERESTED_IN_FP' : InterestedInFP
			,'REASONS_NOT_USING' : ReasonForNotUsing
			,'DATE_OF_VISIT' : DateOfVisit
			,'CRUD_STATUS' : CRUDStatus
		};
		
		if(CRUDStatus == "Add_NonFP"){
			// alert("ADD NON FP TO!")
			$.ajax({
				url : "{{ route('CRUDFamilyPlanning') }}",
				method : 'POST',
				data : data_nfp,
				success : function(response) {
					swal({
						title: 'Success',
						text: 'Saved Record!',
						icon: 'success',
					});
					console.log	(response["message"]);
					window.location.reload();
				},
				error : function(error){
					console.log("error: " + error);
					alert('may mali');
				}
			});	
		}
	});

	//FROM USER TO NON-USER
	$('#modal-changeToNonFPUser').on('click', '#btnToNonuser', function(){
		var ReasonForNotUsing, DateOfVisit, CRUDStatus, Resident_ID;

		ReasonForNotUsing = $('#toNFPreason').val();
		DateOfVisit = $('#toNFPvisitDate').val();
		CRUDStatus = $('#txt_CRUD_status').val();
		Resident_ID = $('#txt_residUser').val();

		console.log(ReasonForNotUsing, DateOfVisit, CRUDStatus, Resident_ID);

		let data_nfp = {
			'_token' : "{{ csrf_token() }}"
			,'RESIDENT_ID' : Resident_ID
			,'REASONS_NOT_USING' : ReasonForNotUsing
			,'DATE_OF_VISIT' : DateOfVisit
			,'CRUD_STATUS' : CRUDStatus
		};
		
		if(CRUDStatus == "ChangeToNonuser"){
			$.ajax({
				url : "{{ route('CRUDFamilyPlanning') }}",
				method : 'POST',
				data : data_nfp,
				success : function(response) {
					swal({
						title: 'Success',
						text: 'Saved Record!',
						icon: 'success',
					});
					console.log	(response["message"]);
					window.location.reload();
				},
				error : function(error){
					console.log("error: " + error);
					alert('Oops, something went wrong.');
				}
			});	
		}

	});

	//FROM NON-USER TO USER
	$('#modal-changeToFPUser').on('click', '#btnToUser', function(){
		var FamilyPlanningMMethod, FPSource, CRUDStatus, Resident_ID;

		FamilyPlanningMMethod = $('#toFPMethod option:selected').text();
		FPSource = $('#toFPSource').val();
		CRUDStatus = $('#txt_CRUD_status').val();
		Resident_ID = $('#txt_residNonuser').val();

		console.log(FamilyPlanningMMethod, FPSource, CRUDStatus, Resident_ID);

		let data_fp = {
			'_token' : "{{ csrf_token() }}"
			,'RESIDENT_ID' : Resident_ID
			,'FP_METHOD' : FamilyPlanningMMethod
			,'FP_SOURCE' : FPSource
			,'CRUD_STATUS' : CRUDStatus
		};

		if (CRUDStatus == "ChangeToUser"){
			$.ajax({
				url : "{{ route('CRUDFamilyPlanning') }}",
				method : 'POST',
				data : data_fp,
				success : function(response) {
					swal({
						title: 'Success',
						text: 'Saved Record!',
						icon: 'success',
					});
					console.log	(response["message"]);
					window.location.reload();
				},
				error : function(error){
					console.log("error: " + error);
					alert('Oops, something went wrong.');
				}
			});	
		}
	});


	


	// for modal
	function hideModal(){
		$('#modal-FPUser').modal('hide'); 
		$('#modal-NonFPUser').modal('hide');
		$('#modal-changeToFPUser').modal('hide'); 
		$('#modal-changeToNonFPUser').modal('hide');
	}

</script>

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
