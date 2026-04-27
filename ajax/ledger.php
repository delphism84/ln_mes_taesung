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
	case "FixedAssetsTypetCd" :
		$query = "select MAX(uid) AS cha from erp_fixed_assets_type";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;
		echo sprintf("%05d",$cha);
		
		//$data = 8;
		//echo str_pad($data,"5","0",STR_PAD_LEFT); //str_pad 함수의 경우 "STR_PAD_RIGHT", "STR_PAD_LEFT", "STR_PAD_BOTH"
	break;
	
	case "fixedAssetsCodetCd" :
		$query = "select MAX(uid) AS cha from erp_fixed_assets_code";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;
		echo sprintf("%05d",$cha);
		//$data = 8;
		//echo str_pad($data,"5","0",STR_PAD_LEFT); //str_pad 함수의 경우 "STR_PAD_RIGHT", "STR_PAD_LEFT", "STR_PAD_BOTH"
	break;

	case "getGeneralLedgerAccount" :
		//$where = " where final='y'";
		$where = " where 1=1";
		if($aci_cd != "") {
			if($search_checked1 == "0") {
				if($base_sdate != "" && $base_edate != "") {
					$where .= " and statement_dt between '".trim($base_sdate)."' and '".trim($base_edate)."'";
				}
				if($department_cd != "") {
					$where .= " and department_cd = '".trim($department_cd)."'";
				}
				if($project_cd != "") {
					$where .= " and project_cd = '".trim($project_cd)."'";
				}
				if($aci_cd != "") {
					$where .= " and aci_cd = '".trim($aci_cd)."'";
				}
				if($account_cd != "") {
					$where .= " and account_cd = '".trim($account_cd)."'";
				}
			
			} else if($search_checked1 == "1") {
				$where .= " and emp_nm like '%".$txt."%'";
			} else if($search_checked1 == "2") {
				$where .= " and emp_nm like '%".$txt."%'";
			}else{
				if($base_sdate == "" && $base_edate == "") {
					$where .= " and (statement_dt between '".trim($base_sdate)."' and '".trim($base_edate)."'";
				}
				if($department_cd == "") {
					$where .= " and department_cd = '".trim($department_cd)."'";
				}
				if($project_cd == "") {
					$where .= " and project_cd = '".trim($project_cd)."'";
				}
				if($aci_cd == "") {
					$where .= " and aci_cd = '".trim($aci_cd)."'";
				}
				if($account_cd == "") {
					$where .= " and account_cd = '".trim($account_cd)."'";
				}
			}
		}else{
			$where .= " and statement_dt between '".trim(date('Y/m/d'))."' and '".trim(date('Y/m/d'))."'";
		}

		$query = "select * from ".$table.$where;
		//echo $query."<BR>";
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from ".$table.$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from ".$table .$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query."<BR>";
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num']	= $total_num;
			$re[$i]['no']			= $no;
			$re[$i]['uid']			= $t->uid;
			$re[$i]['statement_dt'] = substr($t->statement_dt,0,10);
			$re[$i]['statement_ca'] = $t->statement_ca;

			$re[$i]['trade_type']	= $t->trade_type;
			switch($t->trade_type){ 
			case "G" :
				$trade_type ="일반전표";
			break;
			case "P" :
				$trade_type ="매입전표";
			break;
			case "S" :
				$trade_type ="매출전표";
			break;
			default :
				$trade_type ="일반전표";
			break;
			}
			$re[$i]['trade_type']	= $trade_type;

			$re[$i]['trade_type_code']	= $t->trade_type;


			$re[$i]['statement_no'] = $t->statement_no;
			
			$re[$i]['account_cd']	= $t->account_cd;
			$re[$i]['account_nm']	= $t->account_nm;
			$re[$i]['remark']		= $t->remark;
			$re[$i]['total_amount'] = $t->total_amount;
			$re[$i]['debtor']		= $t->debtor;
			$re[$i]['creditor']		= $t->creditor;
			$re[$i]['regdate']		= $t->regdate;
			$re[$i]['balance']		= (double)$t->debtor - (double)$t->creditor;
			
			//$vat_type_text = getVatType($t->vattype);
			//$re[$i]['vattype'] = $vat_type_text;

			//$invoiceType_text = GetInTypeEctaxFlag($t->invoiceType);
			//$re[$i]['invoiceType'] = $invoiceType_text;
			
			/*
			$query_sub = "select * from ".$table."_item where statement_sid='".substr($t->statement_dt,0,10)."-".$t->statement_ca."' order by uid limit 0,1";
			//echo $query_sub."<BR>";
			$results = mysql_query($query_sub);
			$s = @mysql_fetch_object($results);
			$re[$i]['account_nm'] = $s->account_nm;
			*/
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	// 계정별 원장 데이터 가져오기
	case "getGeneralLedgerAccount2" :     //모든 전표 테이블 조인해서 가져오는 방식
		//$where = " where final='y'";
		$where = " where 1=1";
		
		if($department_cd == "all") {
			$where .= "";
		} else if($department_cd != "") {
			$where .= " and department_cd=".$department_cd;
		} else {
			$where .= "";
		}
		
		if($txt != "") {
			if($search_choice == "emp_cd") {
				$where .= " and emp_cd like '%".$txt."%'";
			} else if($search_choice == "emp_nm") {
				$where .= " and emp_nm like '%".$txt."%'";
			}
		}
		//$table = "erp_g_statement as g join erp_p_statement as p join erp_s_statement as s on A.num=B.num"; 

		

		//$table = "";
		//$table .="select * from erp_g_statement union ";
		//$table .="select * from erp_p_statement union ";
		//$table .="select * from erp_s_statement union ";
		//$table4 ="";
		//$query = "select * from ".$table.$where;
		
		$table ="select gid, statement_dt, statement_ca, summary, ( SELECT account_cd FROM erp_g_statement_item p WHERE p.gid = g.gid order by uid desc limit 0,1) as account_cd, ( SELECT account_nm FROM erp_g_statement_item p WHERE p.gid = g.gid order by uid desc limit 0,1) as account_nm, ( SELECT SUM(debtor) FROM erp_g_statement_item p WHERE p.gid = g.gid) as debtor , ( SELECT SUM(creditor) FROM erp_g_statement_item p WHERE p.gid = g.gid) as creditor from erp_g_statement g union select pid, statement_dt, statement_ca, remark, account_cd, account_nm, total_amount as debtor, total_amount as creditor from erp_p_statement union select sid, statement_dt, statement_ca, summary, account_cd, account_nm, accounts_recev_price as debtor, accounts_recev_price as creditor from erp_s_statement";
		$query = $table.$where;

		//echo $query."<BR>";
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		//$query = "select count(*) from ".$table.$where;
		//$query = "select count(*) from ".$table.$where;
		$query = "select count(*) from
		(
			select gid as TR_NO  FROM erp_g_statement_item
			UNION 
			select pid as TR_NO FROM erp_p_statement
			UNION 
			select sid as TR_NO FROM erp_s_statement
			)CNT
		";
		//echo $query."<BR>";
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		//$query = "select * from ".$table .$where." order by sid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$query = $table. $where." limit ".($page-1)*$rpp.", ".$rpp;
		echo $query."<BR>";
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['sid'] = $t->gid;
			$re[$i]['statement_ca'] = $t->statement_ca;
			$re[$i]['statement_dt'] = substr($t->statement_dt,0,10);
			$re[$i]['summary'] = $t->summary;
			$re[$i]['total_price'] = $t->total_price;
			$re[$i]['total_tax']	= $t->total_tax;
			$re[$i]['regdate'] = substr($t->regdate,0,10);

			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;

			$vat_type_text = getVatType($t->vattype);
			$re[$i]['vattype'] = $vat_type_text;

			$invoiceType_text = GetInTypeEctaxFlag($t->invoiceType);
			$re[$i]['invoiceType'] = $invoiceType_text;
			
			/*
			$query_sub = "select * from ".$table."_item where statement_sid='".substr($t->statement_dt,0,10)."-".$t->statement_ca."' order by uid limit 0,1";
			//echo $query_sub."<BR>";
			$results = mysql_query($query_sub);
			$s = @mysql_fetch_object($results);
			$re[$i]['account_nm'] = $s->account_nm;
			*/
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
	
	case "getFixedAssetsType" :
		$where = " where 1=1";
		
		if($account_gb == "all") {
			$where .= "";
		} else if($account_gb == "purchase") {
			$where .= " and account_gb='purchase'";
		} else if($account_gb == "sales") {
			$where .= " and account_gb='sales'";
		} else {
			$where .= "";
		}
	
		if($txt != "") {
			if($search_choice == "fat_nm") {
				$where .= " and fat_nm like '%".$txt."%'";
			} else if($search_choice == "asset_ac_nm") {
				$where .= " and asset_ac_nm like '%".$txt."%'";
			}
		}

		$query = "select * from erp_fixed_assets_type".$where;
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = $rpp;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  

		$query = "select count(*) from erp_fixed_assets_type".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_fixed_assets_type".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo "query=".$query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			//$re[$i]['fat_cd'] = $t->fat_cd;
			//$re[$i]['fat_cd'] = sprintf("%05d",$t->fat_cd);
			$re[$i]['fat_cd'] = $t->fat_cd;
			$re[$i]['fat_nm'] = $t->fat_nm;
			$re[$i]['asset_ac_cd'] = $t->asset_ac_cd;
			$re[$i]['asset_ac_nm'] = $t->asset_ac_nm;
			$re[$i]['allowance_depreciation_cd']	= $t->allowance_depreciation_cd;
			$re[$i]['allowance_depreciation_nm']	= $t->allowance_depreciation_nm;
			$re[$i]['depreciation_cost_cd']			= $t->depreciation_cost_cd;
			$re[$i]['depreciation_cost_nm']			= $t->depreciation_cost_nm;
			$re[$i]['service_life']					= $t->service_life;
			$re[$i]['salvage_value']				= $t->salvage_value;
			
			$re[$i]['depreciable_type']				= $t->depreciable_type;
			switch($t->depreciable_type){ 
			case "1" :
				$depreciable_type ="정액법";
			break;
			case "2" :
				$depreciable_type ="정률법";
			break;
			default :
				$depreciable_type ="정액법";
			break;
			}
			$re[$i]['depreciable_type'] = $depreciable_type;

			$re[$i]['service_life_unit']			= $t->service_life_unit;
			switch($t->service_life_unit){ 
			case "1" :
				$service_life_unit ="년";
			break;
			case "2" :
				$service_life_unit ="월";
			break;
			default :
				$service_life_unit ="년";
			break;
			}
			$re[$i]['service_life_unit'] = $service_life_unit;

			$re[$i]['use_yn'] = $t->use_yn;
			switch($t->use_yn){ 
			case "1" :
				$use_yn ="사용";
			break;
			case "0" :
				$use_yn ="중단";
			break;
			default :
				$use_yn ="사용";
			break;
			}
			$re[$i]['use_yn'] = $use_yn;

			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getFixedAssetsCode" :
		$where = " where 1=1";
		
		if($account_gb == "all") {
			$where .= "";
		} else if($account_gb == "purchase") {
			$where .= " and account_gb='purchase'";
		} else if($account_gb == "sales") {
			$where .= " and account_gb='sales'";
		} else {
			$where .= "";
		}
		
		if($txt != "") {
			if($search_choice == "fac_nm") {
				$where .= " and fac_nm like '%".$txt."%'";
			} else if($search_choice == "asset_ac_nm") {
				$where .= " and asset_ac_nm like '%".$txt."%'";
			}
		}

		$query = "select * from erp_fixed_assets_code".$where;
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = $rpp;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  

		$query = "select count(*) from erp_fixed_assets_code".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_fixed_assets_code".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['fac_cd'] = $t->fac_cd;
			$re[$i]['fac_nm'] = $t->fac_nm;
			$re[$i]['department_cd'] = $t->department_cd;
			$re[$i]['department_nm'] = $t->department_nm;
			$re[$i]['fat_cd'] = $t->fat_cd;
			$re[$i]['fat_nm'] = $t->fat_nm;
			$re[$i]['asset_ac_cd'] = $t->asset_ac_cd;
			$re[$i]['asset_ac_nm'] = $t->asset_ac_nm;
			$re[$i]['allowance_depreciation_cd']	= $t->allowance_depreciation_cd;
			$re[$i]['allowance_depreciation_nm']	= $t->allowance_depreciation_nm;
			$re[$i]['depreciation_cost_cd']			= $t->depreciation_cost_cd;
			$re[$i]['depreciation_cost_nm']			= $t->depreciation_cost_nm;
			$re[$i]['service_life']					= $t->service_life;
			$re[$i]['salvage_value']				= $t->salvage_value;
			
			$re[$i]['depreciable_type']				= $t->depreciable_type;
			switch($t->depreciable_type){ 
			case "1" :
				$depreciable_type ="정액법";
			break;
			case "2" :
				$depreciable_type ="정률법";
			break;
			default :
				$depreciable_type ="정액법";
			break;
			}
			$re[$i]['depreciable_type'] = $depreciable_type;

			$re[$i]['service_life_unit']			= $t->service_life_unit;
			switch($t->service_life_unit){ 
			case "1" :
				$service_life_unit ="년";
			break;
			case "2" :
				$service_life_unit ="월";
			break;
			default :
				$service_life_unit ="년";
			break;
			}
			$re[$i]['service_life_unit'] = $service_life_unit;
			
			$re[$i]['status'] = $t->status;
			switch($t->status){ 
			case "1" :
				$status ="보유";
			break;
			case "2" :
				$status ="상각완료";
			break;
			case "3" :
				$status ="매각";
			break;
			case "4" :
				$status ="폐기";
			break;
			default :
				$status ="보유";
			break;
			}
			$re[$i]['status'] = $status;

			$re[$i]['remark'] = $t->remark;

			$re[$i]['use_yn'] = $t->use_yn;
			switch($t->use_yn){ 
			case "1" :
				$use_yn ="사용";
			break;
			case "0" :
				$use_yn ="중단";
			break;
			default :
				$use_yn ="사용";
			break;
			}
			$re[$i]['use_yn'] = $use_yn;

			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
		

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectFixedAssetsStatement" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_fixed_assets_statement where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

		// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectFixedAssetsType" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_fixed_assets_type where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "deleteSelectFixedAssetsCode" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_fixed_assets_code where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	
}
?>