<?
$title = "기기리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once('../../library/function.php');
session_start();
extract($_POST);
extract($_GET);

$sql = "select * from erp_machine";
$result = mysql_query($sql) or die (mysql_error());

?>

<script>
function postmachine(machine_uid, machine_nm) {
	//opener.document.find(".process_cd").val(process_cd);
	//$("#process_cd",opener.document).val(process_cd);
	//$("#machine_uid",opener.document).val(machine_uid);
	//$("#machine_nm",opener.document).val(machine_nm);
	//window.close();

	//window.parent.$("#machine_uid").val(machine_uid);
	window.parent.$("#machine_cd").val(machine_uid);
	window.parent.$("#machine_nm").val(machine_nm);
	
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
						<th class="col-xs-1 center" style="background-color:#f1f1f1">번호</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">공정구분</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">공정명</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">공정코드</th>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">기기명</th>
					</tr>
					<?
					$i=1;
					while($t = mysql_fetch_object($result)) {
					?>
					<tr>
						<td class='center'><?=$i?></td>
						<td class='center'><span style="cursor:pointer" onclick="postmachine('<?=$t->uid?>','<?=$t->machine_nm?>')"><?=getProcessGb($t->process_cd)?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postmachine('<?=$t->uid?>','<?=$t->machine_nm?>')"><?=getProcessName($t->process_cd)?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postmachine('<?=$t->uid?>','<?=$t->machine_nm?>')"><?=$t->process_cd?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postmachine('<?=$t->uid?>','<?=$t->machine_nm?>')"><?=$t->machine_nm?></span></td>
					</tr>			
					<?
					++$i;
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