<?
require_once("library/caseby.php");
?>

<div class="main-content" >
	<div class="main-content-inner" >
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div style="height:800px; border:1px solid #ccc">
						<div class="col-xs-12" style="height:550px; padding-top:10px; border-right:1px solid #ccc">
							<div style="float:left">
								<input type="button" class="btn btn-xs btn-pink" value="거래처" style="height:35px" />
							</div>
							<div>
								<div class="input-group" style="text-align:right;">									
									<!-- <select name="account_classify" id="account_classify" style="float:right; height:35px">
										<option value="0">=검색구분=</option>
										<option value="account_cd">거래처코드</option>
										<option value="account_nm">거래처명</option>
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

							<div><? $this->noCheckTable("account_tb","거래처구분=>3,거래처코드=>4,거래처명=>5"); ?></div>
							<div id="paging_area" style="text-align:center"></div>
						</div>

						<div class="col-xs-12" style="height:300px; padding-top:10px; border-right:1px solid #ccc; overflow:scroll; overflow-x:hidden; margin-top:10px;">
							<div><input type="button" class="btn btn-xs btn-pink" value="매입품목" /></div>
							<div><? $this->noCheckTable("tb","품번=>2,품목명=>4,규격=>4,단위=>2"); ?></div>							
						</div>

						<div class="col-xs-12" style="border-top:1px solid #ccc; overflow: scroll; overflow-x: hidden; height:250px; padding-top:10px">
							<div>
								<div style="float:left"><input type="button" class="btn btn-xs btn-info" value="단가등록" onclick="viewModal('costModal')" /></div>
								<div style="float:right"><input type="button" class="btn btn-xs btn-danger" value="선택삭제" data-toggle="modal" data-target="#confirm-delete" /></div>
							</div>
							<div  style="clear:both"><? $this->table("item_cost","품번=>2,품목명=>2,규격=>2,단위=>2,구매가격=>1,판매가격=>1,반영일=>2"); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="item_uid" id="item_uid" />
<input type="hidden" name="account_uid" id="account_uid" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<!-- 공정용 -->
<div class="modal fade" id="processItemModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">품목규격 리스트</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:450px">
				<? $this->noCheckTable("process_item","품번,품목명,품목규격,구분"); ?>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- BOM용 -->
<div class="modal fade" id="costModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">품목 단가 등록</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:140px">
				<table class="table table-bordered table-striped">
					<tr>
						<? $this->th("구매가격"); ?>
						<td><input type="text" class="comma" name="purchase_price" id="purchase_price" /></td>
					</tr>
					<tr>
						<? $this->th("판매가격"); ?>
						<td><input type="text" class="comma" name="sale_price" id="sale_price" /></td>
					</tr>
				</table>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-info" onclick="registPrice()">단가등록</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

function viewModal(modal){
	if($("#account_uid").val() == "") {
		showAlert("거래처를 선택하세요");
		return false;
	}

	if($("#item_uid").val() == "") {
		showAlert("매입품목을 선택하세요");
		return false;
	}

	showModal(modal);
}

// 새로고침
function refresh() {
	$("#classify").val(0);
	$("#account_classify").val(0);
	$("#where").val("");
	$("#search_txt").val("");
	$("#page").val(1);
	$("#account_uid").val("");
	getData(1);
}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );});

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
});

//==================================================
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("item_cost");
	hideModal("confirm-delete");
	getItemCost();
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
function getAccountItemList(page){
	var tag = "";
	var parameter = {"mode" : "getAccountItemList", "account_uid" : $("#account_uid").val()};

	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr onclick='toggle(this); postItemUid(" + json[i].item_fid + ")' style='cursor:pointer'>";
					tag += "<td style='vertical-align:middle'>" + json[i].item_cd + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].item_nm + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].standard + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].unit + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='4' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);
		}
	);
}

//==================================================
// 선택품목 처리
//==================================================
function postItemUid(uid) {
	$("#item_uid").val(uid);
	getItemCost();
}

//==================================================
// 품목 매입처 리스트 가져오기
//==================================================
function getData(page) {
	var tag = "";
	var parameter = {"mode" : "getAccountList", "page" : page, "rpp" : 11, "where" : $("#where").val()};

	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr onclick='accountToggle(this); postAccount(" + json[i].uid + ")' style='cursor:pointer'>";

					tag += "<td>" + json[i].classify_nm + "</td>";
					tag += "<td>" + json[i].account_cd + "</td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "</tr>";
				}
			}
			
			$("#account_tb tbody").html(tag);

			var table = "account";
			getPaging(table, $("#where").val(), 11, 2, "setPage");
		}
	);
}

function postAccount(uid) {
	$("#account_uid").val(uid);
	$("#item_uid").val("");
	getAccountItemList();
}

//==================================================
// 품목구분 품목 리스트 가져오기
//==================================================
function setAccount(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("");
	else $("#where").val("where classify=" + val);
	getData(1);
}

//==================================================
// 거래처 검색
//==================================================
function search() {
	var type = 1;

	if(type == 1){
		var search_txt = $("#search_txt").val();
		if(search_txt == ""){
			showAlert("검색어를 입력하세요");
			return false;
		}

		$("#where").val("where account_cd like '@" + search_txt + "@' or account_nm like '@" + search_txt + "@'");
	} else {
		var search_classify = $("#search_classify option:selected").val();
		var search_txt = $("#search_txt").val();

		if(search_classify == 0){
			showAlert("검색구분을 선택하세요");
			return false;
		}

		if(search_txt == ""){
			showAlert("검색어를 입력하세요");
			return false;
		}

		$("#where").val("where classify=" + search_classify + " and (account_cd like '@" + search_txt + "@' or account_nm like '@" + search_txt + "@')");
	}
	$("#page").val(1);
	getData(1);
}

//==================================================
// 선택 거래처 처리
//==================================================
function postAccountUid(uid) {
	$("#account_uid").val(uid);
}

//==================================================
// 품목 단가 리스트
//==================================================
function getItemCost() {
	if($("#item_uid").val() == "") {
		showAlert("품목을 선택하세요");
		return false;
	}

	if($("#account_uid").val() == "") {
		showAlert("거래처를 선택하세요");
		return false;
	}

	var tag = "";
	var parameter = {"mode" : "getItemCost", "item_uid" : $("#item_uid").val(), "account_uid" : $("#account_uid").val()};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {
				tag += "<tr>";

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
				tag += "<td style='text-align:right'>" + json[i].purchase_price + "</td>";
				tag += "<td style='text-align:right'>" + json[i].sale_price + "</td>";
				tag += "<td>" + json[i].create_dt + "</td>";
				tag += "</tr>";
			}
		} else {
			tag += "<tr><td style='padding:20px; color:red; font-weight:bold; text-align:center' colspan='8'>데이터가 존재하지 않습니다</td></tr>";
		}
		$("#item_cost tbody").html(tag);
	});
}

//==================================================
// 품목 단가 등록
//==================================================
function registPrice() {
	if($("#item_uid").val() == "") {
		hideModal("costModal");
		showAlert("품목을 선택하세요");
		return false;
	}

	if($("#account_uid").val() == "") {
		hideModal("costModal");
		showAlert("거래처를 선택하세요");
		return false;
	}

	if($("#purchase_price").val() == "" && $("#sale_price").val() == "") {
		showAlert("구매가격이나 판매가격을 입력하세요");
		return false;
	}

	var parameter = {"mode" : "registItemCost", "item_uid" : $("#item_uid").val(), "account_uid" : $("#account_uid").val(), "purchase_price" : $("#purchase_price").val(), "sale_price" : $("#sale_price").val()};

	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "success") {
				$("#purchase_price").val("");
				$("#sale_price").val("");
				hideModal('costModal');
				getItemCost();
			} else {
				alert(str);
			}
		}
	});
}
</script>