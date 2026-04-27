<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					
					<div style="float:left;">
						<form name="frm" id="frm">
							<!--
							<input type="hidden" name="mode" id="mode" value="registFaultyType" />
							<input type="hidden" name="uid" id="uid" />

							<input type="button" class="btn btn-xs" value="불량유형" style="margin-bottom:4px"/>
							<input type="text" name="faulty_type" id="faulty_type" validation="yes" err="불량유형을 입력하세요" />

							<input type="button" class="btn btn-xs btn-inverse" id="btnSubmit" value="생성 및 수정" style="margin-bottom:4px" />
							<button type="button" class="btn btn-success btn-xs" onclick="refresh()" style="margin-bottom:4px">
								<span class="fa fa-refresh icon-on-right bigger-110"></span>
							</button>
							-->
						</form>
					</div>
					<!--
					<div style="float:right;">
						<input type="button" class="btn btn-xs btn-danger" value="선택삭제" data-toggle="modal" data-target="#confirm-delete" />
					</div>
					-->
					<div>
						<div class="col-xs-12">
							<div class="widget-main no-padding">
								<? $this->table("tb", "불량유형 (생산에서 사용되는 불량사유입니다)"); ?>
							</div>
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
	$("#faulty_type").val("");
}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
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
					getData();
					formClear();
					$("#uid").val("");
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
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
}

//==================================================
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("faulty_type");
	hideModal("confirm-delete");
}

//==================================================
// 품목구분 가져오기
//==================================================
function getData(){
	var tag = "";
	var parameter = {"mode" : "getFaultyTypeList"};

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
					tag += "<td><a href='#' onclick=\"postFaultyType(" + json[i].uid + ",'" + json[i].faulty_type + "')\">" + json[i].faulty_type + "</a></td>";					
					tag += "</tr>";

					$("#max_seq").val(json[i].seq);
				}
			} else {
				tag = "<tr><td colspan='3' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			tag += "<tr><td colspan='3'></td></tr>";
			$("#tb tbody").html(tag);
		}
	);
}

//==================================================
// 선택한 구분 처리하기
//==================================================
function postFaultyType(uid, faulty_type) {
	$("#uid").val(uid);
	$("#faulty_type").val(faulty_type);
}
</script>