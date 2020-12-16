@extends('global.main')

@section('title', "User Accounts")

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
            Notification.init();
        });

    </script>

    {{--For Edit button--}}
    <script>
        var Editform = document.getElementById("EditForm");

        $("a[id='EditBTN']").on('click',function () {
        

            var barid = $('#EditBarangayID').val()
            var barname = $('#EditBarangayName').val()
            var barseal = $('#EditBarangaySeal')[0].files[0]

            var fd= new FormData();
            fd.append('EditBarangayID',barid)
            fd.append('EditBarangayName',barname)
            fd.append('EditBarangaySeal',barseal);
            fd.append('_token',"{{csrf_token()}}");

            if(barname == "" || $('#EditBarangaySeal').val()=="")
            {
                $('#ReqBarangayNameEdit').html('Required field!').css('color', 'red');
                $('#ReqBarangaySealEdit').html('Required field!').css('color', 'red');
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
                                            url:'EditBarangay',
                                            type:'post',
                                            processData:false,
                                            contentType:false,
                                            cache:false,
                                            data:fd,
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
    <script type="text/javascript">
        $(document).ready(function()
        {
            $(".viewCategory").click(function()
            {
                $("#ViewBarangayName").text($(this).closest("tbody tr").find("td:eq(1)").html());


                $("#ViewBarangaySeal").attr('src','upload/barangay/'+$(this).closest("tbody tr").find("td:eq(2)").html());
            });
        });
    </script>

    {{--For Modal EDIT Form--}}
    <script type="text/javascript">
        $(document).ready(function()
        {
            $(".editCategory").click(function()
            {
                $("#EditBarangayID").val($(this).closest("tbody tr").find("td:eq(0)").html());
                $("#EditBarangayName").val($(this).closest("tbody tr").find("td:eq(1)").html());
                $("#EditBarangaySeal").val($(this).closest("tbody tr").find("td:eq(2)").html());
            });
        });
    </script>

{{--For ADD FORM--}}
    <script>
        var Addform = document.getElementById("AddForm");

        $('#AddBTN').click(function(){
            var barname = $('#BarangayNameTxt').val()
            var barseal = $('#BarangaySealTxt')[0].files[0]
            var fd= new FormData();
            fd.append('BarangayNameTxt',barname)
            fd.append('BarangaySealTxt',barseal);
            fd.append('_token',"{{csrf_token()}}");

            if(barname == "" || $('#BarangaySealTxt').val() ==""){
                $('#ReqBarangayNameTxt').html('Required field!').css('color', 'red');
                $('#ReqBarangaySealTxt').html('Required field!').css('color', 'red');
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
                    text: 'Category successfully added.',
                    icon: 'success',

                } );
                setTimeout(function(){
                    $.ajax({
                        url:'AddBarangay',
                        type:'post',
                        processData:false,
                        contentType:false,
                        cache:false,
                        data:fd,
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
   
       
            <li class="breadcrumb-item active">User Accounts</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">User Accounts  <small> Configurations required by the system.</small></h1>
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
                        <h4 class="panel-title">User Accounts</h4>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin alert -->
                    <div class="alert alert-yellow fade show">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        User accounts of  barangay officials inside a municipality.
                    </div>
                    <!-- end alert -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <button type='button' class='btn btn-lime'data-toggle='modal' data-target='#AddModal' >
                            <i class='fa fa-plus'></i> Add New
                        </button>

                        <br>
                        <br>
                        <table id="data-table-default" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th hidden>Barangay ID </th>
                                <th>Barangay </th>
                                <th>Name </th>
                               
                                <th>Position</th>
                                <th>Email</th>
                                <th style="width: 15%">Actions </th>
                            </tr>
                            </thead>

                            <tbody>
                @foreach ($DisplayData as $Value)
                            <tr >
                                <td hidden>{{$Value->id}}</td>
                                <td>{{$Value->barangay_name}}</td>
                                <td>{{$Value->username}}</td>
                                <td hidden>{{$Value->username}}</td>
                                <td>
                            <embed src="{{asset('upload/barangay/'.$Value->barangay_seal)}}" width="50" height="50"/>
                                </td>
                                <td>
                                    <button type='button' class='btn btn-warning viewCategory'data-toggle='modal' data-target='#ViewModal' >
                                        <i class='fa fa-eye'></i> View
                                    </button>

                                    <button type='button' class='btn btn-success editCategory' data-toggle='modal' data-target='#UpdateModal'>
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
                                <form id="EditForm" method="POST" action="{{ route("BusinessCategoryEdit") }}">
                                    @csrf

                                    <div class="modal-content">
                                    <div class="modal-header" style="background-color: #008a8a">
                                        <h4 class="modal-title" style="color: white">Edit Barangay</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                    </div>
                                    <div class="modal-body">
                                        {{--modal body start--}}
                                        <label class="form-label hide">Barangay ID</label>
                                        <input id="EditBarangayID" name="EditBarangayID" type="text" class="form-control hide" name="CategoryID"/>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Barangay Name</label> <span id='ReqBarangayNameEdit'></span>
                                                <input style="text-transform: capitalize;" id="EditBarangayName" name="EditBarangayName" class="form-control"  placeholder="e.g.: Merchandising" required="true">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Barangay Seal</label> <span id='ReqBarangaySealEdit'></span>
                                                <input type="file" id="EditBarangaySeal" name="EditBarangaySeal" class="form-control" required="true" placeholder="Briefly define the category" >
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
                        <div class="modal fade" id="ViewModal">
                            <div class="modal-dialog" style="max-width: 30%">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #f59c1a">
                                        <h4 class="modal-title" style="color: white">View Barangay</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                    </div>
                                    <div class="modal-body">
                                        {{--modal body start--}}
                                            <h2 id="ViewBarangayName" align="center"></h2>
                                            <label style="display: block; text-align: center">Barangay Name</label>
                                        <br>
                                        <center>
                                            <embed id="ViewBarangaySeal" width="300" height="300" />

                                            <br>
                                            <label>Barangay Seal</label>
                                        </center>
                                        {{--modal body end--}}
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- #modal-add -->
                        <div class="modal fade" id="AddModal">
                            <div class="modal-dialog" style="max-width: 30%">
                                <form id="AddForm" method="POST">
                                    @csrf

                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color:#6C9738;">
                                            <h4 class="modal-title" style="color: white">Add User Account</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                    </div>
                                            <div class="modal-body">
                                       {{--modal body start--}}
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Barangay Name</label> <span id='ReqBarangayNameTxt'></span>
                                                <input style="text-transform: capitalize;" id="BarangayNameTxt" name="BarangayNameTxt" class="form-control"  placeholder="e.g.: Gaya-Gaya" required="true" list="BarangayName">

                                                <datalist id="BarangayName">
                                                    @foreach ($DisplayBarangayName as $Value)
                                                        
                                                        <option>{{$Value->barangay_name}}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Barangay Seal</label> <span id='ReqBarangaySealTxt'></span>
                                                <input type="file" id="BarangaySealTxt" name="BarangaySealTxt" class="form-control" required="true" placeholder="Barangay seal here..." >
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