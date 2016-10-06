<title><?php echo $siteTitle; ?> | تغییر رمز عبور</title>
<div class="panel panel-info panelContent" id="changePassword">
    <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">اطلاعات ورود شما!</h3>
        <div class="glyphicon glyphicon-remove panelInfoBTN" id="changePasswordRemove" onclick="showPanel('changePassword', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelInfoBTN" id="changePasswordMinus" onclick="showPanel('changePassword', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="changePasswordPlus" onclick="showPanel('changePassword', 'p')"></div>
        <div class="clearB"></div>
    </div>
    <div class="panel-body panelBodyText" id="changePasswordBody">
        <form class="form-horizontal" role="form" style="width: 800px; direction: rtl; text-align: center; margin: 0 auto;" method="post" name="changeUserPass">
            <div class="form-group">
                <label for="inputLastPassword" class="control-label floatRight" style="font-family: 'BNazanin'; font-weight: normal; width: 200px;">رمز عبور قبلی<span style="color: red;"> *</span>:</label>
                <div style="width: 600px; float: right;">
                    <input type="password" class="form-control" id="inputLastPassword" name="inputLastPassword" placeholder="type old password" style="direction: ltr; font-family: 'webYekan';">
                </div>
            </div>
            <div class="form-group">
                <label for="inputNewPassword" class="control-label floatRight" style="font-family: 'BNazanin'; font-weight: normal; width: 200px;">رمز عبور جدید<span style="color: red;"> *</span>:</label>
                <div style="width: 600px; float: right;">
                    <input type="password" class="form-control" id="inputNewPassword" name="inputNewPassword" placeholder="type new password" style="direction: ltr; font-family: 'webYekan';">
                </div>
            </div>
            <div class="form-group">
                <label for="inputNewPassword2" class="control-label floatRight" style="font-family: 'BNazanin'; font-weight: normal; width: 200px;">تکرار رمز عبور جدید<span style="color: red;"> *</span>:</label>
                <div style="width: 600px; float: right;">
                    <input type="password" class="form-control" id="inputNewPassword2" name="inputNewPassword2" placeholder="type new password again" style="direction: ltr; font-family: 'webYekan';">
                </div>
            </div>
            <div class="form-group">
                <div style="width: 800px;">
                    <button type="button" class="btn btn-success floatLeft" style="font-family: 'BYekan'; font-weight: normal;" onclick="changeUserPassword();">تغییر رمز عبور</button>
                </div>
            </div>
        </form>
        <div class="clearB"></div>
        <div style="width: 800px; margin: 0 auto; text-align: center;">
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="danger1">رمز عبور جدید و تکرار رمز عبور جدید مطابقت ندارد.</div>
            
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="danger2">رمز عبور قبلی کوتاه تر از رمز اصلی وارد شده است.</div>
            
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="danger3">رمز عبور جدید باید بیشتر از 5 کاراکتر باشد.</div>
            
            <?php
                if($status == 1)
                {

            ?>
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">رمز عبور جدید و تکرار رمز عبور جدید مطابقت ندارد.</div>
            <?php
                }
                elseif($status == 2)
                {
            ?>
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">اطلاعات ارسال نگردیده است.</div>
            <?php
                }
                elseif($status == 3)
                {
            ?>
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">خطای سیستمی رخ داده است، لطفا با مدیر سامانه تماس بگیرید.</div>
            <?php
                }
                elseif($status == 4)
                {
            ?>
            <div role="alert" class="alert alert-success" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">رمز عبور با موفقیت تغییر یافت.</div>
            <?php
                }
                elseif($status == 5)
                {
            ?>
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">رمز عبور قبلی صحیح نمی باشد.</div>
            <?php
                }
             ?>
        </div>
    </div>
</div>