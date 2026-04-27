<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">			
			<div>
				<div class="col-xs-12">
					<div>
						<?
						/*
						if($_SESSION['login_level'] >= 99) {
							echo "<div style='float:left'><input type='button' class='btn btn-xs btn-pink' value='구매요청목록' /></div>";
							echo "<div style='float:right'>";
							//echo "<input type='button' class='btn btn-xs btn-success' value='발주대기로 보내기' onclick='sendOrderStay()' style='margin-right:3px' />";
							//echo "<input type='button' class='btn btn-xs btn-danger' value='선택삭제' data-toggle='modal' data-target='#confirm-delete' />";
							echo "</div>";
							
							$this->table("tb","용도=>1,품번=>1,품명=>2,규격=>1,단위=>1,요청수량=>1,입고희망일=>1,요청부서=>1,요청인=>1,요청일=>1,처리상태=>1");
						} else {
							echo "<div style='float:left'><input type='button' class='btn btn-xs btn-pink' value='구매요청목록' /></div>";
							
							$this->noCheckTable("tb","용도=>1,품번=>1,품명=>2,규격=>1,단위=>1,요청수량=>1,입고희망일=>1,요청부서=>1,요청인=>1,요청일=>1,처리상태=>1");
						}
							
						$this->paging();
						*/	
						echo "<div style='float:center'><input type='button' class='comm_title' value='구매요청목록' /></div>";
							$this->noCheckTable("tb","용도=>2,품번=>3,품명=>3,처리상태=>2");
							$this->paging();
						?>
					</div>
					<!--
					<div style="border-top:1px solid #ccc; height:50%; overflow: scroll; overflow-x: hidden; padding-top:10px; padding-right:10px">
						<div style="clear:both">
							<form name="order_frm" id="order_frm">
								<input type="hidden" name="mode" id="mode" value="registOrder" />
								<?
								if($_SESSION['login_level'] >= 99) {
									echo "<div style='float:left'><input type='button' class='btn btn-xs btn-pink' value='발주대기' /></div>";
									echo "<div style='float:right'><input type='button' class='btn btn-xs btn-info' value='발주확정' onclick='registOrder()' /></div>";										
								} else {
									echo "<div style='float:left'><input type='button' class='btn btn-xs btn-pink' value='발주대기' /></div>";										
								}
								?>
								<table id="order_waiting_tb" class="table table-bordered">
									<thead class="thin-border-bottom">
										<tr>
											<th class="detail-col center">
												<label class="pos-rel">
													<input type="checkbox" class="ace" id="checkedAll2" />
													<span class="lbl"></span>
												</label>
											</th>

											<th><i class="ace-icon fa fa-caret-right blue"></i> 품번</th>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 품명</th>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 단위</th>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 요청수량</th>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 거래처</th>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 구매단가</th>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 용도</th>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 하차장소</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</form>
						</div>
					</div>
					-->
				</div>
				<!--
				<div class="col-xs-3" style="border:1px solid #ccc; height:100%; overflow: scroll; overflow-x: hidden; padding-top:10px">
					<div>
						<form id='frm'>
							<input type="hidden" name="mode" id="mode" value="registPurchase" />
							<input type="hidden" name="uid" id="uid" />
							<div>
								<div><input type="button" class="btn btn-xs btn-pink" value="구매요청 등록" /></div>
								<table class="table table-bordered">
									<tr>
										<? $this->th("구매코드") ?>
										<td class="col-xs-8"><input type="text" name="purchase_cd" id="purchase_cd" readonly /></td>
									</tr>
									<tr>
										<? $this->th("수주코드") ?>
										<td class="col-xs-8"><input type="text" name="purchase_order_cd" id="purchase_order_cd" readonly /></td>
									</tr>
									<tr>
										<? $this->th("제목") ?>
										<td class="col-xs-8"><input type="text" name="title" id="title" class="form-control" /></td>
									</tr>
									<tr>
										<? $this->th("용도") ?>
										<td class="col-xs-8">
											<select name="purchase_type" id="purchase_type">
												<option value="내수">내수</option>
												<option value="사급">사급</option>
											</select>
										</td>
									</tr>
									<tr>
										<? $this->th("품번") ?>
										<td class="col-xs-8"><input type="text" name="purchase_item_cd" id="purchase_item_cd" validation="yes" err="품번을 입력하세요" onclick="showModal('itemModal')" readonly /></td>
									</tr>
									<tr>
										<? $this->th("품목명") ?>
										<td class="col-xs-8"><input type="text" name="purchase_item_nm" id="purchase_item_nm" validation="yes" err="품목명을 입력하세요" readonly /></td>
									</tr>
									<tr>
										<? $this->th("규격") ?>
										<td class="col-xs-8"><input type="text" name="purchase_standard" id="purchase_standard" readonly /></td>
									</tr>
									<tr>
										<? $this->th("요청수량") ?>
										<td class="col-xs-8"><input type="text" class="comma onlynum" name="purchase_cnt" id="purchase_cnt" /></td>
									</tr>
									<tr>
										<? $this->th("입고희망일") ?>
										<td class="col-xs-8">
											<div>
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input class=" date-picker" name="purchase_delivery_dt" id="purchase_delivery_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="납품기한을 입력하세요" readonly />
														<span class="input-group-addon">
															<i class="fa fa-calendar bigger-110"></i>
														</span>
													</div>
												</span>
											</div>
										</td>
									</tr>
								</table>
							</div>
							<div class="col-md-12 center">
								<button class="btn btn-info" type="button" id="btnSubmit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									<span id="btnSubmitTxt">구매요청등록</span>
								</button>
								<button class="btn btn-default" type="button" onclick="formClear()">
									<i class="ace-icon fa fa-check bigger-110"></i>
									새로고침
								</button>
							</div>
						</form>
					</div>
				</div>
				-->
			</div>			
		</div>
	</div>
</div>

<div class="modal fade" id="costModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">구매가격</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:100px">
				<table class="table table-bordered table-striped">
					<tr>
						<? $this->th("구매가격"); ?>
						<td><input type="text" class="comma" name="purchase_price" id="purchase_price" /></td>
					</tr>
				</table>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-info" onclick="postCost()">단가등록</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 상세보기 -->
<div class="modal fade" id="viewPurchaseModal" data-backdrop="static" data-keyboard="false">
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
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; width:100px"><i class="ace-icon fa fa-caret-right blue"></i>용도</th>
							<td><span id="p_purchase_type"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>품번</th>
							<td><span id="pu_item_cd"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>품명</th>
							<td><span id="pu_item_nm"></span></td>
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
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>요청수량</th>
							<td><span id="p_cnt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>입고희망일</th>
							<td><span id="p_delivery_dt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>요청부서</th>
							<td><span id="p_department"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>요청인</th>
							<td><span id="p_emp_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>요청일</th>
							<td><span id="p_purchase_dt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>처리상태</th>
							<td><span id="p_state"></span></td>
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

<!-- 검색 모달 -->
<div class="wrap_search_pop">	
	<div class="search_pop_content">
		<div class="input-group">
			<div class="col-xs-12">
				<? $this->periodSearch("searchDate()","견적일자검색"); ?>
			</div>
			<!-- <select name="search_classify" id="search_classify" style="height:35px; margin-left:5px">
				<option value="0">== 검색구분 ==</option>
				<option value="item_cd">품번</option>
				<option value="item_nm">품명</option>
				<option value="account_nm">거래처</option>
			</select>-->
			<div class="col-xs-12">
				<input type="text" name="search_txt" id="search_txt" class="search_input"/>
				<input type="button" class="btn btn-xs btn-purple search_btn" onclick="search()" value="검색"/>
				<button type="button" class="btn btn-success btn-xs search_refresh" onclick="refresh()">
					<span class="fa fa-refresh icon-on-right bigger-110"></span>
				</button>
			</div>
			<div class="col-xs-12">
				<span class="search_cl">닫기</span>
			</div>		
		</div>		
	</div>	
</div>
<!-- //검색 모달 -->

<?
$this->hidden("where status='구매요청'");
//$this->hidden("where state='구매요청'");
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
require_once ("views/modal/itemModal.php");
require_once ("views/modal/accountModal.php");
?>

<input type="hidden" name="per" id="per" value="10" />
<input type='hidden' name='accountFlag' id='accountFlag' />

<script>
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
	getOrderWaitingList();
	getItemList(1);
	getAccountList(1);

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

	$("#checkedAll2").click(function(){
		if($("#checkedAll2").prop('checked')) {
			$(".chk2").each(function(){
				$(this).prop("checked",true);
			});
		} else {
			$(".chk2").each(function(){
				$(this).prop("checked",false);
			});
		}
	});

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			
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
					getData(1);
					formClear();
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
// 발주 대기 시키기
//==================================================
function sendOrderStay() {
	$(".chk").each(function(){
		if($(this).prop('checked')) {
			var new_uid = $("#check_uids").val() + "," + $(this).val();
			$("#check_uids").val(new_uid);
		}
	});

	if($("#check_uids").val() == "") {
		showAlert("발주대기로 보낼 품목을 선택하세요");
		return false;
	}

	var parameter = {"mode" : "sendOrderStay", "uids" : $("#check_uids").val()};
	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		async : false,
		success : function(){
			$("#checkedAll").prop('checked',false);
			getData(1);
			getOrderWaitingList();
		}
	});
}

//==================================================
// 발주 확정
//==================================================
function registOrder() {
	var bool = true;
	$("#check_uids").val("");
	var i = 0;
	$(".chk2").each(function(){
		if($(this).prop('checked')) {
			var new_uid = $("#check_uids").val() + "," + $(this).val();
			$("#check_uids").val(new_uid);

			if($(".account").eq(i).val() == 0) {
				showAlert("거래처가 선택이 되지 않았습니다");
				bool = false;
				return false;
			}

			if($(".cost").eq(i).val() == 0) {
				showAlert("구매단가가 선택이 되지 않았습니다");
				bool = false;
				return false;
			}
		}

		i++;
	});

	if($("#check_uids").val() == "") {
		showAlert("발주확정 할 발주대기 품목을 선택하세요");
		bool = false;
		return false;
	}

	if(bool) {
		var parameter = $("#order_frm").serialize();
		$.ajax({
			type : "post",
			url : "ajax.php",
			data : parameter,
			async : false,
			success : function(){
				$("#checkedAll2").prop('checked',false);
				getData(1);
				getOrderWaitingList();
			}
		});
	}
}


//==================================================
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("purchase");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#btnSubmitTxt").text("구매요청등록");
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
// 선택된 품목 테이블 선택된 TR 색상 바꾸기
//==================================================
function cost_toggle(it) {
	$("#order_waiting_tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}


// setInterval(function() {
// 	getData(1);
// }, 1000); // 1초에 한번

//==================================================
// 구매요청 리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getPurchaseList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

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
					tag += "<td>" + json[i].purchase_type + "</td>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					//tag += "<td>" + json[i].standard + "</td>";
					//tag += "<td>" + json[i].unit + "</td>";
					//tag += "<td>" + json[i].cnt + "</td>";
					//tag += "<td style='text-align:right'>" + json[i].delivery_dt + "</td>";
					//tag += "<td style='text-align:right'>" + json[i].department + "</td>";
					//tag += "<td>" + json[i].emp_nm + "</td>";
					//tag += "<td>" + json[i].purchase_dt + "</td>";
					tag += "<td>" + json[i].state + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='12' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "purchase";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//상세보기
function postData(uid) {
	$("#uid").val(uid);
	var parameter = {"mode" : "getPurchase", "uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#p_purchase_type").html(json.purchase_type);
			$("#pu_item_cd").html(json.item_cd);
			$("#pu_item_nm").html(json.item_nm);
			$("#p_standard").html(json.standard);
			$("#p_unit").html(json.unit);
			$("#p_cnt").html(comma(json.cnt));
			$("#p_delivery_dt").html(json.delivery_dt);
			$("#p_department").html(json.department);
			$("#p_emp_nm").html(json.emp_nm);
			$("#p_purchase_dt").html(json.purchase_dt);
			$("#p_state").html(json.state);
		}
	});
	showModal('viewPurchaseModal');
}

function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

//==================================================
// 선택한 품목 처리
//==================================================
/*
function postData(uid, purchase_cd, order_cd, title, purchase_type, item_cd, item_nm, standard, unit, cnt, delivery_dt) {
	$("#uid").val(uid);
	$("#purchase_cd").val(purchase_cd);
	$("#order_cd").val(order_cd);
	$("#title").val(title);
	$("#purchase_type").val(purchase_type);
	$("#purchase_item_cd").val(item_cd);
	$("#purchase_item_nm").val(item_nm);
	$("#purchase_standard").val(standard);
	$("#purchase_unit").val(unit);
	$("#purchase_cnt").val(cnt);
	$("#purchase_delivery_dt").val(delivery_dt);

	$("#btnSubmitTxt").text("구매요청수정");
}
*/
//==================================================
// 발주대기 리스트 가져오기
//==================================================
function getOrderWaitingList(page){
	var tag = "";
	var parameter = {"mode" : "getOrderWaitingList"}

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"cost_toggle(this);\" style='cursor:pointer'>";

					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk2' name='uid[]' id='uid' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>

					tag += "<td><input type='hidden' name='item_cd' id='item_cd_" + i + "' value='" + json[i].item_cd + "' />" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					tag += "<td>" + json[i].cnt + "</td>";
					tag += "<td>" + json[i].account + " <input type='button' class='btn btn-xs btn_default' value='선택' onclick='selectAccount(" + i + ")' /></td>";
					tag += "<td>" + json[i].cost + " <input type='button' class='btn btn-xs btn_default' value='선택' onclick='selectCost(" + i + ")' /></td>";
					tag += "<td>" + json[i].purchase_type + "</td>";
					tag += "<td><select name='arrival[]' id='arrival'><option value='본사'>본사</option></select>"
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='12' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			$("#order_waiting_tb tbody").html(tag);
		}
	);
}

function selectAccount(flag){
	$("#accountFlag").val(flag);
	showModal('accountModal');
}

function postAccount(account_cd,account_nm,uid){	
	var tag = "<option value='" + uid + "'>" + account_nm + "</option>";
	var flag = $("#accountFlag").val();
	$("#account_" + flag).append(tag);
	$("#account_" + flag).val(uid);
	hideModal('accountModal');
}

function selectCost(flag){
	$("#accountFlag").val(flag);
	showModal('costModal');	
}

function postCost(){
	var flag = $("#accountFlag").val();
	var cost = $("#purchase_price").val();
	var tag = "<option value='" + cost + "'>" + cost + "</option>";
	$("#cost_" + flag).append(tag);
	$("#cost_" + flag).val(cost);
	$("#purchase_price").val("");
	hideModal('costModal');
}
//==================================================
// 업체 품목 단가 가져오기
//==================================================
function getAccountCost(item_uid, account_uid, flag) {
	var tag = "<option value='0'>= 구매금액 ==</option>";
	var parameter = {"mode" : "getItemCost", "item_uid" : item_uid, "account_uid" : account_uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {
				tag += "<option value='" + json[i].purchase_price + "'>" + json[i].purchase_price + "</option>";
			}

			$("#cost_" + flag).html(tag);
		}
	});
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
// 선택 품목 처리
//==================================================
function postItem(item_cd, item_nm, standard, unit) {
	$("#purchase_item_cd").val(item_cd);
	$("#purchase_item_nm").val(item_nm);
	$("#purchase_standard").val(standard);
	//$("#unit").val(unit);

	hideModal("itemModal");
	//$("#sale_price").val(sale_price);
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

$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').css('top','0%')
	})
})

//검색 닫기
$(function(){
	$('.search_cl').click(function(){
		$('.wrap_search_pop').css('top','-50%')
	})
})
</script>