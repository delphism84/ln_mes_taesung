<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <title>로그인 페이지</title>   
    <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <style type="text/css">
    *{box-sizing: border-box;}
    html,body{height: 100%;}
      .wrap_box1{width: 100%; height: 100%;  margin: 0 auto; padding: 50px; }
      .box1_1>h1{margin: 0; text-align: center; color: #fff; font-size: 80px; padding-top: 5%;}
      .wrap_box1>.box1{width: 1000px; height: 600px;  margin: 0 auto; margin-top: 3%;}
      .box1_1{width: 100%; height: 30%;  background-color: #81DAF5;}
      .box1_2{width: 100%; height: 70%; border: 1px solid #ddd; position: relative;}
      .box1_2_1{width: 80%; height: 80%;  position: absolute; top: 50%; left: 50%; transform:translate(-50%,-50%)}
      .box1_2_2{width: 100%; height: 60%; }
      .box1_2_3{width: 70%; float: left;  height: 100%}
      .box1_2_4{width: 30%; float: left;  height: 100%}
      .box1_2_3>form input{width: 100%; height: 90px; border: 1px solid #ddd; font-size: 20px; padding-left: 3%;}
      .wrap_login{width: 100%;  height: 100%;}
      .uesrid{width: 70%; height: 100%; float: left; padding-right: 2%;}
      .login{width: 30%; height: 100%; float: left; }
      .uesrid input{width: 100%; height: 49%; font-size: 20px; padding-left: 5%; border: 1px solid #ddd; border-radius: 10px; }
      .login input{width: 100%; height: 100%; font-size: 50px; border: none; background-color: #58FA82; color: #fff; border-radius: 20px; outline: none;}
      .Sign button{float: right; margin-top: 1%; border: none;  outline: none;    margin-top: 5%; padding: 10px; font-size: 20px; color: #555; font-weight: bold; background-color: #fff; position: absolute; top: 60%; left: 50%; transform: translate(-50%,-50%); }
      
    </style>
	
	<!-- 스크립트 부분 -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script>
		function join(){
			location.href="join.php";
		}

		function loginOk() {
			
			// 입력값 확인
			if($("#mem_id").val() == "") {
				alert("아이디를 입력해주세요.");
				return false;
			}
			if($("#mem_pw").val() == "") {
				alert("비밀번호 입력해주세요.");
				return false;
			}
			// db 확인
			
			var dataStr = $("#frm").serialize();
			$.ajax({
				type : "post",
				data : dataStr,
				url : "loginOk.php",
				success : function(str) {
					if(str == "success") {
						location.href = "roomList.php";
					} else if(str == "notPw") {
						alert("비밀번호 불일치");
					} else if(str == "notUser") {
						alert("없는 사용자 입니다.");
					} else {
						alert(str);
					}
				} 
			});
			
		}

	</script>

  </head>
  <body>
   <div class="wrap_box1">
     
     <div class="box1">
       <div class="box1_1">
         <h1>Log in</h1>
       </div>
       <div class="box1_2">
         <div class="box1_2_1">
          <div class="box1_2_2" >
            <form method="post" name="frm" id="frm" class="wrap_login">
              <div class="uesrid">
                <input type="text" name="mem_id" id="mem_id" placeholder="아이디" /><br>
                <input type="password" name="mem_pw" id="mem_pw" placeholder="비밀번호" style="margin-top: 1%;" />
              </div>
              <div class="login">
                <input type="button" value="login" onclick="loginOk()"/>
              </div>
              <div class="Sign">
                <input type="button" value="회원가입" onclick="join()" />
              </div>
            </form>
          </div>
         </div>
       </div>
     </div>
   </div>
  

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>