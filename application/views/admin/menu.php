<?php
/**
 * Created by PhpStorm.
 * User: DREAM
 * Date: 12/17/2020
 * Time: 2:32 PM
 */
?>

<link href="<?=base_url()?>assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-portlet__head kt-portlet__head--lg">
  <div class="kt-portlet__head-label">
    <span class="kt-portlet__head-icon">
      <i class="kt-font-success flaticon2-line-chart"></i>
    </span>
    <h3 class="kt-portlet__head-title dayHead textBold">
      EDIT MENU
    </h3>
  </div>
  <div class="kt-portlet__head-toolbar">
    <div class="kt-portlet__head-wrapper">
      <div class="kt-portlet__head-actions">
        <a href = "#" class = "kt-menu__link">
        <button class="btn btn-add btn-md" id = "addSport">
          <i class="la la-plus"></i>
          New Menu Item
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
  <tr>
    <td>1</td>
    <td>FOOTBALL</td>
    <td>football</td>
    <td nowrap></td>
  </tr>
  <tr>
    <td>2</td>
    <td>TENNIS</td>
    <td>tennis</td>
    <td nowrap></td>
  </tr>
  <tr>
    <td>3</td>
    <td>BASKETBALL</td>
    <td>basketball</td>
    <td nowrap></td>
  </tr>

  </tbody>
</table>
</div>
<!--end: Datatable -->
<script src="<?=base_url()?>assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/admin/sport.js" type="text/javascript"></script>

