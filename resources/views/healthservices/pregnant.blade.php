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
		<li class="breadcrumb-item"><a href="javascript:;">Pregnant</a></li>
	</ol>

	<h1 class="page-header">Pregnant <small>DILG Requirements</small></h1>
	<input type="text" id="txt_CRUD_status" hidden>

	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active">

				<span class="d-sm-block d-none">Resident List</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >

				<span class="d-sm-block d-none">Pregnant Record</span>
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
					<h4 class="panel-title">Pregnant</h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<div class="panel-body">
					<table id="tbl_femaleresident_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($resident as $row)
							<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<a id="btnAddPregnant" class="btn btn-lime m-r-5 m-b-5" data-toggle="modal" data-target="#modal-addPregnant" style="color: #fff">
										<i class="fa fa-edit" style="color:#fff"></i>Add Pregnant Record
									</a>
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
					<h4 class="panel-title">Pregnant</h4>
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
								<th width="20">Name</th>
								<th   width="30">Address</th>
								<th   width="20">Birthdate</th>
								<th   width="30">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($pregnant as $row)
							<tr class="gradeC" id="{{$row->PREGNANT_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="30%">
									<a id="btnUpdatePregnant" class="btn btn-success m-r-5 m-b-5" data-toggle="modal" data-target="#modal-addPregnant" style="color: #fff">
										<i class="fa fa-edit" style="color:#fff"></i>Update Pregnant Record
									</a>
									<a id="btnViewPregnantHistory" class="btn btn-info m-r-5 m-b-5" data-toggle="modal" data-target="#modal-viewPregnantHistory" style="color: #fff">
										<i class="fa fa-edit" style="color:#fff"></i>View Pregnancy History
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>



	{{-- addPregnant modal --}}
	<div class="modal fade" id="modal-addPregnant" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background: #90CA4B" id="modalHeader">
					<h4 class="modal-title" style="color: #fff">Pregnant</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					<h3><b><label id="txt_resname" >Resident:</label></b></h3>
					<input type="text" id="txt_resid" hidden> <input type="text" id="txt_pregnant_id" hidden>
					<div class="col-md-10">
						<label>Type of Home Record:</label>
						<select class="form-control" id="sel_home_record" style="color: black;" >
							<option selected disabled value=""></option>
							<option value="Mother and Child Book (MCB)">Mother and Child Book (MCB)</option>
							<option value="Immunization Card (ECCD)">Immunization Card (ECCD)</option>
						</select>
					</div>
					<br>
					<div class="col-md-10">
						<label>Number of Months Pregnant</label>
						<input type="text" id="txt_mosPregnant" class="form-control" />
					</div>
					<br>
					<div class="col-md-10">
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_birthPlan"unchecked value="0">
							<label for="chk_birthPlan">Have Birth Plan?</label>
						</div>
					</div>
					<br>
					<dir></dir>
					<label>Blood Type</label>
					<select class="form-control" id="sel_bloodType" style="color: black;">
						<option selected disabled value=""></option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="O">O</option>
						<option value="AB">AB</option>
					</select>
				</div>
				<br>
				<div class="col-md-10">
					<label>Service Received</label>
					<div class="checkbox checkbox-css">
						<input type="checkbox" id="chk_fswfa"unchecked >
						<label for="chk_fswfa">Ferrous Sulfate with Folic Acid</label>
					</div>
					<div class="checkbox checkbox-css">
						<input type="checkbox" id="chk_tetanus1"unchecked>
						<label for="chk_tetanus1">Tetanus Toxoid 1</label>
					</div>
					<div class="checkbox checkbox-css">
						<input type="checkbox" id="chk_tetanus2"unchecked>
						<label for="chk_tetanus2">Tetanus Toxoid 2</label>
					</div>
					<div class="checkbox checkbox-css">
						<input type="checkbox" id="chk_tetanus3"unchecked>
						<label for="chk_tetanus3">Tetanus Toxoid 3</label>
					</div>
					<div class="checkbox checkbox-css">
						<input type="checkbox" id="chk_tetanus4"unchecked>
						<label for="chk_tetanus4">Tetanus Toxoid 4</label>
					</div>
					<div class="checkbox checkbox-css">
						<input type="checkbox" id="chk_tetanus5"unchecked>
						<label for="chk_tetanus5">Tetanus Toxoid 5</label>
					</div>
				</div>
				<br>
				<div class="col-md-10">
					<label>Number of Prenatal Checkup</label>	
					<div class="row form-group m-b-10">
						<label class="col-md-4 col-form-label">1" tri (0-84 days)</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="text" class="form-control" id="txt_1tri">
							</div>
						</div>
					</div>
					<div class="row form-group m-b-10">
						<label class="col-md-4 col-form-label">2" tri (85-169 days)</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="text" class="form-control" id="txt_2tri">
							</div>
						</div>
					</div>
					<div class="row form-group m-b-10">
						<label class="col-md-4 col-form-label">3" tri (190-above days)</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="text" class="form-control" id="txt_3tri">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-10">
					<label>Danger Observed</label>
					<div class="checkbox checkbox-css">
						<input type="checkbox" id="chk_doA"  unchecked >
						<label for="chk_doA">A = Masakit ang ulo na may kasamang panlalabo ng paningin</label>
					</div>
					<div class="checkbox checkbox-css">
						<input type="checkbox" id="chk_doB" unchecked >
						<label for="chk_doB">B = Lagnat</label>
					</div>
					<div class="checkbox checkbox-css">
						<input type="checkbox" id="chk_doC"unchecked>
						<label for="chk_doC">C = Pagdurugo sa pwerta</label>
					</div>
					<div class="checkbox checkbox-css">
						<input type="checkbox" id="chk_doD" unchecked >
						<label for="chk_doD">D = Kombulsyon</label>
					</div>
					<div class="checkbox checkbox-css">
						<input type="checkbox" id="chk_doE" unchecked >
						<label for="chk_doE">E = Matinding sakit sa tiyan</label>
					</div>
					<div class="checkbox checkbox-css">
						<input type="checkbox" id="chk_doF"  unchecked >
						<label for="chk_doF">F = Pamumutla</label>
					</div>
					<div class="checkbox checkbox-css">
						<input type="checkbox"  id="chk_doG" unchecked>
						<label for="chk_doG">G = Pamamaga ng paa</label>
					</div>
				</div>
				<br>
				<div class="col-md-10">
					<label>Due Date</label>
					<input type="date" class="form-control" style="width: 250px;" id="txt_dueDate" />
				</div>
				<br>
				<div class="col-md-10">
					<label>Pregnancy Conclusion:</label>
					<select class="form-control" id="sel_pregnancyConclusion" style="color: black;" >
						<option selected disabled value=""></option>
						<option value="A">Nakunan</option>
						<option value="B">Nanganak ng Normal</option>
						<option value="C">Nanganak ng Caesarian</option>
						<option value="D">Nanganak ng kulang sa buwan</option>
						<option value="E">Namatay ang nanay</option>
						<option value="Namatay ang sanggol">Namatay ang sanggol</option>
						<option value="G">Namatay ang nanay at sanggol</option>
						<option value="Not Applicable">Not Applicable</option>
					</select>
				</div>
				<br>
				<legend class="m-t-10"></legend>
				<div class="col-md-12" style="margin-bottom: 10px">
					<legend class="m-t-10"></legend>
					<div align="right" >
						<a onclick="hideModal()" class="btn btn-white m-r-9">Cancel</a>
						<button type="submit" id="btnPregnantCRUD" class="btn btn-lime m-r-9" style="background: #90CA4B" >Add</button>


					</div>
				</div>			
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-viewPregnantHistory" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"  style="background: #3A92AB" id="modalHeader">
				<h4 class="modal-title" style="color: #fff">Pregnant History</h4>
				<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
			</div>
			<div class="modal-body">
				<h3><b><label id="txt_resname2" >Resident:</label></b></h3>
				<input type="text" id="txt_preggy_id" hidden>
				

				<div class="panel-body">
                        	<!-- begin table-responsive -->
                        	<div class="table-responsive">
								<table class="table table-striped m-b-0" id="tbl_pregnancy_history">
									<thead>
										<tr>
											<th>Date Visited</th>
											<th>Pregnancy Conclusion</th>
											<th>Date of Birth</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
							<!-- end table-responsive -->
                        </div>
			<legend class="m-t-10"></legend>
			<div class="col-md-12" style="margin-bottom: 10px">
				<legend class="m-t-10"></legend>
				<div align="right" >
					<a onclick="hideModal()" class="btn btn-white m-r-9">Cancel</a>
					


				</div>
			</div>			
		</div>
	</div>
	</div>

	</div>
</div>
@endsection

@section('page-js')
<script >
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		$("table[id='tbl_femaleresident_lst']").DataTable();
		$("table[id='tbl_pregnant_lst']").DataTable();
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
              window.location.href = "{{route('PregnantExport')}}";
            } else {
               Cancelled();
            }
        });
	});

	$('#tbl_femaleresident_lst').on('click', '#btnAddPregnant', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$("input[id='txt_resid']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;
		$('#txt_CRUD_status').val('Add');

		//modal & button
		$('#modalHeader').css({ 'background' : '#90CA4B'});
		$('#btnPregnantCRUD').css({ 'background' : '#90CA4B'});
		$('#btnPregnantCRUD').attr('class', 'btn btn-lime m-r-9');
		$('#btnPregnantCRUD').text('Add');
	});

	$('#tbl_pregnant_lst').on('click', '#btnViewPregnantHistory', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$("input[id='txt_preggy_id']").val(row.attr("id"));
		document.getElementById("txt_resname2").innerHTML = name;
		$('#txt_CRUD_status').val('RetrievePregnancyRecord');

		let data = {
				'_token' : "{{ csrf_token() }}"
				,'PREGNANT_ID' : $("input[id='txt_preggy_id']").val()
				,'CRUD_STATUS' : $("input[id='txt_CRUD_status']").val()
		};
		 var table = $("table[id = 'tbl_pregnancy_history'] tbody");
                           table.find("td").remove();

		$.ajax({
			url : "{{ route('CRUDPregnant') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				 $.each(response["pregnancy_history"], function(){
                                

                                    table.append('<tr>' +
											'<td>'+this["CREATED_AT"]+'</td>' +
											'<td>'+this["PREGNANCY_CONCLUSION"]+'</td>' +
											'<td>'+this["DUE_DATE"]+'</td>' +
										'</tr>'
										);
                                    
                           });
			},
			error : function(error){
				console.log("error: " + error);
				alert('may mali');
			}
		});	

	})



	$('#tbl_pregnant_lst').on('click', '#btnUpdatePregnant', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$("input[id='txt_pregnant_id']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;
		$('#txt_CRUD_status').val('SpecificPregnant');

		//modal & button
		$('#modalHeader').css({ 'background' : '#008A8A'});
		$('#btnPregnantCRUD').css({ 'background' : '#008A8A'});
		$('#btnPregnantCRUD').attr('class', 'btn btn-success m-r-9');
		$('#btnPregnantCRUD').text('Update');


		//
		// console.log($("input[id='txt_CRUD_status']").val());

		let data = {
			'_token' : "{{ csrf_token() }}"
			,'PREGNANT_ID' : $("input[id='txt_pregnant_id']").val()
			,'CRUD_STATUS' : $("input[id='txt_CRUD_status']").val()
		};

		var HomeRecord, BloodType, PregnancyConclusion, BirthPlan, FerrousSulfate, Tetanus1, Tetanus2, Tetanus3, Tetanus4, Tetanus5, A, B, C, D, E, F, G, PregnancyMonths, Tri1, Tri2, Tri3, DueDate, ResidentID;

		$.ajax({
			url : "{{ route('CRUDPregnant') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				$.each(response["specific_pregnant"], function(){
					HomeRecord = this["TYPE_OF_HOME_RECORD"];
					BloodType = this["BLOOD_TYPE"];
					PregnancyConclusion = this["PREGNANCY_CONCLUSION"];
					BirthPlan = this["HAD_BIRTH_PLAN"];
					FerrousSulfate = this["HAD_FERRO_SULFATE_FOLIC_ACID"];
					Tetanus1 = this["HAD_TETANOUS_TOXOID_1"];
					Tetanus2 = this["HAD_TETANOUS_TOXOID_2"];
					Tetanus3 = this["HAD_TETANOUS_TOXOID_3"];
					Tetanus4 = this["HAD_TETANOUS_TOXOID_4"];
					Tetanus5 = this["HAD_TETANOUS_TOXOID_5"];
					A = this["DO_A"];
					B = this["DO_B"];
					C = this["DO_C"];
					D = this["DO_D"];
					E = this["DO_E"];
					F = this["DO_F"];
					G = this["DO_G"];
					PregnancyMonths = this["NUMBER_OF_MONTHS_PREGNANT"];
					Tri1 = this["PRENATAL_CHECKUP_1TRI"];
					Tri2 = this["PRENATAL_CHECKUP_2TRI"];
					Tri3 = this["PRENATAL_CHECKUP_3TRI"];
					DueDate = this["DUE_DATE"];
				});
				//SET DATA

				$('#txt_mosPregnant').val(PregnancyMonths);
				$('#txt_1tri').val(Tri1);
				$('#txt_2tri').val(Tri2);
				$('#txt_3tri').val(Tri3);
				$('#sel_home_record').val(HomeRecord).change();
				$('#sel_bloodType').val(BloodType).change();
				$('#sel_pregnancyConclusion').val(PregnancyConclusion).change();
				if(BirthPlan == 1){$('#chk_birthPlan').prop('checked',true);} else{$('#chk_birthPlan').prop('checked',false);}
				if(FerrousSulfate == 1){$('#chk_fswfa').prop('checked',true);} else{$('#chk_fswfa').prop('checked',false);}
				if(Tetanus1 == 1){$('#chk_tetanus1').prop('checked',true);} else{$('#chk_tetanus1').prop('checked',false);}
				if(Tetanus2 == 1){$('#chk_tetanus2').prop('checked',true);} else{$('#chk_tetanus2').prop('checked',false);}
				if(Tetanus3 == 1){$('#chk_tetanus3').prop('checked',true);} else{$('#chk_tetanus3').prop('checked',false);}
				if(Tetanus4 == 1){$('#chk_tetanus4').prop('checked',true);} else{$('#chk_tetanus4').prop('checked',false);}
				if(Tetanus5 == 1){$('#chk_tetanus5').prop('checked',true);} else{$('#chk_tetanus5').prop('checked',false);}
				if(A == 1){$('#chk_doA').prop('checked',true);} else{$('#chk_doA').prop('checked',false);}
				if(B == 1){$('#chk_doB').prop('checked',true);} else{$('#chk_doB').prop('checked',false);}
				if(C == 1){$('#chk_doC').prop('checked',true);} else{$('#chk_doC').prop('checked',false);}
				if(D == 1){$('#chk_doD').prop('checked',true);} else{$('#chk_doD').prop('checked',false);}
				if(E == 1){$('#chk_doE').prop('checked',true);} else{$('#chk_doE').prop('checked',false);}
				if(F == 1){$('#chk_doF').prop('checked',true);} else{$('#chk_doF').prop('checked',false);}
				if(G == 1){$('#chk_doG').prop('checked',true);} else{$('#chk_doG').prop('checked',false);}
				

			},
			error : function(error){
				console.log("error: " + error);
				alert('may mali');
			}
		});	


	});


	//CRUD	modal-addPregnant
	$('#modal-addPregnant').on('click', '#btnPregnantCRUD', function(){
		if($('#txt_CRUD_status').val() == "SpecificPregnant")
			$('#txt_CRUD_status').val("Update");

		var HomeRecord, BloodType, PregnancyConclusion, BirthPlan, FerrousSulfate, Tetanus1, Tetanus2, Tetanus3, Tetanus4, Tetanus5, A, B, C, D, E, F, G, PregnancyMonths, Tri1, Tri2, Tri3, DueDate, ResidentID;
		if ($('#chk_birthPlan').is(":checked")){BirthPlan =1;}else{BirthPlan =0;}
		if ($('#chk_fswfa').is(":checked")){FerrousSulfate =1;}else{FerrousSulfate =0;}
		if ($('#chk_tetanus1').is(":checked")){Tetanus1 =1;}else{Tetanus1 =0;}
		if ($('#chk_tetanus2').is(":checked")){Tetanus2 =1;}else{Tetanus2 =0;}
		if ($('#chk_tetanus3').is(":checked")){Tetanus3 =1;}else{Tetanus3 =0;}
		if ($('#chk_tetanus4').is(":checked")){Tetanus4 =1;}else{Tetanus4 =0;}
		if ($('#chk_tetanus5').is(":checked")){Tetanus5 =1;}else{Tetanus5 =0;}
		if ($('#chk_doA').is(":checked")){A =1;}else{A =0;}
		if ($('#chk_doB').is(":checked")){B =1;}else{B =0;}
		if ($('#chk_doC').is(":checked")){C =1;}else{C =0;}
		if ($('#chk_doD').is(":checked")){D =1;}else{D =0;}
		if ($('#chk_doE').is(":checked")){E =1;}else{E =0;}
		if ($('#chk_doF').is(":checked")){F =1;}else{F =0;}
		if ($('#chk_doG').is(":checked")){G =1;}else{G =0;}
		HomeRecord = $('#sel_home_record option:selected').text();
		BloodType = $('#sel_bloodType option:selected').text();
		PregnancyConclusion = $('#sel_pregnancyConclusion option:selected').text();
		PregnancyMonths = $("input[id='txt_mosPregnant']").val()
		Tri1 = $("input[id='txt_1tri']").val()
		Tri2 = $("input[id='txt_2tri']").val()
		Tri3 = $("input[id='txt_3tri']").val()
		DueDate = $("input[id='txt_dueDate']").val()
		ResidentID = $("input[id='txt_resid']").val()


		let data = {
			'_token' : "{{ csrf_token() }}"
			,'RESIDENT_ID' : ResidentID
			,'TYPE_OF_HOME_RECORD' : HomeRecord
			,'NUMBER_OF_MONTHS_PREGNANT' : PregnancyMonths
			,'HAD_BIRTH_PLAN' : BirthPlan
			,'BLOOD_TYPE' : BloodType
			,'DUE_DATE' : DueDate
			,'PREGNANCY_CONCLUSION' : PregnancyConclusion
			,'HAD_FERRO_SULFATE_FOLIC_ACID' : FerrousSulfate
			,'HAD_TETANOUS_TOXOID_1' : Tetanus1
			,'HAD_TETANOUS_TOXOID_2' : Tetanus2
			,'HAD_TETANOUS_TOXOID_3' : Tetanus3
			,'HAD_TETANOUS_TOXOID_4' : Tetanus4
			,'HAD_TETANOUS_TOXOID_5' : Tetanus5
			,'PRENATAL_CHECKUP_1TRI' : Tri1
			,'PRENATAL_CHECKUP_2TRI' : Tri2
			,'PRENATAL_CHECKUP_3TRI' : Tri3
			,'DO_A' : A
			,'DO_B' : B
			,'DO_C' : C
			,'DO_D' : D
			,'DO_E' : E
			,'DO_F' : F
			,'DO_G' : G
			,'CRUD_STATUS' : $("input[id='txt_CRUD_status']").val()
			,'PREGNANT_ID' : $("input[id='txt_pregnant_id']").val()
		};
		
		$.ajax({
			url : "{{ route('CRUDPregnant') }}",
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
				console.log("error: " + error);
				alert('may mali');
			}
		});	
	});
	

	//hide modal
	function hideModal(){$('#modal-addPregnant').modal('hide'); $('#modal-viewPregnantHistory').modal('hide');}

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
