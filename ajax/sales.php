<?
/*
거래처 관련 Ajax 처리 페이지
*/

session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	// 거래처 리스트 가져오기
	case "getAs" :
		$page = (is_numeric($page)) ? $page : 1; 

		if($rpp == "all") $query = "select * from erp_as".$where." order by uid desc";
		else $query = "select * from erp_as".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['accept_cd'] = $t->accept_cd;
			$re[$i]['accept_dt'] = substr($t->accept_dt,0,10);
			$re[$i]['accept_cha'] = $t->accept_cha;
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
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
	
	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectAS" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_as where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "registShipment" :
		$now = date("Y-m-d");

		$sql = "select * from erp_order_item where order_cd='".$order_cd."' and item_cd='".$item_cd."' and standard1='".$standard1."' and standard2='".$standard2."' and standard3='".$standard3."' and state='ing'";
		//echo $sql;
		$t = @mysql_fetch_object(mysql_query($sql));

		$remain_cnt = $t->remain_cnt - $out_cnt;
		if($remain_cnt == 0) $state = "complete";
		else $state = "ing";
		
		$out_cnt = $out_cnt + $t->out_cnt;
		
		if(isset($t->uid)) {
			$sql = "update erp_order_item set out_cnt=".$out_cnt.", remain_cnt=".$remain_cnt.", state='".$state."' where uid=".$t->uid;
			echo $sql;
			mysql_query($sql) or die (mysql_error());

			// 출고지시서 발행
			$sql = "
				insert into erp_release (
					fid,
					order_cd,
					workplan_cd,
					work_cd,
					item_cd,
					item_nm,
					standard1,
					standard2,
					standard3,
					unit,
					cnt,
					status,
					emp_id,
					create_dt
				) values (
					$t->uid,
					'$order_cd',
					'',
					'$t->work_cd',
					'$t->item_cd',
					'$t->item_nm',
					'$t->standard1',
					'$t->standard2',
					'$t->standard3',
					'$t->unit',
					$out_cnt,
					'stay',
					'$_SESSION[login_id],
					'$now'
				)
			";

			$result = mysql_query($sql);

			if($result) echo "success";
		}
	break;
	
	// 출하지지 리스트 가져오기
	case "getOrderShipment" :
		$query = "select * from erp_order_shipment".$where;
	//echo $query;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$query = "select count(*) from erp_order_shipment".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_order_shipment".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;
		
		while($t = @mysql_fetch_object($result)) {
			$item_nm = "";
			$total = 0;
			$query = "select * from erp_order_shipment_item where sid='".$t->uid."'";
			$res = mysql_query($query);
			$k = 0;

			$arr = array();

			while($t2 = mysql_fetch_object($res)) {
				// 품목명 출력을 위함
				if($k == 0) $item_nm = $t2->item_nm;
				$total = $total + $t2->total_price;
				
				$sql = "select * from erp_stock where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."' ";
				//echo $sql;
				$stock = mysql_fetch_object(mysql_query($sql));
				
				if($stock->remain_cnt >= $t2->remain_cnt) array_push($arr,"complete");
				else array_push($arr, "ing");
				
				$k++;
			}
			
			if($k > 1) $item_nm = $item_nm . "외 " . ($k-1) . "건";
			else $item_nm = $item_nm;
			
			if(sizeof($arr) > 0) {
				if(in_array("ing",$arr)) $state = "n";
				else $state = "y";
			} else {
				$state = "n";
			}

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['shipment_cd'] = $t->shipment_cd;
			$re[$i]['shipment_dt'] = $t->shipment_dt;
			$re[$i]['shipment_cha'] = $t->shipment_cha;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['item_nm'] = $item_nm;
			$re[$i]['total'] = number_format($total);
			$re[$i]['cntTotal'] = number_format($t->cntTotal);
			$re[$i]['state'] = $t->state;
			$re[$i]['manager'] = $t->manager;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['tax_type'] = $t->tax_type;
			$re[$i]['currency'] = $t->currency;
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['refer'] = $t->refer;
			$re[$i]['payment_condition'] = $t->payment_condition;
			$re[$i]['delivery_dt'] = substr($t->delivery_dt,0,10);
			$re[$i]['attach'] = $t->attach;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getOrderShipmentItem" :
		$query = "select * from erp_order_shipment_item where sid='".$uid."'";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			// 재고수량 가져오기
			$sql = "select * from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' and remain_cnt > 0";
			//echo $sql;
			$item = mysql_fetch_object(mysql_query($sql));

			$sql2 = "select * from erp_product_perf_repost where work_cd='".$t->work_cd."' and process_nm='PRESS가공' ";
			$result2 = mysql_query($sql2);
			if(mysql_num_rows($result2) > 0 ){
				$report = mysql_fetch_object($result2);
				$re[$i]['presswork_dt'] = $report->production_dt;
			}else{
				$re[$i]['presswork_dt'] = "";
			}

			
			
			$re[$i]['uid'] = $t->uid;
			$re[$i]['sid'] = $t->sid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = number_format($t->cnt);
			$re[$i]['out_cnt'] = number_format($t->out_cnt);
			//$re[$i]['remain_cnt'] = number_format($t->remain_cnt);
			$re[$i]['unit_price'] = number_format($t->unit_price);
			$re[$i]['adjustments'] = $t->adjustments;
			$re[$i]['supply_price'] = number_format($t->supply_price);
			$re[$i]['tax']			= number_format($t->tax);
			$re[$i]['total_price'] = number_format($t->total_price);
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['warehouse_cd'] = $item->warehouse_cd;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['remain_cnt'] = number_format($item->remain_cnt);
			$re[$i]['stock_cnt'] = $item->remain_cnt;
			$re[$i]['box_cnt'] = $t->box_cnt;
			//$re[$i]['remark'] = $t->remark;
			$re[$i]['lot_no_cd'] = $t->lot_no_cd;
			$re[$i]['lot_no_nm'] = $t->lot_no_cd;
			$i++;
			
		}

		echo $json->encode($re);
	break;

	// 출하지지서 작성시 사용
	case "getOrderShipmentItem2" :
		$query = "select * from erp_order_shipment_item where sid='".$uid."'";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			
			//while($item = mysql_fetch_object($res)) {
				$re[$i]['uid'] = $t->uid;
				$re[$i]['sid'] = $t->sid;
				$re[$i]['item_cd'] = $t->item_cd;
				$re[$i]['item_nm'] = $t->item_cd;
				$re[$i]['standard1'] = $t->standard1;
				$re[$i]['standard2'] = $t->standard2;
				$re[$i]['standard3'] = $t->standard3;
				$re[$i]['material'] = $t->material;
				$re[$i]['unit'] = $t->unit;
				$re[$i]['cnt'] = number_format($t->cnt);
				$re[$i]['out_cnt'] = number_format($t->out_cnt);
				//$re[$i]['remain_cnt'] = number_format($t->remain_cnt);
				$re[$i]['unit_price'] = number_format($t->unit_price);
				$re[$i]['adjustments'] = $t->adjustments;
				$re[$i]['supply_price'] = number_format($t->supply_price);
				$re[$i]['tax']			= number_format($t->tax);
				$re[$i]['total_price'] = number_format($t->total_price);
				$re[$i]['work_cd'] = $t->work_cd;
				$re[$i]['warehouse_cd'] = $t->warehouse_cd;
				$re[$i]['warehouse_nm'] = getWarehouseName($t->warehouse_cd);
				//$re[$i]['remain_cnt'] = number_format($item->remain_cnt);
				$re[$i]['box_cnt'] = $t->box_cnt;
				//$re[$i]['remark'] = $t->remark;
				$re[$i]['lot_no_cd'] = $t->lot_no_cd;
				$re[$i]['lot_no_nm'] = $t->lot_no_cd;
				$i++;
			//}
		}

		echo $json->encode($re);
	break;

	// 미수금리스트
	case "getAccountReceivable" :
		$sql = "select * from erp_order".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = query($sql);
		while($t = @mysql_fetch_object($result)) {
			$sql = "select sum(total_price) as total_price from erp_order_item where order_cd='".$t->order_cd."'";
			$price = fetch_object($sql);

			$sql = "select * from erp_account where account_cd='".$t->account_cd."'";
			$account = fetch_object($sql);

			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['owner'] = $account->owner;
			$re[$i]['corp_phone'] = $account->corp_phone;
			$re[$i]['total_price'] = number_format($price->total_price);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			//$re[$i]['receivable'] = number_format($t->create_dt,0,10);
			$i++;
		}
		echo $json->encode($re);
	break;
}
?>