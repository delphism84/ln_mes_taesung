<?
$week = array("일", "월", "화", "수", "목", "금", "토");
$s = $week[date("w")];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>생산현황판</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css1/style.css">
<link rel="stylesheet" type="text/css" href="css1/comm.css">
<link rel="icon" type="image/png" href="images1/icons/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="vendor1/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="fonts1/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="vendor1/animate/animate.css">
<link rel="stylesheet" type="text/css" href="vendor1/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="vendor1/perfect-scrollbar/perfect-scrollbar.css">
<link rel="stylesheet" type="text/css" href="css1/util.css">
<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<div class="box3">
	<ul class="content">
		<li style="left: 0%;" >
			<div class="production_status_tit">
				<h1>상호명</h1>
				<span>생산현황</span>
				<p>[<?=date("Y-m-d")?>] <?=$s?>요일</p>
			</div>
			<div class="wrpa_table">
				<table class="production_status_table" id="production_present">
					<thead>
						<tr class="table100-head">
							<th>작업지시번호</th>
							<th>거래처</th>
							<th>작업품목</th>
							<th>작업공정</th>
							<th>작성상태</th>
							<th>진행률</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</li>
		
		<li style="left: 100%;">
			<div class="production_status_tit">
				<h1>상호명</h1>
				<span>수주현황</span>
				<p>[<?=date("Y-m-d")?>] <?=$s?>요일</p>
			</div>
			<div class="wrpa_table">
				<table class="production_status_table" id="obtain_present">
					<thead>
						<tr class="table100-head">
							<th>품번</th>
							<th>품명</th>
							<th>규격</th>
							<th>거래처</th>
							<th>수량</th>
							<th>금액</th>
							<th>수주일</th>
							<th>납기일</th>
							<th>상태</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</li>
		
		<li style="left: 200%;">
			<div class="production_status_tit">
				<h1>상호명</h1>
				<span>안전재고현황</span>
				<p>[<?=date("Y-m-d")?>] <?=$s?>요일</p>
			</div>
			<div class="wrpa_table">
				<table class="production_status_table" id="safety">
					<thead>
						<tr class="table100-head">
							<th>품번</th>
							<th>품명</th>
							<th>규격</th>
							<th>단위</th>
							<th>안전재고수량</th>
							<th>현재고수량</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</li>
	</ul>
	
	<ul class="butt">
		<li class="on"><a href="#a"></a></li>
		<li><a href="#a"></a></li>
		<li><a href="#a"></a></li>
	</ul>
</div>

<script src="vendor1/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor1/bootstrap/js/popper.js"></script>
<script src="vendor1/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor1/select2/select2.min.js"></script>
<script src="js1/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){
	var button = $(".butt li");
	var content = $(".content li");
	var plus = 0;

	button.click(function(){
		var th = $(this);
		var i = th.index();

		button.removeClass("on");
		th.addClass("on");

		move(i);

	});
	time();

	function move(i){
		var content1 = content.eq(plus);
		var content2 = content.eq(i);

		content1.css("left",0).stop().animate({left:"-100%"});
		content2.css("left","100%").stop().animate({left:0});

		plus = i;
	}

	function time(){
		setInterval(function(){
			var n = plus + 1;

			if(n === content.size()){
				n = 0;
			}
			button.eq(n).trigger("click");
		}, 10000);//1000에 1초
	}
});

$(function() {
	setInterval(
		function() {
			getData();
			getObtainOrder();
			getSafetyStock();
		}, 
	1000); // 1초에 한번
});

function getData() {
	var tag = "";
	var parameter = {"mode" : "sGetWorkStation"};
	
	$.getJSON("../ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {
				tag += "<tr>";
				tag += "<td>" + json[i].work_cd + "</td>";
				tag += "<td>" + json[i].account_nm + "</td>";
				tag += "<td>" + json[i].item_nm + "</td>";
				tag += "<td>" + json[i].process_nm + "</td>";
				tag += "<td>" + json[i].state + "</td>";
				tag += "<td><progress max='100' value='" + json[i].percent + "'></progress> " + json[i].percent + " %</td>";
				tag += "</tr>";
			}			
		} else {
			tag = "<tr><td colspan='6' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}
		
		$("#production_present tbody").html(tag);
	});
}

//==================================================
// 품목리스트
//==================================================
function getObtainOrder(){
	var tag = "";
	var parameter = {"mode" : "sGetObtainOrderList"};

	$.getJSON("../ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postObtainOrder(" + json[i].uid + ", '" + json[i].estiamte_cd + "', '" + json[i].order_cd + "', '" + json[i].estimate_dt + "', '" + json[i].order_dt + "', '" + json[i].account_cd + "', '" + json[i].account_nm + "', '" + json[i].sales_emp_id + "', '" + json[i].sales_emp_nm + "', '" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].unit + "', '" + json[i].cnt + "', '" + json[i].price +"', '" + json[i].use_tax + "', '" + json[i].delivery_dt + "', '" + json[i].shipping_address + "')\" style='cursor:pointer'>";
					
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "<td style='text-align:right'>" + json[i].cnt + "</td>";
					tag += "<td style='text-align:right'>" + json[i].total_price + "</td>";
					tag += "<td>" + json[i].order_dt + "</td>";
					tag += "<td>" + json[i].delivery_dt + "</td>";
					tag += "<td>" + json[i].state + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#obtain_present tbody").html(tag);
		}
	);
}


function getSafetyStock(page){
	var tag = "";
	var parameter = {"mode" : "sGetSafetyStockList"};

	$.getJSON("../ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					tag += "<td>" + json[i].safety_stock_cnt + "</td>";
					tag += "<td>" + json[i].current_cnt + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='6' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#safety tbody").html(tag);
		}
	);
}
</script>
</body>
</html>