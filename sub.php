<?php
session_start();

//phpinfo();

extract($_POST);
extract($_GET);

//if($_SESSION['employee_id'] == "") header("Location: login.php");

include "include/head.php";

$dir = "module/";
$module = $module."/";
$suffix = ".php";

include $dir.$module.$url.$suffix;
include "include/foot.php";
?>