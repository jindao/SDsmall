<?php
/**
 * Created by PhpStorm.
 * User: DREAM
 * Date: 12/12/2020
 * Time: 9:27 AM
 */
?>

              <!-- begin:: Content -->
              <script src="<?=base_url()?>assets/js/form-controls.js" type="text/javascript"></script>
              <script src="<?=base_url()?>assets/js/bootstrap-select.js" type="text/javascript"></script>
              <div class = "kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
                <div class="row">
                  <div class="col-md-3"></div>
                  <form class="col-md-6 kt-form" id="accountinfoForm" method = "POST" action = "<?=base_url()?>user/submitaccountinfo">
                    <div class="kt-container">
                      <div class="form-group row mt-5 mb-5">
                        <i class="flaticon-avatar text-normal ft-4"></i>
                        <span class="ft-6 text-green">&nbspACCOUNT INFORMATION</span>
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

                      <div class="form-group row">
                        <label class="form-control-label">* Country</label>
                        <select class="form-control kt-select2" id = "country_id" name="country">
                          <option value = -1> --Select Country-- </option>
                          <?php 
                            foreach($countrys as $country){
                              echo "<option value = '".$country["id"]."'".(($country["id"]."" == $user["country_id"]."")?" selected ":" ")."> ".$country["name"]." </option>";
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-6 form-group-sub pl-0">
                          <label class="form-control-label">* First Name</label>
                          <input class="form-control" type="text" name="firstname" value = "<?php echo $user["first_name"];?>">
                        </div>
                        <div class="col-lg-6 form-group-sub pr-0">
                          <label class="form-control-label">* Last Name</label>
                          <input class="form-control" type="text" name="lastname" value = "<?php echo $user["last_name"];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="form-control-label">* Contact Email</label>
                        <input class="form-control" type="email" name="contactemail" value = "<?php echo $user["email"];?>">
                      </div>
                      <div class="form-group row">
                        <label class="form-control-label">Company Name</label>
                        <input class="form-control" type="text" name="companyname" value = "<?php echo $user["company_name"];?>">
                      </div>
                      <div class="form-group row">
                        <label class="form-control-label">VAT number</label>
                        <input class="form-control" type="text" name="vatnumber" value = "<?php echo $user["VAT_number"];?>">
                      </div>
                      <div class="form-group row">
                        <label class="form-control-label">Address</label>
                        <input class="form-control" type="text" name="address" value = "<?php echo $user["address"];?>">
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-6 form-group-sub pl-0">
                          <label class="form-control-label">Town/City</label>
                          <input class="form-control" type="text" name="towncity" value = "<?php echo $user["town_city"];?>">
                        </div>
                        <div class="col-lg-6 form-group-sub pr-0">
                          <label class="form-control-label">Zip Code</label>
                          <input class="form-control" type="text" name="zipcode"  value = "<?php echo $user["zip_code"];?>">
                        </div>
                      </div>
                      <div class="form-group row mt-5 kt-form__actions">
                        <button type="submit" class="btn btn-lg btn-form">Save</button>
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
      $('#country_id').select2({
            placeholder: "Please select one"
        });
    }
    
    var initValidation = function () {
        validator =   $( "#accountinfoForm" ).validate({
            // define validation rules
            rules: {

              country:{ required: true},
              firstname:{ required: true},
              lastname:{ required: true},
                 
              contactemail: {
                  required:true,
                  email:true
                },
               
            },
           
            //display error alert on form submit  
            invalidHandler: function(event, validator) {             
                
            },

            submitHandler: function (form) {
              $( "#accountinfoForm" ).get(0).submit(); // submit the form
              
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
