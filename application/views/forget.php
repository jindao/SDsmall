<?php
/**
 * Created by PhpStorm.
 * User: DREAM
 * Date: 12/9/2020
 * Time: 8:46 PM
 */
?>

              <!-- begin:: Content -->
              <script src="<?=base_url()?>assets/js/form-controls.js" type="text/javascript"></script>
              <div class = "kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
                <div class="kt-align-center m-5">
                  <span class="ft-6 text-green">PASSWORD/USERNAME RECOVERY</span>
                </div>
                <div class="row">
                  <div class="col-md-4"></div>
                  <form class="col-md-4 kt-form" id="forgetForm" method = "POST" action="<?=base_url()?>user/forget">
                    <div class="kt-container">
                      <div class="form-group row text-normal ft-2">
                        Please enter the email address you used when creating your account.
                      </div>
                      <div class="form-group row">
                        <label class="form-control-label">* Account email address</label>
                        <input class="form-control" type="text" name="email">
                      </div>
                      <div class="form-group row mt-5 kt-form__actions">
                        <button type="submit" class="btn btn-lg btn-form">Send me reset email</button>
                      </div>
                      <div class = "form-group row mb-5">
                        <div>
                          <div class = "mt-2 mb-2 text-normal ft-2">
                            * Go back to <a href="<?=base_url()?>user/login" class="text-green text-underline">Login page</a>
                          </div>
                          <div class = "mt-2 mb-2 text-normal ft-2">
                            * Don't have an account? <a href="<?=base_url()?>user/signup" class="text-green text-underline">Sign up</span></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <div class = "col-md-4"></div>
                </div>
              </div>
              <!-- end:: Content -->

              <script>

var KTFormWidgets = function () {
    // Private functions
    var validator;

    var initWidgets = function() {
        
    }
    
    var initValidation = function () {
        validator =   $( "#forgetForm" ).validate({
            // define validation rules
            rules: {
                
                email: {
                  required:true,
                  email:true
                },
               
            },
           
            //display error alert on form submit  
            invalidHandler: function(event, validator) {             
                
            },

            submitHandler: function (form) {
              $( "#forgetForm" ).get(0).submit(); // submit the form
              
            }
        });   

    }

    return {
        // public functions
        init: function() {
            initWidgets(); 
            initValidation();
        }
    };
}();

jQuery(document).ready(function() {    
    KTFormWidgets.init();
});

</script>