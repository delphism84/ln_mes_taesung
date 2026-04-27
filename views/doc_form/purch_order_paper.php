<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>구매발주서</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/print.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="../js/jquery.js" ></script>
<script type="text/javascript">

function print_page() {

	$("#remark").attr('value', $("#remark").val());
	
	var printContents = document.getElementById("printWrap").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

</script>
</head>

<body>
  <!-- 인쇄/닫기 버튼영역--> 
  <div id="btnArea">
  	<div class="btnList">
    	<div class="btn">
          <span class="print" title="인쇄" id="id_print" onclick="javascript:print_page();"></span>
          <span class="close" title="닫기" id="id_close" onclick="javascript:self.close();"></span>
        </div>
    </div>
  </div><!-- //인쇄/닫기 버튼영역-->
  <div id="printWrap">
<form name="notiFrm">  
      <div id="printConts">
           <div id="purchTop">
       		 <h1 class="purchTit">구매발주서</h1>
             <div class="orNumArea">
             	<span class="titNum">구매 No.</span>
                <span class="orderNum">BP001-20160513004</span>
             </div>
             
             <div class="proOrTbl">
               <table cellspacing="0" cellpadding="0" class="docTbl501">
                  <colgroup>
                  	<col width="50"><col width="170"><col width="50"><col width="151"><col width="70"><col width="auto">
                  </colgroup>
                  <tbody>
                    <tr>
                      <th>수주처</th>
                      <td>매입처A</td>
                      <th>발주처</th>
                      <td></td>
                      <th>발주일</th>
                      <td>2016.05.13</td>
                    </tr>
                    <tr>
                      <th>주소</th>
                      <td>서울특별시 금천구 가산동 481-10 벽산/경인디지털밸리2 153-783</td>
                      <th>주소</th>
                      <td></td>
                      <th>입고일</th>
                      <td></td>
                    </tr>
                    <tr>
                      <th>연락처</th>
                      <td>070-1111-5555</td>
                      <th>연락처</th>
                      <td></td>
                      <th>담당자</th>
                      <td>김사업</td>
                    </tr>
                    <tr>
                      <th>Fax</th>
                      <td></td>
                      <th>Fax</th>
                      <td></td>
                      <th>연락처</th>
                      <td>070-2222-3333</td>
                    </tr>
                  </tbody>
                </table>
             </div><!--//proOrTbl-->
        </div><!--//purchTop-->
        <div class="proOrTbl">
        	<table  border="0" cellspacing="0" cellpadding="0" class="docTbl403">
              <colgroup>
              	<col width="35"><col width="110"><col width="100"><col width="50">
                <col width="50"><col width="80"><col width="90"><col width="auto">
              </colgroup>
              <tbody> 
                <tr>
                  <th>No.</th>
                  <th>품명</th>
                  <th>규격</th>
                  <th>단위</th>
                  <th>수량</th>
                  <th>단가</th>
                  <th>공급가액</th>
                  <th>비고</th>
                </tr>
                				<tr>
                  <th>1</th>
                  <td>B바</td>
                  <td></td>
                  <td>mm</td>
                  <td>100</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>				<tr>
                  <th>2</th>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>				<tr>
                  <th>3</th>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>				<tr>
                  <th>4</th>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>				<tr>
                  <th>5</th>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>                <tr>
                  <th style="line-height:20px;">특이사항<br>및<br>비고</th>
                  <td colspan="7" style="height:360px;"><textarea name="remark" id="remark" cols="" rows="22" style="border:0px;width:95%;overflow:hidden">특이사항 및 비고</textarea></td>
                </tr>
               </tbody> 
            </table>
        </div><!--//proOrTbl-->        
        <div id="purchFooter"><img src="../img_form/purch_logo.jpg" alt=""></div>
      </div><!--//printConts3-->
</form>      
   </div><!--//printWrap-->
</body>
</html>