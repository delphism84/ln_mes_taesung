<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

function getWarehouseNm($warehouse_cd) {
	$sql = "select warehouse_nm from erp_warehouse where warehouse_cd='".$warehouse_cd."'";
	$t = mysql_fetch_object(mysql_query($sql));
	return $t->warehouse_nm;
}

switch($mode) {
	// 구매요청코드 생성
	case "createPurchaseCode" :
		echo "PUR-".time();
	break;

		// 발주서코드 생성
	case "createPurchaseOrderCode" :
		echo "PO-".time();
	break;
	
	// 구매요청리스트 
	case "getPurchaseDemand" :

		$where = " where 1=1";
		
		if($search_txt != "") {
			$where .= " and (purchase_cd like '%".$search_txt."%' or emp_id like '%".$search_txt."%')";
		}

		if($start_dt != "" && $end_dt != "") {
			$where .= " AND ( left(purchase_dt,10) between '".$start_dt."' and '".$end_dt."')";
		}

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_purchase_demand".$where." order by uid desc";
		else $query = "select * from erp_purchase_demand".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		
		$total_num = mysql_num_rows($result);

		$i = 0;
		$ct = 1;

		while($t = mysql_fetch_object($result)) {
			$query = "select * from erp_purchase_demand_item where fid=".$t->uid." order by uid";
			//echo $query;
			$result2 = mysql_query($query);
			$cnt = mysql_num_rows($result2);
			$sum = 0;
			//$cnt = "0";
			while($t2 = mysql_fetch_object($result2)) {
				$sum = $sum + $t2->total_price;
			//$cnt++
				$item_nm = $t2->item_nm;	
			}
			if ($cnt > "1"){
				$cnt_text = " 외 ".($cnt-1)."건";
			}else{
				$cnt_text ="";
			}
			

			$query = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
			$warehouse = mysql_fetch_object(mysql_query($query));

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['purchase_cd'] = $t->purchase_cd;
			$re[$i]['purchase_dt'] = substr($t->purchase_dt,0,10);
			$re[$i]['purchase_cha'] = $t->purchase_cha;
			$re[$i]['purchase_expect_dt'] = substr($t->purchase_expect_dt,0,10);
			$re[$i]['workplan_uid'] = $t->workplan_uid;
			$re[$i]['workplan_cd'] = $t->workplan_cd;
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['warehouse_nm'] = $warehouse->warehouse_nm;
			$re[$i]['memo'] = $t->memo;
			$re[$i]['attach'] = $t->attach;
			$re[$i]['used'] = $t->used;
			
			if($t->state=="0"){
			$state="구매요청";	
			}else if($t->state=="1"){
			$state="발주중";	
			}else if($t->state=="2"){
			$state="발주완료";	
			}else if($t->state=="3"){
			$state="구매완료";	
			}else if($t->state=="4"){
			$state="입고완료";	
			}else if($t->state=="5"){
			$state="구매취소";	
			}else if($t->state=="0"){
			$state="구매요청";	
			}
			$re[$i]['state'] = $state;
			$re[$i]['cnt'] = $cnt;
			$re[$i]['cnt_text'] = $cnt_text;
			$re[$i]['total_price'] = number_format($sum);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['item_nm'] = $item_nm;
			
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;


	case "getPurchaseDemandItem" :
		$query = "select * from erp_purchase_demand_item where fid=".$uid;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		
		while($t = @mysql_fetch_object($result)) {
			
			// 구매요청서 수정 등록시 재고수량 다시 계산
			$sql2 = "select remain_cnt from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'";
			$stock = @mysql_fetch_object(mysql_query($sql2));
			
			//$total_cnt = $t->cnt * $t3->cnt;
			$total_cnt = $t->cnt ;

			// 부족재고수량
			//$bcnt = $total_cnt - $stock->remain_cnt;
			if ($stock->remain_cnt >= $total_cnt){
					$bcnt = "0";
			}else{
					$bcnt =  $total_cnt - $stock->remain_cnt;
			}

			//공급가액 계산
			//$supply_price = $total_cnt * $t3->unit_price;
			$supply_price = $total_cnt * $t->unit_price;

			$tax = $supply_price / 10; 
			
			$total_price = $supply_price + $tax;

			if($total_cnt <= 0) $bcnt = $stock->remain_cnt;
			
			
			$re[$i]['uid'] = $t->uid;
			$re[$i]['fid'] = $t->fid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = number_format($t->cnt);
			$re[$i]['remain_cnt'] = number_format($stock->remain_cnt);
			$re[$i]['shortage_cnt'] = number_format($bcnt);
			$re[$i]['unit_price'] = number_format($t->unit_price);
			$re[$i]['supply_price'] = number_format($t->total_price - $t->tax);
			$re[$i]['tax'] = number_format($t->tax);
			$re[$i]['total_price'] = number_format($t->total_price);
			$i++;
		}

		echo $json->encode($re);
	break;
	
	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	//발주서
	case "deleteSelectPurchaseOrder" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_purchase_order where uid=".$array_uid[$i];
			mysql_query($query);
			$query = "delete from erp_purchase_order_item where fid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
	//구매입고
	case "deleteSelectWarehousing" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_warehousing where uid=".$array_uid[$i];
			mysql_query($query);
			$query = "delete from erp_warehousing_item where fid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "pavableComplete" :
		$sql = "update erp_purchase set pavable='n', pavable_price=0 where uid=".$uid;
		$result = query($sql);
		if($result) echo "success";
	break;

	case "getPavable" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_purchase".$where." order by uid desc";
		else $query = "select * from erp_purchase".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$sql = "select * from erp_account where account_cd='".$t->account_cd."'";
			$account = fetch_object($sql);

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['owner'] = $account->owner;
			$re[$i]['corp_phone'] = $account->corp_phone;
			$re[$i]['pavable_price'] = number_format($t->pavable_price);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectPurchaseDemand" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_purchase_demand where uid=".$array_uid[$i];
			mysql_query($query);

			$query = "delete from erp_purchase_demand_item where fid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectWarehouse" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_warehouse where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "getPurchase" :
		$query = "select * from erp_purchase_demand where used='n' order by uid desc";
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$query = "select * from erp_purchase_demand_item where fid=".$t->uid;
			$result2 = mysql_query($query);
			$sum = 0;
			while($t2 = mysql_fetch_object($result2)) {
				$sum = $sum + $t2->total_price;
			}
			
			$re[$i]['purchase_cd'] = $t->purchase_cd;
			$re[$i]['total_price'] = number_format($sum);
			$i++;
		}

		echo $json->encode($re);
	break;

	case "getItemPurchase" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_purchase".$where." order by uid desc";
		else $query = "select * from erp_purchase".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['purchase_cd'] = $t->purchase_cd;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['pur_unit_price'] = number_format($t->pur_unit_price);
			$re[$i]['total_price'] = number_format($t->total_price);
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$re[$i]['state'] = $t->state;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getItemPurchaseOrder" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_purchase".$where." order by uid desc";
		else $query = "select * from erp_purchase".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['purchase_cd'] = $t->purchase_cd;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['pur_unit_price'] = number_format($t->pur_unit_price);
			$re[$i]['total_price'] = number_format($t->total_price);
			$re[$i]['remain_cnt'] = $t->remain_cnt;
			$re[$i]['state'] = $t->state;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;


	

	case "allIn" : // 전량입고처리
		$now = date("Y-m-d h:i:s");
		$sql = "select * from erp_purchase where uid=". $uid;
		$t = mysql_fetch_object(mysql_query($sql));
		
		$sql = "update erp_purchase set remain_cnt=0, state='complete' where uid=". $uid;
		mysql_query($sql);
		
		// 재고상테를 업데이트
		$sql = "select * from erp_stock where item_cd='" . $t->item_cd ."' and standard1='".$t->standard1."' and standard2='".$t->standard2."' and standard3='".$t->standard3."'";
		$item = @mysql_fetch_object(mysql_query($sql));
		
		if(isset($item->uid)) { // 해당창고에 해당 품목이 있다면
			$remain_cnt = $t->cnt + $item->remain_cnt;
			$sql = "update erp_stock set remain_cnt=". $remain_cnt ." where uid=". $item->uid;
		} 

		mysql_query($sql);
		
		$lot_no = time();

		$sql = "
			insert into erp_stock_inout (
				purchase_cd,
				order_cd,
				work_cd,
				project_cd,
				account_cd,
				warehouse_cd,
				item_cd,
				standard1,
				standard2,
				standard3,
				unit,
				in_cnt,
				out_cnt,
				remain_cnt,
				pur_unit_price,
				total_price,
				used,
				lot_no,
				emp_id,
				create_dt
			) values (
				'$t->purchase_cd',
				'$t->order_cd',
				'',
				'$t->project_cd',
				'$t->account_cd',
				'$t->warehouse_cd',
				'$t->item_cd',
				'$t->standard1',
				'$t->standard2',
				'$t->standard3',
				'$t->unit',
				$t->cnt,
				0,
				$t->cnt,
				$t->pur_unit_price,
				$t->total_price,
				'n',
				'$lot_no',
				'$_SESSION[login_id]',
				'$now'
			)
		";

		$result = mysql_query($sql);

		$fid = mysql_insert_id();

		$sql = "
			insert into erp_reason (
				fid,
				item_cd,
				standard1,
				standard2,
				standard3,
				unit,
				in_cnt,
				out_cnt,
				reason,
				emp_id,
				create_dt
			) values (
				$fid,
				'$t->item_cd',
				'$t->standard1',
				'$t->standard2',
				'$t->standard3',
				'$t->unit',
				$t->cnt,
				0,
				'구매입고',
				'$_SESSION[login_id]',
				'$now'
			)
		";
		
		$result = mysql_query($sql);

		if($result) echo "success";

	break;

	case "registBarcodeIn" : // 바코드 입고처리
		$now = date("Y-m-d h:i:s");
		$cnt = 1;
		$sql = "select * from erp_item where barcode='".$barcode."'";
		//echo $sql;
		$item = @mysql_fetch_object(mysql_query($sql));

		// 구매요청에 포함된 품목인지 
		$sql = "select * from erp_purchase where item_cd='".$item->item_cd."' and standard1='".$item->standard1."'  and remain_cnt<>0";
		$purchase = @mysql_fetch_object(mysql_query($sql));

		if(isset($purchase->uid)) {
			// 재고상테를 업데이트
			$sql = "select * from erp_stock where item_cd='" . $item->item_cd ."' and standard1='".$item->standard1."' ";
			//echo $sql;
			$stock = @mysql_fetch_object(mysql_query($sql));
		
			if(isset($stock->uid)) { // 해당 품목이 있다면
				$remain_cnt = $stock->remain_cnt + $cnt;
				$sql = "update erp_stock set remain_cnt=". $remain_cnt ." where uid=". $item->uid;
			} else { // 해당 품목이 없다면

			}

			$result = mysql_query($sql);
		

			$lot_no = time();

			$sql = "
				insert into erp_stock_inout (
					purchase_cd,
					order_cd,
					work_cd,
					project_cd,
					account_cd,
					warehouse_cd,
					item_cd,
					standard1,
					standard2,
					standard3,
					unit,
					in_cnt,
					out_cnt,
					remain_cnt,
					pur_unit_price,
					total_price,
					used,
					lot_no,
					emp_id,
					create_dt
				) values (
					'$purchase->purchase_cd',
					'$purchase->order_cd',
					'',
					'$purchase->project_cd',
					'$purchase->account_cd',
					'$purchase->warehouse_cd',
					'$purchase->item_cd',
					'$purchase->standard1',
					'$purchase->standard2',
					'$purchase->standard3',
					'$purchase->unit',
					$cnt,
					0,
					$cnt,
					$purchase->pur_unit_price,
					$purchase->total_price,
					'n',
					'$lot_no',
					'$_SESSION[login_id]',
					'$now'
				)
			";

			$result = mysql_query($sql);

			$fid = mysql_insert_id();

			$sql = "
				insert into erp_reason (
					fid,
					item_cd,
					standard1,
					standard2,
					standard3,
					unit,
					in_cnt,
					out_cnt,
					reason,
					emp_id,
					create_dt
				) values (
					$fid,
					'$purchase->item_cd',
					'$purchase->standard1',
					'$purchase->standard2',
					'$purchase->standard3',
					'$purchase->unit',
					$cnt,
					0,
					'구매입고',
					'$_SESSION[login_id]',
					'$now'
				)
			";
			
			$result = mysql_query($sql);

			//$re[$i]['purchase_cd'] = $t->purchase_cd;
			//$re[$i]['order_cd'] = $t->order_cd;
			//$re[$i]['project_cd'] = $t->project_cd;
			//$re[$i]['project_nm'] = $t->project_nm;
			//$re[$i]['account_cd'] = $t->account_cd;
			//$re[$i]['account_nm'] = $t->account_nm;
			$re['warehouse_cd'] = $purchase->warehouse_cd;
			$re['item_cd'] = $purchase->item_cd;
			$re['item_nm'] = $purchase->item_nm;
			$re['standard1'] = $purchase->standard1;
			$re['standard2'] = $purchase->standard2;
			$re['standard3'] = $purchase->standard3;
			$re['unit'] = $purchase->unit;
			$re['cnt'] = $cnt;
			echo $json->encode($re);
		} else {
			// 재고상테를 업데이트
			$sql = "select * from erp_stock where item_cd='" . $item->item_cd ."' and standard1='".$item->standard1."' ";
			//echo $sql;
			$stock = @mysql_fetch_object(mysql_query($sql));
		
			if(isset($stock->uid)) { // 해당 품목이 있다면
				$remain_cnt = $stock->remain_cnt + $cnt;
				$sql = "update erp_stock set remain_cnt=". $remain_cnt ." where uid=". $stock->uid;
			}

			$result = mysql_query($sql);
		

			$lot_no = time();
			
			$total_price = $cnt * $item->pur_unit_price;

			$sql = "
				insert into erp_stock_inout (
					purchase_cd,
					order_cd,
					work_cd,
					project_cd,
					account_cd,
					warehouse_cd,
					item_cd,
					standard1,
					standard2,
					standard3,
					unit,
					in_cnt,
					out_cnt,
					remain_cnt,
					pur_unit_price,
					total_price,
					used,
					lot_no,
					emp_id,
					create_dt
				) values (
					'',
					'',
					'',
					'',
					'',
					'$item->warehouse_cd',
					'$item->item_cd',
					'$item->standard1',
					'$item->standard2',
					'$item->standard3',
					'$item->unit',
					$cnt,
					0,
					$cnt,
					$item->pur_unit_price,
					$total_price,
					'n',
					'$lot_no',
					'$_SESSION[login_id]',
					'$now'
				)
			";
			$result = mysql_query($sql);
			$fid = mysql_insert_id();

			$sql = "
				insert into erp_reason (
					fid,
					item_cd,
					standard1,
					standard2,
					standard3,
					unit,
					in_cnt,
					out_cnt,
					reason,
					emp_id,
					create_dt
				) values (
					$fid,
					'$item->item_cd',
					'$item->standard1',
					'$item->standard2',
					'$item->standard3',
					'$item->unit',
					$cnt,
					0,
					'구매입고',
					'$_SESSION[login_id]',
					'$now'
				)
			";
			
			$result = mysql_query($sql);

			//$re[$i]['purchase_cd'] = $t->purchase_cd;
			//$re[$i]['order_cd'] = $t->order_cd;
			//$re[$i]['project_cd'] = $t->project_cd;
			//$re[$i]['project_nm'] = $t->project_nm;
			//$re[$i]['account_cd'] = $t->account_cd;
			//$re[$i]['account_nm'] = $t->account_nm;
			$re['warehouse_cd'] = $item->warehouse_cd;
			$re['warehouse_nm'] = $item->warehouse_nm;
			$re['item_cd'] = $item->item_cd;
			$re['item_nm'] = $item->item_nm;
			$re['standard1'] = $item->standard1;
			$re['standard2'] = $item->standard2;
			$re['standard3'] = $item->standard3;
			$re['unit'] = $item->unit;
			$re['cnt'] = $cnt;

			echo $json->encode($re);
		}
	break;

	// 발주서 리스트 NEW 
	case "getPurchaseOrder" :
		$where = " where 1=1";
		
		if($search_txt != "") {
			$where .= " and (p_order_cd like '%".$search_txt."%' or manager like '%".$search_txt."%')";
		}

		if($start_dt != "" && $end_dt != "") {
			$where .= " AND ( left(p_order_dt,10) between '".$start_dt."' and '".$end_dt."')";
		}

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_purchase_order".$where." order by uid desc";
		else $query = "select * from erp_purchase_order".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$query = "select * from erp_purchase_order_item where fid=".$t->uid;
			$result2 = mysql_query($query);
			$sum = 0;
			
			$ct2=0;
			while($t2 = mysql_fetch_object($result2)) {
				$sum = $sum + $t2->total_price;
				$item_nm = $t2->item_nm;
			$ct2++;	
			}
			if ($ct20 > 0){
				$item_nm_text = $item_nm ."외 ". $ct2."건";
			}else{
				$item_nm_text = $item_nm;	
			}

			$query = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
			$warehouse = mysql_fetch_object(mysql_query($query));

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['p_order_cd'] = $t->p_order_cd;
			$re[$i]['purchase_cd'] = substr($t->purchase_cd,0,10);
			$re[$i]['item_nm']		= $item_nm_text;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['warehouse_nm'] = $warehouse->warehouse_nm;
			$re[$i]['manager'] = $t->manager;
			$re[$i]['deadline_dt'] = $t->deadline_dt;
			$re[$i]['tax_type'] = $t->tax_type;
			$re[$i]['memo'] = $t->memo;
			$re[$i]['attach'] = $t->attach;
			if($t->state=="0"){
			$state="구매요청";	
			}else if($t->state=="1"){
			$state="발주중";	
			}else if($t->state=="2"){
			$state="발주완료";	
			}else if($t->state=="3"){
			$state="발주취소";	
			}else if($t->state=="4"){
			$state="구매완료";	
			}else if($t->state=="5"){
			$state="입고완료";	
			}else if($t->state=="6"){
			$state="구매취소";	
			}else if($t->state=="7"){
			$state="종결";	
			}else if($t->state=="0"){
			$state="구매요청";	
			}
			$re[$i]['state'] = $t->state;
			$re[$i]['state_val'] = $state;
			$re[$i]['cnt'] = mysql_num_rows($result2);
			$re[$i]['total_price'] = number_format($sum);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	// 발주서 리스트 ITEM NEW
	case "getPurchaseOrderItem" :
		$query = "select * from erp_purchase_order_item where fid=".$uid;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {

			// 발주서 등록시 재고수량 다시 계산
			$sql2 = "select remain_cnt from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'";
			$stock = @mysql_fetch_object(mysql_query($sql2));
			
			//$total_cnt = $t->cnt * $t3->cnt;
			$total_cnt = $t->cnt ;

			// 부족재고수량
			//$bcnt = $total_cnt - $stock->remain_cnt;
			// 부족재고수량
			if ($stock->remain_cnt >= $total_cnt){
				$bcnt = "0";
			}else{
				$bcnt =  $total_cnt - $stock->remain_cnt;
			}	

			//공급가액 계산
			//$supply_price = $total_cnt * $t3->unit_price;
			$supply_price = $total_cnt * $t->unit_price;

			$tax = $supply_price / 10; 
			
			$total_price = $supply_price + $tax;

			if($total_cnt <= 0) $bcnt = $stock->remain_cnt;

			$re[$i]['uid'] = $t->uid;
			$re[$i]['fid'] = $t->fid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = number_format($t->cnt);
			$re[$i]['unit_price'] = number_format($t->unit_price);
			$re[$i]['supply_price'] = number_format($t->total_price - $t->tax);
			$re[$i]['remain_cnt'] = number_format($stock->remain_cnt);
			$re[$i]['shortage_cnt'] = number_format($bcnt);
			$re[$i]['tax'] = number_format($t->tax);
			$re[$i]['total_price'] = number_format($t->total_price);
			$i++;
		}

		echo $json->encode($re);
	break;
	
	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectPurchase" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_purchase where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
	
	// 생산계획 가져오기
	case "getWorkPlanItem" :
		$query = "select * from erp_workplan_item where wid='".$wid."'";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = number_format($t->cnt);
			$i++;
		}
		echo $json->encode($re);
	break;


	// 생산 계획 구매요청서 BOM 재고 수량
	case "getWorkPlanItemBom" :
		//$query = "select * from erp_order_item where order_cd='".$order_cd."'";
		$query = "select * from erp_workplan_item where wid='".$wid."'";
		//echo "erp_workplan_item==>".$query."<BR>";
		$result = @mysql_query($query);
		$i = 0;
		while($t = @mysql_fetch_object($result)) {
			$sql = "select uid, pur_unit_price, unit_price from erp_item where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'";
			//echo "erp_item=>".$sql."<BR><BR>";
			$t1 = @mysql_fetch_object(@mysql_query($sql));

			$sql1 = "select * from erp_bom where fid=".$t1->uid." order by uid desc";
			//echo "erp_bom=>".$sql1."<BR><BR>"; 
			$result2 = @mysql_query($sql1);	
			
			
			while($t2 = @mysql_fetch_object($result2)) {
				
				// 해당 품목의 현재고수량
				$sql2 = "select remain_cnt from erp_stock where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."'";
				//echo $sql."<BR><BR>"; 
				$stock = @mysql_fetch_object(@mysql_query($sql2));
				
				$total_cnt = $t->cnt * $t2->cnt;
				
				//bom 원자재 단가 구하기
				$sql3 = "select unit_price from erp_item where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."'";
				$t3 = @mysql_fetch_object(@mysql_query($sql3));

				// 부족재고수량
				//$bcnt = $total_cnt - $stock->remain_cnt;
				if ($stock->remain_cnt >= $total_cnt){
					$bcnt = "0";
				}else{
					$bcnt =  $total_cnt - $stock->remain_cnt;
				}
				//공급가액 계산
				$supply_price = $total_cnt * $t3->unit_price;
				$tax = $supply_price / 10; 
				
				$total_price = $supply_price + $tax;

				//if($bcnt < 0) $bcnt = 0;
				if($total_cnt <= 0) $bcnt = $stock->remain_cnt;

				$re[$i]['item_cd'] = $t2->item_cd;
				$re[$i]['item_nm'] = $t2->item_nm;
				$re[$i]['account_cd'] = $t->account_cd;
				$re[$i]['account_nm'] = $t->account_nm;
				$re[$i]['standard1'] = $t2->standard1;
				$re[$i]['unit'] = $t2->unit;
				$re[$i]['cnt'] = number_format(@$total_cnt);
				$re[$i]['remain_cnt'] = number_format(@$stock->remain_cnt);
				$re[$i]['shortage_cnt'] = number_format(@$bcnt);
				$re[$i]['unit_price'] = number_format(@$t3->unit_price);
				$re[$i]['supply_price'] = number_format(@$supply_price);
				$re[$i]['tax'] = number_format(@$tax);
				$re[$i]['total_price'] = number_format(@$total_price);
				$i++;
			}
		}

		echo $json->encode($re);
	break;

	case "getPurchaseDemandPop" :

		$in_str = $uid;

			$query = "select * from erp_purchase_demand A right join erp_purchase_demand_item B on A.uid=B.fid where B.uid IN('".$in_str."') order by B.uid desc";
			//echo $query."<BR>"; 
			$result = mysql_query($query);



		$i = 0;
		
		while($t = @mysql_fetch_object($result)) {

			$sql = "select * from erp_purchase_demand where uid ='".$t->fid."'";
			//echo $sql;
			$t1 = @mysql_fetch_object(mysql_query($sql));
			
			// 발주서 등록시 재고수량 다시 계산
			$sql2 = "select remain_cnt from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'";
			$stock = @mysql_fetch_object(mysql_query($sql2));
			
			//$total_cnt = $t->cnt * $t3->cnt;

			$total_cnt = $t->cnt;

			// 부족재고수량
			//$bcnt = $total_cnt - $stock->remain_cnt;
			if ($stock->remain_cnt >= $total_cnt){
				$bcnt = "0";
			}else{
				$bcnt =  $total_cnt - $stock->remain_cnt;
			}

			//공급가액 계산
			$supply_price = $total_cnt * $t->unit_price;
			$tax = $supply_price / 10; 
			
			$total_price = $supply_price + $tax;

			if($bcnt < 0) $bcnt = 0;

			$re[$i]['iuid'] = $t->uid;
			
			$re[$i]['uid'] = $t1->uid;
			$re[$i]['purchase_cd'] = $t1->purchase_cd;

			$re[$i]['manager'] = $t1->emp_id;
			$re[$i]['project_cd'] = $t1->project_cd;
			$re[$i]['project_nm'] = $t1->project_nm;
			$re[$i]['warehouse_cd'] = $t1->warehouse_cd;
			$re[$i]['deadline_dt'] = $t1->purchase_expect_dt;
			$re[$i]['tax_type'] = $t1->tax_type;
			$re[$i]['memo'] = $t1->memo;


			$re[$i]['fid'] = $t->fid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = number_format($t->cnt);
			$re[$i]['remain_cnt'] = number_format($stock->remain_cnt);
			$re[$i]['shortage_cnt'] = number_format($bcnt);
			$re[$i]['unit_price'] = number_format($t->unit_price);
			$re[$i]['supply_price'] = number_format($t->supply_price);
			$re[$i]['tax'] = number_format($t->tax);
			$re[$i]['total_price'] = number_format($t->total_price);
			$i++;
		
		}

		echo $json->encode($re);
	break;


	case "getPurchaseDemandItemPop" :

		$uid = substr($uid, 0, -1);
		$uid_arr = explode(",",$uid);
		$uid = str_replace(",","','",$uid);
		$in_str = $uid;

			$query = "select * from erp_purchase_demand A right join erp_purchase_demand_item B on A.uid=B.fid where B.uid IN('".$in_str."') order by B.uid desc";
			//echo $query."<BR>"; 
			$result = mysql_query($query);



		$i = 0;
		
		while($t = @mysql_fetch_object($result)) {

			$sql = "select * from erp_purchase_demand where uid ='".$t->fid."'";
			//echo $sql;
			$t1 = @mysql_fetch_object(mysql_query($sql));
			
			// 발주서 등록시 재고수량 다시 계산
			$sql2 = "select remain_cnt from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'";
			$stock = @mysql_fetch_object(mysql_query($sql2));
			
			//$total_cnt = $t->cnt * $t3->cnt;

			$total_cnt = $t->cnt;

			// 부족재고수량
			//$bcnt = $total_cnt - $stock->remain_cnt;

			if ($stock->remain_cnt >= $total_cnt){
				$bcnt = "0";
			}else{
				$bcnt =  $total_cnt - $stock->remain_cnt;
			}
			//공급가액 계산
			$supply_price = $total_cnt * $t->unit_price;
			$tax = $supply_price / 10; 
			
			$total_price = $supply_price + $tax;

			if($bcnt < 0) $bcnt = 0;

			$re[$i]['iuid'] = $t->uid;
			
			$re[$i]['uid'] = $t1->uid;
			$re[$i]['purchase_cd'] = $t1->purchase_cd;

			$re[$i]['manager'] = $t1->emp_id;
			$re[$i]['project_cd'] = $t1->project_cd;
			$re[$i]['project_nm'] = $t1->project_nm;
			$re[$i]['warehouse_cd'] = $t1->warehouse_cd;
			$re[$i]['deadline_dt'] = $t1->purchase_expect_dt;
			$re[$i]['tax_type'] = $t1->tax_type;
			$re[$i]['memo'] = $t1->memo;


			$re[$i]['fid'] = $t->fid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = number_format($t->cnt);
			$re[$i]['remain_cnt'] = number_format($stock->remain_cnt);
			$re[$i]['shortage_cnt'] = number_format($bcnt);
			$re[$i]['unit_price'] = number_format($t->unit_price);
			$re[$i]['supply_price'] = number_format($t->supply_price);
			$re[$i]['tax'] = number_format($t->tax);
			$re[$i]['total_price'] = number_format($t->total_price);
			$i++;
		
		}

		echo $json->encode($re);
	break;

	// 발주서 가져오기
	case "getPurchaseOrderItems" :
		$query = "select * from erp_workplan_item where wid='".$wid."'";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = number_format($t->cnt);
			$i++;
		}
		echo $json->encode($re);
	break;


	// 발주서 아이템 가져오기
	case "getPurchaseOrderItems" :
		//$query = "select * from erp_order_item where order_cd='".$order_cd."'";
		$query = "select * from erp_workplan_item where wid='".$wid."'";
		//echo $query;
		$result = mysql_query($query);

		while($t = @mysql_fetch_object($result)) {
			$sql = "select uid, pur_unit_price, unit_price from erp_item where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'";
			$t1 = @mysql_fetch_object(mysql_query($sql));

			$sql1 = "select * from erp_bom where fid=".$t1->uid." order by uid desc";
			//echo $sql."<BR><BR>"; 
			$result2 = @mysql_query($sql1);	
			$i = 0;
			while($t2 = mysql_fetch_object($result2)) {
				// 해당 품목의 현재고수량
				$sql2 = "select remain_cnt from erp_stock where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."'";
				//echo $sql."<BR><BR>"; 
				$stock = @mysql_fetch_object(mysql_query($sql2));
				
				$total_cnt = $t->cnt * $t2->cnt;

				// 부족재고수량
				//$bcnt = $total_cnt - $stock->remain_cnt;
				if ($stock->remain_cnt >= $total_cnt){
					$bcnt = "0";
				}else{
					$bcnt =  $total_cnt - $stock->remain_cnt;
				}

				//공급가액 계산
				$supply_price = $total_cnt * $t1->unit_price;
				$tax = $supply_price / 10; 
				
				$total_price = $supply_price + $tax;

				if($bcnt < 0) $bcnt = 0;

				$re[$i]['item_cd'] = $t2->item_cd;
				$re[$i]['item_nm'] = $t2->item_nm;
				$re[$i]['account_cd'] = $t->account_cd;
				$re[$i]['account_nm'] = $t->account_nm;
				$re[$i]['standard1'] = $t2->standard1;
				$re[$i]['unit'] = $t2->unit;
				$re[$i]['cnt'] = number_format($total_cnt);
				$re[$i]['remain_cnt'] = number_format($stock->remain_cnt);
				$re[$i]['shortage_cnt'] = number_format($bcnt);
				$re[$i]['unit_price'] = number_format($t1->unit_price);
				$re[$i]['supply_price'] = number_format($supply_price);
				$re[$i]['tax'] = number_format($tax);
				$re[$i]['total_price'] = number_format($total_price);
				$i++;
			}
		}

		echo $json->encode($re);
	break;
	
	// 구매입고 리스트 NEW
	case "getWarehousing" :

		$where = " where 1=1";
		
		if($search_txt != "") {
			$where .= " and (warehousing_cd like '%".$search_txt."%' or emp_id like '%".$search_txt."%')";
		}

		if($start_dt != "" && $end_dt != "") {
			$where .= " AND ( left(warehousing_dt,10) between '".$start_dt."' and '".$end_dt."')";
		}

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_warehousing".$where." order by uid desc";
		else $query = "select * from erp_warehousing".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		
		$total_num = mysql_num_rows($result);

		$i = 0;
		$ct = 1;
		$cnt=="";
		while($t = mysql_fetch_object($result)) {
			$query = "select * from erp_warehousing_item where fid=".$t->uid." order by uid";
			//echo $query;
			$result2 = mysql_query($query);
			$item_cnt = mysql_num_rows($result2);
			$sum = 0;
			//$cnt = "0";
			$cnt_total = "0";
			$warehousing_total= "0";
			$rest_cnt_total= "0";
			while($t2 = mysql_fetch_object($result2)) {
				$sum				= $sum + $t2->total_price;
			//$cnt++
				$item_cd			= $t2->item_cd;
				$item_nm			= $t2->item_nm;
				$standard1			= $t2->standard1;
				$lot_no_cd			= str_replace("_","-",$t2->lot_no_cd);
				$cnt				= $t2->cnt;
				$shortage_cnt		= $t2->shortage_cnt;
				$inspection_cd		= $t2->inspection_cd;
				$warehousing_cnt	= $t2->warehousing_cnt; //구매입고수량
				//$warehousing_total	= $warehousing_total+$warehousing_cnt;
				$warehousing_total	= $warehousing_total+$warehousing_cnt;
				$rest_cnt			= $t2->rest_cnt; //잔여수량
				$rest_cnt_total		= $rest_cnt_total+$rest_cnt;
				$rest_total			= $rest_total+$rest_cnt;
			}
			if ($item_cnt > "1"){
				$cnt_text = " 외 ".($item_cnt-1)."건";
			}else{
				$cnt_text ="";
			}
			if ($rest_cnt > "1"){
				$rest_total = $rest_cnt;
			}else{
				$rest_total = $t->cntTotal - $warehousing_total;
			}

			$query = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
			$warehouse = mysql_fetch_object(mysql_query($query));
			

			$query = "select faulty_cnt, faulty_content from erp_receiving_inspection where inspection_cd='".$inspection_cd."'"; //구매입고 수입검사 테이블
			//echo $query;
			$t3 = mysql_fetch_object(mysql_query($query));

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['warehousing_cd'] = $t->warehousing_cd;
			$re[$i]['warehousing_dt'] = substr($t->warehousing_dt,0,10);
			$re[$i]['p_order_cd'] = $t->p_order_cd;
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			//$re[$i]['warehouse_nm'] = $warehouse->warehouse_nm;
			$re[$i]['deadline_dt'] = substr($t->deadline_dt,0,10);
			$re[$i]['manager'] = $t->manager;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['memo'] = $t->memo;
			$re[$i]['cntTotal'] = number_format($t->cntTotal);
			$re[$i]['unitPriceTotal'] = number_format($t->unitPriceTotal);
			$re[$i]['supplyPriceTotal'] = number_format($t->supplyPriceTotal);
			$re[$i]['taxTotal'] = number_format($t->taxTotal);
			$re[$i]['priceTotal'] = number_format($t->priceTotal);
			if($t->state=="0"){
				$state="대기중";	
			}else if($t->state=="1"){
				$state="입고중";	
			}else if($t->state=="2"){
				$state="입고완료";	
			}else if($t->state=="3"){
				$state="입고취소";	
			}else{ 
				$state="대기중";
			}
			$re[$i]['state'] = $state;
			$re[$i]['cnt'] = $cnt;
			$re[$i]['cnt_text'] = $cnt_text;
			$re[$i]['total_price'] = number_format($sum);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['item_nm'] = $item_nm;
			$re[$i]['item_cd'] = $item_cd;
			$re[$i]['standard1'] = $standard1;
			$re[$i]['lot_no_cd'] = $lot_no_cd;
			$re[$i]['shortage_cnt'] = $shortage_cnt;
			$re[$i]['faulty_cnt'] = $t3->faulty_cnt;
			$re[$i]['faulty_content'] = $t3->faulty_content;
			$re[$i]['warehousing_total'] = number_format($warehousing_total); //총구매입고수량
			$re[$i]['rest_total'] = number_format($rest_cnt_total); //총잔여수량

			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
	
	// 발주서 리스트 ITEM NEW
	case "getWarehousingItem" :
		$query = "select * from erp_warehousing_item where fid=".$uid;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {

			// 발주서 등록시 재고수량 다시 계산
			$sql2 = "select remain_cnt from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'";
			$stock = @mysql_fetch_object(@mysql_query($sql2));
			
			//$total_cnt = $t->cnt * $t3->cnt;
			$total_cnt = $t->cnt ;

			// 부족재고수량
			//$bcnt = $total_cnt - $stock->remain_cnt;
			if ($stock->remain_cnt >= $total_cnt){
				$bcnt = "0";
			}else{
				$bcnt =  $total_cnt - $stock->remain_cnt;
			}

			//공급가액 계산
			//$supply_price = $total_cnt * $t3->unit_price;
			$supply_price = $total_cnt * $t->unit_price;

			$tax = $supply_price / 10; 
			
			$total_price = $supply_price + $tax;

			if($total_cnt <= 0) $bcnt = $stock->remain_cnt;

			$re[$i]['uid'] = $t->uid;
			$re[$i]['fid'] = $t->fid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = number_format($t->cnt);
			$re[$i]['unit_price'] = number_format($t->unit_price);
			$re[$i]['supply_price'] = number_format($t->total_price - $t->tax);
			$re[$i]['remain_cnt'] = number_format($stock->remain_cnt);
			$re[$i]['shortage_cnt'] = number_format($bcnt);
			$re[$i]['tax'] = number_format($t->tax);
			$re[$i]['total_price'] = number_format($t->total_price);
			//$re[$i]['lot_no_cd'] = str_replace("_","-",$t->lot_no_cd);
			//$re[$i]['lot_no_nm'] = str_replace("_","-",$t->lot_no_nm);
			$re[$i]['lot_no_cd'] = $t->lot_no_cd;
			$re[$i]['lot_no_nm'] = $t->lot_no_nm;
			
			$sql2 = "select * from erp_receiving_inspection where inspection_cd='".$t->inspection_cd."'";
			$result2 = mysql_fetch_object(mysql_query($sql2));

			$re[$i]['inspection_dt'] = substr($result2->regdate,0,10);
			$re[$i]['inspection_cd'] = $t->inspection_cd;
			$i++;
		}

		echo $json->encode($re);
	break;

	case "getBarcodeItem" : // 바코드 입고처리
		
		$sql = "select * from erp_item where barcode='".$barcode."'";
		//echo $sql."<BR><BR>"; 
		$t = @mysql_fetch_object(mysql_query($sql));

		$sql2 = "select remain_cnt, warehouse_cd, warehouse_nm from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'";
		//echo $sql2."<BR><BR>"; 
		$stock = @mysql_fetch_object(mysql_query($sql2));
		
		$cnt = 1;

		$total_cnt = $cnt;

		// 부족재고수량
		//$bcnt = $total_cnt - $stock->remain_cnt;
		if ($stock->remain_cnt >= $total_cnt){
			$bcnt = "0";
		}else{
			$bcnt =  $total_cnt - $stock->remain_cnt;
		}		
		//공급가액 계산
		$supply_price = $total_cnt * $t->unit_price;
		$tax = $supply_price / 10; 
		
		$total_price = $supply_price + $tax;

		if($total_cnt <= 0) $bcnt = $stock->remain_cnt;
		
			$re['uid'] = $t->uid;
			$re['fid'] = $t->fid;
			$re['item_cd'] = $t->item_cd;
			$re['item_nm'] = $t->item_nm;
			$re['standard1'] = $t->standard1;
			$re['material'] = $t->material;
			$re['unit'] = $t->unit;
			$re['cnt'] = $cnt;
			$re['remain_cnt'] = number_format($stock->remain_cnt);
			$re['shortage_cnt'] = number_format($bcnt);
			$re['unit_price'] = number_format($t->unit_price);
			$re['supply_price'] = number_format($supply_price);
			$re['tax'] = number_format($tax);
			$re['total_price'] = number_format($total_price);
			$re['account_cd'] = $t->account_cd;
			$re['account_nm'] = $t->account_nm;
			
			$re['warehouse_cd'] = $stock->warehouse_cd;
			$re['warehouse_nm'] = getWarehouseNm($stock->warehouse_cd);

			echo $json->encode($re);
		
	break;
	

	//발주서 종결
	case "endSelectPurchaseOrder" :
			$query = "update erp_purchase_order set state='7' where uid=".$uid;
			mysql_query($query);
		echo "success";
	break;

	case "endCancelSelectPurchaseOrder" :
			$query = "update erp_purchase_order set state='1' where uid=".$uid;
			mysql_query($query);
		echo "success";
	break;
}
?>