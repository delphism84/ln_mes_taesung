<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);

$end_day = date("t", mktime(0, 0, 0, 12, 1, 2007));
?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">인사/급여</a>
				</li>
				<li class="active">급여관리</li>
			</ul><!-- /.breadcrumb -->

			<div class="nav-search" id="nav-search">
				<form class="form-search">
					<span class="input-icon">
						<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
						<i class="ace-icon fa fa-search nav-search-icon"></i>
					</span>
				</form>
			</div><!-- /.nav-search -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					급여정보입력
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						급여정보입력.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="salary" />
						<input type="hidden" name="action" id="action" value="registPayCheckUpdate" />
						<input type="hidden" name="dialogid" id="dialogid" value="<?=$dialogid?>" />
						<input type="hidden" name="uid" id="uid" value="<?=$uid?>" />
						<input type="hidden" name="pay_check_dt" id="pay_check_dt" value="<?=$t->pay_check_dt?>" />
						
						
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
								<thead>
								<thead>
								<tbody>
								<tr>
									<th id="th1" class="left col-xs-2" style="background-color:#f1f1f1;">귀속연월-차수</th>
									<td>
										<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<span id="lblPDate2"><?=$t->pay_check_dt?>-<?=$t->pay_check_ca?></span>
												<span id="lblModifyFlag">(<input name="cbmodifyflag" type="checkbox" id="cbmodifyflag" value="N" <?echo ($t->cbmodifyflag=="Y")? "checked" : "" ?>/>확정)</span>
												</div>
												</span>
										</div>
									</td>
									
								</tr>
								<tr>
								  <th id="th2" style="background-color:#f1f1f1;">급여구분 </th>
								  <td>
									<span id="lblPayGubun"></span>
									<select name="pay_gubun" id="pay_gubun" onchange="ChangePayGubun();" style="width:100px;">
									<option value="11" <?echo ($t->pay_gubun=="11")? "selected" : "" ?>>급여</option>
									<option value="31" <?echo ($t->pay_gubun=="31")? "selected" : "" ?>>급(상)여</option>
									<option value="21" <?echo ($t->pay_gubun=="21")? "selected" : "" ?>>상여</option>
									</select>
								  </td>
								</tr>
								<tr>
									<th id="th3" style="background-color:#f1f1f1;">세금계산</th>
									<td>
										<select name="taxcalc" id="taxcalc" onchange="ChangeTaxCalc();">
										<option value="0" <?echo ($t->taxcalc=="0")? "selected" : "" ?>>귀속연월이 동일한 것 합산하여 소득세등 계산</option>
										<option value="1" <?echo ($t->taxcalc=="1")? "selected" : "" ?>>이번 지급사항만 가지고 소득세등 계산</option>
										</select>
									</td>
								</tr>
								<tr>
								<th id="th4" style="background-color:#f1f1f1;">대상기간</th>
								<td>
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="scdate" id="scdate" type="text" value="<?=$t->scdate?>" data-date-format="yyyy/mm/dd" style="width:100px"/>
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
										~
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="ecdate" id="ecdate" type="text" value="<?=$t->ecdate?>" data-date-format="yyyy/mm/dd" style="width:100px"/>
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								  </td>
								</tr>
								<tr>
								  <th id="th5" style="background-color:#f1f1f1;">지급일</th>
								  <td>
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="paydate" id="paydate" type="text" value="<?=$t->paydate?>" data-date-format="yyyy/mm/dd" style="width:100px"/>
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								  </td>
								
								</tr>
								<tr>
								  <th id="th6" style="background-color:#f1f1f1;">지급연월</th>
								  <td>
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="lastday" id="lastday" type="text" value="<?=$t->lastday?>" data-date-format="yyyy/mm" style="width:100px"/>
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								  </td>
								</tr>
								<tr id="trBonus1" style="display: none;" >
									<th rowspan="4" style="vertical-align:middle" style="background-color:#f1f1f1;">상여</th>
									<th style="vertical-align:middle">변동급여자 기본시간</th>
									<td>
										<input name="bonusday" type="text" maxlength="3" id="bonusday" class="defaultright" style="width:40px;" />시간
										<div>변동급여자의 상여 계산 시 기준이 되는 시간을 입력합니다.<br />주 40시간 기준: 일반적으로 209시간을 입력합니다.<br />30일 기준: 일반적으로 240시간을 입력합니다.</div>
									</td>
								</tr>
								<tr id="trBonus2" style="display: none;">
									<th style="vertical-align:middle" style="background-color:#f1f1f1;">정산기간</th>
									<td>
										<div>
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" name="sbonusdate" id="sbonusdate" type="text" value="<?=$t->sbonusdate?>" data-date-format="yyyy/mm" style="width:100px"/>
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
											~
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" name="ebonusdate" id="ebonusdate" type="text" value="<?=$t->ebonusdate?>" data-date-format="yyyy/mm" style="width:100px"/>
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
										</div>
										
									</td>
								</tr>        
								<tr id="trBonus3" style="display: none;">
									<th style="vertical-align:middle" style="background-color:#f1f1f1;">지급률(액)</th>
									<td>
										<span id="payrateflag" name="payrateflag" onclick="ChangePayRateFlag();"><input id="payrateflag_0" type="radio" name="payrateflag" value="0" <?echo ($t->payrateflag=="0" || $t->payrateflag=="")? "checked" : "" ?> /><label for="payrateflag_0">지급률(%)&nbsp;&nbsp;</label><input id="payrateflag_1" type="radio" name="payrateflag" value="1" <?echo ($t->payrateflag=="1")? "checked" : "" ?> /><label for="payrateflag_1">지급액</label></span>
										<span id="divPayRate1">
										<input name="payrate" type="text" id="payrate" class="defaultright" style="width:50px;" <?=$t->payrate?>/>%
										</span>
										<span id="divPayRate2" style="display: none;">
										<input name="txtBonusAmt" type="text" id="txtBonusAmt" class="defaultright" style="width:50px;" <?=$t->bonusamt?> />
										</span>
										(<input id="cbbonusflag" type="checkbox" name="cbbonusflag" value="1" <?echo ($t->cbbonusflag=="1")? "checked" : "" ?>/> 상여합산)
									</td>
								</tr>        
								<tr id="trBonus4" style="display: none;">
									<th style="vertical-align:middle" style="background-color:#f1f1f1;">상여구분</th>   
									<td>
										<span id="bonusapplyflag"><input id="bonusapplyflag_0" type="radio" name="bonusapplyflag" value="0" <?echo ($t->bonusapplyflag=="0" || $t->bonusapplyflag=="")? "checked" : "" ?>/><label for="bonusapplyflag_0">급여대장기준&nbsp;&nbsp;</label><input id="bonusapplyflag_1" type="radio" name="bonusapplyflag" value="1" <?echo ($t->bonusapplyflag=="1")? "checked" : "" ?>/><label for="bonusapplyflag_1">사원등록기준</label></span><br />
									</td>
								</tr>        
								<tr>
								  <th id="th7" style="background-color:#f1f1f1;">연말정산 <a href="#"></th>
								  <td>
								  	<select name="adjustyy" id="adjustyy" onclick="fnChangePayDate();" onchange="fnChangePayDate();">
									<option selected="selected" value="">====</option>
									<option value="2022" <?echo ($t->adjustyy=="2022")? "selected" : "" ?>>2022</option>
									<option value="2021" <?echo ($t->adjustyy=="2021")? "selected" : "" ?>>2021</option>
									<option value="2020" <?echo ($t->adjustyy=="2020")? "selected" : "" ?>>2020</option>
									<option value="2019" <?echo ($t->adjustyy=="2019")? "selected" : "" ?>>2019</option>
									<option value="2018" <?echo ($t->adjustyy=="2018")? "selected" : "" ?>>2018</option>
									<option value="2017" <?echo ($t->adjustyy=="2017")? "selected" : "" ?>>2017</option>
									<option value="2016" <?echo ($t->adjustyy=="2016")? "selected" : "" ?>>2016</option>
									<option value="2015" <?echo ($t->adjustyy=="2015")? "selected" : "" ?>>2016</option>
									<option value="2014" <?echo ($t->adjustyy=="2014")? "selected" : "" ?>>2016</option>
								  </td>	
								</tr>
								<tr>
									<th id="th9" style="background-color:#f1f1f1;">급여대장명칭</th><!-- 급여대장명칭-->
									<td><input name="paydes" type="text" maxlength="30" id="paydes" class="default" style="width:200px;" value="<?=$t->paydes?>"/></td>
								</tr>
								<tr>
								  <th id="th8" style="background-color:#f1f1f1;">급여명세서하단</th>
								  <td><input name="paycomment" type="text" value="※수고하셨습니다" maxlength="100" id="paycomment" class="default" style="width:200px;" value="<?=$t->paycomment?>"/></td>
								</tr>
							</table>    
					</form>
				</div>
			</div><!-- /.row -->

			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="fnSave();">
						<i class="ace-icon fa fa-minus-square bigger-110"></i>
						저장
					</button>

					<button class="btn " type="button" onclick="gfnClose()">
						<i class="ace-icon fa fa-minus-square bigger-110"></i>
						닫기
					</button>

					<button class="btn" type="reset" onclick="gfnDelete()">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						삭제
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->
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
	
	//datepicker plugin
	//link
	$('.date-picker').datepicker({
		//calendarWeeks: false,
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
});
</script>
<!----------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
    <!--
        // 사용방법설정 팝업창 높이

        
        function ChangePayGubun()
        {
            var strPayGubun = $("#pay_gubun option:selected").val();
            
            if (strPayGubun != 11)
            {
                if('I'=='I')
                    $("#bonusday").val("209");
                $("#bonusday").attr("disabled", "");
                
                if (strPayGubun == 31)
                    $("#cbbonusflag").attr("disabled", "disabled");
                else
                    $("#cbbonusflag").attr("disabled", "");
                    
                $("#col1").css("width", "3%");
                $("#col2").css("width", "9%");
                $("#col3").css("width", "35%");
                
                for(var i = 1; i <= 9; i++)
                {
                    $("#th" + i).attr("colSpan", 2);
                }                
            }
            else
            {
                $("#cbbonusflag").attr("disabled", "disabled");
                $("#bonusday").attr("disabled", "disabled");
                $("#col1").css("width", "12%");
                $("#col2").css("width", "35%");
                $("#col3").css("width", "");
                
                for(var i = 1; i <= 9; i++)
                {
                    $("#th" + i).attr("colspan", "");
                }
            }            
            
            for(var i = 1; i <=4 ; i++)
            {
                if (strPayGubun > 11)
                    $("#trBonus" + i).show();
                else
                    $("#trBonus" + i).hide();
            }
            
            SelectDay(1);
        }
        
        function SelectDay(strGubun)
        {
            if (strGubun == 1)
            {
                var strTaxCalc = $("#taxcalc option:selected").val();
                var strPayGubun = $("#pay_gubun option:selected").val();
                
                if (strTaxCalc == "1" && strPayGubun != "11")
                {
                    // 정산기간
                    $("#ddlYymmFYear option[value=" + $("#ddlPYear option:selected").val() + "]").attr("selected", "true");
                    $("#ddlYymmFMonth option[value=" + $("#ddlPMonth option:selected").val() + "]").attr("selected", "true");
                    $("#ddlYymmTYear option[value=" + $("#ddlPYear option:selected").val() + "]").attr("selected", "true");
                    $("#ddlYymmTMonth option[value=" + $("#ddlPMonth option:selected").val() + "]").attr("selected", "true");
                    
                    $("#ddlYymmFYear").attr("disabled", "disabled");
                    $("#ddlYymmFMonth").attr("disabled", "disabled");
                    $("#ddlYymmTYear").attr("disabled", "disabled");
                    $("#ddlYymmTMonth").attr("disabled", "disabled");
                }
                else
                {
                    $("#ddlYymmFYear").attr("disabled", "");
                    $("#ddlYymmFMonth").attr("disabled", "");
                    $("#ddlYymmTYear").attr("disabled", "");
                    $("#ddlYymmTMonth").attr("disabled", "");                
                }
            }
            else
            {
                if($("#ddlRYear option:selected").val() != $("#ddlPayDateYear option:selected").val())
                {
                    $("#ddlRYear option[value=" + $("#ddlPayDateYear option:selected").val() + "]").attr("selected", "true");
                }
                
                if($("#ddlRMonth option:selected").val() != $("#ddlPayDateMonth option:selected").val())
                {
                    $("#ddlRMonth option[value=" + $("#ddlPayDateMonth option:selected").val() + "]").attr("selected", "true");
                }
            }
        }
        
        function ChangePayRateFlag()
        {
            if ($("#payrateflag :checked").val() == "0")
            {
                $("#divPayRate1").show();
                $("#divPayRate2").hide();
            }
            else
            {
                $("#divPayRate1").hide();
                $("#divPayRate2").show();
            }
        }
        
        function ChangeTaxCalc()
        {
            var strTaxCalc = $("#taxcalc option:selected").val();
            
            if (strTaxCalc == "1")
            {
                $("#ddlYymmFYear").attr("disabled", "disabled");
                $("#ddlYymmFMonth").attr("disabled", "disabled");
                $("#ddlYymmTYear").attr("disabled", "disabled");
                $("#ddlYymmTMonth").attr("disabled", "disabled");
            }
            else
            {
                $("#ddlYymmFYear").attr("disabled", "");
                $("#ddlYymmFMonth").attr("disabled", "");
                $("#ddlYymmTYear").attr("disabled", "");
                $("#ddlYymmTMonth").attr("disabled", "");                
            }        
        }

        //F8 단축키 이벤트
        function Click_F8() {
           /*if ("W" == "R") {
                alert("읽기 권한자는 사용할 수 없는 기능입니다.");
                return false;
            }
            else if ("W" == "U" && "I" == "M") {
                alert("수정 권한이 없습니다.");
                return false; 

            } */
            
            if ("W" != "W"){
                alert("권한이 없습니다.");
                return false;
            }
            fnSave('');
        }
        
        // 저장
        function fnSave(strSaveType) {
           /* if ("W" == "R") {
                alert("읽기 권한자는 사용할 수 없는 기능입니다.");
                return false;
            }
            else if ("W" == "U" && "I" == "M") {
                alert("수정 권한이 없습니다.");
                return false;
            }
          */
            
                if ("W" != "W" && "W" != "U"){
                    alert("권한이 없습니다.");
                    return false;
                }
            
            var strPayGubun = $("#pay_gubun option:selected").val();
            
            
            
            if (strPayGubun != "11")
            {
                var strBonusRate = "";
                var strBonusAmt = "";
                
                if ($("#payrate").val() == "")
                    strBonusRate = 0;
                else
                    strBonusRate = numOffMask($("#payrate").val());
                    
                if ($("#txtBonusAmt").val() == "")
                    strBonusAmt = 0;
                else
                    strBonusAmt = numOffMask($("#txtBonusAmt").val());
                    
                if (strBonusRate == 0 && strBonusAmt == 0)
                {
                    alert("상여 지급률이나 지급액이 입력되지 않았습니다.");

                    if ($("#payrateflag_0").is(":checked"))
                        $("#payrate").focus();
                    else
                        $("#txtBonusAmt").focus();
                        
                    return false;
                }
            }
            
            
            
            // 대상기간FROM
            //var strWSYear = $("#ddlWSYear option:selected").val();
            //var strWSMonth = $("#ddlWSMonth option:selected").val();
            var strScdate = $("#scdate").val();
            
            // 대상기간TO
            //var strWEYear = $("#ddlWEYear option:selected").val();
            //var strWEMonth = $("#ddlWEMonth option:selected").val();
            var strEcdate = $("#ecdate").val();            
            
            // 지급일자
            //var strPayDateYear = $("#ddlPayDateYear option:selected").val();
            //var strPayDateMonth = $("#ddlPayDateMonth option:selected").val();
            var strPaydate = $("#paydate").val();
            
            if (strPaydate == "")
            {
                alert("지급일자를 입력하세요.");
                $("#paydate").focus();
                return false;
            }
            else
            {
                if (strScdate == "")
                {
                    alert("대상기간의 시작일자를 다시 입력 바랍니다.");
                    $("#scdate").focus();
                    return false;
                }
                
                if (strEcdate == "")
                {
                    alert("대상기간의 종료일자를 다시 입력 바랍니다.");
                    $("#ecdate").focus();
                    return false;
                }                
                
                if (strScdate > strEcdate)
                {
                    alert("대상기간의 시작일자가 종료일자 보다 큽니다.\n\n대상기간을 확인 바랍니다.");
                    $("#scdate").focus();
                    return false;
                }
                
                if (strPaydate == "")
                {
                    alert("지급일을 다시 입력 바랍니다.");
                    $("#paydate").focus();
                    return false;
                }    

                if (strScdate > strPaydate)
                {
                    alert("지급일은 대상기간의 시작일보다 작을 수 없습니다.\n\n대상기간과 지급일을 확인 바랍니다.");
                    $("#scdate").focus();
                    return false;
                }
            }
            
            // 지급연월
            //var strRYear = $("#ddlRYear option:selected").val();
            //var strRMonth = $("#ddlRMonth option:selected").val();
            var strLastday = $("#lastday").val();
            if (strLastday == "")
            {
                alert("지급연월을 선택 바랍니다.");
                    $("#lastday").focus();
                return false;
            }
            else
            {	/*
                if (strPayDateMonth == "01") {
                    strPayDateMonth = "12";
                    strPayDateYear = strPayDateYear - 1;
                }else {
                    strPayDateMonth = Number(strPayDateMonth) - 1;
                }
                
                if (strPayDateMonth < 10) {
                    strPayDateMonth = "0"+strPayDateMonth
                }
                */
				
                if (strLastday<  strPaydate.substr(0,7))
                {
                    alert("지급연월은 지급일보다 크거나 같아야 합니다.");
                    $("#lastday").focus();
                    return false;
                }
            }
            
            // 정산기간
            //$("#ddlYymmTYear option[value=" + $("#ddlYymmFYear option:selected").val() + "]").attr("selected", "true"); // 정산시작기간 년도를 종료년도랑 똑같이 해줌.
            //var strYymmFYear = $("#ddlYymmFYear option:selected").val();
            //var strYymmFMonth = $("#ddlYymmFMonth option:selected").val();
            //var strYymmTMonth = $("#ddlYymmTMonth option:selected").val();
			//var strPSYear = $("#ddlPYear option:selected").val();
            //var strPSMonth = $("#ddlPMonth option:selected").val();

			strpayCheckDt = $("#pay_check_dt").val();

			strSbonusdate = $("#sbonusdate").val();
			strEbonusdate = $("#ebonusdate").val();
			
            
            if (strPayGubun != "11" && strSbonusdate > strEbonusdate)
            {
                alert("정산기간의 시작월이 종료월보다 큽니다.\n\n정산기간을 확인 바랍니다.");
                $("#sbonusdate").focus();
                return false;
            }
            
            if (strPayGubun != "11") // 상여대장일 경우
            {
                if ($("#payrateflag :checked").val() == "0") // 지급율이면 지급액을 0으로 변경
                    $("#bonusamt").val("0");
                else // 지급액이라면 지급율을 0으로.
                    $("#payrate").val("0");
            }
            
            // 귀속연월
            if (strPayGubun != "11")
            {
                if (strSbonusdate != strpayCheckDt)
                {
                    alert("상여의 정산연도는 귀속연도와 같아야 합니다.");
                    $("#ddlYymmFYear").focus();
                    return false;
                }
                /*
                if (strYymmTMonth > strPSMonth)
                {
                    alert("상여의 정산 종료월은 귀속월보다 작거나 같아야 합니다.");
                    $("#ddlYymmTMonth").focus();
                    return false;
                } 
				*/
            }
            /*
            if (strSaveType == "calc" && "2016" > strPSYear) // 계산처리 시
            {
                alert("2016년 이전은 계산처리를 할 수 없습니다.");
                return false;
            }
            //정산기간
            $("#ddlYymmFYear").attr("disabled", "");
            $("#ddlYymmFMonth").attr("disabled", "");
            $("#ddlYymmTYear").attr("disabled", "");
            $("#ddlYymmTMonth").attr("disabled", "");
            
            $("#hidSaveType").val(strSaveType);
           */
            fnSubmit();
        }
        function numOffMask(me) {
			var tmp = me.split(",");
			tmp = tmp.join("");
			return tmp;
		}

        // 삭제
        function fnDelete() {
            if (confirm("삭제하겠습니까?"))
            {
                $("#hidEditFlag").val("D");
                fnSubmit();                
                return;
            }

            return false;
        }        
        
        function fnSubmit() {
            $("#frm")
            .attr("method", "post")
            //.attr("target", "EPG013M")
            //.attr("action", fnSetUrlPath("EPG013M_SAVE.aspx", "ec_req_sid"))
            .submit(); 
        }

        //F2 단축키 이벤트
        function Click_F2() {
            fnNew();
        }

        //부모창 Submit
        function fnOpenerSubmit() {
            var dom = parseXML(document.getElementById("hidSearchXml").value);
            var StartWeek = $(dom).find("FirstFlag").text();
            
            if (StartWeek == "Y") {
                opener.location.href = fnSetUrlPath("EPG012M.aspx", "ec_req_sid");
            }
            else {
                var sumFlag = $(dom).find("cbSumFlag").text();

                if (sumFlag == "Y") {
                    sumFlag = "N";                                      
                }

                opener.frmSearchData(true, sumFlag);
            }
        }

        // 신규등록
        function fnNew() {
            document.body.insertAdjacentHTML("beforeEnd", "<iframe name=frmNew width=0 height=0></iframe>");
            var doc = frmNew.document;
            doc.open();
            doc.write("<body>");
            //급여계산>신고귀속클릭>신규입력시 
                doc.write(" <form name='form' method='post' action=" + fnSetUrlPath('EPG013M.aspx', 'ec_req_sid') + " target='EPG013M'><input type='hidden' id='hidPop2' name='hidPop2' value='Y' /> ");
            
            doc.write(" <input type='hidden' id='hidSearchXml' name='hidSearchXml' />");
            doc.write(" <script language=\"javascript\" type=\"text/javascript\">");
            doc.write(" document.getElementById('hidSearchXml').value = parent.document.getElementById('hidSearchXml').value;");
            doc.write(" document.form.submit(); ");
            doc.write(" </script>");
            doc.write("</body> ");
            doc.close();
        }


        
        // 비과세재계산
        function fnNonTax() {
            if ("W" != "W") {
                alert("읽기 권한자는 사용할 수 없는 기능입니다.");
                return false;
            }
            
            var strPayGubun = $("#pay_gubun option:selected").val();
            if($("#hidOldpaygubun").get(0).value !=  strPayGubun)       
            {
                alert("저장(F8)후, 비과세재계산 해 주세요");
                return false;
            }
            __doPostBack("lnkPayNonTax", "");
            return false;
        }        

        // 리스트
        function fnList() {
            $("#form")
            .attr("method", "post")
            .attr("action", fnSetUrlPath("EPG012M.aspx", "ec_req_sid"))
            .submit();
        }

        //지급일 변경시 지급년월 년월 같도록 처리
        function fnChangePayDate() {
            //var strPSYear = $("#ddlPayDateYear option:selected").val();
            //var strPSMonth = $("#ddlPayDateMonth option:selected").val();
            
            //$("#ddlRYear > option[value="+strPSYear+"]").attr("selected", "true");
            //$("#ddlRMonth > option[value="+strPSMonth+"]").attr("selected", "true");
        }

        
        $(document).ready(function() {
            //SetElementEvent();
            ChangePayGubun();
            ChangePayRateFlag();
            
            
            $("#ddlPYear").focus();
            

            checkSetupList();
        });

        // 사용방법설정 설정값이 존재하는지 확인
	    function checkSetupList() {           
		    var param = { PROGRAM_SEQ : 917 };
		
		     $.ajax({
			    type: "POST",
			    dataType: "json",
			    data: JSON.stringify(param),
			    contentType: 'application/json',
			    async:false,
			    url: fnSetUrlPath("/ECAPI/SelfCustomize/Config/GetListSelfCustomizeSetup", "ec_req_sid"),        
			    error: function(errorMsg) {
				    alert('에러발생'+'\nfnGetData:' + errorMsg);            
			    },
			    success: function(returnData) {                     
				    if(returnData.Status == "200" && returnData.Data.Height != 0) {
					    if ($(".title-rightarea").length  == 0 ){
						    $(".new-title").append(' <div class="title-rightarea"><span class="btn-setting" onclick="fnShowOption(); return false;"></span><ul class="option_box_new" ><li id="scPopup"><a onclick="fnSelfCustomizing();">사용방법설정</a></li></ul></div>');
					    } else if ($(".title-rightarea > ul li").length  > 0) {
						    $(".title-rightarea > ul").append('<li id="scPopup"><a onclick="fnSelfCustomizing();">사용방법설정</a></li>');
					    }
                        // 팝업창 사이즈 조절
                        selfCustomizingHeight = returnData.Data.Height+ 50;
				    }
			    }
		    });      
	    }

        //사용방법설정
        function fnSelfCustomizing() {
	        var url = "/ECERP/ESC/ESC002M";    
	        gfnpopSubmit("frmSC", url, "frmSC", "yes", "750", selfCustomizingHeight);
	        return false;
        }
    //-->
    </script>

<!----------------------------------------------------------------------------------------------------------------------->