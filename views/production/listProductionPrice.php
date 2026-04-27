

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
				<li class="active">원가관리</li>
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
					원가관리
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						수주건변 원가현황을 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="production" />
						<input type="hidden" name="action" id="action" value="registWorkPlan" />
						<input type="hidden" name="order_cd" id="order_cd" />
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 수주코드</th>
								<td>ORD-000124541</td>
								<th style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 거래처</td>
								<td>제이산전</td>
							</tr>
							<tr>
								<th style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 생산품목</th>
								<td>PAD-d548</td>
								<th style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 생산수량</td>
								<td>500</td>
							</tr>
						</table>

						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 구분</th>
								<th class="col-xs-2" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 수주가</th>
								<th class="col-xs-2" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 목표가</th>
								<th class="col-xs-2" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 실행원가</th>
								<th class="col-xs-2" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 수주가 대비 실행원가</th>
								<th class="col-xs-2" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 목표가 대비 실행원가</th>
							</tr>
							<tr>
								<th style="background-color:#f1f1f1">설계</th>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
							</tr>
							<tr>
								<th style="background-color:#f1f1f1">NC</th>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
							</tr>
							<tr>
								<th style="background-color:#f1f1f1">패턴</th>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
							</tr>
							<tr>
								<th style="background-color:#f1f1f1">주물</th>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
							</tr>
							<tr>
								<th style="background-color:#f1f1f1">가공</th>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
								<td><input type="text" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div><!-- /.row -->

			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						등록
					</button>
					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset" onclick="location.href='index.php?controller=production&action=listPageWorkPlan'">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록가기
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="flag" id="flag" value="1" />

<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
});

function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var flag = $("#flag").val();
	flag = Number(flag) - 1;
	if(flag < 1) {} else $("#flag").val(flag);
}

function centerOpenWindow(theURL, winName, width, height, fstate, scrollbars){ 
	var features = "width=" + width ; 
	features += ",height=" + height ; 
	var state = ""; 
	var scrollbars = "yes";
	var res_w = ( $(window).width() - width ) / 2; 
	var res_h = ( $(window).height() - height ) / 2; 
	if ( window.screenLeft >= window.screen.width ) { 
		res_w = window.screen.width + res_w; 
	} 
	if (fstate == "") { // 옵션 
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars="+ scrollbars; 
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars="+ scrollbars; 
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 

function getOrderItem(){
	var order_cd = $("#order_cd").val();
	$("#order_no").val(order_cd);
	var flag = $("#flag").val();
	var tag = "";

	$.getJSON("ajax/order.php",{"mode":"getOrderItem", "order_cd" : order_cd},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag = "";
					tag += "<tr class='item" + flag + "'>";
					tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
					tag += "<td><input type='text' class='form-control id-btn-dialog item_cd ' name='item_cd[]' id='item_cd_" + flag + "' value='" + json[i].item_cd + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "' value='" + json[i].item_nm + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='standard[]' id='standard_" + flag + "' value='" + json[i].standard + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control cnt' name='cnt[]' id='cnt_" + flag + "' value='" + json[i].cnt + "' /></td>";
					tag += "<td><input class='date-picker' name='work_start_dt[]' id='work_start_dt_" + flag + "' type='text' data-date-format='yyyy-mm-dd' /></td>";
					tag += "<td><input class='date-picker' name='work_end_dt[]' id='work_end_dt_" + flag + "' type='text' data-date-format='yyyy-mm-dd' /></td>";
					tag += "<td><input type='text' class='form-control' value='" + order_cd + "' /></td>";
					tag += "</tr>";
					$("#product").append(tag);

					flag = Number(flag) + 1;
					$("#flag").val(flag);
				}
			}
		}
	);
}

function formSubmit(){
	if(!check_str($("#title").val(),"제목")) return false;
	if(!check_str($("#start_dt").val(),"생산기간 시작일")) return false;
	if(!check_str($("#end_dt").val(),"생산기간 종료일")) return false;
	if($("#flag").val() == 1) {
		alert("품목을 선택하세요");
		return false;
	}
	$("#frm").submit();
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