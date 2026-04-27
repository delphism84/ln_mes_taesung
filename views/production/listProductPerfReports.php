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
					<a href="#">생산관리</a>
				</li>
				<li class="active">실적관리</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					실적관리
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						생산에 대한 실적 리스트를 보여드립니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->
			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="widget-header">
						<div class="col-xs-8" style="float:left">
							<div class="form-inline">
								<select id="per" class="form-control" onchange="getProductPerfReports(1)" style="float:left; ">
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
								<select id="machine" class="form-control" style="float:left;" onchange="getProductPerfReports(1)" >
									<option value="">호기선택</option>
									<option value="PRESS-01호기">PRESS-01호기</option>
									<option value="PRESS-02호기">PRESS-02호기</option>
									<option value="PRESS-03호기">PRESS-03호기</option>
									<option value="PRESS-04호기">PRESS-04호기</option>
									<option value="PRESS-05호기">PRESS-05호기</option>
									<option value="PRESS-06호기">PRESS-06호기</option>
									<option value="PRESS-07호기">PRESS-07호기</option>
									<option value="PRESS-08호기">PRESS-08호기</option>
									<option value="PRESS-09호기">PRESS-09호기</option>
									<option value="PRESS-10호기">PRESS-10호기</option>
									<option value="PRESS-11호기">PRESS-11호기</option>
									<option value="PRESS-12호기">PRESS-12호기</option>
									<option value="PRESS-13호기">PRESS-13호기</option>
									<option value="PRESS-14호기">PRESS-14호기</option>
									<option value="PRESS-16호기">PRESS-16호기</option>
									<option value="PRESS-17호기">PRESS-17호기</option>
									<option value="PRESS-18호기">PRESS-18호기</option>
									<option value="PRESS-19호기">PRESS-19호기</option>
									<option value="PRESS-20호기">PRESS-20호기</option>
									<option value="PRESS-21호기">PRESS-21호기</option>
								</select>
								<div style="float:left">&nbsp;&nbsp;</div>
								<div style="float:left">
									<span class="input-icon input-icon-right">
										<div class="input-group ">
											<input type="text" class="date-picker form-control" name="production_dt" id="production_dt" style="width:100px" value='' data-date-format="yyyy-mm-dd" readonly/>
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
										~
										<div class="input-group ">
											<input type="text" class="date-picker form-control" name="production_edt" id="production_edt" style="width:100px" value='' data-date-format="yyyy-mm-dd" readonly/>
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<button type="button" class="btn btn-purple btn-sm form-control" onclick="search2()" >
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
												생산일자
											</button>
										</div>
									</span>
								</div>
							</div>
						</div>

						<div class="col-xs-4" style="float:right">
							<div class="col-xs-8"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="품목명 /품목코드/ 작업지시번호" name="search_txt" id="search_txt" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="search()">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											Search
										</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="product_perf_repost_list" class="table  table-bordered table-striped">
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
										<th><i class="ace-icon fa fa-caret-right blue"></i> 생산일자</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 호기</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 구분(공정명)</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 작업자</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 작업시간</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 작업지시서</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 목표량</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 생산실적수량</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 초품불량</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> BURR</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 녹불량</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 스크래치</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 치수</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 변형</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 찍힘</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 박스당수량</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 공정이동표출력</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<div class="clearfix form-actions" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
							<div class="col-xs-6 right" style="text-align:right">
								<button class="btn btn-info" type="button" onclick="product_p_reports_reg('0','0')">
									<i class="ace-icon fa fa-check"></i>
									실적관리등록
								</button>
								<? if($_SESSION['login_level'] >= 99) { ?>
								<button class="btn btn-danger" type="button" onclick="deleteSelect()">
									<i class="ace-icon fa fa-undo"></i>
									선택삭제
								</button>
								<?}?>
								<!--
								<button class="btn " type="button" onclick="excelSelect()">
									<i class="ace-icon fa fa-undo"></i>
									excle
								</button>
								-->
							</div>
						</div>
					</div>
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="page" id="page" value="1" />
<!-- <input type="hidden" name="where" id="where" value=" where used='n'" /> -->
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="check_uids" id="check_uids" />

<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">실적처리등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="product_perf_report_reg_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="id-btn-dialog2" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">실적처리관리</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="product_perf_report_modify_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div id="id-btn-dialog3" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">실적처리인쇄</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="product_perf_report_print_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	var page = $("#page").val();
	getProductPerfReports(page);

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

//품목명 검색
function search() {
	$("#production_dt").val('');
	var txt = $("#search_txt").val();
	if(txt !=""){
		$("#where").val(" where item_cd like '%" + txt + "%' or item_nm like '%" + txt + "%' or work_cd like '%" + txt + "%' and");
	}else{
		$("#where").val("");
	}
	getProductPerfReports(1);
}

//생산일자 검색
function search2() { 
	$("#search_txt").val('');
	var txt2 = $("#production_dt").val();
	var txt3 = $("#production_edt").val();
	if(txt2 !=""){
		$("#where").val(" where production_dt between '" + txt2 + "' and '" + txt3 + "'");
	}else{
		$("#where").val();
	}
	getProductPerfReports(1);
}

// 실적관리 리스트 가져오기
function getProductPerfReports(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = "where 1=1";
	var txt2 = $("#production_dt").val();
	var txt3 = $("#production_edt").val();

	if(txt2 !="" && txt3 != ""){
		where += ` and production_dt between '${txt2}' and '${txt3}'`;
	}


	if($("#machine").val() != "") {
		where += " and machine_nm='" + $("#machine").val() + "'";
	}

	var gubun = "0";
	let totalProductQty = 0;
	let totalFaultQty1 = 0;
	let totalFaultQty2 = 0; 
	let totalFaultQty3 = 0; 
	let totalFaultQty4 = 0; 
	let totalFaultQty5 = 0; 
	let totalFaultQty6 = 0; 
	let totalFaultQty7 = 0; 

	$.getJSON("ajax/production.php",{"page":page, "mode":"getProductPerfReports", "rpp" : rpp, "adjacents" : adjacents, "where" : where, "gubun" : gubun},
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
					tag += "<td><a href='javascript:void(0);'  onclick='product_p_reports_modiy(" + json[i].uid +")' >" + json[i].production_dt + "</a></td>";
					tag += "<td>" + json[i].machine_nm + "</td>";
					tag += "<td>" + json[i].day_gubun + "("+json[i].process_nm+")</td>";
					tag += "<td>" + json[i].emp_nm + "</a></td>";
					tag += "<td>" + json[i].p_plan_tm + "</a></td>";
					tag += "<td><a href='javascript:void(0);'  onclick='product_p_reports_modiy(" + json[i].uid +")' >"+ json[i].item_cd + "</a></td>";
					tag += "<td><a href='javascript:void(0);'  onclick='product_p_reports_modiy(" + json[i].uid +")' >"+ json[i].item_nm + "</a></td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].work_cd + "</td>";
					tag += "<td class='text-right'>" + json[i].target_qty + "</td>";
					tag += "<td class='text-right'>" + json[i].output_qty + "</td>";
					if(json[i].faulty_qty1 > 0) tag += "<td class='text-right'>" + json[i].faulty_qty1 + "</td>";
					else tag += "<td class='text-right'>0</td>";
					if(json[i].faulty_qty2 > 0) tag += "<td class='text-right'>" + json[i].faulty_qty2 + "</td>";
					else tag += "<td class='text-right'>0</td>";
					if(json[i].faulty_qty3 > 0) tag += "<td class='text-right'>" + json[i].faulty_qty3 + "</td>";
					else tag += "<td class='text-right'>0</td>";
					if(json[i].faulty_qty4 > 0) tag += "<td class='text-right'>" + json[i].faulty_qty4 + "</td>";
					else tag += "<td class='text-right'>0</td>";
					if(json[i].faulty_qty5 > 0) tag += "<td class='text-right'>" + json[i].faulty_qty5 + "</td>";
					else tag += "<td class='text-right'>0</td>";
					if(json[i].faulty_qty6 > 0) tag += "<td class='text-right'>" + json[i].faulty_qty6 + "</td>";
					else tag += "<td class='text-right'>0</td>";
					if(json[i].faulty_qty7 > 0) tag += "<td class='text-right'>" + json[i].faulty_qty7 + "</td>";
					else tag += "<td class='text-right'>0</td>";
					tag += "<td class='text-right'>" + json[i].box_limit_qty + "</td>";
					tag += "<td class='center'><button class=\"btn btn-white btn-info btn-bold\" onclick='openWin(" + json[i].uid +")' ><i class=\"ace-icon fa fa-print bigger-120 blue\"></i>인쇄</button></td>";
					tag += "</tr>";

					totalProductQty += Number(uncomma(json[i].output_qty));
					totalFaultQty1 += Number(uncomma(json[i].faulty_qty1));
					totalFaultQty2 += Number(uncomma(json[i].faulty_qty2));
					totalFaultQty3 += Number(uncomma(json[i].faulty_qty3));
					totalFaultQty4 += Number(uncomma(json[i].faulty_qty4));
					totalFaultQty5 += Number(uncomma(json[i].faulty_qty5));
					totalFaultQty6 += Number(uncomma(json[i].faulty_qty6));
					totalFaultQty7 += Number(uncomma(json[i].faulty_qty7));
				}

				tag += `<tr><td colspan='10'>합계</td><td class='text-right'>${comma(totalProductQty)}</td><td class='text-right'>${comma(totalFaultQty1)}</td><td class='text-right'>${comma(totalFaultQty2)}</td><td class='text-right'>${comma(totalFaultQty3)}</td><td class='text-right'>${comma(totalFaultQty4)}</td><td class='text-right'>${comma(totalFaultQty5)}</td><td class='text-right'>${comma(totalFaultQty6)}</td><td class='text-right'>${comma(totalFaultQty7)}</td><td colspan='2'></td></tr>`;
			}else{
				tag += "<tr>";
				tag += "<td colspan='13' class='center' style='height:20px'> 등록된 실적 데이터가 없습니다. </td>";
				tag += "</tr>";
			}

			$("#product_perf_repost_list tbody").html(tag);

			var table = "erp_product_perf_repost";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getProductPerfReports(page);
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
	if(confirm("선택하신 실적처리 정보를 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectProductPerfReports&table=erp_product_perf_repost&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/production.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getProductPerfReports(1);
				}
			}
		});
	}
}
</script>

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
<script type="text/javascript">
<!--
	function product_p_reports_reg(cidx, acd)
	{
	$("#id-btn-dialog1").modal({
		show: true,
		title : "실적처리관리",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=production&action=registProductPerfReports&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogID=id-btn-dialog1";
	$("#product_perf_report_reg_frame").attr("src", url);
	}
			
	function product_p_reports_modiy(uid)
	{
	$("#id-btn-dialog2").modal({
		show: true,
		title : "실적처리관리",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	
	var url = "index.php?controller=production&action=modifyProductPerfReports&pop=Y&uid="+uid+"&dialogID=id-btn-dialog2";
	$("#product_perf_report_modify_frame").attr("src", url);
	}
	
	function product_p_reports_print(uid)
	{
	$("#id-btn-dialog3").modal({
		show: true,
		title : "실적처리인쇄",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	
	var url = "index.php?controller=production&action=productPerfReportsPrint&pop=Y&uid="+uid+"&dialogID=id-btn-dialog3";
	$("#product_perf_report_print_frame").attr("src", url);
	}

	function close_popup()
	{	
		$.modal.close();
		$("#product_perf_report_reg_frame").attr("src", "about:blank");
	}
	function closePopup()
	{
		window.parent.closeModal('<?=$dialogID?>');
		window.parent.location.reload();
	}
	window.closeModal = function(obj) {
		$("#"+obj).modal( 'hide' );
	}

//-->
</script>
<script language="javascript" type="text/javascript">  
<!--  
function openWin(uid){  
    //window.open("index.php?controller=production&action=productPerfReportsPrint&pop=Y&uid="+uid+"&dialogID=id-btn-dialog3", "실적처리", "width=600, height=900, toolbar=no, menubar=no, scrollbars=no, resizable=yes" ); 
	window.open("views/production/printProductPerfReports.php?uid="+uid, "실적처리", "width=1024px, height=900, toolbar=no, menubar=no, scrollbars=yes, resizable=no" ); 
}  
//-->  
</script>  
  
<script language="javascript" type="text/javascript">  
<!--  
function openWinPrint(uid){  
    window.open("/views/accounting/doc_form/print/product_perf_report_print.php?uid="+uid, "전표인쇄", "width=800, height=700, toolbar=no, menubar=no, scrollbars=yes, resizable=yes" );  
}  
//-->  
</script> 