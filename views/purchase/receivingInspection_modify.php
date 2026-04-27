<?

$title = "수입검사 수정";
require_once("../../connection.php");
require_once("../../assets/phead.php");
session_start();
extract($_POST);
extract($_GET);
$sql = "select * from erp_receiving_inspection where inspection_cd='".$cd."'";
//echo $sql; 
$t = @mysql_fetch_object(mysql_query($sql));
?>

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
	if($("#writer").val()==""){
		alert("검사자를 입력하세요 ");
		$("#writer").focus();
		return false;
	}
	
	var flag = $(opener.document).find("#inspectionFlag").val();
	var faulty_content_val = $('#faulty_content option:selected').val();
	var faulty_cnt = $("#faulty_cnt").val();
	if (faulty_content_val=="기타")
	{
		faulty_content_text = $("#faulty_content1").val();
	}else{
		faulty_content_text = faulty_content_val;
	}
	var dataString = "mode=registInspectionCd&item_cd=" + $("#item_cd").val() + "&item_nm=" + $("#item_nm").val()+ "&standard1=" + $("#standard1").val()+ "&unit=" + $("#unit").val()+ "&in_cnt=" + $("#in_cnt").val()+ "&faulty_cnt=" + $("#faulty_cnt").val()+ "&faulty_content=" + faulty_content_text + "&emp_nm=" + $("#emp_nm").val()+ "&emp_id=" + $("#emp_id").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "../../ajax/inspection.php",
		success : function(result) {
			//$(opener.document).find("#inspection_cd_" + flag).val(result);
			//$(opener.document).find("#flag").val(Number(flag) + 1);
			//self.close();
			alert('완료');
			//window..opener.location.reload();
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
			<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />
			<input type="hidden" name="action" id="action" value="" />
			<table class="table  table-bordered table-hover" style="margin-top:10px">
				<thead>
				</thead>
				<tbody>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">품목코드</th><td class=" col-xs-8"><input type="text" name="item_cd" id="item_cd" value="<?=$t->item_cd?>" readonly></td>
					</tr>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">품목</th><td class=" col-xs-8"><input type="text" name="item_nm" id="item_nm" value="<?=$t->item_nm?>" readonly></td>
					</tr>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">규격</th><td class=" col-xs-8"><input type="text" name="standard1" id="standard1" value="<?=$t->standard1?>" readonly></td>
					</tr>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">단위</th><td class=" col-xs-8"><input type="text" name="unit" id="unit" value="<?=$t->unit?>" readonly></td>
					</tr>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">입고량</th><td class=" col-xs-8"><input type="text" name="in_cnt" id="in_cnt" class="text-center"  value="<?=$t->in_cnt?>" readonly/></td>
					</tr>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">불량수량</th><td class=" col-xs-8"><input type="text" name="faulty_cnt" id="faulty_cnt" class="text-center" value="<?=$t->faulty_cnt?>" readonly/></td>
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
						
							<option value=''>선택</option>";
							<?
							while($b = mysql_fetch_object($result)) {
							?>
							<option value='<?=$b->defect_nm?>' <?if ($t->faulty_content == $b->defect_nm) echo "selected"?>><?=$b->defect_nm?></option>";
							<?
							}
							?>
							<option value='기타'>기타</option>";
						</SELECT>
						</div>

						<div class="left col-xs-8 layer">
							<input type="text" name="faulty_content1" id="faulty_content1"  class="form-control" value="<?=$b->defect_nm?>"></td>
						</div>
						
						</td>
					</tr>
					<tr>
						<th class="center col-xs-4" style="background-color:#f1f1f1">검사자</th><td class=" col-xs-8" >
						<div class="input-group">
							<span class="input-icon input-icon-right">
								<!--
								<div class="input-group">
									<input type="hidden" name="emp_id" id="emp_id" value="<?=$t->emp_id?>" readonly />
									<input type="text" name="emp_nm" id="emp_nm"  value="<?=$t->emp_nm?>" onclick="centerOpenWindow('../../views/popup/employeeList.php', '직원리스트', 600, 500)"  />
									<span class="input-group-addon btn-purple"  style="cursor:pointer" onclick="centerOpenWindow('../../views/popup/employeeList.php', '직원리스트', 600, 500)">
										<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
									</span>
								</div>
								-->
								<div class="input-group">
									<input type="hidden" name="emp_id" id="emp_id" value="<?=$t->emp_id?>" readonly />
									<input type="text" name="emp_nm" id="emp_nm"  value="<?=$t->emp_nm?>" readonly/>
									<span class="input-group-addon btn-purple"  style="cursor:pointer" >
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
										<input type="text" class=" date-picker" name="regdate" id="regdate"  value=<?=$t->regdate?> data-date-format="yyyy/mm/dd" readonly/>
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
		<!--
			<button class="btn btn-xs btn-info" type="button" onclick="registInspection()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				저장
			</button>
		-->
			<button class="btn btn-xs btn-info" type="button" onclick="self.close()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				닫기
			</button>
		</div>
	</div><!-- // submit -->
</div><!-- /.page-content -->

<?
require_once("../../assets/pfoot.php");
?>