<?
$title = "금형 리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);

if ( ! isset ( $where ) ){ 
	$where = " where (mold_cd like '%".trim($search_txt)."%' or mold_nm like '%".trim($search_txt)."%')";
}else{
	$where = "";
}

$table = "erp_mold";
$block = 10;

$sql = "select * from ".$table.$where.$sqlwhere;
$total_num = num_rows($sql);

$page = (is_numeric($page)) ? $page : 1; 



$sql = "select * from ".$table.$where.$sqlwhere." order by uid desc  limit ".($page-1)*$block.", ".$block;
//echo $sql; 
$result = query($sql);
?>

<script>

$(document).ready(function(){
	//$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	//$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	
	var table = "erp_mold";
	var where = $("#where").val();
	var rpp = 10;
	var adjacents = 4;
	
	getPaging(table,where,rpp,adjacents);
});

function postMold(mold_cd, mold_nm) {
	$(opener.document).find("#mold_cd").val(mold_cd);
	$(opener.document).find("#mold_nm").val(mold_nm);

	//$(opener.location).attr("href", "javascript:getPPRWorkmoldCheck();");
	self.close();
}	
// 페이지 세트
function setPage(page){
	$("#page").val(page);
	var search_txt = $("#search_txt").val()
	location.href = "?page=" + page + "&search_txt=" + encodeURI(search_txt) 
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

function search() {

	setPage(1);
}
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" />
			<!-- PAGE CONTENT BEGINS -->
			<input type="hidden" name="where" id="where" value="<?=$where?>" />
			<input type="hidden" name="page" id="page" value="<?=$page?>" />
			
			<div class="input-group" style="float:right">
				<span class="input-icon input-icon-right">
				<div class="input-group">						
					<input type="text" name="search_txt" id="search_txt" style="height:30px"/>
					<span class="input-group-btn">
						<button type="button" class="btn btn-purple btn-xs" onclick="search()">
							<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
							Search
						</button>
					</span>
				</div>
				</span>
			</div>

				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">금형코드</th>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">금형명</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {

?>
					<tr>
						<td class='center'><a href="#" style="cursor:pointer" onclick="postMold('<?=$t->mold_cd?>','<?=$t->mold_nm?>')"><?=$t->mold_cd?></a></td>
						<td class='center'><a href="#" style="cursor:pointer" onclick="postMold('<?=$t->mold_cd?>','<?=$t->mold_nm?>')"><?=$t->mold_nm?></a></td>
					</tr>			
<?
}				
?>
<? if($total_num <= 0){?>
	       </tr><td colspan="12" class="center"> 등록된 데이터가 없습니다.</td></tr>
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