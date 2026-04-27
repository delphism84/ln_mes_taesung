<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	case "get_customer" :
		$query = "select * from CUSTOMER".$where;
		$total_num = @mysql_num_rows(@mysql_query($query));

		//if($gid > 0) {
		//	$search_sql .= " and gid=".$gid;
		//}

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 15;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from CUSTOMER".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from CUSTOMER".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

/*
NO
친밀도
고객명
회사명
부서
직위
회사전화
휴대폰
이메일
등록일
*/

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['scoreRelationship'] = $t->scoreRelationship;
			$re[$i]['name'] = $t->name;
			$re[$i]['company'] = $t->company;
			$re[$i]['department'] = $t->department;
			$re[$i]['position'] = $t->position;
			$re[$i]['contactPhoneCompany'] = $t->contactPhoneCompany;
			$re[$i]['contactMobile'] = $t->contactMobile;
			$re[$i]['contactEmail'] = $t->contactEmail;
			$re[$i]['dateCreate'] = substr($t->dateCreate,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
}
?>