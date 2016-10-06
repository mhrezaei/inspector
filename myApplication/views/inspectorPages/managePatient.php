<title><?php echo $siteTitle; ?> | لیست همه  بیماران</title>
<style type="text/css">
    #states th, #states td{
        text-align: right;
    }
</style>
<div class="panel panel-success panelContent" id="loginInfo">
    <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">لیست بیماران <small style="font-size: 12px;">(کل بیماران یافت شده: <?php echo $pt['totalRecords']; ?>)</small></h3>
        <div class="glyphicon glyphicon-remove panelInfoBTN" id="loginInfoRemove" onclick="showPanel('loginInfo', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelInfoBTN" id="loginInfoMinus" onclick="showPanel('loginInfo', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="loginInfoPlus" onclick="showPanel('loginInfo', 'p')"></div>
        <div class="clearB"></div>
    </div>
    <div class="panel-body panelBodyText" id="loginInfoBody" style="width: 100%; text-align: right; margin: 0 auto;">
        <div style="width: 100%; height: auto; direction: rtl; margin: 0 auto;">

            <?php
                $this->view('inspectorPages/patientsSearchForm');
            ?>
            <div class="clearB"></div>

            <?php
                $this->view('publicPages/patientsTable');
            ?>

        </div>



    </div>
</div>
</div>