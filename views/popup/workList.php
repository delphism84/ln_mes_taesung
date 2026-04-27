<?
$title = "작업지시서";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");

$sql = "select * from erp_work ";
$result = mysql_query($sql) or die (mysql_error());
?>


<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<!-- 테이블 -->
			<table id="simple-table" class="table  table-bordered table-hover">
				<tr>
					<th class="center" style="background-color:#f1f1f1">공정</th>
					<th class="center" style="background-color:#f1f1f1">기계</th>
					<th class="center" style="background-color:#f1f1f1">품목코드</th>
					<th class="center" style="background-color:#f1f1f1">품목명</th>
					<th class="center" style="background-color:#f1f1f1">규격</th>
					<th class="center" style="background-color:#f1f1f1">지시수량</th>
					<th class="center" style="background-color:#f1f1f1">생산입고창고</th>
				</tr>
					<?
					while($t = mysql_fetch_object($result)) {
						//echo $t->work_cd;
						$sql = "select * from erp_work_item where work_cd='".$t->work_cd."' order by seq asc";
						$w = mysql_fetch_object(mysql_query($sql));
						//echo  $w->process;
						
					?>
				<tr>
					<td class="center"><?=getProcessName($w->process)?></th>
					<td class="center"><?=getMachineNm($w->machine)?></th>
					<td class="center"><?=$w->item_cd?></th>
					<td class="center"><?=$w->item_nm?></th>
					<td class="center"><?=$w->standard?></th>
					<td class="center"><?=$w->order_cnt?></th>
					<td class="center"><?=getWarehouseName($w->warehouse_cd)?></th>
				</tr>				
				<?exit;
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