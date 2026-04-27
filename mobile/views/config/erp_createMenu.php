<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">
		<!-- 페이지 상단 Location -->
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#"><?=$controller_txt?></a>
				</li>
				<li class="active"><?=$action_txt?></li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1><?=$action_txt?></h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<div class="col-xs-12">
						<form name="frm" id="frm" method="post" action="index.php">
							<input type="hidden" name="controller" id="controller" value="config" />
							<input type="hidden" name="action" id="action" value="registMenu" />
							<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />
							
							<h4>기준정보관리</h4>
							<table id="simple-table" class="table table-bordered table-bordered">
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 품목관리</th>
									<td class="col-xs-2">
										<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 거래처관리</th>
									<td class="col-xs-2">
										<input name="account_menu" id="account_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->account_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 부서관리</th>
									<td class="col-xs-2">
										<input name="department_menu" id="department_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->department_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 직위관리</th>
									<td class="col-xs-2">
										<input name="position_menu" id="position_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->position_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 사원관리</th>
									<td class="col-xs-2">
										<input name="employee_menu" id="employee_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->employee_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 창고등록</th>
									<td class="col-xs-2">
										<input name="warehouse_menu" id="warehouse_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->warehouse_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 공정등록</th>
									<td class="col-xs-2">
										<input name="process_menu" id="process_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->process_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 생산기기등록</th>
									<td class="col-xs-2">
										<input name="machine_menu" id="machine_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->machine_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 프로젝트관리</th>
									<td class="col-xs-2">
										<input name="project_menu" id="project_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->project_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 엑셀자료등록</th>
									<td class="col-xs-2">
										<input name="excel_menu" id="excel_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->excel_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
							</table>

							<h4>영업관리</h4>
							<table id="simple-table" class="table table-bordered table-bordered">
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 거래명세서</th>
									<td class="col-xs-2">
										<input name="trade_menu" id="trade_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->trade_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 견적관리</th>
									<td class="col-xs-2">
										<input name="estimate_menu" id="estimate_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->estimate_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 수주(주문)관리</th>
									<td class="col-xs-2">
										<input name="order_menu" id="order_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->order_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 출하관리</th>
									<td class="col-xs-2">
										<input name="shipment_menu" id="shipment_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->shipment_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> AS관리</th>
									<td class="col-xs-2">
										<input name="as_menu" id="as_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->as_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 미수금관리</th>
									<td class="col-xs-2">
										<input name="receive_menu" id="receive_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->receive_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 매출계획</th>
									<td class="col-xs-2">
										<input name="sale_plan_menu" id="sale_plan_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->sale_plan_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
							</table>

							<h4>구매관리</h4>
							<table id="simple-table" class="table table-bordered table-bordered">
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 구매요청</th>
									<td class="col-xs-2">
										<input name="demand_menu" id="purchase_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->demand_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 발주계획</th>
									<td class="col-xs-2">
										<input name="purchase_plan_menu" id="purchase_plan_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->purchase_plan_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 발주서</th>
									<td class="col-xs-2">
										<input name="purchase_menu" id="purchase_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->purchase_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 구매(입고)</th>
									<td class="col-xs-2">
										<input name="purchase_item_menu" id="purchase_item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->purchase_item_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 미지급금관리</th>
									<td class="col-xs-2">
										<input name="amount_menu" id="amount_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->amount_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
							</table>

							<h4>생산관리</h4>
							<table id="simple-table" class="table table-bordered table-bordered">
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> BOM(소요량)</th>
									<td class="col-xs-2">
										<input name="bom_menu" id="bom_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->bom_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> BOM(소요량) 계산</th>
									<td class="col-xs-2">
										<input name="bom_cal_menu" id="bom_cal_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->bom_cal_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 외주공장관리</th>
									<td class="col-xs-2">
										<input name="outsourcing_menu" id="outsourcing_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->outsourcing_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 생산계획</th>
									<td class="col-xs-2">
										<input name="workplan_menu" id="workplan_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->workplan_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 생산계획별 소요 자재 현황 조회</th>
									<td class="col-xs-2">
										<input name="workplan_bom_menu" id="workplan_bom_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->workplan_bom_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 작업지시서</th>
									<td class="col-xs-2">
										<input name="work_menu" id="work_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->work_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 품질관리(QC)</th>
									<td class="col-xs-2">
										<input name="qc_menu" id="qc_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->qc_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 불량관리</th>
									<td class="col-xs-2">
										<input name="defective_menu" id="defective_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->defective_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
							</table>

							<h4>재고관리</h4>
							<table id="simple-table" class="table table-bordered table-bordered">
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 창고재고관리</th>
									<td class="col-xs-2">
										<input name="warehouse_stock_menu" id="warehouse_stock_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->warehouse_stock_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 단가관리</th>
									<td class="col-xs-2">
										<input name="price_menu" id="price_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->price_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 재고현황</th>
									<td class="col-xs-2">
										<input name="stock_menu" id="stock_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->stock_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 자재출고관리</th>
									<td class="col-xs-2">
										<input name="release_menu" id="release_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->release_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 바코드관리</th>
									<td class="col-xs-2">
										<input name="barcode_menu" id="barcode_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->barcode_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 재고실사</th>
									<td class="col-xs-2">
										<input name="real_stock_menu" id="real_stock_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->real_stock_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 안전재고관리</th>
									<td class="col-xs-2">
										<input name="safety_menu" id="safety_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->safety_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
							</table>

							<h4>그룹웨어</h4>
							<table id="simple-table" class="table table-bordered table-bordered">
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 전자결재</th>
									<td class="col-xs-2">
										<input name="ele_menu" id="ele_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->ele_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 고객관리(CRM)</th>
									<td class="col-xs-2">
										<input name="crm_menu" id="crm_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->crm_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 업무공유</th>
									<td class="col-xs-2">
										<input name="board_menu" id="board_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->board_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 일정관리</th>
									<td class="col-xs-2">
										<input name="schedule_menu" id="schedule_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->schedule_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 출퇴근관리</th>
									<td class="col-xs-2">
										<input name="leave_menu" id="leave_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->leave_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 파일보관함</th>
									<td class="col-xs-2">
										<input name="file_menu" id="file_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->file_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 공용품관리</th>
									<td class="col-xs-2">
										<input name="goods_menu" id="goods_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->goods_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 차량관리</th>
									<td class="col-xs-2">
										<input name="car_menu" id="car_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->car_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
									</td>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 시설관리</th>
									<td class="col-xs-2">
										<input name="installation_menu" id="installation_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->installation_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
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
