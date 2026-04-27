

<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">그룹웨어</a>
				</li>
				<li class="active">전자결재 등록</li>
			</ul><!-- /.breadcrumb -->

			<div class="nav-search" id="nav-search">
				<form class="form-search">
					<span class="input-icon">
						<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
						<i class="ace-icon fa fa-search nav-search-icon"></i>
					</span>
				</form>
			</div><!-- /.nav-search -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					전자결재 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						기안서를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" />
						<input type="hidden" name="controller" id="controller" value="groupware" />
						<input type="hidden" name="action" id="action" value="registEleSettlement" />

						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">제목</th>
								<td class="col-xs-5"><input type="text" class="form-control" name="title" id="title" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">양식</th>
								<td class="col-xs-5">
									<select name="document" id="document">
										<option value="none">양식을 선택하세요</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">결재자</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="approval_nm" id="approval_nm" />
												<input type="hidden" name="approval_uid" id="approval_uid" />
												<span class="input-group-addon btn-danger" id="id-btn-dialog1">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff">결재라인</i>
												</span>
												<span class="input-group-addon btn-primary" onclick="location.href='index.php?controller=groupware&action=inputPageEleSettlementLine'">
													<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff">결재라인등록</i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">참조자</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="refer" id="refer" />
												<input type="hidden" name="refer_id" id="refer_id" />
												<span class="input-group-addon btn-purple" id="id-btn-dialog2">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">구매요청서</th>
								<td colspan="3" class="col-xs-11">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="purchase_cd" id="purchase_cd" value="<?=$_GET['purchase_cd'] ?>" />
												<span class="input-group-addon btn-purple" id="id-btn-dialog3">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">첨부파일</th>
								<td colspan="3" class="col-xs-11"><input type="file" class="form-control" name="attach" id="attach" /></td>
							</tr>
							<tr>
								<td colspan="4"><textarea name="comment" id="comment"></textarea></td>
								<script src="ckeditor/ckeditor.js"></script>
								<script>
								CKEDITOR.replace( 'comment',{
									filebrowserImageUploadUrl:"upload.php?type=Images",
									width : '100%',
									height : '500px'
								});
								</script>
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
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=groupware&action=listPageMyEleSettlement' ">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록돌아가기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<div id="dialog-message1" class="dialog-view hide">
	<table id="approval_list" class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">결재라인명</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">결재자</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<div id="dialog-message2" class="dialog-view hide">
	<select name="department" id="department" onchange="getEmployee()"></select>
	<table id="emp_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-2 center" style="background-color:#f1f1f1">부서</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">사원명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<div id="dialog-message3" class="dialog-view hide">
	<table id="purchase_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-2 center" style="background-color:#f1f1f1">구매요청코드</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">구매금액</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<?
require_once("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	getDepartment();
	getEmployee();
	getEleSettlementLine();
	getPurchase();
});

function getDepartment() {
	var tag = "<option value='all'>부서를 선택하세요</option>";
	$.getJSON("ajax/employee.php",{"mode":"getDepartment"},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}

			$("#department1").html(tag);
			$("#department2").html(tag);
		}
	);
}

function getPurchase() {
	var tag = "";
	$.getJSON("ajax/purchase.php",{"mode":"getPurchase"},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postPurchase('" + json[i].purchase_cd + "')\">" + json[i].purchase_cd + "</a></td>";
					tag += "<td>" + json[i].total_price + "</td>";
					tag += "</tr>";
				}
			}

			$("#purchase_list").html(tag);
		}
	);
}

function postPurchase(purchase_cd) {
	$("#purchase_cd").val(purchase_cd);
}

// 거래처 리스트 가져오기
function getEleSettlementLine(){
	var tag = "";
	$.getJSON("ajax/groupware.php",{"mode":"getEleSettlementLine"},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td class='center'><a href='#' onclick=\"postApproval('" + json[i].emp + "','" + json[i].uid + "')\">" + json[i].approval_nm + "</a></td>";
					tag += "<td>" + json[i].emp + "</td>";
					tag += "</tr>";
				}
			}

			$("#approval_list tbody").html(tag);
		}
	);
}

function postApproval(approval, uid) {
	$("#approval_nm").val(approval);
	$("#approval_uid").val(uid);
}

function getEmployee() {
	var tag = "";
	var department_cd = $("#department1 option:selected").val();
	$.getJSON("ajax/employee.php",{"mode":"getApprovalEmployee","department_cd":department_cd},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td>" + json[i].department_nm + "</td>";
					tag += "<td><a href='#' onclick=\"postEmp('" + json[i].emp_nm + "', '" + json[i].emp_id + "')\">" + json[i].emp_nm + "</a></td>";
					tag += "</tr>";
				}
			}

			$("#emp_list tbody").html(tag);
		}
	);
}

function postEmp(emp_nm,emp_id) {
	$("#refer").val(emp_nm);
	$("#refer_id").val(emp_id);
}

function formSubmit() {
	$("#frm").submit();
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
				
	$( "#id-btn-dialog1" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>결재라인 리스트</h4></div>",
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

				
	$( "#id-btn-dialog2" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message2" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>사원 리스트</h4></div>",
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

	$( "#id-btn-dialog3" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message3" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>구매요청서 리스트</h4></div>",
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