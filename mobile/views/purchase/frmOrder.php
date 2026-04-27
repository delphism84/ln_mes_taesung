<?
require_once("library/caseby.php");
$sql = "select * from company";
$this->query($sql);
$company = $this->fetch();
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<!-- 검색 모달 -->
		<div class="wrap_search_pop">	
			<div class="search_pop_content">
				<div class="input-group" style="width:100%;">
					<input type="hidden" name="mode" id="mode" value="sumOrder" />
					<div class="col-xs-12">
						<?
						if($_SESSION['login_level'] >= 99) {			
							
							echo "<div style='float:left; width:100%;'>";																	
							echo "<select name='search_classify' id='search_classify' onchange='setClassify(this.value)' style='height:35px; width:100%;'>";
							echo "<option value='0'>=진행상태=</option>";
							echo "<option value='발주'>발주</option>";
							//echo "<option value='외주발주'>외주발주</option>";
							echo "<option value='입고완료'>입고완료</option>";
							echo "</select>";
							echo "<input type='text' class='search-query search_input' name='search_txt' id='search_txt'/>";
							echo "<button type='button' class='search_btn' onclick='search()'>";
							echo "<span class='fa fa-search icon-on-right bigger-110'></span>";
							echo "</button>";
							echo "<button type='button' class='search_refresh' onclick='refresh()'>";
							echo "<span class='fa fa-refresh icon-on-right bigger-110'></span>";
							echo "</button>";									
							echo "</div>";
							
							echo "<div style='float:right;'>";
							//echo "<input type='button' class='btn btn-xs btn-danger' value='선택삭제' data-toggle='modal' data-target='#confirm-delete' style='height:35px' />";
							echo "</div>";				
							//$this->table("tb","발주코드=>2,거래처=>5,진행상태=>2,발주일=>2,수신=>1");
						} else {
							echo "<div style='float:left'>";
							echo "<input type='button' class='btn btn-xs btn-pink' value='발주리스트' style='height:35px; margin-right:5px' />";									
							echo "<select name='search_classify' id='search_classify' onchange='setClassify(this.value)' style='height:35px; margin-right:3px'>";
							echo "<option value='0'>=진행상태=</option>";
							echo "<option value='발주'>발주</option>";
							//echo "<option value='외주발주'>외주발주</option>";
							echo "<option value='입고완료'>입고완료</option>";
							echo "</select>&nbsp;";
							echo "<input type='text' class='search-query' name='search_txt' id='search_txt' style='height:35px'/>";
							echo "<button type='button' class='btn btn-purple btn-sm' onclick='search()' style='height:35px; margin-bottom:3px'>";
							echo "<span class='fa fa-search icon-on-right bigger-110'></span>";
							echo "</button>";
							echo "<button type='button' class='btn btn-success btn-sm' onclick='refresh()' style='height:35px; margin-bottom:3px'>";
							echo "<span class='fa fa-refresh icon-on-right bigger-110'></span>";
							echo "</button>";									
							echo "</div>";

							//$this->noCheckTable("tb","발주코드=>2,거래처=>5,진행상태=>2,발주일=>2,수신=>1");
						}
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
							<form id="order">
								<input type="hidden" name="mode" id="mode" value="sumOrder" />
								<?
								echo "<input type='button' class='comm_title' value='발주리스트' style='float:left'  />";
								$this->noCheckTable("tb","거래처=>4,상태=>2,발주일=>3");
								$this->paging();
								?>
							<div style="clear:both"></div>
						</div>
					<!--
					<div>
						
						<div>
							<input type="button" class="btn btn-xs btn-pink" value="발주품목" /></div>
							<? $this->noCheckTable("item_tb","품번=>2,품목명=>2,발주수량=>2,입고희망일=>2,잔여입고수량=>2,상태=>1"); ?>
						</div>
						
					</div>
					-->
					<!--
					<div class="col-xs-12">
						<div>
							<table width="100%" border="0" cellspacing="0" cellpadding="9">
								<tr>
									<td>
										<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
											<tr>
												<td align="center" valign="top" class=border_body>
										
													<table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td style="text-align:center; padding-top:10px; padding-bottom:20px"><h1><u>&nbsp;&nbsp;발&nbsp;&nbsp;주&nbsp;&nbsp;서&nbsp;&nbsp;</u></h1></td>
														</tr>
													</table>																					

													<table width="100%"  border="0" cellpadding="0" cellspacing="0">
														<tr>
															<td width="18" height="25"><img src="/shopuser/cart_img/estimate_icon.gif" width="7" height="11" hspace="3"></td>
															<td width="51" style="text-align : justify">번&nbsp;&nbsp;&nbsp;호 :</td>
															<td style="padding-left:10"><span id="order_cd"></span></td>
														</tr>
														<tr>
															<td width="18" height="25"><img src="/shopuser/cart_img/estimate_icon.gif" width="7" height="11" hspace="3"></td>
															<td width="51" style="text-align : justify">회사명 :</td>
															<td style="padding-left:10"><span id="account_nm"></span></td>
														</tr>
														<tr>
															<td colspan="3" background="/shopuser/cart_img/estimate_line01.gif" height="1"></td>
														</tr>
														<tr>
															<td height="25"><img src="/shopuser/cart_img/estimate_icon.gif" width="7" height="11" hspace="3"></td>
															<td style="text-align : justify">일<img src="/shopuser/common_img/space.gif" width="12" height="1">자 :</td>
															<td style="padding-left:10"><span id='create_dt'><?=date("Y-m-d")?></span></td>
														</tr>
														<tr>
															<td colspan="3" background="/shopuser/cart_img/estimate_line01.gif" height="1"></td>
														</tr>
														<tr>
															<td height="25"><img src="/shopuser/cart_img/estimate_icon.gif" width="7" height="11" hspace="3"></td>
															<td style="text-align : justify">금<img src="/shopuser/common_img/space.gif" width="12" height="1">액 :</td>
															<td style="padding-left:10"><span id="total_cost"></span> 원</td>
														</tr>
													</table>															

													<table id="simple-table" class="table  table-bordered table-hover">
														<col width=20%></col><col></col><col width=20%></col><col></col>
														<tr bgcolor="efefef">
															<td colspan="4"><strong>발주서 정보</strong></td>
														</tr>
														<tr>
															<td width="21%" bgcolor="f7f7f7">사업자번호</td>
															<td colspan="3"><span class="black"><?=$company->business_no?></span></td>
														</tr>
														<tr>
															<td bgcolor="f7f7f7">상호명</td>
															<td width="29%"><span class="black"><?=$company->corp_nm?></span></td>
															<td width="10%" bgcolor="f7f7f7">대표</td>
															<td width="40%">
																<div style="position:absolute; z-index:2; margin-top:-20px; margin-left:70px">
																	<img src="attach/1526100535sign.gif" style='width:50px; hegith:50px'/>
																</div>
																<div>
																	<span class="black"><?=$company->owner?></span>
																</div>
															</td>
														</tr>
														<tr>
															<td bgcolor="f7f7f7">주소</td>
															<td colspan="3"><span class="black"><?=$company->address?></span></td>
														</tr>
														<tr>
															<td bgcolor="f7f7f7">업태</td>
															<td><span class="black"><?=$company->corp_type?></span></td>
															<td bgcolor="f7f7f7">종목</td>
															<td><span class="black"><?=$company->corp_event?></span></td>
														</tr>
														<tr>
															<td bgcolor="f7f7f7">대표전화</td>
															<td><span class="black"><?=$company->telephone?></span></td>
															<td bgcolor="f7f7f7">fax</td>
															<td><span class="black"><?=$company->fax?></span></td>
														</tr>
													</table>

															
													<table class="table  table-bordered table-hover">
														<tr>
															<th class='col-xs-1' bgcolor="efefef">배송지</th>
															<td><span id='address'></span></td>
														</tr>
													</table>

													<table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td>

																<table id="order_paper" class="table  table-bordered table-hover">
																	<thead>
																		<tr align="center" bgcolor="efefef">
																			<td class="col-xs-4">모델명</td>
																			<td class="col-xs-2">공급단가</td>
																			<td class="col-xs-2">수량</td>
																			<td class="col-xs-2">소계</td>
																			<td class="col-xs-2">비고</td>
																		</tr>
																	</thead>
																	<tbody></tbody>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										-->
										<!-- 내용들어가는테이블하단 시작 -->
										<!--
										<table width="100%"  border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="13" background="/shopuser/cart_img/bottom_bg.gif"><img src="/shopuser/cart_img/bottom_left.gif" width="13" height="13"></td>
												<td background="/shopuser/cart_img/bottom_bg.gif"><img src="/shopuser/cart_img/bottom_bg.gif" width="13" height="13"></td>
												<td width="13" align="right" background="/shopuser/cart_img/bottom_bg.gif"><img src="/shopuser/cart_img/bottom_right.gif" width="13" height="13"></td>
											</tr>
										</table>
										-->
										<!-- 내용들어가는테이블하단 끝 -->
									<!--
									</td>
								</tr>
							</table>
							
						</div>
					</div>
					-->
				</div>
			</div>
		</div>
	</div>
</div>

<!--발주품목 MODAL-->
<div class="modal fade" id="viewOrderItemModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">상세보기</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:400px; overflow:scroll; overflow-x:hidden">
				<div>						
					<table class="table table-bordered">
						<tr>
							<th colspan="4" style="background-color:#ccc">발주 정보</th>
						</tr>
						<tr>
							<? $this->th("거래처") ?>
							<td><input type="hidden" name="account_cd2" id="account_cd2" /><input type="text" class="form-control" name="account_nm2" id="account_nm2" readonly /></td>
						</tr>
					<table>
					
					<table class="table table-bordered" id="obtain_item_tb2">
						<thead>
							<tr>
								<? $this->th("품번") ?>
								<? $this->th("품명") ?>
								<? $this->th("발주수량") ?>
								<? $this->th("입고희망일") ?>
								<? //$this->th("잔여입고수량") ?>
								<? $this->th("상태") ?>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
					<!--
					<table class="table table-bordered" id="obtain_item_tb2">
						<thead>
							<tr>
								<th colspan="12" style="background-color:#ccc">구매 품목</th>
							</tr>
							<tr>
								<? $this->th("품번") ?>
								<? $this->th("품명") ?>
								<? //$this->th("규격") ?>
								<? //$this->th("단위") ?>
								<? $this->th("수량") ?>
								<? //$this->th("구매단가") ?>
								<? $this->th("합계금액") ?>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
					-->
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


</form>



<input type="hidden" name="per" id="per" value="10" />

<?
$this->hidden("where status !='외주발주'");
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>


<script>
function refresh() {
	$("#search_classify").val(0);
	$("#search_txt").val("");
	$("#page").val(1);
	$("#where").val("where state!='외주발주'");
	getData(1);
}

function setClassify(classify){
	$("#where").val("where state='" + classify + "'");
	getData(1);
}

function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

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
	/*
	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			if($("#cnt").val() > 0) {
				if($("#warehouse_cd option:selected").val() == 0) {
					showAlert("기초재고 수량을 입고시킬 창고를 선택하세요");
					return;
				}
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
	*/

});



//==================================================
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("orders");
	hideModal("confirm-delete");
	formClear();
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#uid").val("");
	$("#account_nm").html("");
	$("#order_cd").html("");
	$("#create_dt").html("");
	$("#address").html("");
	$("#order_paper tbody").html("");
	$("#item_tb tbody").html("");

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
	var parameter = {"mode" : "getOrderList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postData(" + json[i].uid + ",'" + json[i].account_nm + "', '" + json[i].order_cd + "','" + json[i].create_dt + "', '" + json[i].address + "');\" style='cursor:pointer'>";
					/*
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' name='order_uid[]' id='order_uid' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					*/
					//tag += "<td>" + json[i].order_cd + "</td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "<td>" + json[i].status + "</td>";
					tag += "<td>" + json[i].create_dt + "</td>";
					//tag += "<td>" + json[i].send_receive + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "orders";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

// 선택발주 합치기
function sumOrder() {
	var parameter = $("#order").serialize();

	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "short") {
				showAlert("최소 두개 이상의 발주서를 선택하셔야 합니다");
			}
		}
	});
}

//==================================================
// 선택한 품목 처리
//==================================================
/*
function postData(uid, account_nm, order_cd, create_dt, address) {
	$("#account_nm2").html(account_nm);
	$("#order_cd").html(order_cd);
	$("#create_dt").html(create_dt);
	$("#address").html(address);

	var tag1 = "";
	var tag2 = "";
	var total_cost = 0;
	var parameter = {"mode" : "getOrdersItem", "uid" : uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {

				tag1 += "<tr>";
				tag1 += "<td>" + json[i].item_nm + " (" + json[i].standard + ")</td>";
				tag1 += "<td style='text-align:right'>" + json[i].cost + "</td>";
				tag1 += "<td style='text-align:right'>" + json[i].cnt + "</td>";
				tag1 += "<td style='text-align:right'>" + json[i].total_cost + "</td>";
				tag1 += "<td>" + json[i].delivery_dt + "</td>";
				tag1 += "</tr>";

				total_cost = Number(total_cost) + Number(uncomma(json[i].total_cost));

				tag2 += "<tr>";
				tag2 += "<td>" + json[i].item_cd + "</td>";
				tag2 += "<td>" + json[i].item_nm + " (" + json[i].standard + ")</td>";
				tag2 += "<td>" + json[i].cnt + "</td>";
				tag2 += "<td>" + json[i].delivery_dt + "</td>";
				tag2 += "<td>" + json[i].remain_cnt + "</td>";
				tag2 += "<td>" + json[i].state + "</td>";
				tag2 += "</tr>";
			}
			
			tag1 += "<tr><td colspan='3' style='background-color:#f1f1f1'><strong>합계금액</strong></td><td colspan='2' style='text-align:right; color:red'><strong>" + comma(total_cost) + "</strong></td></tr>";

			$("#total_cost").html(comma(total_cost));

			$("#order_paper tbody").html(tag1);

			$("#item_tb tbody").html(tag2);
		} else {
			
		}
	});
}
*/

function postData(uid, account_nm, order_cd, create_dt, address) {
	$("#account_nm2").val(account_nm);
	var tag = "";
	var total_cost = 0;
	var parameter = {"mode" : "getOrdersItem", "uid" : uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {

				tag += "<tr>";
				tag += "<td>" + json[i].item_cd + "</td>";
				tag += "<td>" + json[i].item_nm + " (" + json[i].standard + ")</td>";
				//tag += "<td>" + json[i].standard + "</td>"
				//tag += "<td>" + json[i].unit + "</td>";
				tag += "<td>" + commaSplit(json[i].cnt) + "</td>";
				tag += "<td>" + json[i].delivery_dt + "</td>";
				//tag += "<td>" + json[i].remain_cnt + "</td>";
				tag += "<td>" + json[i].state + "</td>";
				//tag += "<td>" + commaSplit(json[i].cost) + "</td>";
				//tag += "<td>" + commaSplit(json[i].total_cost) + "</td>";
				tag += "</tr>";
			}
			
			$("#obtain_item_tb2 tbody").html(tag);
		} else {
			
		}
	});

	showModal('viewOrderItemModal');
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

	var search_txt = $("#search_txt").val();

	$("#where").val(" where state!='외주발주' and account_nm like '%" + search_txt + "%'");
	getData(1);
}

$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1);
	});
});
</script>