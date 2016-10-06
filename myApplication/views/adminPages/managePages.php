<title><?php echo $siteTitle; ?> | مدیریت صفحات اصلی سامانه</title>
<style type="text/css">
#states th, #states td{
    text-align: right;
}
</style>
<div class="panel panel-success panelContent" id="loginInfo">
      <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">مدیریت صفحات اصلی سامانه</h3>
        <div class="glyphicon glyphicon-remove panelInfoBTN" id="loginInfoRemove" onclick="showPanel('loginInfo', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelInfoBTN" id="loginInfoMinus" onclick="showPanel('loginInfo', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="loginInfoPlus" onclick="showPanel('loginInfo', 'p')"></div>
        <div class="clearB"></div>
      </div>
      <div class="panel-body panelBodyText" id="loginInfoBody" style="width: 100%; text-align: right; margin: 0 auto;">
            <div style="width: 100%; height: auto; direction: rtl; margin: 0 auto;">
                
                    <?php
                        if(is_array($pages) && count($pages) > 0)
                        {
                            
                    ?>
                    <table class="table table-hover table-striped" style="direction: rtl;" id="states">
                      <thead style="direction: rtl; text-align: right;">
                        <tr>
                          <th style="width: 10%;">ردیف</th>
                          <th style="width: 40%;">تیتر صفحه</th>
                          <th style="width: 30%; text-align: right;">آخرین بروزرسانی</th>
                          <th style="width: 20%; text-align: center;">امکانات</th>
                        </tr>
                      </thead>
                      <tbody>
                    <?php
                            for($i = 0, $n = 1; $i < count($pages); $i++)
                            {
                                
                    ?>
                        <tr>
                          <td style="width: 10%; font-weight: normal;"><?php echo $n; ?></td>
                          <th style="width: 40%; font-weight: normal;"><?php echo $pages[$i]['title']; ?></th>
                          <th style="width: 30%; text-align: right; font-weight: normal;"><?php echo pdate('Y/m/d - H:i', $pages[$i]['lastUpdateTime']); ?></th>
                          <td style="width: 20%; text-align: center; font-weight: normal;">
                            <div class="glyphicon glyphicon-pencil" style="color: black; cursor: pointer;" rel="tooltip" data-placement="top" title="ویرایش صفحه" onclick="window.location = '<?php echo base_url() . 'admin/manage_pages/editPage/' . $pages[$i]['id']; ?>'"></div>
                          </td>
                        </tr>
                    <?php
                                $n++;
                            }
                     ?>
                      </tbody>
                    </table>
                    
                    <?php
                        }
                        else
                        {
                    ?>
                            <div class="alert alert-warning alert-dismissible fade in" role="alert" id="myAlert" style="font-family: 'webYekan'; margin: 0 auto; margin-top: 50px; text-align: center; width: 60%; font-size: 14px;">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              هیچ صفحه ای یافت نشد...!
                            </div>
                    <?php
                        }
                     ?>
  
                </div>
                
                
                
            </div>
      </div>
</div>