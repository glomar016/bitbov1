@extends('global.main')

@section('title', "Export-Import")

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
   

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>
    {{--Modals--}}
    <script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->

    <script src="{{asset('assets/plugins/highlight/highlight.common.js')}}"></script>
    <script src="{{asset('assets/js/demo/render.highlight.js')}}"></script>

    <script>
        $(document).ready(function() {
            App.init();
        
            TableManageDefault.init();
            Notification.init();
            
        });


    </script>
    <script type="text/javascript">
        var csex = 1, ccivil = 1; var enc_data; var values = {};
        $('#show-sex').click(function(){

            if(csex==1) { $('.sex').show(); csex = 0 } else { $('.sex').hide(); csex = 1 }
        });

        $('#show-civil-status').click(function(){
            
            if(ccivil==1) { $('.civil-status').show(); ccivil = 0; } else { $('.civil-status').hide(); ccivil = 1; }
        });

        $('#filter-form').submit(function(e){
            e.preventDefault();

            var isHiddenSex = document.getElementById('sex').style.display;
            var isHiddenCivilStatus = document.getElementById('civil-status').style.display;
            if(isHiddenSex != 'none') {
                var sex = $('#select-sex').children(":selected").attr("value");
                values['sex'] = sex;
            }

            if(isHiddenCivilStatus != 'none') {
                var civil_status = $('#select-civil-status').children(":selected").attr("value");
                values['civil_status'] = civil_status;
            }

            values = JSON.stringify(values);
            console.log(values);
            
            $.ajax({
                    url: '{{asset('')}}encrypt/'+values,
                    method: 'get',
                    data: {token:"{{csrf_token()}}"},
                    success:function(data) {
                      enc_data = data;
                      window.location.href = "{{asset('')}}ResidentsExport/" + enc_data;
                    }
                  });
           
        });

    </script>
@endsection
@section('content')
    <!-- begin tab-content -->
   <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Export/Import</a></li>

        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Export/Import Residents <small>DILG Requirements</small></h1>
        <!-- end page-header -->

                            <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="ui-general-2">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Choose Filters</h4>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <form id='filter-form'>
                             <div class="panel-body">
                            <div class="row row-space-10">
                                <div class="col-md-6">
                                    <div class="alert alert-primary fade show m-b-10" id="show-sex">
                                        <span class="close" data-dismiss="alert"></span>
                                        Filter by Sex <label>[click to show]</label>.

                                    </div>
                                    <div class="stats-content sex" id='sex' style="display: none;">
                                        <select class="form-control" data-style="btn-lime" id="select-sex">
                                            <option value="Female" selected>Female</option>
                                            <option value="Male" >Male</option>
                                            
                                        </select>
                                        <br>
                                    </div>
                                    <div class="alert alert-dark fade show m-b-10">
                                        <span class="close" data-dismiss="alert"></span>
                                        Filter by Age Single Year <a href="#" class="alert-link">[click to show]</a>.
                                    </div>
                                    <div class="alert alert-danger fade show m-b-10">
                                        <span class="close" data-dismiss="alert"></span>
                                        Filter by Age Group <a href="#" class="alert-link">[click to show]</a>.
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-success fade show m-b-10" id='show-civil-status'>
                                        <span class="close" data-dismiss="alert"></span>
                                        Filter by Civil Status <label>[click to show]</label>.
                                    </div>
                                    <div class="stats-content civil-status"  id='civil-status' style="display: none;" >
                                        <select class="form-control" data-style="btn-lime" id="select-civil-status" >
                                            <option value="Single" selected>Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Separated">Separated</option>
                                            <option value="Widow">Widow</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Annulled">Annulled</option>
                                            <option value="Unknown">Unknown</option>
                                        </select>
                                        <br>
                                    </div>
                                    
                                    <div class="alert alert-info fade show m-b-10">
                                        <span class="close" data-dismiss="alert"></span>
                                        Filter by Origin <a href="#" class="alert-link">[click to show]</a>.
                                    </div>
                                    <div class="alert alert-secondary fade show m-b-10">
                                        <span class="close" data-dismiss="alert"></span>
                                        Filter by Reason of Transferring and Leaving <a href="#" class="alert-link">[click to show]</a>.
                                    </div>
                                    
                                </div>
                                
                            </div>

                            
                            <div class="form-group ">
                                <button type='submit' class='btn btn-lime' style="width: 100px" id="btnExport" ><i class='fa fa-redo'></i> Export</button>
                            </div>
                            
                        </div>
                        <!-- end panel-body -->
                        </form>
                       
                        
                    </div>
                    <!-- end panel -->
        
            <!-- end tab-pane -->
    </div>
    <!-- end tab-content -->

@endsection