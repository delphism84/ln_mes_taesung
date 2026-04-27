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

	$sql = "select * from member where mem_id='".$_POST['mem_id']."'";

	$result = mysql_query($sql) or die (mysql_error());

	if(mysql_num_rows($result) > 0) {
		
		$t = mysql_fetch_object($result);

		if($t->mem_pw == $_POST['mem_pw']) {
			echo "success";
			$_SESSION['mem_id'] = $t->mem_id;
			$_SESSION['mem_name'] = $t->mem_name;

			$sql = "update member set mem_login='y' where mem_id='".$t->mem_id."'";
			mysql_query($sql);
		} else {
			echo "notPw";
		}
	} else {
		echo "notUser";
	}

?>