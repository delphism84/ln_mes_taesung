<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
/****************************************************************************/
// 견적서 코드 생성
/****************************************************************************/
	case "createEstimateCode" :
		//$cd = "EST-".time();
		$cd = "ORD-".time();
		echo $cd;
	break;
/****************************************************************************/
// 수주(주문) 코드 생성
/****************************************************************************/
	case "createOrderCode" :
		//$cd = "ORD-".time();
		$cd = "ORD-".time();
		echo $cd;
	break;
/****************************************************************************/
// 견적서 리스트 가져오기
/****************************************************************************/
	case "getEstimate" :

		//$where = " where mem_sn='".$_SESSION['memberCsn']."' "; //and group_sn='1'
		$where = " where 1=1";
		
		if($search_txt != "") {
			$where .= " and (estimate_dt like '%".$search_txt."%' or account_nm like '%".$search_txt."%' or manager like '%".$search_txt."%')";
		}

		if($start_dt != "" && $end_dt != "") {
			$where .= " AND ( left(estimate_dt,10) between '".$start_dt."' and '".$end_dt."')";
		}

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_estimate".$where." order by uid desc";
		else $query = "select * from erp_estimate".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['estimate_cd'] = $t->estimate_cd;
			$re[$i]['estimate_dt'] = substr($t->estimate_dt,0,10);
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['manager'] = $t->manager;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['tax_type'] = $t->tax_type;
			$re[$i]['currency'] = $t->currency;
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['refer'] = $t->refer;
			$re[$i]['payment_condition'] = $t->payment_condition;
			$re[$i]['delivery_dt'] = substr($t->delivery_dt,0,10);
			$re[$i]['attach'] = $t->attach;
			$re[$i]['final'] = $t->final;
			$re[$i]['state'] = $t->state;
			$re[$i]['used'] = $t->used;
			
			// 합계금액구하기
			$sql = "select sum(total_price) as total_price from erp_estimate_item where fid=".$t->uid;
			$tt = mysql_fetch_object(mysql_query($sql));
			$re[$i]['total_price'] = $tt->total_price;

			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
/****************************************************************************/
// 사용하지 않은 견적서 리스트 가져오기
/****************************************************************************/	
	case "getNotUsedEstimate" :
		$query = "select * from erp_estimate".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1;  
		$query = "select * from erp_estimate".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['estimate_cd'] = $t->estimate_cd;
			$re[$i]['estimate_dt'] = substr($t->estimate_dt,0,10);
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
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
			$re[$i]['final'] = $t->final;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
/****************************************************************************/
// 견적서 하나 가져오기
/****************************************************************************/
	case "getEstimateOne" :
		$query = "select * from erp_estimate where uid=".$uid;
		$t = mysql_fetch_object(mysql_query($query));

		$re['uid'] = $t->uid;
		$re['estimate_cd'] = $t->estimate_cd;
		$re['estimate_dt'] = substr($t->estimate_dt,0,10);
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
		$re['delivery_dt'] = substr($t->delivery_dt,0,10);
		$re['state'] = $t->state;
		$re['attach'] = $t->attach;
		$re['final'] = $t->final;
		$re['create_dt'] = substr($t->create_dt,0,10);

		echo $json->encode($re);
	break;

/****************************************************************************/
// 견적서 삭제
/****************************************************************************/
	case "deleteSelectEstimate" :
		// 하위 견적서도 다 삭제해야함
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_estimate where uid=".$array_uid[$i];
			mysql_query($query);

			$query = "delete from erp_estimate_item where fid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
/****************************************************************************/
// 부가 견적서 리스트 가져오기
/****************************************************************************/
	case "getSubEstimate" :
		$query = "select * from erp_estimate where estimate_cd='".$estimate_cd."' and uid <>".$uid." order by uid desc";
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['estimate_cd'] = $t->estimate_cd;
			$re[$i]['estimate_dt'] = substr($t->estimate_dt,0,10);
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
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

			// 합계금액구하기
			$sql = "select sum(total_price) as total_price from erp_estimate_item where fid=".$t->uid;
			$tt = mysql_fetch_object(mysql_query($sql));
			$re[$i]['total_price'] = number_format($tt->total_price);

			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
/****************************************************************************/
// 견적 품목 리스트 가져오기
/****************************************************************************/
	case "getEstimateItem" :
		$sql = "select * from erp_estimate_item where fid=".$uid;
		$result = mysql_query($sql);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
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
			$re[$i]['tariff'] = $t->tariff;
			$re[$i]['adjustments'] = number_format($t->adjustments);
			$re[$i]['supply_price'] = number_format($t->supply_price);
			$re[$i]['tax'] = number_format($t->tax);
			$re[$i]['total_price'] = number_format($t->total_price);
			$re[$i]['lot_no_cd'] = $t->lot_no_cd;
			$re[$i]['lot_no_nm'] = $t->lot_no_nm;
			$i++;
		}

		echo $json->encode($re);
	break;
/****************************************************************************/
// 수주(주문) 리스트 가져오기
/****************************************************************************/
	case "getOrder" :

		//$where = " where mem_sn='".$_SESSION['memberCsn']."' "; //and group_sn='1'
		$where = " where 1=1";
		
		if($search_txt != "") {
			$where .= " and (order_dt like '%".$search_txt."%' or account_nm like '%".$search_txt."%' or manager like '%".$search_txt."%')";
		}

		if($start_dt != "" && $end_dt != "") {
			$where .= " AND ( left(order_dt,10) between '".$start_dt."' and '".$end_dt."')";
		}

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_order".$where." order by uid desc";
		else $query = "select * from erp_order".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;
		
		while($t = @mysql_fetch_object($result)) {
			$item_nm = "";
			$total = 0;
			$query = "select * from erp_order_item where oid='".$t->uid."'";
			//echo $query;
			$res = mysql_query($query);
			$k = 0;
			while($t2 = mysql_fetch_object($res)) {
				if($k == 0) $item_nm = $t2->item_nm;
				$total = $total + $t2->total_price;
				$k++;
			}
			
			if($k > 1) $item_nm = $item_nm . "외 " . ($k-1) . "건";

			switch($t->state) {
				case "0" : $state = "대기"; break;
				case "1" : $state = "진행"; break;
				case "2" : $state = "출하완료"; break;
				case "3" : $state = "수주취소"; break;
				case "4" : $state = "종료"; break;
			}

			if ($t->priceTotal=="0" || $t->priceTotal==""){
				$priceTotal = $total;
			}else{
				$priceTotal = $t->priceTotal;
			} 
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['order_dt'] = $t->order_dt;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['item_nm'] = $item_nm;
			$re[$i]['total'] = number_format($total);
			$re[$i]['state'] = $state;
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
			$re[$i]['cntTotal'] = number_format($t->cntTotal);
			$re[$i]['unitPriceTotal'] = number_format($t->unitPriceTotal);
			$re[$i]['supplyPriceTotal'] = number_format($t->supplyPriceTotal);
			$re[$i]['taxTotal'] = number_format($t->taxTotal);
			$re[$i]['priceTotal'] = number_format($priceTotal);
			$re[$i]['state'] = $t->state;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectOrder" :
		// 하위 견적서도 다 삭제해야함
		// 견적아이템도 삭제
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_order where uid=".$array_uid[$i];
			mysql_query($query);

			$query = "delete from erp_order_item where fid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "getOrderComplete" :
		$where = " where state='complete'";

		$query = "select * from erp_order".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$query = "select count(*) from erp_order".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_order".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;
		
		while($t = @mysql_fetch_object($result)) {
			$item_nm = "";
			$total = 0;
			$query = "select * from erp_order_item where fid=".$t->uid;
			$res = mysql_query($query);
			$k = 0;
			while($t2 = mysql_fetch_object($res)) {
				if($k == 0) $item_nm = $t2->item_nm;
				$total = $total + $t2->total_price;
				$k++;
			}
			
			if($k > 1) $item_nm = $item_nm . "외 " . ($k-1) . "건";

			switch($t->state) {
				case "ing" : $state = "진행중"; break;
				case "complete" : $state = "종료"; break;
			}

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['estimate_cd'] = $t->estimate_cd;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['item_nm'] = $item_nm;
			$re[$i]['total'] = number_format($total);
			$re[$i]['state'] = $state;
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

		//주문 종결
	case "endSelectOrder" :
			$query = "update erp_order set state='4' where uid=".$uid;
			mysql_query($query);
		echo "success";
	break;

	case "endCancelSelectOrder" :
			$query = "update erp_order set state='1' where uid=".$uid;
			mysql_query($query);
		echo "success";
	break;

	

}
?>