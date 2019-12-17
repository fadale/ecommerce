<?php
include 'admin/connect.php';
$tpl='includes/templeats/';//templeats
$lang='includes/lang/';//Languages
$func = 'includes/fun/';//Functions
$css ='layout/css/';//Css
$js='layout/js/';//JS


include $func.'functions.php';
include $lang.'en.php';
if(! isset($noNavbar)){
    include $tpl.'navbar.php';
}
