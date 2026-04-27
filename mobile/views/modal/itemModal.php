<input type="hidden" name="modal_item_where" id="modal_item_where" />
<input type="hidden" name="modal_item_page" id="modal_item_page" value="1" />

<div class="modal fade" id="itemModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">품목 리스트</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<div style="margin-bottom:5px">
					<div style="float:right">
						<div class="input-group">
							<select name="modal_item_search_classify" id="modal_item_search_classify" style="height:34px; width:100%;">
								<option value="0">= 검색구분 =</option>
								<option value="item_cd">품번</option>
								<option value="item_nm">품명</option>
							</select>							
						</div>
						<div class="input-group">
							<input type="text" class="search-query" placeholder="검색어" name="modal_item_search_txt" id="modal_item_search_txt" style="height:34px; width:100%;"/>
							<span class="input-group-btn">
								<button type="button" class="btn btn-purple btn-sm" onclick="item_search()">
									<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
									
								</button>
								<button type="button" class="btn btn-success btn-sm" onclick="item_refresh()">
								<span class="fa fa-refresh icon-on-right bigger-110"></span>
								</button>
							</span>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
				<? $this->noCheckTable("itemListTb","구분=>2,품번=>3,품목명=>4,규격=>3"); ?>
				<div id="item_paging_area" style="text-align:center"></div>
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
function item_refresh() {
	$("#modal_item_search_classify").val(0);
	$("#modal_item_search_txt").val("");
	$("#modal_item_where").val("");
	$("#modal_item_page").val(1);
	getItemList();
}

//==================================================
// 품목 리스트 가져오기
//==================================================
function getItemList() {
	var tag = "";
	var parameter = {"mode" : "getItemList", "where" : $("#modal_item_where").val(), "rpp" : 10, "page" : $("#modal_item_page").val()};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr onclick=\"postItem(" + json[i].uid + ")\" style='cursor:pointer'>";
				tag += "<td>" + json[i].classify_nm + "</td>";
				tag += "<td>" + json[i].item_cd + "</td>";
				tag += "<td>" + json[i].item_nm + "</td>";
				tag += "<td>" + json[i].standard + "</td>";
				tag += "</tr>";
			}
		} else {
			tag = "<tr><td colspan='4' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#itemListTb tbody").html(tag);

		var table = "item";
		getItemPaging(table, $("#modal_item_where").val(), 10, 4, "setModalItemPage");
	});
}

//==================================================
// 품목 페이지 세트
//==================================================
function setModalItemPage(page){
	$("#modal_item_page").val(page);
	getItemList(page);
}

//==================================================
// 품목 페이징 가져오기
//==================================================
function getItemPaging(table,where,rpp,adjacents,setPage){
	var data_string = "page=" + $("#modal_item_page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents + "&setPage=" + setPage;

	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#item_paging_area").html(str);
		}
	});
}

//==================================================
// 품목 검색
//==================================================
function item_search(){
	var search_classify = $("#modal_item_search_classify option:selected").val();
	var search_txt = $("#modal_item_search_txt").val();
	
	if(search_txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#modal_item_where").val("where item_cd like '@" + search_txt + "@' or item_nm like '@" + search_txt + "@'");

	getItemList(1);
}
</script>