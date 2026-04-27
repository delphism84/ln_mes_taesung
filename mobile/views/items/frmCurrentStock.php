<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<!-- 검색 모달 -->
		<div class="wrap_search_pop">	
			<div class="search_pop_content">
				<div class="input-group" style="width:100%;">
					<div class="col-xs-12" style="width:100%;">
						<select name="set_classify" id="set_classify" onchange="setItem(this.value)" style=" float:left; height:35px; width:100%;">
							<option value="0">=검색구분=</option>
							<?
							$sql = "select * from item_classify";
							$this->query($sql);
							while($t = $this->fetch()){
								echo "<option value='".$t->uid."'>".$t->classify_nm."</option>";
							}
							?>
						</select>	
						<input type="text" name="search_txt" id="search_txt" class="search_input"/>								
						<!-- <select name="item_classify" id="item_classify" style="float:right; height:35px">
							<option value="0">=검색구분=</option>
							<option value="item_cd">품번</option>
							<option value="item_nm">품목명</option>
						</select>&nbsp; -->
																		
															
						<button type="button" class="search_btn" onclick="search()" style="height:35px">
							<span class="fa fa-search icon-on-right bigger-110"></span>
						</button>
						<button type="button" class="search_refresh" onclick="refresh()" style="height:35px">
							<span class="fa fa-refresh icon-on-right bigger-110"></span>
						</button>
								
					</div>							
				</div>		
			</div>	
		</div>
		<!-- //검색 모달 -->
		<div class="page-content">			
			<div>
				<div class="col-xs-12">		
					<div>
						<div style="float:left;">							
							<? //$this->createDbSelectBox("item_classify","classify_nm","set_classify","setItem"); ?>
						</div>						
						<input type="button" class="comm_title" value="품목 리스트" style="float:left" />						
						<? $this->noCheckTable("tb","구분=>2,품번=>2,품명=>3,규격=>2"); ?>
						<? $this->paging() ?>
					</div>
					<!--
					<div style="border-top:1px solid #ccc;padding-top:10px; padding-right:10px">
						<div><input  type="button" class="btn btn-xs btn-pink" value="창고별 재고현황" /></div>
						<? $this->noCheckTable("warehouse_tb","창고명=>1,품번=>2,품명=>3,규격=>1,단위=>1,재고수량=>1,Lot_No=>1,입고일=>1"); ?>
					</div>
					-->
				</div>
				<!--
				<div class="col-xs-12">
					<div>
						<div><input  type="button" class="btn btn-xs btn-pink" value="재고현황" /></div>
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
				</div>
				-->
			</div>			
		</div>
	</div>
</div>



<!--재고현황 MODAL-->
<div class="modal fade" id="viewItemModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">재고현황</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:70%; overflow:scroll; overflow-x:hidden">
				<div>
					<!--
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
					-->
					<div class="col-xs-12">
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
					</div>
				</div>
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

<input type="hidden" name="per" id="per" value="10" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
function refresh() {
	$("#page").val(1);
	$("#where").val("");
	$("#set_classify").val(0);
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
			if($("#cnt").val() > 0) {
				if($("#warehouse_cd option:selected").val() == 0) {
					showAlert("기초재고 수량을 입고시킬 창고를 선택하세요");
					return;
				}
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
					getData(1);
					formClear();
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
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("item");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#btnSubmitTxt").text("품목등록");
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
// 품목리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getItemList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postItem(" + json[i].uid + ",'" + json[i].item_cd + "', '" + json[i].standard + "');\" style='cursor:pointer'>";
					tag += "<td>" + json[i].classify_nm + "</td>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					//tag += "<td>" + json[i].unit + "</td>";
					//tag += "<td style='text-align:right'>" + json[i].delivery_period + "</td>";
					//tag += "<td style='text-align:right'>" + json[i].safety_stock_cnt + "</td>";
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
function postItem(uid, item_cd, standard) {
	var parameter = {"mode" : "getTotalStock", "item_cd" : item_cd, "standard" : standard};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#spWarehouse").html(comma(json.warehouse_cnt));
			$("#spProcess").html(comma(json.process_cnt));
			$("#spTotal").html(comma(json.total_cnt));
			showModal('viewItemModal');
		}
	});
	
	var tag = "";
	var parameter = {"mode" : "getWarehouseCurrentStock", "item_cd" : item_cd, "standard" : standard};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {
				tag += "<tr>";
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
// 품목코드 확인
//==================================================
function checkCode(modal_nm) {
	if($("#item_cd").val() == "") {
		showAlert("품목코드가 생성이 되어있지 않습니다.<br>품목코드 생성 후 진행하세요"); 
	} else {
		$("#p_item_cd").val($("#item_cd").val());
		showModal(modal_nm);
	}
}

//==================================================
// 규격 등록
//==================================================
function registStandard(modal_nm) {
	var parameter = {"mode" : "registStandard", "item_cd" : $("#p_item_cd").val(), "standard" : $("#p_standard").val()}
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "success") {
				$("#p_item_cd").val("");
				$("#p_standard").val("");
				hideModal(modal_nm);
			} else if(str == "dupp") {
				hideModal(modal_nm);
				showAlert("해당 품목코드 값을 가진 품목규격이 이미 존재합니다");
			}
		}
	});
}

//==================================================
// 규격 가져오기
//==================================================
function viewStandard(modal_nm) {
	var tag = "";
	var parameter = {"mode" : "getStandard", "item_cd" : $("#item_cd").val()};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json) {
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++) {
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postData('" + json[i].standard + "','" + modal_nm + "')\">" + json[i].standard + "</a></td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td style='text-align:center; font-weight:bold; color:red;'>데이터가 존재하지 않습니다</td></tr>";
			}

			$("#standard_tb tbody").html(tag);
			showModal(modal_nm);
		}
	);
}

//==================================================
// 선택한 규격 처리
//==================================================
function postData(standard, modal_nm) {
	$("#standard").val(standard);
	hideModal(modal_nm);
}

//==================================================
// 품목코드 생성
//==================================================
function createCode(classify) {
	var parameter = {"mode" : "createItemCode", "classify" : classify};

	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		success : function(str) {
			$("#item_cd").val(str);
			$("#barcode").val(str);
		}
	});
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

$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1);
	});
});
</script>