<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">생산관리</a>
				</li>
				<li class="active">생산계획별 소요 자재 현황 조회</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					생산계획별 소요 자재 현황 조회
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						생산계획별 소요 자재 현황 조회를 계산합니다.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">

				<div class="col-xs-12">
					<div class="alert alert-block alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<i class="ace-icon fa fa-check green"></i>
						생산품목을 선택하시면 생산품목을 만들기 위한 자재가 계산되어서 출력이 됩니다.
					</div>

					<!-- PAGE CONTENT BEGINS -->

					<form id="frm" method="post" action="index.php">
						<div>
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">생산구분</th>
									<td class="col-xs-3"><?=$t->work_gb?></td>
									<th class="col-xs-1" style="background-color:#f1f1f1">생산계획코드</th>
									<td class="col-xs-3"><?=$t->workplan_cd?></td>
									<th class="col-xs-1" style="background-color:#f1f1f1">생산기간</th>
									<td class="col-xs-3"><?=substr($t->start_dt,0,10)?>~<?=substr($t->end_dt,0,10)?></td>
								</tr>
							</table>
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<th style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 생산품목</th>
									<th style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 생산수량</th>
								</tr>
								<?
								$sql = "select * from erp_workplan_item where workplan_cd='".$t->workplan_cd."'";
								$result = mysql_query($sql);
								while($item = mysql_fetch_object($result)) {
								?>
								<tr>
									<td><span class="label label-sm label-pink arrowed-right" style="cursor:pointer" onclick="getBom('<?=$item->item_cd?>','<?=$item->item_nm?>','<?=$item->standard1?>',<?=$item->cnt?>)">소요량 계산</span> <strong><?=$item->item_nm?></strong></td>
									<td><?=$item->cnt?></td>
								</tr>
								<?}?>
								</tr>
							</table>
						</div>

						<div>
							<div class="widget-header">소요량</div>
							<div class="widget-body">
								<div class="widget-main no-padding">
									<table id="bom" class="table  table-bordered table-striped">
										<thead>
											<tr>
												<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>
												<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
												<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
												<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 단위</th>
												<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 소요수량</th>
												<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 현재고수량</th>
												<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 부족재고수량</th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div><!-- /.row -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=production&action=listPageWorkPlanBom' ">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록 돌아가기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->


<input type="hidden" name="flag" id="flag" value="4" />
<input type="hidden" name="itemFlag" id="itemFlag" value="" />

<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->

<div id="dialog-message" class="dialog-view hide">
	<table id="item_list" class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-2 center" style="background-color:#f1f1f1">품목구분</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">품목코드</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">품목명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<?
require_once ("assets/include_script.php");
?>

<!-- Table Tr Add ------------------------------------------------------------------------------------------------------->
<script>
$(document).ready(function(){
	//getItem();
	//getBom();
});

function getBom(item_cd, item_nm, standard, cnt){
	var tag = "";

	$.getJSON("ajax/production.php",{"mode":"getCalBom", "item_cd" : item_cd, "item_nm" : item_nm , "standard1" : standard, "cnt" : cnt},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					if(Number(json[i].shortage_cnt) > 0) var style = "style='background-color:red'";
					else var style = "";

					tag += "<tr " + style + ">";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					tag += "<td style='text-align:right'>" + json[i].cnt + "</td>";
					tag += "<td style='text-align:right'>" + json[i].current_cnt + "</td>";
					tag += "<td style='text-align:right'>" + json[i].shortage_cnt + "</td>";
					tag += "</tr>";
				}
				tag += "<tr><td colspan='6'></td></tr>";
				$("#bom tbody").html(tag);
			}
		}
	);
}
</script>

<!----------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-phone').mask('(999) 999-9999');
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