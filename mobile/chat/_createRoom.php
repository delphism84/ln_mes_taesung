<?
session_start();
//=======================================================>
define('DB_HOST',"localhost");
define('DB_NAME',"exian");
define('DB_USER','exian');
define('DB_PASSWORD','since1970');
define('ROOT',$_SERVER["DOCUMENT_ROOT"]);

mysql_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die ("Connect Error");
$status = mysql_select_db(DB_NAME);
mysql_query("set names 'utf8'");
if(!$status) msg("Connect Error");
//=========================================================>

$date = date("Y-m-d H:i:s");
$sql = "insert into qz_room (room_name, mem_id, create_dt) values ('".$_POST['room_name']."','".$_SESSION['mem_id']."', '".$date."')";
$result = mysql_query($sql) or die (mysql_error());
if($result) echo "success";
?>