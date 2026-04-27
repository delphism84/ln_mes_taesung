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
				<li class="active">데이터백업</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					데이터백업
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						ERP SYSTEM DATABASE 를 백업합니다.
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

							<table id="simple-table" class="table table-bordered table-bordered">								
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 데이터베이스 생성</th>
									<td class="col-xs-10">
										<input type="button" class="btn btn-xs btn-info" value="데이터 생성하기" onclick="create()" />
										<span class="blue">* 시스템에 필요한 테이블을 생성합니다.</span>
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 데이터베이스 백업</th>
									<td class="col-xs-10">
										<input type="button" class="btn btn-xs btn-danger" value="데이터 백업하기" onclick="backup()" />
										<span class="blue">* 데이터는 최신형으로 백업됩니다.</span>
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 데이터베이스 복구</th>
									<td class="col-xs-10">
										<input type="button" class="btn btn-xs btn-success" value="데이터 복원하기" onclick="restore()" />
										<span class="blue">* 백업된 데이터로 복원됩니다.</span>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<?
require_once ("assets/include_script.php");
?>

<script>
function create() {
	var parameter = {"mode" : "createDb"};
	
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function() {
			alert("데이터를 백업하였습니다");
		}
	});
}

function backup() {
	var parameter = {"mode" : "backup"};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			alert("데이터를 백업하였습니다");
		}
	});
}

function restore() {
	if(confirm("현재 데이터를 삭제하고 저장된 백업데이터로 복원하시겠습니까?")) {
		var parameter = {"mode" : "restore"};
		$.ajax({
			type : "post",
			data : parameter,
			url : "ajax.php",
			success : function(str) {
				alert("데이터를 복원하였습니다");
			}
		});
	}
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
