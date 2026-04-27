<?
$title = "품목리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);

if ( ! isset ( $where ) ){ 
	$where = " where (item_cd like '%".trim($search_txt)."%' or item_nm like '%".trim($search_txt)."%'  or standard1 like '%".trim($search_txt)."%')";
}else{
	$where = "";
}

if ($item_gb !="" && $item_gb !='0'){ 
	$sqlwhere = " and item_gb ='".trim($item_gb)."'"; 
}
$table = "erp_item";
$block = 10;

$sql = "select * from ".$table.$where.$sqlwhere;
$total_num = num_rows($sql);

$page = (is_numeric($page)) ? $page : 1; 



$sql = "select * from ".$table.$where.$sqlwhere." order by uid desc  limit ".($page-1)*$block.", ".$block;
//echo $sql; 
$result = query($sql);
?>
<?
$sql2 = "select * from erp_item_classification order by seq desc";
$result2 = mysql_query($sql2);
while($t2 = mysql_fetch_object($result2)) {

	if ($item_gb == $t2->uid){
		$sel="selected";
	}else{
		$sel="";
	}
	$classification .= "<option value='".$t2->uid."' ".$sel.">".$t2->classify_nm."</option>";
}
?>
<script>

$(document).ready(function(){
	//$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	//$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	
	var table = "erp_mold_item";
	var where = $("#where").val();
	var rpp = 10;
	var adjacents = 4;
	
	getPaging(table,where,rpp,adjacents);
});

function postItem(item_cd, item_nm, standard1, material, unit, item_gb, item_group_cd, item_group_nm) {
	var flag = $(opener.document).find("#flag").val();
	var cntTotal = $(opener.document).find("#cntTotal").val();
	<?if ($mode !="modify")	{?>
		if (flag=='1')
		{
			$(opener.document).find("#mold_item_list tbody").empty(); //최초 tbody 초기화
		}
	<?}?>
	
	var tag = "";

	var arr = [];
	var std1 = [];
	var item = [];

	$.each($(opener.document).find(".item_cd") , function () {
		arr.push($(this).val());
	});
	$.each($(opener.document).find(".standard1") , function () {
		std1.push($(this).val());
	});

	
	for(var i = 0 ; i <= arr.length ; i++) {
		item.push(arr[i] + std1[i]);
	}

	var check = item_cd + standard1;

	var idx = jQuery.inArray(check, item);
	if(idx >= 0) {
		alert("동일 품목을 이미 선택하셨습니다.");
	} else {
		tag += "<tr class='item" + flag + "'>";
		tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
		tag += "<td><input type='text' class='form-control item_cd' name='item_cd[]' id='item_cd_" + flag + "'  placeholder='품목선택을 하시려면 클릭하세요' value='" + item_cd + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control ' name='item_nm[]' id='item_nm_" + flag + "' value='" + item_nm + "' required readonly /></td>";
		tag += "<td><input type='text' class='form-control standard1' name='standard1[]' id='standard1_" + flag + "' value='" + standard1 + "' required readonly /></td>";
		tag += "<td><input type='text' class='form-control material' name='material[]' id='material_" + flag + "' value='" + material + "'  /></td>";
		tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + unit + "' required/></td>";
		tag += "<td><input type='text' class='form-control text-right cnt' name='cnt[]' id='cnt_" + flag + "' onkeyup='input_comma(this);' onclick='this.select();' required/></td>";
		tag += "<td><input type='text' class='form-control text-right valid_item_hit_cnt' name='valid_item_hit_cnt[]' id='valid_item_hit_cnt_" + flag + "' onkeyup='input_comma(this);' onclick='this.select();' required/></td>";
		tag += "<td><input type='text' class='form-control text-right' name='item_gb[]' id='item_gb_" + flag + "' value='" + item_gb + "' /></td>";
		tag += "<td><input type='text' class='form-control text-right' name='item_group_nm[]' id='item_group_nm_" + flag + "' value='" + item_group_nm + "'/><input type='hidden' name='item_group_cd[]' id='item_group_cd_" + flag + "' value='" + item_group_cd + "'></td>";
		tag += "<td><input type='text' class='form-control text-right' name='remark[]' id='remark_" + flag + "'/></td>";
		//tag += "<td><input type='text' class='form-control lot_no id-btn-dialog' name='lot_no_nm[]' id='lot_no_nm_" + flag + "' onclick='lotnocdFlag(" + flag + ")' readonly /><input type='hidden' name='lot_no_cd[]'  id='lot_no_cd_" + flag + "'/></td>";
		tag += "</tr>";

		$(opener.document).find("#mold_item_list tbody").append(tag);

		$(opener.document).find("#flag").val(Number(flag) + 1);
	//	$(opener.document).find("#cntTotal").val(Number(cntTotal) + 1);
		
	}
	//$(opener.location).attr("href", "javascript:calculationTotal();"); 
}
// 페이지 세트
function setPage(page){
	$("#page").val(page);
	var search_txt = $("#search_txt").val()
	location.href = "?page=" + page + "&search_txt=" + encodeURI(search_txt) + "&item_gb=" + $("#item_gb option:selected").val()
}

// 페이징 가져오기
function getPaging(table,where,rpp,adjacents){
	var data_string = "page=" + $("#page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents+ "&item_gb=" + $("#item_gb option:selected").val();

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
	if(val == "0") $("#where").val("");
	else $("#where").val(" where item_gb='" + val + "'");
	setPage(1);
}

function search() {
	//$("#where").val(" where item_cd like '%" + $("#search_txt").val() + "%' or item_nm like '%" + $("#search_txt").val() + "%'");
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

			
			<div class="col-xs-4" style="float:left">
				<!-- 테이블 -->
				<select name="item_gb" id="item_gb" onchange="setGb(this.value)">
					<option value="0">전체</option>
					<?=$classification?>
				</select>
			</div>
			<div class="col-xs-4" style="float:right">
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
						<th class="col-xs-1 center" style="background-color:#f1f1f1">구분</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">품목코드</th>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">품목명</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">규격</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">재질</th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">단위</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {

		$sqls = "select * from erp_item_classification where uid='".$t->item_gb."'";
		$results = mysql_query($sqls);
		$t1 = mysql_fetch_object($results)
?>
	<tr>
		<td class='center'><a href="#" style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>','<?=$t->item_gb?>','<?=$t->item_group_cd?>','<?=$t->item_group_nm?>')"><?=$t1->classify_nm?></a></td>
		<td class='center'><a href="#" style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>','<?=$t->item_gb?>','<?=$t->item_group_cd?>','<?=$t->item_group_nm?>')"><?=$t->item_cd?></a></td>
		<td class='center'><a href="#" style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>','<?=$t->item_gb?>','<?=$t->item_group_cd?>','<?=$t->item_group_nm?>')"><?=$t->item_nm?></a></td>
		<td class='center'><a href="#" style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>','<?=$t->item_gb?>','<?=$t->item_group_cd?>','<?=$t->item_group_nm?>')"><?=$t->standard1?></a></td>
		<td class='center'><a href="#" style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>','<?=$t->item_gb?>','<?=$t->item_group_cd?>','<?=$t->item_group_nm?>')"><?=$t->material?></a></td>
		<td class='center'><a href="#" style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>','<?=$t->item_gb?>','<?=$t->item_group_cd?>','<?=$t->item_group_nm?>')"><?=$t->unit?></a></td>
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