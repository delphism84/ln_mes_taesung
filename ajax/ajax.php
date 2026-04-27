<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	

	



	// 공정코드 자동생성
	case "createProcessCode" :
		if($process_gb == "1") {
			// 내부공정
			$return = "PI-".time();
		} else if($process_gb == "2") {
			// 외주공정
			$return = "PO-".time();
		}

		echo $return;
	break;

	

	// 사원코드 자동생성
	case "createEmployeeCode" :
		if($sex_gb == "m") {
			$return = "EM-".time();
		} else if($sex_gb == "w") {
			$return = "EW-".time();
		}

		echo $return;
	break;
}
?>