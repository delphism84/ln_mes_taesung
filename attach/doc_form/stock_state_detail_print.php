<?
include_once("../common.php"); // 기본 파일
include_once("../inc/dbconfig.php");
include_once("../inc/func.php");  // 함수 파일

if (!$is_member){
	goto_url("/login.php");
	exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="robots" content="noindex,nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<link type='text/css' rel='stylesheet'href='http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_base.css?v=20150114122238' /><span></span>
<link type="text/css" rel="stylesheet" href="http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_layout.css?2016011202" />
<link type="text/css" rel="stylesheet" href="http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_rpt_print.css?2015070601" />
<link href="/weberp/css/reset.css" rel="stylesheet" type="text/css" media="all">
<link href="/weberp/css/common.css" rel="stylesheet" type="text/css" media="all">
<script>
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
	<div id="wrap">
		<!-- ***** 서치버튼 시작 **** -->
		<div class="print-search-fixed">
			<div class="print-search-layer">
				<!-- 검색창 -->
				<div class="print-search-con">
					<form id="frmSearch" name="frmSearch" method="post" action="/ECMain/ESZ/ESZ003R.aspx?ec_req_sid=00JbDuK7Cm8P">
						<div class="new-title">
							<div class='title-leftarea page-bookmark' onclick='javascript:fnFavorityPopupOpen("재고수불부 I","E040702","1287","215","");'>재고수불부 I</div>
								<div class="title-rightarea">
									<span class="btn-setting" onclick="fnShowOption(); return false;"></span>
									<ul class="option_box_new" >
										<li><a onclick="javascript:fnPopTemplate();">양식</a></li>
										<li><a onclick="javascript:gfnPopUp1('/ECMain/CM3/CM100P_24.aspx?FORM_GUBUN=SM623&FORM_SER=1&NetFlag=N&FIRST_FLAG=N','CM100P_14','Y','400' ,'390');" >검색항목설정</a></li>
									</ul>
								</div>
							</div>

							<fieldset>
								<legend><span class="title">판매조회 조건입력</span></legend>
								<div class="H_5px"></div>
								<div id="contents">
									<div class="nav_tab p_t4px" >
										<ul>
											<li id="tab1" class="nav_tabon"><a href="#"  onclick="MM_showHideLayers1(1);TabChangeFocus();"><span>기본</span></a></li>
											<li id="tab2"><a href="#"  onclick="MM_showHideLayers1(2);TabChangeFocus();"><span>전체</span></a></li>
										</ul>
									</div>
									
									<div class="search-button">
										<span class="btn blue-inverse"><input name="btnSearch" onclick="frmSearchData(-1, true);" type="button" id="btnSearch" onkeydown=""  value="검색(F8)" /></span>
										<label class="select_top">
											<select name="ddlFormSer" id="ddlFormSer"  onclick="fnEtcChkSer();" >
												<option  value="99999"selected>출력물</option>
												<option  value="0">현황</option>
											</select>
										</label>
									</div><!-- endof [search_btnpart] 검색버튼 -->
								</div>
							</fieldset>
							
							<input type="hidden" id="hidSearchXml" name="hidSearchXml" />
							<input type="hidden" name="hidFavSeq" id="hidFavSeq"/>
							<input type="hidden" id="hidSearchXml2" name="hidSearchXml2" value=""/>
							<input type="hidden" id="NEWFLAG" name="NEWFLAG" value="" /><!--센터 오픈시  제거해야함-->
							<input type="hidden" id="hidFmType" name="hidFmType" value="" />
							<input type="hidden" id="hidGubun" name="hidGubun" value="" />
							<input type="hidden" id="hidAFlag" name="hidAFlag" value="" />
							<input type="hidden" id="hidPageGubun" name="hidPageGubun" value="" />
							<input type="hidden" id="strListType" name="strListType" value="" />
							<input type="hidden" id="strListFlag" name="strListFlag" value="" />
							<input type="hidden" id="strSort" name="strSort" value="" />
							<input type="hidden" id="strSearchCode" name="strSearchCode" value="" />
							<input type="hidden" id="strSortAd" name="strSortAd" value="" />
							<input type="hidden" id="hidPFlag" name="hidPFlag" value="T" />
							<input type="hidden" id="hidSaleGubun" name="hidSaleGubun" value="" />
							<input type="hidden" id="hidPrev" name="hidPrev" value="" />
							<input type="hidden" id="hfButtonCnt" value="0" />
							<input type="hidden" id="hidTabGubun" name="hidTabGubun" value="1" />
							<input type="hidden" id="hidTabFirsts" name="hidTabFirsts" value="ddlSYear|ddlSYear" />
							<input type="hidden" name="hidGroupDisplay" id="hidGroupDisplay" value="">
							<input type="hidden" name="hidGroupBasicDisplay" id="hidGroupBasicDisplay" value="">
							<input type="hidden" id="hidEyymm" name="hidEyymm" />
							<input type="hidden" id="hidAccCloseCheckDate" name="hidAccCloseCheckDate" />
							<input type="hidden" id="hidListYnSearch" name="hidListYnSearch" value="N" />
							<input type="hidden" id="hidStetOrderFlag" name="hidStetOrderFlag" value="N"/>
						</div>
					</form>
					<span class="btn-print-search" onclick="fnShowSearch2(this); return false;"></span>
				</div>
			</div>

			<!-- 이중추가버튼 -->
			<div class="dual-btn-fixed">
				<div class="dual-btn-area p-print-btn">
					<div class="float_left">
					
						<? 
						if ($_GET['mobile'] && $_GET['mobile'] == "true") { 
						?>
						<span class="btn gray"><input type="button" id="btnExcel" onclick="history.go(-1); " value="Back" /></span>
						<? 
						} else { 
						?>
						<span class="btn blue-inverse"><input type="button" id="btnPrint" value="인쇄" onclick="this.parentElement.style.display = 'none'; pageprint(); this.parentElement.style.display = ''; " /></span>
						<!--span class="btn gray"><input type="button" id="btnExcel" onclick="ExcelPageMovement('/ECMain/ESZ/ESZ003E.aspx');" value="Excel" /></span-->
						<!--span class="btn gray"><input type="button" id="btnPreview" value="미리보기" onclick="getPreviewPrint2(); return false;" /></span-->
						<? 
						}
						?>
					</div>
				</div>
			</div>
			<!-- ***** 서치버튼 끝 **** -->
			<!-- ***** 작업영역 시작 **** -->

			<!-- ***** 프린트 시작 ***** -->
			<div id="idPrint" class="P_45px">
				<div id="contents" style="width:650px;">
					<div id="print_title">
						<ul>
							<li >
								<table width='650px' border='0' cellspacing='0' cellpadding='0'>
									<tr>
										<td align='center'>
											<table> 
												<tr> 
													<td align='center' class='bigtitle'>재고수불부 I</td>
												</tr> 
											</table>
										</td>
									</tr>
								</table> 
							</li>
						</ul>
					</div>
					<br />
					<?
					if ($start_date !="" && $end_date !=""){
						$now = substr($start_date,0,4)."-".substr($start_date,4,2)."-".substr($start_date,6,2);
						$start = substr($end_date,0,4)."-".substr($end_date,4,2)."-".substr($end_date,6,2);
						$before = substr($start_date,0,4)."-".substr($start_date,4,2)."-01";  //전월이원총수량을위한 날짜 정의
						
					}else{
						$now = date('Y-m-d');
						$start = date('Y-m-01');
						$before = date('Y-m-01');   //전월이원총수량을위한 날짜 정의
					}
					?>
					<div id="divContainer" class="container H_35px">
						<p class="float_left">회사명 : (주)코메스타 / <?=$num ?></p>
						<!-- <p class="float_right"><?=date('Y-m')?>-01 ~ <?=date('Y-m-d')?></p> -->
						<p class="float_right"><?=$now?> ~ <?=$start?></p>
					</div>
					
					<table class="p_table" summary="">
						<colgroup>
							<col width="11%" />
							<col width="" />
							<col width="21%" />
							<col width="13%" />
							<col width="13%" />
							<col width="13%" />
							<col width="15%" />
						</colgroup>
						<thead>
							<tr>
								<th class="p_th">날짜</th> <!--날 짜-->
								<th class="p_th">프로젝트</th><!--적요-->
								<th class="p_th">거래처</th><!--거래처-->
								<th class="p_th">적요</th><!--적요-->
								<th class="p_th">입고수량</th><!--입고수량-->
								<th class="p_th">출고수량</th><!--출고수량-->
								<th class="p_th">재고수량</th><!--재고수량-->
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="p_td p_redC" colspan="6"><strong>전월이월</strong></td>
								<td class="p_td right">
									<?
									//$basic_date = 
									$query = "select sum(in_qty) as ins, sum(out_qty) as outs from inventory_inout where itemcd='".$num."' and regdate < LAST_DAY('".$before."' - interval 1 month)";
									//echo $query;
									$result = mysql_query($query);
									if($result) $t= mysql_fetch_object($result);
									?>
									<strong>
									<?
									if($t) {
										$pre_stock = $t->ins - $t->outs;
										echo number_format($pre_stock); 
									} else {
										echo "0";
									}
									?>
									</strong>
								</td>
							</tr>
							<?
							$query = "select * from inventory_inout where itemcd='".$num."' and left(regdate,10) > '".$now."' and left(regdate,10) <= '".$start."' order by regdate asc";
							//echo $query;
							$result = mysql_query($query);
							
							$remain = $pre_stock;
							if(mysql_num_rows($result) > 0) {
								while($t = mysql_fetch_object($result)) {
									$in_qty_sum = $in_qty_sum + $t->in_qty;
									$out_qty_sum = $out_qty_sum + $t->out_qty;
									$remain = $remain + $t->in_qty;
									$remain = $remain - $t->out_qty;
									
								?>
								<tr>
									<td class="p_td center"><?=$t->basic_date?></td>
									<td class="p_td center"><?=$t->pjt_cd?></td>
									<td class="p_td"><?=$t->remark?></td>
									<td class="p_td"><?=$t->reason?></td>
									<td class="p_td right"><?=$t->in_qty?></td>
									<td class="p_td right"><?=$t->out_qty?></td>
									<td class="p_td right"><?=$remain?></td>
								</tr>
							<?
								}
							} else {
							?>
							<tr>
								<td colspan="7>" class="p_td center" style="height:20px">등록된 이력 결과가 없습니다.</td>
							</tr>
							<?
							}
							?>
							<tr class="p_graybgB">
								<td class="p_td center" colspan="4">누계</td>
								<td class="p_td right"><?=number_format($in_qty_sum)?></td>
								<td class="p_td right"><?=number_format($out_qty_sum)?></td>
								<?if ($pre_stock =="0"){?>
								<td class="p_td right"><?=number_format($in_qty_sum-$out_qty_sum)?></td>
								<?}else{?>
								<td class="p_td right"><?=number_format($remain)?></td>
								<?}?>
							</tr>
						</tbody>
					</table>
					
					<div class="container H_2px">
						<p class="float_left">[P. 1]</p>
						<p class="float_right"><?=date('Y-m-d h:m:i')?></p>
					</div>
				</div><!-- //contents -->
			</div> <!-- //idPrint -->
		</div> <!-- //wrap -->

		<iframe name="ifrmExcel" style="width:0px; height:0px"></iframe>
	</div>
</body>
</html>