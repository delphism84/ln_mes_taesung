<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12" >
					<!--
					<div class="col-xs-12" style="border:1px solid #ccc; height:100%; overflow: scroll; overflow-x: hidden; padding-top:10px">
						<?
						if($_SESSION['login_level'] >= 99) { 
							echo "<div style='float:left'>";
							echo "<input type='button' class='btn btn-xs btn-pink' value='용차 리스트' />";
							echo "</div>";
							echo "<div style='float:right'>";
							//echo "<input type='button' class='btn btn-xs btn-danger' value='선택삭제' data-toggle='modal' data-target='#confirm-delete' />";
							echo "</div>";							
							$this->table("tb","차량번호=>2,차종/적재량=>4,차주=>2,회사명=>4");
						} else {
							echo "<div style='float:left'>";
							echo "<input type='button' class='btn btn-xs btn-pink' value='용차 리스트' />";
							echo "</div>";
							
							//$this->noCheckTable("tb","차량번호=>2,차종/적재량=>4,차주=>2,회사명=>4");
						}
						//$this->paging();
						?>
					</div>
					-->
					<div class="col-xs-12">
					<input type="button" class="btn btn-xs btn-pink" value="용차 리스트" />
					<table class="table table-bordered table-striped" id="tb">
						<thead>
							<tr>
								<th class="detail-col center">
									<label class="pos-rel">
										<input type="checkbox" class="ace" id="checkedAll" />
										<span class="lbl"></span>
									</label>
								</th>
								<th class="detail-col center">
									구분
								</th>
								<th class="detail-col center">
									품번
								</th>
								<th class="detail-col center">
									품명
								</th>
								<th class="detail-col center">
									규격
								</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<?
						$this->paging();
					?>
					</div>


					
					<!--
					<div class="col-xs-12" style="border:1px solid #ccc; height:100%; overflow: scroll; overflow-x: hidden; padding-top:10px">
						<div>
							<form id='frm'>
								<input type="hidden" name="mode" id="mode" value="registRentcar" />
								<input type="hidden" name="uid" id="uid" />
								<div>
									<input type="button" class="btn btn-xs btn-pink" value="용차 등록" />
								</div>
								<table class="table table-bordered">
									<tr>
										<? $this->th("차주") ?>
										<td class="col-xs-4"><input type="text" name="owner" id="owner" validation="yes" err="차주를 입력하세요" /></td>
										<? $this->th("사업자등록번호") ?>
										<td class="col-xs-4"><input type="text" name="corp_reg_no" id="corp_reg_no" validation="yes" err="사업자등록번호" /></td>
									</tr>
									<tr>
										<? $this->th("회사명") ?>
										<td><input type="text" name="corp_nm" id="corp_nm" /></td>
										<? $this->th("업태/종목") ?>
										<td><input type="text" name="corp_condition" id="corp_condition" placeholder="업태" style="width:100px" />/<input type="text" name="corp_event" id="corp_event" placeholder="종목" style="width:100px" /></td>
									</tr>
									<tr>
										<? $this->th("전화") ?>
										<td><input type="text" name="corp_phone" id="corp_phone" /></td>
										<? $this->th("휴대폰") ?>
										<td><input type="text" name="mobile" id="mobile" /></td>
									</tr>
									<tr>
										<? $this->th("팩스") ?>
										<td><input type="text" name="corp_fax" id="corp_fax" /></td>
										<? $this->th("이메일") ?>
										<td><input type="text" class="form-control" name="email" id="email" /></td>
									</tr>
									<tr>
										<? $this->th("주소") ?>
										<td colspan="3">
											<div class="input-group">
												<input type="text" class="form-control search-query" placeholder="우편번호" name="corp_zipcode" id="corp_zipcode" readonly />
												<span class="input-group-btn">
													<button type="button" class="btn btn-purple btn-sm" onclick="sample6_execDaumPostcode(2)">
														<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
														Search
													</button>
												</span>
											</div>
											<div style="margin-top:5px">
												<input type="text" class="form-control search-query" placeholder="주소" name="corp_address" id="corp_address" />
											</div>
										</td>
									</tr>
									<tr>
										<? $this->th("차량번호") ?>
										<td><input type="text" name="car_no" id="car_no" validation="yes" err="차량번호를 입력하세요" /></td>
										<? $this->th("차종") ?>
										<td>
											<? $this->selectbox("classify", "classify", "대형,중형,소형"); ?>
											<input type="text" style="width:100px" name="ton" id="ton" /> 톤
										</td>
									</tr>
									<tr>
										<? $this->th("은행/예금주") ?>
										<td colspan="3">
											<? $this->selectbox("bank", "bank", "KB국민은행,우리은행,신한은행,KEB하나은행,스탠다드차타드은행,한국씨티은행,대구은행,부산은행,광주은행,경남은행,전북은행,제주은행,농협,수협,한국산업은행,기업은행,수출입은행,신협,우체국,새마을금고,산림조합,저축은행"); ?> / <input type="text" name="account_holder" id="account_holder" />
										</td>
									</tr>
									<tr>
										<? $this->th("계좌번호") ?>
										<td colspan="3"><input type="text" class="form-control" name="account" id="account" /></td>
									</tr>
								</table>
								<div class="col-md-12 center">
									<button class="btn btn-info" type="button" id="btnSubmit">
										<i class="ace-icon fa fa-check bigger-110"></i>
										<span id="btnSubmitTxt">용차 등록</span>
									</button>
									<button class="btn btn-default" type="button" onclick="formClear()">
										<i class="ace-icon fa fa-check bigger-110"></i>
										새로고침
									</button>
								</div>
							</form>
						</div>
					</div>
					-->
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
				document.getElementById('emp_zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('emp_address').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('emp_address').focus();
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
// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

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
					getData(1);
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
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("rentcar");
	hideModal("confirm-delete");
	formClear();
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#uid").val("");
	$("#frm")[0].reset();
	$("#btnSubmitTxt").text("용차 등록");
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
	var parameter = {"mode" : "getRentcarList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postCar(" + json[i].uid + ", '" + json[i].classify + "', '" + json[i].corp_nm + "', '" + json[i].car_no + "', '" + json[i].owner + "', '" + json[i].corp_reg_no + "', '" + json[i].corp_condition + "', '" + json[i].corp_event + "', '" + json[i].corp_phone + "', '" + json[i].corp_fax + "', '" + json[i].corp_email + "', '" + json[i].corp_zipcode + "', '" + json[i].corp_address + "', '" + json[i].mobile + "', '" + json[i].bank + "', '" + json[i].account + "', '" + json[i].account_holder + "', '" + json[i].ton + "');\" style='cursor:pointer'>";

					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>

					tag += "<td>" + json[i].car_no + "</td>";
					tag += "<td>" + json[i].classify + " / " + json[i].ton + "</td>";
					tag += "<td>" + json[i].owner + "</td>";
					tag += "<td>" + json[i].corp_nm + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "rentcar";
			getPaging(table, $("#where").val(), $("#per").val(), 4);
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function postCar(uid, classify, corp_nm, car_no, owner, corp_reg_no, corp_condition, corp_event, corp_phone, corp_fax, corp_email, corp_zipcode, corp_address, mobile, bank, account, account_holder, ton) {
	$("#uid").val(uid);
	$("#classify").val(classify);
	$("#corp_nm").val(corp_nm);
	$("#car_no").val(car_no);
	$("#owner").val(owner);
	$("#corp_reg_no").val(corp_reg_no);
	$("#corp_condition").val(corp_condition);
	$("#corp_event").val(corp_event);
	$("#corp_phone").val(corp_phone);
	$("#corp_fax").val(corp_fax);
	$("#corp_email").val(corp_email);
	$("#corp_zipcode").val(corp_zipcode);
	$("#corp_address").val(corp_address);
	$("#mobile").val(mobile);
	$("#bank").val(bank);
	$("#account").val(account);
	$("#account_holder").val(account_holder);
	$("#ton").val(ton);

	$("#btnSubmitTxt").text("용차 수정");
}
</script>