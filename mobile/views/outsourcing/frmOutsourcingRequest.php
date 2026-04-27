<?
require_once("library/caseby.php");
$estimate_cd = $this->createCode("estimate_cd","estimate");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<!-- 검색 모달 -->
		<div class="wrap_search_pop">	
			<div class="search_pop_content">
				<div class="input-group">
					<div class="col-xs-12">
						<? $this->periodSearch("searchDate()","납기일자검색"); ?>
						<select name="search_classify" id="search_classify" style="height:35px; width:100%; margin-top:10px;" onchange="setData(this.value)">
							<option value="0">== 검색구분 ==</option>
							<option value="요청">요청</option>
							<option value="발주완료">발주완료</option>
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
					<input type='button' class='comm_title' value='외주요청 리스트' />
					<table class="table table-bordered table-striped" id="tb">
						<thead>
							<tr>
								<th class="detail-col center">
									발주코드
								</th>
								<th class="detail-col center">
									거래처
								</th>
								<th class="detail-col center">
									상태
								</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<? $this->paging() ?>
				</div>
			</div>			
		</div>
	</div>
</div>



<input type="hidden" name="per" id="per" value="10" />
<input type="hidden" name="flag" id="flag" value="1" />
<input type="hidden" name="item_uid" id="item_uid" />


<div class="modal fade" id="createOutsourcingModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:1400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">외주발주</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:735px; overflow:scroll; overflow-x:hidden">
				<form id='outsourcing'>
					<input type="hidden" name="mode" id="mode" value="registOutsourcingItem" />
					<input type="hidden" name="uid" id="uid" />
					<input type="text" name="in_item_process" id="in_item_process" />

					<div>						
						<table class="table table-bordered">
							<tr>
								<th colspan="4" style="background-color:#ccc">발주 품목정보</th>
							</tr>
							<tr>
								<? $this->th("요청품번") ?>
								<td><input type="text" class="form-control" name="item_cd" id="item_cd" validation="yes" err="품번을 입력하세요" readonly /></td>
								<? $this->th("요청품명") ?>
								<td><input type="text" class="form-control" name="item_nm" id="item_nm" validation="yes" err="품명을 입력하세요" readonly /></td>
							</tr>
							<tr>
								<? $this->th("요청규격") ?>
								<td><input type="text" class="form-control" name="standard" id="standard" /></td>
								<? $this->th("요청수량/단위") ?>
								<td>
									<input type="text" name="cnt" id="cnt" />
									<select name="unit" id="unit">
										<option value="m">m</option>
										<option value="ea">ea</option>
										<option value="매">매</option>
										<option value="kg">kg</option>
									</select>
								</td>
							</tr>
							<tr>
								<? $this->th("요청공정") ?>
								<td><input type="hidden" name="process_cd" id="process_cd" /><input type="text" class="form-control" name="process_nm" id="process_nm" readonly /></td>
								<? $this->th("다음공정") ?>
								<td><input type="hidden" name="after_process_cd" id="after_process_cd" /><input type="text" name="after_process_nm" id="after_process_nm" readonly /></td>
							</tr>
							<tr>
								<? $this->th("납기일") ?>
								<td style='vertical-align:middle'>
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="delivery_dt" id="delivery_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="납품일을 입력하세요" readonly />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<? $this->th("요청메모") ?>
								<td><textarea class="form-control" rows="2" name="memo" id="memo"></textarea></td>
							</tr>
							<tr>
								<? $this->th("외주업체") ?>
								<td>
									<select name="outsourcing_account" id="outsourcing_account"> <!-- 연암 요청으로 숨김 onchange="getBringMaterial(this.value)">-->
									</select>
								</td>
								<? $this->th("납품업체") ?>
								<td>
									<select name="supplier" id="supplier">
									</select>
								</td>
							</tr>
							<tr>
								<? $this->th("발주메모") ?>
								<td><textarea class="form-control" rows="3" name="outsourcing_memo" id="outsourcing_memo"></textarea></td>
								<? $this->th("바코드") ?>
								<td><textarea class="form-control" rows="3" name="barcode" id="barcode"></textarea></td>
							</tr>
						<table>

						<table class="table table-bordered" id="bring_material_tb">
							<thead>
								<tr>
									<th colspan="12" style="background-color:#ccc">사급자재 구매요청 <input type='button' class="btn btn-xs btn-danger" value='품목추가' onclick="showModal('itemModal')" /></th>
								</tr>
								<tr>
								<? $this->th("") ?>
									<? $this->th("품번") ?>
									<? $this->th("품명") ?>
									<? $this->th("규격") ?>
									<? $this->th("단위") ?>
									<? $this->th("수량") ?>
									<? $this->th("입고희망일") ?>
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
					<button type="button" class="btn btn-sm btn-primary" id="btnSubmit">외주발주 및 구매요청 등록</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 상세보기 -->
<div class="modal fade" id="viewOursourcingRequestModal" data-backdrop="static" data-keyboard="false">
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
					<?$this->noCheckTable("tb2","품번,품명,규격,수량,요청일")?>
					

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
$this->hidden(" where status='외주발주'");
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
function refresh(){
	$("#uid").val("");
	$("#where").val("");
	$("#page").val(1);
	$("#search_classify").val(0);
	$("#search_txt").val("");
	$("#btnSubmit").text("견적등록");
	formClear();
	getData(1);
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
	getSupplier();

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
		//stop submit the form, we will post it manually.
		event.preventDefault();

		// Get form
		var form = $('#outsourcing')[0];

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
				hideModal('createOutsourcingModal');
				$("#page").val(1);
				getData(1);
				formClear();
				$("#btnSubmit").prop("disabled", false);

			},
			error: function (e) {
				$("#btnSubmit").prop("disabled", false);

			}
		});
	});
});

function getOutsourcingAccount(item_uid){
	//var parameter = {"mode" : "getOutsourcingItemAccountList", "item_uid" : item_uid};
	var parameter = {"mode" : "getOutsourcingAccountList", "item_uid" : item_uid};
	var tag = "<option value='0'>==선택==</option>";

	$.getJSON("ajax.php",{"parameter" : parameter}, function(json){
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<option value='" + json[i].account_uid + "'>" + json[i].account_nm + "</option>";
			}

			$("#outsourcing_account").html(tag);
		}
	});
}

function getSupplier(){
	var parameter = {"mode" : "getOutsourcingAccountList"};
	var tag = "<option value='0'>본사</option>";

	$.getJSON("ajax.php",{"parameter" : parameter}, function(json){
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<option value='" + json[i].account_uid + "'>" + json[i].account_nm + "</option>";
			}
			$("#supplier").html(tag);
		}
	});
}

function registOutsourcing(){
	if($("#uid").val() == ""){
		showAlert("외주발주 하실 요청을 선택하세요");
		return false;
	}

	var parameter = {"mode" : "getOutsourcingRequest", "uid" : $("#uid").val()};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json){
		if(json != null){
			$("#item_cd").val(json.item_cd);
			$("#item_nm").val(json.item_nm);
			$("#standard").val(json.standard);
			$("#cnt").val(json.cnt);
			$("#unit").val(json.unit);
			$("#process_cd").val(json.process_cd);
			$("#process_nm").val(json.process_nm);
			$("#after_process_cd").val(json.after_process_cd);
			$("#after_process_nm").val(json.after_process_nm);
			$("#delivery_dt").val(json.delivery_dt);
			$("#memo").val(json.memo);
			$("#item_uid").val(json.item_uid);
			$("#in_item_process").val(json.in_item_process);

			getOutsourcingAccount(json.item_uid);		
			
			// 연암 요구사항...그냥 품목공정의 투입자재를 뿌려달라
			getBringMaterial();



			createLotNo(json.item_cd, json.process_cd);
		}
	});

	showModal("createOutsourcingModal");
}

function createLotNo(item_cd, process){
	var parameter = {"mode" : "createLotNo", "type" : "P", "item_cd" : item_cd, "process" : process};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			$("#barcode").val(str);
		}
	});
}


function getBringMaterial() {
	//alert(account_uid);
	// 사급자재 리스트
	var parameter = {"mode" : "getBringinMaterial", "in_item_process" : $("#in_item_process").val()};
	var tag = "";

	$.getJSON("ajax.php",{"parameter" : parameter}, function(json){
		if(json != null){
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr>";
				tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
				tag += "<td><input type='text' name='purchase_item_cd[]' id='purchase_item_cd' value='" + json[i].item_cd + "' /></td>";
				tag += "<td><input type='text' name='purchase_item_nm[]' id='purchase_item_nm' value='" + json[i].item_nm + "' /></td>";
				tag += "<td><input type='text' name='purchase_standard[]' id='purchase_standard' value='" + json[i].standard + "' /></td>";
				tag += "<td><input type='text' name='purchase_unit[]' id='purchase_unit' value='" + json[i].unit + "' /></td>";
				tag += "<td><input type='text' name='purchase_cnt[]' id='purchase_cnt' /></td>";
				tag += "<td>";
				tag += "<span class='input-icon input-icon-right'>";
				tag += "<div class='input-group'>";
				tag += "<input class=' date-picker' name='purchase_delivery_dt[]' id='purchase_delivery_dt' type='text' data-date-format='yyyy-mm-dd' />";
				tag += "<span class='input-group-addon'>";
				tag += "<i class='fa fa-calendar bigger-110'></i>";
				tag += "</span>";
				tag += "</div>";
				tag += "</span>";
				tag += "</td>";					
				tag += "</tr>";
			}				
		} else {
			tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#bring_material_tb tbody").html(tag);
			$('.date-picker').datepicker({
				autoclose: true,
				todayHighlight: true
		})
		.next().on(fa.click_event, function(){
			$(this).prev().focus();
		});
	});
}

// 연암 요구사항으로 주석처리
//function getBringMaterial(account_uid) {
//	var parameter = {"mode" : "getBringinMaterial", "item_uid" : $("#item_uid").val(), "account_uid" : account_uid, "in_item_process" : $("#in_item_process").val()};
//	var tag = "";
//
//	$.getJSON("ajax.php",{"parameter" : parameter}, function(json){
//		if(json != null){
//			for(var i = 0 ; i < json.length ; i++){
//				tag += "<tr>";
//				tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
//				tag += "<td><input type='text' name='purchase_item_cd[]' id='purchase_item_cd' value='" + json[i].item_cd + "' /></td>";
//				tag += "<td><input type='text' name='purchase_item_nm[]' id='purchase_item_nm' value='" + json[i].item_nm + "' /></td>";
//				tag += "<td><input type='text' name='purchase_standard[]' id='purchase_standard' value='" + json[i].standard + "' /></td>";
//				tag += "<td><input type='text' name='purchase_unit[]' id='purchase_unit' value='" + json[i].unit + "' /></td>";
//				tag += "<td><input type='text' name='purchase_cnt[]' id='purchase_cnt' /></td>";
//				tag += "<td>";
//				tag += "<span class='input-icon input-icon-right'>";
//				tag += "<div class='input-group'>";
//				tag += "<input class=' date-picker' name='purchase_delivery_dt[]' id='purchase_delivery_dt' type='text' data-date-format='yyyy-mm-dd' />";
//				tag += "<span class='input-group-addon'>";
//				tag += "<i class='fa fa-calendar bigger-110'></i>";
//				tag += "</span>";
//				tag += "</div>";
//				tag += "</span>";
//				tag += "</td>";					
//				tag += "</tr>";
//			}
//
//			$("#bring_material_tb tbody").html(tag);
//				$('.date-picker').datepicker({
//					autoclose: true,
//					todayHighlight: true
//			})
//			.next().on(fa.click_event, function(){
//				$(this).prev().focus();
//			});					
//		}
//	});
//}


/******************************************************************************************************
:: 부가세 계산
******************************************************************************************************/
// 거래유형 선택에 따른 부가세 계산
function tax_calculation(tax_type){
	var cnt = new Array();
	var sales_price = new Array();
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

	$.each($(".sales_price") , function () {
		sales_price.push(removeComma($(this).val()));
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
	var tax_type = $("#use_tax option:selected").val();
	var cnt = $("#cnt_" + flag).val();
	var unit_price = removeComma($("#sales_price_" + flag).val());
	var rate = $("#rate_" + flag).val();
	var reversion_sales_price = Number(unit_price) * Number(rate);
	//var values = Number(removeComma(cnt)) * Number(removeComma(unit_price));
	var values = Number(removeComma(cnt)) * Number(removeComma(reversion_sales_price));

	$("#reversion_sales_price_" + flag).val(commaSplit(reversion_sales_price));

	// 부가세적용
	if(tax_type == "y") {
		var supply_price = values/1.1;
		var tax = values-supply_price;
		$("#supply_price_" + flag).val(commaSplit(Math.round(supply_price)));
		$("#total_price_" + flag).val(commaSplit(Math.round(values)));
	} else {
		var tax = 0;
		$("#supply_price_" + flag).val(commaSplit(Math.round(values)));
		$("#total_price_" + flag).val(commaSplit(Math.round(values + tax)));
	}
	$("#tax_" + flag).val(commaSplit(Math.round(tax)));
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
	//formClear();
	//$("#uid").val("");
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("outsourcing_request");
	hideModal("confirm-delete");
	$("#page").val(1);
	getData(1);
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
	var txt = "where (date(delivery_dt) between '" + first + "' and '" + second + "')";
	$("#where").val(txt);
	getData(1);
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#account_where").val("");
	$("#account_page").val(1);
	$("#employee_where").val("");
	$("#employee_page").val(1);
	$("#project_where").val("");
	$("#project_page").val(1);
	$("#item_where").val("");
	$("#item_page").val(1);
	$("#uid").val("");
	$("#btnSubmit").text("외주발주 및 구매요청 등록");
	$("#btnSubmit").prop("disabled",false);
	$("#frm")[0].reset();
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
// 견적서리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getOursourcingRequestList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					/*
					if(json[i].state == "요청") {
						tag += "<tr onclick=\"toggle(this); postUid(" + json[i].uid + ");\" style='cursor:pointer'>";
					} else {
						tag += "<tr onclick=\"toggle(this);\" style='cursor:pointer'>";
					}

					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";

					if(json[i].state == "요청") {
						tag += "<label class='pos-rel'>";
						tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
						tag += "<span class='lbl'></span>";
						tag += "</label>";
					}
					
					tag += "</td>";
					<?}?>
					*/
					tag += "<tr onclick='toggle(this); postData(" + json[i].uid + ");' style='cursor:pointer'>";
					//tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].order_cd + "</td>";
					//tag += "<td>" + json[i].standard + "</td>";
					//tag += "<td>" + json[i].unit + "</td>";
					//tag += "<td>" + json[i].process_nm + "</td>";
					tag += "<td style=''>" + json[i].account_nm + "</td>";
					//tag += "<td>" + json[i].after_process_nm + "</td>";
					//tag += "<td>" + json[i].delivery_dt + "</td>";
					//tag += "<td>" + json[i].memo + "</td>";
					//tag += "<td>" + json[i].create_dt + "</td>";
					tag += "<td>" + json[i].status + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='12' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "outsourcing_request";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

function postData(uid) {
	var tag = "";
	$("#uid").val(uid);
	var parameter = {"mode" : "getOutsourcingRequest2", "uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i=0; i<json.length;i++){
				tag += "<tr>";
				tag += "<td>" + json[i].item_cd + "</td>";
				tag += "<td>" + json[i].item_nm + "</td>";
				tag += "<td>" + json[i].standard + "</td>";
				tag += "<td>" + json[i].cnt + "</td>";
				tag += "<td>" + json[i].create_dt + "</td>";
				
				tag += "</tr>";

			}
		}else{

		}
		$("#tb2 tbody").html(tag);
	});
	showModal('viewOursourcingRequestModal');
}

function postUid(uid){
	$("#uid").val(uid);
}


//==================================================
// 선택 사원 처리
//==================================================
function postEmployee(emp_id, emp_nm) {
	$("#sales_emp_id").val(emp_id);
	$("#sales_emp_nm").val(emp_nm);
	hideModal("employeeModal");
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
// 선택 프로젝트 처리
//==================================================
function postProject(uid, project_nm) {
	$("#project_cd").val(uid);
	$("#project_nm").val(project_nm);
	hideModal("projectModal");
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
		if(search_txt == "") {
			showAlert("검색어를 입력하세요");
			return false;
		}

		$("#where").val("where item_cd like '@" + search_txt + "@' or item_nm like '@" + search_txt + "@' or account_cd like '@" + search_txt + "@' or account_nm like '@" + search_txt + "@'");
	} else {
		var search_classify = $("#search_classify option:selected").val();
		var search_txt = $("#search_txt").val();

		if(search_classify == 0){
			showAlert("검색구분을 선택하세요");
			return false;
		}

		if(search_txt == "") {
			showAlert("검색어를 입력하세요");
			return false;
		}

		$("#where").val(" where state='" + search_classify + "' and (item_cd like '@" + search_txt + "@' or item_nm like '@" + search_txt + "@' or account_cd like '@" + search_txt + "@' or account_nm like '@" + search_txt + "@')");
	}

	$("#page").val(1);
	getData(1);
}

function setData(state) {
	if(state == 0) {
		$("#where").val("");
	} else {
		$("#where").val("where state='" + state + "'");
	}

	$("#page").val(1);
	getData(1);
}

//검색
$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1)
	})
})
</script>