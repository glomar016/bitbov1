@extends('global.main')

@section('title', "BitBo | Household Profile")

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
            $('#data-table-default-1').DataTable()
        });

    </script>
   <script type="text/javascript">

    var fullname = "", resident_id = "";
    function getName(fname) {
        fullname = fname;
    }

    $('#data-table-default-1').on('click','.addmember_btn',function() {
        var id = $(this).closest("tbody tr").find("td:eq(0)").html();
        var fullname = $(this).closest("tbody tr").find("td:eq(1)").html();
        $('#edit_db_name').text(fullname);
        $('#addModal').modal('show')
        $('#EditBarangayID').val(id);
    });

    //
    $(document).on('click','.addbtn', function() {
        var resident_id = $('#EditBarangayID').val();
        var header_id = $('#header_id').val()
        var reltohead = $('.multireltohead').children(":selected").attr("value");
        
        data = {
            resident_id: resident_id,
            header_id: header_id,
            reltohead: reltohead,
            _token: "{{csrf_token()}}"
        }
         swal({
                title: "Wait!",
                text: "Are you sure you want to add '"+ $('#edit_db_name').text() +"' as a new household member ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                      if (willDelete) {
                          $.ajax({
                                url: "{{route('AddHouseholdMemberss')}}",
                                type: "post",
                                data: data,
                                success: function(data)
                                {
                                    swal("Data have been successfully added!", {
                                        icon: "success", 
                                    });
                                    if(data == "good") {
                                        location.reload();
                                    }
                                },
                                error: function(data)
                                {
                                    console.log(data)
                                }
                            })
                         
                      } else {
                          swal("Operation Cancelled.", {
                              icon: "error",
                          });
                      }
              });
        

    });

    $(document).on('click','.search_btn',function() {
        
        $('.list-of-residents').remove();
        var searchval = $('#stext').val();
        
        var faddress = "";
        var profilepic = "";
        $.ajax({
            url: "{{route('ResidentsSearchAddingMember')}}",
            type: "post",
            dataType:'json',
            data: { searchval: searchval, _token: "{{csrf_token()}}" },
            async:false,
            success:function(data)
            {

               $('#data-table-default-1').DataTable().rows().remove().draw();
                if(data.length > 0) {
                    data.map( value => {
                        value['listofresidents'].map( residents => {
                            
                            fullname = residents['FULLNAME'];
                            // profilepic = residents['PROFILE_PICTURE'];
                            // image = 'background-image:url("{{asset("upload/residentspics/")}}/'+profilepic+'")';
                            resident_id = residents['RESIDENT_ID'];
                            residents['FULL_ADDRESS'] == null ? faddress = "" : faddress = residents['FULL_ADDRESS']
                            
                            $("#data-table-default-1").DataTable().row.add
                            (
                                [
                                    "<td class='id-txt' id='resident_id'>"+resident_id+"</td>",
                                    fullname,
                                    residents['PLACE_OF_BIRTH'] +','+ residents['DATE_OF_BIRTH'],
                                    
                                    "<button type='button' class='btn btn-lime addmember_btn'><i class='fa fa-edit' data-toggle='modal' data-target='#addModal'></i> Add Member</button>"
                                    
                                ]
                            ).draw();


                        })

                        $(".sorting_1").hide();  
                    })
                }
            },
            error:function(error)
            {
                console.log(error)
            }
        });
      });


   </script>
   
@endsection

@section('content')

  <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Household Members</a></li>

        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Household Members  <small>DILG Requirements</small></h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div >
          <!-- begin input-group -->
                <div class="input-group input-group-lg m-b-20">
                    <input type="text" class="form-control input-white" placeholder="Search by Lastname for adding a new household member" id="stext"/>
                    <div class="input-group-append">
                        <button class="btn btn-primary search_btn"><i class="fa fa-search fa-fw"></i> Search</button>

                        
                    </div>
                </div>
                <br>
                                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                        </div>
                        <h4 class="panel-title">Add member</h4>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin alert -->
                    
                    <div class="alert alert-yellow fade show">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        The following are the resident/s that you can as member of the household.
                    </div>
                    <!-- end alert -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                      

                        <br>
                        <br>
                            
                        <table id="data-table-default-1" class="table table-striped table-bordered display compact" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th hidden>resident id</th>
                                <th>Full Name</th>
                                <th>Place of Birth</th>
                                
                                <th>Action</th>
                                
                                <!-- <th style="width: 15%">Actions </th> -->
                            </tr>
                            </thead>

                            <tbody>
                              
                            </tbody>
                        </table>
                      
                       

                      
                        </div>

                    </div>
                    <!-- end panel-body -->
                <div class="clear_search">
                    <ul class="result-list">


                    </ul>

                </div><br>
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
                        <h4 class="panel-title">Existing Records</h4>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin alert -->
                    <input type="text" id="header_id" value="{{$id}}" hidden="">
                    <div class="alert alert-yellow fade show">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        The following are the household members within the system.
                    </div>
                    <!-- end alert -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                      

                        <br>
                        <br>
                        
                        <table id="data-table-default" class="table table-striped table-bordered display compact" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th hidden>header id</th>
                                <th>Full Name</th>
                                <th>Relation to household head</th>
                                <th>Civil Status</th>
                                
                                <!-- <th style="width: 15%">Actions </th> -->
                            </tr>
                            </thead>

                            <tbody>
                              @foreach($result as $row)
                              <tr>
                                <td hidden>{{$row->FAMILY_HEADER_ID}}</td>
                                <td>{{$row->FULLNAME}}</td>
                                <td>{{$row->RELATION_TO_HOUSEHOLD_HEAD}}</td>
                                <td>{{$row->CIVIL_STATUS}}</td>
                              </tr>
                              @endforeach
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

    <!-- end #content -->
 <!-- #modal-EDIT -->
                            <div class="modal fade" id="addModal" data-backdrop="static">
                                <div class="modal-dialog" style="max-width: 30%">
                                    <form id="EditForm" method="POST">
                                        @csrf

                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #90ca4b">
                                                <h4 class="modal-title" style="color: white">Add Household Member</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                            </div>
                                            <div class="modal-body">
                                                 <h><label style="display: block; text-align: center">Resident's Name</label></h>
                                                <h3><b><label style="text-transform: capitalize; display: block; text-align: center" id="edit_db_name" name="edit_db_name"></label></b></h3>
                                                {{--modal body start--}}
                                                <label class="form-label hide">Barangay ID</label>
                                                <input id="EditBarangayID" name="EditBarangayID" type="text" class="form-control hide" name="CategoryID"/>
                                                <br><br>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                       <label style="text-align: left">&nbspRelation to Household head</label>
                                                       <select id=multireltohead name=multireltohead class="form-control multireltohead">
                                                            <option value="Spouse">Spouse </option>
                                                            <option value="Daughter">Son </option>
                                                            <option value="Daughter">Daughter </option>
                                                            <option value="Stepson">Stepson</option>
                                                            <option value="Stepdaughter">Stepdaughter </option>
                                                            <option value="Son-in-law>Son-in-law">Son-in-law>Son-in-law</option>
                                                            <option value="Daughter-in-law">Daughter-in-law</option>
                                                            <option value="Grandson">Grandson </option>
                                                            <option value="Granddaughter">Granddaughter </option>
                                                            <option value="Father">Father </option>
                                                            <option value="Mother">Mother </option>
                                                            <option value="Brother">Brother </option>
                                                            <option value="Sister">Sister </option>
                                                            <option value="Uncle">Uncle </option>
                                                            <option value="Aunt">Aunt </option>
                                                            <option value="Nephew">Nephew </option>
                                                            <option value="Niece">Niece </option>
                                                            <option value="Other relative">Other relative</option>
                                                            <option value="Nonrelative">Nonrelative </option>
                                                            <option value="Boarder">Boarder </option>
                                                            <option value="Domestic helper">Domestic helper </option>

                                                        </select>
                                                    </div>
                                                </div>
                                               

                                                {{--modal body end--}}
                                            </div>
                                            <div class="modal-footer">
                                                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>

                                                <a id="EditBTN" href="javascript:;" style="" class="btn btn-lime addbtn">Add</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
@endsection