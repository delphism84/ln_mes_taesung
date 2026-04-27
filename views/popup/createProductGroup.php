<?
$title = "품목그룹";
require_once("../../connection.php");
require_once("../../assets/phead.php");
?>

<script>
$(document).ready(function(){
	createItemGroupCode();
});

function postGroup(item_group_cd, item_group_nm) {
	$(opener.document).find("#item_group_cd").val(item_group_cd);
	$(opener.document).find("#item_group_nm").val(item_group_nm);
	self.close();
}	

// 그룹코드 자동생성
function createItemGroupCode(){
	var data_string = "mode=createItemGroupCode";

	$.ajax({
		type : "post",
		url : "../../ajax/base.php",
		data : data_string,
		success : function(str) {
			$("#item_group_cd").val(str);
		}
	});	
}

function registGroup(){
	var dataString = "mode=registItemGroup&item_group_cd=" + $("#item_group_cd").val() + "&item_group_nm=" + $("#item_group_nm").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "../../ajax/base.php",
		success : function(str) {
			if(str == "success") {
				alert("품목 그룹을 등록하였습니다");
				$("#item_group_nm").val("");
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
			<!-- PAGE CONTENT BEGINS -->
			<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" />
				<input type="hidden" name="controller" id="controller" value="groupware" />
				<input type="hidden" name="action" id="action" value="registEleSettlement" />

				<!-- 테이블 -->
				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-2" style="background-color:#f1f1f1">그룹코드</th>
						<td class="col-xs-6"><input type="text" class="form-control" name="item_group_cd" id="item_group_cd" readonly /></td>
					</tr>
					<tr>
						<th class="col-xs-2" style="background-color:#f1f1f1">그룹명</th>
						<td class="col-xs-6"><input type="text" class="form-control" name="item_group_nm" id="item_group_nm" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-danger" type="button" onclick="registGroup()">
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