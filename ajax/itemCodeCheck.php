<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);
//$mode = "get_account_code";

switch($mode) {
	// 계정코드 리스트 가져오기
	case "getItemCd" :
		$item_cd = $_POST[item_cd];
		$sql = " select count(*) from erp_item where item_cd='$item_cd' ";

		$Result = mysql_query($sql);
		$rows = mysql_num_rows($Result);
		if($rows > 0){
			$data = mysql_fetch_array($Result);
		}
			if($data[0] == 0){ echo "사용가능한 아이템 코드 입니다."; }
			else{ echo "중복된 아이템 코드 입니다."; }
	break;
	
		// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "confirmAccountCode" :
		$query = "select count(*) as cnt from erp_account_code where aci_cd=".$aci_cd;
		//echo $query;
		$query = mysql_query($query); 
		$row = mysql_fetch_array($query);
		$cd_yn=$row['cnt'];
		//echo $cd_yn;
		if ($cd_yn == "0"){
			$result = "success";
		}else{
			$result = "false";
		}
		echo $json->encode($result);
	break;
}
?>