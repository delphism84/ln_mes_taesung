<?
$title = "받는공장리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);
$sql = "select * from erp_warehouse where warehouse_gb='창고'";
$result = mysql_query($sql) or die (mysql_error());
?>

<script>
function postWarehouse(warehouse_cd, warehouse_nm) {
	$(opener.document).find("#wh_cd_t_cd").val(warehouse_cd);
	$(opener.document).find("#wh_cd_t_nm").val(warehouse_nm);
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
						<th class="col-xs-6" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 공장코드</th>
						<th class="col-xs-6" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 공장명</th>
					</tr>
					<?
					while($t = mysql_fetch_object($result)) {
						$isset_check= $t->uid;
					?>
					<tr style="cursor:pointer"  onclick="postWarehouse('<?=$t->warehouse_cd?>','<?=$t->warehouse_nm?>')">
						<td><span ><?=$t->warehouse_cd?></span></td>
						<td><span ><?=$t->warehouse_nm?></span></td>
					</tr>			
					<?
					}				
					?>
<?if(!isset($isset_check)) {?>
	       </tr><td colspan="7" class="center"> 등록된 데이터가 없습니다.</td></tr>
<?}?>
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