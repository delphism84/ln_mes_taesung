<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<!-- 검색 모달 -->
		<div class="wrap_search_pop">	
			<div class="search_pop_content">
				<div class="input-group">
					<div class="col-xs-12">
						<? $this->per("getData(1)", "float:left; height:35px;",7,7); ?>
						<? $this->createDbSelectBox("item_classify","classify_nm","","setItem"); ?>	
						<select style="height:35px; float:left; width:41.5%;">
							<option>선택</option>
							<option>제품번호</option>
							<option>품명</option>
							<option>거래처</option>
						</select>					
						<input type="text" name="search_txt" id="search_txt" style="height:35px; width:85%; margin-top:10px; float:left;" />
						<input type="button" class="btn btn-xs btn-purple" onclick="search()" value="검색" style="height:35px; margin-top:10px; float:left; width:15%;" />
					</div>							
				</div>		
			</div>	
		</div>
		<!-- //검색 모달 -->
		<div class="page-content">			
			<div>
				<div class="col-xs-12">
					<div>
						<div class="release_div">							
							<input type="button" class="comm_title" value="사급자재 출고요청목록" />							
						</div>
						<!--<? $this->table("tb","구분=>1,품번=>1,품명=>2,규격=>1,단위=>1,요청수량=>1,잔여수량=>1,요청공정,요청설비,요청팀,처리상태=>1,요청일"); ?>-->

						
						<table class="table table-bordered table-striped" id="tb">
						<thead>
							<tr>
								<th class="detail-col center">
									구분
								</th>
								<!--
								<th class="detail-col center">
									품번
								</th>
								-->
								<th class="detail-col center">
									품명
								</th>
								<!--
								<th class="detail-col center">
									규격
								</th>
								<th class="detail-col center">
									단위
								</th>
								-->
								<th class="detail-col center">
									요청수량
								</th>
								<!--
								<th class="detail-col center">
									잔여수량
								</th>
								<th class="detail-col center">
									요청공정
								</th>
								<th class="detail-col center">
									요청설비
								</th>
								
								<th class="detail-col center">
									요청팀
								</th>
								-->
								<th class="detail-col center">
									처리상태
								</th>
								<!--
								<th class="detail-col center">
									요청일
								</th>
								-->
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>

						<? $this->paging() ?>
					</div>
					<!--
					<div style="border-top:1px solid #ccc; height:350px; padding-top:10px; padding-right:10px">
						<!--
						<div class="col-xs-6" style="height:320px; overflow: scroll; overflow-x: hidden; padding-top:10px; padding-right:10px">
							<div>
								<div style="float:left"><input type="button" class="btn btn-xs btn-pink" value="보관위치" /></div>
							</div>
							<div style="clear:both">
								<table id="order_waiting_tb" class="table table-bordered">
									<thead class="thin-border-bottom">
										<tr>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 위치</th>
											<th><i class="ace-icon fa fa-caret-right blue"></i> 재고수량</th>
											<th><i class="ace-icon fa fa-caret-right blue"></i> Lot No</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
						-->
						<!--
						<div class="col-xs-6" style="height:320px; padding-top:10px">
							<div>
								<form id='frm'>
									<input type="hidden" name="mode" id="mode" value="registReleaseItem" />
									<input type="hidden" name="uid" id="uid" />
									<input type="hidden" name="stock" id="stock" />
									<input type="hidden" name="warehouse" id="warehouse" validation="yes" err="출고시킬 창고를 선택하세요" />
									<input type="hidden" name="warehouse_uid" id="warehouse_uid" />
									<div>
										<table class="table table-bordered">
											<tr>
												<? $this->th("품번") ?>
												<td class="col-xs-4"><input type="text" name="item_cd" id="item_cd" validation="yes" err="출고시킬 품목을 선택하세요" readonly /></td>
												<? $this->th("품명") ?>
												<td class="col-xs-4"><input type="text" name="item_nm" id="item_nm" readonly /></td>
											</tr>
											<tr>
												<? $this->th("규격") ?>
												<td class="col-xs-4"><input type="text" name="standard" id="standard" readonly /></td>
												<? $this->th("단위") ?>
												<td class="col-xs-4"><input type="text" name="unit" id="unit" readonly /></td>
											</tr>
											<tr>
												<? $this->th("요청공정") ?>
												<td class="col-xs-4"><input type='hidden' name='process' id='process' validation="yes" err="출고품 도착공정이 없습니다" /><input type="text" name="process_nm" id="process_nm" readonly /></td>
												<? $this->th("요청설비") ?>
												<td class="col-xs-4"><input type='hidden' name='machine' id='machine' /><input type="text" name="machine_nm" id="machine_nm" readonly /></td>
											</tr>
											<tr>
												<? $this->th("요청팀") ?>
												<td class="col-xs-4"><input type='hidden' name='team' id='team' /><input type="text" name="team_nm" id="team_nm" readonly /></td>
												<? $this->th("출고수량") ?>
												<td class="col-xs-4"><input type="text" class="onlynum" name="cnt" id="cnt" validation="yes" err="출고수량을 입력하세요" /></td>
											</tr>
											<tr>
												<? $this->th("LOT NO") ?>
												<td colspan="3"><input type="text" class="form-control" name="lot_no" id="lot_no" validation="yes" err="Lot No가 없습니다" readonly /></td>
												<? $this->th("출고 LOT NO") ?>
												<td class="col-xs-4"><input type="text" class="form-control" name="lot_no" id="lot_no" validation="yes" err="출고 Lot No가 없습니다" readonly /></td>
											</tr>
										</table>
									</div>
									<div class="col-md-12 center">
										<button class="btn btn-info" type="button" id="btnSubmit">
											<i class="ace-icon fa fa-check bigger-110"></i>
											<span id="btnSubmitTxt">자재출고</span>
										</button>
										<button class="btn btn-default" type="button" onclick="formClear()">
											<i class="ace-icon fa fa-check bigger-110"></i>
											새로고침
										</button>
									</div>
								</form>
							</div>
						</div>
						-->
						
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>



<?
$this->hidden("where purchase_type='사급'");
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
			if(Number($("#cnt").val()) > Number($("#stock").val())) {
				showAlert("출고수량이 해당 창고의 재고수량보다 클 순 없습니다");
				return false;
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
					getData($("#page").val());
					getWhere();
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
	//$("#frm")[0].reset();
	$("#uid").val("");
	$("#stock").val("");
	$("#item_cd").val("");
	$("#item_nm").val("");
	$("#standard").val("");
	$("#unit").val("");
	$("#process").val("");
	$("#process_nm").val("");
	$("#machine").val("");
	$("#machine_nm").val("");
	$("#team").val("");
	$("#team_nm").val("");
	$("#lot_no").val("");
	$("#cnt").val("");
	//$("#purchase_lot_no").val("");
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
// 선택된 품목 테이블 선택된 TR 색상 바꾸기
//==================================================
function where_toggle(it) {
	$("#order_waiting_tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

//==================================================
// 출고요청목록 리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getReleaseList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					if(json[i].state != "출고완료") {
						tag += "<tr onclick=\"toggle(this); postItem(" + json[i].uid + ",'" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].unit + "', " + json[i].process + ", '" + json[i].process_nm + "', " + json[i].machine + ", '" + json[i].machine_nm + "', " + json[i].team + ", '" + json[i].team_nm + "');\" style='cursor:pointer'>";
					} else {
						tag += "<tr>";
					}
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
					tag += "<td>" + json[i].classify + "</td>";
					t//ag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					//tag += "<td>" + json[i].standard + "</td>";
					//tag += "<td>" + json[i].unit + "</td>";
					tag += "<td>" + comma(json[i].cnt) + "</td>";
					//tag += "<td>" + json[i].remain_cnt + "</td>";
					//tag += "<td>" + json[i].process_nm + "</td>";
					//tag += "<td>" + json[i].machine_nm + "</td>";
					//tag += "<td>" + json[i].team_nm + "</td>";

					switch(json[i].state) {
						case "출고요청" : var color = "black"; break;
						case "부분출고" : var color = "green"; break;
						case "출고완료" : var color = "red"; break;
					}

					tag += "<td><span style='color:" + color + "'>" + json[i].state + "</span></td>";
					//tag += "<td>" + json[i].create_dt + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='12' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "releases";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function postItem(uid, item_cd, item_nm, standard, unit, process, process_nm, machine, machine_nm, team, team_nm) {
	$("#uid").val(uid);
	$("#item_cd").val(item_cd);
	$("#item_nm").val(item_nm);
	$("#standard").val(standard);
	$("#unit").val(unit);
	$("#process").val(process);
	$("#process_nm").val(process_nm);
	$("#machine").val(machine);
	$("#machine_nm").val(machine_nm);
	$("#team").val(team);
	$("#team_nm").val(team_nm);

	getWhere(item_cd, standard)
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
// 보관위치 가져오기
//==================================================
function getWhere(item_cd, standard){
	var tag = "";
	var parameter = {"mode" : "getWhere", "item_cd" : item_cd, "standard" : standard};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"where_toggle(this); postCnt(" + json[i].cnt + ", '" + json[i].lot_no + "', '" + item_cd + "', " + json[i].warehouse + ", " + json[i].uid + ", " + json[i].cnt + ")\" style='cursor:pointer'>";
					tag += "<td>" + json[i].warehouse_nm + "</td>";
					tag += "<td>" + json[i].cnt + "</td>";
					tag += "<td>" + json[i].lot_no + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#order_waiting_tb tbody").html(tag);
		}
	);
}


function postCnt(cnt, lot_no, item_cd, warehouse, warehouse_uid, cnt) {
	$("#stock").val(cnt);
	//$("#purchase_lot_no").val(lot_no);
	$("#lot_no").val(lot_no);
	$("#warehouse").val(warehouse);
	$("#warehouse_uid").val(warehouse_uid);
	$("#cnt").val(cnt);
	//createLotNo(item_cd);
}

function createLotNo(item_cd) {
	var process = $("#process").val();
	var parameter = {"mode" : "createLotNo", "type" : "R", "item_cd" : item_cd, "process" : process}
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			$("#lot_no").val(str);
		}
	});
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

//검색
$(function(){
	$('.release_search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1);
	});
});
</script>