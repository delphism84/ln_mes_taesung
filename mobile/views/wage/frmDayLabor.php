<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-12">
						<div style="float:left">
							
							
						</div>
						<div>
							<div class="input-group">								
								<input type="text" name="search_txt" id="search_txt" style="height:35px; width:100%;"/>													
								<span class="input-group-btn">										
									<button type="button" class="btn btn-purple btn-sm" onclick="search()" style="height:35px">
										<span class="fa fa-search icon-on-right bigger-110"></span>
									</button>
									<button type="button" class="btn btn-success btn-sm" onclick="refresh()" style="height:35px">
										<span class="fa fa-refresh icon-on-right bigger-110"></span>
									</button>
									<!--
									<button type="button" class="btn btn-danger btn-sm" style="height:35px" data-toggle="modal" data-target="#confirm-delete" >
										<span class="fa fa-trash icon-on-right bigger-110"></span>
									</button>
									<button type="button" class="btn btn-primary btn-sm" onclick="showModal('createDayLaborModal')" style="height:35px">
										<span class="fa fa-plus icon-on-right bigger-110"></span>
									</button>
									-->
								</span>
							</div>
						</div>
						<input type="button" class="btn btn-xs btn-pink" value="일용직 리스트" style="height:35px; margin-top:10px;" />
						<?
						/*
						if($_SESSION['login_level'] >= 99){
							$this->table("tb","사원명,급여구분,건강보험,국민연금,노인보험감면,고용보험,직종구분,국적정보,입사일자,휴대전화,이메일");
						} else {
							$this->noCheckTable("tb","사원명,급여구분,건강보험,국민연금,노인보험감면,고용보험,직종구분,국적정보,입사일자,휴대전화,이메일");
						}
						*/
							$this->noCheckTable("tb","사원명,휴대전화,이메일");
							$this->paging();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- 상세보기 -->
<div class="modal fade" id="viewDayLaborModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"style="top:10%;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">상세보기</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style='height:70%'>
			<!-- 내용 -->
				<form id="frm">
					<input type="hidden" name="uid" id="uid"/>
					<table class="table table-bordered">
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>사원명</th>
							<td><span id="w_emp_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>급여구분</th>
							<td><span id="w_pay_classify"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>건강보험</th>
							<td><span id="w_health_ins"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>국민연금</th>
							<td><span id="w_national_pension"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>노인보험감면</th>
							<td><span id="w_eldelry_ins"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>고용보험</th>
							<td><span id="w_unemployment_ins"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>직종구분</th>
							<td><span id="w_occupation"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>국적정보</th>
							<td><span id="w_nationality"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>입사일자</th>
							<td><span id="w_join_dt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>휴대전화</th>
							<td><span id="w_mobile"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>E-Mail</th>
							<td><span id="w_email"></span></td>
						</tr>
					</table>
				</form>
			<!-- 내용 -->
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">					
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="16" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>


<div class="modal fade" id="createDayLaborModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:1400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">일용직 등록</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:530px">
				<form id="frm">
					<input type="hidden" name="mode" id="mode" value="registDayLabor" />
					<input type="hidden" name="uid" id="uid" />
					<table class="table table-bordered">
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 사원명</th>
							<td colspan="3" class="col-xs-11"><input type="text" class="form-control" name="emp_nm" id="emp_nm" /></td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">성별</th>
							<td class="col-xs-5">
								<label>
									<input type="radio" class="ace" name="gender" id="gender" value="m" checked />
									<span class="lbl"> 남성</span>
								</label>
								<label>
									<input type="radio" class="ace" name="gender" id="gender" value="w" />
									<span class="lbl"> 여성</span>
								</label>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">주민등록번호</th>
							<td class="col-xs-5"><input type="text" class="form-control input-mask-registno" name="regist_no" id="regist_no" /></td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 휴대전화</th>
							<td class="col-xs-5">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-phone"></i>
									</span>
									<input class="form-control input-mask-mobile" type="text" name="mobile" id="mobile" />
								</div>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">자택전화</th>
							<td class="col-xs-5">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-phone"></i>
									</span>
									<input class="form-control input-mask-telephone" type="text" name="telephone" id="telephone" />
								</div>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">Email</th>
							<td class="col-xs-5" colspan="3"><input type="text" class="form-control" name="email" id="email" /></td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">입사일자</th>
							<td class="col-xs-5">
								<span class="input-icon input-icon-right">
									<div class="input-group">
										<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="join_dt" id="join_dt" />
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</span>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">퇴사일자</th>
							<td class="col-xs-5">
								<span class="input-icon input-icon-right">
									<div class="input-group">
										<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="resign_dt" id="resign_dt" />
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</span>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">주소</th>
							<td class="col-xs-5" colspan="3">
								<div class="input-group">
									<input type="text" class="form-control search-query" placeholder="우편번호" name="zipcode" id="zipcode" readonly />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="sample6_execDaumPostcode(1)">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											Search
										</button>
									</span>
								</div>
								<div style="margin-top:5px">
									<input type="text" class="form-control search-query" placeholder="주소" name="address" id="address" />
								</div>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">급여구분</th>
							<td class="col-xs-5">
								<label>
									<input type="radio" class="ace" name="pay_classify" id="pay_classify" value="일급" checked />
									<span class="lbl"> 일급</span>
								</label>
								<label>
									<input type="radio" class="ace" name="pay_classify" id="pay_classify" value="시급" />
									<span class="lbl"> 시급</span>
								</label>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">건강보험</th>
							<td class="col-xs-5">
								<label>
									<input type="radio" class="ace" name="health_ins" id="health_ins" value="대상자" checked />
									<span class="lbl"> 대상자</span>
								</label>
								<label>
									<input type="radio" class="ace" name="health_ins" id="health_ins" value="비대상자" />
									<span class="lbl"> 비대상자</span>
								</label>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">국민연금</th>
							<td class="col-xs-5">
								<label>
									<input type="radio" class="ace" name="national_pension" id="national_pension" value="대상자" checked />
									<span class="lbl"> 대상자</span>
								</label>
								<label>
									<input type="radio" class="ace" name="national_pension" id="national_pension" value="비대상자" />
									<span class="lbl"> 비대상자</span>
								</label>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">노인보험감면</th>
							<td class="col-xs-5">
								<label>
									<input type="radio" class="ace" name="eldelry_ins" id="eldelry_ins" value="대상자" checked />
									<span class="lbl"> 대상자</span>
								</label>
								<label>
									<input type="radio" class="ace" name="eldelry_ins" id="eldelry_ins" value="비대상자" />
									<span class="lbl"> 비대상자</span>
								</label>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">고용보험</th>
							<td class="col-xs-5">
								<label>
									<input type="radio" class="ace" name="unemployment_ins" id="unemployment_ins" value="대상자" checked />
									<span class="lbl"> 대상자</span>
								</label>
								<label>
									<input type="radio" class="ace" name="unemployment_ins" id="unemployment_ins" value="비대상자" />
									<span class="lbl"> 비대상자</span>
								</label>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">직종구분</th>
							<td class="col-xs-5">
								<label>
									<input type="radio" class="ace" name="occupation" id="occupation" value="일반직" checked />
									<span class="lbl"> 일반직</span>
								</label>
								<label>
									<input type="radio" class="ace" name="occupation" id="occupation" value="생산직" />
									<span class="lbl"> 생산직</span>
								</label>
								<label>
									<input type="radio" class="ace" name="occupation" id="occupation" value="연구직" />
									<span class="lbl"> 연구직</span>
								</label>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">국적정보</th>
							<td class="col-xs-5" colspan="3">
								<label>
									<input type="radio" class="ace" name="nationality" id="nationality" value="내국인" checked />
									<span class="lbl"> 내국인</span>
								</label>
								<label>
									<input type="radio" class="ace" name="nationality" id="nationality" value="외국인" />
									<span class="lbl"> 외국인</span>
								</label>
							</td>
						</tr>
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-info" id="btnSubmit">저장</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- // 우편번호 찾기 ------------------------------------------------------------------------------------------------------->
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
function sample6_execDaumPostcode(obj) {
	new daum.Postcode({
		oncomplete: function(data) {
			// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = ''; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
			if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
				fullAddr = data.roadAddress;
			} else { // 사용자가 지번 주소를 선택했을 경우(J)
				fullAddr = data.jibunAddress;
			}

			// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
			if(data.userSelectedType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}
			
			if(obj == 1) {
				// 우편번호와 주소 정보를 해당 필드에 넣는다.
				document.getElementById('zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('address').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('address').focus();
			} else {
				// 우편번호와 주소 정보를 해당 필드에 넣는다.
				document.getElementById('corp_zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('corp_address').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('corp_address').focus();
			}
		}
	}).open();
 }
 </script>

<script>
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
	$("#page").val(1);
	$("#where").val("");
	$("#search_txt").val("");
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

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {

			event.preventDefault();
			var form = $('#frm')[0];
			var data = new FormData(form);			
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
					getData(1);
					formClear();
					hideModal('createDayLaborModal');
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
	deleteSelect("day_labor");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#btnSubmitTxt").text("저장");
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
	var parameter = {"mode" : "getDayLaborList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					//tag += "<tr onclick='toggle(this); postItem(" + json[i].uid + ");' style='cursor:pointer'>";
					tag += "<tr onclick='toggle(this); postData(" + json[i].uid + ");' style='cursor:pointer'>";
					/*
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					*/
					tag += "<td>" + json[i].emp_nm + "</td>";
					//tag += "<td>" + json[i].pay_classify + "</td>";
					//tag += "<td>" + json[i].health_ins + "</td>";
					//tag += "<td>" + json[i].national_pension + "</td>";
					//tag += "<td>" + json[i].eldelry_ins + "</td>";
					//tag += "<td>" + json[i].unemployment_ins + "</td>";
					//tag += "<td>" + json[i].occupation + "</td>";
					//tag += "<td>" + json[i].nationality + "</td>";
					//tag += "<td>" + json[i].join_dt + "</td>";
					tag += "<td>" + json[i].mobile + "</td>";
					tag += "<td>" + json[i].email + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "day_labor";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//상세보기
function postData(uid) {
	$("#uid").val(uid);
	var parameter = {"mode" : "getDayLabor", "uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#w_emp_nm").html(json.emp_nm);
			$("#w_pay_classify").html(json.pay_classify);
			$("#w_health_ins").html(json.health_ins);
			$("#w_national_pension").html(json.national_pension);
			$("#w_eldelry_ins").html(json.eldelry_ins);
			$("#w_unemployment_ins").html(json.unemployment_ins);
			$("#w_occupation").html(json.occupation);
			$("#w_nationality").html(json.nationality);
			$("#w_join_dt").html(json.join_dt);
			$("#w_mobile").html(json.mobile);
			$("#w_email").html(json.email);
		}
	});
	showModal('viewDayLaborModal');
}

//==================================================
// 선택한 품목 처리
//==================================================
function postItem(uid) {
	$("#uid").val(uid);

	var parameter = {"mode" : "getDayLabor", "uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#emp_nm").val(json.emp_nm);
			$('input:radio[name=gender][value=' + json.gender + ']').prop("checked", true);
			$("#regist_no").val(json.regist_no);
			$("#mobile").val(json.mobile);
			$("#telephone").val(json.telephone);
			$("#email").val(json.email);
			$("#join_dt").val(json.join_dt);
			$("#resign_dt").val(json.resign_dt);
			$("#zipcode").val(json.zipcode);
			$("#address").val(json.address);
			$('input:radio[name=pay_classify][value=' + json.pay_classify + ']').prop("checked", true);
			$('input:radio[name=health_ins][value=' + json.health_ins + ']').prop("checked", true);
			$('input:radio[name=national_pension][value=' + json.national_pension + ']').prop("checked", true);
			$('input:radio[name=eldelry_ins][value=' + json.eldelry_ins + ']').prop("checked", true);
			$('input:radio[name=unemployment_ins][value=' + json.unemployment_ins + ']').prop("checked", true);
			$('input:radio[name=occupation][value=' + json.occupation + ']').prop("checked", true);
			$('input:radio[name=nationality][value=' + json.nationality + ']').prop("checked", true);	
			//$("#btnSubmitTxt").text("수정");
			showModal('createDayLaborModal');		
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
		
		$("#where").val("where emp_nm like '@" + txt + "@'");				
	} else {
	}
	$("#page").val(1);
	getData(1);
}
</script>