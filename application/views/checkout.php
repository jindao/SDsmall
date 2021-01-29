              <style>

                  .nav-pills .nav-item .nav-link.active:hover  {
                      background-color: #009245;
                      color: #ffffff;
                  }
                  .nav-pills .nav-item .nav-link.active {
                      background-color: #009245;
                      color: #ffffff;
                  }
                  .nav-pills .nav-item .nav-link.active .btn:hover {
                      color: #ffffff;
                  }
                  .nav-pills .nav-item .nav-link.active .btn {
                      color: #ffffff;
                  }
              </style>
              <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
              <!-- begin:: Content -->
              <script src="<?=base_url()?>assets/js/form-controls.js" type="text/javascript"></script>
              <div class = "kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
                    <div class="kt-container row">
                      <div class="col-md-3 p-5">
                        <!-- begin:: Mycart -->
                        <div class="kt-mycart checkout ml-3 mr-3">
                          <div class="kt-mycart__head">
                            <div class="kt-mycart__info">
                              <span class="kt-mycart__title">Order Summary</span>
                            </div>
                          </div>
                          <div id = "checkout_cart_body" class="kt-mycart__body kt-scroll" data-scroll="true" data-height="auto" data-mobile-height="200">
                            <div class="kt-mycart__section">
                              <?php 
                              $shoppingcart = new ShoppingCart();
                              $cartItems = $shoppingcart->getCartItems()["array"];
                               if(is_array($cartItems))
                                foreach($cartItems as $item){
                                    echo '<div class="kt-mycart__item alert alert-secondary alert-dismissible p-2 m-2">
                                    <span>'.$item["season_name"].'</span>
                                    <button type="button" class="close p-2 m-0" data-dismiss="alert" onclick="removeShoppingCartItem(\''.$item["id"].'\')">&times;</button>
                                  </div>';
                                }
                               ?> 
                  
                            </div>
                            <div class="kt-mycart__section m-2 mt-3 mb-5">
                              <div class = "form-group row">
                                <span class="kt-mycart__subtitle pl-4"><?php if(is_array($cartItems)) echo count($cartItems); else echo "0";?> items in cart</span>
                              </div>
                              <div class="form-group row">
                                <label class="col-6 col-form-label pl-4 ft-1">Cupon Code</label>
                                <div class="col-6">
                                  <input class="form-control" type="text" name="cuponcode" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <button type="button" onclick = "manageShoppingCart('' , '' );" class="btn update-cart p-0 text-normal">Update cart<i class="flaticon-refresh"></i></button>
                              </div>
                            </div>
                            <div class="kt-mycart__section p-2 ml-2 ">
                              <div class="kt-mycart__price  pl-2">
                                <span class="kt-mycart__subtitle text-normal ft-1">Subtotal:</span>
                                <span class="ml-3 float-right text-normal ft-1">$ <?php echo $shoppingcart->getCartItems()["finalSum"];?></span>

                              </div>
                              <div class="kt-mycart__price  pl-2">
                                <span class="kt-mycart__subtitle text-normal ft-1">Taxation:</span>
                                <span class="kt-mycart__price float-right ml-3 text-normal ft-1">$ 0.00</span>
                              </div>
                              <hr class = "dashed-hr text-normal">
                              <div class="kt-mycart__price  pl-2">
                                <span class="kt-mycart__subtitle text-green ft-6">Order Total:</span>
                                <span class="kt-mycart_price float-right ml-3 text-green ft-6">$ <?php echo $shoppingcart->getCartItems()["finalSum"];?></span>
                              </div>
                            </div>
                          </div>

                        </div>
                        <!-- end:: Mycart -->
                      </div>

                      <div class="col-md-9 p-5">

                      <div class="form-group row">
                          <span class="ft-6 text-green">Billing Information</span>
                        </div>
                        <div class="form-group row">
                          <span class="ft-1 text-normal">Choose a payment option below and fill out the appropriate information.</span>
                        </div>

                    <div class="kt-portlet">
										

                    <?php if($this->session->flashdata('checkoutError')) {?>
                      <div class="alert alert-info fade show" role="alert">
                        <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                        <div class="alert-text"><?php echo $this->session->flashdata('checkoutError');?></div>
                        <div class="alert-close">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="la la-close"></i></span>
                          </button>
                        </div>
                      </div>
                      <?php } ?>

										<div class="kt-portlet__body">
											<ul class="nav nav-pills nav-fill" role="tablist">
												<li class="nav-item " style = "flex:none!important;">
													<a class="nav-link active" data-toggle="tab" href="#kt_tabs_5_1" style = "padding:0px;">
                          <button class = "btn btn-form mr-4" id = "creditcard" >
                            <i class="fa fa-credit-card"></i>Credit card
                          </button>
                          </a>
												</li>
												<li class="nav-item" style = "flex:none!important;">
													<a class="nav-link" data-toggle="tab" href="#kt_tabs_5_2" style = "padding:0px;">
                          <button class = "btn btn-form mr-4" id = "paypal">
                            <i class="fab fa-paypal"></i>
                            PayPal
                          </button>
                          </a>
												</li>
											
											</ul>
											<div class="tab-content">
												<div class="tab-pane active" id="kt_tabs_5_1" role="tabpanel">
                      <form action="javascript:return;" method="POST" id = "checkoutStripeForm" name = "checkoutStripeForm">
                        <div class="row">
                        
                          <div class="col-lg-6">
                            <div class="form-group row pl-2 pr-5">
                              <span class="ft-6 text-green">1. Billing Address</span>
                            </div>
                            <div class="form-group row pl-2 pr-5">
                              <div class="col-lg-6 form-group-sub pl-0" >
                                <label class="form-control-label">FIRST NAME</label>
                                <input class="form-control" type="text" name="firstname" >
                              </div>
                              <div class="col-lg-6 form-group-sub pl-0" >
                                <label class="form-control-label">LAST NAME</label>
                                <input class="form-control" type="text" name="lastname" >
                              </div>
                            </div>
                            <div class="form-group row pl-2 pr-5">
                              <label class="form-control-label">EMAIL ADDRESS</label>
                              <input class="form-control" type="email" name="email" >
                            </div>
                            <div class="form-group row pl-2 pr-5">
                              <label class="form-control-label">BILLING ADDRESS</label>
                              <input class="form-control" type="text" name="billingaddress" >
                            </div>
                            <div class="form-group row pl-2 pr-5">
                              <label class="form-control-label">CITY</label>
                              <input class="form-control" type="text" name="city" >
                            </div>
                            <div class="form-group row pl-2 pr-5">
                              <div class="col-lg-6 form-group-sub pl-0">
                                <label class="form-control-label">COUNTRY</label>
                                <input class="form-control" type="text" name="country">
                              </div>
                              <div class="col-lg-6 form-group-sub pr-0">
                                <label class="form-control-label">ZIPCODE</label>
                                <input class="form-control" type="text" name="zipcode">
                              </div>
                            </div>
                            <!-- <div class="form-group row pl-2 pr-5">
                              <div class="kt-checkbox-inline">
                                <label class="kt-checkbox kt-checkbox--bold">
                                  <input type="checkbox" name="checkbox"> create new account
                                  <span></span>
                                </label>
                              </div>
                            </div>
                            <div class="form-group row pl-2 pr-5">
                              <div class="col-lg-6 form-group-sub pl-0">
                                <label class="form-control-label">NEW PASSWORD</label>
                                <input class="form-control" type="text" name="password">
                              </div>
                              <div class="col-lg-6 form-group-sub pr-0">
                                <label class="form-control-label">REPEAT PASSWORD</label>
                                <input class="form-control" type="text" name="re-password">
                              </div>
                            </div> -->
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group row pl-5 pr-2">
                              <span class="ft-6 text-green">2. Credit Card Information</span>
                            </div>
                            <div class="form-group row pl-5 pr-2">
                              <label class="form-control-label">NAME ON CARD</label>
                              <input class="form-control" type="text" name="nameoncard" >
                            </div>
                            <div class="form-group row pl-5 pr-2">
                              <label class="form-control-label">CARD NUMBER</label>
                              <input class="form-control" type="text" name="cardnumber" >
                            </div>
                            <div class="form-group row pl-5 pr-2">
                              <div class="col-lg-4 form-group-sub pl-0">
                                <label class="form-control-label">CCV NUMBER</label>
                                <input class="form-control" type="text" name="ccvnumber">
                              </div>
                              <div class="col-lg-4 form-group-sub pr-0">
                                <label class="form-control-label">EXP MONTH</label>
                                <input class="form-control" type="text" name="expmonth">
                              </div>
                              <div class="col-lg-4 form-group-sub pr-0">
                                <label class="form-control-label">EXP YEAR</label>
                                <input class="form-control" type="text" name="expyear">
                              </div>
                            </div>
                            <div class="form-group row pl-5 pr-2">
                              <div class="kt-checkbox-inline">
                                <label class="kt-checkbox kt-checkbox--bold">
                                  <input type="checkbox" name="termcheck">I have read and accept the terms & conditions
                                  <span></span>
                                </label>
                              </div>
                            </div>

                            <div class="form-group row pl-5 pr-2">
                              <div class="kt-checkbox-inline">
                                <label class="kt-checkbox kt-checkbox--bold">
                                  <input type="checkbox" name="agreecheck">I understand and agree that since my file(s) will be downloadable 
immediately after payment, no refund will be possible. 
                                  <span></span>
                                </label>
                              </div>
                            </div>

                            <div id="loader" style = "display:none;">
                                <img alt="loader"  style = " margin-left:15px;width: 45px; vertical-align: middle;" src="<?php echo base_url();?>assets/media/LoaderIcon.gif">
                              </div>

                              <div id ="stripeCheckoutError" style = "display:none;" class="alert alert-outline-danger fade show" role="alert">
                                <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                                <div id = "stripeCheckoutErrorMessage" class="alert-text">A simple danger alert—check it out!</div>
                                <div class="alert-close">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                  </button>
                                </div>
                              </div>


                            <div  class="form-group row pl-5 pr-2 kt-align-center">
                              <button type="submit" id = "btnCheckoutStripeSubmit" class="btn btn-lg btn-form">Pay Now</button>
                              <span><i></i><span>
                            </div>
                            
                          </div>	
                         
                        </div>
                        </form>
                        </div>
												<div class="tab-pane" id="kt_tabs_5_2" role="tabpanel">
                        <form action="javascript:return;" method="POST" target="blank" id = "checkoutPaypalForm" name = "checkoutPaypalForm">

                        <div class="row">
                          <div class="col-lg-6">
                            <!-- <div class="form-group row pl-2 pr-5">
                              <span class="ft-6 text-green">1. Billing Address</span>
                            </div> -->
                            <div class="form-group row pl-2 pr-5">
                              <div class="col-lg-6 form-group-sub pl-0" >
                                <label class="form-control-label">FIRST NAME</label>
                                <input class="form-control" type="text" name="firstname" >
                              </div>
                              <div class="col-lg-6 form-group-sub pl-0" >
                                <label class="form-control-label">LAST NAME</label>
                                <input class="form-control" type="text" name="lastname" >
                              </div>
                            </div>
                            <div class="form-group row pl-2 pr-5">
                              <label class="form-control-label">EMAIL ADDRESS</label>
                              <input class="form-control" type="email" name="email" >
                            </div>
                            <div class="form-group row pl-2 pr-5">
                              <label class="form-control-label">BILLING ADDRESS</label>
                              <input class="form-control" type="text" name="billingaddress" >
                            </div>

                            
                          </div>
                          <div class="col-lg-6">
                            <!-- <div class="form-group row pl-5 pr-2">
                              <span class="ft-6 text-green">2. Credit Card Information</span>
                            </div> -->
                            
                            <div class="form-group row pl-5 pr-2">
                              <div class="kt-checkbox-inline">
                                <label class="kt-checkbox kt-checkbox--bold">
                                  <input type="checkbox" name="termcheck">I have read and accept the terms & conditions
                                  <span></span>
                                </label>
                              </div>
                            </div>

                            <div class="form-group row pl-5 pr-2">
                              <div class="kt-checkbox-inline">
                                <label class="kt-checkbox kt-checkbox--bold">
                                  <input type="checkbox" name="agreecheck">I understand and agree that since my file(s) will be downloadable 
immediately after payment, no refund will be possible. 
                                  <span></span>
                                </label>
                              </div>
                            </div>
                            <div class="form-group row pl-5 pr-2 kt-align-center">
                              <button type="submit" class="btn btn-lg btn-form">Pay Now</button>
                              <span><i></i><span>
                            </div>
                            <input type='hidden' name='payment_method' value='paypal' />
                          </div>												
                        </div>
                        </form>
												</div>
											</div>
										</div>
									</div>
                        <!-- <div class="form-group row">
                          <button class = "btn btn-form mr-4" id = "creditcard">
                            <i class="fa fa-credit-card"></i>Credit card
                          </button>
                          <button class = "btn btn-form mr-4" id = "paypal">
                            <i class="fab fa-paypal"></i>
                            PayPal
                          </button>
                        </div> -->

                      </div>
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
        validator = $( "#checkoutStripeForm" ).validate({
            // define validation rules
            rules: {
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true
                },
                email: {
                    required: true,
                    email:true,
                },
                billingaddress: {
                    required: true
                },

                city: {
                    required: true,
                },
                
                country: {
                    required: true
                },
                zipcode: {
                    required: true
                },
                nameoncard: {
                    required: true
                },
                cardnumber: {
                    required: true
                },
                ccvnumber: {
                    required: true
                },
                expmonth: {
                    required: true
                },
                expyear: {
                    required: true
                },
            },
            
            //display error alert on form submit  
            invalidHandler: function(event, validator) {             
                
            },

            submitHandler: function (form) {
                //form[0].submit(); // submit the form
                $("#btnCheckoutStripeSubmit").hide();
                $("#loader").show();
                // createToken returns immediately - the supplied callback submits the form if there are no errors
                Stripe.card.createToken({
                        number: $('#checkoutStripeForm input[name=cardnumber]').val(),
                        cvc: $('#checkoutStripeForm input[name=ccvnumber]').val(),
                        exp_month: $('#checkoutStripeForm input[name=expmonth]').val(),
                        exp_year: $('#checkoutStripeForm input[name=expyear]').val(),
                        name: $('#checkoutStripeForm input[name=first_name]').val() + " " + $('#checkoutStripeForm input[name=last_name]').val() ,
                        address_line1: $('#checkoutStripeForm input[name=billingaddress]').val(),
                        address_city: $('#checkoutStripeForm input[name=city]').val(),
                        address_zip: $('#checkoutStripeForm input[name=zipcode]').val(),
                      //  address_state: $('#checkoutStripeForm input[name=first_name]').val(),
                        address_country: $('#checkoutStripeForm input[name=country]').val()
                    }, stripeResponseHandler);
            }
        });     

        validatorPaypalForm = $( "#checkoutPaypalForm" ).validate({
            // define validation rules
            rules: {
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true
                },
                email: {
                    required: true,
                    email:true,
                },
                billingaddress: {
                    required: true
                },
            },
            
            //display error alert on form submit  
            invalidHandler: function(event, validator) {             
                
            },

            submitHandler: function (form) {
                //form[0].submit(); // submit the form
                $('#checkoutPaypalForm').attr('action', '<?php echo base_url();?>checkout/paypalPost');
                var form$ = $("#checkoutPaypalForm");
                form$.get(0).submit();

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

  // this identifies your website in the createToken call below
  Stripe.setPublishableKey('pk_live_9XtOkOEjDTpNZfu8FevDaMPd0077RzOAX3');

  function stripeResponseHandler(status, response) {
      if (response.error) {
          // re-enable the submit button
          $("#btnCheckoutStripeSubmit").show();
          $( "#loader" ).css("display", "none");
         
         $("#stripeCheckoutError").show();
         $("#stripeCheckoutErrorMessage").html(response.error.code);

      } else {
          var form$ = $("#checkoutStripeForm");
          // token contains id, last4, and card type
          var token = response['id'];
          // insert the token into the form so it gets submitted to the server

          $('#checkoutStripeForm').attr('action', '<?php echo base_url();?>checkout/stripePost');

          form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
          form$.append("<input type='hidden' name='payment_method' value='stripe' />");

          form$.get(0).submit();
      }
  }
</script>