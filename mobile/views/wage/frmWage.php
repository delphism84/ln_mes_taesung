<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12" style="height:100%; margin-top:5px; clear:both">
					<div class="col-xs-12" style="border:1px solid #ccc; height:100%; padding-top:10px;">					
						
						<table class="table table-bordered" id="tb">
							<thead>
								<tr>
									<th class="col-xs-1" rowspan="3" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">성명</th>
									<th class="col-xs-1" rowspan="3" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">급여총액</th>
									<th class="col-xs-1" rowspan="3" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">직위</th>
									<th class="col-xs-2" colspan="2" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">제수당</th>
									<th class="col-xs-1" rowspan="3" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">급여총액</th>
									<th class="col-xs-3" colspan="3" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">공제내역</th>
									<th class="col-xs-1" rowspan="3" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">공제합계</th>
									<th class="col-xs-1" rowspan="3" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">실지급액</th>							
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">업무수당</th>
									<th class="col-xs-1" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">교통비</th>
									<th class="col-xs-1" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">국민연금</th>
									<th class="col-xs-1" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">고용보험</th>
									<th class="col-xs-1" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">소득세</th>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">시간외수당</th>
									<th class="col-xs-1" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">급식비</th>
									<th class="col-xs-1" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">건강보험</th>
									<th class="col-xs-1" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">장기요양</th>
									<th class="col-xs-1" style="background-color:#f1f1f1; text-align:center; vertical-align:middle">주민세</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>	
											
					</div>
					<!--<div class="col-xs-12 center" style="margin-top:20px"><input type="button" class="btn btn-lg btn-primary" value="급여일괄계산" onclick="calPay()" /></div>-->	
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="100" />
<input type="hidden" name="i" id="i" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

//콤마찍기
function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

function refresh() {
	$("#set_classify").val(0);
	$("#classify").val(0);
	$("#item_classify").val(0);
	$("#search_txt").val("");
	$("#where").val("");
	$("#page").val(1);
	getData(1);
}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );


	var page = $("#page").val();
	getData(page);

	$("#checkedAll").click(function(){
		if($("#checkedAll").prop('checked')) {
			$(".chk").each(function(){
				$(this).prop("checked",true);
			});
		} else {
			$(".chk").each(function(){
				$(this).prop("checked",false);
			});
		}
	});

	$("#item_classify").on('change', function() {
		if($("#item_classify option:selected").val() == 0) {
			$("#search_txt").val("");
			$("#where").val("");
			getData(1);
		}
	});

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			if($("#cnt").val() > 0) {
				if($("#warehouse_cd option:selected").val() == 0) {
					showAlert("기초재고 수량을 입고시킬 창고를 선택하세요");
					return;
				}
			}
			event.preventDefault();
			var form = $('#frm')[0];
			var data = new FormData(form);
			data.append("CustomField", "This is some extra data, testing");
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "ajax.php",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if(data == "dupp"){
						showAlert("중복된 품번이 이미 존재합니다");
						return false;
					}
					getData(1);
					formClear();
					hideModal('createItemModal');
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
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("item");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#cnt").attr("readonly", false);
	$("#item_cd").attr("readonly", false); 
	$("#btnSubmitTxt").text("품목등록");
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
// 품목리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getEmployeeList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					// 국민연금계산
					var national_pension = (((Number(json[i].pay)*4.5)/100)/10)*10;
					// 고용보험계산
					var emp_insure = (((Number(json[i].pay)*0.65)/100)/10)*10;
					// 건강보험계산
					var health_insure = (((Number(json[i].pay)*3.12)/100)/10)*10;
					// 장기요양계산
					var long_term_care = (((Number(health_insure)*7.38)/100)/10)*10;
					// 주민세
					var residents_tax = (((Number(json[i].income_tax)*10)/100)/10)*10;


					national_pension = Math.floor(national_pension/10)*10;
					emp_insure = Math.floor(emp_insure/10)*10;
					health_insure = Math.floor(health_insure/10)*10;
					long_term_care = Math.floor(long_term_care/10)*10;
					residents_tax = Math.floor(residents_tax/10)*10;

					// 공제합계
					var total_tax = Number(national_pension) + Number(emp_insure) + Number(health_insure) + Number(long_term_care) + Number(residents_tax) + Number(json[i].income_tax);

					tag += "<tr>";
					tag += "<td rowspan='2' style='vertical-align:middle; text-align:center'>" + json[i].emp_nm + "</td>";
					// 월평균보수
					tag += "<td rowspan='2' style='vertical-align:middle'><input type='text' class='form-control' name='pay[]' id='pay_" + i + "' value='" + json[i].pay + "'/></td>";
					tag += "<td rowspan='2' style='vertical-align:middle; text-align:center'>" + json[i].position_nm + "</td>";
					// 업무수당
					tag += "<td style='vertical-align:middle'><input type='text' class='form-control' name='allowance[]' id='allowance_" + i + "' value='0' /></td>";
					// 교통비
					tag += "<td style='vertical-align:middle'><input type='text' class='form-control' name='transport[]' id='transport_" + i + "' value='0' /></td>";
					// 급여총액
					tag += "<td rowspan='2' style='vertical-align:middle'><span id='total_pay_" + i + "'></span></td>";
					// 국민연금
					tag += "<td style='vertical-align:middle; text-align:right'><span id='national_pension_" + i + "'>" + national_pension + "</span></td>";
					// 고용보험
					tag += "<td style='vertical-align:middle; text-align:right'><span id='emp_insure_" + i + "'>" + emp_insure + "</span></td>";
					// 소득세
					tag += "<td style='vertical-align:middle; text-align:right'><span id='income_tax_" + i + "'>" + json[i].income_tax + "</span></td>";					
					// 공제합계
					tag += "<td rowspan='2' style='vertical-align:middle; text-align:right'><span id='total_deduct_" + i + "'>" + total_tax + "</span></td>";
					// 실지급액
					tag += "<td rowspan='2' style='vertical-align:middle'><span id='real_pay_" + i + "'></span></td>";
					tag += "</tr>";
					tag += "<tr>";
					// 시간외 수당
					tag += "<td style='vertical-align:middle'><input type='text' class='form-control' name='time_allowance[]' id='time_allowance_" + i + "' value='0' /></td>";
					// 식대
					tag += "<td style='vertical-align:middle'><input type='text' class='form-control' name='meals_price[]' id='meals_price_" + i + "' value='0' /></td>";
					// 건강보험
					tag += "<td style='vertical-align:middle; text-align:right'><span id='health_insure_" + i + "'>" + health_insure + "</span></td>";
					// 장기요양보험
					tag += "<td style='vertical-align:middle; text-align:right'><span id='long_term_care_" + i + "'>" + long_term_care + "</span></td>";
					tag += "<td style='vertical-align:middle; text-align:right'><span id='residents_tax_" + i + "'>" + residents_tax + "</span></td>";
					tag += "</tr>";								
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			$("#i").val(i);

			$("#tb tbody").html(tag);

			var table = "employee";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

// 급여계산
function calPay(){
	for(var i = 0 ; i <= $("#i").val() ; i++){
		
		var pay = $("#pay_" + i).val();

		if(pay != "" && pay > 0) {
			var allowance = $("#allowance_" + i).val();
			var transport = $("#transport_" + i).val();
			var time_allowance = $("#time_allowance_" + i).val();
			var meals_price = $("#meals_price_" + i).val();

			// 제수당 계산
			var allowances = Number(allowance) + Number(transport) + Number(time_allowance) + Number(meals_price);

			// 국민연금계산
			var national_pension = (((Number(pay)*4.5)/100)/10)*10;
			// 고용보험계산
			var emp_insure = (((Number(pay)*0.65)/100)/10)*10;
			// 건강보험계산
			var health_insure = (((Number(pay)*3.12)/100)/10)*10;
			// 장기요양계산
			var long_term_care = (((Number(health_insure)*7.38)/100)/10)*10;

			$("#national_pension_" + i).html(national_pension);
			$("#emp_insure_" + i).html(emp_insure);
			$("#health_insure_" + i).html(health_insure);
			$("#long_term_care_" + i).html(long_term_care);
		}
	}
}

//==================================================
// 선택한 품목 처리
//==================================================
function postItem(uid) {
	$("#uid").val(uid);

	var parameter = {"mode" : "getItem", "item_uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#classify").val(json.classify);
			//$("#classify").attr("disabled",true);
			$("#group_cd").val(json.group_cd);
			$("#item_cd").val(json.item_cd);
			$("#item_cd").attr("readonly",true);
			$("#item_nm").val(json.item_nm);
			$("#standard").val(json.standard);
			$("#unit").val(json.unit);
			$("#cnt").val(comma(json.cnt));
			$("#price").val(comma(json.price));
			$("#cnt").attr("readonly",true);
			$("#warehouse_cd").val(json.warehouse_cd);
			$("#warehouse_cd").attr("disabled",true);
			$("#delivery_period").val(json.delivery_period);
			$("#safety_stock_cnt").val(json.safety_stock_cnt);
			//$("#barcode").val(json.barcode);
			//$("#lot_no").val(json.lot_no);
			if(json.img != "none" || json.img != null) {
				$("#upDiv").css("display","block");
				$("#uploadImg").attr("src","attach/" + json.img);
				$("#old_img").val(json.img);
			} else {
				$("#upDiv").css("display","none");
			}
		}
	});

	$("#btnSubmitTxt").text("품목수정");
}
//==================================================
// 품목코드 확인
//==================================================
function checkCode(modal_nm) {
	if($("#item_cd").val() == "") {
		showAlert("품번이 생성이 되어있지 않습니다.<br>품번 생성 후 진행하세요"); 
	} else {
		$("#p_item_cd").val($("#item_cd").val());
		showModal(modal_nm);
	}
}

//==================================================
// 규격 등록
//==================================================
function registStandard(modal_nm) {
	if($("#p_item_cd").val() == "") {
		showAlert("품번을 입력하세요");
		return false;
	}

	if($("#p_standard").val() == "") {
		showAlert("품목규격을 입력하세요");
		return false;
	}

	var parameter = {"mode" : "registStandard", "item_cd" : $("#p_item_cd").val(), "standard" : $("#p_standard").val()}
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "success") {
				$("#p_item_cd").val("");
				$("#p_standard").val("");
				hideModal(modal_nm);
			} else if(str == "dupp") {
				hideModal(modal_nm);
				showAlert("해당 품번 값을 가진 품목규격이 이미 존재합니다");
			}
		}
	});
}

//==================================================
// 규격 가져오기
//==================================================
function viewStandard(modal_nm) {
	var tag = "";
	var parameter = {"mode" : "getStandard", "item_cd" : $("#item_cd").val()};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json) {
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++) {
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postData('" + json[i].standard + "','" + modal_nm + "')\">" + json[i].standard + "</a></td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td style='text-align:center; font-weight:bold; color:red;'>데이터가 존재하지 않습니다</td></tr>";
			}

			$("#standard_tb tbody").html(tag);
			showModal(modal_nm);
		}
	);
}

//==================================================
// 선택한 규격 처리
//==================================================
function postData(standard, modal_nm) {
	$("#standard").val(standard);
	hideModal(modal_nm);
}

//==================================================
// 품목코드 생성
//==================================================
function createCode(classify) {
	var parameter = {"mode" : "createItemCode", "classify" : classify};

	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		success : function(str) {
			$("#item_cd").val(str);
			$("#barcode").val(str);
		}
	});
}

//==================================================
// 검색
//==================================================
function search(){
	var type = 1;
	var set_classify = $("#set_classify option:selected").val();
	if(type == 1){
		var txt = $("#search_txt").val();
		if(txt == "") {
			showAlert("검색어를 입력하세요");
			return;
		}
		
		if(set_classify == 0) $("#where").val("where item_cd like '@" + txt + "@' or item_nm like '@" + txt + "@'");		
		else $("#where").val("where classify=" + set_classify + " and (item_cd like '@" + txt + "@' or item_nm like '@" + txt + "@')");		
	} else {
		var classify = $("#item_classify option:selected").val();
		var txt = $("#search_txt").val();

		if(classify == 0) {
			showAlert("검색구분을 선택하세요");
			return;
		}
		
		if(txt == "") {
			showAlert("검색어를 입력하세요");
			return;
		}

		$("#where").val("where " + classify + " like '@" + txt + "@'");
	}
	$("#page").val(1);
	getData(1);
}

//==================================================
// 품목구분 품목 리스트 가져오기
//==================================================
function setItem(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("");
	else $("#where").val(" where classify=" + val);
	getData(1);
}
</script>