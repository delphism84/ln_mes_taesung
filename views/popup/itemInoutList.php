<?
$title = "자재수불내역";
require_once("../../connection.php");
require_once("../../library/function.php");
require_once("../../assets/phead.php");

$sql = "select * from erp_reason where item_cd='".$_GET['item_cd']."' and standard='".$_GET['standard']."' order by uid asc";
$result = mysql_query($sql) or die (mysql_error());
?>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<table id="simple-table" class="table  table-bordered table-hover">
				<tr>
					<th class="col-xs-1" style="background-color:#f1f1f1">품목코드</th>
					<td class="col-xs-3"><?=$_GET['item_cd']?></td>
					<th class="col-xs-1" style="background-color:#f1f1f1">품목명</th>
					<td class="col-xs-3"><?=getItemName($_GET['item_cd'])?></td>
					<th class="col-xs-1" style="background-color:#f1f1f1">규격</th>
					<td class="col-xs-3"><?=$_GET['standard']?></td>
				</tr>
			</table>
				
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table id="simple-table" class="table  table-bordered table-striped">
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 날짜</th>
							<th class="col-xs-2" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 프로젝트</th>
							<th class="col-xs-2" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 거래처</th>
							<th class="col-xs-2" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 적요</th>
							<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 입고수량</th>
							<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 출고수량</th>
							<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 재고수량</th>
						</tr>
<?
while($t = mysql_fetch_object($result)) {
	$sql = "select * from erp_stock_inout where uid=".$t->uid;
	$stock = @mysql_fetch_object(mysql_query($sql));
	$in_sum = $in_sum + $t->in_cnt;
	$out_sum = $out_sum + $t->out_cnt;

	$sql = "select remain_cnt from erp_stock where item_cd='".$_GET['item_cd']."' and standard='".$_GET['standard']."'";
	$res = @mysql_fetch_object(mysql_query($sql));
?>
						<tr>
							<td><?=substr($t->create_dt,0,10)?></td>
							<td><?=$stock->project_cd?></td>
							<td><?=$stock->account_cd?></td>
							<td><?=$t->reason?></td>
							<td style="text-align:right"><?=$t->in_cnt?></td>
							<td style="text-align:right"><?=$t->out_cnt?></td>
							<td></td>
						</tr>			
<?
}				
?>
						<tr>
							<th class="center" style="background-color:#f1f1f1" colspan="4">누계</th>
							<th style="text-align:right; background-color:#f1f1f1"><?=number_format($in_sum)?></th>
							<th style="text-align:right; background-color:#f1f1f1"><?=number_format($out_sum)?></th>
							<th style="text-align:right; background-color:#f1f1f1"><?=number_format($res->remain_cnt)?></th>
						</tr>
					</table>
				</div>
			</div>
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