<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>바코드입고,키인입고</title>
    <link href="css01/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css01/style.css">
    <link rel="stylesheet" type="text/css" href="css01/comm.css">   
  </head>
<style>
	.common_left{width: 70%; height: 100%;  float: left; padding: 20px; overflow-y: scroll;}
	.common_right{width: 30%; height: 100%;  float: left; padding: 20px; overflow-y: scroll;}
</style>
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
                <!--출고출하관리, 입고관리 박스-->
                <table class="box2"><tr><td>
                        <!--출고출하관리, 입고관리 감싸는 div-->
                        <div class="wrap_box3">
                                <!--출고출하관리 box3은 공통 css-->
                                <div class="release box3">
                                        <div class="release_top">
                                                <p>BARCODE 출하</p>
                                        </div>
                                        <div class="release_content">
                                                <button class="barcode_show">바로가기</button>
                                        </div>
                                </div>
                                <!--입고관리 box3은 공통 css-->
                                <div class="warehousing box3">
                                        <div class="release_top">
                                                <p>KEYIN 출하</p>
                                        </div>
                                        <div class="release_content">
                                                <button class="keyin_show">바로가기</button>
                                        </div>
                                </div>
                        </div>
                </td></tr></table>
       
        <!--바코드입고 슬라이드-->
        <div class="barcode">
                <div class="common_top">
                     <div class="barcode_close">
                           <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>  
                     </div>
                      <p>BARCODE</p>    
                </div>
                <div class="common_content">
                        <div class="common_left">
				<div class="barcode_top">
					<input type="text" name="" autocomplete="off" placeholder="바코드를 입력하세요">
				</div>
                                <table>
                                        <thead>
                                                <tr>
                                                        <th>
                                                            <input type="checkbox" name="">    
                                                        </th>
                                                        <th>입고</th>
                                                        <th>품목명</th>
                                                        <th>발주수량</th>
                                                        <th>잔여입고수량</th>
                                                        <th>요청부서</th>
                                                        <th>요청인</th>
                                                        <th>상태</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                        <td>
                                                             <input type="checkbox" name="">   
                                                        </td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        
                                                </tr>
                                                <tr>
                                                        <td>
                                                             <input type="checkbox" name="">   
                                                        </td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>

                                                </tr>
                                                <tr>
                                                        <td>
                                                             <input type="checkbox" name="">   
                                                        </td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>

                                                </tr>
                                        </tbody>
                                </table>
                        </div>
                        <div class="common_right">
                                <span class="item_information">
                                        품목정보
                                </span>
                                <table>
                                        <tbody>
                                                <tr>
                                                        <th>발주처</th>
                                                        <td></td>
                                                </tr>
                                                <tr>
                                                        <th>발주코드</th>
                                                        <td></td>
                                                </tr>
                                                <tr>
                                                        <th>품목코드</th>
                                                        <td></td>
                                                </tr>
                                                <tr>
                                                        <th>품명</th>
                                                        <td></td>
                                                </tr>
                                                <tr>
                                                        <th>규격</th>
                                                        <td></td>
                                                </tr>
                                                <tr>
                                                        <th>단위</th>
                                                        <td></td>
                                                </tr>
                                                <tr>
                                                        <th>발주수량</th>
                                                        <td></td>
                                                </tr>
                                        </tbody>
                                </table>
                                 <span class="receiving_inspection">
                                        수입검사
                                </span>
                                <table>
                                        <tbody>
                                                <tr>
                                                        <th>검사항목</th>
                                                        <td>불량수량</td>
                                                </tr>
                                                <tr>
                                                        <th>외간검사</th>
                                                        <td>
                                                                <input type="text" name="" autocomplete="off">
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th>중량검사</th>
                                                        <td>
                                                                <input type="text" name="" autocomplete="off">
                                                        </td>
                                                </tr>                                           
                                        </tbody>
                                </table>
                                 <span class="item_warehousing">
                                        품목입고
                                </span>
                                <table>
                                        <tbody>
                                                <tr>
                                                        <th>입고위치</th>
                                                        <td>
                                                                <select>
                                                                        <option>선택</option>
                                                                </select>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th>LOT NO</th>
                                                        <td>
                                                              <input type="text" name="" autocomplete="off">  
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th>입고수량</th>
                                                        <td>
                                                                <input type="text" name="" autocomplete="off">
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th>추가입고수량</th>
                                                        <td>
                                                                <input type="text" name="" autocomplete="off" value="0">
                                                        </td>
                                                </tr>                                           
                                        </tbody>
                                </table>
                                <button>품목입고</button>
                        </div>
                </div>

        </div>








        <!--키인입고 슬라이드-->
         <div class="keyin">
                <div class="common_top">
                     <div class="keyin_close">
                           <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>  
                     </div>
                      <p>KEYIN</p>    
                </div>
                <div class="common_content">
                        <div class="common_left">
                                <table>
                                        <thead>
                                                <tr>
                                                        <th>
                                                            <input type="checkbox" name="">    
                                                        </th>
                                                        <th>입고</th>
                                                        <th>품목명</th>
                                                        <th>발주수량</th>
                                                        <th>잔여입고수량</th>
                                                        <th>요청부서</th>
                                                        <th>요청인</th>
                                                        <th>상태</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                        <td>
                                                             <input type="checkbox" name="">   
                                                        </td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        
                                                </tr>
                                                <tr>
                                                        <td>
                                                             <input type="checkbox" name="">   
                                                        </td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>

                                                </tr>
                                                <tr>
                                                        <td>
                                                             <input type="checkbox" name="">   
                                                        </td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>
                                                        <td>입고</td>

                                                </tr>
                                        </tbody>
                                </table>
                        </div>
                        <div class="common_right">
                                <span class="item_information">
                                        품목정보
                                </span>
                                <table>
                                        <tbody>
                                                <tr>
                                                        <th>발주처</th>
                                                        <td></td>
                                                </tr>
                                                <tr>
                                                        <th>발주코드</th>
                                                        <td></td>
                                                </tr>
                                                <tr>
                                                        <th>품목코드</th>
                                                        <td></td>
                                                </tr>
                                                <tr>
                                                        <th>품명</th>
                                                        <td></td>
                                                </tr>
                                                <tr>
                                                        <th>규격</th>
                                                        <td></td>
                                                </tr>
                                                <tr>
                                                        <th>단위</th>
                                                        <td></td>
                                                </tr>
                                                <tr>
                                                        <th>발주수량</th>
                                                        <td></td>
                                                </tr>
                                        </tbody>
                                </table>
                                 <span class="receiving_inspection">
                                        수입검사
                                </span>
                                <table>
                                        <tbody>
                                                <tr>
                                                        <th>검사항목</th>
                                                        <td>불량수량</td>
                                                </tr>
                                                <tr>
                                                        <th>외간검사</th>
                                                        <td>
                                                                <input type="text" name="" autocomplete="off">
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th>중량검사</th>
                                                        <td>
                                                                <input type="text" name="" autocomplete="off">
                                                        </td>
                                                </tr>                                           
                                        </tbody>
                                </table>
                                 <span class="item_warehousing">
                                        품목입고
                                </span>
                                <table>
                                        <tbody>
                                                <tr>
                                                        <th>입고위치</th>
                                                        <td>
                                                                <select>
                                                                        <option>선택</option>
                                                                </select>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th>LOT NO</th>
                                                        <td>
                                                              <input type="text" name="" autocomplete="off">  
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th>입고수량</th>
                                                        <td>
                                                                <input type="text" name="" autocomplete="off">
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th>추가입고수량</th>
                                                        <td>
                                                                <input type="text" name="" autocomplete="off" value="0">
                                                        </td>
                                                </tr>                                           
                                        </tbody>
                                </table>
                                <button>품목입고</button>
                        </div>
                </div>

        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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