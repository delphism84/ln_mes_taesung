<?
mysql_connect("localhost","neblog","since1970","neblog") or die ("Connect Error");
mysql_select_db("neblog");

if($mode == "regist") {
	/*
	echo $_POST['product_code'];
	echo "<br>";
	echo $_POST['product_name'];
	echo "<br>";
	echo $_POST['barcode'];
	echo "<br>";
	*/
	$query = "insert into ots_product (product_code, product_name, barcode) values ('$_POST[product_code]','$_POST[product_name]','$_POST[barcode]')";
	$result = mysql_query($query);
}
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
				<th>품목코드</th>
				<td><input type="text" name="product_code" id="product_code" /></td>
			</tr>
			<tr>
				<th>품목명</th>
				<td><input type="text" name="product_name" id="product_name" /></td>
			</tr>
			<tr>
				<th>바코드</th>
				<td><input type="text" name="barcode" id="barcode" /></td>
			</tr>
		</table>
		<div style="margin-top:20px; text-align:center"><input type="submit" class="btn btn-warning" value="저장" /></div>
	</form>
</body>
</html>