<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	
	
//	case "getWarehouseStock" : //기존코드
//		$page = (is_numeric($page)) ? $page : 1; 
//
//
//		$query = "select sum(in_cnt) as in_cnt , sum(out_cnt) as out_cnt , item_cd , standard1 , lot_no from erp_stock_inout group by lot_no, item_cd , standard1 limit ".($page-1)*$rpp.", ".$rpp;
//
//		$result = mysql_query($query);
//		//$total_num = mysql_num_rows($result);
//		$i = 0;
//		$ct = 1;
//
//		while($t = @mysql_fetch_object($result)) {
//
//			$remain_cnt = $t->in_cnt - $t->out_cnt;
//			//if($remain_cnt >0 ){
//
//				$query = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
//				$warehouse = mysql_fetch_object(mysql_query($query));
//				if($warehouse->warehouse_nm=="" || $warehouse->warehouse_nm=="null"){
//					$warehouse_nm = '미지정';
//				}else{
//					$warehouse_nm = $warehouse->warehouse_nm;
//				}
//				$query = "select item_nm,img from erp_item where item_cd='".$t->item_cd."'";
//				$item = mysql_fetch_object(mysql_query($query));
//
//				$no = $rpp * ($page-1) + $ct;
//				//$re[$i]['total_num'] = $total_num;
//				$re[$i]['no'] = $no;
//				$re[$i]['uid'] = $t->uid;
//				$re[$i]['img'] = $item->img;
//				$re[$i]['warehouse_nm'] = $warehouse_nm;
//				$re[$i]['warehouse_cd'] = $t->warehouse_cd;
//				$re[$i]['item_cd'] = $t->item_cd;
//				$re[$i]['item_nm'] = $item->item_nm;
//				$re[$i]['standard1'] = $t->standard1;
//				$re[$i]['material'] = $t->material;
//				$re[$i]['unit'] = $t->unit;
//				$re[$i]['remain_cnt'] = number_format($remain_cnt);
//				$re[$i]['avg_price'] = number_format($t->price);
//				$i++;
//				$ct++;
//			//}
//		}
//
//		echo $json->encode($re);
//	break;

	//재고조정
	case "getWarehouseStock" :

		$page = (is_numeric($page)) ? $page : 1; 

		if($rpp == "all") $sql2 = "select lot_no , item_cd, warehouse_cd, standard1, material, unit, sum(in_cnt) as in_cnt , sum(out_cnt)as out_cnt, sum(remain_cnt) as remain_cnt from erp_stock_inout where used='n' and remain_cnt>0 ".$where;

		else $sql2 = "select lot_no ,item_cd, warehouse_cd, standard1, material, unit, sum(in_cnt) as in_cnt , sum(out_cnt)as out_cnt , sum(remain_cnt) as remain_cnt from erp_stock_inout where used='n' and remain_cnt > 0 ".$where." limit ".($page-1)*$rpp.", ".$rpp;

		$result2 = mysql_query($sql2);

		//echo $sql2."<br>";

		$i = 0;
		$ct = 1;

		while( $t = mysql_fetch_object($result2) ) {
			$remain_cnt = $t->remain_cnt;
			
				$query = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
				$warehouse = mysql_fetch_object(mysql_query($query));
				if($warehouse->warehouse_nm=="" || $warehouse->warehouse_nm=="null"){
					$warehouse_nm = '미지정';
				}else{
					$warehouse_nm = $warehouse->warehouse_nm;
				}
				$query = "select item_nm,img from erp_item where item_cd='".$t->item_cd."'";
				$item = mysql_fetch_object(mysql_query($query));

				$no = $rpp * ($page-1) + $ct;
				
				$re[$i]['no'] = $no;
				//$re[$i]['uid'] = $t->uid;
				$re[$i]['img'] = $item->img;
				$re[$i]['warehouse_nm'] = $warehouse_nm;
				$re[$i]['warehouse_cd'] = $t->warehouse_cd;
				$re[$i]['item_cd'] = $t->item_cd;
				$re[$i]['item_nm'] = $item->item_nm;
				$re[$i]['standard1'] = $t->standard1;
				$re[$i]['material'] = $t->material;
				$re[$i]['unit'] = $t->unit;
				$re[$i]['remain_cnt'] = number_format($remain_cnt);
				$re[$i]['lot_no'] = $t->lot_no;
				
				$i++;
				$ct++;
			
		}

		echo $json->encode($re);
	break;

	

	// 창고별 재고관리- 사용중
	case "getWarehouseStock2" :
		
		$page = (is_numeric($page)) ? $page : 1; 
		
		$sql2 = "select lot_no ,item_cd, warehouse_cd, standard1, material, unit, sum(in_cnt) as in_cnt , sum(out_cnt)as out_cnt , sum(remain_cnt) as remain_cnt from erp_stock_inout where used='n' and remain_cnt>0  group by warehouse_cd,item_cd,standard1,lot_no having warehouse_cd='".$warehouse_cd."' ";

		$result2 = mysql_query($sql2);
		//echo $sql2."<br>";

		$i = 0;
		while( $t = mysql_fetch_object($result2) ) {
			$remain_cnt = $t->remain_cnt;

			//echo $t->item_cd."//".$t->in_cnt.">>".$t->out_cnt."\n\n";
			
			$query = "select warehouse_nm from erp_warehouse where warehouse_cd='".$warehouse_cd."'";
			$warehouse = mysql_fetch_object(mysql_query($query));
			if($warehouse->warehouse_nm=="" || $warehouse->warehouse_nm=="null"){
				$warehouse_nm = '미지정';
			}else{
				$warehouse_nm = $warehouse->warehouse_nm;
			}
			$query = "select item_nm,img from erp_item where item_cd='".$t->item_cd."'";
			$item = mysql_fetch_object(mysql_query($query));

			$re[$i]['img'] = $item->img;
			$re[$i]['warehouse_nm'] = $warehouse_nm;
			$re[$i]['warehouse_cd'] = $warehouse_cd;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $item->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['remain_cnt'] = number_format($remain_cnt);
			$re[$i]['lot_no'] = $t->lot_no;
			
			$i++;			
		}

		echo $json->encode($re);
	break;

	// 자재 수불부
	case "getWarehouseStock3" :
		
		$page = (is_numeric($page)) ? $page : 1; 
		
		$sql2 = "select item_cd, standard1, material, unit, sum(in_cnt) as in_cnt , sum(out_cnt)as out_cnt , sum(remain_cnt) as remain_cnt from erp_stock_inout  ".$where." group by item_cd,standard1 limit ".($page-1)*$rpp.", ".$rpp;

		$result2 = mysql_query($sql2);
		//echo $sql2."<br>";

		$i = 0;
		while( $t = mysql_fetch_object($result2) ) {
			$remain_cnt = $t->remain_cnt;

			//echo $t->item_cd."//".$t->in_cnt.">>".$t->out_cnt."\n\n";
			
			$query = "select warehouse_nm from erp_warehouse where warehouse_cd='".$warehouse_cd."'";
			$warehouse = mysql_fetch_object(mysql_query($query));
			if($warehouse->warehouse_nm=="" || $warehouse->warehouse_nm=="null"){
				$warehouse_nm = '미지정';
			}else{
				$warehouse_nm = $warehouse->warehouse_nm;
			}
			$query = "select item_nm,img from erp_item where item_cd='".$t->item_cd."'";
			$item = mysql_fetch_object(mysql_query($query));

			$re[$i]['img'] = $item->img;
			$re[$i]['warehouse_nm'] = $warehouse_nm;
			$re[$i]['warehouse_cd'] = $warehouse_cd;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $item->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['remain_cnt'] = number_format($remain_cnt);
			$re[$i]['lot_no'] = $t->lot_no;
			
			$i++;			
		}

		echo $json->encode($re);
	break;

	// 창고별 재고관리?? 
	case "getWarehouseEachStock" :
		$query = "select * from erp_stock_inout where item_cd='".$item_cd."' and standard1='".$standard1."' and warehouse_cd='".$warehouse_cd."' and used='n' and remain_cnt > 0 order by uid asc";
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$query = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
			$warehouse = mysql_fetch_object(mysql_query($query));
			if($warehouse->warehouse_nm=="" || $warehouse->warehouse_nm=="null"){
				$warehouse_nm = '미지정';
			}else{
				$warehouse_nm = $warehouse->warehouse_nm;
			}

			$query = "select item_nm,img from erp_item where item_cd='".$t->item_cd."'";
			$item = mysql_fetch_object(mysql_query($query));

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['warehouse_nm'] = $warehouse_nm;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $item->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['remain_cnt'] = number_format($t->remain_cnt);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['pur_unit_price'] = number_format($t->pur_unit_price);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	// 재고수불부
	case "getStockInout" :
		//$query = "select * from erp_stock_inout ".$where." order by item_cd asc limit ".($page-1)*$rpp.", ".$rpp;
		$query = "select * from erp_stock_inout ".$where." order by item_cd asc";
		//echo $query."<br>";
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$in_cnt=0;
		$out_cnt=0;
		while($t = @mysql_fetch_object($result)) {
						
			$query = "select item_nm,img from erp_item where item_cd='".$t->item_cd."'";
			$item = mysql_fetch_object(mysql_query($query));

			$no = $rpp * ($page-1) + $ct;

			$in_cnt = $in_cnt + $t->in_cnt;
			$out_cnt = $out_cnt + $t->out_cnt;

			$re[$i]['uid'] = $t->uid;
			//$re[$i]['warehouse_nm'] = $warehouse_nm;
			//$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $item->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['in_cnt'] = number_format($t->in_cnt);
			$re[$i]['out_cnt'] = number_format($t->out_cnt);
			$re[$i]['remain_cnt'] = number_format($t->remain_cnt);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['account'] = $t->account;
			$re[$i]['remark'] = $t->remark;
			$re[$i]['used'] = $t->used;
			$re[$i]['lot_no'] = $t->lot_no;

			//$re[$i]['pur_unit_price'] = number_format($t->pur_unit_price);
			//$re[$i]['total_in_cnt'] = $in_cnt;
			//$re[$i]['total_out_cnt'] = $out_cnt;

			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getStock" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_stock".$where." order by uid desc, warehouse_cd desc";
		else $query = "select * from erp_stock".$where." order by uid desc, warehouse_cd desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo "query=>".$query;
		$result = mysql_query($query);
		
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$sql2 = "select sum(in_cnt) as in_cnt , sum(out_cnt)as out_cnt , sum(remain_cnt)as remain_cnt from erp_stock_inout where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' and used='n' group by item_cd , standard1";
			$stock2 = mysql_fetch_object(mysql_query($sql2));

			$query2 = "select item_nm,img from erp_item where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' ";
			$item = mysql_fetch_object(mysql_query($query2));

			$remain_cnt = $stock2->remain_cnt;
			
			//if($remain_cnt >0){
				
				$no = $rpp * ($page-1) + $ct;
				$re[$i]['total_num'] = $total_num;
				$re[$i]['no'] = $no;
				$re[$i]['uid'] = $t->uid;
				$re[$i]['img'] = $item->img;
				$re[$i]['item_cd'] = $t->item_cd;
				
				
				$re[$i]['item_nm'] = $t->item_nm;
				

				$re[$i]['standard1'] = $t->standard1;
				$re[$i]['material'] = $t->material;
				$re[$i]['unit'] = $t->unit;

				if($remain_cnt == null || $remain_cnt == "" ){
					$re[$i]['remain_cnt'] = "0";
				}else{
					$re[$i]['remain_cnt'] = $remain_cnt;
				}
				$re[$i]['pur_unit_price'] = number_format($t->pur_unit_price);
				$re[$i]['r_cnt'] = number_format($t->s_cnt); //재고현황 총 재고 수량
				$re[$i]['p_price'] = number_format($t->s_price); //재고현황 총 재고단가
				$re[$i]['total_price'] = number_format($t->remain_cnt * $t->pur_unit_price);
				$i++;
				$ct++;
			//}
			
		}
		//echo "<<<".$i.">>>";

		echo $json->encode($re);

	break;

	case "getStock2" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_stock".$where." order by uid desc, warehouse_cd desc";
		else $query = "select * from erp_stock".$where." order by uid desc, warehouse_cd desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo "query=>".$query;
		$result = mysql_query($query);
		
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$sql2 = "select sum(in_cnt) as in_cnt , sum(out_cnt)as out_cnt  , sum(remain_cnt)as remain_cnt from erp_stock_inout where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' group by item_cd , standard1";
			$stock2 = mysql_fetch_object(mysql_query($sql2));
			
			$query = "select item_nm,img from erp_item where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'";
			$item = mysql_fetch_object(mysql_query($query));

			//echo "/////".$sql2."<br>";
			//echo ">>>".$item->item_nm."<br>";
			$remain_cnt = $stock2->remain_cnt;
				
			if($item->item_nm !=null){
				$no = $rpp * ($page-1) + $ct;
				$re[$i]['total_num'] = $total_num;
				$re[$i]['no'] = $no;
				$re[$i]['uid'] = $t->uid;
				$re[$i]['img'] = $item->img;
				$re[$i]['item_cd'] = $t->item_cd;
				$re[$i]['item_nm'] = $item->item_nm;
				$re[$i]['standard1'] = $t->standard1;
				$re[$i]['material'] = $t->material;
				$re[$i]['unit'] = $t->unit;
				$re[$i]['remain_cnt'] = $remain_cnt;
				$re[$i]['pur_unit_price'] = number_format($t->pur_unit_price);
				$re[$i]['r_cnt'] = number_format($t->s_cnt); //재고현황 총 재고 수량
				$re[$i]['p_price'] = number_format($t->s_price); //재고현황 총 재고단가
				$re[$i]['total_price'] = number_format($t->remain_cnt * $t->pur_unit_price);
				$i++;
				$ct++;
			}	
			
		}
		//echo "<<<".$i.">>>";

		echo $json->encode($re);

	break;

	case "getStockPrice" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_stock".$where." order by uid desc, warehouse_cd desc";
		else $query = "select * from erp_stock".$where." order by uid desc, warehouse_cd desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$query = "select item_nm from erp_item where item_cd='".$t->item_cd."'";
			$item = mysql_fetch_object(mysql_query($query));

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['img'] = "";
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $item->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['remain_cnt'] = number_format($t->remain_cnt);
			
			// 현재판매단가
			$sql = "select unit_price from erp_order_item where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'  order by uid desc limit 1";
			$price = @mysql_fetch_object(mysql_query($sql));
			$re[$i]['current_sale_price'] = number_format($price->unit_price);
			$cp = $price->unit_price;

			// 평균판매단가
			$sql = "select total_price,tax,cnt from erp_order_item where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' ";
			$res = mysql_query($sql);
			$unit_price = 0;
			$cnt = 0;
			while($p = mysql_fetch_object($res)) {
				$unit_price = $unit_price + ($p->total_price-$p->tax);
				$cnt = $cnt + $p->cnt;
			}
			$re[$i]['avg_sale_price'] = number_format($unit_price/$cnt);

			
			// 현재입고단가
			$sql = "select pur_unit_price from erp_stock_inout where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'  order by uid desc limit 1";
			$price = @mysql_fetch_object(mysql_query($sql));
			$re[$i]['current_pur_unit_price'] = number_format($price->pur_unit_price);
			$pp = $price->pur_unit_price;

			// 평균입고단가
			$sql = "select pur_unit_price,in_cnt from erp_stock_inout where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' ";
			$res = mysql_query($sql);
			$pur_unit_price = 0;
			$cnt = 0;
			while($p = mysql_fetch_object($res)) {
				$pur_unit_price = $pur_unit_price + $p->pur_unit_price;
				$cnt = $cnt + $p->in_cnt;
			}
			$re[$i]['avg_pur_unit_price'] = number_format($pur_unit_price/$cnt);

			// 가치평가
			$re[$i]['current_price'] = number_format(($t->remain_cnt * $cp) + ($t->remain_cnt * $pp));


			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "checkWarehouseStock" :
		$query = "select uid from erp_stock where item_cd='". $item_cd ."' and warehouse_cd='" . $warehouse_cd . "'";
		$rows = @mysql_num_rows(mysql_query($query));
		if($rows > 0) echo "ok";
		else echo "nothing";
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectStock" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_stock where item_cd='".$array_uid[$i]."'";
			mysql_query($query);
		}

		echo "success";
	break;

	// Lot No 가져오기
	case "getLotNo" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_stock_inout".$where." order by uid desc";
		else $sql = "select * from erp_stock_inout".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($sql);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['lot_no'] = $t->lot_no;
			$re[$i]['item_nm'] = getItemName($t->item_cd);
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['reason'] = "";
			$i++;
		}

		echo $json->encode($re);
	break;
	
	// 창고별안전재고등록

	case "getSafetyStock" :
		$page = (is_numeric($page)) ? $page : 1; 
		
		$sql = "select * from erp_warehouse where warehouse_gb='창고' order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $sql;
		$result = mysql_query($sql);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$query = "select safety_stock_cnt from erp_item_safety_stock where item_cd='".$item_cd."' and warehouse_cd='".$t->warehouse_cd."'";
			$item = mysql_fetch_object(mysql_query($query));
			if ($item->xsafety_stock_cnt == ""){
				$safety_stock_cnt = "";
			}else{
				$safety_stock_cnt = $item->safety_stock_cnt;
			}

			$re[$i]['uid'] = $t->uid;
			$re[$i]['warehouse_gb']		= $t->warehouse_gb;
			$re[$i]['warehouse_cd']		= $t->warehouse_cd;
			$re[$i]['warehouse_nm']		= $t->warehouse_nm;
			$re[$i]['safety_stock_cnt']	= $item->safety_stock_cnt;
			$i++;
		}

		echo $json->encode($re);
	break;

	

}
?>