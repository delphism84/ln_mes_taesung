<?
session_start();
if($_SESSION['login_id'] != "") header("Location: main.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V18</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="CSS/util.css">
	<link rel="stylesheet" type="text/css" href="CSS/main.css">
<!--===============================================================================================-->
<style>
.selectbox { 
	position: relative; 
	width: 200px; 
	/* 너비설정 */ 
	border: 1px solid #ccc; 
	/* 테두리 설정 */ 
	z-index: 1; 
} 

.selectbox:before { 
	/* 화살표 대체 */ 
	content: ""; 
	position: absolute; 
	top: 50%; 
	right: 15px; 
	width: 0; 
	height: 0; 
	margin-top: -1px; 
	border-left: 5px solid transparent; 
	border-right: 5px solid transparent; 
	border-top: 5px solid #333; 
} 

.selectbox label { 
	position: absolute; top: 1px; 
	/* 위치정렬 */ 
	left: 5px; /* 위치정렬 */ 
	padding: .8em .5em; 
	/* select의 여백 크기 만큼 */ 
	color: #999; 
	z-index: -1; 
	/* IE8에서 label이 위치한 곳이 클릭되지 않는 것 해결 */ 
} 

.selectbox select { 
	width: 100%; 
	height: auto; 
	/* 높이 초기화 */ 
	line-height: normal; 
	/* line-height 초기화 */ 
	font-family: inherit; 
	/* 폰트 상속 */ 
	padding: .8em .5em; 
	/* 여백과 높이 결정 */ 
	border: 0; opacity: 0; 
	/* 숨기기 */ 
	filter:alpha(opacity=0); 
	/* IE8 숨기기 */ 
	-webkit-appearance: none; 
	/* 네이티브 외형 감추기 */ 
	-moz-appearance: none; 
	appearance: none; 
}
</style>
</head>
<body style="background-color: #666666;">
<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<form class="login100-form validate-form">
				<span class="login100-form-title p-b-43">
					자재 입출고관리
				</span>
										
				<div class="wrap-input100" style="margin-top:10px">
					<input class="input100" type="text" name="login_id" id="login_id">
					<span class="focus-input100"></span>
					<span class="label-input100">ID</span>
				</div>
									
				<div class="wrap-input100">
					<input class="input100" type="password" name="login_pwd" id="login_pwd">
					<span class="focus-input100"></span>
					<span class="label-input100">Password</span>
				</div>
		
				<div class="container-login100-form-btn">
					<input type="button" class="btn btn-lg btn-info" id="btnLogin" style="width:100%" value="login" />
				</div>
					
				<div class="text-center p-t-46 p-b-20">
					<span class="txt2">
						JENG
					</span>
				</div>

				<div class="login100-form-social flex-c-m">
					<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
						<i class="fa fa-facebook-f" aria-hidden="true"></i>
					</a>

					<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
						<i class="fa fa-twitter" aria-hidden="true"></i>
					</a>
				</div>
			</form>

			<div class="login100-more" style="background-image: url('images/bg-01.jpg');">
			</div>
		</div>
	</div>
</div>
	
	

	
	
<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

<script>
$(document).ready(function() {
	$("#login_id").val("");
	$("#login_pwd").val("");
	
	var selectTarget = $('.selectbox select'); 
	selectTarget.change(function(){ 
		var select_name = $(this).children('option:selected').text(); 
		$(this).siblings('label').text(select_name); 
	}); 

	$("#btnLogin").click(function (event) {
		var login_id = $("#login_id").val();
		var login_pwd = $("#login_pwd").val();

		if(login_id == "") {
			alert("아이디를 입력하세요");
			return false;
		}

		if(login_pwd == "") {
			alert("비밀번호를 입력하세요");
			return false;
		}

		var parameter = {"mode" : "sLogin", "login_id" : login_id, "login_pwd" : login_pwd};
		$.ajax({
			type : "post",
			data : parameter,
			url : "../ajax.php",
			success : function(str) {
				if(str == "success") {
					location.href = "main.php";
				} else if(str == "none") {
					alert("일치하는 회원이 없습니다");
				} else if(str == "pwd") {
					alert("비밀번호가 일치하지 않습니다");
				} else {
					alert(str);
				}
			}
		});
	});
});
</script>

</body>
</html>