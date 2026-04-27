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
					<a href="#">구매관리</a>
				</li>
				<li class="active">구매(입고)</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					구매(입고)
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						구매(입고) 품목 리스트를 보여드립니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="widget-header">
						<div class="col-xs-6" style="float:left">
							<select id="per" onchange="getPurchase(1)">
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
						<div class="col-xs-6" style="float:right">
							<div class="col-xs-4"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="Search..." name="search_txt" id="search_txt" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="search()">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											Search
										</button>
									</span>
								</div>
							</div>
							<div style="float:right">
								<select class="form-control" name="search_choice" id="search_choice">
									<option value="account_nm">거래처명</option>
									<option value="item_nm">품목명</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="estimate_list" class="table  table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 발주일자</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 협력사</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 품번</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 품명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 입고창고</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> LOT_NO</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 입고량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 잔여량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 불량수량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 불량내용</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 완료여부</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div class="clearfix form-actions center" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-12 center"><span id="paging_area"></span></div>
						</div>
					</div>
					<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>

<div id="dialog-message1" class="dialog-view hide">
	<table id="account_list" class="table  table-bordered table-hover">
		<tr>
			<th class="col-xs-2 center" style="background-color:#f1f1f1">수량</th>
			<td class="col-xs-5 center"><input type="text" id="cnt" name="cnt" /></td>
		</tr>
	</table>
</div><!-- #dialog-message -->


<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="uid" id="uid" value="" />
<input type="hidden" name="mode" id="mode" value="" />
<input type="hidden" name="where" id="where" value=" where state<>'complete'" />
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />

<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->


<script>
$(document).ready(function(){
	var page = $("#page").val();
	getPurchase(page);

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

// 거래처 리스트 가져오기
function getPurchase(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/purchase.php",{"page":page, "mode":"getItemPurchase", "rpp" : rpp, "adjacents" : adjacents, "where" : where},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					
					var in_cnt = Number(json[i].cnt) - Number(json[i].remain_cnt);
					if(json[i].state == "stay") var state = "대기중";
					else if(json[i].state == "ing") var state = "입고중";
					else if(json[i].state == "complete") var state = "입고완료";

					tag += "<tr>";
					tag += "<td>" + json[i].create_dt + "</td>";
					tag += "<td><a href='index.php?controller=purchase&action=modifyPagePurchaseDemand&uid=" + json[i].uid + "'>" + json[i].account_nm + "</a></td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].standard2 + "</td>";
					tag += "<td>" + json[i].standard3 + "</td>";
					tag += "<td>" + json[i].warehouse_nm + "</td>";
					tag += "<td style='text-align:right'>" + json[i].cnt + "</td>";
					tag += "<td style='text-align:right'>" + in_cnt + "</td>";
					tag += "<td style='text-align:right'>" + json[i].remain_cnt + "</td>";
					tag += "<td>";
					if(json[i].state == "stay") tag += "<input type='button' class='btn btn-xs' value='전량입고' onclick='pavable(" + json[i].uid + ")' />";
					
					if(json[i].state == "part") tag += "<input type='button' class='btn btn-xs id-btn-dialog1' value='부분입고' onclick='changeMode(1, " + json[i].uid + ")' /> <!--<input type='button' class='btn btn-xs id-btn-dialog2' value='반품처리' onclick='changeMode(2, " + json[i].uid + ")' />-->";
					tag += "</td>";
					tag += "</tr>";
				}
			}

			$("#estimate_list tbody").html(tag);

			var table = "erp_purchase";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

function changeMode(mode,uid) {
	if(mode ==1) $("#mode").val("part");
	else if(mode == 2) $("#mode").val("return");

	$("#uid").val(uid);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getPurchase(page);
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
	if(confirm("선택하신 견적서 정보를 삭제하시겠습니까? 다른 데이터와 연동된 견적서 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectEstimate&table=erp_estimate&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/estimate.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getEstimate(1);
				}
			}
		});
	}
}

function pavable(uid) {
	if(confirm("대금지불은 완료 처리하겠습니까?")) {
		var dataString = "mode=pavableComplete&uid=" + uid;
		$.ajax({
			type : "post",
			data : dataString,
			url : "ajax/purchase.php",
			success : function(str) {
				if(str == "success") alert("대금지불을 완료처리하였습니다");
			}
		});
	} else {
		alert("미지급금 처리하였습니다");
	}
	allIn(uid);
}

// 전량입고
function allIn(uid) {
	var dataString = "mode=allIn&uid=" + uid;
	$.ajax({
		type : "post",
		url : "ajax/purchase.php",
		data : dataString,
		success : function(str) {
			if(str == "success") getPurchase(1);
			else alert(str);
		}
	});
}

// 부분입고
function partIn() {

}

// 검색
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();
	var where = $("#where").val();

	if(search_choice == "account_nm") {
		$("#where").val(where + " and account_nm like '%" + txt + "%' ");
	} else if(search_choice == "item_nm") {
		$("#where").val(where + " and item_nm like '%" + txt + "%' ");
	}
	getPurchase(1);
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
				
	$( document).on('click',".id-btn-dialog1", function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 300,
			height:160,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>부분 입고수량 입력</h4></div>",
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
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

				
	$( document).on('click',".id-btn-dialog2", function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 300,
			height:160,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>반품 수량 입력</h4></div>",
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