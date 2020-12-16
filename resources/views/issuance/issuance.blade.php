@extends('global.main')

@if(session('session_permis_issuance_of_forms')!='1' && session('session_position')!='Data Protection Officer')
<script type="text/javascript">location.href='{{route("Dashboard")}}'</script>
@else

@endif

@section('title', "Add Issunces")

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
        Notification.init();
        FormPlugins.init();
        $('#list-of-personal').DataTable();
        $('#list-of-business').DataTable();
        $('#datepicker-new').datepicker();
    });
</script>
@endsection

@section('page-init-table')
<script>
    $(document).ready(function() {
        TableManageDefault.init();
        Notification.init();
        FormPlugins.init();

    });
</script>

@endsection

@section('table-js')

    <script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>

@endsection


@section('date-js')
     <!-- ================== BEGIN PAGE LEVEL JS ================== -->
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
    <!-- ================== END PAGE LEVEL JS ================== -->
@endsection

@section('page-js')

    @if (Request::ajax())
        @section('page-init-table') @show
        @section('page-init-app') @stop
        
    @else
        @section('page-init-app') @show
        @section('table-js') @show
        @yield('page-add')
        @yield('date-js')
    @endif


@endsection

@section('page-functions')

{{--Modals--}}
    <script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->

    <script type="text/javascript">

    // $("#residentname").val($(this).closest("tbody tr").find("td:eq(2)").html());
                
        $(document).ready(function()
        {
            $("#data-table-default").on('click','.issueModal',function() 
            {
               
                $("#residentid").val($(this).closest("tbody tr").find("td:eq(0)").html());
                $("#residentname").val($(this).closest("tbody tr").find("td:eq(2)").html());
                var id = $(this).closest("tbody tr").find("td:eq(0)").html();
                var name = $(this).closest("tbody tr").find("td:eq(2)").html();

                $("#businessrid").val(id);
                $("#businessrname").val(name);
                $("#personalid").val(id);
                $("#personalrname").val(name);
               
            });
        });
    </script>

     

    {{--For Modal EDIT Form--}}
    <script type="text/javascript">
        $(document).ready(function()
        {
        
           $("#data-table-default").on('click','.editCategory', function()
            {
                $("#EditCatID").val($(this).closest("tbody tr").find("td:eq(0)").html());
                $("#EditF").val($(this).closest("tbody tr").find("td:eq(1)").html());
                $("#EditM").val($(this).closest("tbody tr").find("td:eq(2)").html());
                $("#EditL").val($(this).closest("tbody tr").find("td:eq(3)").html());
                
                $("#EditBusinessName").val($(this).closest("tbody tr").find("td:eq(8)").html());
                $("#EditBusinessAdd").val($(this).closest("tbody tr").find("td:eq(9)").html());
                $("#EditBusinessNum").val($(this).closest("tbody tr").find("td:eq(10)").html());
                $("#EditBusinessDate").val($(this).closest("tbody tr").find("td:eq(11)").html());
            });
        });
    </script>

    {{--FOR EDIT FORM--}}
    <script>
        var Editform = document.getElementById("EditForm");

        $("#EditBTN").on('click',function (event) {

            event.preventDefault()
            var catid = $('#EditCatID').val()
            var firstname  = $('#EditF').val()
            var middlename = $('#EditM').val()
            var lastname   = $('#EditL').val()
            var businessname = $('#EditBusinessName').val()
            var location   = $("#EditBusinessLoc").children(":selected").attr("id")
            var businessnature = $('#EditBusinessNature').children(":selected").attr("id")
            var businessaddress = $('#EditBusinessAdd').val()
            var businessnumber = $('#EditBusinessNum').val()
            var businessdate = $('#EditBusinessDate').val()

            if ( firstname == "" )
            {
                ErrorAlert();
                $('#lblfirstname').html('Required field!').css('color', 'red');
            }
            else
            if ( middlename == "" )
            {
                ErrorAlert();
                $('#lblmiddlename').html('Required field!').css('color', 'red'); 
            }
            else
            if ( lastname == "" )
            {
                ErrorAlert();
                $('#lbllastname').html('Required field!').css('color', 'red'); 
            }
            else
            if ( location == "" )
            {
                ErrorAlert();
                $('#lblbusinessloc').html('Required field!').css('color', 'red'); 
            }
            else
            if ( businessname == "" )
            {
                ErrorAlert();
                $('#lblbusinessname').html('Required field!').css('color', 'red'); 
            }
            else
            if ( businessnature == "" )
            {
                ErrorAlert();
                $('#lblbusinessnature').html('Required field!').css('color', 'red'); 
            }
            else
            if ( businessaddress == "" )
            {
                ErrorAlert();
                $('#lblbusinessadd').html('Required field!').css('color', 'red'); 
            }
            else
            if ( businessnumber == "" )
            {
                ErrorAlert();
                $('#lblbusinessnum').html('Required field!').css('color', 'red'); 
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
                    .then((willDelete) => 
                    {
                        if (willDelete) 
                        {
                            UpdateAlert();
                            var fd = new FormData();
                            fd.append('EditCatID',catid);
                            fd.append('EditF',firstname);
                            fd.append('EditM',middlename);
                            fd.append('EditL',lastname);
                            fd.append('EditBusinessName',businessname);
                            fd.append('EditBusinessLoc',location);
                            fd.append('EditBusinessNature',businessnature);
                            fd.append('EditBusinessAdd',businessaddress);
                            fd.append('EditBusinessNum',businessnumber);
                            fd.append('EditBusinessDate',businessdate);
                            fd.append('_token',"{{csrf_token()}}");

                             $.ajax({

                                url:"{{route('BusinessesEdit')}}",
                                type:'post',
                                processData:false,
                                contentType:false,
                                cache:false,
                                data:fd,
                                success:function()
                                {
                                    
                                    setTimeout(loadTbl,500); 
                                    
                                }   
                            })

                        } 
                        else 
                        {
                            OperationCancel();    
                        }
                    });
                
           }
       

        function loadTbl() {
            $('#LoadTable').load("Businesses")
        }

        function UpdateAlert() {
            swal("Data have been successfully updated!", {
                icon: "success",
            });
        }

        function OperationCancel()
        {
            swal("Operation Cancelled.", {
                icon: "error",
            });
        }

    });
    </script>

@endsection

@section('page-add')

    

    {{--For ADD FORM--}}
    <script type="text/javascript"> 
      
        var Addform = document.getElementById("AddForm");
        $('#nav-pills-tab-2').on('click','#AddBtn',function() {
            
           
            var firstname  = $('#firstname').val()
            var middlename = $('#middlename').val()
            var lastname   = $('#lastname').val()
            var businessname = $('#businessname').val()
            var location   = $("#location_id").children(":selected").attr("id")
            var businessnature = $('#nature_id').children(":selected").attr("id")
            var businessaddress = $('#businessaddress').val()
            var businessnumber = $('#businessnumber').val()
            var businessdate = $('#businessdate').val()


            if ( firstname == "" )
            {
                ErrorAlert();
                $('#lblfirstname').html('Required field!').css('color', 'red');
            }
            else
            if ( middlename == "" )
            {
                ErrorAlert();
                $('#lblmiddlename').html('Required field!').css('color', 'red'); 
            }
            else
            if ( lastname == "" )
            {
                ErrorAlert();
                $('#lbllastname').html('Required field!').css('color', 'red'); 
            }
            else
            if ( location == "" )
            {
                ErrorAlert();
                $('#lblbusinessloc').html('Required field!').css('color', 'red'); 
            }
            else
            if ( businessname == "" )
            {
                ErrorAlert();
                $('#lblbusinessname').html('Required field!').css('color', 'red'); 
            }
            else
            if ( businessnature == "" )
            {
                ErrorAlert();
                $('#lblbusinessnature').html('Required field!').css('color', 'red'); 
            }
            else
            if ( businessaddress == "" )
            {
                ErrorAlert();
                $('#lblbusinessadd').html('Required field!').css('color', 'red'); 
            }
            else
            if ( businessnumber == "" )
            {
                ErrorAlert();
                $('#lblbusinessnum').html('Required field!').css('color', 'red'); 
            }
            else
            {
                SuccessAlert();
                var fd = new FormData();
                fd.append('firstname',firstname);
                fd.append('middlename',middlename);
                fd.append('lastname',lastname);
                fd.append('businessname',businessname);
                fd.append('location',location);
                fd.append('businessnature',businessnature);
                fd.append('businessaddress',businessaddress);
                fd.append('businessnumber',businessnumber);
                fd.append('businessdate',businessdate);
                fd.append('_token',"{{csrf_token()}}");

                 $.ajax({
                    url:"{{route('BusinessesAdd')}}",
                    type:'post',
                    processData:false,
                    contentType:false,
                    cache:false,
                    data:fd,
                    success:function()
                    {
                        
                        setTimeout(loadTbl,500);          
                    }   
                })
            }

            function SuccessAlert() {
                 swal({
                    title: 'Success!',
                    text: 'Category successfully added.',
                    icon: 'success',

                })
            }

            
            function ErrorAlert() {

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

            function loadTbl() {
                $('#LoadTable').load("Businesses")
            }
        });

        $(document).ready(function() {
            $('#AddPersonal').on('click', function() {
                var resident_id = $('#residentid').val();
                var issuance_type = $('#personaliname').children(":selected").attr("id");
                var issuance_purpose = $('#personalpurpose').val();

                var date = $('#personalapplied').val();
                
                var fd = new FormData();
                fd.append('residentid',resident_id);
                fd.append('personaliname',issuance_type);
                fd.append('personalpurpose',issuance_purpose);
                fd.append('personalapplied',date);
                
                fd.append('_token',"{{csrf_token()}}");

                $.ajax({

                        url:"{{route('IssuanceAdd')}}",
                        type:'post',
                        processData:false,
                        contentType:false,
                        cache:false,
                        data:fd,
                        success:function()
                        {
                            //location.reload();   
                        }   
                    })

            });


        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#AddBusiness').on('click', function(){
                

                var resident_id = $('#residentid').val();
                var fname = $('#businessF').val();
                var mname = $('#businessM').val();
                var lname = $('#businessL').val();
                var bname = $('#businessName').val();
                var issuance_type = $('#businessType').children(":selected").attr("id");
                var bnature = $('#businessN').children(":selected").attr("id");
                var blocation = $('#businessLoc').children(":selected").attr("id");
                var address = $('#businessAdd').val();
                var bnumber = $('#businessOR').val();
                var acquire = $('#businessDate').val();


                
                var fd = new FormData();
                fd.append('residentid',resident_id);
                fd.append('businessname',bname);
                fd.append('businessnature',bnature);
                fd.append('location',blocation);
                fd.append('firstname',fname);
                fd.append('middlename',mnameissue                fd.append('lastname',lname);
                fd.append('businessaddress',address);
                fd.append('businessnumber',bnumber);
                fd.append('businessdate',acquire);
                fd.append('issuance_type',issuance_type);
                fd.append('_token',"{{csrf_token()}}");

                $.ajax({

                        url:"{{route('IssuanceAddBusiness')}}",
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
            });
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
            <li class="breadcrumb-item active">Issuance</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Issuance<small> Configurations required by the system.</small></h1>
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

                                       {{--@section('table')
                                        @if(Request::ajax())
                                            @section('table-js') @show
                                             @section('page-init-table') @show
                                              @section('page-functions') @show
                                        @endif--}}

                                         <!-- end row -->
                                        <div id="LoadTable">
                                            <table id="data-table-default" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th hidden>Category ID</th>
                                                        
                                                        <th >No.</th>
                                                        <th >Resident Name</th>
                                                        
                                                        <th >Actions</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="table-body">

                                                    @foreach($residents as $value)
                                                    <tr >
                                                        <td hidden>{{ $value->resident_id }}</td>
                                                       
                                                        <td >{{ $i++ }}</td>
                                                        
                                                        <td >{{ $value->resident_name }}</td>
                                                        
                                                        <td >
                                                             <button type='button' class='btn btn-lime issueModal' data-toggle='modal' data-target='#IssueModal' >
                                                                <i class='fas fa-address-card'></i> Issue
                                                            </button>
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                   {{-- @endsection
                                    @yield('table')--}}

                                    
                                    

                             <!-- #modal-business -->
                                <div class="modal fade" id="BusinessModal">
                                    <div class="modal-dialog" style="max-width: 50%">
                                        <form id="EditForm">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #white">
                                                    <h4 class="modal-title" style="color: black">Add Business Information</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    {{--modal body start--}}
                                                    <label class="form-label hide">Category ID</label>
                                                    <input id="EditCatID" type="text" class="form-control hide" name="CategoryID"/>
                                                    <div class="row">
                                                <div class="col-lg-12">
                                                    <label style="display: block; text-align: left">Resident Name</label>
                                                        <input type="hidden" id="businessrid" name="businessrid">
                                                        <input type="text" id="businessrname" name="businessrname" style="display: block; text-align: left; color:black; background-color:white" class="form-control" readonly>
                                                </div> 
                                                </div><br>
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="stats-content">
                                                                    <label for="bfirstname">Business Owner *</label> <span id="lblfirstname"></span>
                                                                    <input class="form-control" id="businessF" name="businessF" placeholder="Firstname" data-parsley-required="true" />
                                                            
                                                                </div>
                                                            </div>
                                                           <div class="col-lg-4 col-md-6">
                                                                <div class="stats-content">
                                                                    <label for="middlename">&nbsp</label><span id="lblmiddlename"></span>
                                                            
                                                                    <input class="form-control" id="businessM" name="businessM" placeholder="Lastname" data-parsley-required="true" />
                                                            
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="stats-content">
                                                                    <label for="lastname">&nbsp</label><span id="lbllastname"></span>
                                                            
                                                                    <input class="form-control" id="businessL" name="businessL" placeholder="Lastname" data-parsley-required="true" />
                                                            
                                                                </div>
                                                            </div>
                                                                            
                                                    </div> <br>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label style="display: block; text-align: left">Business Name</label>
                                                            <input type="text" id="businessName" name="businessName" style="display: block; text-align: left; color:black; background-color:white" class="form-control">
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                         <div class="col-lg-4">
                                                            <label for="BusinessType">Issue Type * :</label> <span id="lblbusinessnature"></span>
                                                            <select id="businessType" class="form-control" name="businessType" data-style="select-with-transition">
                                                            @foreach($issuancebname as $key => $naturename)
                                                                <option id ="{{ $key }}">{{ $naturename }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div><br>
                                                        <div class="col-lg-4">
                                                             <label for="BusinessNature">Business Nature * :</label> <span id="lblbusinessnature"></span>
                                                            <select id="businessN" class="form-control" name="businessN" data-style="select-with-transition">
                                                            @foreach($nature as $key => $naturename)
                                                                <option id ="{{ $key }}">{{ $naturename }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div><br>
                                                        <div class="col-lg-4">
                                                            <label for="Location">Location * :</label> <span id="lblbusinessloc"></span>
                                                            <select id="businessLoc" class="form-control" name="businessLoc" data-style="select-with-transition">
                                                            @foreach($location as $key => $locations)
                                                                <option id ="{{ $key }}">{{ $locations }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label style="display: block; text-align: left">Business Address</label>
                                                            <textarea type="textarea" id="businessAdd" name="businessAdd" style="display: block; text-align: left; color:black; background-color:white" class="form-control" ></textarea>
                                                        </div>
                                                    </div><br>
                                                        
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <label style="display: block; text-align: left">Business OR Number</label>
                                                            <input type="text" id="businessOR" name="businessOR" style="display: block; text-align: left; color:black; background-color:white" class="form-control" >
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label style="display: block; text-align: left">Business OR Acquired Date</label>
                                                           
                                                            <div class="input-group date" id="datepicker-autoClose" data-date-format="yyyy-mm-dd" data-date-start-date="Date.default">
                                                            <input id="businessDate" name="businessDate" type="text" class="form-control" placeholder="Select Date" />
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                            
                                                        </div>
                                                    </div><br>
                                                       
                                                    {{--modal body end--}}
                                                </div>
                                                <br>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                                    <a id="AddBusiness" href="javascript:;" class="btn btn-success">Add</a>
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
                                                    <h4 class="modal-title" style="color: white">View Record</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    {{--modal body start--}}
                                                        {{--<h2 id="ViewBarangayName" align="center"></h2>--}}
                                                        <div class="col-lg-12">
                                                            <label style="display: block; text-align: left">Business Owner</label>
                                                            <input type="text" id="ViewBusinessOwner" name="ViewBusinessOwner" style="display: block; text-align: left; color:black; background-color:white" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label style="display: block; text-align: left">Business Nature</label>
                                                            <input type="text" id="ViewBusinessNature" name="ViewBusinessNature" style="display: block; text-align: left; color:black; background-color:white" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label style="display: block; text-align: left">Business Name</label>
                                                            <input type="text" id="ViewBusinessName" name="ViewBusinessName" style="display: block; text-align: left; color:black; background-color:white" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label style="display: block; text-align: left">Business Location</label>
                                                            <input type="text" id="ViewBusinessLoc" name="ViewBusinessLoc" style="display: block; text-align: left; color:black; background-color:white" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label style="display: block; text-align: left">Business Address</label>
                                                            <input type="text" id="ViewBusinessAdd" name="ViewBusinessAdd" style="display: block; text-align: left; color:black; background-color:white" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label style="display: block; text-align: left">Business OR Number</label>
                                                            <input type="text" id="ViewBusinessNum" name="ViewBusinessNum" style="display: block; text-align: left; color:black; background-color:white" class="form-control" readonly>
                                                        </div>
                                                         <div class="col-lg-12">
                                                            <label style="display: block; text-align: left">Business OR Acquired Date</label>
                                                            <input type="text" id="ViewBusinessDate" name="ViewBusinessDate" style="display: block; text-align: left; color:black; background-color:white" class="form-control" readonly>
                                                        </div>
                                                    {{--modal body end--}}
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 <!-- #modal-view-end -->

                                  <!-- #modal-issue -->
                                    <div class="modal fade" id="IssueModal">
                                        <div class="modal-dialog" style="max-width: 30%">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #6C9738">
                                                    <h4 class="modal-title" style="color: white">Choose Issuance</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    {{--modal body start--}}
                                                <div class="row">
                                                <div class="col-lg-12">
                                                        <input type="hidden" id="residentname" name="residentname">
                                                        <input type="hidden" id="residentid" name="residentid">
                                                        
                                                </div>  
                                                </div><br>
                                                <div class="col-lg-12">
                                                    <a class='btn btn-default form-control cPersonal' data-toggle='modal' data-dismiss="modal"  data-target='#PersonalModal' >
                                                        <i class='fas fa-user-md'></i>&nbsp&nbsp&nbspPersonal?&nbsp&nbsp
                                                    </a>
                                                </div><br>
                                                 <div class="col-lg-12">
                                                    <button type='button' class='btn btn-default form-control cBusiness' data-toggle='modal' data-dismiss="modal" data-target='#BusinessModal'>
                                                        <i class='fas fa-building'></i>&nbsp&nbsp&nbspBusiness?&nbsp&nbsp
                                                    </button>
                                                </div>
                                                    {{--modal body end--}}
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                 <!-- #modal-view-end -->

                                  <!-- #modal-personal -->
                                    <div class="modal fade" id="PersonalModal">
                                        <div class="modal-dialog" style="max-width: 30%">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #black">
                                                    <h4 class="modal-title" style="color: black">For personal</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    {{--modal body start--}}
                                                <div class="row">
                                                <div class="col-lg-12">
                                                    <label style="display: block; text-align: left">Resident Name</label>
                                                        <input type="hidden" id="personalid" name="personalid">
                                                        <input type="text" id="personalrname" name="personalrname" style="display: block; text-align: left; color:black; background-color:white" class="form-control" readonly>
                                                </div> 
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label style="display: block; text-align: left">Personal Issuances</label>
                                                            <select id="personaliname" class="form-control" name="personaliname" data-style="select-with-transition">
                                                                @foreach($issuancename as $key => $issuances)
                                                                    <option id ="{{ $key }}">{{ $issuances }}</option>
                                                                @endforeach
                                                                </select>
                                                    </div>
                                                    </div><br>
                                                <div class="row">
                                                <div class="col-lg-12">
                                                    <label style="display: block; text-align: left">Issuance Purpose</label>
                                                        <textarea type="text" id="personalpurpose" name="personalpurpose" style="display: block; text-align: left; color:black; background-color:white" class="form-control"></textarea>
                                                </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                    <label style="display: block; text-align: left">Applied Date</label>
                                                        <div class="input-group date" id="datepicker-new" data-date-format="yyyy-mm-dd" data-date-start-date="Date.default">
                                                        <input id="personalapplied" name="personalapplied" type="text" class="form-control" placeholder="Select Date" />
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                    {{--modal body end--}}
                                               </div><br>
                                               <div class="modal-footer ">
                                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                                    <a id="AddPersonal" href="javascript:;" class="btn btn-success">Add</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 <!-- #modal-view-end -->

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
         <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                        </div>
                        <h4 class="panel-title">List of Personal Issuances</h4>
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
                               

                                <div class="tab-content">
                                    <!-- begin tab-pane -->
                                 

                                       {{--@section('table')
                                        @if(Request::ajax())
                                            @section('table-js') @show
                                             @section('page-init-table') @show
                                              @section('page-functions') @show
                                        @endif--}}

                                         <!-- end row -->
                                        <div id="personal-table">
                                            <table id="list-of-personal" class="table table-striped table-bordered ">
                                                <thead>
                                                    <tr>
                                                        <th hidden>Category ID</th>
                                                        
                                                        <th >No.</th>
                                                        <th >Resident Name</th>
                                                       
                                                        <th >Issuance Name</th>
                                                        <th >Issuance Purpose</th>
                                                        <th >Issuance Date</th>
                                                        <th >Issuance Status</th>
                                                        <th >Issuance Remarks</th>
                                                        <th >Actions</th>
                                                    </tr>
                                                </thead>

                                                <tbody >

                                                    @foreach($personalissuances as $pissuance)
                                                    <tr>
                                                        <td hidden>{{$pissuance->issuance_id}}</td>
                                                       
                                                        <td >{{$i++}}</td>
                                                        <td >{{$pissuance->resident_name}}</td>
                                                        <td >{{$pissuance->issuance_name}}</td>
                                                        <td >{{$pissuance->issuance_purpose}}</td>
                                                        <td >{{$pissuance->issuance_date}}</td>
                                                        <td >{{$pissuance->status}}</td>
                                                        <td >{{$pissuance->remarks}}</td>
                                                        <td >
                                                             <button type='button' class='btn btn-lime form-control' data-toggle='modal' data-target='#AddModal' >
                                                                <i class='fa fa-check'></i> Approve
                                                            </button>
                                                          
                                                            <button type='button' class='btn btn-success editCategory form-control' data-toggle='modal' data-target='#UpdateModal'>
                                                                <i class='fa fa-edit'></i>&nbsp&nbsp&nbspEdit&nbsp&nbsp
                                                            </button>
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>       
      



 <div>
         <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                        </div>
                        <h4 class="panel-title">List of Busineses Issuances</h4>
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
                               

                                <div class="tab-content">
                                    <!-- begin tab-pane -->
                                 

                                       @section('table')
                                        @if(Request::ajax())
                                            @section('table-js') @show
                                             @section('page-init-table') @show
                                              @section('page-functions') @show
                                        @endif

                                        <div id="LoadTable">
                                            <table id="data-table-default" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th hidden>Category ID</th>
                                                        <th hidden>firstname</th>
                                                        <th hidden>middlename</th>
                                                        <th hidden>lastname</th>
                                                        <th >No.</th>
                                                        <th >Business Owner</th>
                                                        <th >Business Nature</th>
                                                        <th >Business Location</th>
                                                        <th >Business Name</th>
                                                        <th >Business Address</th>
                                                        <th >Business OR. Number</th>
                                                        <th >Business OR. Acquired Date</th>
                                                        <th >Actions</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                 @foreach($records as $record)
                                                    <tr >
                                                        <td hidden>{{ $record->business_id }} </td>
                                                        <td hidden>{{ $record->owner_firstname }}</td>
                                                        <td hidden>{{ $record->owner_middlename }} </td>
                                                        <td hidden>{{ $record->owner_lastname }}</td>
                                                        <td >{{ $i++ }}</td>
                                                        <td >{{ $record->owner_firstname }} {{ $record->owner_middlename }} {{ $record->owner_lastname }}</td>
                                                        <td >{{ $record->businees_nature_name }}</td>
                                                        <td >{{ $record->barangay_zone_name }}</td>
                                                        <td >{{ $record->business_name }}</td>
                                                        <td >{{ $record->business_address }}</td>
                                                        <td >{{ $record->business_or_number }}</td>
                                                        <td >{{ $record->business_or_acquired_date }}</td>
                                                        <td >
                                                            <button type='button' class='btn btn-warning viewCategory'data-toggle='modal' data-target='#ViewModal' >
                                                                <i class='fa fa-eye'></i> View
                                                            </button>

                                                            <button type='button' class='btn btn-success editCategory' data-toggle='modal' data-target='#UpdateModal'>
                                                                <i class='fa fa-edit'></i> Edit&nbsp
                                                            </button>
                                                        </td>

                                                    </tr>
                                                   @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endsection
                                    @yield('table')

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>       



@endsection