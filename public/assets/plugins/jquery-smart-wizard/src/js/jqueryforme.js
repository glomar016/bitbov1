/*! 
 * SmartWizard v4.2.2
 * The awesome jQuery step wizard plugin with Bootstrap support
 * http://www.techlaboratory.net/smartwizard
 *
 * Created by Dipu Raj
 * http://dipuraj.me
 *
 * Licensed under the terms of the MIT License
 * https://github.com/techlab/SmartWizard/blob/master/LICENSE
 */

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
                var registrationForm = $('#AddForm');

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
                          nowhitespace: true,
                          lettersonly: true
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
                      nowhitespace: 'No white space allowed',
                      lettersonly: 'letters only'
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

              if($('#AddForm').valid()) {

                alert('valid')
                 // end main household
                 if(mi.steps.index(this) !== mi.current_index) {

                //     $(".sw-btn-next").attr("disabled", true);
                // $('#step-2').show();
                // window.location.href = '#step-2';
               
                $("input[name=multifname]").each(function() {
                    fnames.push($(this).val())
                });
                $("input[name=multimname]").each(function() {
                    mnames.push($(this).val())
                });
                $("input[name=multilname]").each(function() {
                    lnames.push($(this).val())
                });
                $("input[name=multidoba]").each(function() {
                    dobs.push($(this).val())
                });

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
                 if (days[i] >= 29) {
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
            console.log(age)


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

        var ncolors = []; var icolors = []; var ccolors = []; var acolors = []; var ecolors = [];
        for (var i=0; i<dobs.length; i++ ) {

            n[i]=="Yes"?ncolors[i]="#ddefc9":ncolors[i]="#ffcdcc";
            i[i]=="Yes"?icolors[i]="#ddefc9":icolors[i]="#ffcdcc";
            c[i]=="Yes"?ccolors[i]="#ddefc9":ccolors[i]="#ffcdcc";
            a[i]=="Yes"?acolors[i]="#ddefc9":acolors[i]="#ffcdcc";
            e[i]=="Yes"?ecolors[i]="#ddefc9":ecolors[i]="#ffcdcc";

            $('#summary_tabl').closest('table').find('tbody').append(
                '<tr>\n'
                
                +'<td colspan="1" style="font-weight:bold" id="multimembers" name="multimembers">'
                +j++ +'.    '+fnames[i] +' '+mnames[i]+' '+lnames[i]
                +'</td> \n'
                +'<td id="smryrelation"></td>\n'
                +'<td id="smrynewborn" style="background-color:'+ncolors[i]+'">'+n[i]+'</td>\n'
                +'<td id="smryinfant" style="background-color:'+icolors[i]+'">'+inf[i]+'</td>\n'
                +'<td id="smrychild" style="background-color:'+ccolors[i]+'">'+c[i]+'</td>\n'
                +'<td id="smryadolescent" style="background-color:'+acolors[i]+'">'+a[i]+'</td>\n'
                +'<td id="smryelderly" style="background-color:'+ecolors[i]+'">'+e[i]+'</td>\n'


                ); 


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
            +'<td style="font-weight: bold">TOTAL: '+dobs.length+'</td>\n'
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
                    mi._showNext();
                }

}
else{
    alert('not valid')
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
