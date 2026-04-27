
<?
/*
계정코드 관련 Ajax 처리 페이지
*/

session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);
//$mode = "get_account_code";
switch($mode) {
	// 입고할때 로트넘버 가져오기
	case "get_lot_no" :
				
		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  
		$query = "select * from erp_lot_no ".$where." order by regdate desc limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

				$no = $rpp * ($page-1) + $ct;
				$re[$i]['no'] = $no;
				$re[$i]['uid'] = $t->uid;
				$re[$i]['lot_no_cd'] = $t->lot_no_cd;
				$re[$i]['lot_no_nm'] = $t->lot_no_nm;
				$re[$i]['lot_no_dt'] = $t->lot_no_dt;
				//$re[$i]['lot_no_dt'] = $t->lot_no_dt;
				$re[$i]['item_nm'] = $t->item_nm;
				$re[$i]['item_cd'] = $t->item_cd;
				$re[$i]['standard1'] = $t->standard1;

				$re[$i]['etc'] = $t->etc;
				$re[$i]['regdate'] = $t->regdate;

				$i++;
				$ct++;
				//echo $re;
			
		}

		echo $json->encode($re);
	break;
	
	// Lot no 등록
	case "registLotNo" :
		if($uid != "") {
			$sql = "update erp_lot_no set lot_no_cd='".$lotnocd."', lot_no_nm='".$lotnonm."' where uid=".$uid;
		} else {
			$sql = "insert into erp_lot_no (lot_no_cd, lot_no_nm) values ('".$lotnocd."','".$lotnonm."')";
		}
		$result = query($sql);
		if($result) echo "success";
	break;


	case "get_item_lot_no" :
		$where = " where 1=1";

		//$where .= "";
		$where .= " and item_cd='".$item_cd."' and standard1='".$standard."'"; //구매 입고에서 부여된 LOT_NO를 가져오기 위한 
		if($txt != "") {
			if($search_choice == "lot_no_cd") {
				$where .= " and lot_no_cd like '%".$txt."%'";
			} else if($search_choice == "item_cd") {
				$where .= " and item_cd like '%".$txt."%'";
			}else{
				$where .= " and item_nm like '%".$txt."%'";
			}
		}
		
		$query = "select * from erp_warehousing_item".$where;

		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_warehousing_item".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 

		$query = "select * from erp_warehousing_item".$where." order by lot_no_cd  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query; 
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

			$sql2 ="select * from erp_warehousing where warehousing_cd='".$t->warehousing_cd."' ";
			$result2 = mysql_fetch_object(mysql_query($sql2));
			//echo $sql2;	
			
			//stock onout 해서 재고가 남아 있는지 확인...
			$sql3 = "select sum(remain_cnt)as remain_cnt from erp_stock_inout where item_cd ='".$t->item_cd."' and standard1 = '".$t->standard1."' and warehouse_cd='".$result2->warehouse_cd."' and lot_no='".$t->lot_no_cd."' and used='n' and remain_cnt>0 group by item_cd,standard1,warehouse_cd,lot_no ";

			$result33 = mysql_fetch_object(mysql_query($sql3));
			//echo $sql3;

			if($result33->remain_cnt >0 ){	//재고가 있으면 보여주기.

				$no = $rpp * ($page-1) + $ct;
				$re[$i]['total_num'] = $total_num;

				$re[$i]['no'] = $no;
				$re[$i]['uid'] = $t->uid;
				$re[$i]['lot_no_cd'] = $t->lot_no_cd;
				$re[$i]['lot_no_nm'] = $t->lot_no_nm;

				
				
				if($t->warehousing_dt==""){
					$re[$i]['warehousing_dt'] = substr($result2->warehousing_dt,0,10);
				}else{
					$re[$i]['warehousing_dt'] = substr($result2->warehousing_dt,0,10);
				}
				$re[$i]['item_nm'] = $t->item_nm;
				$re[$i]['standard1'] = $t->standard1;
				$re[$i]['material'] = $t->material;
				$re[$i]['unit_price'] = number_format($t->unit_price);
				$re[$i]['supply_price'] = number_format($t->supply_price);
				$re[$i]['warehouse_nm'] = $result2->warehouse_nm;
				$re[$i]['warehouse_cd'] = $result2->warehouse_cd;
				
				$re[$i]['regdate'] = substr($t->regdate,0,10);

				$i++;
				$ct++;
				//echo $re;
			}
		}

		echo $json->encode($re);
	break;

	case "get_item_lot_no2" : //새로 제작.. 재고 있는 원자재 조회...
		
		
		$where = " where item_cd='".$item_cd."' and standard1='".$standard."'"; //구매 입고에서 부여된 LOT_NO를 가져오기 위한 
		if($txt != "") {
			if($search_choice == "lot_no_cd") {
				$where .= " and lot_no like '%".$txt."%'";
			} else if($search_choice == "item_cd") {
				$where .= " and item_cd like '%".$txt."%'";
			}else{
				$where .= " and item_nm like '%".$txt."%'";
			}
		}

			//stock onout 해서 재고가 남아 있는지 확인...
			$sql3 = "select sum(remain_cnt)as remain_cnt from erp_stock_inout ".$where." and used='n' and remain_cnt>0 group by item_cd,standard1";

			$result33 = mysql_fetch_object(mysql_query($sql3));
			//echo $sql3;

			if($result33->remain_cnt >0 ){	//재고가 있으면 보여주기.

				$sql4 = "select item_cd,standard1,  sum(remain_cnt)as remain_cnt ,warehouse_cd, lot_no , MIN(in_dt) as in_dt , pur_unit_price from erp_stock_inout ".$where." and used='n' and remain_cnt>0 group by item_cd,standard1,warehouse_cd,lot_no limit ".($page-1)*$rpp.", ".$rpp;

				$result44 = mysql_query($sql4);

				//echo $sql4;
				$i=0;
				while($t=mysql_fetch_object($result44)){

					//$no = $rpp * ($page-1) + $ct;
					//$re[$i]['total_num'] = $total_num;

					//$re[$i]['no'] = $no;
					//$re[$i]['lot_no_nm'] = $t->lot_no_nm;

					//$re[$i]['uid'] = $t->uid;
					$re[$i]['lot_no_cd'] = $t->lot_no;

					$re[$i]['warehousing_dt'] = substr($t->in_dt,0,10);
					$re[$i]['regdate'] = substr($t->create_dt,0,10);
					
					$sql55 = "select * from erp_item where item_cd='".$t->item_cd."'";
					$t2 = mysql_fetch_object(mysql_query($sql55));

					$re[$i]['item_nm'] = $t2->item_nm;

					$re[$i]['standard1'] = $t->standard1;
					//$re[$i]['material'] = $t->material;
					$re[$i]['unit_price'] = number_format($t->pur_unit_price);
					//$re[$i]['supply_price'] = number_format($t->supply_price);


					$sql66 = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
					$t3 = mysql_fetch_object(mysql_query($sql66));
						
					$re[$i]['warehouse_nm'] = $t3 ->warehouse_nm;
					$re[$i]['warehouse_cd'] = $t->warehouse_cd;
					$re[$i]['remain_cnt'] = $t->remain_cnt;
					
					$i++;
			
				}
			}
		//}

		echo $json->encode($re);
	break;

	case "get_input_ready" : //새로 제작.. 재고 있는 원자재 조회...
		
		
		$where = " where item_cd='".$item_cd."' and standard1='".$standard."' and yn='n' ";
		if($txt != "") {
			if($search_choice == "lot_no_cd") {
				$where .= " and lot_no_cd like '%".$txt."%'";
			}
		}

			//투입대기 자재 확인
			$sql3 = "select * from erp_release_input_ready ".$where." limit ".($page-1)*$rpp.", ".$rpp;
			$result33 = mysql_query($sql3);

			$i=0;
			while($t=mysql_fetch_object($result33)){
				
				$re[$i]['uid'] = $t->uid;
				$re[$i]['lot_no_cd'] = $t->lot_no_cd;
				
				$sql55 = "select * from erp_stock_inout where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' and lot_no='".$t->lot_no_cd."' and remark='구매입고' order by create_dt desc"; 
				$t2 = mysql_fetch_object(mysql_query($sql55));

				//echo $sql55."//";
				
				$re[$i]['warehousing_dt'] = substr($t2->in_dt,0,10);
				$re[$i]['regdate'] = substr($t2->create_dt,0,10);
				
				$re[$i]['item_nm'] = $t->item_nm;
				$re[$i]['standard1'] = $t->standard1;
				$re[$i]['unit_price'] = number_format($t2->pur_unit_price);
				

				$sql66 = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
				$t3 = mysql_fetch_object(mysql_query($sql66));
					
				$re[$i]['warehouse_nm'] = $t3 ->warehouse_nm;
				$re[$i]['warehouse_cd'] = $t->warehouse_cd;
				$re[$i]['remain_cnt'] = $t->cnt;
				
				$i++;
		
			}
			

		echo $json->encode($re);
	break;

	/////////////////////////////


	case "get_account_code_remark" :   //적요 리스트
		$where = " where 1=1";
		/*
		if($account_gb == "all") {
			$where .= "";
		} else if($account_gb == "purchase") {
			$where .= " and account_gb='purchase'";
		} else if($account_gb == "sales") {
			$where .= " and account_gb='sales'";
		} else {
			$where .= "";
		}
		
		*/
		$where .= "";
		if($txt != "") {
			if($search_choice == "account_nm") {
				$where .= " and account_nm like '%".$txt."%'";
			} else if($search_choice == "account_cd") {
				$where .= " and account_cd like '%".$txt."%'";
			}
		}

		$query = "select * from erp_account_code_remark".$where;
		
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 1000;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_account_code_remark".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_account_code_remark".$where." order by idx  limit ".($page-1)*$rpp.", ".$rpp;

		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['idx'] = $t->idx;
			$re[$i]['aci_cd'] = $t->aci_cd;
			$re[$i]['remark_code'] = $t->remark_code;
			$re[$i]['remark_name'] = $t->remark_name;
			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
			$ct++;
			//echo $re;
		}

		echo $json->encode($re);
	break;


	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectAccount" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_account_code where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectLotno" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_lot_no where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	

		// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "confirmAccountCode" :
		$query = "select count(*) as cnt from erp_account_code where aci_cd=".$aci_cd;
		//echo $query;
		$query = mysql_query($query); 
		$row = mysql_fetch_array($query);
		$cd_yn=$row['cnt'];
		//echo $cd_yn;
		if ($cd_yn == "0"){
			$result = "success";
		}else{
			$result = "false";
		}
		echo $json->encode($result);
	break;

	////////////////////////////////////////////////////////////////////////////////////////////
	case "LotCheck" : //사용하고있는 로트인지 확인
		$sql = "select * from erp_stock_inout where lot_no='".$lot_no."'";
		$result = mysql_query($sql);

		$row = mysql_num_rows($result);

		$use = false;
		if($row > 0 ){

			$sql2 = "select sum(remain_cnt)as remain_cnt from erp_stock_inout where lot_no='".$lot_no."' and remain_cnt >0 and used='n' ";
			$result2 = mysql_query($sql2);

			while($t = mysql_fetch_object($result2)){ 
							
				if( $t->remain_cnt <= 0 ) $use = true;	//사용한 lot라도 재고없으면 사용가능.
			}
			if($use){
				echo "success";
			}else{
				echo "no";
			}

		}else{
			echo "success";
		}

	break;
	////////////////////////////////////////////////////////////////////////////////////////////
	case "searchItemLot2" :
					//선택한 lot 선입선출 하고 남은 것 create_dt 조회. 방법1 //오류있음.		
		$all_indate = array();
		$in_date = array();
		$in_cnt = array();
		$out_cnt = array();
		$sql = "select * from erp_stock_inout where item_cd='".$item_cd."' and standard1 = '".$standard1."' and lot_no='".$lot_no."' order by create_dt asc";
		$result = mysql_query($sql);

		while($tt = mysql_fetch_object( $result )){
			if( $tt->in_cnt > 0 ){
				array_push($in_date , $tt->create_dt);
				array_push($in_cnt , $tt->in_cnt);
			}
			if($tt->out_cnt >0){
				array_push($out_cnt , $tt->out_cnt);
			}
		}
		
		$inCnt=0;
		$inDate="";
		$outCnt=0;
		for($i = 0 ; $i < sizeof($in_cnt) ; $i++){
			$inCnt = $in_cnt[$i];
			$inDate = $in_date[$i];
			for($k = 0 ; $k < sizeof($out_cnt) ; $k++){
				$remain_cnt = $inCnt  -  $out_cnt[$i] - $outCnt;
				
				if($remain_cnt >0) break 2;
				else $outCnt = $out_cnt[$i] - $inCnt;
			}
		}
			////////////////////////		전체 선입선출 하고 남은 품목 create_dt 조회.				////////////////
		$query = "select sum(in_cnt) as in_cnt , sum(out_cnt) as out_cnt , item_cd , standard1 , lot_no from erp_stock_inout where item_cd='".$item_cd."' and standard1='".$standard1."' group by lot_no, item_cd , standard1 order by uid asc";
		$result22 = mysql_query($query);
		while($result = mysql_fetch_object($result22) ) {
			$remainCnt2 = $result->in_cnt - $result->out_cnt;

			if($remainCnt2 > 0 ){
				$in_date2 = array();
				$in_cnt2 = array();
				$out_cnt2 = array();

				$sql2 = "select * from erp_stock_inout where item_cd='".$result->item_cd."' and standard1 = '".$result->standard1."' and lot_no='".$result->lot_no."' order by create_dt asc";
				$result2 = mysql_query($sql2);

				while($tt2 = mysql_fetch_object( $result2 )){
					if( $tt2->in_cnt > 0 ){
						array_push($in_date2 , $tt2->create_dt);
						array_push($in_cnt2 , $tt2->in_cnt);
					}
					if($tt2->out_cnt >0){
						array_push($out_cnt2 , $tt2->out_cnt);
					}
				}
				
				$inCnt2=0;
				$inDate2="";
				$outCnt2=0;
				for($i = 0 ; $i < sizeof($in_cnt2) ; $i++){
					$inCnt2 = $in_cnt2[$i];
					$inDate2 = $in_date2[$i];
					for($k = 0 ; $k < sizeof($out_cnt2) ; $k++){
						$remain_cnt2 = $inCnt2  -  $out_cnt2[$i] - $outCnt2;
						
						if($remain_cnt2 >0) break 2;
						else $outCnt2 = $out_cnt2[$i] - $inCnt2;
					}
				}
				array_push($all_indate , $inDate2);
			}
		}
		
		$check = false;
		foreach($all_indate as $key => $value){
			//echo "val>>".$value."indate>>".$inDate."<br>         ";

					if($value < $inDate){
						$check = true;
					}
		}

		if($check){
			echo  "더빨리 입고된 lot가 있습니다.";
			
		}else{
			echo "가장 빠른 lot 입니다.";
		}
		
		//echo $inDate;
		
	break;
	////////////////////////////////////////////////////////////////////////////////////

	case "searchItemLot3" : //출고할때 선택한 lot 입고일 조회. 방법2

		//입출고 기록중 재고가 있는것중 제일 빠른 등록일을 가져온다.
		$sql ="select MIN(create_dt) as create_dt from erp_stock_inout where item_cd='".$item_cd."' and standard1='".$standard1."' and lot_no='".$lot_no."' and used='n' and remain_cnt>0 group by item_cd,standard1,warehouse_cd,lot_no";

		$result = mysql_query($sql);
		$tt = mysql_fetch_object( $result );

		$create_dt = $tt->create_dt;

		//해당품목 전체 생성일 조회.
		$query ="select MIN(create_dt) as create_dt from erp_stock_inout where item_cd='".$item_cd."' and standard1='".$standard1."' and used='n' and remain_cnt>0 group by item_cd,standard1,warehouse_cd,lot_no";
		$result22 = mysql_query($query);

		$create_dt2 = array();
		while($tt2 = mysql_fetch_object($result22) ) {
			array_push($create_dt2 , $tt2->create_dt);

		}

		$check = false;
		foreach($create_dt2 as $key => $value){
			//echo "val>>".$value."indate>>".$inDate."<br>";

			if($value < $create_dt){
				$check = true;
			}
		}

		if($check){
			echo  "더빨리 입고된 lot가 있습니다.";
			
		}else{
			echo "가장 빠른 lot 입니다.";
		}

	break;

	////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////

	case "searchItemLot4" : //바코드 출고시에 재고중에서 먼저들어온 품목이 있는지 확인

		$bool = false;
		$sql = "select * from erp_stock_inout where lot_no='".$lot_no."' and used='n' and remain_cnt >0 ";
	
		while($search = mysql_fetch_object(mysql_query($sql))){ //해당 로트가 원자재 인지 확인.

			$sql2 = "select * from erp_item where item_cd='".$search->item_cd."' and standard1='".$search->standard1."'";
			$checkComponent = mysql_fetch_object(mysql_query($sql2));

			if($checkComponent-> item_gb == "component"){
				$item_cd = $checkComponent->item_cd;
				$standard= $checkComponent->standard1;
				$bool = true;
				//echo $item_cd."//".$standard;
				break;
			}else{
				
				$bool = false;
			}
		}
		
		if($bool){

			//입출고 기록중 재고가 있는것중 제일 빠른 등록일을 가져온다.
			$sql ="select MIN(create_dt) as create_dt from erp_stock_inout where item_cd='".$item_cd."' and standard1='".$standard."' and lot_no='".$lot_no."' and used='n' and remain_cnt>0 group by item_cd,standard1,warehouse_cd,lot_no";

			$result = mysql_query($sql);
			$tt = mysql_fetch_object( $result );

			$create_dt = $tt->create_dt;

			//해당품목 전체 생성일 조회.
			$query ="select MIN(create_dt) as create_dt from erp_stock_inout where item_cd='".$item_cd."' and standard1='".$standard."' and used='n' and remain_cnt>0 group by item_cd,standard1,warehouse_cd,lot_no";
			$result22 = mysql_query($query);

			$create_dt2 = array();
			while($tt2 = mysql_fetch_object($result22) ) {
				array_push($create_dt2 , $tt2->create_dt);
			}

			$check = false;
			foreach($create_dt2 as $key => $value){
				//echo "val>>".$value."indate>>".$inDate."<br>";

				if($value < $create_dt){
					$check = true;
				}
			}

			if($check){
				echo  "no";				
			}else{
				echo "yes";
			}
		}
		
	break;

	////////////////////////////////////////////////////////////////////////////////////

	// 출고할때 로트넘버 가져오기
	case "get_lot_no2" :
				
		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  

		$query = "select sum(remain_cnt) as remain_cnt, MIN(create_dt) as create_dt, item_cd , standard1 , lot_no ,work_cd,  warehouse_cd from erp_stock_inout where item_cd='".$item_cd."' and standard1='".$standard1."' and used='n' and remain_cnt >0 ".$where." group by lot_no, work_cd, item_cd , standard1, warehouse_cd order by uid asc";
		//echo $query."<br>";
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {

				$sql3 = "select * from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
				$result2 = mysql_fetch_object(mysql_query($sql3));
				//echo $sql3;
				
				$remain_cnt = $t->remain_cnt;
				//echo $remain_cnt.">><br>";

				if($remain_cnt >0){
					$sql2 = "select * from erp_lot_no where lot_no_cd='".$t->lot_no."'";
					$t2 = mysql_fetch_object( mysql_query($sql2) );

					$no = $rpp * ($page-1) + $ct;
					$re[$i]['no'] = $no;
					//$re[$i]['uid'] = $t->uid;
					$re[$i]['lot_no_cd'] = $t->lot_no;
					//$re[$i]['lot_no_dt'] = $t->lot_no_dt;
					$re[$i]['item_cd'] = $t->item_cd;
					$re[$i]['standard1'] = $t->standard1;
					$re[$i]['remain_cnt'] = $remain_cnt;
					$re[$i]['work_cd'] = $t->work_cd;
					$re[$i]['warehouse_cd'] = $t->warehouse_cd;
					$re[$i]['warehouse_nm'] = $result2->warehouse_nm;
					$re[$i]['create_dt'] = $t->create_dt;
					
					$re[$i]['etc'] = $t2->etc;
					//$re[$i]['regdate'] = $t->regdate;

					$i++;
					$ct++;
					//echo $re;
				}
			
		}

		echo $json->encode($re);
	break;

}
?>