@extends('global.main')

@if(session('session_position')!='Admin')
<script type="text/javascript">location.href='{{route("Dashboard")}}'</script>
@else

@endif

@section('title', "Business Category Setup")

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
        $("#tbl_business_cat").DataTable({
            "bSort" : false
        });
        });


    </script>

    {{--For Edit button--}}
    <script>
        var Editform = document.getElementById("EditForm");

        $("a[id='EditBTN']").on('click',function () {
            var catname = $('#EditCatName').val()
            var catdesc = $('#EditCatDesc').val()
            if(catname == "" || catdesc =="")
            {
                $('#reqcatnameedit').html('Required field!').css('color', 'red');
                $('#reqcatdescedit').html('Required field!').css('color', 'red');
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
                            setTimeout(function(){ Editform.submit(); }, 1000);
                        } else {
                            swal("Operation Cancelled.", {
                                icon: "error",
                            });
                        }
                    });

            }

        });
    </script>

     <script type="text/javascript">
        $('#tbl_business_cat').on('click', '#viewBtn',function (){
        let row = $(this).closest("tr")
         $("#ViewCategName").text($(this).closest("tbody tr").find("td:eq(1)").html());
        $("#ViewCategDesc").text($(this).closest("tbody tr").find("td:eq(2)").html());
        });

          

    </script>

    <script type="text/javascript">
        $('#tbl_business_cat').on('click', '#editmodalBtn',function (){
        let row = $(this).closest("tr")
        $("#EditCatID").val($(this).closest("tbody tr").find("td:eq(0)").html());
                $("#EditCatName").val($(this).closest("tbody tr").find("td:eq(1)").html());
                $("#EditCatDesc").val($(this).closest("tbody tr").find("td:eq(2)").html());
        });
    </script>
    

    {{--For Modal EDIT Form--}}
   {{--  <script type="text/javascript">
        $(document).ready(function()
        {
            $("#editmodalBtn").click(function()
            {
                $("#EditCatID").val($(this).closest("tbody tr").find("td:eq(0)").html());
                $("#EditCatName").val($(this).closest("tbody tr").find("td:eq(1)").html());
                $("#EditCatDesc").val($(this).closest("tbody tr").find("td:eq(2)").html());
            });
        });
    </script> --}}

{{--For ADD FORM--}}
    <script>
        var Addform = document.getElementById("AddForm");

        $('#AddBTN').click(function(){
            var catname = $('#AddCatName').val()
            var catdesc = $('#AddCatDesc').val()
            if(catname == "" || catdesc ==""){
                $('#reqcatnameadd').html('Required field!').css('color', 'red');
                $('#reqcatdescadd').html('Required field!').css('color', 'red');
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
                setTimeout(function(){ Addform.submit(); }, 1000);

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
            <li class="breadcrumb-item"><a href="javascript:;">Category Setup</a></li>
            <li class="breadcrumb-item active">Business Category</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Category Setup <small> Configurations required by the system.</small></h1>
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
                        <h4 class="panel-title">Business Category</h4>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin alert -->
                    <div class="alert alert-yellow fade show">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Business Category groups all the businesses inside the barangay depending on their nature.
                    </div>
                    <!-- end alert -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <button type='button' class='btn btn-lime'data-toggle='modal' data-target='#AddModal' >
                            <i class='fa fa-plus'></i> Add New
                        </button>

                        <br>
                        <br>
                        <table id="tbl_business_cat" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th hidden>Category ID </th>
                                <th>Category Name </th>
                                <th>Category Description </th>
                                <th style="width: 19%">Actions </th>
                            </tr>
                            </thead>

                            <tbody>
                        @foreach( $displaydata as $value )

                            <tr >
                                <td hidden>{{$value->BUSINESS_NATURE_ID}}</td>
                                <td>{{$value->BUSINESS_NATURE_NAME}}</td>
                                <td>{{$value->BUSINESS_NATURE_DESCRIPTION}}</td>
                                <td>
                                    <button type='button' id="viewBtn" class='btn btn-warning 'data-toggle='modal' data-target='#ViewModal' >
                                        <i class='fa fa-eye'></i> View
                                    </button>

                                    <button type='button' id="editmodalBtn" class='btn btn-success ' data-toggle='modal' data-target='#UpdateModal'>
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
                                <form id="EditForm" method="POST" action="{{ route('BusinessCategoryEdit') }}">
                                    @csrf

                                    <div class="modal-content">
                                    <div class="modal-header" style="background-color: #008a8a">
                                        <h4 class="modal-title" style="color: white">Edit Category</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                    </div>
                                    <div class="modal-body">
                                        {{--modal body start--}}
                                        <label class="form-label hide">Category ID</label>
                                        <input id="EditCatID" name="EditCatID" type="text" class="form-control hide" name="CategoryID"/>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Business Category</label> <span id='reqcatnameedit'></span>
                                                <input style="text-transform: capitalize;" id="EditCatName" name="EditCatName" class="form-control"  placeholder="e.g.: Merchandising" required="true">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Description</label> <span id='reqcatdescedit'></span>
                                                <textarea id="EditCatDesc" name="EditCatDesc" class="form-control" required="true" placeholder="Briefly define the category"></textarea>
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
                                        <h4 class="modal-title" style="color: white">View Category</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                    </div>
                                    <div class="modal-body">
                                        {{--modal body start--}}
                                            <h2 id="ViewCategName" align="center"></h2>
                                            <label style="display: block; text-align: center">Category Name</label>
                                        <br>
                                            <h2 id="ViewCategDesc" align="center"></h2>
                                            <label style="display: block; text-align: center">Description</label>
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
                                <form id="AddForm" method="POST" action="{{ route('BusinessCategory') }}">
                                    @csrf

                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color:#6C9738;">
                                            <h4 class="modal-title" style="color: white">Add Business Category</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                    </div>
                                            <div class="modal-body">
                                       {{--modal body start--}}
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Business Category</label> <span id='reqcatnameadd'></span>
                                                <input style="text-transform: capitalize;" id="AddCatName" name="AddCatName" class="form-control"  placeholder="e.g.: Merchandising" required="true">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Description</label> <span id='reqcatdescadd'></span>
                                                <textarea id="AddCatDesc" name="AddCatDesc" class="form-control" required="true" placeholder="Briefly define the category" ></textarea>
                                            </div>
                                        </div>
                                        {{--modal body end--}}
                                    </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
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