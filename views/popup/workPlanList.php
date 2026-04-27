<?
$title = "생산계획 리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);

if ( ! isset ( $where ) ){ 
	$where = " where workplan_cd like '%".trim($search_txt)."%' or title like '%".trim($search_txt)."%'";
}else{
	$where = "";
}


$table = "erp_workplan";
$block = 10;

$sql = "select * from ".$table.$where;
$total_num = num_rows($sql);

$page = (is_numeric($page)) ? $page : 1; 



$sql = "select * from ".$table.$where." order by uid desc  limit ".($page-1)*$block.", ".$block;
//echo $sql; 
$result = query($sql);

?>

<script>

$(document).ready(function(){
	//$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	//$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var table = "erp_workplan";
	var where = $("#where").val();
	var rpp = 10;
	var adjacents = 4;

	getPaging(table,where,rpp,adjacents);
});
// 페이지 세트
function setPage(page){
	$("#page").val(page);
	var search_txt = $("#search_txt").val()

	//location.href = "?page=" + page + "&search_txt=" + search_txt + "&item_gb=" + $("#item_gb option:selected").val();
	location.href = "?page=" + page + "&search_txt=" + search_txt;
}

// 페이징 가져오기
function getPaging(table,where,rpp,adjacents){
	var data_string = "page=" + $("#page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents;

	$.ajax({
		type : "post",
		url : "../../_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#paging_area").html(str);
		}
	});
}

function setGb(val) {
	if(val == "all") $("#where").val("");
	else $("#where").val(" where item_gb='" + val + "'");
	setPage(1);
}

function search() {
	//$("#where").val(" where item_cd like '%" + $("#search_txt").val() + "%' or item_nm like '%" + $("#search_txt").val() + "%'");
	setPage(1);
}

function postWorkPlan(uid, workplan_cd, project_cd, project_nm, warehouse_cd, purchase_expect_dt, tax_type,end_dt) {
	
	$(opener.document).find("#workplan_item_bom tbody").empty(); //최초 tbody 초기화

	$(opener.document).find("#workplan_uid").val(uid);
	$(opener.document).find("#workplan_cd").val(workplan_cd);
	$(opener.document).find("#project_cd").val(project_cd);
	$(opener.document).find("#project_nm").val(project_nm);
	$(opener.document).find("#warehouse_cd").val(warehouse_cd);
	$(opener.document).find("#purchase_expect_dt").val(purchase_expect_dt);
	$(opener.document).find("#tax_type").val(tax_type);
	$(opener.document).find("#purchase_expect_dt").val(end_dt);
	//$(opener.location).attr("href", "javascript:getWorkPlanItem();");
	$(opener.location).attr("href", "javascript:getWorkPlanItemBom();");
	self.close();
}	
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" />
				<input type="hidden" name="controller" id="controller" value="groupware" />
				<input type="hidden" name="action" id="action" value="registEleSettlement" />
				<input type="hidden" name="where" id="where" value="<?=$where?>" />
				<input type="hidden" name="page" id="page" value="<?=$page?>" />

				
				<div class="col-xs-4" style="float:left">
					<!-- 테이블 -->
					<select name="item_gb" id="item_gb" onchange="setGb(this.value)">
						<option value="all" <? if($item_gb == "all") echo "selected"; ?>>전체</option>
						<option value="component" <? if($item_gb == "component") echo "selected"; ?>>완료</option>
						<option value="semi_product" <? if($item_gb == "semi_product") echo "selected"; ?>>진행</option>
						<option value="product" <? if($item_gb == "product") echo "selected"; ?>>대기</option>
					</select>
				</div>
				<div class="col-xs-6" style="float:right">
					<div class="input-group">						
						<input type="text" class="form-control search-query" name="search_txt" id="search_txt" />
						<span class="input-group-btn">
							<button type="button" class="btn btn-purple btn-sm" onclick="search()">
								<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
								Search
							</button>
						</span>
					</div>
				</div>

				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">생산계획코드</th>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">생산계획 제목</th>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">생산시작일</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">생산종료일</th>
					</tr>
				<?
				while($t = mysql_fetch_object($result)) {
				?>
					<tr>
						<td class='center'><span style="cursor:pointer" onclick="postWorkPlan('<?=$t->uid?>','<?=$t->workplan_cd?>','<?=$t->project_cd?>','<?=$t->project_nm?>','<?=$t->warehouse_cd?>','<?=$t->purchase_expect_dt?>','<?=$t->tax_type?>','<?=$t->end_dt?>')"><?=$t->workplan_cd?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postWorkPlan('<?=$t->uid?>','<?=$t->workplan_cd?>','<?=$t->project_cd?>','<?=$t->project_nm?>','<?=$t->warehouse_cd?>','<?=$t->purchase_expect_dt?>','<?=$t->tax_type?>','<?=$t->end_dt?>')"><?=$t->title?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postWorkPlan('<?=$t->uid?>','<?=$t->workplan_cd?>','<?=$t->project_cd?>','<?=$t->project_nm?>','<?=$t->warehouse_cd?>','<?=$t->purchase_expect_dt?>','<?=$t->tax_type?>','<?=$t->end_dt?>')"><?=substr($t->start_dt,0,10)?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postWorkPlan('<?=$t->uid?>','<?=$t->workplan_cd?>','<?=$t->project_cd?>','<?=$t->project_nm?>','<?=$t->warehouse_cd?>','<?=$t->purchase_expect_dt?>','<?=$t->tax_type?>','<?=$t->end_dt?>')"><?=substr($t->end_dt,0,10)?></span></td>
					</tr>			
				<?
				}				
				?>
				</table>
				<div class="center" id="paging_area"></div>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix form-actions center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-info" type="button" onclick="self.close()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				창닫기
			</button>
		</div>
	</div><!-- // submit -->
</div><!-- /.page-content -->


<?
require_once("../../assets/pfoot.php");
?>