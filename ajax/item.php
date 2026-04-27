<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);
function replaceComma($num) {
	$number = (int)str_replace(",","",$num);
	return $number;
}

function getWarehouseNm($warehouse_cd) {
	$sql = "select warehouse_nm from erp_warehouse where warehouse_cd='".$warehouse_cd."'";
	$t = mysql_fetch_object(mysql_query($sql));
	return $t->warehouse_nm;
}


switch($mode) {
	case "registItemGroup" :
		$query = "
			insert into erp_item_group (
				item_group_cd,
				item_group_nm
			) values (
				'$item_group_cd',
				'$item_group_nm'
			)
		";
		$result = mysql_query($query) or die (mysql_error());
		if($result) echo "success";
	break;

	case "getItemGroup" :
		$query = "select * from erp_item_group".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$query = "select count(*) from erp_item_group".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_item_group".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_group_cd'] = $t->item_group_cd;
			$re[$i]['item_group_nm'] = $t->item_group_nm;
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
	
	// 품목 리스트 가져오기
	case "getItem" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_item".$where." order by uid desc";
		else $query = "select * from erp_item".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['material'] = $t->material;
			$re[$i]['min_pur_unit'] = $t->min_pur_unit;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['delivery_period'] = $t->delivery_period;
			$re[$i]['base_stock_cnt'] = number_format($t->base_stock_cnt);
			$re[$i]['safety_stock_cnt'] = number_format($t->safety_stock_cnt);
			$re[$i]['item_gb'] = $t->item_gb;
			$re[$i]['item_group_cd'] = $t->item_group_cd;
			$re[$i]['item_group_nm'] = $t->item_group_nm;
			$re[$i]['pur_unit_price'] = round($t->pur_unit_price,2);
			$re[$i]['unit_price'] = round($t->unit_price,2);

			// 바코드 이미지 가져오기
			$url = "https://www.barcodesinc.com/generator/image.php?code=".$t->in_barcode."&style=196&type=C128B&width=167&height=70&xres=1&font=3";
			$re[$i]['in_barcode_url'] = $url;
			$img = "<img src='$url'>";

			$re[$i]['in_barcode'] = $img;
			
			// 바코드 이미지 가져오기
			$url = "https://www.barcodesinc.com/generator/image.php?code=".$t->barcode."&style=196&type=C128B&width=167&height=70&xres=1&font=3";
			$img = "<img src='$url'>";
											
			//$re[$i]['barcode'] = $img;
			$re[$i]['barcode'] = $t->barcode;
			$re[$i]['lot_no'] = $t->lot_no;
			$re[$i]['img'] = $t->img;
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectItem" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_item where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectReleaseRequest" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_release_request where uid=".$array_uid[$i];
			mysql_query($query);
			$query = "delete from erp_release_request_item where fid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
	
	
	
	
	// 출고리스트 가져오기
	case "getRelease" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_release".$where." order by uid desc";
		else $query = "select * from erp_release".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$sql = "select remain_cnt from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' ";
			$stock = mysql_fetch_object(mysql_query($sql));

			$re[$i]['uid'] = $t->uid;
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['process'] = getProcessName($t->process);;
			$re[$i]['machine'] = getMachineNm($t->machine);
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['cnt'] = $t->cnt;		
			$re[$i]['remain_cnt'] = $stock->remain_cnt;	
			$re[$i]['emp_nm'] = getEmpNm($t->emp_id);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;

	// 출고품목처리
	case "registRelease" :
		/*
		$sql = "update erp_release set status='complete' where uid=".$uid;
		mysql_query($sql);

		$sql = "select * from erp_release where uid=".$uid;
		$item = mysql_fetch_object(mysql_query($sql));

		// 재고에서 출고를 시킨다 (선입선출)
		// 1. 전량 소비되지 않은 것을 하나 가져온다
		$sql = "select * from erp_stock_inout where item_cd='".$item->item_cd."' and standard='".$item->standard."' and used='n' order by uid desc limit 1";
		$stock = mysql_fetch_object(mysql_query($sql));

		// 2. 출고요청 수량과 가져온 잔여수량과 비교한다
		if($stock->remain_cnt > $item->cnt) { // 잔여수량으로 출고가 가능하다면
			

			// 총재고의 수량도 변경해준다
		} else if($stock->remain_cnt == $item->cnt) {

		} else {

		}
		*/
	break;

	// 전량출고처리
	case "registAllRelease" :
		$require_cnt = str_replace(",","",$require_cnt);
		$remain_cnt = str_replace(",","",$remain_cnt);
		//echo "잔여출고요청수량 : ".$require_cnt;
		//echo "출고수량 : ".$remain_cnt;
		$now = date("Y-m-d");
		$sql = "select * from erp_release where uid=".$uid;
		//echo "1차 : ".$sql;
		$release = fetch_object($sql);
		
		//echo $out_cnt;
		$release_remain = $release->cnt - $remain_cnt;
		if($release_remain <= 0) {
			$sql = "update erp_release set cnt=0, status='complete' where uid=".$uid;
		} else {
			$sql = "update erp_release set cnt=".$release_remain.", status='stay' where uid=".$uid;
		}
		//echo "===================2차 : ".$sql;
		//echo $sql;
		query($sql);
		
		///////// 여기가 좀 문제네.....
		$sql = "select in_cnt,remain_cnt,warehouse_cd from erp_stock_inout where uid=".$stock_uid;
		//echo $sql;
		//echo "===================3차 : ".$sql;
		$inout_stock = fetch_object($sql);

		$inout_stock_remain = $inout_stock->remain_cnt - $release->cnt;
		
		if($inout_stock_remain <= 0) {
			$cnt = 0; // reason 에 입력할 변수
			$sql = "update erp_stock_inout set out_cnt=".$inout_stock->in_cnt.", remain_cnt=0, used='y' where uid=".$stock_uid;
		} else {
			$cnt = $remain_cnt; // reason 에 입력할 변수
			$sql = "update erp_stock_inout set out_cnt=".$release->cnt.", remain_cnt=".$inout_stock_remain.", used='n' where uid=".$stock_uid;
		}
		//echo "===================4차 : ".$sql;
		//echo $sql;
		$result = query($sql);

		$sql = "select * from erp_stock where item_cd='".$release->item_cd."' and standard1='".$release->standard1."' and standard2='".$release->standard2."' and standard3='".$release->standard3."'";
		//echo "===================5차 : ".$sql;
		$stock = fetch_object($sql);

		//echo $stock->remain_cnt;

		$new_cnt = $stock->remain_cnt - $require_cnt;
		
		// 총재고 수량 변경
		if($new_cnt <= 0) $sql = "update erp_stock set remain_cnt=0 where uid=".$stock->uid;
		else $sql = "update erp_stock set remain_cnt=".$new_cnt." where uid=".$stock->uid;
		//echo "===================6차 : ".$sql;
		//echo $sql;
		query($sql);
		
		// 사유
		$sql = "
			insert into erp_reason (
				fid,
				item_cd,
				standard1,
				standard2,
				standard3,
				in_cnt,
				out_cnt,
				reason,
				emp_id,
				create_dt
			) values (
				$stock_uid,
				'$release->item_cd',
				'$release->standard1',
				'$release->standard2',
				'$release->standard3',
				0,
				$release->cnt,
				'생산불출',
				'$_SESSION[login_id]',
				'$now'
			)
		";
		//echo $sql;
		//echo "===================7차 : ".$sql;
		$result = query($sql);

		$sql = "
			insert into erp_warehouse_release (
				warehouse_cd,
				process,
				machine,
				item_cd,
				standard1,
				standard2,
				standard3,
				out_cnt,
				emp_id,
				create_dt
			) values (
				'$inout_stock->warehouse_cd',
				'$release->process',
				'$release->machine',
				'$release->item_cd',
				'$release->standard1',
				'$release->standard2',
				'$release->standard3',
				$release->cnt,
				'$_SESSION[login_id]',
				'$now'
			)
		";
		//echo "===================8차 : ".$sql;
		//echo $sql;
		$result = query($sql);

		if($result) echo "success";
	break;

	// 출고품목처리
	case "registPartRelease" :
		//$sql = "update erp_release set status='complete' where uid=".$uid;
		//mysql_query($sql);

		$sql = "select * from erp_release where uid=".$uid;
		$item = mysql_fetch_object(mysql_query($sql));

		// 재고에서 출고를 시킨다 (선입선출)
		// 1. 전량 소비되지 않은 것을 하나 가져온다
		$sql = "select * from erp_stock_inout where item_cd='".$item->item_cd."' and standard1='".$item->standard1."' and standard2='".$item->standard2."' and standard3='".$item->standard3."' and used='n' order by uid desc limit 1";
		$stock = mysql_fetch_object(mysql_query($sql));

		// 2. 출고요청 수량과 가져온 잔여수량과 비교한다
		if($stock->remain_cnt > $item->cnt) { // 잔여수량으로 출고가 가능하다면
			$remain_cnt = $stock->remain_cnt - $item->cnt;
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
					in_cnt,
					out_cnt,
					remain_cnt,
					pur_unit_price,
					total_price,
					used,
					lot_no,
					reason,
					emp_id,
					create_dt
				) values (
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
					in_cnt,
					out_cnt,
					remain_cnt,
					pur_unit_price,
					total_price,
					used,
					lot_no,
					reason,
					emp_id,
					create_dt
				)
			";
			@mysql_query($sql);

			// 총재고의 수량도 변경해준다
		} else if($stock->remain_cnt == $item->cnt) {

		} else {

		}
	break;
	
	// 부족수량 ??
	case "getShortage" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_item".$where." order by uid desc";
		else $query = "select * from erp_item".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		while($t = mysql_fetch_object($result)) {
			// 해당 품목코드의 현재고수량을 읽어온다.
			
			$query = "select remain_cnt from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' ";
			//echo $query."<BR>";
			$result2 = mysql_query($query);
			$t2 = mysql_fetch_object($result2);
			
			if(!$t2->remain_cnt) $remain_cnt = 0;
			else $remain_cnt = $t2->remain_cnt;
			
			if($t->safety_stock_cnt > $remain_cnt) {
				$re[$i]['uid'] = $t->uid;
				$re[$i]['item_cd'] = $t->item_cd;
				$re[$i]['item_nm'] = $t->item_nm;
				$re[$i]['standard1'] = $t->standard1;
				$re[$i]['standard2'] = $t->standard2;
				$re[$i]['standard3'] = $t->standard3;
				$re[$i]['delivery_period'] = $t->delivery_period;
				$re[$i]['item_gb'] = $t->item_gb;
				$re[$i]['safety_stock_cnt'] = $t->safety_stock_cnt;
				$re[$i]['img'] = $t->img;
				$re[$i]['remain_cnt'] = $remain_cnt;
				$i++;
			}
			
		}

		echo $json->encode($re);
	break;

	case "getItemName" :
		$query = "select item_nm from erp_item where uid=".$uid;
		$result = mysql_query($query);
		$t = mysql_fetch_object($result);
		echo $t->item_nm;
	break;
	
	// 재고실사
	case "modifyStock_old" :
		// 마지막 입고단가를 구한다
		$sql = "select pur_unit_price,lot_no from erp_stock_inout where warehouse_cd='".$warehouse_cd."' and item_cd='".$item_cd."' and standard1='".$standard1."' order by uid desc limit 1";
		$result = @mysql_fetch_object(mysql_query($sql));
		
		if($result->pur_unit_price == "") $pur_unit_price = 0;
		else $pur_unit_price = $result->pur_unit_price;
		
		$total_price = $pur_unit_price * $new_cnt;
		
		if($result->lot_no == "") $lot_no = mt_rand(100000000,999999999);
		else $lot_no = $result->lot_no;

		$sql = "select * from erp_stock_inout where warehouse_cd='".$warehouse_cd."' and item_cd='".$item_cd."' and standard1='".$standard1."' ";
		$result = mysql_query($sql);

		// 모든 재고를 0 처리한다
		while($t = mysql_fetch_object($result)) {
			$sql = "update erp_stock_inout set out_cnt=".$t->in_cnt.",remain_cnt=0,used='y' where uid=".$t->uid;
			//echo $sql;
			mysql_query($sql);
		}
		
		$sql = "
			insert into erp_stock_inout (
				purchase_cd,
				order_cd,
				work_cd,
				project_cd,
				account_cd,
				warehouse_cd,
				workplan_cd,
				item_cd,
				standard1,
				standard2,
				standard3,
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
				'$warehouse_cd',
				'',
				'$item_cd',
				'$standard1',
				'$standard2',
				'$standard3',
				$new_cnt,
				0,
				$new_cnt,
				$pur_unit_price,
				$total_price,
				'n',
				'$lot_no',
				'$_SESSION[login_id]',
				'$now'
			)
		";

		//echo $sql;
		$result = mysql_query($sql) or die (mysql_error());

		$fid = mysql_insert_id();

		$sql = "insert into erp_reason (fid, item_cd, standard1, standard2, standard3, in_cnt, out_cnt, reason, emp_id, create_dt) values (".$fid.", '".$item_cd."', '".$standard1."', '".$standard2."', '".$standard3."', ".$new_cnt.", 0, '재고실사', '".$_SESSION['login_id']."', now())";
		mysql_query($sql);

		$sql = "select sum(remain_cnt) as remain_cnt from erp_stock_inout where item_cd='".$item_cd."' and standard1='".$standard1."' ";
		$result = mysql_fetch_object(mysql_query($sql));

		$sql = "update erp_stock set pur_unit_price=".$pur_unit_price.", remain_cnt=".$result->remain_cnt." where item_cd='".$item_cd."' and standard1='".$standard1."' ";
		$result = mysql_query($sql);

		if($result) echo "success";
	break;


	// 재고조정 // 기존코드
	case "modifyStock" :

		$now = date("Y-m-d H:i:s");
		//*20180409 재고 조정 수정하다가 임시 중지

		$sql = "select * from erp_stock where item_cd='".$item_cd."' and standard1='".$standard."' and warehouse_cd='".$warehouse_cd."' "; //창고별 재고현황 쿼리중 창고재고가 있는경우
		//echo $sql;
		$result = mysql_query($sql);
			if(@mysql_num_rows($result) > 0) { // 등록된 창고 재고창고가 있다면
				
				$sql = "select * from erp_stock where item_cd='".$item_cd."' and standard1='".$standard."' and warehouse_cd='".$warehouse_cd."' ";
				$r_cnt = @mysql_fetch_object(mysql_query($sql));
				
				$remain_cnt = $r_cnt->remain_cnt + replaceComma($new_cnt);
				
				$sql = "update erp_stock set pur_cnt=".$new_cnt.",remain_cnt=".$new_cnt." where item_cd='".$item_cd."' and standard1='".$standard."' and warehouse_cd='".$warehouse_cd."' ";
				//echo $sql;
				mysql_query($sql);

			}else{                        // 등록된 창고 재고창고가 없다면
				$sql = "select * from erp_stock where item_cd='".$item_cd."' and standard1='".$standard."' ";
				$r_cnt = @mysql_fetch_object(mysql_query($sql));
				
				$remain_cnt = $r_cnt->remain_cnt + replaceComma($new_cnt);
				
				$sql = "update erp_stock set pur_cnt=".$new_cnt.",remain_cnt=".$new_cnt." where item_cd='".$item_cd."' and standard1='".$standard."'";
				//echo $sql;
				mysql_query($sql);
			}

			// 전체 inout에 넣기
			$sql = "insert into erp_stock_inout (item_cd, warehouse_cd, standard1, material, unit, in_cnt, out_cnt, pur_unit_price, total_price, remain_cnt, lot_no, account, remark, create_dt) value(
			'$r_cnt->item_cd','$r_cnt->warehouse_cd','$r_cnt->standard1','$r_cnt->material','$r_cnt->unit','replaceComma($r_cnt->new_cnt)','replaceComma($r_cnt->out_cnt)','replaceComma($r_cnt->pur_unit_price)','replaceComma($r_cnt->total_price','$r_cnt->remain_cnt','$r_cnt->lot_no_cd','재고조정','재고조정','$now')";
			//echo $sql;
			$result = mysql_query($sql) or die (mysql_error());
			if($result) echo "success";

			//exit;
		//*/
		
	break;

	// 재고조정// 작성 백승현.
	case "modifyStock2" :

		if($remain_cnt != $new_cnt){

			$sql11 = "select * from erp_stock where warehouse_cd='".$warehouse_cd."' and item_cd='".$item_cd."' and standard1='".$standard1."' and warehouse_cd='".$warehouse_cd."' and warehouse_nm='".$warehouse_nm."'";
			//echo $sql11."////////////";

			$result11 = mysql_query($sql11);
			$t11 = mysql_fetch_object($result11);
	
			if( $remain_cnt < $new_cnt ){	//재고를 증가시킴.

				//erp_stock
				$increase_cnt = $new_cnt - $remain_cnt;	//증가된 갯수.
				$remain_Update = $t11->remain_cnt + $increase_cnt;

				$sql22 = "update erp_stock set remain_cnt='".$remain_Update."' where uid='".$t11->uid."'";
				$result22 = mysql_query($sql22);
				
				//erp_stock_inout
				$sql33 = "select * from erp_stock_inout where warehouse_cd='".$warehouse_cd."' and item_cd='".$item_cd."' and standard1='".$standard1."' and lot_no='".$lot_no."' and used='n' and remain_cnt >0 order by create_dt desc";
				$result33 = mysql_query($sql33);
				$t22 = mysql_fetch_object($result33);

				// 새로운 창고로 이동
				$sql77 = "
					insert into erp_stock_inout (
						purchase_cd,
						order_cd,
						warehousing_cd,
						work_cd,
						project_cd,
						account_cd,
						warehouse_cd,
						workplan_cd,
						item_cd,
						standard1,
						unit,
						in_cnt,
						out_cnt,
						used,
						remain_cnt,
						in_dt,
						pur_unit_price,
						total_price,
						lot_no,
						account,
						remark,
						emp_id,
						create_dt
					) values (
						'$t22->purchase_cd',
						'$t22->order_cd',
						'$t22->warehousing_cd',
						'$t22->work_cd',
						'$t22->project_cd',
						'$t22->account_cd',
						$warehouse_cd,
						'$t22->workplan_cd',
						'$t22->item_cd',
						'$t22->standard1',
						'$t22->unit',
						$increase_cnt,
						0,
						'n',
						$increase_cnt,
						now(),
						$t22->pur_unit_price,
						$t22->total_price,
						'$lot_no',
						'재고조정입고',
						'재고조정입고',
						'$_SESSION[login_id]',
						now()
					)";
				//echo $sql77;
				mysql_query($sql77);

			
			}else{	//재고를 감소시킴

				$decrease_cnt = $remain_cnt - $new_cnt;	//감소된 갯수.//출고되야할 수량
				$remainUpdate = $t11->remain_cnt - $decrease_cnt;

				$sql22 = "update erp_stock set remain_cnt='".$remainUpdate ."' where uid='".$t11->uid."'";
				$result22 = mysql_query($sql22);

				//erp_stock_inout
				$sql33 = "select * from erp_stock_inout where warehouse_cd='".$warehouse_cd."' and item_cd='".$item_cd."' and standard1='".$standard1."' and lot_no='".$lot_no."' and used='n' and remain_cnt >0 order by create_dt desc";
				$result33 = mysql_query($sql33);


				while($r_cnt2 = mysql_fetch_object($result33)){
								
					$in_Remain_cnt = $r_cnt2->remain_cnt - $decrease_cnt; //잔여수량 - 출고되야할 남은수량
															
					//echo $remain_cnt;
					if( $in_Remain_cnt <= 0 ){
						// 해당 입고된것 모두 사용했을때.(해당 재고가 부족..)


						// 차감된 기록 insert
						$sql77 = "
							insert into erp_stock_inout (
								purchase_cd,
								order_cd,
								warehousing_cd,
								work_cd,
								project_cd,
								account_cd,
								warehouse_cd,
								workplan_cd,
								item_cd,
								standard1,
								unit,
								in_cnt,
								out_cnt,
								used,
								remain_cnt,
								out_dt,
								pur_unit_price,
								total_price,
								lot_no,
								account,
								remark,
								emp_id,
								create_dt
							) values (
								'$r_cnt2->purchase_cd',
								'$r_cnt2->order_cd',
								'$r_cnt2->warehousing_cd',
								'$r_cnt2->work_cd',
								'$r_cnt2->project_cd',
								'$r_cnt2->account_cd',
								$warehouse_cd,
								'$r_cnt2->workplan_cd',
								'$r_cnt2->item_cd',
								'$r_cnt2->standard1',
								'$r_cnt2->unit',
								0,
								$r_cnt2->remain_cnt,
								'y',
								0,
								now(),
								$r_cnt2->pur_unit_price,
								$r_cnt2->total_price,
								'$lot_no',
								'재고조정차감',
								'재고조정차감',
								'$_SESSION[login_id]',
								now()
							)";
						//echo $sql77;
						mysql_query($sql77);

						$sql = "update erp_stock_inout set remain_cnt='0', used='y' where uid='".$r_cnt2->uid."'";
						mysql_query($sql);

						$decrease_cnt = $decrease_cnt - $r_cnt2->remain_cnt;//출고되야할 잔여수량

					}else{

						// 차감된 기록 insert
						$sql77 = "
							insert into erp_stock_inout (
								purchase_cd,
								order_cd,
								warehousing_cd,
								work_cd,
								project_cd,
								account_cd,
								warehouse_cd,
								workplan_cd,
								item_cd,
								standard1,
								unit,
								in_cnt,
								out_cnt,
								used,
								remain_cnt,
								out_dt,
								pur_unit_price,
								total_price,
								lot_no,
								account,
								remark,
								emp_id,
								create_dt
							) values (
								'$r_cnt2->purchase_cd',
								'$r_cnt2->order_cd',
								'$r_cnt2->warehousing_cd',
								'$r_cnt2->work_cd',
								'$r_cnt2->project_cd',
								'$r_cnt2->account_cd',
								$warehouse_cd,
								'$r_cnt2->workplan_cd',
								'$r_cnt2->item_cd',
								'$r_cnt2->standard1',
								'$r_cnt2->unit',
								0,
								$decrease_cnt,
								'y',
								0,
								now(),
								$r_cnt2->pur_unit_price,
								$r_cnt2->total_price,
								'$lot_no',
								'재고조정차감',
								'재고조정차감',
								'$_SESSION[login_id]',
								now()
							)";
						//echo $sql77;
						mysql_query($sql77);

						$sql = "update erp_stock_inout set remain_cnt='".$in_Remain_cnt."', used='n' where uid='".$r_cnt2->uid."'";
						mysql_query($sql);
						break;
					}
				}//while 닫음
			
			}
		}




		echo "success";
	break;

	// 창고이동	// 기존코드 
	case "moveWarehouseItem" :
		// 먼저 보내는 창고의 재고수량을 확인한다
		$sql = "select * from erp_stock_inout where warehouse_cd='".$from."' and item_cd='".$item_cd."' and standard1='".$standard1."' ";
		//echo $sql."////////////";
		$result = mysql_query($sql);
		$sum = 0;

		while($t = mysql_fetch_object($result)) {
			$sum = $sum + $t->remain_cnt;
			
			//if($t->lot_no == "") $lot_no = mt_rand(100000000,999999999);
			//else $lot_no = $t->lot_no;

			$total_price = $t->pur_unit_price * $move_cnt;

			if($t->remain_cnt > $move_cnt) { // 해당 창고의 재고가 이동 수량보다 많으면
				$remain_cnt = $t->remain_cnt - $move_cnt;
				$sql = "update erp_stock_inout set out_cnt=".$move_cnt.", remain_cnt=".$remain_cnt." where uid=".$t->uid;
				mysql_query($sql);

				// 새로운 창고로 이동
				$sql = "
					insert into erp_stock_inout (
						purchase_cd,
						order_cd,
						work_cd,
						project_cd,
						account_cd,
						warehouse_cd,
						workplan_cd,
						item_cd,
						standard1,
						standard2,
						standard3,
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
						'$t->work_cd',
						'$t->project_cd',
						'$t->account_cd',
						'$to',
						'$t->workplan_cd',
						'$t->item_cd',
						'$t->standard1',
						'$t->standard2',
						'$t->standard3',
						$move_cnt,
						0,
						$move_cnt,
						$t->pur_unit_price,
						$total_price,
						'n',
						'$lot_no',
						'$_SESSION[login_id]',
						now()
					)
				";
				//echo $sql;
				mysql_query($sql);
				
				$fid = mysql_insert_id();
				
				$from_warehouse = getWarehouseName($from);
				$to_warehouse = getWarehouseName($to);

				// 출고 사유 기록
				$sql = "
					insert into erp_reason (
						fid,
						item_cd,
						standard1,
						standard2,
						standard3,
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
						0,
						$move_cnt,
						'$to_warehouse 창고로 이동',
						'$_SESSION[login_id]',
						now()
					)
				";
				mysql_query($sql);

				// 입고 사유 기록
				$sql = "
					insert into erp_reason (
						fid,
						item_cd,
						standard1,
						standard2,
						standard3,
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
						$move_cnt,
						0,
						'$form_warehouse 창고에서 이동',
						'$_SESSION[login_id]',
						now()
					)
				";
				mysql_query($sql);

			} else if($t->remain_cnt == $move_cnt) { // 해당 창고의 재고수량과 이동 수량이 같다면
				$sql = "update erp_stock_inout set out_cnt=".$move_cnt.", remain_cnt=0, used='y' where uid=".$t->uid;
				mysql_query($sql);
				
				// 새로운 창고로 이동
				$sql = "
					insert into erp_stock_inout (
						purchase_cd,
						order_cd,
						work_cd,
						project_cd,
						account_cd,
						warehouse_cd,
						workplan_cd,
						item_cd,
						standard1,
						standard2,
						standard3,
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
						'$t->work_cd',
						'$t->project_cd',
						'$t->account_cd',
						'$to',
						'$t->workplan_cd',
						'$t->item_cd',
						'$t->standard1',
						'$t->standard2',
						'$t->standard3',
						$move_cnt,
						0,
						$move_cnt,
						$t->pur_unit_price,
						$total_price,
						'n',
						'$lot_no',
						'$_SESSION[login_id]',
						now()
					)
				";
				mysql_query($sql);
				
				$fid = mysql_insert_id();
				
				$from_warehouse = getWarehouseName($from);
				$to_warehouse = getWarehouseName($to);

				// 출고 사유 기록
				$sql = "
					insert into erp_reason (
						fid,
						item_cd,
						standard1,
						standard2,
						standard3,
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
						0,
						$move_cnt,
						'$to_warehouse 창고로 이동',
						'$_SESSION[login_id]',
						now()
					)
				";
				mysql_query($sql);

				// 입고 사유 기록
				$sql = "
					insert into erp_reason (
						fid,
						item_cd,
						standard1,
						standard2,
						standard3,
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
						$move_cnt,
						0,
						'$form_warehouse 창고에서 이동',
						'$_SESSION[login_id]',
						now()
					)
				";
				mysql_query($sql);
			} else { // 재고 수량이 이동 수량보다 적으면
				$sql = "update erp_stock_inout set out_cnt=".$t->remain_cnt.", remain_cnt=0, used='y' where uid=".$t->uid;
				mysql_query($sql);

				$total = $t->remain_cnt * $t->pur_unit_price;
				
				// 새로운 창고로 이동
				$sql = "
					insert into erp_stock_inout (
						purchase_cd,
						order_cd,
						work_cd,
						project_cd,
						account_cd,
						warehouse_cd,
						workplan_cd,
						item_cd,
						standard1,
						standard2,
						standard3,
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
						'$t->work_cd',
						'$t->project_cd',
						'$t->account_cd',
						'$to',
						'$t->workplan_cd',
						'$t->item_cd',
						'$t->standard1',
						'$t->standard2',
						'$t->standard3',
						$t->remain_cnt,
						0,
						$t->remain_cnt,
						$t->pur_unit_price,
						$total_price,
						'n',
						'$lot_no',
						'$_SESSION[login_id]',
						now()
					)
				";
				mysql_query($sql);
				
				$fid = mysql_insert_id();
				
				$from_warehouse = getWarehouseName($from);
				$to_warehouse = getWarehouseName($to);

				// 출고 사유 기록
				$sql = "
					insert into erp_reason (
						fid,
						item_cd,
						standard1,
						standard2,
						standard3,
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
						0,
						$t->remain_cnt,
						'$to_warehouse 창고로 이동',
						'$_SESSION[login_id]',
						now()
					)
				";
				mysql_query($sql);

				// 입고 사유 기록
				$sql = "
					insert into erp_reason (
						fid,
						item_cd,
						standard1,
						standard2,
						standard3,
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
						$t->remain_cnt,
						0,
						'$form_warehouse 창고에서 이동',
						'$_SESSION[login_id]',
						now()
					)
				";
				mysql_query($sql);
				
				// 잔여이동수량 업데이트
				$move_cnt = $move_cnt - $t->remain_cnt;
			}
		}

		echo "success";
	break;
	
	
	// 창고이동 //새로작성 백승현
	case "moveWarehouseItem2" :
		if($to != $from){

		//echo $from.$to.$item_cd.$standard1.$move_cnt.$lot_no;
		// 먼저 보내는 창고의 재고수량을 줄여준다
			$sql11 = "select * from erp_stock where warehouse_cd='".$from."' and item_cd='".$item_cd."' and standard1='".$standard1."' ";
			//echo $sql11."////////////";
			$result11 = mysql_query($sql11);
			$t11 = mysql_fetch_object($result11);
			$remain_cnt22 = $t11->remain_cnt - $move_cnt; 
			
			$sql22 = "update erp_stock set remain_cnt='".$remain_cnt22."' where uid='".$t11->uid."'";
			$result22 = mysql_query($sql22);


		//받는곳의 창고의 재고수량을 늘려준다.
			$sql55 = "select * from erp_stock where warehouse_cd='".$to."' and item_cd='".$item_cd."' and standard1='".$standard1."' ";
			$result55 = mysql_query($sql55);

			if( mysql_num_rows( $result55 ) >0 ){	// 옮기려는 창고에 이미 재고가 존재한다는뜻.
				$t55= mysql_fetch_object($result55);
				$remain_cnt55 = $t55->remain_cnt + $move_cnt;

				$sql66 = "update erp_stock set remain_cnt='".$remain_cnt55."' where uid='".$t55->uid."' ";
				//echo $sql66;
				$result66 = mysql_query($sql66);
			}else{ // 창고에 재고가 존재하지 않음.
				
				$sql66 =  "
						insert into erp_stock (
							fid,
							item_cd,
							item_nm,
							standard1,
							unit,
							remain_cnt,
							warehouse_cd,
							warehouse_nm,
							material,
							pur_cnt,
							pur_unit_price,
							in_date
						) values (
							'$t11->fid',
							'$t11->item_cd',
							'$t11->item_nm',
							'$t11->standard1',
							'$t11->unit',
							'$move_cnt',
							'$to',
							'$warehouse_nmTo',
							'$t11->material',
							'$t11->pur_cnt',
							'$t11->pur_unit_price',
							'$t11->in_date'
						)";

				$result66 = mysql_query($sql66);
			}

		//////////// stock_inout 처리////////////
		$sql33 = "select * from erp_stock_inout where warehouse_cd='".$from."' and item_cd='".$item_cd."' and standard1='".$standard1."' and lot_no='".$lot_no."' and used='n' order by create_dt asc";
		$result33 = mysql_query($sql33);

		$out_Remaincnt = $move_cnt;	//출고되야할 수량.
		$reamin_cnt33 ="";		//갖고있는 남은수량.
		
		while($t33 = mysql_fetch_object($result33)){
			//echo "출고잔여".$out_Remaincnt."<br>";
		
			if( $t33->remain_cnt >= $out_Remaincnt ){	//출고되야할 남은수량없음.
				
				$reamin_cnt33 = $t33->remain_cnt - $out_Remaincnt; //갖고있는 남은수량.
				
				if($t33->remain_cnt > $out_Remaincnt){
				//echo "크다<br>";

					$sql44 = "update erp_stock_inout set remain_cnt='".$reamin_cnt33."' where uid='".$t33->uid."'";
					$result44 = mysql_query($sql44);
				}else{
					//echo "  같다<br>";
					$sql44 = "update erp_stock_inout set remain_cnt='".$reamin_cnt33."' , used='y'  where uid='".$t33->uid."'";
					$result44 = mysql_query($sql44);

				}

				// 새로운 창고로 이동
				$sql77 = "
					insert into erp_stock_inout (
						purchase_cd,
						order_cd,
						warehousing_cd,
						work_cd,
						project_cd,
						account_cd,
						warehouse_cd,
						workplan_cd,
						item_cd,
						standard1,
						unit,
						in_cnt,
						out_cnt,
						used,
						remain_cnt,
						in_dt,
						pur_unit_price,
						total_price,
						lot_no,
						account,
						remark,
						emp_id,
						create_dt
					) values (
						'$t33->purchase_cd',
						'$t33->order_cd',
						'$t33->warehousing_cd',

						'$t33->work_cd',
						'$t33->project_cd',
						'$t33->account_cd',
						'$to',
						'$t33->workplan_cd',
						'$t33->item_cd',
						'$t33->standard1',
						'$t33->unit',
						'$out_Remaincnt',
						0,
						'n',
						$out_Remaincnt,
						'$t33->in_dt',
						$t33->pur_unit_price,
						$t33->total_price,
						'$lot_no',
						'창고이동입고',
						'창고이동입고',
						'$_SESSION[login_id]',
						now()
					)";
				//echo $sql77;
				mysql_query($sql77);


				//////사유등록/////
				$fid = mysql_insert_id();
				$from_warehouse = getWarehouseName($from);
				$to_warehouse = getWarehouseName($to);

				//출고 사유 기록
				$sql = "
					insert into erp_reason (
						fid,
						item_cd,
						standard1,
						standard2,
						standard3,
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
						0,
						$out_Remaincnt,
						'$to_warehouse 창고로 이동',
						'$_SESSION[login_id]',
						now()
					)
				";
				mysql_query($sql);

				//입고 사유 기록
				$sql = "
					insert into erp_reason (
						fid,
						item_cd,
						standard1,
						standard2,
						standard3,
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
						$out_Remaincnt,
						0,
						'$form_warehouse 창고에서 이동',
						'$_SESSION[login_id]',
						now()
					)
				";
				mysql_query($sql);

				break;

			}else{
				//echo "  작다 <br>";
				$out_Remaincnt = $out_Remaincnt - $t33->remain_cnt;	//출고되야 할 남은수량.
				
				$sql44 = "update erp_stock_inout set remain_cnt='0' , used='y'  where uid='".$t33->uid."'";
				$result44 = mysql_query($sql44);

				// 새로운 창고로 이동
				$sql77 = "
					insert into erp_stock_inout (
						purchase_cd,
						order_cd,
						warehousing_cd,
						work_cd,
						project_cd,
						account_cd,
						warehouse_cd,
						workplan_cd,
						item_cd,
						standard1,
						unit,
						in_cnt,
						out_cnt,
						used,
						remain_cnt,
						in_dt,
						pur_unit_price,
						total_price,
						lot_no,
						account,
						remark,
						emp_id,
						create_dt
					) values (
						'$t33->purchase_cd',
						'$t33->order_cd',
						'$t33->warehousing_cd',

						'$t33->work_cd',
						'$t33->project_cd',
						'$t33->account_cd',
						'$to',
						'$t33->workplan_cd',
						'$t33->item_cd',
						'$t33->standard1',
						'$t33->unit',
						$t33->remain_cnt,
						0,
						'n',
						$t33->remain_cnt,
						'$t33->in_dt',
						$t33->pur_unit_price,
						$t33->total_price,
						'$lot_no',
						'창고이동입고',
						'창고이동입고',
						'$_SESSION[login_id]',
						now()
					)";
				//echo $sql77;
				mysql_query($sql77);


				//////사유등록/////
				
				$fid = mysql_insert_id();
				$from_warehouse = getWarehouseName($from);
				$to_warehouse = getWarehouseName($to);

				//출고 사유 기록
				$sql = "
					insert into erp_reason (
						fid,
						item_cd,
						standard1,
						standard2,
						standard3,
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
						0,
						$t33->remain_cnt,
						'$to_warehouse 창고로 이동',
						'$_SESSION[login_id]',
						now()
					)
				";
				mysql_query($sql);

				//입고 사유 기록
				$sql = "
					insert into erp_reason (
						fid,
						item_cd,
						standard1,
						standard2,
						standard3,
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
						$t33->remain_cnt,
						0,
						'$form_warehouse 창고에서 이동',
						'$_SESSION[login_id]',
						now()
					)
				";
				mysql_query($sql);
			}
		}
	}
		echo "success";
	break;


	// 출고 리스트 NEW
	case "getReleaseRequest" :

		$where = " where 1=1";
		
		if($search_txt != "") {
			$where .= " and (release_cd like '%".$search_txt."%' or emp_id like '%".$search_txt."%')";
		}

		if($start_dt != "" && $end_dt != "") {
			$where .= " AND ( left(release_dt,10) between '".$start_dt."' and '".$end_dt."')";
		}

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_release_request".$where." order by uid desc";
		else $query = "select * from erp_release_request".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query."<br>";
		$result = mysql_query($query);
		
		$total_num = mysql_num_rows($result);

		$i = 0;
		$ct = 1;
		$cnt=="";
		while($t = mysql_fetch_object($result)) {
			$query = "select * from erp_release_request_item where rid=".$t->uid." order by uid";
			//echo $query;
			$result2 = mysql_query($query);
			$item_cnt = mysql_num_rows($result2);
			$sum = 0;
			//$cnt = "0";
				while($t2 = mysql_fetch_object($result2)) {
					$sum			= $sum + $t2->total_price;
					$release_cd		= $t->release_cd;
					$wh_cd_t_cd		= $t->wh_cd_t_cd;
					$wh_cd_t_nm		= $t->wh_cd_t_nm;
					$work_cd		= $t->work_cd;
					$item_nm		= $t2->item_nm;
					$standard1		= $t2->standard1;
					$lot_no_cd		= $t2->lot_no_cd;
					$cnt			= $t2->cnt;
					$shortage_cnt		= $t2->shortage_cnt;
					$inspection_cd		= $t2->inspection_cd;
					$warehouse_cd		= $t2->warehouse_cd;
					$warehouse_nm		= $t2->warehouse_nm;
						
				}
			if ($item_cnt > "1"){
				$cnt_text = " 외 ".($item_cnt-1)."건";
				$cnt_text2 = " 외 ".($item_cnt-1)."곳";
			}else{
				$cnt_text ="";
				$cnt_text2 = "";
			}
			

			$query = "select warehouse_nm from erp_warehouse where warehouse_cd='".$t->warehouse_cd."'";
			$warehouse = mysql_fetch_object(mysql_query($query));
			

			$query = "select faulty_cnt, faulty_content from erp_receiving_inspection where inspection_cd='".$inspection_cd."'";
			//echo $query;
			$t3 = mysql_fetch_object(mysql_query($query));

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['release_cd'] = $t->release_cd;
			$re[$i]['release_dt'] = substr($t->release_dt,0,10);
			$re[$i]['wh_cd_t_cd'] = $t->wh_cd_t_cd;
			$re[$i]['wh_cd_t_nm'] = $t->wh_cd_t_nm;
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['manager'] = $t->manager;
			//$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['warehouse_nm'] = $warehouse_nm;
			$re[$i]['memo'] = $t->memo;
			$re[$i]['cntTotal'] = number_format($t->cntTotal);
			if($t->state=="0"){
				$state="대기중";	
			}else if($t->state=="1"){
				$state="진행중";	
			}else if($t->state=="2"){
				$state="출고완료";	
			}else if($t->state=="3"){
				$state="출고취소";	
			}else{ 
				$state="대기중";
			}
			$re[$i]['state'] = $state;
			$re[$i]['cnt'] = $cnt;
			$re[$i]['cnt_text'] = $cnt_text;
			$re[$i]['cnt_text2'] = $cnt_text2;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['item_nm'] = $item_nm;
			$re[$i]['item_cd'] = $item_cd;
			$re[$i]['standard1'] = $standard1;
			$re[$i]['lot_no_cd'] = $lot_no_cd;
			$re[$i]['shortage_cnt'] = $shortage_cnt;

			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
	
	//작업지시서 ITEM 가져오기
	case "getWorkReleaseRequest" :
		
		$query = "select * from erp_work_item where wid ='".$wid."' order by uid desc";
		//echo $query."<BR>";
		$result = mysql_query($query);
	
		$i = 0;
		while($t = @mysql_fetch_object($result)) {

				$sql = "select uid from erp_item where item_cd='".addslashes($t->item_cd)."' and standard1='".addslashes($t->standard1)."'";
				//echo  $sql."<BR>";
				$item = mysql_fetch_object(mysql_query($sql));

				if ($item->uid !=""){
				$query1 = "select * from erp_bom where fid='".$item->uid."'";
				//echo $query1."<BR>";
				$result1 = mysql_query($query1);

				$j = 0;
				while($t2 = @mysql_fetch_object($result1)) {

				//출고할 창고의 현재 재고
				$sql2 = "select sum(remain_cnt)as remain_cnt from erp_stock_inout where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."' and used='n' and remain_cnt >0 ";  //and warehouse_cd='".$t1->warehouse_cd."'
				//echo $sql2."<BR><BR>"; 
				$ccnt = @mysql_fetch_object(mysql_query($sql2));
				 //////////////////
				$cnt = 1;

				$total_cnt = $cnt;

				
				// 재고수량
				$remain_cnt = $ccnt->remain_cnt;
				//공급가액 계산
				$supply_price = $total_cnt * $t->unit_price;
				$tax = $supply_price / 10; 
				
				$total_price = $supply_price + $tax;

				$sql3 = "select lot_no_cd from erp_warehousing_lot_no where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."'";
				//echo $sql3."<BR><BR>"; 
				$t3 = @mysql_fetch_object(mysql_query($sql3));

				if($t3->lot_no_cd=="" || $t->lot_no_cd=="null"){
					$lot_no_cd = "";
				}else{
					$lot_no_cd = $t3->lot_no_cd;
				}
				
				if($t3->lot_no_nm=="" || $t3->lot_no_cd=="null"){
					$lot_no_nm = "";
				}else{
					$lot_no_nm = $t3->lot_no_nm;
				}
				
				if($t3->regdate=="" || $t3->lot_no_cd=="null"){
					$regdate = "미입고";
				}else{
					$regdate = $t3->regdate;
				}

				$re[$j]['uid']			= $t->uid;
				$re[$j]['item_cd']		= $t2->item_cd;
				$re[$j]['item_nm']		= $t2->item_nm;
				$re[$j]['standard1']		= $t2->standard1;
				$re[$j]['material']		= $t2->material;
				$re[$j]['unit']			= $t2->unit;
				$re[$j]['remain_cnt']		= $remain_cnt;
				$re[$j]['cnt']			= number_format(round($ccnt->remain_cnt,0));
				$re[$j]['lot_no_cd']		= $lot_no_cd;
				$re[$j]['lot_no_nm']		= $lot_no_nm;
				$re[$j]['regdate_item']		= substr($regdate,0,10);
				$re[$j]['regdate']		= substr($t->create_dt,0,10);
				$j++;
				
				}
			}
			$i++;
		}
		
		echo $json->encode($re);
	break;

	//작업지시서 ITEM 가져오기2 //새로 제작.2019.01.16
	case "getWorkReleaseRequest2" :
		
		$query = "select * from erp_work_item where wid ='".$wid."' order by uid desc";
		//echo $query."<BR>";
		$result = mysql_query($query);
	
		$i = 0;
		$item_cd100 = Array();
		$item_nm100 = Array();
		$standard100 = Array();		
		$material100 = Array();
		$unit100 = Array();

		while($t = @mysql_fetch_object($result)) {

				$sql = "select uid from erp_item where item_cd='".addslashes($t->item_cd)."' and standard1='".addslashes($t->standard1)."'";
				//echo  $sql."<BR>";
				$item = mysql_fetch_object(mysql_query($sql));

				if ($item->uid !=""){
				$query1 = "select * from erp_bom where fid=".$item->uid."";
				//echo $query1."<BR>";
				$result1 = mysql_query($query1);

					while($t2 = @mysql_fetch_object($result1)){

						array_push($item_cd100,$t2->item_cd );
						array_push($item_nm100,$t2->item_nm );
						array_push($standard100,$t2->standard1 );
						array_push($material100,$t2->material );
						array_push($unit100,$t2->unit );

						array_push($order_cnt100,$t->order_cnt * $t2->cnt );
					}
				}

			$i++;
		
		}
				
				
		for($j=0 ; $j < sizeof($item_cd100) ; $j++){
			//출고할 창고의 현재 재고
			$sql2 = "select sum(remain_cnt)as remain_cnt from erp_stock_inout where item_cd='".$item_cd100[$j]."' and standard1='".$standard100[$j]."' and used='n' and remain_cnt >0 ";  //and warehouse_cd='".$t1->warehouse_cd."'
			//echo $sql2."<BR><BR>"; 
			$ccnt = @mysql_fetch_object(mysql_query($sql2));
			 //////////////////
			$cnt = 1;

			$total_cnt = $cnt;

			
			// 재고수량
			if($ccnt->remain_cnt != null){
			$remain_cnt = $ccnt->remain_cnt;
			}else{
			$remain_cnt =0;
			}

			$re[$j]['item_cd']		= $item_cd100[$j];
			$re[$j]['item_nm']		= $item_nm100[$j];
			$re[$j]['standard1']		= $standard100[$j];
			$re[$j]['material']		= $material100[$j];
			$re[$j]['unit']			= $unit100[$j];
			$re[$j]['remain_cnt']		= $remain_cnt;
			$re[$j]['cnt']			= round($order_cnt100[$j]);

		}	
			
		echo $json->encode($re);
	break;

		// 출고서 리스트 ITEM NEW
	case "getWorkReleaseRequestItem" :
		$query = "select * from erp_release_request_item where rid='".$uid."'";
		//echo $query;
		$result77 = mysql_query($query);

		$i=0;

		while($t = mysql_fetch_object($result77)) {

			$total_cnt = $t->cnt ;
			$supply_price = $total_cnt * $t->unit_price;
			$tax = $supply_price / 10; 
			$total_price = $supply_price + $tax;

			// 발주서 등록시 재고수량 다시 계산
			$sql2 = "select remain_cnt from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' ";
			$result  = mysql_query($sql2);
			$ccnt = @mysql_fetch_object($result);

			
			
				
			$re[$i]['remain_cnt'] = number_format($ccnt->remain_cnt);
			
			
			if($state != "0"){
				$re[$i]['cnt'] = number_format($t->cnt);
				$re[$i]['lot_no_cd'] = $t->lot_no_cd;
				$re[$i]['lot_no_nm'] = $t->lot_no_nm;
				$re[$i]['warehouse_cd'] = $t->warehouse_cd;
				$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			}else{
				$re[$i]['cnt'] = "";
				$re[$i]['lot_no_cd'] = "";
				$re[$i]['lot_no_nm'] = "";
				$re[$i]['warehouse_cd'] = "";
				$re[$i]['warehouse_nm'] = "";
			}

			$re[$i]['uid'] = $t->uid;
			$re[$i]['rid'] = $t->rid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			
			$re[$i]['unit_price'] = number_format($t->unit_price);
			$re[$i]['supply_price'] = number_format($t->total_price - $t->tax);
			
			//$re[$i]['shortage_cnt'] = number_format($bcnt);
			$re[$i]['tax'] = number_format($t->tax);
			$re[$i]['total_price'] = number_format($t->total_price);
			$re[$i]['inspection_cd'] = $t->inspection_cd;
			$re[$i]['ii'] = $i;

			$i++;
		}

		echo $json->encode($re);
	break;

	/*
	case "getBarcodeItem" : // 바코드 출고처리
		
		$sql = "select * from erp_item where barcode='".$barcode."'";
		//echo $sql."<BR><BR>"; 
		$t = @mysql_fetch_object(mysql_query($sql));

		//$sql2 = "select remain_cnt, warehouse_cd, warehouse_nm from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'  and warehouse_cd='".$t->warehouse_cd."'";

		$sql2 = "select remain_cnt, warehouse_cd, warehouse_nm, lot_no_cd from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'";
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
		
		if($stock->lot_no_cd=="null"){
			$lot_no_cd = "";
		}

		if($total_cnt <= 0) $bcnt = $stock->remain_cnt;
		
			$re['uid']			= $t->uid;
			$re['fid']			= $t->fid;
			$re['item_cd']		= $t->item_cd;
			$re['item_nm']		= $t->item_nm;
			$re['standard1']	= $t->standard1;
			$re['material']		= $t->material;
			$re['unit']			= $t->unit;
			$re['cnt']			= $cnt;
			$re['remain_cnt']	= number_format($stock->remain_cnt);
			$re['shortage_cnt'] = number_format($bcnt);
			$re['unit_price']	= number_format($t->unit_price);
			$re['supply_price'] = number_format($supply_price);
			$re['tax']			= number_format($tax);
			$re['total_price']	= number_format($total_price);
			$re['account_cd']	= $t->account_cd;
			$re['account_nm']	= $t->account_nm;
			$re['lot_no_cd']	= $lot_no_cd;
			$re['warehouse_cd'] = $stock->warehouse_cd;
			$re['warehouse_nm'] = getWarehouseNm($stock->warehouse_cd);

			echo $json->encode($re);
		
	break;
	*/

	case "getBarcodeItem" : // 바코드 출고처리

		//태성1공장은 원자재lot와 완제품lot가 같아서 해당 로트의 품목이 원자재인것만 출력하게 해주어야 한다.

		$sql = "select item_cd , standard1, unit, lot_no, warehouse_cd, sum(remain_cnt)as remain_cnt , min(in_dt)as in_dt from erp_stock_inout where lot_no='".$barcode."' and remain_cnt > 0 group by item_cd, standard1";
		//echo $sql."<BR><BR>"; 
		$result  = mysql_query($sql);
		
		$i=0;
		if( mysql_num_rows($result) > 0 ){
			while( $stock2 = @mysql_fetch_object($result) ){
				
				//원자재인지 확인하기.
				$sql2 = "select * from erp_item where item_cd='".$stock2->item_cd."' and standard1='".$stock2->standard1."'";
				$checkComponent = mysql_fetch_object(mysql_query($sql2));

				if($checkComponent-> item_gb != "component"){
					continue;
				}


				//출력.
				$sql2 = "select * from erp_item where item_cd='".$stock2 ->item_cd."' and standard1='".$stock2->standard1."'";
				$erp_item = mysql_fetch_object(mysql_query($sql2));

				$re[$i]['item_cd']	= $stock2->item_cd;
				$re[$i]['item_nm']	= $erp_item->item_nm;
				$re[$i]['standard1']	= $stock2->standard1;
				$re[$i]['unit']		= $stock2->unit;
				$re[$i]['warehouse_cd']	= $stock2->warehouse_cd;

				$sql3 = "select * from erp_warehouse where warehouse_cd='".$stock2 ->warehouse_cd."'";
				$erp_warehouse = mysql_fetch_object(mysql_query($sql3));

				$re[$i]['warehouse_nm']	= $erp_warehouse->warehouse_nm;
				
				$re[$i]['remain_cnt']	= number_format($stock2->remain_cnt);
				$re[$i]['lot_no']	= $barcode;
				
				$re[$i]['in_date']	= $stock2->in_dt;
				$i++;
				
			}

			echo $json->encode($re);
		}else{

			echo $json->encode(null);
		}
			
		
	break;

}
?>