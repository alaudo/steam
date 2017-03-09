    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form name="preregister" id="registerForm" method="post" novalidate>
                    <div class="panel panel-default" id="student" role="tablist" aria-multiselectable="true">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h3 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#student" href="#collapseStepOne" aria-expanded="false" aria-controls="collapseStepOne">
                                    <?php utils::ifset($student,'showstep2','<span class="glyphicon glyphicon-chevron-down pull-right"></span>'); ?> STEAM workshop registration confirmation
                                </a>
                            </h3>
                        </div>
                        <div id="collapseStepOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="row control-group">
                                    <div class="form-group col-sm-4 floating-label-form-group controls <?php utils::ifset($student,'name_first','floating-label-form-group-with-value'); ?>">
                                        <label>Student's first name</label>
                                        <input type="text" class="form-control"  placeholder="Student's first name" name="student_first" id="student_first" required data-validation-required-message="Please enter student's first name." value="<?php utils::ifexists($student,'name_first'); ?>" readonly >
                                        
                                    </div>

                                    <div class="form-group col-sm-4 floating-label-form-group controls <?php utils::ifset($student,'name_last','floating-label-form-group-with-value'); ?>">
                                        <label>Student's last name</label>
                                        <input type="text" class="form-control"  placeholder="Student's last name" name="student_last" id="student_last" required data-validation-required-message="Please enter student's last name." value="<?php utils::ifexists($student,'name_last'); ?>" readonly>
                                        
                                    </div>
                            </div>
                            </div>
                    </div>
                    </div>


                    <div class="row control-group">
                            <div class="panel panel-info">
                                <div class="panel-heading"><h3 class="panel-title">Your workshop preferences:</h3></div>
                                <div class="panel-body">

                                        <div id="sortable" class="row">


                                        <?php
                                                $i = 1;
                                                foreach($student["workshops"] as &$w) {
                                                    if ($w["id"] == 0) break;
                                                    echo '<div id="w_'.$w["id"]. '" class="col-xs-12 poption">';
                                                    echo '  <div class="panel '. $w["css"] .'">';
                                                    echo '    <div class="panel-heading"> <span class="pref pull-right"> </span> Choice #'. $i .' : ' . $w["title"] . '</div>';
                                                    echo '    <div class="panel-body">'. $w["description"] . '</div>';
                                                    echo '  </div>';
                                                    echo '</div>';
                                                    $i++;
                                                }
                                        ?>

                                        </div>
                             <h3 class="row text-center">
                                You can close this page now.
                            </h3>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>        
       </div>
    </section>
