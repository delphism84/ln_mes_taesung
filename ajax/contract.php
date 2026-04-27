<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	case "get_contract" :
		$query = "select * from contract".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		//if($gid > 0) {
		//	$search_sql .= " and gid=".$gid;
		//}

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from contract".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from contract".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

/*
NO
계약일자
만기일자
계약자
피보험자
상품구분
보험사
보험료
*/

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['join_date'] = $t->join_date;
			$re[$i]['end_date'] = $t->end_date;
			$re[$i]['policyholder'] = $t->policyholder;
			$re[$i]['insurant'] = $t->insurant;
			$re[$i]['ins_div'] = $t->ins_div;
			$re[$i]['ins_company'] = $t->ins_company;
			$re[$i]['payment'] = number_format($t->payment);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
}
?>