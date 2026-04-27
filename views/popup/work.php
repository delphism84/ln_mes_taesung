<?
$title = "작업지시서";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");

$sql = "select * from erp_work where work_cd='".$work_cd."'";
$work = mysql_fetch_object(mysql_query($sql));

$sql = "select * from erp_work_item where work_cd='".$work_cd."' order by seq asc";
$result = mysql_query($sql) or die (mysql_error());
?>


<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<div class="center">
				<span style="font-weight:bold; text-decoration:underline"><h2>작업지시서</h2></span>
			</div>

			<div style="margin-top:30px">
				<div class="col-xs-6" style="float:left">
					<table class="table table-bordered">
						<tr>
							<th class="col-xs-4">작업지시서번호</th>
							<td><?=$work_cd?></td>
						</tr>
						<tr>
							<th>작업지시자</th>
							<td><?=getEmpNm($work->emp_id)?></td>
						</tr>
					</table>
				</div>
				<div class="col-xs-6" style="float:left">
					<table class="table table-bordered">
						<tr>
							<th class="col-xs-4">작업일</th>
							<td><?=substr($work->start_dt,0,10)?> ~ <?=substr($work->end_dt,0,10)?></td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<td></td>
						</tr>
					</table>
				</div>
			</div>

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
?>
				<tr>
					<td class="center"><?=getProcessNm($t->process)?></th>
					<td class="center"><?=getMachineNm($t->machine)?></th>
					<td class="center"><?=$t->item_cd?></th>
					<td class="center"><?=$t->item_nm?></th>
					<td class="center"><?=$t->standard?></th>
					<td class="center"><?=$t->order_cnt?></th>
					<td class="center"><?=getWarehouseName($t->warehouse_cd)?></th>
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