<?
//이번달 마지막 날짜 구하기./
$start_dt = date("Y-m-d");

session_start();
extract($_POST);
extract($_GET);

if (empty($date_type)) $date_type = "d";
if (empty($start_date)) 
	$start_date = date("Y/m/d", strtotime("-30 day"));
else if (strlen($start_date) < 8) $start_date .= (strlen($start_date) == 4)?"01/01":"01";

if (empty($end_date)) 
	$end_date = date("Y/m/d");
else if (strlen($end_date) < 8) $end_date .= (strlen($end_date) == 4)?"01/01":"01";	
if ($start_dt ==""){
	$start_date = date("Y-m");
}else{
	$start_date = $start_dt;
}
//echo $start_date;
?>

<?
	require_once ("views/client/lun2sol.php");
	
	if ($start_dt ==""){
	//---- 오늘 날짜
		$thisyear  = date('Y');  // 2000
		$thismonth = date('n');  // 1, 2, 3, ..., 12
		$today     = date('j');  // 1, 2, 3, ..., 31
		$thismonth2 = substr($start_date,5,2);
		$day_count = date('t', strtotime($nowday));
	}else{
	//---- 검색 날짜
		$thisyear  = substr($start_date,0,4);
		$thismonth = number_format(substr($start_date,5,2));
		$thismonth2 = substr($start_date,5,2);
		$today     = date('j');
		$day_count = date('t', strtotime($start_date));
	}

	//------ $year, $month 값이 없으면 현재 날짜
	if (!$year=$HTTP_GET_VARS['year']) $year = $thisyear;
	if (!$month=$HTTP_GET_VARS['month']) $month = $thismonth;
	if (!$day=$HTTP_GET_VARS['day']) $day = $today;
	$neodate=$HTTP_GET_VARS['neodate'];

	//------ 날짜의 범위 체크
	//if (($year > 2038) or ($year < 1900)) ErrorMsg("연도는 1900~2038년만 가능합니다.");
	//if (($month > 12) or ($month < 0)) ErrorMsg("달은 1~12만 가능합니다.");
	
	if ($start_dt==""){
		$dateIn=1;
	}else{
		$dateIn=1;
		//현재날짜부터 달력이 나오게 되어 있었지만 업체에서 1일부터 나오게 해달라고 하여 수정.
		//$dateIn=date("d",strtotime ("+0 week", strtotime($start_dt)));
	}
	$weekCnt=0;

	$maxdate = date(t, mktime(0, 0, 0, $month, 1, $year));   // the final date of $month
	
	$week_cnt = 0;  // 해당월 첫쨰주 
	$reCive_Y ="";
	for($dd=1; $dd<=$maxdate; $dd++){ 
		$W = date("w",mktime(0,0,0,$requ_M,$dd,$requ_Y));

		if($W == 0 && $week_cnt < 1 ) {
			$reCive_Y = $dd;
			$week_cnt++;
		}
	}

	//if ($day>$maxdate) ErrorMsg("$month 월 에는 $lastday 일이 마지막 날입니다.");

	$prevmonth = $month - 1;
	$nextmonth = $month + 1;
	$prevyear = $nextyear=$year;
	if ($month == 1) {
	  $prevmonth = 12;
	  $prevyear = $year - 1;
	} elseif ($month == 12) {
	  $nextmonth = 1;
	  $nextyear = $year + 1;
	}
	/****************** lunar_date ************************/
		$predate = date("Y-m-d", mktime(0, 0, 0, $month-1, 1, $year)); //속도를 위해 조회하는 전후 한달만 select
		$nextdate= date("Y-m-d", mktime(0, 0, 0, $month+1, 1, $year)); //속도를 위해 조회하는 전후 한달만 select
	/****************** 휴일 정의 ************************/
	$HOLIDAY = Array();
	$HOLIDAY[] = array(0=>'1-1',1=>'신정'); 
	$HOLIDAY[] = array(0=>'3-1',1=>'삼일절');
	//$HOLIDAY[] = array(0=>'4-5',1=>'식목일');
	$HOLIDAY[] = array(0=>'5-5',1=>'어린이날');
	$HOLIDAY[] = array(0=>'6-6',1=>'현충일');
	$HOLIDAY[] = array(0=>'7-17',1=>'제헌절');
	$HOLIDAY[] = array(0=>'8-15',1=>'광복절');
	$HOLIDAY[] = array(0=>'10-3',1=>'개천절');

	$HOLIDAY[] = array(0=>'12-25',1=>'성탄절');

	$tmp = lun2sol($year."0101");   //설날
	$HOLIDAY[] = array(0=>date("n-j",($tmp-(3600*24))),1=>'설날');
	$HOLIDAY[] = array(0=>date("n-j",$tmp),1=>'설날');
	$HOLIDAY[] = array(0=>date("n-j",($tmp+(3600*24))),1=>'설날');;

	$tmp = lun2sol($year."0408");   //석탄일
	$HOLIDAY[] = array(0=>date("n-j",$tmp),1=>'석탄일');

	$tmp = lun2sol($year."0815");   //추석
	$HOLIDAY[] = array(0=>date("n-j",($tmp-(3600*24))),1=>'추석');;
	$HOLIDAY[] = array(0=>date("n-j",$tmp),1=>'추석');;
	$HOLIDAY[] = array(0=>date("n-j",($tmp+(3600*24))),1=>'추석');;

	unset($tmp);

	/****************** 휴일 정의 ************************/
	$time = time();
	$year1 = date("Y", $time);
	$month1 = date("n", $time);

	$requ_M = $thismonth;
	$requ_M2 = $thismonth2;
	$requ_Y = $thisyear;
	$dateEnd= $maxdate;
	$this_D = date("d", $time);
	$this_M = date("n", $time);
	$this_M2 = date("m", $time);
	$this_Y = date("Y", $time);

	function SkipOffset($no,$sdate='',$edate='')
	{  
	  for($i=1;$i<=$no;$i++) { 
		$ck = $no-$i+1;
		if($sdate) $num = date('m/d',$sdate-(3600*24)*$ck);
		if($edate) $num = date('m/d',$edate+(3600*24)*($i-1)); 
		
		echo "  <TD valign=top><font class=num2>$num</font></TD> \n";	
	  }
	}
	function dayOffset($no,$sdate='',$edate='')
	{  
	  for($i=1;$i<=$no;$i++) { 
		$ck = $no-$i+1;
		if($sdate) $num = date('m/d',$sdate-(3600*24)*$ck);
		if($edate) $num1 = date('m/d',$edate+(3600*24)*($i-1)); 
		
		echo "  $num \n";	
	  }
		echo "  $num1 \n";
	}						
	$offset = 0;

	// 달력-날짜 출력
	$week = array('일','월','화','수','목','금','토'); 
	$week_int=date( 'w', mktime(0,0,0,$requ_M,1,$requ_Y));

	if($week_int>0){ for($i=0; $i<$week_int; $i++){}}

	?>

<div class="main-content">
	<div class="main-content-inner">
		<!-- 페이지 상단 Location -->
			<? $this->headNavi("설치 및 출고 확정", $action_txt); ?>
		<!-- // 페이지 상단 Location -->


		<? 
		//echo "start_dt:".$start_dt." )(   "; 
		//echo  "dateIn:".$dateIn; 
		//echo  "  )(  "."requ_M:".$requ_M; 
		//echo  "  )(  "."reCive_Y:".$reCive_Y;
		//echo  "  )(  "."dateEnd:".$dateEnd;
			
		
		?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="widget-header">
						<div class="col-xs-11" style="float:left">
							<div class="form-inline">
								<span class="input-icon input-icon-right">
									<div class="input-group">
										<input class="date-picker form-control" name="start_dt" id="start_dt" type="text" style="width:100px" value='<?=$start_dt?>' data-date-format="yyyy-mm-dd" readonly/>
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</span>
								<div class="input-group">
									<button type="button" class="btn btn-purple btn-sm form-control" onclick="goPage(1)" >
										<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
										검색
									</button>
									
								</div>
								
							</div>
						</div>
						<!--
						<div class="col-xs-1" style="float:right">
							<button type="button" class="btn btn-primary btn-sm" id="btnExcel">엑셀다운</button>
						</div>
						-->
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="order_list_total" class="table  table-bordered table-striped" >
								<thead class="thin-border-bottom">
									<tr class='bg-primary' style="border: inherit; background-color: #404040;">
										<th style="color:#ffffff"><i class="ace-icon fa fa-caret-right blue"></i> 날짜</th>
										<th class="col-xs-3" style="color:#ffffff"><i class="ace-icon fa fa-caret-right blue"></i> <?=$requ_M."/".$dateIn. "~".$requ_M."/".$day_count;?></th>
										<th class="col-xs-1" style="color:#ffffff"><i class="ace-icon fa fa-caret-right blue"></i> 품번</th>
										<th class="col-xs-2" style="color:#ffffff"><i class="ace-icon fa fa-caret-right blue"></i> 품명</th>
										<th class="col-xs-1" style="color:#ffffff"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
										<th class="col-xs-1" style="color:#ffffff"><i class="ace-icon fa fa-caret-right blue"></i> 단위</th>
										<th class="col-xs-1" style="color:#ffffff"><i class="ace-icon fa fa-caret-right blue"></i> 수량</th>
										<th class="col-xs-1" style="color:#ffffff"><i class="ace-icon fa fa-caret-right blue"></i>납기일</th>
									</tr>
								</thead>
								
								<? 
								
								while($dateIn<=$dateEnd){  
									if($CALENDAR_arr[$dateIn])	$Index_data=$CALENDAR_arr[$dateIn];
									else 	unset($Index_data);
									$week_int=date( 'w', mktime(0,0,0,$requ_M,$dateIn,$requ_Y));
									$date = date( 'm/d',mktime(0,0,0,$requ_M,$dateIn,$requ_Y));

								?>

									
									<? if($i==1){  ?>

								<tbody> <!-- <<<<<<<<<<<  tbody >>>>>>>>>>>>>> -->
									<!--	달력 숫자 부분.	-->
									<? } 
									
									//$query = "select * from obtain_order where delivery_dt between '".$t."' and '".$t->warehouse_cd."'";
									
									$query = "select * from obtain_order where delivery_dt = '".$requ_Y."-".$requ_M2."-".sprintf('%02d',$dateIn)."'";
									//$query = "select * from schedule where schedule_dt = '".$requ_Y."-".$requ_M2."-".sprintf('%02d',$dateIn)."'";
									//$query = "select * from schedule where schedule_dt='$date' and classify='수주'";
									//echo $query;
									$result = mysql_query($query);
									//$ts = mysql_fetch_object(mysql_query($query));	
									?>
									<tr>
										<td valign="center" class="td_today_style" >
										<?
											//if($dateIn==$this_D and $requ_M==$this_M and $requ_Y==$this_Y) echo "  "; // 오늘 날짜 칸 테두리색
											//echo " >";
											// 날짜출력
											echo "<div style='font-size:20px;' ";
											echo " onclick=\"diaryLinkLocation('$dateIn')\" ";
												if($week_int==0)		echo " class=div_sun" ;
												elseif($week_int==6)	echo " class=div_sat"; 
												else					echo " class=div_week"; // 일반-검정
											echo ">$dateIn"; // 일반-검정
											echo"(";
											echo $week[date('w',mktime(0,0,0,$requ_M,$dateIn,$requ_Y))];
											echo")";
											echo"</div>";
										?>
									<!--	달력 숫자 부분끝.	-->	
										</td>

										<?
										$ct = 1;	
										while($ts = @mysql_fetch_object($result)) {
							
											if($ct >1){?>
												<td></td>
											<? } 
											
											if($ts->emp_nm_ck==""){
												$emp_nm_ck="#ff0000";
											}else{
												$emp_nm_ck="#336600";
											}
											if($ts->sales_nm_ck==""){
												$sales_nm_ck="#ff0000";
											}else{
												$sales_nm_ck="#336600";
											}
											if($ts->meeting_yn==""){
												$meeting_yn="#ff0000";
											}else{
												$meeting_yn="#336600";
											}
											if($ts->install_yn==""){
												$install_yn="#ff0000";
											}else{
												$install_yn="#336600";
											}

											$query3 = "select count(*) as cnt, item_nm from obtain_order_item where fid = '".$ts->uid."'";
												//echo $query3;
												$result3 = mysql_query($query3);
												$ts3 = mysql_fetch_object($result3);
												if($ts3->cnt > 1) $item_nm = "(".$ts3->item_nm . "외 " . ($ts3->cnt-1) . "건)";
												else $item_nm = "(".$ts3->item_nm.")";
										?>
										<!--
										<td style="color:#000000;font-weight:bold">
											<div class="action-buttons">
												<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
													<i class="ace-icon fa fa-angle-double-down"></i>
												</a><?=$ts->account_nm?>&nbsp;<?=$item_nm?>
											</div>
										</td>
										-->
										<td style="color:#000000;font-weight:bold;font-size:20px;" class="show-details-btn"><b><a href="#"><?=$ts->account_nm?></a></b></td>
										<td style="color:#000000;font-weight:bold;font-size:20px;" class="show-details-btn"><b><a href="#"><?=number_format($ts->cntTotal)?></a></b></td>
										<td style="color:#000000;font-weight:bold;font-size:15px;"><?=$ts->shipping_address?></td>
										<td style="color:#000000;font-weight:bold;font-size:10px;"><?=$ts->install_number?></td>
										<td style="color:#000000;font-weight:bold;font-size:20px;"><?=$ts->emp_nm?></td>
										<td style="color:<?=$emp_nm_ck?>;font-weight:bold;font-size:20px;" class="text-center"><? echo ($ts->emp_nm_ck=="Y")? "확인" : "미확인"?></td>
										<td style="color:<?=$sales_nm_ck?>;font-weight:bold;font-size:20px;" class="text-center"><? echo ($ts->sales_nm_ck=="Y")? "확인" : "미확인"?></td>
										<td style="color:<?=$meeting_yn?>;font-weight:bold;font-size:20px;" class="text-center"><? echo ($ts->meeting_yn=="Y")? "확인" : "미확인"?></td>
										<td style="color:<?=$install_yn?>;font-weight:bold;font-size:20px;" class="text-center"><? echo ($ts->install_yn=="Y")? "완료" : "미완료"?></td>
									</tr>
									
								<!-- 누르면 하단으로 품목정보 나오게 하는 부분.-->
									<tr class="detail-row ">
										<td>&nbsp;</td>
										<td colspan="9">
										<div class="table-detail no-padding">
											<div class="row">
												<div class="col-xs-12 col-sm-12 ">
													<table id="simple-table" class="subtable no-padding" style="width:99%">
														<thead class="" >
															<tr class="active">
															<th class="col-xs-3 center " style=";padding:5px;">품목명</th>
															<th class="col-xs-2 center " style=";padding:5px;">품목코드</th>
															<th class="col-xs-2 center " style=";padding:5px;">규격</th>
															<th class="col-xs-2 center " style=";padding:5px;background-color:#dbedff;">단위</th>
																<th class="col-xs-2 center " style=";padding:5px;background-color:#dbedff;">수량</th>
															</tr>
														</thead>
														<tbody>
													<?
														$query2 = "select * from obtain_order_item where fid = '".$ts->uid."'";
														//echo $query2;
														$result2 = mysql_query($query2);
														?>	
														<?
														while($ts2 = @mysql_fetch_object($result2)) {?>
														<tr>
														<td style="color:#000000;"><a href="#" class="danger bigger-130" ></a>&nbsp;<?=$ts2->item_nm?></td>
														<td style="color:#000000;"><?=$ts2->item_cd?></td>
														<td style="color:#000000;"><?=$ts2->standard?></td>
														<td style="color:#000000;"><?=$ts2->unit?></td>
														<td style="color:#000000;"><?=number_format($ts2->cnt)?></td>
														</tr>
														<?}?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										</td>
									</tr>
											
									<?
										$ct++;

									} if($ct=="1"){ 
									
									?>

									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center"></td>
										
									<?}?>
										
									<?
									$weekCnt =$week_int+2;
									$dateIn++;
									
								} // end while
								
								?>
										
								</tbody>
							</table>
						</div>
					</div>
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
.subtable {
	font-family:Arial, Helvetica, sans-serif;
	color:#000;
	font-size:12px;
	text-shadow: 1px 1px 0px #fff;
	background:#eaebec;
	margin:5px;
	border:#ccc 1px solid;

	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;

	-moz-box-shadow: 0 1px 2px #d1d1d1;
	-webkit-box-shadow: 0 1px 2px #d1d1d1;
	box-shadow: 0 1px 2px #d1d1d1;
}
.subtable th {
	color:#000;
	padding:5px;
	border-top:2px solid #fafafa;
	border-bottom:1px solid #e0e0e0;
	border-left: 1px solid #e0e0e0;
	background: #EAF2D3;
	background: -webkit-gradient(linear, left top, left bottom, from(#EAF2D3), to(#EAF2D3));
	background: -moz-linear-gradient(top,  #EAF2D3,  #EAF2D3);
}
.subtable th:first-child{
	text-align: left;
	padding-left:2px;
	
}
.subtable tr:first-child th:first-child{
	-moz-border-radius-topleft:3px;
	-webkit-border-top-left-radius:3px;
	border-top-left-radius:3px;
}
.subtable tr:first-child th:last-child{
	-moz-border-radius-topright:3px;
	-webkit-border-top-right-radius:3px;
	border-top-right-radius:3px;
}
.subtable tr{
	text-align: center;
	padding-left:20px;
}
.subtable tr td:first-child{
	text-align: left;
	padding-left:20px;
	border-left: 0;
}
.subtable tr td {
	padding:5px;
	border-top: 1px solid #ffffff;
	border-bottom:1px solid #e0e0e0;
	border-left: 1px solid #e0e0e0;
	
	background: #fafafa;
	background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
	background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
}
.subtable tr.even td{
	background: #f6f6f6;
	background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
	background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}
.subtable tr:last-child td{
	border-bottom:0;
}
.subtable tr:last-child td:first-child{
	-moz-border-radius-bottomleft:3px;
	-webkit-border-bottom-left-radius:3px;
	border-bottom-left-radius:3px;
}
.subtable tr:last-child td:last-child{
	-moz-border-radius-bottomright:3px;
	-webkit-border-bottom-right-radius:3px;
	border-bottom-right-radius:3px;
}
.subtable tr:hover td{
	background: #f2f2f2;
	background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
	background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);	
}

</style>
<style type='text/css'>
	.list_date	{border:1px solid #cccccc; padding:0 0 0 0;}
	.td_week_sun{width:14%; height:20px; text-align:center; background-color:#707070; font:bold 8pt Tahoma; color:#ff7777; border-top:1px solid #dddddd;} /* SUN */
	.td_week_pub{width:14%; height:20px; text-align:center; background-color:#707070; font:bold 8pt Tahoma; color:#f2f2f2; border-top:1px solid #dddddd;} /* MON ~ FRI */
	.td_week_sat{width:14%; height:20px; text-align:center; background-color:#707070; font:bold 8pt Tahoma; color:#99bbff; border-top:1px solid #dddddd;} /* SAT */

	.div_sun{color:#ff3333;		text-align:center;		margin:3px 3px 0px 4px;		font:bold 9pt Tahoma; cursor:pointer;} /* 일요일 날짜 */
	.div_sat{color:#3355ff;		text-align:center;		margin:3px 3px 0px 4px;		font:bold 9pt Tahoma; cursor:pointer;} /* 토요일 날짜 */
	.div_week{color:#454545;	text-align:center;		margin:3px 3px 0px 4px;		font:bold 9pt Tahoma; cursor:pointer;} /* 평일 날짜 */

	.td_today_style{border:2px solid #33bb33;} /* 오늘 날짜 칸  */

	.div_is_data{cursor:pointer; font-size:10pt; line-height:130%; font-family:<?=$malgeun_godic?>,돋움; 
			padding:3px 1px 1px 2px; letter-spacing:-1; color:#454545; margin-top:5px; background-color:#ffffff;} /* 등록내용.제목 */

	.font_repcnt{font:bold 7pt Tahoma; color:#3377ff; margin-left:2px;} /* 댓글수 */
	.date_select_layer{font:normal 8pt Tahoma; color:#454545; text-align:center; cursor:pointer; padding:1px 0 0 0;} /* 년/월 이동 선택 레이어 */
	#select_layer_YYYY{width:80px; background-color:#f9f9f9; position:absolute; border:1px solid #555555; display:none;} /* 년 */
	#select_layer_MM{width:50px; background-color:#f9f9f9; position:absolute; border:1px solid #555555; display:none;} /* 월 */
	.year_month_text{font:bold 9pt Tahoma; color:#585858; cursor:pointer;} /* 년/월  */
</style>
<style type="text/css"> 
<!-- 
/*여러개 쓰면 시계방향으로 적용(2~3개)면 대칭*/ 
p.one {border-style: dotted} 
/*테두리 점선*/ 
p.two {border-style: dashed} 
/*테두리 데쉬(-)*/ 
p.three {border-style: solid} 
p.four {border-style: double} 
/*테두리 두개 사용*/ 
p.five {border-style: groove} 
/*테두리 홈 효과*/ 
p.six {border-style: ridge} 
/*테두리 입체 효과*/ 
p.seven {border-style: inset} 
/*테두리 안쪽 음각 효과*/ 
p.eight {border-style: outset} 
/*테두리 안쪽 양각 효과*/ 
p.dr {border-style: dashed ridge} 
/*top,bottom:dashed - left,right:ridge*/ 
p.sd {border-style: solid double} 
p.io {border-style: inset outset} 
p.gd {border-style: groove double} 
p.sdg {border-style: solid double groove} 
/*top:solid - left,right:double - bottom:groove*/ 
p.idro {border-style: inset double ridge outset} 
/*top,right,bottom,left 순서대로 적용*/ 
P.bt {background-color: menu; border: buttonhighlight 2px outset} 
/*배경색 기본 메뉴색 테두리 2픽셀의 양각효과에 버튼하이라이트색*/ 
--> 
</style>
<?
require_once ("assets/include_script.php");
?>
		<script src="assets/js/buttons.colVis.min.js"></script>
		<script src="assets/js/dataTables.select.min.js"></script>
<script>
	/**************버튼누르면 하단에 품목정보 보여줌.*/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
	/***************/
</script>
	<script>
	$("#btnExcel").on("click", function () {
		alert('aa')
		
		
		var start_dt= $('#start_dt').val();
		alert(start_dt)
			
		var url="views/sales/listOrderDecided_xls.php";
		//var url="index.php?controller=sales&action=listPageOrderDecided_xls";
		document.Iframe.location.href = url + "?start_dt=" + start_dt;
		
		//$(location).attr('href', url);
		//$('#abc_frame').attr('src',url);
		
		/*
        var a = document.createElement('a');
        var data_type = 'data:application/vnd.ms-excel';
        var table_html = encodeURIComponent($("#order_list_total").html());
        a.href = data_type + ', ' + table_html;
        a.download = '파일명.xls';
        
        a.click();
        e.preventDefault();
		*/
	});
</script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
<style>
		#monthpicker {
			width: 60px;
		}
		#btn_monthpicker {
			background: url('./datepicker.png');
			border: 0;
			height: 24px;
			overflow: hieen;
			text-indent: 999;
			width: 24px;
		}
	</style>
<script src="assets/js/jquery.mtz.monthpicker.js"></script>
<script>
	//datepicker plugin
	//link
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true,
		language: "kr"
	})
	
	/* MonthPicker 옵션 */
	options = {
		pattern: 'yyyy-mm', // Default is 'mm/yyyy' and separator char is not mandatory
		selectedYear: 2018,
		startYear: 2016,
		finalYear: 2033,
		monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월']
	};
	
	/* MonthPicker Set */
	$('#start_dt').monthpicker(options);
	
	/* 버튼 클릭시 MonthPicker Show */
	$('#btn_start_dt').bind('click', function () {
		$('#start_dt').monthpicker('show');
	});
	
	/* MonthPicker 선택 이벤트 */
	$('#start_dt').monthpicker().bind('monthpicker-click-month', function (e, month) {
		//alert("선택하신 월은 : " + month + "월");
	});
</script>
<script>
function goPage(){
	var start_dt = $("#start_dt").val();
	document.location.href ="http://koreabobin.jerp.co.kr/index.php?controller=client&action=listPageOrderDecided&start_dt="+start_dt;
}
</script>
<iframe name="Iframe" id="Iframe" src="about:blank" frameborder="0" scrolling="no">