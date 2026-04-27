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
					<a href="#">기준정보관리</a>
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
					<div>
						<form id="frm">
							<input type="hidden" name="mode" id="mode" value="registProcess" />
							<input type="hidden" name="uid" id="uid" />
							<!-- 테이블 -->
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 공정구분</th>
									<td class="col-xs-5">
										<label>
											<input type="radio" class="ace" name="process_gb" id="process_gb" value="1공장" checked/>
											<span class="lbl"> 1공장</span>
										</label>

										<label>
											<input type="radio" class="ace" name="process_gb" id="process_gb" value="2공장" />
											<span class="lbl"> 2공장</span>
										</label>

										<label>
											<input type="radio" class="ace" name="process_gb" id="process_gb" value="연태공장" />
											<span class="lbl"> 연태공장</span>
										</label>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 공정코드</th>
									<td class="col-xs-5"><input type="text" name="process_cd" id="process_cd" <? if($_SESSION['auto_code'] == "y") echo "readonly"; ?> /></td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 공정명</th>
									<td class="col-xs-5"><input type="text" class="form-control" name="process_nm" id="process_nm" /></td>
									<th class="col-xs-1" style="background-color:#f1f1f1">외주거래처</th>
									<td class="col-xs-5">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="account_cd" id="account_cd" readonly />
													<input type="text" name="account_nm" id="account_nm" onclick="centerOpenWindow('views/popup/accountList.php', '거래처리스트', 600, 500)" readonly />
													<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/accountList.php', '거래처리스트', 600, 500)">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span> <span class="summary">※ 외주거래처는 거래처에 먼저 등록이 되어있어야 합니다.</span>
												</div>
											</span>
										</div>
									</td>
								</tr>
							</table>
						</form>
					</div>
					<div class="widget-header">
					<div class="col-xs-2" style="float:left">
							<select class="" onchange="setProcess(this.value)">
								<option value="1공장">1공장</option>
								<option value="2공장">2공장</option>
								<option value="연태공장">연태공장</option>
								<!-- <option value="all">전체</option> -->
							</select>
						</div>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="process_list" class="table  table-bordered table-striped">
								<thead>
									<tr>
										<? if($_SESSION['login_level'] >= 99) { ?>
										<th class="detail-col center">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>
										<?}?>
										<th class="col-xs-4"><i class="ace-icon fa fa-caret-right blue"></i> 공정명</th>
										<th class="col-xs-3"><i class="ace-icon fa fa-caret-right blue"></i> 공정코드</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 공정구분</th>
										<th class="col-xs-3"><i class="ace-icon fa fa-caret-right blue"></i> 외주공정거래처</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div class="clearfix form-actions center" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-6" style="text-align:right">
								<button class="btn btn-info" type="button" onclick="registProcess()">
									<i class="ace-icon fa fa-check"></i>
									공정등록
								</button>
								<? if($_SESSION['login_level'] >= 99) { ?>
								<button class="btn btn-danger" type="button" onclick="deleteSelect()">
									<i class="ace-icon fa fa-undo"></i>
									선택삭제
								</button>
								<?}?>
							</div>
						</div>
					</div>
					<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />
<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="where" id="where" value="" />
<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	// 특수문자 입력 방지
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getProcess(page);
	//createProcessCode();

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

// 공정구분 리스트 가져오기
function setProcess(val) {
	$("#page").val(1);
	if(val == "all") {
		$("#where").val("");
	} else {
		$("#where").val(" where process_gb='" + val + "'");
	}
	getProcess(1);
}

// 코드 자동생성
function createProcessCode() {
	var process_gb = $("input[name='process_gb']:checked").val();
	var data_string = "mode=createProcessCode&process_gb=" + process_gb;

	$.ajax({
		type : "post",
		url : "ajax/base.php",
		data : data_string,
		success : function(str) {
			$("#process_cd").val(str);
		}
	});
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
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars="+ scrollbars; 
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars="+ scrollbars; 
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 

// 거래처 리스트 가져오기
function getProcess(page){
	var tag = "";

	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/base.php",{"mode":"getProcess", "where": where},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					tag += "<td><a href='#' onclick=\"postProcess(" + json[i].uid + ",'" + json[i].process_gb + "', '" + json[i].process_cd + "', '" + json[i].process_nm + "', '" + json[i].account_cd + "', '" + json[i].account_nm + "')\">" + json[i].process_nm + "</a></td>";
					tag += "<td><a href='#' onclick=\"postProcess(" + json[i].uid + ",'" + json[i].process_gb + "', '" + json[i].process_cd + "', '" + json[i].process_nm + "', '" + json[i].account_cd + "', '" + json[i].account_nm + "')\">" + json[i].process_cd + "</a></td>";
					tag += "<td><a href='#' onclick=\"postProcess(" + json[i].uid + ",'" + json[i].process_gb + "', '" + json[i].process_cd + "', '" + json[i].process_nm + "', '" + json[i].account_cd + "', '" + json[i].account_nm + "')\">" + json[i].process_gb + "</a></td>";
					tag += "<td><a href='#' onclick=\"postProcess(" + json[i].uid + ",'" + json[i].process_gb + "', '" + json[i].process_cd + "', '" + json[i].process_nm + "', '" + json[i].account_cd + "', '" + json[i].account_nm + "')\">" + json[i].account_nm + "</a></td>";
					tag += "</tr>";
				}
			}

			$("#process_list tbody").html(tag);
		}
	);
}

function postProcess(uid, process_gb, process_cd, process_nm, account_cd, account_nm) {
	$("#uid").val(uid);
	$('input:radio[name=process_gb][value=' + process_gb + ']').prop("checked", true);
	$("#process_cd").val(process_cd);
	$("#process_nm").val(process_nm);
	$("#account_cd").val(account_cd);
	$("#account_nm").val(account_nm);
}

function registProcess(){
	if(!check_str($("#process_cd").val(),"공정코드")) return false;
	if(!check_str($("#process_nm").val(),"공정명")) return false;

	var dataString = $("#frm").serialize();
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") {
				getProcess();
				$("#process_cd").val("");
				$("#process_nm").val("");
				$("#account_cd").val("");
				$("#account_nm").val("");
				//createProcessCode();
			} else alert(str);
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
			url : "ajax/base.php",
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