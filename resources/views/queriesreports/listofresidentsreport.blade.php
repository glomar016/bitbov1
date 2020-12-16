 
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
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val(); 
        var fd =  new FormData();

        
        fd.append('editcstatus', status);
        fd.append('fromdate', fromdate);
        fd.append('todate', todate);
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

            var lname, fname, mname, quali, sex, dob, cstatus, occu, wstatus, active_flag, status_name, fullname;

                $.ajax({
                    url:"{{route('ResidentsFilter')}}",
                    type:'post',
                    processData:false,
                    contentType:false,
                   
                    data:fd,
                    success:function(data)
                    {
                     
                        $('#data-table-default').DataTable().rows().remove().draw();

                        data.map( value=> {

                        lname = value.LASTNAME;
                        fname = value.FIRSTNAME;
                        mname = value.MIDDLENAME;
                       // quali = value.QUALIFIER;
                        sex = value.SEX;                                        
                        dob = value.DATE_OF_BIRTH;
                        cstatus = value.CIVIL_STATUS;
                        occu = value.OCCUPATION;
                        wstatus = value.WORK_STATUS;
                        active_flag = value.ACTIVE_FLAG;
                        fullname = lname + ' ' + fname + ' ' + mname;
                        if (active_flag == 1) { status_name = 'Active'} else { status_name = 'Deactivated'}

                        // var fullnames = "<td style='text-align: left; background-color: #ddefc9'>.fullname.</td>"
                        $("#data-table-default").DataTable().row.add
                        (
                            [
                                fullname,
                              //  quali,
                                sex,
                                dob,
                                cstatus,
                                occu,
                                wstatus,
                                status_name
                               
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
        
        <li class="breadcrumb-item active">List of Residents</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">List of Residents<br><small>You can filter residents reports.</small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div >
        <form method="POST" action="{{route('ResidentFilterPrint')}}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-2 col-md-6">
                    <div class="stats-content">
                        <label style="display: block; text-align: left">     &nbspCivil Status</label>

                        <select class="form-control" data-style="btn-lime" id="editcstatus" name="editcstatus">
                            <option value="All" selected>All</option>
                            <option value="Single" >Single</option>
                            <option value="Married">Married</option>
                            <option value="Separated">Separated</option>
                            <option value="Widow">Widow</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Annulled">Annulled</option>
                            <option value="Widower">Widower</option>
                            <option value="Single Parent">Single Parent</option>
                        </select>
                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="stats-content">
                        <label style="display: block; text-align: left">     &nbspFrom Date</label>
                        <input type="date" id="fromdate" name="fromdate" class="form-control">
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="stats-content">
                        <label style="display: block; text-align: left">     &nbspTo Date</label>
                        <input type="date" id="todate" name="todate" class="form-control">
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
            <h4 class="panel-title">Residents</h4>
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
                                       
                                       
                                        <th style="text-align: left">Sex </th>
                                        <th style="text-align: left">Birthdate </th>
                                        <th style="text-align: left">Civil Status </th>
                                        <th style="text-align: left">Occupation</th>
                                        <th style="text-align: left">Work Status</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $DisplayTable as $basicinfo )
                                    <tr>
                                        {{--style="text-align: left; background-color: {{ $basicinfo->ACTIVE_FLAG == 1 ? '#ddefc9' : '#ffcdcc'}}--}}
                                        <td style="text-align: left;">{{$basicinfo->LASTNAME}} {{$basicinfo->FIRSTNAME}} {{$basicinfo->MIDDLENAME}}</td>
                                        
                                        <td style="text-align: left;">{{$basicinfo->SEX}}</td>
                                        <td style="text-align: left;">{{$basicinfo->DATE_OF_BIRTH}}</td>
                                        <td style="text-align: left;">{{$basicinfo->CIVIL_STATUS}}</td>
                                        <td style="text-align: left;">{{$basicinfo->OCCUPATION}}</td>
                                        <td style="text-align: left;">{{$basicinfo->WORK_STATUS}}</td>
                                     
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

        