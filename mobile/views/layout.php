<?
session_start();

require_once('library/function.php');
//$_SESSION['process'] ="";
if($action != "login" && $pop !='Y') {
	require_once("views/client/head.php");
}
require_once('routes.php');
if($action != "login" && $pop !='Y') require_once("assets/foot.php");
?>