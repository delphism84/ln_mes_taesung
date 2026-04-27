<?
$title = "견적서 검색";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);
//$sql = "select * from erp_estimate where final='y' and used!='y'";
//$sql = "select * from erp_estimate order by uid desc";
//$result = mysql_query($sql) or die (mysql_error());

if ( ! isset ( $where ) ){ 
	$where = " where estimate_dt like '%".trim($search_txt)."%' or account_nm like '%".trim($search_txt)."%'";
}else{
	$where = "";
}


$table = "erp_estimate";
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
	
	var table = "erp_estimate";
	var where = $("#where").val();
	var rpp = 10;
	var adjacents = 4;
	
	getPaging(table,where,rpp,adjacents);
});

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	var search_txt = $("#search_txt").val()

	location.href = "?page=" + page + "&search_txt=" + search_txt + "&item_gb=" + $("#item_gb option:selected").val();
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

function postEstimate(uid, estimate_cd) {
	
	//var flag = $(opener.document).find("#flag").val();

	$(opener.document).find("#product tbody").empty(); //최초 tbody 초기화

	$(opener.document).find("#estimate_cd").val(estimate_cd);
	$(opener.document).find("#estimate_uid").val(uid);
	$(opener.location).attr("href", "javascript:getEstimateItem();");
	self.close();
}	
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" />
			<input type="hidden" name="where" id="where" value="<?=$where?>" />
			<input type="hidden" name="page" id="page" value="<?=$page?>" />
			<div class="col-xs-4" style="float:left">
				<!-- <select name="item_gb" id="item_gb" onchange="setGb(this.value)">
					<option value="all" <? if($item_gb == "all") echo "selected"; ?>>전체</option>
					<option value="component" <? if($item_gb == "component") echo "selected"; ?>>자재</option>
					<option value="semi_product" <? if($item_gb == "semi_product") echo "selected"; ?>>반제품</option>
					<option value="product" <? if($item_gb == "product") echo "selected"; ?>>완제품</option>
				</select> -->
				<button class="btn btn-xs " type="button" onclick="location.href='http://inf.jerp.co.kr/views/popup/estimateList.php'">
				<i class="ace-icon fa fa-check bigger-110"></i>
				전체보기
			</button>
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
				<!-- 테이블 -->
				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">견적서코드</th>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">거래처명</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">견적일자</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
					<tr>
						<td class='center'><span style="cursor:pointer" onclick="postEstimate(<?=$t->uid?>, '<?=$t->estimate_cd?>')"><?=$t->estimate_cd?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postEstimate(<?=$t->uid?>, '<?=$t->estimate_cd?>')"><?=$t->account_nm?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postEstimate(<?=$t->uid?>, '<?=$t->estimate_cd?>')"><?=substr($t->estimate_dt,0,10)?></span></td>
					</tr>			
<?
}				
?>
<?if ($total_num <="0"){?>
<tr><td class='center' colspan='3'>등록된 견적서가 없습니다.</tr>
<?}?>
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