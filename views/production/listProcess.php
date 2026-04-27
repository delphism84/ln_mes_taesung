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
					<a href="#">생산관리</a>
				</li>
				<li class="active">공정 리스트</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					공정 리스트
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 공정 리스트를 보여드립니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->			
					<div style="margin-top:10px">
						<table id="process_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="detail-col center" style="background-color:#f1f1f1">
										<label class="pos-rel">
											<input type="checkbox" class="ace" id="checkedAll" />
											<span class="lbl"></span>
										</label>
									</th>
									<th class="col-xs-4 center" style="background-color:#f1f1f1">공정명</th>
									<th class="col-xs-3 center" style="background-color:#f1f1f1">공정코드</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">공정구분</th>
									<th class="col-xs-3 center" style="background-color:#f1f1f1">외주공정거래처</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>

<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>

			
			
<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
					<div class="col-xs-6 right" style="text-align:right">
						<button class="btn btn-info" type="button" onclick="location.href = 'index.php?controller=production&action=inputPageProcess' ">
							<i class="ace-icon fa fa-check"></i>
							공정등록
						</button>

						&nbsp; &nbsp; &nbsp;
						<button class="btn btn-danger" type="button" onclick="deleteSelect()">
							<i class="ace-icon fa fa-undo"></i>
							선택삭제
						</button>
					</div>
				</div>
			</div>
<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

		</div>
	</div>
</div>


<input type="hidden" name="page" id="page" value="1" />
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />

<!----------------------------------------------------------------------------------------------------------------------->
<!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/common.js"></script>
<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/jquery.inputlimiter.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<!-- page specific plugin scripts -->
<!----------------------------------------------------------------------------------------------------------------------->
<script>
$(document).ready(function(){
	var page = $("#page").val();
	getProcess(page);

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
function getProcess(page){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = page;

	$.getJSON("ajax/process.php",{"page":page, "mode":"getProcess", "rpp" : rpp, "adjacents" : adjacents},
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
					tag += "<td><a href='index.php?controller=production&action=modifyPageProcess&uid=" + json[i].uid + "'>" + json[i].process_nm + "</a></td>";
					tag += "<td>" + json[i].process_cd + "</td>";
					tag += "<td>" + json[i].process_gb + "</td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#process_list tbody").html(tag);

			var table = "erp_process";
			var where = "";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getProcess(page);
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
	if(confirm("선택하신 공정 정보를 삭제하시겠습니까? 다른 데이터와 연동된 공정 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectProcess&table=erp_process&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/process.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getProcess(1);
				}
			}
		});
	}
}
</script>

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
				
	$( "#id-btn-dialog1" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>고객 리스트</h4></div>",
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