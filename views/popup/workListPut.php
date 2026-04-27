<?
$title = "작업지시서 리스트 조회";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);

if ( $search_txt !="" ){ 
	$where = " where work_cd like '%".trim($search_txt)."%' or account_nm like '%".trim($search_txt)."%'";
}else{
	if ( $state !=""){ 
		$where .= " where state ='".trim($state)."'";
	}else{
		$where .= "";
	}
}

$table = "erp_work";
$block = 10;

$sql = "select * from ".$table.$where;
//echo $sql; 
$total_num = num_rows($sql);

$page = (is_numeric($page)) ? $page : 1; 

$sql = "select * from ".$table.$where." order by uid desc  limit ".($page-1)*$block.", ".$block;
//echo $sql; 
$result = query($sql);

?>

<script type="text/javascript">

$(document).ready(function(){
//$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
//$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

var table = "erp_work";
var where = $("#where").val();
var rpp = 10;
var adjacents = 4;

getPaging(table,where,rpp,adjacents);
});

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	var search_txt = $("#search_txt").val()

	location.href = "./workListPut.php?page=" + page + "&search_txt=" + search_txt + "&state=" + $("#state option:selected").val();
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
	if(val == "") $("#where").val("");
	else $("#where").val(" where state='" + val + "'");
	setPage(1);
}

function search() {
	//$("#where").val(" where item_cd like '%" + $("#search_txt").val() + "%' or item_nm like '%" + $("#search_txt").val() + "%'");
	setPage(1);
}

function postWork(obj1,obj2,obj3,obj4,obj5,obj6) {
	$("#work_cd",opener.document).val(obj1);
	$("#item_cd",opener.document).val(obj2);
	$("#item_nm",opener.document).val(obj3);
	$("#standard1",opener.document).val(obj4);
	$("#material",opener.document).val(obj5);
	$("#work_bom",opener.document).val(obj6); //bom 번호
	$(opener.location).attr("href", "javascript:getWorkDailyReportLotNo('"+obj6+"');");
	window.close();
}
//-->
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
				<!-- <form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" /> -->
				<input type="hidden" name="where" id="where" value="<?=$where?>" />
				<input type="hidden" name="page" id="page" value="<?=$page?>" />

				<div class="col-xs-4" style="float:left">
					<!-- 테이블 -->
					<select name="state" id="state" onchange="setGb(this.value)">
						<option value="" <? if($state == "all") echo "selected"; ?>>전체</option>
						<option value="0" <? if($state == "0") echo "selected"; ?>>대기</option>
						<option value="1" <? if($state == "1") echo "selected"; ?>>진행</option>
						<option value="2" <? if($state == "2") echo "selected"; ?>>완료</option>
					</select>
				</div>
				<div class="col-xs-5" style="float:right">
					<div class="input-group">						
						<input type="text" class="form-control search-query" name="search_txt" id="search_txt" onkeypress="if(event.keyCode==13) {search(); return false;}"/>
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
					<th class="center" style="background-color:#f1f1f1">작업지지서번호</th>
					<th class="center" style="background-color:#f1f1f1">작업기간</th>
					<th class="center" style="background-color:#f1f1f1">품목명</th>
					<th class="center" style="background-color:#f1f1f1">규격</th>
					<th class="center" style="background-color:#f1f1f1">완료수량</th>
					<th class="center" style="background-color:#f1f1f1">지시수량</th>
					<th class="center" style="background-color:#f1f1f1">등록일</th>
				</tr>
					<?
					$i=0;
					while($t = mysql_fetch_object($result)) {
						//echo $t->awork_cd;
						$sql = "select * from erp_work_item where wid='".$t->uid."'";
						//echo  $sql;
						$w = mysql_fetch_object(mysql_query($sql));
						//echo  $w->process;
						$sql = "select uid from erp_item where item_cd='".addslashes($w->item_cd)."'";
						//echo  $sql."<BR>";
						$item = mysql_fetch_object(mysql_query($sql));
					?>
				<tr onclick="postWork('<?=$t->work_cd?>','<?=$w->item_cd?>','<?=$w->item_nm?>','<?=$w->standard1?>','<?=$w->material?>','<?=$item->uid?>')" style="cursor:pointer">
					<td class="center"><?=$t->work_cd?></th>
					<td class="center"><?=substr($t->start_dt,0,10)."~".substr($t->end_dt,0,10)?></th>
					<td class="center"><?=$w->item_nm?></th>
					<td class="center"><?=$w->standard1?></th>
					<td class="text-right"><?=number_format($w->goal_cnt)?></th>
					<td class="text-right"><?=number_format($w->order_cnt)?></th>
					<td class="center"><?=substr($t->create_dt,0,10)?></th>
				</tr>				
					<?
						$i++;
					}
					if($i=="0"){
					?>
					<tr >
					<td class="center" colspan="7">등록된 생산번호 리스트가 없습니다.</th>
					</tr>
					<?}?>
			</table>
			<div class="center" id="paging_area"></div>
			<!-- </form> -->
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