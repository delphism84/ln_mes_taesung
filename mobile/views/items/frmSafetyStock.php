<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12" style="margin-top:5px">
					<div class="col-xs-9" style="border:1px solid #ccc; height:100%;">
						<div style="height:100%; padding-top:10px; padding-right:10px">
							<div style="float:left"><input type="button" class="btn btn-xs btn-pink" value="부족재고목록" /></div>
							<div style="float:right"><input type="button" class="btn btn-xs btn-primary" value="부족재고검색" onclick="safetyStock()" /></div>
							<? $this->noCheckTable("tb","품번=>2,품명=>2,규격=>1,단위=>1,안전재고수량=>1,현재고수량=>1"); ?>
							<? $this->paging() ?>
						</div>
					</div>
					<div class="col-xs-3" style="border:1px solid #ccc; height:100%; overflow: scroll; overflow-x: hidden; padding-top:10px">
						<div>
							<form id='frm'>
								<input type="hidden" name="mode" id="mode" value="registPurchase" />
								<input type="hidden" name="uid" id="uid" />
								<div>
									<div><input type="button" class="btn btn-xs btn-pink" value="부족재고 구매요청" /></div>
									<table class="table table-bordered">
										<tr>
											<? $this->th("제목") ?>
											<td class="col-xs-8"><input type="text" name="title" id="title" validation="yes" err="품번을 입력하세요" value="안전재고확보 구매요청" /></td>
										</tr>
										<tr>
											<? $this->th("용도") ?>
											<td class="col-xs-8">
												<select name="purchase_type" id="purchase_type">
													<option value="내수">내수</option>
													<option value="사급">사급</option>
												</select>
											</td>
										</tr>
										<tr>
											<? $this->th("품번") ?>
											<td class="col-xs-8"><input type="text" name="purchase_item_cd" id="purchase_item_cd" validation="yes" err="품번을 입력하세요" onclick="showModal('itemModal')" readonly /></td>
										</tr>
										<tr>
											<? $this->th("품목명") ?>
											<td class="col-xs-8"><input type="text" name="purchase_item_nm" id="purchase_item_nm" validation="yes" err="품목명을 입력하세요" onclick="showModal('itemModal')" readonly /></td>
										</tr>
										<tr>
											<? $this->th("규격") ?>
											<td class="col-xs-8"><input type="text" name="purchase_standard" id="purchase_standard" onclick="viewStandard('listStandardModal')" onclick="showModal('itemModal')" readonly /></td>
										</tr>
										<tr>
											<? $this->th("단위") ?>
											<td class="col-xs-8">
												<select name="unit" id="unit">
													<option value="ea">ea</option>
													<option value="kg">kg</option>
													<option value="g">g</option>
													<option value="m">m</option>
													<option value="km">km</option>
													<option value="roll">roll</option>
													<option value="box">box</option>
												</select>
											</td>
										</tr>
										<tr>
											<? $this->th("요청수량") ?>
											<td class="col-xs-8"><input type="text" class="comma onlynum" name="purchase_cnt" id="purchase_cnt" validation="yes" err="요청수량을 입력하세요" /></td>
										</tr>
										<tr>
											<? $this->th("입고희망일") ?>
											<td class="col-xs-8">
												<div>
													<span class="input-icon input-icon-right">
														<div class="input-group">
															<input class=" date-picker" name="purchase_delivery_dt" id="purchase_delivery_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="납품기한을 입력하세요" readonly />
															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
														</div>
													</span>
												</div>
											</td>
										</tr>
									</table>
								</div>
								<div class="col-md-12 center">
									<button class="btn btn-info" type="button" id="btnSubmit">
										<i class="ace-icon fa fa-check bigger-110"></i>
										<span id="btnSubmitTxt">구매요청등록</span>
									</button>
									<button class="btn btn-default" type="button" onclick="formClear()">
										<i class="ace-icon fa fa-check bigger-110"></i>
										새로고침
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="16" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
require_once ("views/modal/itemModal.php");
?>


<script>
// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });
function safetyStock() {
	showAlert("전체 재고조사를 하기 때문에 처리시간이 걸립니다");
	var parameter = {"mode" : "safetyStock"};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function() {
			getData();
		}
	});
}

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );


	var page = $("#page").val();
	getData(page);
	//getOrderWaitingList();
	getItemList();

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {

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
					showAlert("구매요청을 하였습니다");
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
	var parameter = {"mode" : "getSafetyStockList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postData('" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].unit + "');\" style='cursor:pointer'>";

					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					tag += "<td>" + json[i].safety_stock_cnt + "</td>";
					tag += "<td>" + json[i].current_cnt + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='6' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "safety_stock";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function postData(item_cd, item_nm, standard, unit) {
	$("#purchase_item_cd").val(item_cd);
	$("#purchase_item_nm").val(item_nm);
	$("#purchase_standard").val(standard);
	$("#purchase_unit").val(unit);
}

function postItem(item_cd, item_nm, standard, unit) {
	$("#purchase_item_cd").val(item_cd);
	$("#purchase_item_nm").val(item_nm);
	$("#purchase_standard").val(standard);
	$("#purchase_unit").val(unit);
	hideModal('itemModal');
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
</script>