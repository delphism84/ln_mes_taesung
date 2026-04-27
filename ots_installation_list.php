<?
mysql_connect("localhost","neblog","since1970","neblog") or die ("Connect Error");
mysql_select_db("neblog");

$query = "select * from ots_installation";
$result = mysql_query($query);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="Generator" content="EditPlus®">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<title>Document</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<form method="post" action="<?=$PHP_SELF?>">
		<input type="hidden" name="mode" id="mode" value="regist" />
		<table class="table table-bordered">
			<tr>
				<th>번호</th>
				<th>모델명</th>
				<th>설치위치</th>
				<th>설치일</th>
				<th>설치업체</th>
				<th>등록일</th>
			</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
			<tr>
				<td><?=$t->uid?></td>
				<td><a href="ots_installation_view.php?uid=<?=$t->uid?>"><?=$t->product_name?></a></td>
				<td><?=$t->location?></td>
				<td><?=$t->create_date?></td>
				<td></td>
				<td><?=$t->create_date?></td>
			</tr>
<?
}
?>
		</table>
		<div style="margin-top:20px; text-align:center"><input type="submit" class="btn btn-warning" value="저장" /></div>
	</form>
</body>
</html>