/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.scss in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('bootstrap');
require('select2');
// require('tinymce/tinymce.min');

$(document).ready(function() {

    /*
    tinymce.init({
        selector: 'textarea'
    });
    */

    $('select').select2();

    $('[data-toggle="tooltip"]').tooltip();

});


