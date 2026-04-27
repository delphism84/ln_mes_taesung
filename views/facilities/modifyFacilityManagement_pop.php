<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);

?>

<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="facilities" />
						<input type="hidden" name="action" id="action" value="updatePageFacilityManagement" />
						<input type="hidden" name="uid" id="uid" value="<?=$uid?>" />
						<input type="hidden" name="dialogId" id="dialogId" value="<?=$dialogId?>" />
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">가동일자</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="facilities_dt" id="facilities_dt" type="text" value="<?=$t->facilities_dt?>" data-date-format="yyyy-mm-dd" readonly/>
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>&nbsp;
												<select name="day_gubun" id="day_gubun" onchange="dayGubun()">
												<option value="주간" <? if($t->state == "주간") echo "selected"; ?>>주간</option>
												<option value="야간" <? if($t->state == "야간") echo "selected"; ?>>야간</option>
												</select>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">설비명</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="machine_cd" id="machine_cd" value="<?=$t->machine_cd?>"/>
												<input type="text" name="machine_nm" id="machine_nm" placeholder="생산 설비명" value="<?=$t->machine_nm?>" onclick="centerOpenWindow('views/popup/facilitiesListPut.php', '생산기기리스트', 600, 600)" readonly/>
												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/facilitiesListPut.php', '생산기기리스트', 600, 600)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												
											</div>
										</span>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="process_cd" id="process_cd" value="<?=$t->process_cd?>"/>
												<input type="text" name="process_nm" id="process_nm" placeholder="작업 공정명" value="<?=$t->process_nm?>" onclick="centerOpenWindow('views/popup/processListPut.php', '공정리스트', 400, 600)" readonly/>
												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/processListPut.php', '공정리스트', 400, 600)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												
											</div>
										</span>
									</div>
								</td>
								</tr>
								<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">근무시간</th>
								<td class="col-xs-5">
									<input type="text" name="office_hours" id="office_hours" value="<?=$t->office_hours?>" class="text-right" value='700' onclick='this.select();' style="ime-mode:disabled"/>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">모델명</th>
								<td class="col-xs-5">
									<input type="text" name="model_no" id="model_no" value="<?=$t->model_no?>" onclick='this.select();' style="ime-mode:disabled"/>
								</td>
							</tr>
								<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업시간</th>
								<td class="col-xs-5">
									<div class="input-group">
										<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" id="timePicker4" style="width:110px;float:left">
											<input type="text" name="f_work_tm1" id="f_work_tm1" class="form-control" value="<?=$t->f_work_tm1?>" onclick="officeHours()">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time" onclick="officeHours()"></span>
											</span>
										</div>
										<div style="width:20px;float:left;center;padding-left:8px"><strong>-</strong> 
										</div>
										<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" id="timePicker5" style="width:110px;float:left">
											<input type="text" name="f_work_tm2" id="f_work_tm2" class="form-control" value="<?=$t->f_work_tm2?>" onblur="operationRate()">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time"  onblur="operationRate()"></span>
											</span>
										</div>
										<input type="hidden" name="f_work_tm" id="f_work_tm" value="<?=$t->f_work_tm?>">
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">비가동시간</th>
								<td class="col-xs-5">
									<div class="input-group">
										<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" id="timePicker6" style="width:110px;float:left">
											<input type="text" name="f_off_tm1" id="f_off_tm1" class="form-control" value="<?=$t->f_off_tm1?>">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time"></span>
											</span>
										</div>
										<div style="width:20px;float:left;center;padding-left:8px"><strong>-</strong> 
										</div>
										<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" id="timePicker7" style="width:110px;float:left">
											<input type="text" name="f_off_tm2" id="f_off_tm2" class="form-control" value="<?=$t->f_off_tm2?>" onblur="fOffTm();">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time" onblur="fOffTm();"></span>
											</span>
										</div>
										<input type="hidden" name="f_off_tm" id="f_off_tm" >
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">가동률</th>
								<td class="col-xs-5">
									<input type="text" name="operation_rate" id="operation_rate" class="text-right" value="<?=$t->operation_rate?>" onclick='this.select();' onKeyPress="onlyNumber();" onKeyUp="input_comma(this);" style="ime-mode:disabled"/>%
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">이상발생분류</th>
									<td class="col-xs-5">
										<input type="radio" name="problem_gb" id="problem_gb" value="<?=$t->problem_gb?>" class="text-left" checked/> 돌발방생&nbsp;&nbsp;&nbsp;<input type="radio" name="problem_gb" id="problem_gb" value="1" class="text-left"/> 일상및 정기점검
								</td>
								
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">작업자</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="emp_id" id="emp_id" value="<?=$t->emp_id?>"/>
												<input type="text" name="emp_nm" id="emp_nm" value="<?=$t->emp_nm?>" onclick="centerOpenWindow('views/popup/employeeList.php', '사원리스트', 600, 500)" readonly />
												<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/employeeList.php', '사원리스트', 600, 500)" >
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1"> 비가동유형</th>
								<td class="col-xs-5">
									<select name="f_off_type" id="f_off_type" onchange="ChangeLossItem();" >
									<option value="1" <? if($t->f_off_type == "계획생산정지") echo "selected"; ?>>계획생산정지</option>
									<option value="2" <? if($t->f_off_type == "휴식") echo "selected"; ?>>휴식</option>
									<option value="3" <? if($t->f_off_type == "식사") echo "selected"; ?>>식사</option>
									<option value="4" <? if($t->f_off_type == "TPM교육") echo "selected"; ?>>TPM교육</option>
									<option value="5" <? if($t->f_off_type == "영업계획차질") echo "selected"; ?>>영업계획차질</option>
									<option value="6" <? if($t->f_off_type == "자연재해") echo "selected"; ?>>자연재해</option>
									<option value="7" <? if($t->f_off_type == "설비보수") echo "selected"; ?>>설비보수</option>
									<option value="8" <? if($t->f_off_type == "Valve End 청소") echo "selected";?>>Valve End 청소</option>
									<option value="9" <? if($t->f_off_type == "샘플진행") echo "selected"; ?>>샘플진행</option>
									<option value="10" <? if($t->f_off_type == "모델변경") echo "selected"; ?>>모델변경</option>
									<option value="11" <? if($t->f_off_type == "기계조절시간") echo "selected"; ?>>기계조절시간</option>
									<option value="12" <? if($t->f_off_type == "고장수리") echo "selected"; ?>>고장수리</option>
									<option value="13" <? if($t->f_off_type == "탕도청소") echo "selected"; ?>>탕도청소</option>
									<option value="14" <? if($t->f_off_type == "기타") echo "selected"; ?>>기타</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">이상내용</th>
								<td class="col-xs-5">
									<textarea name="p_content" id="p_content" class="form-control" /><?=$t->p_content?></textarea>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">조치내역</th>
								<td class="col-xs-5">
									<textarea name="a_content" id="a_content" class="form-control" /><?=$t->a_content?></textarea>
								</td>
							</tr>
							
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">접수일</th>
								<td class="col-xs-5">
									<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="receipt_dt" id="receipt_dt" value="<?=$t->receipt_dt?>"/>
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
										</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">처리일</th>
								<td class="col-xs-5">
									<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="handle_dt" id="handle_dt" value="<?=$t->handle_dt?>"/>
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
										</div>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div><!-- /.row -->
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						등록
					</button>
					<button class="btn" type="reset" onclick="window.parent.closeModal('<?=$dialogID?>');">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						닫기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->
<input type="hidden" name="flag" id="flag" value="1" />
<input type="hidden" name="itemFlag" id="itemFlag" value="" />
<input type="hidden" name="lotnocdFlag" id="lotnocdFlag" value="1" />
<input type="hidden" name="inspectionFlag" id="inspectionFlag" value="1" />
<div id="id-btn-dialog2" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:80%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">LOT_NO 검색</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="lot_no_search_frame" frameborder="0" width="99%" height="370" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
	function closePopup()
	{
		window.parent.closeModal('<?=$dialogId?>');
		//window.parent.location.reload();
	}
	window.closeModal = function(obj) {
		$("#"+obj).modal('hide');
	}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	//createWorkCode();
	

});


function officeHours(){

	if ($("#office_hours").val()=="0")
	{
		alert('근무시간을 입력하세요.')
		$("#office_hours").focus();
		return false;
	}
}

function operationRate(){

	var nowdate = $("#facilities_dt").val();

	if ($("#office_hours").val()=="0")
	{
		alert('근무시간을 입력하세요.')
		$("#office_hours").focus();
		return false;
	}

	var time1 = $("#f_work_tm1").val();
	var time2 = $("#f_work_tm2").val();

	var arr1 = nowdate.split('-');
	var arr2 = time1.split(':');
	var arr3 = time2.split(':');

	var date1 = new Date(arr1[0],arr1[1],arr1[2],arr2[0],arr2[1],00);
	var date2 = new Date(arr1[0],arr1[1],arr1[2],arr3[0],arr3[1],00);

	var seconds = parseInt(date2.getTime() - date1.getTime());

	var diff = parseInt((seconds/1000/60));

	$("#f_work_tm").val(diff)
	var pq = (Number(removeComma(diff))/Number(removeComma($("#office_hours").val())))*100; 
	$("#operation_rate").val(Math.ceil(pq))
}

function fOffTm(){

	var nowdate = $("#facilities_dt").val();

	var time1 = $("#f_off_tm1").val();
	var time2 = $("#f_off_tm2").val();

	var arr1 = nowdate.split('-');
	var arr2 = time1.split(':');
	var arr3 = time2.split(':');

	var date1 = new Date(arr1[0],arr1[1],arr1[2],arr2[0],arr2[1],00);
	var date2 = new Date(arr1[0],arr1[1],arr1[2],arr3[0],arr3[1],00);

	var seconds = parseInt(date2.getTime() - date1.getTime());

	var diff = parseInt((seconds/1000/60));

	$("#f_off_tm").val(diff)

}

function dayGubun(){
	var tax_type = $("#day_gubun option:selected").val();
	if(tax_type=="야간")
	{
		$("#office_hours").val('740')
	}else{
		$("#office_hours").val('700')
	}
}



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

function close_popup()
{	
	$.modal.close();
	$("#standard_code_reg_frame").attr("src", "about:blank");
}
function closePopup()
{
	window.parent.closeModal('<?=$dialogId?>');
	window.parent.location.reload();
}
window.closeModal = function(obj) {
	alert(obj)
	$("#"+obj).modal( 'hide' );
}

function formSubmit(){
	var machine_nm = $("#machine_nm").val();
	var operation_rate = $("#operation_rate").val(); 
	if (machine_nm==""){
		alert('설비명을 입력하세요.');
		$("#machine_nm").focus();
		return false;
	}
	if (operation_rate==""){
		alert('가동률을 입력하세요.');
		$("#operation_rate").focus();
		return false;
	}

	$("#frm").submit();
}
</script>

<script type="text/javascript">
//$('.clockpicker').clockpicker();

 $(document).ready(function () {

            $('#timePicker').clockpicker({
                placement: 'bottom',    // 시계 바인딩 방향 top,bottom,right,left
                //align: 'right',       // 시계 위치 right,left 
                align: 'left',
                autoclose: false,      // 자동 닫기
                default: '09:00',
                donetext: ''
            });

        });


</script>
<script type="text/javascript">
<!--
function input_comma(sfield) 
	{
		if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) 
			|| (event.keyCode == 188) || (event.keyCode == 190) || (event.keyCode == 110) || (event.keyCode == 8) || (event.keyCode == 46))
		{			
			sfield.value = remove_comma(sfield);
			money = sfield.value;
			var tmpH="";
			if(money.charAt(0)=="-")
			{
				tmpH=money.substring(0,1);
				money=money.substring(1,money.length);
			}
		
			for (; money.indexOf("-") != -1 ;) 
			{ 
				money = money.replace("-","")
			}
		
			belowzero = "";
			if (check_dot(money)==true)
			{
				arr = money.split(".");
				money = arr[0];		
				belowzero = "." + arr[1];    
			}
			
			len = money.length ;
			result ="";
			for (i=0; i < len;i++)
			{
				comma="";
				schar = money.charAt(i);
				where = len - 1 - i;
				if ( ( where % 3 == 0) && (len > 3) && ( where != 0 )) 
				{
					comma = ",";	
				}
				result = result +   schar + comma ;
			}
			if(tmpH)
			{
 				result = tmpH + result;
	 		}

			sfield.value = result + belowzero;			
			
	   	}	
		return true;
	}

	function remove_comma(sfield)
	{
		money = sfield.value;
		var arr;
		arr = money.split(",");
		len = arr.length;	
		result = "";
		for (k=0; k < len; k++) 
		{
			result = result + arr[k];
		}
		return result;
	}	

	function check_dot(v_value)
	{
		v_len= v_value.length;
		for (var i=0; i< v_len; i++) 
		{
			schar = v_value.charAt(i);
			if (schar == "." )
			{
				return true;
			}
		}
		return false;
	}
		
	function onlyNumber() //onKeyPress 이벤트 기준
	{ 
  		if ( ((event.keyCode < 48) || (57 < event.keyCode) && (188 != event.keyCode)) && (45 != event.keyCode) 
  			&& (190 != event.keyCode) && (110 != event.keyCode) && (109 != event.keyCode) && (46 != event.keyCode)) 
  		{
  			event.returnValue=false;
  		}
	}

	function removeComma(n) {  // 콤마제거
	if ( typeof n == "undefined" || n == null || n == "" ) {
		return "";
	}
	var txtNumber = '' + n;
	return txtNumber.replace(/(,)/g, "");
	}

//-->
</script>
<!----------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-phone').mask('(999) 999-9999');
	$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
	$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});

	//override dialog's title function to allow for HTML titles
	$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
		_title: function(title) {
			var $title = this.options.title || '&nbsp;'
			if( ("title_html" in this.options) && this.options.title_html == true )
				title.html($title);
			else title.text($title);
		}
	}));
	
	// 견적서 팝업
	$( "#id-btn-dialog1" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 1000,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>생산계획</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});
	
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
		
	$('#timepicker3').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		format: 'hh:ii',
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#timepicker3').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});		

	$('#timepicker1').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		format: 'hh:ii',
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#timepicker1').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});

	$('#timepicker2').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		format: 'hh:ii',
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#timepicker2').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});

	$('#timePicker4').clockpicker({
                placement: 'bottom',    // 시계 바인딩 방향 top,bottom,right,left
                //align: 'right',       // 시계 위치 right,left 
                align: 'left',
                autoclose: true,      // 자동 닫기
                //default: '09:00',
                //donetext: ''
    });

	$('#timePicker5').clockpicker({
                placement: 'bottom',    // 시계 바인딩 방향 top,bottom,right,left
                //align: 'right',       // 시계 위치 right,left 
                align: 'left',
                autoclose: true,      // 자동 닫기
                //default: '00:00',
                //donetext: ''
    });

	$('#timePicker6').clockpicker({
                placement: 'bottom',    // 시계 바인딩 방향 top,bottom,right,left
                //align: 'right',       // 시계 위치 right,left 
                align: 'left',
                autoclose: true,      // 자동 닫기
                //default: '00:00',
                //donetext: ''
    });

	$('#timePicker7').clockpicker({
                placement: 'bottom',    // 시계 바인딩 방향 top,bottom,right,left
                //align: 'right',       // 시계 위치 right,left 
                align: 'left',
                autoclose: true,      // 자동 닫기
                //default: '00:00',
                //donetext: ''
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