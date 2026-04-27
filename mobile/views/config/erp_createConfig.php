<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">환경설정</a>
				</li>
				<li class="active">환경설정</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					환경설정
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						ERP SYSTEM 의 환경을 설정합니다.1
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
							<div class="col-xs-12">
								<form name="frm" id="frm" method="post" action="index.php">
									<input type="hidden" name="controller" id="controller" value="config" />
									<input type="hidden" name="action" id="action" value="registConfig" />

									<table id="simple-table" class="table table-bordered table-bordered">
										<tr>
											<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 품목코드 자동생성</th>
											<td class="col-xs-10">
												<input name="item_code_auto_create" id="item_code_auto_create" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_code_auto_create == "y") echo "checked"; ?> /><span class="lbl"></span>
												<span class="blue">* YES 로 설정시 품목구분을 선택하시면 품목코드가 자동으로 생성됩니다.</span>
											</td>
										</tr>
										<tr>
											<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 견적서 필수</th>
											<td class="col-xs-10">
												<input name="essential_estimate" id="essential_estimate" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->essential_estimate == "y") echo "checked"; ?> /><span class="lbl"></span>
												<span class="blue">* YES 로 설정시 수주를 단독으로 등록할 수 없고, 견적서를 먼저 생성 후 수주를 등록할 수 있습니다.</span>
											</td>
										</tr>
										<tr>
											<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 견적서 전자결재</th>
											<td class="col-xs-10">
												<input name="estimate_use_approval" id="estimate_use_approval" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->estimate_use_approval == "y") echo "checked"; ?> /><span class="lbl"></span>
												<span class="blue">* YES 로 설정시 전자결재 승인이 없어도 구매요청서가 자동으로 승인이 되어 발주서가 발행이 됩니다.</span>
											</td>
										</tr>
										<tr>
											<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 구매요청서 전자결재</th>
											<td class="col-xs-10">
												<input name="purchase_use_approval" id="purchase_use_approval" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->purchase_use_approval == "y") echo "checked"; ?> /><span class="lbl"></span>
												<span class="blue">* 생산불출이 이루어지지 않아도 작업지시서가 노출되게 설정합니다. <span style="color:red">NO 로 설정</span>을 하시면 자재출고가 이루어 지지 않은 작업지시서는 보이지 않습니다.</span>
											</td>
										</tr>
										<tr>
											<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 출하지시서 전자결재</th>
											<td class="col-xs-10">
												<input name="shipment_use_approval" id="shipment_use_approval" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->shipment_use_approval == "y") echo "checked"; ?> /><span class="lbl"></span>
												<span class="blue">* 작업지시서의 생산량에 의한 자재불출을 자동으로 처리하도록 설정합니다.</span>
											</td>
										</tr>
										<tr>
											<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 지출결의서 전자결재</th>
											<td class="col-xs-10">
												<input name="spending_use_approval" id="spending_use_approval" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->spending_use_approval == "y") echo "checked"; ?> /><span class="lbl"></span>
												<span class="blue">* 구매입고, 생산입고 시 자동으로 Lot No 가 생성이 됩니다.</span>
											</td>
										</tr>
										<tr>
											<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 생산팀 이용</th>
											<td class="col-xs-10">
												<input name="spending_use_approval" id="spending_use_approval" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->spending_use_approval == "y") echo "checked"; ?> /><span class="lbl"></span>
												<span class="blue">* 구매입고, 생산입고 시 자동으로 Lot No 가 생성이 됩니다.</span>
											</td>
										</tr>
										<tr>
											<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 프로젝트 기반</th>
											<td class="col-xs-10">
												<input name="spending_use_approval" id="spending_use_approval" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->spending_use_approval == "y") echo "checked"; ?> /><span class="lbl"></span>
												<span class="blue">* 구매입고, 생산입고 시 자동으로 Lot No 가 생성이 됩니다.</span>
											</td>
										</tr>
										<tr>
											<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 작업지시서</th>
											<td class="col-xs-10">
												<input name="spending_use_approval" id="spending_use_approval" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->spending_use_approval == "y") echo "checked"; ?> /><span class="lbl"></span>
												<span class="blue">* 작업에 필요한 자재가 없어도 작업지시를 내릴 수 있습니다</span>
											</td>
										</tr>
										<tr>
											<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 검색구분사용</th>
											<td class="col-xs-10">
												<input name="use_search_classify" id="use_search_classify" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->use_search_classify == "y") echo "checked"; ?> /><span class="lbl"></span>
												<span class="blue">* 검색시 구분값을 사용하는 지</span>
											</td>
										</tr>
									</table>
								</form>
							</div>
							<div class="clearfix center" style="margin-top:0px">
								<div class="col-md-12">
									<button class="btn btn-info" type="button" onclick="formSubmit()">
										<i class="ace-icon fa fa-check bigger-110"></i>
										등록
									</button>

									&nbsp; &nbsp; &nbsp;
									<button class="btn" type="reset" onclick="location.href = 'index.php?controller=base&action=listPageEmployee' ">
										<i class="ace-icon fa fa-undo bigger-110"></i>
										목록 돌아가기
									</button>
								</div>
							</div>
						</div>

			</div><!-- /.row -->

			
			
			<!-- submit -->
			
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<?
require_once ("assets/include_script.php");
?>

<script>
function formSubmit(){
	$("#frm").submit();
}
</script>

<!----------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-mobile').mask('(999) 9999-9999');
	$('.input-mask-telephone').mask('(999) 999-9999');
	$('.input-mask-registno').mask('999999-9999999');
	$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
	$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});

	//override dialog's title function to allow for HTML titles
	$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
		_title: function(title) {
			var $title = this.options.title || '&nbsp;'
			if( ("title_html" in this.options) && this.options.title_html == true )
				title.html($title);
			else title.text($title);
		}
	}));
	
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
});
</script>
<!----------------------------------------------------------------------------------------------------------------------->
