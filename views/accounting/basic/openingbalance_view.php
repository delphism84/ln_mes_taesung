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
					계약등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						고객의 계약내용을 입력하시면 됩니다.
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
							<th class="col-xs-1" style="background-color:#f1f1f1">보험사</th>
							<td class="col-xs-5">
								<select name="ins_company" id="ins_company">
									<option <? if($t->ins_company == "삼성생명") echo "selected"; ?>>삼성생명</option>
									<option <? if($t->ins_company == "삼성화재") echo "selected"; ?>>삼성화재</option>
									<option <? if($t->ins_company == "한화생명") echo "selected"; ?>>한화생명</option>
									<option <? if($t->ins_company == "교보생명") echo "selected"; ?>>교보생명</option>
									<option <? if($t->ins_company == "AIG") echo "selected"; ?>>AIG</option>
									<option <? if($t->ins_company == "푸르덴셜") echo "selected"; ?>>푸르덴셜</option>
									<option <? if($t->ins_company == "KB화재") echo "selected"; ?>>KB화재</option>
								</select>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">증권번호</th>
							<td class="col-xs-5">
								<input type="text" name="contract_num" id="contract_num" value="<?=$t->contract_num?>" />
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">가입일</th>
							<td class="col-xs-5">
								<span class="input-icon input-icon-right">
									<div class="input-group">
										<input class=" date-picker" type="text" data-date-format="dd-mm-yyyy" name="join_date" id="join_date" value="<?=$t->join_date?>" />
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</span>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">만기일</th>
							<td class="col-xs-5">
								<span class="input-icon input-icon-right">
									<div class="input-group">
										<input class=" date-picker" type="text" data-date-format="dd-mm-yyyy" name="end_date" id="end_date" value="<?=$t->end_date?>" />
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</span>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">상품구분</th>
							<td class="col-xs-5">
								<select name="ins_div" id="ins_div">
									<option <? if($t->ins_div == "종신보험") echo "selected"; ?>>종신보험</option>
									<option <? if($t->ins_div == "연금보험") echo "selected"; ?>>연금보험</option>
									<option <? if($t->ins_div == "건강보험") echo "selected"; ?>>건강보험</option>
									<option <? if($t->ins_div == "단체보험") echo "selected"; ?>>단체보험</option>
									<option <? if($t->ins_div == "자녀보험") echo "selected"; ?>>자녀보험</option>
									<option <? if($t->ins_div == "화재보험") echo "selected"; ?>>화재보험</option>
								</select>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">납입년수</th>
							<td class="col-xs-5">
								<select name="payment_year" id="payment_year">
									<option>납입기간</option>
									<option <? if($t->payment_year == "5년") echo "selected"; ?>>5년</option>
									<option <? if($t->payment_year == "10년") echo "selected"; ?>>10년</option>
									<option <? if($t->payment_year == "20년") echo "selected"; ?>>20년</option>
								</select>
								<select name="guarantee_year" id="guarantee_year">
									<option <? if($t->guarantee_year == "5년") echo "selected"; ?>>5년</option>
									<option <? if($t->guarantee_year == "10년") echo "selected"; ?>>10년</option>
									<option <? if($t->guarantee_year == "20년") echo "selected"; ?>>20년</option>
									<option <? if($t->guarantee_year == "60세") echo "selected"; ?>>60세</option>
									<option <? if($t->guarantee_year == "100세") echo "selected"; ?>>100세</option>
									<option <? if($t->guarantee_year == "평생") echo "selected"; ?>>평생</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">납입보험료</th>
							<td class="col-xs-5" colspan="3">
								<input type="text" name="payment" id="payment" value="<?=$payment?>" />
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1">계약자</th>
							<td class="col-xs-5">
								<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class=" date-picker" type="text" data-date-format="dd-mm-yyyy" name="policyholder" id="policyholder" value="<?=$t->policyholder?>" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
							</td>
							<th class="col-xs-1" style="background-color:#f1f1f1">피보험자</th>
							<td class="col-xs-5">
								<input type="text" name="insurant" id="insurant" value="<?=$t->insurant?>" />
								<select name="relation" id="relation">
									<option <? if($t->relation == "삼성생명") echo "selected"; ?>>관계</option>
									<option <? if($t->relation == "본인") echo "selected"; ?>>본인</option>
									<option <? if($t->relation == "처") echo "selected"; ?>>처</option>
									<option <? if($t->relation == "자") echo "selected"; ?>>자</option>
									<option <? if($t->relation == "부") echo "selected"; ?>>부</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1"><a href="#modal-form" role="button" class="blue" data-toggle="modal"> 메모</a></th>
							<td class="col-xs-5" colspan="3">
								<textarea class="form-control" rows="9" name="memo" id="memo" placeholder="Default Text"><?=$t->memo?></textarea>
							</td>
						</tr>
					</table>
				</div>
			</div><!-- /.row -->

<div id="modal-form" class="modal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="blue bigger">Please fill the following form fields</h4>
</div>

<div class="modal-body">
<div class="row">
<div class="col-xs-12 col-sm-5">
<div class="space"></div>

<input type="file" />
</div>

<div class="col-xs-12 col-sm-7">
<div class="form-group">
<label for="form-field-select-3">Location</label>

<div>
<select class="chosen-select" data-placeholder="Choose a Country...">
<option value="">&nbsp;</option>
<option value="AL">Alabama</option>
</select>
</div>
</div>

<div class="space-4"></div>

<div class="form-group">
<label for="form-field-username">Username</label>

<div>
<input type="text" id="form-field-username" placeholder="Username" value="alexdoe" />
</div>
</div>

<div class="space-4"></div>

<div class="form-group">
<label for="form-field-first">Name</label>

<div>
<input type="text" id="form-field-first" placeholder="First Name" value="Alex" />
<input type="text" id="form-field-last" placeholder="Last Name" value="Doe" />
</div>
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button class="btn btn-sm" data-dismiss="modal">
<i class="ace-icon fa fa-times"></i>
Cancel
</button>

<button class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-check"></i>
Save
</button>
</div>
</div>
</div>
</div><!-- PAGE CONTENT ENDS -->

			
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