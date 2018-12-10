/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
/******/ })
/************************************************************************/
/******/ ({

/***/ 48:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(49);


/***/ }),

/***/ 49:
/***/ (function(module, exports) {

(function () {
    'use strict';

    $(getRoles);
    $(createUser);
    $(updateUser);
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
            submitHandler: function submitHandler(form) {
                $('#admin-user-create-submit-button').html('Saving...').attr('disabled', 'disabled');
                form.submit();
            }
        });
    }

    function updateUser() {

        if (!$.fn.validate) return;

        var $form = $('#admin-user-edit');
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
            submitHandler: function submitHandler(form) {
                $('#admin-user-edit-submit-button').html('Saving...').attr('disabled', 'disabled');
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
            submitHandler: function submitHandler(form) {
                $('#admin-user-approve-submit-button').html('Saving...').attr('disabled', 'disabled');
                form.submit();
            }
        });
    }

    // Necessary to place dyncamic error messages
    // without breaking the expected markup for custom input
    function errorPlacementInput(error, element) {

        if (element.is(':radio') || element.is(':checkbox')) {
            error.insertAfter(element.parent());
        } else if (element.attr('id') == 'roles') {
            element.parent().find('span.select2').find('.select2-selection').addClass('border border-danger');
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
        error.addClass('text-sm text-danger');
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

/***/ })

/******/ });