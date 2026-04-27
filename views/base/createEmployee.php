<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">기준정보관리</a>
				</li>
				<li class="active">사원등록</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					사원 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						사원정보를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<div>
						<div>
							<form id="frm" method="post" action="index.php">
								<input type="hidden" name="controller" id="controller" value="base" />
								<input type="hidden" name="action" id="action" value="registEmployee" />
								<input type="hidden" name="big_uid" id="big_uid" />
								<input type="hidden" name="middle_uid" id="middle_uid" />
								<input type="hidden" name="small_uid" id="small_uid" />

								<!-- 테이블 -->
								<table id="simple-table" class="table table-bordered table-hover">
									<tr>
										<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 공장구분</th>
										<td class="col-xs-5" colspan="3">
											<label>
												<input type="radio" class="ace" name="process_gb" id="process_gb" value="1공장" checked/>
												<span class="lbl"> 1공장</span>
											</label>

											<label>
												<input type="radio" class="ace" name="process_gb" id="process_gb" value="2공장" />
												<span class="lbl"> 2공장</span>
											</label>

											<label>
												<input type="radio" class="ace" name="process_gb" id="process_gb" value="연태공장" />
												<span class="lbl"> 연태공장</span>
											</label>
										</td>
									</tr>
									<tr>
										<th class="col-xs-1" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 사원번호 <i class="cf fa fa-check" aria-hidden="true"></i></th>
										<td class="col-xs-5"><input type="text" class="" name="emp_cd" id="emp_cd" <? if($_SESSION['auto_code'] == "y") echo "readonly"; ?> /></td>
										<th class="col-xs-1" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 사원명 <i class="cf fa fa-check" aria-hidden="true"></i></th>
										<td class="col-xs-5"><input type="text" name="emp_nm" id="emp_nm" /></td>
									</tr>
									
									<tr>
										<th style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 사원 ID <i class="cf fa fa-check" aria-hidden="true"></i></th>
										<td><input type="text" name="emp_id" id="emp_id" value="" /></td>
										<th style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 사원 PASSWORD <i class="cf fa fa-check" aria-hidden="true"></i></th>
										<td><input type="password" name="emp_pwd" id="emp_pwd" value="" /></td>
									</tr>
									<tr>
										<th style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 성별</th>
										<td>
											<label>
												<input type="radio" class="ace" name="sex_gb" id="sex_gb" value="m" checked <? if($_SESSION['auto_code'] == "y") echo "onclick='createEmployeeCode()'"; ?> />
												<span class="lbl"> 남성</span>
											</label>

											<label>
												<input type="radio" class="ace" name="sex_gb" id="sex_gb" value="w" <? if($_SESSION['auto_code'] == "y") echo "onclick='createEmployeeCode()'"; ?> />
												<span class="lbl"> 여성</span>
											</label>
										</td>
										<th style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 주민등록번호</th>
										<td><input type="text" class="" name="regist_no" id="regist_no" /></td>
									</tr>
									<tr>
										<th style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 휴대전화 <i class="cf fa fa-check" aria-hidden="true"></i></th>
										<td>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-phone"></i>
												</span>

												<input class="" type="text" name="emp_mobile" id="emp_mobile" />
											</div>
										</td>
										<th style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 자택전화</th>
										<td>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-phone"></i>
												</span>

												<input class="" type="text" name="emp_telephone" id="emp_telephone" />
											</div>
										</td>
									</tr>
									<tr>
										<th style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> Email</th>
										<td colspan="3"><input type="text" class="" name="emp_email" id="emp_email" /></td>
									</tr>
									<tr>
										<th style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 입사일자</th>
										<td>
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="join_dt" id="join_dt" />
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
										</td>
										<th style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 퇴사일자</th>
										<td>
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
										<th style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 부서</th>
										<td>
											<select name="big_department_cd" id="big_department_cd" onchange="postBigDepartment(this.value)"><option value="0">부서선택</option></select>
											<select name="middle_department_cd" id="middle_department_cd" onchange="postMiddleDepartment(this.value)"><option value="0">부서선택</option></select>
											<select name="small_department_cd" id="small_department_cd" onchange="postSmallDepartment(this.value)"><option value="0">부서선택</option></select>
										</td>
										<th style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 직위</th>
										<td>
											<div class="input-group">
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input type="hidden" name="position_cd" id="position_cd" readonly />
														<input type="text" name="position_nm" id="position_nm" onclick="centerOpenWindow('views/popup/positionList.php', '직위리스트', 300, 500)" readonly />
														<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/positionList.php', '직위리스트', 300, 500)">
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
														</span>
													</div>
												</span>
											</div>
										</td>
									</tr>
									<tr>
										<th class="col-xs-1" style="background-color:#f1f1f1">주소</th>
										<td class="col-xs-5" colspan="3">
											<div class="input-group">
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input type="text" placeholder="우편번호" name="emp_zipcode" id="emp_zipcode" value="<?=$t->emp_zipcode?>" style='width:100px' readonly />
														<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="sample6_execDaumPostcode(1)">
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
														</span>
													</div>
												</span>
											</div>
											<div style="margin-top:5px">
												<input type="text" class=" search-query" placeholder="주소" name="emp_address" id="emp_address" value="<?=$t->emp_address?>" style='width:400px'/>
											</div>
										</td>
									</tr>
									<tr>
										<th style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 사진</th>
										<td colspan="3">
											<input type="file" class="" name="img" id="img" />
										</td>
									</tr>
								</table>
							</form>
						</div>
						<div class="clearfix form-actions center" style="margin-top:0px">
							<div class="col-md-12">
								<button class="btn btn-info" type="button" onclick="formSubmit()">
									<i class="ace-icon fa fa-check bigger-110"></i>
									등록
								</button>

								&nbsp; &nbsp; &nbsp;
								<button class="btn" type="reset" onclick="location.href = 'index.php?controller=base&action=listPageEmployee' ">
									<i class="ace-icon fa fa-undo bigger-110"></i>
									목록 돌아가기
								</button>
							</div>
						</div><!-- // submit -->
					</div>
				</div>
			</div><!-- /.row -->
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
				document.getElementById('emp_zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('emp_address').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('emp_address').focus();
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
	// 특수문자 입력 방지
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	// 사원 코드 자동생성
	<? if($_SESSION['auto_code'] == "y") { ?>createEmployeeCode(); <?}?>
	getBigDepartment();
});

function centerOpenWindow(theURL, winName, width, height, fstate, scrollbars){ 
	var features = "width=" + width ; 
	features += ",height=" + height ; 
	var state = ""; 
	var scrollbars = "yes";
	var res_w = ( $(window).width() - width ) / 2; 
	var res_h = ( $(window).height() - height ) / 2; 
	if ( window.screenLeft >= window.screen.width ) { 
		res_w = window.screen.width + res_w; 
	} 
	if (fstate == "") { // 옵션 
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 

// 사원 코드 자동생성
function createEmployeeCode() {
	var sex_gb = $("input[name='sex_gb']:checked").val();
	var data_string = "mode=createEmployeeCode&sex_gb=" + sex_gb;

	$.ajax({
		type : "post",
		url : "ajax/base.php",
		data : data_string,
		success : function(str) {
			$("#emp_cd").val(str);
		}
	});
}

// 부서 가져오기
function getBigDepartment(){
	var tag = "<option value='0'>부서선택</option>";

	$.getJSON("ajax/base.php",{"mode":"getBigDepartment"},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}

			$("#big_department_cd").html(tag);
		}
	);
}

function getMiddleDepartment(){
	var fid = $("#big_uid").val();
	var tag = "<option value='0'>부서선택</option>";

	$.getJSON("ajax/base.php",{"mode":"getMiddleDepartment", "fid" : fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}

			$("#middle_department_cd").html(tag);
		}
	);
}

function getSmallDepartment(){
	var fid = $("#middle_uid").val();
	var tag = "<option value='0'>부서선택</option>";

	$.getJSON("ajax/base.php",{"mode":"getSmallDepartment", "fid" : fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}
			$("#small_department_cd").html(tag);
		}
	);
}

function postBigDepartment(uid){
	$("#big_uid").val(uid);
	getMiddleDepartment();
	$("#department_small_list tbody").html("");
}

function postMiddleDepartment(uid){
	$("#middle_uid").val(uid);
	getSmallDepartment();
}

function postSmallDepartment(uid){
	$("#small_uid").val(uid);
}

function formSubmit(){
	if(!check_str($("#emp_cd").val(),"사원코드")) return false;
	if(!check_str($("#emp_nm").val(),"사원명")) return false;
	if(!check_str($("#emp_id").val(),"사원아이디")) return false;
	if(!check_str($("#emp_pwd").val(),"사원비밀번호")) return false;
	if(!check_str($("#emp_mobile").val(),"휴대전화")) return false;

	$("#frm").submit();
}
</script>

<!----------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-mobile').mask('(999) 9999-9999');
	$('.input-mask-telephone').mask('(999) 999-9999');
	$('.input-mask-registno').mask('999999-9999999');
	$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
	$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});

	//override dialog's title function to allow for HTML titles
	$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
		_title: function(title) {
			var $title = this.options.title || '&nbsp;'
			if( ("title_html" in this.options) && this.options.title_html == true )
				title.html($title);
			else title.text($title);
		}
	}));
		
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
});
</script>
<!----------------------------------------------------------------------------------------------------------------------->
