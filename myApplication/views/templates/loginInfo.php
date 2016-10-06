<?php
    if($isUserLogin == 1)
    {
?>
<div class="panel panel-info panelContent" id="loginInfo">
      <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">اطلاعات ورود شما!</h3>
        <div class="glyphicon glyphicon-remove panelInfoBTN" id="loginInfoRemove" onclick="showPanel('loginInfo', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelInfoBTN" id="loginInfoMinus" onclick="showPanel('loginInfo', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="loginInfoPlus" onclick="showPanel('loginInfo', 'p')"></div>
        <div class="clearB"></div>
      </div>
      <div class="panel-body panelBodyText" id="loginInfoBody">
        <span>آخرین ورود موفق شما در تاریخ </span>
        <span style="font-weight: bold;"><?php echo pdate('l، j F Y', $userLogin['time']); ?> </span>
        <span>در ساعت </span>
        <span style="font-weight: bold;"><?php echo pdate('H:i a', $userLogin['time']); ?> </span>
        <span>و از آدرس آی پی </span>
        <span style="font-weight: bold;"><?php echo $userLogin['ip'] ?> </span>
        <span>صورت گرفته است.</span>
        <br>
        <span>درصورتی که این ورود توسط شما صورت نگرفته است می توانید با مراجعه به </span>
        <a href="<?php echo base_url(); ?>userAuthentication/user_authentication/change_password">این صفحه</a>
        <span> رمز عبور ورود به سامانه خود را تغییر دهید.</span>
      </div>
    </div>
    
<?php
    }
?>