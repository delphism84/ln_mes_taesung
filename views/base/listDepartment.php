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
				<li class="active">부서 관리</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					부서 관리
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 부서 리스트를 보여드립니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div>
						<div class="col-xs-4" style="float:left">
							<form id="frm">
								<input type="hidden" name="big_uid" id="big_uid" />
								<input type="hidden" name="middle_uid" id="middle_uid" />
								<input type="hidden" name="small_uid" id="small_uid" />

								<!-- 테이블 -->
								<table id="simple-table" class="table  table-bordered table-hover">
									<tr>
										<th style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 부서명</th>
										<td><input type="text" class="form-control" name="big_department_nm" id="big_department_nm" /></td>
									</tr>
									<tr>
										<th style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 출력순서</th>
										<td>
											<input type="text" class="onlynum" name="big_seq" id="big_seq" /> 
											<input type="button" class="btn btn-xs btn-inverse" value="생성 및 수정" onclick="registBigDepartment()" />
											<? if($_SESSION['login_level'] >= 99) { ?><input type="button" class="btn btn-xs btn-danger" value="삭제" onclick="deleteBigDepartment()" /><?}?></td>
										</td>
									</tr>
								</table>
							</form>
							<div class="widget-main no-padding">
								<table id="department_big_list" class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 부서명</th>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 출력순서</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
						<div class="col-xs-4" style="float:left">
							<!-- 테이블 -->
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<th style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 부서명</th>
									<td><input type="text" class="form-control" name="middle_department_nm" id="middle_department_nm" /></td>
								</tr>
								<tr>
									<th style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 출력순서</th>
									<td>
										<input type="text" class="onlynum" name="middle_seq" id="middle_seq" /> 
										<input type="button" class="btn btn-xs btn-inverse" value="생성 및 수정" onclick="registMiddleDepartment()" />
										<? if($_SESSION['login_level'] >= 99) { ?><input type="button" class="btn btn-xs btn-danger" value="삭제" onclick="deleteMiddleDepartment()" /><?}?></td>
									</td>
								</tr>
							</table>
							<div class="widget-main no-padding">
								<table id="department_middle_list" class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 부서명</th>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 출력순서</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
						<div class="col-xs-4" style="float:left">
							<!-- 테이블 -->
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<th style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 부서명</th>
									<td><input type="text" class="form-control" name="small_department_nm" id="small_department_nm" /></td>
								</tr>
								<tr>
									<th style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 출력순서</th>
									<td>
										<input type="text" class="onlynum" name="small_seq" id="small_seq" />
										 <input type="button" class="btn btn-xs btn-inverse" value="생성 및 수정" onclick="registSmallDepartment()" />
										 <? if($_SESSION['login_level'] >= 99) { ?><input type="button" class="btn btn-xs btn-danger" value="삭제" onclick="deleteSmallDepartment()" /><?}?></td>
								</tr>
							</table>							
							<div class="widget-main no-padding">
								<table id="department_small_list" class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 부서명</th>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 출력순서</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>


<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	// 특수문자 입력 방지
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	getBigDepartment();
});

// 거래처 리스트 가져오기
function getBigDepartment(){
	var tag = "";

	$.getJSON("ajax/base.php",{"mode":"getBigDepartment"},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postBigDepartment(" + json[i].uid + ",'" + json[i].department_nm + "'," + json[i].seq + ")\">" + json[i].department_nm + "</a></td>";
					tag += "<td>" + json[i].seq + "</td>";
					tag += "</tr>";
				}
			}

			$("#department_big_list tbody").html(tag);
		}
	);
}

function getMiddleDepartment(){
	var fid = $("#big_uid").val();
	var tag = "";

	$.getJSON("ajax/base.php",{"mode":"getMiddleDepartment", "fid" : fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postMiddleDepartment(" + json[i].uid + ",'" + json[i].department_nm + "'," + json[i].seq + ")\">" + json[i].department_nm + "</a></td>";
					tag += "<td>" + json[i].seq + "</td>";
					tag += "</tr>";
				}
			}

			$("#department_middle_list tbody").html(tag);
		}
	);
}

function getSmallDepartment(){
	var fid = $("#middle_uid").val();
	var tag = "";

	$.getJSON("ajax/base.php",{"mode":"getSmallDepartment", "fid" : fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postSmallDepartment(" + json[i].uid + ",'" + json[i].department_nm + "'," + json[i].seq + ")\">" + json[i].department_nm + "</a></td>";
					tag += "<td>" + json[i].seq + "</td>";
					tag += "</tr>";
				}
			}

			$("#department_small_list tbody").html(tag);
		}
	);
}

function postBigDepartment(uid,name,seq){
	$("#big_uid").val(uid);
	$("#big_seq").val(seq);
	$("#big_department_nm").val(name);
	getMiddleDepartment();
	$("#department_small_list tbody").html("");
}

function postMiddleDepartment(uid,name,seq){
	$("#middle_uid").val(uid);
	$("#middle_seq").val(seq);
	$("#middle_department_nm").val(name);
	getSmallDepartment();
}

function postSmallDepartment(uid,name,seq){
	$("#small_uid").val(uid);
	$("#small_seq").val(seq);
	$("#small_department_nm").val(name);
}

function registBigDepartment() {
	if(!check_str($("#big_department_nm").val(),"부서명")) return false;
	if(!check_str($("#big_seq").val(),"출력순서")) return false;

	var uid = $("#big_uid").val();
	var department_nm = $("#big_department_nm").val();
	var seq = $("#big_seq").val();
	var dataString = "mode=registBigDepartment&department_nm=" + department_nm + "&seq=" + seq + "&uid=" + uid;

	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") getBigDepartment();
			$("#big_department_nm").val("");
			$("#big_seq").val("");
			$("#big_uid").val("");
		}
	});
}

function registMiddleDepartment() {
	if(!check_str($("#middle_department_nm").val(),"부서명")) return false;
	if(!check_str($("#middle_seq").val(),"출력순서")) return false;

	var uid = $("#middle_uid").val();
	var fid = $("#big_uid").val();
	var department_nm = $("#middle_department_nm").val();
	var seq = $("#middle_seq").val();
	var dataString = "mode=registMiddleDepartment&department_nm=" + department_nm + "&seq=" + seq + "&fid=" + fid + "&uid=" + uid;

	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") getMiddleDepartment();
			$("#middle_department_nm").val("");
			$("#middle_seq").val("");
			$("#middle_uid").val("");
		}
	});
}

function registSmallDepartment() {
	if(!check_str($("#small_department_nm").val(),"부서명")) return false;
	if(!check_str($("#small_seq").val(),"출력순서")) return false;

	var uid = $("#small_uid").val();
	var fid = $("#middle_uid").val();
	var department_nm = $("#small_department_nm").val();
	var seq = $("#small_seq").val();
	var dataString = "mode=registSmallDepartment&department_nm=" + department_nm + "&seq=" + seq + "&fid=" + fid + "&uid=" + uid;

	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") getSmallDepartment();
			$("#small_department_nm").val("");
			$("#small_seq").val("");
			$("#small_uid").val("");
		}
	});
}

function deleteBigDepartment(){
	if(!check_str($("#big_uid").val(),"부서명")) return false;
	var uid = $("#big_uid").val();
	var dataString = "mode=deleteBigDepartment&uid=" + uid;
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") {
				getBigDepartment();
			} else if(str == "son") {
				alert("하위 카테고리를 먼저 삭제하시고 진행하세요");
				return false;
			}
		}
	});
}

function deleteMiddleDepartment(){
	if(!check_str($("#middle_uid").val(),"부서명")) return false;
	var uid = $("#middle_uid").val();
	var dataString = "mode=deleteMiddleDepartment&uid=" + uid;
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") {
				getMiddleDepartment();
			} else if(str == "son") {
				alert("하위 카테고리를 먼저 삭제하시고 진행하세요");
				return false;
			}
		}
	});
}

function deleteSmallDepartment(){
	if(!check_str($("#small_uid").val(),"부서명")) return false;
	var uid = $("#small_uid").val();
	var dataString = "mode=deleteSmallDepartment&uid=" + uid;
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") getSmallDepartment();
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
				$(this).find('.chosen-container').each(function(){
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