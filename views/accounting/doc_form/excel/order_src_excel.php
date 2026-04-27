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
	header( "Content-Disposition: attachment; filename=".utf2euc("구매요청서_".date('YmdHms')).".xls" );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>     
	</head>	
	<body>
		<table cellpadding="5" cellspacing="0" border="1" align="center" style="border-collapse:collapse;">
			<thead>
			<tr>
				<th>No</th>
				<th>구매요청번호</th>
				<th>처래처</th>
				<th>품목</th>
				<th>규격</th>
				<th>창고</th>
				<th>납기예정일자</th>
				<th>수량</th>
				<th>금액</th>
				<th>비고</th>
				<th>진행상태/변경</th>
				<th>담당자</th>
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

				//if ($sortitem != "prod_des") $sortitem = "a.".$sortitem;
				//if ($sortitem == "a.TotalAmount") $sortitem = "cast(replace(".$sortitem.",',','') as int)";

                $sql = "Select * From porder where basic_date != '' ".$fild_name .$recd_value .$search_sql ." order by $sortitem $sortflag limit 0, 1000";

                //echo $sql;
				$result = mysql_query($sql);
                //$cnt = mysql_num_rows($result);
                
				if ($result) {

					$ct = 1;
					while ($row = mysql_fetch_array($result)) {	

						$no = $pagesize * ($page-1) + $ct;
			?>				
				<tr>
					<td><?=$ct?></td>
					<td><?=$row['pord_no']?></td>
					<td><?=$row['cust_name']?></td>
					<td><b><?=$row['emp_name']?></b></td>
					<td><?=estimate_cnt_is('porderSub', $row['pord_no'], 'pord_no')?></td>
					<td align="right"><?=$row["wh_name"]?></td>
					<td align="right"><?=$row['req_date']?></td>
					<td align="center"><?=erp_cnt_is('porderSub', $row['pord_no'], 'pord_no', 'qty')?></td>								
					<td align="center"><?=$row['TotalAmount']?></td>								
					<td align="center"><?=$row['p_des']?></td>
					<td align="center"><?=$row['progress_state']?></td>
					<td align="center"><?=$row['emp_name']?></td>
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
