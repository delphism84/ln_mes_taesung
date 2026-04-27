<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">그룹웨어</a>
				</li>
				<li class="active">일정등록</li>
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
					그룹웨어
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						일정을 등록합니다.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<form name="frm" id="frm" action="index.php" method="post">
						<input type="hidden" name="controller" id="controller" value="groupware" />
						<input type="hidden" name="action" id="action" value="registSchedule" />
						<table class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">제목</th>
								<td><input type="text" class="form-control" name="title" id="title" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">기념일여무</th>
								<td>
									<label>
										<input type="radio" class="ace" name="anniversary" id="isAnniversary" value="y" />
										<span class="lbl"> 기념일</span>
									</label>
									<label>
										<input type="radio" class="ace" name="anniversary" id="isAnniversary" value="n" checked />
										<span class="lbl"> 비기념일</span>
									</label>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">일정구분</th>
								<td>
									<label>
										<input type="radio" class="ace" name="schedule_gb" id="schedule_gb" value="개인" checked />
										<span class="lbl"> 개인</span>
									</label>
									<label>
										<input type="radio" class="ace" name="schedule_gb" id="schedule_gb" value="부서" />
										<span class="lbl"> 부서</span>
									</label>
									<label>
										<input type="radio" class="ace" name="schedule_gb" id="schedule_gb" value="사내" />
										<span class="lbl"> 사내</span>
									</label>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">고객명</th>
								<td><input type="text" name="name" id="name" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">약속일</th>
								<td>
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="schedule_dt" id="schedule_dt" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">약속시간</th>
								<td>
									<select name="schedule_tm" id="schedule_tm">
										<option value='09:00'>09:00</option>
										<option value='10:00'>10:00</option>
										<option value='11:00'>11:00</option>
										<option value='12:00'>12:00</option>
										<option value='13:00'>13:00</option>
										<option value='14:00'>14:00</option>
										<option value='15:00'>15:00</option>
										<option value='16:00'>16:00</option>
										<option value='17:00'>17:00</option>
										<option value='18:00'>18:00</option>
										<option value='19:00'>19:00</option>
										<option value='20:00'>20:00</option>
										<option value='21:00'>21:00</option>
										<option value='22:00'>22:00</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">약속장소</th>
								<td><input type="text" class="form-control" name="place" id="place" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">중요도</th>
								<td>
									<label>
										<input type="radio" class="ace" name="importance" id="importance" value="★★★" checked />
										<span class="lbl"> 상</span>
									</label>
									<label>
										<input type="radio" class="ace" name="importance" id="importance" value="★★☆" />
										<span class="lbl"> 중</span>
									</label>
									<label>
										<input type="radio" class="ace" name="importance" id="importance" value="★☆☆" />
										<span class="lbl"> 하</span>
									</label>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">메모</th>
								<td colspan="3"><textarea class="form-control" rows="10" name="memo" id="memo"></textarea></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="form_submit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						일정등록
					</button>

					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						Reset
					</button>
				</div>
			</div><!-- // submit -->
		</div>
	</div>
</div>

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

<script>
function form_submit(){
	$("#frm").submit();
}
</script>

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