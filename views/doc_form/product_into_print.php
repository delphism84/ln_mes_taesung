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
	$sql = "Select * From product_in where num = ".$num;
	//echo "sql1=".$sql."<br>"; 
	$result = mysql_query($sql);
	if ($result){
		//$cnt = mysql_num_rows($result);
		$ct=1;
		$row = mysql_fetch_array($result);	
			$num			=$row["num"];
			$prodin_no		=$row["prodin_no"];
			$basic_date		=$row["basic_date"];
			$ord_no			=$row["ord_no"];
			$ord_cd			=$row["ord_cd"];
			$cust_name		=$row["cust_name"];
			$cust_cd		=$row["cust_cd"];
			$emp_cd			=$row["emp_cd"];
			$emp_name		=$row["emp_name"];
			$outplant_des	=$row["outplant_des"];
			$outplant		=$row["outplant"];
			$inplant_des	=$row["inplant_des"];
			$inplant		=$row["inplant"];
			$regdate		=$row["regdate"];
		}

	$sql = "Select * From product_inSub where prodin_no = '".$prodin_no."'";
		//echo $sql."<br>";  
		$result = mysql_query($sql);
		if ($result){
			$no=1;
			while($rows=mysql_fetch_array($result)){
				$idx			=$rows["idx"];									
				$prodin_no		=$rows["prodin_no"];
				$plan_date		=$rows["plan_date"];
				$plan_no		=$rows["plan_no"];
				$plan_prod		=$rows["plan_prod"];
				$prod_cd		=$rows["prod_cd"];
				$prod_des		=$rows["prod_des"];
				$size_des		=$rows["size_des"];
				$qty			=$rows["qty"];
				$inv_qty		=$rows["inv_qty"];
				$res_qty		=$rows["res_qty"];
				$unit			=$rows["unit"];
				$price			=$rows["price"];
				$supply_amt		=$rows["supply_amt"];
				$vat_amt		=$rows["vat_amt"];
				$oth_num		=$rows["oth_num"];				
				$remarks		=$rows["remarks"];
				$regdate		=$rows["regdate"];
			
				$html_table .="<TR height=20>";
				$html_table .="<TD style=\"OVERFLOW: hidden\" class=\" center font11px\">".$no."</TD>";
				$html_table .="<TD style=\"OVERFLOW: hidden\" class=\" left font11px\">".$prod_cd."</TD>";
				$html_table .="<TD style=\"OVERFLOW: hidden\" class=\" left font11px\">".$prod_des." ".$size_des."</TD>";
				$html_table .="<TD style=\"OVERFLOW: hidden\" class=\" right font11px\">".$qty."</TD>";
				$html_table .="<TD style=\"OVERFLOW: hidden\" class=\" left font11px\">".$remarks."</TD></TR>";
				$qtys[] .= $qty; 
			$no++;	
		}	//echo $qtys;
			//$tot_qty = array_sum($qtys);
	}

	/*
		if ($ord_no !=""){  //생산입고 방식 2번재 소요량까지 같이 입력시 나오도록 조정 하기 위한 카운터
			$ord_no_arr = explode("^",$ord_no);
			for ($i=0; $i< count($ord_no_arr)-1; $i++){
			//	if ($mode=="modify"){
			$sql = "Select * From item_issue where ord_no_arr = ".$ord_no_arr[$i];
			//echo "sql1=".$sql."<br>"; 
			$result = mysql_query($sql);
			if ($result){
				//$cnt = mysql_num_rows($result);
				$ct=1;
				$row_date = mysql_fetch_array($result);	
					$num			=$row_date["num"];
					$issue_no		=$row_date["issue_no"];
					$basic_date		=$row_date["basic_date"];
					$ord_no			=$row_date["ord_no"];
					$ord_cd			=$row_date["ord_cd"];
					$cust_name		=$row_date["cust_name"];
					$cust_cd		=$row_date["cust_cd"];
					$emp_cd			=$row_date["emp_cd"];
					$emp_name		=$row_date["emp_name"];
					$outplant_des	=$row_date["outplant_des"];
					$outplant		=$row_date["outplant"];
					$inplant_des	=$row_date["inplant_des"];
					$inplant		=$row_date["inplant"];
					$regdate		=$row_date["regdate"];
				}

			$sql = "Select * From item_issueSub where issue_no = '".$issue_no."'";
				//echo $sql."<br>";  
				$result = mysql_query($sql);
				if ($result){
					$no=1;
					while($row_date1=mysql_fetch_array($result)){
						$idx			=$row_date1["idx"];									
						$issue_no		=$row_date1["issue_no"];
						$plan_date		=$row_date1["plan_date"];
						$plan_no		=$row_date1["plan_no"];
						$plan_prod		=$row_date1["plan_prod"];
						$prod_cd		=$row_date1["prod_cd"];
						$prod_des		=$row_date1["prod_des"];
						$size_des		=$row_date1["size_des"];
						$qty			=$row_date1["qty"];
						$inv_qty		=$row_date1["inv_qty"];
						$res_qty		=$row_date1["res_qty"];
						$unit			=$row_date1["unit"];
						$Process_route	=$row_date1["Process_route"];
						$remarks		=$row_date1["remarks"];
						$bom_depth1		=$row_date1["bom_depth1"];
						$regdate		=$row_date1["regdate"];
					
						$html_table1 .="<TR height=20>";
						$html_table1 .="<TD style=\"OVERFLOW: hidden\" class=\" center font11px\">".$no."</TD>";
						$html_table1 .="<TD style=\"OVERFLOW: hidden\" class=\" left font11px\">".$prod_cd."</TD>";
						$html_table1 .="<TD style=\"OVERFLOW: hidden\" class=\" left font11px\">".$prod_des." ".$size_des."</TD>";
						$html_table1 .="<TD style=\"OVERFLOW: hidden\" class=\" right font11px\">".$qty."</TD>";
						$html_table1 .="<TD style=\"OVERFLOW: hidden\" class=\" left font11px\">".$remarks."</TD></TR>";
						$qtys2[] .= $qty; 
					$no++;	
				}	echo $qtys2;
					//$tot_qty = array_sum($qtys);
			}
			}
		}
		*/
//	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>생산입고전표</title>
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
                   <span class="btn blue-inverse"><input type="button" name="btnPrint" id="btnPrint" onclick="$('.dual-btn-fixed').hide(); pageprint(); $('.dual-btn-fixed').show(); "  value="인쇄" /></span>
						<!--span class="btn gray"><input type="button" name="btn_excel" id="btn_excel" onclick="ExcelPageMovement('/ECMain/ESD/ESD002E.php');" value="Excel" /></span-->           
						<!--span class="btn gray"><input type="button" name="btnPdf" id="btnPdf" value="PDF" onclick="fnPdfBeta();" /></span-->
                </div>
            </div><!-- 인쇄옵션 끝 -->
        </div>
        <!-- 인쇄옵션 끝 -->
        <center>
        <div id='print_page'>
		<link type='text/css' rel='stylesheet'href='/assets/css/2_layout.css?v=20160126090841' /><span></span>
		<link type='text/css' rel='stylesheet'href='/assets/css/2_print.css?v=20150807092751' /><span></span>
			<div id="idPrint" class="p-relative" style="margin-top:80px">
				<!--div class="virtualpage hidepiece" printtype="page"-->
					<!--div id="rpt_contents_new"-->
						<!--div class="p-absolute" style="top:0px; left:0px"--> 
<!-- 결재방 -->
<?/*
						<TABLE style="WIDTH: 650px; BORDER-COLLAPSE: collapse; MARGIN-BOTTOM: 5px; COLOR: #000; FONT-SIZE: 12px" border=0 cellSpacing=0 cellPadding=0>
						<TBODY>
							<TR>
							<TD style="TEXT-ALIGN: center; WIDTH: 99%; HEIGHT: 30px; FONT-SIZE: 20px; FONT-WEIGHT: bold"><U>지 출 결 의 서</U></TD>
							<TD style="WIDTH: 1%" align=right><table cellpadding='0' cellspacing='0' border='0' style='width:295px; margin:0px 0px 5px 0px; color:#000; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed'><tbody><tr><th style='font-size:12px; width:13px;padding:0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word' rowspan='2'>담당</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>부장</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>이사</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>상무</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>대표이사</th></tr><tr><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td></tr></tbody></table>
							</TD>
							</TR>
						</TBODY>
					</TABLE>    </td>   </tr>  </tbody>  </table>    <table border="0" cellspacing="0" cellpadding="0" style="padding:0px; width:650px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse; table-layout:fixed">   <colgroup><col style="width:75px"><col style="width:245px"><col style="width:10px"><col style="width:75px"><col /></colgroup>   <tbody>    <tr>     <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">전표번호</th>     <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;<?=$prodin_no?> &nbsp;</td>     <td>&nbsp;</td>      <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">출고처</th>     <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;<?=$outplant_des."(".$outplant.")"?></td>    </tr>    <tr>     <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; font-weight:bold">DATE</th>     <td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$basic_date?></td>     <td>&nbsp;</td>     <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000">입고처</th>     <td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$inplant_des."(".$inplant.")"?></td>    </tr>   </tbody>  </table>
                    
                    <!-- TopSql 끝 -->
        
                    <!-- 구매리스트 시작 -->
                    <table class="p_rptC" style="width:650px;table-layout:fixed;word-break:break-all; word-wrap: break-word;">
                        
                            <col width="44" />
                      
                            <col width="106" />
                      
                            <col width="275" />
                      
                            <col width="54" />
                      
                            <col width="145" />
                      
                        <thead>
                        <tr>
                        
                                <th style="height:22px">순번</th>
                        
                                <th style="height:22px">품목</th>
                        
                                <th style="height:22px">품명 및 규격</th>
                        
                                <th style="height:22px">수량</th>
                        
                                <th style="height:22px">적요</th>
                        
                        </tr>
                        </thead>
                        <tbody>
						<?=$html_table?>
						<?
						if ($no > 10){
						$countnum = 17 - $no;
						for($i=1; $i < $countnum ;$i++){?>
						<TR height=20>
						<TD>&nbsp;</TD>
						<TD>&nbsp;</TD>
						<TD>&nbsp;</TD>
						<TD>&nbsp;</TD>
						<TD>&nbsp;</TD>
						</TR>
						<?}
						}?>
                        </tbody>
                    </table>
                    <!-- 구매리스트 끝 -->
                
                    
                     <div style="margin-top:5px;"></div>
                     <table style="margin: 0px; width: 650px; height: 27px; color: rgb(0, 0, 0); line-height: 14px; font-size: 12px; border-top-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-top-width: 1px; border-left-width: 1px; border-top-style: solid; border-left-style: solid; border-collapse: collapse; table-layout: fixed;" border="0" cellSpacing="0" cellPadding="0"><colgroup><col style="width: 75px;"><col style="width: 130px;"><col style="width: 75px;"><col style="width: 130px;"><col style="width: 75px;"><col></colgroup><tbody><tr><td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">생산수량</td><td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;"><?=@array_sum($qtys)?>&nbsp;</td><td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">소모수량</td><td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">0&nbsp;</td><td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">인수</td><td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">인&nbsp;</td></tr></tbody></table>
                  
                    <!--/div--> <!-- div class=absolute-->

                    <div class="rpt-line" style="top:135.5mm; left:0px"></div>
*/?>                    
                        <!--div class="p-absolute" style="top:145.3mm; left:0px"--> 


                    <!-- 결재방 -->
                    
                    
                    <table border="0" cellspacing="0" cellpadding="0" style="width:650px; margin-bottom:5px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">  <tbody>   <tr>    <td style="width:99%; height:30px; font-size:20px; font-weight:bold; line-height:20px; text-align:center"><u>생산입고전표</u></td>    <td align="right" style="width:1%">     <table cellpadding='0' cellspacing='0' border='0' style='width:295px; margin:0px 0px 5px 0px; color:#000; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed'><tbody><tr><th style='font-size:12px; width:13px;padding:0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word' rowspan='2'>결재</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>결재</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>라인</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>설정</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>가능</th></tr><tr><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td></tr></tbody></table>    </td>   </tr>  </tbody>  </table>    <table border="0" cellspacing="0" cellpadding="0" style="padding:0px; width:650px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse; table-layout:fixed">   <colgroup><col style="width:75px"><col style="width:245px"><col style="width:10px"><col style="width:75px"><col /></colgroup>   <tbody>    <tr>     <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">전표번호</th>     <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;<?=$prodin_no?> &nbsp;</td>     <td>&nbsp;</td>      <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">출고처</th>     <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;<?=$outplant_des."(".$outplant.")"?></td>    </tr>    <tr>     <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; font-weight:bold">DATE</th>     <td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$basic_date?></td>     <td>&nbsp;</td>     <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000">입고처</th>     <td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$inplant_des."(".$inplant.")"?></td>    </tr>   </tbody>  </table>
                    
                    <!-- TopSql 끝 -->
        
                    <!-- 구매리스트 시작 -->
                    <table class="p_rptC" style="width:650px;table-layout:fixed;word-break:break-all; word-wrap: break-word;">
                        
                            <col width="44" />
                      
                            <col width="106" />
                      
                            <col width="275" />
                      
                            <col width="54" />
                      
                            <col width="145" />
                      
                        <thead>
                        <tr>
                        
                                <th style="height:22px">순번</th>
                        
                                <th style="height:22px">품목</th>
                        
                                <th style="height:22px">품명 및 규격</th>
                        
                                <th style="height:22px">수량</th>
                        
                                <th style="height:22px">적요</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                        <?=$html_table?>
						<?
						if ($no > 10){
						$countnum = 17 - $no;
						for($i=1; $i < $countnum ;$i++){?>
						<TR height=20>
						<TD>&nbsp;</TD>
						<TD>&nbsp;</TD>
						<TD>&nbsp;</TD>
						<TD>&nbsp;</TD>
						<TD>&nbsp;</TD>
						</TR>
						<?}
						}?>
                        </tbody>
                    </table>
                    <!-- 구매리스트 끝 -->
                
                    
                     <div style="margin-top:5px;"></div>
                     <table style="margin: 0px; width: 650px; height: 27px; color: rgb(0, 0, 0); line-height: 14px; font-size: 12px; border-top-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-top-width: 1px; border-left-width: 1px; border-top-style: solid; border-left-style: solid; border-collapse: collapse; table-layout: fixed;" border="0" cellSpacing="0" cellPadding="0"><colgroup><col style="width: 75px;"><col style="width: 130px;"><col style="width: 75px;"><col style="width: 130px;"><col style="width: 75px;"><col></colgroup><tbody><tr><td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">생산수량</td><td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;"><?=@array_sum($qtys)?>&nbsp;</td><td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">소모수량</td><td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">0&nbsp;</td><td style="background: rgb(236, 236, 236); text-align: center; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">인수</td><td style="text-align: right; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; word-wrap: break-word;">인&nbsp;</td></tr></tbody></table>
					 <!--/div--> <!-- div class=absolute-->
                     
                    <!--/div--> <!-- div id=rpt_contents_new-->
                    <!--/div--> <!-- div class=virtualpage hidepiece-->
                          
            <!-- for문 끝 -->
            
            </div> <!-- div id=idPrint -->
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
        
        //document.getElementById('rpt_contents_new').style.width = "650px";


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