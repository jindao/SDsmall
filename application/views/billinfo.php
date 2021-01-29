<?php
/**
 * Created by PhpStorm.
 * User: DREAM
 * Date: 12/12/2020
 * Time: 10:20 AM
 */
?>

              <!-- begin:: Content -->
              <script src="<?=base_url()?>assets/js/form-controls.js" type="text/javascript"></script>
              <script src="<?=base_url()?>assets/js/bootstrap-select.js" type="text/javascript"></script>
              <div class = "kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
                <div class="row">
                  <div class="col-md-3"></div>
                  <form class="col-md-6 kt-form" id="accountinfoForm" type = "post" action = "<?=base_url()?>myaccount/accountinfo">
                    <div class="kt-container">
                      <div class="form-group row mt-5 mb-5">
                        <i class="flaticon-information text-normal ft-4"></i>
                        <span class="ft-6 text-green">&nbspBILLING INFORMATION</span>
                      </div>
                      <div class="form-group row">
                        <label class="form-control-label">* Country</label>
                        <select class="form-control kt-selectpicker" name="country">
                          <option val = "en"> England</option>
                          <option val = "ch"> China</option>
                          <option val = "fr"> France</option>
                          <option val = "de"> Detch</option>
                          <option val = "ru"> Russia</option>
                          <option val = "jp"> japan</option>
                        </select>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-6 form-group-sub pl-0">
                          <label class="form-control-label">* First Name</label>
                          <input class="form-control" type="text" name="firstname">
                        </div>
                        <div class="col-lg-6 form-group-sub pr-0">
                          <label class="form-control-label">* Last Name</label>
                          <input class="form-control" type="text" name="lastname">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="form-control-label">Company Name</label>
                        <input class="form-control" type="text" name="companyname">
                      </div>
                      <div class="form-group row">
                        <label class="form-control-label">VAT number</label>
                        <input class="form-control" type="text" name="vatnumber">
                      </div>
                      <div class="form-group row">
                        <label class="form-control-label">Address</label>
                        <input class="form-control" type="text" name="address">
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-6 form-group-sub pl-0">
                          <label class="form-control-label">Town/City</label>
                          <input class="form-control" type="text" name="towncity">
                        </div>
                        <div class="col-lg-6 form-group-sub pr-0">
                          <label class="form-control-label">Zip Code</label>
                          <input class="form-control" type="text" name="zipcode">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="kt-checkbox-inline">
                          <label class="kt-checkbox kt-checkbox--bold">
                            <input type="checkbox" name="checkbox"> Use this address as default billing address
                            <span></span>
                          </label>
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
