<?
$title = "프로젝트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);

if ( ! isset ( $where ) ){ 
	$where = " where project_cd like '%".trim($search_txt)."%' or project_nm like '%".trim($search_txt)."%'";
}else{
	if ( ! isset ( $item_gb ) ){ 
		$where .= " or item_gb like '%".trim($item_gb)."%'";
	}else{
		$where .= "";
	}
}

$table = "erp_project";
$block = 10;

$sql = "select * from ".$table.$where;
//echo $sql; 
$total_num = num_rows($sql);

$page = (is_numeric($page)) ? $page : 1; 

$sql = "select * from ".$table.$where." order by uid desc  limit ".($page-1)*$block.", ".$block;
//echo $sql; 
$result = query($sql);

?>

<script>
<!--
$(document).ready(function(){
//$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
//$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

var table = "erp_work_item";
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

function postProject(project_cd, project_nm) {
	$(opener.document).find("#project_cd").val(project_cd);
	$(opener.document).find("#project_nm").val(project_nm);
	self.close();
}	
//-->
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" />
				<input type="hidden" name="controller" id="controller" value="groupware" />
				<input type="hidden" name="action" id="action" value="registEleSettlement" />
				<div class="col-xs-8" style="float:right">
					<div class="input-group">						
						<input type="text" class="form-control search-query" placeholder="프로젝트명" name="search_txt" id="search_txt" onkeypress="if(event.keyCode==13) {search(); return false;}"/>
						<span class="input-group-btn">
							<button type="button" class="btn btn-purple btn-sm" onclick="search()">
								<span class="ace-icon fa fa-search icon-on-right bigger-80"></span>
								검색
							</button>
						</span>
					</div>
				</div>
				<!-- 테이블 -->
				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-6" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 프로젝트코드</th>
						<th class="col-xs-6" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 프로젝트명</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
					<tr>
						<td><span style="cursor:pointer" onclick="postProject('<?=$t->project_cd?>','<?=$t->project_nm?>')"><?=$t->project_cd?></span></td>
						<td><span style="cursor:pointer" onclick="postProject('<?=$t->project_cd?>','<?=$t->project_nm?>')"><?=$t->project_nm?></span></td>
					</tr>			
<?
}				
?>
<?if (!$result){?>
<tr><td class='center' colspan='5'>등록된 프로젝트가 없습니다.</tr>
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