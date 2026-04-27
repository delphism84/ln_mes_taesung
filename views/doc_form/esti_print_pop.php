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
	$sql = "Select * From erp_estimate where uid = ".$est_cd;
	//echo $sql."<br>"; 
	//$result = mysql_query($sql);
	$t = mysql_fetch_object(mysql_query($sql));

	$sql = "Select * From erp_account where account_cd = '".$t->account_cd."'";
	//echo $sql."<br>"; 
	//$result = mysql_query($sql);
	$t2 = mysql_fetch_object(mysql_query($sql));

	$sql = "Select * From erp_account a, erp_info b where a.account_nm = b.corp_nm ";
	//echo $sql."<br>"; 
	//$result = mysql_query($sql);
	$t3 = mysql_fetch_object(mysql_query($sql));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>견적서 출력</title>
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
	<style type="text/css">
	.H_5px{font-size:5px}
	.H_11px{font-size:11px}
	.font9px{font-size:9px}
	.font11px{font-size:1px}
	</style>
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
						<!--span class="btn gray"><input type="button" name="btn_excel" id="btn_excel" onclick="ExcelPageMovement('/ECMain/ESD/ESD002E.php');" value="Excel" /></span-->           
						<!--span class="btn gray"><input type="button" name="btnPdf" id="btnPdf" value="PDF" onclick="fnPdfBeta();" /></span-->
						<!-- <span class="btn gray"><input type="button" id="btnPreview" value="최적화" onclick="fnPrintControl();" /></span>
						<span class="btn gray" ><input type="button" name="btnMail" id="btnMail" onclick="fnMail();return false;" value="Email" /></span>
					   <span class="btn gray" ><input type="button" name="btnSend" id="btnSend" onclick="fnFax();return false;" value="Fax" /></span> 
						<iframe id="iFaxSend" name="iFaxSend" src="" scrolling="no" frameborder="0" style="width:530px; height:255px; left:200px; top:100px; position:absolute; display:none;"></iframe>-->
					</div>
                <div class="float_right" >
                    <label class="btn_select">
                        <select id="form_ser" name="form_ser" onchange="print_it();">
                            <span id="form_list" name="form_list"><option value="1/0" />견적서</span>
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
				<link type='text/css' rel='stylesheet'href='/assets/css/2_layout.css?v=20160126090841' /><span></span>
				<link type='text/css' rel='stylesheet'href='/assets/css/2_print.css?v=20150807092751' /><span></span>
				<div id="rpt_contents">            
					<!-- 결재방 -->                
					<TABLE style="WIDTH: 650px; BORDER-COLLAPSE: collapse; MARGIN-BOTTOM: 5px; COLOR: #000; FONT-SIZE: 12px" border=0 cellSpacing=0 cellPadding=0>
						<TBODY>
							<TR>
							<TD style="TEXT-ALIGN: center; WIDTH: 99%; HEIGHT: 30px; FONT-SIZE: 20px; FONT-WEIGHT: bold"><U>견 적 서</U></TD>
							<TD style="WIDTH: 1%" align=right><table cellpadding='0' cellspacing='0' border='0' style='width:295px; margin:0px 0px 5px 0px; color:#000; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed'><tbody><tr><th style='font-size:12px; width:13px;padding:0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word' rowspan='2'>담당</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>부장</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>이사</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>상무</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>대표이사</th></tr><tr><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td></tr></tbody></table>
							</TD>
							</TR>
						</TBODY>
					</TABLE>
					<DIV style="WIDTH: 650px; BACKGROUND: url(none) no-repeat 100% 75px">
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
							<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-TOP: #000 1px solid; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t->estimate_cd?>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BORDER-TOP: #000 1px solid; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px" rowSpan=3 colSpan=2>&nbsp;&nbsp;</TD></TR>
							<TR>
							<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">수 신</TH>
							<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t->account_nm?></TD>
							<TD>&nbsp;</TD></TR>
							<TR>
							<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">참 조</TH>
							<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t->refer?>&nbsp;</TD>
							<TD>&nbsp;</TD></TR>
							<TR></TR>
							<TR>
							<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">TEL/FAX</TH>
							<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;&nbsp; <?=$t2->corp_phone?>/<?=$t2->corp_fax?> &nbsp;</TD>
							<TD>&nbsp;</TD>
							<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">사업자등록번호</TH>
							<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t3->corp_reg_no?></TD></TR>
							<TR>
							<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">결제조건</TH>
							<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t->payment_condition?>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">회사명/대표</TH>
							<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t3->account_nm?> / <?=$t3->owner?></TD></TR>
							<TR>
							<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">유효기간</TH>
							<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t->delivery_dt?>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">주 소</TH>
							<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t3->corp_address?></TD></TR>
							<TR>
							<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: left; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 10px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 10px" rowSpan=3 colSpan=2>&nbsp;1. 귀사의 일익 번창하심을 기원합니다.<BR>&nbsp;2. 하기와 같이 견적드리오니 검토하기 바랍니다. </TD>
							<TD>&nbsp;</TD>
							<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">업태/종목</TH>
							<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t3->corp_condition?>/<?=$t3->corp_event?> </TD></TR>
							<TR>
							<TD>&nbsp;</TD>
							<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">담당자</TH>
							<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t3->manager?></TD></TR>
							<TR>
							<TD>&nbsp;</TD>
							<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">TEL/FAX</TH>
							<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$t3->corp_phone?> / <?=$t3->corp_fax?></TD></TR>
						</TBODY>
						</TABLE>
						<TABLE style="BORDER-BOTTOM: #000 2px solid; BORDER-LEFT: #000 2px solid; LINE-HEIGHT: 16px; MARGIN: 5px 0px; WIDTH: 650px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; HEIGHT: 29px; FONT-SIZE: 14px; BORDER-TOP: #000 2px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #000 2px solid">
						<TBODY>
						<TR>
						<TD style="PADDING-BOTTOM: 0px; PADDING-LEFT: 30px; PADDING-RIGHT: 0px; PADDING-TOP: 0px">금 액 :&nbsp;<?=num2kor(str_replace(",","",$t->priceTotal))?>원정</TD>
						<TD style="TEXT-ALIGN: right; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 17px; PADDING-TOP: 0px">(￦ <?=number_format($t->priceTotal)?>원) / VAT포함</TD></TR>
						</TBODY>
						</TABLE>
					</DIV>
					<!-- TopSql 끝 -->
					<table class="H_11px" width="649px" border="0" cellspacing="0" cellpadding="1px" style="border:1px solid #333333;table-layout:fixed;word-break:break-all; word-wrap: break-word;"><tr align="center" bgcolor="#ececec" style="height:25px; background-color:#ececec;"><th width="80" style="border-width:1px;  border-right-style:solid; border-color:#999999;"><strong>품목코드</strong></th><th width="244" style="border-width:1px;  border-right-style:solid; border-color:#999999;"><strong>품목명</strong></th><th width="34" style="border-width:1px;  border-right-style:solid; border-color:#999999;"><strong>수량</strong></th><th width="53" style="border-width:1px;  border-right-style:solid; border-color:#999999;"><strong>단가</strong></th><th width="53" style="border-width:1px;  border-right-style:solid; border-color:#999999;"><strong>공급가액</strong></th><th width="55" style="border-width:1px;  border-color:#999999"><strong>부가세</strong></th></tr>
						<?
					$sql = "Select * From erp_estimate_item where fid = '".$t->uid."'";
					//echo $sql."<br>";  
					$result = mysql_query($sql);
					$cnt = mysql_num_rows($result);
					if ($result){
						if ($cnt>"0"){
							$ct=1;
							while($rows=@mysql_fetch_object($result)) {

							?>	
						<!-- 품목리스트 시작 -->
						<tr style="height:19px;"><td class=" left font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999; overflow:hidden"><?=$rows->item_cd?></td><td class=" left font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999; overflow:hidden"><?=$rows->item_nm?></td><td class=" right font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999; overflow:hidden"><?=number_format($rows->cnt)?></td><td class=" right font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999; overflow:hidden"><?=number_format($rows->unit_price)?></td><td class=" right font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999; overflow:hidden"><?=number_format($rows->supply_price)?></td><td class=" right font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid; border-color:#999999; overflow:hidden"><?=number_format($rows->tax)?></td></tr>
						<?
							$ct++;
							}
						}
						?>
						<? 
						$limitcnt = 25 - $cnt;
						for($i=1;$i<$limitcnt;$i++){?>
						<tr style="height:19px;"><td class="left font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999;">&nbsp;</td><td class="left font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999;">&nbsp;</td><td class="right font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999;">&nbsp;</td><td class="right font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999;">&nbsp;</td><td class="right font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999;">&nbsp;</td><td class="right font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid; border-color:#999999;">&nbsp;</td></tr>
						<?}?>
						<?}?>
					</table> 
						<!-- 품목리스트 끝 -->
					<table width="300" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="5">
							</td>
						</tr>
					</table>

					<table border="0" cellspacing="0" cellpadding="0" style="width:650px; height:27px; margin:5px 0px 0px 0px; font-size:12px; color:#000; line-height:14px; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed">
					<colgroup><col style="width:51px" /><col style="width:75px" /><col style="width:63px" /><col style="width:108px" /><col style="width:44px" /><col style="width:94px" /><col style="width:57px" /><col /></colgroup>
						<tbody>
							<tr>
								<td style="text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">수량</td>
								<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=number_format($t->cntTotal)?>&nbsp;</td>
								<td style="text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">공급가액</td>
								<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=number_format($t->supplyPriceTotal)?>&nbsp;</td>
								<td style="text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">VAT</td>
								<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=number_format($t->taxTotal)?>&nbsp;</td>
								<td style="text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">합계</td>
								<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=number_format($t->priceTotal)?>&nbsp;</td>
							</tr>
						</tbody>
					</table>
					<!-- for문 끝 -->
					<table summary="" class="listgray"  align="center"  style="width:650px" id="tblLinks">
					<col width="130" /><col width="" />
					  <!-- for (int u = 0; u < dtLinkData.Rows.Count;u++) end -->
					</table>
					<!-- if (iloop_cnt == 1) end -->
				</div>
			</div>
        </div>  <!-- div idPrint end -->
        </center>
        
       
    </div>
    </form>
    <form id="frmDetail">
    <input name="hidSearchXml" type="hidden" id="hidSearchXml" value="20160707-7;1;0;00;" />
    <input type="hidden" name="formser" id="formser" value="0" />
    <input type="hidden" name="basicFormser" id="basicFormser" value="1000" />
    <input name="cust" type="hidden" id="cust" value="2208165848" />
    <input name="cust_des" type="hidden" id="cust_des" value="" />
    <input name="amount" type="hidden" id="amount" />
    <input name="amount_des" type="hidden" id="amount_des" />
    <input type="hidden" name="foreign_flag" id="foreign_flag" value="0" />
    <input type="hidden" name="basic_type" id="basic_type" value="0" />
    <input type="hidden" name="basic_type2" id="basic_type2" value="0" />
    <input type="hidden" name="edms_flag" id="edms_flag" value="N" />
    </form>
    <iframe name="ifrmExcel" style="width: 0px; height: 0px"></iframe>
    <script language="javascript" type="text/javascript">      
        // ----------------------------------------------------------------------------------
        // 2. 초기 실행 함수 영역
        // ----------------------------------------------------------------------------------  
        // 화면 넓이설정
        $("#rpt_contents").css("width", "649px");
    </script>
</body>
<style type="text/css"> @page{size:A4;margin-top:13mm;margin-left:4.2mm;margin-right:4.6mm;margin-bottom:5.3mm;}@media print{html,body{min-width:201.2mm;overflow:hidden;}thead {display: table-header-group;}}</style>
</html>
