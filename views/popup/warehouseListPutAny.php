<?
$title = "창고리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);
$sql = "select * from erp_warehouse";
$result = mysql_query($sql) or die (mysql_error());
?>

<script>
/*
function postWarehouse(warehouse_cd, warehouse_nm) {
	$(opener.document).find("#warehouse_cd").val(warehouse_cd);
	$(opener.document).find("#warehouse_nm").val(warehouse_nm);
	self.close();
}
*/

function postWarehouse(lnc,lnn){
	
	var flag = window.parent.$("#warehouse_cdFlag").val();
	var arr = [];
	var warehouse_cd = [];

	$.each(window.parent.$("#warehouse_cd") , function () {
		arr.push($(this).val());
	});
	for(var i = 0 ; i <= arr.length ; i++) {
		warehouse_cd.push(arr[i]);
	}
	var check = warehouse_cd;
	var idx = jQuery.inArray(check, warehouse_cd);
	if(idx >= 0) {
		alert("동일 코드를 이미 선택하셨습니다");
	} else {	
		var flag = flag;
		<?if ($cd=="" && $nm=="" ){?>
			window.parent.$("#warehouse_cd").val(lnc);
			window.parent.$("#warehouse_nm").val(lnn);
		<?}else{?>
			window.parent.$("#<?=$cd?>").val(lnc);
			window.parent.$("#<?=$nm?>").val(lnn);
		
		<?}?>
		//window.parent.$("#warehouse_cdFlag").val(Number(flag) + 1);
	}
	window.parent.$("#<?=$dialogID?>").modal( 'hide' );
	//window.parent.$("#id-btn-dialog1").dialog("close");
	//window.parent.closeModal('#id-btn-dialog1');
	//$(opener.document).find("#id-btn-dialog1").dialog("close");
	//window.parent.closeModal('".$dialogID."');
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
						<th class="col-xs-4" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 창고코드</th>
						<th class="col-xs-8" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 창고명</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
					<tr>
						<td><span style="cursor:pointer" onclick="postWarehouse('<?=$t->warehouse_cd?>','<?=$t->warehouse_nm?>')"><?=$t->warehouse_cd?></span></td>
						<td><span style="cursor:pointer" onclick="postWarehouse('<?=$t->warehouse_cd?>','<?=$t->warehouse_nm?>')"><?=$t->warehouse_nm?></span></td>
					</tr>			
<?
}				
?>
				</table>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix form-actions center">
		<div class="col-md-12">
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