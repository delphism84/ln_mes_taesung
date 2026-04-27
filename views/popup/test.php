<?
$title = "단가표";
require_once("../../connection.php");
require_once("../../assets/phead.php");

$sql = "select * from erp_stock_inout where item_cd='".$item_cd."' and standard='".$standard."'";
$result = mysql_query($sql);
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
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix form-actions center">
		<div class="col-md-12">
			<button class="btn btn-info" type="button" onclick="formSubmit()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				Submit
			</button>

			&nbsp; &nbsp; &nbsp;
			<button class="btn" type="reset">
				<i class="ace-icon fa fa-undo bigger-110"></i>
				Reset
			</button>
		</div>
	</div><!-- // submit -->
</div><!-- /.page-content -->


<?
require_once("../../assets/pfoot.php");
?>