<?
$title = "금형등급등록";
require_once("../../connection.php");
require_once("../../assets/phead.php");
extract($_POST);
extract($_GET);
?>

<script>
$(document).ready(function(){
	createMoldClassCode();
});

function postGroup(mold_class_cd, mold_class_nm) {
	window.parent.$("#mold_class_cd").val(mold_class_cd);
	window.parent.$("#mold_class_nm").val(mold_class_nm);
	window.parent.$("#<?=$dialogID?>").modal( 'hide' );
}	

// 금형등급코드 자동생성
function createMoldClassCode(){
	
	var data_string = "mode=createMoldClassCode";

	$.ajax({
		type : "post",
		url : "../../ajax/mold.php",
		data : data_string,
		success : function(str) {
			$("#mold_class_cd").val(str);
		}
	});	
}

function registMoldClass(){

	if ($("#mold_class_cd").val()=="")
	{
		alert('금형 등급코드를 입력하세요.')
		$("#mold_class_cd").focus()
		return false;
	}

	if ($("#mold_class_nm").val()=="")
	{
		alert('금형 등급명을 입력하세요.')
		$("#mold_class_nm").focus()
		return false;
	}
	var dataString = "mode=registMoldClass&mold_class_cd=" + $("#mold_class_cd").val() + "&mold_class_nm=" + $("#mold_class_nm").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "../../ajax/mold.php",
		success : function(str) {
			if(str == "success") {
				alert("금형 등급을 등록하였습니다");
				$("#mold_class_nm").val("");
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
				<input type="hidden" name="controller" id="controller" value="mold" />
				<input type="hidden" name="action" id="action" value="registMoldClass" />

				<!-- 테이블 -->
				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-2" style="background-color:#f1f1f1">금형등급코드</th>
						<td class="col-xs-6"><input type="text" class="form-control" name="mold_class_cd" id="mold_class_cd" readonly /></td>
					</tr>
					<tr>
						<th class="col-xs-2" style="background-color:#f1f1f1">금형등급명</th>
						<td class="col-xs-6"><input type="text" class="form-control" name="mold_class_nm" id="mold_class_nm" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-danger" type="button" onclick="registMoldClass()">
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