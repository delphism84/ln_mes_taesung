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

	function setText(obj){
	var state = jQuery('#faulty_type'+obj+' option:selected').val();
	var item = jQuery('#loss_item option:selected').val();

	if (obj=="1" || obj=="2"){
		if(state == '기타') {
			jQuery('.layer'+obj).show();
		} else {
			jQuery('.layer'+obj).hide();
		}
	}else if (obj=="3"){
		if(item == '5'){
			jQuery('.layer3').show();
		} else {
			jQuery('.layer3').hide();
		}
	}
	}
//-->
</script>
<style type="text/css">
	.layer1 { display: none; }
	.layer2 { display: none; }
	.layer3 { display: none; }
</style>
<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index_.php">
						<input type="hidden" name="controller" id="controller" value="production" />
						<input type="hidden" name="action" id="action" value="registProductPerfReportsUpdate" />
						<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />
						<input type="hidden" name="uid" id="uid" value="<?=$uid?>" />
						
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">생산일자</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<?=$t->production_dt?>&nbsp;(<?=$t->day_gubun?>)
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업지시서</th>
								<td class="col-xs-5">
									<?=$t->work_cd?>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">공정/기기</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												작업 공정명 : <?=$t->process_nm?> | 생산 기기명 : <?=$t->machine_nm?>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">생산품목</th>
								<td class="col-xs-5">
												품목명:<?=$t->item_nm?> | 품목코드:<?=$t->item_cd?> | 규격:<?=$t->standard1?>
								</td>
								
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">가동시간</th>
								<td class="col-xs-5">
									<div class="input-group">
										<?=substr($t->p_plan_tm,0,5)?> ~ <?=substr($t->p_plan_tm,-5,5)?>
										</div>
			
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1" nowrap>공정이동로트번호 </th>
								<td class="col-xs-5">
									<?=$t->LOT_NO?>
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
												<td colspan='11' class='center'>등록된 품목이 없습니다.</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">지시수량</th>
								<td class="col-xs-5 text-right">
									<?=number_format($t->order_qty)?>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">생산실적수량</th>
								<td class="col-xs-5 text-right">
									<?=number_format($t->output_qty)?>
								</td>

							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">현재시간</th>
								<td class="col-xs-5">
									<?=$t->p_now_tm?>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">박스당수량</th>
								<td class="col-xs-5 text-right">
									<?=$t->box_limit_qty?>
								</td>
								
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">목표량</th>
								<td class="col-xs-5 text-right">
									<?=number_format($t->target_qty)?>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">라벨필요수량</th>
								<td class="col-xs-5 text-right">
									<?=number_format($t->publish_qty)?>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업효율</th>
								<td class="col-xs-5 text-right">
									<?=$t->working_efficiency?>%
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업자</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<?=$t->emp_nm?>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량수량1</th>
								<td class="col-xs-5 text-right">
									<?=$t->faulty_qty1?>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량유형1</th>
								<td class="col-xs-5 ">
										<?=$t->faulty_type1?>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량수량2</th>
								<td class="col-xs-5 text-right">
									<?=$t->faulty_qty2?>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량유형2</th>
								<td class="col-xs-5">
									<?=$t->faulty_type2?>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량수량3</th>
								<td class="col-xs-5 text-right">
									<?=$t->faulty_qty3?>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량유형3</th>
								<td class="col-xs-5">
									<?=$t->faulty_type3?>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량수량4</th>
								<td class="col-xs-5 text-right">
									<?=$t->faulty_qty4?>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량유형4</th>
								<td class="col-xs-5">
									<?=$t->faulty_type4?>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량수량5</th>
								<td class="col-xs-5 text-right">
									<?=$t->faulty_qty5?>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량유형5</th>
								<td class="col-xs-5">
									<?=$t->faulty_type5?>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량수량6</th>
								<td class="col-xs-5 text-right">
									<?=$t->faulty_qty6?>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량유형6</th>
								<td class="col-xs-5">
									<?=$t->faulty_type6?>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량수량7</th>
								<td class="col-xs-5 text-right">
									<?=$t->faulty_qty7?>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량유형7</th>
								<td class="col-xs-5">
									<?=$t->faulty_type7?>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">유실항목</th>
								<td class="col-xs-5">
									<?=$t->loss_item?>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">유실시간</th>
								<td class="col-xs-5 text-right">
									<?=$t->loss_time?>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div><!-- /.row -->

			
			
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
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
		$("#"+obj).modal( 'hide' );
	}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	//createWorkCode();
	//getProductPerfReportsLotNo('<?=$t->work_bom?>');
	getProductPerfReportsLotNo('<?=$t->uid?>');
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
	$.getJSON("ajax/production.php",{"mode":"getProductPerfReportsLotNoList","fid":fid},
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
					tag += "<td>" + json[i].lot_no_cd + "</td>";
					tag += "<td>" + json[i].warehousing_dt + "</td>";
					tag += "</tr>";

					flag = Number(flag) + 1;
					$("#flag").val(flag);
				}
			}else{
				tag += "<tr><td colspan='7' class='center'>등록된 원자재 투입 품목이 없습니다.</td></tr>";
			}
			$("#ProductPerfReportsLotNo tbody").html(tag);
		}
	);	
}
 //생산실적등록시 동일 작업지지서 중복 공정 체크
function getPPRWorkProcessCheck(){
	var process_cd		= $("#process_cd").val()
	var work_cd			= $("#work_cd").val()
	var machine_uid			= $("#machine_uid").val()
	var data_string = "mode=getPPRWorkProcessCheck&process_cd=" + process_cd+"&work_cd=" + work_cd+"&machine_uid=" + machine_uid;
	
	$.ajax({
		type : "post",
		url : "ajax/production.php",
		data : data_string,
		success : function(str) {
			if (str=="success")
			{
				alert("동일 작업지시서 내에서 중복으로 등록된 공정입니다.\n다른 공정을 선택하세요.")
				$("#process_cd").val('')
				$("#process_nm").val('')
				$("#machine_uid").val('')
				$("#machine_nm").val('')
				$("#process_nm").attr("placeholder", "작업 공정명").placeholder();
				$("#machine_nm").attr("placeholder", "생산 기기명").placeholder();
				$("#machine_nm").focus;
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
		title : "LOT-NO 검색",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=production&action=listLotNoItem&idx="+cidx+"&item_cd="+cd+"&standard="+st+"&pop=Y&dialogID=id-btn-dialog2";
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

function formSubmit(){
		var item_nm = $("#item_nm").val();
	var orderQty = $("#order_qty").val();
	var targetQty = $("#target_qty").val();
	var output_qty = $("#output_qty").val();
	var box_limit_qty = $("#box_limit_qty").val();
	var publish_qty= $("#publish_qty").val();
	var process_nm= $("#process_nm").val();
	var machine_nm= $("#machine_nm").val();
	var emp_nm = $("#emp_nm").val();
	
	if (item_nm==""){
		alert('생산품목을 입력하세요.');
		$("#item_nm").focus();
		return false;
	}

	if (process_nm==""){
		alert('공정명을 입력하세요.');
		$("#process_nm").focus();
		return false;
	}

	if (machine_nm==""){
		alert('생산기기를 입력하세요.');
		$("#machine_nm").focus();
		return false;
	}

	getPPRWorkProcessCheck() //동일 작업지시서 내에서 중복 공정 입력 방지

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

	if (output_qty==""){
		alert('생산실적 수량를 입력하세요.');
		$("#output_qty").focus();
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

	var faulty_type1_val = $('#faulty_type1 option:selected').val();

	if (faulty_type1_val=="기타")
	{
		var faulty_type1_text = $("#faulty_type1_1").val();
	}else{
		var faulty_type1_text = faulty_type1_val;
	}
	
	$('#faulty_type1 option:selected').val(faulty_type1_text);

	var faulty_type2_val = $('#faulty_type2 option:selected').val();

	if (faulty_type2_val=="기타")
	{
		var faulty_type2_text = $("#faulty_type2_1").val();
	}else{
		var faulty_type2_text = faulty_type2_val;
	}

	$('#faulty_type2 option:selected').val(faulty_type2_text);
	
	if ($('#faulty_qty1').val() > 0 && faulty_type_val=='')
	{
		alert('불량유형을 입력하세요.');
		$('#faulty_type1 option:selected').focus();
		return false;
	}

	if ($('#faulty_qty2').val() > 0 && faulty_type_val=='')
	{
		alert('불량유형을 입력하세요.');
		$('#faulty_type1 option:selected').focus();
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