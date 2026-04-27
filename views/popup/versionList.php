<?
$title = "버전안내";
require_once("../../connection2.php");
require_once("../../assets/phead.php");

$sql = "select * from erp_version where target='all' or target='".$target."' order by uid desc";
$result = mysql_query($sql);
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
						<th class="col-xs-2 center" style="background-color:#f1f1f1">버전코드</th>
						<th class="col-xs-5 center" style="background-color:#f1f1f1">제목</th>
						<th class="col-xs-5 center" style="background-color:#f1f1f1">업데이트날짜</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
					<tr>
						<td class="center"><a href="versionView.php?uid=<?=$t->uid?>"><?=$t->version?></a></th>
						<td class="center"><a href="versionView.php?uid=<?=$t->uid?>"><?=$t->version_code?></a></th>
						<td class="center"><a href="versionView.php?uid=<?=$t->uid?>"><?=$t->title?></a></th>
						<td class="center"><a href="versionView.php?uid=<?=$t->uid?>"><?=$t->create_dt?></a></th>
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