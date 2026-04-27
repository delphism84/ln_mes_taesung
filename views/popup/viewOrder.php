<?
$title = "버전안내";
require_once("../../connection2.php");
require_once("../../assets/phead.php");

$sql = "select * from erp_version where uid=".$_GET['uid'];
$t = mysql_fetch_object(mysql_query($sql));
?>

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
						<th class="col-xs-1 center" style="background-color:#f1f1f1">버전</th>
						<td class='col-xs-7'>v.<?=$t->version?>.<?=$t->version_code?></td>
					</tr>
					<tr>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">제목</th>
						<td class='col-xs-7'><?=$t->title?></td>
					</tr>
					<tr>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">내용</th>
						<td class='col-xs-7'><?=$t->comment?></td>
					</tr>
				</table>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix form-actions center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-info" type="button" onclick="self.close()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				창닫기
			</button>
			<button class="btn btn-xs btn-info" type="button" onclick="history.go(-1)">
				<i class="ace-icon fa fa-check bigger-110"></i>
				돌아가기
			</button>
		</div>
	</div><!-- // submit -->
</div><!-- /.page-content -->


<?
require_once("../../assets/pfoot.php");
?>