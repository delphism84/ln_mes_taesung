<?

	define('DB_HOST', "115.68.118.17");
	define('DB_NAME', "exian");
	define('DB_USER', "exian");
	define('DB_PASSWORD', "since1970");
	define('ROOT', $_SERVER["DOCUMENT_ROOT"]);

	mysql_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ("Connect Error");
	$status = mysql_select_db(DB_NAME);
	mysql_query("set names 'utf-8'");
	if(!$status) msg("Connect Error");
	
	$sql = "insert into member (
		mem_id,
		mem_pw,
		mem_name
	) values ( 
		'$_POST[mem_id]',
		'$_POST[mem_pw]',
		'$_POST[mem_name]'
	)";

	$result = mysql_query($sql) or die (mysql_error());

	if($result){
		echo "success";	
	}

?>