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
						<input type="hidden" name="action" id="action" value="updatePurchaseOrderItem" />
						<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />
						<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />
						<input type="hidden" name="cntTotal" id="cntTotal" value="" />
						<input type="hidden" name="unitPriceTotal" id="unitPriceTotal" value="" />
						<input type="hidden" name="supplyPriceTotal" id="supplyPriceTotal" value="" />
						<input type="hidden" name="taxTotal" id="taxTotal" value="" />
						<input type="hidden" name="priceTotal" id="priceTotal" value="" />
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">발주일자</th>
								<td class="col-xs-5">
									<input type="text" name="p_order_dt" id="p_order_dt" value="<?=$t->p_order_dt?>" readonly />
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">구매요청서</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="purchase_uid" id="purchase_uid" readonly />
												<input type="text" name="purchase_cd" id="purchase_cd" onclick="centerOpenWindow('views/popup/purchaseDemandItemList.php', '발주일자서 Item 리스트',1000, 800)" value="<?=$t->purchase_cd?>" readonly />
												<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/purchaseDemandItemList.php', '발주일자서 Item 리스트', 1000, 800)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 거래처</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="account_cd" id="account_cd" value="<?=$t->account_cd?>" readonly />
												<input type="text" name="account_nm" id="account_nm"  value="<?=$t->account_nm?>" onclick="centerOpenWindow('views/popup/accountList.php', '거래처리스트', 600, 500)" readonly />
												<span class="input-group-addon btn-purple"  style="cursor:pointer" onclick="centerOpenWindow('views/popup/accountList.php', '거래처리스트', 600, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 담당자</th>
								<td class="col-xs-5"><input type="text" name="manager" id="manager" value="<?=$t->manager?>"/> * 거래처 담당자</td>
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
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 입고창고</th>
								<td class="col-xs-5">
									<span class="input-icon input-icon-right">
										<div class="input-group">
											<input type="hidden" name="warehouse_cd" id="warehouse_cd" value="<?=$t->warehouse_cd?>" />
											<input type="text" name="warehouse_nm" id="warehouse_nm" value="<?=getWarehouseName($t->warehouse_cd)?>" onclick="centerOpenWindow('views/popup/warehouseList.php', '창고리스트', 600, 500)" readonly/>
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
												<input class=" date-picker" name="deadline_dt" id="deadline_dt" type="text" data-date-format="yyyy-mm-dd" value="<?=$t->deadline_dt?>"/>
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
								<th class="col-xs-1" style="background-color:#f1f1f1">오더구분</th>
								<td class="col-xs-5">
									<select name="order_gb" id="order_gb" onchange="tax_calculation(this.value)">
										<?for ($i=1; $i<= 12; $i++){?>
										<option value="<?=$i?>" <? if($t->order_gb == $i) echo "selected"; ?>><?=$i?>월</option>
										<?}?>
									</select>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">진행상태</th>
								<td class="col-xs-5">
									<select name="state" id="state" onchange="state_change(this.value)">
										<option value="0" <? if($t->state == 0) echo "selected"; ?>>구매요청</option>
										<option value="1" <? if($t->state == 1) echo "selected"; ?>>발주중</option>
										<option value="2" <? if($t->state == 2) echo "selected"; ?>>발주완료</option>
										<option value="3" <? if($t->state == 3) echo "selected"; ?>>발주취소</option>
										<option value="4" <? if($t->state == 4) echo "selected"; ?>>구매완료</option>
										<option value="5" <? if($t->state == 5) echo "selected"; ?>>입고완료</option>
										<option value="6" <? if($t->state == 6) echo "selected"; ?>>구매취소</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">비고</th>
								<td class="col-xs-11" colspan="3">
									<textarea id="memo" name="memo" class="form-control"><?=$t->memo?></textarea>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">첨부</th>
								<td colspan="3" class="col-xs-11">
									<input type="file" name="attach" id="attach" />
									<div>
									<?
									if (!empty($t->attach)) {
										$filename = explode('|',$t->attach);
										$change_filename = explode('|',$filename);
										$filesize = explode('|',$filesize);
										
										for($i = 0; $i < count($filename); $i++) {
											echo "<a href='/assets/download.php?module=file&downtype=&realname=".urlencode($filename[$i])."&downfile=".urlencode($filename[$i])."&mem_sn=".$mem_sn."'>{$filename[$i]} {$filesize[$i]}</a><br>";
										}						
									}		
									?>
									</div>
								</td>
							</tr>
						</table>
						
						<a class="btn btn-xs btn-success" onclick="centerOpenWindow('views/popup/orderItemList.php?mode=modify', '품목리스트', 1000, 600)">품목선택</a>
						<table id="purchase_order_item" class="table  table-bordered table-hover" style="margin-top:10px">
							<thead>
								<tr>
									<th class="detail-col center" style="background-color:#f1f1f1"></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">품목코드</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">품목명</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">규격</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">재질</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">단위</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1;">재고수량</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1;">부족수량</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">수량</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">단가</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">공급가액</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">부가세</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">합계금액</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan='13' class='center'>등록된 품목이 없습니다.</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<th class="center" style="background-color:#f1f1f1"></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
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
								</tr>
							<tfoot>			
						</table>
					</form>
				</div>
			</div><!-- /.row -->

			
			
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						등록
					</button>
					<button class="btn" type="reset"  onclick="window.parent.closeModal('<?=$dialogID?>');">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						닫기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<input type="hidden" name="flag" id="flag" value="1" />
<input type="hidden" name="sub_warehouse_cd" id="sub_warehouse_cd" value="<?=$t->warehouse_cd?>" />

<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->


<!-- Table Tr Add ------------------------------------------------------------------------------------------------------->
<script>
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
	getPurchaseOrderItem();


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

function getPurchaseOrderItem(){
	var uid = $("#uid").val();
	var flag = $("#flag").val();
	var tag = "";

	$.getJSON("ajax/purchase.php",{"mode":"getPurchaseOrderItem", "uid" : uid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag = "";
					tag += "<tr class='item" + flag + "'>";
					tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
					tag += "<td><input type='text' class='form-control id-btn-dialog item_cd ' name='item_cd[]' id='item_cd_" + flag + "' onclick='viewModal(), itemFlag(" + flag + ")'  value='" + json[i].item_cd + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "' value='" + json[i].item_nm + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='standard1[]' id='standard_" + flag + "' value='" + json[i].standard1 + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='material[]' id='material_" + flag + "' value='" + json[i].material + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='unit[]' id='unit_" + flag + "' value='" + json[i].unit + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control remain_cnt text-right' name='remain_cnt[]' id='remain_cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].remain_cnt + "' /></td>";
					tag += "<td><input type='text' class='form-control shortage_cnt text-right' name='shortage_cnt[]' id='shortage_cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].shortage_cnt + "' /></td>";
					tag += "<td><input type='text' class='form-control cnt text-right' name='cnt[]' id='cnt_" + flag + "' onkeyup='calculation(" + flag + ")' value='" + json[i].cnt + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' /></td>";
					tag += "<td><input type='text' class='form-control unit_price text-right' name='unit_price[]' id='unit_price_" + flag + "' value='" + json[i].unit_price + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' readonly /></td>";
					tag += "<td><input type='text' class='form-control supply_price text-right' name='supply_price[]' id='supply_price_" + flag + "' value='" + json[i].supply_price + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' readonly /></td>";
					tag += "<td><input type='text' class='form-control tax text-right' name='tax[]' id='tax_" + flag + "' value='" + json[i].tax + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control total_price text-right' name='total_price[]' id='total_price_" + flag + "' value='" + json[i].total_price + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' readonly /></td>";
					tag += "</tr>";
					$("#purchase_order_item tbody").append(tag);

					
					flag = Number(flag) + 1;
					$("#flag").val(flag);
					
				}
			}
			calculationTotal()
		}
	);
}

/******************************************************************************************************
:: 부가세 계산
******************************************************************************************************/
// 거래유형 선택에 따른 부가세 계산
function tax_calculation(tax_type){
	var cnt = new Array();
	var unit_price = new Array();
	var supply_price = new Array();
	var tax = new Array();
	var hap = new Array();

	var re_unit_price = new Array();
	var re_supply_price = new Array();
	var re_tax = new Array();
	var total = new Array();
	var values = 0;

	$.each($(".cnt") , function () {
		cnt.push(removeComma($(this).val()));
	});

	$.each($(".unit_price") , function () {
		unit_price.push(removeComma($(this).val()));
	});

	$.each($(".supply_price") , function () {
		supply_price.push(removeComma($(this).val()));
	});

	$.each($(".tax") , function () {
		tax.push(removeComma($(this).val()));
	});

	for(var i = 0 ; i < cnt.length ; i++) {
		if(cnt[i] > 0) {
			// 수량 * 판매단가
			values = Number(removeComma(cnt[i])) * Number(removeComma(unit_price[i]));

			// 부가세적용
			if(tax_type == 1) {
				// 공급가
				var supply_price = values/1.1;
				// 부가세
				var cal_tax = values-supply_price;
				// 합계금액
				var re_hap = values + cal_tax;
				
				re_unit_price.push(values);
				re_supply_price.push(supply_price);
				re_tax.push(cal_tax);
				total.push(values);
			} else { // 부가세 미적용
				// 공급가
				var supply_price = values;
				// 부가세
				var cal_tax = 0;
				// 합계금액
				var re_hap = values;

				
				re_unit_price.push(values);
				re_supply_price.push(supply_price);
				re_tax.push(cal_tax);
				total.push(values);
			}
		}
	}

	for (var i = 0 ; i < cnt.length ; i++)
	{
		if(removeComma(total[i]) > 0) {
			$(".supply_price").eq(i).val(commaSplit(Math.round(re_supply_price[i])));
			$(".tax").eq(i).val(commaSplit(Math.round(re_tax[i])));
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

function formSubmit(){
	
	//if(!check_str($("#purchase_cd").val(),"발주일자코드")) return false;
	if(!check_str($("#deadline_dt").val(),"납기일자")) return false;
	//if(!check_str($("#project_cd").val(),"프로젝트")) return false;
	if($("#warehouse_nm").val() == "") {
		alert("입고창고를 추가 하세요");
		$("#warehouse_nm").focus();
		return false;
	}

	if($(".priceTotal").text() == 0 || $(".priceTotal").text() == "") {
		alert("품목을 하나 이상 추가 하세요");
		return false;
	}

	if(!frm_submit($('input[name="cnt[]"]'),"수량")) return false;
	if(!frm_submit($('input[name="unit_price[]"]'),"판매단가")) return false;

	$("#cntTotal").val($(".cntTotal").html());
	$("#unitPriceTotal").val($(".unitPriceTotal").html());
	$("#supplyPriceTotal").val($(".supplyPriceTotal").html());
	$("#taxTotal").val($(".taxTotal").html());
	$("#priceTotal").val($(".priceTotal").html());
	$("#frm").submit();
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
		todayHighlight: true
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