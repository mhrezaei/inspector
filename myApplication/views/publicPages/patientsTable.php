<script src="<?php echo asset_url(); ?>js/js-persian-cal.patients.js"></script>
<link href="<?php echo asset_url(); ?>css/js-persian-cal.css" rel="stylesheet" type="text/css">

<?php
if (is_array($pt['pt']) && count($pt['pt']) > 0) {

    ?>
    <table class="table table-hover table-striped"
           style="direction: rtl;     font-weight: normal; font-style: normal; font-size: 14px;" id="states">
        <thead style="direction: rtl; text-align: right;">
        <tr>
            <th style="width: 5%;">ردیف</th>
            <th style="width: 20%;">مشخصات بیمار</th>
            <th style="width: 15%;">اطلاعات بیمارستان</th>
            <th style="width: 20%;">اطلاعات واحد فراهم آوری</th>
            <th style="width: 10%;">علت اختلال</th>
            <th style="width: 15%; text-align: left; font-family: Tahoma; font-size: 14px;">Reflexes</th>
            <th style="width: 10%;">تاریخ</th>
            <th style="width: 5%; text-align: center;">امکانات</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0, $n = (($pt['page'] * 30) - 29); $i < count($pt['pt']); $i++) {

            ?>
            <tr style="background: <?php echo $pt['pt'][$i]['tolOpColor']; ?>; color: <?php echo $pt['pt'][$i]['tolOpTextColor']; ?>;">
                <td style="width: 5%; font-weight: normal;"><?php echo $n; ?></td>
                <td style="width: 20%; font-weight: normal;">
                    نام: <span style=" ; font-size: 12px;"
                               id="patientName<?php echo $pt['pt'][$i]['id']; ?>"><?php echo $pt['pt'][$i]['fullName']; ?></span>
                    <br>
                    سن: <span style="font-weight: bold"><?php echo $pt['pt'][$i]['age']; ?></span>
                    <br>
                    GCS اولیه: <span style="font-weight: bold"><?php echo $pt['pt'][$i]['firstGCS']; ?></span>
                    <br>
                    GCS فعلی: <span style="font-weight: bold"><?php if (strlen($pt['pt'][$i]['secondGCS']) > 0) {
                            echo $pt['pt'][$i]['secondGCS'];
                        } else {
                            echo '-';
                        } ?></span>
                </td>
                <td style="width: 15%; font-weight: normal;">
                    بیمارستان: <span style=" ; font-size: 12px;"><?php echo $pt['pt'][$i]['hosName']; ?></span>
                    <br>
                    بخش: <span style=" ; font-size: 12px;"><?php
                        if ($pt['pt'][$i]['section'] == 1) {
                            echo 'ICU';
                        } elseif ($pt['pt'][$i]['section'] == 2) {
                            echo 'CCU';
                        } elseif ($pt['pt'][$i]['section'] == 3) {
                            echo 'اورژانس';
                        } elseif ($pt['pt'][$i]['section'] == 4) {
                            echo 'بخش';
                        }
                        if (strlen($pt['pt'][$i]['typeOfSection']) > 0) {
                            echo ' - ' . $pt['pt'][$i]['typeOfSection'];
                        }
                        ?></span>
                    <br>
                    شماره پرونده: <span style="font-weight: bold;"><?php echo $pt['pt'][$i]['fileNumber']; ?></span>
                </td>
                <td style="width: 20%; font-weight: normal;">
                    شهر: <span style=" ; font-size: 12px;"><?php echo $pt['pt'][$i]['cityName']; ?></span>
                    <br>
                    OPU: <span style=" ; font-size: 12px;"><?php echo $pt['pt'][$i]['opuName']; ?></span>
                    <br>
                    بازرس:
                    <span style=" ; font-size: 12px;"><?php
                        echo $pt['pt'][$i]['insName'];
                        ?></span>
                    <br>
                    نوع بازرسی: <span style=" ; font-size: 12px;"><?php
                        if ($pt['pt'][$i]['presentation'] == 1) {
                            echo 'بازرس حضوری (IP)';
                        } elseif ($pt['pt'][$i]['presentation'] == 2) {
                            echo 'بازرس تلفنی (TDD)';
                        } elseif ($pt['pt'][$i]['presentation'] == 3) {
                            echo 'گزارش بیمارستانی (HR)';
                        }
                        ?></span>
                </td>
                <td style="width: 10%; font-weight: normal;">
                    علت اختلال:
                    <span style=" ; font-size: 12px;"><?php
                        if ($pt['pt'][$i]['doc'] == 8) {
                            echo $pt['pt'][$i]['docDetail'] . ' (سایر)';
                        } else {
                            echo $pt['pt'][$i]['docText'];
                        }
                        ?></span>
                    <br>
                    توضیحات: <span style=" ; font-size: 12px;">
                            <?php
                            if (strlen($pt['pt'][$i]['patientDetail']) > 1) {
                                echo $pt['pt'][$i]['patientDetail'];
                            } else {
                                echo '-';
                            }
                            ?>
                        </span>
                </td>
                <td style="width: 15%; font-weight: normal; direction: ltr; text-align: left;  , Tahoma; font-size: 12px;">
                    <table style="width: 100%; color: <?php echo $pt['pt'][$i]['tolOpTextColor']; ?>;">
                        <tr>
                            <td style="width: 62%; text-align: left; border-right: 1px dashed;">Breathing: <span
                                        style="font-weight: bold;"><?php echo $pt['pt'][$i]['breathing']; ?></span></td>
                            <td style="width: 38%; text-align: left; padding-left: 5px;">Gag: <span
                                        style="font-weight: bold;"><?php echo $pt['pt'][$i]['gag']; ?></span></td>
                        </tr>
                        <tr>
                            <td style="width: 62%; text-align: left; border-right: 1px dashed;">Body Movement: <span
                                        style="font-weight: bold;"><?php echo $pt['pt'][$i]['bodyMovement']; ?></span>
                            </td>
                            <td style="width: 38%; text-align: left; padding-left: 5px;">Cough: <span
                                        style="font-weight: bold;"><?php echo $pt['pt'][$i]['cough']; ?></span></td>
                        </tr>
                        <tr>
                            <td style="width: 62%; text-align: left; border-right: 1px dashed;">Face Movement: <span
                                        style="font-weight: bold;"><?php echo $pt['pt'][$i]['faceMovement']; ?></span>
                            </td>
                            <td style="width: 38%; text-align: left; padding-left: 5px;">Pupil: <span
                                        style="font-weight: bold;"><?php echo $pt['pt'][$i]['pupil']; ?></span></td>
                        </tr>
                        <tr>
                            <td style="width: 62%; text-align: left; border-right: 1px dashed;">Doll's Eyes: <span
                                        style="font-weight: bold;"><?php echo $pt['pt'][$i]['dollEye']; ?></span></td>
                            <td style="width: 38%; text-align: left; padding-left: 5px;">Cornea: <span
                                        style="font-weight: bold;"><?php echo $pt['pt'][$i]['cornea']; ?></span></td>
                        </tr>
                        <tr>
                            <td style="width: 62%; text-align: left; border-right: 1px dashed;">Sedation: <span
                                        style="font-weight: bold;"><?php echo $pt['pt'][$i]['sedation']; ?></span></td>
                            <td style="width: 38%; text-align: left;"></td>
                        </tr>
                    </table>
                </td>
                <td style="width: 10%; font-weight: normal;">
                    شناسایی: <span style="font-weight: bold;"><?php echo pdate('Y/m/d',
                            $pt['pt'][$i]['inspectorRegisterTime']); ?></span>
                    <br>
                    ساعت: <span style="font-weight: bold;"><?php echo pdate('H:i',
                            $pt['pt'][$i]['inspectorRegisterTime']); ?></span>
                    <br>
                    بروزرسانی:
                    <span style="font-weight: bold;">
                            <?php
                            if (($pt['pt'][$i]['lastUpdateTime'] - $pt['pt'][$i]['appRegisterTime']) > 15) {
                                echo pdate('Y/m/d', $pt['pt'][$i]['lastUpdateTime']);
                            } else {
                                echo 'هرگز';
                            }
                            ?> 
                        </span>
                    <br>
                    ساعت: <span style="font-weight: bold;">
                                <?php
                                if (($pt['pt'][$i]['lastUpdateTime'] - $pt['pt'][$i]['appRegisterTime']) > 15) {
                                    echo pdate('H:i', $pt['pt'][$i]['lastUpdateTime']);
                                } else {
                                    echo '-';
                                }
                                ?>
                            </span>
                </td>
                <td style="width: 10%; text-align: center; font-weight: normal;">
                    <?php
                    if ($pt['pt'][$i]['status'] != 15) // check for the patient is not in transfer
                    {
                        ?>
                        <div class="glyphicon glyphicon glyphicon-list" style="cursor: pointer; font-size: 16px;"
                             rel="tooltip" data-placement="top" title="مشاهده تغییرات" data-toggle="modal"
                             data-target="#viewPatientLogModal"
                             onclick="viewPatientLog('<?php echo $pt['pt'][$i]['id']; ?>');"></div>

                        <?php
                        if ($pt['pt'][$i]['status'] < 12) // check for the patient not deleted
                        {
                            if ($userRole == 'INSPECTOR' AND $type == 1 AND !$timeAccess) {
                                // IP inspector not access to edit patient
                            } else {
                                ?>
                                <div class="glyphicon glyphicon-pencil" style="cursor: pointer; font-size: 16px;"
                                     rel="tooltip" data-placement="top" title="ویرایش اطلاعات بیمار" data-toggle="modal"
                                     data-target="#editPatientModal"
                                     onclick="editPatient('<?php echo $pt['pt'][$i]['id']; ?>');"></div>
                                <?php
                            }

                            if ($userRole != 'INSPECTOR') // check for inspector can't delete patient
                            {
                                ?>
                                <div class="glyphicon glyphicon-remove" style="cursor: pointer; font-size: 16px;"
                                     rel="tooltip" data-placement="top" title="حذف بیمار" data-toggle="modal"
                                     data-target="#deletePatientModal"
                                     onclick="deletePatient('<?php echo $pt['pt'][$i]['id']; ?>');"></div>
                                <?php
                            }
                        } else // when patient file status deleted
                        {
                            ?>
                            <div class="glyphicon glyphicon-repeat" style="cursor: pointer; font-size: 16px;"
                                 rel="tooltip" data-placement="top" title="بازگرداندن بیمار" data-toggle="modal"
                                 data-target="#undoDeletePatientModal"
                                 onclick="undoDeletePatient('<?php echo $pt['pt'][$i]['id']; ?>');"></div>
                            <?php
                        }
                        ?>
                        <?php
                    } else // when the patient in transfer
                    {
                        ?>
                        <div class="glyphicon glyphicon-ok" style="cursor: pointer; font-size: 16px; color: green;"
                             rel="tooltip" data-placement="top" title="تایید انتقال بیمار" data-toggle="modal"
                             data-target="#transferAPatientModal"
                             onclick="verifyTransferPatient('<?php echo $pt['pt'][$i]['id']; ?>', 'verify');"></div>
                        <div class="glyphicon glyphicon-remove" style="cursor: pointer; font-size: 16px; color: red;"
                             rel="tooltip" data-placement="top" title="رد تایید انتقال" data-toggle="modal"
                             data-target="#transferAPatientModal"
                             onclick="verifyTransferPatient('<?php echo $pt['pt'][$i]['id']; ?>', 'unVerify');"></div>
                        <?php
                    }
                    ?>
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
        echo pagination($pt['totalRecords'], $pt['page'], 30, 4, base_url() . $pt['class'] . $pt['url'] . 'page=');
        ?>
    </div>

    <?php
} else {
    ?>

    <div class="alert alert-warning alert-dismissible fade in" role="alert" id="myAlert"
         style=" ; margin: 0 auto; margin-top: 50px; text-align: center; width: 60%; font-size: 14px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        هیچ بیماری در این بخش یافت نشد...!
    </div>

    <?php
}
?>


<!-- Edit Patient Modal Start -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true" id="editPatientModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" style=" ; font-size: 14px;">ویرایش اطلاعات بیمار</h4>
            </div>
            <div class="modal-body clearfix">
                <div class="container-fluid">
                    <!-- form start -->
                    <div id="editPatientFrom">
                        <form method="post" name="editPatientForms" role="form" class="form-horizontal custom-form"
                              id="editPatientForms">
                            <div class="formCat">اطلاعات بیمار</div>
                            <div class="clearB"></div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-sm-5" for="inputFileNumber">تاریخ ثبت در
                                            سامانه:</label>
                                        <div class="col-sm-7" id="appRegisterTime">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="TRUE" name="chisUnknown" id="chisUnknown">
                                                این بیمار ناشناس است
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="inputFileNumber">شماره پرونده<span
                                                    style="color: red;"> *</span>:</label>
                                        <div class="col-sm-8">
                                            <input type="text" placeholder="شماره پرونده بیمار" value="" style="   "
                                                   name="inputFileNumber" id="inputFileNumber" class="form-control">
                                            <input type="hidden" value="" style="   " name="inputPT" id="inputPT"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="inputFullName">نام و نام
                                            خانوادگی<span style="color: red;"> *</span>:</label>
                                        <div class="col-sm-8">
                                            <input type="text" placeholder="نام و نام خانوادگی بیمار" value=""
                                                   style="   " name="inputFullName" id="inputFullName"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="inputNationalCode">کدملی:</label>
                                        <div class="col-sm-8">
                                            <input type="text" maxlength="10" placeholder="کدملی بیمار" value=""
                                                   style="    direction: ltr;" name="inputNationalCode"
                                                   id="inputNationalCode" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="inputAge">سن<span
                                                    style="color: red;"> *</span>:</label>
                                        <div class="col-sm-8">
                                            <input type="text" placeholder="سن بیمار" value=""
                                                   style="    direction: ltr;" name="inputAge" id="inputAge"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cbBodyType">وضعیت بدنی<span
                                                    style="color: red;"> *</span>:</label>
                                        <div class="col-sm-8">
                                            <select style="    direction: rtl;" name="cbBodyType" id="cbBodyType"
                                                    class="form-control">
                                                <option value="لاغر">لاغر</option>
                                                <option selected="selected" value="متوسط">متوسط</option>
                                                <option value="چاق">چاق</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="inputFirstGCS">GCS اولیه بیمار<span
                                                    style="color: red;"> *</span>:</label>
                                        <div class="col-sm-8">
                                            <input type="text" placeholder="GCS اولیه بیمار" value=""
                                                   style="    direction: ltr;" name="inputFirstGCS" id="inputFirstGCS"
                                                   class="form-control" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="inputSecondGCS">GCS فعلی<span
                                                    style="color: red;"> *</span>:</label>
                                        <div class="col-md-8">
                                            <input type="text" placeholder="3 ~ 15" value="" style="    direction: ltr;"
                                                   name="inputSecondGCS" id="inputSecondGCS" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="inputCoordinatorName">نام
                                            کوردیناتور<span
                                                    style="color: red;"></span>:</label>
                                        <div class="col-md-8">
                                            <input type="text" placeholder="نام کوردیناتور" value=""
                                                   style="    direction: rtl;" name="inputCoordinatorName"
                                                   id="inputCoordinatorName" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cbDoc">علت اختلال هوشیاری<span
                                                    style="color: red;"> *</span>:</label>
                                        <div class="col-sm-8">
                                            <select style="    direction: rtl;" name="cbDoc" id="cbDoc"
                                                    class="form-control">
                                                <option value="0">انتخاب کنید...</option>
                                            </select>
                                            <input type="text" placeholder="علت اختلال هوشیاری..." value=""
                                                   style="    margin-top: 10px; display: none;" name="inputDocDetail"
                                                   id="inputDocDetail" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="inputPatientDetail">توضیحات:</label>
                                        <div class="col-sm-8">
                                            <input type="text" placeholder="سایر توضیحات" value=""
                                                   style="    direction: rtl;"
                                                   name="inputPatientDetail" id="inputPatientDetail"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="formCat">اطلاعات بیمارستان</div>
                            <div class="clearB"></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label class="control-label col-sm-4" for="cbHospitals">نام بیمارستان<span
                                                    style="color: red;"> *</span>:</label>
                                        <div class="col-sm-8">
                                            <select disabled="disabled" style="direction: rtl;" name="cbHospitalsEdit"
                                                    id="cbHospitalsEdit" class="form-control">
                                                <option value="0">انتخاب کنید...</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cbSection">بخش<span
                                                    style="color: red;"> *</span>:</label>
                                        <div class="col-sm-8">
                                            <select style="    direction: rtl;" name="cbSectionEdit" id="cbSectionEdit"
                                                    class="form-control">
                                                <option value="0">انتخاب کنید...</option>
                                                <option value="1">ICU</option>
                                                <option value="2">CCU</option>
                                                <option value="3">اورژانس</option>
                                                <option value="4">بخش</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="inputTypeOfSection">نام بخش:</label>
                                        <div class="col-sm-8">
                                            <input type="text" placeholder="نام بخش" value=""
                                                   style="    direction: ltr;"
                                                   name="inputTypeOfSection" id="inputTypeOfSection"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cbPresentioan">نحوه شناسایی
                                            بیمار<span
                                                    style="color: red;"> *</span>:</label>
                                        <div class="col-sm-8">
                                            <select style="    direction: rtl;" name="cbPresentioan" id="cbPresentioan"
                                                    class="form-control">
                                                <option value="0">انتخاب کنید...</option>
                                                <option value="1">بازرس حضوری (IP)</option>
                                                <option value="2">بازرس تلفنی (TDD)</option>
                                                <option value="3">گزارش بیمارستانی (HR)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="formCat">رفلکس های بیمار</div>
                            <div class="clearB"></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cbBreathing">Breathing (تنفس):</label>
                                        <div class="col-sm-8">
                                            <select style="    direction: rtl;" name="cbBreathing" id="cbBreathing"
                                                    class="form-control">
                                                <option value="U">نا معلوم (U)</option>
                                                <option value="P">دارد (P)</option>
                                                <option value="N">ندارد (N)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="inputBreathingDetail">تعداد/دقیقه:</label>
                                        <div class="col-sm-8">
                                            <input type="text" placeholder="per/min" value="" style="    direction: ltr;"
                                                   name="inputBreathingDetail" id="inputBreathingDetail" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cbCornea">Cornea (قرنیه):</label>
                                        <div class="col-sm-8">
                                            <select style="    direction: rtl;" name="cbCornea" id="cbCornea"
                                                    class="form-control">
                                                <option value="U">نا معلوم (U)</option>
                                                <option value="P">دارد (P)</option>
                                                <option value="N">ندارد (N)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cbPupil">Pupil (مردمک):</label>
                                        <div class="col-sm-8">
                                            <select style="    direction: rtl;" name="cbPupil" id="cbPupil"
                                                    class="form-control">
                                                <option value="U">نا معلوم (U)</option>
                                                <option value="P">دارد (P)</option>
                                                <option value="N">ندارد (N)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cbFaceMove">Face Movement (حرکات صورت):</label>
                                        <div class="col-sm-8">
                                            <select style="    direction: rtl;" name="cbFaceMove" id="cbFaceMove"
                                                    class="form-control">
                                                <option value="U">نا معلوم (U)</option>
                                                <option value="P">دارد (P)</option>
                                                <option value="N">ندارد (N)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="from-group">
                                        <label class="control-label col-sm-4" for="inputFaceMovementDetail">توضیحات:</label>
                                        <div class="col-sm-8">
                                            <input type="text" placeholder="توضیحات حرکات صورت" value=""
                                                   style="    direction: rtl;"
                                                   name="inputFaceMovementDetail" id="inputFaceMovementDetail"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cbBodyMove">Body Movement (حرکات بدن):</label>
                                        <div class="col-sm-8">
                                            <select style="    direction: rtl;" name="cbBodyMove" id="cbBodyMove"
                                                    class="form-control">
                                                <option value="U">نا معلوم (U)</option>
                                                <option value="P">دارد (P)</option>
                                                <option value="N">ندارد (N)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="from-group">
                                        <label
                                               class="control-label col-sm-4" for="inputBodyMovementDetail">توضیحات:</label>
                                        <div class="col-sm-8">
                                            <input type="text" placeholder="توضیحات حرکات بدن" value=""
                                                   style="    direction: rtl;"
                                                   name="inputBodyMovementDetail" id="inputBodyMovementDetail"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cbDoll">Doll's Eye (چشم&zwnj;عروسکی):</label>
                                        <div class="col-sm-8">
                                            <select style="    direction: rtl;" name="cbDoll" id="cbDoll" class="form-control">
                                                <option value="U">نا معلوم (U)</option>
                                                <option value="P">دارد (P)</option>
                                                <option value="N">ندارد (N)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="from-group">
                                        <label class="control-label col-sm-4" for="cbGag">Gag (بلع):</label>
                                        <div class="col-sm-8">
                                            <select style="    direction: rtl;" name="cbGag" id="cbGag" class="form-control">
                                                <option value="U">نا معلوم (U)</option>
                                                <option value="P">دارد (P)</option>
                                                <option value="N">ندارد (N)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="from-group">
                                        <label class="control-label col-sm-4" for="cbCough">Cough (سرفه):</label>
                                        <div class="col-sm-8">
                                            <select style="    direction: rtl;" name="cbCough" id="cbCough"
                                                    class="form-control">
                                                <option value="U">نا معلوم (U)</option>
                                                <option value="P">دارد (P)</option>
                                                <option value="N">ندارد (N)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="formCat">اطلاعات ثبت</div>
                            <div class="clearB"></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cbTol">نوع لیست<span
                                                    style="color: red;"> *</span>:</label>
                                        <div class="col-sm-8">
                                            <select style=" ; direction: rtl; font-size: 13px;" name="cbTol" id="cbTol"
                                                    class="form-control">
                                                <option value="0">انتخاب کنید...</option>
                                                <option value="1">بیماران GCS3 مرگ مغزی شده</option>
                                                <option value="2">بیماران GCS3 مرگ مغزی نشده</option>
                                                <option value="3">بیماران GCS4,5</option>
                                                <option value="4">بیماران نامناسب</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="from-group">
                                        <label class="control-label col-sm-4" for="cbPatientStatus">وضعیت بیمار<span
                                                    style="color: red;"> *</span>:</label>
                                        <div class="col-sm-8">
                                            <select style=" ; direction: rtl; font-size: 13px;" name="cbPatientStatusEdit"
                                                    id="cbPatientStatusEdit" class="form-control">
                                                <option value="0">انتخاب کنید...</option>
                                            </select>
                                            <input type="text" placeholder="وضعیت بیمار ..." value=""
                                                   style="    margin-top: 10px; display: none;" name="inputPatientStatusDetail"
                                                   id="inputPatientStatusDetail" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- GCS3 brain death data -->
                            <div id="GCS3Patients" style="display: block;">
                                <!-- The patient's condition start -->
                                <div class="formCat">وضعیت پایداری بیمار</div>
                                <div class="clearB"></div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                   class="control-label col-sm-4" for="inputT">T:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="20 ~ 50" maxlength="4" value=""
                                                       style=" ; direction: ltr;" name="inputT" id="inputT"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label
                                                   class="control-label col-sm-4" for="inputPR">PR:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 200" maxlength="3" value=""
                                                       style=" ; direction: ltr;" name="inputPR" id="inputPR"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                   class="control-label col-sm-4" for="inputFIO2">FIO<sub>2</sub>:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 100" maxlength="3" value=""
                                                       style=" ; direction: ltr;" name="inputFIO2" id="inputFIO2"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label
                                                   class="control-label col-sm-4" for="inputOut">Out:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 3000 ml/hr" maxlength="4" value=""
                                                       style=" ; direction: ltr;" name="inputOut" id="inputOut"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                   class="control-label col-sm-4" for="inputBPb">B.P:</label>
                                            <div class="col-sm-3">
                                                <input type="text" placeholder="0 ~ 300" maxlength="3" value=""
                                                       style=" ; direction: ltr;" name="inputBPb" id="inputBPb"
                                                       class="form-control">
                                            </div>
                                            <label style="float: right"
                                                   class="control-label" for="inputBPp">.</label>
                                            <div class="col-sm-3">
                                                <input type="text" placeholder="0 ~ 200" maxlength="3" value=""
                                                       style=" ; direction: ltr;" name="inputBPp" id="inputBPp"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label class="control-label col-sm-4" for="inputRR">RR:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 100" maxlength="3" value=""
                                                       style=" ; direction: ltr;" name="inputRR" id="inputRR"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="inputO2SAT">O<sub>2</sub>Sat:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 100" maxlength="3" value=""
                                                       style=" ; direction: ltr;" name="inputO2SAT" id="inputO2SAT"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="from-group">
                                            <div class="form-group">
                                                <label class="checkbox-inline" for="cbSedation2"> آیا بیمار داروهای آرام بخش
                                                    (Sedation)
                                                    دریافت می کند؟
                                                    <div style="float: right; direction: ltr; width: 50px; padding-top: 10px;">
                                                        <input type="checkbox" style="direction: rtl;" value="TRUE" name="cbSedation2"
                                                               id="cbSedation2">
                                                    </div>
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- The patient's condition end -->

                                <!-- Patient tests start -->
                                <div class="formCat">آزمایشات بیمار</div>
                                <div class="clearB"></div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="inputNa">Na:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 300" maxlength="3" value=""
                                                       style=" ; direction: ltr;" name="inputNa" id="inputNa"
                                                       class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label class="control-label col-sm-4" for="inputK">K:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 20" maxlength="4" value=""
                                                       style=" ; direction: ltr;" name="inputK" id="inputK"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="inputBUN">BUN:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 200" maxlength="3" value=""
                                                       style=" ; direction: ltr;" name="inputBUN" id="inputBUN"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label class="control-label col-sm-4" for="inputUrea">Urea:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 500" maxlength="3" value=""
                                                       style=" ; direction: ltr;" name="inputUrea" id="inputUrea"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                   class="control-label col-sm-4" for="inputALT">ALT:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 2000" maxlength="4" value=""
                                                       style=" ; direction: ltr;" name="inputALT" id="inputALT"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label
                                                   class="control-label col-sm-4" for="inputAST">AST:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 2000" maxlength="4" value=""
                                                       style=" ; direction: ltr;" name="inputAST" id="inputAST"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                   class="control-label col-sm-4" for="inputHb">Hgb:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 30" maxlength="4" value=""
                                                       style=" ; direction: ltr;" name="inputHb" id="inputHb"
                                                       class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label
                                                   class="control-label col-sm-4" for="inputWBC">WBC:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 100000" maxlength="6" value=""
                                                       style=" ; direction: ltr;" name="inputWBC" id="inputWBC"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                   class="control-label col-sm-4" for="inputPLT">PLT:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="1000 ~ 999000" maxlength="6" value=""
                                                       style=" ; direction: ltr;" name="inputPLT" id="inputPLT"
                                                       class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label
                                                   class="control-label col-sm-4" for="inputBs">Bs:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 1000" maxlength="4" value=""
                                                       style=" ; direction: ltr;" name="inputBs" id="inputBs"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                   class="control-label col-sm-4" for="inputCr">Cr:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 20" maxlength="4" value=""
                                                       style=" ; direction: ltr;" name="inputCr" id="inputCr"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label
                                                   class="control-label col-sm-4" for="inputCa">Ca:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="0 ~ 20" maxlength="4" value=""
                                                       style=" ; direction: ltr;" name="inputCa" id="inputCa"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Patient tests end -->
                            </div>
                            <!-- GCS3 brain death data -->

                            <!-- Patient organs start -->
                            <div id="patientOrgansSection">
                                <div class="formCat">اعضای اهدا شده بیمار</div>
                                <div class="clearB"></div>

                                <div style="margin-left: 0px; margin-right: 0px; direction: ltr; text-align: left;" class="form-group">
                                    <label style="float: right;     font-weight: normal; direction: rtl; width: 30px; margin-right: 70px;"
                                           class="checkbox-inline" for="chHeart"> قلب</label>
                                    <div style="float: right; direction: ltr; width: 50px; padding-top: 10px;">
                                        <input type="checkbox" style="direction: rtl;" value="1" name="chHeart"
                                               id="chHeart">
                                    </div>

                                    <label style="float: right;     font-weight: normal; direction: rtl; width: 30px;"
                                           class="checkbox-inline" for="chLiver"> کبد</label>
                                    <div style="float: right; direction: ltr; width: 50px; padding-top: 10px;">
                                        <input type="checkbox" style="direction: rtl;" value="1" name="chLiver"
                                               id="chLiver">
                                    </div>

                                    <label style="float: right;     font-weight: normal; direction: rtl; width: 75px;"
                                           class="checkbox-inline" for="chKidneyRight"> کلیه راست</label>
                                    <div style="float: right; direction: ltr; width: 50px; padding-top: 10px;">
                                        <input type="checkbox" style="direction: rtl;" value="1" name="chKidneyRight"
                                               id="chKidneyRight">
                                    </div>

                                    <label style="float: right;     font-weight: normal; direction: rtl; width: 70px;"
                                           class="checkbox-inline" for="chKidneyLeft"> کلیه چپ</label>
                                    <div style="float: right; direction: ltr; width: 50px; padding-top: 10px;">
                                        <input type="checkbox" style="direction: rtl;" value="1" name="chKidneyLeft"
                                               id="chKidneyLeft">
                                    </div>

                                    <label style="float: right;     font-weight: normal; direction: rtl; width: 70px;"
                                           class="checkbox-inline" for="chLungRight"> ریه راست</label>
                                    <div style="float: right; direction: ltr; width: 50px; padding-top: 10px;">
                                        <input type="checkbox" style="direction: rtl;" value="1" name="chLungRight"
                                               id="chLungRight">
                                    </div>

                                    <label style="float: right;     font-weight: normal; direction: rtl; width: 70px;"
                                           class="checkbox-inline" for="chLungLeft"> ریه چپ</label>
                                    <div style="float: right; direction: ltr; width: 50px; padding-top: 10px;">
                                        <input type="checkbox" style="direction: rtl;" value="1" name="chLungLeft"
                                               id="chLungLeft">
                                    </div>

                                    <label style="float: right;     font-weight: normal; direction: rtl; width: 50px;"
                                           class="checkbox-inline" for="chPancreas"> پانکراس</label>
                                    <div style="float: right; direction: ltr; width: 50px; padding-top: 10px;">
                                        <input type="checkbox" style="direction: rtl;" value="1" name="chPancreas"
                                               id="chPancreas">
                                    </div>

                                    <label style="float: right;     font-weight: normal; direction: rtl; width: 40px;"
                                           class="checkbox-inline" for="chTissue"> نسج</label>
                                    <div style="float: right; direction: ltr; width: 50px; padding-top: 10px;">
                                        <input type="checkbox" style="direction: rtl;" value="1" name="chTissue"
                                               id="chTissue">
                                    </div>

                                    <label style="float: right;     font-weight: normal; direction: rtl; width: 40px;"
                                           class="checkbox-inline" for="chBowel"> روده</label>
                                    <div style="float: right; direction: ltr; width: 50px; padding-top: 10px;">
                                        <input type="checkbox" style="direction: rtl;" value="1" name="chBowel"
                                               id="chBowel">
                                    </div>

                                </div>
                            </div>
                            <!-- Patient organs end -->

                            <!-- Patient Times start -->
                            <div class="formCat">تاریخ</div>
                            <div class="clearB"></div>

                            <div style="margin-left: 0px; margin-right: 0px; direction: rtl;" class="form-group">

                                <div class="col-md-4" id="hospitalizationDate" style="float: right;">
                                    <label style="float: right;     font-weight: normal; text-align: right; width: 100px;"
                                           class="control-label" for="pcal1">تاریخ بستری<span
                                                style="color: red;"> *</span>:</label>
                                    <div style="float: right; width: 150px;">
                                        <input type="text" value=""
                                               style="    direction: rtl; width: 100px; float: right; text-align: center;"
                                               name="pcal1" id="pcal1" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4" id="gcs3ByDrData" style="float: right;">
                                    <label style="float: right;     font-weight: normal; text-align: right; width: 100px; line-height: 16px; margin-right: 20px;"
                                           class="control-label" for="pcal2">تاریخ اعلام <span
                                                style=" ; font-size: 14px;">GCS3</span>
                                        <small>توسط پزشک معالج</small>
                                        :</label>
                                    <div style="float: right; width: 150px;">
                                        <input type="text" value=""
                                               style="    direction: rtl; width: 100px; float: right; text-align: center;"
                                               name="pcal2" id="pcal2" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4" id="foundGcs3Date" style="float: right;">
                                    <label style="float: right;     font-weight: normal; text-align: right; width: 140px; line-height: 16px; margin-right: 20px;"
                                           class="control-label" for="pcal3">تاریخ شناسایی مرگ مغزی:</label>
                                    <div style="float: right; width: 140px;">
                                        <input type="text" value=""
                                               style="    direction: rtl; width: 100px; float: right; text-align: center;"
                                               name="pcal3" id="pcal3" class="form-control">
                                    </div>
                                </div>

                                <script>
                                    var objCal1 = new AMIB.persianCalendar('pcal1');
                                    var objCal2 = new AMIB.persianCalendar('pcal2');
                                    var objCal3 = new AMIB.persianCalendar('pcal3');
                                </script>
                            </div>
                            <div style="margin-left: 0px; margin-right: 0px; direction: rtl;" class="form-group">


                                <div class="col-md-4" id="organDonationDate" style="float: right;">
                                    <label style="float: right;     font-weight: normal; text-align: right; width: 100px;"
                                           class="control-label" for="pcal5">تاریخ اهدا:</label>
                                    <div style="float: right; width: 150px;">
                                        <input type="text" value=""
                                               style="    direction: rtl; width: 100px; float: right; text-align: center;"
                                               name="pcal5" id="pcal5" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4" id="cardiacDeathDate" style="float: right;">
                                    <label style="float: right;     font-weight: normal; text-align: right; width: 100px;"
                                           class="control-label" for="pcal6">تاریخ مرگ قلبی:</label>
                                    <div style="float: right; width: 150px;">
                                        <input type="text" value=""
                                               style="    direction: rtl; width: 100px; float: right; text-align: center;"
                                               name="pcal6" id="pcal6" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4" style="float: right;"></div>

                                <script>
                                    var objCal2 = new AMIB.persianCalendar('pcal5');
                                    var objCal3 = new AMIB.persianCalendar('pcal6');
                                </script>
                            </div>
                            <!-- Patient Times end -->

                        </form>
                    </div>
                    <!-- form end -->
                    <!-- transfer patients form start -->
                    <div id="patientsTransfer" style="display: none;">
                        <form method="post" name="patientTransferForm" role="form" class="form-horizontal">
                            <div class="formCat">انتقال بیمار به واحد فراهم آوری جدید</div>
                            <div class="clearB"></div>

                            <div style="margin-left: 0px; margin-right: 0px; direction: rtl;" class="form-group">
                                <label for="cbTransferState" class="control-label"
                                       style="float: right;     font-weight: normal; width: 80px;">استان:</label>
                                <div style="width: 200px; float: right;">
                                    <select class="form-control" id="cbTransferState" name="cbTransferState"
                                            style="    direction: rtl;"
                                            onchange="insertcity('cbTransferCity', 'cbTransferState', false);">
                                        <option value="0">انتخاب کنید...</option>
                                    </select>
                                </div>

                                <label for="cbTransferCity" class="control-label"
                                       style="float: right;     font-weight: normal; margin-right: 20px; width: 80px;">شهر:</label>
                                <div style="width: 200px; float: right;">
                                    <select class="form-control" id="cbTransferCity" name="cbTransferCity"
                                            style="    direction: rtl;"
                                            onchange="insertHospital('cbTransferHospital', 'cbTransferCity', false, 'city');"
                                            disabled="disabled">
                                        <option value="0">انتخاب کنید...</option>
                                    </select>
                                </div>
                            </div>

                            <div style="margin-left: 0px; margin-right: 0px; direction: rtl;" class="form-group">
                                <label for="cbTransferHospital" class="control-label"
                                       style="float: right;     font-weight: normal; width: 80px;">بیمارستان:</label>
                                <div style="width: 200px; float: right;">
                                    <select class="form-control" id="cbTransferHospital" name="cbTransferHospital"
                                            style="    direction: rtl;" disabled="disabled">
                                        <option value="0">انتخاب کنید...</option>
                                    </select>
                                </div>

                                <label style="float: right;     font-weight: normal; text-align: right; width: 80px; margin-right: 20px;"
                                       class="control-label" for="pcal4">تاریخ انتقال:</label>
                                <div style="float: right; width: 200px;">
                                    <input type="text" value=""
                                           style="    direction: rtl; width: 170px; float: right; text-align: center;"
                                           name="pcal4" id="pcal4" class="form-control">
                                </div>

                                <script>
                                    var objCal1 = new AMIB.persianCalendar('pcal4');
                                </script>
                            </div>
                        </form>
                    </div>
                    <!-- transfer patients form end -->

                    <!-- loading -->
                    <div class="progress" id="editPatientModalLoading" style="width: 60%; margin: 0 auto;">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                             aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                            <span class="sr-only">70% Complete</span>
                        </div>
                    </div>
                    <!-- loading -->
                    <div id="dangerAlert"
                         style="padding: 10px; width: 50%; margin: 0 auto;     font-weight: normal; text-align: center;"
                         class="alert alert-danger" role="alert">لطفا موارد ستاره دار را به درستی تکمیل نمائید.
                    </div>
                    <div id="successAlert"
                         style="padding: 10px; width: 50%; margin: 0 auto;     font-weight: normal; text-align: center;"
                         class="alert alert-success" role="alert"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveBTN" style="float: left; font-family: 'BYekan';" class="btn btn-success" type="button">
                    ارسال
                    اطلاعات
                </button>
                <button id="transferBTN" class="btn btn-transfer" style="float: left; font-family: 'BYekan';"
                        type="button">
                    انتقال بیمار به واحد جدید
                </button>
                <button id="transferSaveBTN" class="btn btn-transfer"
                        style="float: left; font-family: 'BYekan'; display: none;" type="button">ثبت انتقال بیمار
                </button>
                <button type="button" class="btn btn-default" style="float: left; font-family: 'BYekan';"
                        data-dismiss="modal">انصراف
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Edit Patient Modal End -->

<!-- view Patient log Start -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true" id="viewPatientLogModal">
    <div class="modal-dialog modal-lg" style="width: 1080px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" style=" ; font-size: 14px;">مشاهده تغییرات بیمار</h4>
            </div>
            <div class="modal-body">

                <div id="patientLogDiv" style="display: none;">
                    <div class="formCat">تغییرات بیمار</div>
                    <div class="clearB"></div>
                    <table class="table table-hover table-striped custom-table"
                           style="direction: rtl;     font-weight: normal; font-style: normal; font-size: 14px; width: 1050px;">
                        <thead style="direction: rtl; text-align: right;">
                        <tr>
                            <th style="width: 50px;">ردیف</th>
                            <th style="width: 250px; direction: rtl; text-align: right;">اطلاعات OPU و بیمارستان</th>
                            <th style="width: 150px; direction: rtl; text-align: right;">لیست و وضعیت بیمار</th>
                            <th style="width: 100px; text-align: center;">بازرس</th>
                            <th style="width: 100px; text-align: center;  ; font-size: 13px;">Second GSC</th>
                            <th style="width: 300px; text-align: left;  ; font-size: 13px;">Reflexes</th>
                            <th style="width: 100px;">تاریخ بروزرسانی</th>
                        </tr>
                        </thead>
                        <tbody id="tableLogContent">
                        </tbody>
                    </table>
                </div>

                <div id="patientTestDiv" style="display: none;">
                    <div class="formCat">آزمایشات بیمار</div>
                    <div class="clearB"></div>
                    <table class="table table-hover table-striped custom-table"
                           style="direction: rtl;  ; font-weight: normal; font-style: normal; font-size: 12px; width: 1050px;">
                        <thead style="direction: rtl; text-align: center;  ; font-size: 12px;">
                        <tr>
                            <th style="width: 50px;">ردیف</th>
                            <th style="width: 80px;">NA</th>
                            <th style="width: 80px;">K</th>
                            <th style="width: 80px;">BUN</th>
                            <th style="width: 80px;">Urea</th>
                            <th style="width: 80px;">Ca</th>
                            <th style="width: 80px;">CR</th>
                            <th style="width: 80px;">ALT</th>
                            <th style="width: 80px;">AST</th>
                            <th style="width: 80px;">WBC</th>
                            <th style="width: 80px;">PLT</th>
                            <th style="width: 80px;">HB</th>
                            <th style="width: 80px;">BS</th>
                        </tr>
                        </thead>
                        <tbody id="tableTestContent">
                        </tbody>
                    </table>
                </div>


                <div id="patientConditionDiv" style="display: none;">
                    <div class="formCat">وضعیت پایداری بیمار</div>
                    <div class="clearB"></div>
                    <table class="table table-hover table-striped custom-table"
                           style="direction: rtl;  ; font-weight: normal; font-style: normal; font-size: 12px; width: 1050px;">
                        <thead style="direction: rtl; text-align: left;  ; font-size: 12px;">
                        <tr>
                            <th style="width: 51px;">ردیف</th>
                            <th style="width: 111px;">T</th>
                            <th style="width: 111px;">B.P</th>
                            <th style="width: 111px;">PR</th>
                            <th style="width: 111px;">RR</th>
                            <th style="width: 111px;">FIO<sub>2</sub></th>
                            <th style="width: 111px;">O<sub>2</sub>SAT</th>
                            <th style="width: 111px;">Out</th>
                            <th style="width: 111px;">Sedation</th>
                        </tr>
                        </thead>
                        <tbody id="tableConditionContent">
                        </tbody>
                    </table>
                </div>

                <div id="patientOrgansDiv" style="display: none;">
                    <div class="formCat">اعضای اهدا شده بیمار</div>
                    <div class="clearB"></div>
                    <table class="table table-hover table-striped custom-table"
                           style="direction: rtl;  ; font-weight: normal; font-style: normal; font-size: 12px; width: 1050px;">
                        <thead style="direction: rtl; text-align: center;  ; font-size: 12px;">
                        <tr>
                            <th style="width: 116px; text-align: center;">قلب</th>
                            <th style="width: 116px; text-align: center;">کبد</th>
                            <th style="width: 116px; text-align: center;">کلیه راست</th>
                            <th style="width: 116px; text-align: center;">کلیه چپ</th>
                            <th style="width: 116px; text-align: center;">ریه راست</th>
                            <th style="width: 116px; text-align: center;">ریه چپ</th>
                            <th style="width: 116px; text-align: center;">پانکراس</th>
                            <th style="width: 116px; text-align: center;">نسج</th>
                            <th style="width: 116px; text-align: center;">روده</th>
                        </tr>
                        </thead>
                        <tr>
                            <td style="width: 116px; text-align: center;" id="patientOrganHeart"></td>
                            <td style="width: 116px; text-align: center;" id="patientOrganLiver"></td>
                            <td style="width: 116px; text-align: center;" id="patientOrganRight"></td>
                            <td style="width: 116px; text-align: center;" id="patientOrganLeft"></td>
                            <td style="width: 116px; text-align: center;" id="patientOrganLungRight"></td>
                            <td style="width: 116px; text-align: center;" id="patientOrganLungLeft"></td>
                            <td style="width: 116px; text-align: center;" id="patientOrganPanc"></td>
                            <td style="width: 116px; text-align: center;" id="patientOrganTiss"></td>
                            <td style="width: 116px; text-align: center;" id="patientOrganBowel"></td>
                        </tr>
                        <tbody>
                        </tbody>
                    </table>
                </div>


                <!-- loading -->
                <div class="progress" id="viewPatientLogModalLoading" style="width: 60%; margin: 0 auto;">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                         aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                        <span class="sr-only">70% Complete</span>
                    </div>
                </div>
                <!-- loading -->
                <div id="dangerAlert2"
                     style="padding: 10px; width: 50%; margin: 0 auto;     font-weight: normal; text-align: center; display: none;"
                     class="alert alert-danger" role="alert"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="float: left; font-family: 'BYekan';"
                        data-dismiss="modal">بستن
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- view Patient log End -->

<!-- delete patient -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
     aria-hidden="true" id="deletePatientModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h5 class="modal-title" id="deleteInspectorModallabel" style=" ; font-weight: normal;">حذف کردن
                    بیمار</h5>
            </div>
            <div class="modal-body">

                <div style="width: 90%; margin: 0 auto; text-align: justify; font-family: 'BNazanin', Tahoma; font-size: 16px;"
                     id="activeQuestion"></div>

                <div class="progress" id="deleteModalLoading" style="display: none;">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                         aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                        <span class="sr-only">70% Complete</span>
                    </div>
                </div>


                <div role="alert" class="alert alert-danger"
                     style="padding: 10px; width: 100%; margin: 0 auto;     font-weight: normal; text-align: center; display: none; margin-top: 10px;"
                     id="dangerAlertStatus2">خطایی در حذف بیمار رخ داده است، لطفاً دوباره تلاش نمائید.
                </div>

                <div role="alert" class="alert alert-success"
                     style="padding: 10px; width: 100%; margin: 0 auto;     font-weight: normal; text-align: center; display: none; margin-top: 10px;"
                     id="dangerAlertStatus3">بیمار مورد نظر با موفقیت حذف شد.
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" style="float: left;  ; font-weight: normal;"
                        id="DeleteBTN">حذف کردن بیمار
                </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"
                        style="float: left;  ; font-weight: normal;">انصراف
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- delete patient -->

<!-- undo delete patient -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
     aria-hidden="true" id="undoDeletePatientModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h5 class="modal-title" id="undoDeleteInspectorModallabel" style=" ; font-weight: normal;">بازگرداندن
                    بیمار</h5>
            </div>
            <div class="modal-body">

                <div style="width: 90%; margin: 0 auto; text-align: justify; font-family: 'BNazanin', Tahoma; font-size: 16px;"
                     id="undoActiveQuestion"></div>

                <div class="progress" id="undoDeleteModalLoading" style="display: none;">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                         aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                        <span class="sr-only">70% Complete</span>
                    </div>
                </div>


                <div role="alert" class="alert alert-danger"
                     style="padding: 10px; width: 100%; margin: 0 auto;     font-weight: normal; text-align: center; display: none; margin-top: 10px;"
                     id="undoDangerAlertStatus2">خطایی در بازگرداندن بیمار رخ داده است، لطفاً دوباره تلاش نمائید.
                </div>

                <div role="alert" class="alert alert-success"
                     style="padding: 10px; width: 100%; margin: 0 auto;     font-weight: normal; text-align: center; display: none; margin-top: 10px;"
                     id="undoDangerAlertStatus3">بیمار مورد نظر با موفقیت بازگردانده شد.
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" style="float: left;  ; font-weight: normal;"
                        id="undoDeleteBTN">بازگرداندن بیمار
                </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"
                        style="float: left;  ; font-weight: normal;">انصراف
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- undo delete patient -->

<?php if ($userRole == 'ADMIN') { ?>
    <!-- transfer patient-->
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true" id="transferAPatientModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="float: left;"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h5 class="modal-title" id="transferAPatientModalLable" style=" ; font-weight: normal;">تایید/عدم
                        تایید انتقال بیمار </h5>
                </div>
                <div class="modal-body">

                    <div style="width: 90%; margin: 0 auto; text-align: justify; font-family: 'BNazanin', Tahoma; font-size: 16px;"
                         id="transferAPatientModalActiveQuestion"></div>

                    <div class="progress" id="transferAPatientModalLoading" style="display: none;">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                             aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                            <span class="sr-only">70% Complete</span>
                        </div>
                    </div>


                    <div role="alert" class="alert alert-danger"
                         style="padding: 10px; width: 100%; margin: 0 auto;     font-weight: normal; text-align: center; display: none; margin-top: 10px;"
                         id="transferAPatientModalDanger1">خطایی در تغییر وضعیت بیمار رخ داده است، لطفاٌ دوباره تلاش
                        نمائید.
                    </div>

                    <div role="alert" class="alert alert-success"
                         style="padding: 10px; width: 100%; margin: 0 auto;     font-weight: normal; text-align: center; display: none; margin-top: 10px;"
                         id="transferAPatientModalDanger2">وضعیت بیمار با موفقیت تغییر کرد.
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm" style="float: left;  ; font-weight: normal;"
                            id="transferAPatientModalBTN">ارسال اطلاعات
                    </button>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"
                            style="float: left;  ; font-weight: normal;">انصراف
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- transfer patient-->
<?php } ?>


<script>
    var options = {
        "backdrop": "static",
        "show": false
    };
    $('#editPatientModal').modal(options);
</script>