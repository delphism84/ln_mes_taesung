<?
extract($_POST);
extract($_GET);

$title = "거래처";

require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");

if ( ! isset ( $where ) ) $where = "";

$table = "erp_account";
$block = 10;

$page = (is_numeric($page)) ? $page : 1; 

$sql = "select * from ".$table.$where." order by uid desc  limit ".($page-1)*$block.", ".$block;
$result = query($sql);
?>

<script>
$(document).ready(function(){
	var table = "erp_account";
	var where = $("#where").val();
	var rpp = 10;
	var adjacents = 4;

	getPaging(table,where,rpp,adjacents);
});

function postAccount(account_cd, account_nm, manager) {
	window.parent.$("#owner_account_cd").val(account_cd);
	window.parent.$("#owner_account_nm").val(account_nm);
	window.parent.$("#<?=$dialogID?>").modal( 'hide' );
}	

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	location.href = "?page=" + page + "&where=" + $("#where").val() + "&account_gb=" + $("#account_gb option:selected").val();
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
	else $("#where").val(" where account_gb='" + val + "'");
	setPage(1);
}

function search() {
	$("#where").val(" where account_nm like '%" + $("#search_txt").val() + "%'");
	setPage(1);
}
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<input type="hidden" name="where" id="where" value="<?=$where?>" />
			<input type="hidden" name="page" id="page" value="<?=$page?>" />
			<!-- 테이블 -->
			<div class="col-xs-4" style="float:left">
				<select id="account_gb" id="account_gb" onchange="setGb(this.value)">
					<option value="all" <? if ( $account_gb == "all" ) echo "selected"; ?>>전체</option>
					<option value="매입" <? if ( $account_gb == "매입" ) echo "selected"; ?>>매입처</option>
					<option value="매출" <? if ( $account_gb == "매출" ) echo "selected"; ?>>매출처</option>
				</select>
			</div>
			<div class="col-xs-8" style="float:right">
				<div class="input-group">						
					<input type="text" class="form-control search-query" placeholder="거래처명" name="search_txt" id="search_txt" />
					<span class="input-group-btn">
						<button type="button" class="btn btn-purple btn-sm" onclick="search()">
							<span class="ace-icon fa fa-search icon-on-right bigger-80"></span>
							검색
						</button>
					</span>
				</div>
			</div>
			<table id="simple-table" class="table  table-bordered table-hover">
				<tr>
					<th class="col-xs-2" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 구분</th>
					<th class="col-xs-6" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 거래처명</th>
				</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
				<tr>
					<td><?=$t->account_gb?></td>
					<td><span style="cursor:pointer" onclick="postAccount('<?=$t->account_cd?>','<?=$t->account_nm?>','<?=$t->manager?>')"><?=$t->account_nm?></span></td>
				</tr>			
<?
}				
?>
			</table>
			<div class="center" id="paging_area"></div>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix form-actions center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-info" type="button" onclick="window.parent.$('#<?=$dialogID?>').modal( 'hide' );">
				<i class="ace-icon fa fa-check bigger-110"></i>
				창닫기
			</button>
		</div>
	</div><!-- // submit -->
</div><!-- /.page-content -->


<?
require_once("../../assets/pfoot.php");
?>