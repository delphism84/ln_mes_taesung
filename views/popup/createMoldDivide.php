<?
$title = "금형구분등록";
require_once("../../connection.php");
require_once("../../assets/phead.php");
extract($_POST);
extract($_GET);
?>

<script>
$(document).ready(function(){
	createMoldDivideCode();
});

function postGroup(mold_divide_cd, mold_divide_nm) {
	window.parent.$("#mold_divide_cd").val(mold_divide_cd);
	window.parent.$("#mold_divide_nm").val(mold_divide_nm);
	window.parent.$("#<?=$dialogID?>").modal( 'hide' );
}	

// 금형구분코드 자동생성
function createMoldDivideCode(){
	
	var data_string = "mode=createMoldDivideCode";

	$.ajax({
		type : "post",
		url : "../../ajax/mold.php",
		data : data_string,
		success : function(str) {
			$("#mold_divide_cd").val(str);
		}
	});	
}

function registMoldDivide(){

	if ($("#mold_divide_cd").val()=="")
	{
		alert('금형 구분코드를 입력하세요.')
		$("#mold_divide_cd").focus()
		return false;
	}

	if ($("#mold_divide_nm").val()=="")
	{
		alert('금형 구분명을 입력하세요.')
		$("#mold_divide_nm").focus()
		return false;
	}
	var dataString = "mode=registMoldDivide&mold_divide_cd=" + $("#mold_divide_cd").val() + "&mold_divide_nm=" + $("#mold_divide_nm").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "../../ajax/mold.php",
		success : function(str) {
			if(str == "success") {
				alert("금형 구분 정보를 등록하였습니다");
				$("#mold_divide_nm").val("");
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
						<th class="col-xs-2" style="background-color:#f1f1f1">금형구분코드</th>
						<td class="col-xs-6"><input type="text" class="form-control" name="mold_divide_cd" id="mold_divide_cd" readonly /></td>
					</tr>
					<tr>
						<th class="col-xs-2" style="background-color:#f1f1f1">금형구분명</th>
						<td class="col-xs-6"><input type="text" class="form-control" name="mold_divide_nm" id="mold_divide_nm" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-danger" type="button" onclick="registMoldDivide()">
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