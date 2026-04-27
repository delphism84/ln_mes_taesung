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
					<div class="col-xs-12" style="width:100%;">
						<div class="daily_box" style="width:100%;">													
							<select name="process" id="process" onchange="getMachine(this.value)" style="float:left; height:35px;width:100%; border:1px solid #ddd;">
								<option value='0'>==선택==</option>
							</select>
							<select name="machine" id="machine" style="float:left; height:35px;width:100%; margin-top:10px;">
								<option value='0'>==선택==</option>
							</select>
						</div>
						<div style="width:100%;">
							<span class="input-icon input-icon-right" style="margin-top:10px;width:100%;">
								<div class="input-group" style="width:100%;">
									<input class="date-picker"name="work_dt" id="work_dt" type="text" data-date-format="yyyy-mm-dd" value="<?=date("Y-m-d")?>" readonly/ style="height:37px; float:left;width:70%;">
									<span style="float:left; background-color:#ddd; padding:12px 0;width:15%; text-align:center;font-size:14px;">							
										<i class="fa fa-calendar"></i>
									</span>
									<input type="button" class="report_search_btn" value="검색" onclick="getData(1)" /style="width:15%;float:left;">
								</div>
							</span>
						</div>				
					</div>							
				</div>		
			</div>	
		</div>
		<!-- //검색 모달 -->
		<div class="page-content">			
			<div class="col-xs-12">	
				<div  class="daily_div">
					<input type='button' class='comm_title' value='작업내역'/>					
				</div>
				<?
					$this->noCheckTable("tb","작업일자,공정,작성자");
					//$this->paging();
				?>					
				
				<!--
				<div class="col-xs-12">
					<div>
						<table width="100%" border="0" cellspacing="0" cellpadding="9">
							<tr>
								<td>
									<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
										<tr>
											<td align="center" valign="top" class=border_body>
												
												<div>
													<table class="table table-bordered">
														<tr>
															<td style="vertical-align:middle; text-align:center; text-align:left;" colspan="2">
																<span style="font-size:15px;">회사명</span> : <span style="font-size:15px;">작 업 일 보</span>
															</td>																
														</tr>
														<tr>
																				
															<td style=" background-color:#f1f1f1; width:30%;">문서번호</td>
															<td ></td>
														</tr>
														<tr>
															<td style="background-color:#f1f1f1">작성자</td>
															<td></td>
														</tr>
														<tr>
															<td style="background-color:#f1f1f1">작성일자</td>
															<td></td>
														</tr>
													</table>
												</div>
												
												<div>
													<div class="col-xs-12" style="padding-top:10px; margin-bottom:10px;">아래와 같이 작업일보를 제출합니다</div>
													<div>													
														<table class="table table-bordered">
															<tr>
																<td rowspan="3" style="width:50px; vertical-align:middle; background-color:#f1f1f1">결<br>재</td>
																<td style="background-color:#f1f1f1"></td>
																<td style="background-color:#f1f1f1"></td>
																<td style="background-color:#f1f1f1"></td>
																<td style="background-color:#f1f1f1"></td>
															</tr>
															<tr>
																<td style="height:80px"></td>
																<td></td>
																<td></td>
																<td></td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
															</tr>
														</table>
													</div>
												</div>

												<div>
													<table class="table table-bordered" id="work_paper">
														<thead>
															<tr>
																<td style="background-color:#e5e4e8">품번</td>
																<td style="background-color:#e5e4e8">품명</td>
																<td style="background-color:#e5e4e8">규격</td>
																<td style="background-color:#e5e4e8">단위</td>
																<td style="background-color:#e5e4e8">생산수량</td>
															</tr>
														</thead>
														<tbody></tbody>														
													</table>
												</div>
											</td>
										</tr>
									</table>
									-->
									<!-- 내용들어가는테이블하단 시작 -->
									<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="13" background="/shopuser/cart_img/bottom_bg.gif"><img src="/shopuser/cart_img/bottom_left.gif" width="13" height="13"></td>
											<td background="/shopuser/cart_img/bottom_bg.gif"><img src="/shopuser/cart_img/bottom_bg.gif" width="13" height="13"></td>
											<td width="13" align="right" background="/shopuser/cart_img/bottom_bg.gif"><img src="/shopuser/cart_img/bottom_right.gif" width="13" height="13"></td>
										</tr>
									</table>
									<!-- 내용들어가는테이블하단 끝 -->

								</td>
							</tr>
						</table>

					</div>					
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="per" id="per" value="5" />
<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
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
	getProcess();
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
});

// 공정가져오기
function getProcess() {
	var parameter = {"mode" : "getProcess"};
	var tag = "<option value='0'>==선택==</option>";
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json){
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<option value='" + json[i].uid + "'>" + json[i].process_nm + "</option>";
			}

			$("#process").html(tag);
		}
	});
}

// 작업설비 가져오기
function getMachine(process) {
	var parameter = {"mode" : "getMachine", "process" : process};
	var tag = "<option value='0'>==선택==</option>";
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json){
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<option value='" + json[i].uid + "'>" + json[i].machine_nm + "</option>";
			}

			$("#machine").html(tag);
		}
	});
}

//==================================================
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("work_daily");
	hideModal("confirm-delete");
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
	var process = $("#process option:selected").val();
	var machine = $("#machine option:selected").val();
	var work_dt = $("#work_dt").val();

	//var parameter = {"mode" : "getWorkDailyList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};
	var parameter = {"mode" : "getWorkDailyList", "process" : process, "machine" : machine, "work_dt" : work_dt};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postData(" + json[i].uid + ");\" style='cursor:pointer'>";
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
					tag += "<td>" + json[i].create_dt + "</td>";
					tag += "<td>" + json[i].process_nm + "</td>";
					//tag += "<td>" + json[i].machine_nm + "</td>";
					//tag += "<td>" + json[i].team_nm + "</td>";
					tag += "<td>" + json[i].emp_nm + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "work_daily";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//==================================================
// 선택한 작업일지 처리
//==================================================
function postData(uid) {	
	var tag = "";	
	var parameter = {"mode" : "getWorkMakeItem", "uid" : uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {
				tag += "<tr>";
				tag += "<td>" + json[i].item_cd + "</td>";
				tag += "<td>" + json[i].item_nm + "</td>";
				tag += "<td>" + json[i].standard + "</td>";
				tag += "<td>" + json[i].unit + "</td>";
				tag += "<td>" + json[i].cnt + "</td>";
				tag += "</tr>";
			}			

			if(i < 15) {
				for(var k = 0 ; k < 15-i ; k++){
					tag += "<tr><td style='height:30px'></td><td></td><td></td><td></td><td></td></tr>";
				}
			}
		} else {
			tag1 += "<tr><td colspan='5' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#work_paper tbody").html(tag);		
	});
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
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1);
	});
});
</script>