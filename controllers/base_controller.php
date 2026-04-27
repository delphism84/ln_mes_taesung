<?
session_start();
// 영업관리
class BaseController {
	public function __construct() {
		extract($_POST);
		extract($_GET);
	}
	
	public function movePage($controller,$action) {
		echo "<script>";
		echo "location.href = 'index.php?controller=".$controller."&action=".$action."' ";
		echo "</script>";
	}

	public function movePageClose($dialogID) {
		//echo $dialogID;
		echo "<script>";
		echo "window.parent.closeModal('".$dialogID."');";
		echo "window.parent.location.reload();";
		echo "</script>";
	}

	public function openWinClose($dialogID) {
		echo "<script>";
		echo "window.parent.closeModal('".$dialogID."');";
		echo "</script>";
	}
	
	public function replaceComma($num) {
		$number = (int)str_replace(",","",$num);
		return $this->convertZero($number);
	}

	// 숫자 0 반환
	public function convertZero($val) {
		if($val == null) return 0;
		else return $val;
	}

	public function replacefloat($num) {
		$number = (int)str_replace(",","",$num);
		return $number;
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

				//한글파일명 변환 20180911
				$filename = iconv("UTF-8", "cp949", $_FILES[$varName][name]);
				
				// 파일명 생성 및 존재하는지 검사
				// $newfile = md5($prefix.$_FILES[$varName][name]).".".$ext;
				// $newfile_name = $prefix.$_FILES[$varName][name];
				// 파일 이름중 띄어 쓰기가 들어가서 띄어쓰기 삭제
				 $newfile = $prefix.preg_replace("/\s+/","",$filename);
				
				//exit;
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
				
				//디비에 다시 저장하기 위한 한글파일명 변환 20180911
				$newfile = iconv("cp949", "UTF-8", $newfile);
				return $newfile;
			}
		} else {
			return "none";
		}
	}
	
		// 품목구분명으로 품목구분코드 가져오기
	public function getItemClassificationCd($classification) {
		$sql = "select uid from erp_item_classification where classify_nm='".$classification."'";
		$t = mysql_fetch_object(mysql_query($sql));
		return $t->uid;
	}

	public function begin() {
		mysql_query("START TRANSACTION");
	}

	public function commit() {
		mysql_query("COMMIT");
	}

	public function rollback() {
		mysql_query("ROLLBACK");
	}

/******************************************************************************************************
:: 품목관리
******************************************************************************************************/
	// 품목리스트 페이지
	public function listPageItem() {
		require_once ("views/base/listItem.php");
	}

	// 품목등록 페이지
	public function inputPageItem(){
		require_once ('views/base/createItem.php');
	}
	
	// 품목등록 실행
	public function registItem(){
		// 업로드 파일이 없을 경우를 대비해야 함
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('img');

		if($_POST['barcode']=="") $barcode = $_POST['item_cd'];
		else $barcode = $_POST['barcode'];

		$data = array (
			"table" => "erp_item",
			"item_cd" => $_POST['item_cd'],
			"item_nm" => $_POST['item_nm'],
			"unit" => $_POST['unit'],
			"standard1" => $_POST['standard1'],
			"standard2" => $_POST['standard2'],
			"standard3" => $_POST['standard3'],
			"material" => $_POST['material'],	
			"min_pur_unit" => $this->replaceComma($_POST['min_pur_unit']),
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"delivery_period" => $this->convertZero($_POST['delivery_period']),
			"base_stock_cnt" => $this->replaceComma($_POST['base_stock_cnt']),
			"safety_stock_cnt" => $this->replaceComma($_POST['safety_stock_cnt']),
			"item_gb" => $_POST['item_gb'],
			"item_group_cd" => $_POST['item_group_cd'],
			"item_group_nm" => $_POST['item_group_nm'],
			"pur_unit_price" => $this->convertZero($_POST['pur_unit_price']),
			"unit_price" => $this->convertZero($_POST['unit_price']),
			"in_barcode" => $_POST['in_barcode'],
			"barcode" => $barcode,
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"process_cd"	 => $_POST['process_cd'],
			"process_nm"	=> $_POST['process_nm'],
			"ranking"	=> $this->convertZero($_POST['ranking']),
			"img" => $fileAttach,
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);

		$base = new Base;
		$base->insert($data);
		
		// 전체재고에 넣기
		$stockData = array (
			"table" => "erp_stock",
			"fid" => mysql_insert_id(),
			"item_cd" => $_POST['item_cd'],
			"standard1" => $_POST['standard1'],
			"standard2" => $_POST['standard2'],
			"standard3" => $_POST['standard3'],
			"material" => $_POST['material'],
			"pur_cnt" => $this->replaceComma($_POST['base_stock_cnt']),
			"pur_unit_price" => $this->replaceComma($_POST['pur_unit_price']),
			"remain_cnt" => $this->replaceComma($_POST['base_stock_cnt']),
			"warehouse_cd" => $_POST['warehouse_cd'],
			"in_date" => $now
		);
		$base->insert($stockData);

		$total_price = $_POST['base_stock_cnt'] * $_POST['pur_unit_price'];

		// 입출고내역에 넣기
		$stockInoutData = array (
			"table" => "erp_stock_inout",
			"account_cd" => $_POST['account_cd'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"item_cd" => $_POST['item_cd'],
			"standard1" => $_POST['standard1'],
			"standard2" => $_POST['standard2'],
			"material" => $_POST['material'],
			"in_cnt" => $this->replaceComma($_POST['base_stock_cnt']),
			"out_cnt" => 0,
			"remain_cnt" => $this->replaceComma($_POST['base_stock_cnt']),
			"pur_unit_price" => $this->replaceComma($_POST['pur_unit_price']),
			"total_price" => $this->replaceComma($total_price),
			"used" => "n",
			"lot_no" => $_POST['item_cd']."-".time(),
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);
		$base->insert($stockInoutData);

		// 사유에 넣기
		$reasonData = array (
			"table" => "erp_reason",
			"fid" => mysql_insert_id(),
			"item_cd" => $_POST['item_cd'],
			"standard1" => $_POST['standard1'],
			"standard2" => $_POST['standard2'],
			"standard3" => $_POST['standard3'],
			"in_cnt" => $this->replaceComma($_POST['base_stock_cnt']),
			"out_cnt" => 0,
			"reason" => "기초입고수량",
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);
		$base->insert($reasonData);

		$this->movePage("base","listPageItem");		
	}
	
	// 품목수정 페이지
	public function modifyPageItem() {
		$t = Base::get( $_GET['uid'], "item" );
		require_once ("views/base/modifyItem.php");
	}
	
	// 품목수정 실행
	public function updateItem(){
		$base = new Base;
		$now = date("Y-m-d H:i:s");
		// 같은 품목명 다른 규격을 감안하여
		$sql = "select item_cd,standard1 from erp_item where uid=".$_POST['uid'];
		//echo $sql; 
		$item = mysql_fetch_object(mysql_query($sql));

		//if($item->item_cd == $_POST['item_cd'] && $item->standard1 == $_POST['standard1'] ) {
			$fileAttach = $this->upload('img');
			if($fileAttach == "none") $fileAttach = $_POST['attach'];

			if($_POST['barcode']=="") $barcode = $_POST['item_cd'];
			else $barcode = $_POST['barcode'];

			$data = array (
				"table" => "erp_item",
				"where" => "uid=".$_POST['uid'],
				"item_nm" => $_POST['item_nm'],
				"unit" => $_POST['unit'],
				"standard1" => $_POST['standard1'],
				"standard2" => $_POST['standard2'],
				"standard3" => $_POST['standard3'],
				"material" => $_POST['material'],
				"min_pur_unit" => $_POST['min_pur_unit'],
				"account_cd" => $_POST['account_cd'],
				"account_nm" => $_POST['account_nm'],
				"delivery_period" => $_POST['delivery_period'],
				"base_stock_cnt" => $this->replaceComma($_POST['base_stock_cnt']),
				"safety_stock_cnt" => $this->replaceComma($_POST['safety_stock_cnt']),
				"item_gb" => $_POST['item_gb'],
				"item_group_cd" => $_POST['item_group_cd'],
				"item_group_nm" => $_POST['item_group_nm'],
				"pur_unit_price" => $_POST['pur_unit_price'],
				"unit_price" => $_POST['unit_price'],
				"in_barcode" => $_POST['in_barcode'],
				"barcode"	=> $barcode,
				"warehouse_cd" => $_POST['warehouse_cd'],
				"warehouse_nm" => $_POST['warehouse_nm'],
				"process_cd"	 => $_POST['process_cd'],
				"process_nm"	=> $_POST['process_nm'],
				"ranking"	=> $_POST['ranking'],	
				"img" => $fileAttach,
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => $now
			);

			$result = $base->update($data);

			//$base->deleteStock($_POST['item_cd'],$_POST['standard']);

			//만약 재고 테이블에 없으면 인서트 20180521
			$sql = "select item_cd, standard1 from erp_stock where item_cd='".$_POST['item_cd'] ."' and standard1='".$_POST['standard1']."'";
			//$sql = "select item_cd, standard1 from erp_stock where item_cd='".$_POST['item_cd']."'";
			//echo $sql; 
			$s = mysql_fetch_object(mysql_query($sql));
			
			if($s->item_cd==""){ 
			// 전체재고에 넣기
			$stockData = array (
				"table"		=> "erp_stock",
				"fid"		=> $_POST['uid'],
				"item_cd"	=> $_POST['item_cd'],
				"standard1" => $_POST['standard1'],
				"material" => $_POST['material'],
				"pur_cnt"	=> $this->replaceComma($_POST['base_stock_cnt']),
				"pur_unit_price" => $_POST['pur_unit_price'],
				"remain_cnt" => $this->replaceComma($_POST['base_stock_cnt']),
				"warehouse_cd" => $_POST['warehouse_cd'],
				"in_date" => $now
			);
			$base->insert($stockData);

			$total_price = $_POST['base_stock_cnt'] * $_POST['pur_unit_price'];

			// 입출고내역에 넣기
			$stockInoutData = array (
				"table" => "erp_stock_inout",
				"account_cd" => $_POST['account_cd'],
				"warehouse_cd" => $_POST['warehouse_cd'],
				"item_cd" => $_POST['item_cd'],
				"standard1" => $_POST['standard1'],
				"material" => $_POST['material'],
				"in_cnt" => $this->replaceComma($_POST['base_stock_cnt']),
				"out_cnt" => 0,
				"remain_cnt" => $this->replaceComma($_POST['base_stock_cnt']),
				"pur_unit_price" => $_POST['pur_unit_price'],
				"total_price" => $this->replaceComma($total_price),
				"used" => "n",
				"lot_no" => $_POST['item_cd']."-".time(),
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => $now
			);
			$base->insert($stockInoutData);
			}

			$stockData = array (
				"table" => "erp_stock",
				"where" => "fid=".$_POST['uid'],
				"pur_unit_price" => $_POST['pur_unit_price']
			);
			$base->update($stockData);
		//}
		$this->movePage("base","listPageItem");		
	}

/******************************************************************************************************
:: 거래처관리
******************************************************************************************************/
	// 거래처 리스트 페이지
	public function listPageAccount() {
		require_once ("views/base/listAccount.php");
	}

	// 거래처 등록 페이지
	public function inputPageAccount() {
		require_once ("views/base/createAccount.php");
	}

	// 거래처 등록 실행
	public function registAccount(){
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_account",
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
			"manager" => $_POST['manager'],
			"account_id" => $_POST['account_id'],
			"account_pwd" => $_POST['account_pwd'],
			"create_dt" => $now
		);

		$base = new Base;
		$base->insert($data);
		$this->movePage("base","listPageAccount");
	}

	// 거래처 수정 페이지
	public function modifyPageAccount() {
		$t = Base::get($_GET['uid'],"account");
		require_once ("views/base/modifyAccount.php");
	}

	// 거래처 수정 실행
	public function updateAccount() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_account",
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
			"manager" => $_POST['manager'],
			"account_id" => $_POST['account_id'],
			"account_pwd" => $_POST['account_pwd'],
			"create_dt" => $now
		);
		$base = new Base;
		$base->update($data);
		$this->movePage("base","listPageAccount");
	}
/******************************************************************************************************
:: 부서관리
******************************************************************************************************/
	// 부서 리스트 페이지
	public function listPageDepartment() {
		require_once ("views/base/listDepartment.php");
	}

	// 부서등록 실행
	public function registDepartment() {
		$base = new Base;
		$now = date("Y-m-d H:i:s");
		if(isset($_POST['uid'])) {
			$data = array(
				"table" => "erp_department",
				"where" => "uid=".$_POST['uid'],
				"department_nm" => $_POST['department_nm'],
				"seq" => $_POST['seq']
			);
			$base->update($data);

		} else {
			$data = array(
				"table" => "erp_department",
				"fid" => 0,
				"department_nm" => $_POST['department_nm'],
				"seq" => $_POST['seq'],
				"create_dt" => $now
			);
			$base->insert($data);
		}
		$this->movePage("base","listPageDepartment");
	}

		// 부서 리스트 페이지
	public function listPageDepartmentN() {
		require_once ("views/base/listDepartmentN.php");
	}
/******************************************************************************************************
:: 직위관리
******************************************************************************************************/
	// 직위 리스트 페이지
	public function listPagePosition() {
		require_once ("views/base/listPosition.php");
	}

	// 직위 등록 페이지
	public function inputPagePosition() {
		require_once ("views/base/createPosition.php");
	}

	// 직위 등록 실행
	public function registPosition() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_position",
			"position_nm" => $_POST['position_nm'],
			"seq" => $_POST['seq'],
			"create_dt" => $now
		);

		$base = new Base;
		$base->insert($data);
		$this->movePage("base","listPagePosition");
	}

	// 직위 수정 페이지
	public function modifyPagePosition() {
		$t = Base::get($_GET['uid'],"position");
		require_once ("views/base/modifyPosition.php");
	}

	// 직위 수정 실행
	public function updatePosition() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_position",
			"where" => "uid=".$_POST['uid'],
			"position_nm" => $_POST['position_nm'],
			"seq" => $_POST['seq']
		);

		$base = new Base;
		$base->update($data);
		if($result) $this->movePage("base","listPagePosition");
	}
/******************************************************************************************************
:: 사원관리
******************************************************************************************************/
	// 사원 리스트 페이지
	public function listPageEmployee() {
		require_once ("views/base/listEmployee.php");
	}

	// 사원 등록 페이지
	public function inputPageEmployee() {
		require_once ("views/base/createEmployee.php");
	}

	// 사원 등록 실행
	public function registEmployee() {
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
			"process_gb" => $_POST['process_gb'],
			"regist_no" => $_POST['regist_no'],
			"emp_mobile" => $_POST['emp_mobile'],
			"emp_telephone" => $_POST['emp_telephone'],
			"emp_email" => $_POST['emp_email'],
			"join_dt" => $_POST['join_dt'],
			"resign_dt" => $_POST['resign_dt'],
			"big_department_cd" => $_POST['big_department_cd'],
			"big_department_nm" => getBigDepartmentName($_POST['big_department_cd']),
			"middle_department_cd" => $_POST['middle_department_cd'],
			"middle_department_nm" => getMiddleDepartmentName($_POST['middle_department_cd']),
			"small_department_cd" => $_POST['small_department_cd'],
			"small_department_nm" => getSmallDepartmentName($_POST['small_department_cd']),
			"position_cd" => $_POST['position_cd'],
			"position_nm" => $_POST['position_nm'],
			"emp_zipcode" => $_POST['emp_zipcode'],
			"emp_address" => $_POST['emp_address'],
			"img" => $fileAttach,
			"create_dt" => $now
		);

		$base = new Base;
		$base->insert($data);
		$this->movePage("base","listPageEmployee");
	}

	// 사원 수정 페이지
	public function modifyPageEmployee() {
		$t = Base::get($_GET['uid'],"employee");
		require_once ("views/base/modifyEmployee.php");
	}

	// 사원 수정 실행
	public function updateEmployee() {
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
			"process_gb" => $_POST['process_gb'],
			"regist_no" => $_POST['regist_no'],
			"emp_mobile" => $_POST['emp_mobile'],
			"emp_telephone" => $_POST['emp_telephone'],
			"emp_email" => $_POST['emp_email'],
			"join_dt" => $_POST['join_dt'],
			"resign_dt" => $_POST['resign_dt'],
			"big_department_cd" => $_POST['big_department_cd'],
			"big_department_nm" => getBigDepartmentName($_POST['big_department_cd']),
			"middle_department_cd" => $_POST['middle_department_cd'],
			"middle_department_nm" => getMiddleDepartmentName($_POST['middle_department_cd']),
			"small_department_cd" => $_POST['small_department_cd'],
			"small_department_nm" => getSmallDepartmentName($_POST['small_department_cd']),
			"position_cd" => $_POST['position_cd'],
			"position_nm" => $_POST['position_nm'],
			"emp_zipcode" => $_POST['emp_zipcode'],
			"emp_address" => $_POST['emp_address'],
			"img" => $fileAttach
		);

		$base = new Base;
		$base->update($data);
		$this->movePage("base","listPageEmployee");
	}
/******************************************************************************************************
:: 창고관리
******************************************************************************************************/
	// 창고 리스트 페이지
	public function listPageWarehouse() {
		require_once ("views/base/listWarehouse.php");
	}

	public function listPageWarehousePop() {
		require_once ("views/popup/warehouseList.php");
	}
	
	// 창고 등록 페이지
	public function inputPageWarehouse() {
		require_once ("views/base/createWarehouse.php");
	}

	// 창고 등록 실행
	public function registWarehouse() {
		$now = date("Y-m-d H:i:s");

		$data = array (
			"table" => "erp_warehouse",
			"warehouse_gb" => $_POST['warehouse_gb'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"process_nm" => $_POST['process_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"create_dt" => $now
		);

		$base = new Base;
		$base->insert($data);
		$this->movePage("base","listPageWarehouse");
	}

	// 창고 수정 페이지
	public function modifyPageWarehouse() {
		$t = Base::get($_GET['uid'],"warehouse");
		require_once ("views/base/modifyWarehouse.php");
	}

	// 창고 수정 실행
	public function updateWarehouse() {
		$now = date("Y-m-d H:i:s");
		$data = array (
			"table" => "erp_warehouse",
			"where" => "uid=".$_POST['uid'],
			"warehouse_gb" => $_POST['warehouse_gb'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"process_nm" => $_POST['process_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm']
		);

		$base = new Base;
		$base->update($data);
		$this->movePage("base","listPageWarehouse");
	}
/******************************************************************************************************
:: 공정관리
******************************************************************************************************/
	// 공정 리스트 페이지
	public function listPageProcess() {
		require_once ("views/base/listProcess.php");
	}

	// 공정 등록 페이지
	public function inputPageProcess() {
		require_once ("views/base/createProcess.php");
	}

	// 공정 등록 실행
	public function registProcess() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_process",
			"process_gb" => $_POST['process_gb'],
			"process_cd" => $_POST['process_cd'],
			"process_nm" => $_POST['process_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"create_dt" => $now
		);

		$base = new Base;
		$base->insert($data);
		$this->movePage("base","listPageProcess");
	}

	// 공정 수정 페이지
	public function modifyPageProcess() {
		$t = Base::get($_GET['uid'],"process");
		require_once ("views/base/modifyProcess.php");
	}

	// 공정 수정 실행
	public function updateProcess() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_process",
			"where" => "uid=".$_POST['uid'],
			"process_gb" => $_POST['process_gb'],
			"process_cd" => $_POST['process_cd'],
			"process_nm" => $_POST['process_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm']
		);

		$base = new Base;
		$base->update($data);
		$this->movePage("base","listPageProcess");
	}
/******************************************************************************************************
:: 생산기계관리
******************************************************************************************************/
	// 생산기기 리스트 페이지
	public function listPageMachine() {
		require_once ("views/base/listMachine.php");
	}

	// 생산기기 등록 페이지
	public function inputPageMachine() {
		require_once ("views/base/createMachine.php");
	}

	// 생산기기 등록 실행
	public function registMachine() {
		$data = array(
			"table" => "erp_machine",
			"process_cd" => $_POST['process_cd'],
			"machine_nm" => $_POST['machine_nm']
		);
		
		$base = new Base;
		$base->insert($data);

		$this->movePage("base","listPageMachine");
	}

	// 생산기기 수정 페이지
	public function modifyPageMachine() {
		$t = Base::get($_GET['uid'],"machine");
		require_once ("views/base/modifyMachine.php");
	}

	// 생산기기 수정 실행
	public function updateMachine() {

	}
/******************************************************************************************************
:: 프로젝트관리
******************************************************************************************************/
	// 프로젝트 리스트 페이지
	public function listPageProject() {
		require_once ("views/base/listProject.php");
	}

	// 프로젝트 등록 페이지
	public function inputPageProject() {
		require_once ("views/base/createProject.php");
	}

	// 프로젝트 등록 실행
	public function registProject() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_project",
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"emp_id" => $_POST['emp_id'],
			"emp_nm" => $_POST['emp_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"project_gb" => $_POST['project_gb'],
			"start_dt" => $_POST['start_dt'],
			"end_dt" => $_POST['end_dt'],
			"create_dt" => $now
		);

		$base = new Base;
		$base->insert($data);
		

		

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
					$base->insert($attach_data);
				}
			}
		} 
		$this->movePage("base","listPageProject");
	}

	// 프로젝트 수정 페이지
	public function modifyPageProject() {
		$t = Base::get($_GET['uid'],"project");
		require_once ("views/base/modifyProject.php");
	}

	// 프로젝트 수정 실행
	public function updateProject() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_project",
			"where" => "uid=".$_POST['uid'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"emp_id" => $_POST['emp_id'],
			"emp_nm" => $_POST['emp_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"project_gb" => $_POST['project_gb'],
			"start_dt" => $_POST['start_dt'],
			"end_dt" => $_POST['end_dt'],
			"create_dt" => $now
		);

		$base = new Base;
		$base->update($data);
		

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
					$base->insert($attach_data);
				}
			}
		} 
		$this->movePage("base","listPageProject");
	}
/******************************************************************************************************
:: 엑셀업로드
******************************************************************************************************/
	public function inputPageExcel() {
		require_once ("views/base/createExcel.php");
	}

	public function registExcel() {
		$base = new Base;

		ini_set("memory_limit", -1);
		error_reporting(E_ALL ^ E_NOTICE);
		require_once $_SERVER['DOCUMENT_ROOT']."/library/excel_reader2.php";
		echo ('<meta http-equiv="content-type" content="text/html; charset=utf-8">');

		// 저장될 디비 테이블명
		$TABLE_NAME = $table_name;
		// 저장될 디렉토리
		$upfile_dir = $_SERVER['DOCUMENT_ROOT']."/attach/excel";
		//CSV데이타 추출시 한글깨짐방지
		setlocale(LC_CTYPE, 'ko_KR.eucKR'); // CSV 한글 깨짐 문제
		//장시간 데이터 처리될경우
		set_time_limit(0);

		$upfile_name = $_FILES['attach']['name']; // 파일이름
		$upfile_type = $_FILES['attach']['type']; // 확장자
		$upfile_size = $_FILES['attach']['size']; // 파일크기
		$upfile_tmp  = $_FILES['attach']['tmp_name']; // 임시 디렉토리에 저장된 파일명

		//확장자 확인
		if(preg_match("/(\.(xls|XLS))$/i",$upfile_name)) { //|xlsx|XLSX
		} else {
			echo ("<script>window.alert('업로드를 할수 없는 파일 입니다.\\n\\r확장자가 [xls]인 경우만 업로드가 가능합니다.'); history.go(-1) </script>");
			exit;
		}
		if ($upfile_name){
		//폴더내에 동일한 파일이 있는지 검사하고 있으면 삭제
			if (file_exists("{$upfile_dir}/{$upfile_name}") ) { unlink("{$upfile_dir}/{$upfile_name}"); }
			if ( strlen($upfile_size) < 7 ) {
				$filesize = sprintf("%0.2f KB", $upfile_size/100000);
			} else{
				$filesize = sprintf("%0.2f MB", $upfile_size/100000000);
			}
			 
			if (move_uploaded_file($upfile_tmp,"{$upfile_dir}/{$upfile_name}")) {
			} else {
				echo ("<script>window.alert('디렉토리에 복사실패'); history.go(-1) </script>");
				exit;
			}
			chmod("{$upfile_dir}/{$upfile_name}",0777); 
			//chown("{$upfile_dir}/{$upfile_name}",'nobody'); 
		}

		$excel = new Spreadsheet_Excel_Reader("{$upfile_dir}/{$upfile_name}");
		$excel->setOutputEncoding('UTF-8');

		// 엑셀 첫번째 sheet 행 개수
		$rowcount = $excel->rowcount($sheet_index=0);
		$missDataCnt = 0; //중복된 데이터 카운트
		$counts=0;
		$first_num=0;
		$last_num=0;

		for($i=2 ;$i<=$rowcount; $i++){
			switch ($_POST['excel_gb']) {
				case "item":	
					$now = date("Y-m-d H:i:s");
					$item_gb = trim(addslashes(strip_tags($excel->val($i,1))));		
					$item_group_cd = trim(addslashes(strip_tags($excel->val($i,2))));	
					$item_cd = strtoupper(trim(addslashes(strip_tags($excel->val($i,3)))));	
					$item_nm = trim(addslashes(strip_tags($excel->val($i,4))));
					$unit = trim(addslashes(strip_tags($excel->val($i,5))));
					$standard1 = trim(addslashes(strip_tags($excel->val($i,6))));
					$standard2 = trim(addslashes(strip_tags($excel->val($i,7))));
					$standard3 = trim(addslashes(strip_tags($excel->val($i,8))));
					$material = trim(addslashes(strip_tags($excel->val($i,9))));
					$min_pur_unit = $this->replaceComma(trim(addslashes(strip_tags($excel->val($i,10)))));
					$warehouse_nm = trim(addslashes(strip_tags($excel->val($i,11))));
					$account_nm = trim(addslashes(strip_tags($excel->val($i,12))));
					$delivery_period = $this->replaceComma(trim(addslashes(strip_tags($excel->val($i,13)))));
					$base_stock_cnt = $this->replaceComma(trim(addslashes(strip_tags($excel->val($i,14)))));
					$safety_stock_cnt = $this->replaceComma(trim(addslashes(strip_tags($excel->val($i,15)))));
					$pur_unit_price = $this->replaceComma(trim(addslashes(strip_tags($excel->val($i,16)))));
					$unit_price = $this->replaceComma(trim(addslashes(strip_tags($excel->val($i,17)))));
					$in_barcode = trim(addslashes(strip_tags($excel->val($i,18))));
					$barcode = trim(addslashes(strip_tags($excel->val($i,19))));
					
					switch($item_gb) {
						case "자재" : 
							$new_item_gb = "component"; 
							$pre = "C-";
						break;

						case "반제품" : 
							$new_item_gb = "semi_product"; 
							$pre = "S-";
						break;

						case "완제품" : 
							$new_item_gb = "product"; 
							$pre = "P-";
						break;
					}

					if($item_cd == "") $item_cd = $pre.mt_rand(100000000,999999999);
					if($barcode == "") $barcode = $item_cd;
					
					/*
					$item_cd = str_replace("'","",$item_cd);
					$item_cd = str_replace('"',"",$item_cd);
					$item_nm = str_replace("'","",$item_nm);
					$item_nm = str_replace('"',"",$item_nm);
					$unit = str_replace('"',"",$unit);
					$unit = str_replace('"',"",$unit);
					$standard1 = str_replace('"',"",$standard1);
					$standard1 = str_replace('"',"",$standard1);
					$standard2 = str_replace('"',"",$standard2);
					$standard2 = str_replace('"',"",$standard2);
					$standard3 = str_replace('"',"",$standard3);
					$standard3 = str_replace('"',"",$standard3);
					*/

					//홑, 쌍따옴표 php.ini magic_quotes_gpc = on;
					$item_cd	= str_replace("'", "''",$item_cd);
					$item_cd	= str_replace("'", "''",$item_cd);
					$item_nm	= str_replace("'", "''",$item_nm);
					$item_nm	= str_replace("'", "''",$item_nm);
					$unit		= str_replace("'", "''",$unit);
					$unit		= str_replace("'", "''",$unit);
					$standard1	= str_replace("'", "''",$standard1);
					$standard1	= str_replace("'", "''",$standard1);
					$standard2	= str_replace("'", "''",$standard2);
					$standard2	= str_replace("'", "''",$standard2);
					$standard3	= str_replace("'", "''",$standard3);
					$standard3	= str_replace("'", "''",$standard3);
					$material	= str_replace("'", "''",$material);

					$data = array (
						"table" => "erp_item",
						"item_gb" => $new_item_gb,
						"item_cd" => $item_cd,
						"item_nm" => $item_nm,
						"unit" => $unit,
						"standard1" => $standard1,
						"standard2" => $standard2,
						"standard3" => $standard3,
						"material"=> $material,
						"min_pur_unit" => $this->replaceComma($min_pur_unit),
						"warehouse_cd" => getWarehouseCode($warehouse_nm),
						"warehouse_nm" => $warehouse_nm,
						"account_cd" => getAccountCode($account_nm),
						"account_nm" => $account_nm,
						"delivery_period" => $this->replaceComma($delivery_period),
						"base_stock_cnt" => $this->replaceComma($base_stock_cnt),
						"safety_stock_cnt" => $this->replaceComma($safety_stock_cnt),
						"pur_unit_price" => $this->replaceComma($pur_unit_price),
						"unit_price" => $this->replaceComma($unit_price),
						"in_barcode" => $in_barcode,
						"barcode" => $barcode,
						"emp_id" => $_SESSION['login_id'],
						"create_dt" => $now
					);
					$base->insert($data);	
					
					// 전체재고에 넣기
					$stockData = array (
						"table" => "erp_stock",
						"fid" => mysql_insert_id(),
						"item_cd" => $item_cd,
						"standard1" => $standard1,
						"standard2" => $standard2,
						"standard3" => $standard3,
						"material"=> $material,
						"pur_cnt" => $this->replaceComma($base_stock_cnt),
						"pur_unit_price" => $this->replaceComma($pur_unit_price),
						"remain_cnt" => $this->replaceComma($base_stock_cnt),
						"warehouse_cd" => getWarehouseCode($warehouse_nm),
						"in_date" => $now
					);
					$base->insert($stockData);

					$total_price = $base_stock_cnt * $pur_unit_price;

					// 입출고내역에 넣기
					$stockInoutData = array (
						"table" => "erp_stock_inout",
						"account_cd" => getAccountCode($account_nm),
						"warehouse_cd" => getWarehouseCode($warehouse_nm),
						"item_cd" => $item_cd,
						"standard1" => $standard1,
						"standard2" => $standard2,
						"standard3" => $standard3,
						"material"=> $material,
						"in_cnt" => $this->replaceComma($base_stock_cnt),
						"out_cnt" => 0,
						"remain_cnt" => $this->replaceComma($base_stock_cnt),
						"pur_unit_price" => $this->replaceComma($pur_unit_price),
						"total_price" => $this->replaceComma($total_price),
						"used" => "n",
						"lot_no" => $item_cd."-".time(),
						"emp_id" => $_SESSION['login_id'],
						"create_dt" => $now
					);
					$base->insert($stockInoutData);

					// 사유에 넣기
					$reasonData = array (
						"table" => "erp_reason",
						"fid" => mysql_insert_id(),
						"item_cd" => $item_cd,
						"standard1" => $standard1,
						"standard2" => $standard2,
						"standard3" => $standard3,
						"material"=> $material,
						"in_cnt" => $this->replaceComma($base_stock_cnt),
						"out_cnt" => 0,
						"reason" => "기초입고수량",
						"emp_id" => $_SESSION['login_id'],
						"create_dt" => $now
					);
					$base->insert($reasonData);

				break;

				case "bom":	
					$now = date("Y-m-d H:i:s");
					$item_cd = strtoupper(trim(addslashes(strip_tags($excel->val($i,1)))));		
					$item_nm = trim(addslashes(strip_tags($excel->val($i,2))));	
					$material = trim(addslashes(strip_tags($excel->val($i,3))));	
					$standard1 = trim(addslashes(strip_tags($excel->val($i,4))));	
					$unit = trim(addslashes(strip_tags($excel->val($i,5))));
					$cnt = trim(addslashes(strip_tags($excel->val($i,6))));
					$cnt = round($cnt,2);
					
					$unit = str_replace("×","X",$unit);

					$item_cd = str_replace("'","",$item_cd);
					$item_cd = str_replace('"',"",$item_cd);
					
					$item_nm = str_replace("'","",$item_nm);
					$item_nm = str_replace('"',"",$item_nm);

					/*
					$unit = str_replace('"',"",$unit);
					$unit = str_replace('"',"",$unit);
					$standard1 = str_replace('"',"",$standard1);
					*/

					if($cnt <= "0") {
						$sql = "select uid from erp_item where item_cd='".$item_cd."' and standard1='".$standard1."'";
						$item = mysql_fetch_object(mysql_query($sql));
						$_SESSION['fid'] = $item->uid;
					} else {
						
						//$sql = "select uid from erp_item where item_cd='".$item_cd."' and standard1='".$standard1."'";
						//$item = mysql_fetch_object(mysql_query($sql));
						//echo $sql."<BR>";
						//$fid = $item->uid;
						//echo "fid=".$fid."<RB>";

						$data = array (
							"table" => "erp_bom",
							"fid" => $_SESSION['fid'],
							"item_cd" => $item_cd,
							"item_nm" => $item_nm,
							"standard1" => $standard1,
							"material" => $material,
							"unit" => $unit,
							"cnt" => $cnt,
							"regdate" => $now
						);
						$base->insert($data);
					}
					unset($fid);
				break;

				case "employee":	
					$now = date("Y-m-d H:i:s");
					$emp_cd = trim(addslashes(strip_tags($excel->val($i,1))));		
					$emp_nm = trim(addslashes(strip_tags($excel->val($i,2))));	
					$emp_id = trim(addslashes(strip_tags($excel->val($i,3))));	
					$emp_pwd = trim(addslashes(strip_tags($excel->val($i,4))));
					$sex_gb = trim(addslashes(strip_tags($excel->val($i,5))));
					$emp_mobile = trim(addslashes(strip_tags($excel->val($i,6))));
					$big_department = trim(addslashes(strip_tags($excel->val($i,7))));
					$middle_department = trim(addslashes(strip_tags($excel->val($i,8))));
					$small_department = trim(addslashes(strip_tags($excel->val($i,9))));
					$position = trim(addslashes(strip_tags($excel->val($i,10))));
					$join_dt = trim(addslashes(strip_tags($excel->val($i,11))));
					$email = trim(addslashes(strip_tags($excel->val($i,12))));

					$data = array (
						"table" => "erp_employee",
						"emp_gb" => "work",
						"emp_cd" => $emp_cd,
						"emp_nm" => $emp_nm,
						"emp_id" => $emp_id,
						"emp_pwd" => $emp_pwd,
						"sex_gb" => $sex_gb,
						"big_department_cd" => getBigDepartmentCd($big_department),
						"big_department_nm" => $big_department,
						"middle_department_cd" => getMiddleDepartmentCd($middle_department),
						"middle_department_nm" => $middle_department,
						"small_department_cd" => getSmallDepartmentCd($small_department),
						"small_department_nm" => $small_department,
						"position_cd" => getPositionCd($position),
						"position_nm" => $position,
						"emp_email" => $email,
						"join_dt" => $join_dt,
						"emp_mobile" => $emp_mobile,
						"create_dt" => $now
					);
					$base->insert($data);							
				break;

				case "account":	
					$now = date("Y-m-d H:i:s");
					$account_gb = trim(addslashes(strip_tags($excel->val($i,1))));		
					$account_cd = trim(addslashes(strip_tags($excel->val($i,2))));	
					$account_nm = trim(addslashes(strip_tags($excel->val($i,3))));	
					$owner = trim(addslashes(strip_tags($excel->val($i,4))));
					$owner_mobile = trim(addslashes(strip_tags($excel->val($i,5))));
					$corp_reg_no = trim(addslashes(strip_tags($excel->val($i,6))));
					$corp_condition = trim(addslashes(strip_tags($excel->val($i,7))));
					$corp_event = trim(addslashes(strip_tags($excel->val($i,8))));
					$corp_phone = trim(addslashes(strip_tags($excel->val($i,9))));
					$corp_fax = trim(addslashes(strip_tags($excel->val($i,10))));
					$corp_email = trim(addslashes(strip_tags($excel->val($i,11))));
					$manager = trim(addslashes(strip_tags($excel->val($i,12))));
					$corp_zipcode = trim(addslashes(strip_tags($excel->val($i,13))));
					$corp_address = trim(addslashes(strip_tags($excel->val($i,14))));
					$account_id = trim(addslashes(strip_tags($excel->val($i,15))));
					$account_pwd = trim(addslashes(strip_tags($excel->val($i,16))));

					$data = array (
						"table" => "erp_account",
						"account_gb" => $account_gb,
						"account_cd" => $account_cd,
						"account_nm" => $account_nm,
						"owner" => $owner,
						"owner_mobile" => $owner_mobile,
						"corp_reg_no" => $corp_reg_no,
						"corp_condition" => $corp_condition,
						"corp_event" => $corp_event,
						"corp_phone" => $corp_phone,
						"corp_fax" => $corp_fax,
						"corp_email" => $corp_email,
						"manager" => $manager,
						"corp_zipcode" => $corp_zipcode,
						"corp_address" => $corp_address,
						"account_id" => $account_id,
						"account_pwd" => $account_pwd,
						"create_dt" => $now
					);
					$base->insert($data);							
				break;
			}
		}
		
		switch($_POST['excel_gb']) {
			case "item" : 
				$movePage = "listPageItem"; 
				$con = "base";
			break;
			case "employee" : 
				$movePage = "listPageEmployee"; 
				$con = "base";
			break;
			case "bom" : 
				$movePage = "listPageBom"; 
				$con = "production";
			break;
			case "account" : 
				$movePage = "listPageAccount"; 
				$con = "base";
			break;
		}

		unlink("{$upfile_dir}/{$upfile_name}");
		$this->movePage($con,$movePage);
	}
	
	//2018년 엑셀 등록 부분 추가
	public function insertExcel() {
		$base = new Base;

		ini_set("memory_limit", -1);
		error_reporting(E_ALL ^ E_NOTICE);
		require_once $_SERVER['DOCUMENT_ROOT']. '/library/PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
		echo ('<meta http-equiv="content-type" content="text/html; charset=utf-8">');

		// 저장될 디비 테이블명
		$TABLE_NAME = $table_name;
		// 저장될 디렉토리
		$upfile_dir = $_SERVER['DOCUMENT_ROOT']."/attach/excel";
		//CSV데이타 추출시 한글깨짐방지
		setlocale(LC_CTYPE, 'ko_KR.eucKR'); // CSV 한글 깨짐 문제
		//장시간 데이터 처리될경우
		set_time_limit(0);

				//한글파일명 처리
		$arr = explode(".", $_FILES['attach']['name']);
		$ext = array_pop($arr);
		$origin_name = join(".", $arr);
		$_FILES['attach']['name'] = iconv("UTF-8", "cp949", $origin_name.".".$ext);
		if(empty($_FILES['attach']['name']))
		{
			$_FILES['attach']['name'] = mb_convert_encoding($origin_name.".".$ext, "EUC-KR");
		}

		$upfile_name = $_FILES['attach']['name']; // 파일이름
		$upfile_type = $_FILES['attach']['type']; // 확장자
		$upfile_size = $_FILES['attach']['size']; // 파일크기
		$upfile_tmp  = $_FILES['attach']['tmp_name']; // 임시 디렉토리에 저장된 파일명

		//확장자 확인
		if(preg_match("/(\.(xls|XLS))$/i",$upfile_name)) { //|xlsx|XLSX
		} else {
			echo ("<script>window.alert('업로드를 할수 없는 파일 입니다.\\n\\r확장자가 [xls]인 경우만 업로드가 가능합니다.'); history.go(-1) </script>");
			exit;
		}
		if ($upfile_name){
		//폴더내에 동일한 파일이 있는지 검사하고 있으면 삭제
			if (file_exists("{$upfile_dir}/{$upfile_name}") ) { unlink("{$upfile_dir}/{$upfile_name}"); }
			if ( strlen($upfile_size) < 7 ) {
				$filesize = sprintf("%0.2f KB", $upfile_size/100000);
			} else{
				$filesize = sprintf("%0.2f MB", $upfile_size/100000000);
			}
			 
			if (move_uploaded_file($upfile_tmp,"{$upfile_dir}/{$upfile_name}")) {
			} else {
				echo ("<script>window.alert('디렉토리에 복사실패'); history.go(-1) </script>");
				exit;
			}
			chmod("{$upfile_dir}/{$upfile_name}",0777); 
			//chown("{$upfile_dir}/{$upfile_name}",'nobody'); 
		}

		$filepath = "{$upfile_dir}/{$upfile_name}";
		try {

			$filetype = PHPExcel_IOFactory::identify($filepath);
			$reader = PHPExcel_IOFactory::createReader($filetype);
			$php_excel = $reader->load($filepath);

			$sheet = $php_excel->getSheet(0);           // 첫번째 시트
			$maxRow = $sheet->getHighestRow();          // 마지막 라인
			$maxColumn = $sheet->getHighestColumn();    // 마지막 칼럼

			$target = "A"."2".":"."$maxColumn"."$maxRow";
			$lines = $sheet->rangeToArray($target, NULL, TRUE, FALSE);
			
			//echo sizeof($lines);
			// 라인수 만큼 루프
			$this->begin();
			foreach ($lines as $key => $line) {
				$col = 0;
				$item = array(
					"A"=>$line[$col++],   // 첫번째 칼럼
					"B"=>$line[$col++],   // 두번쨰 칼럼
					"C"=>$line[$col++],   // 세번쨰 칼럼
					"D"=>$line[$col++],   // 네번쨰 칼럼
					"E"=>$line[$col++],   // 다섯번쨰 칼럼
					"F"=>$line[$col++],   // 여섯번쨰 칼럼
					"G"=>$line[$col++],   // 일곱번쨰 칼럼
					"H"=>$line[$col++],   // 여덟번쨰 칼럼
					"I"=>$line[$col++],   // 아홉번쨰 칼럼
					"J"=>$line[$col++],   // 열번쨰 칼럼
					"K"=>$line[$col++],   // 열한번쨰 칼럼
					"L"=>$line[$col++],   // 열두번쨰 칼럼
					"M"=>$line[$col++],   // 열세번쨰 칼럼
					"N"=>$line[$col++],   // 열네번쨰 칼럼
					"O"=>$line[$col++],   // 열다섯번쨰 칼럼
					"P"=>$line[$col++],   // 열여섯번쨰 칼럼
					"Q"=>$line[$col++],   // 열일곱번쨰 칼럼
					"R"=>$line[$col++],   // 열여덟번쨰 칼럼
					"S"=>$line[$col++],   // 열아홉번쨰 칼럼
					"T"=>$line[$col++],   // 스물번쨰 칼럼
				);

				switch ($_POST['excel_gb']) {
					case "item":	
						$now = date("Y-m-d H:i:s");
						$item_gb = trim(addslashes(strip_tags($item["A"])));		
						$item_group_cd = trim(addslashes(strip_tags($item["B"])));	
						$item_cd = strtoupper(trim(addslashes(strip_tags($item["C"]))));	
						$item_nm = trim(addslashes(strip_tags($item["D"])));
						$unit = trim(addslashes(strip_tags($item["E"])));
						$standard1 = trim(addslashes(strip_tags($item["F"])));
						$standard2 = trim(addslashes(strip_tags($item["G"])));
						$standard3 = trim(addslashes(strip_tags($item["H"])));
						$material = trim(addslashes(strip_tags($item["I"])));
						$min_pur_unit = $this->replaceComma(trim(addslashes(strip_tags($item["J"]))));
						$warehouse_nm = trim(addslashes(strip_tags($item["K"])));
						$account_nm = trim(addslashes(strip_tags($item["L"])));
						$delivery_period = $this->replaceComma(trim(addslashes(strip_tags($item["M"]))));
						$base_stock_cnt = $this->replaceComma(trim(addslashes(strip_tags($item["N"]))));
						$safety_stock_cnt = $this->replaceComma(trim(addslashes(strip_tags($item["O"]))));
						$pur_unit_price = $this->replaceComma(trim(addslashes(strip_tags($item["P"]))));
						$unit_price = $this->replaceComma(trim(addslashes(strip_tags($item["Q"]))));
						$in_barcode = trim(addslashes(strip_tags($item["R"])));
						$barcode = trim(addslashes(strip_tags($item["S"])));
						$fileAttach = trim(addslashes(strip_tags($item["T"])));

						switch($item_gb) {
							case "자재" : 
								$new_item_gb = "component"; 
								$pre = "C-";
							break;

							case "반제품" : 
								$new_item_gb = "semi_product"; 
								$pre = "S-";
							break;

							case "완제품" : 
								$new_item_gb = "product"; 
								$pre = "P-";
							break;
						}

						if($item_cd == "") $item_cd = $pre.mt_rand(100000000,999999999);
						if($barcode == "") $barcode = $item_cd;

						//홑, 쌍따옴표 php.ini magic_quotes_gpc = on;
						$item_cd	= str_replace("'", "''",$item_cd);
						$item_cd	= str_replace("'", "''",$item_cd);
						$item_nm	= str_replace("'", "''",$item_nm);
						$item_nm	= str_replace("'", "''",$item_nm);
						$unit		= str_replace("'", "''",$unit);
						$unit		= str_replace("'", "''",$unit);
						$standard1	= str_replace("'", "''",$standard1);
						$standard1	= str_replace("'", "''",$standard1);
						$standard2	= str_replace("'", "''",$standard2);
						$standard2	= str_replace("'", "''",$standard2);
						$standard3	= str_replace("'", "''",$standard3);
						$standard3	= str_replace("'", "''",$standard3);
						$material	= str_replace("'", "''",$material);

						$data = array (
							"table" => "erp_item",
							"item_gb" => $new_item_gb,
							"item_cd" => $item_cd,
							"item_nm" => $item_nm,
							"unit" => $unit,
							"standard1" => $standard1,
							"standard2" => $standard2,
							"standard3" => $standard3,
							"material"=> $material,
							"min_pur_unit" => $this->replaceComma($min_pur_unit),
							"warehouse_cd" => getWarehouseCode($warehouse_nm),
							"warehouse_nm" => $warehouse_nm,
							"account_cd" => getAccountCode($account_nm),
							"account_nm" => $account_nm,
							"delivery_period" => $this->replaceComma($delivery_period),
							"base_stock_cnt" => $this->replaceComma($base_stock_cnt),
							"safety_stock_cnt" => $this->replaceComma($safety_stock_cnt),
							"pur_unit_price" => $this->replaceComma($pur_unit_price),
							"unit_price" => $this->replaceComma($unit_price),
							"in_barcode" => $in_barcode,
							"barcode" => $barcode,
							"img"	=> $fileAttach,
							"emp_id" => $_SESSION['login_id'],
							"create_dt" => $now
						);
						$base->insert($data);	
						
						// 전체재고에 넣기
						$stockData = array (
							"table" => "erp_stock",
							"fid" => mysql_insert_id(),
							"item_cd" => $item_cd,
							"standard1" => $standard1,
							"standard2" => $standard2,
							"standard3" => $standard3,
							"material"=> $material,
							"pur_cnt" => $this->replaceComma($base_stock_cnt),
							"pur_unit_price" => $this->replaceComma($pur_unit_price),
							"remain_cnt" => $this->replaceComma($base_stock_cnt),
							"warehouse_cd" => getWarehouseCode($warehouse_nm),
							"in_date" => $now
						);
						$base->insert($stockData);

						$total_price = $base_stock_cnt * $pur_unit_price;

						// 입출고내역에 넣기
						$stockInoutData = array (
							"table" => "erp_stock_inout",
							"account_cd" => getAccountCode($account_nm),
							"warehouse_cd" => getWarehouseCode($warehouse_nm),
							"item_cd" => $item_cd,
							"standard1" => $standard1,
							"standard2" => $standard2,
							"standard3" => $standard3,
							"material"=> $material,
							"in_cnt" => $this->replaceComma($base_stock_cnt),
							"out_cnt" => 0,
							"remain_cnt" => $this->replaceComma($base_stock_cnt),
							"pur_unit_price" => $this->replaceComma($pur_unit_price),
							"total_price" => $this->replaceComma($total_price),
							"used" => "n",
							"lot_no" => $item_cd."-".time(),
							"emp_id" => $_SESSION['login_id'],
							"create_dt" => $now
						);
						$base->insert($stockInoutData);

						// 사유에 넣기
						$reasonData = array (
							"table" => "erp_reason",
							"fid" => mysql_insert_id(),
							"item_cd" => $item_cd,
							"standard1" => $standard1,
							"standard2" => $standard2,
							"standard3" => $standard3,
							"material"=> $material,
							"in_cnt" => $this->replaceComma($base_stock_cnt),
							"out_cnt" => 0,
							"reason" => "기초입고수량",
							"emp_id" => $_SESSION['login_id'],
							"create_dt" => $now
						);
						$base->insert($reasonData);

					break;

					case "bom":	
						$now = date("Y-m-d H:i:s");
						$item_cd = strtoupper(trim(addslashes(strip_tags($item["A"]))));		
						$item_nm = trim(addslashes(strip_tags($item["B"])));	
						$material = trim(addslashes(strip_tags($item["C"])));	
						$standard1 = trim(addslashes(strip_tags($item["D"])));	
						$unit = trim(addslashes(strip_tags($item["E"])));
						$cnt = trim(addslashes(strip_tags($item["F"])));
						$cnt = round($cnt,2);
						
						$unit = str_replace("×","X",$unit);

						$item_cd = str_replace("'","",$item_cd);
						$item_cd = str_replace('"',"",$item_cd);
						
						$item_nm = str_replace("'","",$item_nm);
						$item_nm = str_replace('"',"",$item_nm);

						/*
						$unit = str_replace('"',"",$unit);
						$unit = str_replace('"',"",$unit);
						$standard1 = str_replace('"',"",$standard1);
						*/

						if($cnt <= "0") {
							$sql = "select uid from erp_item where item_cd='".$item_cd."' and standard1='".$standard1."'";
							$item = mysql_fetch_object(mysql_query($sql));
							$_SESSION['fid'] = $item->uid;
						} else {
							
							//$sql = "select uid from erp_item where item_cd='".$item_cd."' and standard1='".$standard1."'";
							//$item = mysql_fetch_object(mysql_query($sql));
							//echo $sql."<BR>";
							//$fid = $item->uid;
							//echo "fid=".$fid."<RB>";

							$data = array (
								"table" => "erp_bom",
								"fid" => $_SESSION['fid'],
								"item_cd" => $item_cd,
								"item_nm" => $item_nm,
								"standard1" => $standard1,
								"material" => $material,
								"unit" => $unit,
								"cnt" => $cnt,
								"regdate" => $now
							);
							$base->insert($data);
						}
						unset($fid);
					break;

					case "employee":	
						$now = date("Y-m-d H:i:s");
						$emp_cd = trim(addslashes(strip_tags($item["A"])));		
						$emp_nm = trim(addslashes(strip_tags($item["B"])));	
						$emp_id = trim(addslashes(strip_tags($item["C"])));	
						$emp_pwd = trim(addslashes(strip_tags($item["D"])));
						$sex_gb = trim(addslashes(strip_tags($item["E"])));
						$emp_mobile = trim(addslashes(strip_tags($item["F"])));
						$big_department = trim(addslashes(strip_tags($item["G"])));
						$middle_department = trim(addslashes(strip_tags($item["H"])));
						$small_department = trim(addslashes(strip_tags($item["I"])));
						$position = trim(addslashes(strip_tags($item["J"])));
						$join_dt = trim(addslashes(strip_tags($item["K"])));
						$email = trim(addslashes(strip_tags($item["L"])));

						$data = array (
							"table" => "erp_employee",
							"emp_gb" => "work",
							"emp_cd" => $emp_cd,
							"emp_nm" => $emp_nm,
							"emp_id" => $emp_id,
							"emp_pwd" => $emp_pwd,
							"sex_gb" => $sex_gb,
							"big_department_cd" => getBigDepartmentCd($big_department),
							"big_department_nm" => $big_department,
							"middle_department_cd" => getMiddleDepartmentCd($middle_department),
							"middle_department_nm" => $middle_department,
							"small_department_cd" => getSmallDepartmentCd($small_department),
							"small_department_nm" => $small_department,
							"position_cd" => getPositionCd($position),
							"position_nm" => $position,
							"emp_email" => $email,
							"join_dt" => $join_dt,
							"emp_mobile" => $emp_mobile,
							"create_dt" => $now
						);
						$base->insert($data);							
					break;

					case "account":	
						$now = date("Y-m-d H:i:s");
						$account_gb = trim(addslashes(strip_tags($item["A"])));		
						$account_cd = trim(addslashes(strip_tags($item["B"])));	
						$account_nm = trim(addslashes(strip_tags($item["C"])));	
						$owner = trim(addslashes(strip_tags($item["D"])));
						$owner_mobile = trim(addslashes(strip_tags($item["E"])));
						$corp_reg_no = trim(addslashes(strip_tags($item["F"])));
						$corp_condition = trim(addslashes(strip_tags($item["G"])));
						$corp_event = trim(addslashes(strip_tags($item["H"])));
						$corp_phone = trim(addslashes(strip_tags($item["I"])));
						$corp_fax = trim(addslashes(strip_tags($item["J"])));
						$corp_email = trim(addslashes(strip_tags($item["K"])));
						$manager = trim(addslashes(strip_tags($item["L"])));
						$corp_zipcode = trim(addslashes(strip_tags($item["M"])));
						$corp_address = trim(addslashes(strip_tags($item["N"])));
						$account_id = trim(addslashes(strip_tags($item["O"])));
						$account_pwd = trim(addslashes(strip_tags($item["P"])));

						$data = array (
							"table" => "erp_account",
							"account_gb" => $account_gb,
							"account_cd" => $account_cd,
							"account_nm" => $account_nm,
							"owner" => $owner,
							"owner_mobile" => $owner_mobile,
							"corp_reg_no" => $corp_reg_no,
							"corp_condition" => $corp_condition,
							"corp_event" => $corp_event,
							"corp_phone" => $corp_phone,
							"corp_fax" => $corp_fax,
							"corp_email" => $corp_email,
							"manager" => $manager,
							"corp_zipcode" => $corp_zipcode,
							"corp_address" => $corp_address,
							"account_id" => $account_id,
							"account_pwd" => $account_pwd,
							"create_dt" => $now
						);
						$base->insert($data);							
					break;
				}
			}
			$this->commit();
			} 
		catch (exception $e) {
			$this->rollback();
			echo '엑셀파일을 읽는도중 오류가 발생하였습니다.';
		}
		
		switch($_POST['excel_gb']) {
			case "item" : 
				$movePage = "listPageItem"; 
				$con = "base";
			break;
			case "employee" : 
				$movePage = "listPageEmployee"; 
				$con = "base";
			break;
			case "bom" : 
				$movePage = "listPageBom"; 
				$con = "production";
			break;
			case "account" : 
				$movePage = "listPageAccount"; 
				$con = "base";
			break;
		}

		unlink("{$upfile_dir}/{$upfile_name}");
		$this->movePage($con,$movePage);
	}

	public function downloadPageExcel() {
		require_once ("views/base/downloadExcel.php");
	}

	public function registAuthority(){
		$base = new Base;
		
		$sql = "select uid from erp_authority where emp_id='".$_POST['emp_id']."'";
		$t = @mysql_fetch_object(mysql_query($sql));

		if(isset($t->uid)) {
			$data = array (
				"table" => "erp_authority",
				"where" => "emp_id='".$_POST['emp_id']."'",
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
			$base->update($data);
		} else {
			$data = array (
				"table" => "erp_authority",
				"emp_id" => $_POST['emp_id'],
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
			$base->insert($data);
		}
		$t = Base::get($_POST['emp_uid'],"employee");
		require_once ("views/base/modifyEmployee.php");
	}

	// 로트넘버 수정 페이지
	public function listLotNo() {
		require_once ("views/base/listLotNo.php");
	}
	public function listLotNoPop() {
		require_once ("views/base/listLotNoPop.php");
	}

	public function listLotNoPop2() {
		require_once ("views/base/listLotNoPop2.php");
	}

	public function listLotNoPop3() {
		require_once ("views/base/listLotNoPop3.php");
	}

	public function registLotNo() {
		require_once ("views/base/creatlotNo.php");
	}

	public function modifyLotNo() {
		$t = Base::get($_GET['uid'],"lot_no");
		require_once ("views/base/modifyLotNo.php");
	}
	// 로트넘버 등록 실행
	public function registLotNoInput() {
		$now = date("Y-m-d H:i:s");

		/*
		$data = array(
			"table" => "erp_lot_no",
			"lot_no_cd" => $lot_no_cd,
			"lot_no_nm" => $_POST['lot_no_nm'],
			"lot_no_dt" => $_POST['lot_no_dt'],
			"etc" => $_POST['etc'],
			"regdate" => $now
		);
	
		$base = new Base;
		$base->insert($data);

		*/

		$sql = "insert into erp_lot_no ( lot_no_cd , lot_no_nm , lot_no_dt , etc , regdate ) values (
		'". $_POST['lot_no_cd']."',
		'". $_POST['lot_no_nm']."',
		'". $_POST['lot_no_dt']."',
		'". $_POST['etc']."',
		'". $now."'
		)";

		mysql_query($sql);

		$this->movePageClose($_POST['dialogID']);
	}

	public function updateLotNo() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_lot_no",
			"where" => "uid=".$_POST['uid'],
			"lot_no_cd" => $_POST['lot_no_cd'],
			"lot_no_nm" => $_POST['lot_no_nm'],
			"lot_no_dt" => $_POST['lot_no_dt'],
			"etc" => $_POST['etc'],
			"regdate" => $now
		);
	
		$base = new Base;
		$base->update($data);

		$this->movePageClose($_POST['dialogID']);
	}
	
	// 규격 코드 관리
	public function listStandardCode() {
		require_once ("views/base/listStandardCode.php");
	}

	public function registStandardCode() {
		require_once ("views/base/creatStandardCode.php");
	}

	public function modifyStandardCode() {
		$t = Base::get($_GET['uid'],"standard_code");
		require_once ("views/base/modifyStandardCode.php");
	}

	// 규격코드 등록 실행
	public function inputStandardCode() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_standard_code",
			"standard" => $_POST['standard'],
			"standard_cd" => $_POST['standard_cd'],
			"standard_nm" => $_POST['standard_nm'],
			"item_cd" => $_POST['item_cd'],
			"item_nm" => $_POST['item_nm'],
			"etc" => $_POST['etc'],
			"regdate" => $now
		);
	
		$base = new Base;
		$base->insert($data);

		$this->movePageClose($_POST['dialogID']);
	}

	public function updateStandardCode() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_standard_code",
			"where" => "uid=".$_POST['uid'],
			"standard" => $_POST['standard'],
			"standard_cd" => $_POST['standard_cd'],
			"standard_nm" => $_POST['standard_nm'],
			"item_cd" => $_POST['item_cd'],
			"item_nm" => $_POST['item_nm'],
			"etc" => $_POST['etc'],
			"regdate" => $now
		);
	
		$base = new Base;
		$base->update($data);

		$this->movePageClose($_POST['dialogID']);
	}

	
	public function registSafetyStock() {
		require_once ("views/base/createSafetystock.php");
	}

	public function inputItemSafetyStock() {
		$base = new Base;
		$now = date("Y-m-d H:i:s");
			
		$sql = "delete from erp_item_safety_stock where item_cd=".$_POST['item_cd'];
		mysql_query($sql);

			$item_cd			= $_POST['item_cd'];
			$item_nm			= $_POST['item_nm'];
			$warehouse_gb		= $_POST['warehouse_gb'];
			$warehouse_cd		= $_POST['warehouse_cd'];
			$warehouse_nm		= $_POST['warehouse_nm'];
			$safety_stock_cnt	= $_POST['safety_stock_cnt'];

			foreach($warehouse_cd as $key => $val) {
				if($val != "") {
					$data = array(
					"table"				=> "erp_item_safety_stock",
					"item_cd"			=> $_POST['item_cd'],
					"item_nm"			=> $_POST['item_cd'],
					"warehouse_gb"		=> $warehouse_gb[$key],
					"warehouse_cd"		=> $warehouse_cd[$key],
					"warehouse_nm"		=> $warehouse_nm[$key],
					"safety_stock_cnt"	=> $safety_stock_cnt[$key],
					"regdate" => $now
					);
				$base->insert($data);
				}
			}
		
		$this->openWinClose($_POST['dialogID']);
	}

	// Serial넘버 
	public function listPageSerialNo() {
		require_once ("views/base/listSerialNo.php");
	}
	public function listPageSerialNoPop() {
		require_once ("views/base/listSerialNo_pop.php");
	}

	public function registPageSerialNo() {
		require_once ("views/base/creatSerialNo.php");
	}

	public function modifyPageSerialNo() {
		$t = Base::get($_GET['uid'],"serial_no");
		require_once ("views/base/modifySerialNo.php");
	}
	// 로트넘버 등록 실행
	public function inputPageSerialNo() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"			=> "erp_serial_no",
			"serial_no_cd"	=> $_POST['serial_no_cd'],
			"serial_no_nm"	=> $_POST['serial_no_nm'],
			"serial_no_dt"	=> $_POST['serial_no_dt'],
			"item_cd"		=> $_POST['item_cd'],
			"item_nm"		=> $_POST['item_nm'],
			"expiry_dt"		=> $_POST['expiry_dt'],
			"model_nm"		=> $_POST['model_nm'],
			"standard1"		=> $_POST['standard1'],
			"board_version"	=> $_POST['board_version'],
			"text_type"		=> $_POST['text_type'],
			"etc"			=> $_POST['etc'],
			"regdate"		=> $now
		);
	
		$base = new Base;
		$base->insert($data);

		$this->movePageClose($_POST['dialogID']);
	}

	public function updatePageSerialNo() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_serial_no",
			"where" => "uid=".$_POST['uid'],
			"serial_no_cd" => $_POST['serial_no_cd'],
			"serial_no_nm" => $_POST['serial_no_nm'],
			"serial_no_dt" => $_POST['serial_no_dt'],
			"item_cd" => $_POST['item_cd'],
			"item_nm" => $_POST['item_nm'],
			"expiry_dt" => $_POST['expiry_dt'],
			"model_nm" => $_POST['model_nm'],
			"standard1" => $_POST['standard1'],
			"board_version" => $_POST['board_version'],
			"text_type" => $_POST['text_type'],
			"etc" => $_POST['etc'],
			"regdate" => $now
		);
	
		$base = new Base;
		$base->update($data);

		$this->movePageClose($_POST['dialogID']);
	}
	
	public function listPageDefectReason() {
		require_once ("views/base/createDefectReason.php");
	}
}
?>