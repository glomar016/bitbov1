@extends('global.main')

@if(session('session_permis_ordinances')!='1' && session('session_position')!='Data Protection Officer')
<script type="text/javascript">location.href='{{route("Dashboard")}}'</script>
@else

@endif

@section('title', "BitBo | Ordinance")

@section('page-css')

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')}}" rel="stylesheet" />



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



@section('page-js')

@if (Request::ajax())
@section('page-init-table') @show
@section('page-init-app') @stop

@else
@section('page-init-app') @show
@section('table-js') @show
@yield('page-add')

@endif


@endsection

@section('page-functions')

{{--Modals--}}
<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
@endsection

@section('page-add')
{{--For ADD FORM--}}
<script type="text/javascript"> 

var Addform = document.getElementById("AddForm");
$('#AddBtn').click(function(e) {


    var title, author, assignoff, category, sanction, description, remarks, category_id,assign_officials,ordinance_number,ordi_type;

    title = $('#title_txt').val();
    author = $('#author_txt').val();
    ordinance_number = $('#ordinance_number').val();
    ordi_type = $('#ordi_type').val();
    category_id = $('#categname').children(":selected").attr("id");
    assign_officials =  $('#assign_official').children(":selected").attr("id");
    sanction = $('#sanction_txt').val();
    description = $('#desc_txt').val();
    remarks = $('#remarks_txt').val();
    file = $('#file_txt')[0].files;

    var fd = new FormData();
    fd.append('title',title);
    fd.append('author',author);
    fd.append('ordinance_number',ordinance_number);
    fd.append('ordi_type',ordi_type);
    
    fd.append('category_id',category_id);
    fd.append('assign_official',assign_officials);
    fd.append('sanction',sanction);
    fd.append('description',description);
    fd.append('remarks',remarks);
    
    for(i=0;i<file.length;i++){
        fd.append('file[]',file[i]);
    }
    

    fd.append('_token', "{{ csrf_token() }}")
    
    $.ajax({

        url:"{{route('OrdinanceStore')}}",
        type:'post',        
        data:fd,
        processData: false,
        contentType: false,
        success:function(data)
        {
            if (data == "good")
            {
                SuccessAlert();
                window.location.reload();
            }
        }     
    })



});



//  Update Btn
$('#UpdateOrdinanceBtn').click(function(e) {
var title, author, assignoff, category, sanction_id, description, remarks,category_id,v_ordinance_number;
ordinance_id = $('#ordinance_id_txt').val();
title = $('#TitleViewTxt').val();
v_ordinance_number = $('#v_ordinance_number').val();
author = $('#AuthorViewTxt').val();
assignoff = $('#OfficialAssignedViewTxt').children(":selected").attr("id");
category_id = $('#CategoryViewTxt').children(":selected").attr("id");
description = $('#DescriptionViewTxt').val();
sanction_id = $('#sanctionview_id').val();
remarks = $('#RemarksViewTxt').val();
file = $('#file_update_txt')[0].files;
var fd = new FormData();
fd.append('ordinance_id',ordinance_id);
fd.append('v_ordinance_number',v_ordinance_number);
fd.append('category_id', category_id)
fd.append('title',title);
fd.append('author',author);
fd.append('assignoff',assignoff);
fd.append('category',category);
fd.append('sanction_id',sanction_id);
fd.append('description',description);
fd.append('remarks',remarks);

for(i=0;i<file.length;i++){
        fd.append('file[]',file[i]);
}
    

fd.append('_token', "{{ csrf_token() }}")

$.ajax({

    url:"{{route('OrdinanceUpdate')}}",
    type:'post',        
    data:fd,
    processData: false,
    contentType: false,
    success:function(data)
    {
        if (data == "good")
        {
            SuccessAlert();
            window.location.reload();
        }
    }     
})
});

function SuccessAlert() {

   swal({
    title: 'Success!',
    text: 'Ordinance successfully updated.',
    icon: 'success',
})
}
</script>


    {{-- REMOVE BTN --}}
    <script>
        
        $(".remove-btn").click(function()
            { 
            var ordinance_id =$(this).closest('table tr').find('td:eq(0)').html();
               swal({
                    title: "Wait!",
                    text: "Are you sure you want to remove this?",
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
                                    url:"{{route('RemoveOrdinance')}}",
                                    type:'POST',                                    
                                    data:{ordinance_id : ordinance_id,
                                        _token       : '{{csrf_token()}}'
                                    },
                                    success:function()
                                    {
                                       location.reload();
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


<script>
        
        $(".activate-btn").click(function()
            {
                var ordinance_id =$(this).closest('table tr').find('td:eq(0)').html();
            swal({
                    title: "Wait!",
                    text: "Are you sure you want to activate this?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willResolve) => {
                        if (willResolve) {
                            swal("Data have been successfully activated!", {
                                icon: "success",

                            });
                            $.ajax({
                                    url:"{{route('ActivateOrdinance')}}",
                                    type:'POST',                                    
                                    data:{ordinance_id : ordinance_id,
                                        _token       : '{{csrf_token()}}'
                                    },
                                    success:function()
                                    {
                                       location.reload();
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



{{--  View Btn --}}

<script type="text/javascript">
$(document).ready(function()
{
    $("#data-table-default").on('click','.ViewModal',function()
    {
        $("#ordinance_id_txt").val($(this).closest('table tr').find('td:eq(0)').html());
       
        $("#AuthorViewTxt").val($(this).closest('table tr').find('td:eq(1)').html());
        $('')
        var title = $(this).closest('table tr').find('td:eq(2)').html();
        $('#TitleViewTxt').val(title);
        
        
        $("#CategoryViewTxt").val($(this).closest('table tr').find('td:eq(5)').html());
        $("#OfficialAssignedViewTxt").val($(this).closest('table tr').find('td:eq(8)').html());
       
        $("#RemarksViewTxt").val($(this).closest('table tr').find('td:eq(3)').html());
        $("#sanctionview_id").val($(this).closest('table tr').find('td:eq(4)').html());   
         $("#v_ordinance_number").val($(this).closest('table tr').find('td:eq(9)').html());   

        var image_src = '{!!asset("ordinances/'+$(this).closest('table tr').find('td:eq(5)').html()+'")!!}';
        
        $("#FileViewTxt").attr('src',image_src);
        $("#DescriptionViewTxt").val($(this).closest('table tr').find('td:eq(7)').html());
        


        $.ajax({
            url: '{{route('GetOrdinanceImages')}}',
            type: "post",
            dataType:'json',
            data: {ordinance_id :$(this).closest('table tr').find('td:eq(0)').html(),_token:"{{csrf_token()}}"},
            success:function(data){
                console.warn(data);
                data.map((value)=>{
                    
                    $("#OrdinanceCarousel").append(" <div class='carousel-item' style='overflow:hidden' ><img src='{{asset('ordinances')}}/"+value['FILE_NAME']+" ' style='width:700px; height:500px;   object-fit: contain;' class='files'/></div>")
                        $('.carousel-inner').find('.carousel-item').first().addClass('active');

                });
            
            }
        })

        
    })

})


</script>
{{-- <script type="text/javascript">
    function CheckISSUANCE(val){
 var element=document.getElementById('resolution_div');
 if(val=='pick a color'||val=='RESOLUTION')
   element.style.display='block';
    else  
   element.style.display='none';
}

</script> --}}
<script type="text/javascript">
   
// $(function () {
//   $("#issuance_select").change(function() {
//     var val = $(this).val();
//     if(val === "RESOLUTION") {
//         $("#resolution_div").show();
//         $("#ordinance_div").hide();
//     }
//     else if(val === "ORDINANCE") {
//         $("#ordinance_div").show();
//         $("#resolution_div").hide();
//     }
//   });
// });

</script>


@endsection

@section('content')

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">

        <li class="breadcrumb-item active">Resolution</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Resolution<small> All Resolution in barangay.</small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div >

        <!-- begin col-10 -->
        <div>
            <!-- begin panel -->
            <div class="panel panel-inverse">


                <div>

                </div>       


                <div>

                 <div class="panel panel-inverse">
                 
    <div class="tab-content" id="nav-pills-tab-1">
       
        <div class="tab-pane fade active show" >
           
             <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">List Of Resolution</h4>
                </div>
                <!-- end panel-heading -->
                <div class="alert alert-yellow fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">×</span>
                    </button>
                    The following are the existing records of Resolution in the barangay.
                </div>
                <br>
                              <button type='button' class='btn btn-lime'data-toggle='modal' data-target='#OrdinanceModal' >
                                <i class='fa fa-plus'></i> Add New
                            </button>
                            <br>
                            <br><br>
                    <div id="LoadTable">
                                <table id="data-table-default" class="table table-striped table-bordered display compact" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Ordinance ID</th>
                                            <th >Author</th>
                                            <th >Title</th>
                                            
                                            <th >Remarks</th>
                                            <th >Sanction</th>
                                            <th>Category</th>
                                            <th hidden>file</th>
                                            <th hidden>Description</th>
                                            <th > Assigned Official</th>
                                            <th hidden=""> Ordinance Number</th>
                                            <th >Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                     @foreach($ordinances as $record )
                                     <tr >
                                        <td hidden>{{ $record->ORDINANCE_ID }} </td>
                                        <td style="background-color: {{ $record->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}"> {{ $record->ORDINANCE_AUTHOR }}</td>
                                        <td style="background-color: {{ $record->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{ $record->ORDINANCE_TITLE }}</td>                                        
                                        <td style="background-color: {{ $record->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{ $record->ORDINANCE_REMARKS }}</td>
                                        <td style="background-color: {{ $record->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{ $record->ORDINANCE_SANCTION }}</td>
                                        <td style="background-color: {{ $record->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{ $record->ORDINANCE_CATEGORY_NAME }}</td>
                                        <td hidden></td>
                                        <td hidden>{{ $record->ORDINANCE_DESCRIPTION }}</td>
                                        <td style="background-color: {{ $record->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{ $record->FULLNAMES }}</td>
                                        <td hidden="" style="background-color: {{ $record->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{ $record->ORDINANCE_NUMBER }}</td>
                                        <td style="background-color: {{ $record->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}" >
                                            <button type='button' class='btn btn-warning form-control ViewModal' data-toggle='modal' data-target='#ViewModal'>
                                                <i class='fa fa-eye'></i> View
                                            </button>
                                            <button type='button' class='btn btn-success form-control activate-btn'>
                                                <i class='fa fa-active'></i> Activate
                                            </button>
                                            <button type='button' class='btn btn-danger form-control remove-btn'>
                                                <i class='fa fa-times'></i> Remove
                                            </button>
                                             
                                        </td></tr>
                                    @endforeach
                                </tbody>
                            </table>
               
            </div> 
        </div>      
    </div>
    </div>
  


                

                        <!-- #modal-view -->
                        <div class="modal fade" id="OrdinanceModal">
                            <div class="modal-dialog" style="max-width: 40%">
                                <form id="OrdinanceForm" method="post">
                                    {{csrf_field()}}

                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #90ca4b">
                                            <h4 class="modal-title" style="color: white; display: block; text-align: center;">Add Ordinance</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                        </div>
                                        <div class="modal-body">
                                            {{--modal body start--}}
                                         {{-- <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <label style="display: block; text-align: left">LEGISLATIVE ISSUANCE</label>
                                                <select class="form-control" data-style="select-with-transition" id="issuance_select"> 
                                                        
                                                        <option value="ORDINANCE">ORDINANCE</option>
                                                        <option value="RESOLUTION">RESOLUTION</option>
                                                      </select>

                                            </div>
                                        </div> --}}
                                            <h2 id="ViewBarangayName" align="center"></h2>
                                            <input type="text" name="BusinessIDTxt" id="BusinessIDTxt" hidden>                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-6">
                                                    <div class="stats-content">
                                                     <label style="display: block; text-align: left">Title</label>
                                                     <input type="text" id="title_txt" name="title_txt" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='' class="form-control" >
                                                 </div>
                                             </div>
                                         </div> <br>
                                         <div class="row">
                                                <div class="col-lg-12 col-md-6">
                                                    <div class="stats-content">
                                                     <label style="display: block; text-align: left" hidden="">Ordinance Type</label>
                                                     <input type="text" hidden="" id="ordi_type" name="ordi_type" value="RESOLUTION" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='' class="form-control" >
                                                 </div>
                                             </div>
                                         </div> <br>

                                         <div class="row">
                                                <div class="col-lg-12 col-md-6" id="ordinance_div">
                                                    <div class="stats-content">
                                                     <label style="display: block; text-align: left">Resolution Number</label>
                                                     <input type="text" id="ordinance_number" name="ordinance_number" style="display: block; text-align: left; color:black; background-color:white; "  placeholder='' class="form-control" >

                                                 </div>
                                             </div>
                                         </div> <br>
                                          
                                         <div class="row">
                                            <div class="col-lg-12 col-md-6">
                                                <div class="stats-content">
                                                    <label style="display: block; text-align: left">Author</label>
                                                    <input type="text" id="author_txt" name="author_txt" style="display: block; text-align: left; color:black; background-color:white;" placeholder='' class="form-control" >

                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        {{-- temporary commented start--}}
                                        <div class="row">
                                                <div  class="col-lg-12 col-md-12">
                                                    <div class="stats-content">
                                                        <label style="display: block; text-align: left">Assigned official</label>
                                                        <select id="assign_official" class="form-control" name="assign_official" data-style="select-with-transition">

                                                            @foreach($assign_official as $row)
                                                            <option id ="{{ $row->BARANGAY_OFFICIAL_ID }}">{{$row->FULLNAME}}</option> 
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> 
                                       {{-- temporary commented end--}}
                                        <br>
                                        {{-- temporary commented start--}}
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <label style="display: block; text-align: left">Category</label>
                                                <select id="categname" class="form-control" name="categname" data-style="select-with-transition">
                                                    @foreach($category as $key => $categ_name)
                                                    <option id ="{{ $key }}">{{$categ_name}}</option> 
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- temporary commented end--}}
                                        

                                        <br>
                                        <div class="row">
                                         <div class="col-lg-12">
                                            <label style="display: block; text-align: left">Sanction</label>
                                            <input type="text" id="sanction_txt" name="sanction_txt" style="display: block; text-align: left; color:black; background-color:white ;  " placeholder='' class="form-control" >
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-lg-12">
                                         <label style="display: block; text-align: left">Description</label>
                                         <textarea type="text" id="desc_txt" name="desc_txt" style="display: block; text-align: left; color:black; background-color:white;" placeholder='' class="form-control" ></textarea> 
                                     </div>
                                 </div><br>
                                 <div class="row">
                                    <div class="col-lg-12">
                                        <label style="display: block; text-align: left;">Remarks</label>
                                        <textarea type="text" id="remarks_txt" name="remarks_txt" style="display: block; text-align: left; color:black; background-color:white   " placeholder='' class="form-control" ></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <label style="display: block; text-align: left;">File</label>
                                      <input type="file" id="file_txt" name="file_txt" style="display: block; text-align: left; color:black; background-color:white" accept="image/*"  placeholder='' class="form-control" multiple>
                                    </div>
                                </div>


                                {{--modal body end--}}
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                <a href="javascript:;" class="btn btn-lime" id="AddBtn">Add</a>

                            </div>
                        </div>
                    </form>
                </div>

            </div>
       
            <!-- #modal-view -->
            <div class="modal fade" id="ViewModal">
                <div class="modal-dialog" style="max-width: 50%">
                    <form id="" method="post">
                        {{csrf_field()}}

                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #90ca4b">
                                <h4 class="modal-title" style="color: white">View Ordinance</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                            </div>
                            <div class="modal-body">
                                {{--modal body start--}}
                                 <input type="text" id="ordinance_id_txt" hidden>
                                <h><label style="display: block; text-align: center">Ordinance Title</label></h>
                                <h3><b><input type="text" class="form-control" style="text-transform: capitalize; display: block; text-align: center" id="TitleViewTxt" name="TitleViewTxt"></b></h3>
                                <br>
                                 <h><label style="display: ">Resolution Number</label></h>
                                 <h3><b><input type="text" class="form-plugins" style="text-transform: " id="v_ordinance_number" name="v_ordinance_number" ></b></h3>
                                 
                                
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="stats-content">
                                            <label style="display: block; text-align: left">&nbspAuthor</label>
                                            <input type="text" id="AuthorViewTxt" name="AuthorViewTxt" style="display: block; text-align: left; color:black; background-color:white;" placeholder='Author here...' class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="stats-content">
                                            <label style="display: block; text-align: left">&nbspAssigned official</label>
                                            <select id="OfficialAssignedViewTxt" class="form-control" name="OfficialAssignedViewTxt" data-style="select-with-transition">

                                                        @foreach($assign_official as $row)
                                                        <option id ="{{ $row->BARANGAY_OFFICIAL_ID }}">{{$row->FULLNAME}}</option> 
                                                        @endforeach

                                                    </select>
                                        </div>
                                    </div>

                                </div> <br>
                        
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <label style="display: block; text-align: left">&nbspCategory</label>
                                    <select id="CategoryViewTxt" class="form-control" name="CategoryViewTxt" data-style="select-with-transition">

                                                    @foreach($category as $key => $categ_name)
                                                    <option id ="{{ $key }}">{{$categ_name}}</option> 
                                                    @endforeach
                                                </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <label style="display: block; text-align: left">&nbspRemarks</label>
                                    <input type="text" id="RemarksViewTxt" name="RemarksViewTxt" style="display: block; text-align: left; color:black; background-color:white;" placeholder='Description here...' class="form-control" />
                                </div>
                            </div><br>
                                
                            <div class="row">
                             <div class="col-lg-12">
                                <label style="display: block; text-align: left">&nbspSanction</label>
                                <input type="text" id="sanctionview_id" name="sanctionview_id" style="display: block; text-align: left; color:black; background-color:white ;  " placeholder='Sanction here...' class="form-control" />
                            </div>                            
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <label style="display: block; text-align: left;">Description</label>
                                    <textarea type="text" id="DescriptionViewTxt" name="DescriptionViewTxt" style="display: block; text-align: left; color:black; background-color:white   "placeholder='remarks here...' class="form-control" ></textarea>
                                </div>
                            </div>   

                            <div id="carousel-example-generic" class="carousel slide col-md-12" data-ride="carousel" >

                                <div class="carousel-inner" id="OrdinanceCarousel" style="align-items: center">

                                </div>
                                <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true" style="color:black"></span>
                                  <span class="sr-only">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                              </a>
                             </div>
                            {{-- <h><label style="display: block; text-align: center">Ordinance Document</label></h>
                                <h3><b><label style="text-transform: capitalize; display: block; text-align: center"  name="FileViewTxt"><img src="" alt="No Uploaded Image" id="FileViewTxt" width="600px" height="600px" /> </label></b></h3> --}}
                        <br>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <label style="display: block; text-align: left;">Image Upload</label>
                                <input type="file" id="file_update_txt" name="file_update_txt" style="display: block; text-align: left; color:black; background-color:white" accept="image/*"  placeholder='' class="form-control" multiple>
                            </div>
                        </div>
                                                {{--modal body end--}}
                    </div><br>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>

                        <a href="javascript:;" class="btn btn-warning" id="UpdateOrdinanceBtn">Update</a>
                        {{-- <a href="javascript:;" class="btn btn-warning" id="activateBtn">Activate</a> --}}

                    </div>
                </div>
                </form>
        </div>
    </div>
    <!-- #modal-view-end -->
</div>
</div>
</div>
</div>
</div>
</div>
</div>       
@endsection