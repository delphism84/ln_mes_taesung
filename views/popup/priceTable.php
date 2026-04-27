<?
$title = "단가표";
require_once("../../connection.php");
require_once("../../assets/phead.php");

$sql = "select * from erp_stock_inout where item_cd='".$item_cd."' and standard='".$standard."' order by uid desc";
$result = mysql_query($sql) or die (mysql_error());
?>


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
						<th class="col-xs-2" style="background-color:#f1f1f1">품목코드</th>
						<td class="col-xs-4"><?=$item_cd?></td>
						<th class="col-xs-2" style="background-color:#f1f1f1">규격</th>
						<td class="col-xs-4"><?=$standard?></td>
					</tr>							
				</table>

				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-4 center" style="background-color:#f1f1f1">입/출고일</th>
						<th class="col-xs-4 center" style="background-color:#f1f1f1">판매단가(단순평균)</th>
						<th class="col-xs-4 center" style="background-color:#f1f1f1">구매단가(단순평균)</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {					
?>
					<tr>
						<td class='center'><?=substr($t->create_dt,0,10)?></th>
						<td class='center'><?=number_format($t->sale_price)?></th>
						<td class='center'><?=number_format($t->pur_unit_price)?></th>
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