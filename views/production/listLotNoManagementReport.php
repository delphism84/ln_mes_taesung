<?
$title = "LOT NO 관리 대장";

session_start();
extract($_POST);
extract($_GET);

	$where = "";
	if ($process_gb == ""){ 
		$where .= " where process_gb='1공장'" ;
	}else{
		$where .= " where process_gb='".$process_gb."'" ;
	}
	/*
	if ($search_process_gb != "" && $search_choice != "" && $search_txt!= ""){ 
		if($search_choice == "lot_no_nm") {
			$wheres .= " and lot_no_nm like '%".$search_txt."%'";
		} else if($search_choice == "account_cd") {
			$wheres .= " and item_nm like '%".$search_txt."%'";
		}
	}
	*/
	$barcodeCut = substr($search_txt, 0, 11);

	if ($search_txt !=""){
		
		$sql = "select * from erp_warehousing_item where lot_no_cd='".$barcodeCut."'";
		$t10 = mysql_fetch_object(mysql_query($sql));
	}


?>
<div class="main-content">
	<div class="main-content-inner">
		<!-- 페이지 상단 Location -->
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#">생산관리</a>
				</li>
				<li class="active">LOT 관리대장</li>
			</ul>
		</div>
		<!--<input type="text" value="<?=$where?>" style="width:500px;"/>-->
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					LOT 관리대장 
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 LOT 관리대장을 등록,조회 하실 수 있습니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="widget-header">
						<form name="frm" id="frm" method="post" action="index.php" />
						<input type="hidden" name="controller" id="controller" value="production" />
						<input type="hidden" name="uid" id="uid" value="<?=$uid?>" />
						<input type="hidden" name="action" id="action" value="listLotNoManagementReport" />
						<input type="hidden" name="process_uid" id="process_uid" />

							<div class="col-xs-6" style="float:left">							
							<span style="color:green">* 작업지시서와 lot번호를 기준으로 조회합니다.</span>
							<span style="color:red">* LOT 번호는 11자리 이내로 해주세요.</span>
						<!--
							<div class="col-xs-6" style="float:left">
								<div class="row">
									<div class="input-group">
										<div class="col-xs-5">
										F	<select name="process_gb" id="process_gb" class="form-control" onchange="postProcessGb(this.value)">
												<option value="1공장" <? if ($process_gb=="1공장") echo "selected"?>>1공장</option>
												<option value="2공장" <? if ($process_gb=="2공장") echo "selected"?>>2공장</option>
												<option value="연태공장" <? if ($process_gb=="연태공장") echo "selected"?>>연태공장</option>
											</select>
										</div>
										<div class="left col-xs-6 layer" >
											<select name="process_cd" id="process_cd" onchange="postProcessNm(this.value)" class="form-control"><option value="0">공정전체</option></select>
										</div>
									</div>
								</div>
							</div>	
						-->
							</div>
							<div class="col-xs-6" style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="원자재 LOT_NO 검색" name="search_txt" id="search_txt" value="<?=$search_txt?>" onkeypress="if(event.keyCode==13) {search();}"/>
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="search()" >
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											검색
										</button>
									</span>
								</div>
							</div>
						</form>
					</div>
					<div class="row">
					<div class="col-xs-12" style='margin:5px 5px 5px 5px;'>
					  <div class="col-md-2"><span class="label label-lg label-pink arrowed-right">원재료 LOT NO</span> : <?=$search_txt?></div>
					  <div class="col-md-2 text-right"><span class="label label-lg label-grey arrowed-right">품목명</span> : <?=$t10->item_nm?></div>  
					  <div class="col-md-2 text-right"><span class="label label-lg label-grey arrowed-right">품번</span> : <?=$t10->item_cd?></div>
					  </div>
					</div>
					<div class="widget-body" style='border-top:1px #aaaaaa solid'>
						<div class="widget-main no-padding">
							<table class="table table-striped table-bordered table-hover" >
								<thead class="thin-border-bottom">
									<tr>
										<th class="col-xs-1 center no-padding" style="background-color:#eeeeee;width:80px" >
											구매입고일
										</th>
										<?	
											$query = "select * from erp_process".$where;
											//echo  $query;
											$result = mysql_query($query) or die (mysql_error());
											$cnt="1";
											$i = 0;
											while($t1 = mysql_fetch_object($result)) {

												$list[$i]['process_cd'] = $t1->process_cd;
												$list[$i]['process_nm'] = $t1->process_nm;
										?>
										<th class=" no-padding " style="350px">
											<table class="table table-bordered no-padding" style="height:50px;">
											<thead class="thin-border-bottom no-padding">
												<TR>
												<th class="center" colspan='2'  style="background-color:#eeeeee"><?=$t1->process_nm?></th>
												</TR>
												<TR>
												<!--//도금은 도금입고일로 해달라고하여 분기처리.-->
												<? if($t1->process_nm =="도금"){ ?>

												<th class="col-xs-5 center"  style="background-color:#eeeeee" nowrap>도금 입고일</th><th class="col-xs-6 center"  style="background-color:#eeeeee" nowrap>불량/양품수량</th>

												<? }else{ ?>

												<th class="col-xs-5 center"  style="background-color:#eeeeee" nowrap><?=$t1->process_nm?>일</th><th class="col-xs-6 center"  style="background-color:#eeeeee" nowrap>불량/양품수량</th>

												<? } ?>

												</TR>
											</thead>
											</table>
										</th>
										<?	$i++;
											$cnt++;
										}				
										?>
										<th class="center no-padding" style="background-color:#eeeeee;width:100px">
											출하일 / 출고량
										</th>
										<th class="center no-padding" style="background-color:#eeeeee;width:100px">
											비고
										</th>
									</tr>
										
								</thead>
								<tbody>
									<?	
										if ($process_gb=='1공장'){
												$process_cd_left ="1";
										}else if ($process_gb=='2공장'){
												$process_cd_left ="2";
										}else if ($process_gb=='연태공장'){
												$process_cd_left ="3";
										}else{
												$process_cd_left ="1";
										}
										$sql = "select *, A.uid as Auid from erp_warehousing as A join erp_warehousing_item as B on A.uid=B.fid where left(warehouse_cd,1)='".$process_cd_left."' and lot_no_cd = '".$barcodeCut."'";
										//echo $sql; 
										$result = mysql_query($sql) or die (mysql_error());
										$is = 0;
										while($t = mysql_fetch_object($result)) {
									?>
										<tr>
											<td class="col-xs-1 center" style="color:red"><a href='javascript:void(0);' onclick="warehousing_view('<?=$t->Auid?>')" style="color:red;text-decoration:underline"><?=substr($t->warehousing_cd,0,10)?></a>
											</td>

											<!--////////////////////////////////////////////////////////////////////////////////////-->
											<td class="col-xs-1 no-padding" > <!-- 프레스 가공 -->
												<?
													$sql1 = "select *, A.uid as Auid from erp_product_perf_repost as A join erp_product_perf_repost_item as B on A.uid=B.fid where process_nm='".$list[0]['process_nm']."' and B.lot_no_cd='".$barcodeCut."'  order by Auid asc";
													$result1 = mysql_query($sql1) or die (mysql_error());
													$iss = 0;
													while($t2 = mysql_fetch_object($result1)) {
														$trjump = 0;
														
													//ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
														//작업지시서로 묶인 공정들 Data가 각 공정별로 몇개인지 확인후 그중 최대한 큰 값을 구한다.(세로공간띄어쓰기를 위해...)
														
															$work_cd[$iss]= $t2->work_cd;

															if($work_cd[$iss-1] != $work_cd[$iss]){
																															
																for($pp = 0 ; $pp < sizeof($list) ; $pp++ ){

																	$sql22 = "select count(*) as countTotal from erp_product_perf_repost as A join erp_product_perf_repost_item as B on A.uid=B.fid where process_nm='".$list[$pp]['process_nm']."' and B.lot_no_cd='".$barcodeCut."' and work_cd='".$t2->work_cd."'";
																	
																	$result22 = mysql_query($sql22) or die (mysql_error());
																	$getcnt = mysql_fetch_object($result22);

																	if($getcnt->countTotal > 0){
																		if($getcnt->countTotal > $trjump){
																			$trjump = $getcnt->countTotal;
																		}
																	}
																}
																
																//echo $trjump."띄워야함..";
																$trcount[$iss] = $trjump;
															}
														

													//ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ



												?>
												<table id="process_list_<?=$i?>" class="table table-bordered no-padding" >
													<thead class="thin-border-bottom no-padding">
														<tbody>
														<!--<tr <?if ($iss==0) echo "style='border-bottom:1px #dddddd solid'"?>>-->
														<tr>
															<td class="col-xs-6 center" ><a href='javascript:void(0);' onclick="product_p_reports_view('<?=$t2->Auid?>')" ><?=$t2->production_dt?></a></td>
															<td class="col-xs-6 center" ><a href='javascript:void(0);' onclick="product_p_reports_view('<?=$t2->Auid?>')"><?=$t2->faulty_qty1+$t2->faulty_qty2+$t2->faulty_qty3+$t2->faulty_qty4+$t2->faulty_qty5+$t2->faulty_qty6+$t2->faulty_qty7?> / <?=number_format($t2->output_qty)?></a></td>
														</tr>
														
														<? for($kk = 0 ; $kk < $trjump ; $kk++){ ?>
															
															<tr>
																<td class="col-xs-6 center" >--</td>
																<td class="col-xs-6 center" >--</td>
															</tr>

														<?	} ?>
															
														</tbody>
													</thead>
												</table>
													<?
													$iss++;	
													}?>
											</td>
											<!--////////////////////////////////////////////////////////////////////////////////////-->
											<?for($i=1; $i<$cnt-1 ; $i++){?>
											<td class="col-xs-1 no-padding" >



												<? for($k1 = 0 ; $k1 < $iss ; $k1++ ){
													$sql1 = "select *, A.uid as Auid from erp_product_perf_repost as A join erp_product_perf_repost_item as B on A.uid=B.fid where process_nm='".$list[$i]['process_nm']."' and B.lot_no_cd='".$barcodeCut."' and work_cd='".$work_cd[$k1]."' order by Auid asc";
													//echo $sql1; 

													$result2 = mysql_query($sql1) or die (mysql_error());
													$check_total_cnt = mysql_num_rows($result2);

													$checktr = $trcount[$k1];

													if($check_total_cnt > 0 ){

														$cnt_check = 1;
														while($t33 = mysql_fetch_object($result2)) {
															
														//ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
															//작업지시서로 묶인 공정들 Data가 각 공정별로 몇개인지 확인후 그중 최대한 큰 값을 구한다.(세로공간띄어쓰기를 위해...)
															
															if($work_cd[$k1] == $t33->work_cd ){
																$checktr -=1;
															}

														//ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ

															?>
															<table id="process_list2_<?=$i?>" class="table table-bordered no-padding" >
																<thead class="thin-border-bottom no-padding">
																	<tbody>
																	<tr>
																		<td class="col-xs-6 center" ><a href='javascript:void(0);' onclick="product_p_reports_view('<?=$t33->Auid?>')" ><?=$t33->production_dt?></a></td>
																		<td class="col-xs-6 center" ><a href='javascript:void(0);' onclick="product_p_reports_view('<?=$t33->Auid?>')"><?=$t33->faulty_qty1+$t33->faulty_qty2+$t33->faulty_qty3+$t33->faulty_qty4+$t33->faulty_qty5+$t33->faulty_qty6+$t33->faulty_qty7?> / <?=number_format($t33->output_qty)?></a></td>
																	</tr>
																	
																	</tbody>
																</thead>
															</table>

															<? if( $cnt_check  == $check_total_cnt  ){ ?>
																<? for($kk = 0 ; $kk < $checktr+1 ; $kk++){ ?>
																	<table id="process_list2_<?=$i?>" class="table table-bordered no-padding" >
																		<thead class="thin-border-bottom no-padding">
																			<tbody>
																				<tr>
																					<td class="col-xs-6 center" >--</td>
																					<td class="col-xs-6 center" >--</td>
																				</tr>
																			</tbody>
																		</thead>
																	</table>

																<?	} ?>
															<? } ?>

															<?
															$cnt_check++;
															} 
													}else{
														for($kk = 0 ; $kk < $checktr+1 ; $kk++){ ?>
															<table id="process_list2_<?=$i?>" class="table table-bordered no-padding" >
																<thead class="thin-border-bottom no-padding">
																	<tbody>
																		<tr>
																			<td class="col-xs-6 center" >--</td>
																			<td class="col-xs-6 center" >--</td>
																		</tr>
																	</tbody>
																</thead>
															</table>

												<?	
														} 
														
													}
												}
													
												?>



											</td>
											<?}?>
											<!--////////////////////////////////////////////////////////////////////////////////////-->

											<td class="col-xs-1 center no-padding" ><!-- 출하일/출고량 -->
													
												<?
											/*
												$order_cdArr = array();
												for($i1=0; $i1<$iss ; $i1++){
													
													$sql1 = "select workplan_cd from erp_work where work_cd='".$work_cd[$i1]."'";
													//echo $sql1."<BR>"; 
													$t101 = mysql_fetch_object(mysql_query($sql1));

													$sql2 = "select order_cd from erp_workplan where workplan_cd='".$t101->workplan_cd."'";
													//echo $sql2."<BR>"; 
													$t102 = mysql_fetch_object(mysql_query($sql2));
													array_push($order_cdArr, $t102->order_cd );													
												}
												$order_cdArr2 = array_unique($order_cdArr);

												for($k=0 ; $k < sizeof($order_cdArr2) ; $k++){
											*/
													/*///////////////////// 기존것 > 주문서 따라가는코드.
													$sql3 = "select * from erp_order_shipment where order_cd='".$order_cdArr2[$k]."'";
													//echo $sql3."<BR>"; 
													$result5 = mysql_query($sql3);
													*//////////////////////

												$sql22 = "select * from erp_order_shipment_item where lot_no_cd='".$barcodeCut."' order by sid asc";

												//echo $sql22;
												$result22 = mysql_query($sql22);

												
												$total_outqty = 0;
												while( $t103 = mysql_fetch_object($result22) ){
													
														$sql33 = "select * from erp_order_shipment where uid='".$t103->sid."' ";
														$result33 = mysql_query($sql33);

													while( $t104 = mysql_fetch_object($result33) ){
												?>	
													<table class="table table-bordered no-padding" >
														<thead class="thin-border-bottom no-padding">
															<tbody>
																<tr>
																	<td class="col-xs-12 center" ><a href='javascript:void(0);' onclick="orderShipment_view('<?=$t104->uid?>')" style="color:green;text-decoration:underline"><?=$t104->shipment_cd ?></a> 출고량 : <?=number_format($t103->cnt) ?></td>

																</tr>
															</tbody>
														</thead>
													</table>
												<?
													$total_outqty = $total_outqty + $t103->cnt;
														}
													}
												//}?>

												</td>
											<td class="col-xs-1 center no-padding" >&nbsp;


											</td>
										</tr>
									<?
										$is++;
										}
									?>
									<?if ($is=="0" ){?>
										<tr>
										<td colspan="<?=$cnt+3?>" class="col-xs-1 center" >등록된 LOT_NO 데이터가 없습니다.</td>
										</tr>
									<?}?>
									
								</tbody>
								<tfoot>
									<tr>
										<th class="col-xs-1 center no-padding" style="background-color:#eeeeee;width:80px" >
											합계
										</th>
										<?	
											$query = "select * from erp_process".$where;
											//echo  $query;
											$result = mysql_query($query) or die (mysql_error());
											
											$i = 0;
											while($t1 = mysql_fetch_object($result)) {

										?>
											<!--///////////////////////////-->
											
											<th class="center no-padding" style="background-color:#eeeeee;width:100px">
												<?
													$sql1 = "select sum(a.faulty_qty1) as faulty_qty1 , sum(a.faulty_qty2)as faulty_qty2 , sum(a.output_qty) as output_qty from erp_product_perf_repost as a join erp_product_perf_repost_item as B on a.uid=B.fid where a.process_nm='".$list[$i]['process_nm']."' and B.lot_no_cd='".$barcodeCut."' "; 
													//echo $sql1; 
													$result1 = mysql_query($sql1) or die (mysql_error());
													
													$perf_repost = mysql_fetch_object($result1);
	
												?>
													<span><? echo number_format($perf_repost->faulty_qty1 + $perf_repost->faulty_qty2). " / ".number_format($perf_repost->output_qty) ?></span>

													
											</th>
											<!--//////////////////////////////-->
										<?	
												$i++;
											}				
										?>
										<th class="center no-padding" style="background-color:#eeeeee;width:100px">
											<?=number_format($total_outqty)?>
										</th>
										<th class="center no-padding" style="background-color:#eeeeee;width:100px">
											
										</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>

					
					<div class="clearfix form-actions" style="margin-top:0px">
						<div class="col-md-12">
							<!-- <div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div> -->
							<? if($_SESSION['login_level'] >= 99) { ?>
							<!-- <div class="col-xs-6 right" style="text-align:right">
								<button class="btn btn-danger" type="button" onclick="deleteSelect()">
									<i class="ace-icon fa fa-undo"></i>
									선택삭제
								</button>
							</div> -->
							<?}?>
						</div>
					</div>

<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>

			
			
<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

		</div>
	</div>
</div>


<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="searchTxt" id="searchTxt" value="" />
<input type="hidden" name="where" id="where" value=" " />
<input type="hidden" name="item_gb" id="item_gb" value="" />
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />
<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">구매입고내역</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="warehousing_view_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="id-btn-dialog2" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">생산실적처리내역</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="product_perf_report_view_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="id-btn-dialog3" class="modal fade" draggable="true">
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">출하 지시서 내역</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="orderShipment_view_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- basic script ------------------------------------------------------------------------------------------------------->

<?
require_once ("assets/include_script.php");
?>
<script type="text/javascript">
<!--
	/***************/
	//$('.show-details-btn').on('click', function(e) {
	$( document).on('click',".show-details-btn", function(e) {
		e.preventDefault();
		//var page = $("#page").val();
		//getLotno(page);
		$(this).closest('tr').next().toggleClass('open');
		$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
	});
	/***************/
//-->
</script>
<!----------------------------------------------------------------------------------------------------------------------->
<script>
$(document).ready(function(){
	
	var page = $("#page").val();
	//getItem(page);
	var process_gb = $("#process_gb option:selected").val();
	getPostProcessNm(process_gb)
	//getProductPerfReports()
	$("#checkedAll").click(function(){
		if($("#checkedAll").prop('checked')) {
			$(".chk").each(function(){
				$(this).prop("checked",true);
			});
		} else {
			$(".chk").each(function(){
				$(this).prop("checked",false);
			});
		}
	});
});

function getPostProcessNm(gb){
	var tag = "<option value='0'>공정전체</option>";
	$.getJSON("ajax/production.php",{"mode":"getPostProcessNm", "process_gb" : gb},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].process_nm + "</option>";
				}
			}
			$("#process_cd").html(tag);
		}
	);
}

function postProcessGb(gb){
	//$("#where").val("where process_gb ='component'");
	getPostProcessNm(gb);
}

function postProcessNm(uid){
	$("#process_uid").val(uid);
}

// 검색
function search2(){
	var process_gb = $("#process_gb option:selected").val();
	var process_cd = $("#process_cd option:selected").val();

	var txt = $("#search_txt").val();

	if(search_choice == "item_nm") {
		$("#where").val(" where item_nm like '%" + txt + "%' ");
	} else if(search_choice == "item_cd") {
		$("#where").val(" where item_cd like '%" + txt + "%' ");
	} else if(search_choice == "item_group_nm") {
		$("#where").val(" where item_group_nm like '%" + txt + "%' ");
	}
	getItem(1);
}

function search(){
	if($("#search_txt").val()==""){
		alert("LOT_NO 검색어를 입력하세요 ");
		$("#search_txt").focus();
		return false;
	}
	$("#frm").submit();
}

// 거래처 리스트 가져오기
function getItem(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/production.php",{"page":page, "mode":"getItem", "rpp" : rpp, "adjacents" : adjacents, "where": where},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					switch(json[i].item_gb) {
						case "component" : var item_gb = "자재"; break;
						case "semi_product" : var item_gb = "반제품"; break;
						case "product" : var item_gb = "완제품"; break;
						default : var item_gb = "미구분"; break;
					} 

					if(json[i].item_gb != "component") { // 원자재는 BOM 이 없으므로
						tag += "<tr>";
						<? if($_SESSION['login_level'] >= 99) { ?>
						tag += "<td class='center'>";
						tag += "<label class='pos-rel'>";
						tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
						tag += "<span class='lbl'></span>";
						tag += "</label>";
						tag += "</td>";
						<?}?>
						tag += "<td>" + item_gb + "</td>";
						tag += "<td class='center'>";
							tag += "<div class='action-buttons'>";
								tag += "<a href='#' class='green bigger-140 show-details-btn' title='Show Details'>";
									tag += "<i class='ace-icon fa fa-angle-double-down'></i>";
									tag += "<span class='sr-only'>Details</span>";
								tag += "</a>";
							tag += "</div>";
						tag += "</td>";
						tag += "<td>" + json[i].item_cd + "</td>";
						tag += "<td>" + json[i].item_nm + "</td>";
						tag += "<td>" + json[i].standard1 + "</td>";
						tag += "<td>" + json[i].standard2 + "</td>";
						tag += "<td>" + json[i].standard3 + "</td>";
						tag += "<td>" + json[i].cnt + "</td>";
						tag += "<td></td>";
						tag += "<td><input type='button' class='btn btn-xs' value='BOM등록' onclick='bom(" + json[i].uid + ")' /></td>";
						tag += "</tr>";

						tag += "<tr class='detail-row'>";
						tag += "<td colspan='8'>";
							tag += "<div class='table-detail'>";
								tag += "<div class='row'>";
									tag += "<div class='widget-body'>";
									tag += "<div class='widget-main no-padding'>";
										tag += "<table id='item_list' class='table  table-bordered table-striped'>";
											tag += "<thead class='thin-border-bottom'>";
												tag += "<tr>";
													tag += "<? if($_SESSION['login_level'] >= 99) { ?>";
													tag += "<th class='detail-col center'>";
														tag += "<label class='pos-rel'>";
															tag += "<input type='checkbox' class='ace' id='checkedAll' />";
															tag += "<span class='lbl'></span>";
														tag += "</label>";
													tag += "</th>";
													tag += "<?}?>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 구분</th>";
													tag += "<th class='col-xs-2'><i class='ace-icon fa fa-caret-right blue'></i> 품목코드</th>";
													tag += "<th class='col-xs-2'><i class='ace-icon fa fa-caret-right blue'></i> 품목명</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 규격</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 규격</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 규격</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 원재료갯수</th>";
													tag += "<th class='col-xs-2'><i class='ace-icon fa fa-caret-right blue'></i> 파일관리</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> BOM등록</th>";
												tag += "</tr>";
											tag += "</thead>";
											tag += "<tbody></tbody>";
										tag += "</table>";
									tag += "</div>";
								tag += "</div>";
								tag += "</div>";
							tag += "</div>";
						tag += "</td>";
					tag += "</tr>";

					}
				}
			}

			$("#item_list tbody").html(tag);

			var table = "erp_item";
			getPaging(table,where,rpp,adjacents);
		}
	);
}


// 거래처 리스트 가져오기
function getLotno(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/production.php",{"page":page, "mode":"getItem", "rpp" : rpp, "adjacents" : adjacents, "where": where},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					switch(json[i].item_gb) {
						case "component" : var item_gb = "자재"; break;
						case "semi_product" : var item_gb = "반제품"; break;
						case "product" : var item_gb = "완제품"; break;
						default : var item_gb = "미구분"; break;
					} 

					if(json[i].item_gb != "component") { // 원자재는 BOM 이 없으므로
						tag += "<tr>";
						<? if($_SESSION['login_level'] >= 99) { ?>
						tag += "<td class='center'>";
						tag += "<label class='pos-rel'>";
						tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
						tag += "<span class='lbl'></span>";
						tag += "</label>";
						tag += "</td>";
						<?}?>
						tag += "<td>" + item_gb + "</td>";
						tag += "<td class='center'>";
							tag += "<div class='action-buttons'>";
								tag += "<a href='#' class='green bigger-140 show-details-btn' title='Show Details'>";
									tag += "<i class='ace-icon fa fa-angle-double-down'></i>";
									tag += "<span class='sr-only'>Details</span>";
								tag += "</a>";
							tag += "</div>";
						tag += "</td>";
						tag += "<td>" + json[i].item_cd + "</td>";
						tag += "<td>" + json[i].item_nm + "</td>";
						tag += "<td>" + json[i].standard1 + "</td>";
						tag += "<td>" + json[i].standard2 + "</td>";
						tag += "<td>" + json[i].standard3 + "</td>";
						tag += "<td>" + json[i].cnt + "</td>";
						tag += "<td></td>";
						tag += "<td><input type='button' class='btn btn-xs' value='BOM등록' onclick='bom(" + json[i].uid + ")' /></td>";
						tag += "</tr>";
					}
				}
			}

			$("#item_list tbody").html(tag);

			var table = "erp_item";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 실적관리 리스트 가져오기
function getProductPerfReports(){
	var rpp = 100;
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();
	var gubun = "1";

	$.getJSON("ajax/production.php",{"page":page, "mode":"getProductPerfReports", "rpp" : rpp, "adjacents" : adjacents, "where" : where, "gubun" : gubun},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick='product_p_reports_view(" + json[i].uid +")' >" + json[i].production_dt + "</a></td>";
					//tag += "<td class='center'><button class=\"btn btn-white btn-info btn-bold\" onclick='openWin(" + json[i].uid +")' ><i class=\"ace-icon fa fa-print bigger-120 blue\"></i>인쇄</button></td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='2' class='center' style='height:20px'> 등록된 실적데이터가 없습니다. </td>";
				tag += "</tr>";
			}

			$("#process_list_1 tbody").html(tag);
		}
	);
}


function bom(uid) {
	location.href = "index.php?controller=production&action=inputPageBom&uid=" + uid;
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getItem(page);
}

// 페이징 가져오기
function getPaging(table,where,rpp,adjacents){
	var data_string = "page=" + $("#page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents;

	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#paging_area").html(str);
		}
	});
}

// 선택 삭제
function deleteSelect(){
	if(confirm("선택하신 BOM 정보를 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectBom&table=erp_item&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/production.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getItem(1);
				}
			}
		});
	}
}

// 거래처 구분으로 거래처 리스트 가져오기
function setItem(val) {
	var item_gb = $("#item_gb option:selected").val();

	if(item_gb == "all") {
		$("#where").val(" where item_gb<>'component'");
	} else {
		$("#where").val(" where item_gb='" + val + "'");
	} 
	getItem(1);
}
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-phone').mask('(999) 999-9999');
	$('.input-mask-mobile').mask('(999) 9999-9999');
	$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
	$(".input-mask-product").mask("a*-999-a999",{
		placeholder:" ",completed:
			function(){
				alert("You typed the following: "+this.val());
			}
	});

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

	/////////
	$('#modal-form input[type=file]').ace_file_input({
		style:'well',
		btn_choose:'Drop files here or click to choose',
		btn_change:null,
		no_icon:'ace-icon fa fa-cloud-upload',
		droppable:true,
		thumbnail:'large'
	})

	//chosen plugin inside a modal will have a zero width because the select element is originally hidden
	//and its width cannot be determined.
	//so we set the width after modal is show
	$('#modal-form').on('shown.bs.modal', function () {
		if(!ace.vars['touch']) {
			$(this).find('.chosen-container').each(
				function(){
					$(this).find('a:first-child').css('width' , '210px');
					$(this).find('.chosen-drop').css('width' , '210px');
					$(this).find('.chosen-search input').css('width' , '200px');
				});
		}
	})

	/**
	//or you can activate the chosen plugin after modal is shown
	//this way select element becomes visible with dimensions and chosen works as expected
	$('#modal-form').on('shown', function () {
	$(this).find('.modal-chosen').chosen();
	})
	*/

	$(document).one('ajaxloadstart.page', function(e) {
		autosize.destroy('textarea[class*=autosize]')
		$('.limiterBox,.autosizejs').remove();
		$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
	});
});
</script>
<!-- // basic script ------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
<!--
	function warehousing_view(uid)
	{
	$("#id-btn-dialog1").modal({
		show: true,
		title : "구매입고내역",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	
	var url = "index.php?controller=purchase&action=viewPageWarehousingItem&pop=Y&uid="+uid+"&dialogID=id-btn-dialog1";
	$("#warehousing_view_frame").attr("src", url);
	}
			
	function product_p_reports_view(uid)
	{
	$("#id-btn-dialog2").modal({
		show: true,
		title : "실적처리관리",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	
	var url = "index.php?controller=production&action=viewPageproductPerfReports&pop=Y&uid="+uid+"&dialogID=id-btn-dialog2";
	$("#product_perf_report_view_frame").attr("src", url);
	}

	function orderShipment_view(sid, dt, ca, st)
	{
	$("#id-btn-dialog3").modal({
		show: true,
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	var url = "index.php?controller=sales&action=viewPageOrderShipment&uid="+sid+"&pop=Y&shipment_dt="+dt+"&shipment_ca="+ca+"&state="+st+"&dialogID=id-btn-dialog3";
	$("#orderShipment_view_frame").attr("src", url);
	}
	
	function product_p_reports_print(uid)
	{
	$("#id-btn-dialog3").modal({
		show: true,
		title : "생산실적처리내역",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	
	var url = "index.php?controller=production&action=productPerfReportsPrint&pop=Y&uid="+uid+"&dialogID=id-btn-dialog4";
	$("#product_perf_report_print_frame").attr("src", url);
	}

	function close_popup()
	{	
		$.modal.close();
		$("#product_perf_report_reg_frame").attr("src", "about:blank");
	}
	function closePopup()
	{
		window.parent.closeModal('<?=$dialogID?>');
		window.parent.location.reload();
	}
	window.closeModal = function(obj) {
		$("#"+obj).modal( 'hide' );
	}

//-->
</script>