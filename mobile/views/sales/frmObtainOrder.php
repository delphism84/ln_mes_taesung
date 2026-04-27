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
						<? $this->periodSearch("searchDate()","수주일자검색"); ?><br>
						<!-- <select name="search_classify" id="search_classify" style="height:35px; margin-left:5px">
							<option value="0">선택</option>
							<option value="item_cd">품번</option>
							<option value="item_nm">품명</option>
							<option value="account_nm">거래처</option>
						</select>-->
					</div>
					<div class="col-xs-12">
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
						
						<?
						if($_SESSION['login_level'] >= 99) {
							echo "<div style='float:left; text-align:left;'>";							
							echo "</div>";
							echo "<div style='float:right; text-align:right'>";
							//echo "<input type='button' class='btn btn-xs btn-success' value='출하지시' onclick='showShipment()' />";
							//echo "<input type='button' class='btn btn-xs btn-danger' value='선택삭제' data-toggle='modal' data-target='#confirm-delete' style='margin-left:3px' />";
							//echo "<input type='button' class='btn btn-xs btn-primary' value='수주등록' style='margin-left:3px' onclick='createObtainOrder()' />";
							echo "</div>";							
						} else {
							echo "<div style='float:left; text-align:left'>";
							echo "<input type='button' class='btn btn-xs btn-pink' value='수주 리스트' />";
							echo "</div>";
							echo "<div style='float:right; text-align:right'>";
							echo "<input type='button' class='btn btn-xs btn-primary' value='수주전환' onclick='changeOrder()' />";
							echo "<input type='button' class='btn btn-xs btn-primary' value='수주등록' style='margin-left:3px' onclick='createObtainOrder()' />";
							echo "</div>";
						
							
						}
						?>
						<!--
						<?
						$this->noCheckTable("tb","수주코드,거래처,수주품목,수주금액,수주일자,납기일자,출하일자,납기경과일,상태,관리");
						?>
						-->		
						<input type='button' class='comm_title' value='수주 리스트' />
						<table class="table table-bordered table-striped" id="tb">
							<thead>
								<tr>
									<th class="detail-col center">
										거래처
									</th>
									<th class="detail-col center">
										수주품목
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


<div class="modal fade" id="createObtainOrderModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">수주서</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form id='frm'>
					<input type="hidden" name="mode" id="mode" value="registObtainOrder" />
					<input type="hidden" name="uid" id="uid" />
					<input type="hidden" name="estimate_cd" id="estimate_cd" />
					<input type="hidden" name="estimate_dt" id="estimate_dt" />
					<div>						
						<table class="table table-bordered">
							<tr>
								<th colspan="4" style="background-color:#ccc">수주정보</th>
							</tr>
							<tr>
								<? $this->th("수주번호") ?>
								<td><input type="text" name="order_cd" id="order_cd" value="<?=$order_cd?>" validation="yes" err="수주번호를 입력하세요" /></td>
								<? $this->th("수주일") ?>
								<td>
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="order_dt" id="order_dt" type="text" value="<?=date("Y-m-d");?>" data-date-format="yyyy-mm-dd" validation="yes" err="수주일을 입력하세요" readonly />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<? $this->th("거래처") ?>
								<td><input type="hidden" name="account_cd" id="account_cd" /><input type="text" class="form-control" name="account_nm" id="account_nm" onclick="showModal('accountModal')" readonly /></td>
								<? $this->th("영업사원") ?>
								<td><input type="hidden" name="sales_emp_id" id="sales_emp_id" /><input type="text" name="sales_emp_nm" id="sales_emp_nm" onclick="showModal('employeeModal')" readonly /></td>
							</tr>
							<tr>
								<? $this->th("부가세적용") ?>
								<td>
									<select name="use_tax" id="use_tax">
										<option value="y">적용</option>
										<option value="n">미적용</option>
									</select>
								</td>
								<? $this->th("납품기한") ?>
								<td>
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="delivery_dt" id="delivery_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="납품기한을 입력하세요" readonly />
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
								<td colspan="3"><textarea class="form-control" name="shipping_address" id="shipping_address" onclick="sample6_execDaumPostcode(1)"></textarea></td>
							</tr>
						<table>

						<table class="table table-bordered" id="obtain_item_tb">
							<thead>
								<tr>
									<th colspan="12" style="background-color:#ccc">수주품목 <input type='button' class="btn btn-xs btn-danger" value='품목추가' onclick="showModal('itemModal')" /></th>
								</tr>
								<tr>
								<? $this->th("") ?>
									<? $this->th("품번") ?>
									<? $this->th("품명") ?>
									<? $this->th("규격") ?>
									<? $this->th("단위") ?>
									<? $this->th("수량") ?>
									<? $this->th("판매단가") ?>
									<? $this->th("요율") ?>
									<? $this->th("조정단가") ?>
									<? $this->th("공급가액") ?>
									<? $this->th("부가세") ?>
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
					<button type="button" class="btn btn-sm btn-info" id="btnSubmit">수주등록</button>
					<button type="button" class="btn btn-sm btn-success" onclick="formClear()">새로고침</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- 상세보기 -->
<div class="modal fade" id="viewObtainOrderModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">상세보기</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<div>						
					<table class="table table-bordered">
						<tr>
							<th colspan="4" style="background-color:#ccc">수주정보</th>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>수주번호</th>
							<td><span id="s_order_cd"></span></td>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>수주일</th>
							<td><span id="s_order_dt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>거래처</th>
							<td><span id="s_account_nm"></span></td>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>영업사원</th>
							<td><span id="s_sales_emp_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>납품기한</th>
							<td><span id="s_delivery_dt"></span></td>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>배송지</th>
							<td><span id="s_shipping_address"></span></td>
						</tr>
					<table>
					<table class="table table-bordered" id="v_obtain_item_tb">
						<thead>
							<tr>
								<th colspan="12" style="background-color:#ccc">수주품목</th>
							</tr>
							<tr>
								<? $this->th("품번") ?>
								<? $this->th("품명") ?>
								<!--
								<? $this->th("규격") ?>
								<? $this->th("단위") ?>
								-->
								<? $this->th("수량") ?>
								<!--
								<? $this->th("판매단가") ?>
								<? $this->th("요율") ?>
								<? $this->th("조정단가") ?>
								<? $this->th("공급가액") ?>
								<? $this->th("부가세") ?>
								-->
								<? $this->th("합계금액") ?>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
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
<!-- //상세보기 -->




<div class="modal fade" id="shipmentModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">출하지시서</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form name="shipment_frm" id="shipment_frm">
					<input type="hidden" name="mode" id="mode" value="registShipment" />
					<table class="table table-bordered">
						<tr>
							<? $this->th("수주번호") ?>
							<td><input type="text" class="form-control" name="shipment_order_cd" id="shipment_order_cd" /></td>
							<? $this->th("거래처") ?>
							<td><input type="hidden" class="form-control" name="shipment_account_cd" id="shipment_account_cd" /><input type="text" name="shipment_account_nm" id="shipment_account_nm" onclick="showModal('accountModal')" /></td>
						</tr>
						<tr>
							<? $this->th("납기일") ?>
							<td>
								<div>
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class=" date-picker" name="shipment_delivery_dt" id="shipment_delivery_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="상차일을 입력하세요" readonly />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</div>
							</td>
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


<div class="modal fade" id="shipmentItemModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">수주품목 리스트</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
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
function refresh() {
	$("#search_classify").val(0);
	$("#search_txt").val("");
	$("#page").val(1);
	$("#where").val("");
	getData(1);
}

function createObtainOrder(){
	$("#uid").val("");
	$("#estimate_cd").val("");
	$("#estimate_dt").val("");
	$("#order_cd").val("<?=$order_cd?>");
	$("#order_dt").val("<?=date('Y-m-d')?>");
	$("#account_cd").val("");
	$("#account_nm").val("");
	$("#sales_emp_id").val("");
	$("#sales_emp_nm").val("");
	$("#delivery_dt").val("");
	$("#shipping_address").val("");
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

	// 출하지시
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

	$("#btnSubmit").click(function(event){
		if(check("frm")) {
			var bool = true;
			
			if($("#flag").val() == "1") {
				showAlert("수주품목을 선택하세요");
				return false;
			}
			$.each($(".cnt") , function () {
				if($(this).val() == "") {
					showAlert("수주수량을 입력하세요");
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
					success: function (data) {
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
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("obtain_order");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#uid").val("");
	$("#order_cd").val("");
	$("#obtain_item_tb tbody").html("");
	$("#account_cd").val("");
	$("#account_nm").val("");
	$("#sales_emp_id").val("");
	$("#sales_emp_nm").val("");
	$("#delivery_dt").val("");
	$("#shipping_address").val("");
	$("#btnSubmit").prop("disabled",false);
	$("#btnSubmit").text("수주등록");
	$("#frm")[0].reset();
}

function shipment_formClear() {
	$("#shipment_frm")[0].reset();
}
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

	var txt = "where (date(order_dt) between '" + first + "' and '" + second + "')";
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
	var parameter = {"mode" : "getObtainOrderList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick='toggle(this); viewObtainOrder(" + json[i].uid + ");' style='cursor:pointer'>";
					/*
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'  style='vertical-align:middle'>";
					if(json[i].state == "수주") {
						tag += "<label class='pos-rel'>";
						tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
						tag += "<span class='lbl'></span>";
						tag += "</label>";
					}
					tag += "</td>";
					<?}?>
					*/
					//tag += "<td style='vertical-align:middle'>" + json[i].order_cd + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].account_nm + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].item_nm + "</td>";					
					//tag += "<td style='text-align:right; vertical-align:middle'>" + comma(json[i].total_price) + "</td>";
					//tag += "<td style='vertical-align:middle'>" + json[i].order_dt + "</td>";
					//tag += "<td style='vertical-align:middle'>" + json[i].delivery_dt + "</td>";					
					//tag += "<td style='vertical-align:middle'>" + json[i].shipment_dt + "</td>";

					if(json[i].interval >= 0) var color = "blue";
					else var color = "red";

					//tag += "<td style='vertical-align:middle; color:" + color + "'>" + json[i].interval + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].state + "</td>";
					/*
					if(json[i].state == "수주") {
						tag += "<td style='vertical-align:middle'><input type='button' class='btn btn-xs btn-primary' onclick='viewObtainOrder(" + json[i].uid + ")' value='보기' /> <input type='button' class='btn btn-xs btn-inverse' value='수정' onclick='modifyObtainOrder(" + json[i].uid + ")' /> <input type='button' class='btn btn-xs btn-success' value='재수주' onclick='reOrder(" + json[i].uid + ")' /></td>";
					} else {
						tag += "<td style='vertical-align:middle'><input type='button' class='btn btn-xs btn-primary' onclick='viewObtainOrder(" + json[i].uid + ")' value='보기' /> <input type='button' class='btn btn-xs btn-success' value='재수주' onclick='reOrder(" + json[i].uid + ")' /></td>";
					}
					*/
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='12' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "obtain_order";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

function postUid(uid){
	$("#uid").val(uid);

	var parameter = {"mode" : "getObtainOrder", "uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json){
		if(json != null){
			$("#shipment_order_cd").val(json.order_cd);
			$("#shipment_account_cd").val(json.account_cd);
			$("#shipment_account_nm").val(json.account_nm);
			$("#shipment_delivery_dt").val(json.delivery_dt);
			$("#shipment_address").val(json.shipping_address);						
		}
	});

	var parameter = {"mode" : "getObtainOrderItemList", "uid" : uid};
	var tag1 = "";
	$.getJSON("ajax.php",{"parameter" : parameter},function(json){
		if(json != null){
			for(var i = 0 ; i < json.length ; i++){
				tag1 += "<tr>";
				tag1 += "<td><input type='text' name='shipment_item_cd[]' value='" + json[i].item_cd + "' style='width:200px' readonly /></td>";
				tag1 += "<td><input type='text' class='form-control' name='shipment_item_nm[]' value='" + json[i].item_nm + "' readonly /></td>";
				tag1 += "<td><input type='text' name='shipment_standard[]' value='" + json[i].standard + "' style='width:150px' readonly /></td>";
				tag1 += "<td><input type='text' name='shipment_unit[]' value='" + json[i].unit + "' style='width:100px' readonly /></td>";
				tag1 += "<td><input type='text' value='" + json[i].stock_cnt + "' style='width:100px' readonly /></td>";
				tag1 += "<td><input type='text' name='shipment_cnt[]' value='" + json[i].cnt + "' style='width:100px' /></td>";
				tag1 += "</tr>";
			}

			$("#shipment_item tbody").html(tag1);
		}
	});

	var parameter = {"mode" : "getObtainOrderItemList", "uid" : uid};
	var tag = "";
	$.getJSON("ajax.php",{"parameter" : parameter},function(json){
		if(json != null){
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr onclick=\"postProduct('" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].unit + "', " + json[i].cnt + ");\" style='cursor:pointer'>";
				tag += "<td>" + json[i].item_cd + "</td>";
				tag += "<td>" + json[i].item_nm + "</td>";
				tag += "<td>" + json[i].standard + "</td>";
				tag += "<td>" + json[i].unit + "</td>";
				tag += "<td>" + json[i].cnt + "</td>";
				tag += "<td>" + json[i].stock_cnt + "</td>";
				tag += "</tr>";
			}

			$("#shipmentItemListTb tbody").html(tag);
		}
	});
}

function postProduct(item_cd, item_nm, standard, unit, cnt){
	$("#shipment_item_cd").val(item_cd);
	$("#shipment_item_nm").val(item_nm);
	$("#shipment_standard").val(standard);
	$("#shipment_unit").val(unit);
	$("#shipment_cnt").val(cnt);
	hideModal('shipmentItemModal');
}

// 견적서 보기
function viewObtainOrder(uid){
	var parameter = {"mode" : "getObtainOrder", "uid" : uid};
	$.getJSON("ajax.php",{"parameter":parameter},function(json) {
		if(json != null) {			
			$("#s_estimate_cd").html(json.estimate_cd);
			$("#s_estimate_dt").html(json.estimate_dt);		
			$("#s_order_cd").html(json.order_cd);
			$("#s_order_dt").html(json.order_dt);	
			$("#s_account_nm").html(json.account_nm);			
			$("#s_sales_emp_nm").html(json.sales_emp_nm);
			$("#s_delivery_dt").html(json.delivery_dt);
			$("#s_shipping_address").html(json.shipping_address);
			//$("#state").val(json.state);

			var parameter = {"mode" : "getObtainOrderItemList", "uid" : uid};
			var tag = "";
			$.getJSON("ajax.php", {"parameter" : parameter}, function(json){
				if(json != null) {
					for(var i = 0 ; i < json.length ; i++){
						tag += "<tr class='item" + flag + "'>";

						tag += "<td>" + json[i].item_cd + "</td>";
						tag += "<td>" + json[i].item_nm + "</td>";
						//tag += "<td>" + json[i].standard + "</td>";
						//tag += "<td>" + json[i].unit + "</td>";
						tag += "<td style='text-align:right;'>" + comma(json[i].cnt) + "</td>";
						//tag += "<td>" + json[i].sales_price + "</td>";
						//tag += "<td>" + json[i].rate + "</td>";
						//tag += "<td>" + json[i].reversion_sales_price + "</td>";
						//tag += "<td>" + json[i].supply_price + "</td>";
						//tag += "<td>" + json[i].tax + "</td>";
						tag += "<td style='text-align:right;'>" + comma(json[i].total_price) + "</td>";
						tag += "</tr>";
					}

					$("#v_obtain_item_tb tbody").html(tag);
				}
			});
			showModal('viewObtainOrderModal');
		}
	});
}

// 견적서 수정
function modifyObtainOrder(uid){
	var parameter = {"mode" : "getObtainOrder", "uid" : uid};
	$.getJSON("ajax.php",{"parameter":parameter},function(json) {
		if(json != null) {
			$("#uid").val(uid);
			$("#estimate_cd").val(json.estimate_cd);
			$("#estimate_dt").val(json.estimate_dt);
			$("#order_cd").val(json.order_cd);
			$("#order_dt").val(json.order_dt);
			$("#account_cd").val(json.account_cd);
			$("#account_nm").val(json.account_nm);
			$("#sales_emp_id").val(json.sales_emp_id);
			$("#sales_emp_nm").val(json.sales_emp_nm);
			$("#delivery_dt").val(json.delivery_dt);
			$("#shipping_address").val(json.shipping_address);
			//$("#state").val(json.state);

			var parameter = {"mode" : "getObtainOrderItemList", "uid" : uid};
			var tag = "";
			var flag = $("#flag").val();
			$.getJSON("ajax.php", {"parameter" : parameter}, function(json){
				if(json != null) {
					for(var i = 0 ; i < json.length ; i++){
						tag += "<tr class='item" + flag + "'>";
						tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
						tag += "<td><input type='text' class='form-control item_cd' name='item_cd[]' id='item_cd_" + flag + "'  placeholder='품목선택을 하시려면 클릭하세요' value='" + json[i].item_cd + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control item_nm' name='item_nm[]' id='item_nm_" + flag + "' value='" + json[i].item_nm + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control standard' name='standard[]' id='standard_" + flag + "' value='" + json[i].standard + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + json[i].unit + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control cnt' name='cnt[]' id='cnt_" + flag + "' onkeyup='calculation(" + flag + ")' value='" + json[i].cnt + "' /></td>";
						tag += "<td><input type='text' class='form-control sales_price' name='sales_price[]' id='sales_price_" + flag + "' value='" + json[i].sales_price + "' onkeyup='calculation(" + flag + ")' /></td>";
						tag += "<td><input type='text' class='form-control rate' name='rate[]' id='rate_" + flag + "' value='" + json[i].rate + "' onkeyup='calculation(" + flag + ")' /></td>";
						tag += "<td><input type='text' class='form-control reversion_sales_price' name='reversion_sales_price[]' id='reversion_sales_price_" + flag + "' value='" + json[i].reversion_sales_price + "' onkeyup='calculation(" + flag + ")' /></td>";
						tag += "<td><input type='text' class='form-control supply_price' name='supply_price[]' id='supply_price_" + flag + "' value='" + json[i].supply_price + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control tax' name='tax[]' id='tax_" + flag + "' value='" + json[i].tax + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control total_price' name='total_price[]' id='total_price_" + flag + "' value='" + json[i].total_price + "' readonly /></td>";
						tag += "</tr>";

						flag++;
					}
					
					
					$("#obtain_item_tb tbody").html(tag);
					$("#flag").val(flag);

					showModal('createObtainOrderModal');
				}
			});			
		}
	});
}

// 견적서 수정
function reOrder(uid){
	var parameter = {"mode" : "getObtainOrder", "uid" : uid};
	$.getJSON("ajax.php",{"parameter":parameter},function(json) {
		if(json != null) {
			$("#estimate_cd").val(json.estimate_cd);
			$("#estimate_dt").val(json.estimate_dt);
			$("#order_cd").val(json.order_cd);
			$("#order_dt").val(json.order_dt);
			$("#account_cd").val(json.account_cd);
			$("#account_nm").val(json.account_nm);
			$("#sales_emp_id").val(json.sales_emp_id);
			$("#sales_emp_nm").val(json.sales_emp_nm);
			$("#delivery_dt").val(json.delivery_dt);
			$("#shipping_address").val(json.shipping_address);
			//$("#state").val(json.state);

			var parameter = {"mode" : "getObtainOrderItemList", "uid" : uid};
			var tag = "";
			var flag = $("#flag").val();
			$.getJSON("ajax.php", {"parameter" : parameter}, function(json){
				if(json != null) {
					for(var i = 0 ; i < json.length ; i++){
						tag += "<tr class='item" + flag + "'>";
						tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
						tag += "<td><input type='text' class='form-control item_cd' name='item_cd[]' id='item_cd_" + flag + "'  placeholder='품목선택을 하시려면 클릭하세요' value='" + json[i].item_cd + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control item_nm' name='item_nm[]' id='item_nm_" + flag + "' value='" + json[i].item_nm + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control standard' name='standard[]' id='standard_" + flag + "' value='" + json[i].standard + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + json[i].unit + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control cnt' name='cnt[]' id='cnt_" + flag + "' onkeyup='calculation(" + flag + ")' value='" + json[i].cnt + "' /></td>";
						tag += "<td><input type='text' class='form-control sales_price' name='sales_price[]' id='sales_price_" + flag + "' value='" + json[i].sales_price + "' onkeyup='calculation(" + flag + ")' /></td>";
						tag += "<td><input type='text' class='form-control rate' name='rate[]' id='rate_" + flag + "' value='" + json[i].rate + "' onkeyup='calculation(" + flag + ")' /></td>";
						tag += "<td><input type='text' class='form-control reversion_sales_price' name='reversion_sales_price[]' id='reversion_sales_price_" + flag + "' value='" + json[i].reversion_sales_price + "' onkeyup='calculation(" + flag + ")' /></td>";
						tag += "<td><input type='text' class='form-control supply_price' name='supply_price[]' id='supply_price_" + flag + "' value='" + json[i].supply_price + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control tax' name='tax[]' id='tax_" + flag + "' value='" + json[i].tax + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control total_price' name='total_price[]' id='total_price_" + flag + "' value='" + json[i].total_price + "' readonly /></td>";
						tag += "</tr>";

						flag++;
					}
					
					
					$("#obtain_item_tb tbody").html(tag);
					$("#flag").val(flag);

					showModal('createObtainOrderModal');
				}
			});			
		}
	});
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
				tag += "<td><input type='text' class='form-control item_cd' name='item_cd[]' id='item_cd_" + flag + "' value='" + json.item_cd + "' readonly /></td>";
				tag += "<td><input type='text' class='form-control item_nm' name='item_nm[]' id='item_nm_" + flag + "' value='" + json.item_nm + "' readonly /></td>";
				tag += "<td><input type='text' class='form-control standard' name='standard[]' id='standard_" + flag + "' value='" + json.standard + "' readonly /></td>";
				tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + json.unit + "' readonly /></td>";
				tag += "<td><input type='text' class='form-control cnt' name='cnt[]' id='cnt_" + flag + "' onkeyup='calculation(" + flag + ")' /></td>";
				tag += "<td><input type='text' class='form-control sales_price' name='sales_price[]' id='sales_price_" + flag + "' value='" + json.price + "' onkeyup='calculation(" + flag + ")' /></td>";
				tag += "<td><input type='text' class='form-control rate' name='rate[]' id='rate_" + flag + "' value='1' onkeyup='calculation(" + flag + ")' /></td>";
				tag += "<td><input type='text' class='form-control reversion_sales_price' name='reversion_sales_price[]' id='reversion_sales_price_" + flag + "' onkeyup='calculation(" + flag + ")' /></td>";
				tag += "<td><input type='text' class='form-control supply_price' name='supply_price[]' id='supply_price_" + flag + "' readonly /></td>";
				tag += "<td><input type='text' class='form-control tax' name='tax[]' id='tax_" + flag + "' readonly /></td>";
				tag += "<td><input type='text' class='form-control total_price' name='total_price[]' id='total_price_" + flag + "' readonly /></td>";
				tag += "</tr>";

				$("#obtain_item_tb tbody").append(tag);
				$("#flag").val(Number(flag) + 1);
			}
		}
	});

	
}


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
		//var supply_price = values/1.1;
		var supply_price = values;
		//var tax = values-supply_price;
		var tax = values / 10;
		$("#supply_price_" + flag).val(commaSplit(Math.round(supply_price)));
		//$("#total_price_" + flag).val(commaSplit(Math.round(values)));
		$("#total_price_" + flag).val(commaSplit(Math.round(values + tax)));
	} else {
		var tax = 0;
		$("#supply_price_" + flag).val(commaSplit(Math.round(values)));
		$("#total_price_" + flag).val(commaSplit(Math.round(values + tax)));
	}
	$("#tax_" + flag).val(commaSplit(Math.round(tax)));
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

		$("#where").val("where account_cd like '@" + search_txt + "@' or account_nm like '@" + search_txt + "@'");
	}
	//alert($("#where").val());
	$("#page").val(1);
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



// 선택 삭제
function deleteSelect(table, p = null){
	$(".chk").each(function(){
		if($(this).prop('checked')) {
			var new_uid = $("#check_uids").val() + "," + $(this).val();
			$("#check_uids").val(new_uid);
		}
	});
	
	if($("#check_uids").val() == "") {
		showAlert("삭제할 데이터를 선택하세요");
		return;
	}

	var parameter = {"mode" : "deleteSelect", "table" : table, "uids" : $("#check_uids").val()};
	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		async : false,
		success : function(){
			$("#checkedAll").prop('checked',false);
			$("#check_uids").val("");
			if(p == null) getData(1);
			else if(p == 1) getItemAccount(1); // 품목매입처 관리의 매입거래처 다시 가져오기
			else if(p == 2) getItemCost(); // 품목 단가 리스트 가져오기
			else if(p == 3) getTeam(); // 생산팀명 가져오기
		}
	});
}

function showAlert(txt) {
	$("#message").html(txt);
	$("#alertModal").modal("show");
}

function showModal(modal_nm) {
	$("#" + modal_nm).modal('show');
}

function hideModal(modal_nm) {
	$("#" + modal_nm).modal("hide");
}

//검색
$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1)
	})
})

</script>