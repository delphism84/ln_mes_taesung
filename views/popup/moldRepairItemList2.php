<?
//발주서 품목 리스트 불러오기
$title = "품목리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);

if ( ! isset ( $where ) ){ 
	$where = " where item_cd like '%".trim($search_txt)."%' or item_nm like '%".trim($search_txt)."%'";
}else{
	if ( ! isset ( $item_gb ) ){ 
		$where .= " or item_gb like '%".trim($item_gb)."%'";
	}else{
		$where .= "";
	}
}

$table = "erp_mold_item";
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
$(document).ready(function(){
	//$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	//$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var table = "erp_mold_item";
	var where = $("#where").val();
	var rpp = 10;
	var adjacents = 4;

	getPaging(table,where,rpp,adjacents);
});

function postItem(uid, fid, item_cd, item_nm, standard1, unit, material, cnt) {
		var flag = $(opener.document).find("#flag").val();
	<?if ($mode !="modify")	{?>
		if (flag=='1')
		{
			$(opener.document).find("#mold_repair_item_list tbody").empty(); //최초 tbody 초기화
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
	/*
	$.each($(opener.document).find(".standard2") , function () {
		std2.push($(this).val());
	});
	$.each($(opener.document).find(".standard3") , function () {
		std3.push($(this).val());
	});
	
	*/
	for(var i = 0 ; i <= arr.length ; i++) {
		item.push(arr[i] + std1[i]);
	}
	

	var check = item_cd + standard1;

	var idx = jQuery.inArray(check, item);
	if(idx >= 0) {
		alert("동일 품목을 이미 선택하셨습니다");
	} else {
		tag += "<tr class='item" + flag + "'>";
		tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
		tag += "<td><input type='text' class='form-control item_cd' name='item_cd[]' id='item_cd_" + flag + "'  placeholder='품목선택을 하시려면 클릭하세요' value='" + item_cd + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control ' name='item_nm[]' id='item_nm_" + flag + "' value='" + item_nm + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control standard1' name='standard1[]' id='standard1_" + flag + "' value='" + standard1 + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + unit + "'  /></td>";
		tag += "<td><input type='text' class='form-control material ' name='material[]' id='material_" + flag + "'  onclick='this.select();' value='" + material + "' /></td>";
		tag += "<td><input type='text' class='form-control text-right cnt' name='cnt[]' id='cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + cnt + "' /></td>";
		tag += "<td><input type='text' class='form-control' name='remark[]' id='remark_" + flag + "' onclick='this.select();' /></td>";
		tag += "</tr>";
		$(opener.document).find("#mold_repair_item_list tbody").append(tag);

		$(opener.document).find("#flag").val(Number(flag) + 1);
	}
	$(opener.location).attr("href", "javascript:calculationTotal();");
	//self.close();
}

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
				<div class="row" style="padding-bottom:3px">
					<div class="col-xs-5" style="float:right">
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
				</div>

				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">금형명</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">품목코드</th>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">품목명</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">규격</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">유효타수</th>
					</tr>
<?
		while($t = mysql_fetch_object($result)) {

			$sql2 = "select mold_nm from erp_mold where mold_cd='".$t->mold_cd."'";
				//echo $sql."<BR><BR>"; 
				$t2 = @mysql_fetch_object(mysql_query($sql2));
?>
					<tr>
						<td class='center'><a href="javascript:void(0)" style="cursor:pointer" onclick="postItem('<?=$t->uid?>','<?=$t->fid?>','<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->unit?>','<?=$t->material?>','<?=$t->cnt?>')"><?=$t2->mold_nm?></span></td>
						<td class='center'><a href="javascript:void(0)" style="cursor:pointer" onclick="postItem('<?=$t->uid?>','<?=$t->fid?>','<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->unit?>','<?=$t->material?>','<?=$t->cnt?>')"><?=$t->item_cd?></span></td>
						<td class='center'><a href="javascript:void(0)" style="cursor:pointer" onclick="postItem('<?=$t->uid?>','<?=$t->fid?>','<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->unit?>','<?=$t->material?>','<?=$t->cnt?>')"><?=$t->item_nm?></span></td>
						<td class='center'><a href="javascript:void(0)" style="cursor:pointer" onclick="postItem('<?=$t->uid?>','<?=$t->fid?>','<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->unit?>','<?=$t->material?>','<?=$t->cnt?>')"><?=$t->standard1?></span></td>
						<td class='center'><a href="javascript:void(0)" style="cursor:pointer" onclick="postItem('<?=$t->uid?>','<?=$t->fid?>','<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->unit?>','<?=$t->material?>','<?=$t->cnt?>')"><?=number_format($t->valid_item_hit_cnt)?></span></td>
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