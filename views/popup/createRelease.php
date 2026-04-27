<?
$title = "부분출고";
require_once("../../connection.php");
require_once("../../assets/phead.php");
?>

<script>
// 품목 규격 등록하기
function registRelease() {
	var uid = $("#uid").val();
	var inout_uid = $("#inout_uid").val();
	var remain_cnt = $("#remain_cnt").val();
	var cnt = $("#cnt").val();
	var new_remain_cnt = Number(remain_cnt) - Number(cnt);

	if(Number(cnt) > Number(remain_cnt)) {
		alert("잔여요청수량보다 더 많은 수량을 출고하실 수 없습니다");
		return false;
	}

	var data_string = "mode=registPartRelease&uid=" + uid + "&inout_uid=" + inout_uid + "&remain_cnt=" + remain_cnt + "&cnt=" + cnt;

	$.ajax({
		type : "post",
		url : "../../ajax/production.php",
		data : data_string,
		success : function (str) {
			if(str == "success") {
				alert("부분출고를 하였습니다.");
				$(opener.location).attr("href", "javascript:reloading();");
				self.close();
			} else {
				alert(str);
			}
		}
	});
}
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<input type="hidden" name="uid" id="uid" value="<?=$_GET['uid']?>" />
			<input type="hidden" name="inout_uid" id="inout_uid" value="<?=$_GET['inout_uid']?>" />

			<!-- 테이블 -->
			<table id="simple-table" class="table  table-bordered table-hover">
				<tr>
					<th class="col-xs-3" style="background-color:#f1f1f1">잔여요청수량</th>
					<td class="col-xs-5"><input type="text" class="form-control" name="remain_cnt" id="remain_cnt" value="<?=$_GET['remain_cnt']?>" readonly /></td>
				</tr>
				<tr>
					<th class="col-xs-3" style="background-color:#f1f1f1">출고수량</th>
					<td class="col-xs-5"><input type="text" class="form-control" name="cnt" id="cnt" /></td>
				</tr>
			</table>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-danger" type="button" onclick="registRelease()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				등록
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