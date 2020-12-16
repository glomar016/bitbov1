@extends('global.main')

@section('title', "Residents' Basic Info")
@section('page-css')

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{asset('assets/plugins/jquery-smart-wizard/src/css/smart_wizard.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/parsley/src/parsley.css')}}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

@endsection

@section('page-js')
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>

<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.js')}}"></script>
<script src="{{asset('assets/js/demo/form-wizards.demo.min.js')}}"></script>
<script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->

<script src="{{asset('assets/plugins/highlight/highlight.common.js')}}"></script>
<script src="{{asset('assets/js/demo/render.highlight.js')}}"></script>
<script src="{{asset('assets/js/moment.js')}}"></script>


@endsection
@section('content')
	
	
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Extra</a></li>
				<li class="breadcrumb-item active">Search Results</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Search Results <small>3 results found</small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			    	<!-- begin result-container -->
			        <div class="result-container">
			        	<!-- begin input-group -->
			            <div class="input-group input-group-lg m-b-20">
                            <input type="text" class="form-control input-white" placeholder="Enter keywords here..." />
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Search</button>
                               
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:;">Action</a></li>
                                    <li><a href="javascript:;">Another action</a></li>
                                    <li><a href="javascript:;">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="javascript:;">Separated link</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- end input-group -->
                        <!-- begin dropdown -->
                        <div class="dropdown pull-left">
                            <a href="javascript:;" class="btn btn-white btn-white-without-border dropdown-toggle" data-toggle="dropdown">
                                Filters by
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="javascript:;">Posted Date</a></li>
                                <li><a href="javascript:;">View Count</a></li>
                                <li><a href="javascript:;">Total View</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:;">Location</a></li>
                            </ul>
                        </div>
                        <!-- end dropdown -->
                        <!-- begin btn-group -->
                        {{--<div class="btn-group m-l-10 m-b-20">
                            <a href="javascript:;" class="btn btn-white btn-white-without-border"><i class="fa fa-list"></i></a>
                            <a href="javascript:;" class="btn btn-white btn-white-without-border"><i class="fa fa-th"></i></a>
                            <a href="javascript:;" class="btn btn-white btn-white-without-border"><i class="fa fa-th-large"></i></a>
                        </div>
                        <!-- end btn-group -->
                        <!-- begin pagination -->
                        <ul class="pagination pull-right m-t-3 m-b-20">
                            <li class="disabled"><a href="javascript:;" class="page-link">«</a></li>
                            <li class="active"><a href="javascript:;" class="page-link">1</a></li>
                            <li class="page-item"><a href="javascript:;" class="page-link">2</a></li>
                            <li class="page-item"><a href="javascript:;" class="page-link">3</a></li>
                            <li class="page-item"><a href="javascript:;" class="page-link">4</a></li>
                            <li class="page-item"><a href="javascript:;" class="page-link">5</a></li>
                            <li class="page-item"><a href="javascript:;" class="page-link">6</a></li>
                            <li class="page-item"><a href="javascript:;" class="page-link">7</a></li>
                            <li class="page-item"><a href="javascript:;" class="page-link">»</a></li>
                        </ul>--}}
                        <br><br><br>
                        <ul class="result-list">
                            <li>
                                <a href="#" class="result-image" style="background-image: url(../assets/img/gallery/gallery-51.jpg)"></a>
                                <div class="result-info">
                                    <h4 class="title"><a href="javascript:;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
                                    <p class="location">United State, BY 10089</p>
                                    <p class="desc">
                                        Nunc et ornare ligula. Aenean commodo lectus turpis, eu laoreet risus lobortis quis. Suspendisse vehicula mollis magna vel aliquet. Donec ac tempor neque, convallis euismod mauris. Integer dictum dictum ipsum quis viverra.
                                    </p>
                                   
                                </div>
                                <div class="result-price">
                                    Resident 
                                    <a href="javascript:;" class="btn btn-yellow btn-block">View Details</a>
                                </div>
                            </li>
                            
                        </ul>
                        <!-- end result-list -->
                        <!-- begin pagination -->
                        <div class="clearfix m-t-20">
							<ul class="pagination pull-right">
								<li class="disabled"><a href="javascript:;" class="page-link">«</a></li>
								<li class="active"><a href="javascript:;" class="page-link">1</a></li>
								<li class="page-item"><a href="javascript:;" class="page-link">2</a></li>
								<li class="page-item"><a href="javascript:;" class="page-link">3</a></li>
								<li class="page-item"><a href="javascript:;" class="page-link">4</a></li>
								<li class="page-item"><a href="javascript:;" class="page-link">5</a></li>
								<li class="page-item"><a href="javascript:;" class="page-link">6</a></li>
								<li class="page-item"><a href="javascript:;" class="page-link">7</a></li>
								<li class="page-item"><a href="javascript:;" class="page-link">»</a></li>
							</ul>
                        </div>
                        <!-- end pagination -->
                    </div>
                    <!-- end result-container -->
			    </div>
			    <!-- end col-12 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
	
@endsection

