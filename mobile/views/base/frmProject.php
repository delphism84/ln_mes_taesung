<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-12">
						<div>
							<div class="input-group" style="width:100%; margin-bottom:10px;">								
								<select name="search_classify" id="search_classify" style="float:left; height:35px; width:100%;" onchange="setItem(this.value)">
									<option value="0">=검색구분=</option>
									<option value="생산">생산</option>
									<option value="개발">개발</option>
								</select>								
							</div>
							<div class="input-group" style="width:100%; margin-bottom:10px;">
								<input type="text" class=" search-query" name="search_txt" id="search_txt" style="float:left; height:35px; width:77%;"/>						
								<button type="button" class="btn btn-purple btn-sm" onclick="search()" style="float:left; height:35px">
									<span class="fa fa-search icon-on-right bigger-110"></span>
								</button>
								<button type="button" class="btn btn-success btn-sm" onclick="refresh()" style="float:left; height:35px">
									<span class="fa fa-refresh icon-on-right bigger-110"></span>
								</button>
							</div>
						</div>
						<div style="float:right; text-align:right">
							<!--<input type="button" class="btn btn-xs btn-success" value="인쇄" />-->
							<!--
							<input type="button" class="btn btn-xs btn-danger" value="선택삭제" data-toggle="modal" data-target="#confirm-delete" style="height:35px" />
							-->
						</div>
						<div>
							<input type="button" class="btn btn-xs btn-pink" value="프로젝트 리스트" style="float:left; height:35px" />
						</div>
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
										구분
									</th>
									<th class="detail-col center">
										프로젝트명
									</th>
									<th class="detail-col center">
										책임자
									</th>									
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<!--
						<? $this->table("tb","구분=>2,프로젝트명=>4,책임자=>1,거래처=>2,프로젝트기간=>3"); ?>
						-->
						<? $this->paging() ?>
					</div>
					<!--
					<div class="col-xs-12" style="border:1px solid #ccc; height:100%; overflow: scroll; overflow-x: hidden; padding-top:10px">
						<div>
							<form id='frm'>
								<input type="hidden" name="mode" id="mode" value="registProject" />
								<input type="hidden" name="uid" id="uid" />
								<div>
									<div><input type="button" class="btn btn-xs btn-pink" value="프로젝트 등록" /></div>
									<table class="table table-bordered">
										<tr>
											<? $this->th("프로젝트 구분") ?>
											<td class="col-xs-8">
												<select name="classify" id="classify">
													<option value="생산">생산</option>
													<option value="개발">개발</option>
												</select>
											</td>
										</tr>
										<tr>
											<? $this->th("프로젝트명") ?>
											<td class="col-xs-8"><input type="text" name="project_nm" id="project_nm" validation="yes" err="프로젝트명을 입력하세요" /></td>
										</tr>
										<tr>
											<? $this->th("거래처") ?>
											<td class="col-xs-8">
												<input type="hidden" name="account_cd" id="account_cd" validation="yes" err="거래처를 선택하세요" />
												<input type="text" name="account_nm" id="account_nm" validation="yes" err="거래처명을 입력하세요" onclick="showModal('accountModal')" />
											</td>
										</tr>
										<tr>
											<? $this->th("담당자") ?>
											<td class="col-xs-8">
												<input type="hidden" name="emp_id" id="emp_id" validation="yes" err="담당자를 선택하세요"/>
												<input type="text" name="emp_nm" id="emp_nm" validation="yes" err="담당자명을 입력하세요" onclick="showModal('employeeModal')" />
											</td>
										</tr>
										<tr>
											<? $this->th("프로젝트 시작일") ?>
											<td class="col-xs-8">
												<div>
													<span class="input-icon input-icon-right">
														<div class="input-group">
															<input class=" date-picker" name="start_dt" id="start_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="납품기한을 입력하세요" readonly />
															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
														</div>
													</span>
												</div>
											</td>
										</tr>
										<tr>
											<? $this->th("프로젝트 종료일") ?>
											<td class="col-xs-8">
												<div>
													<span class="input-icon input-icon-right">
														<div class="input-group">
															<input class=" date-picker" name="end_dt" id="end_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="납품기한을 입력하세요" readonly />
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
										<span id="btnSubmitTxt">프로젝트 등록</span>
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
</div>

<input type="hidden" name="per" id="per" value="16" />
<input type="hidden" name="account_where" id="account_where" />
<input type="hidden" name="account_page" id="account_page" value="1" />
<input type="hidden" name="employee_where" id="employee_where" />
<input type="hidden" name="employee_page" id="employee_page" value="1" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<div class="modal fade" id="accountModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:500px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">거래처 리스트</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:510px">
				<div style="margin-bottom:5px">
					<div class="input-group">						
						<input type="text" class="form-control search-query" placeholder="거래처명" name="account_search_txt" id="account_search_txt" />
						<span class="input-group-btn">
							<button type="button" class="btn btn-purple btn-sm" onclick="account_search()">
								<span class="fa fa-search icon-on-right bigger-110"></span>
							</button>
							<button type="button" class="btn btn-success btn-sm" onclick="account_refresh()">
								<span class="fa fa-refresh icon-on-right bigger-110"></span>
							</button>
						</span>
					</div>
				</div>
				<? $this->noCheckTable("accountListTb","구분=>2,거래처코드=>4,거래처명=>6"); ?>
				<div id="account_paging_area" style="text-align:center"></div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="employeeModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:800px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">사원 리스트</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:510px">
				<div style="margin-bottom:5px">
					<div class="input-group">						
						<input type="text" class="form-control search-query" placeholder="사원명" name="employee_search_txt" id="employee_search_txt" />
						<span class="input-group-btn">
							<button type="button" class="btn btn-purple btn-sm" onclick="employee_search()">
								<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
							</button>
							<button type="button" class="btn btn-success btn-sm" onclick="employee_refresh()">
								<span class="fa fa-refresh icon-on-right bigger-110"></span>
							</button>
						</span>
					</div>
				</div>
				<? $this->noCheckTable("employeeListTb","사원코드=>2,사원명=>2,부서=>6,직위=>2"); ?>
				<div id="employee_paging_area" style="text-align:center"></div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function refresh() {
	$("#classify").val(0);
	$("#search_txt").val("");
	$("#page").val(1);
	$("#where").val("");
	$("#uid").val("");
	getData(1);
	formClear();
}

function account_refresh() {
	$("#account_search_txt").val("");
	$("#account_where").val("");
	$("#account_page").val(1);
	getAccountList();
}

function search() {
	var search_classify = $("#search_classify option:selected").val();
	var search_txt = $("#search_txt").val();

	if(search_classify == 0) {
		showAlert("검색구분을 선택하세요");
		return false;
	}

	if(search_txt == "") {
		showAlert("검색어를 입력하세요");
		return false;
	}

	$("#where").val("where classify='" + search_classify + "' and project_nm like '%" + search_txt + "%'");
	getData(1);
}

//==================================================
// 거래처 검색
//==================================================
function account_search(){
	var txt = $("#account_search_txt").val();
	
	if(txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#account_where").val(" where account_nm like '%" + txt + "%' ");

	getAccountList(1);
}

function employee_refresh() {
	$("#employee_search_txt").val("");
	$("#employee_where").val("");
	$("#employee_page").val(1);
	getEmployeeList();
}

//==================================================
// 사원 검색
//==================================================
function employee_search(){
	var txt = $("#employee_search_txt").val();
	
	if(txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#employee_where").val(" where emp_nm like '%" + txt + "%' ");

	getEmployeeList(1);
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
	getAccountList();
	getEmployeeList();

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

	// 프로젝트 등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
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
	deleteSelect("project");
	hideModal("confirm-delete");
	formClear();
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#uid").val("");
	$("#frm")[0].reset();
	$("#btnSubmitTxt").text("프로젝트 등록");
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
// 프로젝트 리스트 가져오기
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getProjectList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postProject(" + json[i].uid + ",'" + json[i].classify + "', '" + json[i].project_nm + "', '" + json[i].account_cd + "', '" + json[i].account_nm + "', '" + json[i].emp_id + "', '" + json[i].emp_nm + "', '" + json[i].start_dt + "', '" + json[i].end_dt + "');\" style='cursor:pointer'>";

					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>

					tag += "<td>" + json[i].classify + "</td>";
					tag += "<td>" + json[i].project_nm + "</td>";
					tag += "<td>" + json[i].emp_nm + "</td>";
					//tag += "<td>" + json[i].account_nm + "</td>";
					//tag += "<td>" + json[i].period + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "project";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function postProject(uid, classify, project_nm, account_cd, account_nm, emp_id, emp_nm, start_dt, end_dt) {
	$("#uid").val(uid);
	$("#classify").val(classify);
	$("#project_nm").val(project_nm);
	$("#account_cd").val(account_cd);
	$("#account_nm").val(account_nm);
	$("#emp_id").val(emp_id);
	$("#emp_nm").val(emp_nm);
	$("#start_dt").val(start_dt);
	$("#end_dt").val(end_dt);

	$("#btnSubmitTxt").text("프로젝트 수정");
}

//==================================================
// 사원 리스트 가져오기
//==================================================
function getEmployeeList() {
	var tag = "";
	var parameter = {"mode" : "getEmployeeList", "where" : $("#employee_where").val(), "rpp" : 10, "page" : $("#employee_page").val()};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr onclick=\"postEmployee('" + json[i].emp_id + "', '" + json[i].emp_nm + "')\" style='cursor:pointer'>";
				tag += "<td>" + json[i].emp_cd + "</td>";
				tag += "<td>" + json[i].emp_nm + "</td>";
				tag += "<td>" + json[i].department + "</td>";
				tag += "<td>" + json[i].position_nm + "</td>";
				tag += "</tr>";
			}
		} else {
			tag = "<tr><td colspan='4' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#employeeListTb tbody").html(tag);

		var table = "employee";
		getEmployeePaging(table, $("#employee_where").val(), 10, 4);
	});
}

//==================================================
// 사원 페이지 세트
//==================================================
function setEmployeePage(page){
	$("#employee_page").val(page);
	getEmployeeList(page);
}

//==================================================
// 사원 페이징 가져오기
//==================================================
function getEmployeePaging(table,where,rpp,adjacents){
	var data_string = "page=" + $("#employee_page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents;

	$.ajax({
		type : "post",
		url : "_get_employee_paging.php",
		data : data_string,
		success : function(str) {
			$("#employee_paging_area").html(str);
		}
	});
}

//==================================================
// 사원 검색
//==================================================
function employee_search(){
	var txt = $("#employee_search_txt").val();
	
	if(txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#employee_where").val(" where emp_nm like '%" + txt + "%' ");

	getEmployeeList(1);
}

//==================================================
// 선택 사원 처리
//==================================================
function postEmployee(emp_id, emp_nm) {
	$("#emp_id").val(emp_id);
	$("#emp_nm").val(emp_nm);
	hideModal("employeeModal");
}

//==================================================
// 거래처 리스트 가져오기
//==================================================
function getAccountList() {
	var tag = "";
	var parameter = {"mode" : "getAccountList", "where" : $("#account_where").val(), "rpp" : 10, "page" : $("#account_page").val()};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr onclick=\"postAccount('" + json[i].account_cd + "', '" + json[i].account_nm + "')\" style='cursor:pointer'>";
				tag += "<td>" + json[i].classify_nm + "</td>";
				tag += "<td>" + json[i].account_cd + "</td>";
				tag += "<td>" + json[i].account_nm + "</td>";
				tag += "</tr>";
			}
		} else {
			tag = "<tr><td colspan='3' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#accountListTb tbody").html(tag);

		var table = "account";
		getAccountPaging(table, $("#account_where").val(), 10, 2);
	});
}

//==================================================
// 거래처 검색
//==================================================
function account_search(){
	var txt = $("#account_search_txt").val();
	
	if(txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#account_where").val(" where account_nm like '%" + txt + "%' ");

	getAccountList(1);
}

//==================================================
// 거래처 페이지 세트
//==================================================
function setAccountPage(page){
	$("#account_page").val(page);
	getAccountList(page);
}

//==================================================
// 거래처 페이징 가져오기
//==================================================
function getAccountPaging(table,where,rpp,adjacents){
	var data_string = "page=" + $("#account_page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents;

	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#account_paging_area").html(str);
		}
	});
}

//==================================================
// 선택 거래처 처리
//==================================================
function postAccount(account_cd, account_nm) {
	$("#account_cd").val(account_cd);
	$("#account_nm").val(account_nm);
	$("#obtain_account_cd").val(account_cd);
	$("#obtain_account_nm").val(account_nm);
	hideModal("accountModal");
}



//==================================================
// 품목구분 품목 리스트 가져오기
//==================================================
function setItem(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("");
	else $("#where").val("where classify='" + val + "'");
	getData(1);
}
</script>