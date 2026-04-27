<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">			
			<div>
				<div class="col-xs-12">		
					<div>
						<div><input type="button" class="comm_title" value="공정 리스트" /></div>
						<? $this->noCheckTable("tb","공정명,기계명"); ?>
					</div>
				</div>
				<!--
				<div class="col-xs-12">
					<div>	
						<div><input type="button" class="btn btn-xs btn-pink" value="공정재고 리스트" /></div>
						<? $this->noCheckTable("stock_tb","품번,품명,규격,단위,수량,Lot No,입고일"); ?>
					</div>
				</div>
				-->
			</div>			
		</div>
	</div>
</div>

<!--공정재고 리스트 MODAL-->
<div class="modal fade" id="viewProcessWarehouseItemModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">공정재고 리스트</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:70%; overflow:scroll; overflow-x:hidden">
				<div>
					<div class="col-xs-12">
						<div>
							<table class="table table-bordered" id="stock_tb">
								<thead>
									<tr>
										<? $this->th("품번") ?>
										<? $this->th("품명") ?>
										<? $this->th("수량") ?>
										<? $this->th("Lot No") ?>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
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

<div class="modal fade" id="createStandardModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">품목규격 등록</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:130px">
				<form id="pop_frm">
					<table class="table table-bordered">
						<tr>
							<? $this->th("품번","red"); ?>
							<td><input type="text" class="form-control" name="p_item_cd" id="p_item_cd" validation="yes" err="품번을 입력하세요" /></td>
						</tr>
						<tr>
							<? $this->th("품목규격","red"); ?>
							<td><input type="text" class="form-control" name="p_standard" id="p_standard" validation="yes" err="품목규격을 입력하세요"/></td>
						</tr>
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-info" onclick="registStandard('createStandardModal')">저장</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );


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

	$("#item_classify").on('change', function() {
		if($("#item_classify option:selected").val() == 0) {
			$("#search_txt").val("");
			$("#where").val("");
			getData(1);
		}
	});

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			if($("#cnt").val() > 0) {
				if($("#warehouse_cd option:selected").val() == 0) {
					showAlert("기초재고 수량을 입고시킬 창고를 선택하세요");
					return;
				}
			}
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
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("item");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#btnSubmitTxt").text("품목등록");
}

//==================================================
// 선택된 품목 테이블 선택된 TR 색상 바꾸기
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
// 품목리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getProcessMachine"};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); getItem(" + json[i].uid + ", " + json[i].process_cd + ");\" style='cursor:pointer'>";
					tag += "<td>" + json[i].process_nm + "</td>";
					tag += "<td>" + json[i].machine_nm + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "item";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

function getItem(uid, process) {
	var tag = "";
	var parameter = {"mode" : "getProcessWarehouseItemList", "machine" : uid, "process" : process};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for (var i = 0 ; i < json.length ; i++)
			{
				tag += "<tr>";
				tag += "<td>" + json[i].item_cd + "</td>";
				tag += "<td>" + json[i].item_nm + "</td>";
				//tag += "<td>" + json[i].standard + "</td>";
				//tag += "<td>" + json[i].unit + "</td>";
				tag += "<td>" + comma(json[i].cnt) + "</td>";
				tag += "<td>" + json[i].lot_no + "</td>";
				//tag += "<td>" + json[i].create_dt + "</td>";
				tag += "</tr>";
			}
		} else {
			tag = "<tr><td colspan='7' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#stock_tb tbody").html(tag);
	});
	showModal('viewProcessWarehouseItemModal');
}

//콤마찍기
function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

//콤마풀기
function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}
//==================================================
// 품목코드 확인
//==================================================
function checkCode(modal_nm) {
	if($("#item_cd").val() == "") {
		showAlert("품목코드가 생성이 되어있지 않습니다.<br>품목코드 생성 후 진행하세요"); 
	} else {
		$("#p_item_cd").val($("#item_cd").val());
		showModal(modal_nm);
	}
}

//==================================================
// 검색
//==================================================
function search(){
	var classify = $("#item_classify option:selected").val();
	var txt = $("#search_txt").val();
	
	if(classify == 0) {
		showAlert("검색구분을 선택하세요");
		return;
	}
	
	if(txt == "") {
		showAlert("검색어를 입력하세요");
		return;
	}

	$("#where").val("where " + classify + " like '%" + txt + "%'");
	getData(1);
}

//==================================================
// 품목구분 품목 리스트 가져오기
//==================================================
function setItem(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("");
	else $("#where").val(" where classify=" + val);
	getData(1);
}
</script>