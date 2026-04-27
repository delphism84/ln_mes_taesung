<?
session_start();
// 영업관리
class EmployeeController {
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
	public function inputPageEmployee() {
		require_once ("views/employee/createEmployee.php");
	}

	// 사원리스트 페이지
	public function listPageEmployee() {
		require_once ("views/employee/listEmployee.php");
	}

	public function modifyPageEmployee() {
		$t = Employee::getEmployee($_GET['uid']);
		require_once ("views/employee/modifyEmployee.php");
	}
	
	// 사원등록 실행
	public function registEmployee(){
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('img');
		if($_POST['resign_dt'] == "") $emp_gb = "work";
		else $emp_gb = "resign";
		$data = array(
			"table" => "erp_employee",
			"emp_gb" => $emp_gb,
			"emp_cd" => $_POST['emp_cd'],
			"emp_nm" => $_POST['emp_nm'],
			"emp_id" => $_POST['emp_id'],
			"emp_pwd" => $_POST['emp_pwd'],
			"sex_gb" => $_POST['sex_gb'],
			"regist_no" => $_POST['regist_no'],
			"emp_mobile" => $_POST['emp_mobile'],
			"emp_telephone" => $_POST['emp_telephone'],
			"emp_email" => $_POST['emp_email'],
			"join_dt" => $_POST['join_dt'],
			"resign_dt" => $_POST['resign_dt'],
			"department_cd" => $_POST['department_cd'],
			"department_nm" => $_POST['department_nm'],
			"position_cd" => $_POST['position_cd'],
			"position_nm" => $_POST['position_nm'],
			"emp_zipcode" => $_POST['emp_zipcode'],
			"emp_address" => $_POST['emp_address'],
			"img" => $fileAttach,
			"create_dt" => $now
		);

		$employee = new Employee;
		$result = $employee->registEmployee($data);
		if($result) $this->movePage("employee","listPageEmployee");
	}

	// 사원등록 실행
	public function updateEmployee(){
		$now = date("Y-m-d H:i:s");
		if($_POST['img'] != "") $fileAttach = $this->upload('img');
		else $fileAttach = $_POST['ori_img'];

		if($_POST['resign_dt'] == "" || $_POST['resign_dt'] == "0000-00-00") $emp_gb = "work";
		else $emp_gb = "resign";

		$data = array(
			"table" => "erp_employee",
			"where" => "uid=".$_POST['uid'],
			"emp_gb" => $emp_gb,
			"emp_cd" => $_POST['emp_cd'],
			"emp_nm" => $_POST['emp_nm'],
			"emp_id" => $_POST['emp_id'],
			"emp_pwd" => $_POST['emp_pwd'],
			"sex_gb" => $_POST['sex_gb'],
			"regist_no" => $_POST['regist_no'],
			"emp_mobile" => $_POST['emp_mobile'],
			"emp_telephone" => $_POST['emp_telephone'],
			"emp_email" => $_POST['emp_email'],
			"join_dt" => $_POST['join_dt'],
			"resign_dt" => $_POST['resign_dt'],
			"department_cd" => $_POST['department_cd'],
			"department_nm" => $_POST['department_nm'],
			"position_cd" => $_POST['position_cd'],
			"position_nm" => $_POST['position_nm'],
			"emp_zipcode" => $_POST['emp_zipcode'],
			"emp_address" => $_POST['emp_address'],
			"img" => $fileAttach
		);

		$employee = new Employee;
		$result = $employee->updateEmployee($data);
		if($result) $this->movePage("employee","listPageEmployee");
	}
/******************************************************************************************************
:: 부서 관련 함수들
******************************************************************************************************/	
	// 부서리스트 페이지
	public function listPageDepartment() {
		require_once ("views/employee/listDepartment.php");
	}

	// 부서등록 페이지
	public function inputPageDepartment() {
		require_once ("views/employee/createDepartment.php");
	}
	
	// 부서수정 페이지
	public function modifyPageDepartment() {
		$t = Employee::getDepartment($_GET['uid']);
		require_once ("views/employee/modifyDepartment.php");
	}
	
	// 부서등록 실행
	public function registDepartment() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_department",
			"department_nm" => $_POST['department_nm'],
			"seq" => $_POST['seq'],
			"create_dt" => $now
		);

		$employee = new Employee;
		$result = $employee->registDepartment($data);
		if($result) $this->movePage("employee","listPageDepartment");
	}

	// 부서수정 실행
	public function updateDepartment() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_department",
			"where" => "uid=".$_POST['uid'],
			"department_nm" => $_POST['department_nm'],
			"seq" => $_POST['seq']
		);

		$employee = new Employee;
		$result = $employee->updateDepartment($data);
		if($result) $this->movePage("employee","listPageDepartment");
	}
	
/******************************************************************************************************
:: 직위 관련 함수들
******************************************************************************************************/
	// 직위리스트 페이지
	public function listPagePosition() {
		require_once ("views/employee/listPosition.php");
	}

	// 직위등록 페이지
	public function inputPagePosition() {
		require_once ("views/employee/createPosition.php");
	}
	
	// 직위수정 페이지
	public function modifyPagePosition() {
		$t = Employee::getPosition($_GET['uid']);
		require_once ("views/employee/modifyPosition.php");
	}
	
	// 직위등록 실행
	public function registPosition() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_position",
			"position_nm" => $_POST['position_nm'],
			"seq" => $_POST['seq'],
			"create_dt" => $now
		);

		$employee = new Employee;
		$result = $employee->registPosition($data);
		if($result) $this->movePage("employee","listPagePosition");
	}
	
	// 직위수정 실행
	public function updatePosition() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_position",
			"where" => "uid=".$_POST['uid'],
			"position_nm" => $_POST['position_nm'],
			"seq" => $_POST['seq']
		);

		$employee = new Employee;
		$result = $employee->updatePosition($data);
		if($result) $this->movePage("employee","listPagePosition");
	}


	// 출하지시서 입력페이지
	public function inputPageShipment() {
		require_once ("views/sales/createShipment.php");
	}

/******************************************************************************************************
:: 일용직 관련 함수들
******************************************************************************************************/
	public function inputPageDailyWorker() {
		require_once ("views/employee/createDailyWorker.php");
	}

	public function listPageDailyWorker() {
		require_once ("views/employee/listDailyWorker.php");
	}

	public function modifyPageDailyWorker() {
		$t = Employee::getDailyWorker($_GET['uid']);
		require_once ("views/employee/modifyDailyWorker.php");
	}

	// 사원등록 실행
	public function registDailyWorker(){
		$now = date("Y-m-d H:i:s");
		if($_POST['resign_dt'] == "") $emp_gb = "work";
		else $emp_gb = "resign";
		$data = array(
			"table" => "erp_daily_worker",
			"emp_gb" => $emp_gb,
			"emp_cd" => $_POST['emp_cd'],
			"emp_nm" => $_POST['emp_nm'],
			"emp_id" => $_POST['emp_id'],
			"emp_pwd" => $_POST['emp_pwd'],
			"sex_gb" => $_POST['sex_gb'],
			"regist_no" => $_POST['regist_no'],
			"emp_mobile" => $_POST['emp_mobile'],
			"emp_telephone" => $_POST['emp_telephone'],
			"emp_email" => $_POST['emp_email'],
			"join_dt" => $_POST['join_dt'],
			"resign_dt" => $_POST['resign_dt'],
			"emp_zipcode" => $_POST['emp_zipcode'],
			"emp_address" => $_POST['emp_address'],
			"pay_gb" => $_POST['pay_gb'],
			"health_ins" => $_POST['health_ins'],
			"national_pension" => $_POST['national_pension'],
			"eldelry_ins" => $_POST['eldelry_ins'],
			"unemployment_ins" => $_POST['unemployment_ins'],
			"occupation" => $_POST['occupation'],
			"nationality" => $_POST['nationality'],
			"create_dt" => $now
		);

		$employee = new Employee;
		$result = $employee->registDailyWorker($data);
		if($result) $this->movePage("employee","listPageDailyWorker");
	}

	// 사원등록 실행
	public function updateDailyWorker(){
		$now = date("Y-m-d H:i:s");

		if($_POST['resign_dt'] == "" || $_POST['resign_dt'] == "0000-00-00") $emp_gb = "work";
		else $emp_gb = "resign";

		$data = array(
			"table" => "erp_daily_worker",
			"where" => "uid=".$_POST['uid'],
			"emp_gb" => $emp_gb,
			"emp_cd" => $_POST['emp_cd'],
			"emp_nm" => $_POST['emp_nm'],
			"emp_id" => $_POST['emp_id'],
			"emp_pwd" => $_POST['emp_pwd'],
			"sex_gb" => $_POST['sex_gb'],
			"regist_no" => $_POST['regist_no'],
			"emp_mobile" => $_POST['emp_mobile'],
			"emp_telephone" => $_POST['emp_telephone'],
			"emp_email" => $_POST['emp_email'],
			"join_dt" => $_POST['join_dt'],
			"resign_dt" => $_POST['resign_dt'],
			"emp_zipcode" => $_POST['emp_zipcode'],
			"emp_address" => $_POST['emp_address'],
			"pay_gb" => $_POST['pay_gb'],
			"health_ins" => $_POST['health_ins'],
			"national_pension" => $_POST['national_pension'],
			"eldelry_ins" => $_POST['eldelry_ins'],
			"unemployment_ins" => $_POST['unemployment_ins'],
			"occupation" => $_POST['occupation'],
			"nationality" => $_POST['nationality']
		);

		$employee = new Employee;
		$result = $employee->updateDailyWorker($data);
		if($result) $this->movePage("employee","listPageDailyWorker");
	}
}
?>