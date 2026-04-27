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
				<li class="active">일간일정</li>
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
					일간일정
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						일간의 일정을 보여드립니다.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- page -->
					<input type="hidden" name="page" id="page" value="1" />
					<input type="hidden" name="schedule_uid" id="schedule_uid" />
					<div>
						<div>
							<div>
								<div class="panel">
									<div id="schedule_info" class="mt10 info">
										<div class="fr">
											<input type="button" class="btn btn-success" value="일간일정" />
											<input type="button" class="btn btn-default" value="주간일정" onclick="location.href='index.php?controller=groupware&action=listPageScheduleWeek'" />
											<input type="button" class="btn btn-default" value="월간일정" onclick="location.href='index.php?controller=groupware&action=listPageScheduleMonth'" />
										</div>
											
										<div class="clear"></div>
											
										<?
										if($_GET['date']) {
											$date = $_GET['date'];
										} else {
											$date = date("Y-m-d");
										}
											
										// 기념일
										$query = "select * from erp_schedule where emp_id='".$_SESSION['login_id']."' and schedule_dt='$date' and anniversary='y'";
										$a_result = @mysql_query($query);

										if(@mysql_num_rows($a_result) > 0) {
										?>

										<table class="table mt10">
											<tr>
												<td class="gradient_orange" style="text-align:center;"><span style="font-size:14pt; font-weight:bold">기념일</span></td>
											</tr>
											<tr>
												<td>
													<?
													while($at = @mysql_fetch_object($a_result)) {
														echo $at->name." : ".$at->memo."<br>";
													}
													?>
												</td>
											</tr>
										</table>
										<?
										}
										?>
											
										<table id="schedule_list" class="table mt10">
											<colgroup>
												<col />
												<col />
												<col />
												<col />
												<col />
												<col />
											</colgroup>
											<thead>
												<tr>
													<th colspan="6" class="gradient_blue" style="text-align:center;"><span style="font-size:14pt"><?=$date?></span></th>
												</tr>
												<tr>
													<th class="gradient_orange">시간</th>
													<th class="gradient_orange">제목</th>
													<th class="gradient_orange">고객명</th>
													<th class="gradient_orange">장소</th>
													<th class="gradient_orange">메모</th>
													<th class="gradient_orange">관리</th>
												</tr>
											</thead>
											<?
											//$rowspan = Date('t');
											$rowspan = 24;
											?>
											<tbody>
											<?
											if(!$_GET['date']) $date = date('Y-m-d'); else $date = $_GET['date'];
											for($i = 1 ; $i <=$rowspan ; $i++) {
												if($i < 10) $i = "0".$i;
												$time = $i.":00";
												$query = "select * from erp_schedule where emp_id='".$_SESSION['login_id']."' and schedule_dt='$date' and schedule_tm='$time'";
												//echo $query;
												$result = @mysql_query($query);
												$item = @mysql_fetch_object($result);

												if($item->id) { //일정이 있다면
													$bg = "#e5e4e8"; 
													$btn = "<input type='button' data-popup-open='popup-2' value='관리' onclick='set_schedule_uid(".$item->id.")' />";
												} else {
													$bg = "#ffffff";
													$btn = "";
												}
											?>
												<tr style="background:<?=$bg?>;">
												<? // 같은 시간에 또 다른 일정이 있는 경우
												if(mysql_num_rows($result) < 2) {
												?>
													<td><?=$i?>:00</td>
													<td><?=$item->title?></td>
													<td>
													<?
													if($item->schedule_gb != "") echo "<span style='color:blue'>[".$item->schedule_gb."]</span></a>";
														?>
														&nbsp;<?= $item->name ?>
													</td>
													<td><?= $item->place ?></td>
													<td>
													<?
													if($item->importance == "상") echo "<span class='glyphicon glyphicon-star' style='color:red'></span><span class='glyphicon glyphicon-star' style='color:red'></span><span class='glyphicon glyphicon-star' style='color:red'></span>";
													else if($item->importance == "중") echo "<span class='glyphicon glyphicon-star' style='color:red'></span><span class='glyphicon glyphicon-star' style='color:red'></span>";
													else if($item->importance == "하") echo "<span class='glyphicon glyphicon-star' style='color:red'></span>";
													?>
														&nbsp;<?= $item->memo ?>					
													</td>
													<td>
														<?=$btn?>
													</td>
												<?
												} else {
													$query = "select * from erp_schedule where emp_id='".$_SESSION['login_id']."' and schedule_dt='$date' and schedule_tm='$time'";
													$result = @mysql_query($query);

													$promise_div = array();
													$name = array();
													$place = array();
													$memo = array();
													$btn = array();
													//echo mysql_num_rows($result);
													$k = 0;
													while($t = @mysql_fetch_object($result)) {
														$uid[$k] = $t->uid;
														$promise_div[$k] = $t->schedule_gb;
														$name[$k] = $t->name;
														$place[$k] = $t->place;
														$memo[$k] = $t->memo;
														$btn[$k] = "<input type='button' data-popup-open='popup-2' class='btn btn-xs btn-default' value='관리' onclick='set_schedule_uid(".$t->id.")' />";
														$k++;
													}

													//var_dump($uid);
												?>
													<td><?=$i?>:00</td>
													<td>
													<?
													for($k = 0 ; $k < sizeof($name) ; $k++) {
														echo "<div style='margin-top:3px'>";
														if($promise_div[$k] != "") echo "<span style='color:blue'>[".$promise_div[$k]."]</span></a>";
														echo "&nbsp;".$name[$k]."</div>";
													}
													?>
													</td>
													<td>
													<?
													for($k = 0 ; $k < sizeof($name) ; $k++) {
														echo "<div style='margin-top:3px'>".$place[$k]."</div>";
													}
													?>
													</td>
													<td>
													<?
													for($k = 0 ; $k < sizeof($name) ; $k++) {
														echo "<div style='margin-top:3px'>";
														if($item->importance == "상") echo "<span class='glyphicon glyphicon-star' style='color:red'></span><span class='glyphicon glyphicon-star' style='color:red'></span><span class='glyphicon glyphicon-star' style='color:red'></span>";
														else if($item->importance == "중") echo "<span class='glyphicon glyphicon-star' style='color:red'></span><span class='glyphicon glyphicon-star' style='color:red'></span>";
														else if($item->importance == "하") echo "<span class='glyphicon glyphicon-star' style='color:red'></span>";
														echo "&nbsp;".$memo[$k]."</div>";
													}
													?>	
													</td>
													<td>
													<?
													for($k = 0 ; $k < sizeof($name) ; $k++) {
														echo "<div>".$btn[$k]."</div>";
													}
													?>
													</td>
												<?
												}
												?>
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
</div>


<script>
function set_schedule_uid(uid){
	$("#schedule_uid").val(uid);
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