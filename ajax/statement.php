<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

switch($mode) {
	case "createStatement_Code" :
		$cd = "EST-".time();
		echo $cd;
	break;

	case "createOrderCode" :
		$cd = "ORD-".time();
		echo $cd;
	break;

	case "getStatement" :
		//$where = " where final='y'";
		if ($txt !="" && $where !=""){
			$where = $where;
		}else{
			$where = " where 1=1";
		}
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
		//echo $where."<BR>";
		$query = "select * from erp_statement".$where;
		//echo $query."<BR>";
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_statement ".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_statement".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query."<BR>";
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num']		= $total_num;
			$re[$i]['no']				= $no;
			$re[$i]['uid']				= $t->uid;
			$re[$i]['statement_dt']		= substr($t->statement_dt,0,10);
			$re[$i]['statement_ca']		= $t->statement_ca;
			$re[$i]['statement_no']		= $t->statement_no;
			$re[$i]['trade_type']		= $t->trade_type;
			$re[$i]['trade_type_code']	= $t->trade_type;
			if ($t->trade_type=="G"){
				$re[$i]['trade_type'] = "일반전표";
			}else if ($t->trade_type=="S"){
				$re[$i]['trade_type'] = "매출전표";
			}else if ($t->trade_type=="P"){
				$re[$i]['trade_type'] = "매입전표";
			}else{
				$re[$i]['trade_type'] = "일반전표";
			}

			$re[$i]['remark']			= $t->remark;
			$re[$i]['total_price']		= $t->total_price;
			$re[$i]['total_amount']		= $t->total_amount;
			$re[$i]['regdate']			= substr($t->regdate,0,10);

			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;

			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getGeneralStatement" :
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

		$query = "select * from ".$table.$where;
		//echo $query."<BR>";
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from ".$table.$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from ".$table .$where." order by gid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query."<BR>";
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['gid'] = $t->gid;
			$re[$i]['statement_ca'] = $t->statement_ca;
			$re[$i]['statement_dt'] = substr($t->statement_dt,0,10);
			$re[$i]['statement_type'] = $t->statement_type;
			$re[$i]['summary'] = $t->summary;
			$re[$i]['total_price'] = $t->total_price;
			$re[$i]['create_dt'] = substr($t->regdate,0,10);

			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;

			$query_sub = "select * from ".$table."_item where statement_gid='".substr($t->statement_dt,0,10)."-".$t->statement_ca."' order by uid limit 0,1";
			//echo $query_sub."<BR>";
			$results = mysql_query($query_sub);
			$s = @mysql_fetch_object($results);
			$re[$i]['account_nm'] = $s->account_nm;

			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getSalesStatement" :
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

		$query = "select * from ".$table.$where;
		//echo $query."<BR>";
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from ".$table.$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from ".$table .$where." order by sid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query."<BR>";
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['sid'] = $t->sid;
			$re[$i]['statement_ca'] = $t->statement_ca;
			$re[$i]['statement_dt'] = substr($t->statement_dt,0,10);
			$re[$i]['vattype'] = $t->vattype;
			$re[$i]['invoiceType'] = $t->invoiceType;
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


	case "getPurchaseStatement" :
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

		$query = "select * from ".$table.$where;
		//echo $query."<BR>";
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from ".$table.$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from ".$table .$where." order by pid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query."<BR>";
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['pid'] = $t->pid;
			$re[$i]['statement_dt'] = $t->statement_dt;
			$re[$i]['statement_ca'] = $t->statement_ca;
			$re[$i]['department_cd'] = $t->department_cd;
			$re[$i]['department_nm'] = $t->department_nm;
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['vattype'] = $t->vattype;
			$re[$i]['tax_deduct'] = $t->tax_deduct;
			$re[$i]['invoiceType'] = $t->invoiceType;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['supply_price'] = $t->supply_price;
			$re[$i]['tax'] = $t->tax;
			$re[$i]['remark'] = $t->remark;
			$re[$i]['aci_cd'] = $t->aci_cd;
			$re[$i]['aci_nm'] = $t->aci_nm;
			$re[$i]['bank_num'] = $t->bank_num;
			$re[$i]['bank_name'] = $t->bank_name;
			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	
	case "getNotUsedStatement_" :
//		$where = " where final='y' and used <> 'y'";
		$where = " where final='y'";
		
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

		$query = "select * from erp_g_statement".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_g_statement".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_g_statement".$where." order by gid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['gid'] = $t->gid;
			$re[$i]['statement_ca'] = $t->statement_ca;
			$re[$i]['statement_dt'] = substr($t->statement_dt,0,10);
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['manager'] = $t->manager;
			$re[$i]['invoiceType'] = $t->invoiceType;
			$re[$i]['tax_type'] = $t->tax_type;
			$re[$i]['currency'] = $t->currency;
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['refer'] = $t->refer;
			$re[$i]['payment_condition'] = $t->payment_condition;
			$re[$i]['validity_dt'] = substr($t->validity_dt,0,10);
			$re[$i]['attach'] = $t->attach;
			$re[$i]['final'] = $t->final;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getStatement_One" :
		$query = "select * from erp_g_statement where gid=".$gid;
		$t = mysql_fetch_object(mysql_query($query));

		$re['gid'] = $t->gid;
		$re['statement_ca'] = $t->statement_ca;
		$re['statement_dt'] = substr($t->statement_dt,0,10);
		$re['account_cd'] = $t->account_cd;
		$re['account_nm'] = $t->account_nm;
		$re['manager'] = $t->manager;
		$re['invoiceType'] = $t->invoiceType;
		$re['tax_type'] = $t->tax_type;
		$re['currency'] = $t->currency;
		$re['project_cd'] = $t->project_cd;
		$re['project_nm'] = $t->project_nm;
		$re['refer'] = $t->refer;
		$re['payment_condition'] = $t->payment_condition;
		$re['validity_dt'] = substr($t->validity_dt,0,10);
		$re['attach'] = $t->attach;
		$re['final'] = $t->final;
		$re['create_dt'] = substr($t->create_dt,0,10);

		echo $json->encode($re);
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectStatement_g" :
		// 하위 견적서도 다 삭제해야함
		$array_gid = explode(",",$gids);
		for($i = 0 ; $i <= sizeof($array_gid) ; $i++) {
			$query = "delete from erp_g_statement where gid=".$array_gid[$i];
			//echo $query;
			mysql_query($query);

			$query = "delete from erp_g_statement_item where gid=".$array_gid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectStatement_p" :
		// 하위 견적서도 다 삭제해야함
		$array_pid = explode(",",$pids);
		for($i = 0 ; $i <= sizeof($array_pid) ; $i++) {
			$query = "delete from erp_s_statement where pid=".$array_pid[$i];
			//echo $query;
			mysql_query($query);

			$query = "delete from erp_s_statement_item where pid=".$array_pid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectStatement_s" :
		// 하위 견적서도 다 삭제해야함
		$array_sid = explode(",",$sids);
		for($i = 0 ; $i <= sizeof($array_sid) ; $i++) {
			$query = "delete from erp_s_statement where sid=".$array_sid[$i];
			//echo $query;
			mysql_query($query);

			$query = "delete from erp_s_statement_item where sid=".$array_sid[$i];
			mysql_query($query);
		}

		echo "success";
	break;

	case "getSubStatement" :
		$query = "select * from erp_g_statement where statement_ca='".$statement_ca."' and gid <>".$gid." order by gid desc";
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['gid'] = $t->gid;
			$re[$i]['statement_ca'] = $t->statement_ca;
			$re[$i]['statement_dt'] = substr($t->statement_dt,0,10);
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['manager'] = $t->manager;
			$re[$i]['invoiceType'] = $t->invoiceType;
			$re[$i]['tax_type'] = $t->tax_type;
			$re[$i]['currency'] = $t->currency;
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['refer'] = $t->refer;
			$re[$i]['payment_condition'] = $t->payment_condition;
			$re[$i]['validity_dt'] = substr($t->validity_dt,0,10);
			$re[$i]['attach'] = $t->attach;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getGeneralStatementItem" :
		$query = "select * from erp_g_statement_item where gid =".$gid." order by uid";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['gid'] = $t->gid;
			$re[$i]['statement_gid'] = $t->statement_gid;
			$re[$i]['slip_gubun'] = $t->slip_gubun;
			$re[$i]['aci_cd'] = $t->aci_cd;
			$re[$i]['aci_nm'] = $t->aci_nm;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['debtor'] = $t->debtor;
			$re[$i]['creditor'] = $t->creditor;
			$re[$i]['remark_code'] = $t->remark_code;
			$re[$i]['remark'] = $t->remark;
			$re[$i]['writer'] = $t->writer;
			$re[$i]['project_cd'] = $t->project_cd;
			$re[$i]['project_nm'] = $t->project_nm;
			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getSalesStatementItem" :
		$query = "select * from erp_s_statement_item where sid =".$sid." order by uid";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['sid'] = $t->sid;
			$re[$i]['statement_sid'] = $t->statement_sid;
			$re[$i]['slip_gubun'] = $t->slip_gubun;
			$re[$i]['aci_cd'] = $t->aci_cd;
			$re[$i]['aci_nm'] = $t->aci_nm;
			$re[$i]['supply_price'] = $t->supply_price;
			$re[$i]['tax'] = $t->tax;
			$re[$i]['remark'] = $t->remark;
			$re[$i]['writer'] = $t->writer;
			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getPurchaseStatementItem" :
		$query = "select * from erp_p_statement where pid =".$pid." order by uid";
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['pid'] = $t->pid;
			$re[$i]['statement_dt'] = $t->statement_dt;
			$re[$i]['statement_ca'] = $t->statement_ca;
			$re[$i]['department_cd'] = $t->department_cd;
			$re[$i]['department_nm'] = $t->department_nm;
			$re[$i]['vattype'] = $t->vattype;
			$re[$i]['tax_deduct'] = $t->tax_deduct;
			$re[$i]['invoiceType'] = $t->invoiceType;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['supply_price'] = $t->supply_price;
			$re[$i]['tax'] = $t->tax;
			$re[$i]['remark'] = $t->remark;
			$re[$i]['aci_cd'] = $t->aci_cd;
			$re[$i]['aci_nm'] = $t->aci_nm;
			$re[$i]['bank_num'] = $t->bank_num;
			$re[$i]['bank_name'] = $t->bank_name;
			$re[$i]['regdate'] = substr($t->regdate,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;


	case "getOrder" :
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

		$query = "select * from erp_order".$where;
		$total_num = mysql_num_rows(mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = 10;  # record/page 
		$adjacents = 4; # 양 옆에 표시될 페이지 수  
		$query = "select count(*) from erp_order".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_order".$where." order by gid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;
		
		while($t = @mysql_fetch_object($result)) {
			$item_nm = "";
			$total = 0;
			$query = "select * from erp_order_item where fid=".$t->gid;
			$res = mysql_query($query);
			$k = 0;
			while($t2 = mysql_fetch_object($res)) {
				if($k == 0) $item_nm = $t2->item_nm;
				$total = $total + $t2->total_price;
				$k++;
			}
			
			if($k > 1) $item_nm = $item_nm . "외 " . ($k-1) . "건";

			switch($t->state) {
				case "i" : $state = "진행중"; break;
			}

			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['gid'] = $t->gid;
			$re[$i]['order_cd'] = $t->order_cd;
			$re[$i]['statement_ca'] = $t->statement_ca;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['item_nm'] = $item_nm;
			$re[$i]['total'] = number_format($total);
			$re[$i]['state'] = $state;
			$re[$i]['manager'] = $t->manager;
			$re[$i]['invoiceType'] = $t->invoiceType;
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
	






	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectOrder" :
		// 하위 견적서도 다 삭제해야함
		// 견적아이템도 삭제
		$array_gid = explode(",",$gids);
		for($i = 0 ; $i <= sizeof($array_gid) ; $i++) {
			$query = "delete from erp_order where gid=".$array_gid[$i];
			mysql_query($query);

			$query = "delete from erp_order_item where fid=".$array_gid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
}
?>