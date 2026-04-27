<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">			
			<div>
				<!--
				<div class="col-xs-12">
					<table class="table table-bordered">
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1; width:20%;">공정</th>
							<td style="vertical-align:middle">
								<?
								$sql = "select * from process";
								$this->query($sql);
								$i = 0;
								while($t = $this->fetch()){
									echo "<label class='pos-rel'>";
									echo "<input type='checkbox' class='pc' id='process_".$i."' value='".$t->uid."' onclick='getMachine(); getData(1);' />";
									echo "<span class='lbl'>&nbsp;".$t->process_nm."</span>";
									echo "</label>&nbsp;&nbsp;";
									$i++;
								}
								?>														
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">설비</th>
							<td>
								<div id="machine_area"></div>
							</td>
						</tr>
					</table>
				</div>
				-->
			</div>
			<div>
				<div class="col-xs-12">
					<input type='button' class='comm_title' value='작업지시 현황' />
					<table class="table table-bordered table-striped" id="tb">
						<thead>
							<tr>
								<th class="detail-col center">
									작업품목
								</th>
								<th class="detail-col center">
									작업공정
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
			</div>			
		</div>
	</div>
</div>

<!-- 상세보기 -->
<div class="modal fade" id="viewWorkModal" data-backdrop="static" data-keyboard="false">
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
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; width:25%"><i class="ace-icon fa fa-caret-right blue"></i>작지번호</th>
							<td><span id="p_work_cd"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>거래처</th>
							<td><span id="p_account_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>작업품번</th>
							<td><span id="p_item_cd"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>작업품목</th>
							<td><span id="p_item_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>작업규격</th>
							<td><span id="p_standard"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>작업공정</th>
							<td><span id="p_process_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>작업설비</th>
							<td><span id="p_machine_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>지시수량</th>
							<td><span id="p_cnt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>잔여수량</th>
							<td><span id="p_remain_cnt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>작업일</th>
							<td><span id="p_work_dt"></span></td>
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

<input type="hidden" name="per" id="per" value="10" />

<?
$this->hidden("where status!='작업완료'");
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
require_once ("views/modal/accountModal.php");
require_once ("views/modal/itemModal.php");
?>



<script>
function getMachine() {
	var where  = "";
	var arr = new Array();

	$(".pc").each(function(){
		if($(this).is(":checked") == true) {
			arr.push($(this).val());
		}		
	});

	for(var i = 0 ; i < arr.length ; i++){
		if(i == 0) where = "where process_cd=" + arr[i];
		else where += " or process_cd=" + arr[i];
	}

	var parameter = {"mode" : "getProductProcessMachine", "where" : where};
	var tag = "";
	$.getJSON("ajax.php",{"parameter" : parameter},function(json){
		if(json != null){
			for (var i  = 0 ; i < json.length ; i++){
				tag += "<label class='pos-rel'><input type='checkbox' class='mc' id='machine_" + i + "' value='" + json[i].uid + "' onclick='getData(1)' /><span class='lbl'>&nbsp;" + json[i].machine_nm + "</span></label>&nbsp;&nbsp;";
			}

			$("#machine_area").html(tag);
		}
	});
}

function refresh() {
	$("#page").val(1);
	$("#where").val("where state!='작업완료'");
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
	var where  = $("#where").val();
	var pc_arr = new Array();	
	var mc_arr = new Array();

	$(".pc").each(function(){
		if($(this).is(":checked") == true) {
			pc_arr.push($(this).val());
		}		
	});

	if(pc_arr.length > 0) {
		for(var i = 0 ; i < pc_arr.length ; i++){
			if(i == 0) where = " and (process=" + pc_arr[i];
			else where += " or process=" + pc_arr[i];
		}

		where += ")";
	}

	$(".mc").each(function(){
		if($(this).is(":checked") == true) {
			mc_arr.push($(this).val());
		}		
	});

	if(mc_arr.length > 0) {
		where += " and ("
		for(var i = 0 ; i < mc_arr.length ; i++){
			if(i == 0) where += "machine=" + mc_arr[i];
			else where += " or machine=" + mc_arr[i];
		}
		where += ")";
	}

	//alert(where);

	$("#where").val(where);


	var tag = "";
	var parameter = {"mode" : "getWorkList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick='toggle(this); postData(" + json[i].uid + ");' style='cursor:pointer'>";

					//tag += "<td>" + json[i].work_cd + "</td>";
					//tag += "<td>" + json[i].account_nm + "</td>";
					//tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					//tag += "<td >" + json[i].standard + "</td>";
					tag += "<td>" + json[i].process_nm + "</td>";
					//tag += "<td>" + json[i].machine_nm + "</td>";
					//tag += "<td>" + json[i].cnt + "</td>";
					//tag += "<td style='text-align:right'>" + json[i].remain_cnt + "</td>";
					//tag += "<td>" + json[i].work_dt + "</td>";
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
/*
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
*/
function postData(uid) {
	$("#uid").val(uid);
	var parameter = {"mode" : "getWork", "uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#p_work_cd").html(json.work_cd);
			$("#p_account_nm").html(json.account_nm);
			$("#p_item_cd").html(json.item_cd);
			$("#p_item_nm").html(json.item_nm);
			$("#p_standard").html(json.standard);
			$("#p_process_nm").html(json.process_nm);
			$("#p_machine_nm").html(json.machine_nm);
			$("#p_cnt").html(comma(json.cnt));
			$("#p_remain_cnt").html(comma(json.remain_cnt));
			$("#p_work_dt").html(json.work_dt);
			$("#p_state").html(json.state);
		}
	});
	showModal('viewWorkModal');
	//$("#btnSubmitTxt").text("품목수정");
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