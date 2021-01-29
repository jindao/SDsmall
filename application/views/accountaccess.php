<?php
/**
 * Created by PhpStorm.
 * User: DREAM
 * Date: 12/12/2020
 * Time: 9:55 AM
 */
?>

              <!-- begin:: Content -->
              <script src="<?=base_url()?>assets/js/form-controls.js" type="text/javascript"></script>
              <div class = "kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
                <div class="row">
                  <div class="col-md-3"></div>
                  <form class="col-md-6 kt-form" id="accountaccessForm" method = "POST" action = "<?=base_url()?>user/updatepass">
                    <div class="kt-container">

                      <div class="form-group row mt-5 mb-5">
                        <i class="flaticon-lock text-normal ft-4"></i>
                        <span class="ft-6 text-green">&nbspACCOUNT ACCESS</span>
                      </div> 
                                            
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

                      <div class = "form-group row">
                        <span class="ft-2 text-normal">Your password must be at least 6 characters long, <br>
                        you can add special characters *@# to make stronger.</span>
                      </div>
                      <div class="form-group row">
                        <label class="form-control-label">* Current Password</label>
                        <input class="form-control" type="password" name="password">
                      </div>
                      <div class="form-group row">
                        <label class="form-control-label">* New Password</label>
                        <input class="form-control" type="password" name="newpassword" >
                      </div>
                      <div class="form-group row">
                        <label class="form-control-label">* Confirm Password</label>
                        <input class="form-control" type="password" name="confirmpassword" >
                      </div>
                      <div class="form-group row mt-5 kt-form__actions">
                        <button type="submit" class="btn btn-lg btn-form">Save Password</button>
                      </div>
                      <div class = "form-group row mb-5">
                        <div>
                          <div class = "mt-2 mb-2 text-normal ft-2">
                            <a href="<?=base_url()?>myaccount/deleteaccount" class="text-normal text-underline">Delete my account</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <div class = "col-md-3"></div>
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
        validator =   $( "#accountaccessForm" ).validate({
            // define validation rules
            rules: {

              password: {
                   required: true,
                },
                newpassword: {
                   minlength : 6,
                   required: true,
                },
                confirmpassword: {
                  minlength : 6,
                  required: true,
                  equalTo : '[name="newpassword"]'
                },
               
            },
           
            //display error alert on form submit  
            invalidHandler: function(event, validator) {             
                
            },

            submitHandler: function (form) {
              $( "#accountaccessForm" ).get(0).submit(); // submit the form
              
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