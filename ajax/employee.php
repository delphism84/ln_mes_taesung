<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	

	case "getDailyWorker" :
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

		$query = "select * from erp_daily_worker".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_daily_worker".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_daily_worker".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
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
			$re[$i]['emp_zipcode'] = $t->emp_zipcode;
			$re[$i]['emp_address'] = $t->emp_address;

			$re[$i]['pay_gb'] = $t->pay_gb;
			$re[$i]['health_ins'] = $t->health_ins;
			$re[$i]['national_pension'] = $t->national_pension;
			$re[$i]['eldelry_ins'] = $t->eldelry_ins;
			$re[$i]['unemployment_ins'] = $t->unemployment_ins;
			$re[$i]['occupation'] = $t->occupation;
			$re[$i]['nationality'] = $t->nationality;

			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectEmployee" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_employee where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "getDepartment" :
		$query = "select * from erp_department order by seq asc";
		$result = mysql_query($query);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['department_nm'] = $t->department_nm;
			$i++;
		}

		echo $json->encode($re);
	break;

	case "getApprovalEmployee" :
		$where = " where 1=1";
		
		if($big_department_cd == "all") {
			$where .= "";
		} else if($big_department_cd != "" && $big_department_cd != "all" ) {
			$where .= " and big_department_cd=".$big_department_cd;
		} else if($middle_department_cd != "" && $middle_department_cd != "all" ) {
			$where .= " and middle_department_cd=".$middle_department_cd;
		} else if($small_department_cd != "" && $small_department_cd != "all" ) {
			$where .= " and small_department_cd=".$small_department_cd;
		}

		$query = "select * from erp_employee".$where." order by uid desc";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['department_nm'] = "미지정";
			$re[$i]['uid'] = $t->uid;
			$re[$i]['emp_cd'] = $t->emp_cd;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['emp_id'] = $t->emp_id;
			$i++;
		}

		echo $json->encode($re);
	break;

	case "login" :
		if($_SESSION['login_id'] == "") {
			if(($emp_id == "root" && $emp_pwd == "tae8927") || ($emp_id == "root" && $emp_pwd == "846975")) {
				$_SESSION['login_id'] = "sysadmin";
				$_SESSION['login_nm'] = "최고관리자";
				$_SESSION['login_level'] = "100";
				$_SESSION['emp_cd'] = "";
				$_SESSION['big_department_cd'] = "";
				$_SESSION['big_department_nm'] = "";
				$_SESSION['middle_department_cd'] = "";
				$_SESSION['middle_department_nm'] = "";
				$_SESSION['small_department_cd'] = "";
				$_SESSION['small_department_nm'] = "";
				$_SESSION['position_cd'] = "";
				$_SESSION['position_nm'] = "";

				// 환경설정
				$sql = "select * from erp_config";
				$config = @mysql_fetch_object(mysql_query($sql));

				$_SESSION['auto_purchase'] = $config->auto_purchase;
				$_SESSION['auto_work'] = $config->auto_work;
				$_SESSION['auto_code'] = $config->auto_code;
				$_SESSION['auto_release'] = $config->auto_release;
				$_SESSION['auto_lotno'] = $config->auto_lotno;
				$_SESSION['auto_barcode'] = $config->auto_barcode;
				$_SESSION['auto_project'] = $config->auto_project;
				$_SESSION['auto_safety_stock'] = $config->auto_safety_stock;
				echo "success";
			} else {
				$sql = "select * from erp_employee where emp_id='".$emp_id."'";
				$t = @mysql_fetch_object(mysql_query($sql));

				if(isset($t->emp_id)) {
					if($t->emp_pwd == $emp_pwd) {
						$sql = "select uid from erp_info where admin='".$t->emp_id."'";
						$admin = mysql_fetch_object(mysql_query($sql));

						if(isset($admin->uid)) $_SESSION['login_level'] = "99";
						$_SESSION['memberCsn'] = $t->uid;
						$_SESSION['login_id'] = $t->emp_id;
						$_SESSION['login_nm'] = $t->emp_nm;
						$_SESSION['login_cd'] = $t->emp_cd;
						$_SESSION['big_department_cd'] = $t->big_department_cd;
						$_SESSION['big_department_nm'] = $t->big_department_nm;
						$_SESSION['middle_department_cd'] = $t->middle_department_cd;
						$_SESSION['middle_department_nm'] = $t->middle_department_nm;
						$_SESSION['small_department_cd'] = $t->small_department_cd;
						$_SESSION['small_department_nm'] = $t->small_department_nm;
						$_SESSION['position_cd'] = $t->position_cd;
						$_SESSION['position_nm'] = $t->position_nm;
						
						// 환경설정
						$sql = "select * from erp_config";
						$congif = @mysql_fetch_object(mysql_query($sql));

						$_SESSION['auto_purchase'] = $config->auto_purchase;
						$_SESSION['auto_work'] = $config->auto_work;
						$_SESSION['auto_code'] = $config->auto_code;
						$_SESSION['auto_release'] = $config->auto_release;
						$_SESSION['auto_lotno'] = $config->auto_lotno;
						$_SESSION['auto_barcode'] = $config->auto_barcode;
						$_SESSION['auto_project'] = $config->auto_project;
						$_SESSION['auto_safety_stock'] = $config->auto_safety_stock;

						// 출근시간등록
						$date = date("Y-m-d");
						$time = date("H:i:s");

						$check_date = $date." 00:00:00";

						// 먼저 오늘 출근 기록이 있나 확인
						$sql = "select uid from erp_work_leave where emp_id='".$t->emp_id."' and create_dt='".$check_date."'";
						$res = mysql_fetch_object(mysql_query($sql));

						if(!isset($res->uid)) {
							$sql = "insert into erp_work_leave (emp_id, emp_nm, work_tm, create_dt) values ('".$t->emp_id."','".$t->emp_nm."','".$time."','".$date."')";
							mysql_query($sql);
						}
						echo "success";
					} else {
						echo "pwd";
					}
				} else {
					echo "none";
				}
			}
		}
	break;
}
?>