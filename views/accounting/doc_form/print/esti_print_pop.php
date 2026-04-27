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
	$sql = "Select * From estimate where num = ".$est_cd;
	//echo $sql."<br>"; 
	$result = mysql_query($sql);

	if ($result){
		//$cnt = mysql_num_rows($result);
		$ct=1;
		$row = mysql_fetch_array($result);	
		$num			=$row["num"];
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
		$regdate		=$row["regdate"];

		$rowClient = mysql_fetch_array(mysql_query("select * from client where custcd = '{$cust_cd}'"));
	}

   
//	}
	$sql = "SELECT hpone FROM member WHERE id='".$emp_cd."'";
	$result = mysql_query($sql);
	if($result) {
		$row = mysql_fetch_array($result);
		$hpone = $row["hpone"];
		$pNumber = substr($hpone,0,3)."-".substr($hpone,3,4)."-".substr($hpone,7,4);
	}
		
		
	$sql = "SELECT team_name FROM team WHERE team_sn = (SELECT team_sn FROM member WHERE id = '".$emp_cd."')";
	$result = mysql_query($sql);
	if ($result) {
		
		$row = mysql_fetch_array($result);
			$team_name = $row["team_name"]; 
	}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>견적서 출력</title>
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
			//window.onbeforeprint = beforePrint; 
			//window.onafterprint = afterPrint; 
			window.print(); 
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
	<style>
	@media print
	{    
		.dual-btn-fixed
		{
			display: none !important;
		}
	}	
	td {padding: 4px 0;}
	</style>
	</head>	
	<body>
		<form method="post" action="sendPorderEmail.php" id="form1">
			<input type='hidden' name='param' id='param'>		
			<input type='hidden' name='mailto' id='mailto' value='<?=$rowClient['email']?>'>		
			<input type='hidden' name='mailfrom' id='mailfrom' value='<?=$company_email?>'>		
			<input type='hidden' name='mailtitle' id='mailtitle' value='<?=$company_full_name?> 견적서입니다.'>		
		</form>		

		<script type="text/javascript">
		//<![CDATA[
		var theForm = document.forms['form1'];
		if (!theForm) {
			theForm = document.form1;
		}
		//]]>
		</script>
		<div id="wrap_pop">
			<!-- 상단버튼 및 양식설정부분 시작 -->
			<div class="dual-btn-fixed top-zero">
				<div class="dual-btn-area">
					<div class="float_left">
						<span class="btn blue-inverse"><input type="button" name="btnPrint" id="btnPrint" onclick="this.parentElement.style.display = 'none'; pageprint(); this.parentElement.style.display = ''; "  value="인쇄" /></span>
						<span class="btn gray"><input type="button" name="btn_email" id="btn_email" onclick="onSendEmail();" value="메일보내기" /></span>  
						<? 
							if (empty($rowClient['email'])) {
								echo "({$rowClient['customer_name']}의 이메일 주소가 없습니다.)";
							} else {
								echo "(이메일주소 : {$rowClient['email']})";
							}
						?>					
						<span id='loadbar' style='display:none'><img src='/weberp/img/ajax-loaderbar.gif'></span>  						
					</div>
            </div>
		</div>
        <!-- 상단버튼 및 양식설정부분 끝 -->
        <br /><br />
		<center>
		<div id="printContents">
			<table border="1" style="width: 650px; border-collapse: collapse; margin-bottom: 5px;">
				<tbody>
					<tr>
						<td colspan="4" rowspan="4" height="70px" style="text-align: center;"><img src="http://<?=$_SERVER['HTTP_HOST']?>/weberp/img/logo.png"></img></td>
						<td colspan="3" rowspan="2" style="text-align: center;"><span style="font-size:22px;"><strong><u>견 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;적 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;서</u></strong></span></td>
					</tr>
					<tr style="text-align: center;">
					</tr>
					<tr>
						<td colspan="3" rowspan="2" style="text-align: center;">(ISO 9001, ISO 14001인증업체)<br />
						(유망중소기업선정업체)</td>
					</tr>
					<tr>
					</tr>
					<tr>
						<td colspan="7" style="border:0px; !important;">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp; <u>고 객 명</u></td>
						<td colspan="5" style="text-align: center;"><strong>주식회사 오티에스 &nbsp; &nbsp; &nbsp; [ www.ots.co.kr ]</strong></td>
					</tr>
					<tr>
						<td colspan="2" rowspan="2" style="text-align: right;"><strong><?=$cust_name?> 貴中&nbsp;</strong></td>
						<td colspan="5" style="text-align: center;"><strong><?=$company_address?></strong></td>
					</tr>
					<tr>
						<td colspan="5" style="text-align: center;"><strong>TEL : <?=$company_tel?> FAX : <?=$company_fax?></strong></td>
					</tr>
					<tr>
						<td style="text-align: center;">견 적 번 호</td>
						<td style="text-align: center;"><?=$rel_no?></td>
						<td colspan="2" style="text-align: center;">사 업 자 번 호</td>
						<td colspan="3">&nbsp; <?=$company_reg_no?></td>
					</tr>
					<tr>
						<td style="text-align: center;">견 적 일 자</td>
						<td style="text-align: center;"><?=$regdate?></td>
						<td colspan="2" style="text-align: center;">대 &nbsp; 표 &nbsp; 이 &nbsp; 사</td>
						<td colspan="3">
							&nbsp; 송 &nbsp; &nbsp; 무 &nbsp; &nbsp; 상
							<div style="position:absolute">
								<img src="http://<?=$_SERVER['HTTP_HOST']?>/userfiles/stampimg/stamp.png" style="width:40px;margin:-25px 0 0 80px;">
							</div>							
						</td>
					</tr>
					<tr>
						<td style="text-align: center;">부서 / 담당</td>
						<td style="text-align: center;"><?=$team_name?> / <?=$emp_name?></td>
						<td colspan="2" style="text-align: center;">업 &nbsp; &nbsp; &nbsp; &nbsp;태</td>
						<td colspan="3">&nbsp; <?=$company_biz_condition?></td>
					</tr>
					<tr>
						<td style="text-align: center;">H. P</td>
						<td style="text-align: center;"><?=$pNumber?></td>
						<td colspan="2" style="text-align: center;">종 &nbsp; &nbsp; &nbsp; &nbsp;목</td>
						<td colspan="3">&nbsp; <?=$company_biz_status?></td>
					</tr>
					<tr>
						<td colspan="7" style="border:0px; !important;">&nbsp;</td>
					</tr>
					<tr>
						<td style="text-align: center;">공 사 현 장</td>
						<td colspan="6" style="text-align: center;">&nbsp;</td>
					</tr>
					<tr>
						<td style="text-align: center;">공 사 명</td>
						<td colspan="6" style="text-align: center;">&nbsp;</td>
					</tr>
					<tr>
						<td style="text-align: center;">공 사 금 액</td>
						<td colspan="4">일금 <?=num2kor(str_replace(",","",$TotalAmount))?>원정 [V.A.T 포함]</td>
						<td style="border-left:none;" colspan="2"><strong>￦ <?=$TotalAmount?>원</strong></td>
					</tr>
					<tr>
						<td colspan="7" style="border:0px; !important;">&nbsp;</td>
					</tr>
					<tr>
						<td rowspan="2" style="text-align: center;" width="20%"><strong>품 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 명</strong><br />
						DISCRIPTION</td>
						<td rowspan="2" style="text-align: center;" width="19%"><strong>규 &nbsp; &nbsp; &nbsp;격</strong><br />
						SIZE</td>
						<td rowspan="2" style="text-align: center;" width="8%"><strong>수 &nbsp;량</strong><br />
						Q.TY</td>
						<td rowspan="2" style="text-align: center;" width="7%"><strong>단 &nbsp;위</strong><br />
						UNIT</td>
						<td rowspan="2" style="text-align: center;" width="21%"><strong>단 &nbsp; &nbsp; &nbsp;가</strong><br />
						UNIT PRICE</td>
						<td rowspan="2" style="text-align: center;" width="17%"><strong>금 &nbsp; &nbsp; &nbsp;액</strong><br />
						AMOUNT</td>
						<td rowspan="2" style="text-align: center;" width="8%"><strong>비 &nbsp;고</strong><br />
						REMARK</td>
					</tr>
					<tr></tr>
			<?
			$sql = "Select * From estimateSub where rel_no = '".$rel_no."'";
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
									<!-- 품목리스트 시작 -->
					<tr>
						<td align="center"><?=$prod_des?></td>
						<td align="center"><?=$size_des?></td>
						<td align="center"><?=number_format($qty)?></td>
						<td align="center"><?=$unit?>
						<td align="center"><?=number_format($price)?></td>
						<td align="center"><?=number_format($supply_amt)?></td>
						<td align="center"></td>
					</tr>
			<?
						$ct++;
					}
				}

				$p_des = str_replace(PHP_EOL, "<br>", $p_des);
				$brCnt = substr_count($p_des, "<br>");

				if ($brCnt > 4) 
					$emptyRows = 15 - ($brCnt - 4);
				else 
					$emptyRows = 15;

				$limitcnt = $emptyRows - $cnt;

				for ($i=1; $i < $limitcnt; $i++) {
			?>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			<?
				}
	
			}

			
			?>
					<tr>
						<td colspan="7" style="height:70px;border:0px;vertical-align:top;padding:5px;">비고 :<br><?=$p_des?>&nbsp;</td>
					</tr>
					<tr>
						<td style="text-align: center;">견적유효기간</td>
						<td style="text-align: center;">발행 후 1개월</td>
						<td colspan="2" style="text-align: center;">소 계</td>
						<td colspan="3" style="text-align: center;"><?=$AmountTotal?></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center;"><?=$agree_term?></td>
						<td colspan="2" style="text-align: center;">부가세</td>
						<td colspan="3" style="text-align: center;"><?=$TaxTotal?></td>
					</tr>
					<tr>
						<td style="text-align: center;">특 기 사 항</td>
						<td style="text-align: center;">단 수 처 리</td>
						<td colspan="2" rowspan="2" style="text-align: center;">합 계</td>
						<td colspan="3" rowspan="2" style="text-align: center;"><?=$TotalAmount?></td>
					</tr>
					<tr>
						<td style="text-align: center;">&nbsp;</td>
						<td style="text-align: center;">0</td>
					</tr>
					<tr>
						<td align="right" colspan="7" style="border:0px; !important;"><strong>OTS &nbsp;㈜ 오티에스</strong></td>
					</tr>
				</tbody>
			</table>
		</center>
		</div>

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
    <iframe name="ifrmExcel" style="width: 0px; height: 0px; visibility:hidden;"></iframe>
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
