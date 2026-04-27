<?
class OverrideController extends ErpController {








	//--------------------------------------------------
	//-------------------------금형----------------------
	//---------------------------------------------------

	public function registPageMold(){
		require_once ('views/client/mold/createMold.php');
	}

	public function listPageMoldRepair(){
		require_once ('views/client/mold/listMoldRepair.php');
	}

	public function registPageMoldHits(){
		require_once ('views/client/mold/createMoldHits.php');
	}

	

	// 금형등록 리스트
	public function listPageMold(){
		require_once ('views/mold/listMold.php');
	}

	// 금형등록 리스트
	public function iframePageMold(){
		require_once ('views/mold/listMold_frame.php');
	}
	
	// 금형등록 리스트
	public function viewPageMold(){
		require_once ('views/mold/viewMold.php');
	}

	

	//금형 정보 수정
	public function modifyPageMold() {
		$t = mold::getMolds($_GET['uid']);
		require_once('views/mold/createMold.php');
	}

	public function insertPageMold(){
		$now = date("Y-m-d H:i:s");
		$fileAttach1 = $this->upload('attach1');
		$fileAttach2 = $this->upload('attach2');
		$fileAttach3 = $this->upload('attach3');

		$data = array(
			"table"				=> "erp_mold",
			"mold_cd"			=> $_POST['mold_cd'],
			"mold_nm"			=> $_POST['mold_nm'],
			"warehouse_cd"		=> $_POST['warehouse_cd'],
			"warehouse_nm"		=> $_POST['warehouse_nm'],
			"m_length"			=> $this->replaceComma($_POST['m_length']),
			"m_length_unit"		=> $_POST['m_length_unit'],
			"process_cd"		=> $_POST['process_cd'],
			"process_nm"		=> $_POST['process_nm'],
			"m_width"			=> $this->replaceComma($_POST['m_width']),
			"m_width_unit"		=> $_POST['m_width_unit'],
			"m_unit"			=> $_POST['m_unit'],
			"workings_cd"		=> $_POST['workings_cd'],
			"workings_nm"		=> $_POST['workings_nm'],
			"m_height"			=> $this->replaceComma($_POST['m_height']),
			"m_height_unit"		=> $_POST['m_height_unit'],
			"m_model"			=> $_POST['m_model'],
			"machine_cd"		=> $_POST['machine_cd'],
			"machine_nm"		=> $_POST['machine_nm'],
			"m_pressure"		=> $this->replaceComma($_POST['m_pressure']),
			"m_pressure_unit"	=> $_POST['m_pressure_unit'],
			"mold_group_cd"		=> $_POST['mold_group_cd'],
			"mold_group_nm"		=> $_POST['mold_group_nm'],
			"department_cd"		=> $_POST['department_cd'],
			"department_nm"		=> $_POST['department_nm'],
			"m_weight"			=> $this->replaceComma($_POST['m_weight']),
			"m_weight_unit"		=> $_POST['m_weight_unit'],
			"mold_location_cd"	=> $_POST['mold_location_cd'],
			"mold_location_nm"	=> $_POST['mold_location_nm'],
			"emp_id"			=> $_POST['emp_id'],
			"emp_nm"			=> $_POST['emp_nm'],
			"m_material"		=> $_POST['m_material'],
			"mold_type_cd"		=> $_POST['mold_type_cd'],
			"mold_type_nm"		=> $_POST['mold_type_nm'],
			"manager_cd"		=> $_POST['manager_cd'],
			"manager_nm"		=> $_POST['manager_nm'],
			"CAVITA"			=> $this->replaceComma($_POST['CAVITA']),
			"mold_divide_cd"	=> $_POST['mold_divide_cd'],
			"mold_divide_nm"	=> $_POST['mold_divide_nm'],
			"m_manage_number"	=> $_POST['m_manage_number'],
			"valid_hit_count"	=> $this->replaceComma($_POST['valid_hit_count']),
			"mold_class_cd"		=> $_POST['mold_class_cd'],
			"mold_class_nm"		=> $_POST['mold_class_nm'],
			"drawing_number"	=> $_POST['drawing_number'],
			"conversion_factor"	=> $this->replaceComma($_POST['conversion_factor']),
			"mold_state_cd"		=> $_POST['mold_state_cd'],
			"mold_state_nm"		=> $_POST['mold_state_nm'],
			"use_yn"			=> $_POST['use_yn'],
			"p_input_gubun"		=> $_POST['p_input_gubun'],
			"remark"			=> $_POST['remark'],
			"attach1"			=> $_POST['attach1'],
			"attach2"			=> $_POST['attach2'],
			"attach3"			=> $_POST['attach3'],
			"contract_account_cd"	=> $_POST['contract_account_cd'],
			"contract_account_nm"	=> $_POST['contract_account_nm'],
			"product_account_cd"	=> $_POST['product_account_cd'],
			"product_account_nm"	=> $_POST['product_account_nm'],
			"machine_nm"			=> $_POST['machine_nm'],
			"owner_account_cd"		=> $_POST['owner_account_cd'],
			"owner_account_nm"		=> $_POST['owner_account_nm'],
			"contract_dt"			=> $_POST['contract_dt'],
			"product_dt"			=> $_POST['product_dt'],
			"assets_number"			=> $_POST['assets_number'],
			"contract_price"		=> $this->replaceComma($_POST['contract_price']),
			"product_price"			=> $this->replaceComma($_POST['product_price']),
			"durable_years"			=> $_POST['durable_years'],
			"contract_life"			=> $this->replaceComma($_POST['contract_life']),
			"product_life"			=> $this->replaceComma($_POST['product_life']),
			"scrap_dt"				=> $_POST['scrap_dt'],
			"contract_number"		=> $_POST['contract_number'],
			"product_number"		=> $_POST['product_number'],
			"scrap_number"			=> $_POST['scrap_number'],
			"regdate"				=> $now
		);
		
		$Mold = new Mold;
		$fid = $Mold->insertMold($data);
		
		$data = array(
			"table"				=> "erp_mold_record",
			"fid"				=> $fid,
			"mold_cd"			=> $_POST['mold_cd'],
			"mold_nm"			=> $_POST['mold_nm'],
			"warehouse_cd"		=> $_POST['warehouse_cd'],
			"warehouse_nm"		=> $_POST['warehouse_nm'],
			"m_length"			=> $this->replaceComma($_POST['m_length']),
			"m_length_unit"		=> $_POST['m_length_unit'],
			"process_cd"		=> $_POST['process_cd'],
			"process_nm"		=> $_POST['process_nm'],
			"m_width"			=> $this->replaceComma($_POST['m_width']),
			"m_width_unit"		=> $_POST['m_width_unit'],
			"m_unit"			=> $_POST['m_unit'],
			"workings_cd"		=> $_POST['workings_cd'],
			"workings_nm"		=> $_POST['workings_nm'],
			"m_height"			=> $this->replaceComma($_POST['m_height']),
			"m_height_unit"		=> $_POST['m_height_unit'],
			"m_model"			=> $_POST['m_model'],
			"machine_cd"		=> $_POST['machine_cd'],
			"machine_nm"		=> $_POST['machine_nm'],
			"m_pressure"		=> $this->replaceComma($_POST['m_pressure']),
			"m_pressure_unit"	=> $_POST['m_pressure_unit'],
			"mold_group_cd"		=> $_POST['mold_group_cd'],
			"mold_group_nm"		=> $_POST['mold_group_nm'],
			"department_cd"		=> $_POST['department_cd'],
			"department_nm"		=> $_POST['department_nm'],
			"m_weight"			=> $this->replaceComma($_POST['m_weight']),
			"m_weight_unit"		=> $_POST['m_weight_unit'],
			"mold_location_cd"	=> $_POST['mold_location_cd'],
			"mold_location_nm"	=> $_POST['mold_location_nm'],
			"emp_id"			=> $_POST['emp_id'],
			"emp_nm"			=> $_POST['emp_nm'],
			"m_material"		=> $_POST['m_material'],
			"mold_type_cd"		=> $_POST['mold_type_cd'],
			"mold_type_nm"		=> $_POST['mold_type_nm'],
			"manager_cd"		=> $_POST['manager_cd'],
			"manager_nm"		=> $_POST['manager_nm'],
			"CAVITA"			=> $this->replaceComma($_POST['CAVITA']),
			"mold_divide_cd"	=> $_POST['mold_divide_cd'],
			"mold_divide_nm"	=> $_POST['mold_divide_nm'],
			"m_manage_number"	=> $_POST['m_manage_number'],
			"valid_hit_count"	=> $this->replaceComma($_POST['valid_hit_count']),
			"mold_class_cd"		=> $_POST['mold_class_cd'],
			"mold_class_nm"		=> $_POST['mold_class_nm'],
			"drawing_number"	=> $_POST['drawing_number'],
			"conversion_factor"	=> $this->replaceComma($_POST['conversion_factor']),
			"mold_state_cd"		=> $_POST['mold_state_cd'],
			"mold_state_nm"		=> $_POST['mold_state_nm'],
			"use_yn"			=> $_POST['use_yn'],
			"p_input_gubun"		=> $_POST['p_input_gubun'],
			"remark"			=> $_POST['remark'],
			"attach1"			=> $_POST['attach1'],
			"attach2"			=> $_POST['attach2'],
			"attach3"			=> $_POST['attach3'],
			"contract_account_cd"	=> $_POST['contract_account_cd'],
			"contract_account_nm"	=> $_POST['contract_account_nm'],
			"product_account_cd"	=> $_POST['product_account_cd'],
			"product_account_nm"	=> $_POST['product_account_nm'],
			"machine_nm"			=> $_POST['machine_nm'],
			"owner_account_cd"		=> $_POST['owner_account_cd'],
			"owner_account_nm"		=> $_POST['owner_account_nm'],
			"contract_dt"			=> $_POST['contract_dt'],
			"product_dt"			=> $_POST['product_dt'],
			"assets_number"			=> $_POST['assets_number'],
			"contract_price"		=> $this->replaceComma($_POST['contract_price']),
			"product_price"			=> $this->replaceComma($_POST['product_price']),
			"durable_years"			=> $_POST['durable_years'],
			"contract_life"			=> $this->replaceComma($_POST['contract_life']),
			"product_life"			=> $this->replaceComma($_POST['product_life']),
			"scrap_dt"				=> $_POST['scrap_dt'],
			"contract_number"		=> $_POST['contract_number'],
			"product_number"		=> $_POST['product_number'],
			"scrap_number"			=> $_POST['scrap_number'],
			"regdate"				=> $now
		);
		
		$result = $Mold->insert($data);

		$this->movePage("mold","registPageMold");

	}

	public function updatePageMold(){
		$now = date("Y-m-d H:i:s");
		$fileAttach1 = $this->upload('attach1');
		$fileAttach2 = $this->upload('attach2');
		$fileAttach3 = $this->upload('attach3');


		$data = array(
			"table"				=> "erp_mold",
			"where"				=> "uid=".$_POST['uid'],
			"mold_nm"			=> $_POST['mold_nm'],
			"warehouse_cd"		=> $_POST['warehouse_cd'],
			"warehouse_nm"		=> $_POST['warehouse_nm'],
			"m_length"			=> $this->replaceComma($_POST['m_length']),
			"m_length_unit"		=> $_POST['m_length_unit'],
			"process_cd"		=> $_POST['process_cd'],
			"process_nm"		=> $_POST['process_nm'],
			"m_width"			=> $this->replaceComma($_POST['m_width']),
			"m_width_unit"		=> $_POST['m_width_unit'],
			"m_unit"			=> $_POST['m_unit'],
			"workings_cd"		=> $_POST['workings_cd'],
			"workings_nm"		=> $_POST['workings_nm'],
			"m_height"			=> $this->replaceComma($_POST['m_height']),
			"m_height_unit"		=> $_POST['m_height_unit'],
			"m_model"			=> $_POST['m_model'],
			"machine_cd"		=> $_POST['machine_cd'],
			"machine_nm"		=> $_POST['machine_nm'],
			"m_pressure"		=> $this->replaceComma($_POST['m_pressure']),
			"m_pressure_unit"	=> $_POST['m_pressure_unit'],
			"mold_group_cd"		=> $_POST['mold_group_cd'],
			"mold_group_nm"		=> $_POST['mold_group_nm'],
			"department_cd"		=> $_POST['department_cd'],
			"department_nm"		=> $_POST['department_nm'],
			"m_weight"			=> $this->replaceComma($_POST['m_weight']),
			"m_weight_unit"		=> $_POST['m_weight_unit'],
			"mold_location_cd"	=> $_POST['mold_location_cd'],
			"mold_location_nm"	=> $_POST['mold_location_nm'],
			"emp_id"			=> $_POST['emp_id'],
			"emp_nm"			=> $_POST['emp_nm'],
			"m_material"		=> $_POST['m_material'],
			"mold_type_cd"		=> $_POST['mold_type_cd'],
			"mold_type_nm"		=> $_POST['mold_type_nm'],
			"manager_cd"		=> $_POST['manager_cd'],
			"manager_nm"		=> $_POST['manager_nm'],
			"CAVITA"			=> $this->replaceComma($_POST['CAVITA']),
			"mold_divide_cd"	=> $_POST['mold_divide_cd'],
			"mold_divide_nm"	=> $_POST['mold_divide_nm'],
			"m_manage_number"	=> $_POST['m_manage_number'],
			"valid_hit_count"	=> $this->replaceComma($_POST['valid_hit_count']),
			"mold_class_cd"		=> $_POST['mold_class_cd'],
			"mold_class_nm"		=> $_POST['mold_class_nm'],
			"drawing_number"	=> $_POST['drawing_number'],
			"conversion_factor"	=> $this->replaceComma($_POST['conversion_factor']),
			"mold_state_cd"		=> $_POST['mold_state_cd'],
			"mold_state_nm"		=> $_POST['mold_state_nm'],
			"use_yn"			=> $_POST['use_yn'],
			"p_input_gubun"		=> $_POST['p_input_gubun'],
			"remark"			=> $_POST['remark'],
			"attach1"			=> $_POST['attach1'],
			"attach2"			=> $_POST['attach2'],
			"attach3"			=> $_POST['attach3'],
			"contract_account_cd"	=> $_POST['contract_account_cd'],
			"contract_account_nm"	=> $_POST['contract_account_nm'],
			"product_account_cd"	=> $_POST['product_account_cd'],
			"product_account_nm"	=> $_POST['product_account_nm'],
			"machine_nm"			=> $_POST['machine_nm'],
			"owner_account_cd"		=> $_POST['owner_account_cd'],
			"owner_account_nm"		=> $_POST['owner_account_nm'],
			"contract_dt"			=> $_POST['contract_dt'],
			"product_dt"			=> $_POST['product_dt'],
			"assets_number"			=> $_POST['assets_number'],
			"contract_price"		=> $this->replaceComma($_POST['contract_price']),
			"product_price"			=> $this->replaceComma($_POST['product_price']),
			"durable_years"			=> $_POST['durable_years'],
			"contract_life"			=> $this->replaceComma($_POST['contract_life']),
			"product_life"			=> $this->replaceComma($_POST['product_life']),
			"scrap_dt"				=> $_POST['scrap_dt'],
			"contract_number"		=> $_POST['contract_number'],
			"product_number"		=> $_POST['product_number'],
			"scrap_number"			=> $_POST['scrap_number'],
			"editdate"				=> $now
		);

		$Mold = new Mold;
		$result = $Mold->update($data);

		$data = array(
			"table"				=> "erp_mold_record",
			"fid"				=> $_POST['uid'],
			"mold_nm"			=> $_POST['mold_nm'],
			"warehouse_cd"		=> $_POST['warehouse_cd'],
			"warehouse_nm"		=> $_POST['warehouse_nm'],
			"m_length"			=> $this->replaceComma($_POST['m_length']),
			"m_length_unit"		=> $_POST['m_length_unit'],
			"process_cd"		=> $_POST['process_cd'],
			"process_nm"		=> $_POST['process_nm'],
			"m_width"			=> $this->replaceComma($_POST['m_width']),
			"m_width_unit"		=> $_POST['m_width_unit'],
			"m_unit"			=> $_POST['m_unit'],
			"workings_cd"		=> $_POST['workings_cd'],
			"workings_nm"		=> $_POST['workings_nm'],
			"m_height"			=> $this->replaceComma($_POST['m_height']),
			"m_height_unit"		=> $_POST['m_height_unit'],
			"m_model"			=> $_POST['m_model'],
			"machine_cd"		=> $_POST['machine_cd'],
			"machine_nm"		=> $_POST['machine_nm'],
			"m_pressure"		=> $this->replaceComma($_POST['m_pressure']),
			"m_pressure_unit"	=> $_POST['m_pressure_unit'],
			"mold_group_cd"		=> $_POST['mold_group_cd'],
			"mold_group_nm"		=> $_POST['mold_group_nm'],
			"department_cd"		=> $_POST['department_cd'],
			"department_nm"		=> $_POST['department_nm'],
			"m_weight"			=> $this->replaceComma($_POST['m_weight']),
			"m_weight_unit"		=> $_POST['m_weight_unit'],
			"mold_location_cd"	=> $_POST['mold_location_cd'],
			"mold_location_nm"	=> $_POST['mold_location_nm'],
			"emp_id"			=> $_POST['emp_id'],
			"emp_nm"			=> $_POST['emp_nm'],
			"m_material"		=> $_POST['m_material'],
			"mold_type_cd"		=> $_POST['mold_type_cd'],
			"mold_type_nm"		=> $_POST['mold_type_nm'],
			"manager_cd"		=> $_POST['manager_cd'],
			"manager_nm"		=> $_POST['manager_nm'],
			"CAVITA"			=> $this->replaceComma($_POST['CAVITA']),
			"mold_divide_cd"	=> $_POST['mold_divide_cd'],
			"mold_divide_nm"	=> $_POST['mold_divide_nm'],
			"m_manage_number"	=> $_POST['m_manage_number'],
			"valid_hit_count"	=> $this->replaceComma($_POST['valid_hit_count']),
			"mold_class_cd"		=> $_POST['mold_class_cd'],
			"mold_class_nm"		=> $_POST['mold_class_nm'],
			"drawing_number"	=> $_POST['drawing_number'],
			"conversion_factor"	=> $this->replaceComma($_POST['conversion_factor']),
			"mold_state_cd"		=> $_POST['mold_state_cd'],
			"mold_state_nm"		=> $_POST['mold_state_nm'],
			"use_yn"			=> $_POST['use_yn'],
			"p_input_gubun"		=> $_POST['p_input_gubun'],
			"remark"			=> $_POST['remark'],
			"attach1"			=> $_POST['attach1'],
			"attach2"			=> $_POST['attach2'],
			"attach3"			=> $_POST['attach3'],
			"contract_account_cd"	=> $_POST['contract_account_cd'],
			"contract_account_nm"	=> $_POST['contract_account_nm'],
			"product_account_cd"	=> $_POST['product_account_cd'],
			"product_account_nm"	=> $_POST['product_account_nm'],
			"machine_nm"			=> $_POST['machine_nm'],
			"owner_account_cd"		=> $_POST['owner_account_cd'],
			"owner_account_nm"		=> $_POST['owner_account_nm'],
			"contract_dt"			=> $_POST['contract_dt'],
			"product_dt"			=> $_POST['product_dt'],
			"assets_number"			=> $_POST['assets_number'],
			"contract_price"		=> $this->replaceComma($_POST['contract_price']),
			"product_price"			=> $this->replaceComma($_POST['product_price']),
			"durable_years"			=> $_POST['durable_years'],
			"contract_life"			=> $this->replaceComma($_POST['contract_life']),
			"product_life"			=> $this->replaceComma($_POST['product_life']),
			"scrap_dt"				=> $_POST['scrap_dt'],
			"contract_number"		=> $_POST['contract_number'],
			"product_number"		=> $_POST['product_number'],
			"scrap_number"			=> $_POST['scrap_number'],
			"regdate"				=> $now
		);
		
		$result = $Mold->insert($data);

		$this->movePage("mold","registPageMold");

	}

	//금형 정보 수정
	public function modifyPageMoldHits() {
		$t = mold::getMoldHits($_GET['uid']);
		require_once('views/mold/createMoldHits.php');
	}

	// 금형 정보 등록
	public function registPageMoldItem(){
		require_once ('views/mold/createMoldItem.php');
	}

	// 금형부품 다중 등록
	public function insertPageMoldItems() {
		$Mold = new Mold;
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
		
		$mold_cd		= $_POST['mold_cd'];
		$item_cd		= $_POST['item_cd'];
		$item_nm		= $_POST['item_nm'];
		$standard1		= $_POST['standard1'];
		$material		= $_POST['material'];
		$unit			= $_POST['unit'];
		$cnt			= $_POST['cnt'];
		$valid_item_hit_cnt			= $_POST['valid_item_hit_cnt'];
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
					"cnt"			=> $this->replaceComma($cnt[$key]),
					"valid_item_hit_cnt" => $this->replaceComma($valid_item_hit_cnt[$key]),
					"item_gb"		=> $item_gb[$key],
					"item_group_cd"	=> $item_group_cd[$key],
					"item_group_nm"	=> $item_group_nm[$key],
					"remark"		=> $remark[$key],
					"regdate"		=> $now
				);
				$Mold->insert($data);
			}
		}
		$this->moveNewReload($_POST['dialogID'],$_POST['fid']);
	}

		// 금형부품 한폼목씩 등록
	public function insertPageMoldItem() {
		$Mold = new Mold;
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');

			$data = array(
				"table"			=> "erp_mold_item",
				"fid"			=> $_POST['fid'],
				"mold_cd"		=> $_POST['mold_cd'],
				"item_cd"		=> $_POST['item_cd'],
				"item_nm"		=> $_POST['item_nm'],
				"standard1"		=> $_POST['standard1'],
				"material"		=> $_POST['material'],
				"unit"			=> $_POST['unit'],
				"cnt"			=> $this->replaceComma($_POST['cnt']),
				"valid_item_hit_cnt" => $this->replaceComma($_POST['valid_item_hit_cnt']),
				"item_gb"		=> $_POST['item_gb'],
				"item_group_cd"	=> $_POST['item_group_cd'],
				"item_group_nm"	=> $_POST['item_group_nm'],
				"remark"		=> $_POST['remark'],
				"regdate"		=> $now
			);
		
			$result = $Mold->insert($data);

		$this->moveNewReload($_POST['dialogID'], $_POST['fid']);
	}

		
	// 금형 정보 등록
	public function registPageMoldFile(){
		require_once ('views/mold/createMoldFile.php');
	}

	// 프로젝트 수정 실행
	public function insertPageMoldFile() {
		$Mold = new Mold;

		$now = date("Y-m-d H:i:s");
		$fid = $_POST['uid'];

		if(isset($_FILES['attach'])){
			foreach($_FILES['attach']['tmp_name'] as $key => $tmp_name)
			{
				$file_name = $_FILES['attach']['name'][$key];
				$file_size =$_FILES['attach']['size'][$key];
				$file_tmp =$_FILES['attach']['tmp_name'][$key];
				$file_type=$_FILES['attach']['type'][$key];  
				
				if($file_name != "") {
					move_uploaded_file($file_tmp,"attach/mold/".time().$file_name);
					$nf = time().$file_name;
					$attach_data = array (
						"table" => "erp_mold_file",
						"fid" => $fid,
						"file_name" => $nf,
						"regdate"   =>$now
					);
					$Mold->insert($attach_data);
				}
			}
		} 

		$this->movePageClose($_POST['dialogID']);
	}


	// 금형 수리 등록
	public function registPageMoldRepair(){
		require_once ('views/mold/createMoldRepair.php');
	}

	//금형 수리 정보 수정
	public function modifyPageMoldRepair() {
		$t = mold::getMoldRepair($_GET['uid']);
		require_once('views/mold/modifyMoldRepair.php');
	}

	// 금형수리이력 등록
	public function insertPageMoldRepair() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');

		$sql = "select max(mold_repair_cha) as cnt from erp_mold_repair where mold_repair_dt='".$_POST['mold_repair_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$mold_repair_cha = "1";
		}else{
			$mold_repair_cha = $t0->cnt+1;
		}

		$mold_repair_cd  = $_POST['mold_repair_dt']."-".$mold_repair_cha;

		$data = array(
			"table"				=> "erp_mold_repair",
			"mold_cd"			=> $_POST['mold_cd'],
			"mold_nm"			=> $_POST['mold_nm'],
			"mold_repair_cd"	=> $mold_repair_cd,
			"mold_repair_dt"	=> $_POST['mold_repair_dt'],
			"mold_repair_cha"	=> $mold_repair_cha,
			"deadline_dt"		=> $_POST['deadline_dt'],
			"start_dt"			=> $_POST['start_dt'],
			"end_dt"			=> $_POST['end_dt'],
			"repair_type"		=> $_POST['repair_type'],
			"repair_time"		=> $this->replaceComma($_POST['repair_time']),
			"defect_gb"			=> $_POST['defect_gb'],
			"defect_content"	=> $_POST['defect_content'],
			"repair_gb"			=> $_POST['repair_gb'],
			"repair_content"	=> $_POST['repair_content'],
			"warehouse_cd"		=> $_POST['warehouse_cd'],
			"warehouse_nm"		=> $_POST['warehouse_nm'],
			"process_cd"		=> $_POST['process_cd'],
			"process_nm"		=> $_POST['process_nm'],
			"workshop_cd"		=> $_POST['workshop_cd'],
			"workshop_nm"		=> $_POST['workshop_nm'],
			"account_cd"		=> $_POST['account_cd'],
			"account_nm"		=> $_POST['account_nm'],
			"department_cd"		=> $_POST['department_cd'],
			"department_nm"		=> $_POST['department_nm'],
			"manager_id"		=> $_POST['manager_id'],
			"manager_nm"		=> $_POST['manager_nm'],
			"emp_id"			=> $_POST['emp_id'],
			"emp_nm"			=> $_POST['emp_nm'],
			"repair_price"		=> $this->replaceComma($_POST['repair_price']),
			"memo"				=> $_POST['memo'],
			"repair_gb"			=> $_POST['repair_gb'],
			"state"				=> $_POST['state'],
			"cntTotal"			=> $_POST['cntTotal'],
			"attach"			=> $fileAttach,
			"regdate"			=> $now
		);

		$Mold = new Mold;
		$fid = $Mold->mysqlInsertId($data);
		
		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard1 = $_POST['standard1'];
		$material = $_POST['material'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$remark = $_POST['remark'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"			=> "erp_mold_repair_item",
					"fid"			=> $fid,
					"mold_repair_cd"	=> $mold_repair_cd,
					"item_cd"		=> $val,
					"item_nm"		=> $item_nm[$key],
					"standard1"		=> $standard1[$key],
					"material"		=> $material[$key],
					"unit"			=> $unit[$key],
					"cnt"			=> $this->replaceComma($cnt[$key]),
					"remark"		=> $remark[$key],
					"regdate"		=> $now
				);
				$Mold->insert($data);
			}
		}
		$this->movePageClose($_POST['dialogID']);
	
	}

	// 금형수리이력 수정
	public function updatePageMoldRepair() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
		/*
		$sql = "select max(mold_repair_cha) as cnt from erp_mold_repair where mold_repair_dt='".$_POST['mold_repair_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$mold_repair_cha = "1";
		}else{
			$mold_repair_cha = $t0->cnt+1;
		}

		$mold_repair_cd  = $_POST['mold_repair_dt']."-".$mold_repair_cha;
		*/
		$data = array(
			"table"				=> "erp_mold_repair",
			"where"				=> "uid=".$_POST['uid'],
			"mold_cd"			=> $_POST['mold_cd'],
			"mold_nm"			=> $_POST['mold_nm'],
			//"mold_repair_cd"	=> $_POST['mold_repair_cd'],
			//"mold_repair_dt"	=> $_POST['mold_repair_dt'],
			//"mold_repair_cha"	=> $mold_repair_cha,
			"deadline_dt"		=> $_POST['deadline_dt'],
			"start_dt"			=> $_POST['start_dt'],
			"end_dt"			=> $_POST['end_dt'],
			"repair_type"		=> $_POST['repair_type'],
			"repair_time"		=> $this->replaceComma($_POST['repair_time']),
			"defect_gb"			=> $_POST['defect_gb'],
			"defect_content"	=> $_POST['defect_content'],
			"repair_gb"			=> $_POST['repair_gb'],
			"repair_content"	=> $_POST['repair_content'],
			"warehouse_cd"		=> $_POST['warehouse_cd'],
			"warehouse_nm"		=> $_POST['warehouse_nm'],
			"process_cd"		=> $_POST['process_cd'],
			"process_nm"		=> $_POST['process_nm'],
			"workshop_cd"		=> $_POST['workshop_cd'],
			"workshop_nm"		=> $_POST['workshop_nm'],
			"account_cd"		=> $_POST['account_cd'],
			"account_nm"		=> $_POST['account_nm'],
			"department_cd"		=> $_POST['department_cd'],
			"department_nm"		=> $_POST['department_nm'],
			"manager_id"		=> $_POST['manager_id'],
			"manager_nm"		=> $_POST['manager_nm'],
			"emp_id"			=> $_POST['emp_id'],
			"emp_nm"			=> $_POST['emp_nm'],
			"repair_price"		=> $this->replaceComma($_POST['repair_price']),
			"memo"				=> $_POST['memo'],
			"repair_gb"			=> $_POST['repair_gb'],
			"state"				=> $_POST['state'],
			"cntTotal"			=> $_POST['cntTotal'],
			"attach"			=> $fileAttach,
			"regdate"			=> $now
		);

		$Mold = new Mold;
		$result = $Mold->update($data);

		$sql = "delete from erp_mold_repair_item where fid='".$_POST['uid']."'";
		mysql_query($sql);
		
		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard1 = $_POST['standard1'];
		$material = $_POST['material'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$item_gb = $_POST['item_gb'];
		$remark = $_POST['remark'];
		$lot_nm_cd = $_POST['lot_nm_cd'];
		$lot_nm_nm = $_POST['lot_nm_nm'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"			=> "erp_mold_repair_item",
					"fid"			=> $_POST['uid'],
					"mold_repair_cd"=> $_POST['mold_repair_cd'],
					"item_cd"		=> $val,
					"item_nm"		=> $item_nm[$key],
					"standard1"		=> $standard1[$key],
					"material"		=> $material[$key],
					"unit"			=> $unit[$key],
					"cnt"			=> $this->replaceComma($cnt[$key]),
					"remark"		=> $remark[$key],
					"regdate"		=> $now
				);
				$Mold->insert($data);
			}
		}
		$this->movePageClose($_POST['dialogID']);
	
	}


	// 금형 위치 등록
	public function listPageMoldLocation(){
		require_once ('views/mold/listMoldLocation.php');
	}
	
	public function insertPageMoldLocation(){
		$now = date("Y-m-d H:i:s");
		$Mold = new Mold;
		
		if ($_POST['uid']==""){
			$data = array(
				"table"				=> "erp_mold",
				"mold_location_cd"	=> $_POST['mold_location_cd'],
				"mold_location_nm"	=> $_POST['mold_location_nm'],
				"remark"			=> $_POST['remark'],
				"use_yn"			=> $_POST['use_yn'],
				"regdate"				=> $now
			);
			$Mold->insert($data);
		}else{		
			$data = array(
				"table"				=> "erp_mold",
				"where"				=> "uid=".$_POST['uid'],
				"mold_location_cd"	=> $_POST['mold_location_cd'],
				"mold_location_nm"	=> $_POST['mold_location_nm'],
				"remark"			=> $_POST['remark'],
				"use_yn"			=> $_POST['use_yn'],
				"regdate"			=> $now
			);
			$Mold->update($data);
		}
	}

		// 금형 위치 등록
	public function registPageMoldMovement(){
		require_once ('views/mold/createMoldMovement.php');
	}

	public function insertPageMoldMovement(){
		$now = date("Y-m-d H:i:s");

		$sql = "select max(mold_move_cha) as cnt from erp_mold_movement where mold_move_dt='".$_POST['mold_move_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$mold_move_cha = "1";
		}else{
			$mold_move_cha = $t0->cnt+1;
		}

		$mold_move_cd  = $_POST['mold_move_dt']."-".$mold_move_cha;

		$data = array(
			"table"				=> "erp_mold_movement",
			"mold_cd"			=> $_POST['mold_cd'],
			"mold_nm"			=> $_POST['mold_nm'],
			"mold_move_dt"		=> $_POST['mold_move_dt'],
			"mold_move_cha"		=> $mold_move_cha,
			"mold_move_cd"		=> $mold_move_cd,
			"department_cd"		=> $_POST['department_cd'],
			"department_nm"		=> $_POST['department_nm'],
			"manager_cd"		=> $_POST['manager_cd'],
			"manager_nm"		=> $_POST['manager_nm'],
			"move_reason"		=> $_POST['move_reason'],
			"remark"			=> $_POST['remark'],
			"apply_yn"			=> $_POST['apply_yn'],
			"b_machine_cd"		=> $_POST['b_machine_cd'],
			"b_machine_nm"		=> $_POST['b_machine_nm'],
			"b_mold_location_cd"=> $_POST['b_mold_location_cd'],
			"b_mold_location_nm"=> $_POST['b_mold_location_nm'],
			"b_manager_cd"		=> $_POST['b_manager_cd'],
			"b_manager_nm"		=> $_POST['b_manager_nm'],
			"b_manager_hp"		=> $_POST['b_manager_hp'],
			"machine_cd"		=> $_POST['machine_cd'],
			"machine_nm"		=> $_POST['machine_nm'],
			"mold_location_cd"	=> $_POST['mold_location_cd'],
			"mold_location_nm"	=> $_POST['mold_location_nm'],
			"a_manager_cd"		=> $_POST['a_manager_cd'],
			"a_manager_nm"		=> $_POST['a_manager_nm'],
			"a_manager_hp"		=> $_POST['a_manager_hp'],
			"regdate"			=> $now
		);

		$Mold = new Mold;
		$result = $Mold->insert($data);

		//금형정보 반영 위치 정보 변경 반영
		if ($result)
		{
			if($_POST['apply_yn']=="Y"){
				$sql = "update erp_mold set mold_location_cd='".$mold_location_cd."', mold_location_nm='".$mold_location_nm."' where mold_cd=".$_POST['mold_cd'];
				$result = query($sql);
			}
		}
		$this->movePage("mold","registPageMoldMovement");
	}
	

	public function updatePageMoldMovement(){
		$now = date("Y-m-d H:i:s");

		$data = array(
			"table"				=> "erp_mold_movement",
			"where"				=> "uid=".$_POST['uid'],
			//"mold_cd"			=> $_POST['mold_cd'],
			//"mold_nm"			=> $_POST['mold_nm'],
			//"mold_move_dt"		=> $_POST['mold_move_dt'],
			"mold_move_cd"		=> $_POST['mold_move_cd'],
			"department_cd"		=> $_POST['department_cd'],
			"department_nm"		=> $_POST['department_nm'],
			"manager_cd"		=> $_POST['manager_cd'],
			"manager_nm"		=> $_POST['manager_nm'],
			"move_reason"		=> $_POST['move_reason'],
			"remark"			=> $_POST['remark'],
			"apply_yn"			=> $_POST['apply_yn'],
			"b_machine_cd"		=> $_POST['b_machine_cd'],
			"b_machine_nm"		=> $_POST['b_machine_nm'],
			"b_mold_location_cd"=> $_POST['b_mold_location_cd'],
			"b_mold_location_nm"=> $_POST['b_mold_location_nm'],
			"b_manager_cd"		=> $_POST['b_manager_cd'],
			"b_manager_nm"		=> $_POST['b_manager_nm'],
			"b_manager_hp"		=> $_POST['b_manager_hp'],
			"machine_cd"		=> $_POST['machine_cd'],
			"machine_nm"		=> $_POST['machine_nm'],
			"mold_location_cd"	=> $_POST['mold_location_cd'],
			"mold_location_nm"	=> $_POST['mold_location_nm'],
			"a_manager_cd"		=> $_POST['a_manager_cd'],
			"a_manager_nm"		=> $_POST['a_manager_nm'],
			"a_manager_hp"		=> $_POST['a_manager_hp'],
			"editdate"				=> $now
		);

		$Mold = new Mold;
		$result = $Mold->update($data);

		//금형정보 반영 위치 정보 변경 반영
		if ($result)
		{
			if($_POST['apply_yn']=="Y"){
				$sql = "update erp_mold set mold_location_cd='".$mold_location_cd."', mold_location_nm='".$mold_location_nm."' where mold_cd=".$_POST['mold_cd'];
				$result = query($sql);
			}
		}
		$this->movePage("mold","registPageMoldMovement");

	}
}
?>