<?
$title = "품목리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);

if ( ! isset ( $where ) ){ 
	$where = " where item_cd like '%".trim($search_txt)."%' or item_nm like '%".trim($search_txt)."%'";
}else{
	$where = "";
}


$table = "erp_item";
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

function postItem(item_cd, item_nm, standard1, material, unit, unit_price){
	var flag = $(opener.document).find("#flag").val();

	<?if ($mode !="modify")	{?>
		if (flag=='1')
		{
			$(opener.document).find("#workorder_item tbody").empty(); //최초 tbody 초기화
		}
	<?}?>

	var cnt = "1";
	var outsourcing_unit_price= "0";
	var outsourcing_total_price= "0";
	var outsourcing_tax= "0";

	var tag = "";
	var arr = [];
	var std1 = [];
	var item = [];
	var memo = [];
	var product_time = [];

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
		alert("동일 품목을 이미 선택하셨습니다");
	} else {
					
			tag += "<tr class='item" + flag + "'>";
			tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this);calculationTotal(" + flag + ");'></i></td>";
			tag += "<td><input type='text' class='form-control id-btn-dialog item_cd ' name='item_cd[]' id='item_cd_" + flag + "' onclick='viewModal();itemFlag(" + flag + ")' value='" + item_cd + "' placeholder='품목선택을 하시려면 클릭하세요' readonly /></td>";
			tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "' value='" + item_nm + "' readonly /></td>";
			tag += "<td><input type='text' class='form-control standard1' name='standard1[]' id='standard1_" + flag + "' value='" + standard1 + "' readonly /></td>";
			tag += "<td><input type='text' class='form-control' name='material[]' id='material_" + flag + "' value='" + material + "' readonly /></td>";
			tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + unit + "'  /></td>";
			tag += "<td><input type='text' class='form-control cnt text-right' name='cnt[]' id='cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + cnt + "' /></td>";
			tag += "<td><input type='text' class='form-control outsourcing_unit_price text-right' name='outsourcing_unit_price[]' id='outsourcing_unit_price_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + outsourcing_unit_price + "' /></td>";
			tag += "<td><input type='text' class='form-control outsourcing_total_price text-right' name='outsourcing_total_price[]' id='outsourcing_total_price_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + outsourcing_total_price + "' /></td>";
			tag += "<td><input type='text' class='form-control outsourcing_tax text-right' name='outsourcing_tax[]' id='outsourcing_tax_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + outsourcing_tax + "' /></td>";

			tag += "<td><input type='text' class='form-control memo text-right' name='memo[]' id='memo_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + memo + "' readonly /></td>";
			tag += "<td><input type='text' class='form-control product_time text-right' name='product_time[]' id='product_time_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + product_time + "'  /></td>";
			tag += "<td class='align-middle'><a href='#'>선택</a></td>";
			tag += "</tr>";
					$(opener.document).find("#workorder_item tbody").append(tag);
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
			<!-- PAGE CONTENT BEGINS -->
			<input type="hidden" name="where" id="where" value="<?=$where?>" />
			<input type="hidden" name="page" id="page" value="<?=$page?>" />

			
			<div class="col-xs-4" style="float:left">
				<!-- 테이블 -->
				<select name="item_gb" id="item_gb" onchange="setGb(this.value)">
					<option value="all" <? if($item_gb == "all") echo "selected"; ?>>전체</option>
					<option value="component" <? if($item_gb == "component") echo "selected"; ?>>자재</option>
					<option value="semi_product" <? if($item_gb == "semi_product") echo "selected"; ?>>반제품</option>
					<option value="product" <? if($item_gb == "product") echo "selected"; ?>>완제품</option>
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
						<th class="col-xs-2 center" style="background-color:#f1f1f1">품목명</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">규격</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">재질</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">단위</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {
	if($t->item_gb == "component") $item_gb = "자재";
	else if($t->item_gb == "semi_product") $item_gb = "반제품";
	else if($t->item_gb == "product") $item_gb = "완제품";
?>
					<tr>
						<td class='center'><?=$item_gb?></td>
						<td class='center'><span style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>')"><?=$t->item_cd?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>')"><?=$t->item_nm?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>')"><?=$t->standard1?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>')"><?=$t->material?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>')"><?=$t->unit?></span></td>
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