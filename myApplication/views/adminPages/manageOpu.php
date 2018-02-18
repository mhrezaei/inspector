<title><?php echo $siteTitle; ?> | مدیریت واحد های فراهم آوری</title>
<style type="text/css">
#states th, #states td{
    text-align: right;
}
</style>
<div class="panel panel-success panelContent" id="loginInfo">
      <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">مدیریت واحد های فراهم آوری <small style="font-size: 12px;">(تعداد کل مراکز فراهم آوری یافت شده: <?php echo $totalOpu; ?>)</small></h3>
        <div class="glyphicon glyphicon-remove panelInfoBTN" id="loginInfoRemove" onclick="showPanel('loginInfo', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelInfoBTN" id="loginInfoMinus" onclick="showPanel('loginInfo', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="loginInfoPlus" onclick="showPanel('loginInfo', 'p')"></div>
        <div class="clearB"></div>
      </div>
      <div class="panel-body panelBodyText" id="loginInfoBody" style="width: 100%; text-align: right; margin: 0 auto;">
            <div style="width: 100%; height: auto; direction: rtl; margin: 0 auto; padding: 20px; overflow-x: scroll;">
                
                <div style="height: auto; margin: 20px auto; text-align: right; width: 100%;">

                    <form class="form-inline" role="form" method="post">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label for="inputOpuFilter" class="control-label col-sm-2" style=" line-height: 28px">فیلترکردن نتایج</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="inputOpuFilter" id="inputOpuFilter" style="width: 100%;"  value="<?php if($filter){echo $filter;} ?>" placeholder="نام واحد، نام مسئول واحد، شماره موبایل، شماره تماس، نام کاربری ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary btn-md" style="margin: 0px 15px 20px auto;">جستجو</button>

                                            <button type="button" class="btn btn-warning btn-md" style=" margin: 0px 5px 20px auto;" onclick="window.location='<?php echo base_url() ?>admin/manage_opu';">حذف فیلتر</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-success btn-md" style="margin: 0px 5px 20px auto; float: left;" onclick="insertState('cbState', false);" data-toggle="modal" data-target="#addOpuModal">افزودن واحد فراهم آوری جدید</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="clearB"></div>
                
                    <?php
                        if(is_array($opu) && count($opu) > 0)
                        {
                            
                    ?>
                    <table class="table table-hover table-striped" style="direction: rtl;" id="states">
                      <thead style="direction: rtl; text-align: right;">
                        <tr>
                          <th style="width: 5%;">ردیف</th>
                          <th style="width: 14%;">نام واحد فراهم آوری</th>
                          <th style="width: 10%; text-align: right;">نام مسئول واحد</th>
                          <th style="width: 8%; text-align: center;">موبایل</th>
                          <th style="width: 8%; text-align: center;">تلفن</th>
                          <th style="width: 5%; text-align: center;">نام کاربری</th>
                          <th style="width: 5%; text-align: center;"> بازرس</th>
                          <th style="width: 5%; text-align: center;">تیپ</th>
                          <th style="width: 10%; text-align: center;">جمعیت</th>
                          <th style="width: 4%; text-align: center;">PMP</th>
                          <th style="width: 8%; text-align: center;">استان</th>
                          <th style="width: 8%; text-align: center;">شهر</th>
                          <th style="width: 10%; text-align: center;">امکانات</th>
                        </tr>
                      </thead>
                      <tbody>
                    <?php
                            for($i = 0; $i < count($opu); $i++)
                            {
                                
                    ?>
                        <tr>
                          <td style="width: 5%; font-weight: normal;"><?php echo $row++; ?></td>
                          <td style="width: 14%; font-weight: normal;" id="opuName<?php echo $opu[$i]['id']; ?>"><?php echo $opu[$i]['name']; ?></td>
                          <td style="width: 10%; text-align: right; font-weight: normal;"><?php echo $opu[$i]['headOffice']; ?></td>
                          <td style="width: 8%; text-align: center; font-weight: normal;"><?php echo $opu[$i]['mobile']; ?></td>
                          <td style="width: 8%; text-align: center; font-weight: normal;"><?php echo $opu[$i]['telephone']; ?></td>
                          <td style="width: 5%; text-align: center; font-weight: normal;"><?php echo $opu[$i]['username']; ?></td>
                          <td style="width: 4%; text-align: center; font-weight: normal;"><?php echo $opu[$i]['insNum']; ?></td>
                            <td style="width: 5%; text-align: center;"><?php echo $opu[$i]['type']; ?></td>
                            <td style="width: 10%; text-align: center;"><?php echo number_format($opu[$i]['population']); ?></td>
                            <td style="width: 4%; text-align: center;"><?php echo $opu[$i]['pmp']; ?></td>
                          <td style="width: 8%; text-align: center; font-weight: normal;"><?php echo $opu[$i]['stateName']; ?></td>
                          <td style="width: 8%; text-align: center; font-weight: normal;"><?php echo $opu[$i]['cityName']; ?></td>
                          <td style="width: 10%; text-align: center; font-weight: normal;">
                            <?php
                                if($opu[$i]['status'] == 1)
                                {
                            ?>
                            <div class="glyphicon glyphicon-off" style=" color: #27c24b; cursor: pointer;" rel="tooltip" data-placement="top" title="غیرفعال کردن واحد" data-toggle="modal" data-target=".bs-example-modal-sm" onclick="inactiveOpu('<?php echo $opu[$i]['id']; ?>', 'inactive');"></div>
                            <?php
                                }
                                else
                                {
                            ?>
                            <div class="glyphicon glyphicon-off" style=" color: gray; cursor: pointer;" rel="tooltip" data-placement="top" title="فعال کردن واحد" data-toggle="modal" data-target=".bs-example-modal-sm" onclick="inactiveOpu('<?php echo $opu[$i]['id']; ?>', 'active');"></div>
                            <?php
                                }
                            ?>
                            <div class="glyphicon glyphicon-pencil" style=" color: black; cursor: pointer;" rel="tooltip" data-placement="top" title="ویرایش واحد" data-toggle="modal" data-target="#editOpuModal" onclick="editOPU('<?php echo $opu[$i]['id']; ?>');"></div>
                            <div class="glyphicon glyphicon-remove" style=" color: red; cursor: pointer;" rel="tooltip" data-placement="top" title="حذف واحد" data-toggle="modal" data-target=".bs-example-modal-sm" onclick="inactiveOpu('<?php echo $opu[$i]['id']; ?>', 'delete');"></div>
                          </td>
                        </tr>
                    <?php
                            }
                     ?>
                      </tbody>
                    </table>
                    
                    <div style="width: 90%; margin: 0 auto; text-align: center;">
                    <?php
                        echo pagination($totalOpu, $page, 30, 4, base_url() . 'admin/manage_opu/index/');
                    ?>
                    </div>
                    
                    <?php
                        }
                        else
                        {
                            echo '<div style="width: 90%; margin: 0 auto; text-align: center;"> تاکنون واحد فراهم آوری ثبت نگردیده است. </div>';
                        }
                     ?>
  
                </div>
                
                
                
            </div>
      </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addOpuModal" tabindex="-1" role="dialog" aria-labelledby="addOpuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="addOpuModalabel" style="font-family: 'BYekan';">افزودن واحد فراهم آوری جدید</h4>
      </div>
      <div class="modal-body" id="addOpuModalBodyData">
            
            <div id="addOpuForm">
                <form class="form-horizontal" role="form">
                  <div class="form-group">
                    <label for="inputOpuName" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نام واحد:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputOpuName" style="font-family: 'BYekan';" value="" placeholder="نام واحد فراهم آوری">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputHeadOffice" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نام مدیر:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputHeadOffice" style="font-family: 'BYekan';" value="" placeholder="نام مدیر واحد فراهم آوری">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputMobile" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">شماره همراه:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputMobile" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="شماره همراه" maxlength="11">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputTelephone" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">شماره ثابت:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputTelephone" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="شماره ثابت همراه با کد شهر" maxlength="11">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputUserName" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نام کاربری:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputUserName" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="نام کاربری واحد فراهم آوری با حروف انگلیسی">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">رمز عبور:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputPassword" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="رمز عبور حداقل 6 کاراکتر">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="cbState" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">استان:</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="cbState" style="font-family: 'BYekan'; direction: rtl;" onchange="insertcity('cbCity', 'cbState', false);">
                          <option value="0">انتخاب کنید...</option>
                        </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="cbCity" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">شهر:</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="cbCity" style="font-family: 'BYekan'; direction: rtl;" disabled="disabled">
                          <option value="0">انتخاب کنید...</option>
                        </select>
                    </div>
                  </div>

                <div class="form-group">
                        <label for="cbType" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">تیپ:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="cbType" style="font-family: 'BYekan'; direction: rtl;">
                                <option value="0">انتخاب کنید...</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <label for="cbGrade" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">گرید:</label>-->
<!--                        <div class="col-sm-10">-->
<!--                            <select class="form-control" id="cbGrade" style="font-family: 'BYekan'; direction: rtl;">-->
<!--                                <option value="0">انتخاب کنید...</option>-->
<!--                                <option value="1">1</option>-->
<!--                                <option value="2">2</option>-->
<!--                                <option value="3">3</option>-->
<!--                                <option value="4">4</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->

                    <div class="form-group">
                        <label for="inputPopulation" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">جمعیت:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPopulation" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="جمعیت تحت پوشش">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPmp" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">PMP:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPmp" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="0 ~ 100">
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="progress" id="addOpuModalLoading" style="display: none;">
                  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                    <span class="sr-only">70% Complete</span>
                  </div>
            </div>
            
            
            <div role="alert" class="alert alert-success" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="successAlert1">واحد جدید با موفقیت ثبت گردید.</div>
            
            
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert1">خطایی در ثبت واحد رخ داده است، لطفا دوباره سعی نمائید.</div>
            
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert2">این نام کاربری قبلا ثبت شده است.</div>
            
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert3">اطلاعات را به دقت وارد نمائید.</div>
            
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert4">اطلاعات به سامانه ارسال نشده است.</div>
            
            
             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" style="float: left; font-family: 'BYekan';" id="saveBTN" onclick="registerNewOPU();">افزودن واحد فراهم آوری</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left; font-family: 'BYekan';">انصراف</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editOpuModal" tabindex="-1" role="dialog" aria-labelledby="editOpuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="editOpuModalabel" style="font-family: 'BYekan';">ویرایش واحد فراهم آوری</h4>
      </div>
      <div class="modal-body" id="editOpuModalBodyData">
            
            <div id="editOpuForm">
                <form class="form-horizontal" role="form">
                  <div class="form-group">
                    <label for="inputEditOpuName" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نام واحد:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEditOpuName" style="font-family: 'BYekan';" value="" placeholder="نام واحد فراهم آوری">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEditHeadOffice" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نام مدیر:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEditHeadOffice" style="font-family: 'BYekan';" value="" placeholder="نام مدیر واحد فراهم آوری">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEditMobile" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">شماره همراه:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEditMobile" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="شماره همراه" maxlength="11">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEditTelephone" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">شماره ثابت:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEditTelephone" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="شماره ثابت همراه با کد شهر" maxlength="11">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEditUserName" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نام کاربری:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEditUserName" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="نام کاربری واحد فراهم آوری با حروف انگلیسی" disabled="disabled">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEditPassword" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">رمز عبور:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEditPassword" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="در صورت وارد نمودن رمز، جایگزین رمز قبلی می گردد">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="cbEditState" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">استان:</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="cbEditState" style="font-family: 'BYekan'; direction: rtl;" onchange="insertcity('cbEditCity', 'cbEditState', false);">
                          <option value="0">انتخاب کنید...</option>
                        </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="cbEditCity" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">شهر:</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="cbEditCity" style="font-family: 'BYekan'; direction: rtl;" disabled="disabled">
                          <option value="0">انتخاب کنید...</option>
                        </select>
                    </div>
                  </div>

                    <div class="form-group">
                        <label for="cbEditType" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">تیپ:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="cbEditType" style="font-family: 'BYekan'; direction: rtl;">
                                <option value="0">انتخاب کنید...</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <label for="cbEditGrade" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">گرید:</label>-->
<!--                        <div class="col-sm-10">-->
<!--                            <select class="form-control" id="cbEditGrade" style="font-family: 'BYekan'; direction: rtl;">-->
<!--                                <option value="0">انتخاب کنید...</option>-->
<!--                                <option value="1">1</option>-->
<!--                                <option value="2">2</option>-->
<!--                                <option value="3">3</option>-->
<!--                                <option value="4">4</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->

                    <div class="form-group">
                        <label for="inputEditPopulation" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">جمعیت:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEditPopulation" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="جمعیت تحت پوشش">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEditPmp" class="col-sm-2 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">PMP:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEditPmp" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="0 ~ 100">
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="progress" id="OpuEditModalLoading" style="display: none;">
                  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                    <span class="sr-only">70% Complete</span>
                  </div>
            </div>
            
            
            <div role="alert" class="alert alert-success" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="successAlertEdit1">واحد فراهم آوری با موفقیت ویرایش گردید.</div>
            
            <div role="alert" class="alert alert-warning" style="padding: 10px; width: 70%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="warningAlert1">توجه فرمائید در صورت تغییر شهر یا استان آمار واحد مربوطه صفر می شود.</div>
            
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertEdit1">اطلاعاتی جهت نمایش وجود ندارد.</div>
            
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertEdit2">خطایی در ثبت اطلاعات به وحود آمده، دوباره تلاش کنید..</div>
            
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertEdit3">اطلاعات را به دقت وارد نمائید.</div>
            
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertEdit4">اطلاعات به سامانه ارسال نشده است.</div>
            
            
             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" style="float: left; font-family: 'BYekan';" id="saveBTNEdit">ویرایش واحد</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left; font-family: 'BYekan';">انصراف</button>
      </div>
    </div>
  </div>
</div>

<!-- in active or avtice inspector -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h5 class="modal-title" id="deleteInspectorModallabel" style="font-family: 'BYekan'; font-weight: normal;">تغییر وضعیت واحد فراهم آوری</h5>
      </div>
      <div class="modal-body">
        
        <div style="width: 90%; margin: 0 auto; text-align: justify; font-family: 'BNazanin', Tahoma; font-size: 16px;" id="activeQuestion"></div>
        
        <div class="progress" id="activeInspectorModalLoading" style="display: none;">
            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                <span class="sr-only">70% Complete</span>
            </div>
        </div>
        
        <div role="alert" class="alert alert-danger" style="padding: 10px; width: 100%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertStatus1">اطلاعات این واحد در دسترس نیست.</div>
        
        <div role="alert" class="alert alert-danger" style="padding: 10px; width: 100%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertStatus2">امکان ویرایش این واحد نمی باشد.</div>
        
        <div role="alert" class="alert alert-success" style="padding: 10px; width: 100%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertStatus3">وضعیت واحد با موفقیت تغییر کرد.</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="float: left; font-family: 'BYekan'; font-weight: normal;">انصراف</button>
        <button type="button" class="btn btn-warning btn-sm" style="float: left; font-family: 'BYekan'; font-weight: normal;" id="inactiveBTN">تغییر وضعیت واحد</button>
        <button type="button" class="btn btn-danger btn-sm" style="float: left; font-family: 'BYekan'; font-weight: normal; display: none;" id="inactiveDeleteBTN">حذف کردن واحد</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- in active or avtice inspector -->