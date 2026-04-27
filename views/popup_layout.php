<?
require_once('connection.php');
require_once('library/function.php');

if($action != "login" && $pop !='Y') require_once("assets/phead.php");
require_once('routes.php');
if($action != "login" && $pop !='Y') require_once("assets/pfoot.php");
?>