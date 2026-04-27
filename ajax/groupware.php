<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	case "createProjectCode" :
		echo "PJT-".time();
	break; 

	case "getProject" :
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

		$query = "select * from erp_project".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_project".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_project".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['emp_cd'] = $t->emp_cd;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['project_gb'] = $t->project_gb;
			$re[$i]['start_dt'] = substr($t->start_dt,0,10);
			$re[$i]['end_dt'] = substr($t->end_dt,0,10);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectProject" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_project where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	
	
	case "deleteSelectEleSettlementLine" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_ele_settlement_line where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "getEleSettlementLine" :
		$query = "select * from erp_ele_settlement_line where emp_id='".$_SESSION['login_id']."'";
		$result = mysql_query($query);

		$i = 0;
		
		while($t = @mysql_fetch_object($result)) {
			$query = "select * from erp_ele_settlement_emp where fid=". $t->uid;
			$res = mysql_query($query);
			$emp = "";
			while($t2 = mysql_fetch_object($res)) {
				$query = "select emp_nm from erp_employee where emp_id='".$t2->emp_id."'";
				$t3 = mysql_fetch_object(mysql_query($query));
				$emp .= $t3->emp_nm.",";
			}
			$re[$i]['emp'] = substr($emp,0,-1);
			$re[$i]['uid'] = $t->uid;
			$re[$i]['approval_nm'] = $t->approval_nm;
			$i++;
		}

		echo $json->encode($re);
	break;
	
	// 결재해야할 항목 가져오기
	case "getEleSettlement" :
		$where = " where emp_id='".$_SESSION['login_id']."' and sign='n'";
		$query = "select * from erp_approval_check".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$query = "select count(*) from erp_approval_check".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_approval_check".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			// 결재순서 확인
			$sql = "select * from erp_approval_check where fid=" . $t->fid . " and seq < ".$t->seq." and emp_id!='".$_SESSION['login_id']."' and sign='n'";
			$res1 = @mysql_num_rows(mysql_query($sql));

			if($res1 > 0) { // 나보다 우선 순위의 사람이 있다면

			} else { // 내가 결재를 해야할 순서라면
				$sql = "select * from erp_approval where uid=".$t->fid;
				$approval = @mysql_fetch_object(mysql_query($sql));
				
				$re[$i]['uid'] = $approval->uid;
				$re[$i]['title'] = $approval->title;
				$re[$i]['purchase_cd'] = $approval->purchase_cd;
				$re[$i]['attach'] = $approval->attach;
				$re[$i]['state'] = $approval->state;
				//$re[$i]['emp_id'] = getEmpNm($approval->emp_id);
				$re[$i]['emp_id'] = "김현수";
				$re[$i]['create_dt'] = substr($approval->create_dt,0,10);
				$i++;
			}
		}

		echo $json->encode($re);
	break;

	case "getMyEleSettlement" :
		$query = "select * from erp_approval".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$query = "select count(*) from erp_approval".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_approval".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['title'] = $t->title;
			$re[$i]['purchase_cd'] = $t->purchase_cd;
			$re[$i]['attach'] = $t->attach;
			$re[$i]['state'] = $t->state;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "approval" :
		// 결재처리
		$now = date("Y-m-d H:i:s");
		$sql = "update erp_approval_check set sign='y',sign_dt='".$now."' where fid=". $uid ." and emp_id='" . $_SESSION['login_id'] . "'";
		$result = mysql_query($sql);

		// 해당 결재에 구매요청서가 있는지 확인
		$sql = "select purchase_cd from erp_approval where uid=". $uid;
		$res1 = mysql_fetch_object(mysql_query($sql));
		if(isset($res1->purchase_cd)) { // 구매요청 코드가 있다면
			// 해당 결재에 모두 결재를 했는지 확인
			$sql = "select * from erp_approval_check where fid=". $uid ." and sign='n'";
			$res2 = @mysql_num_rows(mysql_query($sql));

			if($res2 < 1) { // 전부 승인을 했다면
				$sql = "select * from erp_purchase_demand where purchase_cd='". $res1->purchase_cd ."'"; // 구매요청 유니크 아이디를 가져오고
				$res3 = @mysql_fetch_object(mysql_query($sql));

				if(isset($res3->uid)) {
					$sql = "select * from erp_purchase_demand_item where fid=". $res3->uid;
					$res4 = mysql_query($sql);

					while($t1 = mysql_fetch_object($res4)) {
						$sql = "select * from erp_item where item_cd='". $t1->item_cd ."'";
						$res5 = @mysql_fetch_object(mysql_query($sql));

						$sql = "select warehouse_nm from erp_warehouse where warehouse_cd='". $res3->warehouse_cd ."'";
						$res6 = @mysql_fetch_object(mysql_query($sql));

						$sql = "
							insert into erp_purchase (
								purchase_cd,
								order_cd,
								project_cd,
								project_nm,
								account_cd,
								account_nm,
								warehouse_cd,
								warehouse_nm,
								item_cd,
								item_nm,
								standard1,
								standard2,
								standard3,
								cnt,
								pur_unit_price,
								total_price,
								remain_cnt,
								state,
								emp_id,
								create_dt
							) values (
								'$res1->purchase_cd',
								'$res3->order_cd',
								'$res3->project_cd',
								'$res3->project_nm',
								'$res5->account_cd',
								'$res5->account_nm',
								'$res3->warehouse_cd',
								'$res6->warehouse_nm',
								'$t1->item_cd',
								'$t1->item_nm',
								'$t1->standard1',
								'$t1->standard2',
								'$t1->standard3',
								$t1->cnt,
								$t1->pur_unit_price,
								$t1->total_price,
								$t1->cnt,
								'stay',
								'$_SESSION[login_id]',
								'$now'
							)
						";

						mysql_query($sql);
					}
				}
			}
		}
		
		

		if($result) echo "success";
	break;

	case "getMachine" :
		$where = "";

		$query = "select * from erp_machine".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_machine".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_machine".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['process_cd'] = $t->process_cd;
			$sql = "select process_nm from erp_process where process_cd='". $t->process_cd."'";
			$res = mysql_fetch_object(mysql_query($sql));
			$re[$i]['process_nm'] = $res->process_nm;
			$re[$i]['machine_nm'] = $t->machine_nm;
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
	
	// 파일보관함 가져오기
	case "getFile" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_file".$where." order by uid desc";
		else $query = "select * from erp_file".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['document_gb'] = $t->document_gb;
			$re[$i]['title'] = $t->title;
			$re[$i]['attach'] = $t->attach;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getBoard" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_board".$where." order by uid desc";
		else $query = "select * from erp_board".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['board_gb'] = $t->board_gb;
			$re[$i]['title'] = $t->title;
			$re[$i]['attach'] = $t->attach;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getSchedule" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_schedule".$where." order by uid desc";
		else $query = "select * from erp_schedule".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['schedule_gb'] = $t->schedule_gb;
			$re[$i]['title'] = $t->title;
			$re[$i]['importance'] = $t->importance;
			$re[$i]['schedule_dt'] = substr($t->schedule_dt,0,10);
			$re[$i]['schedule_tm'] = $t->schedule_tm;
			$re[$i]['place'] = $t->place;
			$re[$i]['emp_id'] = $t->emp_id;
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getVersion" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_version".$where." order by uid desc";
		else $query = "select * from erp_version".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['target'] = $t->target;
			$re[$i]['title'] = $t->title;
			$re[$i]['version'] = $t->version;
			$re[$i]['version_code'] = $t->version_code;
			$re[$i]['comment'] = $t->comment;
			$re[$i]['create_dt'] = $t->create_dt;
			$i++;
		}

		echo $json->encode($re);
	break;
	
	// 공용품 가져오기
	case "getPublicThing" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_public_thing".$where." order by uid desc";
		else $query = "select * from erp_public_thing".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			switch($t->change_gb) {
				case "day" : $type = "일"; break;
				case "week" : $type = "주"; break;
				case "month" : $type = "월"; break;
				case "year" : $type = "년"; break;
			}
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['item_gb'] = $t->item_gb;
			$re[$i]['in_dt'] = substr($t->in_dt,0,10);
			$re[$i]['change_day'] = $t->change_day.$type;
			$re[$i]['alarm_dt'] = substr($t->alarm_dt,0,10);
			$re[$i]['charge_id'] = $t->charge_id;
			$re[$i]['charge_nm'] = $t->charge_nm;
			$re[$i]['attach'] = $t->attach;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getInstallation" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_installation".$where." order by uid desc";
		else $query = "select * from erp_installation".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			switch($t->change_gb) {
				case "day" : $type = "일"; break;
				case "week" : $type = "주"; break;
				case "month" : $type = "월"; break;
				case "year" : $type = "년"; break;
			}
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['item_gb'] = $t->item_gb;
			$re[$i]['in_dt'] = substr($t->in_dt,0,10);
			$re[$i]['change_day'] = $t->change_day.$type;
			$re[$i]['alarm_dt'] = substr($t->alarm_dt,0,10);
			$re[$i]['charge_id'] = $t->charge_id;
			$re[$i]['charge_nm'] = $t->charge_nm;
			$re[$i]['attach'] = $t->attach;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
	
	// 차량리스트 가져오기
	case "getCar" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_car".$where." order by uid desc";
		else $query = "select * from erp_car".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['car_no'] = $t->car_no;
			$re[$i]['car_gb'] = $t->car_gb;
			$re[$i]['in_dt'] = substr($t->in_dt,0,10);
			$re[$i]['charge_id'] = $t->charge_id;
			$re[$i]['charge_nm'] = $t->charge_nm;
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "registAccident" :
		$sql = "
			insert into erp_car_accident (
				fid,
				accident_dt,
				accident_memo,
				accident_result
			) values (
				$fid,
				'$accident_dt',
				'$accident_memo',
				'$accident_result'
			)
		";

		$result = mysql_query($sql);
		if($result) echo "success";
	break;

	case "registService" :
		$sql = "
			insert into erp_car_service (
				fid,
				service_dt,
				service_memo,
				service_cost
			) values (
				$fid,
				'$service_dt',
				'$service_memo',
				$service_cost
			)
		";

		$result = mysql_query($sql);
		if($result) echo "success";
	break;

	case "registDrive" :
		$sql = "
			insert into erp_car_drive (
				fid,
				drive_dt,
				drive_object,
				drive_km
			) values (
				$fid,
				'$drive_dt',
				'$drive_object',
				$drive_km
			)
		";

		$result = mysql_query($sql);
		if($result) echo "success";
	break;

	case "getAccident" :
		$where = " where fid=$fid";

		$query = "select * from erp_car_accident".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_car_accident".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_car_accident".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['accident_dt'] = $t->accident_dt;
			$re[$i]['accident_memo'] = $t->accident_memo;
			$re[$i]['accdent_result'] = $t->accdent_result;
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getService" :
		$where = " where fid=$fid";

		$query = "select * from erp_car_service".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_car_service".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_car_service".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['service_dt'] = $t->service_dt;
			$re[$i]['service_memo'] = $t->service_memo;
			$re[$i]['service_cost'] = $t->service_cost;
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getDrive" :
		$where = " where fid=$fid";

		$query = "select * from erp_car_drive".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_car_drive".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_car_drive".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['drive_dt'] = $t->drive_dt;
			$re[$i]['drive_object'] = $t->drive_object;
			$re[$i]['drive_km'] = $t->drive_km;
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getCustomer" :
		$page = (is_numeric($page)) ? $page : 1; 
		$query = "select * from erp_customer".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['customer_nm'] = $t->customer_nm;
			$re[$i]['customer_gb'] = $t->customer_gb;
			$re[$i]['customer_phone'] = $t->customer_phone;
			$re[$i]['customer_email'] = $t->customer_email;
			$re[$i]['customer_zipcode'] = $t->customer_zipcode;
			$re[$i]['customer_address'] = $t->customer_address;
			$re[$i]['customer_birthday'] = substr($t->customer_birthday,0,10);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getCounsel" :
		$where = " where fid=$fid";

		$query = "select * from erp_counsel".$where;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['counsel_gb'] = $t->counsel_gb;
			$re[$i]['counsel_dt'] = substr($t->counsel_dt,0,10);
			$re[$i]['counsel'] = $t->counsel;
			$sql = "select emp_nm from erp_employee where emp_id='".$t->emp_id."'";
			$emp = mysql_fetch_object(mysql_query($sql));
			$re[$i]['emp_nm'] = $emp->emp_nm;
			$i++;
		}

		echo $json->encode($re);
	break;

	case "getEmpWorkLeave" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $sql = "select * from erp_employee".$where." order by uid desc";
		else $sql = "select * from erp_employee".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($sql);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$date = date("Y-m-d 00:00:00");
			$work_tm_value = mktime(9,0,0,date('m'),date('d'),date('Y'));

			$sql = "select * from erp_work_leave where emp_id='".$t->emp_id."' and create_dt='".$date."'";
			$res = mysql_fetch_object(mysql_query($sql));

			if(!isset($res->work_tm)) $work_tm = ""; else $work_tm = $res->work_tm;
			if(!isset($res->leave_tm)) $leave_tm = ""; else $leave_tm = $res->leave_tm;

			$wt = explode(":",$res->work_tm);
			$cwork_tm = mktime($wt[0],$wt[1],$wt[2],date('m'),date('d'),date('Y'));
			if($work_tm_value < $cwork_tm) $color = "red";
			else $color = "";
			
			if($t->big_department_nm != "") $department_nm = $t->big_department_nm;
			if($t->middle_department_nm != "") $department_nm .= "-".$t->middle_department_nm;
			if($t->small_department_nm != "") $department_nm .= "-".$t->small_department_nm;

			$re[$i]['emp_cd'] = $t->emp_cd;
			$re[$i]['department_nm'] = $department_nm;
			$re[$i]['position_nm'] = $t->position_nm;
			$re[$i]['uid'] = $res->uid;
			$re[$i]['color'] = $color;
			$re[$i]['emp_id'] = $res->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['work_tm'] = $work_tm;
			$re[$i]['leave_tm'] = $leave_tm;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;

	case "getError" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_error".$where." order by uid desc";
		else $query = "select * from erp_error".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['account'] = $t->account;
			$re[$i]['title'] = $t->title;
			$re[$i]['comment'] = $t->comment;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "deleteSelectBoard" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_board where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectSchedule" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_schedule where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectFile" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_file where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectPublicThing" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_public_thing where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectCar" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_car where uid=".$array_uid[$i];
			mysql_query($query);
			$query = "delete from erp_car_drive where fid=".$array_uid[$i];
			mysql_query($query);
			$query = "delete from erp_car_accident where fid=".$array_uid[$i];
			mysql_query($query);
			$query = "delete from erp_car_service where fid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectInstallation" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_installation where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
}
?>