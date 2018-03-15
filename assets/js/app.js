// assets/js/app.js
require('../css/app.scss');
require('datatables.net-bs');

var $ = require('jquery');
window.$ = $;
window.jQuery = $;

// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap-sass');

$(document).ready(function() {
    $('.dataTables-basic').DataTable({
        responsive: true,
        "scrollY":        "50vh",
        "scrollCollapse": true,
        "paging":         false
    });
});


// ...rest of JavaScript code here

