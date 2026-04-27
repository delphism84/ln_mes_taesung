<?
$title = "품목 재질 등록";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);
?>

<script>

$(document).ready(function() {
	var item_cd = $(opener.document).find("#item_cd").val();
	if(item_cd.trim() == "") {
		alert("품목코드가 생성이 되어있지 않습니다. 품목코드 생성 후 진행하세요");
		self.close()
		return
	} else {
		$("#item_cd").val(item_cd);
	}
});

// 품목 규격 등록하기
function registItemMaterial() {
	if($("#item_cd").val() == "") {
		alert("품목코드가 생성이 되어있지 않습니다. 품목코드 생성 후 진행하세요");
		return
	}
	
	var data_string = "mode=registItemMaterial&item_cd=" + $("#item_cd").val() + "&material=" + $("#material").val();
	$.ajax({
		type : "post",
		url : "../../ajax/base.php",
		data : data_string,
		success : function (str) {
			if(str == "success") {
				alert("재질을 등록하였습니다");
				$("#material").val("");
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
			<table id="simple-table" class="table  table-bordered table-hover">
				<tr>
					<th class="col-xs-2" style="background-color:#f1f1f1">품목코드</th>
					<td class="col-xs-6"><input type="text" class="form-control" name="item_cd" id="item_cd" readonly /></td>
				</tr>
				<tr>
					<th class="col-xs-2" style="background-color:#f1f1f1">재질</th>
					<td class="col-xs-6"><input type="text" class="form-control" name="material" id="material" /></td>
				</tr>
			</table>
		</div>
	</div>

	<!-- submit -->
	<div class="clearfix center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-danger" type="button" onclick="registItemMaterial()">
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