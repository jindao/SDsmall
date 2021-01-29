<?php
/**
 * Created by PhpStorm.
 * User: DREAM
 * Date: 12/14/2020
 * Time: 8:41 AM
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
                        <i class="flaticon-delete text-normal ft-4"></i>
                        <span class="ft-6 text-green">&nbspDELETE ACCOUNT</span>
                      </div>
                      <div class = "form-group row">
                        <span class="ft-2 text-normal">We are sad that you want to leave us...<br>
                        Can you tell us more about experience?</span>
                      </div>
                      <div class="form-group row">
                          <label class="form-control-label">* Leave your comment</label>
                          <textarea class="form-control" rows="3" name="comment"></textarea>
                        </div>
                      <div class="form-group row">
                        <div class="col-lg-6 form-group-sub pl-0">
                          <label class="form-control-label">* Enter your password</label>
                          <input class="form-control" type="text" name="password">
                        </div>
                        <div class="col-lg-6 form-group-sub pr-0">
                          <label class="form-control-label">* Repeate password</label>
                          <input class="form-control" type="text" name="re-password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="kt-checkbox-inline">
                          <label class="kt-checkbox kt-checkbox--bold">
                            <input type="checkbox" name="checkbox">
                              By deleting my account, I assume that all data concerning me is permanently erased.<br>
                              I will no longer be able to access my account and my downloads.<br>
                              I have saved my files locally.
                            <span></span>
                          </label>
                        </div>
                      </div>
                      <div class="form-group row mt-5 kt-form__actions">
                        <button type="submit" class="btn btn-lg btn-form">request cancellation of this account</button>
                      </div>
                    </div>
                  </form>
                  <div class = "col-md-3"></div>
                </div>
              </div>
              <!-- end:: Content -->
