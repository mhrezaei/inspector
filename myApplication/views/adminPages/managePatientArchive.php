<script src="<?php echo asset_url(); ?>js/js-persian-cal.patientsArchive.js"></script>

<title><?php echo $siteTitle; ?> | لیست همه بیماران آرشیو شده</title>
<style type="text/css">
    #states th, #states td{
        text-align: right;
    }
</style>
<div class="panel panel-success panelContent" id="loginInfo">
    <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">لیست همه بیماران آرشیو شده <small style="font-size: 12px;">(کل بیماران یافت شده: <?php echo $pt['totalRecords']; ?>)</small></h3>
        <div class="glyphicon glyphicon-remove panelInfoBTN" id="loginInfoRemove" onclick="showPanel('loginInfo', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelInfoBTN" id="loginInfoMinus" onclick="showPanel('loginInfo', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="loginInfoPlus" onclick="showPanel('loginInfo', 'p')"></div>
        <div class="clearB"></div>
    </div>
    <div class="panel-body panelBodyText" id="loginInfoBody" style="width: 100%; text-align: right; margin: 0 auto;">
        <div style="width: 100%; height: auto; direction: rtl; margin: 0 auto;">

            <?php
                $this->view('adminPages/patientsSearchForm');
            ?>
            <div class="clearB"></div>

            <?php
                $this->view('publicPages/patientsTable');
            ?>

        </div>



    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="archiveModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="archiveModalLabel" style="font-family: 'BYekan';">آرشیو کردن بیماران قدیمی</h4>
            </div>
            <div class="modal-body" id="archiveModalBodyData">

                <div id="addOpuForm">
                    <form class="form-horizontal" role="form" name="patientArchiveFrom">
                        <div class="form-group">
                            <label for="inputOpuName" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">واحد فراهم آوری:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbOpuArchive" name="cbOpuArchive" style="font-family: 'BNazanin'; direction: rtl;" disabled="disabled">
                                    <option value="0">انتخاب کنید...</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputOpuName" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">وضعیت بیمار:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbPStatusArchive" name="cbPStatusArchive" style="font-family: 'BNazanin'; direction: rtl;" disabled="disabled">
                                    <option value="0">انتخاب کنید...</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputHeadOffice" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">از تاریخ:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fromDateArchive" name="fromDateArchive" style="font-family: 'BYekan'; text-align: center; width: 390px; float: right;" value="" placeholder="تاریخ شروع">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputMobile" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">تا تاریخ:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="toDateArchive" name="toDateArchive" style="font-family: 'BYekan'; text-align: center; width: 390px; float: right;" value="" placeholder="تاریخ پایان" maxlength="11">
                            </div>
                        </div>

                    </form>
                </div>

                <div class="progress" id="archiveModalLoading" style="display: none;">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                        <span class="sr-only">70% Complete</span>
                    </div>
                </div>

                <div role="alert" class="alert alert-warning" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; margin-bottom: 15px;" id="warninAlert">توجه فرمائید، انجام عملیات آرشیو کردن غیرقابل بازگشت خواهد بود.</div>
                <div role="alert" class="alert alert-warning" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; margin-bottom: 15px;" id="warninAlert">بیماران موجود تا تاریخ <strong><?php echo pdate('Y/n/d', strtotime("-1 months")); ?></strong> قابل آرشیو کردن می باشند.</div>

                <div role="alert" class="alert alert-success" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="successAlert1">واحد جدید با موفقیت ثبت گردید.</div>


                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert1">لطفاً تمامی موارد را تکمیل نمائید.</div>

                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert2">این نام کاربری قبلا ثبت شده است.</div>

                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert3">اطلاعات را به دقت وارد نمائید.</div>

                <div role="alert" class="alert alert-danger" style="padding: 10px; width: 60%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert4">اطلاعات به سامانه ارسال نشده است.</div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" style="float: left; font-family: 'BYekan';" id="saveArchiveBTN" onclick="archivePatientRun();">آرشیو کردن بیماران</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left; font-family: 'BYekan';">انصراف</button>
            </div>
        </div>
    </div>
</div>

<?php
    if($this->input->get('doArchive') AND $this->input->get('doArchive') == 'TRUE')
    {
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            document.patientArchiveFrom.reset();
            $('#dangerAlert1').hide();
            $('#saveArchiveBTN').removeAttr('disabled', 'disabled');
            insertOpu('cbOpuArchive', false);
            insertDocOption('cbPStatusArchive', -1, false, false);
            var fromDateArchive = new MHR.persianCalendar( 'fromDateArchive' );
            var toDateArchive = new MHR.persianCalendar( 'toDateArchive' );
            $('#archiveModal').modal('show');
        });
    </script>
    <?php
    }
?>