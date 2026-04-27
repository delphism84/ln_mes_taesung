<?
$title = "품목 재질 등록";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);

$sql = "select * from erp_material where item_cd='".$item_cd."'";
//echo $sql; 
$result = mysql_query($sql) or die (mysql_error());
?>

<script>
/*
$(document).ready(function() {
	var item_cd = $(opener.document).find("#item_cd").val();
	if(item_cd.trim() == "") {
		alert("품목코드가 생성이 되어있지 않습니다. 품목코드 생성 후 진행하세요");
		self.close()
	}
});
*/
function postStandard(standard) {
	$(opener.document).find("#material").val(standard);
	self.close();
}	
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table  table-bordered table-hover">
				<tr>
					<th class="col-xs-3 center" style="background-color:#f1f1f1">품목코드</th>
					<th class="col-xs-3 center" style="background-color:#f1f1f1">규격</th>
					<th class="col-xs-3 center" style="background-color:#f1f1f1">재질</th>
				</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
				<tr>
					<td class='center'><a href="#" style="cursor:pointer" onclick="postStandard('<?=$t->material?>')"><?=$t->item_cd?></a></td>
					<td class='center'><a href="#" style="cursor:pointer" onclick="postStandard('<?=$t->material?>')"><?=$t->standard1?></a></td>
					<td class='center'><a href="#" style="cursor:pointer" onclick="postStandard('<?=$t->material?>')"><?=$t->material?></a></td>
				</tr>			
<?
}?>
<?if ($t->item_cd==""){?>

				<tr>
					<td class='center' colspan="3">등록된 재질이 없습니다.</td>
				</tr>			
<?
}				
?>
			</table>			
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