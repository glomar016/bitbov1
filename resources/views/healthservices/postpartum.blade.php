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
		<li class="breadcrumb-item"><a href="javascript:;">Post-partum</a></li>
	</ol>

	<h1 class="page-header">Post-partum <small>DILG Requirements</small></h1>
	<input type="text" id="txt_CRUD_status" hidden>

	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active">

				<span class="d-sm-block d-none">Pregnant List</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >

				<span class="d-sm-block d-none">Postpartum Record</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" id="btnExport">

				<span class="d-sm-block d-none">Export</span>
			</a>
		</li>

	</ul>

	<div class="tab-content">
		{{-- NAV PILLS TAB 1 - RECORDS --}}
		<div class="tab-pane fade active show" id="nav-pills-tab-1">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Post-partum</h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<div class="panel-body">
					<table id="tbl_pregnant_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($PregnantResident as $row)
							<tr class="gradeC" id="{{$row->PREGNANT_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<button type="button" class="btn btn-lime m-r-5 m-b-5" id="btnAddPostpartum"  >
										<i class="fas fa-lg fa-fw m-r-10 fa-tag"></i>Add Postpartum Record
									</button>
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
		</div>

		{{-- NAV PILLS TAB 2 - RECORDS --}}
		<div class="tab-pane fade " id="nav-pills-tab-2">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Post-partum</h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<div class="panel-body">
					<table id="tbl_postpartum_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($postpartum as $row)
							<tr class="gradeC" id="{{$row->POST_PATRUM_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<button type="button" class="btn btn-success m-r-5 m-b-5" id="btnUpdatePostpartum" >
										<i class="fas fa-lg fa-fw m-r-10 fa-tag"></i>Update Postpartum Record
									</button>
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	{{-- addPostpartum modal --}}
	<div class="modal fade" id="modal-addPostpartum" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background: #008A8A" id="modalHeader">
					<h4 class="modal-title" style="color: #fff">Postpartum</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #90ca4b">×</button>
				</div>
				<div class="modal-body">
					<h3><b><label id="txt_resname" >Resident:</label></b></h3>
					<input type="text" id="txt_pregnantid" hidden><input type="text" id="txt_postpartum_id" hidden>
					<div class="col-md-10 col-lg-12">
						<label>Birth Date:</label>
						<input type="date" class="form-control " id="txt_birth_date" />
					</div>
					<br>
					<div class="col-md-10 col-lg-12">
						<label>Birth Place:</label>
						<select class="form-control" id="sel_birth_place" style="color: black;" onchange="SelBirthPlace()">
							<option selected disabled value=""></option>
							<option value="Center">Center</option>
							<option value="Hospital">Hospital</option>
							<option value="House">House</option>
							<option value="Other">Other</option>
						</select>
					</div>
					<br>
					<div class="col-md-10 col-lg-12">
						<label>Birth Coordinator</label>
						<select class="form-control" id="sel_birth_coordinator" style="color: black;" onchange="SelBrithCoordinator()">
							<option selected disabled value=""></option>
							<option value="Doctor">Doctor</option>
							<option value="Nurse">Nurse</option>
							<option value="Midwife">Midwife</option>
							<option value="Hilot">Hilot</option>
							<option value="Other">Other</option>
						</select>
					</div>
					<br>
					<div class="col-md-10">
						<label>Danger Observed</label>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_do_a"unchecked onchange="checkDOA(this)" value="0">
							<label for="chk_do_a">A = labis na pagdurugo</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_do_b"unchecked onchange="checkDOB(this)" value="0">
							<label for="chk_do_b">B = Lagnat</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_do_c"unchecked onchange="checkDOC(this)" value="0">
							<label for="chk_do_c">C = Mataas na presyon</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_do_d"unchecked onchange="checkDOD(this)" value="0">
							<label for="chk_do_d">D = Kombulsyon</label>
						</div>
					</div>
					<br>
					<div class="col-md-10">
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_breastfeed_1hr"unchecked onchange="checkBreastfeed1hr(this)" value="0">
							<label for="chk_breastfeed_1hr">Breastfeed more than an hour?</label>
						</div>
					</div>
					<br>
					<div class="col-md-10">
						<label>Number of Postnatal Checkup</label>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_24hr"unchecked onchange="check24hr(this)" value="0">
							<label for="chk_24hr">First 24 hours</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_72hr"unchecked onchange="check72hr(this)" value="0">
							<label for="chk_72hr">First 72 hours</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_7days"unchecked onchange="check7days(this)" value="0">
							<label for="chk_7days">First 7 days</label>
						</div>
					</div>
					<br>
					<div class="col-md-10">
						<label>Service Received</label>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_fswfa"unchecked onchange="checkFSWFA(this)" value="0">
							<label for="chk_fswfa">Ferrous Sulfate with Folic Acid</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_vitaminA"unchecked onchange="checkVitaminA(this)" value="0">
							<label for="chk_vitaminA">Vitamin A</label>
						</div>
					</div>
					<br>
					<div class="col-md-10 col-lg-12">
						<label>Source Service Received:</label>
						<select class="form-control" id="sel_ssr" style="color: black;">
							<option selected disabled value=""></option>
							<option value="Health Center">Health Center</option>
							<option value="Barangay Health Station">Barangay Health Station</option>
							<option value="Private Clinic">Private Clinic</option>
						</select>
					</div>
					<br>
					<div class="col-md-10">
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_fpu"unchecked onchange="checkFPU(this)" value="0">
							<label for="chk_fpu">Is Family Planning User?</label>
						</div>
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_fp"unchecked onchange="checkFP(this)" value="0">
							<label for="chk_fp">Is interested in Family Planning?</label>
						</div>
					</div>
					<input type="text" id="txt_sel_birth_place" value="0" hidden>
					<input type="text" id="txt_sel_birth_coordinator" value="0" hidden>
					<input type="text" id="txt_chk_do_a" value="0" hidden> 
					<input type="text" id="txt_chk_do_b" value="0" hidden>
					<input type="text" id="txt_chk_do_c" value="0" hidden>
					<input type="text" id="txt_chk_do_d" value="0" hidden>
					<input type="text" id="txt_chk_breastfeed_1hr" value="0" hidden>
					<input type="text" id="txt_chk_24hr" value="0" hidden>
					<input type="text" id="txt_chk_72hr" value="0" hidden>
					<input type="text" id="txt_chk_7days" value="0" hidden>
					<input type="text" id="txt_chk_fswfa" value="0" hidden>
					<input type="text" id="txt_chk_vitaminA" value="0" hidden>
					{{-- <input type="text" id="txt_sel_ssr" value="0" > --}}
					<input type="text" id="txt_chk_fp" value="0" hidden>
					<input type="text" id="txt_chk_fpu" value="0" hidden>
					<br>
					<legend class="m-t-10"></legend>
					<div align="right">
						<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
						<button  onclick = "AddPostpartum()" id="btnPostpartum" class="btn btn-lime m-r-9" style="background: #008A8A">Add</button>
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
		$("table[id='tbl_pregnant_lst']").DataTable();
		$("table[id='tbl_postpartum_lst']").DataTable();
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
              window.location.href = "{{route('PostpartumExport')}}";
            } else {
               Cancelled();
            }
        });
	});


	$('#tbl_pregnant_lst').on('click', '#btnAddPostpartum', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$("input[id='txt_pregnantid']").val(row.attr("id"));
		$('#txt_resname').text(name);
		$("#txt_CRUD_status").val('Add');
		console.log($("#txt_CRUD_status").val());

		//modal,button UI change
		$('#modal-addPostpartum').modal('show');
		$('#btnPostpartum').css({ 'background' : '#90CA4B'});
		$('#btnPostpartum').attr('class', 'btn btn-lime m-r-9');
		$('#btnPostpartum').text('Add');
		$('#modalHeader').css({ 'background' : '#90CA4B'});
		// alert(name);


	});

	$('#tbl_postpartum_lst').on('click', '#btnUpdatePostpartum', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$("input[id='txt_postpartum_id']").val(row.attr("id"));
		$('#txt_resname').text(name);
		$("#txt_CRUD_status").val('Update');
		console.log($("#txt_CRUD_status").val());

		//modal & button
		$('#modal-addPostpartum').modal('show');
		$('#modalHeader').css({ 'background' : '#008A8A'});
		$('#btnPostpartum').css({ 'background' : '#008A8A'});
		$('#btnPostpartum').attr('class', 'btn btn-success m-r-9');
		$('#btnPostpartum').text("Update");
		// alert(name);


		let data = {
			'_token' : "{{ csrf_token() }}"
			,'postpartum_id' : $("input[id='txt_postpartum_id']").val()

		};
		var BirthPlace, BirthCoordinator, IsFPUserm, InterestedInFP, BirthDate, BreastFeed, Postnatal24Hrs, Postnatal72Hrs, Postnatal7Days, A, B, C, D, FerrouseSulfate, VitaminA, SSR;

		$.ajax({
			url : "{{ route('SpecificPostpartum') }}",
			method : 'POST',
			data : data,
			success : function(response) {
					$.each(response["specific_postpartum"], function(){
						BirthPlace = this["BIRTH_PLACE"];
						BirthCoordinator = this["BIRTH_COORDINATOR"];
						IsFPUserm = this["IS_FP_USER"];
						InterestedInFP = this["INTERESTED_IN_FP"];
						BirthDate = this["BIRH_DATE"];
						BreastFeed = this["HAD_BREASTFEED_1_HR"];
						Postnatal24Hrs = this["HAD_POSTNATAL_24_HRS"];
						Postnatal72Hrs = this["HAD_POSTNATAL_72_HRS"];
						Postnatal7Days = this["HAD_POSTNATAL_7_DAYS"];
						A = this["DO_A"];
						B = this["DO_B"]
						C = this["DO_C"];
						D = this["DO_D"];
						FerrouseSulfate = this["FERROUS_SULFATE"];
						VitaminA = this["VITAMIN_A"];
						SSR = this["SOURCE_OF_SERVICE_RECEIVED"];
				});
				//SET DATA
				$('#sel_birth_place').val(BirthPlace).change();
				$('#sel_birth_coordinator').val(BirthCoordinator).change();
				$('#sel_ssr').val(SSR).change();

				if(IsFPUserm == 1){$('#chk_fpu').prop('checked',true);} else{$('#chk_fpu').prop('checked',false);}
				if(InterestedInFP == 1){$('#chk_fp').prop('checked',true);} else{$('#chk_fp').prop('checked',false);}
				if(BreastFeed == 1){$('#chk_breastfeed_1hr').prop('checked',true);} else{$('#chk_breastfeed_1hr').prop('checked',false);}
				if(Postnatal24Hrs == 1){$('#chk_24hr').prop('checked',true);} else{$('#chk_24hr').prop('checked',false);}
				if(Postnatal72Hrs == 1){$('#chk_72hr').prop('checked',true);} else{$('#chk_72hr').prop('checked',false);}
				if(Postnatal7Days == 1){$('#chk_7days').prop('checked',true);} else{$('#chk_7days').prop('checked',false);}
				if(A == 1){$('#chk_do_a').prop('checked',true);} else{$('#chk_do_a').prop('checked',false);}
				if(B == 1){$('#chk_do_b').prop('checked',true);} else{$('#chk_do_b').prop('checked',false);}
				if(C == 1){$('#chk_do_c').prop('checked',true);} else{$('#chk_do_c').prop('checked',false);}
				if(D == 1){$('#chk_do_d').prop('checked',true);} else{$('#chk_do_d').prop('checked',false);}
				if(FerrouseSulfate == 1){$('#chk_fswfa').prop('checked',true);} else{$('#chk_fswfa').prop('checked',false);}
				if(VitaminA == 1){$('#chk_vitaminA').prop('checked',true);} else{$('#chk_vitaminA').prop('checked',false);}
				$('#txt_birth_date').val(BirthDate);
				
			},
				error : function(error){
					console.log("error: " + error);
					alert('may mali');
				}
			});

	});
	//CRUD
	function AddPostpartum(){
		let data = {
			'_token' : "{{ csrf_token() }}"
			,'pregnant_id' : $("input[id='txt_pregnantid']").val()
			,'birth_place' : $("input[id='txt_sel_birth_place']").val()
			,'birth_coordinator' : $("input[id='txt_sel_birth_coordinator']").val()
			,'is_fp_user' : $("input[id='txt_chk_fpu']").val()
			,'interested_in_fp' : $("input[id='txt_chk_fp']").val()
			,'birth_date' : $("input[id='txt_birth_date']").val()
			,'had_breastfedd_1_hr' : $("input[id='txt_chk_breastfeed_1hr']").val()
			,'had_postnatal_24_hrs' : $("input[id='txt_chk_24hr']").val()
			,'had_postnatal_72_hrs' : $("input[id='txt_chk_72hr']").val()
			,'had_postnatal_7_days' : $("input[id='txt_chk_7days']").val()
			,'pp_do_a' : $("input[id='txt_chk_do_a']").val()
			,'pp_do_b' : $("input[id='txt_chk_do_b']").val()
			,'pp_do_c' : $("input[id='txt_chk_do_c']").val()
			,'pp_do_d' : $("input[id='txt_chk_do_d']").val()
			,'ferrous_sulfate' : $("input[id='txt_chk_fswfa']").val()
			,'vitamin_a' : $("input[id='txt_chk_vitaminA']").val()
			,'ssr' : $('#sel_ssr option:selected').text()
			,'CRUD_STATUS' : $("input[id='txt_CRUD_status']").val()
			,'post_partum_id' : $("input[id='txt_postpartum_id']").val()

		};


		$.ajax({
			url : "{{ route('CRUDPostpartum') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				$('#modal-addPostpartum').modal('hide');
				swal({
					title: 'Postpartum Success',
					text: response["message"],
					icon: 'success',

				});
				window.location.reload();
				},
				error : function(error){
					console.log("error: " + error);
					alert('may mali');
				}
			});
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
	//select
	function SelBirthPlace(){var birthplace = document.getElementById('sel_birth_place').value;$("#txt_sel_birth_place").val(birthplace);}
	function SelBrithCoordinator(){var birthcoordinator = document.getElementById('sel_birth_coordinator').value;$("#txt_sel_birth_coordinator").val(birthcoordinator);}
	// function SelSSR(){var ssr = document.getElementById('sel_ssr').value;$("#txt_sel_ssr").val(ssr);}
	//checkbox
	function checkDOA(){if($('#chk_do_a').is(":checked")){$("#txt_chk_do_a").val(1);}else{$("#txt_chk_do_a").val(0);}}
	function checkDOB(){if($('#chk_do_b').is(":checked")){$("#txt_chk_do_b").val(1);}else{$("#txt_chk_do_b").val(0);}}
	function checkDOC(){if($('#chk_do_c').is(":checked")){$("#txt_chk_do_c").val(1);}else{$("#txt_chk_do_c").val(0);}}
	function checkDOD(){if($('#chk_do_d').is(":checked")){$("#txt_chk_do_d").val(1);}else{$("#txt_chk_do_d").val(0);}}
	function checkBreastfeed1hr(){if($('#chk_breastfeed_1hr').is(":checked")){$("#txt_chk_breastfeed_1hr").val(1);}else{$("#txt_chk_breastfeed_1hr").val(0);}}
	function check24hr(){if($('#chk_24hr').is(":checked")){$("#txt_chk_24hr").val(1);}else{$("#txt_chk_24hr").val(0);}}
	function check72hr(){if($('#chk_72hr').is(":checked")){$("#txt_chk_72hr").val(1);}else{$("#txt_chk_72hr").val(0);}}
	function check7days(){if($('#chk_7days').is(":checked")){$("#txt_chk_7days").val(1);}else{$("#txt_chk_7days").val(0);}}
	function checkFSWFA(){if($('#chk_fswfa').is(":checked")){$("#txt_chk_fswfa").val(1);}else{$("#txt_chk_fswfa").val(0);}}
	function checkVitaminA(){if($('#chk_vitaminA').is(":checked")){$("#txt_chk_vitaminA").val(1);}else{$("#txt_chk_vitaminA").val(0);}}
	function checkFPU(){if($('#chk_fpu').is(":checked")){$("#txt_chk_fpu").val(1);}else{$("#txt_chk_fpu").val(0);}}
	function checkFP(){if($('#chk_fp').is(":checked")){$("#txt_chk_fp").val(1);}else{$("#txt_chk_fp").val(0);}}

	//hide modal
	function hideModal(){$('#modal-addPostpartum').modal('hide');}
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