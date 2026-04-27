<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row" style="margin-top:10px">
				<div class="col-xs-12">
                    <div class="col-xs-12" style="border:1px solid #ccc; height:100%; overflow: scroll; overflow-x: hidden; padding-top:10px">
                        <table class="table table-bordered">
                            <tr>
                                <th class="col-xs-1" style="background-color:#f1f1f1">기간</th>
                                <td></td>
                                <th class="col-xs-1" style="background-color:#f1f1f1">공정</th>
                                <td></td>
                                <th class="col-xs-1" style="background-color:#f1f1f1">작업자</th>
                                <td></td>
                                <td class="col-xs-1" rowspan="2"><input type="button" class="btn btn-lg btn-success" value="검색" /></td>
                            </tr>
                            <tr>
                                <th class="col-xs-1" style="background-color:#f1f1f1">작업구분</th>
                                <td></td>
                                <th class="col-xs-1" style="background-color:#f1f1f1">설비</th>
                                <td></td>
                                <th class="col-xs-1" style="background-color:#f1f1f1">자재</th>
                                <td></td>
                            </tr>
                        </table>
					</div>
				</div>
				<div class="col-xs-12" style="height:750px; margin-top:5px">
					<div class="col-xs-12" style="border:1px solid #ccc; height:100%; overflow: scroll; overflow-x: hidden; padding-top:10px">
						<?							
						// echo "<div style='float:left; text-align:left'>";
						// echo "<input type='button' class='btn btn-xs btn-pink' value='업체별 세부 매입현황' />";
						// echo "</div>";
						$this->noCheckTable("tb","일자,작업자,구분,상세구분,공정명,설비명,품번,양품수량,단가,합계,불량");						
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="16" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
require_once ("views/modal/accountModal.php");
?>

<script>
function refresh(){
	$("#uid").val("");
	$("#where").val("");
	$("#page").val(1);
	$("#search_classify").val(0);
	$("#search_txt").val("");
	$("#btnSubmit").text("견적등록");
	formClear();
}

$(document).ready(function(){
	var page = $("#page").val();	
	getAccountList();
});

// 콤마찍기
function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

// 콤마풀기
function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

//==================================================
// 
//==================================================
function inputNumberFormat(obj) {
    obj.value = comma(uncomma(obj.value));
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

	var txt = "where (date(estimate_dt) between '" + first + "' and '" + second + "')";
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
	$("#btnSubmit").text("견적등록");
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
// 업체별 세부 판매현황
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getAccountPurchaseList", "account_cd" : $("#account_cd").val(), "start_dt" : $("#start_dt").val(), "end_dt" : $("#end_dt").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this);\" style='cursor:pointer'>";
					tag += "<td style='vertical-align:middle'>" + json[i].create_dt + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].item_nm + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].standard + "</td>";					
					tag += "<td style='vertical-align:middle; text-align:right'>" + comma(json[i].cnt) + "</td>";
					tag += "<td style='vertical-align:middle; text-align:right'>" + comma(json[i].cost) + "</td>";
					tag += "<td style='vertical-align:middle; text-align:right'></td>";
					tag += "<td style='vertical-align:middle; text-align:right'></td>";
					tag += "<td style='vertical-align:middle; text-align:right'>" + comma(json[i].total_cost) + "</td>";
					tag += "<td></td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='12' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);
		}
	);
}

//==================================================
// 선택 거래처 처리
//==================================================
function postAccount(account_cd, account_nm) {
	$("#account_cd").val(account_cd);
	$("#account_nm").val(account_nm);
	hideModal("accountModal");
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
	}

	$("#page").val(1);
	getData(1);
}
</script>