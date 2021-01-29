<?php
/**
 * Created by PhpStorm.
 * User: DREAM
 * Date: 12/12/2020
 * Time: 10:25 AM
 */
?>
<style>

.kt-datatable__pager-link--active{
  background: #009245!important;
}
</style>
              <div class = "kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
                <!-- begin:: Search Form -->
                <div class="row mt-5 mb-5">
                  <form class="col-md-12 kt-form" id="searchForm" type = "post" action = "<?=base_url()?>home">
                    <div class="kt-container search-container pt-5">
                      <div class="form-group row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4 row form-group-sub">

                           <div class="kt-input-icon kt-input-icon--left">
															<input type="text" class="form-control" placeholder="Search..." id="generalSearch" style = "padding-left: 50px;">
															<span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span class = "btn btn-search pl-2 pr-2"><i class="la la-search" style = "color:white;"></i></span>
															</span>
														</div>
                          <!--
                          <label class="col-form-label col-lg-2 kt-align-right text-green">Search</label>
                          <input class = "form-control col-lg-8 pl-2 pr-2" name = "generalSearch" id = "generalSearch" style = "text-align: left">
                          <div class="input-group-append col-lg-2">
                            <span class = "btn btn-search pl-2 pr-2">
                               <i class="la la-search" onclick="document.getElementById('searchForm').submit();"></i>
                            </span>
                          </div>
                          -->
                        </div>
                        <div class="col-lg-4"></div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-1 form-group-sub kt-align-right">
                          <label class="col-form-label">Filters</label>
                        </div>
                        <div class = "col-lg-2 form-group-sub m-0">
                          <select class = "form-control kt-select2" name = "sportSearch" id = "sportSearch">
                            <option value = "">--Sport--</option>
                            <?php
                              foreach($sports as $sport){
                                echo "<option value = ".$sport["id"]." > ".$sport["name"]." </option>";
                              }
                            ?>
                          </select>
                        </div>
                        <div class = "col-md-2 form-group-sub m-0">
                          <select class = "form-control kt-select2" name = "countrySearch" id = "countrySearch">
                            <option value = "">--Country--</option>
                            <?php
                              foreach($countrys as $country){
                                echo "<option value = ".$country["id"]."  data-name = '".$country["link"]."'> ".$country["name"]." </option>";
                              }
                            ?>
                          </select>
                        </div>
                        <div class = "col-md-2 form-group-sub m-0">
                          <select class = "form-control selectpicker" name = "competitionSearch" id = "competitionSearch">
                            <option value = "">--League--</option>
                            <?php
                              foreach($leagues as $league){
                                echo "<option value = ".$league["id"]."  data-name = '".$league["link"]."'> ".$league["name"]." </option>";
                              }
                            ?>
                        </select>
                        </div>
                        <div class = "col-md-2 form-group-sub m-0">
                          <select class = "form-control selectpicker" name = "seasonFromSearch" id = "seasonFromSearch" >
                            <option value = "">--Season From--</option>
                            <?php
                              $earliest_year = 1950;
                              $already_selected_value = "";
                              foreach (range(date('Y'), $earliest_year) as $x) {
                                  print '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
                              }
                            ?>
                          </select>
                        </div>
                        <div class = "col-md-2 form-group-sub m-0">
                          <select class = "form-control selectpicker" name = "seasonToSearch" id = "seasonToSearch">
                            <option value = "">--Season To--</option>
                            <?php
                              $earliest_year = 1950;
                              $already_selected_value = "";
                              foreach (range(date('Y'), $earliest_year) as $x) {
                                  print '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
                              }
                            ?>
                          </select>
                        </div>
                        <div class = "col-md-1 form-group-sub kt-align-left m-0" style = "display:none;">
                          <button class = "input-group-append btn btn-md btn-signup" type = "submit">Apply</button>
                        </div>                        
                      </div>
                    </div>
                  </form>
                </div>
                <!-- end:: Search Form -->
                <!-- begin:: Table -->
                <div class = " mt-5">
                  <table id="datatableLarge" class="table kt-datatable"></table>         
                </div>
                <!-- end:: Table -->
                <div class = "row mt-5 mb-5" style = "display:none;">
                  <div class="col-md-5"></div>
                  <div class="col-md-2 kt-align-center">
                    <button class = "btn btn-loadmore">Lead More...</button>
                  </div>
                  <div class="col-md-5">
                </div>
              </div>
              <div class="modal fade" id="sample_view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Sample Data</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      </button>
                    </div>
                    <div class="modal-body" style = "overflow-x: scroll;" id = "sample_view_modal_content">
                    </div>
                  </div>
                </div>
              </div>
              <script>
                var base_url = "<?php echo base_url(); ?>";
              </script>
              <script src = "<?=base_url()?>assets/js/index/home.js" type = "text/javascript"></script>
