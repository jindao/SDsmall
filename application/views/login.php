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
                  <span class="ft-6 text-green">LOGIN TO YOUR ACCOUNT</span>
                </div>
                <div class="row">
                  <div class="col-md-4"></div>
                  <form class="col-md-4 kt-form" id="loginForm" method = "POST" action = "<?=base_url()?>user/login">
                    <div class="kt-container">

                    <?php if($this->session->flashdata('userError')) {?>
                      <div class="alert alert-info fade show" role="alert">
                        <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                        <?php if (is_array($this->session->flashdata('userError'))) {
                           foreach($this->session->flashdata('userError') as $err)
                           {
                             echo '<div class="alert-text">'.$err.'</div>';
                           }
                          } else {
                            echo '<div class="alert-text">'.$this->session->flashdata('userError').'</div>'; 
                          }
                        ?>
                        
                        <div class="alert-close">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="la la-close"></i></span>
                          </button>
                        </div>
                      </div>
                      <?php } ?>


                      <div class="form-group row pl-2 pr-5">
                        <label class="form-control-label">* Username / Email</label>
                        <input class="form-control" type="text" name="username">
                      </div>
                      <div class="form-group row pl-2 pr-5">
                        <label class="form-control-label">* Password</label>
                        <input class="form-control" type="password" name="password" >
                      </div>
                      <div class="form-group row">
                        <div class="kt-checkbox-inline">
                          <label class="kt-checkbox kt-checkbox--bold">
                            <input type="checkbox" name="rememberme"> Remember me
                            <span></span>
                          </label>
                        </div>
                      </div>
                      <div class="form-group row mt-5 kt-form__actions">
                        <button type="submit" class="btn btn-lg btn-form">Login</button>
                      </div>
                      <div class = "form-group row mb-5">
                        <div>
                          <div class = "mt-2 mb-2 text-normal ft-2">
                            * Forget <a href="<?=base_url()?>user/forget" class="text-green text-underline">Username / Password</a>
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
        validator =   $( "#loginForm" ).validate({
            // define validation rules
            rules: {
                username: {
                    required: true,
                },
               
                password: {
                    required: true
                },
            },
            
            //display error alert on form submit  
            invalidHandler: function(event, validator) {             
                
            },

            submitHandler: function (form) {
                form[0].submit(); // submit the form
              
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
