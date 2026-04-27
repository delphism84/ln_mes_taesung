<?
require_once("library/caseby.php");

$order_cd = $this->createCode("obtain_order_cd","obtain_order");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<!-- 검색 모달 -->
		<div class="wrap_search_pop">	
			<div class="search_pop_content">
				<div class="input-group">
					<div class="col-xs-12">
						<? $this->periodSearch("searchDate()","상차일자검색"); ?>
						<select name="search_classify" id="search_classify" style="height:35px; width:100%; margin-top:10px;">
							<option value="0">선택</option>
							<option value="item_cd">품번</option>
							<option value="item_nm">품명</option>
							<option value="account_nm">거래처</option>
						</select>					
						<input type="text" name="search_txt" id="search_txt" class="search_input"/>
						<input type="button" class="search_btn" onclick="search()" value="검색"/>
						<button type="button" class="search_refresh" onclick="refresh()">
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
						<input type='button' class='comm_title' value='출하지시서 리스트' />
						<table class="table table-bordered table-striped" id="tb">
							<thead>
								<tr>
									<th class="detail-col center">
										거래처
									</th>
									<th class="detail-col center">
										상차일
									</th>						
									<th class="detail-col center">
										상태
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
</div>
<input type="hidden" name="per" id="per" value="10" />
<input type="hidden" name="flag" id="flag" value="1" />


<div class="modal fade" id="shipmentModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:1200px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">출하지시서</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:500px; overflow-hidden; overflow-y:scroll">
				<form name="shipment_frm" id="shipment_frm">
					<input type="hidden" name="mode" id="mode" value="registShipment" />
					<input type="hidden" name="shipment_order_cd" id="shipment_order_cd" value="" />
					<table class="table table-bordered">
						<tr>
							<? $this->th("거래처") ?>
							<td><input type="hidden" class="form-control" name="shipment_account_cd" id="shipment_account_cd" /><input type="text" name="shipment_account_nm" id="shipment_account_nm" onclick="showModal('accountModal')" readonly /></td>
							<? $this->th("상차일") ?>
							<td>
								<div>
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class=" date-picker" name="shipment_dt" id="shipment_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="상차일을 입력하세요" readonly />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</div>
							</td>
						</tr>
						<tr>
							<? $this->th("배송지") ?>
							<td colspan="3"><textarea class="form-control" name="shipment_address" id="shipment_address" onclick="sample6_execDaumPostcode(2)"></textarea></td>
						</tr>
					</table>
					<table class="table table-bordered" id="shipment_item">
						<thead>							
							<tr>
								<th colspan="12" style="background-color:#ccc">출하품목 <input type='button' class="btn btn-xs btn-danger" value='품목추가' onclick="showModal('itemModal')" /></th>
							</tr>
							<tr>
								<th style="background-color:#f1f1f1; width:50px">-</th>
								<th style="background-color:#f1f1f1; width:150px">품번</th>
								<th style="background-color:#f1f1f1">품명</th>
								<th style="background-color:#f1f1f1; width:150px">규격</th>
								<th style="background-color:#f1f1f1; width:100px">단위</th>
								<th style="background-color:#f1f1f1; width:100px">재고수량</th>
								<th style="background-color:#f1f1f1; width:100px">출하지시수량</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-primary" id="btnShipmentSubmit">출하지시서등록</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 상세보기 -->
<div class="modal fade" id="viewShipmentModal" data-backdrop="static" data-keyboard="false">
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
					<input type="hidden" name="mode" id="mode" value="registItem" />
					<input type="hidden" name="uid" id="uid"/>
					<input type="hidden" name="old_img" id="old_img" />
					<table class="table table-bordered">
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; width:25%"><i class="ace-icon fa fa-caret-right blue"></i>수주코드</th>
							<td><span id="s_obtain_order_cd"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>거래처</th>
							<td><span id="s_account_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>상차일</th>
							<td><span id="s_shipment_dt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>배송지</th>
							<td><span id="s_address"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>지시자</th>
							<td><span id="s_emp_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>등록일</th>
							<td><span id="s_create_dt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>상태</th>
							<td><span id="s_state"></span></td>
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
require_once ("views/modal/accountModal.php");
require_once ("views/modal/itemModal.php");
?>


<!-- // 우편번호 찾기 ------------------------------------------------------------------------------------------------------->
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
function sample6_execDaumPostcode() {
	new daum.Postcode({
		oncomplete: function(data) {
			// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = ''; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
			if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
				fullAddr = data.roadAddress;
			} else { // 사용자가 지번 주소를 선택했을 경우(J)
				fullAddr = data.jibunAddress;
			}

			// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
			if(data.userSelectedType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}
			
			
			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			//document.getElementById('emp_zipcode').value = data.zonecode; //5자리 새우편번호 사용
			document.getElementById('shipment_address').value = fullAddr;

			// 커서를 상세주소 필드로 이동한다.
			document.getElementById('shipment_address').focus();			
		}
	}).open();
 }
 </script>

<script>
//==================================================
// 출하지시서
//==================================================
function showShipment(){
	if($("#uid").val() == "") {
		showAlert("출하지시를 내릴 수주를 선택하세요");
		return false;
	}

	var parameter = {"mode" : "checkObtainOrder", "order_cd" : $("#shipment_order_cd").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str){
			if(str == "no") {
				showAlert("이미 출하지시서를 내린 수주입니다.");
				return false;
			} else {
				showModal('shipmentModal');
			}				
		}
	});
}

function refresh() {
	$("#uid").val("");
	$("#page").val(1);
	$("#where").val("");
	$("#search_classify").val(0);
	$("#search_txt").val("");
	formClear();
	getData(1);
}

function account_refresh() {
	$("#account_search_txt").val("");
	$("#account_where").val("");
	$("#account_page").val(1);
	getAccountList();
}

function item_refresh() {
	$("#item_search_choice").val(0);
	$("#item_search_txt").val("");
	$("#item_where").val("");
	$("#item_page").val(1);
	getItemList();
}

// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

$(document).ready(function(){

	var page = $("#page").val();
	getData(page);
	getItemList();
	getAccountList();

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

	$("#btnShipmentSubmit").click(function (event) {
		if(check("shipment_frm")) {
			
			//stop submit the form, we will post it manually.
			event.preventDefault();

			// Get form
			var form = $('#shipment_frm')[0];

			// Create an FormData object
			var data = new FormData(form);

			// If you want to add an extra field for the FormData
			data.append("CustomField", "This is some extra data, testing");

			// disabled the submit button
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
					hideModal('shipmentModal');
					shipment_formClear();
					getData(1);
					$("#btnShipmentSubmit").prop("disabled", false);

				},
				error: function (e) {
					$("#btnShipmentSubmit").prop("disabled", false);

				}
			});
		}
	});
});

function shipment_formClear() {
	$("#shipment_frm")[0].reset();
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

function inputNumberFormat(obj) {
    obj.value = comma(uncomma(obj.value));
}

//==================================================
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("shipment");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#uid").val("");
	$("#btnSubmit").text("출하지시서등록");
	$("#frm")[0].reset();
}

//==================================================
// 날짜별로 데이터 가져오기
//==================================================
function searchDate() {
	var first = $("#start_dt").val();
	var second = $("#end_dt").val();
	if(parseInt(first.replace(/-/g,""),10) > parseInt(second.replace(/-/g,""),10)){
		showAlert("검색 시작일이 검색 종료일 보다 미래일 수 없습니다");
		return;
	}

	var txt = "where (date(shipment_dt) between '" + first + "' and '" + second + "')";
	$("#where").val(txt);

	getData(1);
}

//==================================================
// 견적서 테이블 선택된 TR 색상 바꾸기
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
	var parameter = {"mode" : "getShipmentList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick='toggle(this); postData(" + json[i].uid + ");' style='cursor:pointer'>";
					/*
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";

					if(json[i].state == "출하지시") {
						tag += "<label class='pos-rel'>";
						tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
						tag += "<span class='lbl'></span>";
						tag += "</label>";
					}
					tag += "</td>";
					<?}?>
					*/
					//tag += "<td>" + json[i].obtain_order_cd + "</td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "<td>" + json[i].shipment_dt + "</td>";
					//tag += "<td>" + json[i].address + "</td>";
					//tag += "<td>" + json[i].emp_nm + "</td>";
					//tag += "<td>" + json[i].create_dt + "</td>";
					tag += "<td>" + json[i].state + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "shipment";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
/*
function postData(uid, order_cd, account_cd, account_nm, item_cd, item_nm, standard, unit, cnt, shipment_dt, shipment_address) {
	$("#s_uid").val(uid);
	$("#shipment_order_cd").val(order_cd);
	$("#shipment_account_cd").val(account_cd);
	$("#shipment_account_nm").val(account_nm);
	$("#shipment_item_cd").val(item_cd);
	$("#shipment_item_nm").val(item_nm);
	$("#shipment_standard").val(standard);
	$("#shipment_unit").val(unit);
	$("#shipment_cnt").val(cnt);
	$("#shipment_dt").val(shipment_dt);
	$("#shipment_address").val(shipment_address);
	//$("#btnSubmit").text("출하지시서수정");
}
*/
function postData(uid) {
	$("#uid").val(uid);
	var parameter = {"mode" : "getShipment", "uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#s_uid").html(uid);
			$("#s_obtain_order_cd").html(json.obtain_order_cd);
			$("#s_account_nm").html(json.account_nm);
			$("#s_shipment_dt").html(json.shipment_dt);
			$("#s_address").html(json.address);
			$("#s_emp_nm").html(json.emp_nm);
			$("#s_create_dt").html(json.create_dt);
			$("#s_state").html(json.state);
		}
	});
	showModal('viewShipmentModal');
	//$("#btnSubmitTxt").text("품목수정");
}
//==================================================
// 선택 거래처 처리
//==================================================
function postAccount(account_cd, account_nm) {
	$("#shipment_account_cd").val(account_cd);
	$("#shipment_account_nm").val(account_nm);
	hideModal("accountModal");
}

//==================================================
// 선택 품목 처리
//==================================================

function postItem(uid) {
	var parameter = {"mode" : "getItem", "item_uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			
			var flag = $("#flag").val();
			var tag = "";

			var arr = [];
			var std = [];
			var item = [];

			$.each($(".item_cd") , function () {
				arr.push($(this).val());
			});
			
			// $.each($(".standard") , function () {
			// 	std.push($(this).val());
			// });

			
			for(var i = 0 ; i <= arr.length ; i++) {
				item.push(arr[i]);
			}

			var check = json.item_cd;
			var idx = jQuery.inArray(check, item);
			
			if(idx >= 0) {
				showAlert("동일 품목을 이미 선택하셨습니다");
			} else {
				
				tag += "<tr class='item" + flag + "'>";
				tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
				tag += "<td><input type='text' class='form-control item_cd' name='shipment_item_cd[]' id='shipment_item_cd_" + flag + "' value='" + json.item_cd + "' readonly /></td>";
				tag += "<td><input type='text' class='form-control item_nm' name='shipment_item_nm[]' id='shipment_item_nm_" + flag + "' value='" + json.item_nm + "' readonly /></td>";
				tag += "<td><input type='text' class='form-control standard' name='shipment_standard[]' id='shipment_standard_" + flag + "' value='" + json.standard + "' readonly /></td>";
				tag += "<td><input type='text' class='form-control unit' name='shipment_unit[]' id='shipment_unit_" + flag + "' value='" + json.unit + "' readonly /></td>";
				tag += "<td><input type='text' class='form-control cnt' value='" + json.stock_cnt + "' /></td>";
				tag += "<td><input type='text' class='form-control cnt' name='shipment_cnt[]' id='shipment_cnt_" + flag + "' onkeyup='calculation(" + flag + ")' /></td>";
				tag += "</tr>";

				$("#shipment_item tbody").append(tag);
				$("#flag").val(Number(flag) + 1);
			}
		}
	});

	
}

//==================================================
// 검색
//==================================================
function search(){
	var search_classify = $("#search_classify option:selected").val();
	var search_txt = $("#search_txt").val();

	if(search_classify == 0) {
		showAlert("검색구분을 선택하세요");
		return false;
	}

	if(search_txt == "") {
		showAlert("검색어를 입력하세요");
		return false;
	}

	$("#where").val(" where " + search_classify + " like '%" + search_txt + "%'");
	getData(1);
}
// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getData(page);
}

// 페이징 가져오기
function getPaging(table,where,rpp,adjacents, setPage){
	var data_string = "page=" + $("#page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents + "&setPage=" + setPage;
	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#paging_area").html(str);
		}
	});
}

//검색
$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').css('top','0%')
	})
})

//검색
$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1)
	})
})
</script>