/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

$('.singledate-picker').daterangepicker({
  locale: {format: 'DD-MM-YYYY'},
  autoclose: true,
  showDropdowns: true,
  autoApply: true,
  singleDatePicker:true
});