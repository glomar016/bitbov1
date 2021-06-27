 
@extends('global.main')

@section('page-css')

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')}}" rel="stylesheet" />
   
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />

    
@endsection


@section('page-init-app')
 <script>
    $(document).ready(function() {
        App.init();
        TableManageDefault.init();
      
    });
</script>
@endsection



@section('table-js')

    <script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>

@endsection

@section('page-js')

    @if (Request::ajax())
        @section('page-init-table') @show
        @section('page-init-app') @stop
        
    @else
        @section('page-init-app') @show
        @section('table-js') @show
        
    @endif


@endsection

@section('content')

  <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">Administration</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Site Configuration</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Category Setup</a></li>
            <li class="breadcrumb-item active">Issuances</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Add Issuances<small> Configurations required by the system.</small></h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div >


             <a href="{{ url('/pdfprint') }}" class='btn btn-lime' >
                            <i class='fa fa-plus'></i> print
                        </a>
                        <br>
            <!-- begin col-10 -->
            <div>
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                        </div>
                        <h4 class="panel-title">Issuances</h4>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin alert -->
                    <div class="alert alert-yellow fade show">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Issuances Records groups all the forms being issued by the barangay.
                    </div>
                    <!-- end alert -->
                    <!-- begin panel-body -->
                    <div class="panel-body">


                        <br>
                        <br>
                        <!-- begin row -->
                        <div class="row">
                            <!-- begin col-6 -->
                            <div class="col-lg-12">
                                <!-- begin nav-pills -->
                                <ul class="nav nav-pills">
                                    <li class="nav-items">
                                        <a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active">
                                            <span class="d-sm-none">Pills 1</span>
                                            <span class="d-sm-block d-none">&nbsp&nbspResidents&nbsp&nbsp&nbsp&nbsp</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <!-- begin tab-pane -->
                                    <div class="tab-pane fade active show" id="nav-pills-tab-1">

                                       
                                         <!-- end row -->
                                        <div id="LoadTable">
                                            <table id="data-table-default" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                       
                                                        <th >Resident Name</th>
                                                        
                                                        <th >Actions</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="table-body">

                                                   
                                                    <tr >
                                                       
                                                        <td></td>
                                                        
                                                        <td >
                                                             <button type='button' class='btn btn-lime issueModal' data-toggle='modal' data-target='#IssueModal' >
                                                                <i class='fas fa-address-card'></i> Issue
                                                            </button>
                                                        </td>

                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                 

                                    
                    <!-- end panel-body -->
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-10 -->
        </div>

        <!-- end row -->
    </div>
    <div>
                @endsection