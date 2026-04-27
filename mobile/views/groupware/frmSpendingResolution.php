<?
require_once("library/caseby.php");

$children = 0;
$no_children = array();

function display_children($parent, $level) {
	global $children;
	global $no_children;

	$sql = sprintf("select * from account_subject where fid = %d", $parent);
	$result = mysql_query($sql);

	if($level > 0) echo "<ul id='$parent' style='display:none;'>\n";
	$list_id = "";
	while ($t = mysql_fetch_object($result)) {
		$children++;
		$list_id = "list_".$children;
		echo "<li id='".$list_id."' style='height:25px'>";
		echo "<a href='#' onclick=\"show(".$t->uid.", '".$HTTP_PATH."')\">";
		echo "<img src='assets/images/tree/c.gif' id='img_".$t->uid."' />";
		echo $t->subject."</a>&nbsp;<i class='fa fa-plus-square text-primary bigger-150' style='vertical-align:middle; cursor:pointer' onclick=\"postAccountSubject('".$t->subject."', ".$t->uid.")\"></i> ";
		echo "</li>";
		display_children($t->uid, $level+1);
	}

	//$child_product = display_products($parent);

	if($level > 0) echo "</ul>\n";
	$no_children[] =  'list_'.$children;
}
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">

			<div class="row">
				<div class="col-xs-12">				
					<div>
						<div class="col-xs-12">
							<?
							if($_SESSION['login_level'] >= 99) {
								echo "<div style='float:left'>";
								
								echo "<select onchange='getState(this.value)' style='height:35px; width:100%; margin-bottom:10px;'>";
								echo "<option value='all'>전체</option>";
								echo "<option value='n'>미결</option>";
								echo "<option value='y'>승인</option>";
								echo "</select>";
								echo "<input type='text' class='search-query' placeholder='' name='search_txt' id='search_txt' style='height:35px; width:80%;'/>";
								echo "<input type='button' class='btn btn-purple btn-sm' onclick='search()' value='검색' style='height:35px;' />";
								echo "</div>";
								echo "<div style='float:right'>";
								//echo "<input type='button' class='btn btn-xs btn-info' value='지출결의서등록' style='height:35px; margin-right:3px' onclick=\"showModal('registModal')\" />";
								//echo "<input type='button' class='btn btn-xs btn-danger' value='선택삭제' style='height:35px; data-toggle='modal' data-target='#confirm-delete' />";
								echo "</div>";
								echo "<input type='button' class='btn btn-xs btn-pink' value='지출결의서 리스트' style='height:35px; margin-top:10px;' />";
								$this->noCheckTable("tb","문서번호=>2,지출내용=>4,기안자=>1,기안일=>2,금액=>1,결재상태=>1,수정=>1");
							} else {
								echo "<div style='float:left'>";
								echo "<input type='button' class='btn btn-xs btn-pink' value='지출결의서 리스트' style='height:35px' />";
								echo "<select onchange='getState(this.value)' style='height:35px'>";
								echo "<option value='all'>전체</option>";
								echo "<option value='n'>미결</option>";
								echo "<option value='y'>승인</option>";
								echo "</select>";
								echo "<input type='text' class='search-query' placeholder='' name='search_txt' id='search_txt' style='height:35px;'/>";
								echo "<input type='button' class='btn btn-purple btn-sm' onclick='search()' value='검색' style='height:35px; margin-left:-5px;' />";
								echo "</div>";
								echo "<div style='float:right'>";
								echo "<input type='button' class='btn btn-xs btn-info' value='지출결의서등록' style='height:35px;' onclick=\"showModal('registModal')\" />";
								echo "</div>";
								
								$this->noCheckTable("tb","문서번호=>2,지출내용=>4,기안자=>1,기안일=>2,금액=>1,결재상태=>1,수정=>1");
							}
							
							$this->paging();
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="registModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:1400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">지출결의서</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:700px; overflow:scroll; overflow-x:hidden">
				<form name="frm" id="frm">
					<input type="hidden" name="uid" id="uid" />
					<input type="hidden" name="mode" id="mode" value="registSpending" />
					<input type="hidden" name="big_uid" id="big_uid" />
					<input type="hidden" name="middle_uid" id="middle_uid" />
					<input type="hidden" name="small_uid" id="small_uid" />
					<input type="hidden" name="flag" id="flag" value="1" />

					<!-- 테이블 -->
					<div class="widget-box widget-color-default">
						<div class="widget-header">
							<h5 class="widget-title bigger lighter">
								<i class="ace-icon fa fa-table blue"></i>
								<span style="color:#000; font-weight:bold">문서정보</span>
							</h5>
						</div>
						<div class="widget-body">
							<div class="widget-main no-padding">
								<table id="simple-table" class="table  table-bordered table-hover">
									<tr>
										<? $this->th("문서번호","red"); ?>
										<td class="col-xs-11" colspan="5"><input type="text" class="form-control" name="spending_cd" id="spending_cd" validation="yes" err="문서번호를 입력하세요" /></td>
									</tr>
									<tr>
										<? $this->th("부서"); ?>
										<td class="col-xs-3">
											<?=$this->createDbSelectBox("department_middle","department_nm","middle_department_cd","postMiddleDepartment",$_SESSION['middle_department']);?>
											<?=$this->createDbSelectBox("department_small","department_nm","small_department_cd","postSmallDepartment",$_SESSION['small_department']);?>
										</td>
										<? $this->th("담당자"); ?>
										<td class="col-xs-3"><input type="text" name="emp_nm" id="emp_nm" value="<?=$_SESSION['login_nm']?>" readonly /><input type="hidden" name="emp_id" id="emp_id" value="<?=$_SESSION['login_id']?>" /></td>
										<? $this->th("기안일"); ?>
										<td class="col-xs-3">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" name="draft_dt" id="draft_dt" type="text" data-date-format="yyyy-mm-dd" value="<?=date("Y-m-d")?>" />
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<div class="widget-box widget-color-default" style="margin-top:10px">
						<div class="widget-header">
							<h5 class="widget-title bigger lighter pink">
								<i class="ace-icon fa fa-table"></i>
								<span style="color:#000; font-weight:bold">거래처정보</span>
							</h5>
						</div>
						<div class="widget-body">
							<div class="widget-main no-padding">
								<table id="simple-table" class="table  table-bordered table-hover">
									<tr>
										<? $this->th("제목","red"); ?>
										<td class="col-xs-5"><input type="text" class="form-control" name="title" id="title" validation="yes" err="제목을 입력하세요" /></td>
										<? $this->th("지급예정일"); ?>
										<td class="col-xs-5">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" name="spending_dt" id="spending_dt" type="text" data-date-format="yyyy-mm-dd" value="<?=date("Y-m-d")?>" />
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
										</td>
									</tr>
									<tr>
										<? $this->th("거래처"); ?>
										<td class="col-xs-11" colspan="3">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="account_cd" id="account_cd" readonly />
													<input type="text" name="account_nm" id="account_nm"  onclick="showModal('accountModal')" readonly />
													<span class="input-group-addon btn-purple"  style="cursor:pointer" onclick="showModal('accountModal')" >
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</td>
									</tr>
									<tr>
										<? $this->th("계좌번호(은행)"); ?>
										<td class="col-xs-5">
											<select name="bank" id="bank">
												<option value="KB국민은행">KB국민은행</option>
												<option value="우리은행">우리은행</option>
												<option value="신한은행">신한은행</option>
												<option value="KEB하나은행">KEB하나은행</option>
												<option value="스탠다드차타드은행">스탠다드차타드은행</option>
												<option value="한국씨티은행">한국씨티은행</option>
												<option value="대구은행">대구은행</option>
												<option value="부산은행">부산은행</option>
												<option value="광주은행">광주은행</option>
												<option value="경남은행">경남은행</option>
												<option value="전북은행">전북은행</option>
												<option value="제주은행">제주은행</option>
												<option value="농협">농협</option>
												<option value="수협">수협</option>
												<option value="한국산업은행">한국산업은행</option>
												<option value="기업은행">기업은행</option>
												<option value="수출입은행">수출입은행</option>
												<option value="신협">신협</option>
												<option value="우체국">우체국</option>
												<option value="새마을금고">새마을금고</option>
												<option value="산림조합">산림조합</option>
												<option value="저축은행">저축은행</option>
											</select>
											<input type="text" name="account_number" id="account_number" /> <input type="checkbox" id="useForiegn" onclick="foriegn()" /> 해외송금정보 사용
										</td>
										<? $this->th("예금주"); ?>
										<td class="col-xs-5"><input type="text" name="account_holder" id="account_holder" /></td>
									</tr>
									<tr>
										<? $this->th("합계금액"); ?>
										<td class="col-xs-5">
											<select name='unit' id='unit'>
												<option value='원'>원</option>
												<option value='$'>$</option>
											</select>
											<input type="text" name="total_price" id="total_price" readonly />
										</td>
										<? $this->th("지급조건"); ?>
										<td class="col-xs-5"><input type="text" name="spending_condition" id="spending_condition" /></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
							
					<div class="widget-box widget-color-default" style="margin-top:10px; display:none" id="foriegn">
						<div class="widget-header">
							<h5 class="widget-title bigger lighter">
								<i class="ace-icon fa fa-table green"></i>
								<span style="color:#000; font-weight:bold">해외송금정보</span>
							</h5>
						</div>
						<div class="widget-body">
							<div class="widget-main no-padding">
								<table id="simple-table" class="table  table-bordered table-hover">
									<thead class="thin-border-bottom"></thead>
									<tbody>
										<tr>
											<? $this->th("Company Name"); ?>
											<td class="col-xs-4"><input type="text" class="form-control" name="foreign_nm" id="foreign_nm" /></td>
											<? $this->th("Company Address"); ?>
											<td class="col-xs-4"><input type="text" class="form-control" name="foreign_address" id="foreign_address" /></td>
										</tr>
										<tr>
											<? $this->th("Company Phone NO."); ?>
											<td class="col-xs-4"><input type="text" class="form-control" name="foreign_phone" id="foreign_phone" /></td>
											<? $this->th("Bank Name"); ?>
											<td class="col-xs-4"><input type="text" class="form-control" name="foreign_bank" id="foreign_bank" /></td>
										</tr>
										<tr>
											<? $this->th("Bank Branch"); ?>
											<td class="col-xs-4"><input type="text" class="form-control" name="foreign_bank_branch" id="foreign_bank_branch" /></td>
											<? $this->th("Account No"); ?>
											<td class="col-xs-4"><input type="text" class="form-control" name="foreign_account" id="foreign_account" /></td>
										</tr>
										<tr>
											<? $this->th("SWIFT BIC CODE"); ?>
											<td class="col-xs-10" colspan="3"><input type="text" class="form-control" name="foreign_swift_bic_cd" id="foreign_swift_bic_cd" /></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="widget-box widget-color-default" style="margin-top:10px">
						<div class="widget-header">
							<h5 class="widget-title bigger orange">
								<i class="ace-icon fa fa-table"></i>
								<span style="color:#000; font-weight:bold">지출항목</span> <input type="button" class="btn btn-xs btn-danger" value="항목추가" onclick="addTr()" />
							</h5>
						</div>
						<div class="widget-body">
							<div class="widget-main no-padding">
								<? $this->table("item_tb", "계정과목=>1,지출일=>1,지출내용=>3,금액=>1,공급가액=>1,부가세=>1,첨부파일=>4"); ?>
							</div>
						</div>
					</div>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button class="btn btn-sm btn-info" type="button" id="btnSubmit">
						<i class="ace-icon fa fa-check bigger-110"></i>
						<span id="btnSubmitTxt">지출결의서등록</span>
					</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="viewModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:1400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">지출결의서</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:700px; overflow:scroll; overflow-x:hidden">
				<!-- 테이블 -->
				<div class="widget-box widget-color-default">
					<div class="widget-header">
						<h5 class="widget-title bigger lighter">
							<i class="ace-icon fa fa-table blue"></i>
							<span style="color:#000; font-weight:bold">문서정보</span>
						</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<? $this->th("문서번호","red"); ?>
									<td class="col-xs-11" colspan="5"><span id="vspending_cd"></span></td>
								</tr>
								<tr>
									<? $this->th("부서"); ?>
									<td class="col-xs-3"><span id="vmiddle_department"></span>-<span id="vsmall_department"></span>
									</td>
									<? $this->th("담당자"); ?>
									<td class="col-xs-3"><span id="vemp_nm"></span></td>
									<? $this->th("기안일"); ?>
									<td class="col-xs-3"><span id="vdraft_dt"></span></td>
								</tr>
							</table>
						</div>
					</div>
				</div>

				<div class="widget-box widget-color-default" style="margin-top:10px">
					<div class="widget-header">
						<h5 class="widget-title bigger lighter pink">
							<i class="ace-icon fa fa-table"></i>
							<span style="color:#000; font-weight:bold">거래처정보</span>
						</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<? $this->th("제목","red"); ?>
									<td class="col-xs-5"><span id="vtitle"></span></td>
									<? $this->th("지급예정일"); ?>
									<td class="col-xs-5"><span id="vspending_dt"></span></td>
								</tr>
								<tr>
									<? $this->th("거래처"); ?>
									<td class="col-xs-11" colspan="3"><span id="vaccount_nm"></span></td>
								</tr>
								<tr>
									<? $this->th("계좌번호(은행)"); ?>
									<td class="col-xs-5">[<span id="vbank"></span>] <span id="vaccount_number"></span></td>
									<? $this->th("예금주"); ?>
									<td class="col-xs-5"><span id="vaccount_holder"></span></td>
								</tr>
								<tr>
									<? $this->th("합계금액"); ?>
									<td class="col-xs-5"><span id="vtotal_price"></span> <span id="vunit"></span></td>
									<? $this->th("지급조건"); ?>
									<td class="col-xs-5"><span id="vspending_condition"></span></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
						
				<div class="widget-box widget-color-default" style="margin-top:10px; display:none" id="vforiegn">
					<div class="widget-header">
						<h5 class="widget-title bigger lighter">
							<i class="ace-icon fa fa-table green"></i>
							<span style="color:#000; font-weight:bold">해외송금정보</span>
						</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="simple-table" class="table table-bordered table-hover">
								<thead class="thin-border-bottom"></thead>
								<tbody>
									<tr>
										<? $this->th("Company Name"); ?>
										<td class="col-xs-4"><span id="vforeign_nm"></span></td>
										<? $this->th("Company Address"); ?>
										<td class="col-xs-4"><span id="vforeign_address"></span></td>
									</tr>
									<tr>
										<? $this->th("Company Phone NO."); ?>
										<td class="col-xs-4"><span id="vforeign_phone"></span></td>
										<? $this->th("Bank Name"); ?>
										<td class="col-xs-4"><span id="vforeign_bank"></span></td>
									</tr>
									<tr>
										<? $this->th("Bank Branch"); ?>
										<td class="col-xs-4"><span id="vforeign_bank_branch"></span></td>
										<? $this->th("Account No"); ?>
										<td class="col-xs-4"><span id="vforeign_account"></span></td>
									</tr>
									<tr>
										<? $this->th("SWIFT BIC CODE"); ?>
										<td class="col-xs-10" colspan="3"><span id="vforeign_swift_bic_cd"></span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="widget-box widget-color-default" style="margin-top:10px">
					<div class="widget-header">
						<h5 class="widget-title bigger orange">
							<i class="ace-icon fa fa-table"></i>
							<span style="color:#000; font-weight:bold">지출항목</span>
						</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<? $this->noCheckTable("view_tb", "계정과목=>1,지출일=>1,지출내용=>3,금액=>1,공급가액=>1,부가세=>1,첨부파일=>4"); ?>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="accountSubjectModal" data-backdrop="static" data-keyboard="false">
	<style>{ list-style:none; }</style>
	<div class="modal-dialog" style="width:500px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#f58d4e">
				<span style="font-weight:bold; color:#fff; font-size:14pt">계정과목</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:510px">
				<ul style='list-style:none;'>
					<?
					$sql = "select * from account_subject";
					$this->query($sql);
					if($this->get_rows() > 0) display_children('',0); 
					?>
				</ul>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="16" />
<input type="hidden" name="account_where" id="account_where" />
<input type="hidden" name="account_page" id="account_page" value="1" />
<input type="hidden" name="select_flag" id="select_flag" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
require_once ("views/modal/accountModal.php");
?>

<script>
// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

//==================================================
// 선택된 품목 테이블 선택된 TR 색상 바꾸기
//==================================================
function toggle(it) {
	$("#tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

//콤마찍기
function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

//콤마풀기
function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

function inputNumberFormat(obj) {
    obj.value = comma(uncomma(obj.value));
}

$(document).ready(function(){
	var page = $("#page").val();
	createSpendingCode();
	getData(page);
	getAccountList(1);
	nokids();

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

	// 검사항목 등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			event.preventDefault();
			var form = $('#frm')[0];
			var data = new FormData(form);
			data.append("CustomField", "This is some extra data, testing");

			$("#btnSubmit").prop("disabled", true);


			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "ajax.php",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 5000,
				success: function (data) {
					getData(1);
					formClear();
					hideModal('registModal');
					$("#btnSubmitTxt").text("지출결의서등록");
					$("#btnSubmit").prop("disabled", false);

				},
				error: function (e) {
					$("#btnSubmit").prop("disabled", false);

				}
			});
		}
	});
});

// 지출결의서 보기
function viewModal(uid){
	var parameter = {"mode" : "getSpendingResolution", "uid" : uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#uid").html(json.uid); 
			$("#vspending_cd").html(json.spending_cd);
			$("#vmiddle_department").html(json.middle_department_nm)
			$("#vsmall_department").html(json.small_department_nm);
			$("#vemp_nm").html(json.emp_nm);
			$("#vdraft_dt").html(json.draft_dt);
			$("#vtitle").html(json.title);
			$("#vspending_dt").html(json.spending_dt);
			$("#vaccount_nm").html(json.account_nm);
			$("#vbank").html(json.bank);
			$("#vaccount_number").html(json.account);
			$("#vaccount_holder").html(json.account_holder);
			$("#vunit").html(json.unit);
			$("#vtotal_price").html(comma(json.total_price));
			$("#vspending_condition").html(json.spending_condition);

			$("#vforeign_nm").html(json.foreign_nm);
			$("#vforeign_address").html(json.foreign_address);
			$("#vforeign_phone").html(json.foreign_phone);
			$("#vforeign_bank").html(json.foreign_bank);
			$("#vforeign_bank_branch").html(json.foreign_bank_branch);
			$("#vforeign_account").html(json.foreign_account);
			$("#vforeign_swift_bic_cd").html(json.foreign_swift_bic_cd);

			if(json.foreign_nm != "") $("#vforiegn").css("display","block");
			else $("#vforiegn").css("display","none");
			
			var tag = "";
			var parameter = {"mode" : "getSpendingResolutionData", "fid" : uid};
			$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
				if(json != null) {
					for (var i = 0 ; i < json.length ; i++)
					{
						tag += "<tr>";
						tag += "<td>" + json[i].account_subject + "</td>";
						tag += "<td>" + json[i].expense_dt + "</td>";
						tag += "<td>" + json[i].expense_memo + "</td>";
						tag += "<td>" + json[i].cost + "</td>";
						tag += "<td>" + json[i].supply_cost + "</td>";
						tag += "<td>" + json[i].tax + "</td>";
						tag += "<td>" + json[i].attach + "</td>";
						tag += "</tr>";
					}
				} else {

				}

				$("#view_tb tbody").html(tag);
			});
		}

		showModal('viewModal');
	});
}

// 지출결의서 수정
function modifyModal(uid){
	$("#uid").val(uid);
	$("#btnSubmitTxt").text("지출결의서수정");

	var parameter = {"mode" : "getSpendingResolution", "uid" : uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#id").val(json.uid); 
			$("#spending_cd").val(json.spending_cd);
			$("#middle_department_cd").val(json.middle_department_cd)
			$("#small_department_cd").val(json.small_department_cd);
			$("#emp_id").val(json.emp_id);
			$("#emp_nm").val(json.emp_nm);
			$("#draft_dt").val(json.draft_dt);
			$("#title").val(json.title);
			$("#spending_dt").val(json.spending_dt);
			$("#account_cd").val(json.account_cd);
			$("#account_nm").val(json.account_nm);
			$("#bank").val(json.bank);
			$("#account_number").val(json.account);
			$("#account_holder").val(json.account_holder);
			$("#unit").val(json.unit);
			$("#total_price").val(comma(json.total_price));
			$("#spending_condition").val(json.spending_condtion);
			$("#foreign_nm").val(json.foreign_nm);
			$("#foreign_address").val(json.foreign_address);
			$("#foreign_phone").val(json.foreign_phone);
			$("#foreign_bank").val(json.foreign_bank);
			$("#foreign_bank_branch").val(json.foreign_bank_branch);
			$("#foreign_account").val(json.foreign_account);
			$("#foreign_swift_bic_cd").val(json.foreign_swift_bic_cd);

			if(json.foreign_nm != "") $("#foriegn").css("display","block");
			else $("#foriegn").css("display","none");
			
			var tag = "";
			var flag = 0;
			var parameter = {"mode" : "getSpendingResolutionData", "fid" : uid};
			$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
				if(json != null) {
					for (var i = 0 ; i < json.length ; i++)
					{
						tag += "<tr>";
						tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
						tag += "<td><input type='hidden' name='account_uid[]' id='account_uid_" + flag + "' value='" + json[i].account_uid + "' /><input type='text' name='account_subject[]' id='account_subject_" + flag + "'  value='" + json[i].account_subject + "' onclick=\"viewAccountSubject(" + flag + ")\" style='width:150px' /></td>";
						tag += "<td>";
						tag += "<span class='input-icon input-icon-right'>";
						tag += "<div class='input-group'>";
						tag += "<input class=' date-picker' name='expense_dt[]' id='expense_dt' type='text' data-date-format='yyyy-mm-dd' value='" + json[i].expense_dt + "' style='width:150px' />";
						tag += "<span class='input-group-addon'>";
						tag += "<i class='fa fa-calendar bigger-110'></i>";
						tag += "</span>";
						tag += "</div>";
						tag += "</span>";
						tag += "</td>";
						tag += "<td><input type='text' class='expense_memo' name='expense_memo[]' id='expense_memo' value='" + json[i].expense_memo + "' /></td>";
						tag += "<td><input type='text' class='cost' name='cost[]' id='cost_" + flag + "' onkeyup='calculation(" + flag + ")' value='" + json[i].cost + "' style='width:120px' /></td>";
						tag += "<td><input type='text' class='supply_cost' name='supply_cost[]' id='supply_cost_" + flag + "' value='" + json[i].supply_cost + "' style='width:120px' /></td>";
						tag += "<td><input type='text' class='tax' name='tax[]' id='tax_" + flag + "' value='" + json[i].tax + "' style='width:120px' /></td>";
						//tag += "<td><?=$payment?></td>";
						//tag += "<td><input type='hidden' name='doc_type' id='doc_type_" + flag + "' /><input type='text' name='memo[]' id='memo_" + flag +"' onclick=\"centerOpenWindow('openpop.php?popup=p_documentSelect&flag=" + flag + "', '거래처리스트', 1200, 600)\" /></td>";
						tag += "<td>";
						
						if(json[i].attach != "none" && json[i].attach != "") {
							tag += "<div>" + json[i].attach + "</div>";
						}
						tag += "<input type='file' name='attach[]' id='attach' /></td>";
						tag += "</tr>";

						flag++;
						$("#flag").val(flag);
					}
				} else {

				}

				$("#item_tb tbody").html(tag);
			});
		}

		showModal('registModal');
	});
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#uid").val("");
	$("#flag").val("KB국민은행");
	$("#item_tb tbody").html("");
	$("#frm")[0].reset();
}

//==================================================
// 문서번호 생성
//==================================================
function createSpendingCode(){
	var parameter = {"mode" : "createSpendingCode"};
	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		success : function(str) {
			$("#spending_cd").val(str);
		}
	});
}

//==================================================
//
//==================================================
function foriegn() {
	if($('input:checkbox[id="useForiegn"]').is(":checked") == true) {
		$("#foriegn").css("display","block");
		$("#unit").val("$");
		$("#bank").attr("disabled",true);
		$("#account_number").attr("disabled",true);
		$("#account_holder").attr("disabled",true);
	} else {
		$("#foriegn").css("display","none");
		$("#unit").val("원");
		$("#bank").attr("disabled",false);
		$("#account_number").attr("disabled",false);
		$("#account_holder").attr("disabled",false);
	}
}

//==================================================
// 선택한 중부서 처리
//==================================================
function postMiddleDepartment(uid){
	$("#middle_uid").val(uid);
	getSmallDepartment();
}

//==================================================
// 선택한 소부서 처리
//==================================================
function postSmallDepartment(uid){
	$("#small_uid").val(uid);
}

//==================================================
// 중부서 가져오기
//==================================================
function getMiddleDepartment(){
	var tag = "<option value='0'>부서선택</option>";
	var parameter = {"mode" : "getMiddleDepartment", "fid" : $("#big_uid").val()};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
<?
if($_SESSION['middle_department'] != "") {
?>
					if(json[i].uid == <?=$_SESSION['middle_department']?>) var sel = "selected"; else var sel = "";
					tag += "<option value='" + json[i].uid + "' " + sel + ">" + json[i].department_nm + "</option>";
<?
} else {
?>
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
<?
}
?>
				}
			}

			$("#middle_department_cd").html(tag);
		}
	);
}

//==================================================
// 소부서 가져오기
//==================================================
function getSmallDepartment(){
	var tag = "<option value='0'>부서선택</option>";
	var parameter = {"mode" : "getSmallDepartment", "fid" : $("#middle_uid").val()};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
<?
if($_SESSION['small_department'] != "") {
?>
					if(json[i].uid == <?=$_SESSION['small_department']?>) var sel = "selected"; else var sel = "";
					tag += "<option value='" + json[i].uid + "' " + sel + ">" + json[i].department_nm + "</option>";
<?
} else {
?>
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
<?
}
?>
				}
			}
			$("#small_department_cd").html(tag);
		}
	);
}

//==================================================
// 모달삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("spending_resolution");
	hideModal("confirm-delete");
}

//==================================================
// 지출결의서 리스트 가져오기
//==================================================
function getData(page) {
	var tag = "";
	var parameter = {"mode" : "getSpendingResolutionList", "page" : page, "rpp" : $("#per").val(), "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++) {
					tag += "<tr onclick=\"toggle(this);\" style='cursor:pointer'>";

					tag += "<td><a href='#' onclick=\"viewModal(" + json[i].uid + ")\">" + json[i].spending_cd + "</a></td>";
					tag += "<td><a href='#' onclick=\"viewModal(" + json[i].uid + ")\">" + json[i].title + "</a></td>";
					tag += "<td><a href='#' onclick=\"viewModal(" + json[i].uid + ")\">" + json[i].emp_nm + "</a></td>";
					tag += "<td><a href='#' onclick=\"viewModal(" + json[i].uid + ")\">" + json[i].draft_dt + "</a></td>";
					
					tag += "<td><a href='#' onclick=\"viewModal(" + json[i].uid + ")\">" + json[i].total_price + "</a></td>";

					if(json[i].approval == "n") var approval = "미결"; else var approval = "승인";

					tag += "<td><a href='#' onclick=\"viewModal(" + json[i].uid + ")\">" + approval + "</a></td>";
					tag += "<td>";
					tag += "<input type='button' class='btn btn-xs btn-success' value='수정' onclick='modifyModal(" + json[i].uid + ")' />";
					<?
					if($_SESSION['login_level'] >= 99) {
					?>
						tag += "<input type='button' class='btn btn-xs btn-danger' value='삭제' onclick='deleteSpendingResolution(" + json[i].uid + ")' />";
					<?
					}
					?>
					tag += "</td>";					
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='8' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}


			$("#tb tbody").html(tag);

			var table = "spending_resolution";
			var where = "";

			getPaging(table, $("#where").val(), $("#per").val(), 4);
		}
	);
}

function deleteSpendingResolution(uid){
	var parameter = {"mode" : "deleteSpendingResolution", "uid" : uid};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str){
			if(str == "success"){
				getData(1);
			}
		}
	});
}
//==================================================
// 줄 추가
//==================================================
function addTr() {
	var flag = $("#flag").val();

	var tag = "<tr>";
	tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
	tag += "<td><input type='hidden' name='account_uid[]' id='account_uid_" + flag + "' /><input type='text' name='account_subject[]' id='account_subject_" + flag + "'  onclick=\"viewAccountSubject(" + flag + ")\" style='width:150px' /></td>";
	tag += "<td>";
	tag += "<span class='input-icon input-icon-right'>";
	tag += "<div class='input-group'>";
	tag += "<input class=' date-picker' name='expense_dt[]' id='expense_dt' type='text' data-date-format='yyyy-mm-dd' value='<?=date('Y-m-d')?>' style='width:150px' />";
	tag += "<span class='input-group-addon'>";
	tag += "<i class='fa fa-calendar bigger-110'></i>";
	tag += "</span>";
	tag += "</div>";
	tag += "</span>";
	tag += "</td>";
	tag += "<td><input type='text' class='expense_memo' name='expense_memo[]' id='expense_memo' /></td>";
	tag += "<td><input type='text' class='cost' name='cost[]' id='cost_" + flag + "' onkeyup='calculation(" + flag + ")' style='width:120px' /></td>";
	tag += "<td><input type='text' class='supply_cost' name='supply_cost[]' id='supply_cost_" + flag + "' style='width:120px' /></td>";
	tag += "<td><input type='text' class='tax' name='tax[]' id='tax_" + flag + "' style='width:120px' /></td>";
	//tag += "<td><?=$payment?></td>";
	//tag += "<td><input type='hidden' name='doc_type' id='doc_type_" + flag + "' /><input type='text' name='memo[]' id='memo_" + flag +"' onclick=\"centerOpenWindow('openpop.php?popup=p_documentSelect&flag=" + flag + "', '거래처리스트', 1200, 600)\" /></td>";
	tag += "<td><input type='file' name='attach[]' id='attach' /></td>";
	tag += "</tr>";

	$("#item_tb").append(tag);
	var newFlag = Number(flag) + 1;
	$("#flag").val(newFlag);

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
}

// 계정과목 모달창
function viewAccountSubject(flag) {
	$("#select_flag").val(flag);
	showModal('accountSubjectModal');
}

// 계정과목 처리
function nokids(){
	var kidnot;
	kidnot = new Array();

	<?php
	for($i=0; $i<count($no_children); $i++){ 
		print("kidnot.push(\"".$no_children[$i]."\");\n");
	}
	?>

	for(i in kidnot){
		var theid;
		theid = kidnot[i];
		document.getElementById(kidnot[i]).style.color = "green";
	}
}

// 계정과목 디스플레이
function show(subCategory, path){
	var thesub;
	var theimage;
	var imageid;
	var testingdiv;

	thesub = document.getElementById(subCategory);

	imageid = "img_"+subCategory;
	theimage = document.getElementById(imageid);

	testingdiv = document.getElementById("testing");

	if(thesub.style.display == 'block'){
		thesub.style.display = 'none';
		theimage.src = path+'/assets/images/tree/c.gif';
	}else{
		thesub.style.display = 'block';
		theimage.src = path+'/assets/images/tree/e.gif';
	}
}

// 계정과목 붙이기
function postAccountSubject(subject, account_uid) {
	var flag = $("#select_flag").val();
	$("#account_uid_" + flag).val(account_uid);
	$("#account_subject_" + flag).val(subject);
}

//==================================================
// 선택 거래처 처리
//==================================================
function postAccount(account_cd, account_nm) {
	$("#account_cd").val(account_cd);
	$("#account_nm").val(account_nm);
	hideModal("accountModal");
}

//==================================================
// 공급가액 계산
//==================================================
function calculation(flag) {
	if($('input:checkbox[id="useForiegn"]').is(":checked") == true) {

	} else {
		var cost = $("#cost_" + flag).val();
		var supply_cost = cost/1.1;
		var tax = cost-supply_cost;
		//$("#cost_" + flag).val(commaSplit(cost));
		$("#supply_cost_" + flag).val(commaSplit(Math.round(supply_cost)));
		$("#tax_" + flag).val(commaSplit(Math.round(tax)));
	}
	total_calculation();
}

//==================================================
// 합계금액 계산
//==================================================
function total_calculation() {
	var total = 0;
	$(".cost").each(function(){
		var cost = $(this).val();
		total = Number(total) + Number(cost);
	});
	$("#total_price").val(commaSplit(total));
}

//==================================================
// 결재상태값에 의한 지출결의서 가져오기
//==================================================
function getState(value) {
	switch(value) {
		case "all" :
			$("#where").val("");
		break;

		case "n" :
			$("#where").val(" where approval='n'");
		break;

		case "y" :
			$("#where").val(" where approval='y'");
		break;
	}

	getData(1);

}

//==================================================
// 검색
//==================================================
function search() {
	var txt = $("#search_txt").val();
	$("#where").val("where title like '%" + txt + "%'");
	getData(1);
}

//==================================================
// 줄 지우기
//==================================================
function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#flag").val(nextFlag);
}


//==================================================
// 콤마 나누기
//==================================================
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
</script>