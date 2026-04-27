<?
/*
계정코드 관련 Ajax 처리 페이지
*/

session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);
//$mode = "get_account_code";
switch($mode) {

	//투입대기 완료 버튼 누르면 지워주기.
	case "input_readyDel" :
				
		$sql = "update erp_release_input_ready set yn='y' where uid=".$_POST['uid'];
		mysql_query($sql);

		echo "success";
	break;
}
?>