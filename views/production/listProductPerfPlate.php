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
				<li class="active">생산실적관리(도금)</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					생산실적관리(도금)
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						생산에 대한 실적(도금) 리스트를 보여드립니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->
			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="widget-header">
						<div class="col-xs-6" style="float:left">
							<select id="per" onchange="getProductPerfReports(1)">
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
						</div>
						<div class="col-xs-6" style="float:right">
							<div class="col-xs-5"  style="float:right">
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
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 도금일자</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 작업지시번호</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 구분</th>
										<!--
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 작업자</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 작업시간</th>
										-->
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 수량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 불량수량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 박스당수량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 공정이동표출력</th>
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
									(도금)실적등록
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
                 <h4 class="modal-title">실적처리등록(도금)</h4>

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
                 <h4 class="modal-title">실적처리수정(도금)</h4>

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

function search() {
	var txt = $("#search_txt").val();
	if(txt !=""){
		$("#where").val(" where item_cd like '%" + txt + "%' or item_nm like '%" + txt + "%' or work_cd like '%" + txt + "%' and");
	}else{
		$("#where").val("");
	}
	getProductPerfReports(1);
}

// 실적관리 리스트 가져오기
function getProductPerfReports(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();
	var gubun = "3";
	let totalProductQty = 0;
	let totalFaultQty = 0; 

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
					//tag += "<td><a href='javascript:void(0);'  onclick='product_p_reports_modiy(" + json[i].uid +")' >" + json[i].production_dt + "-"+json[i].production_cha+"</a></td>";
					tag += "<td><a href='javascript:void(0);'  onclick='product_p_reports_modiy(" + json[i].uid +")' >" + json[i].production_dt + "</a></td>";
					tag += "<td>" + json[i].work_cd + "</td>";
					tag += "<td>" + json[i].day_gubun + "("+json[i].process_nm+")</td>";
					//tag += "<td>" + json[i].emp_nm + "</td>";
					//tag += "<td>" + json[i].p_plan_tm + "</td>";
					tag += "<td><a href='javascript:void(0);'  onclick='product_p_reports_modiy(" + json[i].uid +")' >"+ json[i].item_cd + "</a></td>";
					tag += "<td><a href='javascript:void(0);'  onclick='product_p_reports_modiy(" + json[i].uid +")' >"+ json[i].item_nm + "</a></td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td class='text-right'>" + json[i].output_qty + "</td>";
					
					if(json[i].faulty_qty1 > 0) tag += "<td class='text-right'>" + json[i].faulty_qty1 + "<br>(" + json[i].faulty_type1 + ")</td>";
					else tag += "<td class='text-right'></td>";

					tag += "<td class='text-right'>" + json[i].box_limit_qty + "</td>";
					tag += "<td class='center'><button class=\"btn btn-white btn-info btn-bold\" onclick='openWin(" + json[i].uid +")' ><i class=\"ace-icon fa fa-print bigger-120 blue\"></i>인쇄</button></td>";
					tag += "</tr>";

					totalProductQty += Number(uncomma(json[i].output_qty));
					totalFaultQty += Number(uncomma(json[i].faulty_qty1));
				}

				tag += `<tr><td colspan='7'>합계</td><td class='text-right'>${comma(totalProductQty)}</td><td class='text-right'>${comma(totalFaultQty)}</td><td colspan='2'></td></tr>`;
			}else{
				tag += "<tr>";
				tag += "<td colspan='13' class='center' style='height:20px'> 등록된 도금 실적데이터가 없습니다. </td>";
				tag += "</tr>";
			}

			$("#product_perf_repost_list tbody").html(tag);

			where = " where process_nm='세척'";

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
	var url = "index.php?controller=production&action=registProductPerfPlate&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogID=id-btn-dialog1";
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
	
	var url = "index.php?controller=production&action=modifyProductPerfPlate&pop=Y&uid="+uid+"&dialogID=id-btn-dialog2";
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
	window.open("views/production/printProductPerfPlate.php?uid="+uid, "실적처리", "width=1024px, height=900, toolbar=no, menubar=no, scrollbars=yes, resizable=no" ); 
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