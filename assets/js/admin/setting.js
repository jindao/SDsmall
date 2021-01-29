"use strict";

jQuery(document).ready(function() {
    $('#last_update').datepicker({
        todayHighlight: true,
        disabled: true,
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    });
    
});