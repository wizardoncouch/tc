(function() {
    'use strict';

    $(getRoles);
    $(createUser);
    $(approveUser);

    function getRoles() {
        if (!$.fn.select2) return;
        $('#roles').select2();
    }

    function createUser() {

        if (!$.fn.validate) return;

        var $form = $('#admin-user-create');
        $form.validate({
            errorPlacement: errorPlacementInput,
            // Form rules
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                roles: {
                    required: true
                }
            },
            submitHandler: function(form) {
                $('#admin-user-create-submit-button').html('Saving...').attr('disabled', 'disabled');
                form.submit();
            }
        });
    }
    function approveUser() {

        if (!$.fn.validate) return;

        var $form = $('#admin-user-approve');
        $form.validate({
            errorPlacement: errorPlacementInput,
            // Form rules
            rules: {
                roles: {
                    required: true
                }
            },
            submitHandler: function(form) {
                $('#admin-user-approve-submit-button').html('Saving...').attr('disabled', 'disabled');
                form.submit();
            }
        });
    }

    // Necessary to place dyncamic error messages
    // without breaking the expected markup for custom input
    function errorPlacementInput(error, element) {
        console.log(element);
        if ( element.is(':radio') || element.is(':checkbox')) {
            error.insertAfter(element.parent());
        }else if(element.hasClass('select2-hidden-accessible')){
            error.insertAfter(element.parent().find('.select2'));
        }else {
            error.insertAfter(element);
        }
    }

        //for future use
        /*select2({
            tags: true,
            createTag: function (params) {
                var term = $.trim(params.term);
                var count = 0
                var existsVar = false;
                //check if there is any option already
                if($('#keywords option').length > 0){
                    $('#keywords option').each(function(){
                        if ($(this).text().toUpperCase() == term.toUpperCase()) {
                            existsVar = true
                            return false;
                        }else{
                            existsVar = false
                        }
                    });
                    if(existsVar){
                        return null;
                    }
                    return {
                        id: params.term,
                        text: params.term,
                        newTag: true
                    }
                }
                //since select has 0 options, add new without comparing
                else{
                    return {
                        id: params.term,
                        text: params.term,
                        newTag: true
                    }
                }
            },
            maximumInputLength: 20, // only allow terms up to 20 characters long
            closeOnSelect: true
        })*/

})();