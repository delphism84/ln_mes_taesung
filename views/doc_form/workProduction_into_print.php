<?
//완제품 바코드 출력
session_start();

require_once('../../connection.php');
require_once('../../library/json.php');
require_once('../../library/function.php');

extract($_POST);
extract($_GET);
?>

<?
//	if ($mode=="modify"){
	$sql = "Select * From erp_production_into where uid = ".$uid;
	//echo $sql."<br>"; 
	$t = mysql_fetch_object(mysql_query($sql));
	$ct=1;
	$sql = "Select * From erp_account where account_cd = '".$t->account_cd."'";
	//echo $sql."<br>"; 
	//$result = mysql_query($sql);
	$t2 = mysql_fetch_object(mysql_query($sql));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>완제품 바코드 출력</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="robots" content="noindex,nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<script type="text/javascript" src="/weberp/js/jquery.js"></script>
<script type="text/javascript">
<!--
			var initBody;
		function beforePrint()
		{ 
		   initBody = document.body.innerHTML; 
		   document.body.innerHTML = print_page.innerHTML;
		} 

		function afterPrint()
		{ 
		  document.body.innerHTML = initBody; 
		} 

		function pageprint()
		{
			 window.onbeforeprint = beforePrint; 
			 window.onafterprint = afterPrint; 
			 window.print(); 
		}

		//엑셀변환
        function ExcelPageMovement(Url) {
            
                $("#frmDetail").get(0).method = "post";
                $("#frmDetail").get(0).action = fnSetUrlPath(Url, "ec_req_sid");
                $("#frmDetail").get(0).target = "ifrmExcel";
                $("#frmDetail").submit();
               
        }

//-->
</script>
</head>
<body>
	<form method="post" action="./ESJ005R.aspx?ec_req_sid=00J*3lcNlKUs" id="form1">
    <input type="hidden" id="hidHeightParam" name="hidHeightParam"  /> <!--종이 인쇄시 호환성일경우 Page Break시 hidHeightParam 지정된 높이를 사용함 -->      
	<div id="wrap_pop">
        <!-- 상단버튼 및 양식설정부분 시작 --> 
        <div class="dual-btn-fixed top-zero">
		    <div class="dual-btn-area">
			    <div class="float_left">
                   <span class="btn blue-inverse"><input type="button" name="btnPrint" id="btnPrint" onclick="pageprint();"  value="인쇄" /></span>
						<!-- <span class="btn gray"><input type="button" name="btn_excel" id="btn_excel" onclick="ExcelPageMovement('/ECMain/ESD/ESD002E.php');" value="Excel" /></span>           
						<span class="btn gray"><input type="button" name="btnPdf" id="btnPdf" value="PDF" onclick="fnPdfBeta();" /></span> -->
                </div>
            </div><!-- 인쇄옵션 끝 -->
        </div>
        <!-- 인쇄옵션 끝 -->
        <center>
        <div id='print_page'>
			<link type='text/css' rel='stylesheet'href='/assets/css/2_layout.css?v=20160126090841' /><span></span>
			<link type='text/css' rel='stylesheet'href='/assets/css/2_print.css?v=20150807092751' /><span></span>
			<div id="idPrint" class="p-relative" style="margin-top:30px">
				<div class="virtualpage hidepiece" printtype="page">
					<div id="rpt_contents_new">
						<div class="p-absolute" style="top:0px; left:0px"> 
						<!-- 결재방 -->
						<TABLE style="WIDTH: 650px; BORDER-COLLAPSE: collapse; MARGIN-BOTTOM: 5px; COLOR: #000; FONT-SIZE: 12px" border=0 cellSpacing=0 cellPadding=0>
						<TBODY>
							<TR>
							<TD style="TEXT-ALIGN: center; WIDTH: 99%; HEIGHT: 30px; FONT-SIZE: 20px; FONT-WEIGHT: bold"><U>입 고 전 표</U></TD>
							<TD style="WIDTH: 1%" align=right><table cellpadding='0' cellspacing='0' border='0' style='width:295px; margin:0px 0px 5px 0px; color:#000; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed'><tbody><tr><th style='font-size:12px; width:13px;padding:0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word' rowspan='2'>담당</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>부장</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>이사</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>상무</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>대표이사</th></tr><tr><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td></tr></tbody></table>
							</TD>
							</TR>
						</TBODY>
						</TABLE>    </td>   </tr>  </tbody>  </table>    <table border="0" cellspacing="0" cellpadding="0" style="padding:0px; width:650px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse; table-layout:fixed">   <colgroup><col style="width:75px"><col style="width:245px"><col style="width:10px"><col style="width:75px"><col /></colgroup>   <tbody>    <tr>     <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">전표번호</th>     <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;<?=$t->p_into_cd?> &nbsp;</td>     <td>&nbsp;</td>      <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">입고창고</th>     <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;<?=$t->warehouse_nm?></td>    </tr>    <tr>     <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; font-weight:bold">DATE</th>     <td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$t->warehousing_dt?></td>     <td>&nbsp;</td>     <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000">구매처</th>     <td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$t->account_nm?></td>    </tr>   </tbody>  </table>
                    
						<!-- TopSql 끝 -->
	        
                    <!-- 구매리스트 시작 -->
                    <table class="p_rptC" style="width:650px;table-layout:fixed;word-break:break-all; word-wrap: break-word;">
                        
                            <col width="44" />
                      
                            <col width="275" />
                      
                            <col width="74" />
                      
                            <col width="100" />
                      
                            <col width="100" />
                      
                        <thead>
                        <tr>
                        
                                <th style="height:22px">월/일</th>
                        
                                <th style="height:22px">품명 및 규격</th>
                        
                                <th style="height:22px">수량(중량)</th>

								<th style="height:22px">단가</th>

								<th style="height:22px">공급가액</th>
                        
                                <th style="height:22px">부가세</th>
                        
                        </tr>
                        </thead>
                        <tbody>
						<?
					$sql = "Select * From erp_production_into_item where fid = '".$t->uid."'";
					//echo $sql."<br>";  
					$result = mysql_query($sql);
					$cnt = mysql_num_rows($result);
					if ($result){
						if ($cnt>"0"){
							$ct=1;
							$totalunit=0;
							while($t1 = mysql_fetch_object($result)) {
								
								/*
								$qty		=$rows["qty"];
								*/			
								$totalunit = $totalunit + $t1->cnt;
								//$totalunit = $qty++;
							?>	
					<TR height=19>
					<TD style="OVERFLOW: hidden" class=" left font11px"><?=substr($t1->p_into_cd,5,5)?></TD>
					<TD style="OVERFLOW: hidden" class=" left font11px"><?=$t1->item_nm?>&nbsp;<?=$t1->standard1?></TD>
					<TD style="OVERFLOW: hidden" class=" right font11px"><?=number_format($t1->cnt)?><?=$t1->unit?></TD>
					<TD style="OVERFLOW: hidden" class=" right font11px"><?=number_format($t1->unit_price)?></TD>
					<TD style="OVERFLOW: hidden" class=" right font11px"><?=number_format($t1->supply_price)?></TD>
					<TD style="OVERFLOW: hidden" class=" right font11px"><?=number_format($t1->tax)?></TD></TR>
					<?
								$ct++;
								}
							}
							?>
							<? 
							$limitcnt = 12 - $cnt;
							for($i=1;$i<$limitcnt;$i++){?>
					<TR height=19>
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
					</TR>
					<?}?>
						<?}?>
					</tbody>
					</table>
                    <!-- 구매리스트 끝 -->
                
                    
                     <div style="margin-top:5px;"></div>
                     <table style="margin: 0px; width: 650px; height: 27px; color: rgb(0, 0, 0); line-height: 14px; font-size: 12px; border-top-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-top-width: 1px; border-left-width: 1px; border-top-style: solid; border-left-style: solid; border-collapse: collapse; table-layout: fixed;" border="0" cellSpacing="0" cellPadding="0">
					 <colgroup>
					 <col style="width: 65px;">
					 <col style="width: 55px;">
					 <col style="width: 65px;">
					 <col style="width: 75px;">
					 <col style="width: 35px;">
					 <col style="width: 75px;">
					 <col style="width: 35px;">
					 <col style="width: 75px;">
					 <col style="width: 35px;">
					 <col style="width: 75px;">
					 <col>
					 </colgroup>
					 <tbody>
					 <tr>
					 <td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">수량(중량)</td>
					 <td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;"><?=number_format($t->cntTotal)?>&nbsp;</td>
					 <td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">공급가액</td>
					 <td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;"><?=number_format($t->supplyPriceTotal)?>&nbsp;</td>
					 <td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">VAT</td>
					 <td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;"><?=number_format($t->taxTotal)?>&nbsp;</td>
					 <td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">합계</td>
					 <td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;"><?=number_format($t->priceTotal)?>&nbsp;</td>
					 <td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">인수</td>
					 <td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">인&nbsp;</td>
					 </tr>
					 </tbody>
					 </table>
              </div> <!-- div class=absolute-->
              <div class="rpt-line" style="top:135.5mm; left:0px"></div>
              <div class="p-absolute" style="top:145.3mm; left:0px"> 
                    <!-- 결재방 -->
                    <TABLE style="WIDTH: 650px; BORDER-COLLAPSE: collapse; MARGIN-BOTTOM: 5px; COLOR: #000; FONT-SIZE: 12px" border=0 cellSpacing=0 cellPadding=0>
						<TBODY>
							<TR>
							<TD style="TEXT-ALIGN: center; WIDTH: 99%; HEIGHT: 30px; FONT-SIZE: 20px; FONT-WEIGHT: bold"><U>입 고 전 표</U></TD>
							<TD style="WIDTH: 1%" align=right><table cellpadding='0' cellspacing='0' border='0' style='width:295px; margin:0px 0px 5px 0px; color:#000; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed'><tbody><tr><th style='font-size:12px; width:13px;padding:0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word' rowspan='2'>담당</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>부장</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>이사</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>상무</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>대표이사</th></tr><tr><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td></tr></tbody></table>
							</TD>
							</TR>
						</TBODY>
						</TABLE>    </td>   </tr>  </tbody>  </table>    <table border="0" cellspacing="0" cellpadding="0" style="padding:0px; width:650px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse; table-layout:fixed">   <colgroup><col style="width:75px"><col style="width:245px"><col style="width:10px"><col style="width:75px"><col /></colgroup>   <tbody>    <tr>     <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">전표번호</th>     <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;<?=$t->p_into_cd?> &nbsp;</td>     <td>&nbsp;</td>      <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">입고창고</th>     <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;<?=$t->warehouse_nm?></td>    </tr>    <tr>     <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; font-weight:bold">DATE</th>     <td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$t->warehousing_dt?></td>     <td>&nbsp;</td>     <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000">구매처</th>     <td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$t->account_nm?></td>    </tr>   </tbody>  </table>
                    
                    <!-- TopSql 끝 -->
        
                    <!-- 구매리스트 시작 -->
                    <table class="p_rptC" style="width:650px;table-layout:fixed;word-break:break-all; word-wrap: break-word;">
                        
                            <col width="44" />
                      
                            <col width="275" />
                      
                            <col width="74" />
                      
                            <col width="100" />
                      
                            <col width="100" />
                      
                        <thead>
                        <tr>
                        
                                <th style="height:22px">월/일</th>
                        
                                <th style="height:22px">품명 및 규격</th>
                        
                                <th style="height:22px">수량(중량)</th>

								<th style="height:22px">단가</th>

								<th style="height:22px">공급가액</th>
                        
                                <th style="height:22px">부가세</th>
                        
                        </tr>
                        </thead>
                        <tbody>
						<?
					$sql = "Select * From erp_production_into_item where fid = '".$t->uid."'";
					//echo $sql."<br>";  
					$result = mysql_query($sql);
					$cnt = mysql_num_rows($result);
					if ($result){
						if ($cnt>"0"){
							$ct=1;
							$totalunit=0;
							while($t1 = mysql_fetch_object($result)) {
								
								/*
								$qty		=$rows["qty"];
								*/			
								$totalunit = $totalunit + $t1->cnt;
								//$totalunit = $qty++;
							?>	
					<TR height=19>
					<TD style="OVERFLOW: hidden" class=" left font11px"><?=substr($t1->p_into_cd,5,5)?></TD>
					<TD style="OVERFLOW: hidden" class=" left font11px"><?=$t1->item_nm?>&nbsp;<?=$t1->standard1?></TD>
					<TD style="OVERFLOW: hidden" class=" right font11px"><?=number_format($t1->cnt)?><?=$t1->unit?></TD>
					<TD style="OVERFLOW: hidden" class=" right font11px"><?=number_format($t1->unit_price)?></TD>
					<TD style="OVERFLOW: hidden" class=" right font11px"><?=number_format($t1->supply_price)?></TD>
					<TD style="OVERFLOW: hidden" class=" right font11px"><?=number_format($t1->tax)?></TD></TR>
					<?
							$ct++;
							}
						}
						?>
						<? 
						$limitcnt = 12 - $cnt;
						for($i=1;$i<$limitcnt;$i++){?>
					<TR height=19>
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
					</TR>
					<?}?>
						<?}?>
					</tbody>
					</table>
                    <!-- 구매리스트 끝 -->
                    
                     <div style="margin-top:5px;"></div>
                     <table style="margin: 0px; width: 650px; height: 27px; color: rgb(0, 0, 0); line-height: 14px; font-size: 12px; border-top-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-top-width: 1px; border-left-width: 1px; border-top-style: solid; border-left-style: solid; border-collapse: collapse; table-layout: fixed;" border="0" cellSpacing="0" cellPadding="0">
					 <colgroup>
					 <col style="width: 65px;">
					 <col style="width: 55px;">
					 <col style="width: 65px;">
					 <col style="width: 75px;">
					 <col style="width: 35px;">
					 <col style="width: 75px;">
					 <col style="width: 35px;">
					 <col style="width: 75px;">
					 <col style="width: 35px;">
					 <col style="width: 75px;">
					 <col>
					 </colgroup>
					 <tbody>
					 <tr>
					 <td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">수량(중량)</td>
					 <td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;"><?=number_format($t->cntTotal)?>&nbsp;</td>
					 <td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">공급가액</td>
					 <td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;"><?=number_format($t->supplyPriceTotal)?>&nbsp;</td>
					 <td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">VAT</td>
					 <td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;"><?=number_format($t->taxTotal)?>&nbsp;</td>
					 <td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">합계</td>
					 <td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;"><?=number_format($t->priceTotal)?>&nbsp;</td>
					 <td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">인수</td>
					 <td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">인&nbsp;</td>
					 </tr>
					 </tbody>
					 </table>
					<P><br></P>	
                    </div> <!-- div class=absolute-->
					
            </center>
			
		</div>
    </div>
	</div>
	</form>

    <form id="frmDetail">
        <input name="hidSearchXml" type="hidden" id="hidSearchXml" value="20160806-1-0" />
        <input type="hidden" name="formser" id="formser" value="1" />
        <input type="hidden" name="basicFormser" id="basicFormser" value="0" />
        <input name="level" type="hidden" id="level" value="&lt;%=strLevelGubun %>" />
        <input name="cust" type="hidden" id="cust" />
        <input name="cust_des" type="hidden" id="cust_des" />
        <input name="amount" type="hidden" id="amount" />
        <input name="amount_des" type="hidden" id="amount_des" />
        <input type="hidden" name="foreign_flag" id="foreign_flag" value="0" />
        <input type="hidden" name="basic_type" id="basic_type" value="" />
        <input type="hidden" name="edms_flag" id="edms_flag" value="N" />
    </form>
    <iframe name="ifrmExcel" style="width:0px; height:0px"></iframe>
    <script language="javascript" type="text/javascript">
        // ----------------------------------------------------------------------------------
        // 1. 전역변수 선언 영역
        // ----------------------------------------------------------------------------------
        // ----------------------------------------------------------------------------------
        // 2. 초기 실행 함수 영역
        // ----------------------------------------------------------------------------------
        
        document.getElementById('rpt_contents_new').style.width = "650px";


    </script>
</body>
<style type="text/css"> @page{size:A4;margin-top:13mm;margin-left:4.2mm;margin-right:4.6mm;margin-bottom:5.3mm;}@media print{html,body{min-width:201.2mm;overflow:hidden;}thead {display: table-header-group;}}</style>
</html>






<STYLE type=text/css> @page{size:A4;margin-top:13mm;margin-left:19.3mm;margin-right:4.6mm;margin-bottom:5.3mm;}@media print{html,body{min-width:186.1mm;overflow:hidden;}thead {display: table-header-group;}}</STYLE>

<STYLE type=text/css>@page  {size: A4; margin-top: 13mm; margin-left: 19.3mm; margin-right: 4.6mm; margin-bottom: 5.3mm; }

@media Print    
{
HTML {
	MIN-WIDTH: 186.1mm; OVERFLOW: hidden
}
BODY {
	MIN-WIDTH: 186.1mm; OVERFLOW: hidden
}
THEAD {
	DISPLAY: table-header-group
}

}
</STYLE>
</BODY></HTML>