<?
require_once($_SERVER["DOCUMENT_ROOT"].'/connection.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/library/function.php');
require_once($_SERVER["DOCUMENT_ROOT"]."/assets/head_pop.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/assets/include_script.php");
session_start();
extract($_POST);
extract($_GET);
?>

<?
//	if ($mode=="modify"){
	$sql = "Select * From erp_s_statement where sid = ".$sid;
	//echo $sql."<br>"; 
	$result = mysql_query($sql);
	if ($result){
		//$cnt = mysql_num_rows($result);
		$ct=1;
		$row = mysql_fetch_array($result);	
			$statement_dt		= $row['statement_dt'];
			$statement_ca		= $row['statement_ca'];
			$department_cd		= $row['department_cd'];
			$department_nm		= $row['department_nm'];
			$project_cd			= $row['project_cd'];
			$project_nm			= $row['project_nm'];
			$account_cd			= $row['account_cd'];
			$account_nm			= $row['account_nm'];
			$vattype			= $row['vattype'];
			$tax_deduct			= $row['tax_deduct'];
			$in_type_ectax_flag	= $row['in_type_ectax_flag'];
			$total_price		= $row['total_price'];
			$total_tax			= $row['total_tax'];
			$summary			= $row['summary'];
			$receiptfee_cd		= $row['receiptfee_cd'];
			$receiptfee_nm		= $row['receiptfee_nm'];
			$receiptfee_price	= $row['receiptfee_price'];
			$bank_num			= $row['bank_num'];
			$bank_name			= $row['bank_name'];
			$receiptbank_num	= $row['receiptbank_num'];
			$accountsrecev_cd	= $row['accountsrecev_cd'];
			$accountsrecev_nm	= $row['accountsrecev_nm'];
			$accounts_recev_price= $row['accounts_recev_price'];
			$writer				= $row['writer'];
			$regdate			= $row['regdate'];

			if ($io_type=="00"){
				$io_type_value =	"VAT별도";
				$TaxTotal	   =	$TaxTotal;
			}else{
				$io_type_value =	"VAT포함";
				$TaxTotal	   =	"0"	;
			}

			switch ($vattype){
				case "1": $vattype_text="세금계산서"; 
				break;
				case "2": $vattype_text="영세율";
				break;
				case "3": $vattype_text="계산서"; 
				break;
				case "4": $vattype_text="소매매출";
				break;
				case "5": $vattype_text="수출";
				break;
				case "6": $vattype_text="카드매출";
				break;
				case "7": $vattype_text="계산서(고정자산)";
				break;
				case "8": $vattype_text="세.계(고정자산)";
				break;
				case "9": $vattype_text="소매(면세)";
				break;
				case "10":$vattype_text="카드매출(면세)";
				break;
				case "11":$vattype_text="현금영수증(면세)";
				break;
				case "12":$vattype_text="현금영수증";
				break;
				case "13":$vattype_text="매입자발행세금계산서";
				break;
				case "14":$vattype_text="영세율(기타)";
				break;
				case "15":$vattype_text="기타매출";
				break;
			}
		}
		
   
//	}
?>
<?
					$sql = "Select * From erp_s_statement_item where sid = ".$sid;
					//echo $sql."<br>";  
					$result = mysql_query($sql);
					$cnt = mysql_num_rows($result);
					if ($cnt <= "6"){
						$pagecnt= "1";
					}else if ($cnt < "6" && $cnt <= "12"){
						$pagecnt= "2";
					}else if ($cnt > "12" && $cnt <= "18"){
						$pagecnt= "3";
					}else if ($cnt > "18" && $cnt <= "24"){
						$pagecnt= "4";
					}else if ($cnt > "24" && $cnt <= "30"){
						$pagecnt= "5";
					}else if ($cnt > "30" && $cnt <= "36"){
						$pagecnt= "6";
					}else if ($cnt > "36" && $cnt <= "42"){
						$pagecnt= "7";
					}

					if ($result){
						if ($cnt>"0"){
							$ct=1;
							$totalunit=0;
							while($rows=mysql_fetch_array($result)) {
								$uid			=$rows["idx"];	
								$sid			=$rows["sid"];		
								$statement_sid	=$rows["statement_sid"];		
								$aci_cd			=$rows["val"];		
								$aci_nm			=$rows["aci_nm"];		
								$unit_price		=$rows["unit_price"];		
								$tax			=$rows["tax"];		
								$remark			=$rows["remark"];		
								$writer			=$rows["writer"];		
								
								$totalunit = $totalunit + $qty;
								$totalvat_amt = $vat_amt + $vat_amt ;
								
								$ct++;
							}
?>

<?
						}	
					}
						?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head id="Head1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="robots" content="noindex,nofollow">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <link type="text/css" rel="stylesheet" href="/assets/css2/2_layout.css?20171101" />
	<link type="text/css" rel="stylesheet" href="/assets/css2/2_table.css?20171101" />
    <script language="javascript" type="text/javascript" src="/assets/Scripts/virtualpaginate.js?2016021701"></script>
</head>
<body>
<form method="post" action="./EBZ013P_01.aspx?ec_req_sid=B-E0JtUjDj7VnDN" id="form1">
<div id="wrap_pop" style="margin:10px 0 0 10px;">
<div class="dual-btn-fixed top-zero" id="divPrint" style="display:">
    <div class="dual-btn-area">
      <p class="float_left">
       <span class="btn gray"><input type="button" id="Button1" value="인쇄" onclick="fnPrintHits('');" /></span> 
       <span class="btn gray"><input type="button" name="btnPdf" id="btnPdf" value="PDF" onclick="fnPdfBeta();" /></span> </p>
    </div>
	<?if ($pagecnt >= "3"){?>
    <!-- 인쇄옵션 시작 -->
    <div class="dual-btn-area" id="dual_btn_area">
        <div class="float_right">
            <div id="scriptspaginate" class="paginationstyle">
                <a href="#" rel="first"></a><a href="#" rel="previous"></a><a href="#" rel="next"></a><a href="#" rel="last"></a><span class="paginateinfo"></span>
            </div>
        </div>
    </div>
	<?}?>

    <!-- 인쇄옵션 끝 -->
</div>

<div style="margin:50px 0 -30px 0;"></div>
<center>
<div id="idPrint" class="p-relative" style="margin-top:80px">
<!-- 일반전표 신규양식 -->
<div id="pnSlipFormCtrl">
	<div class="virtualpage hidepiece" printtype="page">
	<div id="rpt_contents_new">
		<div class="p-absolute" style="top:0px; left:0px">
			<table border="0" cellpadding="0" cellspacing="0" width="650">
				<tr>
					<td valign="top">
						<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin-bottom:5px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">
							<tbody>
								<tr>
									<td style="width:99%; font-size:30px; font-weight:bold; line-height:30px; text-align:center">전표</td>
									<td align="right" style="width:1%">
										<table cellpadding='0' cellspacing='0' border='0' style='width:236px; border-width:1px; border-style:solid; border-color:#333333;'>
											<tbody>
											<tr>
												<th style='font-size:12px; width:24px;font-family:Dotum, Arial, Sans-serif; line-height:1.2; font-weight:bold; background-color:#ececec; text-align:center;' rowspan='2'>결<br>재</th>
												<th style='font-size:11px; width:69px;font-family:Dotum, Arial, Sans-serif; line-height:1.2; border-width:1px; border-left-style:solid; border-bottom-style:solid; border-color:#999999; background-color:#ececec; height:25px;text-align:center;'>담당</th>
												<th style='font-size:11px; width:69px;font-family:Dotum, Arial, Sans-serif; line-height:1.2; border-width:1px; border-left-style:solid; border-bottom-style:solid; border-color:#999999; background-color:#ececec; height:25px;text-align:center;'>대리</th>
												<th style='font-size:11px; width:69px;font-family:Dotum, Arial, Sans-serif; line-height:1.2; border-width:1px; border-left-style:solid; border-bottom-style:solid; border-color:#999999; background-color:#ececec; height:25px;text-align:center;'>과장</th>
											</tr>
											<tr>
												<td style='height:55px; font-size:11px;font-family:Dotum, Arial, Sans-serif; line-height:1.2; border-width:1px; border-left-style:solid; border-color:#999999; height:50px;'>&nbsp;</td>
												<td style='height:55px; font-size:11px;font-family:Dotum, Arial, Sans-serif; line-height:1.2; border-width:1px; border-left-style:solid; border-color:#999999; height:50px;'>&nbsp;</td>
												<td style='height:55px; font-size:11px;font-family:Dotum, Arial, Sans-serif; line-height:1.2; border-width:1px; border-left-style:solid; border-color:#999999; height:50px;'>&nbsp;</td>
											</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<div style="width:100%;padding-top:20px;">
						<table border="0" cellspacing="0" cellpadding="0" style="width:100%; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">
							<colgroup>
							<col>
							<col>
							</colgroup>
							<tbody>
								<tr>
									<td align="left">회사명 : (주)제이엔지니어링</td>
									<td align="right">작성자 : GUEST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;전표번호 : <?=$statement_dt?>-<?=$statement_ca?></td>
								</tr>
							</tbody>
						</table>
						</div>
						<table class="p_border" style="width:650px">
							<col width="85" />
							<col width="355" />
							<col width="95" />
							<col width="94" />
							<tr height="19">
								<td  rowspan="2" style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">계정명</td>
								<td  rowspan="2" style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">적요</td>
								<td  colspan="2" style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">금액</td>
							</tr>
							<tr height="19">
								<td  style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">차변</td>
								<td  style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">대변</td>
							</tr>
							<tr height="16">
								<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">외상매출금</td>
								<td  style="text-align:left;font-size:11px;line-height:16px;"><?=$account_nm?></td>
								<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;"><?=number_format($accounts_recev_price)?></td>
								<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
							</tr>
								<tr height="16">
								<td  style="text-align:left;font-size:11px;line-height:16px;"></td>
							</tr>
							<tr height="16">
								<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">제품매출</td>
								<td  style="text-align:left;font-size:11px;line-height:16px;"><?=$account_nm?></td>
								<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
								<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;"><?=number_format($total_price)?></td>
							</tr>
							<tr height="16">
								<td  style="text-align:left;font-size:11px;line-height:16px;"></td>
							</tr>
							<tr height="16">
								<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">부가세예수금</td>
								<td  style="text-align:left;font-size:11px;line-height:16px;"><?=$account_nm?></td>
								<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
								<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;"><?=number_format($total_tax)?></td>
							</tr>
							<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;"></td>
							</tr>
								<tr height="16">
								<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;"</td>
								<td  style="text-align:left;font-size:11px;line-height:16px;"></td>
								<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
								<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
							</tr>
							<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;"></td>
							</tr>
							<tr height="16">
								<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;"></td>
								<td  style="text-align:left;font-size:11px;line-height:16px;"></td>
								<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;"></td>
								<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
							</tr>
							<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;"></td></tr>
							<tr height="16">
								<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;"></td>
								<td  style="text-align:left;font-size:11px;line-height:16px;"></td>
								<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;"></td>
								<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
							</tr>
							<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;"></td>
							</tr>
							<tr height="23">
								<td  style="text-align:center;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;">합계</td>
								<td  style="text-align:left;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;">매출 : <?=$vattype_text?> / <?=$account_nm?> / <?=number_format($total_price)?> / <?=number_format($total_tax)?></td>
								<td  style="text-align:right;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;"><?=number_format($accounts_recev_price)?></td>
								<td  style="text-align:right;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;"><?=number_format($accounts_recev_price)?></td>
							</tr>
						</table>
						<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin-bottom:5px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">
							<colgroup>
							<col style="width:50%">
							<col style="50%">
							</colgroup>
							<tbody>
								<tr>
									<td align="left">[ 1 / <?=$pagecnt?> ]</td>
									<td align="right"><?=date('Y-m-d H:i:s')?></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		</div> 


		<!-- div class=absolute-->
		<div class="rpt-line" style="top:135.0mm; left:0px"></div>
		<div class="p-absolute" style="top:148.2mm; left:0px">
		<table border="0" cellpadding="0" cellspacing="0" width="650">
			<tr>
				<td valign="top">
					<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin-bottom:5px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">
						<tbody>
							<tr>
								<td style="width:99%; font-size:30px; font-weight:bold; line-height:30px; text-align:center">전표</td>
								<td align="right" style="width:1%">&nbsp;</td>
							</tr>
						</tbody>
					</table>
					<div style="width:100%;padding-top:20px;">
						<table border="0" cellspacing="0" cellpadding="0" style="width:100%; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">
							<colgroup>
								<col>
								<col>
							</colgroup>
							<tbody>
								<tr>
									<td align="left">회사명 : (주)이카운트</td>
									<td align="right">작성자 : 이현구&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;전표번호 : 2017/09/28-1</td>
								</tr>
							</tbody>
						</table>
					</div>
					<table class="p_border" style="width:650px">
						<col width="85" />
						<col width="355" />
						<col width="95" />
						<col width="94" />
						<tr height="19">
							<td  rowspan="2" style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">계정명</td>
							<td  rowspan="2" style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">적요</td>
							<td  colspan="2" style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">금액</td>
						</tr>
						<tr height="19">
							<td  style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">차변</td>
							<td  style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">대변</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">퇴직급여(판)</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">나구매</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">12,000,000</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">나구매 퇴직급여 중도정산</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">복리후생비(판)</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">이마트</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">100,000</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
						</tr>
						<tr height="16"><td  style="text-align:left;font-size:11px;line-height:16px;">간식구매</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">복리후생비(판)</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">이카식당</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">24,000</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">석식비.이현구,차영업,오영업</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">복리후생비(판)</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">한우마당</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">1,200,000</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">영업교육팀 회식비</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">보통예금</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">기업은행-1122</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">70,000</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">주정차위반 과태료 납부</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">보통예금</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">기업은행-1122</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">2,000,000</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">키워드 광고비용</td>
						</tr>
						<tr height="23">
							<td  style="text-align:center;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;">합계</td>
							<td  style="text-align:left;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;">&nbsp;</td>
							<td  style="text-align:right;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;"></td>
							<td  style="text-align:right;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;"></td>
						</tr>
					</table>
					<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin-bottom:5px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">
						<colgroup>
							<col style="width:50%">
							<col style="50%">
						</colgroup>
						<tbody>
							<tr>
								<td align="left">[ 2 / 4 ]</td>
								<td align="right">2017-10-30 09:44:40</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</table>
	</div> 


	<!-- div class=absolute-->
	</div> 
	<!-- div id=rpt_contents_new-->
	</div> 
	<!-- div class=virtualpage hidepiece-->
	<div style="page-break-before: always;">
	<!--[if IE 7]><br style="height:0; line-height:0"><![endif]-->
	</div>
	<div class="virtualpage hidepiece" printtype="page">
	<div id="rpt_contents_new">
	<div class="p-absolute" style="top:0px; left:0px">
	<table border="0" cellpadding="0" cellspacing="0" width="650">
			<tr>
				<td valign="top">
					<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin-bottom:5px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">
						<tbody>
							<tr>
								<td style="width:99%; font-size:30px; font-weight:bold; line-height:30px; text-align:center">전표</td>
								<td align="right" style="width:1%">&nbsp;</td>
							</tr>
						</tbody>
					</table>
					<div style="width:100%;padding-top:20px;">
						<table border="0" cellspacing="0" cellpadding="0" style="width:100%; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">
							<colgroup>
								<col>
								<col>
							</colgroup>
							<tbody>
								<tr>
									<td align="left">회사명 : (주)이카운트</td>
									<td align="right">작성자 : 이현구&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;전표번호 : 2017/09/28-1</td>
								</tr>
							</tbody>
						</table>
					</div>
					<table class="p_border" style="width:650px">
						<col width="85" />
						<col width="355" />
						<col width="95" />
						<col width="94" />
						<tr height="19">
							<td  rowspan="2" style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">계정명</td>
							<td  rowspan="2" style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">적요</td>
							<td  colspan="2" style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">금액</td>
						</tr>
						<tr height="19">
							<td  style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">차변</td>
							<td  style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">대변</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">퇴직급여(판)</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">나구매</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">12,000,000</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">나구매 퇴직급여 중도정산</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">복리후생비(판)</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">이마트</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">100,000</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
						</tr>
						<tr height="16"><td  style="text-align:left;font-size:11px;line-height:16px;">간식구매</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">복리후생비(판)</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">이카식당</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">24,000</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">석식비.이현구,차영업,오영업</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">복리후생비(판)</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">한우마당</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">1,200,000</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">영업교육팀 회식비</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">보통예금</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">기업은행-1122</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">70,000</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">주정차위반 과태료 납부</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">보통예금</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">기업은행-1122</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">2,000,000</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">키워드 광고비용</td>
						</tr>
						<tr height="23">
							<td  style="text-align:center;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;">합계</td>
							<td  style="text-align:left;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;">&nbsp;</td>
							<td  style="text-align:right;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;"></td>
							<td  style="text-align:right;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;"></td>
						</tr>
					</table>
					<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin-bottom:5px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">
						<colgroup>
							<col style="width:50%">
							<col style="50%">
						</colgroup>
						<tbody>
							<tr>
								<td align="left">[ 3 / 4 ]</td>
								<td align="right">2017-10-30 09:44:40</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</table>
	</div> 

	<!-- div class=absolute-->
	<div class="rpt-line" style="top:135.0mm; left:0px"></div>
	<div class="p-absolute" style="top:148.2mm; left:0px">
	<table border="0" cellpadding="0" cellspacing="0" width="650">
			<tr>
				<td valign="top">
					<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin-bottom:5px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">
						<tbody>
							<tr>
								<td style="width:99%; font-size:30px; font-weight:bold; line-height:30px; text-align:center">전표</td>
								<td align="right" style="width:1%">&nbsp;</td>
							</tr>
						</tbody>
					</table>
					<div style="width:100%;padding-top:20px;">
						<table border="0" cellspacing="0" cellpadding="0" style="width:100%; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">
							<colgroup>
								<col>
								<col>
							</colgroup>
							<tbody>
								<tr>
									<td align="left">회사명 : (주)이카운트</td>
									<td align="right">작성자 : 이현구&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;전표번호 : 2017/09/28-1</td>
								</tr>
							</tbody>
						</table>
					</div>
					<table class="p_border" style="width:650px">
						<col width="85" />
						<col width="355" />
						<col width="95" />
						<col width="94" />
						<tr height="19">
							<td  rowspan="2" style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">계정명</td>
							<td  rowspan="2" style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">적요</td>
							<td  colspan="2" style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">금액</td>
						</tr>
						<tr height="19">
							<td  style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">차변</td>
							<td  style="color:#036;text-align:center;font-size:12px;line-height:19px;background-color:#ebf1f5;">대변</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">퇴직급여(판)</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">나구매</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">12,000,000</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">나구매 퇴직급여 중도정산</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">복리후생비(판)</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">이마트</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">100,000</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
						</tr>
						<tr height="16"><td  style="text-align:left;font-size:11px;line-height:16px;">간식구매</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">복리후생비(판)</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">이카식당</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">24,000</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">석식비.이현구,차영업,오영업</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">복리후생비(판)</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">한우마당</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">1,200,000</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">영업교육팀 회식비</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">보통예금</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">기업은행-1122</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">70,000</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">주정차위반 과태료 납부</td>
						</tr>
						<tr height="16">
							<td  rowspan="2" style="text-align:left;font-size:11px;line-height:16px;">보통예금</td>
							<td  style="text-align:left;font-size:11px;line-height:16px;">기업은행-1122</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">&nbsp;</td>
							<td  rowspan="2" style="text-align:right;font-size:11px;line-height:16px;">2,000,000</td>
						</tr>
						<tr height="16">
							<td  style="text-align:left;font-size:11px;line-height:16px;">키워드 광고비용</td>
						</tr>
						<tr height="23">
							<td  style="text-align:center;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;">합계</td>
							<td  style="text-align:left;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;">&nbsp;</td>
							<td  style="text-align:right;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;">20,218,000</td>
							<td  style="text-align:right;font-size:11px;line-height:23px;font-weight:bold;background-color:#f7f7f7;">20,218,000</td>
						</tr>
					</table>
					<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin-bottom:5px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">
						<colgroup>
							<col style="width:50%">
							<col style="50%">
						</colgroup>
						<tbody>
							<tr>
								<td align="left">[ 2 / 4 ]</td>
								<td align="right">2017-10-30 09:44:40</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</table>
	</div> 
	<!-- div class=absolute-->
	</div> 
	<!-- div id=rpt_contents_new-->
	</div> 
	<!-- div class=virtualpage hidepiece-->
</div>
</form>
</div><!-- //idPrint -->
</center>

</div>
</div>
</div>  <!-- wrap -->

</body>
</html>
<script type="text/javascript" language="javascript" >
    // 페이징 설정 부분
    var pagecontent = new virtualpaginate({
        piececlass: "virtualpage", //class of container for each piece of content
        piececontainer: "div", //container element type (ie: "div", "p" etc)
        pieces_per_page: 1, //Pieces of content to show per page (1=1 piece, 2=2 pieces etc)
        defaultpage: 0, //Default page selected (0=1st page, 1=2nd page etc). Persistence if enabled overrides this setting.
        wraparound: false,
        persist: false //Remember last viewed page and recall it when user returns within a browser session?
    })

    pagecontent.buildpagination(["scriptspaginate"]);

</script>
