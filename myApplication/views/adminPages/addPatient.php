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

            <div id="addPatientFrom" class="container">
                <form class="form-horizontal custom-form" role="form" name="addPatientForm" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if($patientInsertStatus == 1){ ?>
                                <div role="alert" class="alert alert-success" style="width: 50%; margin: 0 auto; text-align: center;">اطلاعات بیمار مورد نظر با موفقیت ذخیره شد.</div>
                            <?php }elseif($patientInsertStatus == 2){ ?>
                                <div role="alert" class="alert alert-danger" style=" width: 50%; margin: 0 auto; text-align: center;">خطایی در ثبت اطلاعات رخ داده است، لطفا با مسئول سایت تماس بگیرید.</div>
                            <?php }elseif($patientInsertStatus == 3){ ?>
                                <div role="alert" class="alert alert-danger" style=" width: 50%; margin: 0 auto; text-align: center;">خطایی در ثبت اطلاعات رخ داده است، لطفا با مسئول سایت تماس بگیرید.</div>
                            <?php }elseif($patientInsertStatus == 4){ ?>
                                <div role="alert" class="alert alert-danger" style=" width: 50%; margin: 0 auto; text-align: center;">لطفاً موارد خواسته شده را به درستی وارد نمائید.</div>
                            <?php }elseif($patientInsertStatus == 6){ ?>
                                <div role="alert" class="alert alert-danger" style=" width: 50%; margin: 0 auto; text-align: center;">این بیمار قبلاً ثبت گردیده است.</div>
                            <?php } ?>
                        </div>
                        <div class="formCat">ورود اطلاعات بیمار</div>
                        <div class="clearB"></div>
                        <div class="col-sm-12">
                            <div role="alert" class="alert alert-warning" style=" width: 50%; margin: 0 auto; text-align: center; display: none;" id="warningAlertName"></div>
                        </div>

                        <div class="form-group col-md-12" style="margin-left: 0px; margin-right: 0px;">
                            <div style="direction: ltr; width: 100%;">
                                <label style="  font-weight: normal;">
                                    <input type="checkbox" id="chisUnknown" name="chisUnknown" value="TRUE"> این بیمار ناشناس است
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <label for="inputFileNumber" class="control-label col-sm-3" >شماره پرونده<span style="color: red;"> *</span>:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputFileNumber" name="inputFileNumber" style=" " value="" placeholder="شماره پرونده بیمار">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="inputFullName" class="control-label col-sm-3">نام و نام خانوادگی<span style="color: red;"> *</span>:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputFullName" name="inputFullName" style=" " value="" placeholder="حروف فارسی وارد نمائید">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="inputNationalCode" class="control-label col-sm-3" >کدملی:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputNationalCode" name="inputNationalCode" style="  direction: ltr;" value="" placeholder="ده رقم بدون خط تیره" maxlength="10">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <div class="row">
                                        <label for="inputAge" class="control-label col-sm-3" >سن<span style="color: red;"> *</span>:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputAge" name="inputAge" style="  direction: ltr;" value="" placeholder="سن بیمار">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="cbBodyType" class="control-label col-sm-3" >وضعیت بدنی<span style="color: red;"> *</span>:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="cbBodyType" name="cbBodyType" style="  direction: rtl;">
                                                <option value="لاغر">لاغر</option>
                                                <option value="متوسط" selected="selected">متوسط</option>
                                                <option value="چاق">چاق</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="inputFirstGCS" class="control-label col-sm-3" >GCS اولیه بیمار<span style="color: red;"> *</span>:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputFirstGCS" name="inputFirstGCS" style="  direction: ltr;" value="" placeholder="3 ~ 15">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <div class="row">
                                        <label for="cbDoc" class="control-label col-sm-3">علت اختلال هوشیاری<span style="color: red;"> *</span>:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="cbDoc" name="cbDoc" style="  direction: rtl;" disabled="disabled">
                                                <option value="0">انتخاب کنید...</option>
                                            </select>
                                            <input type="text" class="form-control" id="inputDocDetail" name="inputDocDetail" style="  margin-top: 10px; display: none;" value="" placeholder="علت اختلال هوشیاری...">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="inputPatientDetail" class="control-label col-sm-3" >توضیحات:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputPatientDetail" name="inputPatientDetail" style="  direction: rtl;" value="" placeholder="سایر توضیحات">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="formCat">اطلاعات بیمارستان</div>
                        <div class="clearB"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cbOpu" class="control-label col-sm-3">واحد فراهم آوری<span style="color: red;"> *</span>:</label>
                                    <div class="col-sm-9" >
                                        <select class="form-control" id="cbOpu" name="cbOpu" style="  direction: rtl;" disabled="disabled">
                                            <option value="0">انتخاب کنید...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cbHospitals" class="control-label col-sm-3" >نام بیمارستان<span style="color: red;"> *</span>:</label>
                                    <div  class="col-sm-9">
                                        <select class="form-control" id="cbHospitals" name="cbHospitals" style="  direction: rtl;" disabled="disabled">
                                            <option value="0">انتخاب کنید...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cbSection" class="control-label col-sm-3" >بخش<span style="color: red;"> *</span>:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="cbSection" name="cbSection" style="  direction: rtl;">
                                            <option value="0">انتخاب کنید...</option>
                                            <option value="1">ICU</option>
                                            <option value="2">CCU</option>
                                            <option value="3">اورژانس</option>
                                            <option value="4">بخش</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputTypeOfSection" class="control-label col-sm-3" >نام بخش:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="inputTypeOfSection" name="inputTypeOfSection" style="  direction: ltr;" value="" placeholder="نام بخش">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cbPresentioan" class="control-label col-sm-3" >نحوه شناسایی بیمار<span style="color: red;"> *</span>:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="cbPresentioan" name="cbPresentioan" style="  direction: rtl;">
                                            <option value="0">انتخاب کنید...</option>
                                            <option value="1">بازرس حضوری (IP)</option>
                                            <option value="2">بازرس تلفنی (TDD)</option>
                                            <option value="3">گزارش بیمارستانی (HR)</option>
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
                                    <label for="cbTol" class="control-label col-sm-3">نوع لیست<span style="color: red;"> *</span>:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="cbTol" name="cbTol" style="  direction: rtl;">
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
                                <div class="form-group">
                                    <label for="cbPatientStatus" class="control-label col-sm-3">وضعیت بیمار<span style="color: red;"> *</span>:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="cbPatientStatus" name="cbPatientStatus" style="  direction: rtl;">
                                            <option value="0">انتخاب کنید...</option>
                                        </select>
                                        <input type="text" class="form-control" id="inputPatientStatusDetail" name="inputPatientStatusDetail" style="  margin-top: 10px; display: none;" value="" placeholder="وضعیت بیمار ...">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="formCat">رفلکس های بیمار</div>
                        <div class="clearB"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cbBreathing" class="control-label col-sm-3" >Breathing (تنفس):</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="cbBreathing" name="cbBreathing" style="  direction: rtl;">
                                            <option value="U">نا معلوم (U)</option>
                                            <option value="P">دارد (P)</option>
                                            <option value="N">ندارد (N)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputBreathingDetail" class="control-label col-sm-3">تعداد/دقیقه:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="inputBreathingDetail" name="inputBreathingDetail" style="  direction: ltr;" value="" placeholder="per/min">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cbCornea" class="control-label  col-sm-3">Cornea (قرنیه):</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="cbCornea" name="cbCornea" style="  direction: rtl;">
                                            <option value="U">نا معلوم (U)</option>
                                            <option value="P">دارد (P)</option>
                                            <option value="N">ندارد (N)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cbPupil" class="control-label col-sm-3" >Pupil (مردمک):</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="cbPupil" name="cbPupil" style="  direction: rtl;">
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
                                <div class="form-group" >
                                    <label for="cbFaceMove" class="control-label col-sm-3" >Face Movement (حرکات صورت):</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="cbFaceMove" name="cbFaceMove" style="  direction: rtl;">
                                            <option value="U">نا معلوم (U)</option>
                                            <option value="P">دارد (P)</option>
                                            <option value="N">ندارد (N)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputFaceMovementDetail" class="control-label col-sm-3" >توضیحات:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="inputFaceMovementDetail" name="inputFaceMovementDetail" style="  direction: rtl;" value="" placeholder="توضیحات حرکات صورت">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cbBodyMove" class="control-label col-sm-3" >Body Movement (حرکات بدن):</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="cbBodyMove" name="cbBodyMove" style="  direction: rtl;">
                                            <option value="U">نا معلوم (U)</option>
                                            <option value="P">دارد (P)</option>
                                            <option value="N">ندارد (N)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputBodyMovementDetail" class="control-label col-sm-3" >توضیحات:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="inputBodyMovementDetail" name="inputBodyMovementDetail" style="  direction: rtl;" value="" placeholder="توضیحات حرکات بدن">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label for="cbDoll" class="control-label col-sm-3" >Doll's Eye (چشم‌عروسکی):</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="cbDoll" name="cbDoll" style="  direction: rtl;">
                                            <option value="U">نا معلوم (U)</option>
                                            <option value="P">دارد (P)</option>
                                            <option value="N">ندارد (N)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cbGag" class="control-label col-sm-3" >Gag (بلع):</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="cbGag" name="cbGag" style="  direction: rtl;">
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
                                    <label for="cbCough" class="control-label col-sm-3" >Cough (سرفه):</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="cbCough" name="cbCough" style="  direction: rtl;">
                                            <option value="U">نا معلوم (U)</option>
                                            <option value="P">دارد (P)</option>
                                            <option value="N">ندارد (N)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- GCS3 brain death data -->
                        <div id="GCS3Patients" style="display: block;">
                            <!-- The patient's condition start -->
                            <div class="formCat">وضعیت پایداری بیمار</div>
                            <div class="clearB"></div>

                            <div style="margin-left: 0px; margin-right: 0px; direction: ltr;" class="form-group">
                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px;" class="control-label" for="inputT">T:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="20 ~ 50" maxlength="4" value="" style="   direction: ltr;" name="inputT" id="inputT" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputPR">PR:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 200" maxlength="3" value="" style="   direction: ltr;" name="inputPR" id="inputPR" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputFIO2">FIO<sub>2</sub>:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 100" maxlength="3" value="" style="   direction: ltr;" name="inputFIO2" id="inputFIO2" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputOut">Out:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 3000 ml/hr" maxlength="4" value="" style="   direction: ltr;" name="inputOut" id="inputOut" class="form-control">
                                </div>
                            </div>
                            <div style="margin-left: 0px; margin-right: 0px; direction: ltr;" class="form-group">
                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px;" class="control-label" for="inputBPb">B.P:</label>
                                <div style="float: left; width: 85px;">
                                    <input type="text" placeholder="0 ~ 300" maxlength="3" value="" style="   direction: ltr;" name="inputBPb" id="inputBPb" class="form-control">
                                </div>
                                <label style="float: left;    font-weight: normal; text-align: left; width: 10px;" class="control-label" for="inputBPp">.</label>
                                <div style="float: left; width: 85px;">
                                    <input type="text" placeholder="0 ~ 200" maxlength="3" value="" style="   direction: ltr;" name="inputBPp" id="inputBPp" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputRR">RR:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 100" maxlength="3" value="" style="   direction: ltr;" name="inputRR" id="inputRR" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputO2SAT">O<sub>2</sub>Sat:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 100" maxlength="3" value="" style="   direction: ltr;" name="inputO2SAT" id="inputO2SAT" class="form-control">
                                </div>
                            </div>
                            <div style="margin-left: 0px; margin-right: 0px;" class="form-group">
                                <label style="float: right;   font-weight: normal; direction: rtl; width: 320px;" class="checkbox-inline" for="cbSedation2"> آیا بیمار داروهای آرام بخش (Sedation) دریافت می کند؟</label>
                                <div style="float: right; direction: ltr; width: 50px; padding-top: 10px;">
                                    <input type="checkbox" style="direction: rtl;" value="TRUE" name="cbSedation2" id="cbSedation2">
                                </div>
                            </div>
                            <!-- The patient's condition end -->

                            <!-- Patient tests start -->
                            <div class="formCat">آزمایشات بیمار</div>
                            <div class="clearB"></div>

                            <div style="margin-left: 0px; margin-right: 0px; direction: ltr;" class="form-group">
                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px;" class="control-label" for="inputNa">Na:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 300" maxlength="3" value="" style="   direction: ltr;" name="inputNa" id="inputNa" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputK">K:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 20" maxlength="4" value="" style="   direction: ltr;" name="inputK" id="inputK" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputBUN">BUN:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 200" maxlength="3" value="" style="   direction: ltr;" name="inputBUN" id="inputBUN" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputUrea">Urea:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 500" maxlength="3" value="" style="   direction: ltr;" name="inputUrea" id="inputUrea" class="form-control">
                                </div>

                            </div>
                            <div style="margin-left: 0px; margin-right: 0px; direction: ltr;" class="form-group">
                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px;" class="control-label" for="inputALT">ALT:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 2000" maxlength="4" value="" style="   direction: ltr;" name="inputALT" id="inputALT" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputAST">AST:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 2000" maxlength="4" value="" style="   direction: ltr;" name="inputAST" id="inputAST" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputHb">Hgb:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 30" maxlength="4" value="" style="   direction: ltr;" name="inputHb" id="inputHb" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputWBC">WBC:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 100000" maxlength="6" value="" style="   direction: ltr;" name="inputWBC" id="inputWBC" class="form-control">
                                </div>

                            </div>
                            <div style="margin-left: 0px; margin-right: 0px; direction: ltr;" class="form-group">
                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px;" class="control-label" for="inputPLT">PLT:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="1000 ~ 999000" maxlength="6" value="" style="   direction: ltr;" name="inputPLT" id="inputPLT" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputBs">Bs:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 1000" maxlength="4" value="" style="   direction: ltr;" name="inputBs" id="inputBs" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputCr">Cr:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 20" maxlength="4" value="" style="   direction: ltr;" name="inputCr" id="inputCr" class="form-control">
                                </div>

                                <label style="float: left;    font-weight: normal; text-align: left; width: 50px; margin-left: 20px;" class="control-label" for="inputCa">Ca:</label>
                                <div style="float: left; width: 180px;">
                                    <input type="text" placeholder="0 ~ 20" maxlength="4" value="" style="   direction: ltr;" name="inputCa" id="inputCa" class="form-control">
                                </div>

                            </div>
                            <!-- Patient tests end -->
                        </div>
                        <!-- GCS3 brain death data -->

                        <div class="formCat">تاریخ شناسایی بیمار</div>
                        <div class="clearB"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rdAddDate1" class="control-label col-sm-3">تاریخ شناسایی بیمار:</label>
                                    <div class="col-sm-9">
                                        <div style="margin-right: 25px; direction: rtl;" class="radio">
                                            <label style="  font-size: 15px; line-height: 26px;">
                                                <input type="radio" style="margin-right: -20px;" checked="checked" value="toDay" id="rdAddDate1" name="rdAddDate">
                                                امروز - <?php  echo pdate('Y/n/d'); ?> </label>

                                            <br>

                                            <label style="  font-size: 15px; line-height: 26px;">
                                                <input type="radio" style="margin-right: -20px;" value="lastDay" id="rdAddDate2" name="rdAddDate">
                                                دیروز - <?php  echo pdate('Y/n/d', strtotime("-1 days")); ?> </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rdAddDate1" class="control-label col-sm-3" >ساعت<span style="color: red;"> *</span>:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="cbMin" name="cbMin" style="  direction: rtl; width: 80px; float: right;">
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
                                        <select class="form-control" id="cbHour" name="cbHour" style="  direction: rtl; width: 80px; float: right;">
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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success" style="float: left;   margin-bottom: 15px;" id="saveBTN">ارسال اطلاعات</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto;   font-weight: normal; text-align: center; display: none;" id="dangerAlert">لطفاً موارد خواسته شده را به درستی وارد نمائید.</div>
                            </div>
                            <div class="col-md-12">
                                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto;   font-weight: normal; text-align: center; display: none;" id="dangerAlert2">وارد نمودن آزمایشات به درستی الزامی می باشد.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <?php if($patientInsertStatus == 1){ ?>
                                    <div role="alert" class="alert alert-success" style="padding: 10px; width: 50%; margin: 0 auto;   font-weight: normal; text-align: center;">اطلاعات بیمار مورد نظر با موفقیت ذخیره شد.</div>
                                <?php }elseif($patientInsertStatus == 2){ ?>
                                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto;   font-weight: normal; text-align: center;">خطایی در ثبت اطلاعات رخ داده است، لطفا با مسئول سایت تماس بگیرید.</div>
                                <?php }elseif($patientInsertStatus == 3){ ?>
                                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto;   font-weight: normal; text-align: center;">خطایی در ثبت اطلاعات رخ داده است، لطفا با مسئول سایت تماس بگیرید.</div>
                                <?php }elseif($patientInsertStatus == 4){ ?>
                                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto;   font-weight: normal; text-align: center;">لطفاً موارد خواسته شده را به درستی وارد نمائید.</div>
                                <?php }elseif($patientInsertStatus == 6){ ?>
                                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto;   font-weight: normal; text-align: center;">این بیمار قبلاً ثبت گردیده است.</div>
                                <?php }elseif($patientInsertStatus == 7){ ?>
                                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto;   font-weight: normal; text-align: center;">وارد نمودن آزمایشات به درستی الزامی می باشد.</div>
                                <?php }elseif($patientInsertStatus == 8){ ?>
                                    <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto;   font-weight: normal; text-align: center;">بخشی از اطلاعات به صورت ناقص وارد شده است، لطفاً دوباره تلاش نمائید.</div>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
            </div>
            </form>
        </div>

    </div>


</div>
</div>
</div>

<script>
    $(document).ready(function(){
        addPatient();
    });
</script>