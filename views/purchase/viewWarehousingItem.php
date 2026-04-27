<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);

?>

<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="purchase" />
						<input type="hidden" name="action" id="action" value="updateWarehousingItem" />
						<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />
						<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />
						<input type="hidden" name="cntTotal" id="cntTotal" value="" />
						<input type="hidden" name="unitPriceTotal" id="unitPriceTotal" value="" />
						<input type="hidden" name="supplyPriceTotal" id="supplyPriceTotal" value="" />
						<input type="hidden" name="taxTotal" id="taxTotal" value="" />
						<input type="hidden" name="priceTotal" id="priceTotal" value="" />

						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">구매입고일자</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input name="warehousing_dt" id="warehousing_dt" type="text" value="<?=$t->warehousing_dt?>" readonly/>
												<span class="input-group-addon"disabled>
													<i class="fa fa-calendar bigger-110" disabled></i>
												</span>
												-
												<span class="panel panel-default">
													<?=$t->warehousing_cha?>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">발주서</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="p_order_uid" id="p_order_uid" value="<?=$t->p_order_uid?>" readonly />
												<input type="text" name="p_order_cd" id="p_order_cd" value="<?=$t->p_order_cd?>" onclick="centerOpenWindow('views/popup/purchaseOrderItemList.php', '발주서 Item 리스트',900, 500)" readonly />
												<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/purchaseOrderItemList.php', '발주서 Item 리스트', 900, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
							<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 거래처</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="account_cd" id="account_cd" value="<?=$t->account_cd?>" readonly />
												<input type="text" name="account_nm" id="account_nm" value="<?=$t->account_nm?>" onclick="centerOpenWindow('views/popup/accountList.php', '거래처리스트', 600, 500)" readonly />
												<span class="input-group-addon btn-purple"  style="cursor:pointer" onclick="centerOpenWindow('views/popup/accountList.php', '거래처리스트', 600, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 담당자</th>
								<td class="col-xs-5"><input type="text" name="manager" id="manager" value="<?=$t->manager?>" /> * 거래처 담당자</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">프로젝트</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="project_cd" id="project_cd" value="<?=$t->project_cd?>" readonly />
												<input type="text" name="project_nm" id="project_nm" value="<?=$t->project_nm?>" onclick="centerOpenWindow('views/popup/projectList.php', '프로젝트리스트', 600, 500)" readonly />
												<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/projectList.php', '프로젝트리스트', 600, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">입고창고</th>
								<td class="col-xs-5">
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input type="hidden" name="warehouse_cd" id="warehouse_cd" value="<?=$t->warehouse_cd?>" />
											<input type="text" name="warehouse_nm" id="warehouse_nm" value="<?=getWarehouseName($t->warehouse_cd)?>" onclick="centerOpenWindow('views/popup/warehouseList.php', '창고리스트', 600, 500)" />
											<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/warehouseList.php', '창고리스트', 600, 500)">
												<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
											</span>
										</div>
									</span>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">납기일자</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="deadline_dt" id="deadline_dt" type="text" value="<?=$t->deadline_dt?>" data-date-format="yyyy-mm-dd" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">거래유형</th>
								<td class="col-xs-5">
									<select name="tax_type" id="tax_type" onchange="tax_calculation(this.value)">
										<option value="1" <? if($t->tax_type == 1) echo "selected"; ?>>부가세율 적용</option>
										<option value="2" <? if($t->tax_type == 2) echo "selected"; ?>>부가세율 미적용</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">비고</th>
								<td class="col-xs-11" colspan="3">
									<textarea id="remark" name="remark" class="form-control"><?=$t->memo?></textarea>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">첨부</th>
								<td class="col-xs-5"><input type="file" name="attach" id="attach" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">진행상태</th>
								<td class="col-xs-5">
									<select name="state" id="state" >
										<option value="0" <? if($t->state == "0") echo "selected"; ?>>대기중</option>
										<option value="1" <? if($t->state == "1") echo "selected"; ?>>진행중</option>
										<option value="2" <? if($t->state == "2") echo "selected"; ?>>입고완료</option>
										<option value="3" <? if($t->state == "3") echo "selected"; ?>>입고취소</option>
									</select>
									<label class="pl-2">
									<input type="checkbox" name="purchaseOrderAccount" id="purchaseOrderAccount" value='Y' class="ace input-lg pl-2" ><span class="lbl pl-1">회계반영</span>
									</label>
									<label class="pl-2">
									<input type="checkbox" name="purchaseOrderState" id="purchaseOrderState" value='Y' class="ace input-lg pl-2" ><span class="lbl pl-1">발주서종결</span></label>
									</label>
								</td>
							</tr>
						</table>
						
						<a class="btn btn-xs btn-success" onclick="centerOpenWindow('views/popup/pWarehousingItemList.php', '품목리스트', 800, 500)">품목선택</a>
						<table id="warehousing_item" class="table  table-bordered table-hover" style="margin-top:10px">
							<thead>
								<tr>
									<th class="detail-col center" style="background-color:#f1f1f1"></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">품목코드</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">품목명</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">규격</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">단위</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1;">재고수량</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1;">부족수량</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">수량</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">단가</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">공급가액</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">부가세</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">합계금액</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">LOT_NO</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1;white-space: nowrap;">수입검사</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<th class="center" style="background-color:#f1f1f1"></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1;width:5%"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1;width:5%"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN class="cntTotal"></SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN class="unitPriceTotal"></SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN class="supplyPriceTotal"></SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN class="taxTotal"></SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1" style="text-align:right;"><SPAN class="priceTotal"></SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
								</tr>
							<tfoot>			
						</table>
					</form>
				</div>
			</div><!-- /.row -->
			
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<!-- <button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						등록
					</button> -->

					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset" onclick="window.parent.closeModal('<?=$dialogID?>');">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						닫기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<input type="hidden" name="flag" id="flag" value="1" />
<input type="hidden" name="itemFlag" id="itemFlag" value="" />
<input type="hidden" name="lotnocdFlag" id="lotnocdFlag" value="1" />
<input type="hidden" name="inspectionFlag" id="inspectionFlag" value="1" />
<div id="dialog-message" class="dialog-view hide">
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div class="col-xs-12 ">
						<div class="col-xs-4" style="float:left">
							<i class='ace-icon fa fa-file-text'></i> 로트넘버검색
						</div>
						<div class="col-xs-8" style="float:right">
							<div class="col-xs-12"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="Search..." name="search_txt" id="search_txt" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="search()">
											<span class="ace-icon fa fa-search icon-on-right"></span>
											Search
										</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
					<div style="margin-top:10px">
						<table id="lot_no_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="col-xs-6 center" style="background-color:#f1f1f1">로트넘버관리항목코드</th>
									<th class="col-xs-6 center" style="background-color:#f1f1f1">로트넘버관리항목명칭</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
			</div>
		</div>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
function centerOpenWindow(theURL, winName, width, height, fstate, scrollbars){ 
	var features = "width=" + width ; 
	features += ",height=" + height ; 
	var state = ""; 
	var scrollbars = "yes";
	var res_w = ( $(window).width() - width ) / 2; 
	var res_h = ( $(window).height() - height ) / 2; 
	if ( window.screenLeft >= window.screen.width ) { 
		res_w = window.screen.width + res_w; 
	} 
	if (fstate == "") { // 옵션 
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 


function inspectionPop(flag, id, fid, cd, nm, st, unit, cnt )
{
 $("#inspectionFlag").val(flag);
	var url = "views/purchase/receivingInspection.php?flag="+flag+"&uid="+id+"&fid="+fid+"&icd="+cd+"&inm="+nm+"&st="+st+"&unit="+unit+"&cnt="+cnt;
	window.open(encodeURI(url),"popup", "width=600, height=600, left=0, top=0, toolbar=no, location=no, directories=no, status=no, menubar=no, resizable=no, scrollbars=no, copyhistory=no");
}


function inspectionModifyPop(flag,cd, cnt)
{
 $("#inspectionFlag").val(flag);
var url = "views/purchase/receivingInspection_modify.php?flag="+flag+"&cd="+cd+"&cnt="+cnt;
 window.open(encodeURI(url),"popup", "width=600, height=600, left=0, top=0, toolbar=no, location=no, directories=no, status=no, menubar=no, resizable=no, scrollbars=no, copyhistory=no");
}

function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#flag").val(nextFlag);
}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	//getOrder();
	getProject();
	getWarehouse();
	getItem();
	getLotNo(page);
	getWarehousingItem();

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

function createPurchaseOrderCode(){
	var data_string = "mode=createPurchaseOrderCode";
	$.ajax({
		type : "post",
		url : "ajax/purchase.php",
		data : data_string,
		success : function(str) {
			$("#p_order_cd").val(str);
		}
	});
}

function itemFlag(flag) {
	$("#itemFlag").val(flag);
}

function tax_calculation(tax_type){
	var cnt = new Array();
	var unit_price = new Array();
	var tax = new Array();
	var hap = new Array();

	var re_unit_price = new Array();
	var re_tax = new Array();
	var total = new Array();
	var values = 0;

	$.each($(".cnt") , function () {
		cnt.push(removeComma($(this).val()));
	});

	$.each($(".unit_price") , function () {
		unit_price.push(removeComma($(this).val()));
	});

	$.each($(".tax") , function () {
		tax.push(removeComma($(this).val()));
	});

	for(var i = 0 ; i < cnt.length ; i++) {
		if(cnt[i] > 0) {
			values = Number(cnt[i]) * Number(unit_price[i]);

			// 부가세적용
			if(tax_type == 1) {
				var supply_price = values/1.1;
				var cal_tax = values-supply_price;
				var re_hap = values + cal_tax;
				
				re_unit_price.push(supply_price);
				re_tax.push(cal_tax);
				total.push(Number(re_hap));
			} else { // 부가세 미적용
				var re_hap = unit_price[i];
				var cal_tax = 0;

				re_unit_price.push(re_hap);
				re_tax.push(cal_tax);
				total.push(re_hap * cnt[i]);
			}
		}
	}

	for (var i = 0 ; i < cnt.length ; i++)
	{
		if(removeComma(total[i]) > 0) {
			$(".tax").eq(i).val(Math.round(re_tax[i]));
			$(".total_price").eq(i).val(commaSplit(Math.round(total[i])));
		}
	}
}
// 공급가액 계산
function calculation(flag) {
	var tax_type = $("#tax_type option:selected").val();
	var cnt = $("#cnt_" + flag).val();
	var unit_price = removeComma($("#unit_price_" + flag).val());
	//var tariff = $("#tariff_" + flag).val();
	//var adjustments = Number(unit_price) * Number(tariff);
	var values = Number(removeComma(cnt)) * Number(removeComma(unit_price));
	//var values = Number(removeComma(cnt)) * Number(removeComma(adjustments));

	//$("#adjustments_" + flag).val(commaSplit(adjustments));

	// 부가세적용
	if(tax_type == 1) {
		//var supply_price = values/1.1;
		var supply_price = values
		var tax = supply_price*0.1;
		$("#supply_price_" + flag).val(commaSplit(Math.round(supply_price)));
		$("#total_price_" + flag).val(commaSplit(Math.round(values + tax)));
	} else {
		var tax = 0;
		//var tax = values-supply_price;
		$("#supply_price_" + flag).val(commaSplit(Math.round(values)));
		$("#total_price_" + flag).val(commaSplit(Math.round(values + tax)));
	}
	$("#tax_" + flag).val(commaSplit(Math.round(tax)));

	/*if ($("input[name='cnt[]']").length > 0) {
		var debtorTotal = 0;

		$("input[name='cnt[]']").each(function () {
			var cnt = Money2Num($(this).val());
			if (debtor != "" && !isNaN(debtor))
				debtorTotal = debtorTotal + parseInt(debtor, 10);
		});

		$(".debtorTotal").html(Num2Money(debtorTotal));
		$("#creditor_" + flag).val("0");
		
		var dcTotalPriceRe = (removeComma($(".debtorTotal").text()) -removeComma($(".creditorTotal").text()));
		//alert(dcTotalPriceRe)
		$(".remarkAmount").html(Num2Money(dcTotalPriceRe));
		alert(removeComma($(".debtorTotal").text()))
		$("#totalprice").val(removeComma($(".debtorTotal").text()));
	}
	*/
}
function  calculationTotal(flag) {
	var cntTotal = 0;
	$("input[name='cnt[]']").each(function () {
		var cnt = removeComma(this.value);
		if ($("input[name='cnt[]']").length > 0 && !isNaN(cnt)){
			 cntTotal += Number(removeComma(this.value));
		}
	});
	var unitPriceTotal = 0;
	$("input[name='unit_price[]']").each(function () {
		var unit_price = removeComma(this.value);
		if ($("input[name='unit_price[]']").length > 0 && !isNaN(unit_price)){
			 unitPriceTotal += Number(removeComma(this.value));
		}
	});
	var supplyPriceTotal = 0;
	$("input[name='supply_price[]']").each(function () {
		var supply_price = removeComma(this.value);
		if ($("input[name='supply_price[]']").length > 0 && !isNaN(supply_price)){
			 supplyPriceTotal += Number(removeComma(this.value));
		}
	});
	var taxTotal = 0;
	$("input[name='tax[]']").each(function () {
		var tax = removeComma(this.value);
		if ($("input[name='tax[]']").length > 0 && !isNaN(tax)){
			 taxTotal += Number(removeComma(this.value));
		}
	});
	var priceTotal = 0;
	$("input[name='total_price[]']").each(function () {
		var total_price = removeComma(this.value);
		if ($("input[name='total_price[]']").length > 0 && !isNaN(total_price)){
			 priceTotal += Number(removeComma(this.value));
		}
	});
		$(".cntTotal").html(Num2Money(cntTotal));
		$(".unitPriceTotal").html(Num2Money(unitPriceTotal));
		$(".supplyPriceTotal").html(Num2Money(supplyPriceTotal));
		$(".taxTotal").html(Num2Money(taxTotal));
		$(".priceTotal").html(Num2Money(priceTotal));


}
function commaSplit(n) {// 콤마 나누는 부분
    var txtNumber = '' + n;
    var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
    var arrNumber = txtNumber.split('.');
    arrNumber[0] += '.';
    do {
        arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
    }
    while (rxSplit.test(arrNumber[0]));
    if(arrNumber.length > 1) {
        return arrNumber.join('');
    } else {
        return arrNumber[0].split('.')[0];
    }
}

function removeComma(n) {  // 콤마제거
    if ( typeof n == "undefined" || n == null || n == "" ) {
        return "";
    }
    var txtNumber = '' + n;
    return txtNumber.replace(/(,)/g, "");
}

function getProject() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;

	$.getJSON("ajax/groupware.php",{"page":page, "mode":"getProject", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postProject('" + json[i].project_cd + "','" + json[i].project_nm + "')\">" + json[i].project_cd + "</a></td>";
					tag += "<td>" + json[i].project_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#project_list tbody").html(tag);

			var table = "erp_project";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function getItem() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;

	$.getJSON("ajax/item.php",{"page":page, "mode":"getItem", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td>" + json[i].item_gb + "</td>";
					tag += "<td><a href='#' onclick=\"postItem('" + json[i].item_cd + "','" + json[i].item_nm + "','" + json[i].unit + "','" + json[i].supply_price + "','" + json[i].unit_price + "','" + json[i].lot_no + "')\">" + json[i].item_cd + "</a></td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#item_list tbody").html(tag);

			var table = "erp_item";
			var where = "";

			getPaging(table, where, rpp, adjacents);
		}
	);
}

// 주문서번호 붙이기
function postOrder(order_cd) {
	$("#order_cd").val(order_cd);
	getOrderOne(order_cd);
	
}

function getOrderOne(order_cd) {
	$.getJSON("ajax/purchase.php",{"mode":"getOrderOne", "order_cd" : order_cd},
		function(json){
			if(json != null) {
				$("#p_order_uid").val(json.uid);
				$("#project_cd").val(json.project_cd);
				$("#project_nm").val(json.project_nm);
				getPurchaseOrderItem();
			}	
		}
	);
}
$(document).ready(function() {
    $('[data-toggle="popover"]').popover({container: "body"});
});
function getWarehousingItem(){
	var uid = $("#uid").val();
	var flag = $("#flag").val();
	var tag = "";

	$.getJSON("ajax/purchase.php",{"mode":"getWarehousingItem", "uid" : uid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag = "<tr class='item" + flag + "'>";
					tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this);calculationTotal(" + flag + ");'></i></td>";
					tag += "<td><input type='text' class='form-control item_cd ' name='item_cd[]' id='item_cd_" + flag + "' onclick='viewModal();itemFlag(" + flag + ")' value='" + json[i].item_cd + "' placeholder='품목선택을 하시려면 클릭하세요' title='"+ json[i].item_cd +"' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "' value='" + json[i].item_nm + "' title='"+ json[i].item_nm +"' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='standard1[]' id='standard1_" + flag + "' value='" + json[i].standard1 + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + json[i].unit + "'  /></td>";
					tag += "<td><input type='text' class='form-control remain_cnt text-right' name='remain_cnt[]' id='remain_cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].remain_cnt + "' readonly/></td>";
					tag += "<td><input type='text' class='form-control shortage_cnt text-right' name='shortage_cnt[]' id='shortage_cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].shortage_cnt + "' readonly/></td>";
					tag += "<td><input type='text' class='form-control cnt text-right' name='cnt[]' id='cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].cnt + "' /></td>";
					tag += "<td><input type='text' class='form-control unit_price text-right' name='unit_price[]' id='unit_price_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].unit_price + "' /></td>";
					tag += "<td><input type='text' class='form-control supply_price text-right' name='supply_price[]' id='supply_price_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].supply_price + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control tax text-right' name='tax[]' id='tax_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].tax + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control total_price text-right' name='total_price[]' id='total_price_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].total_price + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control lot_no' name='lot_no_cd[]' id='lot_no_cd_" + flag + "' ondblclick='lotnocdFlag(" + flag + ");lot_no_reg(" + flag + ")' value='" + json[i].lot_no_cd + "' title='"+ json[i].lot_no_cd +"' readonly /><input type='hidden' name='lot_no_nm[]'  id='lot_no_nm_" + flag + "' value='" + json[i].lot_no_nm + "' /></td>";
					tag += "<td><input type='text' class='form-control' name='inspection_cd[]' id='inspection_cd_" + flag + "' onclick=\"inspectionModifyPop(" + flag + ",'" + json[i].inspection_cd + "')\" value='" + json[i].inspection_cd + "' title='"+ json[i].inspection_cd +"'  readonly /></td>";
					tag += "</tr>";
					
					flag = Number(flag) + 1;
					$("#flag").val(flag);
					
				}
				calculationTotal();
			}else{
				tag += "<tr><td colspan='15' align='center'>등록된 품목이 없습니다.</td><tr>";
			}
			$("#warehousing_item").append(tag);
		}
	);
}


function postItem(item_cd,item_nm,unit,supply_price,unit_price,lot_no){
	var arr = [];
	$.each($(".item_cd") , function () {
		arr.push($(this).val());
	});
	var idx = jQuery.inArray(item_cd, arr);
	if(idx >= 0) {
		alert("동일 품목을 이미 선택하셨습니다");
	} else {
		var flag = $("#itemFlag").val();
		$("#item_cd_" + flag).val(item_cd);
		$("#item_nm_" + flag).val(item_nm);
		$("#unit_" + flag).val(unit);
		$("#supply_price_" + flag).val(supply_price);
		$("#unit_price_" + flag).val(unit_price);
		$("#lot_no_" + flag).val(lot_no);
	}
}

function getPurchaseOrderItem(){
	var uid = $("#p_order_uid").val();

	var currentFlag = $("#flag").val();
	var tag = "";

	$.getJSON("ajax/purchase.php",{"mode":"getPurchaseOrderItem", "uid" : uid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag = "<tr class='item" + currentFlag + "'>";
					tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this);calculationTotal(" + currentFlag + ");'></i></td>";
					tag += "<td><input type='text' class='form-control item_cd ' name='item_cd[]' id='item_cd_" + currentFlag + "' onclick='viewModal();itemFlag(" + currentFlag + ")' value='" + json[i].item_cd + "' placeholder='품목선택을 하시려면 클릭하세요' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + currentFlag + "' value='" + json[i].item_nm + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='standard1[]' id='standard1_" + currentFlag + "' value='" + json[i].standard1 + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + currentFlag + "' value='" + json[i].unit + "'  /></td>";
					tag += "<td><input type='text' class='form-control remain_cnt text-right' name='remain_cnt[]' id='remain_cnt_" + currentFlag + "' onkeyup='calculation(" + currentFlag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + currentFlag + ");' value='" + json[i].remain_cnt + "' readonly/></td>";
					tag += "<td><input type='text' class='form-control shortage_cnt text-right' name='shortage_cnt[]' id='shortage_cnt_" + currentFlag + "' onkeyup='calculation(" + currentFlag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + currentFlag + ");' value='" + json[i].shortage_cnt + "' readonly/></td>";
					tag += "<td><input type='text' class='form-control cnt text-right' name='cnt[]' id='cnt_" + currentFlag + "' onkeyup='calculation(" + currentFlag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + currentFlag + ");' value='" + json[i].cnt + "' /></td>";
					tag += "<td><input type='text' class='form-control unit_price text-right' name='unit_price[]' id='unit_price_" + currentFlag + "' onkeyup='calculation(" + currentFlag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + currentFlag + ");' value='" + json[i].unit_price + "' /></td>";
					tag += "<td><input type='text' class='form-control supply_price text-right' name='supply_price[]' id='supply_price_" + currentFlag + "' onkeyup='calculation(" + currentFlag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + currentFlag + ");' value='" + json[i].supply_price + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control tax text-right' name='tax[]' id='tax_" + currentFlag + "' onkeyup='calculation(" + currentFlag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + currentFlag + ");' value='" + json[i].tax + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control total_price text-right' name='total_price[]' id='total_price_" + currentFlag + "' onkeyup='calculation(" + currentFlag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + currentFlag + ");' value='" + json[i].total_price + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control lot_no' name='lot_no_cd[]' id='lot_no_cd_" + currentFlag + "' ondblclick='lotnocdFlag(" + currentFlag + ");lot_no_reg(" + currentFlag + ")'  /><input type='hidden' name='lot_no_nm[]'  id='lot_no_nm_" + currentFlag + "'/></td>";
					tag += "<td><input type='hidden' name='inspection_cd[]' id='inspection_cd_" + currentFlag + "' readonly /><button class='btn btn-info btn-xs' id='btn_" + currentFlag + "' type='button' onclick=\"inspectionPop('" + currentFlag + "', '" + json[i].uid + "', '" + json[i].fid + "', '" + json[i].item_cd + "','" + json[i].item_nm + "','" + json[i].standard1 + "','" + json[i].unit + "', '" + json[i].cnt + "')\"><i class='ace-icon fa fa-check bigger-110'></i>등록</button></td>";
					tag += "</tr>";
					$("#warehousing_item").append(tag);
					currentFlag = Number(currentFlag) + 1;
					$("#flag").val(currentFlag);
				}
				//var nextFlag = Number(currentFlag) + 1;
				//$("#flag").val(nextFlag);
			//} else {
			//	$("#flag").val("4");
			}else{
				tag += "<tr><td colspan='15' align='center'>등록된 품목이 없습니다.</td><tr>";
			}
			calculationTotal()
		}
	);
}

// 거래처 리스트 가져오기
function getWarehouse(){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var warehouse_gb = $("#warehouse_gb").val();

	$.getJSON("ajax/warehouse.php",{"page":page, "mode":"getWarehouse", "rpp" : rpp, "adjacents" : adjacents, "where":search, "warehouse_gb":warehouse_gb},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].warehouse_cd + "'>" + json[i].warehouse_nm + "</option>";
				}
			}

			$("#warehouse_cd").append(tag);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getAccount(page);
}

// 페이징 가져오기
function getPaging(table,where,rpp,adjacents){
	var data_string = "page=" + $("#page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents;

	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#paging_area").html(str);
		}
	});
}

// 검색
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	if(search_choice == "account_nm") {
		$("#where").val(" where 1=1 and account_nm like '%" + txt + "%' ");
	} else if(search_choice == "account_cd") {
		$("#where").val(" where 1=1 and account_cd like '%" + txt + "%' ");
	}
	getAccount(1);
}

function postAccount(code,name,manager) {
	if(manager != 'null') $("#manager").val(manager);
	else $("#manager").val("");
	$("#account_cd").val(code);
	$("#account_nm").val(name);
}

function postProject(code,name) {
	$("#project_cd").val(code);
	$("#project_nm").val(name);
}

function formSubmit(){
	var state = $("#state option:selected").val();
	var state_before = "<?=$t->state?>";
	//if(!check_str($("#p_order_cd").val(),"발주서코드")) return false;
	if(!check_str($("#account_nm").val(),"거래처")) return false;
	if(!check_str($("#deadline_dt").val(),"납기일자")) return false;
	//if(!check_str($("#project_cd").val(),"프로젝트")) return false;
	if($("#warehouse_nm").val() == "") {
		alert("입고창고를 추가 하세요");
		$("#warehouse_nm").focus();
		return false;
	}
	/*
	if($("#lot_no_cd_1").val() == "") {
		alert("로트넘버를 입력하세요");
		$("#lot_no_cd_1").focus();
		return false;
	}

	if($("#inspection_cd_1").val() == "") {
		alert("수입검사를 등록하세요");
		$("#inspection_cd_1").focus();
		return false;
	}
	*/
	if(state != "2" && $('input:checkbox[id="purchaseOrderState"]').is(":checked") == true) {
		alert("진행상태가 입고완료가 아니면 발주서를 종결 처리 할수 없습니다.");
		return false;
	}

	if($(".priceTotal").text() == 0 || $(".priceTotal").text() == "") {
		alert("품목을 하나 이상 추가 하세요");
		return false;
	}

	if(!frm_submit($('input[name="cnt[]"]'),"수량")) return false;
	if(!frm_submit($('input[name="unit_price[]"]'),"판매단가")) return false;

	if(!frm_submit($('input[name="lot_no_cd[]"]'),"로트넘버")) return false;
	if(!frm_submit($('input[name="inspection_cd[]"]'),"수입검사")) return false;


	$("#cntTotal").val($(".cntTotal").html());
	$("#unitPriceTotal").val($(".unitPriceTotal").html());
	$("#supplyPriceTotal").val($(".supplyPriceTotal").html());
	$("#taxTotal").val($(".taxTotal").html());
	$("#priceTotal").val($(".priceTotal").html());

	if (state_before =="2" && state=="2"){
		var result = confirm('이미 구매 입고완료된 건 입니다.\n상태값을 변경하면 자재현황이 오류가 발생 합니다.\n그래도 변경하시겠습니까?'); 
		if(result) { 
			$("#frm").submit();
		}
	}else{
		$("#frm").submit();
	}
}

function frm_submit(f,t) {
	  var ret = true;
	  $(f).each(function(idx, item) {
		if(!$(item).val() || $(item).val()=="0") {
		  ret = false;
		  alert(t+"을 입력 하세요");
		  $(item).focus();
		  return false;
		}
	  });
	  return ret;
	}

//-----------------------------------------------------------------------
// 기  능 : 숫자를 금액 형식으로
//-----------------------------------------------------------------------
function Num2Money(number){

	number		=	Money2Num(number);

	if(isNaN(number))			return number;
	if(parseFloat(number)==0)	return 0;
	if(!number)					return "";
	var strint="";
	var strfloat="";
	var tmp;
	var ans="";
	var isfloat=false;
	var minus=false;
	var result='';

	if(number.indexOf("-")>-1){
		minus=true;
		number=number.replace('-','');
	}

	if(number.indexOf(".")==-1) strint=number;
	else {
		isfloat=true;
		strint=number.substring(0,number.indexOf("."));
		if(parseInt(strint,10)==0)	strint = '0';
		strfloat=number.substring(number.indexOf("."),number.length);
	}

	if(!isNaN(strint) && strint!=""){
		strint	=	String(parseInt(strint,10));
	}

	var num=strint.split("");

	tmp=num.reverse();

	for(a=0;a<tmp.length;a++) {
		if(!(a%3) && a!=0) { ans+=",";  }
		ans+=tmp[a];
	}

	tmp=ans.split("").reverse();
	ans="";

	for(a=0;a<tmp.length;a++){ ans+=tmp[a];}

	for(a=0;a<2;a++)
		if(ans.charAt(0)=="0" || ans.charAt(0)==",") ans=ans.substring(1,ans.length);

	result=ans+strfloat;

	if(isfloat==true){
		var lastchar=result.substr(result.length-1,1);
		while (lastchar == '0' || lastchar == '.'){
			result = result.substr(0,result.length-1);
			if (lastchar == '.'){break;}
			lastchar=result.substr(result.length-1,1);
		}
	}

	var tmpresult = parseFloat(Money2Num(result));

	if(tmpresult>0 && tmpresult<1){
		result = '0'+result;
	}

	return	(minus==true) ? '-'+result : result
}
//-----------------------------------------------------------------------
// 기  능 : 금액을 숫자 형식으로
//-----------------------------------------------------------------------
function Money2Num(money) {
	if(money == undefined)	return false;
	var moneyString		=	new String;
	moneyString			=	money.toString();
	while (moneyString.indexOf(',') > -1){
		moneyString	=	moneyString.replace(',','');
	}
	if(isNaN(moneyString)){
		return false;
	}else{
		return moneyString;
	}
}
function commaSplit(n) {// 콤마 나누는 부분
	var txtNumber = '' + n;
	var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
	var arrNumber = txtNumber.split('.');
	arrNumber[0] += '.';
	do {
		arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
	}
	while (rxSplit.test(arrNumber[0]));
	if(arrNumber.length > 1) {
		return arrNumber.join('');
	} else {
		return arrNumber[0].split('.')[0];
	}
}

function removeComma(n) {  // 콤마제거
	if ( typeof n == "undefined" || n == null || n == "" ) {
		return "";
	}
	var txtNumber = '' + n;
	return txtNumber.replace(/(,)/g, "");
}
function input_comma(sfield) 
	{
		if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) 
			|| (event.keyCode == 188) || (event.keyCode == 190) || (event.keyCode == 110) || (event.keyCode == 8) || (event.keyCode == 46))
		{			
			sfield.value = remove_comma(sfield);
			money = sfield.value;
			var tmpH="";
			if(money.charAt(0)=="-")
			{
				tmpH=money.substring(0,1);
				money=money.substring(1,money.length);
			}
		
			for (; money.indexOf("-") != -1 ;) 
			{ 
				money = money.replace("-","")
			}
		
			belowzero = "";
			if (check_dot(money)==true)
			{
				arr = money.split(".");
				money = arr[0];		
				belowzero = "." + arr[1];    
			}
			
			len = money.length ;
			result ="";
			for (i=0; i < len;i++)
			{
				comma="";
				schar = money.charAt(i);
				where = len - 1 - i;
				if ( ( where % 3 == 0) && (len > 3) && ( where != 0 )) 
				{
					comma = ",";	
				}
				result = result +   schar + comma ;
			}
			if(tmpH)
			{
 				result = tmpH + result;
	 		}

			sfield.value = result + belowzero;			
			
	   	}	
		return true;
	}

	function remove_comma(sfield)
	{
		money = sfield.value;
		var arr;
		arr = money.split(",");
		len = arr.length;	
		result = "";
		for (k=0; k < len; k++) 
		{
			result = result + arr[k];
		}
		return result;
	}	

	function check_dot(v_value)
	{
		v_len= v_value.length;
		for (var i=0; i< v_len; i++) 
		{
			schar = v_value.charAt(i);
			if (schar == "." )
			{
				return true;
			}
		}
		return false;
	}
		
	function onlyNumber() //onKeyPress 이벤트 기준
	{ 
  		if ( ((event.keyCode < 48) || (57 < event.keyCode) && (188 != event.keyCode)) && (45 != event.keyCode) 
  			&& (190 != event.keyCode) && (110 != event.keyCode) && (109 != event.keyCode) && (46 != event.keyCode)) 
  		{
  			event.returnValue=false;
  		}
	}


</script>


<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:60%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">LOT_NO 검색</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="lot_no_reg_frame" frameborder="0" width="99%" height="370" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- <a href="#" id="id-btn-dialog1" class="btn btn-purple btn-sm">Modal Dialog</a> -->
<div id="dialog-message" class="hide">
	<table class="table  table-bordered table-hover" style="margin-top:10px">
		<thead>
		</thead>
		<tbody>
			<tr>
				<th class="center col-xs-4" style="background-color:#f1f1f1">로트넘버 항목코드</th><td class="center col-xs-8"><input type="text" name="lotnocd" id="lotnocd"></td>
			</tr>
			<tr>
				<th class="center col-xs-4" style="background-color:#f1f1f1">로트넘버 항목명</th><td class="center col-xs-8" ><input type="text" name="lotnonm" id="lotnonm"></td>
			</tr>
		</tbody>
	</table>
</div><!-- #dialog-message -->

<script type="text/javascript">
<!--
	$( "#id-btn-dialog10" ).on('click', function(e) {
					e.preventDefault();
					
					var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
						modal: true,
						title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> jQuery UI Dialog</h4></div>",
						title_html: true,
						buttons: [ 
							{
								text: "저장",
								"class" : "btn btn-minier",
								click: function() {
									$( this ).dialog( "close" ); 
								} 
							},
							{
								text: "닫기",
								"class" : "btn btn-primary btn-minier",
								click: function() {
									$( this ).dialog( "close" ); 
								} 
							}
						]
					});
			
					/**
					dialog.data( "uiDialog" )._title = function(title) {
						title.html( this.options.title );
					};
					**/
				});

	$( document).on('click',".id-btn-dialog", function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
			width : 400,
			height: 500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>로트넘버관리항목</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "신규",
					"class" : "btn btn-primary  btn-minier",
					click: function() {
						e.preventDefault();
						var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
							modal: true,
							width : 500,
							height: 250,
							title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> 로트넘버등록</h4></div>",
							title_html: true,
							buttons: [ 
								{
									text: "저장",
									"class" : "btn btn-primary btn-minier",
									click: function() {
										registLotNo();
										$( this ).dialog( "close" ); 
									} 
								},
								{
									text: "닫기",
									"class" : "btn btn-minier",
									click: function() {
										$( this ).dialog( "close" ); 
									} 
								}
							]
						});
					} 
				},
				{
					text: "닫기",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

function lotnocdFlag(flag) {
	$("#lotnocdFlag").val(flag);
}


function getLotNo(page) {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = page;
	var search = $("#where").val();
	var lot_no_cd = $("#lot_no_cd").val();

	$.getJSON("ajax/lot_no.php",{"page":page, "mode":"get_lot_no", "rpp" : rpp, "adjacents" : adjacents, "where":search, "lot_no_cd":lot_no_cd},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					//if(json[i].lot_no_cd == "purchase") var clas = "매입";
					//else var clas = "매출";
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postLotNo('" + json[i].lot_no_cd + "','" + json[i].lot_no_nm + "')\">" + json[i].lot_no_cd + "</a></td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postLotNo('" + json[i].lot_no_cd + "','" + json[i].lot_no_nm + "')\">" + json[i].lot_no_nm + "</a></td>";
					tag += "</tr>";
				}
			}

			$("#lot_no_list tbody").html(tag);

			var table = "erp_lot_no";
			if(lot_no_cd == "" || lot_no_cd == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and lot_no_cd='"  + lot_no_cd + "'";
			}

			//getPaging(table,where,rpp,adjacents);
		}
	);
}
function postLotNo(lnc,lnn){
	$("#dialog-message").dialog("close");
	var arr = [];
	$.each($(".lot_no_cd") , function () {
		arr.push($(this).val());
	});
	var idx = jQuery.inArray(lnc, arr);
	//if(idx >= 0) {
	//	alert("동일 계정을 이미 선택하셨습니다");
	//} else {
		
		var flag = $("#lotnocdFlag").val();
		$("#lot_no_cd_" + flag).val(lnc);
		$("#lot_no_nm_" + flag).val(lnn);
	//}
}

function registLotNo(){
	if(!check_str($("#lot_no_cd").val(),"로트넘버 항목코드")) return false;
	if(!check_str($("#lot_no_nm").val(),"로트넘버 항목명")) return false;

	//var dataString = "mode=registLotNo&uid=" + $("#uid").val() + "&lot_no_cd=" + $("#lot_no_cd").val() + "&lot_no_nm=" + $("#lot_no_nm").val();
	var dataString = "mode=registLotNo&lot_no_cd=" + $("#lot_no_cd").val() + "&lot_no_nm=" + $("#lot_no_nm").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/lot_no.php",
		success : function(str) {
			if(str == "success") {
				//getPosition();
				$("#lot_no_cd").val("");
				$("#lot_no_nm").val("");
			} else {
				alert(str);
			}
		}
	});
}

function lot_no_reg(cidx)
{
	$("#id-btn-dialog1").modal({
		show: true,
		title : "LOT-NO 검색",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=base&action=listLotNoPop&idx="+cidx+"&pop=Y&dialogID=id-btn-dialog1";
	$("#lot_no_reg_frame").attr("src", url);
}


//-->
</script>

<!----------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-phone').mask('(999) 999-9999');
	$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
	$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});

	//override dialog's title function to allow for HTML titles
	$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
		_title: function(title) {
			var $title = this.options.title || '&nbsp;'
			if( ("title_html" in this.options) && this.options.title_html == true )
				title.html($title);
			else title.text($title);
		}
	}));
		
	//datepicker plugin
	//link
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true,
			language: "kr"
	})
	//show datepicker when clicking on the icon
	.next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
			
	//or change it into a date range picker
	$('.input-daterange').datepicker({autoclose:true});
			
			
	//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
	$('input[name=date-range-picker]').daterangepicker({
		'applyClass' : 'btn-sm btn-success',
		'cancelClass' : 'btn-sm btn-default',
		locale: {
			applyLabel: 'Apply',
			cancelLabel: 'Cancel',
		}
	})
	.prev().on(ace.click_event, function(){
		$(this).next().focus();
	});
			
	$('#timepicker1').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#timepicker1').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
				
	if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
		 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
		 icons: {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar',
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down',
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			today: 'fa fa-arrows ',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		}
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
});
</script>
<!----------------------------------------------------------------------------------------------------------------------->