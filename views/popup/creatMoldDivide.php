<?
$title = "금형그룹등록";
require_once("../../connection.php");
require_once("../../assets/phead.php");
extract($_POST);
extract($_GET);
?>

<script>
$(document).ready(function(){
	createMoldGroupCode();
});

function postGroup(mold_group_cd, mold_group_nm) {
	window.parent.$("#mold_group_cd").val(mold_group_cd);
	window.parent.$("#mold_group_nm").val(mold_group_nm);
	window.parent.$("#<?=$dialogID?>").modal( 'hide' );
}	

// 금형그룹코드 자동생성
function createMoldGroupCode(){
	
	var data_string = "mode=createMoldGroupCode";

	$.ajax({
		type : "post",
		url : "../../ajax/mold.php",
		data : data_string,
		success : function(str) {
			$("#mold_group_cd").val(str);
		}
	});	
}

function registGroup(){
	var dataString = "mode=registMoldGroup&mold_group_cd=" + $("#mold_group_cd").val() + "&mold_group_nm=" + $("#mold_group_nm").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "../../ajax/mold.php",
		success : function(str) {
			if(str == "success") {
				alert("금형 그룹을 등록하였습니다");
				$("#mold_group_nm").val("");
				window.parent.$("#<?=$dialogID?>").modal( 'hide' );
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
						<th class="col-xs-2" style="background-color:#f1f1f1">금형그룹코드</th>
						<td class="col-xs-6"><input type="text" class="form-control" name="mold_group_cd" id="mold_group_cd" readonly /></td>
					</tr>
					<tr>
						<th class="col-xs-2" style="background-color:#f1f1f1">금형그룹명</th>
						<td class="col-xs-6"><input type="text" class="form-control" name="mold_group_nm" id="mold_group_nm" /></td>
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