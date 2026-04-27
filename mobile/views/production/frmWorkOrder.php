<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row" style="margin-top:10px">
				<div class="col-xs-12">
					<div>
						<div class="input-group">
							<select name="process" id="process" style="float:left; height:35px;width:100%;" onchange="getSearchMachine(this.value); setWhere()">
								<option>==공정==</option>
							</select>
							<select name="machine" id="machine" style="float:left; height:35px;width:100%; margin-top:10px;" onchange="setWhere()">
								<option>==설비==</option>
							</select>
							<? $this->periodSearch("searchDate()","작업일자검색"); ?>
							<!-- <select name="search_classify" id="search_classify" style="height:35px; margin-left:5px">
								<option value="0">선택</option>
								<option value="item_cd">품번</option>
								<option value="item_nm">품명</option>
								<option value="account_nm">거래처</option>
							</select>					 -->
							<input type="text" name="search_txt" id="search_txt" style="height:35px; width:77%; margin-top:10px;" />
							<input type="button" class="btn btn-xs btn-purple" onclick="search()" value="검색" style="height:35px; margin-bottom:4px" />
							<button type="button" class="btn btn-success btn-xs" onclick="refresh()" style="height:35px; margin-bottom:4px">
								<span class="fa fa-refresh icon-on-right bigger-110"></span>
							</button>
						</div>
					</div>
				</div>
				<div class="col-xs-12" style="margin-top:5px">
					<div class="col-xs-12" style="border:1px solid #ccc;padding-top:10px">
						<?
						if($_SESSION['login_level'] >= 99) {
							echo "<div style='float:left'>";
							echo "<input type='button' class='btn btn-xs btn-pink' value='작업지시서 리스트' />";
							echo "</div>";
							echo "<div style='float:right'>";
							//echo "<input type='button' class='btn btn-xs btn-primary' value='작업보류' onclick='deferWork()' style='margin-right:3px;' />";
							//echo "<input type='button' class='btn btn-xs btn-success' value='작업재지시' onclick='restartWork()' style='margin-right:3px;' />";
							//echo "<input type='button' class='btn btn-xs btn-danger' value='작업취소' onclick='cancelWork()' />";
							echo "</div>";

							//$this->table("tb","작지번호=>1,거래처=>2,작업품번=>1,작업품목=>1,작업규격=>1,작업공정=>1, 작업설비=>1,지시수량=>1,잔여수량=>1,작업일=>1,상태=>1");
						} else {
							echo "<div style='float:left'>";
							echo "<input type='button' class='btn btn-xs btn-pink' value='작업지시서 리스트' />";
							echo "</div>";

							//$this->noCheckTable("tb","작지번호=>1,거래처=>2,작업품번=>1,작업품목=>1,작업규격=>1,작업공정=>1, 작업설비=>1,지시수량=>1,잔여수량=>1,작업일=>1,상태=>1");
						}
						?>
						<table class="table table-bordered table-striped" id="tb">
							<thead>
								<tr>
									<th class="detail-col center">
										<label class="pos-rel">
											<input type="checkbox" class="ace" id="checkedAll" />
											<span class="lbl"></span>
										</label>
									</th>
									<th class="detail-col center">
										작지번호
									</th>
									<th class="detail-col center">
										거래처
									</th>
									<th class="detail-col center">
										작업품번
									</th>									
									<th class="detail-col center">
										작업품목
									</th>
									<th class="detail-col center">
										작업규격
									</th>
									<th class="detail-col center">
										작업공정
									</th>
									<th class="detail-col center">
										작업설비
									</th>
									<th class="detail-col center">
										지시수량
									</th>
									<th class="detail-col center">
										잔여수량
									</th>
									<th class="detail-col center">
										작업일
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
						$this->paging() 
						?>
					</div>
					<!--
					<div class="col-xs-12" style="border:1px solid #ccc; height:370px; border-top:none">
						<div style="height:100%; padding-top:10px;">
							<form id='frm'>
								<input type="hidden" name="mode" id="mode" value="registWork" />
								<input type="hidden" name="uid" id="uid" />
								<div>
									<div><input type="button" class="btn btn-xs btn-pink" value="작업지시서 작성" /></div>
									<table class="table table-bordered">
										<tr>
											<? $this->th("작업순서") ?>
											<td><input type="text" name="command_work_seq" id="command_work_seq" /></td>
											<? $this->th("작지번호") ?>
											<td><input type="text" name="work_cd" id="work_cd" /></td>
											<? $this->th("작업시작일") ?>
											<td>
												<div>
													<span class="input-icon input-icon-right">
														<div class="input-group">
															<input class="date-picker" name="work_dt" id="work_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="작업일자를 입력하세요" readonly />
															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
														</div>
													</span>
												</div>
											</td>					
											<? $this->th("거래처") ?>
											<td><input type="hidden" name="command_account_cd" id="command_account_cd" /><input type="text" name="command_account_nm" id="command_account_nm" onclick="showModal('accountModal')" /></td>
										</tr>
										<tr>
											<? $this->th("작업품번") ?>
											<td><input type="text" name="command_work_item_cd" id="command_work_item_cd" onclick="showModal('itemModal')" /></td>
											<? $this->th("작업품목") ?>
											<td><input type="text" name="command_work_item_nm" id="command_work_item_nm" onclick="showModal('itemModal')" /></td>
											<? $this->th("작업규격") ?>
											<td><input type="text" name="command_work_standard" id="command_work_standard" onclick="showModal('itemModal')" /></td>										
											<? $this->th("작업공정") ?>
											<td><select name="command_work_process" id="command_work_process" onchange="getMachine(this.value)"></select></td>
										</tr>
										<tr>
											<? $this->th("작업설비") ?>
											<td><select name="command_work_machine" id="command_work_machine"></select></td>
											<? $this->th("지시수량") ?>
											<td><input type="text" name="command_work_cnt" id="command_work_cnt" /></td>											
											<? $this->th("추가작업수량") ?>
											<td><input type="text" name="add_cnt" id="add_cnt" /></td>
											<? $this->th("생산품입고위치") ?>
											<td><select name="command_warehouse" id="command_warehouse"></select></td>
										</tr>
										<tr>
											<? $this->th("비고");?>
											<td colspan="7"><textarea name="work_memo" id="work_memo" class="form-control" rows="3"></textarea></td>
										</tr>
									</table>
									
									<div class="col-md-12 center">
										<button class="btn btn-info" type="button" id="btnSubmit">
											<i class="ace-icon fa fa-check bigger-110"></i>
											<span id="btnSubmitTxt">작업지시서 등록</span>
										</button>
										<button class="btn" type="button" onclick="formClear()">
											<i class="ace-icon fa fa-check bigger-110"></i>
											새로고침
										</button>
									</div>
								</div>
							</form>
						</div>
						-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="5" />

<?
$this->hidden("where state!='작업완료'");
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
require_once ("views/modal/accountModal.php");
require_once ("views/modal/itemModal.php");
?>



<script>
function setWhere() {
	var process = $("#process option:selected").val();
	var machine = $("#machine option:selected").val();

	if(process != 0 && machine == 0) $("#where").val("where process=" + process);
	else if(process != 0 && machine != 0) $("#where").val("where process=" + process + " and machine=" + machine);
	else if(process == 0 && machine == 0) $("#where").val("");

	$("#page").val(1);
	getData(1);
}
function getSearchProcess(){
	var tag = "<option value='0'>==공정==</option>";
	var parameter = {"mode" : "getProcess"};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null){
			for(var i = 0 ; i < json.length ; i++){
				tag += "<option value='" + json[i].uid + "'>" + json[i].process_nm + "</option>";
			}

			$("#process").html(tag);
		}
	});
}

function getSearchMachine(process){
	var tag = "<option value='0'>==설비==</option>";
	var parameter = {"mode" : "getMachine", "process" : process};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null){
			for(var i = 0 ; i < json.length ; i++){
				tag += "<option value='" + json[i].uid + "'>" + json[i].machine_nm + "</option>";
			}

			$("#machine").html(tag);
		}
	});
}

function refresh() {
	$("#page").val(1);
	$("#where").val();
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
	getSearchProcess();
	getData(page);
	getProcess();
	getItemList();
	getAccountList();
	getWarehouse();

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
					getData($("#page").val());
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


// 생산품 입고 창고
function getWarehouse() {
	var tag = "<option value='0'>다음공정</option>";
	var parameter = {"mode" : "getWarehouseList"};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for (var i = 0 ; i < json.length ; i++)
			{
				tag += "<option value='" + json[i].uid + "'>" + json[i].warehouse_nm + "</option>";
			}

			$("#command_warehouse").html(tag);
		}
	});
}

//==================================================
// 작업보류
//==================================================
function deferWork() {
	if($("#uid").val() == "") {
		showAlert("보류할 작업을 선택하세요");
		return false;
	}

	var parameter = {"mode" : "deferWork", "uid" : $("#uid").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "finish") {
				showAlert("종료된 작업은 보류할 수 없습니다");
			} else if(str == "cancel") {
				showAlert("취소된 작업은 보류할 수 없습니다");
			} else if(str == "stop") {
				showAlert("중단된 작업은 보류할 수 없습니다");
			} else if(str == "stay") {
				showAlert("이미 보류된 작업입니다");
			} else if(str == "success") {
				showAlert("해당 작업을 보류시켰습니다");
				getData($("#page").val());
			}
		}
	});
}

//==================================================
// 작업취소
//==================================================
function cancelWork() {
	if($("#uid").val() == "") {
		showAlert("취소할 작업을 선택하세요");
		return false;
	}

	var parameter = {"mode" : "cancelWork", "uid" : $("#uid").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "finish") {
				showAlert("종료된 작업은 취소 시킬 수 없습니다");
			} else if(str == "ing" || str == "modify") {
				showAlert("진행중인 작업은 취소 시킬 수 없습니다");
			} else if(str == "stop") {
				showAlert("중단된 작업은 취소 시킬 수 없습니다");
			} else if(str == "cancel") {
				showAlert("이미 취소된 작업입니다");
			} else if(str == "success") {
				showAlert("해당 작업을 취소시켰습니다");
				getData($("#page").val());
			}
		}
	});
}

//==================================================
// 작업재지시
//==================================================
function restartWork() {
	if($("#uid").val() == "") {
		showAlert("진행할 작업을 선택하세요");
		return false;
	}

	var parameter = {"mode" : "restartWork", "uid" : $("#uid").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "finish") {
				showAlert("종료된 작업은 재지시 할 수 없습니다");
			} else if(str == "ing" || str == "modify") {
				showAlert("진행중인 작업은 재지시 할 수 없습니다");
			} else if(str == "stop") {
				showAlert("중단된 작업은 재지시 할 수 없습니다");
			} else if(str == "success") {
				showAlert("해당 작업을 재지시 시켰습니다");
				getData($("#page").val());
			} else if(str == "start") {
				showAlert("시작하지 않은 작업은 재지시 시킬 수 없습니다");
			} else if(str == "cancel") {
				showAlert("취소된 작업은 재지시 시킬 수 없습니다");
			}
		}
	});
}


//==================================================
// 선택 거래처 처리
//==================================================
function postAccount(account_cd, account_nm) {
	$("#command_account_cd").val(account_cd);
	$("#command_account_nm").val(account_nm);
	hideModal("accountModal");
}

//==================================================
// 선택 품목 처리
//==================================================
function postItem(item_cd, item_nm, standard, unit) {
	$("#command_work_item_cd").val(item_cd);
	$("#command_work_item_nm").val(item_nm);
	$("#command_work_standard").val(standard);
	hideModal("itemModal");
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
// 날짜별로 데이터 가져오기
//==================================================
function searchDate() {
	var first = $("#start_dt").val();
	var second = $("#end_dt").val();
	if(parseInt(first.replace(/-/g,""),10) > parseInt(second.replace(/-/g,""),10)){
		showAlert("검색 시작일이 검색 종료일 보다 미래일 수 없습니다");
		return;
	}

	var txt = "where (date(work_dt) between '" + first + "' and '" + second + "')";
	$("#where").val(txt);

	getData(1);
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#uid").val("");
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
// 작업지시서 리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getWorkList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postData(" + json[i].uid + ", '" + json[i].work_cd + "', '" + json[i].account_cd + "', '" + json[i].account_nm + "', '" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].process + "', '" + json[i].process_nm + "', '" + json[i].machine + "', '" + json[i].machine_nm + "', '" + json[i].team +"', '" + json[i].team_nm + "', '" + json[i].remain_cnt + "', '" + json[i].work_dt + "', '" + json[i].seq + "', " + json[i].warehouse + ", '" + json[i].work_memo + "')\" style='cursor:pointer'>";
					
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					
					tag += "<td>" + json[i].work_cd + "</td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td >" + json[i].standard + "</td>";
					tag += "<td>" + json[i].process_nm + "</td>";
					tag += "<td>" + json[i].machine_nm + "</td>";
					tag += "<td>" + json[i].cnt + "</td>";
					tag += "<td style='text-align:right'>" + json[i].remain_cnt + "</td>";
					tag += "<td>" + json[i].work_dt + "</td>";
					tag += "<td>" + json[i].state + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "work";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function postData(uid, work_cd, account_cd, account_nm, item_cd, item_nm, standard, process, process_nm, machine, machine_nm, team, team_nm, cnt, work_dt, seq, warehouse, work_memo) {
	$("#uid").val(uid);
	$("#work_cd").val(work_cd);
	$("#work_cd").attr("readonly",true);
	$("#command_account_cd").val(account_cd);
	$("#command_account_cd").attr("disabled",true);
	$("#command_account_nm").val(account_nm);
	$("#command_account_nm").attr("disabled",true);
	$("#command_work_item_cd").val(item_cd);
	$("#command_work_item_nm").val(item_nm);
	$("#command_work_standard").val(standard);
	$("#command_work_seq").val(seq);
	$("#work_dt").val(work_dt);
	$("#command_work_cnt").val(cnt);
	$("#command_work_process").val(process);
	$("#command_warehouse").val(warehouse);
	$("#work_memo").val(work_memo);
	getMachine(process, machine);

	$("#btnSubmitTxt").text("작업지시서 수정");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#uid").val("");
	$("#work_cd").attr("readonly",false);
	$("#command_account_cd").attr("disabled",false);
	$("#command_account_nm").attr("disabled",false);
	$("#frm")[0].reset();
}

function getProcess() {
	var tag = "<option value='0'>== 선택 ==</option>";
	var parameter = {"mode" : "getProcess"};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for (var i = 0 ; i < json.length ; i++)
			{
				tag += "<option value='" + json[i].uid + "'>" + json[i].process_nm + "</option>";
			}
		}

		$("#command_work_process").html(tag);
	});
}

function getMachine(process, machine = null){
	var tag = "<option value='0'>== 선택 ==</option>";
	var parameter = {"mode" : "getMachine", "process" : process};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for (var i = 0 ; i < json.length ; i++)
			{
				tag += "<option value='" + json[i].uid + "'>" + json[i].machine_nm + "</option>";
			}
		}

		$("#command_work_machine").html(tag);

		$("#command_work_machine").val(machine);
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
</script>