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
	// 계정코드 리스트 가져오기
	case "get_lot_no" :
		$where = " where 1=1";

		$where .= "";
		if($txt != "") {
			if($search_choice == "lot_no_cd") {
				$where .= " and lot_no_cd like '%".$txt."%'";
			} else if($search_choice == "item_cd") {
				$where .= " and item_cd like '%".$txt."%'";
			}
		}
		
		$query = "select * from erp_lot_no".$where;
		
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_lot_no".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_lot_no".$where." order by uid limit ".($page-1)*$rpp.", ".$rpp;
		
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;

			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['lot_no_cd'] = $t->lot_no_cd;
			$re[$i]['lot_no_nm'] = $t->lot_no_nm;
			$re[$i]['lot_no_dt'] = $t->lot_no_dt;
			$re[$i]['etc'] = $t->etc;
			$re[$i]['regdate'] = substr($t->regdate,0,10);

			$i++;
			$ct++;
			//echo $re;
		}

		echo $json->encode($re);
	break;
	
	// Lot no 등록
	case "registLotNo" :
		if($uid != "") {
			$sql = "update erp_lot_no set lot_no_cd='".$lotnocd."', lot_no_nm='".$lotnonm."' where uid=".$uid;
		} else {
			$sql = "insert into erp_lot_no (lot_no_cd, lot_no_nm) values ('".$lotnocd."','".$lotnonm."')";
		}
		$result = query($sql);
		if($result) echo "success";
	break;


	case "get_item_lot_no" :
		$where = " where 1=1";

		//$where .= "";
		$where .= " and item_cd='".$item_cd."' and standard1='".$standard."'"; //구매 입고에서 부여된 LOT_NO를 가져오기 위한 
		if($txt != "") {
			if($search_choice == "lot_no_cd") {
				$where .= " and lot_no_cd like '%".$txt."%'";
			} else if($search_choice == "item_cd") {
				$where .= " and item_cd like '%".$txt."%'";
			}else{
				$where .= " and item_nm like '%".$txt."%'";
			}
		}
		
		$query = "select * from erp_warehousing_lot_no".$where;

		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_warehousing_lot_no".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_warehousing_lot_no".$where." order by lot_no_cd  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query; 
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;

			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['lot_no_cd'] = $t->lot_no_cd;
			$re[$i]['lot_no_nm'] = $t->lot_no_nm;
			
			if($t->warehousing_dt==""){
				$re[$i]['warehousing_dt'] = substr($t->warehousing_dt,0,10);;
			}else{
				$re[$i]['warehousing_dt'] = $t->warehousing_dt;
			}
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			
			$re[$i]['regdate'] = substr($t->regdate,0,10);

			$i++;
			$ct++;
			//echo $re;
		}

		echo $json->encode($re);
	break;

	case "get_account_code_remark" :   //적요 리스트
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

		$query = "select * from erp_account_code_remark".$where;
		
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 1000;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_account_code_remark".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_account_code_remark".$where." order by idx  limit ".($page-1)*$rpp.", ".$rpp;

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
			$query = "delete from erp_account_code where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectLotno" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_lot_no where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
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