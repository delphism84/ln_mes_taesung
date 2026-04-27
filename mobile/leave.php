<?
session_start();

require_once('connection.php');
require_once('library/function.php');

$date = date("Y-m-d 00:00:00");
$time = date("H:i:s");
$sql = "update erp_work_leave set leave_tm='".$time."' where emp_id='".$_SESSION['emp_id']."' and create_dt='".$date."'";
mysql_query($sql);

unset($_SESSION['emp_id']);
if(!isset($_SESSION['emp_id'])) header("Location:index.php");
else echo $_SESSION['emp_id'];
?>