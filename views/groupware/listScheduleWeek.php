<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">일정관리</a>
				</li>
				<li class="active">주간일정</li>
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
					주간일정
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						주간의 일정을 보여드립니다.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">

	<!-- page -->
	<input type="hidden" name="page" id="page" value="1" />
	<div>

		<div>

			<div>
				<div>
					<div id="schedule_info">
						<div class="fr">
							<input type="button" class="btn btn-default" value="일간일정" onclick="location.href='index.php?controller=groupware&action=listPageScheduleDay'" />
							<input type="button" class="btn btn-success" value="주간일정"  />
							<input type="button" class="btn btn-default" value="월간일정" onclick="location.href='index.php?controller=groupware&action=listPageScheduleMonth'" />
						</div>
						
						<div class="clear"></div> 
						<? 
						// 1주일간 뽑아내기 
						$year = date('Y');
						$month = date('m');
						$day = date('d');

						$cur_day = date("w",mktime(0,0,0,$month,$day,$year)); 
						$now = date("Y-n-d",mktime(0,0,0,$month,$day,$year)); 
						$minus_day = 6 - $cur_day; 
						$week_first = date("Y년 m월 d일",mktime(0,0,0,$month,$day - $cur_day,$year)); 
						$week_last = date("Y년 m월 d일",mktime(0,0,0,$month,$day + $minus_day,$year)); 
						?>
						<table id="schedule_list" class="table mt10">
							<colgroup>
								<col width="100"/>
								<col />
							</colgroup>
							<thead>
								<tr>
									<th colspan="4" class="gradient_blue" style="text-align:center;"><span style="font-size:14pt"><?=$week_first." ~ ".$week_last?></span></th>
								</tr>
								<tr>
									<th class="center gradient_orange">날짜</th>
									<th class="center gradient_orange">일정</th>
								</tr>
							</thead>
							<tbody>
							<? 
							for($i = 0;$i <= 6;$i++) { 
								// 테이블 색상 -> 현재일 
								if($now == date("Y-n-d",mktime(0,0,0,$month,$day - $cur_day + $i,$year))) {
									$bgcolor = "#DDEEFF"; 
								} else {
									$bgcolor = "white"; 
								}
								// 글자 색 -> 일,토 
								if($i == 0) {
									$font = "red"; 
								} elseif($i == 6) {
									$font = "blue"; 
								} else {
									$font = "black"; 
								}
								// 요일 표시하기 
								switch($i) { 
									case("0"):$yoil = " (일)";break; 
									case("1"):$yoil = " (월)";break; 
									case("2"):$yoil = " (화)";break; 
									case("3"):$yoil = " (수)";break; 
									case("4"):$yoil = " (목)";break; 
									case("5"):$yoil = " (금)";break; 
									default:$yoil = " (토)"; 
								} 
							?>
								<tr>
									<td bgcolor='<?echo$bgcolor?>'  style='color:<?echo$font?>' height="100">
										<?
										$check_date = date("j",mktime(0,0,0,$month,$day - $cur_day + $i,$year));
										//echo $check_date."<br>";
										
										if($check_date < 10) $date = date("Y-m")."-0".$check_date;
										else $date = date("Y-m")."-".$check_date;

										echo date("j",mktime(0,0,0,$month,$day - $cur_day + $i,$year)).$yoil;
										?>
									</td>
									<td colspan="3" bgcolor='<?echo$bgcolor?>'  style='color:<?echo$font?>'>
									<?
									$query = "select * from erp_schedule where emp_id='".$_SESSION['login_id']."' and schedule_dt='$date'";
									$result = mysql_query($query);
									while($t = mysql_fetch_object($result)){
										if($t->importance == "상") echo "<span class='glyphicon glyphicon-star' style='color:red'></span><span class='glyphicon glyphicon-star' style='color:red'></span><span class='glyphicon glyphicon-star' style='color:red'></span>&nbsp;";
										else if($t->importance == "중") echo "<span class='glyphicon glyphicon-star' style='color:red'></span><span class='glyphicon glyphicon-star' style='color:red'></span>&nbsp;";
										else if($t->importance == "하") echo "<span class='glyphicon glyphicon-star' style='color:red'></span>&nbsp;";
										echo "[".$t->schedule_tm." - ".$t->schedule_gb."] - ".$t->title." - ".$t->name." - ".$t->place." - ".$t->memo."<br>";
									}
									?>
									</td>
								</tr>
							<? 
							} 
							?> 
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>
</div>
</div>
</div>

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