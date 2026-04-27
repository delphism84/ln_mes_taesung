<?php
	include_once("../common.php"); // 기본 파일
	include_once("../inc/dbconfig.php"); 
	include_once("../inc/func.php");  // 함수 파일
	//header("Content-type: text/html; charset=UTF-8"); 

	if (!$is_member){
		goto_url("/login.php");
		exit;
	}

	$sql = "select * from esti_orders left join client on client.custcd = esti_orders.cust_cd where num = $est_cd ";
	$rowEstOrder = mysql_fetch_array(mysql_query($sql));


	$rel_no = substr($rowEstOrder['rel_date'], 0, 4).'/'.substr($rowEstOrder['rel_date'], 4, 2).'/'.substr($rowEstOrder['rel_date'], 6, 2).'-'.$rowEstOrder['rel_no'];
	
	$sql = "select * from estimate where rel_no = '$rel_no'";
	$rowEstimate = mysql_fetch_array(mysql_query($sql));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>영업팀 생산의뢰서</title>
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
<style>
	.fNanum {font-family:나눔고딕,nanum gothic,ng,sans-serif}
	.center {text-align:center}
	li {margin: 10px 0;}
	.padl15 {padding-left:15px}
</style>
</head>
<body>
    <div id="dHTMLToolTip" style="position: absolute; visibility: hidden; width:10; height: 10; z-index: 1000; left: 0; top: 0"></div>
    <div id="wrap_pop">        
        <!-- 상단버튼 및 양식설정부분 시작 -->
        <div class="dual-btn-fixed  top-zero">
		    <div class="dual-btn-area">
			    <div class="float_left">
						<span class="btn blue-inverse"><input type="button" name="btnPrint" id="btnPrint" onclick="pageprint(); "  value="인쇄" /></span>
					</div>
                <div class="float_right">
                    
                </div>
            </div>            
        </div>
        
        <!-- 상단버튼 및 양식설정부분 끝 -->        
        <center>
        <div id="idPrint" class="p-relative" style="margin-top:40px">
			<div id='print_page'>
			<center>
				<table border="0" class='fNanum' style="width: 650px; color: rgb(0, 0, 0); margin-bottom: 5px; border-collapse: collapse;">
					<tbody>
						<tr>
							<td class='center'>
								<div class='center'>
									<strong><span style="font-size: 28px;" ><u>영 업 팀 &nbsp;생 산 의 뢰 서</u></span></strong>
								</div>
								<div align="center" style="margin-top:30px">
									<table border="1" cellpadding="5" cellspacing="1" style="width: 630px;">
									<tr>
										<td colspan='6'>1) 생산의뢰사항</td>
									</tr>
									<tr>
										<td class='center' colspan='2' style="width:100px;">고객사</td>
										<td style="width:215px;"><?=$rowEstOrder['cust_name']?></td>
										<td class='center' style="width:100px;">주문일자</td>
										<td colspan='2' style="width:215px;"><?=$rowEstOrder['ord_no']?></td>
									</tr>							
									<tr>
										<td class='center'colspan='2'>담당자</td>
										<td><?=$rowEstOrder['duty_name']?>(<?=$rowEstOrder['mobileno']?>)</td>
										<td class='center'>납기일자</td>
										<td colspan='2'><?=$rowEstOrder['DeliveryDateTime']?></td>
									</tr>		
									<tr>
										<td class='center' style="width:50px;">구분</td>
										<td class='center' colspan='3'>모델명</td>
										<td class='center' >수량</td>
										<td class='center' >단위</td>										
									</tr>		
									<?
										$sql = "select * from esti_orderssub where ord_no = '{$rowEstOrder['ord_no']}'";
										
										$resEstOrderSub = mysql_query($sql);
										$totQty = 0;
										$rowCnt = 1;
										while($resEstOrderSub && $row = mysql_fetch_array($resEstOrderSub)) {
									?>
									<tr>
										<td class='center'><?=$rowCnt?></td>
										<td colspan='3'><?=$row['prod_des']?></td>
										<td><?=$row['qty']?></td>
										<td><?=$row['unit']?></td>										
									</tr>
									<?
											$totQty += $row['qty'];
											$rowCnt++;
										}

										for($i=$rowCnt; $i <= 10; $i++) {
									?>
									<tr>
										<td class='center'><?=$i?></td>
										<td colspan='3'></td>
										<td></td>
										<td></td>										
									</tr>
									<?
										}

										//$rowClient = mysql_fetch_array(mysql_query("select * from client where custcd = '{$rowEstimate['cust_cd']}'"));
										$p_des = str_replace(PHP_EOL, "<br>", $rowEstOrder['p_des']);
									?>
									<tr>
										<td colspan='6'>2) 특이사항(비고)</td>
									</tr>		
									<tr>
										<td colspan='6' style='padding-left:15px;height:400px;vertical-align:text-top;line-height:130%'>
											<pre><?=$p_des?></pre>
											<!--ul style='list-style-type: none;'>
												<li>▶ 제어방식</li>												
												<li class='padl15'>&nbsp;</li>												
												<li>▶ 카메라 정보</li>												
												<li class='padl15'>&nbsp;</li>												
												<li>▶ 발주처 정보</li>												
												<li class='padl15'></li>												
												<li>▶ 납품 장소</li>												
												<li class='padl15'>&nbsp;</li>												
												<li>▶ 기타 사항</li>												
												<li class='padl15'>&nbsp;</li>												
											</ul-->											
										</td>
									</tr>							
									</table>						
									<div class='center' style="margin-top:10px">
									<strong><span style="font-size: 16px;" >(주)오티에스 영업팀</span></strong>
									</div>									
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				</center>
			</div>
		</div>
	</div>
</body>
<style type="text/css"> 
	td.head {
		text-align: center; 
		background-color: rgb(216, 216, 216);		
	}
	.list {
		font-size: 13px;
	}
	.center {text-align:center}
	@page {
		size:A4;
		margin-top:13mm;
		margin-left:4.2mm;
		margin-right:4.6mm;
		margin-bottom:5.3mm;
	}
	@media print{
		html,body {
			min-width:201.2mm;
			overflow:hidden;
		}
		thead {
			display: table-header-group;
		}
        .dual-btn-fixed {
			display:none;
		}		
	}
</style>
</html>

