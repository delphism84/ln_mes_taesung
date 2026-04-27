<?
session_start();
// 영업관리
class PurchaseController {
	public function __construct() {
		extract($_POST);
		extract($_GET);
	}

	// 숫자 0 반환
	public function convertZero($val) {
		if($val == null) return 0;
		else return $val;
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

	public function pageCloseOpenerLocation($dialogID, $funtion) {
		//echo $dialogID;
		echo "<script>";
		echo "window.parent.closeModal('".$dialogID."');";
		echo "$(opener.location).attr(\"href\", \"javascript:".$funtion.";\")";
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
		return $this->convertZero($number);
	}
	
	public function listPagePurchase() {
		require_once ("views/purchase/listPurchase.php");
	}

	public function listPagePurchaseDemand() {
		require_once ("views/purchase/listPurchaseDemand.php");
	}

	public function listPagePurchaseItem() {
		require_once ("views/purchase/listPurchaseItem.php");
	}

	// 구매요청서 입력 페이지
	public function inputPagePurchaseDemand(){
		require_once ("views/purchase/createPurchaseDemand.php");
	}
	
	// 구매요청서 등록
	public function registPurchaseDemand() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');

		$sql = "select max(purchase_cha) as cnt from erp_purchase_demand where purchase_dt='".$_POST['purchase_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$purchase_cha = "1";
		}else{
			$purchase_cha = $t0->cnt+1;
		}

		$purchase_cd  = $_POST['purchase_dt']."-".$purchase_cha;

		$data = array(
			"table" => "erp_purchase_demand",
			"purchase_cd" => $purchase_cd,
			"purchase_dt" => $_POST['purchase_dt'],
			"purchase_cha" => $this->convertZero($purchase_cha),
			"purchase_expect_dt" => $_POST['purchase_expect_dt'],
			"workplan_uid" => $this->convertZero($_POST['workplan_uid']),
			"workplan_cd" => $_POST['workplan_cd'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"tax_type" => $_POST['tax_type'],
			"order_gb" => 1,
			"memo" => $_POST['memo'],
			"attach" => $fileAttach,
			"cntTotal" => $this->replaceComma($_POST['cntTotal']),
			"unitPriceTotal" => $this->replaceComma($_POST['unitPriceTotal']),
			"supplyPriceTotal" => $this->replaceComma($_POST['supplyPriceTotal']),
			"taxTotal" => $this->replaceComma($_POST['taxTotal']),
			"priceTotal" => $this->replaceComma($_POST['priceTotal']),
			"used" => "n",
			"state" => "0",   //구매요청
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);

		$purchase = new Purchase;
		$fid = $purchase->registPurchaseDemand($data);
		
		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard1 = $_POST['standard1'];
		$account_cd = $_POST['account_cd'];
		$account_nm = $_POST['account_nm'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$remain_cnt = $_POST['remain_cnt'];
		$shortage_cnt = $_POST['shortage_cnt'];
		$unit_price = $_POST['unit_price'];
		$supply_price = $_POST['supply_price'];
		$tax = $_POST['tax'];
		$total_price = $_POST['total_price'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"		=> "erp_purchase_demand_item",
					"fid"			=> $fid,
					"purchase_cd"	=> $purchase_cd,
					"item_cd"		=> $val,
					"item_nm"		=> $item_nm[$key],
					"standard1"		=> $standard1[$key],
					"account_cd"	=> $account_cd[$key],
					"account_nm"	=> $account_nm[$key],
					"unit"			=> $unit[$key],
					"cnt"			=> $this->replaceComma($cnt[$key]),
					"remain_cnt"	=> $this->replaceComma($remain_cnt[$key]),
					"shortage_cnt"	=> $this->replaceComma($shortage_cnt[$key]),
					"unit_price"		=> $this->replaceComma($unit_price[$key]),
					"supply_price"	=> $this->replaceComma($supply_price[$key]),
					"tax"			=> $this->replaceComma($tax[$key]),
					"total_price"	=> $this->replaceComma($total_price[$key])
				);
				$purchase->insert($data);
			}
		}

		//$this->movePage("purchase","listPagePurchaseDemand");
		$this->movePageClose($_POST['dialogID']);
	}
	
	// 구매요청서 수정
	public function updatePurchaseDemand() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
		$data = array(
			"table"			=> "erp_purchase_demand",
			"where"			=> "uid=".$_POST['uid'],
			"purchase_expect_dt"	=> $_POST['purchase_expect_dt'],
			"workplan_uid"		=> $_POST['workplan_uid'],
			"workplan_cd"		=> $_POST['workplan_cd'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"		=> $_POST['project_nm'],
			"warehouse_cd"		=> $_POST['warehouse_cd'],
			"warehouse_nm"		=> $_POST['warehouse_nm'],
			"tax_type"			=> $_POST['tax_type'],
			"memo"			=> $_POST['memo'],
			"attach"			=> $fileAttach,
			"cntTotal"			=> $this->replaceComma($_POST['cntTotal']),
			"unitPriceTotal"		=> $this->replaceComma($_POST['unitPriceTotal']),
			"supplyPriceTotal"		=> $this->replaceComma($_POST['supplyPriceTotal']),
			"taxTotal"			=> $this->replaceComma($_POST['taxTotal']),
			"priceTotal"			=> $this->replaceComma($_POST['priceTotal']),
			"used"			=> "n",
			"state"			=> "구매요청",
			"emp_id"			=> $_SESSION['login_id'],
			"create_dt"			=> $now
		);
		
		$purchase = new Purchase;
		$purchase->updatePurchaseDemand($data);
		$fid = $_POST['uid'];

		// 아이템 삭제
		$sql = "delete from erp_purchase_demand_item where fid=".$fid;
		mysql_query($sql);
		
		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard1 = $_POST['standard1'];
		$material = $_POST['material'];
		$account_cd = $_POST['account_cd'];
		$account_nm = $_POST['account_nm'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$remain_cnt = $_POST['remain_cnt'];
		$shortage_cnt = $_POST['shortage_cnt'];
		$unit_price = $_POST['unit_price'];
		$supply_price = $_POST['supply_price'];
		$tax = $_POST['tax'];
		$total_price = $_POST['total_price'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_purchase_demand_item",
					"fid" => $this->convertZero($fid),
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard1" => $standard1[$key],
					"material" => $material[$key],
					"account_cd" => $account_cd[$key],
					"account_nm" => $account_nm[$key],
					"unit" => $unit[$key],
					"cnt" => $this->replaceComma($cnt[$key]),
					"remain_cnt" => $this->replaceComma($remain_cnt[$key]),
					"shortage_cnt" => $this->replaceComma($shortage_cnt[$key]),
					"unit_price" => $this->replaceComma($unit_price[$key]),
					"supply_price" => $this->replaceComma($supply_price[$key]),
					"tax" => $this->replaceComma($tax[$key]),
					"total_price" => $this->replaceComma($total_price[$key]),
					"regdate" => $now
				);
				$purchase->insert($data);
			}
		}

		//$this->movePage("purchase","listPagePurchaseDemand");
		$this->movePageClose($_POST['dialogID']);
	}

	// 구매요청서 수정 페이지
	public function modifyPagePurchaseDemand(){
		$t = Purchase::getPurchaseDemand($_GET['uid']);
		require_once ("views/purchase/modifyPurchaseDemand.php");
	}

	// 구매요청서 수정 페이지2
	public function viewPagePurchaseDemand(){
		$t = Purchase::viewPurchaseDemand($_GET['purchase_cd']);
		require_once ("views/purchase/viewPurchaseDemand.php");
	}

	public function inputPagePurchase() {
		require_once ("views/purchase/createPurchase.php");
	}

	// 발주계획서 리스트 페이지
	public function listPagePurchasePlan(){
		require_once ("views/purchase/listPurchasePlan.php");
	}

	// 발주계획서 등록 페이지
	public function inputPagePurchasePlan() {
		require_once ("views/purchase/createPurchasePlan.php");
	}

	// 발주계획서 수정 페이지
	public function modifyPagePurchasePlan() {
		require_once ("views/purchase/modifyPurchasePlan.php");
	}
	
	// 바코드 입고 페이지
	public function listPageBarcodePurchaseItem() {
		require_once ("views/purchase/listBarcodePurchaseItem.php");
	}

	// 바코드 입고 페이지
	public function registPagePurchaseItemBarcodeIn() {
		require_once ("views/purchase/createPurchaseItemBarcodeIn.php");
	}

	// 미지급금 리스트
	public function listPageAccountPavable(){
		require_once ("views/purchase/listAccountPavable.php");
	}

	// 발주서 리스트 NEW
	public function listPurchaseOrderItem(){
		require_once ("views/purchase/listPurchaseOrderItems.php");
	}

	// 발주서 리스트 NEW
	public function listPurchaseOrder(){
		require_once ("views/purchase/listPurchaseOrder.php");
	}

	// 발주서 등록 NEW
	public function registPurchaseOrderItem(){
		require_once ("views/purchase/registPurchaseOrderItem.php");
	}

	// 발주서 수정 NEW
	public function modifyPurchaseOrderItem(){
		$t = Purchase::getPurchaseOrder($_GET['uid']);
		require_once ("views/purchase/modifyPurchaseOrderItem.php");
	}
	
		// 발주서 등록 NEW
	public function registPagePurchaseOrderPop(){
		require_once ("views/purchase/createPurchaseOrder_pop.php");
	}

	// 발주서 수정 NEW
	public function modifyPagePurchaseOrderPop(){
		$t = Purchase::getPurchaseOrder($_GET['uid']);
		require_once ("views/purchase/modifyPurchaseOrder_pop.php");
	}

	// 구매요청서 입력 페이지
	public function registPagePurchaseDemandPop(){
		require_once ("views/purchase/createPurchaseDemand_pop.php");
	}

	// 구매요청서 입력 페이지
	public function modifyPagePurchaseDemandPop(){
		$t = Purchase::viewPurchaseDemand($_GET['uid']);
		require_once ("views/purchase/modifyPurchaseDemand_pop.php");
	}

	// 구매입고 등록
	public function listWarehousingItem(){
		require_once ("views/purchase/listWarehousingItems.php");
	}

	// 구매입고 등록
	public function registWarehousingItem(){
		require_once ("views/purchase/registWarehousingItem.php");
	}
	
	// 구매입고 수정
	public function modifyWarehousingItem(){
		$t = Purchase::getWarehousing($_GET['uid']);
		require_once ("views/purchase/modifyWarehousingItem.php");
	}
	
	// 구매입고 등록
	public function registPageWarehousingPop(){
		require_once ("views/purchase/createWarehousing_pop.php");
	}
	
	// 구매입고 수정
	public function modifyPageWarehousingPop(){
		$t = Purchase::getWarehousing($_GET['uid']);
		require_once ("views/purchase/modifyWarehousing_pop.php");
	}
	
	public function viewPageWarehousingItem(){
		$t = Purchase::getWarehousing($_GET['uid']);
		require_once ("views/purchase/viewWarehousingItem.php");
	}

	// 발주서 등록
	public function inputPurchaseOrderItem() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');


		$sql = "select max(p_order_cha) as cnt from erp_purchase_order where p_order_dt='".$_POST['p_order_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$p_order_cha = "1";
		}else{
			$p_order_cha = $t0->cnt+1;
		}

		$p_order_cd  = $_POST['p_order_dt']."-".$p_order_cha;

		$data = array(
			"table" => "erp_purchase_order",
			"p_order_dt" => $_POST['p_order_dt'],
			"p_order_cha" => $p_order_cha,
			"p_order_cd" => $p_order_cd,
			"purchase_cd" => $_POST['purchase_cd'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"manager" => $_POST['manager'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"deadline_dt" => $_POST['deadline_dt'],
			"tax_type" => $_POST['tax_type'],
			"order_gb" => $_POST['order_gb'],
			"memo" => $_POST['memo'],
			"state" => $_POST['state'],
			"cntTotal" => $this->replaceComma($_POST['cntTotal']),
			"unitPriceTotal" => $this->replaceComma($_POST['unitPriceTotal']),
			"supplyPriceTotal" => $this->replaceComma($_POST['supplyPriceTotal']),
			"taxTotal" => $this->replaceComma($_POST['taxTotal']),
			"priceTotal" => $this->replaceComma($_POST['priceTotal']),
			"attach" => $fileAttach,
			"create_dt" => $now
		);

		$purchase = new Purchase;
		$fid = $purchase->inputPurchaseOrderItem($data);
		
		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard1 = $_POST['standard1'];
		$standard2 = $_POST['standard2'];
		$standard3 = $_POST['standard3'];
		$material = $_POST['material'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$unit_price = $_POST['unit_price'];
		$supply_price = $_POST['supply_price'];
		$tax = $_POST['tax'];
		$total_price = $_POST['total_price'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_purchase_order_item",
					"fid" => $fid,
					"p_order_cd" => $p_order_cd,
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard1" => $standard1[$key],
					"standard2" => $standard2[$key],
					"standard3" => $standard3[$key],
					"material"	 => $material[$key],
					"unit" => $unit[$key],
					"cnt" => $this->replaceComma($cnt[$key]),
					"unit_price" => $this->replaceComma($unit_price[$key]),
					"supply_price" => $this->replaceComma($supply_price[$key]),
					"tax" => $this->replaceComma($tax[$key]),
					"total_price" => $this->replaceComma($total_price[$key])
				);
				$purchase->insert($data);
			}
		}
		//exit;
		$this->movePageClose($_POST['dialogID']);
		//$this->movePage("purchase","listPurchaseOrderItem");
	}
	
	// 발주서 수정
	public function updatePurchaseOrderItem() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
		
		$sql = "select max(p_order_cha) as cnt from erp_p_order where p_order_dt='".$_POST['p_order_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));

		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$p_order_cha = "1";
		}else{
			$p_order_cha = $t0->cnt+1;
		}
	
		$p_order_cd  = $_POST['p_order_dt']."-".$p_order_cha;

		$data = array(
			"table" => "erp_purchase_order",
			"where" => "uid=".$_POST['uid'],
			"p_order_cd" => $p_order_cd,
			"p_order_dt" => $_POST['p_order_dt'],
			"p_order_cha" => $p_order_cha,
			"purchase_cd" => $_POST['purchase_cd'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"manager" => $_POST['manager'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"deadline_dt" => $_POST['deadline_dt'],
			"tax_type" => $_POST['tax_type'],
			"order_gb" => $_POST['order_gb'],
			"memo" => $_POST['memo'],
			"state" => $_POST['state'],
			"cntTotal" => $this->replaceComma($_POST['cntTotal']),
			"unitPriceTotal" => $this->replaceComma($_POST['unitPriceTotal']),
			"supplyPriceTotal" => $this->replaceComma($_POST['supplyPriceTotal']),
			"taxTotal" => $this->replaceComma($_POST['taxTotal']),
			"priceTotal" => $this->replaceComma($_POST['priceTotal']),
			"attach" => $fileAttach,
			"create_dt" => $now
		);
		
		$purchase = new Purchase;
		$purchase->updatePurchaseOrderItem($data);
		$fid = $_POST['uid'];

		// 아이템 삭제
		$sql = "delete from erp_purchase_order_item where fid=".$fid;
		mysql_query($sql);
		
		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard1 = $_POST['standard1'];
		$standard2 = $_POST['standard2'];
		$standard3 = $_POST['standard3'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$unit_price = $_POST['unit_price'];
		$supply_price = $_POST['supply_price'];
		$tax = $_POST['tax'];
		$total_price = $_POST['total_price'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_purchase_order_item",
					"fid" => $fid,
					"p_order_cd" => $p_order_cd,
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard1" => $standard1[$key],
					"standard2" => $standard2[$key],
					"standard3" => $standard3[$key],
					"material"	 => $material[$key],
					"unit" => $unit[$key],
					"cnt" => $this->replaceComma($cnt[$key]),
					"unit_price" => $this->replaceComma($unit_price[$key]),
					"supply_price" => $this->replaceComma($supply_price[$key]),
					"tax" => $this->replaceComma($tax[$key]),
					"total_price" => $this->replaceComma($total_price[$key])
				);
				$purchase->insert($data);
			}
		}
		$this->movePageClose($_POST['dialogID']);
		//$this->movePage("purchase","listPurchaseOrderItem");
	}


	// 구매입고 등록
	public function inputWarehousingItem() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
		
		//창고 warehousing_cha 넣어주기//
		$sql = "select max(warehousing_cha) as cnt from erp_warehousing where warehousing_dt='".$_POST['warehousing_dt']."'";
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$warehousing_cha = "1";
		}else{
			$warehousing_cha = $t0->cnt+1;
		}

		$warehousing_cd  = $_POST['warehousing_dt']."-".$warehousing_cha;
		
		/*
		if ($_POST['state'] != ""){
			$state = $_POST['state'];	
		}else{
			$state = "complete";	 //stay(대기중) ing(진행중) complete (입고완료)		
		}
		*/
		
		$data = array(
			"table" => "erp_warehousing",
			"warehousing_dt" => $_POST['warehousing_dt'],
			"warehousing_cha" => $this->convertZero($warehousing_cha),
			"warehousing_cd" => $warehousing_cd,
			"p_order_uid" => $_POST['p_order_uid'],
			"p_order_cd" => $_POST['p_order_cd'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"manager" => $_POST['manager'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"deadline_dt" => $_POST['deadline_dt'],
			"tax_type" => $_POST['tax_type'],
			"currency" => $_POST['currency'],
			"memo" => $_POST['memo'],
			"remark" => $_POST['remark'],
			"state" => $_POST['state'],
			"attach" => $fileAttach,
			"cntTotal" => $this->replaceComma($_POST['cntTotal']),
			"unitPriceTotal" => $this->replaceComma($_POST['unitPriceTotal']),
			"supplyPriceTotal" => $this->replaceComma($_POST['supplyPriceTotal']),
			"taxTotal" => $this->replaceComma($_POST['taxTotal']),
			"priceTotal" => $this->replaceComma($_POST['priceTotal']),
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);

		$purchase = new Purchase;
		$fid = $purchase->inputWarehousingItem($data);
		
		if ($fid >=0){
			
			$item_cd = $_POST['item_cd'];
			$item_nm = $_POST['item_nm'];
			$standard1 = $_POST['standard1'];
			$material= $_POST['material'];
			$unit = $_POST['unit'];
			$remain_cnt = $_POST['remain_cnt'];
			$shortage_cnt = $_POST['shortage_cnt'];
			$cnt = $_POST['cnt'];
			$unit_price = $_POST['unit_price'];
			$supply_price = $_POST['supply_price'];
			$tax = $_POST['tax'];
			$total_price = $_POST['total_price'];
			$lot_no_cd = str_replace("-","_",$_POST['lot_no_cd']);
			$lot_no_nm = str_replace("-","_",$_POST['lot_no_nm']);
			$inspection_cd = $_POST['inspection_cd'];

			foreach($item_cd as $key => $val) {
				if($val != "") {
					
					if($_POST['state']=="2"){
						$warehousing_cnt = $cnt[$key];
						$rest_cnt = "0";
					}else{
						$warehousing_cnt = "0";
						$rest_cnt = $cnt[$key];
					}

					$data = array(
						"table" => "erp_warehousing_item",
						"fid" => $fid,
						"warehousing_cd" => $warehousing_cd,
						"item_cd" => $val,
						"item_nm" => $item_nm[$key],
						"standard1" => $standard1[$key],
						"material" => $material[$key],
						"unit" => $unit[$key],
						"remain_cnt" =>$this->replaceComma($remain_cnt[$key]),
						"shortage_cnt" => $this->replaceComma($shortage_cnt[$key]),
						"cnt" => $this->replaceComma($cnt[$key]),
						"unit_price" => $this->replaceComma($unit_price[$key]),
						"supply_price" => $this->replaceComma($supply_price[$key]),
						"warehousing_cnt" => $this->replaceComma($warehousing_cnt),
						"rest_cnt" => $this->replaceComma($rest_cnt),
						"tax" => $this->replaceComma($tax[$key]),
						"total_price" => $this->replaceComma($total_price[$key]),
						"lot_no_cd" =>  $lot_no_cd[$key],
						"lot_no_nm" =>  $lot_no_nm[$key],
						"inspection_cd" =>  $inspection_cd[$key],
						"regdate" => $now
					);
					$purchase->insert($data);

					//구매입고시 Lot_NO 테입이블 관리
					$data = array(
						"table" => "erp_warehousing_lot_no",
						"fid" => $fid,
						"warehousing_cd" => $warehousing_cd,
						"warehousing_dt" => $_POST['warehousing_dt'],
						"warehouse_cd" => $_POST['warehouse_cd'],
						"warehouse_nm" => $_POST['warehouse_nm'],
						"item_cd" => $val,
						"item_nm" => $item_nm[$key],
						"standard1" => $standard1[$key],
						"material" => $material[$key],
						"lot_no_cd" =>  $lot_no_cd[$key],
						"lot_no_nm" =>  $lot_no_nm[$key],
						"cnt" => $this-> replaceComma($cnt[$key]),
						"unit_price" => $this->replaceComma($unit_price[$key]),
						"supply_price" => $this->replaceComma($supply_price[$key]),
						"regdate" => $now
					);
					$purchase->insert($data);
					
					if($_POST['state']=="2"){ //수정되었을시 해당 재고 수량에 등록된 수량을 차감하는 부분은 추가 고려 20180510

						$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."' "; //창고별 재고현황 쿼리중 창고재고가 있는경우

						$result1 = mysql_query($sql);
						$result = mysql_fetch_object($result1);
						
							if(mysql_num_rows($result1) > 0) { // 등록된 창고 재고창고가 있다면
								
								$remain_cnt = $result->remain_cnt + $this->replaceComma($cnt[$key]);
								
								// 전체재고에 넣기
								$stockData = array (
								"table" => "erp_stock",
								"where" => "item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."'",
								"standard1" => $standard1[$key],
								"material" => $material[$key],
								"unit" => $unit[$key],
								"pur_cnt" => $this->replaceComma($cnt[$key]),
								"pur_unit_price" => $this->replaceComma($supply_price[$key]),
								"remain_cnt" => $remain_cnt,
								"warehouse_cd" => $_POST['warehouse_cd'],
								"warehouse_nm" => $_POST['warehouse_nm'],
								"in_date" => $_POST['warehousing_dt']
								);
								$purchase->update($stockData);
							}else{                        // 등록된 창고 재고창고가 없다면
								
								$remain_cnt = $this->replaceComma($cnt[$key]);

								$sql2 = "select * from erp_item where item_cd='".$val."' and standard1 ='".$standard1[$key]."'";
								$result2 = mysql_fetch_object(mysql_query($sql2));
								$item_uid = $result2->uid;
								
								// 전체재고에 넣기
								$stockData = array (
								"table" => "erp_stock",
								"fid" => $item_uid,
								"item_cd" => $val,
								"item_nm" => $item_nm[$key],
								"standard1" => $standard1[$key],
								"material" => $material[$key],
								"unit" => $unit[$key],
								"pur_cnt" => $this->replaceComma($cnt[$key]),
								"pur_unit_price" => $this->replaceComma($supply_price[$key]),
								"remain_cnt" => $remain_cnt,
								"warehouse_cd" => $_POST['warehouse_cd'],
								"warehouse_nm" => $_POST['warehouse_nm'],
								"in_date" => $_POST['warehousing_dt']
								);
								$purchase->insert($stockData);
							}
							// 전체 inout에 넣기
							$inoutData = array (
							"table" => "erp_stock_inout",
							"item_cd" => $val,
							"warehouse_cd" => $_POST['warehouse_cd'],
							"warehousing_cd" => $warehousing_cd,
							"standard1" => $standard1[$key],
							"material" => $material[$key],
							"unit" => $unit[$key],
							"in_cnt" => $this->replaceComma($cnt[$key]),
							"pur_unit_price" => $this->replaceComma($supply_price[$key]),
							"total_price" => $this->replaceComma($total_price[$key]),
							"remain_cnt" => $this->replaceComma($cnt[$key]),
							"in_dt" => $_POST['warehousing_dt'],
							"lot_no" => $lot_no_cd[$key],
							"used"	=>'n',
							"account" => "구매입고",
							"remark" => "구매입고",
							"create_dt" => $now
							);
							$purchase->insert($inoutData);
					}
				}
			}
			
			//발주서 종결처리
			if ($_POST['p_order_uid'] != "" && $_POST['purchaseOrderState']=="Y"){
				$query = "update erp_purchase_order set state='7' where uid=".$_POST['p_order_uid'];
				mysql_query($query);
			}
		
		}
		//exit;
		//$this->movePage("purchase","listWarehousingItem");
		$this->movePageClose($_POST['dialogID']);
	}
	
	// 구매입고 수정
	public function updateWarehousingItem() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
		
		/*
		if ($_POST['state'] != ""){
			$state=$_POST['state'];	
		}else{
			$state = "ing";	 //stay(대기중) ing(진행중) complete (입고완료)		
		}
		*/
		$data = array(
			"table" => "erp_warehousing",
			"where" => "uid=".$_POST['uid'],
			//"warehousing_cd" => $_POST['warehousing_cd'],
			"p_order_uid" => $_POST['p_order_uid'],
			"p_order_cd" => $_POST['p_order_cd'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"manager" => $_POST['manager'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"deadline_dt" => $_POST['deadline_dt'],
			"tax_type" => $_POST['tax_type'],
			"currency" => $_POST['currency'],
			"memo" => $_POST['memo'],
			"remark" => $_POST['remark'],
			"state" => $_POST['state'],
			"cntTotal" => $this->replaceComma($_POST['cntTotal']),
			"unitPriceTotal" => $this->replaceComma($_POST['unitPriceTotal']),
			"supplyPriceTotal" => $this->replaceComma($_POST['supplyPriceTotal']),
			"taxTotal" => $this->replaceComma($_POST['taxTotal']),
			"priceTotal" => $this->replaceComma($_POST['priceTotal']),
			"attach" => $fileAttach,
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);
		
		$purchase = new Purchase;
		$result=$purchase->update($data);
		$fid = $_POST['uid'];

		if ($result==1){ //정상
			// 아이템 삭제
			$sql = "delete from erp_warehousing_item where fid=".$fid;
			mysql_query($sql);

			$item_cd		= $_POST['item_cd'];
			$item_nm		= $_POST['item_nm'];
			$standard1		= $_POST['standard1'];
			$material		= $_POST['material'];
			$unit			= $_POST['unit'];
			$remain_cnt		= $_POST['remain_cnt'];
			$shortage_cnt	= $_POST['shortage_cnt'];
			$cnt			= $_POST['cnt'];
			$unit_price		= $_POST['unit_price'];
			$supply_price	= $_POST['supply_price'];
			$tax			= $_POST['tax'];
			$total_price	= $_POST['total_price'];
			$lot_no_cd		= $_POST['lot_no_cd'];
			$lot_no_nm		= $_POST['lot_no_nm'];
			$inspection_cd	= $_POST['inspection_cd'];

			foreach($item_cd as $key => $val) {
				if($val != "") {

					if($_POST['state']=="2"){
						$warehousing_cnt = $cnt[$key];
						$rest_cnt = "0";
					}else{
						$warehousing_cnt = "0";
						$rest_cnt = $cnt[$key];
					}

					$data = array(
						"table" => "erp_warehousing_item",
						"fid" => $fid,
						//"warehousing_cd" => $warehousing_cd,
						"item_cd" => $val,
						"item_nm" => $item_nm[$key],
						"standard1" => $standard1[$key],
						"material" => $material[$key],
						"unit" => $unit[$key],
						"remain_cnt" =>$this->replaceComma($remain_cnt[$key]),
						"shortage_cnt" => $this->replaceComma($shortage_cnt[$key]),
						"cnt"				=> $this-> replaceComma($cnt[$key]),
						"unit_price"		=> $this->replaceComma($unit_price[$key]),
						"supply_price"		=> $this->replaceComma($supply_price[$key]),
						"warehousing_cnt"	=> $this->replaceComma($warehousing_cnt),
						"rest_cnt"			=> $this->replaceComma($rest_cnt),
						"tax"				=> $this->replaceComma($tax[$key]),
						"total_price" => $this->replaceComma($total_price[$key]),
						"lot_no_cd" =>  $lot_no_cd[$key],
						"lot_no_nm" =>  $lot_no_nm[$key],
						"inspection_cd" =>  $inspection_cd[$key],
						"regdate" => $now
					);
					$purchase->insert($data);

					//구매입고시 Lot_NO 테입이블 관리
					$data = array(
						"table" => "erp_warehousing_lot_no",
						"fid" => $fid,
						"warehousing_cd" => $warehousing_cd,
						"warehousing_dt" => $_POST['warehousing_dt'],
						"warehouse_cd" => $_POST['warehouse_cd'],
						"warehouse_nm" => $_POST['warehouse_nm'],
						"item_cd" => $val,
						"item_nm" => $item_nm[$key],
						"standard1" => $standard1[$key],
						"material" => $material[$key],
						"lot_no_cd" =>  $lot_no_cd[$key],
						"lot_no_nm" =>  $lot_no_nm[$key],
						"cnt" => $this-> replaceComma($cnt[$key]),
						"unit_price" => $this->replaceComma($unit_price[$key]),
						"supply_price" => $this->replaceComma($supply_price[$key]),
						"regdate" => $now
					);
					$purchase->insert($data);

					if($_POST['state']=="2"){ 
						
						$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."' "; //창고별 재고현황 쿼리중 창고재고가 있는경우

						$result1 = mysql_query($sql);
						$result = mysql_fetch_object($result1);
						
							if(mysql_num_rows($result1) > 0) { // 등록된 창고 재고창고가 있다면
								
								$remain_cnt = $result->remain_cnt + $this->replaceComma($cnt[$key]);
								
								// 전체재고에 넣기
								$stockData = array (
								"table" => "erp_stock",
								"where" => "item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."'",
								"standard1" => $standard1[$key],
								"material" => $material[$key],
								"unit" => $unit[$key],
								"pur_cnt" => $this->replaceComma($cnt[$key]),
								"pur_unit_price" => $this->replaceComma($supply_price[$key]),
								"remain_cnt" => $remain_cnt,
								"warehouse_cd" => $_POST['warehouse_cd'],
								"warehouse_nm" => $_POST['warehouse_nm'],
								//"lot_no_cd" => $lot_no_cd[$key],
								"in_date" => $now
								);
								$purchase->update($stockData);
							}else{                        // 등록된 창고 재고창고가 없다면
								
								$remain_cnt = $this->replaceComma($cnt[$key]);

								$sql2 = "select * from erp_item where item_cd='".$val."' and standard1 ='".$standard1[$key]."'";
								$result2 = mysql_fetch_object(mysql_query($sql2));
								$item_uid = $result2->uid;
								
								// 전체재고에 넣기
								$stockData = array (
								"table" => "erp_stock",
								"fid" => $item_uid,
								"item_cd" => $val,
								"item_nm" => $item_nm[$key],
								"standard1" => $standard1[$key],
								"material" => $material[$key],
								"unit" => $unit[$key],
								"pur_cnt" => $this->replaceComma($cnt[$key]),
								"pur_unit_price" => $this->replaceComma($supply_price[$key]),
								"remain_cnt" => $remain_cnt,
								"warehouse_cd" => $_POST['warehouse_cd'],
								"warehouse_nm" => $_POST['warehouse_nm'],
								//"lot_no_cd" => $lot_no_cd[$key],
								"in_date" => $now
								);
								$purchase->insert($stockData);
							}
							// 전체 inout에 넣기
							$inoutData = array (
							"table" => "erp_stock_inout",
							"item_cd" => $val,
							"warehouse_cd" => $_POST['warehouse_cd'],
							"warehousing_cd" => $warehousing_cd,
							"standard1" => $standard1[$key],
							"material" => $material[$key],
							"unit" => $unit[$key],
							"in_cnt" => $this->replaceComma($cnt[$key]),
							"pur_unit_price" => $this->replaceComma($supply_price[$key]),
							"total_price" => $this->replaceComma($total_price[$key]),
							"remain_cnt" => $this->replaceComma($cnt[$key]),
							"lot_no" => $lot_no_cd[$key],
							"account" => "구매입고",
							"remark" => "구매입고",
							"create_dt" => $now
							);
							$purchase->insert($inoutData);
					}

					if($_POST['state']=="3"){
	
						$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."' ";
						$r_cnt = @mysql_fetch_object(mysql_query($sql));

						$remain_cnt = $r_cnt->remain_cnt - $this->replaceComma($cnt[$key]);

						// 전체재고에 넣기
						$stockData = array (
						"table" => "erp_stock",
						"where" => "item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."'",
						"pur_cnt" => $this->replaceComma($cnt[$key]),
						"material" => $material[$key],
						"pur_unit_price" => $this->replaceComma($supply_price[$key]),
						"remain_cnt" => $remain_cnt,
						//"warehouse_cd" => $_POST['warehouse_cd'],
						//"lot_no_cd" => $lot_no_cd[$key],
						"in_date" => $now
						);
						$purchase->update($stockData);
						

						// 전체 inout에 넣기
						$inoutData = array(
						"table"				=> "erp_stock_inout",
						"item_cd"			=> $val,
						"warehouse_cd"			=> $_POST['warehouse_cd'],
						"warehousing_cd"		=> $warehousing_cd,
						"standard1"			=> $standard1[$key],
						"material"			=> $material[$key],
						"unit"				=> $unit[$key],
						"out_cnt"			=> $this->replaceComma($cnt[$key]),
						"out_dt"			=> $now,
						"pur_unit_price"		=> $this->replaceComma($supply_price[$key]),
						"total_price"			=> $this->replaceComma($total_price[$key]),
						"remain_cnt"			=> "0",		//입고취소된건은 잔여수량을 표기하지 않음.
						"lot_no"			=> $lot_no_cd[$key],
						"used"				=>"y",
						"account"			=> "입고취소",
						"remark"			=> "입고취소",
						"create_dt"			=> $now
						);
						$purchase->insert($inoutData);

						//입고 처리한 건에 대해서 전부 소진으로 상태값 변경..
						$inoutData = array(
						"table"	=> "erp_stock_inout",
						"where" => "item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."' and lot_no='".$lot_no_cd[$key]."' and used='n' ",
						"remain_cnt" =>"0",
						"used"	=>"y"
						);
						$purchase->update($inoutData);

						//구매입고시 Lot_NO 테입이블 관리

						$sql33 = "delete from erp_warehousing_lot_no where fid=".$fid;	//로트제거.
						mysql_query($sql33);	

						//////////

						
					}



				}
			}

						//발주서 종결처리
			if ($_POST['purchaseOrderState']=="Y"){
				$query = "update erp_purchase_order set state='7' where uid=".$_POST['p_order_uid'];
				mysql_query($query);
			}

		}
		//exit;
		//$this->movePage("purchase","listWarehousingItem");
		$this->movePageClose($_POST['dialogID']);
	}

	

	public function inputWarehousingItemBarcodeIn() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');

		$sql = "select max(warehousing_cha) as cnt from erp_warehousing where warehousing_dt='".$_POST['warehousing_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$warehousing_cha = "1";
		}else{
			$warehousing_cha = $t0->cnt+1;
		}

		$warehousing_cd  = $_POST['warehousing_dt']."-".$warehousing_cha;
		
		/*
		if ($_POST['state'] != ""){
			$state = $_POST['state'];	
		}else{
			$state = "complete";	 //stay(대기중) ing(진행중) complete (입고완료)		
		}
		*/

		$data = array(
			"table" => "erp_warehousing",
			"warehousing_dt" => $_POST['warehousing_dt'],
			"warehousing_cha" => $warehousing_cha,
			"warehousing_cd" => $warehousing_cd,
			"p_order_uid" => $_POST['p_order_uid'],
			"p_order_cd" => $_POST['p_order_cd'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"manager" => $_POST['manager'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"deadline_dt" => $_POST['deadline_dt'],
			"tax_type" => $_POST['tax_type'],
			"memo" => "바코드 입고",
			"remark" => $_POST['remark'],
			"state" => $_POST['state'],
			"attach" => $fileAttach,
			"cntTotal" => $this->replaceComma($_POST['cntTotal']),
			"unitPriceTotal" => $this->replaceComma($_POST['unitPriceTotal']),
			"supplyPriceTotal" => $this->replaceComma($_POST['supplyPriceTotal']),
			"taxTotal" => $this->replaceComma($_POST['taxTotal']),
			"priceTotal" => $this->replaceComma($_POST['priceTotal']),
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);

		$purchase = new Purchase;
		$fid = $purchase->inputWarehousingItem($data);
		
		if ($fid >=0){

			$item_cd = $_POST['item_cd'];
			$item_nm = $_POST['item_nm'];
			$standard1 = $_POST['standard1'];
			$material= $_POST['material'];
			$unit = $_POST['unit'];
			$remain_cnt = $_POST['remain_cnt'];
			$shortage_cnt = $_POST['shortage_cnt'];
			$cnt = $_POST['cnt'];
			$unit_price = $_POST['unit_price'];
			$supply_price = $_POST['supply_price'];
			$tax = $_POST['tax'];
			$total_price = $_POST['total_price'];
			$lot_no_cd = $_POST['lot_no_cd'];
			$lot_no_nm = $_POST['lot_no_nm'];
			$inspection_cd = $_POST['inspection_cd'];

			foreach($item_cd as $key => $val) {
				if($val != "") {
					$data = array(
						"table" => "erp_warehousing_item",
						"fid" => $fid,
						"warehousing_cd" => $warehousing_cd,
						"item_cd" => $val,
						"item_nm" => $item_nm[$key],
						"standard1" => $standard1[$key],
						"material" => $material[$key],
						"unit" => $unit[$key],
						"remain_cnt" =>$this->replaceComma($remain_cnt[$key]),
						"shortage_cnt" => $this->replaceComma($shortage_cnt[$key]),
						"cnt" => $this->replaceComma($cnt[$key]),
						"unit_price" => $this->replaceComma($unit_price[$key]),
						"supply_price" => $this->replaceComma($supply_price[$key]),
						"tax" => $this->replaceComma($tax[$key]),
						"total_price" => $this->replaceComma($total_price[$key]),
						"lot_no_cd" =>  $lot_no_cd[$key],
						"lot_no_nm" =>  $lot_no_nm[$key],
						"inspection_cd" =>  $inspection_cd[$key],
						"regdate" => $now
					);
					$purchase->insert($data);

					//구매입고시 Lot_NO 테입이블 관리
					$data = array(
						"table" => "erp_warehousing_lot_no",
						"fid" => $fid,
						"warehousing_cd" => $warehousing_cd,
						"warehousing_dt" => $_POST['warehousing_dt'],
						"warehouse_cd" => $_POST['warehouse_cd'],
						"warehouse_nm" => $_POST['warehouse_nm'],
						"item_cd" => $val,
						"item_nm" => $item_nm[$key],
						"standard1" => $standard1[$key],
						"material" => $material[$key],
						"lot_no_cd" =>  $lot_no_cd[$key],
						"lot_no_nm" =>  $lot_no_nm[$key],
						"cnt" => $this-> replaceComma($cnt[$key]),
						"unit_price" => $this->replaceComma($unit_price[$key]),
						"supply_price" => $this->replaceComma($supply_price[$key]),
						"regdate" => $now
					);
					$purchase->insert($data);

					if($_POST['state']=="2"){

						$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."' "; //창고별 재고현황 쿼리중 창고재고가 있는경우
						$result = mysql_query($sql);
							if(@mysql_num_rows($result) > 0) { // 등록된 창고 재고창고가 있다면
							
								$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."' ";
								$r_cnt = @mysql_fetch_object(mysql_query($sql));
								
								$remain_cnt = $r_cnt->remain_cnt + $this->replaceComma($cnt[$key]);
								
								// 전체재고에 넣기
								$stockData = array (
								"table" => "erp_stock",
								"where" => "item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."'",
								"standard1" => $standard1['standard1'],
								"material" => $material['material'],
								"unit" => $unit['unit'],
								"pur_cnt" => $this->replaceComma($cnt[$key]),
								"pur_unit_price" => $this->replaceComma($supply_price[$key]),
								"remain_cnt" => $remain_cnt,
								//"warehouse_cd" => $_POST['warehouse_cd'],
								"in_date" => $now
								);
								$purchase->update($stockData);
							}else{                        // 등록된 창고 재고창고가 없다면
								$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' ";
								$r_cnt = @mysql_fetch_object(mysql_query($sql));
								
								$remain_cnt = $r_cnt->remain_cnt + $this->replaceComma($cnt[$key]);
								
								// 전체재고에 넣기
								$stockData = array (
								"table" => "erp_stock",
								"where" => "item_cd='".$val."' and standard1='".$standard1[$key]."'",
								"standard1" => $standard1['standard1'],
								"material" => $material['material'],
								"unit" => $unit['unit'],
								"pur_cnt" => $this->replaceComma($cnt[$key]),
								"pur_unit_price" => $this->replaceComma($supply_price[$key]),
								"remain_cnt" => $remain_cnt,
								"warehouse_cd" => $_POST['warehouse_cd'],
								"warehouse_nm" => $_POST['warehouse_nm'],
								"in_date" => $now
								);
								$purchase->update($stockData);
							}
							// 전체 inout에 넣기
							$inoutData = array (
							"table" => "erp_stock_inout",
							"item_cd" => $val,
							"warehouse_cd" => $_POST['warehouse_cd'],
							"warehousing_cd" => $warehousing_cd,
							"standard1" => $standard1[$key],
							"material" => $material[$key],
							"unit" => $unit[$key],
							"in_cnt" => $this->replaceComma($cnt[$key]),
							"pur_unit_price" => $this->replaceComma($supply_price[$key]),
							"total_price" => $this->replaceComma($total_price[$key]),
							"remain_cnt" => $remain_cnt,
							"lot_no" => $lot_no_cd[$key],
							"account" => "구매입고",
							"remark" => "구매입고",
							"create_dt" => $now
							);
							$purchase->insert($inoutData);
						}

				}
			}
		}
		
		$this->movePage("purchase","registPagePurchaseItemBarcodeIn");
		//$this->movePageClose($_POST['dialogID']);
	}

}
?>