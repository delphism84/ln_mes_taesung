<?
$title = "발주서 품목 리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);


//$sql = "select * from erp_purchase_demand ";
//$t1 = mysql_fetch_object(mysql_query($sql));

//$sql = "select * from erp_purchase_demand A right join erp_purchase_demand_item B on A.uid=B.fid order by B.uid desc";
//$result = mysql_query($sql) or die (mysql_error());

$where = " where state !='7'";

if ( ! isset ( $where ) ){ 
	$where = " AND p_order_cd like '%".trim($search_txt)."%' or account_nm like '%".trim($search_txt)."%'";
}else{
	$where = "";
}

$table = "erp_purchase_order";
$block = 10;

$sql = "select * from ".$table.$where;
$total_num = num_rows($sql);

$page = (is_numeric($page)) ? $page : 1; 

$sql = "select * from ".$table.$where." order by uid desc  limit ".($page-1)*$block.", ".$block;
//echo $sql; 
$result = mysql_query($sql);

?>


<script>


$(document).ready(function(){
	//$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	//$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var table = "erp_purchase_order";
	var where = $("#where").val();
	var rpp = 10;
	var adjacents = 4;

	getPaging(table,where,rpp,adjacents);
});


function postPurchaseOrder(uid, p_order_cd, account_cd, account_nm, manager, project_cd, project_nm, warehouse_cd, warehouse_nm, deadline_dt, tax_type) {
	var flag = $(opener.document).find("#flag").val();
	<?if ($mode !="modify")	{?>
		if (flag=='1')
		{
			$(opener.document).find("#warehousing_item tbody").empty(); //최초 tbody 초기화
		}
	<?}?>
	
	var warehouse_cd = $("#remains option:selected").val();
	if(warehouse_cd == "") {
		alert("잔량 OR 전체인지 선택하세요");
		return false;
	}

	$(opener.document).find("#p_order_uid").val(uid);
	$(opener.document).find("#p_order_cd").val(p_order_cd);
	$(opener.document).find("#account_cd").val(account_cd);
	$(opener.document).find("#account_nm").val(account_nm);
	$(opener.document).find("#manager").val(manager);
	$(opener.document).find("#project_cd").val(project_cd);
	$(opener.document).find("#project_nm").val(project_nm);
	$(opener.document).find("#warehouse_cd").val(warehouse_cd);
	$(opener.document).find("#warehouse_nm").val(warehouse_nm);
	$(opener.document).find("#deadline_dt").val(deadline_dt);
	$(opener.document).find("#tax_type").val(tax_type);
	$(opener.location).attr("href", "javascript:getPurchaseOrderItem();");
	self.close();
}	

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
	location.href="/views/popup/purchaseOrderItemList.php"
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
			$(opener.document).find("#warehousing_item tbody").empty(); //최초 tbody 초기화
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


	$.getJSON("../../ajax/purchase.php",{"mode":"getPurchaseOrderItemPop", "uid" : uid},
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

function underline(obj){
	/*
	$( "table tr:first-child" )
	  .css( "text-decoration", "underline" )
	  .hover(function() {
		$( this ).addClass( "sogreen" );
	  }, function() {
		$( this ).removeClass( "sogreen" );
	  });
	*/
	 //$("#simple-table").css( "text-decoration", "underline" )
	 //$("table tr:first-child").css( "text-decoration", "underline" )
	 //$(".line_"+obj).css( "text-decoration", "underline" )
	 $(".line_"+obj).mouseover(function() {
		 $(".line_"+obj).css( "text-decoration", "underline" )
		 $(".line_"+obj).css( "color", "#0080ff" )
		 });

	 $(".line_"+obj).mouseout(function() {
		 $(".line_"+obj).css( "text-decoration", "none" )
		 $(".line_"+obj).css( "color", "#000000" )
		 });
}

//-->
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			
			<!-- PAGE CONTENT BEGINS -->
			<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" />
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
			<input type="hidden" name="where" id="where" value="<?=$where?>" />
			<input type="hidden" name="page" id="page" value="<?=$page?>" />
			<div style="float:left">
			<button class="btn btn-xs btn-info" type="button" onclick="goPage()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				전체보기
			</button>
			</div>
			<div class="col-xs-2" style="float:left;margin-bottom:5px">
			<select name="remains" id="remains" class="form-control" onchange="getPurchase(1)">
				<option value='part'>잔량적용</option>
				<option value='all'>전체적용</option>
			</select> 
			</div>
			<div style="float:left"><span style='color:red'>※발주서건을 다시 구매 입고 처리 시 전체적용을 선택하세요.</span>
			</div>
			<div class="col-xs-4" style="float:right">
				<div class="input-group">						
					<input type="text" class="form-control search-query" name="search_txt" id="search_txt" onkeypress="if(event.keyCode==13) {search(); return false;}"/>
					<span class="input-group-btn">
						<button type="button" class="btn btn-purple btn-sm" onclick="search()">
							<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
							Search
						</button>
					</span>
				</div>
			</div>
			<input type="hidden" name="controller" id="controller" value="groupware" />
			<input type="hidden" name="action" id="action" value="registEleSettlement" />
			<table id="simple-table" class="table  table-bordered table-hover">
				<tr>
					<th class="center" style="background-color:#f1f1f1"><input type="checkbox" name="chkAll" onClick="javascript:checkAll();" /></th>
					<th class="col-xs-2 center" style="background-color:#f1f1f1">발주번호</th>
					<th class="col-xs-2 center" style="background-color:#f1f1f1">거래처명</th>
					<th class="col-xs-3 center" style="background-color:#f1f1f1">품목</th>
					<th class="col-xs-2 center" style="background-color:#f1f1f1">납기일자</th>
					<th class="col-xs-2 center" style="background-color:#f1f1f1">금액(합계)</th>
					<th class="col-xs-1 center" style="background-color:#f1f1f1">진행상태</th>
				</tr>
<?
$i = "0";
while($t = mysql_fetch_object($result)) {

		$query = "select * from erp_purchase_order_item where fid=".$t->uid." order by uid";
			//echo $query;
			$result2 = mysql_query($query);
			$cnt = mysql_num_rows($result2);
			$sum = 0;
			//$cnt = "0";
			while($t2 = mysql_fetch_object($result2)) {
				$sum = $sum + $t2->total_price;
			//$cnt++
				$item_nm = $t2->item_nm;	
			}
			if ($cnt > "1"){
				$cnt_text = " 외 ".($cnt-1)."건";
			}
			if($t->state=="0"){
			$state="구매요청";	
			}else if($t->state=="1"){
			$state="발주중";	
			}else if($t->state=="2"){
			$state="발주완료";	
			}else if($t->state=="3"){
			$state="발주취소";	
			}else if($t->state=="4"){
			$state="구매완료";	
			}else if($t->state=="5"){
			$state="입고완료";	
			}else if($t->state=="6"){
			$state="구매취소";	
			}else if($t->state=="7"){
			$state="종결";	
			}else if($t->state=="0"){
			$state="구매요청";	
			}
?>
					<tr onmouseover="underline('<?=$i?>')" class="line_<?=$i?>"><td class='center'><input type="checkbox" name="checkbox[]" id="checkbox" value="<?=$t->uid?>" /></td>
						<td class='center'><span style="cursor:pointer" onclick="postPurchaseOrder('<?=$t->uid?>','<?=$t->p_order_cd?>','<?=$t->account_cd?>','<?=$t->account_nm?>','<?=$t->manager?>','<?=$t->project_cd?>','<?=$t->project_nm?>','<?=$t->warehouse_cd?>','<?=$t->warehouse_nm?>','<?=$t->deadline_dt?>','<?=$t->tax_type?>')"><?=$t->p_order_cd?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postPurchaseOrder('<?=$t->uid?>','<?=$t->p_order_cd?>','<?=$t->account_cd?>','<?=$t->account_nm?>','<?=$t->manager?>','<?=$t->project_cd?>','<?=$t->project_nm?>','<?=$t->warehouse_cd?>','<?=$t->warehouse_nm?>','<?=$t->deadline_dt?>','<?=$t->tax_type?>')"><?=$t->account_nm?></span></td>
						<td class='left'><span style="cursor:pointer" onclick="postPurchaseOrder('<?=$t->uid?>','<?=$t->p_order_cd?>','<?=$t->account_cd?>','<?=$t->account_nm?>','<?=$t->manager?>','<?=$t->project_cd?>','<?=$t->project_nm?>','<?=$t->warehouse_cd?>','<?=$t->warehouse_nm?>','<?=$t->deadline_dt?>','<?=$t->tax_type?>')"><?=$item_nm.$cnt_text?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postPurchaseOrder('<?=$t->uid?>','<?=$t->p_order_cd?>','<?=$t->account_cd?>','<?=$t->account_nm?>','<?=$t->manager?>','<?=$t->project_cd?>','<?=$t->project_nm?>','<?=$t->warehouse_cd?>','<?=$t->warehouse_nm?>','<?=$t->deadline_dt?>','<?=$t->tax_type?>')"><?=$t->deadline_dt?></span></td>
						<td class='text-right'><?=number_format($sum)?></td>
						<td class='center'><?=$state?></td>
					</tr>			
<?
 $i++;
}				
?>
<?
if(!$result) { // 자료 있을때{?>
	       </tr><td colspan="7" class="center"> 등록된 데이터가 없습니다.</td></tr>
<?}?>
				</table>
				<div class="center" id="paging_area"></div>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix form-actions center">
		<div class="col-md-12">
			<!-- <button class="btn btn-xs btn-info" type="button" onClick="goSubmit();">
				<i class="ace-icon fa fa-check bigger-110"></i>
				전체적용
			</button> -->
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