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
			$re[$i]['regdate']			= substr($t->shortage,0,10);
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
			$re['valid_hit_count']	= $t->valid_hit_count;
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
			$re['regdate']			= substr($t->shortage,0,10);

		echo $json->encode($re);
	break;





	case "insertPageMoldItem" :
		//$array_uid = explode(",",$uids);
		//for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
		//	$query = "delete from mold where uid=".$array_uid[$i];
		//	mysql_query($query);
		//}/
		//echo "success";

		$now = date("Y-m-d H:i:s");

		$mold_cd		= $_POST['mold_cd'];
		$item_cd		= $_POST['item_cd'];
		$item_nm		= $_POST['item_nm'];
		$standard1		= $_POST['standard1'];
		$material		= $_POST['material'];
		$unit			= $_POST['unit'];
		$cnt			= $_POST['cnt'];
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
					"mold_cd"		=> $mold_cd[$key],
					"item_cd"		=> $val,
					"item_nm"		=> $item_nm[$key],
					"standard1"		=> $standard1[$key],
					"material"		=> $material[$key],
					"unit"			=> $unit[$key],
					"cnt"			=> replaceComma($cnt[$key]),
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

	//금형부품 리스트
	case "getMoldItemList" :

		$page = (is_numeric($page)) ? $page : 1; 
		$where = " where fid='".$uid."'";
		if($rpp == "all") $query = "select * from erp_mold_item".$where." order by uid desc";
		else $query = "select * from erp_mold_item".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
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
			$re[$i]['cnt']				= $t->cnt;

			if(getItemClassificationName($t->item_gb)=="" || getItemClassificationName($t->item_gb)=="null"){
				$item_gb="";
			}else{
				$item_gb=getItemClassificationName($t->item_gb);
			}
			
			$re[$i]['item_gb']			= $item_gb;

			$re[$i]['item_group_cd']	= $t->item_group_cd;
			$re[$i]['item_group_nm']	= $t->item_group_nm;
			$re[$i]['remark']			= $t->remark;
			$re[$i]['lot_nm_cd']		= $t->lot_nm_cd;
			$re[$i]['lot_nm_nm']		= $t->lot_nm_nm;
			$re[$i]['regdate']			= substr($t->shortage,0,10);
			
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
			$re[$i]['regdate']			= substr($t->shortage,0,10);
			
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