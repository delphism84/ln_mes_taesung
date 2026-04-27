<?
require_once("controllers/design_controller.php");

class Functions extends Design {
	private $now;

	public function __construct() {
		$this->now = date("Y-m-d H:i:s");
		//$db->Mysql_DB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	}

	public function begin() {
		mysql_query("START TRANSACTION");
	}

	public function commit() {
		mysql_query("COMMIT");
	}

	public function rollback() {
		mysql_query("ROLLBACK");
	}
	

	// 엑셀등록시 사용되는 함수
	public function getBigDepartmentCd($name) {
		$sql = "select uid from department_big where department_nm='".$name."'";
		$t = mysql_fetch_object(mysql_query($sql));
		return $t->uid;
	}
	public function getMiddleDepartmentCd($name) {
		$sql = "select uid from department_middle where department_nm='".$name."'";
		$t = mysql_fetch_object(mysql_query($sql));
		return $t->uid;
	}
	
	public function getSmallDepartmentCd($name) {
		$sql = "select uid from department_small where department_nm='".$name."'";
		$t = mysql_fetch_object(mysql_query($sql));
		return $t->uid;
	}


	public function getTable($table, $where, $rpp, $page, $orderby = null, $asc = null) {
		if($orderby == null) $orderby = "uid";
		if($asc == null) $asc = "desc";
		if($rpp == "all") $sql = "select * from ".$table." ".$where." order by ".$orderby." ".$asc;
		else $sql = "select * from ".$table." ".$where." order by ".$orderby." ".$asc." limit ".($page-1)*$rpp.", ".$rpp;
		//echo $sql;
		$this->query($sql);
	}
	
	// 날짜기반 코드생성
	public function createCode($field, $table) {
		$cd = date("Ymd");
		$sql = "select ".$field." from ".$table." where ".$field." like '%$cd%' order by uid desc limit 1";
		//echo $sql;
		$this->sub_query($sql);
		$result = $this->sub_fetch();

		if(isset($result->{$field})) {
			$arr = explode("-",$result->{$field});
			$new = $arr[1]+1;
			$cd .= "-".str_pad($new,"2","0",STR_PAD_LEFT);
		} else {
			$cd .= "-01";
		}
		return $cd;
	}


	// 전화번호에 "-" 붙이기
	public function convertMobileNumber($num) {
		if(stristr($num,"-") === FALSE) {
			$t2Len = strlen($num) - 7;
			$t1 = substr($num,0,3);
			$t2 = substr($num,3,$t2Len);
			$t3 = substr($num,-4);

			$newStr = $t1."-".$t2."-".$t3;
			return $newStr;
		} else {
			return $num;
		}
	}

	// 콤마 제거
	public function replaceComma($val) {
		$val = str_replace(",","",$val);
		return $val;
	}
	
	// 페이지 이동
	public function movePage($controller,$action) {
		echo "<script>";
		echo "location.href = 'index.php?controller=".$controller."&action=".$action."' ";
		echo "</script>";
	}

	// 부가세 계산
	function getTax($amount, $method = "b") {
		switch ($method) {
			case 'a' :                                  // 부가세없음
				$supply = $amount;                         // 공급가
				$tax = 0;                                 // 부가세
			break;
			
			case 'b' :                                  // 부가세별도
				$supply = $amount;                         // 공급가
				$tax = $supply * 0.1;                        // 부가세
			break;
		
			case 'c' :                                  // 부가세포함
				$supply = $amount / 1.1;
				$tax = $amount - $supply;
			break;
		}
		$supply = round($supply);                      // 마지막 합계금액에서 반올림 해 줌
		$tax = round($tax);
		return $tax;
	}
	
	// 업로드
	public function upload($file) {
		// 폴더생성
		@mkdir("attach/", 0777);

		$dir = "attach/"; //저장될 폴더 경로(끝에 '/'슬래시 꼭 붙여주세요...^^)
		chmod("$dir", 0777);

		$varName = $file; //이전 페이지에서 설정된 file 변수명
		$allowExt = "jpg,gif,png,jpeg,JPG,GIF,PNG,doc,DOC,docx,Docx,zip,ZIP"; //업로드 가능한 확장자 (,)콤마로 구분

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

				// 파일명 생성 및 존재하는지 검사
				// $newfile = md5($prefix.$_FILES[$varName][name]).".".$ext;
				$newfile = $prefix.$_FILES[$varName][name];

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

				return $newfile;
			}
		} else {
			return "none";
		}
	}
	


	
	
	
	
	// Null 문자 없애기
	public function convertNull($val) {
		if($val == null) return "";
		else return $val;
	}

	public function getConfig() {
		$sql = "select * from erp_config";
		$this->query($sql);
		$t = $this->fetch();
		return $t;
	}

	// 품목구분명 가져오기
	public function getItemClassificationName($uid) {
		$sql = "select classify_nm from erp_item_classification where uid=".$uid;
		$t = mysql_fetch_object(mysql_query($sql));
		return $t->classify_nm;
	}


	// 거래처구분명 가져오기
	public function getAccountClassifyName($uid) {
		$sql = "select classify_nm from account_classify where uid=".$uid;		
		$t = @mysql_fetch_object(mysql_query($sql));
		return $t->classify_nm;
	}

	// uid로 값 가져오기
	public function getName($table, $field, $uid) {
		if($uid != 0 && !empty($uid)) {
			$sql = "select ".$field." from ".$table." where uid=".$uid;
			$t = @mysql_fetch_object(mysql_query($sql));
			return $t->{$field};
		}
	}
	// 필드명으로 값 가져오기
	public function getCompareName($table, $field, $compare_field, $compare_value) {
		$sql = "select ".$field." from ".$table." where ".$compare_field."='".$compare_value."'";
		$t = @mysql_fetch_object(mysql_query($sql));
		return $t->{$field};
	}
	
	// 직위명으로 직위코드 가져오기
	public function getPositionCd($name) {
		$sql = "select uid from position where position_nm='".$name."'";
		$t = mysql_fetch_object(mysql_query($sql));

		return $t->uid;
	}
	
	// insert id 구하기
	public function getUid() {
		return mysql_insert_id();
	}
	
	// Lotno 생성
	public function getLotNo() {
		return time();
	}


	

	
	// 품목구분명으로 품목구분코드 가져오기
	public function getItemClassificationCd($classify) {
		$sql = "select uid from item_classify where classify_nm='".$classify."'";
		$t = @mysql_fetch_object(mysql_query($sql));
		return $t->uid;
	}
	
	// 거래처구분명으로 거래처구분코드 가져오기
	public function getAccountClassificationCd($classify) {
		$sql = "select uid from account_classify where classify_nm='".$classify."'";
		$t = @mysql_fetch_object(mysql_query($sql));
		return $t->uid;
	}


	// bom 대비 부족자재 확인 (list 화면)
	public function calBom($item_cd, $standard, $cnt) {
		$sql = "drop table tem_bom";
		@mysql_query($sql);

		// 임시테이블 생성
		$sql = "
			create TEMPORARY TABLE tem_bom (
				item_cd varchar(50),
				item_nm varchar(50),
				standard varchar(50),
				cnt int(11)
			) CHARACTER SET utf8 COLLATE utf8_general_ci;
		";
		mysql_query($sql) or die (mysql_error());


		$sql = "select uid from erp_item where item_cd='".$item_cd."' and standard='".$standard."'";
		//echo $sql;
		$t1 = @mysql_fetch_object(mysql_query($sql));


		$sql = "select * from erp_bom where fid=".$t1->uid." order by uid desc";
		//echo $sql;
		$result1 = @mysql_query($sql);

		$i = 0;
		
		if(@mysql_num_rows($result1) > 0) {
			while($t2 = @mysql_fetch_object($result1)) {
				$sql = "select uid from erp_item where item_cd='".$t2->item_cd."' and standard='".$t2->standard."'";
				//echo $sql;
				$t3 = @mysql_fetch_object(mysql_query($sql));
				
				$sql = "select * from erp_bom where fid=".$t3->uid." order by uid desc";
				//echo $sql;
				$result2 = @mysql_query($sql);

				if(@mysql_num_rows($result2)) {
					while($t4 = @mysql_fetch_object($result2)) {
						$sql = "select uid from erp_item where item_cd='".$t4->item_cd."' and standard='".$t4->standard."'";
						$t5 = @mysql_fetch_object(mysql_query($sql));
				
						$sql = "select * from erp_bom where fid=".$t5->uid." order by uid desc";
						$result3 = @mysql_query($sql);	
						
						if(@mysql_num_rows($result3)) {
							while($t6 = @mysql_fetch_object($result3)) {
								$sql = "select uid from erp_item where item_cd='".$t6->item_cd."' and standard='".$t6->standard."'";
								$t7 = @mysql_fetch_object(mysql_query($sql));
						
								$sql = "select * from erp_bom where fid=".$t7->uid." order by uid desc";
								$result4 = @mysql_query($sql);	

								if(@mysql_num_rows($result4)) {
									// 하위 BOM 이 더 있을 경우 반복처리 하면 됨
								} else {
									$ocnt = $t6->cnt * $t4->cnt * $cnt;
									$sql = "insert into tem_bom (item_cd, item_nm, standard, cnt) values ('$t6->item_cd','$t6->item_nm','$t6->standard',$ocnt)";
									//echo $sql;
									mysql_query($sql) or die ("1번");
								}
							}
						} else {
							$ocnt = $t4->cnt * $t2->cnt * $cnt;
							$sql = "insert into tem_bom (item_cd, item_nm, standard, cnt) values ('$t4->item_cd','$t4->item_nm','$t4->standard',$ocnt)";
							//echo $sql;
							mysql_query($sql) or die ("2번");
						}
					}
				} else {
					$ocnt = $t2->cnt * $cnt;
					$sql = "insert into tem_bom (item_cd, item_nm, standard, cnt) values ('$t2->item_cd','$t2->item_nm','$t2->standard',$ocnt)";
					//echo $sql;
					mysql_query($sql) or die ("3번");
				}
			}
		} else {
			$sql = "insert into tem_bom (item_cd, item_nm, standard, cnt) values ('$item_cd','$item_nm','$standard',$cnt)";
			//echo $sql;
			mysql_query($sql) or die ("4번");
		}

		$sql = "select item_cd, item_nm, standard, sum(cnt) as cnt from tem_bom group by item_cd, standard";
		$result = mysql_query($sql);

		//echo mysql_num_rows($result)."<br>";
		$bool = "true";

		while($t = @mysql_fetch_object($result)) {
			// 해당 품목의 현재고수량
			$sql = "select stock_cnt from erp_item where item_cd='".$t->item_cd."' and standard='".$t->standard."'";
			//echo $sql;
			$ccnt = @mysql_fetch_object(mysql_query($sql));
			// 부족재고수량
			//echo $t->cnt."====".$ccnt->stock_cnt."======";
			$bcnt = $ccnt->stock_cnt - $t->cnt;
			if($bcnt < 0) {
				$bool = "false";
				break;
			}
		}

		$sql = "drop table tem_bom";
		mysql_query($sql);
		//echo $bool;
		return $bool;
	}

	public function viewShortageBom($item_cd, $standard, $cnt) {
		$sql = "drop table tem_bom";
		mysql_query($sql);

		// 임시테이블 생성
		$sql = "
			create TEMPORARY TABLE tem_bom (
				item_cd varchar(50),
				item_nm varchar(50),
				standard varchar(50),
				unit varchar(50),
				cnt int(11)
			) CHARACTER SET utf8 COLLATE utf8_general_ci;
		";
		mysql_query($sql) or die (mysql_error());


		$sql = "select uid from erp_item where item_cd='".$item_cd."' and standard='".$standard."'";
		$t1 = @mysql_fetch_object(mysql_query($sql));


		$sql = "select * from erp_bom where fid=".$t1->uid." order by uid desc";
		$result1 = @mysql_query($sql);

		$i = 0;
		
		if(@mysql_num_rows($result1) > 0) {
			while($t2 = @mysql_fetch_object($result1)) {
				$sql = "select uid from erp_item where item_cd='".$t2->item_cd."' and standard='".$t2->standard."'";
				$t3 = @mysql_fetch_object(mysql_query($sql));
				
				$sql = "select * from erp_bom where fid=".$t3->uid." order by uid desc";
				$result2 = @mysql_query($sql);

				if(@mysql_num_rows($result2)) {
					while($t4 = @mysql_fetch_object($result2)) {
						$sql = "select uid from erp_item where item_cd='".$t4->item_cd."' and standard='".$t4->standard."'";
						$t5 = @mysql_fetch_object(mysql_query($sql));
				
						$sql = "select * from erp_bom where fid=".$t5->uid." order by uid desc";
						$result3 = @mysql_query($sql);	
						
						if(@mysql_num_rows($result3)) {
							while($t6 = @mysql_fetch_object($result3)) {
								$sql = "select uid from erp_item where item_cd='".$t6->item_cd."' and standard='".$t6->standard."'";
								$t7 = @mysql_fetch_object(mysql_query($sql));
						
								$sql = "select * from erp_bom where fid=".$t7->uid." order by uid desc";
								$result4 = @mysql_query($sql);	

								if(@mysql_num_rows($result4)) {
									// 하위 BOM 이 더 있을 경우 반복처리 하면 됨
								} else {
									$ocnt = $t6->cnt * $t4->cnt * $cnt;
									$sql = "insert into tem_bom (item_cd, item_nm, standard, unit, cnt) values ('$t6->item_cd', '$t6->item_nm', '$t6->standard', '$t6->unit', $ocnt)";
									mysql_query($sql) or die (mysql_error());
								}
							}
						} else {
							$ocnt = $t4->cnt * $t2->cnt * $cnt;
							$sql = "insert into tem_bom (item_cd, item_nm, standard, unit, cnt) values ('$t4->item_cd', '$t4->item_nm', '$t4->standard', '$t4->unit', $ocnt)";
							mysql_query($sql) or die (mysql_error());
						}
					}
				} else {
					$ocnt = $t2->cnt * $cnt;
					$sql = "insert into tem_bom (item_cd, item_nm, standard, unit, cnt) values ('$t2->item_cd', '$t2->item_nm', '$t2->standard', '$t2->unit', $ocnt)";
					mysql_query($sql) or die (mysql_error());
				}
			}
		} else {
			$sql = "insert into tem_bom (item_cd, item_nm, standard, unit, cnt) values ('$item_cd', '$item_nm', '$standard', '$unit', $cnt)";
			mysql_query($sql) or die (mysql_error());
		}

		$sql = "select * from tem_bom";
		$result = mysql_query($sql);
		return $result;
	}

	// 품목 재고수량 가져오기
	//public function getStockCnt($item_cd, $standard){
	//	$sql = "select cnt from item where item_cd='".$item_cd."' and standard='".$standard."'";
	//	$t = mysql_fetch_object(mysql_query($sql));
	//	return $t->cnt;
	//}

	// 품목 유니크아이디 가져오기
	public function getsUid($item_cd, $standard) {
		$sql = "select uid from erp_item where item_cd='".$item_cd."' and standard='".$standard."'";
		$t = @mysql_fetch_object(mysql_query($sql));
		return $t->uid;
	}

	// 품목 유니크아이디 가져오기
	public function getItemUid($item_cd, $standard = null) {
		$sql = "select uid from item where item_cd='".$item_cd."'";
		$t = @mysql_fetch_object(mysql_query($sql));
		return $t->uid;
	}

	// 품목 구분값 가져오기
	public function getItemClassify($item_cd, $standard) {
		$sql = "select classify from item where item_cd='".$item_cd."' and standard='".$standard."'";
		$t = @mysql_fetch_object(mysql_query($sql));
		return $t->classify;
	}
	
	// 품목 구입단가 가져오기
	public function getPurchasePrice($item_cd, $standard) {
		$uid = $this->getsUid($item_cd, $standard);
		return $this->getItemPurchasePrice($uid);
	}
	
	// 품목 판매단가 가져오기
	public function getSalePrice($item_cd, $standard) {
		$uid = $this->getsUid($item_cd, $standard);
		return $this->getItemPurchasePrice($uid);
	}

	// 단위 가져오기
	public function getUnit($item_cd, $standard) {
		$sql = "select unit from item where item_cd='".$item_cd."' and standard='".$standard."'";
		$t = @mysql_fetch_object(mysql_query($sql));
		return $t->unit;
	}

	// 선입선출
	public function firstInFirstOut($uid, $warehouse, $cnt) {

		// 투입된 수량 만큼 erp_stock 에서 가져온다 (lot_no 때문에)
		$sql = "select * from erp_stock where fid=".$uid." and warehouse_cd=".$warehouse." and used='n' order by uid asc";
		$this->query($sql);
				
		$remain_cnt = 0;

		while($t = $this->fetch()) {
			if($t->remain_cnt > $cnt) { // 크다면

				$remain_cnt = $t->remain_cnt - $cnt;
				$sql = "update erp_stock set out_cnt=".$cnt.", remain_cnt=".$remain_cnt." where uid=".$t->uid;
				//echo $sql."====";
				$this->sub_query($sql);
				$this->registReason($uid, $t->uid, 0, $cnt, "생산불출");
				
				$sql = "select stock_cnt from erp_item where uid=".$uid;
				$this->sub_query($sql);
				$item = $this->sub_fetch();
				$new_cnt = $item->stock_cnt-$cnt;
				
				$sql = "update erp_item set stock_cnt=".$new_cnt." where uid=".$uid;
				$this->sub_query($sql);
				break;

			} else if($t->remain_cnt == $cnt) { // 같다면

				$sql = "update erp_stock set out_cnt=".$cnt.", remain_cnt=0, used='y' where uid=".$t->uid;
				$this->sub_query($sql);
				$this->registReason($uid, $t->uid, 0, $cnt, "생산불출");
	
				$sql = "select stock_cnt from erp_item where uid=".$uid;
				$this->sub_query($sql);
				$item = $this->sub_fetch();
				$new_cnt = $item->stock_cnt-$cnt;

				$sql = "update erp_item set stock_cnt=".$new_cnt." where uid=".$uid;
				$this->sub_query($sql);
				break;

			} else { // 적다면
				$sql = "update erp_stock set out_cnt=".$t->remain_cnt.", remain_cnt=0, used='y' where uid=".$t->uid;
				$this->sub_query($sql);
				$this->registReason($item->uid, $t->uid, 0, $remain_cnt, "생산불출");
				
				$sql = "select stock_cnt from erp_item where uid=".$uid;
				$this->sub_query($sql);
				$item = $this->sub_fetch();
				$new_cnt = $item->stock_cnt-$t->remain_cnt;

				$sql = "update erp_item set stock_cnt=".$new_cnt." where uid=".$uid;
				$this->sub_query($sql);

				$cnt = $cnt - $t->remain_cnt;

				$sql = "select * from erp_stock where fid=".$uid." and warehouse_cd=".$warehouse." and used='n' order by uid asc";
				$this->query($sql);
			}
		}
	}

	// 자재출고 선입선출
	public function firstInFirstOutRelease($item_uid, $warehouse, $cnt, $release_uid) {
		// 출고요청서의 잔여출고요청수량을 변경한다
		$sql = "select * from erp_release_item where uid=".$release_uid;
		$this->query($sql);
		$release = $this->fetch();
		$new_release_cnt = $release->remain_cnt - $cnt;
		
		// 해당 자재의 출고상태 변경
		if($new_release_cnt == 0) $state = "complete";
		else $state = "release";

		$sql = "update erp_release_item set remain_cnt=".$new_release_cnt.", state='".$state."' where uid=".$release_uid;
		$this->query($sql);

		// 모든 자재가 출고완료가 되었다면 erp_release 의 상태값 변경
		$sql = "select sum(remain_cnt) as remain_cnt from erp_release_item where fid=".$release->fid;
		$this->query($sql);
		$a = $this->fetch();
		if($a->remain_cnt <= 0) {
			$sql = "update erp_release set state='complete' where uid=".$release->fid;
			$this->query($sql);
		}

		// 투입된 수량 만큼 erp_stock 에서 가져온다 (lot_no 때문에)
		$sql = "select * from erp_stock where fid=".$item_uid." and warehouse_cd=".$warehouse." and used='n' order by uid asc";
		$this->query($sql);
				
		$remain_cnt = 0;

		while($t = $this->fetch()) {
			if($t->remain_cnt > $cnt) { // 크다면

				$remain_cnt = $t->remain_cnt - $cnt;
				$sql = "update erp_stock set out_cnt=".$cnt.", remain_cnt=".$remain_cnt." where uid=".$t->uid;
				//echo $sql."====";
				$this->sub_query($sql);
				$this->registReason($item_uid, $t->uid, 0, $cnt, "생산불출");
				
				$sql = "select stock_cnt from erp_item where uid=".$item_uid;
				$this->sub_query($sql);
				$item = $this->sub_fetch();
				$new_cnt = $item->stock_cnt-$cnt;
				
				$sql = "update erp_item set stock_cnt=".$new_cnt." where uid=".$item_uid;
				$this->sub_query($sql);
				break;

			} else if($t->remain_cnt == $cnt) { // 같다면

				$sql = "update erp_stock set out_cnt=".$cnt.", remain_cnt=0, used='y' where uid=".$t->uid;
				$this->sub_query($sql);
				$this->registReason($item_uid, $t->uid, 0, $cnt, "생산불출");
	
				$sql = "select stock_cnt from erp_item where uid=".$item_uid;
				$this->sub_query($sql);
				$item = $this->sub_fetch();
				$new_cnt = $item->stock_cnt-$cnt;

				$sql = "update erp_item set stock_cnt=".$new_cnt." where uid=".$item_uid;
				$this->sub_query($sql);
				break;

			} else { // 적다면
				$sql = "update erp_stock set out_cnt=".$t->remain_cnt.", remain_cnt=0, used='y' where uid=".$t->uid;
				$this->sub_query($sql);
				$this->registReason($item->uid, $t->uid, 0, $remain_cnt, "생산불출");
				
				$sql = "select stock_cnt from erp_item where uid=".$item_uid;
				$this->sub_query($sql);
				$item = $this->sub_fetch();
				$new_cnt = $item->stock_cnt-$t->remain_cnt;

				$sql = "update erp_item set stock_cnt=".$new_cnt." where uid=".$item_uid;
				$this->sub_query($sql);

				$cnt = $cnt - $t->remain_cnt;

				$sql = "select * from erp_stock where fid=".$item_uid." and warehouse_cd=".$warehouse." and used='n' order by uid asc";
				$this->query($sql);
			}
		}
	}

	public function getProcess($process = null) {
		$html = "";
		$sql = "select * from erp_process";
		$this->sub_query($sql);
		while($t = $this->sub_fetch()) {
			if($process != "") {
				if($process == $t->uid) $sel = "selected"; else $sel = "";
			}

			$html .= "<option value='".$t->uid."' ".$sel.">".$t->process_nm."</option>";
		}

		return $html;
	}

	public function getMachine($machine = null) {
		$html = "";
		$sql = "select * from erp_machine";
		$this->sub_query($sql);
		while($t = $this->sub_fetch()) {
			if($machine != "") {
				if($machine == $t->uid) $sel = "selected"; else $sel = "";
			}
			$html .= "<option value='".$t->uid."' ".$sel.">".$t->machine_nm."</option>";
		}

		return $html;
	}

	// 2차 품목 창고별 재고수량 합산하여 총재고 확인
	public function getStockCnt($item_cd) {
		$sql = "select * from warehouse";
		$result = mysql_query($sql) or die (mysql_error());
		$total = 0;

		while($t = @mysql_fetch_object($result)) {
			$warehouse = "warehouse_".$t->uid;
			$is = $this->isTable($warehouse, DB_NAME);
			if($is) {
				$sql = "select cnt from ".$warehouse." where item_cd='".$item_cd."'";
				$this->sub_query($sql);
				while($tt = $this->sub_fetch()) {
					$total = $total + $tt->cnt;
				}
			}
		}

		// 공정재고
		$sql = "select * from process";
		$result = mysql_query($sql) or die (mysql_error());
		$process_total = 0;

		while($t = @mysql_fetch_object($result)) {
			$warehouse = "process_warehouse_".$t->uid;
			$is = $this->isTable($warehouse, DB_NAME);
			if($is) {
				$sql = "select cnt from ".$warehouse." where item_cd='".$item_cd."' and standard='".$standard."'";
				$this->sub_query($sql);
				while($tt = $this->sub_fetch()) {
					$process_total = $process_total + $tt->cnt;
				}
			}
		}
		$total = $total + $process_total;
		return $total;
	}

	// 2차 품목 창고별 재고수량 합산하여 총재고 확인
	public function getWarehouseStockCnt($item_cd, $standard) {
		$sql = "select * from warehouse";
		$result = mysql_query($sql) or die (mysql_error());
		$total = 0;

		while($t = @mysql_fetch_object($result)) {
			$warehouse = "warehouse_".$t->uid;
			$is = $this->isTable($warehouse, DB_NAME);
			if($is) {
				$sql = "select cnt from ".$warehouse." where item_cd='".$item_cd."' and standard='".$standard."'";
				$this->sub_query($sql);
				while($tt = $this->sub_fetch()) {
					$total = $total + $tt->cnt;
				}
			}
		}

		return $total;
	}

	// 2차 품목 지정창고 재고수량 합산하여 총재고 확인
	public function getProcessStockCnt($item_cd, $standard, $process) {
		$warehouse = "process_warehouse_".$process;
		$sql = "select sum(cnt) as cnt from ".$warehouse." where item_cd='".$item_cd."' and standard='".$standard."'";
		$this->sub_query($sql);
		$t = $this->sub_fetch();

		return $t->cnt;
	}

	// 2차 입출고장 기록
	public function registInOut($type, $reason, $item_cd, $cnt, $price, $lot_no = null) {
		
		$total_price = $cnt * $price;

		if($type == "in") {
			$data = array(
				"table" => "in_out",
				"item_cd" => $item_cd,
				"in_cnt" => $cnt,
				"in_price" => $price,
				"in_total_price" => $total_price,
				"out_cnt" => 0,
				"out_price" => 0,
				"out_total_price" => 0,
				"lot_no" => $lot_no,
				"reason" => $reason,
				"create_dt" => date("Y-m-d")
			);			
		} else if($type == "out") {
			$data = array(
				"table" => "in_out",
				"item_cd" => $item_cd,
				"in_cnt" => 0,
				"in_price" => 0,
				"in_total_price" => 0,
				"out_cnt" => $cnt,
				"out_price" => $price,
				"out_total_price" => $total_price,
				"lot_no" => $lot_no,
				"reason" => $reason,
				"create_dt" => date("Y-m-d")
			);
		}

		$this->insert($data);
	}

	function createLotNo($item_cd, $account = null) {
		$str1 = date("ymd");
		$str2 = $str1."-".$item_cd;
		$str3 = $str2."-".$account;
	}

	
	//' DB에 Insert
	public function convert_input($tag){
		$tag = str_ireplace("&","&amp;",$tag);
		$tag = str_ireplace('"',"&quot;",$tag);
		$tag = str_ireplace("'","&#039;",$tag);
		$tag = str_ireplace("<","&lt;",$tag);
		$tag = str_ireplace(">","&gt;",$tag);
		return $tag;
	}

	//' HTML로 OUT
	public function convert_output($CheckValue){
		$tag = str_ireplace("&","&amp;",$tag);
		$tag = str_ireplace('"',"&quot;",$tag);
		$tag = str_ireplace("'","&#039;",$tag);
		$tag = str_ireplace("<","&lt;",$tag);
		$tag = str_ireplace(">","&gt;",$tag);
		return $tag;
	}

	#--------------------------------------------------------------------------------------------
	//테이블 검사 (db에 해당 테이블이 생성 되어있나 확인한다. 없다면 false 반환
	#--------------------------------------------------------------------------------------------
	public function isTable($str,$dbname){
		$result=mysql_list_tables($dbname) or die (mysql_error());
		$i=0;

		while ($i < mysql_num_rows($result)) {
			if($str==mysql_tablename ($result, $i)) return true;
			$i++;
		}
		return false;
	}
	

	// 소득세 계산
	public function getIncomeTax($pay){
		$sql = "select * from income_tax where pay=".$pay;
		$result = @mysql_query($sql);
		$t = @mysql_fetch_object($result);
		return $t->tax;
	}
}
?>