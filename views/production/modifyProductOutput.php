<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);
?>
<script type="text/javascript">
<!--
	function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

//-->
</script>
<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="production" />
						<input type="hidden" name="action" id="action" value="updateProductOutput" />
						<input type="hidden" name="dialogid" id="dialogid" value="<?=$dialogid?>" />
						<input type="hidden" name="uid" id="uid" value="<?=$uid?>" />
						
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">생산일자</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="production_dt" id="production_dt" type="text" value="<?=$t->production_dt?>" data-date-format="yyyy-mm-dd" readonly/>
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>&nbsp;
												<select name="day_gubun" id="day_gubun">
												<option value="주간" <? if($t->day_gubun == "주간") echo "selected"; ?>>주간</option>
												<option value="야간" <? if($t->day_gubun == "야간") echo "selected"; ?>>야간</option>
												</select>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">생산품목</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="material" id="material" value="<?=$t->material?>" />
												<input type="text" name="item_nm" id="item_nm" value="<?=$t->item_nm?>" onclick="centerOpenWindow('views/popup/ProductPerfReportsLotNo.php', '품목 리스트', 800, 500)" readonly/>
												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/ProductPerfReportsLotNo.php', '품목 리스트', 800, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
									<input type="text" name="item_cd" id="item_cd" class="item_cd" value="<?=$t->item_cd?>" readonly/>
									<input type="text" name="standard1" id="standard1" class="standard1" value="<?=$t->standard1?>" readonly/>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업공정<br>생산기기</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="process_cd" id="process_cd" value="<?=$t->process_cd?>"/>
												<input type="text" name="process_nm" id="process_nm" value="<?=$t->process_nm?>" placeholder="작업 공정명" onclick="centerOpenWindow('views/popup/processListPut.php', '공정리스트', 400, 600)" readonly/>
												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/processListPut.php', '공정리스트', 400, 600)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												
											</div>
										</span>

										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="machine_uid" id="machine_uid" value="<?=$t->machine_uid?>"/>
												<input type="text" name="machine_nm" id="machine_nm" placeholder="생산 기기명" value="<?=$t->machine_nm?>" onclick="centerOpenWindow('views/popup/machineListPut.php', '생산기기리스트', 600, 600)" readonly/>
												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/machineListPut.php', '생산기기리스트', 600, 600)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">LOT_NO<br>(공정이동)</th>
								<td class="col-xs-5">
									<input type="text" name="LOT_NO" id="LOT_NO" class="text-left" value="<?=$t->LOT_NO?>" /> ex)<?="TS-LOT".date("Ymdhi",time())?>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">가동시간</th>
								<td class="col-xs-5">
									<div class="input-group">
										<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" id="timePicker4" style="width:110px;float:left">
											<input type="text" name="p_plan_tm1" class="form-control" value="<?=substr($t->p_plan_tm,0,5)?>">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time"></span>
											</span>
										</div>
										<div style="width:20px;float:left;center;padding-left:8px"><strong>-</strong> 
										</div>
										<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" id="timePicker5" style="width:110px;float:left">
											<input type="text" name="p_plan_tm2" class="form-control" value="<?=substr($t->p_plan_tm,-5,5)?>">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time"></span>
											</span>
										</div>
									<!-- <div class="input-group">
										<div class="input-group bootstrap-timepicker">
											<input name="p_plan_tm1" id="timepicker1" type="text" style="width:70px" data-date-format="HH:mm:ss'" value="<?=substr($t->p_plan_tm,0,8)?>"/>
											<span class="input-group-addon">
												<i class="fa fa-clock-o bigger-110"></i>
											</span>
											~
											<input name="p_plan_tm2" id="timepicker2" type="text" style="width:70px" data-date-format="HH:mm:ss'" value="<?=substr($t->p_plan_tm,-8,0)?>"/>
											<span class="input-group-addon">
												<i class="fa fa-clock-o bigger-110"></i>
											</span>
										</div>
									</div> -->
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">생산번호<br>(작업지지서)</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="work_bom" id="work_bom" value="<?=$t->work_bom?>"/>
												<input type="text" name="work_cd" id="work_cd" onclick="centerOpenWindow('views/popup/workListPut.php', '작업지시서 리스트', 800, 500)" value="<?=$t->work_cd?>" readonly/>
												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/workListPut.php', '작업지시서 리스트', 800, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">로트NO</th>
								<td class="col-xs-11" colspan="3" id="">
									<table id="ProductPerfReportsLotNo" class="table  table-bordered table-striped">
										<thead class="thin-border-bottom">
											<tr><th class="detail-col center">
													<label class="pos-rel">
														<span class="lbl"></span>
													</label>
												</th>
												<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>
												<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
												<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
												<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 재질</th>
												<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 로트No</th>
												<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 구매입고일</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td colspan='11' class='center'>등록된 품목이 없습니다.</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">지시량</th>
								<td class="col-xs-5">
									<input type="text" name="order_qty" id="order_qty" value="<?=number_format($t->order_qty)?>"onKeyPress="onlyNumber();" onKeyUp="input_comma(this);" onclick='this.select();' class="onlynum text-right" />
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">생산실적수량</th>
								<td class="col-xs-5">
									<input type="text" name="output_qty" id="output_qty" value="<?=number_format($t->output_qty)?>" onKeyPress="onlyNumber();" onKeyUp="input_comma(this);" onclick='this.select();' class="onlynum text-right"/>
								</td>

							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">현재시간</th>
								<td class="col-xs-5">
									<span class="input-icon input-icon-right">
										<!-- <div class="input-group">
											<input class=" date-picker" name="p_now_tm" id="p_now_tm" type="text" value="<?=date('Y-m-d')?>" data-date-format="yyyy-mm-dd" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>&nbsp;
										</div> -->
										<div class="input-group bootstrap-timepicker">
											<input name="p_now_tm" id="timepicker3" type="text" value="<?=$t->p_now_tm?>" data-date-format="hh:ii:ss"/>
											<span class="input-group-addon">
												<i class="fa fa-clock-o bigger-110"></i>
											</span>
										</div>
									</span>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">박스당수량</th>
								<td class="col-xs-5">
									<input type="text" name="box_limit_qty" id="box_limit_qty" class="text-right" value="<?=$t->box_limit_qty?>" onKeyPress="onlyNumber();" onKeyUp="input_comma(this);" onblur="publishQty()" style="ime-mode:disabled"/>
								</td>
								
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">목표량</th>
								<td class="col-xs-5">
									<input type="text" name="target_qty" id="target_qty" value="<?=number_format($t->target_qty)?>" class="onlynum text-right"/>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">라벨필요수량</th>
								<td class="col-xs-5">
									<input type="text" name="publish_qty" id="publish_qty" value="<?=number_format($t->publish_qty)?>" class="onlynum text-right"/>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업효율</th>
								<td class="col-xs-5">
									<input type="text" name="working_efficiency" id="working_efficiency" value="<?=$t->working_efficiency?>" onclick='this.select();' class="onlynum text-right"/>%
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업자</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="emp_id" id="emp_id" value="<?=$t->emp_id?>"/>
												<input type="text" name="emp_nm" id="emp_nm" value="<?=$t->emp_nm?>" onclick="centerOpenWindow('views/popup/employeeList.php', '사원리스트', 600, 500)" readonly />
												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/employeeList.php', '사원리스트', 600, 500)" >
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량수량1</th>
								<td class="col-xs-5">
									<input type="text" name="faulty_qty1" id="faulty_qty1" value="<?=$t->faulty_qty1?>" class="onlynum text-right" />
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량유형1</th>
								<td class="col-xs-5">
									<input type="text" name="faulty_type1" id="faulty_type1" value="<?=$t->faulty_type1?>" />
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량수량2</th>
								<td class="col-xs-5">
									<input type="text" name="faulty_qty2" id="faulty_qty2" value="<?=$t->faulty_qty2?>" class="onlynum text-right" />
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량유형2</th>
								<td class="col-xs-5">
									<input type="text" name="faulty_type2" id="faulty_type2" value="<?=$t->faulty_type2?>" />
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">유실항목</th>
								<td class="col-xs-5">
									<select name="loss_item" id="loss_item" onchange="ChangeLossItem();" >
									<option value="1" <?if ($t->loss_item=="1") echo "selected"?>>설비고장</option>
									<option value="2" <?if ($t->loss_item=="2") echo "selected"?>>금형수리</option>
									<option value="3" <?if ($t->loss_item=="3") echo "selected"?>>품질확인</option>
									<option value="4" <?if ($t->loss_item=="4") echo "selected"?>>자재결품</option>
									<option value="5" <?if ($t->loss_item=="5") echo "selected"?>>기타</option>
									</select>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">유실시간</th>
								<td class="col-xs-5">
									<input type="text" name="loss_time" id="loss_time" value="<?=$t->loss_time?>"  class="onlynum text-right" />
								</td>
							</tr>
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
<input type="hidden" name="itemFlag" id="itemFlag" value="" />
<input type="hidden" name="lotnocdFlag" id="lotnocdFlag" value="1" />
<input type="hidden" name="inspectionFlag" id="inspectionFlag" value="1" />

<?
require_once ("assets/include_script.php");
?>

<script>
	function closePopup()
	{
		window.parent.closeModal('<?=$dialogid?>');
		//window.parent.location.reload();
	}
	window.closeModal = function(obj) {
		$("#"+obj).modal( 'hide' );
	}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	//createWorkCode();
	//getProductPerfReportsLotNo('<?=$t->work_bom?>');
	getProductPerfReportsLotNo('<?=$t->work_cd?>');
});

function removeComma(n) {  // 콤마제거
if ( typeof n == "undefined" || n == null || n == "" ) {
	return "";
}
var txtNumber = '' + n;
return txtNumber.replace(/(,)/g, "");
}

function efficiency(){
	var order_qty = removeComma($("#order_qty").val());
	var output_qty = removeComma($("#output_qty").val());
	var working_efficiency = "0";
	
	if (order_qty > "0" && output_qty > "0"){
		working_efficiency = (Number(output_qty)/Number(order_qty))*100
	}else{
		working_efficiency = "0"
	}

	$("#working_efficiency").val(Math.ceil(working_efficiency))
}


function publishQty(){
	var pq = Number(removeComma($("#output_qty").val())) / Number(removeComma($("#box_limit_qty").val())); 
	$("#publish_qty").val(pq)
}

function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#itemFlag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#itemFlag").val(nextFlag);
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


function moveItem(item_cd, item_nm, cnt, standard, current_cnt){
	var tag = "";
	var flag = $("#flag").val();
	var warehouse = "<?=$warehouse?>";
	var process = "<?=$process?>";

	var arr = [];
	var std = [];
	var item = [];

	$.each($(document).find(".item_cd") , function () {
		arr.push($(this).val());
	});
	$.each($(document).find(".standard") , function () {
		std.push($(this).val());
	});
	
	for(var i = 0 ; i <= arr.length ; i++) {
		item.push(arr[i] + std[i]);
	}

	var check = item_cd + standard;

	var idx = jQuery.inArray(check, item);
	if(idx >= 0) {
		alert("동일 품목을 이미 선택하셨습니다");
	} else {
		tag += "<tr class='item" + flag + "'>";
		tag += "<td class='center'><i class='delBtn fa fa-check fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
		tag += "<td class='center'>";
		tag += "<select name='process[]' id='process_" + flag +"' class='process' onchange='getMachine(" + flag + ",this.value)'>" + process + "</select>";
		tag += "</td>";
		tag += "<td class='center'>";
		tag += "<select name='machine[]' id='machine_" + flag +"'>";
		tag += "<option value='0'>기계선택</option>";
		tag += "</select>";
		tag += "</td>";
		tag += "<td><input type='text' class='form-control item_cd' name='item_cd[]' id='item_cd_" + flag + "' value='" + item_cd + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "' value='" + item_nm + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control standard' name='standard[]' id='standard_" + flag + "' value='" + standard + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control' name='goal_cnt[]' id='goal_cnt_" + flag + "' value='" + cnt + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control' name='current_cnt[]' id='current_cnt_" + flag + "' value='" + current_cnt + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control' name='order_cnt[]' id='order_cnt_" + flag + "' value='" + cnt + "' /></td>";
		tag += "<td><input type='text' class='form-control' name='seq[]' id='seq_" + flag + "' value='" + flag + "' /></td>";
		tag += "<td class='center'><select name='warehouse_cd[]' id='warehouse_cd_" + flag + "' class='warehouse'>" + warehouse + "</select></td>";
		tag += "</tr>";
		
		$("#product tbody").append(tag);

		$("#flag").val(Number(flag) + 1);
	}
}

function getWorkplanBom(workplan_cd){
	$.getJSON("ajax/production.php",{"mode":"getWorkplanBom","workplan_cd":workplan_cd},
		function(json){
			if(json != null) {
				if(json.length > 3) {
					for( var k = 0 ; k < json.length - 3 ; k++) {
						addTr();
					}
				}
				for(var i = 0 ; i < json.length ; i++){
					checkCalBom(json[i].item_cd, json[i].item_nm, json[i].standard, json[i].cnt, json[i].current_cnt);
				}
			}
		}
	);	
	getWorkplanItem(workplan_cd);
}

function checkCalBom(item_cd, item_nm, standard, cnt, current_cnt){
	var tag = "";
	var dataString = "mode=checkCalBom&item_cd=" + item_cd + "&standard=" + standard + "&cnt=" + cnt;
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/production.php",
		success : function(str) {
			if(str == "shortage") {
				tag += "<tr>";
				tag += "<td>" + item_cd + "<span style='color:red'> [원자재 및 재고부족]</span></td>";
				tag += "<td>" + item_nm + "</td>";
				tag += "<td>" + standard + "</td>";
				tag += "<td>" + cnt + "</td>";
				tag += "</tr>";	
			} else {
				tag += "<tr>";
				tag += "<td><span onclick=\"moveItem('" + item_cd + "','" + item_nm + "','" + cnt + "','" + standard + "'," + current_cnt + ")\" style='color:blue; cursor:pointer'>" + item_cd + "</span></td>";
				tag += "<td>" + item_nm + "</td>";
				tag += "<td>" + standard + "</td>";
				tag += "<td>" + cnt + "</td>";
				tag += "</tr>";					
			}
			$("#bom_list tbody").append(tag);
		}
	});
}


function getWorkplanItem(workplan_cd){
	var tag = "";
	$.getJSON("ajax/production.php",{"mode":"getWorkPlanItem","workplan_cd":workplan_cd},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td class='col-xs-1' style='background-color:#f1f1f1'>생산할 품목</td>";
					tag += "<td>" + json[i].item_nm + " [" + json[i].standard + "]</td>";
					tag += "<td class='col-xs-1' style='background-color:#f1f1f1'>생산할 수량</td>";
					tag += "<td>" + json[i].cnt + "</td>";
					tag += "</tr>";
				}
			}

			$("#workplan_item tbody").html(tag);
		}
	);	
}

function getProductPerfReportsLotNo(fid){
	var tag = "";
	var flag = $("#flag").val();
	$.getJSON("ajax/production.php",{"mode":"getProductPerfReportsLotNo","fid":fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<input type='hidden' name='lot_item_cd[]' id='lot_item_cd_"+flag+"' value='" + json[i].item_cd + "' /><input type='hidden' name='lot_item_nm[]' id='lot_item_nm_"+flag+"' value='" + json[i].item_nm + "' /><input type='hidden' name='lot_standard[]' id='lot_standard_"+flag+"' value='" + json[i].standard1 + "' /><input type='hidden' name='lot_material[]' id='lot_material_"+flag+"' value='" + json[i].material + "' />";
					tag += "<tr>";
					tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].material + "</td>";
					tag += "<td><input type='text' name='lot_no_cd[]' id='lot_no_cd_"+flag+"' value='" + json[i].lot_no_cd + "' onclick=\"lotnocdFlag(" + flag + ");lot_no_search('" + flag + "','"+json[i].item_cd+"','"+json[i].standard1+"')\" readonly></td>";
					tag += "<td>" + json[i].regdate_item + "</td>";
					tag += "</tr>";

					flag = Number(flag) + 1;
					$("#flag").val(flag);
				}
			}
			$("#ProductPerfReportsLotNo tbody").html(tag);
		}
	);	
}

function lotnocdFlag(flag) {
	$("#lotnocdFlag").val(flag);
}

//구매입고 내역에서 LOT_NO를 검색해서 선택하는 방식 erp_warehousing_lot_no 테이블 이용
function lot_no_search(cidx,cd,st)
{
	$("#id-btn-dialog2").modal({
		show: true,
		title : "LOT-NO 검색",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=production&action=listLotNoItem&idx="+cidx+"&item_cd="+cd+"&standard="+st+"&pop=Y&dialogid=id-btn-dialog2";
	$("#lot_no_search_frame").attr("src", url);
}

//LOT 넘버를 검색 해서 추가 하는 방식
function lot_no_reg(cidx,cd)
{
	$("#id-btn-dialog2").modal({
		show: true,
		title : "LOT-NO 검색",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=production&action=listLotNoItem&idx="+cidx+"&item_cd="+cd+"&pop=Y&dialogid=id-btn-dialog2";
	$("#lot_no_search_frame").attr("src", url);
}

function formSubmit(){
	var orderQty = $("#order_qty").val();
	var targetQty = $("#target_qty").val();
	var worker = $("#worker").val();
	
	if (orderQty==""){
		alert('지시량를 입력하세요.');
		$("#order_qty").focus();
		return false;
	}
	if (targetQty==""){
		alert('목표량을 입력하세요.');
		$("#target_qty").focus();
		return false;
	}
	if (worker==""){
		alert('작업자를 입력하세요.');
		$("#worker").focus();
		return false;
	}
	$("#frm").submit();
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
	
	// 견적서 팝업
	$( "#id-btn-dialog1" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 1000,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>생산계획</h4></div>",
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
		
	$('#timepicker3').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		format: 'hh:ii',
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#timepicker3').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});		

	$('#timepicker1').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		format: 'hh:ii',
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#timepicker1').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});

	$('#timepicker2').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		format: 'hh:ii',
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#timepicker2').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});

	$('#timePicker4').clockpicker({
                placement: 'bottom',    // 시계 바인딩 방향 top,bottom,right,left
                //align: 'right',       // 시계 위치 right,left 
                align: 'left',
                autoclose: true,      // 자동 닫기
                //default: '09:00',
                //donetext: ''
    });

	$('#timePicker5').clockpicker({
                placement: 'bottom',    // 시계 바인딩 방향 top,bottom,right,left
                //align: 'right',       // 시계 위치 right,left 
                align: 'left',
                autoclose: true,      // 자동 닫기
                //default: '00:00',
                //donetext: ''
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