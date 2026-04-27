<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

$data = array();

switch($_POST['cmd']) {
	case "user_info" : // 로그인
		$sql = "select * from erp_employee where emp_id='".$_POST['id']."'";
		$t = @mysql_fetch_object(mysql_query($sql));

		if(isset($t->emp_id)) {
			if($t->emp_pwd == $_POST['pw']) {
				$_SESSION['login_id'] = $t->emp_id;
				$_SESSION['login_nm'] = $t->emp_nm;
				echo "true";
			} else {
				echo "pwd";
			}
		} else {
			echo "false";
		}
	break;

	case "estimate_list" : // 견적서 리스트
		$sql = "select * from erp_estimate order by uid desc  limit $idx, $cnt";
		$result = mysql_query($sql);

		while($t = mysql_fetch_object($result)) {
			$sql = "select sum(total_price) as total_price from erp_estimate_item where fid=".$t->uid;

			$res = @mysql_fetch_object(mysql_query($sql));
			 array_push($data, array('견적서코드'=>$t->estimate_cd, '거래처명'=>$t->account_nm,'견적금액'=>number_format($res->total_price), '견적일자'=>substr($t->estimate_dt,0,10)));
		}

		$json = json_encode(array("item"=>$data));
		echo $json;
	break;

	case "estimate_info" : // 견적서 상세
		$sql = "select * from erp_estimate where estimate_cd='".$idx."'";
		//echo $sql;
		$t = @mysql_fetch_object(mysql_query($sql));

		$sql = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
		$t2 = @mysql_fetch_object(mysql_query($sql));
		
		$data1 = array();
		array_push($data1, 
			array(
				'견적서코드'=>$t->estimate_cd,
				'견적일자'=>$t->estimate_dt,
				'거래처'=>$t->account_nm,
				'담당자'=>$t->manager,
				'출하창고'=>$t2->warehouse_nm,
				'프로젝트'=>$t->project_nm,
				'납품기한'=>substr($t->delivery_dt,0,10)
			)
		);

		$sql = "select * from erp_estimate_item where fid=".$t->uid;
		$result = mysql_query($sql);
		while($tt = mysql_fetch_object($result)) {
			array_push($data, 
				array(
					'품목명'=>$tt->item_nm,
					'규격'=>$tt->standard,
					'수량'=>$tt->cnt,
					'단가'=>$tt->unit_price,
					'합계'=>$tt->total_price
				)
			);
		}

		$json = json_encode(array("info"=>$data1,"item"=>$data));
		echo $json;
	break;

	case "order_list" : // 수주 리스트
		$sql = "select * from erp_order order by uid desc  limit $idx, $cnt";
		$result = mysql_query($sql);

		while($t = mysql_fetch_object($result)) {
			$sql = "select sum(total_price) as total_price from erp_estimate_item where fid=".$t->uid;

			$res = @mysql_fetch_object(mysql_query($sql));
			 array_push($data, array('주문서코드'=>$t->order_cd, '거래처명'=>$t->account_nm, '수주일자'=>substr($t->create_dt,0,10), '납품기한'=>substr($t->delivery_dt,0,10)));
		}

		$json = json_encode(array("item"=>$data));
		echo $json;
	break;

	case "order_info" : // 주문서 상세
		$sql = "select * from erp_order where order_cd='".$idx."'";
		//echo $sql;
		$t = @mysql_fetch_object(mysql_query($sql));

		$sql = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
		$t2 = @mysql_fetch_object(mysql_query($sql));
		
		$data1 = array();
		array_push($data1, 
			array(
				'주문서코드'=>$t->estimate_cd,
				'수주일자'=>$t->estimate_dt,
				'거래처'=>$t->account_nm,
				'담당자'=>$t->manager,
				'출하창고'=>$t2->warehouse_nm,
				'프로젝트'=>$t->project_nm,
				'납품기한'=>substr($t->delivery_dt,0,10)
			)
		);

		$sql = "select * from erp_order_item where fid=".$t->uid;
		$result = mysql_query($sql);
		while($tt = mysql_fetch_object($result)) {
			array_push($data, 
				array(
					'품목명'=>$tt->item_nm,
					'규격'=>$tt->standard,
					'수량'=>$tt->cnt,
					'단가'=>$tt->unit_price,
					'합계'=>$tt->total_price
				)
			);
		}

		$json = json_encode(array("info"=>$data1,"item"=>$data));
		echo $json;
	break;

	case "customer_list" : // 거래처 리스트
		$sql = "select * from erp_account order by uid desc  limit $idx, $cnt";
		$result = mysql_query($sql);

		while($t = mysql_fetch_object($result)) {
			if($t->account_gb == "purchase") $account_gb = "매입";
			else if($t->account_gb == "sales") $account_gb = "매출";
			array_push($data, array('거래처코드'=>$t->account_cd, '거래처명'=>$t->account_nm, '구분'=>$account_gb, '대표자'=>$t->owner, '전화번호'=>$t->owner_mobile));
		}

		$json = json_encode(array("item"=>$data));
		echo $json;
	break;

	case "customer_info" : // 거래처 상세
		$sql = "select * from erp_account where account_cd='".$idx."'";
		//echo $sql;
		$t = @mysql_fetch_object(mysql_query($sql));

		array_push($data, 
			array(
				'거래처코드'=>$t->account_cd,
				'거래처명'=>$t->account_nm,
				'대표자명'=>$t->owner,
				'대표자연락처'=>$t->owner_mobile,
				'사업자등록번호'=>$t->corp_reg_no,
				'업태/종목'=>$t->corp_condition."/".$t->corp_event,
				'전화'=>$t->corp_phone,
				'팩스'=>$t->corp_fax,
				'이메일'=>$t->corp_email,
				'담당자'=>$t->manager,
				'주소'=>$t->corp_address
			)
		);

		$json = json_encode(array("item"=>$data));
		echo $json;
	break;

	case "reqpurchase_list" : // 구매요청 리스트
		$sql = "select * from erp_purchase_demand_item order by uid desc  limit $idx, $cnt";
		$result = mysql_query($sql);

		

		while($t = mysql_fetch_object($result)) {
			$sql = "select * from erp_purchase_demand where uid=".$t->fid;
			$t2 = mysql_fetch_object(mysql_query($sql));

			$sql = "select account_nm from erp_item where item_cd='".$t->item_cd."' and standard='".$t->standard."'";
			$t3 = mysql_fetch_object(mysql_query($sql));

			array_push($data, array('구매요청코드'=>$t2->purchase_cd, '거래처명'=>$t3->account_nm, '품목'=>$t->item_nm, '수량'=>$t->cnt, '등록일자'=>substr($t2->create_dt,0,10)));
		}

		$json = json_encode(array("item"=>$data));
		echo $json;
	break;

	case "reqpurchase_info" : // 구매요청 상세
		$sql = "select * from erp_purchase_demand where purchase_cd='".$idx."'";
		$t = @mysql_fetch_object(mysql_query($sql));

		$sql = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
		$t2 = @mysql_fetch_object(mysql_query($sql));
		
		$data1 = array();
		array_push($data1, 
			array(
				'구매요청코드'=>$t->purchase_cd,
				'요청일자'=>substr($t->create_dt,0,10),
				'출하창고'=>$t2->warehouse_nm,
				'프로젝트'=>$t->project_nm
			)
		);

		$sql = "select * from erp_purchase_demand_item where fid=".$t->uid;
		$result = mysql_query($sql);
		while($tt = mysql_fetch_object($result)) {
			array_push($data, 
				array(
					'품목명'=>$tt->item_nm,
					'규격'=>$tt->standard,
					'수량'=>$tt->cnt,
					'단가'=>$tt->pur_unit_price,
					'합계'=>$tt->total_price
				)
			);
		}

		$json = json_encode(array("info"=>$data1,"item"=>$data));
		echo $json;
	break;

	case "reqorder_list" : // 자재발주 리스트
		$sql = "select * from erp_purchase_demand_item order by uid desc  limit $idx, $cnt";
		$result = mysql_query($sql);

		

		while($t = mysql_fetch_object($result)) {
			$sql = "select * from erp_purchase_demand where uid=".$t->fid;
			$t2 = mysql_fetch_object(mysql_query($sql));

			$sql = "select account_nm from erp_item where item_cd='".$t->item_cd."' and standard='".$t->standard."'";
			$t3 = mysql_fetch_object(mysql_query($sql));

			array_push($data, array('구매요청코드'=>$t2->purchase_cd, '거래처명'=>$t3->account_nm, '품목'=>$t->item_nm, '수량'=>$t->cnt, '등록일자'=>substr($t2->create_dt,0,10)));
		}

		$json = json_encode(array("item"=>$data));
		echo $json;
	break;
// 발주서 작업해야 함
	case "reqorder_info" : // 자재발주 상세
		$sql = "select * from erp_purchase_demand where purchase_cd='".$idx."'";
		$t = @mysql_fetch_object(mysql_query($sql));

		$sql = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
		$t2 = @mysql_fetch_object(mysql_query($sql));
		
		$data1 = array();
		array_push($data1, 
			array(
				'구매요청코드'=>$t->purchase_cd,
				'요청일자'=>substr($t->create_dt,0,10),
				'출하창고'=>$t2->warehouse_nm,
				'프로젝트'=>$t->project_nm
			)
		);

		$sql = "select * from erp_purchase_demand_item where fid=".$t->uid;
		$result = mysql_query($sql);
		while($tt = mysql_fetch_object($result)) {
			array_push($data, 
				array(
					'품목명'=>$tt->item_nm,
					'규격'=>$tt->standard,
					'수량'=>$tt->cnt,
					'단가'=>$tt->pur_unit_price,
					'합계'=>$tt->total_price
				)
			);
		}

		$json = json_encode(array("info"=>$data1,"item"=>$data));
		echo $json;
	break;

	case "workplan_list" : // 생산계획 리스트
		$sql = "select * from erp_workplan order by uid desc  limit $idx, $cnt";
		$result = mysql_query($sql);

		while($t = mysql_fetch_object($result)) {
			array_push($data, array('생산구분'=>$t->work_gb, '생산계획코드'=>$t->workplan_cd, '시작일'=>substr($t->start_dt,0,10), '종료일'=>substr($t->end_dt,0,10)));
		}

		$json = json_encode(array("item"=>$data));
		echo $json;
	break;

	case "workplan_info" : // 생산계획 상세
		$sql = "select * from erp_workplan where workplan_cd='".$idx."'";
		$t = @mysql_fetch_object(mysql_query($sql));
		
		$data1 = array();
		array_push($data1, 
			array(
				'생산유형'=>$t->work_gb,
				'생산기간'=>substr($t->start_dt,0,10)."-".substr($t->end_dt,0,10),
				'제목'=>$t->title
			)
		);

		$sql = "select * from erp_workplan_item where workplan_cd='".$t->workplan_cd."'";
		$result = mysql_query($sql);
		while($tt = mysql_fetch_object($result)) {
			array_push($data, 
				array(
					'품목명'=>$tt->item_nm,
					'규격'=>$tt->standard,
					'수량'=>$tt->cnt,
					'착수'=>substr($tt->work_start_dt,0,10),
					'종료'=>substr($tt->work_end_dt,0,10)
				)
			);
		}

		$json = json_encode(array("info"=>$data1,"item"=>$data));
		echo $json;
	break;

	case "work_list" : // 작업지시서 리스트
		$sql = "select * from erp_work_item order by uid desc  limit $idx, $cnt";
		$result = mysql_query($sql);

		while($t = mysql_fetch_object($result)) {
			$sql = "select start_dt,end_dt from erp_work where work_cd='".$t->work_cd."'";
			$tt = mysql_fetch_object(mysql_query($sql));
			array_push($data, array('유니크아이디'=>$t->uid, '작업지시코드'=>$t->work_cd, '품목'=>$t->item_nm, '지시수량'=>$t->order_cnt, '시작일'=>substr($tt->start_dt,0,10), '종료일'=>substr($tt->end_dt,0,10)));
		}

		$json = json_encode(array("item"=>$data));
		echo $json;
	break;

	case "work_info" : // 생산계획 상세
		$sql = "select * from erp_work_item where uid=".$idx;
		$t = @mysql_fetch_object(mysql_query($sql));

		$sql = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
		$t2 = @mysql_fetch_object(mysql_query($sql));

		$sql = "select process_nm from erp_process where uid=".$t->process;
		$t3 = @mysql_fetch_object(mysql_query($sql));

		$sql = "select machine_nm from erp_machine where uid=".$t->machine;
		$t4 = @mysql_fetch_object(mysql_query($sql));
		
		array_push($data, 
			array(
				'작업지시서코드'=>$t->work_cd,
				'프로세스'=>$t3->process_nm,
				'기계'=>$t4->machine_nm,
				'작업품목'=>$t->item_nm,
				'규격'=>$t->standard,
				'목표수량'=>$t->goal_cnt,
				'지시수량'=>$t->order_cnt,
				'생산수량'=>$t->make_cnt,
				'잔여수량'=>$t->remain_cnt,
				'입고창고'=>$t2->warehouse_nm
			)
		);

		$json = json_encode(array("info"=>$data));
		echo $json;
	break;

	case "qc_list" : // 품질관리 리스트
		$sql = "select * from erp_qc order by uid desc  limit $idx, $cnt";
		$result = mysql_query($sql);

		while($t = mysql_fetch_object($result)) {
			$sql = "select * from erp_defective where work_cd='".$t->work_cd."' and item_cd='".$t->item_cd."' and standard='".$t->standard."'";
			$tt = mysql_fetch_object(mysql_query($sql));

			$pass = $tt->order_cnt-$tt->cnt;

			array_push($data, array('검사품목'=>$t->item_nm, '검사수량'=>$tt->order_cnt, '적격'=>$pass, '부적격'=>$tt->cnt));
		}

		$json = json_encode(array("item"=>$data));
		echo $json;
	break;

	case "witem_list" : // 창고별재고현황 리스트
		$sql = "select item_cd,standard,sum(remain_cnt) as remain_cnt from erp_stock_inout group by warehouse_cd,item_cd,standard order by uid desc  limit $idx, $cnt";
		$result = mysql_query($sql);

		while($t = mysql_fetch_object($result)) {
			$sql = "select * from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
			$tt = mysql_fetch_object(mysql_query($sql));

			$sql = "select item_nm, barcode from erp_item where item_cd='".$t->item_cd."' and standard='".$t->standard."'";
			$item = mysql_fetch_object(mysql_query($sql));

			array_push($data, array('창고'=>$tt->warehouse_nm, '품목명'=>$item->item_nm, '규격'=>$t->standard, '재고수량'=>$t->remain_cnt));
			array_push($data, array('창고'=>$tt->warehouse_nm, '품목명'=>$item->item_nm, '바코드'=>$item->barcode, '규격'=>$t->standard, '재고수량'=>$t->remain_cnt));
		}

		$json = json_encode(array("item"=>$data));
		echo $json;
	break;

	
	case "eack_list" :
	
		array_push($data, 
			array(
				'기안서명'=>'재고 부족분 구매요청건',
				'결재상태'=>'진행중',
				'기안자'=>'김성태',
				'등록일'=>'2017-12-13'		
			)
		);

		$json = json_encode(array("item"=>$data));
		echo $json;
	break;
	// 규격 : erp_standard
	
	// 
	
	case "getiteminfo" :
		// 바코드가 넘어옴
		$sql = "select * from erp_item where barcode='".$_POST['barcode']."'";
		$t = mysql_fetch_object(mysql_query($sql));
		$data = array();
		array_push($data, array('품목코드'=>$t->item_cd, '품목명'=>$t->item_nm, '규격'=>$t->standard));
		$json = json_encode(array("item"=>$data));
		echo $json;
	break;
	
	case "getitemqty" :
		// erp_stock 전체 재고
		
		$sql = "select item_cd,standard,sum(remain_cnt) as remain_cnt from erp_stock_inout where itemcd='" . $_POST['itemcd'] . "' and warehouse_cd='" . $_POST['whcd'] . "' group by warehouse_cd,item_cd,standard order by uid desc ";
		$result = mysql_query($sql);

		while($t = mysql_fetch_object($result)) {
			$sql = "select * from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
			$tt = mysql_fetch_object(mysql_query($sql));

			$sql = "select item_nm from erp_item where item_cd='".$t->item_cd."' and standard='".$t->standard."'";
			$item = mysql_fetch_object(mysql_query($sql));


			array_push($data, array('창고'=>$tt->warehouse_nm, '품목코드'=>$item->item_cd, '품목명'=>$item->item_nm, '규격'=>$t->standard, '재고수량'=>$t->remain_cnt));
		}

		$json = json_encode(array("item"=>$data));
		echo $json;
	break;

	// case "gettypelist" :
		// 바코드가 넘어옴
		// $sql = "select * from erp_item";
		// $t = mysql_fetch_object(mysql_query($sql));
		// $data = array();
		// array_push($data, array('규격'=>$t->item_cd, '규격코드'=>$t->standardt));
		// $json = json_encode(array("item"=>$data));
		// echo $json;
	// break;

	case "getwhlist" :
		$sql = "select * from erp_warehouse";
		$t = mysql_fetch_object(mysql_query($sql));
		$data = array();
		array_push($data, array('창고'=>$t->warehouse_nm, '창고코드'=>$t->warehouse_cd));
		$json = json_encode(array("item"=>$data));
		echo $json;
	break;
	
	case "itemin" :
		// 품목정보 가져오기
	// wh_cd = 창고
	// estimate_cd = 구매요청서 번호
	// cnt = 수량
		$sql = "select * from erp_item where barcode='".$_POST['barcode']."'";
		$item = mysql_fetch_object(mysql_query($sql));
		$sql = "
			
		";
	break;
	
	case "itemout" :
		// work_cd 작업 지시서 번호
	break;
	
}
?>