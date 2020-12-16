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
		<li class="breadcrumb-item"><a href="javascript:;">Malaria</a></li>
	</ol>

	<h1 class="page-header">Malaria <small>DILG Requirements</small></h1>
	{{-- nav pills --}}
	<ul class="nav nav-pills">
		<li class="nav-items">
			<a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active">
				<span class="d-sm-block d-none">Tag as with Malaria</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >
				<span class="d-sm-block d-none">Malaria Record</span>
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
					<h4 class="panel-title">Tag as with Malaria</h4>
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
								<th width="20%">First Name</th>
								<th width="20%">Middle Name</th>
								<th width="20%">Last Name</th>
								<th width="20%">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($resident as $row)
							<tr class="gradeC" id="{{$row->resident_id}}">
								<td>{{ $row->first_name }}</td>
								<td>{{ $row->middle_name }}</td>
								<td>{{ $row->last_name }}</td>
								<td>
									<a id="btnAddMalaria" class="btn btn-success m-r-5 m-b-5" data-toggle="modal" data-target="#modal-addMalaria" style="color: #fff">
										<i class="fa fa-edit" style="color:#fff"></i>Tag as with Malaria
									</a>
								</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
		{{-- addMalaria modal --}}
		<div class="modal fade" id="modal-addMalaria" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header"  style="background: #008A8A" >
						<h4 class="modal-title" style="color: #fff">Malaria</h4>
						<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
					</div>
					<div class="modal-body">
						<h3><b><label id="txt_resname" >Resident:</label></b></h3>
						<input type="text" id="txt_resid" hidden>

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
							<input type="text" class="form-control" id="txtarea_remarks"/>
						</div>
						<legend class="m-t-10"></legend>
						<div align="right">
							<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
							<button  onclick = "AddMalaria()" class="btn btn-lime m-r-9" style="background: #008A8A">Tag</button>
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
	});

	//resident table
		$('#tbl_resident_lst').on('click', '#btnAddMalaria', function(){
		let row = $(this).closest("tr")
		,first_name = $(row.find("td")[0]).text()
		,middle_name = $(row.find("td")[1]).text()
		,last_name = $(row.find("td")[2]).text();

		$("input[id='txt_resid']").val(row.attr("id"));
		document.getElementById("txt_resname").innerHTML = last_name + ", " + first_name + " " + middle_name;

	});

	//CRUD
	function AddMalaria(){
		let data = {
			'_token' : $("meta[name='csrf-token']").attr("content")
			,'resident_id' : $("input[id='txt_resid']").val()
		};

		$.ajax({
			url : " {{ route('MalariaAdd') }} ",
			method : 'POST',
			data : data,
			success : function(response){
				$('#modal-addMalaria').modal('hide');
				swal({
					title : 'Success',
					text : response["message"],
					icon : 'success',
				});
			},
			error : function(error){
					alert('may mali');
				}
		});
	}

	//for modal
	function hideModal(){$('#modal-addMalaria').modal('hide');}

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