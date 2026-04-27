<?
$title = "품목";
require_once("../../connection.php");
require_once("../../assets/phead.php");

$sql = "select * from erp_item";
$result = mysql_query($sql) or die (mysql_error());
?>

<script>
function postItem(item_cd, item_nm, standard, unit_price) {
	var flag = $(opener.document).find("#flag").val();
	<?if ($mode !="modify")	{?>
		if (flag=='1')
		{
			$(opener.document).find("#purchase_order_item tbody").empty(); //최초 tbody 초기화
		}
	<?}?>
	var tag = "";

	var arr = [];
	var std = [];
	var item = [];

	$.each($(opener.document).find(".item_cd") , function () {
		arr.push($(this).val());
	});
	$.each($(opener.document).find(".standard") , function () {
		std.push($(this).val());
	});
	
	for(var i = 0 ; i <= arr.length ; i++) {
		item.push(arr[i] + std[i]);
	}

	var check = item_cd + standard;

	var idx = jQuery.inArray(check, item);
	if(idx >= 0) {
		alert("동일 품목을 이미 선택하셨습니다");
	} else {
		tag += "<tr class='item" + flag + "'>";
		tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
		tag += "<td><input type='text' class='form-control item_cd' name='item_cd[]' id='item_cd_" + flag + "'  placeholder='품목선택을 하시려면 클릭하세요' value='" + item_cd + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "' value='" + item_nm + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control standard' name='standard[]' id='standard_" + flag + "' value='" + standard + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control cnt' name='cnt[]' id='cnt_" + flag + "' onkeyup='calculation(" + flag + ")' /></td>";
		tag += "<td><input type='text' class='form-control unit_price' name='unit_price[]' id='unit_price_" + flag + "' value='" + unit_price + "' onkeyup='calculation(" + flag + ")' /></td>";
		tag += "<td><input type='text' class='form-control total_price' name='total_price[]' id='total_price_" + flag + "' readonly /></td>";
		tag += "</tr>";

		$(opener.document).find("#product tbody").append(tag);

		$(opener.document).find("#flag").val(Number(flag) + 1);
	}
}	
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" />
				<input type="hidden" name="controller" id="controller" value="groupware" />
				<input type="hidden" name="action" id="action" value="registEleSettlement" />

				<!-- 테이블 -->
				<select>
					<option>자재</option>
					<option>반제품</option>
					<option>완제품</option>
				</select>

				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">구분</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">품목코드</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">품목명</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">규격</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {
	if($t->item_gb == "component") $item_gb = "자재";
	else if($t->item_gb == "semi_product") $item_gb = "반제품";
	else if($t->item_gb == "product") $item_gb = "완제품";
?>
					<tr>
						<td class='center'><?=$item_gb?></td>
						<td class='center'><span style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard?>',<?=$t->unit_price?>)"><?=$t->item_cd?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard?>',<?=$t->unit_price?>)"><?=$t->item_nm?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard?>',<?=$t->unit_price?>)"><?=$t->standard?></span></td>
					</tr>			
<?
}				
?>
				</table>
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