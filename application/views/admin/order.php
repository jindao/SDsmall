<?php
?>

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
      <i class="kt-font-success flaticon2-line-chart"></i>
    </span>
    <h3 class="kt-portlet__head-title dayHead textBold">
      Orders
    </h3>
  </div>
  <div class="kt-portlet__head-toolbar">
    <div class="kt-portlet__head-wrapper">
      <div class="kt-portlet__head-actions">

      </div>
    </div>
  </div>
</div>

<!--begin: Datatable -->
<div class = "kt-container mt-4">
  <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
    <thead>
      <tr>
        <th class = "dayHead">Username</th>
        <th class = "dayHead">Product</th>
        <th class = "dayHead">Paid</th>
        <th class = "dayHead">Payment</th>
        <th class = "dayHead">Status</th>
        <th class = "dayHead">Confirmed</th>
        <th class = "dayHead">DateTime</th>
        
      </tr>
    </thead>
  <tbody>
  </tbody>
</table>
</div>
<!--end: Datatable -->

<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?=base_url()?>assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/admin/order.js" type="text/javascript"></script>

