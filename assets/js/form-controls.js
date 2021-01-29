// Class definition

var KTFormControls = function () {
    // Private functions

    var demo1 = function () {
        $( "#loginForm" ).validate({
            // define validation rules
            rules: {
                username: {
                    required: true,
                    // email: true,
                    minlength: 2
                },
                password: {
                    required: true,
                    minlength:  3
                }
            },

            errorPlacement: function(error, element) {
                var group = element.closest('.input-group');
                if (group.length) {
                    group.after(error.addClass('invalid-feedback'));
                } else {
                    element.after(error.addClass('invalid-feedback'));
                }
            },

            //display error alert on form submit
            invalidHandler: function(event, validator) {
                var alert = $('#kt_form_1_msg');
                alert.removeClass('kt--hide').show();
                KTUtil.scrollTop();
            },

            submitHandler: function (form) {
                //form[0].submit(); // submit the form
                form.submit();
            }
        });

        $( "#signUpForm" ).validate({
            // define validation rules
            rules: {
                username: {
                    required: true,
                    // email: true,
                    minlength: 4
                },
                password: {
                    required: true,
                    minlength:  3
                },
                email: {
                    required: true,
                    // email: true,
                    minlength: 3
                },
                repeatPassword: {
                    required: true,
                    minlength:  3
                },
                checkbox: {
                    required: true
                },
            },

            errorPlacement: function(error, element) {
                var group = element.closest('.input-group');
                if (group.length) {
                    group.after(error.addClass('invalid-feedback'));
                } else {
                    element.after(error.addClass('invalid-feedback'));
                }
            },

            //display error alert on form submit
            invalidHandler: function(event, validator) {
                var alert = $('#kt_form_1_msg');
                alert.removeClass('kt--hide').show();
                KTUtil.scrollTop();
            },

            submitHandler: function (form) {
                //form[0].submit(); // submit the form
                form.submit();
            }
        });
    }


    return {
        // public functions
        init: function() {
            demo1();
        }
    };
}();

jQuery(document).ready(function() {
    KTFormControls.init();
});