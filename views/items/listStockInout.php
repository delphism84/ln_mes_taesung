<?require_once("assets/head_pop.php");?>
<?

	session_start();
	extract($_POST);
	extract($_GET);


	if (empty($date_type)) $date_type = "d";
	if (empty($start_date)) 
		$start_date = date("Y-m-d", strtotime("-60 day"));
	else if (strlen($start_date) < 8) $start_date .= (strlen($start_date) == 4)?"01-01":"01";

	if (empty($end_date)) 
		$end_date = date("Y-m-d");
	else if (strlen($end_date) < 8) $end_date .= (strlen($end_date) == 4)?"01-01":"01";


?>

<div class="main-content" style='background-color:#FFFFF0'>
	<div class="main-content-inner" >
		<div class="page-content" >
			<!-- 페이지 상단 Location -->
			<div class="breadcrumbs ace-save-state" id="breadcrumbs">
				<div class="widget-header">
					<div class="col-xs-8" style="float:left">
						<div class="form-inline">
							<div style="float:left">
								<span class="input-icon input-icon-right">
									<div class="input-group">
										<input class="date-picker form-control" name="start_dt" id="start_dt" type="text" style="width:100px" value='<?=$start_date?>' data-date-format="yyyy-mm-dd" />
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</span>
							</div>
							<div style="float:left">&nbsp;~&nbsp;</div>
							<div style="float:left">
								<span class="input-icon input-icon-right">
									<div class="input-group ">
										<input class="date-picker form-control" name="end_dt" id="end_dt" type="text" style="width:100px" value='<?=$end_date?>' data-date-format="yyyy-mm-dd" />
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</span>
								<span class="input-icon input-icon-right">
									<div class="input-group">
										<button type="button" class="btn btn-purple btn-sm form-control" onclick="getInOutDateSearch()" >
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											Search
										</button>
									</div>
								</span>
							</div>&nbsp;&nbsp;&nbsp;
							<a class="btn btn-pink btn-sm form-control" target="_blank" onclick="ExcelDown()">엑셀출력</a>
							
						</div>
					</div>
				</div>
			</div>
			<div class="row" >
				<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div class="widget-body">
						<div class="widget-main ">
							<table id="item_list" class="table  table-bordered table-striped">
								<thead class="thin-border-top thin-border-bottom">
									<tr>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 날짜</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 거래처</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 적요</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> Lot_no</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 입고수량</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 출고수량</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 재고수량</th>
									</tr>
								</thead>
								<tbody></tbody>
								<tfoot>
									<tr>
										<th colspan='4' class="center" style="background-color:#f1f1f1"><SPAN class="stock_date"></SPAN> 계</th>
										<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN class="total_in_cnt"></SPAN></th>
										<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN class="total_out_cnt"></SPAN></th>
										<th class="center col-xs-1" style="background-color:#f1f1f1;"><SPAN class="total_in_out_cnt "></SPAN></th>

									</tr>
								<tfoot>	
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 text-right">
							 <?=date('Y-m-d H:i:s')?>
						</div>
					</div>
					<div class="clearfix form-actions center" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-12 center"><span id="paging_area"></span></div>
						</div>
					</div>
				<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
	</div>
</div>

<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="check_uids" id="check_uids" />
<input type="hidden" name="itemcd" id="itemcd" value='<?=$itemcd?>'/>
<input type="hidden" name="standard" id="standard" value='<?=$standard?>'/>
<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function(){
	
	getInOutDateSearch();
	
	$("#checkedAll").click(function(){
		if($("#checkedAll").prop('checked')) {
			$(".chk").each(function(){
				$(this).prop("checked",true);
			});
		} else {
			$(".chk").each(function(){
				$(this).prop("checked",false);
			});
		}
	});
});

//엑셀다운
function ExcelDown(){
	location.href="views/items/allocationDayExcel.php?where="+$("#where").val();
}

//수불부 날짜 검색하기.
function getInOutDateSearch(){

	var start_dt = $("#start_dt").val();
	var end_dt = $("#end_dt").val();

	var item_cd = $("#itemcd").val();
	var standard = $("#standard").val();

	$("#where").val( "where item_cd='"+ item_cd +"' and standard1='"+ standard +"' and date_format(create_dt, '%Y-%m-%d') >= '"+ start_dt +"' and date_format(create_dt, '%Y-%m-%d') <= '"+ end_dt +"' ");

	var page = $("#page").val();
	getStockInout(page);
}

// 재고수불부 리스트 가져오기
function getStockInout(page){
	
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var stock_date;
	var total_in_cnt = 0;
	var total_out_cnt = 0;
	var total_in_out_cnt = 0;
	var out_cnt =0;
	var page = page;
	
	$.getJSON("ajax/stock.php",{"page":page, "mode":"getStockInout", "rpp" : rpp, "adjacents" : adjacents, "where" : $("#where").val() },
		function(json){
			if(json != null){
				//$("#total_num").html(json[0].total_num);
				
				for(var i = 0 ; i < json.length ; i++){

					stock_date = json[i].create_dt;

					
					if(json[i].remark != "창고이동입고"){
						total_in_cnt = total_in_cnt + parseInt((json[i].in_cnt).replace(/,/g,""));	//입고수량
					}

					total_out_cnt = total_out_cnt + parseInt((json[i].out_cnt).replace(/,/g,""));	//출고수량
					total_in_out_cnt = total_in_out_cnt + parseInt((json[i].remain_cnt).replace(/,/g,""));	//잔여수량
					
					if(i==0){
					tag += "<tr><td colspan='6' class='center' style='color:#f75948;font-weight:bold'>전일재고";
					tag += "</td><td></td></tr>";
					}
					tag += "<tr>";
					tag += "<td>" + json[i].create_dt + "</a></td>";
					
					
					if(json[i].remark !="창고이동입고"){
						tag += "<td style='color:black'>" + json[i].account + "</a></td>";
						tag += "<td style='color:black'>" + json[i].remark + "</a></td>";
						tag +="<td>"+json[i].lot_no + "</td>";
						tag += "<td>" + json[i].in_cnt + "</td>";
						tag += "<td>" + json[i].out_cnt + "</td>";
					}else{
						tag += "<td style='color:gray'>" + json[i].account + "</a></td>";
						tag += "<td style='color:gray'>" + json[i].remark + "</a></td>";
						tag +="<td>"+json[i].lot_no + "</td>";
						tag += "<td>-</td>";
						tag += "<td>-</td>";
					}
					
					if($.trim(json[i].remain_cnt) < 0){
						tag += "<td style='text-align:right;background-color:#ffc1c1'>-" + json[i].remain_cnt + "</td>";
					}else{
						tag += "<td style='text-align:right'>" + json[i].remain_cnt + "</td>";
					}
					tag += "</tr>";
				}
				$(".stock_date").html(stock_date);
				$(".total_in_cnt").html(total_in_cnt.toLocaleString());
				$(".total_out_cnt").html(total_out_cnt.toLocaleString());

				//total_in_out_cnt = total_in_cnt - total_out_cnt;	//총잔여수량
				$(".total_in_out_cnt").html(total_in_out_cnt.toLocaleString());

			}else{
				tag += "<tr><td class='center' colspan='7'>등록된 재고수불 내역이 없습니다.";
				tag += "</td></tr>";
			}

			$("#item_list tbody").html(tag);

			var table = "erp_stock_inout";
			getPaging(table, $("#where").val() ,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getStock(page);
}

// 페이징 가져오기
function getPaging(table,where,rpp,adjacents){
	var data_string = "page=" + $("#page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents;

	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#paging_area").html(str);
		}
	});
}

// 선택 삭제
function deleteSelect(){
	if(confirm("선택하신 창고재고 정보를 삭제하시겠습니까? 다른 데이터와 연동된 창고재고 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectStock&table=erp_stock&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/stock.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getStock(1);
				}
			}
		});
	}
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