<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">		
			<div>
				<div class="col-xs-12">
					<div style="float:left"><input type="button" class="btn btn-xs btn-pink" value="문서양식 리스트" /></div>
					<!--<div style="float:right"><input type="button" class="btn btn-xs btn-danger" value="선택삭제" data-toggle="modal" data-target="#confirm-delete" /></div>-->
					<? $this->NoChecktable("tb","구분,제목"); ?>
					<? $this->paging() ?>
				</div>
				<!--
				<div class="col-xs-12">
					<div>
					    <form name="frm" id="frm">
						<input type="hidden" name="mode" id="mode" value="registApprovalDocument" />
						<input type="hidden" name="uid" id="uid" />
						<textarea style="display:none" name="content" id="content"></textarea>
				-->	
						<!-- 테이블 -->
					<!--
						<div style="float:left"><input type="button" class="btn btn-xs btn-pink" value="문서양식 등록" /></div>
						<table id="simple-table" class="table  table-bordered table-hover">
						    <tr>
							<th style="background-color:#f1f1f1; width:30%;">
								문서구분
							</th>                                       
							<td class="col-xs-11">
							    <select name="classify" id="classify">
								<option value="공용">공용</option>
								<option value="개인">개인</option>
							    </select>
							</td>
						    </tr>
						    <tr>
							<th style="background-color:#f1f1f1;">
								제목
							</th>                                           
							<td class="col-xs-11"><input type="text" class="form-control" name="title" id="title" validation="yes" err="제목을 입력하세요" /></td>
						    </tr>
						    <tr>
							<td colspan="4"><textarea name="comment" id="comment" disabled></textarea></td>
							<script src="ckeditor/ckeditor.js"></script>
							<script>
							CKEDITOR.replace( 'comment',{
							    filebrowserImageUploadUrl:"upload.php?type=Images",
							    width : '100%',
							});
							</script>
						    </tr>
						</table>
					
					    </form>
				-->
		  <!--  <div style="text-align:center"><input type="button" id="btnSubmit" class="btn btn-lg btn-primary" value="양식등록" /></div>-->
					<!--
					</div>					
				</div>
				-->
			</div>
		</div>
	</div>
</div>

<!--문서 MODAL-->
<div class="modal fade" id="viewApprovalDocumentModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">상세보기</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:70%; overflow:scroll; overflow-x:hidden">
				<div>
					<div class="col-xs-12">
						


						<div>
							<form name="frm" id="frm">
							<input type="hidden" name="mode" id="mode" value="registApprovalDocument" />
							<input type="hidden" name="uid" id="uid" />
							<textarea style="display:none" name="content" id="content"></textarea>

							<!-- 테이블 -->
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
								<th style="background-color:#f1f1f1; width:30%;">
									문서구분
								</th>                                       
								<td class="col-xs-11">
									<select name="classify" id="classify" disabled>
									<option value="공용">공용</option>
									<option value="개인">개인</option>
									</select>
								</td>
								</tr>
								<tr>
								<th style="background-color:#f1f1f1;">
									제목
								</th>                                           
								<td class="col-xs-11"><input type="text" class="form-control" name="title" id="title" validation="yes" err="제목을 입력하세요" disabled/></td>
								</tr>
								<tr>
								<td colspan="4"><textarea name="comment" id="comment" disabled></textarea></td>
								<script src="ckeditor/ckeditor.js"></script>
								<script>
								
								CKEDITOR.replace( 'comment',{
									filebrowserImageUploadUrl:"upload.php?type=Images",
									width : '100%',
								});
								</script>
								</tr>
							</table>
						
							</form>

			  <!--  <div style="text-align:center"><input type="button" id="btnSubmit" class="btn btn-lg btn-primary" value="양식등록" /></div>-->
						</div>					






					</div>
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
// 	if(e.which === 13) search();
// });

$(document).ready(function(){
	

	var page = $("#page").val();
	getData(page);

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

    // 문서등록
	$("#btnSubmit").click(function (event) {		
		if(check("frm")) {
			var ContentFromEditor = CKEDITOR.instances.comment.getData();
			$("#content").val(ContentFromEditor);

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
	formClear();
	$("#uid").val("");
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("approval_document");
	hideModal("confirm-delete");
}


//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
}

//==================================================
// 견적서 테이블 선택된 TR 색상 바꾸기
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
// 문서양식 리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getApprovalDocumentList", "rpp" : 17, "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); modify(" + json[i].uid + ")\" style='cursor:pointer'>";
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
					tag += "<td>" + json[i].classify + "</td>";
					tag += "<td>" + json[i].title + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "approval_document";
			getPaging(table, $("#where").val(), 17, 4, "setPage");
		}
	);
}

// 문서양식수정
function modify(uid) {
	var parameter = {"mode" : "getApprovalDocument", "uid" : uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#uid").val(json.uid);
			$("#title").val(json.title);
			$("#classify").val(json.classify);
			showModal('viewApprovalDocumentModal');
			// Insert Text into CKEDITOR
			CKEDITOR.instances.comment.setData();  //  에디터에 내용 초기화(비우기)
			setTimeout(function() {
				CKEDITOR.instances.comment.document.getBody().setHtml(json.comment);
				// html 코드를 정상적으로 에디터에 추가하기 위한 방법
			}, 200);
		}
	});
}

//==================================================
// TR 삭제
//==================================================
function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#flag").val(nextFlag);
}

//==================================================
// 검색
//==================================================
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	$("#where").val(" where item_nm like '%" + txt + "%' or item_cd like '%" + txt + "%'");
	getData(1);
}

//==================================================
// 품목구분 품목 리스트 가져오기
//==================================================
function setItem(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("");
	else $("#where").val(" where classification=" + val);
	getData(1);
}
</script>