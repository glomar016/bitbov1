

@extends('global.main')

@section('page-css')
{{-- For table --}}
{{--<script src="{{asset('assets/plugins/datatables/css/dataTables.bootstrap4.css')}}"></script>
<script src="{{asset('assets/plugins/datatables/css/responsive/responsive.bootstrap4.css')}}"></script>--}}
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection

@section('content')
<div id="content" class="content">

	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Health Services</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">New Born</a></li>
	</ol>
	<h1 class="page-header">New Born <small>DILG Requirements</small></h1>
	<input type="text" id="txt_CRUD_status" hidden>
	<!-- begin nav-pills -->
	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link" >

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
					<h4 class="panel-title">Newborn</h4>
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
							@foreach($newborn as $row)
							<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<button type="button" class="btn btn-lime m-r-5 m-b-5" id="btnAddNewborn">
										<i class="fas fa-lg fa-fw m-r-10 fa-info-circle"></i>New born Record
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
					<h4 class="panel-title">New Born </h4>
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
					<button type="submit" class="btn btn-lime form-control"  id="btnNonResident">
                        <i class="fa fa-plus"></i> &nbsp Add Non-Resident Newborn
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
							@foreach($nonresident as $row)
							<tr class="gradeC" id="{{$row->NONRESIDENT_ID}}">
								<td>{{$row->FIRST_NAME}} {{$row->MIDDLE_NAME}} {{$row->LAST_NAME}} </td>
								<td></td>
								<td>{{$row->BIRTHDATE}}</td>
								<td width="20%">
									<button type="button" class="btn btn-success m-r-5 m-b-5" id="btnUpdateNewborn">
										<i class="fas fa-lg fa-fw m-r-10 fa-info-circle"></i>New Born Record
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
					<h4 class="panel-title">New Born</h4>
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
					<h4>Click <a href="{{route('ExportNewborn')}}">here</a>  to redownload file</h4>
				</div>
			</div> 
		</div>

	</div>
	{{-- TAB CONTENT --}}

	{{-- newBornRecord modal --}}
	<div class="modal fade" id="modal-newBornRecord" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content" style="max-width: 100%">
				<div class="modal-header" style="background: #90CA4B" id="modalHeader">
					<h4 class="modal-title" style="color: #fff">New Born Record</h4>
					<button type="button" class="close" onclick="hideModal(this)" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					<div class="col-md-10">
						<h3><b><label id="txt_resident_name"></label></b></h3>
						<input type="text" id="txt_nb_id" hidden>
						<input type="text" id="txt_resident_id" hidden/>
					</div>
					<div id="divNonResident" >
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
							<input type="date" class="form-control"  id="txt_nonresident_birthdate" />
						</div>
						<br>
					</div>
					
					
					
					<div class="col-md-10">
						<label>Type of Home Record:</label>
						<select class="form-control" id="sel_home_record" style="color: black;" >
							<option selected disabled value=""></option>
							<option value="Mother and Child Book (MCB)">Mother and Child Book (MCB)</option>
							<option value="Immunization Card (ECCD)">Immunization Card (ECCD)</option>
						</select>
					</div>
					<br>
					<div class="row" style="margin-left: 17px ">
						<div class="row row-space-6">
							<div class="col-md-8">
								<h6>Birth Weight</h6>
							</div>
							<input class="form-control" type="text" id="txt_birth_weight" data-parsley-type="Digits" placeholder="Digits" style="width: 100px"> <span class="input-group-text">kg</span>
						</div>
						<div class="row row-space-10" style="margin-left: 10px">
							<div class="col-md-8">
								<h6>Birth Height</h6>
							</div>
							<input class="form-control" type="text" id="txt_birth_height" data-parsley-type="Digits" placeholder="Digits" style="width: 100px">  <span class="input-group-text">cm</span>
						</div>
					</div>

					<div class="col-md-10" style="margin-left: 17px; ">
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_had_bgc" unchecked>
							<label for="chk_had_bgc">Had BCG?</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_hepa_b" name= "chk_hepa_b" value="" unchecked>
							<label for="chk_hepa_b">Had Hepa B?</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_had_new_born_services" unchecked >
							<label for="chk_had_new_born_services">Had New Born Service?</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_breastfeed" unchecked >
							<label for="chk_breastfeed">Had Breastfeed?</label>
						</div>
					</div>
					<br>
					<div class="col-md-10" style="margin-left: 17px; ">
						<h6>Danger Observe</h6>
						{{-- <textarea class="form-control" rows="3" id="txt_danger_observe" name="txt_danger_observe"></textarea> --}}
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_do_a"  unchecked >
							<label for="chk_do_a">A = Kombulsyon</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_do_b" unchecked >
							<label for="chk_do_b">B = Tumigil/mahina sa pagsuso</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_do_c"  unchecked >
							<label for="chk_do_c">C = Wala o bahagya ang paggalaw</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_do_d" unchecked>
							<label for="chk_do_d">D = Mahabang tagas o dugo sa pusod</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_do_e"unchecked >
							<label for="chk_do_e">E = Madilaw na talampakan, mata o balat</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_do_f"  unchecked>
							<label for="chk_do_f">F = Mabilis o hirap na paghinga</label>
						</div>
					</div>
					<br>
					<div class="col-md-10">
						<label>Source Service Received:</label>
						<select class="form-control" id="sel_ssr" style="color: black;"s>
							<option selected="" disabled="" value=""></option>
							<option value="Health Center">Health Center</option>
							<option value="Barangay Health Station">Barangay Health Station</option>
							<option value="Private Clinic">Private Clinic</option>
						</select>
						<input type="text" id="txt_sel_ssr" hidden>
					</div>
					<div class="col-md-12" style="margin-bottom: 10px">
						<legend class="m-t-10"></legend>
						<div align="right"  id="divAdd">
							<a onclick="hideModal()" class="btn btn-white m-r-9">Cancel</a>
							<button type="submit" id="btnAddNewbornRecord" class="btn btn-lime m-r-9" style="background: #90CA4B">Add</button>
						</div>
					</div>
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
		$('#tbl_resident_lst_1').DataTable();
		$('#tbl_resident_lst_2').DataTable();

		$('#txt_nonresident_birthdate').datepicker({
            maxDate:0,
            minDate:-28,
            dateFormat: "yy-mm-dd"
        });
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
				window.location.href = "{{route('ExportNewborn')}}";
			} else {
				Cancelled();
			}
		});
	});

	$('#btnNonResident').on('click', function(){
		$('#modal-newBornRecord').modal('show');
		$('#txt_resident_name').hide();
		$('#divNonResident').show();
		$("input[id='txt_CRUD_status']").val('Add_NonResident')
		//modal,button UI change
		$('#modal-newBornRecord').modal('show');
		$('#btnAddNewbornRecord').css({ 'background' : '#90CA4B'});
		$('#btnAddNewbornRecord').attr('class', 'btn btn-lime m-r-9');
		$('#btnAddNewbornRecord').text('Add');
		$('#modalHeader').css({ 'background' : '#90CA4B'});
	});

	$('#tbl_resident_lst_1').on('click', '#btnAddNewborn', function(){
		$('#txt_resident_name').show();
		$('#divNonResident').hide();
		let row = $(this).closest("tr")
		name = $(row.find("td")[0]).text();
		//set value
		$("input[id='txt_resident_id']").val(row.attr("id"));
		$('#txt_resident_name').text(name);
		//modal,button UI change
		$('#modal-newBornRecord').modal('show');
		$('#btnAddNewbornRecord').css({ 'background' : '#90CA4B'});
		$('#btnAddNewbornRecord').attr('class', 'btn btn-lime m-r-9');
		$('#btnAddNewbornRecord').text('Add');
		$('#modalHeader').css({ 'background' : '#90CA4B'});
		//CRUD STATUS
		$("input[id='txt_CRUD_status']").val('Add')

		//GET DATA OF SPECIFIC NEWBORN
		let getSpecificData = {
			'_token' : "{{ csrf_token() }}"
			,'RESIDENT_ID' : $("input[id='txt_resident_id']").val()
			,'NONRESIDENT': "FALSE"
		};
		console.log(getSpecificData);
		
		//declare variables
		var HomeRecord, BirthWeight, BirthLength, HadBGC, HadHepaB, HadScreening, HadBreastfeed, A, B, C, D, E, F, SSR, NewbornID;
		$.ajax({
			url : "{{ route('SpecificNewborn') }}",
			method : 'POST',
			data : getSpecificData,
			success : function(response) {
				console.log	(response["message"]);
				$.each(response["specific_resident"], function(){
					HomeRecord = this["TYPE_OF_HOME_RECORD"];
					BirthWeight = this["BIRTH_WEIGHT"];
					BirthLength = this["BIRTH_LENGTH"];
					HadBGC = this["HAD_BCG"];
					HadHepaB = this["HAD_HEPA_B"];
					HadScreening = this["HAD_NEWBORN_SCREENING"];
					HadBreastfeed = this["HAD_BREASTFEED"];
					A = this["DO_A"];
					B = this["DO_B"];
					C = this["DO_C"];
					D = this["DO_D"];
					E = this["DO_E"];
					F = this["DO_F"];
					SSR = this["SOURCE_OF_SERVICE_RESERVED"];
					NewbornID = this["NEWBORN_ID"];
				});

			//SET DATA TO UI
				//input
				$('#txt_nb_id').val(NewbornID);
				$('#txt_birth_weight').val(BirthWeight);
				$('#txt_birth_height').val(BirthLength);
				//select
				$('#sel_home_record').val(HomeRecord).change();
				$('#sel_ssr').val(SSR).change();
				//checkbox
				if(HadBGC == 1){$('#chk_had_bgc').prop('checked',true);} else{$('#chk_had_bgc').prop('checked',false);}
				if(HadHepaB == 1){$('#chk_hepa_b').prop('checked',true);} else{$('#chk_hepa_b').prop('checked',false);}
				if(HadScreening == 1){$('#chk_had_new_born_services').prop('checked',true);} else{$('#chk_had_new_born_services').prop('checked',false);}
				if(HadBreastfeed == 1){$('#chk_breastfeed').prop('checked',true);} else{$('#chk_breastfeed').prop('checked',false);}
				if(A == 1){$('#chk_do_a').prop('checked',true);} else{$('#chk_do_a').prop('checked',false);}
				if(B == 1){$('#chk_do_b').prop('checked',true);} else{$('#chk_do_b').prop('checked',false);}
				if(C == 1){$('#chk_do_c').prop('checked',true);} else{$('#chk_do_c').prop('checked',false);}
				if(D == 1){$('#chk_do_d').prop('checked',true);} else{$('#chk_do_d').prop('checked',false);}
				if(E == 1){$('#chk_do_e').prop('checked',true);} else{$('#chk_do_e').prop('checked',false);}
				if(F == 1){$('#chk_do_f').prop('checked',true);} else{$('#chk_do_f').prop('checked',false);}
			},
			error : function(error){
				console.log("error: " + error);
				alert('may mali');
			}
		});
	});
	//ilalagay yung value sa modal
	$('#tbl_resident_lst_2').on('click', '#btnUpdateNewborn', function(){
		$('#txt_resident_name').show();
		$('#divNonResident').hide();
		let row = $(this).closest("tr")
		name = $(row.find("td")[0]).text();

		//set value
		$("input[id='txt_resident_id']").val(row.attr("id"));
		$('#txt_resident_name').text(name);
		//modal,button UI change
		$('#modal-newBornRecord').modal('show');
		$('#btnAddNewbornRecord').css({ 'background' : '#008A8A'});
		$('#btnAddNewbornRecord').attr('class', 'btn btn-success m-r-9');
		$('#btnAddNewbornRecord').text('Update');
		$('#modalHeader').css({ 'background' : '#008A8A'});
		
		//CRUD STATUS
		$("input[id='txt_CRUD_status']").val('Update')

		//GET DATA OF SPECIFIC NEWBORN
		let getSpecificData = {
			'_token' : "{{ csrf_token() }}"
			,'RESIDENT_ID' : $("input[id='txt_resident_id']").val()
			,'NONRESIDENT': "TRUE"
		};
		console.log(getSpecificData);
		
		//declare variables
		var HomeRecord, BirthWeight, BirthLength, HadBGC, HadHepaB, HadScreening, HadBreastfeed, A, B, C, D, E, F, SSR, NewbornID;
		$.ajax({
			url : "{{ route('SpecificNewborn') }}",
			method : 'POST',
			data : getSpecificData,
			success : function(response) {

				$.each(response["specific_resident"], function(){
					HomeRecord = this["TYPE_OF_HOME_RECORD"];
					BirthWeight = this["BIRTH_WEIGHT"];
					BirthLength = this["BIRTH_LENGTH"];
					HadBGC = this["HAD_BCG"];
					HadHepaB = this["HAD_HEPA_B"];
					HadScreening = this["HAD_NEWBORN_SCREENING"];
					HadBreastfeed = this["HAD_BREASTFEED"];
					A = this["DO_A"];
					B = this["DO_B"];
					C = this["DO_C"];
					D = this["DO_D"];
					E = this["DO_E"];
					F = this["DO_F"];
					SSR = this["SOURCE_OF_SERVICE_RESERVED"];
					NewbornID = this["NEWBORN_ID"];
				});
				// console.log	(example);

			//SET DATA TO UI
				//input
				$('#txt_nb_id').val(NewbornID);
				$('#txt_birth_weight').val(BirthWeight);
				$('#txt_birth_height').val(BirthLength);
				//select
				$('#sel_home_record').val(HomeRecord).change();
				$('#sel_ssr').val(SSR).change();
				//checkbox
				if(HadBGC == 1){$('#chk_had_bgc').prop('checked',true);} else{$('#chk_had_bgc').prop('checked',false);}
				if(HadHepaB == 1){$('#chk_hepa_b').prop('checked',true);} else{$('#chk_hepa_b').prop('checked',false);}
				if(HadScreening == 1){$('#chk_had_new_born_services').prop('checked',true);} else{$('#chk_had_new_born_services').prop('checked',false);}
				if(HadBreastfeed == 1){$('#chk_breastfeed').prop('checked',true);} else{$('#chk_breastfeed').prop('checked',false);}
				if(A == 1){$('#chk_do_a').prop('checked',true);} else{$('#chk_do_a').prop('checked',false);}
				if(B == 1){$('#chk_do_b').prop('checked',true);} else{$('#chk_do_b').prop('checked',false);}
				if(C == 1){$('#chk_do_c').prop('checked',true);} else{$('#chk_do_c').prop('checked',false);}
				if(D == 1){$('#chk_do_d').prop('checked',true);} else{$('#chk_do_d').prop('checked',false);}
				if(E == 1){$('#chk_do_e').prop('checked',true);} else{$('#chk_do_e').prop('checked',false);}
				if(F == 1){$('#chk_do_f').prop('checked',true);} else{$('#chk_do_f').prop('checked',false);}
			},
			error : function(error){
				console.log("error: " + error);
			}
		});
	});


	$('#modal-newBornRecord').on('click', '#btnAddNewbornRecord', function(){
		//set value
		var HadBGC, HadHepaB, HadScreening, HadBreastfeed, A,B,C,D,E,F ,HomeRecord, SSR, BirthWeight, BirthHeight, NewbornID;
		var firstname, middlename, lastname, sex, birthdate;


		if ($('#chk_had_bgc').is(":checked")){HadBGC =1;}else{HadBGC =0;}
		if ($('#chk_hepa_b').is(":checked")){HadHepaB =1;}else{HadHepaB =0;}
		if ($('#chk_had_new_born_services').is(":checked")){HadScreening =1;}else{HadScreening =0;}
		if ($('#chk_breastfeed').is(":checked")){HadBreastfeed =1;}else{HadBreastfeed =0;}
		if ($('#chk_do_a').is(":checked")){A =1;}else{A =0;}
		if ($('#chk_do_b').is(":checked")){B =1;}else{B =0;}
		if ($('#chk_do_c').is(":checked")){C =1;}else{C =0;}
		if ($('#chk_do_d').is(":checked")){D =1;}else{D =0;}
		if ($('#chk_do_e').is(":checked")){E =1;}else{E =0;}
		if ($('#chk_do_f').is(":checked")){F =1;}else{F =0;}
		HomeRecord = $('#sel_home_record option:selected').text();
		SSR = $('#sel_ssr option:selected').text();


		//non resident
		firstname = $('#txt_nonresident_fname').val();
		middlename = $('#txt_nonresident_mname').val();
		lastname = $('#txt_nonresident_lname').val();
		sex = $('#sel_nonresident_sex option:selected').text();
		birthdate = $('#txt_nonresident_birthdate').val();
		//end

		console.log(firstname, middlename, lastname, sex, birthdate);
		console.log(HadBGC, HadHepaB, HadScreening, HadBreastfeed, A,B,C,D,E,F, HomeRecord, SSR, $("input[id='txt_birth_weight']").val(), $("input[id='txt_birth_height']").val());
		// $("meta[name='csrf-token']").attr("content")
		//AJAX CODE STARTS HERE
		let data = {
			'_token' : "{{ csrf_token() }}"
			,'RESIDENT_ID' : $("input[id='txt_resident_id']").val()
			,'TYPE_OF_HOME_RECORD' : HomeRecord
			,'BIRTH_WEIGHT' : $("input[id='txt_birth_weight']").val()
			,'BIRTH_LENGTH' : $("input[id='txt_birth_height']").val()
			,'HAD_BCG' : HadBGC
			,'HAD_HEPA_B' : HadHepaB
			,'HAD_NEWBORN_SCREENING' : HadScreening
			,'HAD_BREASTFEED' : HadBreastfeed
			,'DO_A' : A
			,'DO_B' : B
			,'DO_C' : C
			,'DO_D' : D
			,'DO_E' : E
			,'DO_F' : F
			,'SOURCE_OF_SERVICE_RESERVED' : SSR
			,'NEWBORN_ID' : $('#txt_nb_id').val()
			,'CRUD_STATUS': $("input[id='txt_CRUD_status']").val()
			,'FIRSTNAME' : firstname
			,'MIDDLENAME' : middlename
			,'LASTNAME' : lastname
			,'SEX' : sex
			,'BIRTHDATE' : birthdate
		};

		$.ajax({
			url : "{{ route('CRUDNewborn') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				swal({
					title: 'Success',
					text: 'Saved Record!',
					icon: 'success',
				});
				window.location.reload();
			},
			error : function(error){
				//console.log("error: " + error);
				alert('may mali');
				console.log(data);
			}
		});
		
	});

	function hideModal(){
		$('#modal-newBornRecord').modal('hide');
		$('#chk_do_a').prop('checked',false);
		$('#chk_do_b').prop('checked',false);
		$('#chk_do_c').prop('checked',false);
		$('#chk_do_d').prop('checked',false);
		$('#chk_do_e').prop('checked',false);
		$('#chk_do_d').prop('checked',false);
		$('#chk_do_f').prop('checked',false);
		$('#chk_had_bgc').prop('checked',false);
		$('#chk_had_new_born_services').prop('checked',false);
		$('#chk_breastfeed').prop('checked',false);
		$('#chk_hepa_b').prop('checked',false);
		$('#txt_birth_weight').val('');
		$('#txt_birth_height').val('');
		$('#sel_home_record').val('').change();
		$('#sel_ssr').val('').change();
	}

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
@endsection
