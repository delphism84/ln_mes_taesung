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
	$sql = "Select * From shipping_order where num = ".$est_cd;
	//echo $sql."<br>"; 
	$result = mysql_query($sql);
	if ($result){
		//$cnt = mysql_num_rows($result);
		$ct=1;
		$row = mysql_fetch_array($result);	
			$num			=$row["num"];
			$out_no			=$row["out_no"];
			$out_cd			=$row["out_cd"];
			$out_gubun		=$row["out_gubun"];
			$out_state		=$row["out_state"];
			$cust_name		=$row["cust_name"];
			$cust_cd		=$row["cust_cd"];
			$emp_cd			=$row["emp_cd"];
			$emp_name		=$row["emp_name"];
			$wh_name		=$row["wh_name"];
			$wh_cd			=$row["wh_cd"];
			$phone			=$row["phone"];
			$expect_date	=$row["expect_date"];
			$pjt_cd			=$row["pjt_cd"];
			$p_des			=$row["p_des"];
			$postcode		=$row["postcode"];
			$address		=$row["address"];
			$address1		=$row["address1"];
			$s_end			=$row["s_end"];
			$member_sn		=$row["member_sn"];
			$regdate		=$row["regdate"];
		}

   
//	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>출하지시서 출력</title>
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
<body>
    <form method="post" action="./ESE003R.aspx?ec_req_sid=00JYvOYfwC8b" id="form1">
    <div id="dHTMLToolTip" style="position: absolute; visibility: hidden; width:10; height: 10; z-index: 1000; left: 0; top: 0"></div>
    <div id="wrap_pop">
        <!-- 상단버튼 및 양식설정부분 시작 --> 
        <div class="dual-btn-fixed top-zero">
		    <div class="dual-btn-area">
			    <div class="float_left">
                    
                   <span class="btn blue-inverse"><input type="button" name="btnPrint" id="btnPrint" onclick="this.parentElement.style.display = 'none'; pageprint(); this.parentElement.style.display = ''; "  value="인쇄" /></span>
						<!--span class="btn gray"><input type="button" name="btn_excel" id="btn_excel" onclick="ExcelPageMovement('/ECMain/ESD/ESD002E.php');" value="Excel" /></span-->           
						<!--span class="btn gray"><input type="button" name="btnPdf" id="btnPdf" value="PDF" onclick="fnPdfBeta();" /></span-->
                    
                </div>
                
                
            </div>
            <!-- 인쇄옵션 끝 -->
        </div>
        <!-- 인쇄옵션 끝 -->
        
        <center>
		<div id='print_page'>
        <div id="idPrint" class="p-relative" style="margin-top:80px">
        <input type="hidden" id="hidHeightParam" name="hidHeightParam"  /> <!--종이 인쇄시 호환성일경우 Page Break시 hidHeightParam 지정된 높이를 사용함 -->      
        
                            <div class="virtualpage hidepiece" printtype="page">
                            <div id="rpt_contents_new">
                           
                        <div class="p-absolute" style="top:0px; left:0px"> 
                    

                    <!-- 결재방 -->
                                        
                    <div ><DIV style="WIDTH: 650px; BACKGROUND: url(/MemberInfo/Logo/_G1080_10b67c8d73f21f8e98092e524e23a4e9_sign.gif) no-repeat 101% 10px">
					<TABLE style="LINE-HEIGHT: 14px; WIDTH: 650px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; COLOR: #000; FONT-SIZE: 12px" border=0 cellSpacing=0 cellPadding=0>
					<COLGROUP>
					<COL style="WIDTH: 300px">
					<COL style="WIDTH: 20px">
					<COL></COLGROUP>
					<TBODY>
					<TR>
					<TD style="VERTICAL-ALIGN: bottom">
					<TABLE style="TEXT-ALIGN: center; WIDTH: 100%" border=0 cellSpacing=0 cellPadding=0>
					<COLGROUP>
					<COL style="WIDTH: 100%"></COLGROUP>
					<TBODY>
					<TR>
					<TD style="PADDING-BOTTOM: 10px; LINE-HEIGHT: 25px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; HEIGHT: 50px; FONT-SIZE: 25px; FONT-WEIGHT: bold; PADDING-TOP: 0px"><U>출하지시서</U></TD></TR>
					<TR>
					<TD style="BORDER-RIGHT-WIDTH: 1px; BORDER-TOP-WIDTH: 1px; BORDER-BOTTOM-WIDTH: 1px; HEIGHT: 40px; VERTICAL-ALIGN: bottom; BORDER-LEFT-WIDTH: 1px; PADDING-TOP: 3px">
					<TABLE style="BORDER-BOTTOM: #000 1px solid; BORDER-LEFT: #000 1px solid; WIDTH: 300px; HEIGHT: 100%; BORDER-TOP: #000 1px solid; BORDER-RIGHT: #000 1px solid" border=0 cellSpacing=0 cellPadding=0>
					<TBODY>
					<TR>
					<TD style="TEXT-ALIGN: center">&nbsp;<?=$cust_name?></TD></TR>
					<TR>
					<TD style="TEXT-ALIGN: center">&nbsp;<?=$phone?></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
					<TD></TD>
					<TD style="VERTICAL-ALIGN: top">
					<TABLE style="BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 0px; LINE-HEIGHT: 14px; MARGIN: 6px 0px 0px; PADDING-LEFT: 0px; WIDTH: 100%; PADDING-RIGHT: 0px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; COLOR: #000; FONT-SIZE: 12px; BORDER-TOP: #000 1px solid; PADDING-TOP: 0px" border=0 cellSpacing=0 cellPadding=0>
					<COLGROUP>
					<COL style="WIDTH: 20px">
					<COL style="WIDTH: 69px">
					<COL style="WIDTH: 99px">
					<COL style="WIDTH: 50px">
					<COL></COLGROUP>
					<TBODY>
					<TR>
					<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f7f7f7; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 2px" rowSpan=4>공<BR><BR>급<BR><BR>자 </TH>
					<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f7f7f7; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 2px">일련번호</TH>
					<TD style="BORDER-BOTTOM: #000 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; FONT-SIZE: 11px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 0px">&nbsp;<?=$out_no?></TD>
					<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f7f7f7; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 2px">TEL</TH>
					<TD style="BORDER-BOTTOM: #000 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; FONT-SIZE: 11px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 0px">&nbsp;&nbsp;</TD></TR>
					<TR>
					<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f7f7f7; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 2px">사업자<BR>등록번호</TH>
					<TD style="BORDER-BOTTOM: #000 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; FONT-SIZE: 11px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 0px">&nbsp;&nbsp;</TD>
					<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f7f7f7; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 2px">성명</TH>
					<TD style="BORDER-BOTTOM: #000 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; FONT-SIZE: 11px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 0px">&nbsp;&nbsp;</TD></TR>
					<TR>
					<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f7f7f7; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 2px">상호</TH>
					<TD style="BORDER-BOTTOM: #000 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; FONT-SIZE: 11px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 0px" colSpan=3>&nbsp;&nbsp;</TD></TR>
					<TR>
					<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f7f7f7; HEIGHT: 40px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 0px">주소</TH>
					<TD style="BORDER-BOTTOM: #000 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; FONT-SIZE: 11px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 0px" colSpan=3>&nbsp;&nbsp;</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
					<TABLE style="PADDING-BOTTOM: 0px; LINE-HEIGHT: 14px; MARGIN: 10px 0px 0px; PADDING-LEFT: 0px; WIDTH: 650px; PADDING-RIGHT: 0px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; COLOR: #000; FONT-SIZE: 12px; PADDING-TOP: 0px" border=0 cellSpacing=0 cellPadding=0>
					<COLGROUP>
					<COL style="WIDTH: 75px">
					<COL style="WIDTH: 220px">
					<COL style="WIDTH: 75px">
					<COL></COLGROUP>
					<TBODY>
					<TR>
					<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-TOP: #000 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">출하창고</TH>
					<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-TOP: #000 1px solid; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$wh_name?></TD>
					<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-TOP: #000 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">출하예정일</TH>
					<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-TOP: #000 1px solid; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$expect_date?></TD></TR>
					<TR>
					<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">납품지주소</TH>
					<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid" colSpan=3>&nbsp;(<?=$postcode?>)&nbsp;<?=$address?>&nbsp;<?=$address1?></TD></TR></TBODY></TABLE></DIV>
                    <!-- TopSql 끝 -->
                    <!-- 품목리스트 시작 -->
                    <table class="p_rptC" style="width:650px;table-layout:fixed;word-break:break-all; word-wrap: break-word;" >
                        
                            <col width="294" />
                        
                            <col width="145" />
                        
                            <col width="195" />
                        
                        <thead>
                        <tr>
                        
                            <th style="height:25px;">품명및 규격</th>
                        
                            <th style="height:25px;">수량</th>
                        
                            <th style="height:25px;">적요</th>
                        
                        </tr>
                        </thead>
                        <tbody>
						<?
						$sql = "Select * From shipping_orderSub where out_no = '".$out_no."'";
						//echo $sql."<br>";  
						$result = mysql_query($sql);
						$cnt = mysql_num_rows($result);
						if ($result){
							if ($cnt>"0"){
								$ct=1;
								while($rows=mysql_fetch_array($result)) {
									$idx		=$rows["idx"];					
									$ord_no		=$rows["ord_no"];
									$rel_no		=$rows["rel_no"];
									$prod_cd	=$rows["prod_cd"];
									$prod_des	=$rows["prod_des"];
									$size_des	=$rows["size_des"];
									$uqty		=$rows["uqty"];
									$qty		=$rows["qty"];
									$remarks	=$rows["remarks"];
									$regdate	=$rows["regdate"];

									$UqtyTotal = $UqtyTotal + $uqty;
									$QtyTotal  = $QtyTotal  + $qty;
								?>	
						<tr style="height:20px;"><td class=' left font11px' style='overflow:hidden' ><?=$prod_des?></td><td class=' right font11px' style='overflow:hidden' ><?=$qty?></td><td class=' left font11px' style='overflow:hidden' ><?=$remarks?></td></tr>
						<?
						}
						}
						?>
						<? 
						$limitcnt = 20 - $cnt;
						for($i=1;$i<$limitcnt;$i++){?>
						<tr style="height:20px;"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
						<?}?>
						<?}?>
                        </tbody>
                    </table>
                    <!-- 품목리스트 끝 -->
                    <table border="0" cellspacing="0" cellpadding="0" style="margin:5px 0px 0px 0px; width:650px; font-size:12px; color:#000; line-height:14px; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed">  <colgroup><col style="width:150px" /><col style="width:200px" /><col style="width:150px" /><col /></colgroup>      <tbody>          <tr>     <td style="padding:4px 0 2px 0; text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">수량</td>              <td style="padding:4px 0 2px 0; text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=$QtyTotal?>&nbsp;</td>     <td style="padding:4px 0 2px 0; text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">인수</td>              <td style="padding:4px 0 2px 0; text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000">인&nbsp;</td>          </tr>      </tbody>  </table>
                    

                    </div>
                     
                        </div>
                        </div>
                        
                            </div>
                        
        <!-- for문 끝 -->
        </div>
        </div>
        </center>
        
    </div>
  </div>  
    
    <form id="frmDetail">
        <input name="hidSearchXml" type="hidden" id="hidSearchXml" value="20160711-2;2;100" />
        <input type="hidden" name="formser" id="formser" value="0" />
        <input type="hidden" name="basicFormser" id="basicFormser" value="1000" />
        <input name="cust" type="hidden" id="cust" value="1111111111" />
        <input name="cust_des" type="hidden" id="cust_des" value="이카건설" />
        <input name="amount" type="hidden" id="amount" />
        <input name="amount_des" type="hidden" id="amount_des" />
        <input type="hidden" name="foreign_flag" id="foreign_flag" value="0" />
        <input type="hidden" name="basic_type" id="basic_type" value="0" />
        <input type="hidden" name="edms_flag" id="edms_flag" value="N" />
    </form>
    <iframe name="ifrmExcel" style="width:0px; height:0px; visibility:hidden;" ></iframe>
</body>
</html>

