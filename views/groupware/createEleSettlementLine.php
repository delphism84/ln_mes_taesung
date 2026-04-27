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
				<li class="active">결재라인 등록</li>
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
					결재라인 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						결재라인을 등록하여 사용하시면 됩니다.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">

					<form name="frm" id="frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="groupware" />
						<input type="hidden" name="action" id="action" value="registEleSettlementLine" />
						<input type="hidden" name="big_uid" id="big_uid" />
						<input type="hidden" name="middle_uid" id="middle_uid" />
						<input type="hidden" name="small_uid" id="small_uid" />

						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">결재라인명</th>
								<td class="col-xs-11">
									<input type="text" class="col-xs-12" name="approval_nm" id="approval_nm" />
								</td>
							</tr>
						</table>
						
						<div class="col-xs-5">
							<div>
								<select name="big_department_cd" id="big_department_cd" onchange="postBigDepartment(this.value)"><option value="all">부서선택</option></select>
								<select name="middle_department_cd" id="middle_department_cd" onchange="postMiddleDepartment(this.value)"><option value="all">부서선택</option></select>
								<select name="small_department_cd" id="small_department_cd" onchange="postSmallDepartment(this.value)"><option value="all">부서선택</option></select>
								<input type="button" class="btn btn-xs btn-success" value="사원검색" onclick="getApprovalEmployee()" />
							</div>
							<div style="margin-top:5px">
								<select name="from" id="undo_redo" class="form-control" multiple="multiple" style="height:280px">
								</select>
							</div>
						</div>

						<div class="col-xs-2" style="margin-top:37px">
							<button type="button" id="undo_redo_rightAll" class="btn btn-default btn-block"><i class="glyphicon glyphicon-forward"></i></button>
							<button type="button" id="undo_redo_rightSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
							<button type="button" id="undo_redo_leftSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
							<button type="button" id="undo_redo_leftAll" class="btn btn-default btn-block"><i class="glyphicon glyphicon-backward"></i></button>
							<button type="button" class="btn btn-default btn-block updown" value="Up"><i class="glyphicon glyphicon-arrow-up"></i></button>
							<button type="button" class="btn btn-default btn-block updown" value="Down"><i class="glyphicon glyphicon-arrow-down"></i></button>
						</div>

						<div class="col-xs-5" style="margin-top:37px">
							<select name="to[]" id="undo_redo_to" class="form-control" multiple="multiple" style="height:280px"></select>
						</div>
					</form>
				</div>
			</div>

			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						등록
					</button>

					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=groupware&action=listPageEleSettlementLine'">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록가기
					</button>
				</div>
			</div><!-- // submit -->

		</div>
	</div>
</div>

<?
require_once ("assets/include_script.php");
?>

<script src="assets/js/multiselect.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$( document).on('click',".updown", function() {
		var $op = $('#undo_redo_to option:selected'),$this = $(this);
		if($op.length){
			($this.val() == 'Up') ? $op.first().prev().before($op) : $op.last().next().after($op);
		}
	});

	getBigDepartment();
	getApprovalEmployee();
});

$(document).ready(function() {
	$('#undo_redo').multiselect();
});


// 거래처 리스트 가져오기
function getBigDepartment(){
	var tag = "<option value='all'>부서선택</option>";

	$.getJSON("ajax/base.php",{"mode":"getBigDepartment"},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}

			$("#big_department_cd").html(tag);
		}
	);
}

function getMiddleDepartment(){
	var fid = $("#big_uid").val();
	var tag = "<option value='all'>부서선택</option>";

	$.getJSON("ajax/base.php",{"mode":"getMiddleDepartment", "fid" : fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}

			$("#middle_department_cd").html(tag);
		}
	);
}

function getSmallDepartment(){
	var fid = $("#middle_uid").val();
	var tag = "<option value='all'>부서선택</option>";

	$.getJSON("ajax/base.php",{"mode":"getSmallDepartment", "fid" : fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}
			$("#small_department_cd").html(tag);
		}
	);
}

function postBigDepartment(uid){
	$("#big_uid").val(uid);
	getMiddleDepartment();
	$("#department_small_list tbody").html("");
}

function postMiddleDepartment(uid){
	$("#middle_uid").val(uid);
	getSmallDepartment();
}

function postSmallDepartment(uid){
	$("#small_uid").val(uid);
}

function formSubmit(){
	    $('#undo_redo_to option').prop('selected', true);
	    $("#frm").submit();
}
</script>
<script type="text/javascript">

function getApprovalEmployee() {
	var tag = "";
	var big_department_cd = $("#big_department_cd option:selected").val();
	var middle_department_cd = $("#middle_department_cd option:selected").val();
	var small_department_cd = $("#small_department_cd option:selected").val();

	$.getJSON("ajax/employee.php",{"mode":"getApprovalEmployee","big_department_cd" : big_department_cd, "middle_department_cd" : middle_department_cd, "small_department_cd" : small_department_cd},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].emp_id + "'>" + json[i].emp_nm + "</option>";
				}
			}

			$("#undo_redo").html(tag);
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