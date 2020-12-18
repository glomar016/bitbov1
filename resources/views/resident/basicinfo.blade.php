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
<style type="text/css">
.is-valid{
   
}
</style>
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
<script src="{{asset('assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.js')}}"></script>
<script src="{{asset('assets/js/demo/form-wizards.demo.min.js')}}"></script>
<script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->

<script src="{{asset('assets/plugins/highlight/highlight.common.js')}}"></script>
<script src="{{asset('assets/js/demo/render.highlight.js')}}"></script>
<script src="{{asset('assets/js/moment.js')}}"></script>


<script>

    $(document).ready(function() {
        App.init();
        FormWizard.init();
        Notification.init();
        //$('#resident_table').DataTable();
        $("#wizard-mic").smartWizard();
        $('#nbody').show();
    });

</script>
<script src="{{asset('js/rbi-validator.js')}}"></script>
<script type="text/javascript">

    $('#ArrivalReason').change(function () {
        var arrivalreason = $('#ArrivalReason').children(":selected").attr("id");
        if(arrivalreason == 3) {
            $('#div_transient').show();
            $('#showmigrants').hide();
        } else if (arrivalreason == 2) {
            $('#showmigrants').show();
            $('#div_transient').hide();
            $('#fromwhat').attr('placeholder','Enter Country');
        } else {
            $('#showmigrants').hide();
            $('#div_transient').hide();
        }

    });
    $('#migrants').change(function() {
        var migrants = $('#migrants').val()
        if(migrants == "Country") {
            $('#fromwhat').attr('placeholder','Enter Country');
        } else if(migrants == "Barangay") {
            $('#fromwhat').attr('placeholder','Enter Barangay');
        } else if(migrants == "Province") {
            $('#fromwhat').attr('placeholder','Enter Province');
        }
    });

    $('#enrollment_status').change(function() {
        var enstat = $(this).children(':selected').attr("value");
        if(enstat == "Enrolled, public" || enstat == "Enrolled, private") {
            $('#showSchoolDetails').show();
        } else {
            $('#showSchoolDetails').hide();
        }
    });

    $('#pdelivery').change(function() {
        var pdelivery = $(this).children(':selected').attr("value");
        if(pdelivery == "Other") {
            $('#showOtherDeliveryPlace').show();
        } else {
            $('#showOtherDeliveryPlace').hide();
            $('#pdeliveryOther').val("").change();
        }
    });

    $('#battendant').change(function() {
        var attendant = $(this).children(':selected').attr("value");
        if(attendant == "Other") {
            $('#showOtherAttendant').show();
        } else {
            $('#showOtherAttendant').hide();
            $('#battendantOther').val("").change();
            
        }
    });

    $('#fvisited').change(function() {
        var healthFacility = $(this).children(':selected').attr("value");
        if(healthFacility != "None") {
            $('#showReasonForVisit').show();
            $('#rvisit').val("Not applicable").change();
        } else {
            $('#showReasonForVisit').hide();
        }
    });

    $('#r_coming').change(function() {
        var reason = $(this).children(':selected').attr("value");
        if(reason == "Other") {
            $('#showOtherReasonForComing').show();
        } else {
            $('#showOtherReasonForComing').hide();
            $('#otherReason').val("").change();
        }
    });
    
    $('#mr_coming').change(function() {
        var reason = $(this).children(':selected').attr("value");
        if(reason == "Other") {
            $('#showmOtherReasonForComing').show();
        } else {
            $('#showmOtherReasonForComing').hide();
            $('#motherReason').val("").change();
        }
    });


</script>
{{--For ADD FORM--}}
<script src="{{asset('assets/js/moment.js')}}"></script>
<script>
    function getAge (){
        var dateOfBirth = $('#dateofbirth').val();
        var years = moment().diff(dateOfBirth, 'years');
        if (years == 0){
            var days = moment().diff(dateOfBirth, 'days');
            days == 1? $('#age').val(days + " day old") : $('#age').val(days + " days old");
        }
        else{
            years == 1? $('#age').val(years + " year old") : $('#age').val(years + " years old");

            if (years >= 3){
                $('#showEducDetails').show();
            }
            else{
                $('#showEducDetails').hide();
            }

            if (years >= 15){
                $('#mshowoccu').show();
            }
            else{
                $('#mshowoccu').hide();
            }

            if (years >= 18){
                $('#showSoloParent').show();
                $('#showRegisteredVoter').show();
            }
            else{
                $('#showSoloParent').hide();
                $('#showRegisteredVoter').hide();
            }

            if (years >=60){
                $('#showSeniorCitizen').show();
            }
            else{
                $('#showSeniorCitizen').hide();
            }
        }
    }

    function getAgeRbi() {
        var dateOfBirth = $('#rbi-dateofbirth').val();
        var years = moment().diff(dateOfBirth, 'years');
        if (years == 0){
            var days = moment().diff(dateOfBirth, 'days');
            days == 1? $('#rbi-age').val(days + " day old") : $('#rbi-age').val(days + " days old");
        }
        else{
            years == 1? $('#rbi-age').val(years + " year old") : $('#rbi-age').val(years + " years old");
        }
    }

    $(document).ready(function() {
        $('#addVar').click();
    });
    $('#dateofbirth').change(function () {
        console.log('hey')
        getAge();
    });

    // $('#dateofbirth').change(function () {
    //     var dtest = new Date();
    //     var ndate = dtest.toJSON().slice(0, 10);
    //     $('#dateofbirth').val() > ndate ? $('#dateofbirth').val(ndate) : $('#dateofbirth').val()
    //     validatedate("fordisplay");
    //     checkage();
    // });

    $('#educationatt').change(function () {
        var dobselect = "#dateofbirth";
        checkage(dobselect);
    });

    $('#civilstatus').change(function () {
        checkage();
    });

    $(document).on('keyup change','#multidoba',function(){
        var dtest = new Date();
        var ndate = dtest.toJSON().slice(0, 10);
        $('#multidoba').val() > ndate ? $('#multidoba').val(ndate) : $('#multidoba').val()
        var multidoba = $(this).val();
        checkmultiage(multidoba);
    });

    $(document).on('change','#multicvstat',function(){
        var multidoba = $(this).val();
        checkmultiage(multidoba);
    });

    $(document).on('change','#multieducatt',function(){
        var multidoba = $(this).val();
        checkmultiage(multidoba);
    });

    $(document).on('change','#multienstat',function(){
        var value = $(this).val();
        if(value == 'Enrolled, public' || value == 'Enrolled, private') {
            $('#showSchoolDetailsMulti').show();
        } else {
            $('#showSchoolDetailsMulti').hide();
        }
    });

    $(document).on('change','#multipdelivery',function(){
        var pdelivery = $(this).val();
        if(pdelivery == "Other") {
            $('#showMultiOtherDeliveryPlace').show();
        } else {
            $('#showMultiOtherDeliveryPlace').hide();
            $('#multipdeliveryOther').val("").change();
        }
    });

    $(document).on('change','#multibattendant',function(){
        var attendant = $(this).val();
        if(attendant == "Other") {
            $('#showMultiAttendant').show();
        } else {
            $('#showMultiAttendant').hide();
            $('#multibattendantOther').val("").change();
            
        }
    });

    $(document).on('change','#multifvisited',function(){
        var healthFacility = $(this).val();
        if(healthFacility != "None") {
            $('#showMultiReasonForVisit').show();
        } else {
            $('#showMultiReasonForVisit').hide();
        }
    });

    $(document).on('change','.is_registered_voter',function(){
        var registeredVoter = $(this).val();
        if(registeredVoter != 0) {
            $('#showVotingPrecinct').show();
        } else {
            $('#showVotingPrecinct').hide();
            $('#votingPrecinct').val("").change();

        }
    });

    $(document).on('change','.multiirv',function(){
        var registeredVoter = $(this).val();
        if(registeredVoter != 0) {
            $('#showMultiVotingPrecinct').show();
        } else {
            $('#showMultiVotingPrecinct').hide();
            $('#multiVotingPrecinct').val("").change();
        }
    });

    $(document).on('change','.multirc',function(){
        var reason = $(this).val();
        if(reason == "Other") {
            $('#showMultiOtherReason').show();
        } else {
            $('#showMultiOtherReason').hide();
            $('#multircOther').val("").change();
        }
    });

    $(document).on('change','.multimrc',function(){
        var reason = $(this).val();
        if(reason == "Other") {
            $('#showMultimOtherReason').show();
        } else {
            $('#showMultimOtherReason').hide();
            $('#multimrcOther').val("").change();
        }
    });


    $(document).on('change','#multityper',function(){
        var value = $(this).val();
        if(value == 'Migrants') {
            $('#multifromwhat').attr('placeholder','Enter Country');
            $('#multishowmigrants').show()
            $('.div_multi_transient').hide();
        }else if(value == 'Transients') {
            $('.div_multi_transient').show();
            $('#multishowmigrants').hide();
        } else {
            $('#multishowmigrants').hide()
            $('.div_multi_transient').hide();
        }
    });

    $(document).on('change', '#migrants', function() {
        var migrants = $(this).val();
        if(migrants == "Country") {
            $('#multifromwhat').attr('placeholder','Enter Country');
        } else if(migrants == "Barangay") {
            $('#multifromwhat').attr('placeholder','Enter Barangay');
        } else if(migrants == "Province") {
            $('#multifromwhat').attr('placeholder','Enter Province');
        }

    });

    function checkmultiage(multidoba) {
        var dtext = $('#multidoba').val();

        var cdate = new Date(dtext);
        var dtest = new Date();

        var ndate = dtest.toJSON().slice(0, 10);
        var arr = [];
        var arrcs = [];
        $('#multicvstat option').each(function() {
            arr.push($(this).val())
        });
        $('#multieducatt option').each(function() {
            arrcs.push($(this).val())
        });
        var age = dtest.getFullYear() - cdate.getFullYear();

        if(dtext == ndate || age < 5 ) {
            $('#multicvstat').val(arr[0]);
            $('#multieducatt').val(arrcs[6  ]);
        }
        if (age >= 1 ) {
            $('#multioccup').show();
        } else {
            $('#multioccup').hide();
        }

        if (age >=18){
            $('#showMultiSoloParent').show();
            $('#showMultiRegisteredVoter').show();
        } else {
            $('#showMultiSoloParent').hide();
            $('#showMultiRegisteredVoter').hide();
        }

        if (age >=60){
            $('#showMultiSeniorCitizen').show();
        } else {
            $('#showMultiSeniorCitizen').hide();
        }
    }
    function checkeditage(dobselect, doboption) {
       console.log(doboption)
    var cdate = new Date(dobselect);
    var dtest = new Date();

    var ndate = dtest.toJSON().slice(0, 10);
    var arr = [];
    var arrcs = [];
    var age = dtest.getFullYear() - cdate.getFullYear();

        $( doboption +' option').each(function() {
            arrcs.push($(this).val())
        });
        console.log(arrcs);
        if(age >= 0 && age <= 18  ) {
            $(doboption).val(arrcs[0]);
        }

    }

    function checkage(dobselect) {
        var dtext = "";
        if(dobselect == "#dateofbirth") {
           dtext  = $(dobselect).val();
       }
       else {
        dtext = $('#dateofbirth').val()
    }
    var cdate = new Date(dtext);
    var dtest = new Date();

    var ndate = dtest.toJSON().slice(0, 10);
    var arr = [];
    var arrcs = [];
    $('#educationatt option').each(function() {
        arr.push($(this).val())
    });
    var age = dtest.getFullYear() - cdate.getFullYear();

    if(dtext == ndate || age < 5 ) {
        $('#educationatt').val(arr[6]);
    }

    $('#civilstatus option').each(function() {
        arrcs.push($(this).val())
    });

    if(age >= 0 && age <= 18  ) {
        $('#civilstatus').val(arrcs[0]);

    }
    // if(age == 0) { 
    //     $('#mshowoccu').hide() 
    // } else $('#mshowoccu').show()
    if (age >= 15){
        $('#mshowoccu').show();
    } else $('#mshowoccu').hide();

    if (age >= 18){
        $('#showSoloParent').show();
        $('#showRegisteredVoter').show();
        
    } else {
        $('#showSoloParent').hide();
        $('#showRegisteredVoter').hide();
    }

    if (age >= 60){
        $('#showSeniorCitizen').show();
    } else {
        $('#showSeniorCitizen').hide();
    }
}

$(document).on('keyup','.Occupation',function(){
    var occu = $(this).val();
    if(occu == "" || occu == "None" || occu == "none") {
        $('#mshowwork').hide();
    }
    else {
        $('#mshowwork').show();
    }
})


$(document).on('keyup','.multioccupation',function(){
    var occu = $(this).val();
    if(occu == "" || occu == "None" || occu == "none") {
        $('.multi_showwork').hide();
    }
    else {
        $('.multi_showwork').show();
    }
});

var n = []; var inf = []; var c = []; var a = []; var e = [];  var dobs = []; var age = [];
var cdate = []; var rgdate = []; var ryear = []; var rmont = []; var rday = []; var cyear = []; var cmon = []; var cday = [];
var current_year = []; var dob_year = []; var days = []; var start = [];  var end = []; var fnames = []; var mnames = []; var lnames = [];
var multireltohead=[];
$(document).ready(function(){
    
}) ;
$(document).on('click','.sw-btn-prev', function() {
    $('#summary_tabl tbody tr').remove();
    $('#summary_housing tbody tr').remove();
    $('#summary_utility tbody tr').remove();
    $('#summary_entertainment tbody tr').remove();
    $("#smrynewborn").css("background-color", "");
    $("#smryinfant").css("background-color", "");
    $("#smrychild").css("background-color", "");
    $("#smryadolescent").css("background-color", "");
    $("#smryelderly").css("background-color", "");

    n = []; inf = []; c = []; a = []; e = []; dobs = []; age = []; cdate = []; rgdate = []; ryear = []; rmont = []; rday = [];
    cyear = []; cmon = []; cday = []; current_year = []; days = []; dob_year = [];
    start = []; end = []; fnames = []; mnames = []; lnames = []; multireltohead = [];
    $(".sw-btn-next").attr("disabled", false);
    $('#step-3').hide();
   // window.location.href = '#step-1';
});

 ;(function ($, window, document, undefined) {
    "use strict";
    // Default options
    var defaults = {
            selected: 0,  // Initial selected step, 0 = first step
            keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
            autoAdjustHeight: true, // Automatically adjust content height
            cycleSteps: false, // Allows to cycle the navigation of steps
            backButtonSupport: true, // Enable the back button support
            useURLhash: true, // Enable selection of the step based on url hash
            showStepURLhash: true, // Show url hash based on step
            lang: {  // Language variables for button
                next: 'Next',
                previous: 'Previous'
            },
            toolbarSettings: {
                toolbarPosition: 'bottom', // none, top, bottom, both
                toolbarButtonPosition: 'right', // left, right
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                toolbarExtraButtons: [] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
            },
            anchorSettings: {
                anchorClickable: true, // Enable/Disable anchor navigation
                enableAllAnchors: false, // Activates all anchors clickable all times
                markDoneStep: true, // Add done css
                markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                removeDoneStepOnNavigateBack: false, // While navigate back done step after active step will be cleared
                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
            },
            contentURL: null, // content url, Enables Ajax content loading. Can also set as data data-content-url on anchor
            contentCache: true, // cache step contents, if false content is fetched always from ajax url
            ajaxSettings: {}, // Ajax extra settings
            disabledSteps: [], // Array Steps disabled
            errorSteps: [], // Highlight step with errors
            hiddenSteps: [], // Hidden steps
            theme: 'default', // theme for the wizard, related css need to include for other than default theme
            transitionEffect: 'none', // Effect on navigation, none/slide/fade
            transitionSpeed: '400'
        };

    // The plugin constructor
    function SmartWizard(element, options) {
        // Merge user settings with default, recursively
        this.options = $.extend(true, {}, defaults, options);
        // Main container element
        this.main = $(element);
        // Navigation bar element
        this.nav = this.main.children('ul');
        // Step anchor elements
        this.steps = $("li > a", this.nav);
        // Content container
        this.container = this.main.children('div');
        // Content pages
        this.pages = this.container.children('div');
        // Active step index
        this.current_index = null;
        // Call initial method
        this.init();
    }

    $.extend(SmartWizard.prototype, {

        init: function () {
            // Set the elements
            this._setElements();
            // Add toolbar
            this._setToolbar();
            // Assign plugin events
            this._setEvents();

            var idx = this.options.selected;
            // Get selected step from the url
            if(this.options.useURLhash){
                // Get step number from url hash if available
                var hash = window.location.hash;
                if(hash && hash.length > 0){
                    var elm = $("a[href*='" + hash + "']", this.nav);
                    if(elm.length > 0){
                        var id = this.steps.index(elm);
                        idx = (id >= 0) ? id : idx;
                    }
                }
            }

            if(idx > 0 && this.options.anchorSettings.markDoneStep && this.options.anchorSettings.markAllPreviousStepsAsDone){
                // Mark previous steps of the active step as done
                this.steps.eq(idx).parent('li').prevAll().addClass("done");
            }

            // Show the initial step
            this._showStep(idx);
        },

// PRIVATE FUNCTIONS

_setElements: function () {
            // Set the main element
            this.main.addClass('sw-main sw-theme-' + this.options.theme);
            // Set anchor elements
            this.nav.addClass('nav nav-tabs step-anchor'); // nav-justified  nav-pills
            // Make the anchor clickable
            if(this.options.anchorSettings.enableAllAnchors !== false && this.options.anchorSettings.anchorClickable !== false){ this.steps.parent('li').addClass('clickable'); }
            // Set content container
            this.container.addClass('sw-container tab-content');
            // Set content pages
            this.pages.addClass('step-content');

            // Disabled steps
            var mi = this;
            if(this.options.disabledSteps && this.options.disabledSteps.length > 0){
                $.each(this.options.disabledSteps, function(i, n){
                    mi.steps.eq(n).parent('li').addClass('disabled');
                });
            }
            // Error steps
            if(this.options.errorSteps && this.options.errorSteps.length > 0){
              $.each(this.options.errorSteps, function(i, n){
                mi.steps.eq(n).parent('li').addClass('danger');
            });
          }
            // Hidden steps
            if(this.options.hiddenSteps && this.options.hiddenSteps.length > 0){
              $.each(this.options.hiddenSteps, function(i, n){
                mi.steps.eq(n).parent('li').addClass('hidden');
            });
          }

          return true;
      },
      _setToolbar: function () {
            // Skip right away if the toolbar is not enabled
            if(this.options.toolbarSettings.toolbarPosition === 'none'){ return true; }

            // Create the toolbar buttons
            var btnNext = (this.options.toolbarSettings.showNextButton !== false) ? $('<button></button>').text(this.options.lang.next).addClass('btn btn-default sw-btn-next').attr('type','button') : null;
            var btnPrevious = (this.options.toolbarSettings.showPreviousButton !== false) ? $('<button></button>').text(this.options.lang.previous).addClass('btn btn-default sw-btn-prev').attr('type','button') : null;
            var btnGroup = $('<div></div>').addClass('btn-group navbar-btn sw-btn-group pull-' + this.options.toolbarSettings.toolbarButtonPosition).attr('role','group').append(btnPrevious, btnNext);

            // Add extra toolbar buttons
            var btnGroupExtra = null;

            if(this.options.toolbarSettings.toolbarExtraButtons && this.options.toolbarSettings.toolbarExtraButtons.length > 0){
                btnGroupExtra = $('<div></div>').addClass('btn-group navbar-btn sw-btn-group-extra pull-' + this.options.toolbarSettings.toolbarButtonPosition).attr('role','group');
                $.each(this.options.toolbarSettings.toolbarExtraButtons, function( i, n ) {
                    btnGroupExtra.append(n.clone(true));
                });
            }

            var toolbarTop, toolbarBottom;
            // Append toolbar based on the position
            switch(this.options.toolbarSettings.toolbarPosition){
                case 'top':
                toolbarTop = $('<nav></nav>').addClass('navbar btn-toolbar sw-toolbar sw-toolbar-top');
                toolbarTop.append(btnGroup);
                if(this.options.toolbarSettings.toolbarButtonPosition === 'left'){
                    toolbarTop.append(btnGroupExtra);
                }else{
                    toolbarTop.prepend(btnGroupExtra);
                }
                this.container.before(toolbarTop);
                break;
                case 'bottom':
                toolbarBottom = $('<nav></nav>').addClass('navbar btn-toolbar sw-toolbar sw-toolbar-bottom');
                toolbarBottom.append(btnGroup);
                if(this.options.toolbarSettings.toolbarButtonPosition === 'left'){
                    toolbarBottom.append(btnGroupExtra);
                }else{
                    toolbarBottom.prepend(btnGroupExtra);
                }
                this.container.after(toolbarBottom);
                break;
                case 'both':
                toolbarTop = $('<nav></nav>').addClass('navbar btn-toolbar sw-toolbar sw-toolbar-top');
                toolbarTop.append(btnGroup);
                if(this.options.toolbarSettings.toolbarButtonPosition === 'left'){
                    toolbarTop.append(btnGroupExtra);
                }else{
                    toolbarTop.prepend(btnGroupExtra);
                }
                this.container.before(toolbarTop);

                toolbarBottom = $('<nav></nav>').addClass('navbar btn-toolbar sw-toolbar sw-toolbar-bottom');
                toolbarBottom.append(btnGroup.clone(true));
                if(this.options.toolbarSettings.toolbarButtonPosition === 'left'){
                    toolbarBottom.append(btnGroupExtra.clone(true));
                }else{
                    toolbarBottom.prepend(btnGroupExtra.clone(true));
                }
                this.container.after(toolbarBottom);
                break;
                default:
                toolbarBottom = $('<nav></nav>').addClass('navbar btn-toolbar sw-toolbar sw-toolbar-bottom');
                toolbarBottom.append(btnGroup);
                if(this.options.toolbarSettings.toolbarButtonPosition === 'left'){
                    toolbarBottom.append(btnGroupExtra);
                }else{
                    toolbarBottom.prepend(btnGroupExtra);
                }
                this.container.after(toolbarBottom);
                break;
            }
            return true;
        },
        _setEvents: function () {
            // Anchor click event
            var mi = this;
            $(this.steps).on( "click", function(e) {
                e.preventDefault();
                if(mi.options.anchorSettings.anchorClickable === false) { return true; }
                var idx = mi.steps.index(this);
                if(mi.options.anchorSettings.enableAnchorOnDoneStep === false && mi.steps.eq(idx).parent('li').hasClass('done')) { return true; }

                if(idx !== mi.current_index) {
                    if(mi.options.anchorSettings.enableAllAnchors !== false && mi.options.anchorSettings.anchorClickable !== false){
                        mi._showStep(idx);
                    }else{
                        if(mi.steps.eq(idx).parent('li').hasClass('done')){
                            mi._showStep(idx);
                        }
                    }
                }
            });

            // Next button event
            $('.sw-btn-next', this.main).on( "click", function(e) {
                e.preventDefault();

                var registrationForm = $('#MicForm');
                

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
                })

                
                if(registrationForm.length){

                      registrationForm.validate({
                        onfocusout: false,
                        invalidHandler: function(form, validator) {
                            var errors = validator.numberOfInvalids();
                            if (errors) {
                                validator.errorList[0].element.focus();
                            }
                        },

                        rules:{
                          firstname: {
                              required: true,
                              nowhitespace: true,
                              lettersonly: true
                          },
                          middlename: {

                              nowhitespace: true,
                              lettersonly: true
                          },
                          lastname: {
                              required: true,
                              nowhitespace: true,
                              lettersonly: true
                          },
                          qualifier: {
                              nowhitespace: true,
                              lettersonly: true
                          },
                          dateofbirth: {
                              required: true

                          },
                          placeofbirth: {
                              required: true,


                          },
                          Citizenship: {
                            required: true,
                            nowhitespace: true,
                            lettersonly: true
                        },
                        houseno: {
                            required: true,


                        },
                        hstreet: {
                            required: true,

                        },
                        hphase: {
                            required: true,


                        },
                    },
                    messages:{
                      firstname: {
                          required: 'This field is required',
                          nowhitespace: 'No white space allowed',
                          lettersonly: 'letters only'
                      },
                      middlename: {
                          nowhitespace: 'No white space allowed',
                          lettersonly: 'letters only'
                      },
                      lastname: {
                          required: 'This field is required',
                          nowhitespace: 'No white space allowed',
                          lettersonly: 'letters only'
                      },
                      qualifier: {
                          nowhitespace: 'No white space allowed',
                          lettersonly: 'letters only'
                      },
                      dateofbirth: {
                          required: 'This field is required'
                      },
                      placeofbirth: {
                          required: 'This field is required',

                      },
                      Citizenship: {
                          required: 'This field is required',
                          nowhitespace: 'No white space allowed',
                          lettersonly: 'letters only'
                      },
                  },

                  errorPlacement: function(error, element)
                  {
                    if (element.is(":radio"))
                    {
                        error.appendTo(element.parents('.gender'));
                    }
                    else if(element.is(":checkbox")){
                        error.appendTo(element.parents('.hobbies'));
                    }
                    else
                    {
                        error.insertAfter( element );
                    }
                }

            });

            }

            if($('#MicForm').valid()) {
                 if(mi.steps.index(this) !== mi.current_index) {
                    loadsummary();
                    mi._showNext();
                }
            }

            
        });

            // Previous button event
            $('.sw-btn-prev', this.main).on( "click", function(e) {
                e.preventDefault();
                if(mi.steps.index(this) !== mi.current_index) {
                    mi._showPrevious();
                }
            });

            // Keyboard navigation event
            if(this.options.keyNavigation){
                $(document).keyup(function(e){
                    mi._keyNav(e);
                });
            }

            // Back/forward browser button event
            if(this.options.backButtonSupport){
                $(window).on('hashchange', function(e) {
                    if(!mi.options.useURLhash) { return true; }
                    if(window.location.hash) {
                        var elm = $("a[href*='"+window.location.hash+"']", mi.nav);
                        if(elm && elm.length > 0){
                            e.preventDefault();
                            mi._showStep(mi.steps.index(elm));
                        }
                    }
                });
            }

            return true;
        },
        _showNext: function () {
            var si = this.current_index + 1;
            // Find the next not disabled step
            for(var i = si; i < this.steps.length; i++){
                if(!this.steps.eq(i).parent('li').hasClass('disabled') && !this.steps.eq(i).parent('li').hasClass('hidden')){
                    si=i;
                    break;
                }
            }

            if(this.steps.length <= si){
              if(!this.options.cycleSteps){ return false; }
              si = 0;
          }
          this._showStep(si);
          return true;
      },
      _showPrevious: function () {
        var si = this.current_index - 1;
            // Find the previous not disabled step
            for(var i = si; i >= 0; i--){
                if(!this.steps.eq(i).parent('li').hasClass('disabled') && !this.steps.eq(i).parent('li').hasClass('hidden')){
                    si=i;
                    break;
                }
            }
            if(0 > si){
              if(!this.options.cycleSteps){ return false; }
              si = this.steps.length - 1;
          }
          this._showStep(si);
          return true;
      },
      _showStep: function (idx) {
            // If step not found, skip
            if(!this.steps.eq(idx)){ return false; }
            // If current step is requested again, skip
            if(idx == this.current_index){ return false; }
            // If it is a disabled step, skip
            if(this.steps.eq(idx).parent('li').hasClass('disabled') || this.steps.eq(idx).parent('li').hasClass('hidden')){ return false; }
            // Load step content
            this._loadStepContent(idx);
            return true;
        },
        _loadStepContent: function (idx) {
            var mi = this;
            // Get current step elements
            var curTab = this.steps.eq(this.current_index);
            // Get the direction of step navigation
            var stepDirection = '';
            var elm = this.steps.eq(idx);
            var contentURL = (elm.data('content-url') && elm.data('content-url').length > 0) ? elm.data('content-url') : this.options.contentURL;

            if(this.current_index !== null && this.current_index !== idx){
                stepDirection = (this.current_index < idx) ? "forward" : "backward";
            }

            // Trigger "leaveStep" event
            if(this.current_index !== null && this._triggerEvent("leaveStep", [curTab, this.current_index, stepDirection]) === false){ return false; }

            if(contentURL && contentURL.length > 0 && (!elm.data('has-content') || !this.options.contentCache)){
                // Get ajax content and then show step
                var selPage = (elm.length>0) ? $(elm.attr("href"),this.main) : null;

                var ajaxSettings = $.extend(true, {}, {
                    url: contentURL,
                    type: "POST",
                    data: ({step_number : idx}),
                    dataType: "text",
                    beforeSend: function(){
                        elm.parent('li').addClass('loading');
                    },
                    error: function(jqXHR, status, message){
                        elm.parent('li').removeClass('loading');
                        $.error(message);
                    },
                    success: function(res){
                        if(res && res.length > 0){
                            elm.data('has-content',true);
                            selPage.html(res);
                        }
                        elm.parent('li').removeClass('loading');
                        mi._transitPage(idx);
                    }
                }, this.options.ajaxSettings);

                $.ajax(ajaxSettings);
            }else{
                // Show step
                this._transitPage(idx);
            }
            return true;
        },
        _transitPage: function (idx) {
            var mi = this;
            // Get current step elements
            var curTab = this.steps.eq(this.current_index);
            var curPage = (curTab.length>0) ? $(curTab.attr("href"),this.main) : null;
            // Get step to show elements
            var selTab = this.steps.eq(idx);
            var selPage = (selTab.length>0) ? $(selTab.attr("href"),this.main) : null;
            // Get the direction of step navigation
            var stepDirection = '';
            if(this.current_index !== null && this.current_index !== idx){
                stepDirection = (this.current_index < idx) ? "forward" : "backward";
            }

            var stepPosition = 'middle';
            if(idx === 0){
                stepPosition = 'first';
            }else if(idx === (this.steps.length-1)){
                stepPosition = 'final';
            }

            this.options.transitionEffect = this.options.transitionEffect.toLowerCase();
            this.pages.finish();
            if(this.options.transitionEffect === 'slide'){ // normal slide
                if(curPage && curPage.length > 0){
                    curPage.slideUp('fast',this.options.transitionEasing,function(){
                        selPage.slideDown(mi.options.transitionSpeed,mi.options.transitionEasing);
                    });
                }else{
                    selPage.slideDown(this.options.transitionSpeed,this.options.transitionEasing);
                }
            }else if(this.options.transitionEffect === 'fade'){ // normal fade
                if(curPage && curPage.length > 0){
                    curPage.fadeOut('fast',this.options.transitionEasing,function(){
                        selPage.fadeIn('fast',mi.options.transitionEasing,function(){
                            $(this).show();
                        });
                    });
                }else{
                    selPage.fadeIn(this.options.transitionSpeed,this.options.transitionEasing,function(){
                        $(this).show();
                    });
                }
            }else{
                if(curPage && curPage.length > 0) { curPage.hide(); }
                selPage.show();
            }
            // Change the url hash to new step
            this._setURLHash(selTab.attr("href"));
            // Update controls
            this._setAnchor(idx);
            // Set the buttons based on the step
            this._setButtons(idx);
            // Fix height with content
            this._fixHeight(idx);
            // Update the current index
            this.current_index = idx;

            // Trigger "showStep" event
            this._triggerEvent("showStep", [selTab, this.current_index, stepDirection, stepPosition]);
            return true;
        },
        _setAnchor: function (idx) {
            // Current step anchor > Remove other classes and add done class
            this.steps.eq(this.current_index).parent('li').removeClass("active danger loading");
            if(this.options.anchorSettings.markDoneStep !== false && this.current_index !== null){
                this.steps.eq(this.current_index).parent('li').addClass("done");
                if(this.options.anchorSettings.removeDoneStepOnNavigateBack !== false){
                    this.steps.eq(idx).parent('li').nextAll().removeClass("done");
                }
            }

            // Next step anchor > Remove other classes and add active class
            this.steps.eq(idx).parent('li').removeClass("done danger loading").addClass("active");
            return true;
        },
        _setButtons: function (idx) {
            // Previous/Next Button enable/disable based on step
            if(!this.options.cycleSteps){
                if(0 >= idx){
                  $('.sw-btn-prev', this.main).addClass("disabled");
              }else{
                  $('.sw-btn-prev', this.main).removeClass("disabled");
              }
              if((this.steps.length-1) <= idx){
                  $('.sw-btn-next', this.main).addClass("disabled");
              }else{
                  $('.sw-btn-next', this.main).removeClass("disabled");
              }
          }
          return true;
      },

// HELPER FUNCTIONS

_keyNav: function (e) {
    var mi = this;
            // Keyboard navigation
            switch(e.which) {
                case 37: // left
                mi._showPrevious();
                e.preventDefault();
                break;
                case 39: // right
                mi._showNext();
                e.preventDefault();
                break;
                default: return; // exit this handler for other keys
            }
        },
        _fixHeight: function (idx) {
            // Auto adjust height of the container
            if(this.options.autoAdjustHeight){
                var selPage = (this.steps.eq(idx).length > 0) ? $(this.steps.eq(idx).attr("href"),this.main) : null;
                this.container.finish().animate({minHeight: selPage.outerHeight()}, this.options.transitionSpeed, function(){});
            }
            return true;
        },
        _triggerEvent: function (name, params) {
            // Trigger an event
            var e = $.Event(name);
            this.main.trigger(e, params);
            if (e.isDefaultPrevented()) { return false; }
            return e.result;
        },
        _setURLHash: function (hash) {
            if(this.options.showStepURLhash && window.location.hash !== hash){
                window.location.hash = hash;
            }
        },

// PUBLIC FUNCTIONS

theme: function (v) {
    if(this.options.theme === v) { return false; }
    this.main.removeClass('sw-theme-' + this.options.theme);
    this.options.theme = v;
    this.main.addClass('sw-theme-' + this.options.theme);
            // Trigger "themeChanged" event
            this._triggerEvent("themeChanged", [this.options.theme]);
        },
        next: function () {
            this._showNext();
        },
        prev: function () {
            this._showPrevious();
        },
        reset: function () {
            // Trigger "beginReset" event
            if(this._triggerEvent("beginReset") === false){ return false; }

            // Reset all elements and classes
            this.container.stop(true);
            this.pages.stop(true);
            this.pages.hide();
            this.current_index = null;
            this._setURLHash(this.steps.eq(this.options.selected).attr("href"));
            $(".sw-toolbar", this.main).remove();
            this.steps.removeClass();
            this.steps.parents('li').removeClass();
            this.steps.data('has-content', false);
            this.init();

            // Trigger "endReset" event
            this._triggerEvent("endReset");
        },
        stepState: function (stepArray, state) {
            var mi = this;
            stepArray = $.isArray(stepArray) ? stepArray : [stepArray];
            var selSteps = $.grep( this.steps, function( n, i ) {
                return ($.inArray(i, stepArray) !== -1 && i !== mi.current_index);
            });
            if(selSteps && selSteps.length > 0){
                switch (state)
                {
                    case 'disable':
                    $(selSteps).parents('li').addClass('disabled');
                    break;
                    case 'enable':
                    $(selSteps).parents('li').removeClass('disabled');
                    break;
                    case 'hide':
                    $(selSteps).parents('li').addClass('hidden');
                    break;
                    case 'show':
                    $(selSteps).parents('li').removeClass('hidden');
                    break;
                }
            }
        }
    });

    // Wrapper for the plugin
    $.fn.smartWizard = function(options) {
        var args = arguments;
        var instance;

        if (options === undefined || typeof options === 'object') {
            return this.each( function() {
                if ( !$.data( this, "smartWizard") ) {
                    $.data( this, "smartWizard", new SmartWizard( this, options ) );
                }
            });
        } else if (typeof options === 'string' && options[0] !== '_' && options !== 'init') {
            instance = $.data(this[0], 'smartWizard');

            if (options === 'destroy') {
                $.data(this, 'smartWizard', null);
            }

            if (instance instanceof SmartWizard && typeof instance[options] === 'function') {
                return instance[options].apply( instance, Array.prototype.slice.call( args, 1 ) );
            } else {
                return this;
            }
        }
    };

})(jQuery, window, document);
function loadsummary() {



  var $multirelstohead = [];


    $('#step-3').show();

    $("input[name=firstname]").each(function() {
        fnames.push($(this).val())
    });

    $("input[name=middlename]").each(function() {
        mnames.push($(this).val())
    });

    $("input[name=lastname]").each(function() {
        lnames.push($(this).val())
    });

    $("input[name=dateofbirth]").each(function() {
        dobs.push($(this).val())
    });

    if(fnames.length >= 1) {

    }
    $multirelstohead[0] = "Household Head";
     $(".multireltohead option:selected").each(function(){

             $multirelstohead.push($(this).val())
        });

        $(".multifname").each(function() {
            fnames.push($(this).val())
        });

        $(".multimname").each(function() {
            mnames.push($(this).val())
        });

        $(".multilname").each(function() {
            lnames.push($(this).val())
        });


        $(".multidoba").each(function() {
            dobs.push($(this).val())
        });





    console.log($multirelstohead)



    for(var i=0; i<dobs.length; i++) {
        cdate.push(new Date(Date.now()));
        rgdate.push(new Date(dobs[i]));
        ryear[i] = parseInt(rgdate[i].getFullYear());
        rmont[i] = parseInt(String(rgdate[i].getMonth() + 1).padStart(2, '0'));
        rday[i] = parseInt(String(rgdate[i].getDate()).padStart(2, '0'));
        cyear[i] = parseInt(cdate[i].getFullYear());
        cmon[i] = parseInt(cdate[i].getMonth() + 1);
        cday[i] = parseInt(String(cdate[i].getDate()).padStart(2, '0'));
        age[i] = cyear[i] - ryear[i];

        if (rday[i] >= 32) { rday[i] = 1; }
        if (rmont[i] >= 13) { rmont[i] = 1; }

        current_year[i] = new Date(cyear[i],cmon[i],cday[i]);
        dob_year[i] = new Date(ryear[i],rmont[i],rday[i]);
        const oneDay = 1000 * 60 * 60 * 24;
            //days[i] = DaysBetween(dob_year,current_year);
            start[i] = Date.UTC(current_year[i].getFullYear(), current_year[i].getMonth(), current_year[i].getDate());
            end[i] = Date.UTC(dob_year[i].getFullYear(), dob_year[i].getMonth(), dob_year[i].getDate());
            days[i] = Math.round(Math.abs((start[i] - end[i] ) / oneDay));

            if (age[i]==0 || age[i]<0) {

                if (days[i] <= 28 && days[i] >= 0) {
                     //fcolors[i]="#ffcdcc";
                     n[i]="Yes";inf[i]="No";c[i]="No";a[i]="No";e[i]="No";
                 }
                 if (days[i] > 28 || days[i] < 365 ) {
                    n[i]="No";inf[i]="Yes";c[i]="No";a[i]="No";e[i]="No";
                }
            }
            if (age[i] >= 1 && age[i] <= 10) {
                n[i]="No";inf[i]="No";c[i]="Yes";a[i]="No";e[i]="No";
            }
            if (age[i] >= 11 && age[i] <= 59) {
                n[i]="No";inf[i]="No";c[i]="No";a[i]="Yes";e[i]="No";
            }
            if (age[i] >= 60) {
                n[i]="No";inf[i]="No";c[i]="No";a[i]="No";e[i]="Yes";
            }



        }

        var j=1;
        $('#summary_tabl').closest('table').find('tbody').append(

            '<tr>\n'
            +'<td style="font-weight: bold; border: 1px solid black; text-align: center;">List\'s of household members<p></p></td>\n'

            +'<tr>\n'
            +'<td>Name of Member</td>\n'
            +'<td>Relationship to Household Head</td>\n'
            +'<td>New Born</td>\n'
            +'<td>Infant</td>\n'
            +'<td>Child</td>\n'
            +'<td>Adolescent</td>\n'
            +'<td>Elderly</td>\n'
            +'<tr>\n'
            +'<tr>\n'
            );
        console.log(fnames)
        console.log(mnames)
        console.log(lnames)
        console.log($multirelstohead)
        console.log(dobs.length)
        var ncolors = []; var icolors = []; var ccolors = []; var acolors = []; var ecolors = []; var table;
        var length = 0;
        for (var i=0; i<dobs.length; i++ ) {

            n[i]=="Yes"?ncolors[i]="#ddefc9":ncolors[i]="#ffcdcc";
            inf[i]=="Yes"?icolors[i]="#ddefc9":icolors[i]="#ffcdcc";
            c[i]=="Yes"?ccolors[i]="#ddefc9":ccolors[i]="#ffcdcc";
            a[i]=="Yes"?acolors[i]="#ddefc9":acolors[i]="#ffcdcc";
            e[i]=="Yes"?ecolors[i]="#ddefc9":ecolors[i]="#ffcdcc";
            if(n[i] != undefined || i[i] != undefined || c[i] != undefined || a[i] != undefined || e[i] != undefined ) {
            $('#summary_tabl').closest('table').find('tbody').append(
                '<tr>\n'

                +'<td colspan="1" style="font-weight:bold" id="multimembers" name="multimembers">'
                +j++ +'.    '+fnames[i] +' '+mnames[i]+' '+lnames[i]
                +'</td> \n'
                +'<td id="smryrelation">'+$multirelstohead[i]+'</td>\n'
                +'<td id="smrynewborn" style="background-color:'+ncolors[i]+'">'+n[i]+'</td>\n'
                +'<td id="smryinfant" style="background-color:'+icolors[i]+'">'+inf[i]+'</td>\n'
                +'<td id="smrychild" style="background-color:'+ccolors[i]+'">'+c[i]+'</td>\n'
                +'<td id="smryadolescent" style="background-color:'+acolors[i]+'">'+a[i]+'</td>\n'
                +'<td id="smryelderly" style="background-color:'+ecolors[i]+'">'+e[i]+'</td>\n'


                );
            length+=1;
            }


        }

        $('#summary_tabl').closest('table').find('tbody').append(

            +'<tr>\n'
            +'<tr>\n'
            +'<td></td>\n'
            +'<td></td>\n'
            +'<td></td>\n'
            +'<td></td>\n'
            +'<td></td>\n'
            +'<td></td>\n'
            +'<td></td>\n'
            +'<tr>\n'
            +'<tr>\n'
            +'<td style="font-weight: bold">TOTAL: '+length+'</td>\n'
            +'<td></td>\n'
            +'<td></td>\n'
            +'<td style="font-weight: bold"></td>\n'
            +'<td></td>\n'
            +'<td></td>\n'
            +'<td></td>\n'
            +'<tr>\n'
            +'<tr>\n'+'<tr>\n'+'<tr>\n'+'<tr>\n'+'<tr>\n'+'<tr>\n'+'<tr>\n'+'<tr>\n'

            );


        $('#summary_housing').closest('table').find('tbody').append(

            '<tr>\n'
            +'<td style="font-weight: bold; text-align: center;">Nature of the House<p></p></td>\n'

            +'<tr>\n'
            +'<td>With Toilet</td>\n'
            +'<td>With Play Area</td>\n'
            +'<td>With Bedroom</td>\n'
            +'<td>With Dining Room</td>\n'
            +'<td>With Sala</td>\n'
            +'<td>With Kitchen</td>\n'
            +'<tr>\n'
            +'<tr>\n'
            );

        if($("#cssCheckbox1Toilet").is(":checked")){smrytoilet="&#10003;"}else{smrytoilet="&times;"}
        if($("#cssCheckbox2Playarea").is(":checked")){smryparea="&#10003;"}else{smryparea="&times;"}
        if($("#cssCheckbox3Bedroom").is(":checked")){smrybedroom="&#10003;"}else{smrybedroom="&times;"}
        if($("#cssCheckbox4diningroom").is(":checked")){smrydroom="&#10003;"}else{smrydroom="&times;"}
        if($("#cssCheckbox5sala").is(":checked")){smrysala="&#10003;"}else{smrysala="&times;"}
        if($("#cssCheckbox6kitchen").is(":checked")){smrykitcheb="&#10003;"}else{smrykitcheb="&times;"}
   // val="&#10003;"

   $('#summary_housing').closest('table').find('tbody').append(
    '<tr>\n'

    +'<td id=""><span id="smrytoilet" style="font-weight: bold; font-size: 20px">'+smrytoilet+'</span></td> \n'
    +'<td id=""><span id="smryparea" style="font-weight: bold; font-size: 20px">'+smryparea+'</span></td>\n'

    +'<td id="" style="background-color:"><span id="smrybedroom" style="font-weight: bold; font-size: 20px">'+smrybedroom+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrydroom" style="font-weight: bold; font-size: 20px">'+smrydroom+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrysala" style="font-weight: bold; font-size: 20px">'+smrysala+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrykitcheb" style="font-weight: bold; font-size: 20px">'+smrykitcheb+'</span></td>\n'
    );


   $('#summary_utility').closest('table').find('tbody').append(

    '<tr>\n'
    +'<td style="font-weight: bold; text-align: center;">Utilities Available<p></p></td>\n'

    +'<tr>\n'
    +'<td>Running Water</td>\n'
    +'<td>Electricity</td>\n'
    +'<td>Aircon</td>\n'
    +'<td>Mobile Phone</td>\n'
    +'<td>Computer</td>\n'
    +'<td>Internet</td>\n'
    +'<td>Television</td>\n'
    +'<td>CD/DVD Player</td>\n'
    +'<td>Radio</td>\n'
    +'<tr>\n'
    +'<tr>\n'
    );

   if($("#cssCheckboxRunningwater").is(":checked")){smrytoilet="&#10003;"}else{smrytoilet="&times;"}
   if($("#cssCheckboxElectricity").is(":checked")){smryparea="&#10003;"}else{smryparea="&times;"}
   if($("#cssCheckboxaircon").is(":checked")){smrybedroom="&#10003;"}else{smrybedroom="&times;"}
   if($("#cssCheckboxmobilephone").is(":checked")){smrydroom="&#10003;"}else{smrydroom="&times;"}
   if($("#cssCheckboxcomputer").is(":checked")){smrysala="&#10003;"}else{smrysala="&times;"}
   if($("#cssCheckboxinternet").is(":checked")){smrykitcheb="&#10003;"}else{smrykitcheb="&times;"}

   if($("#cssCheckboxtv").is(":checked")){smrytv="&#10003;"}else{smrytv="&times;"}
   if($("#cssCheckboxcdplayer").is(":checked")){smryplayer="&#10003;"}else{smryplayer="&times;"}
   if($("#cssCheckboxradio").is(":checked")){smryradio="&#10003;"}else{smryradio="&times;"}
   // val="&#10003;"

   $('#summary_utility').closest('table').find('tbody').append(
    '<tr>\n'

    +'<td id=""><span id="smrytoilet" style="font-weight: bold; font-size: 20px">'+smrytoilet+'</span></td> \n'
    +'<td id=""><span id="smryparea" style="font-weight: bold; font-size: 20px">'+smryparea+'</span></td>\n'

    +'<td id="" style="background-color:"><span id="smrybedroom" style="font-weight: bold; font-size: 20px">'+smrybedroom+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrydroom" style="font-weight: bold; font-size: 20px">'+smrydroom+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrysala" style="font-weight: bold; font-size: 20px">'+smrysala+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrykitcheb" style="font-weight: bold; font-size: 20px">'+smrykitcheb+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrykitcheb" style="font-weight: bold; font-size: 20px">'+smrytv+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrykitcheb" style="font-weight: bold; font-size: 20px">'+smryplayer+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrykitcheb" style="font-weight: bold; font-size: 20px">'+smryradio+'</span></td>\n'
    );

   $('#summary_entertainment').closest('table').find('tbody').append(

    '<tr>\n'
    +'<td style="font-weight: bold; text-align: center;">Utilities Available<p></p></td>\n'

    +'<tr>\n'
    +'<td>Comics/Magazines</td>\n'
    +'<td>Newspapers</td>\n'
    +'<td>Pets</td>\n'
    +'<td>Books</td>\n'
    +'<td>Story Books</td>\n'
    +'<td>Toys</td>\n'
    +'<td>Board Games</td>\n'
    +'<td>Puzzles</td>\n'

    +'<tr>\n'
    +'<tr>\n'
    );

   if($("#cssCheckboxradio").is(":checked")){smrytoilet="&#10003;"}else{smrytoilet="&times;"}
   if($("#cssCheckboxcomics").is(":checked")){smryparea="&#10003;"}else{smryparea="&times;"}
   if($("#cssCheckboxNewspaper").is(":checked")){smrybedroom="&#10003;"}else{smrybedroom="&times;"}
   if($("#cssCheckboxPets").is(":checked")){smrydroom="&#10003;"}else{smrydroom="&times;"}
   if($("#cssCheckboxbooks").is(":checked")){smrysala="&#10003;"}else{smrysala="&times;"}
   if($("#cssCheckboxstorybooks").is(":checked")){smrykitcheb="&#10003;"}else{smrykitcheb="&times;"}

   if($("#cssCheckboxboardgames").is(":checked")){smrytv="&#10003;"}else{smrytv="&times;"}
   if($("#cssCheckboxpuzzles").is(":checked")){smryplayer="&#10003;"}else{smryplayer="&times;"}

   // val="&#10003;"

   $('#summary_entertainment').closest('table').find('tbody').append(
    '<tr>\n'

    +'<td id=""><span id="smrytoilet" style="font-weight: bold; font-size: 20px">'+smrytoilet+'</span></td> \n'
    +'<td id=""><span id="smryparea" style="font-weight: bold; font-size: 20px">'+smryparea+'</span></td>\n'

    +'<td id="" style="background-color:"><span id="smrybedroom" style="font-weight: bold; font-size: 20px">'+smrybedroom+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrydroom" style="font-weight: bold; font-size: 20px">'+smrydroom+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrysala" style="font-weight: bold; font-size: 20px">'+smrysala+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrykitcheb" style="font-weight: bold; font-size: 20px">'+smrykitcheb+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrykitcheb" style="font-weight: bold; font-size: 20px">'+smrytv+'</span></td>\n'
    +'<td id="" style="background-color:"><span id="smrykitcheb" style="font-weight: bold; font-size: 20px">'+smryplayer+'</span></td>\n'

    );

}





function validatedate(value,fd) {


    var dateofbirth = $('#dateofbirth').val();
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
    if(value == "fordisplay") {
        if (age >= 1 ) {
            age == 1 ? $("#age").val(age + " year old") : $("#age").val(age + " year's old")
        }
        else if ( age < 1 ){
            days <= 1 ? $("#age").val(days + " day old") : $("#age").val(days + " day's old")
        }

    }
    else if (value == "editdisplay") {

    }
    else
        if ( value == "forajax" ) {

            if (age==0 || age<0) {


                if ( days <= 28 && days >= 0 ) {

                    var status = "newborn";
                    fd.append("status",status);
                    Add(fd);
                }
                else if ( days >= 29 ) {

                    var status = "infant";
                    fd.append("status",status);
                    Add(fd);
                }
            }
            else if (age >= 1 && age <= 10) {
                console.log('this is for children');
                console.log('child');
                var status = "child";
                fd.append("status",status);
                Add(fd);
            }
            else if (age >= 11 && age <= 19) {
                console.log('adolescent');
                console.log('child');
                var status = "adolescent";
                fd.append("status",status);
                Add(fd);
            }
            else if ( age >= 60 ) {
                console.log('elderly');
                console.log('elderly');
                var status = "elderly";
                fd.append("status",status);
                Add(fd);
            }
            else {
                Add(fd);
            }

        }



    }

     function DaysBetween(DateofBirth, CurrentYear) {

            const oneDay = 1000 * 60 * 60 * 24;
            const start = Date.UTC(CurrentYear.getFullYear(), CurrentYear.getMonth(), CurrentYear.getDate());
            const end = Date.UTC(DateofBirth.getFullYear(), DateofBirth.getMonth(), DateofBirth.getDate());
            return Math.round(Math.abs((start - end ) / oneDay));
        }
    async function Add(fd) {



     try
     {
        result = await $.ajax({
            url:"{{route('BasicInfoAdd')}}",
            type:'post',

            data:fd,
            success:function(data)
            {
             console.log(data);
                if (data == "good")
                {
                    swal("Data have been successfully added!", {
                        icon: "success",
                    });
                        //window.location.reload();
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

<script type="text/javascript">

 function displayAge(birth, target) {
              let months = target.diff(birth, 'months', true)
              let birthSpan = {year: Math.floor(months/12), month: Math.floor(months)%12, day: Math.round((months%1)*target.daysInMonth(),0)}
              // you can adjust below logic as your requirements by yourself
              if (birthSpan.year < 1 && birthSpan.month < 1) {
                return birthSpan.day + ' day' + (birthSpan.day > 1 ? 's' : '')
              } else if (birthSpan.year < 1) {
                return birthSpan.month + ' month' + (birthSpan.month > 1 ? 's ' : ' ') + birthSpan.day + ' day' + (birthSpan.day > 1 ? 's' : '')
              } else if (birthSpan.year < 2) {
                return birthSpan.year + ' year' + (birthSpan.year > 1 ? 's ' : ' ') + birthSpan.month + ' month' + (birthSpan.month > 1 ? 's ' : '')
              } else {
                return birthSpan.year + ' year' + (birthSpan.year > 1 ? 's' : '')
              }

            }
     // 15 POB 16 unitNO 17 PHASE 18 HOUSENO 19 STREET 20 SUBDIVI 21 BUILDING

</script>

<script type="text/javascript">

function titleCase(str) {
   var splitStr = str.toLowerCase().split(' ');
   for (var i = 0; i < splitStr.length; i++) {
       // You do not need to check if i is larger than splitStr length, as your for does that for you
       // Assign it back to the array
       splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
   }
   // Directly return the joined string
   return splitStr.join(' ');
}
    $(document).ready(function(){
        $('#EditBTN').on('click', function(){


            var resident_id = $('#EditCatID').val();
            var fname = $('#editfname').val().toUpperCase();
            var mname = $('#editmname').val().toUpperCase();
            var lname = $('#editlname').val().toUpperCase();
            var qname = $('#editqname').val().toUpperCase();
            var gender = $("input:radio[name='edit_gender']:checked").val();
            var bdate = $('#editbdate').val();
            var cstatus = $('#editcstatus').children(":selected").attr("value");
            var occupation = titleCase($('#editoccu').val());
            gender == 'Male' ? gender = 'Male' : gender = 'Female';

            //var wstatus = $('#editwstatus').children(":selected").attr("value");
            //var educationatt = $('#editeducationatt').children(":selected").attr("value");

            //var startwork = $('#editsworking').val();
            //var is_ofw = $("input:radio[name=edit_isofw]:checked").val();
            //var is_inde = $("input:radio[name=edit_isinde]:checked").val();
            var citiz = titleCase($('#editcitiz').val());
            var head = titleCase($('#edithead').val());
            //var arrt = $('#editarrtime').val();
            //var editc = $('#editcontact').val();
            //var arrstat = $('#editareason').children(":selected").attr("id");

            var place_birth =  $('#editpbirth').val();

            var house_no =  $('#edit_houseno').val();
            var streetno =  $('#edit_street_no').val();
            var street =  $('#edit_street').val();
            var unit_no = $('#edit_hunitno').val();
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
            //fd.append('editwstatus',wstatus);
            //fd.append('editstartw',startwork);
            fd.append('editcitiz',citiz);
            fd.append('editrhead',head);
            //fd.append('editarrtime',arrt);
            //fd.append('editastatus',arrstat);
            //fd.append('edit_isinde',is_inde);
            //fd.append('editcontact',editc);

            fd.append('editpbirth',place_birth);
            fd.append('edit_hunitno',unit_no);
            fd.append('edit_houseno',house_no);
            fd.append('edit_street_no',streetno);
            fd.append('edit_street',street);
            fd.append('edit_hphase',phase);
            fd.append('edit_hsubdivision',subdivi);
            fd.append('edit_hbuilding',building);
            //fd.append('editeducationatt',educationatt);

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

$(document).ready(function(){

})
    var output = '', designer = '', streetno = '';
    var active_flag;
    var middlename = '', qualifier = '';

   $('#editcstatus').change(function (){
        checkeditage( $('#editbdate').val(), '#editcstatus' );
   });

   $('#editbdate').change(function (){
        checkeditage( $('#editbdate').val(), '#editcstatus' );
   });

   $("#resident_table tbody").on('click', 'tr', function () {
        var parse_numer, housenum;
        var res_id = table.cell( this, 0).data();
        var lastname = table.cell( this, 1).data();
        var firstname = table.cell( this, 2).data();
        var middlename = table.cell( this, 3).data() == null ? '' : table.cell( this, 3).data()
        var q_name = table.cell( this, 4).data();
        var bdate = table.cell( this, 5).data();
        var place_of_birth = table.cell( this, 6).data();
        var relationtohead = table.cell( this, 7).data() == null ? '' : table.cell( this, 7).data();
        var house_no = table.cell( this, 9).data();
        var address_no = table.cell( this, 10).data();

        var address_street = table.cell( this, 11).data();
        var cstatus = table.cell( this, 16).data();
        var occupation = table.cell( this, 17).data();
        var citizenship = table.cell( this, 18).data();

        var unitno = table.cell( this, 19).data();
        var subdivision = table.cell( this, 20).data();
        var building = table.cell( this, 21).data();

        var gender = table.cell( this, 14).data();

        gender == 'Male' ? $("#radiogenderm").prop("checked", true) : $("#radiogenderf").prop("checked", true)
        // var unit_no = table.cell( this, 15).data();
        // var phase = table.cell( this, 16).data();

        // var street = table.cell( this, 18).data();
        // var subdivi = table.cell( this, 19).data();
        // var building = table.cell( this, 20).data();
        // var started_working = table.cell( this, 21).data();
        // var date_arrival = table.cell( this, 22).data();
        var fullname = lastname + ", " + firstname + " " + middlename;


        var cdate = new Date(Date.now());
        var rgdate = new Date(bdate);
        var ryear = parseInt(rgdate.getFullYear());
        var rmont = parseInt(String(rgdate.getMonth() + 1).padStart(2, '0')) ;
        var rday = parseInt(String(rgdate.getDate()).padStart(2, '0') ) ;
        var cyear = parseInt(cdate.getFullYear());
        var cmon = parseInt(cdate.getMonth() + 1);
        var cday = parseInt(String(cdate.getDate()).padStart(2, '0'));

        var age = cyear - ryear;

        if (rday >= 32){ rday = 1; }
        if (rmont >= 13){ rmont = 1; }
        var current_year = new Date(cyear,cmon,cday);
        var dob_year = new Date(ryear,rmont,rday);
        var days = DaysBetween(dob_year,current_year);
        var parse_number = 0;

        //if (contactnumber != null) { parse_number = parseInt(contactnumber); }
        //if (house_no != null) { housenum = parseInt(house_no); }
        if(age >= 1) { $('#edit_age').text(age); } else if (age < 1) {get_bday=displayAge(bdate,moment());$('#edit_age').text(get_bday);}
        $('#edit_db_name').text(fullname);
        $('#EditCatID').val(res_id);
        $('#editlname').val(lastname);
        $('#editfname').val(firstname);
        $('#editmname').val(middlename);
        $('#editqname').val(q_name);
        $('#editoccu').val(occupation);
        $('#editcitiz').val(citizenship);
        $('#edithead').val(relationtohead);
        $('#edit_houseno').val(house_no);
        $('#edit_street_no').val(address_no);
        $('#edit_street').val(address_street);
        $('#editbdate').val(bdate);
        $('#editpbirth').val(place_of_birth);
        $('#editcstatus').val(cstatus);

        $('#edit_hunitno').val(unitno);
        $('#edit_hsubdivision').val(subdivision);
        $('#edit_hbuilding').val(building);
        $('#edit_gender').val(gender);
        // $('#edit_hunitno').val(unit_no);

        // $('#edit_houseno').val(housenum);
        // $('#edit_street').val(street);
        // $('#edit_hphase').val(phase);
        // $('#edit_hsubdivision').val(subdivi);

        // $('#edit_hbuilding').val(building);
        // $('#editsworking').val(started_working);
        // $('#editarrtime').val(date_arrival);
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

                        success : function(data) {
                           if (data == "true")
                           {
                            location.reload()
                        }
                    },
                    error : function(error){
                        console.log("error: " + error);

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
}
</script>
<script type="text/javascript">

  $('#mfn').change(function() {

    if($(this).val()=="Mother" || $(this).val()=="Father") {
        $('#childrendiv').show();

    } else {
        $('#childrendiv').hide()
    }



});



  count_1 = 0;
  count_2 = 3;
  count_3 = 1;
  $("#addVar").on("click",function(){

    get_count_1 = count_1++;
    get_count_2 = count_2++;
    get_count_3 = count_3++;
    $(this).closest('table').find('tbody').append(
        '<tr>\n'

        +'<td><label style="text-align: left">&nbspFirst Name</label><input type="text" id=multifname name=multifname class="form-control multifname" placeholder="John">&nbsp\n'
        +'<label style="text-align: left">&nbspMiddle Name</label><input id=multimname name=multimname class="form-control multimname" placeholder="Doe">&nbsp\n'
        +'<label style="text-align: left">&nbspLast Name</label><input id=multilname name=multilname class="form-control multilname" placeholder="Smith" value="'+$('#lastname').val()+'">&nbsp\n'
        +'<label style="text-align: left">Qualifier</label><input type="text" id="multiqualifier" name="multiqualifier" class="form-control multiqualifier" placeholder="Jr." />&nbsp\n'
        +'<label style="text-align: left">&nbspRelation to Household head</label><select id=multireltohead name=multireltohead class="form-control multireltohead">&nbsp\n'
                +'<option value="Spouse">Spouse </option>\n'
                +'<option value="Son">Son </option>\n'
                +'<option value="Daughter">Daughter </option>\n'
                +'<option value="Stepson">Stepson</option>\n'
                +'<option value="Stepdaughter">Stepdaughter </option>\n'
                +'<option value="Son-in-law">Son-in-law</option>\n'
                +'<option value="Daughter-in-law">Daughter-in-law</option>\n'
                +'<option value="Grandson">Grandson </option>\n'
                +'<option value="Granddaughter">Granddaughter </option>\n'
                +'<option value="Father">Father </option>\n'
                +'<option value="Mother">Mother </option>\n'
                +'<option value="Brother">Brother </option>\n'
                +'<option value="Sister">Sister </option>\n'
                +'<option value="Uncle">Uncle </option>\n'
                +'<option value="Aunt">Aunt </option>\n'
                +'<option value="Nephew">Nephew </option>\n'
                +'<option value="Niece">Niece </option>\n'
                +'<option value="Other relative">Other relative</option>\n'
                +'<option value="Nonrelative">Nonrelative </option>\n'
                +'<option value="Boarder">Boarder </option>\n'
                +'<option value="Househelper">Househelper </option>\n'
        +'</select>&nbsp\n'
        +'<label style="text-align: left">&nbspSex</label><div class="radio radio-css radio-inline"><input type="radio" name="multisex" class="multisex" id="MultiinlineCssRadioMale" value="Male" checked /> <label for="MultiinlineCssRadioMale">Male</label></div><div class="radio radio-css radio-inline"><input type="radio" class="multisex" name="multisex" id="MultiinlineCssRadioFemale" value="Female" /><label for="MultiinlineCssRadioFemale">Female</label></div><br><br>\n'
        +'<label style="text-align: left">&nbspDate of Birth</label><input type="date" target="'+get_count_3+'" id="multidoba" name=multidoba class="form-control multidoba">&nbsp\n'
        +'<label style="text-align: left">Age</label><input type="text" id="multiage'+get_count_3+'" name="multiage" class="form-control multiage" style="background-color: white;" readonly  />&nbsp\n'
        +'<label style="text-align: left">&nbspPlace of Birth</label><input id=multipoba name=multipoba class="form-control multipoba"  placeholder="Place of Birth">&nbsp\n'
        +'<label style="text-align: left">&nbspCitizenship</label><input id=multictizi name=multictizi class="form-control multictizi" placeholder="Citizenship">&nbsp\n'
        +'<label style="text-align: left">&nbspCivil Status</label><select id=multicvstat name=multicvstat class="form-control multicvstat">\n'
            +'<option value="Single" selected>Single</option>\n'
            +'<option value="Married">Married</option>\n'
            +'<option value="Separated">Separated</option>\n'
            +'<option value="Widow">Widow</option>\n'
            +'<option value="Divorced">Divorced</option>\n'
            +'<option value="Annulled">Annulled</option>\n'
            +'<option value="Unknown">Unknown</option>\n'
        +'</select>&nbsp\n'
        +'<label style="text-align: left">&nbspReligion</label><input id=multireligion name=multireligion class="form-control multireligion" placeholder="Catholic">&nbsp\n'
        +'<label style="text-align: left">&nbspEducational Attainment</label><select id=multieducatt name=multieducatt class="form-control multieducatt"  >\n'
            +'<option value="No education" selected>No education</option>'
            +'<option value="Pre-school" >Pre-school</option>'
            +'<option value="Elementary level">Elementary level</option>'
            +'<option value="Elementary graduate">Elementary graduate</option>'
            +'<option value="High school level">High school level</option>'
            +'<option value="High school Graduate">High school graduate</option>'
            +'<option value="Junior HS level">Junior HS level</option>'
            +'<option value="Junior HS graduate">Junior HS graduate</option>'
            +'<option value="Senior HS level">Senior HS level</option>'
            +'<option value="Senior HS graduate">Senior HS graduate</option>'
            +'<option value="Technical/Vocation">Technical/Vocation</option>'
            +'<option value="College level">College level</option>'
            +'<option value="College graduate">College graduate</option>'
            +'<option value="Post-graduate">Post-graduate</option>'
        +'</select>&nbsp\n'
        +'<label style="text-align: left">Enrollment Status</label><select class="form-control multienstat" data-style="btn-lime" id="multienstat" name="multienstat">'
            +'<option value="Not Enrolled" selected>Not Enrolled</option>'
            +'<option value="Enrolled, public">Enrolled, public</option>'
            +'<option value="Enrolled, private">Enrolled, private</option>'
            +'<option value="Not Applicable">Not Applicable</option>'
        +'</select>&nbsp\n'
        +'<div id="showSchoolDetailsMulti" style="display: none"><label style="text-align: left">Type of School</label>'
            +'<select class="form-control multi_school_type" data-style="btn-lime" id="multi_school_type" name="multi_school_type">'
                +'<option value="Pre-school" selected>Pre-school</option>'
                +'<option value="Elementary">Elementary</option>'
                +'<option value="Junior HS">Junior HS</option>'
                +'<option value="Senior HS">Senior HS</option>'
                +'<option value="Vocational/Technical">Vocational/Technical</option>'
                +'<option value="College/University">College/University</option>'
                +'<option value="Graduate School">Graduate School</option>'
            +'</select>&nbsp\n'
            +'<label style="text-align: left">Place of school</label><input type="text" id="multipschool" name="multipschool" class="form-control multipschool" />&nbsp\n'    
        +'</div>'
        +'<label style="text-align: left">Date Arrived in Barangay</label><input type="month" id=multidoar name=multidoar class="form-control multidoar"  placeholder="Date of Arrival">&nbsp\n'
        
        +'</td>&nbsp\n'
        //END-FIRST-COLUMN-HOUSEHOLD-MEMBERS


        //START-SECOND-COLUMN-HOUSEHOLD-MEMBERS
        +'<td style="width: 30%">'

        +'<div style="display: none" id="multioccup">'
            +'<label style="text-align: left">&nbspOccupation</label><input id=multioccupation name=multioccupation class="form-control multioccupation" placeholder="e.g programmer" >&nbsp\n'
        +'</div>'
            
        +'<div style="display: none" class="multi_showwork">'
            +'<label style="text-align: left">Monthly Income</label>'
            +'<div class="input-group">'
                +'<div class="input-group-prepend">'
                    +'<span class="input-group-text">₱</span>'
                +'</div>'
                +'<input type="number" id="multiMonthlyIncome" name="multiMonthlyIncome" class="form-control multiMonthlyIncome" placeholder="10000.00">'
            +'</div>&nbsp\n'
            +'<label style="text-align: left">Income Status</label>'
            +'<select class="form-control multiIncomeStatus" data-style="btn-lime" name="multiIncomeStatus" id="multiIncomeStatus">'
                +'<option value="Not Applicable" selected>Not Applicable</option>'
                +'<option value="Rich">Rich (At least ₱190,400)</option>'
                +'<option value="High">High (₱114,240 to ₱190,399)</option>'
                +'<option value="Upper middle">Uppper middle (₱66,640 to ₱114,239)</option>'
                +'<option value="Middle middle">Middle middle (₱38,080 to ₱66,639)</option>'
                +'<option value="Lower middle">Lower middle (₱19,040 to ₱38,079)</option>'
                +'<option value="Low">Low (₱9,520 to ₱19,039)</option>'
                +'<option value="Poor">Poor (Less than ₱9,520)</option>'
            +'</select>&nbsp\n'
            +'<label style="text-align: left">Employment Status</label>'
            +'<select class="form-control multiEmploymentStatus" data-style="btn-lime" name="multiEmploymentStatus" id="multiEmploymentStatus">'
                +'<option value="Not Applicable" selected>Not Applicable</option>'
                +'<option value="Employed">Employed</option>'
                +'<option value="Self-Employed">Self-Employed</option>'
                +'<option value="Unemployed">Unemployed</option>'
                +'<option value="Retired">Retired</option>'
            +'</select>&nbsp\n'
            +'<label style="text-align: left">Place of Work</label><input type="text" id=multiWorkplace name=multiWorkplace class="form-control multiWorkplace">&nbsp\n'
            // +'<label style="text-align: left">nWork Status</label>'
            //     +'<select class="form-control multiws" data-style="btn-lime" name="multiws" id="multiws">'
            //     +'<option value="NotApplicable" selected>Not Applicable</option>'
            //     +'<option value="Employed">Employed</option>'
            //     +'<option value="Unemployed">Unemployed</option>'
            //     +'<option value="Retired">Retired</option>'
            // +'</select>&nbsp\n'
            // +'<label style="text-align: left">Date Started Working </label><input type="date" id="multidsw" name="multidsw" class="form-control multidsw" />'
        +'</div>'

        // +'<label style="text-align: left">&nbspPlace of delivery</label><input type="text" id=multipdelivery name=multipdelivery class="form-control multipdelivery" placeholder="e.g hospital, home">&nbsp\n'
        +'<label style="text-align: left">Place of delivery<span class="text-danger">*</span></label>'
        +'<select class="form-control multipdelivery" data-style="btn-lime" name="multipdelivery" id="multipdelivery">'
            +'<option value="Public hospital" selected>Public hospital</option>'
            +'<option value="Private hospital">Private hospital</option>'
            +'<option value="Lying-in clinic">Lying-in clinic</option>'
            +'<option value="Home">Home</option>'
            +'<option value="Other">Other</option>'
        +'</select>&nbsp\n'
        +'<div style="display: none" id="showMultiOtherDeliveryPlace">'
            +'<label style="text-align: left">Other</label>'
            +'<input type="text" id="multipdeliveryOther" name="multipdeliveryOther" class="form-control multipdeliveryOther"  placeholder="Place of delivery" />'
        +'</div>&nbsp\n'
        +'<label style="text-align: left">Birth Attendant<span class="text-danger">*</span></label>'
        +'<select class="form-control multibattendant" data-style="btn-lime" name="multibattendant" id="multibattendant">'
            +'<option value="Doctor" selected>Doctor</option>'
            +'<option value="Nurse">Nurse</option>'
            +'<option value="Midwife">Midwife</option>'
            +'<option value="Hilot">Hilot</option>'
            +'<option value="Other">Other</option>'
        +'</select>&nbsp\n'
        +'<div style="display: none" id="showMultiAttendant">'
            +'<label style="text-align: left">Other</label>'
            +'<input type="text" id="multibattendantOther" name="multibattendantOther" class="form-control multibattendantOther"  placeholder="Place of delivery" />'
        +'</div>&nbsp\n'
        // +'<label style="text-align: left">Birth Attendant</label><textarea id="multibattendant" name="multibattendant" placeholder="e.g , doctor, nurse, midwife, hilot" class="form-control"  ></textarea>\n'
         +'<label style="text-align: left">Immunization/Last received vaccine</label><input type="text"id="multibimmunization" name="multibimmunization" class="form-control multibimmunization" placeholder="Last received vaccine" />&nbsp\n'
        +'<label style="text-align: left">Health Facility Visited for the last 6 months</label>'
        // <textarea id="multifvisited" name="multifvisited" class="form-control" placeholder="e.g government hospital, rhu/health center, brgy health station, private hospital, private clinic" ></textarea>
        +'<select class="form-control multifvisited" data-style="btn-lime" id="multifvisited" name="multifvisited">'
            +'<option value="None" selected>None</option>'
            +'<option value="Government hospital" >Government hospital</option>'
            +'<option value="Health Center">Health Center</option>'
            +'<option value="Brgy. Health Station">Brgy. Health Station</option>'
            +'<option value="Private Hospital">Private Hospital</option>'
            +'<option value="Private Clinic">Private Clinic</option>'
        +'</select>&nbsp\n'
        +'<div style="display: none" id="showMultiReasonForVisit">'
        +'<label style="text-align: left">Reason for Visit</label>'
        // +'<textarea id="multirvisit" name="multirvisit" class="form-control" placeholder="e.g injured, prenatal/posnatal, gave birth,dental,medicinecheckup,medical requirment, NHTS/CCT/4P\'s private clinic"></textarea>\n'
        +'<select class="form-control multirvisit" data-style="btn-lime" id="multirvisit" name="multirvisit">'
            +'<option value="Not Applicable" selected>Not Applicable</option>'
            +'<option value="Injured" >Injured</option>'
            +'<option value="Prenatal/Postnatal">Prenatal/Postnatal</option>'
            +'<option value="Gave birth">Gave birth</option>'
            +'<option value="Dental">Dental</option>'
            +'<option value="Medicine checkup">Medicine checkup</option>'
            +'<option value="Medical requirement">Medical requirement</option>'
            +'<option value="NHTS/CCT/4P\'s private clinic">NHTS/CCT/4P\'s private clinic</option>'
        +'</select>&nbsp\n'
        +'</div>'
        +'<label style="text-align: left">Disability</label>'
        // <input type="text" id="multidisability" name="multidisability" placeholder="" class="form-control"/>
        +'<select class="form-control multidisability" data-style="btn-lime" id="multidisability" name="multidisability">'
            +'<option value="None" selected>None</option>'
            +'<option value="Sensory Disability" >Sensory Disability</option>'
            +'<option value="Physical Disability">Physical Disability</option>'
            +'<option value="Mental Disability">Mental Disability</option>'
        +'</select>&nbsp\n'
        +'<div style="display: none" id="showMultiSoloParent">'
            +'<label style="text-align: left">Solo Parent</label>'
            +'<select class="form-control multiSoloParent" data-style="btn-lime" id="multiSoloParent" name="multiSoloParent">'
                +'<option value="Not applicable" selected>Not applicable</option>'
                +'<option value="Registered solo parent" >Registered solo parent</option>'
                +'<option value="Unregistered solo parent">Unregistered solo parent</option>'
                +'<option value="Non-solo parent">Non-solo parent</option>'
            +'</select>&nbsp\n'
        +'</div>'
        +'<div style="display: none" id="showMultiSeniorCitizen">'
            +'<label style="text-align: left">Is Registered Senior Citizen? <span class="text-danger">&nbsp;</span></label><div class="radio radio-css radio-inline"><input type="radio" name="multiIsRegisteredSeniorCitizen" class="multiIsRegisteredSeniorCitizen" id="multiUnregisteredSeniorCitizen" value="0" checked /><label for="multiUnregisteredSeniorCitizen">No</label></div><div class="radio radio-css radio-inline"><input type="radio" class="multiIsRegisteredSeniorCitizen" name="multiIsRegisteredSeniorCitizen" id="multiRegisteredSeniorCitizen" value="1" /><label for="multiRegisteredSeniorCitizen">Yes</label></div>\n'
        +'</div>'
        +'<div  id="showMultiRegisteredVoter">'
            +'<label style="text-align: left">Is Registered Voter?</label><div class="radio radio-css radio-inline"><input type="radio" name="multiirv" class="multiirv" id="MultiinlineRegisteredVoterNo'+get_count_1+'" value="0" checked /><label for="MultiinlineRegisteredVoterNo'+get_count_1+'">No</label></div><div class="radio radio-css radio-inline"><input type="radio" class="multiirv" name="multiirv" id="MultiinlineRegisteredVoterYes'+get_count_2+'" value="1" /><label for="MultiinlineRegisteredVoterYes'+get_count_2+'">Yes</label></div><br><br>\n'
            +'<div style="display: none" id="showMultiVotingPrecinct">'
                +'<label style="text-align: left">Voting Precinct</label><input type="text" id="multiVotingPrecinct" name="multiVotingPrecinct" class="form-control multiVotingPrecinct" placeholder="Voting Precinct" />&nbsp\n\n'
            +'</div>'
        +'</div>'
        +'<label style="text-align: left">Previous Residence for the last 6 months</label><input type="text" id="multiPreviousResidence" name="multiPreviousResidence" class="form-control multiPreviousResidence" placeholder="Previous Residence" />&nbsp\n'
        
        // +'</td>&nbsp\n'
        // +'</div>\n'
        +'</td>&nbsp\n'
        //END-SECOND-COLUMN-HOUSEHOLD-MEMBERS

        //START-THIRD-COLUMN-HOUSEHOLD-MEMBERS
        +'<td><label style="text-align: left">&nbspContact Number</label><input id=multicontactc name=multicontactc class="form-control multicontactc" placeholder="(+639)">\n&nbsp'

        +'<label style="text-align: left">&nbspType of Resident</label><select id=multityper name=multityper class="form-control multityper" >\n'

        +'<option value="Native Residents" selected>Native Residents</option>\n'

        +'<option value="Migrants">Migrants</option>\n'
        +'<option value="Transients">Transients</option>\n'

        +'</select>&nbsp\n'
        +'<div style="display: none" id="multishowmigrants">\n'
            +'<select class="form-control multim" data-style="btn-lime" name="multim" id="multim">\n'
                +'<option value="Country">From Other Country</option>\n'
                +'<option value="Barangay">From Other Barangay</option>\n'
                +'<option value="Province">From Other Province</option>\n'
            + '</select>&nbsp\n'
        +'<input id=multifromwhat name=multifromwhat class="form-control multifromwhat" placeholder="">&nbsp\n'
        // +'<label style="text-align: left">Valid Community Tax Certificate</label><input type="text" id="multimdocument" name="multimdocument" placeholder="" class="form-control"/>&nbsp\n'
        // +'<label class="col-md-3 col-form-label text-md-right">When ctc is issued</label>\n'
        // +'<input type="date" id="multimwhenissued" name="multimwhenissued" placeholder="" class="form-control"/>\n'
        // +'<label style="text-align: left">Place of CTC Issuance </label>\n'
        // +'<input type="text" id="multimwhereissued" name="multimwhereissued" placeholder="" class="form-control"/>&nbsp\n'
        +'<label style="text-align: left">Reason for Coming</label>'
            +'<select class="form-control multmirc" data-style="btn-lime" id="multimrc" name="multimrc">'
                +'<option value="Lack of employment" selectoed>Lack of employment</option>'
                +'<option value="Perception of better income in other place">Perception of better income</option>'
                +'<option value="Schooling">Schooling</option>'
                +'<option value="Presence of relatives and friends">Presence of relatives and friends</option>'
                +'<option value="Employment/Job relocation">Employment/Job relocation</option>'
                +'<option value="Disaster-related relocation">Disaster-related relocation</option>'
                +'<option value="Retirement">Retirement</option>'
                +'<option value="To live with parents">To live with parents</option>'
                +'<option value="To live with children">To live with children</option>'
                +'<option value="Marriage">Marriage</option>'
                +'<option value="Annulment/Divorce/Separation">Annulment/Divorce/Separation</option>'
                +'<option value="Commuting-related reasons">Commuting-related reasons</option>'
                +'<option value="Health-related reasons">Health-related reasons</option>'
                +'<option value="Peace and security">Peace and security</option>'
                +'<option value="Other">Other</option>'
            +'</select>&nbsp\n'
            +'<div style="display: none" id="showMultimOtherReason">'
                +'<label style="text-align: left">Other</label>'
                +'<input type="text" id="multimrcOther" name="multimrcOther" class="form-control multimrcOther"  placeholder="Reason for Coming" />'
            +'</div>&nbsp\n'

        +'</div>\n'


        +'<div style="display: none" class="div_multi_transient">\n'
            +'<label style="text-align: left">Reason for Coming</label>'
            // +'<textarea type="text" id="multirc" name="multirc" placeholder="" class="form-control multirc"></textarea>\n'
            +'<select class="form-control multirc" data-style="btn-lime" id="multirc" name="multirc">'
                +'<option value="Lack of employment" selectoed>Lack of employment</option>'
                +'<option value="Perception of better income in other place">Perception of better income</option>'
                +'<option value="Schooling">Schooling</option>'
                +'<option value="Presence of relatives and friends">Presence of relatives and friends</option>'
                +'<option value="Employment/Job relocation">Employment/Job relocation</option>'
                +'<option value="Disaster-related relocation">Disaster-related relocation</option>'
                +'<option value="Retirement">Retirement</option>'
                +'<option value="To live with parents">To live with parents</option>'
                +'<option value="To live with children">To live with children</option>'
                +'<option value="Marriage">Marriage</option>'
                +'<option value="Annulment/Divorce/Separation">Annulment/Divorce/Separation</option>'
                +'<option value="Commuting-related reasons">Commuting-related reasons</option>'
                +'<option value="Health-related reasons">Health-related reasons</option>'
                +'<option value="Peace and security">Peace and security</option>'
                +'<option value="Other">Other</option>'
            +'</select>&nbsp\n'
            +'<div style="display: none" id="showMultiOtherReason">'
                +'<label style="text-align: left">Other</label>'
                +'<input type="text" id="multircOther" name="multircOther" class="form-control multircOther"  placeholder="Reason for Coming" />'
            +'</div>&nbsp\n'


            +'<label style="text-align: left">Date of Arrival</label>  <input type="date" id="multipstartdate" name="multipstartdate" placeholder="" class="form-control multipstartdate"/>&nbsp\n'
            +'<label style="text-align: left"">Date Departed in Barangay</label>  <input type="date" id="multipenddate" name="multipenddate" placeholder="" class="form-control multipenddate"/>&nbsp\n'

            +'<label style="text-align: left">Valid Community Tax Certificate</label><input type="text" id="multitdocument" name="multitdocument" placeholder="" class="form-control"/>&nbsp\n'
            // +'<label class="col-md-3 col-form-label text-md-right">When ctc is issued</label>\n'
            // +'<input type="date" id="multiwhentissued" name="multiwhentissued" placeholder="" class="form-control"/>\n'
            +'<label style="text-align: left">Place of CTC Issuance </label>'
            +'<input type="text" id="multiwheretissued" name="multiwheretissued" placeholder="" class="form-control"/>&nbsp\n'
        +'</div>\n'

        +'<label style="text-align: left">&nbspResident Status</label>'
            +'<select id=multires name=multires class="form-control multires" >\n'
                +'<option value="Not A Parent" selected>Not A Parent</option>\n'
                +'<option value="Father">Father</option>\n'
                +'<option value="Mother">Mother</option>\n'
            +'</select>&nbsp\n'

        +'<label style="text-align: left">Skills Develoment Training</label>'
        +'<textarea type="text" id="multisdtraining" name="multisdtraining" placeholder="" class="form-control multisdtraining"></textarea>'
        
        
        +'<td><a class="btn btn-danger" onclick="if($(\'#prodvartable tbody tr\').length>1)$(this).closest(\'tr\').remove()"><i class="fa fa-minus text-white"></i></a></td>\n'
        +'</tr>\n'

        );
});



</script>
<script type="text/javascript">

   var multichildform = $("#multichild");

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
})

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
          fname: {
              required: true,
              nowhitespace: true,
              lettersonly: true
          },
          mname: {

              nowhitespace: true,
              lettersonly: true
          },
          lname: {
              required: true,
              nowhitespace: true,
              lettersonly: true
          },

          doba: {
              required: true

          },
          poba: {
              required: true,
              nowhitespace: true,
              lettersonly: true
          },
          ctizi: {
            required: true,
            nowhitespace: true,
            lettersonly: true
        }
    },
    messages:{
      fname: {
          required: 'This field is required',
          nowhitespace: 'No white space allowed',
          lettersonly: 'letters only'
      },
      mname: {
          nowhitespace: 'No white space allowed',
          lettersonly: 'letters only'
      },
      lname: {
          required: 'This field is required',
          nowhitespace: 'No white space allowed',
          lettersonly: 'letters only'
      },

      doba: {
          required: 'This field is required'
      },
      poba: {
          required: 'This field is required',
          nowhitespace: 'No white space allowed',
          lettersonly: 'letters only'
      },
      ctizi: {
          required: 'This field is required',
          nowhitespace: 'No white space allowed',
          lettersonly: 'letters only'
      },

  },


});
  }

$("#register-btn").click(function(e){
    e.preventDefault();
    // alert('asd')
    // start main household
    var mdateofbirth = $('#dateofbirth').val();
    var mcdate = new Date(Date.now());
    var mrgdate = new Date(mdateofbirth);
    var mryear = parseInt(mrgdate.getFullYear());
    var mrmont = parseInt(String(mrgdate.getMonth() + 1).padStart(2, '0')) ;
    var mrday = parseInt(String(mrgdate.getDate()).padStart(2, '0') ) ;
    var mcyear = parseInt(mcdate.getFullYear());
    var mcmon = parseInt(mcdate.getMonth() + 1);
    var mcday = parseInt(String(mcdate.getDate()).padStart(2, '0'));
    var mstatus = "";
    var mage = mcyear - mryear;
    var mar_status =  $('#mfn').children(":selected").attr("value");


    if (mrday >= 32){
        mrday = 1;
    }
    if (mrmont >= 13){
        mrmont = 1;
    }
    var current_year = new Date(mcyear,mcmon,mcday);
    var dob_year = new Date(mryear,mrmont,mrday);
    var days = DaysBetween(dob_year,current_year);




            if (mage==0 || mage<0) {
                if ( days <= 28 && days >= 0 ) {
                    status = "newborn";
                }
                else if ( days >= 29 ) {

                    status = "infant";
                }
            }
            else if (mage >= 1 && mage <= 10) {
                status = "child";
            }
            else if (mage >= 11 && mage <= 19) {
                status = "adolescent";
            }
            else if ( mage >= 60 ) {

                status = "elderly";

            }
            else
            {
                status = "";
            }

            //alert(status);

              //resident
              var typeofdocument, wherectcissued;
              var fname = $('#firstname').val();
              var mname = $('#middlename').val();
              var lname = $('#lastname').val();
              var qualifier = $('#qualifier').val();
              var selectedsex = $("input:radio[name=sex_gender]:checked").val();
              var dateofbirth = $('#dateofbirth').val();
              var civilstatus = $('#civilstatus').val();
              var placeofbirth = $('#placeofbirth').val();
              // var is_ofw = $("input:radio[name=is_ofw]:checked").val();

              var citizenship = $('#Citizenship').val();
              var occupation = $('#Occupation').val();
              var monthlyIncome = $('#monthlyIncome').val();
              var incomeStatus = $("#incomeStatus").children(":selected").attr("value");
              var employmentStatus = $("#employmentStatus").children(":selected").attr("value");
              var workplace = $('#placeofwork').val();
              // var workstatus = $("#workstatus").children(":selected").attr("value");
              var pdelivery = $('#pdelivery').children(":selected").attr("value");
              if (pdelivery == "Other"){
                 pdelivery = $('#pdeliveryOther').val();
              }

              var battendant = $('#battendant').children(":selected").attr("value");
              if (battendant == "Other"){
                 battendant = $('#battendantOther').val();
              }

              var bimmunization = $('#bimmunization').val();
              var fvisited = $('#fvisited').children(":selected").attr("value");
              var rvisit = $('#rvisit').children(":selected").attr("value");
              var disability = $('#disability').children(":selected").attr("value");
              var soloParent = $('#soloParent').children(":selected").attr("value");
              var isRegisteredSeniorCitizen = $("input:radio[name=isRegisteredSeniorCitizen]:checked").val();
              var is_registered_voter = $("input:radio[name=is_registered_voter]:checked").val();
              var votingPrecinct = $('#votingPrecinct').val();
              var previousResidence = $('#previousResidence').val();

              var educationatt = $("#educationatt").children(":selected").attr("value");
              var enrollment_status = $("#school_type").children(":selected").attr("value");
              var school_type = $("#enrollment_status").children(":selected").attr("value");
              var dateofstartwork = $('#dateofstartwork').val();
              var relationtohead = $('#RelationToHead').val();
              var dateofarrive = $('#dateofarrival').val();
              // var is_indegenous = $("input:radio[name=radio_Indigenous]:checked").val();
              var contactnumber = $('#contactnumber').val();
              var homeownership = $('#homeownership').children(":selected").attr("value");
              var buildmaterial = $("input:radio[name=radio_home_materials]:checked").val();
              var numberofrooms = $('#numberofrooms').val();
              var streetno = $('#streetno').val();
              var barangayzone_id = $('#BarangayZone').children(":selected").attr("value");
              var personinhousehold = $("#personinhousehold").val();
              var arrivalreason = $('#ArrivalReason').children(":selected").attr("id");
              var fromwhat = $('#fromwhat').val();
              var r_coming = $('#r_coming').children(":selected").attr("value");
              if (r_coming == "Other"){
                 r_coming = $('#otherReason').val();
              }
              var p_startdate = $('#p_startdate').val();
              var p_enddate = $('#p_enddate').val();

              var houseno = $('#houseno').val();
              var hstreet = $('#hstreet').val();
              var hphase = $('#hphase').val();
              var hbuilding = $('#hbuilding').val();
              var hunitno = $('#hunitno').val();
              var hsubdivision = $('#hsubdivision').val();

              
              
              var pschool = $('#pschool').val();
              var religion = $('#religion').val();
              var ethnicity = $('#ethnicity');
              var lotownership = $('#lotownership').val();
              var sdtraining = $('#sdtraining').val();

              if(arrivalreason == 2) {
                typeofdocument = $('#mdocument').val();
                // wctcissued = $('#mwhenissued').val();
                wherectcissued = $('#mwhereissued').val();
              }
              else if(arrivalreason == 3) {
                typeofdocument = $('#mdocument').val();
                // wctcissued = $('#mwhenissued').val();
                wherectcissued = $('#mwhereissued').val();
              }
              else{
                typeofdocument = "";
                // wctcissued = "";
                wherectcissued = "";
              }


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



                    // start multiple textbox
                    var multi_fname = [];
                    var multi_mname = [];
                    var multi_lname = [];
                    var multi_qualifier = [];
                    var multi_poba = [];
                    var multi_doba = [];
                    var multi_doar = [];
                    var multi_ctizi = [];
                    var multi_cvstat = [];
                    var multi_religion = [];
                    var multi_sex = [];

                    var multi_educatt = [];
                    var multi_enstat = [];
                    var multi_pschool = [];
                    var multi_school_type = [];
                    // var multi_is_ofw = [];
                    var multi_occupation = [];
                    var multi_monthlyIncome = [];
                    var multi_incomeStatus = [];
                    var multi_employmentStatus = [];
                    var multi_workplace = [];
                    // var multi_work_status = [];
                    var multi_pdelivery = [];
                    var multi_birthAttendant = [];
                    var multi_immunization = [];
                    var multi_healthFacilityVisited = [];
                    var multi_reasonForVisit = [];
                    var multi_disability = [];
                    var multi_soloParent = [];
                    var multi_isRegisteredSeniorCitizen = [];
                    var multi_irv = [];
                    var multi_votingPrecinct = [];
                    var multi_previousResidence = [];
                    var multi_dsw = [];
                    var multi_reltohead = [];
                    var multi_contactc = [];
                    var multi_typer = [];
                    var multim=[];
                    var multirc = [];
                    
                    var multi_p_startdate = [];
                    var multi_p_enddate = [];

                    var multi_migrants = [];
                    var multi_fromwhat = [];
                    var multi_res = [];


                    // if (document.getElementById("childrendiv").style.display == "none") {
                    //      ifshow = "true";
                    // }

                    // swal("Please insert atleast one member!", {
                    //     icon: "error",
                    // });

                     $(".multifname").each(function(){
                        multi_fname.push($(this).val());
                    });

                    $(".multimname").each(function(){
                        multi_mname.push($(this).val());
                    });

                    $(".multilname").each(function(){
                        multi_lname.push($(this).val());
                    });

                    $(".multiqualifier").each(function(){
                        multi_qualifier.push($(this).val());
                    });

                    console.log(multi_lname)
                    $(".multipoba").each(function(){
                        multi_poba.push($(this).val());
                    });


                    $(".multidoar").each(function(){
                        multi_doar.push($(this).val());
                    });

                    $(".multicvstat option:selected").each(function(){
                        multi_cvstat.push($(this).val());
                    });

                    $(".multireligion").each(function(){
                        multi_religion.push($(this).val());
                    });

                    $(".multisex:checked").each(function(){
                        multi_sex.push($(this).val());
                    });

                    $(".multictizi").each(function(){
                        multi_ctizi.push($(this).val());
                    });

                    $(".multieducatt option:selected").each(function(){
                        multi_educatt.push($(this).val());
                    });

                    $(".multienstat option:selected").each(function(){
                        multi_enstat.push($(this).val());
                    });

                    $(".multi_school_type option:selected").each(function(){
                        multi_school_type.push($(this).val());
                    });

                    $(".multipschool option:selected").each(function(){
                        multi_pschool.push($(this).val());
                    });

                    $(".multioccupation").each(function(){
                        multi_occupation.push($(this).val());
                    });

                    $(".multiMonthlyIncome").each(function(){
                        multi_monthlyIncome.push($(this).val());
                    });

                    $(".multiIncomeStatus option:selected").each(function(){
                        multi_incomeStatus.push($(this).val());
                    });

                    $(".multiEmploymentStatus option:selected").each(function(){
                        multi_employmentStatus.push($(this).val());
                    });

                    $(".multiWorkplace").each(function(){
                        multi_workplace.push($(this).val());
                    });

                    $(".multipdelivery").each(function(){
                        var pdelivery = $(this).val();
                        if (pdelivery =! "Other"){
                            multi_pdelivery.push(pdelivery);
                        }   
                    });

                    $(".multipdeliveryOther").each(function(){
                        var pdelivery = $(this).val();
                        if (pdelivery =! ""){
                            multi_pdelivery.push(pdelivery);
                        }   
                    });

                    $(".multibattendant").each(function(){
                        var attendant = $(this).val();
                        if (attendant =! "Other"){
                            multi_birthAttendant.push(attendant);
                        }   
                    });

                    $(".multibattendantOther").each(function(){
                        var attendant = $(this).val();
                        if (attendant =! ""){
                            multi_birthAttendant.push(attendant);
                        }   
                    });

                    $(".multibimmunization").each(function(){
                        multi_immunization.push($(this).val());
                    });

                    $(".multifvisited option:selected").each(function(){
                        multi_healthFacilityVisited.push($(this).val());
                    });

                    $(".multirvisit option:selected").each(function(){
                        multi_reasonForVisit.push($(this).val());
                    });

                    $(".multidisability option:selected").each(function(){
                        multi_disability.push($(this).val());
                    });

                    $(".multiSoloParent option:selected").each(function(){
                        multi_soloParent.push($(this).val());
                    });

                    $(".multiIsRegisteredSeniorCitizen:checked").each(function(){
                        multi_isRegisteredSeniorCitizen.push($(this).val());
                    });

                    $(".multiirv:checked").each(function(){
                        multi_irv.push($(this).val());
                    });

                    $(".multiVotingPrecinct").each(function(){
                        multi_votingPrecinct.push($(this).val());
                    });

                    $(".multiPreviousResidence").each(function(){
                        multi_previousResidence.push($(this).val());
                    });

                    

                    // $(".multisofw:checked").each(function(){
                    //     multi_is_ofw.push($(this).val());
                    // });
                    // $(".multiws option:selected").each(function(){
                    //     multi_work_status.push($(this).val());
                    // });

                    $(".multidsw").each(function(){
                        multi_dsw.push($(this).val());
                    });

                    $(".multireltohead option:selected").each(function(){
                        multi_reltohead.push($(this).val());
                    });

                    $(".multicontactc").each(function(){
                        multi_contactc.push($(this).val());
                    });


                    $(".multityper option:selected").each(function(){
                        multi_typer.push($(this).val());
                    });

                    $(".multim option:selected").each(function(){
                        multim.push($(this).val());
                    });


                    $(".multirc option:selected").each(function(){
                        var reasonForComing = $(this).val();
                        if (reasonForComing =! "Other"){
                            multirc.push(reasonForComing);
                        }   
                    });

                    $(".multircOther").each(function(){
                        var reasonForComing = $(this).val();
                        if (reasonForComing =! ""){
                            multirc.push(reasonForComing);
                        }   
                    });

                    $(".multipstartdate").each(function(){
                        multi_p_startdate.push($(this).val());
                    });

                    $(".multipenddate").each(function(){
                        multi_p_enddate.push($(this).val());
                    });


                    $(".multifromwhat").each(function(){
                        multi_fromwhat.push($(this).val());
                    });

                    $(".multires option:selected").each(function(){
                        multi_res.push($(this).val());
                    });


                console.log(multi_res)
                // $(".dateofbirth").each(function() {
                //     multi_doba.push($(this).val())
                // });

                $(".multidoba").each(function() {
                    multi_doba.push($(this).val())
                });
                console.log(multi_doba)
               console.log("multidoba length :" + multi_doba.length)
                var multistatus = [];

                for(var i=0; i<multi_doba.length; i++)
                {
                        cdate.push(new Date(Date.now()));
                        rgdate.push(new Date(multi_doba[i]));
                        ryear[i] = parseInt(rgdate[i].getFullYear());
                        rmont[i] = parseInt(String(rgdate[i].getMonth() + 1).padStart(2, '0'));
                        rday[i] = parseInt(String(rgdate[i].getDate()).padStart(2, '0'));
                        cyear[i] = parseInt(cdate[i].getFullYear());
                        cmon[i] = parseInt(cdate[i].getMonth() + 1);
                        cday[i] = parseInt(String(cdate[i].getDate()).padStart(2, '0'));
                        age[i] = cyear[i] - ryear[i];

                        if (rday[i] >= 32) { rday[i] = 1; }
                        if (rmont[i] >= 13) { rmont[i] = 1; }

                        current_year[i] = new Date(cyear[i],cmon[i],cday[i]);
                        dob_year[i] = new Date(ryear[i],rmont[i],rday[i]);
                        const oneDay = 1000 * 60 * 60 * 24;
                        //days[i] = DaysBetween(dob_year,current_year); Date.UTC(current_year[i].getFullYear(), current_year[i].getMonth(), current_year[i].getDate());  Date.UTC(dob_year[i].getFullYear(), dob_year[i].getMonth(), dob_year[i].getDate());
                        start[i] = new Date(cyear[i],cmon[i],cday[i]);
                        end[i] =  new Date(ryear[i],rmont[i],rday[i]);
                        days[i] = DaysBetween(dob_year[i],current_year[i]);

                        if (age[i]==0 || age[i]<0) {

                            if (days[i] <= 28 && days[i] >= 0) {
                                 //fcolors[i]="#ffcdcc";
                               //multistatus[i] = "newborn";
                               multistatus.push("newborn");
                            }
                            if (days[i] >= 29) {
                               // multistatus[i] = "infant";
                               multistatus.push("infant");
                            }
                        }
                        if (age[i] >= 1 && age[i] <= 10) {
                                // multistatus[i] = "child";
                                multistatus.push("child");
                        }
                        if (age[i] >= 11 && age[i] <= 19) {
                                // multistatus[i] = "adolescent";
                                multistatus.push("adolescent");
                        }
                        if (age[i] >= 60) {
                                // multistatus[i] = "elderly";
                                multistatus.push("elderly");
                        }
                    }
                    //multistatus.push("newborn");
                console.log("multi status: " + multistatus)
                console.log("multistatus length :" + multistatus.length)


                get_data = {


                firstname: fname,
                middlename: mname,
                lastname: lname,
                multi_qualifier,
                qualifier: qualifier,
                sex_gender: selectedsex,
                dateofbirth: dateofbirth,

                civilstatus: civilstatus,
                placeofbirth: placeofbirth,
                // is_ofw: is_ofw,

                citizenship: citizenship,
                occupation: occupation,
                monthlyIncome : monthlyIncome,
                incomeStatus : incomeStatus,
                employmentStatus : employmentStatus,
                workplace : workplace,
                // workstatus: workstatus,
                dateofstartwork: dateofstartwork,
                relationtohead: relationtohead,
                dateofarrive: dateofarrive,

                // is_indegenous: is_indegenous,
                firstname: fname,
                contactnumber: contactnumber,
                arrivalreason: arrivalreason,
                fromwhat: fromwhat,
                r_coming: r_coming,
                p_startdate: p_startdate,
                p_enddate: p_enddate,

                houseno: houseno,
                hstreet: hstreet,
                hphase: hphase,
                hbuilding: hbuilding,
                hunitno: hunitno,
                hsubdivision: hsubdivision,

                homeownership: homeownership,
                buildmaterial: buildmaterial,
                numberofrooms:numberofrooms,
                barangayaddress_id:barangayzone_id,
                streetno:streetno,
                barangayzone_id:barangayzone_id,

                toilet: toilet,
                playarea: playarea,
                bedroom: bedroom,
                dining: dining,
                sala: sala,
                kitchen: kitchen,
                runningwater: runningwater,
                electricity: electricity,
                aircon: aircon,
                mobile: mobile,
                computer: computer,
                internet: internet,
                boxtv: boxtv,
                cdplayer: cdplayer,
                boxradio: boxradio,
                comics: comics,
                newspaper: newspaper,
                pets: pets,
                books: books,
                storybooks: storybooks,
                toys: toys,
                boardgames: boardgames,
                puzzles: puzzles,
                personinhousehold:personinhousehold,
                educationatt:educationatt,
                enrollment_status:enrollment_status,
                school_type:school_type,

                pdelivery:pdelivery,
                battendant:battendant,
                bimmunization:bimmunization,
                fvisited:fvisited,
                rvisit:rvisit,
                disability:disability,
                soloParent : soloParent,
                isRegisteredSeniorCitizen : isRegisteredSeniorCitizen,
                is_registered_voter: is_registered_voter,
                votingPrecinct : votingPrecinct,
                previousResidence : previousResidence,
                pschool:pschool,
                religion:religion,
                ethnicity:ethnicity,
                lotownership:lotownership,
                typeofdocument:typeofdocument,
                wherectcissued:wherectcissued,
                sdtraining:sdtraining,
                mar_status: mar_status,

                multi_fname :  multi_fname,
                multi_mname :multi_mname,
                multi_lname:multi_lname,
                multi_poba:multi_poba,

                multi_doar:multi_doar,
                multi_ctizi:multi_ctizi,
                multi_cvstat:multi_cvstat,
                multi_religion:multi_religion,
                multi_sex:multi_sex,
                multi_educatt:multi_educatt,
                multi_enstat:multi_enstat,
                multi_school_type:multi_school_type,
                multi_pschool:multi_pschool,
                multi_occupation:multi_occupation,
                multi_monthlyIncome : multi_monthlyIncome,
                multi_incomeStatus : multi_incomeStatus,
                multi_employmentStatus : multi_employmentStatus,
                multi_workplace : multi_workplace,
                // multi_work_status:multi_work_status,
                multi_pdelivery : multi_pdelivery,
                multi_birthAttendant : multi_birthAttendant,
                multi_immunization : multi_immunization,
                multi_healthFacilityVisited : multi_healthFacilityVisited,
                multi_reasonForVisit, multi_reasonForVisit,
                multi_disability : multi_disability,
                multi_soloParent : multi_soloParent,
                multi_isRegisteredSeniorCitizen : multi_isRegisteredSeniorCitizen,
                multi_irv:multi_irv,
                multi_votingPrecinct : multi_votingPrecinct,
                multi_previousResidence : multi_previousResidence,
                multi_dsw:multi_dsw,
                // multi_is_ofw:multi_is_ofw,
                
                multi_reltohead:multi_reltohead,
                multi_contactc:multi_contactc,
                multi_typer:multi_typer,
                multim:multim,
                multirc:multirc,
                multi_p_startdate:multi_p_startdate,
                multi_p_enddate:multi_p_enddate,
                multi_migrants:multi_migrants,
                multi_fromwhat:multi_fromwhat,
                multi_res:multi_res,
                multistatus:multistatus,
                multi_doba : multi_doba,
                status: status,
                _token: "{{ csrf_token() }}"
                };

                let result;

               Add(get_data);


    // end main household




});




    //START RBI FORM
    count = 2;

    // $(document).on('change','.rbi-homeownership',function(){
    //     if($(this).find('option:selected').val() != 'Owned')
    //     {
    //             $('#rbi-RelationToHead').clear();
    //             $('.rbi-RelToHead-show'+$(this).attr('target')).show();
    //     }else{
    //             $('#rbi-RelationToHead').val("Head");
    //             $('.rbi-RelToHead-show'+$(this).attr('target')).hide();
    //     }
    // });
    $(document).on('change','.remove-btn',function(){
        $("#row")
    });
    function RemoveRBI(count)
    {
        $(".srow"+count).remove();


    }
    multi_form_count = 0;
    multi_form_count_radio_1 = 4;
    multi_form_count_radio_2 = 6;
    $(document).on('click','.add-rbi-btn',function(){
        count_select = 3;
        get_count_m= count + 1;
        get_count_f= count +2;
        get_multi_form_count_increment = multi_form_count++;
        get_multi_form_count_increment_1 = multi_form_count_radio_1++;
        get_multi_form_count_increment_2 = multi_form_count_radio_2++;
            $(".rbi-list-form").append(

                '<fieldset class="srow'+get_multi_form_count_increment+'"><div class="alert alert-primary fade show">&nbsp;'
                    +'<button type="button" class="btn btn-sm btn-success add-rbi-btn" style="float: right"><i class="fa fa-plus"></i></button>'
                    +'<button type="button" class="btn btn-sm btn-danger "  onclick="RemoveRBI('+get_multi_form_count_increment+')" style="float: right" id="delete-rbi-btn"><i class="fa fa-times"></i></button></div>'
                    +'<div class="row"><div class="col-md-6 multi-form-resident " > '
                        +'<div class="form-group row m-b-10">'
                            +'<label class="col-md-3 col-form-label text-md-right">First Name <span class="text-danger">*</span></label>'
                                +'<div class="col-md-6">'
                                    +'<input type="text " id="rbi-firstname" name="rbi-firstname" placeholder="John" class="form-control rbi-firstname" style="text-transform: uppercase; "/>'
                                +'</div>'
                        +'</div>'
                        +'<div class="form-group row m-b-10">'
                            +'<label class="col-md-3 col-form-label text-md-right">Middle Name </label>'
                                +'<div class="col-md-6">'
                                    +'<input type="text" id="rbi-middlename" name="rbi-middlename" class="form-control rbi-middlename" />'
                                +'</div>'
                        +'</div>'
                        +'<div class="form-group row m-b-10">'
                            +'<label class="col-md-3 col-form-label text-md-right">Last Name <span class="text-danger">*</span></label>'
                                +'<div class="col-md-6">'
                                    +'<input type="text" id="rbi-lastname" name="rbi-lastname" placeholder="Smith"  class="form-control rbi-lastname" />'
                                +'</div>'
                        +'</div>'
                        +'<div class="form-group row m-b-10">'
                            +'<label class="col-md-3 col-form-label text-md-right">Qualifier</label>'
                                +'<div class="col-md-6">'
                                    +'<input type="text" id="rbi-qualifier" name="rbi-qualifier" class="form-control rbi-qualifier" />'
                                +'</div>'
                        +'</div>'

                        +'<div class="form-group row m-b-10 rbi-RelToHead-show'+get_count_m+'">'
                            +'<label class="col-md-3 col-form-label text-md-right">Relationship to Household Head<span class="text-danger">*</span></label>'
                                +'<div class="col-md-6"><select id=rbi-RelationToHead name=rbi-RelationToHead class="form-control rbi-RelationToHead">'
                                        +'<option value="Head" selected>Head </option>'
                                        +'<option value="Spouse">Spouse </option>'
                                        +'<option value="Son">Son </option>'
                                        +'<option value="Daughter">Daughter </option>'
                                        +'<option value="Stepson">Stepson</option>'
                                        +'<option value="Stepdaughter">Stepdaughter </option>'
                                        +'<option value="Son-in-law">Son-in-law</option>'
                                        +'<option value="Daughter-in-law">Daughter-in-law</option>'
                                        +'<option value="Grandson">Grandson </option>'
                                        +'<option value="Granddaughter">Granddaughter </option>'
                                        +'<option value="Father">Father </option>'
                                        +'<option value="Mother">Mother </option>'
                                        +'<option value="Brother">Brother </option>'
                                        +'<option value="Sister">Sister </option>'
                                        +'<option value="Uncle">Uncle </option>'
                                        +'<option value="Aunt">Aunt </option>'
                                        +'<option value="Nephew">Nephew </option>'
                                        +'<option value="Niece">Niece </option>'
                                        +'<option value="Other relative">Other relative</option>'
                                        +'<option value="Nonrelative">Nonrelative </option>'
                                        +'<option value="Boarder">Boarder </option>'
                                        +'<option value="Househelper">Househelper </option>'
                                        +'</select>'
                                +'</div>'
                        +'</div>'

                        +'<div class="form-group row m-b-10">'
                            +'<label class="col-md-3 col-form-label text-md-right">Sex <span class="text-danger">&nbsp;</span></label>'
                                +'<div class="col-md-6">'
                                    +'<div class="radio radio-css radio-inline">'
                                        +'<input type="radio" name="rbi-sex_gender'+get_multi_form_count_increment_1+'"  class="rbi-sex_gender" id="inlineCssRadio'+get_multi_form_count_increment_1+'" value="Male" checked />'
                                        +'<label for="inlineCssRadio'+get_multi_form_count_increment_1+'">Male</label>'
                                    +'</div>'
                                    +'<div class="radio radio-css radio-inline">'
                                        +'<input type="radio" name="rbi-sex_gender'+get_multi_form_count_increment_1+'"  class="rbi-sex_gender" id="inlineCssRadio'+get_multi_form_count_increment_2+'" value="Female"/>'
                                        +'<label for="inlineCssRadio'+get_multi_form_count_increment_2+'" value="Female">Female</label>'
                                    +'</div>'
                                +'</div>'
                        +'</div>'
                        +'<div class="form-group row m-b-10">'
                            +'<label class="col-md-3 col-form-label text-md-right">Date of Birth<span class="text-danger">*</span></label>'
                                +'<div class="col-md-6">'
                                    +'<input type="date" id="rbi-dateofbirth"  target="'+get_multi_form_count_increment_2+'" name="rbi-dateofbirth" placeholder="" class="form-control rbi-dateofbirth"  />'
                                +'</div>'
                        +'</div>'
                        +'<div class="form-group row m-b-10 ">'
                            +'<label class="col-md-3 col-form-label text-md-right">Age<span class="text-danger">*</span></label>'
                                +'<div class="col-md-6">'
                                    +'<input type="text" id="rbi-age'+get_multi_form_count_increment_2+'" name="rbi-age" class="form-control rbi-age" style="background-color: white;" readonly  />'
                                +'</div>'
                        +'</div>'
                        +'<div class="form-group row m-b-10">'
                            +'<label class="col-md-3 col-form-label text-md-right">Place of Birth<span class="text-danger">*</span></label>'
                                +'<div class="col-md-6">'
                                    +'<input type="text" id="rbi-placeofbirth" name="rbi-placeofbirth" class="form-control rbi-placeofbirth" style="background-color: white;"  />'
                                +'</div>'
                        +'</div>'

                        +'<div class="form-group row m-b-10">'
                            +'<label class="col-md-3 col-form-label text-md-right">Citizenship<span class="text-danger"></span></label>'
                                +'<div class="col-md-6">'
                                    +'<input type="text" id="rbi-Citizenship" name="rbi-Citizenship" placeholder="Filipino" class="form-control rbi-Citizenship" />'
                                +'</div>'
                        +'</div> '

                        +'<div class="form-group row m-b-10">'
                            +'<label class="col-md-3 col-form-label text-md-right">Civil Status <span class="text-danger">*</span></label>'
                                +'<div class="col-md-6">'
                                    +'<select class="form-control rbi-civilstatus " data-style="btn-lime" id="rbi-civilstatus" name="rbi-civilstatus">'
                                        +'<option value="Single" >Single</option>'
                                        +'<option value="Married" >Married</option>'
                                        +'<option value="Separated" >Separated</option>'
                                        +'<option value="Widow" >Widow</option>'
                                        +'<option value="Divorced" >Divorced</option>'
                                        +'<option value="Annulled" >Annulled</option>'
                                        +'<option value="Unknown" >Unknown</option>'
                                    +'</select>'
                                +'</div>'
                        +'</div>'
                    +'</div>'


                    +'<div class="col-md-6 " >'
                         +'<div class="form-group row m-b-10" >'
                            +'<label class="col-md-3 col-form-label text-md-right">Occupation<span class="text-danger">*</span></label>'
                                +'<div class="col-md-6">'
                                    +'<input type="text" id="rbi-Occupation" name="rbi-Occupation" placeholder="Indicate None if so" class="form-control rbi-Occupation" required />'
                                +'</div>'
                        +'</div>'

                        +'<div class="form-group row m-b-10">'
                            +'<label class="col-md-3 col-form-label text-md-right">Housing Ownership<span class="text-danger">*</span></label>'
                                +'<div class="col-md-6">'
                                    +'<select class="form-control rbi-homeownership" target="'+get_count_m+'"  data-style="btn-lime" id="rbi-homeownership" name="rbi-homeownership">'
                                        +'<option value="Owned" selected>Owned</option>'
                                        +'<option value="Amortized">Amortized</option>'
                                        +'<option value="Rent-free with owner consent" >Rent-free with owner consent</option>'
                                        +'<option value="Rent-free without owner consent">Rent-free without owner consent</option>'

                                    +'</select>'
                                +'</div>'
                        +'</div>'

                        +'<div class="form-group row m-b-10">'
                            +'<label class="col-md-3 col-form-label text-md-right">Lot Ownership<span class="text-danger">*</span></label>'
                                +'<div class="col-md-6">'
                                    +'<select class="form-control rbi-lotownership" target="'+get_count_m+'"  data-style="btn-lime" id="rbi-lotownership" name="rbi-lotownership">'
                                        +'<option value="Owned" selected>Owned</option>'
                                        +'<option value="Amortized">Amortized</option>'
                                        +'<option value="Rent-free with owner consent" >Rent-free with owner consent</option>'
                                        +'<option value="Rent-free without owner consent">Rent-free without owner consent</option>'

                                    +'</select>'
                                +'</div>'
                        +'</div>'


                        +'<div class="form-group row m-b-10">'
                            +'<label class="col-md-3 col-form-label text-md-right">Address<span class="text-danger">*</span></label>'
                                +'<div class="col-md-6">'
                                    +'<input type="number" name="rbi-houseno" id="rbi-houseno" placeholder="House No.*" class="form-control rbi-houseno"/>'
                                    +'<input type="text" name="rbi-hstreet_no" id="rbi-hstreet_no" placeholder="Street*" class="form-control rbi-hstreet_no"  />'
                                    +'<input type="text" name="rbi-hstreet" id="rbi-hstreet" placeholder="Sitio*" class="form-control rbi-hstreet" />                '
                                +'</div>'
                        +'</div>'

                        +'<div class="form-group row m-b-10">'
                            +'<label class="col-md-3 col-form-label text-md-right">Optional<span class="text-danger"></span></label>'
                                +'<div class="col-md-6">'

                                    +'<input type="text" name="rbi-hbuilding" id="rbi-hbuilding" placeholder="Building" class="form-control rbi-hbuilding"/>'
                                    +'<input type="text" name="rbi-hunitno" id="rbi-hunitno" placeholder="Unit No." class="form-control rbi-hunitno"/>'
                                    +'<input type="text" name="rbi-hsubdivision" id="rbi-hsubdivision" placeholder="Subdivision" class="form-control rbi-hsubdivision"/>'
                                +'</div>'
                        +'</div> '

                    +'</div>'
                    +'</div>'
                    +'</fieldset>'
            );
        });


    function check_multi_age(dateofbirth){
        birthDate = new Date(dateofbirth);
        today = new Date();

        var years = (today.getFullYear() - birthDate.getFullYear());

        if (today.getMonth() < birthDate.getMonth() ||
            today.getMonth() == birthDate.getMonth() && today.getDate() < birthDate.getDate()) {
        years--;
    }

    return years;


    }
    $(document).on('change','#rbi-dateofbirth', function() {
        getAgeRbi();
    });
    // $(document).on('change','#rbi-dateofbirth', function(){
    //     get_age =check_multi_age($(this).val());
    //     var cdate = new Date(Date.now());
    //         var rgdate = new Date($(this).val());
    //         var ryear = parseInt(rgdate.getFullYear());
    //         var rmont = parseInt(String(rgdate.getMonth() + 1).padStart(2, '0')) ;
    //         var rday = parseInt(String(rgdate.getDate()).padStart(2, '0') ) ;
    //         var cyear = parseInt(cdate.getFullYear());
    //         var cmon = parseInt(cdate.getMonth() + 1);
    //         var cday = parseInt(String(cdate.getDate()).padStart(2, '0'));

    //         var age = cyear - ryear;

    //         if (rday >= 32){
    //             rday = 1;
    //         }
    //         if (rmont >= 13){
    //             rmont = 1;
    //         }
    //         var current_year = new Date(cyear,cmon,cday);
    //         var dob_year = new Date(ryear,rmont,rday);
    //         var days = DaysBetween(dob_year,current_year);



    //         if (age >= 1 ) {

    //             age == 1 ? $("#rbi-age").val(age + " year old") : $("#rbi-age").val(age + " year's old")
    //         }
    //         else if ( age < 1 ){
    //             days <= 1 ? $("#rbi-age").val(days + " day old") : $("#rbi-age").val(days + " day's old")
    //         }
    // });
    $(document).on('change','.rbi-dateofbirth', function(){
        get_age =check_multi_age($(this).val());
        var cdate = new Date(Date.now());
            var rgdate = new Date($(this).val());
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



                if (age >= 1 ) {

                    age == 1 ? $("#rbi-age"+$(this).attr('target')).val(age + " year old") :$("#rbi-age"+$(this).attr('target')).val(age + " year's old")
                }
                else if ( age < 1 ){
                    days <= 1 ? $("#rbi-age"+$(this).attr('target')).val(days + " day old") :$("#rbi-age"+$(this).attr('target')).val(days + " day's old")
                }

    });

    $(document).on('change','.multidoba', function(){
        get_age =check_multi_age($(this).val());
        var cdate = new Date(Date.now());
            var rgdate = new Date($(this).val());
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


            if (age >= 1 ) {

                age == 1 ? $("#multiage"+$(this).attr('target')).val(age + " year old") :$("#multiage"+$(this).attr('target')).val(age + " year's old")
            }
            else if ( age < 1 ){
                days <= 1 ? $("#multiage"+$(this).attr('target')).val(days + " day old") :$("#multiage"+$(this).attr('target')).val(days + " day's old")
            }

    });


    $(document).on('click','.sw-btn-next',function(){
        $multi_rbi_first_name = [];
        $multi_rbi_middle_name = [];
        $multi_rbi_last_name = [];
        $multi_rbi_qualifier = [];
        $multi_rbi_sex = [];
        $multi_rbi_date_of_birth = [];
        $multi_rbi_age = [];
        $multi_rbi_place_of_birth = [];
        $multi_rbi_civil_status = [];
        $multi_rbi_homeownership = [];
        $multi_rbi_lotownership = [];
        $multi_rbi_houseno = [];
        $multi_rbi_hstreet_no = [];
        $multi_rbi_hstreet = [];
        $multi_rbi_hphase = [];
        $multi_rbi_hbuilding = [];
        $multi_rbi_hunitno = [];
        $multi_rbi_hsubdivision = [];
        $multi_rbi_citizenship = [];
        $multi_rbi_occupation = [];
        $multi_rbi_rel_to_head = [];

        $(".rbi-firstname").each(function(){
            $multi_rbi_first_name.push($(this).val());
        });

        $(".rbi-middlename").each(function(){
            $multi_rbi_middle_name.push($(this).val());
        });

        $(".rbi-lastname").each(function(){
            $multi_rbi_last_name.push($(this).val());
        });

        $(".rbi-qualifier").each(function(){
            $multi_rbi_qualifier.push($(this).val());
        });

        $(".rbi-sex_gender:checked").each(function(){
            $multi_rbi_sex.push($(this).val());
        });

        $(".rbi-dateofbirth").each(function(){
            $multi_rbi_date_of_birth.push($(this).val());
        });

        $(".rbi-age").each(function(){
            $multi_rbi_age.push($(this).val());
        });

        $(".rbi-placeofbirth").each(function(){
            $multi_rbi_place_of_birth.push($(this).val());
        });

        $(".rbi-civilstatus option:selected").each(function(){
            $multi_rbi_civil_status.push($(this).val());
        });

        $(".rbi-homeownership option:selected").each(function(){
            $multi_rbi_homeownership.push($(this).val());
        });

        $(".rbi-lotownership option:selected").each(function(){
            $multi_rbi_lotownership.push($(this).val());
        });

        $(".rbi-houseno").each(function(){
            $multi_rbi_houseno.push($(this).val());
        });

        $(".rbi-hstreet_no").each(function(){
            $multi_rbi_hstreet_no.push($(this).val());
        });

        $(".rbi-hstreet").each(function(){
            $multi_rbi_hstreet.push($(this).val());
        });


        $(".rbi-hbuilding").each(function(){
            $multi_rbi_hbuilding.push($(this).val());
        });

        $(".rbi-hunitno").each(function(){
            $multi_rbi_hunitno.push($(this).val());
        });

        $(".rbi-hsubdivision").each(function(){
            $multi_rbi_hsubdivision.push($(this).val());
        });

        $(".rbi-Citizenship").each(function(){
            $multi_rbi_citizenship.push($(this).val());
        });

        $(".rbi-RelationToHead1 option:selected").each(function(){
          
            $multi_rbi_rel_to_head.push($(this).val());
        });

        $(".rbi-Occupation").each(function(){
            $multi_rbi_occupation.push($(this).val());
        });



        $("#rbi-summary-table tbody tr:eq(3)").remove();

        //THIS IS FOR SUMMARY TABLE IN RBI
        var table = $("table[id = 'rbi-summary-table'] tbody");
                           table.find("td").remove();

        for(i = 0 ; i < $multi_rbi_first_name.length ; i++)
        {

            table.append(
                    '<tr>'
                    +'<td>'+$multi_rbi_last_name[i].toUpperCase()+'</td>'
                    +'<td>'+$multi_rbi_first_name[i].toUpperCase()+'</td>'
                    +'<td>'+$multi_rbi_middle_name[i].toUpperCase()+'</td>'
                    +'<td>'+$multi_rbi_qualifier[i].toUpperCase()+'</td>'
                    +'<td>'+($multi_rbi_houseno[i] == '' ? $multi_rbi_hunitno[i] :  $multi_rbi_houseno[i] )+'</td>'
                    +'<td>'+$multi_rbi_hstreet_no[i]+'</td>'
                    +'<td>'+($multi_rbi_hstreet[i] == '' ? $multi_rbi_hsubdivision[i] : $multi_rbi_hstreet[i] )+' </td>'
                    +'<td>'+$multi_rbi_place_of_birth[i]+'</td>'
                    +'<td>'+$multi_rbi_date_of_birth[i]+'</td>'
                    +'<td>'+$multi_rbi_sex[i]+'</td>'
                    +'<td>'+$multi_rbi_civil_status[i]+'</td>'
                    +'<td>'+$multi_rbi_citizenship[i]+'</td>'
                    +'<td>'+$multi_rbi_occupation[i]+'</td>'
                    +'<td>'+$multi_rbi_rel_to_head[i]+'</td>'
                    +'</tr>'
            );


        }
    });


    $("#register-rbi-btn").click(function(){
        multi_rbi_first_name = [];
        multi_rbi_middle_name = [];
        multi_rbi_last_name = [];
        multi_rbi_qualifier = [];
        multi_rbi_sex = [];
        multi_rbi_date_of_birth = [];
        multi_rbi_age = [];
        multi_rbi_place_of_birth = [];
        multi_rbi_civil_status = [];
        multi_rbi_homeownership = [];
        multi_rbi_lotownership = [];
        multi_rbi_houseno = [];
        multi_rbi_hstreet = [];
        multi_rbi_hphase = [];
        multi_rbi_hbuilding = [];
        multi_rbi_hunitno = [];
        multi_rbi_hstreet_no = [];
        multi_rbi_hsubdivision = [];
        multi_rbi_citizenship = [];
        multi_rbi_occupation = [];
        multi_rbi_rel_to_head = [];
        multi_rbi_status = [];
        multi_rbi_blk = [];

        $(".rbi-blk").each(function(){
            multi_rbi_blk.push($(this).val());
        });

        $(".rbi-firstname").each(function(){
            multi_rbi_first_name.push($(this).val().toUpperCase());
        });
        console.log(multi_rbi_first_name)
        $(".rbi-middlename").each(function(){
            multi_rbi_middle_name.push($(this).val().toUpperCase());
        });

        $(".rbi-lastname").each(function(){
            multi_rbi_last_name.push($(this).val().toUpperCase());
        });

        $(".rbi-qualifier").each(function(){
            multi_rbi_qualifier.push($(this).val().toUpperCase());
        });

        $(".rbi-sex_gender:checked").each(function(){
            multi_rbi_sex.push($(this).val());
        });

        $(".rbi-dateofbirth").each(function(){
            multi_rbi_date_of_birth.push($(this).val());

        $(".rbi-hstreet_no").each(function(){
            multi_rbi_hstreet_no.push($(this).val());
        });


            var cdate = new Date(Date.now());
            var rgdate = new Date($(this).val());
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


            $("#rbi-age").val(age)
                if (age==0 || age<0) {
                    if ( days <= 28 && days >= 0 ) {

                        var status = "newborn";
                        multi_rbi_status.push(status);

                    }
                    else if ( days >= 29 ) {

                        var status = "infant";
                        multi_rbi_status.push(status);
                    }
                }
                else if (age >= 1 && age <= 10) {
                console.log('this is for children');
                console.log('child');
                var status = "child";
                multi_rbi_status.push(status);
                }
                else if (age >= 11 && age <= 19) {
                console.log('adolescent');
                console.log('child');
                var status = "adolescent";
                multi_rbi_status.push(status);
                }
                else if (age >= 20 && age <= 59) {
                console.log('adolescent');
                console.log('child');
                var status = "";
                multi_rbi_status.push(status);
                }
                else if ( age >= 60 ) {
                console.log('elderly');
                console.log('elderly');
                var status = "elderly";
                multi_rbi_status.push(status);
                }


        });

        $(".rbi-age").each(function(){
            multi_rbi_age.push($(this).val());
        });

        $(".rbi-placeofbirth").each(function(){
            multi_rbi_place_of_birth.push($(this).val());
        });

        $(".rbi-civilstatus option:selected").each(function(){
            multi_rbi_civil_status.push($(this).val());
        });

        $(".rbi-homeownership option:selected").each(function(){
            multi_rbi_homeownership.push($(this).val());
        });

        $(".rbi-lotownership option:selected").each(function(){
            multi_rbi_lotownership.push($(this).val());
        });

        $(".rbi-houseno").each(function(){
            multi_rbi_houseno.push($(this).val());
        });

        $(".rbi-hstreet").each(function(){
            multi_rbi_hstreet.push($(this).val());
        });

        $(".rbi-hphase").each(function(){
            multi_rbi_hphase.push($(this).val());
        });

        $(".rbi-hbuilding").each(function(){
            multi_rbi_hbuilding.push($(this).val());
        });

        $(".rbi-hunitno").each(function(){
            multi_rbi_hunitno.push($(this).val());
        });

        $(".rbi-hsubdivision").each(function(){
            multi_rbi_hsubdivision.push($(this).val());
        });

        $(".rbi-Citizenship").each(function(){
            multi_rbi_citizenship.push($(this).val());
        });

        $(".rbi-RelationToHead1 option:selected").each(function(){
            multi_rbi_rel_to_head.push($(this).val());
        });

        $(".rbi-Occupation").each(function(){
            multi_rbi_occupation.push($(this).val());
        });

        get_data = {
            multi_rbi_first_name     : multi_rbi_first_name,
            multi_rbi_middle_name    : multi_rbi_middle_name,
            multi_rbi_last_name      : multi_rbi_last_name,
            multi_rbi_qualifier      : multi_rbi_qualifier,
            multi_rbi_sex            : multi_rbi_sex,
            multi_rbi_date_of_birth  : multi_rbi_date_of_birth,
            multi_rbi_age            : multi_rbi_age,
            multi_rbi_place_of_birth : multi_rbi_place_of_birth,
            multi_rbi_civil_status   : multi_rbi_civil_status,
            multi_rbi_homeownership  : multi_rbi_homeownership,
            multi_rbi_lotownership   : multi_rbi_lotownership,
            multi_rbi_houseno        : multi_rbi_houseno,
            multi_rbi_hstreet        : multi_rbi_hstreet,
            multi_rbi_hphase         : multi_rbi_hphase,
            multi_rbi_hstreet_no     : multi_rbi_hstreet_no,
            multi_rbi_hbuilding      : multi_rbi_hbuilding,
            multi_rbi_hunitno        : multi_rbi_hunitno,
            multi_rbi_hsubdivision   : multi_rbi_hsubdivision,
            multi_rbi_citizenship    : multi_rbi_citizenship,
            multi_rbi_occupation     : multi_rbi_occupation,
            multi_rbi_rel_to_head    : multi_rbi_rel_to_head,
            multi_rbi_status         : multi_rbi_status,
            multi_rbi_blk            : multi_rbi_blk,     
            _token                   : '{{csrf_token()}}'


                    };

                    console.log(get_data)
        swal({
                title: "Wait!",
                text: "Are you sure you want to add this residents?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type    :'post',
                        url     :"{{route('RBIAdd')}}",
                        data    : get_data,
                        success : function(data)
                                {
                                    
                                    if(data == "Existing"){
                                         swal("Data already exist!", {
                                         icon: "warning",

                                        });
                                    }
                                    else{
                                        // location.reload();
                                         swal("Data have been successfully added!", {
                                         icon: "success",

                                        });

                                    }
                                    
                                },
                        error   : function()
                                {
                                // alert(error);
                                }
                    });
                   
                    // location.reload();

                } else {
                    swal("Operation Cancelled.", {
                        icon: "error",
                    });
                }
            });

    });

    // END RBI FORM


</script>
<script type="text/javascript">

    // SEARCH RESIDENTS SCRIPT START
    table = $("#resident_table").DataTable({

        bFilter: false, 
        columnDefs: [{
            "targets": [0],
            "visible": false
        },{
            "targets": [1],
            "visible": false
        },{
            "targets": [2],
            "visible": false
        },{
            "targets": [3],
            "visible": false
        },{
            "targets": [4],
            "visible": false
        },{
            "targets": [5],
            "visible": false
        },{
            "targets": [6],
            "visible": false
        },{
            "targets": [7],
            "visible": false
        },{
            "targets": [8],
            "visible": false
        },{
            "targets": [9],
            "visible": false
            },{
                "targets": [10],
                "visible": false
            },{
            "targets": [11],
            "visible": false
        },{
            "targets": [14],
            "visible": false
        },{
            "targets": [18],
            "visible": false
        },{
            "targets": [19],
            "visible": false
        },{
            "targets": [20],
            "visible": false
        },{
            "targets": [21],
            "visible": false
        }]
    });

  $('.search_btn').on('click',function() {
            //$('#resident_table').closest('tbody tr').find('td').remove();
            var searchval = $('#stext').val()
            var addresshno, addressstno, addressstreet;
            $.ajax({
               url:  "{{ route('LoadResidents') }}",
               type: 'get',
               data: { searchval: searchval, _token : "{{ csrf_token() }}"},
               success:function(data){
                    table.clear().draw();
                    data['data'].map((val)=>{
                    val['ADDRESS_HOUSE_NO'] == null ? addresshno = '' : addresshno = val['ADDRESS_HOUSE_NO'];
                    val['ADDRESS_STREET_NO'] == null ? addressstno = '' : addressstno = val['ADDRESS_STREET_NO'];
                    val['ADDRESS_STREET'] == null ? addressstreet = '' : addressstreet = val['ADDRESS_STREET'];
                    table.row.add([

                        val['RESIDENT_ID'],
                        val['LASTNAME'],
                        val['FIRSTNAME'],
                        val['MIDDLENAME'],
                        val['Qualifier'],
                        val['DATE_OF_BIRTH'],
                        val['PLACE_OF_BIRTH'],
                        val['RELATION_TO_HOUSEHOLD_HEAD'],
                        val['IS_RBI_COMPLETE'],
                        val['ADDRESS_HOUSE_NO'],
                        val['ADDRESS_STREET_NO'],
                        val['ADDRESS_STREET'],
                        val['LASTNAME'] + ',' +  (val['QUALIFIER'] == null ? '' : val['QUALIFIER']) + ' ' + val['FIRSTNAME'] + ' ' + val['MIDDLENAME'] + ' / ' +val['SEX'],

                        addresshno +' '+ addressstno +' '+ addressstreet,
                        val['SEX'],
                        val['DATE_OF_BIRTH'] + ' , ' +val['PLACE_OF_BIRTH'],
                        val['CIVIL_STATUS'],
                        val['OCCUPATION'],
                        val['CITIZENSHIP'],
                        val['ADDRESS_UNIT_NO'],
                        val['ADDRESS_SUBDIVISION'],
                        val['ADDRESS_BUILDING'],
                        '<button type="button" class="btn btn-success edit-modal-btn" data-toggle="modal" data-target="#UpdateModal"><i class="fas fa-edit"></i> Edit</button>'
                        ]).draw();


                })

               },
               error: function(error){


               }
            });


    })
    // SEARCH RESIDENTS SCRIPT END






    // table = $("#resident_table").DataTable({
    //         serverSide: true,
    //         processing: true,
    //         ordering: false,
    //         ajax: {
    //            url:  "{{ route('LoadResidents') }}",
    //            type: 'get',
    //            data: { searchval: searchval, _token : "{{ csrf_token() }}"}
    //         },

    //         columns: [
    //         { data: "RESIDENT_ID", name: "RESIDENT_ID", visible: false, searchable: true,  },
    //         { data: "LASTNAME", name: "LASTNAME" , visible: false, searchable: true, },
    //         { data: "FIRSTNAME", name: "FIRSTNAME" , visible: false, searchable: true, },
    //         { data: "MIDDLENAME", name: "MIDDLENAME" , visible: false, searchable: true, },
    //         { data: "QUALIFIER",name: "QUALIFIER", visible: false, searchable: false},
    //         { data: "DATE_OF_BIRTH", name: "DATE_OF_BIRTH", visible: false, searchable: false},
    //         { data: "PLACE_OF_BIRTH", name: "PLACE_OF_BIRTH", visible: false, searchable: false},
    //         { data: "RELATION_TO_HOUSEHOLD_HEAD", name: "RELATION_TO_HOUSEHOLD_HEAD", visible: false, searchable: false},
    //         { data: "IS_RBI_COMPLETE", name: "IS_RBI_COMPLETE", searchable: false, visible:false },

    //         { data: "ADDRESS_HOUSE_NO", name: "ADDRESS_HOUSE_NO", visible: false, searchable: false},
    //         { data: "ADDRESS_STREET_NO", name: "ADDRESS_STREET_NO", visible: false, searchable: false},
    //         { data: "ADDRESS_STREET", name: "ADDRESS_STREET", visible: false, searchable: false},

    //         {

    //            render: function ( data, type, full, meta, row ) {
    //                         full.MIDDLENAME == null ? middlename = '' : middlename = full.MIDDLENAME
    //                         full.QUALIFIER == null ? qualifier = '' : qualifier = full.QUALIFIER;

    //                         return full["FIRSTNAME"] + ' ' + middlename +' '+ full["LASTNAME"] + ', ' +qualifier +'<br>' + '('+full["SEX"]+')';
    //                     }, class: 'fontstyling',

    //         },
    //         {

    //            render: function ( data, type, full, meta, row ) {

    //                         full["ADDRESS_STREET_NO"] == null ? streetno  = '' : streetno = full["ADDRESS_STREET_NO"]
    //                         return full["ADDRESS_HOUSE_NO"] + ', ' + streetno +  '<br>' + full["ADDRESS_STREET"];
    //                     }, class: 'fontstyling',

    //         },

    //         { data: "SEX",name: "SEX", searchable: false, visible: false},
    //         {

    //            render: function ( data, type, full, meta, row ) {

    //                         designer = full["PLACE_OF_BIRTH"] + '<br>' + full["DATE_OF_BIRTH"];
    //                         return designer;
    //                     }, searchable: false, class: 'fontstyling',

    //         },
    //         { data: "CIVIL_STATUS", name:"CIVIL_STATUS",searchable:false, class: 'fontstyling'},
    //         { data: "OCCUPATION", name: "OCCUPATION", searchable: false, class: 'fontstyling'},
    //         { data: "CITIZENSHIP", name: "CITIZENSHIP", searchable: false, class: 'fontstyling', visible: false},
    //         { data: "ADDRESS_UNIT_NO", name: "ADDRESS_UNIT_NO", visible: false, searchable: false},
    //         { data: "ADDRESS_SUBDIVISION", name: "ADDRESS_SUBDIVISION", visible: false, searchable: false},
    //         { data: "ADDRESS_BUILDING", name: "ADDRESS_BUILDING", visible: false, searchable: false},

    //         {render:function(data, type, full, meta){

    //             output = "<button  type='button' class='btn btn-success editCategory' data-toggle='modal' data-target='#UpdateModal'><i class='fa fa-edit'></i> Edit&nbsp;";
    //             // active_flag = full.ACTIVE_FLAG;
    //             //  output += "</button><button type='button' class='btn btn-danger disableResident' id='disable' name='disable'><i class='fa fa-redo'></i> Disable</button>";
    //             // if (active_flag == 1) {

    //             // }else {
    //             //     output += "</button><button type='button' class='btn btn-danger' id='enable' name='disable'><i class='fa fa-redo'></i> Disable</button>";
    //             // }

    //             return output;
    //         }, searchable: false, class: 'fontstyling'},
    //         ]
    //     });
$(".btns").hover(function(){
  $(this).css("background-color", "gray");
  
  }, function(){
  $(this).css("background-color", "#348fe2");
  
});


</script>
<script>
$('.add_class').click(function() {
    $('.search_header').hide();
    //alert('hello')
});

$('.record_class').click(function() {
    $('.search_header').show();
    //alert('hello')
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

.sex_show {

}
</style>
<div id="content" class="content" >
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Residents' Information</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin row -->
                <br><br><br><div class="row">

            </div>
            <!-- end row -->
    <!-- begin page-header -->
    <h1 class="page-header">Basic Information  <small>DILG Requirements</small></h1>
    <!-- end page-header -->
     
                <!-- end input-group -->
    <!-- begin nav-pills -->
    <ul class="nav nav-pills">
        <li class="nav-items">
            <a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active record_class">

                <span class="d-sm-block d-none">Records</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link add_class" >

                <span class="d-sm-block d-none">Add New</span>
            </a>
        </li>
    </ul>

    {{--<button type='button' class='btn btn-primary' style="width: 160px" data-toggle='modal' data-target='#Export_Import'><i class='fa fa-test'></i> Export/Import</button><br><br>--}}
    <a class='btn btn-primary' style="width: 160px" href="{{route('ExportImport')}}"><i class='fa fa-test'></i> Export/Import</a><br><br>
    <div class="input-group input-group-lg m-b-20 search_header" >
                    <input type="text" class="form-control input-white" placeholder="Search Resident/Inhabitant" id="stext"/>
                    <div class="input-group-append">
                        <button class="btn btn-primary search_btn"><i class="fa fa-search fa-fw"></i> Search</button>


                    </div>
                </div>
    <div class="modal fade" id="Export_Import" data-backdrop="static">
        <div class="modal-dialog" style="max-width: 25%">

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

                <!-- begin dropdown -->



    
    <div class="tab-content" >
        <!-- begin tab-pane -->

        <div class="tab-pane fade active show" id="nav-pills-tab-1">
            {{--Nav Pill Body Start--}}
            <!-- EXISTING RECORDS START -->
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
                <!-- <div class="alert alert-yellow fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    The following are the existing records of the residents within the system.
                </div> -->
                <!-- end alert -->
                <!-- begin panel-body -->

                <div class="panel-body">

                    <table id="resident_table" class="table table-hover table-striped table-bordered data-table" cellspacing="0" width="100%">
                        <thead>
                            <tr class="remove_data">
                                <th hidden>resident id</th>
                                <th hidden>Last Name</th>
                                <th hidden>First Name</th>
                                <th hidden>Middle Name</th>
                                <th hidden>Qualifier</th>
                                <th hidden>Birthdate </th>
                                <th hidden>Place of birth</th>
                                <th hidden>Relationship to Household Head</th>
                                <th hidden>RBI Status</th>
                                <th hidden>House No</th>
                                <th hidden>Address Street No</th>
                                <th hidden>Address Street</th>
                                <th >Full Name / Gender</th>
                                <th >Address</th>
                                <th hidden>Sex </th>
                                <th >Birth Details </th>
                                <th >Civil Status </th>
                                <th >Occupation</th>
                                <th hidden>Citizenship</th>
                                <th hidden>unit no</th>
                                <th hidden>subdivision</th>
                                <th hidden>building</th>
                                <th style="width: 10%">Actions </th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>



                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel add new -->

            <!-- EXISTING RECORDS END -->


            <!-- SEARCH RESIDENT PANEL START -->


            {{--Nav Pill Body End--}}
        </div>
        <!-- #modal-edit -->
                <div class="modal fade" id="UpdateModal" data-backdrop="static">
                    <div class="modal-dialog" style="max-width: 50%">
                        <form id="EditForm">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #008a8a">
                                    <h4 class="modal-title" style="color: white">Edit Record</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                </div>
                                <div class="modal-body">
                                    {{--modal body start--}}
                                    <h><label style="display: block; text-align: center">Resident's Name</label></h>
                                    <h3><b><label style="text-transform: capitalize; display: block; text-align: center" id="edit_db_name" name="edit_db_name"></label></b></h3>
                                    <h><label style="display: block; text-align: center">Age</label></h>
                                    <h2><b><label style="text-transform: capitalize; display: block; text-align: center" id="edit_age" name="edit_age"></label></b></h2>
                                    <input id="EditCatID" type="text" class="form-control hide" name="CategoryID"/>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="stats-content">
                                                <label for="bfirstname">&nbspResident Name<span class="text-danger">*</span></label> <span id="lblfirstname"></span>
                                                <input class="form-control" id="editlname" name="editlname" placeholder="Lastname" style="text-transform: uppercase;" />

                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="stats-content">
                                                <label for="middlename">&nbsp</label><span id="lblmiddlename"></span>

                                                <input class="form-control" id="editfname" name="editfname" placeholder="FirstName" style="text-transform: uppercase;" />

                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="stats-content">
                                                <label for="lastname">&nbsp</label><span id="lbllastname"></span>

                                                <input class="form-control" id="editmname" name="editfmname" placeholder="MiddleName" style="text-transform: uppercase;"/>

                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <label style="display: block; text-align: left">&nbsp</label>
                                            <input type="text" id="editqname" placeholder="Qualifier" name="editqname" style="display: block; text-align: left; color:black; background-color:white; text-transform: uppercase;" class="form-control">
                                        </div>

                                    </div> <br>

                                    {{--<div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <label class="col-form-label text-md-left">&nbspEducational Attainment<span class="text-danger">*</span></label>
                                            <div class="stats-content">
                                                <select class="form-control " data-style="btn-lime" id="editeducationatt" name="editeducationatt">
                                                    <option value="No education" selected>No education</option>
                                                    <option value="Pre-school" >Pre-school</option>
                                                    <option value="Elementary level">Elementary level</option>
                                                    <option value="Elementary graduate">Elementary graduate</option>
                                                    <option value="High school level">High school level</option>
                                                    <option value="High school Graduate">High school graduate</option>
                                                    <option value="Junior HS level">Junior HS level</option>
                                                    <option value="Junior HS graduate">Junior HS graduate</option>
                                                    <option value="Senior HS level">Senior HS level</option>
                                                    <option value="Senior HS graduate">Senior HS graduate</option>
                                                    <option value="Technical/Vocation">Technical/Vocation</option>
                                                    <option value="College level">College level</option>
                                                    <option value="College graduate">College graduate</option>
                                                    <option value="Post-graduate">Post-graduate</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>--}} <br>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <label >&nbspGender </label><br>
                                            <div class="radio radio-css radio-inline">
                                                <input type="radio" name="edit_gender" id="radiogenderm" value="Male" checked />
                                                <label for="radiogenderm">Male</label>
                                            </div> <br>

                                            <div class="radio radio-css radio-inline">
                                                <input type="radio" name="edit_gender" id="radiogenderf" />
                                                <label for="radiogenderf" value="Female">Female</label>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-4 col-md-6">
                                            <label for="bfirstname">&nbspIs Indigenous?</label><br>
                                            <div class="radio radio-css radio-inline">
                                                <input type="radio" name="edit_isinde" id="editinden" value="1" checked />
                                                <label for="editinden">Yes</label>
                                            </div>
                                            <br>
                                            <div class="radio radio-css radio-inline">
                                                <input type="radio" name="edit_isinde" id="editindey" value="0"/>
                                                <label for="editindey">No</label>
                                            </div>
                                        </div> -->
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="stats-content">
                                                <label class=" col-form-label text-md-left">&nbspAddress<span class="text-danger">*</span></label>
                                                <input type="number" name="edit_houseno" id="edit_houseno" placeholder="House No.*" class="form-control" style="text-transform: capitalize;"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="stats-content">
                                                <label class="col-md-3 col-form-label text-md-right">&nbsp</label>
                                                <input type="text" name="edit_street_no" id="edit_street_no" placeholder="Street No" class="form-control"  style="text-transform: capitalize;"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="stats-content">
                                                <label class="col-md-3 col-form-label text-md-right">&nbsp</label>
                                                <input type="text" name="edit_street" id="edit_street" placeholder="Street" class="form-control"  style="text-transform: capitalize;"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="stats-content">
                                                <label class="col-form-label text-md-right">&nbspOptional</label>
                                                <input type="text" name="edit_hbuilding" id="edit_hbuilding" placeholder="Building" class="form-control" style="text-transform: capitalize;"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="stats-content">
                                                <label class="col-md-3 col-form-label text-md-right">&nbsp</label>
                                                <input type="text" name="edit_hunitno" id="edit_hunitno" placeholder="Unit No." class="form-control" style="text-transform: capitalize;"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            
                                            <div class="stats-content">
                                                <label class="col-md-3 col-form-label text-md-right">&nbsp</label>

                                                <input type="text" name="edit_hsubdivision" id="edit_hsubdivision" placeholder="Subdivision" class="form-control" style="text-transform: capitalize;"/>
                                            </div>
                                        </div>
                                    </div>
                                    <br>


                                    <div class="row">
                                       <div class="col-lg-4 col-md-6">
                                        <label style="display: block; text-align: left">&nbspBirth Date</label>
                                        <input type="date" id="editbdate" name="editbdate" class="form-control" data-parsley-required="true" />
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <label style="display: block; text-align: left">&nbspPlace of Birth</label>
                                        <input type="text" id="editpbirth" name="editpbirth" class="form-control" data-parsley-required="true" style="text-transform: capitalize;" />
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <label style="display: block; text-align: left">&nbspCitizenship</label>
                                        <input type="text" id="editcitiz" name="editcitiz" class="form-control" required style="text-transform: capitalize;" />
                                    </div>

                                </div>
                                <br>

                                <div class="row">

                                <div class="col-lg-4 col-md-6">
                                    <label style="display: block; text-align: left">&nbspCivil Status</label>

                                    <select class="form-control" data-style="btn-lime" id="editcstatus" name="editcstatus">
                                        <option value="Single" selected>Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Separated">Separated</option>
                                        <option value="Widow">Widow</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Annulled">Annulled</option>
                                        <option value="Unknown">Unknown</option>
                                    </select>
                                </div>

                                 <div class="col-lg-4 col-md-6">
                                    <label style="display: block; text-align: left">&nbspOccupation<span class="text-danger">*</span></label>
                                    <input type="text" id="editoccu" name="editoccu" style="display: block; text-align: left; color:black; background-color:white; text-transform: capitalize;" class="form-control" required>
                                </div>

                                <!-- {{--<div class="col-lg-4 col-md-6">
                                    <label style="display: block; text-align: left">&nbspWork Status</label>
                                    <select class="form-control" data-style="btn-lime" id="editwstatus">
                                        <option value="NotApplicable" selected>Not Applicable</option>
                                        <option value="Employed">Employed</option>
                                        <option value="Unemployed">Unemployed</option>
                                        <option value="Retired">Retired</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                               <div class="col-lg-4 col-md-6">
                                <label style="display: block; text-align: left">&nbspDate Started Working</label>
                                <input type="date" id="editsworking" name="editsworking" class="form-control" data-parsley-required="true" />
                            </div> --}} -->
                            
                            <div class="col-lg-4 col-md-6">
                                <label style="display: block; text-align: left">&nbspRelation to Household Head</label>
                                <!-- <input type="text" id="edithead" name="edithead" class="form-control" required style="text-transform: capitalize;"/> -->
                                <select id=edithead name=edithead class="form-control rbi-RelationToHead">
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
                                    <option value="Nonrelative">Nonrelative </option>
                                    <option value="Boarder">Boarder </option>
                                    <option value="Househelper">Househelper </option>
                                </select>
                            </div>
                        </div>
                        <br>

                        {{--<div class="row">
                        <div class="col-lg-4 col-md-6">
                            <label style="display: block; text-align: left">Date Arrived in Barangay</label>
                            <input type="month" id="editarrtime" name="editarrtime" class="form-control" data-parsley-required="true" />
                        </div>


                        <div class="col-lg-4 col-md-6">
                            <label style="display: block; text-align: left">Contact #</label>
                            <input type="number" id="editcontact" name="editcontact" class="form-control" data-parsley-required="true" />
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <label style="display: block; text-align: left">&nbspReason of Arrival</label>
                            <select class="form-control " data-style="btn-lime" name="editareason" id="editareason">

                           </select>
                       </div>

                   </div>
                   <br>

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
        <!-- end tab-pane -->
        <!-- begin tab-pane -->

        <div class="tab-pane fade " id="nav-pills-tab-2">
            {{--Nav Pill Body Start--}}
            {{--Table--}}


                <ul  class="nav nav-tabs nav-tabs-inverse" style="background-color:#348fe2">

                    
                    <li class="nav-item"><a href="#nav-tab-1" data-toggle="tab" style="background-color:#348fe2; color:white" class="nav-link active btns">RBI Form</a></li>
                    <li class="nav-item"><a href="#nav-tab-2" data-toggle="tab" style="background-color:#348fe2; color:white" class="nav-link btns">MIC Form</a></li>
                </ul>
         <br>
         <div class="tab-content">
                <div class="tab-pane fade active show" id="nav-tab-1">
                                <div class="panel panel-inverse">
                                <div class="panel-heading">
                                    <div class="panel-heading-btn">
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                    </div>
                                    <h4 class="panel-title">RBI Form</h4>
                                </div>
                                <div class="panel-body">

                                    <form id="AddForm" name="AddForm">
                                        @csrf

                                        
                                        <div id="wizard">
                                            <!-- begin wizard-step -->
                                            <ul>
                                                <li class="col-md-6 col-sm-3 col-6">
                                                    <a href="#step-1">
                                                        <span class="number">1</span>
                                                        <span class="info text-ellipsis">
                                                            Personal Information
                                                            <small class="text-ellipsis">Basic Information about the resident</small>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="col-md-6 col-sm-3 col-6">
                                                    <a href="#step-2" >
                                                        <span class="number">2</span>
                                                        <span class="info text-ellipsis">
                                                            Summary
                                                            <small class="text-ellipsis">Summary of RBI</small>
                                                        </span>
                                                    </a>
                                                </li>

                                            </ul>

                                            <div>
                                                <div id="step-1" class="rbi-list-form" >

                                                    <!-- begin fieldset -->
                                                    <fieldset><br>

                                                        <div class="alert alert-primary fade show">Basic information about the resident <button type="button" class="btn btn-sm btn-success add-rbi-btn" style="float: right" id="add-rbi-btn"><i class="fa fa-plus"></i></button></div>

                                                        <!-- begin row -->
                                                        <div class="row">
                                                                <br><br>

                                                            <div class="col-md-6">

                                                                    <!-- begin form-group -->
                                                                <div class="form-group row m-b-10">
                                                                    <label class="col-md-3 col-form-label text-md-right">First Name <span class="text-danger">*</span></label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" id="rbi-firstname" name="rbi-firstname" placeholder="Juan" class="form-control rbi-firstname " style="text-transform: uppercase; " />
                                                                        <label id="rbi-firstname-lbl" class="error" for="rbi-firstname"></label>
                                                                    </div>
                                                                </div>
                                                                <!-- end form-group -->
                                                                <!-- begin form-group -->
                                                                <div class="form-group row m-b-10">
                                                                    <label class="col-md-3 col-form-label text-md-right">Middle Name </label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" placeholder="A" id="rbi-middlename" name="rbi-middlename" class="form-control rbi-middlename" style="text-transform: uppercase;"/>
                                                                        <label id="rbi-middlename-lbl" class="error" for="rbi-firstname"></label>
                                                                    </div>
                                                                </div>
                                                                <!-- end form-group -->
                                                                <!-- begin form-group -->
                                                                <div class="form-group row m-b-10">
                                                                    <label class="col-md-3 col-form-label text-md-right">Last Name <span class="text-danger">*</span></label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" id="rbi-lastname" name="rbi-lastname" placeholder="Dela Cruz"  class="form-control rbi-lastname" style="text-transform: uppercase;"/>
                                                                        <label id="rbi-lastname-lbl" class="error" for="rbi-lastname"></label>
                                                                    </div>
                                                                </div>
                                                                <!-- end form-group -->
                                                                <!-- begin form-group -->
                                                                <div class="form-group row m-b-10" style="">
                                                                    <label class="col-md-3 col-form-label text-md-right">Qualifier</label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" id="rbi-qualifier" placeholder="Jr" name="rbi-qualifier" class="form-control rbi-qualifier" style="text-transform: uppercase;"/>
                                                                        <label id="rbi-qualifier-lbl" class="error" for="rbi-qualifier"></label>
                                                                    </div>
                                                                </div>
                                                                <!-- end form-group -->

                                                                <div class="form-group row m-b-10 rbi-RelToHead-show1" >
                                                                <label class="col-md-3 col-form-label text-md-right">Relationship to Household Head<span class="text-danger">*</span></label>
                                                                <div class="col-md-6">
                                                                   <!--  <input type="text" id="rbi-RelationToHead" name="rbi-RelationToHead" placeholder="Indicate Household Head if so" class="form-control rbi-RelationToHead" style="text-transform: capitalize;"/> -->
                                                                    <select id=rbi-RelationToHead name=rbi-RelationToHead class="form-control rbi-RelationToHead1">
                                                                        <option value="Head" selected>Head </option>
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
                                                                        <option value="Nonrelative">Nonrelative </option>
                                                                        <option value="Boarder">Boarder </option>
                                                                        <option value="Househelper">Househelper </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                                <!-- begin form-group -->
                                                                <div class="form-group row m-b-10">
                                                                    <label class="col-md-3 col-form-label text-md-right">Sex <span class="text-danger">&nbsp;</span></label>
                                                                    <div class="col-md-6">
                                                                        <div class="radio radio-css radio-inline">
                                                                            <input type="radio" name="rbi-sex_gender" id="inlineCssRadio1"  class="rbi-sex_gender" value="Male" checked />
                                                                            <label for="inlineCssRadio1">Male</label>
                                                                        </div>
                                                                        <div class="radio radio-css radio-inline">
                                                                            <input type="radio" name="rbi-sex_gender" class="rbi-sex_gender" value="Female" id="inlineCssRadio2" />
                                                                            <label for="inlineCssRadio2" value="Female">Female</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end form-group -->
                                                                <!-- begin form-group -->
                                                                <div class="form-group row m-b-10">
                                                                    <label class="col-md-3 col-form-label text-md-right">Date of Birth <span class="text-danger">*</span></label>
                                                                    <div class="col-md-6">
                                                                        <input type="date" id="rbi-dateofbirth" name="rbi-dateofbirth" placeholder="" class="form-control rbi-dateofbirth"  />

                                                                    </div>

                                                                </div>
                                                                <div class="form-group row m-b-10">
                                                                <label class="col-md-3 col-form-label text-md-right">Age</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" id="rbi-age"  name="rbi-age" class="form-control rbi-age" style="background-color: white; font-size: 15px; color: black" readonly />

                                                                </div>
                                                            </div>
                                                            <!-- end form-group -->
                                                            <!-- begin form-group -->
                                                            <div class="form-group row m-b-10">
                                                                <label class="col-md-3 col-form-label text-md-right">Place of Birth <span class="text-danger">*</span></label>
                                                                <div class="col-md-6">
                                                                    <input type="text" id="rbi-placeofbirth" name="rbi-placeofbirth" placeholder="Tondo Manila" class="form-control rbi-placeofbirth"
                                                                    style="text-transform: capitalize;" />
                                                                    <label id="rbi-placeofbirth-lbl" class="error" for="rbi-placeofbirth"></label>
                                                                </div>
                                                            </div>
                                                            <!-- end form-group -->
                                                            <div class="form-group row m-b-10">
                                                                <label class="col-md-3 col-form-label text-md-right">Citizenship<span class="text-danger">*</span></label>
                                                                <div class="col-md-6">
                                                                    <input type="text" id="rbi-Citizenship" name="rbi-Citizenship" placeholder="Filipino" class="form-control rbi-Citizenship" style="text-transform: capitalize;"/>
                                                                    <label id="rbi-Citizenship-lbl" class="error" for="rbi-Citizenship"></label>
                                                                </div>
                                                            </div>
                                                            <!-- begin form-group -->
                                                            <div class="form-group row m-b-10">
                                                                <label class="col-md-3 col-form-label text-md-right">Civil Status <span class="text-danger">*</span></label>
                                                                <div class="col-md-6">
                                                                    <select class="form-control rbi-civilstatus " data-style="btn-lime" id="rbi-civilstatus" name="rbi-civilstatus">
                                                                        <option value="Single" selected>Single</option>
                                                                        <option value="Married">Married</option>
                                                                        <option value="Separated">Separated</option>
                                                                        <option value="Widow">Widow</option>
                                                                        <option value="Divorced">Divorced</option>
                                                                        <option value="Annulled">Annulled</option>
                                                                        <option value="Unknown">Unknown</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- end form-group -->

                                                        </div>

                                                        <div class="col-md-6">




                                                            <!-- begin form-group -->

                                                            <div class="form-group row m-b-10 showoccu"  id="showoccu">
                                                                <label class="col-md-3 col-form-label text-md-right">Occupation<span class="text-danger">*</span></label>
                                                                <div class="col-md-6">
                                                                    <input type="text" id="rbi-Occupation" name="rbi-Occupation" placeholder="Indicate None if so" class="form-control rbi-Occupation" style="text-transform: capitalize;" required />
                                                                    <label id="rbi-Occupation-lbl" class="error" for="rbi-Occupation"></label>
                                                                </div>
                                                            </div>
                                                            <!-- end form-group -->
                                                            <!-- begin form-group -->


                                                            <!-- end form-group -->
                                                            <!-- begin form-group -->
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


                                                              <!-- begin form-group -->
                                                            <div class="form-group row m-b-10">
                                                                <label class="col-md-3 col-form-label text-md-right">Housing Ownership<span class="text-danger">*</span></label>
                                                                <div class="col-md-6">
                                                                    <select class="form-control rbi-homeownership"  target="1"  data-style="btn-lime" id="rbi-homeownership" name="rbi-homeownership">
                                                                        <option value="Owned" selected>Owned</option>
                                                                        <option value="Amortized">Amortized</option>
                                                                        <option value="Rent-free with Owner Consent">Rent-free with Owner Consent</option>
                                                                        <option value="Rent-free without Owner Consent">Rent-free without Owner Consent</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- end form-group -->

                                                            <div class="form-group row m-b-10">
                                                                <label class="col-md-3 col-form-label text-md-right">House Numbering <span class="text-danger">*</span></label>
                                                                <div class="col-md-6">
                                                                    <input type="text" id="rbi-houseNumbering" name="rbi-houseNumbering" class="form-control rbi-houseNumbering"/>
                                                                    <label id="rbi-houseNumbering-lbl" class="error" for="rbi-houseNumbering"></label>
                                                                </div>
                                                            </div>

                                            <br>
                                            <!-- begin form-group -->
                                            <div class="form-group row m-b-10">
                                                <label class="col-md-3 col-form-label text-md-right">Address<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="rbi-houseno" id="rbi-houseno" placeholder="146" class="form-control rbi-houseno"/>
                                                    <label id="rbi-houseno-lbl" class="error" for="rbi-houseno"></label>
                                                    <input type="text" name="rbi-hstreet_no" id="rbi-hstreet_no" placeholder="Area 3 Oriole Street*" class="form-control rbi-hstreet_no" style="text-transform: capitalize;" />
                                                    <label id="rbi-hstreet_no-lbl" class="error" for="rbi-hstreet_no"></label>
                                                    <input type="text" name="rbi-hstreet" id="rbi-hstreet" placeholder="Sitio Veterans" class="form-control rbi-hstreet" style="text-transform: capitalize;"/>
                                                    <label id="rbi-hstreet-lbl" class="error" for="rbi-hstreet"></label>

                                                    <input type="text" name="rbi-blk" id="rbi-blk" placeholder="Blk\Lot\Phase" class="form-control rbi-blk" style="text-transform: capitalize;"/>
                                                    <label id="rbi-blk" class="error" for="rbi-blk"></label>
                                                </div>
                                            </div>
                                            <div class="form-group row m-b-10">
                                                <label class="col-md-3 col-form-label text-md-right">Optional<span class="text-danger"></span></label>
                                                <div class="col-md-6">

                                                    <input type="text" name="rbi-hbuilding" id="rbi-hbuilding" placeholder="Building" class="form-control rbi-hbuilding" style="text-transform: capitalize;"/>
                                                    <input type="text" name="rbi-hunitno" id="rbi-hunitno" placeholder="Unit No." class="form-control rbi-hunitno" style="text-transform: capitalize;"/>
                                                    <input type="text" name="rbi-hsubdivision" id="rbi-hsubdivision" placeholder="Subdivision" class="form-control rbi-hsubdivision" style="text-transform: capitalize;"/>
                                                </div>
                                            </div>
                                             
                                        </div>
                                        
                                    </div>
                            </fieldset>



                        </div>



                        <!-- end fieldset -->
                        <div id="step-2" style="display: none">


                            <fieldset  >


                                <div style="overflow-x:auto">
                            <table id="rbi-summary-table" class="table table-bordered" style="font-size: 15px">
                                    <tr>
                                     <th colspan="4"><center>NAME</center></th>
                                     <th colspan="3"><center>ADDRESS</center></th>
                                     <th rowspan="2">PLACE OF BIRTH</th>
                                     <th rowspan="2">DATE OF BIRTH</th>
                                     <th rowspan="2">SEX</th>
                                     <th rowspan="2">CIVIL STATUS</th>
                                     <th rowspan="2">CITIZENSHIP</th>
                                     <th rowspan="2">OCCUPATION</th>
                                     <th rowspan="2">RELATIONSHIP TO HOUSEHOLD HEAD</th>
                                    </tr>
                                    <tr id="second-row">
                                     <th>LAST </th>
                                     <th>FIRST</th>
                                     <th>MIDDLE</th>
                                     <th>QUALIFIER</th>
                                     <th>NUMBER</th>
                                     <th>STREET NAME</th>
                                     <th>NAME OF SUBD./PUROK/ZONE/SITIO</th>

                                    </tr>


                                   </table>

                                </div>






                                   <center><button type="button" class="btn btn-lg btn-lime" style="margin-right: 1100px;" id="register-rbi-btn">Register Resident</button></center>

                        </fieldset>

                        </div>

                </div>

                </div>
                </form><br><br>


                {{--<div class="text-center" >

                    <p class="m-b-2 f-s-12">Please double check the provided information. Click the proceed button to finish registration.</p><br><br>
                    <p><a id="AddBTN" href="javascript:;" class="btn btn-primary">Proceed</a></p>
                </div>--}}

                </div>
                </div>
                </div>

                <div class="tab-pane fade" id="nav-tab-2">
                        <div class="tab-pane fade active show" id="nav-tab-1">
                                <div class="panel panel-inverse">
                                <div class="panel-heading">
                                    <div class="panel-heading-btn">
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                    </div>
                                    <h4 class="panel-title">MIC Form</h4>
                                </div>
                                <div class="panel-body">
                 <form id="MicForm">
                    @csrf
                    <div id="wizard-mic">

                        <ul>
                            <li class="col-md-6 col-sm-3 col-6">
                                <a href="">
                                    <span class="number">1</span>
                                    <span class="info text-ellipsis">
                                        Personal Information
                                        <small class="text-ellipsis">Information about the resident and household information</small>
                                    </span>
                                </a>
                            </li>
                            <li class="col-md-6 col-sm-3 col-6">
                                <a href="#step-2" >
                                    <span class="number">2</span>
                                    <span class="info text-ellipsis">
                                        Summary
                                        <small class="text-ellipsis">Details about the resident's household</small>
                                    </span>
                                </a>
                            </li>

                        </ul>

                        <div id="step-1"  style="" id="nbody">

                            <!-- begin fieldset -->
                            <fieldset><br>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">First Name <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" id="firstname" name="firstname" placeholder="John" class="form-control" />
                                            </div>
                                        </div>
                                        <!-- end form-group -->
                                        <!-- begin form-group -->
                                        <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">Middle Name </label>
                                            <div class="col-md-6">
                                                <input type="text" id="middlename" name="middlename" class="form-control" />
                                            </div>
                                        </div>
                                        <!-- end form-group -->
                                        <!-- begin form-group -->
                                        <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">Last Name <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" id="lastname" name="lastname" placeholder="Smith"  class="form-control" />
                                            </div>
                                        </div>
                                        <!-- end form-group -->
                                        <!-- begin form-group -->
                                        <div class="form-group row m-b-10" >
                                            <label class="col-md-3 col-form-label text-md-right">Qualifier</label>
                                            <div class="col-md-6">
                                                <input type="text" id="qualifier" name="qualifier" class="form-control" placeholder="Jr." />
                                            </div>
                                        </div>

                                        <!-- end form-group -->
                                        <!-- begin form-group -->
                                        <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">Sex <span class="text-danger">&nbsp;</span></label>
                                            <div class="col-md-6">
                                                <div class="radio radio-css radio-inline">
                                                    <input type="radio" name="sex_gender" id="inlineCssRadio11" value="Male" checked />
                                                    <label for="inlineCssRadio11">Male</label>
                                                </div>
                                                <div class="radio radio-css radio-inline">
                                                    <input type="radio" name="sex_gender" id="inlineCssRadio22" value="Female" />
                                                    <label for="inlineCssRadio22" value="Female">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end form-group -->
                                        <!-- begin form-group -->
                                        <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">Date of Birth <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <input type="date" id="dateofbirth" name="dateofbirth" placeholder="" class="form-control "  />
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">Age</label>
                                            <div class="col-md-6">
                                                <input type="text" id="age" name="age" class="form-control" style="background-color: white;" readonly />
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">Place of Birth <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" id="placeofbirth" name="placeofbirth" placeholder="" class="form-control"/>
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">Citizenship</label>
                                            <div class="col-md-6">
                                                <input type="text" id="Citizenship" name="Citizenship" placeholder="Filipino" class="form-control" />
                                            </div>
                                        </div>

                                        <!-- begin form-group -->
                                        <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">Civil Status <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <select class="form-control " data-style="btn-lime" id="civilstatus" name="civilstatus">
                                                    <option value="Single" selected>Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Separated">Separated</option>
                                                    <option value="Widow">Widow</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Annulled">Annulled</option>
                                                    <option value="Unknown">Unknown</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- end form-group -->

                                        <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">Religion</label>
                                            <div class="col-md-6">
                                                <input type="text" id="religion" name="religion" placeholder="Catholic" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">Ethnicity</label>
                                            <div class="col-md-6">
                                                <input type="text" id="ethnicity" name="ethnicity" placeholder="" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">Educational Attainment</label>
                                            <div class="col-md-6">
                                                <select class="form-control " data-style="btn-lime" id="educationatt" name="educationatt">
                                                    <option value="No education" selected>No education</option>
                                                    <option value="Pre-school" >Pre-school</option>
                                                    <option value="Elementary level">Elementary level</option>
                                                    <option value="Elementary graduate">Elementary graduate</option>
                                                    <option value="High school level">High school level</option>
                                                    <option value="High school Graduate">High school graduate</option>
                                                    <option value="Junior HS level">Junior HS level</option>
                                                    <option value="Junior HS graduate">Junior HS graduate</option>
                                                    <option value="Senior HS level">Senior HS level</option>
                                                    <option value="Senior HS graduate">Senior HS graduate</option>
                                                    <option value="Technical/Vocation">Technical/Vocation</option>
                                                    <option value="College level">College level</option>
                                                    <option value="College graduate">College graduate</option>
                                                    <option value="Post-graduate">Post-graduate</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-10">
                                            <label class="col-md-3 col-form-label text-md-right">Enrollment Status</label>
                                            <div class="col-md-6">
                                                <select class="form-control " data-style="btn-lime" id="enrollment_status" name="enrollment_status">
                                                    <option value="Not Enrolled" selected>Not Enrolled</option>
                                                    <option value="Enrolled, public">Enrolled, public</option>
                                                    <option value="Enrolled, private">Enrolled, private</option>
                                                    <option value="Not Applicable">Not Applicable</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="showSchoolDetails" style="display: none">
                                            <div class="form-group row m-b-10">
                                                <label class="col-md-3 col-form-label text-md-right">Type of School <span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <select class="form-control " data-style="btn-lime" id="school_type" name="school_type">
                                                        <option value="Pre-school" selected>Pre-school</option>
                                                        <option value="Elementary">Elementary</option>
                                                        <option value="Junior HS">Junior HS</option>
                                                        <option value="Senior HS">Senior HS</option>
                                                        <option value="Vocational/Technical">Vocational/Technical</option>
                                                        <option value="College/University">College/University</option>
                                                        <option value="Graduate School">Graduate School</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-10">
                                                <label class="col-md-3 col-form-label text-md-right">Place of school</label>
                                                <div class="col-md-6">
                                                    <input type="text" id="pschool" name="pschool" class="form-control" />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- begin form-group -->

                                        <div class="form-group row m-b-10" style="display: none" id="mshowoccu">
                                            <label class="col-md-3 col-form-label text-md-right">Occupation</label>
                                            <div class="col-md-6">
                                                <input type="text" id="Occupation" name="Occupation" placeholder="Indicate None if so" class="form-control Occupation" />
                                            </div>
                                        </div>
                                        <!-- end form-group -->
                                        <!-- begin form-group -->
                                        <div style="display: none" id="mshowwork">
                                            <div class="form-group row m-b-10">
                                                <label class="col-md-3 col-form-label text-md-right">Monthly Income</label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="number" id="monthlyIncome" name="monthlyIncome" class="form-control" placeholder="10000.00">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row m-b-10" >
                                                <label class="col-md-3 col-form-label text-md-right">Income Status<span class="text-danger"></span></label>
                                                <div class="col-md-6" >
                                                    <select class="form-control " data-style="btn-lime" name="incomeStatus" id="workstatus">
                                                        <option value="Not Applicable" selected>Not Applicable</option>
                                                        <option value="Rich">Rich (At least ₱190,400)</option>
                                                        <option value="High">High (₱114,240 to ₱190,399)</option>
                                                        <option value="Upper middle">Uppper middle (₱66,640 to ₱114,239)</option>
                                                        <option value="Middle middle">Middle middle (₱38,080 to ₱66,639)</option>
                                                        <option value="Lower middle">Lower middle (₱19,040 to ₱38,079)</option>
                                                        <option value="Low">Low (₱9,520 to ₱19,039)</option>
                                                        <option value="Poor">Poor (Less than ₱9,520)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row m-b-10" >
                                                <label class="col-md-3 col-form-label text-md-right">Employment Status<span class="text-danger">*</span></label>
                                                <div class="col-md-6" >
                                                    <select class="form-control " data-style="btn-lime" name="employmentStatus" id="workstatus">
                                                        <option value="Not Applicable" selected>Not Applicable</option>
                                                        <option value="Employed">Employed</option>
                                                        <option value="Self-Employed">Self-Employed</option>
                                                        <option value="Unemployed">Unemployed</option>
                                                        <option value="Retired">Retired</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- end form-group -->
                                            <!-- begin form-group -->
                                           <!--  <div class="form-group row m-b-10">
                                                <label class="col-md-3 col-form-label text-md-right">Date Started Working </label>
                                                <div class="col-md-6">
                                                    <input type="date" id="dateofstartwork" name="dateofstartwork" class="form-control"  />
                                                </div>
                                            </div> -->
                                           <!--  <div class="form-group row m-b-10" >
                                                <label class="col-md-3 col-form-label text-md-right">Occupation Status<span class="text-danger"></span></label>
                                                <div class="col-md-6" >
                                                    <select class="form-control " data-style="btn-lime" name="workstatus" id="workstatus">
                                                        <option value="Regular/Permanent Employment" selected>Regular/Permanent Employee</option>
                                                        <option value="Term/Fixed Employment">Term/Fixed Employee</option>
                                                        <option value="Project Employment">Project Employee</option>
                                                        <option value="Seasonal Employment">Seasonal Employee</option>
                                                        <option value="Casual Employment">Casual Employee</option>
                                                    </select>
                                                </div>
                                            </div> -->


                                            <div class="form-group row m-b-10">
                                                <label class="col-md-3 col-form-label text-md-right">Place of work</label>
                                                <div class="col-md-6">
                                                    <input type="text" id="placeofwork" name="placeofwork" class="form-control"  />
                                                </div>
                                            </div>
                                            

                                           <!--  <div class="form-group row m-b-10">
                                                <label class="col-md-3 col-form-label text-md-right">Health Insurance</label>
                                                <div class="col-md-6">
                                                    <input type="text" id="hinsurance" name="hinsurance" class="form-control"  />
                                                </div>
                                            </div> -->
                                        </div>

                                        <!-- end form-group -->>     
                    </div>

                    <div class="col-md-6">

                        <!-- begin form-group -->
                        <!-- <div class="form-group row m-b-10">
                            <label class="col-md-3 col-form-label text-md-right">Is an OFW? <span class="text-danger">&nbsp;</span></label>
                            <div class="col-md-6">
                                <div class="radio radio-css radio-inline">
                                    <input type="radio" name="is_ofw" id="inlineCssRadioNo" value="0" checked />
                                    <label for="inlineCssRadioNo">No</label>
                                </div>
                                <div class="radio radio-css radio-inline">
                                    <input type="radio" name="is_ofw" id="inlineCssRadioYes" value="1" />
                                    <label for="inlineCssRadioYes">Yes</label>
                                </div>
                            </div>
                        </div> -->
                        <!-- end form-group -->
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 col-form-label text-md-right">Place of delivery<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <!-- <input type="text" id="pdelivery" name="pdelivery" placeholder="e.g in home , hospital" class="form-control"  /> -->
                                <select class="form-control " data-style="btn-lime" name="pdelivery" id="pdelivery">
                                    <option value="Public hospital" selected>Public hospital</option>
                                    <option value="Private hospital">Private hospital</option>
                                    <option value="Lying-in clinic">Lying-in clinic</option>
                                    <option value="Home">Home</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row m-b-10" style="display: none" id="showOtherDeliveryPlace">
                            <label class="col-md-3 col-form-label text-md-right">Other</label>
                            <div class="col-md-6">
                                <input  type="text" id="pdeliveryOther" name="pdeliveryOther" class="form-control"  placeholder="Place of delivery" />
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 col-form-label text-md-right">Birth Attendant</label>
                            <div class="col-md-6">
                                <!-- <textarea  id="battendant" name="battendant" placeholder="e.g , doctor, nurse, midwife, hilot" class="form-control"  ></textarea> -->
                                <select class="form-control " data-style="btn-lime" name="battendant" id="battendant">
                                    <option value="Doctor" selected>Doctor</option>
                                    <option value="Nurse">Nurse</option>
                                    <option value="Midwife">Midwife</option>
                                    <option value="Hilot">Hilot</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row m-b-10" style="display: none" id="showOtherAttendant">
                            <label class="col-md-3 col-form-label text-md-right">Other</label>
                            <div class="col-md-6">
                                <input  type="text" id="battendantOther" name="battendantOther" class="form-control"  placeholder="Birth Attendant" />
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 col-form-label text-md-right">Immunization/Last received vaccine</label>
                            <div class="col-md-6">
                                <input type="text" id="bimmunization" name="bimmunization" class="form-control"
                                placeholder="Last received vaccine" />
                            </div>
                        </div>

                        <div class="form-group row m-b-10">
                            <label class="col-md-3 col-form-label text-md-right">Health Facility Visited for the last 6 months</label>
                            <div class="col-md-6">
                                <!-- <textarea id="fvisited" name="fvisited" class="form-control"
                                placeholder="e.g government hospital, rhu/health center, brgy health station, private hospital, private clinic" ></textarea> -->
                                <select class="form-control " data-style="btn-lime" name="fvisited" id="fvisited">
                                    <option value="None" selected>None</option>
                                    <option value="Government hospital" >Government hospital</option>
                                    <option value="Health Center">Health Center</option>
                                    <option value="Brgy. Health Station">Brgy. Health Station</option>
                                    <option value="Private Hospital">Private Hospital</option>
                                    <option value="Private Clinic">Private Clinic</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row m-b-10" style="display: none" id="showReasonForVisit">
                            <label class="col-md-3 col-form-label text-md-right">Reason for Visit</label>
                            <div class="col-md-6">
                            <!-- <textarea id="rvisit" name="rvisit" class="form-control"
                            placeholder="e.g injured, prenatal/posnatal, gave birth, dental, medicine checkup,
                            medical requirment, NHTS/CCT/4P's private clinic" ></textarea> -->
                            <select class="form-control " data-style="btn-lime" name="rvisit" id="rvisit">
                                <option value="Not applicable" selected>Not applicable</option>
                                <option value="Injured" >Injured</option>
                                <option value="Prenatal/Postnatal">Prenatal/Postnatal</option>
                                <option value="Gave birth">Gave birth</option>
                                <option value="Dental">Dental</option>
                                <option value="Medicine checkup">Medicine checkup</option>
                                <option value="Medical requirement">Medical requirement</option>
                                <option value="NHTS/CCT/4P's private clinic">NHTS/CCT/4P's private clinic</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 col-form-label text-md-right">Disability</label>
                            <div class="col-md-6">
                                <!-- <input type="text" id="disability" name="disability" placeholder="" class="form-control"/> -->
                                <select class="form-control " data-style="btn-lime" name="disability" id="disability">
                                <option value="None" selected>None</option>
                                <option value="Sensory Disability" >Sensory Disability</option>
                                <option value="Physical Disability">Physical Disability</option>
                                <option value="Mental Disability">Mental Disability</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row m-b-10" style="display: none" id="showSoloParent">
                            <label class="col-md-3 col-form-label text-md-right">Solo Parent</label>
                            <div class="col-md-6">
                                <select class="form-control " data-style="btn-lime" name="soloParent" id="soloParent">
                                <option value="Not applicable" selected>Not applicable</option>
                                <option value="Registered solo parent" >Registered solo parent</option>
                                <option value="Unregistered solo parent">Unregistered solo parent</option>
                                <option value="Non-solo parent">Non-solo parent</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row m-b-10" style="display: none" id="showSeniorCitizen">
                            <label class="col-md-3 col-form-label text-md-right">Is Registered Senior Citizen? <span class="text-danger">&nbsp;</span></label>
                            <div class="col-md-6">
                                <div class="radio radio-css radio-inline">
                                    <input type="radio" name="isRegisteredSeniorCitizen" id="unregisteredSeniorCitizen" value="0" checked />
                                    <label for="unregisteredSeniorCitizen">No</label>
                                </div>
                                <div class="radio radio-css radio-inline">
                                    <input type="radio" name="isRegisteredSeniorCitizen" id="registeredSeniorCitizen" value="1" />
                                    <label for="registeredSeniorCitizen">Yes</label>
                                </div>
                            </div>
                        </div>
                        <!-- begin form-group -->
                        <div class="form-group row m-b-10" style="display: none;" id="showRegisteredVoter">
                            <label class="col-md-3 col-form-label text-md-right">Is Registered Voter? <span class="text-danger">&nbsp;</span></label>
                            <div class="col-md-6">
                                <div class="radio radio-css radio-inline">
                                    <input type="radio" class="is_registered_voter" name="is_registered_voter" id="inlineRegisteredVoterNo" value="0" checked />
                                    <label for="inlineRegisteredVoterNo">No</label>
                                </div>
                                <div class="radio radio-css radio-inline">
                                    <input type="radio" class="is_registered_voter" name="is_registered_voter" id="inlineRegisteredVoterYes" value="1" />
                                    <label for="inlineRegisteredVoterYes">Yes</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row m-b-10" style="display: none" id="showVotingPrecinct">
                            <label class="col-md-3 col-form-label text-md-right">Voting Precinct</label>
                            <div class="col-md-6">
                                <input type="text" id="votingPrecinct" name="votingPrecinct" class="form-control"
                                placeholder="Voting Precinct" />
                            </div>
                        </div>
                        <!-- end form-group -->
                        
                        <!-- begin form-group -->
                     <!--    <div class="form-group row m-b-10" style="display: none">
                            <label classs="col-md-3 col-form-label text-md-right">Relationship to Household Head<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="text" id="RelationToHead" name="RelationToHead" placeholder="Indicate Household Head if so" class="form-control"/>
                            </div>
                        </div> -->
                        <!-- end form-group -->
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 col-form-label text-md-right">Previous Residence for the last 6 months</label>
                            <div class="col-md-6">
                                <input type="text" id="previousResidence" name="previousResidence" class="form-control"
                                placeholder="Previous Residence" />
                            </div>
                        </div>
                        <!-- begin form-group -->
                        <!-- <div class="form-group row m-b-10">
                            <label class="col-md-3 col-form-label text-md-right">Date of Arrival to Barangay <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="date" id="dateofarrival" name="dateofarrival" placeholder="" class="form-control"/>
                            </div>
                        </div> -->
                        <!-- end form-group -->
                        <!-- begin form-group -->
                        <div class="form-group row m-b-10">
                            <label class="col-md-3 col-form-label text-md-right">Type of resident<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                             <select class="form-control " data-style="btn-lime" name="ArrivalReason" id="ArrivalReason">
                                @foreach($resident_type as $key => $value)
                                <option id="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="display: none" id="showmigrants">
                        <div class="form-group row m-b-10" >
                            <label class="col-md-3 col-form-label text-md-right">Migrants<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                             <select class="form-control " data-style="btn-lime" name="migrants" id="migrants">

                                <option value="Country">From Other Country</option>
                                <option value="Barangay">From Other Barangay</option>
                                <option value="Province">From Other Province</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row m-b-10">
                        <label class="col-md-3 col-form-label text-md-right"><span class="text-danger"></span></label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" id="fromwhat" name="fromwhat" placeholder=""/>
                        </div>
                    </div>
                    <div class="form-group row m-b-10" >
                    <label class="col-md-3 col-form-label text-md-right">Reason for Coming<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <!-- <textarea type="text" id="r_coming" name="r_coming" placeholder="" class="form-control"></textarea> -->
                        <select class="form-control " data-style="btn-lime" id="mr_coming" name="mr_coming">
                            <option value="Lack of employment" selectoed>Lack of employment</option>
                            <option value="Perception of better income in other place">Perception of better income</option>
                            <option value="Schooling">Schooling</option>
                            <option value="Presence of relatives and friends">Presence of relatives and friends</option>
                            <option value="Employment/Job relocation">Employment/Job relocation</option>
                            <option value="Disaster-related relocation">Disaster-related relocation</option>
                            <option value="Retirement">Retirement</option>
                            <option value="To live with parents">To live with parents</option>
                            <option value="To live with children">To live with children</option>
                            <option value="Marriage">Marriage</option>
                            <option value="Annulment/Divorce/Separation">Annulment/Divorce/Separation</option>
                            <option value="Commuting-related reasons">Commuting-related reasons</option>
                            <option value="Health-related reasons">Health-related reasons</option>
                            <option value="Peace and security">Peace and security</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row m-b-10" style="display: none" id="showmOtherReasonForComing">
                    <label class="col-md-3 col-form-label text-md-right">Other</label>
                    <div class="col-md-6">
                        <input type="text" id="motherReason" name="motherReason" placeholder="Reason for Coming" class="form-control"/>
                    </div>
                </div>
                    <div hidden>
                    <div class="form-group row m-b-10">
                        <label class="col-md-3 col-form-label text-md-right">Valid Community Tax Certificate<span class="text-danger"></span></label>
                        <div class="col-md-6">
                            <input type="text" id="mdocument" name="mdocument" placeholder="" class="form-control"/>
                        </div>
                    </div>
                    <!-- <div class="form-group row m-b-10">
                        <label class="col-md-3 col-form-label text-md-right">When ctc is issued<span class="text-danger"></span></label>
                        <div class="col-md-6">
                            <input type="date" id="mwhenissued" name="mwhenissued" placeholder="" class="form-control"/>
                        </div>
                    </div> -->
                    <div class="form-group row m-b-10">
                        <label class="col-md-3 col-form-label text-md-right">Place of CTC issuance <span class="text-danger"></span></label>
                        <div class="col-md-6">
                            <input type="text" id="mwhereissued" name="mwhereissued" placeholder="" class="form-control"/>
                        </div>
                    </div>
                    </div>
                </div>

                <div id="div_transient" style="display: none">
                <div class="form-group row m-b-10">
                    <label class="col-md-3 col-form-label text-md-right">Date Arrived in Barangay</label>
                    <div class="col-md-6">
                        <input type="month" id="p_startdate" name="p_startdate" placeholder="" class="form-control"/>
                    </div>
                </div>
                <div class="form-group row m-b-10">
                    <label class="col-md-3 col-form-label text-md-right">Length of Stay in Barangay</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="lengthOfStay" name="lengthOfStay" style="background-color: white;" readonly />
                    </div>
                </div>
                <div class="form-group row m-b-10" >
                    <label class="col-md-3 col-form-label text-md-right">Reason for Coming<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <!-- <textarea type="text" id="r_coming" name="r_coming" placeholder="" class="form-control"></textarea> -->
                        <select class="form-control " data-style="btn-lime" id="r_coming" name="r_coming">
                            <option value="Lack of employment" selectoed>Lack of employment</option>
                            <option value="Perception of better income in other place">Perception of better income</option>
                            <option value="Schooling">Schooling</option>
                            <option value="Presence of relatives and friends">Presence of relatives and friends</option>
                            <option value="Employment/Job relocation">Employment/Job relocation</option>
                            <option value="Disaster-related relocation">Disaster-related relocation</option>
                            <option value="Retirement">Retirement</option>
                            <option value="To live with parents">To live with parents</option>
                            <option value="To live with children">To live with children</option>
                            <option value="Marriage">Marriage</option>
                            <option value="Annulment/Divorce/Separation">Annulment/Divorce/Separation</option>
                            <option value="Commuting-related reasons">Commuting-related reasons</option>
                            <option value="Health-related reasons">Health-related reasons</option>
                            <option value="Peace and security">Peace and security</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row m-b-10" style="display: none" id="showOtherReasonForComing">
                    <label class="col-md-3 col-form-label text-md-right">Other</label>
                    <div class="col-md-6">
                        <input type="text" id="otherReason" name="otherReason" placeholder="Reason for Coming" class="form-control"/>
                    </div>
                </div>
                <div class="form-group row m-b-10">
                    <label class="col-md-3 col-form-label text-md-right">Date Departed in Barangay</label>
                    <div class="col-md-6">
                        <input type="date" id="p_enddate" name="p_enddate" placeholder="" class="form-control"/>
                    </div>
                </div>
                <div class="form-group row m-b-10">
                    <label class="col-md-3 col-form-label text-md-right">Valid Community Tax Certificate</label>
                    <div class="col-md-6">
                        <input type="text" id="tdocument" name="tdocument" placeholder="" class="form-control"/>
                    </div>
                </div>
                <!-- <div class="form-group row m-b-10">
                    <label class="col-md-3 col-form-label text-md-right">When ctc is issued<span class="text-danger"></span></label>
                    <div class="col-md-6">
                        <input type="date" id="tissued" name="tissued" placeholder="" class="form-control"/>
                    </div>
                </div> -->
                <div class="form-group row m-b-10">
                    <label class="col-md-3 col-form-label text-md-right">Place of CTC issuance </label>
                    <div class="col-md-6">
                        <input type="text" id="issued" name="tissued" placeholder="" class="form-control"/>
                    </div>
                </div>
            </div>

            <!-- end form-group -->
            <!-- begin form-group -->
            <!-- <div class="form-group row m-b-10">
                <label class="col-md-3 col-form-label text-md-right">Is Indigenous? <span class="text-danger">&nbsp;</span></label>
                <div class="col-md-6">
                    <div class="radio radio-css radio-inline">
                        <input type="radio" name="radio_Indigenous" id="inlineCssRadioIndigeneousNo" value="0" checked />
                        <label for="inlineCssRadioIndigeneousNo">No</label>
                    </div>
                    <div class="radio radio-css radio-inline">
                        <input type="radio" name="radio_Indigenous" id="inlineCssRadioIndigeneousYes" value="1" />
                        <label for="inlineCssRadioIndigeneousYes">Yes</label>
                    </div>
                </div>
            </div> -->
            <!-- end form-group -->
            <!-- begin form-group -->
            <div class="form-group row m-b-10">
                <label class="col-md-3 col-form-label text-md-right">Contact Number </label>
                <div class="col-md-6">
                    <input type="number" id="contactnumber" name="contactnumber" placeholder="" class="form-control" />
                </div>
            </div>

            <div class="form-group row m-b-10">
                <label class="col-md-3 col-form-label text-md-right">Resident Status<span class="text-danger">*</span></label>
                <div class="col-md-6">
                 <select class="form-control " data-style="btn-lime" name="mfn" id="mfn">
                    <option value="Not a parent">Not a parent</option>
                    <option value="Father">Father</option>
                    <option value="Mother">Mother</option>


                </select>
            </div>
        </div>


        <div class="form-group row m-b-10" >
            <label class="col-md-3 col-form-label text-md-right">Skills Develoment Training</label>
            <div class="col-md-6">
                <textarea type="text" id="sdtraining" name="sdtraining" placeholder="" class="form-control"></textarea>
            </div>
        </div>


    </div>


</div>
<div style="display: block;" id="childrendiv">
    <div class="alert alert-danger fade show">List of household members</div>



    <div class="row" style="padding: 10px; ">

        <table id="prodvartable" class="table table-bordered display compact table-hover" style="overflow: auto" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="text-align: center"></th>
                    <th style="text-align: center"></th>
                    <th style="text-align: center"></th>

                    <th style="text-align: left;"><a id="addVar" class="btn btn-success"><i class="fa fa-plus text-white"></i></a></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <th style="text-align: center"></th>
                <th style="text-align: center"></th>
                <th style="text-align: center"></th>

                <th style="text-align: center"></th>

            </tfoot>
        </table>
    </div>


</div><br><br>
<div class="alert alert-yellow fade show">Housing information</div>

<div class="row">

    <div class="col-md-6">

        <!-- begin form-group -->
        <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Lot Ownership</label>
            <div class="col-md-6">
                <select class="form-control " data-style="btn-lime" id="lotownership" name="lotownership">
                    <option value="Owned" selectoed>Owned</option>
                    <option value="Amortized">Amortized</option>
                    <option value="Rent-free with Owner Consent">Rent-free with Owner Consent</option>
                    <option value="Rent-free without Owner Consent">Rent-free without Owner Consent</option>>
                </select>
            </div>
        </div>

        <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Housing Ownership<span class="text-danger">*</span></label>
            <div class="col-md-6">
                <select class="form-control " data-style="btn-lime" id="homeownership" name="HomeOwnership">
                    <option value="Owned" selectoed>Owned</option>
                    <option value="Amortized">Amortized</option>
                    <option value="Rent-free with Owner Consent">Rent-free with Owner Consent</option>
                    <option value="Rent-free without Owner Consent">Rent-free without Owner Consent</option>
                </select>
            </div>
        </div>

        <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">House Numbering <span class="text-danger">*</span></label>
            <div class="col-md-6">
                <input type="text" id="rhouseNumbering" name="houseNumbering" class="form-control"/>
            </div>
        </div>


        <!-- begin form-group -->
        <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Build Materials</label>
            <div class="col-md-6">
                <div class="radio radio-css">
                    <input type="radio" name="radio_home_materials" id="cssRadioConcrete" value="Concrete" checked />
                    <label for="cssRadioConcrete">Concrete</label>
                </div>
                <div class="radio radio-css">
                    <input type="radio" name="radio_home_materials" id="cssRadioWood" value="Wood" />
                    <label for="cssRadioWood">Wood</label>
                </div>
                <div class="radio radio-css">
                    <input type="radio" name="radio_home_materials" id="cssRadioNipa" value="Nipa" />
                    <label for="cssRadioNipa">Nipa</label>
                </div>
                <div class="radio radio-css">
                    <input type="radio" name="radio_home_materials" id="cssRadio1Makeshift" value="Make-shift" />
                    <label for="cssRadio1Makeshift">Make-shift</label>
                </div>
            </div>
        </div>


        <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Number of Rooms <span class="text-danger">*</span></label>
            <div class="col-md-6">
                <input type="number" id="numberofrooms" value="1"  name="numberofrooms" placeholder="" class="form-control"/>
            </div>
        </div>
        <!-- end form-group -->
        <br>
        <!-- begin form-group -->
        <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Address<span class="text-danger">*</span></label>
            <div class="col-md-6">
                <input type="number" name="houseno" id="houseno" placeholder="House Unit*" class="form-control"/>
                <input type="text" name="hstreet" id="hstreet" placeholder="Street*" class="form-control"  />
                <input type="text" name="hphase" id="hphase" placeholder="Sitio*" class="form-control" />


            </div>
        </div>
        <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Optional<span class="text-danger"></span></label>
            <div class="col-md-6">

                <input type="text" name="hbuilding" id="hbuilding" placeholder="Building" class="form-control"/>
                <input type="text" name="hunitno" id="hunitno" placeholder="Unit No." class="form-control"/>
                <input type="text" name="hsubdivision" id="hsubdivision" placeholder="Subdivision" class="form-control"/>
            </div>
        </div>
        <br>
        <!-- begin form-group -->
        <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Nature of the house</label>
            <div class="col-md-6">
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckbox1Toilet" name="withtoilet" value="0" />
                    <label for="cssCheckbox1Toilet">With Toilet</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckbox2Playarea" name="withplayarea" value="0"  />
                    <label for="cssCheckbox2Playarea">With Play Area</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckbox3Bedroom" value="0" name="withbedroom"/>
                    <label for="cssCheckbox3Bedroom">With Bedroom</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckbox4diningroom" value="0" name="withdiningroom" />
                    <label for="cssCheckbox4diningroom">Wih Dining Room</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckbox5sala" value="0" name="withsala" />
                    <label for="cssCheckbox5sala">With Sala</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckbox6kitchen" value="0" name="kitchen" />
                    <label for="cssCheckbox6kitchen">With Kitchen</label>
                </div>
            </div>
        </div>
        <!-- end form-group -->
    </div>
    <!-- end form-group -->


    <div class="col-md-6">
        <!-- begin form-group -->
        <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Utilities Available</label>
            <div class="col-md-6">
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxRunningwater" name="runningwater" value="0" />
                    <label for="cssCheckboxRunningwater">Running Water</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxElectricity" name="electricity" value="0"  />
                    <label for="cssCheckboxElectricity">Electricity</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxaircon" value="0" name="aircon"/>
                    <label for="cssCheckboxaircon">Aircon</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxmobilephone" value="0" name="mobilephone" />
                    <label for="cssCheckboxmobilephone">Mobile Phone</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxcomputer" value="0" name="computer" />
                    <label for="cssCheckboxcomputer">Computer</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxinternet" value="0" name="internet" />
                    <label for="cssCheckboxinternet">Internet</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxtv" value="0" name="tv" />
                    <label for="cssCheckboxtv">Television</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxcdplayer" value="0" name="cdplayer" />
                    <label for="cssCheckboxcdplayer">CD/DVD Player</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxradio" value="0" name="Radio" />
                    <label for="cssCheckboxradio">Radio</label>
                </div>
            </div>
        </div>
        <!-- end form-group -->

        <!-- begin form-group -->
        <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Entertainment Available</label>
            <div class="col-md-6">
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxcomics" name="comics" value="0" />
                    <label for="cssCheckboxcomics">Comics/Magazines</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxNewspaper" name="newspapers" value="0"  />
                    <label for="cssCheckboxNewspaper">Newspapers</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxPets" value="0" name="pets"/>
                    <label for="cssCheckboxPets">Pets</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxbooks" value="0" name="books" />
                    <label for="cssCheckboxbooks">Books</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxstorybooks" value="0" name="storybooks" />
                    <label for="cssCheckboxstorybooks">Story Books</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxToys" value="0" name="toys" />
                    <label for="cssCheckboxToys">Toys</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxboardgames" value="0" name="boardgames" />
                    <label for="cssCheckboxboardgames">Board Games</label>
                </div>
                <div class="checkbox checkbox-css">
                    <input type="checkbox" id="cssCheckboxpuzzles" value="0" name="puzzles" />
                    <label for="cssCheckboxpuzzles">Puzzles</label>
                </div>
            </div>
        </div>
        <!-- end form-group -->

        <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Total Number of Household Members<span class="text-danger">*</span></label>
            <div class="col-md-6">
                <input type="number" id="personinhousehold"  name="personinhousehold" placeholder="Total Number of Household Members" class="form-control"/>
                <!-- <select class="form-control " data-style="btn-lime" id="personinhousehold" name="personinhousehold">
                    <option value="Parents" selected>Parents</option>
                    <option value="Relatives">Relatives</option>
                    <option value="Non-Relatives">Non-Relatives</option>
                </select> -->
            </div>
        </div>
    </div>
</div>

<!-- end fieldset -->
{{--<div class="text-center" >

    <p class="m-b-2 f-s-12">Please double check the provided information. Click the proceed button to finish registration.</p><br><br>
    <p><a id="AddBTN" href="javascript:;" class="btn btn-primary">Proceed</a></p>
</div>--}}

</fieldset>

</div>


</div>


<!-- end wizard -->


<!-- end form-group -->

</form>
<div id="step-3" style="display: none">




  <table id="summary_tabl" class="table table-bordered" style="font-size: 15px">
    <tbody></tbody>
</table>

<table id="summary_utility" class="table table-bordered" style="font-size: 15px">
    <tbody></tbody>
</table>
<table id="summary_housing" class="table table-bordered" style="font-size: 15px">
    <tbody></tbody>
</table>



<table id="summary_entertainment" class="table table-bordered" style="font-size: 15px">
    <tbody></tbody>
</table>


<button class="btn btn-lg btn-lime" style="margin-right: 1100px;" id="register-btn">Register Resident</button>




</div><br><br>


                {{--<div class="text-center" >

                    <p class="m-b-2 f-s-12">Please double check the provided information. Click the proceed button to finish registration.</p><br><br>
                    <p><a id="AddBTN" href="javascript:;" class="btn btn-primary">Proceed</a></p>
                </div>--}}

                </div>
                </div>
                </div>
                </div>

         </div>

<!-- end tab-content -->

</div>
</div>
</div>
<!-- end content -->
@endsection
