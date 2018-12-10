
	(function() {
	    'use strict';

	    $(adminUserRegister);

	    function adminUserRegister() {

	        if (!$.fn.validate) return;

	        var $form = $('#user-register');
	        $form.validate({
                errorClass:'error text-danger text-sm',
                validClass: 'success',
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
	            },
	            submitHandler: function(form) {
	                $('#submit-button').html('Sending Request...').attr('disabled', 'disabled');
	                form.submit();
	            }
	        });
	    }

	    // Necessary to place dyncamic error messages
	    // without breaking the expected markup for custom input
	    function errorPlacementInput(error, element) {
	        if ( element.is(':radio') || element.is(':checkbox')) {
	            error.insertAfter(element.parent());
	        }
	        else {
	            error.insertAfter(element);
	        }
	    }

	})();
