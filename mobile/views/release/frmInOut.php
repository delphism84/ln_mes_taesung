<?
require_once("library/caseby.php");
?>

<div class="main-content" >
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<!-- 검색 모달 -->
		<div class="wrap_search_pop">	
			<div class="search_pop_content">
				<div class="input-group" style="width:100%;">
					<div class="col-xs-12" style="width:100%;">
						<input type="text" class=" search-query search_input" name="search_txt" id="search_txt"/>													
						<button type="button" class="search_btn" onclick="search()">
							<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
						</button>
						<button type="button" class="search_refresh" onclick="refresh()">
							<span class="ace-icon fa fa-refresh icon-on-right bigger-110"></span>
						</button>				
					</div>							
				</div>		
			</div>	
		</div>
		<!-- //검색 모달 -->
		<div class="page-content" >			
			<div>
				<div class="col-xs-12">				
					<div>
						<input type="button" class="comm_title" value="품목 리스트" style="float:left"/>						
					</div>
					<? $this->noCheckTable("tb","구분=>2,품번=>2,품명=>3,규격=>2"); ?>
					<? $this->paging() ?>
				</div>
				
			</div>			
		</div>
	</div>
</div>

<!-- 상세보기 -->
<div class="modal fade" id="viewItemModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">수불 리스트</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<!-- 내용 -->				
				<div>
					<table class="table table-bordered" id="in_out">
						<thead>
							<tr>
								<td rowspan="2" style="background-color:#e5e4e8; text-align:center; vertical-align:middle"><strong>날짜</strong></td>
								<td rowspan="2" style="background-color:#e5e4e8; text-align:center; vertical-align:middle"><strong>창고</strong></td>
								<td colspan="3" style="background-color:#e5e4e8; text-align:center"><strong>입고</strong></td>
								<td colspan="3" style="background-color:#e5e4e8; text-align:center"><strong>출고</strong></td>
							</tr>
							<tr>
								<td style="text-align:center;">수량</td>
								<td style="text-align:center;">단가</td>
								<td style="text-align:center;">금액</td>
								<td style="text-align:center;">수량</td>
								<td style="text-align:center;">단가</td>
								<td style="text-align:center;">금액</td>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
				<!-- 내용 -->
			</div>
			<!-- Modal footer -->
			<div class="modal-footer" >
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
function refresh() {
	$("#uid").val("");
	$("#page").val(1);
	$("#where").val("");
	$("#search_classify").val(0);
	$("#search_txt").val("");
	$("#in_out tbody").html("");
	getData(1);
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

	$("#item_classify").on('change', function() {
		if($("#item_classify option:selected").val() == 0) {
			$("#search_txt").val("");
			$("#where").val("");
			getData(1);
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
	var parameter = {"mode" : "getItemList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); getInOut('" + json[i].item_cd + "');\" style='cursor:pointer'>";
					tag += "<td>" + json[i].classify_nm + "</td>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					//tag += "<td>" + json[i].unit + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "item";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function getInOut(item_cd) {
	var tag = "";
	var in_cnt = 0;
	var in_price = 0;
	var in_total_price = 0;
	var out_cnt = 0;
	var out_price = 0;
	var out_total_price = 0;

	var parameter = {"mode" : "getInOutList", "item_cd" : item_cd};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for (var i = 0 ; i < json.length ; i++ )
			{
				tag += "<tr>";
				tag += "<td>" + json[i].create_dt + "</td>";
				tag += "<td>" + json[i].reason + "</td>";
				tag += "<td style='text-align:right'>" + json[i].in_cnt + "</td>";
				tag += "<td style='text-align:right'>" + json[i].in_price + "</td>";
				tag += "<td style='text-align:right'>" + json[i].in_total_price + "</td>";
				tag += "<td style='text-align:right'>" + json[i].out_cnt + "</td>";
				tag += "<td style='text-align:right'>" + json[i].out_price + "</td>";
				tag += "<td style='text-align:right'>" + json[i].out_total_price + "</td>";
				tag += "</tr>";

				in_cnt = Number(in_cnt) + Number(uncomma(json[i].in_cnt));
				in_price = Number(in_price) + Number(uncomma(json[i].in_price));
				in_total_price = Number(in_total_price) + Number(uncomma(json[i].in_total_price));
				out_cnt = Number(out_cnt) + Number(uncomma(json[i].out_cnt));
				out_price = Number(out_price) + Number(uncomma(json[i].out_price));
				out_total_price = Number(out_total_price) + Number(uncomma(json[i].out_total_price));
			}
			
			tag += "<tr>";
			tag += "<td colspan='2' style='background-color:#e5e4e8'>합계산출</td>";
			tag += "<td style='text-align:right'>" + comma(in_cnt) + "</td>";
			tag += "<td style='text-align:right'>" + comma(in_price) + "</td>";
			tag += "<td style='text-align:right'>" + comma(in_total_price) + "</td>";
			tag += "<td style='text-align:right'>" + comma(out_cnt) + "</td>";
			tag += "<td style='text-align:right'>" + comma(out_price) + "</td>";
			tag += "<td style='text-align:right'>" + comma(out_total_price) + "</td>";
			tag += "</tr>";
		} else {
			tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#in_out tbody").html(tag);
	});
	showModal('viewItemModal');
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

function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
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

function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
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
	var type = 1;

	if(type == 1) {
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
function setItem(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("");
	else $("#where").val(" where classify=" + val);
	getData(1);
}

$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1);
	});
});
</script>