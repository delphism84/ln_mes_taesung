<?
//error_reporting(E_ALL);
session_start();

require_once('include/db_define.php');
require_once('library/json.php');
require_once('controllers/ajax_override_controller.php');

if(sizeof($_GET) > 0) $parameter = $_GET['parameter'];
else if(sizeof($_POST) > 0) $parameter = $_POST;

$ajax = new Ajax_override($parameter);
$ajax->Mysql_DB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$ajax->{$parameter['mode']}();
?>