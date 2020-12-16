@extends('global.main')

@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Certificates and Forms</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">History</a></li>
	</ol>
	<h1 class="page-header">Certificate and Forms Issuance History<small>DILG Requirements</small></h1>
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			</div>
			<h4 class="panel-title">Certificate and Forms Issuance History</h4>
		</div>
		<div class="alert alert-yellow fade show">
			<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">&times;</span>
			</button>
			The following are the existing records of the issuances within the system.
		</div>
		<div class="panel-body">
			<table id="tbl_issuance_lst" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Control No.</th>
						<th>Type Form</th>
						<th>Requested by</th>
						<th>Purpose</th>
						<th>Status</th>
						<th>Date Requested</th>
						<th>Received by</th>
					</tr>
				</thead>
				<tbody>
						@foreach($issuancehistory as $row)
						<tr class="gradeC" id="{{$row->ISSUANCE_ID}}">
							<td>{{$row->ISSUANCE_NUMBER}}</td>
							<td>{{$row->ISSUANCE_NAME}}</td>
							<td>{{$row->FIRSTNAME}} {{$row->LASTNAME}}</td>
							<td>{{$row->REMARKS}}</td>
							<td>{{$row->STATUS}}</td>
							<td>{{$row->ISSUANCE_DATE}}</td>
							<td>{{$row->RECEIVED_BY}}</td>
						</tr>
						@endforeach
				</tbody>
			</table>
		</div>
	</div>


</div>

@endsection

@section('page-js')

<script>
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		$("table[id='tbl_issuance_lst']").DataTable();
	});

	
</script>
{{-- Print --}}
<script src="{{asset('custom/jasonday-printThis-edc43df/printThis.js')}}"></script>
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
