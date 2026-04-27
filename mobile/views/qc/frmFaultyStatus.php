<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12" style="height:750px; margin-top:5px; clear:both">
					<div class="col-xs-12" style="border:1px solid #ccc; height:100%; padding-top:10px;">
						<div style="float:left">
							<input type="button" class="btn btn-xs btn-pink" value="생산현황" style="height:35px" />
							
						</div>
						<div>
							<div class="input-group">								
								<input type="text" name="search_txt" id="search_txt" style="float:right; height:35px"/>													
								<span class="input-group-btn">										
									<button type="button" class="btn btn-purple btn-sm" onclick="search()" style="height:35px">
										<span class="fa fa-search icon-on-right bigger-110"></span>
									</button>
									<button type="button" class="btn btn-success btn-sm" onclick="refresh()" style="height:35px">
										<span class="fa fa-refresh icon-on-right bigger-110"></span>
									</button>
									<button type="button" class="btn btn-danger btn-sm" style="height:35px" data-toggle="modal" data-target="#confirm-delete" >
										<span class="fa fa-trash icon-on-right bigger-110"></span>
									</button>
									<button type="button" class="btn btn-primary btn-sm" onclick="showModal('registModal')" style="height:35px">
										<span class="fa fa-plus icon-on-right bigger-110"></span>
									</button>
								</span>
							</div>
						</div>
						<?
						if($_SESSION['login_level'] >= 99){
							$this->table("tb","품번,품명,년도,1월,2월,3월,4월,5월,6월,7월,8월,9월,10월,11월,12월,총생산량,불량수량,불량률");
						} else {
							$this->noCheckTable("tb","품번,품명,년도,1월,2월,3월,4월,5월,6월,7월,8월,9월,10월,11월,12월,총생산량,불량수량,불량률");
						}

						$this->paging();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="16" />


<div class="modal fade" id="registModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:1400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">생산현황 등록</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:500px">
				<form id="frm">
					<input type="hidden" name="mode" id="mode" value="registFaultyStatus" />
					<input type="hidden" name="uid" id="uid" />
					<table class="table table-bordered">
						<tr>
							<? $this->th("품번") ?>
							<td><input type="text" class="form-control" name="item_cd" id="item_cd" validation="yes" err="품번을 입력하세요" onclick="showModal('itemModal')" /></td>
							<? $this->th("품목명") ?>
							<td><input type="text" class="form-control" name="item_nm" id="item_nm" validation="yes" err="품목명을 입력하세요" onclick="showModal('itemModal')" /></td>
						</tr>
						<tr>
							<? $this->th("규격") ?>
							<td><input type="text" name="standard" id="standard" /></td>
							<? $this->th("단위") ?>
							<td><input type="text" name="unit" id="unit" /></td>
						</tr>
						<tr>
							<? $this->th("해당년도") ?>
							<td><input type="text" name="year" id="year" value="2018" /></td>
							<? $this->th("불량률") ?>
							<td><input type="text" name="rate" id="rate" value="2" />%</td>
						</tr>
						<tr>
							<? $this->th("1월") ?>
							<td><input type="text" class="comma onlynum" name="ord_jan" id="ord_jan" onkeyup="cal('jan')" /> <input type="text" class="comma onlynum" name="jan" id="jan" /></td>						
							<? $this->th("2월") ?>
							<td><input type="text" class="comma onlynum" name="ord_feb" id="ord_feb" onkeyup="cal('feb')" /> <input type="text" class="comma onlynum" name="feb" id="feb" /></td>
						</tr>
						<tr>
							<? $this->th("3월") ?>
							<td><input type="text" class="comma onlynum" name="ord_mar" id="ord_mar" onkeyup="cal('mar')" /> <input type="text" class="comma onlynum" name="mar" id="mar" /></td>						
							<? $this->th("4월") ?>
							<td><input type="text" class="comma onlynum" name="ord_apr" id="ord_apr" onkeyup="cal('apr')" /> <input type="text" class="comma onlynum" name="apr" id="apr" /></td>
						</tr>
						<tr>
							<? $this->th("5월") ?>
							<td><input type="text" class="comma onlynum" name="ord_may" id="ord_may" onkeyup="cal('may')" /> <input type="text" class="comma onlynum" name="may" id="may" /></td>						
							<? $this->th("6월") ?>
							<td><input type="text" class="comma onlynum" name="ord_jun" id="ord_jun" onkeyup="cal('jun')" /> <input type="text" class="comma onlynum" name="jun" id="jun" /></td>
						</tr>
						<tr>
							<? $this->th("7월") ?>
							<td><input type="text" class="comma onlynum" name="ord_jul" id="ord_jul" onkeyup="cal('jul')" /> <input type="text" class="comma onlynum" name="jul" id="jul" /></td>						
							<? $this->th("8월") ?>
							<td><input type="text" class="comma onlynum" name="ord_aug" id="ord_aug" onkeyup="cal('aug')" /> <input type="text" class="comma onlynum" name="aug" id="aug" /></td>
						</tr>
						<tr>
							<? $this->th("9월") ?>
							<td><input type="text" class="comma onlynum" name="ord_sep" id="ord_sep" onkeyup="cal('sep')" /> <input type="text" class="comma onlynum" name="sep" id="sep" /></td>						
							<? $this->th("10월") ?>
							<td><input type="text" class="comma onlynum" name="ord_oct" id="ord_oct" onkeyup="cal('oct')" /> <input type="text" class="comma onlynum" name="oct" id="oct" /></td>
						</tr>
						<tr>
							<? $this->th("11월") ?>
							<td><input type="text" class="comma onlynum" name="ord_nov" id="ord_nov" onkeyup="cal('nov')" /> <input type="text" class="comma onlynum" name="nov" id="nov" /></td>						
							<? $this->th("12월") ?>
							<td><input type="text" class="comma onlynum" name="ord_dec" id="ord_dec" onkeyup="cal('dec')" /> <input type="text" class="comma onlynum" name="dec" id="dec" /></td>
						</tr>
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-info" id="btnSubmit">저장</button>
					<button type="button" class="btn btn-sm btn-success" onclick="formClear()">새로고침</button>
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
require_once ("views/modal/itemModal.php");
?>

<script>
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

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

function cal(m) {
	var rate = $("#rate").val();

	switch(m) {
		case "jan" :
			var a = uncomma($("#ord_jan").val());
			var b = (Number(a) * rate) / 100;
			$("#jan").val(comma(b));
		break;

		case "feb" :
			var a = uncomma($("#ord_feb").val());
			var b = (Number(a) * rate) / 100;
			$("#feb").val(comma(b));
		break;

		case "mar" :
			var a = uncomma($("#ord_mar").val());
			var b = (Number(a) * rate) / 100;
			$("#mar").val(comma(b));
		break;

		case "apr" :
			var a = uncomma($("#ord_apr").val());
			var b = (Number(a) * rate) / 100;
			$("#apr").val(comma(b));
		break;

		case "may" :
			var a = uncomma($("#ord_may").val());
			var b = (Number(a) * rate) / 100;
			$("#may").val(comma(b));
		break;

		case "jun" :
			var a = uncomma($("#ord_jun").val());
			var b = (Number(a) * rate) / 100;
			$("#jun").val(comma(b));
		break;

		case "jul" :
			var a = uncomma($("#ord_jul").val());
			var b = (Number(a) * rate) / 100;
			$("#jul").val(comma(b));
		break;

		case "aug" :
			var a = uncomma($("#ord_aug").val());
			var b = (Number(a) * rate) / 100;
			$("#aug").val(comma(b));
		break;

		case "sep" :
			var a = uncomma($("#ord_sep").val());
			var b = (Number(a) * rate) / 100;
			$("#sep").val(comma(b));
		break;

		case "oct" :
			var a = uncomma($("#ord_oct").val());
			var b = (Number(a) * rate) / 100;
			$("#oct").val(comma(b));
		break;

		case "nov" :
			var a = uncomma($("#ord_nov").val());
			var b = (Number(a) * rate) / 100;
			$("#nov").val(comma(b));
		break;

		case "dec" :
			var a = uncomma($("#ord_dec").val());
			var b = (Number(a) * rate) / 100;
			$("#dec").val(comma(b));
		break;
	}
}

function refresh() {
	$("#set_classify").val(0);
	$("#classify").val(0);
	$("#item_classify").val(0);
	$("#search_txt").val("");
	$("#where").val("");
	$("#page").val(1);
	getData(1);
}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getItemList(1);
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

	// 품목등록
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
				timeout: 600000,
				success: function (data) {
					getData(1);
					formClear();
					hideModal('registModal');
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
	deleteSelect("faulty_status");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#cnt").attr("readonly", false);
	$("#item_cd").attr("readonly", false); 
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
	var parameter = {"mode" : "getFaultyStatusList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick='toggle(this); postItem(" + json[i].uid + ");' style='cursor:pointer'>";

					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td rowspan='2' class='center' style='vertical-align:middle'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>

					tag += "<td rowspan='2' style='vertical-align:middle'>" + json[i].item_cd + "</td>";
					tag += "<td rowspan='2' style='vertical-align:middle'>" + json[i].item_nm + "</td>";
					tag += "<td rowspan='2' style='vertical-align:middle'>" + json[i].year + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].ord_jan) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].ord_feb) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].ord_mar) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].ord_apr) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].ord_may) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].ord_jun) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].ord_jul) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].ord_aug) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].ord_sep) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].ord_oct) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].ord_nov) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].ord_dec) + "</td>";

					var total = Number(json[i].ord_jan) + Number(json[i].ord_feb) + Number(json[i].ord_mar) + Number(json[i].ord_apr) + Number(json[i].ord_may) + Number(json[i].ord_jun) + Number(json[i].ord_jul) + Number(json[i].ord_aug) + Number(json[i].ord_sep) + Number(json[i].ord_oct) + Number(json[i].ord_nov) + Number(json[i].ord_dec);

					var faulty_total = Number(json[i].jan) + Number(json[i].feb) + Number(json[i].mar) + Number(json[i].apr) + Number(json[i].may) + Number(json[i].jun) + Number(json[i].jul) + Number(json[i].aug) + Number(json[i].sep) + Number(json[i].oct) + Number(json[i].nov) + Number(json[i].dec);
					
					var rate = (Number(faulty_total) / Number(total)) * 100;

					tag += "<td rowspan='2' style='text-align:right; vertical-align:middle'>" + comma(Math.floor(total)) + "</td>";
					tag += "<td rowspan='2' style='text-align:right; font-weight:bold; color:red; vertical-align:middle'>" + comma(Math.floor(faulty_total)) + "</td>";
					tag += "<td rowspan='2' style='text-align:right; font-weight:bold; color:red; vertical-align:middle'>" + comma(Math.floor(rate)) + " %</td>";
					tag += "</tr>";

					tag += "<tr>";
					tag += "<td style='text-align:right'>" + comma(json[i].jan) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].feb) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].mar) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].apr) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].may) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].jun) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].jul) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].aug) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].sep) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].oct) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].nov) + "</td>";
					tag += "<td style='text-align:right'>" + comma(json[i].dec) + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='16' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "production_status";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function postItem(uid) {
	var parameter = {"mode" : "getItem", "item_uid" : uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json){
		$("#item_cd").val(json.item_cd);
		$("#item_nm").val(json.item_nm);
		$("#standard").val(json.standard);
		$("#unit").val(json.unit);
		hideModal('itemModal');
	});
}

//==================================================
// 검색
//==================================================
function search(){
	var type = 1;
	var set_classify = $("#set_classify option:selected").val();
	if(type == 1){
		var txt = $("#search_txt").val();
		if(txt == "") {
			showAlert("검색어를 입력하세요");
			return;
		}
		
		if(set_classify == 0) $("#where").val("where item_cd like '@" + txt + "@' or item_nm like '@" + txt + "@'");		
		else $("#where").val("where classify=" + set_classify + " and (item_cd like '@" + txt + "@' or item_nm like '@" + txt + "@')");		
	} else {
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

		$("#where").val("where " + classify + " like '@" + txt + "@'");
	}
	$("#page").val(1);
	getData(1);
}
</script>