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
							<input type="hidden" name="mode" id="mode" value="registAccountClassify" />
							<input type="hidden" name="uid" id="uid" />
							<input type="hidden" name="max_seq" id="max_seq" />

							<input type="button" class="btn btn-xs" value="구분명" style="margin-bottom:4px"/>
							<input type="text" name="classify_nm" id="classify_nm" validation="yes" err="구분명을 입력하세요" />
							<input type="button" class="btn btn-xs" value="출력순서" style="margin-bottom:4px"/>
							<input type="text" name="seq" id="seq" /> 

							<input type="button" class="btn btn-xs btn-inverse" id="btnSubmit" value="생성 및 수정" style="margin-bottom:4px" />
							<button type="button" class="btn btn-success btn-xs" onclick="refresh()" style="margin-bottom:4px">
								<span class="fa fa-refresh icon-on-right bigger-110"></span>
							</button>
						</form>
					</div>
					-->
					<!--
					<div style="float:right;">
						<input type="button" class="btn btn-xs btn-danger" value="선택삭제" data-toggle="modal" data-target="#confirm-delete" />
					</div>
					-->
					<div>
						<div class="col-xs-12">
							<div class="widget-main no-padding">
								<? $this->noCheckTable("tb","구분명=>6,출력순서=>6"); ?>
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
	$("#classify_nm").val("");
	$("#seq").val("");
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
			if($("#seq").val() == "") $("#seq").val(Number($("#max_seq").val()) + 1);
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
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("account_classify");
	hideModal("confirm-delete");
}

//==================================================
// 거래처 구분 가져오기
//==================================================
function getData(){
	var tag = "";
	var parameter = {"mode" : "getAccountClassifyList"};

	$.getJSON("ajax.php",{"parameter": parameter},
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
					tag += "<td><a href='#' onclick=\"postClassify(" + json[i].uid + ",'" + json[i].classify_nm + "'," + json[i].seq + ")\">" + json[i].classify_nm + "</a></td>";
					tag += "<td><a href='#' onclick=\"postClassify(" + json[i].uid + ",'" + json[i].classify_nm + "'," + json[i].seq + ")\">" + json[i].seq + "</a></td>";
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
// 선택한 구분 처리
//==================================================
function postClassify(uid, classify_nm, seq) {
	$("#uid").val(uid);
	$("#classify_nm").val(classify_nm);
	$("#seq").val(seq);
}
</script>