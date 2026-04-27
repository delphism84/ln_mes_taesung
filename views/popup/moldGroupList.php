<?
$title = "금형그룹";
require_once("../../connection.php");
require_once("../../assets/phead.php");
extract($_POST);
extract($_GET);
$sql = "select * from erp_mold_group";
$result = mysql_query($sql) or die (mysql_error());
?>

<script>
function postGroup(mold_group_cd, mold_group_nm) {
	window.parent.$("#mold_group_cd").val(mold_group_cd);
	window.parent.$("#mold_group_nm").val(mold_group_nm);
	window.parent.$("#<?=$dialogID?>").modal( 'hide' );
	
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
						<th class="col-xs-5 center" style="background-color:#f1f1f1">금형그룹코드</th>
						<th class="col-xs-5 center" style="background-color:#f1f1f1">금형그룹명</th>
					</tr>
<?
$i=0;
while($t = mysql_fetch_object($result)) {
?>
					<tr>
						<td class='center'><span style="cursor:pointer" onclick="postGroup('<?=$t->mold_group_cd?>','<?=$t->mold_group_nm?>')"><?=$t->mold_group_cd?></span></td>
						<td class='left'><span style="cursor:pointer" onclick="postGroup('<?=$t->mold_group_cd?>','<?=$t->mold_group_nm?>')"><?=$t->mold_group_nm?></span></td>
					</tr>			
<?
$i++;
}
if($i=="0"){
?>
	<tr>
	<td class="center" colspan="2">
		등록된 금형그룹 정보가 없습니다.
	</td>
	</tr>
<?}?>

				</table>
			</form>
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