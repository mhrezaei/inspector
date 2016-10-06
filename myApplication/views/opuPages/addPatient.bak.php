<title><?php echo $siteTitle; ?> | افزودن بیمار جدید</title>
<style type="text/css">
    #states th, #states td{
        text-align: right;
    }
</style>
<div class="panel panel-default panelContent" id="loginInfo">
    <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">افزودن بیمار جدید</h3>
        <div class="glyphicon glyphicon-remove panelInfoBTN" id="loginInfoRemove" onclick="showPanel('loginInfo', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelInfoBTN" id="loginInfoMinus" onclick="showPanel('loginInfo', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="loginInfoPlus" onclick="showPanel('loginInfo', 'p')"></div>
        <div class="clearB"></div>
    </div>
    <div class="panel-body panelBodyText" id="loginInfoBody" style="width: 100%; text-align: right; margin: 0 auto;">
        <div style="width: 100%; height: auto; direction: rtl; margin: 0 auto;">

            <div id="addPatientFrom" style="width: 1000px; margin: 0 auto;">
                <form class="form-horizontal" role="form" name="addPatientForm" method="post">
                <?php if($data['patientInsertStatus'] == 1){ ?>
                    <div role="alert" class="alert alert-success" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">اطلاعات بیمار مورد نظر با موفقیت ذخیره شد.</div>
                    <?php }elseif($data['patientInsertStatus'] == 2){ ?>
                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">خطایی در ثبت اطلاعات رخ داده است، لطفا با مسئول سایت تماس بگیرید.</div>
                    <?php }elseif($data['patientInsertStatus'] == 3){ ?>
                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">خطایی در ثبت اطلاعات رخ داده است، لطفا با مسئول سایت تماس بگیرید.</div>
                    <?php }elseif($data['patientInsertStatus'] == 4){ ?>
                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">لطفا موارد ستاره دار را به درستی تکمیل نمائید.</div>
                    <?php }elseif($data['patientInsertStatus'] == 6){ ?>
                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">این بیمار قبلاً ثبت گردیده است.</div>
                    <?php } ?>

                <div class="formCat">ورود اطلاعات بیمار</div>
                <div class="clearB"></div>
                <div role="alert" class="alert alert-warning" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="warningAlertName"></div>
                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                    <div style="direction: ltr; width: 100%;">
                        <label class="checkbox-inline" style="font-family: 'BNazanin'; font-weight: normal;">
                            <input type="checkbox" id="chisUnknown" name="chisUnknown" value="TRUE"> این بیمار ناشناس است
                        </label>
                    </div>
                </div>

                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                    <label for="inputFileNumber" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">شماره پرونده<span style="color: red;"> *</span>:</label>
                    <div style="float: right; width: 200px;">
                        <input type="text" class="form-control" id="inputFileNumber" name="inputFileNumber" style="font-family: 'BNazanin';" value="" placeholder="شماره پرونده بیمار">
                    </div>

                    <label for="inputFullName" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px; padding-right: 10px;">نام و نام خانوادگی<span style="color: red;"> *</span>:</label>
                    <div style="float: right; width: 230px;">
                        <input type="text" class="form-control" id="inputFullName" name="inputFullName" style="font-family: 'BNazanin';" value="" placeholder="نام و نام خانوادگی بیمار">
                    </div>

                    <label for="inputNationalCode" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 80px; padding-right: 10px;">کدملی:</label>
                    <div style="float: right; width: 230px;">
                        <input type="text" class="form-control" id="inputNationalCode" name="inputNationalCode" style="font-family: 'BNazanin'; direction: ltr;" value="" placeholder="کدملی بیمار" maxlength="10">

                    </div>
                </div>



                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                    <label for="inputAge" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">سن<span style="color: red;"> *</span>:</label>
                    <div style="float: right; width: 200px;">
                        <input type="text" class="form-control" id="inputAge" name="inputAge" style="font-family: 'BNazanin'; direction: ltr;" value="" placeholder="سن بیمار">
                    </div>
                    <label for="cbBodyType" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; padding-right: 10px;">وضعیت بدنی<span style="color: red;"> *</span>:</label>
                    <div style="float: right; width: 230px;">
                        <select class="form-control" id="cbBodyType" name="cbBodyType" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="لاغر">لاغر</option>
                            <option value="متوسط" selected="selected">متوسط</option>
                            <option value="چاق">چاق</option>
                        </select>
                    </div>
                    <label for="inputFirstGCS" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; padding-right: 10px;">GCS اولیه بیمار<span style="color: red;"> *</span>:</label>
                    <div style="float: right; width: 180px;">
                        <input type="text" class="form-control" id="inputFirstGCS" name="inputFirstGCS" style="font-family: 'BNazanin'; direction: ltr;" value="" placeholder="GCS اولیه بیمار">
                    </div>
                </div>


                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                    <label for="cbDoc" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px;">علت اختلال هوشیاری<span style="color: red;"> *</span>:</label>
                    <div style="float: right; width: 200px;">
                        <select class="form-control" id="cbDoc" name="cbDoc" style="font-family: 'BNazanin'; direction: rtl;" disabled="disabled">
                            <option value="0">انتخاب کنید...</option>
                        </select>
                        <input type="text" class="form-control" id="inputDocDetail" name="inputDocDetail" style="font-family: 'BNazanin'; margin-top: 10px; display: none;" value="" placeholder="علت اختلال هوشیاری...">
                    </div>

                    <label for="inputPatientDetail" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 90px; padding-right: 10px;">توضیحات:</label>
                    <div style="float: right; width: 580px;">
                        <input type="text" class="form-control" id="inputPatientDetail" name="inputPatientDetail" style="font-family: 'BNazanin'; direction: rtl;" value="" placeholder="سایر توضیحات">
                    </div>

                </div>

                <div class="formCat">اطلاعات بیمارستان</div>
                <div class="clearB"></div>


                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">

                    <label for="cbHospitals" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; padding-right: 10px;">نام بیمارستان<span style="color: red;"> *</span>:</label>
                    <div style="float: right; width: 370px;">
                        <select class="form-control" id="cbHospitals" name="cbHospitals" style="font-family: 'BNazanin'; direction: rtl;" <?php if(count($opu) < 1){echo 'disabled="disabled"';} ?>>
                            <option value="0">انتخاب کنید...</option>
                            <?php
                                if(count($opu) > 0)
                                {
                                    for($i = 0; $i < count($opu); $i++)
                                    {
                                        echo '<option value="' . $opu[$i]['id'] . '">' . $opu[$i]['name'] . '</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                    <label for="cbSection" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px;">بخش<span style="color: red;"> *</span>:</label>
                    <div style="float: right; width: 200px;">
                        <select class="form-control" id="cbSection" name="cbSection" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید...</option>
                            <option value="1">ICU</option>
                            <option value="2">CCU</option>
                            <option value="3">اورژانس</option>
                            <option value="4">بخش</option>
                        </select>
                    </div>

                    <label for="inputTypeOfSection" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 90px; padding-right: 10px;">نام بخش:</label>
                    <div style="float: right; width: 200px;">
                        <input type="text" class="form-control" id="inputTypeOfSection" name="inputTypeOfSection" style="font-family: 'BNazanin'; direction: ltr;" value="" placeholder="نام بخش">
                    </div>

                    <label for="cbPresentioan" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; padding-right: 10px">نحوه شناسایی بیمار<span style="color: red;"> *</span>:</label>
                    <div style="float: right; width: 250px;">
                        <select class="form-control" id="cbPresentioan" name="cbPresentioan" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید...</option>
                            <option value="1">بازرس حضوری (IP)</option>
                            <option value="2">بازرس تلفنی (TDD)</option>
                            <option value="3">گزارش بیمارستانی (HR)</option>
                        </select>
                    </div>
                </div>



                <div class="formCat">اطلاعات ثبت</div>
                <div class="clearB"></div>


                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                    <label for="cbTol" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px;">نوع لیست<span style="color: red;"> *</span>:</label>
                    <div style="float: right; width: 370px;">
                        <select class="form-control" id="cbTol" name="cbTol" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید...</option>
                            <option value="1">بیماران GCS3 مرگ مغزی شده</option>
                            <option value="2">بیماران GCS3 مرگ مغزی نشده</option>
                            <option value="3">بیماران GCS4,5</option>
                            <option value="4">بیماران نامناسب</option>
                        </select>
                    </div>

                    <label for="cbPatientStatus" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; padding-right: 10px;">وضعیت بیمار<span style="color: red;"> *</span>:</label>
                    <div style="float: right; width: 370px;">
                        <select class="form-control" id="cbPatientStatus" name="cbPatientStatus" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید...</option>
                        </select>
                        <input type="text" class="form-control" id="inputPatientStatusDetail" name="inputPatientStatusDetail" style="font-family: 'BNazanin'; margin-top: 10px; display: none;" value="" placeholder="وضعیت بیمار ...">
                    </div>
                </div>


                <div class="formCat">رفلکس های بیمار</div>
                <div class="clearB"></div>

                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                    <label for="cbBreathing" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px;">Breathing (تنفس):</label>
                    <div style="float: right; width: 170px;">
                        <select class="form-control" id="cbBreathing" name="cbBreathing" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>
                    <label for="inputBreathingDetail" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; padding-right: 10px;">تعداد/دقیقه:</label>
                    <div style="float: right; width: 220px;">
                        <input type="text" class="form-control" id="inputBreathingDetail" name="inputBreathingDetail" style="font-family: 'BNazanin'; direction: ltr;" value="" placeholder="per/min">
                    </div>
                </div>

                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                    <label for="cbCornea" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px;">Cornea (قرنیه):</label>
                    <div style="float: right; width: 170px;">
                        <select class="form-control" id="cbCornea" name="cbCornea" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>
                    <label for="cbPupil" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; padding-right: 10px;">Pupil (مردمک):</label>
                    <div style="float: right; width: 220px;">
                        <select class="form-control" id="cbPupil" name="cbPupil" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>    
                </div>

                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                    <label for="cbFaceMove" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; line-height: 15px;">Face Movement (حرکات صورت):</label>
                    <div style="float: right; width: 170px;">
                        <select class="form-control" id="cbFaceMove" name="cbFaceMove" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>
                    <label for="inputFaceMovementDetail" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; padding-right: 10px;">توضیحات:</label>
                    <div style="float: right; width: 570px;">
                        <input type="text" class="form-control" id="inputFaceMovementDetail" name="inputFaceMovementDetail" style="font-family: 'BNazanin'; direction: rtl;" value="" placeholder="توضیحات حرکات صورت">
                    </div>
                </div>    

                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                    <label for="cbBodyMove" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; line-height: 15px;">Body Movement (حرکات بدن):</label>
                    <div style="float: right; width: 170px;">
                        <select class="form-control" id="cbBodyMove" name="cbBodyMove" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>
                    <label for="inputBodyMovementDetail" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; padding-right: 10px;">توضیحات:</label>
                    <div style="float: right; width: 570px;">
                        <input type="text" class="form-control" id="inputBodyMovementDetail" name="inputBodyMovementDetail" style="font-family: 'BNazanin'; direction: rtl;" value="" placeholder="توضیحات حرکات بدن">
                    </div>
                </div>

                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                    <label for="cbDoll" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; line-height: 15px;">Doll's Eye (چشم‌عروسکی):</label>
                    <div style="float: right; width: 170px;">
                        <select class="form-control" id="cbDoll" name="cbDoll" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>

                    <label for="cbGag" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; padding-right: 10px;">Gag (بلع):</label>
                    <div style="float: right; width: 220px;">
                        <select class="form-control" id="cbGag" name="cbGag" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>

                    <label for="cbCough" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; text-align: right; width: 130px; padding-right: 10px;">Cough (سرفه):</label>
                    <div style="float: right; width: 220px;">
                        <select class="form-control" id="cbCough" name="cbCough" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-left: 0px; margin-right: 0px;" id="firstSedationQ">
                    <label for="cbSedation" class="checkbox-inline" style="float: right; font-family: 'BNazanin'; font-weight: normal; direction: rtl; width: 320px;">این بیمار داروهای آرامبخش (Sedation) دریافت می کند</label>
                    <div style="float: right; direction: ltr; width: 50px; padding-top: 10px;">
                        <input type="checkbox" id="cbSedation" name="cbSedation" value="TRUE" style="direction: rtl;">
                    </div>
                </div>

                <!-- GCS3 brain death data -->
                <div id="GCS3Patients" style="display: none;">
                    <!-- The patient's condition start -->
                    <div class="formCat">وضعیت پایداری بیمار</div>
                    <div class="clearB"></div>

                    <div style="margin-left: 0px; margin-right: 0px; direction: ltr;" class="form-group">
                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px;" class="control-label" for="inputT">T:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="T" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputT" id="inputT" class="form-control">
                        </div>

                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputPR">PR:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="PR" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputPR" id="inputPR" class="form-control">
                        </div>

                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputFIO2">FIO<sub>2</sub>:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="FIO2" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputFIO2" id="inputFIO2" class="form-control">
                        </div>

                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputOut">Out:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="Out/Last 6hr" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputOut" id="inputOut" class="form-control">
                        </div>
                    </div>
                    <div style="margin-left: 0px; margin-right: 0px; direction: ltr;" class="form-group">
                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px;" class="control-label" for="inputBP">B.P:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="B.P" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputBP" id="inputBP" class="form-control">
                        </div>

                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputRR">RR:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="RR" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputRR" id="inputRR" class="form-control">
                        </div>

                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputO2SAT">O<sub>2</sub>Sat:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="O2Sat" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputO2SAT" id="inputO2SAT" class="form-control">
                        </div>
                    </div>
                    <div style="margin-left: 0px; margin-right: 0px;" class="form-group">
                        <label style="float: right; font-family: 'BNazanin'; font-weight: normal; direction: rtl; width: 320px;" class="checkbox-inline" for="cbSedation2"> آیا بیمار داروهای آرام بخش (Sedation) دریافت می کند؟</label>
                        <div style="float: right; direction: ltr; width: 50px; padding-top: 10px;">
                            <input type="checkbox" style="direction: rtl;" value="TRUE" name="cbSedation2" id="cbSedation2">
                        </div>
                    </div>
                    <!-- The patient's condition end -->

                    <!-- Patient tests start -->
                    <div class="formCat">آزمایشات بیمار</div>
                    <div class="clearB"></div>

                    <div style="margin-left: 0px; margin-right: 0px; direction: ltr;" class="form-group">
                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px;" class="control-label" for="inputNa">Na:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="Na" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputNa" id="inputNa" class="form-control">
                        </div>

                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputK">K:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="K" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputK" id="inputK" class="form-control">
                        </div>

                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputBUN">BUN:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="BUN" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputBUN" id="inputBUN" class="form-control">
                        </div> 

                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputCr">Cr:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="Cr" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputCr" id="inputCr" class="form-control">
                        </div>

                    </div>
                    <div style="margin-left: 0px; margin-right: 0px; direction: ltr;" class="form-group">
                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px;" class="control-label" for="inputALT">ALT:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="ALT" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputALT" id="inputALT" class="form-control">
                        </div>

                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputAST">AST:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="AST" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputAST" id="inputAST" class="form-control">
                        </div>

                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputHb">Hb:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="Hb" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputHb" id="inputHb" class="form-control">
                        </div>

                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputWBC">WBC:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="WBC" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputWBC" id="inputWBC" class="form-control">
                        </div>

                    </div>
                    <div style="margin-left: 0px; margin-right: 0px; direction: ltr;" class="form-group">
                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px;" class="control-label" for="inputPLT">PLT:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="PLT" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputPLT" id="inputPLT" class="form-control">
                        </div>

                        <label style="float: left; font-family: 'webYekan'; font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputBs">Bs:</label>
                        <div style="float: left; width: 180px;">
                            <input type="text" placeholder="Bs" value="" style="font-family: 'webYekan'; direction: ltr;" name="inputBs" id="inputBs" class="form-control">
                        </div>

                    </div>
                    <!-- Patient tests end -->
                </div>
                <!-- GCS3 brain death data -->


                <div class="formCat">تاریخ شناسایی بیمار</div>
                <div class="clearB"></div>


                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                    <label for="rdAddDate1" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">تاریخ شناسایی بیمار:</label>
                    <div style="direction: ltr; width: 190px; float: right;">
                        <div style="margin-right: 25px; direction: rtl;" class="radio">
                            <label style="font-family: 'BYekan'; font-size: 15px; line-height: 26px;">
                                <input type="radio" style="margin-right: -20px;" checked="checked" value="toDay" id="rdAddDate1" name="rdAddDate">
                                امروز - <?php  echo pdate('Y/n/d'); ?> </label>

                            <br>

                            <label style="font-family: 'BYekan'; font-size: 15px; line-height: 26px;">
                                <input type="radio" style="margin-right: -20px;" value="lastDay" id="rdAddDate2" name="rdAddDate">
                                دیروز - <?php  echo pdate('Y/n/d', strtotime("-1 days")); ?> </label>
                        </div>
                    </div>

                    <label for="rdAddDate1" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 55px;">ساعت<span style="color: red;"> *</span>:</label>
                    <div style="direction: rtl; width: 320px; float: right;">
                        <select class="form-control" id="cbMin" name="cbMin" style="font-family: 'BNazanin'; direction: rtl; width: 80px; float: right;">
                            <option value="min" selected="selected">دقیقه</option>
                            <?php
                                for($i = 0; $i < 60; $i++)
                                {
                                    if($i < 10)
                                    {
                                        $ziro = 0;
                                    }
                                    else
                                    {
                                        $ziro = '';
                                    }
                                    echo '<option value="' . $ziro . $i . '">' . $ziro . $i . '</option>';
                                }
                            ?>
                        </select>
                        <div style="width: 20px; float: right; text-align: center; line-height: 33px;">:</div>
                        <select class="form-control" id="cbHour" name="cbHour" style="font-family: 'BNazanin'; direction: rtl; width: 80px; float: right;">
                            <option value="hour" selected="selected">ساعت</option>
                            <?php
                                for($i = 0; $i < 24; $i++)
                                {
                                    if($i < 10)
                                    {
                                        $ziro = 0;
                                    }
                                    else
                                    {
                                        $ziro = '';
                                    }
                                    echo '<option value="' . $ziro . $i . '">' . $ziro . $i . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <button type="button" class="btn btn-success" style="float: left; font-family: 'BYekan';" id="saveBTN">ارسال اطلاعات</button>

                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none; margin-bottom: 15px;" id="dangerAlert">لطفا موارد ستاره دار را به درستی تکمیل نمائید.</div>
                <?php if($data['patientInsertStatus'] == 1){ ?>
                    <div role="alert" class="alert alert-success" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">اطلاعات بیمار مورد نظر با موفقیت ذخیره شد.</div>
                    <?php }elseif($data['patientInsertStatus'] == 2){ ?>
                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">خطایی در ثبت اطلاعات رخ داده است، لطفا با مسئول سایت تماس بگیرید.</div>
                    <?php }elseif($data['patientInsertStatus'] == 3){ ?>
                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">خطایی در ثبت اطلاعات رخ داده است، لطفا با مسئول سایت تماس بگیرید.</div>
                    <?php }elseif($data['patientInsertStatus'] == 4){ ?>
                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">لطفا موارد ستاره دار را به درستی تکمیل نمائید.</div>
                    <?php }elseif($data['patientInsertStatus'] == 6){ ?>
                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center;">این بیمار قبلاً ثبت گردیده است.</div>
                    <?php } ?>

            </div>
            </form>
        </div>

    </div>


</div>
</div>
</div>

<script>
    $(document).ready(function(){
        addPatientOI();
    });
</script>