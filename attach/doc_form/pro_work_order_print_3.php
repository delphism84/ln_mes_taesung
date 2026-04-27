<?php
include_once("../common.php"); // 기본 파일
include_once("../inc/dbconfig.php"); 
include_once("../inc/func.php");  // 함수 파일
//header("Content-type: text/html; charset=UTF-8"); 
if (!$is_member){
goto_url("/login.php");
exit;
}
?>
<?
//	if ($mode=="modify"){
	$sql = "Select * From work_orders where num = ".$num;
	//echo $sql."<br>"; 
	$result = mysql_query($sql);
	if ($result){
		//$cnt = mysql_num_rows($result);
		$ct=1;
		$row = mysql_fetch_array($result);	
			$num			=$row["num"];
			$ord_no			=$row["ord_no"];
			$ord_cd			=$row["ord_cd"];
			$basic_date		=$row["basic_date"];
			$rel_no			=$row["rel_no"];
			$rel_cd			=$row["rel_cd"];
			$cust_name		=$row["cust_name"];
			$cust_cd		=$row["cust_cd"];
			$emp_cd			=$row["emp_cd"];
			$emp_name		=$row["emp_name"];
			$wh_name		=$row["wh_name"];
			$wh_cd			=$row["wh_cd"];
			$pjt_name		=$row["pjt_name"];
			$pjt_cd			=$row["pjt_cd"];
			$DeliveryDateTime=$row["DeliveryDateTime"];
			$p_des			=$row["p_des"];
			$processes		=$row["processes"];
			$writer			=$row["writer"];
			$address1		=$row["address1"];
			$state_yn		=$row["state_yn"];
			$mem_sn			=$row["mem_sn"];
			$regdate		=$row["regdate"];
		}

   
//	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>작업지시서 출력</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="robots" content="noindex,nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />

<link type='text/css' rel='stylesheet'href='http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_layout.css?v=20160126090841' /><span></span>
<link type='text/css' rel='stylesheet'href='http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_print.css?v=20150807092751' /><span></span>
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
                   <span class="btn blue-inverse"><input type="button" name="btnPrint" id="btnPrint" onclick="this.parentElement.style.display = 'none'; pageprint(); this.parentElement.style.display = ''; "  value="인쇄" /></span>
						<!--span class="btn gray"><input type="button" name="btn_excel" id="btn_excel" onclick="ExcelPageMovement('/ECMain/ESD/ESD002E.php');" value="Excel" /></span-->           
						<!--span class="btn gray"><input type="button" name="btnPdf" id="btnPdf" value="PDF" onclick="fnPdfBeta();" /></span-->
                </div>
            </div><!-- 인쇄옵션 끝 -->
        </div>
        <!-- 인쇄옵션 끝 -->
        <center>
        <div id='print_page'>
			<div id="idPrint" class="p-relative" style="margin-top:80px">
				<!--div class="virtualpage hidepiece" printtype="page"!-->
					<!--div id="rpt_contents_new"-->
						<!--div class="p-absolute" style="top:0px; left:0px"--> 
							<!-- 결재방 -->
							<table border="0" cellspacing="0" cellpadding="0" style="width:650px; margin-bottom:5px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">  <tbody>   <tr>    <td style="width:99%; height:30px; font-size:20px; font-weight:bold; line-height:20px; text-align:center"><u>작 업 지 시 서 전 표</u></td>    <td align="right" style="width:1%">     <table cellpadding='0' cellspacing='0' border='0' style='width:295px; margin:0px 0px 5px 0px; color:#000; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed'><tbody><tr><th style='font-size:12px; width:13px;padding:0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word' rowspan='2'>결재</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>결재</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>라인</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>설정</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>가능</th></tr><tr><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td></tr></tbody></table>    </td>   </tr>  </tbody>  </table>    <div style="width:650px;">   <table border="0" cellspacing="0" cellpadding="0" style="padding:0px; width:650px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse; table-layout:fixed">    <colgroup><col style="width:75px"><col style="width:220px"><col style="width:10px"><col style="width:75px"><col /></colgroup>    <tbody>     <tr>      <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">전표번호</th>      <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;<?=$ord_no?></td>      <td>&nbsp;</td>      <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">납품처</th>      <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;<?=$cust_name?></td>     </tr>          <tr>      <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; font-weight:bold">담당자</th>      <td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$emp_name?></td>      <td>&nbsp;</td>                  <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000">납기일</th>      <td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$DeliveryDateTime?></td>     </tr>    </tbody>   </table>  </div>  
							
							<!-- TopSql 끝 -->
							
							<!--  리스트 시작 -->
							<table class="p_rptC" style="width:650px;">
									<col width="98" />
									<col width="255" />
									<col width="151" />
									<col width="60" />
									<col width="60" />
								<thead>
								<tr>
									<th  style="height:37px">품목코드</th>
									<th  style="height:37px">품명 및 규격</th>
									<th  style="height:37px">생산공장명</th>
									<th  style="height:37px">수량</th>
									<th  style="height:37px">안전재고</th>
								</tr>                
								</thead>
								<tbody>
								<?
									$sql = "Select * From work_ordersSub where ord_no = '".$ord_no."'";
									//echo $sql."<br>";  
									$result = mysql_query($sql);
									$cnt = mysql_num_rows($result);
									if ($result){
										if ($cnt>"0"){
											$ct=1;
											while($rows=mysql_fetch_array($result)) {
												$idx		=$rows["idx"];
												$rel_no		=$rows["rel_no"];
												$prod_cd	=$rows["prod_cd"];
												$prod_des	=$rows["prod_des"];
												$size_des	=$rows["size_des"];
												$uqty		=$rows["uqty"];
												$qty		=$rows["qty"];
												$unit		=$rows["unit"];
												$price		=$rows["price"];
												$supply_amt	=$rows["supply_amt"];
												$vat_amt	=$rows["vat_amt"];
												$remarks	=$rows["remarks"];
												$item_des	=$rows["item_des"];
												$sub_prod	=$rows["sub_prod"];
												$regdate	=$rows["regdate"];
										
							?>	
									<tr height=23><td class=' left font11px' bgcolor="#FFFFFF" style="   overflow:hidden "><?=$prod_cd?></td><td class=' left font11px' bgcolor="#FFFFFF" style="   overflow:hidden "><?=$prod_des?></td><td class=' left font11px' bgcolor="#FFFFFF" style="   overflow:hidden "></td><td class=' right font11px' bgcolor="#FFFFFF" style="   overflow:hidden "><?=$qty?></td><td class=' right font11px' bgcolor="#FFFFFF" style="   overflow:hidden ">0</td></tr>
								<? }
								  }
								  }
								  ?>
								</tbody>
							</table>
							<!--  리스트 끝 -->
							
							<!--  BOM(소요량) 리스트 시작 -->
							<table class="p_rptC" style="width:650px;">
								<col width="59" />
								<col width="193" />
								<col width="60" />
								<col width="65" />
								<col width="125" />
								<col width="117" />
								<thead>
								<tr>
									<th  style="height:37px">품목코드</th>								
									<th  style="height:37px">품명 및 규격</th>								
									<th  style="height:37px">소요량</th>								
									<th  style="height:37px">재고수량</th>								
									<th  style="height:37px">구매처</th>								
									<th  style="height:37px">적요</th>											
								</tr>                    
								</thead>
								<tbody>
									
									<?
									$sql = "Select * From work_ordersSub where ord_no = '".$ord_no."'";
									//echo $sql."<br>";  
									$result = mysql_query($sql);
									$cnt = mysql_num_rows($result);
									if ($result){
										if ($cnt>"0"){
											$ct=1;
											while($row_sub=mysql_fetch_array($result)) {
												$idx		=$row_sub["idx"];
												$ord_no		=$row_sub["ord_no"];
												$rel_no		=$row_sub["rel_no"];
												$prod_cd	=$row_sub["prod_cd"];
												$prod_des	=$row_sub["prod_des"];
												$size_des	=$row_sub["size_des"];
												$qty		=$row_sub["qty"];
												$prod_qty   =$row_sub["prod_qty"];
												$price		=$row_sub["price"];
												$res_qty	=$row_sub["res_qty"];
												$unit	    =$row_sub["unit"];
												$remarks	=$row_sub["remarks"];
												$bom_depth1	=$row_sub["bom_depth1"];
												$regdate	=$row_sub["regdate"];
									
														$sqls = "Select * From product as a left join bom_category as b on a.itemcd = b.prod_cd where b.depth1 = (Select depth1 From bom_category where prod_cd = '".$prod_cd."')";
														//echo $sqls."<br>";  
														$results = mysql_query($sqls);
														$cnts = mysql_num_rows($results);
														if ($results){
															if ($cnts>"0"){
																$cts=1;
																while($rows=mysql_fetch_array($results)) {
																	$idx		=$rows["idx"];
																	$rel_no		=$rows["rel_no"];
																	$prod_cd	=$rows["prod_cd"];
																	$prod_des	=$rows["prod_des"];
																	$size_des	=$rows["size_des"];
																	$uqty		=$rows["uqty"];
																	$qty		=$rows["qty"];
																	$unit		=$rows["unit"];
																	$price		=$rows["price"];
																	$Quantity	=$rows["Quantity"];
																	$stock_amount	=$rows["stock_amount"];
																	$custom_name	=$rows["custom_name"];
																	$p_company	=$rows["p_company"];
																	$sub_prod	=$rows["sub_prod"];
																	$regdate	=$rows["regdate"];
															?>
									<tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "><?=$prod_cd?></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "><?=$prod_des?></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "><?=$Quantity?></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "><?=$stock_amount?></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "><?=$p_company?></td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr>
															<?
															}
														}
													  }
											?>
									<?	}
										}
										}
									?>
									<tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr>
								</tbody>
							</table>
							<!--  소요 리스트 끝 -->
							<table width="300px" border="0" cellspacing="0" cellpadding="0"><tr><td  style="height:5px;"></td></tr></table>    
							<br><br>
							 <!-- for문 끝 -->
							<table summary="" class="listgray"  align="center"  style="width:650px" id="tblPFile">
							<col width="130" /><col width="" />
							  <!-- for (int u = 0; u < dtLinkData.Rows.Count;u++) end -->
							</table>
							  <!-- if (iloop_cnt == 1) end -->
							<!-- for문 끝 -->
						<!--/div-->
					<!--/div-->
					 
				<!--/div--><!-- div idPrint end -->
			</div> 
		</div>
		</center>
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
