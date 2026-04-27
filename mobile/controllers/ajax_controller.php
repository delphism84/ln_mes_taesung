<?
require_once("controllers/functions_controller.php");

class Ajax extends Functions {
	public function createDb() {
		require_once ("include/db_structure.php");

		for($i = 0 ; $i < sizeof($sql) ; $i++) {
			$this->query($sql[$i]);
		}
	}
/*****************************************************************************************************************************/
// 기준정보관리 사용 함수
/*****************************************************************************************************************************/
	// 삭제(공용) 
	public function deleteSelect() {
		$array_uid = explode(",",$this->parameter['uids']);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			if(!empty($array_uid[$i])) {
				$sql = "delete from ".$this->parameter['table']." where uid=".$array_uid[$i];
				$this->query($sql);
			}
		}
	}

	// 출하지시를 내린 수주인지 확인
	public function checkObtainOrder() {
		$sql = "select state from obtain_order where order_cd='".$this->parameter['order_cd']."'";
		//echo $sql;
		$this->query($sql);
		$t = $this->fetch();
		if($t->state == "출하지시") echo "no";		
	}

	// 사원번호 중복검사
	public function checkEmpCd() {
		$sql = "select uid from employee where emp_cd='".$this->parameter['emp_cd']."'";
		$this->query($sql);
		if($this->get_rows() > 0) echo "false";
		else echo "success";
	}

	// 사원아이디 중복검사
	public function checkEmpId() {
		$sql = "select uid from employee where emp_id='".$this->parameter['emp_id']."'";
		$this->query($sql);
		if($this->get_rows() > 0) echo "false";
		else echo "success";
	}

	// 창고생성
	public function createWarehouse(){
		$sql = "select * from warehouse";
		$this->query($sql);
		while($t = $this->fetch()){
			$warehouse = "warehouse_".$t->uid;
			$result = $this->isTable($warehouse,DB_NAME);

			if(!$result) {
				$sql = "
					CREATE TABLE `".$warehouse."` (
						`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
						`fid` INT(11) NULL DEFAULT NULL COMMENT 'process uid',
						`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
						`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목명',
						`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
						`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
						`cnt` INT(11) NULL DEFAULT NULL COMMENT '수량',
						`lot_no` VARCHAR(50) NULL DEFAULT NULL COMMENT 'lot no',
						`create_dt` DATETIME NULL DEFAULT NULL COMMENT '입고일',
						PRIMARY KEY (`uid`),
						INDEX `fid` (`fid`),
						INDEX `item_cd` (`item_cd`),
						INDEX `standard` (`standard`)
					)
					COLLATE='utf8_general_ci'
					ENGINE=InnoDB
					;
				";
				$this->sub_query($sql);
			}
		}
	}

	// 공정 창고생성
	public function createProcessWarehouse(){
		$sql = "select * from process";
		$this->query($sql);
		while($t = $this->fetch()){
			$warehouse = "process_warehouse_".$t->uid;
			$result = $this->isTable($warehouse,DB_NAME);

			if(!$result) {
				$sql = "
					CREATE TABLE `".$warehouse."` (
						`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
						`fid` INT(11) NULL DEFAULT NULL COMMENT 'process uid',
						`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
						`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목명',
						`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
						`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
						`cnt` INT(11) NULL DEFAULT NULL COMMENT '수량',
						`lot_no` VARCHAR(50) NULL DEFAULT NULL COMMENT 'lot no',
						`create_dt` DATETIME NULL DEFAULT NULL COMMENT '입고일',
						PRIMARY KEY (`uid`),
						INDEX `fid` (`fid`),
						INDEX `item_cd` (`item_cd`),
						INDEX `standard` (`standard`)
					)
					COLLATE='utf8_general_ci'
					ENGINE=InnoDB
					;
				";
				$this->sub_query($sql);
			}
		}
	}

	// 해당 부서에 있는 사원 가져오기
	public function getDepartmentEmployee() {
		$json = new Services_JSON;
	
		$sql = "select * from employee where middle_department_cd=".$this->parameter['middle_department']." and small_department_cd=".$this->parameter['small_department'];
		$this->query($sql);
	
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$i++;
		}
		echo $json->encode($re);
	}

	// lot no 생성
	public function createLotNo() {
		switch($this->parameter['type']) {
			case "I" :
				$lot_no = "I-".$this->parameter['item_cd']."-".date("ymd")."-".$this->parameter['account_cd']."-".$_SESSION['login_uid'];
			break;

			case "P" :
				// item 의 uid를 알아온다
				$sql = "select uid from item where item_cd='".$this->parameter['item_cd']."'";
				$this->query($sql);
				$item = $this->fetch();

				// 다음 공정을 알아온다
				$sql = "select after_process from item_process where item_uid=".$item->uid." and process=".$this->parameter['process'];
				$this->query($sql);
				$after = $this->fetch();
				$lot_no = "P-".$this->parameter['item_cd']."-".date("ymd")."-".$_SESSION['login_uid']."-".$this->parameter['process']."-".$after->after_process;
			break;

			case "R" :
				// item 의 uid를 알아온다
				$sql = "select uid from item where item_cd='".$this->parameter['item_cd']."'";
				$this->query($sql);
				$item = $this->fetch();

				// 다음 공정을 알아온다
				$sql = "select after_process from item_process where item_uid=".$item->uid." and process=".$this->parameter['process'];
				$this->query($sql);
				$after = $this->fetch();
				$lot_no = "R-".$this->parameter['item_cd']."-".date("ymd")."-".$_SESSION['login_uid']."-".$this->parameter['process'];
			break;
		}
		
		echo $lot_no;
	}

	// 왼쪽 메뉴에 할일이 있는 숫자 카운팅
	public function getMenuCnt() {
		$json = new Services_JSON;

		// 수주로 등록된고 작업지시로 전환이 안된 것
		$sql = "select count(uid) as cnt from obtain_order where state='수주'";
		$this->query($sql);
		$t = $this->fetch();
		$re['obtain_order_cnt'] = $t->cnt;
		
		// 구매요청
		$sql = "select count(uid) as cnt from purchase where state='구매요청'";
		$this->query($sql);
		$t = $this->fetch();
		$re['purchase_cnt'] = $t->cnt;

		// 입고
		$sql = "select count(uid) as cnt from orders_item where state='발주'";
		$this->query($sql);
		$t = $this->fetch();
		$re['orders_cnt'] = $t->cnt;

		// 자재출고요청
		$sql = "select count(uid) as cnt from releases where state!='출고완료'";
		$this->query($sql);
		$t = $this->fetch();
		$re['release_cnt'] = $t->cnt;

		// 작업지시서
		$sql = "select count(uid) as cnt from work where state='작업지시'";
		$this->query($sql);
		$t = $this->fetch();
		$re['work_cnt'] = $t->cnt;

		// 안전재고관리
		$sql = "select count(uid) as cnt from safety_stock";
		$this->query($sql);
		$t = $this->fetch();
		$re['safety_cnt'] = $t->cnt;

		echo $json->encode($re);
	}

	// 테이블 비우기
	public function truncateTable(){
		$sql = "truncate table ".$this->parameter['table'];
		$result = $this->query($sql);
		if($result) echo "success";
	}
	
	// 테이블 삭제
	public function dropTable() {
		$sql = "drop table ".$this->parameter['table'];
		$this->query($sql);
	}

	// 해당 품목의 수량 가져오기
	public function getItemStockCnt(){
		$json = new Services_JSON;
		$total_cnt = 0;
	
		// 창고재고
		$sql = "select * from warehouse";
		$this->query($sql);
	
		$warehouse_cnt = 0;
			
	
		while($t = $this->fetch()) {
			$warehouse = "warehouse_".$t->uid;
			$result = $this->isTable($warehouse,DB_NAME);
	
			if($result) {
				$sql = "select cnt from ".$warehouse." where item_cd='".$this->parameter['item_cd']."' and standard='".$this->parameter['standard']."'";
				$this->sub_query($sql);
				while($r = $this->sub_fetch()) {
					$warehouse_cnt = $warehouse_cnt + $r->cnt;
					$total_cnt = $total_cnt + $r->cnt;
				}
			}
		}
	
		echo $total_cnt;
	}

	// 바코드 출력
	public function printBarcode() {
		$data = array(
			"table" => "print_history",
			"userid" => "ya",
			"pc_name" => $this->parameter['pc_name'],
			"printer_name" => $this->parameter['printer_name'],
			"barcode" => "1234567890",
			"cnt" => $this->parameter['cnt']
		);
		$this->insert($data);
	}	
//--------------------------------------------------------------------------------------------------------------------------- 품목관리
	// 품목코드
	public function createItemCode() {
		echo time();
	}

	// 로그인
	public function login() {
		if($_SESSION['login_id'] == "") {
			if($this->parameter['emp_id'] == "root" && $this->parameter['emp_pwd'] == "846975") {
				$_SESSION['login_uid'] = "0";
				$_SESSION['login_id'] = "sysadmin";
				$_SESSION['login_nm'] = "최고관리자";
				$_SESSION['login_level'] = "100";

				echo "success";
			} else {
				$sql = "select * from employee where emp_id='".$this->parameter['emp_id']."'";
				$t = @mysql_fetch_object(mysql_query($sql));

				if($t->emp_id != "") {
					if($t->emp_pwd == $this->parameter['emp_pwd']) {
						//$sql = "select uid from erp_info where admin='".$t->emp_id."'";
						//$admin = mysql_fetch_object(mysql_query($sql));

						//if($admin->uid != "") $_SESSION['login_level'] = "99";
						$_SESSION['login_uid'] = $t->uid;
						$_SESSION['login_id'] = $t->emp_id;
						$_SESSION['login_nm'] = $t->emp_nm;
						$_SESSION['big_department'] = $t->big_department_cd;
						$_SESSION['middle_department'] = $t->middle_department_cd;
						$_SESSION['small_department'] = $t->small_department_cd;																	

						// 먼저 오늘 출근 기록이 있나 확인
						$sql = "select uid from commute where emp_id='".$t->emp_id."' and create_dt='".$check_date."'";
						$res = mysql_fetch_object(mysql_query($sql));

						if(!isset($res->uid)) {
							$sql = "insert into commute (emp_id, emp_nm, work_tm, create_dt) values ('".$t->emp_id."','".$t->emp_nm."','".$time."',now())";
							mysql_query($sql);
						}
						
						echo "success";
					} else {
						echo "pwd";
					}
				} else {
					echo "none";
				}
			}
		}
	}

/*****************************************************************************************************************************/
// 환경설정
/*****************************************************************************************************************************/
	// 환경설정 등록
	public function registConfig(){
		$sql = "select * from program_setting";
		$this->query($sql);
		
		if($_POST['compulsionWork'] == "") $compulsionWork = "n"; else $compulsionWork = "y";
		if($_POST['autoIn'] == "") $autoIn = "n"; else $autoIn = "y";
		if($_POST['autoRelease'] == "") $autoRelease = "n"; else $autoRelease = "y";
		if($_POST['autoItemMinus'] == "") $autoItemMinus = "n"; else $autoItemMinus = "y";

		if($this->get_rows() > 0) {
			$data = array(
				"table" => "program_setting",
				"where" => "uid=1",
				"compulsionWork" => $compulsionWork,
				"autoIn" => $autoIn,
				"autoRelease" => $autoRelease,
				"autoItemMinus" => $autoItemMinus
				
			);
			$this->update($data);
		} else {
			$data = array(
				"table" => "program_setting",
				"compulsionWork" => $compulsionWork,
				"autoIn" => $autoIn,
				"autoRelease" => $autoRelease,
				"autoItemMinus" => $autoItemMinus
			);
			$this->insert($data);
		}
	}

	// 사용메뉴 등록
	public function registMenuSetting(){	
		$sql = "select * from menu_setting";
		$this->query($sql);

		if($_POST['base'] == "") $base = "n"; else $base = "y";
		if($_POST['sales'] == "") $sales = "n"; else $sales = "y";
		if($_POST['production'] == "") $production = "n"; else $production = "y";
		if($_POST['qc'] == "") $qc = "n"; else $qc = "y";
		if($_POST['outsourcing'] == "") $outsourcing = "n"; else $outsourcing = "y";
		if($_POST['purchase'] == "") $purchase = "n"; else $purchase = "y";
		if($_POST['release'] == "") $release = "n"; else $release = "y";
		if($_POST['items'] == "") $items = "n"; else $items = "y";
		if($_POST['mold'] == "") $mold = "n"; else $mold = "y";
		if($_POST['machine'] == "") $machine = "n"; else $machine = "y";
		if($_POST['wage'] == "") $wage = "n"; else $wage = "y";
		if($_POST['groupware'] == "") $groupware = "n"; else $groupware = "y";
		if($_POST['accounting'] == "") $accounting = "n"; else $accounting = "y";
		//if($_POST['compulsionWork'] == "") $compulsionWork = "n"; else $compulsionWork = "y";
		//if($_POST['compulsionWork'] == "") $compulsionWork = "n"; else $compulsionWork = "y";

		if($this->get_rows() > 0) {
			$data = array(
				"table" => "menu_setting",
				"where" => "uid=1",
				"base" => $base,
				"sales" => $sales,
				"production" => $production,
				"qc" => $qc,
				"outsourcing" => $outsourcing,
				"purchase" => $purchase,
				"releases" => $release,
				"items" => $items,
				"mold" => $mold,
				"machine" => $machine,
				"wage" => $wage,
				"groupware" => $groupware,
				"accounting" => $accounting
			);			

			$this->update($data);
		} else {
			$data = array(
				"table" => "menu_setting",
				"base" => $base,
				"sales" => $sales,
				"production" => $production,
				"qc" => $qc,
				"outsourcing" => $outsourcing,
				"purchase" => $purchase,
				"releases" => $release,
				"items" => $items,
				"mold" => $mold,
				"machine" => $machine,
				"wage" => $wage,
				"groupware" => $groupware,
				"accounting" => $accounting
			);

			//var_dump($data);

			$this->insert($data);
		}
	}

/*****************************************************************************************************************************/
// 기준정보관리
/*****************************************************************************************************************************/
	// 창고 등록
	public function registWarehouse() {
		if(empty($this->parameter['uid'])) {
			$data = array(
				"table" => "warehouse",
				"warehouse_nm" => $this->parameter['warehouse_nm']
			);
			$this->insert($data);

			$uid = mysql_insert_id();

			// 창고 DB 생성
			$sql = "
				CREATE TABLE `warehouse_$uid` (
					`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
					`fid` INT(11) NULL DEFAULT NULL COMMENT 'warehouse uid',
					`classify` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목구분',
					`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
					`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목명',
					`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
					`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
					`cnt` INT(11) NULL DEFAULT NULL COMMENT '수량',
					`lot_no` VARCHAR(50) NULL DEFAULT NULL COMMENT 'LotNo',
					`create_dt` DATETIME NULL DEFAULT NULL COMMENT '입고일',
					PRIMARY KEY (`uid`),
					INDEX `fid` (`fid`),
					INDEX `item_cd` (`item_cd`),
					INDEX `standard` (`standard`),
					INDEX `lot_no` (`lot_no`)
				)
				COLLATE='utf8_general_ci'
				ENGINE=InnoDB
				;
			";

			$this->query($sql);
		} else {
			$data = array(
				"table" => "warehouse",
				"where" => "uid=".$this->parameter['uid'],
				"warehouse_nm" => $this->parameter['warehouse_nm']
			);
			$this->update($data);
		}
	}

	// 창고리스트 가져오기
	public function getWarehouseList() {
		$json = new Services_JSON();
			
		$sql = "select * from warehouse order by uid asc";
		$this->query($sql);
	
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$i++;
		}
	
		echo $json->encode($re);
	}

	// 2차 품목 등록
	public function registItem() {
		if($this->parameter['uid'] == "") {
			$sql = "select uid from item where item_cd='".$this->parameter['item_cd']."'";
			$this->query($sql);
			if($this->get_rows() > 0){
				echo "dupp";
				exit;
			}
		}
		
		// 콤마 없애기
		$cnt = $this->replaceComma($this->parameter['cnt']);
		$price = $this->replaceComma($this->parameter['price']);
		$safety_stock_cnt = $this->replaceComma($this->parameter['safety_stock_cnt']);

		// 업로드 파일이 없을 경우를 대비해야 함
		//$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('img');
		
		if($fileAttach == "none" && $this->parameter['old_img'] != "") {
			$fileAttach = $this->parameter['old_img'];
		}

		if(!isset($_POST['barcode'])) $barcode = $_POST['item_cd'];
		else $barcode = $_POST['barcode'];
		
		if($this->parameter['uid'] == "") {
			$data = array (
				"table" => "item",
				"classify" => $this->parameter['classify'],
				"group_cd" => $_POST['group_cd'],
				"item_cd" => $this->parameter['item_cd'],
				"item_nm" => $this->parameter['item_nm'],
				"standard" => $this->parameter['standard'],
				"unit" => $this->parameter['unit'],
				"delivery_period" => $this->parameter['delivery_period'],
				"cnt" => $cnt,
				"price" => $price,
				"safety_stock_cnt" =>$safety_stock_cnt,
				"barcode" => $barcode,
				"img" => $fileAttach,
				"lot_no" => $this->parameter['lot_no']
			);

			$this->insert($data);

			
			$fid = $this->getUid();

			// 기초재고수량이 있다면 입고창고에 해당 품목을 입고 시킨다.
			if($cnt > 0) {
				// 창고명 정의
				$warehouse = "warehouse_".$this->parameter['warehouse_cd'];

				// 해당 창고에 해당 품목이 있나 확인
				$sql = "select * from ".$warehouse." where item_cd='".$this->parameter['item_cd']."' and standard='".$this->parameter['standard']."'";
				$this->query($sql);

				if($this->get_rows() > 0) { // 해당 창고에 해당 품목이 있다면
					// 처음 등록하는 것이라 해당 품목은 없을 듯
				} else {
					$data = array(
						"table" => $warehouse,
						"fid" => $this->parameter['warehouse_cd'],
						"classify" => $this->parameter['classify'],
						"item_cd" => $this->parameter['item_cd'],
						"item_nm" => $this->parameter['item_nm'],
						"standard" => $this->parameter['standard'],
						"unit" => $this->parameter['unit'],
						"cnt" => $cnt,
						"lot_no" => $this->parameter['lot_no']
					);

					$result = $this->insert($data);
					
					// 기초재고수량이 입고된 창고를 저장한다
					$sql = "update item set warehouse_cd=".$this->parameter['warehouse_cd']." where uid=".$fid;
					$this->query($sql);

					$this->registInOut("in","기초자료입고",$this->parameter['item_cd'],$cnt,$price);
				}
			}
		} else {
			$data = array (
				"table" => "item",
				"where" => "uid=".$this->parameter['uid'],
				"classify" => $this->parameter['classify'],
				"group_cd" => $_POST['group_cd'],
				"item_cd" => $this->parameter['item_cd'],
				"item_nm" => $this->parameter['item_nm'],
				"standard" => $this->parameter['standard'],
				"unit" => $this->parameter['unit'],
				"delivery_period" => $this->parameter['delivery_period'],
				"cnt" => $cnt,
				"cnt" => $price,
				"price" => $price,
				"safety_stock_cnt" =>$safety_stock_cnt,
				"barcode" => $barcode,
				"img" => $fileAttach,
				"lot_no" => $this->parameter['lot_no']
			);

			$this->update($data);
		}

		//if($cnt > 0) $fid = $this->stockIn($gid, $stock_cnt, $_POST['warehouse_cd']);
		//$this->registReason($gid, $fid, $stock_cnt, 0, "기준정보등록");
		//$this->registPrice($gid, $fid, $purchase_price, $sale_price);

		if($result) echo "success";
	}

	// 2차 프로젝트 리스트 가져오기
	public function getProjectList() {
		$json = new Services_JSON();
		$this->getTable("project", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		
		$i = 0;
		while($t = $this->fetch()) {
			$period = substr($t->start_dt,0,10)." ~ ".substr($t->end_dt,0,10);
			$re[$i]['uid'] = $t->uid;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['start_dt'] = substr($t->start_dt, 0, 10);
			$re[$i]['end_dt'] = substr($t->end_dt, 0, 10);
			$re[$i]['period'] = $period;
			$i++;
		}

		echo $json->encode($re);
	}

	// 2차 거래처별 품목단가 등록
	public function registItemCost() {
		$purchase_price = $this->replaceComma($this->parameter['purchase_price']);
		$sale_price = $this->replaceComma($this->parameter['sale_price']);

		if($purchase_price == "") $purchase_price = 0;
		if($sale_price == "") $sale_price = 0;

		$data = array(
			"table" => "item_cost",
			"item_uid" => $this->parameter['item_uid'],
			"account_uid" => $this->parameter['account_uid'],
			"purchase_price" => $purchase_price,
			"sale_price" => $sale_price,
			"create_dt" => $this->now
		);
		$result = $this->insert($data);
		if($result) echo "success";
	}
	
	// 2차 거래처별 품목 단가 가져오기
	public function getItemCost() {
		$json = new Services_JSON;

		$sql = "select * from item_cost where item_uid=".$this->parameter['item_uid']." and account_uid=".$this->parameter['account_uid']." order by uid desc";
		//echo $sql;
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$sql = "select * from item where uid=".$t->item_uid;
			$this->sub_query($sql);
			$item = $this->sub_fetch();
			
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_uid'] = $t->item_uid;
			$re[$i]['account_uid'] = $t->account_uid;
			$re[$i]['item_cd'] = $item->item_cd;
			$re[$i]['item_nm'] = $item->item_nm;
			$re[$i]['standard'] = $item->standard;
			$re[$i]['unit'] = $item->unit;
			$re[$i]['purchase_price'] = $t->purchase_price;
			$re[$i]['sale_price'] = $t->sale_price;
			$re[$i]['create_dt'] = substr($t->create_dt, 0, 10);
			$i++;
		}
		echo $json->encode($re);
	}

	// 품목구분 등록
	public function registItemClassify() {
		if(empty($this->parameter['uid'])) {
			$data = array(
				"table" => "item_classify",
				"classify_nm" => $this->parameter['classify_nm'],
				"seq" => $this->parameter['seq']
			);
			$result = $this->insert($data);
		} else {
			$data = array(
				"table" => "item_classify",
				"where" => "uid=".$this->parameter['uid'],
				"classify_nm" => $this->parameter['classify_nm'],
				"seq" => $this->parameter['seq']
			);
			$result = $this->update($data);
		}

		if($result) echo "success";
	}

	// 품목구분 가져오기
	public function getItemClassifyList() {
		$json = new Services_JSON();

		$sql = "select * from item_classify order by seq asc";
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['classify_nm'] = $t->classify_nm;
			$re[$i]['seq'] = $t->seq;
			$i++;
		}
		echo $json->encode($re);
	}

	// 품목그룹 가져오기
	public function getItemGroupList() {
		$json = new Services_JSON();

		$sql = "select * from item_group order by seq asc";
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['group_nm'] = $t->group_nm;
			$re[$i]['seq'] = $t->seq;
			$i++;
		}
		echo $json->encode($re);
	}

	// 품목그룹 등록
	public function registItemGroup() {
		if(empty($this->parameter['uid'])) {
			$data = array(
				"table" => "item_group",
				"group_nm" => $this->parameter['group_nm'],
				"seq" => $this->parameter['seq']
			);
			$result = $this->insert($data);
		} else {
			$data = array(
				"table" => "item_group",
				"where" => "uid=".$this->parameter['uid'],
				"group_nm" => $this->parameter['group_nm'],
				"seq" => $this->parameter['seq']
			);
			$result = $this->update($data);
		}

		if($result) echo "success";
	}

	// 품목 리스트 가져오기
	public function getItemList() {
		$json = new Services_JSON();
		$where = str_replace("@","%",$this->parameter['where']);
		$this->getTable("item", $where, $this->parameter['rpp'], $this->parameter['page']);
		//$sql = "select * from item ".$this->parameter['where'];
		//echo $where;
		//$this->query($sql);
		
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['classify_nm'] = $this->getCompareName("item_classify","classify_nm","uid",$t->classify);
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['delivery_period'] = $t->delivery_period;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['safety_stock_cnt'] = $t->safety_stock_cnt;
			$re[$i]['group_nm'] = $this->convertNull($this->getCompareName("item_group","group_nm","uid",$t->group_cd));
			$re[$i]['group_cd'] = $t->group_cd;
			// 바코드 이미지 가져오기
			$url = "https://www.barcodesinc.com/generator/image.php?code=".$t->barcode."&style=196&type=C128B&width=167&height=70&xres=1&font=3";
			$img = "<img src='$url'>";
											
			$re[$i]['barcode'] = $t->barcode;
			$re[$i]['img'] = $t->img;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['lot_no'] = $this->convertNull($t->lot_no);
			$i++;
		}

		echo $json->encode($re);

	}

	// 거래처 가져오기
	public function getAccountList() {
		$json = new Services_JSON();
		$where = str_replace("@","%",$this->parameter['where']);
		$this->getTable("account", $where, $this->parameter['rpp'], $this->parameter['page']);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['classify_nm'] = $this->getCompareName("account_classify","classify_nm","uid",$t->classify);
			$re[$i]['outsourcing'] = $t->outsourcing;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['owner'] = $t->owner;
			$re[$i]['owner_mobile'] = $this->convertNull($t->owner_mobile);
			$re[$i]['corp_reg_no'] = $this->convertNull($t->corp_reg_no);
			$re[$i]['corp_no'] = $this->convertNull($t->corp_no);
			$re[$i]['corp_condition'] = $this->convertNull($t->corp_condition);
			$re[$i]['corp_event'] = $this->convertNull($t->corp_event);
			$re[$i]['corp_phone'] = $this->convertNull($t->corp_phone);
			$re[$i]['corp_fax'] = $this->convertNull($t->corp_fax);
			$re[$i]['corp_email'] = $this->convertNull($t->corp_email);
			$re[$i]['corp_zipcode'] = $this->convertNull($t->corp_zipcode);
			$re[$i]['corp_address'] = $this->convertNull($t->corp_address);
			$re[$i]['manager'] = $this->convertNull($t->manager);
			$re[$i]['bank'] = $this->convertNull($t->bank);
			$re[$i]['account'] = $this->convertNull($t->account);
			$re[$i]['account_holder'] = $this->convertNull($t->account_holder);
			$re[$i]['account_id'] = $this->convertNull($t->account_id);
			$re[$i]['account_pwd'] = $this->convertNull($t->account_pwd);
			$re[$i]['create_dt'] = $t->create_dt;

			$sql = "select * from warehouse";
			$this->sub_query($sql);
			$warehouse = $this->sub_fetch();

			$re[$i]['warehouse_cd'] = $this->convertNull($warehouse->uid);
			$re[$i]['warehouse_nm'] = $this->convertNull($warehouse->warehouse_nm);
			$i++;
		}

		echo $json->encode($re);
	}

	// 품목 매입처 등록
	public function registItemAccount() {
		// 중복확인
		$sql = "select uid from item_account where item_fid=".$this->parameter['item_uid']." and account_fid=".$this->parameter['account_uid'];
		$this->query($sql);
		if($this->get_rows() > 0) {
			echo "dupp";
			exit;
		}

		$sql = "select * from item where uid=".$this->parameter['item_uid'];
		$this->query($sql);
		$item = $this->fetch();
		
		$sql = "select * from account where uid=".$this->parameter['account_uid'];
		$this->query($sql);
		$account = $this->fetch();

		$data = array(
			"table" => "item_account",
			"item_fid" => $this->parameter['item_uid'],
			"account_fid" => $this->parameter['account_uid'],
			"item_cd" => $item->item_cd,
			"item_nm" => $item->item_nm,
			"standard" => $item->standard,
			"unit" => $item->unit,
			"account_cd" => $account->account_cd,
			"account_nm" => $account->account_nm,
			"moq" => 0
		);

		$result = $this->insert($data);
		if($result) echo "success";
	}

	// 매입처별 품목 리스트 가져오기
	public function getAccountItemList() {
		$json = new Services_JSON;
		$sql = "select * from item_account where account_fid=".$this->parameter['account_uid'];
		$this->query($sql);
		
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_fid'] = $t->item_fid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$i++;
		}

		echo $json->encode($re);
	}

	// 품목매입처 리스트 가져오기
	public function getItemAccount() {
		$json = new Services_JSON;
		$sql = "select * from item_account where item_fid=".$this->parameter['item_uid'];
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$sql = "select classify from account where uid=".$t->account_fid;
			$this->sub_query($sql);
			$account = $this->sub_fetch();

			$re[$i]['classify_nm'] = $this->getCompareName("account_classify","classify_nm","uid",$account->classify);

			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_fid'] = $t->item_fid;
			$re[$i]['account_fid'] = $t->account_fid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['moq'] = $t->moq;
			$i++;
		}

		echo $json->encode($re);
	}

	// 품목 제조공정 리스트
	public function getItemProcessList() {
		$json = new Services_JSON;
		$sql = "select * from item_process where fid=".$this->parameter['item_uid'];
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$sql = "select * from process";
			$this->sub_query($sql);
			$process = "";
			$after_process = "";
			while($tt = $this->sub_fetch()) {
				if($t->process == $tt->uid) $sel = "selected"; else $sel = "";
				$process .= "<option value='".$tt->uid."' ".$sel.">".$tt->process_nm."</option>";

				if($t->after_process == $tt->uid) $sel = "selected"; else $sel = "";
				$after_process .= "<option value='".$tt->uid."' ".$sel.">".$tt->process_nm."</option>";
			}
			
			if($t->process == 999) $sel = "selected"; else $sel = "";
			$process .= "<option value='999' ".$sel.">없음</option>";
			if($t->after_process == 999) $sel = "selected"; else $sel = "";
			$after_process .= "<option value='999' ".$sel.">없음</option>";

			$sql = "select * from item where uid=".$t->item_uid;
			$this->sub_query($sql);
			$item = $this->sub_fetch();

			$re[$i]['uid'] = $t->uid;
			$re[$i]['no'] = $t->no;
			$re[$i]['item_uid'] = $t->item_uid;
			$re[$i]['item_cd'] = $item->item_cd;
			$re[$i]['item_nm'] = $item->item_nm;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['process'] = $process;
			$re[$i]['outsourcing'] = $t->outsourcing;
			$re[$i]['after_process'] = $after_process;
			$i++;
		}

		echo $json->encode($re);
	}

	// 직원권한 설정
	public function registAuthority(){
		$sql = "select uid from user_auth where emp_id='".$this->parameter['user']."'";
		$this->query($sql);
		if($this->get_rows() > 0){
			$data = array(
				"table" => "user_auth",
				"where" => "emp_id='".$this->parameter['user']."'",
				"frmItemClassify" => $this->parameter['frmItemClassify'],
				"frmItemGroup" => $this->parameter['frmItemGroup'],
				"frmItemBuyer" => $this->parameter['frmItemBuyer'],
				"frmItemCost" => $this->parameter['frmItemCost'],
				"frmItemProcess" => $this->parameter['frmItemProcess'],
				"frmItem" => $this->parameter['frmItem'],
				"frmAccountClassify" => $this->parameter['frmAccountClassify'],
				"frmAccount" => $this->parameter['frmAccount'],
				"frmDepartment" => $this->parameter['frmDepartment'],
				"frmPosition" => $this->parameter['frmPosition'],
				"frmEmployee" => $this->parameter['frmEmployee'],
				"frmWarehouse" => $this->parameter['frmWarehouse'],
				"frmProcess" => $this->parameter['frmProcess'],
				"frmMachine" => $this->parameter['frmMachine'],
				"frmTeam" => $this->parameter['frmTeam'],
				"frmProject" => $this->parameter['frmProject'],
				"frmRentcar" => $this->parameter['frmRentcar'],
				"frmRentcarCost" => $this->parameter['frmRentcarCost'],
				"frmExcel" => $this->parameter['frmExcel'],
				"frmEstimate" => $this->parameter['frmEstimate'],
				"frmObtainOrder" => $this->parameter['frmObtainOrder'],
				"frmObtainOrderShipment" => $this->parameter['frmObtainOrderShipment'],
				"frmAs" => $this->parameter['frmAs'],
				"frmWorkPlan" => $this->parameter['frmWorkPlan'],
				"frmWorkPlanWeek" => $this->parameter['frmWorkPlanWeek'],
				"frmProductSchedule" => $this->parameter['frmProductSchedule'],
				"frmWorkOrder" => $this->parameter['frmWorkOrder'],
				"frmWorkCurrentState" => $this->parameter['frmWorkCurrentState'],
				"frmWorkDaily" => $this->parameter['frmWorkDaily'],
				"frmQcClassify" => $this->parameter['frmQcClassify'],
				"frmQc" => $this->parameter['frmQc'],
				"frmOutsourcingRequest" => $this->parameter['frmOutsourcingRequest'],
				"frmOutsourcingItem" => $this->parameter['frmOutsourcingItem'],
				"frmBringinMaterial" => $this->parameter['frmBringinMaterial'],
				"frmOutsourcing" => $this->parameter['frmOutsourcing'],
				"frmBringinMaterialPurchase" => $this->parameter['frmBringinMaterialPurchase'],
				"frmOutsourcingItemPurchase" => $this->parameter['frmOutsourcingItemPurchase'],
				"frmBringinMaterialRelease" => $this->parameter['frmBringinMaterialRelease'],
				"frmOutsourcingWarehouse" => $this->parameter['frmOutsourcingWarehouse'],
				"frmPurchase" => $this->parameter['frmPurchase'],
				"frmEasyPurchase" => $this->parameter['frmEasyPurchase'],
				"frmOrder" => $this->parameter['frmOrder'],
				"frmWarehousing" => $this->parameter['frmWarehousing'],
				"frmShipmentOrder" => $this->parameter['frmShipmentOrder'],
				"frmRelease" => $this->parameter['frmRelease'],
				"frmInOut" => $this->parameter['frmInOut'],
				"frmWarehouseStock" => $this->parameter['frmWarehouseStock'],
				"frmCurrentStock" => $this->parameter['frmCurrentStock'],
				"frmReleaseWarehouse" => $this->parameter['frmReleaseWarehouse'],
				"frmProcessStock" => $this->parameter['frmProcessStock'],
				"frmBarcode" => $this->parameter['frmBarcode'],
				"frmStock" => $this->parameter['frmStock'],
				"frmSafetyStock" => $this->parameter['frmSafetyStock'],
				"frmApprovalLine" => $this->parameter['frmApprovalLine'],
				"frmMyApproval" => $this->parameter['frmMyApproval'],
				"frmApproval" => $this->parameter['frmApproval'],
				"frmApprovalDocument" => $this->parameter['frmApprovalDocument'],
				"frmSpendingResolution" => $this->parameter['frmSpendingResolution'],
				"frmAccountSubject" => $this->parameter['frmAccountSubject'],
				"frmBoard" => $this->parameter['frmBoard'],
				"frmSchedule" => $this->parameter['frmSchedule'],
				"frmFile" => $this->parameter['frmFile']
			);
			$this->update($data);
		} else {
			$data = array(
				"table" => "user_auth",
				"emp_id" => $this->parameter['user'],
				"frmItemClassify" => $this->parameter['frmItemClassify'],
				"frmItemGroup" => $this->parameter['frmItemGroup'],
				"frmItemBuyer" => $this->parameter['frmItemBuyer'],
				"frmItemCost" => $this->parameter['frmItemCost'],
				"frmItemProcess" => $this->parameter['frmItemProcess'],
				"frmItem" => $this->parameter['frmItem'],
				"frmAccountClassify" => $this->parameter['frmAccountClassify'],
				"frmAccount" => $this->parameter['frmAccount'],
				"frmDepartment" => $this->parameter['frmDepartment'],
				"frmPosition" => $this->parameter['frmPosition'],
				"frmEmployee" => $this->parameter['frmEmployee'],
				"frmWarehouse" => $this->parameter['frmWarehouse'],
				"frmProcess" => $this->parameter['frmProcess'],
				"frmMachine" => $this->parameter['frmMachine'],
				"frmTeam" => $this->parameter['frmTeam'],
				"frmProject" => $this->parameter['frmProject'],
				"frmRentcar" => $this->parameter['frmRentcar'],
				"frmRentcarCost" => $this->parameter['frmRentcarCost'],
				"frmExcel" => $this->parameter['frmExcel'],
				"frmEstimate" => $this->parameter['frmEstimate'],
				"frmObtainOrder" => $this->parameter['frmObtainOrder'],
				"frmObtainOrderShipment" => $this->parameter['frmObtainOrderShipment'],
				"frmAs" => $this->parameter['frmAs'],
				"frmWorkPlan" => $this->parameter['frmWorkPlan'],
				"frmWorkPlanWeek" => $this->parameter['frmWorkPlanWeek'],
				"frmProductSchedule" => $this->parameter['frmProductSchedule'],
				"frmWorkOrder" => $this->parameter['frmWorkOrder'],
				"frmWorkCurrentState" => $this->parameter['frmWorkCurrentState'],
				"frmWorkDaily" => $this->parameter['frmWorkDaily'],
				"frmQcClassify" => $this->parameter['frmQcClassify'],
				"frmQc" => $this->parameter['frmQc'],
				"frmOutsourcingRequest" => $this->parameter['frmOutsourcingRequest'],
				"frmOutsourcingItem" => $this->parameter['frmOutsourcingItem'],
				"frmBringinMaterial" => $this->parameter['frmBringinMaterial'],
				"frmOutsourcing" => $this->parameter['frmOutsourcing'],
				"frmBringinMaterialPurchase" => $this->parameter['frmBringinMaterialPurchase'],
				"frmOutsourcingItemPurchase" => $this->parameter['frmOutsourcingItemPurchase'],
				"frmBringinMaterialRelease" => $this->parameter['frmBringinMaterialRelease'],
				"frmOutsourcingWarehouse" => $this->parameter['frmOutsourcingWarehouse'],
				"frmPurchase" => $this->parameter['frmPurchase'],
				"frmEasyPurchase" => $this->parameter['frmEasyPurchase'],
				"frmOrder" => $this->parameter['frmOrder'],
				"frmWarehousing" => $this->parameter['frmWarehousing'],
				"frmShipmentOrder" => $this->parameter['frmShipmentOrder'],
				"frmRelease" => $this->parameter['frmRelease'],
				"frmInOut" => $this->parameter['frmInOut'],
				"frmWarehouseStock" => $this->parameter['frmWarehouseStock'],
				"frmCurrentStock" => $this->parameter['frmCurrentStock'],
				"frmReleaseWarehouse" => $this->parameter['frmReleaseWarehouse'],
				"frmProcessStock" => $this->parameter['frmProcessStock'],
				"frmBarcode" => $this->parameter['frmBarcode'],
				"frmStock" => $this->parameter['frmStock'],
				"frmSafetyStock" => $this->parameter['frmSafetyStock'],
				"frmApprovalLine" => $this->parameter['frmApprovalLine'],
				"frmMyApproval" => $this->parameter['frmMyApproval'],
				"frmApproval" => $this->parameter['frmApproval'],
				"frmApprovalDocument" => $this->parameter['frmApprovalDocument'],
				"frmSpendingResolution" => $this->parameter['frmSpendingResolution'],
				"frmAccountSubject" => $this->parameter['frmAccountSubject'],
				"frmBoard" => $this->parameter['frmBoard'],
				"frmSchedule" => $this->parameter['frmSchedule'],
				"frmFile" => $this->parameter['frmFile']
			);
			$this->insert($data);
		}

		//var_dump($data);
	}

	// 사원의 권한 가져오기
	public function getUserAuth(){
		$json = new Services_JSON;
		$sql = "select * from user_auth where emp_id='".$this->parameter['emp_id']."'";
		$this->query($sql);
		$t = $this->fetch();

		$re['frmItemClassify'] = $t->frmItemClassify;
		$re['frmItemGroup'] = $t->frmItemGroup;
		$re['frmItemBuyer'] = $t->frmItemBuyer;
		$re['frmItemCost'] = $t->frmItemCost;
		$re['frmItemProcess'] = $t->frmItemProcess;
		$re['frmItem'] = $t->frmItem;
		$re['frmAccountClassify'] = $t->frmAccountClassify;
		$re['frmAccount'] = $t->frmAccount;
		$re['frmDepartment'] = $t->frmDepartment;
		$re['frmPosition'] = $t->frmPosition;
		$re['frmEmployee'] = $t->frmEmployee;
		$re['frmWarehouse'] = $t->frmWarehouse;
		$re['frmProcess'] = $t->frmProcess;
		$re['frmMachine'] = $t->frmMachine;
		$re['frmTeam'] = $t->frmTeam;
		$re['frmProject'] = $t->frmProject;
		$re['frmRentcar'] = $t->frmRentcar;
		$re['frmRentcarCost'] = $t->frmRentcarCost;
		$re['frmExcel'] = $t->frmExcel;
		$re['frmEstimate'] = $t->frmEstimate;
		$re['frmObtainOrder'] = $t->frmObtainOrder;
		$re['frmObtainOrderShipment'] = $t->frmObtainOrderShipment;
		$re['frmAs'] = $t->frmAs;
		$re['frmWorkPlan'] = $t->frmWorkPlan;
		$re['frmWorkPlanWeek'] = $t->frmWorkPlanWeek;
		$re['frmProductSchedule'] = $t->frmProductSchedule;
		$re['frmWorkOrder'] = $t->frmWorkOrder;
		$re['frmWorkCurrentState'] = $t->frmWorkCurrentState;
		$re['frmWorkDaily'] = $t->frmWorkDaily;
		$re['frmQcClassify'] = $t->frmQcClassify;
		$re['frmQc'] = $t->frmQc;
		$re['frmOutsourcingRequest'] = $t->frmOutsourcingRequest;
		$re['frmOutsourcingItem'] = $t->frmOutsourcingItem;
		$re['frmBringinMaterial'] = $t->frmBringinMaterial;
		$re['frmOutsourcing'] = $t->frmOutsourcing;
		$re['frmBringinMaterialPurchase'] = $t->frmBringinMaterialPurchase;
		$re['frmOutsourcingItemPurchase'] = $t->frmOutsourcingItemPurchase;
		$re['frmBringinMaterialRelease'] = $t->frmBringinMaterialRelease;
		$re['frmOutsourcingWarehouse'] = $t->frmOutsourcingWarehouse;
		$re['frmPurchase'] = $t->frmPurchase;
		$re['frmEasyPurchase'] = $t->frmEasyPurchase;
		$re['frmOrder'] = $t->frmOrder;
		$re['frmWarehousing'] = $t->frmWarehousing;
		$re['frmShipmentOrder'] = $t->frmShipmentOrder;
		$re['frmRelease'] = $t->frmRelease;
		$re['frmInOut'] = $t->frmInOut;
		$re['frmWarehouseStock'] = $t->frmWarehouseStock;
		$re['frmCurrentStock'] = $t->frmCurrentStock;
		$re['frmReleaseWarehouse'] = $t->frmReleaseWarehouse;
		$re['frmProcessStock'] = $t->frmProcessStock;
		$re['frmBarcode'] = $t->frmBarcode;
		$re['frmStock'] = $t->frmStock;
		$re['frmSafetyStock'] = $t->frmSafetyStock;
		$re['frmApprovalLine'] = $t->frmApprovalLine;
		$re['frmMyApproval'] = $t->frmMyApproval;
		$re['frmApproval'] = $t->frmApproval;
		$re['frmApprovalDocument'] = $t->frmApprovalDocument;
		$re['frmSpendingResolution'] = $t->frmSpendingResolution;
		$re['frmAccountSubject'] = $t->frmAccountSubject;
		$re['frmBoard'] = $t->frmBoard;
		$re['frmSchedule'] = $t->frmSchedule;
		$re['frmFile'] = $t->frmFile;

		echo $json->encode($re);
	}

	// 2차 품목규격 등록
	public function registStandard() {
		$sql = "select uid from standard where item_cd='".$this->parameter['item_cd']."' and standard='".$this->parameter['standard']."'";
		$this->query($sql);
	
		if($this->get_rows() > 0) {
			echo "dupp";
		} else {
			$data = array(
				"table" => "standard",
				"item_cd" => $this->parameter['item_cd'],
				"standard" => $this->parameter['standard']
			);
	
			$result = $this->insert($data);
			if($result) echo "success";
		}
	}

	// 2차 품목등록 생산규격 리스트 함수
	public function getStandard() {
		$json = new Services_JSON;

		$sql = "select * from standard where item_cd='".$this->parameter['item_cd']."'";
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['standard'] = $t->standard;
			$i++;
		}

		echo $json->encode($re);
	}

	// 거래처 구분 가져오기
	public function getAccountClassifyList() {
		$json = new Services_JSON();

		$sql = "select * from account_classify order by seq asc";
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['classify_nm'] = $t->classify_nm;
			$re[$i]['seq'] = $t->seq;

			$i++;
		}

		echo $json->encode($re);
	}
	
	// 거래처 구분 등록하기
	public function registAccountClassify() {
		if($this->parameter['uid'] != "") {
			$data = array (
				"table" => "account_classify",
				"where" => "uid=".$this->parameter['uid'],
				"classify_nm" => $this->parameter['classify_nm'],
				"seq" => $this->parameter['seq']
			);

			$result = $this->update($data);
		} else {
			$data = array (
				"table" => "account_classify",
				"classify_nm" => $this->parameter['classify_nm'],
				"seq" => $this->parameter['seq']
			);

			$result = $this->insert($data);
		}
		
		if($result) echo "success";
	}

	// 거래처코드
	public function createAccountCode() {
		echo time();
	}

	// 거래처 등록 실행
	public function registAccount(){
		$owner_mobile = $this->convertMobileNumber($this->parameter['owner_mobile']);
		$corp_phone = $this->convertMobileNumber($this->parameter['corp_phone']);
		$corp_fax = $this->convertMobileNumber($this->parameter['corp_fax']);
		
		if($this->parameter['uid'] == "") {
			$data = array(
				"table" => "account",
				"classify" => $this->parameter['classify'],
				"outsourcing" => $this->parameter['outsourcing'],
				"account_cd" => $this->parameter['account_cd'],
				"account_nm" => $this->parameter['account_nm'],
				"owner" => $this->parameter['owner'],
				"owner_mobile" => $owner_mobile,
				"corp_no" => $this->parameter['corp_no'],
				"corp_reg_no" => $this->parameter['corp_reg_no'],
				"corp_condition" => $this->parameter['corp_condition'],
				"corp_event" => $this->parameter['corp_event'],
				"corp_phone" => $corp_phone,
				"corp_fax" => $corp_fax,
				"corp_email" => $this->parameter['corp_email'],
				"corp_zipcode" => $this->parameter['corp_zipcode'],
				"corp_address" => $this->parameter['corp_address'],
				"manager" => $this->parameter['manager'],
				"bank" => $this->parameter['bank'],
				"account" => $this->parameter['account'],
				"account_holder" => $this->parameter['account_holder'],
				"account_id" => $this->parameter['account_id'],
				"account_pwd" => $this->parameter['account_pwd']
			);

			$result = $this->insert($data);
		} else {
			$data = array(
				"table" => "account",
				"where" => "uid=".$this->parameter['uid'],
				"classify" => $this->parameter['classify'],
				"outsourcing" => $this->parameter['outsourcing'],
				"account_cd" => $this->parameter['account_cd'],
				"account_nm" => $this->parameter['account_nm'],
				"owner" => $this->parameter['owner'],
				"owner_mobile" => $owner_mobile,
				"corp_no" => $this->parameter['corp_no'],
				"corp_reg_no" => $this->parameter['corp_reg_no'],
				"corp_condition" => $this->parameter['corp_condition'],
				"corp_event" => $this->parameter['corp_event'],
				"corp_phone" => $corp_phone,
				"corp_fax" => $corp_fax,
				"corp_email" => $this->parameter['corp_email'],
				"corp_zipcode" => $this->parameter['corp_zipcode'],
				"corp_address" => $this->parameter['corp_address'],
				"manager" => $this->parameter['manager'],
				"bank" => $this->parameter['bank'],
				"account" => $this->parameter['account'],
				"account_holder" => $this->parameter['account_holder'],
				"account_id" => $this->parameter['account_id'],
				"account_pwd" => $this->parameter['account_pwd']
			);

			$result = $this->update($data);
		}

		if($result) echo "success";
	}

	// 대부서가져오기
	public function getBigDepartment() {
		$json = new Services_JSON();

		$sql = "select * from department_big order by seq asc";
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['department_nm'] = $t->department_nm;
			$re[$i]['seq'] = $t->seq;
			$i++;
		}

		echo $json->encode($re);
	}

	// 중부서 가져오기
	public function getMiddleDepartment() {
		$json = new Services_JSON();

		$sql = "select * from department_middle where fid=".$this->parameter['fid'];
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['department_nm'] = $t->department_nm;
			$re[$i]['seq'] = $t->seq;
			$i++;
		}

		echo $json->encode($re);
	}

	// 소부서 가져오기
	public function getSmallDepartment() {
		$json = new Services_JSON;

		$sql = "select * from department_small where fid=".$this->parameter['fid'];
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['department_nm'] = $t->department_nm;
			$re[$i]['seq'] = $t->seq;
			$i++;
		}

		echo $json->encode($re);
	}

	// 대부서 기록
	public function registBigDepartment() {
		if(!empty($this->parameter['uid'])) {
			$data = array(
				"table" => "department_big",
				"where" => "uid=".$this->parameter['uid'],
				"department_nm" => $this->parameter['department_nm'],
				"seq" => $this->parameter['seq']
			);
			$this->update($data);
		} else {
			$data = array(
				"table" => "department_big",
				"department_nm" => $this->parameter['department_nm'],
				"seq" => $this->parameter['seq']
			);
			$this->insert($data);
		}
	}

	// 중부서 기록
	public function registMiddleDepartment() {
		if(!empty($this->parameter['uid'])) {
			$data = array(
				"table" => "department_middle",
				"where" => "uid=".$this->parameter['uid'],
				"department_nm" => $this->parameter['department_nm'],
				"seq" => $this->parameter['seq']
			);
			$this->update($data);
		} else {
			$data = array(
				"table" => "department_middle",
				"fid" => $this->parameter['fid'],
				"department_nm" => $this->parameter['department_nm'],
				"seq" => $this->parameter['seq']
			);
			$this->insert($data);
		}
	}

	// 소부서 기록
	public function registSmallDepartment() {
		if(!empty($this->parameter['uid'])) {
			$data = array(
				"table" => "department_small",
				"where" => "uid=".$this->parameter['uid'],
				"department_nm" => $this->parameter['department_nm'],
				"seq" => $this->parameter['seq']
			);
			$this->update($data);
		} else {
			$data = array(
				"table" => "department_small",
				"fid" => $this->parameter['fid'],
				"department_nm" => $this->parameter['department_nm'],
				"seq" => $this->parameter['seq']
			);
			$this->insert($data);
		}
	}

	// 대부서 삭제
	public function deleteBigDepartment() {
		$sql = "select uid from department_middle where fid=".$this->parameter['uid']." limit 1";
		$this->query($sql);

		$t = $this->fetch();

		if(!empty($t->uid)) {
			echo "son";
		} else {
			$sql = "delete from department_big where uid=".$this->parameter['uid'];
			$this->query($sql);
		}
	}

	// 중부서 삭제
	public function deleteMiddleDepartment() {
		$sql = "select uid from department_small where fid=".$this->parameter['uid']." limit 1";
		$this->query($sql);

		$t = $this->fetch();

		if(!empty($t->uid)) {
			echo "son";
		} else {
			$sql = "delete from department_middle where uid=".$this->parameter['uid'];
			$this->query($sql);
		}
	}

	// 소부서 삭제
	public function deleteSmallDepartment() {
		$sql = "delete from department_small where uid=".$this->parameter['uid'];
		$this->query($sql);
	}

	// 직위 가져오기
	public function getPosition() {
		$json = new Services_JSON();
		
		$sql = "select * from position order by seq asc";
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['position_nm'] = $t->position_nm;
			$re[$i]['seq'] = $t->seq;
			$i++;
		}

		echo $json->encode($re);
	}

	// 직위 등록
	public function registPosition() {
		if(empty($this->parameter['uid'])) {
			$data = array(
				"table" => "position",
				"position_nm" => $this->parameter['position_nm'],
				"seq" => $this->parameter['seq']
			);
			$this->insert($data);
		} else {
			$data = array(
				"table" => "position",
				"where" => "uid=".$this->parameter['uid'],
				"position_nm" => $this->parameter['position_nm'],
				"seq" => $this->parameter['seq']
			);
			$this->update($data);
		}
	}

	// 공정 등록
	public function registProcess() {
		if(empty($this->parameter['uid'])) {
			$data = array(
				"table" => "process",
				"process_nm" => $this->parameter['process_nm'],
				"qc" => $this->parameter['qc']
			);
			$this->insert($data);
			
			$uid = mysql_insert_id();

			// 공정용 창고 DB 생성
			$sql = "
				CREATE TABLE `process_warehouse_$uid` (
					`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
					`fid` INT(11) NULL DEFAULT NULL COMMENT 'process uid',
					`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
					`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목명',
					`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
					`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
					`cnt` INT(11) NULL DEFAULT NULL COMMENT '수량',
					`lot_no` VARCHAR(50) NULL DEFAULT NULL COMMENT 'lot no',
					`create_dt` DATETIME NULL DEFAULT NULL COMMENT '입고일',
					PRIMARY KEY (`uid`),
					INDEX `fid` (`fid`),
					INDEX `item_cd` (`item_cd`),
					INDEX `standard` (`standard`)
				)
				COLLATE='utf8_general_ci'
				ENGINE=InnoDB
				;
			";

			$result = $this->query($sql);
		} else {
			$data = array(
				"table" => "process",
				"where" => "uid=".$this->parameter['uid'],
				"process_nm" => $this->parameter['process_nm'],
				"qc" => $this->parameter['qc']
			);
			$result = $this->update($data);
		}

		if($result) echo "success";
	}

	// 공정 가져오기
	public function getProcess() {
		$json = new Services_JSON();
		
		$sql = "select * from process order by uid asc";
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['process_nm'] = $t->process_nm;
			$re[$i]['qc'] = $t->qc;
			$i++;
		}

		echo $json->encode($re);
	}

	// 공정에 딸린 기계가져오기
	public function getMachine() {
		$json = new Services_JSON();
		
		$sql = "select * from machine where process_cd=".$this->parameter['process']." order by uid asc";
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['machine_nm'] = $t->machine_nm;
			$i++;
		}

		echo $json->encode($re);
	}

	// 생산설비 가져오기
	public function getMachineList() {
		$json = new Services_JSON();
		
		$where = str_replace("@","%",$this->parameter['where']);
		$this->getTable("machine", $where, $this->parameter['rpp'], $this->parameter['page']);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['process_cd'] = $t->process_cd;
			$re[$i]['process_nm'] = $this->getName("process", "process_nm", $t->process_cd);
			$re[$i]['machine_nm'] = $t->machine_nm;
			$re[$i]['machine_no'] = $this->convertNull($t->machine_no);
			$i++;
		}

		echo $json->encode($re);
	}

	// 생산설비 등록
	public function registMachine() {
		if(empty($this->parameter['uid'])) {
			$data = array(
				"table" => "machine",
				"process_cd" => $this->parameter['process_cd'],
				"machine_nm" => $this->parameter['machine_nm'],
				"machine_no" => $this->parameter['machine_no']
			);
			$result = $this->insert($data);
		} else {
			$data = array(
				"table" => "machine",
				"where" => "uid=".$this->parameter['uid'],
				"process_cd" => $this->parameter['process_cd'],
				"machine_nm" => $this->parameter['machine_nm'],
				"machine_no" => $this->parameter['machine_no']
			);
			$result = $this->update($data);
		}

		if($result) echo "success";
	}

	// 생산팀 가져오기
	public function getTeamList() {
		$json = new Services_JSON;

		$sql = "select * from team";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['team_nm'] = $t->team_nm;
			$i++;
		}

		echo $json->encode($re);
	}

	// 생산팀 저장하기
	public function registTeam() {
		if($this->parameter['uid'] != "") {
			$data = array(
				"table" => "team",
				"where" => "uid=".$this->parameter['uid'],
				"team_nm" => $this->parameter['team_nm']
			);

			$result = $this->update($data);

		} else {
			$data = array(
				"table" => "team",
				"team_nm" => $this->parameter['team_nm']
			);

			$result = $this->insert($data);
		}

		if($result) echo "success";
	}

	// 용차 등록
	public function registRentcar() {
		$corp_phone = $this->convertMobileNumber($this->parameter['corp_phone']);
		$mobile = $this->convertMobileNumber($this->parameter['mobile']);
		$corp_fax = $this->convertMobileNumber($this->parameter['corp_fax']);
		
		if($this->parameter['uid'] == "") {
			$data = array (
				"table" => "rentcar",
				"owner" => $this->parameter['owner'],
				"corp_reg_no" => $this->parameter['corp_reg_no'],
				"corp_nm" => $this->parameter['corp_nm'],
				"corp_condition" => $this->parameter['corp_condition'],
				"corp_event" => $this->parameter['corp_event'],
				"corp_phone" => $corp_phone,
				"mobile" => $mobile,
				"corp_fax" => $corp_fax,
				"email" => $this->parameter['email'],
				"corp_zipcode" => $this->parameter['corp_zipcode'],
				"corp_address" => $this->parameter['corp_address'],
				"car_no" => $this->parameter['car_no'],
				"classify" => $this->parameter['classify'],
				"ton" => $this->parameter['ton'],
				"bank" => $this->parameter['bank'],
				"account_holder" => $this->parameter['account_holder'],
				"account" => $this->parameter['account']
			);
			$result = $this->insert($data);
		} else {
			$data = array (
				"table" => "rentcar",
				"where" => "uid=".$this->parameter['uid'],
				"owner" => $this->parameter['owner'],
				"corp_reg_no" => $this->parameter['corp_reg_no'],
				"corp_nm" => $this->parameter['corp_nm'],
				"corp_condition" => $this->parameter['corp_condition'],
				"corp_event" => $this->parameter['corp_event'],
				"corp_phone" => $corp_phone,
				"mobile" => $mobile,
				"corp_fax" => $corp_fax,
				"email" => $this->parameter['email'],
				"corp_zipcode" => $this->parameter['corp_zipcode'],
				"corp_address" => $this->parameter['corp_address'],
				"car_no" => $this->parameter['car_no'],
				"classify" => $this->parameter['classify'],
				"ton" => $this->parameter['ton'],
				"bank" => $this->parameter['bank'],
				"account_holder" => $this->parameter['account_holder'],
				"account" => $this->parameter['account']
			);
			$result = $this->update($data);		
		}

		if($result) echo "success";
	}

	// 용차리스트 가져오기
	public function getRentcarList() {
		$json = new Services_JSON;

		$this->getTable("rentcar", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['owner'] = $t->owner;
			$re[$i]['corp_reg_no'] = $t->corp_reg_no;
			$re[$i]['corp_nm'] = $t->corp_nm;
			$re[$i]['corp_condition'] = $t->corp_condition;
			$re[$i]['corp_event'] = $t->corp_event;
			$re[$i]['corp_phone'] = $t->corp_phone;
			$re[$i]['mobile'] = $t->mobile;
			$re[$i]['corp_fax'] = $t->corp_fax;
			$re[$i]['email'] = $t->email;
			$re[$i]['corp_zipcode'] = $t->corp_zipcode;
			$re[$i]['corp_address'] = $t->corp_address;
			$re[$i]['car_no'] = $t->car_no;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['ton'] = $t->ton;
			$re[$i]['bank'] = $t->bank;
			$re[$i]['account_holder'] = $t->account_holder;
			$re[$i]['account'] = $t->account;
			$i++;
		}
		echo $json->encode($re);
	}

	// 공정에 딸린 기계 가져오기
	public function getProductProcessMachine() {
		$json = new Services_JSON;
		$sql = "select * from machine ".$this->parameter['where'];
		
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['machine_nm'] = $t->machine_nm;
			$i++;
		}

		echo $json->encode($re);
	}

	// 용차리스트 가져오기
	public function getRentcarMiniList() {
		$json = new Services_JSON;

		$sql = "select * from rentcar";
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['owner'] = $t->owner;
			$re[$i]['corp_nm'] = $t->corp_nm;
			$re[$i]['car_no'] = $t->car_no;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['ton'] = $t->ton;
			
			$i++;
		}
		echo $json->encode($re);
	}

	// 용차요금 등록
	public function registRentcarCost() {
		if($this->parameter['uid'] == "") {
				$data = array(
					"table" => "rentcar_cost",
					"fid" => $this->parameter['fid'],
					"start_area" => $this->parameter['start_area'],
					"end_area" => $this->parameter['end_area'],
					"cost" => $this->replaceComma($this->parameter['cost'])
				);
				$this->insert($data);
		} else {
			$data = array(
				"table" => "rentcar_cost",
				"where" => "uid=".$this->parameter['uid'],
				"fid" => $this->parameter['fid'],
				"start_area" => $this->parameter['start_area'],
				"end_area" => $this->parameter['end_area'],
				"cost" => $this->replaceComma($this->parameter['cost'])
			);
			$this->update($data);
		}
	}

	// 용차요금 가져오기
	public function getRentcarCostList() {
		$json = new Services_JSON;
		$sql = "select * from rentcar_cost where fid=".$this->parameter['uid'];
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['fid'] = $t->fid;
			$re[$i]['start_area'] = $t->start_area;
			$re[$i]['end_area'] = $t->end_area;
			$re[$i]['cost'] = $t->cost;
			$i++;
		}

		echo $json->encode($re);
	}

	// 프로젝트 등록
	public function registProject() {
		if($this->parameter['uid'] == "") {
			$data = array(
				"table" => "project",
				"classify" => $this->parameter['classify'],
				"project_nm" => $this->parameter['project_nm'],
				"emp_id" => $this->parameter['emp_id'],
				"emp_nm" => $this->parameter['emp_nm'],
				"account_cd" => $this->parameter['account_cd'],
				"account_nm" => $this->parameter['account_nm'],
				"start_dt" => $this->parameter['start_dt'],
				"end_dt" => $this->parameter['end_dt']
			);

			$this->insert($data);
		} else {
			$data = array(
				"table" => "project",
				"where" => "uid=".$this->parameter['uid'],
				"classify" => $this->parameter['classify'],
				"project_nm" => $this->parameter['project_nm'],
				"emp_id" => $this->parameter['emp_id'],
				"emp_nm" => $this->parameter['emp_nm'],
				"account_cd" => $this->parameter['account_cd'],
				"account_nm" => $this->parameter['account_nm'],
				"start_dt" => $this->parameter['start_dt'],
				"end_dt" => $this->parameter['end_dt']
			);

			$result = $this->update($data);
		}
		
		if($result) echo "success";
	}

	// 생산팀원 추가
	public function moveTeam() {
		$array_uid = explode(",",$this->parameter['uids']);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			if(!empty($array_uid[$i])) {
				$sql = "select uid from team_member where employee_fid=".$array_uid[$i]." and fid=".$this->parameter['uid'];
				$this->query($sql);
				if($this->get_rows() <= 0) {
					$data = array(
						"table" => "team_member",
						"fid" => $this->parameter['uid'],
						"employee_fid" => $array_uid[$i]
					);

					$result = $this->insert($data);
				}
			}
		}
	}

	// 생산팀원 제외
	public function removeTeam() {
		$array_uid = explode(",",$this->parameter['uids']);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			if(!empty($array_uid[$i])) {
				$sql = "delete from team_member where uid=".$array_uid[$i];
				$this->query($sql);
			}
		}
	}

	// 생산팀원 가져오기
	public function getTeamMemberList() {
		$json = new Services_JSON();
		
		$sql = "select * from team_member where fid=".$this->parameter['uid'];
		$this->query($sql);
		
		$i = 0;
		while($tt = $this->fetch()) {
			$sql = "select * from employee where uid=".$tt->employee_fid;
			$this->sub_query($sql);
			$t = $this->sub_fetch();

			$department = $this->getName("department_middle","department_nm",$t->middle_department_cd)."-".$this->getName("department_small","department_nm",$t->small_department_cd);

			$re[$i]['uid'] = $tt->uid;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['emp_cd'] = $t->emp_cd;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_pwd'] = $t->emp_pwd;
			$re[$i]['gender'] = $t->gender;
			$re[$i]['regist_no'] = $t->regist_no;
			$re[$i]['mobile'] = $t->mobile;
			$re[$i]['telephone'] = $t->telephone;
			$re[$i]['email'] = $t->email;
			$re[$i]['join_dt'] = substr($t->join_dt,0,10);
			$re[$i]['resign_dt'] = substr($t->resign_dt,0,10);
			$re[$i]['department'] = $department;
			$re[$i]['position_cd'] = $this->getName("position","position_nm",$t->position_cd);
			$re[$i]['zipcode'] = $this->convertNull($t->zipcode);
			$re[$i]['address'] = $this->convertNull($t->address);
			$re[$i]['img'] = $t->img;
			$i++;
		}

		echo $json->encode($re);
	}

	// 사원 등록 실행
	public function registEmployee() {
		$mobile = $this->convertMobileNumber($this->parameter['mobile']);
		$telephone = $this->convertMobileNumber($this->parameter['telephone']);
		if($this->parameter['pay'] != "") $pay = $this->replaceComma($this->parameter['pay']);
		else $pay = 0;

		$fileAttach = $this->upload('img');
		if(empty($this->parameter['resign_dt'])) $classify = "work";
		else $classify = "resign";
		
		if($this->parameter['uid'] == "") {
			$data = array(
				"table" => "employee",
				"classify" => $classify,
				"emp_cd" => $this->parameter['emp_cd'],
				"emp_nm" => $this->parameter['emp_nm'],
				"emp_id" => $this->parameter['emp_id'],
				"emp_pwd" => $this->parameter['emp_pwd'],
				"gender" => $this->parameter['gender'],
				"regist_no" => $this->parameter['regist_no'],
				"mobile" => $mobile,
				"telephone" => $telephone,
				"email" => $this->parameter['email'],
				"join_dt" => $this->parameter['join_dt'],
				"resign_dt" => $this->parameter['resign_dt'],
				"big_department_cd" => $this->parameter['m_big_department_cd'],
				"middle_department_cd" => $this->parameter['m_middle_department_cd'],
				"small_department_cd" => $this->parameter['m_small_department_cd'],
				"position_cd" => $this->parameter['position_cd'],
				"zipcode" => $this->parameter['zipcode'],
				"address" => $this->parameter['address'],
				"img" => $fileAttach,
				"pay" => $pay,
				"national_pension" => $this->parameter['national_pension'],
				"emp_insure" => $this->parameter['emp_insure'],
				"health_insure" => $this->parameter['health_insure'],
				"long_term_care" => $this->parameter['long_term_care']
			);

			$result = $this->insert($data);
		} else {
			$data = array(
				"table" => "employee",
				"where" => "uid=".$this->parameter['uid'],
				"classify" => $classify,
				"emp_cd" => $this->parameter['emp_cd'],
				"emp_nm" => $this->parameter['emp_nm'],
				"emp_id" => $this->parameter['emp_id'],
				"emp_pwd" => $this->parameter['emp_pwd'],
				"gender" => $this->parameter['gender'],
				"regist_no" => $this->parameter['regist_no'],
				"mobile" => $mobile,
				"telephone" => $telephone,
				"email" => $this->parameter['email'],
				"join_dt" => $this->parameter['join_dt'],
				"resign_dt" => $this->parameter['resign_dt'],
				"big_department_cd" => $this->parameter['m_big_department_cd'],
				"middle_department_cd" => $this->parameter['m_middle_department_cd'],
				"small_department_cd" => $this->parameter['m_small_department_cd'],
				"position_cd" => $this->parameter['position_cd'],
				"zipcode" => $this->parameter['zipcode'],
				"address" => $this->parameter['address'],
				"img" => $fileAttach,
				"pay" => $pay,
				"national_pension" => $this->parameter['national_pension'],
				"emp_insure" => $this->parameter['emp_insure'],
				"health_insure" => $this->parameter['health_insure'],
				"long_term_care" => $this->parameter['long_term_care']
			);

			$result = $this->update($data);
		}

		if($result) echo "success";
	}

	// 사원리스트 가져오기
	public function getEmployeeList() {
		$json = new Services_JSON();
		$where = str_replace("@","%",$this->parameter['where']);
		$this->getTable("employee", $where, $this->parameter['rpp'], $this->parameter['page']);
		
		$i = 0;
		while($t = $this->fetch()) {

			$department = $this->getName("department_middle","department_nm",$t->middle_department_cd)."-".$this->getName("department_small","department_nm",$t->small_department_cd);

			$re[$i]['uid'] = $t->uid;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['emp_cd'] = $t->emp_cd;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_pwd'] = $t->emp_pwd;
			$re[$i]['gender'] = $t->gender;
			$re[$i]['regist_no'] = $this->convertNull($t->regist_no);
			$re[$i]['mobile'] = $this->convertNull($t->mobile);
			$re[$i]['telephone'] = $this->convertNull($t->telephone);
			$re[$i]['email'] = $this->convertNull($t->email);
			$re[$i]['join_dt'] = substr($t->join_dt,0,10);
			$re[$i]['resign_dt'] = $this->convertNull(substr($t->resign_dt,0,10));
			$re[$i]['department'] = $department;
			$re[$i]['middle_department_cd'] = $t->middle_department_cd;
			$re[$i]['small_department_cd'] = $t->small_department_cd;
			$re[$i]['position_cd'] = $t->position_cd;
			$re[$i]['position_nm'] = $this->convertNull($this->getName("position","position_nm",$t->position_cd));
			$re[$i]['zipcode'] = $this->convertNull($t->zipcode);
			$re[$i]['address'] = $this->convertNull($t->address);
			$re[$i]['img'] = $t->img;
			$re[$i]['pay'] = $t->pay;
			$re[$i]['national_pension'] = $t->national_pension;
			$re[$i]['emp_insure'] = $t->emp_insure;
			$re[$i]['health_insure'] = $t->health_insure;
			$re[$i]['long_term_care'] = $t->long_term_care;
			$re[$i]['income_tax'] = $this->getIncomeTax($t->pay);
			$i++;
		}

		echo $json->encode($re);
	}

	// excel 등록
	public function registExcel() {
		extract($_POST);
		//error_reporting(E_ALL);
		//ini_set("display_errors", 1);
		ini_set("memory_limit", -1);
		error_reporting(E_ALL ^ E_NOTICE);
		require_once $_SERVER['DOCUMENT_ROOT']. '/basic/library/PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
		echo ('<meta http-equiv="content-type" content="text/html; charset=utf-8">');

		// 저장될 디비 테이블명
		$TABLE_NAME = $table_name;
		// 저장될 디렉토리
		$upfile_dir = $_SERVER['DOCUMENT_ROOT']."/basic/attach/excel";
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
			//$this->begin();
			// 라인수 만큼 루프
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
					"P"=>$line[$col++],   // 열다섯번쨰 칼럼
					"Q"=>$line[$col++],   // 열다섯번쨰 칼럼
					"R"=>$line[$col++],   // 열다섯번쨰 칼럼
					"S"=>$line[$col++],   // 열다섯번쨰 칼럼
					"T"=>$line[$col++],   // 열다섯번쨰 칼럼
					"U"=>$line[$col++],   // 열다섯번쨰 칼럼
					"V"=>$line[$col++],   // 열다섯번쨰 칼럼
					"W"=>$line[$col++],   // 열다섯번쨰 칼럼
					"X"=>$line[$col++],   // 열다섯번쨰 칼럼
					"Y"=>$line[$col++],   // 열다섯번쨰 칼럼
					"Z"=>$line[$col++],   // 열다섯번쨰 칼럼
				);

				//print_r($item["A"] .",". $item["B"].",". $item["C"].",". $item["D"].",". $item["E"].",". $item["F"] ."<br/>");
				

				switch ($this->parameter['excel_gb']) {
					case "item":	
						$classify = trim(addslashes(strip_tags($item["A"])));		
						$group_cd = trim(addslashes(strip_tags($item["B"])));	
						$item_cd = strtoupper(trim(addslashes(strip_tags($item["C"]))));	
						$item_nm = trim(addslashes(strip_tags($item["D"])));
						$standard = trim(addslashes(strip_tags($item["E"])));
						$unit = trim(addslashes(strip_tags($item["F"])));
						$delivery_period = trim(addslashes(strip_tags($item["G"])));
						$cnt = $this->replaceComma(trim(addslashes(strip_tags($item["H"]))));
						$safety_stock_cnt = $this->replaceComma(trim(addslashes(strip_tags($item["I"]))));

						if(empty($item_cd)) $item_cd = $pre.mt_rand(100000000,999999999);

						$item_cd = str_replace("'","",$item_cd);
						$item_cd = str_replace('"',"",$item_cd);
						$item_nm = str_replace("'","",$item_nm);
						$item_nm = str_replace('"',"",$item_nm);
						$unit = str_replace('"',"",$unit);
						$unit = str_replace('"',"",$unit);
						$standard = str_replace('"',"",$standard);
						$standard = str_replace('"',"",$standard);

						$classify = $this->getItemClassificationCd($classify);
						if(empty($classify)) $classify = 0;
						
						if($classify != 0) {
							$data = array (
								"table" => "item",
								"classify" => $classify,
								"group_cd" => $group_cd,
								"item_cd" => $item_cd,
								"item_nm" => $item_nm,							
								"standard" => $standard,
								"unit" => $unit,
								"delivery_period" => $delivery_period,
								"cnt" => $cnt,
								"safety_stock_cnt" => $safety_stock_cnt
							);
							$result = $this->insert($data);	
						}
					break;

				

					case "employee":
						$emp_cd = trim(addslashes(strip_tags($item["A"])));		
						$emp_nm = trim(addslashes(strip_tags($item["B"])));	
						$emp_id = trim(addslashes(strip_tags($item["C"])));	
						$emp_pwd = trim(addslashes(strip_tags($item["D"])));
						$gender = trim(addslashes(strip_tags($item["E"])));
						$regist_no = trim(addslashes(strip_tags($item["F"])));
						$mobile = trim(addslashes(strip_tags($item["G"])));
						$telephone = trim(addslashes(strip_tags($item["H"])));
						$email = trim(addslashes(strip_tags($item["I"])));
						$join_dt = trim(addslashes(strip_tags($item["J"])));
						$big_department = trim(addslashes(strip_tags($item["K"])));
						$middle_department = trim(addslashes(strip_tags($item["L"])));
						$small_department = trim(addslashes(strip_tags($item["M"])));
						$position = trim(addslashes(strip_tags($item["N"])));
						$zipcode = trim(addslashes(strip_tags($item["O"])));
						$address = trim(addslashes(strip_tags($item["P"])));
						
						if($emp_id != "") {
							$data = array (
								"table" => "employee",
								"classify" => "work",
								"emp_cd" => $emp_cd,
								"emp_nm" => $emp_nm,
								"emp_id" => $emp_id,
								"emp_pwd" => $emp_pwd,
								"gender" => $gender,
								"regist_no" => $regist_no,
								"mobile" => $mobile,
								"telephone" => $telephone,
								"email" => $email,
								"join_dt" => $join_dt,
								"big_department_cd" => $this->getBigDepartmentCd($big_department),
								"middle_department_cd" => $this->getMiddleDepartmentCd($middle_department),
								"small_department_cd" => $this->getSmallDepartmentCd($small_department),
								"position_cd" => $this->getPositionCd($position),
								"zipcode" => $zipcode,
								"address" => $address
							);
							$this->insert($data);	
						}
					break;

					case "account":
						$classify = trim(addslashes(strip_tags($item["A"])));		
						$outsourcing = trim(addslashes(strip_tags($item["B"])));	
						$account_cd = trim(addslashes(strip_tags($item["C"])));	
						$account_nm = trim(addslashes(strip_tags($item["D"])));	
						$owner = trim(addslashes(strip_tags($item["E"])));
						$owner_mobile = trim(addslashes(strip_tags($item["F"])));
						$corp_no = trim(addslashes(strip_tags($item["G"])));
						$corp_reg_no = trim(addslashes(strip_tags($item["H"])));
						$corp_condition = trim(addslashes(strip_tags($item["I"])));
						$corp_event = trim(addslashes(strip_tags($item["J"])));
						$corp_phone = trim(addslashes(strip_tags($item["K"])));
						$corp_fax = trim(addslashes(strip_tags($item["L"])));
						$corp_email = trim(addslashes(strip_tags($item["M"])));
						$corp_zipcode = trim(addslashes(strip_tags($item["N"])));
						$corp_address = trim(addslashes(strip_tags($item["O"])));
						$manager = trim(addslashes(strip_tags($item["P"])));
						$bank = trim(addslashes(strip_tags($item["Q"])));
						$account = trim(addslashes(strip_tags($item["R"])));
						$account_holder = trim(addslashes(strip_tags($item["S"])));
						$account_id = trim(addslashes(strip_tags($item["T"])));
						$account_pwd = trim(addslashes(strip_tags($item["U"])));

						$classify = $this->getAccountClassificationCd($classify);
						
						if($account_cd != "") {
							$data = array (
								"table" => "account",
								"classify" => $classify,
								"outsourcing" => $outsourcing,
								"account_cd" => $account_cd,
								"account_nm" => $account_nm,
								"owner" => $owner,
								"owner_mobile" => $owner_mobile,
								"corp_no" => $corp_no,
								"corp_reg_no" => $corp_reg_no,
								"corp_condition" => $corp_condition,
								"corp_event" => $corp_event,
								"corp_phone" => $corp_phone,
								"corp_fax" => $corp_fax,
								"corp_email" => $corp_email,
								"corp_zipcode" => $corp_zipcode,
								"corp_address" => $corp_address,
								"manager" => $manager,
								"bank" => $bank,
								"account" => $account,
								"account_holder" => $account_holder,
								"account_id" => $account_id,
								"account_pwd" => $account_pwd
							);
							$this->insert($data);	
						}
					break;

					case "tax" :
						$pay = trim(addslashes(strip_tags($item["A"])));		
						$tax = trim(addslashes(strip_tags($item["B"])));

						if($pay != "") {
							$data = array(
								"table" => "income_tax",
								"pay" => $pay,
								"tax" => $tax
							);
							//var_dump($data);
							$this->insert($data);
						}
					break;
				}
			}
			//$this->commit();
		} 
		catch (exception $e) {
			$this->rollback();
			echo '엑셀파일을 읽는도중 오류가 발생하였습니다.';
		}
		
		unlink("{$upfile_dir}/{$upfile_name}");

		echo "success";
	}
/*****************************************************************************************************************************/
// 수주.영업관리
/*****************************************************************************************************************************/
	// 견적서 등록
	public function registEstimate() {
		$item_cd = $this->parameter['item_cd'];
		$item_nm = $this->parameter['item_nm'];
		$standard = $this->parameter['standard'];
		$unit = $this->parameter['unit'];
		$cnt = $this->replaceComma($this->parameter['cnt']);
		$sales_price = $this->replaceComma($this->parameter['sales_price']);
		$rate = $this->parameter['rate'];
		$reversion_sales_price = $this->replaceComma($this->parameter['reversion_sales_price']);
		$supply_price = $this->replaceComma($this->parameter['supply_price']);
		$tax = $this->replaceComma($this->parameter['tax']);
		$total_price = $this->replaceComma($this->parameter['total_price']);

		$order_cd = $this->createCode("order_cd","obtain_order");
		//$total_price = $this->replaceComma($this->parameter['cnt']) * $this->replaceComma($this->parameter['price']);
		//if($this->parameter['use_tax'] == "y") $tax = $this->getTax($total_price,"b");
		//else $tax = 0;

		if($this->parameter['uid'] == "") {
			$data = array(
				"table" => "estimate",
				"estimate_cd" => $this->parameter['estimate_cd'],
				"estimate_dt" => $this->parameter['estimate_dt'],
				"account_cd" => $this->parameter['account_cd'],
				"account_nm" => $this->parameter['account_nm'],
				"sales_emp_id" => $this->parameter['sales_emp_id'],
				"sales_emp_nm" => $this->parameter['sales_emp_nm'],
				"delivery_dt" => $this->parameter['delivery_dt'],
				"shipping_address" => $this->parameter['shipping_address'],
				"state" => "견적"
			);
			$result = $this->insert($data);
			$fid = $this->get_insert_id();

			foreach($item_cd as $key=>$val){
				($cnt[$key] == "")? $in_cnt = 0 : $in_cnt = $cnt[$key];
				($sales_price[$key] == "")? $in_sales_price = 0 : $in_sales_price = $sales_price[$key];
				($rate[$key] == "")? $in_rate = 0 : $in_rate = $rate[$key];
				($reversion_sales_price[$key] == "")? $in_reversion_sales_price = 0 : $in_reversion_sales_price = $reversion_sales_price[$key];
				($supply_price[$key] == "")? $in_supply_price = 0 : $in_supply_price = $supply_price[$key];
				($tax[$key] == "")? $in_tax = 0 : $in_tax = $tax[$key];
				($total_price[$key] == "")? $in_total_price = 0 : $in_total_price = $total_price[$key];

				$data = array(
					"table" => "estimate_item",
					"fid" => $fid,
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"unit" => $unit[$key],
					"cnt" => $in_cnt,
					"sales_price" => $in_sales_price,
					"rate" => $in_rate,
					"reversion_sales_price" => $in_reversion_sales_price,
					"supply_price" => $in_supply_price,
					"tax" => $in_tax,
					"total_price" => $in_total_price
				);

				$this->insert($data);
			}
		} else {
			$data = array(
				"table" => "estimate",
				"where" => "uid=".$this->parameter['uid'],
				"estimate_cd" => $this->parameter['estimate_cd'],
				"estimate_dt" => $this->parameter['estimate_dt'],			
				"account_cd" => $this->parameter['account_cd'],
				"account_nm" => $this->parameter['account_nm'],
				"sales_emp_id" => $this->parameter['sales_emp_id'],
				"sales_emp_nm" => $this->parameter['sales_emp_nm'],				
				"delivery_dt" => $this->parameter['delivery_dt'],
				"shipping_address" => $this->parameter['shipping_address'],
				"state" => "견적"
			);
			$result = $this->update($data);
			$fid = $this->parameter['uid'];

			$sql = "delete from estimate_item where fid=".$fid;
			$this->query($sql);

			foreach($item_cd as $key=>$val){
				($cnt[$key] == "")? $in_cnt = 0 : $in_cnt = $cnt[$key];
				($sales_price[$key] == "")? $in_sales_price = 0 : $in_sales_price = $sales_price[$key];
				($rate[$key] == "")? $in_rate = 0 : $in_rate = $rate[$key];
				($reversion_sales_price[$key] == "")? $in_reversion_sales_price = 0 : $in_reversion_sales_price = $reversion_sales_price[$key];
				($supply_price[$key] == "")? $in_supply_price = 0 : $in_supply_price = $supply_price[$key];
				($tax[$key] == "")? $in_tax = 0 : $in_tax = $tax[$key];
				($total_price[$key] == "")? $in_total_price = 0 : $in_total_price = $total_price[$key];

				$data = array(
					"table" => "estimate_item",
					"fid" => $fid,
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"unit" => $unit[$key],
					"cnt" => $in_cnt,
					"sales_price" => $in_sales_price,
					"rate" => $in_rate,
					"reversion_sales_price" => $in_reversion_sales_price,
					"supply_price" => $in_supply_price,
					"tax" => $in_tax,
					"total_price" => $in_total_price
				);

				$this->insert($data);
			}			
		}

		if($result) echo "success";
	}

	// 견적서 가져오기
	public function getEstimateList() {
		$json = new Services_JSON();
		$where = str_replace("@","%",$this->parameter['where']);
		$this->getTable("estimate", $where, $this->parameter['rpp'], $this->parameter['page']);
		
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['estimate_cd'] = $t->estimate_cd;
			$re[$i]['estimate_dt'] = substr($t->estimate_dt, 0, 10);
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['sales_emp_id'] = $t->sales_emp_id;
			$re[$i]['sales_emp_nm'] = $t->sales_emp_nm;

			$sql = "select * from estimate_item where fid=".$t->uid;
			$this->sub_query($sql);
			$k = 0;
			while($r = $this->sub_fetch()){
				if($k == 0) {
					$items = $r->item_nm;
				}
				$total_price = $total_price + $r->total_price;
				$k++;
			}
			$re[$i]['total_price'] = $total_price;
			$re[$i]['item_nm'] = $items;

			if($k > 1) $re[$i]['item_nm'] = $items." 외 ".($k-1)."건";
			else $re[$i]['item_nm'] = $items;

			$re[$i]['delivery_dt'] = substr($t->delivery_dt, 0, 10);
			$re[$i]['shipping_address'] = $t->shipping_address;
			$re[$i]['state'] = $this->convertNull($t->state);
			
			$i++;
		}

		echo $json->encode($re);
	}

	// 견적서 하나가져오기
	public function getEstimate(){
		$json = new Services_JSON;
		$sql = "select * from estimate where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();

		$re['estimate_cd'] = $t->estimate_cd;
		$re['estimate_dt'] = substr($t->estimate_dt,0,10);
		$re['account_cd'] = $t->account_cd;
		$re['account_nm'] = $t->account_nm;
		$re['sales_emp_id'] = $t->sales_emp_id;
		$re['sales_emp_nm'] = $t->sales_emp_nm;
		$re['delivery_dt'] = substr($t->delivery_dt,0,10);
		$re['shipping_address'] = mb_substr($t->shipping_address,0,6);
		$re['state'] = $t->state;

		echo $json->encode($re);

	}

	// 견적품목 가져오기
	public function getEstimateItemList() {
		$json = new Services_JSON;
		$sql = "select * from estimate_item where fid=".$this->parameter['uid'];
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['sales_price'] = $t->sales_price;
			$re[$i]['rate'] = $t->rate;
			$re[$i]['reversion_sales_price'] = $t->reversion_sales_price;
			$re[$i]['supply_price'] = $t->supply_price;
			$re[$i]['tax'] = $t->tax;
			$re[$i]['total_price'] = $t->total_price;
			$i++;
		}
		echo $json->encode($re);
	}

	// 수주서 하나가져오기
	public function getObtainOrder(){
		$json = new Services_JSON;
		$sql = "select * from obtain_order where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();

		$re['estimate_cd'] = $t->estimate_cd;
		$re['estimate_dt'] = $t->estimate_dt;
		$re['order_cd'] = $t->obtain_order_cd;
		$re['order_dt'] = substr($t->obtain_order_dt,0,10);
		$re['account_cd'] = $t->account_cd;
		$re['account_nm'] = $t->account_nm;
		$re['sales_emp_id'] = $t->sales_emp_id;
		$re['sales_emp_nm'] = $t->sales_emp_nm;
		$re['delivery_dt'] = substr($t->delivery_dt,0,10);
		$re['shipping_address'] = mb_substr($t->shipping_address,0,6);
		$re['state'] = $t->state;

		echo $json->encode($re);

	}

	// 수주품목 가져오기
	public function getObtainOrderItemList() {
		$json = new Services_JSON;
		$sql = "select * from obtain_order_item where fid=".$this->parameter['uid'];
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['stock_cnt'] = $this->getWarehouseStockCnt($t->item_cd, $t->standard);
			$re[$i]['sales_price'] = $t->sales_price;
			$re[$i]['rate'] = $t->rate;
			$re[$i]['reversion_sales_price'] = $t->reversion_sales_price;
			$re[$i]['supply_price'] = $t->supply_price;
			$re[$i]['tax'] = $t->tax;
			$re[$i]['total_price'] = $t->total_price;
			$i++;
		}

		echo $json->encode($re);
	}	

	// 선택한 견적서 수주로 전환하기
	public function changeOrder() {
		$arr = array();
		$array_uid = explode(",",$this->parameter['uids']);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			if(!empty($array_uid[$i])) {
				$sql = "select * from estimate where uid=".$array_uid[$i];
				$this->query($sql);
				$t = $this->fetch();
				if($t->state == "수주") {
					echo "already";
					exit;
				} else {
					$order_cd = $this->createCode("order_cd","obtain_order");
					$data = array(
						"table" => "obtain_order",
						"estimate_cd" => $t->estimate_cd,
						"order_cd" => $order_cd,
						"estimate_dt" => $t->estimate_dt,
						"order_dt" => $this->now,
						"account_cd" => $t->account_cd,
						"account_nm" => $t->account_nm,
						"sales_emp_id" => $t->sales_emp_id,
						"sales_emp_nm" => $t->sales_emp_nm,						
						"delivery_dt" => $t->delivery_dt,
						"shipping_address" => $t->shipping_address,
						"state" => "수주"
					);
					$this->insert($data);
					$fid = $this->get_insert_id();

					$sql = "select * from estimate_item where fid=".$array_uid[$i];
					$this->sub_query($sql);
					
					while($r = $this->sub_fetch()) {
						$data = array(
							"table" => "obtain_order_item",
							"fid" => $fid,
							"item_cd" => $r->item_cd,
							"item_nm" => $r->item_nm,
							"standard" => $r->standard,
							"unit" => $r->unit,
							"cnt" => $r->cnt,
							"remain_cnt" => $r->cnt,
							"account_cd" => $t->account_cd,
							"account_nm" => $t->account_nm,
							"delivery_dt" => $t->delivery_dt,
							"sales_price" => $r->sales_price,
							"rate" => $r->rate,
							"reversion_sales_price" => $r->reversion_sales_price,
							"supply_price" => $r->supply_price,
							"tax" => $r->tax,
							"total_price" => $r->total_price,
							"state" => "수주",
							"order_dt" => $this->now
						);

						$result = $this->insert($data);	
						
						array_push($arr,$r->item_cd);
					}


					if($result) {
						$sql = "update estimate set state='수주' where uid=".$array_uid[$i];
						$this->query($sql);

						$title = $t->account_nm." 납기일";
						$memo = "품번 : ".$t->item_cd."\n품명 : ".$t->item_nm."\n규격 : ".$t->standard."\n단위 : ".$t->unit."\n수량 : ".$t->cnt;
						$data = array(
							"table" => "schedule",
							"title" => $title,
							"anniversary" => "n",
							"classify" => "수주",
							"name" => $t->account_nm,
							"schedule_dt" => $t->delivery_dt,
							"schedule_tm" => "",
							"place" => $t->account_nm,
							"importance" => "★★★",
							"memo" => $memo,
							"emp_id"=>$_SESSION['login_id']
						);
						$this->insert($data);
					}
				}
			}
		}

		for($i = 0 ; $i < sizeof($arr) ; $i++) {
			// 작업지시를 내렸는지 확인하기 위하여 품목별 제조공정을 복사하여 처리
			$item_uid = $this->getItemUid($arr[$i]);
			$sql = "select * from item_process where fid=".$item_uid." order by no asc";
			$this->query($sql);

			while($t = $this->fetch()){
				$data = array(
					$table = "temp_item_process",
					"order_cd" => $order_cd,
					"fid" => $t->fid,
					"no" => $t->no,
					"item_uid" => $t->item_uid,
					"process" => $t->process,
					"outsourcing" => $t->outsourcing,
					"after_process" => $t->after_process,
					"state" => "n"
				);

				$this->insert($data);

				$fid = $this->get_insert_id();

				$sql = "select * from in_item where fid=".$t->uid;
				$this->sub_query($sql);
				while($tt = $this->sub_fetch()){
					$data = array(
						"table" => "temp_in_item",
						"fid" => $fid,
						"item_cd" => $tt->item_cd,
						"item_nm" => $tt->item_nm,
						"standard" => $tt->standard,
						"unit" => $tt->unit,
						"cnt" => $tt->cnt,
						"classify" => $tt->classify,
						"state" => "n"
					);

					$this->insert($data);
				}
			}		
		}	

		echo "success";
	}

	// 수주서 등록
	public function registObtainOrder() {
		$item_cd = $this->parameter['item_cd'];
		$item_nm = $this->parameter['item_nm'];
		$standard = $this->parameter['standard'];
		$unit = $this->parameter['unit'];
		$cnt = $this->replaceComma($this->parameter['cnt']);
		$sales_price = $this->replaceComma($this->parameter['sales_price']);
		$rate = $this->parameter['rate'];
		$reversion_sales_price = $this->replaceComma($this->parameter['reversion_sales_price']);
		$supply_price = $this->replaceComma($this->parameter['supply_price']);
		$tax = $this->replaceComma($this->parameter['tax']);
		$total_price = $this->replaceComma($this->parameter['total_price']);

		$order_cd = $this->createCode("order_cd","obtain_order");
		//$total_price = $this->replaceComma($this->parameter['cnt']) * $this->replaceComma($this->parameter['price']);
		//if($this->parameter['use_tax'] == "y") $tax = $this->getTax($total_price,"b");
		//else $tax = 0;

		if($this->parameter['uid'] == "") {
			$data = array(
				"table" => "obtain_order",
				"estimate_cd" => $this->parameter['estimate_cd'],
				"order_cd" => $order_cd,
				"estimate_dt" => $this->parameter['estimate_dt'],
				"order_dt" => $this->parameter['order_dt'],
				"account_cd" => $this->parameter['account_cd'],
				"account_nm" => $this->parameter['account_nm'],
				"sales_emp_id" => $this->parameter['sales_emp_id'],
				"sales_emp_nm" => $this->parameter['sales_emp_nm'],
				"delivery_dt" => $this->parameter['delivery_dt'],
				"shipping_address" => $this->parameter['shipping_address'],
				"state" => "수주"
			);
			$result = $this->insert($data);
			$fid = $this->get_insert_id();

			// 미수금 내역 저장
			$sql = "select * from account where account_cd='".$this->parameter['account_cd']."'";
			$this->query($sql);
			$account = $this->fetch();

			$data = array(
				"table" => "receivables",
				"account_cd" => $this->parameter['account_cd'],
				"account_nm" => $this->parameter['account_nm'],
				"amount" => 0,
				"create_dt" => $this->now,
				"telephone" => $account->corp_phone,
				"mobile" => $account->owner_mobile,
				"owner" => $account->owner,
				"collect_amount" => 0,
				"remain_amount" => 0,
				"last_collect_dt" => "",
				"next_collect_dt" => "",
				"state" => "y"
			);

			$this->insert($data);
			$receivables_fid = $this->get_insert_id();

			foreach($item_cd as $key=>$val){
				($cnt[$key] == "")? $in_cnt = 0 : $in_cnt = $cnt[$key];
				($sales_price[$key] == "")? $in_sales_price = 0 : $in_sales_price = $sales_price[$key];
				($rate[$key] == "")? $in_rate = 0 : $in_rate = $rate[$key];
				($reversion_sales_price[$key] == "")? $in_reversion_sales_price = 0 : $in_reversion_sales_price = $reversion_sales_price[$key];
				($supply_price[$key] == "")? $in_supply_price = 0 : $in_supply_price = $supply_price[$key];
				($tax[$key] == "")? $in_tax = 0 : $in_tax = $tax[$key];
				($total_price[$key] == "")? $in_total_price = 0 : $in_total_price = $total_price[$key];

				$data = array(
					"table" => "obtain_order_item",
					"fid" => $fid,
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"unit" => $unit[$key],
					"cnt" => $in_cnt,
					"remain_cnt" => $in_cnt,
					"account_cd" => $this->parameter['account_cd'],
					"account_nm" => $this->parameter['account_nm'],
					"delivery_dt" => $this->parameter['delivery_dt'],
					"sales_price" => $in_sales_price,
					"rate" => $in_rate,
					"reversion_sales_price" => $in_reversion_sales_price,
					"supply_price" => $in_supply_price,
					"tax" => $in_tax,
					"total_price" => $in_total_price,
					"state" => "수주",
					"order_dt" => $this->now
				);

				$this->insert($data);


				// 미수품목 디테일
				$data = array(
					"table" => "receivables_item",
					"fid" => $receivables_fid,
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"unit" => $unit[$key],
					"cnt" => $in_cnt,
					"sales_price" => $in_sales_price,
					"rate" => $in_rate,
					"reversion_sales_price" => $in_reversion_sales_price,
					"supply_price" => $in_supply_price,
					"tax" => $in_tax,
					"total_price" => $in_total_price
				);
				$this->insert($data);
				$receivables_total = $receivables_total + $in_total_price;


				$memo .= "품번 : ".$val."\n품명 : ".$item_nm[$key]."\n규격 : ".$standard[$key]."\n단위 : ".$unit[$key]."\n수량 : ".$in_cnt."\n\n================================================\n\n";
				// 작업지시를 내렸는지 확인하기 위하여 품목별 제조공정을 복사하여 처리
				$item_uid = $this->getItemUid($val);
				$sql = "select * from item_process where fid=".$item_uid." order by no asc";
				$this->query($sql);

				while($t = $this->fetch()){
					$data = array(
						$table = "temp_item_process",
						"order_cd" => $order_cd,
						"fid" => $t->fid,
						"no" => $t->no,
						"item_uid" => $t->item_uid,
						"process" => $t->process,
						"outsourcing" => $t->outsourcing,
						"after_process" => $t->after_process,
						"state" => "n"
					);

					$this->insert($data);

					$fids = $this->get_insert_id();

					$sql = "select * from in_item where fid=".$t->uid;
					$this->sub_query($sql);
					while($tt = $this->sub_fetch()){
						$data = array(
							"table" => "temp_in_item",
							"fid" => $fids,
							"item_cd" => $tt->item_cd,
							"item_nm" => $tt->item_nm,
							"standard" => $tt->standard,
							"unit" => $tt->unit,
							"cnt" => $tt->cnt,
							"classify" => $tt->classify,
							"state" => "n"
						);

						$this->insert($data);
					}
				}
			}

			$sql = "update receivables set amount=".$receivables_total.", remain_amount=".$receivables_total." where uid=".$receivables_fid;
			$this->query($sql);

			
		} else {
			//$sql = "select cnt from obtain_order where uid=".$this->parameter['uid'];
			//$this->query($sql);
			//$obtain_order = $this->fetch();
			//$remain_cnt = ($obtain_order->cnt - $obtain_order->remain_cnt) + $obtain_order->remain_cnt;
			$data = array(
				"table" => "obtain_order",
				"where" => "uid=".$this->parameter['uid'],
				"estimate_cd" => $this->parameter['estimate_cd'],
				"estimate_dt" => $this->parameter['estimate_dt'],
				"order_dt" => $this->parameter['order_dt'],
				"account_cd" => $this->parameter['account_cd'],
				"account_nm" => $this->parameter['account_nm'],
				"sales_emp_id" => $this->parameter['sales_emp_id'],
				"sales_emp_nm" => $this->parameter['sales_emp_nm'],				
				"delivery_dt" => $this->parameter['delivery_dt'],
				"shipping_address" => $this->parameter['shipping_address'],
				"state" => "수주"
			);
			$result = $this->update($data);
			$fid = $this->parameter['uid'];

			$sql = "delete from obtain_order_item where fid=".$fid;
			//echo $sql;
			$this->query($sql);

			foreach($item_cd as $key=>$val){
				($cnt[$key] == "")? $in_cnt = 0 : $in_cnt = $cnt[$key];
				($sales_price[$key] == "")? $in_sales_price = 0 : $in_sales_price = $sales_price[$key];
				($rate[$key] == "")? $in_rate = 0 : $in_rate = $rate[$key];
				($reversion_sales_price[$key] == "")? $in_reversion_sales_price = 0 : $in_reversion_sales_price = $reversion_sales_price[$key];
				($supply_price[$key] == "")? $in_supply_price = 0 : $in_supply_price = $supply_price[$key];
				($tax[$key] == "")? $in_tax = 0 : $in_tax = $tax[$key];
				($total_price[$key] == "")? $in_total_price = 0 : $in_total_price = $total_price[$key];

				$data = array(
					"table" => "obtain_order_item",
					"fid" => $fid,
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"unit" => $unit[$key],
					"cnt" => $in_cnt,
					"remain_cnt" => $in_cnt,
					"account_cd" => $this->parameter['account_cd'],
					"account_nm" => $this->parameter['account_nm'],
					"delivery_dt" => $this->parameter['delivery_dt'],
					"sales_price" => $in_sales_price,
					"rate" => $in_rate,
					"reversion_sales_price" => $in_reversion_sales_price,
					"supply_price" => $in_supply_price,
					"tax" => $in_tax,
					"total_price" => $in_total_price,
					"state" => "수주"
				);

				$this->insert($data);
			}			
		}


		if($result) {
			$title = $this->parameter['account_nm']." 납기일";
			
			$data = array(
				"table" => "schedule",
				"title" => $title,
				"anniversary" => "n",
				"classify" => "수주",
				"name" => $this->parameter['account_nm'],
				"schedule_dt" => $this->parameter['delivery_dt'],
				"schedule_tm" => "",
				"place" => $this->parameter['account_nm'],
				"importance" => "★★★",
				"memo" => $memo,
				"emp_id"=>$_SESSION['login_id']
			);
			$this->insert($data);

			echo "success";
		}
	}

	// 수주서 가져오기
	public function getObtainOrderList() {
		$json = new Services_JSON();
		$where = str_replace("@","%",$this->parameter['where']);
		$this->getTable("obtain_order", $where, $this->parameter['rpp'], $this->parameter['page'],"obtain_order_dt","desc");
		
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;			
			$re[$i]['estimate_cd'] = $t->estimate_cd;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['estimate_dt'] = substr($t->estimate_dt, 0, 10);
			$re[$i]['order_dt'] = substr($t->order_dt, 0, 10);
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['sales_emp_id'] = $t->sales_emp_id;
			$re[$i]['sales_emp_nm'] = $t->sales_emp_nm;
			
			$d1 = substr($t->delivery_dt,0,10);
			$d2 = substr($t->shipment_dt,0,10);
			
			
			

			$date1 = new DateTime($d2);
			$date2 = new DateTime($d1);
			
			if($date1->getTimestamp() > $date2->getTimestamp()) $bu = 1;
			else $bu = -1;

			$diff=date_diff($date1,$date2);
			//echo $diff->days;

			/*
			object(DateInterval)#6 (15) {
  ["y"]=>
  int(0)
  ["m"]=>
  int(0)
  ["d"]=>
  int(0)
  ["h"]=>
  int(19)
  ["i"]=>
  int(32)
  ["s"]=>
  int(53)
  ["weekday"]=>
  int(0)
  ["weekday_behavior"]=>
  int(0)
  ["first_last_day_of"]=>
  int(0)
  ["invert"]=>
  int(0)
  ["days"]=>
  int(0)
  ["special_type"]=>
  int(0)
  ["special_amount"]=>
  int(0)
  ["have_weekday_relative"]=>
  int(0)
  ["have_special_relative"]=>
  int(0)
}
*/


			$sql = "select * from obtain_order_item where fid=".$t->uid;
			$this->sub_query($sql);
			$k = 0;
			$total_price = 0;
			while($r = $this->sub_fetch()){
				if($k == 0) {
					$items = $r->item_nm;
				}
				$total_price = $total_price + $r->total_price;
				
				$k++;
			}
			$re[$i]['total_price'] = $total_price;
			$re[$i]['item_nm'] = $items;
			
			if($k > 1) $re[$i]['item_nm'] = $items." 외 ".($k-1)."건";
			else $re[$i]['item_nm'] = $items;
			
			$re[$i]['delivery_dt'] = substr($t->delivery_dt, 0, 10);
			$re[$i]['shipment_dt'] = substr($t->shipment_dt, 0, 10);
			$re[$i]['interval'] = $diff->days * $bu;
			$re[$i]['shipping_address'] = $t->shipping_address;
			$re[$i]['state'] = $this->convertNull($t->state);		
			
			$i++;
		}

		echo $json->encode($re);
	}

	// AS 등록
	public function registAs() {
		$phone = $this->convertMobileNumber($this->parameter['phone']);
		$processing_cost = $this->replaceComma($this->parameter['processing_cost']);

		if($this->parameter['uid'] != "") {
			$data = array(
				"table" => "after_service",
				"where" => "uid=".$this->parameter['uid'],
				"accept_dt" => $this->parameter['accept_dt'],
				"state" => $this->parameter['state'],
				"account_cd" => $this->parameter['account_cd'],
				"account_nm" => $this->parameter['account_nm'],
				"account_manager" => $this->parameter['account_manager'],
				"email" => $this->parameter['email'],
				"phone" => $phone,
				"item_cd" => $this->parameter['item_cd'],
				"item_nm" => $this->parameter['item_nm'],
				"faulty" => $this->parameter['faulty'],
				"memo" => $this->parameter['memo'],
				"as_result" => $this->parameter['as_result'],
				"processing" => $this->parameter['processing'],
				"processing_cost" => $processing_cost,
				"emp_id" => $this->parameter['emp_id'],
				"emp_nm" => $this->parameter['emp_nm'],
			);

			$this->update($data);
		} else {
			$data = array(
				"table" => "after_service",
				"accept_dt" => $this->parameter['accept_dt'],
				"state" => $this->parameter['state'],
				"account_cd" => $this->parameter['account_cd'],
				"account_nm" => $this->parameter['account_nm'],
				"account_manager" => $this->parameter['account_manager'],
				"email" => $this->parameter['email'],
				"phone" => $phone,
				"item_cd" => $this->parameter['item_cd'],
				"item_nm" => $this->parameter['item_nm'],
				"faulty" => $this->parameter['faulty'],
				"memo" => $this->parameter['memo'],
				"as_result" => $this->parameter['as_result'],
				"processing" => $this->parameter['processing'],
				"processing_cost" => $processing_cost,
				"emp_id" => $this->parameter['emp_id'],
				"emp_nm" => $this->parameter['emp_nm'],
				"create_dt" => $this->now
			);

			$this->insert($data);
		}

		$this->movePage("sales","listPageAs");
	}

	// AS 리스트 가져오기
	public function getAfterServiceList() {
		$json = new Services_JSON();
		$this->getTable("after_service", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		
		$i = 0;
		while($t = $this->fetch()) {

			$re[$i]['uid'] = $t->uid;
			$re[$i]['accept_dt'] = substr($t->accept_dt, 0 , 10);
			$re[$i]['state'] = $t->state;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['account_manager'] = $t->account_manager;
			$re[$i]['email'] = $t->email;
			$re[$i]['phone'] = $t->phone;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['faulty'] = $t->faulty;
			$re[$i]['memo'] = $t->memo;
			$re[$i]['as_result'] = $t->as_result;
			$re[$i]['processing'] = $t->processing;
			$re[$i]['processing_cost'] = $t->processing_cost;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['create_dt'] = substr($t->create_dt, 0, 10);
			$i++;
		}

		echo $json->encode($re);
	}
	
	//AS 가져오기
	public function getAfterService() {
		$json = new Services_JSON;
		
		$sql = "select * from after_service where uid=".$this->parameter['uid'];
		$this->query($sql);		
		$t = $this->fetch();
		
		$re['uid'] = $t->uid;
		$re['accept_dt'] = substr($t->accept_dt,0,10);
		$re['state'] = $t->state;
		$re['account_cd'] = $t->account_cd;
		$re['account_nm'] = $t->account_nm;
		$re['account_manager'] = $t->account_manager;
		$re['email'] = $t->email;
		$re['phone'] = $t->phone;
		$re['item_cd'] = $t->item_cd;
		$re['item_nm'] = $t->item_nm;
		$re['faulty'] = $t->faulty;
		$re['memo'] = $t->memo;
		$re['as_result'] = $t->as_result;
		$re['processing'] = $t->processing;
		$re['processing_cost'] = $t->processing_cost;
		$re['emp_id'] = $t->emp_id;
		$re['emp_nm'] = $t->emp_nm;
		$re['create_dt'] = substr($t->create_dt, 0, 10);

		echo $json->encode($re);
	}	

	// 출하지시서 등록
	public function registShipment() {
		if($this->parameter['uid'] != "") {
			$data = array(
				"table" => "shipment",
				"where" => "uid=".$this->parameter['uid'],
				"obtain_order_cd" => $this->parameter['shipment_order_cd'],
				"account_cd" => $this->parameter['shipment_account_cd'],
				"account_nm" => $this->parameter['shipment_account_nm'],
				"shipment_dt" => $this->parameter['shipment_dt'],
				"address" => $this->parameter['shipment_address'],
				"emp_id" => $_SESSION['login_id'],
				"emp_nm" => $_SESSION['login_nm'],
				"create_dt" => $this->now,
				"state" => "출하지시"
			);
			$this->update($data);
		} else {
			$data = array(
				"table" => "shipment",
				"obtain_order_cd" => $this->parameter['shipment_order_cd'],
				"account_cd" => $this->parameter['shipment_account_cd'],
				"account_nm" => $this->parameter['shipment_account_nm'],				
				"shipment_dt" => $this->parameter['shipment_dt'],
				"address" => $this->parameter['shipment_address'],
				"emp_id" => $_SESSION['login_id'],
				"emp_nm" => $_SESSION['login_nm'],
				"create_dt" => $this->now,
				"state" => "출하지시"
			);
			$this->insert($data);

			$fid = $this->get_insert_id();

			$item_cd = $this->parameter['shipment_item_cd'];
			$item_nm = $this->parameter['shipment_item_nm'];
			$standard = $this->parameter['shipment_standard'];
			$unit = $this->parameter['shipment_unit'];
			$cnt = $this->parameter['shipment_cnt'];

			foreach($item_cd as $key => $val){
				$data = array(
					"table" => "shipment_item",
					"fid" => $fid,
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"unit" => $unit[$key],
					"cnt" => $cnt[$key],
					"remain_cnt" => $cnt[$key],
					"state" => "n"

				);

				$this->insert($data);
			}
		}

		$sql = "update obtain_order set state='출하지시' where order_cd='".$this->parameter['shipment_order_cd']."'";
		//echo $sql;
		$this->query($sql);
	}
/*****************************************************************************************************************************/
// 생산관리
/*****************************************************************************************************************************/
	// 외주요청
	public function registOutsourcingRequest() {
		$data = array(
			"table" => "outsourcing_request",
			"item_cd" => $this->parameter['outsourcing_item_cd'],
			"item_nm" => $this->parameter['outsourcing_item_nm'],
			"process_cd" => $this->parameter['outsourcing_process_cd'],
			"process_nm" => $this->parameter['outsourcing_process_nm'],
			"after_process" => $this->parameter['outsourcing_after_process_cd'],
			"after_process_nm" => $this->parameter['outsourcing_after_process_nm'],
			"standard" => $this->parameter['outsourcing_standard'],
			"cnt" => $this->parameter['outsourcing_cnt'],
			"unit" => $this->parameter['outsourcing_unit'],
			"delivery_dt" => $this->parameter['outsourcing_delivery_dt'],
			"memo" => $this->parameter['outsourcing_memo'],
			"state" => "요청",
			"emp_id" => $_SESSION['login_id'],
			"emp_nm" => $_SESSION['login_nm'],
			"create_dt" => $this->now,
			"in_item_process" => $this->parameter['outsourcing_uid']
		);
		$result = $this->insert($data);
		if($result) {
			$sql = "update temp_item_process set state='외주요청완료' where uid=".$this->parameter['command_outsourcing_item_process'];
			$this->query($sql);
			echo "success";
		}
	}

	// 수주 품목의 작업공정 리스트 가져오기
	public function getOrderItemProcess() {
		$json = new Services_JSON;

		$uid = $this->getItemUid($this->parameter['item_cd'],$this->parameter['standard']);
		//$sql = "select * from item_process where fid=".$uid." or item_uid=".$uid." order by no";
		//$sql = "select * from temp_item_process where fid=".$uid." or item_uid=".$uid." order by no";

		$sql = "select * from temp_item_process where order_cd='".$this->parameter['order_cd']."'";
		//echo $sql;
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$sql = "select item_cd, standard from item where uid=".$t->item_uid;
			$this->sub_query($sql);
			$item = $this->sub_fetch();
			
			$re[$i]['uid'] = $t->uid;
			$re[$i]['no'] = $t->no;
			$re[$i]['process'] = $t->process;
			$re[$i]['process_nm'] = $this->getCompareName("process","process_nm","uid",$t->process);
			//$re[$i]['machine'] = $t->machine;
			//$re[$i]['machine_nm'] = $this->getCompareName("machine","machine_nm","uid",$t->machine);
			$re[$i]['item_uid'] = $t->item_uid;
			$re[$i]['item_cd'] = $item->item_cd;
			$re[$i]['item_nm'] = $this->getCompareName("item","item_nm","uid",$t->item_uid);
			$re[$i]['standard'] = $item->standard;
			$re[$i]['outsourcing'] = $t->outsourcing;
			//$re[$i]['unit'] = $t->unit;
			$re[$i]['after_process'] = $t->after_process;
			$re[$i]['after_process_nm'] = $this->getCompareName("process","process_nm","uid",$t->after_process);

			// 필요수량
			$re[$i]['cnt'] = $this->parameter['cnt'];
			$re[$i]['stockCnt'] = $this->getStockCnt($item->item_cd);
			$re[$i]['state'] = $t->state;
			$i++;
		}

		echo $json->encode($re);
	}
	
	// 수주 품목의 작업공정 투입자재 리스트 가져오기
	public function getProcessBom() {
		$json = new Services_JSON;

		$sql = "select * from temp_in_item where fid=".$this->parameter['uid']." order by uid desc";
		//echo $sql;
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt * $this->replaceComma($this->parameter['cnt']);
			$re[$i]['stockCnt'] = $this->getStockCnt($t->item_cd,$t->standard);
			$re[$i]['state'] = $t->state;
			$i++;
		}

		echo $json->encode($re);
	}
	
	// 생산계획 등록 전 해당 품목의 투입원자재가 충분한가 확인
	public function checkMaterial() {
		
		// 작업지시시 필요자재가 없어도 작업지시가 가능하게
		$ing = "y";

		if($ing == "y") {
			echo "success";
			exit;
		}

		$sql = "select * from item_process where item_uid=".$this->parameter['item_uid']." and process=".$this->parameter['process'];
		$this->query($sql);
		$item_process = $this->fetch();

		$sql = "select * from in_item where fid=".$item_process->uid." order by uid desc";
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$cnt = $t->cnt * $this->replaceComma($this->parameter['cnt']);
			$stockCnt = $this->getStockCnt($t->item_cd);
			if($cnt > $stockCnt) {
				echo "false";
				exit;
			}
		}

		echo "success";
	}

	// 구매요청전에 해당 품목을 구매요청한 일이 있나 확인한다
	public function checkPurchase() {
		$sql = "select uid from purchase where order_cd='".$this->parameter['purchase_order_cd']."' and item_cd='".$this->parameter['purchase_item_cd']."' and standard='".$this->parameter['purchase_standard']."'";
		$this->query($sql);

		if($this->get_rows() > 0) {
			echo "isit";
		}
	}

	// 생산계획에서의 모달창을 통한 구매요청
	public function registPurchase() {
		// 혹시라도 품목의 규격이 바뀌어 올 경우 해당 제품이 존재하는지를 확인하고 없는 품목이라면 품목을 등록 해준다
		if($this->parameter['uid'] == "") {
			if($this->parameter['title'] == "") {
				if($this->parameter['purchase_order_cd'] != "") {
					$title = "수주코드 [".$this->parameter['purchase_order_cd']."] 의 자재구매요청";
				} else {
					$title = "구매요청";
				}
			} else {
				$title = $this->parameter['title'];
			}

			$data = array(
				"table" => "purchase",
				"purchase_cd" => $this->createCode("purchase_cd", "purchase"),
				"order_cd" => $this->parameter['purchase_order_cd'],
				"title" => $title,
				"purchase_type" => "내수",
				"item_cd" => $this->parameter['purchase_item_cd'],
				"item_nm" => $this->parameter['purchase_item_nm'],
				"standard" => $this->parameter['purchase_standard'],
				"unit" => $this->getUnit($this->parameter['purchase_item_cd'], $this->parameter['purchase_standard']),
				"cnt" =>$this->replaceComma($this->parameter['purchase_cnt']),
				"delivery_dt" => $this->parameter['purchase_delivery_dt'],
				"big_department" => $_SESSION['big_department'],
				"middle_department" => $_SESSION['middle_department'],
				"small_department" => $_SESSION['small_department'],
				"emp_id" => $_SESSION['login_id'],
				"emp_nm" => $_SESSION['login_nm'],
				"purchase_dt" => $this->now,
				"approval" => "n",
				"state" => "구매요청"
			);

			$result = $this->insert($data);
		} else {
			$data = array(
				"table" => "purchase",
				"where" => "uid=".$this->parameter['uid'],
				"title" => $this->parameter['title'],
				"purchase_type" => $this->parameter['purchase_type'],
				"standard" => $this->parameter['purchase_standard'],
				"unit" => $this->parameter['purchase_unit'],
				"cnt" =>$this->replaceComma($this->parameter['purchase_cnt']),
				"delivery_dt" => $this->parameter['purchase_delivery_dt']
			);

			$result = $this->update($data);
		}
		if($result) {
			$sql = "update temp_in_item set state='구매요청완료' where uid=".$this->parameter['purchase_uid'];
			$this->query($sql);
			echo "success";
		}
	}

	// 품목제조공정관리에서 사용하는 함수
	public function getItemProcess() {
		$json = new Services_JSON;

		$sql = "select * from process";
		$this->query($sql);
		$txt = "<option value='0'>선택</option>";
		while($t = $this->fetch()) {
			$txt .= "<option value='".$t->uid."'>".$t->process_nm."</option>";
		}
		$txt .= "<option value='999'>창고입고</option>";
		
		$re['process'] = $txt;
		echo $json->encode($re);
	}

	// 품목제조공정관리에서 전달되는 공정을 저장하는 함수
	public function registItemProcess() {
		$sql = "select uid from item_process where fid=".$this->parameter['item_uid'];
		//echo $sql;
		$this->query($sql);
		$it = array();
		while($t = $this->fetch()) {
			array_push($it, $t->uid);
		}

		$uid = $_POST['uid'];
		$no = $this->parameter['no'];
		$item_uid = $this->parameter['process_item_uid'];
		$process = $this->parameter['process'];
		$outsourcing = $this->parameter['outsourcing'];
		$after_process = $this->parameter['after_process'];
		
		for($i = 0 ; $i < sizeof($it) ; $i++) {
			if(!in_array($it[$i], $uid)) {
				$sql = "delete from item_process where uid=".$it[$i];
				$this->query($sql);

				$sql = "delete from in_item where fid=".$it[$i];
				$this->query($sql);
			}
		}

		foreach($no as $key => $val) {
			if($uid[$key] != "") {
				$data = array(
					"table" => "item_process",
					"where" => "uid=".$uid[$key],
					"fid" => $this->parameter['item_uid'],
					"item_uid" => $item_uid[$key],
					"no" => $val,
					"process" => $process[$key],
					"outsourcing" => $outsourcing[$key],
					"after_process" => $after_process[$key]
				);

				$this->update($data);
			} else {
				$data = array(
					"table" => "item_process",
					"fid" => $this->parameter['item_uid'],
					"item_uid" => $item_uid[$key],
					"no" => $val,
					"process" => $process[$key],
					"outsourcing" => $outsourcing[$key],
					"after_process" => $after_process[$key]
				);

				$this->insert($data);
			}
		}
	}

	// 품목 제조공정 관리의 투입자재 등록
	public function registInItem() {
		$sql = "delete from in_item where fid=".$this->parameter['process_uid'];
		$this->query($sql);

		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard = $_POST['standard'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$classify = $_POST['classify'];

		foreach($item_cd as $key => $val) {
			$data = array(
				"table" => "in_item",
				"fid" => $this->parameter['process_uid'],
				"item_cd" => $val,
				"item_nm" => $item_nm[$key],
				"standard" => $standard[$key],
				"unit" => $unit[$key],
				"cnt" => $cnt[$key],
				"classify" => $classify[$key]
			);

			$result = $this->insert($data);
		}

		echo "success";
	}

	// 공정에 해당되는 생산설비 가져오기
	public function getProcessMachineList() {
		$json = new Services_JSON();
		
		$sql = "select * from machine where process_cd=".$this->parameter['process']." order by uid asc";
		//echo $sql;
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['process_cd'] = $t->process_cd;
			$re[$i]['process_nm'] = $this->getName("process", "process_nm", $t->process_cd);
			$re[$i]['machine_nm'] = $t->machine_nm;
			$i++;
		}

		echo $json->encode($re);
	}
	
	// 재공공정별 기계 가져오기
	public function getProcessMachine() {
		$json = new Services_JSON();
		
		$sql = "select * from machine order by process_cd asc";
		//echo $sql;
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['process_cd'] = $t->process_cd;
			$re[$i]['process_nm'] = $this->getName("process", "process_nm", $t->process_cd);
			$re[$i]['machine_nm'] = $t->machine_nm;
			$i++;
		}

		echo $json->encode($re);
	}

	// 작업품목 가져오기
	public function getWorkItem() {
		$json = new Services_JSON;
		$sql = "select * from item where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();
		$re['item_cd'] = $t->item_cd;
		$re['item_nm'] = $t->item_nm;
		$re['standard'] = $t->standard;
		echo $json->encode($re);
	}
	
	// 작업지시서 등록
	public function registWork() {
		$seq = $this->replaceComma($this->parameter['command_work_seq']);
		$cnt = $this->replaceComma($this->parameter['command_work_cnt']);
		if($this->parameter['work_cd'] == "") $work_cd = $this->createCode("work_cd","work");
		else $work_cd = $this->parameter['work_cd'];

		$fileAttach = $this->upload('command_work_attach');
		if($fileAttach == "none" && $this->parameter['old_attach'] != "") {
			$fileAttach = $this->parameter['old_attach'];
		}
		
		if($this->parameter['uid'] == "") {					
			$data = array(
				"table" => "work",
				"account_cd" => $this->parameter['command_account_cd'],
				"account_nm" => $this->parameter['command_account_nm'],
				"order_cd" => $this->parameter['command_order_cd'],
				"work_cd" => $work_cd,
				"process" => $this->parameter['command_work_process'],
				"machine" => $this->parameter['command_work_machine'],
				"team" => $this->parameter['command_work_team'],
				"item_cd" => $this->parameter['command_work_item_cd'],
				"item_nm" => $this->parameter['command_work_item_nm'],
				"standard" => $this->parameter['command_work_standard'],
				"unit" => $this->parameter['command_work_unit'],
				"cnt" => $cnt,
				"attach" => $fileAttach,
				"work_dt" => $this->parameter['work_dt'],
				"seq" => $seq,				
				"remain_cnt" => $cnt,
				"state" => "작업지시",
				"warehouse" => $this->parameter['command_warehouse'],
				"work_memo" => $this->parameter['work_memo'],
				"create_dt" => $this->now,
				"item_process" => $this->parameter['command_item_process']
			);

			$result = $this->insert($data);
			
			// 작업지시서에 잘 등록이 되었다면...
			if($result) {
				$sql = "update temp_item_process set state='작업지시완료' where uid=".$this->parameter['command_item_process'];
				//echo $sql;
				$this->query($sql);

				$sql = "update obtain_order set state='작업지시' where order_cd='".$this->parameter['command_order_cd']."'";
				$this->query($sql);

				$sql = "select uid from obtain_order where order_cd='".$this->parameter['command_order_cd']."'";
				$this->query($sql);
				$obtain = $this->fetch();

				$sql = "update obtain_order_item set state='작업지시' where fid=".$obtain->uid." and item_cd='".$this->parameter['command_work_item_cd']."'";
				$this->query($sql);

				// 자재출고서 발행
				$item_uid = $this->getItemUid($this->parameter['command_work_item_cd'],$this->parameter['command_work_standard']);
				//$sql = "select * from temp_item_process where item_uid=".$item_uid." and process=".$this->parameter['command_work_process'];
				$sql = "select * from temp_item_process where uid=".$this->parameter['command_item_process'];
				//echo $sql;
				$this->query($sql);

				$item_process = $this->fetch();
				
				
				$sql = "select * from temp_in_item where fid=".$item_process->uid;
				echo $sql;
				$this->query($sql);
				while($t = $this->fetch()) {
					$release_cnt = $t->cnt * $cnt;

					$data = array(
						"table" => "releases",
						"classify" => "작업지시",
						"obtain_order_cd" => $this->parameter['command_order_cd'],
						"work_cd" => $work_cd,
						"process" => $this->parameter['command_work_process'],
						"machine" => $this->parameter['command_work_machine'],
						"team" => $this->parameter['command_work_team'],
						"item_cd" => $t->item_cd,
						"item_nm" => $t->item_nm,
						"standard" => $t->standard,
						"unit" => $t->unit,
						"cnt" => $release_cnt,
						"remain_cnt" => $release_cnt,
						"emp_id" => $_SESSION['login_id'],
						"emp_nm" => $_SESSION['login_nm'],
						"state" => "출고요청",
						"create_dt" => $this->now
					);

					$this->insert($data);
				}

				echo "success";				
			}
		} else {
			$data = array(
				"table" => "work",
				"where" => "uid=".$this->parameter['uid'],
				"work_cd" => $work_cd,
				"process" => $this->parameter['command_work_process'],
				"machine" => $this->parameter['command_work_machine'],
				"team" => $this->parameter['command_work_team'],
				"item_cd" => $this->parameter['command_work_item_cd'],
				"item_nm" => $this->parameter['command_work_item_nm'],
				"standard" => $this->parameter['command_work_standard'],
				"cnt" => $cnt,
				"work_dt" => $this->parameter['work_dt'],
				"seq" => $seq,
				"remain_cnt" => $cnt,
				"state" => "작업수정지시",
				"warehouse" => $this->parameter['command_warehouse'],
				"work_memo" => $this->parameter['work_memo'],
				"create_dt" => $this->now
			);

			$this->update($data);

			if($this->parameter['add_cnt'] != "" && $this->parameter['add_cnt'] > 0) {
				// 자재출고서 발행
				$item_uid = $this->getItemUid($this->parameter['command_work_item_cd'],$this->parameter['command_work_standard']);
				//$sql = "select * from temp_item_process where item_uid=".$item_uid." and process=".$this->parameter['command_work_process'];
				$sql = "select * from temp_item_process where uid=".$this->parameter['command_item_process'];
				$this->query($sql);

				$item_process = $this->fetch();
				
				$sql = "select * from temp_in_item where fid=".$item_process->uid;
				//echo $sql;
				$this->query($sql);
				while($t = $this->fetch()) {
					$release_cnt = $t->cnt * $this->parameter['add_cnt'];

					$data = array(
						"table" => "releases",
						"classify" => "추가작업지시",
						"obtain_order_cd" => $this->parameter['command_order_cd'],
						"work_cd" => $work_cd,
						"process" => $this->parameter['command_work_process'],
						"machine" => $this->parameter['command_work_machine'],
						"team" => $this->parameter['command_work_team'],
						"item_cd" => $t->item_cd,
						"item_nm" => $t->item_nm,
						"standard" => $t->standard,
						"unit" => $t->unit,
						"cnt" => $release_cnt,
						"remain_cnt" => $release_cnt,
						"emp_id" => $_SESSION['login_id'],
						"emp_nm" => $_SESSION['login_nm'],
						"state" => "출고요청",
						"create_dt" => $this->now
					);

					$this->insert($data);
				}

				echo "success";				
			}
		}
	}
	
	// 해당 품목이 어디에 위치해 있는지
	public function getWhere() {
		$json = new Services_JSON;

		$sql = "select * from warehouse";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$warehouse = "warehouse_".$t->uid;

			$sql = "select * from ".$warehouse." where item_cd='".$this->parameter['item_cd']."' and standard='".$this->parameter['standard']."'";
			$this->sub_query($sql);
			
			while($tt = $this->sub_fetch()) {
				if($tt-> cnt > 0) {
					$re[$i]['uid'] = $tt->uid;
					$re[$i]['warehouse'] = $t->uid;
					$re[$i]['warehouse_nm'] = $t->warehouse_nm;
					$re[$i]['cnt'] = $tt->cnt;
					$re[$i]['lot_no'] = $tt->lot_no;
					$i++;
				}
			}
		}

		echo $json->encode($re);
	}

	public function getProgressMachine() {
		$json = new Services_JSON;
		$sql = "select * from work where machine=".$this->parameter['machine']." and state != '작업완료'";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['process'] = $t->process;
			$re[$i]['machine'] = $t->machine;
			$re[$i]['team'] = $t->team;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['work_dt'] = substr($t->work_dt,0,10);			
			$re[$i]['seq'] = $t->seq;
			$i++;
		}

		echo $json->encode($re);
	}
	
	// 등록할 작업지시서가 이미 진행중인 작업지시서 인가 확인하는 거
	public function checkWork() {
		$sql = "select * from work where account_cd='".$this->parameter['account_cd']."' and order_cd='".$this->parameter['order_cd']."' and item_cd='".$this->parameter['item_cd']."' and standard='".$this->parameter['standard']."' and process=".$this->parameter['process'];
		echo $sql;
		$this->query($sql);
		if($this->get_rows() > 0) echo "isit";
	}

	// 작업지시서 list 가져오기
	public function getWorkList() {
		$json = new Services_JSON;
		$this->getTable("work", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page'],"machine","asc");
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['process'] = $t->process;
			$re[$i]['process_nm'] = $this->getCompareName("process","process_nm","uid",$t->process);
			$re[$i]['machine'] = $t->machine;
			$re[$i]['machine_nm'] = $this->getCompareName("machine","machine_nm","uid",$t->machine);
			$re[$i]['team'] = $t->team;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['work_dt'] = substr($t->work_dt, 0, 10);
			$re[$i]['seq'] = $t->seq;
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$re[$i]['state'] = $t->status;
			$re[$i]['warehouse'] = $t->warehouse;
			$re[$i]['work_memo'] = $t->work_memo;
			$re[$i]['create_dt'] = substr($t->create_dt, 0, 10);
			$i++;
		}

		echo $json->encode($re);
	}

	// 작업지시현황 가져오기
	public function getWork() {
		$json = new Services_JSON;
		
		$sql = "select * from work where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();
		
		$re['uid'] = $t->uid;
		$re['account_cd'] = $t->account_cd;
		$re['account_nm'] = $t->account_nm;
		$re['order_cd'] = $t->order_cd;
		$re['work_cd'] = $t->work_cd;
		$re['process'] = $t->process;
		$re['process_nm'] = $this->getCompareName("process","process_nm","uid",$t->process);
		$re['machine'] = $t->machine;
		$re['machine_nm'] = $this->getCompareName("machine","machine_nm","uid",$t->machine);
		$re['team'] = $t->team;
		$re['item_cd'] = $t->item_cd;
		$re['item_nm'] = $t->item_nm;
		$re['standard'] = $t->standard;
		$re['cnt'] = $t->cnt;
		$re['work_dt'] = substr($t->work_dt, 0, 10);
		$re['seq'] = $t->seq;
		$re['remain_cnt'] = $t->remain_cnt;
		$re['state'] = $t->status;
		$re['warehouse'] = $t->warehouse;
		$re['work_memo'] = $t->work_memo;
		$re['create_dt'] = substr($t->create_dt, 0, 10);

		echo $json->encode($re);
	}

	// 작업지시서 list 가져오기
	public function getDayWorkList() {
		$json = new Services_JSON;
		
		
		$sql = "select date_add(now(), interval ".$this->parameter['day']." day) as limit_day";
		$this->query($sql);
		$limit = $this->fetch();
		$limit_day = $limit->limit_day;

		if($this->parameter['day'] != "") $time = "and (date(work_dt) between now() and '".$limit_day."')";
		else $time = "";

		$sql = "select * from work ".$this->parameter['where']."".$time;
		//echo $sql;
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['process_nm'] = $this->getCompareName("process","process_nm","uid",$t->process);
			$re[$i]['machine_nm'] = $this->getCompareName("machine","machine_nm","uid",$t->machine);
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['work_dt'] = substr($t->work_dt, 0, 10);
			$i++;
		}

		echo $json->encode($re);
	}

	// 생산관리 - 작업보류
	public function deferWork() {
		// 종료된 작업은 보류를 할 수 없으니 종료된 작업인지 검사
		$sql = "select state from work where uid=".$this->parameter['uid'];
		$this->query($sql);
		$work = $this->fetch();

		if($work->state == "작업종료") {
			echo "finish";
		} else if($work->state == "작업취소") {
			echo "cancel";
		} else if($work->state == "작업지시" || $work->state == "작업수정지시" || $work->state == "작업중") {
			$sql = "update work set state='작업보류' where uid=".$this->parameter['uid'];
			$this->query($sql);
			echo "success";
		} else if($work->state == "작업중단") {
			echo "stop";
		} else if($work->state == "작업보류") {
			echo "stay";
		} else {
			$sql = "update work set state='작업보류' where uid=".$this->parameter['uid'];
			$this->query($sql);
			echo "success";
		}

	}


	// 생산관리 - 작업취소
	public function cancelWork() {
		// 종료된 작업은 보류를 할 수 없으니 종료된 작업인지 검사
		$sql = "select state from work where uid=".$this->parameter['uid'];
		$this->query($sql);
		$work = $this->fetch();

		if($work->state == "작업종료") {
			echo "finish";
		} else if($work->state == "작업중") {
			echo "ing";
		} else if($work->state == "작업보류") {
			$sql = "update work set state='작업취소' where uid=".$this->parameter['uid'];
			$this->query($sql);
			echo "success";
		} else if($work->state == "작업지시") {
			$sql = "update work set state='작업취소' where uid=".$this->parameter['uid'];
			$this->query($sql);
			echo "success";
		} else if($work->state == "작업수정지시") {
			echo "modify";
		} else if($work->state == "작업중단") {
			echo "stop";
		} else if($work->state  == "작업취소") {
			echo "cancel";
		}
	}

	// 작업지시
	public function restartWork() {
		// 종료된 작업은 보류를 할 수 없으니 종료된 작업인지 검사
		$sql = "select state from work where uid=".$this->parameter['uid'];
		$this->query($sql);
		$work = $this->fetch();

		if($work->state == "작업종료") {
			echo "finish";
		} else if($work->state == "작업중") {
			echo "ing";
		} else if($work->state == "작업보류") {
			$sql = "update work set state='작업지시' where uid=".$this->parameter['uid'];
			$this->query($sql);
			echo "success";
		} else if($work->state == "작업지시") {
			echo "start";
		} else if($work->state == "작업수정지시") {
			echo "modify";
		} else if($work->state == "작업중단") {
			echo "stop";
		} else if($work->state == "작업취소") {
			echo "cancel";
		}
	}

	// 작업한 품목리스트 가져오기
	public function getWorkMakeItem() {
		$json = new Services_JSON;
		$sql = "select * from work_daily_item where fid=".$this->parameter['uid'];
		//echo $sql;
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$i++;
		}
	
		echo $json->encode($re);
	}

	// 작업일보 리스트 가져오기
	public function getWorkDailyList() {
		$json = new Services_JSON;

		//$this->getTable("work_daily", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		if($this->parameter['work_dt'] != "") $where = "where DATE(create_dt)='".$this->parameter['work_dt']."'";
		if($this->parameter['process'] != 0) $where .= " and process=".$this->parameter['process'];
		if($this->parameter['machine'] != 0) $where .= " and machine=".$this->parameter['machine'];

		$sql = "select * from work_daily ".$where;
		$this->query($sql);

		
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['process'] = $t->process;
			$re[$i]['process_nm'] = $this->getCompareName("process","process_nm","uid",$t->process);
			$re[$i]['machine'] = $t->machine;
			$re[$i]['machine_nm'] = $this->getCompareName("machine","machine_nm","uid",$t->machine);
			$re[$i]['team'] = $t->team;
			$re[$i]['team_nm'] = $this->convertNull($this->getCompareName("team","team_nm","uid",$t->team));
			$re[$i]['lot_no'] = $t->lot_no;
			$re[$i]['create_dt'] = substr($t->create_dt, 0, 10);
			$i++;
		}

		echo $json->encode($re);
	}

	// 수주받은 품목 리스트 가져오기
	public function getProductObtainOrderItemList() {
		$json = new Services_JSON;
		$where = str_replace("@","%",$this->parameter['where']);
		$this->getTable("obtain_order_item", $where, $this->parameter['rpp'], $this->parameter['page'],"uid","desc");

		$i = 0;
		while($t = $this->fetch()){
			$sql = "select order_cd from obtain_order where uid=".$t->fid;
			$this->sub_query($sql);
			$parent = $this->sub_fetch();

			$re[$i]['order_cd'] = $parent->order_cd;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $this->convertNull($t->unit);
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['stock_cnt'] = $this->getStockCnt($t->item_cd);
			$re[$i]['delivery_dt'] = substr($t->delivery_dt,0,10);
			$re[$i]['state'] = $t->state;
			$i++;
		}

		echo $json->encode($re);

	}	

	// 생산실적 등록
	public function registProductResult(){
		$cnt = $this->replaceComma($this->parameter['cnt']);
		$faulty_cnt = $this->replaceComma($this->parameter['faulty_cnt']);
		$data = array(
			"table" => "work_data",
			"process" => $this->parameter['process'],
			"process_nm" => $this->getCompareName("process","process_nm","uid",$this->parameter['process']),
			"machine" => $this->parameter['machine'],
			"machine_nm" => $this->getCompareName("machine","machine_nm","uid",$this->parameter['machine']),
			"item_cd" => $this->parameter['item_cd'],
			"item_nm" => $this->parameter['item_nm'],
			"standard" => $this->parameter['standard'],
			"cnt" => $cnt,
			"faulty_cnt" => $faulty_cnt,
			"faulty_type" => $this->parameter['faulty_type'],
			"warehouse" => $this->parameter['warehouse'],
			"create_dt" => $this->now
		);

		$this->insert($data);

		if($faulty_cnt > 0) {
			$data = array(
				"table" => "faulty",
				"item_cd" => $this->parameter['item_cd'],
				"item_nm" => $this->parameter['item_nm'],
				"standard" => $this->parameter['standard'],
				"cnt" => $faulty_cnt,
				"reason" => $this->getCompareName("faulty_type","faulty_type","uid",$this->parameter['faulty_type']),
				"lot_no" => "",
				"process" => $this->parameter['process'],
				"machine" => $this->parameter['machine'],
				"create_dt" => $this->now
			);

			$this->insert($data);
		}
	}

	// 생산실적 리스트
	public function getProductResultList(){
		$json = new Services_JSON;
		$this->getTable("work_data", $where, $this->parameter['rpp'], $this->parameter['page'],"uid","desc");
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['process'] = $t->process;
			$re[$i]['process_nm'] = $t->process_nm;
			$re[$i]['machine'] = $t->machine;
			$re[$i]['machine_nm'] = $t->machine_nm;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $this->convertNull($t->unit);
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['faulty_cnt'] = $t->faulty_cnt;
			$re[$i]['faulty_type'] = $this->convertNull($this->getCompareName("faulty_type","faulty_type","uid",$t->faulty_type));
			$re[$i]['warehouse'] = $this->getCompareName("warehouse","warehouse_nm","uid",$t->warehouse);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	}
	
	//생산실적 가져오기
	public function getProductResult() {
		$json = new Services_JSON;
		
		$sql = "select * from work_data where uid=".$this->parameter['uid'];
		$this->query($sql);		
		$t = $this->fetch();
		
		$re['uid'] = $t->uid;
		$re['process'] = $t->process;
		$re['process_nm'] = $t->process_nm;
		$re['machine'] = $t->machine;
		$re['machine_nm'] = $t->machine_nm;
		$re['item_cd'] = $t->item_cd;
		$re['item_nm'] = $t->item_nm;
		$re['standard'] = $t->standard;
		$re['unit'] = $this->convertNull($t->unit);
		$re['cnt'] = $t->cnt;
		$re['faulty_cnt'] = $t->faulty_cnt;
		$re['faulty_type'] = $this->convertNull($this->getCompareName("faulty_type","faulty_type","uid",$t->faulty_type));
		$re['warehouse'] = $this->getCompareName("warehouse","warehouse_nm","uid",$t->warehouse);
		$re['create_dt'] = substr($t->create_dt,0,10);

		echo $json->encode($re);
	}

	// 생산현황 등록
	public function registProductionStatus() {
		$jan = $this->replaceComma($this->parameter['jan']);
		$feb = $this->replaceComma($this->parameter['feb']);
		$mar = $this->replaceComma($this->parameter['mar']);
		$apr = $this->replaceComma($this->parameter['apr']);
		$may = $this->replaceComma($this->parameter['may']);
		$jun = $this->replaceComma($this->parameter['jun']);
		$jul = $this->replaceComma($this->parameter['jul']);
		$aug = $this->replaceComma($this->parameter['aug']);
		$sep = $this->replaceComma($this->parameter['sep']);
		$oct = $this->replaceComma($this->parameter['oct']);
		$nov = $this->replaceComma($this->parameter['nov']);
		$dec = $this->replaceComma($this->parameter['dec']);

		$data = array(
			"table" => "production_status",
			"item_cd" => $this->parameter['item_cd'],
			"item_nm" => $this->parameter['item_nm'],
			"standard" => $this->parameter['standard'],
			"unit" => $this->parameter['unit'],
			"years" => $this->parameter['year'],
			"m_jan" => $jan,
			"m_feb" => $feb,
			"m_mar" => $mar,
			"m_apr" => $apr,
			"m_may" => $may,
			"m_jun" => $jun,
			"m_jul" => $jul,
			"m_aug" => $aug,
			"m_sep" => $sep,
			"m_oct" => $oct,
			"m_nov" => $nov,
			"m_dec" => $dec,
		);
		//var_dump($data);
		$this->insert($data);
	}

	// 생산현황 가져오기
	public function getProductionStatusList(){
		$json = new Services_JSON;

		$this->getTable("production_status", $where, $this->parameter['rpp'], $this->parameter['page'],"uid","desc");		
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['year'] = $t->years;
			$re[$i]['jan'] = $t->m_jan;
			$re[$i]['feb'] = $t->m_feb;
			$re[$i]['mar'] = $t->m_mar;
			$re[$i]['apr'] = $t->m_apr;
			$re[$i]['may'] = $t->m_may;
			$re[$i]['jun'] = $t->m_jun;
			$re[$i]['jul'] = $t->m_jul;
			$re[$i]['aug'] = $t->m_aug;
			$re[$i]['sep'] = $t->m_sep;
			$re[$i]['oct'] = $t->m_oct;
			$re[$i]['nov'] = $t->m_nov;
			$re[$i]['dec'] = $t->m_dec;
			$i++;
		}

		echo $json->encode($re);
	}
/*****************************************************************************************************************************/
// 품질관리
/*****************************************************************************************************************************/
	// 품질검사 구분명 등록
	public function registQcClassify() {
		if($this->parameter['classify_uid'] == "") {
			$data = array(
				"table" => "qc_classify",
				"classify_nm" => $this->parameter['classify_nm'],
				"delete_ok" => $this->parameter['delete_ok']
			);
			$this->insert($data);
		} else {
			$data = array(
				"table" => "qc_classify",
				"where" => "uid=".$this->parameter['classify_uid'],
				"classify_nm" => $this->parameter['classify_nm'],
				"delete_ok" => $this->parameter['delete_ok']
			);
			$this->update($data);
		}
	}

	// 품질검사 구분명 리스트
	public function getQcClassifyList() {
		$json = new Services_JSON;

		$sql = "select * from qc_classify";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['classify_nm'] = $t->classify_nm;
			$re[$i]['delete_ok'] = $t->delete_ok;
			$i++;
		}

		echo $json->encode($re);
	}

	// 검사항목저장
	public function registQcItem() {
		if($this->parameter['uid'] == "") {
			$data = array(
				"table" => "qc_item",
				"fid" => $this->parameter['fid'],
				"qc_nm" => $this->parameter['qc_nm'],
				"seq" => $this->parameter['seq'],
				"qc_type" => $this->parameter['qc_type'],
				"qc_type_txt" => $this->parameter['qc_type_txt'],
				"txt" => $this->parameter['txt']
			);

			$this->insert($data);
		} else {
			$data = array(
				"table" => "qc_item",
				"where" => "uid=".$this->parameter['uid'],
				"qc_nm" => $this->parameter['qc_nm'],
				"seq" => $this->parameter['seq'],
				"qc_type" => $this->parameter['qc_type'],
				"qc_type_txt" => $this->parameter['qc_type_txt'],
				"txt" => $this->parameter['txt']
			);

			$this->update($data);
		}
	}

	// 검사항목 가져오기
	public function getQcItemList() {
		$json = new Services_JSON;

		$sql = "select * from qc_item where fid=".$this->parameter['fid'];
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['fid'] = $t->fid;
			$re[$i]['qc_nm'] = $t->qc_nm;
			$re[$i]['seq'] = $t->seq;
			$re[$i]['qc_type'] = $t->qc_type;
			$re[$i]['qc_type_txt'] = $t->qc_type_txt;
			$re[$i]['txt'] = $t->txt;
			$i++;
		}

		echo $json->encode($re);
	}

	// 검사항목 삭제
	public function deleteQcItem() {
		$array_uid = explode(",",$this->parameter['uids']);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			if(!empty($array_uid[$i])) {
				$sql = "delete from qc_item where uid=".$array_uid[$i];
				$this->query($sql);
			}
		}
	}

	// 검사결과등록
	public function registQcResult() {
		echo $this->parameter['uid'];
	}

	// 불량사유 리스트 가져오기
	public function getFaultyReason() {
		$json = new Services_JSON;

		$sql = "select * from faulty_reason";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['reason'] = $t->reason;
			$i++;
		}

		echo $json->encode($re);
	}
	
	// 불량사유 등록하기
	public function registFaultyReason() {
		if($this->parameter['uid'] == "") {
			$data = array(
				"table" => "faulty_reason",
				"reason" => $this->parameter['reason']
			);
			$this->insert($data);
		} else {
			$data = array(
				"table" => "faulty_reason",
				"where" => "uid=".$this->parameter['uid'],
				"reason" => $this->parameter['reason']
			);
			$this->update($data);
		}

		echo "success";
	}

	// 검사대기 리스트 가져오기
	public function getQcList() {
		$json = new Services_JSON;
		$this->getTable("qc", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['lot_no'] = $t->lot_no;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['state'] = $t->state;
			$i++;
		}
	
		echo $json->encode($re);
	}
	
	//QC 가져오기
	public function getQc() {
		$json = new Services_JSON;
		$sql = "select * from qc where uid=".$this->parameter['uid'];
		$this->query($sql);		
		$t = $this->fetch();

		$re['uid'] = $t->uid;
		$re['work_cd'] = $t->work_cd;
		$re['item_cd'] = $t->item_cd;
		$re['item_nm'] = $t->item_nm;
		$re['standard'] = $t->standard;
		$re['cnt'] = $t->cnt;
		$re['lot_no'] = $t->lot_no;
		$re['create_dt'] = substr($t->create_dt,0,10);
		$re['state'] = $t->state;

		echo $json->encode($re);
	}

	// 불량유형 등록
	public function registFaultyType(){
		$data = array(
			"table" => "faulty_type",
			"faulty_type" => $this->parameter['faulty_type']
		);

		$this->insert($data);
	}

	// 불량유형 리스트
	public function getFaultyTypeList(){
		$json = new Services_JSON;

		$sql = "select * from faulty_type";
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['faulty_type'] = $t->faulty_type;
			$i++;
		}

		echo $json->encode($re);
	}

	// 불량리스트
	public function getFaultyList(){
		$json = new Services_JSON;
		$this->getTable("faulty", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['faulty_cnt'] = $t->faulty_cnt;
			$re[$i]['percent'] = ($t->faulty_cnt/$t->cnt)*100;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	}
	
	//불량 가져오기
	public function getFaulty() {
		$json = new Services_JSON;
		
		$sql = "select * from faulty where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();

		$re['uid'] = $t->uid;
		$re['item_cd'] = $t->item_cd;
		$re['item_nm'] = $t->item_nm;
		$re['standard'] = $t->standard;
		$re['cnt'] = $t->cnt;
		$re['faulty_cnt'] = $t->faulty_cnt;
		$re['percent'] = ($t->faulty_cnt/$t->cnt)*100;
		$re['create_dt'] = substr($t->create_dt,0,10);
		
		echo $json->encode($re);
	}

	// 불량현황 등록
	public function registFaultyStatus() {
		$jan = $this->replaceComma($this->parameter['jan']);
		$feb = $this->replaceComma($this->parameter['feb']);
		$mar = $this->replaceComma($this->parameter['mar']);
		$apr = $this->replaceComma($this->parameter['apr']);
		$may = $this->replaceComma($this->parameter['may']);
		$jun = $this->replaceComma($this->parameter['jun']);
		$jul = $this->replaceComma($this->parameter['jul']);
		$aug = $this->replaceComma($this->parameter['aug']);
		$sep = $this->replaceComma($this->parameter['sep']);
		$oct = $this->replaceComma($this->parameter['oct']);
		$nov = $this->replaceComma($this->parameter['nov']);
		$dec = $this->replaceComma($this->parameter['dec']);

		$ord_jan = $this->replaceComma($this->parameter['ord_jan']);
		$ord_feb = $this->replaceComma($this->parameter['ord_feb']);
		$ord_mar = $this->replaceComma($this->parameter['ord_mar']);
		$ord_apr = $this->replaceComma($this->parameter['ord_apr']);
		$ord_may = $this->replaceComma($this->parameter['ord_may']);
		$ord_jun = $this->replaceComma($this->parameter['ord_jun']);
		$ord_jul = $this->replaceComma($this->parameter['ord_jul']);
		$ord_aug = $this->replaceComma($this->parameter['ord_aug']);
		$ord_sep = $this->replaceComma($this->parameter['ord_sep']);
		$ord_oct = $this->replaceComma($this->parameter['ord_oct']);
		$ord_nov = $this->replaceComma($this->parameter['ord_nov']);
		$ord_dec = $this->replaceComma($this->parameter['ord_dec']);

		$data = array(
			"table" => "faulty_status",
			"item_cd" => $this->parameter['item_cd'],
			"item_nm" => $this->parameter['item_nm'],
			"standard" => $this->parameter['standard'],
			"unit" => $this->parameter['unit'],
			"years" => $this->parameter['year'],
			"ord_jan" => $ord_jan,
			"m_jan" => $jan,
			"ord_feb" => $ord_feb,
			"m_feb" => $feb,
			"ord_mar" => $ord_mar,
			"m_mar" => $mar,
			"ord_apr" => $ord_apr,
			"m_apr" => $apr,
			"ord_may" => $ord_may,
			"m_may" => $may,
			"ord_jun" => $ord_jun,
			"m_jun" => $jun,
			"ord_jul" => $ord_jul,
			"m_jul" => $jul,
			"ord_aug" => $ord_aug,
			"m_aug" => $aug,
			"ord_sep" => $ord_sep,
			"m_sep" => $sep,
			"ord_oct" => $ord_oct,
			"m_oct" => $oct,
			"ord_nov" => $ord_nov,
			"m_nov" => $nov,
			"ord_dec" => $ord_dec,
			"m_dec" => $dec,
		);
		//var_dump($data);
		$this->insert($data);
	}

	// 불량현황 가져오기
	public function getFaultyStatusList(){
		$json = new Services_JSON;

		$this->getTable("faulty_status", $where, $this->parameter['rpp'], $this->parameter['page'],"uid","desc");		
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['year'] = $t->years;
			$re[$i]['ord_jan'] = $t->ord_jan;
			$re[$i]['jan'] = $t->m_jan;
			$re[$i]['ord_feb'] = $t->ord_feb;
			$re[$i]['feb'] = $t->m_feb;
			$re[$i]['ord_mar'] = $t->ord_mar;
			$re[$i]['mar'] = $t->m_mar;
			$re[$i]['ord_apr'] = $t->ord_apr;
			$re[$i]['apr'] = $t->m_apr;
			$re[$i]['ord_may'] = $t->ord_may;
			$re[$i]['may'] = $t->m_may;
			$re[$i]['ord_jun'] = $t->ord_jun;
			$re[$i]['jun'] = $t->m_jun;
			$re[$i]['ord_jul'] = $t->ord_jul;
			$re[$i]['jul'] = $t->m_jul;
			$re[$i]['ord_aug'] = $t->ord_aug;
			$re[$i]['aug'] = $t->m_aug;
			$re[$i]['ord_sep'] = $t->ord_sep;
			$re[$i]['sep'] = $t->m_sep;
			$re[$i]['ord_oct'] = $t->ord_oct;
			$re[$i]['oct'] = $t->m_oct;
			$re[$i]['ord_nov'] = $t->ord_nov;
			$re[$i]['nov'] = $t->m_nov;
			$re[$i]['ord_dec'] = $t->ord_dec;
			$re[$i]['dec'] = $t->m_dec;
			$i++;
		}

		echo $json->encode($re);
	}
/*****************************************************************************************************************************/
// 외주.사급관리
/*****************************************************************************************************************************/
	// 외주요청 리스트 가져오기
	public function getOursourcingRequestList() {
		$json = new Services_JSON;
		$this->getTable("orders", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page'],"create_dt" , "desc");

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['account'] = $t->account;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['status'] = $t->status;
			$re[$i]['approval'] = $t->approval;
			$re[$i]['create_dt'] = $t->create_dt;
			$re[$i]['bringin_type'] = $t->bringin_type;
			$re[$i]['send_receive'] = $t->send_receive;
			$re[$i]['memo'] = $t->memo;
			$re[$i]['barcode'] = $t->barcode;
			$re[$i]['arrival'] = $this->convertNull($t->arrival);
			$re[$i]['address'] = $this->convertNull($t->address);
			$i++;
		}

		echo $json->encode($re);
	}

	// 외주요청 하나 가져오기
	public function getOutsourcingRequest() {
		$json = new Services_JSON;
		$sql = "select * from outsourcing_request where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();

		$re['uid'] = $t->uid;
		$re['item_uid'] = $this->getItemUid($t->item_cd,$t->standard);
		$re['item_cd'] = $t->item_cd;
		$re['item_nm'] = $t->item_nm;
		$re['process_cd'] = $t->process_cd;
		$re['process_nm'] = $t->process_nm;
		$re['after_process'] = $t->after_process;
		$re['after_process_nm'] = $t->after_process_nm;
		$re['standard'] = $t->standard;
		$re['cnt'] = $t->cnt;
		$re['unit'] = $t->unit;
		$re['delivery_dt'] = substr($t->delivery_dt,0,10);
		$re['memo'] = $t->memo;
		$re['in_item_process'] = $t->in_item_process;

		echo $json->encode($re);
	}

	// 외주요청 가져오기
	public function getOutsourcingRequest2() {
		$json = new Services_JSON;

		$sql = "select account_nm,create_dt from orders where uid=".$this->parameter['uid'];
		$this->query($sql);
		$order = $this->fetch();

		$sql = "select * from orders_item where fid=".$this->parameter['uid'];
		$this->query($sql);
		
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['order_cd'] = $this->convertNull($t->order_cd);
			$re[$i]['purchase_type'] = $t->purchase_type;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$re[$i]['price'] = $t->price;
			$re[$i]['total_price'] = $t->total_price;
			$re[$i]['status'] = $t->status;
			$re[$i]['account_nm'] = $order->account_nm;
			$re[$i]['create_dt'] = $order->create_dt;

			$i++;
		}

		echo $json->encode($re);
	}

	// 외주창고 재고 가져오기
	public function getOutsourcingWarehouseItem() {
		$json = new Services_JSON();
		$warehouse = "account_warehouse_".$this->parameter['uid'];
		
		$result = $this->isTable($warehouse,DB_NAME);
		if(!$result) {
			$sql = "
				CREATE TABLE `".$warehouse."` (
					`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
					`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
					`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목명',
					`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
					`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
					`cnt` INT(11) NULL DEFAULT NULL COMMENT '수량',
					`create_dt` DATETIME NULL DEFAULT NULL COMMENT '입고일',
					PRIMARY KEY (`uid`),
					INDEX `item_cd` (`item_cd`),
					INDEX `standard` (`standard`)
				)
				COLLATE='utf8_general_ci'
				ENGINE=InnoDB
				;
			";
			$this->query($sql);
		}

		$sql = "select *,sum(cnt) as cnt from ".$warehouse." group by item_cd";
		$this->query($sql);
		
		$i = 0;
		while($t = $this->fetch()) {

			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}

		echo $json->encode($re);

	}

	// 2차 외주원자재 발주대기 리스트 가져오기
	public function getOutsourcingOrderWaitingList() {
		$json = new Services_JSON;
		$sql = "select * from order_waiting where purchase_type='사급'";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$item_uid = $this->getItemUid($t->item_cd, $t->standard);
			//echo $item_uid."<aa>";
			if($item_uid != "") {
				$sql = "select * from item_account where item_fid=".$item_uid;
				$this->sub_query($sql);

				$account = "<select class='account' name='account[]' id='account' onchange='getAccountCost(".$item_uid.", this.value, ".$i.")'><option value='0'>= 거래처선택 =</option>";
				while($tt = $this->sub_fetch()) {
					$account .= "<option value='".$tt->account_fid."'>".$tt->account_nm."</option>";
				}
				$account .= "</select>";
			} else {
				$account = "";
			}
			
			$cost = "<select class='cost' name='cost[]' id='cost_".$i."'><option value='0'>= 구매금액 ==</option></select>";

			$re[$i]['uid'] = $t->uid;
			$re[$i]['fid'] = $t->fid;
			$re[$i]['purchase_type'] = $t->purchase_type;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['account'] = $account;
			$re[$i]['cost'] = $cost;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['delivery_dt'] = substr($t->delivery_dt, 0, 10);
			$i++;
		}

		echo $json->encode($re);
	}

	// 외주창고 가져오기
	public function getOutsourcingWarehouseList() {
		$json = new Services_JSON;
		$sql = "select uid,account_nm from account where outsourcing='y'";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['account_nm'] = $t->account_nm;
			$i++;
		}
		echo $json->encode($re);
	}

	// 거래처 가져오기
	public function getOutsourcingAccountList() {
		$json = new Services_JSON();

		if($this->parameter['page'] != "") {
			$this->getTable("account", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		} else {
			$sql = "select * from account where outsourcing='y'";
			$this->query($sql);			
		}
		
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['classify_nm'] = $this->getAccountClassifyName($t->classify);
			$re[$i]['outsourcing'] = $t->outsourcing;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['owner'] = $this->convertNull($t->owner);
			$re[$i]['owner_mobile'] = $this->convertNull($t->owner_mobile);
			$re[$i]['corp_reg_no'] = $this->convertNull($t->corp_reg_no);
			$re[$i]['corp_no'] = $this->convertNull($t->corp_no);
			$re[$i]['corp_condition'] = $this->convertNull($t->corp_condition);
			$re[$i]['corp_event'] = $this->convertNull($t->corp_event);
			$re[$i]['corp_phone'] = $this->convertNull($t->corp_phone);
			$re[$i]['corp_fax'] = $this->convertNull($t->corp_fax);
			$re[$i]['corp_email'] = $this->convertNull($t->corp_email);
			$re[$i]['corp_zipcode'] = $this->convertNull($t->corp_zipcode);
			$re[$i]['corp_address'] = $this->convertNull($t->corp_address);
			$re[$i]['manager'] = $this->convertNull($t->manager);
			$re[$i]['bank'] = $this->convertNull($t->bank);
			$re[$i]['account'] = $this->convertNull($t->account);
			$re[$i]['account_holder'] = $this->convertNull($t->account_holder);
			$re[$i]['account_id'] = $this->convertNull($t->account_id);
			$re[$i]['account_pwd'] = $this->convertNull($t->account_pwd);
			$re[$i]['create_dt'] = $t->create_dt;

			$sql = "select * from warehouse";
			$this->sub_query($sql);
			$warehouse = $this->sub_fetch();

			$re[$i]['warehouse_cd'] = $this->convertNull($warehouse->uid);
			$re[$i]['warehouse_nm'] = $this->convertNull($warehouse->warehouse_nm);
			$i++;
		}

		echo $json->encode($re);
	}

	// 해당 외주품목을 취급하는 업체 가져오기
	public function getOutsourcingItemAccountList() {
		$json = new Services_JSON();

		$sql = "select account_uid from outsourcing_item where item_uid=".$this->parameter['item_uid'];
		$this->query($sql);
		
		$i = 0;
		while($t = $this->fetch()) {
			$sql = "select uid,account_cd, account_nm from account where uid=".$t->account_uid;
			$this->sub_query($sql);
			$account = $this->sub_fetch();

			if($account->uid != "") {
				$re[$i]['account_uid'] = $account->uid;
				$re[$i]['account_cd'] = $account->account_cd;
				$re[$i]['account_nm'] = $account->account_nm;
			
				$i++;
			}
		}

		echo $json->encode($re);
	}

	// 업체별 외주 품목 등록
	public function moveOutsourcingItem() {
		$array_uid = explode(",",$this->parameter['uids']);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			if(!empty($array_uid[$i])) {
				$sql = "select * from item where uid=".$array_uid[$i];
				$this->query($sql);
				$item = $this->fetch();

				$data = array(
					"table" => "outsourcing_item",
					"account_uid" => $this->parameter['account_uid'],
					"item_uid" => $array_uid[$i],
					"item_cd" => $item->item_cd,
					"item_nm" => $item->item_nm,
					"standard" => $item->standard,
					"unit" => $item->unit,
					"price" => 0
				);

				$this->insert($data);
			}
		}
	}
	
	// 거래처별 외주품목 불러오기
	public function getOutsourcingItemList() {
		$json = new Services_JSON;
		$sql = "select * from outsourcing_item where account_uid=".$this->parameter['account_uid'];
		$this->query($sql);
		
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_uid'] = $t->item_uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['price'] = $t->price;
			$i++;
		}

		echo $json->encode($re);
	}

	// 외주품목 단가 저장
	public function registOutsourcingItemPrice() {
		$data = array(
			"table" => "outsourcing_item",
			"where" => "uid=".$this->parameter['uid'],
			"price" => $this->replaceComma($this->parameter['price'])
		);
		$result = $this->update($data);
		if($result) echo "success";
	}

	// 외주품목에서 제외
	public function removeOutsourcingItem() {
		$sql = "delete from outsourcing_item where uid=".$this->parameter['uid'];
		$this->query($sql);

		echo "success";
	}

	// 사급자재 등록
	public function registBringinMaterial() {
		//var_dump($_POST);
		$sql = "delete from bringin_material where account_uid=".$this->parameter['account_uid']." and item_uid=".$this->parameter['item_uid'];
		$this->query($sql);

		$uid = $this->parameter['uid'];
		$item_cd = $this->parameter['item_cd'];
		$item_nm = $this->parameter['item_nm'];
		$standard = $this->parameter['standard'];
		$unit = $this->parameter['unit'];
		$cnt = $this->parameter['cnt'];

		foreach($uid as $key => $val) {
			$data = array(
				"table" => "bringin_material",
				"account_uid" => $this->parameter['account_uid'],
				"item_uid" => $this->parameter['item_uid'],
				"item_fid" => $val,
				"item_cd" => $item_cd[$key],
				"item_nm" => $item_nm[$key],
				"standard" => $standard[$key],
				"unit" => $unit[$key],
				"cnt" => $cnt[$key],
			);
			$this->insert($data);
		}
	}

	// 해당 품목의 사급자재 가져오기
	public function getBringinMaterial() {
		$json = new Services_JSON;
		$type = 1; // 1일경우에는 품목제조공정의 투입자재를 가져온다
		
		if($type == 1) {
			$sql = "select * from temp_in_item where fid=".$this->parameter['in_item_process'];
		} else {
			if($this->parameter['account_uid'] != "") {
				$sql = "select * from bringin_material where account_uid=".$this->parameter['account_uid']." and item_uid=".$this->parameter['item_uid'];
			} else {
				$sql = "select * from bringin_material where item_uid=".$this->parameter['item_uid'];
			}
		}
		//echo $sql;

		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$i++;
		}

		echo $json->encode($re);
	}
	
	// 해당 외주 품목을 취급하는 업체 가져오기
	public function getOutsourcingAccount() {
		$json = new Services_JSON;

		$sql = "select account_uid from outsourcing_item where item_uid=".$this->parameter['item_uid'];
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$sql = "select * from account where uid=".$t->account_uid;
			$this->sub_query($sql);
			$account = $this->sub_fetch();
			$re[$i]['uid'] = $account->uid;
			$re[$i]['account_cd'] = $account->account_cd;
			$re[$i]['account_nm'] = $account->account_nm;
			$i++;
		}

		echo $json->encode($re);
	}

	// 해당 외주 품목의 정보 가져오기
	public function getItem() {
		$json = new Services_JSON;

		$sql = "select * from item where uid=".$this->parameter['item_uid'];
		$this->query($sql);
		$t = $this->fetch();

		$re['uid'] = $t->uid;
		$re['classify'] = $t->classify;
		$re['classify_nm'] = $this->getCompareName("item_classify","classify_nm","uid",$t->classify);
		$re['group_cd'] = $t->group_cd;
		$re['item_cd'] = $t->item_cd;
		$re['item_nm'] = $t->item_nm;
		$re['standard'] = $t->standard;
		$re['unit'] = $t->unit;
		$re['delivery_period'] = $t->delivery_period;
		$re['cnt'] = $t->cnt;
		$re['stock_cnt'] = $this->getStockCnt($t->item_cd);
		$re['price'] = $t->price;
		$re['safety_stock_cnt'] = $t->safety_stock_cnt;
		$re['barcode'] = $t->barcode;
		$re['img'] = $t->img;
		$re['warehouse_cd'] = $t->warehouse_cd;
		$re['lot_no'] = $t->lot_no;

		echo $json->encode($re);
	}

	// 외주 발주할 때 필요한 사급 품목 리스트 가져오기
	public function getBringinMaterialList() {
		$json = new Services_JSON;

		$sql = "select * from bringin_material where account_uid=".$this->parameter['account_uid']." and item_uid=".$this->parameter['item_uid'];
		//echo $sql;
		$this->query($sql);
		$i = 0;

		while($t = $this->fetch()) {
			$current_stock = $this->getStockCnt($t->item_cd);

			$re[$i]['account_uid'] = $t->account_uid;
			$re[$i]['item_uid'] = $t->item_uid;
			$re[$i]['item_fid'] = $t->item_fid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['current_stock'] = $current_stock;
			$i++;
		}

		echo $json->encode($re);
	}

	// 외주 발주 및 사급자재 구매요청하기
	public function registOutsourcingItem() {
		$purchase = $this->parameter['purchase']; // 구매요청 여부
		$item_cd = $this->parameter['purchase_item_cd']; // 품번
		$item_nm = $this->parameter['purchase_item_nm']; // 품목명
		$standard = $this->parameter['purchase_standard']; // 규격
		$unit = $this->parameter['purchase_unit']; // 단위
		$cnt = $this->parameter['purchase_cnt']; // 소요량
		$require_cnt = $this->parameter['purchase_cnt'];

		//$current_stock = $this->parameter['current_stock'];
		//$purchase_cnt = $this->parameter['purchase_cnt'];

		$bringin_dt = $this->parameter['purchase_delivery_dt'];
		
		$order_cd = $this->createCode("order_cd","orders");
		// 발주

		$sql = "select * from account where uid=".$this->parameter['outsourcing_account'];
		$this->query($sql);
		$account = $this->fetch();

		$sql = "select address from company";
		$this->query($sql);
		$company = $this->fetch();

		$timestamp = time();

		// 붙여서 올 바코드의 다음 공정
		$data = array(
			"table" => "lot_no_process",
			"lot_no" => $timestamp,
			"process" => $this->parameter['after_process_cd'],
			"used" => "n"
		);
		$this->insert($data);

		$data = array(
			"table" => "orders",
			"order_cd" => $order_cd,
			"account" => $this->parameter['outsourcing_account'],
			"account_cd" => $account->account_cd,
			"account_nm" => $account->account_nm,
			"state" => "외주발주",
			"approval" => "n",
			"create_dt" => $this->now,
			//"bringin_type" => $this->parameter['bringin_type'], 유상사급인지 무상사급인지
			"send_receive" => "n",			
			"arrival" => $this->parameter['supplier'],
			"memo" => $this->parameter['memo'],
			"barcode" => $timestamp,
			"address" => $company->corp_address
		);

		$this->insert($data);

		$fid = $this->get_insert_id();
		
		$sql = "select * from outsourcing_item where account_uid=".$this->parameter['outsourcing_account']." and item_cd='".$this->parameter['item_cd']."'";
		$this->query($sql);
		$item = $this->fetch();

		$total_cost = $this->replaceComma($item->price) * $this->replaceComma($this->parameter['cnt']);

		$data = array(
			"table" => "orders_item",
			"fid" => $fid,
			"order_cd" => $order_cd,
			"purchase_type" => "외주",
			"item_cd" => $this->parameter['item_cd'],
			"item_nm" => $this->parameter['item_nm'],
			"standard" => $this->parameter['standard'],
			"unit" => $this->parameter['unit'],
			"cnt" => $this->replaceComma($this->parameter['cnt']),
			"delivery_dt" => $this->parameter['delivery_dt'],
			"big_department" => $_SESSION['big_department'],
			"middle_department" => $_SESSION['middle_department'],
			"small_department" => $_SESSION['small_department'],
			"emp_id" => $_SESSION['login_id'],
			"emp_nm" => $_SESSION['login_nm'],
			"account" => $this->parameter['outsourcing_account'],
			"cost" => $this->replaceComma($item->price),
			"total_cost" => $total_cost,
			"remain_cnt" => $this->replaceComma($this->parameter['cnt']),
			"state" => "발주",
			"approval" => "n",
			"create_dt" => $this->now,
			"arrival" => "본사"
		);

		$this->insert($data);
		
		foreach($item_cd as $key => $val) {
			if($cnt[$key] >0) { // 사급자재 구매요청을 한 경우라면
				$purchase_cd = $this->createCode("purchase_cd","purchase");

				$data = array(
					"table" => "purchase",
					"purchase_cd" => $purchase_cd,
					"order_cd" => $order_cd,
					"title" => "사급자재 구매",
					"purchase_type" => "사급",
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"unit" => $unit[$key],
					"cnt" => $cnt[$key],
					"delivery_dt" => $bringin_dt[$key],
					"big_department" => $_SESSION['big_department'],
					"middle_department" => $_SESSION['middle_department'],
					"small_department" => $_SESSION['small_department'],
					"emp_id" => $_SESSION['login_id'],
					"emp_nm" => $_SESSION['login_nm'],
					"purchase_dt" => $this->now,
					"approval" => "n",
					"state" => "구매요청"
				);
	
				$this->insert($data);
			}
		}

		$sql = "update outsourcing_request set state='발주완료' where uid=".$this->parameter['uid'];
		$this->query($sql);

		echo "success";
	}

	// 2차 외주발주서 불러오기
	public function getOutsourcingOrderList() {
		$json = new Services_JSON;
		$this->getTable("orders", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['account'] = $t->account;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['state'] = $t->state;
			$re[$i]['approval'] = $t->approval;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['send_receive'] = $t->send_receive;
			$i++;
		}
	
		echo $json->encode($re);
	}
/*****************************************************************************************************************************/
// 구매.입고관리
/*****************************************************************************************************************************/
	// 구매요청 리스트 가져오기
	public function getPurchaseList() {
		$json = new Services_JSON();
		$this->getTable("purchase", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page'], "purchase_dt", "asc");
		$i = 0;
		while($t = $this->fetch()) {
			$department = $this->getName("department_middle","department_nm",$t->middle_department)."-".$this->getName("department_small","department_nm",$t->small_department);

			$re[$i]['uid'] = $t->uid;
			$re[$i]['purchase_cd'] = $t->purchase_cd;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['title'] = $t->title;
			$re[$i]['purchase_type'] = $t->purchase_type;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['delivery_dt'] = substr($t->delivery_dt, 0, 10);
			$re[$i]['big_department'] = $t->big_department;
			$re[$i]['middle_department'] = $t->middle_department;
			$re[$i]['small_department'] = $t->small_department;
			$re[$i]['department'] = $department;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['purchase_dt'] = substr($t->purchase_dt, 0, 10);
			$re[$i]['approval'] = $t->approval;
			$re[$i]['state'] = $t->state;
			$i++;
		}

		echo $json->encode($re);
	}
	
	//구매요청 가져오기
	public function getPurchase() {
		$json = new Services_JSON;
		
		$sql = "select * from purchase where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();
		
		$department = $this->getName("department_middle","department_nm",$t->middle_department)."-".$this->getName("department_small","department_nm",$t->small_department);

		$re['uid'] = $t->uid;
		$re['purchase_cd'] = $t->purchase_cd;
		$re['order_cd'] = $t->order_cd;
		$re['title'] = $t->title;
		$re['purchase_type'] = $t->purchase_type;
		$re['item_cd'] = $t->item_cd;
		$re['item_nm'] = $t->item_nm;
		$re['standard'] = $t->standard;
		$re['unit'] = $t->unit;
		$re['cnt'] = $t->cnt;
		$re['delivery_dt'] = substr($t->delivery_dt, 0, 10);
		$re['big_department'] = $t->big_department;
		$re['middle_department'] = $t->middle_department;
		$re['small_department'] = $t->small_department;
		$re['department'] = $department;
		$re['emp_id'] = $t->emp_id;
		$re['emp_nm'] = $t->emp_nm;
		$re['purchase_dt'] = substr($t->purchase_dt, 0, 10);
		$re['approval'] = $t->approval;
		$re['state'] = $t->state;

		echo $json->encode($re);
	}

	// 발주대기로 보내기
	public function sendOrderStay() {
		$array_uid = explode(",",$this->parameter['uids']);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			if(!empty($array_uid[$i])) {
				// 구매요청 목록을 읽어온다
				$sql = "select * from purchase where uid=".$array_uid[$i];
				$this->query($sql);
				$t = $this->fetch();
				
				$sql = "select * from order_waiting where purchase_type='".$t->purchase_type."' and item_cd='".$t->item_cd."' and standard='".$t->standard."'";
				$this->sub_query($sql);
				$waiting = $this->sub_fetch();

				if($this->sub_get_rows() > 0) {
					$cnt = $waiting->cnt + $t->cnt;

	
					$data = array(
						"table" => "order_waiting",
						"where" => "uid=".$waiting->uid,
						"fid" => $t->uid,
						"obtain_order_cd" => $t->obtain_order_cd,
						"cnt" => $cnt,
						"delivery_dt" => $t->delivery_dt
					);
					$this->update($data);


					$sql = "update order_waiting set fid=$t->uid, obtain_order_cd='$t->obtain_order_cd', cnt=$cnt, delivery_dt='$t->delivery_dt' where uid=$waiting->uid";
					mysql_query($sql);
					

					$data = array(
						"table" => "purchase",
						"where" => "uid=".$array_uid[$i],
						"state" => "발주대기"
					);

					$this->update($data);
				} else {

					$data = array(
						"table" => "order_waiting",
						"fid" => $t->uid,
						"obtain_order_cd" => $t->order_cd,
						"purchase_type" => $t->purchase_type,
						"item_cd" => $t->item_cd,
						"item_nm" => $t->item_nm,
						"standard" => $t->standard,
						"unit" => $t->unit,
						"cnt" => $t->cnt,
						"delivery_dt" => $t->delivery_dt,
						"big_department" => $t->big_department,
						"middle_department" => $t->middle_department,
						"small_department" => $t->small_department,
						"emp_id" => $t->emp_id,
						"emp_nm" => $t->emp_nm
					);

					$this->insert($data);

					$data = array(
						"table" => "purchase",
						"where" => "uid=".$array_uid[$i],
						"state" => "발주대기"
					);

					$this->update($data);
				}
			}
		}

		echo "success";
	}
	
	// 2차 발주대기 리스트 가져오기
	public function getOrderWaitingList() {
		$json = new Services_JSON;
		$sql = "select * from order_waiting where purchase_type='내수'";
		//$sql = "select * from order_waiting";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$item_uid = $this->getItemUid($t->item_cd, $t->standard);
			//echo $item_uid."<aa>";
			if($item_uid != "") {
				$sql = "select * from item_account where item_fid=".$item_uid;
				$this->sub_query($sql);

				$account = "<select class='account' name='account[]' id='account_".$i."' onchange='getAccountCost(".$item_uid.", this.value, ".$i.")'><option value='0'>= 거래처선택 =</option>";
				while($tt = $this->sub_fetch()) {
					$account .= "<option value='".$tt->account_fid."'>".$tt->account_nm."</option>";
				}
				$account .= "</select>";
			} else {
				$account = "";
			}
			
			$cost = "<select class='cost' name='cost[]' id='cost_".$i."'><option value='0'>= 구매금액 ==</option></select>";

			$re[$i]['uid'] = $t->uid;
			$re[$i]['fid'] = $t->fid;
			$re[$i]['purchase_type'] = $t->purchase_type;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['account'] = $account;
			$re[$i]['cost'] = $cost;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['delivery_dt'] = substr($t->delivery_dt, 0, 10);
			$i++;
		}

		echo $json->encode($re);
	}

	// 2차 발주확정하기
	public function registOrder() {
		$uid = $this->parameter['uid'];
		$account = $this->parameter['account'];
		$cost = $this->parameter['cost'];
		$arrival = $this->parameter['arrival'];
		$fid = array();
		$arrival_array = array();
		$account_array = array();
		$order_array = array();
		$payable_fid_array = array();
		
		foreach($uid as $key => $val) {
			if(!empty($val)) {
				$sql = "select * from order_waiting where uid=".$val;
				$this->query($sql);
				$order = $this->fetch();
				$total_cost = $this->replaceComma($cost[$key]) * $this->replaceComma($order->cnt);
				$data = array(
					"table" => "order_sorting",
					"obtain_order_cd" => $order->obtain_order_cd,
					"purchase_type" => $order->purchase_type,
					"item_cd" => $order->item_cd,
					"item_nm" => $order->item_nm,
					"standard" => $order->standard,
					"unit" => $order->unit,
					"cnt" => $this->replaceComma($order->cnt),
					"delivery_dt" => $order->delivery_dt,
					"big_department" => $order->big_department,
					"middle_department" => $order->middle_department,
					"small_department" => $order->small_department,
					"emp_id" => $order->emp_id,
					"emp_nm" => $order->emp_nm,
					"account" => $account[$key],
					"cost" => $this->replaceComma($cost[$key]),
					"total_cost" => $total_cost,
					"arrival" => $arrival[$key]
				);

				$result = $this->insert($data);

				if($result) {
					$sql = "delete from order_waiting where uid=".$val;
					$this->query($sql);
				} else {
					echo "db 삭제 실패";
				}
				
				// 같은 거래처 그리고 발주일이 같으면 발주를 못내는 현상이 발생
				//$order_cd = $this->createCode("order_cd","orders");
				$sql = "select uid from orders where account=".$account[$key]." and DATE(create_dt) = DATE(now())";
				//echo $sql;
				$this->query($sql);
				$t = $this->fetch();




				if($this->get_rows() < 1) {
					$order_cd = $this->createCode("order_cd","orders");
					
					$sql = "select account_cd, account_nm from account where uid=".$account[$key];
					$this->query($sql);
					$acc = $this->fetch();

					if($arrival[$key] == "본사") {
						$sql = "select address from company";
						$this->sub_query($sql);
						$company = $this->sub_fetch();

						$address = $company->address;
					} else if($arrival[$key] == "외주업체") {
						$sql = "select corp_address from account where account_cd='".$acc->account_cd."'";
						$this->sub_query($sql);
						$company = $this->sub_fetch();

						$address = $company->corp_address;
					} else {
						$address = "주소없음";
					}

					$data = array(
						"table" => "orders",
						"order_cd" => $order_cd,
						"account" => $account[$key],
						"account_cd" => $acc->account_cd,
						"account_nm" => $acc->account_nm,
						"state" => "발주",
						"approval" => "n",
						"create_dt" => $this->now,
						"send_receive" => "n",
						"arrival" => $this->convertNull($arrival[$key]),
						"address" => $address
					);

					$this->insert($data);

					// 미지급금 내역 저장
					$sql = "select * from account where uid=".$account[$key];
					$this->query($sql);
					$acc = $this->fetch();

					$data = array(
						"table" => "payable",
						"account_cd" => $acc->account_cd,
						"account_nm" => $acc->account_nm,
						"amount" => 0,
						"create_dt" => $this->now,
						"telephone" => $acc->corp_phone,
						"mobile" => $acc->owner_mobile,
						"owner" => $acc->owner,
						"provide_amount" => 0,
						"remain_amount" => 0,
						"last_provide_dt" => "",
						"next_provide_dt" => "",
						"state" => "y"
					);

					$this->insert($data);
					$payable_fid = $this->get_insert_id();

					array_push($payable_fid_array, $payable_fid);
					array_push($account_array, $account[$key]);
					array_push($arrival_array, $arrival[$key]);
					array_push($fid, mysql_insert_id());
					array_push($order_array, $order_cd);
				} else {									
					array_push($account_array, $account[$key]);
					array_push($arrival_array, $arrival[$key]);
					array_push($fid, $t->uid);
					array_push($order_array, $order_cd);
				}
			}
		}
		
		// 같은 거래처 그리고 발주일이 같으면 발주를 못내는 현상이 발생 $fid 에 값이 들어 있지 않으므로 실행이 되지 않는다
		for($i = 0 ; $i < sizeof($fid) ; $i++) {
			if($fid[$i] != "") {
				$sql = "select * from order_sorting where account=".$account_array[$i];				
				$this->query($sql);
				$payable_total = 0;
				while($t = $this->fetch()) {
					//if($t->arrival == "") $arrival = "n"; else $arrival="y";
					$data = array(
						"table" => "orders_item",
						"fid" => $fid[$i],
						"order_cd" => $order_array[$i],
						"purchase_type" => $t->purchase_type,
						"item_cd" => $t->item_cd,
						"item_nm" => $t->item_nm,
						"standard" => $t->standard,
						"unit" => $t->unit,
						"cnt" => $t->cnt,
						"delivery_dt" => $t->delivery_dt,
						"big_department" => $t->big_department,
						"middle_department" => $t->middle_department,
						"small_department" => $t->small_department,
						"emp_id" => $t->emp_id,
						"emp_nm" => $t->emp_nm,
						"account" => $t->account,
						"cost" => $t->cost,
						"total_cost" => $t->total_cost,
						"remain_cnt" => $t->cnt,
						"state" => "발주",
						"approval" => "n",
						"create_dt" => $this->now,
						"arrival" => $this->convertNull($t->arrival)
					);

					$result = $this->insert($data);

					if($result) {
						$sql = "delete from order_sorting where uid=".$t->uid;
						$this->sub_query($sql);
					}

					// 미지급금 디테일
					$data = array(
						"table" => "payable_item",
						"fid" => $payable_fid,
						"item_cd" => $t->item_cd,
						"item_nm" => $t->item_nm,
						"standard" => $t->standard,
						"unit" => $t->unit,
						"cnt" => $t->cnt,
						"cost" => $t->cost,
						"total_cost" => $t->total_cost
					);
					$this->insert($data);
					$payable_total = $payable_total + $t->total_cost;
										
					if($t->arrival == "외주업체") {
						$sql = "select account from orders where order_cd='".$order->obtain_order_cd."'";
						$this->query($sql);
						$outsourcing = $this->fetch();

						$warehouse = "account_warehouse_".$outsourcing->account;

						$result = $this->isTable($warehouse,DB_NAME);
						
						if($result) { // 업체창고가 있다면
							$data = array(
								"table" => $warehouse,
								"item_cd" => $t->item_cd,
								"item_nm" => $t->item_nm,
								"standard" => $t->standard,
								"unit" => $t->unit,
								"cnt" => $t->cnt,
								"create_dt" => $this->now
							);
			
							$result = $this->insert($data);
						} else { //창고를 생성
							$sql = "
								CREATE TABLE `".$warehouse."` (
									`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
									`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
									`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목명',
									`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
									`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
									`cnt` INT(11) NULL DEFAULT NULL COMMENT '수량',
									`create_dt` DATETIME NULL DEFAULT NULL COMMENT '입고일',
									PRIMARY KEY (`uid`),
									INDEX `item_cd` (`item_cd`),
									INDEX `standard` (`standard`)
								)
								COLLATE='utf8_general_ci'
								ENGINE=InnoDB
								;
							";
							$this->query($sql);

							$data = array(
								"table" => $warehouse,
								"item_cd" => $t->item_cd,
								"item_nm" => $t->item_nm,
								"standard" => $t->standard,
								"unit" => $t->unit,
								"cnt" => $t->cnt,
								"create_dt" => $this->now
							);
		
							$result = $this->insert($data);
						}
					}

				}
				$sql = "update payable set amount=".$payable_total.", remain_amount=".$payable_total." where uid=".$payable_fid_array[$i];
				echo $sql;
				$this->query($sql);
			}
		}		
	}

	// 2차 발주서 불러오기
	public function getOrderList() {
		$json = new Services_JSON;
		$this->getTable("orders", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['account'] = $t->account;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['status'] = $t->status;
			$re[$i]['approval'] = $t->approval;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['send_receive'] = $t->send_receive;
			$re[$i]['arrival'] = $this->convertNull($t->arrival);
			$re[$i]['address'] = $this->convertNull($t->address);
			$i++;
		}
		echo $json->encode($re);
	}

	// 2차 발주서에서 발주품목 가져오기
	public function getOrdersItem() {
		$json = new Services_JSON;
		$sql = "select * from orders_item where fid=".$this->parameter['uid'];
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$department = $this->getName("department_middle","department_nm",$t->middle_department)."-".$this->getName("department_small","department_nm",$t->small_department);

			$re[$i]['uid'] = $t->uid;
			$re[$i]['order_cd'] = $this->convertNull($t->order_cd);
			$re[$i]['purchase_type'] = $t->purchase_type;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$re[$i]['delivery_dt'] = substr($t->delivery_dt,0,10);
			$re[$i]['department'] = $department;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['account'] = $t->account;
			$re[$i]['account_nm'] = $this->getCompareName("account","account_nm","uid",$t->account);
			$re[$i]['cost'] = $t->cost;
			$re[$i]['total_cost'] = $t->total_cost;
			$re[$i]['state'] = $t->state;
			$re[$i]['approval'] = $t->approval;
			$i++;
		}
		echo $json->encode($re);
	}
	
	//입고 대기 가져오기, 외주 품목 입고현황 가져오기
	public function getOrdersItem2() {
		$json = new Services_JSON;
		$sql = "select * from orders_item where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();

		$department = $this->getName("department_middle","department_nm",$t->middle_department)."-".$this->getName("department_small","department_nm",$t->small_department);

		$re['uid'] = $t->uid;
		$re['order_cd'] = $this->convertNull($t->order_cd);
		$re['purchase_type'] = $t->purchase_type;
		$re['item_cd'] = $t->item_cd;
		$re['item_nm'] = $t->item_nm;
		$re['standard'] = $t->standard;
		$re['unit'] = $t->unit;
		$re['cnt'] = $t->cnt;
		$re['remain_cnt'] = $t->remain_cnt;
		$re['delivery_dt'] = substr($t->delivery_dt,0,10);
		$re['department'] = $department;
		$re['emp_id'] = $t->emp_id;
		$re['emp_nm'] = $t->emp_nm;
		$re['account'] = $t->account;
		$re['account_nm'] = $this->getCompareName("account","account_nm","uid",$t->account);
		$re['cost'] = $t->cost;
		$re['total_cost'] = $t->total_cost;
		$re['state'] = $t->state;
		$re['approval'] = $t->approval;

		echo $json->encode($re);
	}

	// 2차 입고대기 품목 가져오기
	public function getOrdersItemList() {
		$json = new Services_JSON;
		$where = str_replace("@","%",$this->parameter['where']);
		$this->getTable("orders_item", $where, $this->parameter['rpp'], $this->parameter['page']);
		//$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$department = $this->getName("department_middle","department_nm",$t->middle_department)."-".$this->getName("department_small","department_nm",$t->small_department);

			$re[$i]['uid'] = $t->uid;
			$re[$i]['order_cd'] = $this->convertNull($t->order_cd);
			$re[$i]['purchase_type'] = $t->purchase_type;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$re[$i]['delivery_dt'] = substr($t->delivery_dt,0,10);
			$re[$i]['department'] = $department;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['account'] = $t->account;
			$re[$i]['account_nm'] = $this->getCompareName("account","account_nm","uid",$t->account);
			$re[$i]['cost'] = $t->cost;
			$re[$i]['total_cost'] = $t->total_cost;
			$re[$i]['state'] = $t->status;
			$re[$i]['approval'] = $t->approval;
			$i++;
		}

		echo $json->encode($re);
	}

	// 2차 구매요청 품목 입고시키기
	public function registWarehousing() {
		$cnt = $this->replaceComma($this->parameter['in_cnt']) + $this->replaceComma($this->parameter['add_cnt']);
		$warehouse = "warehouse_".$this->parameter['warehouse'];

		$sql = "select * from orders_item where uid=".$this->parameter['uid'];
		$this->query($sql);
		$item = $this->fetch();
		$timestamp = time();

		// 외주품목이면 거래처 창고에서 사급자재 삭감하기
		if($item->purchase_type == "외주") {
			// 외주거래처 찾기
			$sql = "select account from orders where uid=".$item->fid;
			$this->query($sql);
			$outsourcing_account = $this->fetch();
			// 외주 창고
			$outsourcing_warehouse = "account_warehouse_".$outsourcing_account->account;
			// 외주품목 uid 찾기
			$item_uid = $this->getItemUid($item->item_cd, $item->standard);

			$sql = "select * from bringin_material where account_uid=".$outsourcing_account->account." and item_uid=".$item_uid;
			$this->query($sql);
			while($t = $this->fetch()) {
				$sql = "select * from ".$outsourcing_warehouse." where item_cd='".$t->item_cd."'";
				$this->sub_query($sql);
				$outsourcing_item = $this->sub_fetch();

				$minus_cnt = $cnt * $t->cnt;

				$new_cnt = $outsourcing_item->cnt - $minus_cnt;

				$sql = "update ".$outsourcing_warehouse." set cnt=".$new_cnt." where uid=".$outsourcing_item->uid;
				$this->sub_query($sql);
			}
		}
		
		$data = array(
			"table" => $warehouse,
			"fid" => $this->parameter['warehouse'],
			"item_cd" => $item->item_cd,
			"item_nm" => $item->item_nm,
			"standard" => $item->standard,
			"unit" => $item->unit,
			"cnt" => $cnt,
			"lot_no" => $timestamp,
			"create_dt" => $this->now
		);
		$result = $this->insert($data);
		
		$data = array(
			"table" => "lot_no",
			"classify" => "I",
			"lot_no" => $timestamp,
			"account_cd" => $this->getCompareName("account","account_cd","uid",$item->account),
			"account_nm" => $this->getCompareName("account","account_nm","uid",$item->account),
			"price" => $item->cost,
			"in_cnt" => $item->cnt,
			"item_cd" => $item->item_cd,
			"item_nm" => $item->item_nm,
			"standard" => $item->standard,
			"unit" => $item->unit,
			"emp_id" => $_SESSION['login_id'],
			"emp_nm" => $_SESSION['login_nm'],
			"process" => 0,
			"process_nm" => "",
			"machine" => 0,
			"machine_nm" => "",
			"team" => 0,
			"team_nm" => "",
			"sales_account_cd" => "",
			"sales_account_nm" => "",
			"sales_price" => 0,
			"out_cnt" => 0,
			"create_dt" => $this->now
		);
		$this->insert($data);

		if($item->remain_cnt <= $cnt) {
			$state = "입고완료";
			$remain_cnt = 0;
		} else {
			$state = "부분입고";
			$remain_cnt = $item->cnt - $cnt;
		}

		if($result) {
			$sql = "update orders_item set remain_cnt=".$remain_cnt.", state='".$state."' where uid=".$this->parameter['uid'];
			$this->query($sql);

			$this->registInOut("in","구매입고",$item->item_cd,$cnt,$item->cost,$this->parameter['lot_no']);
		}
	}

	// 발주서 합치기
	public function sumOrder() {
		// 임시테이블 생성

		$sql = "drop table orders_imsi";
		@$this->query($sql);
		$sql = "
			create TEMPORARY TABLE orders_imsi (
				order_cd varchar(50),
				account varchar(50),
				account_cd varchar(50),
				account_nm varchar(50)
			) CHARACTER SET utf8 COLLATE utf8_general_ci;
		";
		$this->query($sql);

		$uid = $this->parameter['order_uid'];
		if(sizeof($uid) < 2) {
			echo "short";
			exit;
		}
		
		$i = 0;
		foreach($uid as $key => $val) {
			if($val != "") { //한번만 실행을 하
				if($i ==0) {
					$sql = "select * from orders where uid=".$val;
					$this->query($sql);
					$t = $this->fetch();

					$data = array(
						"table" => "orders_imsi",
						"order_cd" => $t->order_cd,
						"account" => $t->account,
						"account_cd" => $t->account_cd,
						"account_nm" => $t->account_nm
					);
					$this->insert($data);
					$i++;
				}
			}
		}
	}

	// 간편구매요청
	public function registEasyOrder() {

		$uid = $this->parameter['uid'];
		$item_cd = $this->parameter['item_cd'];
		$item_nm = $this->parameter['item_nm'];
		$standard = $this->parameter['standard'];
		$unit = $this->parameter['unit'];
		$cnt = $this->parameter['cnt'];
		$purchase_price = $this->parameter['purchase_price'];
		$total_price = $this->replaceComma($this->parameter['total_price']);



		$order_cd = $this->createCode("order_cd","orders");

		$sql = "select uid from account where account_cd='".$this->parameter['account_cd']."' " ;	
			$this->query($sql);
			$t = $this->fetch();
			$account = $t->uid;
		
		//발주서 저장
		$data = array(
			"table" => "orders",
			"order_cd" => $order_cd,
			"account" => $account,
			"account_cd" => $this->parameter['account_cd'],
			"account_nm" => $this->parameter['account_nm'],
			"state" => "발주",
			"approval" => "n",
			"create_dt" => $this->now,
			"send_receive" => "n",
			"arrival" => "",
			"address" => ""
		);

		$this->insert($data);
		$order_fid = $this->get_insert_id();


		// 미지급금 내역 저장
		$sql = "select * from account where uid=".$account;
		$this->query($sql);
		$acc = $this->fetch();

		$data = array(
			"table" => "payable",
			"account_cd" => $acc->account_cd,
			"account_nm" => $acc->account_nm,
			"amount" => 0,
			"create_dt" => $this->now,
			"telephone" => $acc->corp_phone,
			"mobile" => $acc->owner_mobile,
			"owner" => $acc->owner,
			"provide_amount" => 0,
			"remain_amount" => 0,
			"last_provide_dt" => "",
			"next_provide_dt" => "",
			"state" => "y"
		);

		$this->insert($data);
		$payable_fid = $this->get_insert_id();


		//발주품목 저장
		$payable_total = 0;
		foreach($item_cd as $key => $val ){

			$data = array(
				"table" => "orders_item",
				"fid" => $order_fid,
				"order_cd" => "",
				"purchase_type" => "내수",
				"item_cd" => $val,
				"item_nm" => $item_nm[$key],
				"standard" => $standard[$key],
				"unit" => $unit[$key],
				"cnt" => $cnt[$key],
				"delivery_dt" => $this->parameter['delivery_dt'],
				"big_department" => "",
				"middle_department"=> "",
				"small_department" => "",
				"emp_id" => $_SESSION['login_id'],
				"emp_nm" => $_SESSION['login_nm'],
				"account" => $account,
				"cost" => $purchase_price[$key],
				"total_cost" => $total_price[$key],
				"remain_cnt" => $cnt[$key],
				"state" => "발주",
				"approval" => "n",
				"create_dt" => $this->now,
				"arrival" => ""
			);

			$this->insert($data);


			// 미지급금 디테일
			$data = array(
				"table" => "payable_item",
				"fid" => $payable_fid,
				"item_cd" => $val,
				"item_nm" => $item_nm[$key],
				"standard" => $standard[$key],
				"unit" => $unit[$key],
				"cnt" => $cnt[$key],
				"cost" => $purchase_price[$key],
				"total_cost" => $total_price[$key],
			);
			$this->insert($data);
			$payable_total = $payable_total + $total_price[$key];

		}

		$sql = "update payable set amount=".$payable_total.", remain_amount=".$payable_total." where uid=".$payable_fid;
		//echo $sql;
		$this->query($sql);			
	}
/*****************************************************************************************************************************/
// 출고.출하관리
/*****************************************************************************************************************************/
	// 출하보고서 코드생성
	public function createShipmentCode(){
		$shipment_cd = $this->createCode("shipment_cd","shipment_report");
		echo $shipment_cd;
	}

	// 출고요청 리스트
	public function getReleaseList() {
		$json = new Services_JSON();
		$this->getTable("releases", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		$i = 0;
		while($t = $this->fetch()) {			
			$re[$i]['uid'] = $t->uid;			
			$re[$i]['classify'] = $t->classify;
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['process'] = $t->process;
			$re[$i]['process_nm'] = $this->convertNull($this->getCompareName("process","process_nm","uid",$t->process));
			$re[$i]['machine'] = $t->machine;
			$re[$i]['machine_nm'] = $this->convertNull($this->getCompareName("machine","machine_nm","uid",$t->machine));
			$re[$i]['team'] = $t->team;
			$re[$i]['team_nm'] = $this->convertNull($this->getCompareName("team","team_nm","uid",$t->team));
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['state'] = $t->state;
			$re[$i]['create_dt'] = substr($t->create_dt, 0, 10);
			
			$i++;
		}

		echo $json->encode($re);
	}

	public function getRelease() {
		$json = new Services_JSON();
		$sql = "select * from releases where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();
		
		$re['uid'] = $t->uid;			
		$re['classify'] = $t->classify;
		$re['work_cd'] = $t->work_cd;
		$re['process'] = $t->process;
		$re['process_nm'] = $this->convertNull($this->getCompareName("process","process_nm","uid",$t->process));
		$re['machine'] = $t->machine;
		$re['machine_nm'] = $this->convertNull($this->getCompareName("machine","machine_nm","uid",$t->machine));
		$re['team'] = $t->team;
		$re['team_nm'] = $this->convertNull($this->getCompareName("team","team_nm","uid",$t->team));
		$re['item_cd'] = $t->item_cd;
		$re['item_nm'] = $t->item_nm;
		$re['standard'] = $t->standard;
		$re['unit'] = $t->unit;
		$re['cnt'] = $t->cnt;
		$re['remain_cnt'] = $t->remain_cnt;
		$re['emp_id'] = $t->emp_id;
		$re['emp_nm'] = $t->emp_nm;
		$re['state'] = $t->state;
		$re['create_dt'] = substr($t->create_dt, 0, 10);

		echo $json->encode($re);
	}

	// 자재수불부 가져오기
	public function getInOutList() {
		$json = new Services_JSON;

		$sql = "select * from in_out where item_cd='".$this->parameter['item_cd']."' order by uid desc";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['in_cnt'] = $t->in_cnt;
			$re[$i]['in_price'] = $t->in_price;
			$re[$i]['in_total_price'] = $t->in_total_price;
			$re[$i]['out_cnt'] = $t->out_cnt;
			$re[$i]['out_price'] = $t->out_price;
			$re[$i]['out_total_price'] = $t->out_total_price;
			$re[$i]['lot_no'] = $t->lot_no;
			$re[$i]['reason'] = $t->reason;
			$re[$i]['create_dt'] = $t->create_dt;
			$i++;
		}

		echo $json->encode($re);
	}

	// 출하완료보고서 등록
	public function registShipmentReport() {
		$warehouse_uid = $this->parameter['warehouse_uid'];
		$warehouse = $this->parameter['warehouse'];
		$cnt = $this->parameter['cnt'];
		if($this->parameter['cost'] == "") $cost = 0;
		else $cost = $this->parameter['cost'];
		$total = 0;

		foreach($cnt as $key => $val){
			if($val > 0) {
				$total = $total + $val;
				$wh = "warehouse_".$warehouse[$key];

				$sql = "select cnt from ".$wh." where uid=".$warehouse_uid[$key];
				$this->query($sql);
				$t = $this->fetch();

				$new_cnt = $t->cnt - $val;

				$sql = "update ".$wh." set cnt=".$new_cnt." where uid=".$warehouse_uid[$key];
				$this->query($sql);
			}
		}

		$remain_cnt = $this->replaceComma($this->parameter['remain_cnt']) - $total;
		$data = array(
			"table" => "shipment_report",
			"fid" => $this->parameter['fid'],
			"shipment_cd" => $this->parameter['shipment_cd'],
			"account_cd" => $this->parameter['account_cd'],
			"account_nm" => $this->parameter['account_nm'],
			"item_cd" => $this->parameter['item_cd'],
			"item_nm" => $this->parameter['item_nm'],
			"cnt" => $total,
			"remain_cnt" => $remain_cnt,
			"delivery_type" => $this->parameter['delivery_type'],
			"car_no" => $this->parameter['car_no'],
			"cost" => $cost,
			"address" => $this->parameter['address'],
			"create_dt" => $this->now
		);
		//var_dump($data);
		$this->insert($data);

		$sql = "update shipment set remain_cnt=".$remain_cnt." where uid=".$this->parameter['fid'];
		$this->query($sql);
	}

	// 출하지시서 리스트
	public function getShipmentList() {
		$json = new Services_JSON;
		$this->getTable("shipment", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page'], "shipment_dt", "asc");
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['obtain_order_cd'] = $t->obtain_order_cd;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['shipment_dt'] = substr($t->shipment_dt,0,10);
			$re[$i]['address'] = $t->address;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['state'] = $t->status;
			$i++;
		}
		echo $json->encode($re);
	}
	
	// 출하지시품목 가져오기
	public function getShipmentItem(){
		$json = new Services_JSON;

		$sql = "select * from shipment_item where fid=".$this->parameter['uid'];
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$i++;
		}

		echo $json->encode($re);
	}

	// 출하지시서 가져오기
	public function getShipment() {
		$json = new Services_JSON;
		
		$sql = "select * from shipment where uid=".$this->parameter['uid'];
		$this->query($sql);		
		$t = $this->fetch();
		
		$re['uid'] = $t->uid;
		$re['obtain_order_cd'] = $t->obtain_order_cd;
		$re['account_cd'] = $t->account_cd;
		$re['account_nm'] = $t->account_nm;
		$re['shipment_dt'] = substr($t->shipment_dt,0,10);
		$re['address'] = $t->address;
		$re['emp_id'] = $t->emp_id;
		$re['emp_nm'] = $t->emp_nm;
		$re['create_dt'] = substr($t->create_dt,0,10);
		$re['state'] = $t->state;

		echo $json->encode($re);
	}	

	// 자재출고
	public function registReleaseItem() {
		// 해당 창고에서 해당 품목의 수량을 변경한다
		$warehouse = "warehouse_".$this->parameter['warehouse'];
		$sql = "select * from ".$warehouse." where uid=".$this->parameter['warehouse_uid'];
		$this->query($sql);
		$t = $this->fetch();

		$remain_cnt = $t->cnt - $this->parameter['cnt'];

		if($remain_cnt == 0) {
			$sql = "delete from ".$warehouse." where uid=".$this->parameter['warehouse_uid'];
			$this->query($sql);
			
		} else {
			$sql = "update ".$warehouse." set cnt=".$remain_cnt." where uid=".$this->parameter['warehouse_uid'];
			$this->query($sql);
		}

		$sql = "select * from releases where uid=".$this->parameter['uid'];
		$this->query($sql);
		$release = $this->fetch();

		$release_remain_cnt = $release->remain_cnt - $this->parameter['cnt'];
		if($release_remain_cnt == 0) $state = "출고완료";
		else $state = "부분출고";

		$sql = "update releases set remain_cnt=".$release_remain_cnt.", state='".$state."' where uid=".$this->parameter['uid'];
		$this->query($sql);

		$data = array(
			"table" => "releases_warehouse",
			"work_cd" => $release->work_cd,
			"process" => $release->process,
			"machine" => $release->machine,
			"team" => $release->team,
			"item_cd" => $release->item_cd,
			"item_nm" => $release->item_nm,
			"standard" => $release->standard,
			"unit" => $release->unit,
			"cnt" => $this->parameter['cnt'],
			"state" => "보관",
			"lot_no" => $this->parameter['lot_no'],
			"create_dt" => $this->now
		);
		$this->insert($data);
		
		/*
		$data = array(
			"table" => "lot_no",
			"timestamp" => $timestamp,
			"lot_no" => $this->parameter['lot_no'],
			"create_dt" => $this->now
		);
		$this->insert($data);
		*/

		// 보내야 하는 공정 기록
		$data = array(
			"table" => "lot_no_process",
			"lot_no" => $this->parameter['lot_no'],
			"work_cd" => $release->work_cd,
			"process" => $release->process,
			"used" => "n"
		);
		$this->insert($data);
		echo "success";

	}

	// 출하지시 품목 위치 및 수량 찾기
	public function getShipmentWarehouse(){
		$json = new Services_JSON;

		$sql = "select * from warehouse";
		$this->query($sql);
		while($w = $this->fetch()){
			$warehouse = "warehouse_".$w->uid;
			$sql = "select * from ".$warehouse." where item_cd='".$this->parameter['item_cd']."'";
			$this->sub_query($sql);
			$i = 0;
			while($t = $this->sub_fetch()){
				if($t->cnt > 0) {
					$re[$i]['uid'] = $t->uid;
					$re[$i]['warehouse'] = $w->uid;
					$re[$i]['warehouse_nm'] = $this->getCompareName("warehouse","warehouse_nm","uid",$w->uid);
					$re[$i]['item_cd'] = $t->item_cd;
					$re[$i]['item_nm'] = $t->item_nm;
					$re[$i]['lot_no'] = $t->lot_no;
					$re[$i]['standard'] = $t->standard;
					$re[$i]['unit'] = $t->unit;
					$re[$i]['cnt'] = $t->cnt;
					$i++;
				}
			}
		}

		echo $json->encode($re);
	}
/*****************************************************************************************************************************/
// 재고관리
/*****************************************************************************************************************************/
	// 창고 재고 가져오기
	public function getWarehouseStock() {
		$json = new Services_JSON();
		
		$this->getTable("warehouse_".$this->parameter['fid'], $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $this->convertNull($this->getCompareName("account", "account_nm", "account_cd", $t->account_cd));
			$i++;
		}

		echo $json->encode($re);
	}

	

	// 2차 창고별 품목 리스트 가져오기
	public function getWarehouseItem() {
		$json = new Services_JSON();
		$table = "warehouse_".$this->parameter['warehouse_cd'];
		$this->getTable($table, $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['classify'] = $this->getCompareName("item_classify","classify_nm","uid",$t->classify);
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['lot_no'] = $t->lot_no;
			$i++;
		}
		echo $json->encode($re);
	}

	// 재고현황
	public function getTotalStock() {
		$json = new Services_JSON;
		$total_cnt = 0;

		// 창고재고
		$sql = "select * from warehouse";
		$this->query($sql);

		$warehouse_cnt = 0;
	
		while($t = $this->fetch()) {
			$warehouse = "warehouse_".$t->uid;
			$result = $this->isTable($warehouse,DB_NAME);
			$standard2 = "";
			if($result) {
				$sql = "select cnt from ".$warehouse." where item_cd='".$this->parameter['item_cd']."' and standard='".$this->parameter['standard']."'";
				$this->sub_query($sql);
				while($r = $this->sub_fetch()) {
					$warehouse_cnt = $warehouse_cnt + $r->cnt;
					$total_cnt = $total_cnt + $r->cnt;
				}
			}
		}
		
		// 공정재고
		$sql = "select * from process";
		$this->query($sql);
		$process_cnt = 0;

		while($t = $this->fetch()) {
			$warehouse = "process_warehouse_".$t->uid;
			$result = $this->isTable($warehouse,DB_NAME);
			if($result) {
				$sql = "select cnt from ".$warehouse." where item_cd='".$this->parameter['item_cd']."' and standard='".$this->parameter['standard']."'";
				$this->sub_query($sql);
				while($r = $this->sub_fetch()) {
					$process_cnt = $process_cnt + $r->cnt;
					$total_cnt = $total_cnt + $r->cnt;
				}
			}
		}

		$re['warehouse_cnt'] = $warehouse_cnt;
		$re['process_cnt'] = $process_cnt;
		$re['total_cnt'] = $total_cnt;

		echo $json->encode($re);
	}

	// 안전재고관리
	public function safetyStock() {
		$sql = "TRUNCATE TABLE safety_stock";
		$this->query($sql);

		$sql = "select item_cd, item_nm, standard, unit, safety_stock_cnt from item";
		$this->query($sql);

		while($item = $this->fetch()) {
			$total_cnt = 0;

			// 창고재고
			$sql = "select * from warehouse";
			$this->sub_query($sql);
			
			while($t = $this->sub_fetch()) {
				$warehouse = "warehouse_".$t->uid;
				$result = $this->isTable($warehouse,DB_NAME);

				if($result) {
					$sql = "select cnt from ".$warehouse." where item_cd='".$item->item_cd."'";
					$res = mysql_query($sql);
					while($r = @mysql_fetch_object($res)) {
						$total_cnt = $total_cnt + $r->cnt;
					}
				}
			}
			
			// 공정재고
			$sql = "select * from process";
			$this->sub_query($sql);

			while($t = $this->sub_fetch()) {
				$warehouse = "process_warehouse_".$t->uid;
				$result = $this->isTable($warehouse,DB_NAME);
				if($result) {
					$sql = "select cnt from ".$warehouse." where item_cd='".$item->item_cd."'";
					$res = mysql_query($sql);
					while($r = @mysql_fetch_object($res)) {
						$total_cnt = $total_cnt + $r->cnt;
					}
				}
			}

			if($item->safety_stock_cnt > $total_cnt) {
				$data = array(
					"table" => "safety_stock",
					"item_cd" => $item->item_cd,
					"item_nm" => $item->item_nm,
					"standard" => $item->standard,
					"unit" => $item->unit,
					"safety_stock_cnt" => $item->safety_stock_cnt,
					"current_cnt" => $total_cnt
				);

				$this->insert($data);
			}
		}
	}

	// 안전재고 리스트
	public function getSafetyStockList() {
		$json = new Services_JSON;

		$this->getTable("safety_stock", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['safety_stock_cnt'] = $t->safety_stock_cnt;
			$re[$i]['current_cnt'] = $t->current_cnt;
			$i++;
		}

		echo $json->encode($re);
	}
	
	// 창고별 재고현황
	public function getWarehouseCurrentStock() {
		$json = new Services_JSON;
		// 창고재고
		$sql = "select * from warehouse";
		$this->query($sql);
		$i = 0;

		while($t = $this->fetch()) {
			$warehouse = "warehouse_".$t->uid;
			$sql = "select * from ".$warehouse." where item_cd='".$this->parameter['item_cd']."' and standard='".$this->parameter['standard']."'";
			$this->sub_query($sql);
			while($r = $this->sub_fetch()) {
				if($r->cnt > 0) {
					$re[$i]['uid'] = $t->uid;
					$re[$i]['ruid'] = $r->uid;
					$re[$i]['fid'] = $r->fid;
					$re[$i]['warehouse'] = $this->getCompareName("warehouse","warehouse_nm","uid",$t->uid);
					$re[$i]['item_cd'] = $r->item_cd;
					$re[$i]['item_nm'] = $r->item_nm;
					$re[$i]['standard'] = $r->standard;
					$re[$i]['unit'] = $r->unit;
					$re[$i]['cnt'] = $r->cnt;
					$re[$i]['lot_no'] = $r->lot_no;
					$re[$i]['create_dt'] = substr($r->create_dt,0,10);
					$i++;
				}
			}
		}

		echo $json->encode($re);
	}

	// 재고조정
	public function inventoryAdjustment() {
		$warehouse = "warehouse_".$this->parameter['fid'];
		$cnt = $this->replaceComma($this->parameter['cnt']);


		$data = array(
			"table" => $warehouse,
			"where" => "uid=".$this->parameter['uid'],
			"cnt" => $this->replaceComma($this->parameter['cnt'])
		);
		$this->update($data);
	}

	// 창고 재고이동
	public function registItemMove() {
		// 선택된 창고에서 해당 품목을 이동 수량만큼 감소시킨다
		$warehouse = "warehouse_".$this->parameter['warehouse'];
		$sql = "select * from ".$warehouse." where uid=".$this->parameter['warehouse_uid'];
		$this->query($sql);
		$t = $this->fetch();

		$new_cnt = $t->cnt - $this->replaceComma($this->parameter['move_cnt']);

		$sql = "update ".$warehouse." set cnt=".$new_cnt." where uid=".$this->parameter['warehouse_uid'];
		$this->query($sql);

		// 선택한 창고로 이동 수량만큼 입력시킨다
		$move_warehouse = "warehouse_".$this->parameter['move_warehouse'];
		$data = array(
			"table" => $move_warehouse,
			"fid" => $this->parameter['move_warehouse'],
			"classify" => $t->classify,
			"item_cd" => $t->item_cd,
			"item_nm" => $t->item_nm,
			"standard" => $t->standard,
			"unit" => $t->unit,
			"cnt" => $this->parameter['move_cnt'],
			"lot_no" => $t->lot_no,
			"create_dt" => $this->now
		);

		$result = $this->insert($data);
		if($result) echo "success";

	}

	// 생성된 바코드 리스트 가져오기
	public function getLotNo() {
		$json = new Services_JSON;
		$this->getTable("lot_no", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['lot_no'] = $t->lot_no;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['in_cnt'] = $t->in_cnt;
			$re[$i]['price'] = $t->price;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['process'] = $t->process;
			$re[$i]['process_nm'] = $t->process_nm;
			$re[$i]['machine'] = $t->machine;
			$re[$i]['machine_nm'] = $t->machine_nm;
			$re[$i]['team'] = $t->team;
			$re[$i]['team_nm'] = $t->team_nm;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['sales_account_cd'] = $t->sales_account_cd;
			$re[$i]['sales_account_nm'] = $t->sales_account_nm;
			$re[$i]['out_cnt' ] = $t->out_cnt;
			$re[$i]['sales_price'] = $t->sales_price;
			$re[$i]['create_dt'] = substr($t->create_dt, 0, 10);
			$i++;
		}

		echo $json->encode($re);
	}


	// 바코드 이미지 가져오기
	public function getBarcodeImg() {
		$url = "https://www.barcodesinc.com/generator/image.php?code=".$this->parameter['barcode']."&style=196&type=C128B&width=300px&height=100px&xres=1&font=5";
		$img = "<img src='$url' style='width:300px; height:100px'>";
											
		echo $img;
	}

	// 자재불출 후 자재불출창고 확인
	public function getReleaseWarehouseList() {
		$json = new Services_JSON;
		$sql = "select * from releases_warehouse where state='보관'";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$url = "https://www.barcodesinc.com/generator/image.php?code=".$t->lot_no."&style=196&type=C128B&width=300px&height=100px&xres=1&font=5";
			$img = "<img src='$url'>";

			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['process'] = $this->convertNull($this->getCompareName("process","process_nm","uid",$t->process));
			$re[$i]['machine'] = $this->convertNull($this->getCompareName("machine","machine_nm","uid",$t->machine));
			$re[$i]['team'] = $this->convertNull($this->getCompareName("team","team_nm","uid",$t->team));
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['state'] = $t->state;
			$re[$i]['lot_no'] = $t->lot_no;
			$re[$i]['barcode'] = $img;
			$re[$i]['create_dt'] = $t->create_dt;
			$i++;
		}
		echo $json->encode($re);
	}

	// 공정별 재공재고 리스트
	public function getProcessWarehouseItemList() {
		$json = new Services_JSON;
	
		$warehouse = "process_warehouse_".$this->parameter['process'];
	
		$sql = "select * from ".$warehouse;
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['lot_no'] = $t->lot_no;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}
	
		echo $json->encode($re);
	}

/*****************************************************************************************************************************/
// 인사.급여관리
/*****************************************************************************************************************************/	


	// 일용직 등록
	public function registDayLabor(){
		$mobile = $this->convertMobileNumber($this->parameter['mobile']);
		$telephone = $this->convertMobileNumber($this->parameter['telephone']);
		
		if($this->parameter['uid'] == "") {
			$data = array(
				"table" => "day_labor",
				"emp_nm" => $this->parameter['emp_nm'],
				"gender" => $this->parameter['gender'],
				"regist_no" => $this->parameter['regist_no'],
				"mobile" => $mobile,
				"telephone" => $telephone,
				"email" => $this->parameter['email'],
				"join_dt" => $this->parameter['join_dt'],
				"resign_dt" => $this->parameter['resign_dt'],
				"zipcode" => $this->parameter['zipcode'],
				"address" => $this->parameter['address'],
				"pay_classify" => $this->parameter['pay_classify'],		
				"health_ins" => $this->parameter['health_ins'],		
				"national_pension" => $this->parameter['national_pension'],
				"eldelry_ins" => $this->parameter['eldelry_ins'],
				"unemployment_ins" => $this->parameter['unemployment_ins'],
				"occupation" => $this->parameter['occupation'],
				"nationality" => $this->parameter['nationality'],
				"create_dt" => $this->now
			);
			var_dump($data);
			$result = $this->insert($data);
		} else {
			$data = array(
				"table" => "day_labor",
				"where" => "uid=".$this->parameter['uid'],
				"emp_nm" => $this->parameter['emp_nm'],
				"gender" => $this->parameter['gender'],
				"regist_no" => $this->parameter['regist_no'],
				"mobile" => $mobile,
				"telephone" => $telephone,
				"email" => $this->parameter['email'],
				"join_dt" => $this->parameter['join_dt'],
				"resign_dt" => $this->parameter['resign_dt'],
				"zipcode" => $this->parameter['zipcode'],
				"address" => $this->parameter['address'],
				"pay_classify" => $this->parameter['pay_classify'],		
				"health_ins" => $this->parameter['health_ins'],		
				"national_pension" => $this->parameter['national_pension'],
				"eldelry_ins" => $this->parameter['eldelry_ins'],
				"unemployment_ins" => $this->parameter['unemployment_ins'],
				"occupation" => $this->parameter['occupation'],
				"nationality" => $this->parameter['nationality'],
				"create_dt" => $this->now
			);

			$result = $this->update($data);
		}

		if($result) echo "success";
	}

	// 일용직 리스트 가져오기
	public function getDayLaborList(){
		$json = new Services_JSON;

		$where = str_replace("@","%",$this->parameter['where']);
		$this->getTable("day_labor", $where, $this->parameter['rpp'], $this->parameter['page']);

		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['gender'] = $t->gender;
			$re[$i]['regist_no'] = $t->regist_no;
			$re[$i]['mobile'] = $t->mobile;
			$re[$i]['telephone'] = $t->telephone;
			$re[$i]['email'] = $t->email;
			$re[$i]['join_dt'] = substr($t->join_dt,0,10);
			$re[$i]['resign_dt'] = substr($t->resign_dt,0,10);
			$re[$i]['zipcode'] = $t->zipcode;
			$re[$i]['address'] = $t->address;
			$re[$i]['pay_classify'] = $t->pay_classify;
			$re[$i]['health_ins'] = $t->health_ins;
			$re[$i]['national_pension'] = $t->national_pension;
			$re[$i]['eldelry_ins'] = $t->eldelry_ins;
			$re[$i]['unemployment_ins'] = $t->unemployment_ins;
			$re[$i]['occupation'] = $t->occupation;
			$re[$i]['nationality'] = $t->nationality;
			$i++;
		}

		echo $json->encode($re);
	}

	// 일용직 가져오기
	public function getDayLabor(){
		$json = new Services_JSON;
		$sql = "select * from day_labor where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();
		
		$re['uid'] = $t->uid;
		$re['emp_nm'] = $t->emp_nm;
		$re['gender'] = $t->gender;
		$re['regist_no'] = $t->regist_no;
		$re['mobile'] = $t->mobile;
		$re['telephone'] = $t->telephone;
		$re['email'] = $t->email;
		$re['join_dt'] = substr($t->join_dt,0,10);
		$re['resign_dt'] = substr($t->resign_dt,0,10);
		$re['zipcode'] = $t->zipcode;
		$re['address'] = $t->address;
		$re['pay_classify'] = $t->pay_classify;
		$re['health_ins'] = $t->health_ins;
		$re['national_pension'] = $t->national_pension;
		$re['eldelry_ins'] = $t->eldelry_ins;
		$re['unemployment_ins'] = $t->unemployment_ins;
		$re['occupation'] = $t->occupation;
		$re['nationality'] = $t->nationality;		
		
		echo $json->encode($re);
	}

/*****************************************************************************************************************************/
// 그룹웨어
/*****************************************************************************************************************************/
	// 계정과목등록
	public function registAccountSubject() {
		$data = array(
			"table" => "account_subject",
			"fid" => $this->parameter['uid'],
			"subject" => $this->parameter['subject']
		);

		$result = $this->insert($data);
		if($result) echo "success";
	}

	// 계정과목삭제
	public function deleteAccountSubject() {
		$sql = "select uid from account_subject where fid=".$this->parameter['uid'];
		$this->query($sql);
		if($this->get_rows() > 0) {
			echo "son";
		} else {
			$sql = "delete from account_subject where uid=".$this->parameter['uid'];
			$result = $this->query($sql);
			if($result) echo "success";
		}
	}

	// 업무공유 상세 가져오기
	public function getShareBoard() {
		$json = new Services_JSON;

		$sql = "select * from work_share where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();
		
		$re['uid'] = $t->uid;
		$re['title'] = $t->title;
		$re['classify'] = $t->classify;

		$re['receiver'] = $this->convertNull($this->getCompareName("employee", "emp_nm", "emp_id", $t->receiver));
		$re['receiver_id'] = $t->receiver;
		$re['receiver_middle'] = $this->getCompareName("employee", "middle_department_cd", "emp_id", $t->receiver);
		$re['receiver_small'] = $this->getCompareName("employee", "small_department_cd", "emp_id", $t->receiver);

		$re['refer'] = $this->convertNull($this->getCompareName("employee", "emp_nm", "emp_id", $t->refer));
		$re['refer_id'] = $t->refer;
		$re['refer_middle'] = $this->getCompareName("employee", "middle_department_cd", "emp_id", $t->refer);
		$re['refer_small'] = $this->getCompareName("employee", "small_department_cd", "emp_id", $t->refer);

		$re['attach'] = $t->attach;
		$re['comment'] = $t->comment;
		$re['emp_id'] = $t->emp_id;
		$re['emp_nm'] = $t->emp_nm;
		$re['create_dt'] = substr($t->create_dt,0,10);

		echo $json->encode($re);
	}

	// 결재라인 등록
	public function registApprovalLine() {
		if($this->parameter['uid'] == ""){
			$data = array(
				"table" => "approval_line",
				"line_nm" => $this->parameter['line_nm'],
				"emp_id" => $_SESSION['login_id']
			);
			$this->insert($data);
		} else {
			$data = array(
				"table" => "approval_line",
				"where" => "uid=".$this->parameter['uid'],
				"line_nm" => $this->parameter['line_nm'],
				"emp_id" => $_SESSION['login_id']
			);
			$this->update($data);
		}
	}

	// 결재라인 리스트 가져오기
	public function getApprovalLineList() {
		$json = new Services_JSON;
		$sql = "select * from approval_line where emp_id='".$_SESSION['login_id']."'";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['line_nm'] = $t->line_nm;
			$re[$i]['emp_id'] = $t->emp_id;
			$i++;
		}
		echo $json->encode($re);
	}

	// 결재리스트 가져오기
	public function getApprovalList(){
		$json = new Services_JSON;
		switch($this->parameter['state']) {
			case "a" :
				$sql = "select * from approval a where exists (select * from approval_check b where a.uid=b.fid and b.emp_id='".$_SESSION['login_id']."') and a.state='stay'";
				//$sql = "select * from approval a where exists (select * from approval_check b where a.uid=b.fid and a.state='stay') order by a.uid desc";
			break;

			case "b" :
				$sql = "select * from approval a where exists (select * from approval_check b where a.uid=b.fid and b.emp_id='".$_SESSION['login_id']."') and a.state='ing'";
				//$sql = "select * from approval a where exists (select * from approval_check b where a.uid=b.fid and a.state='ing') order by a.uid desc";
			break;

			case "c" :
				$sql = "select * from approval a where exists (select * from approval_check b where a.uid=b.fid and b.emp_id='".$_SESSION['login_id']."') and a.state='complete'";
				//$sql = "select * from approval a where exists (select * from approval_check b where a.uid=b.fid) and a.state='complete'  order by a.uid desc";
			break;

			case "d" :
				$sql = "select * from approval a where exists (select * from approval_check b where a.uid=b.fid and b.emp_id='".$_SESSION['login_id']."') and a.state='return'";
				//$sql = "select * from approval a where exists (select * from approval_check b where a.uid=b.fid and a.state='return')  order by a.uid desc";
			break;

			case "e" :
				$sql = "select * from approval a where exists (select * from approval_check b where a.uid=b.fid and b.emp_id='".$_SESSION['login_id']."') and a.state='hold'";
				//$sql = "select * from approval a where exists (select * from approval_check b where a.uid=b.fid and a.state='hold')  order by a.uid desc";
			break;
		}

		//$sql = "select * from erp_approval order by uid desc";
		//echo $sql;
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['approval_cd'] = $t->approval_cd;
			$re[$i]['title'] = $t->title;
			$re[$i]['big_department'] = $this->getCompareName("department_big", "department_nm", "uid", $t->big_department_cd);
			$re[$i]['middle_department'] = $this->getCompareName("department_middle", "department_nm", "uid", $t->middle_department_cd);
			$re[$i]['small_department'] = $this->getCompareName("department_small", "department_nm", "uid", $t->small_department_cd);
			$re[$i]['state'] = $t->state;
			$re[$i]['emp_nm'] = $this->getCompareName("employee", "emp_nm", "emp_id", $t->emp_id);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	}

	// 결재문서 볼 자격 
	public function checkApproval() {
		$sql = "select * from approval a, approval_check b where a.uid=".$this->parameter['uid']." and a.uid=b.fid and b.emp_id='".$_SESSION['login_id']."'";
		//echo $sql;
		$this->query($sql);
		$check = $this->fetch();
		if($check->uid != "") echo "possible";
		else echo "impossible";
	}

	// 결재라인 맴버로 이동
	public function moveApprovalLine() {
		$array_uid = explode(",",$this->parameter['uids']);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			if(!empty($array_uid[$i])) {
				$sql = "select uid from approval_line_member where employee_fid=".$array_uid[$i]." and fid=".$this->parameter['uid'];
				$this->query($sql);
				if($this->get_rows() <= 0) {
					$data = array(
						"table" => "approval_line_member",
						"fid" => $this->parameter['uid'],
						"employee_fid" => $array_uid[$i]
					);

					$result = $this->insert($data);
				}
			}
		}		
	}

	// 결재라인 맴버 리스트 
	public function getApprovalLineMemberList(){
		$json = new Services_JSON;

		$sql = "select * from approval_line_member where fid=".$this->parameter['uid'];
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['fid'] = $t->fid;
			$re[$i]['employee_fid'] = $t->employee_fid;

			$sql = "select * from employee where uid=".$t->employee_fid;
			$this->sub_query($sql);
			$emp = $this->sub_fetch();

			$re[$i]['emp_cd'] = $emp->emp_cd;
			$re[$i]['emp_nm'] = $emp->emp_nm;
			$re[$i]['gender'] = $emp->gender;
			$re[$i]['department'] = $this->getCompareName("department_middle","department_nm","uid",$emp->middle_department_cd)."-".$this->getCompareName("department_small","department_nm","uid",$emp->small_department_cd);
			$re[$i]['position'] = $this->getCompareName("position","position_nm","uid",$emp->position_cd);
			$re[$i]['mobile'] = $emp->mobile;
			$i++;
		}

		echo $json->encode($re);
	}

	// 결재라인 맴버에서 제외
	public function removeApprovalLine() {
		$array_uid = explode(",",$this->parameter['uids']);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			if(!empty($array_uid[$i])) {
				$sql = "delete from approval_line_member where uid=".$array_uid[$i];
				$this->query($sql);
			}
		}
	}

	// 결재 문서양식 등록
	public function registApprovalDocument(){
		if($this->parameter['uid'] == "") {
			$data = array(
				"table" => "approval_document",
				"classify" => $this->parameter['classify'],
				"title" => $this->parameter['title'],
				"comment" => $this->parameter['content'],
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => $this->now
			);
			$this->insert($data);
		} else {
			$data = array(
				"table" => "approval_document",
				"where" => "uid=".$this->parameter['uid'],
				"classify" => $this->parameter['classify'],
				"title" => $this->parameter['title'],
				"comment" => $this->parameter['content'],
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => $this->now
			);
			$this->update($data);
		}
	}

	// 결재 문서양식 리스트
	public function getApprovalDocumentList() {
		$json = new Services_JSON;
		$this->getTable("approval_document", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);	
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['title'] = $t->title;
			$re[$i]['comment'] = $t->comment;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}
		echo $json->encode($re);
	}

	// 하나의 결재양식 가져오기
	public function getApprovalDocument() {
		$json = new Services_JSON;
		$sql = "select * from approval_document where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();

		$re['uid'] = $t->uid;
		$re['classify'] = $t->classify;
		$re['title'] = $t->title;
		$re['comment'] = $t->comment;
		$re['emp_id'] = $t->emp_id;
		$re['create_dt'] = substr($t->create_dt,0,10);
		
		echo $json->encode($re);
	}

	// 지출결의서 삭제
	public function deleteSpendingResolution() {
		$sql = "delete from spending_resolution where uid=".$this->parameter['uid'];
		$result = $this->query($sql);
		if($result) echo "success";
	}

	// 공유업무 등록
	public function registWorkShare() {
		//echo $this->parameter['content'];

		$fileAttach = $this->upload('attach');
		if($fileAttach == "none" && $this->parameter['old_attach'] != "") {
			$fileAttach = $this->parameter['old_attach'];
		}

		if($this->parameter['uid'] != "") {
			$data = array(
				"table" => "work_share",
				"where" => "uid=".$this->parameter['uid'],
				"title" => $this->parameter['title'],
				"classify" => $this->parameter['classify'],
				"receiver" => $this->parameter['receiver'],
				"refer" => $this->parameter['refer'],
				"attach" => $fileAttach,
				"comment" => $this->parameter['content'],
				"emp_id" => $_SESSION['login_id'],
				"emp_nm" => $_SESSION['login_nm'],
				"create_dt" => $this->now,
				"view_check" => "n"
			);

			$this->update($data);
		} else {
			$data = array(
				"table" => "work_share",
				"title" => $this->parameter['title'],
				"classify" => $this->parameter['classify'],
				"receiver" => $this->parameter['receiver'],
				"refer" => $this->parameter['refer'],
				"attach" => $fileAttach,
				"comment" => $this->parameter['content'],
				"emp_id" => $_SESSION['login_id'],
				"emp_nm" => $_SESSION['login_nm'],
				"create_dt" => $this->now,
				"view_check" => "n"
			);

			$this->insert($data);
		}

		echo "success";
	}

	// 업무공유 리스트 가져오기
	public function getWorkShareList() {
		$json = new Services_JSON;

		$this->getTable("work_share", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['title'] = $t->title;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['receiver'] = $t->receiver;
			$re[$i]['receiver_nm'] = $this->convertNull($this->getCompareName("employee", "emp_nm", "emp_id", $t->receiver));
			$re[$i]['refer'] = $t->refer;
			$re[$i]['refer_nm'] = $this->convertNull($this->getCompareName("employee", "emp_nm", "emp_id", $t->refer));
			$re[$i]['attach'] = $t->attach;
			$re[$i]['comment'] = $t->comment;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['create_dt'] = substr($t->create_dt, 0, 10);
			$re[$i]['view_check'] = $t->view_check;
			$re[$i]['view_dt'] = $this->convertNull(substr($t->view_dt, 0 ,10));
			$i++;
		}

		echo $json->encode($re);
	}


	// 파일보관함 등록
	public function registFile() {
		//echo $this->parameter['content'];

		$fileAttach = $this->upload('attach');
		if($fileAttach == "none" && $this->parameter['old_attach'] != "") {
			$fileAttach = $this->parameter['old_attach'];
		}

		if($this->parameter['uid'] != "") {
			$data = array(
				"table" => "work_file",
				"where" => "uid=".$this->parameter['uid'],
				"title" => $this->parameter['title'],
				"classify" => $this->parameter['classify'],
				"attach" => $fileAttach,
				"comment" => $this->parameter['content'],
				"emp_id" => $_SESSION['login_id'],
				"emp_nm" => $_SESSION['login_nm'],
				"create_dt" => $this->now
			);

			$this->update($data);
		} else {
			$data = array(
				"table" => "work_file",
				"title" => $this->parameter['title'],
				"classify" => $this->parameter['classify'],
				"attach" => $fileAttach,
				"comment" => $this->parameter['content'],
				"emp_id" => $_SESSION['login_id'],
				"emp_nm" => $_SESSION['login_nm'],
				"create_dt" => $this->now
			);

			$this->insert($data);
		}

		echo "success";
	}

	// 파일보관함 리스트 가져오기
	public function getFileList() {
		$json = new Services_JSON;

		$this->getTable("work_file", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['title'] = $t->title;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['attach'] = $t->attach;
			$re[$i]['comment'] = $t->comment;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['create_dt'] = substr($t->create_dt, 0, 10);
			$i++;
		}

		echo $json->encode($re);
	}

	// 파일보관함 상세 가져오기
	public function getWorkFile() {
		$json = new Services_JSON;

		$sql = "select * from work_file where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();
		
		$re['uid'] = $t->uid;
		$re['title'] = $t->title;
		$re['classify'] = $t->classify;
		$re['attach'] = $t->attach;
		$re['comment'] = $t->comment;
		$re['emp_id'] = $t->emp_id;
		$re['emp_nm'] = $t->emp_nm;
		$re['create_dt'] = substr($t->create_dt,0,10);

		echo $json->encode($re);
	}
	
	// 일정등록
	public function registSchedule() {
		if(!empty($_POST['uid'])) {
			$data = array(
				"table"=>"schedule",
				"where"=>"uid=".$this->parameter['uid'],
				"title"=>$this->parameter['title'],
				"anniversary"=>$this->parameter['anniversary'],
				"classify"=>$this->parameter['classify'],
				"name"=>$this->parameter['name'],
				"schedule_dt"=>$this->parameter['schedule_dt'],
				"schedule_tm"=>$this->parameter['schedule_tm'],
				"place"=>$this->parameter['place'],
				"importance"=>$this->parameter['importance'],
				"memo"=>$this->parameter['memo'],
				"emp_id"=>$_SESSION['login_id']
			);
			$this->update($data);
		} else {
			$data = array(
				"table"=>"schedule",
				"title"=>$this->parameter['title'],
				"anniversary"=>$this->parameter['anniversary'],
				"classify"=>$this->parameter['classify'],
				"name"=>$this->parameter['name'],
				"schedule_dt"=>$this->parameter['schedule_dt'],
				"schedule_tm"=>$this->parameter['schedule_tm'],
				"place"=>$this->parameter['place'],
				"importance"=>$this->parameter['importance'],
				"memo"=>$this->parameter['memo'],
				"emp_id"=>$_SESSION['login_id']
			);
			$this->insert($data);
		}
	}

	// 일정가져오기
	public function getSchedule() {
		$json = new Services_JSON;
		$sql = "select * from schedule where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();
		
		$re['uid'] = $t->uid;
		$re['title'] = $t->title;
		$re['anniversary'] = $t->anniversary;
		$re['classify'] = $t->classify;
		$re['name'] = $t->name;
		$re['schedule_dt'] = $t->schedule_dt;
		$re['schedule_tm'] = $t->schedule_tm;
		$re['place'] = $t->place;
		$re['importance'] = $t->importance;
		$re['memo'] = $t->memo;
		$re['emp_id'] = $t->emp_id;

		echo $json->encode($re);
	}

	// 일정삭제
	public function deleteSchedule() {
		$sql = "select * from schedule where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();
		if($t->classify != "수주") {
			$sql = "delete from schedule where uid=".$this->parameter['uid'];
			$result = $this->query($sql);
		}
	}
	
	// 지출결의서 코드 생성
	public function createSpendingCode() {
		$cd = date("Ymd");
		$sql = "select spending_cd from spending_resolution where spending_cd like '%$cd%' order by uid desc limit 1";
		$this->query($sql);
		$result = $this->fetch();

		if(isset($result->spending_cd)) {
			$arr = explode("-",$result->spending_cd);
			$new = $arr[1]+1;
			$cd .= "-".str_pad($new,"2","0",STR_PAD_LEFT);
		} else {
			$cd .= "-01";
		}
		echo $cd;
	}

	// 지출결의서 리스트 가져오기
	public function getSpendingResolutionList() {
		$json = new Services_JSON;
		$this->getTable("spending_resolution", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['spending_cd'] = $this->convertNull($t->spending_cd);
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $this->getCompareName("employee", "emp_nm", "emp_id", $t->emp_id);
			$re[$i]['draft_dt'] = substr($t->draft_dt, 0, 10);
			$re[$i]['spending_dt'] = substr($t->spending_dt, 0, 10);
			$re[$i]['title'] = $t->title;
			$re[$i]['account_number'] = $t->account_number;
			$re[$i]['total_price'] = $t->total_price;
			$re[$i]['approval'] = $t->approval;
			$i++;
		}
		echo $json->encode($re);
	}

	// 지출결의서 하나 읽어오기
	public function getSpendingResolution() {
		$json = new Services_JSON;

		$sql = "select * from spending_resolution where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();
		
		$re['uid'] = $t->uid;
		$re['spending_cd'] = $t->spending_cd;
		$re['middle_department_cd'] = $t->middle_department_cd;
		$re['middle_department_nm'] = $this->getCompareName("department_middle", "department_nm", "uid", $t->middle_department_cd);
		$re['small_department_cd'] = $t->small_department_cd;
		$re['small_department_nm'] = $this->getCompareName("department_small", "department_nm", "uid", $t->small_department_cd);
		$re['emp_id'] = $t->emp_id;
		$re['emp_nm'] = $this->getCompareName("employee","emp_nm","emp_id",$t->emp_id);
		$re['draft_dt'] = substr($t->draft_dt,0,10);
		$re['title'] = $t->title;
		$re['spending_dt'] = substr($t->spending_dt,0,10);
		$re['account_cd'] = $t->account_cd;
		$re['account_nm'] = $this->getCompareName("account","account_nm","account_cd",$t->account_cd);
		$re['bank'] = $t->bank;
		$re['account'] = $t->account;
		$re['account_holder'] = $t->account_holder;
		$re['unit'] = $t->unit;
		$re['total_price'] = $t->total_price;
		$re['spending_condition'] = $t->spending_condition;
		$re['approval'] = $t->approval;
		$re['foreign_nm'] = $t->foreign_nm;
		$re['foreign_address'] = $t->foreign_address;
		$re['foreign_phone'] = $t->foreign_phone;
		$re['foreign_bank'] = $t->foreign_bank;
		$re['foreign_bank_branch'] = $t->foreign_bank_branch;
		$re['foreign_account'] = $t->foreign_account;
		$re['foreign_swift_bic_cd'] = $t->foreign_swift_bic_cd;

		echo $json->encode($re);
	}

	// 지출항목 가져오기
	public function getSpendingResolutionData() {
		$json = new Services_JSON;
		$sql = "select * from spending_resolution_data where fid=".$this->parameter['fid'];
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$sql = "select * from spending_resolution_attach where fid=".$t->uid;
			$this->sub_query($sql);
			$attach = $this->sub_fetch();

			$re[$i]['uid'] = $t->uid;
			$re[$i]['account_uid'] = $t->account_uid;
			$re[$i]['account_subject'] = $t->account_subject;
			$re[$i]['expense_dt'] = substr($t->expense_dt,0,10);
			$re[$i]['expense_memo'] = $t->expense_memo;
			$re[$i]['cost'] = $t->cost;
			$re[$i]['supply_cost'] = $t->supply_cost;
			$re[$i]['tax'] = $t->tax;
			$re[$i]['memo'] = $t->memo;
			$re[$i]['attach'] = $this->convertNull($attach->attach);
			$i++;
		}
		echo $json->encode($re);
	}

	// 지출결의서 등록
	public function registSpending() {
		$account_uid = $this->parameter['account_uid'];
		$account_subject = $this->parameter['account_subject'];
		$expense_dt = $this->parameter['expense_dt'];
		$expense_memo = $this->parameter['expense_memo'];
		$account = $this->parameter['account'];
		$cost = $this->parameter['cost'];
		$supply_cost = $this->parameter['supply_cost'];
		$tax = $this->parameter['tax'];
		$payment = $this->parameter['payment'];
		$memo = $this->parameter['memo'];
		$arr = array();
		

		if($this->parameter['uid'] == "") {
			$data = array(
				"table" => "spending_resolution",
				"spending_cd" => $this->parameter['spending_cd'],
				"middle_department_cd" => $this->parameter['middle_department_cd'],
				"small_department_cd" => $this->parameter['small_department_cd'],
				"emp_id" => $this->parameter['emp_id'],
				"draft_dt" => $this->parameter['draft_dt'],
				"title" => $this->parameter['title'],
				"spending_dt" => $this->parameter['spending_dt'],
				"account_cd" => $this->parameter['account_cd'],
				"bank" => $this->parameter['bank'],
				"account" => $this->parameter['account_number'],
				"account_holder" => $this->parameter['account_holder'],
				"unit" => $this->parameter['unit'],
				"total_price" => $this->replaceComma($this->parameter['total_price']),
				"spending_condition" => $this->parameter['spending_condition'],
				"approval" => "n",
				"foreign_nm" => $this->parameter['foreign_nm'],
				"foreign_address" => $this->parameter['foreign_address'],
				"foreign_phone" => $this->parameter['foreign_phone'],
				"foreign_bank" => $this->parameter['foreign_bank'],
				"foreign_bank_branch" => $this->parameter['foreign_bank_branch'],
				"foreign_account" => $this->parameter['foreign_account'],
				"foreign_swift_bic_cd" => $this->parameter['foreign_swift_bic_cd']
			);
			$this->insert($data);
			$fid = $this->get_insert_id();
	
			foreach($account_uid as $key => $val) {
				$data = array(
					"table" => "spending_resolution_data",
					"fid" => $fid,
					"account_uid" => $val,
					"account_subject" => $account_subject[$key],
					"expense_dt" => $expense_dt[$key],
					"expense_memo" => $expense_memo[$key],
					"cost" => $this->replaceComma($cost[$key]),
					"supply_cost" => $this->replaceComma($supply_cost[$key]),
					"tax" => $this->replaceComma($tax[$key]),
					"memo" => $memo[$key]
				);
				$this->insert($data);
				$sfid = $this->get_insert_id();
				array_push($arr, $sfid);
			}
			
			foreach($_FILES['attach']['tmp_name'] as $key => $val) {
				$file_name = $_FILES['attach']['name'][$key];
				$file_size =$_FILES['attach']['size'][$key];
				$file_tmp =$_FILES['attach']['tmp_name'][$key];
				$file_type=$_FILES['attach']['type'][$key];  
					
				move_uploaded_file($file_tmp,"attach/".time().$file_name);
				if($file_name != "") $nf = time().$file_name; else $nf = "";
				$attach_data = array (
					"table" => "spending_resolution_attach",
					"fid" => $arr[$key],
					"attach" => $nf
				);
				$this->insert($attach_data);
			}
		} else {
			$data = array(
				"table" => "spending_resolution",
				"where" => "uid=".$this->parameter['uid'],
				"spending_cd" => $this->parameter['spending_cd'],
				"middle_department_cd" => $this->parameter['middle_department_cd'],
				"small_department_cd" => $this->parameter['small_department_cd'],
				"emp_id" => $this->parameter['emp_id'],
				"draft_dt" => $this->parameter['draft_dt'],
				"title" => $this->parameter['title'],
				"spending_dt" => $this->parameter['spending_dt'],
				"account_cd" => $this->parameter['account_cd'],
				"bank" => $this->parameter['bank'],
				"account" => $this->parameter['account_number'],
				"account_holder" => $this->parameter['account_holder'],
				"unit" => $this->parameter['unit'],
				"total_price" => $this->replaceComma($this->parameter['total_price']),
				"spending_condition" => $this->parameter['spending_condition'],
				"approval" => "n",
				"foreign_nm" => $this->parameter['foreign_nm'],
				"foreign_address" => $this->parameter['foreign_address'],
				"foreign_phone" => $this->parameter['foreign_phone'],
				"foreign_bank" => $this->parameter['foreign_bank'],
				"foreign_bank_branch" => $this->parameter['foreign_bank_branch'],
				"foreign_account" => $this->parameter['foreign_account'],
				"foreign_swift_bic_cd" => $this->parameter['foreign_swift_bic_cd']
			);
			$this->update($data);
			
			$sql = "delete from spending_resolution_data where fid=".$this->parameter['uid'];
			$this->query($sql);

			foreach($account_uid as $key => $val) {
				$data = array(
					"table" => "spending_resolution_data",
					"fid" => $this->parameter['uid'],
					"account_uid" => $val,
					"account_subject" => $account_subject[$key],
					"expense_dt" => $expense_dt[$key],
					"expense_memo" => $expense_memo[$key],
					"cost" => $this->replaceComma($cost[$key]),
					"supply_cost" => $this->replaceComma($supply_cost[$key]),
					"tax" => $this->replaceComma($tax[$key]),
					"memo" => $memo[$key]
				);
				$this->insert($data);
				$sfid = $this->get_insert_id();
				array_push($arr, $sfid);
			}
			
			/*
			foreach($_FILES['attach']['tmp_name'] as $key => $val) {
				$file_name = $_FILES['attach']['name'][$key];
				$file_size =$_FILES['attach']['size'][$key];
				$file_tmp =$_FILES['attach']['tmp_name'][$key];
				$file_type=$_FILES['attach']['type'][$key];  
					
				move_uploaded_file($file_tmp,"attach/".time().$file_name);
				if($file_name != "") $nf = time().$file_name; else $nf = "";
				$attach_data = array (
					"table" => "spending_resolution_attach",
					"fid" => $arr[$key],
					"attach" => $nf
				);
				$this->insert($attach_data);
			}
			*/
		}
		
	}

	// 전자결재 문서번호 생성
	public function createApprovalCode() {
		$cd = date("Ymd");
		$sql = "select approval_cd from approval where approval_cd like '%$cd%' order by uid desc limit 1";
		$this->query($sql);
		$result = $this->fetch();

		if(isset($result->approval_cd)) {
			$arr = explode("-",$result->approval_cd);
			$new = $arr[1]+1;
			$cd .= "-".str_pad($new,"2","0",STR_PAD_LEFT);
		} else {
			$cd .= "-01";
		}
		echo $cd;
	}

	// 기안등록
	public function registApproval(){
		$fileAttach = $this->upload('attach');

		if($this->parameter['uid'] == "") {
			$data = array(
				"table" => "approval",
				"approval_cd" => $_POST['approval_cd'],
				"title" => $_POST['title'],
				"approval_line" => $_POST['approval_uid'],
				"refer" => $_POST['emp_id'],
				"comment" => $_POST['content'],
				"purchase_cd" => $_POST['purchase_cd'],
				"purchase_txt" => $_POST['purchase_txt'],
				"estimate_cd" => $_POST['estimate_cd'],
				"estimate_txt" => $_POST['estimate_txt'],
				"spending_cd" => $_POST['spending_cd'],
				"spending_txt" => $_POST['spending_txt'],
				"shipment_cd" => $_POST['shipment_cd'],
				"shipment_txt" => $_POST['shipment_txt'],
				"attach" => $fileAttach,
				"document" => $_POST['document'],
				"state" => "stay",
				"big_department_cd" => $_POST['big_department_cd'],
				"middle_department_cd" => $_POST['middle_department_cd'],
				"small_department_cd" => $_POST['small_department_cd'],
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => $this->now
			);
			
			$this->insert($data);
			$fid = $this->getUid();
		} else {
			$data = array(
				"table" => "approval",
				"where" => "uid=".$this->parameter['uid'],				
				"title" => $_POST['title'],
				"approval_line" => $_POST['approval_uid'],
				"refer" => $_POST['emp_id'],
				"comment" => $_POST['content'],
				"purchase_cd" => $_POST['purchase_cd'],
				"purchase_txt" => $_POST['purchase_txt'],
				"estimate_cd" => $_POST['estimate_cd'],
				"estimate_txt" => $_POST['estimate_txt'],
				"spending_cd" => $_POST['spending_cd'],
				"spending_txt" => $_POST['spending_txt'],
				"shipment_cd" => $_POST['shipment_cd'],
				"shipment_txt" => $_POST['shipment_txt'],
				"attach" => $fileAttach,
				"document" => $_POST['document'],
				"state" => "stay",
				"big_department_cd" => $_POST['big_department_cd'],
				"middle_department_cd" => $_POST['middle_department_cd'],
				"small_department_cd" => $_POST['small_department_cd'],
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => $this->now
			);
			
			$this->update($data);
			$fid = $this->parameter['uid'];
		}
		
		$this->registApprovalCheck($fid,$_POST['approval_uid']);		
	}

	// 기안 결재자 등록
	public function registApprovalCheck($fid,$approval_uid){
		try {
			$sql = "delete from approval_check where fid=".$fid;
			$this->query($sql);
		} catch (Exception $e) {}

		$sql = "select * from approval_line_member where fid=". $approval_uid;
		$this->query($sql);
		while($t = $this->fetch()) {
			$sql = "select emp_id from employee where uid=".$t->employee_fid;
			$this->sub_query($sql);
			$emp = $this->sub_fetch();

			$data = array(
				"table" => "approval_check",
				"fid" => $fid,
				"emp_id" => $emp->emp_id,
				"sign" => "n",
				"seq" => $t->seq,
				"sign_dt" => ""
			);

			$this->insert($data);
		}
	}

	// 내 기안 리스트 가져오기
	public function getMyApproval() {
		$json = new Services_JSON;
		$this->getTable("approval", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);

		$i = 0;
		while($t = $this->fetch()) {
			$line = "";

			$re[$i]['uid'] = $t->uid;
			$re[$i]['approval_cd'] = $t->approval_cd;
			$re[$i]['title'] = $t->title;		
			$sql = "select * from approval_check where fid=".$t->uid." order by seq asc";
			$this->sub_query($sql);
			while($r = $this->sub_fetch()) {
				$line .= $this->getCompareName("employee", "emp_nm", "emp_id", $r->emp_id)."-";
			}
			$line = substr($line,0,-1);
			$re[$i]['line'] = $line;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	}
/*****************************************************************************************************************************/
// 경영지원
/*****************************************************************************************************************************/
	// 업체별 세부판매현황
	public function getAccountSalesList(){
		$json = new Services_JSON;
		$sql = "select * from obtain_order where account_cd='".$this->parameter['account_cd']."' and (date(order_dt) between '".$this->parameter['start_dt']."' and '".$this->parameter['end_dt']."')";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$sql = "select * from obtain_order_item where fid=".$t->uid;
			$this->sub_query($sql);
			while($r = $this->sub_fetch()){
				$re[$i]['order_dt'] = substr($t->order_dt,0,10);
				$re[$i]['item_cd'] = $r->item_cd;
				$re[$i]['item_nm'] = $r->item_nm;
				$re[$i]['standard'] = $r->standard;
				$re[$i]['cnt'] = $r->cnt;
				$re[$i]['sales_price'] = $r->reversion_sales_price;
				$re[$i]['supply_price'] = $r->supply_price;
				$re[$i]['tax'] = $r->tax;
				$re[$i]['total_price'] = $r->total_price;
				$i++;
			}
		}

		echo $json->encode($re);

	}

	// 품목별 세부판매현황
	public function getItemSalesList(){
		$json = new Services_JSON;
		$sql = "select * from obtain_order_item where item_cd='".$this->parameter['item_cd']."' and standard='".$this->parameter['standard']."' and (date(order_dt) between '".$this->parameter['start_dt']."' and '".$this->parameter['end_dt']."')";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$sql = "select account_nm from obtain_order where uid=".$t->fid;
			$this->sub_query($sql);
			$acc = $this->sub_fetch();

			$re[$i]['order_dt'] = substr($t->order_dt,0,10);
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['account_nm'] = $acc->account_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['sales_price'] = $t->reversion_sales_price;
			$re[$i]['supply_price'] = $t->supply_price;
			$re[$i]['tax'] = $t->tax;
			$re[$i]['total_price'] = $t->total_price;
			$i++;			
		}

		echo $json->encode($re);
	}

	// 기간별 판매현황
	public function getPeriodSalesList(){
		$json = new Services_JSON;
		$sql = "select * from obtain_order where (date(order_dt) between '".$this->parameter['start_dt']."' and '".$this->parameter['end_dt']."')";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$sql = "select sum(supply_price) as supply_price, sum(tax) as tax, sum(total_price) as total_price from obtain_order_item where fid=".$t->uid;
			$this->sub_query($sql);
			$r = $this->sub_fetch();

			$re[$i]['order_dt'] = substr($t->order_dt,0,10);
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['supply_price'] = $r->supply_price;
			$re[$i]['tax'] = $r->tax;
			$re[$i]['total_price'] = $r->total_price;
			$i++;
		}

		echo $json->encode($re);

	}

	// 업체별 판매순위표
	public function getAccountSalesChart() {
		// 기간별 전체 매출액을 구한다
		// 
	}

	// 업체별 세부매입현황
	public function getAccountPurchaseList(){
		$json = new Services_JSON;
		$sql = "select * from orders where account_cd='".$this->parameter['account_cd']."' and (date(create_dt) between '".$this->parameter['start_dt']."' and '".$this->parameter['end_dt']."')";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$sql = "select * from orders_item where fid=".$t->uid;
			$this->sub_query($sql);
			while($r = $this->sub_fetch()){
				$re[$i]['create_dt'] = substr($t->create_dt,0,10);
				$re[$i]['item_cd'] = $r->item_cd;
				$re[$i]['item_nm'] = $r->item_nm;
				$re[$i]['standard'] = $r->standard;
				$re[$i]['cnt'] = $r->cnt;
				$re[$i]['cost'] = $r->cost;
				$re[$i]['supply_price'] = $r->supply_price;
				$re[$i]['tax'] = $r->tax;
				$re[$i]['total_cost'] = $r->total_cost;
				$i++;
			}
		}

		echo $json->encode($re);

	}

	// 품목별 발주현황
	public function getItemOrdersList() {
		$json = new Services_JSON;
		$sql = "select * from orders_item where item_cd='".$this->parameter['item_cd']."' and (date(create_dt) between '".$this->parameter['start_dt']."' and '".$this->parameter['end_dt']."')";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['order_cd'] = $t->order_cd;

			$sql = "select account_cd, account_nm from orders where uid=".$t->fid;
			$this->sub_query($sql);
			$acc = $this->sub_fetch();

			$re[$i]['account_nm'] = $acc->account_nm;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['total_cost'] = $t->total_cost;
			$re[$i]['in_cnt'] = $t->cnt - $t->remain_cnt;
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$re[$i]['remain_cost'] = $t->remain_cnt * $t->cost;
			$i++;
		}

		echo $json->encode($re);
	}

	// 기간별 발주현황
	public function getPeriodOrdersList(){
		$json = new Services_JSON;

		$sql = "select * from orders where (date(create_dt) between '".$this->parameter['start_dt']."' and '".$this->parameter['end_dt']."')";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['account_nm'] = $t->account_nm;

			$sql = "select sum(total_cost) as total_cost from orders_item where fid=".$t->uid;
			$this->sub_query($sql);
			$ord = $this->sub_fetch();

			$re[$i]['total_cost'] = $ord->total_cost;
			$i++;
		}
		echo $json->encode($re);
	}

	// 미수금 가져오기
	public function getReceivablesList() {
		$json = new Services_JSON;
		$this->getTable("receivables", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);

		$i = 0;
		while($t = $this->fetch()) {
			$line = "";

			$re[$i]['uid'] = $t->uid;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['amount'] = $t->amount;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['telephone'] = $t->telephone;
			$re[$i]['mobile'] = $t->mobile;
			$re[$i]['owner'] = $t->owner;
			$re[$i]['collect_amount'] = $t->collect_amount;
			$re[$i]['remain_amount'] = $t->remain_amount;
			$re[$i]['last_collect_dt'] = $this->convertNull(substr($t->last_collect_dt,0,10));
			$re[$i]['next_collect_dt'] = $this->convertNull(substr($t->next_collect_dt,0,10));
			$re[$i]['state'] = $t->state;
			
			$i++;
		}

		echo $json->encode($re);		
	}
	
	//미수금 하나 가져오기
	public function getReceivables() {
		$json = new Services_JSON;
		$sql = "select * from receivables where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();
		
		$re['uid'] = $t->uid;
		$re['account_cd'] = $t->account_cd;
		$re['account_nm'] = $t->account_nm;
		$re['amount'] = $t->amount;
		$re['create_dt'] = substr($t->create_dt,0,10);
		$re['telephone'] = $t->telephone;
		$re['mobile'] = $t->mobile;
		$re['owner'] = $t->owner;
		$re['collect_amount'] = $t->collect_amount;
		$re['remain_amount'] = $t->remain_amount;
		$re['last_collect_dt'] = $this->convertNull(substr($t->last_collect_dt,0,10));
		$re['next_collect_dt'] = $this->convertNull(substr($t->next_collect_dt,0,10));
		$re['state'] = $t->state;

		echo $json->encode($re);
	}

	// 미지급금 가져오기
	public function getPayableList() {
		$json = new Services_JSON;
		$this->getTable("payable", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page']);

		$i = 0;
		while($t = $this->fetch()) {
			$line = "";

			$re[$i]['uid'] = $t->uid;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['amount'] = $t->amount;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['telephone'] = $t->telephone;
			$re[$i]['mobile'] = $t->mobile;
			$re[$i]['owner'] = $t->owner;
			$re[$i]['provide_amount'] = $t->provide_amount;
			$re[$i]['remain_amount'] = $t->remain_amount;
			$re[$i]['last_provide_dt'] = $this->convertNull(substr($t->last_provide_dt,0,10));
			$re[$i]['next_provide_dt'] = $this->convertNull(substr($t->next_provide_dt,0,10));
			$re[$i]['state'] = $t->state;
			
			$i++;
		}

		echo $json->encode($re);		
	}
	
	//미지급금 하나 가져오기
	public function getPayable() {
		$json = new Services_JSON();
		$sql = "select * from payable where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();

		$re['uid'] = $t->uid;
		$re['account_cd'] = $t->account_cd;
		$re['account_nm'] = $t->account_nm;
		$re['amount'] = $t->amount;
		$re['create_dt'] = substr($t->create_dt,0,10);
		$re['telephone'] = $t->telephone;
		$re['mobile'] = $t->mobile;
		$re['owner'] = $t->owner;
		$re['provide_amount'] = $t->provide_amount;
		$re['remain_amount'] = $t->remain_amount;
		$re['last_provide_dt'] = $this->convertNull(substr($t->last_provide_dt,0,10));
		$re['next_provide_dt'] = $this->convertNull(substr($t->next_provide_dt,0,10));
		$re['state'] = $t->state;

		echo $json->encode($re);
	}
/*****************************************************************************************************************************/
// 모니터링 및 현장사용
/*****************************************************************************************************************************/
	// 로그인 -------------------------------------
	public function sLoginPurchase(){
		if($this->parameter['id'] == "root" && $this->parameter['password'] == "sysadmin"){
			$_SESSION['login_id'] = "sysadmin";
			$_SESSION['login_nm'] = "최고관리자";
			$_SESSION['login_level'] = "100";
			echo "success";
		}else{
			echo "false";
		}
	}

	// Orders_Item 리스트 뿌리기 -------------------------------------
	public function sGetOrdersItemList(){
		$json = new Services_JSON;
		$sql = "select * from orders_item where state='발주' or state='부분입고'";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$department = $this->getName("department_middle","department_nm",$t->middle_department)."-".$this->getName("department_small","department_nm",$t->small_department);

			$re[$i]['uid'] = $t->uid;
			$re[$i]['order_cd'] = $this->convertNull($t->order_cd);
			$re[$i]['purchase_type'] = $t->purchase_type;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$re[$i]['delivery_dt'] = substr($t->delivery_dt,0,10);
			$re[$i]['department'] = $department;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['account'] = $t->account;
			$re[$i]['account_nm'] = $this->getCompareName("account","account_nm","uid",$t->account);
			$re[$i]['cost'] = $t->cost;
			$re[$i]['total_cost'] = $t->total_cost;
			$re[$i]['state'] = $t->state;
			$re[$i]['approval'] = $t->approval;
			$i++;
		}

		echo $json->encode($re);
	}

	// Orders_Item 상세정보 가져오기 -------------------------------------

	public function sGetItemInfo(){
		$json = new Services_JSON();

		$sql = "select * from orders_item where uid='".$this->parameter['uid']."'";

		$this->query($sql);
		
		$t=$this->fetch();
			$re['uid'] = $t->uid;
			$re['fid'] = $t->fid;
			$re['order_cd'] = $t->order_cd;
			$re['purchase_type'] = $t->purchase_type;
			$re['item_cd'] = $t->item_cd;
			$re['item_nm'] = $t->item_nm;
			$re['standard'] = $t->standard;
			$re['unit'] = $t->unit;
			$re['cnt'] = $t->cnt;
			$re['delivery_dt'] = $t->delivery_dt;
			$re['big_department'] = $this->convertNull($this->getCompareName("department_big", "department_nm","uid", $t->big_department));
			$re['middle_department'] = $this->convertNull($this->getCompareName("department_middle", "department_nm","uid", $t->middle_department));
			$re['small_department'] = $this->convertNull($this->getCompareName("department_small", "department_nm","uid", $t->small_department));
			$re['emp_id'] = $t->emp_id;
			$re['emp_nm'] = $t->emp_nm;
			$re['account'] =  $t->account;
			$re['cost'] = $t->cost;
			$re['total_cost'] = $t->total_cost;
			$re['remain_cnt'] = $t->remain_cnt;
			$re['state'] = $t->state;
			$re['approval'] = $t->approval;
			$re['create_dt'] = $t->create_dt;
		
		echo $json->encode($re);
	
	}

	// Warehouse 목록 가져오기 -------------------------------------

	public function sGetWarehouse(){
		$json = new Services_JSON();

		$sql = "select * from warehouse";
		$this->query($sql);

		$i = 0;
		while($t=$this->fetch()){
			$re[$i]['uid'] = $t->uid;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			
			$i++;
		}
		echo $json->encode($re);
	}


	// KeyIn 입고 등록 -------------------------------------

	public function sRegistWarehousing(){
		$cnt = $this->replaceComma($this->parameter['in_cnt']) + $this->replaceComma($this->parameter['add_cnt']);
		$warehouse = "warehouse_".$this->parameter['warehouse'];

		$sql = "select * from orders_item where uid=".$this->parameter['uid'];
		$this->query($sql);
		$item = $this->fetch();
		$timestamp = time();
		
		$data = array(
			"table" => $warehouse,
			"fid" => $this->parameter['warehouse'],
			"classify" => $this->getItemClassify($item->item_cd, $item->standard),
			"item_cd" => $item->item_cd,
			"item_nm" => $item->item_nm,
			"standard" => $item->standard,
			"unit" => $item->unit,
			"cnt" => $cnt,
			"lot_no" => $timestamp,
			"create_dt" => $this->now
		);
		$result = $this->insert($data);
		
		$data = array(
			"table" => "lot_no",
			"classify" => "I",
			"lot_no" => $timestamp,
			"account_cd" => $this->getCompareName("account","account_cd","uid",$item->account),
			"account_nm" => $this->getCompareName("account","account_nm","uid",$item->account),
			"price" => $item->cost,
			"in_cnt" => $item->cnt,
			"item_cd" => $item->item_cd,
			"item_nm" => $item->item_nm,
			"standard" => $item->standard,
			"unit" => $item->unit,
			"emp_id" => $_SESSION['login_id'],
			"emp_nm" => $_SESSION['login_nm'],
			"process" => 0,
			"process_nm" => "",
			"machine" => 0,
			"machine_nm" => "",
			"team" => 0,
			"team_nm" => "",
			"sales_account_cd" => "",
			"sales_account_nm" => "",
			"sales_price" => 0,
			"out_cnt" => 0,
			"create_dt" => $this->now
		);
		$this->insert($data);

		if($item->remain_cnt <= $cnt) {
			$state = "입고완료";
			$remain_cnt = 0;
		} else {
			$state = "부분입고";
			$remain_cnt = $item->cnt - $cnt;
		}

		if($result) {
			$sql = "update orders_item set remain_cnt=".$remain_cnt.", state='".$state."' where uid=".$this->parameter['uid'];
			//echo $sql;
			$this->query($sql);

			$this->registInOut("in","구매입고",$item->item_cd,$cnt,$item->cost,$this->parameter['lot_no']);
		}
	}

	public function sGetWorkList() {
		$json = new Services_JSON;

		// 작업완료 된것을 어떻게 해야 할까?
		$sql = "select * from work where process=".$this->parameter['process']." and machine=".$this->parameter['machine'];
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['process'] = $t->process;
			$re[$i]['process_nm'] = $this->getCompareName("process","process_nm","uid",$t->process);
			$re[$i]['machine'] = $t->machine;
			$re[$i]['machine_nm'] = $this->getCompareName("machine","machine_nm","uid",$t->machine);
			$re[$i]['team'] = $t->team;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['start_dt'] = substr($t->start_dt, 0, 10);
			$re[$i]['end_dt'] = substr($t->end_dt, 0, 10);
			$re[$i]['seq'] = $t->seq;
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$re[$i]['state'] = $t->state;
			$re[$i]['create_dt'] = substr($t->create_dt, 0, 10);
			$i++;
		}

		echo $json->encode($re);
	}
	
	// 생산라인 투입자재 스캔
	public function sGetBarcodeInfo() {
		$json = new Services_JSON;
		
		$sql = "select work_cd from work where uid=".$this->parameter['work_uid'];
		$this->query($sql);
		$work = $this->fetch();

		$sql = "select * from lot_no_process where lot_no=".$this->parameter['barcode'];
		$this->query($sql);
		$bar = $this->fetch();
		
		if($bar->work_cd != $work->work_cd) {
			$re['result'] = "false";
		} else {		
			// 바코드 컨버팅
			$sql = "select * from releases_warehouse where lot_no='".$this->parameter['barcode']."'";
			$this->query($sql);
			$t = $this->fetch();

			$re['result'] = "true";
			$re['item_cd'] = $t->item_cd;
			$re['item_nm'] = $t->item_nm;
			$re['standard'] = $t->standard;
			$re['unit'] = $t->unit;
			$re['cnt'] = $t->cnt;
			$re['lot_no'] = $t->lot_no;

			
		}

		echo $json->encode($re);
	}

	// 투입자재 등록
	public function sRegistInItem() {
		$item_cd = $this->parameter['item_cd'];
		$item_nm = $this->parameter['item_nm'];
		$standard = $this->parameter['standard'];
		$unit = $this->parameter['unit'];
		$cnt = $this->parameter['incnt'];
		$lot_no = $this->parameter['lot_no'];
		
		$warehouse = "process_warehouse_".$this->parameter['process'];
		$result = $this->isTable($warehouse,DB_NAME);
		
		if($result) {
			foreach($item_cd as $key => $val) {
				$data = array(
					"table" => $warehouse,
					"fid" => $this->parameter['process'],
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"unit" => $unit[$key],
					"cnt" => $cnt[$key],
					"lot_no" => $lot_no[$key],
					"create_dt" => $this->now
				);
				//var_dump($data);
				$result = $this->insert($data);
				if($result) {
					$sql = "update lot_no_process set used='y' where lot_no=".$lot_no[$key];
					$this->query($sql);
					
					// 자재불출창고에서 삭제
					//$sql = "delete from releases_warehouse where lot_no='".$lot_no[$key]."'";
					//$this->query($sql);

					// 자재불출창고에서 업데이트
					$sql = "update releases_warehouse set state='불출' where lot_no='".$lot_no[$key]."'";
					$this->query($sql);
				}

			}

			echo "success";
		} else {
			$sql = "
				CREATE TABLE `".$warehouse."` (
					`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
					`fid` INT(11) NULL DEFAULT NULL COMMENT 'process uid',
					`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
					`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목명',
					`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
					`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
					`cnt` INT(11) NULL DEFAULT NULL COMMENT '수량',
					`lot_no` VARCHAR(50) NULL DEFAULT NULL COMMENT 'lot no',
					`create_dt` DATETIME NULL DEFAULT NULL COMMENT '입고일',
					PRIMARY KEY (`uid`),
					INDEX `fid` (`fid`),
					INDEX `item_cd` (`item_cd`),
					INDEX `standard` (`standard`)
				)
				COLLATE='utf8_general_ci'
				ENGINE=InnoDB
				;
			";
			$this->query($sql);

			foreach($item_cd as $key => $val) {
				$data = array(
					"table" => $warehouse,
					"fid" => $this->parameter['process'],
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"unit" => $unit[$key],
					"cnt" => $cnt[$key],
					"lot_no" => $lot_no[$key],
					"create_dt" => $this->now
				);

				$result = $this->insert($data);

				if($result) {
					$sql = "update lot_no_process set used='y' where lot_no=".$lot_no[$key];
					$this->query($sql);

					// 자재불출창고에서 삭제
					//$sql = "delete from releases_warehouse where lot_no='".$lot_no[$key]."'";
					//$this->query($sql);

					// 자재불출창고에서 업데이트
					$sql = "update releases_warehouse set state='불출' where lot_no='".$lot_no[$key]."'";
					$this->query($sql);
				}
			}
		}
	}

	// work_station 등록
	public function sRegistWorkStation() {
		$sql = "select * from program_setting";
		$this->query($sql);
		$setting = $this->fetch();


		// 작업지시상태의 작업인지 검사한다.
		$sql = "select state,item_process from work where uid=".$this->parameter['uid'];
		$this->query($sql);
		$work = $this->fetch();
		if($work->state != "작업지시" && $work->state != "작업수정지시") {
			echo "nostay";
			exit;
		}

		// 투입자재가 충분한지 검사
		// $sql = "select uid from item where item_cd='".$this->parameter['item_cd']."'";
		// $this->query($sql);
		// $item = $this->fetch();

		// $sql = "select uid from temp_item_process where process=".$this->parameter['process']." and item_uid=".$item->uid;
		// $this->query($sql);
		// $item_process = $this->fetch();

		// 환경설정에서 공정투입자재가 없어도 작업이 진행이 가능하도록 세팅이 되었다면
		if($setting->compulsionWork != "y") {		
			// $sql = "select * from temp_in_item where fid=".$item_process->uid;
			$sql = "select * from temp_in_item where fid=".$work->item_process;
			$this->query($sql);
			while($t = $this->fetch()) {
				$stock = $this->getProcessStockCnt($t->item_cd, $t->standard, $this->parameter['process']);
				$need = $this->replaceComma($this->parameter['cnt']) * $t->cnt;

				if($stock < $need) {
					$shortage = $need - $stock;
					echo $t->item_cd." [".$t->item_nm."]_shortage_".$shortage;
					exit;
				}
			}
		}


		$sql = "select * from work where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();
		
		$sql = "select * from work_station where state='작업중' and work_cd='".$t->work_cd."'";
		$this->query($sql);
		if($this->get_rows() > 0) {
			echo "already";
			exit;
		}

		$sql = "select * from work_station where state='작업중' and process=".$this->parameter['process']." and machine=".$this->parameter['machine'];
		$this->query($sql);
		if($this->get_rows() > 0) {
			echo "impossible";
			exit;
		}

		$data = array(
			"table" => "work_station",
			"work_dt" => $this->now,
			"work_cd" => $t->work_cd,
			"account_cd" => $t->account_cd,
			"account_nm" => $t->account_nm,
			"item_cd" => $t->item_cd,
			"item_nm" => $t->item_nm,
			"standard" => $t->standard,
			"process" => $this->parameter['process'],
			"machine" => $this->parameter['machine'],
			"team" => 0,
			"state" => "작업중",
			"cnt" => $t->cnt,
			"make_cnt" => 0,
			"remain_cnt" => $t->remain_cnt
		);

		$this->insert($data);

		// 수주서 상태 바꾸기
		$sql = "update obtain_order set state='작업중' where order_cd='".$t->order_cd."'";
		$this->query($sql);

		$sql = "update work set state='작업중' where uid=".$this->parameter['uid'];
		$result = $this->query($sql);

		echo "success";
	}

	// 생산라인 로그인
	public function sLogin() {
		//echo $_SESSION['login_id'];
		if($_SESSION['login_id'] == "") {
			if($this->parameter['login_id'] == "root" && $this->parameter['login_pwd'] == "1111") {
				$_SESSION['login_uid'] = "0";
				$_SESSION['login_id'] = "sysadmin";
				$_SESSION['login_nm'] = "최고관리자";
				$_SESSION['login_level'] = "100";
				$_SESSION['process'] = $this->parameter['process'];
				$_SESSION['machine'] = $this->parameter['machine'];

				echo "success";
			} else {
				$sql = "select * from employee where emp_id='".$this->parameter['login_id']."'";
				//echo $sql;
				$t = @mysql_fetch_object(mysql_query($sql));

				if($t->emp_id != "") {
					if($t->emp_pwd == $this->parameter['login_pwd']) {
						$_SESSION['login_uid'] = $t->uid;
						$_SESSION['login_id'] = $t->emp_id;
						$_SESSION['login_nm'] = $t->emp_nm;
						$_SESSION['process'] = $this->parameter['process'];
						$_SESSION['process_nm'] = $this->getCompareName("process","process_nm","uid",$this->parameter['process']);
						$_SESSION['machine'] = $this->parameter['machine'];
						$_SESSION['machine_nm'] = $this->getCompareName("machine","machine_nm","uid",$this->parameter['machine']);

						echo "success";
					} else {
						echo "pwd";
					}
				} else {
					echo "none";
				}
			}
		}
	}

	// work_station 가져오기
	public function sGetWorkStation() {
		$json = new Services_JSON;

		$sql = "select * from work";
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['work_dt'] = $t->work_dt;
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['process'] = $t->process;
			$re[$i]['process_nm'] = $this->getCompareName("process","process_nm","uid",$t->process);
			$re[$i]['machine'] = $t->machine;
			$re[$i]['machine_nm'] = $this->getCompareName("machine","machine_nm","uid",$t->machine);
			$re[$i]['team'] = $t->team;
			$re[$i]['state'] = $t->state;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['make_cnt'] = $t->make_cnt;
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$re[$i]['percent'] = ($t->make_cnt/$t->cnt) * 100;
			$i++;
		}

		echo $json->encode($re);
	}

	// 작업중단
	public function sStopWork() {
		$sql = "select * from work where uid=".$this->parameter['work_uid'];
		$this->query($sql);
		$work = $this->fetch();
		
		$sql = "select state from work_station where work_cd='".$work->work_cd."'";
		$this->query($sql);
		$t = $this->fetch();
		if($t->state != "작업중" && $t->state != "작업중단") {
			echo "notstart";
			exit;
		} else if($t->state == "작업중단") {
			echo "alreadystop";
			exit;
		}

		$sql = "update work set state='작업중단' where uid=".$this->parameter['work_uid'];
		$this->query($sql);

		$sql = "update work_station set state='작업중단' where work_cd='".$work->work_cd."'";
		$this->query($sql);

		$data = array(
			"table" => "work_down",
			"fid" => $this->parameter['work_uid'],
			"work_cd" => $work->work_cd,
			"process" => $work->process,
			"machine" => $work->machine,
			"emp_id" => $_SESSION['login_id'],
			"emp_nm" => $_SESSION['login_nm'],
			"start_tm" => time(),
			"end_tm" => 0,
			"stop_tm" => 0,
			"create_dt" => $this->now
		);

		$this->insert($data);
		$uid = $this->get_insert_id();

		$_SESSION['work_down_uid'] = $uid;
		echo "success_".$uid; 
	}
	
	// 작업중단이 가능한 작업인지 확인
	public function sCheckStopWork() {
		$sql = "select state from work where uid=".$this->parameter['work_uid'];
		$this->query($sql);
		$work = $this->fetch();
		if($work->state != "작업중단") {
			echo "nostop";
			exit;
		} else {
			echo "success";
		}
	}

	// 작업종료가 가능한 작업인지 확인
	public function sCheckEndWork() {
		$sql = "select state from work where uid=".$this->parameter['work_uid'];
		$this->query($sql);
		$work = $this->fetch();
		if($work->state != "작업중") {
			echo "nostop";
			exit;
		} else {
			echo "success";
		}
	}

	// 작업재개
	public function sRegistRestartWork() {
		$sql = "select * from work_down where uid=".$this->parameter['work_down_uid'];
		$this->query($sql);
		$t = $this->fetch();

		$stop_tm = time() - $t->start_tm;
		
		$data = array(
			"table" => "work_down",
			"where" => "uid=".$this->parameter['work_down_uid'],
			"abnormal_type" => $this->parameter['abnormal_type'],
			"down_type" => $this->parameter['down_type'],
			"abnormal_comment" => $this->parameter['abnormal_comment'],
			"action_comment" => $this->parameter['action_comment'],
			"end_tm" => time(),
			"stop_tm" => $stop_tm
		);

		$this->update($data);
		
		$sql = "update work set state='작업중' where uid=".$this->parameter['work_uid'];
		$this->query($sql);

		$sql = "update work_station set state='작업중' where work_cd='".$t->work_cd."'";
		$this->query($sql);

		echo "success"; 
	}

	// 수주서 가져오기
	public function sGetObtainOrderList() {
		$json = new Services_JSON();
		$sql = "select * from obtain_order";
		$this->query($sql);
		
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;			
			$re[$i]['estimate_cd'] = $t->estimate_cd;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['estimate_dt'] = substr($t->estimate_dt, 0, 10);
			$re[$i]['order_dt'] = substr($t->order_dt, 0, 10);
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['sales_emp_id'] = $t->sales_emp_id;
			$re[$i]['sales_emp_nm'] = $t->sales_emp_nm;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['stock_cnt'] = $this->getStockCnt($t->item_cd);
			$re[$i]['price'] = $t->price;
			$re[$i]['use_tax'] = $t->use_tax;
			$re[$i]['tax'] = $t->tax;
			$re[$i]['total_price'] = $t->total_price;
			$re[$i]['delivery_dt'] = substr($t->delivery_dt, 0, 10);
			$re[$i]['shipping_address'] = $t->shipping_address;
			$re[$i]['state'] = $this->convertNull($t->state);
			
			$i++;
		}

		echo $json->encode($re);
	}

	// 작업종료 할 때 무엇을 작업 종료하는 지 알기 위해
	public function sGetWork() {
		$json = new Services_JSON;

		$sql = "select * from work where uid=".$this->parameter['uid'];
		$this->query($sql);
		$t = $this->fetch();
		
		$re['work_cd'] = $t->work_cd;
		$re['process'] = $t->process;
		$re['process_nm'] = $this->getCompareName("process","process_nm","uid",$t->process);
		$re['machine'] = $t->machine;
		$re['machine_nm'] = $this->getCompareName("machine","machine_nm","uid",$t->machine);
		$re['team'] = $t->team;
		$re['item_cd'] = $t->item_cd;
		$re['item_nm'] = $t->item_nm;
		$re['standard'] = $t->standard;
		$re['cnt'] = $t->cnt;
		
		echo $json->encode($re);
	}

	// 작업종료 (생산실적 등록)
	public function sEndWork() {
		$lot_no = time();
		$sql = "select * from work where work_cd='".$this->parameter['end_work_cd']."'";
		$this->query($sql);
		$work = $this->fetch();

		// 만들어진 생산품을 어디로 보내야 할 지...
		$sql = "select * from temp_item_process where uid=".$work->item_process;
		$this->query($sql);
		$tip = $this->fetch();
		$sql = "select uid from temp_item_process where order_cd='".$tip->order_cd."' and no > ".$tip->no." order by no asc limit 1";
		$this->query($sql);
		$next = $this->fetch();

		if($next->uid != "") {
			$sql = "select work_cd,process,machine from work where item_process=".$next->uid;		
			$this->query($sql);
			$next_work = $this->fetch();

			$next_process = $next_work->process;
			$next_machine = $next_work->machine;
			$next_work_cd = $next_work->work_cd;
		} else {
			$next_process = "0";
			$next_machine = "0";
			$next_work_cd = "";
		}
		
		
		$item_uid = $this->getItemUid($this->parameter['end_item_cd'], $this->parameter['end_standard']);
		$sql = "select order_cd,no,after_process from temp_item_process where item_uid=".$item_uid." and process=".$_SESSION['process'];
		$this->query($sql);
		$item_process = $this->fetch();

		

		$sql = "select qc from process where uid=".$item_process->after_process;
		$this->query($sql);
		$process = $this->fetch();

		if($process->qc == "y") { // 다음공정이 qc 라면 qc 테이블에 등록
			$data = array(
				"table" => "qc",
				"obtain_order_cd" => $work->order_cd,
				"work_cd" => $this->parameter['end_work_cd'],
				"item_cd" => $this->parameter['end_item_cd'],
				"item_nm" => $this->parameter['end_item_nm'],
				"standard" => $this->parameter['end_standard'],
				"cnt" => $this->parameter['end_make_cnt'],
				"lot_no" => $lot_no,
				"create_dt" => $this->now,
				"state" => "n"
			);
			$this->insert($data);
		} else { // 다음공정이 qc 가 아니라면 생산품은 해당 공정창고에 등록하고 차후 다음 공정에서 투입이 발생할 때 그 때 차감하도록 한다

			if($work->warehouse == 0) { // 다음 공정이라면				
				$data = array(
					"table" => "releases_warehouse",
					"work_cd" => $this->parameter['end_work_cd'],
					"next_work_cd" => $next_work->work_cd,
					"process" => $next_process,
					"machine" => $next_machine,
					"team" => 0,
					"item_cd" => $this->parameter['end_item_cd'],
					"item_nm" => $this->parameter['end_item_nm'],
					"standard" => $this->parameter['end_standard'],
					"unit" => $this->parameter['unit'],
					"cnt" => $this->parameter['end_make_cnt'],
					"state" => "보관",
					"lot_no" => $lot_no,
					"create_dt" => $this->now
				);
				$this->insert($data);

				$data = array(
					"table" => "lot_no_process",
					"lot_no" => $lot_no,
					"work_cd" => $next_work_cd,
					"process" => $item_process->after_process,
					"used" => "n"
				);
				$this->insert($data);

				// 자재불출(가상창고)에 입력을 하고 출고요청서에 있는 항목인가 검사하여 출고항목을 출고처리한다.
				$sql = "select * from releases where obtain_order_cd='".$work->order_cd."' and item_cd='".$this->parameter['end_item_cd']."'";
				//echo $sql;
				$this->query($sql);
				while($t = $this->fetch()){
					$new_cnt = $t->cnt - $this->parameter['end_make_cnt'];
					if($new_cnt == 0) $state = "출고완료"; else $state = "부분출고";
					$sql = "update releases set remain_cnt=".$new_cnt.", state='".$state."' where uid=".$t->uid;
					//echo $sql;
					$this->sub_query($sql);
				}
			} else { // 생산입고라면
				$warehouse = "warehouse_".$work->warehouse;
				//생산품을 999로 정의
				$data = array(
					"table" => $warehouse,
					"fid" => $work->warehouse,
					"item_cd" => $this->parameter['end_item_cd'],
					"item_nm" => $this->parameter['end_item_nm'],
					"standard" => $this->parameter['end_standard'],
					"unit" => $this->parameter['unit'],
					"cnt" => $this->parameter['end_make_cnt'],
					"lot_no" => $lot_no,
					"create_dt" => $this->now
				);

				$this->insert($data);
			}
		}

		//$sql = "select * from work where work_cd='".$this->parameter['end_work_cd']."'";
		//$this->query($sql);
		//$work = $this->fetch();

		if($this->replaceComma($this->parameter['end_make_cnt']) >= $work->remain_cnt) {
			$sql = "update work set state='작업완료', remain_cnt=0 where uid=".$work->uid;
			$this->query($sql);
			$sql = "update work_station set state='작업완료', remain_cnt=0 where work_cd='".$work->work_cd."'";
			$this->query($sql);
		} else if($this->replaceComma($this->parameter['end_make_cnt']) < $work->remain_cnt) {
			$remain_cnt = $work->remain_cnt - $this->replaceComma($this->parameter['end_make_cnt']);
			$sql = "update work set state='작업완료', remain_cnt=".$remain_cnt." where uid=".$work->uid;
			$this->query($sql);
			$sql = "update work_station set state='작업완료', remain_cnt=".$remain_cnt." where work_cd='".$work->work_cd."'";
			$this->query($sql);
		}

		// 공정창고에서 실투입자재 빼기
		$in_uid = $this->parameter['in_uid'];
		$in_item_cd = $this->parameter['in_item_cd'];
		$in_item_nm = $this->parameter['in_item_nm'];
		$in_standard = $this->parameter['in_standard'];
		$in_unit = $this->parameter['in_unit'];
		$in_cnt = $this->parameter['in_cnt'];
		$in_lot_no = $this->parameter['in_lot_no'];
		
		$warehouse = "process_warehouse_".$_SESSION['process'];
		
		// Lot No 저장
		$data = array(
			"table" => "lot_no",
			"classify" => "P",
			"lot_no" => $lot_no,
			"account_cd" => "",
			"account_nm" => "",
			"price" => 0,
			"in_cnt" => 0,
			"item_cd" => $this->parameter['end_item_cd'],
			"item_nm" => $this->parameter['end_item_nm'],
			"standard" => $this->parameter['end_standard'],
			"unit" => $this->parameter['unit'],
			"emp_id" => $_SESSION['login_id'],
			"emp_nm" => $_SESSION['login_nm'],
			"process" => $_SESSION['process'],
			"process_nm" => $_SESSION['process_nm'],
			"machine" => $_SESSION['machine'],
			"machine_nm" => $_SESSION['machine_nm'],
			"team" => 0,
			"team_nm" => "",
			"sales_account_cd" => "",
			"sales_account_nm" => "",
			"sales_price" => 0,
			"out_cnt" => 0,
			"create_dt" => $this->now
		);
		$this->insert($data);

		$sql = "select * from program_setting";
		$this->query($sql);
		$conf = $this->fetch();

		if($conf->compulsionWork != "y") {
			foreach($in_uid as $key => $val) {
				$sql = "select * from ".$warehouse." where item_cd='".$in_item_cd[$key]."' and lot_no='".$in_lot_no[$key]."'";
				//echo $sql;
				$this->query($sql);
				$in_item = $this->fetch();

				$new_cnt = $in_item->cnt - $in_cnt[$key];
				if($new_cnt > 0) {
					$sql = "update ".$warehouse." set cnt=".$new_cnt." where uid=".$in_item->uid;
					//echo $sql;
					$this->query($sql);
				} else {
					$sql = "delete from ".$warehouse." where uid=".$in_item->uid;
					//echo $sql;
					$this->query($sql);
				}
				
				// 실투입자재 등록
				// lot_no 를 lot_no 테이블에 등록하고 해당 uid 를 fid로 삼아서 투입된 자재를 등록
				$data = array(
					"table" => "real_input_item",
					"parent_lot_no" => $lot_no,
					"item_cd" => $in_item_cd[$key],
					"item_nm" => $in_item_nm[$key],
					"standard" => $in_standard[$key],
					"unit" => $in_unit[$key],
					"lot_no" => $in_lot_no[$key],
					"cnt" => $in_cnt[$key],
					"create_dt" => $this->now
				);
				$this->insert($data);
			}
		}

		// 자동으로 투입자재를 감소시킨다
		if($conf->autoItemMinus == "y"){
			$sql = "select item_process from work where uid=".$work->uid;
			$this->query($sql);
			$item_process = $this->fetch();

			$sql = "select * from temp_in_item where fid=".$item_process->item_process;
			$this->query($sql);

			while($tt = $this->fetch()){
				$sql = "select * from warehouse";
				$this->sub_query($sql);
				$need_cnt = $tt->cnt * $this->parameter['end_make_cnt'];

				while($rr = $this->sub_fetch()){
					
					$warehouse = "warehouse_".$rr->uid;
					$sql = "select * from ".$warehouse." where item_cd='".$tt->item_cd."'";
					$res = mysql_query($sql);
					
					if(@mysql_num_rows($res) > 0) {
						$wh = @mysql_fetch_object($res);

						if($wh->cnt > $need_cnt) {
							$new_cnt = $wh->cnt - $need_cnt;
							$sql = "update ".$warehouse." set cnt=".$new_cnt." where uid=".$wh->uid;
							mysql_query($sql);
						} else {
							$need_cnt = $need_cnt - $wh->cnt;
							//$sql = "update ".$warehouse." set cnt=0 where uid=".$wh->uid;
							$sql = "update ".$warehouse." set cnt=".$need_cnt." where uid=".$wh->uid;
							mysql_query($sql);
						}
					}

					if($need_cnt <= 0) break;
				}
			}
		}

		// 불량품은 불량품 정보에 넣는다
		if($this->parameter['end_faulty_cnt'] != "" || $this->parameter['end_faulty_cnt'] != 0) {
			$data = array(
				"table" => "faulty",
				"work_cd" => $this->parameter['end_work_cd'],
				"item_cd" => $this->parameter['end_item_cd'],
				"item_nm" => $this->parameter['end_item_nm'],
				"standard" => $this->parameter['end_standard'],
				"cnt" => $this->parameter['end_faulty_cnt'],
				"reason" => $this->parameter['end_faulty_reason'],
				"lot_no" => $this->parameter['end_lot_no'],
				"create_dt" => $this->now
			);
			$this->insert($data);
		}

		// 작업일지 등록		
		$sql = "select uid from work_daily where DATE(create_dt)='".date('Y-m-d')."' and process=".$_SESSION['process']." and machine=".$_SESSION['machine'];
		echo $sql;
		$this->query($sql);
		if($this->get_rows() > 0) {
			$wd = $this->fetch();
			$data = array(
				"table" => "work_daily_item",
				"fid" => $wd->uid,
				"item_cd" => $this->parameter['end_item_cd'],
				"item_nm" => $this->parameter['end_item_nm'],
				"standard" => $this->parameter['end_standard'],
				"unit" => $this->parameter['unit'],
				"cnt" => $this->parameter['end_make_cnt']
			);
			$this->insert($data);
		} else {
			$data = array(
				"table" => "work_daily",
				"work_cd" => $this->parameter['end_work_cd'],
				"emp_id" => $_SESSION['login_id'],
				"emp_nm" => $_SESSION['login_nm'],				
				"process" => $_SESSION['process'],
				"machine" => $_SESSION['machine'],
				"lot_no" => $lot_no,
				"create_dt" => $this->now
			);
			$this->insert($data);
			$fid = $this->get_insert_id();

			$data = array(
				"table" => "work_daily_item",
				"fid" => $fid,
				"item_cd" => $this->parameter['end_item_cd'],
				"item_nm" => $this->parameter['end_item_nm'],
				"standard" => $this->parameter['end_standard'],
				"unit" => $this->parameter['unit'],
				"cnt" => $this->parameter['end_make_cnt']
			);
			$this->insert($data);
		}

		// 생산품이 수주품목과 같은지 비교
		$sql = "select * from obtain_order where order_cd='".$work->order_cd."'";
		$this->query($sql);
		$obtain_order = $this->fetch();

		if($obtain_order->state == "작업지시" || $obtain_order->state == "작업중") {

			$sql = "select * from obtain_order_item where fid=".$obtain_order->uid;
			$this->query($sql);
			$state = array();
			while($t = $this->fetch()){
				if($t->item_cd == $this->parameter['end_item_cd'] && $next_work_cd == "") {	

					if($this->parameter['end_make_cnt'] >= $t->remain_cnt){
						$sql = "update obtain_order_item set remain_cnt=0, state='생산완료' where uid=".$t->uid;
						$this->query($sql);
						array_push($state,"작업완료");
					} else if($this->parameter['end_make_cnt'] < $t->remain_cnt){
						$cnt = $t->remain_cnt - $this->parameter['end_make_cnt'];
						$sql = "update obtain_order_item set remain_cnt=".$cnt.", state='작업중' where uid=".$obtain_order->uid;
						$this->query($sql);
						array_push($state,"작업중");
					}
				}
			}

			if(sizeof($state) > 0){
				if(in_array("작업중", $state)){

				} else {
					$sql = "update obtain_order set state='생산완료' where uid=".$obtain_order->uid;
					$this->query($sql);
				}
			}
		}
	}

	//
	public function sGetInItem() {
		$json = new Services_JSON;
		
		$sql = "select uid from item where item_cd='".$this->parameter['item_cd']."'";
		//echo $sql;
		$this->query($sql);
		$item = $this->fetch();

		$sql = "select uid from item_process where fid=".$this->parameter['process']." and item_uid=".$item->uid;
		//echo $sql;
		$this->query($sql);
		$item_process = $this->fetch();
		
		$sql = "select * from in_item where fid=".$item_process->uid;
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$sql = "select * from process_warehouse_8 where item_cd='".$t->item_cd."' and standard='".$t->standard."'";
			$this->sub_query($sql);
			$select = "<select name='lot_no[]' id='lot_no' class='form-control input-lg' style='height:40px'>";
			while($tt = $this->sub_fetch()) {
				$select .= "<option value='".$tt->lot_no."'>".$tt->lot_no."</option>";
			}
			$select .= "</select>";

			$re[$i]['uid'] = $t->uid;
			$re[$i]['fid'] = $t->fid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['lot_no'] = $select;
			$re[$i]['classify_nm'] = $this->getCompareName("item_classify","classify_nm","uid",$t->classify);
			$i++;
		}

		echo $json->encode($re);
	}

	// 구매입고(keyin)
	public function sOrdersItemWarehousing() {
		$cnt = $this->replaceComma($this->parameter['in_cnt']) + $this->replaceComma($this->parameter['add_cnt']);
		$warehouse = "warehouse_".$this->parameter['warehouse'];

		$sql = "select * from orders_item where uid=".$this->parameter['uid'];
		$this->query($sql);
		$item = $this->fetch();

		$data = array(
			"table" => $warehouse,
			"fid" => $this->parameter['warehouse'],
			"classify" => $this->getItemClassify($item->item_cd, $item->standard),
			"item_cd" => $item->item_cd,
			"item_nm" => $item->item_nm,
			"standard" => $item->standard,
			"unit" => $item->unit,
			"cnt" => $cnt,
			"lot_no" => $this->parameter['lot_no'],
			"create_dt" => $this->now
		);
		$result = $this->insert($data);
		
		if($item->cnt <= $cnt) {
			$state = "입고완료";
			$remain_cnt = 0;
		} else {
			$state = "부분입고";
			$remain_cnt = $item->cnt - $cnt;
		}

		if($result) {
			$sql = "update orders_item set remain_cnt=".$remain_cnt.", state='".$state."' where uid=".$this->parameter['uid'];
			$this->query($sql);

			$this->registInOut(
				$this->parameter['warehouse'],
				$item->item_cd,
				$item->item_nm,
				$item->standard,
				$item->unit,
				"in",
				$cnt,
				$this->parameter['lot_no'],
				"구매입고",
				$this->now
			);
		}
	}

	// 생산불량사유 가져오기
	public function sGetFaultyReason() {
		$json = new Services_JSON;
		$sql = "select * from faulty_reason";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['reason'] = $t->reason;
			$i++;
		}

		echo $json->encode($re);
	}

	// 안전재고 리스트
	public function sGetSafetyStockList() {
		$json = new Services_JSON;

		$sql = "select * from safety_stock";
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['safety_stock_cnt'] = $t->safety_stock_cnt;
			$re[$i]['current_cnt'] = $t->current_cnt;
			$i++;
		}

		echo $json->encode($re);
	}

	// 작업준비시간 기록
	public function sRegistWorkReady() {
		$process = ($this->parameter['process'] == "") ? 0 : $this->parameter['process'];
		$machine = ($this->parameter['machine'] == "") ? 0 : $this->parameter['machine'];

		$data = array(
			"table" => "work_operation",
			"fid" => 0,
			"classify" => "작업준비",
			"process" => $process,
			"machine" => $machine,
			"item_cd" => "",
			"start_tm" => time(),
			"end_tm" => 0,
			"operation_tm" => 0,
			"create_dt" => $this->now
		);

		$this->insert($data);
		$uid = $this->get_insert_id();
		echo $uid;
	}

	// 작업종료시간 기록
	public function sRegistWorkReadyEnd() {
		$process = ($this->parameter['process'] == "") ? 0 : $this->parameter['process'];
		$machine = ($this->parameter['machine'] == "") ? 0 : $this->parameter['machine'];

		$data = array(
			"table" => "work_operation",
			"fid" => 0,
			"process" => $process,
			"machine" => $machine,
			"item_cd" => "",
			"end_tm" => time(),
			"operation_tm" => 0,
			"create_dt" => $this->now
		);

		$this->insert($data);
	}

	// 출고요청 리스트
	public function sGetReleaseList() {
		$json = new Services_JSON();
		$sql = "select * from releases";
		$this->query($sql);
		
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;			
			$re[$i]['classify'] = $t->classify;
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['process'] = $t->process;
			$re[$i]['process_nm'] = $this->convertNull($this->getCompareName("process","process_nm","uid",$t->process));
			$re[$i]['machine'] = $t->machine;
			$re[$i]['machine_nm'] = $this->convertNull($this->getCompareName("machine","machine_nm","uid",$t->machine));
			$re[$i]['team'] = $t->team;
			$re[$i]['team_nm'] = $this->convertNull($this->getCompareName("team","team_nm","uid",$t->team));
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['state'] = $t->state;
			$re[$i]['create_dt'] = substr($t->create_dt, 0, 10);
			
			$i++;
		}

		echo $json->encode($re);
	}

	// 작업 종료시 실시간으로 투입수량 계산하여 공정에 투입된 자재 수량 보다 많은지 검사
	public function checkProcessWarehouseCnt() {
		$warehouse = "process_warehouse_".$this->parameter['process'];
	
		$sql = "select * from cnt from";
	}

	// 품목 제조공정 관리의 투입 자재 리스트 가져오기
	public function getInItem() {
		$json = new Services_JSON;
		$sql = "select * from in_item where fid=".$this->parameter['process'];
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['fid'] = $t->fid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['classify'] = $t->classify;
			$re[$i]['classify_nm'] = $this->getCompareName("item_classify","classify_nm","uid",$t->classify);
			$i++;
		}
	
		echo $json->encode($re);
	}
}
?>