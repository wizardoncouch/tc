!function(e){var t={};function r(n){if(t[n])return t[n].exports;var i=t[n]={i:n,l:!1,exports:{}};return e[n].call(i.exports,i,i.exports,r),i.l=!0,i.exports}r.m=e,r.c=t,r.d=function(e,t,n){r.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:n})},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="/",r(r.s=44)}({44:function(e,t,r){e.exports=r(45)},45:function(e,t){!function(){"use strict";function e(e,t){t.is(":radio")||t.is(":checkbox")?e.insertAfter(t.parent()):e.insertAfter(t)}$(function(){if(!$.fn.validate)return;$("#user-register").validate({errorPlacement:e,rules:{name:{required:!0},email:{required:!0,email:!0}},submitHandler:function(e){$("#submit-button").html("Sending Request...").attr("disabled","disabled"),e.submit()}})})}()}});