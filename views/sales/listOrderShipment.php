<?
if (empty($date_type)) $date_type = "d";
if (empty($start_date)) 
	$start_date = date("Y/m/d", strtotime("-30 day"));
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
					<a href="#">영업관리</a>
				</li>
				<li class="active">출하지시서 리스트</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					출하지시서 리스트
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 수주 리스트를 보여드립니다.
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
								<select id="per" class="form-control" onchange="getOrderShipment(1)" style="float:left; ">
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
											<input class="date-picker form-control" name="start_dt" id="start_dt" type="text" style="width:100px" value='<?=$start_date?>' data-date-format="yyyy/mm/dd" />
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
											<input class="date-picker form-control" name="end_dt" id="end_dt" type="text" style="width:100px" value='<?=$end_date?>' data-date-format="yyyy/mm/dd" />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<button type="button" class="btn btn-purple btn-sm form-control" onclick="getOrderShipment(1)" >
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
									<input type="text" class="form-control search-query" placeholder="거래처" name="search_txt" id="search_txt" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="getOrderShipment()">
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
							<table id="order_shipment_list" class="table  table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr><? if($_SESSION['login_level'] >= 99) { ?>
										<th class="detail-col center">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>
										<?}?>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 출하지시번호</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 주문번호</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 거래처명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 거래처담당자</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 납기일자</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 수량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 진행상태</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 종결</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 인쇄</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 바코드</th>
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
								<button class="btn btn-info" type="button" id="btn-footer-Change" onclick="orderShipment_reg('0','0');">
									<i class="ace-icon fa fa-check"></i>
									출하지시등록
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


<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="check_uids" id="check_uids" />

<div id="id-btn-dialog1" class="modal fade" draggable="true">
    <div class="modal-dialog modal-lg" style="width:80%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">출하시지서</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="orderShipment_reg_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">출하 지시서 </h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="orderShipment_modify_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
	getOrderShipment(page);

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

// 출하지지 리스트 가져오기
function getOrderShipment(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	//var where = $("#where").val();
	var where = ` where shipment_dt between '${document.getElementById('start_dt').value}' and '${document.getElementById('end_dt').value}'`;

	$.getJSON("ajax/sales.php",{"page":page, "mode":"getOrderShipment", "rpp" : rpp, "adjacents" : adjacents, "where" : where},
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
					if(json[i].state == "complete") {
						var state = "출하완료";
						tag += "<td class='left'><a href='javascript:void(0);'  onclick=\"orderShipment_modiy(" + json[i].uid + "," + json[i].shipment_dt + "," + json[i].shipment_cha + ",'" + state + "');\">" + json[i].shipment_cd + "</a></td>";
					} else if(json[i].state == "ing") {
						var state = "출하중";
						tag += "<td class='left'><a href='javascript:void(0);'  onclick=\"orderShipment_modiy(" + json[i].uid + "," + json[i].shipment_dt + "," + json[i].shipment_cha + ",'" + state + "');\">" + json[i].shipment_cd + "</a></td>";
					} else if(json[i].state == "end") {
						var state = "종결";
						tag += "<td class='left'><a href='javascript:void(0);'  onclick=\"orderShipment_modiy(" + json[i].uid + "," + json[i].shipment_dt + "," + json[i].shipment_cha + ",'" + state + "');\">" + json[i].shipment_cd + "</a></td>";
					}
					tag += "<td>" + json[i].order_cd + "</td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "<td>" + json[i].manager + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].delivery_dt + "</td>";
					tag += "<td class='text-right'>" + json[i].cntTotal + "</td>";
					tag += "<td>" + state + "</td>";
					if(json[i].state == "end") {
						tag += "<td class='center'>종결</td>";
					}else {
						tag += "<td class='center'><a href='javascript:void(0);'  onclick='endSelect(" + json[i].uid + ");'>종결</a></td>";
					}

					tag += "<td class='center'><a href='javascript:void(0);'  onclick='shipment_print("+ json[i].uid +");'><i class=\"ace-icon fa fa-print bigger-120 blue\"></i> 인쇄</a></td>";
					tag += "<td class='center'><a href='javascript:void(0);'  onclick='openWin("+ json[i].uid +");'><i class=\"ace-icon fa fa-barcode bigger-120 blue\"></i> 바코드</a></td>";
					tag += "</tr>";
				}
			}

			//tag += "<tr><td colspan='8'></td></tr>";

			$("#order_shipment_list tbody").html(tag);

			var table = "erp_order";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getOrderShipment(page);
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
	if(confirm("선택하신 출하지시서 정보를 삭제하시겠습니까? 다른 데이터와 연동된 출하지시서 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectOrderShipment&table=erp_order_shipment&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/order.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getOrderShipment(1);
				}
			}
		});
	}
}

// 선택 종결
function endSelect(uid){
	if(confirm("선택한 전표를 종결처리 하겠습니까?\n종결된 전표는 수정이나 삭제가 불가능합니다.")) {
		var dataString = "mode=endSelectOrderShipment&table=erp_order_shipment&uid=" + uid;
		$.ajax({
			type : "post",
			url : "ajax/order.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getOrderShipment(1);
				}
			}
		});
	}
}



// 검색
function search(){
	var txt = $("#search_txt").val();
	$("#where").val(" where account_nm like '%" + txt + "%' ");
	getOrderShipment(1);
}
function shipment_print(est_cd, ctype)
{
	var param = "?est_cd="+est_cd;
	var url='';
		url = "../views/doc_form/shipping_print_pop.php" + param;
	var popwin = window.open(url, 'estimate_print', 'width=1000, height=900, scrollbars=yes, resizable=yes');
}

</script>

<script type="text/javascript">
<!--
	  //$("#id-btn-dialog3").show(); 
	  var url = "";

	  $('#id-btn-dialog1').attr('src', url);
	  $("#id-btn-dialog1").draggable({
      handle: "#modal-header1"
});

//-->
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
			todayHighlight: true,
				language: "kr"
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
	function orderShipment_reg(cidx, acd)
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
	var url = "index.php?controller=sales&action=registPageOrderShipmentPop&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogID=id-btn-dialog1";
	//var url = "./views/accounting/card/cardcompany_remark_list_pop.php?&sid="+cidx+"&pop=Y&ddd="+cidx;
	$("#orderShipment_reg_frame").attr("src", url);
	}

	function orderShipment_modiy(sid, dt, ca, st)
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

	var url = "index.php?controller=sales&action=modifyPageOrderShipmentPop&uid="+sid+"&pop=Y&shipment_dt="+dt+"&shipment_ca="+ca+"&state="+st+"&dialogID=id-btn-dialog2";
	//var url = "./views/accounting/card/cardcompany_remark_list_pop.php?&sid="+cidx+"&pop=Y&ddd="+cidx;
	$("#orderShipment_modify_frame").attr("src", url);
	}

	function close_popup()
	{	
		$.modal.close();
		$("#orderShipment_reg_frame").attr("src", "about:blank");
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
<script language="javascript" type="text/javascript">  
<!--  
function openWin(uid){  
	window.open("views/sales/printOrderShipment.php?uid="+uid, "실적처리", "width=1024px, height=900, toolbar=no, menubar=no, scrollbars=yes, resizable=no" ); 
}  
//-->  
</script> 