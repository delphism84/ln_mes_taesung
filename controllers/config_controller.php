<?
session_start();
// 영업관리
class ConfigController {
	public function __construct() {
		extract($_POST);
		extract($_GET);
	}
	
	public function movePage($controller,$action) {
		echo "<script>";
		echo "location.href = 'index.php?controller=".$controller."&action=".$action."' ";
		echo "</script>";
	}

	public function upload($file) {
		// 폴더생성
		@mkdir("attach/", 0777);

		$dir = "attach/"; //저장될 폴더 경로(끝에 '/'슬래시 꼭 붙여주세요...^^)
		chmod("$dir", 0777);

		$varName = $file; //이전 페이지에서 설정된 file 변수명
		$allowExt = "jpg,gif,png,jpeg,JPG,GIF,PNG,doc,DOC,docx,Docx"; //업로드 가능한 확장자 (,)콤마로 구분

		$prefix = time(); //파일명 앞에 자동으로 붙을 단어

		
		if($_FILES[$varName][name] && $_FILES[$varName][error] == 0) {
			// $dir 폴더가 지정됐고, 사용가능 한지 검사
			if(!$dir) {
				$this->goBack("업로드 폴더가 지정되지 않았습니다.");
				exit;
			}
			if(!is_writable($dir)) {
				$this->goBack("업로드 폴더 권한을 확인해 주세요.");
				exit;
			}

			// php.ini 파일에 설정된 upload_max_filesize 값을 이용해서 업로드 파일이 용량을 초과했는지검사
			$allowSize = intval(substr(ini_get(upload_max_filesize),0,-1)) * 1024 * 1024;
			if($allowSize < $_FILES[$varName][size]) {
				$this->goBack("파일 용량이 허용된 용량을 초과했습니다.");
				exit;
			}

			// 정상적인 방법으로 업로드 된 파일인지 검사 후 정상이면 파일 업로드 처리
			if(is_uploaded_file($_FILES[$varName][tmp_name])) {
				// 확장자 검사
				$ext = substr(strrchr($_FILES[$varName][name],"."),1);
				if($ext) {
					$allow = explode(",",$allowExt);
					if(is_array($allow)) $check = in_array($ext,$allow);
					else $check = ($ext == $allow) ? true : false;
				}
		
				if(!$ext || !$check) {
					$this->goBack("업로드 불가능한 확장자 입니다.");
					exit;
				}

				// 파일명 생성 및 존재하는지 검사
				// $newfile = md5($prefix.$_FILES[$varName][name]).".".$ext;
				$newfile = $prefix.$_FILES[$varName][name];

				if(file_exists($dir.$newfile)) {
					$this->goBack("같은이름의 화일이 있습니다. 화일명을 변경하고 업로드 하시기 바랍니다.");
					exit;
				}

				// $dir 에 파일 저장
				if(!move_uploaded_file($_FILES[$varName][tmp_name], $dir.$newfile)) {
					$this->goBack("파일 업로드에 실패했습니다.");
					exit;
				}
		
				if(!chmod($dir.$newfile,0707)) {
					$this->goBack("퍼미션변경에 실패했습니다.");
					exit;
				}

				return $newfile;
			}
		}
	}

/******************************************************************************************************
:: 사원 관련 함수들
******************************************************************************************************/		
	// 사원등록 페이지
	public function inputPageConfig() {
		$t = Config::get(1,"config");
		require_once ("views/config/createConfig.php");
	}

	public function inputPageInfo() {
		$t = Config::get(1,"info");
		require_once ("views/config/createInfor.php");
	}

	
	// 사원등록 실행
	public function registConfig(){
		$config = new Config;
		$corp = $config->get(1,"config");
		
		if($corp->uid != "") {
			$data = array(
				"table" => "erp_config",
				"where" => "uid=1",
				"auto_purchase" => $_POST['auto_purchase'],
				"auto_work" => $_POST['auto_work'],
				"auto_release" => $_POST['auto_release'],
				"auto_code" => $_POST['auto_code'],
				"auto_lotno" => $_POST['auto_lotno'],
				"auto_barcode" => $_POST['auto_barcode'],
				"auto_project" => $_POST['auto_project'],
				"auto_safety_stock" => $_POST['auto_safety_stock']
				
			);
			$result = $config->update($data);
		} else {
			$data = array(
				"table" => "erp_config",
				"auto_purchase" => $_POST['auto_purchase'],
				"auto_work" => $_POST['auto_work'],
				"auto_release" => $_POST['auto_release'],
				"auto_code" => $_POST['auto_code'],
				"auto_lotno" => $_POST['auto_lotno'],
				"auto_barcode" => $_POST['auto_barcode'],
				"auto_project" => $_POST['auto_project'],
				"auto_safety_stock" => $_POST['auto_safety_stock']
			);
			$result = $config->insert($data);
		}

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
		
		if($result) $this->movePage("config","inputPageConfig");
	}

	// 사원등록 실행
	public function registInfo(){
		$config = new Config;
		$corp = $config->get(1,"info");

		if($corp->corp_nm != "") {
			$data = array(
				"table" => "erp_info",
				"where" => "uid=1",
				"corp_nm" => $_POST['corp_nm'],
				"admin" => $_POST['admin']
			);
			$result = $config->update($data);
		} else {
			$data = array(
				"table" => "erp_info",
				"corp_nm" => $_POST['corp_nm'],
				"admin" => $_POST['admin']
			);	
			$result = $config->insert($data);
		}

		if($result) $this->movePage("config","inputPageInfo");
	}

	public function dataBackup() {
		require_once ("views/config/dataBackup.php");
	}

	public function inputPageMenu() {
		$t = Config::get(1,"menu");
		require_once ("views/config/createMenu.php");
	}

	public function registMenu(){
		$config = new Config;
		if($_POST['uid'] != "") {
			$data = array (
				"table" => "erp_menu",
				"where" => "uid=".$_POST['uid'],
				"item_menu" => $_POST['item_menu'],
				"account_menu" => $_POST['account_menu'],
				"department_menu" => $_POST['department_menu'],
				"position_menu" => $_POST['position_menu'],
				"employee_menu" => $_POST['employee_menu'],
				"warehouse_menu" => $_POST['warehouse_menu'],
				"process_menu" => $_POST['process_menu'],
				"machine_menu" => $_POST['machine_menu'],
				"project_menu" => $_POST['project_menu'],
				"excel_menu" => $_POST['excel_menu'],
				"trade_menu" => $_POST['trade_menu'],
				"estimate_menu" => $_POST['estimate_menu'],
				"order_menu" => $_POST['order_menu'],
				"shipment_menu" => $_POST['shipment_menu'],
				"as_menu" => $_POST['as_menu'],
				"receive_menu" => $_POST['receive_menu'],
				"sale_plan_menu" => $_POST['sale_plan_menu'],
				"demand_menu" => $_POST['demand_menu'],
				"purchase_plan_menu" => $_POST['purchase_plan_menu'],
				"purchase_menu" => $_POST['purchase_menu'],
				"purchase_item_menu" => $_POST['purchase_item_menu'],
				"amount_menu" => $_POST['amount_menu'],
				"bom_menu" => $_POST['bom_menu'],
				"bom_cal_menu" => $_POST['bom_cal_menu'],
				"outsourcing_menu" => $_POST['outsourcing_menu'],
				"workplan_menu" => $_POST['workplan_menu'],
				"workplan_bom_menu" => $_POST['workplan_bom_menu'],
				"work_menu" => $_POST['work_menu'],
				"qc_menu" => $_POST['qc_menu'],
				"defective_menu" => $_POST['defective_menu'],
				"warehouse_stock_menu" => $_POST['warehouse_stock_menu'],
				"price_menu" => $_POST['price_menu'],
				"stock_menu" => $_POST['stock_menu'],
				"release_menu" => $_POST['release_menu'],
				"barcode_menu" => $_POST['barcode_menu'],
				"real_stock_menu" => $_POST['real_stock_menu'],
				"safety_menu" => $_POST['safety_menu'],
				"ele_menu" => $_POST['ele_menu'],
				"crm_menu" => $_POST['crm_menu'],
				"board_menu" => $_POST['board_menu'],
				"schedule_menu" => $_POST['schedule_menu'],
				"leave_menu" => $_POST['leave_menu'],
				"file_menu" => $_POST['file_menu'],
				"goods_menu" => $_POST['goods_menu'],
				"car_menu" => $_POST['car_menu'],
				"installation_menu" => $_POST['installation_menu']
			);
			$config->update($data);
		} else {
			$data = array (
				"table" => "erp_menu",
				"item_menu" => $_POST['item_menu'],
				"account_menu" => $_POST['account_menu'],
				"department_menu" => $_POST['department_menu'],
				"position_menu" => $_POST['position_menu'],
				"employee_menu" => $_POST['employee_menu'],
				"warehouse_menu" => $_POST['warehouse_menu'],
				"process_menu" => $_POST['process_menu'],
				"machine_menu" => $_POST['machine_menu'],
				"project_menu" => $_POST['project_menu'],
				"excel_menu" => $_POST['excel_menu'],
				"trade_menu" => $_POST['trade_menu'],
				"estimate_menu" => $_POST['estimate_menu'],
				"order_menu" => $_POST['order_menu'],
				"shipment_menu" => $_POST['shipment_menu'],
				"as_menu" => $_POST['as_menu'],
				"receive_menu" => $_POST['receive_menu'],
				"sale_plan_menu" => $_POST['sale_plan_menu'],
				"demand_menu" => $_POST['demand_menu'],
				"purchase_plan_menu" => $_POST['purchase_plan_menu'],
				"purchase_menu" => $_POST['purchase_menu'],
				"purchase_item_menu" => $_POST['purchase_item_menu'],
				"amount_menu" => $_POST['amount_menu'],
				"bom_menu" => $_POST['bom_menu'],
				"bom_cal_menu" => $_POST['bom_cal_menu'],
				"outsourcing_menu" => $_POST['outsourcing_menu'],
				"workplan_menu" => $_POST['workplan_menu'],
				"workplan_bom_menu" => $_POST['workplan_bom_menu'],
				"work_menu" => $_POST['work_menu'],
				"qc_menu" => $_POST['qc_menu'],
				"defective_menu" => $_POST['defective_menu'],
				"warehouse_stock_menu" => $_POST['warehouse_stock_menu'],
				"price_menu" => $_POST['price_menu'],
				"stock_menu" => $_POST['stock_menu'],
				"release_menu" => $_POST['release_menu'],
				"barcode_menu" => $_POST['barcode_menu'],
				"real_stock_menu" => $_POST['real_stock_menu'],
				"safety_menu" => $_POST['safety_menu'],
				"ele_menu" => $_POST['ele_menu'],
				"crm_menu" => $_POST['crm_menu'],
				"board_menu" => $_POST['board_menu'],
				"schedule_menu" => $_POST['schedule_menu'],
				"leave_menu" => $_POST['leave_menu'],
				"file_menu" => $_POST['file_menu'],
				"goods_menu" => $_POST['goods_menu'],
				"car_menu" => $_POST['car_menu'],
				"installation_menu" => $_POST['installation_menu']
			);
			$config->insert($data);
		}
		$this->movePage("config","inputPageMenu");
	}
}
?>