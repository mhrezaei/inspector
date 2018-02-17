<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?php echo asset_url(); ?>css/reset.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo asset_url(); ?>css/fontiran.css" rel="stylesheet" type="text/css">
    <link href="<?php echo asset_url(); ?>css/style-update.css" rel="stylesheet" type="text/css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo asset_url(); ?>js/jquery.js"></script>
    <script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>
    <script>
        function base_url()
        {
            var url = '<?php echo base_url(); ?>';
            return url;
        }
    </script>
    <script src="<?php echo asset_url(); ?>js/custom.js?time=<?php echo time(); ?>"></script>

</head>
<body>

<header>
    <div id="wrapper">

        <?php if($userRole == 'ADMIN'){ ?>
            <!-- admin header -->
            <nav>
                <ul class="menu">
                    <li class="home current"><a href="<?php echo base_url() ?>"><span>صفحه اصلی</span></a></li>
                    <li><a href="#"><span>مدیریت</span></a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url() ?>admin/manage_opu">مراکز فراهم آوری</a></li>
                            <li><a href="<?php echo base_url() ?>admin/manage_hospital">بیمارستان ها</a></li>
                            <li><a href="<?php echo base_url() ?>admin/manage_inspectors">بازرسین</a></li>
                            <li><a href="<?php echo base_url() ?>admin/manage_states">استان ها و شهرها</a></li>
                            <li><a href="<?php echo base_url() ?>admin/manage_pages">صفحات اصلی</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url() ?>admin/manage_patient"><span>لیست بیماران</span></a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url() ?>admin/add_patient">افزودن بیمار جدید</a></li>
                            <li><a href="<?php echo base_url() ?>admin/manage_patient">لیست همه بیماران</a></li>
                            <li><a href="<?php echo base_url() ?>admin/manage_patient_brain_death">لیست بیماران GCS3 مرگ مغزی شده</a></li>
                            <li><a href="<?php echo base_url() ?>admin/manage_patient_not_brain_death">لیست بیماران GCS3 مرگ مغزی نشده</a></li>
                            <li><a href="<?php echo base_url() ?>admin/manage_patient_gcs4_5">لیست بیماران GCS4,5</a></li>
                            <li><a href="<?php echo base_url() ?>admin/manage_patient_poor">لیست بیماران نامناسب</a></li>
                            <li><a href="<?php echo base_url() ?>admin/manage_patient_inTransfer">لیست بیماران درحال انتقال</a></li>
                            <li><a href="<?php echo base_url() ?>admin/manage_patient_deleted">لیست بیماران حذف شده</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url() ?>admin/manage_patient_archive"><span>لیست بیماران آرشیو شده</span></a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url() ?>admin/manage_patient_archive?doArchive=TRUE">فرایند آرشیو کردن بیماران</a></li>
                            <li><a href="<?php echo base_url() ?>admin/manage_patient_archive">لیست همه بیماران آرشیو شده</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span>آمار و اطلاعات</span></a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url() ?>public/statistics_and_information"><span>آمار و اطلاعات عمومی</span></a></li>
                            <li><a href="<?php echo base_url() ?>admin/statistics_and_information"><span>آمار و اطلاعات عملیاتی</span></a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span>تنظیمات</span></a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url(); ?>public/pages/index/about">درباره سامانه</a></li>
                            <li><a href="<?php echo base_url(); ?>public/pages/index/helpOpu">راهنمای سامانه مسئولین OPU</a></li>
                            <li><a href="<?php echo base_url(); ?>public/pages/index/helpInspector">راهنمای سامانه بازرسین</a></li>
                            <li><a href="<?php echo base_url(); ?>public/pages/index/rules">قوانین استفاده از سامانه</a></li>
                            <li><a href="<?php echo base_url(); ?>public/pages/index/technical">پشتیبانی فنی سامانه</a></li>
                            <li><a href="<?php echo base_url() ?>public/forms"><span>لیست فرم های واحدها</span></a></li>
                            <li><a href="<?php echo base_url(); ?>userAuthentication/user_authentication/change_password">تغییر رمز عبور</a></li>
                            <li><a href="<?php echo base_url(); ?>userAuthentication/user_authentication/log_out">خروج</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- admin header -->
            <script>
                $(document).ready(function(){
                    window.setInterval(function(){
                        checkUserLogedIn();
                        }, 300000);
                });
            </script>
            <?php }
            elseif($userRole == 'INSPECTOR')
            {
            ?>
            <!-- inspector header -->
            <nav>
                <ul class="menu">
                    <li class="home current"><a href="<?php echo base_url() ?>"><span>صفحه اصلی</span></a></li>
                    <li><a href="<?php echo base_url() ?>inspector/add_patient"><span>افزودن بیمار جدید</span></a></li>
                    <li><a href="<?php echo base_url() ?>inspector/manage_patient"><span>لیست بیماران</span></a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url() ?>inspector/manage_patient">لیست همه بیماران</a></li>
                            <li><a href="<?php echo base_url() ?>inspector/manage_patient_brain_death">لیست بیماران GCS3 مرگ مغزی شده</a></li>
                            <li><a href="<?php echo base_url() ?>inspector/manage_patient_not_brain_death">لیست بیماران GCS3 مرگ مغزی نشده</a></li>
                            <li><a href="<?php echo base_url() ?>inspector/manage_patient_gcs4_5">لیست بیماران GCS4,5</a></li>
                            <li><a href="<?php echo base_url() ?>inspector/manage_patient_poor">لیست بیماران نامناسب</a></li>
                            <li><a href="<?php echo base_url() ?>inspector/manage_patient_deleted">لیست بیماران حذف شده</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url() ?>inspector/manage_patient_archive"><span>لیست بیماران آرشیو شده</span></a>
                    <li><a href="<?php echo base_url() ?>public/statistics_and_information"><span>آمار و اطلاعات</span></a></li>
                    <li><a href="#"><span>تنظیمات</span></a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url(); ?>public/pages/index/about">درباره سامانه</a></li>
                            <li><a href="<?php echo base_url(); ?>public/pages/index/helpInspector">راهنمای استفاده از سامانه</a></li>
                            <li><a href="<?php echo base_url(); ?>public/pages/index/rules">قوانین استفاده از سامانه</a></li>
                            <li><a href="<?php echo base_url(); ?>public/pages/index/technical">پشتیبانی فنی سامانه</a></li>
                            <li><a href="#">ویرایش اطلاعات شخصی</a></li>
                            <li><a href="<?php echo base_url(); ?>userAuthentication/user_authentication/change_password">تغییر رمز عبور</a></li>
                            <li><a href="<?php echo base_url(); ?>userAuthentication/user_authentication/log_out">خروج</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- inspector header -->
            <script>
                $(document).ready(function(){
                    window.setInterval(function(){
                        checkUserLogedIn();
                        }, 300000);
                });
            </script>
            <?php 
            }
            elseif($userRole == 'OPU')
            {
            ?>
            <!-- opu header -->
            <nav    >
                <ul class="menu">
                    <li class="home current"><a href="<?php echo base_url() ?>"><span>صفحه اصلی</span></a></li>
                    <li><a href="<?php echo base_url() ?>opu/manage_inspectors"><span>مدیریت </span></a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url() ?>opu/manage_hospital"><span>مدیریت بیمارستان ها</span></a></li>
                            <li><a href="<?php echo base_url() ?>opu/manage_inspectors"><span>مدیریت بازرسین</span></a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url() ?>opu/manage_patient"><span>لیست بیماران</span></a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url() ?>opu/add_patient">افزودن بیمار جدید</a></li>
                            <li><a href="<?php echo base_url() ?>opu/manage_patient">لیست همه بیماران</a></li>
                            <li><a href="<?php echo base_url() ?>opu/manage_patient_brain_death">لیست بیماران GCS3 مرگ مغزی شده</a></li>
                            <li><a href="<?php echo base_url() ?>opu/manage_patient_not_brain_death">لیست بیماران GCS3 مرگ مغزی نشده</a></li>
                            <li><a href="<?php echo base_url() ?>opu/manage_patient_gcs4_5">لیست بیماران GCS4,5</a></li>
                            <li><a href="<?php echo base_url() ?>opu/manage_patient_poor">لیست بیماران نامناسب</a></li>
                            <li><a href="<?php echo base_url() ?>opu/manage_patient_deleted">لیست بیماران حذف شده</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url() ?>opu/manage_patient_archive"><span>لیست بیماران آرشیو شده</span></a></li>
                    <li><a href="<?php echo base_url() ?>public/statistics_and_information"><span>آمار و اطلاعات</span></a></li>
                    <li><a href="#"><span>تنظیمات</span></a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url(); ?>public/pages/index/about">درباره سامانه</a></li>
                            <li><a href="<?php echo base_url(); ?>public/pages/index/helpOpu">راهنمای استفاده از سامانه</a></li>
                            <li><a href="<?php echo base_url(); ?>public/pages/index/rules">قوانین استفاده از سامانه</a></li>
                            <li><a href="<?php echo base_url(); ?>public/pages/index/technical">پشتیبانی فنی سامانه</a></li>
                            <li><a href="<?php echo base_url() ?>public/forms"><span>لیست فرم های واحدها</span></a></li>
                            <li><a href="#">ویرایش اطلاعات شخصی</a></li>
                            <li><a href="<?php echo base_url(); ?>userAuthentication/user_authentication/change_password">تغییر رمز عبور</a></li>
                            <li><a href="<?php echo base_url(); ?>userAuthentication/user_authentication/log_out">خروج</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- opu header -->
            <script>
                $(document).ready(function(){
                    window.setInterval(function(){
                        checkUserLogedIn();
                        }, 300000);
                });
            </script>
            <?php }
            else
            {
            ?>
            <nav>
                <ul class="menu">          
                    <li class="home current"><a href="<?php echo base_url() ?>"><span>صفحه اصلی</span></a></li>
                    <li><a href="<?php echo base_url() ?>public/forms"><span>لیست فرم های واحدها</span></a></li>
                </ul>
            </nav>
            <?php
            }
        ?>


    </div>
    </header>