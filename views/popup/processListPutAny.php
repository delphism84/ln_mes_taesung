<?
$title = "공정리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
session_start();
extract($_POST);
extract($_GET);
$sql = "select * from erp_process";
$result = mysql_query($sql) or die (mysql_error());
?>

<script>
function postProcess(process_cd, process_nm) {
	window.parent.$("#process_cd").val(process_cd);
	window.parent.$("#process_nm").val(process_nm);
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
						<th class="col-xs-6 center" style="background-color:#f1f1f1">공정구분</th>
						<th class="col-xs-6 center" style="background-color:#f1f1f1">공정명</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
					<tr>
						<td class='center'><span style="cursor:pointer" onclick="postProcess('<?=$t->process_cd?>','<?=$t->process_nm?>')"><?=$t->process_gb?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postProcess('<?=$t->process_cd?>','<?=$t->process_nm?>')"><?=$t->process_nm?></span></td>
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