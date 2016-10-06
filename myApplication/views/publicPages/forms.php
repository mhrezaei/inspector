<title><?php echo $siteTitle; ?> | فرم های مخصوص واحد های فراهم آوری اعضای پیوندی</title>
<style type="text/css">
    #states th, #states td{
        text-align: right;
    }
</style>

<?php
    if($login == 1){
    ?>

    <div class="panel panel-success panelContent" id="loginInfo" style="margin-top: 20px;">
        <div class="panel-heading" style="padding-left: 0px;">
            <h3 class="panel-title panelTitleText">فرم های مخصوص واحد های فراهم آوری اعضای پیوندی</h3>
            <div class="glyphicon glyphicon-remove panelInfoBTN" id="loginInfoRemove" onclick="showPanel('loginInfo', 'r')"></div>
            <div class="glyphicon glyphicon-minus panelInfoBTN" id="loginInfoMinus" onclick="showPanel('loginInfo', 'm')"></div>
            <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="loginInfoPlus" onclick="showPanel('loginInfo', 'p')"></div>
            <div class="clearB"></div>
        </div>
        <div class="panel-body panelBodyText" id="loginInfoBody" style="width: 60%; text-align: right; margin: 0 auto;">
            <div style="width: 100%; height: auto; direction: rtl; margin: 0 auto;">


                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading " role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="cursor: pointer;">
                                <span style="color: #6874eb; cursor: pointer; float: right; padding-left: 5px;" class="glyphicon glyphicon-folder-open"></span>
                                <h4 style="width: 50%; float: right;" class="panel-title">
                                    <a class="collapsed" style="font-family: 'webYekan'; font-size: 13px;">
                                        مجموعه فرم های بیماریار
                                    </a>
                                </h4>
                                <div class="clearB"></div>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%; direction: rtl; text-align: right;">ردیف</th>
                                                <th style="width: 75%; direction: rtl; text-align: right;">نام فایل</th>
                                                <th style="width: 20%; direction: rtl; text-align: center;">دریافت فایل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">1</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">داخلی 1- ثبت اطلاعات متقاضی بیماریاری</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/1"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">2</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">داخلی 2- تفاهم نامه بیماریار رده کمک بهیار</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/2"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">3</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">داخلی 3- تفاهم نامه بیماریار رده خدمه</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/3"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="cursor: pointer;">
                                <span style="color: #6874eb; cursor: pointer; float: right; padding-left: 5px;" class="glyphicon glyphicon-folder-open"></span>
                                <h4 style="width: 50%; float: right;" class="panel-title">
                                    <a class="collapsed" style="font-family: 'webYekan'; font-size: 13px;">
                                        محموعه فرم های بازرسین
                                    </a>
                                </h4>
                                <div class="clearB"></div>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%; direction: rtl; text-align: right;">ردیف</th>
                                                <th style="width: 75%; direction: rtl; text-align: right;">نام فایل</th>
                                                <th style="width: 20%; direction: rtl; text-align: center;">دریافت فایل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">1</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">2-4فرم گزارش تخلفات</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/21"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">2</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">2-5فرم ضمیمه گزارش تخلفات</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/22"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">3</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">داخلی 1-متقاضیان بازرسی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/23"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">4</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">داخلی 2-برآورد مالی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/24"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">5</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">داخلی 3-نمونه برنامه ماهانه بازرسی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/25"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">6</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">داخلی 4-نحوه تقسیم بندی و بازرسی بیمارستانها</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/26"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="cursor: pointer;">
                                <span style="color: #6874eb; cursor: pointer; float: right; padding-left: 5px;" class="glyphicon glyphicon-folder-open"></span>
                                <h4 style="width: 50%; float: right;" class="panel-title">
                                    <a class="collapsed" style="font-family: 'webYekan'; font-size: 13px;">
                                        محموعه فرم های کوردیناتور ها
                                    </a>
                                </h4>
                                <div class="clearB"></div>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%; direction: rtl; text-align: right;">ردیف</th>
                                                <th style="width: 75%; direction: rtl; text-align: right;">نام فایل</th>
                                                <th style="width: 20%; direction: rtl; text-align: center;">دریافت فایل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">1</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-1فرم استخدام کوردیناتور</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/33"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">2</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-2ابررسی اولیه بیماران</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/34"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">3</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-3ویزیت کوردیناتور</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/35"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">4</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-4دستورات دارویی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/36"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">5</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-5درخواست آزمایش ویرولوژی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/37"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">6</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-6گزارش به پزشک خارج از بیمارستان مبدا</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/38"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">7</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-7ارزشیابی ریسکهای بیولوژیکی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/39"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">8</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-8رضایت انتقال</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/40"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">9</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-9مراحل اداری اهدا</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/41"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">10</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-10فرم معرفی جسد به پزشکی قانونی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/42"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">11</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-11چک لیست شرح وظایف کوردیناتور مبدا</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/43"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">12</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-12آزمایش تطابق بافتی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/44"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">13</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-13رضایت اهدای عضو پزشکی قانونی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/45"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">14</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-14فرم گزارش هاروست</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/46"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">15</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-15اطاق عمل</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/47"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">16</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-16فرم شرح عمل</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/48"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">17</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-17ارزیابی اعضای اهدایی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/49"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">18</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-18فرم خلاصه پرونده</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/50"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">19</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-19فرم تحقیقاتی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/51"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">20</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-20چک لیست کوردیناتور آ سی یو هاروست</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/52"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">21</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-21چک لیست کوردیناتور دوم</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/53"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">22</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-22چک لیست کوردیناتور اتاق عمل</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/54"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">23</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-23لیبل ارگان</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/55"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">24</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-24تدفین اهدا کننده</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/56"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">25</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-25مراحل اهدای عضو</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/58"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">26</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-26کارت gcs3</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/59"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">27</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">1-27فرم تائید مرگ مغزی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/57"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="cursor: pointer;">
                                <span style="color: #6874eb; cursor: pointer; float: right; padding-left: 5px;" class="glyphicon glyphicon-folder-open"></span>
                                <h4 style="width: 50%; float: right;" class="panel-title">
                                    <a class="collapsed" style="font-family: 'webYekan'; font-size: 13px;">
                                        مجموعه فرم های پرستاران
                                    </a>
                                </h4>
                                <div class="clearB"></div>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%; direction: rtl; text-align: right;">ردیف</th>
                                                <th style="width: 75%; direction: rtl; text-align: right;">نام فایل</th>
                                                <th style="width: 20%; direction: rtl; text-align: center;">دریافت فایل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">1</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">3-1فرم متقاضی پرستاری</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/27"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">2</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">3-2ارزیابی پرستار توسط بیهوشی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/28"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">3</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">3-3ارزیابی پرستار توسط کوردیناتور</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/29"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">4</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">داخلی 1-ثبت اطلاعات متقاضی پرستاری</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/30"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">5</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">داخلی 2-تفاهم نامه پرستاری</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/31"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">6</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">داخلی3- برگ گزارش پرستاری</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/32"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFive" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive" style="cursor: pointer;">
                                <span style="color: #6874eb; cursor: pointer; float: right; padding-left: 5px;" class="glyphicon glyphicon-folder-open"></span>
                                <h4 style="width: 50%; float: right;" class="panel-title">
                                    <a class="collapsed" style="font-family: 'webYekan'; font-size: 13px;">
                                        سایر فرم ها
                                    </a>
                                </h4>
                                <div class="clearB"></div>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                <div class="panel-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%; direction: rtl; text-align: right;">ردیف</th>
                                                <th style="width: 75%; direction: rtl; text-align: right;">نام فایل</th>
                                                <th style="width: 20%; direction: rtl; text-align: center;">دریافت فایل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">1</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-1اطلاعات اهداکنندگان بالفعل مرگ مغزی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/4"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">2</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-2آزمایشات مرگ مغزی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/5"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">3</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-3فرم حضور نماینده پزشک قانونی</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/6"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">4</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-4فرم پرداخت هزینه‌ی آمبولانس</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/7"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">5</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-5فرم اطلاعات و پیگیری مشکلات آمبولانس</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/8"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">6</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-6فرم هماهنگي ساعت اتاق عمل</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/9"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">7</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-7فرم شرکت در مراسم ترحیم</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/10"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">8</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-8مشخصات اهدا کنندگان</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/11"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">9</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-9فرم مشخصات گیرندگان اعضا</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/12"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">10</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-10چک لیست تكميل پرونده</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/13"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">11</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-11لیست نواقص پرونده</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/14"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">12</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-12پیگیری نامه های واحد</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/15"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">13</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-13فرم ثبت نام کارت اهدای عضو</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/16"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">14</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-14فرم درخواست همکاری</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/17"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">15</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">5-15فرم درخواست همکاری</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/18"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">16</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">داخلی1</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/19"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 5%; direction: rtl; text-align: right;">17</th>
                                                <td style="width: 75%; direction: rtl; text-align: right;">داخلی2-ورود و خروج کالای انبار</td>
                                                <td style="width: 20%; direction: rtl; text-align: center;">
                                                    <a href="<?php echo base_url(); ?>public/forms/getFile/20"><span style="color: green; cursor: pointer; font-size: 18px;" class="glyphicon glyphicon-save" rel="tooltip" data-placement="top" title="دریافت فایل"></span></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>



            </div>
        </div>
    </div>

    <?php
    }
    elseif($login == 2)
    {
    ?>

    <div class="panel panel-success panelContent" id="loginInfo" style="margin-top: 20px;">
        <div class="panel-heading" style="padding-left: 0px;">
            <h3 class="panel-title panelTitleText">فرم های مخصوص واحد های فراهم آوری اعضای پیوندی</h3>
            <div class="glyphicon glyphicon-remove panelInfoBTN" id="loginInfoRemove" onclick="showPanel('loginInfo', 'r')"></div>
            <div class="glyphicon glyphicon-minus panelInfoBTN" id="loginInfoMinus" onclick="showPanel('loginInfo', 'm')"></div>
            <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="loginInfoPlus" onclick="showPanel('loginInfo', 'p')"></div>
            <div class="clearB"></div>
        </div>
        <div class="panel-body panelBodyText" id="loginInfoBody" style="width: 60%; text-align: right; margin: 0 auto;">
            <div style="width: 100%; height: auto; direction: rtl; margin: 0 auto;">
<div style="width: 900px; border: 2px #DDDDDD solid; border-radius: 5px; margin: 0 auto; height: 180px; margin-top: 20px; -moz-border-radius: 5px; -webkit-border-radius: 5px;">
                <div style="float: right; margin-top: 15px; margin-right: 15px; font-family: 'BNazanin'; direction: rtl; font-size: 16px;">ورد به سامانه</div>
                <div style="clear: both;"></div>
                <form class="form-inline" role="form" style="direction: rtl; text-align: center; margin-right: 10px; margin-top: 10px;" method="post">
                    <div class="form-group">
                        <label class="sr-only" for="txtUserName" style="font-family: 'BYekan';">نام کاربری:</label>
                        <input type="text" class="form-control" id="txtUserName" name="txtUserName" placeholder="Username" style="width: 250px; direction: ltr; text-align: left;">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="txtPassWord" style="font-family: 'BYekan';">رمز عبور:</label>
                        <input type="password" class="form-control" id="txtPassWord" name="txtPassWord" placeholder="Password" style="width: 250px; direction: ltr; text-align: left;">
                    </div>
                    <button type="submit" class="btn btn-info" style="font-family: 'BNazanin'; width: 80px;">ورود</button>
                </form>
                <div style="clear: both;"></div>
                <?php if($msg == 1){ ?>
                    <div class="alert alert-danger" role="alert" style="direction: rtl; font-family: 'BNazanin'; width: 55%; text-align: right; margin: 0 auto; margin-top: 30px; margin-bottom: 30px; font-size: 16px; line-height: 20px; padding-top: 10px; padding-bottom: 10px;">نام کاربری یا رمز عبور صحیح نمی باشد ...</div>
                    <?php } ?>

            </div>
            </div>
        </div>
    </div>

    <?php
    }
?>