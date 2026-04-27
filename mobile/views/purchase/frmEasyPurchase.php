<?
require_once("library/caseby.php");

$order_cd = $this->createCode("order_cd","obtain_order");
?>

<!--구매요청LIST-->
<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div>
						<div class="input-group">
							<div class="col-xs-12">
								<? $this->periodSearch("searchDate()","등록일 검색"); ?>
								<!-- <select name="search_classify" id="search_classify" style="height:35px; margin-left:5px">
									<option value="0">선택</option>
									<option value="item_cd">품번</option>
									<option value="item_nm">품명</option>
									<option value="account_nm">거래처</option>
								</select>					 -->
							</div>
							<div class="col-xs-12" style="margin-top:10px;">
								<input type="text" name="search_txt" id="search_txt" style="height:35px; width:77%; float:left;" />
								<input type="button" class="btn btn-xs btn-purple" onclick="search()" value="검색" style="height:35px;float:left;" />
								<button type="button" class="btn btn-success btn-xs" onclick="refresh()" style="height:35px;float:left;">
									<span class="fa fa-refresh icon-on-right bigger-110"></span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-12">						
						<div style="padding-top:10px; padding-right:10px">
							<?
								if($_SESSION['login_level'] >= 99) {
									
									
									echo "<div style='float:left'>";
									//echo "<input type='button' class='btn btn-xs btn-pink' value='발주리스트' style='height:35px; margin-right:5px' />";						
									echo "</div>";
									
									echo "<div style='float:right'>";
									//echo "<input type='button' class='btn btn-xs btn-primary' value='간편구매 요청' style='margin-right:3px' onclick='createObtainOrder()' />";
									//echo "<input type='button' class='btn btn-xs btn-danger' value='선택삭제' data-toggle='modal' data-target='#confirm-delete' style='height:30px' />";
									echo "</div>";

									//$this->table("tb","발주코드=>2,거래처=>5,진행상태=>2,발주일=>2,수신=>1");
								} else {
									echo "<div style='float:left'>";
									//echo "<input type='button' class='btn btn-xs btn-pink' value='발주리스트' style='height:35px; margin-right:5px' />";					
									echo "</div>";

									//$this->noCheckTable("tb","발주코드=>2,거래처=>5,진행상태=>2,발주일=>2,수신=>1");
								}
								echo "<input type='button' class='btn btn-xs btn-pink' value='간편구매요청목록' style='height:35px; margin-right:5px' />";
								$this->noCheckTable("tb","발주코드=>4,진행상태=>3,발주일=>3,수신=>2");
								$this->paging();
								?>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="13" />
<input type="hidden" name="flag" id="flag" value="1" />


<!--간편구매요청서 MODAL-->
<div class="modal fade" id="createObtainOrderModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:1400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">간편구매 요청서</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:735px; overflow:scroll; overflow-x:hidden">
				<form id='frm'>
					<input type="hidden" name="mode" id="mode" value="registEasyOrder" />
					<input type="hidden" name="uid" id="uid" />
					<div>						
						<table class="table table-bordered">
							<tr>
								<th colspan="4" style="background-color:#ccc">간편 구매요청 정보</th>
							</tr>
							<tr>
								<? $this->th("거래처") ?>
								<td><input type="hidden" name="account_cd" id="account_cd" /><input type="text" class="form-control" name="account_nm" id="account_nm" onclick="showModal('accountModal')" readonly /></td>
							</tr>
							<tr>
								<? $this->th("입고 희망일") ?>
								<td>
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="delivery_dt" id="delivery_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="입고희망일을 입력하세요" readonly />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								
							</tr>
						<table>

						<table class="table table-bordered" id="obtain_item_tb">
							<thead>
								<tr>
									<th colspan="12" style="background-color:#ccc"><input type='button' class="btn btn-xs btn-danger" value='품목추가' onclick="showModal('itemModal')" /></th>
								</tr>
								<tr>
								<? $this->th("") ?>
									<? $this->th("품번") ?>
									<? $this->th("품명") ?>
									<? $this->th("규격") ?>
									<? $this->th("단위") ?>
									<? $this->th("수량") ?>
									<? $this->th("구매단가") ?>
									<? $this->th("합계금액") ?>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-info" id="btnSubmit">간편 구매요청</button>
					<button type="button" class="btn btn-sm btn-success" onclick="formClear()">새로고침</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>


<!--발주품목 MODAL-->
<div class="modal fade" id="createObtainOrderModal2" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">발주품목 확인</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:70%; overflow:scroll; overflow-x:hidden">
				<div>						
					<table class="table table-bordered">
						<tr>
							<th colspan="4" style="background-color:#ccc">발주 정보</th>
						</tr>
						<tr>
							<? $this->th("거래처") ?>
							<td><input type="hidden" name="account_cd2" id="account_cd2" /><input type="text" class="form-control" name="account_nm2" id="account_nm2" readonly /></td>
						</tr>
					<table>
					
					<table class="table table-bordered" id="obtain_item_tb2">
						<thead>
							<tr>
								<? $this->th("품번") ?>
								<? $this->th("품명") ?>
								<? //$this->th("규격") ?>
								<? //$this->th("단위") ?>
								<? $this->th("수량") ?>
								<? //$this->th("구매단가") ?>
								<? $this->th("합계금액") ?>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
					<!--
					<table class="table table-bordered" id="obtain_item_tb2">
						<thead>
							<tr>
								<th colspan="12" style="background-color:#ccc">구매 품목</th>
							</tr>
							<tr>
								<? $this->th("품번") ?>
								<? $this->th("품명") ?>
								<? //$this->th("규격") ?>
								<? //$this->th("단위") ?>
								<? $this->th("수량") ?>
								<? //$this->th("구매단가") ?>
								<? $this->th("합계금액") ?>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
					-->
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

<div class="modal fade" id="shipmentItemModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:1000px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">수주품목 리스트</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:510px">
				<? $this->noCheckTable("shipmentItemListTb","품목코드,품목명,규격,단위,수주수량,재고수량"); ?>				
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

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
require_once ("views/modal/accountModal.php");
require_once ("views/modal/itemModal.php");
require_once ("views/modal/employeeModal.php");
?>




<!-- // 우편번호 찾기 ------------------------------------------------------------------------------------------------------->
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
function sample6_execDaumPostcode(obj) {
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
			if(obj == 1) {
				document.getElementById('shipping_address').value = fullAddr;
				document.getElementById('shipping_address').focus();			
			} else {
				document.getElementById('shipment_address').value = fullAddr;
				document.getElementById('shipment_address').focus();	
			}
			
		}
	}).open();
 }
 </script>

<script>

//==================================================
//새로고침.
//==================================================
function refresh() {
	$("#search_classify").val(0);
	$("#search_txt").val("");
	$("#page").val(1);
	$("#where").val("");
	getData(1);
}

//==================================================
//간편구매요청 버튼 눌렀을때 modal 비우고 간편구매요청서 Modal띄우기
//==================================================
function createObtainOrder(){
	$("#uid").val("");
	$("#account_cd").val("");
	$("#account_nm").val("");

	$("#obtain_item_tb tbody").html("");
	
	showModal('createObtainOrderModal');
}

// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

$(document).ready(function(){

	var page = $("#page").val();
	getData(page);
	getItemList();
	getAccountList();
	getEmployeeList();

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

	$("#btnSubmit").click(function(event){
		if(check("frm")) {
			var bool = true;

			if($("#account_cd").val()==""){
				showAlert("거래처를 선택하세요");
				return false;
			}

			if($("#flag").val() == "1") {
				showAlert("구매요청 품목을 선택하세요");
				return false;
			}
			$.each($(".cnt") , function () {
				if($(this).val() == "") {
					showAlert("구매요청 수량을 입력하세요");
					bool = false;
					return false;
				}
			});
			
			if(bool == true){
				//stop submit the form, we will post it manually.
				event.preventDefault();

				// Get form
				var form = $('#frm')[0];

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
					success: function () {
						hideModal('createObtainOrderModal');
						$("#page").val(1);
						getData(1);
						formClear();
						$("#btnSubmit").prop("disabled", false);

					},
					error: function (e) {
						$("#btnSubmit").prop("disabled", false);

					}
				});
			}
		}
	});
});

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
// 모달 선택 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("orders");
	hideModal("confirm-delete");
	formClear();
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#uid").val("");
	$("#obtain_item_tb tbody").html("");
	$("#account_cd").val("");
	$("#account_nm").val("");
	$("#btnSubmit").prop("disabled",false);
	$("#btnSubmit").text("간편 구매요청");
	$("#frm")[0].reset();
}

function shipment_formClear() {
	$("#shipment_frm")[0].reset();
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

	var txt = "where (date(create_dt) between '" + first + "' and '" + second + "')";
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
// 발주리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getOrderList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postData(" + json[i].uid + ",'" + json[i].account_nm + "', '" + json[i].order_cd + "','" + json[i].create_dt + "', '" + json[i].address + "');\" style='cursor:pointer'>";
					/*
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' name='order_uid[]' id='order_uid' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					*/
					tag += "<td>" + json[i].order_cd + "</td>";
					//tag += "<td>" + json[i].account_nm + "</td>";
					tag += "<td>" + json[i].state + "</td>";
					tag += "<td>" + json[i].create_dt + "</td>";
					tag += "<td>" + json[i].send_receive + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "orders";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function postData(uid, account_nm, order_cd, create_dt, address) {
	$("#account_nm2").val(account_nm);

	var tag = "";
	var total_cost = 0;
	var parameter = {"mode" : "getOrdersItem", "uid" : uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {

				tag += "<tr>";
				tag += "<td>" + json[i].item_cd + "</td>";
				tag += "<td>" + json[i].item_nm + "</td>";
				//tag += "<td>" + json[i].standard + "</td>"
				//tag += "<td>" + json[i].unit + "</td>";
				tag += "<td>" + commaSplit(json[i].cnt) + "</td>";
				//tag += "<td>" + commaSplit(json[i].cost) + "</td>";
				tag += "<td>" + commaSplit(json[i].total_cost) + "</td>";
				tag += "</tr>";
			}
			
			$("#obtain_item_tb2 tbody").html(tag);
		} else {
			
		}
	});

	showModal('createObtainOrderModal2');
}

//==================================================
// 선택 거래처 처리
//==================================================
function postAccount(account_cd, account_nm) {
	$("#account_cd").val(account_cd);
	$("#account_nm").val(account_nm);
	$("#obtain_account_cd").val(account_cd);
	$("#obtain_account_nm").val(account_nm);
	hideModal("accountModal");
}

//==================================================
// 선택 아이템 처리
//==================================================
function postItem(item_cd, item_nm, standard, unit) {
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

	var check = item_cd;

	var idx = jQuery.inArray(check, item);
	if(idx >= 0) {
		showAlert("동일 품목을 이미 선택하셨습니다");
	} else {
		tag += "<tr class='item" + flag + "'>";
		tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
		tag += "<td><input type='text' class='form-control item_cd' name='item_cd[]' id='item_cd_" + flag + "'  placeholder='품목선택을 하시려면 클릭하세요' value='" + item_cd + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control item_nm' name='item_nm[]' id='item_nm_" + flag + "' value='" + item_nm + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control standard' name='standard[]' id='standard_" + flag + "' value='" + standard + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + unit + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control cnt' name='cnt[]' id='cnt_" + flag + "' onkeyup='calculation(" + flag + ")' /></td>";
		tag += "<td><input type='text' class='form-control purchase_price' name='purchase_price[]' id='purchase_price_" + flag + "' value='" + 0 + "' onkeyup='calculation(" + flag + ")' /></td>";
		tag += "<td><input type='text' class='form-control total_price' name='total_price[]' id='total_price_" + flag + "' readonly /></td>";
		tag += "</tr>";
		
		$("#obtain_item_tb tbody").append(tag);
		$("#flag").val(Number(flag) + 1);
	}
}


/******************************************************************************************************
:: 부가세 계산 ( 미사용 )
******************************************************************************************************/
// 거래유형 선택에 따른 부가세 계산
function tax_calculation(tax_type){
	var cnt = new Array();
	//var sales_price = new Array();
	var supply_price = new Array();
	var tax = new Array();
	var hap = new Array();
	var rate = new Array();
	var reversion_sales_price = new Array();

	var re_unit_price = new Array();
	var re_supply_price = new Array();
	var re_tax = new Array();
	var total = new Array();
	var values = 0;

	$.each($(".cnt") , function () {
		cnt.push(removeComma($(this).val()));
	});

	$.each($(".purchase_price") , function () {
		purchase_price.push(removeComma($(this).val()));
	});

	$.each($(".rate") , function () {
		rate.push(removeComma($(this).val()));
	});

	$.each($(".reversion_sales_price") , function () {
		reversion_sales_price.push(removeComma($(this).val()));
	});

	$.each($(".supply_price") , function () {
		supply_price.push(removeComma($(this).val()));
	});

	$.each($(".tax") , function () {
		tax.push(removeComma($(this).val()));
	});

	for(var i = 0 ; i < cnt.length ; i++) {
		if(cnt[i] > 0) {
			// 수량 * 판매단가
			//values = Number(removeComma(cnt[i])) * Number(removeComma(unit_price[i]));
			values = Number(removeComma(cnt[i])) * Number(removeComma(reversion_sales_price[i]));

			// 부가세적용
			if(tax_type == 1) {
				// 공급가
				var supply_price = values/1.1;
				// 부가세
				var cal_tax = values-supply_price;
				// 합계금액
				var re_hap = values + cal_tax;
				
				re_unit_price.push(values);
				re_supply_price.push(supply_price);
				re_tax.push(cal_tax);
				total.push(values);
			} else { // 부가세 미적용
				// 공급가
				var supply_price = values;
				// 부가세
				var cal_tax = 0;
				// 합계금액
				var re_hap = values;

				
				re_unit_price.push(values);
				re_supply_price.push(supply_price);
				re_tax.push(cal_tax);
				total.push(values);
			}
		}
	}

	for (var i = 0 ; i < cnt.length ; i++)
	{
		if(removeComma(total[i]) > 0) {
			$(".supply_price").eq(i).val(commaSplit(Math.round(re_supply_price[i])));
			$(".tax").eq(i).val(commaSplit(Math.round(re_tax[i])));
			$(".total_price").eq(i).val(commaSplit(Math.round(total[i])));
		}
	}
}

// 공급가액 계산
function calculation(flag) {
	
	var cnt = Number( removeComma( $("#cnt_" + flag).val() ) );
	var purchase_price = Number( removeComma( $("#purchase_price_" + flag).val() ) );
	var priceSum = cnt * purchase_price;
	$("#total_price_"+flag).val( commaSplit( Math.round(priceSum) ) );
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
// 검색
//==================================================
function search(){
	var type = 1;

	if(type == 1){
		var search_txt = $("#search_txt").val();
		if(search_txt == ""){
			showAlert("검색어를 입력하세요");
			return false;
		}

		$("#where").val("where account_nm like '%" + search_txt + "%' or order_cd like '%" + search_txt + "%' ");
	}
	
	$("#page").val(1);
	getData(1);
}
</script>