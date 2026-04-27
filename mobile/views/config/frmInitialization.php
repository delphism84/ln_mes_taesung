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
				<li class="active">데이터초기화</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					데이터초기화
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						ERP SYSTEM 의 데이터베이스를 초기화 합니다.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<form name="frm" id="frm" method="post" action="index.php">

						<table id="simple-table" class="table table-bordered table-bordered">
							<thead>
								<tr>
									<th class="col-xs-3" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 테이블명</th>
									<th class="col-xs-3" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 테이블설명</th>
									<th class="col-xs-3" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 등록데이터수</th>
									<th class="col-xs-3" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 관리</th>
								</tr>
							</thead>
							<tbody>

<?
$sql = "SELECT TABLE_NAME, TABLE_COMMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'yeonam'";
$result = mysql_query($sql);

while($t = mysql_fetch_object($result)) {
	$sql = "select * from ".$t->TABLE_NAME;
	$row = @mysql_num_rows(@mysql_query($sql));
	if($row > 0) $color = "#f7e9f6"; else $color="white";
?>
								<tr style="background-color:<?=$color?>">
									<td><?=$t->TABLE_NAME?></td>
									<td><?=$t->TABLE_COMMENT?></td>
									<td><?=$row?></td>
									<td>
										<input type="button" class="btn btn-xs btn-danger" value="삭제" onclick="drop_table('<?=$t->TABLE_NAME?>')" />
										<input type="button" class="btn btn-xs btn-success" value="비우기" onclick="truncate_table('<?=$t->TABLE_NAME?>')" />
									</td>
								</tr>
<?
}
?>
							</tbody>
						</table>
					</form>
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

function drop_table(table) {
	if(confirm(table + " 테이블을 정말 삭제하시겠습니까? 삭제 후에는 복구가 불가능합니다")) {        
        var parameter = {"mode" : "dropTable", "table" : table};
		$.ajax({
			type : "post",
			data : parameter,
			url : "ajax.php",
			success : function(str) {
				location.reload();				
			}
		});
	}
}

function truncate_table(table) {
	if(confirm(table + " 테이블을 정말 초기화 하시겠습니까? 초기화 후에는 복구가 불가능합니다")) {        
        var parameter = {"mode" : "truncateTable", "table" : table}
		$.ajax({
			type : "post",
			data : parameter,
			url : "ajax.php",
			success : function(str) {
				location.reload();
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
