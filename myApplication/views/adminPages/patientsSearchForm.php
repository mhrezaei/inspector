<div style="height: auto; margin: 0px auto; text-align: right; width: 100%;">
    <div class="container">
        <form class="form-horizontal custom-form" role="form" method="get" style="margin: 30px 0;">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputPatientFilter" class="control-label col-sm-2">جستجو: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="inputPatientFilter" id="inputPatientFilter"
                                   value="<?php echo $this->input->get('inputPatientFilter'); ?>"
                                   placeholder="نام بیمار، کدملی، شماره پرونده، سن یا GCS اولیه...">
                            <input type="hidden" class="form-control" name="searchTools" value="true">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cbOpu" class="control-label col-sm-2">واحد
                            فراهم آوری: </label>
                        <div class="col-sm-10">
                            <select class="form-control" id="cbOpu" name="cbOpu" style="    direction: rtl; width: 230px;"
                                    onchange="insertHospital('cbHospital', 'cbOpu', false, 'opuId'); insertInspectors('cbInspector', 'cbOpu', false);">
                                <option value="0">انتخاب کنید...</option>
                                <?php
                                if (is_array($opu) && count($opu) > 0) {
                                    for ($i = 0; $i < count($opu); $i++) {
                                        if ($pt['isOpu'] == $opu[$i]['id']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                        echo '<option value="' . $opu[$i]['id'] . '" ' . $selected . '>' . $opu[$i]['name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearB"></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cbHospital" class="control-label col-sm-2">بیمارستان: </label>
                        <div class="col-sm-10">
                            <select class="form-control" id="cbHospital" name="cbHospital" style="    direction: rtl; width: 100%;"
                                    disabled="disabled">
                                <option value="0">انتخاب کنید...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cbInspector" class="control-label col-sm-2">نام
                            بازرس: </label>
                        <div class="col-sm-10">
                            <select class="form-control" id="cbInspector" name="cbInspector"
                                    style="    direction: rtl; width: 100%;" disabled="disabled">
                                <option value="0">انتخاب کنید...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearB"></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" >
                        <label for="cbSection" class="control-label col-sm-2"
                               >بخش: </label>
                        <div class="col-sm-10">
                            <select class="form-control" id="cbSection" name="cbSection" style="    direction: rtl; width: 120px;">
                                <option value="0">انتخاب کنید...</option>
                                <option value="1" <?php if ($pt['isSection'] == 1) {
                                    echo 'selected="selected"';
                                } ?>>ICU
                                </option>
                                <option value="2" <?php if ($pt['isSection'] == 2) {
                                    echo 'selected="selected"';
                                } ?>>CCU
                                </option>
                                <option value="3" <?php if ($pt['isSection'] == 3) {
                                    echo 'selected="selected"';
                                } ?>>اورژانس
                                </option>
                                <option value="4" <?php if ($pt['isSection'] == 4) {
                                    echo 'selected="selected"';
                                } ?>>بخش
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" >
                        <label for="cbInspectorType" class="control-label col-sm-2"
                               >نوع
                            بازرسی: </label>
                        <div class="col-sm-10">
                            <select class="form-control" id="cbInspectorType" name="cbInspectorType"
                                    style="    direction: rtl; width: 150px;">
                                <option value="0">انتخاب کنید...</option>
                                <option value="1" <?php if ($pt['isPresentation'] == 1) {
                                    echo 'selected="selected"';
                                } ?>>بازرس حضوری (IP)
                                </option>
                                <option value="2" <?php if ($pt['isPresentation'] == 2) {
                                    echo 'selected="selected"';
                                } ?>>بازرس تلفنی (TDD)
                                </option>
                                <option value="3" <?php if ($pt['isPresentation'] == 3) {
                                    echo 'selected="selected"';
                                } ?>>گزارش بیمارستانی (HR)
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearB"></div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cbDocDetail" class="control-label col-sm-2"
                               >علت
                            اختلال: </label>
                        <div class="col-sm-10">
                            <select class="form-control" id="cbDocDetail" name="cbDocDetail"
                                    style="    direction: rtl; width: 100%;" disabled="disabled">
                                <option value="0">انتخاب کنید...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" >
                        <label for="cbPatientStatus" class="control-label col-sm-2"
                               >وضعیت
                            بیمار: </label>
                        <div class="col-md-10">
                            <select class="form-control" id="cbPatientStatus" name="cbPatientStatus"
                                    style="    direction: rtl; width: 100%;" disabled="disabled">
                                <option value="0">انتخاب کنید...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearB"></div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cbOrder" class="control-label col-sm-2"
                               >چینش: </label>
                        <div class="col-sm-10">
                            <select class="form-control" id="cbOrder" name="cbOrder" style="    direction: rtl; width: 100%;">
                                <option value="patients.fullName" <?php if ($this->input->get('cbOrder') == 'patients.fullName') {
                                    echo 'selected="selected"';
                                } ?>>نام بیمار
                                </option>
                                <option value="patients.age" <?php if ($this->input->get('cbOrder') == 'patients.age') {
                                    echo 'selected="selected"';
                                } ?>>سن بیمار
                                </option>
                                <option value="patients.firstGCS" <?php if ($this->input->get('cbOrder') == 'patients.firstGCS') {
                                    echo 'selected="selected"';
                                } ?>>GCS اولیه
                                </option>
                                <option value="patients.secondGCS" <?php if ($this->input->get('cbOrder') == 'patients.secondGCS') {
                                    echo 'selected="selected"';
                                } ?>>GCS تغییریافته
                                </option>
                                <option value="hos.name" <?php if ($this->input->get('cbOrder') == 'hos.name') {
                                    echo 'selected="selected"';
                                } ?>>نام بیمارستان
                                </option>
                                <option value="patients.lastInspector" <?php if ($this->input->get('cbOrder') == 'patients.lastInspector') {
                                    echo 'selected="selected"';
                                } ?>>نام بازرس
                                </option>
                                <option value="patients.presentation" <?php if ($this->input->get('cbOrder') == 'patients.presentation') {
                                    echo 'selected="selected"';
                                } ?>>نوع بازرسی
                                </option>
                                <option value="patients.doc" <?php if ($this->input->get('cbOrder') == 'patients.doc') {
                                    echo 'selected="selected"';
                                } ?>>علت اختلال هوشیاری
                                </option>
                                <option value="patients.inspectorRegisterTime" <?php if ($this->input->get('patients.inspectorRegisterTime') == 'DESC') {
                                    echo 'selected="selected"';
                                } ?>>تاریخ ثبت بیمار
                                </option>
                                <option value="patients.lastUpdate" <?php if ($this->input->get('cbOrder') == 'patients.lastUpdate') {
                                    echo 'selected="selected"';
                                } ?><?php if (!$this->input->get('cbOrder')) {
                                    echo 'selected="selected"';
                                } ?>>تاریخ بروزرسانی
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cbOrderBy" class="control-label col-sm-2"
                               >چیدمان: </label>
                        <div class="col-sm-10">
                            <select class="form-control" id="cbOrderBy" name="cbOrderBy" style="    direction: rtl; width: 140px;">
                                <option value="DESC" <?php if ($this->input->get('cbOrderBy') == 'DESC') {
                                    echo 'selected="selected"';
                                } ?><?php if (!$this->input->get('cbOrderBy')) {
                                    echo 'selected="selected"';
                                } ?>>نزولی
                                </option>
                                <option value="ASC" <?php if ($this->input->get('cbOrderBy') == 'ASC') {
                                    echo 'selected="selected"';
                                } ?>>صعودی
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-md"
                            style="margin: 0px 15px 20px auto; float: right; margin-top: 15px;">جستجو
                    </button>

                    <button type="button" class="btn btn-warning btn-md"
                            style="float: right; margin: 0px 5px 20px auto; margin-top: 15px;"
                            onclick="window.location='<?php echo base_url() . $pt['class'] ?>';">حذف فیلتر
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>


<script>
    $(document).ready(function () {
        <?php
        if($pt['isOpu'] > 0)
        {
        ?>
        <?php
        if($pt['isHospital'] > 0)
        {
        ?>
        insertHospital('cbHospital', '<?php echo $pt['isOpu']; ?>', '<?php echo $pt['isHospital']; ?>', 'opuId');
        <?php
        }
        else
        {
        ?>
        insertHospital('cbHospital', '<?php echo $pt['isOpu']; ?>', false, 'opuId');
        <?php
        }
        ?>

        <?php
        if($pt['isInspector'] > 0)
        {
        ?>
        insertInspectors('cbInspector', '<?php echo $pt['isOpu']; ?>', '<?php echo $pt['isInspector']; ?>');
        <?php
        }
        else
        {
        ?>
        insertInspectors('cbInspector', '<?php echo $pt['isOpu']; ?>', false);
        <?php
        }
        ?>
        <?php
        }
        ?>
        <?php
        if($pt['isDoc'] > 0)
        {
        ?>
        insertDoc('cbDocDetail', '<?php echo $pt['isDoc']; ?>');
        <?php
        }
        else
        {
        ?>
        insertDoc('cbDocDetail', false);
        <?php
        }
        ?>
        <?php
        if($pt['isPatientStatus'] > 0)
        {
        ?>
        insertDocOption('cbPatientStatus', '-1', '<?php echo $pt['isPatientStatus']; ?>');
        <?php
        }
        else
        {
        ?>
        insertDocOption('cbPatientStatus', '-1', false);
        <?php
        }
        ?>
    });
</script>
