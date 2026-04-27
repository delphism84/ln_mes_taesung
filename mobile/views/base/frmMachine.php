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
							<input type="hidden" name="mode" id="mode" value="registMachine" />
							<input type="hidden" name="uid" id="uid" />

							<input type="button" class="btn btn-xs" value="공정" style="margin-bottom:4px"/>
							<? $this->createDbSelectBox("process","process_nm","process_cd"); ?>
							<input type="button" class="btn btn-xs" value="설비명" style="margin-bottom:4px"/>
							<input type="text" name="machine_nm" id="machine_nm" validation="yes" err="설비명을 입력하세요" />
							<input type="button" class="btn btn-xs" value="설비관리번호" style="margin-bottom:4px"/>
							<input type="text" name="machine_no" id="machine_no" />
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
								<table class="table table-bordered table-striped" id="machine_list">
									<thead>
										<tr>
											<th class="detail-col center">
												<label class="pos-rel">
													<input type="checkbox" class="ace" id="checkedAll" />
													<span class="lbl"></span>
												</label>
											</th>
											<th class="detail-col center">
												공정명
											</th>
											<th class="detail-col center">
												설비명
											</th>
											<th class="detail-col center" style="width:40%;">
												설비관리번호
											</th>											
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<!--
								<? $this->table("machine_list", "공정명=>4,설비명=>4,설비관리번호=>4"); ?>
								-->
								<? $this->paging() ?>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="18" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
function refresh(){
	$("#process_cd").val(0);
	$("#machine_nm").val("");
	$("#machine_no").val("");
	$("#uid").val("");
}

// $(document).keypress(function(e) {
// 	if(e.which === 13) registMachine();
// });

$(document).ready(function() {
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	
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
		if($("#process_cd option:selected").val() == 0) {
			showAlert("공정을 선택하세요");
			return;
		}

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

	getData(1);
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
	deleteSelect("machine");
	hideModal("confirm-delete");
}

//==================================================
// 생산설비 가져오기
//==================================================
function getData(page) {
	var tag = "";
	var parameter = {"mode" : "getMachineList", "page" : page, "rpp" : $("#per").val(), "where" : $("#where").val()};
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
					tag += "<td><a href='#' onclick=\"postMachine(" + json[i].uid + ",'" + json[i].process_cd + "', '" + json[i].machine_nm + "', '" + json[i].machine_no + "')\">" + json[i].process_nm + "</a></td>";
					tag += "<td><a href='#' onclick=\"postMachine(" + json[i].uid + ",'" + json[i].process_cd + "', '" + json[i].machine_nm + "', '" + json[i].machine_no + "')\">" + json[i].machine_nm + "</a></td>";
					tag += "<td><a href='#' onclick=\"postMachine(" + json[i].uid + ",'" + json[i].process_cd + "', '" + json[i].machine_nm + "', '" + json[i].machine_no + "')\">" + json[i].machine_no + "</a></td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='4' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			tag += "<tr><td colspan='4'></td></tr>";
			$("#machine_list tbody").html(tag);

			
			var table = "machine";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//==================================================
// 선택 생산설비 처리
//==================================================
function postMachine(uid, process_cd, machine_nm, machine_no) {
	$("#uid").val(uid);
	$("#process_cd > option[value=" + process_cd + "]").attr("selected", "true");
	$("#machine_nm").val(machine_nm);
	$("#machine_no").val(machine_no);
}
</script>