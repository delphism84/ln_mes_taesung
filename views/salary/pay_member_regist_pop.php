<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);

$end_day = date("t", mktime(0, 0, 0, 12, 1, 2007));
$lastday = str_replace("/","년",$lastday)."월";

	$txtPayAmt1 =explode('|' , $t->txtPayAmt1);
	$hidAdCd1 =explode('|' , $t->hidAdCd1);
	$hidAdGubun1 =explode('|' , $t->hidAdGubun1);
	$txtMemo1 =explode('|' , $t->txtMemo1);

	$txtPayAmt2 =explode('|' , $t->txtPayAmt2);
	$hidAdCd2 =explode('|' , $t->hidAdCd2);
	$hidAdGubun2 =explode('|' , $t->hidAdGubun2);
	$txtMemo2 =explode('|' , $t->txtMemo2);
	//$PayAmtCnt = count($txtPayAmt1);
	//$PayAmtCnt2 = count($txtPayAmt2);
	//echo $PayAmtCnt;
	//for($i = 0 ; $i < $PayAmtCnt2 ; $i++){
	//	echo($txtPayAmt2[$i] . "<br/>");
	//}

?>

<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">인사/급여</a>
				</li>
				<li class="active">급여관리</li>
			</ul><!-- /.breadcrumb -->

			<div class="nav-search" id="nav-search">
				<form class="form-search">
					<span class="input-icon">
						<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
						<i class="ace-icon fa fa-search nav-search-icon"></i>
					</span>
				</form>
			</div><!-- /.nav-search -->
		</div>

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="salary" />
						<?if ($t->sid !=""){ ?>
						<input type="hidden" name="action" id="action" value="registPayMemberUpdate" />
						<?}else{ ?>
						<input type="hidden" name="action" id="action" value="registPayMemberInsert" />
						<?}?>
						<input type="hidden" name="pay_check_dt" id="pay_check_dt" value="<?=$pay_check_dt?>" />
						<input type="hidden" name="pay_check_ca" id="pay_check_ca" value="<?=$pay_check_ca?>" />
						<input type="hidden" name="sid" id="sid" value="<?=$t->sid?>" />
						<input type="hidden" name="dialogid" id="dialogid" value="<?=$dialogid?>" />
						
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
						<div id="wrap_pop" >
							<div class="new-title">
								<div class="title-leftarea"><?=$emp_nm?> 수당/공제 항목 입력</div>
							</div><!-- end of title-->
							<div id="contents">    
							
							<table id="simple-table" class="table  table-bordered table-hover">
							<col width="120px" /><col width="200px" /><col width="" />
								<tr>
								  <th>사원번호/성명</th>
								  <td class="Pink_strong"><?=$emp_cd?>/<?=$emp_nm?></td>
								  <td><?=$lastday?> 지급공제 기준입니다.</td>
								</tr>
							</table>    
							
							<div id="row">
							  <span class="left"><input name="btnChoiceDel" type="button" id="btnChoiceDel" class="btn_grayS" onclick="fnChoiceDel();" value="선택삭제" /></span>
							</div>
							<!--수당사항-->    
							<table id="simple-table" class="table  table-bordered table-hover">
							<col width="20px" /><col width="150px" /><col width="150px" /><col width="" />
								<tr style="background-color:#f1f1f1">
								  <th><input type="checkbox" name="chkAll" id="chkAll" class="checkbox"  onclick="fnAll();"/></th>
								  <th>수당항목</th>
								  <th>금 액</th>
								  <th>메 모</th>
								</tr>
								<tr>
								  <th class="center"><input type="checkbox" name="chk1_0" id="chk1_0" class="checkbox" /></th>
								  <th>기본급</th>
								  <td><input id="txtPayAmt1_0" type="text" name="txtPayAmt1_0" class="text-right" onkeyup="inputNumberFormat(this)" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  value="<?=$txtPayAmt1[0]?>"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();'"  />
								  <input type="hidden" name="hidAdCd1_0" id="hidAdCd1_0" value="<?=$hidAdCd1[0]?>" />
								  <input type="hidden" name="hidAdGubun1_0" id="hidAdGubun1_0" value="<?=$hidAdGubun1[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo1_0" type="text" name="txtMemo1_0" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"  value="<?=$txtMemo1[0]?>"   onblur="BlurColor(this);" onfocus="this.select();'" />
								  </td>
								</tr>
								<tr>
								  <th class="center"><input type="checkbox" name="chk1_1" id="chk1_1" class="checkbox" /></th>
								  <th>출산보육수당</th>
								  <td><input id="txtPayAmt1_1" type="text" name="txtPayAmt1_1" class="text-right" onkeyup="inputNumberFormat(this)" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();" value="<?=$txtPayAmt1[1]?>" />
								  <input type="hidden" name="hidAdCd1_1" id="hidAdCd1_1" value="<?=$hidAdCd1[0]?>" />
								  <input type="hidden" name="hidAdGubun1_1" id="hidAdGubun1_1" value="<?=$hidAdGubun1[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo1_1" type="text" name="txtMemo1_1" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"   value="<?=$txtMemo1[1]?>" onblur="BlurColor(this);" onfocus="this.select();"  />
								  </td>
								</tr>
								<tr>
								  <th class="center"><input type="checkbox" name="chk1_2" id="chk1_2" class="checkbox" /></th>
								  <th>부양가족수당</th>
								  <td><input id="txtPayAmt1_2" type="text" name="txtPayAmt1_2" class="text-right" onkeyup="inputNumberFormat(this)" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();" value="<?=$txtPayAmt1[2]?>" />
								  <input type="hidden" name="hidAdCd1_2" id="hidAdCd1_2" value="<?=$hidAdCd1[0]?>" />
								  <input type="hidden" name="hidAdGubun1_2" id="hidAdGubun1_2" value="<?=$hidAdGubun1[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo1_2" type="text" name="txtMemo1_2" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"   value="<?=$txtMemo1[2]?>" onblur="BlurColor(this);" onfocus="this.select();"  />
								  </td>
								</tr>
								<tr>
								  <th class="center"><input type="checkbox" name="chk1_3" id="chk1_3" class="checkbox" /></th>
								  <th>식대</th>
								  <td><input id="txtPayAmt1_3" type="text" name="txtPayAmt1_3" class="text-right" onkeyup="inputNumberFormat(this)" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();" value="<?=$txtPayAmt1[3]?>" />
								  <input type="hidden" name="hidAdCd1_3" id="hidAdCd1_3" value="<?=$hidAdCd1[0]?>" />
								  <input type="hidden" name="hidAdGubun1_3" id="hidAdGubun1_3" value="<?=$hidAdGubun1[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo1_3" type="text" name="txtMemo1_3" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"   value="<?=$txtMemo1[3]?>" onblur="BlurColor(this);" onfocus="this.select();"  />
								  </td>
								</tr>
								<tr>
								  <th class="center"><input type="checkbox" name="chk1_4" id="chk1_4" class="checkbox" /></th>
								  <th>차량유지비</th>
								  <td><input id="txtPayAmt1_4" type="text" name="txtPayAmt1_4" class="text-right" onkeyup="inputNumberFormat(this)" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();" value="<?=$txtPayAmt1[4]?>" />
								  <input type="hidden" name="hidAdCd1_4" id="hidAdCd1_4" value="<?=$hidAdCd1[0]?>" />
								  <input type="hidden" name="hidAdGubun1_4" id="hidAdGubun1_4" value="<?=$hidAdGubun1[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo1_4" type="text" name="txtMemo1_4" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"   value="<?=$txtMemo1[4]?>" onblur="BlurColor(this);" onfocus="this.select();"  />
								  </td>
								</tr>
								   
							<!--//수당사항-->    
							<!--공제사항-->            
								<tr>
								  <th class="center"><input type="checkbox" name="chk2_0" id="chk2_0" class="checkbox" /></th>
								  <th>소득세</th>
								  <td><input id="txtPayAmt2_0" type="text" name="txtPayAmt2_0" class="text-right" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();" value="<?=$txtPayAmt2[0]?>" />
								  <input type="hidden" name="hidAdCd2_0" id="hidAdCd2_0" value="<?=$hidAdCd2[0]?>" />
								  <input type="hidden" name="hidAdGubun2_0" id="hidAdGubun2_0" value="<?=$hidAdGubun2[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo2_0" type="text" name="txtMemo2_0" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"   value="<?=$txtMemo2[0]?>" onblur="BlurColor(this);" onfocus="this.select();"  />
								  </td>
								</tr>
								<tr>
								  <th class="center"><input type="checkbox" name="chk2_1" id="chk2_1" class="checkbox" /></th>
								  <th>주민세</th>
								  <td><input id="txtPayAmt2_1" type="text" name="txtPayAmt2_1" class="text-right" onkeyup="inputNumberFormat(this)" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();" value="<?=$txtPayAmt2[1]?>" />
								  <input type="hidden" name="hidAdCd2_1" id="hidAdCd2_1" value="<?=$hidAdCd2[0]?>" />
								  <input type="hidden" name="hidAdGubun2_1" id="hidAdGubun2_1" value="<?=$hidAdGubun2[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo2_1" type="text" name="txtMemo2_1" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"   value="<?=$txtMemo2[1]?>" onblur="BlurColor(this);" onfocus="this.select();"  />
								  </td>
								</tr>
								<tr>
								  <th class="center"><input type="checkbox" name="chk2_2" id="chk2_2" class="checkbox" /></th>
								  <th>국민연금</th>
								  <td><input id="txtPayAmt2_2" type="text" name="txtPayAmt2_2" class="text-right" onkeyup="inputNumberFormat(this)" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();" value="<?=$txtPayAmt2[2]?>" />
								  <input type="hidden" name="hidAdCd2_2" id="hidAdCd2_2" value="<?=$hidAdCd2[0]?>" />
								  <input type="hidden" name="hidAdGubun2_2" id="hidAdGubun2_2" value="<?=$hidAdGubun2[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo2_2" type="text" name="txtMemo2_2" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"   value="<?=$txtMemo2[2]?>" onblur="BlurColor(this);" onfocus="this.select();"  />
								  </td>
								</tr>
								<tr>
								  <th class="center"><input type="checkbox" name="chk2_3" id="chk2_3" class="checkbox" /></th>
								  <th>건강보험</th>
								  <td><input id="txtPayAmt2_3" type="text" name="txtPayAmt2_3" class="text-right" onkeyup="inputNumberFormat(this)" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();" value="<?=$txtPayAmt2[3]?>" />
								  <input type="hidden" name="hidAdCd2_3" id="hidAdCd2_3" value="<?=$hidAdCd2[0]?>" />
								  <input type="hidden" name="hidAdGubun2_3" id="hidAdGubun2_3" value="<?=$hidAdGubun2[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo2_3" type="text" name="txtMemo2_3" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"   value="<?=$txtMemo1[3]?>" onblur="BlurColor(this);" onfocus="this.select();"  />
								  </td>
								</tr>
								<tr>
								  <th class="center"><input type="checkbox" name="chk2_4" id="chk2_4" class="checkbox" /></th>
								  <th>고용보험</th>
								  <td><input id="txtPayAmt2_4" type="text" name="txtPayAmt2_4" class="text-right" onkeyup="inputNumberFormat(this)" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();" value="<?=$txtPayAmt2[4]?>" />
								  <input type="hidden" name="hidAdCd2_4" id="hidAdCd2_4" value="<?=$hidAdCd2[0]?>" />
								  <input type="hidden" name="hidAdGubun2_4" id="hidAdGubun2_4" value="<?=$hidAdGubun2[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo2_4" type="text" name="txtMemo2_4" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"   value="<?=$txtMemo1[4]?>" onblur="BlurColor(this);" onfocus="this.select();"  />
								  </td>
								</tr>
								<tr>
								  <th class="center"><input type="checkbox" name="chk2_5" id="chk2_5" class="checkbox" /></th>
								  <th>장기요양</th>
								  <td><input id="txtPayAmt2_5" type="text" name="txtPayAmt2_5" class="text-right" onkeyup="inputNumberFormat(this)" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();" value="<?=$txtPayAmt2[5]?>" />
								  <input type="hidden" name="hidAdCd2_5" id="hidAdCd2_5" value="<?=$hidAdCd2[0]?>" />
								  <input type="hidden" name="hidAdGubun2_5" id="hidAdGubun2_5" value="<?=$hidAdGubun2[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo2_5" type="text" name="txtMemo2_5" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"   value="<?=$txtMemo1[5]?>" onblur="BlurColor(this);" onfocus="this.select();"  />
								  </td>
								</tr>
								<tr>
								  <th class="center"><input type="checkbox" name="chk2_6" id="chk2_6" class="checkbox" /></th>
								  <th>연말정산</th>
								  <td><input id="txtPayAmt2_6" type="text" name="txtPayAmt2_6" class="text-right" onkeyup="inputNumberFormat(this)" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();" value="<?=$txtPayAmt2[6]?>" />
								  <input type="hidden" name="hidAdCd2_6" id="hidAdCd2_6" value="<?=$hidAdCd2[0]?>" />
								  <input type="hidden" name="hidAdGubun2_6" id="hidAdGubun2_6" value="<?=$hidAdGubun2[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo2_6" type="text" name="txtMemo2_6" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"   value="<?=$txtMemo1[6]?>" onblur="BlurColor(this);" onfocus="this.select();"  />
								  </td>
								</tr>
								<tr>
								  <th class="center"><input type="checkbox" name="chk2_7" id="chk2_7" class="checkbox" /></th>
								  <th>사우회비</th>
								  <td><input id="txtPayAmt2_7" type="text" name="txtPayAmt2_7" class="text-right" onkeyup="inputNumberFormat(this)" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();" value="<?=$txtPayAmt2[7]?>" />
								  <input type="hidden" name="hidAdCd2_7" id="hidAdCd2_7" value="<?=$hidAdCd2[0]?>" />
								  <input type="hidden" name="hidAdGubun2_7" id="hidAdGubun2_7" value="<?=$hidAdGubun2[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo2_7" type="text" name="txtMemo2_7" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"   value="<?=$txtMemo1[7]?>" onblur="BlurColor(this);" onfocus="this.select();"  />
								  </td>
								</tr>
								<tr>
								  <th class="center"><input type="checkbox" name="chk2_8" id="chk2_8" class="checkbox" /></th>
								  <th>공제항목 추가가능</th>
								  <td><input id="txtPayAmt2_8" type="text" name="txtPayAmt2_8" class="text-right" onkeyup="inputNumberFormat(this)" onkeyup="formatNumber(this.value,'0',this,'',16,'입력 최대 길이를 초과하였습니다.');"  style="width:97%;" onblur="BlurColor(this);" onfocus="this.select();" value="<?=$txtPayAmt2[8]?>" />
								  <input type="hidden" name="hidAdCd2_8" id="hidAdCd2_8" value="<?=$hidAdCd2[0]?>" />
								  <input type="hidden" name="hidAdGubun2_8" id="hidAdGubun2_8" value="<?=$hidAdGubun2[0]?>" />
								  </td>
								  <td>
									<input id="txtMemo2_8" type="text" name="txtMemo2_8" class="default" style="width:97%;" onkeyup="fnCharacterCheck(this);fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');"   value="<?=$txtMemo1[8]?>" onblur="BlurColor(this);" onfocus="this.select();"  />
								  </td>
								</tr>
								<tr>       
									<th class="center"><input type="checkbox" name="chk4_up" id="chk4_up" class="checkbox" /></th>  
									<th>상단메시지</th>
									<td>
										<input type="text" style="width:97%;" class="graybox" disabled="disabled" />
									</td>
									<td>            
										<input id="txtCommentUp" type="text" name="txtCommentUp" class="default" style="width:97%;" onkeyup="fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');" onblur="BlurColor(this);"    onfocus="this.select();"  value="<?=$txtCommentUp?>"  />           
									</td>
								</tr>
								<tr>       
									<th class="center"><input type="checkbox" name="chk4_down" id="chk4_down" class="checkbox" /></th>  
									<th>하단메시지</th>
									<td>
										<input type="text" style="width:97%;" class="graybox" disabled="disabled" />
									</td>
									<td>
										<input id="txtCommentDown" type="text" name="txtCommentDown" class="default" style="width:97%;" onkeyup="fnUtfTextCheck($(this).get(0).id,200,'최대 200자까지 입력 가능합니다.');" onblur="BlurColor(this);"    onfocus="this.select();"  value="※수고하셨습니다"  />
									</td>
								</tr>
							</table>

							<!--//공제사항-->
							</div><!--contents end-->    
							 
						  <br /><br /><br /><br />   
						  <input name="emp_cd" type="hidden" id="emp_cd" value="<?=$emp_cd?>" />
						  <input name="emp_nm" type="hidden" id="emp_nm" value="<?=$emp_nm?>" />
						  <input name="lastday" type="hidden" id="lastday" value="<?=$lastday?>" />
						  <input name="hidYyyyMm" type="hidden" id="hidYyyyMm" value="2017" />
						  <input name="hidPayGubun" type="hidden" id="hidPayGubun" value="11" />
						  <input name="hidPayGroup" type="hidden" id="hidPayGroup" value="0" />
						  <input name="hidRateFlag" type="hidden" id="hidRateFlag" value="0" />
						  <input name="hidBonusAmt" type="hidden" id="hidBonusAmt" />
						  <input name="hidPayRate" type="hidden" id="hidPayRate" />
						</div><!--wap end-->  
							</table>    
					</form>
				</div>
			</div><!-- /.row -->

			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="fnSave();" onkeydown="javascript:if(event.keyCode== 13){fnSave();}" value="저장(F8)">
						<i class="ace-icon fa fa-minus-square bigger-110"></i>
						저장
					</button>

					<button class="btn " type="button" onclick="fnRedirect()">
						<i class="ace-icon fa fa-minus-square bigger-110"></i>
						다시작성
					</button>

					<button class="btn " type="button"  onclick="self.close();" >
						<i class="ace-icon fa fa-minus-square bigger-110"></i>
						닫기
					</button>

					<button class="btn" type="reset" onclick="gfnDelete()">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						삭제
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-phone').mask('(999) 999-9999');
	$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
	$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});

	//override dialog's title function to allow for HTML titles
	$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
		_title: function(title) {
			var $title = this.options.title || '&nbsp;'
			if( ("title_html" in this.options) && this.options.title_html == true )
				title.html($title);
			else title.text($title);
		}
	}));
	
	//datepicker plugin
	//link
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	})
	//show datepicker when clicking on the icon
	.next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
			
	//or change it into a date range picker
	$('.input-daterange').datepicker({autoclose:true});
			
			
	//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
	$('input[name=date-range-picker]').daterangepicker({
		'applyClass' : 'btn-sm btn-success',
		'cancelClass' : 'btn-sm btn-default',
		locale: {
			applyLabel: 'Apply',
			cancelLabel: 'Cancel',
		}
	})
	.prev().on(ace.click_event, function(){
		$(this).next().focus();
	});
			
	$('#timepicker1').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#timepicker1').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
				
	if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
		 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
		 icons: {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar',
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down',
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			today: 'fa fa-arrows ',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		}
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
});
</script>
<!----------------------------------------------------------------------------------------------------------------------->
<script language="javascript" type="text/javascript">
                        
            function fnTabGubun(id) {
                var frm = $("#form1").get(0);
                frm.hidTab.value = id;
                if (id == "Tab1") {
                    $("#Tab1").css("display", "");
                    $("#Tab2").css("display", "none");
                    $("#LiTab1").toggleClass("nav_tabon", true);
                    $("#LiTab2").toggleClass("nav_tabon", false);
                    $("#txtPayAmt1_0").focus();
                } else {
                    $("#Tab1").css("display", "none");
                    $("#Tab2").css("display", "");
                    $("#LiTab1").toggleClass("nav_tabon", false);
                    $("#LiTab2").toggleClass("nav_tabon", true);      
                    $("#txtPayAmt2_0").focus();             
                }
            }
            
            function fnChoiceDel(){                
                var iCnt = 5;
                for(row=0; row < iCnt; row++){
                    if($("#chk1_"+row).get(0).checked == true){
                        $("#txtPayAmt1_"+row).get(0).value = "";
                        $("#txtMemo1_" + row).get(0).value = "";
                    }
                }
                
                var iCnt2 = 9;
                for(row=0; row < iCnt2; row++){
                    if($("#chk2_"+row).get(0).checked == true){
                        $("#txtPayAmt2_"+row).get(0).value = "";
                        $("#txtMemo2_" + row).get(0).value = "";
                    }
                } 
                
                 

                
                if($("#chk4_up").get(0).checked == true){
                    $("#txtCommentUp").get(0).value = "";
                }
                
                if($("#chk4_down").get(0).checked == true){                    
                    $("#txtCommentDown").get(0).value = "";
                }          
            }
            
            function fnAll(gubun){
                
                var iCnt = 5
                for(row=0; row < iCnt; row++){
                    if($("#chkAll").get(0).checked == true){
                        $("#chk1_"+row).get(0).checked = true;
                    }
                    else{
                        $("#chk1_"+row).get(0).checked = false;
                    }
                }
                
                var iCnt2 = 9
                for(row=0; row < iCnt2; row++){
                    if($("#chkAll").get(0).checked == true){
                        $("#chk2_"+row).get(0).checked = true;
                    }
                    else{
                        $("#chk2_"+row).get(0).checked = false;
                    }
                }           
                
                

                if($("#chkAll").get(0).checked == true){
                    $("#chk4_up").get(0).checked = true;
                    $("#chk4_down").get(0).checked = true;                    
                }    
            }
            
        function Click_F8() {
            fnSave();
        }
        
        function fnSave() {
			/*
            if ("W" == "R") {
                alert("읽기 권한자는 사용할 수 없는 기능입니다.\n\n마스터에게 문의 바랍니다.");
                return false;
            }
            else if ("W" == "U") {
                alert("수정 권한이 없습니다.");
                return false;
            }    
            */
            var ROW_CNT1 = 5
            var ROW_CNT2 = 9
            var strPayAmt1 = "";
            var strAdGubun1 = "";
            var strAdCd1 = "";
            var strPayAmt2 = "";
            var strAdGubun2 = "";
            var strAdCd2 = "";
            var strMemo1 = "";
            var strMemo2 = "";
            var RegExp = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+┼<>@\#$%&\'\"\\\(\=]/gi;

            for (var rowIndex1 = 0; rowIndex1 < ROW_CNT1; rowIndex1++) {
                strPayAmt1 += $("#txtPayAmt1_" + rowIndex1).val() + "|"; // 금액
                strAdGubun1 += $("#hidAdGubun1_" + rowIndex1).val() + "|"; //지급공제구분
                strAdCd1 += $("#hidAdCd1_" + rowIndex1).val() + "|"; // 지급공제코드
                strMemo1 += $("#txtMemo1_" + rowIndex1).val().replace(RegExp,"") + "|"; // 메모
                //빈값이 아니면 숫자 체크
                if( $("#txtPayAmt1_" + rowIndex1).val() != "" && fnNumberChk(  $("#txtPayAmt1_" + rowIndex1).val()   ) )
                {
                    alert("숫자만 입력 가능합니다.");
                    if($("#hidTab").get(0).value == "Tab1")
                        $("#txtPayAmt1_" + rowIndex1).get(0).focus();

                    return false;
                }
            }
            for (var rowIndex2 = 0; rowIndex2 < ROW_CNT2; rowIndex2++) {
                strPayAmt2 += $("#txtPayAmt2_" + rowIndex2).val() + "|"; // 금액
                strAdGubun2 += $("#hidAdGubun2_" + rowIndex2).val() + "|"; // 지급공제구분
                strAdCd2 += $("#hidAdCd2_" + rowIndex2).val() + "|"; // 지급공제코드
                strMemo2 += $("#txtMemo2_" + rowIndex2).val().replace(RegExp,"") + "|"; // 메모
                //빈값이 아니면 숫자 체크
                if( $("#txtPayAmt2_" + rowIndex2).val() != "" && fnNumberChk(  $("#txtPayAmt2_" + rowIndex2).val()   ) )
                {
                    alert("숫자만 입력 가능합니다.");
                    if($("#hidTab").get(0).value == "Tab2")
                        $("#txtPayAmt2_" + rowIndex2).get(0).focus();

                    return false;
                }
            }
            $("#hidPayAmt").val(strPayAmt1+strPayAmt2);
            $("#hidMemo").val(strMemo1+strMemo2);
            $("#hidAdGubun").val(strAdGubun1+strAdGubun2);
            $("#hidAdCd").val(strAdCd1+strAdCd2);
            
            var strBonusAmt = "";
            var strPayRate = "";
            //지급액(율)            
            
                strPayRate = $("#txtPayRate").val();
                $("#hidPayRate").val(strPayRate);
            

            //상/하단 메시지
            var strCommentUp = "";
            var strCommentDown = "";
            strCommentUp = $("#txtCommentUp").val();
            strCommentDown = $("#txtCommentDown").val();

            $("#hidCommentUp").val(strCommentUp);
            $("#hidCommentDown").val(strCommentDown);

            //_doPostBack("lnkSave", "");
            //return false;

			fnSubmit();
        }
        
		function fnSubmit() {
            $("#frm")
            .attr("method", "post")
            //.attr("target", "EPG013M")
            //.attr("action", fnSetUrlPath("EPG013M_SAVE.aspx", "ec_req_sid"))
            .submit(); 
        }

        function fnLode(){
            window.close();
            window.opener.form1.action = fnSetUrlPath("EPG012P_01.aspx", "ec_req_sid")
            window.opener.form1.target = "";
            window.opener.fnSearch();
        }
        
        function fnRedirect() {
            _doPostBack("lnkRedirect","");
            return false;
        }

         //다음필드로 넘기기
        function fnEnterHandles1(field, event, gubun) { //gubun 1: next, 2:return nextname
            var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
            var next = 0;
            if (keyCode == 13 || gubun == "2" ) {
                var iField;
                for (iField = 0; iField < field.form.elements.length; iField++) {
                    if (field == field.form.elements[iField])
                        break;
                }
                iField = (iField + 1) % field.form.elements.length;
                while (true) {
                    if (field.form.elements[iField] != undefined) {
                        tag = field.form.elements[iField].tagName.toLowerCase();
                        if ((field.form.elements[iField].type == "text" || field.form.elements[iField].type == "textarea" || tag == "select"  || field.form.elements[iField].type == "radio") && field.form.elements[iField].readOnly != true  && field.form.elements[iField].disabled != true && field.form.elements[iField].style.visibility == "" && field.form.elements[iField].style.display != "none") {
                            if (gubun == "1")                    
                                field.form.elements[iField].focus();
                            else
                                return field.form.elements[iField].name;
                            next = 1;
                            break;
                        }
                        else {
                            iField++;
                            continue;
                        }
                    }
                    else {
                        break;
                    }
                }
                return next;
            }
        }
        //특수문자 체크
        function fnCharacterCheck(obj) {
           //정규식 구문
           var RegExp = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+┼<>@\#$%&\'\"\\\(\=]/gi;
           if (RegExp.test(obj.value)) {
                alert('특수문자는 사용하지 않는 것을 원칙으로 합니다.<br />사용을 원할 경우에는 한글자음+한자키를 눌러 나오는 기호를 사용 바랍니다.<br />사용 금지 특수문자 예시 : & = ` \ / : * ? ’ ’’ 등');
                //특수문자를 지우는 구문
                obj.value = obj.value.replace(RegExp,"");
            } 
        }
		function fnNumberChk(val) {
			val = val.trim().replace(/([\,])/g, '');
			var reg = /([^0-9\.\-])/g;
			return reg.test(val);
		}
		function _doPostBack(eventTarget, eventArgument) {
			if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
				theForm.__EVENTTARGET.value = eventTarget;
				theForm.__EVENTARGUMENT.value = eventArgument;
				theForm.submit();
			}
		}
		
        </script>

<!----------------------------------------------------------------------------------------------------------------------->