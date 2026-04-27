<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-12">		
						<div>
							
							<div>
								<div class="input-group" style="width:100%;">
									<select name="set_classify" id="set_classify" onchange="setItem(this.value)" style="float:left; width:100%; height:35px">
										<option value="0">=검색구분=</option>
										<?
										$sql = "select * from item_classify";
										$this->query($sql);
										while($t = $this->fetch()){
											echo "<option value='".$t->uid."'>".$t->classify_nm."</option>";
										}
										?>
									</select>										
								</div>
								<div class="input-group" style="margin-top:10px; margin-bottom:10px;">
									<input type="text" class=" search-query" name="search_txt" id="search_txt" style="float:left; height:35px; width:100%;"/>
									<!-- <select name="search_classify" id="search_classify" style="float:right; height:35px; margin-right:3px">
										<option value="0">=검색구분=</option>
										<option value="item_cd">품번</option>
										<option value="item_nm">품목명</option>
									</select>&nbsp;									 -->
									
									<span class="input-group-btn">										
										<button type="button" class="btn btn-purple btn-sm" onclick="search()" style="height:35px">
											<span class="fa fa-search icon-on-right bigger-110"></span>
										</button>
										<button type="button" class="btn btn-success btn-sm" onclick="refresh()" style="height:35px">
											<span class="fa fa-refresh icon-on-right bigger-110"></span>
										</button>
									</span>
								</div>
							</div>
							<div style="float:left">
								<input type="button" class="btn btn-xs btn-pink" value="품목 리스트" style="height:35px" />				
							</div>
							<? 
							$this->noCheckTable("tb","구분=>1,품번=>2,품명=>3,규격=>2,단위=>1,조달기간=>1,안전재고수량=>2");
							$this->paging();
							?>
						</div>
						<!--
						<div style="border-top:1px solid #ccc;height:250px; overflow: scroll; overflow-x: hidden; padding-top:10px; padding-right:10px">
							<div><input type="button" class="btn btn-xs btn-pink" value="보관위치" /></div>
							<? $this->noCheckTable("warehouse_tb","창고명=>1,품번=>2,품명=>3,규격=>1,단위=>1,재고수량=>1,Lot_No=>1,입고일=>1"); ?>
						</div>
						-->
					</div>
					<div class="col-xs-12">
						<div><input type="button" class="btn btn-xs btn-pink" value="재고현황" /></div>
						<div>
							<table class="table table-bordered">
								<tr>
									<? $this->th("창고재고") ?>
									<td class="col-xs-9"><span id="spWarehouse" style="color:blue;"></td>
								</tr>
								<tr>
									<? $this->th("재공재고") ?>
									<td><span id="spProcess" style="color:blue;"></td>
								</tr>
								<tr>
									<? $this->th("총재고") ?>
									<td><span id="spTotal" style="color:red; font-weight:bold"></td>
								</tr>
							</table>					
						</div>
						<!--
						<div><input type="button" class="btn btn-xs btn-pink" value="재고조정" /></div>
						<div>
							<form name="frm" id="frm">
								<input type="hidden" name="uid" id="uid" />
								<input type="hidden" name="fid" id="fid" />
								<input type="hidden" name="mode" id="mode" value="inventoryAdjustment" />
								<table class="table table-bordered">
									<tr>
										<? $this->th("위치") ?>
										<td class="col-xs-9"><span id="warehouse"></td>
									</tr>
									<tr>
										<? $this->th("품번") ?>
										<td><span id="item_cd"></td>
									</tr>
									<tr>
										<? $this->th("품명") ?>
										<td><span id="item_nm"></td>
									</tr>
									<tr>
										<? $this->th("규격") ?>
										<td><span id="standard"></td>
									</tr>
									<tr>
										<? $this->th("단위") ?>
										<td><span id="unit"></td>
									</tr>
									<tr>
										<? $this->th("Lot No") ?>
										<td><span id="lot_no"></td>
									</tr>
									<tr>
										<? $this->th("현재고수량") ?>
										<td><span id="current_stock"></td>
									</tr>
									<tr>
										<? $this->th("조정재고수량") ?>
										<td><input type="text" class="onlynum comma" name="cnt" id="cnt" validation="yes" err="조정재고수량을 입력하세요" /></td>
									</tr>
								</table>
							</form>
						</div>
						<div style="text-align:center">
							<button class="btn btn-info" type="button" id="btnSubmit">
								<i class="ace-icon fa fa-check bigger-110"></i>
								<span id="btnSubmitTxt">재고 조정</span>
							</button>
							<button class="btn btn-default" type="button" onclick="formClear()">
								<i class="ace-icon fa fa-check bigger-110"></i>
								새로고침
							</button>
						</div>
					</div>
					-->
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="9" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
var select_uid = 0;
var select_item_cd = "";
var select_standard = "";

function refresh() {
	$("#uid").val("");
	$("#fid").val("");
	$("#set_classify").val(0);
	$("#page").val(1);
	$("#where").val("");
	$("#search_classify").val(0);
	$("#search_txt").val("");
	getData(1);
}


// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );


	var page = $("#page").val();
	getData(page);

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

	$("#item_classify").on('change', function() {
		if($("#item_classify option:selected").val() == 0) {
			$("#search_txt").val("");
			$("#where").val("");
			getData(1);
		}
	});

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			if($("#uid").val() == ""){
				showAlert("보관위치를 선택하세요");
				return false;
			}

			if($("#fid").val() == "") {
				showAlert("품목을 선택하세요");
				return false;
			}
			event.preventDefault();
			var form = $('#frm')[0];
			var data = new FormData(form);
			data.append("CustomField", "This is some extra data, testing");
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "ajax.php",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
				//	getData(1);
					formClear();
					postItem(select_uid, select_item_cd, select_standard);
					$("#btnSubmit").prop("disabled", false);

				},
				error: function (e) {
					$("#btnSubmit").prop("disabled", false);

				}
			});
		}
	});

});


//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#uid").val("");
}

//==================================================
// 선택된 품목 테이블 선택된 TR 색상 바꾸기
//==================================================
function toggle(it) {
	$("#tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

//==================================================
// 선택된 품목 테이블 선택된 TR 색상 바꾸기
//==================================================
function wtoggle(it) {
	$("#warehouse_tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

//==================================================
// 품목리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getItemList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postData(" + json[i].uid + ",'" + json[i].item_cd + "', '" + json[i].standard + "');\" style='cursor:pointer'>";
					tag += "<td>" + json[i].classify_nm + "</td>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					tag += "<td style='text-align:right'>" + json[i].delivery_period + "</td>";
					tag += "<td style='text-align:right'>" + json[i].safety_stock_cnt + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "item";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}



//==================================================
// 선택한 품목 처리
//==================================================
function postData(uid, item_cd, standard) {
	alert(uid);
	alert(item_cd);
	alert(standard);

	select_uid = uid;
	select_item_cd = item_cd;
	select_standard = standard;

	var parameter = {"mode" : "getTotalStock", "item_cd" : item_cd, "standard" : standard};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#spWarehouse").html(json.warehouse_cnt);
			$("#spProcess").html(json.process_cnt);
			$("#spTotal").html(json.total_cnt);
		}
	});
	
	var tag = "";
	var parameter = {"mode" : "getWarehouseCurrentStock", "item_cd" : item_cd, "standard" : standard};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {
				tag += "<tr onclick=\"wtoggle(this); postWarehouseItem(" + json[i].ruid + ", " + json[i].fid + ", '" + json[i].warehouse + "', '" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].unit + "', '" + json[i].lot_no + "', '" + json[i].cnt + "');\" style='cursor:pointer'>";
				tag += "<td>" + json[i].warehouse + "</td>";
				tag += "<td>" + json[i].item_cd + "</td>";
				tag += "<td>" + json[i].item_nm + "</td>";
				tag += "<td>" + json[i].standard + "</td>";
				tag += "<td>" + json[i].unit + "</td>";
				tag += "<td style='text-align:right'>" + json[i].cnt + "</td>";
				tag += "<td>" + json[i].lot_no + "</td>";
				tag += "<td>" + json[i].create_dt + "</td>";
				tag += "</tr>";
			}
		} else {
			tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}
		$("#warehouse_tb tbody").html(tag);
	});
}

function postWarehouseItem(uid, fid, warehouse, item_cd, item_nm, standard, unit, lot_no, cnt) {
	$("#uid").val(uid);
	$("#fid").val(fid);
	$("#warehouse").html(warehouse);
	$("#item_cd").html(item_cd);
	$("#item_nm").html(item_nm);
	$("#standard").html(standard);
	$("#unit").html(unit);
	$("#lot_no").html(lot_no);
	$("#current_stock").html(cnt);
}


//==================================================
// 검색
//==================================================
function search(){
	var type = 1;
	var set_classify = $("#set_classify option:selected").val();
	if(type == 1){
		var txt = $("#search_txt").val();
		if(txt == "") {
			showAlert("검색어를 입력하세요");
			return;
		}
		
		if(set_classify == 0) $("#where").val("where item_cd like '@" + txt + "@' or item_nm like '@" + txt + "@'");		
		else $("#where").val("where classify=" + set_classify + " and item_cd like '@" + txt + "@' or item_nm like '@" + txt + "@'");		
	} else {
		var classify = $("#item_classify option:selected").val();
		var txt = $("#search_txt").val();

		if(classify == 0) {
			showAlert("검색구분을 선택하세요");
			return;
		}
		
		if(txt == "") {
			showAlert("검색어를 입력하세요");
			return;
		}

		$("#where").val("where " + classify + " like '@" + txt + "@'");
	}
	$("#page").val(1);
	getData(1);
}

//==================================================
// 품목구분 품목 리스트 가져오기
//==================================================
function setItem(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("");
	else $("#where").val(" where classify=" + val);
	getData(1);
}
</script>