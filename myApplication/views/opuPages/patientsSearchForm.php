<div style="height: auto; margin: 0px auto; text-align: right; width: 100%;">
                <form style="width: 98%" class="form-inline" role="form" method="get">
                    <div class="form-group" style="float: right;">
                        <label for="inputPatientFilter" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width:70px; font-size: 14px; line-height: 28px;">جستجو: </label>
                        <div style="float: right; width: 665px;">
                            <input type="text" class="form-control" name="inputPatientFilter" id="inputPatientFilter" style="font-family: 'BNazanin'; width: 665px;" value="<?php echo $this->input->get('inputPatientFilter'); ?>" placeholder="نام بیمار، کدملی، شماره پرونده، سن یا GCS اولیه...">
                            <input type="hidden" class="form-control" name="searchTools" value="true">
                        </div>
                    </div>
                    <div class="clearB"></div>
                    <div class="form-group" style="float: right; margin-top: 15px;">
                        <label for="cbHospital" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 70px; font-size: 14px; line-height: 28px;">بیمارستان: </label>
                        <div style="float: right; width: 300px;">
                            <select class="form-control" id="cbHospital" name="cbHospital" style="font-family: 'BNazanin'; direction: rtl; width: 100%;" disabled="disabled">
                                <option value="0">انتخاب کنید...</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group" style="float: right; margin-top: 15px;">
                        <label for="cbInspector" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 60px; font-size: 14px; line-height: 28px; margin-right: 15px;">نام بازرس: </label>
                        <div style="float: right; width: 290px;">
                            <select class="form-control" id="cbInspector" name="cbInspector" style="font-family: 'BNazanin'; direction: rtl; width: 100%;" disabled="disabled">
                                <option value="0">انتخاب کنید...</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="clearB"></div>
                    <div class="form-group" style="float: right; margin-top: 15px;">
                        <label for="cbSection" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 70px; font-size: 14px; line-height: 28px;">بخش: </label>
                        <div style="float: right; width: 120px;">
                            <select class="form-control" id="cbSection" name="cbSection" style="font-family: 'BNazanin'; direction: rtl; width: 120px;">
                                <option value="0">انتخاب کنید...</option>
                                <option value="1" <?php if($pt['isSection'] == 1){echo 'selected="selected"';} ?>>ICU</option>
                                <option value="2" <?php if($pt['isSection'] == 2){echo 'selected="selected"';} ?>>CCU</option>
                                <option value="3" <?php if($pt['isSection'] == 3){echo 'selected="selected"';} ?>>اورژانس</option>
                                <option value="4" <?php if($pt['isSection'] == 4){echo 'selected="selected"';} ?>>بخش</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="float: right; margin-top: 15px;">
                        <label for="cbInspectorType" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 70px; font-size: 14px; line-height: 28px; margin-right: 15px;">نوع بازرسی: </label>
                        <div style="float: right; width: 150px;">
                            <select class="form-control" id="cbInspectorType" name="cbInspectorType" style="font-family: 'BNazanin'; direction: rtl; width: 150px;">
                                <option value="0">انتخاب کنید...</option>
                                <option value="1" <?php if($pt['isPresentation'] == 1){echo 'selected="selected"';} ?>>بازرس حضوری (IP)</option>
                                <option value="2" <?php if($pt['isPresentation'] == 2){echo 'selected="selected"';} ?>>بازرس تلفنی (TDD)</option>
                                <option value="3" <?php if($pt['isPresentation'] == 3){echo 'selected="selected"';} ?>>گزارش بیمارستانی (HR)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="clearB"></div>
                    <div class="form-group" style="float: right; margin-top: 15px;">
                        <label for="cbDocDetail" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 70px; font-size: 14px; line-height: 28px;">علت اختلال: </label>
                        <div style="float: right; width: 300px;">
                            <select class="form-control" id="cbDocDetail" name="cbDocDetail" style="font-family: 'BNazanin'; direction: rtl; width: 100%;" disabled="disabled">
                                <option value="0">انتخاب کنید...</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group" style="float: right; margin-top: 15px;">
                        <label for="cbPatientStatus" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 80px; font-size: 14px; line-height: 28px; margin-right: 15px;">وضعیت بیمار: </label>
                        <div style="float: right; width: 270px;">
                            <select class="form-control" id="cbPatientStatus" name="cbPatientStatus" style="font-family: 'BNazanin'; direction: rtl; width: 100%;" disabled="disabled">
                                <option value="0">انتخاب کنید...</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="clearB"></div>
                    <div class="form-group" style="float: right; margin-top: 15px;">
                        <label for="cbOrder" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 70px; font-size: 14px; line-height: 28px;">چینش: </label>
                        <div style="float: right; width: 300px;">
                            <select class="form-control" id="cbOrder" name="cbOrder" style="font-family: 'BNazanin'; direction: rtl; width: 100%;">
                                <option value="patients.fullName" <?php if($this->input->get('cbOrder') == 'patients.fullName'){echo 'selected="selected"';} ?>>نام بیمار</option>
                                <option value="patients.age" <?php if($this->input->get('cbOrder') == 'patients.age'){echo 'selected="selected"';} ?>>سن بیمار</option>
                                <option value="patients.firstGCS" <?php if($this->input->get('cbOrder') == 'patients.firstGCS'){echo 'selected="selected"';} ?>>GCS اولیه</option>
                                <option value="patients.secondGCS" <?php if($this->input->get('cbOrder') == 'patients.secondGCS'){echo 'selected="selected"';} ?>>GCS تغییریافته</option>
                                <option value="hos.name" <?php if($this->input->get('cbOrder') == 'hos.name'){echo 'selected="selected"';} ?>>نام بیمارستان</option>
                                <option value="patients.lastInspector" <?php if($this->input->get('cbOrder') == 'patients.lastInspector'){echo 'selected="selected"';} ?>>نام بازرس</option>
                                <option value="patients.presentation" <?php if($this->input->get('cbOrder') == 'patients.presentation'){echo 'selected="selected"';} ?>>نوع بازرسی</option>
                                <option value="patients.doc" <?php if($this->input->get('cbOrder') == 'patients.doc'){echo 'selected="selected"';} ?>>علت اختلال هوشیاری</option>
                                <option value="patients.inspectorRegisterTime" <?php if($this->input->get('patients.inspectorRegisterTime') == 'DESC'){echo 'selected="selected"';} ?>>تاریخ ثبت بیمار</option>
                                <option value="patients.lastUpdate" <?php if($this->input->get('cbOrder') == 'patients.lastUpdate'){echo 'selected="selected"';} ?><?php if(!$this->input->get('cbOrder')){echo 'selected="selected"';} ?>>تاریخ بروزرسانی</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group" style="float: right; margin-top: 15px;">
                        <label for="cbOrderBy" class="control-label" style="float: right; font-family: 'BNazanin'; font-weight: normal; width: 55px; font-size: 14px; line-height: 28px; margin-right: 15px;">چیدمان: </label>
                        <div style="float: right; width: 140px;">
                            <select class="form-control" id="cbOrderBy" name="cbOrderBy" style="font-family: 'BNazanin'; direction: rtl; width: 140px;">
                                <option value="DESC" <?php if($this->input->get('cbOrderBy') == 'DESC'){echo 'selected="selected"';} ?><?php if(!$this->input->get('cbOrderBy')){echo 'selected="selected"';} ?>>نزولی</option>
                                <option value="ASC" <?php if($this->input->get('cbOrderBy') == 'ASC'){echo 'selected="selected"';} ?>>صعودی</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md" style="margin: 0px 15px 20px auto; float: right; margin-top: 15px;">جستجو</button>

                    <button type="button" class="btn btn-warning btn-md" style="float: right; margin: 0px 5px 20px auto; margin-top: 15px;" onclick="window.location='<?php echo base_url() . $pt['class'] ?>';">حذف فیلتر</button>

                </form>
            </div>
            
            
            
            
            
            
<script>
$(document).ready(function(){
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
