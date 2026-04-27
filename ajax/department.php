<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	case "getBigDepartment" :
		$sql = "select * from erp_department_big order by seq asc";
		$result = mysql_query($sql);

		$i = 0;
		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['department_nm'] = $t->department_nm;
			$re[$i]['seq'] = $t->seq;
			$i++;
		}

		echo $json->encode($re);
	break;

	case "getMiddleDepartment" :
		$sql = "select * from erp_department_middle where fid=".$fid;
		$result = mysql_query($sql);

		$i = 0;
		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['department_nm'] = $t->department_nm;
			$re[$i]['seq'] = $t->seq;
			$i++;
		}

		echo $json->encode($re);
	break;

	case "getSmallDepartment" :
		$sql = "select * from erp_department_small where fid=".$fid;
		$result = mysql_query($sql);

		$i = 0;
		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['department_nm'] = $t->department_nm;
			$re[$i]['seq'] = $t->seq;
			$i++;
		}

		echo $json->encode($re);
	break;

	case "registBigDepartment" :
		if(isset($_POST['uid'])) {
			$sql = "update erp_department_big set department_nm='".$_POST['department_nm']."', seq=".$_POST['seq']." where uid=".$_POST['uid'];
		} else {
			$sql = "insert into erp_department_big (department_nm, seq, create_dt) values ('$_POST[department_nm]',$_POST[seq],now())";
		}
		$result = mysql_query($sql);
		if($result) echo "success";
	break;

	case "registMiddleDepartment" :
		if(isset($_POST['uid'])) {
			$sql = "update erp_department_middle set department_nm='".$_POST['department_nm']."', seq=".$_POST['seq']." where uid=".$_POST['uid'];
		} else {
			$sql = "insert into erp_department_middle (fid, department_nm, seq, create_dt) values ($_POST[fid], '$_POST[department_nm]', $_POST[seq],now())";
		}
		$result = mysql_query($sql);
		if($result) echo "success";
	break;

	case "registSmallDepartment" :
		if(isset($_POST['uid'])) {
			$sql = "update erp_department_small set department_nm='".$_POST['department_nm']."', seq=".$_POST['seq']." where uid=".$_POST['uid'];
		} else {
			$sql = "insert into erp_department_small (fid, department_nm, seq, create_dt) values ($_POST[fid], '$_POST[department_nm]', $_POST[seq],now())";
		}
		$result = mysql_query($sql);
		if($result) echo "success";
	break;

	case "deleteBigDepartment" :
		$sql = "select uid from erp_department_middle where fid=".$_POST['uid'];
		$result = mysql_fetch_object(mysql_query($sql));

		if(isset($result->uid)) {
			echo "son";
		} else {
			$sql = "delete from erp_department_big where uid=".$_POST['uid'];
			$result = mysql_query($sql);
			if($result) echo "success";
		}
	break;

	case "deleteMiddleDepartment" :
		$sql = "select uid from erp_department_small where fid=".$_POST['uid'];
		$result = mysql_fetch_object(mysql_query($sql));

		if(isset($result->uid)) {
			echo "son";
		} else {
			$sql = "delete from erp_department_middle where uid=".$_POST['uid'];
			$result = mysql_query($sql);
			if($result) echo "success";
		}
	break;

	case "deleteSmallDepartment" :
		$sql = "delete from erp_department_small where uid=".$_POST['uid'];
		$result = mysql_query($sql);
		if($result) echo "success";
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectDepartment" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_department where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
}
?>