<?
$title = "품목규격";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);

$sql = "select * from erp_standard2 where item_cd='".$item_cd."'";
$result = mysql_query($sql) or die (mysql_error());
?>

<script>
$(document).ready(function() {
	var item_cd = $(opener.document).find("#item_cd").val();
	if(item_cd.trim() == "") {
		alert("품목코드가 생성이 되어있지 않습니다. 품목코드 생성 후 진행하세요");
		self.close()
	}
});

function postStandard(standard) {
	$(opener.document).find("#standard2").val(standard);
	self.close();
}	
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table  table-bordered table-hover">
				<tr>
					<th class="col-xs-8 center" style="background-color:#f1f1f1">규격</th>
				</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
				<tr>
					<td class='center'><span style="cursor:pointer" onclick="postStandard('<?=$t->standard?>')"><?=$t->standard?></span></td>
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