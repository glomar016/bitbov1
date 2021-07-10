 
@extends('global.main')

@section('page-css')

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')}}" rel="stylesheet" />

<!-- ================== END PAGE LEVEL STYLE ================== -->



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
        var active = $('#editactive').val();
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val(); 
        var fd =  new FormData();

        
        fd.append('editcstatus', status);
        fd.append('editactive', active);
        fd.append('fromdate', fromdate);
        fd.append('todate', todate);
        fd.append('_token',"{{ csrf_token() }}");
        let result;


        console.log(fd);
        
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
                url:"{{route('ListofWeightsAndMeasureFilterPrint')}}",
                type:'post',
                processData:false,
                contentType:false,
                
                data:fd,
                success:function(data)
                {
                   
                    $('#data-table-default').DataTable().rows().remove().draw();

                    data.map(value=> { 

                        business_name = value.BI_BUSINESS_NAME;
                        dt = value.DEVICE_TYPE;
                        af = value.WM_ACTIVE_FLAG;
                        device_number = value.DEVICE_NUMBER;
                        let device_type, active_flag;
                                                          
                        capacity = value.CAPACITY;
                        status = value.WM_NEW_RENEW_STATUS;
                        created_at = value.WM_CREATED_AT;
            
                        if(dt == "LM")
                            device_type = 'Linear Measure (Tape Measure, Yardstick, Caliper, Gauge, etc)'
                        else if(dt == "MC")
                            device_type = 'Measure of Capacity (Fuel Dispensing Pump, calibration bucket, etc)'
                        else if(dt == "GS")
                            device_type = 'Graduated Scale Balance (Weighing Scales, etc)'
                        else if(dt == "AB")
                            device_type = 'Apothecary Balances (Mineral and Medicinal Uses)'
                            
                        if(af == 1)
                            active_flag = 'Active'
                        else
                            active_flag = 'Inactive'
                            
                        

                        $("#data-table-default").DataTable().row.add
                        (
                            [
                            business_name,
                            device_type,
                            device_number,
                           
                            capacity,
                            status,
                            created_at,
                            active_flag
                            
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
        
        <li class="breadcrumb-item active">List of Weights and Measure</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">List of Weights and Measure<br><small>You can filter weights and measure reports.</small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div >
        <form method="POST" action="{{route('ListofWeightsAndMeasurePrint')}}" >
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-2 col-md-6">
                    <div class="stats-content">
                        <label style="display: block; text-align: left">Status</label>
                        
                        <select class="form-control" data-style="btn-lime" id="editcstatus" name="editcstatus">
                            <option id="All">All</option>
                            <option id="New">New</option>
                            <option id="Renew">Renew</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="stats-content">
                        <label style="display: block; text-align: left">Active/Inactive</label>
                        
                        <select class="form-control" data-style="btn-lime" id="editactive" name="editactive">
                            <option value="All">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
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
                <div class="col-lg-2">
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
                            <h4 class="panel-title">Weights and Measure</h4>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin alert -->
                        <!-- <div class="alert alert-yellow fade show">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            Residents Records groups all the forms being issued by the barangay.
                        </div> -->
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
                                                        
                                                        <th style="text-align: left">Business Name </th>
                                                        <th style="text-align: left">Device Type</th>
                                                        <th style="text-align: left">Device Number</th>

                                                        <th style="text-align: left">Capacity</th>
                                                        <th style="text-align: left">Status</th>
                                                        <th style="text-align: left">Date Registered</th>
                                                        <th style="text-align: left">Active/Inactive</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach( $weights_and_measure_list as $wmInfo )
                                                    <tr>
                                                        
                                                        <td style="text-align: left;">{{$wmInfo->BUSINESS_NAME}}</td>
                                                        <td style="text-align: left;">
                                                        
                                                        @if($wmInfo->DEVICE_TYPE == "LM")
                                                        Linear Measure (Tape Measure, Yardstick, Caliper, Gauge, etc)
                                                        @elseif($wmInfo->DEVICE_TYPE == "MC")
                                                        Measure of Capacity (Fuel Dispensing Pump, calibration bucket, etc) 
                                                        @elseif($wmInfo->DEVICE_TYPE == "GS")
                                                        Graduated Scale Balance (Weighing Scales, etc)
                                                        @elseif($wmInfo->DEVICE_TYPE == "AB")
                                                        Apothecary Balances (Mineral and Medicinal Uses)
                                                        @else
                                                        @endif
                                                        
                                                        </td>
                                                        <td style="text-align: left;">{{$wmInfo->DEVICE_NUMBER}}</td>

                                                        <td style="text-align: left;">{{$wmInfo->CAPACITY}}</td>
                                                        <td style="text-align: left;">{{$wmInfo->WM_NEW_RENEW_STATUS}}</td>
                                                        <td style="text-align: left;">{{$wmInfo->WM_CREATED_AT}}</td>
                                                        <td style="text-align: left;">
                                                        @if($wmInfo->WM_ACTIVE_FLAG == 1)
                                                        Active
                                                        @elseif($wmInfo->WM_ACTIVE_FLAG == 0)
                                                        Inactive
                                                        @else
                                                        @endif
                                                        </td>
                                                        
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

                        