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
	<h1 class="page-header">Chronic Diseases <small>DILG Requirements</small></h1>
	
	{{-- nav pills --}}
	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active">
				<span class="d-sm-block d-none">Resident</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >
				<span class="d-sm-block d-none">Chronic Diseases Record</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" id="btnExport">

				<span class="d-sm-block d-none">Export</span>
			</a>
		</li>
	</ul>
	{{-- nav pills content --}}
	<div class="tab-content">	
		{{-- NAV PILLS TAB 1 - ADD CHRONIC DISEASES --}}
		<div class="tab-pane fade active show" id="nav-pills-tab-1">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title"> Chronic Diseases</h4>
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
							@foreach($resident as $row)
							<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<a id="btnAddChronicDiseases" class="btn btn-lime m-r-5 m-b-5" data-toggle="modal" data-target="#modal-addChronicDiseases" style="color: #fff">
										<i class="fa fa-edit" style="color:#fff"></i>Tag as with Chronic Disease
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
					<h4 class="panel-title"> Chronic Diseases</h4>
				</div>
				<div class="alert alert-yellow fade show">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
					</button>
					The following are the existing records of the residents within the system.
				</div>
				<div class="panel-body">
					<table id="tbl_chronicdiseases_lst" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Address</th>
								<th class="text-nowrap">Birthdate</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($chronicdiseases as $row)
							<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
								<td>{{$row->FIRSTNAME}} {{$row->MIDDLENAME}} {{$row->LASTNAME}} </td>
								<td>{{$row->ADDRESS_UNIT_NO}} {{$row->ADDRESS_PHASE}} {{$row->ADDRESS_BLOCK_NO}} {{$row->ADDRESS_HOUSE_NO}} {{$row->ADDRESS_STREET}} {{$row->ADDRESS_SUBDIVISION}} {{$row->ADDRESS_BUILDING}}</td>
								<td>{{$row->DATE_OF_BIRTH}}</td>
								<td width="20%">
									<a id="btnUpdateChronicDiseases" class="btn btn-lime m-r-5 m-b-5" data-toggle="modal" data-target="#modal-addChronicDiseases" style="color: #fff">
										<i class="fa fa-edit" style="color:#fff"></i> Chronic Disease
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
	{{-- addChronicDiseases modal --}}
	<div class="modal fade" id="modal-addChronicDiseases" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background: #90CA4B" id="modalHeader">
					<h4 class="modal-title" style="color: #fff">Chronic Diseases</h4>
					<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
				</div>
				<div class="modal-body">
					<h3><b><label id="txt_resname" >Resident:</label></b></h3>
					<input type="text" id="txt_resid" hidden/>

					<div class="col-md-10">
						<label>Date of Visit</label>
						<input type="date" class="form-control" style="width: 250px;" id="txt_visitDate" />
					</div>
					<br>
					<div class="col-md-10">
						<div class="checkbox checkbox-css">
							<input type="checkbox" id="chk_highFever"  unchecked onchange="checkHighFever(this)" value="0">
							<label for="chk_highFever">Had a High Fever?</label>
						</div> <input type="text" id="txt_chkHighFever" value="0" hidden>
					</div>
					<br>
					<div class="col-md-10">
						<label>Chronic Disease Name:</label>
						<input type="text" class="form-control" id="txt_chronicDiseaseName">
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
						<button  onclick = "AddChronicDiseases()" id="btnChronicDiseases" class="btn btn-lime m-r-9" style="background: #90CA4B">Tag</button>
					</div>				
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


<script >
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		$("table[id='tbl_resident_lst']").DataTable();
		$("table[id='tbl_chronicdiseases_lst']").DataTable();
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
              window.location.href = "{{route('ChronicDiseasesExport')}}";
            } else {
               Cancelled();
            }
        });
	});

	// click table to modal get data
	$('#tbl_resident_lst').on('click', '#btnAddChronicDiseases', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$("input[id='txt_resid']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;

		//modal,button UI change
		$('#btnChronicDiseases').css({ 'background' : '#90CA4B'});
		$('#btnChronicDiseases').attr('class', 'btn btn-lime m-r-9');
		$('#btnChronicDiseases').text('Add');
		$('#modalHeader').css({ 'background' : '#90CA4B'});
	});

	$('#tbl_chronicdiseases_lst').on('click', '#btnUpdateChronicDiseases', function(){
		let row = $(this).closest("tr")
		,name = $(row.find("td")[0]).text();

		$("input[id='txt_resid']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = name;

		//modal,button UI change
		$('#btnChronicDiseases').css({ 'background' : '#008A8A'});
		$('#btnChronicDiseases').attr('class', 'btn btn-success m-r-9');
		$('#btnChronicDiseases').text('Update');
		$('#modalHeader').css({ 'background' : '#008A8A'});
	});


	//CRUD
	function AddChronicDiseases(){
		let data = {
			'_token' : "{{ csrf_token() }}"
			,'resident_id' : $("input[id='txt_resid']").val()
			,'chronic_disease_name' : $("input[id='txt_chronicDiseaseName']").val()
			,'had_high_fever' : $("input[id='txt_chkHighFever']").val()
			,'date_of_visit' : $("input[id='txt_visitDate']").val()
			,'remarks' : $('#txtarea_remarks').val()
		};
		$.ajax({
			url : " {{ route('ChronicDiseases') }} ",
			method : 'POST',
			data : data,
			success : function(response){
				$('#modal-addChronicDiseases').modal('hide');
				swal({
					title : 'Success',
					text : response["message"],
					icon : 'success',
				});
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

	// for modal
	function hideModal(){$('#modal-addChronicDiseases').modal('hide');}	
	// for checkbox
	function checkHighFever(){if($('#chk_highFever').is(":checked")){$("#txt_chkHighFever").val(1);}else{$("#txt_chkHighFever").val(0);}}

	// function checkBGC(){if($('#cssCheckbox1').is(":checked")){$("#txt_chk_bgc").val(1);}else{$("#txt_chk_bgc").val(0);}}
</script>


@endsection