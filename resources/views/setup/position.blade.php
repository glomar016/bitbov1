@extends('global.main')

@if(session('session_position')!='Admin')
<script type="text/javascript">location.href='{{route("Dashboard")}}'</script>
@else

@endif


@section('title', "Position Setup")

@section('page-css')

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
 <script>
        $(document).ready(function() {
            App.init();
        TableManageDefault.init();
        $("#table_position_list").DataTable({
            "bSort" : false
        });
        });


    </script>

{{--For Edit button--}}
<script>
    var Editform = document.getElementById("EditForm");

    $("a[id='EditBTN']").on('click',function () {


        var posid = $('#EditPositionIDTxt').val()
        var posname = $('#EditPositionNameTxt').val()

        ;

        if(posid == "" )
        {
            $('#ReqPositionNameTxt').html('Required field!').css('color', 'red');

            swal({
                title: 'Ooops!',
                text: 'Please fill out the necessary fields!',
                icon: 'error',
                buttons: {
                    confirm: {
                        visible: true,
                        className: 'btn btn-danger',
                        closeModal: true,
                    }
                }

            });
        }
        else
        {
            swal({
                title: "Wait!",
                text: "Are you sure you want to edit this?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Data have been successfully updated!", {
                        icon: "success",

                    });
                    setTimeout(function(){ 
                        $.ajax({
                            url:'EditPosition',
                            type:'post',

                            cache:false,
                            data:$("#EditForm").serialize(),
                            success:function()
                            {


                                location.reload();
                            }


                        })
                    }, 1000);
                } else {
                    swal("Operation Cancelled.", {
                        icon: "error",
                    });
                }
            });

        }

    });
</script>

{{--For Modal VIEW Form--}}
{{--For Modal EDIT Form--}}


<script type="text/javascript">
        $('#table_position_list').on('click', '#editmodalBtn',function (){
        let row = $(this).closest("tr")
        $("#EditPositionIDTxt").val($(this).closest("tbody tr").find("td:eq(0)").html());
            $("#EditPositionNameTxt").val($(this).closest("tbody tr").find("td:eq(1)").html());

        });

    </script>

{{--For ADD FORM--}}
<script>
    var Addform = document.getElementById("AddForm");

    $('#AddBTN').click(function(){
        var posname = $('#PositionNameTxt').val();
        var _token= "{{csrf_token()}}";


        if($('#PositionNameTxt').val() == "" ){
            $('#ReqPositionNameTxt').html('Required field!').css('color', 'red');

            swal({
                title: 'Ooops!',
                text: 'Please fill out the necessary fields!',
                icon: 'error',
                buttons: {
                    confirm: {
                        visible: true,
                        className: 'btn btn-danger',
                        closeModal: true,
                    }
                }

            })
        }
        else {
            swal({
                title: 'Success!',
                text: 'Position successfully added.',
                icon: 'success',

            } );
            setTimeout(function(){
                $.ajax({
                    url:'AddPosition',
                    type:'post',                        
                    cache:false,
                    data:$("#AddForm").serialize(),
                    success:function()
                    {

                        $("#AddCloseBtn").click();
                        location.reload();
                    }


                })

            }, 1000);

        }
    });
</script>


@endsection



@section('content')

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Administration</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Site Configuration</a></li>

        <li class="breadcrumb-item active">Position Setup</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Position Setup <small> Configurations required by the system.</small></h1>
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
                    <h4 class="panel-title">Barangay Setup</h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin alert -->
                <div class="alert alert-yellow fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Barangay Setup groups of all the barangay inside a municipality.
                </div>
                <!-- end alert -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <button type='button' class='btn btn-lime'data-toggle='modal' data-target='#AddModal' >
                        <i class='fa fa-plus'></i> Add New
                    </button>

                    <br>
                    <br>
                    <table id="table_position_list" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th hidden>Position ID </th>
                                <th>Position Name </th>                                
                                <th style="width: 12%">Actions </th>
                            </tr>

                        </thead>

                        @foreach($displaydata as $value)

                        <tr >
                            <td hidden>{{$value->POSITION_ID}}</td>
                            <td >{{$value->POSITION_NAME}}</td>

                            <td>
                                <button type='button' class='btn btn-success' id="editmodalBtn" data-toggle='modal' data-target='#UpdateModal'>
                                    <i class='fa fa-edit'></i> Edit
                                </button>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>

                <!-- #modal-EDIT -->
                <div class="modal fade" id="UpdateModal">
                    <div class="modal-dialog" style="max-width: 30%">
                        <form id="EditForm" method="POST" action="{{ route('EditPosition') }}">
                            @csrf

                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #008a8a">
                                    <h4 class="modal-title" style="color: white">Edit Position</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                </div>
                                <div class="modal-body">
                                    {{--modal body start--}}
                                    <label class="form-label hide">Position ID</label>
                                    <input id="EditPositionIDTxt" name="EditPositionIDTxt" type="text" class="form-control hide" />

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Position Name</label> <span id='ReqPositionNameEdit'></span>
                                            <input style="text-transform: capitalize;" id="EditPositionNameTxt" name="EditPositionNameTxt" class="form-control"  placeholder="e.g.: Tanod" required="true">
                                        </div>
                                    </div>
                                    
                                    {{--modal body end--}}
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                    {{--<a id="DeleteBTN" href="javascript:;" class="btn btn-danger">Delete</a>--}}
                                    <a id="EditBTN" href="javascript:;" class="btn btn-success">Update</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- #modal-view -->


                <!-- #modal-add -->
                <div class="modal fade" id="AddModal">
                    <div class="modal-dialog" style="max-width: 30%">
                        <form id="AddForm"method="POST" action="{{ route('AddPosition') }}">
                            @csrf

                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#6C9738;">
                                    <h4 class="modal-title" style="color: white">Add Position</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                </div>
                                <div class="modal-body">
                                 {{--modal body start--}}
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Position Name</label> <span id='ReqPositionNameTxt'></span>
                                        <input style="text-transform: capitalize;" id="PositionNameTxt" name="PositionNameTxt" class="form-control"  placeholder="e.g.: Tanod" required="true">
                                    </div>
                                </div>

                                {{--modal body end--}}
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:;" class="btn btn-white" id="AddCloseBtn" data-dismiss="modal">Close</a>
                                <a id="AddBTN" href="javascript:;" class="btn btn-lime">Add</a>
                            </div>
                        </div>
                    </form>
                </div>
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

<!-- end #content -->




@endsection