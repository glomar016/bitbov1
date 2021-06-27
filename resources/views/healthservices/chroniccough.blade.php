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
		<li class="breadcrumb-item"><a href="javascript:;">Illnesses</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Chronic Diseases</a></li>
	</ol>

	<h1 class="page-header">Chronic Cough <small>DILG Requirements</small></h1>
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
				<div class="panel-heading-btn" >
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				</div>
				<h4 class="panel-title">Tag as with Chronic Cough</h4>
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
							<th class="text-nowrap">Status</th>
							<th class="text-nowrap">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($resident as $row)
						<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
							<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
							<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
							<td>{{$row->DATE_OF_BIRTH}}</td>
							<td>
								@if($row->ILLNESS_STATUS== "POSITIVE")
									<a class="btn btn-xs btn-danger m-l-3" style="color: #fff">With Chronic Cough</a>
								@else
									<a class="btn btn-xs btn-primary m-l-3" style="color: #fff">Without Chronic Cough</a>
								@endif
							</td>
							<td width="20%">
								<a id="btnAddChronicCough" class="btn btn-lime m-r-5 m-b-5" data-toggle="modal" data-target="#modal-addChronicCough" style="color: #fff">
									<i class="fa fa-edit" style="color:#fff"></i>Chronic Cough Record
								</a>

								@if($row->ILLNESS_STATUS== "POSITIVE")
									<a id="btnViewHistoryResident" class="btn btn-warning m-r-5 m-b-5" data-toggle="modal" data-target="#modal-viewIllnessHistory" style="color: #fff">
										<i class="fa fa-edit" style="color:#fff"></i>Chronic Cough History
									</a>
								@else
									<a id="#" class="btn btn-grey m-r-5 m-b-5"  style="color: #fff">
										<i class="fa fa-edit" style="color:#fff"></i>Chronic Cough History
									</a>
								@endif
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
					<div class="panel-heading-btn" >
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Tag as with Chronic Cough</h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<div class="col-md-3">
					<br>
					<button type="submit" class="btn btn-lime form-control" style="width: 270px" id="btnNonResident">
                        <i class="fa fa-plus"></i> &nbsp Add Non-Resident with Chronic Cough
                    </button>
				</div>
				<div class="panel-body">
					<table id="tbl_nonresident_lst" class="table table-striped table-bordered">
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
							@foreach($nonresident as $row)
							<tr class="gradeC" id="{{$row->NONRESIDENT_ID }}">
								<td>{{$row->FIRST_NAME}} {{$row->MIDDLE_NAME}} {{$row->LAST_NAME}} </td>
								<td></td>
								<td>{{$row->BIRTHDATE}}</td>
								<td><a class="btn btn-xs btn-danger m-l-3" style="color: #fff">With Chronic Cough</a></td>
								<td width="20%">
									<a id="btnViewHistoryNonResident" class="btn btn-warning m-r-5 m-b-5" data-toggle="modal" data-target="#modal-viewIllnessHistory" style="color: #fff">
										<i class="fa fa-edit" style="color:#fff"></i>Chronic Cough History
									</a>
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
				<h4>Click <a href="{{route('ChronicCoughExport')}}">here</a>  to redownload file</h4>
			</div>
		</div> 
	</div>
	{{-- addChronicCough modal --}}
	<div class="modal fade" id="modal-addChronicCough" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background: #90CA4B" id="modalHeader">
					<h4 class="modal-title" style="color: #fff">Chronic Cough</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					<h3><b><label id="txt_resname" >Resident:</label></b></h3>
					<input type="text" id="txt_resid" hidden>

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
						<label>Date of Visit</label>
						<input type="date" class="form-control" style="width: 250px;" id="txt_visitDate" />
					</div>
					<br>
					<div class="col-md-10">
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_2weeksCough"  unchecked onchange="check2weeksCough(this)" value="0">
							<label for="chk_2weeksCough">Had Cough more that two weeks?</label>
						</div> <input type="text" id="txt_chk_2weeksCough" value="0" hidden>
					</div>
					<br>
					<div class="col-md-10">
						<label>Remarks</label>
						{{-- <input type="text" class="form-control" id="txtarea_remarks"/> --}}
						<textarea type="text" class="form-control" id="txtarea_remarks"> </textarea>
					</div>
					<legend class="m-t-10"></legend>
					<div align="right">
						<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
						<button  onclick = "AddChronicCough()" id="btnChronicCough" class="btn btn-lime m-r-9" style="background: #90CA4B">Tag</button>
					</div>				
				</div>
			</div>
		</div>
	</div>
	{{-- viewIllnessHistory --}}
	<div class="modal fade" id="modal-viewIllnessHistory" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background: #F59C1A" id="modalHeader">
					<h4 class="modal-title" style="color: #fff">Chronic Cough History</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					<h3><b><label id="txt_resname2v" >Resident:</label></b></h3>
					 <input type="text" id="txt_resid2v" hidden>
						<div class="panel-body">
		                        	<!-- begin table-responsive -->
		                        	<div class="table-responsive">
										<table class="table table-striped m-b-0" id="tbl_history">
											<thead>
												<tr>
													<th>Date Visited</th>
													<th>Remarks</th>
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
<script>
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		$("table[id='tbl_resident_lst']").DataTable();
		$("table[id='tbl_nonresident_lst']").DataTable();

		document.querySelector("#txt_visitDate").valueAsDate = new Date();
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
              window.location.href = "{{route('ChronicCoughExport')}}";
            } else {
               Cancelled();
            }
        });
	});

	$('#btnNonResident').on('click', function()	{
		$('#modal-addChronicCough').modal('show');
		$('#txt_resname').hide();
		$('#divNonResident').show();
		$("input[id='txt_CRUD_status']").val('Add_NonResident');
		//modal,button UI change
		$('#modal-addChronicCough').modal('show');
		$('#btnChronicCough').css({ 'background' : '#90CA4B'});
		$('#btnChronicCough').attr('class', 'btn btn-lime m-r-9');
		$('#btnChronicCough').text('Add');
		$('#modalHeader').css({ 'background' : '#90CA4B'});
	});

	$('#tbl_resident_lst').on('click', '#btnAddChronicCough', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text()
		$("input[id='txt_resid']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;

		//modal,button UI change
		$('#modal-newBornRecord').modal('show');
		$('#btnChronicCough').css({ 'background' : '#90CA4B'});
		$('#btnChronicCough').attr('class', 'btn btn-lime m-r-9');
		$('#btnChronicCough').text('Add');
		$('#modalHeader').css({ 'background' : '#90CA4B'});
		$("input[id='txt_CRUD_status']").val('Add_Resident')
		$('#txt_resname').show();
		$('#divNonResident').hide();

	});

	$('#tbl_nonresident_lst').on('click', '#btnUpdateChronicCough', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text()
		$("input[id='txt_resid']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;

		//modal,button UI change
		$('#btnChronicCough').css({ 'background' : '#008A8A'});
		$('#btnChronicCough').attr('class', 'btn btn-success m-r-9');
		$('#btnChronicCough').text('Update');
		$('#modalHeader').css({ 'background' : '#008A8A'});
		$('#txt_resname').show();
		$('#divNonResident').hide();

	});


	$('#tbl_resident_lst').on('click', '#btnViewHistoryResident', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text()
		$("input[id='txt_resid2v']").val(row.attr("id"));
		document.getElementById("txt_resname2v").innerHTML = name;

		let data = {
				'_token' : "{{ csrf_token() }}"
				,'resident_id' : $("input[id='txt_resid2v']").val()
				,'CRUD_STATUS' : "SpecificResidentHistory"
		};
		// alert($("input[id='txt_resid2v']").val());
		var table = $("table[id = 'tbl_history'] tbody");
                           table.find("td").remove();
        $.ajax({
			url : "{{ route('ChronicCough') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				 $.each(response["specific_illness"], function(){
                                

                            table.append('<tr>' +
									'<td>'+this["DATE_OF_VISIT"]+'</td>' +
									'<td>'+this["REMARKS"]+'</td>' +
									
								'</tr>'
								);
                   });
			},
			error : function(error){
				console.log("error: " + error);
				alert('may mali');
			}
		});	 

	});


	$('#tbl_nonresident_lst').on('click', '#btnViewHistoryNonResident', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text()
		$("input[id='txt_resid2v']").val(row.attr("id"));
		document.getElementById("txt_resname2v").innerHTML = name;

		let data = {
				'_token' : "{{ csrf_token() }}"
				,'resident_id' : $("input[id='txt_resid2v']").val()
				,'CRUD_STATUS' : "SpecificNonResidentHistory"
		};
		// alert($("input[id='txt_resid2v']").val());
		var table = $("table[id = 'tbl_history'] tbody");
                           table.find("td").remove();
        $.ajax({
			url : "{{ route('ChronicCough') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				 $.each(response["specific_illness"], function(){
                            table.append('<tr>' +
									'<td>'+this["DATE_OF_VISIT"]+'</td>' +
									'<td>'+this["REMARKS"]+'</td>' +
									
								'</tr>'
								);
                   });
				 console.log(response["nonresident"]);
			},
			error : function(error){
				console.log("error: " + error);
				alert('may mali');
			}
		});	 

	});

	//CRUD
	function AddChronicCough(){
		
		var firstname, middlename, lastname, sex, birthdate;

		//non resident
		firstname = $('#txt_nonresident_fname').val();
		middlename = $('#txt_nonresident_mname').val();
		lastname = $('#txt_nonresident_lname').val();
		sex = $('#sel_nonresident_sex option:selected').text();
		birthdate = $('#txt_nonresident_birthdate').val();
		let data = {
			'_token' : "{{ csrf_token() }}"
			,'resident_id' : $("input[id='txt_resid']").val()
			,'had_more_than_2_weeks' : $("input[id='txt_chk_2weeksCough']").val()
			,'date_of_visit' : $("input[id='txt_visitDate']").val()
			,'remarks' : $('#txtarea_remarks').val()
			,'FIRSTNAME' : firstname
			,'MIDDLENAME' : middlename
			,'LASTNAME' : lastname
			,'SEX' : sex
			,'BIRTHDATE' : birthdate
			,'CRUD_STATUS' : $("input[id='txt_CRUD_status']").val()
		};


		$.ajax({
			url : " {{ route('ChronicCough') }} ",
			method : 'POST',
			data : data,
			success : function(response){
				$('#modal-addChronicCough').modal('hide');
				swal({
					title : 'Success',
					text : 'Saved Record!',
					icon : 'success',
				});
				console.log(response["message"]);
				window.location.reload();
			},
			error : function(error){
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
	//hide modal
	function hideModal(){$('#modal-addChronicCough').modal('hide');$('#modal-viewIllnessHistory').modal('hide');}
	// for checkbox
	function check2weeksCough(){if($('#chk_2weeksCough').is(":checked")){$("#txt_chk_2weeksCough").val(1);}else{$("#txt_chk_2weeksCough").val(0);}}

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