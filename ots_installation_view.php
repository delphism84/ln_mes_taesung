<?
mysql_connect("localhost","neblog","since1970","neblog") or die ("Connect Error");
mysql_select_db("neblog");

$query = "select * from ots_installation where uid=$_GET[uid]";
$result = mysql_query($query);
$t = mysql_fetch_object($result);
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
				<th width="10%">접수번호</th>
				<td width="40%"><?=time()?></td>
				<th width="10%">등록일</th>
				<td width="40%"><?=$t->create_date?></td>
			</tr>
			<tr>
				<th>모델명</th>
				<td><?=$t->product_name?></td>
				<th>설치위치</th>
				<td><?=$t->location?></td>
			</tr>
			<tr>
				<th>설치일</th>
				<td><?=$t->create_date?></td>
				<th>설치업체</th>
				<td></td>
			</tr>
			<tr>
				<th>원인</th>
				<td colspan="3">
					<textarea class="form-control" rows="5"><?=$t->memo?></textarea>
				</td>
			</tr>
			<tr>
				<th rowspan="3">설치사진</th>
				<td rowspan="3"><img src="testup/<?=$t->photo?>" style="width:150px" /></td>
				<th>바코드</th>
				<td><<?=$t->barcode?>/td>
			</tr>
			<tr>
				<th>불량코드</th>
				<td>
					<select class="form-control">
						<option>선택하세요</option>
						<option>불량코드1</option>
						<option>불량코드2</option>
						<option>불량코드3</option>
						<option>불량코드4</option>
						<option>불량코드5</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>처리담당자</th>
				<td><input type="text" class="form-control" /></td>
			</tr>
		</table>
		<div style="margin-top:20px; text-align:center"><input type="submit" class="btn btn-warning" value="저장" /></div>
	</form>
</body>
</html>