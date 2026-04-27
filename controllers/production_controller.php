<?
session_start();
// 영업관리
class ProductionController {
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
		}
	}

	public function replaceComma($num) {
		$number = (int)str_replace(",","",$num);
		return $number;
	}

	// 견적서 리스트
	public function listPageProcess(){
		require_once ('views/production/listProcess.php');
	}
	
	// 견적서 등록
	public function inputPageProcess(){
		require_once ("views/production/createProcess.php");
	}
	
	// 수주,주문 등록
	public function modifyPageProcess() {
		$t = Production::getProcess($_GET['uid']);
		require_once ("views/production/modifyProcess.php");
	}

	public function registProcess(){
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

		$production = new Production;
		$result = $production->registProcess($data);
		if($result) $this->movePage("production","listPageProcess");
	}

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

		$production = new Production;
		$result = $production->updateProcess($data);
		if($result) $this->movePage("production","listPageProcess");
	}

	// BOM
	public function listPageBom() {
		require_once ("views/production/listBom.php");
	}
	
	// BOM 계산
	public function calBom() {
		require_once ("views/production/calBom.php");
	}

	public function inputPageBom() {
		require_once ("views/production/createBom.php");
	}


	public function registBom(){
		// 기존 등록된 BOM 삭제
		$sql = "delete from erp_bom where fid=".$_POST['uid'];
		@mysql_query($sql) or die (mysql_error());

		$Production = new Production;

		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$unit = $_POST['unit'];
		$standard1 = $_POST['standard1'];
		$standard2 = $_POST['standard2'];
		$standard3 = $_POST['standard3'];
		$cnt = $_POST['cnt'];
		
		
		foreach($item_cd as $key => $val) {
			if($val != "") {
				$t = Production::checkBom($_POST['uid'], $item_cd[$key], $standard1[$key], $standard2[$key], $standard3[$key], $unit[$key]);

				if($t) {
					$data = array (
						"table" => "erp_bom",
						"fid" => $_POST['uid'],
						"item_cd" => $item_cd[$key],
						"item_nm" => $item_nm[$key],
						"standard1" => $standard1[$key],
						"standard2" => $standard2[$key],
						"standard3" => $standard3[$key],
						"unit" => $unit[$key],
						"cnt" => $cnt[$key],
					);
					$Production->registBom($data);
				}
			}
		}

		$this->movePage("production","listPageBom");
		
	}

	// 작업지시서 리스트
	public function listPageWork() {
		require_once ("views/production/listWork.php");
	}
	
	// 생산계획 리스트 화면
	public function listPageWorkPlan() {
		require_once ("views/production/listWorkPlan.php");
	}
	
	// 작업지시서 등록
	public function inputPageWork(){
		$t = Production::getOrder($_GET['uid']);
		require_once ("views/production/createWork.php");
	}
	
	// 생산계획서 등록
	public function registPageWorkPlan(){
		require_once("views/production/createWorkPlan.php");
	}

	// 생산계획 등록 처리
	public function registWorkPlan(){
		$now = date("Y-m-d H:i:s");
		//$workplan_cd = "PL-".time();

		$sql = "select max(workplan_cha) as cnt from erp_workplan where workplan_dt='".$_POST['workplan_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$workplan_cha = "1";
		}else{
			$workplan_cha = $t0->cnt+1;
		}

		$workplan_cd  = $_POST['workplan_dt']."-".$workplan_cha;

		$data = array(
			"table" => "erp_workplan",
			"order_cd" => $_POST['order_no'],
			"title" => $_POST['title'],
			"work_gb" => $_POST['work_gb'],
			"workplan_cd" => $workplan_cd,
			"workplan_dt" => $_POST['workplan_dt'],
			"workplan_cha" => $workplan_cha,
			"start_dt" => $_POST['start_dt'],
			"end_dt" => $_POST['end_dt'],
			"used" => "n",
			"create_dt" => $now
		);

		$production = new Production;
		$wid = $production->registWorkPlan($data);
		
		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard1 = $_POST['standard1'];
		$standard2 = $_POST['standard2'];
		$standard3 = $_POST['standard3'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$work_start_dt = $_POST['work_start_dt'];
		$work_end_dt = $_POST['work_end_dt'];
		$order_cd = $_POST['order_cd'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_workplan_item",
					"wid" => $wid,
					"workplan_cd" => $workplan_cd,
					"item_cd" => $item_cd[$key],
					"item_nm" => $item_nm[$key],
					"standard1" => $standard1[$key],
					"standard2" => $standard2[$key],
					"standard3" => $standard3[$key],
					"unit" => $unit[$key],
					"cnt" => $this->replaceComma($cnt[$key]),
					"work_start_dt" => $work_start_dt[$key],
					"work_end_dt" => $work_end_dt[$key],
					"order_cd" => $order_cd[$key]
				);
				$production->registWorkPlanItem($data);
			}
		}

		$this->movePage("production","listPageWorkPlan");
	}
	
	// 생산계획 수정
	public function updateWorkPlan() {
		$now = date("Y-m-d H:i:s");
		$workplan_cd = "PL-".time();
		$data = array(
			"table" => "erp_workplan",
			"where" => "uid=".$_POST['uid'],
			"title" => $_POST['title'],
			"work_gb" => $_POST['work_gb'],
			"workplan_cd" => $workplan_cd,
			"start_dt" => $_POST['start_dt'],
			"end_dt" => $_POST['end_dt'],
			"create_dt" => $now
		);

		$production = new Production;
		$production->updateWorkPlan($data);
		
		$sql = "delete from erp_workplan_item where workplan_cd='".$_POST['workplan_cd']."'";
		mysql_query($sql);

		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard1 = $_POST['standard1'];
		$standard2 = $_POST['standard2'];
		$standard3 = $_POST['standard3'];
		$material = $_POST['material'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$work_start_dt = $_POST['work_start_dt'];
		$work_end_dt = $_POST['work_end_dt'];
		$order_cd = $_POST['order_cd'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_workplan_item",
					"workplan_cd" => $workplan_cd,
					"item_cd" => $item_cd[$key],
					"item_nm" => $item_nm[$key],
					"standard1" => $standard1[$key],
					"standard2" => $standard2[$key],
					"standard3" => $standard3[$key],
					"material" => $material[$key],
					"unit" => $unit[$key],
					"cnt" => $this->replaceComma($cnt[$key]),
					"work_start_dt" => $work_start_dt[$key],
					"work_end_dt" => $work_end_dt[$key],
					"order_cd" => $order_cd[$key]
				);
				$production->registWorkPlanItem($data);
			}
		}

		$this->movePage("production","listPageWorkPlan");
	}
	
		// 생산계획서 등록
	public function registPageWorkPlanPop(){
		require_once("views/production/createWorkPlan_pop.php");
	}
	
	// 생산계획서 등록
	public function modifyPageWorkPlanPop(){
		$t = Production::getWorkPlan($_GET['uid']);
		require_once("views/production/modifyWorkPlan_pop.php");
	}

	// 생산계획 등록 처리
	public function inputPageWorkPlan(){
		$now = date("Y-m-d H:i:s");
		//$workplan_cd = "PL-".time();

		$sql = "select max(workplan_cha) as cnt from erp_workplan where workplan_dt='".$_POST['workplan_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$workplan_cha = "1";
		}else{
			$workplan_cha = $t0->cnt+1;
		}

		$workplan_cd  = $_POST['workplan_dt']."-".$workplan_cha;

		$data = array(
			"table"			=> "erp_workplan",
			"workplan_cd"	=> $workplan_cd,
			"workplan_dt"	=> $_POST['workplan_dt'],
			"workplan_cha"	=> $workplan_cha,
			"order_cd"		=> $_POST['order_cd'],
			"title"			=> $_POST['title'],
			"work_gb"		=> $_POST['work_gb'],
			"start_dt"		=> $_POST['start_dt'],
			"account_cd"	=> $_POST['account_cd'],
			"account_nm"	=> $_POST['account_nm'],
			"manager"		=> $_POST['manager'],
			"end_dt"		=> $_POST['end_dt'],
			"used"			=> "n",
			"create_dt"		=> $now
		);

		$production = new Production;
		$wid = $production->registWorkPlan($data);
		
		$item_cd		= $_POST['item_cd'];
		$item_nm		= $_POST['item_nm'];
		$standard1		= $_POST['standard1'];
		$material		= $_POST['material'];
		$unit			= $_POST['unit'];
		$cnt			= $_POST['cnt'];
		$work_start_dt	= $_POST['work_start_dt'];
		$work_end_dt	= $_POST['work_end_dt'];
		$warehouse_cd	= $_POST['warehouse_cd'];
		$warehouse_nm	= $_POST['warehouse_nm'];
		$order_cd		= $_POST['order_cd'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"			=> "erp_workplan_item",
					"wid"			=> $wid,
					"workplan_cd"	=> $workplan_cd,
					"item_cd"		=> $item_cd[$key],
					"item_nm"		=> $item_nm[$key],
					"standard1"		=> $standard1[$key],
					"material"		=> $material[$key],
					"unit"			=> $unit[$key],
					"cnt"			=> $this->replaceComma($cnt[$key]),
					"work_start_dt" => $work_start_dt[$key],
					"work_end_dt"	=> $work_end_dt[$key],
					"warehouse_cd"	=> $warehouse_cd[$key],
					"warehouse_nm"	=> $warehouse_nm[$key],
					"order_cd"		=> $order_cd[$key]
				);
				$production->registWorkPlanItem($data);
			}
		}
		
		$this->movePageClose($_POST['dialogID']);
		//$this->movePage("production","listPageWorkPlan");
	}


	// 생산계획 수정 처리
	public function updatePageWorkPlan(){
		$now = date("Y-m-d H:i:s");
		//$workplan_cd = "PL-".time();

		$data = array(
			"table"			=> "erp_workplan",
			"where"			=> "uid=".$_POST['uid'],
			"order_cd"		=> $_POST['order_no'],
			"title"			=> $_POST['title'],
			"work_gb"		=> $_POST['work_gb'],
			"start_dt"		=> $_POST['start_dt'],
			"account_cd"	=> $_POST['account_cd'],
			"account_nm"	=> $_POST['account_nm'],
			"manager"		=> $_POST['manager'],
			"end_dt"		=> $_POST['end_dt'],
			"used"			=> "n",
			"create_dt"		=> $now
		);

		$production = new Production;
		$wid = $production->update($data);

		
		$sql = "delete from erp_workplan_item where wid = '".$_POST['uid']."' ";
		mysql_query($sql);
		
		$item_cd		= $_POST['item_cd'];
		$item_nm		= $_POST['item_nm'];
		$standard1		= $_POST['standard1'];
		$material		= $_POST['material'];
		$unit			= $_POST['unit'];
		$cnt			= $_POST['cnt'];
		$work_start_dt	= $_POST['work_start_dt'];
		$work_end_dt	= $_POST['work_end_dt'];
		$warehouse_cd	= $_POST['warehouse_cd'];
		$warehouse_nm	= $_POST['warehouse_nm'];
		$order_cd		= $_POST['order_cd'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"			=> "erp_workplan_item",
					"wid"			=> $_POST['uid'],
					"workplan_cd"	=> $_POST['workplan_cd'],
					"item_cd"		=> $item_cd[$key],
					"item_nm"		=> $item_nm[$key],
					"standard1"		=> $standard1[$key],
					"material"		=> $material[$key],
					"unit"			=> $unit[$key],
					"cnt"			=> $this->replaceComma($cnt[$key]),
					"work_start_dt" => $work_start_dt[$key],
					"work_end_dt"	=> $work_end_dt[$key],
					"warehouse_cd"	=> $warehouse_cd[$key],
					"warehouse_nm"	=> $warehouse_nm[$key],
					"order_cd"		=> $order_cd[$key]
				);
				$production->insert($data);
			}
		}
		
		$this->movePageClose($_POST['dialogID']);
		//$this->movePage("production","listPageWorkPlan");
	}
	

	public function inputWork() {
		$production = new Production;

		$now = date("Y-m-d H:i:s");
		//$workplan_cd = "PL-".time();

		$sql = "select max(work_cha) as cnt from erp_work where work_dt='".$_POST['work_dt']."'";

		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$work_cha = "1";
		}else{
			$work_cha = $t0->cnt+1;
		}

		$work_cd  = $_POST['work_dt']."-".$work_cha;

		$process		= $_POST['process'];
		$machine		= $_POST['machine'];
		$item_cd		= $_POST['item_cd'];
		$item_nm		= $_POST['item_nm'];
		$standard1		= $_POST['standard1'];
		$material		= $_POST['material'];
		$unit			= $_POST['unit'];
		$goal_cnt		= $_POST['goal_cnt'];
		$order_cnt		= $_POST['order_cnt'];
		$make_cnt		= 0;
		$remain_cnt		= $_POST['goal_cnt'];
		$seq			= $_POST['seq'];
		$warehouse_cd	= $_POST['warehouse_cd'];
		$warehouse_nm	= $_POST['warehouse_nm'];
		
		$data = array(
			"table" => "erp_work",
			"work_dt" => $_POST['work_dt'],
			"work_cha" => $work_cha,
			"work_cd" => $work_cd,
			"workplan_cd" => $_POST['workplan_cd'],
			"order_cd" => $_POST['order_cd'],
			"start_dt" => $_POST['work_start_dt'],
			"end_dt" => $_POST['work_end_dt'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"manager" => $_POST['manager'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"deadline_dt" => $_POST['deadline_dt'],
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);
		$wid = $production->inputWork($data);

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_work_item",
					"wid" => $wid,
					"order_cd" => $_POST['order_cd'],
					"workplan_cd" => $_POST['workplan_cd'],
					"work_cd" => $work_cd,
					//"process" =>  $process[$key],
					//"machine" =>  $machine[$key],
					"item_cd" =>  $item_cd[$key],
					"item_nm" =>  $item_nm[$key],
					"standard1" => $standard1[$key],
					"material" => $material[$key],
					"unit"		=> $unit[$key],
					"order_cnt" => $order_cnt[$key],
					//"make_cnt" => $make_cnt,
					//"remain_cnt" => $order_cnt[$key],
					//"seq" => $seq[$key],
					//"warehouse_cd" => $warehouse_cd[$key],
					//"warehouse_nm" => $warehouse_nm[$key],
					//"emp_id" => $_SESSION['login_id'],
					"create_dt" => $now
				);
				
				$fid = $production->registWorkItem($data);

				// 자재출고요청
				$sql = "select uid from erp_item where item_cd='".$item_cd[$key]."' and standard1='".$standard1[$key]."'";
				$item = mysql_fetch_object(mysql_query($sql));

				$sql = "select * from erp_bom where fid=".$item->uid;
				$result = mysql_query($sql);

				if(@mysql_num_rows($result) > 0) { // 하위 BOM이 있다면
					while($t = @mysql_fetch_object($result)) {
						$data = array(
							"table" => "erp_release",
							"fid" => $fid,
							"order_cd" => $_POST['order_cd'],
							"workplan_cd" => $_POST['workplan_cd'],
							"work_cd" => $_POST['work_cd'],
							"object_item_cd" => $item_cd[$key],
							"object_item_standard1" => $standard1[$key],
							"process" => $process[$key],
							"machine" => $machine[$key],
							"item_cd" => $t->item_cd,
							"item_nm" => $t->item_nm,
							"standard1" => $t->standard1,
							"standard2" => $t->standard2,
							"standard3" => $t->standard3,
							"cnt" => $order_cnt[$key] * $t->cnt,
							"status" => "stay",
							"emp_id" => $_SESSION['login_id'],
							"create_dt" => $now
						);

						$production->insert($data);
					}
				} else {
					$data = array(
						"table" => "erp_release",
						"fid" => $fid,
						"order_cd" => $_POST['order_cd'],
						"workplan_cd" => $_POST['workplan_cd'],
						"work_cd" => $_POST['work_cd'],
						"object_item_cd" => $item_cd[$key],
						"object_item_standard1" => $standard1[$key],
						"process" => $process[$key],
						"machine" => $machine[$key],
						"item_cd" => $item_cd[$key],
						"item_nm" => $item_nm[$key],
						"standard1" => $standard1[$key],
						"standard2" => $standard2[$key],
						"standard3" => $standard3[$key],
						"cnt" => $order_cnt[$key],
						"status" => "stay",
						"emp_id" => $_SESSION['login_id'],
						"create_dt" => $now
					);

					$production->insert($data);
				}
			}
		}
		
		$this->movePageClose($_POST['dialogID']);
		$this->movePage("production","listPageWork");
	}

	public function updateWork() {
	$production = new Production;

	$now = date("Y-m-d H:i:s");
	//$workplan_cd = "PL-".time();
	/*
	$sql = "select max(work_cha) as cnt from erp_work where work_dt='".$_POST['work_dt']."'";

	$t0 = mysql_fetch_object(mysql_query($sql));
	
	if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
		$work_cha = "1";
	}else{
		$work_cha = $t0->cnt+1;
	}


	$work_cd  = $_POST['work_dt']."-".$work_cha;
	*/
	$process		= $_POST['process'];
	$machine		= $_POST['machine'];
	$item_cd		= $_POST['item_cd'];
	$item_nm		= $_POST['item_nm'];
	$standard1		= $_POST['standard1'];
	$material		= $_POST['material'];
	$unit			= $_POST['unit'];
	$goal_cnt		= $_POST['goal_cnt'];
	$order_cnt		= $_POST['order_cnt'];
	$make_cnt		= 0;
	$remain_cnt		= $_POST['goal_cnt'];
	$shortage_cnt	= $_POST['shortage_cnt'];
	$seq			= $_POST['seq'];
	$warehouse_cd	= $_POST['warehouse_cd'];
	$warehouse_nm	= $_POST['warehouse_nm'];
	
	$data = array(
		"table" => "erp_work",
		"work_dt" => $_POST['work_dt'],
		"work_cha" => $work_cha,
		"work_cd" => $work_cd,
		"workplan_cd" => $_POST['workplan_cd'],
		"order_cd" => $_POST['order_cd'],
		"start_dt" => $_POST['work_start_dt'],
		"end_dt" => $_POST['work_end_dt'],
		"project_cd" => $_POST['project_cd'],
		"project_nm" => $_POST['project_nm'],
		"account_cd" => $_POST['account_cd'],
		"account_nm" => $_POST['account_nm'],
		"manager" => $_POST['manager'],
		"warehouse_cd" => $_POST['warehouse_cd'],
		"warehouse_nm" => $_POST['warehouse_nm'],
		"deadline_dt" => $_POST['deadline_dt'],
		"emp_id" => $_SESSION['login_id'],
		"create_dt" => $now
	);
	$wid = $production->updateWork($data);

	foreach($item_cd as $key => $val) {
		if($val != "") {
			$data = array(
				"table" => "erp_work_item",
				"wid" => $wid,
				"order_cd" => $_POST['order_cd'],
				"workplan_cd" => $_POST['workplan_cd'],
				"work_cd" => $work_cd,
				"process" =>  $process[$key],
				"machine" =>  $machine[$key],
				"item_cd" =>  $item_cd[$key],
				"item_nm" =>  $item_nm[$key],
				"standard1" => $standard1[$key],
				"material" => $material[$key],
				"unit"		=> $unit[$key],
				"order_cnt" => $order_cnt[$key],
				"make_cnt" => $make_cnt,
				"remain_cnt" => $order_cnt[$key],
				"shortage_cnt" => $shortage_cnt[$key],
				"seq" => $seq[$key],
				"warehouse_cd" => $warehouse_cd[$key],
				"warehouse_nm" => $warehouse_nm[$key],
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => $now
			);
			
			$fid = $production->registWorkItem($data);

			// 자재출고요청
			$sql = "select uid from erp_item where item_cd='".$item_cd[$key]."' and standard1='".$standard1[$key]."'";
			$item = mysql_fetch_object(mysql_query($sql));

			$sql = "select * from erp_bom where fid=".$item->uid;
			$result = mysql_query($sql);

			if(@mysql_num_rows($result) > 0) { // 하위 BOM이 있다면
				while($t = @mysql_fetch_object($result)) {
					$data = array(
						"table" => "erp_release",
						"fid" => $fid,
						"order_cd" => $_POST['order_cd'],
						"workplan_cd" => $_POST['workplan_cd'],
						"work_cd" => $_POST['work_cd'],
						"object_item_cd" => $item_cd[$key],
						"object_item_standard1" => $standard1[$key],
						"process" => $process[$key],
						"machine" => $machine[$key],
						"item_cd" => $t->item_cd,
						"item_nm" => $t->item_nm,
						"standard1" => $t->standard1,
						"standard2" => $t->standard2,
						"standard3" => $t->standard3,
						"cnt" => $order_cnt[$key] * $t->cnt,
						"status" => "stay",
						"emp_id" => $_SESSION['login_id'],
						"create_dt" => $now
					);

					$production->insert($data);
				}
			} else {
				$data = array(
					"table" => "erp_release",
					"fid" => $fid,
					"order_cd" => $_POST['order_cd'],
					"workplan_cd" => $_POST['workplan_cd'],
					"work_cd" => $_POST['work_cd'],
					"object_item_cd" => $item_cd[$key],
					"object_item_standard1" => $standard1[$key],
					"process" => $process[$key],
					"machine" => $machine[$key],
					"item_cd" => $item_cd[$key],
					"item_nm" => $item_nm[$key],
					"standard1" => $standard1[$key],
					"standard2" => $standard2[$key],
					"standard3" => $standard3[$key],
					"cnt" => $order_cnt[$key],
					"status" => "stay",
					"emp_id" => $_SESSION['login_id'],
					"create_dt" => $now
				);

				$production->insert($data);
			}
		}
	}

	$this->movePage("production","listPageWork");
	}

	public function listPageQc(){
		require_once("views/production/listQc.php");
	}

	// 불량관리
	public function listPageDefective(){
		require_once("views/production/listDefective.php");
	}

	// 생산 작업지시 수정 페이지
	public function modifyPageWork(){
		$t = Production::getWork($_GET['uid']);
		require_once ("views/production/modifyWork.php");
	}


	// 생산계획 수정 페이지
	public function modifyPageWorkPlan(){
		$t = Production::getWorkPlan($_GET['uid']);
		require_once ("views/production/modifyWorkPlan.php");
	}

	
	
	// 생산계획별 소요자재 현황 조회 리스트 페이지
	public function listPageWorkPlanBom() {
		require_once ("views/production/listWorkPlanBom.php");
	}

	public function viewPageWorkPlanBom() {
		$t = Production::getWorkPlan($_GET['uid']);
		require_once ("views/production/viewWorkPlanBom.php");
	}

	// 외주공정
	public function inputPageOutsourcing() {
		require_once ("views/production/createOutsourcing.php");
	}

	// 원가관리
	public function listPageProductionPrice() {
		require_once ("views/production/listProductionPrice.php");
	}

	//실적관리
	public function registProductPerfReports() {
		require_once ("views/production/createProductPerfReports.php");
	}
	
	//press 생산실적 리스트
	public function listProductPerfReports() {
		require_once ("views/production/listProductPerfReports.php");
	}

	public function modifyProductPerfReports() {
		$t = Production::getProductPerfReports($_GET['uid']);
		
		require_once ("views/production/modifyProductPerfReports.php");
	}

	//도금 생산실적 리스트
	public function listProductPerfPlate() {
		require_once ("views/production/listProductPerfPlate.php");
	}

	public function registProductPerfPlate(){
		require_once("views/production/createProductPerfPlate.php");

	}

	public function modifyProductPerfPlate(){
		$t = Production::getProductPerfReports($_GET['uid']);
		require_once("views/production/modifyProductPerfPlate.php");

	}

	//실적등록 도금
	public function inputPagePlate(){
		  
		$now = date("Y-m-d H:i:s");
		$sql = "select max(production_cha) as cnt from erp_product_perf_repost where production_dt='".$_POST['production_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$production_cha = "1";
		}else{
			$production_cha = $t0->cnt+1;
		}

		$production_cd  = $_POST['production_dt']."-".$production_cha;
		
		 $p_plan_tm		= $_POST['p_plan_tm1']."~".$_POST['p_plan_tm2'];

		 $lot_no_cd = implode("|", $_POST['lot_no_cd']);
		 $lot_no_nm = implode("|", $_POST['lot_no_nm']);

		if($_POST['LOT_NO']==""){
			$lot_no = "TS_LOT".date("ymdhi",time());  //공정이동표출력으로 인한 로트NO
		}else{
			$lot_no = $_POST['LOT_NO'];  //공정이동표출력으로 인한 로트NO
		}
		
		$data = array(
			"table"				=> "erp_product_perf_repost",
			"production_dt"			=> $_POST['production_dt'],
			"production_cd"			=> $production_cd,
			"production_cha"		=> $production_cha,
			"day_gubun"			=> $_POST['day_gubun'],
			"process_cd"			=> $_POST['process_cd'],
			"process_nm"			=> $_POST['process_nm'],
			"machine_uid"			=> $_POST['machine_uid'],
			"machine_nm"			=> $_POST['machine_nm'],
			"p_plan_tm"			=> $p_plan_tm,
			"order_qty"			=> str_replace(",","",$_POST['order_qty']),
			"p_now_tm"			=> $_POST['p_now_tm'],
			"target_qty"			=> str_replace(",","",$_POST['target_qty']),
			"output_qty"			=> str_replace(",","",$_POST['output_qty']),
			"working_efficiency"		=> $_POST['working_efficiency'],
			"item_cd"			=> $_POST['item_cd'],
			"item_nm"			=> $_POST['item_nm'],
			"standard1"			=> $_POST['standard1'],
			"standard2"			=> $_POST['standard2'],
			"standard3"			=> $_POST['standard3'],
			"pass_qty"			=> str_replace(",","",$_POST['pass_qty']),
			"work_cd"			=> $_POST['work_cd'],
			"work_bom"			=> $_POST['work_bom'],
			"publish_qty"			=> str_replace(",","",$_POST['publish_qty']),
			"emp_id"			=> $_POST['emp_id'],
			"emp_nm"			=> $_POST['emp_nm'],
			"writer"			=> $_POST['emp_nm'],
			"faulty_qty1"			=> $_POST['faulty_qty1'],
			"faulty_type1"			=> $_POST['faulty_type1'],
			"faulty_qty2"			=> $_POST['faulty_qty2'],
			"faulty_type2"			=> $_POST['faulty_type2'],
			"box_limit_qty"			=> str_replace(",","",$_POST['box_limit_qty']),
			"loss_item"			=> $_POST['loss_item'],
			"loss_time"			=> $_POST['loss_time'],
			"LOT_NO"			=> $lot_no,
			"lot_no_cd"			=> $lot_no_cd,
			"lot_no_nm"			=> $lot_no_nm,
			"regdate"			=> $now,
			//"shipment_dt"			=> $_POST['shipment_dt']
		);

		$production = new Production;
		$pid = $production->productPPReportsInserts($data); 
		//$pid = mysql_insert_id();
		
		if ($pid >=0){

			for($i=1 ; $i <= $_POST['publish_qty']; $i++) {
					
					$lotNo = $lot_no.$i;  //공정이동표출력으로 인한 로트NO
					
					$data = array(
						"table"		=> "erp_product_perf_repost_barcode",
						"uid"		=> $pid,
						"lot_no"	=> $lotNo,
						"regdate"	=> $now
					);
					$result = $production->insert($data);
			}

			//생산에 사용되는 품목 아이템 LOT_NO 번호를 테이블에 저장하는 오직 추가
			$warehousing_cd			= $_POST['warehousing_cd'];
			$lot_no_cd			= $_POST['lot_no_cd'];
			$lot_no_nm			= $_POST['lot_no_nm'];
			$lot_item_cd			= $_POST['lot_item_cd'];
			$lot_item_nm			= $_POST['lot_item_nm'];
			$lot_standard			= $_POST['lot_standard'];
			$lot_material			= $_POST['lot_material'];
			$regdate_item			= $_POST['regdate_item'];
			$warehousing_dt			= $_POST['regdate'];

			foreach($lot_item_cd as $key => $val){
				if($val != ""){
					$data = array(
						"table"				=> "erp_product_perf_repost_item",
						"fid"				=> $pid,
						"warehousing_cd"	=> $warehousing_cd[$key],
						"warehousing_dt"	=> substr($warehousing_dt[$key],0,10),
						"item_cd"			=> $lot_item_cd[$key],
						"item_nm"			=> $lot_item_nm[$key],
						"standard1"			=> $lot_standard[$key],
						"material"			=> $lot_material[$key],
						"lot_no_cd"			=> $lot_no_cd[$key],
						"lot_no_nm"			=> $lot_no_nm[$key],
						"lot_no_nm"			=> $regdate_item[$key],
						"regdate"			=> $now
					);
					
					$production->insert($data);
				}
			}


			//생산입고 버튼 체크시 
			//product_stock_in= $_POST['product_stock_in'];
			//입고 창고 선택

		}
		//exit;
		$this->movePageClose($_POST['dialogID']);
	}


	
	//생산실적관리 등록
	public function registProductPerfReportsInsert() {
		//echo "dialogID=>".$_POST['dialogID'];
		//exit;
		$now = date("Y-m-d H:i:s");
		
		$sql = "select max(production_cha) as cnt from erp_product_perf_repost where production_dt='".$_POST['production_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$production_cha = "1";
		}else{
			$production_cha = $t0->cnt+1;
		}

		$production_cd  = $_POST['production_dt']."-".$production_cha;

		 $p_plan_tm		= $_POST['p_plan_tm1']."~".$_POST['p_plan_tm2'];

		 $lot_no_cd = implode("|", $_POST['lot_no_cd']);
		 $lot_no_nm = implode("|", $_POST['lot_no_nm']);

		if($_POST['LOT_NO']==""){
			$lot_no = "TS-LOT".date("ymdhi",time());  //공정이동표출력으로 인한 로트NO
		}else{
			$lot_no = $_POST['LOT_NO'];  //공정이동표출력으로 인한 로트NO
		}
		
		$data = array(
			"table"					=> "erp_product_perf_repost",
			"production_dt"			=> $_POST['production_dt'],
			"production_cd"			=> $production_cd,
			"production_cha"		=> $production_cha,
			"day_gubun"				=> $_POST['day_gubun'],
			"process_cd"			=> $_POST['process_cd'],
			"process_nm"			=> $_POST['process_nm'],
			"machine_uid"			=> $_POST['machine_uid'],
			"machine_nm"			=> $_POST['machine_nm'],
			"mold_cd"				=> $_POST['mold_cd'],
			"mold_nm"				=> $_POST['mold_nm'],
			"mold_item_cd"			=> $_POST['mold_item_cd'], //금형부품
			"mold_item_nm"			=> $_POST['mold_item_nm'], //금형코드
			"p_plan_tm"				=> $p_plan_tm,
			"order_qty"				=> str_replace(",","",$_POST['order_qty']),
			"p_now_tm"				=> $_POST['p_now_tm'],
			"target_qty"			=> str_replace(",","",$_POST['target_qty']),
			"output_qty"			=> str_replace(",","",$_POST['output_qty']),
			"working_efficiency"	=> $_POST['working_efficiency'],
			"item_cd"				=> $_POST['item_cd'],
			"item_nm"				=> $_POST['item_nm'],
			"standard1"				=> $_POST['standard1'],
			"standard2"				=> $_POST['standard2'],
			"standard3"				=> $_POST['standard3'],
			"pass_qty"				=> str_replace(",","",$_POST['pass_qty']),
			"work_cd"				=> $_POST['work_cd'],
			"work_bom"				=> $_POST['work_bom'],
			"publish_qty"			=> str_replace(",","",$_POST['publish_qty']),
			"emp_id"				=> $_POST['emp_id'],
			"emp_nm"				=> $_POST['emp_nm'],
			"writer"				=> $_POST['writer'],
			"faulty_qty1"			=> $_POST['faulty_qty1'],
			"faulty_type1"			=> $_POST['faulty_type1'],
			"faulty_qty2"			=> $_POST['faulty_qty2'],
			"faulty_type2"			=> $_POST['faulty_type2'],
			"faulty_qty3"			=> $_POST['faulty_qty3'],
			"faulty_type3"			=> $_POST['faulty_type3'],
			"faulty_qty4"			=> $_POST['faulty_qty4'],
			"faulty_type4"			=> $_POST['faulty_type4'],
			"faulty_qty5"			=> $_POST['faulty_qty5'],
			"faulty_type5"			=> $_POST['faulty_type5'],
			"faulty_qty6"			=> $_POST['faulty_qty6'],
			"faulty_type6"			=> $_POST['faulty_type6'],
			"faulty_qty7"			=> $_POST['faulty_qty7'],
			"faulty_type7"			=> $_POST['faulty_type7'],
			"faulty_type1_1"		=> $_POST['faulty_type1_1'],
			"faulty_type2_1"		=> $_POST['faulty_type2_1'],
			"box_limit_qty"			=> str_replace(",","",$_POST['box_limit_qty']),
			"loss_item"				=> $_POST['loss_item'],
			"loss_time"				=> $_POST['loss_time'],
			"LOT_NO"				=> $lot_no,
			"lot_no_cd"				=> $lot_no_cd,
			"lot_no_nm"				=> $lot_no_nm,
			"regdate"				=> $now
		);

		$production = new Production;
		$pid = $production->productPerfReportsInsert($data); 
		//$pid = mysql_insert_id();

		if ($pid >=0){
		for($i=1 ; $i <= $_POST['publish_qty']; $i++) {
				
				$lotNo = $lot_no.$i;  //공정이동표출력으로 인한 로트NO
				
				$data = array(
					"table"		=> "erp_product_perf_repost_barcode",
					"uid"		=> $pid,
					"lot_no"	=> $lotNo,
					"regdate"	=> $now
				);
				$result = $production->productPerfReportsLotNoInsert($data);
		}

		//생산에 사용되는 품목 아이템 LOT_NO 번호를 테이블에 저장하는 로직 추가
			$warehousing_cd			= $_POST['warehousing_cd'];
			$lot_no_cd			= $_POST['lot_no_cd'];
			$lot_no_nm			= $_POST['lot_no_nm'];
			$lot_item_cd			= $_POST['lot_item_cd'];
			$lot_item_nm			= $_POST['lot_item_nm'];
			$lot_standard			= $_POST['lot_standard'];
			$lot_material			= $_POST['lot_material'];
			$regdate_item			= $_POST['regdate_item'];
			$warehousing_dt			= $_POST['regdate'];
			$bom_cnt			= $_POST['bom_cnt'];
			$input_uid			= $_POST['input_uid']; 

			$decrease_cnt2 = $_POST['faulty_qty1'] + $_POST['faulty_qty2'] + str_replace(",","",$_POST['output_qty']); //생산수량.+ 불량수량

			foreach($lot_item_cd as $key => $val) {
				if($val != "") {
					$data = array(
						"table"				=> "erp_product_perf_repost_item",
						"fid"				=> $pid,
						"warehousing_cd"		=> $warehousing_cd[$key],
						"warehousing_dt"		=> substr($warehousing_dt[$key],0,10),
						"item_cd"			=> $lot_item_cd[$key],
						"item_nm"			=> $lot_item_nm[$key],
						"standard1"			=> $lot_standard[$key],
						"material"			=> $lot_material[$key],
						"lot_no_cd"			=> $lot_no_cd[$key],
						"lot_no_nm"			=> $lot_no_nm[$key],
						"regdate_item"			=> $regdate_item[$key],
						"regdate"			=> $now
					);
					
					$production->insert($data);
					

					//태성은 실적등록하고서도 수정하는 경우가 많으므로. 출고후 투입대기품목인것 태성에서 스스로 삭제하여 관리할수잇도록 처리.2019-04-10
				}
			}
			//생산실적 금형 타수 입력 20180723
			$sql = "select valid_hit_count from erp_mold where mold_cd='".$_POST['mold_cd']."'";
			//echo $sql."<BR>"; 
			$t1 = mysql_fetch_object(mysql_query($sql));
			$valid_hit_count = $t1->valid_hit_count;
			
			$data = array(
				"table"					=> "erp_mold_hits",
				"mold_cd"				=> $_POST['mold_cd'],
				"mold_nm"				=> $_POST['mold_nm'],
				"production_cd"			=> $production_cd,
				"valid_hit_count"		=> $valid_hit_count,
				"valid_hit_be_count"	=> str_replace(",","",$_POST['output_qty']),  //생산실적수량으로 처리
				"regdate"	=> $now
			);
			$production->insert($data);

			//생산실적 금형 부품 타수 입력 20180730
			$sql1 = "select valid_item_hit_cnt from erp_mold_item where mold_cd='".$_POST['mold_cd']."' and item_cd='".$_POST['mold_item_cd']."'";
			//echo $sql."<BR>"; 
			$t2 = mysql_fetch_object(mysql_query($sql1));
			$valid_item_hit_cnt = $t2->valid_item_hit_cnt;
			
			$data = array(
				"table"					=> "erp_mold_item_hits",
				"mold_cd"				=> $_POST['mold_cd'],
				"mold_nm"				=> $_POST['mold_nm'],
				"item_cd"				=> $_POST['mold_item_cd'],
				"item_cd"				=> $_POST['mold_item_nm'],
				"production_cd"			=> $production_cd,
				"valid_hit_count"		=> $valid_item_hit_cnt,
				"valid_hit_be_count"	=> str_replace(",","",$_POST['output_qty']),  //생산실적수량으로 처리
				"regdate"	=> $now
			);
			$production->insert($data);
		}	
		
		//echo "dialogID=>".$_POST['dialogID']; // 크롬에서 팝업창 닫히지 않는 문제
		
		//exit;
		$this->movePageClose($_POST['dialogID']);
		//exit;
	}

	//생산실적처리 수정.
	public function registProductPerfReportsUpdate() {

		$now = date("Y-m-d H:i:s");
		
		 $p_plan_tm		= $_POST['p_plan_tm1']."~".$_POST['p_plan_tm2'];

		 $lot_no_cd = implode("|", $_POST['lot_no_cd']);
		 $lot_no_nm = implode("|", $_POST['lot_no_nm']);

		if($_POST['LOT_NO']==""){
			$lot_no = "TS-LOT".date("ymdhi",time());  //공정이동표출력으로 인한 로트NO
		}else{
			$lot_no = $_POST['LOT_NO'];  //공정이동표출력으로 인한 로트NO
		}

		$data = array(
			"table"				=> "erp_product_perf_repost",
			"where"				=> "uid=".$_POST['uid'],
			"production_dt"			=> $_POST['production_dt'],
			"day_gubun"			=> $_POST['day_gubun'],
			"process_cd"			=> $_POST['process_cd'],
			"process_nm"			=> $_POST['process_nm'],
			"machine_uid"			=> $_POST['machine_uid'],
			"machine_nm"			=> $_POST['machine_nm'],
			"mold_cd"			=> $_POST['mold_cd'],
			"mold_nm"			=> $_POST['mold_nm'],
			"mold_item_cd"			=> $_POST['mold_item_cd'],
			"mold_item_nm"			=> $_POST['mold_item_nm'],
			"p_plan_tm"			=> $p_plan_tm,
			"order_qty"			=> str_replace(",","",$_POST['order_qty']),
			"p_now_tm"			=> $_POST['p_now_tm'],
			"target_qty"			=> str_replace(",","",$_POST['target_qty']),
			"output_qty"			=> str_replace(",","",$_POST['output_qty']),
			"working_efficiency"		=> $_POST['working_efficiency'],
			"item_cd"				=> $_POST['item_cd'],
			"item_nm"				=> $_POST['item_nm'],
			"standard1"				=> $_POST['standard1'],
			"standard2"				=> $_POST['standard2'],
			"standard3"				=> $_POST['standard3'],
			"pass_qty"				=> str_replace(",","",$_POST['pass_qty']),
			"work_cd"				=> $_POST['work_cd'],
			"work_bom"				=> $_POST['work_bom'],
			"publish_qty"			=> str_replace(",","",$_POST['publish_qty']),
			"emp_id"				=> $_POST['emp_id'],
			"emp_nm"				=> $_POST['emp_nm'],			
			"writer"				=> $_POST['writer'],
			"faulty_qty1"			=> $_POST['faulty_qty1'],
			"faulty_type1"			=> $_POST['faulty_type1'],
			"faulty_qty2"			=> $_POST['faulty_qty2'],
			"faulty_type2"			=> $_POST['faulty_type2'],
			"faulty_qty3"			=> $_POST['faulty_qty3'],
			"faulty_type3"			=> $_POST['faulty_type3'],
			"faulty_qty4"			=> $_POST['faulty_qty4'],
			"faulty_type4"			=> $_POST['faulty_type4'],
			"faulty_qty5"			=> $_POST['faulty_qty5'],
			"faulty_type5"			=> $_POST['faulty_type5'],
			"faulty_qty6"			=> $_POST['faulty_qty6'],
			"faulty_type6"			=> $_POST['faulty_type6'],
			"faulty_qty7"			=> $_POST['faulty_qty7'],
			"faulty_type7"			=> $_POST['faulty_type7'],
			"faulty_type1_1"		=> $_POST['faulty_type1_1'],
			"faulty_type2_1"		=> $_POST['faulty_type2_1'],
			"box_limit_qty"			=> $_POST['box_limit_qty'],
			"loss_item"				=> $_POST['loss_item'],
			"loss_time"				=> $_POST['loss_time'],
			"LOT_NO"				=> $lot_no,
			"lot_no_cd"				=> $lot_no_cd,
			"lot_no_nm"				=> $lot_no_nm,
			"regdate"				=> $now
		);

		$production = new Production;
		$result = $production->update($data); 

		//LOT_NO가 변경되거나 바코드번호가 변경되면 삭제 후 처리 로직 //공정이동간(공정이동표출력용) LOT_NO
		$sql4 = "select LOT_NO from erp_product_perf_repost where uid='".$_POST['uid']."'";
		//echo $sql."<BR>"; 
		$t4 = mysql_fetch_object(mysql_query($sql4));
		
		if ($t4->LOT_NO!= $lot_no){

			$sql = "delete from erp_product_perf_repost_barcode where uid = '".$_POST['uid']."'";
			mysql_query($sql);
			for($i=1 ; $i <= $_POST['publish_qty']; $i++) {
					
					$lotNo = $lot_no.$i;  //공정이동표출력으로 인한 로트NO
					
					$data = array(
						"table"		=> "erp_product_perf_repost_barcode",
						"uid"		=> $_POST['uid'],
						"lot_no"	=> $lotNo,
						"regdate"	=> $now
					);
					$result = $production->productPerfReportsLotNoInsert($data);
			}
		}

		//생산에 사용되는 품목 아이템 LOT_NO 번호를 테이블에 저장하는 로직 추가
		$warehousing_cd			= $_POST['warehousing_cd'];
		$warehousing_dt			= $_POST['warehousing_dt'];
		$lot_no_cd				= $_POST['lot_no_cd'];
		$lot_no_nm				= $_POST['lot_no_nm'];
		$lot_item_cd			= $_POST['lot_item_cd'];
		$lot_item_nm			= $_POST['lot_item_nm'];
		$lot_standard			= $_POST['lot_standard'];
		$lot_material			= $_POST['lot_material'];
		$regdate_item			= $_POST['regdate_item'];
		$warehousing_dt			= $_POST['regdate']; // 구매입고일..기존코드가 복잡하여 변수명 따로 생성..

		foreach($lot_item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"				=> "erp_product_perf_repost_item",
					"where"				=> "fid=".$_POST['uid'],
					"warehousing_cd"		=> $warehousing_cd[$key],
					"warehousing_dt"		=> $warehousing_dt[$key],	//구매입고일
					"item_cd"			=> $lot_item_cd[$key],
					"item_nm"			=> $lot_item_nm[$key],
					"standard1"			=> $lot_standard[$key],
					"material"			=> $lot_material[$key],
					"lot_no_cd"			=> $lot_no_cd[$key],
					"lot_no_nm"			=> $lot_no_nm[$key],
					"regdate_item"			=> $regdate_item[$key],
					"regdate"			=> $now
				);
				
				$production->update($data);
			}
		}
	
		//생산실적 금형 타수 입력 20180723
		$sql = "select valid_hit_count from erp_mold where mold_cd='".$_POST['mold_cd']."'";
		//echo $sql."<BR>"; 
		$t1 = mysql_fetch_object(mysql_query($sql));
		$valid_hit_count = $t1->valid_hit_count;
		
		$sql = "delete from erp_mold_hits where mold_cd = '".$_POST['mold_cd']."' and production_cd='".$_POST['production_cd']."' ";
		mysql_query($sql);
		
		$data = array(
			"table"					=> "erp_mold_hits",
			"mold_cd"				=> $_POST['mold_cd'],
			"mold_nm"				=> $_POST['mold_nm'],
			"production_cd"			=> $_POST['production_cd'],
			"valid_hit_count"		=> $valid_hit_count,
			"valid_hit_be_count"	=> str_replace(",","",$_POST['output_qty']),  //생산실적수량으로 처리
			"regdate"	=> $now
		);
		$production->insert($data);

		//생산실적 금형 부품 타수 입력 20180730
		$sql1 = "select valid_item_hit_cnt from erp_mold_item where mold_cd='".$_POST['mold_cd']."' and item_cd='".$_POST['mold_item_cd']."'";
		//echo $sql."<BR>"; 
		$t2 = mysql_fetch_object(mysql_query($sql1));
		$valid_item_hit_cnt = $t2->valid_item_hit_cnt;
		
		$sql = "delete from erp_mold_item_hits where mold_cd = '".$_POST['mold_cd']."' and mold_item_cd = '".$_POST['mold_item_cd']."' and production_cd='".$_POST['production_cd']."' ";
		mysql_query($sql);

		$data = array(
			"table"					=> "erp_mold_item_hits",
			"mold_cd"				=> $_POST['mold_cd'],
			"mold_nm"				=> $_POST['mold_nm'],
			"item_cd"				=> $_POST['mold_item_cd'],
			"item_cd"				=> $_POST['mold_item_nm'],
			"production_cd"			=> $_POST['production_cd'],
			"valid_hit_count"		=> $valid_item_hit_cnt,
			"valid_hit_be_count"	=> str_replace(",","",$_POST['output_qty']),  //생산실적수량으로 처리
			"regdate"	=> $now
		);
		$production->insert($data);
		
		//echo "dialogID=>".$_POST['dialogID']; // 크롬에서 팝업창 닫히지 않는 문제
		
		//exit;
		$this->movePageClose($_POST['dialogID']);
		//exit;
	}
					
	public function productPerfReportsPrint() {
		require_once ("views/production/printProductPerfReports.php");
	}
	
	public function viewPageproductPerfReports() {
		$t = Production::getProductPerfReports($_GET['uid']);
		require_once ("views/production/viewProductPerfReports.php");
	}

	public function listLotNoManagementLedger() {
		require_once ("views/production/listLotNoManagementLedger.php");
	}
	
	public function listLotNoManagementReport() {
		require_once ("views/production/listLotNoManagementReport.php");
	}

	public function listLotNoItem() { //lot번호에 따른 보유 원자재 조회
		require_once ("views/production/listLotNoItemPop.php");
	}

	public function listLotNoItem2() { //원자재 출고후 투입대기 상테에 있는것 조회.
		require_once ("views/production/listLotNoItemPop2.php");
	}

	//개인별 실적 처리 
	public function listPageProductOutput() {
		require_once ("views/production/listProductOutput.php");
	}
		
	public function registpageProductOutput() {
		require_once ("views/production/createProductOutput.php");
	}
	
	public function modifypageProductOutput() {
		$t = Production::getProductOutput($_GET['uid']);
		require_once ("views/production/modifyProductOutput.php");
	}

	public function inputProductOutput() {

		$now = date("Y-m-d H:i:s");
		
		 $p_plan_tm		= $_POST['p_plan_tm1']."~".$_POST['p_plan_tm2'];

		 $lot_no_cd = implode("|", $_POST['lot_no_cd']);
		 $lot_no_nm = implode("|", $_POST['lot_no_nm']);

		if($_POST['LOT_NO']==""){
			$lot_no = "TS-LOT".date("ymdhi",time());  //공정이동표출력으로 인한 로트NO
		}else{
			$lot_no = $_POST['LOT_NO'];  //공정이동표출력으로 인한 로트NO
		}
		
		$data = array(
			"table"					=> "erp_product_output",
			"production_dt"			=> $_POST['production_dt'],
			"day_gubun"				=> $_POST['day_gubun'],
			"process_cd"			=> $_POST['process_cd'],
			"process_nm"			=> $_POST['process_nm'],
			"machine_uid"			=> $_POST['machine_uid'],
			"machine_nm"			=> $_POST['machine_nm'],
			"p_plan_tm"				=> $p_plan_tm,
			"order_qty"				=> str_replace(",","",$_POST['order_qty']),
			"p_now_tm"				=> $_POST['p_now_tm'],
			"target_qty"			=> str_replace(",","",$_POST['target_qty']),
			"output_qty"			=> str_replace(",","",$_POST['output_qty']),
			"working_efficiency"	=> $_POST['working_efficiency'],
			"item_cd"				=> $_POST['item_cd'],
			"item_nm"				=> $_POST['item_nm'],
			"standard1"				=> $_POST['standard1'],
			"pass_qty"				=> str_replace(",","",$_POST['pass_qty']),
			"work_cd"				=> $_POST['work_cd'],
			"work_bom"				=> $_POST['work_bom'],
			"publish_qty"			=> str_replace(",","",$_POST['publish_qty']),
			"emp_id"				=> $_POST['emp_id'],
			"emp_nm"				=> $_POST['emp_nm'],
			"writer"				=> $_POST['writer'],
			"faulty_qty1"			=> $_POST['faulty_qty1'],
			"faulty_type1"			=> $_POST['faulty_type1'],
			"box_limit_qty"			=> str_replace(",","",$_POST['box_limit_qty']),
			"loss_item"				=> $_POST['loss_item'],
			"loss_time"				=> $_POST['loss_time'],
			"LOT_NO"				=> $lot_no,
			"lot_no_cd"				=> $lot_no_cd,
			"lot_no_nm"				=> $lot_no_nm,
			"regdate"				=> $now
		);

		$productoutput = new Production;
		$result = $productoutput->insert($data); 
		$pid = mysql_insert_id();

		for($i=1 ; $i <= $_POST['publish_qty']; $i++) {
				
				$lotNo = $lot_no.$i;  //공정이동표출력으로 인한 로트NO
				
				$data = array(
					"table"		=> "erp_product_output_barcode",
					"uid"		=> $pid,
					"lot_no"	=> $lotNo,
					"regdate"	=> $now
				);
				$result = $productoutput->insert($data);
		}

		//생산에 사용되는 품목 아이템 LOT_NO 번호를 테이블에 저장하는 오직 추가

		//exit;
		$this->movePageClose($_POST['dialogID']);
	}

	public function updateProductOutput() {

		$now = date("Y-m-d H:i:s");
		
		 $p_plan_tm		= $_POST['p_plan_tm1']."~".$_POST['p_plan_tm2'];

		 $lot_no_cd = implode("|", $_POST['lot_no_cd']);
		 $lot_no_nm = implode("|", $_POST['lot_no_nm']);

		$data = array(
			"table"					=> "erp_product_output",
			"where"					=> "uid=".$_POST['uid'],
			"production_dt"			=> $_POST['production_dt'],
			"day_gubun"				=> $_POST['day_gubun'],
			"process_cd"			=> $_POST['process_cd'],
			"process_nm"			=> $_POST['process_nm'],
			"machine_uid"			=> $_POST['machine_uid'],
			"machine_nm"			=> $_POST['machine_nm'],
			"p_plan_tm"				=> $p_plan_tm,
			"order_qty"				=> str_replace(",","",$_POST['order_qty']),
			"p_now_tm"				=> $_POST['p_now_tm'],
			"target_qty"			=> str_replace(",","",$_POST['target_qty']),
			"output_qty"			=> str_replace(",","",$_POST['output_qty']),
			"working_efficiency"	=> $_POST['working_efficiency'],
			"item_cd"				=> $_POST['item_cd'],
			"item_nm"				=> $_POST['item_nm'],
			"standard1"				=> $_POST['standard1'],
			"pass_qty"				=> str_replace(",","",$_POST['pass_qty']),
			"work_cd"				=> $_POST['work_cd'],
			"work_bom"				=> $_POST['work_bom'],
			"publish_qty"			=> str_replace(",","",$_POST['publish_qty']),
			"emp_id"				=> $_POST['emp_id'],
			"emp_nm"				=> $_POST['emp_nm'],			
			"writer"				=> $_POST['writer'],
			"faulty_qty1"			=> $_POST['faulty_qty1'],
			"faulty_type1"			=> $_POST['faulty_type1'],
			"box_limit_qty"			=> $_POST['box_limit_qty'],
			"loss_item"				=> $_POST['loss_item'],
			"loss_time"				=> $_POST['loss_time'],
			"LOT_NO"				=> $_POST['LOT_NO'],
			"lot_no_cd"				=> $lot_no_cd,
			"lot_no_nm"				=> $lot_no_nm,
			"regdate"				=> $now
		);

		$productoutput = new Production;
		$result = $productoutput->update($data); 
		/*
		for($i=1 ; $i <= $_POST['publish_qty']; $i++) {
				//$lot_no = $cd = "TS-LOT".time().$i;
				$lot_no = $cd = "TS-LOT".date("ymdhi",time()).$i;
				
				$data = array(
					"table"		=> "erp_product_output_barcode",
					"uid"		=> $pid,
					"lot_no"	=> $lot_no,
					"regdate"	=> $now
				);
				$result = $productoutput->productoutputLotNoInsert($data);
		}
		*/
	
		//생산에 사용되는 품목 아이템 LOT_NO 번호를 테이블에 저장하는 오직 추가

		$this->movePageClose($_POST['dialogID']);
	//exit;
	}

		// 작업지시서 리스트
	public function listPageWorkOrder() {
		require_once ("views/production/listWorkOrder.php");
	}
	
	// 생산계획 리스트 화면
	public function registPageWorkOrderPop() {
		require_once ("views/production/createWorkOrder_pop.php");
	}
	
	// 작업지시서 등록
	public function modifyPageWorkOrderPop(){
		$t = Production::getWorkOrder($_GET['uid']);
		require_once ("views/production/modifyWorkOrder_pop.php");
	}

	//작업지시서 등록
	public function inputPageWorkOrder() {
		$production = new Production;

		$now = date("Y-m-d H:i:s");
		
		$fileAttach = $this->upload('attach');
		
		$sql = "select max(work_cha) as cnt from erp_work where work_dt='".$_POST['work_dt']."'";
		
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$work_cha = "1";
		}else{
			$work_cha = $t0->cnt+1;
		}

		$work_cd  = $_POST['work_dt']."-".$work_cha;

		$process		= $_POST['process'];
		$machine		= $_POST['machine'];
		$item_cd		= $_POST['item_cd'];
		$item_nm		= $_POST['item_nm'];
		$standard1		= $_POST['standard1'];
		$material		= $_POST['material'];
		$unit			= $_POST['unit'];
		$goal_cnt		= $_POST['goal_cnt'];
		$order_cnt		= $_POST['order_cnt'];
		$cntTotal		= $_POST['cntTotal'];
		$make_cnt		= 0;
		$remain_cnt		= $_POST['remain_cnt'];
		$seq			= $_POST['seq'];
		$warehouse_cd		= $_POST['warehouse_cd'];
		$warehouse_nm		= $_POST['warehouse_nm'];
		$work_start_dt		= $_POST['work_start_dt'];
		//$work_end_dt		= $_POST['work_end_dt'];
		$remark			= $_POST['remark'];
		$shortage_cnt		= $_POST['shortage_cnt'];
		$state			= $_POST['state'];
		$machine_nm		= $_POST['machine_nm'];
		$machine_cd		= $_POST['machine_cd'];

		$data = array(
			"table"			=> "erp_work",
			"work_dt"		=> $_POST['work_dt'],
			"work_cha"		=> $work_cha,
			"work_cd"		=> $work_cd,
			"workplan_cd"	=> $_POST['workplan_cd'],
			"order_cd"		=> $_POST['order_cd'],
			"start_dt"		=> $_POST['work_start_dt'],
			//"end_dt"		=> $_POST['work_end_dt'],	//erp_work DB 에서 삭제 2018.10.16
			"project_cd"	=> $_POST['project_cd'],
			"project_nm"	=> $_POST['project_nm'],
			"account_cd"	=> $_POST['account_cd'],
			"account_nm"	=> $_POST['account_nm'],
			"manager"		=> $_POST['manager'],
			"warehouse_cd"	=> $_POST['warehouse_cd'],
			"warehouse_nm"	=> $_POST['warehouse_nm'],
			//"deadline_dt"	=> $_POST['deadline_dt'],		//erp_work DB 에서 삭제 2018.10.16
			"cntTotal"		=> $this->replaceComma($_POST['cntTotal']),
			"attach"		=> $fileAttach,
			"remark"		=> $_POST['remark'],
			"state"			=> "1",
			"emp_id"		=> $_SESSION['login_id'],
			"create_dt"		=> $now
		);
		//var_dump($data);
		$wid = $production->inputWork($data);

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_work_item",
					"wid" => $wid,
					"order_cd" => $_POST['order_cd'],
					"workplan_cd" => $_POST['workplan_cd'],
					"work_cd" => $work_cd,
					//"process" =>  $process[$key],
					//"machine" =>  $machine[$key],
					"item_cd"			=>  $item_cd[$key],
					"item_nm"			=>  $item_nm[$key],
					"standard1"			=> $standard1[$key],
					"material"			=> $material[$key],
					"unit"				=> $unit[$key],
					"goal_cnt"		=> $this->replaceComma($goal_cnt[$key]),
					"order_cnt"		=> $this->replaceComma($order_cnt[$key]),
					"make_cnt"		=> $this->replaceComma($make_cnt),
					"remain_cnt"	=> $this->replaceComma( $order_cnt[$key]),
					"shortage_cnt"	=> $this->replaceComma($shortage_cnt[$key]),
					"seq"			=> $this->replaceComma($seq[$key]),
					"warehouse_cd"		=> $warehouse_cd[$key],
					"warehouse_nm"		=> $warehouse_nm[$key],
					"emp_id"			=> $_SESSION['login_id'],
					"machine_nm"		=>$machine_nm[$key],
					"machine_cd"		=>$machine_cd[$key],
					"create_dt"			=> $now
				);
				
				//var_dump($data);
				$production->insert($data);
			}
		}
		
		$this->movePageClose($_POST['dialogID']);
		$this->movePage("production","listPageWork");
	}

	//작업지시서 수정
	public function updatePageWorkOrder() {
	$production = new Production;

	$now = date("Y-m-d H:i:s");
	$fileAttach = $this->upload('attach');

		$work_cd  = $_POST['work_dt']."-".$_POST['cha'];
	
		$process		= $_POST['process'];
		$machine		= $_POST['machine'];
		$item_cd		= $_POST['item_cd'];
		$item_nm		= $_POST['item_nm'];
		$standard1		= $_POST['standard1'];
		$material		= $_POST['material'];
		$unit			= $_POST['unit'];
		$goal_cnt		= $_POST['goal_cnt'];
		$order_cnt		= $_POST['order_cnt'];
		$cntTotal		= $_POST['cntTotal'];
		$make_cnt		= 0;
		$remain_cnt		= $_POST['remain_cnt'];
		$seq			= $_POST['seq'];
		$warehouse_cd		= $_POST['warehouse_cd'];
		$warehouse_nm		= $_POST['warehouse_nm'];
		$work_start_dt		= $_POST['work_start_dt'];
		$work_end_dt		= $_POST['work_end_dt'];
		$remark			= $_POST['remark'];
		$state			= $_POST['state'];
		$shortage_cnt		= $_POST['shortage_cnt'];
		$machine_nm		= $_POST['machine_nm'];
		$machine_cd		= $_POST['machine_cd'];
	
	$data = array(
		"table"				=> "erp_work",
		"where"				=> "uid=".$_POST['uid'],
		//"work_dt"			=> $_POST['work_dt'],
		//"work_cha"		=> $work_cha,
		//"work_cd"		=> $work_cd,
		"workplan_cd"		=> $_POST['workplan_cd'],
		"order_cd"			=> $_POST['order_cd'],
		"start_dt"			=> $_POST['work_start_dt'],
		"end_dt"				=> $_POST['work_end_dt'],
		"project_cd"		=> $_POST['project_cd'],
		"project_nm"		=> $_POST['project_nm'],
		"account_cd"		=> $_POST['account_cd'],
		"account_nm"		=> $_POST['account_nm'],
		"manager"			=> $_POST['manager'],
		"warehouse_cd"		=> $_POST['warehouse_cd'],
		"warehouse_nm"		=> $_POST['warehouse_nm'],
		"deadline_dt"		=> $_POST['deadline_dt'],
		"cntTotal"			=> $this->replaceComma($_POST['cntTotal']),
		"attach"				=> $fileAttach,
		"remark"			=> $_POST['remark'],
		"state"				=> "1",
		"emp_id"			=> $_SESSION['login_id'],
		"create_dt"			=> $now
	);
	$wid = $production->updateWork($data);

	$sql = "delete from erp_work_item where wid = '".$_POST['uid']."' ";
	mysql_query($sql);
		
	foreach($item_cd as $key => $val) {
		if($val != "") {
			$data = array(
				"table"			=> "erp_work_item",
				"wid"			=> $_POST['uid'],
				"work_cd"		=> $work_cd,
				"order_cd"		=> $_POST['order_cd'],
				"workplan_cd"		=> $_POST['workplan_cd'],
				//"work_cd"		=> $work_cd,
				"process"		=>  $process[$key],
				"machine"		=>  $machine[$key],
				"item_cd"		=>  $item_cd[$key],
				"item_nm"		=>  $item_nm[$key],
				"standard1"		=> $standard1[$key],
				"material"		=> $material[$key],
				"unit"				=> $unit[$key],
				"goal_cnt"		=> $this->replaceComma($goal_cnt[$key]),
				"order_cnt"		=> $this->replaceComma($order_cnt[$key]),
				"make_cnt"		=> $this->replaceComma($make_cnt),
				"remain_cnt"		=> $this->replaceComma( $order_cnt[$key]),
				"shortage_cnt"		=> $this->replaceComma($shortage_cnt[$key]),
				"seq"			=> $this->replaceComma($seq[$key]),
				"warehouse_cd"		=> $warehouse_cd[$key],
				"warehouse_nm"		=> $warehouse_nm[$key],
				"machine_nm"		=> $machine_nm[$key],
				"machine_cd"		=> $machine_cd[$key],
				"emp_id"		=> $_SESSION['login_id'],
				"create_dt"		=> $now
			);
			
			$fid = $production->insert($data);
			}
		}
	//exit;
	$this->movePageClose($_POST['dialogID']);
	//$this->movePage("production","listPageWork");
	}


	// 생산입고 리스트
	public function listPageProductionWearing() {
		require_once ("views/production/listProductionWearing.php");
	}
	
	// 생산입고 등록 화면
	public function registpageProductionWearing() {
		require_once ("views/production/createProductionWearing_pop.php");
	}
	
	// 생산입고 등록
	public function modifypageProductionWearing(){
		$t = Production::getProductionWearing($_GET['uid']);
		require_once ("views/production/modifyProductionWearing_pop.php");
	}


	public function inputPageProductionWearing() {
		$production = new Production;

		$now = date("Y-m-d H:i:s");
		
		$fileAttach = $this->upload('attach');
		
		$sql = "select max(wearing_cha) as cnt from erp_production_wearing where wearing_dt='".$_POST['wearing_dt']."'";
		
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$wearing_cha = "1";
		}else{
			$wearing_cha = $t0->cnt+1;
		}

		$wearing_cd  = $_POST['wearing_dt']."-".$wearing_cha;

		$data = array(
			"table"			=> "erp_production_wearing",
			"wearing_dt"	=> $_POST['wearing_dt'],
			"wearing_cha"	=> $wearing_cha,
			"wearing_cd"	=> $wearing_cd,
			"work_cd"		=> $_POST['work_cd'],
			"project_cd"	=> $_POST['project_cd'],
			"project_nm"	=> $_POST['project_nm'],
			"wh_cd_f"	=> $_POST['wh_cd_f'],
			"wh_nm_f"	=> $_POST['wh_nm_f'],
			"wh_cd_t"	=> $_POST['wh_cd_t'],
			"wh_nm_t"	=> $_POST['wh_nm_t'],
			"cntTotal"		=> $this->replaceComma($_POST['cntTotal']),
			"attach"		=> $fileAttach,
			"remark"		=> $_POST['remark'],
			"state"			=> "1",
			"emp_id"		=> $_POST['emp_id'],
			"emp_nm"		=> $_POST['emp_nm'],
			"create_dt"		=> $now
		);

		$fid = $production->inputProductionWearing($data);

		$process				= $_POST['process'];
		$machine				= $_POST['machine'];
		$item_cd				= $_POST['item_cd'];
		$item_nm				= $_POST['item_nm'];
		$standard1				= $_POST['standard1'];
		$material				= $_POST['material'];
		$unit					= $_POST['unit'];
		$cnt					= $_POST['cnt'];
		$outsourcing_unit_price	= $_POST['outsourcing_unit_price'];
		$outsourcing_tax		= $_POST['outsourcing_tax'];
		$outsourcing_total_price= $_POST['outsourcing_total_price'];
		$product_time			= $_POST['product_time'];
		$memo					= $_POST['memo'];
		$serial_cd				= $_POST['serial_cd'];
		$serial_nm				= $_POST['serial_nm'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_production_wearing_item",
					"wid" => $fid,
					"wearing_cd"		=> $wearing_cd,
					"item_cd"			=>  $item_cd[$key],
					"item_nm"			=>  $item_nm[$key],
					"standard1"			=> $standard1[$key],
					"material"			=> $material[$key],
					"unit"				=> $unit[$key],
					"cnt"				=> $this->replaceComma($cnt[$key]),
					"outsourcing_unit_price"=> $this->replaceComma($outsourcing_unit_price[$key]),
					"outsourcing_tax"		=> $this->replaceComma($outsourcing_tax),
					"outsourcing_total_price"	=> $this->replaceComma( $outsourcing_total_price[$key]),
					"product_time"	=> $product_time[$key],
					"memo"			=> $memo[$key],
					"serial_cd"		=> $serial_cd[$key],
					"serial_nm"		=> $serial_nm[$key],
					"create_dt"			=> $now
				);
				
				$production->insert($data);
			}
		}
		
		$this->movePageClose($_POST['dialogID']);
		//$this->movePage("production","listPageWork");
	}

	public function updatePageProductionWearing() {
	$production = new Production;

	$now = date("Y-m-d H:i:s");
	$fileAttach = $this->upload('attach');
	/*
	$sql = "select max(work_cha) as cnt from erp_production_wearing where work_dt='".$_POST['work_dt']."'";

	$t0 = mysql_fetch_object(mysql_query($sql));
	
	if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
		$work_cha = "1";
	}else{
		$work_cha = $t0->cnt+1;
	}

	$work_cd  = $_POST['work_dt']."-".$work_cha;
	*/

		$process		= $_POST['process'];
		$machine		= $_POST['machine'];
		$item_cd		= $_POST['item_cd'];
		$item_nm		= $_POST['item_nm'];
		$standard1		= $_POST['standard1'];
		$material		= $_POST['material'];
		$unit			= $_POST['unit'];
		$goal_cnt		= $_POST['goal_cnt'];
		$order_cnt		= $_POST['order_cnt'];
		$cntTotal		= $_POST['cntTotal'];
		$make_cnt		= 0;
		$remain_cnt		= $_POST['remain_cnt'];
		$seq			= $_POST['seq'];
		$warehouse_cd	= $_POST['warehouse_cd'];
		$warehouse_nm	= $_POST['warehouse_nm'];
		$work_start_dt	= $_POST['work_start_dt'];
		$work_end_dt	= $_POST['work_end_dt'];
		$remark			= $_POST['remark'];
		$state			= $_POST['state'];
		$shortage_cnt	= $_POST['shortage_cnt'];
	
	$data = array(
		"table"				=> "erp_production_wearing",
		"where"				=> "uid=".$_POST['uid'],
		//"work_dt"			=> $_POST['work_dt'],
		//"work_cha"		=> $work_cha,
		//"work_cd"			=> $work_cd,
		"workplan_cd"		=> $_POST['workplan_cd'],
		"order_cd"			=> $_POST['order_cd'],
		"start_dt"			=> $_POST['work_start_dt'],
		"end_dt"			=> $_POST['work_end_dt'],
		"project_cd"		=> $_POST['project_cd'],
		"project_nm"		=> $_POST['project_nm'],
		"account_cd"		=> $_POST['account_cd'],
		"account_nm"		=> $_POST['account_nm'],
		"manager"			=> $_POST['manager'],
		"warehouse_cd"		=> $_POST['warehouse_cd'],
		"warehouse_nm"		=> $_POST['warehouse_nm'],
		"deadline_dt"		=> $_POST['deadline_dt'],
		"cntTotal"			=> $this->replaceComma($_POST['cntTotal']),
		"attach"			=> $fileAttach,
		"remark"			=> $_POST['remark'],
		"state"				=> "1",
		"emp_id"			=> $_SESSION['login_id'],
		"create_dt"			=> $now
	);
	$wid = $production->updateWork($data);

	$sql = "delete from erp_production_wearing_item where wid = '".$_POST['uid']."' ";
	mysql_query($sql);
		
	foreach($item_cd as $key => $val) {
		if($val != "") {
			$data = array(
				"table"			=> "erp_production_wearing_item",
				"wid"			=> $_POST['uid'],
				"order_cd"		=> $_POST['order_cd'],
				"workplan_cd"	=> $_POST['workplan_cd'],
				"work_cd"		=> $work_cd,
				"process"		=>  $process[$key],
				"machine"		=>  $machine[$key],
				"item_cd"		=>  $item_cd[$key],
				"item_nm"		=>  $item_nm[$key],
				"standard1"		=> $standard1[$key],
				"material"		=> $material[$key],
				"unit"			=> $unit[$key],
				"goal_cnt"		=> $this->replaceComma($goal_cnt[$key]),
				"order_cnt"		=> $this->replaceComma($order_cnt[$key]),
				"make_cnt"		=> $this->replaceComma($make_cnt),
				"remain_cnt"	=> $this->replaceComma( $order_cnt[$key]),
				"shortage_cnt"	=> $this->replaceComma($shortage_cnt[$key]),
				"seq"			=> $this->replaceComma($seq[$key]),
				"warehouse_cd"	=> $warehouse_cd[$key],
				"warehouse_nm"	=> $warehouse_nm[$key],
				"emp_id"		=> $_SESSION['login_id'],
				"create_dt"		=> $now
			);
			
			$fid = $production->insert($data);
			}
		}
	//exit;
	$this->movePageClose($_POST['dialogID']);
	//$this->movePage("production","listPageWork");
	}
	// 생산입고 리스트
	public function listPageProductionInto() {
		require_once ("views/production/listProductionInto.php");
	}
	
	// 생산입고 등록 화면
	public function registPageProductionIntoPop() {
		require_once ("views/production/createProductionInto_pop.php");
	}
	
	// 생산입고 수정 화면
	public function modifyPageProductionIntoPop(){
		$t = Production::getProductionInto($_GET['uid']);
		require_once ("views/production/modifyProductionInto_pop.php");
	}
	
	// 생산입고 등록
	public function inputPageProductionInto() {
		$production = new Production;
		$now = date("Y-m-d H:i:s");

		$sql = "select max(p_into_cha) as cnt from erp_production_into where p_into_dt='".$_POST['p_into_dt']."'";

		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$p_into_cha = "1";
		}else{
			$p_into_cha = $t0->cnt+1;
		}

		$p_into_cd  = $_POST['p_into_dt']."-".$p_into_cha;
		
		 //$lot_no_cd = implode("|", $_POST['lot_no_cd']);
		 //$lot_no_nm = implode("|", $_POST['lot_no_nm']);

		//if($_POST['LOT_NO']==""){
		//	$lot_no = "TS-LOT".date("ymdhi",time());  //공정이동표출력으로 인한 로트NO
	//	}else{
	//		$lot_no = $_POST['LOT_NO'];  //공정이동표출력으로 인한 로트NO
	//	}
		
		$data = array(
			"table"			=> "erp_production_into",
			"p_into_dt"		=> $_POST['p_into_dt'],
			"p_into_cha"		=> $p_into_cha,
			"p_into_cd"		=> $p_into_cd,
			"work_uid"		=> $_POST['work_uid'],
			"work_cd"		=> $_POST['work_cd'],
			"wh_cd_f_cd"		=> $_POST['wh_cd_f_cd'],
			"wh_cd_f_nm"		=> $_POST['wh_cd_f_nm'],
			"warehouse_cd"		=> $_POST['warehouse_cd'],
			"warehouse_nm"		=> $_POST['warehouse_nm'],
			"project_cd"		=> $_POST['project_cd'],
			"project_nm"		=> $_POST['project_nm'],
			"emp_id"		=> $_POST['emp_id'],
			"emp_nm"		=> $_POST['manager'],
			"manager"		=> $_POST['manager'],
			"remark"		=> $_POST['remark'],
			"emp_id"		=> $_SESSION['login_id'],
			"create_dt"		=> $now
		);

		$fid = $production->input_p_into($data);

		$process					= $_POST['process'];
		$machine					= $_POST['machine'];
		$item_cd					= $_POST['item_cd'];
		$item_nm					= $_POST['item_nm'];
		$standard1					= $_POST['standard1'];
		$material					= $_POST['material'];
		$unit							= $_POST['unit'];
		//$warehouse_f_cd		= $_POST['warehouse_f_cd'];
		//$warehouse_f_nm		= $_POST['warehouse_f_nm'];
		//$warehouse_t_cd		= $_POST['warehouse_t_cd'];
		//$warehouse_t_nm		= $_POST['warehouse_t_nm'];
		$addcnt						= $_POST['addcnt'];
		$cnt							= $_POST['cnt'];
		$order_cnt					= $_POST['order_cnt'];
		$memo						= $_POST['memo'];
		$lot_no						= $_POST['lot_no'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"					=> "erp_production_into_item",
					"fid"						=> $fid,
					"p_into_cd"				=> $p_into_cd,
					"process"				=> $process[$key],
					//"machine"			=> $machine[$key],
					"item_cd"				=> $item_cd[$key],
					"item_nm"				=> $item_nm[$key],
					"standard1"			=> $standard1[$key],
					"material"				=> $material[$key],
					"unit"						=> $unit[$key],
					"warehouse_f_cd"	=>  $_POST['wh_cd_f_cd'],	//생산공장코드
					"warehouse_f_nm"	=>  $_POST['wh_cd_f_nm'],
					"warehouse_cd"		=>  $_POST['warehouse_cd'], //입고창고코드
					"warehouse_nm"		=>  $_POST['warehouse_nm'],
					"addcnt"					=> $this->replaceComma($addcnt[$key]),
					"cnt"						=> $this->replaceComma($cnt[$key]),
					"order_cnt"				=> $this->replaceComma($order_cnt[$key]),
					"memo"					=> $memo[$key],
					"lot_no_cd"				=> $lot_no[$key],
					"regdate"				=> $now
				);
				
				$production->insert($data);
			
					//=======================================각각의 아이템 별로 창고 등록=========================================================
			
						if($fid!=""){  //생산 입고중 생산 입고 완제품을 하나의 창고에 인서트 할경우

						$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."' "; //창고별 재고현황 쿼리중 창고재고가 있는경우
						$result = mysql_query($sql);
						

							if(mysql_num_rows($result) > 0) { // 등록된 창고 재고창고가 있다면
								$r_cnt = mysql_fetch_object( $result );
								
								$remain_cnt = $r_cnt->remain_cnt + $this->replaceComma($cnt[$key]);
								
								// 전체재고에 넣기
								$stockData = array (
								"table" => "erp_stock",
								"where" => "item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."'",
								"standard1" => $standard1[$key],
								"material" => $material[$key],
								"unit" => $unit[$key],
								"pur_cnt" => $this->replaceComma($cnt[$key]),
								//"pur_unit_price" => $this->replaceComma($supply_price[$key]),
								"remain_cnt" => $remain_cnt,
								"warehouse_cd" =>$_POST['warehouse_cd'],
								"warehouse_nm" =>$_POST['warehouse_nm'],
								"in_date" => $now
								);
								$production->update($stockData);
							}else{                        // 등록된 창고 재고창고가 없다면
								
								$remain_cnt = $this->replaceComma($cnt[$key]);

								$sql2 = "select * from erp_item where item_cd='".$val."' and standard1 ='".$standard1[$key]."'";
								$result2 = mysql_fetch_object(mysql_query($sql2));
								$item_uid = $result2->uid;
								
								// 전체재고에 넣기
								$stockData = array (
								"table" => "erp_stock",
								"fid"		=>$item_uid ,
								"item_nm" => $item_nm[$key],
								"standard1" => $standard1[$key],
								"material" => $material[$key],
								"unit" => $unit[$key],
								"pur_cnt" => $this->replaceComma($cnt[$key]),
								//"pur_unit_price" => $this->replaceComma($supply_price[$key]),
								"remain_cnt" => $remain_cnt,
								"warehouse_cd" =>$_POST['warehouse_cd'],
								"warehouse_nm" =>$_POST['warehouse_nm'],
								"in_date" => $now
								);
								$production->insert($stockData);
							}
							// 전체 inout에 넣기
							$inoutData = array (
							"table" => "erp_stock_inout",
							"item_cd" => $val,
							"work_cd"		=> $_POST['work_cd'],
							"warehouse_cd" =>$_POST['warehouse_cd'],
							"standard1" => $standard1[$key],
							"material" => $material[$key],
							"unit" => $unit[$key],
							"in_cnt" => $this->replaceComma($cnt[$key]),
							//"pur_unit_price" => $this->replaceComma($supply_price[$key]),
							//"total_price" => $this->replaceComma($total_price[$key]),
							"remain_cnt" => $this->replaceComma($cnt[$key]),
							"lot_no" => $lot_no[$key],
							"account" => "생산입고",
							"remark" => "생산입고",
							"used"		=>"n",
							"create_dt" => $now
							);
							$production->insert($inoutData);
					}			
			
			//=======================================각각의 아이템 별로 창고 등록=========================================================
			
			
			}
		}
		$this->movePageClose($_POST['dialogID']);
		//$this->movePage("production","listPageWork");
	}
	// 작업일보 수정
	public function updatePageProductionInto() {
		$production = new Production;
		$now = date("Y-m-d H:i:s");
		/*
		$sql = "select max(p_into_cha) as cnt from erp_production_into where p_into_dt='".$_POST['p_into_dt']."'";

		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$p_into_cha = "1";
		}else{
			$p_into_cha = $t0->cnt+1;
		}

		$p_into_cd  = $_POST['p_into_dt']."-".$p_into_cha;
		
		 $lot_no_cd = implode("|", $_POST['lot_no_cd']);
		 $lot_no_nm = implode("|", $_POST['lot_no_nm']);
	
		if($_POST['LOT_NO']==""){
			$lot_no = "TS-LOT".date("ymdhi",time());  //공정이동표출력으로 인한 로트NO
		}else{
			$lot_no = $_POST['LOT_NO'];  //공정이동표출력으로 인한 로트NO
		}
	*/
	
		$data = array(
			"table"			=> "erp_production_into",
			"where"					=> "uid=".$_POST['uid'],
			//"p_into_dt"		=> $_POST['p_into_dt'],
			//"p_into_cha"	=> $p_into_cha,
			//"p_into_cd"		=> $p_into_cd,
			"work_uid"		=> $_POST['work_uid'],
			"work_cd"		=> $_POST['work_cd'],
			"wh_cd_f_cd"	=> $_POST['wh_cd_f_cd'],
			"wh_cd_f_nm"	=> $_POST['wh_cd_f_nm'],
			"warehouse_cd"	=> $_POST['warehouse_cd'],
			"warehouse_nm"	=> $_POST['warehouse_nm'],
			"project_cd"	=> $_POST['project_cd'],
			"project_nm"	=> $_POST['project_nm'],
			"emp_id"		=> $_POST['emp_id'],
			"emp_nm"		=> $_POST['manager'],
			"manager"		=> $_POST['manager'],
			"remark"		=> $_POST['remark'],
			"emp_id"		=> $_SESSION['login_id'],
			"create_dt"		=> $now
		);

		$fid = $production->input_p_into($data);

		$sql = "delete from erp_production_into_item where fid='".$_POST['uid']."'";
		mysql_query($sql);

		$process			= $_POST['process'];
		$machine			= $_POST['machine'];
		$item_cd			= $_POST['item_cd'];
		$item_nm			= $_POST['item_nm'];
		$standard1			= $_POST['standard1'];
		$material			= $_POST['material'];
		$unit				= $_POST['unit'];
		//$warehouse_f_cd		= $_POST['warehouse_f_cd'];
		//$warehouse_f_nm		= $_POST['warehouse_f_nm'];
		//$warehouse_t_cd		= $_POST['warehouse_t_cd'];
		//$warehouse_t_nm		= $_POST['warehouse_t_nm'];
		$addcnt				= $_POST['addcnt'];
		$cnt				= $_POST['cnt'];
		$order_cnt			= $_POST['order_cnt'];
		$memo				= $_POST['memo'];
		$lot_no				= $_POST['lot_no'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"				=> "erp_production_into_item",
					"fid"				=> $fid,
					//"p_into_cd"			=> $p_into_cd,
					//"process"			=> $process[$key],
					//"machine"			=> $machine[$key],
					"item_cd"				=> $item_cd[$key],
					"item_nm"				=> $item_nm[$key],
					"standard1"			=> $standard1[$key],
					"material"				=> $material[$key],
					"unit"						=> $unit[$key],
					"warehouse_f_cd"	=>  $_POST['wh_cd_f_cd'],
					"warehouse_f_nm"	=>  $_POST['wh_cd_f_nm'],
					"warehouse_cd"		=> $_POST['warehouse_cd'],
					"warehouse_nm"		=>$_POST['warehouse_nm'],
					"addcnt"					=> $this->replaceComma($addcnt[$key]),
					"cnt"						=> $this->replaceComma($cnt[$key]),
					"order_cnt"				=> $this->replaceComma($order_cnt[$key]),
					"memo"					=> $memo[$key],
					"lot_no_cd"				=> $lot_no[$key],
					"regdate"				=> $now
				);
				
				$production->insert($data);
			}
		}
		$this->movePageClose($_POST['dialogID']);
		//$this->movePage("production","listPageWork");
	}
	
	public function listPagePPReportsClean() {
		require_once ("views/production/listPPReportsClean.php");
	}

	//실적관리
	public function registPagePPReportsClean() {
		require_once ("views/production/createPPReportsClean.php");
	}

	public function modifyPagePPReportsClean() {
		$t = Production::getProductPerfReports($_GET['uid']);
		require_once ("views/production/modifyPPReportsClean.php");
	}

	//생산실적 세척 등록
	public function inputPagePPReportsClean() {

		$now = date("Y-m-d H:i:s");

		$sql = "select max(production_cha) as cnt from erp_product_perf_repost where production_dt='".$_POST['production_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$production_cha = "1";
		}else{
			$production_cha = $t0->cnt+1;
		}

		$production_cd  = $_POST['production_dt']."-".$production_cha;

		 $p_plan_tm		= $_POST['p_plan_tm1']."~".$_POST['p_plan_tm2'];

		 $lot_no_cd = implode("|", $_POST['lot_no_cd']);
		 $lot_no_nm = implode("|", $_POST['lot_no_nm']);

		if($_POST['LOT_NO']==""){
			$lot_no = "TS-LOT".date("ymdhi",time());  //공정이동표출력으로 인한 로트NO
		}else{
			$lot_no = $_POST['LOT_NO'];  //공정이동표출력으로 인한 로트NO
		}
		
		$data = array(
			"table"					=> "erp_product_perf_repost",
			"production_dt"			=> $_POST['production_dt'],
			"production_cd"			=> $production_cd,
			"production_cha"		=> $production_cha,
			"day_gubun"				=> $_POST['day_gubun'],
			"process_cd"			=> $_POST['process_cd'],
			"process_nm"			=> $_POST['process_nm'],
			"machine_uid"			=> $_POST['machine_uid'],
			"machine_nm"			=> $_POST['machine_nm'],
			"p_plan_tm"				=> $p_plan_tm,
			"order_qty"				=> str_replace(",","",$_POST['order_qty']),
			"p_now_tm"				=> $_POST['p_now_tm'],
			"target_qty"			=> str_replace(",","",$_POST['target_qty']),
			"output_qty"			=> str_replace(",","",$_POST['output_qty']),
			"working_efficiency"	=> $_POST['working_efficiency'],
			"item_cd"				=> $_POST['item_cd'],
			"item_nm"				=> $_POST['item_nm'],
			"standard1"				=> $_POST['standard1'],
			"standard2"				=> $_POST['standard2'],
			"standard3"				=> $_POST['standard3'],
			"pass_qty"				=> str_replace(",","",$_POST['pass_qty']),
			"work_cd"				=> $_POST['work_cd'],
			"work_bom"				=> $_POST['work_bom'],
			"publish_qty"			=> str_replace(",","",$_POST['publish_qty']),
			"emp_id"				=> $_POST['emp_id'],
			"emp_nm"				=> $_POST['emp_nm'],
			"writer"				=> $_POST['emp_nm'],
			"faulty_qty1"			=> $_POST['faulty_qty1'],
			"faulty_type1"			=> $_POST['faulty_type1'],
			"faulty_qty2"			=> $_POST['faulty_qty2'],
			"faulty_type2"			=> $_POST['faulty_type2'],
			"box_limit_qty"			=> str_replace(",","",$_POST['box_limit_qty']),
			"loss_item"				=> $_POST['loss_item'],
			"loss_time"				=> $_POST['loss_time'],
			"LOT_NO"				=> $lot_no,
			"lot_no_cd"				=> $lot_no_cd,
			"lot_no_nm"				=> $lot_no_nm,
			"regdate"				=> $now
		);

		$production = new Production;
		$pid = $production->productPPReportsInserts($data); 
		//$pid = mysql_insert_id();
		
		if ($pid >=0){

			for($i=1 ; $i <= $_POST['publish_qty']; $i++) {
					
					$lotNo = $lot_no.$i;  //공정이동표출력으로 인한 로트NO
					
					$data = array(
						"table"		=> "erp_product_perf_repost_barcode",
						"uid"		=> $pid,
						"lot_no"	=> $lotNo,
						"regdate"	=> $now
					);
					$result = $production->insert($data);
			}

			//생산에 사용되는 품목 아이템 LOT_NO 번호를 테이블에 저장하는 오직 추가
			$warehousing_cd			= $_POST['warehousing_cd'];
			$lot_no_cd				= $_POST['lot_no_cd'];
			$lot_no_nm				= $_POST['lot_no_nm'];
			$lot_item_cd			= $_POST['lot_item_cd'];
			$lot_item_nm			= $_POST['lot_item_nm'];
			$lot_standard			= $_POST['lot_standard'];
			$lot_material			= $_POST['lot_material'];
			$regdate_item			= $_POST['regdate_item'];
			$warehousing_dt			= $_POST['regdate'];
			

			foreach($lot_item_cd as $key => $val) {
				if($val != "") {
					$data = array(
						"table"				=> "erp_product_perf_repost_item",
						"fid"				=> $pid,
						"warehousing_cd"	=> $warehousing_cd[$key],
						"warehousing_dt"	=> substr($warehousing_dt[$key],0,10),
						"item_cd"			=> $lot_item_cd[$key],
						"item_nm"			=> $lot_item_nm[$key],
						"standard1"			=> $lot_standard[$key],
						"material"			=> $lot_material[$key],
						"lot_no_cd"			=> $lot_no_cd[$key],
						"lot_no_nm"			=> $lot_no_nm[$key],
						"regdate_item"		=> $regdate_item[$key],
						"regdate"			=> $now
					);
					
					$production->insert($data);
				}
			}
		}
		//exit;
		$this->movePageClose($_POST['dialogID']);
	
	}

	public function updatePagePPReportsClean() {

		$now = date("Y-m-d H:i:s");
		
		 $p_plan_tm		= $_POST['p_plan_tm1']."~".$_POST['p_plan_tm2'];

		 $lot_no_cd = implode("|", $_POST['lot_no_cd']);
		 $lot_no_nm = implode("|", $_POST['lot_no_nm']);

		 
		if($_POST['LOT_NO']==""){
			$lot_no = "TS_LOT".date("ymdhi",time());  //공정이동표출력으로 인한 로트NO
		}else{
			$lot_no = $_POST['LOT_NO'];  //공정이동표출력으로 인한 로트NO
		}

		$data = array(
			"table"					=> "erp_product_perf_repost",
			"where"					=> "uid=".$_POST['uid'],
			"production_dt"			=> $_POST['production_dt'],
			"day_gubun"				=> $_POST['day_gubun'],
			"process_cd"			=> $_POST['process_cd'],
			"process_nm"			=> $_POST['process_nm'],
			"machine_uid"			=> $_POST['machine_uid'],
			"machine_nm"			=> $_POST['machine_nm'],
			"p_plan_tm"				=> $p_plan_tm,
			"order_qty"				=> str_replace(",","",$_POST['order_qty']),
			"p_now_tm"				=> $_POST['p_now_tm'],
			"target_qty"			=> str_replace(",","",$_POST['target_qty']),
			"output_qty"			=> str_replace(",","",$_POST['output_qty']),
			"working_efficiency"	=> $_POST['working_efficiency'],
			"item_cd"				=> $_POST['item_cd'],
			"item_nm"				=> $_POST['item_nm'],
			"standard1"				=> $_POST['standard1'],
			"standard2"				=> $_POST['standard2'],
			"standard3"				=> $_POST['standard3'],
			"pass_qty"				=> str_replace(",","",$_POST['pass_qty']),
			"work_cd"				=> $_POST['work_cd'],
			"work_bom"				=> $_POST['work_bom'],
			"publish_qty"			=> str_replace(",","",$_POST['publish_qty']),
			"emp_id"				=> $_POST['emp_id'],
			"emp_nm"				=> $_POST['emp_nm'],
			"writer"				=> $_POST['emp_nm'],
			"faulty_qty1"			=> $_POST['faulty_qty1'],
			"faulty_type1"			=> $_POST['faulty_type1'],
			"faulty_qty2"			=> $_POST['faulty_qty2'],
			"faulty_type2"			=> $_POST['faulty_type2'],
			"faulty_qty3"			=> $_POST['faulty_qty3'],
			"faulty_type3"			=> $_POST['faulty_type3'],
			"faulty_qty4"			=> $_POST['faulty_qty4'],
			"faulty_type4"			=> $_POST['faulty_type4'],
			"faulty_qty5"			=> $_POST['faulty_qty5'],
			"faulty_type5"			=> $_POST['faulty_type5'],
			"faulty_qty6"			=> $_POST['faulty_qty6'],
			"faulty_type6"			=> $_POST['faulty_type6'],
			"faulty_qty7"			=> $_POST['faulty_qty7'],
			"faulty_type7"			=> $_POST['faulty_type7'],
			"box_limit_qty"			=> str_replace(",","",$_POST['box_limit_qty']),
			"loss_item"				=> $_POST['loss_item'],
			"loss_time"				=> $_POST['loss_time'],
			"LOT_NO"				=> $lot_no,
			"lot_no_cd"				=> $lot_no_cd,
			"lot_no_nm"				=> $lot_no_nm,
			"regdate"				=> $now
		);

		$production = new Production;
		$result = $production->update($data); 

		//LOT_NO가 변경되거나 바코드번호가 변경되면 삭제 후 처리 로직 //공정이동간(공정이동표출력용) LOT_NO
		$sql4 = "select LOT_NO from erp_product_perf_repost where uid='".$_POST['uid']."'";
		//echo $sql."<BR>"; 
		$t4 = mysql_fetch_object(mysql_query($sql4));
		
		if ($t4->LOT_NO!= $lot_no){

			$sql = "delete from erp_product_perf_repost_barcode where uid = '".$_POST['uid']."'";
			mysql_query($sql);
			for($i=1 ; $i <= $_POST['publish_qty']; $i++) {
					
					$lotNo = $lot_no.$i;  //공정이동표출력으로 인한 로트NO
					
					$data = array(
						"table"		=> "erp_product_perf_repost_barcode",
						"uid"		=> $_POST['uid'],
						"lot_no"	=> $lotNo,
						"regdate"	=> $now
					);
					$result = $production->insert($data);
			}
		}

		//생산에 사용되는 품목 아이템 LOT_NO 번호를 테이블에 저장하는 로직 추가
		$warehousing_cd			= $_POST['warehousing_cd'];
		$warehousing_dt			= $_POST['warehousing_dt'];
		$lot_no_cd				= $_POST['lot_no_cd'];
		$lot_no_nm				= $_POST['lot_no_nm'];
		$lot_item_cd			= $_POST['lot_item_cd'];
		$lot_item_nm			= $_POST['lot_item_nm'];
		$lot_standard			= $_POST['lot_standard'];
		$lot_material			= $_POST['lot_material'];
		$regdate_item			= $_POST['regdate_item'];
		$warehousing_dt			= $_POST['regdate'];

		foreach($lot_item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"				=> "erp_product_perf_repost_item",
					"where"				=> "fid=".$_POST['uid'],
					"warehousing_cd"	=> $warehousing_cd[$key],
					"warehousing_dt"	=> substr($warehousing_dt[$key],0,10),
					"item_cd"			=> $lot_item_cd[$key],
					"item_nm"			=> $lot_item_nm[$key],
					"standard1"			=> $lot_standard[$key],
					"material"			=> $lot_material[$key],
					"lot_no_cd"			=> $lot_no_cd[$key],
					"lot_no_nm"			=> $lot_no_nm[$key],
					"regdate_item"		=> $regdate_item[$key],
					"regdate"			=> $now
				);
				
				$production->update($data);
			}
		}
		//exit;
		$this->movePageClose($_POST['dialogID']);
	
	}
	
	public function listPagePPReportsPacking() {
		require_once ("views/production/listPPReportsPacking.php");
	}

	//생산실적관리=>포장
	public function registPagePPReportsPacking() {
		require_once ("views/production/createPPReportsPacking.php");
	}

	public function modifyPagePPReportsPacking() {
		$t = Production::getProductPerfReports($_GET['uid']);
		require_once ("views/production/modifyPPReportsPacking.php");
	}

	//실적등록 포장
	public function inputPagePPReportsPacking() {

		$now = date("Y-m-d H:i:s");
		$sql = "select max(production_cha) as cnt from erp_product_perf_repost where production_dt='".$_POST['production_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$production_cha = "1";
		}else{
			$production_cha = $t0->cnt+1;
		}

		$production_cd  = $_POST['production_dt']."-".$production_cha;
		
		 $p_plan_tm		= $_POST['p_plan_tm1']."~".$_POST['p_plan_tm2'];

		 $lot_no_cd = implode("|", $_POST['lot_no_cd']);
		 $lot_no_nm = implode("|", $_POST['lot_no_nm']);

		if($_POST['LOT_NO']==""){
			$lot_no = "TS_LOT".date("ymdhi",time());  //공정이동표출력으로 인한 로트NO
		}else{
			$lot_no = $_POST['LOT_NO'];  //공정이동표출력으로 인한 로트NO
		}
		
		$data = array(
			"table"					=> "erp_product_perf_repost",
			"production_dt"			=> $_POST['production_dt'],
			"production_cd"			=> $production_cd,
			"production_cha"		=> $production_cha,
			"day_gubun"				=> $_POST['day_gubun'],
			"process_cd"			=> $_POST['process_cd'],
			"process_nm"			=> $_POST['process_nm'],
			"machine_uid"			=> $_POST['machine_uid'],
			"machine_nm"			=> $_POST['machine_nm'],
			"p_plan_tm"				=> $p_plan_tm,
			"order_qty"				=> str_replace(",","",$_POST['order_qty']),
			"p_now_tm"				=> $_POST['p_now_tm'],
			"target_qty"			=> str_replace(",","",$_POST['target_qty']),
			"output_qty"			=> str_replace(",","",$_POST['output_qty']),
			"working_efficiency"	=> $_POST['working_efficiency'],
			"item_cd"				=> $_POST['item_cd'],
			"item_nm"				=> $_POST['item_nm'],
			"standard1"				=> $_POST['standard1'],
			"standard2"				=> $_POST['standard2'],
			"standard3"				=> $_POST['standard3'],
			"pass_qty"				=> str_replace(",","",$_POST['pass_qty']),
			"work_cd"				=> $_POST['work_cd'],
			"work_bom"				=> $_POST['work_bom'],
			"publish_qty"			=> str_replace(",","",$_POST['publish_qty']),
			"emp_id"				=> $_POST['emp_id'],
			"emp_nm"				=> $_POST['emp_nm'],
			"writer"				=> $_POST['emp_nm'],
			"faulty_qty1"			=> $_POST['faulty_qty1'],
			"faulty_type1"			=> $_POST['faulty_type1'],
			"faulty_qty2"			=> $_POST['faulty_qty2'],
			"faulty_type2"			=> $_POST['faulty_type2'],
			"faulty_qty3"			=> $_POST['faulty_qty3'],
			"faulty_type3"			=> $_POST['faulty_type3'],
			"faulty_qty4"			=> $_POST['faulty_qty4'],
			"faulty_type4"			=> $_POST['faulty_type4'],
			"faulty_qty5"			=> $_POST['faulty_qty5'],
			"faulty_type5"			=> $_POST['faulty_type5'],
			"faulty_qty6"			=> $_POST['faulty_qty6'],
			"faulty_type6"			=> $_POST['faulty_type6'],
			"faulty_qty7"			=> $_POST['faulty_qty7'],
			"faulty_type7"			=> $_POST['faulty_type7'],
			"box_limit_qty"			=> str_replace(",","",$_POST['box_limit_qty']),
			"loss_item"				=> $_POST['loss_item'],
			"loss_time"				=> $_POST['loss_time'],
			"LOT_NO"				=> $lot_no,
			"lot_no_cd"				=> $lot_no_cd,
			"lot_no_nm"				=> $lot_no_nm,
			"regdate"				=> $now,
			"shipment_dt"				=> $_POST['shipment_dt']
		);

		$production = new Production;
		$pid = $production->productPPReportsInserts($data); 
		//$pid = mysql_insert_id();
		
		if ($pid >=0){

			for($i=1 ; $i <= $_POST['publish_qty']; $i++) {
					
					$lotNo = $lot_no.$i;  //공정이동표출력으로 인한 로트NO
					
					$data = array(
						"table"		=> "erp_product_perf_repost_barcode",
						"uid"		=> $pid,
						"lot_no"	=> $lotNo,
						"regdate"	=> $now
					);
					$result = $production->insert($data);
			}

			//생산에 사용되는 품목 아이템 LOT_NO 번호를 테이블에 저장하는 오직 추가
			$warehousing_cd			= $_POST['warehousing_cd'];
			$lot_no_cd			= $_POST['lot_no_cd'];
			$lot_no_nm			= $_POST['lot_no_nm'];
			$lot_item_cd			= $_POST['lot_item_cd'];
			$lot_item_nm			= $_POST['lot_item_nm'];
			$lot_standard			= $_POST['lot_standard'];
			$lot_material			= $_POST['lot_material'];
			$regdate_item			= $_POST['regdate_item'];
			$warehousing_dt			= $_POST['regdate'];

			foreach($lot_item_cd as $key => $val){
				if($val != ""){
					$data = array(
						"table"				=> "erp_product_perf_repost_item",
						"fid"				=> $pid,
						"warehousing_cd"	=> $warehousing_cd[$key],
						"warehousing_dt"	=> substr($warehousing_dt[$key],0,10),
						"item_cd"			=> $lot_item_cd[$key],
						"item_nm"			=> $lot_item_nm[$key],
						"standard1"			=> $lot_standard[$key],
						"material"			=> $lot_material[$key],
						"lot_no_cd"			=> $lot_no_cd[$key],
						"lot_no_nm"			=> $lot_no_nm[$key],
						"lot_no_nm"			=> $regdate_item[$key],
						"regdate"			=> $now
					);
					
					$production->insert($data);
				}
			}


			//생산입고 버튼 체크시 
			//product_stock_in= $_POST['product_stock_in'];
			//입고 창고 선택

		}
		//exit;
		$this->movePageClose($_POST['dialogID']);
	}

	public function updatePagePPReportsPacking() {	//생산실적수정 (도금, 포장) 두곳에서 사용.

		$now = date("Y-m-d H:i:s");
		
		 $p_plan_tm		= $_POST['p_plan_tm1']."~".$_POST['p_plan_tm2'];

		 $lot_no_cd = implode("|", $_POST['lot_no_cd']);
		 $lot_no_nm = implode("|", $_POST['lot_no_nm']);

		 
		if($_POST['LOT_NO']==""){
			$lot_no = "TS-LOT".date("ymdhi",time());  //공정이동표출력으로 인한 로트NO
		}else{
			$lot_no = $_POST['LOT_NO'];  //공정이동표출력으로 인한 로트NO
		}

		$data = array(
			"table"					=> "erp_product_perf_repost",
			"where"					=> "uid=".$_POST['uid'],
			"production_dt"			=> $_POST['production_dt'],
			"day_gubun"				=> $_POST['day_gubun'],
			"process_cd"			=> $_POST['process_cd'],
			"process_nm"			=> $_POST['process_nm'],
			"machine_uid"			=> $_POST['machine_uid'],
			"machine_nm"			=> $_POST['machine_nm'],
			"p_plan_tm"				=> $p_plan_tm,
			"order_qty"				=> str_replace(",","",$_POST['order_qty']),
			"p_now_tm"				=> $_POST['p_now_tm'],
			"target_qty"			=> str_replace(",","",$_POST['target_qty']),
			"output_qty"			=> str_replace(",","",$_POST['output_qty']),
			"working_efficiency"		=> $_POST['working_efficiency'],
			"item_cd"				=> $_POST['item_cd'],
			"item_nm"				=> $_POST['item_nm'],
			"standard1"				=> $_POST['standard1'],
			"standard2"				=> $_POST['standard2'],
			"standard3"				=> $_POST['standard3'],
			"pass_qty"				=> str_replace(",","",$_POST['pass_qty']),
			"work_cd"				=> $_POST['work_cd'],
			"work_bom"				=> $_POST['work_bom'],
			"publish_qty"			=> str_replace(",","",$_POST['publish_qty']),
			"emp_id"				=> $_POST['emp_id'],
			"emp_nm"				=> $_POST['emp_nm'],
			"writer"				=> $_POST['emp_nm'],
			"faulty_qty1"			=> $_POST['faulty_qty1'],
			"faulty_type1"			=> $_POST['faulty_type1'],
			"faulty_qty2"			=> $_POST['faulty_qty2'],
			"faulty_type2"			=> $_POST['faulty_type2'],
			"faulty_qty3"			=> $_POST['faulty_qty3'],
			"faulty_type3"			=> $_POST['faulty_type3'],
			"faulty_qty4"			=> $_POST['faulty_qty4'],
			"faulty_type4"			=> $_POST['faulty_type4'],
			"faulty_qty5"			=> $_POST['faulty_qty5'],
			"faulty_type5"			=> $_POST['faulty_type5'],
			"faulty_qty6"			=> $_POST['faulty_qty6'],
			"faulty_type6"			=> $_POST['faulty_type6'],
			"faulty_qty7"			=> $_POST['faulty_qty7'],
			"faulty_type7"			=> $_POST['faulty_type7'],
			"box_limit_qty"			=> str_replace(",","",$_POST['box_limit_qty']),
			"loss_item"				=> $_POST['loss_item'],
			"loss_time"				=> $_POST['loss_time'],
			"LOT_NO"				=> $lot_no,
			"lot_no_cd"				=> $lot_no_cd,
			"lot_no_nm"				=> $lot_no_nm,
			"regdate"				=> $now
		);

		$production = new Production;
		$result = $production->update($data); 
		//LOT_NO가 변경되거나 바코드번호가 변경되면 삭제 후 처리 로직 //공정이동간(공정이동표출력용) LOT_NO
		$sql4 = "select LOT_NO from erp_product_perf_repost where uid='".$_POST['uid']."'";
		//echo $sql."<BR>"; 
		$t4 = mysql_fetch_object(mysql_query($sql4));
		
		if ($t4->LOT_NO!= $lot_no){

			$sql = "delete from erp_product_perf_repost_barcode where uid = '".$_POST['uid']."'";
			mysql_query($sql);
			for($i=1 ; $i <= $_POST['publish_qty']; $i++) {
					
					$lotNo = $lot_no.$i;  //공정이동표출력으로 인한 로트NO
					
					$data = array(
						"table"		=> "erp_product_perf_repost_barcode",
						"uid"		=> $_POST['uid'],
						"lot_no"	=> $lotNo,
						"regdate"	=> $now
					);
					$result = $production->insert($data);
			}
		}

		//생산에 사용되는 품목 아이템 LOT_NO 번호를 테이블에 저장하는 로직 추가
		$warehousing_cd			= $_POST['warehousing_cd'];
		$warehousing_dt			= $_POST['warehousing_dt'];
		$lot_no_cd				= $_POST['lot_no_cd'];
		$lot_no_nm				= $_POST['lot_no_nm'];
		$lot_item_cd			= $_POST['lot_item_cd'];
		$lot_item_nm			= $_POST['lot_item_nm'];
		$lot_standard			= $_POST['lot_standard'];
		$lot_material			= $_POST['lot_material'];
		$regdate_item			= $_POST['regdate_item'];
		$warehousing_dt			= $_POST['regdate'];


		foreach($lot_item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"				=> "erp_product_perf_repost_item",
					"where"				=> "fid=".$_POST['uid'],
					"warehousing_cd"	=> $warehousing_cd[$key],
					"warehousing_dt"	=> substr($warehousing_dt[$key],0,10),
					"item_cd"			=> $lot_item_cd[$key],
					"item_nm"			=> $lot_item_nm[$key],
					"standard1"			=> $lot_standard[$key],
					"material"			=> $lot_material[$key],
					"lot_no_cd"			=> $lot_no_cd[$key],
					"lot_no_nm"			=> $lot_no_nm[$key],
					"regdate_item"		=> $regdate_item[$key],
					"regdate"			=> $now
				);
				
				$production->update($data);
			}
		}

		//exit;
		$this->movePageClose($_POST['dialogID']);
	}

// 공정이동표출력 리스트
	public function listPagePPReportsPrint() {
		require_once ("views/production/listPPReportsPrint.php");
	}
	
	// 공정이동표출력 등록 화면
	public function registPagePPReportsPrint() {
		require_once ("views/production/createPPReportsPrint.php");
	}
	
	// 공정이동표출력 수정 화면
	public function modifyPagePPReportsPrint(){
		$t = Production::getPPReportsPrint($_GET['uid']);
		require_once ("views/production/modifyPPReportsPrint.php");
	}

	// 공정이동표출력 화면
	public function viewPagePPReportsPrint(){
			require_once ("views/production/printProductPerfReportsList.php");
	}

	// 공정이동표출력 등록
	public function inputPagePPReportsPrint() {

		$now = date("Y-m-d H:i:s");
		$sql = "select max(production_cha) as cnt from erp_product_perf_repost_lotno where production_dt='".$_POST['production_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$production_cha = "1";
		}else{
			$production_cha = $t0->cnt+1;
		}

		$production_cd  = $_POST['production_dt']."-".$production_cha;
		
		if($_POST['LOT_NO']==""){
			$lot_no = "TS-LOT".date("ymdhi",time());  //공정이동표출력으로 인한 로트NO
		}else{
			$lot_no = $_POST['LOT_NO'];  //공정이동표출력으로 인한 로트NO
		}
		
		$data = array(
			"table"					=> "erp_product_perf_repost_lotno",
			"production_dt"			=> $_POST['production_dt'],
			"production_cd"			=> $production_cd,
			"production_cha"		=> $production_cha,
			"day_gubun"				=> $_POST['day_gubun'],
			"LOT_NO"				=> $lot_no,	
			"item_cd"				=> $_POST['item_cd'],
			"item_nm"				=> $_POST['item_nm'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"output_qty"			=> str_replace(",","",$_POST['output_qty']),
			"box_limit_qty"			=> str_replace(",","",$_POST['box_limit_qty']),
			"publish_qty"			=> str_replace(",","",$_POST['publish_qty']),
			"dobeon"				=> $_POST['dobeon'],
			"manufacture_dt"		=> $_POST['manufacture_dt'],
			"delivery_dt"			=> $_POST['delivery_dt'],
			"emp_id"				=> $_SESSION['login_id'],
			"regdate"				=> $now
		);

		$production = new Production;
		$pid = $production->insert($data); 
		//$pid = mysql_insert_id();
		
		if ($pid >=0){

		}
		//exit;
		$this->movePageClose($_POST['dialogID']);
	}

	// 공정이동표출력 수정
	public function updatePagePPReportsPrint() {
	$now = date("Y-m-d H:i:s");
		
		/*
		$sql = "select max(work_report_cha) as cnt from erp_work_daily_report where work_report_dt='".$_POST['work_report_dt']."'";

		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$work_report_cha = "1";
		}else{
			$work_report_cha = $t0->cnt+1;
		}
		
		$work_report_cd  = $_POST['work_report_dt']."-".$work_report_cha;
		*/
		 $p_plan_tm		= $_POST['p_plan_tm1']."~".$_POST['p_plan_tm2'];

		 $lot_no_cd = implode("|", $_POST['lot_no_cd']);
		 $lot_no_nm = implode("|", $_POST['lot_no_nm']);

		$data = array(
			"table"					=> "erp_work_daily_report",
			"where"					=> "uid=".$_POST['uid'],
			//"production_dt"			=> $_POST['production_dt'],
			//"production_cd"			=> $production_cd,
			//"production_cha"		=> $production_cha,
			"day_gubun"				=> $_POST['day_gubun'],
			"LOT_NO"				=> $lot_no,	
			"item_cd"				=> $_POST['item_cd'],
			"item_nm"				=> $_POST['item_nm'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"output_qty"			=> str_replace(",","",$_POST['output_qty']),
			"box_limit_qty"			=> str_replace(",","",$_POST['box_limit_qty']),
			"publish_qty"			=> str_replace(",","",$_POST['publish_qty']),
			"dobeon"				=> $_POST['dobeon'],
			"manufacture_dt"		=> $_POST['manufacture_dt'],
			"delivery_dt"			=> $_POST['delivery_dt'],
			"emp_id"				=> $_SESSION['login_id'],
			"regdate"				=> $now

		);

		$production = new Production;
		$result = $production->update($data); 
		/*
		for($i=1 ; $i <= $_POST['publish_qty']; $i++) {
				//$lot_no = $cd = "TS-LOT".time().$i;
				$lot_no = $cd = "TS-LOT".date("ymdhi",time()).$i;
				
				$data = array(
					"table"		=> "erp_product_output_barcode",
					"uid"		=> $pid,
					"lot_no"	=> $lot_no,
					"regdate"	=> $now
				);
				$result = $productoutput->productoutputLotNoInsert($data);
		}
		*/
	
		//생산에 사용되는 품목 아이템 LOT_NO 번호를 테이블에 저장하는 오직 추가 필요

		$this->movePageClose($_POST['dialogID']);
	//exit;
	}	



}
?>				