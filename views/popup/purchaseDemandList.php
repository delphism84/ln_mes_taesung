<?
$title = "구매요청서 리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);
//$sql = "select * from erp_purchase_demand where state<>'complete'";
$sql = "select * from erp_purchase_demand order by uid desc";
$result = mysql_query($sql) or die (mysql_error());
?>

<script>
function postPurchaseDemand(uid,purchase_cd, purchase_dt, account_nm) {
	$(opener.document).find("#title").val(account_nm + " 납품건");
	$(opener.document).find("#purchase_uid").val(uid);
	$(opener.document).find("#purchase_cd").val(purchase_cd);
	$(opener.document).find("#end_dt").val(purchase_dt);
	$(opener.location).attr("href", "javascript:getPurchaseDemandItem();");
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
						<th class="col-xs-3 center" style="background-color:#f1f1f1">구매요청서코드</th>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">거래처명</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">요청일자</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
					<tr>
						<td class='center'><span style="cursor:pointer" onclick="postPurchaseDemand('<?=$t->uid?>','<?=$t->purchase_cd?>','<?=substr($t->purchase_dt,0,10)?>','<?=$t->account_nm?>')"><?=$t->purchase_cd?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postPurchaseDemand('<?=$t->uid?>','<?=$t->purchase_cd?>','<?=substr($t->purchase_dt,0,10)?>','<?=$t->account_nm?>')"><?=$t->account_nm?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postPurchaseDemand('<?=$t->uid?>','<?=$t->purchase_cd?>','<?=substr($t->purchase_dt,0,10)?>','<?=$t->account_nm?>')"><?=substr($t->create_dt,0,10)?></span></td>
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