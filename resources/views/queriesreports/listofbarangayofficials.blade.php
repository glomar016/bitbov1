 
@extends('global.main')

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

    });
</script>



<script type="text/javascript">


    $('#filterbtn').on('click', function() {

        var status = $('#editcstatus').val(); 
        var fd =  new FormData();

        
        fd.append('editcstatus', status);
        fd.append('_token',"{{ csrf_token() }}");
        let result;

        filterdisplay(fd);

    });

    async function filterdisplay(fd) {       
        await loadfilter(fd);  
        sample();    
    }

    function sample() {
     $('#spnner').hide();
 }

 function loadfilter(fd) {
    return new Promise((resolve,reject) => {
        setTimeout(() => {
            $('#spnner').show();

            var fullname, bname, pname, mname, proname, sterm, eterm;

            $.ajax({
                url:"{{route('ListofBarangayOfficialsFilter')}}",
                type:'post',
                processData:false,
                contentType:false,
                
                data:fd,
                success:function(data)
                {
                   
                    $('#data-table-default').DataTable().rows().remove().draw();

                    data.map(value=> { 

                        fullname = value.Fullname;
                        bname = value.BARANGAY_NAME;
                        pname = value.POSITION_NAME;
                                                          
                        sterm = value.Start_Term;
                        eterm = value.End_Term;
                        

                        $("#data-table-default").DataTable().row.add
                        (
                            [
                            fullname,
                            bname,
                            pname,
                           
                            sterm,
                            eterm
                            
                            ]
                            ).draw();
                    }) 

                    resolve();
                }
                ,error:function(){
                    reject('something went wrong')
                }
            })
        });
    });
    
    
}
</script>
@endsection



@section('table-js')

<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>


<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{asset('assets/plugins/highlight/highlight.common.js')}}"></script>
<script src="{{asset('assets/js/demo/render.highlight.js')}}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->


@endsection

@section('page-js')

@if (Request::ajax())
@section('page-init-table') @show
@section('page-init-app') @stop

@else
@section('page-init-app') @show
@section('table-js') @show

@endif


@endsection

@section('content')

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Queries and Reports</a></li>
        
        <li class="breadcrumb-item active">List of Barangay Officials</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">List of Barangay Officials<br><small>You can filter Barangay Officials reports.</small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div >
        <form method="POST" action="{{route('ListofBarangayOfficialsPrint')}}" >
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-2 col-md-6">
                    <div class="stats-content">
                        <label style="display: block; text-align: left">Position Name</label>

                        <select class="form-control" data-style="btn-lime" id="editcstatus" name="editcstatus">
                            <option id="All">All</option>
                            @foreach($position_name as $key => $pos_name)
                            <option id ="{{ $key }}">{{ $pos_name }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="stats-content">
                     <label for="lastname">&nbsp</label><span id="lbllastname"></span>
                     <button type="submit" class='btn btn-lime form-control' >
                        <i class='fa fa-print'></i> print
                    </button>
                </div>
            </div>
            <div class="stats-content">
             <label for="filter">&nbsp</label><span id="filter"></span>
             <a id="filterbtn" href="javascript:;" class='btn btn-primary form-control' >
                <i class='fa fa-redo'></i> filter
            </a>
            
            
        </div>
        <div class="panel-body">
            <div class="fa-3x" style="display: none; "id="spnner">
                <i class="fas fa-spinner fa-spin" style="color: black"></i>
                                <!-- <i class="fas fa-circle-notch fa-spin"></i>
                                <i class="fas fa-sync fa-spin"></i>
                                <i class="fas fa-cog fa-spin"></i>
                                <i class="fas fa-spinner fa-pulse"></i> -->
                            </div>
                        </div>
                        
                    </div>
                    
                </form>


                <br><br>
                <!-- begin col-10 -->
                <div><br>
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                            </div>
                            <h4 class="panel-title">Officials</h4>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin alert -->
                        <div class="alert alert-yellow fade show">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            Residents Records groups all the forms being issued by the barangay.
                        </div>
                        <!-- end alert -->
                        <!-- begin panel-body -->
                        <div class="panel-body">


                            <br>
                            
                            <!-- begin row -->
                            <div class="row">
                                <!-- begin col-6 -->
                                <div class="col-lg-12">
                                    <!-- begin nav-pills -->


                                    <div class="tab-content">
                                        <!-- begin tab-pane -->
                                        <div class="tab-pane fade active show" id="nav-pills-tab-1">


                                           <!-- end row -->
                                           <div id="LoadTable">
                                           <table id="data-table-default" class="table table-striped table-bordered display compact" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        
                                                        <th style="text-align: left">Full Name </th>
                                                        <th style="text-align: left">Barangay Name </th>
                                                        <th style="text-align: left">Position Name</th>

                                                        <th style="text-align: left">Start Term </th>
                                                        <th style="text-align: left">End Term </th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach( $DisplayTable as $basicinfo )
                                                    <tr>
                                                        
                                                        <td style="text-align: left; background-color: {{ $basicinfo->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{$basicinfo->Fullname}}</td>
                                                        <td style="text-align: left; background-color: {{ $basicinfo->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{$basicinfo->BARANGAY_NAME}}</td>
                                                        <td style="text-align: left; background-color: {{ $basicinfo->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{$basicinfo->POSITION_NAME}}</td>

                                                        <td style="text-align: left; background-color: {{ $basicinfo->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{$basicinfo->Start_Term}}</td>
                                                        <td style="text-align: left; background-color: {{ $basicinfo->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}">{{$basicinfo->End_Term}}</td>
                                                        
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

                        <!-- end row -->
                    </div>
                    <div>
                        @endsection

                        