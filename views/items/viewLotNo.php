<?
// 품목명 가져오기
$sql = "select * from erp_stock_inout where lot_no='".$_GET['lotno']."'";
$stock = mysql_fetch_object(mysql_query($sql));

// 구입 거래처
$account = (isset($stock->account_cd)) ? getAccountName($stock->account_cd) : "";

// 작업담당자
$sql = "select emp_id from erp_work_";
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
					<a href="#">재고관리</a>
				</li>
				<li class="active">Lot No 추적</li>
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
					Lot No 추적
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Lot No 이력을 추적합니다.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php"  enctype="multipart/form-data" />
						<input type="hidden" name="controller" id="controller" value="items" />
						<input type="hidden" name="action" id="action" value="updateBarcode" />
						<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />

						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">로트번호</th>
								<td class="col-xs-5"><?= $_GET['lotno'] ?></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">품목명(품목코드)</th>
								<td class="col-xs-5"><?= getItemName($stock->item_cd) ?> (<?=$stock->item_cd?>)</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">구입일(생산일)</th>
								<td class="col-xs-5"><?= $stock->create_dt ?></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">구매처</th>
								<td class="col-xs-5"><?= $account ?></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">입고담당자</th>
								<td class="col-xs-5"><?= $stock->emp_id ?></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업지시서 코드</th>
								<td class="col-xs-5"><?= $stock->work_cd ?></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업담당자</th>
								<td class="col-xs-5"></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업일자</th>
								<td class="col-xs-5"></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">출하담당자</th>
								<td class="col-xs-5"></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">출하일자</th>
								<td class="col-xs-5"></td>
							</tr>
						</table>

						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">견적서코드</th>
								<td class="col-xs-5">
									<div class="input-group">						
										<input type="text" class="form-control search-query" name="estimate_cd" id="estimate_cd" value="<?=$stock->estimate_cd?>" readonly />
										<span class="input-group-btn">
											<button type="button" class="btn btn-purple btn-sm" onclick="centerOpenWindow('views/popup/viewOrder.php', '수주서', 800, 500)">
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											</button>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">수주(주문) 코드</th>
								<td class="col-xs-5">
									<div class="input-group">						
										<input type="text" class="form-control search-query" name="order_cd" id="order_cd" value="<?=$stock->order_cd?>" readonly />
										<span class="input-group-btn">
											<button type="button" class="btn btn-purple btn-sm" onclick="centerOpenWindow('views/popup/viewOrder.php', '수주서', 800, 500)">
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											</button>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">구매요청서 코드</th>
								<td class="col-xs-5">
									<div class="input-group">						
										<input type="text" class="form-control search-query" name="order_cd" id="order_cd" value="<?=$stock->order_cd?>" readonly />
										<span class="input-group-btn">
											<button type="button" class="btn btn-purple btn-sm" onclick="centerOpenWindow('views/popup/viewOrder.php', '수주서', 800, 500)">
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											</button>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">발주서 코드</th>
								<td class="col-xs-5">
									<div class="input-group">						
										<input type="text" class="form-control search-query" name="order_cd" id="order_cd" value="<?=$stock->order_cd?>" readonly />
										<span class="input-group-btn">
											<button type="button" class="btn btn-purple btn-sm" onclick="centerOpenWindow('views/popup/viewOrder.php', '수주서', 800, 500)">
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											</button>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">품질검사 코드</th>
								<td class="col-xs-5">
									<div class="input-group">						
										<input type="text" class="form-control search-query" name="order_cd" id="order_cd" value="<?=$stock->order_cd?>" readonly />
										<span class="input-group-btn">
											<button type="button" class="btn btn-purple btn-sm" onclick="centerOpenWindow('views/popup/viewOrder.php', '수주서', 800, 500)">
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											</button>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">출하지시서 코드</th>
								<td class="col-xs-5">
									<div class="input-group">						
										<input type="text" class="form-control search-query" name="order_cd" id="order_cd" value="<?=$stock->order_cd?>" readonly />
										<span class="input-group-btn">
											<button type="button" class="btn btn-purple btn-sm" onclick="centerOpenWindow('views/popup/viewOrder.php', '수주서', 800, 500)">
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											</button>
										</span>
									</div>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>

			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=items&action=listPageLotNo' ">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						돌아가기
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<? require_once ("assets/include_script.php"); ?>

<script>
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