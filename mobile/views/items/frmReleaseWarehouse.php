<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12" style="height:750px; margin-top:5px">
					<div class="col-xs-12" style="border:1px solid #ccc; height:100%;">
						<div style="height:100%; padding-top:10px; padding-right:10px; overflow:hidden; overflow-y:scroll">
							<div><input type="button" class="btn btn-xs btn-pink" value="불출재고 리스트" /></div>
							<? $this->noCheckTable("tb","작지번호,보낼공정,보낼설비,보낼팀,품번,품명,규격,단위,출고수량,상태,Lot No,바코드,출고일"); ?>
							<? $this->paging() ?>
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
	getOrderWaitingList();

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			if($("#cnt").val() <= 0) {
				showAlert("구매요청 수량을 입력하세요");
				return;
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
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#btnSubmitTxt").text("구매요청등록");
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
// 구매요청 리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getReleaseWarehouseList"};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postItem('" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].unit + "');\" style='cursor:pointer'>";

					tag += "<td>" + json[i].work_cd + "</td>";
					tag += "<td>" + json[i].process + "</td>";
					tag += "<td>" + json[i].machine + "</td>";
					tag += "<td>" + json[i].team + "</td>";
					tag += "<td>" + json[i].item_cd + "</td>";					
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					tag += "<td>" + json[i].cnt + "</td>";
					tag += "<td>" + json[i].state + "</td>";
					tag += "<td>" + json[i].lot_no + "</td>";
					tag += "<td>" + json[i].barcode + "</td>";
					tag += "<td>" + json[i].create_dt + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='13' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);
		}
	);
}

setInterval(function() {
	getData();
}, 10000); // 1초에 한번

//==================================================
// 선택한 품목 처리
//==================================================
function postItem(item_cd, item_nm, standard, unit) {
	$("#purchase_item_cd").val(item_cd);
	$("#purchase_item_nm").val(item_nm);
	$("#purchase_standard").val(standard);
	$("#purchase_unit").val(unit);
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