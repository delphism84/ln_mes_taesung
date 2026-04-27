<?
$sql = "select * from erp_warehouse";
$result = mysql_query($sql);
while($t1 = mysql_fetch_object($result)) {
	//$warehouse .= "<option value='".$t1->warehouse_cd."'" if($t->warehouse_cd==$t1->warehouse_cd) echo 'selected';">".$t->warehouse_nm."</option>";
	if($t->warehouse_cd == $t1->warehouse_cd){
		$warehouse .= "<option value='".$t1->warehouse_cd."' selected>".$t1->warehouse_nm."</option>";
	}else{
		$warehouse .= "<option value='".$t1->warehouse_cd."' >".$t1->warehouse_nm."</option>";
	}
	
}

$sql = "select * from erp_process";
$result = mysql_query($sql);
while($t2 = mysql_fetch_object($result)) {
	if($t->process_cd == $t1->process_cd){
		$process .= "<option value='".$t2->process_cd."' selected>".$t2->process_nm."</option>";
	}else{
		$process .= "<option value='".$t2->process_cd."'>".$t2->process_nm."</option>";
	}
	
}
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
					<a href="#">생산관리</a>
				</li>
				<li class="active">작업지시서</li>
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

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					작업지시서 수정
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						고객의 기본정보를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="production" />
						<input type="hidden" name="action" id="action" value="updateWork" />
						<input type="hidden" name="order_cd" id="order_cd" />
						<input type="hidden" name="work_cd" id="work_cd" value="<?=$t->work_cd?>"/>
						<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>"/>
						
						<!-- 테이블 -->
						<table id="simple-table" class="table table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업지시서 번호</th>
								<td class="col-xs-5" colspan="3">
									<input type="text" name="work_dt" id="work_dt" value="<?=$t->work_dt?>" <? if($_SESSION['auto_code'] == "y") echo "readonly"; ?> /> - <?=$t->work_cha?>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업 시작일</th>
								<td class="col-xs-5">
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="work_start_dt" id="work_start_dt" value="<?=$t->start_dt?>"/>
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업 종료일</th>
								<td class="col-xs-5">
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="work_end_dt" id="work_end_dt" value="<?=$t->end_dt?>" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 거래처</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="account_cd" id="account_cd" value="<?=$t->account_cd?>" readonly />
												<input type="text" name="account_nm" id="account_nm"  value="<?=$t->account_nm?>" onclick="centerOpenWindow('views/popup/accountList.php', '거래처리스트', 600, 500)" readonly />
												<span class="input-group-addon btn-purple"  style="cursor:pointer" onclick="centerOpenWindow('views/popup/accountList.php', '거래처리스트', 600, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 담당자</th>
								<td class="col-xs-5"><input type="text" name="manager" id="manager" value="<?=$t->manager?>" /> * 거래처 담당자</td>
							</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">프로젝트</th>
									<td class="col-xs-5">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="project_cd" id="project_cd" value="<?=$t->project_cd?>" readonly />
													<input type="text" name="project_nm" id="project_nm" value="<?=$t->project_nm?>" onclick="centerOpenWindow('views/popup/projectList.php', '프로젝트리스트', 600, 500)" readonly />
													<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/projectList.php', '프로젝트리스트', 600, 500)">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">생산공장</th>
									<td class="col-xs-5">
										<select name="warehouse_cd" id="warehouse_cd">
											<option value="">생산공장 선택</option>
										</select>
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">납기일자</th>
									<td class="col-xs-5">
										<div>
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" name="deadline_dt" id="deadline_dt" type="text" value="<?=$t->deadline_dt?>" data-date-format="yyyy-mm-dd" />
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">생산계획코드</th>
									<td><input type="hidden" name="workplan_uid" id="workplan_uid" /><input type="text" value="<?=$t->workplan_cd?>" name="workplan_cd" id="workplan_cd" /></td>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
						
						<table id="bom_list" class="table  table-bordered table-hover" style="margin-top:10px">
							<thead>
								<tr>
									<th style="background-color:#f1f1f1" colspan="6">BOM 소요량</th>
								</tr>
								<tr>
									<th style="background-color:#f1f1f1">품목코드</th>
									<th style="background-color:#f1f1f1">품목명</th>
									<th style="background-color:#f1f1f1">규격</th>
									<th style="background-color:#f1f1f1">재질</th>
									<th style="background-color:#f1f1f1">단위</th>
									<th style="background-color:#f1f1f1">소요수량</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>

						<a class="btn btn-xs btn-success" onclick="centerOpenWindow('views/popup/workItemPut.php?mode=modify', '품목 리스트', 800, 500)">품목선택</a>
						<a class="btn btn-xs btn-info" onclick="centerOpenWindow('views/popup/wPlanList.php', '생산계획서 리스트', 800, 500)"">생산계획서 품목가져오기</a>
						<table id="product" class="table table-bordered table-hover" style="margin-top:10px">
							<thead>
								<tr>
									<th class="detail-col center" style="background-color:#f1f1f1"></th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">품목코드</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">품목명</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">규격</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">재질</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">단위</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">수량</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1;">생산공장</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</form>
				</div>
			</div><!-- /.row -->

			
			
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						수정
					</button>
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=production&action=listPageWork' ">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록가기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<input type="hidden" name="flag" id="flag" value="1" />

<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	<? if($_SESSION['auto_code'] == "y") { ?>createWorkCode();<?}?>


		getWarehouse();
		getWorkBom();
});

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
// 거래처 리스트 가져오기
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

function moveItem(item_cd, item_nm, cnt, standard1, unit, current_cnt){
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
		tag += "<td><input type='text' class='form-control standard1' name='standard1[]' id='standard1_" + flag + "' value='" + standard1 + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control material' name='material[]' id='material_" + flag + "' value='" + material + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + unit + "' readonly /></td>";
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
				/*
				if(json.length > 3) {
					for( var k = 0 ; k < json.length - 3 ; k++) {
						addTr();
					}
				}
				*/
				for(var i = 0 ; i < json.length ; i++){
					checkCalBom(json[i].item_cd, json[i].item_nm, json[i].standard1, json[i].material, json[i].unit, json[i].cnt, json[i].current_cnt);
				}
			}
		}
	);	
	//getWorkplanItem(workplan_cd);
	getWorkplanItem();
}

function getWorkBom(){
	var work_cd = $("#work_cd").val();
	$.getJSON("ajax/production.php",{"mode":"getWorkBom","work_cd":work_cd},
		function(json){
			if(json != null) {
				/*
				if(json.length > 3) {
					for( var k = 0 ; k < json.length - 3 ; k++) {
						addTr();
					}
				}
				*/
				for(var i = 0 ; i < json.length ; i++){
					checkCalBom(json[i].item_cd, json[i].item_nm, json[i].standard1, json[i].material, json[i].unit, json[i].cnt, json[i].current_cnt);
				}
			}
		}
	);	
	getWorkItem();
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
				tag += "</tr>";	
			} else {
				tag += "<tr>";
				tag += "<td><span onclick=\"moveItem('" + item_cd + "','" + item_nm + "','" + cnt + "','" + standard1 + "','" + unit + "'," + current_cnt + ")\" style='color:blue; cursor:pointer'>" + item_cd + "</span></td>";
				tag += "<td>" + item_nm + "</td>";
				tag += "<td>" + standard1 + "</td>";
				tag += "<td>" + material + "</td>";
				tag += "<td>" + unit + "</td>";
				tag += "<td>" + cnt + "</td>";
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

function getWorkItem(){
	var work_cd = $("#work_cd").val();
	var work_uid = $("#uid").val();
	var warehouse = "<?=$warehouse?>";
	//$("#order_no").val(order_cd);
	var flag = $("#flag").val();
	var tag = "";

	$.getJSON("ajax/production.php",{"mode":"getWorkItem", "uid" : work_uid},
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

function formSubmit(){
	/*
	if(!check_str($("#work_cd").val(),"작업지시서 코드")) return false;
	if(!check_str($("#work_start_dt").val(),"작업시작일")) return false;
	if(!check_str($("#work_end_dt").val(),"작업종료일")) return false;
	*/
	var work_dt = $("#work_dt").val();
	var account_nm = $("#account_nm").val();
	var deadline_dt = $("#deadline_dt").val();
	//var warehouse_cd = $("#warehouse_cd option:selected").val();
	var item_nm = $("#item_nm_1").val();
	
	var order_cnt = $("input[name='order_cnt[]']").length;
	$('input[name="order_cnt[]"]').each(function() // $('input[name^="nm"]').each(function() 
	{ 
    //alert($(this).val()); 
	}); 
	
	
	if (typeof item_nm == "undefined") {
		alert("생산 품목을 하나이상 선택하세요");
		return false;
	}
	if (!item_nm) {
		alert("생산 품목을 입력 하세요");
		return false;
	}
	var item_nm = $("#order_cnt_1").val();
	if (!order_cnt) {
		alert("지시수량을 입력 하세요");
		$("#order_cnt_1").focus();
		return false;
	}

	/*
	 $.each($("input[name='item_nm[]']"),function(k,v) {
         arr[arr.length] = $(v).val();
     });

	 console.log(arr);
         
         for(var i=0; i<arr.length; i++){
            if(i!=0) {
               data+= "-";
            }
            data+= arr[i];
         }
         console.log("data:: "+data);
		 */

	if(work_dt == "") {
		alert("작업지시서 번호를 선택하세요");
		$("#work_dt").focus();
		return false;
	}
	if(account_nm == "") {
		alert("거래처를 선택하세요");
		$("#account_nm").focus();
		return false;
	}
	if(deadline_dt == "") {
		alert("납기일자를 선택하세요");
		$("#deadline_dt").focus();
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