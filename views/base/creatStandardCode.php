<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);
$dialogID = $_GET['dialogid'];	//모달창 안닫혀서 수정 2018.10.16

?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="base" />
						<input type="hidden" name="action" id="action" value="inputStandardCode" />
						<input type="hidden" name="dialogid" id="dialogid" value="<?=$_GET['dialogid']?>" />
						
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 규격명</th>
								<td class="col-xs-5">
									<input type="text" name="standard" id="standard"  />
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 규격코드</th>
								<td class="col-xs-5">
									<input type="text" name="standard_cd" id="standard_cd"/>
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 규격코드명</th>
								<td class="col-xs-5">
									<input type="text" name="standard_nm" id="standard_nm" />
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 메모</th>
								<td class="col-xs-5">
									<input type="text" name="etc" id="etc" />
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div><!-- /.row -->
			<!-- submit -->
			<div class="clearfix form-actions center" style="margin-top:-1px">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmits()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						등록
					</button>
					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset" onclick="window.parent.closeModal('<?=$dialogID?>');">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						닫기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<input type="hidden" name="flag" id="flag" value="4" />

<?
require_once ("assets/include_script.php");
?>

<!-- Table Tr Add ------------------------------------------------------------------------------------------------------->
<script>
$(document).ready(function(){
	// 특수문자 입력 방지
	//$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	<? if($_SESSION['auto_code'] == "y") { ?>createLotnoCode();<?}?>
	//createLotnoCode();
});

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
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 


function createLotnoCode(){
	var dataString = "mode=createLotnoCode";
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			$("#lot_no_cd").val(str);
		}
	});
}


function formSubmits() {
	//if(!check_str($("#standard").val(),"규격")) return false;
	//if(!check_str($("#standard_cd").val(),"규격코드")) return false;
	//if(!check_str($("#lot_no_dt").val(),"규격코드 유효기간")) return false;

	if($("#standard").val()==""){
		alert("규격");
		$("#standard").focus()	
		return false;
	}
	if($("#standard_cd").val()==""){
		alert("규격코드"); 
		$("#standard_cd").focus();
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
		todayHighlight: true,
			language: "kr"
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