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
		<li class="breadcrumb-item"><a href="javascript:;">Child</a></li>
	</ol>

	<h1 class="page-header">Child <small>DILG Requirements</small></h1>
	<input type="text" id="txt_CRUD_status" hidden>
	{{-- nav pills --}}
	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active">
				<span class="d-sm-block d-none">Resident</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >
				<span class="d-sm-block d-none">Non-Resident</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-3" data-toggle="tab" class="nav-link" id="btnExport">

				<span class="d-sm-block d-none">Export</span>
			</a>
		</li>
	</ul>

	<div class="tab-content">	
		{{-- NAV PILLS TAB 1 - ADD VISITATION --}}
		<div class="tab-pane fade active show" id="nav-pills-tab-1">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Child</h4>
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
							@foreach($child_resident as $row)
							<tr class="gradeC" id="{{$row->CHILD_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<a id="btnAddChild" class="btn btn-lime m-r-5 m-b-5" data-toggle="modal" data-target="#modal-Child" style="color: #fff">
										<i class="fa fa-info-circle" style="color:#fff"></i>Child Record
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

		{{-- NAV PILLS TAB 2 --}}
		<div class="tab-pane fade" id="nav-pills-tab-2">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Child </h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<div class="col-md-3">
					<br>
					<button type="submit" class="btn btn-lime form-control" id="btnNonResident">
						<i class="fa fa-plus"></i> &nbsp Add Non-Resident Child
					</button>
				</div>
				<div class="panel-body">
					<table id="tbl_child_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($child_nonresident as $row)
							<tr class="gradeC" id="{{$row->CHILD_ID }}">
								<td>{{$row->FIRST_NAME}} {{$row->MIDDLE_NAME}} {{$row->LAST_NAME}} </td>
								<td></td>
								<td>{{$row->BIRTHDATE}}</td>
								<td width="20%">
									<button type="button" class="btn btn-success m-r-5 m-b-5" id="btnUpdateChild">
										<i class="fas fa-lg fa-fw m-r-10 fa-info-circle"></i>Child Record
									</button>
								</td>
							</tr>
							@endforeach	
						</tbody>
					</table>
				</div>
			</div>
		</div>

		{{-- NAV PILLS TAB 3 --}}
		<div class="tab-pane fade " id="nav-pills-tab-3">
			<div class="panel panel-inverse">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Child</h4>
				</div>
				<!-- end panel-heading -->
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">×</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<br>
				<div class="col-md-10">
					<h4>Click <a href="{{route('ChildExport')}}">here</a>  to redownload file</h4>
				</div>
			</div> 
		</div>


		{{-- Child modal --}}
		<div class="modal fade" id="modal-Child" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header"  style="background: #90CA4B" id="modalHeader">
						<h4 class="modal-title" style="color: #fff">Child</h4>
						<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
					</div>
					<div class="modal-body">
						<h3><b><label id="txt_resname" >Resident:</label></b></h3>
						<input type="text" id="txt_resid" hidden>
						<input type="text" id="txt_child_id" hidden>
						<div id="divNonResident">
						<div class="col-md-10">
							<h6>First Name</h6>
							<input class="form-control" type="text" id="txt_nonresident_fname">
						</div>
						<br>
						<div class="col-md-10">
							<h6>Middle Name</h6>
							<input class="form-control" type="text" id="txt_nonresident_mname" >
						</div>
						<br>
						<div class="col-md-10">
							<h6>Last Name</h6>
							<input class="form-control" type="text" id="txt_nonresident_lname" >
						</div>
						<br>
						<div class="col-md-10">
							<h6>Sex</h6>
							<select class="form-control" id="sel_nonresident_sex" style="color: black;" >
								<option selected disabled value=""></option>
								<option>Female</option>
								<option>Male</option>
							</select>
						</div>
						<br>
						<div class="col-md-10">
							<h6>Birthdate</h6>
							<input type="date" class="form-control"  id="txt_nonresident_birthdate" name="txt_nonresident_birthdate" placeholder="dd-mm-yy" />
						</div>
						<br>
					</div>	
						<div class="col-md-10">
							<label>Type of Home Record:</label>
							<select class="form-control" id="sel_home_record" style="color: black;">
								<option selected disabled value=""></option>
								<option value="Mother and Child Book (MCB)">Mother and Child Book (MCB)</option>
								<option value="Immunization Card (ECCD)">Immunization Card (ECCD)</option>
							</select>
						</div>
						<br>
						<div class="col-md-10">
							<h6>Operation Timbang (OPT)</h6>
							<div class="row">
								<div class="col-md-4">
									<label>OPT Date</label>
									<input type="date" class="form-control" style="width: 150px;" id="txt_OPTdate" />
								</div>

								<div class="col-md-4" style="margin-left: 50px" >
									<label>OPT Weight</label>
									<div class="row">
										<input type="text" class="form-control" style="width: 70px;"  id="txt_OPTweight"/>
										<span class="input-group-text">kg</span>
									</div>
								</div>
								<br>
								<div class="col-md-4" style="margin-left: 10px" >
									<label>OPT Height</label>
									<div class="row">
										<input type="text" class="form-control" style="width: 70px; "   id="txt_OPTheight"/>
										<span class="input-group-text">cm</span>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="col-md-10">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="chk_deworming"  unchecked>
								<label for="chk_deworming">Deworming</label>
							</div>
						</div>
						<div class="col-md-10">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="chk_mmr"  unchecked >
								<label for="chk_mmr">MMR</label>
							</div>
						</div>
						<div class="col-md-10">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="chk_vitaminA"  unchecked >
								<label for="chk_vitaminA">Vitamin A (for 12-59 mos.)</label>
							</div>
						</div>
						<div class="col-md-10">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="chk_gp_deworming_april"  unchecked >
								<label for="chk_gp_deworming_april">GP Deworming (April)</label>
							</div> 
						</div>
						<div class="col-md-10">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="chk_gp_deworming_october"  unchecked >
								<label for="chk_gp_deworming_october">GP Deworming (October)</label>
							</div> 
						</div>
						<br>
						<div class="col-md-10">
							<label>Danger Observed</label>
							<div class="col-md-10">
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_do_a"  unchecked>
									<label for="chk_do_a">A = Tigdas</label>
								</div> 
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_do_b"  unchecked >
									<label for="chk_do_b">B = Pulmonya</label>
								</div> 
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_do_c"  unchecked >
									<label for="chk_do_c">C = Pagtatae</label>
								</div> 
							</div>
						</div>
						<br>
						<div class="col-md-10">
							<label>Source Service Received:</label>
							<select class="form-control" id="sel_ssr" style="color: black;">
								<option selected="" disabled="" value=""></option>
								<option value="Health Center">Health Center</option>
								<option value="Barangay Health Station">Barangay Health Station</option>
								<option value="Private Clinic">Private Clinic</option>
							</select>
						</div>

						<legend class="m-t-10"></legend>
						<div align="right">
							<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
							<button id="btnChild" class="btn btn-lime m-r-9" style="background: #90CA4B">Tag</button>
						</div>				
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
		$("table[id='tbl_child_lst']").DataTable();

		$('#txt_nonresident_birthdate').datepicker({
            maxDate:-4015,
            dateFormat: "yy-mm-dd"
        });
	});
	$('#btnNonResident').on('click', function(){
		$('#modal-Child').modal('show');
		$('#txt_resname').hide();
		$('#divNonResident').show();
		$("input[id='txt_CRUD_status']").val('Add_NonResident')
		//modal,button UI change
		$('#modal-Child').modal('show');
		$('#btnChild').css({ 'background' : '#90CA4B'});
		$('#btnChild').attr('class', 'btn btn-lime m-r-9');
		$('#modalHeader').css({ 'background' : '#90CA4B'});
	});

	$('#btnExport').on('click', function(){
		//swal
		   	swal({
	            title: "Are you sure?",
	            text: "Generate Newborn Record",
	            icon: "warning",
	            buttons: [true, "Yes"],
	            dangerMode: true,
	          })
		   	.then((willDelete) => {
	            if (willDelete) {
	              console.log("Printing");
	              window.location.href = "{{route('ChildExport')}}";
	            } else {
	               Cancelled();
	            }
        });
	});

	$('#tbl_resident_lst').on('click', '#btnAddChild', function(){
		let row = $(this).closest("tr"),
		name =  $(row.find("td")[0]).text();

		$("input[id='txt_child_id']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;
		$('#txt_CRUD_status').val('Update_Child');

		//modal & button
		$('#modal-Child').modal('show');
		$('#modalHeader').css({ 'background' : '#90CA4B'});
		$('#btnChild').css({ 'background' : '#90CA4B'});
		$('#btnChild').attr('class', 'btn btn-lime m-r-9');
		$('#btnChild').text('Add');
		$('#txt_resname').show();
		$('#divNonResident').hide();

		//GET DATA OF SPECIFIC CHILD
		let data = {
			'_token' : "{{ csrf_token() }}"
			,'CHILD_ID' : $("input[id='txt_child_id']").val()
		};
		console.log(data);

		var HomeRecord, SSR, HadDeworming, MMR, VitaminA, OPTDate, OPTWeight, OPTHeight, AprilDeworming, OctoberDeworming, A, B, C;

		$.ajax({
			url : "{{ route('SpecificChild') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				$.each(response["specific_child"], function(){
				//GET DATA FROM CONTROLLER-JSON
					HomeRecord = this["TYPE_OF_HOME_RECORD"];
					SSR = this["SOURCE_OF_SERVICE_RESERVED"];
					HadDeworming = this["HAD_DEWORMING"];
					MMR = this["HAD_MMR_12_15_MO"];
					VitaminA = this["HAD_VITAMIN_A_12_59_MO"];
					OPTDate = this["OPT_DATE"];
					OPTWeight = this["OPT_WEIGHT"];
					OPTHeight = this["OPT_HEIGHT"];
					AprilDeworming = this["GP_APRIL_DEWORMING"];
					OctoberDeworming = this["GP_OCTOBER_DEWORMING"];
					A = this["DO_A"];
					B = this["DO_B"];
					C = this["DO_C"];
				});

				console.log(HomeRecord, SSR, HadDeworming, MMR, VitaminA, OPTDate, OPTWeight, OPTHeight, AprilDeworming, OctoberDeworming, A, B, C);
			//SET DATA TO UI
			$('#txt_OPTdate').val(OPTDate);
			$('#txt_OPTweight').val(OPTWeight);
			$('#txt_OPTheight').val(OPTHeight);

			$('#sel_home_record').val(HomeRecord).change();
			$('#sel_ssr').val(SSR).change();

			if(HadDeworming == 1){$('#chk_deworming').prop('checked',true);} else{$('#chk_deworming').prop('checked',false);}
			if(MMR == 1){$('#chk_mmr').prop('checked',true);} else{$('#chk_mmr').prop('checked',false);}
			if(VitaminA == 1){$('#chk_vitaminA').prop('checked',true);} else{$('#chk_vitaminA').prop('checked',false);}
			if(AprilDeworming == 1){$('#chk_gp_deworming_april').prop('checked',true);} else{$('#chk_gp_deworming_april').prop('checked',false);}
			if(OctoberDeworming == 1){$('#chk_gp_deworming_october').prop('checked',true);} else{$('#chk_gp_deworming_october').prop('checked',false);}
			if(A == 1){$('#chk_do_a').prop('checked',true);} else{$('#chk_do_a').prop('checked',false);}
			if(B == 1){$('#chk_do_b').prop('checked',true);} else{$('#chk_do_b').prop('checked',false);}
			if(C == 1){$('#chk_do_c').prop('checked',true);} else{$('#chk_do_c').prop('checked',false);}
				
			},
			error : function(error){
				console.log("error: " + error);
				alert('may mali');
			}
		});
	});

	$('#tbl_child_lst').on('click', '#btnUpdateChild', function(){
		let row = $(this).closest("tr"),
		name =  $(row.find("td")[0]).text();

		$("input[id='txt_child_id']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;
		$('#txt_CRUD_status').val('Update_Child');

		//modal & button
		$('#modalHeader').css({ 'background' : '#008A8A'});
		$('#modal-Child').modal('show');
		$('#btnChild').css({ 'background' : '#008A8A'});
		$('#btnChild').attr('class', 'btn btn-success m-r-9');
		$('#btnChild').text('Update');
		$('#txt_resname').show();
		$('#divNonResident').hide();

		//GET DATA OF SPECIFIC CHILD
		let data = {
			'_token' : "{{ csrf_token() }}"
			,'CHILD_ID' : $("input[id='txt_child_id']").val()
		};

		var HomeRecord, SSR, HadDeworming, MMR, VitaminA, OPTDate, OPTWeight, OPTHeight, AprilDeworming, OctoberDeworming, A, B, C;

		$.ajax({
			url : "{{ route('SpecificChild') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				$.each(response["specific_child"], function(){
				//GET DATA FROM CONTROLLER-JSON
					HomeRecord = this["TYPE_OF_HOME_RECORD"];
					SSR = this["SOURCE_OF_SERVICE_RESERVED"];
					HadDeworming = this["HAD_DEWORMING"];
					MMR = this["HAD_MMR_12_15_MO"];
					VitaminA = this["HAD_VITAMIN_A_12_59_MO"];
					OPTDate = this["OPT_DATE"];
					OPTWeight = this["OPT_WEIGHT"];
					OPTHeight = this["OPT_HEIGHT"];
					AprilDeworming = this["GP_APRIL_DEWORMING"];
					OctoberDeworming = this["GP_OCTOBER_DEWORMING"];
					A = this["DO_A"];
					B = this["DO_B"];
					C = this["DO_C"];
				});

				console.log(HomeRecord, SSR, HadDeworming, MMR, VitaminA, OPTDate, OPTWeight, OPTHeight, AprilDeworming, OctoberDeworming, A, B, C);
			//SET DATA TO UI
			$('#txt_OPTdate').val(OPTDate);
			$('#txt_OPTweight').val(OPTWeight);
			$('#txt_OPTheight').val(OPTHeight);

			$('#sel_home_record').val(HomeRecord).change();
			$('#sel_ssr').val(SSR).change();

			if(HadDeworming == 1){$('#chk_deworming').prop('checked',true);} else{$('#chk_deworming').prop('checked',false);}
			if(MMR == 1){$('#chk_mmr').prop('checked',true);} else{$('#chk_mmr').prop('checked',false);}
			if(VitaminA == 1){$('#chk_vitaminA').prop('checked',true);} else{$('#chk_vitaminA').prop('checked',false);}
			if(AprilDeworming == 1){$('#chk_gp_deworming_april').prop('checked',true);} else{$('#chk_gp_deworming_april').prop('checked',false);}
			if(OctoberDeworming == 1){$('#chk_gp_deworming_october').prop('checked',true);} else{$('#chk_gp_deworming_october').prop('checked',false);}
			if(A == 1){$('#chk_do_a').prop('checked',true);} else{$('#chk_do_a').prop('checked',false);}
			if(B == 1){$('#chk_do_b').prop('checked',true);} else{$('#chk_do_b').prop('checked',false);}
			if(C == 1){$('#chk_do_c').prop('checked',true);} else{$('#chk_do_c').prop('checked',false);}
				
			},
			error : function(error){
				console.log("error: " + error);
				alert('may mali');
			}
		});

	});

	$('#modal-Child').on('click', '#btnChild', function(){

		var HomeRecord, SSR, HadDeworming, MMR, VitaminA, OPTDate, OPTWeight, OPTHeight, AprilDeworming, OctoberDeworming, A, B, C, InfantID, ChildID, CRUDStatus;
		var firstname, middlename, lastname, sex, birthdate;
		//set value
		HomeRecord = $('#sel_home_record option:selected').text();
		SSR = $('#sel_ssr option:selected').text();
		if ($('#chk_deworming').is(":checked")){HadDeworming =1;}else{HadDeworming =0;}
		if ($('#chk_mmr').is(":checked")){MMR =1;}else{MMR =0;}
		if ($('#chk_vitaminA').is(":checked")){VitaminA =1;}else{VitaminA =0;}
		if ($('#chk_gp_deworming_april').is(":checked")){AprilDeworming =1;}else{AprilDeworming =0;}
		if ($('#chk_gp_deworming_october').is(":checked")){OctoberDeworming =1;}else{OctoberDeworming =0;}
		if ($('#chk_do_a').is(":checked")){A =1;}else{A =0;}
		if ($('#chk_do_b').is(":checked")){B =1;}else{B =0;}
		if ($('#chk_do_c').is(":checked")){C =1;}else{C =0;}
		OPTDate = $('#txt_OPTdate').val();
		OPTWeight = $('#txt_OPTweight').val();
		OPTHeight = $('#txt_OPTheight').val();
		InfantID = $('#txt_resid').val();
		ChildID = $('#txt_child_id').val();
		CRUDStatus = $('#txt_CRUD_status').val();
		//non resident
		firstname = $('#txt_nonresident_fname').val();
		middlename = $('#txt_nonresident_mname').val();
		lastname = $('#txt_nonresident_lname').val();
		sex = $('#sel_nonresident_sex option:selected').text();
		birthdate = $('#txt_nonresident_birthdate').val();

		console.log(HomeRecord, SSR, HadDeworming, MMR, VitaminA, OPTDate, OPTWeight, OPTHeight, AprilDeworming, OctoberDeworming, A, B, C, InfantID, CRUDStatus);

		let data = {
				'_token' :  "{{ csrf_token() }}"
				,'TYPE_OF_HOME_RECORD' : HomeRecord
				,'SOURCE_OF_SERVICE_RESERVED' : SSR
				,'HAD_DEWORMING' : HadDeworming
				,'HAD_MMR_12_15_MO' : MMR
				,'HAD_VITAMIN_A_12_59_MO' : VitaminA
				,'OPT_DATE' : OPTDate
				,'OPT_WEIGHT' : OPTWeight
				,'OPT_HEIGHT' : OPTHeight
				,'GP_APRIL_DEWORMING' : AprilDeworming
				,'GP_OCTOBER_DEWORMING' : OctoberDeworming
				,'DO_A' : A
				,'DO_B' : B
				,'DO_C' : C
				,'INFANT_ID' : InfantID
				,'CRUD_STATUS' : CRUDStatus
				,'CHILD_ID' : ChildID
				,'FIRSTNAME' : firstname
				,'MIDDLENAME' : middlename
				,'LASTNAME' : lastname
				,'SEX' : sex
				,'BIRTHDATE' : birthdate

		};

		$.ajax({
			url : "{{ route('CRUDChild') }}",
			method : 'POST',
			data : data,
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
			}
		});	
	});

	// for modal
	function hideModal(){$('#modal-Child').modal('hide');}

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