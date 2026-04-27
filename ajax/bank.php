<?
/*
카드등록 관련 Ajax 처리 페이지
*/

session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);
//$mode = "get_bank_list";
switch($mode) {
	// 카드등록 리스트 가져오기
	case "get_bank_list" :
		$where = " where 1=1";
		/*
		if($account_gb == "all") {
			$where .= "";
		} else if($account_gb == "purchase") {
			$where .= " and account_gb='purchase'";
		} else if($account_gb == "sales") {
			$where .= " and account_gb='sales'";
		} else {
			$where .= "";
		}
		*/

		$where .= "";
		if($txt != "") {
			if($search_choice == "account_nm") {
				$where .= " and account_nm like '%".$txt."%'";
			} else if($search_choice == "account_cd") {
				$where .= " and account_cd like '%".$txt."%'";
			}
		}
		
		$query = "select * from erp_bank_list".$where;
		
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 1000;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_bank_list".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_bank_list".$where." order by idx limit ".($page-1)*$rpp.", ".$rpp;

		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num']		= $total_num;
			$re[$i]['no']				= $no;
			$re[$i]['idx']				= $t->uid;
			$re[$i]['bank_num']			= $t->bank_num;
			$re[$i]['bank_name']		= $t->bank_name;
			$re[$i]['aci_cd']			= $t->aci_cd;
			$re[$i]['aci_nm']			= $t->aci_nm;
			$re[$i]['bank_type']		= $t->bank_type;
			$re[$i]['pay_account_name'] = $t->pay_account_name;
			$re[$i]['bank_manager']		= $t->bank_manager;
			$re[$i]['re_mark']			= $t->re_mark;
			$re[$i]['use_yn']			= $t->use_yn;
			if ($t->use_yn=="Y"){
				$use_yn ="사용";
			}else{
				$use_yn ="미사용";
			}
			$re[$i]['use_yn'] = $use_yn;
			$re[$i]['search_box']= $t->search_box;
			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
			$ct++;
			//echo $re;
		}

		echo $json->encode($re);
	break;
	

	case "get_bank_list_remark" :   //적요 리스트
		$where = " where 1=1";
		/*
		if($account_gb == "all") {
			$where .= "";
		} else if($account_gb == "purchase") {
			$where .= " and account_gb='purchase'";
		} else if($account_gb == "sales") {
			$where .= " and account_gb='sales'";
		} else {
			$where .= "";
		}
		
		*/
		$where .= "";
		if($txt != "") {
			if($search_choice == "account_nm") {
				$where .= " and account_nm like '%".$txt."%'";
			} else if($search_choice == "account_cd") {
				$where .= " and account_cd like '%".$txt."%'";
			}
		}

		$query = "select * from erp_bank_list_remark".$where;
		
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 1000;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_bank_list_remark".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_bank_list_remark".$where." order by idx  limit ".($page-1)*$rpp.", ".$rpp;

		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['idx'] = $t->idx;
			$re[$i]['aci_cd'] = $t->aci_cd;
			$re[$i]['remark_code'] = $t->remark_code;
			$re[$i]['remark_name'] = $t->remark_name;
			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
			$ct++;
			//echo $re;
		}

		echo $json->encode($re);
	break;


	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectAccount" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_bank_list where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

		// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "confirmAccountCode" :
		$query = "select count(*) as cnt from erp_bank_list where aci_cd=".$aci_cd;
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