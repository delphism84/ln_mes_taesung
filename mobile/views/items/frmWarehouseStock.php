<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">			
			<div>
				<div class="col-xs-12">
					<div><input type="button" class="comm_title" value="창고 리스트" /></div>
					<? $this->noCheckTable("tb","창고명"); ?>
				</div>
				<!--
				<div class="col-xs-12">
					<div style="padding-top:10px">
						<div style="float:left">
							<input type="button" class="btn btn-xs btn-pink" value="품목 리스트" />
						</div>
				-->
						<!--<div style="float:right"><input type="button" class="btn btn-xs btn-info" value="선택품목 창고이동" onclick="moveWarehouse()" /></div>-->
						<? //$this->noCheckTable("warehouse_tb","품목코드,품목명,규격,단위,재고수량,Lot No"); ?>
						<? //$this->paging() ?>
				<!--
					</div>
				</div>
				-->
			</div>
		</div>
	</div>
</div>

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<!-- 공정용 -->
<div class="modal fade" id="moveModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">창고이동</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:350px">
				<form id="moveFrm">
					<!-- 창고의 UID -->
					<input type="hidden" name="warehouse_uid" id="warehouse_uid" />
					<!-- Warehouse 의 uid -->
					<input type="hidden" name="warehouse" id="warehouse" />
					<input type="hidden" name="mode" id="mode" value="registItemMove" />

					<table class="table table-bordered">
						<tr>
							<? $this->th("품번") ?>
							<td><input type="text" name="item_cd" id="item_cd" readonly /></td>
						</tr>
						<tr>
							<? $this->th("품명") ?>
							<td><input type="text" name="item_nm" id="item_nm" readonly /></td>
						</tr>
						<tr>
							<? $this->th("규격") ?>
							<td><input type="text" name="standard" id="standard" readonly /></td>
						</tr>
						<tr>
							<? $this->th("현 창고 재고수량") ?>
							<td><input type="text" name="current_cnt" id="current_cnt" readonly /></td>
						</tr>
						<tr>
							<? $this->th("이동 할 창고") ?>
							<td><? $this->createDbSelectBox("warehouse","warehouse_nm","move_warehouse"); ?></td>
						</tr>
						<tr>
							<? $this->th("이동 할 수량") ?>
							<td><input type="text" class="onlynum comma" name="move_cnt" id="move_cnt" /></td>
						</tr>
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-info" onclick="registItemMove()">창고이동</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!--창고품목 MODAL-->
<div class="modal fade" id="viewWarehouseItemModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">품목 리스트</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="overflow-y: scroll; height:400px">
				<table class="table table-bordered" id="warehouse_tb2">
						<thead>
							<tr>
								<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>품목코드</th>
								<? $this->th("품목명") ?>
								<? $this->th("재고수량") ?>
								<? $this->th("Lot No") ?>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				<? $this->paging() ?>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function moveWarehouse() {
	if($("#warehouse_uid").val() == "") {
		showAlert("창고이동 할 품목을 선택하세요");
		bool = false;
		return false;
	}

	showModal("moveModal");
}

function registItemMove() {
	var current_cnt = uncomma($("#current_cnt").val());
	var move_cnt = uncomma($("#move_cnt").val());
	
	if($("#move_cnt").val() == "") {
		showAlert("이동할 수량을 입력하세요");
		return false;
	}

	if($("#move_warehouse option:selected").val() == "0") {
		showAlert("이동할 창고를 선택하세요");
		return false;
	}

	if(Number(move_cnt) > Number(current_cnt)) {
		showAlert("창고에 있는 재고보다 이동할 수량이 많을 수는 없습니다");
		return false;
	}

	var parameter = $("#moveFrm").serialize();
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			showAlert("해당 품목의 창고이동을 마쳤습니다");
			$("#item_cd").val("");
			$("#item_nm").val("");
			$("#standard").val("");
			$("#move_cnt").val("");
			$("#move_warehouse").val(0);
			hideModal("moveModal");
			getData(1);
		}
	});
}

// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

//콤마풀기
function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	

	var page = $("#page").val();
	getWarehouse();

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


//==================================================
// 창고 테이블 선택된 TR 색상 바꾸기
//==================================================
function toggle(it) {
	$("#tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}


function item_toggle(it) {
	//$("#warehouse_tb tr").css("background-color","");
	$("#warehouse_tb2 tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}
//==================================================
// 창고 리스트 가져오기
//==================================================
function getWarehouse(){
	var tag = "";
	var parameter = {"mode" : "getWarehouseList"};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr onclick=\"toggle(this); postWarehouse(" + json[i].uid + ");\" style='cursor:pointer'>";					
					tag += "<td>" + json[i].warehouse_nm + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='3' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function postWarehouse(uid) {
	$("#warehouse").val(uid);
	$("#where").val("where fid=" + uid);
	getData(1);
	showModal('viewWarehouseItemModal');
}

//==================================================
// 선택된 창고의 자재 리스트 가져오기
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getWarehouseItem", "page" : page, "rpp" : 10, "where" : $("#where").val(), "warehouse_cd" : $("#warehouse").val()};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr onclick=\"item_toggle(this); postWarehouseUid(" + json[i].uid + ", '" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].cnt + "');\" style='cursor:pointer'>";
					// tag += "<td>" + json[i].classify + "</td>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					//tag += "<td>" + json[i].standard + "</td>";
					//tag += "<td>" + json[i].unit + "</td>";
					tag += "<td style='text-align:right; vertical-align:middle'>" + comma(json[i].cnt) + "</td>";
					tag += "<td>" + json[i].lot_no + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='7' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			//$("#warehouse_tb tbody").html(tag);
			$("#warehouse_tb2 tbody").html(tag);

			var table = "warehouse_" + $("#warehouse").val();
			getPaging(table, $("#where").val(), 10, 4, "setPage");
		}
	);
	
}

function postWarehouseUid(uid, item_cd, item_nm, standard, current_cnt) {
	$("#warehouse_uid").val(uid);
	$("#item_cd").val(item_cd);
	$("#item_nm").val(item_nm);
	$("#standard").val(standard);
	$("#current_cnt").val(current_cnt);
}

//콤마찍기
function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

//콤마풀기
function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}
//==================================================
// 검색
//==================================================
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	$("#where").val(" where item_nm like '%" + txt + "%' or item_cd like '%" + txt + "%'");
	getData(1);
}
</script>