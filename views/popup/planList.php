<?
$title = "생산계획서 리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");

$sql = "select * from erp_workplan";
$result = mysql_query($sql) or die (mysql_error());
?>

<script>
function postPlan(title,work_gb,order_cd,workplan_cd,start_dt,end_dt) {
	$(opener.document).find("#title").val(title);
	$(opener.document).find("#work_gb").val(work_gb);
	$(opener.document).find("#order_cd").val(order_cd);
	$(opener.document).find("#workplan_cd").val(workplan_cd);
	$(opener.document).find("#start_dt").val(start_dt);
	$(opener.document).find("#end_dt").val(end_dt);
	$(opener.document).find("#work_start_dt").val(start_dt);
	$(opener.document).find("#work_end_dt").val(end_dt);
	$(opener.document).find("#deadline_dt").val(end_dt);
	$(opener.location).attr("href", "javascript:getWorkplanBom('" + workplan_cd + "');");
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

				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">생산유형</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">생산계획코드</th>
						<th class="col-xs-4 center" style="background-color:#f1f1f1">제목</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">착수예정일</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">종료예정일</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
					<tr>
						<td class='center'><span style="cursor:pointer" onclick="postPlan('<?=$t->title?>','<?=$t->work_gb?>','<?=$t->order_cd?>','<?=$t->workplan_cd?>','<?=substr($t->start_dt,0,10)?>','<?=substr($t->end_dt,0,10)?>')"><?=$t->work_gb?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postPlan('<?=$t->title?>','<?=$t->work_gb?>','<?=$t->order_cd?>','<?=$t->workplan_cd?>','<?=substr($t->start_dt,0,10)?>','<?=substr($t->end_dt,0,10)?>')"><?=$t->workplan_cd?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postPlan('<?=$t->title?>','<?=$t->work_gb?>','<?=$t->order_cd?>','<?=$t->workplan_cd?>','<?=substr($t->start_dt,0,10)?>','<?=substr($t->end_dt,0,10)?>')"><?=$t->title?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postPlan('<?=$t->title?>','<?=$t->work_gb?>','<?=$t->order_cd?>','<?=$t->workplan_cd?>','<?=substr($t->start_dt,0,10)?>','<?=substr($t->end_dt,0,10)?>')"><?=substr($t->start_dt,0,10)?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postPlan('<?=$t->title?>','<?=$t->work_gb?>','<?=$t->order_cd?>','<?=$t->workplan_cd?>','<?=substr($t->start_dt,0,10)?>','<?=substr($t->end_dt,0,10)?>')"><?=substr($t->end_dt,0,10)?></span></td>
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