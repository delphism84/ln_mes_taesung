<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

function checkSon($uid){
	$sql = "select * from erp_bom where fid=".$uid;
	$row = @mysql_num_rows(mysql_query($sql));

	return $row;
}

function getWarehouseNm($warehouse_cd) {
	$sql = "select warehouse_nm from erp_warehouse where warehouse_cd='".$warehouse_cd."'";
	$t = mysql_fetch_object(mysql_query($sql));
	return $t->warehouse_nm;
}


switch($mode) {
	case "re" :
		//세션 유지 시키기.
		$_SESSION['login_id'] = $_SESSION['login_id'];
		$_SESSION['login_nm'] = $_SESSION['login_nm'];
		$_SESSION['login_level'] = $_SESSION['login_level'];
		$_SESSION['emp_cd'] = $_SESSION['emp_cd'];
		$_SESSION['big_department_cd'] = $_SESSION['big_department_cd'];
		$_SESSION['big_department_nm'] = $_SESSION['big_department_nm'];
		$_SESSION['middle_department_cd'] = $_SESSION['middle_department_cd'];
		$_SESSION['middle_department_nm'] = $_SESSION['middle_department_nm'];
		$_SESSION['small_department_cd'] = $_SESSION['small_department_cd'];
		$_SESSION['small_department_nm'] = $_SESSION['small_department_nm'];
		$_SESSION['position_cd'] = $_SESSION['position_cd'];
		$_SESSION['position_nm'] = $_SESSION['position_nm'];

		$_SESSION['auto_purchase'] = $_SESSION['auto_purchase'];
		$_SESSION['auto_work'] = $_SESSION['auto_work'];
		$_SESSION['auto_code'] = $_SESSION['auto_code'];
		$_SESSION['auto_release'] = $_SESSION['auto_release'];
		$_SESSION['auto_lotno'] = $_SESSION['auto_lotno'];
		$_SESSION['auto_barcode'] = $_SESSION['auto_barcode'];
		$_SESSION['auto_project'] = $_SESSION['auto_project'];
		$_SESSION['auto_safety_stock'] = $_SESSION['auto_safety_stock'];
	
	break;

}
?>