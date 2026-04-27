<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="input-group">
							<div><input type="button" class="btn btn-xs btn-pink" value="외주업체" /></div>
							<? $this->noCheckTable("tb","구분=>1,거래처코드=>3, 거래처명=>4,대표=>2,전화=>2"); ?>
							<? $this->paging() ?>

						<!--
						<div class="col-xs-6" style="height:450px; padding-top:10px">
							<div  style="clear:both">
								<div style="float:left"><input type="button" class="btn btn-xs btn-pink" value="품목 리스트" style="height:35px" /></div>
								<div>
									<div class="input-group">
										<input type="text" class=" search-query" name="search_txt" id="search_txt" style="float:right; height:35px"/>
										<select name="search_classify" id="search_classify" style="float:right; height:35px; margin-right:3px">
											<option value="0">=검색구분=</option>
											<option value="item_cd">품번</option>
											<option value="item_nm">품목명</option>
										</select>&nbsp;									
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
								<? $this->table("item_tb","품목코드=>2,품목명=>4,규격=>4,반제품구분=>2"); ?>
								<div id="item_paging_area" style="text-align:center; float:left"></div>
							</div>
							<div style="float:right"><input type="button" class="btn btn-xs btn-info" value="외주품목 등록" onclick="moveOutsourcingItem()" /></div>
						</div>
						-->
						<div class="col-xs-12" style="border-top:1px solid #ccc; height:300px; overflow: scroll; overflow-x: hidden; padding-top:10px; clear:both">
							<div><input type="button" class="btn btn-xs btn-pink" value="외주품목" /></div>
							<? $this->noCheckTable("outsourcing_item_tb","품목코드=>2,품목명=>2,규격=>2,구매단가=>2,관리"); ?>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="9" />
<input type="hidden" name="item_per" id="item_per" value="8" />
<input type="hidden" name="item_page" id="item_page" value="1" />
<input type="hidden" name="item_where" id="item_where" />
<input type="text" name="account_uid" id="account_uid" />

<?
$this->hidden("where outsourcing='y'");
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
function refresh() {
	$("#item_page").val(1);
	$("#item_where").val("");
	$("#search_classify").val(0);
	$("#search_txt").val("");
	getItemList(1);
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
	getItemList(1);

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

	$("#account_classify").on('change', function() {
		if($("#account_classify option:selected").val() == 0) {
			$("#search_txt").val("");
			$("#where").val("");
			getData(1);
		}
	});
});

//==================================================
// 선택한 품목 외주품목으로 등록
//==================================================
function moveOutsourcingItem() {
	if($("#account_uid").val() == "") {
		showAlert("거래처를 먼저 선택하세요");
		return;
	}

	$(".chk").each(function(){
		if($(this).prop('checked')) {
			var new_uid = $("#check_uids").val() + "," + $(this).val();
			$("#check_uids").val(new_uid);
		}
	});
	
	if($("#check_uids").val() == "") {
		showAlert("외주품목으로 지정할 품목을 선택하세요");
		return;
	}

	var parameter = {"mode" : "moveOutsourcingItem", "account_uid" : $("#account_uid").val(), "uids" : $("#check_uids").val()};
	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		async : false,
		success : function(){
			$("#checkedAll").prop('checked',false);
			$("#check_uids").val("");
			$(".chk").each(function(){
				$(this).prop('checked',false);
			});			
			getOutsourcingItemList();
		}
	});
}

//==================================================
// 업체별 외주품목 불러오기
//==================================================
function getOutsourcingItemList() {
	var tag = "";
	var parameter = {"mode" : "getOutsourcingItemList", "account_uid" : $("#account_uid").val()};

	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td style='vertical-align:middle'>" + json[i].item_cd + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].item_nm + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].standard + "</td>";
					tag += "<td style='vertical-align:middle'><input type='text' class='comma' name='price' id='price_" + i + "' value='" + json[i].price + "'/></td>";
					tag += "<td><input type='button' class='btn btn-xs btn-success' value='구매단가 저장' onclick='registOutsourcingItemPrice(" + json[i].uid + ", " + i + ")' /> <input type='text' class='btn btn-xs btn-danger' value='외주품목에서 삭제' onclick='removeOutsourcingItem(" + json[i].uid + ")' /></td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='5' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#outsourcing_item_tb tbody").html(tag);
		}
	);
}

//==================================================
// 외주품목 단가 저장
//==================================================
function registOutsourcingItemPrice(uid, i) {
	var price = $("#price_" + i).val();
	if(price == 0) {
		showAlert("구매단가를 입력하세요");
		return false;
	}
	var parameter = {"mode" : "registOutsourcingItemPrice", "uid" : uid, "price" : price};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "success") {
				showAlert("단가를 등록하였습니다");
				getOutsourcingItemList();
			} else {
				showAlert(str);
			}
		}
	});
}

//==================================================
// 외주품목에서 제외
//==================================================
function removeOutsourcingItem(uid) {
	var parameter = {"mode" : "removeOutsourcingItem", "uid" : uid};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "success") {
				getOutsourcingItemList();
			} else {
				showAlert(str);
			}
		}
	});
}

//==================================================
// 품목리스트
//==================================================
function getItemList(page){
	var tag = "";
	var parameter = {"mode" : "getItemList", "page" : page, "rpp" : $("#item_per").val(), "where" : $("#item_where").val()};

	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr onclick='item_toggle(this); postItemUid(" + json[i].uid + ")' style='cursor:pointer'>";
					
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";

					tag += "<td style='vertical-align:middle'>" + json[i].item_cd + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].item_nm + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].standard + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].classify_nm + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='5' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#item_tb tbody").html(tag);

			var table = "item";
			getItemPaging(table, $("#item_where").val(), $("#item_per").val(), 4, "setItemPage");
		}
	);
}


//==================================================
// 거래처 페이지 세트
//==================================================
function setItemPage(page){
	$("#item_page").val(page);
	getItemList(page);
}

//==================================================
// 거래처 페이징 가져오기
//==================================================
function getItemPaging(table,where,rpp,adjacents, setPage){
	var data_string = "page=" + $("#item_page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents + "&setPage=" + setPage;

	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#item_paging_area").html(str);
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
	deleteSelect("account");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#btnSubmitTxt").text("거래처 등록");
}

//==================================================
// 선택된 거래처 테이블 선택된 TR 색상 바꾸기
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
function item_toggle(it) {
	$("#item_tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}


//==================================================
// 아웃소싱 업체 리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getOutsourcingAccountList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postAccount(" + json[i].uid + ");\" style='cursor:pointer'>";

					tag += "<td>" + json[i].classify_nm + "</td>";
					tag += "<td>" + json[i].account_cd + "</td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "<td>" + json[i].owner + "</td>";
					tag += "<td>" + json[i].corp_phone + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='6' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "account";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

function postAccount(uid){
	$("#account_uid").val(uid);
	getOutsourcingItemList();
}

//==================================================
// 검색
//==================================================
function search(){

	var search_classify = $("#search_classify option:selected").val();
	var search_txt = $("#search_txt").val();
	
	if(search_classify == 0) {
		showAlert("검색구분을 선택하세요");
		return;
	}
	
	if(search_txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#item_where").val("where " + search_classify + " like '%" + search_txt + "%'");
	getItemList(1);
}
</script>