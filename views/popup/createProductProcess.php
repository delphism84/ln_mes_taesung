<?
$title = "생산공정 등록";
require_once("../../connection.php");
require_once("../../assets/phead.php");
?>

<script>
/*
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
*/
// 품목 규격 등록하기
function registProductProcess() {
	if($("#process_cd").val() == "") {
		alert("생산공정코드를 입력하세요");
		$("#process_cd").focus();
		return
	}

	if($("#process_nm").val() == "") {
		alert("생산공정명을 입력하세요");
		$("#process_nm").focus();
		return
	}

	if($("#ranking").val() == "") {
		alert("순위를 입력하세요");
		$("#ranking").focus();
		return
	}
	
	var data_string = "mode=registProcess&process_cd=" + $("#process_cd").val() + "&process_nm=" + $("#process_nm").val() + "&ranking=" + $("#ranking").val();
	$.ajax({
		type : "post",
		url : "../../ajax/base.php",
		data : data_string,
		success : function (str) {
			if($.trim(str) == "success") {
				alert("생산공정을 등록하였습니다");
			}else if($.trim(str) == "duplicate") {
				$('#chk').html('<b style="font-size:11px;color:red">이미 존재하는 생산코드입니다. 다른 생산코드를 입력하세요.</b>');
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
					<th class="col-xs-2" style="background-color:#f1f1f1">생산공정코드</th>
					<td class="col-xs-6"><input type="text" class="form-control" name="process_cd" id="process_cd"  /><span id="chk"></span></td>
				</tr>
				<tr>
					<th class="col-xs-2" style="background-color:#f1f1f1">생산공정명</th>
					<td class="col-xs-6"><input type="text" class="form-control" name="process_nm" id="process_nm"  /></td>
				</tr>
				<tr>
					<th class="col-xs-2" style="background-color:#f1f1f1">순번</th>
					<td class="col-xs-6"><input type="text" class="form-control" name="ranking" id="ranking"  /></td>
				</tr>
			</table>
		</div>
	</div>

	<!-- submit -->
	<div class="clearfix center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-danger" type="button" onclick="registProductProcess()">
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