<?
require_once("library/caseby.php");
$sql = "select * from company";
$this->query($sql);
$company = $this->fetch();
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<!-- 검색 모달 -->
		<div class="wrap_search_pop">	
			<div class="search_pop_content">
				<div class="input-group" style="width:100%;">
					<div class="col-xs-12">
						<select name="search_classify" id="search_classify" style="height:35px; width:100%;">
							<option value="0">=선택=</option>
							<option value="item_nm">품목명</option>
							<option value="item_cd">품목코드</option>
							<option value="emp_nm">요청인명</option>
						</select>								
						<input type="text" name="search_txt" id="search_txt" class="search_input"/>
						<button type="button" class="search_btn" onclick="search()">
							<span class="fa fa-search icon-on-right bigger-110"></span>
						</button>
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
					<input type="button" class="comm_title" value="외주품목입고현황" style="float:left;" />
					<!--<? $this->noCheckTable("tb","발주코드,입고희망일,거래처,품번,품목,규격,단위,발주수량,잔여입고수량,상태"); ?>-->					
					<table class="table table-bordered table-striped" id="tb">
						<thead>
							<tr>
								<!--
								<th class="detail-col center">
									발주코드
								</th>
								-->
								
								<th class="detail-col center" style="width:25%">
									입고희망일
								</th>
								<!--
								<th class="detail-col center">
									거래처
								</th>
								-->
								<th class="detail-col center" style="width:25%">
									품번
								</th>
								
								<th class="detail-col center" style="width:30%">
									품목
								</th>
								<!--
								<th class="detail-col center">
									규격
								</th>
								<th class="detail-col center">
									단위
								</th>
								<th class="detail-col center">
									발주수량
								</th>
								<th class="detail-col center">
									잔여입고수량
								</th>
								-->
								<th class="detail-col center" style="width:15%">
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




<!-- 상세보기 -->
<div class="modal fade" id="viewOrdersItemModal" data-backdrop="static" data-keyboard="false">
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
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; width:28%"><i class="ace-icon fa fa-caret-right blue"></i>발주코드</th>
							<td><span id="o_order_cd"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>입고희망일</th>
							<td><span id="o_delivery_dt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>거래처</th>
							<td><span id="o_account_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>품번</th>
							<td><span id="o_item_cd"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>품목</th>
							<td><span id="o_item_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>규격</th>
							<td><span id="o_standard"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>단위</th>
							<td><span id="o_unit"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>발주수량</th>
							<td><span id="o_cnt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>잔여입고수량</th>
							<td><span id="o_remain_cnt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>상태</th>
							<td><span id="o_state"></span></td>
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

<input type="hidden" name="per" id="per" value="16" />

<?
//$this->hidden("where purchase_type='내수'");
$this->hidden("where purchase_type='외주'");
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
function refresh() {
	$("#page").val(1);
	$("#where").val("where purchase_type='외주'");
	$("#search_classify").val(0);
	$("#search_txt").val("");
	getData(1);
}
function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

function createLotNo(item_cd, account_cd) {
	var parameter = {"mode" : "createLotNo", "type" : "I", "item_cd" : item_cd, "account_cd" : account_cd}
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			$("#lot_no").val(str);
		}
	});
}


$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );


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

	// 품목등록
	$("#btnSubmit").click(function (event) {		
		if($("#uid").val() == "") {
			showAlert("입고시킬 품목을 선택하세요");
			return;
		}
		
		if($("#warehouse option:selected").val() == 0) {
			showAlert("입고시킬 창고를 선택하세요");
			return;
		}

		if(check("frm")) {
			
			var cnt = $("#cnt").val();
			var in_cnt = $("#in_cnt").val();
			var add_cnt = $("#add_cnt").val();

			if(Number(cnt) < Number(in_cnt)) {
				showAlert("입고 수량은 잔여입고 수량보다 클 수 없습니다<br><br>추가입고 수량을 이용하세요");
				return;
			}

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
// 입고수량 계산
//==================================================
function cal() {
	var cnt = $("#cnt").val();
	var cnt1 = uncomma($("#cnt1").val());
	var cnt2 = uncomma($("#cnt2").val());

	var in_cnt = Number(cnt) - Number(cnt1) - Number(cnt2);
	$("#in_cnt").val(comma(in_cnt));
}

//==================================================
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("orders_item");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#uid").val("");
	$("#cnt").val("");

	$("#account_nm").html("");
	$("#order_cd").html("");
	$("#item_cd").html("");
	$("#item_nm").html("");
	$("#standard").html("");
	$("#unit").html("");
	$("#order_cnt").html("");

	$("#frm")[0].reset();
	$("#btnSubmitTxt").text("품목등록");
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
// 구매 리스트
//==================================================
function getData(page){
	//var now = new Date(); 
	//var todayAtMidn = new Date(now.getFullYear(), now.getMonth(), now.getDate());

	var tag = "";
	var parameter = {"mode" : "getOrdersItemList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick='toggle(this); postData(" + json[i].uid + ");' style='cursor:pointer'>";
					
					//var dbDate = json[i].delivery_dt.split("-");
					//var specificDate = new Date(dbDate[1] + "/" + dbDate[2] + "/" + dbDate[0]);
					
					//if (todayAtMidn.getTime() < specificDate.getTime()) {
						//alert("아직 기간 남음");
					//	var font_style = "";
					//} else {
						//alert("경과 지남");
					//	var font_style = "style='font-weight:bold; color:red'";
					//}
					
					//tag += "<td>" + json[i].order_cd + "</td>";
					tag += "<td >" + json[i].delivery_dt + "</td>";
					//tag += "<td>" + json[i].account_nm + "</td>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					//tag += "<td>" + json[i].standard + "</td>";
					//tag += "<td>" + json[i].unit + "</td>";
					//tag += "<td>" + json[i].cnt + "</td>";
					//tag += "<td>" + json[i].remain_cnt + "</td>";
					tag += "<td>" + json[i].state + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "orders_item";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//상세보기
function postData(uid) {
	$("#uid").val(uid);
	var parameter = {"mode" : "getOrdersItem2", "uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#o_order_cd").html(json.order_cd);
			$("#o_delivery_dt").html(json.delivery_dt);
			$("#o_account_nm").html(json.account_nm);
			$("#o_item_cd").html(json.item_cd);
			$("#o_item_nm").html(json.item_nm);
			$("#o_standard").html(json.standard);
			$("#o_unit").html(json.unit);
			$("#o_cnt").html(comma(json.cnt));
			$("#o_remain_cnt").html(comma(json.remain_cnt));
			$("#o_state").html(json.state);
		}
	});
	showModal('viewOrdersItemModal');
}

//==================================================
// 선택한 품목 처리
//==================================================
function postOrder(uid, order_cd, item_cd, item_nm, standard, unit, cnt, state, account_cd, account_nm) {
	//var lot_no = createLotNo(item_cd, account_cd);
	if(state == "입고완료") {
		showAlert("이미 입고가 완료된 품목은 재입고를 하실 수 없습니다");
		return;
	}

	$("#uid").val(uid);
	$("#cnt").val(uncomma(cnt));
	$("#order_cd").html(order_cd);
	$("#item_cd").html(item_cd);
	$("#item_nm").html(item_nm);
	$("#standard").html(standard);
	$("#unit").html(unit);
	$("#order_cnt").html(cnt);
	$("#in_cnt").val(cnt);
	$("#account_nm").html(account_nm);
	//$("#lot_no").val(lot_no);

	
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

	$("#where").val("where purchase_type='외주' and " + search_classify + " like '%" + search_txt + "%'");
	getData(1);
}

//==================================================
// 품목구분 품목 리스트 가져오기
//==================================================
function setData(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("");
	else $("#where").val(" where state='" + val + "'");
	getData(1);
}

//검색
$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1);
	});
});
</script>