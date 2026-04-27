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
					<a href="#">출력물 관리</a>
				</li>
				<li class="active">경영자료</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					원가명세서
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						원가명세서.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="col-xs-12">
						<form name="frmSuccess" id="frmSuccess" action="/ECERP/LOGIN/ERPLoginSuccess" method="post">
						<!-- <form action="/ECMain/EBZ/EBZ013P_01.aspx?ec_req_sid=B-E0JxDW_a2Q6eO" method="post" target="EBG001ML0VDTWFpbi"> -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">구분</th>
								<td class="col-xs-11" colspan=3><input name="division" id="division" type="radio" checked="checked" value="5018"><label for="division" data-cid="division" data-role="widget-focus">제품제조 5018</label>&nbsp;<input name="division" id="division" type="radio" value="6018"><label for="division" data-cid="division" data-role="widget-focus">용역 6018</label>&nbsp;<input name="division" id="division" type="radio" value="7018"><label for="division" data-cid="division" data-role="widget-focus">기타 7018</label></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">부서표시방법</th>
								<td class="col-xs-5"><input name="division" id="division" type="radio" checked="checked" value="0"><label for="division" data-cid="division" data-role="widget-focus">집계</label>&nbsp;<input name="division" id="division" type="radio" value="1"><label for="division" data-cid="division" data-role="widget-focus">종</label>&nbsp;<input name="division" id="division" type="radio" value="2"><label for="division" data-cid="division" data-role="widget-focus">횡</label></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">프로젝트표시방법</th>
								<td class="col-xs-5"><input name="division" id="division" type="radio" checked="checked" value="0"><label for="division" data-cid="division" data-role="widget-focus">집계</label>&nbsp;<input name="division" id="division" type="radio" value="1"><label for="division" data-cid="division" data-role="widget-focus">종</label>&nbsp;<input name="division" id="division" type="radio" value="2"><label for="division" data-cid="division" data-role="widget-focus">횡</label></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">비교대상월</th>
								<td class="col-xs-11" colspan=3><input name="division" id="division" type="radio" checked="checked" value="0"><label for="division" data-cid="division" data-role="widget-focus">직전기수</label>&nbsp;<input name="division" id="division" type="radio" value="1"><label for="division" data-cid="division" data-role="widget-focus">전기동일기간</label>&nbsp;<input name="division" id="division" type="radio" value="2"><label for="division" data-cid="division" data-role="widget-focus">직접입력</label>&nbsp;<input name="division" id="division" type="radio" value="3"><label for="division" data-cid="division" data-role="widget-focus">당기누계</label>&nbsp;<input name="division" id="division" type="radio" value="3"><label for="division" data-cid="division" data-role="widget-focus">선택안함</label></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">기준월</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="base_sdate" id="base_sdate" type="text" value="<?=date('Y/m/d')?>" data-date-format="yyyy/mm/dd" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
										~
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="base_edate" id="base_edate" type="text" value="<?=date('Y/m/d')?>" data-date-format="yyyy/mm/dd" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">부서</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="department_cd" id="department_cd" readonly />
												<input type="text" name="department_nm" id="department_nm" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog1">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">프로젝트</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="project_cd" id="project_cd" readonly />
												<input type="text" name="project_nm" id="project_nm" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog2">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">거래처</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="account_cd" id="account_cd" />
												<input type="text" name="account_nm" id="account_nm" />
												<span class="input-group-addon btn-purple" id="id-btn-dialog3">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">기타</th>
								<td class="col-xs-11" colspan="3">
									<input name="etc" id="etc" type="checkbox" checked="checked" value="0"><label for="etc" data-cid="etc" data-role="widget-focus">천단위</label>&nbsp;<input name="etc" id="etc" type="checkbox" value="1"><label for="etc" data-cid="etc" data-role="widget-focus">잔액0포함</label>							
								</td>
							</tr>
							<tr>
								<td class="col-xs-5" colspan="4">
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="search()">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											Search
										</button>
									</span>
								</td>
							</tr>
						</table>
					</div>
					</form>
					<div style="clear:both"></div>
					
					<div style="margin-top:10px">
						<!-- <div class="col-xs-12 center"><H2>원가명세서</H2></div> -->
						 <table class="table">
						 <tbody>
						 <tr>
						 <td style="width: 99%; height: 30px; text-align: center; line-height: 20px; font-size: 20px; font-weight: bold;">
						 <u>원가명세서</u><br>
						 <div style="line-height: 14px; font-size: 11px; font-weight: normal;">
						 제 8기 2017/01/01 부터 2017/11/30 까지<br>
						 제 7기 2016/01/01 부터 2016/12/31 까지 
						 </div>
						 </td>
						 <td align="right" style="width: 1%; height: 87px;">
							 <table style="margin: 0px 0px 5px; width: 236px; color: rgb(0, 0, 0); border-top-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-top-width: 1px; border-left-width: 1px; border-top-style: solid; border-left-style: solid; border-collapse: collapse; table-layout: fixed;" border="0" cellspacing="0" cellpadding="0">
								 <tbody>
									 <tr>
										<th style="background: rgb(236, 236, 236); padding: 0px; width: 24px; text-align: center; font-size: 12px; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; -ms-word-wrap: break-word;" rowspan="2">결<br>재</th>
										<th style="background: rgb(236, 236, 236); padding: 5px 0px 3px; width: 69px; text-align: center; font-size: 11px; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; -ms-word-wrap: break-word;">담당</th>
										<th style="background: rgb(236, 236, 236); padding: 5px 0px 3px; width: 69px; text-align: center; font-size: 11px; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; -ms-word-wrap: break-word;">대리</th>
										<th style="background: rgb(236, 236, 236); padding: 5px 0px 3px; width: 69px; text-align: center; font-size: 11px; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; -ms-word-wrap: break-word;">과장</th>
									 </tr>
									<tr>
										<td style="padding: 5px 0px 3px; height: 55px; text-align: center; font-size: 11px; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; -ms-word-wrap: break-word;">&nbsp;</td>
										<td style="padding: 5px 0px 3px; height: 55px; text-align: center; font-size: 11px; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; -ms-word-wrap: break-word;">&nbsp;</td>
										<td style="padding: 5px 0px 3px; height: 55px; text-align: center; font-size: 11px; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; -ms-word-wrap: break-word;">&nbsp;</td>
									</tr>
								 </tbody>
							 </table>
						 </td>
						 </tr>
						 </tbody>
						 </table>





						<div class="input-group col-xs-12 text-right">단위 : 원</div>
						<table id="general_ledger_account_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="col-xs-4 center" style="background-color:#f1f1f1">재무재표표시명</th>
									<th class="col-xs-4 center" style="background-color:#f1f1f1" colspan="2">제8기(기준)</th>
									<th class="col-xs-4 center" style="background-color:#f1f1f1" colspan="2">제7기(비교)</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>

<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>

<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
					<div class="col-xs-6 right" style="text-align:right">
						<!-- <button class="btn btn-info" type="button" onclick="location.href = 'index.php?controller=sales&action=inputPagestatement' "> -->
						<button class="btn btn-info" type="button" onclick="GeneralLedgerAccount_reg('0','0')">
							<i class="ace-icon fa fa-check"></i>
							인쇄
						</button>

						&nbsp; &nbsp; &nbsp;
						<button class="btn btn-danger" type="button" onclick="deleteSelect()">
							<i class="ace-icon fa fa-undo"></i>
							Excel
						</button>
					</div>
				</div>
			</div>
<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

		</div>
	</div>
</div>
<div id="id-btn-dialog6" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">매출전표</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="GeneralLedgerAccount_reg_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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


<div id="dialog-message1" class="hide">
	<table id="department_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">부서코드</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">부서명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<div id="dialog-message2" class="dialog-view hide">
	<table id="project_list" class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">프로젝트코드</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">프로젝트명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<div id="dialog-message3" class="dialog-view hide">
	<table id="account_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-2 center" style="background-color:#f1f1f1">거래처구분</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">거래처코드</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">거래처명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->


<div id="dialog-message4" class="dialog-view hide">
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="col-xs-12">
						<div class="col-xs-3" style="float:left">
							계정코드검색
						</div>
						<!-- <div class="col-xs-4" style="float:left">
						<select class="form-control" onchange="setAccountCode(this.value)">
							<option value="cd">계정코드</option>
							<option value="nm">계정명</option>
						</select>
						</div> -->
						<div class="col-xs-8" style="float:right">
							<div class="col-xs-12"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="Search..." name="search_txt" id="search_txt" />
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
					<div style="clear:both"></div>
					<div style="margin-top:10px">
						<table id="account_code_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="col-xs-6 center" style="background-color:#f1f1f1">[계정코드] 계정명</th>
									<th class="col-xs-6 center" style="background-color:#f1f1f1">검색창내용</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
			</div>
		</div>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->



<div id="id-btn-dialog5" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">매출전표</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="GeneralLedgerAccount_modify_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
<input type="hidden" name="searchTxt" id="searchTxt" value="" />
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="account_gb" id="account_gb" value="" />
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_sids" id="check_sids" />

<?
require_once ("assets/include_script.php");
?>
<script type="text/javascript">
<!--
	  //$("#id-btn-dialog3").show(); 
	  var url = "";

	  $('#id-btn-dialog1').attr('src', url);
	  $("#id-btn-dialog1").draggable({
      handle: "#modal-header1"
});
	  $('#id-btn-dialog2').attr('src', url);
	  $("#id-btn-dialog2").draggable({
      handle: "#modal-header2"
});
	  $('#id-btn-dialog3').attr('src', url);
	  $("#id-btn-dialog3").draggable({
      handle: "#modal-header3"
});
	  $('#id-btn-dialog4').attr('src', url);
	  $("#id-btn-dialog4").draggable({
      handle: "#modal-header4"
});
	  $('#id-btn-dialog5').attr('src', url);
	  $("#id-btn-dialog5").draggable({
      handle: "#modal-header5"
});

//-->
</script>
<style type="text/css">
.modal
{
    overflow: hidden;
}
.modal-dialog{
    margin-right: 0;
    margin-left: 0;
}	
</style>
<script>
$(document).ready(function(){
	var page = $("#page").val();
	getDepartment()
	getProject()
	getAccount()
	getAccountCode()
	getGeneralLedgerAccount(page);

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

function commaSplit(n) {// 콤마 나누는 부분
    var txtNumber = '' + n;
    var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
    var arrNumber = txtNumber.split('.');
    arrNumber[0] += '.';
    do {
        arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
    }
    while (rxSplit.test(arrNumber[0]));
    if(arrNumber.length > 1) {
        return arrNumber.join('');
    } else {
        return arrNumber[0].split('.')[0];
    }
}


// 계정별 원장 리스트 가져오기
function getGeneralLedgerAccount(page){
	var table = "erp_statement";
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var sumDebtor = "0";
	var sumCreditor = "0";
	var sumBalance = "0";
	var page = page;

	//var search_choice = $("#division option:selected").val();
	//var txt = $("#search_txt").val();
	var search_checked1 = $('input:radio[id="division"]').val(); 
	var search_checked2 = $('input:checkbox[id="etc"]').val(); 
	var base_sdate = $("#base_sdate").val();
	var base_edate = $("#base_edate").val();
	var department_cd = $("#department_cd").val();
	var department_nm = $("#department_nm").val();
	var project_cd	= $("#project_cd").val();
	var project_nm	= $("#project_nm").val();
	var account_cd	= $("#account_cd").val();
	var account_nm	= $("#account_nm").val();
	var aci_cd		= $("#aci_cd").val();
	var aci_nm		= $("#aci_nm").val();
	var etc			= $("#etc").val();
	var search = $("#where").val();

	$.getJSON("ajax/ledger.php",{"page":page, "mode":"getGeneralLedgerAccount", "rpp" : rpp, "adjacents" : adjacents, "where":search, "search_checked1":search_checked1, "search_checked2" : search_checked2, "base_sdate" : base_sdate, "base_edate" : base_edate, "department_cd" : department_cd, "department_nm" : department_nm, "project_cd" : project_cd, "project_nm" : project_nm, "account_cd" : account_cd, "account_nm" : account_nm, "aci_cd" : aci_cd, "aci_nm" : aci_nm, "etc" : etc, "table" : table},
		function(json){
			if(json != null) {
				$("#total_num").html(json[0].total_num);
				
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td class='center' ><a href='javascript:void(0);'  onclick='GeneralLedgerAccount_modiy(" + json[i].uid + "," + json[i].statement_dt + ", " + json[i].statement_ca + ")' >" + json[i].statement_dt + "-" + json[i].statement_ca + "</a></td>";
					tag += "<td class='center'>" + commaSplit(json[i].debtor) + "</td>";
					tag += "<td class='center'>" + commaSplit(json[i].creditor) + "</td>";
					tag += "<td class='center'>" + commaSplit(json[i].debtor) + "</td>";
					tag += "<td class='center'>" + commaSplit(json[i].creditor) + "</td>";
					tag += "</tr>";
					
					sumDebtor = parseInt(sumDebtor) + parseInt(json[i].debtor);
					sumCreditor = parseInt(sumCreditor) + parseInt(json[i].creditor);
					sumBalance = parseInt(sumDebtor) - parseInt(sumCreditor);
				}
			}else{
				tag += "<tr>";
					tag += "<td colspan=10 class='center'>등록된 데이터가 없습니다.";
					tag += "</td>";
				tag += "</tr>";
			}	
				/*
				tag += "<tr class='active'>";
                tag += "<td class='center' colspan='3'><b><style='color:#0066FF'>누계</font></b></td>";
                tag += "<td class='center'><span id='sumDebtor' style='font-weight:bold'>"+ commaSplit(sumDebtor)+ "</span></td>";
                tag += "<td class='center'><span id='sumCreditor' style='font-weight:bold'>"+ commaSplit(sumCreditor)+ "</span></td>";
                tag += "<td class='center'><span id='sumBalance' style='font-weight:bold'>"+ commaSplit(sumBalance)+ "</span></td>";
                tag += "<td class='center'>-</td>";
				tag += "</tr>";
				*/

			$("#general_ledger_account_list tbody").html(tag);

			if(account_gb == "" || account_gb == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			}

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function getDepartment(page) {
	var rpp = 15;
	var adjacents = 4;
	var page = page;
	var tag = "";

	$.getJSON("ajax/department.php",{"page":page, "mode":"getDepartment", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postDepartmentData('" + json[i].uid + "','" + json[i].department_cd + "')\">" + json[i].uid + "</a></td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postDepartmentData('" + json[i].uid + "','" + json[i].department_nm + "')\">" + json[i].department_nm + "</a></td>";
					tag += "</tr>";
				}
			}
			
			$("#department_list tbody").html(tag);

			var table = "erp_department";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function getProject() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;

	$.getJSON("ajax/groupware.php",{"page":page, "mode":"getProject", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postProject('" + json[i].project_cd + "','" + json[i].project_nm + "')\">" + json[i].project_cd + "</a></td>";
					tag += "<td>" + json[i].project_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#project_list tbody").html(tag);

			var table = "erp_project";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function getAccountCode() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var aci_cd = $("#aci_cd").val();

	$.getJSON("ajax/account_code.php",{"page":page, "mode":"get_account_code", "rpp" : rpp, "adjacents" : adjacents, "where":search, "aci_cd":aci_cd},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccountCode('" + json[i].aci_cd + "','" + json[i].aci_nm + "')\">[" + json[i].aci_cd + "] " + json[i].aci_nm + "</a></td>";
					tag += "<td>" + json[i].search_box + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_code_list tbody").html(tag);

			var table = "erp_account_code";
			if(aci_cd == "" || aci_cd == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and aci_cd='"  + aci_cd + "'";
			}

			//getPaging(table,where,rpp,adjacents);
		}
	);
}
// 거래처 리스트 가져오기
function getAccount(){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var account_gb = $("#account_gb").val();

	$.getJSON("ajax/account.php",{"page":page, "mode":"getAccount", "rpp" : rpp, "adjacents" : adjacents, "where":search, "account_gb":account_gb},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					if(json[i].account_gb == "purchase") var clas = "매입";
					else var clas = "매출";
					
					tag += "<tr>";
					tag += "<td class='center'>" + clas + "</td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccount('" + json[i].account_cd + "','" + json[i].account_nm + "')\">" + json[i].account_cd + "</a></td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_list tbody").html(tag);

			var table = "erp_account";
			var where = "";
			//if(account_gb == "" || account_gb == "all") {
			//	var where = $("#where").val();
			//} else {
			//	var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			//}

			//getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getAccount(page);
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
		$(".chk input:checked").each(function(){
		  var checked = $(this).attr("checked"); // 체크된 값만을 불러 들인다.
		  alert(checked)
		  if(checked==true){
		   $(this).next().remove(); //span내용지우기
		   $(this).remove();   //checkbox 지우기
		  }
		 });



	if(confirm("선택하신 전표 정보를 삭제하시겠습니까? 다른 데이터와 연동된 전표 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				//alert($(this).val())
				var new_sid = $("#check_sids").val() + "," + $(this).val();
				//alert(new_sid)
				$("#check_sids").val(new_sid);
			}
		});

		var dataString = "mode=deleteSelectStatement_s&table=erp_g_statement&sids=" + $("#check_sids").val();
		$.ajax({
			type : "post",
			url : "ajax/statement.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getGeneralLedgerAccount(1);
				}
			}
		});
	}
}


// 거래처 구분으로 거래처 리스트 가져오기
function setAccount(val) {
	$("#page").val(1);
	$("#account_gb").val(val);
	getAccount(1);
}
</script>
<script type="text/javascript">
<!--
function closePopup()
{
	window.parent.closeModal('<?=$dialogid?>');
	window.parent.location.reload();

}
window.closeModal = function(obj) {
	$("#"+obj).modal( 'hide' );
}

// 검색
function search(){
	//var search_checked1 = $('input:radio[id="division"]').val(); 
	//var search_checked2 = $('input:checkbox[id="etc"]').val(); 
	//var base_sdate = $("#base_sdate").val();
	//var base_edate = $("#base_edate").val();
	//var department_cd = $("#department_cd").val();
	//var department_nm = $("#department_nm").val();
	//var project_cd	= $("#project_cd").val();
	//var project_nm	= $("#project_nm").val();
	//var account_cd	= $("#account_cd").val();
	//var account_nm	= $("#account_nm").val();
	var aci_cd		= $("#aci_cd").val();
	var aci_nm		= $("#aci_nm").val();
	//var etc			= $("#etc").val();
	
	if (aci_cd =="")
	{
	 alert('검색창에 계정코드를 입력하세요')
	 $('#aci_cd').focus();
	 return
	}

	//if(search_choice == "account_nm") {
	//	$("#where").val(" where 1=1 and account_nm like '%" + txt + "%' ");
	//} else if(search_choice == "account_cd") {
	//	$("#where").val(" where 1=1 and account_cd like '%" + txt + "%' ");
	//}
	getGeneralLedgerAccount(1);
}
function postDepartmentData(cd,nm) {
	$("#dialog-message1").dialog("close");
	$("#department_cd").val(cd);
	$("#department_nm").val(nm);
}


function postProject(code,name) {
	$("#dialog-message2").dialog("close");
	$("#project_cd").val(code);
	$("#project_nm").val(name);
}

function postAccount(code,name,manager) {
	$("#dialog-message3").dialog("close");
	$("#account_cd").val(code);
	$("#account_nm").val(name);
}
function postAccountCode(aci_cd,aci_nm){
	$("#dialog-message4").dialog("close");
		$("#aci_cd").val(aci_cd);
		$("#aci_nm").val(aci_nm);
}
/*
$(document).ready(function(){
        var tSum = 0;
        var aSum = 0;
        var cSum = 0;
        
        $(".totalArea").each(function(){
            if(!isNaN(this.value) && this.value.length != 0){
                tSum += parseFloat(this.value);
            }
        });
        $(".area").each(function(){
            if(!isNaN(this.value) && this.value.length != 0){
                aSum += parseFloat(this.value);
            }
        });
        $(".capacity").each(function(){
            if(!isNaN(this.value) && this.value.length != 0){
                cSum += parseFloat(this.value);
            }
        });
    
        $("#sumTotalArea").html(tSum);
        $("#sumArea").html(aSum);
        $("#sumCapacity").html(cSum);
*/
//-->
</script>

<!-- inline scripts related to this page -->
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

			$( "#id-btn-dialog1" ).on('click', function(e) {
		
		e.preventDefault();
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 300,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>부서 리스트</h4></div>",
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
	
	$( "#id-btn-dialog2" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message2" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>프로젝트 리스트</h4></div>",
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
						
	$( "#id-btn-dialog3" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message3" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>거래처검색</h4></div>",
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
	
	$( "#id-btn-dialog4" ).on('click', function(e) {			
		e.preventDefault();
			
		var dialog = $( "#dialog-message4" ).removeClass('hide').dialog({
			width : 700,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>계정코드검색</h4></div>",
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
	function GeneralLedgerAccount_reg(cidx, acd)
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
	var url = "index.php?controller=accounting&action=registGeneralLedgerAccountPop&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogid=id-btn-dialog1";
	//var url = "./views/accounting/card/cardcompany_remark_list_pop.php?&sid="+cidx+"&pop=Y&ddd="+cidx;
	$("#GeneralLedgerAccount_reg_frame").attr("src", url);
	}

	function GeneralLedgerAccount_modiy(sid, dt, ca)
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

	var url = "index.php?controller=accounting&action=modifyGeneralLedgerAccountPop&sid="+sid+"&pop=Y&statement_dt="+dt+"&statement_ca="+ca+"&dialogid=id-btn-dialog2";
	//var url = "./views/accounting/card/cardcompany_remark_list_pop.php?&sid="+cidx+"&pop=Y&ddd="+cidx;
	$("#GeneralLedgerAccount_modify_frame").attr("src", url);
	}

	function close_popup()
	{	
		$.modal.close();
		$("#GeneralLedgerAccount_reg_frame").attr("src", "about:blank");
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
