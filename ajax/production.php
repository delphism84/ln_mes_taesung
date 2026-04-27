<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

function checkSon($uid){
	$sql = "select * from erp_bom where fid=".$uid;
	$row = @mysql_num_rows(mysql_query($sql));

	return $row;
}

function getWarehouseNm($warehouse_cd) {
	$sql = "select warehouse_nm from erp_warehouse where warehouse_cd='".$warehouse_cd."'";
	$t = mysql_fetch_object(mysql_query($sql));
	return $t->warehouse_nm;
}


switch($mode) {
	case "registPartRelease" :
		// release 의 요청 수량을 가져온다
		$release_remain_cnt = $remain_cnt - $cnt;
		if($release_remain_cnt == 0) $status = "complete";
		else $status = "stay";
		$sql = "update erp_release set cnt=$release_remain_cnt, status='".$status."' where uid=".$uid;
		mysql_query($sql);
		
		// 해당 UID 의 잔여수량을 가져온다
		$sql = "select * from erp_stock_inout where uid=".$inout_uid;
		$stock = mysql_fetch_object(mysql_query($sql));

		$new_remain_cnt = $stock->remain_cnt - $cnt;

		if($new_remain_cnt == 0) $used = "y";
		else $used = "n";

		$sql = "update erp_stock_inout set out_cnt=".$cnt.", remain_cnt=".$new_remain_cnt.", out_cnt=".$cnt.", used='".$used."' where uid=".$inout_uid;
		mysql_query($sql);

		// 전체재고수량 변경
		$sql = "update erp_stock set remain_cnt=".$new_remain_cnt." where item_cd='".$stock->item_cd."' and standard1='".$stock->standard1."' ";
		$result = mysql_query($sql);

		// 출고사유 기록
		$sql = "insert into erp_reason (fid, item_cd, standard1, in_cnt, out_cnt, reason, emp_id, create_dt) values (".$inout_uid.",'".$stock->item_cd."','".$stock->standard1."','".$stock->standard2."','".$stock->standard3."',0,".$cnt.",'생산불출','".$_SESSION['login_id']."',now())";
		mysql_query($sql);

		if($result) echo "success";
	break;

	case "getWorkplanBom" :
		// 임시테이블 생성
		$sql = "
			create TEMPORARY TABLE tem_bom (
				item_cd varchar(50),
				item_nm varchar(50),
				standard1 varchar(50),
				material varchar(50),
				unit varchar(50),
				cnt int(11),
				current_cnt int(11)
			) CHARACTER SET utf8 COLLATE utf8_general_ci;
		";
		mysql_query($sql) or die (mysql_error());



		// 먼저 workplan item 을 가져온다
		$sql = "select * from erp_workplan_item where workplan_cd='".$workplan_cd."'";
		//echo $sql ;
		$result1 = mysql_query($sql);
		//echo mysql_num_rows($result1);
		
		$i = 0;
		
		while($t1 = mysql_fetch_object($result1)){

			$sql = "select * from erp_item where item_cd='". $t1->item_cd ."' and standard1='".$t1->standard1."' ";
			$res1 = mysql_fetch_object(mysql_query($sql));

			//echo $res1->item_gb;
			
			if($res1->item_gb == "semi_product" || $res1->item_gb == "product") { //반제품, 완제품이라면
				// 일단 반제품이면 무조건 생산해야 할 제품에 등록
				$cnt = $t1->cnt;

				$sql = "select remain_cnt from erp_stock where item_cd='".$t1->item_cd."' and standard1='".$t1->standard1."' ";
				$st = mysql_fetch_object(mysql_query($sql));

				$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt, current_cnt) values ('$t1->item_cd','$t1->item_nm','$t1->standard1', '$t1->material','$t1->unit', '$cnt','$st->remain_cnt')";
				//echo $sql;
				mysql_query($sql) or die (mysql_error());

				// 나를 부모로 가진 bom 이 있나 확인
				if(checkSon($res1->uid) > 0) { // 자식이 있다면
					$sql = "select * from erp_bom where fid=".$res1->uid;
					//echo $sql;
					$bom1 = mysql_query($sql);
					
					if(mysql_num_rows($bom1) > 0) {
						while($t2 = mysql_fetch_object($bom1)) {
							$sql = "select * from erp_item where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."'";
							//echo $sql;
							$item1= @mysql_fetch_object(mysql_query($sql));
							
							if($item1->item_gb == "semi_product" || $item1->item_gb == "product") {
								$cnt = $t2->cnt * $t1->cnt;
								
								$sql = "select remain_cnt from erp_stock where item_cd='".$item1->item_cd."' and standard1='".$item1->standard1."' ";
								//echo $sql;
								$st = mysql_fetch_object(mysql_query($sql));

								$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt, current_cnt) values ('$item1->item_cd','$item1->item_nm','$item1->standard1','$item1->material','$item1->unit','$cnt','$st->remain_cnt')";
								mysql_query($sql) or die (mysql_error());

								if(checkSon($item1->uid) > 0) { // 자식이 있다면

									$sql = "select * from erp_bom where fid=".$item1->uid;
									//echo $sql;
									$bom2 = mysql_query($sql);
									
									if(mysql_num_rows($bom2) > 0) {
										while($t3 = mysql_fetch_object($bom2)) {
											$sql = "select * from erp_item where item_cd='".$t3->item_cd."' and standard1='".$t3->standard1."' ";
											$item2= @mysql_fetch_object(mysql_query($sql));
											
											if($item2->item_gb == "semi_product" || $item2->item_gb == "product") {
												$cnt = $t1->cnt * $t3->cnt * $t2->cnt;

												$sql = "select remain_cnt from erp_stock where item_cd='".$item2->item_cd."' and standard1='".$item2->standard1."' ";
												//echo $sql;
												$st = mysql_fetch_object(mysql_query($sql));

												$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt, current_cnt) values ('$item2->item_cd','$item2->item_nm','$item2->standard1','$item2->material','$item2->unit', '$cnt','$st->remain_cnt')";
												mysql_query($sql) or die (mysql_error());

												if(checkSon($item2->uid) > 0) { // 자식이 있다면
													$sql = "select * from erp_bom where fid=".$item2->uid;
													$bom3 = mysql_query($sql);
													
													if(mysql_num_rows($bom3) > 0) {
														while($t4 = mysql_fetch_object($bom3)) {
															$sql = "select * from erp_item where item_cd='".$t4->item_cd."' and standard1='".$t4->standard1."' ";
															$item3= @mysql_fetch_object(mysql_query($sql));
															
															if($item3->item_gb == "semi_product" || $item3->item_gb == "product") {
																$cnt = $t1->cnt * $t3->cnt * $t2->cnt * $t4->cnt;

																$sql = "select remain_cnt from erp_stock where item_cd='".$item3->item_cd."' and standard1='".$item3->standard1."' ";
																$st = mysql_fetch_object(mysql_query($sql));

																$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt, current_cnt) values ('$item3->item_cd','$item3->item_nm','$item3->standard1','$item3->material','$item3->unit', '$cnt','$st->remain_cnt')";
																//echo $sql;
																mysql_query($sql) or die (mysql_error());

																if(checkSon($item3->uid) > 0) { // 자식이 있다면
																	$sql = "select * from erp_bom where fid=".$item3->uid;
																	$bom4 = mysql_query($sql);
																	
																	if(mysql_num_rows($bom4) > 0) {
																		while($t5 = mysql_fetch_object($bom4)) {
																			$sql = "select * from erp_item where item_cd='".$t5->item_cd."' and standard1='".$t5->standard1."' ";
																			$item4= @mysql_fetch_object(mysql_query($sql));
																			
																			if($item4->item_gb == "semi_product" || $item4->item_gb == "product") {
																				$cnt = $t1->cnt * $t3->cnt * $t2->cnt * $t4->cnt * $t5->cnt;
																				
																				$sql = "select remain_cnt from erp_stock where item_cd='".$item4->item_cd."' and standard1='".$item4->standard1."' ";
																				//echo $sql;
																				$st = mysql_fetch_object(mysql_query($sql));

																				$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt, current_cnt) values ('$item4->item_cd','$item4->item_nm','$item4->standard1','$item4->material','$item4->unit', '$cnt','$st->remain_cnt')";
																				mysql_query($sql) or die (mysql_error());
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		

		$sql = "select item_cd, item_nm, standard1, material, unit, sum(current_cnt) as current_cnt, sum(cnt) as cnt from tem_bom group by item_cd, standard1";
		//echo $sql;
		$result = mysql_query($sql);
		$i = 0;
		while($t = mysql_fetch_object($result)) {
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['current_cnt'] = $t->current_cnt;
			$re[$i]['cnt'] = $t->cnt;
			$i++;
		}
		
		$sql = "drop table tem_bom";
		mysql_query($sql);
		echo $json->encode($re);
	break;

	case "getWorkBom" :
		// 임시테이블 생성
		$sql = "
			create TEMPORARY TABLE tem_bom (
				item_cd varchar(50),
				item_nm varchar(50),
				standard1 varchar(50),
				material varchar(50),
				unit varchar(50),
				cnt int(11),
				current_cnt int(11)
			) CHARACTER SET utf8 COLLATE utf8_general_ci;
		";
		mysql_query($sql) or die (mysql_error());



		// 먼저 workplan item 을 가져온다
		$sql = "select * from erp_work_item where work_cd='".$work_cd."'";
		$result1 = mysql_query($sql);
		//echo mysql_num_rows($result1);
		
		$i = 0;
		while($t1 = mysql_fetch_object($result1)){

			$sql = "select * from erp_item where item_cd='". $t1->item_cd ."' and standard1='".$t1->standard1."' ";
			$res1 = mysql_fetch_object(mysql_query($sql));

			//echo $res1->item_gb;
			
			if($res1->item_gb == "semi_product" || $res1->item_gb == "product") { //반제품, 완제품이라면
				// 일단 반제품이면 무조건 생산해야 할 제품에 등록
				$cnt = $t1->cnt;

				$sql = "select remain_cnt from erp_stock where item_cd='".$t1->item_cd."' and standard1='".$t1->standard1."' ";
				$st = mysql_fetch_object(mysql_query($sql));

				$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt, current_cnt) values ('$t1->item_cd','$t1->item_nm','$t1->standard1', '$t1->material','$t1->unit', '$cnt','$st->remain_cnt')";
				//echo $sql;
				mysql_query($sql) or die (mysql_error());

				// 나를 부모로 가진 bom 이 있나 확인
				if(checkSon($res1->uid) > 0) { // 자식이 있다면
					$sql = "select * from erp_bom where fid=".$res1->uid;
					//echo $sql;
					$bom1 = mysql_query($sql);
					
					if(mysql_num_rows($bom1) > 0) {
						while($t2 = mysql_fetch_object($bom1)) {
							$sql = "select * from erp_item where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."'";
							//echo $sql;
							$item1= @mysql_fetch_object(mysql_query($sql));
							
							if($item1->item_gb == "semi_product" || $item1->item_gb == "product") {
								$cnt = $t2->cnt * $t1->cnt;
								
								$sql = "select remain_cnt from erp_stock where item_cd='".$item1->item_cd."' and standard1='".$item1->standard1."' ";
								//echo $sql;
								$st = mysql_fetch_object(mysql_query($sql));

								$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt, current_cnt) values ('$item1->item_cd','$item1->item_nm','$item1->standard1','$item1->material','$item1->unit','$cnt','$st->remain_cnt')";
								mysql_query($sql) or die (mysql_error());

								if(checkSon($item1->uid) > 0) { // 자식이 있다면

									$sql = "select * from erp_bom where fid=".$item1->uid;
									//echo $sql;
									$bom2 = mysql_query($sql);
									
									if(mysql_num_rows($bom2) > 0) {
										while($t3 = mysql_fetch_object($bom2)) {
											$sql = "select * from erp_item where item_cd='".$t3->item_cd."' and standard1='".$t3->standard1."' ";
											$item2= @mysql_fetch_object(mysql_query($sql));
											
											if($item2->item_gb == "semi_product" || $item2->item_gb == "product") {
												$cnt = $t1->cnt * $t3->cnt * $t2->cnt;

												$sql = "select remain_cnt from erp_stock where item_cd='".$item2->item_cd."' and standard1='".$item2->standard1."' ";
												//echo $sql;
												$st = mysql_fetch_object(mysql_query($sql));

												$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt, current_cnt) values ('$item2->item_cd','$item2->item_nm','$item2->standard1','$item2->material','$item2->unit', '$cnt','$st->remain_cnt')";
												mysql_query($sql) or die (mysql_error());

												if(checkSon($item2->uid) > 0) { // 자식이 있다면
													$sql = "select * from erp_bom where fid=".$item2->uid;
													$bom3 = mysql_query($sql);
													
													if(mysql_num_rows($bom3) > 0) {
														while($t4 = mysql_fetch_object($bom3)) {
															$sql = "select * from erp_item where item_cd='".$t4->item_cd."' and standard1='".$t4->standard1."' ";
															$item3= @mysql_fetch_object(mysql_query($sql));
															
															if($item3->item_gb == "semi_product" || $item3->item_gb == "product") {
																$cnt = $t1->cnt * $t3->cnt * $t2->cnt * $t4->cnt;

																$sql = "select remain_cnt from erp_stock where item_cd='".$item3->item_cd."' and standard1='".$item3->standard1."' ";
																$st = mysql_fetch_object(mysql_query($sql));

																$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt, current_cnt) values ('$item3->item_cd','$item3->item_nm','$item3->standard1','$item3->material','$item3->unit', '$cnt','$st->remain_cnt')";
																//echo $sql;
																mysql_query($sql) or die (mysql_error());

																if(checkSon($item3->uid) > 0) { // 자식이 있다면
																	$sql = "select * from erp_bom where fid=".$item3->uid;
																	$bom4 = mysql_query($sql);
																	
																	if(mysql_num_rows($bom4) > 0) {
																		while($t5 = mysql_fetch_object($bom4)) {
																			$sql = "select * from erp_item where item_cd='".$t5->item_cd."' and standard1='".$t5->standard1."' ";
																			$item4= @mysql_fetch_object(mysql_query($sql));
																			
																			if($item4->item_gb == "semi_product" || $item4->item_gb == "product") {
																				$cnt = $t1->cnt * $t3->cnt * $t2->cnt * $t4->cnt * $t5->cnt;
																				
																				$sql = "select remain_cnt from erp_stock where item_cd='".$item4->item_cd."' and standard1='".$item4->standard1."' ";
																				//echo $sql;
																				$st = mysql_fetch_object(mysql_query($sql));

																				$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt, current_cnt) values ('$item4->item_cd','$item4->item_nm','$item4->standard1','$item4->material','$item4->unit', '$cnt','$st->remain_cnt')";
																				mysql_query($sql) or die (mysql_error());
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}

		$sql = "select item_cd, item_nm, standard1, material, unit, sum(current_cnt) as current_cnt, sum(cnt) as cnt from tem_bom group by item_cd, standard1";
		$result = mysql_query($sql);
		$i = 0;
		while($t = mysql_fetch_object($result)) {
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['current_cnt'] = $t->current_cnt;
			$re[$i]['cnt'] = $t->cnt;
			$i++;
		}
		
		$sql = "drop table tem_bom";
		mysql_query($sql);
		echo $json->encode($re);
	break;

	case "getItem" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_item".$where." order by uid desc";
		else $query = "select * from erp_item".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		//$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$query = "select * from erp_bom where fid=".$t->uid;
			
			$result2 = mysql_query($query);
			$cnt = mysql_num_rows($result2);
			//echo $cnt;
			$t2 = mysql_fetch_object($result2);

			$no = $rpp * ($page-1) + $ct;
			//$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['material'] = $t->material;
			$re[$i]['item_gb'] = $t->item_gb;
			$re[$i]['cnt'] = $cnt;
			$re[$i]['shortage'] = number_format($t2->shortage);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getLotno" :

		$page = (is_numeric($page)) ? $page : 1; 
		//if($rpp == "all") $query = "select * from erp_product_perf_repost_barcode".$where." order by uid desc";
		//else $query = "select * from erp_product_perf_repost_barcode".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		
		$query = "select * from erp_product_perf_repost_barcode".$where." where uid =".$uid." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			//$query = "select * from erp_bom where fid=".$t->uid;
			
			//$result2 = mysql_query($query);
			//$cnt = mysql_num_rows($result2);
			//echo $cnt;
			//$t2 = mysql_fetch_object($result2);

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['lid'] = $t->lid;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['lot_no'] = $t->lot_no;
			$re[$i]['official1'] = $t->official1;
			$re[$i]['official2'] = $t->official2;
			$re[$i]['official3'] = $t->official3;
			$re[$i]['official4'] = $t->official4;
			$re[$i]['official5'] = $t->official5;
			$re[$i]['official6'] = $t->official6;
			$re[$i]['official7'] = $t->official7;
			$re[$i]['official8'] = $t->official8;
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectBom" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_bom where fid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectQc" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_qc where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectDefective" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_defective where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectWorkplan" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "select workplan_cd from erp_workplan where uid=".$array_uid[$i];
			$pl = @mysql_fetch_object(mysql_query($query));
			$query = "delete from erp_workplan_item where workplan_cd='".$pl->workplan_cd."'";
			mysql_query($query);
			$query = "delete from erp_workplan where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectWork" :	//작업지시서 선택삭제 추가 2018.10.16
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_work where uid=".$array_uid[$i];
			mysql_query($query);
			//erp_work_item은 키값으로 자동으로 지워짐..
		}

		echo "success";
	break;
	
	// BOM 입력화면의 아이템명 가져오기
	case "getItemName" :
		$query = "select item_nm from erp_item where uid=".$uid;
		$result = mysql_fetch_object(mysql_query($query));
		echo $result->item_nm;
	break;

	// BOM 입력화면의 아이템명 가져오기
	case "getItemStandard" :
		$query = "select standard1, standard3 from erp_item where uid=".$uid;
		$t = mysql_fetch_object(mysql_query($query));
		$re['standard1'] = $t->standard1;
		$re['standard2'] = $t->standard2;
		$re['standard3'] = $t->standard3;
		echo $json->encode($re);
	break;
	
	// BOM 가져오기
	case "getBom" :
		$query = "select * from erp_bom where fid=".$uid." order by uid desc";
		$result = mysql_query($query);
		//echo $query;
		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$i++;
		}

		echo $json->encode($re);
	break;

	// BOM 가져오기
	case "getCalBom" :
		// 임시테이블 생성
		$sql = "
			create TEMPORARY TABLE tem_bom (
				item_cd varchar(50),
				item_nm varchar(50),
				standard1 varchar(50),
				standard2 varchar(50),
				standard3 varchar(50),
				material varchar(50),
				unit varchar(20),
				cnt int(11)
			) CHARACTER SET utf8 COLLATE utf8_general_ci;
		";
		mysql_query($sql) or die (mysql_error());


		$sql = "select uid from erp_item where item_cd='".$item_cd."' and standard1='".$standard1."'";
		//echo $sql; 
		$t1 = mysql_fetch_object(mysql_query($sql));


		$sql = "select * from erp_bom where fid=".$t1->uid." order by uid desc";
		//echo $sql; 
		$result1 = @mysql_query($sql);

		$i = 0;
		
		if(@mysql_num_rows($result1) > 0) {
			while($t2 = @mysql_fetch_object($result1)) {
				$sql = "select uid from erp_item where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."'";
				$t3 = @mysql_fetch_object(mysql_query($sql));
				
				$sql = "select * from erp_bom where fid=".$t3->uid." order by uid desc";
				//echo $sql; 
				$result2 = @mysql_query($sql);

				if(@mysql_num_rows($result2)) {
					while($t4 = @mysql_fetch_object($result2)) {
						$sql = "select uid from erp_item where item_cd='".$t4->item_cd."' and standard1='".$t4->standard1."'";
						$t5 = @mysql_fetch_object(mysql_query($sql));
				
						$sql = "select * from erp_bom where fid=".$t5->uid." order by uid desc";
						$result3 = @mysql_query($sql);	
						
						if(@mysql_num_rows($result3)) {
							while($t6 = @mysql_fetch_object($result3)) {
								$sql = "select uid from erp_item where item_cd='".$t6->item_cd."' and standard1='".$t6->standard1."'";
								$t7 = @mysql_fetch_object(mysql_query($sql));
						
								$sql = "select * from erp_bom where fid=".$t7->uid." order by uid desc";
								$result4 = @mysql_query($sql);	

								if(@mysql_num_rows($result4)) {
									// 하위 BOM 이 더 있을 경우 반복처리 하면 됨
								} else {
									$ocnt = $t6->cnt * $t4->cnt * $cnt;
									$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt) values ('$t6->item_cd','$t6->item_nm','$t6->standard1','$t6->material','$t6->unit',$ocnt)";
									mysql_query($sql) or die (mysql_error());
								}
							}
						} else {
							$ocnt = $t4->cnt * $t2->cnt * $cnt;
							$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt) values ('$t4->item_cd','$t4->item_nm','$t4->standard1','$t6->material','$t4->unit' ,$ocnt)";
							mysql_query($sql) or die (mysql_error());
						}
					}
				} else {
					$ocnt = $t2->cnt * $cnt;
					$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt) values ('$t2->item_cd','$t2->item_nm','$t2->standard1','$t6->material','$t2->unit',$ocnt)";
					mysql_query($sql) or die (mysql_error());
				}
			}
		} else {
			$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt) values ('$item_cd','$item_nm','$standard1','$t6->material','$unit',$cnt)";
			mysql_query($sql) or die (mysql_error());
		}

		$sql = "select item_cd, item_nm, standard1, material, sum(cnt) as cnt from tem_bom group by item_cd, standard1";
		//echo $sql; 
		$result = mysql_query($sql);
		$i = 0;
		while($t = mysql_fetch_object($result)) {
			// 해당 품목의 현재고수량
			$sql = "select remain_cnt from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'";
			$ccnt = @mysql_fetch_object(mysql_query($sql));
			// 부족재고수량
			$bcnt = $t->cnt - $ccnt->remain_cnt;
			if($bcnt < 0) $bcnt = 0;

			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['current_cnt'] = $ccnt->remain_cnt;
			$re[$i]['shortage_cnt'] = $bcnt;
			$i++;
		}
		
		$sql = "drop table tem_bom";
		mysql_query($sql);
		echo $json->encode($re);
	break;

	// BOM 가져오기
	case "checkCalBom" :
		// 임시테이블 생성
		$sql = "
			create TEMPORARY TABLE tem_bom (
				item_cd varchar(50),
				item_nm varchar(50),
				standard1 varchar(50),
				material varchar(50),
				unit varchar(20),
				cnt int(11)
			) CHARACTER SET utf8 COLLATE utf8_general_ci;
		";
		mysql_query($sql) or die (mysql_error());


		$sql = "select uid from erp_item where item_cd='".$item_cd."' and standard1='".$standard1."' ";
		$t1 = mysql_fetch_object(mysql_query($sql));


		$sql = "select * from erp_bom where fid=".$t1->uid." order by uid desc";
		$result1 = @mysql_query($sql);

		$i = 0;
		
		if(@mysql_num_rows($result1) > 0) { // 하위 자재가 있다면 (반제품이라면)
			while($t2 = @mysql_fetch_object($result1)) {
				$sql = "select uid from erp_item where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."' ";
				$t3 = @mysql_fetch_object(mysql_query($sql));
				
				$sql = "select * from erp_bom where fid=".$t3->uid." order by uid desc";
				$result2 = @mysql_query($sql);

				if(@mysql_num_rows($result2)) { // 하위 자재가 있다면 (반제품이라면)
					while($t4 = @mysql_fetch_object($result2)) {
						$sql = "select uid from erp_item where item_cd='".$t4->item_cd."' and standard1='".$t4->standard1."' ";
						$t5 = @mysql_fetch_object(mysql_query($sql));
				
						$sql = "select * from erp_bom where fid=".$t5->uid." order by uid desc";
						$result3 = @mysql_query($sql);	
						
						if(@mysql_num_rows($result3)) { // 하위 자재가 있다면 (반제품이라면)
							while($t6 = @mysql_fetch_object($result3)) {
								$sql = "select uid from erp_item where item_cd='".$t6->item_cd."' and standard1='".$t6->standard1."' ";
								$t7 = @mysql_fetch_object(mysql_query($sql));
						
								$sql = "select * from erp_bom where fid=".$t7->uid." order by uid desc";
								$result4 = @mysql_query($sql);	

								if(@mysql_num_rows($result4)) {
									// 하위 BOM 이 더 있을 경우 반복처리 하면 됨
								} else {
									// 소요량 계산
									$ocnt = $t6->cnt * $t4->cnt * $cnt;
									$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt) values ('$t6->item_cd','$t6->item_nm','$t6->standard1','$t6->material','$t6->unit',$ocnt)";
									mysql_query($sql) or die (mysql_error());
								}
							}
						} else {
							$ocnt = $t4->cnt * $t2->cnt * $cnt;
							$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit,  cnt) values ('$t4->item_cd','$t4->item_nm','$t4->standard1','$t4->material','$t4->unit',$ocnt)";
							mysql_query($sql) or die (mysql_error());
						}
					}
				} else {
					$ocnt = $t2->cnt * $cnt;
					$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt) values ('$t2->item_cd','$t2->item_nm','$t2->standard1','$t4->material','$t2->unit',$ocnt)";
					mysql_query($sql) or die (mysql_error());
				}
			}
		} else {
			$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt) values ('$item_cd','$item_nm','$standard1','$material','$unit',$cnt)";
			mysql_query($sql) or die (mysql_error());
		}

		$sql = "select item_cd, item_nm, standard1, material, sum(cnt) as cnt, unit from tem_bom group by item_cd, standard1";
		$result = mysql_query($sql);
		$i = 0;

		$arr = array();

		while($t = mysql_fetch_object($result)) {
			// 해당 품목의 현재고수량
			$sql = "select remain_cnt from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' ";
			//echo $sql."<br>";
			$ccnt = @mysql_fetch_object(mysql_query($sql));

			// 부족재고수량
			$bcnt = $ccnt->remain_cnt - $t->cnt;

			//echo "품목명 : ".$t->item_nm." 품목코드 : ".$t->item_cd." 필요수량 : ".$t->cnt." 재고수량 : ".$ccnt->remain_cnt." 요청수량 : ".$bcnt."<br>";

			
			if($bcnt < 0) {
				array_push($arr,"shortage");
			} else {
				array_push($arr,"success");
			}
		}
		
		$sql = "drop table tem_bom";
		mysql_query($sql);

		if(in_array("shortage",$arr)) echo "shortage";
	break;

	// 작업지시서 코드 생성
	case "createWorkCode" :
		$code = "WR-".time();
		echo $code;
	break;
	
	// BOM 가져오기
	case "getWorkPlan" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_workplan".$where." order by uid desc";
		else $query = "select * from erp_workplan".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$sql = "select uid from erp_workplan_item where workplan_cd='".$t->workplan_cd."'";
			$cnt = mysql_num_rows(mysql_query($sql));

			$re[$i]['uid'] = $t->uid;
			$re[$i]['work_gb'] = $t->work_gb;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['workplan_cd'] = $t->workplan_cd;
			$re[$i]['title'] = $t->title;
			$re[$i]['cnt'] = $cnt;
			$re[$i]['start_dt'] = substr($t->start_dt,0,10);
			$re[$i]['end_dt'] = substr($t->end_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;

	// BOM 가져오기
	case "getWorkPlanItem" :
		
		if(isset($workplan_cd)) {
			$where = " where workplan_cd='".$workplan_cd."'";
		} else {
			$where =  " where wid='".$uid."'";
		}
		$query = "select * from erp_workplan_item".$where;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;

			$sql = "select work_gb, order_cd from erp_workplan where workplan_cd='".$t->workplan_cd."'";
			$t2 = @mysql_fetch_object(mysql_query($sql));

			$re[$i]['work_gb']			= $t2->work_gb;
			$re[$i]['workplan_cd']		= $t->workplan_cd;
			$re[$i]['item_cd']			= $t->item_cd;
			$re[$i]['item_nm']			= $t->item_nm;
			$re[$i]['standard1']		= $t->standard1;
			$re[$i]['material']			= $t->material;
			$re[$i]['unit']				= $t->unit;
			$re[$i]['cnt']				= number_format($t->cnt);
			$re[$i]['work_start_dt']	= substr($t->work_start_dt,0,10);
			$re[$i]['work_end_dt']		= substr($t->work_end_dt,0,10);
			$re[$i]['warehouse_cd']		= $t->warehouse_cd;
			$re[$i]['warehouse_nm']		= $t->warehouse_nm;
			$re[$i]['order_cd']			= $t->order_cd;
			$i++;
		}

		echo $json->encode($re);
	break;

	// BOM 가져오기
	case "getWorkItem" :
		if(isset($workplan_cd)) {
			$where = " where work_cd='".$work_cd."'";
		} else {
			$where =  " where uid='".$uid."'";
		}
		$query = "select * from erp_work".$where;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;

			$sql = "select * from erp_work_item where wid='".$t->uid."'";
			//echo $sql;
			$t2 = @mysql_fetch_object(mysql_query($sql));

			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['item_cd'] = $t2->item_cd;
			$re[$i]['item_nm'] = $t2->item_nm;
			$re[$i]['standard1'] = $t2->standard1;
			$re[$i]['material'] = $t2->material;
			$re[$i]['unit'] = $t2->unit;
			$re[$i]['cnt'] = $t2->order_cnt;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['remain_cnt'] = $t2->remain_cnt;
			$re[$i]['shortage_cnt'] = $t2->shortage_cnt;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;


	// 작업지지서 아이템 가져오기
	case "getWorkOrderItem" :
		//$query = "select * from erp_order_item where order_cd='".$order_cd."'";
		$query = "select * from erp_work_item where wid='".$uid."' order by uid";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['work_cd']		= $t->work_cd;
			$re[$i]['process']		= $t->process;
			$re[$i]['item_cd']		= $t->item_cd;
			$re[$i]['item_nm']		= $t->item_nm;
			$re[$i]['standard1']	= $t->standard1;
			$re[$i]['material']		= $t->material;
			$re[$i]['unit']			= $t->unit;
			$re[$i]['goal_cnt']		= number_format($t->goal_cnt);  //완료수량
			$re[$i]['cnt']			= number_format($t->order_cnt); //지시수량
			$re[$i]['order_cnt']	= number_format($t->order_cnt); //지시수량
			$re[$i]['make_cnt']		= number_format($t->make_cnt); //공정생산완료수량
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['remain_cnt']	= number_format($t->remain_cnt);
			$re[$i]['shortage_cnt'] = number_format($t->shortage_cnt);
			$re[$i]['create_dt']	= substr($t->create_dt,0,10);
			$re[$i]['machine_cd']			= $t->machine_cd;
			$re[$i]['machine_nm']			= $t->machine_nm;
			$i++;
		}

		echo $json->encode($re);
	break;

	// 작업지시서 가져오기
	case "getWorkOrder" :
		$query = "select * from erp_work where uid='".$uid."' order by uid";
		//echo $query;
		$result = mysql_query($query);
		$t = mysql_fetch_object($result);

		$sql = "select * from erp_work_item where wid='".$t->uid."'";
		$restul2 = mysql_query($sql);
		$i = 0;
		while($item = mysql_fetch_object($restul2)) {

					$re[$i]['uid'] = $t->uid;
					$re[$i]['work_cd'] = $t->work_cd;
					$re[$i]['work_dt'] = $t->work_dt;
					$re[$i]['work_cha'] = $t->work_cha;
					$re[$i]['start_dt'] = substr($t->start_dt,0,10);
					$re[$i]['end_dt'] = substr($t->end_dt,0,10);
					$re[$i]['process'] = getProcessName($item->process);
					$re[$i]['machine'] = getMachineNm($item->machine);
					$re[$i]['item_cd'] = $item->item_cd;
					$re[$i]['item_nm'] = $item->item_nm;

					$re[$i]['standard1'] = $item->standard1;
					$re[$i]['material'] = $item->material;
					$re[$i]['unit'] = $item->unit;
					$re[$i]['account_cd'] = $t->account_cd;
					$re[$i]['account_nm'] = $t->account_nm;			
					$re[$i]['order_cnt'] = number_format($item->order_cnt);
					$re[$i]['project_cd'] = $t->project_cd;
					$re[$i]['project_nm'] = $t->project_nm;
					$re[$i]['warehouse_cd'] = $t->warehouse_cd;
					$re[$i]['warehouse_nm'] = $t->warehouse_nm;
					$re[$i]['deadline_dt'] = $t->deadline_dt;
					$re[$i]['remain_cnt'] = number_format($item->remain_cnt);
					$re[$i]['make_cnt'] = number_format($item->make_cnt);
					$re[$i]['manager'] = $t->manager;
					$re[$i]['state'] = $t->state;
					$re[$i]['emp_id'] = $t->emp_id;
					$re[$i]['create_dt'] = substr($t->create_dt,0,10);
				$i++;
			}

		echo $json->encode($re);
	break;


	// 작업지시서 가져오기
	case "getWork" :
		$page = (is_numeric($page)) ? $page : 1; 

		if ($_POST['uid'] >= 0 && $_POST['uid'] != ""){
			$where=" where uid='".$_POST['uid']."'";
		}else{
			//$where="";
			$where;
		}
		
		if($rpp == "all") $query = "select * from erp_work".$where." order by uid desc";
		else $query = "select * from erp_work".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$sql = "select * from erp_work_item where wid='".$t->uid."'";
			//echo $sql;
			$result55 = mysql_query($sql);
			
			$k=0;
			$item_nm = "";
			$remain_cnt = 0;
			while($item = mysql_fetch_object($result55)){
				if( $k != 0 ){
					$item_nm = $item->item_nm."외".$k."개";
				}else{
					$item_nm = $item->item_nm;
				}
				$remain_cnt = $remain_cnt + $item->order_cnt;
				$k++;
			}

			// 해당 원자재가 출고가 되지 않은 작업지시서는 출력을 시키지 않는다
			$sql = "select status from erp_release where work_cd='".$t->work_cd."' and object_item_cd='".$t->item_cd."' and object_item_standard1='".$t->standard1."' ";
			//echo $sql;
			$release = mysql_query($sql) or die (mysql_error());
			
			$arr = array();
			
			if($_SESSION['auto_work'] != "y") {
				// 반복처리를 해서 모두다 complete 가 아니면 작업지시서를 내보내지 않는다
				while($r = mysql_fetch_object($release)) {
					if($r->status != "complete") array_push($arr,"false");
				}
				
				//var_dump($arr);

				if(!in_array("false",$arr)) {
					$re[$i]['uid'] = $t->uid;
					$re[$i]['work_cd'] = $t->work_cd;
					$re[$i]['start_dt'] = substr($t->start_dt,0,10);
					$re[$i]['end_dt'] = substr($t->end_dt,0,10);
					//$re[$i]['process'] = getProcessName($item->process);
					//$re[$i]['machine'] = getMachineNm($item->machine);
					//$re[$i]['item_cd'] = $item->item_cd;
					$re[$i]['item_nm'] = $item_nm;
					//$re[$i]['standard1'] = $item->standard1;
					//$re[$i]['material'] = $item->material;
					//$re[$i]['unit'] = $item->unit;
					$re[$i]['account_cd'] = $t->account_cd;
					$re[$i]['account_nm'] = $t->account_nm;			
					$re[$i]['order_cnt'] = $remain_cnt;
					$re[$i]['project_cd'] = $t->project_cd;
					$re[$i]['project_nm'] = $t->project_nm;
					$re[$i]['warehouse_cd'] = $t->warehouse_cd;
					$re[$i]['warehouse_nm'] = $t->warehouse_nm;
					$re[$i]['deadline_dt'] = $t->deadline_dt;
					//$re[$i]['remain_cnt'] = number_format($item->remain_cnt);
					//$re[$i]['make_cnt'] = number_format($item->make_cnt);
					$re[$i]['manager'] = $t->manager;
					$re[$i]['state'] = $t->state;
					$re[$i]['emp_id'] = $t->emp_id;
					$re[$i]['create_dt'] = substr($t->create_dt,0,10);
					$i++;
				}
			} else {
					$re[$i]['uid'] = $t->uid;
					$re[$i]['work_cd'] = $t->work_cd;
					$re[$i]['start_dt'] = substr($t->start_dt,0,10);
					$re[$i]['end_dt'] = substr($t->end_dt,0,10);
					//$re[$i]['process'] = getProcessName($item->process);
					//$re[$i]['machine'] = getMachineNm($item->machine);
					//$re[$i]['item_cd'] = $item->item_cd;
					$re[$i]['item_nm'] =  $item_nm;
					//$re[$i]['standard1'] = $item->standard1;
					//$re[$i]['material'] = $item->material;
					//$re[$i]['unit'] = $item->unit;
					$re[$i]['account_cd'] = $t->account_cd;
					$re[$i]['account_nm'] = $t->account_nm;			
					$re[$i]['order_cnt'] = $remain_cnt;
					$re[$i]['project_cd'] = $t->project_cd;
					$re[$i]['project_nm'] = $t->project_nm;
					$re[$i]['warehouse_cd'] = $t->warehouse_cd;
					$re[$i]['warehouse_nm'] = $t->warehouse_nm;
					$re[$i]['deadline_dt'] = $t->deadline_dt;
					//$re[$i]['remain_cnt'] = number_format($item->remain_cnt);
					//$re[$i]['make_cnt'] = number_format($item->make_cnt);
					$re[$i]['manager'] = $t->manager;
					$re[$i]['state'] = $t->state;
					$re[$i]['emp_id'] = $t->emp_id;
					$re[$i]['create_dt'] = substr($t->create_dt,0,10);
				$i++;
			}

			unset($arr);
		}

		echo $json->encode($re);
	break;

	// 작업지시서 가져오기
	case "getWorkView" :
		$page = (is_numeric($page)) ? $page : 1; 
		
		$work_cd = $_GET['work_cd'];
		
		if(isset($work_cd)) {
			$where = " where work_cd='".$work_cd."'";
		} else {
			$where =  "";
		}

		$query = "select * from erp_work".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {

			$sql = "select * from erp_work_item where wid='".$t->uid."'";
			//echo $sql;
			$item = @mysql_fetch_object(mysql_query($sql));

			$re[$i]['uid'] = $t->uid;
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['start_dt'] = substr($t->start_dt,0,10);
			$re[$i]['end_dt'] = substr($t->end_dt,0,10);
			$re[$i]['process'] = getProcessName($item->process);
			$re[$i]['machine'] = getMachineNm($item->machine);
			$re[$i]['item_cd'] = $item->item_cd;
			$re[$i]['item_nm'] = $item->item_nm;
			$re[$i]['standard1'] = $item->standard1;
			$re[$i]['material'] = $item->material;
			$re[$i]['unit'] = $item->unit;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;			
			$re[$i]['order_cnt'] = number_format($item->order_cnt);
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['deadline_dt'] = $t->deadline_dt;
			$re[$i]['remain_cnt'] = number_format($item->remain_cnt);
			$re[$i]['make_cnt'] = number_format($item->make_cnt);
			$re[$i]['manager'] = $t->manager;
			$re[$i]['state'] = $t->state;
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}
		echo $json->encode($re);
	break;

	case "checkWork" :
		$sql = "select uid from erp_work where workplan_cd='".$workplan_cd."' limit 1";
		$t = @mysql_fetch_object(mysql_query($sql));

		if(isset($t->uid)) echo "isit";
		else echo "nothing";
	break;

	//작업지시서 팝업 가져오기
	case "getWorkOrderPop" :

		$uid = substr($uid, 0, -1);
		$uid_arr = explode(",",$uid);
		$uid = str_replace(",","','",$uid);
		$in_str = $uid;

			$query = "select *, A.uid as Auid from erp_work A right join erp_work_item B on A.uid=B.wid where A.uid IN('".$in_str."') order by B.uid desc";
			//echo $query."<BR>"; 
			$result = mysql_query($query);

		$i = 0;
		
		while($t = @mysql_fetch_object($result)) {

			$sql = "select * from erp_work where uid ='".$t->fid."'";
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

			$re[$i]['uid'] = $t->Auid;
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['start_dt'] = substr($t->start_dt,0,10);
			$re[$i]['end_dt'] = substr($t->end_dt,0,10);
			$re[$i]['product_time'] = substr($t->end_dt,0,10);
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;			
			$re[$i]['cnt'] = number_format($t->order_cnt);
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['warehouse_nm'] = $t->warehouse_nm;
			$re[$i]['deadline_dt'] = $t->deadline_dt;
			$re[$i]['remain_cnt'] = number_format($t->remain_cnt);
			$re[$i]['make_cnt'] = number_format($t->make_cnt);
			$re[$i]['manager'] = $t->manager;
			$re[$i]['remark'] = $t->remark;
			$re[$i]['memo'] = "";
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$re[$i]['outsourcing_tax'] = "0";
			$re[$i]['outsourcing_total_price'] = "0";
			$re[$i]['outsourcing_unit_price'] = "0";

			$i++;
		
		}

		echo $json->encode($re);
	break;
	


	// 부분 생산실적 등록
	case "registMakeCnt" :
		$now = date("Y-m-d H:i:s");
		$sql = "select * from erp_work_item where uid=". $uid;
		$t = mysql_fetch_object(mysql_query($sql));

		if($cnt > $t->remain_cnt) {
			echo "overflow";
		} else {
			$make_cnt = $t->make_cnt + $cnt;
			$remain_cnt = $t->order_cnt - $make_cnt;
			$sql = "update erp_work_item set make_cnt=".$make_cnt.", remain_cnt=".$remain_cnt." where uid=".$uid;
			$result = mysql_query($sql);

			// qc 등록
			$sql = "
				insert into erp_qc (
					work_cd,
					item_cd,
					item_nm,
					standard1,
					
					standard3,
					order_cnt,
					state,
					warehouse_cd,
					create_dt
				) values (
					'$t->work_cd',
					'$t->item_cd',
					'$t->item_nm',
					'$t->standard1',
					'$t->standard2',
					'$t->standard3',
					'$cnt',
					'stay',
					'$t->warehouse_cd',
					'$now'
				)
			";

			//echo $sql;

			$result = mysql_query($sql) or die (mysql_error());

			if($result) echo "success";
		}
	break;

	// 전량 생산실적 등록
	case "registAllIn" :
		$now = date("Y-m-d H:i:s");
		$sql = "select * from erp_work_item where uid=". $uid;
		$t = mysql_fetch_object(mysql_query($sql));

		$sql = "update erp_work_item set make_cnt=".$cnt.", remain_cnt=0 where uid=".$uid;
		//echo $sql;
		$result = mysql_query($sql);

		// qc 등록
		$sql = "
			insert into erp_qc (
				work_cd,
				item_cd,
				item_nm,
				standard1,
				
				standard3,
				order_cnt,
				state,
				warehouse_cd,
				create_dt
			) values (
				'$t->work_cd',
				'$t->item_cd',
				'$t->item_nm',
				'$t->standard1',
				'$t->standard2',
				'$t->standard3',
				'$cnt',
				'stay',
				'$t->warehouse_cd',
				'$now'
			)
		";

		//echo $sql;

		$result = mysql_query($sql) or die (mysql_error());

		if($result) echo "success";
	break;

	case "getQc" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_qc".$where." order by uid desc";
		else $query = "select * from erp_qc".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['workplan_cd'] = $t->workplan_cd;
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['order_cnt'] = $t->order_cnt;
			$re[$i]['state'] = $t->state;
			$re[$i]['warehouse_cd'] = $t->warehouse_cd;
			$re[$i]['warehouse_nm'] = getWarehouseNm($t->warehouse_cd);
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;

	case "registWorkIn" :
		$now = date("Y-m-d H:i:s");
		
		// 지시수량과 일치한다면 해당 qc 는 완료처리
		$in_cnt = $pass + $faulty;
		if($order_cnt == $in_cnt) {
			$sql = "update erp_qc set state='complete' where uid=".$uid;
			mysql_query($sql) or die (mysql_error());
		}

		// 적격제품 생산입고
		$sql = "select * from erp_qc where uid=".$uid;
		$qc = @mysql_fetch_object(mysql_query($sql));
		
		// 불량등록
		if($faulty > 0) {
			$percent_defective = round(($faulty/$qc->order_cnt) * 100);
			$sql = "
				insert into erp_defective (
					work_cd,
					item_cd,
					item_nm,
					standard1,
					
					standard3,
					reason,
					order_cnt,
					cnt,
					percent_defective,
					create_dt
				) values (
					'$qc->work_cd',
					'$qc->item_cd',
					'$qc->item_nm',
					'$qc->standard1',
					'$qc->standard2',
					'$qc->standard3',
					'$faulty_reason',
					'$qc->order_cnt',
					$faulty,
					$percent_defective,
					'$now'
				)
			";
			mysql_query($sql) or die (mysql_error());
		}
		
		// 먼저 erp_stock 에 해당 품목코드와 규격이 같은 제품이 있나 알아본다
		$sql = "select * from erp_stock where item_cd='".$qc->item_cd."' and standard1='".$qc->standard1."' and standard2='".$qc->standard2."' and standard3='".$qc->standard3."'";
		$stock = @mysql_fetch_object(mysql_query($sql));

		// 같은 것이 있다면
		if(@isset($stock->uid)) {
			$new_cnt = $stock->remain_cnt + $pass;
			$sql = "update erp_stock set remain_cnt=".$new_cnt." where uid=".$stock->uid;
			mysql_query($sql) or die (mysql_error());
			
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
					'$qc->work_cd',
					'',
					'',
					'$qc->warehouse_cd',
					'$qc->item_cd',
					'$qc->standard1',
					'$qc->standard2',
					'$qc->standard3',
					$pass,
					0,
					$pass,
					0,
					0,
					'n',
					'$lot_no',
					'$_SESSION[login_id]',
					'$now'
				)
			";

			$result = mysql_query($sql) or die (mysql_error());

			// 입고사유
			$fid = mysql_insert_id();
			$sql = "
				insert into erp_reason (
					fid,
					item_cd,
					standard1,
					
					standard3,
					in_cnt,
					out_cnt,
					reason,
					emp_id,
					create_dt
				) values (
					$fid,
					'$qc->item_cd',
					'$qc->standard1',
					'$qc->standard2',
					'$qc->standard3',
					$pass,
					0,
					'생산입고',
					'$_SESSION[login_id]',
					'$now'
				)
			";
			mysql_query($sql) or die (mysql_error());

			if($result) echo "success";
		} else {
			$sql = "
				insert into erp_stock (
					item_cd,
					standard1,
					
					standard3,
					pur_cnt,
					pur_unit_price,
					remain_cnt,
					warehouse_cd,
					in_date
				) values (
					'$qc->item_cd',
					'$qc->standard1',
					'$qc->standard2',
					'$qc->standard3',
					$pass,
					0,
					$pass,
					'',
					'$now'
				)
			";
			mysql_query($sql) or die (mysql_error());
			
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
					'$qc->work_cd',
					'',
					'',
					'',
					'$qc->item_cd',
					'$qc->standard1',
					'$qc->standard2',
					'$qc->standard3',
					$pass,
					0,
					$pass,
					0,
					0,
					'n',
					'$lot_no',
					'$_SESSION[login_id]',
					'$now'
				)
			";

			$result = mysql_query($sql) or die (mysql_error());

			// 입고사유
			$fid = mysql_insert_id();
			$sql = "
				insert into erp_reason (
					fid,
					item_cd,
					standard1,
					
					standard3,
					in_cnt,
					out_cnt,
					reason,
					emp_id,
					create_dt
				) values (
					$fid,
					'$qc->item_cd',
					'$qc->standard1',
					'$qc->standard2',
					'$qc->standard3',
					$pass,
					0,
					'생산입고',
					'$_SESSION[login_id]',
					'$now'
				)
			";
			mysql_query($sql) or die (mysql_error());

			if($result) echo "success";
		}
	break;

	case "getDefective" :
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_defective".$where." order by uid desc";
		else $query = "select * from erp_defective".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['standard2'] = $t->standard2;
			$re[$i]['standard3'] = $t->standard3;
			$re[$i]['reason'] = $t->reason;
			$re[$i]['order_cnt'] = $t->order_cnt;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['percent_defective'] = $t->percent_defective;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;


	case "getProductPerfReports" :

		if($where =="" ) {
			$where=" where";
		
			if($gubun == "0"){
				$where = $where." process_nm='PRESS가공'";
			}else if ($gubun == "1"){ 
				$where = $where." process_nm='세척'";
			}else if ($gubun == "2"){ 
				$where = $where." process_nm='검사ㅣ포장'";
			}else if($gubun == "3"){
				$where = $where." process_nm='도금'";
			}
		} else {
			if($gubun == "0"){
				$where = $where." and process_nm='PRESS가공'";
			}else if ($gubun == "1"){ 
				$where = $where." and process_nm='세척'";
			}else if ($gubun == "2"){ 
				$where = $where." and process_nm='검사ㅣ포장'";
			}else if($gubun == "3"){
				$where = $where." and process_nm='도금'";
			}
		}

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_product_perf_repost ".$where." order by production_cd desc";
		else $query = "select * from erp_product_perf_repost ".$where." order by  production_cd  desc limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		//echo "query=". $query;
		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			//$sql = "select uid from erp_workplan_item where workplan_cd='".$t->workplan_cd."'";
			//$cnt = mysql_num_rows(mysql_query($sql));

			$re[$i]['uid']				= $t->uid;
			$re[$i]['production_dt']	= $t->production_dt;
			$re[$i]['production_cha']	= $t->production_cha;
			$re[$i]['production_cd']	= $t->production_cd;
			$re[$i]['day_gubun']		= $t->day_gubun;
			$re[$i]['process_cd']		= $t->process_cd;
			$re[$i]['process_nm']		= $t->process_nm;
			$re[$i]['machine_nm']		= $t->machine_nm;
			$re[$i]['p_plan_tm']		= $t->p_plan_tm;
			$re[$i]['order_qty']		= $t->order_qty;
			$re[$i]['p_now_tm']			= $t->p_now_tm;
			$re[$i]['target_qty']		= number_format($t->target_qty);
			$re[$i]['output_qty']		= number_format($t->output_qty);
			$re[$i]['working_efficiency'] = number_format($t->working_efficiency);
			$re[$i]['item_cd']			= $t->item_cd;
			$re[$i]['item_nm']			= $t->item_nm;
			$re[$i]['standard1']		= $t->standard1;
			$re[$i]['standard2']		= $t->standard2;
			$re[$i]['standard3']		= $t->standard3;
			$re[$i]['pass_qty']			= number_format($t->pass_qty);
			$re[$i]['work_cd']			= $t->work_cd;
			$re[$i]['publish_qty']		= number_format($t->publish_qty);
			$re[$i]['emp_id']			= $t->emp_id;
			$re[$i]['emp_nm']			= $t->emp_nm;
			$re[$i]['writer']			= $t->writer;
			$re[$i]['faulty_qty1']		= $t->faulty_qty1;
			$re[$i]['faulty_type1']		= $t->faulty_type1;
			$re[$i]['faulty_qty2']			= $t->faulty_qty2;
			$re[$i]['faulty_type2']		= $t->faulty_type2;

			$re[$i]['faulty_qty3']			= $t->faulty_qty3;
			$re[$i]['faulty_type3']		= $t->faulty_type3;
			$re[$i]['faulty_qty4']			= $t->faulty_qty4;
			$re[$i]['faulty_type4']		= $t->faulty_type4;
			$re[$i]['faulty_qty5']			= $t->faulty_qty5;
			$re[$i]['faulty_type5']		= $t->faulty_type5;
			$re[$i]['faulty_qty6']			= $t->faulty_qty6;
			$re[$i]['faulty_type6']		= $t->faulty_type6;
			$re[$i]['faulty_qty7']			= $t->faulty_qty7;
			$re[$i]['faulty_type7']		= $t->faulty_type7;

			$re[$i]['p_now_tm1']		= substr($t->p_plan_tm,0,5);
			$re[$i]['p_now_tm2']		= substr($t->p_plan_tm,7,12);
			$re[$i]['box_limit_qty']	= number_format($t->box_limit_qty);
			$re[$i]['loss_item']		= $t->loss_item;
			$re[$i]['loss_time']		= $t->loss_time;
			$re[$i]['shipment_dt']		= $t->shipment_dt;
			$i++;
		}

		echo $json->encode($re);
	break;

		
	//생산실적 등록시 동일 작업지지서가 등록되어 있는지 여부 확인 20180619
	case "getPPRWorkDateCheck" :
		$query = "select * from erp_product_perf_repost where work_cd='".$work_cd."' order by uid asc";
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		if ($total_num > 0) {
			echo "success";
		}else{
			echo "";
		}
		
	break;


	//생산실적등록시 동일 작업지지서 중복 공정 체크
	case "getPPRWorkProcessCheck" :
		$query = "select * from erp_product_perf_repost where process_cd='".$process_cd."' and work_cd='".$work_cd."' and machine_uid='".$machine_uid."' order by uid asc";
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);
		if ($total_num > 0) {
			echo "success";
		}else{
			echo "";
		}
		
	break;

	case "getProductPerfReportsVal" :
		
		$query = "select * from erp_product_perf_repost where work_cd='".$work_cd."' limit 0, 1";
		//echo "query=". $query;
		$result = mysql_query($query);
		
		$i = 0;

		$t = @mysql_fetch_object($result);

			$re['uid'] = $t->uid;
			$re['production_dt'] = $t->production_dt;
			$re['production_cd'] = $t->production_cd;
			$re['day_gubun'] = $t->day_gubun;
			$re['process_cd'] = $t->process_cd;
			$re['process_nm'] = $t->process_nm;
			$re['machine_nm'] = $t->machine_nm;
			$re['p_plan_tm'] = $t->p_plan_tm;
			$re['order_qty'] = number_format($t->order_qty);
			$re['p_now_tm'] = $t->p_now_tm;
			$re['target_qty'] = number_format($t->target_qty);
			$re['output_qty'] = number_format($t->output_qty);
			$re['working_efficiency'] = number_format($t->working_efficiency);
			$re['item_cd'] = $t->item_cd;
			$re['item_nm'] = $t->item_nm;
			$re['standard1'] = $t->standard1;
			$re['pass_qty'] = number_format($t->pass_qty);
			$re['work_cd'] = $t->work_cd;
			$re['publish_qty'] = number_format($t->publish_qty);
			$re['emp_id'] = $t->emp_id;
			$re['emp_nm'] = $t->emp_nm;
			$re['writer'] = $t->writer;
			$re['faulty_qty1'] = $t->faulty_qty1;
			$re['faulty_type1'] = $t->faulty_type1;
			$re['faulty_qty2'] = $t->faulty_qty2;
			$re['faulty_type2'] = $t->faulty_type2;
			$re['faulty_qty3'] = $t->faulty_qty3;
			$re['faulty_type3'] = $t->faulty_type3;
			$re['faulty_qty4'] = $t->faulty_qty4;
			$re['faulty_type4'] = $t->faulty_type4;
			$re['faulty_qty5'] = $t->faulty_qty5;
			$re['faulty_type5'] = $t->faulty_type5;
			$re['faulty_qty6'] = $t->faulty_qty6;
			$re['faulty_type6'] = $t->faulty_type6;
			$re['faulty_qty7'] = $t->faulty_qty7;
			$re['faulty_type7'] = $t->faulty_type7;
			$re['p_now_tm1'] = substr($t->p_plan_tm,0,5);
			$re['p_now_tm2'] = substr($t->p_plan_tm,7,12);
			$re['box_limit_qty'] = number_format($t->box_limit_qty);
			$re['loss_item'] = $t->loss_item;
			$re['loss_time'] = $t->loss_time;

		echo $json->encode($re);
	break;

	//새로만듬 ..
	case "getProductPerfReportsVal2" :

		$sql2 = "select item_cd from erp_item where uid=".$item_uid;
		$result = mysql_fetch_object(mysql_query($sql2));
		
		$query = "select * from erp_product_perf_repost where work_cd='".$work_cd."' and item_cd='".$result->item_cd."' limit 0, 1";
		//echo "query=". $query;
		$result = mysql_query($query);
		
		$i = 0;

		$t = @mysql_fetch_object($result);

			$re['uid'] = $t->uid;
			$re['production_dt'] = $t->production_dt;
			$re['production_cd'] = $t->production_cd;
			$re['day_gubun'] = $t->day_gubun;
			$re['process_cd'] = $t->process_cd;
			$re['process_nm'] = $t->process_nm;
			$re['machine_nm'] = $t->machine_nm;
			$re['p_plan_tm'] = $t->p_plan_tm;
			$re['order_qty'] = number_format($t->order_qty);
			$re['p_now_tm'] = $t->p_now_tm;
			$re['target_qty'] = number_format($t->target_qty);
			$re['output_qty'] = number_format($t->output_qty);
			$re['working_efficiency'] = number_format($t->working_efficiency);
			$re['item_cd'] = $t->item_cd;
			$re['item_nm'] = $t->item_nm;
			$re['standard1'] = $t->standard1;
			$re['pass_qty'] = number_format($t->pass_qty);
			$re['work_cd'] = $t->work_cd;
			$re['publish_qty'] = number_format($t->publish_qty);
			$re['emp_id'] = $t->emp_id;
			$re['emp_nm'] = $t->emp_nm;
			$re['writer'] = $t->writer;
			$re['faulty_qty1'] = $t->faulty_qty1;
			$re['faulty_type1'] = $t->faulty_type1;
			$re['faulty_qty2'] = $t->faulty_qty2;
			$re['faulty_type2'] = $t->faulty_type2;
			$re['faulty_qty3'] = $t->faulty_qty3;
			$re['faulty_type3'] = $t->faulty_type3;
			$re['faulty_qty4'] = $t->faulty_qty4;
			$re['faulty_type4'] = $t->faulty_type4;
			$re['faulty_qty5'] = $t->faulty_qty5;
			$re['faulty_type5'] = $t->faulty_type5;
			$re['faulty_qty6'] = $t->faulty_qty6;
			$re['faulty_type6'] = $t->faulty_type6;
			$re['faulty_qty7'] = $t->faulty_qty7;
			$re['faulty_type7'] = $t->faulty_type7;
			$re['p_now_tm1'] = substr($t->p_plan_tm,0,5);
			$re['p_now_tm2'] = substr($t->p_plan_tm,7,12);
			$re['box_limit_qty'] = number_format($t->box_limit_qty);
			$re['loss_item'] = $t->loss_item;
			$re['loss_time'] = $t->loss_time;
			$re['LOT_NO'] = $t->LOT_NO;	//공정이동 lot

		echo $json->encode($re);
	break;

	case "deleteSelectProductPerfReports" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_product_perf_repost where uid=".$array_uid[$i];
			mysql_query($query);
		}
		echo "success";
	break;


	case "getProductPerfReportsLotNo" :
		$where = " where fid =".$fid.""; 
		$query = "select * from erp_bom".$where." order by uid desc";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {

			$sql = "select lot_no_cd, lot_no_nm, warehousing_cd, regdate from erp_warehousing_item where item_cd='".$t->item_cd."' and standard1 = '".$t->standard1."' ";
			//echo $sql."<BR>"; 
			$t2 = @mysql_fetch_object(mysql_query($sql));
			if($t2->lot_no_cd=="" || $t2->lot_no_cd=="null"){
				$lot_no_cd = "";
			}else{
				$lot_no_cd = $t2->lot_no_cd;
			}
			
			if($t2->lot_no_nm=="" || $t2->lot_no_cd=="null"){
				$lot_no_nm = "";
			}else{
				$lot_no_nm = $t2->lot_no_nm;
			}
			
			if($t2->regdate=="" || $t2->lot_no_cd=="null"){
				$regdate = "미입고";
			}else{
				$regdate = $t2->regdate;
			}
			
			if($t2->warehousing_cd=="" || $t2->warehousing_cd=="null"){
				$warehousing_cd = "";
			}else{
				$warehousing_cd = $t2->warehousing_cd;
			}

			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['lot_no_cd'] = $lot_no_cd;
			$re[$i]['lot_no_nm'] = $lot_no_nm;
			$re[$i]['warehousing_cd'] = $warehousing_cd;
			$re[$i]['regdate_item'] = substr($regdate,0,10);
			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;

	///////////////////// 새로만듬 
	case "getProductPerfReportsLotNo2" :
		$where = " where fid =".$fid.""; 
		$query = "select * from erp_bom".$where." order by uid desc";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {

			$sql = "select uid from erp_product_perf_repost where work_cd='".$work_cd."' ";
			$t2 = @mysql_fetch_object(mysql_query($sql));

			$sql3 = "select * from erp_product_perf_repost_item where fid=".$t2->uid." and item_cd='".$t->item_cd."' and standard1='".$t->standard1."' ";
			$t3 = @mysql_fetch_object(mysql_query($sql3));

			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['lot_no_cd'] = $t3->lot_no_cd;
			$re[$i]['regdate_item'] = substr($t3->regdate,0,10);
			$re[$i]['cnt'] = $t->cnt; //소요량
			//$re[$i]['regdate_item'] = substr($regdate,0,10);
			//$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;

	case "getProductPerfReportsLotNoList" :
		$where = " where fid =".$fid.""; 
		$query = "select * from erp_product_perf_repost_item ".$where." order by uid desc";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			
			
			$sql = "select lot_no_cd, lot_no_nm, warehousing_cd, regdate from erp_warehousing_item where item_cd='".$t->item_cd."'";
			//echo $sql."<BR>"; 
			$t2 = @mysql_fetch_object(mysql_query($sql));
			if($t2->lot_no_cd=="" || $t2->lot_no_cd=="null"){
				$lot_no_cd = "";
			}else{
				$lot_no_cd = $t2->lot_no_cd;
			}
			
			if($t2->lot_no_nm=="" || $t2->lot_no_cd=="null"){
				$lot_no_nm = "";
			}else{
				$lot_no_nm = $t2->lot_no_nm;
			}
			
			if($t2->regdate=="" || $t2->lot_no_cd=="null"){
				$regdate = "미입고";
			}else{
				$regdate = $t2->regdate;
			}
			
			if($t2->warehousing_cd=="" || $t2->warehousing_cd=="null"){
				$warehousing_cd = "";
			}else{
				$warehousing_cd = $t2->warehousing_cd;
			}
			

			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['lot_no_cd'] = $t->lot_no_cd;
			$re[$i]['lot_no_nm'] = $t->lot_no_nm;
			$re[$i]['warehousing_cd'] = $t->warehousing_cd;
			$re[$i]['warehousing_dt'] = substr($t->warehousing_dt,0,10);
			$re[$i]['regdate_item'] = substr($regdate,0,10);
			$re[$i]['regdate'] = substr($t2->warehousing_dt,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;

			//작업지시서 종결
	case "endSelectWorkOrder" :
			$query = "update erp_work set state='4' where uid=".$uid;
			mysql_query($query);
		echo "success";
	break;
			//작업지시서 종결 취소
	case "endCancelSelectWorkOrder" :
			$query = "update erp_work set state='1' where uid=".$uid;
			mysql_query($query);
		echo "success";
	break;

	// 생산입고 리스트 가져오기
	case "getProductionWearing" :
		$page = (is_numeric($page)) ? $page : 1; 

		if ($_POST['uid'] >= 0 && $_POST['uid'] != ""){
			$where=" where uid='".$_POST['uid']."'";
		}else{
			$where="";
		}
		
		if($rpp == "all") $query = "select * from erp_production_wearing".$where." order by uid desc";
		else $query = "select * from erp_production_wearing".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$sql = "select * from erp_production_wearing_item where wid='".$t->uid."'";
			//echo $sql;
			$item = mysql_fetch_object(mysql_query($sql));

			// 해당 원자재가 출고가 되지 않은 작업지시서는 출력을 시키지 않는다
			$sql = "select status from erp_release where work_cd='".$t->work_cd."' and object_item_cd='".$t->item_cd."' and object_item_standard1='".$t->standard1."' ";
			//echo $sql;
			$release = mysql_query($sql) or die (mysql_error());
			
			$arr = array();
			
			if($_SESSION['auto_work'] != "y") {
				// 반복처리를 해서 모두다 complete 가 아니면 작업지시서를 내보내지 않는다
				while($r = mysql_fetch_object($release)) {
					if($r->status != "complete") array_push($arr,"false");
				}
				
				//var_dump($arr);

				if(!in_array("false",$arr)) {
					$re[$i]['uid'] = $t->uid;
					$re[$i]['work_cd'] = $t->work_cd;
					$re[$i]['start_dt'] = substr($t->start_dt,0,10);
					$re[$i]['end_dt'] = substr($t->end_dt,0,10);
					$re[$i]['process'] = getProcessName($item->process);
					$re[$i]['machine'] = getMachineNm($item->machine);
					$re[$i]['item_cd'] = $item->item_cd;
					$re[$i]['item_nm'] = $item->item_nm;
					$re[$i]['standard1'] = $item->standard1;
					$re[$i]['material'] = $item->material;
					$re[$i]['unit'] = $item->unit;
					$re[$i]['account_cd'] = $t->account_cd;
					$re[$i]['account_nm'] = $t->account_nm;			
					$re[$i]['order_cnt'] = number_format($item->order_cnt);
					$re[$i]['project_cd'] = $t->project_cd;
					$re[$i]['project_nm'] = $t->project_nm;
					$re[$i]['warehouse_cd'] = $t->warehouse_cd;
					$re[$i]['warehouse_nm'] = $t->warehouse_nm;
					$re[$i]['deadline_dt'] = $t->deadline_dt;
					$re[$i]['remain_cnt'] = number_format($item->remain_cnt);
					$re[$i]['make_cnt'] = number_format($item->make_cnt);
					$re[$i]['manager'] = $t->manager;
					$re[$i]['state'] = $t->state;
					$re[$i]['emp_id'] = $t->emp_id;
					$re[$i]['create_dt'] = substr($t->create_dt,0,10);
					$i++;
				}
			} else {
					$re[$i]['uid'] = $t->uid;
					$re[$i]['work_cd'] = $t->work_cd;
					$re[$i]['start_dt'] = substr($t->start_dt,0,10);
					$re[$i]['end_dt'] = substr($t->end_dt,0,10);
					$re[$i]['process'] = getProcessName($item->process);
					$re[$i]['machine'] = getMachineNm($item->machine);
					$re[$i]['item_cd'] = $item->item_cd;
					$re[$i]['item_nm'] = $item->item_nm;
					$re[$i]['standard1'] = $item->standard1;
					$re[$i]['material'] = $item->material;
					$re[$i]['unit'] = $item->unit;
					$re[$i]['account_cd'] = $t->account_cd;
					$re[$i]['account_nm'] = $t->account_nm;			
					$re[$i]['order_cnt'] = number_format($item->order_cnt);
					$re[$i]['project_cd'] = $t->project_cd;
					$re[$i]['project_nm'] = $t->project_nm;
					$re[$i]['warehouse_cd'] = $t->warehouse_cd;
					$re[$i]['warehouse_nm'] = $t->warehouse_nm;
					$re[$i]['deadline_dt'] = $t->deadline_dt;
					$re[$i]['remain_cnt'] = number_format($item->remain_cnt);
					$re[$i]['make_cnt'] = number_format($item->make_cnt);
					$re[$i]['manager'] = $t->manager;
					$re[$i]['state'] = $t->state;
					$re[$i]['emp_id'] = $t->emp_id;
					$re[$i]['create_dt'] = substr($t->create_dt,0,10);
				$i++;
			}

			unset($arr);
		}

		echo $json->encode($re);
	break;

				//작업지시서 종결
	case "endSelectProductionWearing" :
			$query = "update erp_production_wearing set state='4' where uid=".$uid;
			mysql_query($query);
		echo "success";
	break;
			//작업지시서 종결 취소
	case "endCancelSelectProductionWearing" :
			$query = "update erp_production_wearing set state='1' where uid=".$uid;
			mysql_query($query);
		echo "success";
	break;
	
	case "getWorkDailyReport" :

		$where = " where 1=1";
		
		if($search_txt != "") {
			$where .= " and (work_report_cd like '%".$search_txt."%' or emp_nm like '%".$search_txt."%' or item_cd like '%".$search_txt."%')";
		}

		if($start_dt != "" && $end_dt != "") {
			$where .= " AND ( left(work_report_dt,10) between '".$start_dt."' and '".$end_dt."')";
		}

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_work_daily_report".$where." order by uid desc";
		else $query = "select * from erp_work_daily_report".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo "query=". $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);

		$i = 0;
		$ct = 1;
		$cnt=="";

		while($t = @mysql_fetch_object($result)) {
			//$sql = "select uid from erp_workplan_item where workplan_cd='".$t->workplan_cd."'";
			//$cnt = mysql_num_rows(mysql_query($sql));

			$re[$i]['uid'] = $t->uid;
			$re[$i]['work_report_dt'] = $t->work_report_dt;
			$re[$i]['day_gubun'] = $t->day_gubun;
			$re[$i]['process_cd'] = $t->process_cd;
			$re[$i]['machine_nm'] = $t->machine_nm;
			$re[$i]['p_plan_tm'] = $t->p_plan_tm;
			$re[$i]['order_qty'] = $t->order_qty;
			$re[$i]['p_now_tm'] = $t->p_now_tm;
			$re[$i]['process_nm'] = $t->process_nm;
			$re[$i]['target_qty'] = number_format($t->target_qty);
			$re[$i]['output_qty'] = number_format($t->output_qty);
			$re[$i]['working_efficiency'] = number_format($t->working_efficiency);
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['material'] = $t->material;
			$re[$i]['pass_qty'] = number_format($t->pass_qty);
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['publish_qty'] = number_format($t->publish_qty);
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['writer'] = $t->writer;
			$re[$i]['faulty_qty1'] = number_format($t->faulty_qty1);
			$re[$i]['faulty_type1'] = $t->faulty_type1;
			$re[$i]['faulty_qty2'] = number_format($t->faulty_qty2);
			$re[$i]['faulty_type2'] = $t->faulty_type2;
			$re[$i]['p_now_tm1'] = substr($t->p_plan_tm,0,5);
			$re[$i]['p_now_tm2'] = substr($t->p_plan_tm,7,12);
			$re[$i]['box_limit_qty'] = number_format($t->box_limit_qty);
			$re[$i]['loss_item'] = $t->loss_item;
			$re[$i]['loss_time'] = $t->loss_time;
			$i++;
		}

		echo $json->encode($re);
	break;
	
	//작업일보 프린트
	case "getWorkDailyReportPrint" :

		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_work_daily_report".$where." order by uid desc";
		else $query = "select * from erp_work_daily_report".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo "query=". $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);

		$i = 0;
		$ct = 1;
		$cnt=="";

		while($t = @mysql_fetch_object($result)) {
			//$sql = "select uid from erp_workplan_item where workplan_cd='".$t->workplan_cd."'";
			//$cnt = mysql_num_rows(mysql_query($sql));

			$re[$i]['uid'] = $t->uid;
			$re[$i]['work_report_dt'] = $t->work_report_dt;
			$re[$i]['day_gubun'] = $t->day_gubun;
			$re[$i]['process_cd'] = $t->process_cd;
			$re[$i]['machine_nm'] = $t->machine_nm;
			$re[$i]['p_plan_tm'] = $t->p_plan_tm;
			$re[$i]['order_qty'] = $t->order_qty;
			$re[$i]['p_now_tm'] = $t->p_now_tm;
			$re[$i]['process_nm'] = $t->process_nm;
			$re[$i]['target_qty'] = number_format($t->target_qty);
			$re[$i]['output_qty'] = number_format($t->output_qty);
			$re[$i]['working_efficiency'] = number_format($t->working_efficiency);
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['material'] = $t->material;
			$re[$i]['pass_qty'] = number_format($t->pass_qty);
			$re[$i]['work_cd'] = $t->work_cd;
			$re[$i]['publish_qty'] = number_format($t->publish_qty);
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['writer'] = $t->writer;
			$re[$i]['faulty_qty1'] = number_format($t->faulty_qty1);
			$re[$i]['faulty_type1'] = $t->faulty_type1;
			$re[$i]['faulty_qty2'] = number_format($t->faulty_qty2);
			$re[$i]['faulty_type2'] = $t->faulty_type2;
			$re[$i]['p_now_tm1'] = substr($t->p_plan_tm,0,5);
			$re[$i]['p_now_tm2'] = substr($t->p_plan_tm,7,12);
			$re[$i]['box_limit_qty'] = number_format($t->box_limit_qty);
			$re[$i]['loss_item'] = $t->loss_item;
			$re[$i]['loss_time'] = $t->loss_time;
			$i++;
		}

		echo $json->encode($re);
	break;

	case "deleteSelectWorkDailyReport" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_work_daily_report where uid=".$array_uid[$i];
			mysql_query($query);
		}
		echo "success";
	break;

	case "getWorkDailyReportLotNo" :
		$where = " where fid =".$fid. " and fid >'0'"; 
		$query = "select * from erp_bom".$where." order by uid desc";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {

			$sql = "select lot_no_cd, lot_no_nm, regdate from erp_warehousing_item where item_cd='".$t->item_cd."'";
			//echo $sql."<BR>"; 
			$t2 = @mysql_fetch_object(mysql_query($sql));
			if($t2->lot_no_cd=="" || $t2->lot_no_cd=="null"){
				$lot_no_cd = "";
			}else{
				$lot_no_cd = $t2->lot_no_cd;
			}
			
			if($t2->lot_no_nm=="" || $t2->lot_no_cd=="null"){
				$lot_no_nm = "";
			}else{
				$lot_no_nm = $t2->lot_no_nm;
			}
			
			if($t2->regdate=="" || $t2->lot_no_cd=="null"){
				$regdate = "미입고";
			}else{
				$regdate = $t2->regdate;
			}

			$re[$i]['uid'] = $t->uid;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard1'] = $t->standard1;
			$re[$i]['material'] = $t->material;
			$re[$i]['lot_no_cd'] = $lot_no_cd;
			$re[$i]['lot_no_nm'] = $lot_no_nm;
			$re[$i]['regdate_item'] = substr($regdate,0,10);
			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
		}

		echo $json->encode($re);
	break;
	

	// 생산 입고 가져오기
	case "getProductInto" :
		$page = (is_numeric($page)) ? $page : 1; 

		if ($_POST['uid'] >= 0 && $_POST['uid'] != ""){
			$where=" where uid='".$_POST['uid']."'";
		}else{
			$where="";
		}
		
		if($rpp == "all") $query = "select * from erp_production_into".$where." order by uid desc";
		else $query = "select * from erp_production_into".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			$sql = "select * from erp_production_into_item where fid='".$t->uid."'";
			//echo $sql;
			$item = mysql_fetch_object(mysql_query($sql));

			// 해당 원자재가 출고가 되지 않은 작업지시서는 출력을 시키지 않는다
			$sql = "select status from erp_release where work_cd='".$t->work_cd."' and object_item_cd='".$t->item_cd."' and object_item_standard1='".$t->standard1."' ";
			//echo $sql;
			$release = mysql_query($sql) or die (mysql_error());
			
			$arr = array();
			
			if($_SESSION['auto_work'] != "y") {
				// 반복처리를 해서 모두다 complete 가 아니면 작업지시서를 내보내지 않는다
				while($r = mysql_fetch_object($release)) {
					if($r->status != "complete") array_push($arr,"false");
				}
				
				//var_dump($arr);

				if(!in_array("false",$arr)) {
					$re[$i]['uid'] = $t->uid;
					$re[$i]['work_cd'] = $t->work_cd;
					$re[$i]['start_dt'] = substr($t->start_dt,0,10);
					$re[$i]['end_dt'] = substr($t->end_dt,0,10);
					$re[$i]['process'] = getProcessName($item->process);
					$re[$i]['machine'] = getMachineNm($item->machine);
					$re[$i]['item_cd'] = $item->item_cd;
					$re[$i]['item_nm'] = $item->item_nm;
					$re[$i]['standard1'] = $item->standard1;
					$re[$i]['material'] = $item->material;
					$re[$i]['unit'] = $item->unit;
					$re[$i]['account_cd'] = $t->account_cd;
					$re[$i]['account_nm'] = $t->account_nm;			
					$re[$i]['order_cnt'] = number_format($item->order_cnt);
					$re[$i]['project_cd'] = $t->project_cd;
					$re[$i]['project_nm'] = $t->project_nm;
					$re[$i]['warehouse_cd'] = $t->warehouse_cd;
					$re[$i]['warehouse_nm'] = $t->warehouse_nm;
					$re[$i]['deadline_dt'] = $t->deadline_dt;
					$re[$i]['remain_cnt'] = number_format($item->remain_cnt);
					$re[$i]['make_cnt'] = number_format($item->make_cnt);
					$re[$i]['manager'] = $t->manager;
					$re[$i]['state'] = $t->state;
					$re[$i]['emp_id'] = $t->emp_id;
					$re[$i]['create_dt'] = substr($t->create_dt,0,10);
					$i++;
				}
			} else {
					$re[$i]['uid'] = $t->uid;
					$re[$i]['p_into_cd'] = $t->p_into_cd;
					$re[$i]['work_cd'] = $t->work_cd;
					$re[$i]['process'] = getProcessName($item->process);
					$re[$i]['wh_cd_f_nm'] = $t->wh_cd_f_nm;
					$re[$i]['warehouse_nm'] = $t->warehouse_nm;
					$re[$i]['item_cd'] = $item->item_cd;
					$re[$i]['item_nm'] = $item->item_nm;
					$re[$i]['standard1'] = $item->standard1;
					$re[$i]['material'] = $item->material;
					$re[$i]['unit'] = $item->unit;
					$re[$i]['cnt'] = number_format($item->cnt);
					$re[$i]['order_cnt'] = number_format($item->order_cnt);
					$re[$i]['cntTotal'] = number_format($t->cntTotal);			
					$re[$i]['project_cd'] = $t->project_cd;
					$re[$i]['project_nm'] = $t->project_nm;
					$re[$i]['warehouse_cd'] = $t->warehouse_cd;
					$re[$i]['warehouse_nm'] = $t->warehouse_nm;
					$re[$i]['remark'] = $t->remark;
					$re[$i]['manager'] = $t->manager;
					$re[$i]['state'] = $t->state;
					$re[$i]['emp_id'] = $t->emp_id;
					$re[$i]['emp_nm'] = $item->emp_nm;
					$re[$i]['create_dt'] = substr($t->create_dt,0,10);
				$i++;
			}

			unset($arr);
		}

		echo $json->encode($re);
	break;

	//생산입고 아이템 프린트
	case "getProductionIntoItem" :

		$query = "select * from erp_production_into_item where fid='".$uid."' order by uid desc";
		//echo "query=". $query;
		$result = mysql_query($query);
		$total_num = mysql_num_rows($result);

		$i = 0;
		$ct = 1;
		$cnt=="";

		while($t = @mysql_fetch_object($result)) {
			//$sql = "select uid from erp_workplan_item where workplan_cd='".$t->workplan_cd."'";
			//$cnt = mysql_num_rows(mysql_query($sql));

			$re[$i]['uid']			= $t->uid;
			$re[$i]['process']		= $t->process;
			$re[$i]['machine']		= $t->machine;
			$re[$i]['item_cd']		= $t->item_cd;
			$re[$i]['item_nm']		= $t->item_nm;
			$re[$i]['standard1']		= $t->standard1;
			$re[$i]['unit']			= $t->unit;
			$re[$i]['material']		= $t->material;
			$re[$i]['warehouse_f_cd']	= $t->warehouse_f_cd;
			$re[$i]['warehouse_f_nm']	= $t->warehouse_f_nm;
			$re[$i]['warehouse_t_cd']	= $t->warehouse_cd;
			$re[$i]['warehouse_t_nm']	= $t->warehouse_nm;
			$re[$i]['lot_no']		= $t->lot_no_cd;
			$re[$i]['addcnt']		= number_format($t->addcnt);
			$re[$i]['cnt']			= number_format($t->cnt);
			$re[$i]['order_cnt']		= number_format($t->order_cnt);
			$re[$i]['memo']			= $t->memo;
			$re[$i]['regdate']		= $t->regdate;
			$i++;
		}

		echo $json->encode($re);
	break;

	// 중부서 가져오기
	case "getPostProcessNm" :
		$sql = "select * from erp_process where process_gb='".$process_gb."' order by ranking";
		//echo $sql;
		$result = mysql_query($sql);

		$i = 0;
		while($t = @mysql_fetch_object($result)) {
			$re[$i]['uid'] = $t->uid;
			$re[$i]['process_nm'] = $t->process_nm;
			$re[$i]['ranking'] = $t->ranking;
			$i++;
		}

		echo $json->encode($re);
	break;

	case "getProductPerfReportsPirntList" :
		
		$page = (is_numeric($page)) ? $page : 1; 
		if($rpp == "all") $query = "select * from erp_product_perf_repost_lotno".$where." order by uid desc";
		else $query = "select * from erp_product_perf_repost_lotno".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);
		//echo query=". $query;
		$i = 0;

		while($t = @mysql_fetch_object($result)) {
			//$sql = "select uid from erp_workplan_item where workplan_cd='".$t->workplan_cd."'";
			//$cnt = mysql_num_rows(mysql_query($sql));

			$re[$i]['uid'] = $t->uid;
			$re[$i]['production_dt'] = $t->production_dt;
			$re[$i]['production_cd'] = $t->production_cd;
			$re[$i]['day_gubun'] = $t->day_gubun;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['lot_no'] = $t->lot_no;
			$re[$i]['output_qty'] = number_format($t->output_qty);
			$re[$i]['box_limit_qty'] = number_format($t->box_limit_qty);
			$re[$i]['publish_qty'] = number_format($t->publish_qty);
			$re[$i]['dobeon'] = $t->dobeon;
			$re[$i]['manufacture_dt'] = substr($t->manufacture_dt,0,10);
			$re[$i]['delivery_dt'] = substr($t->delivery_dt,0,10);
			$re[$i]['emp_id'] = $t->emp_id;
			$re[$i]['regdate'] = $t->regdate;
			$i++;
		}

		echo $json->encode($re);
	break;
	
	case "deleteSelectPPReportsPrint" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_product_perf_repost_lotno where uid=".$array_uid[$i];
			mysql_query($query);
		}
		echo "success";
	break;

	case "deleteSelectProduction" :	//생산입고 선택삭제
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "select uid from erp_production_into where uid=".$array_uid[$i];
			$pl = @mysql_fetch_object(mysql_query($query));

			$query = "delete from erp_production_into_item where fid='".$pl->uid."'";
			mysql_query($query);

			$query = "delete from erp_production_into where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

}
?>