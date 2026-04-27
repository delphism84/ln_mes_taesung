<?
require_once("library/caseby.php");
$sql = "select * from company";
$this->query($sql);
$company = $this->fetch();
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-12">
						<?
						/*
						if($_SESSION['login_level'] >= 99) {
							echo "<div  style='float:left; text-align:right'>";
							echo "<div class='input-group'>";							
							echo "<select name='classify' id='classify' style='height:35px; width:100%; margin-bottom:10px;' onchange='setData(this.value)' >";
							echo "<option value='0'>=선택=</option>";
							echo "<option value='발주'>발주</option>";
							echo "<option value='부분입고'>부분입고</option>";
							echo "<option value='입고완료'>입고완료</option>";
							echo "</select>";
							// echo "<select name='search_classify' id='search_classify' style='height:35px'>";
							// echo "<option value='0'>=선택=</option>";
							// echo "<option value='item_nm'>품목명</option>";
							// echo "<option value='item_cd'>품목코드</option>";
							// echo "<option value='emp_nm'>요청인명</option>";
							// echo "</select>";
							echo "<input type='text' name='search_txt' id='search_txt' style='height:35px; width:77%;' />";
							echo "<button type='button' class='btn btn-purple btn-sm' onclick='search()' style='height:35px; margin-bottom:3px'>";
							echo "<span class='fa fa-search icon-on-right bigger-110'></span>";
							echo "</button>";
							echo "<button type='button' class='btn btn-success btn-sm' onclick='refresh()' style='height:35px; margin-bottom:3px'>";
							echo "<span class='fa fa-refresh icon-on-right bigger-110'></span>";
							echo "</button>";	
							echo "</div>";
							echo "</div>";
							echo "<div style='float:right'>";
							//echo "<input type='button' class='btn btn-xs btn-danger' value='선택삭제' data-toggle='modal' data-target='#confirm-delete' style='height:35px' />";
							echo "</div>";
							echo "<input type='button' class='btn btn-xs btn-pink' value='입고대기 리스트' style='height:35px; margin-right:5px; margin-top:10px;' />";
							$this->table("tb","용도,품번,품목명,발주수량,잔여입고수량,요청부서,요청인,상태");
						} else {
							echo "<div  style='float:left; text-align:right'>";
							echo "<div class='input-group'>";
							echo "<input type='button' class='btn btn-xs btn-pink' value='입고대기 리스트' style='height:35px; margin-right:5px' />";
							echo "<select name='classify' id='classify' style='height:35px; margin-right:3px' onchange='setData(this.value)' >";
							echo "<option value='0'>=선택=</option>";
							echo "<option value='발주'>발주</option>";
							echo "<option value='부분입고'>부분입고</option>";
							echo "<option value='입고완료'>입고완료</option>";
							echo "</select>";
							// echo "<select name='search_classify' id='search_classify' style='height:35px'>";
							// echo "<option value='0'>=선택=</option>";
							// echo "<option value='item_nm'>품목명</option>";
							// echo "<option value='item_cd'>품목코드</option>";
							// echo "<option value='emp_nm'>요청인명</option>";
							// echo "</select>";
							echo "<input type='text' name='search_txt' id='search_txt' style='height:35px; margin-left:3px' />";
							echo "<button type='button' class='btn btn-purple btn-sm' onclick='search()' style='height:35px; margin-bottom:3px'>";
							echo "<span class='fa fa-search icon-on-right bigger-110'></span>";
							echo "</button>";
							echo "<button type='button' class='btn btn-success btn-sm' onclick='refresh()' style='height:35px; margin-bottom:3px'>";
							echo "<span class='fa fa-refresh icon-on-right bigger-110'></span>";
							echo "</button>";	
							echo "</div>";
							echo "</div>";

							$this->noCheckTable("tb","용도,품번,품목명,발주수량,잔여입고수량,요청부서,요청인,상태");
						}
						*/
						echo "<input type='button' class='btn btn-xs btn-pink' value='입고대기 리스트' style='height:35px; margin-right:5px; margin-top:10px;' />";
						$this->noCheckTable("tb","용도,품번,품목명,상태");
						$this->paging();
						?>
					</div>
					<!--
					<div class="col-xs-3" style="border:1px solid #ccc; height:100%; overflow: scroll; overflow-x: hidden; padding-top:10px; padding-right:10px">
						<div><input type="button" class="btn btn-xs btn-pink" value="품목정보" /></div>
						<table class="table table-bordered">
							<tr>
								<? $this->th("구매처") ?>
								<td class="col-xs-8"><span id="account_nm"></span></td>
							</tr>	
							<tr>
								<? $this->th("발주코드") ?>
								<td class="col-xs-8"><span id="order_cd"></span></td>
							</tr>							
							<tr>
								<? $this->th("품번") ?>
								<td><span id="item_cd"></span></td>
							</tr>
							<tr>
								<? $this->th("품명") ?>
								<td><span id="item_nm"></span></td>
							</tr>
							<tr>
								<? $this->th("규격") ?>
								<td><span id="standard"></span></td>
							</tr>
							<tr>
								<? $this->th("단위") ?>
								<td><span id="unit"></span></td>
							</tr>
							<tr>
								<? $this->th("발주수량") ?>
								<td><span id="order_cnt"></span></td>
							</tr>
						</table>
						
						<form name="frm" id="frm">
							<input type="hidden" name="mode" id="mode" value="registWarehousing" />
							<input type="hidden" name="uid" id="uid" />
							<input type="hidden" name="cnt" id="cnt" />

							<div><input type="button" class="btn btn-xs btn-pink" value="수입검사" /></div>
							<table class="table table-bordered">
								<tr>
									<? $this->th("검사항목") ?>
									<? $this->th("불량수량") ?>
								</tr>
								<tr>
									<? $this->th("외관검사") ?>
									<td class="col-xs-8"><input type="text" class="comma onlynum" value="0" id="cnt1" onkeyup="cal()" /></td>
								</tr>
								<tr>
									<? $this->th("중량검사") ?>
									<td><input type="text" class="comma onlynum" value="0" id="cnt2" onkeyup="cal()" /></td>
								</tr>
							</table>

							<div><input type="button" class="btn btn-xs btn-pink" value="품목입고" /></div>
							<div>
								<table class="table table-bordered">
									<tr>
										<? $this->th("입고위치") ?>
										<td class="col-xs-8"><? $this->createDbSelectBox("warehouse", "warehouse_nm", "warehouse"); ?></td>
									</tr>
									<tr>
										<? $this->th("LOT NO") ?>
										<td><input type="text" class="form-control" name="lot_no" id="lot_no" validation="yes" err="Lot No를 입력하세요" readonly /></td>
									</tr>
									<tr>
										<? $this->th("입고수량") ?>
										<td><input type="text" class="comma onlynum" name="in_cnt" id="in_cnt" validation="yes" err="입고수량을 입력하세요" /></td>
									</tr>
									<tr>
										<? $this->th("추가입고수량") ?>
										<td><input type="text" class="comma onlynum" name="add_cnt" id="acc_cnt" value="0" /></td>
									</tr>
								</table>
							</div>
							<div style="text-align:center"><input type="button" class="btn btn-lg btn-info" value="품목입고" id="btnSubmit" /></div>
						</div>
						-->
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 상세보기 -->
<div class="modal fade" id="viewOrderItemModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"style="top:10%;">
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
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>용도</th>
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
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>발주수량</th>
							<td><span id="p_cnt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>잔여입고수량</th>
							<td><span id="p_remain_cnt"></span></td>
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
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>상태</th>
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

<input type="hidden" name="per" id="per" value="16" />

<?
//$this->hidden("where purchase_type='내수'");
$this->hidden("where arrival!='외주업체'");
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
function refresh() {
	$("#uid").val("");
	$("#page").val(1);
	$("#where").val("where arrival!='외주업체'");
	$("#classify").val(0);
	$("#search_classify").val(0);
	$("#search_txt").val("");
	formClear();
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
	formClear();
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
	var tag = "";
	var parameter = {"mode" : "getOrdersItemList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

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
					//tag += "<td>" + json[i].cnt + "</td>";
					//tag += "<td>" + json[i].remain_cnt + "</td>";
					//tag += "<td>" + json[i].department + "</td>";
					//tag += "<td>" + json[i].emp_nm + "</td>";
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

function postData(uid) {
	$("#uid").val(uid);
	var parameter = {"mode" : "getOrdersItem2", "uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#p_purchase_type").html(json.purchase_type);
			$("#pu_item_cd").html(json.item_cd);
			$("#pu_item_nm").html(json.item_nm);
			$("#p_cnt").html(json.cnt);
			$("#p_remain_cnt").html(json.remain_cnt);
			$("#p_department").html(json.department);
			$("#p_emp_nm").html(json.emp_nm);
			$("#p_state").html(json.state);
		}
	});
	showModal('viewOrderItemModal');
}

//==================================================
// 선택한 품목 처리
//==================================================
/*
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
*/
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
	var type = 1;
	if(type == 1){
		var search_txt = $("#search_txt").val();
		if(search_txt == "") {
			showAlert("검색어를 입력하세요");
			return false;
		}

		$("#where").val("where item_cd like '@" + search_txt + "@' or item_nm like '@" + search_txt + "@'");
	}

	$("#page").val(1);
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
</script>