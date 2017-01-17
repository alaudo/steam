        <div class="row">
            <div class="form-group col-xs-12">
                <label class="checkbox-inline"><input type="checkbox" value="">I volunteer for a workshop and want that my child participates with me.</label>
            </div>
        </div>
        <div class="panel-group" id="parent_workshop_panel" role="tablist" aria-multiselectable="true">
        <div class="panel panel-success">
            <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#parent_workshop_panel" href="#collapseParentWorkshop" aria-expanded="false" aria-controls="collapseParentWorkshop">
                <span class="glyphicon glyphicon-chevron-down pull-right"></span>Parent workshop data
                </a>
            </h4>
            </div>
            <div id="collapseParentWorkshop" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <div class="row control-group">
                    <div class="form-group col-xs-4 floating-label-form-group controls floating-label-form-group-with-value">
                        <label>Parent's first name</label>
                        <input type="text" class="form-control"  placeholder="Parent's first name" name="workshop_parent_first" id="workshop_parent_first" value="<?php utils::ifexists($student['parent_workshop'],'parent_first'); ?>" readonly>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group col-xs-4 floating-label-form-group controls floating-label-form-group-with-value">
                        <label>Parent's last name</label>
                        <input type="text" class="form-control"  placeholder="Parent's last name" name="workshop_parent_last" id="workshop_parent_last" value="<?php utils::ifexists($student['parent_workshop'],'parent_last'); ?>" readonly>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group col-xs-4 floating-label-form-group controls floating-label-form-group-with-value">
                        <label>Registration date</label>
                        <input type="text" class="form-control"  placeholder="Parent's first name" name="workshop_parent_regdate" id="workshop_parent_regdate" value="<?php utils::ifexists($student['parent_workshop'],'regdate'); ?>" readonly>
                        <p class="help-block text-danger"></p>
                    </div>
                    
                </div>

                <div class="row control-group">

                    <div class="form-group col-xs-4 floating-label-form-group controls floating-label-form-group-with-value">
                        <label>Day phone</label>
                        <input type="text" class="form-control"  name="workshop_parent_phone" id="workshop_parent_phone"  value="<?php utils::ifexists($student['parent_workshop'],'phone'); ?>" readonly>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group col-xs-4 floating-label-form-group controls floating-label-form-group-with-value">
                        <label>Mobile phone</label>
                        <input type="text" class="form-control"   name="workshop_parent_phone2" id="workshop_parent_phone2" value="<?php utils::ifexists($student['parent_workshop'],'phone2'); ?>" readonly>
                        <p class="help-block text-danger"></p>
                    </div>

                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-8 floating-label-form-group controls floating-label-form-group-with-value">
                        <label>Email</label>
                        <input type="text" class="form-control"   name="workshop_parent_email" id="workshop_parent_email"  value="<?php utils::ifexists($student['parent_workshop'],'email'); ?>" readonly>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls floating-label-form-group-with-value">
                        <label>Workshop title</label>
                        <input type="text" class="form-control"  name="workshop_parent_title" id="workshop_parent_title"  value="<?php utils::ifexists($student['parent_workshop']['workshop'],'title'); ?>" readonly>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls floating-label-form-group-with-value">
                        <label>Description</label>
                        <textarea rows="4" class="form-control"  name="workshop_parent_description" id="workshop_parent_description" readonly><?php utils::ifexists($student['parent_workshop']['workshop'],'description'); ?>
                            </textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
            </div>
           </div>
       </div>