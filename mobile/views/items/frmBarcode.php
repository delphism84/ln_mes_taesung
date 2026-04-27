<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">			
			<div>
				<div class="col-xs-12">
					<div><input type="button" class="comm_title" value="바코드 리스트" /></div>
					<? $this->noCheckTable("tb","바코드=>2,품명=>5,생성일=>3"); ?>
					<? $this->paging() ?>
				</div>
			</div>			
		</div>
	</div>
</div>

<!--바코드 상세정보 MODAL-->
<div class="modal fade" id="viewVarcodeModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">상세보기</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="col-xs-12" style="overflow-y: scroll; height:500px">
				<div>
					<!-- 바코드 -->
					<div id="barcode" style="text-align:center"></div>
					<div style="margin-top:10px;"><input type="button" class="btn btn-xs btn-pink" value="생성사유 및 수량" /></div>
					<table class="table table-bordered">
						<tr>
							<th class="col-xs-4" style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 생성사유</th>
							<td><span id="classify"></span></td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 재고수량</th>
							<td><span id="cnt"></span></td>
						</tr>
					</table>
					
					<div><input type="button" class="btn btn-xs btn-pink" value="구매정보" /></div>
					<table class="table table-bordered">
						<tr>
							<th class="col-xs-4" style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 구매처코드</th>
							<td><span id="account_cd"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 구매처명</th>
							<td><span id="account_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 구매수량</th>
							<td><span id="in_cnt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 구매단가</th>
							<td><span id="price"></span></td>
						</tr>
					</table>
					
					<div><input type="button" class="btn btn-xs btn-pink" value="생산정보" /></div>
					<table class="table table-bordered">
						<tr>
							<th class="col-xs-4" style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 생산공정</th>
							<td><span id="process"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 생산설비</th>
							<td><span id="machine"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 생산팀</th>
							<td><span id="team"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 작업자</th>
							<td><span id="emp_nm"></span></td>
						</tr>
					</table>
					<!--
					<div><input type="button" class="btn btn-xs btn-pink" value="판매정보" /></div>
					<table class="table table-bordered">
						<tr>
							<th class="col-xs-4" style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 판매처코드</th>
							<td><span id="sales_account_cd"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 판매처명</th>
							<td><span id="sales_account_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 판매수량</th>
							<td><span id="out_cnt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle"><i class="ace-icon fa fa-caret-right blue"></i> 판매단가</th>
							<td><span id="sales_price"></span></td>
						</tr>
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

<input type="hidden" name="per" id="per" value="10" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

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

	$("#item_classify").on('change', function() {
		if($("#item_classify option:selected").val() == 0) {
			$("#search_txt").val("");
			$("#where").val("");
			getData(1);
		}
	});

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			if($("#cnt").val() > 0) {
				if($("#warehouse_cd option:selected").val() == 0) {
					showAlert("기초재고 수량을 입고시킬 창고를 선택하세요");
					return;
				}
			}
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
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("item");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#cnt").attr("readonly", false);
	$("#item_cd").attr("readonly", false); 
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
// 품목리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getLotNo", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postItem(" + json[i].lot_no + ", '" + json[i].classify + "', '" + json[i].account_cd + "', '" + json[i].account_nm + "', " + json[i].in_cnt + ", " + json[i].price + ", '" + json[i].process_nm + "', '" + json[i].machine_nm + "', '" + json[i].team_nm + "', '" + json[i].emp_nm + "', '" + json[i].sales_account_cd + "', '" + json[i].sales_account_nm + "', " + json[i].out_cnt + ", " + json[i].sales_price + ");\" style='cursor:pointer'>";
					tag += "<td>" + json[i].lot_no + "</td>";
					//tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					//tag += "<td>" + json[i].standard + "</td>";
					//tag += "<td>" + json[i].unit + "</td>";
					tag += "<td>" + json[i].create_dt + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "lot_no";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function postItem(lot_no, classify, account_cd, account_nm, in_cnt, price, process_nm, machine_nm, team_nm, emp_nm, sales_account_cd, sales_account_nm, out_cnt, sales_price) {
	var parameter = {"mode" : "getBarcodeImg", "barcode" : lot_no};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			$("#barcode").html(str);
			$("#classify").html(classify);
			$("#account_cd").html(account_cd);
			$("#account_nm").html(account_nm);
			$("#in_cnt").html(comma(in_cnt));
			$("#price").html(comma(price));
			$("#process_nm").html(process_nm);
			$("#machine_nm").html(machine_nm);
			$("#team_nm").html(team_nm);
			$("#emp_nm").html(emp_nm);
			$("#sales_account_cd").html(sales_account_cd);
			$("#sales_account_nm").html(sales_account_nm);
			$("#out_cnt").html(comma(out_cnt));
			$("#sales_price").html(comma(sales_price));
			showModal('viewVarcodeModal');
		}
	});
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
//==================================================
// 품목코드 확인
//==================================================
function checkCode(modal_nm) {
	if($("#item_cd").val() == "") {
		showAlert("품번이 생성이 되어있지 않습니다.<br>품번 생성 후 진행하세요"); 
	} else {
		$("#p_item_cd").val($("#item_cd").val());
		showModal(modal_nm);
	}
}

//==================================================
// 규격 등록
//==================================================
function registStandard(modal_nm) {
	var parameter = {"mode" : "registStandard", "item_cd" : $("#p_item_cd").val(), "standard" : $("#p_standard").val()}
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "success") {
				$("#p_item_cd").val("");
				$("#p_standard").val("");
				hideModal(modal_nm);
			} else if(str == "dupp") {
				hideModal(modal_nm);
				showAlert("해당 품번 값을 가진 품목규격이 이미 존재합니다");
			}
		}
	});
}

//==================================================
// 규격 가져오기
//==================================================
function viewStandard(modal_nm) {
	var tag = "";
	var parameter = {"mode" : "getStandard", "item_cd" : $("#item_cd").val()};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json) {
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++) {
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postData('" + json[i].standard + "','" + modal_nm + "')\">" + json[i].standard + "</a></td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td style='text-align:center; font-weight:bold; color:red;'>데이터가 존재하지 않습니다</td></tr>";
			}

			$("#standard_tb tbody").html(tag);
			showModal(modal_nm);
		}
	);
}
//==================================================
// 선택한 규격 처리
//==================================================
function postData(standard, modal_nm) {
	$("#standard").val(standard);
	hideModal(modal_nm);
}

//==================================================
// 품목코드 생성
//==================================================
function createCode(classify) {
	var parameter = {"mode" : "createItemCode", "classify" : classify};

	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		success : function(str) {
			$("#item_cd").val(str);
			$("#barcode").val(str);
		}
	});
}

//==================================================
// 검색
//==================================================
function search(){
	var classify = $("#item_classify option:selected").val();
	var txt = $("#search_txt").val();
	
	if(classify == 0) {
		showAlert("검색구분을 선택하세요");
		return;
	}
	
	if(txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#where").val("where " + classify + " like '%" + txt + "%'");
	getData(1);
}

//==================================================
// 품목구분 품목 리스트 가져오기
//==================================================
function setItem(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("");
	else $("#where").val(" where classify=" + val);
	getData(1);
}
</script>