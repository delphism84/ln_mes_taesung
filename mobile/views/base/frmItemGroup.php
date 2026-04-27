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
							<input type="hidden" name="mode" id="mode" value="registItemGroup" />
							<input type="hidden" name="uid" id="uid" />
							<input type="hidden" name="max_seq" id="max_seq" />

							<input type="button" class="btn btn-xs" value="그룹명" style="margin-bottom:4px"/>
							<input type="text" name="group_nm" id="group_nm" validation="yes" err="그룹명을 입력하세요" />
							<input type="button" class="btn btn-xs" value="출력순서" style="margin-bottom:4px"/>
							<input type="text" name="seq" id="seq" /> 
							<input type="button" class="btn btn-xs btn-inverse" id="btnSubmit" value="생성 및 수정" style="margin-bottom:4px" />
							<button type="button" class="btn btn-success btn-xs" onclick="refresh()" style="margin-bottom:4px">
								<span class="fa fa-refresh icon-on-right bigger-110"></span>
							</button>
						</form>
					</div>
					<div style="float:right;">
						<input type="button" class="btn btn-xs btn-danger" value="선택삭제" data-toggle="modal" data-target="#confirm-delete" />
					</div>
					-->

					<div>
						<div class="col-xs-12">
							<div class="widget-main no-padding">
								<? $this->noCheckTable("tb", "그룹명=>6, 출력순서=>6"); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?
echo $this->alertModal();
echo $this->confirmModal();
echo $this->hidden();
require_once ("assets/include_script.php");
?>

<script>
function refresh() {
	$("#uid").val("");
	$("#group_nm").val("");
	$("#seq").val("");
}

$(document).ready(function(){
	// 특수문자 입력 방지
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
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
	deleteSelect("item_group");
	hideModal("confirm-delete");
}

//==================================================
// 품목그룹 리스트 가져오기
//==================================================
function getData(){
	var tag = "";
	var parameter = {"mode":"getItemGroupList"};

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
					tag += "<td><a href='#' onclick=\"postGroup(" + json[i].uid + ",'" + json[i].group_nm + "'," + json[i].seq + ")\">" + json[i].group_nm + "</a></td>";
					tag += "<td><a href='#' onclick=\"postGroup(" + json[i].uid + ",'" + json[i].group_nm + "'," + json[i].seq + ")\">" + json[i].seq + "</a></td>";
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
// 선택한 그룹 처리
//==================================================
function postGroup(uid, group_nm, seq) {
	$("#uid").val(uid);
	$("#group_nm").val(group_nm);
	$("#seq").val(seq);
}
</script>