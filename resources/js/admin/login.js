
	(function() {
	    'use strict';

	    $(userSignin);

	    function userSignin() {

	        if (!$.fn.validate) return;

	        var $form = $('#user-login');
	        $form.validate({
                errorClass:'error text-danger text-sm',
                validClass: 'success',
                errorPlacement: errorPlacementInput,
	            // Form rules
	            rules: {
	                email: {
	                    required: true,
	                    email: true
	                },
	                password: {
	                    required: true
	                }
	            },
	            submitHandler: function(form) {
	                $('#submit-button').html('Authenticating...').attr('disabled', 'disabled');
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
