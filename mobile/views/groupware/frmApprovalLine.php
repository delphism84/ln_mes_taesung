<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">			
			<div>					
				<div>
					<form name="frm" id="frm">
						
						<input type="hidden" name="mode" id="mode" value="registApprovalLine" />
						<input type="hidden" name="uid" id="uid" />
						<!--
						<input type="button" class="btn btn-xs" value="결재라인명" style="margin-bottom:4px"/><input type="text" name="line_nm" id="line_nm" validation="yes" err="결재라인명명을 입력하세요" />
						
						<input type="button" class="btn btn-xs btn-inverse" id="btnSubmit" value="생성 및 수정" style="margin-bottom:4px" />
						<input type="button" class="btn btn-xs btn-success" value="새로고침" onclick="formClear()" />
						-->
						
					</form>
				</div>
				
				<div>					
					<div class="col-xs-12">
						<div>
							<input type="button" class="btn btn-xs btn-pink" value="결재라인" />
							<!--
							<button type="button" class="btn btn-purple btn-xs">
								<span class="ace-icon fa fa-plus icon-on-right bigger-110"></span>
							</button>
							-->
						</div>
						<!--
						<div style="float:right"><input type="button" class="btn btn-xs btn-danger" value="결재라인 선택삭제" data-toggle="modal" data-target="#confirm-delete" /></div>
						-->
						<? $this->NoChecktable("line_tb","결재라인명"); ?>
					</div>
					
					<!--
					<div class="col-xs-12">
						<div style="float:left"><input type="button" class="btn btn-xs btn-pink" value="사원리스트" /></div>
					-->
						<!--
						<div style="float:right"><input type="button" class="btn btn-xs btn-info" value="선택사원 결재라인으로 등록" onclick="moveLine()" /></div>
						-->
						<? //$this->table2("tb","사원번호=>2,사원명=>2,성별=>1,부서=>3,직급=>2,휴대전화=>2"); ?>
						<? //$this->paging() ?>
					<!--
					</div>
					-->
					<!--
					<div class="col-xs-12">
						<div style="float:left"><input type="button" class="btn btn-xs btn-pink" value="결재라인 사원리스트" /></div>
					-->
						<!--<div style="float:right"><input type="button" class="btn btn-xs btn-danger" value="선택 사원 결재라인에서 제외" onclick="removeApprovalLine()" /></div>-->
						<?// $this->table3("team_tb","사원번호=>2,사원명=>2,성별=>1,부서=>3,직급=>2,휴대전화=>2"); ?>
					<!--
					</div>
					-->

				</div>
			</div>			
		</div>
	</div>
</div>

<!--결재라인 사원리스트 MODAL-->
<div class="modal fade" id="viewApprovalLineMemberModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">결재라인 사원리스트</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="">
				<div class="col-xs-12">
					<div style="float:left">
					<!--<div style="float:right"><input type="button" class="btn btn-xs btn-danger" value="선택 사원 결재라인에서 제외" onclick="removeApprovalLine()" /></div>-->
					<? $this->NoCheckTable("team_tb","사원번호=>2,사원명=>2,휴대전화=>3"); ?>
				</div>
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

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
// $(document).keypress(function(e) {
// 	if(e.which === 13) registTeam();
// });

$(document).ready(function(){
	// 특수문자 입력 방지
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	
	getApprovalLineList();
	getData(1);

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

	$("#checkedAll2").click(function(){
		if($("#checkedAll2").prop('checked')) {
			$(".chk2").each(function(){
				$(this).prop("checked",true);
			});
		} else {
			$(".chk2").each(function(){
				$(this).prop("checked",false);
			});
		}
	});

	$("#checkedAll3").click(function(){
		if($("#checkedAll3").prop('checked')) {
			$(".chk2").each(function(){
				$(this).prop("checked",true);
			});
		} else {
			$(".chk2").each(function(){
				$(this).prop("checked",false);
			});
		}
	});

	// 등록
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
					getApprovalLineList();
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
// 결재라인으로 이동
//==================================================
function moveLine() {
	$(".chk2").each(function(){
		if($(this).prop('checked')) {
			var new_uid = $("#check_uids2").val() + "," + $(this).val();
			$("#check_uids2").val(new_uid);
		}
	});
	
	if($("#check_uids2").val() == "") {
		showAlert("등록할 사원을 선택하세요");
		return;
	}

	var parameter = {"mode" : "moveApprovalLine", "uid" : $("#uid").val(), "uids" : $("#check_uids2").val()};
	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		async : false,
		success : function(){
			$("#checkedAll2").prop('checked',false);
			getApprovalLineMemberList();
		}
	});
}

//==================================================
// 팀원 제외
//==================================================
function removeApprovalLine() {
	$(".chk3").each(function(){
		if($(this).prop('checked')) {
			var new_uid = $("#check_uids3").val() + "," + $(this).val();
			$("#check_uids3").val(new_uid);
		}
	});
	
	if($("#check_uids3").val() == "") {
		showAlert("제외할 사원을 선택하세요");
		return;
	}

	var parameter = {"mode" : "removeApprovalLine", "uids" : $("#check_uids3").val()};
	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		async : false,
		success : function(){
			$("#checkedAll3").prop('checked',false);
			getApprovalLineMemberList();
		}
	});
}

//==================================================
// 팀원 리스트 가져오기
//==================================================
function getApprovalLineMemberList(){
	var tag = "";
	var parameter = {"mode" : "getApprovalLineMemberList", "uid" : $("#uid").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					/*
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk3' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					*/
					tag += "<td>" + json[i].emp_cd + "</td>";
					tag += "<td>" + json[i].emp_nm + "</td>";
					//tag += "<td>" + json[i].gender + "</td>";
					//tag += "<td>" + json[i].department + "</td>";
					//tag += "<td>" + json[i].position + "</td>";
					tag += "<td>" + json[i].mobile + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#team_tb tbody").html(tag);
			showModal('viewApprovalLineMemberModal');
		}
	);
}

//==================================================
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("approval_line");
	getApprovalLineList();
	hideModal("confirm-delete");
	$("#uid").val("");
}

//==================================================
// 결재라인 가져오기
//==================================================
function getApprovalLineList(){
	var tag = "";
	var parameter = {"mode" : "getApprovalLineList"};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr onclick=\"toggle(this); postUid(" + json[i].uid + ", '" + json[i].line_nm + "')\" style='cursor:pointer'>";
					/*
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					*/
					tag += "<td><a href='#' onclick=\"postLine(" + json[i].uid + ", '" + json[i].line_nm + "')\">" + json[i].line_nm + "</a></td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='2' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}

			$("#line_tb tbody").html(tag);
		}
	);
}

//==================================================
// 선택 팀 처리
//==================================================
function postUid(uid, line_nm) {
	$("#uid").val(uid);
	$("#line_nm").val(line_nm);
	getApprovalLineMemberList();
}

//==================================================
// 상품테이블 선택 아이템 TR 색상 바꾸기
//==================================================
function toggle(it) {
	$("#line_tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

//==================================================
// 사원리스트 가져오기
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getEmployeeList", "rpp" : 7, "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";

					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk2' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>

					tag += "<td>" + json[i].emp_cd + "</td>";
					tag += "<td>" + json[i].emp_nm + "</td>";
					tag += "<td>" + json[i].gender + "</td>";
					tag += "<td>" + json[i].department + "</td>";
					tag += "<td>" + json[i].position_nm + "</td>";
					tag += "<td>" + json[i].mobile + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "employee";
			getPaging(table, $("#where").val(), 7, 4,"setPage");
		}
	);
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#uid").val("");
	$("#frm")[0].reset();
}
</script>