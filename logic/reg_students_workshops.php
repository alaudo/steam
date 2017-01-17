        <div class="row control-group">
            <div class="panel panel-info">
                <div class="panel-heading">Workshop preference order (most wanted on top)</div>
                <div class="panel-body">
                    <div id="sortable" class="row">


                    <?php
                            foreach($student["workshops"] as &$w) {
                                echo '<div id="w_'.$w["id"]. '" class="col-xs-12">';
                                echo '  <div class="panel panel-primary">';
                                echo '    <div class="panel-heading"> #'. $w["id"] . ': ' . $w["title"] . '</div>';
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
                            }
                });
                     $("#sortable").disableSelection();
                });
        </script>