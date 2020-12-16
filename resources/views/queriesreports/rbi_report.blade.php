 
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


@section('page-js')
<script>
  $(document).ready(function() {
    App.init();
    TableManageDefault.init();

  });
</script>
<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>


<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{asset('assets/plugins/highlight/highlight.common.js')}}"></script>
<script src="{{asset('assets/js/demo/render.highlight.js')}}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script src="{{asset('custom/jasonday-printThis-edc43df/printThis.js')}}"></script>
<script type="text/javascript">
  $('#print_btn').click( function() {
     

     $("#sample").printThis({
             debug: false,              
             debug: false,              
                 importCSS: true,         
                 importStyle:true,    
                 loadCSS: "",              
                 pageTitle: "fdas",              
                 removeInline: false,       
                 printDelay: 1000,       
                 header: null,              
                 footer: "",              
                 base: false ,               
                 formValues: true,           
                 canvas: false,              
                 doctypeString: null,       
                 removeScripts: false,     
                 copyTagClasses: false              
             });
  })
</script>

@endsection


@section('content')

<!-- begin #content -->
<div id="content" class="content">
  <!-- begin breadcrumb -->
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Page Options</a></li>
    <li class="breadcrumb-item active">Blank Page</li>
  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->
  <h1 class="page-header">RBI <small>Review and Print</small></h1>
  <hr style="background-color: black">
  <!-- end page-header -->

  <!-- START PANEL -->
  <div class="panel panel-inverse">
    <div class="panel-heading">
      <h4 class="panel-title" style="font-size: 16px">View RBI report </h4>
    </div>
    <div class="panel-body" style="overflow-x:auto;">
      <h6>RBI FORM B</h6>
      <br>
      <p style="text-align: center; font-size: 20px ">HOUSEHOLD</p>
      <p style="text-align: center; font-size: 20px ">RECORD OF BARANGAY INHABITANTS (RBI)</p>
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="stats-content">
            @foreach($municipalinfo as $row)
            <div class="form-group row m-b-10">
              <p style="font-size: 13px;font-weight: bold; " class="col-md-3 col-form-label text-md-left">A. REGION:</p>
              <div class="col-md-6">
                <input type="text" class="form-control"  readonly="true" style="background-color: #f2f3f4;" value="{{ $row->REGION }}" />
              </div>
            </div>
            <div class="form-group row m-b-10">
              <p style="font-size: 13px;font-weight: bold; " class="col-md-3 col-form-label text-md-left">B. PROVINCE:</p>
              <div class="col-md-6">
                <input type="text" class="form-control"  readonly="true" style="background-color: #f2f3f4;" value="{{ $row->PROVINCE_NAME }}"/>
              </div>
            </div>
            <div class="form-group row m-b-10">
              <p style="font-size: 13px;font-weight: bold; " class="col-md-3 col-form-label text-md-left">C.CITY/MUNICIPALITY:</p>
              <div class="col-md-6">
                <input type="text" class="form-control"  readonly="true" style="background-color: #f2f3f4;" value="{{ $row->MUNICIPAL_NAME }}"/>
              </div>
            </div>
            <div class="form-group row m-b-10">
              <p style="font-size: 13px;font-weight: bold; " class="col-md-3 col-form-label text-md-left">D. BARANGAY:</p>
              <div class="col-md-6">
                <input type="text" class="form-control"   readonly="true" style="background-color: #f2f3f4;" value="{{ $row->BARANGAY_NAME }}"/>
              </div>
            </div>
            @endforeach
            <div class="form-group row m-b-10">
              
              
              <p style="font-size: 13px;font-weight: bold; " class="col-md-3 col-form-label text-md-left">E. HOUSEHOLD NO: </p>
              
                
              
              
              <div class="col-md-6">
                @if($houseno == null)
                <input type="text" class="form-control"  readonly="true" style="background-color: #f2f3f4;" value="" />
                @else
                @foreach($houseno as $row)
                <input type="text" class="form-control"  readonly="true" style="background-color: #f2f3f4;" @if($row->ADDRESS_HOUSE_NO == 0) value="None" @else value="{{ $row->ADDRESS_HOUSE_NO }}" @endif />
                 @endforeach
                 @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="stats-content">

            <div class="form-group row m-b-10">
              <p style="text-align: left; font-size: 13px;font-weight: bold; " class="col-md-3 col-form-label text-md-left">A. 1 PSGC: </p>
              <div class="col-md-6">
                <input type="text" class="form-control" readonly="true" style="background-color: #f2f3f4;"/>
              </div>
            </div>

            <div class="form-group row m-b-10">
              <p style="text-align: left; font-size: 13px;font-weight: bold; " class="col-md-3 col-form-label text-md-left">B. 1 PSGC: </p>
              <div class="col-md-6">
                <input type="text" class="form-control" readonly="true" style="background-color: #f2f3f4;"/>
              </div>
            </div>
            <div class="form-group row m-b-10">
              <p style="text-align: left; font-size: 13px;font-weight: bold; " class="col-md-3 col-form-label text-md-left">C. 1 PSGC: </p>
              <div class="col-md-6">
                <input type="text" class="form-control" readonly="true" style="background-color: #f2f3f4;"/>
              </div>
            </div>
            <div class="form-group row m-b-10">
              <p style="text-align: left; font-size: 13px;font-weight: bold; " class="col-md-3 col-form-label text-md-left">D. 1 PSGC: </p>
              <div class="col-md-6">
                <input type="text" class="form-control" readonly="true" style="background-color: #f2f3f4;"/>
              </div>
            </div>
          </div>
        </div>
        <br>
     
      <!-- FIRST ROW -->
      <table id="table-default" class="table table-striped table-bordered display compact"  width="100%">
        <tbody>
          <tr>
            <td colspan="4" style="text-align: center; font-weight: bold; border: 1px solid black;">NAME</td>
            <td colspan="3" style="text-align: center; font-weight: bold; border: 1px solid black;">ADDRESS</td>
            <td colspan="1" style="text-align: center; font-weight: bold; border: 1px solid black;">PLACE OF BIRTH</td>
            <td colspan="1" style="text-align: center; font-weight: bold; border: 1px solid black;">DATE OF BIRTH</td>
            <td colspan="1" style="text-align: center; font-weight: bold; border: 1px solid black;">SEX </td>
            <td colspan="1" style="text-align: center; font-weight: bold; border: 1px solid black;">CIVIL STATUS</td>
            <td colspan="1" style="text-align: center; font-weight: bold; border: 1px solid black;">CITIZENSHIP</td>
            <td colspan="1" style="text-align: center; font-weight: bold; border: 1px solid black;">OCCUPATION</td>
            <td colspan="1" style="text-align: center; font-weight: bold; border: 1px solid black;">RELATIONSHIP TO<br>HOUSEHOLD HEAD</td>

            <tr>
              <tr>
                <td colspan="4" style="text-align: center; border: 1px solid black;"></td>
                <td colspan="3" style="text-align: center; border: 1px solid black;"></td>
                <td colspan="1" style="text-align: center; border: 1px solid black;"></td>
                <td colspan="1" style="text-align: center; border: 1px solid black;"></td>
                <td colspan="1" style="text-align: center; border: 1px solid black;"></td>
                <td colspan="1" style="text-align: center; border: 1px solid black;"></td>
                <td colspan="1" style="text-align: center; border: 1px solid black;"></td>
                <td colspan="1" style="text-align: center; border: 1px solid black;"></td>
                <td colspan="1" style="text-align: center; border: 1px solid black;"></td>
              </tr>

              <tr>

                <td>LAST</td>
                <td>FIRST</td>
                <td>MIDDLE</td>
                <td>QUALIFIER </td>

                <td>NUMBER</td>
                <td>STREET NAME</td>
                <td >NAME OF SUBD/ ZONE/ SITIO PUROK (if applicable)</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                @foreach($result as $row)
                <tr>
                  <td>{{$row->LASTNAME}}</td>
                  <td>{{$row->FIRSTNAME}}</td>
                  <td>{{$row->MIDDLENAME}}</td>
                  <td> {{$row->QUALIFIER}}</td>

                  <td>{{$row->ADDRESS_HOUSE_NO}}</td>
                  <td>{{$row->ADDRESS_STREET}}</td>
                  <td >{{$row->ADDRESS_PHASE}}</td>
                  <td>{{$row->PLACE_OF_BIRTH}}</td>
                  <td>{{$row->DATE_OF_BIRTH}}</td>
                  <td>{{$row->SEX}}</td>
                  <td>{{$row->CIVIL_STATUS}}</td>
                  <td>{{$row->CITIZENSHIP}}</td>
                  <td>{{$row->OCCUPATION}}</td>

                  <td>{{$row->RELATION_TO_HOUSEHOLD_HEAD}}</td>
                </tr>
                @endforeach
              </tr>
            </tr>
          </tr>
          <br>
        </tbody>
      </table>
    </div>
    <div class="panel">
      <div class="col-md-12" style="text-align: right">
        <div class="panel" style="background-color: #262626; padding: 1px"></div>
        &nbsp;
        <a href="{{route('HouseholdList')}}" class="btn btn-default"  style="font-size: 17px; background-color: #e6e6e6; border: 1px black solid">
         <i class="ion-reply"></i>&nbsp;
         Go Back
       </a>
       &nbsp;
       <button type="button" class="btn btn-primary" id="print_btn" style="font-size: 17px">
         <i class="fa fa-print"></i>&nbsp;
         Print Report
       </button>

       <div class="panel" style="padding: 10px"></div>
     </div>
   </div>
 </div>
 <!-- END PANEL -->

</div>

<div class="fillers" id="fillers" hidden>
  @include('queriesreports.rbi_report_printable')
 
</div>
<!-- end #content -->
@endsection

