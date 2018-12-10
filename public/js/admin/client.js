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
/******/ 	return __webpack_require__(__webpack_require__.s = 38);
/******/ })
/************************************************************************/
/******/ ({

/***/ 38:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(39);


/***/ }),

/***/ 39:
/***/ (function(module, exports) {

(function () {
    'use strict';

    $(createClient);
    $(editClient);

    $.validator.addMethod('regex', function (value, element) {
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
            submitHandler: function submitHandler(form) {
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
            submitHandler: function submitHandler(form) {
                $('#admin-client-create-submit-button').html('Saving...').attr('disabled', 'disabled');
                form.submit();
            }
        });
    }

    // Necessary to place dyncamic error messages
    // without breaking the expected markup for custom input
    function errorPlacementInput(error, element) {
        if (element.is(':radio') || element.is(':checkbox') || element.attr('name') == 'slug') {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
        error.addClass('text-sm text-danger');
    }
})();

/***/ })

/******/ });