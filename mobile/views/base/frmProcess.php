<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<!--
					<div style="float:left;">
						<form name="frm" id="frm">
							<input type="hidden" name="mode" id="mode" value="registProcess" />
							<input type="hidden" name="uid" id="uid" />

							<input type="button" class="btn btn-xs" value="공정명" style="margin-bottom:4px"/>
							<input type="text" name="process_nm" id="process_nm" validation="yes" err="공정명을 입력하세요" />
							<input type="button" class="btn btn-xs" value="QC 여부" style="margin-bottom:4px"/>
							<input name="qc" id="qc" value="y" class="ace ace-switch ace-switch-5" type="checkbox" /><span class="lbl" style="position:relative; top:5px"></span>	
							<input type="button" class="btn btn-xs btn-inverse" id="btnSubmit" value="생성 및 수정" style="margin-bottom:4px" />
							<button type="button" class="btn btn-success btn-xs" onclick="refresh()" style="margin-bottom:4px">
								<span class="fa fa-refresh icon-on-right bigger-110"></span>
							</button>
						</form>
					</div>
					-->
					<!--
					<div style="float:right;">
						<input type="button" class="btn btn-xs btn-primary" value="창고생성" onclick="createWarehouse()" />
						<input type="button" class="btn btn-xs btn-danger" value="선택삭제" data-toggle="modal" data-target="#confirm-delete" />
					</div>
					-->
					<div>
						<div class="col-xs-12">
							<? $this->table("process_list","공정명"); ?>
						</div>
					</div>
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
function refresh() {
	$("#uid").val("");
	$("#process_nm").val("");
}

// $(document).keypress(function(e) {
// 	if(e.which === 13) registProcess();
// });

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	getData();

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
					$("#uid").val("");
					getData();
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
	deleteSelect("process");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
}

//==================================================
// 공정 리스트 가져오기
//==================================================
function getData(){
	var tag = "";
	var parameter = {"mode" : "getProcess"};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					tag += "<td><a href='#' onclick=\"postProcess(" + json[i].uid + ", '" + json[i].process_nm + "', '" + json[i].qc + "')\">" + json[i].process_nm + "</a></td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='2' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}


			$("#process_list tbody").html(tag);
		}
	);
}

//==================================================
// 선택한 공정 처리
//==================================================
function postProcess(uid, process_nm, qc) {
	$("#uid").val(uid);
	$("#process_nm").val(process_nm);
	if(qc == "y") {
		$("#qc").prop("checked",true);
	} else {
		$("#qc").prop("checked",false);
	}
}

// 창고생성
function createWarehouse(){
	var parameter = {"mode" : "createProcessWarehouse"};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str){
			showAlert("창고를 생성하였습니다");
			getData();
		}
	});
}
</script>