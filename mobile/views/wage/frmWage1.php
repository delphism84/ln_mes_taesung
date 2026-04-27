<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12" style="height:750px; margin-top:5px; clear:both">
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
						<div class="col-xs-12 center"><span id="paging_area"></span></div>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="wageModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:800px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">급여계산</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:735px">
				<form id="frm">
					<input type="hidden" name="mode" id="mode" value="registItem" />
					<input type="hidden" name="uid" id="uid" />
					<input type="hidden" name="old_img" id="old_img" />
					<table class="table table-bordered">
						<tr>
							<th colspan="4" style="background-color:#ccc">사원정보</th>
						</tr>
						<tr>
							<? $this->th("이름") ?>
							<td></td>
							<? $this->th("입사연월") ?>
							<td></td>
						</tr>
						<tr>
							<? $this->th("부서") ?>
							<td></td>
							<? $this->th("직위") ?>
							<td></td>
						</tr>
						<tr>
							<th colspan="4" style="background-color:#ccc">급여정보</th>
						</tr>						
						<tr>
							<? $this->th("귀속연월-차수") ?>
							<td><? $this->createDbSelectBox("item_classify","classify_nm","classify",""); ?></td>
							<? $this->th("급여구분") ?>
							<td>
								<select>
									<option value="1">급여</option>
									<option value="2">상여</option>
								</select>
							</td>
						</tr>
						<tr>
							<? $this->th("대상기간") ?>
							<td>
							<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="estimate_dt" id="estimate_dt" type="text" value="<?=date("Y-m-d");?>" data-date-format="yyyy-mm-dd" validation="yes" err="견적일을 입력하세요" readonly />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="estimate_dt" id="estimate_dt" type="text" value="<?=date("Y-m-d");?>" data-date-format="yyyy-mm-dd" validation="yes" err="견적일을 입력하세요" readonly />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
							</td>
							<? $this->th("지급일") ?>
							<td style="vertical-align:middle">
								<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="estimate_dt" id="estimate_dt" type="text" value="<?=date("Y-m-d");?>" data-date-format="yyyy-mm-dd" validation="yes" err="견적일을 입력하세요" readonly />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
							</td>
						</tr>
						<tr>
							<? $this->th("지급연월") ?>
							<td></td>
							<? $this->th("표준월보수") ?>
							<td><input type="text" class="form-control" /></td>
						</tr>
						<tr>
							<th colspan="4" style="background-color:#ccc">제수당</th>
						</tr>
						<tr>
							<? $this->th("업무수당") ?>
							<td><input type="text" class="form-control" /></td>
							<? $this->th("교통비") ?>
							<td><input type="text" class="form-control" /></td>
						</tr>
						<tr>
							<? $this->th("시간외수당") ?>
							<td><input type="text" class="form-control" /></td>
							<? $this->th("식대") ?>
							<td><input type="text" class="form-control" /></td>
						</tr>
						<tr>
							<th colspan="4" style="background-color:#ccc">공제정보</th>
						</tr>
						<tr>
							<? $this->th("공제구분") ?>
							<td colspan="3">
								<input type="checkbox" /> 국민연금
								<input type="checkbox" /> 건강보험
								<input type="checkbox" /> 고용보험
								<input type="checkbox" /> 장기요양
							</td>
						</tr>
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-primary" id="btnSubmit">급여계산</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="8" />

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

function viewModal(){
	showModal('wageModal');
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
					tag += "<tr>";
					tag += "<td rowspan='2' style='vertical-align:middle; text-align:center'>" + json[i].emp_nm + "<br><input type='button' class='btn btn-xs btn-success' value='급여계산' onclick='viewModal()' /></td>";
					tag += "<td rowspan='2' style='vertical-align:middle'>급여총액</td>";
					tag += "<td rowspan='2' style='vertical-align:middle; text-align:center'>" + json[i].position_nm + "</td>";
					tag += "<td style='vertical-align:middle'>업무수당</td>";
					tag += "<td style='vertical-align:middle'>교통비</td>";
					tag += "<td rowspan='2' style='vertical-align:middle'>급여총액</td>";
					tag += "<td style='vertical-align:middle'>국민연금</td>";
					tag += "<td style='vertical-align:middle'>고용보험</td>";
					tag += "<td style='vertical-align:middle'>소득세</td>";					
					tag += "<td rowspan='2' style='vertical-align:middle'>공제합계</td>";
					tag += "<td rowspan='2' style='vertical-align:middle'>실지급액</td>";					
					tag += "</tr>";
					tag += "<tr>";
					tag += "<td style='vertical-align:middle'>시간외수당</td>";
					tag += "<td style='vertical-align:middle'>급식비</td>";
					tag += "<td style='vertical-align:middle'>건강보험</td>";
					tag += "<td style='vertical-align:middle'>장기요양</td>";
					tag += "<td style='vertical-align:middle'>주민세</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "employee";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
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