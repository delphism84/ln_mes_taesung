<?
require_once("library/caseby.php");

$order_cd = $this->createCode("order_cd","obtain_order");
?>

<div class="main-content" >
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content" >
			<div class="row" >
				<div class="col-xs-12">
					<div style="float:left">
						<div class="input-group">
							<div class="col-xs-12">
								<? $this->periodSearch("searchDate()","납기일자검색"); ?>
								<!-- <select name="search_classify" id="search_classify" style="height:35px; margin-left:5px">
									<option value="0">== 선택 ==</option>
									<option value="item_cd">품번</option>
									<option value="item_nm">품명</option>
									<option value="account_nm">거래처</option>
								</select>-->
							</div>
							<div class="col-xs-12">
								<input type="text" name="search_txt" id="search_txt" style="height:35px; width:75%; margin-top:10px; float:left;" />
								<input type="button" class="btn btn-xs btn-purple" onclick="search()" value="검색" style="height:35px; margin-top:10px; float:left;" />
								<button type="button" class="btn btn-success btn-xs" onclick="refresh()" style="height:35px; margin-top:10px; float:left;">
									<span class="fa fa-refresh icon-on-right bigger-110"></span>
								</button>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12" style="margin-top:10px">
					<div class="col-xs-12">

						<div style='float:left'>
						<div><input type='button' class='btn btn-xs btn-pink' value='수주품목 리스트' /></div>
						</div>
						<table class="table table-bordered table-striped" id="tb">
							<thead>
								<tr>
									<th class="detail-col center">
										수주코드
									</th>
									<th class="detail-col center">
										품번
									</th>
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
									<th class="detail-col center">
										거래처
									</th>
									<th class="detail-col center">
										주문수량
									</th>
									<th class="detail-col center">
										재고수량
									</th>
									<th class="detail-col center">
										납기
									</th>
									-->
									<th class="detail-col center">
										상태
									</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>

						<?
						//$this->noCheckTable("tb","수주코드,품번,품명,규격,단위,거래처,주문수량,재고수량,납기,상태");						
						$this->paging();
						?>
					</div>
					<div class="col-xs-12" style="margin-top:10px;">
						<div>
							<input type="button" class="btn btn-xs btn-pink" value="작업공정 리스트" />
						</div>
						<? $this->noCheckTable("process_tb","공정NO,공정명,하위품명,외주구분,필요수량,재고수량,생산할수량"); ?>
					</div>

					<div class="col-xs-12">
						<div><input type="button" class="btn btn-xs btn-pink" value="소요자재 리스트" /></div>
						<? $this->noCheckTable("bom_tb","품목코드,품목명,규격,투입수량,현재고"); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="5" />
<!-- 수주품목 선택시 값을 저장할 필드들 -->
<input type="hidden" name="order_cd" id="order_cd" />
<input type="hidden" name="order_item_cd" id="order_item_cd" />
<input type="hidden" name="order_item_nm" id="order_item_nm" />
<input type="hidden" name="order_standard" id="order_standard" />
<input type="hidden" name="order_account_cd" id="order_account_cd" />
<input type="hidden" name="order_account_nm" id="order_account_nm" />
<input type="text" name="order_delivery_dt" id="order_delivery_dt" />
<input type="hidden" name="order_cnt" id="order_cnt" />
<!-- 작업지시를 할 품목을 위한 필드 -->
<input type="hidden" name="work_item_process" id="work_item_process" />
<input type="hidden" name="work_process" id="work_process" />
<input type="hidden" name="work_item_uid" id="work_item_uid" />
<input type="hidden" name="work_cnt" id="work_cnt" />
<input type="hidden" name="work_item_cd" id="work_item_cd" />
<input type="hidden" name="work_item_nm" id="work_item_nm" />
<input type="hidden" name="work_standard" id="work_standard" />

<input type="text" name="purchase_parent_uid" id="purchase_parent_uid" />
<input type="text" name="purchase_parent_cnt" id="purchase_parent_cnt" />

<?
$this->hidden("where (state='수주' or state='작업지시' or state='작업중')");
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<div class="modal fade" id="purchaseModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:1000px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">구매요청</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:300px">
				<form name="purchaseFrm" id="purchaseFrm">
					<input type="hidden" name="mode" id="mode" value="registPurchase" />
					<input type="hidden" name="purchase_uid" id="purchase_uid" />
					<table class="table table-bordered table-striped">
						<tr>
							<?=$this->th("수주코드")?>
							<td><input type="text" name="purchase_order_cd" id="purchase_order_cd" readonly /></td>
							<?=$this->th("품목")?>
							<td><input type="text" name="purchase_item_nm" id="purchase_item_nm" readonly /></td>
						</tr>
						<tr>
							<?=$this->th("품목코드")?>
							<td><input type="text" name="purchase_item_cd" id="purchase_item_cd" readonly /></td>
							<?=$this->th("규격")?>
							<td><input type="text" name="purchase_standard" id="purchase_standard" /></td>
						</tr>
						<tr>
							<?=$this->th("필요수량")?>
							<td><input type="text" name="purchase_need_cnt" id="purchase_need_cnt" readonly /></td>
							<?=$this->th("현재고")?>
							<td><input type="text" name="purchase_stock_cnt" id="purchase_stock_cnt" readonly /> <input type="button" class="btn btn-xs btn-success" value="계산" onclick="calRequire()" /></td>
						</tr>
						<tr>
							<?=$this->th("구매요청수량")?>
							<td>
								<input type="text" class="comma" name="purchase_cnt" id="purchase_cnt" />
								<select name="purchase_unit" id="purchase_unit">
									<option value="m">m</option>
									<option value="ea">ea</option>
									<option value="매">매</option>
									<option value="kg">kg</option>
								</select>
							</td>
							<?=$this->th("입고희망일")?>
							<td>
								<div>
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class=" date-picker" name="purchase_delivery_dt" id="purchase_delivery_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="입고희망일을 입력하세요" onchange="checkDate()" readonly />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</div>
							</td>
						</tr>
						<tr>
							<?=$this->th("요청부서")?>
							<td>
								<?=$this->createDbSelectBox("department_big","department_nm","big_department_cd","getMiddleDepartment",$_SESSION['big_department']);?>
								<?=$this->createDbSelectBox("department_middle","department_nm","middle_department_cd","getSmallDepartment",$_SESSION['middle_department']);?>
								<?=$this->createDbSelectBox("department_small","department_nm","small_department_cd","",$_SESSION['small_department']);?>
							</td>
							<?=$this->th("요청인")?>
							<td><input type="hidden" name="emp_id" id="emp_id" value="<?=$_SESSION['login_id']?>" /><input type="text" name="emp_nm" id="emp_nm" value="<?=$_SESSION['login_nm']?>" readonly /></td>
						</tr>
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<input type="button" class="btn btn-sm btn-info" value="구매요청등록" onclick="registPurchase()" />
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:red">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel" style="color:white">삭제 확인</h4>
			</div>

			<div class="modal-body">
				<p>선택하신 품목은 이미 구매요청이 등록된 품목입니다.</p>
				<p>추가로 구매요청을 진행하시겠습니까?</p>
				<p class="debug-url"></p>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
				<a class="btn btn-danger btn-ok">추가 구매요청</a>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="workConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:red">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel" style="color:white">삭제 확인</h4>
			</div>

			<div class="modal-body">
				<p>해당 작업은 이미 작업지시가 된 작업입니다.</p>
				<p>추가로 작업지시를 진행하시겠습니까?</p>
				<p class="debug-url"></p>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
				<a class="btn btn-danger btn-ok">추가 작업지시</a>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="workModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:1400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">작업지시</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:650px">
				<form name="workFrm" id="workFrm">
					<input type="hidden" name="mode" id="mode" value="registWork" />
					<input type="hidden" name="command_item_process" id="command_item_process" />
					<input type="hidden" name="command_order_cd" id="command_order_cd" />

					<table class="table table-bordered table-striped">
						<tr>
							<? $this->th("거래처"); ?>
							<td><input type="hidden" name="command_account_cd" id="command_account_cd" /><input type="text" name="command_account_nm" id="command_account_nm" readonly /></td>
							<? $this->th("발주품목"); ?>
							<td><input type="hidden" name="command_item_cd" id="command_item_cd" readonly /><input type="text" name="command_item_nm" id="command_item_nm" readonly /></td>
						</tr>
						<tr>
							<? $this->th("납품일자"); ?>
							<td><input type="text" name="command_delivery_dt" id="command_delivery_dt" readonly /></td>
							<? $this->th("생산품입고위치"); ?>
							<td><select name="command_warehouse" id="command_warehouse"></select>
						</tr>
						<tr>
							<? $this->th("작업품목"); ?>
							<td><input type="hidden" name="command_work_item_cd" id="command_work_item_cd" /><input type="text" name="command_work_item_nm" id="command_work_item_nm" readonly /></td>
							<? $this->th("작업규격"); ?>
							<td><input type="text" name="command_work_standard" id="command_work_standard" readonly /></td>
						</tr>
						<tr>
							<? $this->th("작업일자"); ?>
							<td colspan="3">
								<div>
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class="date-picker" name="work_dt" id="work_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="작업일자를 입력하세요" readonly />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</div>
							</td>						
						</tr>
						<tr>
							<? $this->th("생산설비"); ?>
							<td><? $this->createDbSelectBox("process", "process_nm", "command_work_process", "getWorkMachine"); ?> <? $this->createDbSelectBox("machine", "machine_nm", "command_work_machine","getProgressMachine"); ?></td>
							<? $this->th("생산팀"); ?>
							<td><? $this->createDbSelectBox("team", "team_nm", "command_work_team", ""); ?></td>
						</tr>
						<tr>
							<? $this->th("작업순서"); ?>
							<td><input type="text" class="onlynum" name="command_work_seq" id="command_work_seq" validation="yes" err="작업순서를 입력하세요" /></td>
							<? $this->th("작업지시수량"); ?>
							<td>
								<input type="text" class="onlynum" name="command_work_cnt" id="command_work_cnt" validation="yes" err="작업지시수량을 입력하세요" />
								<select name="command_work_unit" id="command_work_unit">
									<option value='0'>작업단위</option>
									<option value='ea'>ea</option>
									<option value='m'>m</option>
									<option value='매'>매</option>
								</select>
							</td>
						</tr>
						<tr>
							<? $this->th("첨부파일"); ?>
							<td colspan="3">
								<input type="file" name="command_work_attach" id="command_work_attach" />
							</td>
						</tr>
						<tr>
							<? $this->th("비고"); ?>
							<td colspan="3">
								<textarea class="form-control" rows="3" name="work_memo" id="work_memo"></textarea>
							</td>
						</tr>
					</table>
				</form>
				<div style="height:180px; overflow: scroll; overflow-x: hidden;">
					<div><input type="button" class="btn btn-xs btn-pink" value="작업현황" /></div>
					<? $this->noCheckTable("work_tb","작업순서,작업품번,작업품목,작업규격,작업지시수량,작업일"); ?>
				</div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<input type="button" class="btn btn-sm btn-info" id="btnSubmit" value="작업지시등록" />
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="proposalModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:800px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">외주요청</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:330px">
				<form name="outsourcingFrm" id="outsourcingFrm">
					<input type="hidden" name="mode" id="mode" value="registOutsourcingRequest" />
					<input type="text" name="command_outsourcing_item_process" id="command_outsourcing_item_process" />
					<input type="hidden" name="command_order_cd" id="command_order_cd" />
					<input type="hidden" name="outsourcing_uid" id="outsourcing_uid" />

					<table class="table table-bordered table-striped">
						<tr>
							<? $this->th("품번"); ?>
							<td><input type="text" name="outsourcing_item_cd" id="outsourcing_item_cd" readonly validation="yes" err="품번이 전달이 되지 않았습니다" /></td>
							<? $this->th("품명"); ?>
							<td><input type="text" name="outsourcing_item_nm" id="outsourcing_item_nm" readonly validation="yes" err="품명이 전달이 되지 않았습니다" /></td>
						</tr>
						<tr>
							<? $this->th("요청공정"); ?>
							<td><input type="hidden" name="outsourcing_process_cd" id="outsourcing_process_cd" validation="yes" err="작업공정이 전달이 되지 않았습니다" /><input type="text" name="outsourcing_process_nm" id="outsourcing_process_nm" readonly validation="yes" err="작업공정이 전달이 되지 않았습니다"  /></td>
							<? $this->th("다음공정"); ?>
							<td><input type="hidden" name="outsourcing_after_process_cd" id="outsourcing_after_process_cd" /><input type="text" name="outsourcing_after_process_nm" id="outsourcing_after_process_nm" readonly /></td>
						</tr>
						<tr>
							<? $this->th("작업규격"); ?>
							<td><input type="text" name="outsourcing_standard" id="outsourcing_standard" /></td>
							<? $this->th("외주요청수량"); ?>
							<td><input type="text" name="outsourcing_cnt" id="outsourcing_cnt" validation="yes" err="외주요청수량을 입력하세요" /></td>
						</tr>
						<tr>
							<? $this->th("외주요청단위"); ?>
							<td>
								<select name="outsourcing_unit" id="outsourcing_unit">
									<option value="ea">ea</option>
									<option value="m">m</option>
									<option value="kg">kg</option>
									<option value="매">매</option>
								</select>
							</td>
							<? $this->th("납기일"); ?>
							<td>
								<div>
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input class="date-picker" name="outsourcing_delivery_dt" id="outsourcing_delivery_dt" type="text" data-date-format="yyyy-mm-dd" validation="yes" err="납기일자를 입력하세요" readonly />
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</span>
								</div>
							</td>
						</tr>
						<tr>
							<? $this->th("메모"); ?>
							<td colspan="3"><textarea class="form-control" rows="3" name="outsourcing_memo" id="outsourcing_memo"></textarea></td>
						</tr>
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<input type="button" class="btn btn-sm btn-info" id="btnOutsourcingSubmit" value="외주요청" />
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
function refresh() {
	$("#page").val(1);
	$("#where").val("where (state='수주' or state='작업지시' or state='작업중')");
	$("#search_classify").val(0);
	$("#search_txt").val("");
	getData(1);
}
//====================================================================================
// 기본 스크립트 영역
//====================================================================================
$(document).on("click",".outsourcing",
	function(){
		$('.outsourcing_box').css('right','0');
	}
);

$(document).on("click",".outsourcing_box_back",
	function(){
		$('.outsourcing_box').css('right','-110%');
	}
);

$(document).on("click",".work_btn",
	function(){
		$('.pop_main').css('right','0');
	}
);

$(document).on("click",".close_btn",
	function(){
		$('.pop_main').css('right','-110%');
	}
);

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
	getWarehouse();


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

	// 작업지시 등록
	$("#btnSubmit").click(function (event) {
		if(check("workFrm")) {
			// 작업시작일자
			// 작업종료일자
			var work_dt = $("#work_dt").val();
			var work_delivery_dt = $("#order_delivery_dt").val();
			var today = "<?= date('Y-m-d') ?>";
			
			if($("#command_warehouse option:selected").val() == "x") {
				showAlert("생산품입고위치를 선택하세요");
				return false;
			}

			if(parseInt(today.replace(/-/g,""),10) > parseInt(work_dt.replace(/-/g,""),10)){
				showAlert("작업일이 오늘보다 과거를 선택하실 수 없습니다");
				$("#work_dt").val("");
				return false;
			} else if(parseInt(work_delivery_dt.replace(/-/g,""),10) < parseInt(work_dt.replace(/-/g,""),10)) {
				showAlert("작업일이 납품기한 보다 미래를 선택하실 수 없습니다");
				$("#work_dt").val("");
				return false;
			}

			if($("#command_work_process option:selected").val() == 0) {
				showAlert("작업공정을 선택하세요");
				return false;
			}

			if($("#command_work_machine option:selected").val() == 0 && $("#command_work_team option:selected").val() == 0) {
				showAlert("작업을 진행할 설비나 생산팀을 선택하세요");
				return false;
			}

			event.preventDefault();
			var form = $('#workFrm')[0];
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
					showAlert("작업지시를 하였습니다");
					reloadItemProcess();
					formClear("workFrm");
					$("#work_tb tbody").html("");
					$("#btnSubmit").prop("disabled", false);
					hideModal("workModal");
				},
				error: function (e) {
					$("#btnSubmit").prop("disabled", false);
				}
			});
		}
	});

	// 외주요청 등록
	$("#btnOutsourcingSubmit").click(function (event) {
		if(check("outsourcingFrm")) {
			event.preventDefault();
			var form = $('#outsourcingFrm')[0];
			var data = new FormData(form);
			data.append("CustomField", "This is some extra data, testing");
			$("#btnOutsourcingSubmit").prop("disabled", true);

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
					showAlert("외주요청을 하였습니다");
					formClear("outsourcingFrm");
					reloadItemProcess();
					$("#btnOutsourcingSubmit").prop("disabled", false);
					hideModal("proposalModal");
				},
				error: function (e) {
					$("#btnOutsourcingSubmit").prop("disabled", false);
				}
			});
		}
	});
});

function reloadItemProcess() {
	var cnt = $("#order_cnt").val();
	var order_cd = $("#order_cd").val();
	var item_cd = $("#order_item_cd").val();
	var item_nm = $("#order_item_nm").val();
	var standard = $("#order_standard").val();
	var account_cd = $("#order_account_cd").val();
	var account_nm = $("#order_account_nm").val();
	var delivery_dt = $("#order_delivery_dt").val();

	getProcess(order_cd, item_cd, item_nm, standard, cnt, account_cd, account_nm, delivery_dt);
}

// 생산품 입고 창고
function getWarehouse() {
	var tag = "<option value='x'>== 선택 ==</option><option value='0'>다음공정</option>";
	var parameter = {"mode" : "getWarehouseList"};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for (var i = 0 ; i < json.length ; i++)
			{
				tag += "<option value='" + json[i].uid + "'>" + json[i].warehouse_nm + "</option>";
			}

			$("#command_warehouse").html(tag);
		}
	});
}

// 등록 폼 비우기
function formClear(frm) {
	$("#" + frm)[0].reset();
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

function inputNumberFormat(obj) {
    obj.value = comma(uncomma(obj.value));
}


// 견적서 테이블 선택된 TR 색상 바꾸기
function toggle(it) {
	$("#tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

function processToggle(it) {
	$("#process_tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

function bomToggle(it) {
	$("#bom_tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

// TR 삭제
function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#flag").val(nextFlag);
}

// 검색
function search(){
	var type = 1;

	if(type == 1){
		var search_txt = $("#search_txt").val();
		if(search_txt == ""){
			showAlert("검색어를 입력하세요");
			return false;
		}
		
		var where = $("#where").val();
		$("#where").val(where + " and (item_cd like '@" + search_txt + "@' or item_nm like '@" + search_txt + "@' or account_cd like '@" + search_txt + "@' or account_nm like '@" + search_txt + "@')");
	}
	
	$("#page").val(1);
	getData(1);
}


// 날짜별로 데이터 가져오기
function searchDate() {
	var first = $("#start_dt").val();
	var second = $("#end_dt").val();
	if(parseInt(first.replace(/-/g,""),10) > parseInt(second.replace(/-/g,""),10)){
		showAlert("검색 시작일이 검색 종료일 보다 미래일 수 없습니다");
		return;
	}

	var txt = "where (date(delivery_dt) between '" + first + "' and '" + second + "')";
	$("#where").val(txt);

	getData(1);
}

//====================================================================================
// 수주품목 처리 영역
//====================================================================================

// 수주 품목리스트
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getProductObtainOrderItemList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); getProcess('" + json[i].order_cd + "', '" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', '" + json[i].cnt + "', '" + json[i].account_cd + "', '" + json[i].account_nm + "', '" + json[i].delivery_dt + "')\" style='cursor:pointer'>";
					tag += "<td>" + json[i].order_cd + "</td>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					//tag += "<td>" + json[i].standard + "</td>";
					//tag += "<td>" + json[i].unit + "</td>";
					//tag += "<td>" + json[i].account_nm + "</td>";
					//tag += "<td style='text-align:right'>" + json[i].cnt + "</td>";
					//tag += "<td style='text-align:right'>" + json[i].stock_cnt + "</td>";					
					//tag += "<td>" + json[i].delivery_dt + "</td>";
					tag += "<td>" + json[i].state + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "obtain_order_item";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//====================================================================================
// 작업공정 처리 영역
//====================================================================================

// 공정리스트
function getProcess(order_cd, item_cd, item_nm, standard, cnt, account_cd, account_nm, delivery_dt) {
	
	$("#order_cd").val(order_cd);
	$("#order_cnt").val(cnt);
	$("#order_item_cd").val(item_cd);
	$("#order_item_nm").val(item_nm);
	$("#order_standard").val(standard);
	$("#order_account_cd").val(account_cd);
	$("#order_account_nm").val(account_nm);
	$("#order_delivery_dt").val(delivery_dt);

	var tag = "";
	var parameter = {"mode" : "getOrderItemProcess", "order_cd" : order_cd, "item_cd" : item_cd, "standard" : standard, "cnt" : cnt};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for (var i = 0 ; i < json.length ; i++){
				var require_cnt = Math.abs(Number(uncomma(json[i].stockCnt)) - Number(uncomma(cnt)));

				tag += "<tr onclick='processToggle(this); getProcessBom(" + json[i].uid + ", " + require_cnt + ");' style='cursor:pointer'>";
				tag += "<td>" + json[i].no + "</td>";
				tag += "<td>" + json[i].process_nm + "</td>";
				tag += "<td>" + json[i].item_nm + "</td>";
				tag += "<td>" + json[i].outsourcing + "</td>";
				tag += "<td style='text-align:right'><span style='font-weight:bold; color:blue; '>" + cnt + "</span></td>";
				tag += "<td style='text-align:right'>" + json[i].stockCnt + "</td>";
				tag += "<td style='text-align:right'><span style='font-weight:bold; color:red;'>" + comma(require_cnt) + "</span></td>";
				//tag += "<td><input type='button' class='btn btn-xs btn-inverse work_btn' value='작업지시등록' onclick=\"checkMaterial(" + json[i].uid + ", '" + json[i].cnt + "', " + json[i].item_uid + ", " + require_cnt + ", " + json[i].process + ")\" /></td>";
				//tag += "<td>";
				
				// 생산할 수량이 있다면
				if(Number(require_cnt) > 0) {
					//if(json[i].outsourcing != "외주") tag += "<input type='button' class='btn btn-xs btn-inverse' value='작업지시등록' onclick=\"checkMaterial(" + json[i].process + ", " + json[i].item_uid + ", " + require_cnt + ", '" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', " + json[i].uid + ")\" /> ";

					//tag += "<input type='button' class='btn btn-xs btn-info outsourcing' value='외주발주' onclick=\"registOutsourcing(" + json[i].item_uid + ", " + require_cnt + ")\" />";
					/*
					if(json[i].state == "n") {
						tag += "<input type='button' class='btn btn-xs btn-inverse' value='작업지시등록' onclick=\"checkMaterial(" + json[i].process + ", " + json[i].item_uid + ", " + require_cnt + ", '" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].standard + "', " + json[i].uid + ")\" /> ";
						tag += "<input type='button' class='btn btn-xs btn-info' value='외주요청' onclick=\"outsourcingPropose('" + json[i].item_cd + "', '" + json[i].item_nm +"', '" + json[i].process + "', '" + json[i].process_nm + "', '" + json[i].after_process + "', '" + json[i].after_process_nm + "', '" + json[i].standard + "', " + json[i].uid + ")\" />";
					} else {
						tag += "<input type='button' class='btn btn-xs btn-danger' value='" + json[i].state + "' />";
					}
					*/
				}
				//tag += "</td>";
				tag += "</tr>";
			}

			
		} else {
			tag = "<tr><td colspan='8' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#process_tb tbody").html(tag);

		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
	});
}

function outsourcingPropose(item_cd,item_nm,process_cd,process_nm,after_process,after_process_nm,standard, uid){
	$("#command_outsourcing_item_process").val(uid);
	$("#outsourcing_item_cd").val(item_cd);
	$("#outsourcing_item_nm").val(item_nm);
	$("#outsourcing_process_cd").val(process_cd);
	$("#outsourcing_process_nm").val(process_nm);
	$("#outsourcing_after_process_cd").val(after_process);
	$("#outsourcing_after_process_nm").val(after_process_nm);
	$("#outsourcing_standard").val(standard);

	// 사급자재를 불러오기 위한
	$("#outsourcing_uid").val(uid);

	showModal('proposalModal');
}
//====================================================================================
// 소요자재 처리 영역
//====================================================================================

// 구매요청수량 계산
function calRequire() {
	var require_cnt = uncomma($("#purchase_need_cnt").val());
	var stock_cnt = uncomma($("#purchase_stock_cnt").val());
	var purchase_cnt = Number(require_cnt) - Number(stock_cnt);
	$("#purchase_cnt").val(comma(purchase_cnt));
}

// 소요자재 리스트
function getProcessBom(uid, cnt) {
	//alert(uid);
	//alert(cnt);
	$("#purchase_parent_uid").val(uid);
	$("#purchase_parent_cnt").val(cnt);

	var flag = 0;
	var tag = "";
	var parameter = {"mode" : "getProcessBom", "uid" : uid, "cnt" : cnt};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for (var i = 0 ; i < json.length ; i++){
				tag += "<tr onclick='bomToggle(this);' style='cursor:pointer'>";
				tag += "<td style='vertical-align:middle'>" + json[i].item_cd + "</td>";
				tag += "<td style='vertical-align:middle'>" + json[i].item_nm + "</td>";
				//tag += "<td style='vertical-align:middle'>" + json[i].standard + "</td>";
				tag += "<td style='vertical-align:middle'><input type='text' name='standard' id='standard_" + flag + "' style='width:100px' value='" + json[i].standard + "' onkeyup=\"checkRemainCnt(" + flag + ",'" + json[i].item_cd + "')\" disabled/></td>";
				//tag += "<td>" + json[i].unit + "</td>";
				tag += "<td style='vertical-align:middle'><input type='text' name='cnt' id='cnt_" + flag + "' value='" + json[i].cnt + "' style='width:80px' disabled/></td>";
				//tag += "<td style='vertical-align:middle'><select name='unit' id='unit_" + flag + "'><option value='m'>m</option><option value='ea'>ea</option><option value='매'>매</option><option value='kg'>kg</option></td>";
				//tag += "<td style='text-align:right'>" + json[i].cnt + "</td>";
				
				tag += "<td style='vertical-align:middle'><span id='stockCnt_" + flag + "'>" + json[i].stockCnt + "</span></td>";
				
				//if(Number(uncomma(json[i].cnt)) > Number(uncomma(json[i].stockCnt))) tag += "<td style='vertical-align:middle'><input type='button' class='btn btn-xs btn-info' value='구매요청' onclick=\"purchaseModal('" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].stockCnt + "', " + flag + ")\" /></td>";
				//else tag += "<td></td>";
				/*
				if(json[i].state == "n") tag += "<td style='vertical-align:middle'><input type='button' class='btn btn-xs btn-info' value='구매요청' onclick=\"purchaseModal('" + json[i].item_cd + "', '" + json[i].item_nm + "', '" + json[i].stockCnt + "', " + flag + ", " + json[i].uid + ")\" /></td>";
				else tag += "<td><input type='button' class='btn btn-xs btn-danger' value='구매요청완료' /></td>";
				*/
				tag += "</tr>";

				flag++;
			}
		} else {
			tag = "<tr><td colspan='7' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#bom_tb tbody").html(tag);
	});
}

function checkRemainCnt(flag, item_cd) {
	//alert("a");
	var parameter = {"mode" : "getItemStockCnt", "item_cd" : item_cd, "standard" : $("#standard_" + flag).val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str){
			$("#stockCnt_" + flag).html(str);
		}
	});
}

//====================================================================================
// 구매요청 처리 영역
//====================================================================================

// 구매요청
function purchaseModal(item_cd, item_nm, stockCnt,flag, uid) {
	var unit = $("#unit_" + flag + " option:selected").val();
	//alert(unit);
	$("#purchase_uid").val(uid);
	$("#purchase_order_cd").val($("#order_cd").val());
	$("#purchase_item_cd").val(item_cd);
	$("#purchase_standard").val($("#standard_" + flag).val());
	$("#purchase_unit").val(unit);
	$("#purchase_item_nm").val(item_nm);
	$("#purchase_need_cnt").val($("#cnt_" + flag).val());
	$("#purchase_stock_cnt").val(stockCnt);
	
	checkPurchase();
}

// 구매요청품목 확인 - 수주번호, 품목코드, 규격으로 비교
function checkPurchase() {
	var parameter = {"mode" : "checkPurchase", "purchase_order_cd" : $("#purchase_order_cd").val(), "purchase_item_cd" : $("#purchase_item_cd").val(), "purchase_standard" : $("#purchase_standard").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "isit") {
				showModal("confirm");
			} else {
				showModal("purchaseModal");
			}
		}
	});
}

$('#confirm').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:a();");
});

function a() {
	hideModal("confirm");
	showModal("purchaseModal");
}

// 구매요청
function registPurchase() {
	if(check("purchaseFrm", "purchaseModal")) {
		var parameter = $("#purchaseFrm").serialize();
		$.ajax({
			type : "post",
			data : parameter,
			url : "ajax.php",
			success : function(str) {
				if(str == "success") {
					showAlert("구매요청을 하였습니다");
					getProcessBom($("#purchase_parent_uid").val(), $("#purchase_parent_cnt").val());
					$("#purchase_order_cd").val("");
					$("#purchase_item_cd").val("");
					$("#purchase_standard").val("");
					$("#purchase_item_nm").val("");
					$("#purchase_cnt").val("");
					$("#purchase_stock_cnt").val("");
					$("#purchase_delivery_dt").val('');
					$("#purchaseFrm")[0].reset();
					hideModal('purchaseModal');

				}
			}
		});
	}
}

function checkDate() {
	var purchase_delivery_dt = $("#purchase_delivery_dt").val();
	var today = "<?= date('Y-m-d') ?>";
	var order_delivery_dt = $("#order_delivery_dt").val();

	if(parseInt(today.replace(/-/g,""),10) > parseInt(purchase_delivery_dt.replace(/-/g,""),10)){
		showAlert("입고희망일을 오늘보다 과거를 선택하실 수 없습니다");
		$("#purchase_delivery_dt").val("");
	} else if(parseInt(order_delivery_dt.replace(/-/g,""),10) < parseInt(purchase_delivery_dt.replace(/-/g,""),10)) {
		showAlert("입고희망일을 수주 납기일 보다 미래를 선택하실 수 없습니다");
		$("#purchase_delivery_dt").val("");
	}
}

//====================================================================================
// 작업지시 처리 영역
//====================================================================================

// 작업지시를 내릴 기계의 작업리스트를 본다
function getProgressMachine(machine) {
	var tag = "";
	var parameter = {"mode" : "getProgressMachine", "machine" : machine};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {
				tag += "<tr>";
				tag += "<td>" + json[i].seq + "</td>";
				tag += "<td>" + json[i].item_cd + "</td>";
				tag += "<td>" + json[i].item_nm + "</td>";
				tag += "<td>" + json[i].standard + "</td>";
				tag += "<td>" + json[i].cnt + "</td>";
				tag += "<td>" + json[i].work_dt + "</td>";
				//tag += "<td>" + json[i].end_dt + "</td>";
				tag += "</tr>";

				$("#command_work_seq").val(Number(json[i].seq) + 1);
			}
		} else {
			$("#command_work_seq").val(1);
			tag = "<tr><td colspan='7' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#work_tb tbody").html(tag);
	});
}

// 생산계획 등록전 소요자재 확인하여 진행
function checkMaterial(process, item_uid, cnt, item_cd, item_nm, standard, uid) { // 공정UID
	// 해당 작업지시가 이미 등록이 되어 있는지...
	$("#command_outsourcing_item_process").val(uid);
	$("#work_item_process").val(uid);
	$("#work_process").val(process);
	$("#work_item_uid").val(item_uid);
	$("#work_cnt").val(cnt);
	$("#work_item_cd").val(item_cd);
	$("#work_item_nm").val(item_nm);
	$("#work_standard").val(standard);
	
	var parameter = {"mode" : "checkWork", "account_cd" : $("#order_account_cd").val(), "order_cd" : $("#order_cd").val(), "item_cd" : $("#work_item_cd").val(), "standard" : $("#work_standard").val(), "process" : $("#work_process").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "isit") {
				showModal("workConfirm");
			} else {
				var parameter = {"mode" : "checkMaterial", "process" : process, "item_uid" : item_uid, "cnt" : cnt};
				$.ajax({
					type : "post",
					data : parameter,
					url : "ajax.php",
					success : function(str) {
						if(str == "false") {
							showAlert("해당 품목을 생산하기 위한 원자재가 부족합니다<br><br>원자재 구매입고 후 생산계획 등록이 가능합니다");
							return;
						} else {
							postWork();
						}
					}
				});
			}
		}
	});
}

$('#workConfirm').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:b();");
});

function b() {
	hideModal("workConfirm");

	var item_uid = $("#c_uid").val();
	var require_cnt = $("#c_cnt").val();
	var process = $("#c_process").val();
	var account_cd = $("#c_account_cd").val();
	var account_nm = $("#c_account_nm").val();
	var delivery_dt = $("#c_delivery_dt").val();
	var item_cd = $("#c_item_cd").val();
	var item_nm = $("#c_item_nm").val();
	var order_cd = $("#c_order_cd").val();

	var parameter = {"mode" : "checkMaterial", "uid" : item_uid, "cnt" : require_cnt};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "false") {
				showAlert("해당 품목을 생산하기 위한 원자재가 부족합니다<br><br>원자재 구매입고 후 생산계획 등록이 가능합니다");
				return;
			} else {
				postWork();
			}
		}
	});
}

// 작업지시
function postWork() {
	$("#command_item_process").val($("#work_item_process").val());
	$("#command_order_cd").val($("#order_cd").val());
	$("#command_item_cd").val($("#order_item_cd").val());
	$("#command_item_nm").val($("#order_item_nm").val());
	$("#command_account_cd").val($("#order_account_cd").val());
	$("#command_account_nm").val($("#order_account_nm").val());
	$("#command_delivery_dt").val($("#order_delivery_dt").val());
	$("#command_work_item_cd").val($("#work_item_cd").val());
	$("#command_work_item_nm").val($("#work_item_nm").val());
	$("#command_work_standard").val($("#work_standard").val());
	$("#command_work_process").val($("#work_process").val());
	$("#command_work_cnt").val($("#work_cnt").val());

	getWorkMachine($("#command_work_process").val());
	showModal("workModal");
}

function getWorkMachine(process) {
	var tag = "<option value='0'>=선택=</option>";
	var parameter = {"mode" : "getProcessMachineList", "process" : process};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {
				tag += "<option value='" + json[i].uid + "'>" + json[i].machine_nm + "</option>";
			}

			$("#command_work_machine").html(tag);
		}
	});
}

//====================================================================================
// 외주 처리 영역
//====================================================================================

// 외주발주
function registOutsourcing(item_uid, require_cnt) {
	// 해당 품목을 취급하는 업체 가져오기
	var tag = "<option value='0'>=선택=</option>";
	var parameter = {"mode" : "getOutsourcingAccount", "item_uid" : item_uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++) {
				tag += "<option value='" + json[i].uid + "'>" + json[i].account_nm + "</option>";
			}
			$("#outsourcing_account").html(tag);

			// 일치하는 사급자재 가져오기
			var tag = "";
			var parameter = {"mode" : "getBringinMaterialList", "account_uid" : $("#outsourcing_account option:selected").val(), "item_uid" : item_uid};
			$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
				if(json != null) {
					for(var i = 0 ; i < json.length ; i++) {
						var require_cnt = Number(uncomma(json[i].cnt)) * Number(uncomma($("#outsourcing_require_cnt").val()));
						var purchase_cnt = Number(uncomma(json[i].current_stock)) - Number(require_cnt);

						if(purchase_cnt < 0) purchase_cnt = Math.abs(purchase_cnt);

						tag += "<tr>";
						tag += "<td><input type='text' name='item_cd[]' value='" + json[i].item_cd + "' /></td>";
						tag += "<td><input type='text' class='form-control' name='item_nm[]' value='" + json[i].item_nm + "' /></td>";
						tag += "<td><input type='text' class='form-control' name='standard[]' value='" + json[i].standard + "' /></td>";
						tag += "<td><input type='text' name='unit[]' value='" + json[i].unit + "' style='width:80px' /></td>";
						tag += "<td><input type='text' name='cnt[]' value='" + json[i].cnt + "' style='width:80px' /></td>";
						tag += "<td><input type='text' name='require_cnt[]' value='" + comma(require_cnt) + "' style='width:80px' /></td>";
						tag += "<td><input type='text' name='current_stock[]' value='" + json[i].current_stock + "' style='width:100px' /></td>";
						tag += "<td><input type='text' name='purchase_cnt[]' value='" + comma(purchase_cnt) + "' style='width:100px' /></td>";
						tag += "<td>";
						tag += "<div>";
						tag += "<span class='input-icon input-icon-right'>";
						tag += "<div class='input-group'>";
						tag += "<input class='date-picker' name='bringin_dt[]' id='bringin_dt' type='text' data-date-format='yyyy-mm-dd' validation='yes' err='입고희망일을 입력하세요' readonly />";
						tag += "<span class='input-group-addon'>";
						tag += "<i class='fa fa-calendar bigger-110'></i>";
						tag += "</span>";
						tag += "</div>";
						tag += "</span>";
						tag += "</div>";
						tag += "</td>";
						tag += "</tr>";
					}			
				} else {
					tag = "<tr><td colspan='10' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
				}
				

				$("#outsourcing_bringin_material_tb tbody").html(tag);
				
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			});
		} else {
			$("#outsourcing_account").html("<option value='0'>=선택=</option>");
			$('#outsourcing')[0].reset();
			$("#delivery_dt").val("");
			$("#outsourcing_bringin_material_tb tbody").html("");
		}
	});
	
	// 품목정보 가져오기
	var parameter = {"mode" : "getItem", "item_uid" : item_uid};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#outsourcing_item_cd").val(json.item_cd);
			$("#outsourcing_item_nm").val(json.item_nm);
			$("#outsourcing_standard").val(json.standard);
			$("#outsourcing_unit").val(json.unit);
		}
	});
	


	$("#outsourcing_require_cnt").val(require_cnt);
}

// 외주발주 및 사급자재 구매요청
function registOutsourcingItem() {
	if($("#outsourcing_account option:selected").val() == 0) {
		showAlert("업체를 선택하세요");
		return false;
	}
	var parameter = $("#outsourcing").serialize();
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str){
			if(str == "success") {
				showAlert("외주발주를 하였습니다");
				$('#outsourcing')[0].reset();
				$("#delivery_dt").val("");
				$("#outsourcing_bringin_material_tb tbody").html("");
				$('.outsourcing_box').css('right','-110%');
			}
		}
	});
}


//==================================================
// 중부서 가져오기
//==================================================
function getMiddleDepartment(){
	var tag = "<option value='all'>부서선택</option>";
	var parameter = {"mode" : "getMiddleDepartment", "fid" : $("#big_department_cd option:selected").val()};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}

			$("#middle_department_cd").html(tag);
		}
	);
}

//==================================================
// 소부서 가져오기
//==================================================
function getSmallDepartment(){
	var tag = "<option value='all'>부서선택</option>";
	var parameter = {"mode" : "getSmallDepartment", "fid" : $("#middle_department_cd option:selected").val()};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}
			$("#small_department_cd").html(tag);
		}
	);
}

//==================================================
// 사원등록용 대부서 가져오기
//==================================================
function postBigDepartment(){
	var parameter = {"mode" : "getBigDepartment"};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				postMiddleDepartment(json[i].uid);
			}
		}
	);
}

//==================================================
// 사원등록용 중부서 가져오기
//==================================================
function postMiddleDepartment(big){
	var tag = "<option value='all'>부서선택</option>";
	var parameter = {"mode" : "getMiddleDepartment", "fid" : big};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}

			$("#m_middle_department_cd").html(tag);
		}
	);
}

//==================================================
// 사원등록용 소부서 가져오기
//==================================================
function postSmallDepartment(middle){
	var tag = "<option value='all'>부서선택</option>";
	var parameter = {"mode" : "getSmallDepartment", "fid" : middle};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}
			$("#m_small_department_cd").html(tag);
		}
	);
}
</script>