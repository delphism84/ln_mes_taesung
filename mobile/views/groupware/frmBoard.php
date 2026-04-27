<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">			
			<div>
				<div>
					<div class="col-xs-12">
					<input type='button' class='comm_title' value='업무공유 리스트' />
						<?
						/*
						if($_SESSION['login_level'] >= 99) {
							echo "<div style='float:left'>";
							echo "<input type='button' class='btn btn-xs btn-pink' value='업무공유 리스트' />";
							echo "</div>";
							echo "<div style='float:right;'>";
							//echo "<input type='button' class='btn btn-xs btn-info' value='업무공유등록' onclick='registWorkShare()' style='margin-right:3px' />";
							//echo "<input type='button' class='btn btn-xs btn-danger' value='선택삭제' data-toggle='modal' data-target='#confirm-delete' />";
							echo "</div>";

							$this->table("tb","구분,제목,수신자,참조자,등록자,등록일,수신확인,수신확인일,수정");
						} else {
							echo "<div style='float:left'>";
							echo "<input type='button' class='btn btn-xs btn-pink' value='업무공유 리스트' />";
							echo "</div>";
							echo "<div style='float:right;'>";
							echo "<input type='button' class='btn btn-xs btn-info' value='업무공유등록' onclick='registWorkShare()' style='margin-right:3px' />";
							echo "</div>";

							$this->noCheckTable("tb","구분,제목,수신자,참조자,등록자,등록일,수신확인,수신확인일,수정");
						}
						*/
							$this->noCheckTable("tb","구분,제목,등록자,수신확인");
							$this->paging();
						?>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>

<div class="modal fade" id="workShareModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:1200px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">업무공유</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:700px">
				<form id="frm">
					<input type="hidden" name="mode" id="mode" value="registWorkShare" />
					<input type="hidden" name="uid" id="uid" />
					<input type="hidden" name="old_attach" id="old_attach" />
					<textarea style="display:none" name="content" id="content"></textarea>
					<table class="table table-bordered">
						<tr>
							<? $this->th("제목") ?>
							<td><input type="text" class="form-control" name="title" id="title" validation="yes" err="제목을 입력하세요" /></td>
						</tr>
						<tr>
							<? $this->th("업무구분") ?>
							<td>
								<select name="classify" id="classify" style="height:35px">
									<option value="공지사항">공지사항</option>
									<option value="업무협조">업무협조</option>
									<option value="알림">알림</option>
								</select>
							</td>
						</tr>
						<tr>
							<? $this->th("수신인") ?>
							<td>
								<?=$this->createDbSelectBox("department_middle","department_nm","middle_department_cd","getSmallDepartment");?>
								<?=$this->createDbSelectBox("department_small","department_nm","small_department_cd", "getEmployee");?>
								<select name="receiver" id="receiver" style="height:35px">
									<option value="0">==선택==</option>
								</select>
							</td>
						</tr>
						<tr>
							<? $this->th("참조") ?>
							<td>
								<?=$this->createDbSelectBox("department_middle","department_nm","m_middle_department_cd","getMSmallDepartment");?>
								<?=$this->createDbSelectBox("department_small","department_nm","m_small_department_cd", "getMEmployee");?>
								<select name="refer" id="refer" style="height:35px">
									<option value="0">==선택==</option>
								</select>
							</td>
						</tr>
						<tr>
							<? $this->th("첨부파일") ?>
							<td>
								<div id="attachDiv"></div>
								<input type="file" name="attach" id="attach" />
							</td>
						</tr>
						<tr>
							<td colspan="2"><textarea name="comment" id="comment"></textarea></td>
							<script src="ckeditor/ckeditor.js"></script>
							<script>
							CKEDITOR.replace( 'comment',{
								width : '100%',
								height : '300px'
							});
							</script>
						</tr>
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-danger" id="btnWorkShareRegist">등록</button>
					<button type="button" class="btn btn-sm btn-info" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!--상세보기-->
<div class="modal fade" id="workShareViewModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">상세보기</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="overflow-y: scroll; height:500px">
				<input type="hidden" name="mode" id="mode" value="registWorkShare" />
				<textarea style="display:none" name="content" id="content"></textarea>
				<table class="table table-bordered">
					<tr>
						<? $this->th("제목","", "width:100px") ?>
						<td><span id="v_title"></span></td>
					</tr>
					<tr>
						<? $this->th("작성일") ?>
						<td><span id="v_create_dt"></span></td>
					</tr>
					<tr>
						<? $this->th("작성인") ?>
						<td><span id="v_emp_nm"></span></td>
					</tr>
					<tr>  
						<? $this->th("업무구분") ?>
						<td><span id="v_classify"></span></td>
					</tr>
					<tr>
						<? $this->th("수신인") ?>
						<td><span id="v_receiver"></span></td>
					</tr>
					<tr>
						<? $this->th("참조") ?>
						<td><span id="v_refer"></span></td>
					</tr>
					<tr>
						<? $this->th("첨부파일") ?>
						<td><span id="v_attach"></span></td>
					</tr>
					<tr>
						<td colspan="2"><div id="v_comment" style="width:100%; height:300px; overflow-y: scroll"></div></td>
					</tr>
				</table>
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

<input type="hidden" name="per" id="per" value="10" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
// 업무공유 모달창 띄우기
function registWorkShare() {
	$("#attachDiv").html("");
	$("#uid").val("");
	$("#old_attach").val("");
	showModal("workShareModal");
}

//==================================================
// 소부서 가져오기
//==================================================
function getSmallDepartment(){
	var tag = "<option value='0'>부서선택</option>";
	var parameter = {"mode" : "getSmallDepartment", "fid" : $("#middle_department_cd option:selected").val()};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}
			$("#small_department_cd").html(tag);
		}
	);
}

function getMSmallDepartment(){
	var tag = "<option value='0'>부서선택</option>";
	var parameter = {"mode" : "getSmallDepartment", "fid" : $("#m_middle_department_cd option:selected").val()};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}
			$("#m_small_department_cd").html(tag);
		}
	);
}

function getEmployee(emp_id) {
	var tag = "<option value='0'>사원선택</option>";
	var parameter = {"mode" : "getDepartmentEmployee", "middle_department" : $("#middle_department_cd option:selected").val(), "small_department" : $("#small_department_cd option:selected").val()};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					if(emp_id == json[i].emp_id) var sel = "selected"; else var sel = "";
					tag += "<option value='" + json[i].emp_id + "' " + sel + ">" + json[i].emp_nm + "</option>";
				}
			}
			$("#receiver").html(tag);
		}
	);
}

function getMEmployee(emp_id) {
	var tag = "<option value='0'>사원선택</option>";
	var parameter = {"mode" : "getDepartmentEmployee", "middle_department" : $("#m_middle_department_cd option:selected").val(), "small_department" : $("#m_small_department_cd option:selected").val()};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					if(emp_id == json[i].emp_id) var sel = "selected"; else var sel = "";
					tag += "<option value='" + json[i].emp_id + "' " + sel + ">" + json[i].emp_nm + "</option>";
				}
			}
			$("#refer").html(tag);
		}
	);
}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

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

	// 등록
	$("#btnWorkShareRegist").click(function (event) {
		if(check("frm")) {
			var ContentFromEditor = CKEDITOR.instances.comment.getData();
			$("#content").val(ContentFromEditor);
			//return false;
			if($("#receiver option:selected").val() == 0 || $("#receiver option:selected").val() == "") {
				showAlert("수신인을 선택하세요");
				return false;
			}

			event.preventDefault();
			var form = $('#frm')[0];
			var data = new FormData(form);

			

			data.append("CustomField", "This is some extra data, testing");

			$("#btnWorkShareRegist").prop("disabled", true);


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
					hideModal("workShareModal");
					$("#old_attach").val("");
					$("#uid").val("");
					$("#comment").val("");
					$("#content").val("");
					getData(1);
					formClear();
					$("#btnWorkShareRegist").prop("disabled", false);

				},
				error: function (e) {
					$("#btnWorkShareRegist").prop("disabled", false);

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
	deleteSelect("work_share");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
}

//==================================================
// 업무공유 리스트 가져오기
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getWorkShareList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
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
					tag += "<td><a href='#' onclick='viewModal(" + json[i].uid + ")'>" + json[i].classify + "</a></td>";
					tag += "<td>" + json[i].title + "</td>";
					//tag += "<td>" + json[i].receiver_nm + "</td>";
					//tag += "<td>" + json[i].refer_nm + "</td>";
					tag += "<td>" + json[i].emp_nm + "</td>";
					//tag += "<td>" + json[i].create_dt + "</td>";
					tag += "<td>" + json[i].view_check + "</td>";
					//tag += "<td>" + json[i].view_dt + "</td>";
					//tag += "<td><input type='button' class='btn btn-xs btn-success' value='수정' onclick='modify(" + json[i].uid + ")' /></td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='10' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}


			$("#tb tbody").html(tag);

			var table = "work_share";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

function viewModal(uid) {
	var parameter = {"mode" : "getShareBoard", "uid" : uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#v_title").html(json.title);
			$("#v_classify").html(json.classify);
			$("#v_receiver").html(json.receiver);
			$("#v_refer").html(json.refer);
			var attach = "<a href='index.php?controller=groupware&action=download&file=" + json.attach + "'>" + json.attach + "</a>";
			$("#v_attach").html(attach);
			$("#v_comment").html(json.comment);
			$("#v_emp_nm").html(json.emp_nm);
			$("#v_create_dt").html(json.create_dt);

			showModal('workShareViewModal');
		}
	});
}

function modify(uid) {
	var parameter = {"mode" : "getShareBoard", "uid" : uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#uid").val(json.uid);
			$("#title").val(json.title);
			$("#classify").val(json.classify);
			$("#receiver").val(json.receiver_id);
			$("#refer").val(json.refer_id);
			$("#old_attach").val(json.attach);
			$("#middle_department_cd").val(json.receiver_middle);
			var receiver_id = json.receiver_id;
			var receiver_small = json.receiver_small;

			var tag = "<option value='0'>부서선택</option>";
			var parameter = {"mode" : "getSmallDepartment", "fid" : json.receiver_middle};

			$.getJSON("ajax.php", {"parameter" : parameter},
				function(json){
					if(json != null) {
						for(var i = 0 ; i < json.length ; i++){
							if(json[i].uid == receiver_small) var sel = "selected"; else var sel = "";
							tag += "<option value='" + json[i].uid + "' " + sel + ">" + json[i].department_nm + "</option>";
						}
					}
					$("#small_department_cd").html(tag);
					getEmployee(receiver_id);
				}
			);

			$("#m_middle_department_cd").val(json.refer_middle);
			var refer_id = json.refer_id;
			var refer_small = json.refer_small;


			var refer_small = json.refer_small;

			var tag = "<option value='0'>부서선택</option>";
			var parameter = {"mode" : "getSmallDepartment", "fid" : json.refer_middle};

			$.getJSON("ajax.php", {"parameter" : parameter},
				function(json){
					if(json != null) {
						for(var i = 0 ; i < json.length ; i++){
							if(json[i].uid == refer_small) var sel = "selected"; else var sel = "";
							tag += "<option value='" + json[i].uid + "' " + sel + ">" + json[i].department_nm + "</option>";
						}
					}
					$("#m_small_department_cd").html(tag);
					getMEmployee(refer_id);
				}
			);

			var attach = "<a href='index.php?controller=groupware&action=download&file=" + json.attach + "'>" + json.attach + "</a>";
			$("#attachDiv").html(attach);

			// Insert Text into CKEDITOR
			CKEDITOR.instances.comment.setData();  //  에디터에 내용 초기화(비우기)
			setTimeout(function() {
				CKEDITOR.instances.comment.document.getBody().setHtml(json.comment);
				// html 코드를 정상적으로 에디터에 추가하기 위한 방법
			}, 200);

			showModal('workShareModal');
		}
	});
}
</script>