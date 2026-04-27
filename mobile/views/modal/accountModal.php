<input type="hidden" name="modal_account_where" id="modal_account_where" />
<input type="hidden" name="modal_account_page" id="modal_account_page" value="1" />

<div class="modal fade" id="accountModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">거래처 리스트</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="">
				<div style="margin-bottom:5px">
					<div class="input-group">						
						<input type="text" class="form-control search-query" placeholder="거래처명" name="modal_account_search_txt" id="modal_account_search_txt" />
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

<script>
// 모달 거래처 새로고침
function account_refresh() {
	$("#modal_account_search_txt").val("");
	$("#modal_account_where").val("");
	$("#modal_account_page").val(1);
	getAccountList();
}

//==================================================
// 거래처 리스트 가져오기
//==================================================
function getAccountList() {
	var tag = "";
	var parameter = {"mode" : "getAccountList", "where" : $("#modal_account_where").val(), "rpp" : 10, "page" : $("#modal_account_page").val()};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr onclick=\"postAccount('" + json[i].account_cd + "', '" + json[i].account_nm + "', " + json[i].uid + ")\" style='cursor:pointer'>";
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
		getAccountPaging(table, $("#modal_account_where").val(), 10, 2, "setModalAccountPage");
	});
}

//==================================================
// 거래처 검색
//==================================================
function account_search(){
	var search_txt = $("#modal_account_search_txt").val();
	
	if(search_txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#modal_account_where").val("where account_nm like '@" + search_txt + "@' or account_cd like '@" + search_txt + "@'");

	getAccountList(1);
}

//==================================================
// 거래처 페이지 세트
//==================================================
function setModalAccountPage(page){
	$("#modal_account_page").val(page);
	getAccountList(page);
}

//==================================================
// 거래처 페이징 가져오기
//==================================================
function getAccountPaging(table,where,rpp,adjacents,setPage){
	var data_string = "page=" + $("#modal_account_page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents + "&setPage=" + setPage;

	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#account_paging_area").html(str);
		}
	});
}
</script>