
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

(function() {
    'use strict';

    // Disable warning "Synchronous XMLHttpRequest on the main thread is deprecated.."
    // $.ajaxPrefilter(function(options) {
    //     options.async = true;
    // });

    // used for the preloader
    $(function() { document.body.style.opacity = 1; });

})();
