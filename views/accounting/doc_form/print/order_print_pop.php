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
	$sql = "Select * From porder where pu_idx = ".$idx;
	//echo $sql."<br>"; 
	$result = mysql_query($sql);
	if ($result){
		//$cnt = mysql_num_rows($result);
		$ct=1;
		$row = mysql_fetch_array($result);	
		$pu_idx			=$row["pu_idx"];
		$pord_no		=$row["pord_no"];
		$basic_date		=$row["basic_date"];
		$ord_no			=$row["ord_no"];
		$cust_name		=$row["cust_name"];
		$cust_cd		=$row["cust_cd"];
		$emp_cd			=$row["emp_cd"];
		$emp_name		=$row["emp_name"];
		$wh_name		=$row["wh_name"];
		$wh_cd			=$row["wh_cd"];
		$pjt_cd			=$row["pjt_cd"];
		$ref_des		=$row["ref_des"];
		$coll_term		=$row["coll_term"];
		$agree_term		=$row["agree_term"];
		$req_date		=$row["req_date"];					
		$p_des			=$row["p_des"];
		$addfiles		=$row["addfiles"];
		$real_name		=$row["real_name"];
		$message		=$row["message"];
		$memo			=$row["memo"];
		$writer			=$row["writer"];
		$AmountTotal	=$row["AmountTotal"];
		$TaxTotal		=$row["TaxTotal"];
		$TotalAmount	=$row["TotalAmount"];
		$member_sn		=$row["member_sn"];
		$state_yn		=$row["state_yn"];
		$regdate		=$row["regdate"];
		$io_type		=$row["io_type"];

		if ($io_type=="00"){
			$io_type_value =	"VAT별도";
			$TaxTotal	   =	$TaxTotal;
		}else{
			$io_type_value =	"VAT포함";
			$TaxTotal	   =	"0"	;
		}
		}
		
   
//	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>발주서 출력</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="robots" content="noindex,nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />

<link type='text/css' rel='stylesheet'href='http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_layout.css?v=20160126090841' /><span></span>
<link type='text/css' rel='stylesheet'href='http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_print.css?v=20150807092751' /><span></span>
<script type="text/javascript" src="/weberp/js/jquery.js"></script>
<script language='javascript' type='text/javascript'>
        // ----------------------------------------------------------------------------------
        // 1. 전역변수 선언 영역
        // ----------------------------------------------------------------------------------       
        // ----------------------------------------------------------------------------------
        // 2. 초기 실행 함수 영역 
        // ----------------------------------------------------------------------------------
        // ----------------------------------------------------------------------------------
        // 3. 데이터 처리 함수 영역
        // ---------------------------------------------------------------------------------- 
        // ----------------------------------------------------------------------------------
        // 4. 이벤트 호출 함수 영역
        // ----------------------------------------------------------------------------------        

        //엑셀변환
        function ExcelPageMovement(Url) {
              
                $("#frmDetail").get(0).method = "post";
                $("#frmDetail").get(0).action = fnSetUrlPath(Url, "ec_req_sid");
                $("#frmDetail").get(0).target = "ifrmExcel";
                $("#frmDetail").submit();
                
        }
        //프린트함수
        function fnOrderPrint() {
            $("#level_gubun").get(0).value = "N";
            $("#sign_gubun").get(0).value = "Y";
            var url = "http://login.ecounterp.com/ECMain/ESD/ESD002R.php?gubun=1&form_ser=" + $("#form_ser").get(0).value + "&level_gubun=" + $("#level_gubun").get(0).value + "&sign_gubun=" + $("#sign_gubun").get(0).value + "&hidData=" + $("#hidData").get(0).value + "&edms_flag=N";
            window.open(fnSetUrlPath(url, "ec_req_sid"), 'estimateprint', 'left=50000,top=50000,width=0,height=0');     
            if ($("#hidData").get(0).value != "")
            { //이력
                strData = "Type=SALEHISTORY&H_STATUS=O&H_TYPE=01&GB_TYPE=Y&LOOP=Y&hidData="+encodeURIComponent($("#hidData").get(0).value);
                fnHistoryInser(strData, "")
            }
                   
        }

         // 첨부된 파일 다운로드 bsy
        function fnFileDownload(value) {
            location.href = fnSetUrlPath("/ECMAIN/EGG/Common/FileDownload.php?" + value,'ec_req_sid');
            //location.href = "/ECMAIN/EGG/Common/FileDownload.php?" + value;
            return false;
        }

        // 첨부된 파일 id로 보기 bsy
        function fleViewid(linkevalue) {
            var winW1 = "800px";
            var winH1 = "700px";
            var url;             
            var url = "/ECMAIN/EGG/EGG007P_01.php?hidSearchData=" + linkevalue;            
            window.open(fnSetUrlPath(url,'ec_req_sid'), "EGG007P_01_POP", "height=" + winH1 + ",width=" + winW1 + ",menubar=no,resizable=no,titlebar=no,scrollbars=1,status=1,toolbar=no,location=no");
        }
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
    </script>
	</head>
	<body>
		<form method="post" action="" id="form1">
		<script type="text/javascript">
		//<![CDATA[
		var theForm = document.forms['form1'];
		if (!theForm) {
			theForm = document.form1;
		}
		//]]>
		</script>
		<div id="dHTMLToolTip" style="position: absolute; visibility: hidden; width:10; height: 10; z-index: 1000; left: 0; top: 0"></div>
		<div id="wrap_pop">
			<!-- 상단버튼 및 양식설정부분 시작 -->
			<div class="dual-btn-fixed top-zero">
				<div class="dual-btn-area">
					<div class="float_left">
						<span class="btn blue-inverse"><input type="button" name="btnPrint" id="btnPrint" onclick="this.parentElement.style.display = 'none'; pageprint(); this.parentElement.style.display = ''; "  value="인쇄" /></span>
						<!-- <span class="btn gray"><input type="button" name="btn_excel" id="btn_excel" onclick="ExcelPageMovement('/ECMain/ESD/ESD002E.php');" value="Excel" /></span>    -->        
						<!-- <span class="btn gray"><input type="button" name="btnPdf" id="btnPdf" value="PDF" onclick="fnPdfBeta();" /></span> -->
						<!-- <span class="btn gray"><input type="button" id="btnPreview" value="최적화" onclick="fnPrintControl();" /></span>
						<span class="btn gray" ><input type="button" name="btnMail" id="btnMail" onclick="fnMail();return false;" value="Email" /></span>
					   <span class="btn gray" ><input type="button" name="btnSend" id="btnSend" onclick="fnFax();return false;" value="Fax" /></span> 
						<iframe id="iFaxSend" name="iFaxSend" src="" scrolling="no" frameborder="0" style="width:530px; height:255px; left:200px; top:100px; position:absolute; display:none;"></iframe>-->
					</div>
                <div class="float_right" >
                    <label class="btn_select">
                        <select id="form_ser" name="form_ser" onchange="print_it();">
                            <span id="form_list" name="form_list"><option value="1/0" />구매요청서</span>
                        </select>
                    </label>
                </div>
            </div>
        </div>
        <!-- 상단버튼 및 양식설정부분 끝 -->
        <br /><br /><br /><br />
        <center>
        <div id="idPrint">
			<div id='print_page'>
				<div id="rpt_contents"><!-- 결재방 -->                
					<TABLE style="WIDTH: 650px; BORDER-COLLAPSE: collapse; MARGIN-BOTTOM: 5px; COLOR: #000; FONT-SIZE: 12px" border=0 cellSpacing=0 cellPadding=0>
						<TBODY>
							<TR>
							<TD style="TEXT-ALIGN: center; WIDTH: 99%; HEIGHT: 30px; FONT-SIZE: 20px; FONT-WEIGHT: bold"><U>지 출 결 의 서</U></TD>
							<TD style="WIDTH: 1%" align=right><table cellpadding='0' cellspacing='0' border='0' style='width:295px; margin:0px 0px 5px 0px; color:#000; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed'><tbody><tr><th style='font-size:12px; width:13px;padding:0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word' rowspan='2'>담당</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>부장</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>이사</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>상무</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>대표이사</th></tr><tr><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td></tr></tbody></table>
							</TD>
							</TR>
						</TBODY>
					</TABLE>
					<!-- 결재방 --> 

					<table border="0" cellspacing="0" cellpadding="0" style="margin:0px 0px 5px 0px; width:650px; font-size:12px; color:#000; line-height:14px; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed">
						<colgroup><col style="width:100px" /><col style="width:227px" /><col style="width:100px" /><col /></colgroup>
						<tbody>
							<tr>
								<th style="padding:3px 0px 2px 0px; text-align:center; font-weight:bold; background:#f7f7f7; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">전표번호</th>
								<td style="padding:3px 0px 2px 0px; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">&nbsp;<?=$pord_no?></td>
								<th style="padding:3px 0px 2px 0px; text-align:center; font-weight:bold; background:#f7f7f7; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">입고될창고</th>
								<td style="padding:3px 0px 2px 0px; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">&nbsp;<?=$wh_name?></td>
							</tr>
							<tr>
								<th style="padding:3px 0px 2px 0px; text-align:center; font-weight:bold; background:#f7f7f7; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">담당자</th>
								<td style="padding:3px 0px 2px 0px; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">&nbsp;<?=$emp_name?></td>
								<th style="padding:3px 0px 2px 0px; text-align:center; font-weight:bold; background:#f7f7f7; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">납기일자</th>
								<td style="padding:3px 0px 2px 0px; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">&nbsp;<?=$req_date?></td>
							</tr>
							<tr>
								<th style="padding:3px 0px 2px 0px; text-align:center; font-weight:bold; background:#f7f7f7; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">프로젝트</th>
								<td style="padding:3px 0px 2px 0px; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">&nbsp;&nbsp;</td>
								<th style="padding:3px 0px 2px 0px; text-align:center; font-weight:bold; background:#f7f7f7; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">참조</th>
								<td style="padding:3px 0px 2px 0px; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">&nbsp;<?=$ref_des?>&nbsp;</td>
							</tr>
						</tbody>
					</table>
                
                <!-- TopSql 끝 -->
        
                <!-- 품목리스트 시작 -->
                <table class="p_rptC" style="width:650px;table-layout:fixed;word-break:break-all; word-wrap: break-word;" >
                    
                        <col width="55" />
                    
                        <col width="283" />
                    
                        <col width="80" />
                    
                        <col width="34" />
                    
                        <col width="54" />
                    
                        <col width="54" />
                    
                        <col width="54" />
						<col width="54" />
                    <thead>
                    <tr>
                    
                        <th style="height:25px">월/일</th>
                    
                        <th style="height:25px">품명및규격</th>
                    
                        <th style="height:25px">거래처명</th>
                    
                        <th style="height:25px">수량</th>
                    
                        <th style="height:25px">단가</th>

                        <th style="height:25px">공급가액</th>
                    
                        <th style="height:25px">부가세</th>
                                
                    </tr>
                    </thead>
                    <tbody>
<?
					$sql = "Select * From porderSub where pord_no = '".$pord_no."'";
					//echo $sql."<br>";  
					$result = mysql_query($sql);
					$cnt = mysql_num_rows($result);
					if ($result){
						if ($cnt>"0"){
							$ct=1;
							$totalunit=0;
							while($rows=mysql_fetch_array($result)) {
								$idx		=$rows["idx"];									
								$pord_no	=$rows["pord_no"];
								$rel_no		=$rows["rel_no"];
								$prod_cd	=$rows["prod_cd"];
								$prod_des	=$rows["prod_des"];
								$size_des	=$rows["size_des"];
								$qty		=$rows["qty"];
								$price		=$rows["price"];
								$prod_qty	=$rows["prod_qty"];
								$res_qty	=$rows["res_qty"];
								$unit		=$rows["unit"];
								$Process_route	=$rows["Process_route"];
								$remarks	=$rows["remarks"];
								$bom_depth1	=$rows["remarks"];
								$regdate	=$rows["regdate"];
								$vat_amt		=$rows["vat_amt"];
								
								$totalunit = $totalunit + $qty;
								$totalvat_amt = $vat_amt + $vat_amt ;
								//$totalunit = $qty++;
							?>	
					<tr height=19><td class=' center font11px' style='overflow:hidden'><?=substr($pord_no,5,10)?></td><td class=' left font11px' style='overflow:hidden'><?=$prod_des?>[<?=$size_des?>]</td><td class=' left font11px' style='overflow:hidden'><?=$cust_name?></td><td class=' right font11px' style='overflow:hidden'><?=number_format($qty)?><?=$unit?></td><td class=' right font11px' style='overflow:hidden'><?=number_format($price)?></td><td class=' right font11px' style='overflow:hidden'><?=number_format($price*$qty)?></td><td class=' right font11px' style='overflow:hidden'><?=number_format((($price*$qty)/10))?></td></tr>
				<?
							$ct++;
							}
						}
						?>
						<? 
						$limitcnt = 15 - $cnt;
						for($i=1;$i<$limitcnt;$i++){?>
				<tr height=19><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr height=19><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
				<?}?>
						<?}?>
				</TBODY></TABLE><!-- 품목리스트 끝 -->
				<TABLE border=0 cellSpacing=0 cellPadding=0 width=300>
				<TBODY>
				<TR>
				<TD height=5></TD></TR></TBODY></TABLE>
				<TABLE style="BORDER-LEFT: #000 1px solid; LINE-HEIGHT: 14px; MARGIN: 5px 0px 0px; WIDTH: 650px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; HEIGHT: 27px; COLOR: #000; FONT-SIZE: 12px; BORDER-TOP: #000 1px solid" border=0 cellSpacing=0 cellPadding=0>
				<COLGROUP>
				<COL style="WIDTH: 51px">
				<COL style="WIDTH: 75px">
				<COL style="WIDTH: 63px">
				<COL style="WIDTH: 108px">
				<COL style="WIDTH: 44px">
				<COL style="WIDTH: 94px">
				<COL style="WIDTH: 57px">
				<COL></COLGROUP>
				<TBODY>
				<tr>
					<td style="text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">수량</td>
					<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=number_format($totalunit)?>&nbsp;</td>
					<td style="text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">공급가액</td>
					<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=$AmountTotal?>&nbsp;</td>
					<td style="text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">VAT</td>
					<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?if ($io_type=="00") echo number_format($TaxTotal)?>&nbsp;</td>
					<td style="text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">합계</td>
					<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=$TotalAmount?>&nbsp;</td>
				</tr>
				
			</TBODY>
		</TABLE><!-- for문 끝 -->
<TABLE style="WIDTH: 650px" id=tblLinks class=listgray summary="" align=center>
<COLGROUP>
<COL width=130>
<COL><!-- for (int u = 0; u < dtLinkData.Rows.Count;u++) end --></COLGROUP></TABLE><!-- if (iloop_cnt == 1) end -->
<TABLE border=0 cellSpacing=0 cellPadding=0 width=300>
<TBODY>
<TR>
<TD height=5></TD></TR></TBODY></TABLE></DIV></DIV><!-- div idPrint end --></DIV>

<SCRIPT language=javascript type=text/javascript>    
        // 화면 넓이설정
        if ("650" < 650) {
            $("#rpt_contents").css("width", "650px");
        } else {
            $("#rpt_contents").css("width", "650px");
        }

 
    </SCRIPT>

<STYLE type=text/css> @page{size:A4;margin-top:13mm;margin-left:4.2mm;margin-right:4.6mm;margin-bottom:5.3mm;}@media print{html,body{min-width:201.2mm;overflow:hidden;}thead {display: table-header-group;}}</STYLE>

<STYLE type=text/css>@page  {size: A4; margin-top: 13mm; margin-left: 4.2mm; margin-right: 4.6mm; margin-bottom: 5.3mm; }

@media Print    
{
HTML {
	MIN-WIDTH: 201.2mm; OVERFLOW: hidden
}
BODY {
	MIN-WIDTH: 201.2mm; OVERFLOW: hidden
}
THEAD {
	DISPLAY: table-header-group
}

}
</STYLE>
</BODY></HTML>