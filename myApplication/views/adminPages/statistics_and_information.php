<title><?php echo $siteTitle; ?> | آمار و اطلاعات عملیاتی</title>
<link href="<?php echo asset_url(); ?>css/js-persian-cal.css" rel="stylesheet" type="text/css">
<style type="text/css">
    #states th, #states td{
        text-align: right;
    }
    .pcalBtn{
        float: right;
    }
    .inputTime{
        width: calc(100% - 25px);
        float: right;
    }
    .stNumber, #stNumber{
        /*color: blue;*/
        cursor: pointer;
    }
</style>
<div class="panel panel-default panelContent" id="loginInfo">
    <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">آمار و اطلاعات عملیاتی</h3>
        <div class="glyphicon glyphicon-remove panelInfoBTN" id="loginInfoRemove" onclick="showPanel('loginInfo', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelInfoBTN" id="loginInfoMinus" onclick="showPanel('loginInfo', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="loginInfoPlus" onclick="showPanel('loginInfo', 'p')"></div>
        <div class="clearB"></div>
    </div>
    <div class="panel-body panelBodyText" id="loginInfoBody" style="width: 100%; text-align: right; margin: 0 auto;">
        <div style="width: 100%; height: auto; direction: rtl; margin: 0 auto;">

            <div id="addPatientFrom" style="width: 1000px; margin: 0 auto;">
                <form class="" role="form" name="statisticsInformationForm" id="statisticsInformationForm" method="post" target="_blank" action="<?php echo base_url(); ?>admin/statistics_out">

                <div class="formCat">مشخصات فردی و سطح هوشیاری</div>
                <div class="clearB"></div>
                <div role="alert" class="alert alert-warning" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="warningAlertName"></div>
                    <div style="clear: both;"></div>
                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtName" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">نام بیمار</label>
                        <input type="text" class="form-control" id="txtName" name="txtName" style="font-family: 'BNazanin';" value="" placeholder="نام بیمار">
                    </div>

                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtAge" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">سن بیمار</label>
                        <input type="text" class="form-control" id="txtAge" name="txtAge" style="font-family: 'BNazanin';" value="" placeholder="سن بیمار">
                    </div>

                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtBodyType" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">وضعیت بدنی بیمار</label>
                        <select class="form-control" id="txtBodyType" name="txtBodyType" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0" selected="selected">همه بیماران</option>
                            <option value="لاغر">لاغر</option>
                            <option value="متوسط">متوسط</option>
                            <option value="چاق">چاق</option>
                        </select>
                    </div>

                    <div style="clear: both;"></div>
                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtFirstGCS" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">GCS زمان شناسایی</label>
                        <input type="text" class="form-control" id="txtFirstGCS" name="txtFirstGCS" style="font-family: 'BNazanin';" value="" placeholder="GCS زمان شناسایی">
                    </div>

                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtSecondGCS" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">GCS نهایی</label>
                        <input type="text" class="form-control" id="txtSecondGCS" name="txtSecondGCS" style="font-family: 'BNazanin';" value="" placeholder="GCS نهایی">
                    </div>

                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtIsUnknown" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">بیمار ناشناس</label>
                        <select class="form-control" id="txtIsUnknown" name="txtIsUnknown" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="5" selected="selected">همه بیماران</option>
                            <option value="0">خیر</option>
                            <option value="1">بله</option>
                        </select>
                    </div>

                    <div class="clearB"></div>
                    <div class="formCat">نوع لیست، وضعیت بیمار، نحوه شناسایی و علت اختلال هوشیاری</div>
                    <div class="clearB"></div>

                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtTypeOfList1" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">نوع لیست اولیه</label>
                        <select class="form-control" id="txtTypeOfList1" name="txtTypeOfList1" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">همه بیماران</option>
                            <option value="1">بیماران GCS3 مرگ مغزی شده</option>
                            <option value="2">بیماران GCS3 مرگ مغزی نشده</option>
                            <option value="3">بیماران GCS4,5</option>
                            <option value="4">بیماران نامناسب</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtPatientStatus1" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">وضعیت اولیه بیمار</label>
                        <select class="form-control" id="txtPatientStatus1" name="txtPatientStatus1" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">همه بیماران</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtDoc" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">علت اختلال هوشیاری</label>
                        <select class="form-control" id="txtDoc" name="txtDoc" style="font-family: 'BNazanin'; direction: rtl;" disabled="disabled">
                            <option value="0">همه بیماران</option>
                        </select>
                    </div>

                    <div class="clearB"></div>

                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtTypeOfList2" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">نوع لیست نهایی</label>
                        <select class="form-control" id="txtTypeOfList2" name="txtTypeOfList2" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">همه بیماران</option>
                            <option value="1">بیماران GCS3 مرگ مغزی شده</option>
                            <option value="2">بیماران GCS3 مرگ مغزی نشده</option>
                            <option value="3">بیماران GCS4,5</option>
                            <option value="4">بیماران نامناسب</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtPatientStatus2" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">وضعیت نهایی بیمار</label>
                        <select class="form-control" id="txtPatientStatus2" name="txtPatientStatus2" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">همه بیماران</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtPresentioan" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">نحوه شناسایی بیمار</label>
                        <select class="form-control" id="txtPresentioan" name="txtPresentioan" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">همه بیماران</option>
                            <option value="1">بازرس حضوری (IP)</option>
                            <option value="2">بازرس تلفنی (TDD)</option>
                            <option value="3">گزارش بیمارستانی (HR)</option>
                        </select>
                    </div>

                    <div class="clearB"></div>
                    <div class="formCat">اطلاعات واحد فراهم آوری، استان و شهر</div>
                    <div class="clearB"></div>

                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtOpu" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">واحد فراهم آوری</label>
                        <select class="form-control" id="txtOpu" name="txtOpu" style="font-family: 'BNazanin'; direction: rtl;" disabled="disabled" onchange="insertInspectors('txtFirstInspector', 'txtOpu', false);insertInspectors('txtSecondInspector', 'txtOpu', false);">
                            <option value="0">انتخاب کنید...</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtHospital" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">بیمارستان</label>
                        <select class="form-control" id="txtHospital" name="txtHospital" style="font-family: 'BNazanin'; direction: rtl;" disabled="disabled">
                            <option value="0">انتخاب کنید...</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4" style="float: right;">
                        <label for="txtSection" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">بخش</label>
                        <select class="form-control" id="txtSection" name="txtSection" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید...</option>
                            <option value="1">ICU</option>
                            <option value="2">CCU</option>
                            <option value="3">اورژانس</option>
                            <option value="4">بخش</option>
                        </select>
                    </div>

                    <div class="clearB"></div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtState" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">استان</label>
                        <select class="form-control" id="txtState" name="txtState" style="font-family: 'BNazanin'; direction: rtl;" onchange="insertcity('txtCity', 'txtState', false);">
                            <option value="0">انتخاب کنید...</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtCity" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">شهر</label>
                        <select class="form-control" id="txtCity" name="txtCity" style="font-family: 'BNazanin'; direction: rtl;" disabled="disabled">
                            <option value="0">انتخاب کنید...</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtFirstInspector" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">بازرس اولیه</label>
                        <select class="form-control" id="txtFirstInspector" name="txtFirstInspector" style="font-family: 'BNazanin'; direction: rtl;" disabled="disabled">
                            <option value="0">انتخاب کنید...</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtSecondInspector" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">بازرس نهایی</label>
                        <select class="form-control" id="txtSecondInspector" name="txtSecondInspector" style="font-family: 'BNazanin'; direction: rtl;" disabled="disabled">
                            <option value="0">انتخاب کنید...</option>
                        </select>
                    </div>


                    <div class="clearB"></div>
                    <div class="formCat">رفلکس ها</div>
                    <div class="clearB"></div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtBreathing" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">Breathing (تنفس)</label>
                        <select class="form-control" id="txtBreathing" name="txtBreathing" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید</option>
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtCornea" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">Cornea (قرنیه)</label>
                        <select class="form-control" id="txtCornea" name="txtCornea" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید</option>
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtPupil" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">Pupil (مردمک)</label>
                        <select class="form-control" id="txtPupil" name="txtPupil" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید</option>
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtFaceMovement" style="float: right; font-family: 'BNazanin'; font-weight: normal;">Face Movement (حرکات صورت)</label>
                        <select class="form-control" id="txtFaceMovement" name="txtFaceMovement" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید</option>
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>

                    <div class="clearB"></div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtDollEye" style="float: right; font-family: 'BNazanin'; font-weight: normal;">Doll's Eye (چشم‌عروسکی)</label>
                        <select class="form-control" id="txtDollEye" name="txtDollEye" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید</option>
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtGag" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">Gag (بلع)</label>
                        <select class="form-control" id="txtGag" name="txtGag" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید</option>
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtCough" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 130px;">Cough (سرفه)</label>
                        <select class="form-control" id="txtCough" name="txtCough" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید</option>
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtBodyMovement" style="float: right; font-family: 'BNazanin'; font-weight: normal;">Body Movement (حرکات بدن)</label>
                        <select class="form-control" id="txtBodyMovement" name="txtBodyMovement" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید</option>
                            <option value="U">نا معلوم (U)</option>
                            <option value="P">دارد (P)</option>
                            <option value="N">ندارد (N)</option>
                        </select>
                    </div>


                    <div class="clearB"></div>
                    <div class="formCat">وضعیت پایداری</div>
                    <div class="clearB"></div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtVT" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">T</label>
                            <input type="text" class="form-control" id="txtVT" name="txtVT" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="20 ~ 50">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtVTO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtVTO" name="txtVTO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtVPr" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">PR</label>
                            <input type="text" class="form-control" id="txtVPr" name="txtVPr" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 200">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtVPrO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtVPrO" name="txtVPrO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtVRr" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">RR</label>
                            <input type="text" class="form-control" id="txtVRr" name="txtVRr" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 200">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtVRrO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtVRrO" name="txtVRrO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtVOut" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Out</label>
                            <input type="text" class="form-control" id="txtVOut" name="txtVOut" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 3000 ml/hr">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtVOutO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtVOutO" name="txtVOutO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="clearB"></div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtVFio2" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">FIO<sub>2</sub></label>
                            <input type="text" class="form-control" id="txtVFio2" name="txtVFio2" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 100">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtVFio2O" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtVFio2O" name="txtVFio2O" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtVO2sat" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">O<sub>2</sub>Sat</label>
                            <input type="text" class="form-control" id="txtVO2sat" name="txtVO2sat" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 100">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtVO2satO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtVO2satO" name="txtVO2satO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6" style="direction: rtl; text-align: left;">
                        <div class="col-md-3" style="padding: 2px;">
                            <label for="txtVB" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">B.</label>
                            <input type="text" class="form-control" id="txtVB" name="txtVB" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 300">
                        </div>
                        <div class="col-md-3" style="padding: 2px;">
                            <label for="txtVBO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtVBO" name="txtVBO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="padding: 2px;">
                            <label for="txtVP" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">P</label>
                            <input type="text" class="form-control" id="txtVP" name="txtVP" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 200">
                        </div>
                        <div class="col-md-3" style="padding: 2px;">
                            <label for="txtVPO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtVPO" name="txtVPO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="clearB"></div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <label for="txtVSedation" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Sedation</label>
                        <select class="form-control" id="txtVSedation" name="txtVSedation" style="font-family: 'BNazanin'; direction: rtl;">
                            <option value="0">انتخاب کنید</option>
                            <option value="Yes">بله</option>
                            <option value="No">خیر</option>
                        </select>
                    </div>

                    <div class="clearB"></div>
                    <div class="formCat">آزمایشات</div>
                    <div class="clearB"></div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTNa" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Na</label>
                            <input type="text" class="form-control" id="txtTNa" name="txtTNa" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 300">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTNaO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtTNaO" name="txtTNaO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTK" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">K</label>
                            <input type="text" class="form-control" id="txtTK" name="txtTK" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 20">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTKO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtTKO" name="txtTKO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTBun" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">BUN</label>
                            <input type="text" class="form-control" id="txtTBun" name="txtTBun" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 200">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTBunO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtTBunO" name="txtTBunO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTUrea" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Urea</label>
                            <input type="text" class="form-control" id="txtTUrea" name="txtTUrea" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 500">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTUreaO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtTUreaO" name="txtTUreaO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="clearB"></div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTAlt" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">ALT</label>
                            <input type="text" class="form-control" id="txtTAlt" name="txtTAlt" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 2000">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTAltO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtTAltO" name="txtTAltO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTAst" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">AST</label>
                            <input type="text" class="form-control" id="txtTAst" name="txtTAst" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 2000">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTAstO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtTAstO" name="txtTAstO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTHgb" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Hgb</label>
                            <input type="text" class="form-control" id="txtTHgb" name="txtTHgb" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 30">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTHgbO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtTHgbO" name="txtTHgbO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTWbc" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">WBC</label>
                            <input type="text" class="form-control" id="txtTWbc" name="txtTWbc" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 100000">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTWbcO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtTWbcO" name="txtTWbcO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="clearB"></div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTPlt" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">PLT</label>
                            <input type="text" class="form-control" id="txtTPlt" name="txtTPlt" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="1000 ~ 999000">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTPltO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtTPltO" name="txtTPltO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTBs" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Bs</label>
                            <input type="text" class="form-control" id="txtTBs" name="txtTBs" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 1000">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTBsO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtTBsO" name="txtTBsO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTCr" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Cr</label>
                            <input type="text" class="form-control" id="txtTCr" name="txtTCr" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 20">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTCrO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtTCrO" name="txtTCrO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3" style="direction: rtl; text-align: left;">
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTCa" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Ca</label>
                            <input type="text" class="form-control" id="txtTCa" name="txtTCa" value="" style="font-family: 'webYekan'; direction: ltr;" placeholder="0 ~ 20">
                        </div>
                        <div class="col-md-6" style="padding: 2px;">
                            <label for="txtTCaO" style="font-family: 'webYekan'; font-size: 13px; direction: ltr; text-align: left; font-weight: normal;">Operator</label>
                            <select class="form-control" id="txtTCaO" name="txtTCaO" style="font-family: 'webYekan'; direction: ltr;">
                                <option value="=">=</option>
                                <option value=">">>=</option>
                                <option value="<"><=</option>
                            </select>
                        </div>
                    </div>

                    <div class="clearB"></div>
                    <div class="formCat">تاریخ ها</div>
                    <div class="clearB"></div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtRegisterTimeFrom" style="float: right; font-family: 'BNazanin'; font-weight: normal;">تاریخ ثبت در سامانه از</label>
                        <input type="text" class="form-control inputTime" id="txtRegisterTimeFrom" name="txtRegisterTimeFrom" style="font-family: 'BNazanin';" value="" placeholder="تاریخ ثبت در سامانه از">
                        <input id="txtRegisterTimeFromEn" type="hidden" name="txtRegisterTimeFromEn" value="">
                    </div>
                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtRegisterTimeTo" style="float: right; font-family: 'BNazanin'; font-weight: normal;">تاریخ ثبت در سامانه تا</label>
                        <input type="text" class="form-control inputTime" id="txtRegisterTimeTo" name="txtRegisterTimeTo" style="font-family: 'BNazanin';" value="" placeholder="تاریخ ثبت در سامانه تا">
                        <input id="txtRegisterTimeToEn" type="hidden" name="txtRegisterTimeToEn" value="">
                    </div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtInspectorRegisterTimeFrom" style="float: right; font-family: 'BNazanin'; font-weight: normal;">تاریخ شناسایی بازرس از</label>
                        <input type="text" class="form-control inputTime" id="txtInspectorRegisterTimeFrom" name="txtInspectorRegisterTimeFrom" style="font-family: 'BNazanin';" value="" placeholder="تاریخ شناسایی بازرس از">
                        <input id="txtInspectorRegisterTimeFromEn" type="hidden" name="txtInspectorRegisterTimeFromEn" value="">
                    </div>
                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtInspectorRegisterTimeTo" style="float: right; font-family: 'BNazanin'; font-weight: normal;">تاریخ شناسایی بازرس تا</label>
                        <input type="text" class="form-control inputTime" id="txtInspectorRegisterTimeTo" name="txtInspectorRegisterTimeTo" style="font-family: 'BNazanin';" value="" placeholder="تاریخ شناسایی بازرس تا">
                        <input id="txtInspectorRegisterTimeToEn" type="hidden" name="txtInspectorRegisterTimeToEn" value="">
                    </div>

                    <div class="clearB"></div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtHospitalizationTimeFrom" style="float: right; font-family: 'BNazanin'; font-weight: normal;">تاریخ بستری از</label>
                        <input type="text" class="form-control inputTime" id="txtHospitalizationTimeFrom" name="txtHospitalizationTimeFrom" style="font-family: 'BNazanin';" value="" placeholder="تاریخ بستری از">
                        <input id="txtHospitalizationTimeFromEn" type="hidden" name="txtHospitalizationTimeFromEn" value="">
                    </div>
                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtHospitalizationTimeTo" style="float: right; font-family: 'BNazanin'; font-weight: normal;">تاریخ بستری تا</label>
                        <input type="text" class="form-control inputTime" id="txtHospitalizationTimeTo" name="txtHospitalizationTimeTo" style="font-family: 'BNazanin';" value="" placeholder="تاریخ بستری تا">
                        <input id="txtHospitalizationTimeToEn" type="hidden" name="txtHospitalizationTimeToEn" value="">
                    </div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtBrainDeathTimeFrom" style="float: right; font-family: 'BNazanin'; font-weight: normal;">تاریخ تشخیص مرگ مغزی از</label>
                        <input type="text" class="form-control inputTime" id="txtBrainDeathTimeFrom" name="txtBrainDeathTimeFrom" style="font-family: 'BNazanin';" value="" placeholder="تاریخ تشخیص مرگ مغزی از">
                        <input id="txtBrainDeathTimeFromEn" type="hidden" name="txtBrainDeathTimeFromEn" value="">
                    </div>
                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtBrainDeathTimeTo" style="float: right; font-family: 'BNazanin'; font-weight: normal;">تاریخ تشخیص مرگ مغزی تا</label>
                        <input type="text" class="form-control inputTime" id="txtBrainDeathTimeTo" name="txtBrainDeathTimeTo" style="font-family: 'BNazanin';" value="" placeholder="تاریخ تشخیص مرگ مغزی تا">
                        <input id="txtBrainDeathTimeToEn" type="hidden" name="txtBrainDeathTimeToEn" value="">
                    </div>

                    <div class="clearB"></div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtCardiacDeathTimeFrom" style="float: right; font-family: 'BNazanin'; font-weight: normal;">تاریخ مرگ قلبی از</label>
                        <input type="text" class="form-control inputTime" id="txtCardiacDeathTimeFrom" name="txtCardiacDeathTimeFrom" style="font-family: 'BNazanin';" value="" placeholder="تاریخ مرگ قلبی از">
                        <input id="txtCardiacDeathTimeFromEn" type="hidden" name="txtCardiacDeathTimeFromEn" value="">
                    </div>
                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtCardiacDeathTimeTo" style="float: right; font-family: 'BNazanin'; font-weight: normal;">تاریخ مرگ قلبی تا</label>
                        <input type="text" class="form-control inputTime" id="txtCardiacDeathTimeTo" name="txtCardiacDeathTimeTo" style="font-family: 'BNazanin';" value="" placeholder="تاریخ مرگ قلبی تا">
                        <input id="txtCardiacDeathTimeToEn" type="hidden" name="txtCardiacDeathTimeToEn" value="">
                    </div>

                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtOrganDonationTimeFrom" style="float: right; font-family: 'BNazanin'; font-weight: normal;">تاریخ اهدا از</label>
                        <input type="text" class="form-control inputTime" id="txtOrganDonationTimeFrom" name="txtOrganDonationTimeFrom" style="font-family: 'BNazanin';" value="" placeholder="تاریخ اهدا از">
                        <input id="txtOrganDonationTimeFromEn" type="hidden" name="txtOrganDonationTimeFromEn" value="">
                    </div>
                    <div class="form-group col-md-3" style="float: right;">
                        <label for="txtOrganDonationTimeTo" style="float: right; font-family: 'BNazanin'; font-weight: normal;">تاریخ اهدا تا</label>
                        <input type="text" class="form-control inputTime" id="txtOrganDonationTimeTo" name="txtOrganDonationTimeTo" style="font-family: 'BNazanin';" value="" placeholder="تاریخ اهدا تا">
                        <input id="txtOrganDonationTimeToEn" type="hidden" name="txtOrganDonationTimeToEn" value="">
                    </div>

                    <div class="clearB""></div>
                    <button type="button" class="btn btn-success" style="float: left; font-family: 'BYekan'; margin-bottom: 15px; margin-top: 30px;" onclick="statistics();">دریافت آمار</button>
                    <a href="<?php echo base_url(); ?>admin/statistics_and_information" class="btn btn-warning" style="float: left; font-family: 'BYekan'; margin-bottom: 15px; margin-top: 30px; margin-left: 10px;">حذف فیلترها</a>

            </div>
            </form>
        <div class="clearB""></div>
        <div class="row" style="margin: 0 auto; text-align: center; font-family: 'BYekan'; display: none;" id="ajaxLoad">
            <img src="<?php echo asset_url();?>/images/load.gif"><br>
            در حال تولید اطلاعات...
        </div>
    <div class="row" style="margin: 0 auto; text-align: center; font-family: 'BYekan'; display: none;" id="ajaxData">
        <table class="table table-striped table-bordered" style="width: 50%; min-width: 700px; text-align: center; font-size: 14px; margin: 0 auto;">
            <thead>
                <tr>
                    <th rowspan="2">تعداد اطلاعات ثبت شده</th>
                    <td colspan="9">تعداد ارگان های اهدا شده</td>
                </tr>
                <tr>
                    <th>قلب</th>
                    <th>ریه راست</th>
                    <th>ریه چپ</th>
                    <th>کلیه راست</th>
                    <th>کلیه چپ</th>
                    <th>کبد</th>
                    <th>پانکراس</th>
                    <th>روده</th>
                    <th>نسج</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="stNumber" onclick="statistics_out()"><span style="color: blue; font-size: 10px;">(خروجی) </span><span id="stNumber"> </span></td>
                    <td id="stHeart"></td>
                    <td id="stLungRight"></td>
                    <td id="stLungLeft"></td>
                    <td id="stKidneyRight"></td>
                    <td id="stKidneyLeft"></td>
                    <td id="stLiver"></td>
                    <td id="stPancreas"></td>
                    <td id="stBowel"></td>
                    <td id="stTissue"></td>
                </tr>
            </tbody>
        </table>
    </div>
        </div>

    </div>


</div>
</div>
</div>
<script src="<?php echo asset_url(); ?>js/js-persian-cal.min.js"></script>
<script>
    $(document).ready(function(){
        $('#txtTypeOfList2').on('change', function(){
            insertDocOption('txtPatientStatus2', 'txtTypeOfList2', false, 'ALL');
        });
        $('#txtTypeOfList1').on('change', function(){
            insertDocOption('txtPatientStatus1', 'txtTypeOfList1', false, 'ALL');
        });
        insertDoc('txtDoc', false);
        $('#txtOpu').on('change', function(){
            insertHospital('txtHospital', 'txtOpu', false, 'opuId');
        });
        insertOpu('txtOpu', false);
        insertState('txtState', false);

        var date1 = new AMIB.persianCalendar('txtRegisterTimeFrom',
            { extraInputID: "txtRegisterTimeFromEn", extraInputFormat: "YYYY/MM/DD" });

        var date2 = new AMIB.persianCalendar('txtRegisterTimeTo',
            { extraInputID: "txtRegisterTimeToEn", extraInputFormat: "YYYY/MM/DD" });

        var date3 = new AMIB.persianCalendar('txtInspectorRegisterTimeFrom',
            { extraInputID: "txtInspectorRegisterTimeFromEn", extraInputFormat: "YYYY/MM/DD" });

        var date4 = new AMIB.persianCalendar('txtInspectorRegisterTimeTo',
            { extraInputID: "txtInspectorRegisterTimeToEn", extraInputFormat: "YYYY/MM/DD" });

        var date5 = new AMIB.persianCalendar('txtHospitalizationTimeFrom',
            { extraInputID: "txtHospitalizationTimeFromEn", extraInputFormat: "YYYY/MM/DD" });

        var date6 = new AMIB.persianCalendar('txtHospitalizationTimeTo',
            { extraInputID: "txtHospitalizationTimeToEn", extraInputFormat: "YYYY/MM/DD" });

        var date7 = new AMIB.persianCalendar('txtBrainDeathTimeFrom',
            { extraInputID: "txtBrainDeathTimeFromEn", extraInputFormat: "YYYY/MM/DD" });

        var date8 = new AMIB.persianCalendar('txtBrainDeathTimeTo',
            { extraInputID: "txtBrainDeathTimeToEn", extraInputFormat: "YYYY/MM/DD" });

        var date9 = new AMIB.persianCalendar('txtCardiacDeathTimeFrom',
            { extraInputID: "txtCardiacDeathTimeFromEn", extraInputFormat: "YYYY/MM/DD" });

        var date10 = new AMIB.persianCalendar('txtCardiacDeathTimeTo',
            { extraInputID: "txtCardiacDeathTimeToEn", extraInputFormat: "YYYY/MM/DD" });

        var date11 = new AMIB.persianCalendar('txtOrganDonationTimeFrom',
            { extraInputID: "txtOrganDonationTimeFromEn", extraInputFormat: "YYYY/MM/DD" });

        var date12 = new AMIB.persianCalendar('txtOrganDonationTimeTo',
            { extraInputID: "txtOrganDonationTimeToEn", extraInputFormat: "YYYY/MM/DD" });

    });
</script>