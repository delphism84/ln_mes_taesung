<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);

$end_day = date("t", mktime(0, 0, 0, 12, 1, 2007));

?>
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
					<a href="#">인사/급여</a>
				</li>
				<li class="active">금액직접 입력</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">

			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div class="col-xs-12">
						<div class="col-xs-2" style="float:left">
							<select id="department" class="form-control" onchange="setDepartment(this.value)">
								<option value="all">전체부서</option>
							</select>
						</div>

						<div class="col-xs-8" style="float:right">
							<div class="col-xs-6"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="Search..." name="search_txt" id="search_txt"/>
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
									<option value="emp_nm">사원명</option>
									<option value="emp_cd">사원코드</option>
								</select>
							</div>
						</div>
					</div>
					
					<div style="clear:both"></div>

					<div style="margin-top:10px">
						<table id="employee_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="detail-col center" style="background-color:#f1f1f1">
										<label class="pos-rel">
											<input type="checkbox" class="ace" id="checkedAll" />
											<span class="lbl"></span>
										</label>
									</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">사원코드</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">사원명</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">부서</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">직급</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">수당총액</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">공제총액</th>
									
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
						<!-- <button class="btn btn-danger" type="button" onclick="deleteSelect()">
							<i class="ace-icon fa fa-undo"></i>
							선택삭제
						</button> -->
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
<input type="hidden" name="pay_check_dt" id="pay_check_dt" value="<?=$pay_check_dt?>" />
<input type="hidden" name="pay_check_ca" id="pay_check_ca" value="<?=$pay_check_ca?>" />
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />

<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/common.js"></script>
<script>
$(document).ready(function(){
	var page = $("#page").val();
	getEmployee(page);
	getDepartment(1);

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
function getDepartment(page) {
	var rpp = 15;
	var adjacents = 4;
	var page = page;
	var opt = "";

	$.getJSON("ajax/department.php",{"page":page, "mode":"getDepartment", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					
					opt += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}

				$("#department").append(opt);
			}

			
		}
	);
}

// 거래처 리스트 가져오기
function getEmployee(page){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();
	var search = $("#where").val(); 
	var pay_check_dt = $("#pay_check_dt").val();
	var pay_check_ca = $("#pay_check_ca").val();
	var page = page;
	//alert(pay_check_dt)

	$.getJSON("ajax/salary.php",{"page":page, "mode":"getEmployee", "rpp" : rpp, "adjacents" : adjacents, "pay_check_dt" : pay_check_dt, "pay_check_ca" : pay_check_ca, "where":search, "search_choice" : search_choice, "txt" : txt},
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
					tag += "<td><a href='index.php?controller=salary&action=registPayMemberPop&uid=" + json[i].uid + "&pay_check_dt=<?=$pay_check_dt?>&pay_check_ca=<?=$pay_check_ca?>&lastday=<?=$lastday?>&emp_cd=" + json[i].emp_cd + "&emp_nm=" + json[i].emp_nm + "'>" + json[i].emp_cd + "</td>";
					tag += "<td>" + json[i].emp_nm + "</td>";
					tag += "<td class='center'>" + json[i].department_nm + "</td>";
					tag += "<td class='center'>" + json[i].position_nm + "</td>";
					tag += "<td class='center'>" + json[i].txtPayAmt1_arr_sum + "</td>";
					tag += "<td class='center'>" + json[i].txtPayAmt2_arr_sum + "</td>";
					tag += "</tr>";
				}
			}

			$("#employee_list tbody").html(tag);
			

			var table = "erp_employee";
			if(emp_gb == "" || emp_gb == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and emp_gb='"  + account_gb + "'";
			}

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getEmployee(page);
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
	if(confirm("선택하신 사원 정보를 삭제하시겠습니까? 다른 데이터와 연동된 사원 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectEmployee&table=erp_employee&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/employee.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getEmployee(1);
				}
			}
		});
	}
}

// 거래처 구분으로 거래처 리스트 가져오기
function setDepartment(val) {
	$("#page").val(1);
	$("#pay_check_dt").val(val);
	getEmployee(1);
}

// 검색
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	if(search_choice == "emp_cd") {
		$("#where").val(" where 1=1 and emp_cd like '%" + txt + "%' ");
	} else if(search_choice == "emp_nm") {
		$("#where").val(" where 1=1 and emp_nm like '%" + txt + "%' ");
	}
	getEmployee(1);
}
</script>

<!-- basic scripts -->

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

<!-- inline scripts related to this page -->
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