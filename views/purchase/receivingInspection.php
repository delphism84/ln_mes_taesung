<?

$title = "수입검사";
require_once("../../connection.php");
require_once("../../assets/phead.php");
//require_once ("../../assets/include_script.php");
session_start();
extract($_POST);
extract($_GET);

$sql = "select * from erp_item";
$result = mysql_query($sql) or die (mysql_error());

?>

<meta charset="UTF-8">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<script>

function registInspection(){
	
	if($("#item_cd").val()==""){
		alert("품목코드를 입력하세요");
		$("#item_cd").focus();
		return false;
	}
	
	if($("#in_cnt").val() =="0"){
		alert("입고량을 입력하세요");
		$("#in_cnt").focus();
		return false;
	}
	/*
	if($("#faulty_cnt").val()==""){
		alert("불량수량을 입력하세요");
		$("#faulty_cnt").focus();
		return false;
	}
	
	if($("#faulty_content").val()==""){
		alert("불량내용 입력하세요 ");
		$("#faulty_content").focus();
		return false;
	}
	*/
	if($("#emp_nm").val()==""){
		alert("검사자를 입력하세요 ");
		$("#emp_nm").focus();
		return false;
	}
	/*
	if ($("#cnt").val() != $("#in_cnt").val())
	{
		alert("구매 입고수량 과 수입검사 입고수량이 같지 않습니다.");
		return false;
	}
	*/
	
	var flag = $(opener.document).find("#inspectionFlag").val();
	var faulty_content_val = $('#faulty_content option:selected').val();

	var faulty_cnt = $("#faulty_cnt").val();

	if (faulty_content_val=="기타")
	{
		var faulty_content_text = $("#faulty_content1").val();
	}else{
		var faulty_content_text = faulty_content_val;
	}

	var dataString = "mode=registInspectionCd&item_cd=" + $("#item_cd").val() + "&item_nm=" + $("#item_nm").val()+ "&standard1=" + $("#standard1").val()+ "&unit=" + $("#unit").val()+ "&in_cnt=" + $("#in_cnt").val()+ "&faulty_cnt=" + $("#faulty_cnt").val()+ "&faulty_content=" + faulty_content_text + "&emp_nm=" + $("#emp_nm").val()+ "&emp_id=" + $("#emp_id").val()+ "&regdate=" + $("#regdate").val();
	
	$.ajax({
		type : "post",
		data : dataString,
		url : "../../ajax/inspection.php",
		success : function(result) {
			$(opener.document).find("#inspection_cd_" + flag).val(result);
			//$(opener.document).find("#flag").val(Number(flag) + 1);
			$(opener.document).find("#btn_" + flag).html('등록완료');
			$(opener.document).find("#btn_" + flag).css("background-color","silver");
			$(opener.document).find("#btn_" + flag).attr("disabled",true);

			self.close();
		},
			 error: function (request, status, error) {
			 console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}
	});
	//self.close();
}

jQuery('#faulty_content').change(function() {
	var state = jQuery('#faulty_content option:selected').val();
	alert(state)
	if(state == '기타') {
		jQuery('.layer').show();
	} else {
		jQuery('.layer').hide();
	}
});

function setText(){
var state = jQuery('#faulty_content option:selected').val();
	if(state == '기타') {
		jQuery('.layer').show();
	} else {
		jQuery('.layer').hide();
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
</script>
<style type="text/css">
	.layer { display: none; }

</style>
<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" />
			<input type="hidden" name="pid" id="pid" value="<?=$fid?>" />
			<input type="hidden" name="uid" id="uid" value="<?=$uid?>" />
			<input type="hidden" name="cnt" id="cnt" value="<?=$cnt?>" />
			<input type="hidden" name="action" id="action" value="registEleSettlement" />
			<table class="table  table-bordered table-hover" style="margin-top:10px">
				<thead>
				</thead>
				<tbody>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">품목코드</th><td class=" col-xs-8"><input type="text" name="item_cd" id="item_cd" value="<?=$icd?>" readonly></td>
					</tr>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">품목</th><td class=" col-xs-8"><input type="text" name="item_nm" id="item_nm" value="<?=$inm?>" readonly></td>
					</tr>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">규격</th><td class=" col-xs-8"><input type="text" name="standard1" id="standard1" value="<?=$st?>" readonly></td>
					</tr>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">단위</th><td class=" col-xs-8"><input type="text" name="unit" id="unit" value="<?=$unit?>" readonly></td>
					</tr>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">입고량</th><td class=" col-xs-8"><input type="text" name="in_cnt" id="in_cnt" class="text-right"  value="<?=$cnt?>"  onclick="this.select();"></td>
					</tr>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">불량수량</th><td class=" col-xs-8"><input type="text" name="faulty_cnt" id="faulty_cnt" class="text-right" value="0" onclick="this.select();"></td>
					</tr>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">불량내용</th><td class=" col-xs-8" >
						<div class="row">
						<div class="col-xs-3">
						<?
						$sql = "select * from erp_defect_reason where type='1' order by uid desc";
						$result = mysql_query($sql);
						?>
						<SELECT name="faulty_content" id="faulty_content" onchange="setText()">
						<?
							$faulty = "<option value=''>선택</option>";
							while($t = mysql_fetch_object($result)) {
							$faulty .= "<option value='".$t->defect_nm."'>".$t->defect_nm."</option>";
							}
							$faulty .= "<option value='기타'>기타</option>";
							echo $faulty;
						?>
						</SELECT>
						</div>

						<div class="left col-xs-8 layer">
							<input type="text" name="faulty_content1" id="faulty_content1"  class="form-control"></td>
						</div>
						
						</td>
					</tr>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">검사자</th><td class=" col-xs-8" >
						<div class="input-group">
							<span class="input-icon input-icon-right">
								<div class="input-group">
									<input type="hidden" name="emp_id" id="emp_id" readonly />
									<input type="text" name="emp_nm" id="emp_nm"  onclick="centerOpenWindow('../../views/popup/employeeList.php', '거래처리스트', 600, 500)"  />
									<span class="input-group-addon btn-purple"  style="cursor:pointer" onclick="centerOpenWindow('../../views/popup/employeeList.php', '거래처리스트', 600, 500)">
										<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
									</span>
								</div>
							</span>
						</div>
						</td>
					</tr>
					<tr>
						<th class="col-xs-1" style="background-color:#f1f1f1;text-align:center;">검사일</th>
						<td class="col-xs-5">
							<div>
								<span class="input-icon input-icon-right">
									<div class="input-group">
										<input type="text" class=" date-picker" name="regdate" id="regdate"  value=<?=date('Y/m/d')?> data-date-format="yyyy/mm/dd" />
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</span>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix form-actions center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-info" type="button" onclick="registInspection()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				저장
			</button>
			<button class="btn btn-xs btn-info" type="button" onclick="self.close()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				닫기
			</button>
		</div>
	</div><!-- // submit -->
</div><!-- /.page-content -->

<?
require_once("../../assets/pfoot.php");
require_once ("../../assets/include_script.php");

?>

<!----------------------------------------------------------------------------------------------------------------------->

<script>
 $(function() {
    //input을 datepicker로 선언
    $("#regdate").datepicker({
	dateFormat: 'yy-mm-dd' //Input Display Format 변경
	,showOtherMonths: true //빈 공간에 현재월의 앞뒤월의 날짜를 표시
	,showMonthAfterYear:true //년도 먼저 나오고, 뒤에 월 표시
	,changeYear: true //콤보박스에서 년 선택 가능
	,changeMonth: true //콤보박스에서 월 선택 가능                
	//,showOn: "both" //button:버튼을 표시하고,버튼을 눌러야만 달력 표시 ^ both:버튼을 표시하고,버튼을 누르거나 input을 클릭하면 달력 표시  
	//,buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif" //버튼 이미지 경로
	//,buttonImageOnly: true //기본 버튼의 회색 부분을 없애고, 이미지만 보이게 함
	//,buttonText: "선택" //버튼에 마우스 갖다 댔을 때 표시되는 텍스트                
	,yearSuffix: "년" //달력의 년도 부분 뒤에 붙는 텍스트
	,monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'] //달력의 월 부분 텍스트
	,monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'] //달력의 월 부분 Tooltip 텍스트
	,dayNamesMin: ['일','월','화','수','목','금','토'] //달력의 요일 부분 텍스트
	,dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'] //달력의 요일 부분 Tooltip 텍스트
	//,minDate: "-1M" //최소 선택일자(-1D:하루전, -1M:한달전, -1Y:일년전)
	//,maxDate: "+1M" //최대 선택일자(+1D:하루후, -1M:한달후, -1Y:일년후)                
    });   
    
   $('.ui-datepicker').css('width', '120%').css('height', '300px').css('font-size','20px');
  

   
});
</script>

<!----------------------------------------------------------------------------------------------------------------------->