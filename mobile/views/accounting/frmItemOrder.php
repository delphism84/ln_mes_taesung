<?
require_once("library/caseby.php");

$year = date("Y");	//년
$month = date("m");	//월
$first = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
//$first = date("Y-m-d", strtotime("-1 week", time())); // 전 달 

$Oldyear5 = date("Y")-5;
$Oldyear4 = date("Y")-4;
$Oldyear3 = date("Y")-3;
$Oldyear2 = date("Y")-2;
$Oldyear1 = date("Y")-1;
$year = date("Y");

$month = date("m");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<!-- 검색 모달 -->
		<div class="input-group">
						
			<select name="s_year" id="s_year" onchange="changeYearMonth()" class="form-control" style="width:100px;">
				<option value='<?=$year?>' selected><?=$year?></option>
				<option value='<?=$Oldyear1?>'><?=$Oldyear1?></option>
				<option value='<?=$Oldyear2?>'><?=$Oldyear2?></option>
				<option value='<?=$Oldyear3?>'><?=$Oldyear3?></option>
				<option value='<?=$Oldyear4?>'><?=$Oldyear4?></option>
				<option value='<?=$Oldyear5?>'><?=$Oldyear5?></option>
			</select>

			<select name="s_month" id="s_month" onchange="changeYearMonth()" class="form-control" style="width:100px;">
				<option value='01'<?if($month == "01") echo "selected" ?> >01월</option>
				<option value='02'<?if($month == "02") echo "selected" ?> >02월</option>
				<option value='03'<?if($month == "03") echo "selected" ?> >03월</option>
				<option value='04'<?if($month == "04") echo "selected" ?> >04월</option>
				<option value='05'<?if($month == "05") echo "selected" ?> >05월</option>
				<option value='06'<?if($month == "06") echo "selected" ?> >06월</option>
				<option value='07'<?if($month == "07") echo "selected" ?> >07월</option>
				<option value='08'<?if($month == "08") echo "selected" ?> >08월</option>
				<option value='09'<?if($month == "09") echo "selected" ?> >09월</option>
				<option value='10'<?if($month == "10") echo "selected" ?> >10월</option>
				<option value='11'<?if($month == "11") echo "selected" ?> >11월</option>
				<option value='12'<?if($month == "12") echo "selected" ?> >12월</option>
			</select>
		
			<input type="hidden" name="item_cd" id="item_cd" />
			<input type="text" name="item_nm" id="item_nm" style="height:35px; margin-left:3px" onclick="showModal('itemModal')" placeholder="[품목 Click]" readonly />
			<input type="text" name="standard" id="standard" style="height:35px; margin-left:3px" onclick="showModal('itemModal')"  placeholder="[품목 Click]" readonly />
			<input type="button" class="btn btn-xs btn-purple" onclick="search()" value="검색" style="height:35px; margin-bottom:4px" />
			<button type="button" class="btn btn-success btn-xs" onclick="refresh()" style="height:35px; margin-bottom:4px">
				<span class="fa fa-refresh icon-on-right bigger-110"></span>
			</button>
		</div>
		<!-- //검색 모달 -->
		<div class="page-content">
			<div>				
				<div class="col-xs-12">
					<div class="col-xs-12">
						<?							
						echo "<input type='button' class='comm_title' value='품목별 발주현황' />";
						echo "</div>";
						$this->noCheckTable("tb","거래일,품목명,규격,업체,입고량,단가");
						$this->paging();
						?>
					</div>
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
require_once ("views/modal/itemModal.php");
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
	getData(1);
}

$(document).ready(function(){
	var page = $("#page").val();	
	getData(page);
	getItemList();
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

function refresh(){
	$("#uid").val("");
	$("#where").val("");

	$("#item_cd").val("");
	$("#item_nm").val("");
	$("#standard").val("");

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
	var parameter = {"mode" : "getItemPurchaseList", "s_year" : $("#s_year").val(), "s_month" : $("#s_month").val() , "where" : $("#where").val() };

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this);\" style='cursor:pointer'>";
					tag += "<td style='vertical-align:middle'>" + json[i].days + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].item_nm + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].item_cd + "</td>";					
					tag += "<td style='vertical-align:middle'>" + json[i].account_nm + "</td>";		
					tag += "<td style='vertical-align:middle'>" + comma(json[i].cnt) + "</td>";								
					tag += "<td style='vertical-align:middle;'>" + comma(json[i].price) + "</td>";
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
// 선택 품목 처리
//==================================================
function postItem(uid) {
	var parameter = {"mode" : "getItem", "item_uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json){
		if(json != null) {
			$("#item_cd").val(json.item_cd);
			$("#item_nm").val(json.item_nm);
			$("#standard").val(json.standard);
			hideModal("itemModal");
		}
	});
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
//검색
$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1)
	})
})
</script>