<?
define('DB_HOST',"localhost");
define('DB_NAME',"sian");
define('DB_USER','sian');
define('DB_PASSWORD','since1970');
define('ROOT',$_SERVER["DOCUMENT_ROOT"]);

mysql_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die ("Connect Error");
mysql_select_db(DB_NAME);
mysql_query("set names 'utf8'");
?>