<?
$title = "금형위치등록";
require_once("../../connection.php");
require_once("../../assets/phead.php");
extract($_POST);
extract($_GET);
?>

<script>
$(document).ready(function(){
	createMoldLocationCode();
});

function postGroup(mold_location_cd, mold_location_nm) {
	window.parent.$("#mold_location_cd").val(mold_location_cd);
	window.parent.$("#mold_location_nm").val(mold_location_nm);
	window.parent.$("#<?=$dialogID?>").modal( 'hide' );
}	

// 금형위치코드 자동생성
function createMoldLocationCode(){
	
	var data_string = "mode=createMoldLocationCode";

	$.ajax({
		type : "post",
		url : "../../ajax/mold.php",
		data : data_string,
		success : function(str) {
			$("#mold_location_cd").val(str);
		}
	});	
}

function registMoldLocation(){

	if ($("#mold_location_cd").val()=="")
	{
		alert('금형 위치코드를 입력하세요.')
		$("#mold_location_cd").focus()
		return false;
	}

	if ($("#mold_location_nm").val()=="")
	{
		alert('금형 위치명을 입력하세요.')
		$("#mold_location_nm").focus()
		return false;
	}

	var dataString = "mode=registMoldLocation&mold_location_cd=" + $("#mold_location_cd").val() + "&mold_location_nm=" + $("#mold_location_nm").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "../../ajax/mold.php",
		success : function(str) {
			if(str == "success") {
				alert("금형 위치을 등록하였습니다");
				$("#mold_location_cd").val("");
				$("#mold_location_nm").val("");
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
				<input type="hidden" name="action" id="action" value="registMoldLocation" />

				<!-- 테이블 -->
				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-2" style="background-color:#f1f1f1">금형위치코드</th>
						<td class="col-xs-6"><input type="text" class="form-control" name="mold_location_cd" id="mold_location_cd" readonly /></td>
					</tr>
					<tr>
						<th class="col-xs-2" style="background-color:#f1f1f1">금형위치명</th>
						<td class="col-xs-6"><input type="text" class="form-control" name="mold_location_nm" id="mold_location_nm" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-danger" type="button" onclick="registMoldLocation()">
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