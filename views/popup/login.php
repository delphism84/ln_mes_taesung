<?
session_start();
include "connection2.php";
include "include/doctype2.php";

$sql = "select * from erp_version order by uid desc limit 1";
$version = mysql_fetch_object(mysql_query($sql));
?>

<link rel="stylesheet" href="assets/css/login.css">
<script>
function login_check(){
	var f = document.login_form;
	if(f.mi_id.value==""){
		alert("아이디를 입력하세요");
		f.mi_id.focus();
		return false;
	}
	if(f.mi_pw.value==""){
		alert("비밀번호를 입력하세요");
		f.mi_pw.focus();
		return false;
	}

	var data_string = $("#login_form").serialize();

	$.ajax({
		type : "post",
		url : "_login.php",
		data : data_string,
		success : function(str) {
			switch(str){
				case "success" :
					alert("반갑습니다");
					//location.reload();
					location.href = "index.php";
				break;

				case "pwd" :
					alert("비밀번호가 일치하지 않습니다");
				break;

				case "stand" :
					alert("사용승인 대기중입니다");
				break;

				default :
					alert("등록되지 않은 사용자입니다");
				break;
			}
		}
	});
}

function close_popup(obj){
	$('[data-popup="' + obj + '"]').fadeOut(350);
}

function demo(){
	var data_string = "mode=demo";

	$.ajax({
		type : "post",
		url : "_login.php",
		data : data_string,
		success : function(str) {
			switch(str){
				case "success" :
					alert("반갑습니다");
					//location.reload();
					location.href = "demo/ebseo.php?gid=0";
				break;

				case "pwd" :
					alert("비밀번호가 일치하지 않습니다");
				break;

				case "stand" :
					alert("사용승인 대기중입니다");
				break;

				default :
					alert("등록되지 않은 사용자입니다");
				break;
			}
		}
	});
}

$(document).ready(function(){ 
	$('body').keypress(function(e){ 
		if(e.keyCode!=13) return; 
		if(!$('input[name="mi_id"]').val()) $('input[name="mi_id"]').focus(); 
		if(!$('input[name="mi_pw"]').val()) $('input[name="mi_pw"]').focus(); 

		login_check();
	}); 
});
</script>
<body>
	<div id="wrapr">
		<div id="login_bg" style="width:100%; text-align:center">
			<table align="center" width="100%">
				<tr>
					<td align="center">
						<br><br><br>
						<h1 style="color:#000">인퍼스 ERP SYSTEM</h1>
						<br><br><br>
						<h3>성공은 변화로부터 출발합니다.</h3>
						<h3> 제이이엔지와 함께 시작하십시오. </h3>
						<br>
						<div style="margin-top:20px; text-align:center"><b>Latest Version</b> <a href="#" onclick="centerOpenWindow('views/popup/versionList.php?target=inf', '버전리스트', 800, 500)" style="color:red">v.<?=$version->version?>.<?=$version->version_code?> [<?=$version->create_dt?>]</a></div>
						<!--<div>
							<input type="button" class="btn btn-danger btn-lg" value="무료데모체험하기" onclick="demo()" />
							<input type="button" class="btn btn-info btn-lg" value="사용신청하기" data-popup-open="popup-1" />
						</div>-->
					</td>
				</tr>
			</table>
		</div>
		
		<div class="inner">
			<div class="login_box">
				<div class="login_img">
					<img src="assets/images/simg.png" alt="#" title="#" />
				</div>
				
				<div class="login_set">
					<div class="login_set_line">
					
						<div class="login_title" style="margin-top:10px">
							<p><strong>JERP 체험을 원하시면 mail@jengineering.co.kr 또는 1833-8217로 문의주시기 바랍니다.</strong></p>
						</div>
						
						<div class="login_body" style="margin-top:-20px">
							 <form name="login_form" id="login_form">
								<div class="login_idpw">
									<ul>
										<li>
											<label for="id"><img src="assets/images/txt_id.gif" title="아이디" alt="아이디" /></label>&emsp;
											<input class="input_text3" type="text" size="20" maxlength="15" name="emp_id" id="emp_id">
										</li>
										<li>
											<label for="pass"><img src="assets/images/txt_pw.gif" title="비밀번호" alt="비밀번호" /></label>&emsp;
											<input class="input_text3" type="password" size="20" maxlength="15" name="emp_pwd" id="emp_pwd">
										</li>
									</ul>
								 </div>
								 <div class="login_check"><img src="assets/images/btn_login.gif" title="로그인" alt="로그인" onclick="login();" style="cursor:pointer" /></div>
							 </form>
						</div>
						
					</div>
				</div>
			</div>

			<div id="footer1">
				<p title="Copyright 2016 corebiz. All right reserved">Copyright 2017 Jengineering. All right reserved.</p>
			</div> <!--footer 종료 -->
	
		</div>
	
	</div>

	<!-------------------------------------------------------------------------------------------------->
			<!-- popup
			<!-------------------------------------------------------------------------------------------------->
			<style>
			/* Outer */
			.popup {
			    width:100%;
			    height:100%;
			    display:none;
			    position:fixed;
			    top:0px;
			    left:0px;
			    background:rgba(0,0,0,0.75);
			}
			 
			/* Inner */
			.popup-inner {
			    max-width:800px; /*팝업창의 크지 설정 */
			    width:90%;
			    padding:40px;
			    position:absolute;
			    top:50%;
			    left:50%;
			    -webkit-transform:translate(-50%, -50%);
			    transform:translate(-50%, -50%);
			    box-shadow:0px 2px 6px rgba(0,0,0,1);
			    border-radius:3px;
			    background:#fff;
			}
			 
			/* Close Button */
			.popup-close {
			    width:30px;
			    height:30px;
			    padding-top:4px;
			    display:inline-block;
			    position:absolute;
			    top:0px;
			    right:0px;
			    transition:ease 0.25s all;
			    -webkit-transform:translate(50%, -50%);
			    transform:translate(50%, -50%);
			    border-radius:1000px;
			    background:rgba(0,0,0,0.8);
			    font-family:Arial, Sans-Serif;
			    font-size:20px;
			    text-align:center;
			    line-height:100%;
			    color:#fff;
			}
			 
			.popup-close:hover {
			    -webkit-transform:translate(50%, -50%) rotate(180deg);
			    transform:translate(50%, -50%) rotate(180deg);
			    background:rgba(0,0,0,1);
			    text-decoration:none;
			}
			</style>
			
			<!-- 일정등록 팝업 -->
			<div class="popup" data-popup="popup-1">
			    <div class="popup-inner">
				 <iframe id="iframe1" width="99.6%" height="500" src="" frameborder="0" scrolling="auto"></iframe>
				<p><a data-popup-close="popup-1" href="#">Close</a></p>
				<a class="popup-close" data-popup-close="popup-1" href="#">x</a>
			    </div>
			</div>
			
			
			<script>
			function close_popup(obj){
				$('[data-popup="' + obj + '"]').fadeOut(350);
			}
			
			$(function() {
			// 아래 소스는 정상작동 함.. 단지 팝업창이 두개라 하나는 막음
			//
				
				//----- OPEN
				$('[data-popup-open]').on('click', function(e)  {
					$('#iframe1').attr("src","member_regist_pop.php");
					var targeted_popup_class = jQuery(this).attr('data-popup-open');	
					$('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

					e.preventDefault();
				});

				//----- CLOSE
				$('[data-popup-close]').on('click', function(e)  {
					var targeted_popup_class = jQuery(this).attr('data-popup-close');
					$('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

					e.preventDefault();
				});
			});
			</script>
			<!-------------------------------------------------------------------------------------------------->
			<!--// popup
			<!-------------------------------------------------------------------------------------------------->
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
	var dataString = "mode=login&emp_id=" + $("#emp_id").val() + "&emp_pwd=" + $("#emp_pwd").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/employee.php",
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