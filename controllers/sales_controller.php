<?
session_start();
// 영업관리
class SalesController {
	public function __construct() {}
	
	public function movePage($controller,$action) {
		echo "<script>";
		echo "location.href = 'index.php?controller=".$controller."&action=".$action."' ";
		echo "</script>";
	}

	public function movePageClose($dialogID) {
		//echo $dialogID;
		echo "<script>";
		echo "window.parent.closeModal('".$dialogID."');";
		echo "window.parent.location.reload();";
		echo "</script>";
	}
	public function upload($file) {
		// 폴더생성
		@mkdir("attach/", 0777);

		$dir = "attach/"; //저장될 폴더 경로(끝에 '/'슬래시 꼭 붙여주세요...^^)
		chmod("$dir", 0777);

		$varName = $file; //이전 페이지에서 설정된 file 변수명
		$allowExt = "jpg,gif,png,jpeg,JPG,GIF,PNG,doc,DOC,docx,Docx"; //업로드 가능한 확장자 (,)콤마로 구분

		$prefix = time(); //파일명 앞에 자동으로 붙을 단어

		
		if($_FILES[$varName][name] && $_FILES[$varName][error] == 0) {
			// $dir 폴더가 지정됐고, 사용가능 한지 검사
			if(!$dir) {
				$this->goBack("업로드 폴더가 지정되지 않았습니다.");
				exit;
			}
			if(!is_writable($dir)) {
				$this->goBack("업로드 폴더 권한을 확인해 주세요.");
				exit;
			}

			// php.ini 파일에 설정된 upload_max_filesize 값을 이용해서 업로드 파일이 용량을 초과했는지검사
			$allowSize = intval(substr(ini_get(upload_max_filesize),0,-1)) * 1024 * 1024;
			if($allowSize < $_FILES[$varName][size]) {
				$this->goBack("파일 용량이 허용된 용량을 초과했습니다.");
				exit;
			}

			// 정상적인 방법으로 업로드 된 파일인지 검사 후 정상이면 파일 업로드 처리
			if(is_uploaded_file($_FILES[$varName][tmp_name])) {
				// 확장자 검사
				$ext = substr(strrchr($_FILES[$varName][name],"."),1);
				if($ext) {
					$allow = explode(",",$allowExt);
					if(is_array($allow)) $check = in_array($ext,$allow);
					else $check = ($ext == $allow) ? true : false;
				}
		
				if(!$ext || !$check) {
					$this->goBack("업로드 불가능한 확장자 입니다.");
					exit;
				}

				//한글파일명 변환 20180911
				$filename = iconv("UTF-8", "cp949", $_FILES[$varName][name]);
				
				// 파일명 생성 및 존재하는지 검사
				// $newfile = md5($prefix.$_FILES[$varName][name]).".".$ext;
				// $newfile_name = $prefix.$_FILES[$varName][name];
				// 파일 이름중 띄어 쓰기가 들어가서 띄어쓰기 삭제
				 $newfile = $prefix.preg_replace("/\s+/","",$filename);
				
				//exit;
				if(file_exists($dir.$newfile)) {
					$this->goBack("같은이름의 화일이 있습니다. 화일명을 변경하고 업로드 하시기 바랍니다.");
					exit;
				}
				
				// $dir 에 파일 저장
				if(!move_uploaded_file($_FILES[$varName][tmp_name], $dir.$newfile)) {
					$this->goBack("파일 업로드에 실패했습니다.");
					exit;
				}
		
				if(!chmod($dir.$newfile,0707)) {
					$this->goBack("퍼미션변경에 실패했습니다.");
					exit;
				}
				
				//디비에 다시 저장하기 위한 한글파일명 변환 20180911
				$newfile = iconv("cp949", "UTF-8", $newfile);

				return $newfile;
			}
		}
	}
	
	public function replaceComma($num) {
		$number = (int)str_replace(",","",$num);
		return $number;
	}

/******************************************************************************************************
:: 견적관리
******************************************************************************************************/
	// 견적서 리스트 페이지
	public function listPageEstimate(){
		require_once ("views/sales/listEstimate.php");
	}

	// 견적서 등록 페이지
	//public function inputPageEstimate(){
	//	require_once ("views/sales/createEstimate.php");
	//}

		// 견적서 등록 페이지
	public function registPageEstimatePop(){
		require_once ("views/sales/createEstimate_pop.php");
	}

	public function modifyPageEstimatePop(){
		$t = Sales::getEstimate($_GET['uid']);
		require_once ("views/sales/modifyEstimate_pop.php");
	}
	
	// 견적서 등록 실행
	public function inputPageEstimate() {
		$sales = new Sales;
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');

		$sql = "select max(estimate_cha) as cnt from erp_estimate where estimate_dt='".$_POST['estimate_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));

		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$estimate_cha = "1";
		}else{
			$estimate_cha = $t0->cnt+1;
		}

		$estimate_cd  = $_POST['estimate_dt']."-".$estimate_cha;

		if($_POST['final'] == "y") {
			$data = array (
				"table" => "erp_estimate",
				"where" => "estimate_cd='".$_POST['estimate_cd']."'",
				"final" => 'n'
			);
			$sales->update($data);
		}

		$data = array(
			"table" => "erp_estimate",
			"estimate_cd" => $estimate_cd,
			"estimate_dt" => $_POST['estimate_dt'],
			"estimate_cha" => $estimate_cha,
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"manager" => $_POST['manager'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"tax_type" => $_POST['tax_type'],
			"currency" => $_POST['currency'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"refer" => $_POST['refer'],
			"payment_condition" => $_POST['payment_condition'],
			"delivery_dt" => $_POST['delivery_dt'],
			"attach" => $fileAttach,
			"cntTotal" => $this->replaceComma($_POST['cntTotal']),
			"unitPriceTotal" => $this->replaceComma($_POST['unitPriceTotal']),
			"supplyPriceTotal" => $this->replaceComma($_POST['supplyPriceTotal']),
			"taxTotal" => $this->replaceComma($_POST['taxTotal']),
			"priceTotal" => $this->replaceComma($_POST['priceTotal']),
			"final" => $_POST['final'],
			"state" => $_POST['state'],
			"used" => "n",
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);
		
		$sales->insert($data);
		$fid = mysql_insert_id();

		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard1 = $_POST['standard1'];
		$standard2 = $_POST['standard2'];
		$standard3 = $_POST['standard3'];
		$material = $_POST['material'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];		
		$unit_price = $_POST['unit_price'];
		$adjustments = $_POST['adjustments'];
		$supply_price = $_POST['supply_price'];
		$tax = $_POST['tax'];
		$total_price = $_POST['total_price'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"			=> "erp_estimate_item",
					"fid"			=> $fid,
					"item_cd"		=> $val,
					"item_nm"		=> $item_nm[$key],
					"standard1"		=> $standard1[$key],
					"standard2"		=> $standard2[$key],
					"standard3"		=> $standard3[$key],
					"material"		=> $material[$key],
					"unit"			=> $unit[$key],
					"cnt"			=> $this->replaceComma($cnt[$key]),					
					"unit_price"	=> $this->replaceComma($unit_price[$key]),
					"adjustments"	=> $this->replaceComma($adjustments[$key]),
					"supply_price"	=> $this->replaceComma($supply_price[$key]),
					"tax"			=> $this->replaceComma($tax[$key]),
					"total_price"	=> $this->replaceComma($total_price[$key])
				);
				$sales->insert($data);
			}
		}

		$this->movePageClose($_POST['dialogID']);
		//$this->movePage("sales","listPageEstimate");
	}
	
	// 견적서 수정 페이지
	public function modifyPageEstimate(){
		$t = Sales::getEstimate($_GET['uid']);
		require_once ("views/sales/modifyEstimate.php");
	}
	
	// 견적서 등록 실행
	public function updatePageEstimate() {
		$sales = new Sales;
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
	
		$sql = "select max(estimate_cha) as cnt from erp_estimate where estimate_dt='".$_POST['estimate_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));

		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$estimate_cha = "1";
		}else{
			$estimate_cha = $t0->cnt+1;
		}
	

		$estimate_cd  = $_POST['estimate_dt']."-".$estimate_cha;

		if($_POST['final'] == "y") {
			$data = array (
				"table" => "erp_estimate",
				"where" => "estimate_cd='".$_POST['estimate_cd']."'",
				"final" => 'n'
			);
			$sales->update($data);
		}

		$data = array(
			"table" => "erp_estimate",
			"where" => "uid=".$_POST['uid'],
			"estimate_cd" => $estimate_cd,
			"estimate_dt" => $_POST['estimate_dt'],
			"estimate_cha" => $estimate_cha,
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"manager" => $_POST['manager'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"tax_type" => $_POST['tax_type'],
			"currency" => $_POST['currency'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"refer" => $_POST['refer'],
			"payment_condition" => $_POST['payment_condition'],
			"delivery_dt" => $_POST['delivery_dt'],
			"attach" => $fileAttach,
			"cntTotal" => $this->replaceComma($_POST['cntTotal']),
			"unitPriceTotal" => $this->replaceComma($_POST['unitPriceTotal']),
			"supplyPriceTotal" => $this->replaceComma($_POST['supplyPriceTotal']),
			"taxTotal" => $this->replaceComma($_POST['taxTotal']),
			"priceTotal" => $this->replaceComma($_POST['priceTotal']),
			"final" => $_POST['final'],
			"state" => "1",
			"used" => "n",
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);
		
		$sales->update($data);
		
		$sql = "delete from erp_estimate_item where fid='".$_POST['uid']."'";
		mysql_query($sql);

		$item_cd		= $_POST['item_cd'];
		$item_nm		= $_POST['item_nm'];
		$standard1		= $_POST['standard1'];
		$standard2		= $_POST['standard2'];
		$standard3		= $_POST['standard3'];
		$material		= $_POST['material'];
		$unit			= $_POST['unit'];
		$cnt			= $_POST['cnt'];		
		$unit_price		= $_POST['unit_price'];
		$tariff			= $_POST['tariff'];
		$adjustments	= $_POST['adjustments'];
		$supply_price	= $_POST['supply_price'];
		$tax			= $_POST['tax'];
		$total_price	= $_POST['total_price'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"			=> "erp_estimate_item",
					"fid"			=> $_POST['uid'],
					"item_cd"		=> $val,
					"item_nm"		=> $item_nm[$key],
					"standard1"		=> $standard1[$key],
					"standard2"		=> $standard2[$key],
					"standard3"		=> $standard3[$key],
					"material"		=> $material[$key],
					"unit"			=> $unit[$key],
					"cnt"			=> $this->replaceComma($cnt[$key]),					
					"unit_price"	=> $this->replaceComma($unit_price[$key]),
					"tariff"		=> $tariff[$key],
					"adjustments"	=> $this->replaceComma($adjustments[$key]),
					"supply_price"	=> $this->replaceComma($supply_price[$key]),
					"tax"			=> $this->replaceComma($tax[$key]),
					"total_price"	=> $this->replaceComma($total_price[$key])
				);
				$sales->insert($data);
			}
		}

		$this->movePageClose($_POST['dialogID']);
		//$this->movePage("sales","listPageEstimate");
	}
/******************************************************************************************************
:: 수주관리
******************************************************************************************************/	
	// 수주 리스트 페이지
	public function listPageOrder(){
		require_once ("views/sales/listOrder.php");
	}
	
	// 수주 등록 페이지
	//public function inputPageOrder(){
	//	require_once ("views/sales/createOrder.php");
	//}
	
	// 견적서 등록 페이지
	public function registPageOrderPop(){
		require_once ("views/sales/createOrder_pop.php");
	}

	public function modifyPageOrderPop(){
		$t = Sales::getOrder($_GET['uid']);
		require_once ("views/sales/modifyOrder_pop.php");
	}

	
	// 수주서 등록 실행
	public function inputPageOrder() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
		$sql = "select max(order_cha) as cnt from erp_order where order_dt='".$_POST['order_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));

		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$order_cha = "1";
		}else{
			$order_cha = $t0->cnt+1;
		}

		$order_cd  = $_POST['order_dt']."-".$order_cha;
		
		$data = array(
			"table" => "erp_order",
			"order_dt" => $_POST['order_dt'],
			"order_cha" => $order_cha,
			"order_cd" => $order_cd,
			"estimate_cd" => $_POST['estimate_cd'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"manager" => $_POST['manager'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"tax_type" => $_POST['tax_type'],
			"currency" => $_POST['currency'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"refer" => $_POST['refer'],
			"payment_condition" => $_POST['payment_condition'],
			"delivery_dt" => $_POST['delivery_dt'],
			"attach" => $fileAttach,
			"cntTotal" => $this->replaceComma($_POST['cntTotal']),
			"unitPriceTotal" => $this->replaceComma($_POST['unitPriceTotal']),
			"supplyPriceTotal" => $this->replaceComma($_POST['supplyPriceTotal']),
			"taxTotal" => $this->replaceComma($_POST['taxTotal']),
			"priceTotal" => $this->replaceComma($_POST['priceTotal']),
			"state" => "1",
			"receivable" => "y",
			"receivable_price" => 0,
			"remark" => $_POST['remark'],
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);

		$sales = new Sales;
		$sales->insert($data);
		$fid = mysql_insert_id();
		$order_uid = $fid;

		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard1 = $_POST['standard1'];
		$standard2 = $_POST['standard2'];
		$standard3 = $_POST['standard3'];
		$material = $_POST['material'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$unit_price = $_POST['unit_price'];
		//$tariff = $_POST['tariff'];
		//$adjustments = $_POST['adjustments'];
		$supply_price = $_POST['supply_price'];
		$tax = $_POST['tax'];
		$total_price = $_POST['total_price'];

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

		foreach($item_cd as $key => $val) {
			$r_cnt = $this->replaceComma($cnt[$key]);
			$r_unit_price = $this->replaceComma($unit_price[$key]);
			$r_tariff = $tariff[$key];
			$r_adjustments = $this->replaceComma($adjustments[$key]);
			$r_supply_price = $this->replaceComma($supply_price[$key]);
			$r_tax = $this->replaceComma($tax[$key]);
			$r_total_price = $this->replaceComma($total_price[$key]);

			if($val != "") {
				$sql = "select uid from erp_item where item_cd='".$val."' and standard1='".$standard1[$key]."' ";
				//echo "1번 : ".$sql."<br>";
				$t1 = mysql_fetch_object(mysql_query($sql));

				$sql = "select * from erp_bom where fid=".$t1->uid." order by uid desc";
				//echo "2번 : ".$sql."<br>";
				$result1 = @mysql_query($sql);

				$i = 0;
				
				if(@mysql_num_rows($result1) > 0) {
					while($t2 = @mysql_fetch_object($result1)) {
						$sql = "select uid from erp_item where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."' ";
						//echo "3번 : ".$sql."<br>";
						$t3 = @mysql_fetch_object(mysql_query($sql));
						
						$sql = "select * from erp_bom where fid=".$t3->uid." order by uid desc";
						//echo "4번 : ".$sql."<br>";
						$result2 = @mysql_query($sql);

						if(@mysql_num_rows($result2)) {
							while($t4 = @mysql_fetch_object($result2)) {
								$sql = "select uid from erp_item where item_cd='".$t4->item_cd."' and standard1='".$t4->standard1."' ";
								//echo "5번 : ".$sql."<br>";
								$t5 = @mysql_fetch_object(mysql_query($sql));
						
								$sql = "select * from erp_bom where fid=".$t5->uid." order by uid desc";
								//echo "6번 : ".$sql."<br>";
								$result3 = @mysql_query($sql);	
								
								if(@mysql_num_rows($result3)) {
									while($t6 = @mysql_fetch_object($result3)) {
										$sql = "select uid from erp_item where item_cd='".$t6->item_cd."' and standard1='".$t6->standard1."' ";
										//echo "7번 : ".$sql."<br>";
										$t7 = @mysql_fetch_object(mysql_query($sql));
								
										$sql = "select * from erp_bom where fid=".$t7->uid." order by uid desc";
										//echo "8번 : ".$sql."<br>";
										$result4 = @mysql_query($sql);	

										if(@mysql_num_rows($result4)) {
											// 하위 BOM 이 더 있을 경우 반복처리 하면 됨
										} else {
											// 소요량
											$ocnt = $t6->cnt * $t4->cnt * $r_cnt;
											// 현재고량
											$sql = "select remain_cnt from erp_stock where item_cd='".$t6->item_cd."' and standard1='".$t6->standard1."' ";
											//echo "9번 : ".$sql."<br>";
											$ccnt = @mysql_fetch_object(mysql_query($sql));
											// 구매할 수량
											$bcnt = $ccnt->remain_cnt - $ocnt;
						
											if($bcnt < 0) {
												$bcnt = $bcnt * -1;

												// 구매단가
												$sql = "select pur_unit_price from erp_item where item_cd='".$t6->item_cd."' and standard1='".$t6->standard1."' ";
												//echo "10번 : ".$sql."<br>";
												$cost = mysql_fetch_object(mysql_query($sql));
												// 합계구매금액
												$sub_total_price = $bcnt * $cost->pur_unit_price;
												// 세금
												$sub_tax = $sub_total_price / 10;
												$pur_total_price = $sub_total_price + $sub_tax;

												$sql = "insert into tem_bom (item_cd, item_nm, standard1, standard2, standard3, material, cnt) values ('$t6->item_cd','$t6->item_nm','$t6->standard1','$t6->standard2','$t6->standard3', '$t6->material', $bcnt)";
												//echo "11번 : ".$sql."<br>";
												//echo "1번 : ".$sql;
												mysql_query($sql) or die ("error1");
											}
										}
									}
								} else {
									$ocnt = $t4->cnt * $t2->cnt * $r_cnt;
									//echo "#1 ==== item : ".$t4->item_cd." - 필요수량 : ".$ocnt."<br>";
									// 현재고량
									$sql = "select remain_cnt from erp_stock where item_cd='".$t4->item_cd."' and standard1='".$t4->standard1."' ";
									//echo "12번 : ".$sql."<br>";
									$ccnt = @mysql_fetch_object(mysql_query($sql));
									//echo $ccnt->remain_cnt."<br>";
									// 구매할 수량
									$bcnt = $ccnt->remain_cnt - $ocnt;
									//echo $bcnt."<br>";
									//if($bcnt < 0) {
										$bcnt = $bcnt * -1;

										// 구매단가
										$sql = "select pur_unit_price from erp_item where item_cd='".$t4->item_cd."' and standard1='".$t4->standard1."' ";
										//echo "13번 : ".$sql."<br>";
										$cost = mysql_fetch_object(mysql_query($sql));
										// 합계구매금액
										$sub_total_price = $bcnt * $cost->pur_unit_price;
										// 세금
										$sub_tax = $sub_total_price / 10;
										$pur_total_price = $sub_total_price + $sub_tax;

										$sql = "insert into tem_bom (item_cd, item_nm, standard1, standard2, standard3, material, cnt) values ('$t4->item_cd','$t4->item_nm','$t4->standard1','$t4->standard2','$t4->standard3',' $t4->material',$ocnt)";
										//echo "14번 : ".$sql."<br>";
										//echo "2번 : ".$sql;
										mysql_query($sql) or die ("error2");
									//}
								}
							}
						} else {
							$ocnt = $t2->cnt * $r_cnt;
							//echo "#2 ==== item : ".$t2->item_cd." - 필요수량 : ".$ocnt."<br>";
							// 현재고량
							$sql = "select remain_cnt from erp_stock where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."' ";
							//echo "15번 : ".$sql."<br>";
							$ccnt = @mysql_fetch_object(mysql_query($sql));
							// 구매할 수량
							$bcnt = $ccnt->remain_cnt - $ocnt;
							
							//if($bcnt < 0) {
								$bcnt = $bcnt * -1;

								// 구매단가
								$sql = "select pur_unit_price from erp_item where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."' ";
								//echo "16번 : ".$sql."<br>";
								$cost = mysql_fetch_object(mysql_query($sql));
								// 합계구매금액
								$sub_total_price = $bcnt * $cost->pur_unit_price;
								// 세금
								$sub_tax = $sub_total_price / 10;
								$pur_total_price = $sub_total_price + $sub_tax;

								$sql = "insert into tem_bom (item_cd, item_nm, standard1, standard2, standard3, material, cnt) values ('$t2->item_cd','$t2->item_nm','$t2->standard1','$t2->standard2','$t2->standard3',' $t2->material',$ocnt)";
								//echo "17번 : ".$sql."<br>";
								//echo "3번 : ".$sql;
								mysql_query($sql) or die ("error3");
							//}
						}
					}
				} else {
					// 소요량
					$sql = "select * from erp_bom where fid=".$t1->uid;
					//echo "18번 : ".$sql."<br>";
					//echo $sql;
					$res = @mysql_fetch_object(mysql_query($sql));

					$ocnt = $res->cnt * $r_cnt;
					//echo "#3 ==== item : ".$res->item_cd." - 필요수량 : ".$ocnt."<br>";
					// 현재고량
					$sql = "select remain_cnt from erp_stock where item_cd='".$res->item_cd."' and standard1='".$res->standard1."' ";
					//echo "19번 : ".$sql."<br>";
					$ccnt = @mysql_fetch_object(mysql_query($sql));
					// 구매할 수량
					$bcnt = $ccnt->remain_cnt - $ocnt;

					if($bcnt < 0) $bcnt = $bcnt * -1;

					// 구매단가
					$sql = "select pur_unit_price from erp_item where item_cd='".$res->item_cd."' and standard1='".$res->standard1."'";
					//echo "20번 : ".$sql."<br>";
					$cost = mysql_fetch_object(mysql_query($sql));
					// 합계구매금액
					$sub_total_price = $bcnt * $cost->pur_unit_price;
					// 세금
					$sub_tax = $sub_total_price / 10;
					$pur_total_price = $sub_total_price + $sub_tax;

					$sql = "insert into tem_bom (item_cd, item_nm, standard1, standard2, standard3, material, cnt) values ('$res->item_cd','$res->item_nm','$res->standard1','$res->standard2','$res->standard3',' $res->material',$r_cnt)";
					//echo "21번 : ".$sql."<br>";
					mysql_query($sql) or die ("error4");
				}
				
			}
//==================================================
			if($val != "") {
				$data = array(
					"table" => "erp_order_item",
					"oid" => $order_uid,
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard1" => $standard1[$key],
					"standard2" => $standard2[$key],
					"standard3" => $standard3[$key],
					"material" => $material[$key],
					"unit" => $unit[$key],
					"cnt" => $this->replaceComma($r_cnt),
					"out_cnt" => 0,
					"remain_cnt" => $this->replaceComma($r_cnt),
					"unit_price" => $this->replaceComma($r_unit_price),
					"supply_price" => $this->replaceComma($r_supply_price),
					"tax" => $this->replaceComma($r_tax),
					"total_price" => $this->replaceComma($r_total_price),
					"state" => "ing"
				);
				$sales->insert($data);
			}
		}
		//20180312 자동으로 발주서 작성되는 부분 삭제
		/*
		$sql = "select item_cd, item_nm, standard1, standard2, standard3, material, sum(cnt) as cnt from tem_bom group by item_cd, standard1";
		//echo "22번 : ".$sql."<br>";
		$result = mysql_query($sql);
		
		if(mysql_num_rows($result) > 0) {
			$data = array(
				"table" => "erp_purchase_demand",
				"purchase_cd" => "PU-".time(),
				"purchase_dt" => date("Y-m-d"),
				"order_cd" => $_POST['order_cd'],
				"project_cd" => $_POST['project_cd'],
				"project_nm" => $_POST['project_nm'],
				"warehouse_cd" => $_POST['warehouse_cd'],
				"memo" => "",
				"attach" => "",
				"used" => "n",
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => date("Y-m-d")
			);
			$sales->insert($data);
			$sfid = mysql_insert_id();
		}
		
		// 전자결재 자동으로 건너뛸 때 필요한 스크립트
		if($_SESSION['auto_purchase'] == "y") {
			$sql = "select * from erp_purchase_demand where uid=".$sfid;
			$demand = @mysql_fetch_object(mysql_query($sql));
		}

		while($t = mysql_fetch_object($result)) {
			// 해당 품목의 총 재고수량 가져오기
			$sql = "select remain_cnt from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' ";
			$stock = mysql_fetch_object(mysql_query($sql));
			// 구매단가 가져오기
			$sql = "select pur_unit_price from erp_item where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' ";
			$item = mysql_fetch_object(mysql_query($sql));

			// 구매 수량
			$pur_cnt = $this->replaceComma($stock->remain_cnt) - $this->replaceComma($t->cnt);

			//echo "아이템 : ".$t->item_cd."<br>";
			//echo "소요량 : ".$t->cnt."<br>";
			//echo "재고량 : ".$stock->remain_cnt."<br>";
			//echo "구매량 : ".$pur_cnt."<br>";
			//echo "=======================<br>";
			//exit;
			if($pur_cnt < 0) {
				$pur_cnt = $this->replaceComma($pur_cnt) * -1;
				
				// 총구매금액
				$pur_total_price = $pur_cnt * $item->pur_unit_price;
				// 세금
				$pur_tax = $pur_total_price/10;

				$data = array(
					"table" => "erp_purchase_demand_item",
					"fid" => $sfid,
					"item_cd" => $t->item_cd,
					"item_nm" => $t->item_nm,
					"standard1" => $t->standard1,
					"standard2" => $t->standard2,
					"standard3" => $t->standard3,
					"material" => $t->material,
					"unit" => $t->unit,
					"cnt" => $this->replaceComma($pur_cnt),
					"pur_unit_price" => $this->replaceComma($item->pur_unit_price),
					"tax" => $this->replaceComma($pur_tax),
					"total_price" => $this->replaceComma($pur_total_price)
				);
				$sales->insert($data);
				
				if($_SESSION['auto_purchase'] == "y") { // 환경설정에서 자동으로 발주서 발행을 선택했다면
					$sql = "select * from erp_item where item_cd='".$t->item_cd."' and standard1='".$t->standard1."' ";
					$item = @mysql_fetch_object(mysql_query($sql));

					$sql = "select warehouse_nm from erp_warehouse where warehouse_cd='".$demand->warehouse_cd."'";
					$warehouse = @mysql_fetch_object(mysql_query($sql));

					$data = array (
						"table" => "erp_purchase",
						"purchase_cd" => $demand->purchase_cd,
						"order_cd" => $demand->order_cd,
						"project_cd" => $demand->project_cd,
						"project_nm" => $demand->project_nm,
						"account_cd" => $item->account_cd,
						"account_nm" => $item->account_nm,
						"warehouse_cd" => $demand->warehouse_cd,
						"warehouse_nm" => $warehouse->warehouse_nm,
						"item_cd" => $t->item_cd,
						"item_nm" => $t->item_nm,
						"standard1" => $t->standard1,
						"standard2" => $t->standard2,
						"standard3" => $t->standard3,
						"material" => $t->material,
						"unit" => $t->unit,
						"cnt" => $this->replaceComma($pur_cnt),
						"pur_unit_price" => $this->replaceComma($item->pur_unit_price),
						"total_price" => $this->replaceComma($pur_total_price),
						"remain_cnt" => $this->replaceComma($pur_cnt),
						"state" => "stay",
						"pavable" => "y",
						"pavable_price" => $this->replaceComma($pur_total_price),
						"emp_id" => $_SESSION['login_id'],
						"create_dt" => $now
					);
					$sales->insert($data);
				}
			}
		}
		*/	
		$sql = "drop table tem_bom";
		mysql_query($sql);

		// 사용된 견적서는 사용처리 한다
		$data = array (
			"table" => "erp_estimate",
			"where" => "uid=".$_POST['estimate_uid'],
			"used" => "y"
		);
		
		$sales->update($data);

		// 미수금액 처리
		$sql = "select sum(total_price) as total_price from erp_order_item where oid='".$_POST['uid']."'";
		$rece = fetch_object($sql);

		$data = array (
			"table" => "erp_order",
			"where" => "uid=".$order_uid,
			"receivable_price" => $rece->total_price
		);
		$sales->update($data);
		//exit;
		//$this->movePage("sales","listPageOrder");
		$this->movePageClose($_POST['dialogID']);
	}
	
	// 수주서 수정 페이지
	public function modifyPageOrder(){
		$t = Sales::getOrder($_GET['uid']);
		require_once ("views/sales/modifyOrder.php");
	}
	
	// 수주서 수정 실행
	public function updatePageOrder(){
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
		$data = array(
			"table" => "erp_order",
			"where" => "uid=".$_POST['uid'],
			//"order_cd" => $_POST['order_cd'],
			"estimate_cd" => $_POST['estimate_cd'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"manager" => $_POST['manager'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"tax_type" => $_POST['tax_type'],
			"currency" => $_POST['currency'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"refer" => $_POST['refer'],
			"payment_condition" => $_POST['payment_condition'],
			"delivery_dt" => $_POST['delivery_dt'],
			"attach" => $fileAttach,
			"cntTotal" => $this->replaceComma($_POST['cntTotal']),
			"unitPriceTotal" => $this->replaceComma($_POST['unitPriceTotal']),
			"supplyPriceTotal" => $this->replaceComma($_POST['supplyPriceTotal']),
			"taxTotal" => $this->replaceComma($_POST['taxTotal']),
			"priceTotal" => $this->replaceComma($_POST['priceTotal']),
			"state" => "1",
			"remark" => $_POST['remark'],
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);

		$sales = new Sales;
		$sales->update($data);
		//$fid = mysql_insert_id();
		//exit;
		// 업데이트용
		
		$sql = "delete from erp_order_item where oid='".$_POST['uid']."'";
		mysql_query($sql);
		
		/*
		$sql = "select uid from erp_purchase_demand where order_cd='".$_POST['order_cd']."'";
		$demand = mysql_fetch_object(mysql_query($sql));
		$sql = "delete from erp_purchase_demand where order_cd='".$_POST['order_cd']."'";
		mysql_query($sql);
		$sql = "delete from erp_purchase_demand_item where fid=".$demand->uid;
		mysql_query($sql);
		*/
		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard1 = $_POST['standard1'];
		$standard2 = $_POST['standard2'];
		$standard3 = $_POST['standard3'];
		$material = $_POST['material'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$unit_price = $_POST['unit_price'];
		$adjustments = $_POST['adjustments'];
		$supply_price = $_POST['supply_price'];
		$tax = $_POST['tax'];
		$total_price = $_POST['total_price'];

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

		foreach($item_cd as $key => $val) {

			if($val != "") {
				$sql = "select uid from erp_item where item_cd='".$val."' and standard1='".$standard1[$key]."' ";
				//echo "1번 : ".$sql."<br>";
				$t1 = mysql_fetch_object(mysql_query($sql));

				$sql = "select * from erp_bom where fid=".$t1->uid." order by uid desc";
				//echo "2번 : ".$sql."<br>";
				$result1 = @mysql_query($sql);

				$i = 0;
				
				if(@mysql_num_rows($result1) > 0) {
					while($t2 = @mysql_fetch_object($result1)) {
						$sql = "select uid from erp_item where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."' ";
						//echo "3번 : ".$sql."<br>";
						$t3 = @mysql_fetch_object(mysql_query($sql));
						
						$sql = "select * from erp_bom where fid=".$t3->uid." order by uid desc";
						//echo "4번 : ".$sql."<br>";
						$result2 = @mysql_query($sql);

						if(@mysql_num_rows($result2)) {
							while($t4 = @mysql_fetch_object($result2)) {
								$sql = "select uid from erp_item where item_cd='".$t4->item_cd."' and standard1='".$t4->standard1."' ";
								//echo "5번 : ".$sql."<br>";
								$t5 = @mysql_fetch_object(mysql_query($sql));
						
								$sql = "select * from erp_bom where fid=".$t5->uid." order by uid desc";
								//echo "6번 : ".$sql."<br>";
								$result3 = @mysql_query($sql);	
								
								if(@mysql_num_rows($result3)) {
									while($t6 = @mysql_fetch_object($result3)) {
										$sql = "select uid from erp_item where item_cd='".$t6->item_cd."' and standard1='".$t6->standard1."' ";
										echo "7번 : ".$sql."<br>";
										$t7 = @mysql_fetch_object(mysql_query($sql));
								
										$sql = "select * from erp_bom where fid=".$t7->uid." order by uid desc";
										echo "8번 : ".$sql."<br>";
										$result4 = @mysql_query($sql);	

										if(@mysql_num_rows($result4)) {
											// 하위 BOM 이 더 있을 경우 반복처리 하면 됨
										} else {
											// 소요량
											$ocnt = $t6->cnt * $t4->cnt * $cnt[$key];
											// 현재고량
											$sql = "select remain_cnt from erp_stock where item_cd='".$t6->item_cd."' and standard1='".$t6->standard1."' ";
											echo "9번 : ".$sql."<br>";
											$ccnt = @mysql_fetch_object(mysql_query($sql));
											// 구매할 수량
											$bcnt = $ccnt->remain_cnt - $ocnt;
						
											if($bcnt < 0) {
												$bcnt = $bcnt * -1;

												// 구매단가
												$sql = "select pur_unit_price from erp_item where item_cd='".$t6->item_cd."' and standard1='".$t6->standard1."' ";
												echo "10번 : ".$sql."<br>";
												$cost = mysql_fetch_object(mysql_query($sql));
												// 합계구매금액
												$sub_total_price = $bcnt * $cost->pur_unit_price;
												// 세금
												$sub_tax = $sub_total_price / 10;
												$pur_total_price = $sub_total_price + $sub_tax;

												$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt, pur_unit_price, tax, total_price) values ('$t6->item_cd','$t6->item_nm','$t6->standard1','$t6->material','$t6->unit',$bcnt, $cost->pur_unit_price, $sub_tax, $pur_total_price)";
												echo "11번 : ".$sql."<br>";
												//echo "1번 : ".$sql;
												mysql_query($sql) or die (mysql_error());
											}
										}
									}
								} else {
									$ocnt = $t4->cnt * $t2->cnt * $cnt[$key];
									//echo "#1 ==== item : ".$t4->item_cd." - 필요수량 : ".$ocnt."<br>";
									// 현재고량
									$sql = "select remain_cnt from erp_stock where item_cd='".$t4->item_cd."' and standard1='".$t4->standard1."' ";
									//echo "12번 : ".$sql."<br>";
									$ccnt = @mysql_fetch_object(mysql_query($sql));
									//echo $ccnt->remain_cnt."<br>";
									// 구매할 수량
									$bcnt = $ccnt->remain_cnt - $ocnt;
									//echo $bcnt."<br>";
									//if($bcnt < 0) {
										$bcnt = $bcnt * -1;

										// 구매단가
										$sql = "select pur_unit_price from erp_item where item_cd='".$t4->item_cd."' and standard1='".$t4->standard1."' ";
										//echo "13번 : ".$sql."<br>";
										$cost = mysql_fetch_object(mysql_query($sql));
										// 합계구매금액
										$sub_total_price = $bcnt * $cost->pur_unit_price;
										// 세금
										$sub_tax = $sub_total_price / 10;
										$pur_total_price = $sub_total_price + $sub_tax;

										$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt) values ('$t4->item_cd','$t4->item_nm','$t4->standard1','$t4->material','$t4->unit',$ocnt)";
										//echo "14번 : ".$sql."<br>";
										//echo "2번 : ".$sql;
										mysql_query($sql) or die (mysql_error());
									//}
								}
							}
						} else {
							$ocnt = $t2->cnt * $cnt[$key];
							//echo "#2 ==== item : ".$t2->item_cd." - 필요수량 : ".$ocnt."<br>";
							// 현재고량
							$sql = "select remain_cnt from erp_stock where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."' ";
							//echo "15번 : ".$sql."<br>";
							$ccnt = @mysql_fetch_object(mysql_query($sql));
							// 구매할 수량
							$bcnt = $ccnt->remain_cnt - $ocnt;
							
							//if($bcnt < 0) {
								$bcnt = $bcnt * -1;

								// 구매단가
								$sql = "select pur_unit_price from erp_item where item_cd='".$t2->item_cd."' and standard1='".$t2->standard1."' ";
								//echo "16번 : ".$sql."<br>";
								$cost = mysql_fetch_object(mysql_query($sql));
								// 합계구매금액
								$sub_total_price = $bcnt * $cost->pur_unit_price;
								// 세금
								$sub_tax = $sub_total_price / 10;
								$pur_total_price = $sub_total_price + $sub_tax;

								$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt) values ('$t2->item_cd','$t2->item_nm','$t2->standard1','$t2->material','$t2->unit',$ocnt)";
								//echo "17번 : ".$sql."<br>";
								//echo "3번 : ".$sql;
								mysql_query($sql) or die (mysql_error());
							//}
						}
					}
				} else {
					// 소요량
					$sql = "select * from erp_bom where fid=".$t1->uid;
					//echo "18번 : ".$sql."<br>";
					//echo $sql;
					$res = @mysql_fetch_object(mysql_query($sql));

					$ocnt = $res->cnt * $cnt[$key];
					//echo "#3 ==== item : ".$res->item_cd." - 필요수량 : ".$ocnt."<br>";
					// 현재고량
					$sql = "select remain_cnt from erp_stock where item_cd='".$res->item_cd."' and standard1='".$res->standard1."' ";
					//echo "19번 : ".$sql."<br>";
					$ccnt = @mysql_fetch_object(mysql_query($sql));
					// 구매할 수량
					$bcnt = $ccnt->remain_cnt - $ocnt;

					if($bcnt < 0) $bcnt = $bcnt * -1;

					// 구매단가
					$sql = "select pur_unit_price from erp_item where item_cd='".$res->item_cd."' and standard1='".$res->standard1."' ";
					//echo "20번 : ".$sql."<br>";
					$cost = mysql_fetch_object(mysql_query($sql));
					// 합계구매금액
					$sub_total_price = $bcnt * $cost->pur_unit_price;
					// 세금
					$sub_tax = $sub_total_price / 10;
					$pur_total_price = $sub_total_price + $sub_tax;

					$sql = "insert into tem_bom (item_cd, item_nm, standard1, material, unit, cnt) values ('$res->item_cd','$res->item_nm','$res->standard1','$res->material','$res->unit',$cnt[$key])";
					//echo "21번 : ".$sql."<br>";
					//echo "4번 : ".$sql;
					mysql_query($sql) or die (mysql_error());
				}
			}
//==================================================
			if($val != "") {
				$data = array(
					"table" => "erp_order_item",
					//"where" => "oid=".$_POST['uid'],
					"oid" => $_POST['uid'],	
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard1" => $standard1[$key],
					"material" => $material[$key],
					"unit" => $unit[$key],
					"cnt" => $this->replaceComma($cnt[$key]),
					"out_cnt" => 0,
					"remain_cnt" => $this->replaceComma($cnt[$key]),
					"unit_price" => $this->replaceComma($unit_price[$key]),
					"adjustments" => $this->replaceComma($adjustments[$key]),
					"supply_price" => $this->replaceComma($supply_price[$key]),
					"tax" => $this->replaceComma($tax[$key]),
					"total_price" => $this->replaceComma($total_price[$key]),
					"state" => "1"
				);
				//$sales->update($data);
				$sales->insert($data);
			}
		}
		//자동 발주서 처리를 위한 루틴 자동 발주 없애기 20180312
		/*
		$sql = "select item_cd, item_nm, standard1,material,unit, sum(cnt) as cnt from tem_bom group by item_cd, standard1, material, unit";
		//echo "22번 : ".$sql."<br>";
		$result = mysql_query($sql);
		
		if(mysql_num_rows($result) > 0) {
			$data = array(
				"table" => "erp_purchase_demand",
				"purchase_cd" => "PU-".time(),
				"purchase_dt" => date("Y-m-d"),
				"order_cd" => $_POST['order_cd'],
				"project_cd" => $_POST['project_cd'],
				"project_nm" => $_POST['project_nm'],
				"warehouse_cd" => $_POST['warehouse_cd'],
				"memo" => "",
				"attach" => "",
				"used" => "n",
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => date("Y-m-d")
			);
			$sales->insert($data);
			$sfid = mysql_insert_id();
		}

		while($t = mysql_fetch_object($result)) {
			// 해당 품목의 총 재고수량 가져오기
			$sql = "select remain_cnt from erp_stock where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'";
			$stock = mysql_fetch_object(mysql_query($sql));
			// 구매단가 가져오기
			$sql = "select pur_unit_price from erp_item where item_cd='".$t->item_cd."' and standard1='".$t->standard1."'";
			$item = mysql_fetch_object(mysql_query($sql));

			// 구매 수량
			$pur_cnt = $this->replaceComma($stock->remain_cnt) - $this->replaceComma($t->cnt);

			//echo "아이템 : ".$t->item_cd."<br>";
			//echo "소요량 : ".$t->cnt."<br>";
			//echo "재고량 : ".$stock->remain_cnt."<br>";
			//echo "구매량 : ".$pur_cnt."<br>";
			//echo "=======================<br>";
			if($pur_cnt < 0) {
				$pur_cnt = $this->replaceComma($pur_cnt) * -1;
				
				// 총구매금액
				$pur_total_price = $pur_cnt * $item->pur_unit_price;
				// 세금
				$pur_tax = $pur_total_price/10;

				$data = array(
					"table" => "erp_purchase_demand_item",
					"fid" => $sfid,
					"item_cd" => $t->item_cd,
					"item_nm" => $t->item_nm,
					"standard1" => $t->standard1,
					"standard2" => $t->standard2,
					"standard3" => $t->standard3,
					"unit" => $t->unit,
					"cnt" => $this->replaceComma($pur_cnt),
					"pur_unit_price" => $this->replaceComma($item->pur_unit_price),
					"tax" => $this->replaceComma($pur_tax),
					"total_price" => $this->replaceComma($pur_total_price)
				);
				$sales->insert($data);
			}
		}
		*/
		$sql = "drop table tem_bom";
		mysql_query($sql);


		// 사용된 견적서는 사용처리 한다
		$data = array (
			"table" => "erp_estimate",
			"where" => "uid=".$_POST['estimate_uid'],
			"used" => "y"
		);
		
		$sales->update($data);
		//exit;
		//$this->movePage("sales","listPageOrder");
		$this->movePageClose($_POST['dialogID']);
	}

	// 거래처 등록
	public function inputPageAccount() {
		require_once ("views/sales/createAccount.php");
	}

	public function listPageAccount() {
		require_once ("views/sales/listAccount.php");
	}

	public function registAccount(){
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_account",
			"account_gb" => $_POST['account_gb'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"owner" => $_POST['owner'],
			"owner_mobile" => $_POST['owner_mobile'],
			"corp_reg_no" => $_POST['corp_reg_no'],
			"corp_condition" => $_POST['corp_condition'],
			"corp_event" => $_POST['corp_event'],
			"corp_phone" => $_POST['corp_phone'],
			"corp_fax" => $_POST['corp_fax'],
			"corp_email" => $_POST['corp_email'],
			"corp_zipcode" => $_POST['corp_zipcode'],
			"corp_address" => $_POST['corp_address'],
			"manager" => $_POST['manager'],
			"account_id" => $_POST['account_id'],
			"account_pwd" => $_POST['account_pwd'],
			"create_dt" => $now
		);

		$sales = new Sales;
		$result = $sales->registAccount($data);
		if($result) $this->movePage("sales","listPageAccount");
	}

	public function updateAccount() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_account",
			"where" => "uid=".$_POST['uid'],
			"account_gb" => $_POST['account_gb'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"owner" => $_POST['owner'],
			"owner_mobile" => $_POST['owner_mobile'],
			"corp_reg_no" => $_POST['corp_reg_no'],
			"corp_condition" => $_POST['corp_condition'],
			"corp_event" => $_POST['corp_event'],
			"corp_phone" => $_POST['corp_phone'],
			"corp_fax" => $_POST['corp_fax'],
			"corp_email" => $_POST['corp_email'],
			"corp_zipcode" => $_POST['corp_zipcode'],
			"corp_address" => $_POST['corp_address'],
			"manager" => $_POST['manager'],
			"account_id" => $_POST['account_id'],
			"account_pwd" => $_POST['account_pwd'],
			"create_dt" => $now
		);
		$sales = new Sales;
		$result = $sales->updateAccount($data);
		if($result) $this->movePage("sales","listPageAccount");
	}

	public function modifyPageAccount() {
		$t = Sales::getAccount($_GET['uid']);
		require_once ("views/sales/modifyAccount.php");
	}
	

	
	// 소요량 계산
	// item 의 uid 가져오기
	public function getItemUid($item_cd,$standard1,$standard2,$standard3) {
		$query = "select uid from erp_item where item_cd='".$item_cd."' and standard1='".$standard1."' ";
		$result = mysql_query($query);
		if($result) {
			$t = mysql_fetch_object($result);
			return $t->uid;
		}
	}

	public function checkBom($fid) {
		$query = "select * from erp_bom where fid=".$fid;
		$result = mysql_query($query);
		if(@mysql_num_rows($result) > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getBomCnt($uid){
		$query = "select cnt from erp_bom where uid=".$uid;
		$result = mysql_query($query);
		if($result) {
			$t = @mysql_fetch_object($result);
			return $t->cnt;
		} else {
			return 0;
		}
	}

	public function getStock($item_cd, $standard1, $standard2, $standard3) {
		$query = "select remain_cnt from erp_stock where item_cd='" . $item_cd ."' and standard1='" . $standard1 ."' ";
		$result = mysql_query($query);
		while($t = mysql_fetch_object($result)) {
			$remain_cnt = $remain_cnt + $t->remain_cnt;
		}
		return $remain_cnt;
	}

	

	public function listPageAs() {
		require_once("views/sales/listAs.php");
	}

	public function inputPageAs() {
		require_once("views/sales/createAs.php");
	}

	public function modifyPageAs() {
		$t = Sales::getAs($_GET['uid']);
		require_once("views/sales/modifyAs.php");
	}

	public function registAs() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
		$sql = "select max(accept_cha) as cnt from erp_as where accept_dt='".$_POST['accept_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));

		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$accept_cha = "1";
		}else{
			$accept_cha = $t0->cnt+1;
		}

		$accept_cd  = $_POST['accept_dt']."-".$accept_cha;
		$data = array(
			"table" => "erp_as",
			"accept_cd" => $accept_cd,
			"accept_dt" => $_POST['accept_dt'],
			"accept_cha" => $accept_cha,
			"state" => $_POST['state'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"account_manager" => $_POST['account_manager'],
			"email" => $_POST['email'],
			"phone" => $_POST['phone'],
			"item_cd" => $_POST['item_cd'],
			"item_nm" => $_POST['item_nm'],
			"faulty" => $_POST['faulty'],
			"memo" => $_POST['memo'],
			"as_result" => $_POST['as_result'],
			"processing" => $_POST['processing'],
			"processing_cost" => $_POST['processing_cost'],
			"attach" => $fileAttach,
			"emp_id" => $_POST['emp_id'],
			"emp_nm" => $_POST['emp_nm'],
			"create_dt" => $now
		);

		$sales = new Sales;
		$sales->registAs($data);

		$this->movePage("sales","listPageAs");
	}

	public function updateAs(){
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
		$sql = "select max(accept_cha) as cnt from erp_as where accept_dt='".$_POST['accept_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));

		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$accept_cha = "1";
		}else{
			$accept_cha = $t0->cnt+1;
		}

		$accept_cd  = $_POST['accept_dt']."-".$accept_cha;

		$data = array(
			"table" => "erp_as",
			"where" => "uid=".$_POST['uid'],
			"accept_cd" => $accept_cd,
			"accept_dt" => $_POST['accept_dt'],
			"accept_cha" => $accept_cha,
			"state" => $_POST['state'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"account_manager" => $_POST['account_manager'],
			"email" => $_POST['email'],
			"phone" => $_POST['phone'],
			"item_cd" => $_POST['item_cd'],
			"item_nm" => $_POST['item_nm'],
			"faulty" => $_POST['faulty'],
			"memo" => $_POST['memo'],
			"as_result" => $_POST['as_result'],
			"processing" => $_POST['processing'],
			"processing_cost" => $_POST['processing_cost'],
			"attach" => $fileAttach,
			"emp_id" => $_POST['emp_id'],
			"emp_nm" => $_POST['emp_nm'],
			"edit_dt" => $now
		);

		$sales = new Sales;
		$sales->updateAs($data);

		$this->movePage("sales","listPageAs");
	}

	// 거래명세서
	public function listPageOrderReport() {
		require_once("views/sales/listOrderReport.php");
	}

	// 출하
	public function listPageOrderShipment() {
		require_once("views/sales/listOrderShipment.php");
	}
	
	/*
	// 출하지시
	public function inputPageOrderShipment(){
		$t = Sales::getOrderShipment($_GET['uid']);
		require_once("views/sales/createOrderShipment.php");
	}
	*/
	
	public function registPageOrderShipment() {
		require_once ("views/sales/createOrderShipment.php");
	}

	public function modifyPageOrderShipment(){
		$t = Sales::getOrderShipment($_GET['uid']);
		require_once("views/sales/modifyOrderShipment.php");
	}

	public function registPageOrderShipmentPop() {
		require_once ("views/sales/createOrderShipment_pop.php");
	}

	public function modifyPageOrderShipmentPop(){
		$t = Sales::getOrderShipment($_GET['uid']);
		require_once("views/sales/modifyOrderShipment_pop.php");
	}

	public function viewPageOrderShipment(){
		$t = Sales::getOrderShipment($_GET['uid']);
		require_once("views/sales/viewOrderShipment.php");
	}

	// 출하지시서 입력페이지
	public function inputPageShipment() {
		require_once ("views/sales/createShipment.php");
	}



	// 미수금관리
	public function listPageAccountReceivable() {
		require_once("views/sales/listAccountReceivable.php");
	}

	// 매출계획
	public function listPageSalesPlan(){
		require_once("views/sales/listSalesPlan.php");
	}

	
	// 출하 지시서 등록 실행
	public function inputPageOrderShipment() {
		$now = date("Y-m-d H:i:s");

		$fileAttach = $this->upload('attach');
		$sql = "select max(shipment_cha) as cnt from erp_order_shipment where shipment_dt='".$_POST['shipment_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));

		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$shipment_cha = "1";
		}else{
			$shipment_cha = $t0->cnt+1;
		}

		$shipment_cd  = $_POST['shipment_dt']."-".$shipment_cha;
		
		$data = array(
			"table" => "erp_order_shipment",
			"shipment_dt" => $_POST['shipment_dt'],
			"shipment_cha" => $shipment_cha,
			"shipment_cd" => $shipment_cd,
			"order_cd" => $_POST['order_cd'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"manager" => $_POST['manager'],
			//"warehouse_cd" => $_POST['warehouse_cd'],
			//"warehouse_nm" => $_POST['warehouse_nm'],
			"tax_type" => $_POST['tax_type'],
			"currency" => $_POST['currency'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"refer" => $_POST['refer'],
			"payment_condition" => $_POST['payment_condition'],
			"delivery_dt" => $_POST['delivery_dt'],
			"consignment_dt" => $_POST['consignment_dt'],
			"attach" => $fileAttach,
			"zipcode" => $_POST['zipcode'],
			"address" => $_POST['address'],
			"mobile" => $_POST['mobile'],
			"cntTotal" => $this->replaceComma($_POST['cntTotal']),
			"unitPriceTotal" => $this->replaceComma($_POST['unitPriceTotal']),
			"supplyPriceTotal" => $this->replaceComma($_POST['supplyPriceTotal']),
			"taxTotal" => $this->replaceComma($_POST['taxTotal']),
			"priceTotal" => $this->replaceComma($_POST['priceTotal']),
			"state" => "complete",
			"receivable" => "y",
			"receivable_price" => 0,
			"note" => $_POST['note'],
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);

		$sales = new Sales;
		$sid = $sales->registOrderShipment($data);
		//$fid = mysql_insert_id();
		//$order_uid = $fid;
		$shipment_uid = $sid;
		
		//$sql = "delete from erp_order_shipment_item where sid='".$shipment_uid."'";
		//mysql_query($sql);

		$item_cd		= $_POST['item_cd'];
		$item_nm		= $_POST['item_nm'];
		$standard1		= $_POST['standard1'];
		$material		= $_POST['material'];
		$unit			= $_POST['unit'];
		$cnt			= $_POST['cnt'];
		$unit_price		= $_POST['unit_price'];
		$supply_price	= $_POST['supply_price'];
		$tax			= $_POST['tax'];
		$total_price	= $_POST['total_price'];
		$box_cnt	= $_POST['box_cnt'];
		//$remark			= $_POST['remark'];
		$lot_no_cd		= $_POST['lot_no_cd'];
		$lot_no_nm		= $_POST['lot_no_nm'];

		$work_cd		= $_POST['work_cd'];

		$warehouse_cd = $_POST['warehouse_cd'];
		$warehouse_nm = $_POST['warehouse_nm'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"			=> "erp_order_shipment_item",
					"sid"				=> $shipment_uid,
					"item_cd"		=> $val,
					"item_nm"		=> $item_nm[$key],
					"standard1"	=> $standard1[$key],
					"material"		=> $material[$key],
					"unit"				=> $unit[$key],
					"cnt"				=> $this->replaceComma($cnt[$key]),
					"unit_price"		=> $this->replaceComma($unit_price[$key]),
					"supply_price"		=> $this->replaceComma($supply_price[$key]),
					"tax"				=> $this->replaceComma($tax[$key]),
					"total_price"	=> $this->replaceComma($total_price[$key]),
					"box_cnt"		=> $this->replaceComma($box_cnt[$key]),
					"state"			=> "complete",
					//"remark"		=> $remark[$key]
					"lot_no_cd"		=>$lot_no_cd[$key],
					"lot_no_nm"		=>$lot_no_nm[$key],
					"work_cd"		=>$work_cd[$key],
					"warehouse_cd"		=>$warehouse_cd[$key],
					"warehouse_nm"		=>$warehouse_nm[$key]
				);
				$sales->insert($data);

				//여기서부터  출하 처리...
				$sql = "select remain_cnt from erp_stock where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."' "; //창고별 재고현황 쿼리중 창고재고가 있는경우
				$result = mysql_query($sql);
					$r_cnt = @mysql_fetch_object($result );
					if(@mysql_num_rows($result) > 0) { // 등록된 창고 재고창고가 있다면
				
						$remain_cnt = $r_cnt->remain_cnt - $this->replaceComma($cnt[$key]);
						
						// 전체재고에 넣기
						$stockData = array (
						"table" => "erp_stock",
						"where"	=> "item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."'",
						"pur_cnt"			=> $this->replaceComma($cnt[$key]),
						"pur_unit_price"		=> $this->replaceComma($supply_price[$key]),
						"remain_cnt"			=> $remain_cnt,
						//"warehouse_cd" => $warehouse_cd[$key],
						//"lot_no_cd"			=> $lot_no_cd[$key],
						"out_date"			=> $now
						);
						$sales->update($stockData);
					}else{                        // 등록된 창고 재고창고가 없다면
											
						$remain_cnt = $r_cnt->remain_cnt - $this->replaceComma($cnt[$key]);
						
						// 전체재고에 넣기
						$stockData = array (
						"table"				=> "erp_stock",
						"pur_cnt"			=> $this->replaceComma($cnt[$key]),
						"pur_unit_price"		=> $this->replaceComma($supply_price[$key]),
						"remain_cnt"			=> $remain_cnt,
						"warehouse_cd"			=> $warehouse_cd[$key],
						"warehouse_nm"			=> $warehouse_nm[$key],
						//"lot_no_cd"			=> $lot_no_cd[$key],
						"out_date"			=> $now
						);
						$sales->insert($stockData);
					}

				// 전체 inout에 넣기
				$inoutData = array (
				"table"					=> "erp_stock_inout",
				"item_cd"				=> $val,
				"work_cd"				=>$work_cd[$key],
				"warehouse_cd"			=> $warehouse_cd[$key],
				"warehousing_cd"		=> $warehousing_cd,
				"standard1"				=> $standard1[$key],
				"material"					=> $material[$key],
				"unit"							=> $unit[$key],
				"out_cnt"					=> $this->replaceComma($cnt[$key]),
				"out_dt"					=> $now,
				"pur_unit_price"		=> $this->replaceComma($supply_price[$key]),
				"total_price"			=> $this->replaceComma($total_price[$key]),
				"remain_cnt"			=> "0",	//출하 리스트는 잔여수량을 표기하지 않음.
				"lot_no"				=> $lot_no_cd[$key],
				"account"			=> "출하",
				"remark"			=> "출하",
				"used"				=>'y',
				"create_dt"			=> $now
				);
				$sales->insert($inoutData);

				/////// 재고 used y 처리
				$sql22 = "select uid, remain_cnt ,in_cnt , out_cnt from erp_stock_inout where item_cd='".$val."' and standard1='".$standard1[$key]."' and warehouse_cd='".$warehouse_cd[$key]."' and lot_no='".$lot_no_cd[$key]."'  and used='n' order by create_dt asc";

				$result33 = mysql_query($sql22);

					$out_cnt22 = $this->replaceComma($cnt[$key]); //출하 되야 할 수량

				while($r_cnt2 = mysql_fetch_object($result33)){
					$in_Remain_cnt = $r_cnt2->remain_cnt - $out_cnt22;											
					//echo $remain_cnt;
					if( $in_Remain_cnt <= 0 ){
						// 해당 입고된것 모두 사용했을때.
						$inoutData = array(
						"table"	=> "erp_stock_inout",
						"where" => "uid=".$r_cnt2->uid,
						"remain_cnt" =>"0",
						"used"	=>"y"
						);
						$sales->update($inoutData);

						$out_cnt22 = $out_cnt22 - $r_cnt2->remain_cnt;//출하되야할 잔여수량

					}else{
						$inoutData = array(
						"table"	=> "erp_stock_inout",
						"where" => "uid=".$r_cnt2->uid,
						"remain_cnt" =>$in_Remain_cnt,
						"used"	=>"n"
						);
						$sales->update($inoutData);
					}
				}
							
			}
		}
		//exit;

		//$this->movePage("sales","listPageOrder");		
		$this->movePageClose($_POST['dialogID']);
	}
	
	// 출하지시서 수정 실행
	public function updatePageOrderShipment() {
		$now = date("Y-m-d H:i:s");
		$fileAttach = $this->upload('attach');
		$sql = "select max(shipment_cha) as cnt from erp_order_shipment where shipment_dt='".$_POST['shipment_dt']."'";
		//echo $sql."<BR>"; 
		$t0 = mysql_fetch_object(mysql_query($sql));

		if (is_null($t0->cnt) || empty($t0->cnt) || $t0->cnt==""){
			$shipment_cha = "1";
		}else{
			$shipment_cha = $t0->cnt+1;
		}

		$shipment_cd  = $_POST['shipment_dt']."-".$shipment_cha;
		
		$data = array(
			"table" => "erp_order_shipment",
			"where" => "uid=".$_POST['uid'],
			"shipment_dt" => $_POST['shipment_dt'],
			"shipment_cha" => $shipment_cha,
			"shipment_cd" => $shipment_cd,
			"order_cd" => $_POST['order_cd'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"manager" => $_POST['manager'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"warehouse_nm" => $_POST['warehouse_nm'],
			"tax_type" => $_POST['tax_type'],
			"currency" => $_POST['currency'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"refer" => $_POST['refer'],
			"payment_condition" => $_POST['payment_condition'],
			"delivery_dt" => $_POST['delivery_dt'],
			"consignment_dt" => $_POST['consignment_dt'],
			"attach" => $fileAttach,
			"zipcode" => $_POST['zipcode'],
			"address" => $_POST['address'],
			"mobile" => $_POST['mobile'],
			"cntTotal" => $this->replaceComma($_POST['cntTotal']),
			"unitPriceTotal" => $this->replaceComma($_POST['unitPriceTotal']),
			"supplyPriceTotal" => $this->replaceComma($_POST['supplyPriceTotal']),
			"taxTotal" => $this->replaceComma($_POST['taxTotal']),
			"priceTotal" => $this->replaceComma($_POST['priceTotal']),
			"state" => "ing",
			"receivable" => "y",
			"receivable_price" => 0,
			"note" => $_POST['note'],
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);

		$sales = new Sales;
		$sales->update($data);
		
		//$fid			= mysql_insert_id();
		//$order_uid	= $fid;
		//$shipment_uid = $sid;
		
		$sql = "delete from erp_order_shipment_item where sid='".$_POST['uid']."'";
		mysql_query($sql);

		$item_cd		= $_POST['item_cd'];
		$item_nm		= $_POST['item_nm'];
		$standard1		= $_POST['standard1'];
		$standard2		= $_POST['standard2'];
		$standard3		= $_POST['standard3'];
		$material		= $_POST['material'];
		$unit			= $_POST['unit'];
		$cnt			= $_POST['cnt'];
		$unit_price		= $_POST['unit_price'];
		$supply_price	= $_POST['supply_price'];
		$tax			= $_POST['tax'];
		$total_price	= $_POST['total_price'];
		$box_cnt	= $_POST['box_cnt'];
		$remark			= $_POST['remark'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"			=> "erp_order_shipment_item",
					"sid"			=> $_POST['uid'],
					"item_cd"		=> $val,
					"item_nm"		=> $item_nm[$key],
					"standard1"		=> $standard1[$key],
					"standard2"		=> $standard2[$key],
					"standard3"		=> $standard3[$key],
					"material"		=> $material[$key],
					"unit"			=> $unit[$key],
					"cnt"			=> $this->replaceComma($cnt[$key]),
					"out_cnt"		=> 0,
					"remain_cnt"	=> 0,
					"unit_price"	=> $this->replaceComma($unit_price[$key]),
					"supply_price"	=> $this->replaceComma($supply_price[$key]),
					"tax"			=> $this->replaceComma($tax[$key]),
					"total_price"	=> $this->replaceComma($total_price[$key]),
					"box_cnt"		=> $this->replaceComma($box_cnt[$key]),
					"state"			=> "ing",
					"remark"		=> $remark[$key]
				);
				$sales->insert($data);
			}
		}
		//exit;
		// 사용된 주문서는 사용처리 한다
		$data = array (
			"table" => "erp_order",
			"where" => "uid=".$_POST['order_uid'],
			"used" => "y"
		);
		
		$sales->update($data);

		
		//$this->movePage("sales","listPageOrder");
		$this->movePageClose($_POST['dialogID']);
	}
}
?>