
@extends('global.main')

@if(session('session_permis_user_accounts')!= '1' && session('session_position') != 'Admin')
<script type="text/javascript">location.href='{{route("Dashboard")}}'</script>
@else

@endif


@section('title', "Migration")

@section('page-css')

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{asset('assets/plugins/parsley/src/parsley.css')}}" rel="stylesheet" />
{{--DATE PICKER--}}
<link href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/ionRangeSlider/css/ion.rangeSlider.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/password-indicator/css/password-indicator.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/jquery-tag-it/css/jquery.tagit.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css')}}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

@endsection

@section('page-js')

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>


<script src="{{asset('assets/plugins/parsley/dist/parsley.js')}}"></script>
<script src="{{asset('assets/plugins/highlight/highlight.common.js')}}"></script>
<script src="{{asset('assets/js/demo/render.highlight.js')}}"></script>


<script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/masked-input/masked-input.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/password-indicator/js/password-indicator.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-tag-it/js/tag-it.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-daterangepicker/moment.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/plugins/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-show-password/bootstrap-show-password.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js')}}"></script>
<script src="{{asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{asset('assets/js/demo/form-plugins.demo.min.js')}}"></script>
{{--Modals--}}
<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script>
$(document).ready(function() {
    App.init();
    FormPlugins.init();
    TableManageDefault.init();
    Highlight.init();

});



</script>

<script type="text/javascript">
    var property, filename, filextension, filesize;
   var fd = new FormData();

      $(document).on('change','#file_residents_txt', function() {
    property = document.getElementById('file_residents_txt').files[0];

    if (property != undefined) {
        filename = property.name;
        filextension = filename.split('.').pop().toLowerCase();
        filesize = property.size;
    }

});

</script>
<script>
$(document).ready(function(){

    $("#migrate_residents_btn").click(function(e){
        e.preventDefault();
        if (jQuery.inArray(filextension, ['xlsx','xls','csv']) == -1)
        {
            Cancelled('Invalid excel file');
        }
        else
        {
            if(filesize > 10000000)
            {
                Cancelled('The selected file is very big');
            }
            else
            {
                fd.append("file", property);    
                fd.append('_token', "{{ csrf_token() }}");
                swal({
                title: "Are you sure?",
                text: "Import Residents Record",
                icon: "warning",
                buttons: [true, "Yes"],
                dangerMode: true,
              })
                .then((willDelete) => {
                    if (willDelete) 
                    {
                        $.ajax({
                            url : "{{ route('ResidentsImport') }}",
                            method : 'POST',
                            processData:false,
                            contentType:false,
                            cache:false,
                            data : fd,
                           
                            success : function(data) {
                               if (data == "true")
                               {
                                    location.reload()
                               }
                            },
                            error : function(error){
                                console.log("error: " + error);
                                
                            }
                        }); 
                    }
                    else 
                    {
                       Cancelled('Operation Cancelled!');
                    }
                });
            }
        }

    });

    $("#migrate_ordinances_btn").click(function(e){
        e.preventDefault();
        var form_data = new FormData();

        form_data.append("file",$("#file_ordinances_txt")[0].files[0]);
        form_data.append("_token","{{csrf_token()}}");        
      
        $.ajax({
                url:'ImportOrdinances',
                type:'post',
                processData:false,
                contentType:false,
                data:form_data,
                success: function(data){
                   location.reload()
                },
                error: function(data){
                    alert(data);
                }
            
        });

    });



    $("#migrate_blotters_btn").click(function(e){
        e.preventDefault();
        var form_data = new FormData();
        
        form_data.append("file",$("#file_blotter_txt")[0].files[0]);
        form_data.append("_token","{{csrf_token()}}");        
      
        $.ajax({
                url:'ImportBlotters',
                type:'post',
                processData:false,
                contentType:false,
                data:form_data,
                success: function(data){
                  location.reload()
                },
                error: function(data){
                    console.log(data)
                }
            
        });

    });

    $("#migrate_businesses_btn").click(function(e){
        e.preventDefault();
        var form_data = new FormData();
        var businessfile = $("#file_businesses_txt")[0].files[0];
            form_data.append("file",$("#file_businesses_txt")[0].files[0]);
            form_data.append("_token","{{csrf_token()}}");        
          
            $.ajax({
                    url:'ImportBusinesses',
                    type:'post',
                    processData:false,
                    contentType:false,
                    data:form_data,
                    success: function(data){
                        location.reload()
                    },
                    error: function(data){
                        alert(data);
                    }
                
            });
        // if(businessfile != undefined) {
        //     if(businessfile == ) {
        //         alert('object')
        //     }
        //     else {
             
        //     }
            
        // }
       

    });
})
</script>

@endsection



@section('content')



<!-- panel-add-user-start -->
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Administration</a></li>


        <li class="breadcrumb-item active">User Accounts</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Administration  <small> Configurations required by the system.</small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div >

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
                    <h4 class="panel-title"> Migrate Residents</h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin alert -->
                <div class="alert alert-yellow fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    migrating of residents record to the system.
                    
                    
                    
                </div>
                <!-- end alert -->
                
                
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Resident Excel File </label> <span id='ReqEmail'></span>
                        <input type="file" name="file_residents_txt" id="file_residents_txt" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"  class="form-control form-control-lg" data-parsley-type="email" data-parsley-required="true" />
                        
                    </div>
                    <button id="migrate_residents_btn" class="btn btn-lime">Migrate </button>
                </div>

                <br>

                    
    </div>

    <!-- #modal-SET -->




</div>

<!-- end panel-body -->
</div>
<!-- end panel -->
</div>
<!-- end col-10 -->
</div>

<!-- end row -->
</div>

<!-- end #content -->

<!-- panel-add-user-end -->








<!-- panel-user-accounts-start -->
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">




    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->

    <!-- end page-header -->

    <!-- begin row -->
    <div >

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
                    <h4 class="panel-title"> Migrate Businesses</h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin alert -->
                <div class="alert alert-yellow fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    migrating of businesses record to the system.
                </div>
                <!-- end alert -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    
                    <div class="col-md-6" >
                        <div class="form-group">
                            <label>Business Excel File </label> <span id='ReqEmail'></span>
                            <input type="file" name="file_businesses_txt" id="file_businesses_txt" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"  class="form-control form-control-lg" data-parsley-type="email" data-parsley-required="true" />
                            
                        </div>
                        <button id="migrate_businesses_btn" class="btn btn-lime">Migrate </button>
                    </div>
    
                    <br>
                    
                 




            </div>
            <!-- end panel-body -->
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-10 -->
</div>

<!-- end row -->
</div>

<!-- end #content -->
<!-- panel-user-accounts-end -->

<!-- panel-ordinances-start -->
<div id="content" class="content">
    <!-- begin breadcrumb -->

    <!-- end breadcrumb -->
    <!-- begin page-header -->

    <!-- end page-header -->

    <!-- begin row -->
    <div >

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
                    <h4 class="panel-title">Migrate Ordinances</h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin alert -->
                <div class="alert alert-yellow fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    migrating of ordinances record to the system.
                </div>
                <!-- end alert -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="col-md-6" >
                        <div class="form-group">
                            <label>Ordinance Excel File </label> <span id='ReqEmail'></span>
                            <input type="file" name="file_ordinances_txt" id="file_ordinances_txt" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"  class="form-control form-control-lg" data-parsley-type="email" data-parsley-required="true" />
                            
                        </div>
                        <button id="migrate_ordinances_btn" class="btn btn-lime">Migrate </button>
                    </div>
    
                    <br>
                
            </div>
            <!-- end panel-body -->
        </div>
        <!-- end panel -->

<!-- begin panel -->
<div class="panel panel-inverse">
    <!-- begin panel-heading -->
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

        </div>
        <h4 class="panel-title">Migrate Blotter Records</h4>
    </div>
    <!-- end panel-heading -->
    <!-- begin alert -->
    <div class="alert alert-yellow fade show">
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
        migrating of blotter records to the system.
    </div>
    <!-- end alert -->
    <!-- begin panel-body -->
    <div class="panel-body">
        <div class="col-md-6" >
            <div class="form-group">
                <label>Blotter Excel File </label> <span id='ReqEmail'></span>
                <input type="file" name="file_blotter_txt" id="file_blotter_txt" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"  class="form-control form-control-lg"  data-parsley-required="true" />
                
            </div>
            <button id="migrate_blotters_btn" class="btn btn-lime">Migrate </button>
        </div>

        <br>
    
</div>
<!-- end panel-body -->
</div>
<!-- end panel -->

    </div>
    <!-- end col-10 -->
</div>

<!-- end row -->
</div>




<!-- panel-ordinances-end -->



@endsection