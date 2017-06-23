<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<div class="ccm-block-desktop-site-activity">

    <?php
    $c = Page::getCurrentPage();
    if ($c->isEditMode()) {
    ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Site Activity disabled in edit mode.')?></div>

    <?php } else { ?>
        <?php if (count($types)) { ?>
            <script type="text/javascript">
                $(function() {
                    var width = parseInt($('#ccm-block-desktop-site-activity-chart').width()),
                        height = width;

                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {

                        var results = [['<?php echo t('Item')?>', '<?php echo t('Number')?>']];
                        var slices = [];
                        <?php if (in_array('form_submissions', $types)) { ?>
                            results.push(['<?php echo t('Form Results')?>', <?php echo intval($formResults)?>]);
                            slices.push({color: '#00d0f8'});
                        <?php } ?>
                        <?php if (in_array('survey_results', $types)) { ?>
                            results.push(['<?php echo t('Survey Results')?>', <?php echo intval($surveyResults)?>]);
                            slices.push({color: '#7c33b1'});
                        <?php } ?>
                        <?php if (in_array('signups', $types)) { ?>
                            results.push(['<?php echo t('Signups')?>', <?php echo intval($signups)?>]);
                            slices.push({color: '#fed24b'});
                        <?php } ?>
                        <?php if (in_array('conversation_messages', $types)) { ?>
                            results.push(['<?php echo t('Conversation Messages')?>', <?php echo intval($messages)?>]);
                            slices.push({color: '#00cc66'});
                        <?php } ?>
                        <?php if (in_array('workflow', $types)) { ?>
                            results.push(['<?php echo t('Approvals')?>', <?php echo intval($approvals)?>]);
                            slices.push({color: '#f3ac1e'});
                        <?php } ?>


                        var data = google.visualization.arrayToDataTable(results);

                        var options = {
                            pieHole: 0.9,
                            pieSliceText: 'none',
                            chartArea: {
                                left: 'auto',
                                backgroundColor: '#f8fafb',
                                width: '100%',
                                height: '100%'
                            },
                            backgroundColor: {
                                fill: '#f8fafb'
                            },
                            legend: 'none',
                            tooltip: { trigger: 'none' },
                            slices: slices,
                            width: width,
                            height: height
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('ccm-block-desktop-site-activity-chart'));
                        chart.draw(data, options);

                    }


                    $(window).resize(function() {
                        var $legend = $('#ccm-block-desktop-site-activity-legend');
                        $legend.show();
                        $legend.css("left", 20 + (width - $legend.width()) / 2);
                        $legend.css("top", (height - $legend.height()) / 2);
                    }).trigger('resize');

                });
            </script>

            <div id="ccm-block-desktop-site-activity-legend">
                <h6><?php echo t('Latest')?></h6>
                <?php if (in_array('form_submissions', $types) && $formResults) { ?>
                <div class="ccm-block-desktop-site-activity-legend-row">
                    <a href="<?php echo URL::to('/dashboard/reports/forms')?>" style="color: #00d0f8">
                    <?php echo t2('%s Form', '%s Forms', intval($formResults))?>
                    </a>
                </div>
                <?php } ?>
                <?php if (in_array('survey_results', $types) && $surveyResults) { ?>
                <div class="ccm-block-desktop-site-activity-legend-row">
                    <a href="<?php echo URL::to('/dashboard/reports/surveys')?>" style="color: #7c33b1">
                        <?php echo t2('%s Vote', '%s Votes', intval($surveyResults))?>
                    </a>
                </div>
                <?php } ?>
                <?php if (in_array('signups', $types) && $signups) { ?>
                <div class="ccm-block-desktop-site-activity-legend-row">
                    <a href="<?php echo URL::to('/dashboard/users/search')?>" style="color: #fed24b">
                        <?php echo t2('%s User', '%s Users', intval($signups))?>
                    </a>
                </div>
                <?php } ?>
                <?php if (in_array('conversation_messages', $types) && $messages) { ?>
                <div class="ccm-block-desktop-site-activity-legend-row">
                    <a href="<?php echo URL::to('/dashboard/conversations/messages')?>" style="color: #00cc66">
                        <?php echo t2('%s Message', '%s Messages', intval($messages))?>
                    </a>
                </div>
                <?php } ?>
                <?php if (in_array('workflow', $types) && $approvals) { ?>
                    <div class="ccm-block-desktop-site-activity-legend-row">
                        <a href="<?php echo URL::to('/dashboard/welcome/me')?>" style="color: #f3ac1e">
                            <?php echo t2('%s Approval', '%s Approvals', intval($approvals))?>
                        </a>
                    </div>
                <?php } ?>
            </div>

           <div id="ccm-block-desktop-site-activity-chart"></div>


        <?php } ?>

    <?php } ?>
</div>