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

	case "getTaxInvoice" :
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
		$query = "select count(*) from erp_tax_invoice".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_tax_invoice ".$where." order by tid desc  limit ".($page-1)*$rpp.", ".$rpp;
		//echo $query."<BR>";
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['tid'] = $t->tid;
			$re[$i]['statement_ca'] = $t->statement_ca;
			$re[$i]['statement_dt'] = substr($t->statement_dt,0,10);
			$re[$i]['invoiceType'] = $t->invoiceType;
			$re[$i]['etc'] = $t->etc;
			$re[$i]['total_price'] = $t->total_price;
			$re[$i]['create_dt'] = substr($t->regdate,0,10);

			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;

			$query_sub = "select * from erp_tax_invoice_item where statement_tid='".substr($t->statement_dt,0,10)."-".$t->statement_ca."' order by uid limit 0,1";
			//echo $query_sub."<BR>";
			$results = mysql_query($query_sub);
			$s = @mysql_fetch_object($results);
			$re[$i]['account_nm'] = $s->account_nm;

			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;

	case "getTaxInvoiceItem" :
		$query = "select * from erp_tax_invoice_item where tid ='".$tid."' order by uid";
		//echo $query;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num']		= $total_num;
			$re[$i]['no']				= $no;
			$re[$i]['uid']				= $t->uid;
			$re[$i]['tid']				= $t->tid;
			$re[$i]['tax_invoice_dt']	= $t->tax_invoice_dt;
			$re[$i]['purchasedt1']		= $t->purchasedt1;
			$re[$i]['purchasedt2']		= $t->purchasedt2;
			$re[$i]['item_cd']			= $t->item_cd;
			$re[$i]['item_nm']			= $t->item_nm;
			$re[$i]['standard']			= $t->standard;
			$re[$i]['cnt']				= $t->cnt;
			$re[$i]['unit_price']		= $t->unit_price;
			$re[$i]['pro_unit_price']	= $t->pro_unit_price;
			$re[$i]['unit_price']		= $t->unit_price;
			$re[$i]['tax']				= $t->tax;
			$re[$i]['total_price']		= $t->total_price;
			$re[$i]['total_tax']		= $t->total_tax;
			$re[$i]['regdate']			= substr($t->regdate,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;


	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteTaxInvoice" :
		// 하위 견적서도 다 삭제해야함
		// 견적아이템도 삭제
		$array_tid = explode(",",$tids);
		for($i = 0 ; $i <= sizeof($array_tid) ; $i++) {
			$query = "delete from erp_order where tid=".$array_tid[$i];
			mysql_query($query);

			$query = "delete from erp_order_item where fid=".$array_tid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
}
?>