<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
//***********************************************************************************************
// 품목관리
//***********************************************************************************************
	// 품목 리스트 가져오기
	case "getItem" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_item".$where." order by uid desc";
		else $query = "select * from erp_item".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['min_pur_unit'] = $t->min_pur_unit;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['delivery_period'] = $t->delivery_period;
			$re[$i]['base_stock_cnt'] = number_format($t->base_stock_cnt);
			$re[$i]['safety_stock_cnt'] = number_format($t->safety_stock_cnt);
			$re[$i]['item_gb'] = $t->item_gb;
			$re[$i]['item_group_cd'] = $t->item_group_cd;
			$re[$i]['item_group_nm'] = $t->item_group_nm;
			$re[$i]['pur_unit_price'] = number_format($t->pur_unit_price);
			$re[$i]['unit_price'] = number_format($t->unit_price);

			// 바코드 이미지 가져오기
			$url = "../barcodegen/image.php?code=".$t->in_barcode."&style=196&type=C128B&width=167&height=70&xres=1&font=3";
			$re[$i]['in_barcode_url'] = $url;
			$img = "<img src='$url'>";

			$re[$i]['in_barcode'] = $img;
			
			// 바코드 이미지 가져오기
			$url = "../barcodegen/image.php?code=".$t->barcode."&style=196&type=C128B&width=167&height=70&xres=1&font=3";
			$img = "<img src='$url'>";
											
			$re[$i]['barcode'] = $img;
			$re[$i]['lot_no'] = $t->lot_no;
			$re[$i]['img'] = $t->img;
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	// 품목코드 자동생성
	case "createItemCode" :
		if($item_gb == "component") {
			// 자재
			$return = "C-".time();
		} else if($item_gb == "semi_product") {
			// 반제품
			$return = "S-".time();
		} else if($item_gb == "product") {
			// 완제품
			$return = "P-".time();
		}

		echo $return;
	break;

	// 품목그룹코드 자동생성
	case "createItemGroupCode" :
		$return = "IG-".time();

		echo $return;
	break;

	// 품목그룹 등록
	case "registItemGroup" :
		$sql = "insert into erp_item_group (item_group_cd, item_group_nm) values ('".$item_group_cd."','".$item_group_nm."')";
		$result = mysql_query($sql);
		if($result) echo "success";
	break;

	// 규격1 등록
	case "registItemStandard1" :
		$sql = "insert into erp_standard1 (item_cd, standard) values ('".$item_cd."','".$standard."')";
		$result = mysql_query($sql);
		if($result) echo "success";
	break;

	// 규격2 등록
	case "registItemStandard2" :
		$sql = "insert into erp_standard2 (item_cd, standard) values ('".$item_cd."','".$standard."')";
		$result = mysql_query($sql);
		if($result) echo "success";
	break;

	// 규격3 등록
	case "registItemStandard3" :
		$sql = "insert into erp_standard3 (item_cd, standard) values ('".$item_cd."','".$standard."')";
		$result = mysql_query($sql);
		if($result) echo "success";
	break;

		// 재질 등록
	case "registItemMaterial" :
		$sql = "insert into erp_material (item_cd, material) values ('".$item_cd."','".$material."')";
		$result = mysql_query($sql);
		if($result) echo "success";
	break;
	
	// 품목코드 중복검사
	case "checkItemCode" :
		$query = "select uid from erp_item where item_cd='".$item_cd."' and standard1='".$standard1."' ";
		$row = mysql_num_rows(mysql_query($query));
		if($row > 0) echo "false";
		else echo "true";
	break;
//***********************************************************************************************
// 거래처관리
//***********************************************************************************************
	// 거래처코드 자동생성
	case "createAccountCode" :
		if($account_gb == "매입") {
			// 매입처
			$return = "PU-".time();
		} else {
			// 매출처
			$return = "SA-".time();
		}

		echo $return;
	break;

	// 거래처 리스트 가져오기
	case "getAccount" :
		$query = "select * from erp_account".$where;
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 

		if($rpp == "all") $query = "select * from erp_account".$where." order by uid desc";
		else $query = "select * from erp_account".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;

		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['account_gb'] = $t->account_gb;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['owner'] = $t->owner;
			$re[$i]['corp_phone'] = $t->corp_phone;
			$re[$i]['corp_fax'] = $t->corp_fax;
			$re[$i]['corp_email'] = $t->corp_email;
			$re[$i]['manager'] = $t->manager;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
//***********************************************************************************************
// 부서관리
//***********************************************************************************************
	// 대부서 가져오기
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
	
	// 중부서 가져오기
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
	
	// 소부서 가져오기
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
	
	// 대부서 등록
	case "registBigDepartment" :
		if($_POST['uid'] !="") {
			$sql = "update erp_department_big set department_nm='".$_POST['department_nm']."', seq=".$_POST['seq']." where uid=".$_POST['uid'];
		} else {
			$sql = "insert into erp_department_big (department_nm, seq, create_dt) values ('$_POST[department_nm]',$_POST[seq],now())";
		}
		
		$result = mysql_query($sql);
		if($result) echo "success";
	break;
	
	// 중부서 등록
	case "registMiddleDepartment" :
		if(isset($_POST['uid'])) {
			$sql = "update erp_department_middle set department_nm='".$_POST['department_nm']."', seq=".$_POST['seq']." where uid=".$_POST['uid'];
		} else {
			$sql = "insert into erp_department_middle (fid, department_nm, seq, create_dt) values ($_POST[fid], '$_POST[department_nm]', $_POST[seq],now())";
		}

		$result = mysql_query($sql);
		if($result) echo "success";
	break;
	
	// 소부서 등록
	case "registSmallDepartment" :
		if(isset($_POST['uid'])) {
			$sql = "update erp_department_small set department_nm='".$_POST['department_nm']."', seq=".$_POST['seq']." where uid=".$_POST['uid'];
		} else {
			$sql = "insert into erp_department_small (fid, department_nm, seq, create_dt) values ($_POST[fid], '$_POST[department_nm]', $_POST[seq],now())";
		}
		$result = mysql_query($sql);
		if($result) echo "success";
	break;
	
	// 대부서 삭제
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
	
	// 중부서 삭제
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
	
	// 소부서 삭제
	case "deleteSmallDepartment" :
		$sql = "delete from erp_department_small where uid=".$_POST['uid'];
		$result = mysql_query($sql);
		if($result) echo "success";
	break;
//***********************************************************************************************
// 직위관리
//***********************************************************************************************
	// 직위 가져오기
	case "getPosition" :
		$query = "select * from erp_position order by seq asc";
		$result = mysql_query($query);
		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['position_nm'] = $t->position_nm;
			$re[$i]['seq'] = $t->seq;
			$i++;
		}

		echo $json->encode($re);
	break;

	// 직위 등록
	case "registPosition" :
		if($uid != "") {
			$sql = "update erp_position set position_nm='".$position_nm."', seq=".$seq." where uid=".$uid;
		} else {
			$sql = "insert into erp_position (position_nm, seq) values ('".$position_nm."',".$seq.")";
		}
		$result = query($sql);
		if($result) echo "success";
	break;
	
	// 직위 삭제
	case "deleteSelectPosition" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_position where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
//***********************************************************************************************
// 사원관리
//***********************************************************************************************
	// 사원코드 자동생성
	case "createEmployeeCode" :
		if($sex_gb == "m") {
			$return = "EM-".time();
		} else if($sex_gb == "w") {
			$return = "EW-".time();
		}

		echo $return;
	break;

	//  사원리스트 가져오기
	case "getEmployee" :
		$query = "select * from erp_employee".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 

		if($rpp == "all") $query = "select * from erp_employee".$where." order by uid desc";
		else $query = "select * from erp_employee".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;

		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			if($t->sex_gb == "m") $sex_gb = "남성";
			else if($t->sex_gb == "w") $sex_gb = "여성";

			if($t->process_gb == "") $process_gb = "";
			else if($t->process_gb != "") $process_gb = $t->process_gb;

			if($t->big_department_nm != "") $department_nm = $t->big_department_nm;
			if($t->middle_department_nm != "") $department_nm .= "-".$t->middle_department_nm;
			if($t->small_department_nm != "") $department_nm .= "-".$t->small_department_nm;

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['emp_cd'] = $t->emp_cd;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_pwd'] = $t->emp_pwd;
			$re[$i]['sex_gb'] = $sex_gb;
			$re[$i]['process_gb'] = $process_gb;
			$re[$i]['regist_no'] = $t->regist_no;
			$re[$i]['emp_mobile'] = $t->emp_mobile;
			$re[$i]['emp_telephone'] = $t->emp_telephone;
			$re[$i]['emp_email'] = $t->emp_email;
			$re[$i]['join_dt'] = substr($t->join_dt,0,10);
			$re[$i]['resign_dt'] = substr($t->resign_dt,0,10);
			$re[$i]['department_nm'] = $department_nm;
			$re[$i]['position_cd'] = $t->position_cd;
			$re[$i]['position_nm'] = $t->position_nm;

			If ($t->emp_zipcode==""){
				$emp_zipcode = "";
			}else{
				$emp_zipcode = "[".$t->emp_zipcode."]";
			}

			If ($t->emp_address==""){
				$emp_address = "";
			}else{
				$emp_address = "".$t->emp_address."";
			}	 

			$re[$i]['emp_zipcode'] = $emp_zipcode;
			$re[$i]['emp_address'] = $emp_address;
			$re[$i]['img'] = $t->img;
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
//***********************************************************************************************
// 창고관리
//***********************************************************************************************
	// 창고코드 자동생성
	case "createWarehouseCode" :
		if($warehouse_gb == "창고") {
			// 창고
			$return = "WA-".time();
		} else if($warehouse_gb == "공장") {
			// 공장
			$return = "FA-".time();
		} else {
			// 외주공장
			$return = "OS-".time();
		}

		echo $return;
	break;
	
	// 창고 리스트 가져오기
	case "getWarehouse" :
		$query = "select * from erp_warehouse";
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

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

	// 창고 등록
	case "registWarehouse" :
		if($uid != "") {
			$sql = "update erp_warehouse set warehouse_gb='".$warehouse_gb."', warehouse_cd='".$warehouse_cd."', warehouse_nm='".$warehouse_nm."', process_nm='".$process_nm."', account_cd='".$account_cd."', account_nm='".$account_nm."' where uid=".$uid;
		} else {
			$sql = "insert into erp_warehouse (warehouse_gb, warehouse_cd, warehouse_nm, process_nm, account_cd, account_nm) values ('".$warehouse_gb."','".$warehouse_cd."','".$warehouse_nm."','".$process_nm."','".$account_cd."','".$account_nm."')";
		}
		//echo $sql;
		$result = query($sql);
		if($result) echo "success";
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
//***********************************************************************************************
// 공정관리
//***********************************************************************************************
	// 공정코드 자동생성
	case "createProcessCode" :
		if($process_gb == "1공장") {
			// 내부공정
			$return = "P1-".time();
		} else if($process_gb == "2공장") {
			// 외주공정
			$return = "P2-".time();
		}

		echo $return;
	break;

	// 공정 등록
	case "registProcess" :
		$query = "select process_cd from erp_process where process_cd='".$process_cd."'";
		//echo $query;
		$t = mysql_fetch_object(mysql_query($query));

		if(isset($t->process_cd)) {
			echo "duplicate";
			exit;
		}

		if ($process_gb=="")
		{
			$process_gb="1공장";
		}
		if($uid != "") {
			$sql = "update erp_process set process_gb='".$process_gb."', process_cd='".$process_cd."', process_nm='".$process_nm."', account_cd='".$account_cd."', account_nm='".$account_nm."', ranking='".$ranking."' where uid=".$uid;
		} else {
			$sql = "insert into erp_process (process_gb, process_cd, process_nm, account_cd, account_nm, ranking) values ('".$process_gb."','".$process_cd."','".$process_nm."','".$account_cd."','".$account_nm."','".$ranking."')";
		}
		//echo $sql;
		$result = query($sql);
		if($result) echo "success";
	break;

	case "modifyProcess" :
			$sql = "update erp_process set process_gb='".$process_gb."', process_cd='".$process_cd."', process_nm='".$process_nm."', account_cd='".$account_cd."', account_nm='".$account_nm."', ranking='".$ranking."' where uid=".$uid;
		
		//echo $sql;
		$result = query($sql);
		if($result) echo "success";
	break;
	
	// 공정가져오기
	case "getProcess" :
		/*
		if ($process_gb == "" || $where == ""){ 
			$where = " where process_gb='1공장'" ;
		}else{
			$where = " where process_gb='".$process_gb."'" ;
		}
		*/
		if ($where == ""){ 
			$where = " where process_gb='1공장'" ;
		}

		$query = "select * from erp_process".$where;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['process_gb'] = $t->process_gb;
			$re[$i]['process_cd'] = $t->process_cd;
			$re[$i]['process_nm'] = $t->process_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$i++;
		}

		echo $json->encode($re);
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectProcess" :
		if ($uids!=""){
			$array_uid = explode(",",$uids);
			for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
				$query = "delete from erp_process where uid=".$array_uid[$i];
				mysql_query($query);
			}
		}else{
			$query = "delete from erp_process where uid=".$uid;
			mysql_query($query);
		
		}

		echo "success";
	break;
//***********************************************************************************************
// 생산기기관리
//***********************************************************************************************
	// 기계가져오기
	case "getMachine" :
		$query = "select * from erp_machine order by uid, process_cd, machine_nm";
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['process_cd'] = $t->process_cd;
			$re[$i]['process_gb'] = getProcessGb($t->process_cd);
			$re[$i]['process_nm'] = getProcessName($t->process_cd);
			$re[$i]['machine_nm'] = $t->machine_nm;
			$i++;
		}

		echo $json->encode($re);
	break;

	// 공정 등록
	case "registMachine" :
		if($uid != "") {
			$sql = "update erp_machine set process_cd='".$process_cd."', machine_nm='".$machine_nm."' where uid=".$uid;
		} else {
			$sql = "insert into erp_machine (process_cd, machine_nm) values ('".$process_cd."','".$machine_nm."')";
		}
		//echo $sql;
		$result = query($sql);
		if($result) echo "success";
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectMachine" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_machine where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
//***********************************************************************************************
// 프로젝트관리
//***********************************************************************************************
	case "createProjectCode" :
		echo "PJT-".time();
	break; 

	// 프로젝트 가져오기
	case "getProject" :
		if(!isset($where)) $where = " where 1=1";
		
		if($project_gb == "all") {
			$where .= "";
		} else if($project_gb != "") {
			$where .= " and project_gb='".$project_gb."'";
		}
		
		if($txt != "") {
			if($search_choice == "project_nm") {
				$where .= " and project_nm like '%".$txt."%'";
			} else if($search_choice == "emp_nm") {
				$where .= " and emp_nm like '%".$txt."%'";
			} else if($search_choice == "account_nm") {
				$where .= " and account_nm like '%".$txt."%'";
			}
		}

		$query = "select * from erp_project".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_project".$where." order by uid desc";
		else $query = "select * from erp_project".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
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

	case "deleteSelectProject" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_project where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
	
	case "createLotnoCode" :
		//echo "PJT-".time();
		$sql = "select max(uid) as num from erp_lot_no";
		$t = mysql_fetch_object(mysql_query($sql));

		if(isset($t->num)) {
			echo "0000".($t->num+1);
		}else{
			echo "0000".($t->num+1);
		}
	break; 
		// 설비코드 자동생성
	case "createFacilitiesCode" :
		$return = "PR-".time();
		echo $return;
	break;
	
	// 설비 리스트 가져오기
	case "getFacilities" :

		$where = " where 1=1";
		
		$page = (is_numeric($page)) ? $page : 1; 
		$query = "select * from erp_facilities".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		
		$total_num = mysql_num_rows($result);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;

			$re[$i]['facilities_cd']	= $t->facilities_cd;
			$re[$i]['facilities_nm']	= $t->facilities_nm;
			$re[$i]['facilities_place'] = $t->facilities_place;
			$re[$i]['facilities_group'] = $t->facilities_group;
			$re[$i]['facilities_data']	= $t->facilities_data;
			$re[$i]['process_cd']		= $t->process_cd;
			$re[$i]['process_nm']		= $t->process_nm;
			$re[$i]['maker']			= $t->maker;
			$re[$i]['model_no']			= $t->model_no;
			$re[$i]['facilities_capa']	= $t->facilities_capa;
			if ($t->install_date!=""){
				$re[$i]['install_date']		= substr($t->install_date,0,10);
			}else{
				$re[$i]['install_date']		= "";
			}
			if ($t->discard_date!=""){
				$re[$i]['discard_date']		= substr($t->discard_date,0,10);
			}else{
				$re[$i]['discard_date']		= "";
			}
			$re[$i]['reference']		= $t->reference;
			$re[$i]['purchase_price']	= number_format($t->purchase_price);
			$re[$i]['cost_part']		= number_format($t->cost_part);
			$re[$i]['min_p_amount']		= number_format($t->min_p_amount);
			$re[$i]['facilities_IP']	= $t->facilities_IP;
			$re[$i]['hours_of_operation'] = number_format($t->hours_of_operation);
			$re[$i]['attach']			= $t->hours_of_operation;
			$re[$i]['regdate']			= substr($t->regdate,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;
	
case "inputFacilities" :
		$now = date("Y-m-d H:i:s");
		$fileAttach = uploadFile($attach);

		if($uid != "") {
			$sql = "update erp_facilities set facilities_cd='".$facilities_cd."', facilities_nm='".$facilities_nm."', facilities_place='".$facilities_place."', facilities_group='".$facilities_group."', facilities_data='".$facilities_data."', process_cd='".$process_cd."',process_nm='".$process_nm."', maker='".$maker."', model_no='".$model_no."', facilities_capa='".$facilities_capa."', install_date='".$install_date."', discard_date='".$discard_date."',reference='".$reference."', purchase_price='".replaceComma($purchase_price)."', cost_part='".replaceComma($cost_part)."', min_p_amount='".replaceComma($min_p_amount)."', facilities_IP='".$facilities_IP."', hours_of_operation='".replaceComma($hours_of_operation)."', attach='".$fileAttach."', moddate='".$now."' where uid=".$uid;
		} else {
			$sql = "insert into erp_facilities (facilities_cd,facilities_nm,facilities_place,facilities_group,facilities_data,process_cd,process_nm,maker,model_no,facilities_capa,install_date,discard_date,reference,purchase_price,cost_part,min_p_amount,facilities_IP,hours_of_operation,attach,regdate) values ('".$facilities_cd."','".$facilities_nm."','".$facilities_place."','".$facilities_group."','".$facilities_data."','".$process_cd."','".$process_nm."','".$maker."','".$model_no."','".$facilities_capa."','".$install_date."','".$discard_date."','".$reference."','".replaceComma($purchase_price)."','".replaceComma($cost_part)."','".replaceComma($min_p_amount)."','".$facilities_IP."','".replaceComma($hours_of_operation)."','".$fileAttach."','".$now."')";
		}
		//echo $sql;
		$result = query($sql);
		if($result) echo "success";
	break;

		
	// 설비등록 삭제
	case "deleteSelectFacilities" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_facilities where uid=".$array_uid[$i];
			mysql_query($query);
		}
		echo "success";
	break;

	// 품목코드 자동생성
	case "createDefectCode" :
		$sql = "select max(uid) as num from erp_defect_reason";
		$t = mysql_fetch_object(mysql_query($sql));

		if(isset($t->num)) {
			$return = "100".($t->num+1);
		}else{
			$return = "100".($t->num+1);
		}
		echo $return;
	break;


	// 불량유형 가져오기
	case "getDefectReason":
		
		$where = " where 1=1";
		
		$page = (is_numeric($page)) ? $page : 1; 
		$query = "select * from erp_defect_reason".$where." order by type, uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		
		$total_num = mysql_num_rows($result);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;

			$re[$i]['uid']		= $t->uid;
			$re[$i]['type']		= $t->type;
			if ($t->type=="1"){
				$type_text="수입검사";
			}else if ($t->type=="2"){
				$type_text="공정검사";
			}else if ($t->type=="3"){
				$type_text="출하검사";
			}else{
				$type_text="수입검사";
			}

			$re[$i]['type_text']		= $type_text;
			$re[$i]['defect_cd']	= $t->defect_cd;
			$re[$i]['defect_nm']	= $t->defect_nm;
			$re[$i]['reason']	= $t->reason;
			$i++;
		}

		echo $json->encode($re);
	break;

	// 불량사유 등록
	case "registDefectReason":

		if($uid != "") {
			$sql = "update erp_defect_reason set type='".$type."', defect_cd='".$defect_cd."', defect_nm='".$defect_nm."', reason='".$defect_nm."' where uid=".$uid;
		} else {
			$sql = "insert into erp_defect_reason (type, defect_cd, defect_nm, reason) values ('".$type."','".$defect_cd."','".$defect_nm."','".$defect_nm."')";
		}
		$result = query($sql);
		if($result) echo "success";
	break;

	//--------------------------------------------------------------------------------------------------------------------------- 검사구분관리
	// 검사구분값 가져오기
	case "getQcClassify":
		$sql = "select * from erp_qc_classify order by uid asc";
		$result = query($sql);

		$i = 0;
		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['classify_cd'] = $t->classify_cd;
			$re[$i]['classify_nm'] = $t->classify_nm;
			$i++;
		}

		echo $json->encode($re);
	break;

	// 검사구분값 등록
	case "registQcClassify":
		$now = date("Y-m-d H:i:s");

		$sql = "select max(uid) as muid from erp_qc_classify order by uid asc";
		$result = query($sql);
		$t = @mysql_fetch_object($result);
		if($t->muid==""){
			$muid="1";
		}else{
			$muid= $t->muid;
		}

		$classify_cd = "100".$muid;	
			if($uid != "") {
				$sql = "update erp_qc_classify set classify_nm='".$classify_nm."', regdate='".$now."' where uid=".$uid;
			} else {
				$sql = "insert into erp_qc_classify (classify_cd, classify_nm, regdate) values ('".$classify_cd."','".$classify_nm."','".$now."')";
			}
			$result = query($sql);
			if($result) echo "success";
	break;

		
		// 검사구분값 삭제
	case "deleteSelectQcClassify" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_qc_classify where uid=".$array_uid[$i];
			mysql_query($query);
		}
		echo "success";
	break;

//--------------------------------------------------------------------------------------------------------------------------- 검사항목관리
	// 검사항목 가져오기
	case "getQcItem":
		
		$sql = "select * from erp_qc_item order by uid asc";
		$result = query($sql);
		$i = 0;
		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['qc_nm'] = $t->qc_nm;
			$re[$i]['field_nm'] = $t->field_nm;
			$re[$i]['qc_type'] = $t->qc_type;
			$re[$i]['qc_type_txt'] = $t->qc_type_txt;
			$re[$i]['txt'] = $t->txt;
			$i++;
		}

		echo $json->encode($re);
	break;
	
	// 검사항목 등록
	case "registQcItem":
		if(empty($uid)) {
			$data = array(
				"table" => "erp_qc_item",
				"qc_nm" => $qc_nm,
				"field_nm" => $field_nm,
				"qc_type" => $qc_type,
				"qc_type_txt" => $qc_type_txt,
				"txt" => $txt
			);
			$this->insert($data);
		} else {
			$data = array(
				"table" => "erp_qc_item",
				"where" => "uid=".$uid,
				"qc_nm" => $qc_nm,
				"field_nm" => $field_nm,
				"qc_type" => $qc_type,
				"qc_type_txt" => $qc_type_txt,
				"txt" => $txt
			);
			$this->update($data);
		}
	break;

}
?>