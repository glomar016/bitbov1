@extends('global.main')

@section('title', "Residents' Basic Info")

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
<script src="{{asset('assets/plugins/parsley/dist/parsley.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.js')}}"></script>
<script src="{{asset('assets/js/demo/form-wizards-validation.demo.min.js')}}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
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
        FormWizardValidation.init();
        Notification.init();
        $('#resident_table').DataTable();
    });

</script>

<script type="text/javascript">

    $('#ArrivalReason').change(function () {
        var arrivalreason = $('#ArrivalReason').children(":selected").attr("id");
        if(arrivalreason == 3)
        {
            $('#div_transient').show();
        }
        else
        {
            $('#div_transient').hide();   
        }

    });

</script>
{{--For ADD FORM--}}
<script>

    $('#AddBTN').click(function()
    {

                //resident
                var fname = $('#firstname').val();
                var mname = $('#middlename').val();
                var lname = $('#lastname').val();
                var qualifier = $('#qualifier').val();
                var selectedsex = $("input:radio[name=sex_gender]:checked").val();
                var dateofbirth = $('#dateofbirth').val();
                var civilstatus = $('#civilstatus').val();
                var placeofbirth = $('#placeofbirth').val();
                var is_ofw = $("input:radio[name=is_ofw]:checked").val();
                var citizenship = $('#Citizenship').val();
                var occupation = $('#Occupation').val();
                var workstatus = $("#workstatus").children(":selected").attr("value");
                var educationatt = $("#educationatt").children(":selected").attr("value");
                var dateofstartwork = $('#dateofstartwork').val();
                var relationtohead = $('#RelationToHead').val();
                var dateofarrive = $('#dateofarrival').val();
                var is_indegenous = $("input:radio[name=radio_Indigenous]:checked").val();
                var contactnumber = $('#contactnumber').val();
                var homeownership = $('#homeownership').children(":selected").attr("value");
                var buildmaterial = $("input:radio[name=radio_home_materials]:checked").val();
                var numberofrooms = $('#numberofrooms').val();
                var streetno = $('#streetno').val();
                var barangayzone_id = $('#BarangayZone').children(":selected").attr("value");
                var personinhousehold = $("#personinhousehold").children(":selected").attr("value");
                var arrivalreason = $('#ArrivalReason').children(":selected").attr("id");
                var r_coming = $('#r_coming').val();
                var p_startdate = $('#p_startdate').val();
                var p_enddate = $('#p_enddate').val();

                var houseno = $('#houseno').val();
                var hstreet = $('#hstreet').val();
                var hphase = $('#hphase').val();
                var hbuilding = $('#hbuilding').val();
                var hunitno = $('#hunitno').val();
                var hsubdivision = $('#hsubdivision').val();

                if ($("#cssCheckbox1Toilet").is(":checked")){ var toilet = 1; } else if ($("#cssCheckbox1Toilet").is(":not(:checked)")) { var toilet = 0; }

                if ($("#cssCheckbox2Playarea").is(":checked")){ var playarea = 1; } else if ($("#cssCheckbox2Playarea").is(":not(:checked)")) { var playarea = 0; }

                if ($("#cssCheckbox3Bedroom").is(":checked")){ var bedroom = 1; } else if ($("#cssCheckbox3Bedroom").is(":not(:checked)")) { var bedroom = 0; }

                if ($("#cssCheckbox4diningroom").is(":checked")){ var dining = 1; } else if ($("#cssCheckbox4diningroom").is(":not(:checked)")) { var dining = 0; }

                if ($("#cssCheckbox5sala").is(":checked")){ var sala = 1; } else if ($("#cssCheckbox5sala").is(":not(:checked)")) { var sala = 0; }

                if ($("#cssCheckbox6kitchen").is(":checked")){ var kitchen = 1; } else if ($("#cssCheckbox6kitchen").is(":not(:checked)")) { var kitchen = 0; }
                //

                if ($("#cssCheckboxRunningwater").is(":checked")){ var runningwater = 1; } else if ($("#cssCheckboxRunningwater").is(":not(:checked)")) { var runningwater = 0; }

                if ($("#cssCheckboxElectricity").is(":checked")){ var electricity = 1; } else if ($("#cssCheckboxElectricity").is(":not(:checked)")) { var electricity = 0; }

                if ($("#cssCheckboxaircon").is(":checked")){ var aircon = 1; } else if ($("#cssCheckboxaircon").is(":not(:checked)")) { var aircon = 0; }



                if ($("#cssCheckboxmobilephone").is(":checked")){ var mobile = 1; } else if ($("#cssCheckboxmobilephone").is(":not(:checked)")) { var mobile = 0; }

                if ($("#cssCheckboxcomputer ").is(":checked")){ var computer = 1; } else if ($("#cssCheckboxcomputer ").is(":not(:checked)")) { var computer = 0; }

                if ($("#cssCheckboxinternet").is(":checked")){ var internet = 1; } else if ($("#cssCheckboxinternet").is(":not(:checked)")) { var internet = 0; }

                if ($("#cssCheckboxtv").is(":checked")){ var boxtv = 1; } else if ($("#cssCheckboxtv").is(":not(:checked)")) { var boxtv = 0; }

                if ($("#cssCheckboxcdplayer").is(":checked")){ var cdplayer = 1; } else if ($("#cssCheckboxcdplayer").is(":not(:checked)")) { var cdplayer = 0; }

                if ($("#cssCheckboxradio").is(":checked")){ var boxradio = 1; } else if ($("#cssCheckboxradio").is(":not(:checked)")) { var boxradio = 0; }

                if ($("#cssCheckboxcomics").is(":checked")){ var comics = 1; } else if ($("#cssCheckboxcomics").is(":not(:checked)")) { var comics = 0; }

                if ($("#cssCheckboxNewspaper").is(":checked")){ var newspaper = 1; } else if ($("#cssCheckboxNewspaper").is(":not(:checked)")) { var newspaper = 0; }

                if ($("#cssCheckboxPets").is(":checked")){ var pets = 1; } else if ($("#cssCheckboxPets").is(":not(:checked)")) { var pets = 0; }

                if ($("#cssCheckboxbooks").is(":checked")){ var books = 1; } else if ($("#cssCheckboxbooks").is(":not(:checked)")) { var books = 0; }

                if ($("#cssCheckboxstorybooks").is(":checked")){ var storybooks = 1; } else if ($("#cssCheckboxstorybooks").is(":not(:checked)")) { var storybooks = 0; }

                if ($("#cssCheckboxToys").is(":checked")){ var toys = 1; } else if ($("#cssCheckboxToys").is(":not(:checked)")) { var toys = 0; }

                if ($("#cssCheckboxboardgames").is(":checked")){ var boardgames = 1; } else if ($("#cssCheckboxboardgames").is(":not(:checked)")) { var boardgames = 0; }

                if ($("#cssCheckboxpuzzles").is(":checked")){ var puzzles = 1; } else if ($("#cssCheckboxpuzzles").is(":not(:checked)")) { var puzzles = 0; }

                

                var fd = new FormData();
                fd.append('firstname', fname);
                fd.append('middlename', mname);
                fd.append('lastname', lname);
                fd.append('qualifier', qualifier);
                fd.append('sex_gender', selectedsex);
                fd.append('dateofbirth', dateofbirth);
                
                fd.append('civilstatus', civilstatus);
                fd.append('placeofbirth', placeofbirth);
                fd.append('is_ofw', is_ofw);
                fd.append('citizenship', citizenship);
                fd.append('occupation', occupation);
                fd.append('workstatus', workstatus);
                fd.append('dateofstartwork', dateofstartwork);
                fd.append('relationtohead', relationtohead);
                fd.append('dateofarrive', dateofarrive);
                
                fd.append('is_indegenous', is_indegenous);
                fd.append('firstname', fname);
                fd.append('contactnumber', contactnumber);
                fd.append('arrivalreason', arrivalreason);
                fd.append('r_coming', r_coming);
                fd.append('p_startdate', p_startdate);
                fd.append('p_enddate', p_enddate);

                fd.append('houseno', houseno);
                fd.append('hstreet', hstreet);
                fd.append('hphase', hphase);
                fd.append('hbuilding', hbuilding);
                fd.append('hunitno', hunitno);
                fd.append('hsubdivision', hsubdivision);

                fd.append('homeownership', homeownership);
                fd.append('buildmaterial', buildmaterial);
                fd.append('numberofrooms',numberofrooms);
                fd.append('barangayaddress_id',barangayzone_id);
                fd.append('streetno',streetno);
                fd.append('barangayzone_id',barangayzone_id);

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
                fd.append('computer', computer);
                fd.append('internet', internet);
                fd.append('boxtv', boxtv);
                fd.append('cdplayer', cdplayer);
                fd.append('boxradio', boxradio);
                fd.append('comics', comics);
                fd.append('newspaper', newspaper);
                fd.append('pets', pets);
                fd.append('books', books);
                fd.append('storybooks', storybooks);
                fd.append('toys', toys);
                fd.append('boardgames', boardgames);
                fd.append('puzzles', puzzles);
                fd.append('personinhousehold',personinhousehold);
                fd.append('educationatt',educationatt);

                fd.append('_token',"{{ csrf_token() }}");

                let result;
                Add(fd);
                
            });

async function Add(fd) {

 swal("Data have been successfully added!", {
    icon: "success", 
});

 try
 {
    result = await $.ajax({
        url:"{{route('BasicInfoAdd')}}",
        type:'post',
        processData:false,
        contentType:false,
        cache:false,
        data:fd,
        success:function(data)
        {
            if (data == "good")
            {
                window.location.reload();
            }     
        }    
    })
}
catch(error)
{
    console.error(error)
}
}
</script>


</script>

<script type="text/javascript">
     // 15 POB 16 unitNO 17 PHASE 18 HOUSENO 19 STREET 20 SUBDIVI 21 BUILDING
     $(document).ready(function (){
       $("#resident_table tbody").on('click', 'tr', function () {
        var parse_numer, housenum;
        var res_id = table.cell( this, 0).data();
        var lastname = table.cell( this, 1).data();
        var firstname = table.cell( this, 2).data();
        var middlename = table.cell( this, 3).data();
        var q_name = table.cell( this, 4).data();
        var occupation = table.cell( this, 8).data();
        var citizenship = table.cell( this, 10).data();
        var r_head = table.cell( this, 11).data();
        var contactnumber = table.cell( this, 12).data();

        var bdate = table.cell( this, 13).data();
        var place_of_birth = table.cell( this, 14).data();
        var unit_no = table.cell( this, 15).data();
        var phase = table.cell( this, 16).data();
        var house_no = table.cell( this, 17).data();
        var street = table.cell( this, 18).data();
        var subdivi = table.cell( this, 19).data();
        var building = table.cell( this, 20).data();
        var started_working = table.cell( this, 21).data();
        var date_arrival = table.cell( this, 22).data();
        var fullname = lastname + ", " + firstname + " " + middlename;

        var cr = new Date();
        var dt =  new Date(bdate);
        var dob = dt.getFullYear();
        var cy = cr.getFullYear();
        var age = cy - dob;
        

        if (contactnumber != null) { parse_number = parseInt(contactnumber); }
        if (house_no != null) { housenum = parseInt(house_no); }
        $('#editage').val(age);
        $('#edit_db_name').text(fullname);
        $('#EditCatID').val(res_id);
        $('#editlname').val(lastname);
        $('#editfname').val(firstname);
        $('#editmname').val(middlename);
        $('#editqname').val(q_name);
        $('#editoccu').val(occupation);
        $('#editcitiz').val(citizenship);
        $('#edithead').val(r_head);
        $('#editcontact').val(parse_number);
        $('#edit_age').text(age);
        $('#editbdate').val(bdate);
        $('#editpbirth').val(place_of_birth);
        $('#edit_hunitno').val(unit_no);

        $('#edit_houseno').val(housenum);
        $('#edit_street').val(street);
        $('#edit_hphase').val(phase);
        $('#edit_hsubdivision').val(subdivi);

        $('#edit_hbuilding').val(building);
        $('#editsworking').val(started_working);
        $('#editarrtime').val(date_arrival);
    });

   });
</script>

<script type="text/javascript">

    $(document).ready(function(){
        $('#EditBTN').on('click', function(){


            var resident_id = $('#EditCatID').val();
            var fname = $('#editfname').val();
            var mname = $('#editmname').val();
            var lname = $('#editlname').val();
            var qname = $('#editqname').val();
            var gender = $("input:radio[name=edit_gender]:checked").val();
            var bdate = $('#editbdate').val();
            var cstatus = $('#editcstatus').children(":selected").attr("value");
            var occupation = $('#editoccu').val();
            var wstatus = $('#editwstatus').children(":selected").attr("value");
            var educationatt = $('#editeducationatt').children(":selected").attr("value");

            var startwork = $('#editsworking').val();
            var is_ofw = $("input:radio[name=edit_isofw]:checked").val();
            var is_inde = $("input:radio[name=edit_isinde]:checked").val();
            var citiz = $('#editcitiz').val();
            var head = $('#edithead').val();
            var arrt = $('#editarrtime').val();
            var editc = $('#editcontact').val();
            var arrstat = $('#editareason').children(":selected").attr("id");

            var place_birth =  $('#editpbirth').val();
            var unit_no = $('#edit_hunitno').val();
            var house_no =  $('#edit_houseno').val();
            var streetno =  $('#edit_street').val();
            var phase =  $('#edit_hphase').val();
            var subdivi =  $('#edit_hsubdivision').val();
            var building =  $('#edit_hbuilding').val();

            var fd = new FormData();

            fd.append('resident_id',resident_id);
            fd.append('editfname',fname);
            fd.append('editmname',mname);
            fd.append('editlname',lname);
            fd.append('editqname',qname);
            fd.append('editgender',gender);
            fd.append('editbdate',bdate);
            fd.append('editcstatus',cstatus);
            fd.append('editoccu',occupation);
            fd.append('editwstatus',wstatus);
            fd.append('editstartw',startwork);
            fd.append('editcitiz',citiz);
            fd.append('editrhead',head);
            fd.append('editarrtime',arrt);
            fd.append('editastatus',arrstat);
            fd.append('edit_isinde',is_inde);
            fd.append('editcontact',editc);

            fd.append('editpbirth',place_birth);
            fd.append('edit_hunitno',unit_no);
            fd.append('edit_houseno',house_no);
            fd.append('edit_street',streetno);
            fd.append('edit_hphase',phase);
            fd.append('edit_hsubdivision',subdivi);
            fd.append('edit_hbuilding',building);
            fd.append('editeducationatt',educationatt);

            fd.append('_token',"{{csrf_token()}}");
            let result;

            warning(fd);
            
        });


        function warning(fd) {

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

        async function Update(fd) {

           swal("Data have been successfully Updated!", {
               icon: "success",
           });
           try
           {
               result = await $.ajax({
                   url:"{{route('BasicInfoEdit')}}",
                   type:'post',
                   processData:false,
                   contentType:false,
                   cache:false,
                   data:fd,
                   success:function(data)
                   {
                       if (data == "good")
                       {
                        window.location.reload();
                    }        
                }   
            })
           }
           catch(error)
           {
               console.error(error);
           }
       }
   });

</script>

<script type="text/javascript">

    $("#resident_table tbody").on('click', '.disableResident', function () {
       var resident_id = table.cell( 'tr', 0).data();
       alert(resident_id)
       var fd = new FormData();
       fd.append('resident_id',resident_id);

       fd.append('_token', "{{ csrf_token() }}");

       swal({
            title: "Wait!",
            text: "Are you sure you want to disable this resident?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
       .then((willDelete) => {
        if (willDelete) {
            Disable(fd);
            
        } else {
            swal("Operation Cancelled.", {
                icon: "error",
            });
        }
    });
       let result;

       async function Disable(fd) {  

         swal("Resident have been successfully Deactivated!", {
           icon: "success",
       });
         try
         {
           result = await $.ajax({
               url:"{{route('BasicInfoDelete')}}",
               type:'post', 
               processData:false,
               contentType:false,
               cache:false,
               data:fd,

               success:function(data)
               {
                    if (data == "good")
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
});




</script>

<script type="text/javascript">
   var output = '';
   var active_flag;
   var table = $("#resident_table").DataTable({
    serverSide: true,
    processing: true,    
    ajax:"{{ route('LoadResidents') }}",

    columns:
    [  
   
    { data: "LASTNAME", name: "T.LASTNAME"},
    { data: "FIRSTNAME", name: "T.FIRSTNAME"},
    { data: "MIDDLENAME",name: "T.MIDDLENAME"},
   ]
});

   $('#btnExport').on('click', function(){
        swal({
            title: "Are you sure?",
            text: "Generate Residents Record",
            icon: "warning",
            buttons: [true, "Yes"],
            dangerMode: true,
          })
        .then((willDelete) => {
            if (willDelete) 
            {
                window.location.href = "{{route('ResidentsExport')}}";
            }
            else 
            {
               Cancelled('Operation Cancelled!');
            }
        });
    });
    var property, filename, filextension, filesize;
    var fd = new FormData();
   
    $(document).on('change','#file', function() {
        property = document.getElementById('file').files[0];
        
        if (property != undefined) {
            filename = property.name;
            filextension = filename.split('.').pop().toLowerCase();
            filesize = property.size;
        }
        
    });

    $('#btnImport').on('click', function(){

       
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
                            // beforeSend:function() {
                            //     $('#btnImport').html("<label class'text-success'>Uploading Excel...</label>");
                            // },
                            success : function(data) {
                               if (data == "true")
                               {
                                    alert('Success');
                               }
                            },
                            error : function(error){
                                console.log("error: " + error);
                                console.log(fd);
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

   function Cancelled(textvalue) {
        swal({
            title: 'Cancelled',
            text: textvalue,
            icon:'error',
            buttons: false,
            timer: 1000,
          });
    };
</script>


@endsection

@section('content')

<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Residents' Information</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Basic Information  <small>DILG Requirements</small></h1>
    <!-- end page-header -->


    <button type='button' class='btn btn-primary' style="width: 160px" data-toggle='modal' data-target='#Export_Import'><i class='fa fa-test'></i> Export/Import</button>

    <div class="modal fade" id="Export_Import" data-backdrop="static">
        <div class="modal-dialog" style="max-width: 30%">
           
            <div class="modal-content">
                <div class="modal-header" style="background-color: #348fe2">
                    <h4 class="modal-title" style="color: white">Excel/Import Residents</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                </div>
                <div class="modal-body">
                <form >
                {{ csrf_field() }}
                 <h><label style="display: block; text-align: center">Export and Import</label></h>
                 <h3><b><label style="text-transform: capitalize; display: block; text-align: center;" id="view_db_name" name="view_db_name"></label></b></h3>
                 <br>
                  <div class="col-lg-12">
                    <div class="form-group">
                        <button type='button' class='btn btn-lime form-control' id="btnExport"  ><i class='fa fa-redo'></i> Export</button>
                    </div>
                </div>
                 
                  <div class="col-lg-12">
                    <div class="form-group">
                        <h><label style="display: block; text-align: center">Choose a file to import</label></h>
                        
                        <input type="file" class="form-control" id="file" name="file" required="true" >
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <h><label style="display: block; text-align: center">&nbsp</label></h>
                        <button type="button" class='btn btn-danger form-control' id="btnImport" name="btnImport"  ><i class='fa fa-redo'></i> Upload</button>
                    </div>
                </div>
                  <br><br>
                 <div class="modal-footer" align="center">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>

                </div>
                </form>
            </div>
             
        </div>
    </div>
    <!-- end tab-pane -->
</div>
<!-- end nav-pills -->
<!-- begin tab-content -->
<br><br>
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
                The following are the existing records of the residents within the system.
            </div>
            <!-- end alert -->
            <!-- begin panel-body -->

            <div class="panel-body">

                <table id="resident_table" class="table table-striped table-bordered display compact" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            
                            <th >Last Name </th>
                            <th >First Name </th>
                            <th >Middle Name </th>

                        
                           
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>


</div>




</div>
<!-- end panel-body -->
</div>
<!-- end panel add new -->
{{--Nav Pill Body End--}}
</div>
<!-- end tab-pane -->


</div>

@endsection