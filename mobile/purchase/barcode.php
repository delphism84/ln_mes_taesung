<?
session_start();
?>

<!DOCTYPE html>
<html lang="ko">
<head style="height:100%;">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>바코드입고,키인입고</title>
<link href="css01/bootstrap.min.css" rel="stylesheet">
  <!--css-->
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="overflow:hidden; height:100%;">
	<!--로그아웃 박스-->
	<table class="box1">
		<tr>
			<td>
				<div>
					<button onclick="location.href='main.php'">
						<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
					</button>
				</div>
				<div>
					<input type="button" name="" value="로그아웃" onclick="location.href='logout.php'">
					<b><?=$_SESSION['login_nm']?></b>
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
			</td>
		</tr>
	</table>
<table>
	<tr>
		<td>			
			<div class="wrap_box">				
				<div class="purch-box">
					<div class="purch_tit">
						<p>생산품입고 / 자재반납</p>
					</div>
					<div class="purch_btn">
						<button class="barcode_show">바로가기</button>
					</div>
				</div>				
				<div class="purch-box">
					<div class="purch_tit">
						<p>구매입고</p>
					</div>
					<div class="purch_btn">
						<button class="keyin_show">바로가기</button>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>

<!--바코드입고 슬라이드-->
<div class="barcode background-fff">
	<div class="slide-box">
		<div class="barcode_close">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>  
		</div>
		<p class="slide-tit">BARCODE</p>    
	</div>
	<div class="padding-20px">
		<div class="left-box" style="border-right:1px solid #ddd; height:830px;padding-right:25px;">
			<div>
				<!-- 바코드 스캔 영역 -->
				<div class="form-group has-success has-feedback">
					<label class="control-label sr-only" for="inputGroupSuccess4">Input group with success</label>
						<div class="input-group">
							<span class="input-group-addon">바코드를 스캔하세요</span>
							<input type="text" class="form-control" name="barcode" id="barcode" aria-describedby="inputGroupSuccess4Status">
						</div>
						<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
						<span id="inputGroupSuccess4Status" class="sr-only">(success)</span>
					</div>
				</div>
				<!-- // 바코드 스캔 영역 -->
				
				<div style="height:785px;  overflow-y:scroll; padding:0px 10px;">
					<table class="table table-bordered margintop-20px">
						<thead>
							<tr>
								<th>입고</th>
								<th>품목명</th>
								<th>발주수량</th>
								<th>잔여입고수량</th>
								<th>요청부서</th>
								<th>요청인</th>
								<th>상태</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="right-box">
			<span>품목정보</span>
			<table class="table table-bordered">
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
			
			<span>수입검사</span>
			<table class="table table-bordered">
				<tbody>
					<tr>
						<th>검사항목</th>
						<td>불량수량</td>
					</tr>
					<tr>
						<th>외간검사</th>
						<td><input type="text" name="" autocomplete="off"></td>
					</tr>
					<tr>
						<th>중량검사</th>
						<td><input type="text" name="" autocomplete="off"></td>
					</tr>
				</tbody>
			</table>
			
			<span>품목입고</span>
			<table class="table table-bordered">
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
						<td><input type="text" name="" autocomplete="off"></td>
					</tr>
					<tr>
						<th>입고수량</th>
						<td><input type="text" name="" autocomplete="off"></td>
					</tr>
					<tr>
						<th>추가입고수량</th>
						<td><input type="text" name="" autocomplete="off" value="0"></td>
					</tr>
				</tbody>
			</table>
			<button>품목입고</button>
		</div>
	</div>
</div>


<!--QC 슬라이드-->
<div class="keyin background-fff">
	<div class="slide-box">
		<div class="keyin_close">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</div>
		<p class="slide-tit">KEYIN</p>
	</div>
	<div class="padding-20px">
		<div class="left-box" style="border-right:1px solid #ddd; height:830px;padding-right:25px;">
			<div style="margin-left:10px;"><input type="button" class="btn btn-xs btn-danger" value="입고대기 품목" /></div>
			<span style="height:815px;  overflow-y:scroll; padding:0px 10px; display:block">
					<table class="table table-bordered" id="keyin_tb" >
						<thead>
							<tr class="info">
								<th>용도</th>
								<th>품번</th>
								<th>품명</th>
								<th>규격</th>
								<th>요청수량</th>
								<th>잔여입고수량</th>
								<th>상태</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
			<span>
		</div>
		<div class="right-box">
			<div><input type="button" class="btn btn-xs btn-danger" value="품목정보" /></div>
			<table class="table table-bordered">
				<tbody>
					<tr>
						<th class="info col-xs-3">매입처</th>						
						<td><span id="account_nm"></span></td>
					</tr>
					<tr>
						<th class="info">발주코드</th>	
						<td><span id="order_cd"></span></td>
					</tr>
					<tr>
						<th class="info">품번</th>	
						<td><span id="item_cd"></span></td>
					</tr>
					<tr>
						<th class="info">품명</th>	
						<td><span id="item_nm"></span></td>
					</tr>
					<tr>
						<th class="info">규격</th>	
						<td><span id="standard"></span></td>
					</tr>
					<tr>
						<th class="info">단위</th>	
						<td><span id="unit"></span></td>
					</tr>
					<tr>
						<th class="info">발주수량</th>	
						<td><span id="order_cnt"></span></td>
					</tr>
				</tbody>
			</table>

			<form name="keyin_frm" id="keyin_frm">
				<input type="hidden" name="mode" id="mode" value="sRegistWarehousing" />
				<input type="hidden" name="uid" id="uid" />
				<input type="hidden" name="remain_cnt" id="remain_cnt" />
				
				<div><input type="button" class="btn btn-xs btn-danger" value="수입검사" /></div>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="col-xs-3 info">검사항목</th>	
							<th class="info">불량수량</th>
						</tr>
						<tr>
							<th class="info">외간검사</th>	
							<td><input type="text" class="form-control" name="" autocomplete="off"></td>
						</tr>
						<tr>
							<th class="info">중량검사</th>	
							<td><input type="text" class="form-control" name="" autocomplete="off"></td>
						</tr>
					</tbody>
				</table>
				<div><input type="button" class="btn btn-xs btn-danger" value="품목입고" /></div>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="col-xs-3 info">입고위치</th>	
							<td>
								<select class="form-control" name="warehouse" id="warehouse"></select>
							</td>
						</tr>
						<tr>
							<th class="info">입고수량</th>	
							<td><input type="text" class="form-control" name="in_cnt" id="in_cnt" autocomplete="off"></td>
						</tr>
						<tr>
							<th class="info">추가입고수량</th>	
							<td><input type="text" class="form-control" name="add_cnt" id="add_cnt" autocomplete="off" value="0"></td>
						</tr>
					</tbody>
				</table>
			</form>
			<div style="text-align:center"><input type="button" class="btn btn-lg btn-primary" value="품목입고" id="btnKeyinSubmit" /></div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
//==================================================
// 바코드입고
//==================================================
$('#barcode').keypress(function(e){ 
	if(e.keyCode!=13) return; 
	registIn($("#barcode").val());

	$("#barcode").val("");
});

function registIn(barcode) {
	var tag = "";
	var parameter = {"mode" : "sGetBarcodeInfo", "barcode" : barcode, "process" : $("#process").val(), "machine" : $("#machine").val()};

	$.getJSON("../ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			if(json.result == "false") {
				alert("해당 품목은 현재공정에 투입되는 자재가 아닙니다");
			} else if(json.result == "true") {
				tag += "<tr>";
				tag += "<td class='td'><input type='hidden' name='item_cd[]' value='" + json.item_cd + "' />" + json.item_cd + "</td>";
				tag += "<td class='td'><input type='hidden' name='item_nm[]' value='" + json.item_nm + "' />" + json.item_nm + "</td>";
				tag += "<td class='td'><input type='hidden' name='standard[]' value='" + json.standard + "' />" + json.standard + "</td>";
				tag += "<td class='td'><input type='hidden' name='unit[]' value='" + json.unit + "' />" + json.unit + "</td>";
				tag += "<td class='td'><input type='hidden' name='incnt[]' value='" + json.cnt + "' />" + json.cnt + "</td>";
				tag += "<td class='td'><input type='hidden' name='lot_no[]' value='" + json.lot_no + "' />" + json.lot_no + "</td>";
				tag += "</tr>";

				$("#in_item_tb tbody").append(tag);
			}
		} else {
			alert("해당 바코드의 품목을 찾지 못했습니다");
		}	
	});
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#keyin_frm")[0].reset();
	$("#uid").val("");
	$("#warehouse").val(0);
	$("#in_cnt").val("");
	$("#add_cnt").val("");
	$("#account_nm").html("");
	$("#order_cd").html("");
	$("#item_cd").html("");
	$("#item_nm").html("");
	$("#standard").html("");
	$("#unit").html("");
	$("#order_cnt").html("");
	$("#remain_cnt").val("");
}


$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

//콤마찍기
function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

//콤마풀기
function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

$(function(){
	//시작
	//바코드 제이쿼리
	$('.barcode_show').click(function(){
		$('.barcode').css('left','0');
	});

	$('.barcode_close>span').click(function(){
		$('.barcode').css('left','-120%');
	});
	
	//키인 제이쿼리
	$('.keyin_show').click(function(){
		$('.keyin').css('right','0');
	});
	$('.keyin_close>span').click(function(){
		$('.keyin').css('right','-120%');
	});
	//끝

	$("#btnKeyinSubmit").click(function (event) {
		if($("#uid").val() == "") {
			alert("입고시킬 품목을 선택하세요");
			return false;
		}

		var remain_cnt = uncomma($("#remain_cnt").val());
		
		if($("#in_cnt").val() == "") {
			alert("입고수량을 입력하세요");
			return false;
		}

		if(Number($("#in_cnt").val()) > Number(remain_cnt)) {
			alert("잔여입고수량 보다 입고수량이 많습니다.\r\n초과된 수량은 추가입고수량에 입력됩니다");
			var add_cnt = Number(uncomma($("#in_cnt").val())) - Number(remain_cnt);
			$("#in_cnt").val(comma(remain_cnt));
			$("#add_cnt").val(comma(add_cnt));
		}


		if($("#warehouse option:selected").val() == 0) {
			alert("입고시킬 창고를 선택하세요");
			return false;
		}
		
		event.preventDefault();
		var form = $('#keyin_frm')[0];
		var data = new FormData(form);
		data.append("CustomField", "This is some extra data, testing");
		$("#btnKeyinSubmit").prop("disabled", true);

		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			url: "../ajax.php",
			data: data,
			processData: false,
			contentType: false,
			cache: false,
			timeout: 600000,
			success: function (data) {
				alert("입고처리가 되었습니다");
				getKeyInList();
				formClear();
				$("#btnKeyinSubmit").prop("disabled", false);
			},
			error: function (e) {
				$("#btnKeyinSubmit").prop("disabled", false);
			}
		});
	});
});


$(document).ready(function() {
	getKeyInList();
	getWarehouseList();
});

// 상품테이블 선택 아이템 TR 색상 바꾸기
function toggle(it) {
	$("#keyin_tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

setInterval(function() {
	//getKeyInList();
}, 1000); // 1초에 한번

function getKeyInList() {
	var tag = "";
	var parameter = {"mode" : "sGetOrdersItemList"};
	$.getJSON("../ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for (var i = 0 ; i < json.length ; i++)
			{
				tag += "<tr onclick=\"toggle(this); postData(" + json[i].uid + ", '" + json[i].account_nm + "', '" + json[i].account + "', '" + json[i].order_cd + "', '" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].unit + "', '" + json[i].cnt + "', '" + json[i].remain_cnt + "');\" style='cursor:pointer'>";
				tag += "<td>" + json[i].purchase_type + "</td>";
				tag += "<td>" + json[i].item_cd + "</td>";
				tag += "<td>" + json[i].item_nm + "</td>";
				tag += "<td>" + json[i].standard + "</td>";
				tag += "<td style='text-align:right; padding-right:5px'>" + json[i].cnt + "</td>";
				tag += "<td style='text-align:right; padding-right:5px'>" + json[i].remain_cnt + "</td>";
				tag += "<td>" + json[i].state + "</td>";
				tag += "</tr>";
			}
		} else {
			tag = "<tr><td colspan='7' style='padding:20px; color:red; font-weight:bold; text-align:center'>입고시킬 품목이 없습니다</td></tr>";
		}

		$("#keyin_tb tbody").html(tag);
	});
}

function postData(uid, account_nm, account_cd, order_cd, item_cd, item_nm, standard, unit, cnt, remain_cnt) {
	$("#uid").val(uid);
	$("#account_nm").html(account_nm);
	$("#account_cd").val(account_cd);
	$("#order_cd").html(order_cd);
	$("#item_cd").html(item_cd);
	$("#item_nm").html(item_nm);
	$("#standard").html(standard);
	$("#unit").html(unit);
	$("#in_cnt").val(remain_cnt);
	$("#order_cnt").html(cnt);
	$("#remain_cnt").val(remain_cnt);

	//createLotNo(item_cd, account_cd);
}

function createLotNo(item_cd, account_cd) {
	var parameter = {"mode" : "createLotNo", "type" : "I", "item_cd" : item_cd, "account_cd" : account_cd}
	$.ajax({
		type : "post",
		data : parameter,
		url : "../ajax.php",
		success : function(str) {
			$("#lot_no").val(str);
		}
	});
}

function getWarehouseList() {
	var tag = "<option value='0'>==선택==</option>";
	var parameter = {"mode" : "getWarehouseList"};
	$.getJSON("../ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for (var i = 0 ; i < json.length ; i++)
			{
				tag += "<option value='" + json[i].uid + "'>" + json[i].warehouse_nm + "</option>";
			}

			$("#warehouse").html(tag);
		}
	});
}
</script>
</body>
</html>