<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<!-- 검색 모달 -->
		<div class="wrap_search_pop">	
			<div class="search_pop_content">
				<div class="input-group">
					<div class="col-xs-12">
						<? $this->periodSearch("searchDate()","검사일자검색"); ?>
						<select name="search_classify" id="search_classify" style="height:35px; width:100%; margin-top:10px;">
							<option value="0">== 검색구분 ==</option>
							<option value="item_cd">품번</option>
							<option value="item_nm">품명</option>								
						</select>					
						<input type="text" name="search_txt" id="search_txt" class="search_input" />									
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
		<div class="page-content">		
			<div>
				<div class="col-xs-12">
					<input type='button' class="comm_title" value="품질검사 대기" />
					<table class="table table-bordered table-striped" id="tb">
						<thead>
							<tr>
								<th class="detail-col center" style="width:27%">
									품번
								</th>
								<th class="detail-col center" style="width:36%">
									품명
								</th>
								<th class="detail-col center" style="width:17%">
									검사수량
								</th>								
								<th class="detail-col center" style="width:20%">
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

				<!--
				<div class="col-xs-12" style="border:1px solid #ccc; height:750px; overflow: scroll; overflow-x: hidden;">
					<div style="height:100%; padding-top:10px;">
						<form id='frm'>
							<input type="hidden" name="mode" id="mode" value="registQcResult" />
							<input type="hidden" name="uids" id="uid" />
							<div>
								<div><input type="button" class="btn btn-xs btn-pink" value="품목정보" /></div>
								<table class="table table-bordered">
									<tr>
										<? $this->th("작지번호") ?>
										<td class="col-xs-8">
											<input type="text" name="work_cd" id="work_cd" validation="yes" err="작지번호를 입력하세요" readonly />
										</td>
									</tr>
									<tr>
										<? $this->th("품번") ?>
										<td class="col-xs-8">
											<input type="text" name="item_cd" id="item_cd" validation="yes" err="품번을 입력하세요" readonly />
										</td>
									</tr>
									<tr>
										<? $this->th("품명") ?>
										<td class="col-xs-8">
											<input type="text" name="item_nm" id="item_nm" validation="yes" err="품명을 입력하세요" readonly />
										</td>
									</tr>
									<tr>
										<? $this->th("규격") ?>
										<td class="col-xs-8">
											<input type="text" name="standard" id="standard" readonly />
										</td>
									</tr>
									<tr>
										<? $this->th("검사지시수량") ?>
										<td class="col-xs-8">
											<input type="text" name="cnt" id="cnt" readonly />
										</td>
									</tr>
									<tr>
										<? $this->th("Lot No") ?>
										<td class="col-xs-8">
											<input type="text" name="lot_no" id="lot_no" readonly />
										</td>
									</tr>
								</table>

								<div><input type="button" class="btn btn-xs btn-pink" value="검사항목" /></div>
								<table id="qc" class="table table-bordered">
									<thead>
										<tr>
											<? $this->th("검사항목") ?>
											<? $this->th("부적격수량") ?>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>

							<div class="col-md-12 center">
								<button class="btn btn-info" type="button" onclick="formSubmit()">
									<i class="ace-icon fa fa-check bigger-110"></i>
									검사결과등록
								</button>
								<button class="btn btn-default" type="button" onclick="formClear()">
									<i class="ace-icon fa fa-check bigger-110"></i>
									새로고침
								</button>
							</div>
						</form>
					</div>
				</div>-->				
			</div>
		</div>
	</div>
</div>

<!-- 상세보기 -->
<div class="modal fade" id="viewQcModal" data-backdrop="static" data-keyboard="false">
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
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; width:25%"><i class="ace-icon fa fa-caret-right blue"></i>품번</th>
							<td><span id="q_item_cd"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>품명</th>
							<td><span id="q_item_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>규격</th>
							<td><span id="q_standard"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>검사수량</th>
							<td><span id="q_cnt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>LOT NO</th>
							<td><span id="q_lot_no"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>검사신청일</th>
							<td><span id="q_create_dt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>상태</th>
							<td><span id="q_state"></span></td>
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
	formClear();
	getData(1);
}
// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

$(document).ready(function(){


	var page = $("#page").val();
	getData(page);
	getFaultyReason();

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
	deleteSelect("qc");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#uid").val("");
	$("#work_cd").val("");
	$("#item_cd").val("");
	$("#item_nm").val("");
	$("#standard").val("");
	$("#cnt").val("");
	$("#lot_no").val("");

	$("#frm")[0].reset();
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
// 품목리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getQcList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postData(" + json[i].uid + ");\" style='cursor:pointer'>";
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
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					//tag += "<td>" + json[i].standard + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].cnt) + "</td>";
					//tag += "<td>" + json[i].lot_no + "</td>";
					//tag += "<td>" + json[i].create_dt + "</td>";
					tag += "<td>" + json[i].state + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='12' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "qc";
			getPaging(table, $("#where").val(), $("#per").val(), 4);
		}
	);
}

function postData(uid) {
	$("#uid").val(uid);
	var parameter = {"mode" : "getQc", "uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#q_item_cd").html(json.item_cd);
			$("#q_item_nm").html(json.item_nm);
			$("#q_standard").html(json.standard);
			$("#q_cnt").html(comma(json.cnt));
			$("#q_lot_no").html(json.lot_no);
			$("#q_create_dt").html(json.create_dt);
			$("#q_state").html(json.state);
		}
	});
	showModal('viewQcModal');
}
//==================================================
// 선택한 품목 처리
//==================================================
/*
function postData(uid, work_cd,item_cd, item_nm, standard, cnt, lot_no, create_dt, state) {
	$("#uid").val(uid);
	$("#work_cd").val(work_cd);
	$("#item_cd").val(item_cd);
	$("#item_nm").val(item_nm);
	$("#standard").val(standard);
	$("#cnt").val(cnt);
	$("#lot_no").val(lot_no);
}
*/
//==================================================
// 검사항목 가져오기
//==================================================
function getFaultyReason() {
	var tag = "";
	var parameter = {"mode" : "getFaultyReason"};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr>";
				tag += "<td><input type='hidden' name='faulty_uid[]' id='faulty_uid' value='" + json[i].uid + "' /><strong>" + json[i].reason + "</strong></td>";
				tag += "<td><input type='text' name='faulty_cnt[]' id='faulty_cnt' style='width:150px' value='0' onclick=\"this.value=''\" /></td>";
				tag += "</tr>";
			}
		} else {
			tag = "<tr><td colspan='3' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#qc tbody").html(tag);
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

	$("#where").val(" where " + search_classify +" like '%" + search_txt + "%'");
	getData(1);
}

//==================================================
// 견적서 등록
//==================================================
function formSubmit() {
	if(check("frm")) {
		var parameter = $("#frm").serialize();
		$.ajax({
			type : "post",
			data : parameter,
			url : "ajax.php",
			success : function(str) {
				if(str == "success") getData(1);
				else showAlert(str);
			}
		});
	}
}

//검색
$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1);
	});
});
</script>