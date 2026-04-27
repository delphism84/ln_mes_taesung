<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);

if ($arprice !="")
{

}

$tax= $arprice/11;
$supply_price = $arprice - $tax;

/*
if ($t->total_price==""){
	@$t->total_price = $supply_price;
}
if ($t->total_tax==""){
	@$t->total_tax = $tax;
}
*/
if ($t->purchasedt1==""){
	$t->purchasedt1= date('m');
}
if ($t->purchasedt2==""){
	$t->purchasedt2 = date('d');
}

	//$query = "select MAX(tid) AS num from erp_tax_invoice where left(tax_invoice_dt,8)='".str_replace("/","",substr($statement_no,0,10))."'";
	$query = "select MAX(tid) AS num from erp_tax_invoice where statement_no='".$statement_no ."'";
	//echo $query;
	//exit;
	$row = mysql_fetch_array(mysql_query($query));
	$cha = $row['num']+1;

	switch(strlen($cha)) {
	case "1" :
		$tax_invoice_ca =  "000".$cha;
	break;
	case "2" :
		$tax_invoice_ca =  "00".$cha;
	break;
	case "3" :
		$tax_invoice_ca =  "0".$cha;
	break;
	default :
		$tax_invoice_ca = "000".$cha;
	break;
	}
	?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">세금계산서내역</a>
				</li>
				<li class="active">세금계산서내역등록</li>
			</ul><!-- /.breadcrumb -->

			<div class="nav-search" id="nav-search">
				<form class="form-search">
					<span class="input-icon">
						<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
						<i class="ace-icon fa fa-search nav-search-icon"></i>
					</span>
				</form>
			</div><!-- /.nav-search -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					세금계산서내역등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						세금계산서내역등록을 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" >
						<input type="hidden" name="controller" id="controller" value="accounting" />
						<?if ($t->tid=="") {?>
						<input type="hidden" name="action" id="action" value="registTaxInvoiceInsert" />
						<?}else{ ?>
						<input type="hidden" name="action" id="action" value="registTaxInvoiceUpdate" />
						<?}?>
						<input type="hidden" name="statement_no" id="statement_no" value="<?=$statement_no?>" />
						<input type="hidden" name="statement_type" id="statement_type" value="<?=$statement_type?>" />
						<input type="hidden" name="tid" id="tid" value="<?=$t->tid?>" />
						<input type="hidden" name="totalprice" id="totalprice" value="<?=$t->total_price?>" />
						<input type="hidden" name="totaltax" id="totaltax" value="<?=$t->total_tax?>" />
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">일련번호</th>
								<td class="col-xs-5">
									<?if ($t->tid=="") {?>
									<input name="tax_invoice_dt" id="tax_invoice_dt" type="text" value='<?=str_replace("/","",substr($statement_no,0,10))."-".$tax_invoice_ca?>'/>
									<?}else{ ?>
									<input name="tax_invoice_dt" id="tax_invoice_dt" type="text" value='<?=$t->tax_invoice_dt ?>' readonly/>
									<?}?>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">청구/영수</th>
								<td class="col-xs-5">
									<label>
										<input type="radio" class="ace" name="settle" id="settle" value="1" <? if($t->settle == "1" || $t->settle == "") echo "checked"; ?> />
										<span class="lbl"> 청구</span>
									</label>

									<label>
										<input type="radio" class="ace" name="settle" id="settle" value="2"  <? if($t->settle == "2") echo "checked"; ?> />
										<span class="lbl"> 영수</span>
									</label>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">현금</th>
								<td class="col-xs-5">
									<input type="text" name="settle_amt1" id="settle_amt1" value="<?=$t->settle_amt1 ?>" value="0"/>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">수표</th>
								<td class="col-xs-5">
									<input type="text" name="settle_amt2" id="settle_amt2" value="<?=$t->settle_amt2 ?>" value="0"/>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">어음</th>
								<td class="col-xs-5"><input type="text" name="settle_amt3" id="settle_amt3" value="<?=$t->settle_amt3 ?>" value="0"/></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">외상매출금</th>
								<td class="col-xs-5">
									<input type="text" name="settle_amt4" id="settle_amt4" value="<?= ($arprice == "") ? number_format($t->settle_amt4) : number_format($arprice) ?>"/>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">비고</th>
								<td colspan="3" class="col-xs-11"><input type="text" class="form-control" name="summary" id="summary" value="<?=$t->summary ?>" /></td>
							</tr>
						</table>

						<a class="btn btn-xs btn-inverse" onclick="addTr()">삽입</a>
						<table id="taxinvoice" class="table  table-bordered table-hover" style="margin-top:10px">
							<colgroup>
							<col style="width:30px">
							<col style="width:120px">
							<col>
							<col>
							<col>
							<col>
							<col>
							<col>
							<col>
							<col>
							</colgroup>
							<thead>
								<tr>
									<th class="center" style="background-color:#f1f1f1"></th>
									<th class="center " style="background-color:#f1f1f1">월/일</th>
									<th class="center " style="background-color:#f1f1f1">품목코드</th>
									<th class="center " style="background-color:#f1f1f1">품명</th>
									<th class="center " style="background-color:#f1f1f1">규격</th>
									<th class="center " style="background-color:#f1f1f1">수량</th>
									<th class="center " style="background-color:#f1f1f1">단가</th>
									<th class="center " style="background-color:#f1f1f1">공급가액</th>
									<th class="center " style="background-color:#f1f1f1">부가세</th>
									<th class="center " style="background-color:#f1f1f1">비고</th>
								</tr>
							</thead>
							<tbody>
								<tr class="item1">
									<input type="hidden" name="idx_arr[]" id="idx_arr_1" >
									<td class="center"><i class='delBtn fa fa-check fa-1x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td ><select name="purchasedt1[]" id="purchasedt1_1" >
										<option value="">==</OPTION>
										<option value="1" <? if($t->purchasedt1 == "1") echo "selected"; ?>>1월</OPTION>
										<option value="2" <? if($t->purchasedt1 == "2") echo "selected"; ?>>2월</OPTION>
										<option value="3" <? if($t->purchasedt1 == "3") echo "selected"; ?>>3월</OPTION>
										<option value="4" <? if($t->purchasedt1 == "4") echo "selected"; ?>>4월</OPTION>
										<option value="5" <? if($t->purchasedt1 == "5") echo "selected"; ?>>5월</OPTION>
										<option value="6" <? if($t->purchasedt1 == "6") echo "selected"; ?>>6월</OPTION>
										<option value="7" <? if($t->purchasedt1 == "7") echo "selected"; ?>>7월</OPTION>
										<option value="8" <? if($t->purchasedt1 == "8") echo "selected"; ?>>8월</OPTION>
										<option value="9" <? if($t->purchasedt1 == "9") echo "selected"; ?>>9월</OPTION>
										<option value="10" <? if($t->purchasedt1 == "10") echo "selected"; ?>>10월</OPTION>
										<option value="11" <? if($t->purchasedt1 == "11") echo "selected"; ?>>11월</OPTION>
										<option value="12" <? if($t->purchasedt1 == "12") echo "selected"; ?>>12월</OPTION>
									</select>&nbsp;<input type="text" name="purchasedt2[]" id="purchasedt2_1" value="<?=$t->purchasedt2?>" class="box" maxlength="2" style="width:30px" tabindex="1" ></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" name="item_cd[]" id="item_cd_1" onclick="itemFlag(1)"  placeholder="품목선택" readonly /></td>
									<td><input type="text" class="form-control" name="item_nm[]" id="item_nm_1"  /></td>
									<td><input type="text" class="form-control" name="standard[]" id="standard_1"  /></td>
									<td><input type="text" class="form-control cnt text-right" name="cnt[]" id="cnt_1" /></td>
									<td><input type="text" class="form-control unit_price text-right" name="unit_price[]" id="unit_price_1" onkeyup="calculation(1)" /></td>
									<td><input type="text" class="form-control text-right" name="supply_price[]" id="supply_price_1" value="<?=@number_format($supply_price)?>" /></td>
									<td><input type="text" class="form-control tax text-right" name="tax[]" id="tax_1" value="<?=@number_format($tax)?>" /></td>
									<td><input type="text" class="form-control " name="remark[]" id="remark_1"  /></td>
								</tr>
								<tr class="item2">
									<input type="hidden" name="idx_arr[]" id="idx_arr_2" >
									<td class="center"><i class='delBtn fa fa-check fa-1x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><select name="purchasedt1[]" id="purchasedt1_2" >
										<option value="">==</OPTION>
										<option value="1">1월</OPTION>
										<option value="2">2월</OPTION>
										<option value="3">3월</OPTION>
										<option value="4">4월</OPTION>
										<option value="5">5월</OPTION>
										<option value="6">6월</OPTION>
										<option value="7">7월</OPTION>
										<option value="8">8월</OPTION>
										<option value="9">9월</OPTION>
										<option value="10">10월</OPTION>
										<option value="11">11월</OPTION>
										<option value="12">12월</OPTION>
									</select>&nbsp;<input type="text" name="purchasedt2[]" id="purchasedt2_2" class="box" maxlength="2" style="width:30px" tabindex="2" ></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" name="item_cd[]" id="item_cd_2" onclick="itemFlag(2)" placeholder="품목선택" readonly /></td>
									<td><input type="text" class="form-control" name="item_nm[]" id="item_nm_2"  /></td>
									<td><input type="text" class="form-control" name="standard[]" id="standard_2"  /></td>
									<td><input type="text" class="form-control cnt text-right" name="cnt[]" id="cnt_2" /></td>
									<td><input type="text" class="form-control unit_price text-right" name="unit_price[]" id="unit_price_2" onkeyup="calculation(2)" /></td>
									<td><input type="text" class="form-control text-right" name="supply_price[]" id="supply_price_2"  /></td>
									<td><input type="text" class="form-control tax text-right" name="tax[]" id="tax_2"  /></td>
									<td><input type="text" class="form-control " name="remark[]" id="remark_2"  /></td>
								</tr>
								<tr class="item3">
									<input type="hidden" name="idx_arr[]" id="idx_arr_3" >
									<td class="center"><i class='delBtn fa fa-check fa-1x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><select name="purchasedt1[]" id="purchasedt1_3" >
										<option value="">==</OPTION>
										<option value="1">1월</OPTION>
										<option value="2">2월</OPTION>
										<option value="3">3월</OPTION>
										<option value="4">4월</OPTION>
										<option value="5">5월</OPTION>
										<option value="6">6월</OPTION>
										<option value="7">7월</OPTION>
										<option value="8">8월</OPTION>
										<option value="9">9월</OPTION>
										<option value="10">10월</OPTION>
										<option value="11">11월</OPTION>
										<option value="12">12월</OPTION>
									</select> <input type="text" class="no-border" name="purchasedt2[]" id="purchasedt2_3" class="box" maxlength="2" style="width:30px" tabindex="2"></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" name="item_cd[]" id="item_cd_3" onclick="itemFlag(3)" placeholder="품목선택" readonly /></td>
									<td><input type="text" class="form-control" name="item_nm[]" id="item_nm_3"  /></td>
									<td><input type="text" class="form-control" name="standard[]" id="standard_3"  /></td>
									<td><input type="text" class="form-control cnt text-right" name="cnt[]" id="cnt_3" /></td>
									<td><input type="text" class="form-control unit_price text-right" name="unit_price[]" id="unit_price_3" onkeyup="calculation(3)" /></td>
									<td><input type="text" class="form-control text-right" name="supply_price[]" id="supply_price_3"  /></td>
									<td><input type="text" class="form-control tax text-right" name="tax[]" id="tax_3"  /></td>
									<td><input type="text" class="form-control " name="remark[]" id="remark_3"  /></td>
								</tr>
								<tr class="item4">
									<input type="hidden" name="idx_arr[]" id="idx_arr_4" >
									<td class="center"><i class='delBtn fa fa-check fa-1x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><select name="purchasedt1[]" id="purchasedt1_4" >
										<option value="">==</OPTION>
										<option value="1">1월</OPTION>
										<option value="2">2월</OPTION>
										<option value="3">3월</OPTION>
										<option value="4">4월</OPTION>
										<option value="5">5월</OPTION>
										<option value="6">6월</OPTION>
										<option value="7">7월</OPTION>
										<option value="8">8월</OPTION>
										<option value="9">9월</OPTION>
										<option value="10">10월</OPTION>
										<option value="11">11월</OPTION>
										<option value="12">12월</OPTION>
									</select>&nbsp;<input type="text" class="no-border" name="purchasedt2[]" id="purchasedt2_4" class="box" maxlength="2" style="width:30px" tabindex="4" ></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" name="item_cd[]" id="item_cd_4" onclick="itemFlag(4)" placeholder="품목선택" readonly /></td>
									<td><input type="text" class="form-control" name="item_nm[]" id="item_nm_4"  /></td>
									<td><input type="text" class="form-control" name="standard[]" id="standard_4"  /></td>
									<td><input type="text" class="form-control cnt text-right" name="cnt[]" id="cnt_4" /></td>
									<td><input type="text" class="form-control unit_price text-right" name="unit_price[]" id="unit_price_4" onkeyup="calculation(4)" /></td>
									<td><input type="text" class="form-control text-right" name="supply_price[]" id="supply_price_4"  /></td>
									<td><input type="text" class="form-control tax text-right" name="tax[]" id="tax_4"  /></td>
									<td><input type="text" class="form-control " name="remark[]" id="remark_4"  /></td>
								</tr>
								<tr><th class="center" style="background-color:#f1f1f1;height:30px"><SPAN></SPAN></th>
									<th class="center " style="background-color:#f1f1f1;height:30px"><SPAN></SPAN></th>
									<th class="center " style="background-color:#f1f1f1;height:30px"><SPAN></SPAN></th>
									<th class="center " style="background-color:#f1f1f1;height:30px"><SPAN></SPAN></th>
									<th class="center " style="background-color:#f1f1f1"><SPAN></SPAN></th>
									<th class="center " style="background-color:#f1f1f1"><SPAN></SPAN></th>
									<th class="center " style="background-color:#f1f1f1"><SPAN ></SPAN></th>
									<th class="center " style="background-color:#f1f1f1"><SPAN class="supply_price_Total"><?= ($supply_price == "") ? number_format($t->total_price) : number_format($supply_price) ?></SPAN></th>
									<th class="center " style="background-color:#f1f1f1"><SPAN class="tax_Total "><?= ($tax == "") ? number_format($t->total_tax) : number_format($tax) ?></SPAN></th>
									<th class="center " style="background-color:#f1f1f1"><SPAN></SPAN></th>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div><!-- /.row -->
			
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						적용
					</button>

					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록가기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<input type="hidden" name="flag" id="flag" value="1" />
<input type="hidden" name="itemFlag" id="itemFlag" value="" />

<div id="dialog-message1" class="dialog-view hide">
	<table id="account_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-2 center" style="background-color:#f1f1f1">거래처구분</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">거래처코드</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">거래처명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<div id="dialog-message2" class="dialog-view hide">
	<table id="project_list" class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">프로젝트코드</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">프로젝트명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<div id="dialog-message3" class="dialog-view hide">
	<select name="item_gb" id="item_gb">
		<option>전체</option>
		<option value="component">자재</option>
		<option value="semi_product">반제품</option>
		<option value="product" selected>완제품</option>
	</select>
	<table id="item_list" class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-1 center" style="background-color:#f1f1f1">구분</th>
				<th class="col-xs-3 center" style="background-color:#f1f1f1">품목코드</th>
				<th class="col-xs-4 center" style="background-color:#f1f1f1">품목명</th>
				<th class="col-xs-4 center" style="background-color:#f1f1f1">규격</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<!-- Table Tr Add ------------------------------------------------------------------------------------------------------->
<script>
function addTr(){
	var currentFlag = $("#flag").val();
	var tag = "";
	tag += "<tr class='item" + currentFlag + "'>";
	tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-1x' aria-hidden='true' onclick='delTr(this)'></i></td>";
	tag += "<td><select name='purchasedt1[]' id='purchasedt1_" + currentFlag + "'>";
	tag += "<option value=''>==</OPTION>";
	tag += "<option value='1'>1월</OPTION>";
	tag += "<option value='2'>2월</OPTION>";
	tag += "<option value='3'>3월</OPTION>";
	tag += "<option value='4'>4월</OPTION>";
	tag += "<option value='5'>5월</OPTION>";
	tag += "<option value='6'>6월</OPTION>";
	tag += "<option value='7'>7월</OPTION>";
	tag += "<option value='8'>8월</OPTION>";
	tag += "<option value='9'>9월</OPTION>";
	tag += "<option value='10'>10월</OPTION>";
	tag += "<option value='11'>11월</OPTION>";
	tag += "<option value='12'>12월</OPTION>";
	tag += "</select> <input type='text' class='no-border' name='purchasedt2[]' id='purchasedt2_" + currentFlag + "' class='box' maxlength='2' style='width:30px' tabindex='2'></td>";
	tag += "<td><input type='text' class='form-control id-btn-dialog item_cd' name='item_cd[]' id='item_cd_" + currentFlag + "' onclick='itemFlag(" + currentFlag + ")'  placeholder='품목선택' readonly /></td>";
	tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + currentFlag + "' readonly /></td>";
	tag += "<td><input type='text' class='form-control' name='standard[]' id='standard_" + currentFlag + "' readonly /></td>";
	tag += "<td><input type='text' class='form-control cnt' name='cnt[]' id='cnt_" + currentFlag + "' /></td>";
	tag += "<td><input type='text' class='form-control unit_price' name='unit_price[]' id='unit_price_" + currentFlag + "' onkeyup='calculation(" + currentFlag + ")' /></td>";
	tag += "<td><input type='text' class='form-control' name='supply_price[]' id='supply_price_" + currentFlag + "' readonly /></td>";
	tag += "<td><input type='text' class='form-control tax' name='tax[]' id='tax_" + currentFlag + "' readonly /></td>";
	tag += "<td><input type='text' class='form-control remark' name='remark[]' id='remark_" + currentFlag + "' /></td>";
	tag += "</tr>";
	$("#taxinvoice").append(tag);
	
	var nextFlag = Number(currentFlag) + 1;
	$("#flag").val(nextFlag);
}

function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#flag").val(nextFlag);
}
</script>
<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getProject();
	getAccount();
	getWarehouse();
	getItem();
	createEstimateCode();

	getTaxInvoiceItem();
	//calculation_hap();

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

function getTaxInvoiceItem(){
	var tid = $("#tid").val();
	var currentFlag = $("#flag").val();
	var tag = "";
	var supply_price_Total = 0;
	var tax_Total = 0;
	$.getJSON("ajax/tax_invoice.php",{"mode":"getTaxInvoiceItem", "tid" : tid},
		function(json){

			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					if(i < 4) {
						//alert(json[i].purchasedt1)
						$("#idx_arr_" + currentFlag).val(json[i].uid);	
						$("#purchasedt1_" + currentFlag + " option:eq("+parseInt(json[i].purchasedt1) +")").attr("selected", "selected");
						//$("#purchasedt1_" + currentFlag + " > option[@value="+parseInt(json[i].purchasedt1+"]").attr("selected", "true");
						$("#purchasedt2_" + currentFlag).val(json[i].purchasedt2);
						$("#item_cd_" + currentFlag).val(json[i].item_cd);
						$("#item_nm_" + currentFlag).val(json[i].item_nm);
						$("#standard_" + currentFlag).val(json[i].standard);
						$("#cnt_" + currentFlag).val(json[i].cnt);
						$("#unit_price_" + currentFlag).val(commaSplit(json[i].unit_price));
						$("#supply_price_" + currentFlag).val(commaSplit(json[i].supply_price));
						$("#tax_" + currentFlag).val(commaSplit(json[i].tax));
					} else {
						tag += "<tr class='item" + currentFlag + "'>";
						tag += "<input type='hidden' name='idx_arr[]' id='idx_arr_" + currentFlag + "'>";
						tag += "<td><select name='purchasedt1[]' id='purchasedt1_" + currentFlag + "'>";
						tag += "<option value=''>==</OPTION>";
						tag += "<option value='1'>1월</OPTION>";
						tag += "<option value='2'>2월</OPTION>";
						tag += "<option value='3'>3월</OPTION>";
						tag += "<option value='4'>4월</OPTION>";
						tag += "<option value='5'>5월</OPTION>";
						tag += "<option value='6'>6월</OPTION>";
						tag += "<option value='7'>7월</OPTION>";
						tag += "<option value='8'>8월</OPTION>";
						tag += "<option value='9'>9월</OPTION>";
						tag += "<option value='10'>10월</OPTION>";
						tag += "<option value='11'>11월</OPTION>";
						tag += "<option value='12'>12월</OPTION>";
						tag += "</select> <input type='text' class='no-border' name='purchasedt2[]' id='purchasedt2_" + currentFlag + "' class='box' maxlength='2' style='width:30px' tabindex='2'></td>";
						tag += "<td><input type='text' class='form-control id-btn-dialog item_cd' name='item_cd[]' id='item_cd_" + currentFlag + "' onclick='itemFlag(" + currentFlag + ")'  placeholder='품목선택' readonly /></td>";
						tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + currentFlag + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control' name='standard[]' id='standard_" + currentFlag + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control cnt' name='cnt[]' id='cnt_" + currentFlag + "' onkeyup='calculation(" + currentFlag + ")' /></td>";
						tag += "<td><input type='text' class='form-control unit_price' name='unit_price[]' id='unit_price_" + currentFlag + "' onkeyup='calculation(" + currentFlag + ")' /></td>";
						tag += "<td><input type='text' class='form-control' name='supply_price[]' id='supply_price_" + currentFlag + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control tax' name='tax[]' id='tax_" + currentFlag + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control remark' name='remark[]' id='remark_" + currentFlag + "' readonly /></td>";
						tag += "</tr>";
						alert(tag)
						$("#taxinvoice").append(tag);
					}
					supply_price_Total += parseInt(json[i].supply_price);
					tax_Total += parseInt(json[i].tax);
					currentFlag = Number(currentFlag) + 1;
				}
				$(".supply_price_Total").html(Num2Money(supply_price_Total));
				$(".tax_Total").html(Num2Money(tax_Total));
				var utTotalPriceRe = (parseInt(removeComma(supply_price_Total)) + parseInt(removeComma(tax_Total)));
				$("#settle_amt4").val(Num2Money(utTotalPriceRe));
				$("#totalprice").val(removeComma(supply_price_Total));
				$("#totaltax").val(removeComma(tax_Total));
				var nextFlag = Number(currentFlag) + 1;
				$("#flag").val(nextFlag);
			} else {
				$("#flag").val("4");
			}
		}
	);
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

function createEstimateCode(){
	var data_string = "mode=createEstimateCode";
	$.ajax({
		type : "post",
		url : "ajax/estimate.php",
		data : data_string,
		success : function(str) {
			$("#estimate_cd").val(str);
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
	//var tax_type = $("#tax_type option:selected").val();

	var cnt = $("#cnt_" + flag).val();
	//var supply_price = $("#supply_price_" + flag).val();
	var unit_price = $("#unit_price_" + flag).val();
	var values = Number(removeComma(cnt)) * Number(removeComma(unit_price));
	//alert(values)
	// 부가세적용
	/*
	if(tax_type == 1) {
		var supply_price = values/1.1;
		var tax = values-supply_price;

		$("#total_price_" + flag).val(commaSplit(Math.round(values + tax)));
	} else {
		var tax = 0;
		$("#total_price_" + flag).val(commaSplit(Math.round(values + tax)));
	}
	*/

	var supply_price = values/10;
	//var tax = values-supply_price;
	var tax = supply_price;
	$("#unit_price_" + flag).val(Num2Money(unit_price));
	$("#supply_price_" + flag).val(Num2Money(values));
	$("#tax_" + flag).val(commaSplit(Math.round(tax)));

	if ($("input[name='supply_price[]']").length > 0) {
	
		var supply_price_Total = 0;
		var tax_Total = 0;

		$("input[name='supply_price[]']").each(function () {
			var supply_price = Money2Num($(this).val());
			if (supply_price != "" && !isNaN(supply_price))
				supply_price_Total = supply_price_Total + parseInt(supply_price, 10);
		});

		$("input[name='tax[]']").each(function () {
			var tax = Money2Num($(this).val());
			if (tax != "" && !isNaN(tax))
				tax_Total = tax_Total + parseInt(tax, 10);
		});

		$(".supply_price_Total").html(Num2Money(supply_price_Total));
		$(".tax_Total").html(Num2Money(tax_Total));
		
		var utTotalPriceRe = (parseInt(removeComma($(".supply_price_Total").text())) + parseInt(removeComma($(".tax_Total").text())));
		$("#settle_amt4").val(Num2Money(utTotalPriceRe));
		$("#totalprice").val(removeComma($(".supply_price_Total").text()));
		$("#totaltax").val(removeComma($(".tax_Total").text()));

	}

}


// 공급가액 계산
function calculation_hap() {
	if ($("input[name='supply_price[]']").length > 0) {
	
		var supply_price_Total = 0;
		var tax_Total = 0;

		$("input[name='supply_price[]']").each(function () {
			var supply_price = Money2Num($(this).val());
			if (supply_price != "" && !isNaN(supply_price))
				supply_price_Total = supply_price_Total + parseInt(supply_price, 10);
		});

		$("input[name='tax[]']").each(function () {
			var tax = Money2Num($(this).val());
			if (tax != "" && !isNaN(tax))
				tax_Total = tax_Total + parseInt(tax, 10);
		});

		$(".supply_price_Total").html(Num2Money(supply_price_Total));
		$(".tax_Total").html(Num2Money(tax_Total));
		
		var utTotalPriceRe = (parseInt(removeComma($(".supply_price_Total").text())) + parseInt(removeComma($(".tax_Total").text())));
		$("#settle_amt4").val(Num2Money(utTotalPriceRe));
		$("#totalprice").val(removeComma($(".supply_price_Total").text()));
		$("#totaltax").val(removeComma($(".tax_Total").text()));
	}

}

function createItemGroupCode(){
	var data_string = "mode=createItemGroupCode";

	$.ajax({
		type : "post",
		url : "ajax/ajax.php",
		data : data_string,
		success : function(str) {
			$("#sub_item_group_cd").val(str);
		}
	});	
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
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postProject('" + json[i].project_cd + "','" + json[i].project_nm + "')\">" + json[i].project_cd + "</a></td>";
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
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					switch(json[i].item_gb) {
						case "product" : var item_gb = "완제품"; break;
						case "semi_product" : var item_gb = "반제품"; break;
						case "component" : var item_gb = "자재"; break;
						default : var item_gb = "자재"; break;
					}
					tag += "<tr>";
					tag += "<td>" + item_gb + "</td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postItem('" + json[i].item_cd + "','" + json[i].item_nm + "','" + json[i].standard + "','" + json[i].pur_unit_price + "','" + json[i].unit_price + "','" + json[i].lot_no + "')\">" + json[i].item_cd + "</a></td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "</tr>";
				}
			}

			$("#item_list tbody").html(tag);

			var table = "erp_item";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function postItem(item_cd,item_nm,standard,pur_unit_price,unit_price){
	$("#dialog-message3").dialog("close");
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
		$("#standard_" + flag).val(standard);
		//$("#supply_price_" + flag).val(pur_unit_price);
		//$("#unit_price_" + flag).val(unit_price);
	}
}

// 거래처 리스트 가져오기
function getAccount(){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var account_gb = $("#account_gb").val();

	$.getJSON("ajax/account.php",{"page":page, "mode":"getAccount", "rpp" : rpp, "adjacents" : adjacents, "where":search, "account_gb":account_gb},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					if(json[i].account_gb == "purchase") var clas = "매입";
					else var clas = "매출";
					
					tag += "<tr>";
					tag += "<td class='center'>" + clas + "</td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccount('" + json[i].account_cd + "','" + json[i].account_nm + "','" + json[i].manager + "')\">" + json[i].account_cd + "</a></td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_list tbody").html(tag);

			var table = "erp_account";
			if(account_gb == "" || account_gb == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			}

			getPaging(table,where,rpp,adjacents);
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
	$("#dialog-message3").dialog("close");
	var arr = [];
	$.each($(".aci_cd") , function () {
		arr.push($(this).val());
	});
	var idx = jQuery.inArray(aci_cd, arr);
	//if(idx >= 0) {
	//	alert("동일 계정을 이미 선택하셨습니다");
	//} else {
		//var flag = $("#acicdFlag").val();
		$("#aci_cd_" + flag).val(aci_cd);
		$("#aci_nm_" + flag).val(aci_nm);
	//}
}

function postProject(code,name) {
	$("#project_cd").val(code);
	$("#project_nm").val(name);
}

function formSubmit(){
	$("#frm").submit();
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
				
	$( "#id-btn-dialog1" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>거래처 리스트</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

				
	$( "#id-btn-dialog2" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message2" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>프로젝트 리스트</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	$( document).on('click',".id-btn-dialog", function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message3" ).removeClass('hide').dialog({
			width : 700,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>품목 리스트</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	
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