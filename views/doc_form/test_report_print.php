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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>시험성적서</title>
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
    <style>
        table.type02 {
            border-collapse: separate;
            border-spacing: 0;
            text-align: left;
            line-height: 1.5;
            border-top: 1px solid #ccc;
            border-left: 1px solid #ccc;
        margin : 20px 10px;
        }
        table.type02 th {
            width: 150px;
            padding: 5px 0px;
            font-weight: bold;
            vertical-align: top;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            border-top: 1px solid #fff;
            border-left: 1px solid #fff;
            background: #eee;
        }
        table.type02 td {
            width: 350px;
            padding: 5px 0px;
            vertical-align: top;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }
        .middle {
            vertical-align:middle !important;
		}
		.padding3px {padding-right:3px !important;}

        @import url(http://fonts.googleapis.com/earlyaccess/nanumgothic.css);
    </style>    
	</head>	
    <?
        $query = "select * from test_report where uid=$uid";
        $t = @mysql_fetch_object(mysql_query($query));
    ?>
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
		<div id="wrap_pop">
			<!-- 상단버튼 및 양식설정부분 시작 -->
			<div class="dual-btn-fixed top-zero">
				<div class="dual-btn-area">
					<div class="float_left">
						<span class="btn blue-inverse"><input type="button" name="btnPrint" id="btnPrint" onclick="this.parentElement.style.display = 'none'; pageprint(); this.parentElement.style.display = ''; "  value="인쇄" /></span>
					</div>
                <!--div class="float_right" >
                    <label class="btn_select">
                        <select id="form_ser" name="form_ser" onchange="print_it();">
                            <span id="form_list" name="form_list"><option value="1/0" />견적서</span>
                        </select>
                    </label>
                </div-->
            </div>
		</div>
        <!-- 상단버튼 및 양식설정부분 끝 -->
        <center>
        <div align="center" style="width: 670px;margin-top:10px;border-width:2px;border-color:#000; border-style:solid double;">
            <table style="width: 650px;table-layout: fixed;"  class="type02">
                <colgroup>
                    <col width="150">
                    <col width="350">
                    <col width="150">
                </colgroup>  
                <tbody>
                    <tr>
                        <td class="center"><img src="/weberp/test/img/<?=$company_word?>.jpg"></td>
                        <td style="font-size:20px;text-align:center;font-weight:bold;line-height:110%;vertical-align:middle;font-family: "Nanum Gothic", sans-serif;">
                            시 험 성 적 서<br>
                            (TEST REPORT)
                        </td>
                        <td class="center"><img src="/weberp/test/img/iso.jpg"></td>
                    </tr>
                </tbody>
            </table>
			<table style="width: 650px;table-layout: fixed;" class="type02" align="center">
                <colgroup>
                    <col width="50">
                    <col width="65">
                    <col width="75">
                    <col width="30">
                    <col width="30">
                    <col width="30">
                </colgroup>
				<tbody>
					<tr>
						<th colspan="4" class="center">성적서번호 (Document Number)</th>
						<th colspan="3" class="center">검사일 (Date of Test)</th>
					</tr>
					<tr>
						<td colspan="4" class="center"><?=$t->docno?></td>
						<td colspan="3" class="center"><?=substr($t->ckdate,0,10)?></td>
					</tr>
					<tr>
						<th colspan="4" class="center">모델명 (Type of Designation)</th>
						<th colspan="3" class="center">일련번호 (Serial Number)</th>
					</tr>
					<tr>
						<td colspan="4" class="center"><?=$t->model?></td>
						<td colspan="3" class="center"><?=$t->sn?></td>
					</tr>
					<tr>
						<th class="center">분류</th>
						<th class="center">항목</th>
						<th colspan="4" class="center">기준</th>
						<th class="center">결과</th>
					</tr>
					<tr>
						<td rowspan="5" class="center middle">전원검사</td>
						<td rowspan="2" class="center middle">오토리프트 전압</td>
						<td colspan="4" class="center">전압 측정시 24± 2V 이내일것</td>
						<td rowspan="2" class="center middle">
							<?
							if($t->ckvolt ==1) echo "합 ■ / 불 □";
							else echo "합 □ / 불 ■";
							?>
						</td>
					</tr>
					<tr>
						<td class="center">3회측정접압</td>
						<td class="right padding3px"><?printf("%.3f",$t->testv1)?>V</td>
						<td class="right padding3px"><?printf("%.3f",$t->testv2)?>V</td>
						<td class="right padding3px"><?printf("%.3f",$t->testv3)?>V</td>
					</tr>
					<tr>
						<td rowspan="2" class="center middle">카메라 전압</td>
						<td colspan="4" class="center">카메라 어댑터 전압 (     V) ±2V 이내일 것</td>
						<td rowspan="2" class="center middle">
							<?
							if($t->ckcurrent ==1) echo "합 ■ / 불 □";
							else echo "합 □ / 불 ■";
							?>
						</td>
					</tr>
					<tr>
						<td class="center">하부소켓 측정 전압</td>
						<td class="right padding3px"><?printf("%.3f",$t->testc1)?>V</td>
						<td class="right padding3px"><?printf("%.3f",$t->testc2)?>V</td>
						<td class="right padding3px"><?printf("%.3f",$t->testc3)?>V</td>
					</tr>
					<tr>
						<td class="center">전원표지</td>
						<td colspan="4" class="center">적색점등</td>
						<td class="center">
							<?
							if($t->ckpowerled ==1) echo "합 ■ / 불 □";
							else echo "합 □ / 불 ■";
							?>
						</td>
					</tr>
					<tr>
						<td rowspan="5" class="center middle">동작검사</td>
						<td class="center">승/하강 동작</td>
						<td colspan="4" class="center">승,하강,슬립 상태 확인 (제어반 제어)</td>
						<td class="center">
							<?
							if($t->ckcontrol ==1) echo "합 ■ / 불 □";
							else echo "합 □ / 불 ■";
							?>
						</td>
					</tr>
					<tr>
						<td rowspan="2" class="center middle">높이설정</td>
						<td colspan="4" class="center">제한높이 설정값 ±5cm / 녹색 점등</td>
						<td rowspan="2" class="center middle">
							<?
							if($t->ckheight ==1) echo "합 ■ / 불 □";
							else echo "합 □ / 불 ■";
							?>
						</td>
					</tr>
					<tr>
						<td class="center">3회 평균 측정 높이</td>
						<td class="right padding3px"><?=empty($t->testh1)?'':$t->testh1?>cm</td>
						<td class="right padding3px"><?=empty($t->testh2)?'':$t->testh2?>cm</td>
						<td class="right padding3px"><?=empty($t->testh3)?'':$t->testh3?>cm</td>
					</tr>
					<tr>
						<td class="center">접점결함</td>
						<td colspan="4" class="center">승/하강 시 : 황색 점멸, 접속 시 : 황색 점등 유지</td>
						<td class="center">
							<?
							if($t->ckconnect ==1) echo "합 ■ / 불 □";
							else echo "합 □ / 불 ■";
							?>
						</td>
					</tr>
					<tr>
						<td class="center">영상 출력</td>
						<td colspan="4" class="center">영상출력 확인</td>
						<td class="center">
							<?
							if($t->ckvideo ==1) echo "합 ■ / 불 □";
							else echo "합 □ / 불 ■";
							?>
						</td>
					</tr>
					<tr>
						<td rowspan="3" class="center middle">출하검사</td>
						<td class="center">외관 청결</td>
						<td colspan="4" class="center">오염물없을것</td>
						<td class="center">
							<?
							if($t->ckclean ==1) echo "합 ■ / 불 □";
							else echo "합 □ / 불 ■";
							?>
						</td>
					</tr>
					<tr>
						<td class="center">스티커 및 라벨</td>
						<td colspan="4" class="center">CI, KC, EPC, 조달우수제품 마크</td>
						<td class="center">
							<?
							if($t->cklabel ==1) echo "합 ■ / 불 □";
							else echo "합 □ / 불 ■";
							?>
						</td>
					</tr>
					<tr>
						<td class="center">내용물 확인</td>
						<td colspan="4" class="center">볼트류, 카메라플렌지, 메뉴얼, 시험성적서, 제어반</td>
						<td class="center">
							<?
							if($t->ckcontent ==1) echo "합 ■ / 불 □";
							else echo "합 □ / 불 ■";
							?>
						</td>
					</tr>
					<tr>
						<td class="center middle">PING TEST<br>(RESULT)</td>
						<td colspan="6"><?=$t->pingresult?></td>
					</tr>
                    <tr>
                        <td colspan="3" class="center middle">시험결과 (result)</td>
                        <td colspan="4" class="center middle">합격 (All Clear)&nbsp;</td>
                    </tr>
				</tbody>
			</table>
			<table style="width: 650px;table-layout: fixed;margin:0px;">
				<tr>
					<td align="left">- 대 중소기업 협력재단 성과공유제 공장시험 기준 적용 (높이설정, 접점함, 영상출력)</td>
				</tr>
				<tr>
					<td align="left">- 이 성적서는 (주)오티에스가 제공한 시료에 대한 시험결과이며, 용도외의 사용은 금합니다.<br>&nbsp;&nbsp;This is cerified that the above mentioned products have been tested for producted by OTS CO,.LTD and forbid the use for original purpose.</td>
				</tr>
				<tr>
					<td align="left">- 이 성적서는 (주)오티에스의 승인 없이는 복제 및 재발급이 금지됩니다.<br>&nbsp;&nbsp;No Part of this document may be duplicated or reproduced by any means without the express written permission of OTS CO,.LTD</td>
				</tr>
			</table>
			<table style="width: 650px;table-layout: fixed;"  class="type02" >
                <colgroup>
                    <col width="150">
                    <col width="250">
                    <col width="250">
                </colgroup>            
				<tr>
					<td class="center middle">확인<br>(Affirmation)</td>
					<td>
						<?
							$sql = "select * from approval where test_uid = '{$t->uid}'";
							$rowApproval = mysql_fetch_array(mysql_query($sql));
							$approvalName = '';
							if (!empty($rowApproval['mem_sn']) && !empty($t->uid)) 
							{
								$rowUser = mysql_fetch_array(mysql_query("select * from member where member_sn = '{$rowApproval['mem_sn']}'"));

								$approvalName = $rowUser['k_name'].' '.rank_name_is($rowUser['user_group_sn'], $rowUser['rank_sn']);
						?>
							<div style="position: absolute;">
								<img style="margin: 0px 0px 0px 160px; height: 40px;" src="/userfiles/stampimg/1/<?=$rowUser['stamp']?>">
							</div>
						<?php
							}
						?>
						검사자 (Inspected by)<br>
						(주)오티에스 생산기술팀<br>
						<div class="right"><?=$approvalName?> (sign)</div>
					</td>
					<td>
						<?
							if (!empty($rowApproval['mem_sn']) && !empty($t->approvalUser1)) 
							{
								$rowUser = mysql_fetch_array(mysql_query("select * from member where member_sn = '{$t->approvalUser1}'"));

								$approvalName = $rowUser['k_name'].' '.rank_name_is($rowUser['user_group_sn'], $rowUser['rank_sn']);
						?>
							<div style="position: absolute;">
								<img style="margin: 0px 0px 0px 160px; height: 40px;" src="/userfiles/stampimg/1/<?=$rowUser['stamp']?>">
							</div>
						<?php
							}
						?>					
						승인자 (Approved by)<br>
						(주)오티에스<br>
						<div class="right"><?=$approvalName?> (sign)</div>
					</td>
				</tr>
			</table>	   
            <div class="center" style="font-size:18px;font-weight:bold;">(주)오티에스 생산기술팀</div>     
            <br>
        </div>

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
