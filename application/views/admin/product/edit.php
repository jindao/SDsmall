
<link href="<?=base_url()?>assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

<?php if($this->session->flashdata('alert_message')) {?>
<div class="alert alert-info fade show" role="alert">
  <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
  <div class="alert-text"><?php echo $this->session->flashdata('alert_message');?></div>
  <div class="alert-close">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true"><i class="la la-close"></i></span>
    </button>
  </div>
</div>
<?php } ?>

<div class="kt-portlet__head kt-portlet__head--lg">
  <div class="kt-portlet__head-label">
    <span class="kt-portlet__head-icon">
      <i class="kt-font-success flaticon2-plus-1"></i>
    </span>
    <h3 class="kt-portlet__head-title dayHead textBold">
      Edit Product
    </h3>
  </div>
</div>

<!--begin: Datatable -->
<div class = "kt-container mt-4">
  <!--begin::Form-->
  <form class="kt-form kt-form--fit kt-form--label-right" method = "POST" action = "<?=base_url()?>admin/product/edit" id = "frmProductCreate">
    
    <div class="kt-alert m-alert--icon alert alert-danger kt-hidden" role="alert" id="kt_form_1_msg" style="display: block;">
      <div class="kt-alert__icon">
        <i class="la la-warning"></i>
      </div>
      <div class="kt-alert__text">
        Oh snap! Change a few things up and try submitting again.
      </div>
      <div class="kt-alert__close">
        <button type="button" class="close" data-close="alert" aria-label="Close">
        </button>
      </div>
    </div>

    <div class="kt-portlet__body">
      <input type = "hidden" name = "product_id" value = "<?php echo $product["id"];?>">
      <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Sport:</label>
        <div class=" col-lg-4 col-md-9 col-sm-12">
          <select class="form-control kt-select2" id="category_id" name="category_id">
            <option></option>
            <?php
              foreach($sports as $sport){
                echo "<option value = ".$sport["id"]." > ".$sport["name"]." </option>";
              }
            ?>
          </select>
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Competition</label>
        <div class=" col-lg-4 col-md-9 col-sm-12">
          <select class="form-control kt-select2" id="league_id" name="league_id">
            <option></option>
          </select>
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Location:</label>
        <div class=" col-lg-4 col-md-9 col-sm-12">
          <select class="form-control kt-select2" id="country_id" name="country_id">
              <option></option>
              <option value = "-1">No Selected</option>
            <?php
              foreach($countrys as $country){
                echo "<option value = ".$country["id"]."  data-name = '".$country["link"]."'> ".$country["name"]." </option>";
              }
            ?>
          </select>
          
        </div>
      </div>
      <input type = "hidden" name = "country_id1" id = "country_id1" value = "" >
      <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Season:</label>
        <div class=" col-lg-4 col-md-9 col-sm-12">
          <select class="form-control kt-select2" id="season_id" name="season_id">
              <option></option>
            
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12"></label>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <input class="form-control" type="number" value="" placeholder = "From" id="season_from" name = "season_from">
        </div> &nbsp;
        <div class="col-lg-2 col-md-4 col-sm-6">
          <input class="form-control" type="number" value="" placeholder = "To"  id="season_to" name = "season_to">
        </div>
      </div>
     
      <div class="form-group row">
        <label for="example-number-input" class=" col-lg-3 col-sm-12 col-form-label">Summary Columns:</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
          <input class="form-control" type="number" value="15" value = "<?php echo $product["summary_columns"];?>" id="summary_columns" name="summary_columns">
        </div>
      </div>

      <div class="form-group row">
        <label for="example-number-input" class=" col-lg-3 col-sm-12 col-form-label">Detail Columns:</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
          <input class="form-control" type="number" value="60" value = "<?php echo $product["detail_columns"];?>" id="detail_columns" name="detail_columns">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Last Updated:</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
          <div class="input-group">
            <input type="text" class="form-control" id = "last_updated" value = "<?php echo $product["last_update"];?>"  name="last_updated" value = "<?php echo $last_update;?>" placeholder="" aria-describedby="kt_datepicker-error" aria-invalid="false">
            <div class="input-group-append">
              <span class="input-group-text">
                <i class="la la-calendar-check-o"></i>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-lg-3 col-form-label">Price:</label>
        <div class="col-lg-4 col-md-9 col-sm-12 input-group">
          <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">$</span></div>
          <input type="number" class="form-control" value = "<?php echo $product["price"];?>" placeholder="0.99" name = "price" id = "price">
        </div>
      </div>
        
      <div class="kt-portlet__foot">
        <div class="kt-form__actions">
          <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-4 col-md-9 col-sm-12">
              <button type="submit" id = "btnCreateProduct" class="btn btn-success">Submit</button>
              <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </from>
</div>
<!--end: Datatable -->
<script type="text/javascript">

  var base_url = "<?php echo base_url(); ?>";
  var category_id = "<?php echo $product["category_id"]; ?>";
  var league_id = "<?php echo $product["league_id"]; ?>";
  var season_id = "<?php echo $product["season_link"]; ?>";
  var country_id = "<?php echo $product["country_id"]; ?>";
  var season_from = "<?php echo $product["season_from"]; ?>";
  var season_to = "<?php echo $product["season_to"]; ?>";

</script>
<script src="<?=base_url()?>assets/js/admin/productedit.js" type="text/javascript"></script>


