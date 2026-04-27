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
						<input type="text" name="search_txt" id="search_txt" class="search_input"/>										
						<button type="button" class="search_btn" onclick="search()">
							<span class="fa fa-search icon-on-right bigger-110"></span>
						</button>
						<button type="button" class="search_refresh" onclick="refresh()">
							<span class="fa fa-refresh icon-on-right bigger-110"></span>
						</button>
						<!--
						<button type="button" class="btn btn-danger btn-sm" style="height:35px" data-toggle="modal" data-target="#confirm-delete" >
							<span class="fa fa-trash icon-on-right bigger-110"></span>
						</button>
						<button type="button" class="btn btn-primary btn-sm" onclick="showModal('registModal')" style="height:35px">
							<span class="fa fa-plus icon-on-right bigger-110"></span>
						</button>
						-->			
					</div>							
				</div>		
			</div>	
		</div>
		<!-- //검색 모달 -->
		<div class="page-content">			
			<div>
				<div class="col-xs-12">
					<div class="regist_div">
						
						<?
						if($_SESSION['login_level'] >= 99){
							//$this->table("tb","공정,설비,품번,품명,규격,단위,생산수량,불량수량,불량사유,입고창고,등록일");
						} else {
							//$this->noCheckTable("tb","공정,설비,품번,품명,규격,단위,생산수량,불량수량,불량사유,입고창고,등록일");
						}
						?>
						<div>
							<input type="button" class="comm_title" value="생산실적리스트"/>
						</div>						
					</div>
					<table class="table table-bordered table-striped" id="tb">
						<thead>
							<tr>
								<th class="detail-col center">
									공정
								</th>
								<th class="detail-col center">
									품명
								</th>
								<th class="detail-col center">
									생산수량
								</th>
								<th class="detail-col center">
									불량수량
								</th>								
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>

					<?
					$this->paging();
					?>
				</div>				
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="per" id="per" value="10" />


<div class="modal fade" id="registModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:1400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">생산실적 등록</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:290px">
				<form id="frm">
					<input type="hidden" name="mode" id="mode" value="registProductResult" />
					<input type="hidden" name="uid" id="uid" />
					<input type="hidden" name="old_img" id="old_img" />
					<table class="table table-bordered">
						<tr>
							<? $this->th("생산공정") ?>
							<td>
								<select name="process" id="process" onchange="getMachine(this.value)">
									<option value="0">== 선택 ==</option>
								</select>
							</td>
							<? $this->th("생산설비(팀)") ?>
							<td>
								<select name="machine" id="machine">
									<option value="0">== 선택 ==</option>
								</select>
							</td>
						</tr>
						<tr>
							<? $this->th("품번") ?>
							<td><input type="text" class="form-control" name="item_cd" id="item_cd" validation="yes" err="품번을 입력하세요" onclick="showModal('itemModal')" /></td>
							<? $this->th("품목명") ?>
							<td><input type="text" class="form-control" name="item_nm" id="item_nm" validation="yes" err="품목명을 입력하세요" onclick="showModal('itemModal')" /></td>
						</tr>
						<tr>
							<? $this->th("규격") ?>
							<td><input type="text" name="standard" id="standard" /></td>
							<? $this->th("단위") ?>
							<td><input type="text" name="unit" id="unit" /></td>
						</tr>
						<tr>
							<? $this->th("생산수량") ?>
							<td><input type="text" class="comma onlynum" name="cnt" id="cnt" /></td>						
							<? $this->th("불량수량") ?>
							<td><input type="text" name="faulty_cnt" id="faulty_cnt" /></td>
						</tr>
						<tr>
							<? $this->th("불량사유") ?>
							<td>
								<select name="faulty_type" id="faulty_type">
									<option value="0">== 선택 ==</option>
								</select>
							</td>
							<? $this->th("입고창고") ?>
							<td>
								<select name="warehouse" id="warehouse">
									<option value="0">== 선택 ==</option>
								</select>
							</td>
						</tr>
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-info" id="btnSubmit">저장</button>
					<button type="button" class="btn btn-sm btn-success" onclick="formClear()">새로고침</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 상세보기 -->
<div class="modal fade" id="viewProductResultModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">상세보기</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style='height:70%'>
			<!-- 내용 -->
				<form id="frm">
					<input type="hidden" name="uid" id="uid"/>
					<table class="table table-bordered">
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; width:25%"><i class="ace-icon fa fa-caret-right blue"></i>공정</th>
							<td><span id="p_process_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>설비</th>
							<td><span id="p_machine_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>품번</th>
							<td><span id="p_item_cd"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>품명</th>
							<td><span id="p_item_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>규격</th>
							<td><span id="p_standard"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>단위</th>
							<td><span id="p_unit"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>생산수량</th>
							<td><span id="p_cnt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>불량수량</th>
							<td><span id="p_faulty_cnt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>불량사유</th>
							<td><span id="p_faulty_type"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>입고창고</th>
							<td><span id="p_warehouse"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>등록일</th>
							<td><span id="p_create_dt"></span></td>
						</tr>
					</table>

				</form>
			<!-- 내용 -->
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

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
require_once ("views/modal/itemModal.php");
?>

<script>
//콤마찍기
function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

function refresh() {
	$("#set_classify").val(0);
	$("#classify").val(0);
	$("#item_classify").val(0);
	$("#search_txt").val("");
	$("#where").val("");
	$("#page").val(1);
	getData(1);
}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );


	var page = $("#page").val();
	getItemList(1);
	getProcess();
	getFaultyType();
	getWarehouse();
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

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			if($("#cnt").val() > 0) {
				if($("#warehouse option:selected").val() == 0) {
					showAlert("입고시킬 창고를 선택하세요");
					return;
				}
			}

			if($("#faulty_cnt").val() > 0) {
				if($("#faulty_type option:selected").val() == 0) {
					showAlert("불량사유를 선택하세요");
					return;
				}
			}

			event.preventDefault();
			var form = $('#frm')[0];
			var data = new FormData(form);
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
					hideModal('registModal');
					$("#btnSubmit").prop("disabled", false);

				},
				error: function (e) {
					$("#btnSubmit").prop("disabled", false);

				}
			});
		}
	});
});

// 공정가져오기
function getProcess(){
	var tag = "";
	var parameter = {"mode" : "getProcess"};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json){
		if(json != null){
			for(var i = 0 ; i < json.length ; i++){
				tag += "<option value='" + json[i].uid + "'>" + json[i].process_nm + "</option>";
			}

			$("#process").append(tag);
		}
	});
}

// 설비가져오기
function getMachine(process){
	var tag = "";
	var parameter = {"mode" : "getMachine", "process" : process};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json){
		if(json != null){
			for(var i = 0 ; i < json.length ; i++){
				tag += "<option value='" + json[i].uid + "'>" + json[i].machine_nm + "</option>";
			}

			$("#machine").append(tag);
		}
	});	
}

// 불량사유 가져오기
function getFaultyType(){
	var tag = "";
	var parameter = {"mode" : "getFaultyTypeList"};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json){
		if(json != null){
			for(var i = 0 ; i < json.length ; i++){
				tag += "<option value='" + json[i].uid + "'>" + json[i].faulty_type + "</option>";
			}

			$("#faulty_type").append(tag);
		}
	});
}

// 창고리스트 가져오기
function getWarehouse(){
	var tag = "";
	var parameter = {"mode" : "getWarehouseList"};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json){
		if(json != null){
			for(var i = 0 ; i < json.length ; i++){
				tag += "<option value='" + json[i].uid + "'>" + json[i].warehouse_nm + "</option>";
			}

			$("#warehouse").append(tag);
		}
	});
}

//==================================================
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("work_data");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#cnt").attr("readonly", false);
	$("#item_cd").attr("readonly", false); 
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
	var parameter = {"mode" : "getProductResultList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick='toggle(this); postData(" + json[i].uid + ");' style='cursor:pointer'>";
					/*
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					*/
					tag += "<td>" + json[i].process_nm + "</td>";
					//tag += "<td>" + json[i].machine_nm + "</td>";
					//tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					//tag += "<td>" + json[i].standard + "</td>";
					//tag += "<td>" + json[i].unit + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].cnt) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].faulty_cnt) + "</td>";
					//tag += "<td>" + json[i].faulty_type + "</td>";
					//tag += "<td>" + json[i].warehouse + "</td>";
					//tag += "<td>" + json[i].create_dt + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='12' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "work_data";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

function postData(uid) {
	$("#uid").val(uid);
	var parameter = {"mode" : "getProductResult", "uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#p_process_nm").html(json.process_nm);
			$("#p_machine_nm").html(json.machine_nm);
			$("#p_item_cd").html(json.item_cd);
			$("#p_item_nm").html(json.item_nm);
			$("#p_standard").html(json.standard);
			$("#p_unit").html(json.unit);
			$("#p_cnt").html(comma(json.cnt));
			$("#p_faulty_cnt").html(comma(json.faulty_cnt));
			$("#p_faulty_type").html(json.faulty_type);
			$("#p_warehouse").html(json.warehouse);
			$("#p_create_dt").html(json.create_dt);
		}
	});
	showModal('viewProductResultModal');
	//$("#btnSubmitTxt").text("품목수정");
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
// 선택한 품목 처리
//==================================================
function postItem(uid) {
	var parameter = {"mode" : "getItem", "item_uid" : uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json){
		$("#item_cd").val(json.item_cd);
		$("#item_nm").val(json.item_nm);
		$("#standard").val(json.standard);
		$("#unit").val(json.unit);
		hideModal('itemModal');
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
		
		//if(set_classify == 0) $("#where").val("where item_cd like '@" + txt + "@' or item_nm like '@" + txt + "@'");		
		//else $("#where").val("where classify=" + set_classify + " and (item_cd like '@" + txt + "@' or item_nm like '@" + txt + "@')");
		$("#where").val("where item_cd like '@" + txt + "@' or item_nm like '@" + txt + "@'");		
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

//검색
$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1);
	});
});
</script>