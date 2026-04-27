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
						
						<div class="input-group">
							<div class="col-xs-12" style="padding:0;">
								<select name="set_classify" id="set_classify" onchange="setAccount(this.value)" style="float:right; height:35px; width:100%;">
									<option value="0">=검색구분=</option>
									<?
									$sql = "select * from account_classify";
									$this->query($sql);
									while($t = $this->fetch()){
										echo "<option value='".$t->uid."'>".$t->classify_nm."</option>";
									}
									?>
								</select>
							</div>
							<div class="col-xs-12" style="margin:10px 0; padding:0;">
								<input type="text" class=" search-query" name="search_txt" id="search_txt" style="float:left; height:35px; width:74%;"/>
								<!-- <select name="search_classify" id="search_classify" style="float:right; height:35px">
									<option value="0">=검색구분=</option>
									<option value="account_cd">거래처코드</option>
									<option value="account_nm">거래처명</option>
								</select>&nbsp;									 -->
										
								<span class="input-group-btn">										
									<button type="button" class="btn btn-purple btn-sm" onclick="search()" style="height:35px; float:left">
										<span class="fa fa-search icon-on-right bigger-110"></span>
									</button>
									<button type="button" class="btn btn-success btn-sm" onclick="refresh()" style="height:35px">
										<span class="fa fa-refresh icon-on-right bigger-110"></span>
									</button>								
								</span>
							</div>
						</div>
						<div style="float:left">
							<input type="button" class="btn btn-xs btn-pink" value="거래처 리스트" style="height:35px" />							
						</div>
						<!--
						<? $this->table("tb","구분=>1,거래처코드=>3, 거래처명=>4,대표=>2,전화=>2"); ?>
						-->
						<table class="table table-bordered table-striped" id="tb">
							<thead>
								<tr>
									<th class="detail-col center" style="width:20%;">
										구분
									</th>
									<th class="detail-col center">
										거래처코드
									</th>
									<th class="detail-col center">
										거래처명
									</th>
									<th class="detail-col center"  style="width:20%;">
										대표
									</th>									
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>

						<? $this->paging() ?>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="15" />

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

function refresh() {
	$("#per").val(17);
	$("#classify").val(0);
	$("#account_classify").val(0);
	$("#search_txt").val("");
	$("#where").val("");
	$("#page").val(1);
	getData(1);
}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );


	var page = $("#page").val();
	getData(page);
	createAccountCode();

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

	$("#account_classify").on('change', function() {
		if($("#account_classify option:selected").val() == 0) {
			$("#search_txt").val("");
			$("#where").val("");
			getData(1);
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
					$("#uid").val("");
					$("#page").val(1);
					$("#where").val("");
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
// 거래처 코드 자동생성
//==================================================
function createAccountCode() {
	var classify = $("input[name='classify']:checked").val();
	var parameter = {"mode" : "createAccountCode", "classify" : classify};

	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		success : function(str) {
			$("#account_cd").val(str);
		}
	});
}

//==================================================
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("account");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#btnSubmitTxt").text("거래처 등록");
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
	var parameter = {"mode" : "getAccountList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postAccount(" + json[i].uid + ",'" + json[i].classify + "', '" + json[i].outsourcing + "','" + json[i].account_cd + "', '" + json[i].account_nm + "', '" + json[i].owner + "', '" + json[i].corp_reg_no + "', '" + json[i].corp_no + "', '" + json[i].corp_condition + "', '" + json[i].corp_event + "', '" + json[i].corp_phone + "', '" + json[i].corp_fax + "', '" + json[i].corp_email + "', '" + json[i].corp_zipcode + "', '" + json[i].corp_address + "', '" + json[i].manager + "', '" + json[i].bank + "', '" + json[i].account + "', '" + json[i].account_holder + "', '" + json[i].account_id + "', '" + json[i].account_pwd + "');\" style='cursor:pointer'>";
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
					tag += "<td>" + json[i].classify_nm + "</td>";
					tag += "<td>" + json[i].account_cd + "</td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "<td>" + json[i].owner + "</td>";
					//tag += "<td>" + json[i].corp_phone + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='6' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "account";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function postAccount(uid, classify, outsourcing, account_cd, account_nm, owner, corp_reg_no, corp_no, corp_condition, corp_event, corp_phone, corp_fax, corp_email, corp_zipcode, corp_address, manager, bank, account, account_holder, account_id, account_pwd) {
	
	$("#uid").val(uid);
	$('input:radio[name=classify][value=' + classify + ']').prop("checked", true);
	$('input:radio[name=outsourcing][value=' + outsourcing + ']').prop("checked", true);
	//$('input:radio[name="outsourcing"][value="'+ outsourcing +'"]').attr('checked', 'checked');
	$("#account_cd").val(account_cd);
	$("#account_nm").val(account_nm);
	$("#owner").val(owner);
	$("#corp_reg_no").val(corp_reg_no);
	$("#corp_no").val(corp_no);
	$("#corp_condition").val(corp_condition);
	$("#corp_event").val(corp_event);
	$("#corp_phone").val(corp_phone);
	$("#corp_fax").val(corp_fax);
	$("#corp_email").val(corp_email);
	$("#corp_zipcode").val(corp_zipcode);
	$("#corp_address").val(corp_address);
	$("#manager").val(manager);
	$("#bank").val(bank);
	$("#account").val(account);
	$("#account_holder").val(account_holder);
	$("#account_id").val(account_id);
	$("#account_pwd").val(account_pwd);

	$("#btnSubmitTxt").text("거래처 수정");
}

//==================================================
// 품목코드 확인
//==================================================
function checkCode(modal_nm) {
	if($("#item_cd").val() == "") {
		showAlert("품목코드가 생성이 되어있지 않습니다.<br>품목코드 생성 후 진행하세요"); 
	} else {
		$("#p_item_cd").val($("#item_cd").val());
		showModal(modal_nm);
	}
}

//==================================================
// 검색
//==================================================
function search(){
	var type = 1;
		
	if(type == 1){
		var search_txt = $("#search_txt").val();
		if(search_txt == ""){
			showAlert("검색어를 입력하세요");
			return false;
		}
		$("#where").val("where account_cd like '@" + search_txt + "@' or account_nm like '@" + search_txt + "@'");
	} else {
		var search_classify = $("#search_classify option:selected").val();
		var search_txt = $("#search_txt").val();

		if(search_classify == 0) {
			showAlert("검색구분을 선택하세요");
			return false;
		}

		if(search_txt == ""){
			showAlert("검색어를 입력하세요");
			return false;
		}
		$("#where").val("where classify=" + search_classify + " and (account_cd like '@" + search_txt + "@' or account_nm like '@" + search_txt + "@')");
	}

	$("#page").val(1);
	getData(1);
}

//==================================================
// 품목구분 품목 리스트 가져오기
//==================================================
function setAccount(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("");
	else $("#where").val(" where classify=" + val);
	getData(1);
}
</script>