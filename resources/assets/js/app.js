window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

$(document).ready(function() {
  $('#myButton').on('click', function () {
    var $btn = $(this).button('loading')
    // business logic...
    $btn.button('reset')
  })
});
