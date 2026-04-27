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
					<a href="#">재고관리</a>
				</li>
				<li class="active">안전재고관리</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					안전재고관리
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						부족한 자재 리스트를 보여드립니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div class="widget-header">
						<div class="col-xs-6" style="float:left">
							<select id="per" onchange="getShortage(1)">
								<option value="10">10개씩 보기</option>
								<option value="15">15개씩 보기</option>
								<option value="20">20개씩 보기</option>
								<option value="25">25개씩 보기</option>
								<option value="30">30개씩 보기</option>
								<option value="35">35개씩 보기</option>
								<option value="40">40개씩 보기</option>
								<option value="45">45개씩 보기</option>
								<option value="50">50개씩 보기</option>
								<option value="all">전체 보기</option>
							</select>
						</div>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="item_list" class="table  table-bordered table-hover">
								<thead class="thin-border-bottom">
									<tr>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 이미지</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 구분</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 안전재고수량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 잔여수량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 조달기간</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 관리</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>

<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	getShortage();
});

// 거래처 리스트 가져오기
function getShortage(){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/item.php",{"page":page, "mode":"getShortage", "rpp" : rpp, "adjacents" : adjacents, "where" : where},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					switch(json[i].item_gb) {
						case "component" : var item_gb = "자재"; break;
						case "semi_product" : var item_gb = "반제품"; break;
						case "product" : var item_gb = "완제품"; break;
						default : var item_gb = "미구분"; break;
					} 

					tag += "<tr>";

					if($.trim(json[i].img) != "") tag += "<td class='center'><a href='#' onclick='location.href = \"index.php?controller=base&action=modifyPageItem&uid=" + json[i].uid + "\"'><img src='attach/" + json[i].img + "' style='width:80px;' /></a></td>";
					else 	tag += "<td class='center'><a href='#' onclick='location.href = \"index.php?controller=base&action=modifyPageItem&uid=" + json[i].uid + "\"'><img src='assets/images/noimg.gif' style='width:80px;' /></a></td>";

					tag += "<td><a href='#' onclick='location.href = \"index.php?controller=items&action=modifyPageItem&uid=" + json[i].uid + "\"'>" + item_gb + "</a></td>";
					tag += "<td><a href='#' onclick='location.href = \"index.php?controller=items&action=modifyPageItem&uid=" + json[i].uid + "\"'>" + json[i].item_cd + "</a></td>";
					tag += "<td><a href='#' onclick='location.href = \"index.php?controller=items&action=modifyPageItem&uid=" + json[i].uid + "\"'>" + json[i].item_nm + "</a></td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].standard2 + "</td>";
					tag += "<td>" + json[i].standard3 + "</td>";
					tag += "<td style='text-align:right'>" + json[i].safety_stock_cnt + "</td>";
					tag += "<td style='text-align:right'><span style='color:red; font-weight:bold'>" + json[i].remain_cnt + "</span></td>";
					tag += "<td style='text-align:right'>" + json[i].delivery_period + "</td>";
					tag += "<td><input type='button' class='btn btn-xs btn-success' value='견적요청' /> <input type='button' class='btn btn-xs btn-info' value='발주등록' /></td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='11' class='center' style='height:20px'> 등록된 안전재고가 없습니다. </td>";
				tag += "</tr>";
			}

			tag += "<tr><td colspan='9'></td></tr>";
			$("#item_list tbody").html(tag);
		}
	);
}
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-phone').mask('(999) 999-9999');
	$('.input-mask-mobile').mask('(999) 9999-9999');
	$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
	$(".input-mask-product").mask("a*-999-a999",{
		placeholder:" ",completed:
			function(){
				alert("You typed the following: "+this.val());
			}
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

	/////////
	$('#modal-form input[type=file]').ace_file_input({
		style:'well',
		btn_choose:'Drop files here or click to choose',
		btn_change:null,
		no_icon:'ace-icon fa fa-cloud-upload',
		droppable:true,
		thumbnail:'large'
	})

	//chosen plugin inside a modal will have a zero width because the select element is originally hidden
	//and its width cannot be determined.
	//so we set the width after modal is show
	$('#modal-form').on('shown.bs.modal', function () {
		if(!ace.vars['touch']) {
			$(this).find('.chosen-container').each(
				function(){
					$(this).find('a:first-child').css('width' , '210px');
					$(this).find('.chosen-drop').css('width' , '210px');
					$(this).find('.chosen-search input').css('width' , '200px');
				});
		}
	})

	/**
	//or you can activate the chosen plugin after modal is shown
	//this way select element becomes visible with dimensions and chosen works as expected
	$('#modal-form').on('shown', function () {
	$(this).find('.modal-chosen').chosen();
	})
	*/

	$(document).one('ajaxloadstart.page', function(e) {
		autosize.destroy('textarea[class*=autosize]')
		$('.limiterBox,.autosizejs').remove();
		$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
	});
});
</script>
<!-- // basic script ------------------------------------------------------------------------------------------------------->