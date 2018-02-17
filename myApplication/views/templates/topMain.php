<div class="clearB"></div>
<div id="mainContent">

    <div id="extraContent">
        <div class="iranFlag"></div>
        <div class="leader"></div>
        <div class="behdasht"></div>
    </div>


    <div id="topContent">

        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-9">
                    <?php if ($this->userauthentication_model->check_user_logedin()) {
                        ?>
                        <div class="topContentTitle">
                            <h2>
                                <span class="glyphicon glyphicon-user" ></span>
                                پنل اصلی
                            </h2>
                            <small class="text-info"><?php echo $siteTitle; ?></small>
                            <br>
                            <div class="clearB"></div>
                            <?php
                            if ($userRole == 'ADMIN') {
                                ?>
                                <div class="welcome-note" style="float: right; padding-right: 5px;">مدیریت
                                    محترم <?php echo $siteTitle; ?>، <b><?php echo $fullName; ?></b> خوش آمدید!
                                </div>
                                <?php
                            } elseif ($userRole == 'INSPECTOR') {
                                ?>
                                <div class="welcome-note" style="float: right; padding-right: 5px;">بازرس
                                    محترم، <b><?php echo $fullName; ?></b> خوش آمدید!
                                </div>
                                <?php
                            } elseif ($userRole == 'OPU') {
                                ?>
                                <div class="welcome-note" style="float: right; padding-right: 5px;">مدیریت محترم واحد
                                    فراهم
                                    آوری <b><?php echo $name; ?></b>، <?php echo $headOffice; ?> خوش آمدید!
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-xs-3">
                    <div class="time-date-container">
                        <div class="time-date-inner">
                            <div class="time">
                                <?php echo pdate('H:i'); ?>
                                <hr>
                            </div>
                            <div class="week-day">
                                <?php echo pdate('l'); ?>
                            </div>
                            <div class="date">
                                <?php echo pdate('j F Y'); ?>
                            </div>
                        </div>
                    </div>
                    <!--<div class="clockBase">
                        <div class="clockDataComponent">
                            <div class="dataComponentOneR" style="background: #37BC9B;">
                                <div class="glyphicon glyphicon-time dataComponentGL"></div>
                            </div>

                            <div class="dataComponentOneL"
                                 style="background: #FFFFFF; border-bottom: 1px solid #EBEDF0; border-left: 1px solid #EBEDF0; border-top: 1px solid #EBEDF0; color: #656565;">
                                <div class="dataComponentText"
                                     style="color: #656565; position: relative; top: 32%; line-height: 0px;"><?php /*echo pdate('l، j F Y - H:i a'); */ ?></div>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
