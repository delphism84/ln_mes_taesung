<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<!-- 검색 모달 -->
		<div class="wrap_search_pop">	
			<div class="search_pop_content">
				<div class="input-group" style="width:100%;">
					<div class="col-xs-12" style="width:100%;">
						<select style="float:left; width:25%; height:37px;" name="big_department" id="big_department" onchange="getMiddleDepartment(this.value)"><option value='all'>부서선택</option></select>
						<select style="float:left; width:25%; height:37px;" name="middle_department" id="middle_department" onchange="getSmallDepartment(this.value)"><option value='all'>부서선택</option></select>
						<select style="float:left; width:25%; height:37px;" name="small_department" id="small_department" onchange="getEmployee()"><option value='all'>부서선택</option></select>
						<input style="float:left; width:25%; height:37px;" type="button"  class="search_btn_nomar" value="검색" onclick="search_department()" />			
					</div>
					<div class="col-xs-12" style="margin-top:10px; width:100%;">
						<input style="width:80%; float:left;" type="text" class="form-control search-query" placeholder="사원명" name="search_txt" id="search_txt" />
						<span class="input-group-btn">
							<button type="button" class="search_btn_nomar" onclick="search()" style="width:100%;">
								<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
								
							</button>
						</span>
					</div>						
				</div>		
			</div>	
		</div>
		<!-- //검색 모달 -->
		<div class="page-content">				
			<div class="col-xs-12">	
				<input type='button' class='comm_title' value='출퇴근관리' />				
				<table id="tb" class="table  table-bordered">
					<thead>
						<tr>
							<th class="col-xs-4"><i class="ace-icon fa fa-caret-right blue"></i> 사원코드</th>
							<th class="col-xs-2" style="width:20%;"><i class="ace-icon fa fa-caret-right blue"></i> 사원명</th>
							<!--<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 부서</th>-->
							<!--<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 직급</th>-->
							<th class="col-xs-3"><i class="ace-icon fa fa-caret-right blue"></i> 출근시간</th>
							<th class="col-xs-3"><i class="ace-icon fa fa-caret-right blue"></i> 퇴근시간</th>									
						</tr>
					</thead>
					<tbody></tbody>
				</table>
				<? $this->paging() ?>
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
?>

<script>
$(document).ready(function(){
	var page = $("#page").val();
	getCommute(page);


});

function getCommute(page){	
	var parameter = {"mode" : "getCommute", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page};
	var tag = "";
	$.getJSON("ajax.php",{"parameter":parameter}, function(json) {
		if(json != null){
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr onclick='toggle(this); postData(" + json[i].uid + ");' style='cursor:pointer'>";
				tag += "<td>" + json[i].emp_cd + "</td>";
				tag += "<td>" + json[i].emp_nm + "</td>";
				//tag += "<td>" + json[i].department_nm + "</td>";
				//tag += "<td>" + json[i].position_nm + "</td>";
				tag += "<td>" + json[i].create_dt + "</td>";
				tag += "<td></td>";
				tag += "</tr>";
			}

			$("#tb tbody").html(tag);

			var table = "employee";
			getPaging(table, "", $("#per").val(), 4, "setPage");
		}
	});
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getCommute(page);
}

// 페이징 가져오기
function getPaging(table,where,rpp,adjacents, setPage){
	var data_string = "page=" + $("#page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents + "&setPage=" + setPage;
	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#paging_area").html(str);
		}
	});
}

$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1)
	})
})

</script>