

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
				<li class="active">차량관리</li>
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
					차량관리
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						차량관리 내용을 등록하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="groupware" />
						<input type="hidden" name="action" id="action" value="registCar" />
						<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />

						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">차량번호</th>
								<td class="col-xs-5"><input type="text" name="car_no" id="car_no" value="<?=$t->car_no?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">차종</th>
								<td class="col-xs-5">
									<select name="car_gb" id="car_gb">
										<option value="대형">대형</option>
										<option value="중형">중형</option>
										<option value="소형">소형</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">구입일</th>
								<td class="col-xs-5">
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class=" date-picker" name="in_dt" id="in_dt" type="text" data-date-format="yyyy-mm-dd" value="<?=$t->in_dt?>" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">관리담당자</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="emp_nm" id="emp_nm" value="<?=$t->charge_nm?>" onclick="centerOpenWindow('views/popup/employeeList.php', '사원리스트', 600, 500)" />
												<input type="hidden" name="emp_id" id="emp_id" value="<?=$t->charge_id?>" />
												<span class="input-group-addon btn-danger" style="cursor:pointer" onclick="centerOpenWindow('views/popup/employeeList.php', '사원리스트', 600, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
						</table>

						<!-- submit -->
						<div class="clearfix form-actions center">
							<div class="col-md-12">
								<button class="btn btn-info" type="button" onclick="formSubmit()">
									<i class="ace-icon fa fa-check bigger-110"></i>
									수정
								</button>
								&nbsp; &nbsp; &nbsp;
								<button class="btn" type="reset" onclick="location.href = 'index.php?controller=groupware&action=listPageCar'">
									<i class="ace-icon fa fa-undo bigger-110"></i>
									목록가기
								</button>
							</div>
						</div><!-- // submit -->

<!----------------------------------------------------------------------------------------------------------------------------->
						<div class="tabbable">
							<ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
								<li class="active">
									<a data-toggle="tab" href="#faq-tab-1">
										<i class="blue ace-icon fa fa-question-circle bigger-120"></i>
										사고이력
									</a>
								</li>

								<li>
									<a data-toggle="tab" href="#faq-tab-2">
										<i class="green ace-icon fa fa-user bigger-120"></i>
										정비이력
									</a>
								</li>

								<li>
									<a data-toggle="tab" href="#faq-tab-3">
										<i class="orange ace-icon fa fa-credit-card bigger-120"></i>
										운행일지
									</a>
								</li>
							</ul>

							<div class="tab-content no-border padding-24">
								<div id="faq-tab-1" class="tab-pane fade in active">
									<h4 class="blue">
										<i class="ace-icon fa fa-check bigger-110"></i>
										사고이력
									</h4>

									<div class="space-8"></div>

									<div>
										<table id="simple-table" class="table  table-bordered table-hover">
											<tr>
												<th class="col-xs-1" style="background-color:#f1f1f1">사고일시</th>
												<td class="col-xs-3" >
													<div>
														<span class="input-icon input-icon-right">
															<div class="input-group">
																<input class=" date-picker" name="accident_dt" id="accident_dt" type="text" data-date-format="yyyy-mm-dd" placeholder="사고일시" />
																<span class="input-group-addon">
																	<i class="fa fa-calendar bigger-110"></i>
																</span>
															</div>
														</span> 
													</div>
												</td>
												<th class="col-xs-1" style="background-color:#f1f1f1">사고내용</th>
												<td class="col-xs-3" ><input type="text" class="form-control" name="accident_memo" id="accident_memo" /></td>
												<th class="col-xs-1" style="background-color:#f1f1f1">사고결과</th>
												<td class="col-xs-3" >
													<div class="input-group">
														<span class="input-icon input-icon-right">
															<div class="input-group">
																<input type="text" name="accident_result" id="accident_result" />
																<span class="input-group-addon btn-danger" id="id-btn-dialog1" onclick="registAccident()" style="cursor:pointer">
																	<i class="ace-icon  icon-on-right bigger-110" style="color:#ffffff">등록</i>
																</span>
															</div>
														</span>
													</div>
												</td>
											</tr>
										</table>
									</div>

									<div style="margin-top:10px">
										<table id="accident_list" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th class="col-xs-2 center" style="background-color:#f1f1f1">사고일시</th>
													<th class="col-xs-2 center" style="background-color:#f1f1f1">사고내용</th>
													<th class="col-xs-1 center" style="background-color:#f1f1f1">사고결과</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>

								<div id="faq-tab-2" class="tab-pane fade">
									<h4 class="blue">
										<i class="green ace-icon fa fa-user bigger-110"></i>
										정비이력
									</h4>

									<div class="space-8"></div>

									<div>
										<table id="simple-table" class="table  table-bordered table-hover">
											<tr>
												<th class="col-xs-1" style="background-color:#f1f1f1">정비일시</th>
												<td class="col-xs-3" >
													<div>
														<span class="input-icon input-icon-right">
															<div class="input-group">
																<input class=" date-picker" name="service_dt" id="service_dt" type="text" data-date-format="yyyy-mm-dd" placeholder="정비일시" />
																<span class="input-group-addon">
																	<i class="fa fa-calendar bigger-110"></i>
																</span>
															</div>
														</span> 
													</div>
												</td>
												<th class="col-xs-1" style="background-color:#f1f1f1">정비내용</th>
												<td class="col-xs-3" ><input type="text" class="form-control" name="service_memo" id="service_memo" /></td>
												<th class="col-xs-1" style="background-color:#f1f1f1">정비비용</th>
												<td class="col-xs-3" >
													<div class="input-group">
														<span class="input-icon input-icon-right">
															<div class="input-group">
																<input type="text" name="service_cost" id="service_cost" />
																<span class="input-group-addon btn-danger" id="id-btn-dialog1" onclick="registService()" style="cursor:pointer">
																	<i class="ace-icon  icon-on-right bigger-110" style="color:#ffffff">등록</i>
																</span>
															</div>
														</span>
													</div>
												</td>
											</tr>
										</table>
									</div>

									<div style="margin-top:10px">
										<table id="service_list" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th class="col-xs-2 center" style="background-color:#f1f1f1">정비일시</th>
													<th class="col-xs-2 center" style="background-color:#f1f1f1">정비내용</th>
													<th class="col-xs-1 center" style="background-color:#f1f1f1">정비비용</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>

								<div id="faq-tab-3" class="tab-pane fade">
									<h4 class="blue">
										<i class="orange ace-icon fa fa-credit-card bigger-110"></i>
										운행일지
									</h4>

									<div class="space-8"></div>

									<div>
										<table id="simple-table" class="table  table-bordered table-hover">
											<tr>
												<th class="col-xs-1" style="background-color:#f1f1f1">운행일자</th>
												<td class="col-xs-3" >
													<div>
														<span class="input-icon input-icon-right">
															<div class="input-group">
																<input class=" date-picker" name="drive_dt" id="drive_dt" type="text" data-date-format="yyyy-mm-dd" placeholder="운행일시" />
																<span class="input-group-addon">
																	<i class="fa fa-calendar bigger-110"></i>
																</span>
															</div>
														</span> 
													</div>
												</td>
												<th class="col-xs-1" style="background-color:#f1f1f1">운행목적</th>
												<td class="col-xs-3" ><input type="text" class="form-control" name="drive_object" id="drive_object" /></td>
												<th class="col-xs-1" style="background-color:#f1f1f1">운행거리</th>
												<td class="col-xs-3" >
													<div class="input-group">
														<span class="input-icon input-icon-right">
															<div class="input-group">
																<input type="text" name="drive_km" id="drive_km" />
																<span class="input-group-addon btn-danger" id="id-btn-dialog1" onclick="registDrive()" style="cursor:pointer">
																	<i class="ace-icon  icon-on-right bigger-110" style="color:#ffffff">등록</i>
																</span>
															</div>
														</span>
													</div>
												</td>
											</tr>
										</table>
									</div>
									<div style="margin-top:10px">
										<table id="drive_list" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th class="col-xs-2 center" style="background-color:#f1f1f1">운행일시</th>
													<th class="col-xs-2 center" style="background-color:#f1f1f1">운행목적</th>
													<th class="col-xs-1 center" style="background-color:#f1f1f1">운행거리</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
<!------------------------------------------------------------------------------------------------------------------------------>
					</form>
				</div>
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	getAccident();
	getService();
	getDrive();
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

function formSubmit(){
	if(!check_str($("#car_no").val(),"차량번호")) return false;
	if(!check_str($("#in_dt").val(),"구입일")) return false;
	if(!check_str($("#emp_id").val(),"관리담당자")) return false;
	$("#frm").submit();
}

function registAccident(){
	if(!check_str($("#accident_dt").val(),"사고일시")) return false;
	if(!check_str($("#accident_memo").val(),"사고내용")) return false;

	var dataString = "mode=registAccident&fid=" + $("#uid").val() + "&accident_dt=" + $("#accident_dt").val() + "&accident_memo=" + $("#accident_memo").val() + "&accident_result=" + $("#accident_result").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/groupware",
		success : function(str) {
			if(str == "success") getAccident();
			else alert(str);
		}
	});
}

function registService() {
	if(!check_str($("#service_dt").val(),"정비일시")) return false;
	if(!check_str($("#service_memo").val(),"정비내용")) return false;

	var dataString = "mode=registService&fid=" + $("#uid").val() + "&service_dt=" + $("#service_dt").val() + "&service_memo=" + $("#service_memo").val() + "&service_cost=" + $("#service_cost").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/groupware",
		success : function(str) {
			if(str == "success") getService();
			else alert(str);
		}
	});
}

function registDrive() {
	if(!check_str($("#drive_dt").val(),"운행일자")) return false;
	if(!check_str($("#drive_object").val(),"운행목적")) return false;
	if(!check_str($("#drive_km").val(),"운행거리")) return false;

	var dataString = "mode=registDrive&fid=" + $("#uid").val() + "&drive_dt=" + $("#drive_dt").val() + "&drive_object=" + $("#drive_object").val() + "&drive_km=" + $("#drive_km").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/groupware",
		success : function(str) {
			if(str == "success") getDrive();
			else alert(str);
		}
	});
}

function getAccident(){
	var tag = "";
	var fid = $("#uid").val();
	$.getJSON("ajax/groupware.php",{"mode":"getAccident","fid":fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td>" + json[i].accident_dt + "</td>";
					tag += "<td>" + json[i].accident_memo + "</td>";
					tag += "<td>" + json[i].accident_result + " km</td>";
					tag += "</tr>";
				}
			}

			$("#accident_list tbody").html(tag);
		}
	);
}

function getService() {
	var tag = "";
	var fid = $("#uid").val();
	$.getJSON("ajax/groupware.php",{"mode":"getService","fid":fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td>" + json[i].service_dt + "</td>";
					tag += "<td>" + json[i].service_memo + "</td>";
					tag += "<td>" + json[i].service_cost + " km</td>";
					tag += "</tr>";
				}
			}

			$("#service_list tbody").html(tag);
		}
	);
}

function getDrive() {
	var tag = "";
	var fid = $("#uid").val();
	$.getJSON("ajax/groupware.php",{"mode":"getDrive","fid":fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td>" + json[i].drive_dt + "</td>";
					tag += "<td>" + json[i].drive_object + "</td>";
					tag += "<td>" + json[i].drive_km + " km</td>";
					tag += "</tr>";
				}
			}

			$("#drive_list tbody").html(tag);
		}
	);
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