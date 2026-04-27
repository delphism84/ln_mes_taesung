<?
if (empty($date_type)) $date_type = "d";
if (empty($start_date)) 
	$start_date = date("Y/m/d", strtotime("-60 day"));
else if (strlen($start_date) < 8) $start_date .= (strlen($start_date) == 4)?"01/01":"01";

if (empty($end_date)) 
	$end_date = date("Y/m/d");
else if (strlen($end_date) < 8) $end_date .= (strlen($end_date) == 4)?"01/01":"01";	
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
					<a href="#">구매관리</a>
				</li>
				<li class="active">구매입고등록</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					구매입고
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						구매입고등록 화면 입니다.
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
								<select id="per" class="form-control" onchange="getPurchase(1)" style="float:left; ">
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
										<div class="input-group">
											<input class="date-picker form-control" name="start_dt" id="start_dt" type="text" style="width:100px" value='<?=$start_date?>' data-date-format="yyyy-mm-dd" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</div>
								<div style="float:left">&nbsp;~&nbsp;</div>
								<div style="float:left">
									<span class="input-icon input-icon-right">
										<div class="input-group ">
											<input class="date-picker form-control" name="end_dt" id="end_dt" type="text" style="width:100px" value='<?=$end_date?>' data-date-format="yyyy-mm-dd" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<button type="button" class="btn btn-purple btn-sm form-control" onclick="getPurchase(1)" >
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
												Search
											</button>
										</div>
									</span>
								</div>
							</div>
						</div>

						<div class="col-xs-4" style="float:right">
							<div class="col-xs-8"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="구매번호" name="search_txt" id="search_txt" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="getPurchase(1)">
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
							<table id="warehousing_list" class="table table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr><? if($_SESSION['login_level'] >= 99) { ?>
										<th class="detail-col center">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>
										<? } ?>	
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 구매번호</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 발주일자</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 거래처</th>
										<!-- <th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 품번</th> -->
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 입고창고</th>
										<!-- <th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> LOT_NO</th> -->
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 금액</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 구매수량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 입고수량</th>
										<!--
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 잔여수량</th>
										-->
										<!-- <th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 불량수량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 불량내용</th> -->
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 수령여부</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 인쇄</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<div class="clearfix form-actions center" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-12 center"><span id="paging_area"></span></div>
						</div>
	
						<div class="col-md-12">
							<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
							<div class="col-xs-6 right" style="text-align:right">
								<button class="btn btn-info" type="button" onclick="warehousing_reg('0','0')">
									<i class="ace-icon fa fa-check"></i>
									구매입고등록
								</button>
								<? if($_SESSION['login_level'] >= 99) { ?>
								<button class="btn btn-danger" type="button" onclick="deleteSelect()">
									<i class="ace-icon fa fa-undo"></i>
									선택삭제
								</button>
								<?}?>
								<button class="btn " type="button" onclick="selectBarcodePrint()">
									<i class="ace-icon fa fa-undo"></i>
									바코드선택출력
								</button>
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
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="check_uids" id="check_uids" />

<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">구매입고등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="warehousing_reg_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
                 <h4 class="modal-title">구매입고수정</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="warehousing_modify_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
                <p><iframe src="" id="warehousing_print_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
<style>
	/* 로딩*/
	#Progress_Loading {
		height: 100%;
		left: 0px;
		position: fixed;
		_position:absolute; 
		top: 0px;
		width: 100%;
		filter:alpha(opacity=50);
		-moz-opacity:0.5;
		opacity : 0.5;
	}
	.loading {
		background-color: white;
		z-index: 199;
	}
	#loading_img{
		position:absolute; 
		top:35%;
		left:45%;
		/*height:35px;
		
		margin-top:-75px;	
		margin-left:-75px;	
		*/
		z-index: 200;
	}

</style>
<div id = "Progress_Loading"><!-- 로딩바 -->
<img id="loading_img" src="/assets/images/data_loading.gif"/> 데이터 로딩중......ㅇ
</div>
<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
   $('#Progress_Loading').hide(); //첫 시작시 로딩바를 숨겨준다.
})
.ajaxStart(function(){
	$('#Progress_Loading').show(); //ajax실행시 로딩바를 보여준다.
})
.ajaxStop(function(){
	$('#Progress_Loading').hide(); //ajax종료시 로딩바를 숨겨준다.
});
 
</script>
<script>
$(document).ready(function(){
	var page = $("#page").val();
	getPurchase(page);

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

// 구매입고 리스트 가져오기
function getPurchase(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();
	var txt = $("#search_txt").val();
	var end_dt = $("#end_dt").val();
	var start_dt = $("#start_dt").val();

	$.getJSON("ajax/purchase.php",{"page":page, "mode":"getWarehousing", "rpp" : rpp, "adjacents" : adjacents, "where": where, "search_txt": txt, "start_dt": start_dt, "end_dt": end_dt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
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
					tag += "<td class='left'><a href='javascript:void(0);'  onclick='warehousing_modiy(" + json[i].uid + ");'>" + json[i].warehousing_cd + "</a></td>";
					tag += "<td class='left'><a href='javascript:void(0);'  onclick='warehousing_modiy(" + json[i].uid + ");'>" + json[i].p_order_cd + "</a></td>";
					tag += "<td class='left'>" + json[i].account_nm + "</td>";
					//tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + json[i].cnt_text +"</td>";
					tag += "<td class='text-nowrap' style='color:green'>" + json[i].warehouse_nm + "</td>";
					//tag += "<td>" + json[i].lot_no_cd + "</td>";
					tag += "<td class='text-right'>" + json[i].priceTotal + "</td>";
					tag += "<td class='text-right'>" + json[i].cntTotal + "</td>";
					tag += "<td class='text-right'>" + json[i].warehousing_total + "</td>";
					//tag += "<td class='text-right'>" + json[i].rest_total + "</td>";
					//tag += "<td style='text-align:right'>" + json[i].faulty_cnt + "</td>";
					//tag += "<td style='text-align:right'>" + json[i].faulty_content + "</td>";

					if(json[i].state =="입고취소"){
						tag += "<td class='center' style='color:red;'>" + json[i].state + "</td>";
					}else if( json[i].state =="입고완료" ){
						tag += "<td class='center' style='color:green;'>" + json[i].state + "</td>";
					}else{
						tag += "<td class='center' style='color:gray;'>" + json[i].state + "</td>";
					}
					//if(json[i].state == "stay") tag += "<input type='button' class='btn btn-xs' value='전량입고' onclick='pavable(" + json[i].uid + ")' />";
					//if(json[i].state == "part") tag += "<input type='button' class='btn btn-xs id-btn-dialog1' value='부분입고' onclick='changeMode(1, " + json[i].uid + ")' /> <!--<input type='button' class='btn btn-xs id-btn-dialog2' value='반품처리' onclick='changeMode(2, " + json[i].uid + ")' />-->";
					
					if(json[i].state !="입고취소"){
						tag += "<td class='center'><button type='button' class='btn btn-xs btn-success' onclick='warehousingPrint("+ json[i].uid +");' style='padding:0 0 0 0'>인쇄</button>&nbsp;<button type='button' class='btn btn-xs' onclick='warehousing_barcode_Print("+ json[i].uid +");' style='padding:0 0 0 0'>바코드</button></td>";
					}else{
						tag += "<td class='center'></td>";
					}

					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='13' class='center' style='height:20px'> 등록된 구매 입고 리스트가 없습니다. </td>";
				tag += "</tr>";
			}

			$("#warehousing_list tbody").html(tag);

			var table = "erp_warehousing";

			where = " where 1=1";
			if(txt != "") {
				where += " and (warehousing_dt like '%"+txt+"%' or account_nm like '%"+txt+"%' or manager like '%"+txt+"%')";
			}

			if(start_dt != "" && end_dt != "") {
				where += " AND ( left(warehousing_dt,10) between '"+start_dt+"' and '"+end_dt+"')";
			}

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getPurchase(page);
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
	if(confirm("선택하신 구매입고 내역을 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectWarehousing&table=erp_warehousing&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/purchase.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getPurchase(1);
				}
			}
		});
	}
}

// 선택 출력
function selectBarcodePrint(){

	$(".chk").each(function(){
		if($(this).prop('checked')) {
			var new_uid = $("#check_uids").val() + "," + $(this).val();
			$("#check_uids").val(new_uid);
		}
	});

	if ($("#check_uids").val()=="")
	{
		alert('선택된 데이터가 없습니다.\n출력할 바코드를 체크한 후 다시 시도 하세요.')
		return false;
	}
	var p_cd= $("#check_uids").val();

	var param	= "?uid="+p_cd;
	var url		= '';
		url		= "../../views/doc_form/warehousing_select_barcode_print.php" + param;
	var popwin	= window.open(url, 'warehousing_print', 'width=1000, height=900, scrollbars=yes, resizable=yes, toolbar=no, menubar=no');	
}

function warehousingPrint(p_cd, ctype)
{
	var param	= "?uid="+p_cd;
	var url		= '';
		url		= "../../views/doc_form/warehousing_into_print.php" + param;
	var popwin	= window.open(url, 'warehousing_print', 'width=1000, height=900, scrollbars=yes, resizable=yes');
}

function warehousing_barcode_Print(p_cd, ctype)
{
	var param	= "?uid="+p_cd;
	var url		= '';
		url		= "../../views/doc_form/warehousing_barcode_print.php" + param;
	var popwin	= window.open(url, 'warehousing_print', 'width=1000, height=900, scrollbars=yes, resizable=yes, toolbar=no, menubar=no');
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
	//로딩후 팝업창 dialog 띄우기 완전 좋은 방법 GOOD
	/*
	$('<div><img src="/assets/images/clock_positive_lg.gif" id="loading" /></div>').load('/faq.html').dialog({
    height: 300,
    width: 600,
    title: 'Wait for it...'
	});
	*/
	function warehousing_reg(cidx, acd){
	$("#id-btn-dialog1").modal({
		show: true,
		title : "구매입고등록",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=purchase&action=registPageWarehousingPop&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogID=id-btn-dialog1";
	$("#warehousing_reg_frame").attr("src", url);
	}
			
	function warehousing_modiy(uid) {
		
	$("#id-btn-dialog2").modal({
		show: true,
		title : "구매입고등록",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	
	var url = "index.php?controller=purchase&action=modifyPageWarehousingPop&pop=Y&uid="+uid+"&dialogID=id-btn-dialog2";
	$("#warehousing_modify_frame").attr("src", url);
	}
	
	function warehousing_print(uid)
	{
	$("#id-btn-dialog3").modal({
		show: true,
		title : "구매입고등록",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	
	var url = "index.php?controller=production&action=productPerfReportsPrint&pop=Y&uid="+uid+"&dialogID=id-btn-dialog3";
	$("#warehousing_print_frame").attr("src", url);
	}

	function close_popup()
	{	
		$.modal.close();
		$("#warehousing_reg_frame").attr("src", "about:blank");
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
	window.open("views/production/printProductPerfReports.php?uid="+uid, "실적처리", "width=800, height=900, toolbar=no, menubar=no, scrollbars=yes, resizable=no" ); 
}  
//-->  
</script>  
  
<script language="javascript" type="text/javascript">  
<!--  
function openWinPrint(uid){  
    window.open("/views/accounting/doc_form/print/warehousing_item_print.php?uid="+uid, "전표인쇄", "width=800, height=700, toolbar=no, menubar=no, scrollbars=yes, resizable=yes" );  
}  
//-->  
</script> 