<?
session_start();

require_once('../../connection.php');
require_once('../../library/json.php');
require_once('../../library/function.php');

extract($_POST);
extract($_GET);
?>

<?
//	if ($mode=="modify"){
	$sql = "Select * From erp_purchase_order where uid = ".$porder_cd;
	echo $sql."<br>"; 
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
<title>발주서 출력</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="robots" content="noindex,nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />


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
						<span class="btn blue-inverse"><input type="button" name="btnPrint" id="btnPrint" onclick="pageprint();"  value="인쇄" /></span>
						<span class="btn gray"><input type="button" name="btn_excel" id="btn_excel" onclick="ExcelPageMovement('/ECMain/ESD/ESD002E.php');" value="Excel" /></span>           
						<span class="btn gray"><input type="button" name="btnPdf" id="btnPdf" value="PDF" onclick="fnPdfBeta();" /></span>
						<!-- <span class="btn gray"><input type="button" id="btnPreview" value="최적화" onclick="fnPrintControl();" /></span>
						<span class="btn gray" ><input type="button" name="btnMail" id="btnMail" onclick="fnMail();return false;" value="Email" /></span>
					   <span class="btn gray" ><input type="button" name="btnSend" id="btnSend" onclick="fnFax();return false;" value="Fax" /></span> 
						<iframe id="iFaxSend" name="iFaxSend" src="" scrolling="no" frameborder="0" style="width:530px; height:255px; left:200px; top:100px; position:absolute; display:none;"></iframe>-->
					</div>
                <div class="float_right" >
                    <label class="btn_select">
                        <select id="form_ser" name="form_ser" onchange="print_it();">
                            <span id="form_list" name="form_list"><option value="1/0" />발주서</span>
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
			<link type='text/css' rel='stylesheet'href='/assets/css/2_layout.css?v=20160126090841' /><span></span>
			<link type='text/css' rel='stylesheet'href='/assets/css/2_print.css?v=20150807092751' /><span></span>
				<div id="rpt_contents">     <!-- 결재방 -->
<TABLE style="WIDTH: 650px; BORDER-COLLAPSE: collapse; MARGIN-BOTTOM: 5px; COLOR: #000; FONT-SIZE: 12px" border=0 cellSpacing=0 cellPadding=0>
						<TBODY>
							<TR>
							<TD style="TEXT-ALIGN: center; WIDTH: 99%; HEIGHT: 30px; FONT-SIZE: 20px; FONT-WEIGHT: bold"><U>발 주 서</U></TD>
							<TD style="WIDTH: 1%" align=right><table cellpadding='0' cellspacing='0' border='0' style='width:295px; margin:0px 0px 5px 0px; color:#000; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed'><tbody><tr><th style='font-size:12px; width:13px;padding:0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word' rowspan='2'>담당</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>부장</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>이사</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>상무</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>대표이사</th></tr><tr><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td></tr></tbody></table>
							</TD>
							</TR>
						</TBODY>
					</TABLE>
<DIV style="WIDTH: 650px; BACKGROUND: no-repeat 100% 55px">
<TABLE style="PADDING-BOTTOM: 0px; LINE-HEIGHT: 14px; PADDING-LEFT: 0px; WIDTH: 650px; PADDING-RIGHT: 0px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; COLOR: #000; FONT-SIZE: 12px; PADDING-TOP: 0px" border=0 cellSpacing=0 cellPadding=0>
<COLGROUP>
<COL style="WIDTH: 75px">
<COL style="WIDTH: 220px">
<COL style="WIDTH: 10px">
<COL style="WIDTH: 75px">
<COL></COLGROUP>
<TBODY>
<TR>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-TOP: #000 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">일련번호</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-TOP: #000 1px solid; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t->p_order_cd?></TD>
<TD>&nbsp;</TD>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BORDER-TOP: #000 1px solid; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px" rowSpan=2 colSpan=2>&nbsp;&nbsp;</TD></TR>
<TR>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">수 신</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t->manager?></TD>
<TD>&nbsp;</TD></TR>
<TR>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">참 조</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t->refer?></TD>
<TD>&nbsp;</TD>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">사업자등록번호</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;397-86-00437</TD></TR>
<TR>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">TEL</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t2->corp_phone?>&nbsp;</TD>
<TD>&nbsp;</TD>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">회사명/대표</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;(주)태성정밀 / </TD></TR>
<TR>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">FAX</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t2->corp_fax?>&nbsp;</TD>
<TD>&nbsp;</TD>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">주 소</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;경기도 안산시 상록구 건건4길 50</TD></TR>
<TR>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">납기일자</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t->deadline_dt?> </TD>
<TD>&nbsp;</TD>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">담당/연락처</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;박대순 / 031-437-0175</TD></TR></TBODY></TABLE>
<TABLE style="BORDER-BOTTOM: #000 2px solid; BORDER-LEFT: #000 2px solid; LINE-HEIGHT: 16px; MARGIN: 5px 0px; WIDTH: 650px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; HEIGHT: 29px; COLOR: #000; FONT-SIZE: 14px; BORDER-TOP: #000 2px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #000 2px solid">
<TBODY>
<TR>
<TD style="PADDING-BOTTOM: 0px; PADDING-LEFT: 30px; PADDING-RIGHT: 0px; PADDING-TOP: 0px">금 액 :&nbsp;<?=num2kor(str_replace(",","",$t->priceTotal))?>원정</TD>
<TD style="TEXT-ALIGN: right; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 17px; PADDING-TOP: 0px">(￦ <?=$t->priceTotal?>원) / VAT포함</TD></TR></TBODY></TABLE></DIV><!-- TopSql 끝 --><!-- 품목리스트 시작 -->
<TABLE style="WIDTH: 650px; WORD-WRAP: break-word; TABLE-LAYOUT: fixed; WORD-BREAK: break-all" class=p_rptC>
<COLGROUP>
<COL width=120>
<COL width=264>
<COL width=35>
<COL width=60>
<COL width=70>
<COL width=70>
<THEAD>
<TR>
<TH style="HEIGHT: 25px">품목코드</TH>
<TH style="HEIGHT: 25px">품목명</TH>
<TH style="HEIGHT: 25px">수량</TH>
<TH style="HEIGHT: 25px">단가</TH>
<TH style="HEIGHT: 25px">공급가액</TH>
<TH style="HEIGHT: 25px">부가세</TH></TR></THEAD>
<TBODY>
<?
					$sql = "Select * From erp_purchase_order_item where fid = '".$t->uid."'";
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
					<TD style="OVERFLOW: hidden" class=" left font11px"><?=$t1->p_order_cd?></TD>
					<TD style="OVERFLOW: hidden" class=" left font11px"><?=$t1->item_nm?></TD>
					<TD style="OVERFLOW: hidden" class=" right font11px"><?=number_format($t1->cnt)?></TD>
					<TD style="OVERFLOW: hidden" class=" right font11px"><?=number_format($t1->unit_price)?></TD>
					<TD style="OVERFLOW: hidden" class=" right font11px"><?=number_format($t1->supply_price)?></TD>
					<TD style="OVERFLOW: hidden" class=" right font11px"><?=number_format($t1->tax)?></TD></TR>
				<?
							$ct++;
							}
						}
						?>
						<? 
						$limitcnt = 25 - $cnt;
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
								<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=$TaxTotal?>&nbsp;</td>
								<td style="text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">합계</td>
								<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=$TotalAmount?>&nbsp;</td>
							</tr></TBODY></TABLE><!-- for문 끝 -->
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