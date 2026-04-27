<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);

?>

<script type="text/javascript">
<!--
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

	function removeComma(n) {  // 콤마제거
	if ( typeof n == "undefined" || n == null || n == "" ) {
		return "";
	}
	var txtNumber = '' + n;
	return txtNumber.replace(/(,)/g, "");
	}

	function setText(){
	var state = jQuery('#faulty_type1 option:selected').val();
		if(state == '기타') {
			jQuery('.layer').show();
		} else {
			jQuery('.layer').hide();
		}
	}

	function comma(str) {
		str = String(str);
		return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
	}	
		
//-->
</script>
<style type="text/css">
	.layer { display: none; }
</style>
<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index_.php">
						<input type="hidden" name="controller" id="controller" value="production" />
						<input type="hidden" name="action" id="action" value="inputPagePlate" />
						<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />
						
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">도금입고일자</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="production_dt" id="production_dt" type="text" value="<?=date('Y-m-d')?>" data-date-format="yyyy-mm-dd" readonly/>
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>&nbsp;
												<select name="day_gubun" id="day_gubun">
												<option value="주간">주간</option>
												<option value="야간">야간</option>
												</select>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1"> 작업지시서</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="work_bom" id="work_bom" />
												<input type="text" name="work_cd" id="work_cd" onclick="centerOpenWindow('views/popup/workOrderListPut.php', '작업지시서 리스트', 1000, 500)" readonly/>
												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/workOrderListPut.php', '작업지시서 리스트', 1000, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>&nbsp;
												
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<!--
								<th class="col-xs-1" style="background-color:#f1f1f1">작업시간</th>
								<td class="col-xs-5">
									<div class="input-group">
										<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" id="timePicker4" style="width:110px;float:left">
											<input type="text" name="p_plan_tm1" class="form-control" value="<?=date('H:i')?>">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time"></span>
											</span>
										</div>
										<div style="width:20px;float:left;center;padding-left:8px"><strong>-</strong> 
										</div>
										<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" id="timePicker5" style="width:110px;float:left">
											<input type="text" name="p_plan_tm2" class="form-control" value="<?=date('H:i')?>">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time"></span>
											</span>
										</div>
									</div>
								</td>

								-->
								<th class="col-xs-1" style="background-color:#f1f1f1"> 생산품목</th>
								<td class="col-xs-5" colspan="3">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="material" id="material" />
												<input type="text" name="item_nm" id="item_nm" onclick="centerOpenWindow('views/popup/ProductPerfReportsLotNo.php', '품목 리스트', 800, 500)" placeholder='품목명' readonly/>
												<input type="text" name="item_cd" id="item_cd" class="item_cd" onclick="centerOpenWindow('views/popup/ProductPerfReportsLotNo.php', '품목 리스트', 800, 500)" placeholder='품목코드' readonly/>
												<input type="text" name="standard1" id="standard1" class="standard1" onclick="centerOpenWindow('views/popup/ProductPerfReportsLotNo.php', '품목 리스트', 800, 500)" placeholder='규격' readonly/>

												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/ProductPerfReportsLotNo.php', '품목 리스트', 800, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"> 도금업체<br>생산기기</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="process_cd" id="process_cd" value="P05" />
												<input type="text" name="process_nm" id="process_nm" value="도금" readonly/>
											</div>
										</span>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="machine_uid" id="machine_uid" value="27"/>
												<input type="text" name="machine_nm" id="machine_nm" value="도금1호기" readonly/>
												
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1"> LOT_NO<br>(공정이동)</th>
								<td class="col-xs-5">
									<input type="text" name="LOT_NO" id="LOT_NO" class="text-left"/> ex)<?="TS_LOT".date("Ymdhi",time())?> ← 미입력시 자동부여
								</td>
							</tr>


							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"> 원자재 투입<br>로트 등록</th>
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
												<td colspan='11' class='center'> 등록된 품목이 없습니다.</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"> 포장수량</th>
								<td class="col-xs-5">
									<input type="text" name="output_qty" id="output_qty" class="text-right" value='1' onKeyPress="onlyNumber();" onKeyUp="input_comma(this);" onclick='this.select();' onblur="publishQty()" style="ime-mode:disabled"/>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">박스당수량</th>
								<td class="col-xs-5">
									<input type="text" name="box_limit_qty" id="box_limit_qty" value='1' class="text-right" onKeyPress="onlyNumber();" onKeyUp="input_comma(this);" onclick='this.select();' onblur="publishQty()" style="ime-mode:disabled"/>
								</td>
							</tr>
							
							<tr>
								<!--
								<th class="col-xs-1" style="background-color:#f1f1f1">작업자</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="emp_id" id="emp_id" />
												<input type="text" name="emp_nm" id="emp_nm" onclick="centerOpenWindow('views/popup/employeeList.php', '사원리스트', 600, 500)" readonly />
												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/employeeList.php', '사원리스트', 600, 500)" >
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>&nbsp;
												<!-- <label class="pl-1">
													<input type="checkbox" name="purchaseOrderState" id="purchaseOrderState" value='Y' class="ace input-sm pl-1" ><span class="lbl pl-1">생산 입고 처리</span></label>
												</label> -->
												<!--
												//<input name="switch-field-1" class="ace ace-switch ace-switch-2"  name="product_stock_in" id="product_stock_in" value="Y" type="checkbox" />
												//<span class="lbl">&nbsp;생산 입고 처리</span>
												
											</div>
										</span>
										
									</div>
								</td>
								-->
								<th class="col-xs-1" style="background-color:#f1f1f1">라벨필요수량</th>
								<td class="col-xs-5" colspan="3">
									<input type="text" name="publish_qty" id="publish_qty" class="text-right" onKeyPress="onlyNumber();" onclick='this.select();' onKeyUp="input_comma(this);" style="ime-mode:disabled"/> &nbsp;※포장수량 / 박스당수량
								</td>
							</tr>
							<!--
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 생산공장</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="wh_cd_f_cd" id="wh_cd_f_cd" />
												<input type="text" name="wh_cd_f_nm" id="wh_cd_f_nm" onclick="centerOpenWindow('views/popup/warehouseFromList.php', '생산공장', 400, 600)" />
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
											<input type="text" name="warehouse_nm" id="warehouse_nm" onclick="centerOpenWindow('views/popup/warehouseList.php', '입고창고', 500, 600)" />
											<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/warehouseList.php', '입고창고', 500, 600)">
												<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
											</span>
										</div>
									</span>
								</td>
							</tr>
							
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">출하일자</th>
								<td class="col-xs-5" colspan='3'> 
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="shipment_dt" id="shipment_dt" type="text" value="<?=date('Y-m-d')?>" data-date-format="yyyy-mm-dd" readonly/>
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							-->
							<!-- <tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">비고</th>
								<td class="col-xs-5" colspan="3">
									<input type="text" name="remark" id="remark" class="form-control" style="ime-mode:disabled"/>
								</td>
							</tr> -->
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
					<button class="btn" type="reset" onclick="window.parent.closeModal('<?=$dialogID?>');">
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
<input type="hidden" name="processCheck" id="processCheck" />
<div id="id-btn-dialog2" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:80%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">LOT_NO 검색</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="lot_no_search_frame" frameborder="0" width="99%" height="370" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?
require_once ("assets/include_script.php");
?>

<script>
	function closePopup()
	{
		window.parent.closeModal('<?=$dialogID?>');
		//window.parent.location.reload();
	}
	window.closeModal = function(obj) {
		$("#"+obj).modal('hide');
	}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	//createWorkCode();
	

});


function publishQty(){
	var pq = Number(removeComma($("#output_qty").val())) / Number(removeComma($("#box_limit_qty").val())); 
	$("#publish_qty").val(Math.ceil(pq))
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

function getProductPerfReportsLotNo(item_uid){
	var tag = "";
	var flag = $("#flag").val();
	var wcd = $("#work_cd").val();

	$.getJSON("ajax/production.php",{"mode":"getProductPerfReportsLotNo2","fid":item_uid, "work_cd": wcd},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<input type='hidden' name='lot_item_cd[]' id='lot_item_cd_"+flag+"' value='" + json[i].item_cd + "' /><input type='hidden' name='lot_item_nm[]' id='lot_item_nm_"+flag+"' value='" + json[i].item_nm + "' /><input type='hidden' name='lot_standard[]' id='lot_standard_"+flag+"' value='" + json[i].standard1 + "' /><input type='hidden' name='lot_material[]' id='lot_material_"+flag+"' value='" + json[i].material + "' /><input type='hidden' name='regdate_item[]' id='regdate_item_"+flag+"' value='" + json[i].regdate_item + "' /><input type='hidden' name='warehousing_cd[]' id='warehousing_cd_"+flag+"' value='" + json[i].warehousing_cd + "' />";
					tag += "<tr>";
					tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].material + "</td>";
					/*
					tag += "<td><input type='text' name='lot_no_cd[]' id='lot_no_cd_"+flag+"' value='' onclick=\"lotnocdFlag(" + flag + ");lot_no_search('" + flag + "','"+json[i].item_cd+"','"+json[i].standard1+"')\" readonly></td>";
					tag += "<td><input type='text' class='regdate_"+flag+"'  name='regdate[]' id='regdate_"+flag+"' value=''readonly/></td>";
					*/
					if(json[i].lot_no_cd != null ){
						tag += "<td><input type='text' class='lot_no_cd' name='lot_no_cd[]' id='lot_no_cd_"+flag+"' value='"+json[i].lot_no_cd +"' onclick=\"lotnocdFlag(" + flag + ");lot_no_search('" + flag + "','"+json[i].item_cd+"','"+json[i].standard1+"')\" placeholder='[Lot click]'  readonly></td>";
					}else{
						tag += "<td><input type='text' class='lot_no_cd' name='lot_no_cd[]' id='lot_no_cd_"+flag+"' value='' onclick=\"lotnocdFlag(" + flag + ");lot_no_search('" + flag + "','"+json[i].item_cd+"','"+json[i].standard1+"')\" placeholder='[Lot click]'  readonly></td>";
					}
					
					if(json[i].regdate_item != null ){ 
						tag += "<td><input type='text' class='regdate_"+flag+"'  name='regdate[]' id='regdate_"+flag+"' value='"+json[i].regdate_item +"'readonly/></td>";
					}else{
						tag += "<td><input type='text' class='regdate_"+flag+"'  name='regdate[]' id='regdate_"+flag+"' value=''readonly/></td>";
					}


					tag += "</tr>";

					flag = Number(flag) + 1;
					$("#flag").val(flag);
				}
			}
			$("#ProductPerfReportsLotNo tbody").html(tag);
		}
	);	

	getPPRWorkDateCheck(wcd , item_uid);
}

function getPPRWorkDateCheck(wcd, item_uid){
	
	var data_string = "mode=getPPRWorkDateCheck&work_cd=" + wcd + "&item_uid="+ item_uid;
	
	$.ajax({
		type : "post",
		url : "ajax/production.php",
		data : data_string,
		success : function(str) {
			if (str=="success")
			{
				if(confirm("이미 등록된 작업지시서 정보가 있습니다.\n자동으로 정보를 불러오시겠습니까?.")) {
					getProductPerfReportsVal2(wcd , item_uid);
				}else{
				
				$("#output_qty").val(0);
				$("#box_limit_qty").val(0);
				$("#target_qty").val(0);
				$("#working_efficiency").val(0);
				$("#faulty_qty1").val(0);	
				$('#faulty_type1 option:selected').val('');
				$("#faulty_qty2").val(0);	
				$('#faulty_type2 option:selected').val('');
				$("#writer").val("");
				$("#emp_id").val("");	
				$("#emp_nm").val("");	
				$("#publish_qty").val(0);	
				
				$('#loss_item option:selected').val("");
				$("#loss_time").val(0);
				$("#LOT_NO").val("");


				}
			}
		}
	});
}

function getProductPerfReportsVal2(wcd, item_uid){
	$.getJSON("ajax/production.php",{"mode":"getProductPerfReportsVal2","work_cd":wcd, "item_uid" : item_uid },
		function(json){
			if(json != null) {

				var p_plan_tm		= json.p_plan_tm
				var p_now_tm		= json.p_now_tm
				var output_qty		= comma(json.output_qty)
				var item_cd			= json.item_cd
				var item_nm			= json.item_nm
				var standard1		= json.standard1
				var work_cd			= json.work_cd
				var publish_qty		= comma(json.publish_qty)
				var emp_id			= json.emp_id
				var emp_nm			= json.emp_nm
				var box_limit_qty	= comma(json.box_limit_qty)

				$("#output_qty").val(output_qty);	
				$("#publish_qty").val(publish_qty);	
				$("#emp_id").val(emp_id);	
				$("#emp_nm").val(emp_nm);	
				$("#box_limit_qty").val(box_limit_qty);	
				$("#LOT_NO").val(json.LOT_NO);

			}
		}
	);
}

 //생산실적등록시 동일 작업지지서 중복 공정 체크
function getPPRWorkProcessCheck(){
	var process_cd		= $("#process_cd").val();
	var work_cd			= $("#work_cd").val();
	var machine_uid		= $("#machine_uid").val();
	var	return_str_val  = "";
	var data_string = "mode=getPPRWorkProcessCheck&process_cd=" + process_cd+"&work_cd=" + work_cd+"&machine_uid=" + machine_uid;

	$.ajax({
		type : "post",
		url : "ajax/production.php",
		data : data_string,
		success : function(str) {

			if (str=="success")
			{   
				$("#processCheck").val('1')
				alert("이미 작업지시서 내에서 중복으로 등록된 공정입니다.")
				return false;
			}
		}
	});
}

function lotnocdFlag(flag) {
	$("#lotnocdFlag").val(flag);
}

//구매입고 내역에서 LOT_NO를 검색해서 선택하는 방식 erp_warehousing_lot_no 테이블 이용
function lot_no_search(cidx,cd,st)
{
	$("#id-btn-dialog2").modal({
		show: true,
		title : "투입대기",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=production&action=listLotNoItem2&idx="+cidx+"&item_cd="+cd+"&standard="+st+"&pop=Y&dialogID=id-btn-dialog2";
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
	var url = "index.php?controller=production&action=listLotNoItem&idx="+cidx+"&item_cd="+cd+"&pop=Y&dialogID=id-btn-dialog2";
	$("#lot_no_search_frame").attr("src", url);
}

function close_popup()
{	
	$.modal.close();
	$("#standard_code_reg_frame").attr("src", "about:blank");
}
function closePopup()
{
	window.parent.closeModal('<?=$dialogID?>');
	window.parent.location.reload();
}
window.closeModal = function(obj) {
	$("#"+obj).modal( 'hide' );
}


function formSubmit(){

	if($("#LOT_NO").val()==""){
		alert("공정이동 LOT_NO를 입력하세요");
		return false;	
	}

	var item_nm		= $("#item_nm").val();
	var output_qty		= $("#output_qty").val();
	var box_limit_qty	= $("#box_limit_qty").val();
	var publish_qty		= $("#publish_qty").val();
	var emp_nm		= $("#emp_nm").val();
	var processCheck	= $("#processCheck").val();
	var product_stock_in	= $("input:checkbox[id='product_stock_in']").is(":checked");
	var wh_cd_f_nm		= $("#wh_cd_f_nm").val();
	var warehouse_nm	= $("#warehouse_nm").val();

	//getPPRWorkProcessCheck() //동일 작업지시서 내에서 중복 공정 입력 방지
	if (item_nm==""){
		alert('생산품목을 입력하세요.');
		$("#item_nm").focus();
		return false;
	}

	if (processCheck=="1"){
		alert("이미 작업지시서 내에서 중복으로 등록된 공정입니다.")
		return false;
	}
	
	if (output_qty==""){
		alert('포장 수량를 입력하세요.');
		$("#output_qty").focus();
		return false;
	}

	if (item_nm==""){
		alert('완제품 품목을 입력하세요.');
		$("#item_nm").focus();
		return false;
	}

	if (box_limit_qty==""){
		alert('박스당 수량을 입력하세요.');
		$("#box_limit_qty").focus();
		return false;
	}

	if (publish_qty==""){
		alert('라벨필요 수량을 입력하세요.');
		$("#publish_qty").focus();
		return false;
	}

	if (emp_nm==""){
		alert('작업자를 입력하세요.');
		$("#emp_nm").focus();
		return false;
	}
	
	if(product_stock_in == true){
		if (wh_cd_f_nm==""){
			alert('생산공장을 수량을 입력하세요.');
			$("#wh_cd_f_nm").focus();
			return false;
		}
		if (warehouse_nm==""){
			alert('완제품 입고창고를 입력하세요.');
			$("#warehouse_nm").focus();
			return false;
		}
	}
/*
	if(product_stock_in == true){
		if(confirm("생산 입고 처리를 하시겠습니까?")) {
			$("#frm").submit();
		}else{
			$("input:checkbox[id='product_stock_in']").prop("checked", false);
			$("#frm").submit();
		}
	}else{
		if(confirm("생산 입고 처리를 하지 않고 등록 하시겠습니까?\n취소버튼을 누르시면 자동으로 생산 입고 처리 됩니다.")) {
			$("input:checkbox[id='product_stock_in']").prop("checked", false);
			$("#frm").submit();
		}else{
			$("input:checkbox[id='product_stock_in']").prop("checked", true);
			$("#frm").submit();
		}
	}
*/
	$("#frm").submit();

}
</script>

<script type="text/javascript">
//$('.clockpicker').clockpicker();

 $(document).ready(function () {

            $('#timePicker').clockpicker({
                placement: 'bottom',    // 시계 바인딩 방향 top,bottom,right,left
                //align: 'right',       // 시계 위치 right,left 
                align: 'left',
                autoclose: false,      // 자동 닫기
                default: '09:00',
                donetext: ''
            });

        });


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