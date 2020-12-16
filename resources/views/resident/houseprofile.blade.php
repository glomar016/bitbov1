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
        
            // TableManageDefault.init();
            Notification.init();
        });


    </script>
    <script type="text/javascript">
  
   var table = $("#data-table-default").DataTable({
                  serverSide: true,
                  processing: true,    
                  ajax:"{{ route('LoadHousehold') }}",
                 
                  columns:
                  [  
                      { data: "HOUSEHOLD_ID", name: "HOUSEHOLD_ID", visible: false},
                      { data: "FULLNAME", name: "FULLNAME", visible: true},
                      { data: "HOME_OWNERSHIP", name: "HOME_OWNERSHIP"},
                      { data: "PERSON_STAYING_IN_HOUSEHOLD", name: "PERSON_STAYING_IN_HOUSEHOLD"},
                      { data: "HOME_MATERIALS",name: "HI.HOME_MATERIALS", searchable: false},

                      { data: "TOILET_HOME", name: "TOILET_HOME", visible: false,searchable: false},
                      { data: "PLAY_AREA_HOME", name: "PLAY_AREA_HOME", visible: false, searchable: false},
                      { data: "BEDROOM_HOME", name: "BEDROOM_HOME", visible: false, searchable: false},
                      { data: "DINING_ROOM_HOME", name: "DINING_ROOM_HOME", visible: false, searchable: false},
                      { data: "SALA_HOME", name: "SALA_HOME", visible: false, searchable: false},
                      { data: "KITCHEN_HOME", name: "KITCHEN_HOME", visible: false, searchable: false},

                      { data: "WATER_UTILITIES", name: "WATER_UTILITIES", visible: false, searchable: false},
                      { data: "ELECTRICITY_UTILITIES", name: "ELECTRICITY_UTILITIES", visible: false, searchable: false},
                      { data: "AIRCON_UTILITIES", name: "AIRCON_UTILITIES", visible: false, searchable: false},
                      { data: "PHONE_UTILITIES", name: "PHONE_UTILITIES", visible: false, searchable: false},
                      { data: "COMPUTER_UTILITIES", name: "COMPUTER_UTILITIES", visible: false, searchable: false},
                      { data: "INTERNET_UTILITIES", name: "INTERNET_UTILITIES", visible: false, searchable: false},
                      { data: "TV_UTILITIES", name: "TV_UTILITIES", visible: false, searchable: false},
                      { data: "CD_PLAYER_UTILITIES", name: "CD_PLAYER_UTILITIES", visible: false, searchable: false},
                      { data: "RADIO_UTILITIES", name: "RADIO_UTILITIES", visible: false, searchable: false},
                      { data: "COMICS_ENTERTAINMENT", name: "COMICS_ENTERTAINMENT", visible: false, searchable: false},
                      { data: "NEWS_PAPER_ENTERTAINMENT", name: "NEWS_PAPER_ENTERTAINMENT", visible: false, searchable: false},
                      { data: "PETS_ENTERTAINMENT", name: "PETS_ENTERTAINMENT", visible: false, searchable: false},
                      { data: "BOOKS_ENTERTAINMENT", name: "BOOKS_ENTERTAINMENT", visible: false, searchable: false},
                      { data: "STORY_BOOKS_ENTERTAINMENT", name: "STORY_BOOKS_ENTERTAINMENT", visible: false,searchable: false},
                      { data: "TOYS_ENTERTAINMENT", name: "TOYS_ENTERTAINMENT", visible: false, searchable: false},
                      { data: "BOARD_GAMES_ENTERTAINMENT", name: "BOARD_GAMES_ENTERTAINMENT", visible: false, searchable: false},
                      { data: "PUZZLES_ENTERTAINMENT", name: "PUZZLES_ENTERTAINMENT", visible: false, searchable: false},
                      { data: "NUMBER_OF_ROOMS", name: "NUMBER_OF_ROOMS", visible: false, searchable: false},
                      { data: "FAMILY_HEADER_ID", name: "FAMILY_HEADER_ID", visible: false, searchable: false},

                      { render:function(data, type, full, meta)
                        {
                          return "<button type='button' class='btn btn-success mother-btn' data-toggle='modal' data-target='#UpdateModal'><i class='fa fa-edit'></i> Edit</button><button type='button' onClick=\"famMembers('" + full.FAMILY_HEADER_ID+"')\" class='btn btn-warning view_btn' ><i class='fa fa-eye'></i> View</button>";
                        }, 
                        searchable: false}, 
                  ]
              });    
     
       

</script>

    <script type="text/javascript">
      function famMembers(id) {
          var enc_id;
          $.ajax({
            url: '{{asset('')}}encrypt/'+id,
            method: 'get',
            data: {token:"{{csrf_token()}}"},
            success:function(data) {
              enc_id = data;
              location.href = "{{asset('')}}" + "HouseholdMembers/"+enc_id;
            }
          });
          
      }

      $(document).ready(function() {
        // $(document).on('click','.view_btn', function() {


        //   //location.href = "{{route('HouseholdProfile')}}";
        //   //"{{asset('')}}"+
        // });

        $('#data-table-default tbody').on('click','tr', function() {

            // var lastname = table.cell( this, 5).data();
            // var firstname = table.cell( this, 6).data();
            // var middlename = table.cell( this, 7).data();
            var fullname =  table.cell( this, 1).data();
            $('#edit_db_name').text(fullname);
            
           

            var edittoilet = table.cell( this, 5).data();           
            var parea =  table.cell( this, 6).data(); 
            var bedroom =  table.cell( this, 7).data(); 
            var dining =  table.cell( this, 8).data(); 
            var sala =  table.cell( this, 9).data(); 
            var kitchen =  table.cell( this, 10).data(); 
            var water =  table.cell( this, 11).data(); 
            var electric =  table.cell( this, 12).data(); 
            var aircon =  table.cell( this, 13).data(); 
            var phone =  table.cell( this, 14).data(); 
            var computer = table.cell( this, 15).data(); 
            var internet =  table.cell( this, 16).data(); 
            var tv =  table.cell( this, 17).data(); 
            var cdplayer =  table.cell( this, 18).data(); 
            var radio =  table.cell( this, 19).data(); 
            var comics =  table.cell( this, 20).data(); 
            var newspaper =  table.cell( this, 21).data(); 
            var pets =  table.cell( this, 22).data(); 
            var books =  table.cell( this, 23).data(); 
            var storybooks = table.cell( this, 24).data(); 
            var toys =  table.cell( this, 25).data(); 
            var bgames = table.cell( this, 26).data(); 
            var puzzle =  table.cell( this, 27).data(); 
          
           $('#EditCatID').val(table.cell( this, 0).data());           
           $('#editnumberofrooms').val(table.cell( this, 28).data());

           if (edittoilet == 1) { document.getElementById('edittoilet').checked = true;} else if (edittoilet == 0) { document.getElementById('edittoilet').checked = false; }
           if (parea == 1) { document.getElementById('editplayarea').checked = true;} else if (parea == 0) { document.getElementById('editplayarea').checked = false; }
           if (bedroom == 1) { document.getElementById('editbedroom').checked = true;} else if (bedroom == 0) { document.getElementById('editbedroom').checked = false; }
           if (dining == 1) { document.getElementById('editdining').checked = true;} else if (dining == 0) { document.getElementById('editdining').checked = false; }
           if (sala == 1) { document.getElementById('editsala').checked = true;} else if (sala == 0) { document.getElementById('editsala').checked = false; }
           if (kitchen == 1) { document.getElementById('editkitchen').checked = true;} else if (kitchen == 0) { document.getElementById('editkitchen').checked = false; }
           if (water == 1) { document.getElementById('editrunningwater').checked = true;} else if (water == 0) { document.getElementById('editrunningwater').checked = false; }
           if (electric == 1) { document.getElementById('editelectricity').checked = true;} else if (electric == 0) { document.getElementById('editelectricity').checked = false; }
           if (aircon == 1) { document.getElementById('editaircon').checked = true;} else if (aircon == 0) { document.getElementById('editaircon').checked = false; }
           if (phone == 1) { document.getElementById('editmobile').checked = true;} else if (phone == 0) { document.getElementById('editmobile').checked = false; }
           if (computer == 1) { document.getElementById('editcomputer').checked = true;} else if (computer == 0) { document.getElementById('editcomputer').checked = false; }
           if (internet == 1) { document.getElementById('editinternet').checked = true;} else if (internet == 0) { document.getElementById('editinternet').checked = false; }
           if (tv == 1) { document.getElementById('edittv').checked = true;} else if (tv == 0) { document.getElementById('edittv').checked = false; }
           if (cdplayer == 1) { document.getElementById('editdvd').checked = true;} else if (cdplayer == 0) { document.getElementById('editdvd').checked = false; }
           if (radio == 1) { document.getElementById('editradio').checked = true;} else if (radio == 0) { document.getElementById('editradio').checked = false; }
           if (comics == 1) { document.getElementById('editcomics').checked = true;} else if (comics == 0) { document.getElementById('editcomics').checked = false; }
           if (newspaper == 1) { document.getElementById('editnews').checked = true;} else if (newspaper == 0) { document.getElementById('editnews').checked = false; }
           if (pets == 1) { document.getElementById('editpets').checked = true;} else if (pets == 0) { document.getElementById('editpets').checked = false; }
           if (books == 1) { document.getElementById('editbooks').checked = true;} else if (books == 0) { document.getElementById('editbooks').checked = false; }
           if (storybooks == 1) { document.getElementById('editsbooks').checked = true;} else if (storybooks == 0) { document.getElementById('editsbooks').checked = false; }
           if (toys == 1) { document.getElementById('edittoys').checked = true;} else if (toys == 0) { document.getElementById('edittoys').checked = false; }
           if (bgames == 1) { document.getElementById('editbgames').checked = true;} else if (bgames == 0) { document.getElementById('editbgames').checked = false; }
           if (puzzle == 1) { document.getElementById('editpuzzles').checked = true;} else if (puzzle == 0) { document.getElementById('editpuzzles').checked = false; }

        });
      });

    </script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('#EditBTN').on('click', function() {

            var household_id = $('#EditCatID').val();
            var homeowner = $('#edithomeownership').children(":selected").attr("value");
            var pstaying = $('#editpstaying').children(":selected").attr("value");
            var build_mat = $("input:radio[name=edit_radio_home_materials]:checked").val();
            var noofrooms = $('#editnumberofrooms').val();

            if ($("#edittoilet").is(":checked")){ var toilet = 1; } else if ($("#edittoilet").is(":not(:checked)")) { var toilet = 0; }

            if ($("#editplayarea").is(":checked")){ var playarea = 1; } else if ($("#editplayarea").is(":not(:checked)")) { var playarea = 0; }

            if ($("#editbedroom").is(":checked")){ var bedroom = 1; } else if ($("#editbedroom").is(":not(:checked)")) { var bedroom = 0; }

            if ($("#editdining").is(":checked")){ var dining = 1; } else if ($("#editdining").is(":not(:checked)")) { var dining = 0; }

            if ($("#editsala").is(":checked")){ var sala = 1; } else if ($("#editsala").is(":not(:checked)")) { var sala = 0; }

            if ($("#editkitchen").is(":checked")){ var kitchen = 1; } else if ($("#editkitchen").is(":not(:checked)")) { var kitchen = 0; }
              


            if ($("#editrunningwater").is(":checked")){ var runningwater = 1; } else if ($("#editrunningwater").is(":not(:checked)")) { var runningwater = 0; }

            if ($("#editelectricity").is(":checked")){ var electricity = 1; } else if ($("#editelectricity").is(":not(:checked)")) { var electricity = 0; }

            if ($("#editaircon").is(":checked")){ var aircon = 1; } else if ($("#editaircon").is(":not(:checked)")) { var aircon = 0; }



            if ($("#editmobile").is(":checked")){ var mobile = 1; } else if ($("#editmobile").is(":not(:checked)")) { var mobile = 0; }

            if ($("#editcomputer").is(":checked")){ var ncomputer = 1; } else if ($("#editcomputer").is(":not(:checked)")) { var ncomputer = 0; }

            if ($("#editinternet").is(":checked")){ var internet = 1; } else if ($("#editinternet").is(":not(:checked)")) { var internet = 0; }

            if ($("#edittv").is(":checked")){ var boxtv = 1; } else if ($("#edittv").is(":not(:checked)")) { var boxtv = 0; }

            if ($("#editdvd").is(":checked")){ var cdplayer = 1; } else if ($("#editdvd").is(":not(:checked)")) { var cdplayer = 0; }

            if ($("#editradio").is(":checked")){ var boxradio = 1; } else if ($("#editradio").is(":not(:checked)")) { var boxradio = 0; }

            if ($("#editcomics").is(":checked")){ var ncomics = 1; } else if ($("#editcomics").is(":not(:checked)")) { var ncomics = 0; }

            if ($("#editnews").is(":checked")){ var newspaper = 1; } else if ($("#editnews").is(":not(:checked)")) { var newspaper = 0; }

            if ($("#editpets").is(":checked")){ var pets = 1; } else if ($("#editpets").is(":not(:checked)")) { var pets = 0; }

            if ($("#editbooks").is(":checked")){ var books = 1; } else if ($("#editbooks").is(":not(:checked)")) { var books = 0; }

            if ($("#editsbooks").is(":checked")){ var storybooks = 1; } else if ($("#editsbooks").is(":not(:checked)")) { var storybooks = 0; }

            if ($("#edittoys").is(":checked")){ var toys = 1; } else if ($("#edittoys").is(":not(:checked)")) { var toys = 0; }

            if ($("#editbgames").is(":checked")){ var boardgames = 1; } else if ($("#editbgames").is(":not(:checked)")) { var boardgames = 0; }

            if ($("#editpuzzles").is(":checked")){ var puzzles = 1; } else if ($("#editpuzzles").is(":not(:checked)")) { var puzzles = 0; }            

            var fd = new FormData();
            fd.append('EditCatID',household_id)
           
            fd.append('homeowner',homeowner);
            fd.append('pstaying',pstaying);
            fd.append('build_mat',build_mat);
            fd.append('noofrooms',noofrooms);

            // checkboxes

            fd.append('toilet', toilet);
            fd.append('playarea', playarea);
            fd.append('bedroom', bedroom);
            fd.append('dining', dining);
            fd.append('sala', sala);
            fd.append('kitchen', kitchen);
            fd.append('runningwater', runningwater);
            fd.append('electricity', electricity);
            fd.append('aircon', aircon);
            fd.append('mobile', mobile);
            fd.append('computer', ncomputer);
            fd.append('internet', internet);
            fd.append('boxtv', boxtv);
            fd.append('cdplayer', cdplayer);
            fd.append('boxradio', boxradio);
            fd.append('comics', ncomics);
            fd.append('newspaper', newspaper);
            fd.append('pets', pets);
            fd.append('books', books);
            fd.append('storybooks', storybooks);
            fd.append('toys', toys);
            fd.append('boardgames', boardgames);
            fd.append('puzzles', puzzles);  
            fd.append('_token',"{{ csrf_token() }}");


            let result;

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

        });
      });


    async function Update(fd) {
       swal("Data have been successfully updated!", {
                  icon: "success",
                });
          try
          {
              result = await $.ajax({
                   url:"{{ route('HouseholdProfileEdit') }}",
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
</script>


@endsection

@section('content')

  <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Household profile</a></li>

        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Household Information  <small>DILG Requirements</small></h1>
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
                        <h4 class="panel-title">Existing Records</h4>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin alert -->
                    <div class="alert alert-yellow fade show">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        The following are the household profile within the system.
                    </div>
                    <!-- end alert -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        {{--<button type='button' class='btn btn-lime'data-toggle='modal' data-target='#AddModal' >
                            <i class='fa fa-plus'></i> Add New
                        </button>--}}

                        <br>
                        <br>
                        <div id="loadtable">
                        <table id="data-table-default" class="table table-striped table-bordered display compact" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th hidden>Category ID</th>
                                <th>Household Head</th>
                                <th>Home ownership</th>
                                <th>Person Staying in Household</th>
                                
                                <th>Home Material</th>
                                
                                
                               
                                <th hidden>toilet</th>
                                <th hidden>play area</th>
                                <th hidden>bedroom</th>
                                <th hidden>dining</th>
                                <th hidden>sala</th>
                                <th hidden>kitchen</th>
                                <th hidden>water</th>
                                <th hidden>electric</th>
                                <th hidden>aircon</th>
                                <th hidden>phone</th>
                                <th hidden>computer</th>
                                <th hidden>internet</th>
                                <th hidden>tv</th>
                                <th hidden>cdplayer</th>
                                <th hidden>radio</th>
                                <th hidden>comics</th>
                                <th hidden>newspaper</th>
                                <th hidden>pets</th>
                                <th hidden>books</th>
                                <th hidden>storybooks</th>
                                <th hidden>toys</th>
                                <th hidden>boardgames</th>
                                <th hidden>puzzle</th>
                                <th hidden>noofrooms</th>
                                <th hidden>familyheader</th>
                                <th style="width: 15%">Actions </th>
                            </tr>
                            </thead>

                            <tbody>
                           
                            </tbody>
                        </table>
                      </div>
                        <!-- #modal-EDIT -->
                        <div class="modal fade" id="UpdateModal" data-backdrop="static">
                            <div class="modal-dialog" style="max-width: 45%">
                                <form id="EditForm">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #008a8a">
                                            <h4 class="modal-title" style="color: white">Edit Household</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                        </div>
                                        <div class="modal-body">
                                           <h><label style="display: block; text-align: center">Resident's Name</label></h>
                                                     <h3><b><label style="display: block; text-align: center; text-transform: capitalize;" id="edit_db_name" name="edit_db_name"></label></b></h3>
                                            {{--modal body start--}}
                                            <label class="form-label hide">Category ID</label>
                                            <input id="EditCatID" type="text" class="form-control hide" name="CategoryID"/>
                                        <!-- begin fieldset -->
                                        
                                             <fieldset>
                                            <!-- begin row -->
                                            <div class="row">

                                                <div class="col-md-6">

                                                    <!-- begin form-group -->
                                                    <br><br>

                                                    <div class="form-group row m-b-10">

                                                        <label class="col-md-3 col-form-label text-md-center">Ownership Status<span class="text-danger">*</span></label>
                                                        <div class="col-md-6">
                                                            <select class="form-control " data-style="btn-lime" id="edithomeownership" name="edithomeownership">
                                                             

                                                                <option value="Owned" selected>Owned</option>
                                                                <option value="Rented">Rented</option>
                                                                <option value="With Parents">With Parents</option>
                                                                <option value="With Relatives">With Relatives</option>
                                                          
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- end form-group -->
                                                    <!-- begin form-group -->
                                                    <div class="form-group row m-b-10">
                                                        <label class="col-md-3 col-form-label text-md-center">Build Materials</label>
                                                        <div class="col-md-6">
                                                            <div class="radio radio-css">
                                                                <input type="radio" name="edit_radio_home_materials" id="cssRadioConcrete" value="Concrete" checked />
                                                                <label for="cssRadioConcrete">Concrete</label>
                                                            </div>
                                                            <div class="radio radio-css">
                                                                <input type="radio" name="edit_radio_home_materials" id="cssRadioWood" value="Wood" />
                                                                <label for="cssRadioWood">Wood</label>
                                                            </div>
                                                            <div class="radio radio-css">
                                                                <input type="radio" name="edit_radio_home_materials" id="cssRadioNipa" value="Nipa" />
                                                                <label for="cssRadioNipa">Nipa</label>
                                                            </div>
                                                            <div class="radio radio-css">
                                                                <input type="radio" name="edit_radio_home_materials" id="cssRadio1Makeshift" value="Make-shift" />
                                                                <label for="cssRadio1Makeshift">Make-shift</label>
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                        <!-- begin form-group -->
                                                        <div class="form-group row m-b-10">
                                                            <label class="col-md-3 col-form-label text-md-center">Number of Rooms <span class="text-danger">*</span></label>
                                                            <div class="col-md-6">
                                                                <br>
                                                                <input type="number" id="editnumberofrooms" name="editnumberofrooms" placeholder="" class="form-control" data-parsley-group="step-2" data-parsley-required="true" />
                                                            </div>
                                                        </div>
                                                        <!-- end form-group -->
                                                        
                                                        <!-- begin form-group -->
                                                        <div class="form-group row m-b-10">
                                                            {{--<label class="col-md-3 col-form-label text-md-center">Address<span class="text-danger">*</span></label>--}}
                                                            <div class="col-md-6">
                                                                {{--<input type="number" name="editstreetno" id="editstreetno" placeholder="Street No." class="form-control" data-parsley-group="step-2" data-parsley-required="true" />
                                                                </br>
                                                                <input type="number" name="" placeholder="Street No." class="form-control" data-parsley-group="step-2" value="11" data-parsley-required="true"  hidden /> --}}

                                                            </div>
                                                        </div>
                                                        </br>
                                                        <!-- begin form-group -->
                                                        <div class="form-group row m-b-10">
                                                            <label class="col-md-3 col-form-label text-md-center">Nature of the house</label>
                                                            <div class="col-md-6">
                                                                <div class="checkbox checkbox-css">
                                                                    <input type="checkbox" id="edittoilet" name="edittoilet" />
                                                                    <label for="edittoilet">With Toilet</label>
                                                                </div>
                                                                <div class="checkbox checkbox-css">
                                                                    <input type="checkbox" id="editplayarea" name="editplayarea"  />
                                                                    <label for="editplayarea">With Play Area</label>
                                                                </div>
                                                                <div class="checkbox checkbox-css">
                                                                    <input type="checkbox" id="editbedroom" name="editbedroom"/>
                                                                    <label for="editbedroom">With Bedroom</label>
                                                                </div>
                                                                <div class="checkbox checkbox-css">
                                                                    <input type="checkbox" id="editdining" name="editdining" />
                                                                    <label for="editdining">Wih Dining Room</label>
                                                                </div>
                                                                <div class="checkbox checkbox-css">
                                                                    <input type="checkbox" id="editsala" name="editsala" />
                                                                    <label for="editsala">With Sala</label>
                                                                </div>
                                                                <div class="checkbox checkbox-css">
                                                                    <input type="checkbox" id="editkitchen" name="editkitchen" />
                                                                    <label for="editkitchen">With Kitchen</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end form-group -->
                                                    </div>
                                                        <!-- end form-group -->


                                                <div class="col-md-6">
                                                    <!-- begin form-group -->
                                                    <br><br><br><br>
                                                    <div class="form-group row m-b-10">
                                                        <label class="col-md-3 col-form-label text-md-center">Utilities Available</label>
                                                        <div class="col-md-6">
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editrunningwater" name="editrunningwater" />
                                                                <label for="editrunningwater">Running Water</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editelectricity" name="editelectricity" />
                                                                <label for="editelectricity">Electricity</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editaircon" name="editaircon"/>
                                                                <label for="editaircon">Aircon</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editmobile" name="editmobile" />
                                                                <label for="editmobile">Mobile Phone</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editcomputer" name="editcomputer" />
                                                                <label for="editcomputer">Computer</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editinternet"  name="editinternet" />
                                                                <label for="editinternet">Internet</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="edittv" name="edittv" />
                                                                <label for="edittv">Television</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editdvd"  name="editdvd" />
                                                                <label for="editdvd">CD/DVD Player</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editradio"  name="editradio" />
                                                                <label for="editradio">Radio</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end form-group -->

                                                    <!-- begin form-group -->
                                                    <div class="form-group row m-b-10">
                                                        <label class="col-md-5 col-form-label text-md-center">Entertainment Available</label>
                                                        <div class="col-md-6">
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editcomics" name="editcomics" />
                                                                <label for="editcomics">Comics/Magazines</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editnews" name="editnews"  />
                                                                <label for="editnews">Newspapers</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editpets" name="pets"/>
                                                                <label for="editpets">Pets</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editbooks" name="editbooks" />
                                                                <label for="editbooks">Books</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editsbooks" name="storybooks" />
                                                                <label for="editsbooks">Story Books</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="edittoys" name="edittoys" />
                                                                <label for="edittoys">Toys</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editbgames" name="editbgames" />
                                                                <label for="editbgames">Board Games</label>
                                                            </div>
                                                            <div class="checkbox checkbox-css">
                                                                <input type="checkbox" id="editpuzzles" name="editpuzzles" />
                                                                <label for="editpuzzles">Puzzles</label>
                                                            </div>
                                                        </div>
                                                    </div><br><br>
                                                    <!-- end form-group -->

                                                    <div class="form-group row m-b-10">
                                                        <label class="col-md-3 col-form-label text-md-center">Persons Staying in the same household<span class="text-danger">*</span></label>
                                                        <div class="col-md-6">
                                                            <select class="form-control " data-style="btn-lime" id="editpstaying" name="editpstaying">
                                                                <option value="Parents" selected>Parents</option>
                                                                <option value="Relatives">Relatives</option>
                                                                <option value="Non-Relatives">Non-Relatives</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>


                                            <!-- end row -->
                                        </fieldset>
                                        <!-- end fieldset -->
                                        <!-- end fieldset -->
                                            {{--modal body end--}}
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                            <a id="EditBTN" href="javascript:;" class="btn btn-success">Update</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- #modal-view -->
                        <div class="modal fade" id="ViewModal" data-backdrop="static">
                            <div class="modal-dialog" style="max-width: 45%">
                                <div class="modal-content">

                                    <div class="modal-header" style="background-color: #f59c1a">
                                        <h4 class="modal-title" style="color: white">Household Profile</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                    </div>
                                    
                                    <div class="modal-body">
                                         <h><label style="display: block; text-align: center">Resident's Name</label></h>
                                                     <h3><b><label style="display: block; text-align: center; text-transform: capitalize;" id="view_db_name" name="view_db_name"></label></b></h3>
                                        {{--modal body start--}}
                                        
                                        <br>
                                        <h2><b><label style="display: block; text-align: center">Household Information</label></b></h2>
                                        <br><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                 <!-- begin form-group -->
                                                <div class="form-group row m-b-10">
                                                    <label class="col-md-3 col-form-label text-md-center">Nature of the house</label>
                                                    <div class="col-md-6">
                                                        <div class="checkbox checkbox-css">
                                                            <input class="form-control" type="checkbox" id="viewtoilet" name="viewtoilet" readonly/>
                                                            <label for="">With Toilet</label>
                                                        </div>
                                                        <div class="checkbox checkbox-css">
                                                            <input class="form-control" type="checkbox" id="viewplayarea" name="viewplayarea" readonly/>
                                                            <label for="">With Playarea</label>
                                                        </div>
                                                        <div class="checkbox checkbox-css">
                                                            <input type="checkbox" id="viewbedroom" name="viewbedroom" readonly/>
                                                            <label for="">With Bedroom</label>
                                                        </div>
                                                        <div class="checkbox checkbox-css">
                                                            <input type="checkbox" id="viewsala" name="viewsala" readonly/>
                                                            <label for="">With Sala</label>
                                                        </div>
                                                        <div class="checkbox checkbox-css">
                                                            <input type="checkbox" id="viewdining" name="viewdining"  readonly/>
                                                            <label for="">With DiningRoom</label>
                                                        </div>
                                                        <div class="checkbox checkbox-css">
                                                            <input type="checkbox" id="viewkitchen" name="viewkitchen"  readonly/>
                                                            <label for="">With Kitchen</label>
                                                        </div>
                                                    </div>
                                                </div><br>
                                            </div>

                                             <div class="col-md-6">
                                                
                                                <div class="form-group row m-b-10">
                                                    <label class="col-md-3 col-form-label text-md-center">Utilities Available</label>
                                                    <div class="col-md-6">
                                                        <div class="checkbox checkbox-css">
                                                            <input type="checkbox" id="viewwater" name="viewwater"  readonly/>
                                                            <label for="">With Water</label>
                                                        </div>
                                                        <div class="checkbox checkbox-css">
                                                            <input type="checkbox" id="viewelectric" name="viewelectric" readonly/>
                                                            <label for="">With Electricity</label>
                                                        </div>
                                                        <div class="checkbox checkbox-css">
                                                            <input type="checkbox" id="viewaircon" name="viewaircon"  readonly/>
                                                            <label for="">With Aircon</label>
                                                        </div>
                                                        <div class="checkbox checkbox-css">
                                                            <input type="checkbox" id="viewphone" name="viewphone"  readonly/>
                                                            <label for="">With Phone</label>
                                                        </div>
                                                        <div class="checkbox checkbox-css">
                                                           <div class="form-group checkbox checkbox-css">
                                                                <input type="checkbox" id="viewradio" name="viewradio"  readonly/>
                                                                <label for="">With Radio</label>
                                                            </div>
                                                        </div>
                                                        <div class="checkbox checkbox-css">
                                                            <input type="checkbox" id="viewcomputer" name="viewcomputer" readonly/>
                                                            <label for="">With Computer</label>
                                                        </div>
                                                        <div class="checkbox checkbox-css">
                                                            <input type="checkbox" id="viewinternet" name="viewinternet"  readonly/>
                                                            <label for="">With Internet</label>
                                                        </div>
                                                        <div class="checkbox checkbox-css">
                                                            <input type="checkbox" id="viewtv" name="viewtv"  readonly/>
                                                            <label for="">With TV</label>
                                                        </div>
                                                        <div class="checkbox checkbox-css">
                                                            <input type="checkbox" id="viewcd" name="viewcd"  readonly/>
                                                            <label for="">With CD Player</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                               <!-- end form-group -->
                                        </div>
                                       
                                        <div class="row">
                                            <div class="col-md-6">
                                            <div class="form-group row m-b-10">
                                                <label class="col-md-5 col-form-label text-md-center">Entertainment Available</label>
                                                <div class="col-md-6">
                                                     <div class="checkbox checkbox-css">
                                                        <input type="checkbox" id="viewcomics" name="viewcomics"  readonly/>
                                                        <label for="">With Comics</label>

                                                    </div>
                                                    <div class="checkbox checkbox-css">
                                                        <input type="checkbox" id="viewnspaper" name="viewnspaper" readonly/>
                                                        <label for="">With News Paper</label>

                                                    </div>
                                                    <div class="checkbox checkbox-css">

                                                        <input type="checkbox" id="viewpets" name="viewpets" readonly/>
                                                        <label for="">With Pets</label>
                                                    </div>
                                                    <div class="checkbox checkbox-css">
                                                        <input type="checkbox" id="viewbooks" name="viewbooks" readonly/>
                                                        <label for="">With Books</label>
                                                    </div>
                                                    <div class="checkbox checkbox-css">
                                                         <input type="checkbox" id="viewsbooks" name="viewsbooks" readonly/>
                                                    <label for="">With Story Books</label>

                                                    </div>
                                                    <div class="checkbox checkbox-css">
                                                        <input type="checkbox" id="viewtoys" name="viewtoys" readonly/>
                                                    <label for="">With Toys</label>

                                                    </div>
                                                    <div class="checkbox checkbox-css">
                                                         <input type="checkbox" id="viewbgames" name="viewbgames" readonly/>
                                                    <label for="">With Board Games</label>

                                                    </div>
                                                    <div class="checkbox checkbox-css">
                                                         <input type="checkbox" id="viewpuzzle" name="viewpuzzle" readonly/>
                                                    <label for="">With Puzzle</label>

                                                    </div>
                                                </div>
                                            </div>
                                            </div>   
                                        </div>
                                     
                                        <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                     <label for="">No. of Rooms</label>
                                                   <input type="text" id="viewnorooms" class="form-control" name="viewnorooms" readonly/>
                                                   
                                                </div>
                                            </div>
                                        {{--modal body end--}}
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                    </div>
                                </div>
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