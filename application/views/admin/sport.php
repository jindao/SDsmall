<?php
?>

<link href="<?=base_url()?>assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-portlet__head kt-portlet__head--lg">
  <div class="kt-portlet__head-label">
    <span class="kt-portlet__head-icon">
      <i class="kt-font-success flaticon2-line-chart"></i>
    </span>
    <h3 class="kt-portlet__head-title dayHead textBold">
      SPORT TABLE
    </h3>
  </div>
  <div class="kt-portlet__head-toolbar">
    <div class="kt-portlet__head-wrapper">
      <div class="kt-portlet__head-actions">
        <a href = "#" class = "kt-menu__link">
        <button class="btn btn-add btn-md" id = "addSport" onclick = "editSport();">
          <i class="la la-plus"></i>
          New Sport
        </button>
        </a>
      </div>
    </div>
  </div>
</div>
<!--begin: Datatable -->
<div class = "kt-container mt-4">
  <table class="table table-striped  table-hover table-checkable" id="kt_table_1">
  <thead>
  <tr>
    <th  class = "dayHead">ID</th>
    <th class = "dayHead">SPORT</th>
    <th class = "dayHead">LINK</th>
    <th class = "dayHead">Actions</th>
  </tr>
  </thead>
  <tbody>
  </tbody>
</table>
</div>
<!--end: Datatable -->
<script>
  var base_url = "<?php echo base_url();?>";
</script>
<script src="<?=base_url()?>assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/admin/sport.js" type="text/javascript"></script>

