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
	$sql = "Select * From porder left join pordersub on porder.pord_no = pordersub.pord_no where pd_idx = ".$idx;	
    $result = mysql_query($sql);
	
	$rowPorder = mysql_fetch_array($result);  

	$rowProduct = mysql_fetch_array(mysql_query("select * from Product where itemcd = '{$rowPorder['prod_cd']}' ")); 

	$rowClient = mysql_fetch_array(mysql_query("select * from client where custcd = '{$rowProduct['custom_code']}'"));


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
			//window.onbeforeprint = beforePrint; 
			//window.onafterprint = afterPrint; 
			$(".dual-btn-fixed").hide();
			window.print(); 
			$(".dual-btn-fixed").show();
	}

	function onSendEmail() 
	{
		<? if (empty($rowClient['email'])) { ?>
			alert('업체의 이메일 주소를 설정해주세요.');
			return;
		<? } ?>
		$('#param').val($('#printContents').html());

		var param = $('#form1').serialize();

		$('#loadbar').show();

		$.ajax({
			type: 'post'
			, url: 'sendPorderEmail.php'
			, data: param
			, dataType: 'json'
			, success: function(data) {
				if(data['pid'] == '1')
					alert('이메일 전송완료');
				else 
					alert("이메일 전송에러!");
				$('#loadbar').hide();
			}
			, error: function(data, status, err) {
				alert("이메일 전송에러!");
				$('#loadbar').hide();
			}
			, complete: function() {}
    	});		
	}
    </script>
<body>    
    <div id="dHTMLToolTip" style="position: absolute; visibility: hidden; width:10; height: 10; z-index: 1000; left: 0; top: 0"></div>	
	<form method="post" action="sendPorderEmail.php" id="form1">
		<input type='hidden' name='param' id='param'>		
		<input type='hidden' name='mailto' id='mailto' value='<?=$rowClient['email']?>'>		
		<input type='hidden' name='mailfrom' id='mailfrom' value='<?=$company_email?>'>		
		<input type='hidden' name='mailtitle' id='mailtitle' value='발주서입니다.'>		
	</form>
    <div id="wrap_pop">
        <!-- 상단버튼 및 양식설정부분 시작 --> 
        <div class="dual-btn-fixed top-zero">
		    <div class="dual-btn-area">
			    <div class="float_left">                    
                   	<span class="btn blue-inverse"><input type="button" name="btnPrint" id="btnPrint" onclick="pageprint();"  value="인쇄" /></span>
					<span class="btn gray"><input type="button" name="btn_email" id="btn_email" onclick="onSendEmail();" value="메일보내기" /></span>  
					<? 
						if (empty($rowClient['email'])) {
							echo "({$rowClient['customer_name']}의 이메일 주소가 없습니다.)";
						} else {
							echo "(이메일주소 : {$rowClient['email']})";
						}
					?>					
					<span id='loadbar' style='display:none'><img src='/weberp/img/ajax-loaderbar.gif'></span>      
					<!--span class="btn gray"><input type="button" name="btnPdf" id="btnPdf" value="PDF" onclick="fnPdfBeta();" /></span-->                    
                </div>
            </div>
            <!-- 인쇄옵션 끝 -->
        </div>
        <!-- 인쇄옵션 끝 -->
		<style>
			.tdMenu {
				BACKGROUND: #f7f7f7
			}
			.center {
				text-align:center;
			}
			.right {
				text-align:right;
			}	
			.tbPadding5px {
				padding:5px 0;
			}
		</style>
        <center>
		<div id='print_page'>
			<div id="idPrint" class="p-relative" style="margin-top:25px">
				<input type="hidden" id="hidHeightParam" name="hidHeightParam"  /> <!--종이 인쇄시 호환성일경우 Page Break시 hidHeightParam 지정된 높이를 사용함 -->      
				<div class="virtualpage hidepiece" printtype="page">
					<div id="rpt_contents_new">
						<div class="p-absolute" style="top:0px; left:0px">   
							<div id='printContents'>								
								<table border="1" style="LINE-HEIGHT: 14px; WIDTH: 650px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; COLOR: #000; FONT-SIZE: 12px;">
									<colgroup>
										<col width="10%" />
										<col width="3%" />
										<col width="24%" />
										<col width="6%" />
										<col width="6%" />
										<col width="14%" />
										<col width="7%" />
										<col width="12%" />
										<col width="7%" />
										<col width="14%" />
									</colgroup>
									<tbody>
										<tr height="80" rowspan="2">
											<td align="center" colspan="10"><span style="font-size: 28px;"><strong><u>발 &nbsp; &nbsp; &nbsp;주 &nbsp; &nbsp; &nbsp;서</u></strong></span></td>
										</tr>
										<tr>
										</tr>
										<tr>
											<td colspan="10" style="padding:5px 5px;">발 주 번 호 : <?=$rowPorder['pord_no']?></td>
										</tr>
										<tr>
											<td rowspan="2" class="center tdMenu">수 신 처</td>
											<td colspan="2" rowspan="2" class="center"><?=$rowClient['customer_name']?></td>
											<td class="center tdMenu">T.E.L</td>
											<td colspan="2" class="center tbPadding5px"><?=$rowClient['telno']?>&nbsp;</td>
											<td colspan="2" rowspan="2" class="center tdMenu">담 당 자</td>
											<td colspan="2" rowspan="2" class="center"><?=$rowClient['duty_name']?>&nbsp;</td>
										</tr>
										<tr>
											<td class="center tdMenu">F.A.X</td>
											<td colspan="2" class="center tbPadding5px"><?=$rowClient['fax']?>&nbsp;</td>
										</tr>
										<tr>
											<td rowspan="2" class="center tdMenu">발 신 처</td>
											<td colspan="2" rowspan="2" class="center"><?=$company_full_name?>&nbsp;</td>
											<td class="center tdMenu">T.E.L</td>
											<td colspan="2" class="center tbPadding5px"><?=$company_tel?>&nbsp;</td>
											<td colspan="2" rowspan="2" class="center tdMenu">담 당 자</td>
											<td colspan="2" rowspan="2" class="center"><?=$rowPorder['emp_name']?>&nbsp;</td>
										</tr>
										<tr>
											<td class="center tdMenu">F.A.X</td>
											<td colspan="2" class="center tbPadding5px"><?=$company_fax?>&nbsp;</td>
										</tr>
										<tr>
											<td class="center tdMenu tbPadding5px">발 주 일</td>
											<td colspan="2" class="center"><?=date('Y-m-d')?>&nbsp;</td>
											<td colspan="2" class="center tdMenu">발주처주소</td>
											<td colspan="5" >대전광역시 서구 복수동로 87번길 13-6 OTS빌딩 202호</td>
										</tr>
										<tr>
											<td class="center tdMenu tbPadding5px">납 기 일</td>
											<td colspan="2" class="center"><?=$rowPorder['req_date']?>&nbsp;</td>
											<td colspan="2" class="center tdMenu">특 기 사 항</td>
											<td colspan="5">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="2" class="center tdMenu tbPadding5px">품 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 명<br />DISCRIPTION</td>
											<td class="center tdMenu tbPadding5px">규 &nbsp; &nbsp; &nbsp; &nbsp;격<br />SIZE</td>
											<td class="center tdMenu tbPadding5px">단 위<br />Q.TY</td>
											<td class="center tdMenu tbPadding5px">수 량<br />UNIT</td>
											<td colspan="2" class="center tdMenu tbPadding5px">단 &nbsp; &nbsp; &nbsp; &nbsp;가<br />UNIT PRICE</td>
											<td colspan="2" class="center tdMenu tbPadding5px">금 &nbsp; &nbsp; &nbsp; &nbsp;액<br />AMOUNT</td>
											<td class="center tdMenu tbPadding5px">비 &nbsp; 고<br />REMARK</td>
										</tr>
										<?
											$sql = "select * from pordersub a left join product b on a.prod_cd = b.itemcd where a.pord_no = '{$rowPorder['pord_no']}' and b.custom_code = '{$rowProduct['custom_code']}'";
											$resOrderList = mysql_query($sql);

											$sumPrice = 0;
											$rowCnt = 0;
											$sumTax = 0;
											
											while($row = mysql_fetch_array($resOrderList)) {
												
												$sumPrice = $sumPrice + $row['price']*$row['qty'];

												if ($row['vat_free'] == '1') {

												} else {
													if ($rowPorder['io_type'] == '00') $sumTax = $sumTax + intval(($row['price']*$row['qty']) * 0.1);
												}
										?>
										<tr>
											<td colspan="2" class="tbPadding5px"><?=$row['prod_des']?></td>
											<td><?=$row['standard']?></td>
											<td class="center"><?=$row['unit']?></td>
											<td class="center"><?=$row['qty']?></td>
											<td colspan="2" class="right"><?=number_format($row['price'])?>&nbsp;</td>
											<td colspan="2" class="right"><?=number_format($row['price']*$row['qty'])?>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<?
												$rowCnt++;
											}

											for(; $rowCnt < 13; $rowCnt++) {
										?>
										<tr>
											<td colspan="2" class="tbPadding5px">&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td colspan="2">&nbsp;</td>
											<td colspan="2">&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<?
											}

											$p_des = str_replace(PHP_EOL, "<br>", $rowPorder['p_des']);
										?>
										<tr>
											<td colspan="2" class="center tdMenu tbPadding5px"><strong>소 &nbsp; &nbsp; 계</strong></td>
											<td colspan="5" rowspan="3">&nbsp;</td>
											<td colspan="3" class="right"><?=number_format($sumPrice)?>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="2" class="center tdMenu tbPadding5px"><strong>부 가 세</strong></td>
											<td colspan="3" class="right"><?=number_format($sumTax)?>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="2" class="center tdMenu tbPadding5px"><strong>합 &nbsp; &nbsp; 계</strong></td>
											<td colspan="3" class="right"><strong><?=number_format($sumPrice + $sumTax)?></strong>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="10" rowspan="2" class="tbPadding5px" style="line-height:170%;padding-left:10px;">
											<?=$p_des?>
											</td>
										</tr>
										<tr>
										</tr>
										<tr>
											<td colspan="10" rowspan="2" class="tbPadding5px">
											<div>&nbsp; * 붙 임 서 류 :</div>
											</td>
										</tr>
										<tr>
										</tr>
										<tr>
											<td colspan="10" rowspan="2" class="tbPadding5px">
											<div>&nbsp; * 현 장 명 :</div>
											</td>
										</tr>
										<tr>
										</tr>
									</tbody>
								</table>



							</div>					
						</div>
					</div>
				</div>
	        </div>
        </div>
        </center>        
    </div>  
    <iframe name="ifrmExcel" style="width:0px; height:0px; visibility:hidden;" ></iframe>
</body>
</html>

