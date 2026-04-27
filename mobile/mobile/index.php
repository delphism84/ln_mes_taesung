<!DOCTYPE html>
<html lang="ko">
  <head style="height: 100%;">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" /> 
    <title>로그인 페이지</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
    try{
        window.addEventListener('load', function(){
            setTimeout(scrollTo, 0, 0, 1);
        }, false);
    } catch(e){}
</script>
  </head>
  <body class="wrap_login" style="height: 100%;">
    <div class="wrap_box1" style="background: url(img/img_002.jpg)no-repeat center center; background-size: cover; overflow: hidden;">
      <!--내용-->
      <div class="login_logo">
        
      </div>
      <div class="login_content_box">
        <div class="login_tit">
          <p>LOGIN</p>
          <button>x</button>
        </div>
        <div class="login_content">
          <input type="text" name="" placeholder="USERNAME"><br>
          <input type="password" name="" placeholder="PASSWORD">
        </div>
        <div class="login_btn">
          <button onclick="location.href='main.php'">
            LOGIN
          </button>
        </div>
        
      </div>


      <!--내용-->
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>   
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">

      //모바일 키보드 나올시 div 안밀리게 하는 제이쿼리
      $(function(){
        $(".wrap_box1").css('height',window.innerHeight); 

        });
    </script>








  </body>
</html>