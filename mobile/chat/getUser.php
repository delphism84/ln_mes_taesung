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

include "json.php";

$json = new Services_JSON;

$sql = "select * from member where mem_login='y' and room_no=0";


$result = mysql_query($sql);

$i = 0 ;
while($t = mysql_fetch_object($result)) {
	$re[$i]['mem_id'] = $t->mem_id;
	$i++;
}

echo $json->encode($re);
?>