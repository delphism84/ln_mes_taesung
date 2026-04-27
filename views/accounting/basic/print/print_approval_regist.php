<?
$obj = new AccountingController;
$uid = "19";
$result = $obj->test($uid);

$approval_name1 = $result[approval_name1];
$approval_width1 = $result[approval_width1];
$approval_font1 = $result[approval_font1];
$approval_name2 = $result[approval_name2];
$approval_width2 = $result[approval_width2];
$approval_font2 = $result[approval_font2];

$approval_name1_arr = explode(",", $approval_name1);
$approval_width1_arr = explode(",", $approval_width1);
$approval_font1_arr = explode(",", $approval_font1);
$approval_name2_arr = explode(",", $approval_name2);
$approval_width2_arr = explode(",", $approval_width2);
$approval_width2_arr = explode(",", $approval_width2);

?>
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
					인쇄용결재라인등록(회계)
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						인쇄용결재라인등록(회계)
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<!-- 테이블 -->
					<!-- 서브제목과 라인 -->
					<form id="ac_frm" method="post" action="index.php">
					<input type="hidden" name="controller" id="controller" value="accounting" />
					<input type="hidden" name="action" id="action" value="registPrintAppLineInsert" />
					<div class="col-xs-12">
						<h4>
							<i class="ace-icon fa fa-chevron-circle-right"></i> 결재라인 1 
						</h4>
					</div>
					<table id="account_code_list" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th class="col-xs-3 center" style="background-color:#f1f1f1"></th>
								<th class="col-xs-3 center" style="background-color:#f1f1f1">명칭</th>
								<th class="col-xs-3 center" style="background-color:#f1f1f1">가로크기(px)</th>
								<th class="col-xs-3 center" style="background-color:#f1f1f1">글자크기(px)</th>
							</tr>
						</thead>
						<tbody>
							<? for ($i=0 ; $i < 10; $i++) {?>
							<tr>
								<? if ($i==0) {?>
								<th class="col-xs-3" style="background-color:#f1f1f1">결재라인</th>
								<?}else{?>
								<th class="col-xs-3" style="background-color:#f1f1f1">결재자<?=$i?></th>
								<?}?>
								<td class="col-xs-3">
									<input type="text" name="approval_name1[]" id="approval_name_<?=($i)?>" value="<?=$approval_name1_arr[$i]?>"/>
								</td>
								<td class="col-xs-3">
									<input type="text" name="approval_width1[]" id="approval_width_<?=($i)?>" value="<?=$approval_width1_arr[$i]?>"/>
								</td>
								<td class="col-xs-3">
								<select name="approval_font1[]" id="approval_font_<?=($i)?>">
									<option value="9" <?echo ($approval_font1_arr[$i]=="9") ? "selected":"" ?>>9px</option>
									<option value="10" <?echo ($approval_font1_arr[$i]=="10") ? "selected":"" ?>>10px</option>
									<option value="11" <?echo ($approval_font1_arr[$i]=="11") ? "selected":"" ?>>11px</option>
									<option value="12" <?echo ($approval_font1_arr[$i]=="12") ? "selected":"" ?>>12px</option>
									<option value="13" <?echo ($approval_font1_arr[$i]=="13") ? "selected":"" ?>>13px</option>
									<option value="14" <?echo ($approval_font1_arr[$i]=="14") ? "selected":"" ?>>14px</option>
									<option value="15" <?echo ($approval_font1_arr[$i]=="15") ? "selected":"" ?>>15px</option>
									<option value="16" <?echo ($approval_font1_arr[$i]=="16") ? "selected":"" ?>>16px</option>
									<option value="17" <?echo ($approval_font1_arr[$i]=="17") ? "selected":"" ?>>17px</option>
									<option value="18" <?echo ($approval_font1_arr[$i]=="18") ? "selected":"" ?>>18px</option>
									<option value="19" <?echo ($approval_font1_arr[$i]=="19") ? "selected":"" ?>>19px</option>
									<option value="20" <?echo ($approval_font1_arr[$i]=="20") ? "selected":"" ?>>20px</option>
								</select>
							</td>
							</tr>
							<?}	?>
						</tbody>
					</table>

					<div class="col-xs-12">
						<h4>
							<i class="ace-icon fa fa-chevron-circle-right"></i> 결재라인 2
						</h4>
					</div>
					<table id="account_code_list" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th class="col-xs-3 center" style="background-color:#f1f1f1"></th>
								<th class="col-xs-3 center" style="background-color:#f1f1f1">명칭</th>
								<th class="col-xs-3 center" style="background-color:#f1f1f1">가로크기(px)</th>
								<th class="col-xs-3 center" style="background-color:#f1f1f1">글자크기(px)</th>
							</tr>
						</thead>
						<tbody>
							<? for ($j=0 ; $j < 10; $j++) {?>
							<tr>
								<? if ($j==0) {?>
								<th class="col-xs-3" style="background-color:#f1f1f1">결재라인</th>
								<?}else{?>
								<th class="col-xs-3" style="background-color:#f1f1f1">결재자<?=$j?></th>
								<?}?>
								<td class="col-xs-3">
									<input type="text" name="approval_name2[]" id="approval_name2_<?=($j)?>" value="<?=$approval_name2_arr[$j]?>"/>
								</td>
								<td class="col-xs-3">
									<input type="text" name="approval_width2[]" id="approval_width2_<?=($j)?>" value="<?=$approval_width2_arr[$j]?>"/>
								</td>
								<td class="col-xs-3">
								<select name="approval_font2[]" id="approval_font2_<?=($j)?>">
									<option value="9" <?echo ($approval_font2_arr[$j]=="9") ? "selected":"" ?>>9px</option>
									<option value="10" <?echo ($approval_font2_arr[$j]=="10") ? "selected":"" ?>>10px</option>
									<option value="11" <?echo ($approval_font2_arr[$j]=="11") ? "selected":"" ?>>11px</option>
									<option value="12" <?echo ($approval_font2_arr[$j]=="12") ? "selected":"" ?>>12px</option>
									<option value="13" <?echo ($approval_font2_arr[$j]=="13") ? "selected":"" ?>>13px</option>
									<option value="14" <?echo ($approval_font2_arr[$j]=="14") ? "selected":"" ?>>14px</option>
									<option value="15" <?echo ($approval_font2_arr[$j]=="15") ? "selected":"" ?>>15px</option>
									<option value="16" <?echo ($approval_font2_arr[$j]=="16") ? "selected":"" ?>>16px</option>
									<option value="17" <?echo ($approval_font2_arr[$j]=="17") ? "selected":"" ?>>17px</option>
									<option value="18" <?echo ($approval_font2_arr[$j]=="18") ? "selected":"" ?>>18px</option>
									<option value="19" <?echo ($approval_font2_arr[$j]=="19") ? "selected":"" ?>>19px</option>
									<option value="20" <?echo ($approval_font2_arr[$j]=="20") ? "selected":"" ?>>20px</option>
								</select>
							</td>
							</tr>
							<?}	?>
						</tbody>
					</table>
					</form>
				</div>
			</div><!-- /.row -->

		<!-- PAGE CONTENT ENDS -->
		<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						저장
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


<script type="text/javascript">
<!--
	function formSubmit(){
	if(!check_str($("#approval_name_0").val(),"결재라인1")) return false;
	if(!check_str($("#approval_name_1").val(),"결재자 명칭")) return false;
	if(!check_str($("#approval_width_1").val(),"가로크기")) return false;

	$("#ac_frm").submit();
}
//-->
</script>


		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>
		<script src="assets/js/common.js"></script>

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