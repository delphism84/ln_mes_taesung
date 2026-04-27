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
				<li class="active">생산계획</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					생산계획
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						작업해야될 수주 리스트를 보여드립니다.
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
								<select id="per" class="form-control" onchange="getWorkPlan(1)" style="float:left; ">
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
								<div style="float:left">&nbsp;&nbsp;</div>
								
								<div style="float:left">
									<span class="input-icon input-icon-right">
										<div class="input-group ">
											<input type="text" class="date-picker form-control" name="plan_dt" id="plan_dt"  style="width:100px" value='<?=$end_date?>' data-date-format="yyyy/mm/dd" readonly/>
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<button type="button" class="btn btn-purple btn-sm form-control" onclick="search2()" >
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
												생산 계획일
											</button>
										</div>
									</span>
								</div>
							</div>
						</div>

						<div class="col-xs-4" style="float:right">
							<div class="col-xs-8"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="생산계획명" name="search_txt" id="search_txt" />
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
							<table id="workplan_list" class="table  table-bordered table-striped">
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
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 생산구분</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 생산계획코드</th>
										<th class="col-xs-3"><i class="ace-icon fa fa-caret-right blue"></i> 생산계획명</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 생산품목수</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 생산시작일</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 생산종료일</th>
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
								<button class="btn btn-info" type="button" onclick="workPlan_reg('0','0')">
									<i class="ace-icon fa fa-check"></i>
									생산계획등록
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
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>


<div id="id-btn-dialog1" class="modal fade" draggable="true">
    <div class="modal-dialog modal-lg" style="width:80%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">생산계획 등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="workPlan_reg_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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

<div id="id-btn-dialog2" class="modal fade" draggable="true">
    <div class="modal-dialog modal-lg" style="width:80%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">생산계획 수정</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="workPlan_modify_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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

<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="check_uids" id="check_uids" />

<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	var page = $("#page").val();
	getWorkPlan(page);

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

//생산계획명 검색
function search() {
	$("#plan_dt").val('');
	var txt = $("#search_txt").val();
	$("#where").val(" where title like '%" + txt + "%' ");
	getWorkPlan(1);
}

//생산계획일 검색
function search2() {
	$("#search_txt").val('');
	var txt2 = $("#plan_dt").val();
	$("#where").val(" where workplan_dt like '%" + txt2 + "%' ");
	getWorkPlan(1);
}

// 생산계획 리스트 가져오기
function getWorkPlan(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/production.php",{"page":page, "mode":"getWorkPlan", "rpp" : rpp, "adjacents" : adjacents, "where" : where},
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
					tag += "<td><a href='javascript:void(0);' onclick=\"workPlan_modiy('" + json[i].uid + "','" + json[i].workplan_dt + "','" + json[i].workplan_cha + "','" + json[i].state + "');\">" + json[i].workplan_cd + "</a></td>";
					tag += "<td>" + json[i].workplan_cd + "</a></td>";
					tag += "<td>" + json[i].title + "</a></td>";
					tag += "<td>" + json[i].cnt + "</td>";
					tag += "<td>" + json[i].start_dt + "</td>";
					tag += "<td>" + json[i].end_dt + "</td>";
					tag += "</tr>";
				}
			}else{
					tag += "<tr>";
					tag += "<td colspan='11' class='center'>등록된 작업계획서가 없습니다.</td>";
					tag += "</tr>";
			}

			$("#workplan_list tbody").html(tag);

			var table = "erp_workplan";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getWorkPlan(page);
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
	if(confirm("선택하신 생산계획 정보를 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectWorkplan&table=erp_estimate&uids=" + $("#check_uids").val();
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
					getWorkPlan(1);
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
	function workPlan_reg(cidx, acd)
	{
	$("#id-btn-dialog1").modal({
		show: true,
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=production&action=registPageWorkPlanPop&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogID=id-btn-dialog1";
	//var url = "./views/accounting/card/cardcompany_remark_list_pop.php?&sid="+cidx+"&pop=Y&ddd="+cidx;
	$("#workPlan_reg_frame").attr("src", url);
	}

	function workPlan_modiy(sid, dt, ca, st)
	{
	$("#id-btn-dialog2").modal({
		show: true,
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	
	var url = "index.php?controller=production&action=modifyPageWorkPlanPop&uid="+sid+"&pop=Y&work_dt="+dt+"&work_cha="+ca+"&state="+st+"&dialogID=id-btn-dialog2";
	//var url = "./views/accounting/card/cardcompany_remark_list_pop.php?&sid="+cidx+"&pop=Y&ddd="+cidx;
	$("#workPlan_modify_frame").attr("src", url);
	}

	function close_popup()
	{	
		$.modal.close();
		$("#workPlan_reg_frame").attr("src", "about:blank");
	}
	window.closeModal = function(obj) {
		$("#"+obj).modal( 'hide' );
	}
//-->
</script>
<script language="javascript" type="text/javascript">  
<!--  
function openWinPrint(sid){  
    window.open("/views/accounting/doc_form/print/statement_print.php?sid="+sid, "전표인쇄", "width=800, height=700, toolbar=no, menubar=no, scrollbars=yes, resizable=yes" );  
}  
//-->  
</script> 