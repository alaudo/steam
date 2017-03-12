<div class="panel-group" id="step2" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#step2" href="#collapseStep2" aria-expanded="false" aria-controls="collapseStep2">
          <span class="glyphicon glyphicon-chevron-down pull-right"></span> Step 2: Select and rank workshops
        </a>
      </h4>
    </div>
    <div id="collapseStep2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">

        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls <?php utils::ifset($student,'allergy','floating-label-form-group-with-value'); ?>">
                <label>Allergies and conditions</label>
                <input type="email" class="form-control" placeholder="List known allergies or conditions" id="allergy" name="allergy"  value="<?php utils::ifexists($student,'allergy'); ?>" >
                <p class="help-block text-danger"></p>
            </div>
        </div>
       
        <?php
            if ($student["is_parent_workshop"]) {
                include("reg_students_parentworkshop.php");
            } else  {
                include("reg_students_noparentworkshop.php");
            }

        ?>
        <br /> 
        <?php
        if (isset($student["workshops"])) {
            include("reg_students_workshops.php");
        }           
        ?> 

    </div>
</div>
</div>
<div class="row">
    <div class="form-group col-xs-12 controls clearfix">
        <button type="submit" name="save" class="btn btn-success btn-lg pull-right inbutton">Save preferences</button>
    </div>
</div>

