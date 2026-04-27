<?
$title = "금형위치";
require_once("../../connection.php");
require_once("../../assets/phead.php");
extract($_POST);
extract($_GET);
$sql = "select * from erp_mold_location";
$result = mysql_query($sql) or die (mysql_error());
?>
<script>
/*
$(document).ready(function() {
	var mold_location_cd = $(opener.document).find("#mold_location_cd").val();
	if(mold_location_cd.trim() == "") {
		alert("품목코드가 생성이 되어있지 않습니다. 품목코드 생성 후 진행하세요");
		self.close()
	}
});
*/
function postPut(mold_location_cd,mold_location_nm) {
	window.parent.$("#mold_location_cd").val(mold_location_cd);
	window.parent.$("#mold_location_nm").val(mold_location_nm);
	window.parent.$("#<?=$dialogID?>").modal( 'hide' );
}	
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table  table-bordered table-hover">
				<tr>
					<th class="col-xs-3 center" style="background-color:#f1f1f1">금형위치코드</th>
					<th class="col-xs-3 center" style="background-color:#f1f1f1">금형위치명</th>
				</tr>
<?
$i=0;
while($t = mysql_fetch_object($result)) {
?>
				<tr>
					<td class='center'><a href="#" style="cursor:pointer" onclick="postPut('<?=$t->mold_location_cd?>','<?=$t->mold_location_nm?>')"><?=$t->mold_location_cd?></a></td>
					<td class='center'><a href="#" style="cursor:pointer" onclick="postPut('<?=$t->mold_location_cd?>','<?=$t->mold_location_nm?>')"><?=$t->mold_location_nm?></a></td>
				</tr>			
<?
$i++;
}
if($i=="0"){
?>

				<tr>
					<td class='center' colspan="3">등록된 금형 위치 정보가 없습니다.</td>
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