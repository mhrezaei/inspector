<title><?php echo $siteTitle; ?> | مدیریت بیمارستان ها</title>
<style type="text/css">
    #states th, #states td{
        text-align: right;
    }
</style>
<div class="panel panel-success panelContent" id="loginInfo">
    <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">مدیریت بیمارستان ها <small style="font-size: 12px;">(کل بیمارستان های یافت شده: <?php echo $hr['totalHospitals']; ?>)</small></h3>
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
                        <label for="inputHospitalFilter" class="control-label" style="float: right; font-family: 'BYekan'; font-weight: normal; width:50px; font-size: 14px; line-height: 28px;">جستجو: </label>
                        <div style="float: right; width: 250px;">
                            <input type="text" class="form-control" name="inputHospitalFilter" id="inputHospitalFilter" style="font-family: 'BYekan'; width: 250px;" value="<?php echo $this->input->get('inputHospitalFilter'); ?>" placeholder="نام بیمارستان">
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
                                            if($hr['isOpu'] == $opu[$i]['id'])
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
                        <label for="cbState" class="control-label" style="float: right; font-family: 'BYekan'; font-weight: normal; width: 50px; font-size: 14px; line-height: 28px;">استان: </label>
                        <div style="float: right; width: 150px;">
                            <select class="form-control" id="cbState" name="cbState" style="font-family: 'BYekan'; direction: rtl; width: 150px;" onchange="insertcity('cbCity', 'cbState', false);">
                                <option value="0">انتخاب کنید...</option>
                            </select>
                            <script>
                            <?php
                                if($hr['isState'])
                                {
                            ?>
                                $(document).ready(function(){
                                        insertState('cbState', '<?php echo $hr['isState']; ?>');
                                    <?php if($hr['isState'] AND !$hr['isCity']){ ?>    
                                        insertcity('cbCity', '<?php echo $hr['isState']; ?>', false);
                                    <?php } ?>
                                    <?php if($hr['isCity']){ ?>
                                        insertcity('cbCity', '<?php echo $hr['isState']; ?>', '<?php echo $hr['isCity']; ?>');
                                    <?php } ?>
                                });
                            <?php
                                }
                                else
                                {
                            ?>
                                insertState('cbState', false);
                            <?php
                                }
                            ?>
                            </script>
                        </div>
                    </div>
                    <div class="form-group" style="float: right; margin-top: 15px;">
                        <label for="cbCity" class="control-label" style="float: right; font-family: 'BYekan'; font-weight: normal; width: 40px; font-size: 14px; line-height: 28px; margin-right: 15px;">شهر: </label>
                        <div style="float: right; width: 150px;">
                            <select class="form-control" id="cbCity" name="cbCity" style="font-family: 'BYekan'; direction: rtl; width: 150px;" disabled="disabled">
                                <option value="0">انتخاب کنید...</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md" style="margin: 0px 15px 20px auto; float: right; margin-top: 15px;">جستجو</button>

                    <button type="button" class="btn btn-warning btn-md" style="float: right; margin: 0px 5px 20px auto; margin-top: 15px;" onclick="window.location='<?php echo base_url() ?>admin/manage_hospital';">حذف فیلتر</button>

                    <button type="button" class="btn btn-success btn-md" style="margin: 0px 5px 20px auto; float: right; margin-top: 15px;" onclick="addNewHospital();" data-toggle="modal" data-target="#addHospitalModal">افزودن بیمارستان جدید</button>

                </form>
            </div>
            <div class="clearB"></div>

            <?php
                if(is_array($hr['hospitals']) && count($hr['hospitals']) > 0)
                {

                ?>
                <table class="table table-hover table-striped" style="direction: rtl;" id="states">
                    <thead style="direction: rtl; text-align: right;">
                        <tr>
                            <th style="width: 5%;">ردیف</th>
                            <th style="width: 10%;">نام بیمارستان</th>
                            <th style="width: 10%; text-align: center;">نام واحد فراهم آوری</th>
                            <th style="width: 5%; text-align: center;">نوع</th>
                            <th style="width: 5%; text-align: center;">ICU</th>
                            <th style="width: 5%; text-align: center;">تخت ICU</th>
                            <th style="width: 5%; text-align: center;">درصد اشغال</th>
                            <th style="width: 5%; text-align: center;">جراحی اعصاب</th>
                            <th style="width: 8%; text-align: center;">مرگ سالیانه</th>
                            <th style="width: 10%; text-align: center;">مرگ سالیانه ICU</th>
                            <th style="width: 10%; text-align: center;">استان</th>
                            <th style="width: 10%; text-align: center;">شهر</th>
                            <th style="width: 8%; text-align: center;">امکانات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for($i = 0, $n = 1; $i < count($hr['hospitals']); $i++)
                            {

                            ?>
                            <tr>
                                <td style="width: 5%; font-weight: normal;"><?php echo (($hr['page'] * 30) - 30) + $n; ?></td>
                                <td style="width: 10%; font-weight: normal;" id="hospialName<?php echo $hr['hospitals'][$i]['id']; ?>"><?php echo $hr['hospitals'][$i]['name']; ?></td>
                                <td style="width: 14%; text-align: center; font-weight: normal;"><?php echo $hr['hospitals'][$i]['opuName']; ?></td>
                                <td style="width: 5%; text-align: center;">
                                    <?php
                                        if($hr['hospitals'][$i]['type'] == 1){echo 'دولتی';}
                                        elseif($hr['hospitals'][$i]['type'] == 2){echo 'خصوصی';}
                                        elseif($hr['hospitals'][$i]['type'] == 3){echo 'سایر';}
                                        else{echo '-';}
                                    ?>
                                </td>
                                <td style="width: 5%; text-align: center;">
                                    <?php
                                    if($hr['hospitals'][$i]['icu'] == 1){echo 'دارد';}
                                    elseif($hr['hospitals'][$i]['icu'] == 2){echo 'ندارد';}
                                    else{echo '-';}
                                    ?>
                                </td>
                                <td style="width: 5%; text-align: center;"><?php echo $hr['hospitals'][$i]['icuBeds']; ?></td>
                                <td style="width: 5%; text-align: center;"><?php echo $hr['hospitals'][$i]['icuBedsBusy']; ?></td>
                                <td style="width: 5%; text-align: center;">
                                    <?php
                                    if($hr['hospitals'][$i]['neuroService'] == 1){echo 'دارد';}
                                    elseif($hr['hospitals'][$i]['neuroService'] == 2){echo 'ندارد';}
                                    else{echo '-';}
                                    ?>
                                </td>
                                <?php
                                    if($hr['hospitals'][$i]['haveData'] == 1)
                                {
                                ?>
                                <td style="width: 8%; text-align: center;"><?php echo $hr['hospitals'][$i]['data']['deathPerYear'] ?></td>
                                <td style="width: 10%; text-align: center;"><?php echo $hr['hospitals'][$i]['data']['icuDeathPerYear'] ?></td>
                                <?php
                                }
                                else
                                {
                                ?>
                                    <td style="width: 8%; text-align: center;">-</td>
                                    <td style="width: 10%; text-align: center;">-</td>
                                <?php
                                }
                                ?>
                                <td style="width: 10%; text-align: center; font-weight: normal;"><?php echo $hr['hospitals'][$i]['stateName']; ?></td>
                                <td style="width: 10%; text-align: center; font-weight: normal;"><?php echo $hr['hospitals'][$i]['cityName']; ?></td>
                                <td style="width: 8%; text-align: center; font-weight: normal;">
                                    <div class="glyphicon glyphicon-pencil" style="color: black; cursor: pointer;" rel="tooltip" data-placement="top" title="ویرایش بیمارستان" data-toggle="modal" data-target="#editHospitalModal" onclick="editHospital('<?php echo $hr['hospitals'][$i]['id']; ?>');"></div>
                                    <div class="glyphicon glyphicon-remove" style="color: red; cursor: pointer;" rel="tooltip" data-placement="top" title="حذف کردن بیمارستان" data-toggle="modal" data-target="#deleteHospitalModal" onclick="deleteHospital('<?php echo $hr['hospitals'][$i]['id']; ?>');"></div>
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
                        echo pagination($hr['totalHospitals'], $hr['page'], 30, 4, base_url() . 'admin/manage_hospital/index/' . $hr['url'] . 'page=');
                    ?>
                </div>

                <?php
                }
                else
                {
                    echo '<div style="width: 90%; margin: 0 auto; text-align: center;"> تاکنون مرکز فراهم آوری ثبت نگردیده است. </div>';
                }
            ?>

        </div>



    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="addHospitalModal" tabindex="-1" role="dialog" aria-labelledby="addHospitalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="addHospitalModalabel" style="font-family: 'BYekan';">افزودن بیمارستان جدید</h4>
            </div>
            <div class="modal-body" id="addHospitalModalBodyData">

                <div id="addHospitalForm">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="inputHopitalName" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نام بیمارستان:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputHopitalName" style="font-family: 'BYekan';" value="" placeholder="نام بیمارستان">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cbAddOpu" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">مرکز فراهم آوری:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbAddOpu" style="font-family: 'BYekan'; direction: rtl;">
                                    <option value="0">انتخاب کنید...</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="cbAddState" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">استان:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbAddState" style="font-family: 'BYekan'; direction: rtl;" onchange="insertcity('cbAddCity', 'cbAddState', false);">
                                    <option value="0">انتخاب کنید...</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cbAddCity" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">شهر:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbAddCity" style="font-family: 'BYekan'; direction: rtl;" disabled="disabled">
                                    <option value="0">انتخاب کنید...</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cbAddType" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نوع:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbAddType" style="font-family: 'BYekan'; direction: rtl;">
                                    <option value="0">انتخاب کنید...</option>
                                    <option value="1">دولتی</option>
                                    <option value="2">خصوصی</option>
                                    <option value="3">سایر</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cbAddIcu" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">ICU:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbAddIcu" style="font-family: 'BYekan'; direction: rtl;">
                                    <option value="0">انتخاب کنید...</option>
                                    <option value="1">دارد</option>
                                    <option value="2">ندارد</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputIcuBed" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">تعداد تخت ICU:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputIcuBed" style="font-family: 'BYekan';" value="" placeholder="تعداد تخت ICU">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputIcuBedBusy" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">درصد اشغال تخت:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputIcuBedBusy" style="font-family: 'BYekan';" value="" placeholder="درصد اشغال تخت ICU (عدد وارد نمائید)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cbAddNeuro" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">جراجی اعصاب:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbAddNeuro" style="font-family: 'BYekan'; direction: rtl;">
                                    <option value="0">انتخاب کنید...</option>
                                    <option value="1">دارد</option>
                                    <option value="2">ندارد</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputDeathPerYear" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">تعداد مرگ سالیه</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputDeathPerYear" style="font-family: 'BYekan';" value="" placeholder="تعداد مرگ سالیانه بیمارستان">
                                <input type="hidden" id="inputYear" value="<?php echo pdate('Y'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputIcuDeathPerYear" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">تعداد مرگ سالیانه ICU:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputIcuDeathPerYear" style="font-family: 'BYekan';" value="" placeholder="تعداد مرگ سالیانه ICU">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="progress" id="addHospitalModalLoading" style="display: none;">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                        <span class="sr-only">70% Complete</span>
                    </div>
                </div>


                <div role="alert" class="alert alert-success" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="successAlert1">بیمارستان مورد نظر با موفقیت ثبت گردید..</div>


                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert1">خطایی در ثبت مرکز رخ داده است، لطفا دوباره سعی نمائید.</div>

                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert3">اطلاعات را به دقت وارد نمائید.</div>

                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert4">اطلاعات به سامانه ارسال نشده است.</div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="float: left; font-family: 'BYekan';" id="saveBTN">افزودن بیمارستان</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left; font-family: 'BYekan';">انصراف</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editHospitalModal" tabindex="-1" role="dialog" aria-labelledby="editHospitalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="editHospitalModalabel" style="font-family: 'BYekan';">ویرایش بیمارستان ها</h4>
            </div>
            <div class="modal-body" id="editHospitalModalBodyData">

                <div id="editHospitalForm">
                    <form class="form-horizontal" role="form" name="editHospitalForm">
                        <div class="form-group">
                            <label for="inputHopitalNameEdit" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نام بیمارستان:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputHopitalNameEdit" style="font-family: 'BYekan';" value="" placeholder="نام بیمارستان">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cbAddOpuEdit" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">مرکز فراهم آوری:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbAddOpuEdit" style="font-family: 'BYekan'; direction: rtl;">
                                    <option value="0">انتخاب کنید...</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="cbAddStateEdit" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">استان:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbAddStateEdit" style="font-family: 'BYekan'; direction: rtl;" onchange="insertcity('cbAddCityEdit', 'cbAddStateEdit', false);">
                                    <option value="0">انتخاب کنید...</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cbAddCityEdit" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">شهر:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbAddCityEdit" style="font-family: 'BYekan'; direction: rtl;" disabled="disabled">
                                    <option value="0">انتخاب کنید...</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cbAddTypeEdit" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نوع:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbAddTypeEdit" style="font-family: 'BYekan'; direction: rtl;">
                                    <option value="0">انتخاب کنید...</option>
                                    <option value="1">دولتی</option>
                                    <option value="2">خصوصی</option>
                                    <option value="3">سایر</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cbAddIcuEdit" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">ICU:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbAddIcuEdit" style="font-family: 'BYekan'; direction: rtl;">
                                    <option value="0">انتخاب کنید...</option>
                                    <option value="1">دارد</option>
                                    <option value="2">ندارد</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputIcuBedEdit" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">تعداد تخت ICU:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputIcuBedEdit" style="font-family: 'BYekan';" value="" placeholder="تعداد تخت ICU">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputIcuBedBusyEdit" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">درصد اشغال تخت:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputIcuBedBusyEdit" style="font-family: 'BYekan';" value="" placeholder="درصد اشغال تخت ICU (عدد وارد نمائید)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cbAddNeuroEdit" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">جراجی اعصاب:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbAddNeuroEdit" style="font-family: 'BYekan'; direction: rtl;">
                                    <option value="0">انتخاب کنید...</option>
                                    <option value="1">دارد</option>
                                    <option value="2">ندارد</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputDeathPerYearEdit" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">تعداد مرگ سالیه</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputDeathPerYearEdit" style="font-family: 'BYekan';" value="" placeholder="تعداد مرگ سالیانه بیمارستان">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputIcuDeathPerYearEdit" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">تعداد مرگ سالیانه ICU:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputIcuDeathPerYearEdit" style="font-family: 'BYekan';" value="" placeholder="تعداد مرگ سالیانه ICU">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="progress" id="editHospitalModalLoading" style="display: none;">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                        <span class="sr-only">70% Complete</span>
                    </div>
                </div>


                <div role="alert" class="alert alert-success" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="successAlertEdit1">بیمارستان مورد نظر با موفقیت ویرایش گردید.</div>


                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertEdit1">اطلاعاتی یافت نشد.</div>
                
                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertEdit2">خطایی در ویرایش بیمارستان رخ داده است، لطفا دوباره سعی نمائید.</div>

                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertEdit3">اطلاعات را به دقت وارد نمائید.</div>

                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertEdit4">اطلاعات به سامانه ارسال نشده است.</div>
                
                <div role="alert" class="alert alert-warning" style="padding: 10px; width: 80%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="warningAlert1">درصورت تغییر مرکز فراهم آوری، استان و شهر آمار این بیمارستان صفر میشود.</div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="float: left; font-family: 'BYekan';" id="saveBTNEdit">ویرایش بیمارستان</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left; font-family: 'BYekan';">انصراف</button>
            </div>
        </div>
    </div>
</div>

<!-- in active or avtice inspector -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="deleteHospitalModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h5 class="modal-title" id="deleteInspectorModallabel" style="font-family: 'webYekan'; font-weight: normal;">حذف کردن بیمارستان</h5>
      </div>
      <div class="modal-body">
        
        <div style="width: 90%; margin: 0 auto; text-align: justify; font-family: 'BNazanin', Tahoma; font-size: 16px;" id="deleteHospitalModalActiveQuestion"></div>
        
        <div class="progress" id="deleteHospitalModalLoading" style="display: none;">
            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                <span class="sr-only">70% Complete</span>
            </div>
        </div>
        
        <div role="alert" class="alert alert-danger" style="padding: 10px; width: 100%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="deleteHospitalModalDanger1">خطایی در حذف بیمارستان رخ داده است، لطفاً دوباره تلاش نمائید.</div>
        
        <div role="alert" class="alert alert-success" style="padding: 10px; width: 100%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="deleteHospitalModalDanger3">بیمارستان مورد نظر با موفقیت حذف گردید.</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" style="float: left; font-family: 'BYekan'; font-weight: normal;" id="deleteHospitalModalBTN">حذف کردن بیمارستان</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="float: left; font-family: 'BYekan'; font-weight: normal;">انصراف</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- in active or avtice inspector -->