<script src="<?php echo asset_url(); ?>ckeditor/ckeditor.js"></script>
<title><?php echo $siteTitle; ?> | ویرایش صفحات اصلی</title>
<style type="text/css">
    #states th, #states td{
        text-align: right;
    }
</style>
<div class="panel panel-success panelContent" id="loginInfo">
    <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">ویرایش صفحات اصلی</h3>
        <div class="glyphicon glyphicon-remove panelInfoBTN" id="loginInfoRemove" onclick="showPanel('loginInfo', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelInfoBTN" id="loginInfoMinus" onclick="showPanel('loginInfo', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="loginInfoPlus" onclick="showPanel('loginInfo', 'p')"></div>
        <div class="clearB"></div>
    </div>
    <div class="panel-body panelBodyText" id="loginInfoBody" style="width: 100%; text-align: right; margin: 0 auto;">
        <div style="width: 1000px; height: auto; direction: rtl; margin: 0 auto;">

            <?php
                if($pages)
                {

                ?>

                <form class="form-horizontal" role="form" method="post">
                    <div class="form-group">
                        <label for="inputOpuName" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">تیتر صفحه:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtTitle" name="txtTitle" style="font-family: 'BYekan';" value="<?php echo $pages['title']; ?>" placeholder="تیتر صفحه">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputHeadOffice" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">متن صفحه:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="8" style="height: 800px;" id="editPage" name="txtContent"><?php echo htmlCoding($pages['content'], 2); ?></textarea>
                            <a xmlns="http://www.w3.org/1999/xhtml" onclick="window.open('<?php echo base_url() . 'admin/manage_pages/uploadImages'; ?>','popup','width=550,height=250,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=50,top=0'); return false" ?="" href="<?php echo base_url() . 'admin/manage_pages/uploadImages'; ?>" style="font-size:14px;">افزودن تصویر</a>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success" style="float: left;">ذخیره اطلاعات</button>
                    <button type="button" class="btn btn-warning" style="float: left; margin-left: 10px;" onclick="redirect('admin/manage_pages');">بازگشت</button>
                </form>

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

<script>
CKEDITOR.replace('editPage');
</script>