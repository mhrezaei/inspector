<title><?php echo $siteTitle; ?> | مدیریت بازرسین</title>
<style type="text/css">
    #states th, #states td{
        text-align: right;
    }
</style>
<div class="panel panel-success panelContent" id="loginInfo">
    <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">مدیریت بازرسین <small style="font-size: 12px;">(تعداد کل بازرس های یافت شده: <?php echo $inspector['totalInspector']; ?>)</small></h3>
        <div class="glyphicon glyphicon-remove panelInfoBTN" id="loginInfoRemove" onclick="showPanel('loginInfo', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelInfoBTN" id="loginInfoMinus" onclick="showPanel('loginInfo', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="loginInfoPlus" onclick="showPanel('loginInfo', 'p')"></div>
        <div class="clearB"></div>
    </div>
    <div class="panel-body panelBodyText" id="loginInfoBody" style="width: 100%; text-align: right; margin: 0 auto;">
        <div style="width: 100%; height: auto; direction: rtl; margin: 0 auto;">

            <div style="height: auto; margin: 0px auto; text-align: right; width: 100%;">
                <form style="width: 98%" class="form-inline" role="form" method="get">
                    <div class="form-group" style="float: right;">
                        <label for="inputInspectorFilter" class="control-label" style="float: right; font-family: 'BYekan'; font-weight: normal; width:70px; font-size: 14px; line-height: 28px;">جستجو: </label>
                        <div style="float: right; width: 250px;">
                            <input type="text" class="form-control" name="inputInspectorFilter" id="inputInspectorFilter" style="font-family: 'BYekan'; width: 250px;" value="<?php echo $this->input->get('inputInspectorFilter'); ?>" placeholder="نام بازرس، کدملی یا شماره موبایل ...">
                            <input type="hidden" class="form-control" name="searchTools" value="true">
                        </div>
                    </div>
                    <div class="form-group" style="float: right;">
                        <label for="cbOpu" class="control-label" style="float: right; font-family: 'BYekan'; font-weight: normal; width: 100px; font-size: 14px; line-height: 28px; margin-right: 15px;">واحد فراهم آوری: </label>
                        <div style="float: right; width: 275px;">
                            <select class="form-control" id="cbOpu" name="cbOpu" style="font-family: 'BYekan'; direction: rtl; width: 275px;">
                                <option value="0">انتخاب کنید...</option>
                                <?php
                                    if(is_array($opu) && count($opu) > 0)
                                    {
                                        for($i = 0; $i < count($opu); $i++)
                                        {
                                            if($inspector['isOpu'] == $opu[$i]['id'])
                                            {
                                                $selected = 'selected="selected"';
                                            }
                                            else
                                            {
                                                $selected = '';
                                            }
                                            echo '<option value="' . $opu[$i]['id'] . '" ' . $selected . '>' . $opu[$i]['name'] . '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="clearB"></div>
                    <div class="form-group" style="float: right; margin-top: 15px;">
                        <label for="cbInspectorType" class="control-label" style="float: right; font-family: 'BYekan'; font-weight: normal; width: 70px; font-size: 14px; line-height: 28px;">نوع بازرسی: </label>
                        <div style="float: right; width: 150px;">
                            <select class="form-control" id="cbInspectorType" name="cbInspectorType" style="font-family: 'BYekan'; direction: rtl; width: 150px;">
                                <option value="0">انتخاب کنید...</option>
                                <option value="1" <?php if($this->input->get('cbInspectorType') == 1){echo 'selected="selected"';} ?>>حضوری</option>
                                <option value="2" <?php if($this->input->get('cbInspectorType') == 2){echo 'selected="selected"';} ?>>تلفنی</option>
                                <option value="3" <?php if($this->input->get('cbInspectorType') == 3){echo 'selected="selected"';} ?>>حضوری، تلفنی</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="float: right; margin-top: 15px;">
                        <label for="cbOrderBy" class="control-label" style="float: right; font-family: 'BYekan'; font-weight: normal; width: 55px; font-size: 14px; line-height: 28px; margin-right: 15px;">چیدمان: </label>
                        <div style="float: right; width: 150px;">
                            <select class="form-control" id="cbOrderBy" name="cbOrderBy" style="font-family: 'BYekan'; direction: rtl; width: 150px;">
                                <option value="0">انتخاب کنید...</option>
                                <option value="ASC" <?php if($this->input->get('cbOrderBy') == 'ASC'){echo 'selected="selected"';} ?>>صعودی</option>
                                <option value="DESC" <?php if($this->input->get('cbOrderBy') == 'DESC'){echo 'selected="selected"';} ?>>نزولی</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md" style="margin: 0px 15px 20px auto; float: right; margin-top: 15px;">جستجو</button>

                    <button type="button" class="btn btn-warning btn-md" style="float: right; margin: 0px 5px 20px auto; margin-top: 15px;" onclick="window.location='<?php echo base_url() ?>admin/manage_inspectors';">حذف فیلتر</button>

                    <button type="button" class="btn btn-success btn-md" style="margin: 0px 5px 20px auto; float: right; margin-top: 15px;" onclick="addNewInspector();" data-toggle="modal" data-target="#addInspectorModal">افزودن بازرس جدید</button>

                </form>
            </div>
            <div class="clearB"></div>

            <?php
                if(is_array($inspector['ins']) && count($inspector['ins']) > 0)
                {

                ?>
                <table class="table table-hover table-striped" style="direction: rtl;" id="states">
                    <thead style="direction: rtl; text-align: right;">
                        <tr>
                            <th style="width: 5%;">ردیف</th>
                            <th style="width: 30%;">نام بازرس</th>
                            <th style="width: 10%; text-align: center;">کد ملی</th>
                            <th style="width: 10%; text-align: center;">موبایل</th>
                            <th style="width: 10%; text-align: center;">نوع بازرسی</th>
                            <th style="width: 25%; text-align: right;">نام واحد فراهم آوری</th>
                            <th style="width: 10%; text-align: center;">امکانات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for($i = 0, $n = 1; $i < count($inspector['ins']); $i++)
                            {

                            ?>
                            <tr>
                                <td style="width: 5%; font-weight: normal;"><?php echo $n; ?></td>
                                <th style="width: 30%; font-weight: normal;" id="insName<?php echo $inspector['ins'][$i]['id']; ?>"><?php echo $inspector['ins'][$i]['name']; ?></th>
                                <th style="width: 10%; text-align: center; font-weight: normal;"><?php echo $inspector['ins'][$i]['nationalCode']; ?></th>
                                <th style="width: 10%; text-align: center; font-weight: normal;"><?php echo $inspector['ins'][$i]['mobile']; ?></th>
                                <th style="width: 10%; text-align: center; font-weight: normal;">
                                    <?php if($inspector['ins'][$i]['type'] == 1)
                                            {
                                                echo 'حضوری';
                                            }
                                            elseif($inspector['ins'][$i]['type'] == 2)
                                            {
                                                echo 'تلفنی';
                                            }
                                            elseif($inspector['ins'][$i]['type'] == 3)
                                            {
                                                echo 'تلفنی، حضوری';
                                            }
                                   ?>
                                </th>
                                <th style="width: 25%; text-align: right; font-weight: normal;"><?php echo $inspector['ins'][$i]['opuName']; ?></th>
                                <td style="width: 10%; text-align: center; font-weight: normal;">
                                    
                                    <?php
                                        if($inspector['ins'][$i]['status'] == 1)
                                        {
                                    ?>
                                    <div class="glyphicon glyphicon-off" style="color: green; cursor: pointer;" rel="tooltip" data-placement="top" title="غیر فعال کردن بازرس" data-toggle="modal" data-target=".bs-example-modal-sm" onclick="inactiveInspector('<?php echo $inspector['ins'][$i]['id']; ?>', 'inactive');"></div>
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                    <div class="glyphicon glyphicon-off" style="color: gray; cursor: pointer;" rel="tooltip" data-placement="top" title="فعال کردن بازرس" data-toggle="modal" data-target=".bs-example-modal-sm" onclick="inactiveInspector('<?php echo $inspector['ins'][$i]['id']; ?>', 'active');"></div>
                                    <?php
                                        }
                                     ?>
                                    <div class="glyphicon glyphicon-pencil" style="color: black; cursor: pointer;" rel="tooltip" data-placement="top" title="ویرایش بازرس" data-toggle="modal" data-target="#editInspectorModal" onclick="editInspector('<?php echo $inspector['ins'][$i]['id']; ?>');"></div>
                                    
                                    <div class="glyphicon glyphicon-remove" style="color: red; cursor: pointer;" rel="tooltip" data-placement="top" title="حذف کردن بازرس" data-toggle="modal" data-target=".bs-example-modal-sm" onclick="inactiveInspector('<?php echo $inspector['ins'][$i]['id']; ?>', 'delete');"></div>
                                </td>
                            </tr>
                            <?php
                                $n++;
                            }
                        ?>
                    </tbody>
                </table>

                <div style="width: 90%; margin: 0 auto; text-align: center;">
                    <?php
                        echo pagination($inspector['totalInspector'], $inspector['page'], 30, 4, base_url() . 'admin/manage_inspectors/index/' . $inspector['url'] . 'page=');
                    ?>
                </div>

                <?php
                }
                else
                {
                    echo '<div style="width: 90%; margin: 0 auto; text-align: center;">بازرسی یافت نگردید.</div>';
                }
            ?>

        </div>



    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="addInspectorModal" tabindex="-1" role="dialog" aria-labelledby="addInspectorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="addInspectorModallabel" style="font-family: 'BYekan';">افزودن بازرس جدید</h4>
            </div>
            <div class="modal-body" id="addInspectorModalBodyData">

                <div id="addInspectorModalForm">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="inputInspectorName" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نام بازرس<span style="color: red;"> *</span>:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputInspectorName" style="font-family: 'BYekan';" value="" placeholder="نام بازرس">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputInspectorNationalCode" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">کدملی<span style="color: red;"> *</span>:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputInspectorNationalCode" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="کد ملی" maxlength="10">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputInspectorMobile" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">شماره موبایل<span style="color: red;"> *</span>:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputInspectorMobile" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="شماره موبایل" maxlength="11">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputInspectorPassword" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">رمز عبور<span style="color: red;"> *</span>:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputInspectorPassword" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="رمز عبور حداقل 6 کاراکتر" maxlength="20">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cbInpectorOpu" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">مرکز فراهم آوری<span style="color: red;"> *</span>:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbInpectorOpu" style="font-family: 'BYekan'; direction: rtl;">
                                    <option value="0">انتخاب کنید...</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="chInspectorType1" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نوع بازرسی<span style="color: red;"> *</span>:</label>
                            <div class="col-sm-9" style="direction: ltr;">
                                  <label class="checkbox-inline" style="font-family: 'BYekan'; font-weight: normal;">
                                    <input type="checkbox" id="chInspectorType1" value="1"> حضوری
                                  </label>
                                  <label class="checkbox-inline" style="font-family: 'BYekan'; font-weight: normal;">
                                    <input type="checkbox" id="chInspectorType2" value="2"> تلفنی
                                  </label>
                             </div>
                        </div>
                    </form>
                </div>

                <div class="progress" id="addInspectorModalLoading" style="display: none;">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                        <span class="sr-only">70% Complete</span>
                    </div>
                </div>


                <div role="alert" class="alert alert-success" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="successAlert1">بازرس مورد نظر با موفقیت ثبت گردید.</div>


                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert1">خطایی در ثبت بازرس رخ داده است، لطفا دوباره سعی نمائید.</div>

                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert3">اطلاعات را به دقت وارد نمائید.</div>

                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert4">اطلاعات به سامانه ارسال نشده است.</div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="float: left; font-family: 'BYekan';" id="saveBTN">افزودن بازرس</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left; font-family: 'BYekan';">انصراف</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editInspectorModal" tabindex="-1" role="dialog" aria-labelledby="editInspectorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="editInspectorModallabel" style="font-family: 'BYekan';">ویرایش بازرس</h4>
            </div>
            <div class="modal-body" id="editInspectorModalBodyData">

                <div id="editInspectorModalForm">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="inputEditInspectorName" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نام بازرس<span style="color: red;"> *</span>:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEditInspectorName" style="font-family: 'BYekan';" value="" placeholder="نام بازرس">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEditInspectorNationalCode" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">کدملی<span style="color: red;"> *</span>:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEditInspectorNationalCode" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="کد ملی" maxlength="10">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEditInspectorMobile" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">شماره موبایل<span style="color: red;"> *</span>:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEditInspectorMobile" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="شماره موبایل" maxlength="11">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEditInspectorPassword" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">رمز عبور<span style="color: red;"> *</span>:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEditInspectorPassword" style="font-family: 'BYekan'; direction: ltr;" value="" placeholder="رمز عبور حداقل 6 کاراکتر" maxlength="20">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cbEditInpectorOpu" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">مرکز فراهم آوری<span style="color: red;"> *</span>:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbEditInpectorOpu" style="font-family: 'BYekan'; direction: rtl;">
                                    <option value="0">انتخاب کنید...</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="chEditInspectorType1" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نوع بازرسی<span style="color: red;"> *</span>:</label>
                            <div class="col-sm-9" style="direction: ltr;">
                                  <label class="checkbox-inline" style="font-family: 'BYekan'; font-weight: normal;">
                                    <input type="checkbox" id="chEditInspectorType1" value="1"> حضوری
                                  </label>
                                  <label class="checkbox-inline" style="font-family: 'BYekan'; font-weight: normal;">
                                    <input type="checkbox" id="chEditInspectorType2" value="2"> تلفنی
                                  </label>
                             </div>
                        </div>
                    </form>
                </div>

                <div class="progress" id="editInspectorModalLoading" style="display: none;">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                        <span class="sr-only">70% Complete</span>
                    </div>
                </div>


                <div role="alert" class="alert alert-success" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="successAlertEdit1">بازرس مورد نظر با موفقیت ویرایش گردید.</div>


                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertEdit1">اطلاعاتی یافت نشد.</div>
                
                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertEdit2">خطایی در ویرایش بازرس رخ داده است، لطفا دوباره سعی نمائید.</div>

                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertEdit3">اطلاعات را به دقت وارد نمائید.</div>

                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertEdit4">اطلاعات به سامانه ارسال نشده است.</div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="float: left; font-family: 'BYekan';" id="saveBTNEdit">ویرایش بازرس</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left; font-family: 'BYekan';">انصراف</button>
            </div>
        </div>
    </div>
</div>




<!-- in active or avtice inspector -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h5 class="modal-title" id="deleteInspectorModallabel" style="font-family: 'BYekan'; font-weight: normal;">تغییر وضعیت بازرس</h5>
      </div>
      <div class="modal-body">
        
        <div style="width: 90%; margin: 0 auto; text-align: justify; font-family: 'BNazanin', Tahoma; font-size: 16px;" id="activeQuestion"></div>
        
        <div class="progress" id="activeInspectorModalLoading" style="display: none;">
            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                <span class="sr-only">70% Complete</span>
            </div>
        </div>
        
        <div role="alert" class="alert alert-danger" style="padding: 10px; width: 100%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertStatus1">شما مجاز به تغییر وضعیت این بازرس نمی باشید.</div>
        
        <div role="alert" class="alert alert-danger" style="padding: 10px; width: 100%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertStatus2">امکان ویرایش این بازرس نمی باشد.</div>
        
        <div role="alert" class="alert alert-success" style="padding: 10px; width: 100%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertStatus3">وضعیت بازرس با موفقیت تغییر کرد.</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="float: left; font-family: 'BYekan'; font-weight: normal;">انصراف</button>
        <button type="button" class="btn btn-warning btn-sm" style="float: left; font-family: 'BYekan'; font-weight: normal;" id="inactiveBTN">تغییر وضعیت بازرس</button>
        <button type="button" class="btn btn-danger btn-sm" style="float: left; font-family: 'BYekan'; font-weight: normal; display: none;" id="inactiveDeleteBTN">حذف کردن بازرس</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- in active or avtice inspector -->