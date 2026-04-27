
<input type="hidden" name="project_where" id="project_where" />
<input type="hidden" name="project_page" id="project_page" value="1" />

<div class="modal fade" id="projectModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:800px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">프로젝트 리스트</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:510px">
				<div style="margin-bottom:5px">
					<div class="input-group">						
						<input type="text" class="form-control search-query" placeholder="프로젝트명" name="project_search_txt" id="project_search_txt" />
						<span class="input-group-btn">
							<button type="button" class="btn btn-purple btn-sm" onclick="project_search()">
								<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
							</button>
							<button type="button" class="btn btn-success btn-sm" onclick="project_refresh()">
								<span class="fa fa-refresh icon-on-right bigger-110"></span>
							</button>
						</span>
					</div>
				</div>
				<? $this->noCheckTable("projectListTb","프로젝트명=>5,거래처=>3,프로젝트기간=>4"); ?>
				<div id="project_paging_area" style="text-align:center"></div>
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
//==================================================
// 프로젝트 리스트 가져오기
//==================================================
function getProjectList() {
	var tag = "";
	var parameter = {"mode" : "getProjectList", "where" : $("#project_where").val(), "rpp" : 10, "page" : $("#project_page").val()};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr onclick=\"postProject('" + json[i].uid + "', '" + json[i].project_nm + "')\" style='cursor:pointer'>";
				tag += "<td>" + json[i].project_nm + "</td>";
				tag += "<td>" + json[i].account_nm + "</td>";
				tag += "<td>" + json[i].start_dt + " ~ " + json[i].end_dt + "</td>";
				tag += "</tr>";
			}
		} else {
			tag = "<tr><td colspan='4' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#projectListTb tbody").html(tag);

		var table = "project";
		getProjectPaging(table, $("#project_where").val(), 10, 4, "setProjectPage");
	});
}

//==================================================
// 프로젝트 페이지 세트
//==================================================
function setProjectPage(page){
	$("#project_page").val(page);
	getProjectList(page);
}

//==================================================
// 프로젝트 페이징 가져오기
//==================================================
function getProjectPaging(table,where,rpp,adjacents,setPage){
	var data_string = "page=" + $("#project_page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents + "&setPage=" + setPage;

	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#project_paging_area").html(str);
		}
	});
}

//==================================================
// 프로젝트 검색
//==================================================
function project_search(){
	var txt = $("#project_search_txt").val();
	
	if(txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#project_where").val(" where project_nm like '%" + txt + "%' ");

	getProjectList(1);
}
</script>