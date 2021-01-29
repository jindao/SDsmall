<link href="<?=base_url()?>assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-portlet__head kt-portlet__head--lg">
  <div class="kt-portlet__head-label">
    <span class="kt-portlet__head-icon">
      <i class="kt-font-success flaticon2-settings"></i>
    </span>
    <h3 class="kt-portlet__head-title dayHead textBold">
      Setting
    </h3>
  </div>
 
</div>
<!--begin: Setting Form -->
<div class = "kt-container mt-4">
  <form class="kt-form" method = "POST" action = "<?=base_url()?>admin/setting">
    <div class="kt-portlet__body">
      
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

      <div class="form-group row">
        <label>Last Updated:</label>
        <input type="text" class="form-control" id = "last_update" name = "last_update" value = "<?php echo $last_update;?>">
      </div>
      
    </div>
    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <button type="submit" class="btn btn-brand">Submit</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
      </div>
    </div>
  </form>
</div>
<!--end: Setting Form -->
<script src="<?=base_url()?>assets/js/admin/setting.js" type="text/javascript"></script>

