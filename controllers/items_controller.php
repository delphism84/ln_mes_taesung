<?
session_start();
class ItemsController {
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

	public function replaceComma($num) {
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

	// 창고리스트 페이지
	public function listPageWarehouse() {
		require_once ("views/items/listWarehouse.php");
	}

	// 창고등록 페이지
	public function inputPageWarehouse() {
		require_once ("views/items/createWarehouse.php");
	}
	
	public function modifyPageWarehouse() {
		$t = Items::getWarehouse($_GET['uid']);
		require_once ("views/items/modifyWarehouse.php");
	}

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

		$items = new Items;
		$result = $items->registWarehouse($data);
		if($result) $this->movePage("items","listPageWarehouse");
	}

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

		$items = new Items;
		$result = $items->updateWarehouse($data);
		if($result) $this->movePage("items","listPageWarehouse");
	}

	public function registItem(){
		// 업로드 파일이 없을 경우를 대비해야 함
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('img');

		$sql = "select uid from erp_item where item_cd='".$_POST['item_cd']."' and standard1='".$_POST['standard1']."' and standard2='".$_POST['standard2']."' and standard3='".$_POST['standard3']."'";
		$row = mysql_num_rows(mysql_query($sql));

		if($row < 1) {

			$data = array (
				"table" => "erp_item",
				"item_cd" => $_POST['item_cd'],
				"item_nm" => $_POST['item_nm'],
				"unit" => $_POST['unit'],
				"standard1" => $_POST['standard1'],
				"standard2" => $_POST['standard2'],
				"standard3" => $_POST['standard3'],
				"min_pur_unit" => $_POST['min_pur_unit'],
				"account_cd" => $_POST['account_cd'],
				"account_nm" => $_POST['account_nm'],
				"delivery_period" => $_POST['delivery_period'],
				"base_stock_cnt" => $_POST['base_stock_cnt'],
				"safety_stock_cnt" => $_POST['safety_stock_cnt'],
				"item_gb" => $_POST['item_gb'],
				"item_group_cd" => $_POST['item_group_cd'],
				"item_group_nm" => $_POST['item_group_nm'],
				"pur_unit_price" => $_POST['pur_unit_price'],
				"unit_price" => $_POST['unit_price'],
				"barcode" => $_POST['barcode'],
				"lot_no" => $_POST['lot_no'],
				"warehouse_cd" => $_POST['warehouse_cd'],
				"warehouse_nm" => $_POST['warehouse_nm'],
				"img" => $fileAttach,
				"create_dt" => $now
			);

			$items = new Items;
			$result = $items->registItem($data);
			
			// 전체재고에 넣기
			$stockData = array (
				"table" => "erp_stock",
				"item_cd" => $_POST['item_cd'],
				"standard1" => $_POST['standard1'],
				"standard2" => $_POST['standard2'],
				"standard3" => $_POST['standard3'],
				"pur_cnt" => $_POST['base_stock_cnt'],
				"pur_unit_price" => $_POST['pur_unit_price'],
				"remain_cnt" => $_POST['base_stock_cnt'],
				"warehouse_cd" => $_POST['warehouse_cd'],
				"in_date" => $now
			);
			$result = $items->registStock($stockData);
			
			// 입출고내역에 넣기
			// 사유에 넣기
			if($result) $this->movePage("items","listPageItem");		
		}
	}

	public function updateItem(){
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('img');

		$data = array (
			"table" => "erp_item",
			"where" => "uid=".$_POST['uid'],
			"item_cd" => $_POST['item_cd'],
			"item_nm" => $_POST['item_nm'],
			"unit" => $_POST['unit'],
			"standard1" => $_POST['standard1'],
			"standard2" => $_POST['standard2'],
			"standard3" => $_POST['standard3'],
			"min_pur_unit" => $_POST['min_pur_unit'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"delivery_period" => $_POST['delivery_period'],
			"base_stock_cnt" => $_POST['base_stock_cnt'],
			"safety_stock_cnt" => $_POST['safety_stock_cnt'],
			"item_gb" => $_POST['item_gb'],
			"item_group_cd" => $_POST['item_group_cd'],
			"item_group_nm" => $_POST['item_group_nm'],
			"pur_unit_price" => $_POST['pur_unit_price'],
			"unit_price" => $_POST['unit_price'],
			"barcode" => $_POST['barcode'],
			"lot_no" => $_POST['lot_no'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"img" => $fileAttach,
			"create_dt" => $now
		);

		$items = new Items;
		$result = $items->updateItem($data);
		
		/*
		$stockData = array (
			"table" => "erp_stock",
			"item_cd" => $_POST['item_cd'],
			"pur_cnt" => $_POST['base_stock_cnt'],
			"pur_unit_price" => $_POST['pur_unit_price'],
			"remain_cnt" => $_POST['base_stock_cnt'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"in_date" => $now
		);
		$result = $items->registStock($stockData);
		*/
		if($result) $this->movePage("items","listPageItem");		
	}

	// 품목등록 페이지
	public function inputPageItem(){
		require_once ('views/items/createItem.php');
	}

	public function listPageItem() {
		require_once ("views/items/listItem.php");
	}

	// 창고재고 페이지
	public function listPageWarehouseStock(){
		require_once ("views/items/listWarehouseStock.php");
	}

	public function listPageStock() {
		require_once ("views/items/listStock.php");
	}

	public function modifyPageItem() {
		$t = Items::getItem($_GET['uid']);
		require_once ("views/items/modifyItem.php");
	}

	public function modifyPageStock() {
		$t = Items::getStock($_GET['uid']);
		require_once ("views/items/modifyItem.php");
	}
	
	// 안전재고관리 리스트 페이지
	public function listPageSafetyStock() {
		require_once ("views/items/listSafetyStock.php");
	}

	// 단가관리
	public function listPageStockPrice(){
		require_once ("views/items/listStockPrice.php");
	}

	// 재고실사
	public function listPageRealStock() {
		require_once ("views/items/listRealStock.php");
	}

	// 바코드 리스트
	public function listPageBarcode() {
		require_once ("views/items/listBarcode.php");
	}

	public function inputPageBarcode() {
		$t = Items::getItem($_GET['uid']);
		require_once ("views/items/createBarcode.php");
	}

	public function updateBarcode(){
		$data = array (
			"table" => "erp_item",
			"where" => "uid=".$_POST['uid'],
			"in_barcode" => $_POST['in_barcode'],
			"barcode" => $_POST['barcode']
		);

		$items = new Items;
		$result = $items->updateItem($data);
		$this->listPageBarcode();
	}

	// 출고요청리스트
	public function listPageRelease(){
		require_once("views/items/listRelease.php");
	}

	// 출고요청 상세 페이지
	public function modifyPageRelease() {
		$t = Items::getRelease($_GET['uid']);
		require_once ("views/items/modifyRelease.php");
	}

	// 자재수불부
	public function listPageItemInout() {
		require_once ("views/items/listItemInout.php");
	}

	// 바코드 출고
	public function listPageBarcodeReleaseItem() {
		require_once ("views/items/listBarcodeReleaseItem.php");
	}

	// Lot No 추적
	public function listPageLotNo() {
		require_once ("views/items/listLotNo.php");
	}

	public function viewPageLotNo() {
		require_once ("views/items/viewLotNo.php");
	}

	// 금형관리
	public function listPageMold() {
		require_once ("views/items/listMold.php");
	}

	public function inputPageMold() {
		require_once ("views/items/createMold.php");
	}

	// 파지관리
	public function listPageScrap() {
		require_once ("views/items/createScrap.php");
	}
	
	public function listPageStockInoutPop() {
		require_once ("views/items/listStockInout.php");
	}

	
	// 출고요청서 리스트
	public function listPageReleaseRequest() {
		require_once ("views/items/listReleaseRequest.php");
	}
	// 출고요청서 등록
	public function registPageReleaseRequestPop() {
		require_once ("views/items/createReleaseRequest_pop.php");
	}
	
	// 출고요청서 수정
	public function modifyPageReleaseRequestPop() {
		$t = Items::getReleaseRequest($_GET['uid']);
		require_once ("views/items/modifyReleaseRequest_pop.php");
	}

	
	// 출고요청 등록
	public function inputReleaseRequest() {
		
		$now = date("Y-m-d H:i:s");
	
		$fileAttach = $this->upload('attach');
		
		$sql = "select max(release_cha) as cnt from erp_release_request where release_dt='".$_POST['release_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$release_cha = "1";
		}else{
			$release_cha = $t0->cnt+1;
		}

		$release_cd  = $_POST['release_dt']."-".$release_cha;
		
		/*
		if ($_POST['state'] != ""){
			$state = $_POST['state'];	
		}else{
			$state = "complete";	 //stay(대기중) ing(진행중) complete (입고완료)		
		}
		*/

		$data = array(
			"table"			=> "erp_release_request",
			"release_dt"		=> $_POST['release_dt'],
			"release_cha"		=> $release_cha,
			"release_cd"		=> $release_cd,
			"work_cd"		=> $_POST['work_cd'],
			"project_cd"		=> $_POST['project_cd'],
			"project_nm"		=> $_POST['project_nm'],
			"account_cd"		=> $_POST['account_cd'],
			"account_nm"		=> $_POST['account_nm'],
			"manager"		=> $_POST['manager'],
			"wh_cd_t_cd"		=> $_POST['wh_cd_t_cd'],
			"wh_cd_t_nm"		=> $_POST['wh_cd_t_nm'],
			"cnt"			=> $this->replaceComma($_POST['cnt']),
			"cntTotal"		=> $this->replaceComma($_POST['cntTotal']),
			"memo"			=> $_POST['memo'],
			"state"			=> $_POST['state'],
			"attach"		=> $fileAttach,
			"emp_id"		=> $_SESSION['login_id'],
			"create_dt"		=> $now
		);
		
		$items = new Items;
		$rid = $items->inputReleaseRequestItem($data);
	
		if ($rid >=0){

			$item_cd		= $_POST['item_cd'];
			$item_nm		= $_POST['item_nm'];
			$standard1		= $_POST['standard1'];
			$material		= $_POST['material'];
			$unit			= $_POST['unit'];
			$remain_cnt		= $_POST['remain_cnt'];
			$shortage_cnt		= $_POST['shortage_cnt'];
			$cnt			= $_POST['cnt'];
			$unit_price		= $_POST['unit_price'];
			$supply_price		= $_POST['supply_price'];
			$tax			= $_POST['tax'];
			$total_price		= $_POST['total_price'];
			$lot_no_cd		= $_POST['lot_no_cd'];
			$lot_no_nm		= $_POST['lot_no_nm'];
			$warehouse_cd		= $_POST['warehouse_cd'];
			$warehouse_nm		= $_POST['warehouse_nm'];

			//$inspection_cd = $_POST['inspection_cd'];

			foreach($item_cd as $key => $val) {
				if($val != "") {
					$data = array(
						"table"			=> "erp_release_request_item",
						"rid"			=> $rid,
						"release_cd"		=> $release_cd,
						"item_cd"		=> $val,
						"item_nm"		=> $item_nm[$key],
						"standard1"		=> $standard1[$key],
						"material"		=> $material[$key],
						"unit"			=> $unit[$key],
						"remain_cnt"		=>$this->replaceComma($remain_cnt[$key]),
						"shortage_cnt"		=> $this->replaceComma($shortage_cnt[$key]),
						"cnt"			=> $this->replaceComma($cnt[$key]),
						"lot_no_cd"		=>  $lot_no_cd[$key],
						"lot_no_nm"		=>  $lot_no_nm[$key],
						"warehouse_cd"		=>  $warehouse_cd[$key],
						"warehouse_nm"		=>  $warehouse_nm[$key],
						"regdate"		=> $now
					);
					$items->insert($data);

					$data = array(	//투입대기로 상태인 원자재..
						"table"			=> "erp_release_input_ready",
						"rid"			=> $rid,
						"release_cd"		=> $release_cd,
						"item_cd"		=> $val,
						"item_nm"		=> $item_nm[$key],
						"standard1"		=> $standard1[$key],
						"material"		=> $material[$key],
						"unit"			=> $unit[$key],
						"remain_cnt"		=>$this->replaceComma($remain_cnt[$key]),
						"shortage_cnt"		=> $this->replaceComma($shortage_cnt[$key]),
						"cnt"			=> $this->replaceComma($cnt[$key]),
						"lot_no_cd"		=>  $lot_no_cd[$key],
						"lot_no_nm"		=>  "",
						"warehouse_cd"		=>  $warehouse_cd[$key],
						"warehouse_nm"		=>  $warehouse_nm[$key],
						"regdate"		=> $now
					);
					$items->insert($data);

					if($_POST['state']=="2"){

						$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."' "; //창고별 재고현황 쿼리중 창고재고가 있는경우
						$result = mysql_query($sql);
							if(@mysql_num_rows($result) > 0) { // 등록된 창고 재고창고가 있다면
							
								$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."' ";
								$r_cnt = @mysql_fetch_object(mysql_query($sql));
								
								$remain_cnt = $r_cnt->remain_cnt - $this->replaceComma($cnt[$key]);
								
								// 전체재고에 넣기
								$stockData = array (
								"table" => "erp_stock",
								"where"	=> "item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."'",
								"pur_cnt"			=> $this->replaceComma($cnt[$key]),
								"pur_unit_price"		=> $this->replaceComma($supply_price[$key]),
								"remain_cnt"			=> $remain_cnt,
								"out_date"			=> $now
								);
								$items->update($stockData);
							}else{                        // 등록된 창고 재고창고가 없다면
								$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' ";
								$r_cnt = @mysql_fetch_object(mysql_query($sql));
								
								$remain_cnt = $r_cnt->remain_cnt - $this->replaceComma($cnt[$key]);
								
								// 전체재고에 넣기
								$stockData = array (
								"table"				=> "erp_stock",
								"where"				=> "item_cd='".$val."' and standard1='".$standard1[$key]."'",
								"pur_cnt"			=> $this->replaceComma($cnt[$key]),
								"pur_unit_price"		=> $this->replaceComma($supply_price[$key]),
								"remain_cnt"			=> $remain_cnt,
								"warehouse_cd"			=> $warehouse_cd[$key],
								"out_date"			=> $now
								);
								$items->insert($stockData);
							}

							// 전체 inout에 넣기
							$inoutData = array (
							"table"				=> "erp_stock_inout",
							"item_cd"			=> $val,
							"warehouse_cd"			=> $warehouse_cd[$key],
							"warehousing_cd"		=> $warehousing_cd,
							"standard1"			=> $standard1[$key],
							"material"			=> $material[$key],
							"unit"				=> $unit[$key],
							"out_cnt"			=> $this->replaceComma($cnt[$key]),
							"out_dt"			=> $now,
							"pur_unit_price"		=> $this->replaceComma($supply_price[$key]),
							"total_price"			=> $this->replaceComma($total_price[$key]),
							"remain_cnt"			=> "0",	//출고 리스트는 잔여수량을 표기하지 않음.
							"lot_no"			=> $lot_no_cd[$key],
							"account"			=> "생산불출",
							"remark"			=> "생산불출",
							"used"				=>'y',
							"create_dt"			=> $now
							);
							$items->insert($inoutData);

							/////// 재고 used y 처리
							$sql22 = "select uid, remain_cnt ,in_cnt , out_cnt from erp_stock_inout where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."' and lot_no='".$lot_no_cd[$key]."'  and used='n' order by create_dt asc";

							$result33 = mysql_query($sql22);

								$out_cnt22 = $this->replaceComma($cnt[$key]); //출하 되야 할 수량

							while($r_cnt2 = mysql_fetch_object($result33)){

								
								$in_Remain_cnt = $r_cnt2->remain_cnt - $out_cnt22;
								
														
								//echo $remain_cnt;
								if( $in_Remain_cnt <= 0 ){
									// 해당 입고된것 모두 사용했을때.
									$inoutData = array(
									"table"	=> "erp_stock_inout",
									"where" => "uid=".$r_cnt2->uid,
									"remain_cnt" =>"0",
									"used"	=>"y"
									);
									$items->update($inoutData);

									$out_cnt22 = $out_cnt22 - $r_cnt2->remain_cnt;//출하되야할 잔여수량

								}else{
									$inoutData = array(
									"table"	=> "erp_stock_inout",
									"where" => "uid=".$r_cnt2->uid,
									"remain_cnt" =>$in_Remain_cnt,
									"used"	=>"n"
									);
									$items->update($inoutData);
									break;
								}
							}
							//////
						}
				}
			}
		}
		//exit;
		//$this->movePage("items","listWarehousingItem");
		$this->movePageClose($_POST['dialogID']);
	}
	
	// 출고요청 수정
	public function updateReleaseRequest() {
		$now = date("Y-m-d H:i:s");
	
		$fileAttach = $this->upload('attach');
		

		$data = array(
			"table"			=> "erp_release_request",
			"where"			=> "uid=".$_POST['uid'],
			"work_cd"		=> $_POST['work_cd'],
			"project_cd"		=> $_POST['project_cd'],
			"project_nm"		=> $_POST['project_nm'],
			"account_cd"		=> $_POST['account_cd'],
			"account_nm"		=> $_POST['account_nm'],
			"manager"		=> $_POST['manager'],
			"wh_cd_t_cd"		=> $_POST['wh_cd_t_cd'],
			"wh_cd_t_nm"		=> $_POST['wh_cd_t_nm'],
			"cnt"			=> $this->replaceComma($_POST['cnt']),
			"cntTotal"		=> $this->replaceComma($_POST['cntTotal']),
			"memo"			=> $_POST['memo'],
			"state"			=> $_POST['state'],
			"attach"		=> $fileAttach,
			"emp_id"		=> $_SESSION['login_id'],
			"create_dt"		=> $now
		);
		
		$items = new Items;
		$result = $items->update($data);
				
		$fid = $_POST['uid'];

		// 아이템 삭제
		$sql = "delete from erp_release_request_item where rid=".$fid;
		mysql_query($sql);
		

			$item_cd		= $_POST['item_cd'];
			$item_nm		= $_POST['item_nm'];
			$standard1		= $_POST['standard1'];
			$material		= $_POST['material'];
			$unit			= $_POST['unit'];
			$remain_cnt		= $_POST['remain_cnt'];
			$shortage_cnt		= $_POST['shortage_cnt'];
			$cnt			= $_POST['cnt'];
			$unit_price		= $_POST['unit_price'];
			$supply_price		= $_POST['supply_price'];
			$tax			= $_POST['tax'];
			$total_price		= $_POST['total_price'];
			$lot_no_cd		= $_POST['lot_no_cd'];
			$lot_no_nm		= $_POST['lot_no_nm'];
			$warehouse_cd		= $_POST['warehouse_cd'];
			$warehouse_nm		= $_POST['warehouse_nm'];
			
			//$inspection_cd = $_POST['inspection_cd'];

			foreach($item_cd as $key => $val) {
				if($val != "") {
					$data = array(
						"table" => "erp_release_request_item",
						"rid" => $fid,
						"release_cd" => $release_cd,
						"item_cd" => $val,
						"item_nm" => $item_nm[$key],
						"standard1" => $standard1[$key],
						"material" => $material[$key],
						"unit" => $unit[$key],
						"remain_cnt" =>$this->replaceComma($remain_cnt[$key]),
						"shortage_cnt" => $this->replaceComma($shortage_cnt[$key]),
						"cnt" => $this->replaceComma($cnt[$key]),
						"lot_no_cd" =>  $lot_no_cd[$key],
						"lot_no_nm" =>  $lot_no_nm[$key],
						"warehouse_cd"		=>  $warehouse_cd[$key],
						"warehouse_nm"		=>  $warehouse_nm[$key],
						"regdate" => $now
					);
					$items->insert($data);  

					if($_POST['state']=="2"){
						
						$sql55 = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."' "; //창고별 재고현황 쿼리중 창고재고가 있는경우

						$result55 = mysql_query($sql55);
							if( $ttt = @mysql_num_rows($result55) > 0) { // 등록된 창고 재고창고가 있다면
								
								$r_cnt = @mysql_fetch_object( $result55 );
							
								$remain_cnt = $r_cnt->remain_cnt - $this->replaceComma($cnt[$key]);
								
								// 전체재고에 넣기
								$stockData = array (
								"table" => "erp_stock",
								"where" => "item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."'",
								"pur_cnt" => $this->replaceComma($cnt[$key]),
								"material" => $material[$key],
								"pur_unit_price" => $this->replaceComma($supply_price[$key]),
								"remain_cnt" => $remain_cnt,
								"out_date" => $now
								);
								$items->update($stockData);
							}

							// 전체 inout에 넣기
							$inoutData = array (
							"table"				=> "erp_stock_inout",
							"item_cd"			=> $val,
							"warehouse_cd"			=> $warehouse_cd[$key],
							"warehousing_cd"		=> $warehousing_cd,
							"standard1"			=> $standard1[$key],
							"material"			=> $material[$key],
							"unit"				=> $unit[$key],
							"out_cnt"			=> $this->replaceComma($cnt[$key]),
							"out_dt"			=> $now,
							"pur_unit_price"		=> $this->replaceComma($supply_price[$key]),
							"total_price"			=> $this->replaceComma($total_price[$key]),
							"remain_cnt"			=> "0",	//생산불출은 remain이 없음
							"lot_no"			=> $lot_no_cd[$key],
							 "account"			=> "생산불출",
							"remark"			=> "생산불출",
							"used"				=> "y",
							"create_dt"			=> $now
							);
							$items->insert($inoutData);

							/////// 재고 used y 처리
							$sql22 = "select uid, remain_cnt ,in_cnt , out_cnt from erp_stock_inout where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."' and lot_no='".$lot_no_cd[$key]."'  and used='n' order by create_dt asc";

							$result33 = mysql_query($sql22);

								$out_cnt22 = $this->replaceComma($cnt[$key]); //출하 되야 할 수량

							while($r_cnt2 = mysql_fetch_object($result33)){

								
								$in_Remain_cnt = $r_cnt2->remain_cnt - $out_cnt22;
								
														
								//echo $remain_cnt;
								if( $in_Remain_cnt <= 0 ){
									// 해당 입고된것 모두 사용했을때.
									$inoutData = array(
									"table"	=> "erp_stock_inout",
									"where" => "uid=".$r_cnt2->uid,
									"remain_cnt" =>"0",
									"used"	=>"y"
									);
									$items->update($inoutData);

									$out_cnt22 = $out_cnt22 - $r_cnt2->remain_cnt;//출하되야할 잔여수량

								}else{
									$inoutData = array(
									"table"	=> "erp_stock_inout",
									"where" => "uid=".$r_cnt2->uid,
									"remain_cnt" =>$in_Remain_cnt,
									"used"	=>"n"
									);
									$items->update($inoutData);
									break;
									
								}
							}
							//////

							$data = array(
							"table" => "erp_release_request",
							"where" => "uid=".$rid,
							"state" => "2"
							);
							$items->update($data);

					}

					if($_POST['state']=="3"){
						
						$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."' ";
						$r_cnt = mysql_fetch_object(mysql_query($sql));

						$remain_cnt = $r_cnt->remain_cnt + $this->replaceComma($cnt[$key]);

						
						// 전체재고에 넣기
						$stockData = array (
						"table" => "erp_stock",
						"where" => "item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."'",
						"pur_cnt" => $this->replaceComma($cnt[$key]),
						"material" => $material[$key],
						"pur_unit_price" => $this->replaceComma($supply_price[$key]),
						"remain_cnt" => $remain_cnt,
						"in_date" => $now
						);
						$items->update($stockData);
						

						// 전체 inout에 넣기
						$inoutData = array (
						"table"				=> "erp_stock_inout",
						"item_cd"			=> $val,
						"warehouse_cd"			=> $warehouse_cd[$key],
						"warehousing_cd"		=> $warehousing_cd,
						"standard1"			=> $standard1[$key],
						"material"			=> $material[$key],
						"unit"				=> $unit[$key],
						"in_cnt"			=> $this->replaceComma($cnt[$key]),
						"in_dt"				=> $now,
						"pur_unit_price"		=> $this->replaceComma($supply_price[$key]),
						"total_price"			=> $this->replaceComma($total_price[$key]),
						"remain_cnt"			=> $this->replaceComma($cnt[$key]),
						"lot_no"			=> $lot_no_cd[$key],
						"account"			=> "출고취소",
						"remark"			=> "출고취소",
						"used"				=> "n",
						"create_dt"			=> $now
						);
						$items->insert($inoutData);

						$data = array(
							"table" => "erp_release_request",
							"where" => "uid=".$rid,
							"state" => "3"
						);
						$items->update($data);
						
					}
				}
			}
		

		//exit;
		//$this->movePage("items","listWarehousingItem");
		$this->movePageClose($_POST['dialogID']);
	}
	
		// 창고리스트 페이지
	public function listWarehousePop() {
		require_once ("views/popup/warehouseList.php");
	}


		//바코드 출고 등록
	public function registPageReleaseItemBarcodeOut() {
		require_once ("views/items/createReleaseItemBarcodeOut.php");
	}	
	
	// 자재 출고 등록
	public function inputReleaseRequestBarcodeOut() {
		
		$now = date("Y-m-d H:i:s");
	
		$fileAttach = $this->upload('attach');
		
		$sql = "select max(release_cha) as cnt from erp_release_request where release_dt='".$_POST['release_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$release_cha = "1";
		}else{
			$release_cha = $t0->cnt+1;
		}

		$release_cd  = $_POST['release_dt']."-".$release_cha;
		
		/*
		if ($_POST['state'] != ""){
			$state = $_POST['state'];	
		}else{
			$state = "complete";	 //stay(대기중) ing(진행중) complete (입고완료)		
		}
		*/

		$data = array(
			"table"			=> "erp_release_request",
			"release_dt"	=> $_POST['release_dt'],
			"release_cha"	=> $release_cha,
			"release_cd"	=> $release_cd,
			"work_cd"		=> $_POST['work_cd'],
			"project_cd"	=> $_POST['project_cd'],
			"project_nm"	=> $_POST['project_nm'],
			"account_cd"	=> $_POST['account_cd'],
			"account_nm"	=> $_POST['account_nm'],
			"manager"		=> $_POST['manager'],
			"warehouse_cd"	=> $_POST['warehouse_cd'],
			"warehouse_nm"	=> $_POST['warehouse_nm'],
			"wh_cd_t_cd"	=> $_POST['wh_cd_t_cd'],
			"wh_cd_t_nm"	=> $_POST['wh_cd_t_nm'],
			"cnt"			=> $this->replaceComma($_POST['cnt']),
			"cntTotal"		=> $this->replaceComma($_POST['cntTotal']),
			"remark"		=> $_POST['remark'],
			"memo"			=> "바코드 출고",
			"state"			=> $_POST['state'],
			"attach"		=> $fileAttach,
			"emp_id"		=> $_SESSION['login_id'],
			"create_dt"		=> $now
		);
		
		$items = new Items;
		$rid = $items->inputReleaseRequestItem($data);
	
		if ($rid >=0){

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
			//$inspection_cd = $_POST['inspection_cd'];

			foreach($item_cd as $key => $val) {
				if($val != "") {
					$data = array(
						"table"			=> "erp_release_request_item",
						"rid"			=> $rid,
						"release_cd"	=> $release_cd,
						"item_cd"		=> $val,
						"item_nm"		=> $item_nm[$key],
						"standard1"		=> $standard1[$key],
						"material"		=> $material[$key],
						"unit"			=> $unit[$key],
						"remain_cnt"	=>$this->replaceComma($remain_cnt[$key]),
						"shortage_cnt"	=> $this->replaceComma($shortage_cnt[$key]),
						"cnt"			=> $this->replaceComma($cnt[$key]),
						"lot_no_cd"		=>  $lot_no_cd[$key],
						"lot_no_nm"		=>  $lot_no_nm[$key],
						"regdate"		=> $now
					);
					$items->insert($data);

					if($_POST['state']=="2"){

						$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."' "; //창고별 재고현황 쿼리중 창고재고가 있는경우
						$result = mysql_query($sql);
							if(@mysql_num_rows($result) > 0) { // 등록된 창고 재고창고가 있다면
							
								$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."' ";
								$r_cnt = @mysql_fetch_object(mysql_query($sql));
								/*
								$remain_cnt = $r_cnt->remain_cnt - $this->replaceComma($cnt[$key]);
								
								if ($stock->remain_cnt >= $total_cnt){
									$bcnt = "0";
								}else{
									$bcnt =  $total_cnt - $stock->remain_cnt;
								}
								*/	
								// 전체재고에 넣기
								$stockData = array (
								"table" => "erp_stock",
								"where"				=> "item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$_POST['warehouse_cd']."'",
								"standard1"			=> $standard1['standard1'],
								"material"			=> $material['material'],
								"unit"				=> $unit['unit'],
								"pur_cnt"			=> $this->replaceComma($cnt[$key]),
								"pur_unit_price"	=> $this->replaceComma($supply_price[$key]),
								"remain_cnt"		=> $remain_cnt,
								//"warehouse_cd" => $_POST['warehouse_cd'],
								"out_date"			=> $now
								);
								$items->update($stockData);
							}else{                        // 등록된 창고 재고창고가 없다면
								$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' ";
								$r_cnt = @mysql_fetch_object(mysql_query($sql));
								
								$remain_cnt = $r_cnt->remain_cnt - $this->replaceComma($cnt[$key]);
								/*
								if ($stock->remain_cnt >= $total_cnt){
									$bcnt = "0";
								}else{
									$bcnt =  $total_cnt - $stock->remain_cnt;
								}
								*/
								// 전체재고에 넣기
								$stockData = array (
								"table"				=> "erp_stock",
								"where"				=> "item_cd='".$val."' and standard1='".$standard1[$key]."'",
								"standard1"			=> $standard1['standard1'],
								"material"			=> $material['material'],
								"unit"				=> $unit['unit'],
								"pur_cnt"			=> $this->replaceComma($cnt[$key]),
								"pur_unit_price"	=> $this->replaceComma($supply_price[$key]),
								"remain_cnt"		=> $remain_cnt,
								"warehouse_cd"		=> $_POST['warehouse_cd'],
								"warehouse_nm"		=> $_POST['warehouse_nm'],
								"out_date"			=> $now
								);
								$items->update($stockData);
							}
							// 전체 inout에 넣기
							$inoutData = array (
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
							"remain_cnt"			=> $remain_cnt,
							"lot_no"			=> $lot_no_cd[$key],
							"account"			=> "자재출고",
							"remark"			=> "자재출고",
							"create_dt"			=> $now
							);
							$items->insert($inoutData);
						}

				}
			}
		}
		//exit;
		$this->movePage("items","registPageReleaseItemBarcodeOut");
		//$this->movePageClose($_POST['dialogID']);
	}

	//바코드 출고
	public function outReleaseRequestBarcodeOut(){


		$now = date("Y-m-d H:i:s");
			
		$sql = "select max(release_cha) as cnt from erp_release_request where release_dt='".$_POST['release_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));
		
		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$release_cha = "1";
		}else{
			$release_cha = $t0->cnt+1;
		}

		$release_cd  = $_POST['release_dt']."-".$release_cha;
		
		$data = array(
			"table"		=> "erp_release_request",
			"release_dt"	=> $_POST['release_dt'],
			"release_cha"	=> $release_cha,
			"release_cd"	=> $release_cd,
			"work_cd"	=> $_POST['work_cd'],
			"project_cd"	=> $_POST['project_cd'],
			"project_nm"	=> $_POST['project_nm'],
			"account_cd"	=> $_POST['account_cd'],
			"account_nm"	=> $_POST['account_nm'],
			"manager"	=> $_POST['manager'],
			"wh_cd_t_cd"	=> $_POST['wh_cd_t_cd'],
			"wh_cd_t_nm"	=> $_POST['wh_cd_t_nm'],
			"cnt"		=> $this->replaceComma($_POST['cnt']),
			"cntTotal"	=> $this->replaceComma($_POST['cntTotal']),
			"remark"	=> $_POST['remark'],
			"memo"		=> "바코드 출고",
			"state"		=> 2,
			"emp_id"	=> $_SESSION['login_id'],
			"create_dt"	=> $now
		);
		
		$items = new Items;
		$rid = $items->inputReleaseRequestItem($data);
	
		if ($rid >=0){

			$item_cd		= $_POST['item_cd'];
			$item_nm		= $_POST['item_nm'];
			$standard1		= $_POST['standard1'];
			$unit			= $_POST['unit'];
			$remain_cnt		= $_POST['remain_cnt'];
			$cnt			= $_POST['cnt'];
			$lot_no_cd		= $_POST['lot_no'];
			$lot_no_nm		= $_POST['lot_no_nm'];
			$warehouse_cd		= $_POST['warehouse_cd'];
			$warehouse_nm		= $_POST['warehouse_nm'];

			$material		= $_POST['material'];
			$unit_price		= $_POST['unit_price'];
			$supply_price	= $_POST['supply_price'];
			$tax			= $_POST['tax'];
			$total_price	= $_POST['total_price'];
			
			//$inspection_cd = $_POST['inspection_cd'];

			foreach($item_cd as $key => $val) {
				if($val != "") {
					$data = array(
						"table"			=> "erp_release_request_item",
						"rid"			=> $rid,
						"release_cd"		=> $release_cd,
						"item_cd"		=> $val,
						"item_nm"		=> $item_nm[$key],
						"standard1"		=> $standard1[$key],
						"material"		=> "",
						"unit"			=> $unit[$key],
						"remain_cnt"		=> $this->replaceComma($remain_cnt[$key]),
						"shortage_cnt"		=> 0,
						"cnt"			=> $this->replaceComma($cnt[$key]),
						"warehouse_cd"		=> $warehouse_cd[$key],
						"warehouse_nm"		=> $warehouse_nm[$key],
						"lot_no_cd"		=>  $lot_no_cd[$key],
						"lot_no_nm"		=>  "",
						"regdate"		=> $now
					);
					$items->insert($data);

					$data = array(	//투입대기로 상태인 원자재..
						"table"			=> "erp_release_input_ready",
						"rid"			=> $rid,
						"release_cd"		=> $release_cd,
						"item_cd"		=> $val,
						"item_nm"		=> $item_nm[$key],
						"standard1"		=> $standard1[$key],
						"material"		=> "",
						"unit"			=> $unit[$key],
						"remain_cnt"		=> $this->replaceComma($remain_cnt[$key]),
						"shortage_cnt"		=> 0,
						"cnt"			=> $this->replaceComma($cnt[$key]),
						"warehouse_cd"		=> $warehouse_cd[$key],
						"warehouse_nm"		=> $warehouse_nm[$key],
						"lot_no_cd"		=>  $lot_no_cd[$key],
						"lot_no_nm"		=>  "",
						"regdate"		=> $now
					);
					$items->insert($data);

					//if($_POST['state']=="2"){

						$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."' "; //창고별 재고현황 쿼리중 창고재고가 있는경우
						$result = mysql_query($sql);
							if(@mysql_num_rows($result) > 0) { // 등록된 창고 재고창고가 있다면
							
								$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."' ";
								$r_cnt = @mysql_fetch_object(mysql_query($sql));
								
								$remain_cnt = $r_cnt->remain_cnt - $this->replaceComma($cnt[$key]);
								
								// 전체재고에 넣기
								$stockData = array (
								"table" => "erp_stock",
								"where"	=> "item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."'",
								"pur_cnt"			=> $this->replaceComma($cnt[$key]),
								"pur_unit_price"		=> $this->replaceComma($supply_price[$key]),
								"remain_cnt"			=> $remain_cnt,
								"out_date"			=> $now
								);
								$items->update($stockData);
							}

							// 전체 inout에 넣기
							$inoutData = array (
							"table"				=> "erp_stock_inout",
							"item_cd"			=> $val,
							"warehouse_cd"			=> $warehouse_cd[$key],
							"warehousing_cd"		=> $warehousing_cd,
							"standard1"			=> $standard1[$key],
							"material"			=> $material[$key],
							"unit"				=> $unit[$key],
							"out_cnt"			=> $this->replaceComma($cnt[$key]),
							"out_dt"			=> $now,
							"pur_unit_price"		=> $this->replaceComma($supply_price[$key]),
							"total_price"			=> $this->replaceComma($total_price[$key]),
							"remain_cnt"			=> "0",	//출고 리스트는 잔여수량을 표기하지 않음.
							"lot_no"			=> $lot_no_cd[$key],
							"account"			=> "생산불출",
							"remark"			=> "생산불출",
							"used"				=>'y',
							"create_dt"			=> $now
							);
							$items->insert($inoutData);

							/////// 재고 used y 처리
							$sql22 = "select uid, remain_cnt ,in_cnt , out_cnt from erp_stock_inout where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."' and lot_no='".$lot_no_cd[$key]."'  and used='n' order by create_dt asc";

							$result33 = mysql_query($sql22);

								$out_cnt22 = $this->replaceComma($cnt[$key]); //출하 되야 할 수량

							while($r_cnt2 = mysql_fetch_object($result33)){

								
								$in_Remain_cnt = $r_cnt2->remain_cnt - $out_cnt22;
								//echo $val.">".$in_Remain_cnt;
														
								//echo $remain_cnt;
								if( $in_Remain_cnt <= 0 ){
									// 해당 입고된것 모두 사용했을때.
									$inoutData = array(
									"table"	=> "erp_stock_inout",
									"where" => "uid=".$r_cnt2->uid,
									"remain_cnt" =>"0",
									"used"	=>"y"
									);
									$items->update($inoutData);

									$out_cnt22 = $out_cnt22 - $r_cnt2->remain_cnt;//출하되야할 잔여수량

								}else{
									$inoutData = array(
									"table"	=> "erp_stock_inout",
									"where" => "uid=".$r_cnt2->uid,
									"remain_cnt" =>$in_Remain_cnt,
									"used"	=>"n"
									);
									$items->update($inoutData);
									break;
									
								}
							}
							//////
						//}

				}
			}
		}
		//exit;
		$this->movePage("items","registPageReleaseItemBarcodeOut");

	}
	
}	
?>