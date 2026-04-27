<?
session_start();
if($_SESSION['login_id'] == "") header("Location: index.php");
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>출고출하관리,입고관리</title>
<link href="css01/bootstrap.min.css" rel="stylesheet">
<!--슬라이드 박스 위치 css-->
<link rel="stylesheet" type="text/css" href="css01/style.css">
<!--css-->
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<!--로그아웃 박스-->
<table class="box1">
	<tr>
		<td>
			<div></div>
			<div>
				<input type="button" name="" value="로그아웃" onclick="location.href='logout.php'">
				<b><?=$_SESSION['login_nm']?></b>
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			</div>
		</td>
	</tr>
</table>

<!--출고출하관리, 입고관리 박스-->
<table>
	<tr>
		<td>
			<!--출고출하관리, 입고관리 감싸는 wrap_box-->
			<div class="wrap_box">
				<!--출고출하관리 purch-box -->
				<div class="purch-box">
					<!--제목-->
					<div class="purch_tit">
						<p>출고출하관리</p>
					</div>
					<!--버튼-->
					<div class="purch_btn">
						<button onclick="location.href='wrap_release.php'">바로가기</button>
					</div>
				</div>
				<!--입고관리 purch-box-->
				<div class="purch-box">
					<div class="purch_tit">
						<p>입고관리</p>
					</div>
					<div class="purch_btn">
						<button onclick="location.href='barcode.php'">바로가기</button>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js01/bootstrap.min.js"></script>
</body>
</html>