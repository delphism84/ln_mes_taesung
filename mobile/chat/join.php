<?
	include "db.php";
?>

<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <title>회원가입 페이지</title>   
    <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <style type="text/css">
    *{box-sizing: border-box;}
    html,body{height: 100%;}
      .wrap_Sign{width: 50%; height: 100%;  margin: 0 auto; padding-top: 10%;}
      .wrap_Sign h1{margin: 0; text-align: center;}
      .Sign{width: 50%; height: 90%;   margin: 0 auto; margin-top: 2%;}
      .sing_for{width: 100%}
      .sing_for input{width: 100%; height: 50px; font-size: 15px; padding-left: 1%;}
      .sign_sub{border: none; color: #777; outline: none; font-size: 15px;}
    </style>
	<!-- 스크립트 부분 -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>    
	<script src="js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script>
		//중복id확인
		function idCheck(){
			dataString = "mem_id=" + $("#mem_id").val();
			$.ajax({
				type : "post",
				data : dataString,
				url : "idCheck.php",
				success : function(str){
					if(str == "success"){
						$("#helper").html("<span styple=color:'blue'>가입 가능!</span>");
						$("#ch").val("ok");
					}else if(str == "fail"){
						$("#helper").html("<span style=color:'red'>중복 아이디 존재!</span>");
						$("#ch").val("notOk");
					}else{
						alert(str);
					}
				}
			});
		}

		function moveJoin(){
			//입력값 확인
			if($("#mem_id").val()==""){
				alert("아이디를 입력해주세요.^^");
				return false;
			}
			if($("#mem_pw").val()==""){
				alert("비밀번호를 입력해주세요.^^");
				return false;
			}
			if($("#confirmPw").val()==""){
				alert("비밀번호확인을 입력해주세요.^^");
				return false;
			}
			if($("#mem_name").val()==""){
				alert("이름을 입력해주세요.^^");
				return false;
			}

			//비밀번호 일치여부 확인
			if($("#mem_pw").val() != $("#confirmPw").val()){
				alert("비밀번호를 확인하세요.^^");
				return false;
			}
			
			//회원가입
			if($("#ch").val() == "ok"){
				insert();
			}
		}

		function insert(){
		
			var dataString = $("#frm").serialize();
			$.ajax({
				type : "post",
				data : dataString,
				url : "insert.php",
				success : function(str) {
					if(str == "success") {
						location.href = "login.php";
					} else {
						alert(str);
					}
				}
			});
		}

	</script>
  </head>
  <body>
   <div class="wrap_Sign">
     <h1>회원가입</h1>
     <div class="Sign">
	 <input type="text" name="ch" id="ch" />
      <form method="post" name="frm" id="frm" class="sing_for">
		<input type="text" name="mem_id" id="mem_id" placeholder="아이디" onkeyup="idCheck()" /><span id="helper"></span><br><br>
		<input type="password" name="mem_pw" id="mem_pw" placeholder="비밀번호" /><br><br>
		<input type="password" name="confirmPw" id="confirmPw" placeholder="비밀번호확인"/><br><br>
		<input type="text" name="mem_name" id="mem_name" placeholder="이름"><br><br>
      </form>
		<input type="button" value="회원가입" class="sign_sub" onclick="moveJoin()" />
     </div>
   </div>
  

    
    
  </body>
</html>