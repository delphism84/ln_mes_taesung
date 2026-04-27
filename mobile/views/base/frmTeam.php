<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div>					
						<div class="col-xs-12" >						
							<div style="float:left">
								<input type="button" class="btn btn-xs btn-pink" value="생산팀" />
								<!--
								<button type="button" class="btn btn-success btn-xs" onclick="viewModal('teamModal')">
									<span class="fa fa-plus icon-on-right bigger-110"></span>
								</button>
								-->
							</div>
							<!--
							<div style="float:right"><input type="button" class="btn btn-xs btn-danger" value="선택삭제" data-toggle="modal" data-target="#confirm-delete" /></div>
							-->
							<? $this->table("team_list","생산팀명"); ?>
						</div>
						<!--
						<div class="col-xs-12" style="height:410px; padding-top:10px;">
							<div style="float:left"><input type="button" class="btn btn-xs btn-pink" value="사원리스트" /></div>
							<div style="float:right"><input type="button" class="btn btn-xs btn-info" value="선택사원 생산팀으로 등록" onclick="moveTeam()" /></div>
							<? $this->table2("tb","사원번호=>2,사원명=>2,성별=>1,부서=>3,직급=>2,휴대전화=>2"); ?>
							<? $this->paging() ?>
						</div>
						-->

						<div class="col-xs-12">
							<div style="float:left">
								<input type="button" class="btn btn-xs btn-pink" value="팀원 리스트" />
							</div>
							<!--
							<div style="float:right"><input type="button" class="btn btn-xs btn-danger" value="선택 사원 팀원에서 제외" onclick="removeTeam()" /></div>
							-->
							<table class="table table-bordered table-striped" id="team_tb">
								<thead>
									<tr>
										<th class="detail-col center">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>
										<th class="detail-col center" style="width:25%;">
											사원번호
										</th>
										<th class="detail-col center">
											사원명
										</th>
										<th class="detail-col center">
											부서
										</th>
										<th class="detail-col center">
											직급
										</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
							<!--
							<? $this->table3("team_tb","사원번호=>2,사원명=>1,부서=>3,직급=>"); ?>
							-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="teamModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">생산팀 등록</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:90px">
				<form id="frm">
					<input type="hidden" name="mode" id="mode" value="registTeam" />
					<input type="hidden" name="uid" id="uid" />
					<table class="table table-bordered">
						<tr>
							<? $this->th("생산팀명","red"); ?>
							<td><input type="text" class="form-control" name="team_nm" id="team_nm" validation="yes" err="생산팀명을 입력하세요" /></td>
						</tr>
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-info" id="btnSubmit">저장</button>
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
function viewModal(modal) {
	showModal('teamModal');
}

$(document).keypress(function(e) {
	if(e.which === 13) registTeam();
});

$(document).ready(function(){
	// 특수문자 입력 방지
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	
	getTeam();
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
					getTeam();
					formClear();
					hideModal('teamModal');
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
// 팀원이동
//==================================================
function moveTeam() {
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

	var parameter = {"mode" : "moveTeam", "uid" : $("#uid").val(), "uids" : $("#check_uids2").val()};
	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		async : false,
		success : function(){
			$("#checkedAll2").prop('checked',false);
			getTeamMemberList();
		}
	});
}

//==================================================
// 팀원 제외
//==================================================
function removeTeam() {
	$(".chk3").each(function(){
		if($(this).prop('checked')) {
			var new_uid = $("#check_uids3").val() + "," + $(this).val();
			$("#check_uids3").val(new_uid);
		}
	});
	
	if($("#check_uids3").val() == "") {
		showAlert("제외할 팀원을 선택하세요");
		return;
	}

	var parameter = {"mode" : "removeTeam", "uids" : $("#check_uids3").val()};
	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		async : false,
		success : function(){
			$("#checkedAll3").prop('checked',false);
			getTeamMemberList();
		}
	});
}

//==================================================
// 팀원 리스트 가져오기
//==================================================
function getTeamMemberList(page){
	var tag = "";
	var parameter = {"mode" : "getTeamMemberList", "uid" : $("#uid").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";

					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk3' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>

					tag += "<td>" + json[i].emp_cd + "</td>";
					tag += "<td>" + json[i].emp_nm + "</td>";
					//tag += "<td>" + json[i].gender + "</td>";
					tag += "<td>" + json[i].department + "</td>";
					tag += "<td>" + json[i].position_cd + "</td>";
					//tag += "<td>" + json[i].mobile + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#team_tb tbody").html(tag);
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
	deleteSelect("team", 3);
	hideModal("confirm-delete");
}

//==================================================
// 생산팀 가져오기
//==================================================
function getTeam(){
	var tag = "";
	var parameter = {"mode" : "getTeamList"};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr onclick='toggle(this); postUid(" + json[i].uid + ")' style='cursor:pointer'>";
					
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					
					tag += "<td><a href='#' onclick=\"postTeam(" + json[i].uid + ", '" + json[i].team_nm + "')\">" + json[i].team_nm + "</a></td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='2' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}

			$("#team_list tbody").html(tag);
		}
	);
}

//==================================================
// 선택 팀 처리
//==================================================
function postUid(uid) {
	$("#uid").val(uid);
	getTeamMemberList();
}

//==================================================
// 선택 팀 처리
//==================================================
function postTeam(uid, team_nm) {
	$("#uid").val(uid);
	$("#team_nm").val(team_nm);
	showModal("teamModal");
}

//==================================================
// 상품테이블 선택 아이템 TR 색상 바꾸기
//==================================================
function toggle(it) {
	$("#team_list tr").css("background-color","");
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
	$("#frm")[0].reset();
}
</script>