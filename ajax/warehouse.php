<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
//	case "getWarehouse" : //기존코드
//		$query = "select * from erp_warehouse".$where;
//		$total_num = mysql_num_rows(mysql_query($query));
//
//		$page = (is_numeric($page)) ? $page : 1; 
//		$query = "select count(*) from erp_warehouse".$where;
//		$query = mysql_query($query); 
//		list($total) = mysql_fetch_row($query); 
//		$query = "select * from erp_warehouse".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
//		$result = mysql_query($query);
//
//		$i = 0;
//
//		while($t = @mysql_fetch_object($result)) {
//			$re[$i]['uid'] = $t->uid;
//			$re[$i]['warehouse_gb'] = $t->warehouse_gb;
//			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
//			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
//			$re[$i]['process_nm'] = $t->process_nm;
//			$re[$i]['account_cd'] = $t->account_cd;
//			$re[$i]['account_nm'] = $t->account_nm;
//			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
//			$i++;
//		}
//
//		echo $json->encode($re);
//	break;

	case "getWarehouse" :
		$query = "select * from erp_warehouse";
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['warehouse_gb'] = $t->warehouse_gb;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['process_nm'] = $t->process_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;

	case "getWarehouseList" :
		
		$where = " where 1=1";
		
		if($warehouse_gb != "") {
			$where .= " and warehouse_gb = '".$warehouse_gb."'";
		}

		if($search_txt != "") {
			$where .= " and (warehouse_nm like '%".$search_txt."%' or warehouse_cd like '%".$search_txt."%')";
		}

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_warehouse".$where." order by uid desc";
		else $query = "select * from erp_warehouse".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['warehouse_gb'] = $t->warehouse_gb;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['process_nm'] = $t->process_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;

	case "getSelectWarehouse" :
		$query = "select * from erp_warehouse order by uid desc";
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['warehouse_gb'] = $t->warehouse_gb;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['process_nm'] = $t->process_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectWarehouse" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_warehouse where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
}
?>