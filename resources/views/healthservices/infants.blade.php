@extends('global.main')


@section('content')
<div id="content" class="content">

	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Health Services</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Infant</a></li>
	</ol>
	<h1 class="page-header">Infant <small>DILG Requirements</small></h1>
	<input type="text" id="txt_CRUD_status" hidden="">
	<!-- begin nav-pills -->
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
	<!-- end nav-pills -->
	{{-- TAB CONTENT --}}
	<div class="tab-content">
		{{-- NAV PILLS TAB 1 --}}
		<div class="tab-pane fade active show" id="nav-pills-tab-1">
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Infant</h4>
				</div>
				<!-- end panel-heading -->
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">×</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>

				<!-- begin panel-body -->
				<div class="panel-body">

					<table id="tbl_resident_lst_1" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($infant_resident as $row)
							<tr class="gradeC" id="{{$row->INFANT_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<button type="button" class="btn btn-lime m-r-5 m-b-5" id="btnAddInfant">
										<i class="fas fa-lg fa-fw m-r-10 fa-info-circle"></i>Infant Record
									</button>
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
			</div>        	
		</div>
		{{-- NAV PILLS TAB 2 --}}
		<div class="tab-pane fade " id="nav-pills-tab-2">
			<div class="panel panel-inverse">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Infant </h4>
				</div>
				<!-- end panel-heading -->
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">×</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<div class="col-md-3">
					<br>
					<button type="submit" class="btn btn-lime form-control" id="btnNonResident">
						<i class="fa fa-plus"></i> &nbsp Add Non-Resident Infant
					</button>
				</div>
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="tbl_resident_lst_2" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($infant_nonresident as $row)
							<tr class="gradeC" id="{{$row->INFANT_ID }}">
								<td>{{$row->FIRST_NAME}} {{$row->MIDDLE_NAME}} {{$row->LAST_NAME}} </td>
								<td></td>
								<td>{{$row->BIRTHDATE}}</td>
								<td width="20%">
									<button type="button" class="btn btn-success m-r-5 m-b-5" id="btnUpdateInfant">
										<i class="fas fa-lg fa-fw m-r-10 fa-info-circle"></i>Infant Record
									</button>
								</td>
							</tr>
							@endforeach	
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
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
					<h4 class="panel-title">Infant</h4>
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
					<h4>Click <a href="{{route('InfantExport')}}">here</a>  to redownload file</h4>
				</div>
			</div> 
		</div>

	</div>

	<div class="modal fade" id="modal-Infant" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content" >
				<div class="modal-header" style="background: #90CA4B" id="modalHeader">
					<h4 class="modal-title" style="color: #fff">Infant</h4>
					<button type="button" class="close" onclick="hideModal(this)" aria-hidden="true" style="color: #fff" data-dismiss="alert">×</button>
				</div>
				<div class="modal-body">
					<h3><b><label id="txt_name">Resident:</label></b></h3>
					<input type="text" id="txt_nb_id" hidden> <input type="text" id="txt_i_id" hidden>
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
							<input type="date" class="form-control"  id="txt_nonresident_birthdate" name="txt_nonresident_birthdate" />
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
						<div class="col-md-10">
							<div class="row group"> 
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_breastfeed" unchecked >
									<label for="chk_breastfeed">Had Breastfeed</label>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="col-md-10">
						<h6>Mga Serbisyong Kailangan Matanggap</h6>
						<div class="col-md-10">
							<div class="row group"> 
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_GPabril" unchecked >
									<label for="chk_GPabril">Vitamin A noong GP ng Abril </label>
								</div>
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_GPoktubre" unchecked >
									<label for="chk_GPoktubre">Vitamin A noong GP ng Oktubre</label>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="col-md-10">
						<h6>Garantisadong Pambata (GP)</h6>
						<div class="col-md-10">
							<div class="row group">
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_penta1"unchecked >
									<label for="chk_penta1" style="width: 80px">penta 1 </label>
								</div>
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_penta2" unchecked >
									<label for="chk_penta2" style="width: 80px">penta 2 </label>
								</div>
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_penta3" unchecked >
									<label for="chk_penta3" style="width: 80px">penta 3 </label>
								</div>
							</div>
							<div class="row group">
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_opv1"unchecked >
									<label for="chk_opv1" style="width: 80px">OPV 1</label>
								</div>
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_opv2" unchecked >
									<label for="chk_opv2" style="width: 80px">OPV 2</label>
								</div>
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_opv3" unchecked >
									<label for="chk_opv3" style="width: 80px">OPV 3</label>
								</div>
							</div>
							<div class="row group">
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_rota1"   unchecked >
									<label for="chk_rota1" style="width: 80px">Rota 1</label>
								</div>
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_rota2"   unchecked >
									<label for="chk_rota2" style="width: 80px">Rota 2</label>
								</div>
							</div>
							<div class="row group">
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_antimeasles" unchecked >
									<label for="chk_antimeasles" style="width: 160px">Anti-Measles</label>
								</div>
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="chk_vitaminA" unchecked >
									<label for="chk_vitaminA" style="width: 80px">Vitamin A</label>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="col-md-10" >
						<h6>Danger Observe</h6>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_doA" value="" unchecked >
							<label for="chk_doA">A = Kombulsyon</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_doB"  value="" unchecked >
							<label for="chk_doB">B = Tumigil/mahina sa pagsuso</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_doC"  value="" unchecked >
							<label for="chk_doC">C = Pagtatae</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_doD"  value="" unchecked >
							<label for="chk_doD">D = Pamamanas ng paa o kamay</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_doE" value="" unchecked >
							<label for="chk_doE">E = Antukin o walang malay</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_doF"  value="" unchecked >
							<label for="chk_doF">F = Ubo</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_doG"  value="" unchecked >
							<label for="chk_doG">G = Lagnat</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_doH" value="" unchecked >
							<label for="chk_doH">H = Mabilis o hirap na paghinga</label>
						</div>

					</div><br>
					<div class="col-md-10">
						<label>Source Service Received:</label>
						<select class="form-control" id="sel_ssr" style="color: black;"s>
							<option selected="" disabled="" value=""></option>
							<option value="Health Center">Health Center</option>
							<option value="Barangay Health Station">Barangay Health Station</option>
							<option value="Private Clinic">Private Clinic</option>
						</select>
					</div>
					<legend class="m-t-10"></legend>
					<div align="right">
						<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
						<button  id="btnInfant" class="btn btn-lime m-r-9" style="background: #90CA4B">Add</button>
					</div>
				{{-- </form> --}}
			</div>
		</div>
	</div>
</div>
</div>


@endsection

@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/jquery-timepicker/jquery.timepicker.min.css') }}" rel="stylesheet" />

@endsection

@section('page-js')
{{-- For table --}}
<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>
{{--Modals--}}
<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>
<script src="{{asset('assets/plugins/jquery-timepicker/jquery.timepicker.min.js') }}" ></script>

<script>
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		Notification.init();
		$('#tbl_resident_lst_1').DataTable();
		$('#tbl_resident_lst_2').DataTable();

		$('#txt_nonresident_birthdate').datepicker({
            maxDate:-29,
            minDate:-365,
            dateFormat: "yy-mm-dd"
        });
	});

	$('#btnNonResident').on('click', function(){
		$('#modal-Infant').modal('show');
		$('#txt_resident_name').hide();
		$('#divNonResident').show();
		$("input[id='txt_CRUD_status']").val('Add_NonResident')
		//modal,button UI change
		$('#modal-Infant').modal('show');
		$('#btnInfant').css({ 'background' : '#90CA4B'});
		$('#btnInfant').attr('class', 'btn btn-lime m-r-9');
		$('#modalHeader').css({ 'background' : '#90CA4B'});
	});

	//TABLE ADD
	$('#tbl_resident_lst_1').on('click', '#btnAddInfant', function(){
		let row = $(this).closest("tr")
		name = $(row.find("td")[0]).text();
		//set value
		$("input[id='txt_i_id']").val(row.attr("id"));
		$('#txt_name').text(name);
		$('#txt_CRUD_status').val("Update_Infant");
		//modal & button
		$('#modal-Infant').modal('show');
		$('#modalHeader').css({ 'background' : '#90CA4B'});
		$('#btnInfant').css({ 'background' : '#90CA4B'});
		$('#btnInfant').attr('class', 'btn btn-lime m-r-9');
		$('#btnInfant').text('Add');
		$('#txt_resident_name').show();
		$('#divNonResident').hide();

		//GET DATA OF SPECIFIC INFANT
		let getSpecificData = {
			'_token' : "{{ csrf_token() }}"
			,'INFANT_ID' : $("input[id='txt_i_id']").val()
			,'NONRESIDENT': "FALSE"
		};

		console.log(getSpecificData);

		var InfantID, HomeRecord, OPTDate, OPTWeight, OPTHeight, GPApril, GPOctober, Penta1, Penta2, Penta3, OPV1, OPV2, OPV3, Rota1, Rota2, AntiMeasles, VitaminA, A, B, C, D, E, F, G, H, SSR, HadBreastfeed;
		
		$.ajax({
			url : "{{ route('SpecificInfant') }}",
			method : 'POST',
			data : getSpecificData,
			success : function(response) {
				$.each(response["specific_infant"], function(){
				//GET DATA FROM CONTROLLER-JSON
				InfantID = this["INFANT_ID"];
				HomeRecord = this["TYPE_OF_HOME_RECORD"];
				OPTDate = this["OPT_DATE"];
				OPTWeight = this["OPT_WEIGHT"];
				OPTHeight = this["OPT_HEIGHT"];
				GPApril = this["GP_APRIL_VIT_A"];
				GPOctober = this["GP_OCTOBER_VIT_A"];
				Penta1 = this["HAD_PENTA_1"];
				Penta2 = this["HAD_PENTA_2"];
				Penta3 = this["HAD_PENTA_1"];
				OPV1 = this["HAD_OPV_1"];
				OPV2 = this["HAD_OPV_2"];
				OPV3 = this["HAD_OPV_1"];
				Rota1 = this["HAD_ROTA_1"];
				Rota2 = this["HAD_ROTA_2"];
				AntiMeasles = this["HAD_MEASLES"];
				VitaminA = this["HAD_VITAMIN_A"];
				A = this["DO_A"];
				B = this["DO_B"];
				C = this["DO_C"];
				D = this["DO_D"];
				E = this["DO_E"];
				F = this["DO_F"];
				G = this["DO_G"];
				H = this["DO_H"];
				SSR = this["SOURCE_OF_SERVICE_RECEIVED"];
				HadBreastfeed = this["HAD_BREASTFEED"];
			});
				console.log(HadBreastfeed);
			//SET DATA TO UI
			$('#txt_OPTdate').val(OPTDate);
			$('#txt_OPTweight').val(OPTWeight);
			$('#txt_OPTheight').val(OPTHeight);

			$('#sel_home_record').val(HomeRecord).change();
			$('#sel_ssr').val(SSR).change();


			if(HadBreastfeed == 1){$('#chk_breastfeed').prop('checked',true);} else{$('#chk_breastfeed').prop('checked',false);}
			if(GPApril == 1){$('#chk_GPabril').prop('checked',true);} else{$('#chk_GPabril').prop('checked',false);}
			if(GPOctober == 1){$('#chk_GPoktubre').prop('checked',true);} else{$('#chk_GPoktubre').prop('checked',false);}
			if(Penta1 == 1){$('#chk_penta1').prop('checked',true);} else{$('#chk_penta1').prop('checked',false);}
			if(Penta2 == 1){$('#chk_penta2').prop('checked',true);} else{$('#chk_penta2').prop('checked',false);}
			if(Penta3 == 1){$('#chk_penta3').prop('checked',true);} else{$('#chk_penta3').prop('checked',false);}
			if(OPV1 == 1){$('#chk_opv1').prop('checked',true);} else{$('#chk_opv1').prop('checked',false);}
			if(OPV2 == 1){$('#chk_opv2').prop('checked',true);} else{$('#chk_opv2').prop('checked',false);}
			if(OPV3 == 1){$('#chk_opv3').prop('checked',true);} else{$('#chk_opv3').prop('checked',false);}
			if(Rota1 == 1){$('#chk_rota1').prop('checked',true);} else{$('#chk_rota1').prop('checked',false);}
			if(Rota2 == 1){$('#chk_rota2').prop('checked',true);} else{$('#chk_rota2').prop('checked',false);}
			if(AntiMeasles == 1){$('#chk_antimeasles').prop('checked',true);} else{$('#chk_antimeasles').prop('checked',false);}
			if(VitaminA == 1){$('#chk_vitaminA').prop('checked',true);} else{$('#chk_vitaminA').prop('checked',false);}
			if(A == 1){$('#chk_doA').prop('checked',true);} else{$('#chk_doA').prop('checked',false);}
			if(B == 1){$('#chk_doB').prop('checked',true);} else{$('#chk_doB').prop('checked',false);}
			if(C == 1){$('#chk_doC').prop('checked',true);} else{$('#chk_doC').prop('checked',false);}
			if(D == 1){$('#chk_doD').prop('checked',true);} else{$('#chk_doD').prop('checked',false);}
			if(E == 1){$('#chk_doE').prop('checked',true);} else{$('#chk_doE').prop('checked',false);}
			if(F == 1){$('#chk_doF').prop('checked',true);} else{$('#chk_doF').prop('checked',false);}
			if(G == 1){$('#chk_doG').prop('checked',true);} else{$('#chk_doG').prop('checked',false);}
			if(H == 1){$('#chk_doH').prop('checked',true);} else{$('#chk_doH').prop('checked',false);}


		},
		error : function(error){
			console.log("error: " + error);
			alert('may mali');
		}
	});
	});

	//TABLE UPDATE
	$('#tbl_resident_lst_2').on('click', '#btnUpdateInfant', function(){
		let row = $(this).closest("tr")
		name = $(row.find("td")[0]).text();
		//set value
		$("input[id='txt_i_id']").val(row.attr("id"));
		$('#txt_name').text(name);
		$('#txt_CRUD_status').val("Update_Infant");
		//modal & button
		$('#modal-Infant').modal('show');
		$('#modalHeader').css({ 'background' : '#008A8A'});
		$('#btnInfant').css({ 'background' : '#008A8A'});
		$('#btnInfant').attr('class', 'btn btn-success m-r-9');
		$('#btnInfant').text('Update');
		$('#txt_resident_name').show();
		$('#divNonResident').hide();

		//GET DATA OF SPECIFIC INFANT
		let getSpecificData = {
			'_token' : "{{ csrf_token() }}"
			,'INFANT_ID' : $("input[id='txt_i_id']").val()
			,'NONRESIDENT': "TRUE"
		};

		var InfantID, HomeRecord, OPTDate, OPTWeight, OPTHeight, GPApril, GPOctober, Penta1, Penta2, Penta3, OPV1, OPV2, OPV3, Rota1, Rota2, AntiMeasles, VitaminA, A, B, C, D, E, F, G, H, SSR, HadBreastfeed;
		
		$.ajax({
			url : "{{ route('SpecificInfant') }}",
			method : 'POST',
			data : getSpecificData,
			success : function(response) {
				$.each(response["specific_infant"], function(){
				//GET DATA FROM CONTROLLER-JSON
				InfantID = this["INFANT_ID"];
				HomeRecord = this["TYPE_OF_HOME_RECORD"];
				OPTDate = this["OPT_DATE"];
				OPTWeight = this["OPT_WEIGHT"];
				OPTHeight = this["OPT_HEIGHT"];
				GPApril = this["GP_APRIL_VIT_A"];
				GPOctober = this["GP_OCTOBER_VIT_A"];
				Penta1 = this["HAD_PENTA_1"];
				Penta2 = this["HAD_PENTA_2"];
				Penta3 = this["HAD_PENTA_1"];
				OPV1 = this["HAD_OPV_1"];
				OPV2 = this["HAD_OPV_2"];
				OPV3 = this["HAD_OPV_1"];
				Rota1 = this["HAD_ROTA_1"];
				Rota2 = this["HAD_ROTA_2"];
				AntiMeasles = this["HAD_MEASLES"];
				VitaminA = this["HAD_VITAMIN_A"];
				A = this["DO_A"];
				B = this["DO_B"];
				C = this["DO_C"];
				D = this["DO_D"];
				E = this["DO_E"];
				F = this["DO_F"];
				G = this["DO_G"];
				H = this["DO_H"];
				SSR = this["SOURCE_OF_SERVICE_RECEIVED"];
				HadBreastfeed = this["HAD_BREASTFEED"];
			});
			//SET DATA TO UI
			$('#txt_OPTdate').val(OPTDate);
			$('#txt_OPTweight').val(OPTWeight);
			$('#txt_OPTheight').val(OPTHeight);

			$('#sel_home_record').val(HomeRecord).change();
			$('#sel_ssr').val(SSR).change();

			if(GPApril == 1){$('#chk_GPabril').prop('checked',true);} else{$('#chk_GPabril').prop('checked',false);}
			if(GPOctober == 1){$('#chk_GPoktubre').prop('checked',true);} else{$('#chk_GPoktubre').prop('checked',false);}
			if(Penta1 == 1){$('#chk_penta1').prop('checked',true);} else{$('#chk_penta1').prop('checked',false);}
			if(Penta2 == 1){$('#chk_penta2').prop('checked',true);} else{$('#chk_penta2').prop('checked',false);}
			if(Penta3 == 1){$('#chk_penta3').prop('checked',true);} else{$('#chk_penta3').prop('checked',false);}
			if(OPV1 == 1){$('#chk_opv1').prop('checked',true);} else{$('#chk_opv1').prop('checked',false);}
			if(OPV2 == 1){$('#chk_opv2').prop('checked',true);} else{$('#chk_opv2').prop('checked',false);}
			if(OPV3 == 1){$('#chk_opv3').prop('checked',true);} else{$('#chk_opv3').prop('checked',false);}
			if(Rota1 == 1){$('#chk_rota1').prop('checked',true);} else{$('#chk_rota1').prop('checked',false);}
			if(Rota2 == 1){$('#chk_rota2').prop('checked',true);} else{$('#chk_rota2').prop('checked',false);}
			if(AntiMeasles == 1){$('#chk_antimeasles').prop('checked',true);} else{$('#chk_antimeasles').prop('checked',false);}
			if(VitaminA == 1){$('#chk_vitaminA').prop('checked',true);} else{$('#chk_vitaminA').prop('checked',false);}
			if(A == 1){$('#chk_doA').prop('checked',true);} else{$('#chk_doA').prop('checked',false);}
			if(B == 1){$('#chk_doB').prop('checked',true);} else{$('#chk_doB').prop('checked',false);}
			if(C == 1){$('#chk_doC').prop('checked',true);} else{$('#chk_doC').prop('checked',false);}
			if(D == 1){$('#chk_doD').prop('checked',true);} else{$('#chk_doD').prop('checked',false);}
			if(E == 1){$('#chk_doE').prop('checked',true);} else{$('#chk_doE').prop('checked',false);}
			if(F == 1){$('#chk_doF').prop('checked',true);} else{$('#chk_doF').prop('checked',false);}
			if(G == 1){$('#chk_doG').prop('checked',true);} else{$('#chk_doG').prop('checked',false);}
			if(H == 1){$('#chk_doH').prop('checked',true);} else{$('#chk_doH').prop('checked',false);}


		},
		error : function(error){
			console.log("error: " + error);
			alert('may mali');
		}
	});

	});

	//CRUD
	$('#modal-Infant').on('click', '#btnInfant', function(){

		var NewbornID, InfantID, HomeRecord, OPTDate, OPTWeight, OPTHeight, GPApril, GPOctober, Penta1, Penta2, Penta3, OPV1, OPV2, OPV3, Rota1, Rota2, AntiMeasles, VitaminA, A, B, C, D, E, F, G, H, SSR, CRUDStatus, HadBreastfeed;
		var firstname, middlename, lastname, sex, birthdate;

		NewbornID = $('#txt_nb_id').val();
		InfantID = $('#txt_i_id').val();
		HomeRecord = $('#sel_home_record option:selected').text();
		SSR = $('#sel_ssr option:selected').text();
		OPTDate = $("input[id='txt_OPTdate']").val();
		OPTWeight = $("input[id='txt_OPTweight']").val();
		OPTHeight = $("input[id='txt_OPTheight']").val();

		if ($('#chk_GPabril').is(":checked")){GPApril =1;}else{GPApril =0;}
		if ($('#chk_GPoktubre').is(":checked")){GPOctober =1;}else{GPOctober =0;}
		if ($('#chk_penta1').is(":checked")){Penta1 =1;}else{Penta1 =0;}
		if ($('#chk_penta2').is(":checked")){Penta2 =1;}else{Penta2 =0;}
		if ($('#chk_penta3').is(":checked")){Penta3 =1;}else{Penta3 =0;}
		if ($('#chk_opv1').is(":checked")){OPV1 =1;}else{OPV1 =0;}
		if ($('#chk_opv2').is(":checked")){OPV2 =1;}else{OPV2 =0;}
		if ($('#chk_opv3').is(":checked")){OPV3 =1;}else{OPV3 =0;}
		if ($('#chk_rota1').is(":checked")){Rota1 =1;}else{Rota1 =0;}
		if ($('#chk_rota2').is(":checked")){Rota2 =1;}else{Rota2 =0;}
		if ($('#chk_antimeasles').is(":checked")){AntiMeasles =1;}else{AntiMeasles =0;}
		if ($('#chk_vitaminA').is(":checked")){VitaminA =1;}else{VitaminA =0;}
		if ($('#chk_doA').is(":checked")){A =1;}else{A =0;}
		if ($('#chk_doB').is(":checked")){B =1;}else{B =0;}
		if ($('#chk_doC').is(":checked")){C =1;}else{C =0;}
		if ($('#chk_doD').is(":checked")){D =1;}else{D =0;}
		if ($('#chk_doE').is(":checked")){E =1;}else{E =0;}
		if ($('#chk_doF').is(":checked")){F =1;}else{F =0;}
		if ($('#chk_doG').is(":checked")){G =1;}else{G =0;}
		if ($('#chk_doH').is(":checked")){H =1;}else{H =0;}
		if ($('#chk_breastfeed').is(":checked")){HadBreastfeed =1;}else{HadBreastfeed =0;}
		CRUDStatus = $('#txt_CRUD_status').val();

		// console.log(HadBreastfeed);
		//non resident
		firstname = $('#txt_nonresident_fname').val();
		middlename = $('#txt_nonresident_mname').val();
		lastname = $('#txt_nonresident_lname').val();
		sex = $('#sel_nonresident_sex option:selected').text();
		birthdate = $('#txt_nonresident_birthdate').val();

		// console.log(NewbornID, HomeRecord, OPTDate, OPTWeight, OPTHeight, GPApril, GPOctober, Penta1, Penta2, Penta3, OPV1, OPV2, OPV3, Rota1, Rota2, AntiMeasles, VitaminA, A, B, C, D, E, F, G, H, SSR, CRUDStatus, HadBreastfeed, InfantID);
		
		let data = {
			'_token' : "{{ csrf_token() }}"
			,'INFANT_ID' : InfantID
			,'NEW_BORN_ID' : NewbornID
			,'TYPE_OF_HOME_RECORD' : HomeRecord
			,'OPT_DATE' : OPTDate
			,'OPT_WEIGHT' : OPTWeight
			,'OPT_HEIGHT' : OPTHeight
			,'GP_APRIL_VIT_A' : GPApril
			,'GP_OCTOBER_VIT_A' : GPOctober
			,'SOURCE_OF_SERVICE_RECEIVED' : SSR
			,'HAD_BREASTFEED' : HadBreastfeed
			,'HAD_PENTA_1' : Penta1
			,'HAD_PENTA_2' : Penta2
			,'HAD_PENTA_3' : Penta3
			,'HAD_OPV_1' : OPV1
			,'HAD_OPV_2' : OPV2
			,'HAD_OPV_3' : OPV3
			,'HAD_ROTA_1' : Rota1
			,'HAD_ROTA_2' : Rota2
			,'HAD_MEASLES' : AntiMeasles
			,'HAD_VITAMIN_A' : VitaminA
			,'DO_A' : A
			,'DO_B' : B
			,'DO_C' : C
			,'DO_D' : D
			,'DO_E' : E
			,'DO_F' : F
			,'DO_G' : G
			,'DO_H' : H
			,'CRUD_STATUS' : CRUDStatus
			,'FIRSTNAME' : firstname
			,'MIDDLENAME' : middlename
			,'LASTNAME' : lastname
			,'SEX' : sex
			,'BIRTHDATE' : birthdate
		};

		$.ajax({
			url : "{{ route('CRUDInfant') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				swal({
					title: 'Success',
					text: 'Saved Record!',
					icon: 'success',
				});
				console.log	(response["message"]);
				// window.location.reload();
			},
			error : function(error){
				console.log("error: " + error);
			}
		});	
	});

	function hideModal(){
		$('#modal-Infant').modal('hide');
	}

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
				window.location.href = "{{route('InfantExport')}}";
			} else {
				Cancelled();
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



@endsection

