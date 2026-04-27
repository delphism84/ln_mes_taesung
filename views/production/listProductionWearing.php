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
				<li class="active">생산입고</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					생산입고
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						생산입고 조회 리스트를 보여드립니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<!-- <div class="alert alert-block alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<i class="ace-icon fa fa-check green"></i>
						생산입고 생성 후 재고관리의 자재출고 관리에서 원자재 및 반제품을 출고 시켜야 생산입고가 보입니다.
					</div> -->

					<div class="widget-header">
						<div class="col-xs-6" style="float:left">
							<select id="per" onchange="getProductionWearing(1)">
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
								<option value="0">대기중</option>
								<option value="1">생산입고중</option>
								<option value="2">생산입고완료</option>
							</select>
						</div>
						<div class="col-xs-6" style="float:right">
							<div class="col-xs-4"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="품목명" name="search_txt" id="search_txt" />
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
							<table id="work_list" class="table  table-bordered table-striped">
								<thead>
									<tr>
										<? if($_SESSION['login_level'] >= 99) { ?>
										<th class="detail-col center">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>
										<?}?>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 입고번호</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 생산공장명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 입고창고명</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 재질</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 단위</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 수량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 작업지시서</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 인쇄</th>
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
								<button class="btn btn-info" type="button" onclick="productionWearing_reg('0','0')">
									<i class="ace-icon fa fa-check"></i>
									생산입고등록
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
                 <h4 class="modal-title">생산입고 등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="productionWearing_reg_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
                 <h4 class="modal-title">생산입고 수정</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="productionWearing_modify_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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


<div id="dialog-message1" class="dialog-view hide">
	<table id="account_list" class="table  table-bordered table-hover">
		<tr>
			<th class="col-xs-2 center" style="background-color:#f1f1f1">수량</th>
			<td class="col-xs-5 center"><input type="text" id="cnt" name="cnt" /></td>
		</tr>
	</table>
</div><!-- #dialog-message -->

<input type="hidden" name="page" id="page" value="1" />
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />
<input type="hidden" name="uid" id="uid" />
<input type="hidden" name="where" id="where" value="" />


<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
function wopen(uid) {
	var features = "width=1000,height=900,scrollbars=auto,resizable=no,top=0,left=0,toolbar=no";
	//window.open("views/popup/work.php?work_cd=" + work_cd,"새창입니다",features);
	window.open("views/doc_form/pro_work_order_print_3.php?uid=" + uid,"새창입니다",features);
}

$(document).ready(function(){
	var page = $("#page").val();
	getProductionWearing(page);

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
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 

// 거래처 리스트 가져오기
function getProductionWearing(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/production.php",{"page":page, "mode":"getProductionWearing", "rpp" : rpp, "adjacents" : adjacents, "where" : where},
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

					if(json[i].state == "0") var state = "대기중";
					else if(json[i].state == "1") var state = "입고중";
					else if(json[i].state == "2") var state = "입고완료";
					else if(json[i].state == "3") var state = "취소";
					else if(json[i].state == "4") var state = "종결";

					if(json[i].state == "1") tag += "<td><a href='javascript:void(0);' onclick=\"productionWearing_modiy('" + json[i].uid + "','" + json[i].work_dt + "','" + json[i].work_cha + "','" + json[i].state + "');\">" + json[i].work_cd + "</a></td>";
					else tag += "<td>" + json[i].work_cd + "</td>";
					
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "<td>" + json[i].deadline_dt + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].material + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					tag += "<td>" + json[i].order_cnt + "</td>";
					tag += "<td class='text-right'>" + json[i].make_cnt + "</td>";
					tag += "<td class='text-center'>" + state + "</td>";
					if(json[i].state == "4") {
						tag += "<td class='center' ><a href='javascript:void(0);'  onclick='endCancelSelect(" + json[i].uid + ");'><span style='color:#ff6600'>취소</span></a></td>";
					}else {
						tag += "<td class='center'><a href='javascript:void(0);'  onclick='endSelect(" + json[i].uid + ");'>종결</a></td>";
					}
					tag += "<td  class='text-center'><a href='#' onclick=\"wopen('" + json[i].uid + "')\">인쇄</a></td>";
					//if(json[i].remain_cnt == 0) {
					//	tag += "<td></td>";
					//} else if(json[i].remain_cnt > 0 && json[i].make_cnt > 0) {
					//	tag += "<td><input type='button' class='btn btn-xs btn-success id-btn-dialog' value='일부생산' onclick=\"centerOpenWindow('views/popup/partProduction.php?uid=" + json[i].uid + "', '일부생산', 300, 300)\" /></td>";
					//} else {
					//	tag += "<td><input type='button' class='btn btn-xs btn-danger' value='전량생산' onclick='registAllIn(" + json[i].uid + "," + json[i].order_cnt + ")' /> <input type='button' class='btn btn-xs btn-success' value='일부생산' onclick=\"centerOpenWindow('views/popup/partProduction.php?uid=" + json[i].uid + "', '일부생산', 300, 300)\" /></td>";
					//}
					tag += "</tr>";
				}
			}else{
					tag += "<tr>";
					tag += "<td colspan='13' class='center'>등록된 생산입고가 없습니다.</td>";
					tag += "</tr>";
			}

			$("#work_list tbody").html(tag);

			var table = "erp_work";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 선택 종결
function endSelect(uid){
	if(confirm("선택한 생산입고 전표를 종결처리 하겠습니까?\n종결된 생산입고 전표는 수정이나 삭제가 불가능합니다.")) {
		var dataString = "mode=endSelectproductionWearing&table=erp_work&uid=" + uid;
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
					getProductionWearing(1);
				}
			}
		});
	}
}

// 선택 종결 취손
function endCancelSelect(uid){
	if(confirm("선택한 생산입고 전표를 종결 취소처리 하겠습니까?\n취소된 생산입고 전표는 리스트에서 확인 가능 능합니다.")) {
		var dataString = "mode=endCancelSelectproductionWearing&table=erp_work&uid=" + uid;
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
					getProductionWearing(1);
				}
			}
		});
	}
}


// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getProductionWearing(page);
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
	if(confirm("선택하신 생산입고 정보를 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectWork&table=erp_estimate&uids=" + $("#check_uids").val();
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
					getProductionWearing(1);
				}
			}
		});
	}
}

function registAllIn(uid, cnt) {
	if(confirm("전량 생산입고 처리 하시겠습니까?")) {
		var dataString = "mode=registAllIn&uid=" + uid+ "&cnt=" + cnt;
		$.ajax({
			type : "post",
			data : dataString,
			url : "ajax/production.php",
			success : function(str) {
				if(str == "success") getProductionWearing(1);
			}
		});
	}
}

function setGb(val) {
	if(val == "all") $("#where").val("");
	else if(val == "ing") $("#where").val(" where remain_cnt > 0");
	else if(val == "complete") $("#where").val(" where remain_cnt=0");
	getProductionWearing(1);
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

<script type="text/javascript">
<!--
	function productionWearing_reg(cidx, acd)
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
	var url = "index.php?controller=production&action=registPageProductionWearing&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogID=id-btn-dialog1";
	//var url = "./views/accounting/card/cardcompany_remark_list_pop.php?&sid="+cidx+"&pop=Y&ddd="+cidx;
	$("#productionWearing_reg_frame").attr("src", url);
	}

	function productionWearing_modiy(sid, dt, ca, st)
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
	
	var url = "index.php?controller=production&action=modifyPageProductionWearing&uid="+sid+"&pop=Y&work_dt="+dt+"&work_cha="+ca+"&state="+st+"&dialogID=id-btn-dialog2";
	$("#productionWearing_modify_frame").attr("src", url);
	}

	function close_popup()
	{	
		$.modal.close();
		$("#productionWearing_reg_frame").attr("src", "about:blank");
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