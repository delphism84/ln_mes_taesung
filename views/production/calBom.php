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
				<li class="active">BOM(소요량) 계산</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					BOM(소요량) 계산
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						BOM(소요량)을 계산합니다.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->

					<form id="frm" method="post" action="index.php">
						<div>
							<!-- 테이블 -->
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">품목코드</th>
									<td class="col-xs-2"><input type="text" class="form-control item_cd" name="item_cd" id="item_cd" placeholder="품목선택을 하시려면 클릭하세요" onclick="centerOpenWindow('views/popup/calBomList.php', '품목리스트', 1000, 500)" readonly /></td>
									<th class="col-xs-1" style="background-color:#f1f1f1">품목명</th>
									<td class="col-xs-2"><input type="text" class="form-control" name="item_nm" id="item_nm" readonly /></td>
									<th class="col-xs-1" style="background-color:#f1f1f1">규격</th>
									<td class="col-xs-2"><input type="text" class="form-control" name="standard" id="standard" readonly /></td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 생산수량</th>
									<td class="col-xs-2"><input type="text" class="col-xs-4 onlynum" name="cnt" id="cnt" value="1" />&nbsp;<input type="button" class="btn btn-xs btn-warning" value="소요량 계산" onclick="getBom()" /></td>
								</tr>
							</table>
						</div>

						<div>
							<div class="widget-header">소요량</div>
							<div class="widget-body">
								<div class="widget-main no-padding">
									<table id="product" class="table  table-bordered table-striped">
										<thead>
											<tr>
												<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>
												<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
												<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
												<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 재질</th>
												<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 단위</th>
												<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 소요수량</th>
												<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 현재고수량</th>
												<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 부족재고수량</th>
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
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->


<?
require_once ("assets/include_script.php");
?>

<!-- Table Tr Add ------------------------------------------------------------------------------------------------------->
<script>
$(document).ready(function(){
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	getItem();
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

function getBom(){
	var item_cd = $("#item_cd").val();
	var item_nm = $("#item_nm").val();
	var standard = $("#standard").val();
	var cnt = $("#cnt").val();
	var tag = "";

	$.getJSON("ajax/production.php",{"mode":"getCalBom", "item_cd" : item_cd, "item_nm" : item_nm , "standard" : standard, "cnt" : cnt},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><input type='text' class='form-control' name='item_cd[]' id='item_cd_" + i + "' value='" + json[i].item_cd + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' id='item_nm_" + i + "' name='item_nm[]' value='" + json[i].item_nm + "' /></td>";
					tag += "<td><input type='text' class='form-control' id='standard1_" + i + "' name='standard[]' value='" + json[i].standard1 + "' /></td>";
					tag += "<td><input type='text' class='form-control' id='material_" + i + "' name='material[]' value='" + json[i].material + "' /></td>";
					tag += "<td><input type='text' class='form-control' id='unit_" + i + "' name='unit[]' value='" + json[i].unit + "' /></td>";
					tag += "<td><input type='text' class='form-control' id='cnt_" + i + "' name='cnt[]' value='" + json[i].cnt + "' /></td>";
					tag += "<td><input type='text' class='form-control' id='current_cnt_" + i + "' name='current_cnt[]' value='" + json[i].current_cnt + "' /></td>";
					tag += "<td><input type='text' class='form-control' id='shortage_cnt_" + i + "' name='shortage_cnt[]' value='" + json[i].shortage_cnt + "' /></td>";
					tag += "</tr>";
				}
				$("#product tbody").html(tag);
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