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
				<li class="active">출고요청서</li>
			</ul>

			<div class="nav-search" id="nav-search">
				<form class="form-search">
					<span class="input-icon">
						<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
						<i class="ace-icon fa fa-search nav-search-icon"></i>
					</span>
				</form>
			</div>
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					출고요청서
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						출고요청 품목의 상세정보를 보여드립니다.
					</small>
				</h1>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<input type="hidden" name="item_cd" id="item_cd" value="<?=$t->item_cd?>" />
					<input type="hidden" name="standard" id="standard1" value="<?=$t->standard1?>" />
					<input type="hidden" name="standard" id="standard2" value="<?=$t->standard2?>" />
					<input type="hidden" name="standard" id="standard3" value="<?=$t->standard3?>" />
					<input type="hidden" name="require_cnt" id="require_cnt" value="<?=$t->cnt?>" />
					<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />

					<!-- 테이블 -->
					<table id="simple-table" class="table  table-bordered table-hover">
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="ace-icon fa fa-caret-right blue"></i> 작업지시서코드</th>
							<td class="col-xs-5"><?=$t->work_cd?> <span style='color:blue'>[<?=substr($t->create_dt,0,10)?>]</span></td>
							<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
							<td class="col-xs-5"><?=$t->item_nm?></td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>
							<td class="col-xs-5"><?=$t->item_cd?></td>
							<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
							<td class="col-xs-5"><?=$t->standard?></td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="ace-icon fa fa-caret-right blue"></i> 출고공정</th>
							<td class="col-xs-5"><?=getProcessName($t->process)?></td>
							<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="ace-icon fa fa-caret-right blue"></i> 출고기계</th>
							<td class="col-xs-5"><?=getMachineNm($t->machine)?></td>
						</tr>
						<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="ace-icon fa fa-caret-right blue"></i> 출고요청수량</th>
							<td class="col-xs-5"><?=number_format($t->cnt)?></td>
							<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="ace-icon fa fa-caret-right blue"></i> 잔여출고요청수량</th>
							<td class="col-xs-5"><span style='color:red; font-weight:bold' id="remain_cnt"><?=number_format($t->cnt)?></span></td>
						</tr>
					</table>

					<table id="stock_list" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 창고명</th>
								<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
								<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>
								<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
								<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 현재고</th>
								<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 입고일</th>
								<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 입고단가</th>
								<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 출고</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>				
				</div>
			</div>
			<div class="clearfix form-actions center">
				<div class="col-md-12 center">
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=items&action=listPageRelease' ">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록가기
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<? require_once ("assets/include_script.php"); ?>

<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getWarehouseStock(page);
});

// 거래처 리스트 가져오기
function getWarehouseStock(){
	var item_cd = $("#item_cd").val();
	var standard1 = $("#standard1").val();
	var standard2 = $("#standard2").val();
	var standard3 = $("#standard3").val();
	var tag = "";
	var require_cnt = $("#require_cnt").val();

	$.getJSON("ajax/stock.php",{"mode":"getWarehouseEachStock", "item_cd" : item_cd, "standard1" : standard1, "standard2" : standard2, "standard3" : standard3},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td>" + json[i].warehouse_nm + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "<td><span id='current_cnt'>" + json[i].remain_cnt + "</span></td>";
					tag += "<td>" + json[i].create_dt + "</td>";
					tag += "<td>" + json[i].pur_unit_price + "</td>";
					tag += "<td><input type='button' class='btn btn-xs btn-danger' value='전량출고' onclick=\"registRelease(" + json[i].uid + ", " + removeComma(json[i].remain_cnt) + ")\" /> <input type='button' class='btn btn-xs btn-success' value='부분출고' onclick=\"centerOpenWindow('views/popup/createRelease.php?uid=" + $("#uid").val() + "&inout_uid=" + json[i].uid + "&remain_cnt=" + require_cnt + "', '부분출고', 450, 250)\" /></td>";
					tag += "</tr>";
				}
			} else {
				location.href = "index.php?controller=items&action=listPageRelease";
			}

			$("#stock_list tbody").html(tag);
		}
	);
}

function reloading() {
	location.reload();
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
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
}

// UID 세팅
function setUid(uid) {
	$("#uid").val(uid);
}

function removeComma(n) {  // 콤마제거
	if ( typeof n == "undefined" || n == null || n == "" ) {
		return "";
	}
	var txtNumber = '' + n;
	return txtNumber.replace(/(,)/g, "");
}

function commaSplit(n) {// 콤마 나누는 부분
	var txtNumber = '' + n;
	var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
	var arrNumber = txtNumber.split('.');
	arrNumber[0] += '.';
	do {
		arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
	}
	while (rxSplit.test(arrNumber[0]));
	if(arrNumber.length > 1) {
		return arrNumber.join('');
	} else {
		return arrNumber[0].split('.')[0];
	}
}

// 전량출고
function registRelease(stock_uid, remain_cnt) {
	if(confirm("전량 출고처리 하시겠습니까?")) {
		if(Number($("#require_cnt").val()) <= 0) {
			alert("이미 전량 출고 처리 되었습니다");
			return false;
		} else {
			// 출고요청서의 UID
			var uid = $("#uid").val();
			var require_cnt = $("#require_cnt").val(); // 출고요청수량
			var remain_cnt_txt = removeComma($("#remain_cnt").text());

			var dataString = "mode=registAllRelease&uid=" + uid + "&stock_uid=" + stock_uid + "&require_cnt=" + require_cnt + "&remain_cnt=" + remain_cnt;
			//alert(dataString);
			$.ajax({
				type : "post",
				data : dataString,
				url : "ajax/item.php",
				success : function(str) {
					if(str == "success") {
						var new_remain_cnt = Number(remain_cnt_txt) - Number(remain_cnt);
						
						if(new_remain_cnt <0) {
							$("#require_cnt").val("0");
							$("#remain_cnt").html("0");
						} else {
							$("#require_cnt").val(new_remain_cnt);
							$("#remain_cnt").html(commaSplit(new_remain_cnt));
						}

						getWarehouseStock();
					}
				}
			});
		}
	}
}

// 부분출고
function registPartRelease(){
	var uid = $("#uid").val();
	var cnt = $("#cnt").val();
	var require_cnt = $("#require_cnt").val();

	if(cnt > require_cnt) {
		alert("잔여출고요청수량을 초과한 수량을 입력하셨습니다");
	} else {
		var dataString = "mode=registPartRelease&uid=" + uid + "&cnt=" + cnt;
		$.ajax({
			type : "post",
			data : dataString,
			url : "ajax/item.php",
			success : function(str) {
				if(str == "success") {

				}
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
				
	// 견적서 팝업
	$( document).on('click',".id-btn-dialog", function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 300,
			height:160,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>출고수량 입력</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						registPartRelease();
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	
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