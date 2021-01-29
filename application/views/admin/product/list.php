<?php
/**
 * Created by PhpStorm.
 * User: DREAM
 * Date: 12/17/2020
 * Time: 2:32 PM
 */
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
      Products
    </h3>
  </div>
  <div class="kt-portlet__head-toolbar">
    <div class="kt-portlet__head-wrapper">
      <div class="kt-portlet__head-actions">
        <a href = "#" class = "kt-menu__link">
        <a class="btn btn-add btn-md" id = "addProduct" href = "<?=base_url()?>admin/product/create">
          <i class="la la-plus"></i>
          New Product
        </a>
        </a>
      </div>
    </div>
  </div>
</div>

<!--begin: Datatable -->
<div class = "kt-container mt-4">
  <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
    <thead>
      <tr>
        <th class = "dayHead">SPORT</th>
        <th class = "dayHead">COUNTRY</th>
        <th class = "dayHead">COMPETITION</th>
        <th class = "dayHead">SEASON</th>
        <th class = "dayHead">MATCH SUMMARY</th>
        <th class = "dayHead">DETAILED STATS</th>
        <th class = "dayHead">LAST UPDATE</th>
        <th class = "dayHead">PRICE</th>
        <th class = "dayHead">Actions</th>
      </tr>
    </thead>
  <tbody>
  </tbody>
</table>
</div>
<!--end: Datatable -->


<!-- Modal -->
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


<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?=base_url()?>assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/admin/product.js" type="text/javascript"></script>

