<?php
$isUserLogin = $login_info['isUserLogin'];
$userLogin = $login_info['userLogin'];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <?php include 'loginInfo.php'; ?>
            <?php include 'homePieChart.php'; ?>
        </div>
        <div class="col-md-8">
            <?php include 'homeBarChart.php'; ?>
        </div>
    </div>
</div>


