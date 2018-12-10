(function() {
    'use strict';

    $(createClient);
    $(editClient);

    $.validator.addMethod('regex', function(value, element){
        return this.optional(element) || /^[a-zA-Z0-9]*$/i.test(value);
    }, 'Please enter one word, letters and numbers only.');

    function createClient() {

        if (!$.fn.validate) return;

        var $form = $('#admin-client-create');
        $form.validate({
            errorPlacement: errorPlacementInput,
            // Form rules
            rules: {
                slug: {
                    required: true,
                    regex: true
                },
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
            },
            submitHandler: function(form) {
                $('#admin-client-create-submit-button').html('Saving...').attr('disabled', 'disabled');
                form.submit();
            }
        });
    }
    function editClient() {

        if (!$.fn.validate) return;

        var $form = $('#admin-client-edit');
        $form.validate({
            errorPlacement: errorPlacementInput,
            // Form rules
            rules: {
                slug: {
                    required: true,
                    regex: "^[a-zA-Z0-9]*$"
                },
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
            },
            submitHandler: function(form) {
                $('#admin-client-create-submit-button').html('Saving...').attr('disabled', 'disabled');
                form.submit();
            }
        });
    }

    // Necessary to place dyncamic error messages
    // without breaking the expected markup for custom input
    function errorPlacementInput(error, element) {
        if ( element.is(':radio') || element.is(':checkbox') || element.attr('name') == 'slug') {
            error.insertAfter(element.parent());
        }else {
            error.insertAfter(element);
        }
        error.addClass('text-sm text-danger');
    }

})();
