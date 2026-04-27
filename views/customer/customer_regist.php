

<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">Forms</a>
				</li>
				<li class="active">Form Elements</li>
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
					고객 기본정보
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						고객의 기본정보를 입력하시면 됩니다
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
							<th class="col-xs-1" style="background-color:#f1f1f1">그룹설정</th>
							<td class="col-xs-5">
								<select name="gid" id="gid">
									<option>선택</option>
									<option>가망고객</option>
									<option>계약고객</option>
									<option>기타</option>
								</select>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">성별</th>
							<td class="col-xs-5">
								<label>
									<input type="radio" class="ace" name="sexual" id="sexual" value="남성" />
									<span class="lbl"> 남성</span>
								</label>

								<label>
									<input type="radio" class="ace" name="sexual" id="sexual" value="여성" />
									<span class="lbl"> 여성</span>
								</label>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">고객명</th>
							<td class="col-xs-5">
								<input type="text" name="name" id="name" />
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">친밀도</th>
							<td class="col-xs-5">
								<label>
									<input name="form-field-radio" type="radio" class="ace" name="closeness" id="closeness" value="★★★" checked />
									<span class="lbl"> 상</span>
								</label>

								<label>
									<input name="form-field-radio" type="radio" class="ace" name="closeness" id="closeness" value="★★☆" />
									<span class="lbl"> 중</span>
								</label>

								<label>
									<input name="form-field-radio" type="radio" class="ace" name="closeness" id="closeness" value="★☆☆" />
									<span class="lbl"> 하</span>
								</label>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">전화번호</th>
							<td class="col-xs-5">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-phone"></i>
									</span>

									<input class="form-control input-mask-phone" type="text" name="telephone" id="telephone" />
								</div>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">핸드폰번호</th>
							<td class="col-xs-5">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-phone"></i>
									</span>

									<input class="form-control input-mask-phone" type="text" id="form-field-mask-2" name="mobile" id="mobile" />
								</div>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">이메일</th>
							<td class="col-xs-5">
								<span class="input-icon">
									<input type="text" name="email1" id="email1" />
								</span> @

								<span class="input-icon input-icon-right">
									<input type="text" name="email2" id="email2" />
								</span>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">소개자</th>
							<td class="col-xs-5">
								<div class="input-group">
									<input type="text" class="form-control search-query" placeholder="" name="keyman" id="keyman" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											Search
										</button>
									</span>
								</div>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">주소</th>
							<td class="col-xs-5" colspan="3">
								<div class="input-group">
									<input type="text" class="form-control search-query" placeholder="우편번호" name="zipcode" id="zipcode" />
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
							<th class="col-xs-1" style="background-color:#f1f1f1">관계</th>
							<td class="col-xs-5" colspan="3">
								<select name="relation" id="relation">
									<option>선택</option>
									<option>가족</option>
									<option>친인척</option>
									<option>지인</option>
									<option>직장동료</option>
									<option>기타</option>
								</select>
							</td>
						</tr>
					</table>
				</div>
			</div><!-- /.row -->

			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					고객 직장정보
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						고객의 직장정보를 입력하시면 됩니다
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
							<th class="col-xs-1" style="background-color:#f1f1f1">직장명</th>
							<td class="col-xs-5">
								<input type="text" name="company" id="company" />
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">직업분류</th>
							<td class="col-xs-5">
								<select name="job" id="job">
									<option>선택</option>
									<option>경영.기획.HR.재무.사무</option>
									<option>마케팅.PR.무역.물류.배송</option>
									<option>영업.판매.CS상담.TM</option>
									<option>생산.기술.품질.연구개발</option>
									<option>IT.정보통신.인터넷</option>
									<option>전문자격특수직</option>
									<option>디자인</option>
									<option>신문방송.연예.광고제작</option>
									<option>기타</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">부서</th>
							<td class="col-xs-5">
								<input type="text" name="department" id="department" />
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">직위</th>
							<td class="col-xs-5">
								<input type="text" name="position" id="position" />
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">전화번호</th>
							<td class="col-xs-5">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-phone"></i>
									</span>

									<input class="form-control input-mask-phone" type="text" name="company_telephone" id="company_telephone" />
								</div>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">팩스번호</th>
							<td class="col-xs-5">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-phone"></i>
									</span>

									<input class="form-control input-mask-phone" type="text" name="company_fax" id="company_fax" />
								</div>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">주소</th>
							<td class="col-xs-5" colspan="3">
								<div class="input-group">
									<input type="text" class="form-control search-query" placeholder="우편번호" name="company_zipcode" id="company_zipcode" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											Search
										</button>
									</span>
								</div>
								<div style="margin-top:5px">
									<input type="text" class="form-control search-query" placeholder="주소" name="company_address" id="company_address" />
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div><!-- /.row -->

			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					고객 부가정보
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						고객의 부가정보를 입력하시면 됩니다
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
							<th class="col-xs-1" style="background-color:#f1f1f1">이메일수신</th>
							<td class="col-xs-5">
								<label>
									<input type="radio" class="ace" name="receive_email" id="receive_email" value="Y" checked />
									<span class="lbl"> 수신</span>
								</label>

								<label>
									<input type="radio" class="ace" name="receive_email" id="receive_email" value="N" />
									<span class="lbl"> 수신안함</span>
								</label>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">문자수신</th>
							<td class="col-xs-5">
								<label>
									<input type="radio" class="ace" name="receive_sms" id="receive_sms" value="Y" checked />
									<span class="lbl"> 수신</span>
								</label>

								<label>
									<input type="radio" class="ace" name="receive_sms" id="receive_sms" value="N" />
									<span class="lbl"> 수신안함</span>
								</label>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">출신지역</th>
							<td class="col-xs-5">
								<input type="text" name="area" id="area" />
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">출신학교</th>
							<td class="col-xs-5">
								<input type="text" name="school" id="school" />
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">블로그</th>
							<td class="col-xs-5">
								<input type="text" class="form-control" name="blog" id="blog" />
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">SNS</th>
							<td class="col-xs-5">
								<input type="text" class="form-control" name="sns" id="sns" />
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">주요관심사</th>
							<td class="col-xs-5">
								<input type="text" name="interest" id="interest" />
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">취미</th>
							<td class="col-xs-5">
								<select name="hobby" id="hobby">
									<option>선택</option>
									<option>운동</option>
									<option>독서</option>
									<option>수영</option>
									<option>음악감상</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">특기</th>
							<td class="col-xs-5">
								<input type="text" name="special" id="special" />
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">이전 직장</th>
							<td class="col-xs-5">
								<input type="text" name="pre_company" id="pre_company" />
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">흡연유무</th>
							<td class="col-xs-5">
								<label>
									<input type="radio" class="ace" name="smoking" id="smoking" value='흡연' />
									<span class="lbl"> 흡연</span>
								</label>

								<label>
									<input type="radio" class="ace" name="smoking" id="smoking" value='비흡연' />
									<span class="lbl"> 비흡연</span>
								</label>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">종교</th>
							<td class="col-xs-5">
								<select name="religion" id="religion">
									<option>선택</option>
									<option>기독교</option>
									<option>천주교</option>
									<option>불교</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">혈액형</th>
							<td class="col-xs-5" colspan="3">
								<select name="blood_group" id="blood_group">
									<option>선택</option>
									<option>A</option>
									<option>AB</option>
									<option>B</option>
									<option>O</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">기념일</th>
							<td class="col-xs-5">
								<div>
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input type="text" name="anniversary1" id="anniversary1" />
											<input class=" date-picker" name="anniversary_date1" id="anniversary_date1" type="text" data-date-format="dd-mm-yyyy" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</div>
								<div style="margin-top:3px">
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input type="text" name="anniversary2" id="anniversary2" />
											<input class=" date-picker" name="anniversary_date2" id="anniversary_date2" type="text" data-date-format="dd-mm-yyyy" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</div>
								<div style="margin-top:3px">
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input type="text" name="anniversary3" id="anniversary3" />
											<input class=" date-picker" name="anniversary_date3" id="anniversary_date3" type="text" data-date-format="dd-mm-yyyy" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</div>
								<div style="margin-top:3px">
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input type="text" name="anniversary4" id="anniversary4" />
											<input class=" date-picker" name="anniversary_date4" id="anniversary_date4" type="text" data-date-format="dd-mm-yyyy" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</div>
								<div style="margin-top:3px">
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input type="text" name="anniversary5" id="anniversary5" />
											<input class=" date-picker" name="anniversary_date5" id="anniversary_date5" type="text" data-date-format="dd-mm-yyyy" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</div>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">메모</th>
							<td class="col-xs-5">
								<textarea class="form-control" rows="9" name="memo" id="memo" placeholder="Default Text"></textarea>
							</td>
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

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/chosen.jquery.min.js"></script>
		<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/daterangepicker.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
			
			
			
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
						$(this).find('.chosen-container').each(function(){
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