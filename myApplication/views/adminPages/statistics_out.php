<?php
if(is_array($pt['pt']) && count($pt['pt']) > 0)
{

    ?>
    <table style="direction: rtl; font-family: 'Tahoma'; font-size: 14px;" id="states">
        <tr>
            <td>ردیف</td>
            <td>نام و نام خانوادگی</td>
            <td>سن</td>
            <td>GCS اولیه</td>
            <td>GCS فعلی</td>
            <td>بیمارستان</td>
            <td>بخش</td>
            <td>شماره پرونده</td>
            <td>شهر</td>
            <td>استان</td>
            <td>OPU</td>
            <td>وضعیت</td>
            <td>لیست</td>
            <td>بازرس</td>
            <td>نوع بازرسی</td>
            <td>علت اختلال</td>
            <td>توضیحات</td>
            <td>وضعیت بدنی</td>
            <td>Breathing</td>
            <td>Gag</td>
            <td>Body Movement</td>
            <td>Face Movement</td>
            <td>Pupil</td>
            <td>Doll's Eyes</td>
            <td>Cornea</td>
            <td>Sedation</td>
            <td>تاریخ شناسایی</td>
            <td>ساعت شناسایی</td>
            <td>تاریخ ثبت در سامانه</td>
            <td>ساعت ثبت در سامانه</td>
            <td>تاریخ بستری</td>
            <td>تاریخ اعلام مرگ مغزی توسط پزشک</td>
            <td>تاریخ مرگ مغزی</td>
            <td>تاریخ مرگ قلبی</td>
            <td>تاریخ اهدای عضو</td>
            <td>na</td>
            <td>k</td>
            <td>bun</td>
            <td>urea</td>
            <td>cr</td>
            <td>alt</td>
            <td>ast</td>
            <td>wbc</td>
            <td>plt</td>
            <td>hgb</td>
            <td>bs</td>
            <td>out</td>
            <td>ca</td>
            <td>t</td>
            <td>b</td>
            <td>p</td>
            <td>pr</td>
            <td>rr</td>
            <td>fio2</td>
            <td>o2sat</td>
            <td>قلب</td>
            <td>کبد</td>
            <td>کلیه راست</td>
            <td>کلیه چپ</td>
            <td>ریه راست</td>
            <td>ریه چپ</td>
            <td>پانکراس</td>
            <td>نسج</td>
            <td>روده</td>

        </tr>
        <?php
        for($i = 0, $n = 1; $i < count($pt['pt']); $i++)
        {

            ?>
            <tr>
                <td><?php echo $n++; ?></td>
                <td><?php echo $pt['pt'][$i]['fullName']; ?></td>
                <td><?php echo $pt['pt'][$i]['age']; ?></td>
                <td><?php echo $pt['pt'][$i]['firstGCS']; ?></td>
                <td><?php if(strlen($pt['pt'][$i]['secondGCS']) > 0){echo $pt['pt'][$i]['secondGCS'];}else{echo '-';} ?></td>
                <td><?php echo $pt['pt'][$i]['hosName']; ?></td>
                <td><?php
                    if($pt['pt'][$i]['section'] == 1)
                    {
                        echo 'ICU';
                    }
                    elseif($pt['pt'][$i]['section'] == 2)
                    {
                        echo 'CCU';
                    }
                    elseif($pt['pt'][$i]['section'] == 3)
                    {
                        echo 'اورژانس';
                    }
                    elseif($pt['pt'][$i]['section'] == 4)
                    {
                        echo 'بخش';
                    }
                    if(strlen($pt['pt'][$i]['typeOfSection']) > 0)
                    {
                        echo ' - ' . $pt['pt'][$i]['typeOfSection'];
                    }
                    ?></td>
                <td><?php echo $pt['pt'][$i]['fileNumber']; ?></td>
                <td><?php echo $pt['pt'][$i]['cityName']; ?></td>
                <td><?php echo $pt['pt'][$i]['stateName']; ?></td>
                <td><?php echo $pt['pt'][$i]['opuName']; ?></td>
                <td><?php echo $pt['pt'][$i]['tolOpName']; ?></td>
                <td><?php
                    if($pt['pt'][$i]['tol'] == 1)
                    {
                        echo 'بیماران GCS3 مرگ مغزی شده';
                    }
                    elseif($pt['pt'][$i]['tol'] == 2)
                    {
                        echo 'بیماران GCS3 مرگ مغزی شده';
                    }
                    elseif($pt['pt'][$i]['tol'] == 3)
                    {
                        echo 'بیماران GCS4,5';
                    }
                    elseif($pt['pt'][$i]['tol'] == 3)
                    {
                        echo 'بیماران نامناسب';
                    }
                    ?></td>
                <td><?php
                    echo $pt['pt'][$i]['insName'];
                    ?></td>
                <td><?php
                    if($pt['pt'][$i]['presentation'] == 1)
                    {
                        echo 'بازرس حضوری (IP)';
                    }
                    elseif($pt['pt'][$i]['presentation'] == 2)
                    {
                        echo 'بازرس تلفنی (TDD)';
                    }
                    elseif($pt['pt'][$i]['presentation'] == 3)
                    {
                        echo 'گزارش بیمارستانی (HR)';
                    }
                    ?></td>
                <td><?php
                    if($pt['pt'][$i]['doc'] == 8)
                    {
                        echo $pt['pt'][$i]['docDetail'] . ' (سایر)';
                    }
                    else
                    {
                        echo $pt['pt'][$i]['docText'];
                    }
                    ?></td>
                <td><?php
                    if(strlen($pt['pt'][$i]['patientDetail']) > 1)
                    {
                        echo $pt['pt'][$i]['patientDetail'];
                    }
                    else
                    {
                        echo '-';
                    }
                    ?></td>
                <td><?php echo $pt['pt'][$i]['bodyType']; ?></td>
                <td><?php echo $pt['pt'][$i]['breathing']; ?></td>
                <td><?php echo $pt['pt'][$i]['gag']; ?></td>
                <td><?php echo $pt['pt'][$i]['bodyMovement']; ?></td>
                <td><?php echo $pt['pt'][$i]['cough']; ?></td>
                <td><?php echo $pt['pt'][$i]['faceMovement']; ?></td>
                <td><?php echo $pt['pt'][$i]['pupil']; ?></td>
                <td><?php echo $pt['pt'][$i]['dollEye']; ?></td>
                <td><?php echo $pt['pt'][$i]['cornea']; ?></td>
                <td><?php echo pdate('Y/m/d', $pt['pt'][$i]['inspectorRegisterTime']); ?></td>
                <td><?php echo pdate('H:i', $pt['pt'][$i]['inspectorRegisterTime']); ?></td>
                <td><?php echo pdate('Y/m/d', $pt['pt'][$i]['appRegisterTime']); ?></td>
                <td><?php echo pdate('H:i', $pt['pt'][$i]['appRegisterTime']); ?></td>
                <td><?php if($pt['pt'][$i]['hospitalizationTime'] > 0){ echo pdate('Y/m/d', $pt['pt'][$i]['hospitalizationTime']);} ?></td>
                <td><?php if($pt['pt'][$i]['gcs3ByDrTime'] > 0){ echo pdate('Y/m/d', $pt['pt'][$i]['gcs3ByDrTime']);} ?></td>
                <td><?php if($pt['pt'][$i]['brainDeathTime'] > 0){ echo pdate('Y/m/d', $pt['pt'][$i]['brainDeathTime']);} ?></td>
                <td><?php if($pt['pt'][$i]['cardiacDeathTime'] > 0){ echo pdate('Y/m/d', $pt['pt'][$i]['cardiacDeathTime']);} ?></td>
                <td><?php if($pt['pt'][$i]['organDonationTime'] > 0){ echo pdate('Y/m/d', $pt['pt'][$i]['organDonationTime']);} ?></td>
                <td><?php echo $pt['pt'][$i]['na']; ?></td>
                <td><?php echo $pt['pt'][$i]['k']; ?></td>
                <td><?php echo $pt['pt'][$i]['bun']; ?></td>
                <td><?php echo $pt['pt'][$i]['urea']; ?></td>
                <td><?php echo $pt['pt'][$i]['cr']; ?></td>
                <td><?php echo $pt['pt'][$i]['alt']; ?></td>
                <td><?php echo $pt['pt'][$i]['ast']; ?></td>
                <td><?php echo $pt['pt'][$i]['wbc']; ?></td>
                <td><?php echo $pt['pt'][$i]['plt']; ?></td>
                <td><?php echo $pt['pt'][$i]['hgb']; ?></td>
                <td><?php echo $pt['pt'][$i]['bs']; ?></td>
                <td><?php echo $pt['pt'][$i]['out']; ?></td>
                <td><?php echo $pt['pt'][$i]['ca']; ?></td>
                <td><?php echo $pt['pt'][$i]['t']; ?></td>
                <td><?php echo $pt['pt'][$i]['b']; ?></td>
                <td><?php echo $pt['pt'][$i]['p']; ?></td>
                <td><?php echo $pt['pt'][$i]['pr']; ?></td>
                <td><?php echo $pt['pt'][$i]['rr']; ?></td>
                <td><?php echo $pt['pt'][$i]['fio2']; ?></td>
                <td><?php echo $pt['pt'][$i]['o2sat']; ?></td>
                <td><?php if($pt['pt'][$i]['heart'] == 1){echo 'اهدا شده';} ?></td>
                <td><?php if($pt['pt'][$i]['liver'] == 1){echo 'اهدا شده';} ?></td>
                <td><?php if($pt['pt'][$i]['kidneyRight'] == 1){echo 'اهدا شده';} ?></td>
                <td><?php if($pt['pt'][$i]['kidneyLeft'] == 1){echo 'اهدا شده';} ?></td>
                <td><?php if($pt['pt'][$i]['lungRight'] == 1){echo 'اهدا شده';} ?></td>
                <td><?php if($pt['pt'][$i]['lungLeft'] == 1){echo 'اهدا شده';} ?></td>
                <td><?php if($pt['pt'][$i]['pancreas'] == 1){echo 'اهدا شده';} ?></td>
                <td><?php if($pt['pt'][$i]['tissue'] == 1){echo 'اهدا شده';} ?></td>
                <td><?php if($pt['pt'][$i]['bowel'] == 1){echo 'اهدا شده';} ?></td>
            </tr>


    <?php
} ?>
    </table>
    <?php
    }
else
{
    ?>

    <div class="alert alert-warning alert-dismissible fade in" role="alert" id="myAlert" style="font-family: 'webYekan'; margin: 0 auto; margin-top: 50px; text-align: center; width: 60%; font-size: 14px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        هیچ بیماری در این بخش یافت نشد...!
    </div>

    <?php
}
?>