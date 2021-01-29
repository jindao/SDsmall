<?php
?>

<link href="<?=base_url()?>assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-portlet__head kt-portlet__head--lg">
  <div class="kt-portlet__head-label">
    <span class="kt-portlet__head-icon">
      <i class="kt-font-success flaticon2-line-chart"></i>
    </span>
    <h3 class="kt-portlet__head-title dayHead textBold">
      LEAGUE TABLE
    </h3>
  </div>
  <div class="kt-portlet__head-toolbar">
    <div class="kt-portlet__head-wrapper">
      <div class="kt-portlet__head-actions">

          <button class="btn btn-add btn-md" id = "addLeague">
            <i class="la la-plus"></i>
            New LEAGUE
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
  <table class="table table-striped  table-hover table-checkable" id="leagueTable">
    <thead>

    </thead>
  </table>
</div>
<!--end: Datatable -->


<div class="modal fade" id="leagueModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg mainBg">
    <div class="modal-content mainBg">
      <form id = "formCreateLeague" action="<?=base_url()?>admin/league/create" method = "post">
        <div class="modal-header dayHead">
          <label id = "modalHead" class = "col-form-label textBold textSize16">Add League:</label>
            <input type = "text" id = "runId" name = "runId" value = "" style ="border : none">


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
          <div class = "form-group row">
            <div class="col-md-4 kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
              <div class="kt-form__group kt-form__group--inline">
                <div class="kt-form__label">
                  <label class = "dayHead">ID:</label>
                </div>
                <div class="kt-form__control">
                  <input class="form-control" type="text" placeholder="" id="league_id" name="league_id" >
                </div>
              </div>
             </div>
            
              <div class="col-md-4 kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">

                <div class="kt-form__group kt-form__group--inline">
                  <div class="kt-form__label">
                    <label class = "dayHead">SPORTID:</label>
                  </div>
                  <div class="kt-form__control">
                  <select class="form-control kt-select2" id="sport_id" name="sport_id">
                    <option></option>
                    <?php
                      foreach($sports as $sport){
                        echo "<option value = ".$sport["id"]." > ".$sport["name"]." </option>";
                      }
                    ?>
                  </select>
                  </div>
                </div>
                </div>

            <div class="col-md-4 kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">

              <div class="kt-form__group kt-form__group--inline">
                <div class="kt-form__label">
                  <label class = "dayHead">TOURID:</label>
                </div>
                <div class="kt-form__control">
                  <input class="form-control"  type="text" placeholder="" id="tourID" name="tourID" >
                </div>
                </div>
            </div>
          </div>

          <div class = "form-group row">
            <div class="col-md-6 kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">

              <div class="kt-form__group kt-form__group--inline">
                <div class="kt-form__label">
                    <label class = "dayHead">Name:</label>
                </div>
                <div class="kt-form__control">
                  <input class="form-control" placeholder=""  type="text" id="league_name" name="league_name" value = "">
                </div>
              </div>
              </div>
            <div class="col-md-6 kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">

              <div class="kt-form__group kt-form__group--inline">
                <div class="kt-form__label">
                  <label class = "dayHead">Link:</label>
                </div>
                <div class="kt-form__control">
                  <input class="form-control" placeholder=""  type="text" id="league_link" name="league_link" value = "">
                </div>
              </div>
            </div>
          </div>

          <footer class="row">
            <div class="col-md-6 text-right">
              <input type="reset" value = "Reset" class="btn btn-secondary">
            </div>
            <div class="col-md-6 text-left">
              <input type="submit" value = "Confirm" class="btn btn-success">
            </div>
          </footer>
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
<script src="<?=base_url()?>assets/js/admin/league.js" type="text/javascript"></script>

