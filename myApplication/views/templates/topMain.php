<div class="clearB"></div>
<div id="mainContent">

<div id="extraContent">
    <div class="iranFlag"></div>
    <div class="leader"></div>
    <div class="behdasht"></div>
</div>


<div id="topContent">
    <?php if($this->userauthentication_model->check_user_logedin())
        {
        ?>
        <div class="topContentTitle">
            پنل اصلی
            <br>
            <small class="text-info"><?php echo $siteTitle; ?></small>
            <br>
            <div class="clearB"></div>
            <div class="glyphicon glyphicon-user text-success" style="float: right;"></div>
            <?php
                if($userRole == 'ADMIN')
                {
                ?>
                <div class="text-primary" style="float: right; padding-right: 5px;">مدیریت محترم <?php echo $siteTitle; ?>، <?php echo $fullName; ?> خوش آمدید!</div>
                <?php
                }
                elseif($userRole == 'INSPECTOR')
                {
                ?>
                <div class="text-primary" style="float: right; padding-right: 5px;">بازرس محترم، <?php echo $fullName; ?> خوش آمدید!</div>
                <?php
                }
                elseif($userRole == 'OPU')
                {
                ?>
                <div class="text-primary" style="float: right; padding-right: 5px;">مدیریت محترم واحد فراهم آوری <?php echo $name;?>، <?php echo $headOffice; ?> خوش آمدید!</div>
                <?php
                }
            ?>
        </div>
        <?php } ?>

    <div class="clockBase">
        <div class="clockDataComponent">
            <div class="dataComponentOneR" style="background: #37BC9B;">
                <div class="glyphicon glyphicon-time dataComponentGL"></div>
            </div>

            <div class="dataComponentOneL" style="background: #FFFFFF; border-bottom: 1px solid #EBEDF0; border-left: 1px solid #EBEDF0; border-top: 1px solid #EBEDF0; color: #656565;">
                <div class="dataComponentText" style="color: #656565; position: relative; top: 32%; line-height: 0px;"><?php echo pdate('l، j F Y - H:i a'); ?></div>
            </div>
        </div>
    </div>

        </div>
        <div class="clearB"></div>