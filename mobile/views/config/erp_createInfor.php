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
					<div>
						<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
							<input type="hidden" name="controller" id="controller" value="config" />
							<input type="hidden" name="action" id="action" value="registInfo" />
							<input type="hidden" name="uid" id="uid" value="1" />

							<table id="simple-table" class="table table-bordered table-bordered">
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 회사명</th>
									<td class="col-xs-10"><input type="text" class="form-control" name="corp_nm" id="corp_nm" value="<?=$t->corp_nm?>" /></td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 사업자등록번호</th>
									<td class="col-xs-10"><input type="text" class="form-control" name="business_no" id="business_no" value="<?=$t->business_no?>" /></td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 대표자</th>
									<td class="col-xs-10"><input type="text" class="form-control" name="owner" id="owner" value="<?=$t->owner?>" /></td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 대표번호</th>
									<td class="col-xs-10"><input type="text" class="form-control" name="telephone" id="telephone" value="<?=$t->telephone?>" /></td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 팩스번호</th>
									<td class="col-xs-10"><input type="text" class="form-control" name="fax" id="fax" value="<?=$t->fax?>" /></td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 주소</th>
									<td class="col-xs-10"><input type="text" class="form-control" name="address" id="address" value="<?=$t->address?>" /></td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 업태</th>
									<td class="col-xs-10"><input type="text" class="form-control" name="corp_type" id="corp_type" value="<?=$t->corp_type?>" /></td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 종목</th>
									<td class="col-xs-10"><input type="text" class="form-control" name="corp_event" id="corp_event" value="<?=$t->corp_event?>" /></td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 도장</th>
									<td class="col-xs-10">
										<?
										if($t->sign != "" && $t->sign != "none") echo "<div><img src='attach/".$t->sign."' style='width:80px; height:80px' /></div>";
										?>
										<input type="file" class="form-control" name="sign" id="sign" />
									</td>
								</tr>
								<tr>
									<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 시스템관리자</th>
									<td class="col-xs-10"><input type="text" class="form-control" name="admin" id="admin" value="<?=$t->admin?>" /></td>
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
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<?
require_once ("assets/include_script.php");
?>

<script>
function formSubmit(){
	if(!check_str($("#corp_nm").val(),"회사명")) return false;
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
