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
                                    <div class="form-group col-sm-4 floating-label-form-group controls <?php utils::ifset($student,'name_first','floating-label-form-group-with-value'); ?>">
                                        <label>Student's first name</label>
                                        <input type="text" class="form-control"  placeholder="Student's first name" name="student_first" id="student_first" required data-validation-required-message="Please enter student's first name." value="<?php utils::ifexists($student,'name_first'); ?>" >
                                        
                                    </div>

                                    <div class="form-group col-sm-4 floating-label-form-group controls <?php utils::ifset($student,'name_last','floating-label-form-group-with-value'); ?>">
                                        <label>Student's last name</label>
                                        <input type="text" class="form-control"  placeholder="Student's last name" name="student_last" id="student_last" required data-validation-required-message="Please enter student's last name." value="<?php utils::ifexists($student,'name_last'); ?>" >
                                        
                                    </div>

                                    <div class="form-group col-sm-4 floating-label-form-group controls <?php utils::ifset($student,'class','floating-label-form-group-with-value'); ?>">
                                        <label>Class and teacher</label>

                                        <?php
                                                $sql="SELECT ID, CONCAT(CONCAT(Grade, CASE WHEN Grade = 'K' THEN 'indergarden' WHEN Grade = '1' THEN 'st grade' WHEN Grade = '2' THEN 'nd grade' WHEN Grade = '3' THEN 'rd grade' ELSE 'th grade' END), ' : ', Teacher) AS Class FROM `Classroom` ORDER BY Class";
                                                $result = mysql_query($sql);

                                                echo "<select name='class' class='selectpicker' data-live-search='true' placeholder='Class and teacher' data-validation-required-message='Please enter student's class.' >";
                                                echo "<option value='-1'". ((!isset($student["class"])) ? "selected='selected'" :"") . ">Class and teacher</option>";
                                                while ($row = mysql_fetch_array($result)) {
                                                    echo "<option value='" . $row['ID'] ."'" . ( $student['class'] == $row['ID'] ? 'selected="selected"' : '' )  . ">" . $row['Class'] . "</option>";
                                                }
                                                
                                                echo "</select>";
                                        ?>
                                        
                                    </div>
                                </div>
                                <div class="row control-group">
                                    <div class="form-group col-sm-4 floating-label-form-group controls <?php utils::ifset($student,'parent_first','floating-label-form-group-with-value'); ?>">
                                        <label>Parent's first name</label>
                                        <input type="text" class="form-control"  placeholder="Parent's first name" name="parent_first" id="parent_first" required data-validation-required-message="Please enter parent's first name." value="<?php utils::ifexists($student,'parent_first'); ?>" >
                                        
                                    </div>

                                    <div class="form-group col-sm-4 floating-label-form-group controls <?php utils::ifset($student,'parent_last','floating-label-form-group-with-value'); ?>">
                                        <label>Parent's last name</label>
                                        <input type="text" class="form-control"  placeholder="Parent's last name" name="parent_last" id="parent_last" required data-validation-required-message="Please enter parent's last name." value="<?php utils::ifexists($student,'parent_last'); ?>" >
                                        
                                    </div>
                                </div>

                                <div class="row control-group">
                                    <div class="form-group col-sm-12 floating-label-form-group controls <?php utils::ifset($student,'email','floating-label-form-group-with-value'); ?>">
                                        <label>Contact Email or Keyword</label>
                                        <input type="email" class="form-control" placeholder="Contact Email or Keyword" id="email" name="email" required data-validation-required-message="Please enter your email address, it will be used as your password to access data." value="<?php utils::ifexists($student,'email'); ?>" >
                                        
                                    </div>
                                </div>

                                <div class="alert alert-warning" role="alert">
                                Remember this email address to edit your workshop preferences later. We will not send any emails to this address. You may use other keyword of your choice.
                                </div>
                            </div>
                            </div>
                            <br>
                            <?php
                               // echo("<div>" . var_dump($student) . "</div>");
                            ?>

                            <div class="row">
                                <div class="form-group col-sm-12 clearfix">
                                    <button type="submit" name="load" id="s" class="btn btn-warning btn-lg inbutton" style="margin-left:10px">
                                            <?php
                                                if (!isset($student["showstep2"])) {
                                                    echo 'Login or register';
                                                } else {
                                                    echo 'Retry login';
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
    <script>
            $(document).ready(function() {
                var isMobile = window.matchMedia("only screen and (max-width: 760px)");

                if (isMobile.matches) {
                       $('.selectpicker').selectpicker('mobile');
                }

            });

    </script>