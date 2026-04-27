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
					<a href="#">재고관리</a>
				</li>
				<li class="active">자재출고관리</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					출고요청
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						출고요청 리스트 화면 입니다.
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
								<select id="per" class="form-control" onchange="getReleaseRequest(1)" style="float:left; ">
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
											<button type="button" class="btn btn-purple btn-sm form-control" onclick="getReleaseRequest(1)" >
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
										<button type="button" class="btn btn-purple btn-sm" onclick="getReleaseRequest(1)">
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
							<table id="release_request_list" class="table table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr><? if($_SESSION['login_level'] >= 99) { ?>
										<th class="detail-col center">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>
										<? } ?>	
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 출고번호</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 출고창고</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 생산공장</th>
										<th class="col-xs-3"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 수량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 작업지시서</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 상태</th>
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
								<button class="btn btn-info" type="button" onclick="Release_request_reg('0','0')">
									<i class="ace-icon fa fa-check"></i>
									출고등록
								</button>
								<? if($_SESSION['login_level'] >= 99) { ?>
								<button class="btn btn-danger" id="selectBtn" type="button" onclick="deleteSelect()">
								<!-- <button type="button" class="btn btn-outline btn-primary pull-right" id="selectBtn">선택</button> -->
									<i class="ace-icon fa fa-undo"></i>
									선택삭제
								</button>
								<?}?>
							</div>
						</div>
						<div class="col-lg-12" id="ex3_Result1" ></div> 
						<div class="col-lg-12" id="ex3_Result2" ></div> 
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
<input type="hidden" name="check_state" id="check_state" />
<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">출고등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="Release_request_reg_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
                 <h4 class="modal-title">출고수정</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="Release_request_modify_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
                <p><iframe src="" id="Release_request_print_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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

<!-- /.modal -->
<div id="id-btn-dialog4" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">작업지시서내용보기</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="work_list_view_frame" frameborder="0" width="99%" height="300" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
	getReleaseRequest(page);

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

// 출고 리스트 가져오기
function getReleaseRequest(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();
	var txt = $("#search_txt").val();
	var end_dt = $("#end_dt").val();
	var start_dt = $("#start_dt").val();
	var trHTML = '';
	$.getJSON("ajax/item.php",{"page":page, "mode":"getReleaseRequest", "rpp" : rpp, "adjacents" : adjacents, "where": where, "search_txt": txt, "start_dt": start_dt, "end_dt": end_dt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					
					var in_cnt = Number(json[i].cnt) - Number(json[i].remain_cnt);
					
					tag += "<tr>";
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' name='CheckBox' id='CheckBox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					tag += "<td class='left'><a href='javascript:void(0);'  onclick='Release_request_modiy(" + json[i].uid + ");'>" + json[i].release_cd + "</a></td>";
					tag += "<td class='left'>" + json[i].warehouse_nm + json[i].cnt_text2 + "</a></td>";
					tag += "<td class='left'>" + json[i].wh_cd_t_nm + "</td>";
					tag += "<td>" + json[i].item_nm + json[i].cnt_text +"</td>";
					tag += "<td class='text-right'>" + json[i].cnt + "</td>";
					
					//tag += "<td class='center'><a href='javascript:void(0);'  onclick=\"work_list_view('" + json[i].work_cd + "')\">" + json[i].work_cd + "</a></td>";
					tag += "<td class='center'>" + json[i].work_cd + "</td>";

					if( json[i].state == "출고취소"){
						tag += "<td class='center' class='state' style='color:red'>" + json[i].state + "</td>";
					}else if(json[i].state == "출고완료"){
						tag += "<td class='center' class='state' style='color:green' >" + json[i].state + "</td>";
					}else{
						tag += "<td class='center' class='state' style='color:gray' ><b>" + json[i].state + "</B></td>";
					}
					
					if( json[i].state == "출고취소" || json[i].state == "대기중"){
						tag += "<td class='center'></td>";
					}else{
						tag += "<td class='center'><input type='button' class='btn btn-xs btn-success' value='인쇄' onclick='Release_requestPrint("+ json[i].uid +")'/></td>";
					}
					tag += "</tr>";
					//trHTML += '<tr><td>' + json[i].state + '</td></tr>';
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='13' class='center' style='height:20px'> 등록된 출고요청 리스트가 없습니다. </td>";
				tag += "</tr>";
			}

			$("#release_request_list tbody").html(tag);
			//$('#release_request_list tbody').append(trHTML);
			var table = "erp_release_request";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getReleaseRequest(page);
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

	/*
	// 상단 선택버튼 클릭시 체크된 Row의 값을 가져온다.
		$("#selectBtn").click(function(){ 
			var rowData = new Array();
			var tdArr = new Array();
			var checkbox = $("input[name=CheckBox]:checked");

			// 체크된 체크박스 값을 가져온다
			checkbox.each(function(i) {
	
				// checkbox.parent() : checkbox의 부모는 <td>이다.
				// checkbox.parent().parent() : <td>의 부모이므로 <tr>이다.
				var tr = checkbox.parent().parent().eq(i);
				var td = tr.children();
				
				// 체크된 row의 모든 값을 배열에 담는다.
				rowData.push(tr.text());
				//alert(tr.html())
				// td.eq(0)은 체크박스 이므로  td.eq(1)의 값부터 가져온다.
				var no = td.eq(1).text()+", "
				var userid = td.eq(2).text()+", ";
				var name = td.eq(3).text()+", ";
				var email = td.eq(4).text()+", ";
				
				// 가져온 값을 배열에 담는다.
				tdArr.push(no);
				tdArr.push(userid);
				tdArr.push(name);
				tdArr.push(email);
				
				console.log("no : " + no);
				console.log("userid : " + userid);
				console.log("name : " + name);
				console.log("email : " + email);
			});
			
			$("#ex3_Result1").html(" * 체크된 Row의 모든 데이터 = "+rowData);	
			$("#ex3_Result2").html(tdArr);	
		});
	*/	

// 선택 삭제
function deleteSelect(){
	findStr = "출고완료";
	$("#check_state").val(''); //초기화

	$(".chk").each(function(i){
		if($(this).prop('checked')) {
			var tr = $("#release_request_list > tbody").children("tr").eq(i);
			var td = tr.children();
			var state = td.eq(7).text();

			var new_uid = $("#check_uids").val() + "," + $(this).val();
			$("#check_uids").val(new_uid);
			var new_state = $("#check_state").val() + ","+ state;
			$("#check_state").val(new_state);
		}
	});

	if ($("#check_uids").val()=="")
	{
		alert('삭제할 출고요청서를 하나이상 선택하세요.');
		return false;
	}

	var text = $("#check_state").val();
	
	if (text.indexOf(findStr)!=-1)
	{
		alert('선택한 출고요청서중 출고완료 된 건이 있어 삭제 할 수 없습니다.');
		return false;
	}

	if(confirm("선택하신 출고 요청 내역을 삭제하시겠습니까?")) {


		var dataString = "mode=deleteSelectReleaseRequest&table=erp_release_request&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/item.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getReleaseRequest(1);
				}
			}
		});
	}
}

function Release_requestPrint(p_cd, ctype)
{
	var param	= "?uid="+p_cd;
	var url		= '';
		url		= "../../views/doc_form/Release_request_into_print.php" + param;
	var popwin	= window.open(url, 'Release_request_print', 'width=1000, height=900, scrollbars=yes, resizable=yes');
}

function Release_request_barcode_Print(p_cd, ctype)
{
	var param	= "?uid="+p_cd;
	var url		= '';
		url		= "../../views/doc_form/Release_request_barcode_print.php" + param;
	var popwin	= window.open(url, 'Release_request_print', 'width=1000, height=900, scrollbars=yes, resizable=yes, toolbar=no, menubar=no');
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
	function Release_request_reg(cidx, acd)
	{
	$("#id-btn-dialog1").modal({
		show: true,
		title : "출고등록",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=items&action=registPageReleaseRequestPop&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogID=id-btn-dialog1";
	$("#Release_request_reg_frame").attr("src", url);
	}
			
	function Release_request_modiy(uid)
	{
	$("#id-btn-dialog2").modal({
		show: true,
		title : "출고수정",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	
	var url = "index.php?controller=items&action=modifyPageReleaseRequestPop&pop=Y&uid="+uid+"&dialogID=id-btn-dialog2";
	$("#Release_request_modify_frame").attr("src", url);
	}
	
	function Release_request_print(uid)
	{
	$("#id-btn-dialog3").modal({
		show: true,
		title : "출고등록",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	
	var url = "index.php?controller=items&action=releaseRequestPrint&pop=Y&uid="+uid+"&dialogID=id-btn-dialog3";
	$("#Release_request_print_frame").attr("src", url);
	}

	function work_list_view(wc)
	{
	$("#id-btn-dialog4").modal({
		show: true,
		title : "출고등록",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	var url = "index.php?controller=production&action=listPagegWorkOrder&pop=Y&work_cd="+wc+"&dialogID=id-btn-dialog4";
	$("#work_list_view_frame").attr("src", url);
	}
	
	function close_popup()
	{	
		$.modal.close();
		$("#Release_request_reg_frame").attr("src", "about:blank");
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
    //window.open("index.php?controller=items&action=productPerfReportsPrint&pop=Y&uid="+uid+"&dialogID=id-btn-dialog3", "실적처리", "width=600, height=900, toolbar=no, menubar=no, scrollbars=no, resizable=yes" ); 
	window.open("views/items/printProductPerfReports.php?uid="+uid, "실적처리", "width=800, height=900, toolbar=no, menubar=no, scrollbars=yes, resizable=no" ); 
}  
//-->  
</script>  
  
<script language="javascript" type="text/javascript">  
<!--  
function openWinPrint(uid){  
    window.open("/views/accounting/doc_form/print/Release_request_item_print.php?uid="+uid, "전표인쇄", "width=800, height=700, toolbar=no, menubar=no, scrollbars=yes, resizable=yes" );  
}  
//-->  
</script> 