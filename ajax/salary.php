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
	case "get_non_taxable_code" :
		$where = " where 1=1";

		$where .= "";
		if($txt != "") {
			if($search_choice == "account_nm") {
				$where .= " and account_nm like '%".$txt."%'";
			} else if($search_choice == "account_cd") {
				$where .= " and account_cd like '%".$txt."%'";
			}
		}
		
		$query = "select * from erp_non_taxable".$where;
		
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 1000;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_non_taxable".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_non_taxable".$where." order by uid  limit ".($page-1)*$rpp.", ".$rpp;

		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num']	= $total_num;
			$re[$i]['no']			= $no;
			$re[$i]['uid']			= $t->uid;
			$re[$i]['a_nontax_cd']	= strip_tags($t->a_nontax_cd);
			$re[$i]['a_nontax_nm']	= strip_tags($t->a_nontax_nm);
			$re[$i]['writer']		= $t->writer;
			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
			$ct++;
			//echo $re;
		}

		echo $json->encode($re);
	break;
	
	case "getEmployee" :
		$where = " where 1=1";
		
		if($department_cd == "all") {
			$where .= "";
		} else if($department_cd != "") {
			$where .= " and department_cd=".$department_cd;
		} else {
			$where .= "";
		}
		
		if($txt != "") {
			if($search_choice == "emp_cd") {
				$where .= " and emp_cd like '%".$txt."%'";
			} else if($search_choice == "emp_nm") {
				$where .= " and emp_nm like '%".$txt."%'";
			}
		}

		$query = "select * from erp_employee".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_employee".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_employee".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			if($t->sex_gb == "m") $sex_gb = "남성";
			else if($t->sex_gb == "2") $sex_gb = "여성";

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['emp_cd'] = $t->emp_cd;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_pwd'] = $t->emp_pwd;
			$re[$i]['sex_gb'] = $sex_gb;
			$re[$i]['regist_no'] = $t->regist_no;
			$re[$i]['emp_mobile'] = $t->emp_mobile;
			$re[$i]['emp_telephone'] = $t->emp_telephone;
			$re[$i]['emp_email'] = $t->emp_email;
			$re[$i]['join_dt'] = substr($t->join_dt,0,10);
			$re[$i]['resign_dt'] = substr($t->resign_dt,0,10);
			$re[$i]['department_cd'] = $t->department_cd;
			$re[$i]['department_nm'] = $t->department_nm;
			$re[$i]['position_cd'] = $t->position_cd;
			$re[$i]['position_nm'] = $t->position_nm;
			$re[$i]['emp_zipcode'] = $t->emp_zipcode;
			$re[$i]['emp_address'] = $t->emp_address;
			$re[$i]['img'] = $t->img;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);

			$querys = "select txtPayAmt1, txtPayAmt2 from erp_pay_member_item where pay_check_dt='" . $pay_check_dt."' and pay_check_ca='".$pay_check_ca."' and emp_cd='".$t->emp_cd."'";
			$results = mysql_query($querys); 
			$rows    = mysql_fetch_array($results);

			$txtPayAmt1 = $rows['txtPayAmt1'];
			$txtPayAmt1_arr	= explode('|',str_replace(",","",$txtPayAmt1));
			//implode(", ", $a) . "<br />\n";
			$txtPayAmt1_arr_sum = array_sum($txtPayAmt1_arr);
			$re[$i]['txtPayAmt1_arr_sum'] = number_format($txtPayAmt1_arr_sum);

			$txtPayAmt2 = $rows['txtPayAmt2'];
			$txtPayAmt2_arr	= explode('|',str_replace(",","",$txtPayAmt2));
			//implode(", ", $a) . "<br />\n";
			$txtPayAmt2_arr_sum = array_sum($txtPayAmt2_arr);
			$re[$i]['txtPayAmt2_arr_sum'] = number_format($txtPayAmt2_arr_sum);

			$i++;
			$ct++;
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