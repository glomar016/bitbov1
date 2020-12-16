@extends('global.main')

@section('title', "Father's Profile")

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

     
   


  </script>
    <script type="text/javascript">
  
   

    </script>
    <script type="text/javascript">

        $('#data-table-default').on('click','.edit-father-btn', function () {
            


            var lastname = $(this).closest("tbody tr").find("td:eq(1)").html();
            var firstname = $(this).closest("tbody tr").find("td:eq(2)").html();
            var middlename = $(this).closest("tbody tr").find("td:eq(3)").html();
            var fullname = lastname + ", " + firstname + " " + middlename;
            
            $("#edit_db_name").text(fullname);


            $('#edit_father_id').val($(this).closest("tbody tr").find("td:eq(0)").html());
            $('#editmtongue').val($(this).closest("tbody tr").find("td:eq(5)").html());
            $('#editmdialect').val($(this).closest("tbody tr").find("td:eq(6)").html());
            $('#editmeducationatt').val($(this).closest("tbody tr").find("td:eq(7)").html());

         
        });

    </script>
    <script type="text/javascript">
        $('#edit-btn').click(function () {


            var father_id = $('#edit_father_id').val();
           
            var m_tongue = $('#editmtongue').val();
            var m_other_dialect = $('#editmdialect').val();
            var meduc_attain = $('#editmeducationatt').val();

            if ( m_tongue == "" )
            {   
                $('#reqeditmtongue').html('Required field!').css('color', 'red');
                AlertifNull();
            }
            else
            {
              var fd = new FormData();
              fd.append('father_id',father_id);
             
              fd.append('m_tongue',m_tongue);
              fd.append('other_dialect',m_other_dialect);
              fd.append('m_educattain',meduc_attain);
              fd.append('_token',"{{ csrf_token() }}");

              swal({
                    title: "Wait!",
                    text: "Are you sure you want to edit this?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
              })
              .then((willDelete) => {
                    if (willDelete) {
                         Update(fd);
                       
                    } else {
                        swal("Operation Cancelled.", {
                            icon: "error",
                        });
                    }
              });
              
            }
           

        });

        async function Update(fd) {
            swal("Data have been successfully Updated!", {
                  icon: "success",
                });

              let result;
              try
              {
                  result = await $.ajax({
                       url:"{{route('FathersProfileEdit')}}",
                       type:'post',
                       processData:false,
                       contentType:false,
                       cache:false,
                       data:fd,
                       success:function(data)
                       {
                          if (data == "good" )
                          {
                              location.reload();
                          } 
                       }   
                    })
              }
              catch(error)
              {
                console.error(error);
              }
        }

        function AlertifNull() {
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

    </script>
    
    <script type="text/javascript">

      $(document).ready(function() {
        $('#tag-btn').click(function() {

           
            var m_tongue = $('#mtongue').val();
            var other_dialect =  $('#mdialect').val();
            var m_educattain = $('#meducationatt').children(":selected").attr("value");
            var resident_id = $('#father_id').val();

            var fd = new FormData();
           
            if ( m_tongue == "" )
            {
                $('#reqmtongue').html('Required field!').css('color', 'red');
                AlertifNull();
            }
            else
            if ( other_dialect == "" )
            {
                $('#reqmdialect').html('Required field!').css('color', 'red');
                AlertifNull();
            }
            else
            if ( m_educattain == "" )
            {
                $('#reqmeducationatt').html('Required field!').css('color', 'red');
                AlertifNull();
            }
            else
            {
              fd.append('m_tongue',m_tongue);
              fd.append('other_dialect',other_dialect);
              fd.append('m_educattain',m_educattain);
              fd.append('resident_id',resident_id);
              fd.append('_token',"{{ csrf_token() }}");
              Add(fd);

            }
           
           
          
           

        });
      });

       async function Add(fd) {
       swal("Data have been successfully Added!", {
                  icon: "success",
                });

          let result;
          try
          {
              result = await $.ajax({
                   url:"{{route('FathersProfileAdd')}}",
                   type:'post',
                   processData:false,
                   contentType:false,
                   cache:false,
                   data:fd,
                   success:function(data)
                   {
                      if (data == "good" )
                      {
                          location.reload();
                      } 
                   }   
                })
          }
          catch(error)
          {
            console.error(error);
          }
    }  
    </script>

@endsection

@section('content')


   <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Father's Information</a></li>

        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Basic Information  <small>DILG Requirements</small></h1>
        <!-- end page-header -->

    <!-- begin nav-pills -->
        <ul class="nav nav-pills">
            <li class="nav-items">
                <a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active">

                    <span class="d-sm-block d-none">Records</span>
                </a>
            </li>
            {{--
            <li class="nav-items">
                <a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >

                    <span class="d-sm-block d-none">Add New</span>
                </a>
            </li>--}}
        </ul>
        <!-- end nav-pills -->
        <!-- begin tab-content -->
        <div class="tab-content">
            <!-- begin tab-pane -->
            <div class="tab-pane fade active show" id="nav-pills-tab-1">
                {{--Nav Pill Body Start--}}
                    <!-- begin panel add new -->
                    <div class="panel panel-inverse">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                            </div>
                            <h4 class="panel-title">Existing Records</h4>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin alert -->
                        <div class="alert alert-yellow fade show">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            The following are the existing records of father's within the system.
                        </div>
                        <!-- end alert -->
                        <!-- begin panel-body -->
                        <div class="panel-body">

                            <table id="data-table-default" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th hidden>Father ID </th>
                                    <th hidden>LastName</th>
                                    <th hidden>MiddleName</th>
                                    <th hidden>FirstName</th>
                                    <th >Full Name</th>
                                    <th>Mother Tongue</th>
                                    <th>Fathers's Other Dialect</th>
                                    <th>Educational Attainment</th>
                                    <th hidden>Status</th>
                                    <th style="width: 10%">Actions </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($FatherTable as $profile)                               
                                <tr >

                                    <td hidden>{{$profile->FATHERS_ID}}</td>
                                    <td hidden>{{$profile->LASTNAME}}</td>
                                    <td hidden>{{$profile->FIRSTNAME}}</td>
                                    <td hidden>{{$profile->MIDDLENAME}}</td>
                                    <td >{{$profile->LASTNAME}} {{$profile->FIRSTNAME}} {{$profile->MIDDLENAME}}</td>
                                    <td style="background-color: {{ $profile->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{$profile->FATHER_MOTHER_TONGUE}}</td>
                                    <td style="background-color: {{ $profile->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{$profile->FATHER_OTHER_DIALECTS}}</td>
                                    <td style="background-color: {{ $profile->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{$profile->FATHER_EDUCATIONAL_ATTAINMENT}}</td>
                                    @if ($profile->ACTIVE_FLAG == 1)
                                    <td hidden style="background-color: {{ $profile->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">Active</td>
                                    @else
                                    <td hidden style="background-color: {{ $profile->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">Inactive</td>
                                    @endif
                                    <td style="background-color: {{ $profile->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">
                                        <button type='button' class='btn btn-success edit-father-btn' data-toggle='modal' data-target='#UpdateMother'>
                                            <i class='fa fa-edit'></i> Edit&nbsp&nbsp
                                        </button>
                                    </td>

                                </tr>
                                
                                @endforeach
                                </tbody>
                            </table> 

                          </div>
                        <!-- end panel-body -->
                            
                    </div>
                    <!-- end panel add new -->
                {{--Nav Pill Body End--}}
            </div>
            <!-- end tab-pane -->
           
                    {{--Table--}}
                {{--Nav Pill Body End--}}

                 <!-- #modal-update-mother -->
                            <div class="modal fade" id="UpdateMother" data-backdrop="static">
                                <div class="modal-dialog" style="max-width: 30%">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #008a8a">
                                            <h4 class="modal-title" style="color: white">Edit Record</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                        </div>
                                        <div class="modal-body">
                                                <h><label style="display: block; text-align: center">Father's Name</label></h>
                                             <h3><b><label style="text-transform: capitalize; display: block; text-align: center" id="edit_db_name" name="edit_db_name"></label></b></h3>
                                             <br>
                                             <input id="edit_father_id" type="text" class="form-control hide" name="FatherName"/>

                                            
                                            <div class="col-lg-12">
                                                <label style="display: block; text-align: left">Mother Tongue</label> <span id='reqeditmtongue'></span>
                                                 <select class="form-control " data-style="btn-lime" id="editmtongue" name="editmtongue">
                                                             
                                                        <option value="Tagalog" selected>Tagalog</option>
                                                        <option value="Visayan">Visayan</option>
                                                        <option value="Iloco">Iloco</option>
                                                        <option value="Bicolnon">Bicolnon</option>
                                                            
                                                </select>
                                               
                                            </div>
                                            <br>
                                            <div class="col-lg-12">
                                                <label style="display: block; text-align: left">Other Dialect</label> <span id='reqeditmdialect'></span>
                                                <input type="text" id="editmdialect" name="editmdialect" style="display: block; text-align: left; color:black; background-color:white" class="form-control" >
                                            </div>
                                            <br>
                                            <div class="col-lg-12">
                                                <label style="display: block; text-align: left">Education Attainment</label>  <span id='reqeditmeducationatt'></span>
                                                <select class="form-control " data-style="btn-lime" id="editmeducationatt" name="editmeducationatt">
                                                             
                                                        <option value="Elementary School Graduate" selected>Elementary School Graduate</option>
                                                        <option value="High School Graduate">High School Graduate</option>
                                                        <option value="College Graduate">College Graduate</option>
                                                        <option value="Technical/Vocation Graduate">Technical/Vocation Graduate</option>
                                                        <option value="Masteral/Unit Degree">Masteral/Unit Degree</option>
                                                        <option value="Doctoral/Unit Degree">Doctoral/Unit Degree</option>

                                                </select>
                                            </div>
                                            <br>
                                                        
                                            {{--modal body end--}}
                                        </div>
                                        <div class="modal-footer" align="center">
                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                            <a href="javascript:;" class="btn btn-success"  id="edit-btn">Update</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="modal fade" id="UpdateModal" data-backdrop="static">
                                <div class="modal-dialog" style="max-width: 30%">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #008a8a">
                                            <h4 class="modal-title" style="color: white">Edit Record</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                        </div>
                                        <div class="modal-body">
                                           <h><label style="display: block; text-align: center">Resident's Name</label></h>
                                             <h3><b><label style="text-transform: capitalize; display: block; text-align: center;" id="view_db_name" name="view_db_name"></label></b></h3>
                                             <br>
                                             <input id="father_id" type="text" class="form-control hide" name="MotherName"/>

                                            <div class="col-lg-12">
                                                <label style="display: block; text-align: left">Mother Tongue</label> <span id='reqmtongue'></span>
                                                 <select class="form-control " data-style="btn-lime" id="mtongue" name="mtongue">
                                                             
                                                        <option value="Tagalog" selected>Tagalog</option>
                                                        <option value="Visayan">Visayan</option>
                                                        <option value="Iloco">Iloco</option>
                                                        <option value="Bicolnon">Bicolnon</option>
                                                            
                                                </select>
                                               
                                            </div>
                                            <br>
                                            <div class="col-lg-12">
                                                <label style="display: block; text-align: left">Other Dialect</label>  <span id='reqmdialect'></span>
                                                <input type="text" id="mdialect" name="mdialect" style="display: block; text-align: left; color:black; background-color:white" class="form-control" >
                                            </div>
                                            <br>
                                            <div class="col-lg-12">
                                                <label style="display: block; text-align: left">Education Attainment</label> <span id='reqmeducationatt'></span>
                                                <select class="form-control " data-style="btn-lime" id="meducationatt" name="edithomeownership">
                                                             
                                                        <option value="Elementary School Graduate" selected>Elementary School Graduate</option>
                                                        <option value="High School Graduate">High School Graduate</option>
                                                        <option value="College Graduate">College Graduate</option>
                                                        <option value="Technical/Vocation Graduate">Technical/Vocation Graduate</option>
                                                        <option value="Masteral/Unit Degree">Masteral/Unit Degree</option>
                                                        <option value="Doctoral/Unit Degree">Doctoral/Unit Degree</option>
                                                            
                                                </select>
                                            </div>
                                            <br>
                                                        
                                            {{--modal body end--}}
                                        </div>
                                        <div class="modal-footer" align="center">
                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                            <a href="javascript:;" class="btn btn-success"  id="tag-btn">Tag</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
            
            <!-- end tab-pane -->
              </div>
        <!-- end tab-content -->

        </div>

@endsection