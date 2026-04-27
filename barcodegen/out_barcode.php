<?php
include_once("../common.php"); // 기본 파일
include_once("../inc/dbconfig.php"); 
include_once("../inc/func.php");  // 함수 파일
header("Content-type: text/html; charset=UTF-8"); 
if (!$is_member){
goto_url("/login.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>바코드</title>
<link href="/weberp/css/reset.css" rel="stylesheet" type="text/css" media="all">
<link href="/weberp/css/layout.css" rel="stylesheet" type="text/css" media="all">
<link href="/weberp/css/common.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="/weberp/js/jquery.js" ></script>
<script type="text/javascript" src="/weberp/js/common.js" ></script>
<script type="text/javascript" src="/weberp/js/jquery.modal.js"></script>
<script type="text/javascript" src="/weberp/js/jquery/common.js" ></script>
<script type="text/javascript" src="/weberp/js/jquery.topmenu.js"></script>
<script type="text/javascript" src="/weberp/js/popup.js"></script>
<script type="text/javascript" src="/weberp/js/placeholder.js"></script>
<script type="text/javascript" src="/weberp/js/myfunction.js"></script>
<script type="text/javascript" src="/weberp/js/jquery-ui.js" ></script>
<script type="text/javascript" src="/weberp/js/jquery-ui-cal.js" ></script>
<script type="text/javascript" src="/weberp/js/placeholder.js"></script>
<script type="text/javascript" src="/weberp/js/myfunction.js"></script>
<script type="text/javascript"> 
	function searchWH()
	{
		$("#warehouseList_layer").modal({
			show: true,
			clickClose: false,
			closeText: '',
			showClose: false    
		});
		var url = "/weberp/base/warehouse_list.php";
		$("#warehouseList_frame").attr("src", url);
	}
	function setWhInfo(code, name)
	{
		$("#wh_cd").val(code);
		$("#wh_name").val(name);
	}
	function close_popup()
	{
		$.modal.close();
	}
</script>	<!--gnbWrap//-->
</head>
<body>
  <div id="wrapper">
 <!-- header + gnb  -->
<div id="headWrap">
	<?include_once("../inc/header.php");?>
	<div class="gnbWrap">
		<div id="gnb_hr">
			<? include_once("../top/menu.php");  // 함수 파일?>
		</div><!--gnb//-->
	</div>
	
	<script type="text/javascript"> 
	    $(document).ready(function(){       
			$('#gnb_hr').topmenu({ d1: 4, d2: 3 });
			$('#barcode_1').focus();
		});
	</script>	<!--gnbWrap//-->
</div>
<!-- header + gnb  -->
   <div id="conWrap">
	
     <div id="contents" class="">
        <div  id="">
            <!-- tabNavArea2 -->
            <div id="tabNavArea2">
			</div><!---//tabNavArea2-->
			
			<!-- barcodeForm -->
			<form name="barcodeForm" id="barcodeForm" method="post" action="barcode_proc.php">
			<input type="hidden" name="state" id="state" value="out_barcode" />
			<input type="hidden" id="wh_cd" name="wh_cd" />
			<!--tableArea-->
			<div class="tblArea" style="margin-top:3px;">
					<style>
						.st1_tbl{table-layout:fixed}
						.st1_tbl th{text-align:center !important;}
						.text-center{text-align:center !important;}
					</style>
					<table border="0" cellspacing="0" cellpadding="0" class="TblEst st1_tbl" id="barcodeTable">
					<colgroup>
						<col width="10%">
						<col width="40%">
						<col width="10%">
						<col width="40%">						
					</colgroup>
					<tr>
						<td class="text-center" style="background-color:#f4f3f3"><strong>일자</strong></td>
						<td><input name="basic_date" id="basic_date" type="text" value="<?=date('Y/m/d')?>" class="inpt1 w150"></td>
						<td class="text-center" style="background-color:#f4f3f3"><strong>출고창고</strong></td>
						<td><input name="wh_name" id="wh_name" type="text" class="inpt11 w150"  onclick="searchWH();"><img src="/img/btn_search.jpg" alt="btn_search" onclick="searchWH();"></td>
					</tr>
					</table>
					 <table border="0" cellspacing="0" cellpadding="0" class="TblEst st1_tbl" id="barcodeTable">
                      <colgroup>
						<col width="5%">
						<col width="15%">
						<col width="35%">
						<col width="20%">
						<col width="15%">					
                      </colgroup>
					  <THEAD>
					  <tr class="DetailTitle">
						<th class="text-center"><input type="checkbox" name="check_all" id="allCheck" onclick="chk_change();"></th>
						<th class="text-center">바코드</th>
						<th class="text-center">품목명</th>
						<th class="text-center">출고단가</th>
						<th class="text-center">수량</th>					
					  </tr>
					  </THEAD>
					  <tbody>
					  
						<tr class='ItemBlock'>
							<td class="text-center"><input type="checkbox" name="check_1" class="check_po"></td>
							<td><input name="barcode[]" id="barcode_1" type="text" class="inpt1 w96p" onkeydown="onKeyDownBarcode(this)" tabindex='1'></td>
							<td><input name="product[]" id="product_1" type="text" class="inpt1 w96p"><input type="hidden" name="is_pd[]" id="is_pd_1" />
								<input type="hidden" name="itemcd[]" id="itemcd_1" />
							</td>
							<td>
								<input name="out_unitprice[]" id="out_unitprice_1" type="text" class="inpt1 w80p"> <strong> 원 / 개</strong>
							</td>
							<td><span class="button105"><a href="javascript:minusNum(1)" title="-" class="cbtn">-</a></span><input name="qty[]" id="qty_1" type="text" class="inpt1 w60p text-center"><span class="button105"><a href="javascript:plusNum(1)" title="+" class="cbtn">+</a></span></td>
						</tr>
						<tr class='ItemBlock'>
							<td class="text-center"><input type="checkbox" name="check_1" class="check_po"></td>
							<td><input name="barcode[]" id="barcode_2" type="text" class="inpt1 w96p" onkeydown="onKeyDownBarcode(this)" tabindex='2'></td>
							<td><input name="product[]" id="product_2" type="text" class="inpt1 w96p"><input type="hidden" name="is_pd[]" id="is_pd_2" />
								<input type="hidden" name="itemcd[]" id="itemcd_2" />
							</td>
							<td>
								<input name="out_unitprice[]" id="out_unitprice_2" type="text" class="inpt1 w80p"> <strong> 원 / 개</strong>
							</td>
							<td><span class="button105"><a href="javascript:minusNum(2)" title="-" class="cbtn">-</a></span><input name="qty[]" id="qty_2" type="text" class="inpt1 w60p text-center"><span class="button105"><a href="javascript:plusNum(2)" title="+" class="cbtn">+</a></span></td>
						</tr>
						<tr class='ItemBlock'>
							<td class="text-center"><input type="checkbox" name="check_1" class="check_po"></td>
							<td><input name="barcode[]" id="barcode_3" type="text" class="inpt1 w96p" onkeydown="onKeyDownBarcode(this)" tabindex='3'></td>
							<td><input name="product[]" id="product_3" type="text" class="inpt1 w96p"><input type="hidden" name="is_pd[]" id="is_pd_3" />
								<input type="hidden" name="itemcd[]" id="itemcd_3" />
							</td>
							<td>
								<input name="out_unitprice[]" id="out_unitprice_3" type="text" class="inpt1 w80p"> <strong> 원 / 개</strong>
							</td>
							<td><span class="button105"><a href="javascript:minusNum(3)" title="-" class="cbtn">-</a></span><input name="qty[]" id="qty_3" type="text" class="inpt1 w60p text-center"><span class="button105"><a href="javascript:plusNum(3)" title="+" class="cbtn">+</a></span></td>
						</tr>
						<tr class='ItemBlock'>
							<td class="text-center"><input type="checkbox" name="check_1" class="check_po"></td>
							<td><input name="barcode[]" id="barcode_4" type="text" class="inpt1 w96p" onkeydown="onKeyDownBarcode(this)" tabindex='4'></td>
							<td><input name="product[]" id="product_4" type="text" class="inpt1 w96p"><input type="hidden" name="is_pd[]" id="is_pd_4" />
								<input type="hidden" name="itemcd[]" id="itemcd_4" />
							</td>
							<td>
								<input name="out_unitprice[]" id="out_unitprice_4" type="text" class="inpt1 w80p"> <strong> 원 / 개</strong>
							</td>
							<td><span class="button105"><a href="javascript:minusNum(4)" title="-" class="cbtn">-</a></span><input name="qty[]" id="qty_4" type="text" class="inpt1 w60p text-center"><span class="button105"><a href="javascript:plusNum(4)" title="+" class="cbtn">+</a></span></td>
						</tr>
						<tr class='ItemBlock'>
							<td class="text-center"><input type="checkbox" name="check_1" class="check_po"></td>
							<td><input name="barcode[]" id="barcode_5" type="text" class="inpt1 w96p" onkeydown="onKeyDownBarcode(this)" tabindex='5'></td>
							<td><input name="product[]" id="product_5" type="text" class="inpt1 w96p"><input type="hidden" name="is_pd[]" id="is_pd_5" />
								<input type="hidden" name="itemcd[]" id="itemcd_5" />
							</td>
							<td>
								<input name="out_unitprice[]" id="out_unitprice_5" type="text" class="inpt1 w80p"> <strong> 원 / 개</strong>
							</td>
							<td><span class="button105"><a href="javascript:minusNum(5)" title="-" class="cbtn">-</a></span><input name="qty[]" id="qty_5" type="text" class="inpt1 w60p text-center"><span class="button105"><a href="javascript:plusNum(5)" title="+" class="cbtn">+</a></span></td>
						</tr>
						<tr class='ItemBlock'>
							<td class="text-center"><input type="checkbox" name="check_1" class="check_po"></td>
							<td><input name="barcode[]" id="barcode_6" type="text" class="inpt1 w96p" onkeydown="onKeyDownBarcode(this)" tabindex='6'></td>
							<td><input name="product[]" id="product_6" type="text" class="inpt1 w96p" /><input type="hidden" name="is_pd[]" id="is_pd_6" />
								<input type="hidden" name="itemcd[]" id="itemcd_6" />
							</td>
							<td>
								<input name="out_unitprice[]" id="out_unitprice_6" type="text" class="inpt1 w80p"> <strong> 원 / 개</strong>
							</td>
							<td><span class="button105"><a href="javascript:minusNum(6)" title="-" class="cbtn">-</a></span><input name="qty[]" id="qty_6" type="text" class="inpt1 w60p text-center"><span class="button105"><a href="javascript:plusNum(6)" title="+" class="cbtn">+</a></span></td>
						</tr>
						
						<!--7-->
						<tr class='ItemBlock'>
							<td class="text-center"><input type="checkbox" name="check_1" class="check_po"></td>
							<td><input name="barcode[]" id="barcode_7" type="text" class="inpt1 w96p" onkeydown="onKeyDownBarcode(this)" tabindex='7'></td>
							<td><input name="product[]" id="product_7" type="text" class="inpt1 w96p" /><input type="hidden" name="is_pd[]" id="is_pd_7" />
								<input type="hidden" name="itemcd[]" id="itemcd_7" />
							</td>
							<td>
								<input name="out_unitprice[]" id="out_unitprice_7" type="text" class="inpt1 w80p"> <strong> 원 / 개</strong>
							</td>
							<td><span class="button105"><a href="javascript:minusNum(7)" title="-" class="cbtn">-</a></span><input name="qty[]" id="qty_7" type="text" class="inpt1 w60p text-center"><span class="button105"><a href="javascript:plusNum(7)" title="+" class="cbtn">+</a></span></td>
						</tr>
						
						<!--8-->
						<tr class='ItemBlock'>
							<td class="text-center"><input type="checkbox" name="check_1" class="check_po"></td>
							<td><input name="barcode[]" id="barcode_8" type="text" class="inpt1 w96p" onkeydown="onKeyDownBarcode(this)" tabindex='8'></td>
							<td><input name="product[]" id="product_8" type="text" class="inpt1 w96p" /><input type="hidden" name="is_pd[]" id="is_pd_8" />
								<input type="hidden" name="itemcd[]" id="itemcd_8" />
							</td>
							<td>
								<input name="out_unitprice[]" id="out_unitprice_8" type="text" class="inpt1 w80p"> <strong> 원 / 개</strong>
							</td>
							<td><span class="button105"><a href="javascript:minusNum(8)" title="-" class="cbtn">-</a></span><input name="qty[]" id="qty_8" type="text" class="inpt1 w60p text-center"><span class="button105"><a href="javascript:plusNum(8)" title="+" class="cbtn">+</a></span></td>
						</tr>
						
						<!--9-->
						<tr class='ItemBlock'>
							<td class="text-center"><input type="checkbox" name="check_1" class="check_po"></td>
							<td><input name="barcode[]" id="barcode_9" type="text" class="inpt1 w96p" onkeydown="onKeyDownBarcode(this)" tabindex='9'></td>
							<td><input name="product[]" id="product_9" type="text" class="inpt1 w96p" /><input type="hidden" name="is_pd[]" id="is_pd_6" />
								<input type="hidden" name="itemcd[]" id="itemcd_9" />
							</td>
							<td>
								<input name="out_unitprice[]" id="out_unitprice_9" type="text" class="inpt1 w80p"> <strong> 원 / 개</strong>
							</td>
							<td><span class="button105"><a href="javascript:minusNum(9)" title="-" class="cbtn">-</a></span><input name="qty[]" id="qty_9" type="text" class="inpt1 w60p text-center"><span class="button105"><a href="javascript:plusNum(9)" title="+" class="cbtn">+</a></span></td>
						</tr>
						
						<!--10-->
						<tr class='ItemBlock'>
							<td class="text-center"><input type="checkbox" name="check_1" class="check_po"></td>
							<td><input name="barcode[]" id="barcode_10" type="text" class="inpt1 w96p" onkeydown="onKeyDownBarcode(this)" tabindex='10'></td>
							<td><input name="product[]" id="product_10" type="text" class="inpt1 w96p" /><input type="hidden" name="is_pd[]" id="is_pd_10" />
								<input type="hidden" name="itemcd[]" id="itemcd_10" />
							</td>
							<td>
								<input name="out_unitprice[]" id="out_unitprice_10" type="text" class="inpt1 w80p"> <strong> 원 / 개</strong>
							</td>
							<td><span class="button105"><a href="javascript:minusNum(10)" title="-" class="cbtn">-</a></span><input name="qty[]" id="qty_10" type="text" class="inpt1 w60p text-center"><span class="button105"><a href="javascript:plusNum(10)" title="+" class="cbtn">+</a></span></td>
						</tr>
						
						
					</tbody>
					</table>
				</div><!--//tableArea-->
				<!--btnArea1-->
				<div class="btnArea1">
					<span class="button301"><a href="javascript:rowCheDel()" title="선택삭제" class="cbtn">선택삭제</a></span>
				</div><!--//btnArea1-->
				<!--btnArea2-->
				<div class="btnArea2" style="border:0px">
					<span class="button203 cbtn" onclick="register();" title="저장" style="cursor:hand">저장</a></span>
					<span class="button301"><a href="javascript:location.href='in_barcode.php';" title="초기화" class="cbtn">초기화</a></span>
				</div><!--//btnArea2-->
				</form><!--//barcodeForm -->				
        </div><!---//rightSection-->
     </div><!---//contents -->
   </div><!---//conWrap -->
 </div><!---//wrapper -->

<!--등록/수정 확인 팝업-->
  <div id="layer2" class="popLayer2">
	<div class="popContainer">		
        <div class="popConts  br_none">
			<p class="ctxt" id="actBtn_text2">등록하시겠습니까?</p>
		</div>
        <div class="btnArea2">
                <span class="button2" onclick="submit()" style="cursor: pointer">확인</a></span>
                <span class="button3"><a href="#" title="취소" class="cbtn">취소</a></span>
            </div>
	</div>
  </div>
<!--itemList: 창고조회 검색팝업-->  
 <div id="warehouseList_layer" class="popLayer205">
	<div class="popContainer">		
        <h3>창고조회</h3>
        <div class="popConts br_none">
           <iframe  src="" id="warehouseList_frame" name="warehouseList" frameborder="0" width="100%" height="400px" scrolling="yes" title="창고조회 검색"></iframe>
		</div><!---//popConts-->
		<span class="closePop rollover"><a href="#"  title="닫기" class="cbtn" onclick="close_popup()"><img src="/weberp/img/pop_close.gif" alt="닫기"></a></span>
 	</div><!---//popContainer-->
  </div><!--//itemList: 품목조회 검색팝업--> 
  
<!--경고 팝업-->
<div id="layer3" class="popLayer2">
	<div class="popContainer">
		<div class="popConts br_none">
			<p class="ctxt" id="actBtn_text3"></p>
		</div>
		<div class="btnArea2">
			<span class="button3"><a href="#" title="확인" class="cbtn">확인</a></span>
		</div>
	</div>
</div>
<iframe src="" width="0" height="0" frameborder="0" name="excel_process" id="excel_process" ></iframe>

<script type="text/javascript">
	function minusNum(num){
		var qty_id = "qty_"+num;
		var minusnum = parseInt($("#"+qty_id).val())-1;
		$("#"+qty_id).val(minusnum);
	}
	function plusNum(num){
		var qty_id = "qty_"+num;
		var plusnum = parseInt($("#"+qty_id).val())+1;
		$("#"+qty_id).val(plusnum);
	}
	function register(){
		//layer_open('layer2');
		var wh_name_val = $('#wh_name').val();
		
		if($("#barcode_1").val() == "") {
			$("<p class='ctxt' id='actBtn_text3'>바코드를 입력해주세요.</p>").replaceAll("#actBtn_text3");
			layer_open('layer3');
		}
		else if(wh_name_val == "") {
			$("<p class='ctxt' id='actBtn_text3'>창고를 입력해주세요.</p>").replaceAll("#actBtn_text3");
			layer_open('layer3');
			searchWH();
		
		} else {
			
			for(i=1; i<11; i++) {
				
				if($("#barcode_" + i).val() != "") {
					
					if($("#out_unitprice_" + i).val() != "") {
						layer_open('layer2');
					} else {
						$("<p class='ctxt' id='actBtn_text3'>출고단가를 입력해주세요.</p>").replaceAll("#actBtn_text3");
						layer_open('layer3');
					}
				} else {
        
				}
			}		
		}
	}
	function submit(){
		var form = $("#barcodeForm");
		form.submit();
	}
	function onKeyDownBarcode(Obj){
		if(window.event.keyCode == 13){
			var param = "barcode="+Obj.value;
			$.ajax({ 
				type: 'post'
				, url: './ajax_getbarcode.php'
				, data: param
				, datatype: 'json'
				, success: function(data) {
					var res =  eval('(' + data + ')');
					var bar_id = Obj.getAttribute("id");
					var bar_array = bar_id.split("_");
					var bar_num = parseInt(bar_array[1]);
					var product_id = "product_"+bar_num;
					var itemcd_id = "itemcd_"+bar_num;
					var price_id = "out_unitprice_"+bar_num;
					var qty_id = "qty_"+bar_num;
					var bar_next_id = "barcode_"+(bar_num+1);					
					var ispd_id = "is_pd_"+bar_num;
					var bar_id2 = "";
					if(res.rst == 1){
						var cnt = 0;
						$( "input:text[name='barcode[]']" ).each(function(k,v) {
							if($(v).val()==res.barcode){
								cnt++;
								if(cnt == 1){
									bar_id2 = $(v).attr("id");
								}else if(cnt == 2){
									$(v).val("");
								}
							}
						});
						if(cnt == 1){
							$("#"+product_id).val(res.product);
							$("#"+itemcd_id).val(res.itemcd);
							$("#"+price_id).val();
							$("#"+qty_id).val("1");
							$("#"+ispd_id).val("1");
							document.getElementById(bar_next_id).focus();
						}else if(cnt == 2){
							var bar_array2 = bar_id2.split("_");
							var bar_num2 = parseInt(bar_array2[1]);
							var qty_id2 = "qty_"+bar_num2;
							var qty = parseInt($("#"+qty_id2).val())+1;
							$("#"+qty_id2).val(qty);
						}

						autoBarcode("출고",res.itemcd,res.barcode);
					}else{
						$("<p class='ctxt' id='actBtn_text3'>등록되지 않은 품목입니다.<br>확인 후 다시 입력해주세요.</p>").replaceAll("#actBtn_text3");
						layer_open('layer3');
						//if(bar_confirm){
						//	window.open("/weberp/base/base02/base02_regist.php?submode=outbarcode&bacode="+Obj.value+"&inputnum="+bar_num,"window","width=1000,height=500,resizable=yes,scrollbars=yes");
						//	document.getElementById(bar_next_id).focus();
						//}else{
						//	$("#"+product_id).css("color","#ff0000");
						//	$("#"+product_id).val("등록되지 않은 품목입니다.");
						//	$("#"+ispd_id).val("0");
						//	document.getElementById(bar_next_id).focus();
						//}
					}
					
				}
				, error: function(data, status, err) {
					alert("바코드 조회 에러!");
				}
				, complete: function() {}
			});
		}
	}

	function autoBarcode(state,itemcd,barcode){
		var param = "state="+state+"&itemcd="+itemcd+"&barcode="+barcode;
		console.log(param);
		$.ajax({ 
			type: 'post'
			, url: './ajax_autobarcode.php'
			, data: param
			, datatype: 'json'
			, success: function(data) {
				var res =  eval('(' + data + ')');
			}
			, error: function(data, status, err) {
				alert("바코드 입력 에러!");
			}
			, complete: function() {}
		});
	}

	function onFocusBarcode(Obj){
		var bar_id = Obj.getAttribute("id");
		var bar_array = bar_id.split("_");
		var bar_num = parseInt(bar_array[1])+1;
		Obj.setAttribute("onfocus","");
		$("#barcodeTable").append("<tr class='ItemBlock'><td class=\"text-center\"><input type=\"checkbox\" name=\"check_1\" class=\"check_po\"></td><td><input name=\"barcode[]\" id=\"barcode_"+bar_num+"\" type=\"text\" class=\"inpt1 w96p\" onkeydown=\"onKeyDownBarcode(this)\" onfocus=\"onFocusBarcode(this)\" tabindex='"+bar_num+"'></td><td><input name=\"product[]\" id=\"product_"+bar_num+"\" type=\"text\" class=\"inpt1 w96p\"><input type=\"hidden\" name=\"is_pd[]\" id=\"is_pd_"+bar_num+"\" /><input type=\"hidden\" name=\"itemcd[]\" id=\"itemcd_"+bar_num+"\" /><input type=\"hidden\" name=\"out_unitprice[]\" id=\"out_unitprice_"+bar_num+"\" /></td><td><span class=\"button105\"><a href=\"javascript:minusNum("+bar_num+")\" title=\"-\" class=\"cbtn\">-</a></span><input name=\"qty[]\" id=\"qty_"+bar_num+"\" type=\"text\" class=\"inpt1 w60p text-center\"><span class=\"button105\"><a href=\"javascript:plusNum("+bar_num+")\" title=\"+\" class=\"cbtn\">+</a></span></td></tr>");
	}

	function rowCheDel() {						
		$('input:checkbox[name="check_1"]').each(function(){
			  if($(this).is(":checked")){
				var idx = $(this).parent().parent().index()+1;
				$("#barcode_"+idx).val("");
				$("#product_"+idx).val("");
				$("#itemcd_"+idx).val("");
				$("#out_unitprice_"+idx).val("");
				$("#qty_"+idx).val("");
				$("#is_pd_"+idx).val("")
				
			  }
		});
	}
</script>
</body>
</html>
