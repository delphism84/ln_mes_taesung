<?
session_start();

extract($_POST);
extract($_GET);

require_once("controllers/erp_controller.php");
require_once("controllers/override_controller.php");

$override = new OverrideController();

include("assets/phead.php");
include("views/popup/".$popup.".php");
include("assets/pfoot.php");
?>