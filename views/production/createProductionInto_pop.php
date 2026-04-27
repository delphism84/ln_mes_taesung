<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);

?>
<?
$sql = "select * from erp_warehouse where warehouse_gb='공장'";
$result = mysql_query($sql);
while($t1 = mysql_fetch_object($result)) {
	$warehouse_f .= "<option value='".$t1->warehouse_cd."'>".$t1->warehouse_nm."</option>";
}

$sql3 = "select * from erp_warehouse where warehouse_gb='창고'";
$result3 = mysql_query($sql3);
while($t3 = mysql_fetch_object($result3)) {
	$warehouse_t .= "<option value='".$t3->warehouse_cd."'>".$t3->warehouse_nm."</option>";
}

$sql = "select * from erp_process";
$result = mysql_query($sql);
while($t2 = mysql_fetch_object($result)) {
	$process .= "<option value='".$t2->process_cd."'>".$t2->process_nm."</option>";
}
?>

<div class="main-content">
	<div class="main-content-inner">

		<div class="page-content">


			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="production" />
						<input type="hidden" name="action" id="action" value="inputPageProductionInto" />
						<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />
						<input type="hidden" name="cntTotal" id="cntTotal" value="" />
						<input type="hidden" name="addCntTotal" id="addCntTotal" value="" />
						<!-- 테이블 -->
						<table id="simple-table" class="table table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 입고일자</th>
								<td class="col-xs-5" >
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="p_into_dt" id="p_into_dt" type="text" value="<?=date('Y/m/d')?>" data-date-format="yyyy/mm/dd" readonly/>
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>&nbsp;
											</div>
										</span>
									</div>
								</td>
								
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 작업지시서</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="work_uid" id="work_uid" />
												<input type="text" name="work_cd" id="work_cd" onclick="centerOpenWindow('views/popup/workProductionIntoListPut.php', '작업지시서 리스트', 800, 500)" readonly/>
												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/workProductionIntoListPut.php', '작업지시서 리스트', 800, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<!--
								<input type="hidden" name="item_uid" id="item_uid" value=""/>
								<input type="hidden" name="work_uid" id="work_uid" value=""/>
								<input type="hidden" name="click_item_cd" id="click_item_cd" value=""/>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 생산번호<br></th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="work_cd" id="work_cd" onclick="centerOpenWindow('views/popup/workOrderListPut2.php', '작업지시서 리스트', 1000, 500)" readonly/>
												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/workOrderListPut.php', '작업지시서 리스트', 1000, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								-->
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 생산공장</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="wh_cd_f_cd" id="wh_cd_f_cd" />
												<input type="text" name="wh_cd_f_nm" id="wh_cd_f_nm" onclick="centerOpenWindow('views/popup/warehouseFromList.php', '생산공장', 400, 600)" readonly/>
												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/warehouseFromList.php', '창고리스트', 400, 600)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 입고창고</th>
								<td class="col-xs-5">
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input type="hidden" name="warehouse_cd" id="warehouse_cd" />
											<input type="text" name="warehouse_nm" id="warehouse_nm" onclick="centerOpenWindow('views/popup/warehouseList.php', '입고창고', 500, 600)" readonly/>
											<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/warehouseList.php', '입고창고', 500, 600)">
												<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
											</span>
										</div>
									</span>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">프로젝트</th>
									<td class="col-xs-5">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="project_cd" id="project_cd" readonly />
													<input type="text" name="project_nm" id="project_nm" onclick="centerOpenWindow('views/popup/projectList.php', '프로젝트리스트', 600, 500)" readonly />
													<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/projectList.php', '프로젝트리스트', 600, 500)">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 담당자</th>
								<td class="col-xs-5">
									<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="emp_id" id="emp_id" readonly />
													<input type="text" name="manager" id="emp_nm" onclick="centerOpenWindow('views/popup/employeeList.php', '담당자', 500, 500)" readonly />
													<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/employeeList.php', '담당자', 500, 500)">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">비고</th>
								<td class="col-xs-11" colspan="3">
									<textarea id="remark" name="remark" class="form-control"></textarea>
								</td>
							</tr>
						</table>
						<div>
							<h4><i class="ace-icon fa fa-caret-right blue"></i> 작업지시서</h4>
						</div>
						<table id="work_list" class="table  table-bordered table-hover" style="margin-top:10px">
							<thead>
								<tr>
									<th class="center col-xs-2" style="background-color:#f1f1f1">작업지시서</th>	
									<th class="center col-xs-1" style="background-color:#f1f1f1">No</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">납품처</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">품목코드</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">품목명</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">생산수량</th>
									<!--
									<th class="center col-xs-1" style="background-color:#f1f1f1" nowrap>작업지시적용수량</th>
									-->
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan='6' class='center'>등록된 작업지시서가 없습니다.</td>
								</tr>
							</tbody>
						</table>
						<!--
						<a class="btn btn-xs btn-success" onclick="centerOpenWindow('views/popup/workOrderItemPut.php', '품목 리스트', 900, 600)">품목선택</a>
						-->
						<div>
							<h4><i class="ace-icon fa fa-caret-right blue"></i> 생산입고 품목 </h4>
							<span style="color:red">생산품목 LOT_NO는 11자리 이내 & - 대신에 _ 를 사용해 주세요.</span>
						</div>
						<table id="work_item_list" class="table table-bordered table-hover" style="margin-top:10px">
							<thead>
								<tr>
									 
									<th class="detail-col center" style="background-color:#f1f1f1"></th>
									<!--<th class="center col-xs-1" style="background-color:#f1f1f1">공정</th> -->
									<th class="center col-xs-1" style="background-color:#f1f1f1">품목코드</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">생산품목명</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">규격</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">재질</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">단위</th>
									<!--
									<th class="center col-xs-1" style="background-color:#f1f1f1">생산공장</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">입고창고</th>
									-->
									<th class="center col-xs-1" style="background-color:#f1f1f1">입고수량</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1;">지시수량</th>
									<!--<th class="center col-xs-1" style="background-color:#f1f1f1;">적요</th>-->
									<th class="center col-xs-2" style="background-color:#f1f1f1">LOT_NO</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">LOT사용여부</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan='12' class='center'>등록된 품목이 없습니다.</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<th class="center" style="background-color:#f1f1f1"></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN class="cntTotal"></SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN ></SPAN></th>
									<!--<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>-->
									
									
								</tr>
							<tfoot>			
						</table>
					</form>
				</div>
			</div><!-- /.row -->

			
			
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						등록
					</button>
					<button class="btn" type="reset" onclick="closePopup()">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						닫기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<input type="hidden" name="flag" id="flag" value="1" />
<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="itemFlag" id="itemFlag" value="" />
<input type="hidden" name="warehouse_f_Flag" id="warehouse_f_Flag" value="" />
<input type="hidden" name="warehouse_t_Flag" id="warehouse_t_Flag" value="" />
<input type="hidden" name="warehouse_gb" id="warehouse_gb" value="" />

<input type="hidden" name="lotFlag" id="lotFlag" value="" />


<div id="dialog-message1" class="dialog-view hide">
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="col-xs-12">
						<div class="col-xs-8" style="float:right">
							<div class="col-xs-12"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="Search..." name="search_txt" id="search_txt" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="search()">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											Search
										</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
					<div style="margin-top:10px">
						<table id="warehouse_f_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">창고구분</th>
									<th class="col-xs-5 center" style="background-color:#f1f1f1">창고코드</th>
									<th class="col-xs-5 center" style="background-color:#f1f1f1">창고명</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
			</div>
		</div>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<div id="dialog-message2" class="dialog-view hide">
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="col-xs-12">
						<div class="col-xs-8" style="float:right">
							<div class="col-xs-12"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="Search..." name="search_txt" id="search_txt" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="search()">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											Search
										</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
					<div style="margin-top:10px">
						<table id="warehouse_t_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">창고구분</th>
									<th class="col-xs-5 center" style="background-color:#f1f1f1">창고코드</th>
									<th class="col-xs-5 center" style="background-color:#f1f1f1">창고명</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
			</div>
		</div>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	var page = $("#page").val();
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	
		getWarehouse();
		getWarehouseFrom(page);
		getWarehouseTo(page);

});

function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	$("#flag").val(nextFlag);
}

function centerOpenWindow(theURL, winName, width, height, fstate, scrollbars){ 
	var features = "width=" + width ; 
	features += ",height=" + height ; 
	var state = ""; 
	var scrollbars = "yes";
	var res_w = ( $(window).width() - width ) / 2; 
	var res_h = ( $(window).height() - height ) / 2; 
	if ( window.screenLeft >= window.screen.width ) { 
		res_w = window.screen.width + res_w; 
	} 
	if (fstate == "") { // 옵션 
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes"; 
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 

function createWorkCode(){
	var data_string = "mode=createWorkCode";
	$.ajax({
		type : "post",
		url : "ajax/production.php",
		data : data_string,
		success : function(str) {
			$("#work_cd").val(str);
		}
	});
}

function getMachine(flag,process_cd) {
	var tag = "<option value='0'>기계선택</option>";
	$.getJSON("ajax/process.php",{"mode":"getProcessMachine","process_cd":process_cd},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].machine_nm + "</option>";
				}
			}

			$("#machine_" + flag).html(tag);
		}
	);
}
// 창고 리스트 가져오기
function getWarehouse(){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var warehouse_gb = $("#warehouse_gb").val();

	$.getJSON("ajax/warehouse.php",{"page":page, "mode":"getWarehouse", "rpp" : rpp, "adjacents" : adjacents, "where":search, "warehouse_gb":warehouse_gb},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].warehouse_cd + "'>" + json[i].warehouse_nm + "</option>";
				}
			}

			$("#warehouse_cd").append(tag);
		}
	);
}



function getWorkOrder(){
	
	var tag2 = "";
	var uid = $("#work_uid").val();
	$.getJSON("ajax/production.php",{"mode":"getWorkOrder", "uid" : uid}, function(json){
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag2 += "<tr style='text-align:center'>";
				tag2 += "<td>"+ json[i].work_dt +"</td>";
				tag2 += "<td>"+ json[i].work_cha +"</td>";
				tag2 += "<td>"+ json[i].account_nm +"</td>";
				tag2 += "<td>"+ json[i].item_cd +"</td>";
				tag2 += "<td >"+ json[i].item_nm +"</td>";
				tag2 += "<td >"+ json[i].order_cnt +"</td>";
				//tag += "<td ><input type='text' class='form-control input-sm work_cnt text-right' name='work_cnt[]' id='work_cnt_1' value="+json[i].order_cnt+" readonly/></td>";
				tag2 += "</tr>";
			}
		}else{
			tag2 = "<tr><td colspan='6' align='center'>등록된 품목이 없습니다.</td><tr>";
		}

		$("#work_list tbody").html(tag2);
		getWorkOrderItem();//작업지지서 세부내용
	});

	
}

//생산입고등록 >  작업지시 품목.
function getWorkOrderItem(){
	var tag = "";
	var uid = $("#work_uid").val();
	//var warehouse_f = "<?=$warehouse_f?>";
	//var warehouse_t = "<?=$warehouse_t?>";
	//var process = "<?=$process?>";
	var currentFlag = $("#flag").val();

	$.getJSON("ajax/production.php",{"mode":"getWorkOrderItem", "uid" : uid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr class='item" + currentFlag + "'>";
					tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this);calculationTotal(" + currentFlag + ");'></i></td>";
					//tag += "<input type='hidden' name='warehouse_f_cd[]' id='warehouse_f_cd_" + currentFlag + "'readonly /><input type='hidden' name='warehouse_t_cd[]' id='warehouse_t_cd_" + currentFlag + "'readonly />";
				//	tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this);calculationTotal(" + currentFlag + ");'></i></td>";
					//tag += "<td class='center'>";
					//tag += "<select name='process[]' id='process_" + currentFlag +"' class='process' onchange='getMachine(" + currentFlag + ",this.value)'>" + process + "</select>";
					//tag += "</td>";
					tag += "<td><input type='text' class='form-control id-btn-dialog item_cd ' name='item_cd[]' id='item_cd_" + currentFlag + "' onclick='viewModal();itemFlag(" + currentFlag + ")' value='" + json[i].item_cd + "' placeholder='품목선택을 하시려면 클릭하세요' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + currentFlag + "' value='" + json[i].item_nm + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='standard1[]' id='standard1_" + currentFlag + "' value='" + json[i].standard1 + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control material' name='material[]' id='material_" + currentFlag + "' value='" + json[i].material + "'  readonly/></td>";
					tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + currentFlag + "' value='" + json[i].unit + "'  readonly/></td>";
					//tag += "<td><input type='text' class='form-control id-btn-dialog1 warehouse_f_nm' name='warehouse_f_nm[]' id='warehouse_f_nm_" + currentFlag + "' onclick='warehouse_f_Flag(" + currentFlag + ")' readonly /></td>";
					//tag += "<td><input type='text' class='form-control id-btn-dialog2 warehouse_t_nm' name='warehouse_t_nm[]' id='warehouse_t_nm_" + currentFlag + "' onclick='warehouse_t_Flag(" + currentFlag + ")' readonly /></td>";
					//tag += "<td><input type='text' class='form-control addcnt text-right' name='addcnt[]' id='addcnt_" + currentFlag + "' onkeyup='input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + currentFlag + ");'/></td>";
					
					tag += "<td><input type='text' class='form-control cnt text-right' name='cnt[]' id='cnt_" + currentFlag + "' onkeyup='input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + currentFlag + ");' value='" + json[i].cnt + "' /></td>";
					tag += "<td><input type='text' class='form-control order_cnt text-right' name='order_cnt[]' id='order_cnt_" + currentFlag + "' onkeyup='input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + currentFlag + ");' value='" + json[i].order_cnt + "' readonly/></td>";
					//tag += "<td><input type='text' class='form-control memo' name='memo[]' id='memo_" + currentFlag + "' onclick='this.select();'  /></td>";
					tag += "<td><input type='text' class='form-control' name='lot_no[]' id='lot_no_" + currentFlag + "'  onkeyup='checkLot(this.value);'   onclick='lotFlag("+currentFlag+")'/></td>";
					tag += "<td><span class=form-control' class='lotCheck'  id='lotCheck_" + currentFlag + "' ></span><input type='hidden' class='lotCheck2' id='lotCheck2_" + currentFlag + "'  value='' /></td>";

					tag += "</tr>";
					
					currentFlag = Number(currentFlag) + 1;
					$("#flag").val(currentFlag);
				}
				//var nextFlag = Number(currentFlag) + 1;
				//$("#flag").val(nextFlag);
			//} else {
			//	$("#flag").val("4");
			}else{
				tag += "<tr><td colspan='15' align='center'>등록된 품목이 없습니다.</td><tr>";
			}
			$("#work_item_list tbody").html(tag);
			calculationTotal();
		}
	);
}

function lotFlag( flag ){	//입력한 품목의 로트 flag 저장.
	
	$("#lotFlag").val( flag );
}

function checkLot( LOT_NO ){

	 var lotFlag = $("#lotFlag").val(  );

	if( LOT_NO ==""){
		$("#lotCheck_"+lotFlag).html("<span></span>");
		$("#lotCheck2_"+lotFlag).val("");
		return false;
	}

	
		//이미 사용된 로트인지 확인
		var dataString = "mode=LotCheck&lot_no=" + LOT_NO;
		$.ajax({
			type : "post",
			url : "ajax/lot_no.php",
			data : dataString,
			async : false,
			success : function(str){
					if(str.trim() == "success"){
						$("#lotCheck_"+lotFlag).html("<span style='color:green;'><B>중복없음</B></span>");
						$("#lotCheck2_"+lotFlag).val("중복없음");
						return false;
					}else{
						$("#lotCheck_"+lotFlag).html("<span style='color:red;'><B>중복</B></span>");
						$("#lotCheck2_"+lotFlag).val("중복");
						return false;
					}
			}
		});

}

function  calculationTotal(flag) {
	var cntTotal = 0;
	$("input[name='cnt[]']").each(function () {
		var cnt = removeComma(this.value);
		if ($("input[name='cnt[]']").length > 0 && !isNaN(cnt)){
			 cntTotal += Number(removeComma(this.value));
		}
	});
	var addCntTotal = 0;
	$("input[name='addcnt[]']").each(function () {
		var addcnt = removeComma(this.value);
		if ($("input[name='addcnt[]']").length > 0 && !isNaN(addcnt)){
			 addCntTotal += Number(removeComma(this.value));
		}
	});

		$(".cntTotal").html(Num2Money(cntTotal));
		$(".addCntTotal").html(Num2Money(addCntTotal));
}


function moveItem(item_cd, item_nm, cnt, standard1, material, unit, current_cnt){
	var tag = "";
	var flag = $("#flag").val();
	var warehouse = "<?=$warehouse?>";
	var process = "<?=$process?>";

	var arr = [];
	var std1 = [];
	var item = [];

	$.each($(document).find(".item_cd") , function () {
		arr.push($(this).val());
	});
	$.each($(document).find(".standard1") , function () {
		std1.push($(this).val());
	});
	
	for(var i = 0 ; i <= arr.length ; i++) {
		item.push(arr[i] + std1[i] );
	}

	var check = item_cd + standard1;

	var idx = jQuery.inArray(check, item);
	if(idx >= 0) {
		alert("동일 품목을 이미 선택하셨습니다");
	} else {
		tag += "<tr class='item" + flag + "'>";
		tag += "<td><input type='text' class='form-control item_cd' name='item_cd[]' id='item_cd_" + flag + "' value='" + item_cd + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "' value='" + item_nm + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control standard1' name='standard1[]' id='standard1_" + flag + "' value='" + standard1 + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control material' name='material[]' id='material_" + flag + "' value='" + material + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + unit + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control' name='goal_cnt[]' id='goal_cnt_" + flag + "' value='" + cnt + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control' name='current_cnt[]' id='current_cnt_" + flag + "' value='" + current_cnt + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control' name='order_cnt[]' id='order_cnt_" + flag + "' value='" + cnt + "' /></td>";
		tag += "<td><input type='text' class='form-control' name='seq[]' id='seq_" + flag + "' value='" + flag + "' /></td>";
		tag += "<td class='center'><select name='warehouse_cd[]' id='warehouse_cd_" + flag + "' class='warehouse'>" + warehouse + "</select></td>";
		tag += "</tr>";
		
		$("#work_list tbody").append(tag);

		$("#flag").val(Number(flag) + 1);
	}
}

function getWorkplanBom(workplan_cd){
	$.getJSON("ajax/production.php",{"mode":"getWorkplanBom","workplan_cd":workplan_cd},
		function(json){
			
			if(json != null) {
				//if(json.length > 3) {
				//	for( var k = 0 ; k < json.length - 3 ; k++) {
				//		addTr();
				//	}
				//}
				for(var i = 0 ; i < json.length ; i++){
					checkCalBom(json[i].item_cd, json[i].item_nm, json[i].standard1, json[i].material, json[i].unit, json[i].cnt, json[i].current_cnt);
				}
			}
		}
	);	
	//getWorkplanItem(workplan_cd);
	getWorkplanItem();
}

function checkCalBom(item_cd, item_nm, standard1, material, unit, cnt, current_cnt){
	var tag = "";
	var dataString = "mode=checkCalBom&item_cd=" + item_cd + "&standard1=" + standard1  + "&cnt=" + cnt;
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/production.php",
		success : function(str) {
			if(str == "shortage") {
				tag += "<tr>";
				tag += "<td>" + item_cd + "<span style='color:red'> [원자재 및 재고부족]</span></td>";
				tag += "<td>" + item_nm + "</td>";
				tag += "<td>" + standard1 + "</td>";
				tag += "<td>" + material + "</td>";
				tag += "<td>" + unit + "</td>";
				tag += "<td>" + cnt + "</td>";
				tag += "<td>" + current_cnt + "</td>";
				tag += "</tr>";	
			} else {
				tag += "<tr>";
				tag += "<td><span onclick=\"moveItem('" + item_cd + "','" + item_nm + "','" + cnt + "','" + standard1 + "','" + material + "','" + unit + "'," + current_cnt + ")\" style='color:blue; cursor:pointer'>" + item_cd + "</span></td>";
				tag += "<td>" + item_nm + "</td>";
				tag += "<td>" + standard1 + "</td>";
				tag += "<td>" + material + "</td>";
				tag += "<td>" + unit + "</td>";
				tag += "<td>" + cnt + "</td>";
				tag += "<td>" + current_cnt + "</td>";
				tag += "</tr>";					
			}
			$("#bom_list tbody").append(tag);
		}
	});
}

function getWorkplanItem(){
	var workplan_cd = $("#workplan_cd").val();
	var workplan_uid = $("#workplan_uid").val();
	var warehouse = "<?=$warehouse?>";
	//$("#order_no").val(order_cd);
	var flag = $("#flag").val();
	var tag = "";

	$.getJSON("ajax/production.php",{"mode":"getWorkPlanItem", "uid" : workplan_uid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag = "";
					tag += "<tr class='item" + flag + "'>";
					tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
					tag += "<td><input type='text' class='form-control id-btn-dialog item_cd ' name='item_cd[]' id='item_cd_" + flag + "' value='" + json[i].item_cd + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "' value='" + json[i].item_nm + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control standard1' name='standard1[]' id='standard1_" + flag + "' value='" + json[i].standard1 + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control material' name='material[]' id='material_" + flag + "' value='" + json[i].material + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + json[i].unit + "' /></td>";
					tag += "<td><input type='text' class='form-control order_cnt' name='order_cnt[]' id='order_cnt_" + flag + "' value='" + json[i].cnt + "' /></td>";
					tag += "<td class='center'><select name='warehouse_cd[]' id='warehouse_cd_" + flag + "' class='warehouse'>" + warehouse + "</select></td>";
					tag += "</tr>";
					$("#product").append(tag);

					flag = Number(flag) + 1;
					$("#flag").val(flag);
				}
			}
		}
	);
}

/*
function getWorkplanItem(workplan_cd){
	var tag = "";
	$.getJSON("ajax/production.php",{"mode":"getWorkPlanItem","workplan_cd":workplan_cd},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td class='col-xs-1' style='background-color:#f1f1f1'>생산할 품목</td>";
					tag += "<td>" + json[i].item_nm + " [" + json[i].standard1 + " / " + json[i].unit + "]</td>";
					tag += "<td class='col-xs-1' style='background-color:#f1f1f1'>생산할 수량</td>";
					tag += "<td>" + json[i].cnt + "</td>";
					tag += "</tr>";
				}
			}

			$("#workplan_item tbody").html(tag);
		}
	);	
}
*/

// 창고 리스트 가져오기
function getWarehouseFrom(page){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = page;
	var search = $("#where").val();
	var warehouse_gb = "공장";
	var txt = $("#search_txt").val();
 
	$.getJSON("ajax/warehouse.php",{"page":page, "mode":"getWarehouseList", "rpp" : rpp, "adjacents" : adjacents, "where":search, "warehouse_gb":warehouse_gb, "txt" : txt},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postWarehouseF('" + json[i].warehouse_cd + "','" + json[i].warehouse_nm + "')\">" + json[i].warehouse_gb + "</td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postWarehouseF('" + json[i].warehouse_cd + "','" + json[i].warehouse_nm + "')\">" + json[i].warehouse_cd + "</a></td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postWarehouseF('" + json[i].warehouse_cd + "','" + json[i].warehouse_nm + "')\">" + json[i].warehouse_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#warehouse_f_list tbody").html(tag);

			var table = "erp_warehouse";
			var where = "";
			//if(account_gb == "" || account_gb == "all") {
			//	var where = $("#where").val();
			//} else {
			//	var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			//}

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function getWarehouseTo(page){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = page;
	var search = $("#where").val();
	var warehouse_gb = "창고";
	var txt = $("#search_txt").val();
 
	$.getJSON("ajax/warehouse.php",{"page":page, "mode":"getWarehouseList", "rpp" : rpp, "adjacents" : adjacents, "where":search, "warehouse_gb":warehouse_gb, "txt" : txt},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);' onclick=\"postWarehouseT('" + json[i].warehouse_cd + "','" + json[i].warehouse_nm + "')\">" + json[i].warehouse_gb + "</td>";
					tag += "<td><a href='javascript:void(0);' onclick=\"postWarehouseT('" + json[i].warehouse_cd + "','" + json[i].warehouse_nm + "')\">" + json[i].warehouse_cd + "</a></td>";
					tag += "<td><a href='javascript:void(0);' onclick=\"postWarehouseT('" + json[i].warehouse_cd + "','" + json[i].warehouse_nm + "')\">" + json[i].warehouse_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#warehouse_t_list tbody").html(tag);

			var table = "erp_warehouse";
			var where = "";
			//if(account_gb == "" || account_gb == "all") {
			//	var where = $("#where").val();
			//} else {
			//	var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			//}

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function postWarehouseF(code,name){
	var flag = $("#warehouse_f_Flag").val();
	$("#dialog-message1").dialog("close");
	$("#warehouse_f_cd_" + flag).val(code);
	$("#warehouse_f_nm_" + flag).val(name);
}

function postWarehouseT(code,name){
	var flag = $("#warehouse_t_Flag").val();
	$("#dialog-message2").dialog("close");
	$("#warehouse_t_cd_" + flag).val(code);
	$("#warehouse_t_nm_" + flag).val(name);
}

function formSubmit(){
	
	//if(!check_str($("#p_order_cd").val(),"발주서코드")) return false;
	//if(!check_str($("#account_nm").val(),"거래처")) return false;
	//if(!check_str($("#deadline_dt").val(),"납기일자")) return false;
	//if(!check_str($("#project_cd").val(),"프로젝트")) return false;

	if($("#work_cd").val() == "") {
		alert("작업지시서를 선텍 하세요");
		$("#work_cd").focus();
		return false;
	}

	if($("#emp_nm").val() == "") {
		alert("담당자를 선텍 하세요");
		$("#emp_nm").focus();
		return false;
	}

	if($("#wh_cd_f_nm").val() == "") {
		alert("생산공장을 입력 하세요");
		$("#wh_cd_f_nm").focus();
		return false;
	}
 
	
	if($("#warehouse_nm").val() == "") {
		alert("입고창고를 입력 하세요");
		$("#warehouse_nm").focus();
		return false;
	}

	var bool = true;
	$('.lotCheck2').each(function(i){
		if( $(this).val() =="" ){
			alert("LOT를 입력하세요");
			bool = false;
		}

		//if( $(this).val() =="중복" ){
		//	alert("LOT가 중복됩니다.");
		//	bool = false;
		//}
	});


//	if(!frm_submit($('input[name="warehouse_f_nm[]"]'),"생산창고")) return false;
//	if(!frm_submit($('input[name="warehouse_t_nm[]"]'),"입고창고")) return false;
	if(!frm_submit($('input[name="cnt[]"]'),"수량")) return false;
	if(!frm_submit($('input[name="order_cnt[]"]'),"지시수량")) return false;

	$("#cntTotal").val($(".cntTotal").html());
	$("#addCntTotal").val($(".addCntTotal").html());
	
	if( bool== true){
		$("#frm").submit();
	}

}

function frm_submit(f,t) {
	  var ret = true;
	  $(f).each(function(idx, item) {
		if(!$(item).val() || $(item).val()=="0") {
		  ret = false;
		  alert(t+"을 입력 하세요");
		  $(item).focus();
		  return false;
		}
	  });
	  return ret;
	}
//-----------------------------------------------------------------------
// 기  능 : 숫자를 금액 형식으로
//-----------------------------------------------------------------------
function Num2Money(number){

	number		=	Money2Num(number);

	if(isNaN(number))			return number;
	if(parseFloat(number)==0)	return 0;
	if(!number)					return "";
	var strint="";
	var strfloat="";
	var tmp;
	var ans="";
	var isfloat=false;
	var minus=false;
	var result='';

	if(number.indexOf("-")>-1){
		minus=true;
		number=number.replace('-','');
	}

	if(number.indexOf(".")==-1) strint=number;
	else {
		isfloat=true;
		strint=number.substring(0,number.indexOf("."));
		if(parseInt(strint,10)==0)	strint = '0';
		strfloat=number.substring(number.indexOf("."),number.length);
	}

	if(!isNaN(strint) && strint!=""){
		strint	=	String(parseInt(strint,10));
	}

	var num=strint.split("");

	tmp=num.reverse();

	for(a=0;a<tmp.length;a++) {
		if(!(a%3) && a!=0) { ans+=",";  }
		ans+=tmp[a];
	}

	tmp=ans.split("").reverse();
	ans="";

	for(a=0;a<tmp.length;a++){ ans+=tmp[a];}

	for(a=0;a<2;a++)
		if(ans.charAt(0)=="0" || ans.charAt(0)==",") ans=ans.substring(1,ans.length);

	result=ans+strfloat;

	if(isfloat==true){
		var lastchar=result.substr(result.length-1,1);
		while (lastchar == '0' || lastchar == '.'){
			result = result.substr(0,result.length-1);
			if (lastchar == '.'){break;}
			lastchar=result.substr(result.length-1,1);
		}
	}

	var tmpresult = parseFloat(Money2Num(result));

	if(tmpresult>0 && tmpresult<1){
		result = '0'+result;
	}

	return	(minus==true) ? '-'+result : result
}
//-----------------------------------------------------------------------
// 기  능 : 금액을 숫자 형식으로
//-----------------------------------------------------------------------
function Money2Num(money) {
	if(money == undefined)	return false;
	var moneyString		=	new String;
	moneyString			=	money.toString();
	while (moneyString.indexOf(',') > -1){
		moneyString	=	moneyString.replace(',','');
	}
	if(isNaN(moneyString)){
		return false;
	}else{
		return moneyString;
	}
}
function commaSplit(n) {// 콤마 나누는 부분
	var txtNumber = '' + n;
	var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
	var arrNumber = txtNumber.split('.');
	arrNumber[0] += '.';
	do {
		arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
	}
	while (rxSplit.test(arrNumber[0]));
	if(arrNumber.length > 1) {
		return arrNumber.join('');
	} else {
		return arrNumber[0].split('.')[0];
	}
}

function removeComma(n) {  // 콤마제거
	if ( typeof n == "undefined" || n == null || n == "" ) {
		return "";
	}
	var txtNumber = '' + n;
	return txtNumber.replace(/(,)/g, "");
}
function input_comma(sfield) 
	{
		if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) 
			|| (event.keyCode == 188) || (event.keyCode == 190) || (event.keyCode == 110) || (event.keyCode == 8) || (event.keyCode == 46))
		{			
			sfield.value = remove_comma(sfield);
			money = sfield.value;
			var tmpH="";
			if(money.charAt(0)=="-")
			{
				tmpH=money.substring(0,1);
				money=money.substring(1,money.length);
			}
		
			for (; money.indexOf("-") != -1 ;) 
			{ 
				money = money.replace("-","")
			}
		
			belowzero = "";
			if (check_dot(money)==true)
			{
				arr = money.split(".");
				money = arr[0];		
				belowzero = "." + arr[1];    
			}
			
			len = money.length ;
			result ="";
			for (i=0; i < len;i++)
			{
				comma="";
				schar = money.charAt(i);
				where = len - 1 - i;
				if ( ( where % 3 == 0) && (len > 3) && ( where != 0 )) 
				{
					comma = ",";	
				}
				result = result +   schar + comma ;
			}
			if(tmpH)
			{
 				result = tmpH + result;
	 		}

			sfield.value = result + belowzero;			
			
	   	}	
		return true;
	}

	function remove_comma(sfield)
	{
		money = sfield.value;
		var arr;
		arr = money.split(",");
		len = arr.length;	
		result = "";
		for (k=0; k < len; k++) 
		{
			result = result + arr[k];
		}
		return result;
	}	

	function check_dot(v_value)
	{
		v_len= v_value.length;
		for (var i=0; i< v_len; i++) 
		{
			schar = v_value.charAt(i);
			if (schar == "." )
			{
				return true;
			}
		}
		return false;
	}
		
	function onlyNumber() //onKeyPress 이벤트 기준
	{ 
  		if ( ((event.keyCode < 48) || (57 < event.keyCode) && (188 != event.keyCode)) && (45 != event.keyCode) 
  			&& (190 != event.keyCode) && (110 != event.keyCode) && (109 != event.keyCode) && (46 != event.keyCode)) 
  		{
  			event.returnValue=false;
  		}
	}

function warehouse_f_Flag(flag) {
	$("#warehouse_f_Flag").val(flag);
}

function warehouse_t_Flag(flag) {
	$("#warehouse_t_Flag").val(flag);
}

function close_popup()
{	
	$.modal.close();
	$("#standard_code_reg_frame").attr("src", "about:blank");
}
function closePopup()
{
	window.parent.closeModal('<?=$dialogID?>');
	//window.parent.location.reload();
}
window.closeModal = function(obj) {
	alert(obj)
	$("#"+obj).modal( 'hide' );
}
</script>

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
	
	// 생산공장
	$( document).on('click',".id-btn-dialog1", function(e) {
		e.preventDefault();
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>생산공장</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	//입고창고
	$( document).on('click',".id-btn-dialog2", function(e) {
		e.preventDefault();
		var dialog = $( "#dialog-message2" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>입고창고</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});
	
	//datepicker plugin
	//link
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true,
			language: "kr"
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