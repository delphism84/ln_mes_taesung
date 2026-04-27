<?
require_once('connection.php');
require_once('library/function.php');

if($action != "login" && $pop !='Y') require_once("assets/head.php");
require_once('routes.php');
if($action != "login" && $pop !='Y') require_once("assets/foot.php");
?>