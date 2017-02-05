    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form name="preregister" id="registerForm" method="post" novalidate>
                    <div class="panel panel-default" id="student" role="tablist" aria-multiselectable="true">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#student" href="#collapseStepOne" aria-expanded="false" aria-controls="collapseStepOne">
                                    <?php utils::ifset($student,'showstep2','<span class="glyphicon glyphicon-chevron-down pull-right"></span>'); ?> Step 1: Provide student data
                                </a>
                            </h4>
                        </div>
                        <div id="collapseStepOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="row control-group">
                                    <div class="form-group col-xs-4 floating-label-form-group controls <?php utils::ifset($student,'name_first','floating-label-form-group-with-value'); ?>">
                                        <label>Student's first name</label>
                                        <input type="text" class="form-control"  placeholder="Student's first name" name="student_first" id="student_first" required data-validation-required-message="Please enter student's full name." value="<?php utils::ifexists($student,'name_first'); ?>" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div class="form-group col-xs-4 floating-label-form-group controls <?php utils::ifset($student,'name_last','floating-label-form-group-with-value'); ?>">
                                        <label>Student's last name</label>
                                        <input type="text" class="form-control"  placeholder="Student's last name" name="student_last" id="student_last" required data-validation-required-message="Please enter student's full name." value="<?php utils::ifexists($student,'name_last'); ?>" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div class="form-group col-xs-4 floating-label-form-group controls <?php utils::ifset($student,'class','floating-label-form-group-with-value'); ?>">
                                        <label>Class and teacher</label>

                                        <?php
                                                $sql="SELECT ID, CONCAT('Grade ', Grade, ': ', Teacher) AS Class FROM `Classroom` ORDER BY Class ";
                                                $result = mysql_query($sql);

                                                echo "<select name='class' class='selectpicker' data-live-search='true' placeholder='Class and teacher'>";
                                                echo "<option value='-1'". ((!isset($student["class"])) ? "selected='selected'" :"") . ">Class and teacher</option>";
                                                while ($row = mysql_fetch_array($result)) {
                                                    echo "<option value='" . $row['ID'] ."'" . ( $student['class'] == $row['ID'] ? 'selected="selected"' : '' )  . ">" . $row['Class'] . "</option>";
                                                }
                                                
                                                echo "</select>";
                                        ?>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row control-group">
                                    <div class="form-group col-xs-4 floating-label-form-group controls <?php utils::ifset($student,'parent_first','floating-label-form-group-with-value'); ?>">
                                        <label>Parent's first name</label>
                                        <input type="text" class="form-control"  placeholder="Parent's first name" name="parent_first" id="parent_first" required data-validation-required-message="Please enter student's full name." value="<?php utils::ifexists($student,'parent_first'); ?>" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div class="form-group col-xs-4 floating-label-form-group controls <?php utils::ifset($student,'parent_last','floating-label-form-group-with-value'); ?>">
                                        <label>Parent's last name</label>
                                        <input type="text" class="form-control"  placeholder="Parent's last name" name="parent_last" id="parent_last" required data-validation-required-message="Please enter student's full name." value="<?php utils::ifexists($student,'parent_last'); ?>" >
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>

                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls <?php utils::ifset($student,'email','floating-label-form-group-with-value'); ?>">
                                        <label>Contact Email</label>
                                        <input type="email" class="form-control" placeholder="Contact Email" id="email" name="email" required data-validation-required-message="Please enter your email address." value="<?php utils::ifexists($student,'email'); ?>" >
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <br>
                            <?php
                                // echo("<div>" . var_dump($student) . "</div>");
                            ?>

                            <div class="row">
                                <div class="form-group col-xs-12 clearfix">
                                    <button type="submit" name="load" class="btn btn-warning btn-lg inbutton pull-right">
                                            <?php
                                                if (!isset($student["showstep2"])) {
                                                    echo 'Login or register';
                                                } else {
                                                    echo 'Reload data';
                                                }
                                            ?>                                      
                                        </button>
                                </div>
                            </div>
                            <?php
                                if (isset($student["infomessage"])) {
                                    echo ("<div class='panel-footer {$student["infomessagecss"]} '> {$student["infomessage"]} </div>");
                                }
                            ?>
                    </div>
                              <?php
                                if (isset($student["showstep2"])) {
                                    include("reg_students_step2.php");
                                }
                               ?>                                      
                    </form>
                </div>
            </div>        
       </div>
    </section>
