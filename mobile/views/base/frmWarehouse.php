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
					<div style="float:left">
						<form name="frm" id="frm">
							<input type="hidden" name="mode" id="mode" value="registWarehouse" />
							<input type="hidden" name="uid" id="uid" />

							<input type="button" class="btn btn-xs" value="창고명" style="margin-bottom:4px"/>
							<input type="text" name="warehouse_nm" id="warehouse_nm" validation="yes" err="창고명을 입력하세요" />
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
							<? $this->table("warehouse_list", "창고명"); ?>
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
	$("#warehouse_nm").val("");
}

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
			if($("#seq").val() == "") $("#seq").val(Number($("#max_seq").val()) + 1);

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
	$("#uid").val("");
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
	deleteSelect("warehouse");
	hideModal("confirm-delete");
}

//==================================================
// 창고 가져오기
//==================================================
function getData(){
	var tag = "";
	var parameter = {"mode" : "getWarehouseList"};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
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
					tag += "<td><a href='#' onclick=\"postWarehouse(" + json[i].uid + ",'" + json[i].classify + "','" + json[i].warehouse_nm + "','" + json[i].account_cd + "','" + json[i].account_nm + "')\">" + json[i].warehouse_nm + "</a></td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='4' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#warehouse_list tbody").html(tag);
		}
	);
}

//==================================================
// 선택한 창고 처리
//==================================================
function postWarehouse(uid, classify, warehouse_nm, account_cd, account_nm) {
	$("#uid").val(uid);
	$('input:radio[name=classify][value=' + classify + ']').prop("checked", true);
	$("#warehouse_nm").val(warehouse_nm);
	$("#account_cd").val(account_cd);
	$("#account_nm").val(account_nm);
}

// 창고생성
function createWarehouse(){
	var parameter = {"mode" : "createWarehouse"};
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