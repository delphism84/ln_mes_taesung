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
				<li class="active">창고 리스트</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					창고 리스트
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 창고 리스트를 보여드립니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div>
						<form id="frm">
							<input type="hidden" name="mode" id="mode" value="registWarehouse" />
							<input type="hidden" name="uid" id="uid" />
							<!-- 테이블 -->
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 창고구분</th>
									<td class="col-xs-5">
										<label>
											<input type="radio" class="ace" name="warehouse_gb" id="warehouse_gb" value="창고" checked <? if($_SESSION['auto_code'] == "y") echo "onclick='createWarehouseCode()'"; ?> />
											<span class="lbl"> 창고</span>
										</label>

										<label>
											<input type="radio" class="ace" name="warehouse_gb" id="warehouse_gb" value="공장" <? if($_SESSION['auto_code'] == "y") echo "onclick='createWarehouseCode()'"; ?> />
											<span class="lbl"> 공장</span>
										</label>

										<label>
											<input type="radio" class="ace" name="warehouse_gb" id="warehouse_gb" value="외주공장" <? if($_SESSION['auto_code'] == "y") echo "onclick='createWarehouseCode()'"; ?> />
											<span class="lbl"> 외주공장</span>
										</label>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 창고코드</th>
									<td class="col-xs-5"><input type="text" name="warehouse_cd" id="warehouse_cd" <? if($_SESSION['auto_code'] == "y") echo "readonly"; ?> /></td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 창고명</th>
									<td class="col-xs-5"><input type="text" class="form-control" name="warehouse_nm" id="warehouse_nm" /></td>
									<th class="col-xs-1" style="background-color:#f1f1f1">생산공정명</th>
									<td class="col-xs-5">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="text" name="process_nm" id="process_nm" onclick="centerOpenWindow('views/popup/processList.php', '공정리스트', 600, 500)" readonly />
													<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/processList.php', '공정리스트', 600, 500)">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span> <span class="summary"></span>
												</div>
											</span>
										</div>
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">외주거래처</th>
									<td class="col-xs-5" colspan="3">
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
					<div class="widget-header"></div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="warehouse_list" class="table  table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr>
										<? if($_SESSION['login_level'] >= 99) { ?>
										<th class="detail-col center">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>
										<?}?>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 구분</th>
										<th class="col-xs-4"><i class="ace-icon fa fa-caret-right blue"></i> 창고명</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 창고코드</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 생산공정명</th>
										<th class="col-xs-3"><i class="ace-icon fa fa-caret-right blue"></i> 외주거래처명</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<div class="clearfix form-actions center" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-12 center">
								<button class="btn btn-info" type="button" onclick="registWarehouse()">
									<i class="ace-icon fa fa-check"></i>
									창고등록
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
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />

<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->
<script>
$(document).ready(function(){
	// 특수문자 입력 방지
	//$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	<? if($_SESSION['auto_code'] == "y") { ?>
		//createWarehouseCode(); 
	<?}?>
	getWarehouse(page);

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

// 거래처 코드 자동생성
function createWarehouseCode() {
	var warehouse_gb = $("input[name='warehouse_gb']:checked").val();
	var data_string = "mode=createWarehouseCode&warehouse_gb=" + warehouse_gb;

	$.ajax({
		type : "post",
		url : "ajax/base.php",
		data : data_string,
		success : function(str) {
			$("#warehouse_cd").val(str);
		}
	});
}

// 거래처 리스트 가져오기
function getWarehouse(){
	var tag = "";

	$.getJSON("ajax/base.php",{"mode":"getWarehouse"},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
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
					tag += "<td>" + json[i].warehouse_gb + "</td>";
					tag += "<td><a href='#' onclick=\"postWarehouse(" + json[i].uid + ",'" + json[i].warehouse_gb + "','" + json[i].warehouse_cd + "','" + json[i].warehouse_nm + "','" + json[i].process_nm + "','" + json[i].account_cd + "','" + json[i].account_nm + "')\">" + json[i].warehouse_nm + "</a></td>";
					tag += "<td>" + json[i].warehouse_cd + "</td>";
					tag += "<td>" + json[i].process_nm + "</td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#warehouse_list tbody").html(tag);
		}
	);
}

// 선택 삭제
function deleteSelect(){
	if(confirm("선택하신 창고 정보를 삭제하시겠습니까? 다른 데이터와 연동된 창고 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectWarehouse&table=erp_warehouse&uids=" + $("#check_uids").val();
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
					getWarehouse(1);
				}
			}
		});
	}
}

function postWarehouse(uid, warehouse_gb, warehouse_cd, warehouse_nm, process_nm, account_cd, account_nm) {
	$("#uid").val(uid);
	$('input:radio[name=warehouse_gb][value=' + warehouse_gb + ']').prop("checked", true);
	$("#warehouse_cd").val(warehouse_cd);
	$("#warehouse_nm").val(warehouse_nm);
	$("#process_nm").val(process_nm);
	$("#account_cd").val(account_cd);
	$("#account_nm").val(account_nm);
}

function registWarehouse(){
	if(!check_str($("#warehouse_cd").val(),"창고코드")) return false;
	if(!check_str($("#warehouse_nm").val(),"창고명")) return false;

	var dataString = $("#frm").serialize();
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") {
				getWarehouse();
				$("#warehouse_cd").val("");
				$("#warehouse_nm").val("");
				$("#process_cd").val("");
				$("#process_nm").val("");
				$("#account_cd").val("");
				$("#account_nm").val("");
				//createWarehouseCode();
			} else alert(str);
		}
	});
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