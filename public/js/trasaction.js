
"use strict";

$('#form-transaction').submit(function(e){
  
  e.preventDefault()
  var data = $('#form-transaction').serialize();
  $.ajax({
    url: '/transaction/create',
    data: data,
    method: "POST",
    dataType: "JSON",
    success: function(response){

    },
    error: function(error){

    }
  })

  return false

});