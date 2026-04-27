<?
extract($_GET);
extract($_POST);

$title = "일부생산";

require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");

$sql = "select * from erp_work_item where uid=".$uid;
$t = fetch_object($sql);
?>

<script>
$(document).ready(function() {
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
});

function registMakeCnt(){
	var dataString = "mode=registMakeCnt&uid=" + $("#uid").val() + "&cnt=" + $("#cnt").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "../../ajax/production.php",
		success : function(str) {
			if(str == "success") {
				$(opener.location).attr("href", "javascript:getWork(1);");
				self.close();
			} else if(str == "overflow") {
				alert("생산지시수량을 초과한 수량을 입력하셨습니다");
			} else {
				alert(str);
			}
		}
	});
}
</script>

<input type="hidden" name="uid" id="uid" value="<?=$uid?>" />

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table  table-bordered table-hover">
				<tr>
					<th class="col-xs-8 center" style="background-color:#f1f1f1">생산수량</th>
					<td><input type="text" name="cnt" id="cnt" /></td>
				</tr>		
			</table>			
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix form-actions center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-warning" type="button" onclick="registMakeCnt()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				실적등록
			</button>
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