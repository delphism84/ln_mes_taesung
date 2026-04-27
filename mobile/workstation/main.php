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
				<span>생산현황01</span>
				<p>2018.01.01</p>
			</div>
			<div class="wrpa_table">
				<table class="production_status_table">
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
					<tbody>
						<tr>
							<td>201880810-01</td>
							<td>한울아크릴</td>
							<td>키보드</td>
							<td>조립</td>
							<td>작업중단</td>
							<td>
								<div class="progress_bar"></div> <span class="percent">0%</span>
							</td>
						</tr>						
					</tbody>
				</table>
			</div>
		</li>
		
		<li style="left: 100%;">
			<div class="production_status_tit">
				<span>생산현황02</span>
				<p>2018.01.01</p>
			</div>
			<div class="wrpa_table">
				<table class="production_status_table">
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
					<tbody>
						<tr >
							<td>201880810-01</td>
							<td>한울아크릴</td>
							<td>키보드</td>
							<td>조립</td>
							<td>작업중단</td>
							<td>
								<div class="progress_bar"></div> <span class="percent">0%</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</li>
		
		<li style="left: 200%;">
			<div class="production_status_tit">
				<span>생산현황03</span>
				<p>2018.01.01</p>
			</div>
			<div class="wrpa_table">
				<table class="production_status_table">
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
					<tbody>
						<tr>
							<td>201880810-01</td>
							<td>한울아크릴</td>
							<td>키보드</td>
							<td>조립</td>
							<td>작업중단</td>
							<td>
								<div class="progress_bar"></div> <span class="percent">0%</span>
							</td>
						</tr>
					</tbody>
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
		getWork();
	}, 1000); // 1분에 한번
});

function getWork() {
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

			$("#tb tbody").html(tag);
		}
	});
}
</script>
</body>
</html>