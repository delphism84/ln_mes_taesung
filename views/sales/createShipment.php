

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
				<li class="active">수주 등록</li>
			</ul><!-- /.breadcrumb -->

			<div class="nav-search" id="nav-search">
				<form class="form-search">
					<span class="input-icon">
						<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
						<i class="ace-icon fa fa-search nav-search-icon"></i>
					</span>
				</form>
			</div><!-- /.nav-search -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					수주 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						수주 정보를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<!-- 테이블 -->
					<table id="simple-table" class="table  table-bordered table-hover">
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">일자</th>
							<td class="col-xs-5">
								<div>
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class=" date-picker" name="anniversary_date1" id="anniversary_date1" type="text" data-date-format="dd-mm-yyyy" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</div>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">거래처</th>
							<td class="col-xs-5">
								<div class="input-group">
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input type="text" name="anniversary1" id="anniversary1" />
											<input type="text" name="anniversary1" id="anniversary1" />
											<span class="input-group-addon btn-purple">
												<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
											</span>
										</div>
									</span>
								</div>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">담당자</th>
							<td class="col-xs-5"><input type="text" /></td>
							<th class="col-xs-1" style="background-color:#f1f1f1">출하창고</th>
							<td class="col-xs-5">
								<select>
									<option>창고1</option>
									<option>창고2</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">거래유형</th>
							<td class="col-xs-5">
								<select>
									<option>부가세율 적용</option>
									<option>부가세율 미적용</option>
								</select>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">통화</th>
							<td class="col-xs-5">
								<select>
									<option>내자</option>
									<option>달러</option>
									<option>바트</option>
									<option>엔화</option>
									<option>위안</option>
									<option>유로</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">프로젝트</th>
							<td class="col-xs-5">
								<div class="input-group">
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input type="text" name="anniversary1" id="anniversary1" />
											<input type="text" name="anniversary1" id="anniversary1" />
											<span class="input-group-addon btn-purple">
												<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
											</span>
										</div>
									</span>
								</div>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">참조</th>
							<td class="col-xs-5"><input type="text" /></td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">결제조건</th>
							<td class="col-xs-5"><input type="text" /></td>
							<th class="col-xs-1" style="background-color:#f1f1f1">유효기간</th>
							<td class="col-xs-5"><input type="text" /></td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">납기일자</th>
							<td class="col-xs-5">
								<div>
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class=" date-picker" name="anniversary_date1" id="anniversary_date1" type="text" data-date-format="dd-mm-yyyy" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</div>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">첨부</th>
							<td class="col-xs-5"><input type="text" /></td>
						</tr>
					</table>
					<button class="btn btn-xs btn-inverse" id="addItemBtn"><span style="font-size:12pt">+</span></button>
					<button class="btn btn-xs btn-pink">견적서 불러오기</button>
					<table id="product" class="table  table-bordered table-hover" style="margin-top:10px">
						<tr>
							<th class="detail-col center" style="background-color:#f1f1f1"></th>
							<th class="col-xs-1" style="background-color:#f1f1f1">품목코드</th>
							<th class="col-xs-2" style="background-color:#f1f1f1">품목명</th>
							<th class="col-xs-1" style="background-color:#f1f1f1">규격</th>
							<th class="col-xs-1" style="background-color:#f1f1f1">박스/롤/Carton</th>
							<th class="col-xs-1" style="background-color:#f1f1f1">수량</th>
							<th class="col-xs-1" style="background-color:#f1f1f1">단가</th>
							<th class="col-xs-1" style="background-color:#f1f1f1">공급가액</th>
							<th class="col-xs-1" style="background-color:#f1f1f1">부가세</th>
							<th class="col-xs-2" style="background-color:#f1f1f1">유통기한/로트번호</th>
						</tr>
						<tr class="item1">
							<td class="center"><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true'></i></td>
							<td><input type="text" class="form-control" /></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
						</tr>
						<tr class="item2">
							<td class="center"><i class='delBtn fa fa-minus-square fa-2x delBtn' aria-hidden='true'></i></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
						</tr>
						<tr class="item3">
							<td class="center"><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true'></i></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
							<td><input type="text" class="form-control"/></td>
						</tr>
					</table>
				</div>
			</div><!-- /.row -->

			
			
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button">
						<i class="ace-icon fa fa-check bigger-110"></i>
						Submit
					</button>

					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						Reset
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
				document.getElementById('zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('address1').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('address2').focus();
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

<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-phone').mask('(999) 999-9999');
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