<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	case "get_document" :
		$query = "select * from data".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		//if($gid > 0) {
		//	$search_sql .= " and gid=".$gid;
		//}

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from data".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from data".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

/*
NO
고객명
상담일
프로세스
호응도
다음 프로세스
다음 상담 날짜
다음 상담 시간
*/

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['title'] = $t->title;
			$re[$i]['upload_file'] = $t->upload_file;
			$re[$i]['reg_date'] = substr($t->reg_date,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
}
?>