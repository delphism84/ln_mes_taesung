<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">인사/급여</a>
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

					<form id="frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="employee" />
						<input type="hidden" name="action" id="action" value="updateEmployee" />
						<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />
						<input type="hidden" name="ori_img" id="ori_img" value="<?=$t->img?>" />
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 사원번호</th>
								<td class="col-xs-5"><input type="text" class="form-control" name="emp_cd" id="emp_cd" value="<?=$t->emp_cd?>" readonly /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 사원명</th>
								<td class="col-xs-5"><input type="text" name="emp_nm" id="emp_nm" value="<?=$t->emp_nm?>" /></td>
							</tr>
							
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 사원 ID</th>
								<td class="col-xs-5"><input type="text" name="emp_id" id="emp_id" value="<?=$t->emp_id?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 사원 PASSWORD</th>
								<td class="col-xs-5"><input type="text" name="emp_pwd" id="emp_pwd" value="<?=$t->emp_pwd?>" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">성별</th>
								<td class="col-xs-5">
									<label>
										<input type="radio" class="ace" name="sex_gb" id="sex_gb" value="m" <? if($t->sex_gb == "m") echo "checked"; ?> />
										<span class="lbl"> 남성</span>
									</label>

									<label>
										<input type="radio" class="ace" name="sex_gb" id="sex_gb" value="w" <? if($t->sex_gb == "w") echo "checked"; ?> />
										<span class="lbl"> 여성</span>
									</label>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">주민등록번호</th>
								<td class="col-xs-5"><input type="text" class="form-control input-mask-registno" name="regist_no" id="regist_no" value="<?=$t->regist_no?>" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 휴대전화</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="ace-icon fa fa-phone"></i>
										</span>

										<input class="form-control input-mask-mobile" type="text" name="emp_mobile" id="emp_mobile" value="<?=$t->emp_mobile?>" />
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">자택전화</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="ace-icon fa fa-phone"></i>
										</span>

										<input class="form-control input-mask-telephone" type="text" name="emp_telephone" id="emp_telephone" value="<?=$t->emp_telephone?>" />
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">Email</th>
								<td class="col-xs-5" colspan="3"><input type="text" class="form-control" name="emp_email" id="emp_email" value="<?=$t->emp_emial?>" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">입사일자</th>
								<td class="col-xs-5">
									<span class="input-icon input-icon-right">
									<div class="input-group">
										<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="join_dt" id="join_dt" value="<?=substr($t->join_dt,0,10)?>" />
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
										<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="resign_dt" id="resign_dt" value="<?=substr($t->resign_dt,0,10)?>" />
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</span>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">부서</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="department_cd" id="department_cd" readonly value="<?=$t->department_cd?>" />
												<input type="text" name="department_nm" id="department_nm" value="<?=$t->department_nm?>" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog1">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">직위</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="position_cd" id="position_cd" value="<?=$t->position_cd?>" readonly />
												<input type="text" name="position_nm" id="position_nm" value="<?=$t->position_nm?>" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog2">
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
										<input type="text" class="form-control search-query" placeholder="우편번호" name="emp_zipcode" id="emp_zipcode" value="<?=$t->emp_zipcode?>" readonly />
										<span class="input-group-btn">
											<button type="button" class="btn btn-purple btn-sm" onclick="sample6_execDaumPostcode(1)">
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
												Search
											</button>
										</span>
									</div>
									<div style="margin-top:5px">
										<input type="text" class="form-control search-query" placeholder="주소" name="emp_address" id="emp_address" value="<?=$t->emp_address?>" />
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">사진</th>
								<td class="col-xs-5" colspan="3">
									<?
									if($t->img != "") echo "<img src='attach/$t->img' style='width:50px; height:50px' />";
									?>
									<input type="file" class="form-control" name="img" id="img" />
								</td>
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
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=employee&action=listPageEmployee' ">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록 돌아가기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<div id="dialog-message1" class="hide">
	<table id="department_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">부서명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<div id="dialog-message2" class="hide">
	<table id="position_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">직위명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

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


<!----------------------------------------------------------------------------------------------------------------------->
<!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/common.js"></script>
<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/jquery.inputlimiter.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<!-- page specific plugin scripts -->
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function(){
	getDepartment(1);
	getPosition(1);
});


function getDepartment(page) {
	var rpp = 15;
	var adjacents = 4;
	var page = page;
	var tag = "";

	$.getJSON("ajax/department.php",{"page":page, "mode":"getDepartment", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postDepartmentData('" + json[i].uid + "','" + json[i].department_nm + "')\">" + json[i].department_nm + "</a></td>";
					tag += "</tr>";
				}
			}

			$("#department_list tbody").html(tag);

			var table = "erp_department";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function getPosition(page) {
	var rpp = 15;
	var adjacents = 4;
	var page = page;
	var tag = "";

	$.getJSON("ajax/position.php",{"page":page, "mode":"getPosition", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postPositionData('" + json[i].uid + "','" + json[i].position_nm + "')\">" + json[i].position_nm + "</a></td>";
					tag += "</tr>";
				}
			}

			$("#position_list tbody").html(tag);

			var table = "erp_position";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function formSubmit(){
	if(!check_str($("#emp_cd").val(),"사원코드")) return false;
	if(!check_str($("#emp_nm").val(),"사원명")) return false;
	if(!check_str($("#emp_id").val(),"사원아이디")) return false;
	if(!check_str($("#emp_pwd").val(),"사원비밀번호")) return false;
	//if(!check_str($("#emp_mobile").val(),"휴대전화")) return false;

	$("#frm").submit();
}

function postDepartmentData(cd,nm) {
	$("#department_cd").val(cd);
	$("#department_nm").val(nm);
}

function postPositionData(cd,nm) {
	$("#position_cd").val(cd);
	$("#position_nm").val(nm);
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
				
	$( "#id-btn-dialog1" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 300,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>부서 리스트</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

				
	$( "#id-btn-dialog2" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message2" ).removeClass('hide').dialog({
			width : 300,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>직위 리스트</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
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
});
</script>
<!----------------------------------------------------------------------------------------------------------------------->