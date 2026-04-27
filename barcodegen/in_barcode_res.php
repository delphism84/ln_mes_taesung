<?
include_once("../common.php"); // 기본 파일
include_once("../inc/dbconfig.php"); 
include_once("../inc/func.php");  // 함수 파일
//header("Content-type: text/html; charset=UTF-8"); 
if (!$is_member){
goto_url("/login.php");
exit;
}
?>
<?
	if ($p_id !="" && $mode=="updt"){
		$SQL  = " SELECT * FROM product WHERE product_id='" . $p_id . "' limit 0, 1";
		//echo $SQL;
		$result = mysql_query($SQL);
		if($result){	
		$row = mysql_fetch_array( $result);
		//$grpcd			=$row["grpcd"];
		$product_id			=$row["product_id"];
		$user_group_sn		=$row["user_group_sn"];
		$itemcd				=$row["itemcd"];
		$grpcd				=$row["grpcd"];
		$prod_comp			=$row["prod_comp"];
		$prod_type			=$row["prod_type"];
		$itemnm				=$row["itemnm"];
		$unit				=$row["unit"];
		$standard			=$row["standard"];
		$in_unitprice		=$row["in_unitprice"];
		$factory_price		=$row["factory_price"]; 
		$cus_price			=$row["cus_price"];
		$out_unitprice		=$row["out_unitprice"];
		$stock_amount		=$row["stock_amount"];
		$cust_type			=$row["cust_type"];
		$custom_name		=$row["custom_name"];
		$custom_code		=$row["custom_code"];		
		$image_filename		=$row["image_filename"];
		$imageUpload		=$row["imageUpload"];
		$regdate			=$row["regdate"];
		$moddate			=$row["moddate"];
		$barcode            =$row["barcode"];
		}
		switch ($grpcd){
			case "01":
				$grpcd_text="원재료";
				break;
			case "02":
				$grpcd_text="부재료";
				break;
			case "03":
				$grpcd_text="제품";
				break;
			case "04":
				$grpcd_text="반제품";
				break;
			case "05":
				$grpcd_text="상품";
				break;
			case "06":
				$grpcd_text="부산품";
				break;
			default:
				$grpcd_text="원재료";
			break;
		}
		switch ($prod_type){
			case "01":
				$prod_type_text="제품";
				break;
			case "02":
				$prod_type_text="재공품";
				break;
			case "03":
				$prod_type_text="기구";
				break;
			case "04":
				$prod_type_text="PCB";
				break;
			case "05":
				$prod_type_text="직접회로";
				break;
			case "06":
				$prod_type_text="발전기";
				break;
			case "07":
				$prod_type_text="커넥터";
				break;
			case "08":
				$prod_type_text="저항기";
				break;
			case "09":
				$prod_type_text="캐패시터";
				break;
			case "10":
				$prod_type_text="전자부품 기타";
				break;
			case "11":
				$prod_type_text="사내가공";
				break;
			case "12":
				$prod_type_text="외주가공";
				break;
			case "13":
				$prod_type_text="기타";
				break;
			default:
				$prod_type_text="기구";
				break;
		}
	}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>품목관리 등록 : 기초자료 : 품목등록</title>
<link href="/weberp/css/reset.css" rel="stylesheet" type="text/css" media="all">
<link href="/weberp/css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="/weberp/css/fancybox/jquery.fancybox.css?v=2.1.5" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="/weberp/js/jquery.js" ></script>
<script type="text/javascript" src="/weberp/js/common.js" ></script>
<script type="text/javascript" src="/weberp/js/jquery/common.js" ></script>
<script type="text/javascript" src="/weberp/js/jquery.modal.js"></script>
<script type="text/javascript" src="/weberp/js/jquery.topmenu.js"></script>
<script type="text/javascript" src="/weberp/js/popup.js"></script>
<script type="text/javascript" src="/weberp/js/placeholder.js"></script>
<script type="text/javascript" src="/weberp/js/jquery.form.min.js" ></script>
<script type="text/javascript" src="/weberp/js/myfunction.js" ></script>
<script type="text/javascript" src="/weberp/js/fancybox/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript" src="/weberp/js/fancybox/fancybox_custom.js"></script>
<!-- <script src="/weberp/jquery.form.js"></script> -->
</head>

<body>
<div id="wrapper">
	
	<!-- header + gnb  -->
	<div id="headWrap">
	<?//include_once("../inc/header.php");?>
	<div class="gnbWrap">
    <div id="gnb_hr">
        <? //include_once("../top/menu.php");  // 함수 파일?>
    </div><!--gnb//-->
	<!-- <div class="iconGroup">
		<span><a href="/weberp/intranet/board.php" title="New 게시판"><img src="/weberp/img/ic_board.png" alt="New 게시판 "></a></span>
		<span><a href="/weberp/intranet/data.php" title="New 자료"><img src="/weberp/img/ic_data.png" alt="New 자료"></a></span>
		<span><a href="/weberp/intranet/intra_mail.php" title="New 편지"><img src="/weberp/img/ic_mail.png" alt="New 편지"></a></span>
    </div> -->
</div>
<script type="text/javascript"> 
    $(document).ready(function(){       
        $('#gnb_hr').topmenu({ d1: 2, d2: 3 });
    });
</script>	<!--gnbWrap//-->

<!--headWrap//-->
<!-- header + gnb  -->

<script>
function create_product_code(select){
	if (select.value != "") {
		var val = "";
		for (var i=0; i<select.children.length; i++) if (select.children[i].value == select.value) {
			val = select.children[i].id
			break;
		}
		if (val == "") return;
		
		var data_string = "middle=" + val;
		$.ajax({
			type : "post",
			url : "../base/base02/create_product_code.php",
			data : data_string,
			success : function(str){
				if(str == "duplicate") {
					alert("중복된 코드가 발생하였습니다");
				} else {
					//alert(str);
					$("#itemcd").val(str);
				}
			}
		});
	}
}
</script>

   <div id="conWrap">
     <div id="contents" class="">
        <div  id="">
            <!--조회,등록-->
            <!-- <div class="btnSR_area2">
                 <span class="button201">등록</span>
           </div> --><!--//btnSR_area-->
           
           <!--품목관리 등록 리스트--> 
           <div class="tblArea">
                <form name="registfrm" id="registfrm" method="psot" enctype="multipart/form-data">
                <input type="hidden" name="imode" id="imode" value="" />
                <input type="hidden" name="type" id="type" value="B" />
                <input type="hidden" name="gubun" id="gubun" value="item" />
                <input type="hidden" name="mode" id="mode" value="ins" />
                <input type="hidden" name="check_flag" id="check_flag" value="" />
				<input type="hidden" name="check_flag1" id="check_flag1" value="" />
                <input type="hidden" name="compare_unit" id="compare_unit" value="" />
                <input type="hidden" name="srch_page" id="srch_page" value="" />
				<input type="hidden" name="p_id" id="p_id" value="" />
				<input type="hidden" name="image_filename" id="image_filename" value="" />
				<input type="hidden" name="pjt_cd" id="pjt_cd" value="" />
				<input type="hidden" name="barcode" id="barcode" value="" />
				
				
                <!-- <input type="file" name="imageUpload" id="imageUpload" style="display: none;"/> -->
                <div class="baseRegistArea">
                    <table  border="0" cellspacing="0" cellpadding="0" class="popTbl">
                      <colgroup>
                        <col width="100"><col width="auto">
                      </colgroup>
                      <tbody>
                       <tr>
                          <th><label for="grpcd"><span>√</span> 품목구분</label></th>
                          <td>
								<div class="selectBox">
								  <!--<select class="select" name="grpcd" id="grpcd" title="품목구분">
								    <option value="" selected>--선택--</option>
									<option value="01" <?if($grpcd=="01"){?>selected<?}?>>원재료</option>
									<option value="02" <?if($grpcd=="02"){?>selected<?}?>>부재료</option>
									<option value="03" <?if($grpcd=="03"){?>selected<?}?>>제품</option>
									<option value="04" <?if($grpcd=="04"){?>selected<?}?>>반제품</option>
									<option value="05" <?if($grpcd=="05"){?>selected<?}?>>상품</option>
									<option value="06" <?if($grpcd=="06"){?>selected<?}?>>부산품</option>
									<option value="07" <?if($grpcd=="07"){?>selected<?}?>>저장품</option>
                                  </select> &nbsp;품목의 속성이며 정확하게 분류해야 합니다.-->
								  <select class="select" name="grpcd" id="grpcd" title="품목구분">
								    <option value="">--선택--</option>
									<option value="원재료"<?=$grpcd == "원재료" ? " selected" : ""?>>원재료</option>
									<option value="부재료"<?=$grpcd == "부재료" ? " selected" : ""?>>부재료</option>
									<option value="제품"<?=$grpcd == "제품" ? " selected" : ""?>>제품</option>
									<option value="반제품"<?=$grpcd == "반제품" ? " selected" : ""?>>반제품</option>
									<option value="상품"<?=$grpcd == "상품" ? " selected" : ""?>>상품</option>
									<option value="부산품"<?=$grpcd == "부산품" ? " selected" : ""?>>부산품</option>
									<option value="저장품"<?=$grpcd == "저장품" ? " selected" : ""?>>저장품</option>
                                  </select> 품목의 속성이며 정확하게 분류해야 합니다. 
                              </div>
						  </td>
                       </tr>
					   <tr>
                          <th><label for="prod_type">품목분류</label></th>
                          <td>
							   <div class="selectBox">
								  <!--select class="select" name="prod_type" id="prod_type" title="품목분류" onchange="create_product_code(this.value)">
								    <option value="" selected>--선택--</option>
									<option value="01" <?if($prod_type=="01"){?>selected<?}?>>제품</option>
									<option value="02" <?if($prod_type=="02"){?>selected<?}?>>재공품</option>
									<option value="03" <?if($prod_type=="03"){?>selected<?}?>>기구</option>
									<option value="04" <?if($prod_type=="04"){?>selected<?}?>>PCB</option>
									<option value="05" <?if($prod_type=="05"){?>selected<?}?>>직접회로</option>
									<option value="06" <?if($prod_type=="06"){?>selected<?}?>>발전기</option>
									<option value="07" <?if($prod_type=="07"){?>selected<?}?>>커넥터</option>
									<option value="08" <?if($prod_type=="08"){?>selected<?}?>>저항기</option>
									<option value="09" <?if($prod_type=="09"){?>selected<?}?>>캐패시터</option>
									<option value="10" <?if($prod_type=="10"){?>selected<?}?>>전자부품 기타</option>
									<option value="11" <?if($prod_type=="11"){?>selected<?}?>>기타</option>
                                  </select-->
								  <select class="select" name="prod_type" id="prod_type" title="품목분류" onchange="create_product_code(this)">
								    <option id="" value="">--선택--</option>
									<option id="01" value="제품"<?=$prod_type == "제품" ? " selected" : ""?>>제품</option>
									<option id="02" value="재공품"<?=$prod_type == "재공품" ? " selected" : ""?>>재공품</option>
									<option id="03" value="기구"<?=$prod_type == "기구" ? " selected" : ""?>>기구</option>
									<option id="04" value="PCB"<?=$prod_type == "PCB" ? " selected" : ""?>>PCB</option>
									<option id="05" value="직접회로"<?=$prod_type == "직접회로" ? " selected" : ""?>>직접회로</option>
									<option id="06" value="발전기"<?=$prod_type == "발전기" ? " selected" : ""?>>발전기</option>
									<option id="07" value="커넥터"<?=$prod_type == "커넥터" ? " selected" : ""?>>커넥터</option>
									<option id="08" value="저항기"<?=$prod_type == "저항기" ? " selected" : ""?>>저항기</option>
									<option id="09" value="캐패시터"<?=$prod_type == "캐패시터" ? " selected" : ""?>>캐패시터</option>
									<option id="10" value="전자부품 기타"<?=$prod_type == "전자부품 기타" ? " selected" : ""?>>전자부품 기타</option>
									<option id="11" value="사내가공"<?=$prod_type == "사내가공" ? " selected" : ""?>>사내가공</option>
									<option id="12" value="외주가공"<?=$prod_type == "외주가공" ? " selected" : ""?>>외주가공</option>
									<option id="13" value="기타"<?=$prod_type == "기타" ? " selected" : ""?>>기타</option>
                                  </select>
                              </div>
						  </td>
                       </tr>
                       <tr>
                        <th><label for="itemcd">품목코드</label></th>
                        <td><input name="itemcd" id="itemcd" type="text" value="<?=$itemcd?>"  class="inpt1 w130" />
						<span class="button102"><a href="javascript:existitemcd();" title="중복확인">중복확인</a></span>&nbsp;품목분류를 선택하면 코드가 자동생성 됩니다.</td>
                       </tr>
                       <tr>
                        <th><label for="itemnm">품목명</label></th>
                        <td>
                           <input name="itemnm" id="itemnm" type="text" class="inpt1 w500" value="<?=$itemnm?>" placeholder="직접입력">
						   <span class="button102"><a href="javascript:existitemnm();" title="중복확인">중복확인</a></span>
                        </td>
                      </tr>
					  <tr>
                        <th><label for="prod_comp">제조사</label></th>
                        <td>
                           <input name="prod_comp" id="prod_comp" type="text" class="inpt1 w500" value="<?=$prod_comp?>" placeholder="직접입력">
                      </td>
                      </tr>
					<!--  <tr>
						<th scope="row"><label for="pjt_name">프로젝트</label></th>
						<td>
							<input name="pjt_name" id="pjt_name" type="text" class="inpt1 w200" value="<?=$pjt_name?>" ondblclick="searchPJ();"><img src="/img/btn_search.jpg" alt="btn_search" ondblclick="searchPJ();">
						</td>
					</tr>-->
                      <tr>
                        <th><label for="unit">생산단위</label></th>
                        <td><input name="unit" id="unit" type="text" class="inpt1  w130" value="<?=$unit?>" placeholder="생산단위">&nbsp;ex) ea, 식, mm, box, 롤, kg
                            <!-- <div class="selectBox">
                                <select class="select" name="unit" id="unit" title="품목코드">
                                </select>
                            </div> -->
                        </td>
                      </tr>
                     <tr>
                        <th><label for="sd">규격</label></th>
                        <td><input name="standard" id="standard" type="text" class="inpt1 w500" value="<?=$standard?>" placeholder="규격">&nbsp;각 규격 항목을 ','쉼표 로 구분(인쇄화면에서 줄바꿈으로 표시됨) ex) EVD-15T, 50X72X8T, 30HP용, 온도조절밸브키트
						<!-- <textarea  name="standard" id="standard" style="width: 650px; height: 100px;  BORDER-RIGHT: #dddddd 1px solid; BORDER-LEFT: #b5b5b5 1px solid; BORDER-TOP: #b5b5b5 1px solid; BORDER-BOTTOM: #dddddd 1px solid; overflow: hidden" multiple><?=nl2br($standard)?></textarea> -->
						
						</td>
                      </tr>
					   
					  <tr>
                        <th><label for="sd">바코드</label></th>
                        <td><input name="barcode" id="barcode" type="text" class="inpt1 w130" value="<?=$barcode?>" placeholder="바코드"></td>
                      </tr>
					  <!--
					  <tr>
                        <th><label for="unit">입고단가</label></th>
                        <td><input name="in_unitprice" id="in_unitprice" type="text" class="inpt1 w130" value="<?=$in_unitprice?>" placeholder="입고단가" onkeyup="inputNumberFormat(this)">&nbsp;ex) 숫자만 입력하세요
                        </td>
                      </tr>
					  <tr>
                        <th><label for="unit">공장도가격</label></th>
                        <td><input name="factory_price" id="factory_price" type="text" class="inpt1 w130" value="<?=$factory_price?>" placeholder="공장도가격" onkeyup="inputNumberFormat(this)">&nbsp;ex) 숫자만 입력하세요
                        </td>
                      </tr>
					  <tr>
                        <th><label for="unit">소비자가격</label></th>
                        <td><input name="cus_price" id="cus_price" type="text" class="inpt1 w130" value="<?=$cus_price?>" placeholder="소비자가격" onkeyup="inputNumberFormat(this)">&nbsp;ex) 숫자만 입력하세요
                        </td>
                      </tr>
					  <tr>
                        <th><label for="unit">출고단가</label></th>
                        <td><input name="out_unitprice" id="out_unitprice" type="text" class="inpt1 w130" value="<?=$out_unitprice?>" placeholder="출고단가" onkeyup="inputNumberFormat(this)">&nbsp;ex) 숫자만 입력하세요
                        </td>
                      </tr>	 -->
					  <tr>
                        <th><label for="unit">총재고수량</label></th>
                        <td>
							<!-- <div class="selectBox">
								<span> 
									  <select class="" id="select_Srch3" name="cust_type">
										<option value="AD" >샘플</option> 
										<option value="AG" >대리점</option> 
										<option value="KH" selected>본사</option> 
										<option value="KS" >특판점</option> 
									 </select>
								</span>
							</div> --><!-- search_customer(); -->
						<input name="stock_amount" id="stock_amount" type="text" class="inpt1 w130" value="<?=$stock_amount?>" placeholder="재고수량">
                        </td>
                      </tr>
					  <tr>
						<th><label for="unit">재고자산<br>(입고기준)</label></th>
						<td>
							<input name="sum_price" id="sum_price" type="text" class="inpt1 w130" value="<?=$sum_price?>" placeholder="재고자산(단위:원)">&nbsp;ex) 입력한 재고수량을 기준으로 입고금액 총액을 입력하세요.
						</td>
					  </tr>
					  <!-- <tr>
                        <th><label for="unit">거래처</label></th>
                        <td><input name="customer" id="customer" type="text" class="inpt1 w130" value="" placeholder="거래처">
							<span class="button102"><a href="javascript:searchcustomer();" title="검색">검색</a></span>
                        </td>
                      </tr> -->
					  <!-- <tr>
					  <th><label for="customer">거래처선택</label></th>
						<td>

							<input id="srch_custom_name" name="srch_custom_name" type="text" class="inpt1 w100" value="<?=$srch_custom_name?>" placeholder="거래처명 입력" />
							<span class="button102" id="srch_custom_btn"><a href="javascript:search_customer();" title="조회">조회</a></span>
						</td>
						</tr> -->
						<tr>
                      	<th><label for="customer">거래처</label></th>
                        <td>
                        	<input id="custom_name" name="custom_name" type="text" class="inpt1 w150" placeholder="거래처명" readonly="readonly" value="<?=$custom_name?>" ondblclick="searchSales();"><img src="/img/btn_search.jpg" alt="btn_search" ondblclick="searchSales();" style="color:808080">
                            <input id="custom_code" name="custom_code" type="text" class="inpt1 w100" placeholder="거래처코드" readonly="readonly" value="<?=$custom_code?>" style="color:808080"/>
                        </td>
                        
                      </tr>
                      <tr>
                        <th><label for="pro_pic">제품사진</label></th>
                        <td>
                            <!---사진목록//-->
                            <ul class="tdPic2 tdPic2_custom" id="tdPic2"></ul><!---//사진목록-->
                             <div class="plusPic">
                                <input type="file" name="imageUpload" id="imageUpload" onchange="file_upload_check();"/>
                                <span class="button6" id="idAddFileUpload" style="cursor: pointer"><img src="/weberp/img/ic_pic.png" alt="사진추가" />사진추가</span>
                                &nbsp;&nbsp;(사진 파일은 .gif .jpg, .bmp, .png 만 가능합니다.<br>찾아보기를 클릭 후 해당 제품 이미지를 선택하고 사진 추가 버튼을 클릭하세요.)	
                            </div>
                        </td>
                      </tr>
                      <!--<tr>
                        <th><label for="price">평균생산단가</label></th>
                        <td><input name="price" id="price" type="text" class="inpt1 w130">&nbsp;원</td>
                      </tr>-->
                      <tr>
                        <th><label for="regdate">등록일</label></th>
                        <td><input name="regdate" id="regdate" type="text" class="inpt1 w130" value="<?echo ($mode=="updt")? $regdate : date('Ymd')?>" readonly="readonly"></td>
                      </tr>
                      </tbody>
                    </table>
                </div><!--//baseRegistArea-->
                <div class="btnArea2">
                  <span class="button2"><a href="javascript:regist();" title="등록">등록</a></span>
				  <span class="button3"><a onclick="close_popup();" title="취소" >취소</a></span>
                </div>
                 </form>
          </div><!---//tblArea -->
        </div><!---//rightSection-->
     </div><!---//contents -->
   </div><!---//conWrap -->
 </div><!---//wrapper -->
  
 <!--코드생성 확인 팝업-->
 <div id="layer2" class="popLayer2">
	<div class="popContainer">		
        <div class="popConts  br_none">
			<p class="ctxt">코드가 생성되었습니다.</p>
		</div>
        <div class="btnArea2">
                <!--<span class="button3"><a href="#" title="취소" class="cbtn">취소</a></span>-->
                <span class="button2"><a href="#" title="확인" class="cbtn">확인</a></span>
        </div>
     </div>
  </div><!--//layer2:코드생성 확인 팝업-->
  <!-- 품목명 중복 확인 팝업1-->
  <div id="layer201" class="popLayer2">
	<div class="popContainer">
        <div class="popConts  br_none">
			<p class="ctxt">사용 가능합니다.</p>
		</div>
        <div class="btnArea2">
                <!--<span class="button3"><a href="#" title="취소" class="cbtn">취소</a></span>-->
                <span class="button2"><a href="#" title="확인" class="cbtn">확인</a></span>
        </div>
 	</div>
  </div><!--//layer201:품목명 중복 확인 팝업1-->
  <!--품목명 중복 확인 팝업2-->
  <div id="layer202" class="popLayer2">
	<div class="popContainer">		
        <div class="popConts  br_none">
			<p class="ctxt">동일한 품목명이 존재합니다.</p>
		</div>
        <div class="btnArea2">
                <!--<span class="button3"><a href="#" title="취소" class="cbtn">취소</a></span>-->
                <span class="button2"><a href="#" title="확인" class="cbtn">확인</a></span>
        </div>
	</div>
  </div><!--//layer202:품목명 중복 확인 팝업2-->
  
  <div id="layer203" class="popLayer2">
    <div class="popContainer">      
        <div class="popConts  br_none">
            <p class="ctxt">동일한 품목명에 <br/>해당 규격이 존재합니다.</p>
        </div>
        <div class="btnArea2">
                <!--<span class="button3"><a href="#" title="취소" class="cbtn">취소</a></span>-->
                <span class="button2"><a href="#" title="확인" class="cbtn">확인</a></span>
        </div>
    </div>
  </div><!--//layer202:품목명 중복 확인 팝업2-->
<!--거래처 조회 팝업 : iframe-->
  <div id="customerListLayer" class="popLayer203">
	<div class="innerPopContainer">		
        <h2>거래처 조회</h2>
        <div class="innerPopConts">
				<iframe src="" id="custListIframe" name="custListIframe" frameborder="0" width="100%" height="200px" scrolling="auto" title="거래처 조회"></iframe>			
				</div>
        <span class="closePop"><a href="#"  title="닫기" class="cbtn"><img src="/weberp/img/pop_close.gif" alt="닫기"></a></span>
	</div>
  </div><!--//layer1:거래처 조회 팝업-->

<!--itemList: 거래처조회 검색팝업-->  
 <div id="salesList_layer" class="popLayer105">
	<div class="popContainer">		
        <h3>거래처조회</h3>
        <div class="popConts br_none">
           <iframe  src="" id="salesList_frame" name="salesList" frameborder="0" width="100%" height="500px" scrolling="no" title="거래처조회 검색"></iframe>
		</div><!---//popConts-->
		<span class="closePop rollover"><a href="#"  title="닫기" class="cbtn" onclick="close_popup()"><img src="/weberp/img/pop_close.gif" alt="닫기"></a></span>
 	</div><!---//popContainer-->
  </div><!--//itemList: 거래처조회 검색팝업-->  

<!--itemList: 프로젝트조회 검색팝업-->  
<div id="projectList_layer" class="popLayer106">
	<div class="popContainer">		
		<h3>프로젝트검색</h3>
		<div class="popConts br_none">
		   <iframe  src="" id="projectList_frame" name="projectList" frameborder="0" width="100%" height="500px" scrolling="yes" title="프로젝트조회 검색"></iframe>
		</div><!---//popConts-->
		<span class="closePop rollover"><a href="#"  title="닫기" class="cbtn" onclick="close_popup()"><img src="/weberp/img/pop_close.gif" alt="닫기"></a></span>
	</div><!---//popContainer-->
</div><!--//itemList: 프로젝트조회 검색팝업--> 

<iframe src="" width="0" height="0" frameborder="0" name="process"></iframe>


<script type="text/javascript">
$(document).ready(function(){
    <?if ($itemcd !="" && $mode=="updt"){?>
	//f = document.registfrm.mode;
	$("#mode").val('updt');
	$("#p_id").val('<?=$p_id?>');
	<?}else{?>
	$("#mode").val('ins');
    <?}?>

});
function setPjtInfo(code, name)
{
	$("#pjt_cd").val(code);
	$("#pjt_name").val(name);
}
function close_popup()
{
	$.modal.close();
}
/*
	프로젝트 찾기
*/
function searchPJ()
{
	$("#projectList_layer").modal({
		show: true,
		clickClose: false,
		closeText: '',
		showClose: false    
	});
	var url = "/weberp/base/project_list.php";
	$("#projectList_frame").attr("src", url);
}
function listCode(el, type, mode) {
	
	var param = "mode=list&type="+type;
	$.ajax({
        type: 'post'
        , url: '../base/base07/ajax_base07.php'
        , data: param
        , datatype: 'json'
        , success: function(data) {
			$(el).empty();
			$(el).append('<option value="">--선택--</option>');
			$(data).each(function() {
				code = $(this).attr('code');
				codenm = $(this).attr('codenm');
				option_selected = '';
				if((mode=="updt") && (type=='G')) {
					if(code == $("#compare_unit").val()) {
						option_selected = "selected='selected'";
					}
				}
				$(el).append("<option value='"+code+"' "+option_selected+">"+codenm+"</option>");
			});
			$(el).trigger('change');
        }
        , error: function(data, status, err) {
        	alert("품목코드 조회 에러!");
        }
        , complete: function() {}
    });
}
/***
 *코드 생성 
 */

function randNum(){
 var ALPHA = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9'];
 var rN='';
 for(var i=0; i<1; i++){
  var randTnum = Math.floor(Math.random()*ALPHA.length);
  rN += ALPHA[randTnum];
 }
 return rN;
}
function uniqueCode(selectGrpcd) {
	if(selectGrpcd!="")
	{	var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		var param = "mode=uniqueid&grpcd="+selectGrpcd;
		$.ajax({
	        type: 'post'
	        , url: '../base/base02/ajax_base02.php'
	        , data: param
	        , datatype: 'json'
	        , success: function(data) {
				//var PREFIX = $("select[name=grpcd]").val();
				var PREFIX = randNum();
				if(data.unique.length>10){
					alert('코드를 더이상 생성할수 없습니다.\n품목코드를 추가해서 생성하십시요.');return;
				}
				//unique = PREFIX+selectGrpcd+'000'+data.unique;
				unique = PREFIX+'00'+data.unique;

				$("#itemcd").val(unique);
				layer_open('layer2');
	        }
	        , error: function(data, status, err) {
	        	alert("품목코드 조회 에러!");
	        }
	        , complete: function() {}
	    });
	} else {
		$("#itemcd").val("");
	}
}

/****
 * 품목명 중복확인 함수 
 */
function existitemnm() {
	
	if($.trim($('#itemnm').val())=="") {
		alert("품목명을 입력하지 않았습니다");
		$.trim($('#itemnm').focus());
        return;
	}
	
	var param = "mode=existitemnm&itemnm="+$('#itemnm').val();
	
	var standard = $.trim($("#standard").val());
	if(standard!='') {
	    param += "&standard="+standard;
	}
	
    $.ajax({
        type: 'post'
        , url: '../base/base02/ajax_base02.php'
        , data: param
        , datatype: 'json'
        , success: function(data) {
        	if(data.cnt > 0) {
        	    if(standard!='') {
        	        layer_open('layer203');
        	    } else {
        		  layer_open('layer202');
        		}
        		
        	} else {
        	    $("#check_flag").val('Y');
        		layer_open('layer201');
        	}
        }
        , error: function(data, status, err) {
        	alert("중복확인 조회 에러!");
        }
        , complete: function() {}
    });
}
/****
 * 품목코드 중복확인 함수 
 */
function existitemcd() {
	
	if($.trim($('#itemcd').val())=="") {
		alert("품목코드를 입력하지 않았습니다");
		$.trim($('#itemcd').focus());
        return;
	}
	
	var param = "mode=existitemcd&itemcd="+$('#itemcd').val();
	
	var standard = $.trim($("#standard").val());
	if(standard!='') {
	    param += "&standard="+standard;
	}
	
    $.ajax({
        type: 'post'
        , url: '../base/base02/ajax_base02.php'
        , data: param
        , datatype: 'json'
        , success: function(data) {
        	if(data.cnt > 0) {
        	    if(standard!='') {
        	        layer_open('layer203');
        	    } else {
        		  layer_open('layer202');
        		}
        		
        	} else {
        	    $("#check_flag").val('Y');
        		layer_open('layer201');
        	}
        }
        , error: function(data, status, err) {
        	alert("중복확인 조회 에러!");
        }
        , complete: function() {}
    });
}



/****
 * 거래처 찾기 함수 
 */
function searchcustomer() {
	
	if($.trim($('#customer').val())=="") {
		alert("거래처명을 입력하지 않았습니다");
		return false;
	}
	
	var param = "mode=existitecustomer&customer="+$('#customer').val();
	
	$.ajax({
        type: 'post'
        , url: '../base/base02/ajax_base02.php'
        , data: param
        , datatype: 'json'
        , success: function(data) {
        	if(data.cnt > 0) {
        	    if(standard!='') {
        	        layer_open('layer203');
        	    } else {
        		  layer_open('layer202');
        		}
        		
        	} else {
        	    $("#check_flag1").val('Y');
        		layer_open('layer201');
        	}
        }
        , error: function(data, status, err) {
        	alert("중복확인 조회 에러!");
        }
        , complete: function() {}
    });
}

/****
 * 등록 
 */
function regist()
{
	if($("#mode").val() != 'updt') {
		var grpcd= $.trim($("select[name=grpcd]").val());
		if(grpcd == '') {
			alert("품목구분을 선택해주세요.");
	        return;
		}
    }
		
	if($("#itemcd").val()=="") {
        alert("코드가 생성되지 않았습니다.");
        return;
    }
	//품목코드 중복확인 했나?
    if($("#check_flag").val()=='N') {
        alert('품목코드 중복확인을 하지 않았습니다');
        return;
    }
		
	if($.trim($("#itemnm").val())=="") {
		alert("품목명을 입력하지 않았습니다");
		$.trim($("#itemnm").focus());
		return;
	}
	
    //규격은 입력 안할 수 있으므로 체크 패스
    
    //품목명 중복확인 했나?
    //if($("#check_flag").val()=='N') {
    //    alert('품목명 중복확인을 하지않았습니다');
    //    return;
    //}

	if($.trim($("#custom_name").val())=="") {
		alert("거래처명을 입력하지 않았습니다");
		$.trim($("#custom_name").focus());
		return;
	}
   
	var param = "mode="+$("#mode").val()+"&"+$("#registfrm").serialize();
	/*
	var f = document.registfrm;
    f.imode.value = "imgins";
    f.method = "post";
    f.action = "ajax_base02.php";
    //f.target = "process";
    //f.enctype= "multipart/form-data";
    f.submit();
	*/
	$.ajax({
        type: 'post'
        , url: '../base/base02/ajax_base02.php'
        , data: param
        , datatype: 'json'
        , success: function(data) {
        	if(data.pid == "1") {
            	alert('저장되었습니다.');
        		top.location.href='../base/base02/base02_srch.php';
        	}else{
				console.log('저장실패:'+data.pid);
        	}
        }
        , error: function(data, status, err) {
        	alert("품목 등록 에러!");
        }
        , complete: function() {}
    });
}

function upload_file()
{
    
}

$(document).ready(function() {
    
    if($("#mode").val() != 'updt') {
        $("#check_flag").val('N');
    } else {
        $("#check_flag").val('Y');
    }

	//품목코드
	//listCode('select[name=grpcd]', 'B');
	
	//생산단위
	if($("#mode").val() =='updt') {
		//listCode('select[name=unit]', 'G' ,'updt');
    } else {
    	//listCode('select[name=unit]', 'G' ,'');
    }
    
	/**
	 *자제코드를 '등록' 버튼 클릭하지 않고 생성하게 만듬.
	 * 이미지 비동기 업로드에 자제코드가 필요하여 품목코드 선택시 생성하게 만듬. 
	 */
	 /*
	$("select[name=grpcd]").change(function() {
		if($(this).val()!=0){
			uniqueCode($(this).val());
		}
		else {
			$("#itemcd").val("");
		}
	});
	*/
	
	$("#idAddFileUpload").click(function() { //파일 업로드 탐색창 오픈
		if($("#imageUpload").val()==""){
		    alert("파일을 먼저 선택하세요");return;
		}
		file_upload_iframe();
	});
	
	if($("#mode").val()=="updt") {
		selectImage();
	}
});

function file_upload_check()
{
    if($("#itemcd").val()=="") {
            alert("코드가 생성되지 않았습니다.");
            selected_file_clear("imageUpload");
            return;
        }
        
    if( $("#imageUpload").val() != "" ){
        var ext = $("#imageUpload").val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpg','jpeg','bmp']) == -1) {
            alert('gif,png,jpg,jpeg,bmp 파일만 업로드 할수 있습니다.');
            selected_file_clear("imageUpload");
            return;
        }
    }
}

function file_upload_iframe()
{
    var f = document.registfrm;
    f.imode.value = "imgins";
    f.method = "post";
    f.action = "ajax_fileupload.php?imode=imgins";
    f.target = "process";
    f.enctype= "multipart/form-data";
    f.submit();
}

function file_upload_result(retcd)
{
    selected_file_clear("imageUpload");
    if(retcd!=1)
    {
        alert("업로드 실패");return;
    }
    selectImage();
}


function selectImage() //등록된 이미지 정보를 가져오는 함수
{
	var param = 'imode=imglist&itemcd='+$("#itemcd").val()+'&gubun='+$("#gubun").val();
	$.ajax({
		type: 'post'
		, url: '../base/base02/ajax_base02_image.php'
		, data: param
		, datatype: 'json'
		, success: function(data) {
			var imgstr = "";
			$('#tdPic2').empty();
			$(data).each(function() {
					
				pidx = $(this).attr('pidx');
				code = $(this).attr('code');
				fname = $(this).attr('fname');

				$('#image_filename').val(fname);
				if (fname=="")
				{
					var imgurl = "/weberp/img/images.png";
				}else{
					var imgurl = "/weberp/dataHome/product" + "/" + fname;	
				}
			
				imgstr += "<li>";
				imgstr += "<a class='fancybox' href='" + imgurl + "'><img src='" + imgurl + "' alt='사진'></a>";
				imgstr += "<span class=\"delPic\"><a href=\"#\" title=\"사진삭제\" onclick=\"pic_del('"+pidx+"', '"+code+"')\"><img src=\"/weberp/img/del_pic.png\" alt=\"사진삭제\"></a></span>";
				imgstr += "</li>";
			});
			$('#tdPic2').append(imgstr);
		}
		, error: function(data, status, err) {
			alert("이미지 조회 에러!");
		}
		, complete: function() {}
	});
}

/****
 * 이미지 x 버튼 클릭시 삭제 함수 
 */
function pic_del(pidx, itemcd) {
	var param = "imode=imgdel&pidx="+pidx+"&itemcd="+itemcd;
	$.ajax({
        type: 'post'
        , url: '../base/base02/ajax_base02_image.php'
        , data: param
        , datatype: 'json'
        , success: function(data) {
        	if(data.pid == "1") {
        		selectImage();
        	} 
        	else {
        	}
        }
        , error: function(data, status, err) {
        	alert("삭제 에러!");
        }
        , complete: function() {}
    });
}

function cancel()
{
	close_popup();
    //$("#registfrm").attr("method", "post");
    //$("#registfrm").attr("action", "../base/base02/base02_srch.php");
    //$("#registfrm").submit();
}

function search_customer() 
{
	var custtype = $("select[name='cust_type'] option:selected").val();
	if( custtype =="") {
		alert('품목를 선택해 주세요.');
		return;
	}
		
	var search_customer_name = $.trim($("#srch_custom_name").val());
	if(search_customer_name == '') {
		alert('거래처명을 입력해주세요.');
		$("#srch_custom_name").focus();
		return;
	}

	var custname = escape(encodeURIComponent(search_customer_name));
	var param = "custname="+custname+"&custtype="+custtype;
	var url = "/weberp/inner/customer_list.php?"+param;
	$("#custListIframe").attr("src", url);
	layer_open('customerListLayer');
	//$("#select_Srch3").focus();
}

function sel_cust_from_iframe(custnm, custcd, charge_nm, telno, mobileno, fax, email) 
{
	//alert(custcd + ' ' + custnm);	
	$('#customerListLayer').fadeOut();
	$("#custom_code").val(custcd);
	$("#custom_name").val(custnm);

	//telno = replace_all(telno, '-', '');
	//mobileno = replace_all(mobileno, '-', '');
	//fax = replace_all(fax, '-', '');
	
	//$("#duty_name").val(charge_nm);
	//$("#tel_no").val(telno);
	//$("#est_mobileno").val(mobileno);
	//$("#est_fax").val(fax);
	//$("#est_email").val(email);
}
function close_popup()
	{
		$.modal.close();
	}
	function setSaleInfo(code, name)
	{
		$("#custom_code").val(code);
		$("#custom_name").val(name);
	}

function searchSales()
		{
		$("#salesList_layer").modal({
			show: true,
			clickClose: false,
			closeText: '',
			showClose: false    
		});
		var url = "/weberp/base/sales_list.php";
		$("#salesList_frame").attr("src", url);
		}
function inputNumberFormat(obj) {
    obj.value = comma(uncomma(obj.value));
}
</script>
</body>
</html>
