<?
$title = "품목그룹";
require_once("../../connection.php");
require_once("../../assets/phead.php");

$sql = "select * from erp_item_group";
$result = mysql_query($sql) or die (mysql_error());
?>

<script>
function postGroup(item_group_cd, item_group_nm) {
	$(opener.document).find("#item_group_cd").val(item_group_cd);
	$(opener.document).find("#item_group_nm").val(item_group_nm);
	self.close();
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
				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">그룹코드</th>
						<th class="col-xs-6 center" style="background-color:#f1f1f1">그룹명</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
					<tr>
						<td class='center'><span style="cursor:pointer" onclick="postGroup('<?=$t->item_group_cd?>','<?=$t->item_group_nm?>')"><?=$t->item_group_cd?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postGroup('<?=$t->item_group_cd?>','<?=$t->item_group_nm?>')"><?=$t->item_group_nm?></span></td>
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