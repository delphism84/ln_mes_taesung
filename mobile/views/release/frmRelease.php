<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<!-- 검색 모달 -->
		<div class="wrap_search_pop">	
			<div class="search_pop_content">
				<div class="input-group" style="width:100%;">
					<div class="col-xs-12">
						<?
							echo "<div style='width:100%;' >";								
							echo "<select name='search_classify' id='search_classify' onchange='search(this.value)' style='width:100%; margin-bottom:10px;'>";
							echo "<option value='0'>== 처리상태 ==</option>";
							echo "<option value='출고요청'>출고요청</option>";
							echo "<option value='부분출고'>부분출고</option>";
							echo "<option value='출고완료'>출고완료</option>";
							echo "</select>";
							echo "</div>";
						?>
					</div>							
				</div>		
			</div>	
		</div>
		<!-- //검색 모달 -->
		<div class="page-content">
			<div>
				<div class="col-xs-12">
					<div>
						<?
						/*
						if($_SESSION['login_level'] >= 99) {
							echo "<div style='' >";								
							echo "<select name='search_classify' id='search_classify' onchange='search(this.value)' style='width:100%; margin-bottom:10px;'>";
							echo "<option value='0'>== 처리상태 ==</option>";
							echo "<option value='출고요청'>출고요청</option>";
							echo "<option value='부분출고'>부분출고</option>";
							echo "<option value='출고완료'>출고완료</option>";
							echo "</select>";
							echo "</div>";
							echo "<div style='float:right'>";
							//echo "<input type='button' class='btn btn-xs btn-danger' value='선택삭제' data-toggle='modal' data-target='#confirm-delete' />";
							echo "</div>";
							echo "<input type='button' class='btn btn-xs btn-pink' value='출고요청목록' />";	
							$this->table("tb","구분=>1,품번=>1,품명=>2,규격=>1,단위=>1,요청수량=>1,잔여출고수량=>1,요청공정,요청설비,요청팀,처리상태=>1,요청일");
						} else {
							echo "<div style='float:left'>";
							echo "<input type='button' class='btn btn-xs btn-pink' value='출고요청목록' />";
							echo "<select name='search_classify' id='search_classify' onchange='search(this.value)' style='margin-left:5px'>";
							echo "<option value='0'>== 처리상태 ==</option>";
							echo "<option value='출고요청'>출고요청</option>";
							echo "<option value='부분출고'>부분출고</option>";
							echo "<option value='출고완료'>출고완료</option>";
							echo "</select>";
							echo "</div>";
							
							$this->noCheckTable("tb","구분=>1,품번=>1,품명=>2,규격=>1,단위=>1,요청수량=>1,잔여출고수량=>1,요청공정,요청설비,요청팀,처리상태=>1,요청일");
							
						}
						*/							
							echo "<div style='float:right'>";
							//echo "<input type='button' class='btn btn-xs btn-danger' value='선택삭제' data-toggle='modal' data-target='#confirm-delete' />";
							echo "</div>";
							echo "<input type='button' class='comm_title' value='출고요청목록' />";								
						$this->noCheckTable("tb","구분=>2,품번=>2,품명=>3,처리상태=>2");
						$this->paging();
						?>
					</div>
					<div>
						<!--
						<div>
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
						<div class="col-xs-12" style="padding-top:10px">
							<div>
								<form id='frm'>
									<input type="hidden" name="mode" id="mode" value="registReleaseItem" />										
									<input type="hidden" name="uid" id="uid" />
									<input type="hidden" name="stock" id="stock" />
									<input type="hidden" name="warehouse" id="warehouse" validation="yes" err="출고시킬 창고를 선택하세요" />
									<input type="hidden" name="warehouse_uid" id="warehouse_uid" />
									<input type="hidden" name="release_cnt" id="release_cnt" />
									<div>
										<div><input type="button" class="btn btn-xs btn-pink" value="출고등록" /></div>
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
												<td class="col-xs-4"><input type="text" class="onlynum comma" name="cnt" id="cnt" validation="yes" err="출고수량을 입력하세요" /></td>
											</tr>
											<tr>
												<? $this->th("LOT NO") ?>
												<td colspan="3"><input type="text" class="form-control" name="lot_no" id="lot_no" validation="yes" err="Lot No가 없습니다" readonly /></td>
												<!--<? $this->th("출고 LOT NO") ?>
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


<!-- 상세보기 -->
<div class="modal fade" id="viewReleaseModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">상세보기</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style='height:70%'>
			<!-- 내용 -->
				<form id="frm">
					<input type="hidden" name="uid" id="uid"/>
					<table class="table table-bordered">
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; width:100px;"><i class="ace-icon fa fa-caret-right blue"></i>구분</th>
							<td><span id="r_classify"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>품번</th>
							<td><span id="r_item_cd"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>품명</th>
							<td><span id="r_item_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>규격</th>
							<td><span id="r_standard"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>단위</th>
							<td><span id="r_unit"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>요청수량</th>
							<td><span id="r_cnt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>잔여출고수량</th>
							<td><span id="r_remain_cnt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>요청공정</th>
							<td><span id="r_process_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>요청설비</th>
							<td><span id="r_machine_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>요청팀</th>
							<td><span id="r_team_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>처리상태</th>
							<td><span id="r_state"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>요청일</th>
							<td><span id="r_create_dt"></span></td>
						</tr>
					</table>

				</form>
			<!-- 내용 -->
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

<input type="hidden" name="per" id="per" value="7" />

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
			if(Number(uncomma($("#cnt").val())) > Number(uncomma($("#stock").val()))) {
				showAlert("출고수량이 해당 창고의 재고수량보다 클 순 없습니다");
				$("#cnt").val(uncomma(comma($("#stock").val())));
				return false;
			}

			if(Number(uncomma($("#cnt").val())) > Number(uncomma($("#release_cnt").val()))) {
				showAlert("출고요청 수량보다 더 많은 수량을 출고할 수 없습니다.");
				$("#cnt").val(uncomma(comma($("#release_cnt").val())));
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
	deleteSelect("releases");
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
	$("#release_cnt").val("");
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



// setInterval(function() {
// 	getData(1);
// }, 1000); // 1초에 한번

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
					/*
					if(json[i].state != "출고완료") {
						tag += "<tr onclick=\"toggle(this); postItem(" + json[i].uid + ",'" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].unit + "', " + json[i].process + ", '" + json[i].process_nm + "', " + json[i].machine + ", '" + json[i].machine_nm + "', " + json[i].team + ", '" + json[i].team_nm + "', '" + json[i].remain_cnt + "');\" style='cursor:pointer'>";
					} else {
						tag += "<tr>";
					}
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					*/
					tag += "<tr onclick='toggle(this); postData(" + json[i].uid + ");' style='cursor:pointer'>";
					tag += "<td>" + json[i].classify + "</td>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					//tag += "<td>" + json[i].standard + "</td>";
					//tag += "<td>" + json[i].unit + "</td>";
					//tag += "<td>" + json[i].cnt + "</td>";
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
				tag = "<tr><td colspan='13' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "releases";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//상세보기
function postData(uid) {
	$("#uid").val(uid);
	var parameter = {"mode" : "getRelease", "uid" : uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#r_classify").html(json.classify);
			$("#r_item_cd").html(json.item_cd);
			$("#r_item_nm").html(json.item_nm);
			$("#r_standard").html(json.standard);
			$("#r_unit").html(json.unit);
			$("#r_cnt").html(comma(json.cnt));
			$("#r_remain_cnt").html(comma(json.remain_cnt));
			$("#r_process_nm").html(json.process_nm);
			$("#r_machine_nm").html(json.machine_nm);
			$("#r_team_nm").html(json.team_nm);
			$("#r_state").html(json.state);
			$("#r_create_dt").html(json.create_dt);
		}
	});
	showModal('viewReleaseModal');
}
//==================================================
// 선택한 품목 처리
//==================================================
function postItem(uid, item_cd, item_nm, standard, unit, process, process_nm, machine, machine_nm, team, team_nm, release_cnt) {
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
	$("#release_cnt").val(uncomma(release_cnt));
	$("#cnt").val(release_cnt);

	getWhere(item_cd, standard)
}

function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
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
					
					tag += "<tr onclick=\"where_toggle(this); postCnt('" + json[i].cnt + "', '" + json[i].lot_no + "', '" + item_cd + "', " + json[i].warehouse + ", " + json[i].uid + ")\" style='cursor:pointer'>";
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


function postCnt(cnt, lot_no, item_cd, warehouse, warehouse_uid) {
	$("#stock").val(uncomma(cnt));
	//$("#purchase_lot_no").val(lot_no);
	$("#lot_no").val(lot_no);
	$("#warehouse").val(warehouse);
	$("#warehouse_uid").val(warehouse_uid);
	//$("#cnt").val(cnt);
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
	var search_classify = $("#search_classify option:selected").val();
	
	if(search_classify == 0) {
		$("#where").val("");
	} else {
		$("#where").val(" where state like '%" + search_classify + "%'");
	}
	
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

$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1);
	});
});
</script>