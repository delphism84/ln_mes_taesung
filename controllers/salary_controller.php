<?
session_start();
// 급여관리
class SalaryController {
	public function __construct() {
		extract($_POST);
		extract($_GET);
	}

	public function movePage($controller,$action) {
		echo "<script>";
		echo "location.href = 'index.php?controller=".$controller."&action=".$action."' ";
		echo "</script>";
	}

	public function movePageAlt($controller,$action) {
		echo "<script>";
		echo "alert('해당년도는 수당 이미 항목이 등록되어 있습니다.')";
		echo "location.href = 'index.php?controller=".$controller."&action=".$action."' ";
		echo "</script>";
	}

	public function movePagePop($controller,$action) {
		echo "<script>";
		echo "$(\".modal\").modal(\"hide\")";
		echo "parent.$(\".modal\").modal(\"hide\")";
		echo "opener.$(\".modal\").modal(\"hide\")";
		echo "parent.$.modal.close();";
		echo "parent.$.modal.close();";
		echo "parent.parent.$.modal.close();";
		echo "parent.close_popup();";
		echo "opener.close_popup();";
		echo "$.modal.close();";
		//echo "location.href = 'index.php?controller=".$controller."&action=".$action."' ";
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

/******************************************************************************************************
:: 사원 관련 함수들
******************************************************************************************************/		
	// 사원등록 페이지
	public function inputPageSalary() {
		require_once ("views/Salary/createSalary.php");
	}

	// 사원리스트 페이지
	public function listPageSalary() {
		require_once ("views/Salary/listSalary.php");
	}

	public function modifyPageSalary() {
		$t = Salary::getSalary($_GET['uid']);
		require_once ("views/Salary/modifySalary.php");
	}
	


	// 사원등록 실행
	public function registSalary(){
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('img');
		if($_POST['resign_dt'] == "") $emp_gb = "work";
		else $emp_gb = "resign";
		$data = array(
			"table" => "erp_Salary",
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

		$salary = new Salary;
		$result = $salary->registSalary($data);
		if($result) $this->movePage("Salary","listPageSalary");
	}

	// 사원등록 실행
	public function updateSalary(){
		$now = date("Y-m-d H:i:s");
		if($_POST['img'] != "") $fileAttach = $this->upload('img');
		else $fileAttach = $_POST['ori_img'];

		if($_POST['resign_dt'] == "" || $_POST['resign_dt'] == "0000-00-00") $emp_gb = "work";
		else $emp_gb = "resign";

		$data = array(
			"table" => "erp_Salary",
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

		$salary = new Salary;
		$result = $salary->updateSalary($data);
		if($result) $this->movePage("Salary","listPageSalary");
	}
/******************************************************************************************************
:: 부서 관련 함수들
******************************************************************************************************/	
	// 부서리스트 페이지
	public function listPageDepartment() {
		require_once ("views/Salary/listDepartment.php");
	}

	// 부서등록 페이지
	public function inputPageDepartment() {
		require_once ("views/Salary/createDepartment.php");
	}
	
	// 부서수정 페이지
	public function modifyPageDepartment() {
		$t = Salary::getDepartment($_GET['uid']);
		require_once ("views/Salary/modifyDepartment.php");
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

		$salary = new Salary;
		$result = $salary->registDepartment($data);
		if($result) $this->movePage("Salary","listPageDepartment");
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

		$salary = new Salary;
		$result = $salary->updateDepartment($data);
		if($result) $this->movePage("Salary","listPageDepartment");
	}
	
/******************************************************************************************************
:: 직위 관련 함수들
******************************************************************************************************/
	// 직위리스트 페이지
	public function listPagePosition() {
		require_once ("views/Salary/listPosition.php");
	}

	// 직위등록 페이지
	public function inputPagePosition() {
		require_once ("views/Salary/createPosition.php");
	}
	
	// 직위수정 페이지
	public function modifyPagePosition() {
		$t = Salary::getPosition($_GET['uid']);
		require_once ("views/Salary/modifyPosition.php");
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

		$Salary = new Salary;
		$result = $Salary->registPosition($data);
		if($result) $this->movePage("Salary","listPagePosition");
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

		$Salary = new Salary;
		$result = $Salary->updatePosition($data);
		if($result) $this->movePage("Salary","listPagePosition");
	}


	// 출하지시서 입력페이지
	public function inputPageShipment() {
		require_once ("views/sales/createShipment.php");
	}



/******************************************************************************************************
:: 급여 관련 함수들
******************************************************************************************************/
	public function registSalaryItme() {
		require_once ("views/salary/salary_itme_regist.php");
	}

	public function modifySalaryItme() {
		$t = Salary::getSalaryItme($_GET['uid']);
		require_once ("views/salary/salary_itme_regist.php");
	}

	public function registDeclarationItem() {
		require_once ("views/salary/declaration_itme_regist.php");
	}

	public function modifyDeclarationItem() {
		$t = Salary::getDeclarationItem($_GET['uid']);
		require_once ("views/salary/declaration_itme_regist.php");
	}
	
	public function listPayCheck() {
		require_once ("views/salary/pay_check_list.php");
	}	
	
	public function registPayCheckPop() {
		require_once ("views/salary/pay_check_regist_pop.php");
	}
	
	public function modifyPayCheckPop() {
		$t = Salary::getPayCheck($_GET['uid']);
		require_once ("views/salary/pay_check_modify_pop.php");
	}
	

	// 급여입력 실행
	public function registPayCheckInsert(){
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_pay_check",
			"pay_check_dt"		=> $_POST['pay_check_dt'],
			"pay_check_ca"		=> $_POST['pay_check_ca'],
			"cbmodifyflag"		=> $_POST['cbmodifyflag'],
			"pay_gubun"			=> $_POST['pay_gubun'],
			"taxcalc"			=> $_POST['taxcalc'],
			"scdate"			=> $_POST['scdate'],
			"ecdate"			=> $_POST['ecdate'],
			"paydate"			=> $_POST['paydate'],
			"lastday"			=> $_POST['lastday'],
			"bonusday"			=> $_POST['bonusday'],
			"sbonusdate"		=> $_POST['sbonusdate'],
			"ebonusdate"		=> $_POST['ebonusdate'],
			"payrateflag"		=> $_POST['payrateflag'],
			"payrate"			=> $_POST['payrate'],
			"bonusamt"			=> $_POST['bonusamt'],
			"cbbonusflag"		=> $_POST['cbbonusflag'],
			"bonusapplyflag"	=> $_POST['bonusapplyflag'],
			"adjustyy"			=> $_POST['adjustyy'],
			"paydes"			=> $_POST['paydes'],
			"paycomment"		=> $_POST['paycomment'],
			"totalpayamount"	=> $_POST['totalpayamount'],
			"writer"			=> $_POST['writer'],
			"regdate"			=> $now
		);

		$salary = new Salary;
		$result = $salary->payCheckInsert($data);
		$this->movePageClose($_POST['dialogid']);
	}
	

	// 급여입력 실행
	public function registPayCheckUpdate(){
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_pay_check",
			"where" =>			"uid=".$_POST['uid'],
			//"pay_check_dt"		=> $_POST['pay_check_dt'],
			//"pay_check_ca"		=> $_POST['pay_check_ca'],
			"cbmodifyflag"		=> $_POST['cbmodifyflag'],
			"pay_gubun"			=> $_POST['pay_gubun'],
			"taxcalc"			=> $_POST['taxcalc'],
			"scdate"			=> $_POST['scdate'],
			"ecdate"			=> $_POST['ecdate'],
			"paydate"			=> $_POST['paydate'],
			"lastday"			=> $_POST['lastday'],
			"bonusday"			=> $_POST['bonusday'],
			"sbonusdate"		=> $_POST['sbonusdate'],
			"ebonusdate"		=> $_POST['ebonusdate'],
			"payrateflag"		=> $_POST['payrateflag'],
			"payrate"			=> $_POST['payrate'],
			"bonusamt"			=> $_POST['bonusamt'],
			"cbbonusflag"		=> $_POST['cbbonusflag'],
			"bonusapplyflag"	=> $_POST['bonusapplyflag'],
			"adjustyy"			=> $_POST['adjustyy'],
			"paydes"			=> $_POST['paydes'],
			"paycomment"		=> $_POST['paycomment'],
			"totalpayamount"	=> $_POST['totalpayamount'],
			"writer"			=> $_POST['writer'],
			"regdate"			=> $now
		);

		$salary = new Salary;
		$result = $salary->payCheckUpdate($data);
		$this->movePageClose($_POST['dialogid']);
	}

	public function listPayMemberPop() {
		require_once ("views/salary/pay_member_list_pop.php");
	}	
	
	public function registPayMemberPop() {
		$t = Salary::getPayMember($_GET['pay_check_dt'], $_GET['pay_check_ca'], $_GET['emp_cd']);
		require_once ("views/salary/pay_member_regist_pop.php");
	}
	
	
	public function registPayMemberInsert(){
		/*
	while(list($key,$value)= each($_POST)){ 
	if(is_array($value)){ 
	while(list($key1,$value1)=each($value)){ 
	echo $key."[".$key1."]" ." = ". $value1."<br>\n"; 
	} 
	}else{ 
	echo $key ." = ". $value."<br>\n"; 
	} 
	} 
	*/
		$count1="";$count2="";$count3="";$count4="";$count5="";$count6="";$count7="";$count8="";
		foreach($_POST as $key => $value) //POST용 
		{ 
			$$key = $value; //가변변수는 값이 없는 key 안보임
			//if(!is_array($$key))  echo $key." --> ".$value."<br>";
			/*
			if(!is_array($$key))  echo $key." --> ".$value."<br>"; 
			else 
			{ 
			  for($a=0; $a < sizeof($$key); $a++) 
			  echo $key."[".$a."] --> ".$value[$a]."<br>"; 
			  } 
			*/
			if(substr($key , 0 ,10) =="txtPayAmt1"){
				++$count1;
			}
			if(substr($key , 0 ,8) =="hidAdCd1"){
				++$count2;
			}
			if(substr($key , 0 ,11) =="hidAdGubun1"){
				++$count3;
			}
			if(substr($key , 0 ,8) =="txtMemo1"){
				++$count4;
			}

			if(substr($key , 0 ,10) =="txtPayAmt2"){
				++$count5;
			}
			if(substr($key , 0 ,8) =="hidAdCd2"){
				++$count6;
			}
			if(substr($key , 0 ,11) =="hidAdGubun2"){
				++$count7;
			}
			if(substr($key , 0 ,8) =="txtMemo2"){
				++$count8;
			}

			
		}
		for($i=0;$i<=$count1;$i++){

			$txtPayAmt1 = $txtPayAmt1. $_POST['txtPayAmt1_'.$i]."|";
		}
			$txtPayAmt1 = substr($txtPayAmt1 , 0, -1);

		for($i=0;$i<=$count2;$i++){
			$hidAdCd1 =$hidAdCd1.$_POST['hidAdCd1_'.$i]."|";
		}
			$hidAdCd1 = substr($hidAdCd1 , 0, -1);

		for($i=0;$i<=$count3;$i++){
			$hidAdGubun1=$hidAdGubun1.$_POST['hidAdGubun1_'.$i]."|";
		}
			$hidAdGubun1 = substr($hidAdGubun1 , 0, -1);

		for($i=0;$i<=$count4;$i++){
			$txtMemo1=$txtMemo1.$_POST['txtMemo1_'.$i]."|";
		}
			$txtMemo1 = substr($txtMemo1 , 0, -1);

		for($i=0;$i<=$count5;$i++){
			$txtPayAmt2=$txtPayAmt2.$_POST['txtPayAmt2_'.$i]."|";
		}
			$txtPayAmt2 = substr($txtPayAmt2 , 0, -1);

		for($i=0;$i<=$count6;$i++){
			$hidAdCd2=$hidAdCd2.$_POST['hidAdCd2_'.$i]."|";
		}
			$hidAdCd2 = substr($hidAdCd2 , 0, -1);

		for($i=0;$i<=$count7;$i++){
			$hidAdGubun2=$hidAdGubun2.$_POST['hidAdGubun2_'.$i]."|";
		}
			$hidAdGubun2 = substr($hidAdGubun2 , 0, -1);

		for($i=0;$i<=$count8;$i++){
			$txtMemo2=$txtMemo2.$_POST['txtMemo2_'.$i]."|";
		}
			$txtMemo2 = substr($txtMemo2 , 0, -1);

		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_pay_member_item",
			"pay_check_dt"		=> $_POST['pay_check_dt'],
			"pay_check_ca"		=> $_POST['pay_check_ca'],
			"emp_cd"			=> $_POST['emp_cd'],
			"emp_nm"			=> $_POST['emp_nm'],
			"lastday"			=> $_POST['lastday'],
			"txtPayAmt1"		=> $txtPayAmt1,
			"hidAdCd1"			=> $hidAdCd1,
			"hidAdGubun1"		=> $hidAdGubun1,
			"txtMemo1"			=> $txtMemo1,
			"txtPayAmt2"		=> $txtPayAmt2,
			"hidAdCd2"			=> $hidAdCd2,
			"hidAdGubun2"		=> $hidAdGubun2,
			"txtMemo2"			=> $txtMemo2,
			"txtCommentUp"		=> $_POST['txtCommentUp'],
			"txtCommentDown"	=> $_POST['txtCommentDown'],
			"writer"			=> $_POST['writer'],
			"regdate"			=> $now
		);

		$salary = new Salary;
		$result = $salary->payMemberInsert($data);
		//exit;
		$this->movePageClose($_POST['dialogid']);
	}
	

		public function registPayMemberUpdate(){
		$count1="";$count2="";$count3="";$count4="";$count5="";$count6="";$count7="";$count8="";
		foreach($_POST as $key => $value) //POST용 
		{ 
			$$key = $value; //가변변수는 값이 없는 key 안보임
			//if(!is_array($$key))  echo $key." --> ".$value."<br>";
			/*
			if(!is_array($$key))  echo $key." --> ".$value."<br>"; 
			else 
			{ 
			  for($a=0; $a < sizeof($$key); $a++) 
			  echo $key."[".$a."] --> ".$value[$a]."<br>"; 
			  } 
			*/
			if(substr($key , 0 ,10) =="txtPayAmt1"){
				++$count1;
			}
			if(substr($key , 0 ,8) =="hidAdCd1"){
				++$count2;
			}
			if(substr($key , 0 ,11) =="hidAdGubun1"){
				++$count3;
			}
			if(substr($key , 0 ,8) =="txtMemo1"){
				++$count4;
			}

			if(substr($key , 0 ,10) =="txtPayAmt2"){
				++$count5;
			}
			if(substr($key , 0 ,8) =="hidAdCd2"){
				++$count6;
			}
			if(substr($key , 0 ,11) =="hidAdGubun2"){
				++$count7;
			}
			if(substr($key , 0 ,8) =="txtMemo2"){
				++$count8;
			}

			
		}
		for($i=0;$i<=$count1;$i++){

			$txtPayAmt1 = $txtPayAmt1. $_POST['txtPayAmt1_'.$i]."|";
		}
			$txtPayAmt1 = substr($txtPayAmt1 , 0, -1);

		for($i=0;$i<=$count2;$i++){
			$hidAdCd1 =$hidAdCd1.$_POST['hidAdCd1_'.$i]."|";
		}
			$hidAdCd1 = substr($hidAdCd1 , 0, -1);

		for($i=0;$i<=$count3;$i++){
			$hidAdGubun1=$hidAdGubun1.$_POST['hidAdGubun1_'.$i]."|";
		}
			$hidAdGubun1 = substr($hidAdGubun1 , 0, -1);

		for($i=0;$i<=$count4;$i++){
			$txtMemo1=$txtMemo1.$_POST['txtMemo1_'.$i]."|";
		}
			$txtMemo1 = substr($txtMemo1 , 0, -1);

		for($i=0;$i<=$count5;$i++){
			$txtPayAmt2=$txtPayAmt2.$_POST['txtPayAmt2_'.$i]."|";
		}
			$txtPayAmt2 = substr($txtPayAmt2 , 0, -1);

		for($i=0;$i<=$count6;$i++){
			$hidAdCd2=$hidAdCd2.$_POST['hidAdCd2_'.$i]."|";
		}
			$hidAdCd2 = substr($hidAdCd2 , 0, -1);

		for($i=0;$i<=$count7;$i++){
			$hidAdGubun2=$hidAdGubun2.$_POST['hidAdGubun2_'.$i]."|";
		}
			$hidAdGubun2 = substr($hidAdGubun2 , 0, -1);

		for($i=0;$i<=$count8;$i++){
			$txtMemo2=$txtMemo2.$_POST['txtMemo2_'.$i]."|";
		}
			$txtMemo2 = substr($txtMemo2 , 0, -1);

		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_pay_member_item",
			"where" =>			"sid=".$_POST['sid'],
			"pay_check_dt"		=> $_POST['pay_check_dt'],
			"pay_check_ca"		=> $_POST['pay_check_ca'],
			"emp_cd"			=> $_POST['emp_cd'],
			"emp_nm"			=> $_POST['emp_nm'],
			"lastday"			=> $_POST['lastday'],
			"txtPayAmt1"		=> $txtPayAmt1,
			"hidAdCd1"			=> $hidAdCd1,
			"hidAdGubun1"		=> $hidAdGubun1,
			"txtMemo1"			=> $txtMemo1,
			"txtPayAmt2"		=> $txtPayAmt2,
			"hidAdCd2"			=> $hidAdCd2,
			"hidAdGubun2"		=> $hidAdGubun2,
			"txtMemo2"			=> $txtMemo2,
			"txtCommentUp"		=> $_POST['txtCommentUp'],
			"txtCommentDown"	=> $_POST['txtCommentDown'],
			"writer"			=> $_POST['writer'],
			"regdate"			=> $now
		);

		$salary = new Salary;
		$result = $salary->payMemberUpdate($data);
		//exit;
		$t = Salary::getPayMember($_POST['pay_check_dt'], $_POST['pay_check_ca'], $_POST['emp_cd']);
		//$this->movePageClose($_POST['dialogid']);
		if($result) require_once ("views/salary/pay_member_regist_pop.php");
	}
	

	public function listPayrollBook() {
		require_once ("views/salary/payroll_book_list.php");
	}

	public function modifyPayrollBook() {
		$t = Salary::getPayrollBook($_GET['uid']);
		require_once ("views/salary/payroll_book_list.php");
	}

	public function PrintPaySlip() {
		require_once ("views/salary/pay_slip_print.php.php");
	}
	
	public function modifyPrintPaySlip() {
		$t = Salary::getPrintPaySlip($_GET['uid']);
		require_once ("views/salary/pay_slip_print.php");
	}

	public function registSalaryItmeInsert() {

		if ($yy_t = "") $yy_t=date('Y');
		$a_qry = " SELECT * from erp_salary_itme where yy_t='".$yy_t."'";
		$result = mysql_query($a_qry);  // echo($a_qry);
		$num_rows = mysql_num_rows($result);
		
		if ($num_rows > 0){
			$this->movePage("salary","registSalaryItme");
			exit;
		}

		$hidRow		= $_POST['hidRow'];
		$yy_t		= $_POST['yy_t'];
		$regdate			= $now;
		//echo $yy_t;
		//exit;

		$t=1;
		for($i=0;$i<=30;$i++){
			$a_des[] = $_POST['a_des_'.$t];
			$a_sort[] = $_POST['a_bonus_'.$t];
			$a_bonus[] = $_POST['a_bonus_'.$t];
			$a_bonus1[] = $_POST['a_bonus1_'.$t];
			$a_daily[] = $_POST['a_daily_'.$t];
			$a_rate[] = $_POST['a_rate_'.$t];
			$a_nontax[] = $_POST['a_nontax_'.$t];
			$a_nontax_cd[] = $_POST['a_nontax_cd_'.$t];
			$a_nontax_des[] = $_POST['a_nontax_des_'.$t];
			$calc1[] = $_POST['calc1_'.$t];
			$calc2[] = $_POST['calc2_'.$t];
			$calc_flag[] = $_POST['calc_flag_'.$t];
			$calc_des[] = $_POST['calc_des_'.$t];
			$attend_cd[] = $_POST['attend_cd_'.$t];
			$attend_des[] = $_POST['attend_des_'.$t];
			$attend_gubun[] = $_POST['a_bonus_'.$t];
			$uid[] = $_POST['uid_'.$t];
			++$t;
		}
		//foreach($a_des as $key => $value)
		//{
		//	$val1[]=$value;
		//}

			$this->salaryItmeInsert($a_des[0],$a_sort[0],$a_bonus[0],$a_bonus1[0],$a_daily[0],$a_rate[0],$a_nontax[0],$a_nontax_cd[0],$a_nontax_des[0],$calc1[0],$calc2[0],$calc_flag[0],$calc_des[0],$attend_cd[0],$attend_des[0],$uid[0],$yy_t);
			$this->salaryItmeInsert($a_des[1],$a_sort[1],$a_bonus[1],$a_bonus1[1],$a_daily[1],$a_rate[1],$a_nontax[1],$a_nontax_cd[1],$a_nontax_des[1],$calc1[1],$calc2[1],$calc_flag[1],$calc_des[1],$attend_cd[1],$attend_des[1],$uid[1],$yy_t);
			$this->salaryItmeInsert($a_des[2],$a_sort[2],$a_bonus[2],$a_bonus1[2],$a_daily[2],$a_rate[2],$a_nontax[2],$a_nontax_cd[2],$a_nontax_des[2],$calc1[2],$calc2[2],$calc_flag[2],$calc_des[2],$attend_cd[2],$attend_des[2],$uid[2],$yy_t);
			$this->salaryItmeInsert($a_des[3],$a_sort[3],$a_bonus[3],$a_bonus1[3],$a_daily[3],$a_rate[3],$a_nontax[3],$a_nontax_cd[3],$a_nontax_des[3],$calc1[3],$calc2[3],$calc_flag[3],$calc_des[3],$attend_cd[3],$attend_des[3],$uid[3],$yy_t);
			$this->salaryItmeInsert($a_des[4],$a_sort[4],$a_bonus[4],$a_bonus1[4],$a_daily[4],$a_rate[4],$a_nontax[4],$a_nontax_cd[4],$a_nontax_des[4],$calc1[4],$calc2[4],$calc_flag[4],$calc_des[4],$attend_cd[4],$attend_des[4],$uid[4],$yy_t);
			$this->salaryItmeInsert($a_des[5],$a_sort[5],$a_bonus[5],$a_bonus1[5],$a_daily[5],$a_rate[5],$a_nontax[5],$a_nontax_cd[5],$a_nontax_des[5],$calc1[5],$calc2[5],$calc_flag[5],$calc_des[5],$attend_cd[5],$attend_des[5],$uid[5],$yy_t);
			$this->salaryItmeInsert($a_des[6],$a_sort[6],$a_bonus[6],$a_bonus1[6],$a_daily[6],$a_rate[6],$a_nontax[6],$a_nontax_cd[6],$a_nontax_des[6],$calc1[6],$calc2[6],$calc_flag[6],$calc_des[6],$attend_cd[6],$attend_des[6],$uid[6],$yy_t);
			$this->salaryItmeInsert($a_des[7],$a_sort[7],$a_bonus[7],$a_bonus1[7],$a_daily[7],$a_rate[7],$a_nontax[7],$a_nontax_cd[7],$a_nontax_des[7],$calc1[7],$calc2[7],$calc_flag[7],$calc_des[7],$attend_cd[7],$attend_des[7],$uid[7],$yy_t);
			$this->salaryItmeInsert($a_des[8],$a_sort[8],$a_bonus[8],$a_bonus1[8],$a_daily[8],$a_rate[8],$a_nontax[8],$a_nontax_cd[8],$a_nontax_des[8],$calc1[8],$calc2[8],$calc_flag[8],$calc_des[8],$attend_cd[8],$attend_des[8],$uid[8],$yy_t);
			$this->salaryItmeInsert($a_des[9],$a_sort[9],$a_bonus[9],$a_bonus1[9],$a_daily[9],$a_rate[9],$a_nontax[9],$a_nontax_cd[9],$a_nontax_des[9],$calc1[9],$calc2[9],$calc_flag[9],$calc_des[9],$attend_cd[9],$attend_des[9],$uid[9],$yy_t);
			$this->salaryItmeInsert($a_des[10],$a_sort[10],$a_bonus[10],$a_bonus1[10],$a_daily[10],$a_rate[10],$a_nontax[10],$a_nontax_cd[10],$a_nontax_des[10],$calc1[10],$calc2[10],$calc_flag[10],$calc_des[10],$attend_cd[10],$attend_des[10],$uid[10],$yy_t);
			$this->salaryItmeInsert($a_des[11],$a_sort[11],$a_bonus[11],$a_bonus1[11],$a_daily[11],$a_rate[11],$a_nontax[11],$a_nontax_cd[11],$a_nontax_des[11],$calc1[11],$calc2[11],$calc_flag[11],$calc_des[11],$attend_cd[11],$attend_des[11],$uid[11],$yy_t);
			$this->salaryItmeInsert($a_des[12],$a_sort[12],$a_bonus[12],$a_bonus1[12],$a_daily[12],$a_rate[12],$a_nontax[12],$a_nontax_cd[12],$a_nontax_des[12],$calc1[12],$calc2[12],$calc_flag[12],$calc_des[12],$attend_cd[12],$attend_des[12],$uid[12],$yy_t);
			$this->salaryItmeInsert($a_des[13],$a_sort[13],$a_bonus[13],$a_bonus1[13],$a_daily[13],$a_rate[13],$a_nontax[13],$a_nontax_cd[13],$a_nontax_des[13],$calc1[13],$calc2[13],$calc_flag[13],$calc_des[13],$attend_cd[13],$attend_des[13],$uid[13],$yy_t);
			$this->salaryItmeInsert($a_des[14],$a_sort[14],$a_bonus[14],$a_bonus1[14],$a_daily[14],$a_rate[14],$a_nontax[14],$a_nontax_cd[14],$a_nontax_des[14],$calc1[14],$calc2[14],$calc_flag[14],$calc_des[14],$attend_cd[14],$attend_des[14],$uid[14],$yy_t);
			$this->salaryItmeInsert($a_des[15],$a_sort[15],$a_bonus[15],$a_bonus1[15],$a_daily[15],$a_rate[15],$a_nontax[15],$a_nontax_cd[15],$a_nontax_des[15],$calc1[15],$calc2[15],$calc_flag[15],$calc_des[15],$attend_cd[15],$attend_des[15],$uid[15],$yy_t);
			$this->salaryItmeInsert($a_des[16],$a_sort[16],$a_bonus[16],$a_bonus1[16],$a_daily[16],$a_rate[16],$a_nontax[16],$a_nontax_cd[16],$a_nontax_des[16],$calc1[16],$calc2[16],$calc_flag[16],$calc_des[16],$attend_cd[16],$attend_des[16],$uid[16],$yy_t);
			$this->salaryItmeInsert($a_des[17],$a_sort[17],$a_bonus[17],$a_bonus1[17],$a_daily[17],$a_rate[17],$a_nontax[17],$a_nontax_cd[17],$a_nontax_des[17],$calc1[17],$calc2[17],$calc_flag[17],$calc_des[17],$attend_cd[17],$attend_des[17],$uid[17],$yy_t);
			$this->salaryItmeInsert($a_des[18],$a_sort[18],$a_bonus[18],$a_bonus1[18],$a_daily[18],$a_rate[18],$a_nontax[18],$a_nontax_cd[18],$a_nontax_des[18],$calc1[18],$calc2[18],$calc_flag[18],$calc_des[18],$attend_cd[18],$attend_des[18],$uid[18],$yy_t);
			$this->salaryItmeInsert($a_des[19],$a_sort[19],$a_bonus[19],$a_bonus1[19],$a_daily[19],$a_rate[19],$a_nontax[19],$a_nontax_cd[19],$a_nontax_des[19],$calc1[19],$calc2[19],$calc_flag[19],$calc_des[19],$attend_cd[19],$attend_des[19],$uid[19],$yy_t);
			$this->salaryItmeInsert($a_des[20],$a_sort[20],$a_bonus[20],$a_bonus1[20],$a_daily[20],$a_rate[20],$a_nontax[20],$a_nontax_cd[20],$a_nontax_des[20],$calc1[20],$calc2[20],$calc_flag[20],$calc_des[20],$attend_cd[20],$attend_des[20],$uid[20],$yy_t);
			$this->salaryItmeInsert($a_des[21],$a_sort[21],$a_bonus[21],$a_bonus1[21],$a_daily[21],$a_rate[21],$a_nontax[21],$a_nontax_cd[21],$a_nontax_des[21],$calc1[21],$calc2[21],$calc_flag[21],$calc_des[21],$attend_cd[21],$attend_des[21],$uid[21],$yy_t);
			$this->salaryItmeInsert($a_des[22],$a_sort[22],$a_bonus[22],$a_bonus1[22],$a_daily[22],$a_rate[22],$a_nontax[22],$a_nontax_cd[22],$a_nontax_des[22],$calc1[22],$calc2[22],$calc_flag[22],$calc_des[22],$attend_cd[22],$attend_des[22],$uid[22],$yy_t);
			$this->salaryItmeInsert($a_des[23],$a_sort[23],$a_bonus[23],$a_bonus1[23],$a_daily[23],$a_rate[23],$a_nontax[23],$a_nontax_cd[23],$a_nontax_des[23],$calc1[23],$calc2[23],$calc_flag[23],$calc_des[23],$attend_cd[23],$attend_des[23],$uid[23],$yy_t);
			$this->salaryItmeInsert($a_des[24],$a_sort[24],$a_bonus[24],$a_bonus1[24],$a_daily[24],$a_rate[24],$a_nontax[24],$a_nontax_cd[24],$a_nontax_des[24],$calc1[24],$calc2[24],$calc_flag[24],$calc_des[24],$attend_cd[24],$attend_des[24],$uid[24],$yy_t);
			$this->salaryItmeInsert($a_des[25],$a_sort[25],$a_bonus[25],$a_bonus1[25],$a_daily[25],$a_rate[25],$a_nontax[25],$a_nontax_cd[25],$a_nontax_des[25],$calc1[25],$calc2[25],$calc_flag[25],$calc_des[25],$attend_cd[25],$attend_des[25],$uid[25],$yy_t);
			$this->salaryItmeInsert($a_des[26],$a_sort[26],$a_bonus[26],$a_bonus1[26],$a_daily[26],$a_rate[26],$a_nontax[26],$a_nontax_cd[26],$a_nontax_des[26],$calc1[26],$calc2[26],$calc_flag[26],$calc_des[26],$attend_cd[26],$attend_des[26],$uid[26],$yy_t);
			$this->salaryItmeInsert($a_des[27],$a_sort[27],$a_bonus[27],$a_bonus1[27],$a_daily[27],$a_rate[27],$a_nontax[27],$a_nontax_cd[27],$a_nontax_des[27],$calc1[27],$calc2[27],$calc_flag[27],$calc_des[27],$attend_cd[27],$attend_des[27],$uid[27],$yy_t);
			$this->salaryItmeInsert($a_des[28],$a_sort[28],$a_bonus[28],$a_bonus1[28],$a_daily[28],$a_rate[28],$a_nontax[28],$a_nontax_cd[28],$a_nontax_des[28],$calc1[28],$calc2[28],$calc_flag[28],$calc_des[28],$attend_cd[28],$attend_des[28],$uid[28],$yy_t);
			$this->salaryItmeInsert($a_des[29],$a_sort[29],$a_bonus[29],$a_bonus1[29],$a_daily[29],$a_rate[29],$a_nontax[29],$a_nontax_cd[29],$a_nontax_des[29],$calc1[29],$calc2[29],$calc_flag[29],$calc_des[29],$attend_cd[29],$attend_des[29],$uid[29],$yy_t);

		$this->movePage("salary","registSalaryItme");
	}

	public function salaryItmeInsert($val1,$val2,$val3,$val4,$val5,$val6,$val7,$val8,$val9,$val10,$val11,$val12,$val13,$val14,$val15,$yy_t){
			$data = array(
					"table"				=> "erp_salary_itme",
					"a_des"				=> $val1,
					"a_sort"			=> $val2,
					"a_bonus"			=> $val3,
					"a_bonus1"			=> $val4,
					"a_daily"			=> $val5,
					"a_rate"			=> $val6,
					"a_nontax"			=> $val7,
					"a_nontax_cd"		=> $val8,
					"a_nontax_des"		=> $val9,
					"calc1"				=> $val10,
					"calc2"				=> $val11,
					"calc_flag"			=> $val12,
					"calc_des"			=> $val13,
					"attend_cd"			=> $val14,
					"attend_des"		=> $val15,
					"yy_t"				=> $yy_t,
					"attend_gubun"		=> "",
				);
			$salary = new Salary;
			$salary->salaryItmeInsert($data);
	}

	public function registSalaryItmeUpdate() {

		$hidRow		= $_POST['hidRow'];
		$yy_t		= $_POST['yy_t'];
		$regdate			= $now;
		//echo $yy_t;
		//exit;
		$t=1;
		for($i=0;$i<=30;$i++){
		$a_des[] = $_POST['a_des_'.$t];
		$a_sort[] = $_POST['a_bonus_'.$t];
		$a_bonus[] = $_POST['a_bonus_'.$t];
		$a_bonus1[] = $_POST['a_bonus1_'.$t];
		$a_daily[] = $_POST['a_daily_'.$t];
		$a_rate[] = $_POST['a_rate_'.$t];
		$a_nontax[] = $_POST['a_nontax_'.$t];
		$a_nontax_cd[] = $_POST['a_nontax_cd_'.$t];
		$a_nontax_des[] = $_POST['a_nontax_des_'.$t];
		$calc1[] = $_POST['calc1_'.$t];
		$calc2[] = $_POST['calc2_'.$t];
		$calc_flag[] = $_POST['calc_flag_'.$t];
		$calc_des[] = $_POST['calc_des_'.$t];
		$attend_cd[] = $_POST['attend_cd_'.$t];
		$attend_des[] = $_POST['attend_des_'.$t];
		$attend_gubun[] = $_POST['a_bonus_'.$t];
		$uid[] = $_POST['uid_'.$t];
		++$t;
		}
		//foreach($a_des as $key => $value)
		//{
		//	$val1[]=$value;
		//}
		
			$this->salaryItmeUpdate($a_des[0],$a_sort[0],$a_bonus[0],$a_bonus1[0],$a_daily[0],$a_rate[0],$a_nontax[0],$a_nontax_cd[0],$a_nontax_des[0],$calc1[0],$calc2[0],$calc_flag[0],$calc_des[0],$attend_cd[0],$attend_des[0],$uid[0],$yy_t);
			$this->salaryItmeUpdate($a_des[1],$a_sort[1],$a_bonus[1],$a_bonus1[1],$a_daily[1],$a_rate[1],$a_nontax[1],$a_nontax_cd[1],$a_nontax_des[1],$calc1[1],$calc2[1],$calc_flag[1],$calc_des[1],$attend_cd[1],$attend_des[1],$uid[1],$yy_t);
			$this->salaryItmeUpdate($a_des[2],$a_sort[2],$a_bonus[2],$a_bonus1[2],$a_daily[2],$a_rate[2],$a_nontax[2],$a_nontax_cd[2],$a_nontax_des[2],$calc1[2],$calc2[2],$calc_flag[2],$calc_des[2],$attend_cd[2],$attend_des[2],$uid[2],$yy_t);
			$this->salaryItmeUpdate($a_des[3],$a_sort[3],$a_bonus[3],$a_bonus1[3],$a_daily[3],$a_rate[3],$a_nontax[3],$a_nontax_cd[3],$a_nontax_des[3],$calc1[3],$calc2[3],$calc_flag[3],$calc_des[3],$attend_cd[3],$attend_des[3],$uid[3],$yy_t);
			$this->salaryItmeUpdate($a_des[4],$a_sort[4],$a_bonus[4],$a_bonus1[4],$a_daily[4],$a_rate[4],$a_nontax[4],$a_nontax_cd[4],$a_nontax_des[4],$calc1[4],$calc2[4],$calc_flag[4],$calc_des[4],$attend_cd[4],$attend_des[4],$uid[4],$yy_t);
			$this->salaryItmeUpdate($a_des[5],$a_sort[5],$a_bonus[5],$a_bonus1[5],$a_daily[5],$a_rate[5],$a_nontax[5],$a_nontax_cd[5],$a_nontax_des[5],$calc1[5],$calc2[5],$calc_flag[5],$calc_des[5],$attend_cd[5],$attend_des[5],$uid[5],$yy_t);
			$this->salaryItmeUpdate($a_des[6],$a_sort[6],$a_bonus[6],$a_bonus1[6],$a_daily[6],$a_rate[6],$a_nontax[6],$a_nontax_cd[6],$a_nontax_des[6],$calc1[6],$calc2[6],$calc_flag[6],$calc_des[6],$attend_cd[6],$attend_des[6],$uid[6],$yy_t);
			$this->salaryItmeUpdate($a_des[7],$a_sort[7],$a_bonus[7],$a_bonus1[7],$a_daily[7],$a_rate[7],$a_nontax[7],$a_nontax_cd[7],$a_nontax_des[7],$calc1[7],$calc2[7],$calc_flag[7],$calc_des[7],$attend_cd[7],$attend_des[7],$uid[7],$yy_t);
			$this->salaryItmeUpdate($a_des[8],$a_sort[8],$a_bonus[8],$a_bonus1[8],$a_daily[8],$a_rate[8],$a_nontax[8],$a_nontax_cd[8],$a_nontax_des[8],$calc1[8],$calc2[8],$calc_flag[8],$calc_des[8],$attend_cd[8],$attend_des[8],$uid[8],$yy_t);
			$this->salaryItmeUpdate($a_des[9],$a_sort[9],$a_bonus[9],$a_bonus1[9],$a_daily[9],$a_rate[9],$a_nontax[9],$a_nontax_cd[9],$a_nontax_des[9],$calc1[9],$calc2[9],$calc_flag[9],$calc_des[9],$attend_cd[9],$attend_des[9],$uid[9],$yy_t);
			$this->salaryItmeUpdate($a_des[10],$a_sort[10],$a_bonus[10],$a_bonus1[10],$a_daily[10],$a_rate[10],$a_nontax[10],$a_nontax_cd[10],$a_nontax_des[10],$calc1[10],$calc2[10],$calc_flag[10],$calc_des[10],$attend_cd[10],$attend_des[10],$uid[10],$yy_t);
			$this->salaryItmeUpdate($a_des[11],$a_sort[11],$a_bonus[11],$a_bonus1[11],$a_daily[11],$a_rate[11],$a_nontax[11],$a_nontax_cd[11],$a_nontax_des[11],$calc1[11],$calc2[11],$calc_flag[11],$calc_des[11],$attend_cd[11],$attend_des[11],$uid[11],$yy_t);
			$this->salaryItmeUpdate($a_des[12],$a_sort[12],$a_bonus[12],$a_bonus1[12],$a_daily[12],$a_rate[12],$a_nontax[12],$a_nontax_cd[12],$a_nontax_des[12],$calc1[12],$calc2[12],$calc_flag[12],$calc_des[12],$attend_cd[12],$attend_des[12],$uid[12],$yy_t);
			$this->salaryItmeUpdate($a_des[13],$a_sort[13],$a_bonus[13],$a_bonus1[13],$a_daily[13],$a_rate[13],$a_nontax[13],$a_nontax_cd[13],$a_nontax_des[13],$calc1[13],$calc2[13],$calc_flag[13],$calc_des[13],$attend_cd[13],$attend_des[13],$uid[13],$yy_t);
			$this->salaryItmeUpdate($a_des[14],$a_sort[14],$a_bonus[14],$a_bonus1[14],$a_daily[14],$a_rate[14],$a_nontax[14],$a_nontax_cd[14],$a_nontax_des[14],$calc1[14],$calc2[14],$calc_flag[14],$calc_des[14],$attend_cd[14],$attend_des[14],$uid[14],$yy_t);
			$this->salaryItmeUpdate($a_des[15],$a_sort[15],$a_bonus[15],$a_bonus1[15],$a_daily[15],$a_rate[15],$a_nontax[15],$a_nontax_cd[15],$a_nontax_des[15],$calc1[15],$calc2[15],$calc_flag[15],$calc_des[15],$attend_cd[15],$attend_des[15],$uid[15],$yy_t);
			$this->salaryItmeUpdate($a_des[16],$a_sort[16],$a_bonus[16],$a_bonus1[16],$a_daily[16],$a_rate[16],$a_nontax[16],$a_nontax_cd[16],$a_nontax_des[16],$calc1[16],$calc2[16],$calc_flag[16],$calc_des[16],$attend_cd[16],$attend_des[16],$uid[16],$yy_t);
			$this->salaryItmeUpdate($a_des[17],$a_sort[17],$a_bonus[17],$a_bonus1[17],$a_daily[17],$a_rate[17],$a_nontax[17],$a_nontax_cd[17],$a_nontax_des[17],$calc1[17],$calc2[17],$calc_flag[17],$calc_des[17],$attend_cd[17],$attend_des[17],$uid[17],$yy_t);
			$this->salaryItmeUpdate($a_des[18],$a_sort[18],$a_bonus[18],$a_bonus1[18],$a_daily[18],$a_rate[18],$a_nontax[18],$a_nontax_cd[18],$a_nontax_des[18],$calc1[18],$calc2[18],$calc_flag[18],$calc_des[18],$attend_cd[18],$attend_des[18],$uid[18],$yy_t);
			$this->salaryItmeUpdate($a_des[19],$a_sort[19],$a_bonus[19],$a_bonus1[19],$a_daily[19],$a_rate[19],$a_nontax[19],$a_nontax_cd[19],$a_nontax_des[19],$calc1[19],$calc2[19],$calc_flag[19],$calc_des[19],$attend_cd[19],$attend_des[19],$uid[19],$yy_t);
			$this->salaryItmeUpdate($a_des[20],$a_sort[20],$a_bonus[20],$a_bonus1[20],$a_daily[20],$a_rate[20],$a_nontax[20],$a_nontax_cd[20],$a_nontax_des[20],$calc1[20],$calc2[20],$calc_flag[20],$calc_des[20],$attend_cd[20],$attend_des[20],$uid[20],$yy_t);
			$this->salaryItmeUpdate($a_des[21],$a_sort[21],$a_bonus[21],$a_bonus1[21],$a_daily[21],$a_rate[21],$a_nontax[21],$a_nontax_cd[21],$a_nontax_des[21],$calc1[21],$calc2[21],$calc_flag[21],$calc_des[21],$attend_cd[21],$attend_des[21],$uid[21],$yy_t);
			$this->salaryItmeUpdate($a_des[22],$a_sort[22],$a_bonus[22],$a_bonus1[22],$a_daily[22],$a_rate[22],$a_nontax[22],$a_nontax_cd[22],$a_nontax_des[22],$calc1[22],$calc2[22],$calc_flag[22],$calc_des[22],$attend_cd[22],$attend_des[22],$uid[22],$yy_t);
			$this->salaryItmeUpdate($a_des[23],$a_sort[23],$a_bonus[23],$a_bonus1[23],$a_daily[23],$a_rate[23],$a_nontax[23],$a_nontax_cd[23],$a_nontax_des[23],$calc1[23],$calc2[23],$calc_flag[23],$calc_des[23],$attend_cd[23],$attend_des[23],$uid[23],$yy_t);
			$this->salaryItmeUpdate($a_des[24],$a_sort[24],$a_bonus[24],$a_bonus1[24],$a_daily[24],$a_rate[24],$a_nontax[24],$a_nontax_cd[24],$a_nontax_des[24],$calc1[24],$calc2[24],$calc_flag[24],$calc_des[24],$attend_cd[24],$attend_des[24],$uid[24],$yy_t);
			$this->salaryItmeUpdate($a_des[25],$a_sort[25],$a_bonus[25],$a_bonus1[25],$a_daily[25],$a_rate[25],$a_nontax[25],$a_nontax_cd[25],$a_nontax_des[25],$calc1[25],$calc2[25],$calc_flag[25],$calc_des[25],$attend_cd[25],$attend_des[25],$uid[25],$yy_t);
			$this->salaryItmeUpdate($a_des[26],$a_sort[26],$a_bonus[26],$a_bonus1[26],$a_daily[26],$a_rate[26],$a_nontax[26],$a_nontax_cd[26],$a_nontax_des[26],$calc1[26],$calc2[26],$calc_flag[26],$calc_des[26],$attend_cd[26],$attend_des[26],$uid[26],$yy_t);
			$this->salaryItmeUpdate($a_des[27],$a_sort[27],$a_bonus[27],$a_bonus1[27],$a_daily[27],$a_rate[27],$a_nontax[27],$a_nontax_cd[27],$a_nontax_des[27],$calc1[27],$calc2[27],$calc_flag[27],$calc_des[27],$attend_cd[27],$attend_des[27],$uid[27],$yy_t);
			$this->salaryItmeUpdate($a_des[28],$a_sort[28],$a_bonus[28],$a_bonus1[28],$a_daily[28],$a_rate[28],$a_nontax[28],$a_nontax_cd[28],$a_nontax_des[28],$calc1[28],$calc2[28],$calc_flag[28],$calc_des[28],$attend_cd[28],$attend_des[28],$uid[28],$yy_t);
			$this->salaryItmeUpdate($a_des[29],$a_sort[29],$a_bonus[29],$a_bonus1[29],$a_daily[29],$a_rate[29],$a_nontax[29],$a_nontax_cd[29],$a_nontax_des[29],$calc1[29],$calc2[29],$calc_flag[29],$calc_des[29],$attend_cd[29],$attend_des[29],$uid[29],$yy_t);

		$this->movePage("salary","registSalaryItme");
	}

	public function salaryItmeUpdate($val1,$val2,$val3,$val4,$val5,$val6,$val7,$val8,$val9,$val10,$val11,$val12,$val13,$val14,$val15,$val16,$yy_t){

			$data = array(
					"table"				=> "erp_salary_itme",
					"where"				=> " yy_t='".$yy_t."' and uid=".$val16,
					"a_des"				=> $val1,
					"a_sort"			=> $val2,
					"a_bonus"			=> $val3,
					"a_bonus1"			=> $val4,
					"a_daily"			=> $val5,
					"a_rate"			=> $val6,
					"a_nontax"			=> $val7,
					"a_nontax_cd"		=> $val8,
					"a_nontax_des"		=> $val9,
					"calc1"				=> $val10,
					"calc2"				=> $val11,
					"calc_flag"			=> $val12,
					"calc_des"			=> $val13,
					"attend_cd"			=> $val14,
					"attend_des"		=> $val15,
					"yy_t"				=> $yy_t,
					"attend_gubun"		=> "",
				);
			$salary = new Salary;
			$salary->salaryItmeUpdate($data);
	}
	


	public function registDeclarationItmeInsert() {

		if ($yy_t = "") $yy_t=date('Y');
		$a_qry = " SELECT * from erp_declaration_itme where yy_t='".$yy_t."'";
		$result = mysql_query($a_qry);  // echo($a_qry);
		$num_rows = mysql_num_rows($result);
		
		if ($num_rows > 0){
			$this->movePage("salary","registDeclarationItem");
			exit;
		}

		$hidRow		= $_POST['hidRow'];
		$yy_t		= $_POST['yy_t'];
		$regdate			= $now;
		//echo $yy_t;
		//exit;

		$t=1;
		for($i=0;$i<23;$i++){
		$d_des[]		= $_POST['d_des_'.$i];
		$d_sort[]		= $_POST['d_sort_'.$i];
		$aci_cd[]		= $_POST['aci_cd_'.$i];
		$aci_nm[]		= $_POST['aci_nm_'.$i];
		$cust[]			= $_POST['cust_'.$i];
		$cust_name[]	= $_POST['cust_name_'.$i];
		$calc1[]		= $_POST['calc1_'.$i];
		$calc2[]		= $_POST['calc2_'.$i];
		$calc_flag[]	= $_POST['calc_flag_'.$i];
		$calc_des[]		= $_POST['calc_des_'.$i];
		$etc[]			= $_POST['etc_'.$i];
		$uid[]			= $_POST['uid_'.$i];
		++$t;
		}
		//foreach($d_des as $key => $value)
		//{
			//$val1[]=$value;
			//echo $key." --> ".$value."<br>";
		//}
		//exit;

			$this->declarationItmeInsert($d_des[0],$d_sort[0],$aci_cd[0],$aci_nm[0],$cust[0],$cust_name[0],$calc1[0],$calc2[0],$calc_flag[0],$calc_des[0],$etc[0],$yy_t);
			$this->declarationItmeInsert($d_des[1],$d_sort[1],$aci_cd[1],$aci_nm[1],$cust[1],$cust_name[1],$calc1[1],$calc2[1],$calc_flag[1],$calc_des[1],$etc[1],$yy_t);
			$this->declarationItmeInsert($d_des[2],$d_sort[2],$aci_cd[2],$aci_nm[2],$cust[2],$cust_name[2],$calc1[2],$calc2[2],$calc_flag[2],$calc_des[2],$etc[2],$yy_t);
			$this->declarationItmeInsert($d_des[3],$d_sort[3],$aci_cd[3],$aci_nm[3],$cust[3],$cust_name[3],$calc1[3],$calc2[3],$calc_flag[3],$calc_des[3],$etc[3],$yy_t);
			$this->declarationItmeInsert($d_des[4],$d_sort[4],$aci_cd[4],$aci_nm[4],$cust[4],$cust_name[4],$calc1[4],$calc2[4],$calc_flag[4],$calc_des[4],$etc[4],$yy_t);
			$this->declarationItmeInsert($d_des[5],$d_sort[5],$aci_cd[5],$aci_nm[5],$cust[5],$cust_name[5],$calc1[5],$calc2[5],$calc_flag[5],$calc_des[5],$etc[5],$yy_t);
			$this->declarationItmeInsert($d_des[6],$d_sort[6],$aci_cd[6],$aci_nm[6],$cust[6],$cust_name[6],$calc1[6],$calc2[6],$calc_flag[6],$calc_des[6],$etc[6],$yy_t);
			$this->declarationItmeInsert($d_des[7],$d_sort[7],$aci_cd[7],$aci_nm[7],$cust[7],$cust_name[7],$calc1[7],$calc2[7],$calc_flag[7],$calc_des[7],$etc[7],$yy_t);
			$this->declarationItmeInsert($d_des[8],$d_sort[8],$aci_cd[8],$aci_nm[8],$cust[8],$cust_name[8],$calc1[8],$calc2[8],$calc_flag[8],$calc_des[8],$etc[8],$yy_t);
			$this->declarationItmeInsert($d_des[9],$d_sort[9],$aci_cd[9],$aci_nm[9],$cust[9],$cust_name[9],$calc1[9],$calc2[9],$calc_flag[9],$calc_des[9],$etc[9],$yy_t);
			$this->declarationItmeInsert($d_des[10],$d_sort[10],$aci_cd[10],$aci_nm[10],$cust[10],$cust_name[10],$calc1[10],$calc2[10],$calc_flag[10],$calc_des[10],$etc[10],$yy_t);
			$this->declarationItmeInsert($d_des[11],$d_sort[11],$aci_cd[11],$aci_nm[11],$cust[11],$cust_name[11],$calc1[11],$calc2[11],$calc_flag[11],$calc_des[11],$etc[11],$yy_t);
			$this->declarationItmeInsert($d_des[12],$d_sort[12],$aci_cd[12],$aci_nm[12],$cust[12],$cust_name[12],$calc1[12],$calc2[12],$calc_flag[12],$calc_des[12],$etc[12],$yy_t);
			$this->declarationItmeInsert($d_des[13],$d_sort[13],$aci_cd[13],$aci_nm[13],$cust[13],$cust_name[13],$calc1[13],$calc2[13],$calc_flag[13],$calc_des[13],$etc[13],$yy_t);
			$this->declarationItmeInsert($d_des[14],$d_sort[14],$aci_cd[14],$aci_nm[14],$cust[14],$cust_name[14],$calc1[14],$calc2[14],$calc_flag[14],$calc_des[14],$etc[14],$yy_t);
			$this->declarationItmeInsert($d_des[15],$d_sort[15],$aci_cd[15],$aci_nm[15],$cust[15],$cust_name[15],$calc1[15],$calc2[15],$calc_flag[15],$calc_des[15],$etc[15],$yy_t);
			$this->declarationItmeInsert($d_des[16],$d_sort[16],$aci_cd[16],$aci_nm[16],$cust[16],$cust_name[16],$calc1[16],$calc2[16],$calc_flag[16],$calc_des[16],$etc[16],$yy_t);
			$this->declarationItmeInsert($d_des[17],$d_sort[17],$aci_cd[17],$aci_nm[17],$cust[17],$cust_name[17],$calc1[17],$calc2[17],$calc_flag[17],$calc_des[17],$etc[17],$yy_t);
			$this->declarationItmeInsert($d_des[18],$d_sort[18],$aci_cd[18],$aci_nm[18],$cust[18],$cust_name[18],$calc1[18],$calc2[18],$calc_flag[18],$calc_des[18],$etc[18],$yy_t);
			$this->declarationItmeInsert($d_des[19],$d_sort[19],$aci_cd[19],$aci_nm[19],$cust[19],$cust_name[19],$calc1[19],$calc2[19],$calc_flag[19],$calc_des[19],$etc[19],$yy_t);
			$this->declarationItmeInsert($d_des[20],$d_sort[20],$aci_cd[20],$aci_nm[20],$cust[20],$cust_name[20],$calc1[20],$calc2[20],$calc_flag[20],$calc_des[20],$etc[20],$yy_t);
			$this->declarationItmeInsert($d_des[21],$d_sort[21],$aci_cd[21],$aci_nm[21],$cust[21],$cust_name[21],$calc1[21],$calc2[21],$calc_flag[21],$calc_des[21],$etc[21],$yy_t);
			$this->declarationItmeInsert($d_des[22],$d_sort[22],$aci_cd[22],$aci_nm[22],$cust[22],$cust_name[22],$calc1[22],$calc2[22],$calc_flag[22],$calc_des[22],$etc[22],$yy_t);

		$this->movePage("salary","registDeclarationItem");
	}

	public function declarationItmeInsert($val1,$val2,$val3,$val4,$val5,$val6,$val7,$val8,$val9,$val10,$val11,$yy_t){
			$data = array(
					"table"				=> "erp_declaration_itme",
					"d_des"				=> $val1,
					"d_sort"			=> $val2,
					"aci_cd"			=> $val3,
					"aci_nm"			=> $val4,
					"cust"				=> $val5,
					"cust_name"			=> $val6,
					"calc1"				=> $val7,
					"calc2"				=> $val8,
					"calc_flag"			=> $val9,
					"calc_des"			=> $val10,
					"etc"				=> $val11,
					"yy_t"				=> $yy_t,
				);
			$salary = new Salary;
			$salary->declarationItmeInsert($data);
	}


	public function registDeclarationItmeUpdate() {
		$hidRow		= $_POST['hidRow'];
		$yy_t		= $_POST['yy_t'];
		$regdate			= $now;
		//echo $yy_t;
		//exit;

		$t=1;
		for($i=0;$i<23;$i++){
		$d_des[]		= $_POST['d_des_'.$i];
		$d_sort[]		= $_POST['d_sort_'.$i];
		$aci_cd[]		= $_POST['aci_cd_'.$i];
		$aci_nm[]		= $_POST['aci_nm_'.$i];
		$cust[]			= $_POST['cust_'.$i];
		$cust_name[]	= $_POST['cust_name_'.$i];
		$calc1[]		= $_POST['calc1_'.$i];
		$calc2[]		= $_POST['calc2_'.$i];
		$calc_flag[]	= $_POST['calc_flag_'.$i];
		$calc_des[]		= $_POST['calc_des_'.$i];
		$etc[]			= $_POST['etc_'.$i];
		$uid[]			= $_POST['uid_'.$i];
		++$t;
		}
		//foreach($a_des as $key => $value)
		//{
		//	$val1[]=$value;
		//  echo $key." --> ".$value."<br>";
		//}

			$this->declarationItmeUpdate($d_des[0],$d_sort[0],$aci_cd[0],$aci_nm[0],$cust[0],$cust_name[0],$calc1[0],$calc2[0],$calc_flag[0],$calc_des[0],$etc[0],$uid[0],$yy_t);
			$this->declarationItmeUpdate($d_des[1],$d_sort[1],$aci_cd[1],$aci_nm[1],$cust[1],$cust_name[1],$calc1[1],$calc2[1],$calc_flag[1],$calc_des[1],$etc[1],$uid[1],$yy_t);
			$this->declarationItmeUpdate($d_des[2],$d_sort[2],$aci_cd[2],$aci_nm[2],$cust[2],$cust_name[2],$calc1[2],$calc2[2],$calc_flag[2],$calc_des[2],$etc[2],$uid[2],$yy_t);
			$this->declarationItmeUpdate($d_des[3],$d_sort[3],$aci_cd[3],$aci_nm[3],$cust[3],$cust_name[3],$calc1[3],$calc2[3],$calc_flag[3],$calc_des[3],$etc[3],$uid[3],$yy_t);
			$this->declarationItmeUpdate($d_des[4],$d_sort[4],$aci_cd[4],$aci_nm[4],$cust[4],$cust_name[4],$calc1[4],$calc2[4],$calc_flag[4],$calc_des[4],$etc[4],$uid[4],$yy_t);
			$this->declarationItmeUpdate($d_des[5],$d_sort[5],$aci_cd[5],$aci_nm[5],$cust[5],$cust_name[5],$calc1[5],$calc2[5],$calc_flag[5],$calc_des[5],$etc[5],$uid[5],$yy_t);
			$this->declarationItmeUpdate($d_des[6],$d_sort[6],$aci_cd[6],$aci_nm[6],$cust[6],$cust_name[6],$calc1[6],$calc2[6],$calc_flag[6],$calc_des[6],$etc[6],$uid[6],$yy_t);
			$this->declarationItmeUpdate($d_des[7],$d_sort[7],$aci_cd[7],$aci_nm[7],$cust[7],$cust_name[7],$calc1[7],$calc2[7],$calc_flag[7],$calc_des[7],$etc[7],$uid[7],$yy_t);
			$this->declarationItmeUpdate($d_des[8],$d_sort[8],$aci_cd[8],$aci_nm[8],$cust[8],$cust_name[8],$calc1[8],$calc2[8],$calc_flag[8],$calc_des[8],$etc[8],$uid[8],$yy_t);
			$this->declarationItmeUpdate($d_des[9],$d_sort[9],$aci_cd[9],$aci_nm[9],$cust[9],$cust_name[9],$calc1[9],$calc2[9],$calc_flag[9],$calc_des[9],$etc[9],$uid[9],$yy_t);
			$this->declarationItmeUpdate($d_des[10],$d_sort[10],$aci_cd[10],$aci_nm[10],$cust[10],$cust_name[10],$calc1[10],$calc2[10],$calc_flag[10],$calc_des[10],$etc[10],$uid[10],$yy_t);
			$this->declarationItmeUpdate($d_des[11],$d_sort[11],$aci_cd[11],$aci_nm[11],$cust[11],$cust_name[11],$calc1[11],$calc2[11],$calc_flag[11],$calc_des[11],$etc[11],$uid[11],$yy_t);
			$this->declarationItmeUpdate($d_des[12],$d_sort[12],$aci_cd[12],$aci_nm[12],$cust[12],$cust_name[12],$calc1[12],$calc2[12],$calc_flag[12],$calc_des[12],$etc[12],$uid[12],$yy_t);
			$this->declarationItmeUpdate($d_des[13],$d_sort[13],$aci_cd[13],$aci_nm[13],$cust[13],$cust_name[13],$calc1[13],$calc2[13],$calc_flag[13],$calc_des[13],$etc[13],$uid[13],$yy_t);
			$this->declarationItmeUpdate($d_des[14],$d_sort[14],$aci_cd[14],$aci_nm[14],$cust[14],$cust_name[14],$calc1[14],$calc2[14],$calc_flag[14],$calc_des[14],$etc[14],$uid[14],$yy_t);
			$this->declarationItmeUpdate($d_des[15],$d_sort[15],$aci_cd[15],$aci_nm[15],$cust[15],$cust_name[15],$calc1[15],$calc2[15],$calc_flag[15],$calc_des[15],$etc[15],$uid[15],$yy_t);
			$this->declarationItmeUpdate($d_des[16],$d_sort[16],$aci_cd[16],$aci_nm[16],$cust[16],$cust_name[16],$calc1[16],$calc2[16],$calc_flag[16],$calc_des[16],$etc[16],$uid[16],$yy_t);
			$this->declarationItmeUpdate($d_des[17],$d_sort[17],$aci_cd[17],$aci_nm[17],$cust[17],$cust_name[17],$calc1[17],$calc2[17],$calc_flag[17],$calc_des[17],$etc[17],$uid[17],$yy_t);
			$this->declarationItmeUpdate($d_des[18],$d_sort[18],$aci_cd[18],$aci_nm[18],$cust[18],$cust_name[18],$calc1[18],$calc2[18],$calc_flag[18],$calc_des[18],$etc[18],$uid[18],$yy_t);
			$this->declarationItmeUpdate($d_des[19],$d_sort[19],$aci_cd[19],$aci_nm[19],$cust[19],$cust_name[19],$calc1[19],$calc2[19],$calc_flag[19],$calc_des[19],$etc[19],$uid[19],$yy_t);
			$this->declarationItmeUpdate($d_des[20],$d_sort[20],$aci_cd[20],$aci_nm[20],$cust[20],$cust_name[20],$calc1[20],$calc2[20],$calc_flag[20],$calc_des[20],$etc[20],$uid[20],$yy_t);
			$this->declarationItmeUpdate($d_des[21],$d_sort[21],$aci_cd[21],$aci_nm[21],$cust[21],$cust_name[21],$calc1[21],$calc2[21],$calc_flag[21],$calc_des[21],$etc[21],$uid[21],$yy_t);
			$this->declarationItmeUpdate($d_des[22],$d_sort[22],$aci_cd[22],$aci_nm[22],$cust[22],$cust_name[22],$calc1[22],$calc2[22],$calc_flag[22],$calc_des[22],$etc[22],$uid[22],$yy_t);

		$this->movePage("salary","registDeclarationItem");
	}

	public function declarationItmeUpdate($val1,$val2,$val3,$val4,$val5,$val6,$val7,$val8,$val9,$val10,$val11,$val12,$yy_t){
			$data = array(
					"table"				=> "erp_declaration_itme",
					"where"				=> " yy_t='".$yy_t."' and uid=".$val12,
					"d_des"				=> $val1,
					"d_sort"			=> $val2,
					"aci_cd"			=> $val3,
					"aci_nm"			=> $val4,
					"cust"				=> $val5,
					"cust_name"			=> $val6,
					"calc1"				=> $val7,
					"calc2"				=> $val8,
					"calc_flag"			=> $val9,
					"calc_des"			=> $val10,
					"etc"				=> $val11,
					"yy_t"				=> $yy_t,
				);
			$salary = new Salary;
			$salary->declarationItmeUpdate($data);
	}


	public function registSalaryItmeUpdateOther() {

		$hidRow		= $_POST['hidRow'];
		$yy_t		= $_POST['yy_t'];
		$regdate			= $now;
		//echo $yy_t;
		//exit;

		foreach($_POST as $key => $value) //POST용 
		{ 
			//$$key = $value; //가변변수는 값이 없는 key 안보임
		    //if(!is_array($$key))  echo $key." --> ".$value."<br>";
			/*
			if(!is_array($$key))  echo $key." --> ".$value."<br>"; 
			else 
			{ 
			  for($a=0; $a < sizeof($$key); $a++) 
			  echo $key."[".$a."] --> ".$value[$a]."<br>"; 
			  } 
			  */
			
			//echo $key." --> ".$value."<br>";
			$keycount1 = substr($key , strlen($key)-2, 2);
			$keycount2 = substr($key , strlen($key)-3, 3);
			//$key_arr =  explode('_' , $key);
	
			if ($keycount1 =="_1"){
				$val1[] = $_POST[$key];
			}else if ($keycount1 =="_2"){
				$val2[] = $_POST[$key];
			}else if ($keycount1 =="_3"){
				$val3[] = $_POST[$key];
			}else if ($keycount1 =="_4"){
				$val4[] = $_POST[$key];
			}else if ($keycount1 =="_5"){
				$val5[] = $_POST[$key];
			}else if ($keycount1 =="_6"){
				$val6[] = $_POST[$key];
			}else if ($keycount1 =="_7"){
				$val7[] = $_POST[$key];
			}else if ($keycount1 =="_8"){
				$val8[] = $_POST[$key];
			}else if ($keycount1 =="_9"){
				$val9[] = $_POST[$key];
			}else if ($keycount2 =="_10"){
				$val10[] = $_POST[$key];
			}else if ($keycount2 =="_11"){
				$val11[] = $_POST[$key];
			}else if ($keycount2 =="_12"){
				$val12[] = $_POST[$key];
			}else if ($keycount2 =="_13"){
				$val13[] = $_POST[$key];
			}else if ($keycount2 =="_14"){
				$val14[] = $_POST[$key];
			}else if ($keycount2 =="_15"){
				$val15[] = $_POST[$key];
			}else if ($keycount2 =="_16"){
				$val16[] = $_POST[$key];
			}else if ($keycount2 =="_17"){
				$val17[] = $_POST[$key];
			}else if ($keycount2 =="_18"){
				$val18[] = $_POST[$key];
			}else if ($keycount2 =="_19"){
				$val19[] = $_POST[$key];
			}else if ($keycount2 =="_20"){
				$val20[] = $_POST[$key];
			}else if ($keycount2 =="_21"){
				$val21[] = $_POST[$key];
			}else if ($keycount2 =="_22"){
				$val22[] = $_POST[$key];
			}else if ($keycount2 =="_23"){
				$val23[] = $_POST[$key];
			}else if ($keycount2 =="_24"){
				$val24[] = $_POST[$key];
			}else if ($keycount2 =="_25"){
				$val25[] = $_POST[$key];
			}else if ($keycount2 =="_26"){
				$val26[] = $_POST[$key];
			}else if ($keycount2 =="_27"){
				$val27[] = $_POST[$key];
			}else if ($keycount2 =="_28"){
				$val28[] = $_POST[$key];
			}else if ($keycount2 =="_29"){
				$val29[] = $_POST[$key];
			}else if ($keycount2 =="_30"){
				$val30[] = $_POST[$key];
			}
			
		} 
$this->salaryItmeUpdate($val1[0],$val1[1],$val1[2],$val1[3],$val1[4],$val1[5],$val1[6],$val1[7],$val1[8],$val1[9],$val1[10],$val1[11],$val1[12],$val1[13],$val1[14],$val1[15],$yy_t,$val1[16]);
$this->salaryItmeUpdate($val2[0],$val2[1],$val2[2],$val2[3],$val2[4],$val2[5],$val2[6],$val2[7],$val2[8],$val2[9],$val2[10],$val2[11],$val2[12],$val2[13],$val2[14],$val1[15],$yy_t,$val2[16]);
$this->salaryItmeUpdate($val3[0],$val3[1],$val3[2],$val3[3],$val3[4],$val3[5],$val3[6],$val3[7],$val3[8],$val3[9],$val3[10],$val3[11],$val3[12],$val3[13],$val3[14],$val1[15],$yy_t,$val3[16]);
$this->salaryItmeUpdate($val4[0],$val4[1],$val4[2],$val4[3],$val4[4],$val4[5],$val4[6],$val4[7],$val4[8],$val4[9],$val4[10],$val4[11],$val4[12],$val4[13],$val4[14],$val1[15],$yy_t,$val4[16]);
$this->salaryItmeUpdate($val5[0],$val5[1],$val5[2],$val5[3],$val5[4],$val5[5],$val5[6],$val5[7],$val5[8],$val5[9],$val5[10],$val5[11],$val5[12],$val5[13],$val5[14],$val1[15],$yy_t,$val5[16]);
$this->salaryItmeUpdate($val6[0],$val6[1],$val6[2],$val6[3],$val6[4],$val6[5],$val6[6],$val6[7],$val6[8],$val6[9],$val6[10],$val6[11],$val6[12],$val6[13],$val6[14],$val1[15],$yy_t,$val6[16]);
$this->salaryItmeUpdate($val7[0],$val7[1],$val7[2],$val7[3],$val7[4],$val7[5],$val7[6],$val7[7],$val7[8],$val7[9],$val7[10],$val7[11],$val7[12],$val7[13],$val7[14],$val1[15],$yy_t,$val7[16]);
$this->salaryItmeUpdate($val8[0],$val8[1],$val8[2],$val8[3],$val8[4],$val8[5],$val8[6],$val8[7],$val8[8],$val8[9],$val8[10],$val8[11],$val8[12],$val8[13],$val8[14],$val1[15],$yy_t,$val8[16]);
$this->salaryItmeUpdate($val9[0],$val9[1],$val9[2],$val9[3],$val9[4],$val9[5],$val9[6],$val9[7],$val9[8],$val9[9],$val9[10],$val9[11],$val9[12],$val9[13],$val9[14],$val1[15],$yy_t,$val9[16]);
$this->salaryItmeUpdate($val10[0],$val10[1],$val10[2],$val10[3],$val10[4],$val10[5],$val10[6],$val10[7],$val10[8],$val10[9],$val10[10],$val10[11],$val10[12],$val10[13],$val10[14],$val1[15],$yy_t,$val10[16]);
$this->salaryItmeUpdate($val11[0],$val11[1],$val11[2],$val11[3],$val11[4],$val11[5],$val11[6],$val11[7],$val11[8],$val11[9],$val11[10],$val11[11],$val11[12],$val11[13],$val11[14],$val1[15],$yy_t,$val11[16]);
$this->salaryItmeUpdate($val12[0],$val12[1],$val12[2],$val12[3],$val12[4],$val12[5],$val12[6],$val12[7],$val12[8],$val12[9],$val12[10],$val12[11],$val12[12],$val12[13],$val12[14],$val1[15],$yy_t,$val12[16]);
$this->salaryItmeUpdate($val13[0],$val13[1],$val13[2],$val13[3],$val13[4],$val13[5],$val13[6],$val13[7],$val13[8],$val13[9],$val13[10],$val13[11],$val13[12],$val13[13],$val13[14],$val1[15],$yy_t,$val13[16]);
$this->salaryItmeUpdate($val14[0],$val14[1],$val14[2],$val14[3],$val14[4],$val14[5],$val14[6],$val14[7],$val14[8],$val14[9],$val14[10],$val14[11],$val14[12],$val14[13],$val14[14],$val1[15],$yy_t,$val14[16]);
$this->salaryItmeUpdate($val15[0],$val15[1],$val15[2],$val15[3],$val15[4],$val15[5],$val15[6],$val15[7],$val15[8],$val15[9],$val15[10],$val15[11],$val15[12],$val15[13],$val15[14],$val1[15],$yy_t,$val15[16]);
$this->salaryItmeUpdate($val16[0],$val16[1],$val16[2],$val16[3],$val16[4],$val16[5],$val16[6],$val16[7],$val16[8],$val16[9],$val16[10],$val16[11],$val16[12],$val16[13],$val16[14],$val1[15],$yy_t,$val16[16]);
$this->salaryItmeUpdate($val17[0],$val17[1],$val17[2],$val17[3],$val17[4],$val17[5],$val17[6],$val17[7],$val17[8],$val17[9],$val17[10],$val17[11],$val17[12],$val17[13],$val17[14],$val1[15],$yy_t,$val17[16]);
$this->salaryItmeUpdate($val18[0],$val18[1],$val18[2],$val18[3],$val18[4],$val18[5],$val18[6],$val18[7],$val18[8],$val18[9],$val18[10],$val18[11],$val18[12],$val18[13],$val18[14],$val1[15],$yy_t,$val18[16]);
$this->salaryItmeUpdate($val19[0],$val19[1],$val19[2],$val19[3],$val19[4],$val19[5],$val19[6],$val19[7],$val19[8],$val19[9],$val19[10],$val19[11],$val19[12],$val19[13],$val19[14],$val1[15],$yy_t,$val19[16]);
$this->salaryItmeUpdate($val20[0],$val20[1],$val20[2],$val20[3],$val20[4],$val20[5],$val20[6],$val20[7],$val20[8],$val20[9],$val20[10],$val20[11],$val20[12],$val20[13],$val20[14],$val1[15],$yy_t,$val20[16]);
$this->salaryItmeUpdate($val21[0],$val21[1],$val21[2],$val21[3],$val21[4],$val21[5],$val21[6],$val21[7],$val21[8],$val21[9],$val21[10],$val21[11],$val21[12],$val21[13],$val21[14],$val1[15],$yy_t,$val21[16]);
$this->salaryItmeUpdate($val22[0],$val22[1],$val22[2],$val22[3],$val22[4],$val22[5],$val22[6],$val22[7],$val22[8],$val22[9],$val22[10],$val22[11],$val22[12],$val22[13],$val22[14],$val1[15],$yy_t,$val22[16]);
$this->salaryItmeUpdate($val23[0],$val23[1],$val23[2],$val23[3],$val23[4],$val23[5],$val23[6],$val23[7],$val23[8],$val23[9],$val23[10],$val23[11],$val23[12],$val23[13],$val23[14],$val1[15],$yy_t,$val23[16]);
$this->salaryItmeUpdate($val24[0],$val24[1],$val24[2],$val24[3],$val24[4],$val24[5],$val24[6],$val24[7],$val24[8],$val24[9],$val24[10],$val24[11],$val24[12],$val24[13],$val24[14],$val1[15],$yy_t,$val24[16]);
$this->salaryItmeUpdate($val25[0],$val25[1],$val25[2],$val25[3],$val25[4],$val25[5],$val25[6],$val25[7],$val25[8],$val25[9],$val25[10],$val25[11],$val25[12],$val25[13],$val25[14],$val1[15],$yy_t,$val25[16]);
$this->salaryItmeUpdate($val26[0],$val26[1],$val26[2],$val26[3],$val26[4],$val26[5],$val26[6],$val26[7],$val26[8],$val26[9],$val26[10],$val26[11],$val26[12],$val26[13],$val26[14],$val1[15],$yy_t,$val26[16]);
$this->salaryItmeUpdate($val27[0],$val27[1],$val27[2],$val27[3],$val27[4],$val27[5],$val27[6],$val27[7],$val27[8],$val27[9],$val27[10],$val27[11],$val27[12],$val27[13],$val27[14],$val1[15],$yy_t,$val27[16]);
$this->salaryItmeUpdate($val28[0],$val28[1],$val28[2],$val28[3],$val28[4],$val28[5],$val28[6],$val28[7],$val28[8],$val28[9],$val28[10],$val28[11],$val28[12],$val28[13],$val28[14],$val1[15],$yy_t,$val28[16]);
$this->salaryItmeUpdate($val29[0],$val29[1],$val29[2],$val29[3],$val29[4],$val29[5],$val29[6],$val29[7],$val29[8],$val29[9],$val29[10],$val29[11],$val29[12],$val29[13],$val29[14],$val1[15],$yy_t,$val29[16]);
$this->salaryItmeUpdate($val30[0],$val30[1],$val30[2],$val30[3],$val30[4],$val30[5],$val30[6],$val30[7],$val30[8],$val30[9],$val30[10],$val30[11],$val30[12],$val30[13],$val30[14],$val1[15],$yy_t,$val30[16]);

		$this->movePage("salary","registSalaryItme");
	}


	public function listPrintPaySlip() {
		require_once ("views/salary/pay_slip_print.php");
	}
	
	public function paySlipHistoryTable() {
		//$t = Salary::getPrintPaySlip($_GET['uid']);
		require_once ("views/salary/pay_slip_history_table.php");
	}
	
/******************************************************************************************************
:: 일용직 관련 함수들
******************************************************************************************************/
	public function inputPageDailyWorker() {
		require_once ("views/salary/createDailyWorker.php");
	}

	public function listPageDailyWorker() {
		require_once ("views/salary/listDailyWorker.php");
	}

	public function modifyPageDailyWorker() {
		$t = Salary::getDailyWorker($_GET['uid']);
		require_once ("views/salary/modifyDailyWorker.php");
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

		$salary = new Salary;
		$result = $salary->registDailyWorker($data);
		if($result) $this->movePage("Salary","listPageDailyWorker");
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

		$salary = new Salary;
		$result = $salary->updateDailyWorker($data);
		if($result) $this->movePage("Salary","listPageDailyWorker");
	}
}
?>