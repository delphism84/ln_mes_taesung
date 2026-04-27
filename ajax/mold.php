<?
session_start();
//금형관리
require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

function insert($data){
	foreach($data as $key => $value){
		if($key == "table") {
			$query = "insert into ".$value." ";
		} else {
			$field .= $key.",";
			if(is_numeric($value) && substr($value, 0, 2) != "00") {
				$prefix = "";
				$suffix = "";
			} else {
				$prefix = "'";
				$suffix = "'";
			}

			$val .= $prefix.$value.$suffix.",";
		}
	}
		
	$query = $query."(".substr($field, 0, -1).") values(".substr($val, 0, -1).")";
	//echo $query."<BR>";
	//exit;
	if(mysql_query($query)) return true;
	else return false;
}

function replaceComma($num) {
	$number = (int)str_replace(",","",$num);
	return $number;
}

switch($mode) {
	
		// 금형그룹코드 자동생성
	case "createMoldCode" :
		$query = "select MAX(uid) AS cha from erp_mold";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;
		echo "1".sprintf("%04d",$cha);
	break;
		
		// 금형그룹코드 자동생성
	case "createMoldGroupCode" :
		$return = "MG-".time();
		echo $return;
	break;

		// 금형그룹 등록
	case "registMoldGroup" :
		$now = date("Y-m-d H:i:s");
		$sql = "insert into erp_mold_group (mold_group_cd, mold_group_nm, regdate) values ('".$mold_group_cd."','".$mold_group_nm."','".$now."')";
		$result = mysql_query($sql);
		if($result) echo "success";
	break;

			// 금형위치코드 자동생성
	case "createMoldLocationCode" :
		$return = "L-".time();
		echo $return;
	break;

		// 금형위치그룹 등록
	case "registMoldLocation" :
		$now = date("Y-m-d H:i:s");
		$sql = "insert into erp_mold_location (mold_location_cd, mold_location_nm, regdate) values ('".$mold_location_cd."','".$mold_location_nm."','".$now."')";
		$result = mysql_query($sql);
		if($result) echo "success";
	break;

			// 금형유형코드 자동생성
	case "createMoldTypeCode" :
		$return = "T-".time();
		echo $return;
	break;

		// 금형유형그룹 등록
	case "registMoldType" :
		$now = date("Y-m-d H:i:s");
		$sql = "insert into erp_mold_type (mold_type_cd, mold_type_nm, regdate) values ('".$mold_type_cd."','".$mold_type_nm."','".$now."')";
		$result = mysql_query($sql);
		if($result) echo "success";
	break;


			// 금형구분코드 자동생성
	case "createMoldDivideCode" :
		$return = "D-".time();
		echo $return;
	break;

		// 금형구분그룹 등록
	case "registMoldDivide" :
		$now = date("Y-m-d H:i:s");
		$sql = "insert into erp_mold_divide (mold_divide_cd, mold_divide_nm, regdate) values ('".$mold_divide_cd."','".$mold_divide_nm."','".$now."')";
		$result = mysql_query($sql);
		if($result) echo "success";
	break;

	// 금형등급코드 자동생성
	case "createMoldClassCode" :
		$return = "C-".time();
		echo $return;
	break;

		// 금형등급그룹 등록
	case "registMoldClass" :
		$now = date("Y-m-d H:i:s");
		$sql = "insert into erp_mold_class (mold_class_cd, mold_class_nm, regdate) values ('".$mold_class_cd."','".$mold_class_nm."','".$now."')";
		$result = mysql_query($sql);
		if($result) echo "success";
	break;

			// 금형상태코드 자동생성
	case "createMoldStateCode" :
		$return = "S-".time();
		echo $return;
	break;

		// 금형상태그룹 등록
	case "registMoldState" :
		$now = date("Y-m-d H:i:s");
		$sql = "insert into erp_mold_state (mold_state_cd, mold_state_nm, regdate) values ('".$mold_state_cd."','".$mold_state_nm."','".$now."')";
		$result = mysql_query($sql);
		if($result) echo "success";
	break;


	case "getMoldList" :

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_mold".$where." order by uid desc";
		else $query = "select * from erp_mold".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['no']				= $no;
			$re[$i]['uid']				= $t->uid;
			$re[$i]['mold_cd']			= $t->mold_cd;
			$re[$i]['mold_nm']			= $t->mold_nm;
			$re[$i]['warehouse_cd']		= $t->warehouse_cd;
			$re[$i]['warehouse_nm']		= $t->warehouse_nm;
			$re[$i]['m_length']			= Round($t->m_length,4);
			$re[$i]['m_length_unit']	= $t->m_length_unit;
			$re[$i]['process_cd']		= $t->process_cd;
			$re[$i]['process_nm']		= $t->process_nm;
			$re[$i]['m_width']			= Round($t->m_width,4);
			$re[$i]['m_width_unit']		= $t->m_width_unit;
			$re[$i]['m_unit']			= $t->m_unit;
			$re[$i]['workings_cd']		= $t->workings_cd;
			$re[$i]['workings_nm']		= $t->workings_nm;
			$re[$i]['m_height']			= Round($t->m_height,4);
			$re[$i]['m_height_unit']	= $t->m_height_unit;
			$re[$i]['m_model']			= $t->m_model;
			$re[$i]['machine_cd']		= $t->machine_cd;
			$re[$i]['machine_nm']		= $t->machine_nm;
			$re[$i]['m_pressure']		= Round($t->m_pressure,4);
			$re[$i]['m_pressure_unit']	= $t->m_pressure_unit;
			$re[$i]['mold_group_cd']	= $t->mold_group_cd;
			$re[$i]['mold_group_nm']	= $t->mold_group_nm;
			$re[$i]['department_cd']	= $t->department_cd;
			$re[$i]['department_nm']	= $t->department_nm;
			$re[$i]['m_weight']			= Round($t->m_weight,4);
			$re[$i]['m_weight_unit']	= $t->m_weight_unit;
			$re[$i]['mold_location_cd']	= $t->mold_location_cd;
			$re[$i]['mold_location_nm']	= $t->mold_location_nm;
			$re[$i]['emp_id']			= $t->emp_id;
			$re[$i]['emp_nm']			= $t->emp_nm;
			$re[$i]['m_material']		= $t->m_material;
			$re[$i]['mold_type_cd']		= $t->mold_type_cd;
			$re[$i]['mold_type_nm']		= $t->mold_type_nm;
			$re[$i]['manager_cd']		= $t->manager_cd;
			$re[$i]['manager_nm']		= $t->manager_nm;
			$re[$i]['CAVITA']			= $t->CAVITA;
			$re[$i]['mold_divide_cd']	= $t->mold_divide_cd;
			$re[$i]['mold_divide_nm']	= $t->mold_divide_nm;
			$re[$i]['m_manage_number']	= $t->m_manage_number;
			$re[$i]['valid_hit_count']	= $t->valid_hit_count;
			$re[$i]['mold_class_cd']	= $t->mold_class_cd;
			$re[$i]['mold_class_nm']	= $t->mold_class_nm;
			$re[$i]['drawing_number']	= $t->drawing_number;
			$re[$i]['conversion_factor']= $t->conversion_factor;
			$re[$i]['mold_state_cd']	= $t->mold_state_cd;
			$re[$i]['mold_state_nm']	= $t->mold_state_nm;
			$re[$i]['use_yn']			= $t->use_yn;
			$re[$i]['p_input_gubun']	= $t->p_input_gubun;
			$re[$i]['remark']			= $t->remark;
			$re[$i]['attach1']			= $t->attach1;
			$re[$i]['attach2']			= $t->attach2;
			$re[$i]['attach3']			= $t->attach3;
			$re[$i]['contract_account_cd'] = $t->contract_account_cd;
			$re[$i]['contract_account_nm'] = $t->contract_account_nm;
			$re[$i]['product_account_cd'] = $t->product_account_cd;
			$re[$i]['product_account_nm'] = $t->product_account_nm;
			$re[$i]['machine_nm']		= $t->machine_nm;
			$re[$i]['owner_account_cd']	= $t->owner_account_cd;
			$re[$i]['owner_account_nm']	= $t->owner_account_nm;
			$re[$i]['contract_dt']		= $t->contract_dt;
			$re[$i]['product_dt']		= $t->product_dt;
			$re[$i]['assets_number']	= $t->assets_number;
			$re[$i]['contract_price']	= number_format($t->contract_price);
			$re[$i]['product_price']	= number_format($t->product_price);
			$re[$i]['durable_years']	= $t->durable_years;
			$re[$i]['contract_life']	= Round($t->contract_life,4);
			$re[$i]['product_life']		= Round($t->product_life,4);
			$re[$i]['scrap_dt']			= $t->scrap_dt;
			$re[$i]['contract_number']	= $t->contract_number;
			$re[$i]['product_number']	= $t->product_number;
			$re[$i]['scrap_number']		= $t->scrap_number;
			$re[$i]['regdate']			= substr($t->regdate,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getMoldData" :

		$query = "select * from erp_mold where uid=".$uid;
		//echo $query;
		$result = mysql_query($query);
		$t = @mysql_fetch_object($result);
			
			$re['uid']				= $t->uid;
			$re['mold_cd']			= $t->mold_cd;
			$re['mold_nm']			= $t->mold_nm;
			$re['warehouse_cd']		= $t->warehouse_cd;
			$re['warehouse_nm']		= $t->warehouse_nm;
			$re['m_length']			= Round($t->m_length,4);
			$re['m_length_unit']	= $t->m_length_unit;
			$re['process_cd']		= $t->process_cd;
			$re['process_nm']		= $t->process_nm;
			$re['m_width']			= Round($t->m_width,4);
			$re['m_width_unit']		= $t->m_width_unit;
			$re['m_unit']			= $t->m_unit;
			$re['workings_cd']		= $t->workings_cd;
			$re['workings_nm']		= $t->workings_nm;
			$re['m_height']			= Round($t->m_height,4);
			$re['m_height_unit']	= $t->m_height_unit;
			$re['m_model']			= $t->m_model;
			$re['machine_cd']		= $t->machine_cd;
			$re['machine_nm']		= $t->machine_nm;
			$re['m_pressure']		= Round($t->m_pressure,4);
			$re['m_pressure_unit']	= $t->m_pressure_unit;
			$re['mold_group_cd']	= $t->mold_group_cd;
			$re['mold_group_nm']	= $t->mold_group_nm;
			$re['department_cd']	= $t->department_cd;
			$re['department_nm']	= $t->department_nm;
			$re['m_weight']			= Round($t->m_weight,4);
			$re['m_weight_unit']	= $t->m_weight_unit;
			$re['mold_location_cd']	= $t->mold_location_cd;
			$re['mold_location_nm']	= $t->mold_location_nm;
			$re['emp_id']			= $t->emp_id;
			$re['emp_nm']			= $t->emp_nm;
			$re['m_material']		= $t->m_material;
			$re['mold_type_cd']		= $t->mold_type_cd;
			$re['mold_type_nm']		= $t->mold_type_nm;
			$re['manager_cd']		= $t->manager_cd;
			$re['manager_nm']		= $t->manager_nm;
			$re['CAVITA']			= $t->CAVITA;
			$re['mold_divide_cd']	= $t->mold_divide_cd;
			$re['mold_divide_nm']	= $t->mold_divide_nm;
			$re['m_manage_number']	= $t->m_manage_number;
			$re['valid_hit_count']	= number_format(Round($t->valid_hit_count));
			$re['mold_class_cd']	= $t->mold_class_cd;
			$re['mold_class_nm']	= $t->mold_class_nm;
			$re['drawing_number']	= $t->drawing_number;
			$re['conversion_factor']= $t->conversion_factor;
			$re['mold_state_cd']	= $t->mold_state_cd;
			$re['mold_state_nm']	= $t->mold_state_nm;
			$re['use_yn']			= $t->use_yn;
			$re['p_input_gubun']	= $t->p_input_gubun;
			$re['remark']			= $t->remark;
			$re['attach1']			= $t->attach1;
			$re['attach2']			= $t->attach2;
			$re['attach3']			= $t->attach3;
			$re['contract_account_cd'] = $t->contract_account_cd;
			$re['contract_account_nm'] = $t->contract_account_nm;
			$re['product_account_cd'] = $t->product_account_cd;
			$re['product_account_nm'] = $t->product_account_nm;
			$re['machine_nm']		= $t->machine_nm;
			$re['owner_account_cd']	= $t->owner_account_cd;
			$re['owner_account_nm']	= $t->owner_account_nm;
			$re['contract_dt']		= $t->contract_dt;
			$re['product_dt']		= $t->product_dt;
			$re['assets_number']	= $t->assets_number;
			$re['contract_price']	= number_format($t->contract_price);
			$re['product_price']	= number_format($t->product_price);
			$re['durable_years']	= $t->durable_years;
			$re['contract_life']	= Round($t->contract_life,4);
			$re['product_life']		= Round($t->product_life,4);
			$re['scrap_dt']			= $t->scrap_dt;
			$re['contract_number']	= $t->contract_number;
			$re['product_number']	= $t->product_number;
			$re['scrap_number']		= $t->scrap_number;
			$re['regdate']			= substr($t->regdate,0,10);

		echo $json->encode($re);
	break;
	

	case "getMoldHitList" :

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_mold".$where." order by uid desc";
		else $query = "select * from erp_mold".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$query = "select SUM(valid_hit_be_count) as be_count from erp_mold_hits where mold_cd='".$t->mold_cd."'";
			//echo $query;
			$ts = mysql_fetch_object(mysql_query($query));
			$valid_hit_be_count = $ts->be_count;

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['no']				= $no;
			$re[$i]['uid']				= $t->uid;
			$re[$i]['mold_cd']			= $t->mold_cd;
			$re[$i]['mold_nm']			= $t->mold_nm;
			$re[$i]['warehouse_cd']		= $t->warehouse_cd;
			$re[$i]['warehouse_nm']		= $t->warehouse_nm;
			$re[$i]['m_length']			= Round($t->m_length,4);
			$re[$i]['m_length_unit']	= $t->m_length_unit;
			$re[$i]['process_cd']		= $t->process_cd;
			$re[$i]['process_nm']		= $t->process_nm;
			$re[$i]['m_width']			= Round($t->m_width,4);
			$re[$i]['m_width_unit']		= $t->m_width_unit;
			$re[$i]['m_unit']			= $t->m_unit;
			$re[$i]['workings_cd']		= $t->workings_cd;
			$re[$i]['workings_nm']		= $t->workings_nm;
			$re[$i]['m_height']			= Round($t->m_height,4);
			$re[$i]['m_height_unit']	= $t->m_height_unit;
			$re[$i]['m_model']			= $t->m_model;
			$re[$i]['machine_cd']		= $t->machine_cd;
			$re[$i]['machine_nm']		= $t->machine_nm;
			$re[$i]['m_pressure']		= Round($t->m_pressure,4);
			$re[$i]['m_pressure_unit']	= $t->m_pressure_unit;
			$re[$i]['mold_group_cd']	= $t->mold_group_cd;
			$re[$i]['mold_group_nm']	= $t->mold_group_nm;
			$re[$i]['department_cd']	= $t->department_cd;
			$re[$i]['department_nm']	= $t->department_nm;
			$re[$i]['m_weight']			= Round($t->m_weight,4);
			$re[$i]['m_weight_unit']	= $t->m_weight_unit;
			$re[$i]['mold_location_cd']	= $t->mold_location_cd;
			$re[$i]['mold_location_nm']	= $t->mold_location_nm;
			$re[$i]['emp_id']			= $t->emp_id;
			$re[$i]['emp_nm']			= $t->emp_nm;
			$re[$i]['m_material']		= $t->m_material;
			$re[$i]['mold_type_cd']		= $t->mold_type_cd;
			$re[$i]['mold_type_nm']		= $t->mold_type_nm;
			$re[$i]['manager_cd']		= $t->manager_cd;
			$re[$i]['manager_nm']		= $t->manager_nm;
			$re[$i]['CAVITA']			= $t->CAVITA;
			$re[$i]['mold_divide_cd']	= $t->mold_divide_cd;
			$re[$i]['mold_divide_nm']	= $t->mold_divide_nm;
			$re[$i]['m_manage_number']	= $t->m_manage_number;
			$re[$i]['valid_hit_count']	= number_format(Round($t->valid_hit_count));
			$re[$i]['mold_class_cd']	= $t->mold_class_cd;
			$re[$i]['mold_class_nm']	= $t->mold_class_nm;
			$re[$i]['drawing_number']	= $t->drawing_number;
			$re[$i]['conversion_factor']= $t->conversion_factor;
			$re[$i]['mold_state_cd']	= $t->mold_state_cd;
			$re[$i]['mold_state_nm']	= $t->mold_state_nm;
			$re[$i]['use_yn']			= $t->use_yn;
			$re[$i]['p_input_gubun']	= $t->p_input_gubun;
			$re[$i]['remark']			= $t->remark;
			$re[$i]['attach1']			= $t->attach1;
			$re[$i]['attach2']			= $t->attach2;
			$re[$i]['attach3']			= $t->attach3;
			$re[$i]['contract_account_cd'] = $t->contract_account_cd;
			$re[$i]['contract_account_nm'] = $t->contract_account_nm;
			$re[$i]['product_account_cd'] = $t->product_account_cd;
			$re[$i]['product_account_nm'] = $t->product_account_nm;
			$re[$i]['machine_nm']		= $t->machine_nm;
			$re[$i]['owner_account_cd']	= $t->owner_account_cd;
			$re[$i]['owner_account_nm']	= $t->owner_account_nm;
			$re[$i]['contract_dt']		= $t->contract_dt;
			$re[$i]['product_dt']		= $t->product_dt;
			$re[$i]['assets_number']	= $t->assets_number;
			$re[$i]['contract_price']	= number_format($t->contract_price);
			$re[$i]['product_price']	= number_format($t->product_price);
			$re[$i]['durable_years']	= $t->durable_years;
			$re[$i]['contract_life']	= Round($t->contract_life,4);
			$re[$i]['product_life']		= Round($t->product_life,4);
			$re[$i]['scrap_dt']			= $t->scrap_dt;
			$re[$i]['contract_number']	= $t->contract_number;
			$re[$i]['product_number']	= $t->product_number;
			$re[$i]['scrap_number']		= $t->scrap_number;
			$re[$i]['regdate']			= substr($t->regdate,0,10);

			
			$re[$i]['valid_hit_be_count']		= number_format(Round($valid_hit_be_count));
			$re[$i]['valid_hit_rest_count']		= number_format(Round($t->valid_hit_count - $valid_hit_be_count));
			$re[$i]['valid_hit_rate']			= Round(($valid_hit_be_count/$t->valid_hit_count) * 100,2);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
	
	//생산실적 데이터 입고
	case "getMoldHitDataList" :
	
		$where =" where mold_cd='".$mcode."'";
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_product_perf_repost".$where." order by uid desc";
		else $query = "select * from erp_product_perf_repost".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['uid']				= $t->uid;
			$re[$i]['production_cd']	= $t->production_cd;
			$re[$i]['production_dt']	= $t->production_dt;
			$re[$i]['process_cd']		= $t->process_cd;
			$re[$i]['process_nm']		= $t->process_nm;
			$re[$i]['machine_uid']		= $t->machine_uid;
			$re[$i]['machine_nm']		= $t->machine_nm;
			$re[$i]['mold_item_cd']		= $t->mold_item_cd;
			$re[$i]['mold_item_nm']		= $t->mold_item_nm;
			$re[$i]['item_cd']			= $t->item_cd;
			$re[$i]['item_nm']			= $t->item_nm;
			$re[$i]['standard1']		= $t->standard1;
			$re[$i]['output_qty']		= number_format($t->output_qty);
			$re[$i]['emp_nm']			= $t->emp_nm;
			$re[$i]['emp_id']			= $t->emp_id;
			$re[$i]['mold_group_nm']	= $t->mold_group_nm;
			$re[$i]['regdate']			= substr($t->regdate,0,10);
			
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getMoldItemHitList" :

		$page = (is_numeric($page)) ? $page : 1; 
		$where =" where mold_cd='".$mcode."'";
		if($rpp == "all") $query = "select * from erp_mold_item".$where." order by uid desc";
		else $query = "select * from erp_mold_item".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$query = "select SUM(valid_item_hit_be_count) as be_count from erp_mold_item_hits where mold_cd=".$t->mold_cd." and item_cd='".$t->item_cd."'";
			//echo $query;
			$ts = mysql_fetch_object(mysql_query($query));
			$valid_item_hit_be_count = $ts->be_count;

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['no']					= $no;
			$re[$i]['uid']					= $t->uid;
			$re[$i]['fid']					= $t->fid;
			$re[$i]['mold_cd']				= $t->mold_cd;
			$re[$i]['item_cd']				= $t->item_cd;
			$re[$i]['item_nm']				= $t->item_nm;
			$re[$i]['standard1']			= $t->standard1;
			$re[$i]['material']				= $t->material;
			$re[$i]['unit']					= $t->unit;
			$re[$i]['cnt']					= $t->cnt;
			$re[$i]['valid_item_hit_cnt']	= number_format($t->valid_item_hit_cnt);
			$re[$i]['valid_item_hit_be_cnt']= number_format($t->valid_item_hit_be_cnt);
			$re[$i]['item_gb']				= $t->item_gb;
			$re[$i]['item_group_cd']		= $t->item_group_cd;
			$re[$i]['item_group_nm']		= $t->item_group_nm;
			$re[$i]['remark']				= $t->remark;
			$re[$i]['lot_nm_cd']			= $t->lot_nm_cd;
			$re[$i]['lot_nm_nm']			= $t->lot_nm_nm;
			$re[$i]['regdate']				= substr($t->regdate,0,10);

			$re[$i]['valid_item_hit_be_count']	= number_format(Round($valid_item_hit_be_count));
			$re[$i]['valid_item_hit_rest_count']= number_format(Round($t->valid_item_hit_cnt - $valid_item_hit_be_count));
			$re[$i]['valid_item_hit_rate']		= Round(($valid_item_hit_be_count/$t->valid_item_hit_cnt) * 100,2);

			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getMoldItemHitDataList" :
	
		$where =" where mold_cd='".$mcode."' and mold_item_cd='".$cd."'";
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_product_perf_repost".$where." order by uid desc";
		else $query = "select * from erp_product_perf_repost".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['uid']				= $t->uid;
			$re[$i]['production_cd']	= $t->production_cd;
			$re[$i]['production_dt']	= $t->production_dt;
			$re[$i]['process_cd']		= $t->process_cd;
			$re[$i]['process_nm']		= $t->process_nm;
			$re[$i]['machine_uid']		= $t->machine_uid;
			$re[$i]['machine_nm']		= $t->machine_nm;
			$re[$i]['mold_item_cd']		= $t->mold_item_cd;
			$re[$i]['mold_item_nm']		= $t->mold_item_nm;
			$re[$i]['item_cd']			= $t->item_cd;
			$re[$i]['item_nm']			= $t->item_nm;
			$re[$i]['standard1']		= $t->standard1;
			$re[$i]['output_qty']		= number_format($t->output_qty);
			$re[$i]['emp_nm']			= $t->emp_nm;
			$re[$i]['emp_id']			= $t->emp_id;
			$re[$i]['mold_group_nm']	= $t->mold_group_nm;
			$re[$i]['regdate']			= substr($t->regdate,0,10);
			
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	//금형 아이템 저장 품목리스트에서 가져와서 일괄 저장하는 방식
	case "insertPageMoldItems" :

		$now = date("Y-m-d H:i:s");
		$m_cd			= $_POST['m_cd'];
		$mold_cd		= $_POST['mold_cd'];
		$item_cd		= $_POST['item_cd'];
		$item_nm		= $_POST['item_nm'];
		$standard1		= $_POST['standard1'];
		$material		= $_POST['material'];
		$unit			= $_POST['unit'];
		$cnt			= $_POST['cnt'];
		$valid_item_hit_cnt = $_POST['valid_item_hit_cnt'];
		$item_gb		= $_POST['item_gb'];
		$item_group_cd	= $_POST['item_group_cd'];
		$item_group_nm	= $_POST['item_group_nm'];
		$remark			= $_POST['remark'];
		$lot_nm_cd		= $_POST['lot_nm_cd'];
		$lot_nm_nm		= $_POST['lot_nm_nm'];
		
		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"			=> "erp_mold_item",
					"fid"			=> $_POST['fid'],
					"mold_cd"		=> $m_cd[$key],
					"item_cd"		=> $val,
					"item_nm"		=> $item_nm[$key],
					"standard1"		=> $standard1[$key],
					"material"		=> $material[$key],
					"unit"			=> $unit[$key],
					"cnt"			=> replaceComma($cnt[$key]),
					"valid_item_hit_cnt" => replaceComma($valid_item_hit_cnt[$key]),
					"item_gb"		=> $item_gb[$key],
					"item_group_cd"	=> $item_group_cd[$key],
					"item_group_nm"	=> $item_group_nm[$key],
					"remark"		=> $remark[$key],
					"regdate"		=> $now
				);
				$result=insert($data);
			}
		}
		echo $result;
		//echo "success";
	break;

	//금형 아이템 저장을 직접 입력 저장하는 방식
	case "insertPageMoldItem" :

		$now = date("Y-m-d H:i:s");
		$m_cd			= $_POST['m_cd'];
		$mold_cd		= $_POST['mold_cd'];
		$item_cd		= $_POST['item_cd'];
		$item_nm		= $_POST['item_nm'];
		$standard1		= $_POST['standard1'];
		$material		= $_POST['material'];
		$unit			= $_POST['unit'];
		$cnt			= $_POST['cnt'];
		$valid_item_hit_cnt = $_POST['valid_item_hit_cnt'];
		$item_gb		= $_POST['item_gb'];
		$item_group_cd	= $_POST['item_group_cd'];
		$item_group_nm	= $_POST['item_group_nm'];
		$remark			= $_POST['remark'];
		$lot_nm_cd		= $_POST['lot_nm_cd'];
		$lot_nm_nm		= $_POST['lot_nm_nm'];
		
		$now = date("Y-m-d H:i:s");
		if($uid != "") {
			$sql = "update erp_mold_item set item_cd='".$item_cd."', item_nm='".$item_nm."', standard1='".$standard1."', material='".$material."', unit='".$unit."', cnt='".$cnt."', valid_item_hit_cnt='".$valid_item_hit_cnt."', item_gb='".$item_gb."', item_group_cd='".$item_group_cd."', item_group_nm='".$item_group_nm."', remark='".$remark."', regdate='".$now."' where uid=".$uid;
		} else {
			$sql = "insert into erp_mold_item (fid, mold_cd, item_cd, item_nm, standard1, material, unit, cnt, valid_item_hit_cnt, item_gb, item_group_cd, item_group_nm, remark, regdate) values ('".$fid."','".$mold_cd."','".$item_cd."','".$item_nm."','".$standard1."','".$material."','".$unit."','".$cnt."','".$valid_item_hit_cnt."','".$item_gb."','".$item_group_cd."','".$item_group_nm."','".$remark."','".$now."')";
		}
		$result = query($sql);
		
		if($result) echo "success";
		
		//echo "success";
	break;

	//금형부품 리스트
	case "getMoldItemList" :

		$page = (is_numeric($page)) ? $page : 1; 
		$where = " where fid='".$uid."'";
		if($rpp == "all") $query = "select * from erp_mold_item".$where." order by uid desc";
		else $query = "select * from erp_mold_item".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num']		= $total_num;

			$re[$i]['uid']				= $t->uid;
			$re[$i]['mold_cd']			= $t->mold_cd;
			$re[$i]['fid']				= $t->fid;
			$re[$i]['item_cd']			= $t->item_cd;
			$re[$i]['item_nm']			= $t->item_nm;
			$re[$i]['standard1']		= $t->standard1;
			$re[$i]['material']			= $t->material;
			$re[$i]['unit']				= $t->unit;
			$re[$i]['cnt']				= number_format($t->cnt);
			$re[$i]['valid_item_hit_cnt'] = number_format($t->valid_item_hit_cnt);
			
			/*
			if(getItemClassificationName($t->item_gb)=="" || getItemClassificationName($t->item_gb)=="null"){
				$item_gb="";
			}else{
				$item_gb=getItemClassificationName($t->item_gb);
			}
			
			$re[$i]['item_gb']			= $item_gb;
			*/
			$re[$i]['item_gb']			= $t->item_gb;
			$re[$i]['item_group_cd']	= $t->item_group_cd;
			$re[$i]['item_group_nm']	= $t->item_group_nm;
			$re[$i]['remark']			= $t->remark;
			$re[$i]['lot_nm_cd']		= $t->lot_nm_cd;
			$re[$i]['lot_nm_nm']		= $t->lot_nm_nm;
			$re[$i]['regdate']			= substr($t->regdate,0,10);
			
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	//금형파일 리스트
	case "getMoldFileList" :

		$page = (is_numeric($page)) ? $page : 1; 
		$where = " where fid='".$uid."'";
		if($rpp == "all") $query = "select * from erp_mold_files".$where." order by uid desc";
		else $query = "select * from erp_mold_files".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num']		= $total_num;

			$re[$i]['uid']				= $t->uid;
			$re[$i]['file_gb']			= $t->file_gb;
			$re[$i]['fid']				= $t->fid;
			$re[$i]['file_cd']			= $t->file_cd;
			
			if(!empty($t->file_nm) && $t->file_nm != "none"){ 
			$re[$i]['image'] = "attach/mold/".$t->file_nm;
			}else{								
			$re[$i]['image'] = "assets/images/images.png";
			}

			$re[$i]['file_nm']			= $t->file_nm;
			$re[$i]['real_file_nm']		= $t->real_file_nm;
			$re[$i]['etc']				= $t->etc;
			$re[$i]['regdate']			= substr($t->regdate,0,10);
			
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "deleteSelectMold" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_mold where uid=".$array_uid[$i];
			mysql_query($query);
		}
		echo "success";
	break;
	
			
	case "deleteSelectMoldItem" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_mold_item where uid=".$array_uid[$i];
			mysql_query($query);
		}
		echo "success";
	break;


	case "deleteSelectMoldFile" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "select file_nm from erp_mold_files where uid=".$array_uid[$i];
			//echo $query;
			$t = mysql_fetch_object(mysql_query($query));
			$file_nm = $t->file_nm;

			$query = "delete from erp_mold_files where uid=".$array_uid[$i];
			//echo $query; 
			$result=mysql_query($query);

			if ($result){
				
				//$filename = $_SERVER["DOCUMENT_ROOT"]. "attach/mold/".$file_nm;
				//if(file_exists($filename){
					$filepath = "../attach/mold/".$file_nm;
						if(is_file($filepath)) {
						unlink($filapath);
						}
				//}
			}
			unset($file_nm);
			unset($filename);
		}
		echo "success";
	break;
	
	case "insertFileGb" :
		$query = "update erp_mold_files set file_gb='".$file_gb."' where uid=".$uid;
		mysql_query($query);
		echo "success";
	break;


	case "getMoldRepairList" :
	
		$where =" where mold_cd='".$mcode."'";
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_mold_repair".$where." order by uid desc";
		else $query = "select * from erp_mold_repair".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num']		= $total_num;

			$re[$i]['uid']					= $t->uid;
			$re[$i]['mold_cd']				= $t->mold_cd;
			$re[$i]['mold_nm']				= $t->mold_nm;
			$re[$i]['mold_repair_cd']		= $t->mold_repair_cd;
			$re[$i]['mold_repair_dt']		= $t->mold_repair_dt;
			$re[$i]['mold_repair_cha']		= $t->mold_repair_cha;
			$re[$i]['deadline_dt']			= $t->deadline_dt;
			$re[$i]['start_dt']				= $t->start_dt;
			$re[$i]['end_dt']				= $t->end_dt;

			if($t->repair_type=="0"){
				$repair_type="부품파손/마모";
			}else if($t->repair_type=="1"){
				$repair_type="도금/열처리";
			}else if($t->repair_type=="2"){
				$repair_type="볼트/너트풀림";
			}else if($t->repair_type=="3"){
				$repair_type="표면불량";
			}else if($t->repair_type=="4"){
				$repair_type="강도저하";
			}else if($t->repair_type=="5"){
				$repair_type="탄화현상";
			}else if($t->repair_type=="6"){
				$repair_type="물성저하";
			}else if($t->repair_type=="7"){
				$repair_type="스크랩";
			}else if($t->repair_type=="8"){
				$repair_type="부품교체";
			}else if($t->repair_type=="9"){
				$repair_type="세척";
			}else{
				$repair_type="부품파손/마모";
			}

			$re[$i]['repair_type']			= $repair_type;
			$re[$i]['repair_time']			= $t->repair_time;

			if($t->defect_gb=="1"){
				$defect_gb="치수상결함";
			}else if($t->defect_gb=="2"){
				$defect_gb="외관상결함";
			}else if($t->defect_gb=="3"){
				$defect_gb="내부결함";
			}else if($t->defect_gb=="4"){
				$defect_gb="재질상결함";
			}else if($t->defect_gb=="5"){
				$defect_gb="기타결함";
			}else{
				$defect_gb="치수상결함";
			}

			$re[$i]['defect_gb']			= $defect_gb;
			$re[$i]['defect_content']		= $t->defect_content;

			if($t->repair_gb=="1"){
				$repair_gb="유지보수";
			}else if($t->repair_gb=="2"){
				$repair_gb="정기점검";
			}else if($t->repair_gb=="3"){
				$repair_gb="스페어파트";
			}else{
				$repair_gb="유지보수";
			}

			$re[$i]['repair_gb']			= $repair_gb;
			$re[$i]['repair_content']		= $t->repair_content;
			$re[$i]['warehouse_cd']			= $t->warehouse_cd;
			$re[$i]['warehouse_nm']			= $t->warehouse_nm;
			$re[$i]['process_cd']			= $t->process_cd;
			$re[$i]['process_nm']			= $t->process_nm;
			$re[$i]['workshop_cd']			= $t->workshop_cd;
			$re[$i]['workshop_nm']			= $t->workshop_nm;
			$re[$i]['account_cd']			= $t->account_cd;
			$re[$i]['account_nm']			= $t->account_nm;
			$re[$i]['department_cd']		= $t->department_cd;
			$re[$i]['department_nm']		= $t->department_nm;
			$re[$i]['manager_id']			= $t->manager_id;
			$re[$i]['manager_nm']			= $t->manager_nm;
			$re[$i]['emp_id']				= $t->emp_id;
			$re[$i]['emp_nm']				= $t->emp_nm;
			$re[$i]['repair_price']			= $t->repair_price;
			$re[$i]['memo']					= $t->memo;

			if($t->state=="0"){
				$state="수리접수중";
			}else if($t->state=="1"){
				$state="수리중";
			}else if($t->state=="2"){
				$state="수리완료";
			}else if($t->state=="3"){
				$state="수리보류";
			}else if($t->state=="4"){
				$state="수리취소";
			}else{
				$state="유지보수";
			}
			
			$re[$i]['state']				= $state;
			$re[$i]['cntTotal']				= $t->cntTotal;
			$re[$i]['attach']				= $t->attach;
			$re[$i]['regdate']				= substr($t->regdate,0,10);
			
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	//금형부품 리스트
	case "getMoldRepairItemList" :

		$page = (is_numeric($page)) ? $page : 1; 
		$where = " where fid='".$uid."'";
		if($rpp == "all") $query = "select * from erp_mold_repair_item".$where." order by uid";
		else $query = "select * from erp_mold_repair_item".$where." order by uid limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num']		= $total_num;
			$re[$i]['uid']				= $t->uid;
			$re[$i]['mold_repair_cd']	= $t->mold_repair_cd;
			$re[$i]['fid']				= $t->fid;
			$re[$i]['item_cd']			= $t->item_cd;
			$re[$i]['item_nm']			= $t->item_nm;
			$re[$i]['standard1']		= $t->standard1;
			$re[$i]['material']			= $t->material;
			$re[$i]['unit']				= $t->unit;
			$re[$i]['cnt']				= $t->cnt;
			$re[$i]['item_gb']			= $t->item_gb;
			$re[$i]['remark']			= $t->remark;
			$re[$i]['lot_nm_cd']		= $t->lot_nm_cd;
			$re[$i]['lot_nm_nm']		= $t->lot_nm_nm;
			$re[$i]['regdate']			= substr($t->regdate,0,10);
			
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

		//금형 위치 정보 리스트
	case "getMoldLocationList" :
		//$where = " where fid='".$uid."'";
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_mold_location".$where." order by uid";
		else $query = "select * from erp_mold_location".$where." order by uid limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num']		= $total_num;
			$re[$i]['uid']				= $t->uid;
			$re[$i]['mold_location_cd']	= $t->mold_location_cd;
			$re[$i]['mold_location_nm']	= $t->mold_location_nm;
			$re[$i]['remark']			= $t->remark;

			if ($t->use_yn=="Y"){
				$use_yn = "사용";
			}else{
				$use_yn = "미사용";
			}
			$re[$i]['use_yn']			= $use_yn;
			$re[$i]['regdate']			= substr($t->regdate,0,10);
			
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

		// 창고 등록
	case "insertPageMoldLocation" :
		$now = date("Y-m-d H:i:s");
		if($uid != "") {
			$sql = "update erp_mold_location set mold_location_cd='".$mold_location_cd."', mold_location_nm='".$mold_location_nm."', remark='".$remark."', use_yn='".$use_yn."', regdate='".$now."' where uid=".$uid;
		} else {
			$sql = "insert into erp_mold_location (mold_location_cd, mold_location_nm, remark, use_yn, regdate) values ('".$mold_location_cd."','".$mold_location_nm."','".$remark."','".$use_yn."','".$now."')";
		}
		$result = query($sql);
		if($result) echo "success";
	break;

	case "getMoldMoveList" :

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_mold_movement".$where." order by uid desc";
		else $query = "select * from erp_mold_movement".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['no']				= $no;
			$re[$i]['uid']				= $t->uid;
			$re[$i]['mold_cd']			= $t->mold_cd;
			$re[$i]['mold_nm']			= $t->mold_nm;
			$re[$i]['mold_move_dt']		= $t->mold_move_dt;
		}

		echo $json->encode($re);
	break;


	case "getMoldMoveData" :

		$query = "select * from erp_mold_movement where uid=".$uid;
		//echo $query;
		$result = mysql_query($query);
		$t = @mysql_fetch_object($result);
			
			$re['uid']				= $t->uid;
			$re['mold_cd']			= $t->mold_cd;
			$re['mold_nm']			= $t->mold_nm;
			$re['mold_move_dt']		= $t->mold_move_dt;
			$re['mold_move_cd']		= $t->mold_move_cd;
			$re['department_cd']	= $t->department_cd;
			$re['department_nm']	= $t->department_nm;
			$re['manager_cd']		= $t->manager_cd;
			$re['manager_nm']		= $t->manager_nm;
			$re['move_reason']		= $t->move_reason;
			$re['remark']			= $t->remark;
			$re['apply_yn']			= $t->apply_yn;
			$re['b_machine_cd']		= $t->b_machine_cd;
			$re['b_machine_nm']		= $t->b_machine_nm;
			$re['b_mold_location_cd']= $t->b_mold_location_cd;
			$re['b_mold_location_nm']= $t->b_mold_location_nm;
			$re['b_manager_cd']		= $t->b_manager_cd;
			$re['b_manager_nm']		= $t->b_manager_nm;
			$re['b_manager_hp']		= $t->b_manager_hp;
			$re['machine_cd']		= $t->machine_cd;
			$re['machine_nm']		= $t->machine_nm;
			$re['mold_location_cd']	= $t->mold_location_cd;
			$re['mold_location_nm']	= $t->mold_location_nm;
			$re['a_manager_cd']		= $t->a_manager_cd;
			$re['a_manager_nm']		= $t->a_manager_nm;
			$re['a_manager_hp']		= $t->a_manager_hp;
			$re['regdate']			= substr($t->regdate,0,10);

		echo $json->encode($re);
	break;
	
	case "deleteSelectMoldMove" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_mold_movement where uid=".$array_uid[$i];
			mysql_query($query);
		}
		echo "success";
	break;
}
?>