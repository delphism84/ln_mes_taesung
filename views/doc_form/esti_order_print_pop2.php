
<?
//	if ($mode=="modify"){
	$sql = "Select * From esti_orders where num = ".$est_cd;
	//echo $sql."<br>"; 
	$result = mysql_query($sql);
	if ($result){
		//$cnt = mysql_num_rows($result);
		$ct=1;
		$row = mysql_fetch_array($result);	
			$num			=$row["num"];
			$ord_no			=$row["ord_no"];
			$rel_no			=$row["rel_no"];
			$rel_cd			=$row["rel_cd"];
			$rel_gubun		=$row["rel_gubun"];
			$rel_state		=$row["rel_state"];
			$cust_name		=$row["cust_name"];
			$cust_cd		=$row["cust_cd"];
			$emp_cd			=$row["emp_cd"];
			$emp_name		=$row["emp_name"];
			$wh_name		=$row["wh_name"];
			$wh_cd			=$row["wh_cd"];
			$io_type		=$row["io_type"];
			$foreign_type	=$row["foreign_type"];
			$pjt_cd			=$row["pjt_cd"];
			$ref_des		=$row["ref_des"];
			$coll_term		=$row["coll_term"];
			$agree_term		=$row["agree_term"];
			$DeliveryDateTime=$row["DeliveryDateTime"];					
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
		}

   
//	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>주문서 출력</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="robots" content="noindex,nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />

<link type='text/css' rel='stylesheet'href='/assets/css/2_layout.css?v=20160126090841' /><span></span>
<link type='text/css' rel='stylesheet'href='/assets/css/2_print.css?v=20150807092751' /><span></span>
<script type="text/javascript" src="/assets/js/jquery.js"></script>
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
		
		function ExcelPageMovement() {
				location.href = "/weberp/doc_form/excel/esti_order_list_excel.php?est_cd=<?=$est_cd?>";
        }

        function ExcelPageMovements(Url) {
				alert("준비중입니다.");
				$("#cate_code").focus();
				return false;
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
    <form method="post" action="./esti_order_print_pop.php?ec_req_sid=00JYjsUjyECI" id="form1">
    <div id="dHTMLToolTip" style="position: absolute; visibility: hidden; width:10; height: 10; z-index: 1000; left: 0; top: 0"></div>
    <div id="wrap_pop">
        
        <!-- 상단버튼 및 양식설정부분 시작 -->
        <div class="dual-btn-fixed  top-zero">
		    <div class="dual-btn-area">
			    <div class="float_left">
						<span class="btn blue-inverse"><input type="button" name="btnPrint" id="btnPrint" onclick="this.parentElement.style.display = 'none'; pageprint(); this.parentElement.style.display = ''; "  value="인쇄" /></span>
						<!--span class="btn gray"><input type="button" name="btn_excel" id="btn_excel" onclick="ExcelPageMovement('/ECMain/ESD/ESD002E.php');" value="Excel" /></span-->           <!-- 
						<span class="btn gray"><input type="button" name="btnPdf" id="btnPdf" value="PDF" onclick="fnPdfBeta();" /></span> -->
						<!-- <span class="btn gray"><input type="button" id="btnPreview" value="최적화" onclick="fnPrintControl();" /></span>
						<span class="btn gray" ><input type="button" name="btnMail" id="btnMail" onclick="fnMail();return false;" value="Email" /></span>
					   <span class="btn gray" ><input type="button" name="btnSend" id="btnSend" onclick="fnFax();return false;" value="Fax" /></span> 
						<iframe id="iFaxSend" name="iFaxSend" src="" scrolling="no" frameborder="0" style="width:530px; height:255px; left:200px; top:100px; position:absolute; display:none;"></iframe>-->
					</div>
                <div class="float_right">
                    
                </div>
            </div>

            
        </div>
        
        <!-- 상단버튼 및 양식설정부분 끝 -->
        
        <center>
        <div id="idPrint" class="p-relative" style="margin-top:80px">
		<div id='print_page'>
        <input type="hidden" id="hidHeightParam" name="hidHeightParam"  /> <!--종이 인쇄시 호환성일경우 Page Break시 hidHeightParam 지정된 높이를 사용함 -->  
        
                        <!--div class="virtualpage hidepiece" printtype="page"-->
                        <!--div id="rpt_contents_new"-->
                       
                    <!--p-absolute--><!--div class="p-absolute" style="top:0px; left:0px"><!--p-absolute--> 
                

                <!-- 결재방 -->
                
					<TABLE style="WIDTH: 650px; BORDER-COLLAPSE: collapse; MARGIN-BOTTOM: 5px; COLOR: #000; FONT-SIZE: 12px" border=0 cellSpacing=0 cellPadding=0>
						<TBODY>
							<TR>
							<TD style="TEXT-ALIGN: center; WIDTH: 99%; HEIGHT: 30px; FONT-SIZE: 20px; FONT-WEIGHT: bold"><U>거 래 명 세 서</U></TD>
							<TD style="WIDTH: 1%" align=right><table cellpadding='0' cellspacing='0' border='0' style='width:295px; margin:0px 0px 5px 0px; color:#000; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed'><tbody><tr><th style='font-size:12px; width:13px;padding:0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word' rowspan='2'>담당</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>부장</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>이사</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>상무</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>대표이사</th></tr><tr><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td></tr></tbody></table>
							</TD>
							</TR>
						</TBODY>
					</TABLE>
					<div style="width:650px; background:url(/MemberInfo/Logo/_G1080_10b67c8d73f21f8e98092e524e23a4e9_sign.gif) 100% 60px no-repeat">
						<table border="0" cellspacing="0" cellpadding="0" style="padding:0px; width:650px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse; table-layout:fixed">
							<colgroup>
								<col style="width:75px">
								<col style="width:220px">
								<col style="width:10px">
								<col style="width:75px">
								<col />
							</colgroup>
							<tbody>
								<tr>
									<th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">수 신</th>
									<td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;<?=$cust_name?></td>
									<td>&nbsp;</td>
									<td style="padding:3px 0px 2px 0px; text-align:center; border:1px solid #000" rowspan="3" colspan="2">&nbsp;&nbsp;</td>
								</tr>
								<tr>
									<th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; font-weight:bold">참 조</th>
									<td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$ref_des?></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; font-weight:bold">TEL/FAX</th>
									<td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;042-626-5151/042-626-5155</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
								</tr>
								<tr>
									<th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; font-weight:bold">결제조건</th>
									<td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$coll_term?>&nbsp;</td>
									<td>&nbsp;</td>
									<th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000">일련번호</th>
									<td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$ord_no?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
								</tr>
								<tr>
									<th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; font-weight:bold">유효기간</th>
									<td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$agree_term?>&nbsp;</td>
									<td>&nbsp;</td>
									<th rowspan="2" style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000">담당자</th>
									<td rowspan="2" style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$emp_name?></td>
								</tr>
								<tr>
									<th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; font-weight:bold">납기일자</th>
									<td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$DeliveryDateTime?>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
							</tbody>
						</table>
						<table style="width:650px; height:29px; margin:5px 0px; line-height:16px; font-size:14px; font-weight:bold; border:2px solid #000; border-collapse:collapse; table-layout:fixed">
							<tbody>
								<tr>
									<td style="padding:0px 0px 0px 30px;">금 액 :&nbsp;<?=num2kor(str_replace(",","",$TotalAmount))?>원정</TD>
									<td style="padding:0px 17px 0px 0px; text-align:right">(￦ <?=$TotalAmount?>원) / VAT포함</td>
								</tr>
							</tbody>
						</table>
					</div>
                
                <!-- TopSql 끝 -->
                <div style="margin-top:5px;"></div> 
                <!-- 품목리스트 시작 -->
                <table class="H_5px fixed" width="650px" border="0" cellspacing="0" cellpadding="1px" style="border-width:1px; border-style:solid; border-color:#333333;table-layout:fixed;word-break:break-all; word-wrap: break-word; margin-top:0px;"><thead><tr align="center" bgcolor="#ececec" style="height:25px;"><th width="53" style="border-width:1px;  border-right-style:solid; border-color:#999999;"><strong>품목코드</strong></th><th width="371" style="border-width:1px;  border-right-style:solid; border-color:#999999;"><strong>품목명</strong></th><th width="34" style="border-width:1px;  border-right-style:solid; border-color:#999999;"><strong>수량</strong></th><th width="53" style="border-width:1px;  border-right-style:solid; border-color:#999999;"><strong>단가</strong></th><th width="53" style="border-width:1px;  border-right-style:solid; border-color:#999999;"><strong>공급가액</strong></th><th width="55" style="border-width:1px;  border-color:#999999"><strong>부가세</strong></th></tr></thead><tbody>
				<?
					$sql = "Select * From esti_ordersSub where ord_no = '".$ord_no."'";
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
				<tr style="height:19px;"><td class=" left font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999; overflow:hidden"><?=$prod_cd?></td><td class=" left font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999; overflow:hidden"><?=$prod_des.$unit?></td><td class=" right font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999; overflow:hidden"><?=number_format($qty)?></td><td class=" right font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999; overflow:hidden"><?=number_format($price)?></td><td class=" right font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999; overflow:hidden"><?=number_format($supply_amt)?></td><td class=" right font11px" bgcolor="#FFFFFF" style="border-width:1px; border-top-style:solid; border-color:#999999; overflow:hidden"><?=number_format($vat_amt)?></td></tr>
				<?
							$ct++;
							}
						}
						?>
						<? 
						$limitcnt = 25 - $cnt;
						for($i=1;$i<$limitcnt;$i++){?>
				<tr height="25px"><td class='left font11px'  style="padding-top:1px; padding-bottom:1px;border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999;">&nbsp;</td><td class='left font11px'  style="padding-top:1px; padding-bottom:1px;border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999;">&nbsp;</td><td class='right font11px'  style="padding-top:1px; padding-bottom:1px;border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999;">&nbsp;</td><td class='right font11px'  style="padding-top:1px; padding-bottom:1px;border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999;">&nbsp;</td><td class='right font11px'  style="padding-top:1px; padding-bottom:1px;border-width:1px; border-top-style:solid;border-right-style:solid; border-color:#999999;">&nbsp;</td><td class='right font11px'  style="padding-top:1px; padding-bottom:1px;border-width:1px; border-top-style:solid; border-color:#999999;">&nbsp;</td></tr>
				<?}?>
						<?}?>
				</tbody></table>
                <!-- 품목리스트 끝 -->
                
                
                <div style="margin-top:5px;"></div>               
                <table border="0" cellspacing="0" cellpadding="0" style="width:650px; height:27px; margin:5px 0px 0px 0px; font-size:12px; color:#000; line-height:14px; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed">
					<colgroup><col style="width:51px" /><col style="width:75px" /><col style="width:63px" /><col style="width:108px" /><col style="width:44px" /><col style="width:94px" /><col style="width:57px" /><col /></colgroup>
					<tbody>
						<tr>
							<td style="text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">수량</td>
							<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=$ct?>&nbsp;</td>
							<td style="text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">공급가액</td>
							<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=$AmountTotal?>&nbsp;</td>
							<td style="text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">VAT</td>
							<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=$TaxTotal?>&nbsp;</td>
							<td style="text-align:center; font-weight:bold; background:#ececec; word-wrap:break-word; border-right:1px solid #000; border-bottom:1px solid #000">합계</td>
							<td style="text-align:right; word-wrap:break-word; border-right:#000 1px solid; border-bottom:1px solid #000"><?=$TotalAmount?>&nbsp;</td>
						</tr>
					</tbody>
				</table>
                
                <table summary="" class="listgray"  align="center"  style="width:650px" id="tblLinks">
                <col width="130" /><col width="" />
                  <!-- for (int u = 0; u < dtLinkData.Rows.Count;u++) end -->
                </table>
                  <!-- if (iloop_cnt == 1) end -->
                          
                <!--/div-->
                 
                    <!--/div-->
                    <!--/div-->
                
        <!-- for문 끝 -->
        </div>
        </div>
        </center>
        </div>
        
        

    <div id="div_hidden" name="div_hidden" style="display:none;">
        <input name="hidData" type="text" id="hidData" value="20161223-1;1;0;100;1" />
        <input name="hidReqInfo" type="text" id="hidReqInfo" value="20161223-1" />
        <input name="hidAppLevel" type="text" id="hidAppLevel" value="&lt;table align=&#39;center&#39; width=&#39;650&#39; border=&#39;0&#39; cellspacing=&#39;0&#39; cellpadding=&#39;0&#39;>&lt;tr>&lt;td align=&#39;right&#39;>&lt;table cellpadding=&#39;0&#39; cellspacing=&#39;0&#39; border=&#39;0&#39; style=&#39;width:295px; margin:0px 0px 5px 0px; color:#000; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed&#39;>&lt;tbody>&lt;tr>&lt;th style=&#39;font-size:12px; width:13px;padding:0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word&#39; rowspan=&#39;2&#39;>결재&lt;/th>&lt;th style=&#39;font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word&#39;>결재&lt;/th>&lt;th style=&#39;font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word&#39;>라인&lt;/th>&lt;th style=&#39;font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word&#39;>설정&lt;/th>&lt;th style=&#39;font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word&#39;>가능&lt;/th>&lt;/tr>&lt;tr>&lt;td style=&#39;height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word&#39;>&amp;nbsp;&lt;/td>&lt;td style=&#39;height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word&#39;>&amp;nbsp;&lt;/td>&lt;td style=&#39;height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word&#39;>&amp;nbsp;&lt;/td>&lt;td style=&#39;height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word&#39;>&amp;nbsp;&lt;/td>&lt;/tr>&lt;/tbody>&lt;/table>&lt;/td>&lt;/tr>&lt;/table>&lt;br>" />
        <input name="hidTopSql" type="text" id="hidTopSql" value="notnull" />
        <input name="hid_Word" type="hidden" id="hid_Word" />
        <input type="hidden" id="pdata" name="pdata" value="20161223-1" />
        <input name="wh_cd" type="hidden" id="wh_cd" />
        <input name="wh_cd2" type="hidden" id="wh_cd2" value="100" />
        <input type="hidden" id="hidChangeCnt" name="hidChangeCnt" value="0" />        
        <input name="hidPageMargin" type="hidden" id="hidPageMargin" value="@page{size:A4;margin-top:13mm;margin-left:19.3mm;margin-right:4.6mm;margin-bottom:5.3mm;}@media print{html,body{min-width:186.1mm;overflow:hidden;}thead {display: table-header-group;}}" />
		<input name="hidPdfMargin" type="hidden" id="hidPdfMargin" value="13∬5.3∬19.3∬4.6" />
		<input name="hidSelPaper" type="hidden" id="hidSelPaper" value="A4" />
		<input name="hidDirection" type="hidden" id="hidDirection" value="P" />
    </div> 
    </form>
    
    <form id="frmDetail">
        <input name="hidSearchXml" type="hidden" id="hidSearchXml" value="20161223-1;1;0;100;1" />
        <input type="hidden" name="formser" id="formser" value="0" />
        <input type="hidden" name="basicFormser" id="basicFormser" value="1000" />
        <input name="cust" type="hidden" id="cust" />
        <input name="cust_des" type="hidden" id="cust_des" value="이카교육" />
        <input name="amount" type="hidden" id="amount" />
        <input name="amount_des" type="hidden" id="amount_des" />
        <input type="hidden" name="foreign_flag" id="foreign_flag" value="0" />
        <input type="hidden" name="basic_type" id="basic_type" value="0" />
        <input type="hidden" name="basic_type2" id="basic_type2" value="0" />
        <input type="hidden" name="edms_flag" id="edms_flag" value="N" />        
    </form>
    <iframe name="ifrmExcel" style="width:0; height:0px" ></iframe>
    
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

