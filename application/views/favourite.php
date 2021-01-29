
<style>
.kt-datatable__pager-link--active{
  background: #009245!important;
}
</style>
<div class = "kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
  <div class="row mt-5 mb-5">
    <span class="text-green ft-6 pl-3"><i class="la la-star-o text-normal"></i> &nbspMY FAVOURITES</span>
  </div>
  <!-- begin:: Table -->
  <div class = "kt-datatable mt-5"></div>
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
  var base_url = "<?php echo base_url();?>";
</script>
<script src = "<?=base_url()?>assets/js/index/account/favourite.js" type = "text/javascript"></script>
