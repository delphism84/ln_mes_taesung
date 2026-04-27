<?
require_once("library/caseby.php");
?>


<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">

			<div class="row">
				<div class="col-xs-12">
					<style>{ list-style:none; }</style>

<?
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
		echo $t->subject."</a>&nbsp;<i class='fa fa-plus-square text-primary bigger-150' style='vertical-align:middle; cursor:pointer' onclick=\"addModal('".$t->subject."', ".$t->uid.")\"></i> <i class='fa fa-minus-square text-danger bigger-150' style='vertical-align:middle; cursor:pointer' onclick=\"das(".$t->uid.")\"></i>";
		echo "</li>";
		display_children($t->uid, $level+1);
	}

	//$child_product = display_products($parent);

	if($level > 0) echo "</ul>\n";
	$no_children[] =  'list_'.$children;
}
?>

					<div class="widget-box widget-color-blue2">
						<div class="widget-header">
							<h4 class="widget-title lighter smaller">계정과목 관리 <input type="button" class="btn btn-xs btn-danger" value="기초데이터생성" onclick="registAccountSubject()" /></h4>
						</div>

						<div class="widget-body">
							<div class="widget-main padding-8">
								<ul style='list-style:none;'>
								<?
									$sql = "select * from account_subject";
									$this->query($sql);
									if($this->get_rows() > 0) display_children('',0); 
								?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- BOM용 -->
<div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">계정과목 등록/수정</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:140px">
				<form name="frm" id="frm">
					<input type="hidden" name="uid" id="uid" />
					<input type="hidden" name="mode" id="mode" value="registAccountSubject" />
					<table class="table table-bordered">
						<tr>
							<? $this->th("상위계정과목") ?>
							<td class="col-xs-8"><input type="text" class="form-control" name="parent_subject" id="parent_subject" readonly /></td>
						</tr>
						<tr>
							<? $this->th("하위계정과목") ?>
							<td class="col-xs-8"><input type="text" class="form-control" name="subject" id="subject" /></td>
						</tr>
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-primary" id="btnSubmit">등록</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="workConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:red">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel" style="color:white">삭제 확인</h4>
			</div>

			<div class="modal-body">
				<p>해당 계정과목을 삭제하시겠습니까?</p>
				<p class="debug-url"></p>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
				<a class="btn btn-danger btn-ok">삭제</a>
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
$(document).ready(function() {
	nokids();

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			if($("#subject").val() == "") {
				showAlert("하위계정과목을 입력하세요");
				return false;
			}

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
					if(data == "success") {
						//formClear();
						//hideModal("addModal");
						//$("#btnSubmit").prop("disabled", false);
						location.reload();
					}

				},
				error: function (e) {
					$("#btnSubmit").prop("disabled", false);

				}
			});
		}
	});
});


function addModal(parent_subject, uid) {
	$("#parent_subject").val(parent_subject);
	$("#uid").val(uid);
	showModal('addModal');
}

function formClear() {
	$("#uid").val("");
	$("#frm")[0].reset();
}

// 기본계정과목 등록
function registAccountSubject() {
	var parameter = {"mode" : "registBaseAccountSubject"};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "ok") location.reload();
			else if(str == "already") alert("이미 기초데이터가 입력되어있습니다");
		}
	});
}

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

function das(uid) {
	$("#uid").val(uid);
	showModal('workConfirm');
}

$('#workConfirm').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:deleteAccuntSubject();");
});

function deleteAccuntSubject() {
	hideModal('workConfirm');
	var parameter = {"mode" : "deleteAccountSubject", "uid" : $("#uid").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "son") {
				showAlert("하위 계정을 먼저 삭제하세요");
			} else {
				location.reload();
			}
		}
	});
}
</script>