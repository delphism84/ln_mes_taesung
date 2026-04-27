<?
$title = "구매요청서 품목 리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");



//$sql = "select * from erp_purchase_demand ";
//$t1 = mysql_fetch_object(mysql_query($sql));

//$sql = "select * from erp_purchase_demand A right join erp_purchase_demand_item B on A.uid=B.fid order by B.uid desc";
//$result = mysql_query($sql) or die (mysql_error());

$sql = "select * from erp_purchase_order A left join erp_purchase_order_item B on A.uid=B.fid order by B.uid desc";
$result = mysql_query($sql) or die (mysql_error());

?>


<script>
function postPurchaseDemand(uid,p_order_cd, purchase_dt, account_nm) {
	$(opener.document).find("#title").val(account_nm + " 납품건");
	$(opener.document).find("#purchase_uid").val(uid);
	$(opener.document).find("#p_order_cd").val(p_order_cd);
	$(opener.document).find("#end_dt").val(purchase_dt);
	$(opener.location).attr("href", "javascript:getPurchaseDemandItem();");
	self.close();
}	
</script>
<script type="text/javascript">
<!--
	function checkAll() {
    var obj = document.frm;
    
    for(var i=0; i<obj.checkbox.length; i++) {
        obj.checkbox[i].checked = obj.chkAll.checked;
    }
}

function goSubmit(){
	//var uid = $("#purchase_uid").val();
	if ($("#checkbox:checked").length=="0")
	{
		alert('1개 이상 선택해야 합니다.');
		return false;
	}
	var uid=""
	$('#checkbox:checked').each(function() { 
        uid += $(this).val()+",";
    });

	if ($('input:checkbox[id="checkbox"]').is(":checked") == true)
	{
		uid_val = $('input:checkbox[id="checkbox"]').val();
	}

	var flag = $(opener.document).find("#flag").val();
	var purchase_uid="";
	var p_order_cd="";
	var account_cd="";
	var account_nm="";
	var manager="";
	var project_cd="";
	var project_nm="";
	var warehouse_cd="";
	var deadline_dt="";
	var tax_type="";
	var memo="";
	
	var tag = "";


	$.getJSON("../../ajax/purchase.php",{"mode":"getPurchaseDemandItemPop", "uid" : uid},
		function(json){
			if(json != null) {
						//alert(json[0].uid)
						//alert(json[0].p_order_cd)
					$(opener.document).find("#purchase_uid").val(json[0].uid);
					$(opener.document).find("#p_order_cd").val(json[0].p_order_cd);
					$(opener.document).find("#account_cd").val(json[0].account_cd);
					$(opener.document).find("#account_nm").val(json[0].account_nm);
					$(opener.document).find("#manager").val(json[0].manager);
					$(opener.document).find("#project_cd").val(json[0].project_cd);
					$(opener.document).find("#project_nm").val(json[0].project_nm);
					$(opener.document).find("#warehouse_cd").val(json[0].warehouse_cd);
					//$(opener.document).find('#warehouse_cd').append("<option value='" + val + "'>" + text + "</option>"); 
					$(opener.document).find("#deadline_dt").val(json[0].deadline_dt);
					$(opener.document).find("#tax_type").val(json[0].tax_type);
					//$(opener.document).find('#tax_type').append("<option value='" + val + "'>" + text + "</option>"); 
					$(opener.document).find("#memo").val(json[0].memo);

				for(var i = 0 ; i < json.length ; i++){
					
					tag = "<tr class='item" + flag + "'>";
					tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this);calculationTotal(" + flag + ");'></i></td>";
					tag += "<td><input type='text' class='form-control id-btn-dialog item_cd ' name='item_cd[]' id='item_cd_" + flag + "' onclick='viewModal();itemFlag(" + flag + ")' value='" + json[i].item_cd + "' placeholder='품목선택을 하시려면 클릭하세요' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "' value='" + json[i].item_nm + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='standard1[]' id='standard1_" + flag + "' value='" + json[i].standard1 + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + json[i].unit + "'  /></td>";
					tag += "<td><input type='text' class='form-control remain_cnt text-right' name='remain_cnt[]' id='remain_cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].remain_cnt + "' /></td>";
					tag += "<td><input type='text' class='form-control shortage_cnt text-right' name='shortage_cnt[]' id='shortage_cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].shortage_cnt + "' /></td>";
					tag += "<td><input type='text' class='form-control cnt text-right' name='cnt[]' id='cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].cnt + "' /></td>";
					tag += "<td><input type='text' class='form-control unit_price text-right' name='unit_price[]' id='unit_price_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].unit_price + "' /></td>";
					tag += "<td><input type='text' class='form-control supply_price text-right' name='supply_price[]' id='supply_price_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].supply_price + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control tax text-right' name='tax[]' id='tax_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].tax + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control total_price text-right' name='total_price[]' id='total_price_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].total_price + "' readonly /></td>";
					tag += "</tr>";
		
					$(opener.document).find("#purchase_order_item tbody").append(tag);
					$(opener.document).find("#flag").val(Number(flag) + 1);
				}
			}
			opener.parent.calculationTotal()
		}
	);

	//window.open('', '_self', '');
	//window.close();
}


//-->
</script>

<input type="hidden" name="purchase_uid" id="purchase_uid" value="" />
<input type="hidden" name="p_order_cd" id="p_order_cd" value="" />
<input type="hidden" name="account_cd" id="account_cd" value="" />
<input type="hidden" name="account_nm" id="account_nm" value="" />
<input type="hidden" name="manager" id="manager" value="" />
<input type="hidden" name="project_cd" id="project_cd" value="" />
<input type="hidden" name="project_nm" id="project_nm" value="" />
<input type="hidden" name="warehouse_cd" id="warehouse_cd" value="" />
<input type="hidden" name="deadline_dt" id="deadline_dt" value="" />
<input type="hidden" name="tax_type" id="tax_type" value="" />
<input type="hidden" name="memo" id="memo" value="" />
<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" />
				<input type="hidden" name="controller" id="controller" value="groupware" />
				<input type="hidden" name="action" id="action" value="registEleSettlement" />
				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="center" style="background-color:#f1f1f1"><input type="checkbox" name="chkAll" onClick="javascript:checkAll();" /></th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">발주번호</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">거래처명</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">품목</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">규격</th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">단위</th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">수량</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">금액(합계)</th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">진행상태</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
					<tr><td class='center'><input type="checkbox" name="checkbox[]" id="checkbox" value="<?=$t->uid?>" /></td>
						<td class='center'><?=$t->p_order_cd?></td>
						<td class='center'><?=$t->account_nm?></td>
						<td class='center'><?=$t->item_nm?></td>
						<td class='center'><?=$t->standard1?></td>
						<td class='center'><?=$t->unit?></td>
						<td class='center'><?=$t->cnt?></td>
						<td class='center'><?=$t->total_price?></td>
						<td class='center'><?=$t->progression?></td>
					</tr>			
<?
}				
?>
				</table>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix form-actions center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-info" type="button" onClick="goSubmit();">
				<i class="ace-icon fa fa-check bigger-110"></i>
				전체적용
			</button>
			<button class="btn btn-xs btn-info" type="button" onclick="self.close()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				창닫기
			</button>
		</div>
	</div><!-- // submit -->
</div><!-- /.page-content -->

<form method="post" action="">
	
</form>
<?
require_once("../../assets/pfoot.php");
?>