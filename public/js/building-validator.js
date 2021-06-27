

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
            this.inputOwnerName = $('#txt_applicant_fullname');
            this.inputOwnerAddress = $('#txt_applicant_address');
            
            this.inputProjectLoc = $('#txt_project_location');

            $("#btnSubmitBuildingRegistration").attr("disabled", true);
        },

        setElementEvents: function () {

            this.inputOwnerName.on('input click', function () {
                oAdminManager.validateName($('#txt_applicant_fullname'),$('#lbl_applicant_fullname'));
                oAdminManager.validateAll();
            });

            this.inputOwnerAddress.on('input click', function () {
                oAdminManager.validateName($('#txt_applicant_address'),$('#lbl_applicant_address'));
                oAdminManager.validateAll();
            });

            this.inputProjectLoc.on('input click', function () {
                oAdminManager.validateName($('#txt_project_location'),$('#lbl_project_location'));
                oAdminManager.validateAll();
            });
            
            

        },



        validateName: function (input,label) {
            let validateNull = input.val().length <= 0;
                
                if (validateNull) {
                    
                    oAdminManager.addDesign(label,input,'This field is required.','red');
                    
                } 

                else 
                {
                    label.text('');
                    input.css("border-color","");
                }

                (label.is(':empty')) ? input.addClass('is-valid') : input.removeClass('is-valid');
                                
        },
        // else if (validateFormat) {
                //     oAdminManager.addDesign(label,input,'Only accepts letters and spaces between characters.','red');
                // } else if (validateMin) {
                //     oAdminManager.addDesign(label,input,'Minumum of 2 characters.','red');
                // } else if (validateMax) {
                //     oAdminManager.addDesign(label,input,'Up to 25 characters only.','red');
                // } 
                

        addDesign: function (label,input,message,color) {
            label.text(message);
            label.css("color",color);
            input.css("border-color",color);
            
        },

        validateAll: function () {
            
            var len = $(document).find('.is-valid').length;
            
            if(len>=3) {

                 $("#btnSubmitBuildingRegistration").attr("disabled", false);
                 
            } else {

                 $("#btnSubmitBuildingRegistration").attr("disabled", true);
                 
            }
        },
    };

    oAdminManager.init();
});