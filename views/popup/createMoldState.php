<?
$title = "금형상태등록";
require_once("../../connection.php");
require_once("../../assets/phead.php");
extract($_POST);
extract($_GET);
?>

<script>
$(document).ready(function(){
	createMoldStateCode();
});

function postGroup(mold_state_cd, mold_state_nm) {
	window.parent.$("#mold_state_cd").val(mold_state_cd);
	window.parent.$("#mold_state_nm").val(mold_state_nm);
	window.parent.$("#<?=$dialogID?>").modal( 'hide' );
}	

// 금형상태코드 자동생성
function createMoldStateCode(){
	
	var data_string = "mode=createMoldStateCode";

	$.ajax({
		type : "post",
		url : "../../ajax/mold.php",
		data : data_string,
		success : function(str) {
			$("#mold_state_cd").val(str);
		}
	});	
}

function registMoldState(){

	if ($("#mold_state_cd").val()=="")
	{
		alert('금형 상태코드를 입력하세요.')
		$("#mold_state_cd").focus()
		return false;
	}

	if ($("#mold_state_nm").val()=="")
	{
		alert('금형 상태명을 입력하세요.')
		$("#mold_state_nm").focus()
		return false;
	}

	var dataString = "mode=registMoldState&mold_state_cd=" + $("#mold_state_cd").val() + "&mold_state_nm=" + $("#mold_state_nm").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "../../ajax/mold.php",
		success : function(str) {
			if(str == "success") {
				alert("금형 상태을 등록하였습니다");
				$("#mold_state_cd").val("");
				$("#mold_state_nm").val("");
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
				<input type="hidden" name="action" id="action" value="registMoldState" />

				<!-- 테이블 -->
				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-2" style="background-color:#f1f1f1">금형상태코드</th>
						<td class="col-xs-6"><input type="text" class="form-control" name="mold_state_cd" id="mold_state_cd" readonly /></td>
					</tr>
					<tr>
						<th class="col-xs-2" style="background-color:#f1f1f1">금형상태명</th>
						<td class="col-xs-6"><input type="text" class="form-control" name="mold_state_nm" id="mold_state_nm" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-danger" type="button" onclick="registMoldState()">
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