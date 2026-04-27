<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	
	
	// 프로세스를 셀렉박스에 적용시키기 위함
	case "getProcessSelectBox" :
		$query = "select * from erp_process";
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['process_gb'] = $process_gb;
			$re[$i]['process_cd'] = $t->process_cd;
			$re[$i]['process_nm'] = $t->process_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;

	// 프로세스를 셀렉박스에 적용시키기 위함
	case "getProcessMachine" :
		$query = "select * from erp_machine where process_cd='" .$process_cd ."'";
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['machine_nm'] = $t->machine_nm;
			$i++;
		}

		echo $json->encode($re);
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectProcess" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_process where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
}
?>