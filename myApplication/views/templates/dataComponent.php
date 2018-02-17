<div id="dataComponent">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="dataComponent">
                    <div class="dataComponentOneR">
                        <div class="glyphicon glyphicon-list dataComponentGL"></div>
                    </div>

                    <div class="dataComponentOneL">
                        <div class="dataComponentText textOnly">کل بیماران</div>
                        <div class="dataComponentText"
                             style="font-size: 30px; line-height: 22px;"><?php echo number_format($total); ?></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="dataComponent">
                    <div class="dataComponentOneR" style="background: #2B957A;">
                        <div class="glyphicon glyphicon-heart-empty dataComponentGL"></div>
                    </div>

                    <div class="dataComponentOneL" style="background: #37BC9B;">
                        <div class="dataComponentText textOnly">اهدا شده</div>
                        <div class="dataComponentText" style="font-size: 30px; line-height: 22px;">
                            <?php
                            echo number_format($donation);
                            if ($donation > 0) {
                                $y = $donation * 100;
                                $y = round($y / $total, 1);
                                echo '<small class="percent" style="color: #e3e2e2; font-size: 50%;">(%' . $y . ')</small>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="dataComponent">
                    <div class="dataComponentOneR" style="background: #b67f30;">
                        <div class="glyphicon glyphicon-edit dataComponentGL"></div>
                    </div>

                    <div class="dataComponentOneL" style="background: #ED9F2F;">
                        <div class="dataComponentText textOnly">درحال پیگیری</div>
                        <div class="dataComponentText" style="font-size: 30px; line-height: 22px;" id="patientReady">
                            <?php
                            echo number_format($ready);
                            if ($ready > 0) {
                                $y = $ready * 100;
                                $y = round($y / $total, 1);
                                echo '<small  class="percent" style="color: #e3e2e2; font-size: 50%;">(%' . $y . ')</small>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="dataComponent">
                    <div class="dataComponentOneR" style="background: #564AA3;">
                        <div class="glyphicon glyphicon-check dataComponentGL"></div>
                    </div>

                    <div class="dataComponentOneL" style="background: #7266BA;">
                        <div class="dataComponentText textOnly">بهبود یافته</div>
                        <div class="dataComponentText" style="font-size: 30px; line-height: 22px;">
                            <?php
                            echo number_format($improved);
                            if ($improved > 0) {
                                $y = $improved * 100;
                                $y = round($y / $total, 1);
                                echo '<small class="percent" style="color: #e3e2e2; font-size: 50%;">(%' . $y . ')</small>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="dataComponent">
                    <div class="dataComponentOneR" style="background: black;">
                        <div class="glyphicon glyphicon-file dataComponentGL"></div>
                    </div>

                    <div class="dataComponentOneL" style="background: gray;">
                        <div class="dataComponentText textOnly">فوت شده</div>
                        <div class="dataComponentText" style="font-size: 30px; line-height: 22px;">
                            <?php
                            echo number_format($dead);
                            if ($dead > 0) {
                                $y = $dead * 100;
                                $y = round($y / $total, 1);
                                echo '<small class="percent" style="color: #e3e2e2; font-size: 50%;">(%' . $y . ')</small>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="dataComponent">
                    <div class="dataComponentOneR" style="background: #c70000;">
                        <div class="glyphicon glyphicon-new-window dataComponentGL"></div>
                    </div>

                    <div class="dataComponentOneL" style="background: #FF0000;">
                        <div class="dataComponentText textOnly">غیر قابل اهدا</div>
                        <div class="dataComponentText" style="font-size: 30px; line-height: 22px;">
                            <?php
                            echo number_format($poor);
                            if ($poor > 0) {
                                $y = $poor * 100;
                                $y = round($y / $total, 1);
                                echo '<small  class="percent" style="color: #e3e2e2; font-size: 50%;">(%' . $y . ')</small>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php
        if ($userRole == 'OPU' AND $showModal == 1) {
            ?>
            <!-- opu patient modal -->
            <div class="modal fade" id="opuPatientResultModal" tabindex="-1" role="dialog"
                 aria-labelledby="opuPatientResultModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" style="float: left;"><span
                                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="archiveModalLabel" style="font-family: 'BYekan';">بیماران درحال
                                پیگیری</h4>
                        </div>
                        <div class="modal-body" id="opuPatientResultModalBodyData">

                            <div id="activeQuestion"
                                 style="width: 90%; margin: 0px auto; text-align: justify; font-family: 'BNazanin',Tahoma; font-size: 16px;">
                                مدیریت محترم واحد فراهم آوری، <span
                                        style="font-weight: bold; color: #2B689B;"><?php echo $name; ?></span> در حال
                                حاضر شما <span style="font-weight: bold; color: #ED9F2F;"> <?php echo $ready; ?> </span>
                                بیمار درحال پیگیری در سامانه خود دارید.
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"
                                    style="float: left; font-family: 'BYekan';">بستن
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- opu patient modal -->
        <?php
        if ($ready > 0)
        {
        ?>
            <script type="text/javascript">
                $('#opuPatientResultModal').modal({"backdrop": "static", "show": true});
            </script>
            <?php
        }
        }
        ?>
    </div>
</div>
