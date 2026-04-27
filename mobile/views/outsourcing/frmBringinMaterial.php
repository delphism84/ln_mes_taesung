<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div style="border:1px solid #ccc; height:750px; margin-top:5px; clear:both">
						<div class="col-xs-6" style="border-right:1px solid #ccc; height:450px; padding-top:10px">
							<div><input type="button" class="btn btn-xs btn-pink" value="외주업체" /></div>
							<? $this->noCheckTable("tb","구분=>1,거래처코드=>3, 거래처명=>4,대표=>2,전화=>2"); ?>
							<? $this->paging() ?>
						</div>
						<div class="col-xs-6" style="height:450px; padding-top:10px">
							<div  style="clear:both">
								<div style="float:left"><input type="button" class="btn btn-xs btn-pink" value="외주품목" style="height:35px" /></div>
								<!-- <div>
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
								</div> -->
								<? $this->noCheckTable("outsourcing_item_tb","품목코드=>2,품목명=>2,규격=>2,단위=>2,구매가격"); ?>
							</div>
						</div>
						<div class="col-xs-12" style="border-top:1px solid #ccc; height:300px; overflow: scroll; overflow-x: hidden; padding-top:10px; clear:both">
							<div>
								<div style="float:left">
									<input type="button" class="btn btn-xs btn-pink" value="사급자재" /> <input type="button" class="btn btn-xs btn-success" value="사급자재 추가" onclick="modalOpen()" />
								</div>
								<div style="float:right">
									<input type="button" class="btn btn-xs btn-info" value="사급자재 저장" id="btnSubmit" />
								</div>
							</div>
							<form name="frm" id="frm">
								<input type="hidden" name="account_uid" id="account_uid" />
								<input type="hidden" name="item_uid" id="item_uid" />
								<input type="hidden" name="mode" id="mode" value="registBringinMaterial" />
								<? $this->table("bringin_tb","품목코드=>2,품목명=>2,규격=>2,단위=>2,소요량"); ?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="9" />

<?
$this->hidden("where outsourcing='y'");
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
require_once ("views/modal/itemModal.php");
?>

<script>
//==================================================
// 1. 외주업체 가져오기
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

//==================================================
// 2. 선택한 품목 처리
//==================================================
function postAccount(uid) {
	$("#account_uid").val(uid);
	$("#item_uid").val();
	$("#bringin_tb tbody").html("");
	getOutsourcingItemList();
}

function refresh() {
	$("#item_search_choice").val(0);
	$("#item_search_txt").val("");
	$("#item_where").val("");
	$("#item_page").val(1);
	getOutsourcingItemList();
}

//==================================================
// 3. 업체별 외주품목 불러오기
//==================================================
function getOutsourcingItemList() {
	var tag = "";
	var parameter = {"mode" : "getOutsourcingItemList", "account_uid" : $("#account_uid").val()};

	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr onclick='item_toggle(this); postItemUid(" + json[i].item_uid + ")' style='cursor:pointer'>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					tag += "<td style='text-align:right'>" + json[i].price + "</td>";
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
// 4. 선택한 외주품목 처리하기
//==================================================
function postItemUid(uid) {
	$("#item_uid").val(uid);
	getBinginMaterial();
}

//==================================================
// 5. 등록된 사급자재 불러오기
//==================================================
function getBinginMaterial() {
	var tag = "";
	var parameter = {"mode" : "getBringinMaterial", "account_uid" : $("#account_uid").val(), "item_uid" : $("#item_uid").val()};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {
				tag += "<tr>";
				tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
				tag += "<td><input type='hidden' name='uid[]' id='uid' value='" + json[i].uid + "' /><input type='hidden' class='item_cd' name='item_cd[]' id='item_cd' value='" + json[i].item_cd + "' />" + json[i].item_cd + "</td>";
				tag += "<td><input type='hidden' name='item_nm[]' id='item_nm' value='" + json[i].item_nm + "' />" + json[i].item_nm + "</td>";
				tag += "<td><input type='hidden' class='standard' name='standard[]' id='standard[]' value='" + json[i].standard + "' />" + json[i].standard + "</td>";
				tag += "<td><input type='hidden' name='unit[]' id=unit' value='" + json[i].unit + "' />" + json[i].unit + "</td>";
				tag += "<td><input type='text' class='comma' name='cnt[]' id='cnt' validation='yes' err='자재 소요량을 입력하세요' value='" + json[i].cnt + "' /></td>";
				tag += "</tr>";
			}
		} else {
			//tag += "<tr><td colspan='6' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#bringin_tb tbody").html(tag);
	});
}


//==================================================
// 품목 검색
//==================================================
function search(){
	var search_classify = $("#search_classify option:selected").val();
	if(choice == 0) {
		showAlert("검색구분을 선택하세요");
		return false;
	}

	var search_txt = $("#search_txt").val();
	
	if(txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#where").val("where " + search_classify + " like '%" + search_txt + "%'");

	getOutsourcingItemList();
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
	getItemList();

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

	// 사급자재등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
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
					showAlert("저장하였습니다");
					getBinginMaterial();
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
// 품목 모달창 열기
//==================================================
function modalOpen() {
	if($("#account_uid").val() == "") {
		showAlert("거래처를 선택하세요");
		return;
	}

	if($("#item_uid").val() == "") {
		showAlert("외주품목을 선택하세요");
		return;
	}

	showModal("itemModal");
}

function postItem(item_cd, item_nm, standard, unit, uid) {
	alert(item_cd);
	var tag = "";

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
		showAlert("동일 품목을 이미 선택하셨습니다");
	} else {
		tag += "<tr>";
		tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
		tag += "<td><input type='hidden' name='uid[]' id='uid' value='" + uid + "' /><input type='hidden' class='item_cd' name='item_cd[]' id='item_cd' value='" + item_cd + "' />" + item_cd + "</td>";
		tag += "<td><input type='hidden' name='item_nm[]' id='item_nm' value='" + item_nm + "' />" + item_nm + "</td>";
		tag += "<td><input type='hidden' class='standard' name='standard[]' id='standard[]' value='" + standard + "' />" + standard + "</td>";
		tag += "<td><input type='hidden' name='unit[]' id=unit' value='" + unit + "' />" + unit + "</td>";
		tag += "<td><input type='text' class='comma' name='cnt[]' id='cnt' validation='yes' err='자재 소요량을 입력하세요' /></td>";
		tag += "</tr>";

		$("#bringin_tb tbody").append(tag);
	}
}

//==================================================
// TR 삭제
//==================================================
function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#flag").val(nextFlag);
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
	$("#outsourcing_item_tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
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
// 검색
//==================================================
function search(){
	var classify = $("#account_classify option:selected").val();
	var txt = $("#search_txt").val();
	
	if(classify == 0) {
		showAlert("검색구분을 선택하세요");
		return;
	}
	
	if(txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#where").val("where outsourcing='y' and " + classify + " like '%" + txt + "%'");
	getData(1);
}

//==================================================
// 품목구분 품목 리스트 가져오기
//==================================================
function setAccount(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("where outsourcing='y'");
	else $("#where").val("where outsourcing='y' and classify=" + val);
	getData(1);
}
</script>