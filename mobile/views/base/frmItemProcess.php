<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div style="height:800px; border:1px solid #ccc">
						<div class="col-xs-5" style="height:800px; padding-top:10px; border-right:1px solid #ccc">
							<div style="float:left">
								<input type="button" class="btn btn-xs btn-pink" value="품목 리스트" style="height:35px" />
							</div>
							<div>
								<div class="input-group">																		
									<input type="text" class=" search-query" name="search_txt" id="search_txt" style="float:right; height:35px"/>
									<?=$this->createDbSelectBox("item_classify","classify_nm","set_classify","setItem","","","float:right");?>
									<!-- <select name="item_classify" id="item_classify" style="float:right; height:35px">
										<option value="0">=검색구분=</option>
										<option value="item_cd">품번</option>
										<option value="item_nm">품목명</option>
									</select>&nbsp;-->
									<span class="input-group-btn">										
										<button type="button" class="btn btn-purple btn-sm" onclick="search()" style="height:35px">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
										</button>
										<button type="button" class="btn btn-success btn-sm" onclick="refresh()" style="height:35px">
											<span class="fa fa-refresh icon-on-right bigger-110"></span>
										</button>
									</span>
									
								</div>
							</div>							
							<div><? $this->noCheckTable("tb","품번=>2,품목명=>3,규격=>2,반제품구분=>2"); ?></div>
							<? $this->paging() ?>
						</div>
						<div class="col-xs-7" style="height:800px; padding-top:10px">
							<div style="height:40%; overflow: scroll; overflow-x: hidden;">
								<div>
									<input type="button" class="btn btn-xs btn-success" value="공정추가" onclick="addProcess()" /> 
									<input type="button" class="btn btn-xs btn-inverse" value="저장" onclick='registProcess()' />
									<span class="helper">공정은 반드시 품목을 선택하신 후에 저장하세요</span>
								</div>
								<form id='process_frm'>
									<input type="hidden" name="mode" id="mode" value="registItemProcess" />
									<input type="hidden" name="item_uid" id="item_uid" />
									<?
									$this->table("process_tb","공정NO=>1,공정명=>2,생산품번=>3,생산품명=>2,외주구분=>2,후공정=>1");

									$this->paging();
									?>
								</form>
							</div>
							<div style="border-top:1px solid #ccc; height:60%; overflow: scroll; overflow-x: hidden; padding-top:10px">
								<div>
									<input type="button" class="btn btn-xs btn-success" value="투입자재추가" onclick='openWinBomItem()'> 
									<!--<input type="button" class="btn btn-xs btn-pink" value="BOM참조">-->
									<input type="button" class="btn btn-xs btn-inverse" value="저장" onclick="registInItem()">
									<span class="helper">공정별 투입자재는 반드시 공정을 저장한 후에 공정을 선택하여 투입자재를 입력하세요</span>
								</div>
								<form id='in_item_frm'>
									<input type="hidden" name="mode" id="mode" value="registInItem" />
									<input type="hidden" name="process_uid" id="process_uid" />
									<? 

										$this->table("in_item_tb","품번=>2,품명=>2,규격=>1,단위,투입량,공정NO,품목구분");

									$this->paging();
									?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="flag" id="flag" />
<input type="hidden" name="process_flag" id="process_flag" value="1" />
<input type="hidden" name="process_item_flag" id="process_item_flag" value="1" />
<input type="hidden" name="process_modal_page" id="process_modal_page" value="1" />
<input type="hidden" name="bom_modal_page" id="bom_modal_page" value="1" />
<input type="hidden" name="process_where" id="process_where" />
<input type="hidden" name="bom_where" id="bom_where" />
<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<!-- 공정용 -->
<div class="modal fade" id="processItemModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:800px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">생산품명</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:490px">
				<div>
					<div class="col-xs-3"><?=$this->createDbSelectBox("item_classify","classify_nm","process_set_classify","setProcessItem");?></div>
					<div class="col-xs-9">
						<div class="input-group">
							<input type="text" class=" search-query" name="process_search_txt" id="process_search_txt" style="float:right; height:35px"/>
							<!-- <select name="process_item_classify" id="process_item_classify" style="float:right; height:35px">
								<option value="0">=검색구분=</option>
								<option value="item_cd">품번</option>
								<option value="item_nm">품목명</option>
							</select>&nbsp;									 -->
							<span class="input-group-btn">										
								<button type="button" class="btn btn-purple btn-sm" onclick="searchProcess()" style="height:35px">
									<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
								</button>
								<button type="button" class="btn btn-success btn-sm" onclick="process_refresh()" style="height:35px">
									<span class="fa fa-refresh icon-on-right bigger-110"></span>
								</button>
							</span>
						</div>
					</div>
				</div>
				<div style="clear:both"></div>
				<div style="margin-top:5px">
					<?=$this->noCheckTable("process_item","품번,품목명,품목규격,구분", "margin-top:5px")?>
				</div>
				<div class="col-xs-12 center"><span id="process_modal_paging_area"></span></div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- BOM용 -->
<div class="modal fade" id="bomItemModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:800px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">투입자재</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:550px">
				<table class="table table-bordered">
					<tr>
						<? $this->th("생산품명") ?>
						<td class="col-xs-8"><span id="product_item_nm" style="font-weight:bold"></span></td>
					</tr>
				</table>
				<div>
					<div class="col-xs-3"><?=$this->createDbSelectBox("item_classify","classify_nm","bom_set_classify","setBomItem");?></div>
					<div class="col-xs-9">
						<div class="input-group">
							<input type="text" class=" search-query" name="bom_search_txt" id="bom_search_txt" style="float:right; height:35px"/>
							<!-- <select name="bom_item_classify" id="bom_item_classify" style="float:right; height:35px">
								<option value="0">=검색구분=</option>
								<option value="item_cd">품번</option>
								<option value="item_nm">품목명</option>
							</select>&nbsp;									 -->
							<span class="input-group-btn">										
								<button type="button" class="btn btn-purple btn-sm" onclick="searchBom()" style="height:35px">
									<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
								</button>
								<button type="button" class="btn btn-success btn-sm" onclick="bom_refresh()" style="height:35px">
									<span class="fa fa-refresh icon-on-right bigger-110"></span>
								</button>
							</span>
						</div>
					</div>
				</div>
				<div style="clear:both"></div>
				<div style="margin-top:5px"><?=$this->noCheckTable("bom_item","품번,품목명,품목규격,구분")?></div>
				<div class="col-xs-12 center"><span id="bom_modal_paging_area"></span></div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
//====================================================================================================================================================================
// 기본 스크립트 영역
//====================================================================================================================================================================
// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

function refresh() {
	$("#set_classify").val(0);
	$("#item_classify").val(0);
	$("#search_txt").val("");
	$("#page").val(1);
	$("#where").val("");
	getData(1);
}

function process_refresh(){
	$("#process_set_classify").val(0);
	$("#process_item_classify").val(0);
	$("#process_search_txt").val("");
	$("#process_modal_page").val(1);
	$("#process_where").val("");
	getProcessItemData(1);
}

function bom_refresh(){
	$("#bom_set_classify").val(0);
	$("#bom_item_classify").val(0);
	$("#bom_search_txt").val("");
	$("#bom_modal_page").val(1);
	$("#bom_where").val("");
	getBomItemData(1);
}

$(document).ready(function(){
	var page = $("#page").val();
	getData(page);
	getProcessItemData(page);
	getBomItemData(page);

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
});


// TR 삭제
function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#flag").val(nextFlag);
}

//====================================================================================================================================================================
// 품목 리스트 영역
//====================================================================================================================================================================

// 상품테이블 선택 아이템 TR 색상 바꾸기
function toggle(it) {
	$("#tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

// 품목리스트
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getItemList", "page" : page, "rpp" : 18, "where" : $("#where").val()};

	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr onclick='toggle(this); postItemUid(" + json[i].uid + ")' style='cursor:pointer'>";
					tag += "<td style='vertical-align:middle'>" + json[i].item_cd + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].item_nm + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].standard + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].classify_nm + "</td>";
					tag += "</tr>";
				}
			}

			//tag += "<tr><td colspan='8'></td></tr>";
			
			$("#tb tbody").html(tag);

			var table = "item";
			getPaging(table, $("#where").val(), 18, 2, "setPage");
		}
	);
}


// 선택한 품목 처리
function postItemUid(uid) {
	$("#item_uid").val(uid);
	$("#process_uid").val("");
	$("#process_flag").val("1");
	$("#process_item_flag").val("1");

	getProcess();
	
	var tag = "<tr><td colspan='8'></td></tr>";
	$("#in_item_tb tbody").html(tag);
}

// 품목검색
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

// 품목구분 품목 리스트 가져오기
function setItem(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("");
	else $("#where").val(" where classify=" + val);
	getData(1);
}

//====================================================================================================================================================================
// 공정 영역
//====================================================================================================================================================================

// 공정테이블 선택 공정 TR 색상 바꾸기
function processToggle(it) {
	$("#process_tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}


// 공정리스트
function getProcess() {
	var flag = $("#process_flag").val();
	var tag = "";
	var item_uid = $("#item_uid").val();
	var parameter = {"mode" : "getItemProcessList", "item_uid" : item_uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {
				tag += "<tr onclick=\"processToggle(this); postProcessUid(" + json[i].uid + ", '" + json[i].item_nm + "')\" style='cursor:pointer'>";
				tag += "<td class='center'><input type='hidden' name='uid[]' value='" + json[i].uid + "' /><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
				tag += "<td><input type='text' name='no[]' id='no' value='" + json[i].no + "' style='width:50px' /></td>";
				tag += "<td><select class='process' name='process[]' id='process_" + flag + "'>" + json[i].process + "</select></td>";
				tag += "<td><input type='text' name='process_item_cd[]' id='process_item_cd_" + flag + "' onclick='openWinProcessItem(" + flag + ")' value='" + json[i].item_cd + "' readonly /></td>";
				tag += "<td><input class='process_item_uid' type='hidden' name='process_item_uid[]' id='process_item_uid_" + flag + "' value='" + json[i].item_uid + "' /><input type='text' name='process_item_nm[]' id='process_item_nm_" + flag + "' onclick='openWinProcessItem(" + flag + ")' value='" + json[i].item_nm + "' readonly /></td>";
				
				if(json[i].outsourcing == "생산") {
					var out1 = "selected";
					var out2 = "";
				} else if(json[i].outsourcing == "외주") {
					var out1 = "";
					var out2 = "selected";
				}

				tag += "<td><select name='outsourcing[]' id='outsourcing_" + flag + "'><option value='생산' " + out1 + ">생산</option><option value='외주' " + out2 + ">외주</option></selected></td>";

				tag += "<td><select class='after_process' name='after_process[]' id='after_process_" + flag + "'>" + json[i].after_process + "</select>";
				tag += "</tr>";

				
				flag = Number(flag) + 1;
				$("#process_flag").val(flag);
			}
		} else {
			//tag = "<tr><td colspan='7' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#process_tb tbody").html(tag);
	});
}

// 공정추가
function addProcess() {
	if($("#item_uid").val() == "") {
		showAlert("품목을 선택하세요");
		return;
	}

	var flag = $("#process_flag").val();
	var tag = "";
	var parameter = {"mode" : "getItemProcess", "flag" : flag};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			tag += "<tr onclick='processToggle(this)'>";
			tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
			tag += "<td><input type='text' name='no[]' id='no' value='" + flag + "' style='width:50px' /></td>";
			tag += "<td><select name='process[]' id='process_" + flag + "'>" + json.process + "</select></td>";
			tag += "<td><input type='text' name='process_item_cd[]' id='process_item_cd_" + flag + "' onclick='openWinProcessItem(" + flag + ")'  readonly /></td>";
			tag += "<td><input class='process_item_uid' type='hidden' name='process_item_uid[]' id='process_item_uid_" + flag + "' /><input type='text' name='process_item_nm[]' id='process_item_nm_" + flag + "' onclick='openWinProcessItem(" + flag + ")' readonly /></td>";
			tag += "<td><select name='outsourcing[]' id='outsourcing_" + flag + "'><option value='생산'>생산</option><option value='외주'>외주</option></selected></td>";
			tag += "<td><select name='after_process[]' id='after_process_" + flag + "'>" + json.process + "</select>";
			tag += "</tr>";
		}
		
		$("#process_tb tbody").append(tag);
		$("#process_flag").val(Number(flag) + 1);
	});
}

// 공정등록
function registProcess() {
	if($("#item_uid").val() == "") {
		showAlert("품목을 먼저 선택하세요");
	} else {
		var bool = true;
		
		if($("#process_flag").val() == "1") {
			showAlert("공정을 추가하세요");
			return false;
		}

		$.each($(".process_item_uid") , function () {
			if($(this).val() == "") {
				showAlert("하위품목을 선택하세요");
				bool = false;
				return false;
			}
		});

		$.each($(".process_cnt") , function () {
			if($(this).val() == "") {
				alert("필요수량을 입력하세요");
				bool = false;
				return false;
			}
		});
		if(bool) {
			var parameter = $("#process_frm").serialize();
			$.ajax({
				type : "post",
				data : parameter,
				url : "ajax.php",
				success : function() {
					showAlert("공정을 저장했습니다");
					getProcess();
					$("#process_uid").val("");
				}
			});
		}
	}
}

// 선택한 공정 처리
function postProcessUid(uid, item_nm){
	$("#product_item_nm").html(item_nm);
	$("#process_uid").val(uid);
	$("#process_item_flag").val("1");
	getInItem();
}
//====================================================================================================================================================================
// 투입자재 영역
//====================================================================================================================================================================

// BOM리스트
function openWinBomItem() {
	if($("#process_uid").val() == "") {
		showAlert("공정을 선택한 후에 진행하세요");
		return;
	}

	showModal('bomItemModal');
}

// 투입자재 리스트 가져오기
function getInItem() {
	var tag = "";
	var parameter = {"mode" : "getInItem", "process" : $("#process_uid").val()};

	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td class='center'><input type='hidden' name='uid[]' value='" + json[i].uid + "' /><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
					tag += "<td><input type='text' class='item_cd' name='item_cd[]' value='" + json[i].item_cd + "' /></td>";
					tag += "<td><input type='text' name='item_nm[]' value='" + json[i].item_nm + "' /></td>";
					tag += "<td><input type='text' class='standard' name='standard[]' value='" + json[i].standard + "' style='width:100px' /></td>";
					tag += "<td><input type='text' name='unit[]' value='" + json[i].unit + "' style='width:50px' /></td>";
					tag += "<td><input type='text' class='cnt' name='cnt[]' style='width:50px' value='" + json[i].cnt + "' /></td>";
					tag += "<td><input type='text' name='process_no[]' value='" + json[i].fid + "' style='width:50px' /></td>";
					tag += "<td><input type='hidden' name='classify[]' value='" + json[i].classify + "' /><input type='text' name='classify_nm[]' value='" + json[i].classify_nm + "' value='width:50px'/></td>";
					tag += "</tr>";
					
					$("#process_item_flag").val(Number($("#process_item_flag").val()) + 1);
					
				}
			} else {
				tag = "<tr><td colspan='8' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}

			//tag += "<tr><td colspan='8'></td></tr>";
			
			$("#in_item_tb tbody").html(tag);
		}
	);
}

// 투입자재 등록
function registInItem() {
	if($("#process_item_flag").val() == 1) {
		showAlert("투입자재를 추가하세요");
		return;
	} else {
		var bool = true;

		$.each($(".cnt") , function () {
			if($(this).val() == "") {
				showAlert("투입수량을 입력하세요");
				bool = false;
				return false;
			}
		});
		if(bool) {
			var parameter = $("#in_item_frm").serialize();
			$.ajax({
				type : "post",
				data : parameter,
				url : "ajax.php",
				success : function() {
					showAlert("투입자재를 저장했습니다");
					getInItem();
				}
			});
		}
	}
}
//====================================================================================================================================================================
// 공정 모달 영역
//====================================================================================================================================================================

// 공정용 품목 리스트 모달 열기
function openWinProcessItem(flag) {
	$("#flag").val(flag);
	showModal('processItemModal');
}

// 공정용 품목 모달 
function getProcessItemData(page){
	var flag = $("#flag").val();
	var tag = "";
	var parameter = {"mode" : "getItemList", "page" : page, "rpp" : 10, "where" : $("#process_where").val()};

	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr >";
					tag += "<td style='vertical-align:middle'><a href='#' onclick=\"postProcessItem(" + json[i].uid + ", '" + json[i].item_cd + "', '" + json[i].item_nm + "')\">" + json[i].item_cd + "</a></td>";
					tag += "<td style='vertical-align:middle'><a href='#' onclick=\"postProcessItem(" + json[i].uid + ", '" + json[i].item_cd + "', '" + json[i].item_nm + "')\">" + json[i].item_nm + "</a></td>";
					tag += "<td style='vertical-align:middle'><a href='#' onclick=\"postProcessItem(" + json[i].uid + ", '" + json[i].item_cd + "', '" + json[i].item_nm + "')\">" + json[i].standard + "</a></td>";
					tag += "<td style='vertical-align:middle'><a href='#' onclick=\"postProcessItem(" + json[i].uid + ", '" + json[i].item_cd + "', '" + json[i].item_nm + "')\">" + json[i].classify_nm + "</a></td>";
					tag += "</tr>";
				}
			}

			//tag += "<tr><td colspan='8'></td></tr>";
			
			$("#process_item tbody").html(tag);

			var table = "item";
			getProcessModalPaging(table, $("#process_where").val(), 10, 2, "setProcessModalPage");
		}
	);
}

function postProcessItem(uid, item_cd, item_nm) {
	var flag = $("#flag").val();
	$("#process_item_uid_" + flag).val(uid);
	$("#process_item_cd_" + flag).val(item_cd);
	$("#process_item_nm_" + flag).val(item_nm);
	hideModal("processItemModal");
}

// 페이지 세트
function setProcessModalPage(page){
	$("#process_modal_page").val(page);
	getProcessItemData(page);
}

// 페이징 가져오기
function getProcessModalPaging(table,where,rpp,adjacents, setPage){
	var data_string = "page=" + $("#process_modal_page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents + "&setPage=" + setPage;

	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#process_modal_paging_area").html(str);
		}
	});
}

// 모달창 생산품목 - 품목검색
function searchProcess(){
	var type = 1;

	if(type == 1){
		var set_classify = $("#process_set_classify option:selected").val();
		var txt = $("#process_search_txt").val();
		if(txt == "") {
			showAlert("검색어를 입력하세요");
			return;
		}
		
		if(set_classify == 0) $("#process_where").val("where item_cd like '@" + txt + "@' or item_nm like '@" + txt + "@'");		
		else $("#process_where").val("where classify=" + set_classify + " and item_cd like '@" + txt + "@' or item_nm like '@" + txt + "@'");		
	} else {
		var classify = $("#process_item_classify option:selected").val();
		var txt = $("#process_search_txt").val();

		if(classify == 0) {
			showAlert("검색구분을 선택하세요");
			return;
		}
		
		if(txt == "") {
			showAlert("검색어를 입력하세요");
			return;
		}

		$("#process_where").val("where " + classify + " like '@" + txt + "@'");
	}
	$("#process_modal_page").val(1);
	getProcessItemData(1);
}

// 모달창 생산품명 - 품목구분 품목 리스트 가져오기
function setProcessItem(val) {
	$("#process_modal_page").val(1);
	if(val == 0) $("#process_where").val("");
	else $("#process_where").val(" where classify=" + val);
	getProcessItemData(1);
}
//====================================================================================================================================================================
// 투입자재 모달 영역
//====================================================================================================================================================================

// 투입자재용 품목 모달 
function getBomItemData(page){
	var tag = "";
	var parameter = {"mode" : "getItemList", "page" : page, "rpp" : 10, "where" : $("#bom_where").val()};

	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr >";
					tag += "<td style='vertical-align:middle'><a href='#' onclick=\"postBomItem(" + json[i].uid + ",'" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].unit + "', '" + json[i].classify + "', '" + json[i].classify_nm + "')\">" + json[i].item_cd + "</a></td>";
					tag += "<td style='vertical-align:middle'><a href='#' onclick=\"postBomItem(" + json[i].uid + ",'" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].unit + "', '" + json[i].classify + "', '" + json[i].classify_nm + "')\">" + json[i].item_nm + "</a></td>";
					tag += "<td style='vertical-align:middle'><a href='#' onclick=\"postBomItem(" + json[i].uid + ",'" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].unit + "', '" + json[i].classify + "', '" + json[i].classify_nm + "')\">" + json[i].standard + "</a></td>";
					tag += "<td style='vertical-align:middle'><a href='#' onclick=\"postBomItem(" + json[i].uid + ",'" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].unit + "', '" + json[i].classify + "', '" + json[i].classify_nm + "')\">" + json[i].classify_nm + "</a></td>";
					tag += "</tr>";
				}
			}

			//tag += "<tr><td colspan='8'></td></tr>";
			
			$("#bom_item tbody").html(tag);

			var table = "item";
			getBomModalPaging(table, $("#bom_where").val(), 10, 2, "setBomModalPage");
		}
	);
}

// 투입자재 처리
function postBomItem(uid, item_cd, item_nm, standard, unit, classify, classify_nm) {
	var tag = "";

	var arr = [];
	var std = [];
	var item = [];

	$.each($(".item_cd") , function () {
		arr.push($(this).val());
	});
	$.each($(".standard") , function () {
		std.push($(this).val());
	});

	
	for(var i = 0 ; i <= arr.length ; i++) {
		item.push(arr[i] + std[i]);
	}

	var check = item_cd + standard;

	var idx = jQuery.inArray(check, item);
	if(idx >= 0) {
		showAlert("동일 품목을 이미 선택하셨습니다");
	} else {
		if($("#process_item_flag").val() == 1) {
			$("#in_item_tb tbody").html("");
		}

		tag += "<tr>";
		tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
		tag += "<td><input type='text' class='item_cd' name='item_cd[]' value='" + item_cd + "' /></td>";
		tag += "<td><input type='text' name='item_nm[]' value='" + item_nm + "' /></td>";
		tag += "<td><input type='text' class='standard' name='standard[]' value='" + standard + "' style='width:100px' /></td>";
		tag += "<td><input type='text' name='unit[]' value='" + unit + "' style='width:50px' /></td>";
		tag += "<td><input type='text' class='cnt' name='cnt[]' style='width:50px' /></td>";
		tag += "<td><input type='text' name='process_no[]' value='" + $("#process_uid").val() + "' style='width:50px' readonly /></td>";
		tag += "<td><input type='hidden' name='classify[]' value='" + classify + "' value='width:50px'/><input type='text' name='classify_nm[]' value='" + classify_nm + "' /></td>";
		tag += "</tr>";
		
		$("#process_item_flag").val(Number($("#process_item_flag").val()) + 1);
		$("#in_item_tb tbody").append(tag);
	}
}

// 페이지 세트
function setBomModalPage(page){
	$("#bom_modal_page").val(page);
	getBomItemData(page);
}

// 페이징 가져오기
function getBomModalPaging(table,where,rpp,adjacents, setPage){
	var data_string = "page=" + $("#bom_modal_page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents + "&setPage=" + setPage;

	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#bom_modal_paging_area").html(str);
		}
	});
}

// 모달창 생산품목 - 품목검색
function searchBom(){
	var type = 1;

	if(type == 1){
		var set_classify = $("#bom_set_classify option:selected").val();
		var txt = $("#bom_search_txt").val();
		if(txt == "") {
			showAlert("검색어를 입력하세요");
			return;
		}
		
		if(set_classify == 0) $("#bom_where").val("where item_cd like '@" + txt + "@' or item_nm like '@" + txt + "@'");		
		else $("#bom_where").val("where classify=" + set_classify + " and item_cd like '@" + txt + "@' or item_nm like '@" + txt + "@'");		
	} else {
		var classify = $("#bom_item_classify option:selected").val();
		var txt = $("#bom_search_txt").val();

		if(classify == 0) {
			showAlert("검색구분을 선택하세요");
			return;
		}
		
		if(txt == "") {
			showAlert("검색어를 입력하세요");
			return;
		}

		$("#bom_where").val("where " + classify + " like '@" + txt + "@'");
	}

	$("#bom_modal_page").val(1);
	getBomItemData(1);
}

// 모달창 생산품명 - 품목구분 품목 리스트 가져오기
function setBomItem(val) {
	$("#bom_modal_page").val(1);
	if(val == 0) $("#bom_where").val("");
	else $("#bom_where").val(" where classify=" + val);
	getBomItemData(1);
}
</script>