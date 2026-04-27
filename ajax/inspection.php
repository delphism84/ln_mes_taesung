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
			if($search_choice == "account_nm") {
				$where .= " and account_nm like '%".$txt."%'";
			} else if($search_choice == "account_cd") {
				$where .= " and account_cd like '%".$txt."%'";
			}
		}
		
		$query = "select * from erp_lot_no".$where;
		
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 1000;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_lot_no".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_lot_no".$where." order by lot_no_cd  limit ".($page-1)*$rpp.", ".$rpp;

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
			$re[$i]['regdate'] = substr($t->regdate,0,10);

			$i++;
			$ct++;
			//echo $re;
		}

		echo $json->encode($re);
	break;
	
	//수입검사
	case "registInspectionCd" :

		if($uid != "") {
			$sql = "update erp_receiving_inspection set item_cd='".$item_cd."', item_nm='".$item_nm."' , standard1='".$standard1."', unit='".$unit."', in_cnt='".$in_cnt."', faulty_cnt='".$faulty_cnt."', faulty_content='".$faulty_content."', emp_id='".$emp_id."', emp_nm='".$emp_nm."', regdate='".$regdate."' where uid=".$uid;
		} else {
			//$now = date("Y-m-d H:i:s");
			$inspection_dt = date("Y/m/d");
			
			$sql = "select max(inspection_cha) as cnt from erp_receiving_inspection where inspection_dt='".$inspection_dt."'";
			//echo $sql."<BR>"; 
			$t0 = mysql_fetch_object(mysql_query($sql));
			
			if (is_null($t0->cnt) || empty($t0->cnt)){
				$inspection_cha = "1";
			}else{
				$inspection_cha = $t0->cnt+1;
			}

			$inspection_cd  = trim($inspection_dt)."-".trim($inspection_cha);

			$sql = "insert into erp_receiving_inspection (inspection_cd, inspection_dt, inspection_cha, item_cd, item_nm, standard1, unit, in_cnt, faulty_cnt, faulty_content, emp_id, emp_nm, regdate) values ('".$inspection_cd."','".$inspection_dt."','".$inspection_cha."','".$item_cd."','".$item_nm."','".$standard1."','".$unit."','".$in_cnt."','".$faulty_cnt."','".$faulty_content."','".$emp_id."','".$emp_nm."','".$regdate."')";
			//echo $sql;
		}
		$results = query($sql);
		
		//if($results){ 
			//$result['success']	= "true";
			//$result['code']		= $inspection_cd;
		//}
		echo $inspection_cd;
		//$result = $inspection_cd;
		//echo $json->encode($result);
	break;

	case "modifyInspectionCd" :

		if($uid != "") {
			$sql = "update erp_receiving_inspection set item_cd='".$item_cd."', item_nm='".$item_nm."' , standard1='".$standard1."', unit='".$unit."', in_cnt='".$in_cnt."', faulty_cnt='".$faulty_cnt."', faulty_content='".$faulty_content."', emp_id='".$emp_id."', emp_nm='".$emp_nm."' where uid=".$uid;
		} else {
			$now = date("Y-m-d H:i:s");
			$inspection_dt = date("Y/m/d");
			
			$sql = "select max(inspection_cha) as cnt from erp_receiving_inspection where inspection_dt='".$inspection_dt."'";
			//echo $sql."<BR>"; 
			$t0 = mysql_fetch_object(mysql_query($sql));
			
			if (is_null($t0->cnt) || empty($t0->cnt)){
				$inspection_cha = "1";
			}else{
				$inspection_cha = $t0->cnt+1;
			}

			$inspection_cd  = trim($inspection_dt)."-".trim($inspection_cha);

			$sql = "insert into erp_receiving_inspection (inspection_cd, inspection_dt, inspection_cha, item_cd, item_nm, standard1, unit, in_cnt, faulty_cnt, faulty_content, emp_id, emp_nm, regdate) values ('".$inspection_cd."','".$inspection_dt."','".$inspection_cha."','".$item_cd."','".$item_nm."','".$standard1."','".$unit."','".$in_cnt."','".$faulty_cnt."','".$faulty_content."','".$emp_id."','".$emp_nm."','".$now."')";
			//echo $sql;
		}
		echo $sql;
		$results = query($sql);
		
		//if($results){ 
			//$result['success']	= "true";
			//$result['code']		= $inspection_cd;
		//}
		echo $inspection_cd;
		//$result = $inspection_cd;
		//echo $json->encode($result);
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