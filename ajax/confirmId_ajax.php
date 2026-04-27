<?
/*
거래처 관련 Ajax 처리 페이지
*/

session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	// 거래처 리스트 가져오기
	case "getAccount" :
		$where = " where 1=1";
		
		if($account_gb == "all") {
			$where .= "";
		} else if($account_gb == "purchase") {
			$where .= " and account_gb='purchase'";
		} else if($account_gb == "sales") {
			$where .= " and account_gb='sales'";
		} else {
			$where .= "";
		}
		
		if($txt != "") {
			if($search_choice == "account_nm") {
				$where .= " and account_nm like '%".$txt."%'";
			} else if($search_choice == "account_cd") {
				$where .= " and account_cd like '%".$txt."%'";
			}
		}

		$query = "select * from erp_account".$where;
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = $rpp;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  

		$query = "select count(*) from erp_account".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_account".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['account_gb'] = $t->account_gb;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['owner'] = $t->owner;
			$re[$i]['corp_phone'] = $t->corp_phone;
			$re[$i]['corp_fax'] = $t->corp_fax;
			$re[$i]['corp_email'] = $t->corp_email;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
	
	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectAccount" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_account where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
}
?>