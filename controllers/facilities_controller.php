<?
//========================
// 설비관리 컨트럴러
// 생성일 : 2018-03-23
// 최종 수정일 : 2018-05-03
//========================

class FacilitiesController {

	public function __construct() {
		extract($_POST);
		extract($_GET);
	}
	
	public function movePage($controller,$action) {
		echo "<script>";
		echo "location.href = 'index.php?controller=".$controller."&action=".$action."' ";
		echo "</script>";
	}

	public function movePageClose($dialogId) {
		//echo $dialogId;
		echo "<script>";
		echo "window.parent.closeModal('".$dialogId."');";
		echo "window.parent.location.reload();";
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
	
	public function replaceComma($num) {
		$number = (int)str_replace(",","",$num);
		return $number;
	}
	

	// 설비 가동관리 리스트
	public function listPageFacilityManagement(){
		require_once ('views/facilities/listFacilityManagement.php');
	}
	
	//설비 가동관리 등록
	public function registPageFacilityManagement(){
		require_once ("views/facilities/createFacilityManagement_pop.php");
	}
	

	//설비 가동관리 수정
	public function modifyPageFacilityManagement() {
		$t = Facilities::getFacilitiesManagement($_GET['uid']);
		require_once('views/facilities/modifyFacilityManagement_pop.php');
	}

	public function insertPageFacilityManagement(){
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');

		$sql = "select max(facilities_cha) as cnt from erp_facility_management where facilities_dt='".$_POST['facilities_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$facilities_cha = "1";
		}else{
			$facilities_cha = $t0->cnt+1;
		}

		$facilities_cd  = $_POST['facilities_dt']."-".$facilities_cha;

		$data = array(
			"table" => "erp_facility_management",
			"facilities_cd" => $facilities_cd,
			"facilities_dt" => $_POST['facilities_dt'],
			"facilities_cha" => $facilities_cha,
			"day_gubun" => $_POST['day_gubun'],
			"process_cd" => $_POST['process_cd'],
			"process_nm" => $_POST['process_nm'],
			"machine_cd" => $_POST['machine_cd'],
			"machine_nm" => $_POST['machine_nm'],
			"f_work_tm1" => $_POST['f_work_tm1'],
			"f_work_tm2" => $_POST['f_work_tm2'],
			"f_work_tm" => $_POST['f_work_tm'],
			"f_off_tm1" => $_POST['f_off_tm1'],
			"f_off_tm2" => $_POST['f_off_tm2'],
			"f_off_tm" => $_POST['f_off_tm'],
			"office_hours" => $_POST['office_hours'],
			"model_no" => $_POST['model_no'],
			"problem_gb" => $_POST['problem_gb'],
			"f_off_type" => $_POST['f_off_type'],
			"p_content" => $_POST['p_content'],
			"a_content" => $_POST['a_content'],
			"operation_rate" => $_POST['operation_rate'],
			"emp_id" => $_POST['emp_id'],
			"emp_nm" => $_POST['emp_nm'],
			"receipt_dt" => $_POST['receipt_dt'],
			"handle_dt" => $_POST['handle_dt'],
			"writer"	=> $_POST['writer'],
			"regdate" => $now
		);

		$Facilities = new Facilities;
		$result = $Facilities->insert($data);
		$this->movePageClose($_POST['dialogId']);

	}

	public function updatePageFacilityManagement(){
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');

		$sql = "select max(facilities_cha) as cnt from erp_facility_management where facilities_dt='".$_POST['facilities_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$facilities_cha = "1";
		}else{
			$facilities_cha = $t0->cnt+1;
		}

		$facilities_cd  = $_POST['facilities_dt']."-".$facilities_cha;

		$data = array(
			"table" => "erp_facility_management",
			"where" => "uid=".$_POST['uid'],
			//"facilities_cd" => $facilities_cd,
			//"facilities_dt" => $_POST['facilities_dt'],
			//"facilities_cha" => $facilities_cha,
			"day_gubun" => $_POST['day_gubun'],
			"process_cd" => $_POST['process_cd'],
			"process_nm" => $_POST['process_nm'],
			"machine_cd" => $_POST['machine_cd'],
			"machine_nm" => $_POST['machine_nm'],
			"f_work_tm1" => $_POST['f_work_tm1'],
			"f_work_tm2" => $_POST['f_work_tm2'],
			"f_work_tm" => $_POST['f_work_tm'],
			"f_off_tm1" => $_POST['f_off_tm1'],
			"f_off_tm2" => $_POST['f_off_tm2'],
			"f_off_tm" => $_POST['f_off_tm'],
			"office_hours" => $_POST['office_hours'],
			"model_no" => $_POST['model_no'],
			"problem_gb" => $_POST['problem_gb'],
			"f_off_type" => $_POST['f_off_type'],
			"p_content" => $_POST['p_content'],
			"a_content" => $_POST['a_content'],
			"operation_rate" => $_POST['operation_rate'],
			"emp_id" => $_POST['emp_id'],
			"emp_nm" => $_POST['emp_nm'],
			"receipt_dt" => $_POST['receipt_dt'],
			"handle_dt" => $_POST['handle_dt'],
			"writer"	=> $_POST['writer'],
			"regdate" => $now
		);
		$Facilities = new Facilities;
		$result = $Facilities->update($data);
		$this->movePageClose($_POST['dialogId']);
	}
}
?>