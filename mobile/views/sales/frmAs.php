<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<!-- 검색 모달 -->
		<div class="wrap_search_pop">	
			<div class="search_pop_content">
				<div class="input-group">
					<div class="col-xs-12">
						<select name="set_data" id="set_data" onchange="setData(this.value)" style="float:left; height:35px; width:100%; margin-bottom:10px;">
							<option value="0">== 진행상태 ==</div>
							<option value="접수">접수</option>
							<option value="처리중">처리중</option>
							<option value="처리완료">처리완료</option>
						</select>
						<? $this->periodSearch("searchDate()","접수일자검색"); ?>
						<select name="search_classify" id="search_classify" style="height:35px; width:100%; margin-top:10px;">
							<option value="0">== 검색구분 ==</option>
							<option value="item_cd">품번</option>
							<option value="item_nm">품명</option>
							<option value="account_nm">거래처</option>
						</select>					
						<input type="text" name="search_txt" id="search_txt" class="search_input"/>
						<input type="button" class="search_btn" onclick="search()" value="검색"/>
						<button type="button" class="search_refresh" onclick="refresh()">
							<span class="fa fa-refresh icon-on-right bigger-110"></span>
						</button>
					</div>							
				</div>		
			</div>	
		</div>
		<!-- //검색 모달 -->
		<div class="page-content">
			<div class="row" style="border:none; margin:0; paddong:0;">				
				<div>
					<div class="col-xs-12">
						<input type='button' class='comm_title' value='AS 요청리스트' />
						<table class="table table-bordered table-striped" id="tb">
							<thead>
								<tr>
									<th class="detail-col center">
										접수일자
									</th>
									<th class="detail-col center">
										품목명
									</th>
									<th class="detail-col center">
										진행상태
									</th>									
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>

						<?
						$this->paging();	
						?>
					</div>
					<!--
					<div class="col-xs-12" style="border:1px solid #ccc; height:100%; overflow: scroll; overflow-x: hidden; padding-top:10px">
						<div>
							<form name="frm" id="frm">
								<input type="hidden" name="uid" id="uid" />
								<input type="hidden" name="mode" id="mode" value="registAs" />								
								<a class="btn btn-xs btn-pink" onclick="addTr()">접수정보</a>
								<table id="simple-table" class="table  table-bordered table-hover">
									<tr>								
										<? $this->th("접수일자","red"); ?>
										<td>
											<div>
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input class=" date-picker" name="accept_dt" id="accept_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="접수일자를 입력하세요" value="<?=date("Y-m-d")?>" />
														<span class="input-group-addon">
															<i class="fa fa-calendar bigger-110"></i>
														</span>
													</div>
												</span>
											</div>
										</td>
										<? $this->th("진행상태"); ?>
										<td>
											<select name="state" id="state">
												<option value="접수">접수</option>
												<option value="처리중">처리중</option>
												<option value="처리완료">처리완료</option>
											</select>
										</td>
									</tr>
									<tr>
										<? $this->th("거래처명","red"); ?>
										<td>
											<div class="input-group">
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input type="hidden" name="account_cd" id="account_cd" validation="yes" err="거래처를 입력하세요" readonly />
														<input type="text" name="account_nm" id="account_nm" onclick="showModal('accountModal')" readonly />
														<span class="input-group-addon btn-purple" onclick="showModal('accountModal')">
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
														</span>
													</div>
												</span>
											</div>
										</td>
										<? $this->th("거래처담당자","red"); ?>
										<td>
											<input type="text" name="account_manager" id="account_manager" validation="yes" err="거래처담당자를 입력하세요" />
										</td>
									</tr>
									<tr>
										<? $this->th("이메일","red"); ?>
										<td><input type="text" class="form-control" name="email" id="email" validation="yes" err="이메일을 입력하세요" /></td>
										<? $this->th("연락처","red"); ?>
										<td><input type="text" name="phone" id="phone" validation="yes" err="연락처를 입력하세요" /></td>
									</tr>
								</table>
								
								<a class="btn btn-xs btn-pink" onclick="addTr()">AS정보</a>
								<table id="simple-table" class="table  table-bordered table-hover">
									<tr>
										<? $this->th("품목","red"); ?>
										<td>
											<div class="input-group">
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input type="hidden" name="item_cd" id="item_cd" validation="yes" err="품목을 입력하세요" readonly />
														<input type="text" name="item_nm" id="item_nm" onclick="showModal('itemModal')" readonly />
														<span class="input-group-addon btn-purple" onclick="showModal('itemModal')">
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
														</span>
													</div>
												</span>
											</div>
										</td>
										<? $this->th("불량구분"); ?>
										<td>
											<select name="faulty" id="faulty">
												<option value="파손">파손</option>
												<option value="분실">분실</option>
												<option value="에러">에러</option>
												<option value="하자">하자</option>
												<option value="변심">변심</option>
												<option value="기타">기타</option>
											</select>
										</td>
									</tr>
									<tr>
										<? $this->th("상세내용","red"); ?>
										<td>
											<textarea class="form-control" rows="5" name="memo" id="memo" validation="yes" err="상세내용을 입력하세요"></textarea>
										</td>
										<? $this->th("처리결과"); ?>
										<td>
											<textarea class="form-control" rows="5" name="as_result" id="as_result"></textarea>
										</td>
									</tr>
									<tr>
										<? $this->th("처리방법"); ?>
										<td>
											<select name="processing" id="processing">
												<option value="재설치">재설치</option>
												<option value="교환">교환</option>
												<option value="방문처리">방문처리</option>
												<option value="전화">전화</option>
												<option value="원격">원격</option>
												<option value="기타">기타</option>
											</select>
										</td>
										<? $this->th("처리비용"); ?>
										<td>
											<input type="text" name="processing_cost" id="processing_cost" />
										</td>
									</tr>
									<tr>
										<? $this->th("처리담당자","red"); ?>
										<td colspan="3">
											<div class="input-group">
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input type="hidden" name="emp_id" id="emp_id" readonly />
														<input type="text" name="emp_nm" id="emp_nm" readonly onclick="showModal('employeeModal')" />
														<span class="input-group-addon btn-purple" onclick="showModal('employeeModal')">
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
														</span>
													</div>
												</span>
											</div>
										</td>
									</tr>
								</table>
							</form>
							<div style="text-align:center">
								<button class="btn btn-info" type="button" id="btnSubmit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									<span id="btnSubmitTxt">AS수정</span>
								</button>
								<button class="btn btn-default" type="button" onclick="formClear()">
									<i class="ace-icon fa fa-check bigger-110"></i>
									새로고침
								</button>
							</div>
						</div>
					</div>
					-->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 상세보기 -->
<div class="modal fade" id="viewServiceModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">상세보기</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style='height:70%'>
			<!-- 내용 -->
				<form id="frm">
					<input type="hidden" name="mode" id="mode" value="registItem" />
					<input type="hidden" name="uid" id="uid"/>
					<table class="table table-bordered">
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; width:25%"><i class="ace-icon fa fa-caret-right blue"></i>접수일자</th>
							<td><span id="s_accept_dt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>품번</th>
							<td><span id="s_item_cd"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>품목명</th>
							<td><span id="s_item_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>거래처</th>
							<td><span id="s_account_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>담당자</th>
							<td><span id="s_account_manager"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>진행상태</th>
							<td><span id="s_state"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>처리담당자</th>
							<td><span id="s_emp_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>등록일</th>
							<td><span id="s_create_dt"></span></td>
						</tr>
					</table>

				</form>
			<!-- 내용 -->
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">					
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="16" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
require_once ("views/modal/accountModal.php");
require_once ("views/modal/itemModal.php");
require_once ("views/modal/employeeModal.php");
?>

<script>
function refresh() {
	$("#set_data").val(0);
	$("#search_classify").val(0);
	$("#search_txt").val("");
	$("#page").val(1);
	$("#where").val("");
	formClear();
	getData(1);
}
//==================================================
// 날짜별로 데이터 가져오기
//==================================================
function searchDate() {
	var first = $("#start_dt").val();
	var second = $("#end_dt").val();
	if(parseInt(first.replace(/-/g,""),10) > parseInt(second.replace(/-/g,""),10)){
		showAlert("검색 시작일이 검색 종료일 보다 미래일 수 없습니다");
		return;
	}

	var txt = "where (date(create_dt) between '" + first + "' and '" + second + "')";
	$("#where").val(txt);
	getData(1);
}

function account_refresh() {
	$("#account_search_txt").val("");
	$("#account_where").val("");
	$("#account_page").val(1);
	getAccountList();
}

function item_refresh() {
	$("#item_search_choice").val(0);
	$("#item_search_txt").val("");
	$("#item_where").val("");
	$("#item_page").val(1);
	getItemList();
}

// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );


	var page = $("#page").val();
	getData(page);

	getAccountList();
	getItemList();
	getEmployeeList();

	$("#item_classify").on('change', function() {
		if($("#item_classify option:selected").val() == 0) {
			$("#search_txt").val("");
			$("#where").val("");
			getData(1);
		}
	});

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

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			//stop submit the form, we will post it manually.
			event.preventDefault();

			// Get form
			var form = $('#frm')[0];

			// Create an FormData object
			var data = new FormData(form);

			// If you want to add an extra field for the FormData
			data.append("CustomField", "This is some extra data, testing");

			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "ajax.php",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					getData(1);
					formClear();
					$("#btnSubmit").prop("disabled", false);

				},
				error: function (e) {
					$("#btnSubmit").prop("disabled", false);

				}
			});
		}
	});
});


//==================================================
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("after_service");
	hideModal("confirm-delete");
	formClear();
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#uid").val("");
	$("#btnSubmitTxt").text("AS 등록");
}

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

//==================================================
// AS 리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getAfterServiceList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick='toggle(this); postData(" + json[i].uid + ");' style='cursor:pointer'>";
					/*
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";

					if(json[i].state == "접수") {
						tag += "<label class='pos-rel'>";
						tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
						tag += "<span class='lbl'></span>";
						tag += "</label>";
					}

					tag += "</td>";
					<?}?>
					*/
					tag += "<td>" + json[i].accept_dt + "</td>";
					//tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					//tag += "<td>" + json[i].account_nm + "</td>";
					//tag += "<td>" + json[i].account_manager + "</td>";
					tag += "<td>" + json[i].state + "</td>";
					//tag += "<td>" + json[i].emp_nm + "</td>";
					//tag += "<td>" + json[i].create_dt + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "after_service";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//상세보기
function postData(uid) {
	$("#uid").val(uid);
	var parameter = {"mode" : "getAfterService", "uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#s_accept_dt").html(json.accept_dt);
			$("#s_item_cd").html(json.item_cd);
			$("#s_item_nm").html(json.item_nm);
			$("#s_account_nm").html(json.account_nm);
			$("#s_account_manager").html(json.account_manager);
			$("#s_state").html(json.state);
			$("#s_emp_nm").html(json.emp_nm);
			$("#s_create_dt").html(json.create_dt);
		}
	});
	showModal('viewServiceModal');
	//$("#btnSubmitTxt").text("품목수정");
}

//==================================================
// 선택한 AS 처리
//==================================================
function postAs(uid, accept_dt, state, account_cd, account_nm, account_manager, email, phone, item_cd, item_nm, faulty, memo, as_result, processing, processing_cost, emp_id, emp_nm) {
	$("#uid").val(uid);
	$("#accept_dt").val(accept_dt);
	$("#state").val(state);
	$("#account_cd").val(account_cd);
	$("#account_nm").val(account_nm);
	$("#account_manager").val(account_manager);
	$("#email").val(email);
	$("#phone").val(phone);
	$("#item_cd").val(item_cd);
	$("#item_nm").val(item_nm);
	$("#faulty").val(faulty);
	$("#memo").val(memo);
	$("#as_result").val(as_result);
	$("#processing").val(processing);
	$("#processing_cost").val(processing_cost);
	$("#emp_id").val(emp_id);
	$("#emp_nm").val(emp_nm);
	$("#btnSubmitTxt").text("AS 수정");
}


function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

//==================================================
// 검색
//==================================================
function search(){
	var search_classify = $("#search_classify option:selected").val();
	var search_txt = $("#search_txt").val();
	
	if(search_classify == 0) {
		showAlert("검색구분을 선택하세요");
		return;
	}
	
	if(search_txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#where").val("where " + search_classify + " like '%" + search_txt + "%'");
	getData(1);
}



//==================================================
// 선택 사원 처리
//==================================================
function postEmployee(emp_id, emp_nm) {
	$("#emp_id").val(emp_id);
	$("#emp_nm").val(emp_nm);
	hideModal("employeeModal");
}



//==================================================
// 선택 거래처 처리
//==================================================
function postAccount(account_cd, account_nm) {
	$("#account_cd").val(account_cd);
	$("#account_nm").val(account_nm);
	$("#obtain_account_cd").val(account_cd);
	$("#obtain_account_nm").val(account_nm);
	hideModal("accountModal");
}

//==================================================
// 선택 품목 처리
//==================================================
function postItem(item_cd, item_nm, standard, unit) {
	$("#item_cd").val(item_cd);
	$("#item_nm").val(item_nm);
	$("#standard").val(standard);
	$("#unit").val(unit);
	hideModal("itemModal");
	//$("#sale_price").val(sale_price);
}

//검색
$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1);
	});
});
</script>