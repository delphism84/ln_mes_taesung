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
					<a href="#">그룹웨어</a>
				</li>
				<li class="active">프로젝트 리스트</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					프로젝트 리스트
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 품목 프로젝트를 보여드립니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="col-xs-12">
						<div class="col-xs-1" style="float:left">
							<select class="form-control" onchange="setItem(this.value)">
								<option value="all">전체</option>
								<option value="1">원재료</option>
								<option value="2">부재료</option>
								<option value="3">제품</option>
								<option value="4">반제품</option>
								<option value="5">상품</option>
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
									<option value="item_nm">품목명</option>
									<option value="item_cd">품목코드</option>
									<option value="item_group_nm">그룹명</option>
								</select>
							</div>
						</div>
					</div>
					
					<div style="clear:both"></div>
					
					<div style="margin-top:10px">
						<table id="project_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="detail-col center" style="background-color:#f1f1f1">
										<label class="pos-rel">
											<input type="checkbox" class="ace" id="checkedAll" />
											<span class="lbl"></span>
										</label>
									</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">프로젝트코드</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">프로젝트명</th>
									<th class="col-xs-1 center" style="background-color:#f1f1f1">책임자</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">거래처</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">프로젝트 구분</th>
									<th class="col-xs-3 center" style="background-color:#f1f1f1">프로젝트 기간</th>
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
						<button class="btn btn-info" type="button" onclick="location.href = 'index.php?controller=groupware&action=inputPageProject' ">
							<i class="ace-icon fa fa-check"></i>
							프로젝트 등록
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
<input type="hidden" name="searchTxt" id="searchTxt" value="" />
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="item_gb" id="item_gb" value="" />
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />

<!-- basic script ------------------------------------------------------------------------------------------------------->

<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/common.js"></script>
<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- page specific plugin scripts -->
<!--[if lte IE 8]>
<script src="assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/chosen.jquery.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/daterangepicker.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!----------------------------------------------------------------------------------------------------------------------->
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


// 검색
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	if(search_choice == "item_nm") {
		$("#where").val(" where 1=1 and item_nm like '%" + txt + "%' ");
	} else if(search_choice == "item_cd") {
		$("#where").val(" where 1=1 and item_cd like '%" + txt + "%' ");
	} else if(search_choice == "item_group_nm") {
		$("#where").val(" where 1=1 and item_group_nm like '%" + txt + "%' ");
	}
	getProject(1);
}

// 거래처 리스트 가져오기
function getProject(page){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = page;
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();
	var search = $("#where").val();
	var item_gb = $("#item_gb").val();

	$.getJSON("ajax/groupware.php",{"page":page, "mode":"getProject", "rpp" : rpp, "adjacents" : adjacents, "where":search, "item_gb":item_gb, "search_choice" : search_choice, "txt" : txt},
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
					tag += "<td class='center'><a href='#' onclick='location.href = \"index.php?controller=groupware&action=modifyPageProject&uid=" + json[i].uid + "\"'>" + json[i].project_cd + "</a></td>";
					tag += "<td class='center'><a href='#' onclick='location.href = \"index.php?controller=groupware&action=modifyPageProject&uid=" + json[i].uid + "\"'>" + json[i].project_nm + "</a></td>";
					tag += "<td class='center'><a href='#' onclick='location.href = \"index.php?controller=groupware&action=modifyPageProject&uid=" + json[i].uid + "\"'>" + json[i].emp_nm + "</a></td>";
					tag += "<td class='center'>" + json[i].account_nm + "</td>";
					tag += "<td class='center'>" + json[i].project_gb + "</td>";
					tag += "<td class='center'>" + json[i].start_dt + " ~ " + json[i].end_dt + "</td>";
					tag += "</tr>";
				}
			}

			$("#project_list tbody").html(tag);

			var table = "erp_project";
			if(item_gb == "" || item_gb == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and item_gb='"  + item_gb + "'";
			}

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getProject(page);
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
	if(confirm("선택하신 품목 정보를 삭제하시겠습니까? 다른 데이터와 연동된 품목 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectProject&table=erp_project&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/groupware.php",
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

// 거래처 구분으로 거래처 리스트 가져오기
function setItem(val) {
	$("#page").val(1);
	$("#item_gb").val(val);
	$("#where").val(" where item_gb=" + val);
	getProject(1);
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