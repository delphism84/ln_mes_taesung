

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>quick 메인페이지</title>
<link href="css01/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css01/style.css">
<link rel="stylesheet" type="text/css" href="css01/comm.css">
</head>


<body>
	<!--로그아웃 박스-->
	<table class="box1">
		<tr>
			<td>
				<div></div>
				<div>
					<input type="button" name="" value="로그아웃" onclick="location.href='logout.php'">
					<b><?=$_SESSION['login_nm']?>정태준</b>
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
			</td>
		</tr>
	</table>
	<!--키인입고 슬라이드-->
	<div class="keyin background-fff">		
		<div class="padding-20px">
			<div class="left-box" style="border-right:1px solid #ddd; height:830px;padding-right:25px;">
				<div style="margin-left:10px;"><input type="button" class="btn btn-xs btn-danger" value="입고대기 품목" /></div>
				<span style="height:815px;  overflow-y:scroll; padding:0px 10px; display:block">
					<table class="table table-bordered" id="keyin_tb" >
						<thead>
							<tr class="info">
								<th>품번</th>
								<th>픔명</th>
								<th>규격</th>
								<th>검사수량</th>
								<th>LOT NO</th>
								<th>검사신청일</th>
								<th>상태</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				<span>
			</div>
			<div class="right-box">
				<div><input type="button" class="btn btn-xs btn-danger" value="품목정보" /></div>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th>작지번호</th>
							<td><input type="number" autocomplete="off" disabled/></td>
						</tr>
						<tr>
							<th>품번</th>
							<td><input type="number" autocomplete="off" disabled/></td>
						</tr>
						<tr>
							<th>품명</th>
							<td><input type="number" autocomplete="off" disabled/></td>
						</tr>
						<tr>
							<th>규격</th>
							<td><input type="number" autocomplete="off" disabled/></td>
						</tr>
						<tr>
							<th>검사지시수량</th>
							<td><input type="number" autocomplete="off" disabled/></td>
						</tr>
						<tr>
							<th>Lot No</th>
							<td><input type="number" autocomplete="off" disabled/></td>
						</tr>
					</tbody>
				</table>
				<form name="keyin_frm" id="keyin_frm">
					<input type="hidden" name="mode" id="mode" value="sRegistWarehousing" />
					<input type="hidden" name="uid" id="uid" />
					<input type="hidden" name="remain_cnt" id="remain_cnt" />					
					<div><input type="button" class="btn btn-xs btn-danger" value="수입검사" /></div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>검사항목</th>
								<th>부적격수량</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>스팩불량</th>
								<td><input type="number" autocomplete="off" value="0"/></td>
							</tr>
							<tr>
								<th>외관불량</th>
								<td><input type="number" autocomplete="off" value="0"/></td>
							</tr>
							<tr>
								<th>오염</th>
								<td><input type="number" autocomplete="off" value="0"/></td>
							</tr>
							<tr>
								<th>대기오염</th>
								<td><input type="number" autocomplete="off" value="0"/></td>
							</tr>
						</tbody>
					</table>					
				</form>
				<div style="text-align:center"><input type="button" class="btn btn-lg btn-primary" value="품목입고" id="btnKeyinSubmit" /></div>
			</div>
		</div>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js01/bootstrap.min.js"></script>
</body>
</html>