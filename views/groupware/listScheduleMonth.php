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
				<li class="active">월간일정</li>
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
					월간일정
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						월간의 일정을 보여드립니다.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">



	<!-- page -->
	<input type="hidden" name="page" id="page" value="1" />
	<div >

		<div>

			<div>
				<div class="panel">
					<div id="schedule_info" class="mt10 info">
						<div class="fr">
							<input type="button" class="btn btn-default" value="일간일정" onclick="location.href='index.php?controller=groupware&action=listPageScheduleDay'"/>
							<input type="button" class="btn btn-default" value="주간일정" onclick="location.href='index.php?controller=groupware&action=listPageScheduleWeek'" />
							<input type="button" class="btn btn-success" value="월간일정" />
						</div>
						
						<div class="clear"></div>
						<?
						if(!$_GET['date']) {
							$year = date('Y'); 
							$month = date('m'); 
						} else {
							$date = explode("-",$_GET['date']);
							$year = $date[0];
							$month = $date[1];
						}

						$time = strtotime($year.'-'.$month.'-01'); 
						list($tday, $sweek) = explode('-', date('t-w', $time));  // 총 일수, 시작요일 
						$tweek = ceil(($tday + $sweek) / 7);  // 총 주차 
						$lweek = date('w', strtotime($year.'-'.$month.'-'.$tday));  // 마지막요일 

						$stmptime = strtotime($year."-".$month."-".date('d')); 
						$prev_month = date("Y-m-d",strtotime("-1 month", $stmptime)); 
						$next_month = date("Y-m-d",strtotime("+1 month", $stmptime));
						?>
						
						<table class="table table-bordered mt10">
							<colgroup>
								<col width="14.2%"/>
								<col width="14.2%"/>
								<col width="14.2%"/>
								<col width="14.2%"/>
								<col width="14.2%"/>
								<col width="14.2%"/>
								<col width="14.2%"/>
							</colgroup>
							<thead>
								<tr>
									<td colspan="7" class="gradient_gray" style="text-align:center">
										<span><a href="index.php?controller=schedule&action=schedule_month&date=<?=$prev_month?>"  style="color:black; text-decoration:none">◀◀</a> </span>
										<span style="font-size:14pt; font-weight:bold"><?= $year."년 ".$month."월"?></span>
										<span> <a href="index.php?controller=schedule&action=schedule_month&date=<?=$next_month?>" style="color:black; text-decoration:none">▶▶</a></span>
									</td>
								</tr>
								<tr>
									<th class="gradient_red">일</th>
									<th class="gradient_blue">월</th>
									<th class="gradient_blue">화</th>
									<th class="gradient_blue">수</th>
									<th class="gradient_blue">목</th>
									<th class="gradient_blue">금</th>
									<th class="gradient_orange">토</th>
								</tr>
							</thead>
							<tbody>
							<? 
							for ($n=1,$i=0; $i<$tweek; $i++){
								echo "<tr>";
								for ($k=0; $k<7; $k++){
									echo "<td style='height:120px;cursor:pointer; vertical-align:top'>";
									
									if (!(($i == 0 && $k < $sweek) || ($i == $tweek-1 && $k > $lweek))){
										echo "<div style='width:30px; height:120px; float:left'>";
										echo $n++;
										echo "</div>";
										
										if($n-1 < 10) $day = "0".$n-1;
										else $day = $n-1;
										
										$day = str_pad($day,2, "0", STR_PAD_LEFT);

										$date = $year."-".$month."-".$day;
										$query = "select * from erp_schedule where emp_id='".$_SESSION['login_id']."' and schedule_dt='$date'";
										//echo $query;
										$result = mysql_query($query);
										echo "<div style='float:left; height:120px'>";
										while($t = mysql_fetch_object($result)){
											if($t->importance == "상") {
												echo "<span class='glyphicon glyphicon-star' style='color:red'></span><span class='glyphicon glyphicon-star' style='color:red'></span><span class='glyphicon glyphicon-star' style='color:red'></span>&nbsp;";
											} else if($t->importance == "중") {
												echo "<span class='glyphicon glyphicon-star' style='color:red'></span><span class='glyphicon glyphicon-star' style='color:red'></span>&nbsp;";
											} else if($t->importance == "하") {
												echo "<span class='glyphicon glyphicon-star' style='color:red'></span>&nbsp;";
											}

											if($t->title != "") echo "<span style='font-weight:bold' onclick='location.href = \"index.php?controller=groupware&action=modifyPageSchedule&uid=".$t->uid."\"'>".mb_substr($t->title,0,12, 'utf-8')."</span><br>";
											else echo "<span style='font-weight:bold' onclick='location.href = \"index.php?controller=groupware&action=modifyPageSchedule&uid=".$t->uid."\"'>".$t->name."</span><br>";
										}
										echo "</div>";
										echo "<div class='clear'></div>";
									}

									echo "</td>";
								}
								echo "</tr>";
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