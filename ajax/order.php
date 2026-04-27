<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	// 구매요청코드 생성
	case "createPurchaseCode" :
		echo "PUR-".time();
	break;
	
	// 구매요청리스트 
	case "getOrder" :
		$query = "select * from erp_order".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_order".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_order".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['delivery_dt'] = substr($t->delivery_dt,0,10);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getOrderOne" : 
		//$query = "select * from erp_order where order_cd='" . $order_cd ."'";
		$query = "select * from erp_order where uid='" . $uid ."'";
		$t = @mysql_fetch_object(mysql_query($query));
		
		$re['uid'] = $t->uid;
		$re['order_cd'] = $t->order_cd;
		$re['estimate_cd'] = $t->estimate_cd;
		$re['account_cd'] = $t->account_cd;
		$re['account_nm'] = $t->account_nm;
		$re['manager'] = $t->manager;
		$re['warehouse_cd'] = $t->warehouse_cd;
		$re['warehouse_nm'] = $t->warehouse_nm;
		$re['tax_type'] = $t->tax_type;
		$re['currency'] = $t->currency;
		$re['project_cd'] = $t->project_cd;
		$re['project_nm'] = $t->project_nm;
		$re['refer'] = $t->refer;
		$re['payment_condition'] = $t->payment_condition;
		$re['delivery_dt'] = $t->delivery_dt;
		$re['attach'] = $t->attach;
		$re['remark'] = $t->remark;
		$re['state'] = $t->state;
		$re['create_dt'] = $t->create_dt;

		echo $json->encode($re);
	break;
	
	// 구매요청서 작성시 사용
	case "getOrderItem" :
		//$query = "select * from erp_order_item where order_cd='".$order_cd."'";
		$query = "select * from erp_order_item where oid='".$uid."'";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['oid'] = $t->oid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['material'] = $t->material;
			$re[$i]['cnt'] = number_format($t->cnt);
			$re[$i]['unit_price'] = number_format($t->unit_price);
			$re[$i]['supply_price'] = number_format($t->supply_price);
			$re[$i]['tax'] = number_format($t->tax);
			$re[$i]['total_price'] = number_format($t->total_price);
			$re[$i]['warehouse_cd'] = "";
			$re[$i]['warehouse_nm'] = "";
			$i++;
		}

		echo $json->encode($re);
	break;

	// 출하지시서 작성시 사용
	case "getOrderItem2" :
		//$query = "select * from erp_order_item where order_cd='".$order_cd."'";
		$query = "select * from erp_order_item where oid='".$uid."'";
		//echo $query."<br>//////";
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {

			//출고할 창고의 현재 재고
			$sql2 = "select sum(in_cnt) as in_cnt , sum(out_cnt) as out_cnt, sum(remain_cnt) as remain_cnt from erp_stock_inout where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' and used='n' group by item_cd, standard1";  //and warehouse_cd='".$t1->warehouse_cd."'
			
			//echo $sql2;
			$ccnt = @mysql_fetch_object(mysql_query($sql2));
			// 재고수량
			$remain_cnt = $ccnt->remain_cnt;

			$re[$i]['uid'] = $t->uid;
			$re[$i]['oid'] = $t->oid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['material'] = $t->material;
			$re[$i]['cnt'] = number_format($t->cnt);
			$re[$i]['unit_price'] = number_format($t->unit_price);
			$re[$i]['supply_price'] = number_format($t->supply_price);
			$re[$i]['tax'] = number_format($t->tax);
			$re[$i]['total_price'] = number_format($t->total_price);
			if(rem)
			$re[$i]['remain_cnt'] = $remain_cnt;
			$re[$i]['warehouse_cd'] = "";
			$re[$i]['warehouse_nm'] = "";
			$i++;
		}

		echo $json->encode($re);
	break;

	// 출하지지서 작성시 사용
	case "getOrderShipmentItem" :
		$query = "select * from erp_order_shipment_item where sid='".$uid."'";
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			// 재고수량 가져오기
			$sql = "select * from erp_stock_inout where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' and standard2='".$t->standard2."' and standard3='".$t->standard3."' and remain_cnt > 0";
			$res = mysql_query($sql);
			
			while($item = mysql_fetch_object($res)) {
				$re[$i]['uid'] = $item->uid;
				$re[$i]['order_cd'] = $item->order_cd;
				$re[$i]['item_cd'] = $item->item_cd;
				$re[$i]['item_nm'] = getItemName($item->item_cd);
				$re[$i]['standard1'] = $item->standard1;
				$re[$i]['standard2'] = $item->standard2;
				$re[$i]['standard3'] = $item->standard3;
				$re[$i]['unit'] = $item->unit;
				$re[$i]['warehouse_cd'] = $item->warehouse_cd;
				$re[$i]['warehouse_nm'] = getWarehouseName($item->warehouse_cd);
				$re[$i]['cnt'] = $t->remain_cnt;
				$re[$i]['stock_cnt'] = $item->remain_cnt;
				$i++;
			}
		}

		echo $json->encode($re);
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectOrder" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_order where uid=".$array_uid[$i];
			mysql_query($query);

			$query = "delete from erp_order_item where oid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	//출하지시서 삭제
	case "deleteSelectOrderShipment" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_order_shipment where uid=".$array_uid[$i];
			mysql_query($query);

			$query = "delete from erp_order_shipment_item where sid=".$array_uid[$i];
			mysql_query($query);

		}

		echo "success";
	break;

	//출하지시서 종결
	case "endSelectOrderShipment" :
			$query = "update erp_order_shipment set state='end' where uid=".$uid;
			mysql_query($query);
		echo "success";
	break;




}
?>