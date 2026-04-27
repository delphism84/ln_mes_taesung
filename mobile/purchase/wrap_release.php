<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>바코드입고,키인입고</title>
    <link href="css01/bootstrap.min.css" rel="stylesheet">
    <!--슬라이드 박스 위치 css-->
    <link rel="stylesheet" type="text/css" href="css01/style.css">
    <!--css-->
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body style="overflow:hidden;">
                <!--로그아웃 박스-->
                <table class="box1"><tr><td>                        
                        <div>
                                 <button onclick="location.href='main.php'">
                                        <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
                                </button>
                        </div>
                        <div>
                                <input type="button" name="" value="로그아웃">
                                <b>정태준</b>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>                               
                        </div>
                </td></tr></table>                
                <table><tr><td>                        
                        <div class="wrap_box">                                
                                <div class="purch-box">
                                        <div class="purch_tit">
                                                <p>자재출고</p>
                                        </div>
                                        <div class="purch_btn">
                                                <button onclick="location.href='release.php'">바로가기</button>
                                        </div>
                                </div>                                
                                <div class="purch-box">
                                        <div class="purch_tit">
                                                <p>완제품출하</p>
                                        </div>
                                        <div class="purch_btn">
                                                <button onclick="location.href='shipment.php'">바로가기</button>
                                        </div>
                                </div>
                        </div>
                </td></tr></table>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js01/bootstrap.min.js"></script>
    <script type="text/javascript">
            $(function(){
                //시작
                //바코드 제이쿼리
                $('.barcode_show').click(function(){
                        $('.barcode').css('left','0')
                })
                $('.barcode_close>span').click(function(){
                        $('.barcode').css('left','-120%')
                })
                //키인 제이쿼리
                $('.keyin_show').click(function(){
                        $('.keyin').css('right','0')
                })
                $('.keyin_close>span').click(function(){
                        $('.keyin').css('right','-120%')
                })





                //끝
            })
    </script>
  </body>
</html>