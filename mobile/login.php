<?
session_start();
include "connection2.php";
include "include/doctype2.php";



if($_SESSION['login_id'] != "") Header("Location:index.php");
?>

<link rel="stylesheet" href="assets/css/login.css">
<style>
</style>
<body>
	<div id="wrapr">
		<div style="width:250px;margin:0 auto; margin-top:20%;">
			<p style="width:100%; text-align:center;font-size:30px;">(주)태성</p>
		</div>
		 <form name="login_form" id="login_form">
			<div style="width:250px;margin-top:30%; margin:0 auto; margin-top:10%;">
				<div>
					<label for="id"></label>
					<input type="text"/ style="width:100%; padding:15px 10px;" placeholder="아이디를 입력해주세요" name="emp_id" id="emp_id">
				</div>
				<div>
					<label for="pass"></label>
					<input type="password" style="width:100%; padding:15px 10px;" placeholder="비밀번호를 입력해주세요" name="emp_pwd" id="emp_pwd">
				</div>
			</div>
			<div style="width:250px; border:1px solid #ddd; margin:0 auto; margin-top:10px; cursor:pointer">
				<button style="width:100%; padding:15px 0; border:none; background-color:#5ea829; color:#fff; outline:none; cursor:pointer" onclick="javascript:login();">로그인</button>
			</div>
		 </form>
		 <div style="margin-top:30px;"></div>
		 <div>
			<p style="text-align:center;">Copyright 2017 JERP. All right reserved.</p>
		 </div>
	</div>
</body>
</html>
<script>
$(document).keypress(function(e) {
	if(e.which === 13) login();
});

function centerOpenWindow(theURL, winName, width, height, fstate, scrollbars){ 
	var features = "width=" + width ; 
	features += ",height=" + height ; 
	var state = ""; 
	var scrollbars = "yes";
	var res_w = ( $(window).width() - width ) / 2; 
	var res_h = ( $(window).height() - height ) / 2; 
	if ( window.screenLeft >= window.screen.width ) { 
		res_w = window.screen.width + res_w; 
	} 
	if (fstate == "") { // 옵션 
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars="+ scrollbars; 
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars="+ scrollbars; 
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 

function login(){
	var parameter = {"mode" : "login", "emp_id" : $("#emp_id").val(), "emp_pwd" : $("#emp_pwd").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			switch(str) {
				case "success" :
					location.href = "index.php?controller=pages&action=home";
				break;

				case "pwd" :
					alert("비밀번호가 일치하지 않습니다");
					return false;
				break;

				case "none" :
					alert("존재하지 않는 ID입니다.");
					return false;
				break;
			}
		}
	});
}
</script>
<!--<div class="login_foot" style="padding:10px;text-align:center;color:red"><input type="button" class="btn btn-info" value="체험신청" data-popup-open="popup-1" /></div>-->