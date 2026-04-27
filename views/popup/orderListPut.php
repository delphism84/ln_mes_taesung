<?
$title = "수주(주문서) 리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);

//$sql = "select * from erp_order where state<>'complete' order by uid desc";
//$result = mysql_query($sql) or die (mysql_error());

if ( ! isset ( $where ) ){ 
	$where = " where state<>'complete' and ( order_cd like '%".trim($search_txt)."%' or account_nm like '%".trim($search_txt)."%')";
}else{
	$where = "";
}


$table = "erp_order";
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

	var table = "erp_item";
	var where = $("#where").val();
	var rpp = 10;
	var adjacents = 4;

	getPaging(table,where,rpp,adjacents);
});

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	var search_txt = $("#search_txt").val()

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


function postOrder(uid,order_cd, delivery_dt, account_nm) {
	
	$(opener.document).find("#product tbody").empty(); //최초 tbody 초기화
	$(opener.document).find("#title").val(account_nm + " 납품건");
	$(opener.document).find("#order_uid").val(uid);
	$(opener.document).find("#order_cd").val(order_cd);
	$(opener.location).attr("href","javascript:getOrderItem();");
	self.close();
}	

function goPage() {
	location.href="/views/popup/orderList.php";
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

			<button class="btn btn-xs btn-info" type="button" onclick="goPage()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				전체보기
			</button>
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

				<table id="simple-table" class="table table-bordered table-hover">
					<tr>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">수주(주문)서코드</th>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">거래처명</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">수주일자</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
					<tr>
						<td class='center'><span style="cursor:pointer" onclick="postOrder('<?=$t->uid?>','<?=$t->order_cd?>','<?=substr($t->delivery_dt,0,10)?>','<?=$t->account_nm?>')"><?=$t->order_cd?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postOrder('<?=$t->uid?>','<?=$t->order_cd?>','<?=substr($t->delivery_dt,0,10)?>','<?=$t->account_nm?>')"><?=$t->account_nm?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postOrder('<?=$t->uid?>','<?=$t->order_cd?>','<?=substr($t->delivery_dt,0,10)?>','<?=$t->account_nm?>')"><?=substr($t->create_dt,0,10)?></span></td>
					</tr>			
<?
}				
?>
<?if(!$result){?>
	       </tr><td colspan="7"> 등록된 데이터가 없습니다.</td></tr>
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