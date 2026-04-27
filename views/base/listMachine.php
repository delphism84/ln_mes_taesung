<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">기준정보관리</a>
				</li>
				<li class="active">기계 등록</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					기계 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						생산공정에서 가동하는 기계를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<div>
						<form id="frm">
							<input type="hidden" name="uid" id="uid"/>
							<input type="hidden" name="mode" id="mode" value="registMachine" />
							<input type="hidden" name="page" id="page" value="1" />
							<input type="hidden" name="where" id="where" value="" />
							<!-- 테이블 -->
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 공정</th>
									<td class="col-xs-5">
										<select name="process_gb" id="process_gb" onchange="setProcess(this.value)">
										<OPTION value="1공장">1공장</OPTION>
										<OPTION value="2공장">2공장</OPTION>
										<OPTION value="연태공장">연태공장</OPTION>
										</select>
										<select name="process_cd" id="process_cd"></select>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 기계명</th>
									<td class="col-xs-5"><input type="text" name="machine_nm" id="machine_nm" /></td>
								</tr>
							</table>
						</form>
					</div>
					<div>
						<div class="widget-main no-padding">
							<table id="machine_list" class="table table-bordered table-striped">
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
										<th class="col-xs-4"><i class="ace-icon fa fa-caret-right blue"></i> 공정구분</th>
										<th class="col-xs-4"><i class="ace-icon fa fa-caret-right blue"></i> 공정명</th>
										<th class="col-xs-4"><i class="ace-icon fa fa-caret-right blue"></i> 기계명</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>

					<div class="clearfix form-actions center" style="margin-top:0px">
						<div class="col-md-12 center">
							<button class="btn btn-info" type="button" onclick="registMachine()">
									<i class="ace-icon fa fa-check"></i>
									기계등록
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
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->


<input type="hidden" name="check_uids" id="check_uids" />

<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function() {
	// 특수문자 입력 방지
	//$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	
	var rpp = $("#per").val();
	var page = $("#page").val();
	getProcess(page);
	getMachine();
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

function getProcess(page){
	var tag = "";
	var page = page;
	var where = $("#where").val();
	
	$.getJSON("ajax/base.php",{"mode":"getProcess", "where": where},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].process_cd +"'>" + json[i].process_nm + "</option>";
				}
			}
			//$("#process_cd").append(tag);
			$("#process_cd ").html(tag);
		}
	);
}

function getMachine() {
	var tag = "";

	$.getJSON("ajax/base.php",{"mode":"getMachine"},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					<? if($_SESSION['login_level'] >= 99) {?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					tag += "<td><a href='#' onclick=\"postMachine(" + json[i].uid + ",'" + json[i].process_cd + "', '" + json[i].machine_nm + "')\">" + json[i].process_gb + "</a></td>";
					tag += "<td><a href='#' onclick=\"postMachine(" + json[i].uid + ",'" + json[i].process_cd + "', '" + json[i].machine_nm + "')\">" + json[i].process_nm + "</a></td>";
					tag += "<td><a href='#' onclick=\"postMachine(" + json[i].uid + ",'" + json[i].process_cd + "', '" + json[i].machine_nm + "')\">" + json[i].machine_nm + "</a></td>";
					tag += "</tr>";
				}
			}

			$("#machine_list tbody").html(tag);
		}
	);
}

function postMachine(uid, process_cd, machine_nm) {
	$("#uid").val(uid);
	$("#process_cd > option[value=" + process_cd + "]").attr("selected", "true");
	$("#machine_nm").val(machine_nm);
}

function registMachine(){
	if(!check_str($("#machine_nm").val(),"기계명")) return false;
	var dataString = $("#frm").serialize();
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") {
				getMachine();
				$("#machine_nm").val("");
			} else {
				alert(str);
			}
		}
	});
}

// 선택 삭제
function deleteSelect(){
	if(confirm("선택하신 기계 정보를 삭제하시겠습니까? 다른 데이터와 연동된 기계 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectMachine&table=erp_machine&uids=" + $("#check_uids").val();
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
					getMachine(1);
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