

$(function () {

    var count = 0;
    var oAdminManager = {

        /**
        * First function to be called, it initialized 
        * all the requried elements 
        */

        init: function () {

            // $(".sw-btn-next").attr("disabled", true);
            this.setDOMElements();
            this.setElementEvents();

        },

        setDOMElements: function () {

            // input elements
            // input elements
            
            

            

            this.allInputs = $('input');
            this.inputFirstname = $('#rbi-firstname');
            this.inputMiddlename = $('#rbi-middlename');
            this.inputLastname = $('#rbi-lastname');
            this.inputQualifier = $('#rbi-qualifier');
            this.inputPlaceofbirth = $('#rbi-placeofbirth');
            this.inputCitizenship = $('#rbi-Citizenship');
            this.inputOccupation = $('#rbi-Occupation');
            this.inputHousenumbering = $('#rbi-houseNumbering');
            this.inputHouseno = $('#rbi-houseno');
            this.inputStreetno = $('#rbi-hstreet_no');
            this.inputStreet = $('#rbi-hstreet');
            this.inputDateofbirth = $('#rbi-dateofbirth');

            // label elements

            //button elements

            // this.loading = $('span[id=loading]');
            // this.approve = $('#a-submit');
            // this.decline = $('#d-submit');

            //this.a_btn = $('#a-btn');
            //this.d_btn = $('#d-btn');
            // counters
            

        },

        setElementEvents: function () {

            this.inputFirstname.on('input click', function () {
                oAdminManager.validateName($('#rbi-firstname'),$('#rbi-firstname-lbl'));
                oAdminManager.validateAll();
            });

            
            this.inputMiddlename.on('input click', function () {
                oAdminManager.validateName($('#rbi-middlename'),$('#rbi-middlename-lbl'));
                oAdminManager.validateAll();
            });

            this.inputLastname.on('input click', function () {
                oAdminManager.validateName($('#rbi-lastname'),$('#rbi-lastname-lbl'));
                oAdminManager.validateAll();
            });

            // this.inputQualifier.on('input click', function () {
            //     oAdminManager.validateName($('#rbi-qualifier'),$('#rbi-qualifier-lbl'));
            //     oAdminManager.validateAll();
            // });

            this.inputPlaceofbirth.on('input click', function () {
                oAdminManager.validateName($('#rbi-placeofbirth'),$('#rbi-placeofbirth-lbl'));
                oAdminManager.validateAll();
            });

            this.inputCitizenship.on('input click', function () {
                oAdminManager.validateName($('#rbi-Citizenship'),$('#rbi-Citizenship-lbl'));
                oAdminManager.validateAll();
            });

            this.inputOccupation.on('input click', function () {
                oAdminManager.validateName($('#rbi-Occupation'),$('#rbi-Occupation-lbl'));
                oAdminManager.validateAll();
            });

            this.inputHousenumbering.on('input click', function () {
                oAdminManager.validateHouseNo($('#rbi-houseNumbering'),$('#rbi-houseNumbering-lbl'));
                oAdminManager.validateAll();
            });

            this.inputHouseno.on('input click', function () {
                oAdminManager.validateHouseNo($('#rbi-houseno'),$('#rbi-houseno-lbl'));
                oAdminManager.validateAll();
            });

            this.inputStreetno.on('input click', function () {
                oAdminManager.validateAddress($('#rbi-hstreet_no'),$('#rbi-hstreet_no-lbl'));
                oAdminManager.validateAll();
            });

            this.inputStreet.on('input click', function () {
                oAdminManager.validateAddress($('#rbi-hstreet'),$('#rbi-hstreet-lbl'));
                oAdminManager.validateAll();
            });


            this.inputDateofbirth.on('input click', function () {
                oAdminManager.validateAge($('#rbi-dateofbirth'),$('#rbi-dateofbirth-lbl'));
                oAdminManager.validateAll();
            });

        },

        validateAge: function(input,label) {

        var dateofBirth = input.val();
        var inputDate = dateofBirth == '' ? '' : moment(dateofBirth).format('YYYY-MM-DD')
        var today = dateofBirth == '' ? '' : moment(new Date()).format('YYYY-MM-DD')
        var years = dateofBirth == '' ? '' : moment().diff(dateofBirth, 'years')
        var display;

        if( moment(inputDate).isSame(today) || inputDate > today  || !input.val() ) {

            oAdminManager.addDesign(label,input,'Invalid birthdate.','red');

        } else if (years == 0) {

            var days = moment().diff(dateofBirth, 'days')

            if(days != 0) {

                days == 1? display = days + " day old" : display = days + " days old";
                oAdminManager.addDesign(label,input,display,'green');
                label.addClass('is-valid').removeClass('error');
                label.css("color","green")

            } else {

                oAdminManager.addDesign(label,input,'Invalid birthdate.','red');
            }

        } else {
            
            years == 1? display = years + " year old" : display = years + " years old";
            oAdminManager.addDesign(label,input,display,'green');
            label.addClass('is-valid').removeClass('error');
            label.css("color","green")
        }
        
        },

        validateName: function (input,label) {
            let charRegex = new RegExp(/^(\w+ ?)*$/),
                validateNull = input.val().length <= 0,
                validateMin = input.val().length < 2,
                validateMax = input.val().length > 25,
                validateFormat = input.val().search(charRegex) !== 0;

                if (validateNull) {
                    
                    oAdminManager.addDesign(label,input,'This field is required.','red');
                    
                } else if (validateFormat) {
                    oAdminManager.addDesign(label,input,'Only accepts letters and spaces between characters.','red');
                } else if (validateMin) {
                    oAdminManager.addDesign(label,input,'Minumum of 2 characters.','red');
                } else if (validateMax) {
                    oAdminManager.addDesign(label,input,'Up to 25 characters only.','red');
                } else {
                    label.text('');
                    input.css("border-color","");
                }

                (label.is(':empty')) ? input.addClass('is-valid') : input.removeClass('is-valid');
                    
                

            
        },

        validateAddress: function (input,label) {
            let charRegex = new RegExp(/^[a-zA-Z0-9\s]*$/),
                validateNull = input.val().length <= 0,
                validateMin = input.val().length < 2,
                validateMax = input.val().length > 50,
                validateFormat = input.val().search(charRegex) !== 0;

                if (validateNull) {
                    oAdminManager.addDesign(label,input,'This field is required.','red');
                } else if (validateFormat) {
                    oAdminManager.addDesign(label,input,'Only accepts letters, numbers and spaces.','red');
                } else if (validateMin) {
                    oAdminManager.addDesign(label,input,'Minumum of 2 characters.','red');
                } else if (validateMax) {
                    oAdminManager.addDesign(label,input,'Up to 25 characters only.','red');
                } else {
                    label.text('');
                    input.css("border-color","");
                }

                (label.is(':empty')) ? input.addClass('is-valid') : input.removeClass('is-valid');
        },

        validateHouseNo: function (input,label) {
            let charRegex = new RegExp(/^[a-zA-Z0-9\s._-]+$/),
                validateNull = input.val().length <= 0,
                validateMin = input.val().length < 2,
                validateMax = input.val().length > 50,
                validateFormat = input.val().search(charRegex) !== 0;
                
                if (validateMax) {
                    oAdminManager.addDesign(label,input,'Up to 25 characters only.','red');
                } else {
                    label.text('');
                    input.css("border-color","");
                }

                (label.is(':empty')) ? input.addClass('is-valid') : input.removeClass('is-valid');
        },

        addDesign: function (label,input,message,color) {
            label.text(message);
            input.css("border-color",color);
            
        },

        validateAll: function () {
            
            var len = $(document).find('.is-valid').length;
            // console.log(len)
            if(len>=7) {

                 $(".sw-btn-next").attr("disabled", false);
                 
            } else {

                 $(".sw-btn-next").attr("disabled", true);
                 
            }
        },
    };

    oAdminManager.init();
});