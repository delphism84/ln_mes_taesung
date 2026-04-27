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
						ERP SYSTEM 의 환경을 설정합니다.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<div class="col-xs-12">
						<form name="frm" id="frm" method="post" action="index.php">
							<input type="hidden" name="controller" id="controller" value="config" />
							<input type="hidden" name="action" id="action" value="registConfig" />
							<h3 class="header smaller lighter green">공통</h3>
							<table id="simple-table" class="table table-bordered table-bordered">
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 자동으로 발주서 작성</th>
									<td class="col-xs-10">
										<input name="auto_purchase" id="auto_purchase" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->auto_purchase == "y") echo "checked"; ?> /><span class="lbl"></span>
										<span class="blue">* YES 로 설정시 전자결재 승인이 없어도 구매요청서가 자동으로 승인이 되어 발주서가 발행이 됩니다.</span>
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 작업지시서 강제 출력</th>
									<td class="col-xs-10">
										<input name="auto_work" id="auto_work" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->auto_work == "y") echo "checked"; ?> /><span class="lbl"></span>
										<span class="blue">* 생산불출이 이루어지지 않아도 작업지시서가 노출되게 설정합니다. <span style="color:red">NO 로 설정</span>을 하시면 자재출고가 이루어 지지 않은 작업지시서는 보이지 않습니다.</span>
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 생산입고시 자재불출 자동처리</th>
									<td class="col-xs-10">
										<input name="auto_release" id="auto_release" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->auto_release == "y") echo "checked"; ?> /><span class="lbl"></span>
										<span class="blue">* 작업지시서의 생산량에 의한 자재불출을 자동으로 처리하도록 설정합니다.</span>
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 자동으로 Lot No 생성</th>
									<td class="col-xs-10">
										<input name="auto_lotno" id="auto_lotno" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->auto_lotno == "y") echo "checked"; ?> /><span class="lbl"></span>
										<span class="blue">* 구매입고, 생산입고 시 자동으로 Lot No 가 생성이 됩니다.</span>
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 입출고 바코드 시스템 사용</th>
									<td class="col-xs-10">
										<input name="auto_barcode" id="auto_barcode" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->auto_barcode == "y") echo "checked"; ?> /><span class="lbl"></span>
										<span class="blue">* 모든 입출고 시스템에 수기 등록을 하지 않고 바코드 시스템을 사용합니다.</span>
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 각종 코드 자동생성</th>
									<td class="col-xs-10">
										<input name="auto_code" id="auto_code" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->auto_code == "y") echo "checked"; ?> /><span class="lbl"></span>
										<span class="blue">* 모든 입출고 시스템에 수기 등록을 하지 않고 바코드 시스템을 사용합니다.</span>
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 프로젝트 필수</th>
									<td class="col-xs-10">
										<input name="auto_project" id="auto_project" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->auto_project == "y") echo "checked"; ?> /><span class="lbl"></span>
										<span class="blue">* 모든 항목의 기준을 프로젝트를 기본으로 설정합니다.</span>
									</td>
								</tr>
							</table>
							<h3 class="header smaller lighter green">재고</h3>
							<table id="simple-table" class="table table-bordered table-bordered">
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 창고별 관리여부</th>
									<td class="col-xs-10">
										
										<div class="radio">
										<label>
											<input name="auto_safety_stock" value ='1' type="radio" class="ace" <? if($t->auto_safety_stock == "1" || $t->auto_safety_stock == "") echo "checked"; ?> />
											<span class="lbl"> 전체</span>
										</label>
										<label>
											<input name="auto_safety_stock" value ='2' type="radio" class="ace" <? if($t->auto_safety_stock == "2") echo "checked"; ?>/>
											<span class="lbl"> 창고별</span>
										</label>
										</div>
										<div>
										<pre><span class="blue">[확인사항]
▣ 안전재고는 전체창고 또는 창고별로 설정 가능합니다.
 - 전체 : 창고에 상관 없이 품목별로 안전재고를 적용 받습니다.
 - 창고별 : 창고별로 안전재고 설정이 가능합니다. 같은 품목이라도 창고별로 안전재고를 다르게 관리하는 경우에 사용합니다.
▣ 창고별에서 전체로 설정을 변경할 경우 창고별로 입력해 놓은 안전재고 수량은 삭제됩니다.
▣ 수량 이하로 떨어지게 되면 경고 메시지를 보여주거나 거래내역이 저장될 수 없도록 설정이 가능합니다.
▣ 품목을 등록할 때, 재고수량관리는 반드시 사용으로 설정합니다.
▣ 재고관리 > 재고현황/창고별 재고현황에서 안전재고수량 이하인 품목은 붉은색으로 나타납니다.</span></pre>
										</div>
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
