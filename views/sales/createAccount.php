<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">영업관리</a>
				</li>
				<li class="active">거래처 등록</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					거래처 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						매입 또는 매출처 정보를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->

					<form id="ac_frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="sales" />
						<input type="hidden" name="action" id="action" value="registAccount" />
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">거래처 구분</th>
								<td class="col-xs-5">
									<label>
										<input type="radio" class="ace" name="account_gb" id="account_gb" value="purchase" checked onclick="createAccountCode()" />
										<span class="lbl"> 매입</span>
									</label>

									<label>
										<input type="radio" class="ace" name="account_gb" id="account_gb" value="sales" onclick="createAccountCode()" />
										<span class="lbl"> 매출</span>
									</label>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 거래처 코드</th>
								<td class="col-xs-5"><input type="text" class="form-control" name="account_cd" id="account_cd" readonly /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 거래처명</th>
								<td class="col-xs-5"><input type="text" class="form-control" name="account_nm" id="account_nm" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 대표자명</th>
								<td class="col-xs-5"><input type="text" name="owner" id="owner" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">대표자 연락처</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="ace-icon fa fa-phone"></i>
										</span>

										<input class="form-control input-mask-mobile" type="text" name="owner_mobile" id="owner_mobile" />
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">사업자등록번호</th>
								<td class="col-xs-5"><input type="text" name="corp_reg_no" id="corp_reg_no" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">업태</th>
								<td class="col-xs-5"><input type="text" name="corp_condition" id="corp_condition" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">종목</th>
								<td class="col-xs-5"><input type="text" name="corp_event" id="corp_event" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">전화</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="ace-icon fa fa-phone"></i>
										</span>

										<input class="form-control input-mask-phone" type="text" name="corp_phone" id="corp_phone" />
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">팩스</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="ace-icon fa fa-phone"></i>
										</span>

										<input class="form-control input-mask-phone" type="text" name="corp_fax" id="corp_fax" />
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">대표이메일</th>
								<td class="col-xs-5"><input type="text" class="form-control" name="corp_email" id="corp_email" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">담당자</th>
								<td class="col-xs-5"><input type="text" class="form-control" name="manager" id="manager" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">주소</th>
								<td class="col-xs-11" colspan="3">
									<div class="input-group">
										<input type="text" class="form-control search-query" placeholder="우편번호" name="corp_zipcode" id="corp_zipcode" readonly />
										<span class="input-group-btn">
											<button type="button" class="btn btn-purple btn-sm" onclick="sample6_execDaumPostcode(1)">
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
								<th class="col-xs-1" style="background-color:#f1f1f1">거래처 ID</th>
								<td class="col-xs-5"><input type="text" name="account_id" id="account_id" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">거래처 PASSWORD</th>
								<td class="col-xs-5"><input type="text" name="account_pwd" id="account_pwd" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div><!-- /.row -->

			
			
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						등록
					</button>

					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=sales&action=listAccount' ">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록 돌아가기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->



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
				document.getElementById('corp_zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('corp_address').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('corp_address').focus();
			} else {
				// 우편번호와 주소 정보를 해당 필드에 넣는다.
				document.getElementById('company_zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('company_address1').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('company_address2').focus();
			}
		}
	}).open();
 }
 </script>
<!-- // 우편번호 찾기 ------------------------------------------------------------------------------------------------------->

<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function() {
	// 거래처 코드 자동생성
	createAccountCode();
});

// 거래처 코드 자동생성
function createAccountCode() {
	var account_gb = $("input[name='account_gb']:checked").val();
	var data_string = "mode=createAccountCode&account_gb=" + account_gb;

	$.ajax({
		type : "post",
		url : "ajax/ajax.php",
		data : data_string,
		success : function(str) {
			$("#account_cd").val(str);
		}
	});
}

function formSubmit(){
	if(!check_str($("#account_cd").val(),"거래처코드")) return false;
	if(!check_str($("#account_nm").val(),"거래처명")) return false;
	if(!check_str($("#owner").val(),"대표자명")) return false;

	$("#ac_frm").submit();
}
</script>

<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-phone').mask('(999) 999-9999');
	$('.input-mask-mobile').mask('(999) 9999-9999');
	$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
	$(".input-mask-product").mask("a*-999-a999",{
		placeholder:" ",completed:
			function(){
				alert("You typed the following: "+this.val());
			}
	});

	//datepicker plugin
	//link
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	})
	//show datepicker when clicking on the icon
	.next().on(ace.click_event, function(){
		$(this).prev().focus();
	});

	//or change it into a date range picker
	$('.input-daterange').datepicker({autoclose:true});

	//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
	$('input[name=date-range-picker]').daterangepicker({
		'applyClass' : 'btn-sm btn-success',
		'cancelClass' : 'btn-sm btn-default',
		locale: {
			applyLabel: 'Apply',
			cancelLabel: 'Cancel',
		}
	})
	.prev().on(ace.click_event, function(){
		$(this).next().focus();
	});


	$('#timepicker1').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#timepicker1').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});

	if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
		//format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
		icons: {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar',
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down',
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			today: 'fa fa-arrows ',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		}
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});

	/////////
	$('#modal-form input[type=file]').ace_file_input({
		style:'well',
		btn_choose:'Drop files here or click to choose',
		btn_change:null,
		no_icon:'ace-icon fa fa-cloud-upload',
		droppable:true,
		thumbnail:'large'
	})

	//chosen plugin inside a modal will have a zero width because the select element is originally hidden
	//and its width cannot be determined.
	//so we set the width after modal is show
	$('#modal-form').on('shown.bs.modal', function () {
		if(!ace.vars['touch']) {
			$(this).find('.chosen-container').each(
				function(){
					$(this).find('a:first-child').css('width' , '210px');
					$(this).find('.chosen-drop').css('width' , '210px');
					$(this).find('.chosen-search input').css('width' , '200px');
				});
		}
	})

	/**
	//or you can activate the chosen plugin after modal is shown
	//this way select element becomes visible with dimensions and chosen works as expected
	$('#modal-form').on('shown', function () {
	$(this).find('.modal-chosen').chosen();
	})
	*/

	$(document).one('ajaxloadstart.page', function(e) {
		autosize.destroy('textarea[class*=autosize]')
		$('.limiterBox,.autosizejs').remove();
		$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
	});
});
</script>
<!-- // basic script ------------------------------------------------------------------------------------------------------->