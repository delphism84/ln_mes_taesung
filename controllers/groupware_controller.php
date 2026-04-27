<?
session_start();
// 영업관리
class GroupwareController {
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
		$allowExt = "jpg,gif,png,jpeg,JPG,GIF,PNG,doc,DOC,docx,Docx,hwp,HWP,ppt,PPT,pptx,PPTX,zip,ZIP"; //업로드 가능한 확장자 (,)콤마로 구분

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

	// 견적서 리스트
	public function inputPageEleSettlement(){
		require_once ('views/groupware/createEleSettlement.php');
	}

	public function inputPageProject() {
		require_once ("views/groupware/createProject.php");
	}

	public function registProject() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_project",
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"emp_cd" => $_POST['emp_cd'],
			"emp_nm" => $_POST['emp_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"project_gb" => $_POST['project_gb'],
			"start_dt" => $_POST['start_dt'],
			"end_dt" => $_POST['end_dt'],
			"create_dt" => $now
		);

		$groupware = new Groupware;
		$result = $groupware->registProject($data);
		

		

		if(isset($_FILES['attach'])){
			foreach($_FILES['attach']['tmp_name'] as $key => $tmp_name)
			{
				$file_name = $_FILES['attach']['name'][$key];
				$file_size =$_FILES['attach']['size'][$key];
				$file_tmp =$_FILES['attach']['tmp_name'][$key];
				$file_type=$_FILES['attach']['type'][$key];  
				
				if($file_name != "") {
					move_uploaded_file($file_tmp,"attach/".time().$file_name);
					$nf = time().$file_name;
					$attach_data = array (
						"table" => "erp_project_attach",
						"project_cd" => $_POST['project_cd'],
						"attach" => $nf
					);
					$groupware->registProjectAttach($attach_data);
				}
			}
		} 
		if($result) $this->movePage("groupware","listPageProject");
	}

	public function updateProject() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_project",
			"where" => "uid=".$_POST['uid'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"emp_cd" => $_POST['emp_cd'],
			"emp_nm" => $_POST['emp_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"project_gb" => $_POST['project_gb'],
			"start_dt" => $_POST['start_dt'],
			"end_dt" => $_POST['end_dt'],
			"create_dt" => $now
		);

		$groupware = new Groupware;
		$result = $groupware->updateProject($data);
		

		

		if(isset($_FILES['attach'])){
			foreach($_FILES['attach']['tmp_name'] as $key => $tmp_name)
			{
				$file_name = $_FILES['attach']['name'][$key];
				$file_size =$_FILES['attach']['size'][$key];
				$file_tmp =$_FILES['attach']['tmp_name'][$key];
				$file_type=$_FILES['attach']['type'][$key];  
				
				if($file_name != "") {
					move_uploaded_file($file_tmp,"attach/".time().$file_name);
					$nf = time().$file_name;
					$attach_data = array (
						"table" => "erp_project_attach",
						"project_cd" => $_POST['project_cd'],
						"attach" => $nf
					);
					$groupware->registProjectAttach($attach_data);
				}
			}
		} 
		if($result) $this->movePage("groupware","listPageProject");
	}

	public function listPageProject() {
		require_once ("views/groupware/listProject.php");
	}

	public function inputPageEleSettlementLine(){
		require_once ("views/groupware/createEleSettlementLine.php");
	}
	
	// 견적서 등록
	public function createEstimateSheet(){
		require_once ("views/sales/createEstimateSheet.php");
	}
	
	// 수주,주문 등록
	public function createOrderSheet() {
		require_once ("views/sales/createOrderSheet.php");
	}
	
	// 거래처 등록
	public function inputPageAccount() {
		require_once ("views/sales/createAccount.php");
	}

	public function listPageAccount() {
		require_once ("views/sales/listAccount.php");
	}

	public function registAccount(){
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_accounts",
			"account_gb" => $_POST['account_gb'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"owner" => $_POST['owner'],
			"owner_mobile" => $_POST['owner_mobile'],
			"corp_reg_no" => $_POST['corp_reg_no'],
			"corp_condition" => $_POST['corp_condition'],
			"corp_event" => $_POST['corp_event'],
			"corp_phone" => $_POST['corp_phone'],
			"corp_fax" => $_POST['corp_fax'],
			"corp_email" => $_POST['corp_email'],
			"corp_zipcode" => $_POST['corp_zipcode'],
			"corp_address" => $_POST['corp_address'],
			"account_id" => $_POST['account_id'],
			"account_pwd" => $_POST['account_pwd'],
			"create_dt" => $now
		);

		$sales = new Sales;
		$result = $sales->registAccount($data);
		if($result) $this->movePage("sales","listPageAccount");
	}

	public function updateAccount() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_accounts",
			"where" => "uid=".$_POST['uid'],
			"account_gb" => $_POST['account_gb'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"owner" => $_POST['owner'],
			"owner_mobile" => $_POST['owner_mobile'],
			"corp_reg_no" => $_POST['corp_reg_no'],
			"corp_condition" => $_POST['corp_condition'],
			"corp_event" => $_POST['corp_event'],
			"corp_phone" => $_POST['corp_phone'],
			"corp_fax" => $_POST['corp_fax'],
			"corp_email" => $_POST['corp_email'],
			"corp_zipcode" => $_POST['corp_zipcode'],
			"corp_address" => $_POST['corp_address'],
			"account_id" => $_POST['account_id'],
			"account_pwd" => $_POST['account_pwd'],
			"create_dt" => $now
		);
		$sales = new Sales;
		$result = $sales->updateAccount($data);
		if($result) $this->movePage("sales","listPageAccount");
	}
	
	public function modifyPageProject(){
		$t = Groupware::getProject($_GET['uid']);
		require_once ("views/groupware/modifyProject.php");
	}

	public function modifyAccount() {
		$t = Sales::getAccount($_GET['uid']);
		require_once ("views/sales/modifyAccount.php");
	}
	
	public function download() {
		require_once ("attach/".$_GET['file']);
	}

	// 출하지시서 입력페이지
	public function inputPageShipment() {
		require_once ("views/sales/createShipment.php");
	}

	public function listPageEleSettlementLine() {
		require_once ("views/groupware/listEleSettlementLine.php");
	}
	
	// 결재라인 등록
	public function registEleSettlementLine() {
		$data = array(
			"table" => "erp_ele_settlement_line",
			"approval_nm" => $_POST['approval_nm'],
			"emp_id" => $_SESSION['login_id']
		);
		$groupware = new Groupware;
		$fid = $groupware->registEleSettlementLine($data);
		$i = 1;
		foreach($_POST['to'] as $key=>$value) {
			$data = array(
				"table" => "erp_ele_settlement_emp",
				"fid" => $fid,
				"emp_id" => $value,
				"seq" => $i
			);
			$groupware->registEleSettlementEmp($data);
			$i++;
		}
		$this->movePage("groupware","listPageEleSettlementLine");
	}

	public function registEleSettlement(){
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
		$data = array(
			"table" => "erp_approval",
			"title" => $_POST['title'],
			"approval_line" => $_POST['approval_uid'],
			"refer" => $_POST['refer_id'],
			"comment" => $_POST['comment'],
			"purchase_cd" => $_POST['purchase_cd'],
			"attach" => $fileAttach,
			"document" => $_POST['document'],
			"state" => "stay",
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);
		
		$groupware = new Groupware;
		$fid = $groupware->registEleSettlement($data);
		
		$groupware->registApprovalCheck($fid,$_POST['approval_uid']);

		$this->movePage("groupware","listPageEleSettlement");

	}

	public function listPageEleSettlement(){
		require_once("views/groupware/listEleSettlement.php");
	}
	
	// 나의 기안함
	public function listPageMyEleSettlement(){
		require_once("views/groupware/listMyEleSettlement.php");
	}

	public function modifyPageEleSettlement() {
		$t = Groupware::getEleSettlement($_GET['uid']);
		require_once ("views/groupware/modifyEleSettlement.php");
	}

	// 생산기계등록
	public function inputPageMachine() {
		require_once("views/groupware/createMachine.php");
	}

	public function registMachine(){
		$data = array(
			"table" => "erp_machine",
			"process_cd" => $_POST['process_cd'],
			"machine_nm" => $_POST['machine_nm']
		);
		
		$groupware = new Groupware;
		$groupware->registMachine($data);

		$this->movePage("groupware","listPageMachine");

	}

	public function listPageMachine(){
		require_once("views/groupware/listMachine.php");
	}
	
	// 파일리스트
	public function listPageFile(){
		require_once("views/groupware/listFile.php");
	}

	// 파일등록 페이지
	public function inputPageFile() {
		require_once("views/groupware/createFile.php");
	}
	
	// 파일등록
	public function registFile() {
		$groupware = new Groupware;

		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');

		if($_POST['uid'] != "") {
			$data = array(
				"table" => "erp_file",
				"where" => "uid=".$_POST['uid'],
				"title" => $_POST['title'],
				"document_gb" => $_POST['document_gb'],
				"attach" => $fileAttach,
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => $now
			);
			$groupware->update($data);
		} else {
			$data = array(
				"table" => "erp_file",
				"title" => $_POST['title'],
				"document_gb" => $_POST['document_gb'],
				"attach" => $fileAttach,
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => $now
			);
			$groupware->insert($data);
		}

		$this->movePage("groupware","listPageFile");
	}


	// 업무공유 리스트
	public function listPageBoard(){
		require_once("views/groupware/listBoard.php");
	}

	// 업무공유 페이지
	public function inputPageBoard() {
		require_once("views/groupware/createBoard.php");
	}
	
	// 업무공유 등록
	public function registBoard() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
		$data = array(
			"table" => "erp_board",
			"title" => $_POST['title'],
			"board_gb" => $_POST['board_gb'],
			"comment" => $_POST['comment'],
			"attach" => $fileAttach,
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);
		$groupware = new Groupware;
		$groupware->registBoard($data);

		$this->movePage("groupware","listPageBoard");

	}

	// 공용품 리스트
	public function listPagePublicThing(){
		require_once("views/groupware/listPublicThing.php");
	}

	// 공용품 페이지
	public function inputPagePublicThing() {
		require_once("views/groupware/createPublicThing.php");
	}
	
	// 공용품 등록
	public function registPublicThing() {
		$groupware = new Groupware;

		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');

		$in = explode("-",$_POST['in_dt']);
		$in_time = mktime(0,0,0,$in[1],$in[2],$in[0]);

		switch($_POST['change_gb']) {
			case "day" :
				$alarm_dt = $in_time + ($_POST['change_day'] * 86400);
			break;

			case "week" :
				$alarm_dt = $in_time + ($_POST['change_day'] * 86400 * 7);
			break;

			case "month" :
				$alarm_dt = $in_time + ($_POST['change_day'] * 86400 * 30);
			break;

			case "year" :
				$alarm_dt = $in_time + ($_POST['change_day'] * 86400 * 365);
			break;
		}

		$alarm = date("Y-m-d",$alarm_dt);
		
		if($_POST['uid'] != "") {
			$data = array(
				"table" => "erp_public_thing",
				"where" => "uid=".$_POST['uid'],
				"item_nm" => $_POST['item_nm'],
				"item_gb" => $_POST['item_gb'],
				"in_dt" => $_POST['in_dt'],
				"change_day" => $_POST['change_day'],
				"change_gb" => $_POST['change_gb'],
				"alarm_dt" => $alarm,
				"charge_id" => $_POST['emp_id'],
				"charge_nm" => $_POST['emp_nm'],
				"attach" => $fileAttach,
				"create_dt" => $now
			);
			$groupware->update($data);
		} else {
			$data = array(
				"table" => "erp_public_thing",
				"item_nm" => $_POST['item_nm'],
				"item_gb" => $_POST['item_gb'],
				"in_dt" => $_POST['in_dt'],
				"change_day" => $_POST['change_day'],
				"change_gb" => $_POST['change_gb'],
				"alarm_dt" => $alarm,
				"charge_id" => $_POST['emp_id'],
				"charge_nm" => $_POST['emp_nm'],
				"attach" => $fileAttach,
				"create_dt" => $now
			);
			$groupware->insert($data);
		}

		$this->movePage("groupware","listPagePublicThing");

	}

	// 차량 리스트
	public function listPageCar(){
		require_once("views/groupware/listCar.php");
	}

	// 차량 리스트
	public function modifyPageCar(){
		$t = Groupware::getCar($_GET['uid']);
		require_once("views/groupware/modifyCar.php");
	}

	// 차량등록 페이지
	public function inputPageCar() {
		require_once("views/groupware/createCar.php");
	}
	
	// 차량 등록 실행
	public function registCar() {
		$groupware = new Groupware;

		if($_POST['uid'] != "") {
			$data = array(
				"table" => "erp_car",
				"where" => "uid=".$_POST['uid'],
				"car_no" => $_POST['car_no'],
				"car_gb" => $_POST['car_gb'],
				"in_dt" => $_POST['in_dt'],
				"charge_id" => $_POST['emp_id'],
				"charge_nm" => $_POST['emp_nm']
			);
			$groupware->update($data);
		} else {
			$data = array(
				"table" => "erp_car",
				"car_no" => $_POST['car_no'],
				"car_gb" => $_POST['car_gb'],
				"in_dt" => $_POST['in_dt'],
				"charge_id" => $_POST['emp_id'],
				"charge_nm" => $_POST['emp_nm']
			);
			$groupware->insert($data);
		}

		$this->movePage("groupware","listPageCar");
	}

	//  CRM 등록
	public function inputPageCrm() {
		require_once("views/groupware/createCrm.php");
	}

	// CRM 리스트
	public function listPageCrm(){
		require_once("views/groupware/listCrm.php");
	}
	
	// CRM 리스트
	public function modifyPageCrm(){
		$t = Groupware::getCrm($_GET['uid']);
		require_once("views/groupware/modifyCrm.php");
	}

	// 고객등록
	public function registCustomer(){
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_customer",
			"customer_nm" => $_POST['customer_nm'],
			"customer_gb" => $_POST['customer_gb'],
			"customer_phone" => $_POST['customer_phone'],
			"customer_email" => $_POST['customer_email'],
			"customer_birthday" => $_POST['customer_birthday'],
			"customer_zipcode" => $_POST['customer_zipcode'],
			"customer_address" => $_POST['customer_address'],
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);

		$groupware = new Groupware;
		$groupware->insert($data);

		$this->movePage("groupware","listPageCrm");
	}

	// 고객수정
	public function updateCustomer(){
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_customer",
			"where"=>"uid=".$_POST['uid'],
			"customer_nm" => $_POST['customer_nm'],
			"customer_gb" => $_POST['customer_gb'],
			"customer_phone" => $_POST['customer_phone'],
			"customer_email" => $_POST['customer_email'],
			"customer_birthday" => $_POST['customer_birthday'],
			"customer_zipcode" => $_POST['customer_zipcode'],
			"customer_address" => $_POST['customer_address'],
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);

		$groupware = new Groupware;
		$groupware->update($data);

		$this->movePage("groupware","listPageCrm");
	}

	// 상담등록
	public function registCounsel() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_counsel",
			"fid" => $_POST['fid'],
			"counsel_gb" => $_POST['counsel_gb'],
			"counsel_dt" => $_POST['counsel_dt'],
			"counsel" => $_POST['counsel'],
			"emp_id"  => $_SESSION['login_id'],
			"create_dt" => $now
		);

		$groupware = new Groupware;
		$groupware->insert($data);

		$this->movePage("groupware","listPageCrm");
	}

	public function listPageSchedule(){
		require_once("views/groupware/listSchedule.php");
	}

	// 월간일정
	public function listPageScheduleMonth(){
		require_once("views/groupware/listScheduleMonth.php");
	}

	//주간일정
	public function listPageScheduleWeek(){
		require_once("views/groupware/listScheduleWeek.php");
	}

	//일간일정
	public function listPageScheduleDay(){
		require_once("views/groupware/listScheduleDay.php");
	}
	
	// 일정등록
	public function inputPageSchedule(){
		require_once("views/groupware/createSchedule.php");
	}

	// 일정상세
	public function modifyPageSchedule() {
		$t = Groupware::getSchedule($_GET['uid']);
		require_once("views/groupware/modifySchedule.php");
	}
	
	// 일정등록
	public function registSchedule() {
		$groupware = new Groupware;
		if(isset($_POST['uid'])) {
			$data = array(
				"table"=>"erp_schedule",
				"where"=>"uid=".$_POST['uid'],
				"title"=>$_POST['title'],
				"anniversary"=>$_POST['anniversary'],
				"schedule_gb"=>$_POST['schedule_gb'],
				"name"=>$_POST['name'],
				"schedule_dt"=>$_POST['schedule_dt'],
				"schedule_tm"=>$_POST['schedule_tm'],
				"place"=>$_POST['place'],
				"importance"=>$_POST['importance'],
				"memo"=>$_POST['memo'],
				"emp_id"=>$_SESSION['login_id']
			);
			$groupware->update($data);
		} else {
			$data = array(
				"table"=>"erp_schedule",
				"title"=>$_POST['title'],
				"anniversary"=>$_POST['anniversary'],
				"schedule_gb"=>$_POST['schedule_gb'],
				"name"=>$_POST['name'],
				"schedule_dt"=>$_POST['schedule_dt'],
				"schedule_tm"=>$_POST['schedule_tm'],
				"place"=>$_POST['place'],
				"importance"=>$_POST['importance'],
				"memo"=>$_POST['memo'],
				"emp_id"=>$_SESSION['login_id']
			);
			$groupware->insert($data);
		}

		$this->movePage("groupware","listPageSchedule");
	}

	// 출퇴근관리
	public function listPageEmpWorkLeave(){
		require_once("views/groupware/listEmpWorkLeave.php");
	}

	//시설물관리
	public function listPageInstallation(){
		require_once("views/groupware/listInstallation.php");
	}

	// 시설물등록
	public function inputPageInstallation() {
		require_once("views/groupware/createInstallation.php");
	}

	// 시설물 등록
	public function registInstallation() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');

		$in = explode("-",$_POST['in_dt']);
		$in_time = mktime(0,0,0,$in[1],$in[2],$in[0]);

		switch($_POST['change_gb']) {
			case "day" :
				$alarm_dt = $in_time + ($_POST['change_day'] * 86400);
			break;

			case "week" :
				$alarm_dt = $in_time + ($_POST['change_day'] * 86400 * 7);
			break;

			case "month" :
				$alarm_dt = $in_time + ($_POST['change_day'] * 86400 * 30);
			break;

			case "year" :
				$alarm_dt = $in_time + ($_POST['change_day'] * 86400 * 365);
			break;
		}

		$alarm = date("Y-m-d",$alarm_dt);

		$data = array(
			"table" => "erp_installation",
			"item_nm" => $_POST['item_nm'],
			"item_gb" => $_POST['item_gb'],
			"in_dt" => $_POST['in_dt'],
			"change_day" => $_POST['change_day'],
			"change_gb" => $_POST['change_gb'],
			"alarm_dt" => $alarm,
			"charge_id" => $_POST['emp_id'],
			"charge_nm" => $_POST['emp_nm'],
			"attach" => $fileAttach,
			"create_dt" => $now
		);
		$groupware = new Groupware;
		$groupware->insert($data);

		$this->movePage("groupware","listPageInstallation");
	}

		// 업무공유 리스트
	public function listPageVersion(){
		require_once("views/groupware/listVersion.php");
	}

	// 업무공유 페이지
	public function inputPageVersion() {
		require_once("views/groupware/createVersion.php");
	}
	
	// 업무공유 등록
	public function registVersion() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_version",
			"target" => $_POST['target'],
			"title" => $_POST['title'],
			"version" => $_POST['version'],
			"version_code" => $_POST['version_code'],
			"comment" => $_POST['comment'],
			"create_dt" => $now
		);
		$groupware = new Groupware;
		$groupware->insert($data);

		$this->movePage("groupware","listPageVersion");

	}

	
	public function listPageError(){
		require_once("views/groupware/listError.php");
	}

	// 업무공유 페이지
	public function inputPageError() {
		require_once("views/groupware/createError.php");
	}
	
	// 업무공유 등록
	public function registError() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_error",
			"account" => $_POST['account'],
			"title" => $_POST['title'],
			"comment" => $_POST['comment'],
			"create_dt" => $now
		);
		$groupware = new Groupware;
		$groupware->insert($data);

		$this->movePage("groupware","listPageError");

	}
}
?>