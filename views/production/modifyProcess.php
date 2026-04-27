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
				<li class="active">공정 열람&수정</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					공정 열람&수정
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						공정 정보를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->

					<form id="frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="production" />
						<input type="hidden" name="action" id="action" value="updateProcess" />
						<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">공정 구분</th>
								<td class="col-xs-5">
									<label>
										<input type="radio" class="ace" name="process_gb" id="process_gb" value="1" <? if($t->process_gb == 1) echo "checked";?> onclick="clearAccount()" />
										<span class="lbl"> 내부공정</span>
									</label>

									<label>
										<input type="radio" class="ace" name="process_gb" id="process_gb" value="2" <? if($t->process_gb == 2) echo "checked";?> />
										<span class="lbl"> 외주공정</span>
									</label>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 공정 코드</th>
								<td class="col-xs-5"><input type="text" class="form-control" name="process_cd" id="process_cd" value="<?=$t->process_cd?>" readonly /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 공정명</th>
								<td class="col-xs-5"><input type="text" class="form-control" name="process_nm" id="process_nm" value="<?=$t->process_nm?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">외주거래처</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="account_cd" id="account_cd" value="<?=$t->account_cd?>" readonly />
												<input type="text" name="account_nm" id="account_nm" value="<?=$t->account_nm?>" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog1">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div><!-- /.row -->

			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						등록
					</button>

					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=sales&action=listAccount' ">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록 돌아가기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<div id="dialog-message" class="hide">
	<table id="account_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-2 center" style="background-color:#f1f1f1">구분</th>
				<th class="col-xs-3 center" style="background-color:#f1f1f1">거래처명</th>
				<th class="col-xs-3 center" style="background-color:#f1f1f1">거래처코드</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="search_txt" id="search_txt" value="" />
<input type="hidden" name="where" id="where" value="" />
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
$(document).ready(function() {
	// 거래처 코드 자동생성
	createProcessCode();
});

// 거래처 코드 자동생성
function createProcessCode() {
	var process_gb = $("input[name='process_gb']:checked").val();
	var data_string = "mode=createProcessCode&process_gb=" + process_gb;

	$.ajax({
		type : "post",
		url : "ajax/ajax.php",
		data : data_string,
		success : function(str) {
			$("#process_cd").val(str);
		}
	});
}

function formSubmit(){
	var process_gb = $("input[name='process_gb']:checked").val();
	
	if(!check_str($("#process_cd").val(),"공정코드")) return false;
	if(!check_str($("#process_nm").val(),"공정명")) return false;
	if(process_gb == 2) {
		if(!check_str($("#account_cd").val(),"외주거래처코드")) return false;
		if(!check_str($("#account_nm").val(),"외주거래처명")) return false;
	}

	$("#frm").submit();
}

function clearAccount() {
	$("#account_cd").val("");
	$("#account_nm").val("");
}
</script>

<script>
$(document).ready(function(){
	var page = $("#page").val();
	getAccount(page);

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
function getAccount(page){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	//var search_choice = $("#search_choice option:selected").val();
	//var txt = $("#search_txt").val();
	var page = page;
	var search = $("#where").val();
	var account_gb = $("#account_gb").val();

	$.getJSON("ajax/account.php",{"page":page, "mode":"getAccount", "rpp" : rpp, "adjacents" : adjacents, "where":search, "account_gb":account_gb},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					if(json[i].account_gb == "purchase") var clas = "매입";
					else var clas = "매출";
					
					tag += "<tr>";
					tag += "<td class='center'>" + clas + "</td>";
					tag += "<td><a href='#' onclick=\"postData('" + json[i].account_cd + "','" + json[i].account_nm + "')\">" + json[i].account_nm + "</a></td>";
					tag += "<td>" + json[i].account_cd + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_list tbody").html(tag);

			var table = "erp_account";
			if(account_gb == "" || account_gb == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			}

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getAccount(page);
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

// 검색
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	if(search_choice == "account_nm") {
		$("#where").val(" where 1=1 and account_nm like '%" + txt + "%' ");
	} else if(search_choice == "account_cd") {
		$("#where").val(" where 1=1 and account_cd like '%" + txt + "%' ");
	}
	getAccount(1);
}

// 거래처 구분으로 거래처 리스트 가져오기
function setAccount(val) {
	$("#page").val(1);
	$("#account_gb").val(val);
	getAccount(1);
}

function postData(code,name) {
	$("#account_cd").val(code);
	$("#account_nm").val(name);
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
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>거래처 리스트</h4></div>",
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
<!-- // basic script ------------------------------------------------------------------------------------------------------->