        <div class="row control-group">
            <div class="panel panel-info">
                <div class="panel-heading">Workshop preference order (most wanted on top)</div>
                <div class="panel-body">
                    <div class="alert alert-warning" role="alert">
                    Students <b>from K to 2nd</b> grade will participate in <b>4</b> different workshops. Students from <b>3rd to 5th</b> grade will participate in <b>3 different workshops</b>.  Please choose the top preferences.
                    </div>
                    <div id="sortable" class="row">


                    <?php
                            foreach($student["workshops"] as &$w) {
                                echo '<div id="w_'.$w["id"]. '" class="col-xs-12 poption">';
                                echo '  <div class="panel '. $w["css"] .'">';
                                echo '    <div class="panel-heading"> <span class="pref pull-right"> </span> ' . $w["title"] . '</div>';
                                echo '    <div class="panel-body">'. $w["description"] . '</div>';
                                echo '  </div>';
                                echo '</div>';

                            }
                    ?>
                    <input type="hidden" id="workshopsorder" name="workshopsorder" value="" />

                    </div>
                </div>
            </div>
        </div>
        <script>
                $(function() {
                    $("#sortable").sortable({appendTo: 'body',
                        scroll: true,
                        helper: 'clone',
                        stop: function (event, ui) {
	                        var data = $(this).sortable('serialize');
                            $("#workshopsorder").val(data);
                            UpdateChoice();

 
                }});
                     $("#sortable").disableSelection();
                     var data = $("#sortable").sortable('serialize');
                     $("#workshopsorder").val(data);
                     UpdateChoice();
                });

                function UpdateChoice() {
                    $(".pref").each(function (index, value) { 
                    var maxindex = $(".poption").index($("#w_0"));

                    if (index <  Math.min(6,maxindex)) {
                        $(value).text("Choice #" + (index + 1));

                    } else  {
                        $(value).text("");
                    }
                    
                    });
                }

        </script>