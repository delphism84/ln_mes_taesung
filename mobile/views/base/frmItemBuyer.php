<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div>
						<div class="col-xs-12" style="padding-top:10px;">
							<div>
								<div style="float:left">
									<input type="button" class="btn btn-xs btn-pink" value="품목리스트" style="height:35px"/>
								</div>
								<div>
									<div class="input-group">
										<input type="text" class=" search-query" name="search_txt" id="search_txt" style="float:right; height:35px"/>
										<!-- <select name="search_classify" id="search_classify" style="float:right; height:35px">
											<option value="0">=검색구분=</option>
											<option value="item_cd">품번</option>
											<option value="item_nm">품목명</option>
										</select>&nbsp;									 -->
										<span class="input-group-btn">										
											<button type="button" class="btn btn-purple btn-sm" onclick="search()" style="height:35px">
												<span class="fa fa-search icon-on-right bigger-110"></span>
											</button>
											<button type="button" class="btn btn-success btn-sm" onclick="item_refresh()" style="height:35px">
												<span class="fa fa-refresh icon-on-right bigger-110"></span>
											</button>
										</span>
									</div>
								</div>
							</div>
							<div><? $this->noCheckTable("tb","품번=>2,품목명=>4,규격=>4,반제품구분=>2"); ?></div>
							<div id="paging_area" style="text-align:center"></div>
						</div>

						<div class="col-xs-12" style="padding-top:10px">
							<div>
								<div style="float:left">
									<input type="button" class="btn btn-xs btn-pink" value="거래처리스트" style="height:35px"/>
								</div>
								<div>
									<div class="input-group">
										<input type="text" class="search-query" name="account_search_txt" id="account_search_txt" style="float:right; height:35px"/>
										<!-- <select name="account_classify" id="account_classify" style="float:right; height:35px">
											<option value="0">=검색구분=</option>
											<option value="account_cd">거래처코드</option>
											<option value="account_nm">거래처명</option>
										</select>&nbsp;									 -->
										<span class="input-group-btn">										
											<button type="button" class="btn btn-purple btn-sm" onclick="account_search()" style="height:35px">
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											</button>
											<button type="button" class="btn btn-success btn-sm" onclick="account_refresh()" style="height:35px">
												<span class="fa fa-refresh icon-on-right bigger-110"></span>
											</button>
										</span>
									</div>
								</div>

								<div><? $this->noCheckTable("account_tb","거래처구분=>3,거래처코드=>4,거래처명=>5"); ?></div>
								<div>
									<div id="account_paging_area" style="text-align:center; float:left"></div>
									<div style="float:right"><input type="button" class="btn btn-xs btn-success" value="매입처 등록" onclick="registItemAccount()" /></div>
								</div>
							</div>
						</div>

						<div class="col-xs-12" style="border-top:1px solid #ccc; margin-top:5px; overflow: scroll; overflow-x: hidden; padding-top:10px">
							<div>
								<div style="float:left"><input type="button" class="btn btn-xs btn-pink" value="매입거래처" /></div>
								<div style="float:right"><input type="button" class="btn btn-xs btn-danger" value="선택삭제" data-toggle="modal" data-target="#confirm-delete" /></div>
							</div>
							<div  style="clear:both"><? $this->table("item_account","품번=>2,품목명=>2,규격=>2,단위=>2,거래처코드=>2,거래처명=>2"); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="item_uid" id="item_uid" />
<input type="hidden" name="account_uid" id="account_uid" />
<input type="hidden" name="account_page" id="account_page" value="1" />
<input type="hidden" name="account_where" id="account_where" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
function item_refresh() {
	$("#classify").val(0);
	$("#item_classify").val(0);
	$("#search_txt").val("");
	$("#where").val("");
	$("#page").val(1);
	getData(1);
}

function account_refresh() {
	$("#account_classify_select").val(0);
	$("#account_classify").val(0);
	$("#account_search_txt").val("");
	$("#account_where").val("");
	$("#account_page").val(1);
	getAccount(1);
}


// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

$(document).ready(function(){
	var page = $("#page").val();
	var account_page = $("#account_page").val();

	getData(page);
	getAccount(account_page);

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

	$("#account_classify").on('change', function() {
		if($("#account_classify option:selected").val() == 0) {
			$("#account_search_txt").val("");
			$("#account_where").val("");
			getAccount(1);
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
	deleteSelect("item_account", 1);
	hideModal("confirm-delete");
}

//==================================================
// 상품테이블 선택 아이템 TR 색상 바꾸기
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
// 거래처테이블 선택 아이템 TR 색상 바꾸기
//==================================================
function accountToggle(it) {
	$("#account_tb tr").css("background-color","");
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
	var parameter = {"mode" : "getItemList", "page" : page, "rpp" : 11, "where" : $("#where").val()};

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
			} else {
				tag = "<tr><td colspan='4' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "item";
			getPaging(table, $("#where").val(), 11, 4, "setPage");
		}
	);
}

//==================================================
// 선택품목 처리
//==================================================
function postItemUid(uid) {
	$("#item_uid").val(uid);
	getItemAccount();
}

//==================================================
// 품목검색
//==================================================
function search(){
	var type = 1;

	if(type == 1) {
		var search_txt = $("#search_txt").val();
		if(search_txt == ""){
			showAlert("검색어를 입력하세요");
			return false;
		}
		$("#where").val("where item_cd like '@" + search_txt + "@' or item_nm like '@" + search_txt + "@'");
	} else {
		var search_classify = $("#search_classify option:selected").val();
		var search_txt = $("#search_txt").val();

		if(search_classify == 0) {
			showAlert("검색구분을 선택하세요");
			return false;
		}

		if(search_txt == ""){
			showAlert("검색어를 입력하세요");
			return false;
		}
		$("#where").val("where classify=" + search_classify + " and (item_cd like '@" + search_txt + "@' or item_nm like '@" + search_txt + "@')");
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
	else $("#where").val("where classify=" + val);
	getData(1);
}

//==================================================
// 거래처 리스트
//==================================================
function getAccount(page) {
	var tag = "";
	var parameter = {"mode" : "getAccountList", "page" : page, "rpp" : 11, "where" : $("#account_where").val()};

	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr onclick='accountToggle(this); postAccountUid(" + json[i].uid + ")' style='cursor:pointer'>";
					tag += "<td style='vertical-align:middle'>" + json[i].classify_nm + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].account_cd + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].account_nm + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='4' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			
			$("#account_tb tbody").html(tag);

			var table = "account";
			getAccountPaging(table, $("#account_where").val(), 11, 2, "setAccountPage");
		}
	);
}

//==================================================
// 거래처 검색
//==================================================
function account_search() {
	var type = 1;

	if(type == 1) {
		var search_txt = $("#account_search_txt").val();
		if(search_txt == ""){
			showAlert("검색어를 입력하세요");
			return false;
		}
		$("#account_where").val("where account_cd like '@" + search_txt + "@' or account_nm like '@" + search_txt + "@'");
	} else {
		var search_classify = $("#account_search_classify option:selected").val();
		var search_txt = $("#account_search_txt").val();

		if(search_classify == 0) {
			showAlert("검색구분을 선택하세요");
			return false;
		}

		if(search_txt == ""){
			showAlert("검색어를 입력하세요");
			return false;
		}
		$("#account_where").val("where classify=" + search_classify + " and (account_cd like '@" + search_txt + "@' or account_nm like '@" + search_txt + "@')");
	}

	$("#account_page").val(1);
	getAccount(1);
}

//==================================================
// 선택 거래처 처리
//==================================================
function postAccountUid(uid) {
	$("#account_uid").val(uid);
}

//==================================================
// 거래처 구분 리스트 가져오기
//==================================================
function setAccount(val) {
	$("#account_page").val(1);
	if(val == 0) $("#account_where").val("");
	else $("#account_where").val(" where classify=" + val);
	getAccount(1);
}

//==================================================
// 거래처 페이지 세트
//==================================================
function setAccountPage(page){
	$("#account_page").val(page);
	getAccount(page);
}

//==================================================
// 거래처 페이징 가져오기
//==================================================
function getAccountPaging(table,where,rpp,adjacents, setPage){
	var data_string = "page=" + $("#account_page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents + "&setPage=" + setPage;

	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#account_paging_area").html(str);
		}
	});
}

//==================================================
// 품목 매입처 등록
//==================================================
function registItemAccount() {
	if($("#item_uid").val() == "") {
		showAlert("품목을 선택하세요");
		return false;
	}

	if($("#account_uid").val() == "") {
		showAlert("거래처를 선택하세요");
		return false;
	}

	var parameter = {"mode" : "registItemAccount", "item_uid" : $("#item_uid").val(), "account_uid" : $("#account_uid").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "success") getItemAccount();
			else if(str == "dupp") showAlert("이미 등록된 매입처입니다");
		}
	});
}

//==================================================
// 품목 매입처 리스트 가져오기
//==================================================
function getItemAccount(page) {
	var tag = "";
	var parameter = {"mode" : "getItemAccount", "item_uid" : $("#item_uid").val()};

	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr onclick='accountToggle(this);' style='cursor:pointer'>";
					
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>

					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					tag += "<td>" + json[i].account_cd + "</td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "</tr>";
				}
			}
			
			$("#item_account tbody").html(tag);
		}
	);
}
</script>