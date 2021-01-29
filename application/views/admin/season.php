<?php
?>

<link href="<?=base_url()?>assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-portlet__head kt-portlet__head--lg">
  <div class="kt-portlet__head-label">
    <span class="kt-portlet__head-icon">
      <i class="kt-font-success flaticon2-line-chart"></i>
    </span>
    <h3 class="kt-portlet__head-title dayHead textBold">
      SEASON TABLE
    </h3>
  </div>
  <div class="kt-portlet__head-toolbar">
    <div class="kt-portlet__head-wrapper">
      <div class="kt-portlet__head-actions">

          <button class="btn btn-add btn-md" id = "addSeason">
            <i class="la la-plus"></i>
            New SEASON
          </button>

      </div>
    </div>
  </div>
</div>
<!--begin: Datatable -->

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

<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
    <div class="row align-items-center">
      <div class="col-xl-8 order-2 order-xl-1">
        <div class="row align-items-center">
          <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
            <div class="kt-input-icon kt-input-icon--left">
              <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
              <span class="kt-input-icon__icon kt-input-icon__icon--left">
                <span><i class="la la-search"></i></span>
              </span>
            </div>
          </div>
          <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
            
          </div>
          <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
            
          </div>
        </div>
      </div>
      
    </div>
  </div>

<div class = "kt-container mt-4">
  <table class="table table-striped  table-hover table-checkable" id="seasonTable">
    <thead>

    </thead>
  </table>
</div>
<!--end: Datatable -->


<div class="modal fade" id="seasonModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg mainBg">
    <div class="modal-content mainBg">
      <form id = "formCreateSeason" action="<?=base_url()?>admin/season/create" method = "post">
        <div class="modal-header dayHead">
          <label id = "modalHead" class = "col-form-label textBold textSize16">Add Season:</label>
        </div>
        <div class="modal-body" >

          <!-- <header class="row">
            <div class="form-group row" style = "padding-left : 20px">
              <label class="col-form-label dayHead">Defunct:</label>
              <div class="col-4">
                  <span class="kt-switch kt-switch--outline  kt-switch--brand">
                    <label >
                      <input type="checkbox" checked="checked" name="defunct">
                      <span></span>
                    </label>
                  </span>
              </div>
            </div>

          </header> -->

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Season Name:</label>
            <div class="col-lg-6 col-md-9 col-sm-12 input-group">
              <input type="text" class="form-control"  name="season_name" id="season_name">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Season Link:</label>
            <div class="col-lg-6 col-md-9 col-sm-12 input-group">
              <input type="text" class="form-control"  name="season_link" id="season_link">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">League:</label>
            <div class="col-lg-6 col-md-9 col-sm-12 input-group">
              <select class="form-control kt-select2" id="league_id" name="league_id">
                <option></option>
                <?php
                  foreach($leagues as $league){
                    echo "<option value = ".$league["id"]." > ".$league["name"]." </option>";
                  }
                ?>
              </select>
            </div>
          </div>

          </div>

          <div class="row" style = "padding-bottom:15px;">
            <div class="col-md-6 text-right">
              <input type="reset" value = "Reset" class="btn btn-secondary">
            </div>
            <div class="col-md-6 text-left">
              <input type="submit" value = "Confirm" class="btn btn-success">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end:: Content -->
<script>
  var base_url = "<?php echo base_url();?>";
</script>
<script src="<?=base_url()?>assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/admin/season.js" type="text/javascript"></script>

