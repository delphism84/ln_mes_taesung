<?
session_start();

define('DB_HOST',"localhost");
define('DB_NAME',"exian");
define('DB_USER', "exian");
define('DB_PASSWORD','since1970');
define('ROOT',$_SERVER["DOCUMENT_ROOT"]);

mysql_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Connect Error");
$status = mysql_select_db(DB_NAME);
mysql_query("set names 'utf8'");
if(!$status) msg("Connect Error");

$sql = "select * from member where room_no=".$_POST['uid'];
$result = mysql_query($sql);

if(mysql_num_rows($result) > 0) {

} else {
	$sql = "delete from msg where room_no=".$_POST['uid'];
	echo $sql;
	mysql_query($sql);

	$sql = "delete from qz_room where uid=".$_POST['uid'];
	mysql_query($sql);
}

$sql = "update member set room_no=0 where mem_id='".$_SESSION['mem_id']."'";
$result = mysql_query($sql);
if($result) echo "success";
?>