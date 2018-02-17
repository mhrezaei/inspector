<?php
$isUserLogin = $login_info['isUserLogin'];
$userLogin = $login_info['userLogin'];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <?php include 'loginInfo.php'; ?>
        </div>
        <div class="col-md-8">
            <?php include 'homeChart.php'; ?>
        </div>
    </div>
</div>


