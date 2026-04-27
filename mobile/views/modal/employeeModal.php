<input type="hidden" name="modal_employee_where" id="modal_employee_where" />
<input type="hidden" name="modal_employee_page" id="modal_employee_page" value="1" />

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
						<input type="text" class="form-control search-query" placeholder="사원명" name="modal_employee_search_txt" id="modal_employee_search_txt" />
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
function employee_refresh() {
	$("#modal_employee_search_txt").val("");
	$("#modal_employee_where").val("");
	$("#modal_employee_page").val(1);
	getEmployeeList();
}

//==================================================
// 사원 리스트 가져오기
//==================================================
function getEmployeeList() {
	var tag = "";
	var parameter = {"mode" : "getEmployeeList", "where" : $("#modal_employee_where").val(), "rpp" : 10, "page" : $("#modal_employee_page").val()};
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
		getEmployeePaging(table, $("#modal_employee_where").val(), 10, 4,"setModalEmployeePage");
	});
}

//==================================================
// 사원 페이지 세트
//==================================================
function setModalEmployeePage(page){
	$("#modal_employee_page").val(page);
	getEmployeeList(page);
}

//==================================================
// 사원 페이징 가져오기
//==================================================
function getEmployeePaging(table,where,rpp,adjacents,setPage){
	var data_string = "page=" + $("#modal_employee_page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents + "&setPage=" + setPage;

	$.ajax({
		type : "post",
		url : "_get_paging.php",
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
	var search_txt = $("#modal_employee_search_txt").val();
	
	if(search_txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#modal_employee_where").val("where emp_nm like '@" + search_txt + "@' or emp_cd like '@" + search_txt + "@' or emp_id like '@" + search_txt + "@'");

	getEmployeeList();
}
</script>