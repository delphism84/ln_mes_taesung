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
					상담등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						고객과의 상담내용을 입력하시면 됩니다.
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
							<th class="col-xs-1" style="background-color:#f1f1f1">상담일자</th>
							<td class="col-xs-5">
								<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class=" date-picker" type="text" data-date-format="dd-mm-yyyy" name="counsel_date" id="counsel_date" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">상담시간</th>
							<td class="col-xs-5">
								<select name="counsel_time" id="counsel_time">
									<option>AM 09:00</option>
									<option>AM 10:00</option>
									<option>AM 11:00</option>
									<option>AM 12:00</option>
									<option>PM 01:00</option>
									<option>PM 02:00</option>
									<option>PM 03:00</option>
									<option>PM 04:00</option>
									<option>PM 05:00</option>
									<option>PM 06:00</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">고객명</th>
							<td class="col-xs-5">
								<input type="text" name="name" id="name" />
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">상담유형</th>
							<td class="col-xs-5">
								<select name="process" id="process">
									<option>사전방문</option>
									<option>OP</option>
									<option>OP2</option>
									<option>OP3</option>
									<option>PC</option>
									<option>PC2</option>
									<option>접수</option>
									<option>증권전달</option>
									<option>소개요청 OP</option>
									<option>기타</option>
								</select>

								<select name="contact_type" id="contact_type">
									<option>전화방문</option>
									<option>직접방문</option>
									<option>인근방문</option>
									<option>소개요청</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">호응도</th>
							<td class="col-xs-5" colspan="3">
								<label>
									<input type="radio" class="ace" name="response" id="response" value="★★★" checked />
									<span class="lbl"> 상</span>
								</label>
								<label>
									<input type="radio" class="ace" name="response" id="response" value="★★☆" />
									<span class="lbl"> 중</span>
								</label>
								<label>
									<input type="radio" class="ace" name="response" id="response" value="★☆☆" />
									<span class="lbl"> 하</span>
								</label>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">상담내용</th>
							<td class="col-xs-5" colspan="3">
								<textarea class="form-control" rows="9" name="counsel" id="counsel" placeholder="Default Text"></textarea>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">약속일</th>
							<td class="col-xs-5">
								<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class=" date-picker" type="text" data-date-format="dd-mm-yyyy" name="next_counsel_date" id="next_counsel_date" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">약속시간</th>
							<td class="col-xs-5">
								<select name="next_counsel_time" id="next_counsel_time">
									<option>AM 09:00</option>
									<option>AM 10:00</option>
									<option>AM 11:00</option>
									<option>AM 12:00</option>
									<option>PM 01:00</option>
									<option>PM 02:00</option>
									<option>PM 03:00</option>
									<option>PM 04:00</option>
									<option>PM 05:00</option>
									<option>PM 06:00</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">다음진행 프로세스</th>
							<td class="col-xs-5" colspan="3">
								<select name="next_process" id="next_process">
									<option>사전방문</option>
									<option>OP</option>
									<option>OP2</option>
									<option>OP3</option>
									<option>PC</option>
									<option>PC2</option>
									<option>접수</option>
									<option>증권전달</option>
									<option>소개요청 OP</option>
									<option>기타</option>
								</select>
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