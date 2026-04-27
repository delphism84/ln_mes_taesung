<?
$title = "구매요청서 품목 리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);


//$sql = "select * from erp_purchase_demand ";
//$t1 = mysql_fetch_object(mysql_query($sql));

//$sql = "select * from erp_purchase_demand A right join erp_purchase_demand_item B on A.uid=B.fid order by B.uid desc";
//$result = mysql_query($sql) or die (mysql_error());

if ( ! isset ( $where ) ){ 
	$where = " where A.purchase_cd like '%".trim($search_txt)."%' or account_nm like '%".trim($search_txt)."%'";
}else{
	$where = "";
}


$table = "erp_purchase_order";
$block = 10;

$sql = "select * from erp_purchase_demand A right join erp_purchase_demand_item B on A.uid=B.fid".$where;
$total_num = num_rows($sql);

$page = (is_numeric($page)) ? $page : 1; 



$sql = "select *, A.purchase_cd as apurchase_cd, B.purchase_cd as bpurchase_cd from erp_purchase_demand A right join erp_purchase_demand_item B on A.uid=B.fid".$where." order by  B.uid desc  limit ".($page-1)*$block.", ".$block;
//echo $sql; 
$result = query($sql);

?>


<script>
function postPurchaseDemand(uid,purchase_cd, purchase_dt, account_nm) {
	$(opener.document).find("#purchase_order_item tbody").empty(); //최초 tbody 초기화
	$(opener.document).find("#title").val(account_nm + " 납품건");
	$(opener.document).find("#purchase_uid").val(uid);
	$(opener.document).find("#purchase_cd").val(purchase_cd);
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
	var flag = $(opener.document).find("#flag").val();
	<?if ($mode !="modify")	{?>
		if (flag=='1')
		{
			$(opener.document).find("#purchase_order_item tbody").empty(); //최초 tbody 초기화
		}
	<?}?>

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


	var purchase_uid="";
	var purchase_cd="";
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
						//alert(json[0].purchase_cd)
					$(opener.document).find("#purchase_uid").val(json[0].uid);
					$(opener.document).find("#purchase_cd").val(json[0].purchase_cd);
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
					tag += "<td><input type='text' class='form-control' name='material[]' id='material_" + flag + "' value='" + json[i].material + "' readonly /></td>";
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
			//opener.parent.calculationTotal()
			$(opener.location).attr("href", "javascript:calculationTotal();");
			window.close();
		}
	);

	//window.open('', '_self', '');
	//window.close();
}


function postItem(item_cd, item_nm, standard1, material, unit, unit_price, remain_cnt, shortage_cnt, cnt, supply_price, tax, total_price, purchase_cd, uid) {
	var flag = $(opener.document).find("#flag").val();
	<?if ($mode !="modify")	{?>
		if (flag=='1')
		{
			$(opener.document).find("#purchase_order_item tbody").empty(); //최초 tbody 초기화
		}
	<?}?>

	var arr = [];
	var std1 = [];
	var item = [];

	var purchase_uid= uid;
	var purchase_cd= purchase_cd;
	var account_cd= [];
	var account_nm= [];
	var manager= [];
	var project_cd= [];
	var project_nm= [];
	var warehouse_cd= [];
	var deadline_dt= [];
	var tax_type=[];
	var memo= [];
	
	var tag = "";

	$.each($(opener.document).find(".item_cd") , function () {
		arr.push($(this).val());
	});
	$.each($(opener.document).find(".standard1") , function () {
		std1.push($(this).val());
	});

	
	for(var i = 0 ; i <= arr.length ; i++) {
		item.push(arr[i] + std1[i]);
	}

	var check = item_cd + standard1;

	var idx = jQuery.inArray(check, item);

	if(idx >= 0) {
		alert("동일 품목을 이미 선택하셨습니다.");
	} else {
		//$(opener.document).find("#purchase_uid").val(uid);
		//$(opener.document).find("#purchase_cd").val(purchase_cd);

		$.getJSON("../../ajax/purchase.php",{"mode":"getPurchaseDemandPop", "uid" : uid},
		function(json){
			if(json != null) {

					$(opener.document).find("#purchase_uid").val(json[0].uid);
					$(opener.document).find("#purchase_cd").val(json[0].purchase_cd);
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
				}
				//opener.parent.calculationTotal();
				$(opener.location).attr("href", "javascript:calculationTotal();"); 
			}
		);
		tag = "<tr class='item" + flag + "'>";
		tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this);calculationTotal(" + flag + ");'></i></td>";
		tag += "<td><input type='text' class='form-control id-btn-dialog item_cd ' name='item_cd[]' id='item_cd_" + flag + "' onclick='viewModal();itemFlag(" + flag + ")' value='" + item_cd + "' placeholder='품목선택을 하시려면 클릭하세요' readonly /></td>";
		tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "' value='" + item_nm + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control standard1' name='standard1[]' id='standard1_" + flag + "' value='" + standard1 + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control' name='material[]' id='material_" + flag + "' value='" + material + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + unit + "'  /></td>";
		tag += "<td><input type='text' class='form-control remain_cnt text-right' name='remain_cnt[]' id='remain_cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + remain_cnt + "' /></td>";
		tag += "<td><input type='text' class='form-control shortage_cnt text-right' name='shortage_cnt[]' id='shortage_cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + shortage_cnt + "' /></td>";
		tag += "<td><input type='text' class='form-control cnt text-right' name='cnt[]' id='cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + cnt + "' /></td>";
		tag += "<td><input type='text' class='form-control unit_price text-right' name='unit_price[]' id='unit_price_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + unit_price + "' /></td>";
		tag += "<td><input type='text' class='form-control supply_price text-right' name='supply_price[]' id='supply_price_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + supply_price + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control tax text-right' name='tax[]' id='tax_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + tax + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control total_price text-right' name='total_price[]' id='total_price_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + total_price + "' readonly /></td>";
		tag += "</tr>";

		$(opener.document).find("#purchase_order_item tbody").append(tag);

		$(opener.document).find("#flag").val(Number(flag) + 1);
		//opener.parent.calculationTotal();
		$(opener.location).attr("href", "javascript:calculationTotal();"); 
	}
	//self.close();
}

$(document).ready(function(){
	//$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	//$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var table = "erp_item";
	var where = $("#where").val();
	var rpp = 10;
	var adjacents = 4;

	getPaging(table,where,rpp,adjacents);
});

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	var search_txt = $("#search_txt").val()

	location.href = "?page=" + page + "&search_txt=" + search_txt ;
}

// 페이징 가져오기
function getPaging(table,where,rpp,adjacents){
	var data_string = "page=" + $("#page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents;

	$.ajax({
		type : "post",
		url : "../../_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#paging_area").html(str);
		}
	});
}

function setGb(val) {
	if(val == "all") $("#where").val("");
	else $("#where").val(" where item_gb='" + val + "'");
	setPage(1);
}

function search() {
	//$("#where").val(" where item_cd like '%" + $("#search_txt").val() + "%' or item_nm like '%" + $("#search_txt").val() + "%'");
	setPage(1);
}

function goPage() {
	location.href="/views/popup/purchaseDemandItemList.php"
}


//-->
</script>

<input type="hidden" name="purchase_uid" id="purchase_uid" value="" />
<input type="hidden" name="purchase_cd" id="purchase_cd" value="" />
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
				<input type="hidden" name="where" id="where" value="<?=$where?>" />
			<input type="hidden" name="page" id="page" value="<?=$page?>" />
			<div class="col-xs-4" style="float:left">
			<button class="btn btn-xs btn-info" type="button" onclick="goPage()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				전체보기
			</button>
			</div>
			<div class="col-xs-4" style="float:right">
				<div class="input-group">						
					<input type="text" class="form-control search-query" name="search_txt" id="search_txt" />
					<span class="input-group-btn">
						<button type="button" class="btn btn-purple btn-sm" onclick="search()">
							<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
							Search
						</button>
					</span>
				</div>
			</div>
				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="center" style="background-color:#f1f1f1"><input type="checkbox" name="chkAll" onClick="javascript:checkAll();" /></th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">일자-NO</th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">거래처명</th>
						<th class="col-xs-2 center" style="background-color:#f1f1f1">품목</th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">규격</th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">재질</th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">수량</th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">단가</th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">금액</th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">부가세</th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">합계</th>
						<th class="col-xs-1 center" style="background-color:#f1f1f1">진행상태</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {

			if($t->state=="0"){
			$state="구매요청";	
			}else if($t->state=="1"){
			$state="발주중";	
			}else if($t->state=="2"){
			$state="발주완료";	
			}else if($t->state=="3"){
			$state="구매완료";	
			}else if($t->state=="4"){
			$state="입고완료";	
			}else if($t->state=="5"){
			$state="구매취소";	
			}else if($t->state=="0"){
			$state="구매요청";	
			}
?>
					<tr><td class='center'><input type="checkbox" name="checkbox[]" id="checkbox" value="<?=$t->uid?>" /></td>
						<td class='center'><span style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>','<?=number_format($t->remain_cnt)?>','<?=number_format($t->shortage_cnt)?>','<?=number_format($t->cnt)?>','<?=number_format($t->supply_price)?>','<?=number_format($t->tax)?>','<?=number_format($t->total_price)?>','<?=$t->purchase_cd?>','<?=$t->uid?>')"><?=$t->apurchase_cd?></span></td>
						<td class='center' nowrap><span style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>','<?=number_format($t->remain_cnt)?>','<?=number_format($t->shortage_cnt)?>','<?=number_format($t->cnt)?>','<?=number_format($t->supply_price)?>','<?=number_format($t->tax)?>','<?=number_format($t->total_price)?>','<?=$t->purchase_cd?>','<?=$t->uid?>')">
						<?=($t->account_nm=="" || $t->account_nm=="null") ? "" : $t->account_nm?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postItem('<?=$t->item_cd?>','<?=$t->item_nm?>','<?=$t->standard1?>','<?=$t->material?>','<?=$t->unit?>','<?=number_format($t->unit_price)?>','<?=number_format($t->remain_cnt)?>','<?=number_format($t->shortage_cnt)?>','<?=number_format($t->cnt)?>','<?=number_format($t->supply_price)?>','<?=number_format($t->tax)?>','<?=number_format($t->total_price)?>','<?=$t->purchase_cd?>','<?=$t->uid?>')"><?=$t->item_nm?></span></td>
						<td class='center'><?=$t->standard1?></td>
						<td class='center'><?=$t->material?></td>
						<td class='center'><?=$t->cnt?></td>
						<td class='center'><?=number_format($t->unit_price)?></td>
						<td class='center'><?=number_format($t->supply_price)?></td>
						<td class='center'><?=number_format($t->tax)?></td>
						<td class='center'><?=number_format($t->total_price)?></td>
						<td class='center'><?=$state?></td>
					</tr>			
<?
}				
?>
<?
 if($total_num <= 0){?>
	       </tr><td colspan="12" class="center"> 등록된 데이터가 없습니다.</td></tr>
<?}?>
				</table>
				<div class="center" id="paging_area"></div>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix  center">
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