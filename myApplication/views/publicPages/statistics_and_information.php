<title><?php echo $siteTitle; ?> | آمار و اطلاعات کل بیماران در مراکز فراهم آوری کشور</title>
<style type="text/css">
    #states th, #states td{
        text-align: right;
    }
    #canvas-holder{
        width:30%;
        margin: 0 auto;
    }
</style>
<div class="panel panel-success panelContent" id="loginInfo" style="margin-top: 15px;">
    <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">آمار و اطلاعات کل بیماران در مراکز فراهم آوری کشور</small></h3>
        <div class="glyphicon glyphicon-remove panelInfoBTN" id="loginInfoRemove" onclick="showPanel('loginInfo', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelInfoBTN" id="loginInfoMinus" onclick="showPanel('loginInfo', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="loginInfoPlus" onclick="showPanel('loginInfo', 'p')"></div>
        <div class="clearB"></div>
    </div>
    <div class="panel-body panelBodyText" id="loginInfoBody" style="width: 100%; text-align: right; margin: 0 auto;">
        <div style="width: 100%; height: auto; direction: rtl; margin: 0 auto;">
            <div class="col-md-6" style="float: right; padding-top: 75px;">
                <div class="row" style="width: 98%; margin: 0 auto; position: relative;">
                    <div class="col-md-4 dataComponent">
                        <div class="dataComponentOneR">
                            <div class="glyphicon glyphicon-list dataComponentGL"></div>
                        </div>

                        <div class="dataComponentOneL">
                            <div class="dataComponentText">کل بیماران</div>
                            <div class="dataComponentText" style="font-size: 30px; line-height: 22px;"><?php echo number_format($component['total']); ?></div>
                        </div>
                    </div>

                    <div class="col-md-4 dataComponent">
                        <div class="dataComponentOneR" style="background: #2B957A;">
                            <div class="glyphicon glyphicon-heart-empty dataComponentGL"></div>
                        </div>

                        <div class="dataComponentOneL" style="background: #37BC9B;">
                            <div class="dataComponentText">اهدا شده</div>
                            <div class="dataComponentText" style="font-size: 30px; line-height: 22px;">
                                <?php
                                echo number_format($component['donation']);
                                if($component['donation'] > 0)
                                {
                                    $y = $component['donation'] * 100;
                                    $y = round($y / $component['total'], 1);
                                    echo '<small style="color: #e3e2e2; font-size: 50%;">(%' . $y . ')</small>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 dataComponent">
                        <div class="dataComponentOneR" style="background: #b67f30;">
                            <div class="glyphicon glyphicon-edit dataComponentGL"></div>
                        </div>

                        <div class="dataComponentOneL" style="background: #ED9F2F;">
                            <div class="dataComponentText">درحال پیگیری</div>
                            <div class="dataComponentText" style="font-size: 30px; line-height: 22px;" id="patientReady">
                                <?php
                                echo number_format($component['ready']);
                                if($component['ready'] > 0)
                                {
                                    $y = $component['ready'] * 100;
                                    $y = round($y / $component['total'], 1);
                                    echo '<small style="color: #e3e2e2; font-size: 50%;">(%' . $y . ')</small>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="width: 98%; margin: 0 auto; position: relative;">
                    <div class="col-md-4 dataComponent">
                        <div class="dataComponentOneR" style="background: #564AA3;">
                            <div class="glyphicon glyphicon-check dataComponentGL"></div>
                        </div>

                        <div class="dataComponentOneL" style="background: #7266BA;">
                            <div class="dataComponentText">بهبود یافته</div>
                            <div class="dataComponentText" style="font-size: 30px; line-height: 22px;">
                                <?php
                                echo number_format($component['improved']);
                                if($component['improved'] > 0)
                                {
                                    $y = $component['improved'] * 100;
                                    $y = round($y / $component['total'], 1);
                                    echo '<small style="color: #e3e2e2; font-size: 50%;">(%' . $y . ')</small>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 dataComponent">
                        <div class="dataComponentOneR" style="background: black;">
                            <div class="glyphicon glyphicon-file dataComponentGL"></div>
                        </div>

                        <div class="dataComponentOneL" style="background: gray;">
                            <div class="dataComponentText">فوت شده</div>
                            <div class="dataComponentText" style="font-size: 30px; line-height: 22px;">
                                <?php
                                echo number_format($component['dead']);
                                if($component['dead'] > 0)
                                {
                                    $y = $component['dead'] * 100;
                                    $y = round($y / $component['total'], 1);
                                    echo '<small style="color: #e3e2e2; font-size: 50%;">(%' . $y . ')</small>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 dataComponent">
                        <div class="dataComponentOneR" style="background: #c70000;">
                            <div class="glyphicon glyphicon-new-window dataComponentGL"></div>
                        </div>

                        <div class="dataComponentOneL" style="background: #FF0000;">
                            <div class="dataComponentText">غیر قابل اهدا</div>
                            <div class="dataComponentText" style="font-size: 30px; line-height: 22px;">
                                <?php
                                echo number_format($component['poor']);
                                if($component['poor'] > 0)
                                {
                                    $y = $component['poor'] * 100;
                                    $y = round($y / $component['total'], 1);
                                    echo '<small style="color: #e3e2e2; font-size: 50%;">(%' . $y . ')</small>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="float: right;">
                <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
            </div>

            <div class="row">
                <table class="table table-hover" style="width: 90%; direction: rtl; text-align: center; margin: 0 auto;">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center;">ردیف</th>
                            <th width="25%" style="text-align: right;">نام مرکز و اطلاعات</th>
                            <th width="70%" style="text-align: center;">آمار و اطلاعات</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    for($i = 0, $a = 1; $i < count($opu); $i++){
                    ?>
                    <tr>
                        <th scope="row" style="text-align: center;"><?php echo $a++; ?></th>
                        <td style="text-align: right;">
                            <?php echo $opu[$i]['name']; ?>
                            <br>
                            جمعیت: <?php echo number_format($opu[$i]['population']); ?>
                            <br>
                            تیپ: <?php echo $opu[$i]['type']; ?>
                        </td>
                        <td>
                            <div class="col-md-2" style="float: right;">
                                <div class="miniComponent" style="background-color: #5D9CEC;">
                                    <?php echo number_format($opu[$i]['data']['total']); ?>
                                </div>
                            </div>
                            <div class="col-md-2" style="float: right;">
                                <div class="miniComponent" style="background-color: #37BC9B;">
                                    <?php echo number_format($opu[$i]['data']['donation']); ?>
                                </div>
                            </div>
                            <div class="col-md-2" style="float: right;">
                                <div class="miniComponent" style="background-color: #ED9F2F;">
                                    <?php echo number_format($opu[$i]['data']['ready']); ?>
                                </div>
                            </div>
                            <div class="col-md-2" style="float: right;">
                                <div class="miniComponent" style="background-color: #7266BA;">
                                    <?php echo number_format($opu[$i]['data']['improved']); ?>
                                </div>
                            </div>
                            <div class="col-md-2" style="float: right;">
                                <div class="miniComponent" style="background-color: #808080;">
                                    <?php echo number_format($opu[$i]['data']['dead']); ?>
                                </div>
                            </div>
                            <div class="col-md-2" style="float: right;">
                                <div class="miniComponent">
                                    <?php echo number_format($opu[$i]['data']['poor']); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>



    </div>
</div>
</div>
<script type="text/javascript">
    $(function () {

        $(document).ready(function () {

            // Build the chart
            $('#container').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'نمودار کل بیماران ثبت شده در سامانه'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: [{
                        name: 'All Patient',
                        y: <?php echo $component['total']; ?>,
                        color: '#5D9CEC'
                    }, {
                        name: 'Donation Patient',
                        y: <?php echo $component['donation']; ?>,
                        color: '#37BC9B',
                        sliced: true,
                        selected: true
                    }, {
                        name: 'Ready Patient',
                        y: <?php echo $component['ready']; ?>,
                        color: '#ED9F2F'
                    }, {
                        name: 'Improved Patient',
                        y: <?php echo $component['improved']; ?>,
                        color: '#7266BA'
                    }, {
                        name: 'Dead Patient',
                        y: <?php echo $component['dead']; ?>,
                        color: '#000000'
                    }, {
                        name: 'Poor Patient',
                        y: <?php echo $component['poor']; ?>,
                        color: '#FF0000'
                    }]
                }]
            });
        });
    });
    $(document).ready(function () {
        var wi = $('.miniComponent').width();
        $('.miniComponent').css({height: wi + 'px'});
    });
</script>
<script type="text/javascript" src="<?php echo asset_url(); ?>charts/js/highcharts.src.js"></script>