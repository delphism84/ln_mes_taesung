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
				<li class="active">출고관리</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					출고관리
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						출고해야 할 품목 리스트를 보여드립니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="widget-header">
						<div class="col-xs-1" style="float:left">
							<select class="form-control" onchange="setAccount(this.value)">
								<option value="all">전체</option>
								<option value="sales">매출거래처</option>
								<option value="purchase">매입거래처</option>
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
									<option value="account_cd">거래처코드</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="work_list" class="table  table-bordered table-hover">
								<thead class="thin-border-bottom">
									<tr>
										<th class="detail-col center" style="background-color:#f1f1f1">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>
										<th class="col-xs-1 center" style="background-color:#f1f1f1">지시서코드</th>
										<th class="col-xs-1 center" style="background-color:#f1f1f1">출고공정</th>
										<th class="col-xs-1 center" style="background-color:#f1f1f1">출고기계</th>
										<th class="col-xs-2 center" style="background-color:#f1f1f1">품목코드</th>
										<th class="col-xs-2 center" style="background-color:#f1f1f1">품목명</th>
										<th class="col-xs-2 center" style="background-color:#f1f1f1">규격</th>
										<th class="col-xs-1 center" style="background-color:#f1f1f1">출고요청수량</th>
										<th class="col-xs-1 center" style="background-color:#f1f1f1">요청자</th>
										<th class="col-xs-1 center" style="background-color:#f1f1f1">요청일</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
		<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div class="clearfix form-actions center" style="margin-top:0px">
						<div class="col-md-12">
							<span id="paging_area"></span>
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
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />
<input type="text" name="uid" id="uid" />


<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function(){
	var page = $("#page").val();
	getRelease(page);

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
function getRelease(page){
	var rpp = 10;
	var adjacents = 4;
	var tag = "";
	var page = page;

	$.getJSON("ajax/item.php",{"page":page, "mode":"getRelease", "rpp" : rpp, "adjacents" : adjacents},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					tag += "<td class='center'><a href='index.php?controller=items&action=modifyPageRelease&uid=" + json[i].uid + "'>" + json[i].work_cd + "</a></td>";
					tag += "<td class='center'>" + json[i].process + "</td>";
					tag += "<td class='center'>" + json[i].machine + "</td>";
					tag += "<td class='center'>" + json[i].item_cd + "</td>";
					tag += "<td class='center'>" + json[i].item_nm + "</td>";
					tag += "<td class='center'>" + json[i].standard + "</td>";
					tag += "<td class='center'>" + json[i].cnt + "</td>";
					tag += "<td class='center'>" + json[i].emp_nm + "</td>";
					tag += "<td class='center'>" + json[i].create_dt + "</td>";
					tag += "</tr>";
				}
			}

			$("#work_list tbody").html(tag);

			var table = "erp_release";
			var where = " where status='stay'";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function registRelease(uid, cnt) {
	var dataString = "mode=registRelease&uid=" + uid + "&cnt=" + cnt;
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/item.php",
		success : function(str) {
			if(str == "success") getRelease(1);
			else alert(str);
		}
	});
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getRelease(page);
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
	if(confirm("선택하신 수주(주문) 정보를 삭제하시겠습니까? 다른 데이터와 연동된 수주(주문) 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectOrder&table=erp_estimate&uids=" + $("#check_uids").val();
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
					getOrder(1);
				}
			}
		});
	}
}

function registPartRelease(){
	var dataString = "mode=registPartRelease&uid=" + $("#uid").val() + "&cnt=" + $("#cnt").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/item.php",
		success : function(str) {
			if(str == "success") getWork(1);
			else if(str == "overflow") alert("생산지시수량을 초과한 수량을 입력하셨습니다");
			else alert(str);
		}
	});
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