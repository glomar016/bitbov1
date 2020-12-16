
@extends('global.main')

{{--@if(session('session_permis_user_accounts')!= '1' && session('session_position') != 'Admin')
<script type="text/javascript">location.href='{{route("Dashboard")}}'</script>
@else

@endif--}}


@section('title', "User Accounts")

@section('page-css')

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{asset('assets/plugins/jquery-smart-wizard/src/css/smart_wizard.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/parsley/src/parsley.css')}}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->
{{--DATE PICKER--}}

<link href="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" />

@endsection

@section('page-js')

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{asset('assets/plugins/parsley/dist/parsley.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.js')}}"></script>
<script src="{{asset('assets/js/demo/form-wizards-validation.demo.min.js')}}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script src="{{asset('assets/plugins/bootstrap-daterangepicker/moment.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>

{{--Modals--}}

<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        App.init();
        // var date = new Date(Date.now());
        // $('#aStartTermTxt').val(date.getFullYear()
        //     +'-'+parseInt(String(date.getMonth() + 1).padStart(2, '0'))
        //     +'-'+parseInt(String(date.getDate()).padStart(2, '0')));
    });



    $("#aStartTermTxt").datetimepicker({format: 'YYYY-mm-DD'}).on('dp.change',function(selectedDate) 
    {
        StartTerm = new Date(selectedDate.date);
        StartTermMonth = StartTerm.getMonth()+1;
        FormattedStartTerm = StartTerm.getFullYear()+'-'+StartTermMonth+'-'+StartTerm.getDate();
        FormattedEndTerm = StartTerm.getFullYear()+3+'-'+StartTermMonth+'-'+StartTerm.getDate();
        $("#aEndTermMaskTxt").datetimepicker({format: 'YYYY-mm-DD'});
        $("#aStartTermTxt").val(FormattedStartTerm);
        $("#aEndTermMaskTxt").val(FormattedEndTerm);
        $("#aEndTermTxt").val(FormattedEndTerm);

    });
    var multichildform = $("#AddForm");
   
    $.validator.setDefaults({
        highlight: function(element) {
            $(element)
            .closest('.form-group')
            .addClass('has-error');
        },
        unhighlight: function(element) {
            $(element)
            .closest('.form-group')
            .removeClass('has-error');
        },
    });

    // jQuery.validator.addMethod("aEmpNum", function (empno, element) {
    //     empno = empno.replace(/\s+/g, "");
    //     employeeno = empno.replace(/-/g, "");
    //     return this.optional(element) || (empno.length == 10) && employeeno.match(/^[\d]+$/)
    //    // phone_number.match(/^(0-?)?(\([0-9]\d{2}\)|[0-9]\d{2})-?[0-9]\d{2}-?\d{4}$/);
    //    empno.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?$/); //(0-?) = 0, ([0-9]\d{2}\) = 3 digits from 0-9 , d{4} 4 didgets, $ end of number
    // }, "Please specify a employee number");


    if(multichildform.length){

      multichildform.validate({
        onfocusout: false,
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {                    
                validator.errorList[0].element.focus();
            }
        },

        rules:{
          rbi_firstname: {
              required: true
              
              // lettersonly: true
          },
          rbi_middlename: {

              
              // lettersonly: true
          },
          rbi_lastname: {
              required: true
              
              // lettersonly: true
          },

          rbi_dateofbirth: {
              required: true

          },
          rbi_placeofbirth: {
              required: true,
              
              
          },
          rbi_citizenship: {
            required: true,
            nowhitespace: true,
            lettersonly: true
          },

          rbi_houseno: {
            required: true,
            
            
          },

          rbi_hstreet_no: {
            required: true,
           
          },

          rbi_hstreet: {
            required: true,
            
          },

           rbi_occupation: {
            required: true,
            
          },

          
          //  aEmpNum: {
          //   required: true,
          //   aEmpNum: true
            
          // },

          aEmailTxt: {
            required: true,
            
          },

          // aStartTermTxtx: {
          //   required: true,
            
          // },

    },
    messages:{
      rbi_firstname: {
          required: 'This field is required',
          
          // lettersonly: 'letters only'
      },
      rbi_middlename: {
         
          // lettersonly: 'letters only'
      },
      rbi_lastname: {
          required: 'This field is required',
          
          // lettersonly: 'letters only'
      },

      

  },


});
  }
  var status = "";
   $(document).on('change','.rbi_dateofbirth', function(){
        var dtest = new Date();
        var ndate = dtest.toJSON().slice(0, 10); 
        $('#rbi_dateofbirth').val() > ndate ? $('#rbi_dateofbirth').val(ndate) : $('#rbi_dateofbirth').val()
        validatedate();
    
    });

   function validatedate() {


    var dateofbirth = $('#rbi_dateofbirth').val();
    var cdate = new Date(Date.now());
    var rgdate = new Date(dateofbirth);
    var ryear = parseInt(rgdate.getFullYear());
    var rmont = parseInt(String(rgdate.getMonth() + 1).padStart(2, '0')) ;
    var rday = parseInt(String(rgdate.getDate()).padStart(2, '0') ) ;
    var cyear = parseInt(cdate.getFullYear());
    var cmon = parseInt(cdate.getMonth() + 1);
    var cday = parseInt(String(cdate.getDate()).padStart(2, '0'));

    var age = cyear - ryear;

    if (rday >= 32){
        rday = 1;
    }
    if (rmont >= 13){
        rmont = 1;
    }
    var current_year = new Date(cyear,cmon,cday);
    var dob_year = new Date(ryear,rmont,rday); 
    var days = DaysBetween(dob_year,current_year);
    console.log(age)
    
        if (age >= 1 ) {
            age == 1 ? $("#rbi_age").val(age + " year old") : $("#rbi_age").val(age + " year's old")
        }
        else if ( age < 1 ){
            days <= 1 ? $("#rbi_age").val(days + " day old") : $("#rbi_age").val(days + " day's old")
        }

        if (age==0 || age<0) {


                if ( days <= 28 && days >= 0 ) {

                    status = "newborn";
                    
                    
                }
                else if ( days >= 29 ) {

                    status = "infant";
                    
                    
                }
            }
            else if (age >= 1 && age <= 10) {
                
                
                status = "child";
                
                
            }
            else if (age >= 11 && age <= 19) {
                
                
                var status = "adolescent";
                
                
            }
            else if ( age >= 60 ) {
                
                
                status = "elderly";
                
                
            }
            else {
              status = "";
            }
            
       console.log(status)
    }

     function DaysBetween(DateofBirth, CurrentYear) {

            const oneDay = 1000 * 60 * 60 * 24; 
            const start = Date.UTC(CurrentYear.getFullYear(), CurrentYear.getMonth(), CurrentYear.getDate()); 
            const end = Date.UTC(DateofBirth.getFullYear(), DateofBirth.getMonth(), DateofBirth.getDate()); 
            return Math.round(Math.abs((start - end ) / oneDay));
        }
  // $(document).on('change','.rbi_homeownership',function() { 
  //       if($(this).find('option:selected').val() != 'Owned') {
  //           $('#rbi_RelationToHead').clear();
  //           $('#reltohead').show();
  //       } else {
  //           $('#rbi_RelationToHead').val("Head");
  //           $('#reltohead').hide();
  //       }
  //   });

  $('#register-rbi-btn').on('click',function() {

    if($('#AddForm').valid()) {

        var rbi_firstname = $('#rbi_firstname').val().toUpperCase();
        var rbi_middlename = $('#rbi_middlename').val().toUpperCase();
        var rbi_lastname = $('#rbi_lastname').val().toUpperCase();
        var fullname = rbi_firstname + " " + rbi_lastname;
        var rbi_qualifier = $('#rbi_qualifier').val().toUpperCase();
        var rbi_gender = $("input[name=rbi-sex_gender]:checked").val();
        var rbi_dob = $('#rbi_dateofbirth').val();
        var rbi_placeofb = $('#rbi_placeofbirth').val();
        var rbi_civilstat = $('#rbi_civilstatus').val();
        var rbi_occu = $('#rbi_occupation').val();
        var rbi_owner = $('#rbi_homeownership').val();
        var rbi_house_no = $('#rbi_houseno').val();
        var rbi_street_no = $('#rbi_hstreet_no').val();
        var rbi_street = $('#rbi_hstreet').val();
        var rbi_building = $('#rbi_hbuilding').val();
        var rbi_hunitno = $('#rbi_hunitno').val();
        var rbi_hsubdivision = $('#rbi_hsubdivision').val();
        var rbi_citizenship = $('#rbi_citizenship').val();
        var rbi_lotownership = $('#lotownership').val();

        var rbi_email = $('#aEmailTxt').val();
        var rbi_sterm = $('#aStartTermTxt').val();
        var rbi_eterm = $('#aEndTermTxt').val(); 
        var rbi_position_id = $('#aBarangayPositionTxt').children(":selected").attr("id");
        var rbi_employee_no = $('#aEmpNum').val();
        var rbi_reltohead = $('#rbi_RelationToHead').children(":selected").attr("value");

        data = 
              {
                rbi_firstname: rbi_firstname,
                rbi_middlename: rbi_middlename, 
                rbi_lastname: rbi_lastname, 
                rbi_qualifier:rbi_qualifier,
                rbi_gender:rbi_gender,
                rbi_dob:rbi_dob,
                rbi_placeofb: rbi_placeofb,

                rbi_civilstat: rbi_civilstat,
                rbi_occu: rbi_occu,
                rbi_owner: rbi_owner,
                rbi_house_no: rbi_house_no,
                rbi_street_no: rbi_street_no,
                rbi_street: rbi_street,
                rbi_building: rbi_building,
                rbi_hunitno: rbi_hunitno,
                rbi_hsubdivision: rbi_hsubdivision,
                rbi_citizenship: rbi_citizenship,
                rbi_lotownership: rbi_lotownership,
                rbi_email: rbi_email,
                rbi_sterm: rbi_sterm,
                rbi_eterm: rbi_eterm,
                rbi_position_id: rbi_position_id,
                rbi_employee_no: rbi_employee_no,
                rbi_reltohead: rbi_reltohead,
                _token: "{{csrf_token()}}"
              }

        swal({
            title: "Wait!",
            text: "Are you sure you want to assign "+ fullname +" as "+ $("#aBarangayPositionTxt").find(':selected').text() + "?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            
            if (willDelete) {
                swal("Assigning successfully!", {
                    icon: "success",

                });
                setTimeout(function(){
                   $.ajax({
                    url:"{{route('AddNewUserOfficial')}}",
                    type:'POST',
                    data: data,
                      success:function(data)
                      {
                        $('#defusername').val(data.username);
                        $('#defpassword').val(rbi_employee_no);
                        $('#show_default').modal('show')
                              //location.reload();
                      } ,
                      error: function(error)
                      {
                          console.error(error);
                      }  
                    })
               });
            } 
            else 
            {
                swal("Operation Cancelled.", {
                    icon: "error",
                });
            }
        });
        $('#close_modal').click(function() {
            window.location.href = "{{route('UserAccounts')}}";
        });

        
    }
    


});


</script>


@endsection



@section('content')

<style type="text/css">
label {
    display: block;   
}

input.error {
    border: 1px solid red;
}

label.error {
    font-weight: normal;
    color: red;
    text-align: left;
}
.fontstyling {
    font-size: 15px;
    width: 15%;
}
</style>
<!-- begin #content -->
<div id="content" class="content">
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
            <h4 class="panel-title">RBI FORM</h4>
        </div>
        <div class="panel-body">

            <form id="AddForm" name="AddForm">
                @csrf
                
                
                <div id="wizard">
                    <!-- begin wizard-step -->
                    

                    <div>
                        <div id="step-1" class="rbi-list-form" >

                            <!-- begin fieldset -->
                            <fieldset><br>


                             <div class="note note-primary note-with-left-icon col-lg-6">
                              <div class="note-icon"><i class="fas fa-user-circle"></i></div>
                              <div class="note-content text-center">
                                <h4><b>Basic information about the Resident</b></h4>
                                <p></p>
                            </div>
                        </div>


                        <!-- begin row -->
                        <div class="row">
                            <br><br>

                            <div class="col-md-6">
                                <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">First Name <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" id="rbi_firstname" name="rbi_firstname" placeholder="John" class="form-control "  style="text-transform: uppercase;" />
                                            </div>
                                        </div>
                               
                                <!-- end form-group -->
                                <!-- begin form-group -->
                                <div class="form-group row m-b-10">
                                    <label class="col-md-3 col-form-label text-md-right">Middle Name </label>
                                    <div class="col-md-6">
                                        <input type="text" placeholder="A" id="rbi_middlename" name="rbi_middlename" class="form-control rbi_middlename" style="text-transform: uppercase;"/>
                                    </div>
                                </div>
                                <!-- end form-group -->
                                <!-- begin form-group -->
                                <div class="form-group row m-b-10">
                                    <label class="col-md-3 col-form-label text-md-right">Last Name <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" id="rbi_lastname" name="rbi_lastname" placeholder="Dela Cruz"  class="form-control rbi_lastname" style="text-transform: uppercase;"/>
                                    </div>
                                </div>
                                <!-- end form-group -->
                                <!-- begin form-group -->
                                <div class="form-group row m-b-10" style="">
                                    <label class="col-md-3 col-form-label text-md-right">Qualifier</label>
                                    <div class="col-md-6">
                                        <input type="text" id="rbi_qualifier" placeholder="Jr" name="rbi_qualifier" class="form-control rbi_qualifier" style="text-transform: uppercase;"/>
                                    </div>
                                </div>
                                <!-- end form-group -->
                                <!-- begin form-group -->
                                <div class="form-group row m-b-10">
                                    <label class="col-md-3 col-form-label text-md-right">Sex <span class="text-danger">&nbsp;</span></label>
                                    <div class="col-md-6">
                                        <div class="radio radio-css radio-inline">
                                            <input type="radio" name="rbi-sex_gender" id="inlineCssRadio1"  class="rbi-sex_gender" value="Male" checked />
                                            <label for="inlineCssRadio1">Male</label>
                                        </div>
                                        <div class="radio radio-css radio-inline">
                                            <input type="radio" name="rbi-sex_gender" class="rbi-sex_gender" id="inlineCssRadio2" value="Female" />
                                            <label for="inlineCssRadio2" value="Female">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- end form-group -->
                                <!-- begin form-group -->
                                <div class="form-group row m-b-10">
                                    <label class="col-md-3 col-form-label text-md-right">Date of Birth <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="date" id="rbi_dateofbirth" name="rbi_dateofbirth" placeholder="" class="form-control rbi_dateofbirth"  />

                                    </div>

                                </div>
                                <div class="form-group row m-b-10">
                                    <label class="col-md-3 col-form-label text-md-right">Age</label>
                                    <div class="col-md-6">
                                        <input type="text" id="rbi_age"  name="rbi_age" class="form-control rbi_age" style="background-color: white; font-size: 15px; color: black" readonly />

                                    </div>
                                </div>
                                <!-- end form-group -->
                                <!-- begin form-group -->
                                <div class="form-group row m-b-10">
                                    <label class="col-md-3 col-form-label text-md-right">Place of Birth <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" id="rbi_placeofbirth" name="rbi_placeofbirth" placeholder="Tondo Manila" class="form-control rbi_placeofbirth"
                                        style="text-transform: capitalize;" />
                                    </div>
                                </div>
                                <!-- end form-group -->
                                <!-- begin form-group -->
                                <div class="form-group row m-b-10">
                                    <label class="col-md-3 col-form-label text-md-right">Civil Status <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <select class="form-control rbi_civilstatus " data-style="btn-lime" id="rbi_civilstatus" name="rbi_civilstatus">
                                            <option value="Single" selected>Single</option>
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

                                <!-- end form-group -->

                            </div>

                            <div class="col-md-6">




                                <!-- begin form-group -->

                                <div class="form-group row m-b-10 showoccu"  id="showoccu">
                                    <label class="col-md-3 col-form-label text-md-right">Occupation </label>
                                    <div class="col-md-6">
                                        <input type="text" id="rbi_occupation" name="rbi_occupation" placeholder="Indicate None if so" class="form-control rbi_occupation" style="text-transform: capitalize;" />
                                    </div>
                                </div>
                                <!-- end form-group -->
                                <!-- begin form-group -->


                                <!-- end form-group -->
                                <!-- begin form-group -->



                                <!-- begin form-group -->
                                <div class="form-group row m-b-10">
                                    <label class="col-md-3 col-form-label text-md-right">Housing Ownership<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <select class="form-control rbi_homeownership"  target="1"  data-style="btn-lime" id="rbi_homeownership" name="rbi_homeownership">
                                            <option value="Owned" selected>Owned</option>
                                            <option value="Amortized">Amortized</option>
                                            <option value="Rent-free with Owner Consent">Rent-free with Owner Consent</option>
                                            <option value="Rent-free without Owner Consent">Rent-free without Owner Consent</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end form-group -->

                                <div class="form-group row m-b-10">
                                                                <label class="col-md-3 col-form-label text-md-right">Lot Ownership<span class="text-danger">*</span></label>
                                                                <div class="col-md-6">
                                                                    <select class="form-control rbi-lotownership"  target="1"  data-style="btn-lime" id="rbi-lotownership" name="rbi-lotownership">
                                                                        <option value="Owned" selected>Owned</option>
                                                                        <option value="Rented">Rented</option>
                                                                        <option value="Rent-free with Owner Consent">Rent-free with Owner Consent</option>
                                                                        <option value="Rent-free without Owner Consent">Rent-free without Owner Consent</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                <div class="form-group row m-b-10" id="reltohead">
                                    <label class="col-md-3 col-form-label text-md-right">Relationship to Household Head<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                      <select id="rbi_RelationToHead" name="rbi_RelationToHead" class="form-control">&nbsp\n'
                                        <option value="Head">Head </option>
                                        <option value="Spouse">Spouse </option>
                                        <option value="Son">Son </option>
                                        <option value="Daughter">Daughter </option>
                                        <option value="Stepson">Stepson</option>
                                        <option value="Stepdaughter">Stepdaughter </option>
                                        <option value="Son-in-law">Son-in-law</option>
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
                                        <option value="Nonrelative">Non-Relative </option>
                                        <option value="Boarder">Boarder </option>
                                        <option value="Househelper">Househelper </option>
                                      </select>
                                       
                                    </div>
                                </div>
                                <!-- <div class="form-group row m-b-10 rbi-RelToHead-show" id="reltohead" style="display: none" >
                                    <label class="col-md-3 col-form-label text-rbi_RelationToHeadmd-right">Relationship to Household Head<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" id="rbi_RelationToHead" name="rbi-RelationToHead" placeholder="Indicate Household Head if so" class="form-control rbi-RelationToHead" style="text-transform: capitalize;"/>
                                    </div>
                                </div>&nbsp -->


                                <br>
                                <!-- begin form-group -->
                                <div class="form-group row m-b-10">
                                    <label class="col-md-3 col-form-label text-md-right">Address<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="number" name="rbi_houseno" id="rbi_houseno" placeholder="146" class="form-control rbi_houseno"/>
                                        <input type="text" name="rbi_hstreet_no" id="rbi_hstreet_no" placeholder="Area 3 Oriole Street*" class="form-control rbi_hstreet_no" style="text-transform: capitalize;" />
                                        <input type="text" name="rbi_hstreet" id="rbi_hstreet" placeholder="Sitio Veterans" class="form-control rbi_hstreet" style="text-transform: capitalize;"/>


                                    </div>
                                </div>
                                <div class="form-group row m-b-10">
                                    <label class="col-md-3 col-form-label text-md-right">Optional<span class="text-danger"></span></label>
                                    <div class="col-md-6">

                                        <input type="text" name="rbi_hbuilding" id="rbi_hbuilding" placeholder="Building" class="form-control rbi_hbuilding" style="text-transform: capitalize;"/>
                                        <input type="text" name="rbi_hunitno" id="rbi_hunitno" placeholder="Unit No." class="form-control rbi_hunitno" style="text-transform: capitalize;"/>
                                        <input type="text" name="rbi_hsubdivision" id="rbi_hsubdivision" placeholder="Subdivision" class="form-control rbi_hsubdivision" style="text-transform: capitalize;"/>
                                    </div>
                                </div>


                                <!-- begin form-group -->
                                <div class="form-group row m-b-10">
                                    <label class="col-md-3 col-form-label text-md-right">Citizenship<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" id="rbi_citizenship" name="rbi_citizenship" placeholder="Filipino" class="form-control rbi_citizenship" style="text-transform: capitalize;"/>
                                    </div>
                                </div>

                                <!-- end form-group -->
                            </div>
                        </div>                  
                    </fieldset><br>


                    <div class="note note-warning note-with-left-icon col-lg-6">
                      <div class="note-icon"><i class="fas fa-address-book"></i></div>
                      <div class="note-content text-center">
                        <h4><b>User Credentials</b></h4>
                        <p></p>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>&nbsp&nbspBarangay Position</label> <span id='ReqBarangayPosTxt'></span>

                            <input type="text" id="aBarangayPosIDTxt" name="aBarangayPosIDTxt" hidden>
                            <select class="form-control form-control-lg"  name="aBarangayPositionTxt" id="aBarangayPositionTxt" placeholder="####"  required="true"  data-style="btn-lime" id="BarangayName">
                                <option value="null"><--Select Position--></option>
                                    @foreach ($DisplayBarangayPosition as $value)

                                    <option id="{{$value->POSITION_ID}}">{{ $value->POSITION_NAME }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6" >
                            <div class="form-group">
                                <label>Email</label> <span id='aReqEmail'></span>
                                <input type="email" name="aEmailTxt" id="aEmailTxt" placeholder="E.G.:example@gmail.com" class="form-control form-control-lg" data-parsley-type="email" data-parsley-required="true" />
                            </div>
                        </div>

                    </div>

                    <div class="row ">
                        <div class="col-md-6">
                         <div class="form-group " >
                             <label >Start Term</label>
                             <span id='aReqStartTermTxt'></span>

                             <div class="input-group date" id="datetimepicker">
                                <input type="text" class="form-control form-control-lg" id="aStartTermTxt" name="aStartTermTxt" />
                                <div class="input-group-addon" id="aStartTermIcon" >

                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group ">
                            <label >End Term</label>
                            <span id='aReqEndTermTxt'></span>

                            <div class="input-group date" id="datetimepicker">
                                <input type="text" class="form-control" id="aEndTermTxt" name="aEndTermTxt" hidden />
                                <input type="text" class="form-control form-control-lg" id="aEndTermMaskTxt" name="aEndTermMaskTxt" readonly />
                                <div class="input-group-addon" id="aEndTermIcon" >
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" >
                        <div class="form-group">
                            <label>Employee Number</label> <span id='aLblEmpNum'></span>
                            <input type="text" name="aEmpNum" id="aEmpNum" class="form-control form-control-lg"/>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>
</form>
<button type="button" class="btn btn-lg btn-primary col-lg-2"  id="register-rbi-btn">Add User</button>
<a class="btn btn-lg btn-white" id="backtuseraccnts" href="{{route('UserAccounts')}}">Back to User Accounts</a>
</div>
</div>
</div>

<div class="modal fade" id="show_default" data-backdrop="static">
    <div class="modal-dialog" style="max-width: 50%">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #242a30">
                <h4 class="modal-title" style="color: white">DEFAULT USERNAME AND PASSWORD</h4>
            </div>
            <div class="modal-body">

                <form >
                    <div class="note note-warning note-with-right-icon">
                      <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
                      <div class="note-content text-center">
                        <h4><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspNOTE!</b></h4>
                        <p>&nbsp&nbspPLEASE NOTE YOUR DEFAULT USERNAME AND PASSWORD </p>
                      </div>
                    </div>
                    
                    <br>
                  
                    <h4><label style="display: block; text-align: center">Notice</label></h4>
                    <h3><b><label style="text-transform: capitalize; display: block; text-align: center;" ></label></b></h3>
                    <br>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <h><label style="display: block; text-align: center">&nbspUsername</label></h>
                            <input style="display: block; text-align: center; background-color: white;color: black;font-size: 20px" type='text' class='form-control' id="defusername" readonly/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <h><label style="display: block; text-align: center">&nbspPassword</label></h>
                            <input style="display: block; text-align: center; background-color: white;color: black;font-size: 20px" type="text" class='form-control' id="defpassword" readonly />
                        </div>
                    </div>
                    <div class="modal-footer" align="center">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal" id="close_modal" name="close_modal">Close</a>

                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- end tab-pane -->
</div>


@endsection