@extends('global.main')

@section('page-js')
<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });

    </script>
@endsection

@section('title', "BitBo | Dashboard")

@section ('content')

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{asset('assets/code/highcharts.js')}}"></script>
    <script src="{{asset('assets/code/modules/data.js')}}"></script>
    <script src="{{asset('assets/code/modules/drilldown.js')}}"></script>
    <script src="{{asset('assets/code/modules/exporting.js')}}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->


    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        </ol>
        <!-- end breadcrumb -->

        <!-- begin page-header -->
        <h1 class="page-header">Dashboard </h1>
        <!-- end page-header -->

        <!-- begin row -->

        <div class="row">
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-stats bg-blue">
                    <div class="stats-icon"><i class="fas fa-users"></i></div>
                    <div class="stats-info">
                        <h4>Total Residents</h4>
                        <p>{{$get_total_residents}}</p>
                        
                    </div>
                    
                    <div class="stats-link">
                      <a href="javascript:;" data-toggle='modal' data-target='#ResidentsModal'>View Details <i class="fa fa-arrow-alt-circle-right"></i></a> 
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-stats bg-yellow">
                    <div class="stats-icon"><i class="fas fa-users"></i></div>
                    <div class="stats-info">
                        <h4>Total Household</h4>
                        <p>{{$get_total_household}}</p>
                        
                    </div>
                    
                    <div class="stats-link">
                      <a href="javascript:;" data-toggle='modal' data-target='#HouseholdModal'>View Details <i class="fa fa-arrow-alt-circle-right"></i></a> 
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-stats bg-green">
                    <div class="stats-icon"><i class="fas fa-building"></i></div>
                    <div class="stats-info">
                        <h4>Total Businesses</h4>
                        <p>{{$get_total_businesses}}</p>
                    </div>
                    <div class="stats-link">
                   
                         <a href="javascript:;" data-toggle='modal' data-target='#BusinessesModal'>View Details <i class="fa fa-arrow-alt-circle-right"></i></a> 
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-stats  bg-red">
                    <div class="stats-icon"><i class="fas fa-gavel"></i></div>
                    <div class="stats-info">
                        <h4>Blotter Cases</h4>
                        <p>{{$get_total_blotters}}</p>
                    </div>
                    <div class="stats-link">
                         <a href="javascript:;" data-toggle='modal' data-target='#BlottersModal'>View Details <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-stats  bg-orange">
                    <div class="stats-icon"><i class="fa fa-file-alt"></i></div>
                    <div class="stats-info">
                        <h4>Ordinances</h4>
                        <p>{{$get_total_ordinances}}</p>
                    </div>
                    <div class="stats-link">
                    <a href="{{route('Ordinance')}}" >View Ordinances <i class="fa fa-arrow-alt-circle-right"></i></a>
                   </div>
                    {{-- <div class="stats-link">
                      <a href="javascript:;" data-toggle='modal' data-target='#OrdinancesModal'>View Details <i class="fa fa-arrow-alt-circle-right"></i></a> 
                    </div> --}}
                </div>
            </div>
            <!-- end col-3 -->
        </div>
        <!-- end row -->

        <!-- population dashboard start -->        
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="population" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
        </div>
        <!-- population dashboard end -->
        <script type="text/javascript">
            var date = new Date();
            var year = date.getFullYear();

            var colors = ['#3B97B2', '#67BC42', '#FF56DE', '#E6D605', '#BC36FE', '#000'];
           Highcharts.chart('population', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Population as of ' + year
            },
           
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total Population'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:f}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> of total<br/>'
            },

            "series": [
                {

                    "name": "Gender",
                    "colorByPoint": true,
                    "data": [
                         <?php 
                                $get_males = db::table('t_resident_basic_info')
                                ->where('SEX','Male')
                                ->select(db::raw('YEAR(CREATED_AT) AS N_YEAR_CREATED'),
                                    db::raw('COUNT(RESIDENT_ID) as Male'))
                                ->groupBy(db::raw('YEAR(CREATED_AT)'))->get();
                            ?>
                            @foreach($get_males as $val)
                            {
                                "name": "Male",
                                "y": {{$val->Male}},
                                "drilldown": "Male"
                                
                            },
                            @endforeach

                       <?php 
                                 $get_females = db::table('t_resident_basic_info')
                                ->where('SEX','Female')
                                ->select(db::raw('YEAR(CREATED_AT) AS N_YEAR_CREATED'),
                                    db::raw('COUNT(RESIDENT_ID) as Female'))
                                ->groupBy(db::raw('YEAR(CREATED_AT)'))->get();
                            ?>
                            @foreach($get_females as $val)
                            {
                                "name": "Female",
                                "y": {{$val->Female}},
                                "color": colors[2],
                                "drilldown": "Female"
                            },
                            @endforeach
                       
                    ]
                }
            ],
           

        });
    
        </script>
        <!-- illness dashboard start -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="illness" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
        </div>
        <!-- illness dashboard end -->

        <!-- <div class="panel panel-default">
            <div class="panel-body">
                <div id="population-by-age" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
        </div> -->













        <!-- #modal-START VIEW RESIDENT DETAILS DASHBOARD -->
        <div class="modal fade" id="ResidentsModal">
            <div class="modal-dialog" style="max-width: 80%">
                <form id="AddForm" method="POST">
                    @csrf

                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#348fe2;">
                            <h4 class="modal-title" style="color: white">Residents More Details</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                        </div>
                        <div class="modal-body">
                           {{--modal body start--}}
                           <div id="container-residents" style="min-width: 310px; max-width: 1000px; height: 400px; margin: 0 auto"></div>
                           <div id="container-residents-employment" style="min-width: 310px; max-width: 1000px; height: 400px; margin: 0 auto"></div>
                           <div id="container-residents-fp-nfp" style="min-width: 310px; max-width: 1000px; height: 400px; margin: 0 auto"></div>





                       <script type="text/javascript">

                        Highcharts.chart('container-residents', {
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Residents\' Population by Category'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {

                                categories: ['OFW', 'Indigenous', 'Senior'],

                                title: {
                                    text: null
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Population',
                                    align: 'high'
                                },
                                labels: {
                                    overflow: 'justify'
                                }
                            },
                            tooltip: {
                                valueSuffix: ''
                            },
                            plotOptions: {
                                bar: {
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'top',
                                x: -40,
                                y: 80,
                                floating: true,
                                borderWidth: 1,
                                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                shadow: true
                            },
                            credits: {
                                enabled: false
                            },
                            series: [
                            <?php
                                $get_years_resident = DB::table('t_resident_basic_info')->select(DB::raw('Year(CREATED_AT) AS YEARS'))->groupBy(DB::raw('Year(CREATED_AT)'))->get();
                            ?>    
                            @foreach($get_years_resident as $value)
                            {
                                name: 'Year {{$value->YEARS}}',

                                data: [
                                    <?php
                                        $get_count_ofw_residents = DB::table('t_resident_basic_info')->where('IS_OFW',1)->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_indigenous_residents = DB::table('t_resident_basic_info')->where('IS_INDIGENOUS',1)->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_senior_residents = DB::table('t_resident_basic_info')->where(DB::raw(' YEAR(CURRENT_DATE) - YEAR(DATE_OF_BIRTH)'),'>=',60)->count();
                                    ?>    
                                    {{$get_count_ofw_residents}},
                                    {{$get_count_indigenous_residents}}, 
                                    {{$get_count_senior_residents}}
                                    ]
                            },
                            @endforeach
                           ]
                        });







                        
                        Highcharts.chart('container-residents-employment', {
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Residents\' Population by Employment Status'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {

                                categories: ['Employed', 'Unemployed'],

                                title: {
                                    text: null
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Population',
                                    align: 'high'
                                },
                                labels: {
                                    overflow: 'justify'
                                }
                            },
                            tooltip: {
                                valueSuffix: ''
                            },
                            plotOptions: {
                                bar: {
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'top',
                                x: -40,
                                y: 80,
                                floating: true,
                                borderWidth: 1,
                                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                shadow: true
                            },
                            credits: {
                                enabled: false
                            },
                            series: [
                            <?php
                                $get_years_resident = DB::table('t_resident_basic_info')->select(DB::raw('Year(CREATED_AT) AS YEARS'))->groupBy(DB::raw('Year(CREATED_AT)'))->get();
                            ?>    
                            @foreach($get_years_resident as $value)
                            {
                                name: 'Year {{$value->YEARS}}',

                                data: [
                                    <?php
                                        $get_count_employed = DB::table('t_resident_basic_info')->where('EMPLOYMENT_STATUS','Employed')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_unemployed = DB::table('t_resident_basic_info')->where('EMPLOYMENT_STATUS','!=','Employed')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        
                                    ?>    
                                    {{$get_count_employed}},
                                    {{$get_count_unemployed}}, 
                                    
                                    ]
                            },
                            @endforeach
                           ]
                        });



                        




                        
                        
                        Highcharts.chart('container-residents-fp-nfp', {
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Residents Population by Family Planning Users/Non Users'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {

                                categories: [' Users', 'Non Users'],

                                title: {
                                    text: null
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Population',
                                    align: 'high'
                                },
                                labels: {
                                    overflow: 'justify'
                                }
                            },
                            tooltip: {
                                valueSuffix: ''
                            },
                            plotOptions: {
                                bar: {
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'top',
                                x: -40,
                                y: 80,
                                floating: true,
                                borderWidth: 1,
                                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                shadow: true
                            },
                            credits: {
                                enabled: false
                            },
                            series: [
                            <?php
                                $get_years_resident = DB::table('t_resident_basic_info')->select(DB::raw('Year(CREATED_AT) AS YEARS'))->groupBy(DB::raw('Year(CREATED_AT)'))->get();
                            ?>    
                            @foreach($get_years_resident as $value)
                            {
                                name: 'Year {{$value->YEARS}}',

                                data: [
                                    <?php
                                        $get_count_fp = DB::table('t_hs_family_planning')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_nfp = DB::table('t_hs_non_family_planning_users')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        
                                    ?>    
                                    {{$get_count_fp}},
                                    {{$get_count_nfp}}, 
                                    
                                    ]
                            },
                            @endforeach
                           ]
                        });




















                                </script>
                        {{--modal body end--}}
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" id="AddCloseBtn" data-dismiss="modal">Close</a>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- #modal-END VIEW RESIDENT DETAILS DASHBOARD -->






<!-- #modal-START VIEW HOUSEHOLD DETAILS DASHBOARD -->
<div class="modal fade" id="HouseholdModal">
            <div class="modal-dialog" style="max-width: 80%">
                <form id="AddForm" method="POST">
                    @csrf

                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#348fe2;">
                            <h4 class="modal-title" style="color: white">Housing More Details</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                        </div>
                        <div class="modal-body">
                           {{--modal body start--}}
                           <div id="container-build-materials" style="min-width: 310px; max-width: 1000px; height: 400px; margin: 0 auto"></div>
                           
                           
                           





                       <script type="text/javascript">

                        Highcharts.chart('container-build-materials', {
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Total Count of Residents By Building Materials'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {

                                categories: ['Nipa', 'Wood', 'Concrete'],

                                title: {
                                    text: null
                                }
                            },
                            yAxis: {
                                min: 0,
                                allowDecimals:false,
                                title: {
                                    text: 'Count',
                                    align: 'high'
                                },
                                labels: {
                                    overflow: 'justify'                                    
                                },
                            
                            },
                            tooltip: {
                                valueSuffix: ''
                            },
                            plotOptions: {
                                bar: {
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'top',
                                x: -40,
                                y: 80,
                                floating: true,
                                borderWidth: 1,
                                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                shadow: true
                            },
                            credits: {
                                enabled: false
                            },
                            series: [
                            <?php
                                $get_years_resident = DB::table('t_resident_basic_info')->select(DB::raw('Year(CREATED_AT) AS YEARS'))->groupBy(DB::raw('Year(CREATED_AT)'))->get();
                            ?>    
                            @foreach($get_years_resident as $value)
                            {
                                name: 'Year {{$value->YEARS}}',

                                data: [
                                    <?php
                                        $get_count_nipa = DB::table('t_household_information')->where('HOME_MATERIALS','nipa')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_wood = DB::table('t_household_information')->where('HOME_MATERIALS','wood')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_concrete = DB::table('t_household_information')->where('HOME_MATERIALS','concrete')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                    ?>    
                                    {{$get_count_nipa}},
                                    {{$get_count_wood}}, 
                                    {{$get_count_concrete}}
                                    ]
                            },
                            @endforeach
                           ]
                        });







                        
                        Highcharts.chart('container-residents-employment', {
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Residents\' Population by Employment Status'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {

                                categories: ['Employed', 'Unemployed'],

                                title: {
                                    text: null
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Population',
                                    align: 'high'
                                },
                                labels: {
                                    overflow: 'justify'
                                }
                            },
                            tooltip: {
                                valueSuffix: ''
                            },
                            plotOptions: {
                                bar: {
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'top',
                                x: -40,
                                y: 80,
                                floating: true,
                                borderWidth: 1,
                                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                shadow: true
                            },
                            credits: {
                                enabled: false
                            },
                            series: [
                            <?php
                                $get_years_resident = DB::table('t_resident_basic_info')->select(DB::raw('Year(CREATED_AT) AS YEARS'))->groupBy(DB::raw('Year(CREATED_AT)'))->get();
                            ?>    
                            @foreach($get_years_resident as $value)
                            {
                                name: 'Year {{$value->YEARS}}',

                                data: [
                                    <?php
                                        $get_count_employed = DB::table('t_resident_basic_info')->where('EMPLOYMENT_STATUS','Employed')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_unemployed = DB::table('t_resident_basic_info')->where('EMPLOYMENT_STATUS','!=','Employed')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        
                                    ?>    
                                    {{$get_count_employed}},
                                    {{$get_count_unemployed}}, 
                                    
                                    ]
                            },
                            @endforeach
                           ]
                        });  
                                </script>
                        {{--modal body end--}}
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" id="AddCloseBtn" data-dismiss="modal">Close</a>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- #modal-END VIEW HOUSEHOLD DETAILS DASHBOARD -->






     <!-- #modal-START VIEW BUSINESSES DETAILS DASHBOARD -->
     <div class="modal fade" id="BusinessesModal">
        <div class="modal-dialog" style="max-width: 80%">
            <form id="AddForm" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header" style="background-color:#00acac;">
                        <h4 class="modal-title" style="color: white">Businesses More Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                    </div>
                    <div class="modal-body">
                       {{--modal body start--}}
                        



                        
                       <div id="container-businesses" style="min-width: 310px; max-width: 1000px; height: 400px; margin: 0 auto"></div>
                       <script type="text/javascript">

                        Highcharts.chart('container-businesses', {
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Total Number of Businesses By Nature'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                
                                categories: [
                                    <?php
                                            $get_business_nature = DB::table('r_business_nature')->select('BUSINESS_NATURE_NAME')->where('ACTIVE_FLAG',1)->get();
                                    ?>    
                                    @foreach($get_business_nature as $value)
                                    '{{$value->BUSINESS_NATURE_NAME}}',
                                     
                                    @endforeach
                                     ],
                                    
                                title: {
                                    text: null
                                }
                            },
                            yAxis: {
                                min: 0,
                                allowDecimals:false,
                                title: {
                                    text: 'Count',
                                    align: 'high'
                                },
                                labels: {
                                    overflow: 'justify'
                                }
                            },
                            tooltip: {
                                valueSuffix: ''
                            },
                            plotOptions: {
                                bar: {
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'top',
                                x: -40,
                                y: 80,
                                floating: true,
                                borderWidth: 1,
                                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                shadow: true
                            },
                            credits: {
                                enabled: false
                            },
                            series: [
                            <?php
                                $get_years_businesses = DB::table('t_business_information')->select(DB::raw('Year(CREATED_AT) AS YEARS'))->groupBy(DB::raw('Year(CREATED_AT)'))->get();
                            ?>    

                          
                            
                            @foreach($get_years_businesses   as $value)
                        

                            {
                                name: 'Year {{$value->YEARS}}',

                                data: [
                                    @foreach($get_business_nature as $val) 
                                    <?php
                                        $get_count_nature_businesses = DB::table('t_business_information')                                                                        
                                                                        ->join('r_business_nature', 'r_business_nature.BUSINESS_NATURE_ID', 't_business_information.BUSINESS_NATURE_ID')
                                                                        ->where('r_business_nature.BUSINESS_NATURE_NAME',$val->BUSINESS_NATURE_NAME)
                                                                        ->where(DB::raw('Year(t_business_information.CREATED_AT)'),$value->YEARS)
                                                                        ->count();
                                    ?>    
                                    {{$get_count_nature_businesses}},
                                    @endforeach
                                    ]
                            },
                        
                            @endforeach
                        
                           ]
                        });
                                </script>
                    {{--modal body end--}}
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" id="AddCloseBtn" data-dismiss="modal">Close</a>
                    
                </div>
            </div>
        </form>
    </div>
</div>
<!-- #modal-END VIEW BUSINESSES DETAILS DASHBOARD -->








<!-- #modal-START VIEW BLOTTER DETAILS DASHBOARD -->
     <div class="modal fade" id="BlottersModal">
        <div class="modal-dialog" style="max-width: 80%">
            <form id="AddForm" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header" style="background-color:#ff5b57;">
                        <h4 class="modal-title" style="color: white">Blotters More Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                    </div>
                    <div class="modal-body">
                       {{--modal body start--}}                     
                       <div id="container-blotters" style="min-width: 310px; max-width: 1000px; height: 400px; margin: 0 auto"></div>
                       <script type="text/javascript">

                        Highcharts.chart('container-blotters', {
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Total Number of Blotter Cases By Subject'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {

                                categories: [
                                    <?php
                                            $get_blotter_subject = DB::table('r_blotter_subjects')->select('BLOTTER_NAME')->where('ACTIVE_FLAG',1)->get();
                                    ?>    
                                    @foreach($get_blotter_subject as $value)
                                    '{{$value->BLOTTER_NAME}}',
                                     
                                    @endforeach
                                     ],

                                title: {
                                    text: null
                                }
                            },
                            yAxis: {
                                min: 0,
                                allowDecimals:false,
                                title: {
                                    text: 'Count',
                                    align: 'high'
                                },
                                labels: {
                                    overflow: 'justify'
                                }
                            },
                            tooltip: {
                                valueSuffix: ''
                            },
                            plotOptions: {
                                bar: {
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            legend: {
                                layout: 'horizontal',
                                align: 'right',
                                verticalAlign: 'top',
                                x: -20,
                                y: 80,
                                floating: true,
                                borderWidth: 1,
                                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                shadow: true
                            },
                            credits: {
                                enabled: false
                            },
                            series: [
                            <?php
                                $get_years_blotter_cases = DB::table('t_blotter')->select(DB::raw('YEAR(COMPLAINT_DATE) as YEAR_CREATED'),DB::raw('COUNT(BLOTTER_ID) as COUNT_BLOTTER'))->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->get();
                            ?>    

                          
                            
                            @foreach($get_years_blotter_cases   as $value)
                        

                            {
                                name: 'Year {{$value->YEAR_CREATED}}',

                                data: [
                                    @foreach($get_blotter_subject as $val) 
                                    <?php
                                        $get_count_nature_businesses = DB::table('t_blotter')                                                                        
                                                                        ->join('r_blotter_subjects', 'r_blotter_subjects.BLOTTER_SUBJECT_ID', 't_blotter.BLOTTER_SUBJECT_ID')
                                                                        ->where('r_blotter_subjects.BLOTTER_NAME',$val->BLOTTER_NAME)
                                                                        ->where(DB::raw('Year(COMPLAINT_DATE)'),$value->YEAR_CREATED)
                                                                        ->count();
                                    ?>    
                                    {{$get_count_nature_businesses}},
                                    @endforeach
                                    ]
                            },
                        
                            @endforeach
                        
                           ]
                        });
                                </script>
                    {{--modal body end--}}
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" id="AddCloseBtn" data-dismiss="modal">Close</a>
                    
                </div>
            </div>
        </form>
    </div>
</div>
<!-- #modal-END VIEW BLOTTER DETAILS DASHBOARD -->







    <div class="panel panel-default">
            <div class="panel-body">
                <div id="population-by-age" style="min-width: 310px; height: 400px; margin: 0 auto"></div>            
                       <script type="text/javascript">
                        Highcharts.chart('population-by-age', {
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Residents\' Population by Age Range'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {

                                categories: ['Newborn (0-28 Days)', 'Infant (29 Days to 11 Months)','Child (1 Year Old  to 10 Years Old)','Adolescent (11 Years Old to 19 Years Old)','Elderly (60 Years Old and Above )'],
                                title: {
                                    text: null
                                }
                            },
                            yAxis: {
                                min: 0,
                                allowDecimals:false,
                                title: {
                                    text: 'Population',
                                    align: 'high'
                                },
                                labels: {
                                    overflow: 'justify'
                                }
                            },
                            tooltip: {
                                valueSuffix: ''
                            },
                            plotOptions: {
                                bar: {
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'top',
                                x: -40,
                                y: 80,
                                floating: true,
                                borderWidth: 1,
                                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                shadow: true
                            },
                            credits: {
                                enabled: false
                            },
                            series: [
                            <?php
                                $get_years_resident = DB::table('t_resident_basic_info')->select(DB::raw('Year(CREATED_AT) AS YEARS'))->groupBy(DB::raw('Year(CREATED_AT)'))->limit(5)->get();
                            ?>    
                            @foreach($get_years_resident as $value)
                            {
                                name: 'Year {{$value->YEARS}}',

                                data: [
                                    <?php
                                        $get_count_newborn    = DB::table('t_hs_newborn')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_infant     = DB::table('t_hs_infant')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_child      = DB::table('t_hs_child')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_Adolescent = DB::table('t_hs_adolescent')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_Elderly    = DB::table('t_hs_elderly')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                    ?>    
                                    {{$get_count_newborn}},
                                    {{$get_count_infant}}, 
                                    {{$get_count_child}}, 
                                    {{$get_count_Adolescent}}, 
                                    {{$get_count_Elderly}}
                                    
                                    ]
                            },
                            @endforeach
                           ]
                        });  
                                </script>
                        
            </div>
        </div>







        <div class="panel panel-default">
            <div class="panel-body">
                <div id="population-by-civil-status" style="min-width: 310px; height: 400px; margin: 0 auto"></div>            
                       <script type="text/javascript">
                        Highcharts.chart('population-by-civil-status', {
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Residents\' Population by Civil Status'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {

                                categories: ['Single', 'Married','Separated','Widow','Divorced','Annulled','Widower'],
                                title: {
                                    text: null
                                }
                            },
                            yAxis: {
                                min: 0,
                                allowDecimals:false,
                                title: {
                                    text: 'Population',
                                    align: 'high'
                                },
                                labels: {
                                    overflow: 'justify'
                                }
                            },
                            tooltip: {
                                valueSuffix: ''
                            },
                            plotOptions: {
                                bar: {
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'top',
                                x: -40,
                                y: 80,
                                floating: true,
                                borderWidth: 1,
                                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                shadow: true
                            },
                            credits: {
                                enabled: false
                            },
                            series: [
                            <?php
                                $get_years_resident = DB::table('t_resident_basic_info')->select(DB::raw('Year(CREATED_AT) AS YEARS'))->groupBy(DB::raw('Year(CREATED_AT)'))->limit(5)->get();
                            ?>    
                            @foreach($get_years_resident as $value)
                            {
                                name: 'Year {{$value->YEARS}}',

                                data: [
                                    <?php
                                        $get_count_single    = DB::table('t_resident_basic_info')->where('CIVIL_STATUS','Single')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_married   = DB::table('t_resident_basic_info')->where('CIVIL_STATUS','Married')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_separated = DB::table('t_resident_basic_info')->where('CIVIL_STATUS','Separated')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_widow     = DB::table('t_resident_basic_info')->where('CIVIL_STATUS','Widowed')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_divorced  = DB::table('t_resident_basic_info')->where('CIVIL_STATUS','Divorced')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_annulled  = DB::table('t_resident_basic_info')->where('CIVIL_STATUS','Annulled')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                        $get_count_widower   = DB::table('t_resident_basic_info')->where('CIVIL_STATUS','Widower')->where(DB::raw('Year(CREATED_AT)'),$value->YEARS)->count();
                                    ?>    
                                    {{$get_count_single}},
                                    {{$get_count_married}}, 
                                    {{$get_count_widow}}, 
                                    {{$get_count_divorced}}, 
                                    {{$get_count_annulled}},
                                    {{$get_count_widower}}
                                    
                                    ]
                            },
                            @endforeach
                           ]
                        });  
                                </script>
                        
            </div>
        </div>



<!-- #modal-START VIEW ORDINANCE DETAILS DASHBOARD -->
//      <div class="modal fade" id="OrdinancesModal">
//         <div class="modal-dialog" style="max-width: 80%">
//             <form id="AddForm" method="POST">
//                 @csrf

//                 <div class="modal-content">
//                     <div class="modal-header" style="background-color:#f59c1a;">
//                         <h4 class="modal-title" style="color: white">Ordinance More Details</h4>
//                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
//                     </div>
//                     <div class="modal-body">
//                        {{--modal body start--}}                     
//                        <div id="container-ordinances" style="min-width: 310px; max-width: 1000px; height: 400px; margin: 0 auto"></div>
//                        <script type="text/javascript">

//                         Highcharts.chart('container-ordinances', {
//                             chart: {
//                                 type: 'bar'
//                             },
//                             title: {
//                                 text: 'Total Number of Ordinances By Category'
//                             },
//                             subtitle: {
//                                 text: ''
//                             },
//                             xAxis: {

//                                 categories: [




//                                      ],

//                                 title: {
//                                     text: null
//                                 }
//                             },
//                             yAxis: {
//                                 min: 0,
//                                 allowDecimals:false,
//                                 title: {
//                                     text: 'Count',
//                                     align: 'high'
//                                 },
//                                 labels: {
//                                     overflow: 'justify'
//                                 }
//                             },
//                             tooltip: {
//                                 valueSuffix: ''
//                             },
//                             plotOptions: {
//                                 bar: {
//                                     dataLabels: {
//                                         enabled: true
//                                     }
//                                 }
//                             },
//                             legend: {
//                                 layout: 'horizontal',
//                                 align: 'right',
//                                 verticalAlign: 'top',
//                                 x: -20,
//                                 y: 80,
//                                 floating: true,
//                                 borderWidth: 1,
//                                 backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
//                                 shadow: true
//                             },
//                             credits: {
//                                 enabled: false
//                             },
//                             series: [


                          
                 
                        
//                            ]
//                         });
//                                 </script>
//                     {{--modal body end--}}
//                 </div>
//                 <div class="modal-footer">
//                     <a href="javascript:;" class="btn btn-white" id="AddCloseBtn" data-dismiss="modal">Close</a>
                    
//                 </div>
//             </div>
//         </form>
//     </div>
// </div>
<!-- #modal-END VIEW ORDINANCE DETAILS DASHBOARD -->


<script type="text/javascript">
    
Highcharts.chart('illness', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Population of Residents Base on Illnesses'
    },

    xAxis: {
                            
        
        categories: [
                    @foreach($get_years_resident as $value)
                    '{{$value->YEARS}}', 
                    @endforeach
        ]
    },
    yAxis: {
        allowDecimals:false,
        title: {
            text: 'Illness'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: true
        }
    },
    series: [
        @foreach($get_years_resident as $value)
        @php
                $get_count_chronic_cough = 0;
                $get_count_chronic_disease = 0;
                $chronic_cough_count = DB::TABLE('t_hs_chronic_cough')->WHERE(DB::RAW('Year(CREATED_AT)'),$value->YEARS)->groupBy('RESIDENT_ID')->COUNT();
                $chronic_disease_count = DB::TABLE('t_hs_chronic_disease')->WHERE(DB::RAW('Year(CREATED_AT)'),$value->YEARS)->groupBy('RESIDENT_ID')->COUNT();
                
                
                     if ($chronic_cough_count != 0)
                    {
                        $get_count_chronic_cough = $chronic_cough_count;
                    }
                    else
                    {
                        $get_count_chronic_cough = 0;

                    }
                    if ($chronic_disease_count != 0)
                    {
                        $get_count_chronic_disease = $chronic_disease_count ;
                    }
                    else
                    {
                        $get_count_chronic_disease = 0;

                    }
                
        @endphp
        {
        name: 'Chronic Cough',
        data: [
            
                {{round($get_count_chronic_cough, 2)}}
                
            ]
    }, {
        name: 'Chronic Disease',
        data: [
            
            {{round($get_count_chronic_disease, 2)}}
            
        ]
    },
    
        @endforeach
    ]
});
</script>







        <!-- end chart-->

        <!-- end chart-->
        
        <!-- <div class="panel panel-default">
            <div class="row">
                <div class="col-lg-6">
                    <div id="drillpie" style="min-width: 310px; max-width: 600px; height: 400px; margin: 0 auto"></div>
                </div>
                <script type="text/javascript">

                    // Create the chart
                    Highcharts.chart('drillpie', {
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: 'Businesses In Every Zone'
                        },
                        subtitle: {
                            text: 'Click the slices to view businesses.'
                        },
                        plotOptions: {
                            series: {
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.name}: {point.y:.1f}%'
                                }
                            }
                        },

                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                        },

                        "series": [
                            {
                                "name": "Browsers",
                                "colorByPoint": true,
                                "data": [
                                    {
                                        "name": "Chrome",
                                        "y": 62.74,
                                        "drilldown": "Chrome"
                                    },
                                    {
                                        "name": "Firefox",
                                        "y": 10.57,
                                        "drilldown": "Firefox"
                                    },
                                    {
                                        "name": "Internet Explorer",
                                        "y": 7.23,
                                        "drilldown": "Internet Explorer"
                                    },
                                    {
                                        "name": "Safari",
                                        "y": 5.58,
                                        "drilldown": "Safari"
                                    },
                                    {
                                        "name": "Edge",
                                        "y": 4.02,
                                        "drilldown": "Edge"
                                    },
                                    {
                                        "name": "Opera",
                                        "y": 1.92,
                                        "drilldown": "Opera"
                                    },
                                    {
                                        "name": "Other",
                                        "y": 7.62,
                                        "drilldown": null
                                    }
                                ]
                            }
                        ],
                        "drilldown": {
                            "series": [
                                {
                                    "name": "Chrome",
                                    "id": "Chrome",
                                    "data": [
                                        [
                                            "v65.0",
                                            0.1
                                        ],
                                        [
                                            "v64.0",
                                            1.3
                                        ],
                                        [
                                            "v63.0",
                                            53.02
                                        ],
                                        [
                                            "v62.0",
                                            1.4
                                        ],
                                        [
                                            "v61.0",
                                            0.88
                                        ],
                                        [
                                            "v60.0",
                                            0.56
                                        ],
                                        [
                                            "v59.0",
                                            0.45
                                        ],
                                        [
                                            "v58.0",
                                            0.49
                                        ],
                                        [
                                            "v57.0",
                                            0.32
                                        ],
                                        [
                                            "v56.0",
                                            0.29
                                        ],
                                        [
                                            "v55.0",
                                            0.79
                                        ],
                                        [
                                            "v54.0",
                                            0.18
                                        ],
                                        [
                                            "v51.0",
                                            0.13
                                        ],
                                        [
                                            "v49.0",
                                            2.16
                                        ],
                                        [
                                            "v48.0",
                                            0.13
                                        ],
                                        [
                                            "v47.0",
                                            0.11
                                        ],
                                        [
                                            "v43.0",
                                            0.17
                                        ],
                                        [
                                            "v29.0",
                                            0.26
                                        ]
                                    ]
                                },
                                {
                                    "name": "Firefox",
                                    "id": "Firefox",
                                    "data": [
                                        [
                                            "v58.0",
                                            1.02
                                        ],
                                        [
                                            "v57.0",
                                            7.36
                                        ],
                                        [
                                            "v56.0",
                                            0.35
                                        ],
                                        [
                                            "v55.0",
                                            0.11
                                        ],
                                        [
                                            "v54.0",
                                            0.1
                                        ],
                                        [
                                            "v52.0",
                                            0.95
                                        ],
                                        [
                                            "v51.0",
                                            0.15
                                        ],
                                        [
                                            "v50.0",
                                            0.1
                                        ],
                                        [
                                            "v48.0",
                                            0.31
                                        ],
                                        [
                                            "v47.0",
                                            0.12
                                        ]
                                    ]
                                },
                                {
                                    "name": "Internet Explorer",
                                    "id": "Internet Explorer",
                                    "data": [
                                        [
                                            "v11.0",
                                            6.2
                                        ],
                                        [
                                            "v10.0",
                                            0.29
                                        ],
                                        [
                                            "v9.0",
                                            0.27
                                        ],
                                        [
                                            "v8.0",
                                            0.47
                                        ]
                                    ]
                                },
                                {
                                    "name": "Safari",
                                    "id": "Safari",
                                    "data": [
                                        [
                                            "v11.0",
                                            3.39
                                        ],
                                        [
                                            "v10.1",
                                            0.96
                                        ],
                                        [
                                            "v10.0",
                                            0.36
                                        ],
                                        [
                                            "v9.1",
                                            0.54
                                        ],
                                        [
                                            "v9.0",
                                            0.13
                                        ],
                                        [
                                            "v5.1",
                                            0.2
                                        ]
                                    ]
                                },
                                {
                                    "name": "Edge",
                                    "id": "Edge",
                                    "data": [
                                        [
                                            "v16",
                                            2.6
                                        ],
                                        [
                                            "v15",
                                            0.92
                                        ],
                                        [
                                            "v14",
                                            0.4
                                        ],
                                        [
                                            "v13",
                                            0.1
                                        ]
                                    ]
                                },
                                {
                                    "name": "Opera",
                                    "id": "Opera",
                                    "data": [
                                        [
                                            "v50.0",
                                            0.96
                                        ],
                                        [
                                            "v49.0",
                                            0.82
                                        ],
                                        [
                                            "v12.1",
                                            0.14
                                        ]
                                    ]
                                }
                            ]
                        }
                    });
                </script>

                <div class="col-lg-6">
                    <div id="classicpie" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                </div>
                <script type="text/javascript">

                    // Build the chart
                    Highcharts.chart('classicpie', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Population Breakdown'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Percentage',
                            colorByPoint: true,
                            data: [{
                                name: 'Native Residents',
                                y: 60,
                                sliced: true,
                                selected: true
                            }, {
                                name: 'Immigrants',
                                y: 10
                            }, {
                                name: 'Transients',
                                y: 30
                            }]
                        }]
                    });
                </script>

            </div>
        </div>
        <!-- begin chart -->

        <!-- begin chart -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="blotters" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
        </div>
        <script type="text/javascript">
            var date = new Date();
            var year = date.getFullYear();
            // Create the chart
            Highcharts.chart('blotters', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Blotter Records as of '+year 
                },
                subtitle: {
                    text: 'Click the columns to view months.'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total blotter records'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> of total<br/>'
                },

                "series": [
                    {
                        "name": "Years",
                        "colorByPoint": true,
                        "data": [
                            <?php 
                                $get_years_blotter = DB::table('t_blotter')->select(DB::raw('YEAR(COMPLAINT_DATE) as YEAR_CREATED'),DB::raw('COUNT(BLOTTER_ID) as COUNT_BLOTTER'))->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->get();
                            ?>
                            @foreach($get_years_blotter as $val)
                            {
                                "name": "{{$val->YEAR_CREATED}}",
                                "y": {{$val->COUNT_BLOTTER}},
                                "drilldown": "{{$val->YEAR_CREATED}}"
                            },
                            @endforeach
                            

                        ]
                    }
                ],
                "drilldown": {
                    "series": [
                        @foreach($get_years_blotter as $val)
                            
                        {
                            "name": "{{$val->YEAR_CREATED}}",
                            "id": "{{$val->YEAR_CREATED}}",
                            "data": [
                                <?php 
                                    $get_month_jan_blotter = DB::table('t_blotter')->where(DB::raw('MONTHNAME(COMPLAINT_DATE)'),'January')->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->count();
                                    $get_month_feb_blotter = DB::table('t_blotter')->where(DB::raw('MONTHNAME(COMPLAINT_DATE)'),'february')->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->count();
                                    $get_month_march_blotter = DB::table('t_blotter')->where(DB::raw('MONTHNAME(COMPLAINT_DATE)'),'march')->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->count();
                                    $get_month_april_blotter = DB::table('t_blotter')->where(DB::raw('MONTHNAME(COMPLAINT_DATE)'),'april')->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->count();
                                    $get_month_may_blotter = DB::table('t_blotter')->where(DB::raw('MONTHNAME(COMPLAINT_DATE)'),'may')->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->count();
                                    $get_month_june_blotter = DB::table('t_blotter')->where(DB::raw('MONTHNAME(COMPLAINT_DATE)'),'june')->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->count();
                                    $get_month_july_blotter = DB::table('t_blotter')->where(DB::raw('MONTHNAME(COMPLAINT_DATE)'),'july')->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->count();
                                    $get_month_august_blotter = DB::table('t_blotter')->where(DB::raw('MONTHNAME(COMPLAINT_DATE)'),'august')->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->count();
                                    $get_month_september_blotter = DB::table('t_blotter')->where(DB::raw('MONTHNAME(COMPLAINT_DATE)'),'september')->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->count();
                                    $get_month_october_blotter = DB::table('t_blotter')->where(DB::raw('MONTHNAME(COMPLAINT_DATE)'),'october')->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->count();
                                    $get_month_november_blotter = DB::table('t_blotter')->where(DB::raw('MONTHNAME(COMPLAINT_DATE)'),'november')->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->count();
                                    $get_month_december_blotter = DB::table('t_blotter')->where(DB::raw('MONTHNAME(COMPLAINT_DATE)'),'december')->groupBy(DB::raw('YEAR(COMPLAINT_DATE)'))->count();
                                ?>
                                [
                                    "January",
                                    {{$get_month_jan_blotter}}
                                ],
                                [
                                    "February",
                                    {{$get_month_feb_blotter}}
                                ],
                                [
                                    "March",
                                    {{$get_month_march_blotter}}
                                ],
                                [
                                    "April",
                                    {{$get_month_april_blotter}}
                                ],
                                [
                                    "May",
                                    {{$get_month_may_blotter}}
                                ],
                                [
                                    "June",
                                    {{$get_month_june_blotter}}
                                ],
                                [
                                    "July",
                                    {{$get_month_july_blotter}}
                                    
                                ],
                                [
                                    "August",
                                    {{$get_month_august_blotter}}
                                    
                                ],
                                [
                                    "September",
                                    {{$get_month_september_blotter}}
                                    
                                ],
                                [
                                    "October",
                                    {{$get_month_october_blotter}}
                                    
                                ],
                                [
                                    "November",
                                    {{$get_month_november_blotter}}
                                    
                                ],
                                [
                                    "December",
                                    {{$get_month_december_blotter}}
                                    
                                ]
                            ]
                        },
                        @endforeach

                    ]
                }
            });
        </script>
        <!-- end chart-->


         <div class="panel panel-default">
            <div class="panel-body">
                <div id="registered" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
            
        </div>

        <script type="text/javascript">
            var colors = ['#3B97B2', '#67BC42', '#FF56DE', '#E6D605', '#BC36FE', '#000'];
           Highcharts.chart('registered', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Registered Voters as of ' + year
            },
           
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total registered voters'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:f}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> of total<br/>'
            },

            "series": [
                {

                    "name": "Voters",
                    "colorByPoint": true,
                    "data": [
                         <?php 
                                $get_nonregistered_voters = db::table('t_resident_basic_info')
                                ->where('IS_REGISTERED_VOTER',1)
                                ->select(db::raw('YEAR(CREATED_AT) AS N_YEAR_CREATED'),
                                    db::raw('COUNT(RESIDENT_ID) as REGISTERED'))
                                ->groupBy(db::raw('YEAR(CREATED_AT)'))->get();
                            ?>
                            @foreach($get_nonregistered_voters as $val)
                            {
                                "name": "Registered",
                                "y": {{$val->REGISTERED}},
                               
                                
                            },
                            @endforeach

                       <?php 
                                $get_nonregistered_voters = db::table('t_resident_basic_info')
                                ->where('IS_REGISTERED_VOTER',0)
                                ->select(db::raw('YEAR(CREATED_AT) AS N_YEAR_CREATED'),
                                    db::raw('COUNT(RESIDENT_ID) as NON_REGISTERED'))
                                ->groupBy(db::raw('YEAR(CREATED_AT)'))->get();
                            ?>
                            @foreach($get_nonregistered_voters as $val)
                            {
                                "name": "Non-Registered",
                                "y": {{$val->NON_REGISTERED}},
                                "color": colors[2]
                                
                            },
                            @endforeach
                       
                    ]
                }
            ],
            // "drilldown": {
            //     "series": [
            //         {
            //             "name": "Chrome",
            //             "id": "Chrome",
            //             "data": [
            //                 [
            //                     "v65.0",
            //                     0.1
            //                 ],
            //                 [
            //                     "v64.0",
            //                     1.3
            //                 ],
                           
            //             ]
            //         },

            //         {
            //             "name": "Opera",
            //             "id": "Opera",
                      
            //             "data": [
            //                 [
            //                     "v50.0",
            //                     0.96
            //                 ],
            //                 [
            //                     "v49.0",
            //                     0.82
            //                 ],
            //                 [
            //                     "v12.1",
            //                     0.14
            //                 ]
            //             ]
            //         }
            //     ]
            // }
        });
    
        </script>
        <!-- end chart-->
        <!-- begin chart -->
        <!--<div class="panel panel-default">-->
        <!--    <div class="panel-body">-->
        <!--        <div id="issuances" style="min-width: 310px; height: 400px; margin: 0 auto"></div>-->
        <!--    </div>-->
        <!--</div>-->
      
        <!-- end chart-->


    </div>



@endsection
