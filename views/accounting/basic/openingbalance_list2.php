<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">회계1</a>
				</li>
				<li class="active">기초잔액입력</li>
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
					기초잔액입력

					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						재무제표별 기초잔액입력
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<form method="post" action="" id="form1">
						<div class="aspNetHidden">
							<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="F2A94615" />
						</div>
						<div id="wrap">
							<div class="new-title">
								<div><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>재무제표별기초잔액입력</div>
							</div><!--endof 타이틀바-->
							<table id="contract_list" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th class="col-xs-1 center" style="background-color:#f1f1f1">재무제표</th><!--LBL02433-->
										<td style="background-color:#ffffff">
											<input type="radio" id="rbBS" name="rbGubun" onclick="fnSelect();" value="BS"  checked="checked" />재무상태표<br />
											<input type="radio" id="rbPL" name="rbGubun" onclick="fnSelect();" value="PL" />손익계산서<br />
											<input type="radio" id="rbCOST" name="rbGubun" onclick="fnSelect();" value="COST" />원가명세서
										</td>
									</tr>
									<tr>
										
										<th class="col-xs-1 center" style="background-color:#f1f1f1">부서</th>
										<td class="col-xs-5"style="background-color:#ffffff">
											<div class="input-group">
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input type="text" name="site" id="txtSiteCd" size="20"/>
														<span class="input-group-addon btn-purple">
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff;width:22px;height:19px;cursor:pointer;" onclick="search_code('site','','','double','txtSiteCd',event);" alt="부서" data-toggle="modal" data-target="#mySite"></i>
														</span>
														<span>&nbsp;</span>
														<input type="text" name="site_des" id="txtSiteDes" style="width:100px;" value="" class="grayleft"  readonly />
													</div>
												</span>
											</div>
										</td>
									</tr>
									<tr>
										
										<th class="col-xs-1 center" style="background-color:#f1f1f1">프로젝트</th>
										<td class="col-xs-5" style="background-color:#ffffff">
											<div class="input-group">
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input type="text" name="pjt_cd" id="pjt_cd" size="20"/>
														<span class="input-group-addon btn-purple">
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff;width:22px;height:19px;cursor:pointer;" onclick="search_code('pjt_cd','','','double','pjt_cd',event);" alt="프로젝트검색" data-toggle="modal" data-target="#myPjt"></i>
														</span>
														<span>&nbsp;</span>
														<input id="pjt_des" type="text" name="pjt_des" class="grayleft" value="" size="30" readonly="readonly" style="width:100px;"/>
													</div>
												</span>
											</div>
										</td>
									</tr>
									<tr>
										<th class="col-xs-1 center" style="background-color:#f1f1f1">기초잔액입력월</th>
										<td style="background-color:#ffffff"><span class="Pink_strong"><label id="lblYYMM">2011년 12월</label></span>&nbsp;&nbsp;<a href="#" name="btnChangeMonth" id="btnChangeMonth" class="link-red" onclick="search_code('site','','','double','txtSiteCd',event);" alt="부서" data-toggle="modal" data-target="#myBasicmoney">기초잔액입력월변경</a></td>
									</tr>
										<input type="hidden" name="yymm" id="yymm" value="201112" />
										<input type="hidden" name="sum_type" id="sum_type" value="1" />
								</thead>
							</table>
							<div class="">
								<input type="button" name="btnInput" class="btn btn-primary" id="Button1" onclick="sendit();" value='신규' />
								<!-- <button type="submit" class="btn btn-primary">신규</button> -->
							</div><!-- /.footerBG -->
						</div> <!--/.wap end--> 
							<input type="hidden" id="hidSearchXml" name="hidSearchXml" />
							<input type="hidden" name="hidFavSeq" id="hidFavSeq"/>
					</form>
				</div>
			</div><!-- /.row -->

	</div>
</div><!-- /.main-content -->
	<style type="text/css">
		.modal-header {
		padding: 2px 5px;
		border-bottom: 1px solid #eee;
		background-color: #0480be;
		-webkit-border-top-left-radius: 6px;
		-webkit-border-top-right-radius: 6px;
		-moz-border-radius-topleft: 6px;
		-moz-border-radius-topright: 6px;
		border-top-left-radius: 6px;
		border-top-right-radius: 6px;
		}
	</style>
	<!-- 모달 팝업 -->
	<div class="modal fade" id="mySite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header" style="height:30px;background-color:#0080c0;">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h5 class="modal-title" id="myModalLabel">부서</h5>
	      </div>
	      <div class="modal-body">
			<iframe src="/views/accounting/basic/openingbalance_site_p.php" style ="width:100%;height:300px" scrolling="yes" frameborder="0"></iframe>
	      </div>
	      <!-- <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
	      </div> -->
	    </div>
	  </div>
	</div>

	<!-- 모달 팝업 -->
	<div class="modal fade" id="myPjt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	  <div class="modal-dialog">
	    <div class="modal-content" >
	      <div class="modal-header" style="height:30px;back;background-color:#0080c0;">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h5 class="modal-title" id="myModalLabel">부서</h5>
	      </div>
	      <div class="modal-body">
			<iframe src="/views/accounting/basic/openingbalance_site_p.php" style ="width:100%;height:300px" scrolling="yes" frameborder="0"></iframe>
	      </div>
	      <!-- <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
	      </div> -->
	    </div>
	  </div>
	</div>

	<!-- 모달 팝업 -->
	<div class="modal fade" id="myBasicmoney" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	  <div class="modal-dialog">
	    <div class="modal-content" >
	      <div class="modal-header" style="height:30px;back;background-color:#0080c0;">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h5 class="modal-title" id="myModalLabel">기초잔액연월변경</h5>
	      </div>
	      <div class="modal-body">
			<iframe src="/views/accounting/basic/openingbalance_basicmoney_p.php" style ="width:100%;height:300px" scrolling="yes" frameborder="0"></iframe>
	      </div>
	      <!-- <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
	      </div> -->
	    </div>
	  </div>
	</div>


<!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script>

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