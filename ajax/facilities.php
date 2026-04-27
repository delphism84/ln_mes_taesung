<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	case "getFacilityManagement" :

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_facility_management".$where." order by uid desc";
		else $query = "select * from erp_facility_management".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['facilities_cd'] = $t->facilities_cd;
			$re[$i]['facilities_dt'] = $t->facilities_dt;
			$re[$i]['facilities_cha'] = $t->facilities_cha;
			$re[$i]['day_gubun'] = $t->day_gubun;
			$re[$i]['process_cd'] = $t->process_cd;
			$re[$i]['process_nm'] = $t->process_nm;
			$re[$i]['machine_cd'] = $t->machine_cd;
			$re[$i]['machine_nm'] = $t->machine_nm;
			$re[$i]['f_work_tm'] = $t->f_work_tm;
			$re[$i]['f_off_tm'] = $t->f_off_tm;
			$re[$i]['office_hours'] = $t->office_hours;
			$re[$i]['model_no'] = $t->model_no;
			$re[$i]['problem_gb'] = $t->problem_gb;

			if($t->f_off_type=="1"){
				$f_off_type="계획생산정지";
			}else if($t->f_off_type=="2"){
				$f_off_type="휴식";
			}else if($t->f_off_type=="3"){
				$f_off_type="식사";
			}else if($t->f_off_type=="4"){
				$f_off_type="TPM교육";
			}else if($t->f_off_type=="5"){
				$f_off_type="영업계획차질";
			}else if($t->f_off_type=="6"){
				$f_off_type="자연재해";
			}else if($t->f_off_type=="7"){
				$f_off_type="설비보수";
			}else if($t->f_off_type=="8"){
				$f_off_type="Valve End 청소";
			}else if($t->f_off_type=="9"){
				$f_off_type="샘플진행";
			}else if($t->f_off_type=="10"){
				$f_off_type="모델변경";
			}else if($t->f_off_type=="11"){
				$f_off_type="기계조절시간";
			}else if($t->f_off_type=="12"){
				$f_off_type="고장수리";
			}else if($t->f_off_type=="13"){
				$f_off_type="탕도청소";
			}else if($t->f_off_type=="14"){
				$f_off_type="기타";
			}

			$re[$i]['f_off_type'] = $f_off_type;
			$re[$i]['p_content'] = mb_strimwidth($t->p_content, '0', '10', '..', 'utf-8');
			$re[$i]['a_content'] = mb_strimwidth($t->a_content, '0', '10', '..', 'utf-8');
			$re[$i]['operation_rate'] = $t->operation_rate;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['receipt_dt'] = $t->receipt_dt;
			$re[$i]['handle_dt'] = $t->handle_dt;
			$re[$i]['writer'] = $t->writer;
			$re[$i]['regdate'] = substr($t->shortage,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "FixedAssetsTypetCd" :
		$query = "select MAX(uid) AS cha from erp_fixed_assets_type";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;
		echo sprintf("%05d",$cha);
		
		//$data = 8;
		//echo str_pad($data,"5","0",STR_PAD_LEFT); //str_pad 함수의 경우 "STR_PAD_RIGHT", "STR_PAD_LEFT", "STR_PAD_BOTH"
	break;
	
	case "fixedAssetsCodetCd" :
		$query = "select MAX(uid) AS cha from erp_fixed_assets_code";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;
		echo sprintf("%05d",$cha);
		//$data = 8;
		//echo str_pad($data,"5","0",STR_PAD_LEFT); //str_pad 함수의 경우 "STR_PAD_RIGHT", "STR_PAD_LEFT", "STR_PAD_BOTH"
	break;

	// 고정자산전표 데이터 가져오기
	case "getFixedAssetsStatement" :
		$where = " where 1=1";
		
		if($account_gb == "all") {
			$where .= "";
		} else if($account_gb == "purchase") {
			$where .= " and account_gb='purchase'";
		} else if($account_gb == "sales") {
			$where .= " and account_gb='sales'";
		} else {
			$where .= "";
		}
		
		if($txt != "") {
			if($search_choice == "fac_nm") {
				$where .= " and fac_nm like '%".$txt."%'";
			} else if($search_choice == "asset_ac_nm") {
				$where .= " and asset_ac_nm like '%".$txt."%'";
			}
		}

		$query = "select * from erp_fixed_assets_statement".$where;
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = $rpp;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  

		$query = "select count(*) from erp_fixed_assets_statement".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_fixed_assets_statement".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		//exit;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['statement_dt'] = $t->statement_dt;
			$re[$i]['statement_ca'] = $t->statement_ca;
			$re[$i]['invoiceType'] = $t->invoiceType;
			switch($t->invoiceType){ 
			case "1" :
				$invoiceType ="자산증가";
			break;
			case "2" :
				$invoiceType ="감가상각";
			break;
			case "3" :
				$invoiceType ="상각부인";
			break;
			case "4" :
				$invoiceType ="매각";
			break;
			case "5" :
				$invoiceType ="폐기";
			break;
			default :
				$invoiceType ="자산증가";
			break;
			}
			$re[$i]['invoiceType'] = $invoiceType;
			$re[$i]['fac_cd'] = $t->fac_cd;
			$re[$i]['fac_nm'] = $t->fac_nm;
			$re[$i]['asset_ac_cd'] = $t->asset_ac_cd;
			$re[$i]['asset_ac_nm'] = $t->asset_ac_nm;
			$re[$i]['qty'] = $t->qty;
			$re[$i]['cost'] = $t->cost;
			$re[$i]['disposal_price'] = $t->disposal_price;
			$re[$i]['remark'] = $t->remark;
			$re[$i]['writer'] = $t->writer;
			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
	
	case "getFixedAssetsType" :
		$where = " where 1=1";
		
		if($account_gb == "all") {
			$where .= "";
		} else if($account_gb == "purchase") {
			$where .= " and account_gb='purchase'";
		} else if($account_gb == "sales") {
			$where .= " and account_gb='sales'";
		} else {
			$where .= "";
		}
	
		if($txt != "") {
			if($search_choice == "fat_nm") {
				$where .= " and fat_nm like '%".$txt."%'";
			} else if($search_choice == "asset_ac_nm") {
				$where .= " and asset_ac_nm like '%".$txt."%'";
			}
		}

		$query = "select * from erp_fixed_assets_type".$where;
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = $rpp;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  

		$query = "select count(*) from erp_fixed_assets_type".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_fixed_assets_type".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo "query=".$query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			//$re[$i]['fat_cd'] = $t->fat_cd;
			//$re[$i]['fat_cd'] = sprintf("%05d",$t->fat_cd);
			$re[$i]['fat_cd'] = $t->fat_cd;
			$re[$i]['fat_nm'] = $t->fat_nm;
			$re[$i]['asset_ac_cd'] = $t->asset_ac_cd;
			$re[$i]['asset_ac_nm'] = $t->asset_ac_nm;
			$re[$i]['allowance_depreciation_cd']	= $t->allowance_depreciation_cd;
			$re[$i]['allowance_depreciation_nm']	= $t->allowance_depreciation_nm;
			$re[$i]['depreciation_cost_cd']			= $t->depreciation_cost_cd;
			$re[$i]['depreciation_cost_nm']			= $t->depreciation_cost_nm;
			$re[$i]['service_life']					= $t->service_life;
			$re[$i]['salvage_value']				= $t->salvage_value;
			
			$re[$i]['depreciable_type']				= $t->depreciable_type;
			switch($t->depreciable_type){ 
			case "1" :
				$depreciable_type ="정액법";
			break;
			case "2" :
				$depreciable_type ="정률법";
			break;
			default :
				$depreciable_type ="정액법";
			break;
			}
			$re[$i]['depreciable_type'] = $depreciable_type;

			$re[$i]['service_life_unit']			= $t->service_life_unit;
			switch($t->service_life_unit){ 
			case "1" :
				$service_life_unit ="년";
			break;
			case "2" :
				$service_life_unit ="월";
			break;
			default :
				$service_life_unit ="년";
			break;
			}
			$re[$i]['service_life_unit'] = $service_life_unit;

			$re[$i]['use_yn'] = $t->use_yn;
			switch($t->use_yn){ 
			case "1" :
				$use_yn ="사용";
			break;
			case "0" :
				$use_yn ="중단";
			break;
			default :
				$use_yn ="사용";
			break;
			}
			$re[$i]['use_yn'] = $use_yn;

			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getFixedAssetsCode" :
		$where = " where 1=1";
		
		if($account_gb == "all") {
			$where .= "";
		} else if($account_gb == "purchase") {
			$where .= " and account_gb='purchase'";
		} else if($account_gb == "sales") {
			$where .= " and account_gb='sales'";
		} else {
			$where .= "";
		}
		
		if($txt != "") {
			if($search_choice == "fac_nm") {
				$where .= " and fac_nm like '%".$txt."%'";
			} else if($search_choice == "asset_ac_nm") {
				$where .= " and asset_ac_nm like '%".$txt."%'";
			}
		}

		$query = "select * from erp_fixed_assets_code".$where;
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = $rpp;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  

		$query = "select count(*) from erp_fixed_assets_code".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_fixed_assets_code".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['fac_cd'] = $t->fac_cd;
			$re[$i]['fac_nm'] = $t->fac_nm;
			$re[$i]['department_cd'] = $t->department_cd;
			$re[$i]['department_nm'] = $t->department_nm;
			$re[$i]['fat_cd'] = $t->fat_cd;
			$re[$i]['fat_nm'] = $t->fat_nm;
			$re[$i]['asset_ac_cd'] = $t->asset_ac_cd;
			$re[$i]['asset_ac_nm'] = $t->asset_ac_nm;
			$re[$i]['allowance_depreciation_cd']	= $t->allowance_depreciation_cd;
			$re[$i]['allowance_depreciation_nm']	= $t->allowance_depreciation_nm;
			$re[$i]['depreciation_cost_cd']			= $t->depreciation_cost_cd;
			$re[$i]['depreciation_cost_nm']			= $t->depreciation_cost_nm;
			$re[$i]['service_life']					= $t->service_life;
			$re[$i]['salvage_value']				= $t->salvage_value;
			
			$re[$i]['depreciable_type']				= $t->depreciable_type;
			switch($t->depreciable_type){ 
			case "1" :
				$depreciable_type ="정액법";
			break;
			case "2" :
				$depreciable_type ="정률법";
			break;
			default :
				$depreciable_type ="정액법";
			break;
			}
			$re[$i]['depreciable_type'] = $depreciable_type;

			$re[$i]['service_life_unit']			= $t->service_life_unit;
			switch($t->service_life_unit){ 
			case "1" :
				$service_life_unit ="년";
			break;
			case "2" :
				$service_life_unit ="월";
			break;
			default :
				$service_life_unit ="년";
			break;
			}
			$re[$i]['service_life_unit'] = $service_life_unit;
			
			$re[$i]['status'] = $t->status;
			switch($t->status){ 
			case "1" :
				$status ="보유";
			break;
			case "2" :
				$status ="상각완료";
			break;
			case "3" :
				$status ="매각";
			break;
			case "4" :
				$status ="폐기";
			break;
			default :
				$status ="보유";
			break;
			}
			$re[$i]['status'] = $status;

			$re[$i]['remark'] = $t->remark;

			$re[$i]['use_yn'] = $t->use_yn;
			switch($t->use_yn){ 
			case "1" :
				$use_yn ="사용";
			break;
			case "0" :
				$use_yn ="중단";
			break;
			default :
				$use_yn ="사용";
			break;
			}
			$re[$i]['use_yn'] = $use_yn;

			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
		

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectFixedAssetsStatement" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_fixed_assets_statement where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

		// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectFixedAssetsType" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_fixed_assets_type where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectFixedAssetsCode" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_fixed_assets_code where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	
}
?>