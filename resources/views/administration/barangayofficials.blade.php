@extends('global.main')

@if(session('session_position')!='Admin')
<script type="text/javascript">location.href = '{{route("Dashboard")}}'</script>
@else

@endif

@section('title', "Barangay Officials")

@section('page-css')

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-timepicker/jquery.timepicker.min.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->

@endsection

@section('page-js')

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>

    <script src="{{asset('assets/plugins/bootstrap-daterangepicker/moment.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    {{--Modals--}}
    <script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-timepicker/jquery.timepicker.min.js') }}" ></script>
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script>
        $(document).ready(function() {
            App.init();
            TableManageDefault.init();
            Notification.init();

            $("#aStartTermTxt").datetimepicker({format: 'YYYY-mm-DD'}).on('dp.change',function(selectedDate)
            {

                StartTerm= new Date(selectedDate.date);

                StartTermMonth=StartTerm.getMonth()+1;
                FormattedStartTerm=StartTerm.getFullYear()+'-'+StartTermMonth+'-'+StartTerm.getDate();
                FormattedEndTerm=StartTerm.getFullYear()+3+'-'+StartTermMonth+'-'+StartTerm.getDate();
                            // $("#EndTermTxt").val(StartTerm.getFullYear()+3+'-'+StartTerm.getMonth()+2+'-'+StartTerm.getDate());
                            $("#aEndTermMaskTxt").datetimepicker({format: 'YYYY-mm-DD'});
                            $("#aStartTermTxt").val(FormattedStartTerm);

                            $("#aEndTermMaskTxt").val(FormattedEndTerm);

                            $("#aEndTermTxt").val(FormattedEndTerm);

            })

            $("#updateStartTerm").datetimepicker({format: 'YYYY-mm-DD'}).on('dp.change',function(selectedDate)
            {

                StartTerm= new Date(selectedDate.date);

                StartTermMonth=StartTerm.getMonth()+1;
                FormattedStartTerm=StartTerm.getFullYear()+'-'+StartTermMonth+'-'+StartTerm.getDate();
                FormattedEndTerm=StartTerm.getFullYear()+3+'-'+StartTermMonth+'-'+StartTerm.getDate();
                            // $("#EndTermTxt").val(StartTerm.getFullYear()+3+'-'+StartTerm.getMonth()+2+'-'+StartTerm.getDate());
                            $("#updateEndTerm").datetimepicker({format: 'YYYY-mm-DD'});
                            $("#updateStartTerm").val(FormattedStartTerm);
                            $("#updateEndTerm").val(FormattedEndTerm);

            })

            $('#data-table-default1').DataTable();
            
           
        });

    </script>

    {{--For Edit button--}}
    <script>
        var Editform = document.getElementById("EditForm");

        $("a[id='EditBTN']").on('click',function () {
            var incidentDate = $('#EditIncidentDate').val()
            var incidentArea = $('#EditIncidentArea').val()
            var complainantName = $('#EditComplainantName').val()
            var accusedResident = $('#EditAccusedResident').children(":selected").attr("id")
            var blotterSubject = $('#EditBlotterSubject').children(":selected").attr("id")
            var complainStatement = $('#EditComplainStatement').val()
            var blotterID = $('#EditBlotterID').val()

            var fd = new FormData();
            fd.append('EditIncidentDate', incidentDate);
            fd.append('EditIncidentArea', incidentArea);
            fd.append('EditComplainantName', complainantName);
            fd.append('EditAccusedResident', accusedResident);
            fd.append('EditBlotterSubject', blotterSubject);
            fd.append('EditComplainStatement', complainStatement);
            fd.append('EditBlotterID', blotterID);
            fd.append('_token',"{{csrf_token()}}");


            if(incidentDate == "" || incidentArea == "" || complainantName == "" || blotterSubject == "" || complainStatement == ""){
                $('#reqIncidentDateEdit').html('Required field!').css('color', 'red');
                $('#reqIncidentAreaEdit').html('Required field!').css('color', 'red');
                $('#reqComplainantNameEdit').html('Required field!').css('color', 'red');
                $('#reqBlotterSubjectEdit').html('Required field!').css('color', 'red');
                $('#reqComplainStatementEdit').html('Required field!').css('color', 'red');
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
                    .then((willResolve) => {
                        if (willResolve) {
                            swal("Data have been successfully updated!", {
                                icon: "success",

                            });

                            $.ajax({
                                    url:'UpdateBlotter',
                                    type:'POST',
                                    processData:false,
                                    contentType:false,
                                    cache:false,
                                    data:fd,
                                    success:function()
                                    {
                                       // location.reload();
                                    }

                                })  
                        } 
                        else {
                           swal("Operation Cancelled.", {
                               icon: "error",
                           });
                       }
                    });

            }

        });
    </script>

    
    {{--For ADD FORM--}}
    <script>


        $(document).on('click','.search_btn',function() {
        
        $('.list-of-residents').remove();
        var searchval = $('#stext').val();
        var faddress = "";
        var profilepic = "";
        $.ajax({
            url: "{{route('ResidentsSearch')}}",
            type: "post",
            dataType:'json',
            data: { searchval: searchval, _token: "{{csrf_token()}}" },
            async:false,
            success:function(data)
            {

               
                if(data.length > 0) {
                    data.map( value => {
                        value['listofresidents'].map( residents => {
                            fullname = residents['FULLNAME'];
                            profilepic = residents['PROFILE_PICTURE'];
                            image = 'background-image:url("{{asset("upload/residentspics/")}}/'+profilepic+'")';
                            resident_id = residents['RESIDENT_ID'];
                            residents['FULL_ADDRESS'] == null ? faddress = "" : faddress = residents['FULL_ADDRESS']
                           $('.result-list').append(
                            '<li class="list-of-residents">\n'

                            +'<a href="#" class="result-image"></a>\n'

                            +'<div class="result-info">\n'
                +'<h4 class="title" hidden>'+residents['RESIDENT_ID']+'</h4>\n'
                                +'<h4 class="title"><a href="javascript:;">'+residents['FULLNAME']+'</a></h4>\n'
                                +'<p class="location" style="font-size: 20px; color: black;">Birth details: <h>'+residents['PLACE_OF_BIRTH']+', '+residents['DATE_OF_BIRTH']+'</h></p>\n'
                                +'<p class="desc" style="font-size: 20pxpx">'+faddress+'</p>\n'
                                 +'<button data-toggle="modal" data-target="#show_assigning" class="btn btn-yellow btn-block" id="ab_btn">Assign as Barangay Official</button>\n'
                            +'</div>\n'

                            // +'<div class="result-price" >Resident\n'
                           
                            // +'</div>\n'
                            +'</li>'
                            );

                       })
                    });
                }
                
                
                
            }
            ,
            error:function(error)
            {
                console.log(error)
            }

        });
        
        $('.result-image').attr('style',image);

    });

    $(document).on('click','#ab_btn',function() {
    var resident = $(this).closest("li div").find("h4").html();
    var name = $(this).closest("li div").find("a").html();
        $('#afullname').text(name);
        $('#residentID').val(resident);


    });

        
    </script>

   

    
    <script type="text/javascript">
        //START FOR EDIT MODAL
        $("#data-table-default").on('click','.editOfficial',function()
        {
            var brngyPosition = $(this).closest("tbody tr").find("td:eq(1)").html();

            $("#officialID").val($(this).closest("tbody tr").find("td:eq(0)").html());
            $("#updateOfficialName").text($(this).closest("tbody tr").find("td:eq(2)").html());
            $("#updatePosition").val(brngyPosition).change();
            $("#updateEmail").val($(this).closest("tbody tr").find("td:eq(6)").html());
            $("#updateStartTerm").val($(this).closest("tbody tr").find("td:eq(3)").html());
            $("#updateEndTerm").val($(this).closest("tbody tr").find("td:eq(4)").html());
            $("#updateEmployeeNo").val($(this).closest("tbody tr").find("td:eq(5)").html());
        });
        //END FOR EDIT MODAL

        //START ASSIGNING OF BARANGAY OFFICIAL
        $("#assignbtn").on('click',function () {

        var residentID = $('#residentID').val();
    alert(residentID)
        var position = $('#aBarangayPositionTxt').children(":selected").attr("id");
        var email  = $('#aEmailTxt').val();
        var startTerm = $('#aStartTermTxt').val();
        var endTerm = $('#aEndTermMaskTxt').val();
        var employeeNo = $('#aEmpNum').val();

        // alert(residentID+'| '+position+'| '+email+'| '+startTerm+'| '+endTerm+'| '+employeeNo)

        if( position == "undefined" || email == "" || startTerm == "" || endTerm == "" || employeeNo == "")
        {
            $('#ReqBarangayPosTxt').html('Required field!').css('color', 'red');
            $('#aReqEmail').html('Required field!').css('color', 'red');
            $('#aReqStartTermTxt').html('Required field!').css('color', 'red');
            $('#aLblEmpNum').html('Required field!').css('color', 'red');

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
                text: "Are you sure you want to assign "+ $('#afullname').text() +" as "+ $("#aBarangayPositionTxt").find(':selected').text() + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                var fd = new FormData();
                fd.append('residentID',residentID);
                fd.append('position',position);
                fd.append('email',email);
                fd.append('startTerm',startTerm);
                fd.append('endTerm',endTerm);
                fd.append('employeeNo',employeeNo);
                
                fd.append('_token', "{{ csrf_token() }}");
                if (willDelete) {
                    swal("Assigning successfully!", {
                        icon: "success",

                    });
                    setTimeout(function(){
                       $.ajax({
                            url: "{{route('AddBarangayOfficial')}}",
                            type:'POST',
                            processData:false,
                            contentType:false,
                            cache:false,
                            data: fd,
                            success:function(data)
                            {
                                // location.reload();
                            } ,
                            error: function(error)
                            {
                                console.error(error);
                            }  
                        })
                   });
                } 
                else 
                {
                    swal("Operation Cancelled.", {
                        icon: "error",
                    });
                }
            });
            


        
        }
    
    $(document).on('click','#close_modal',function() {
            
            // location.reload();
        }); 
});

        //END ASSIGNING OF BARANGAY OFFICIAL


        //REMOVE BTN
        $(".remove-btn").click(function()
            {
                
                var blotterID = $(this).closest("tr").find("td").first().text();
                alert(blotterID)
                swal({
                    title: "Wait!",
                    text: "Are you sure you want to remove blotter code"+$(this).closest("tbody tr").find("td:eq(1)").html()+" ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willResolve) => {
                        if (willResolve) {
                            swal("Data have been successfully removed!", {
                                icon: "success",

                            });

                            $.ajax({
                                    url:'RemoveBarangayOfficial',
                                    type:'POST',                                    
                                    data:{blotter_id : blotterID,
                                        _token       : '{{csrf_token()}}'
                                    },
                                    success:function()
                                    {
                                       // location.reload();
                                    }

                                })  
                        } 
                        else {
                           swal("Operation Cancelled.", {
                               icon: "error",
                           });
                       }
                    });
            });
    </script>


@endsection



@section('content')

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item active">Barangay Officials </li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Barangay Officials <small> Records of barangay officials of the barangay.</small></h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div >

            <!-- begin col-10 -->
            <div>

                <!-- begin input-group -->
                <div class="input-group input-group-lg m-b-20">
                    <input type="text" class="form-control input-white" placeholder="Search Resident/Inhabitant" id="stext"/>
                    <div class="input-group-append">
                        <button class="btn btn-primary search_btn"><i class="fa fa-search fa-fw"></i> Search</button>

                        
                    </div>
                </div>
                <!-- end input-group -->
                <!-- start result list -->
                

                <br>
                <div class="clear_search">
                    <ul class="result-list">


                    </ul>

                </div>

                <!-- end result-list -->
                <br><br>
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                        </div>
                        <h4 class="panel-title">Barangay Officials</h4>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin alert -->
                    <div class="alert alert-yellow fade show">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Barangay Officials displays all the officials of the barangay.
                    </div>
                    <!-- end alert -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <!-- <button type='button' class='btn btn-lime' data-toggle='modal' data-target='#AddModal' >
                            <i class='fa fa-plus'></i> Add New
                        </button> -->

                        <br>
                        <br>
                        <table id="data-table-default" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th hidden>Official ID </th>
                                <th style="width: 20%">Position</th>
                                <th style="width: 25%">Name</th>
                                <th>Start Term </th>
                                <th>End Term</th>
                                <th>Emlpoyee Number</th>
                                <th hidden>Email</th>
                                <th style="width: 142px">Actions </th>
                            </tr>
                            </thead>

                            <tbody>
                        @foreach( $dispOfficials as $officials )
                            <tr >
                                <td hidden>{{$officials->barangay_official_id}}</td>
                                <td>{{$officials->position_name}}</td>
                                <td>{{$officials->firstname}} {{$officials->lastname}}</td>
                                <td>{{$officials->start_term}}</td>
                                <td>{{$officials->end_term}}</td>
                                <td>{{$officials->employee_number}}</td>
                                <td hidden>{{$officials->email}}</td>
                                <td>
                                    <button type='button' class='btn btn-success editOfficial' data-toggle='modal' data-target='#EditModal' >
                                        <i class='fa fa-edit'></i> Edit
                                    </button>

                                    <button type='button' class='btn btn-danger remove-btn' >
                                        <i class='fa fa-trash'></i> Remove
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                            </tbody>
                        </table>
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

    {{-- Assigning Modal --}}
    <div class="modal fade" id="show_assigning" data-backdrop="static">
        <div class="modal-dialog" style="max-width: 50%">

            <div class="modal-content">
                <div class="modal-header" style="background-color: #ffd900">
                    <h4 class="modal-title" style="color: black">ASSIGN BARANGAY OFFICIAL</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button> -->
                </div>
                <div class="modal-body">
                    <form >
                        {{ csrf_field() }}
                        <h4><label style="display: block; text-align: center">Name</label></h4>
                        <h3><b><label style="text-transform: capitalize; display: block; text-align: center;" id="afullname"></label></b></h3>
                        <br>
                        <div class="row ">
                            <div class="col-md-6">
                                <input type="text" id="residentID" name="residentID" hidden>
                                <div class="form-group">
                                    <label>Barangay Position</label> <span id='ReqBarangayPosTxt'></span>
                                    <select class="form-control form-control-lg"  name="aBarangayPositionTxt" id="aBarangayPositionTxt" placeholder="####"  required="true"  data-style="btn-lime" id="BarangayName">
                                        <option value="null"><--Select Position--></option>
                                            @foreach ($DisplayBarangayPosition as $value)

                                            <option id="{{$value->POSITION_ID}}">{{ $value->POSITION_NAME }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label>Email</label> <span id='aReqEmail'></span>
                                        <input type="email" name="aEmailTxt" id="aEmailTxt" placeholder="E.G.:example@gmail.com" class="form-control form-control-lg" data-parsley-type="email" data-parsley-required="true" />
                                    </div>
                                </div>

                            </div>

                            <div class="row ">
                                <div class="col-md-6">
                                   <div class="form-group " >
                                       <label >Start Term</label>
                                       <span id='aReqStartTermTxt'></span>

                                       <div class="input-group date" id="datetimepicker">
                                        <input type="text" class="form-control form-control-lg" id="aStartTermTxt" name="aStartTermTxt" />
                                        <div class="input-group-addon" id="aStartTermIcon" >

                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label >End Term</label>
                                    <div class="input-group date" id="datetimepicker">
                                        <input type="text" class="form-control form-control-lg" id="aEndTermMaskTxt" name="aEndTermMaskTxt" readonly />
                                        <div class="input-group-addon" id="aEndTermIcon" >
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                    <div class="form-group">
                                        <label>Employee Number</label> <span id='aLblEmpNum'></span>
                                        <input type="text" name="aEmpNum" id="aEmpNum" class="form-control form-control-lg"/>
                                    </div>
                                </div>
                        </div>

                        <div class="modal-footer" align="center">
                           <a href="javascript:;" class="btn btn-yellow" style="color: black" id="assignbtn" name="assignbtn">Assign</a>
                           <a href="javascript:;" class="btn btn-white aclose_modal" data-dismiss="modal" >Close</a>

                       </div>
                   </form>
               </div>

           </div>
       </div>
       <!-- end tab-pane -->
    </div>
    <!-- end -->

    {{-- Edit Modal --}}
    <div class="modal fade" id="EditModal" data-backdrop="static">
        <div class="modal-dialog" style="max-width: 50%">

            <div class="modal-content">
                <div class="modal-header" style="background-color: #248f8f">
                    <h4 class="modal-title" style="color: white">UPDATE BARANGAY OFFICIAL DETAILS</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button> -->
                </div>
                <div class="modal-body">
                    <form >
                        {{ csrf_field() }}
                        <h4><label style="display: block; text-align: center">Name</label></h4>
                        <h3><b><label style="text-transform: capitalize; display: block; text-align: center;" id="updateOfficialName"></label></b></h3>
                        <br>
                        <div class="row ">
                            <div class="col-md-6">
                                <input type="text" id="officialID" name="officialID" hidden>
                                <div class="form-group">
                                    <label>Barangay Position</label> <span id='reqBrngyPosition'></span>
                                    <select class="form-control form-control-lg"  name="updatePosition" id="updatePosition" required="true"  data-style="btn-lime" id="BarangayName">
                                        <option value="null"><--Select Position--></option>
                                            @foreach ($DisplayBarangayPosition as $value)
                                            <option id="{{$value->POSITION_ID}}">{{ $value->POSITION_NAME }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label>Email</label> <span id='reqEmail'></span>
                                        <input type="email" name="updateEmail" id="updateEmail" placeholder="E.G.:example@gmail.com" class="form-control form-control-lg" data-parsley-type="email" data-parsley-required="true" />
                                    </div>
                                </div>

                            </div>

                            <div class="row ">
                                <div class="col-md-6">
                                   <div class="form-group " >
                                       <label >Start Term</label>
                                       <span id='reqStartTerm'></span>
                                       <div class="input-group date" id="datetimepicker">
                                        <input type="text" class="form-control form-control-lg" id="updateStartTerm" name="updateStartTerm" />
                                        <div class="input-group-addon" id="updateStartTermIcon" >
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label >End Term</label>
                                    <span id='aReqEndTermTxt'></span>
                                    <div class="input-group date" id="datetimepicker">
                                        <input type="text" class="form-control form-control-lg" id="updateEndTerm" name="updateEndTerm" readonly />
                                        <div class="input-group-addon" id="updateEndTermIcon" >
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                    <div class="form-group">
                                        <label>Employee Number</label> <span id='reqEmployeeNo'></span>
                                        <input type="text" name="updateEmployeeNo" id="updateEmployeeNo" class="form-control form-control-lg"/>
                                    </div>
                                </div>
                        </div>

                        <div class="modal-footer" align="center">
                           <a href="javascript:;" class="btn btn-success" style="color: white" data-dismiss="modal" id="updatebtn" name="updatebtn">Assign</a>
                           <a href="javascript:;" class="btn btn-white aclose_modal" data-dismiss="modal" >Close</a>

                       </div>
                   </form>
               </div>

           </div>
       </div>
       <!-- end tab-pane -->
    </div>
    <!-- end -->
    



@endsection