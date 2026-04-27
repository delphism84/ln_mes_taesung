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
				<li class="active">프로젝트 리스트</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					프로젝트 리스트
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 프로젝트를 보여드립니다.
					</small>
					<a href="#" class="btn btn-xs btn-app radius-4">
						<i class="ace-icon fa fa-cog"></i>
					</a>
				</h1>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<div class="widget-header">
						<div class="col-xs-6" style="float:left">
							<select id="per" onchange="getProject(1)">
								<option value="10">10개씩 보기</option>
								<option value="15">15개씩 보기</option>
								<option value="20">20개씩 보기</option>
								<option value="25">25개씩 보기</option>
								<option value="30">30개씩 보기</option>
								<option value="35">35개씩 보기</option>
								<option value="40">40개씩 보기</option>
								<option value="45">45개씩 보기</option>
								<option value="50">50개씩 보기</option>
								<option value="all">전체 보기</option>
							</select>
							<select onchange="setGb(this.value)">
								<option value="all">전체</option>
								<option value="생산 프로젝트">생산 프로젝트</option>
								<option value="개발 프로젝트">개발 프로젝트</option>
								<option value="판매 프로젝트">판매 프로젝트</option>
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
									<option value="all">전체</option>
									<option value="project_nm">프로젝트명</option>
									<option value="account_nm">거래처</option>
									<option value="emp_nm">책임자</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="project_list" class="table  table-bordered table-striped">
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
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 프로젝트코드</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 프로젝트명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 책임자</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 거래처</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 프로젝트 구분</th>
										<th class="col-xs-3"><i class="ace-icon fa fa-caret-right blue"></i> 프로젝트 기간</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<div class="clearfix form-actions center" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
							<div class="col-xs-6 right" style="text-align:right">
								<button class="btn btn-info" type="button" onclick="location.href = 'index.php?controller=base&action=inputPageProject' ">
									<i class="ace-icon fa fa-check"></i>
									프로젝트 등록
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
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="check_uids" id="check_uids" />

<? require_once ("assets/include_script.php"); ?>

<script>
$(document).ready(function(){
	var page = $("#page").val();
	getProject(page);

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

/******************************************************************************************************
:: 검색
******************************************************************************************************/
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();
	
	if(!check_empty(txt)) { alert("a"); }

	if(search_choice == "all") {
		$("#where").val("");
	} else if(search_choice == "project_nm") {
		$("#where").val(" where project_nm like '%" + txt + "%' ");
	} else if(search_choice == "account_nm") {
		$("#where").val(" where account_nm like '%" + txt + "%' ");
	} else if(search_choice == "emp_nm") {
		$("#where").val(" where emp_nm like '%" + txt + "%' ");
	}
	getProject(1);
}

/******************************************************************************************************
:: 프로젝트 구분값으로 데이터 가져오기
******************************************************************************************************/
function setGb(val) {
	$("#page").val(1);
	$("#where").val(" where project_gb='" + val + "'");
	getProject(1);
}

/******************************************************************************************************
:: 프로젝트 가져오기
******************************************************************************************************/
function getProject(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/base.php",{"page":page, "mode":"getProject", "rpp" : rpp, "adjacents" : adjacents, "where" : where},
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
					tag += "<td><a href='#' onclick='location.href = \"index.php?controller=base&action=modifyPageProject&uid=" + json[i].uid + "\"'>" + json[i].project_cd + "</a></td>";
					tag += "<td><a href='#' onclick='location.href = \"index.php?controller=base&action=modifyPageProject&uid=" + json[i].uid + "\"'>" + json[i].project_nm + "</a></td>";
					tag += "<td><a href='#' onclick='location.href = \"index.php?controller=base&action=modifyPageProject&uid=" + json[i].uid + "\"'>" + json[i].emp_nm + "</a></td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "<td>" + json[i].project_gb + "</td>";
					tag += "<td>" + json[i].start_dt + " ~ " + json[i].end_dt + "</td>";
					tag += "</tr>";
				}
			}else{
					tag += "<tr>";
					tag += "<td colspan='7' class='center'>등록된 프로젝트가 없습니다.</td>";
					tag += "</tr>";
			}


			$("#project_list tbody").html(tag);

			var table = "erp_project";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

/******************************************************************************************************
:: 페이지 세팅
******************************************************************************************************/
function setPage(page){
	$("#page").val(page);
	getProject(page);
}

/******************************************************************************************************
:: 페이징 가져오기
******************************************************************************************************/
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

/******************************************************************************************************
:: 선택삭제
******************************************************************************************************/
function deleteSelect(){
	if(confirm("선택하신 프로젝트 정보를 삭제하시겠습니까? 다른 데이터와 연동된 품목 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectProject&table=erp_project&uids=" + $("#check_uids").val();
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
					getProject(1);
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