<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>바코드입고,키인입고</title>	
	<link href="css01/bootstrap.min.css" rel="stylesheet">
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
					<p>BARCODE 출고</p>
				</div>
				<div class="purch_btn">
					<button class="barcode_show">바로가기</button>
				</div>
			</div>                                
			<div class="purch-box">
				<div class="purch_tit">
					<p>KEYIN 출고</p>
				</div>
				<div class="purch_btn">
					<button class="keyin_show">바로가기</button>
				</div>
			</div>
		</div>
	</td></tr></table>




	<!--바코드출고 슬라이드-->
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


	<!--키인출고 슬라이드-->
	<div class="keyin background-fff">
		<div class="slide-box">
			<div class="keyin_close">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			</div>
			<p class="slide-tit">KEYIN</p>
		</div>
		<div class="padding-20px">
			<div class="left-box" style="border-right:1px solid #ddd; height:830px;padding-right:25px;">
				<div style="margin-left:10px;"><input type="button" class="btn btn-xs btn-danger" value="출고요청 품목" /></div>
				<div style="height:415px;  overflow-y:scroll; padding:0px 10px; display:block">
					<table class="table table-bordered" id="tb" >
						<thead>
							<tr class="info">
								<th>품번</th>
								<th>품명</th>
								<th>규격</th>
								<th>단위</th>
								<th>요청수량</th>
								<th>잔여출고수량</th>
								<th>요청공정</th>
								<th>요청설비</th>
								<th>처리상태</th>
								<th>요청일</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
				<div style="height:415px;  overflow-y:scroll; padding:0px 10px; display:block">
					<div><input type="button" class="btn btn-xs btn-danger" value="보관위치" /></div>
					<table id="order_waiting_tb" class="table table-bordered">
						<thead class="thin-border-bottom">
							<tr class="info">
								<th><i class="ace-icon fa fa-caret-right blue"></i> 위치</th>
								<th><i class="ace-icon fa fa-caret-right blue"></i> 재고수량</th>
								<th><i class="ace-icon fa fa-caret-right blue"></i> Lot No</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="right-box">
				<form id='frm'>
					<input type="hidden" name="mode" id="mode" value="registReleaseItem" />
					<input type="hidden" name="uid" id="uid" />
					<input type="hidden" name="stock" id="stock" />
					<input type="hidden" name="warehouse" id="warehouse" validation="yes" err="출고시킬 창고를 선택하세요" />
					<input type="hidden" name="warehouse_uid" id="warehouse_uid" />
					<input type="hidden" name="release_cnt" id="release_cnt" />
					<div>				
						<div><input type="button" class="btn btn-xs btn-danger"	value="출고처리" /></div>
						<table class="table table-bordered">
							<tr>
							
								<th>품번</th>
								<td class="col-xs-4"><input type="text" name="item_cd" id="item_cd" validation="yes" err="출고시킬 품목을 선택하세요" readonly /></td>
							
								<th>품명</th>
								<td class="col-xs-4"><input type="text" name="item_nm" id="item_nm" readonly /></td>
							</tr>
							<tr>
								<th>규격</th>
								<td class="col-xs-4"><input type="text" name="standard" id="standard" readonly /></td>
				
								<th>단위</th>
								<td class="col-xs-4"><input type="text" name="unit" id="unit" readonly /></td>
							</tr>
							<tr>
								<th>요청공정</th>
								<td class="col-xs-4"><input type='hidden' name='process' id='process' validation="yes" err="출고품 도착공정이 없습니다" /><input type="text" name="process_nm" id="process_nm" readonly /></td>

								<th>요청설비</th>
								<td class="col-xs-4"><input type='hidden' name='machine' id='machine' /><input type="text" name="machine_nm" id="machine_nm" readonly /></td>
							</tr>
							<tr>
								<th>요청팀</th>
								<td class="col-xs-4"><input type='hidden' name='team' id='team' /><input type="text" name="team_nm" id="team_nm" readonly /></td>

								<th>출고수량</th>
								<td class="col-xs-4"><input type="text" class="onlynum comma" name="cnt" id="cnt" validation="yes" err="출고수량을 입력하세요" /></td>
							</tr>
							<tr>

								<th>LOT NO</th>
								<td colspan="3"><input type="text" class="form-control" name="lot_no" id="lot_no" validation="yes" err="Lot No가 없습니다" readonly /></td>
							</tr>
						</table>
					</div>
					<div class="col-md-12" style="text-align:center">
						<button class="btn btn-lg btn-info" type="button" id="btnSubmit">
							<i class="ace-icon fa fa-check bigger-110"></i>
							<span id="btnSubmitTxt">자재출고</span>
						</button>
						<button class="btn btn-lg btn-default" type="button" onclick="formClear()">
							<i class="ace-icon fa fa-check bigger-110"></i>
							새로고침
						</button>
					</div>
				</form>
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
});

$(document).keypress(function(e) {
	if(e.which === 13) search();
});

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

function check(formName, modal = null){
	var valid = true;
	var form = $('#' + formName);

	form.find('input, textarea, select').each(function(key){
		var obj = $(this);
		if(obj.attr('validation') == 'yes') {
			if(isEmpty(obj.val())){			
				alert(obj.attr('err'));
				valid = false;
				return false;
			}	
		}
	});
	
	if(valid == true) return true;
	else return false;
}


function isEmpty(val) {
	if(val == null || typeof val == 'undefind' || val.trim().length < 1) {
		return true;
	}
	return false;
}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	//checkSystem("item");


	getData();

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			
			if(Number(uncomma($("#cnt").val())) > Number(uncomma($("#stock").val()))) {
				showAlert("출고수량이 해당 창고의 재고수량보다 클 순 없습니다");
				$("#cnt").val(uncomma(comma($("#stock").val())));
				return false;
			}

			if(Number(uncomma($("#cnt").val())) > Number(uncomma($("#release_cnt").val()))) {
				showAlert("출고요청 수량보다 더 많은 수량을 출고할 수 없습니다.");
				$("#cnt").val(uncomma(comma($("#release_cnt").val())));
				return false;
			}
			
			//stop submit the form, we will post it manually.
			event.preventDefault();

			// Get form
			var form = $('#frm')[0];

			// Create an FormData object
			var data = new FormData(form);

			// If you want to add an extra field for the FormData
			data.append("CustomField", "This is some extra data, testing");

			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);
			
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
					getData($("#page").val());
					getWhere();
					formClear();
					$("#btnSubmit").prop("disabled", false);

				},
				error: function (e) {
					$("#btnSubmit").prop("disabled", false);

				}
			});
		}
	});

});


//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	//$("#frm")[0].reset();
	$("#uid").val("");
	$("#stock").val("");
	$("#item_cd").val("");
	$("#item_nm").val("");
	$("#standard").val("");
	$("#unit").val("");
	$("#process").val("");
	$("#process_nm").val("");
	$("#machine").val("");
	$("#machine_nm").val("");
	$("#team").val("");
	$("#team_nm").val("");
	$("#lot_no").val("");
	$("#cnt").val("");
	$("#release_cnt").val("");
	//$("#purchase_lot_no").val("");
}

//==================================================
// 선택된 품목 테이블 선택된 TR 색상 바꾸기
//==================================================
function toggle(it) {
	$("#tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

//==================================================
// 선택된 품목 테이블 선택된 TR 색상 바꾸기
//==================================================
function where_toggle(it) {
	$("#order_waiting_tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

//==================================================
// 출고요청목록 리스트
//==================================================
function getData(){
	var tag = "";
	var parameter = {"mode" : "sGetReleaseList"};

	$.getJSON("../ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					if(json[i].state != "출고완료") {
						tag += "<tr onclick=\"toggle(this); postItem(" + json[i].uid + ",'" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].unit + "', " + json[i].process + ", '" + json[i].process_nm + "', " + json[i].machine + ", '" + json[i].machine_nm + "', " + json[i].team + ", '" + json[i].team_nm + "', '" + json[i].cnt + "');\" style='cursor:pointer'>";
					} else {
						tag += "<tr>";
					}

					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					tag += "<td style='text-align:right'>" + json[i].cnt + "</td>";
					tag += "<td style='text-align:right'>" + json[i].remain_cnt + "</td>";
					tag += "<td>" + json[i].process_nm + "</td>";
					tag += "<td>" + json[i].machine_nm + "</td>";

					switch(json[i].state) {
						case "출고요청" : var color = "black"; break;
						case "부분출고" : var color = "green"; break;
						case "출고완료" : var color = "red"; break;
					}

					tag += "<td><span style='color:" + color + "'>" + json[i].state + "</span></td>";
					tag += "<td>" + json[i].create_dt + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='12' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function postItem(uid, item_cd, item_nm, standard, unit, process, process_nm, machine, machine_nm, team, team_nm, release_cnt) {
	$("#uid").val(uid);
	$("#item_cd").val(item_cd);
	$("#item_nm").val(item_nm);
	$("#standard").val(standard);
	$("#unit").val(unit);
	$("#process").val(process);
	$("#process_nm").val(process_nm);
	$("#machine").val(machine);
	$("#machine_nm").val(machine_nm);
	$("#team").val(team);
	$("#team_nm").val(team_nm);
	$("#release_cnt").val(release_cnt);
	$("#cnt").val(release_cnt);

	getWhere(item_cd, standard)
}

function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

//==================================================
// 보관위치 가져오기
//==================================================
function getWhere(item_cd, standard){
	var tag = "";
	var parameter = {"mode" : "getWhere", "item_cd" : item_cd, "standard" : standard};

	$.getJSON("../ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"where_toggle(this); postCnt('" + json[i].cnt + "', '" + json[i].lot_no + "', '" + item_cd + "', " + json[i].warehouse + ", " + json[i].uid + ")\" style='cursor:pointer'>";
					tag += "<td>" + json[i].warehouse_nm + "</td>";
					tag += "<td>" + json[i].cnt + "</td>";
					tag += "<td>" + json[i].lot_no + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#order_waiting_tb tbody").html(tag);
		}
	);
}


function postCnt(cnt, lot_no, item_cd, warehouse, warehouse_uid) {
	$("#stock").val(uncomma(cnt));
	//$("#purchase_lot_no").val(lot_no);
	$("#lot_no").val(lot_no);
	$("#warehouse").val(warehouse);
	$("#warehouse_uid").val(warehouse_uid);
	//$("#cnt").val(cnt);
	//createLotNo(item_cd);
}

function createLotNo(item_cd) {
	var process = $("#process").val();
	var parameter = {"mode" : "createLotNo", "type" : "R", "item_cd" : item_cd, "process" : process}
	$.ajax({
		type : "post",
		data : parameter,
		url : "../ajax.php",
		success : function(str) {
			$("#lot_no").val(str);
		}
	});
}

//==================================================
// TR 삭제
//==================================================
function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#flag").val(nextFlag);
}

//==================================================
// 검색
//==================================================
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	$("#where").val(" where item_nm like '%" + txt + "%' or item_cd like '%" + txt + "%'");
	getData(1);
}

//==================================================
// 품목구분 품목 리스트 가져오기
//==================================================
function setItem(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("");
	else $("#where").val(" where classification=" + val);
	getData(1);
}
</script>
</body>
</html>