<?php
	include_once($_SERVER["DOCUMENT_ROOT"]."/weberp/common.php"); // 기본 파일
	include_once($_SERVER["DOCUMENT_ROOT"]."/weberp/inc/dbconfig.php"); 
	include_once($_SERVER["DOCUMENT_ROOT"]."/weberp/inc/func.php");  // 함수 파일
	//header("Content-type: text/html; charset=UTF-8"); 
	if (!$is_member){
		goto_url("/login.php");
		exit;
	}

	function utf2euc($str) { return iconv("UTF-8","cp949//IGNORE", $str); }

	header("Content-type: application/vnd.ms-excel; charset=UTF-8"); 
	header( "Expires: 0" );
	header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
	header( "Pragma: public" );
	header( "Content-Disposition: attachment; filename=".utf2euc("주문서_".date('YmdHms')).".xls" );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	</head>	
	<body>
		<table style="width:1000px;" cellpadding="5" cellspacing="0" border="1" align="center" style="border-collapse:collapse;">
			<thead>
			<tr>
				<th>No</th>
				<th>주문번호</th>
				<th>거래처명</th>
				<th>담당자</th>
				<th>품목</th>
				<th>납기일자</th>
				<th>금액</th>
				<th>진행상태</th>
				<th>작성자</th>
			</tr>
			</thead>
			<tbody>
			<?
				//Select * From estimate where basic_date !='' order by num DESC limit 0, 10 
				$start_date = $_GET['start_date'];
				$end_date = $_GET['end_date'];
				$date_type = $_GET['date_type'];


				if (empty($start_date)) $start_date = date("Ymd", strtotime("-1 month"));			
				if (empty($end_date)) $end_date = date("Ymd");

				if ($start_date !="" && $end_date !="") {
					switch ($date_type) {
						case 'd':			
							$search_sql = " and (replace(basic_date,'/','') between '" .$start_date ."' and '" .$end_date ."')";
							break;
						case 'm':		
							$search_sql = " and (Left(replace(basic_date,'/',''),6) between '" .@substr($start_date, 0, 6)."' and '" .@substr($end_date, 0, 6)."')";
							break;
						case 'y':
							$search_sql = " and (Left(replace(basic_date,'/',''),4) between '" .@substr($start_date, 0, 4)."' and '" .@substr($end_date, 0, 4)."')";
							break;		
					}	
				}

				if (!empty($srch_type) && !empty($srch_word)) 
					$search_sql = $search_sql ." and " .$srch_type ." like '%" .$srch_word ."%'";
				
				//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''소트 기준 결정
				if (empty($sortitem)) $sortitem = "regdate";

				//'''''''''''''''''''''''''''''''''''''소트대상에대한 정렬방법결정(내림차순 오름차순)
				if (empty($sortflag)) $sortflag = "DESC";					

				if ($sortitem != "prod_des") $sortitem = "a.".$sortitem;
				if ($sortitem == "a.TotalAmount") $sortitem = "cast(replace(".$sortitem.",',','') as int)";

				$sql = "Select * From esti_orders a left join esti_orderssub b on a.ord_no = b.ord_no where  basic_date !='' ".$search_sql." order by ".$sortitem." ".$sortflag." limit 0, 1000";

				$result = mysql_query($sql);
				//$cnt = mysql_num_rows($result);
				if ($result) {
					$ct=1;
					while ($rows = mysql_fetch_array($result)) {	

						$no = $pagesize * ($page-1) + $ct;
						$num			= $rows["num"];
						$ord_no			= $rows["ord_no"];
						$rel_no			= $rows["rel_no"];
						$rel_cd			= $rows["rel_cd"];
						$rel_gubun		= $rows["rel_gubun"];
						$rel_state		= $rows["rel_state"];
						$cust_name		= $rows["cust_name"];
						$cust_cd		= $rows["cust_cd"];
						$emp_cd			= $rows["emp_cd"];
						$emp_name		= $rows["emp_name"];
						$wh_name		= $rows["wh_name"];
						$wh_cd			= $rows["wh_cd"];
						$io_type		= $rows["io_type"];
						$foreign_type	= $rows["foreign_type"];
						$pjt_cd			= $rows["pjt_cd"];
						$ref_des		= $rows["ref_des"];
						$coll_term		= $rows["coll_term"];
						$agree_term		= $rows["agree_term"];
						$DeliveryDateTime = $rows["DeliveryDateTime"];					
						$p_des			= $rows["p_des"];
						$addfiles		= $rows["addfiles"];
						$real_name		= $rows["real_name"];
						$message		= $rows["message"];
						$memo			= $rows["memo"];
						$writer			= $rows["writer"];
						$AmountTotal	= $rows["AmountTotal"];
						$TaxTotal		= $rows["TaxTotal"];
						$TotalAmount	= $rows["TotalAmount"];
						$mem_sn			= $rows["mem_sn"];
						$state_yn		= $rows["state_yn"];
						$regdate		= $rows["regdate"];
						$progress_state = $rows["progress_state"];	
					
						if ($customer_status == "1") {
							$customer_status_text = "거래";
						} else {
							$customer_status_text = "정지";
						}

						if (strlen($address) > 50) {
							$address = mb_strimwidth($address, '0', '23', '..', 'utf-8');
						} else {
							$address = $address;
						}

						if (empty($progress_state)) $progress_state = "주문등록";			

			?>				
				<tr>
					<td><?=$ct?></td>
					<td><?=$ord_no?></td>
					<td><?=$cust_name?></td>
					<td><b><?=$emp_name?></b></td>
					<td><?=estimate_cnt_is('esti_ordersSub',$ord_no,'ord_no')?></td>
					<td class="center"><?=$DeliveryDateTime?></td>
					<td class="right"><?=$TotalAmount?></td>
					<td class="center"><?=$progress_state?></td>								
					<td class="center"><?=member_infor_is($mem_sn,'k_name')?></td>
				</tr>
			<?
						$ct = $ct + 1;
					}
				}

				for ($i=$ct;$i<3;$i++) {
			?>			
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>				
			<?
				}
			?>
			</tbody>
		</table>			  
 	</body>
</html>
