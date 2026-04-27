<?
$title = "작업지시서";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);

if ( ! isset ( $where ) ){ 
	$where = " where work_cd like '%".trim($search_txt)."%' or account_nm like '%".trim($search_txt)."%'";
}else{
	if ( ! isset ( $item_gb ) ){ 
		$where .= " or item_gb like '%".trim($item_gb)."%'";
	}else{
		$where .= "";
	}
}

$table = "erp_work";
$block = 10;

$sql = "select * from ".$table.$where;
//echo $sql; 
$total_num = num_rows($sql);

$page = (is_numeric($page)) ? $page : 1; 

$sql = "select * from ".$table.$where." order by uid desc  limit ".($page-1)*$block.", ".$block;
//echo $sql; 
$result = query($sql);
?>

<script>
$(document).ready(function(){
	//$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	//$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var table = "erp_item";
	var where = $("#where").val();
	var rpp = 10;
	var adjacents = 4;

	getPaging(table,where,rpp,adjacents);
});

function postItem(item_cd, item_nm, standard, unit, remain_cnt, shortage_cnt, order_cnt) {

	var flag = $(opener.document).find("#flag").val();
	var tag = "";
	var warehouse = "<?=$warehouse?>";
	var process = "<?=$process?>";

	var arr = [];
	var std = [];
	var item = [];

	$.each($(opener.document).find(".item_cd") , function () {
		arr.push($(this).val());
	});
	$.each($(opener.document).find(".standard") , function () {
		std.push($(this).val());
	});
	
	for(var i = 0 ; i <= arr.length ; i++) {
		item.push(arr[i] + std[i]);
	}

	var check = item_cd + standard;

	var idx = jQuery.inArray(check, item);
	if(idx >= 0) {
		alert("동일 품목을 이미 선택하셨습니다");
	} else {
		tag += "<tr class='item" + flag + "'>";
		tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
		tag += "<td><input type='text' class='form-control item_cd' name='item_cd[]' id='item_cd_" + flag + "'  placeholder='품목선택을 하시려면 클릭하세요' value='" + item_cd + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "' value='" + item_nm + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control standard' name='standard[]' id='standard_" + flag + "' value='" + standard + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control onlynum' name='unit[]' id='unit_" + unit + "' value='" + unit + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control onlynum' name='order_cnt[]' id='order_cnt" + flag + "' value='" + order_cnt + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control onlynum' name='remain_cnt[]' id='remain_cnt_" + flag + "' value='" + remain_cnt + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control onlynum' name='shortage_cnt[]' id='shortage_cnt" + flag + "' value='" + shortage_cnt + "' readonly /></td>";
		tag += "<td><input type='text' class='form-control onlynum' name='seq[]' id='seq_" + flag + "' value='" + flag + "' /></td>";
		tag += "</tr>";
		$(opener.document).find("#product tbody").append(tag);

		$(opener.document).find("#flag").val(Number(flag) + 1);
	}
}	
// 페이지 세트
function setPage(page){
	$("#page").val(page);
	var search_txt = $("#search_txt").val()
	location.href = "?page=" + page + "&search_txt=" + search_txt + "&item_gb=" + $("#item_gb option:selected").val();
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
			$(opener.document).find("#workorder_item tbody").empty(); //최초 tbody 초기화
		}
	<?}?>

	if ($("#checkbox:checked").length=="0")
	{
		alert('1개 이상 선택해야 합니다.');
		return false;
	}
	var uid="";
	$('#checkbox:checked').each(function() { 

        uid += $(this).val()+",";
    });

	if ($('input:checkbox[id="checkbox"]').is(":checked") == true)
	{
		uid_val = $('input:checkbox[id="checkbox"]').val();
	}

	var work_cd="";
	var manager="";
	var project_cd="";
	var project_nm="";
	var warehouse_cd="";
	var warehouse_nm="";
	var remark="";
	var tag = "";

	$.getJSON("../../ajax/production.php",{"mode":"getWorkOrderPop", "uid" : uid},
		function(json){
			if(json != null) {
					$(opener.document).find("#work_uid").val(json[0].uid);
					$(opener.document).find("#work_cd").val(json[0].work_cd);
					$(opener.document).find("#project_cd").val(json[0].project_cd);
					$(opener.document).find("#project_nm").val(json[0].project_nm);
					$(opener.document).find("#manager").val(json[0].manager);
					$(opener.document).find("#wh_cd_t").val(json[0].warehouse_cd);
					$(opener.document).find("#wh_nm_t").val(json[0].warehouse_nm);
					$(opener.document).find("#wh_cd_t").val(json[0].emp_id);
					$(opener.document).find("#wh_nm_t").val(json[0].emp_nm);
					$(opener.document).find("#remark").val(json[0].remark);

				for(var i = 0 ; i < json.length ; i++){
					
					tag = "<tr class='item" + flag + "'>";
					tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this);calculationTotal(" + flag + ");'></i></td>";
					tag += "<td><input type='text' class='form-control id-btn-dialog item_cd ' name='item_cd[]' id='item_cd_" + flag + "' onclick='viewModal();itemFlag(" + flag + ")' value='" + json[i].item_cd + "' placeholder='품목선택을 하시려면 클릭하세요' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "' value='" + json[i].item_nm + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='standard1[]' id='standard1_" + flag + "' value='" + json[i].standard1 + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='material[]' id='material_" + flag + "' value='" + json[i].material + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + json[i].unit + "'  /></td>";
					tag += "<td><input type='text' class='form-control cnt text-right' name='cnt[]' id='cnt_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].cnt + "' /></td>";
					tag += "<td><input type='text' class='form-control outsourcing_unit_price text-right' name='outsourcing_unit_price[]' id='outsourcing_unit_price_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].outsourcing_unit_price + "' /></td>";
					tag += "<td><input type='text' class='form-control outsourcing_total_price text-right' name='outsourcing_total_price[]' id='outsourcing_total_price_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].outsourcing_total_price + "' /></td>";
					tag += "<td><input type='text' class='form-control outsourcing_tax text-right' name='outsourcing_tax[]' id='outsourcing_tax_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].outsourcing_tax + "' /></td>";

					tag += "<td><input type='text' class='form-control memo text-right' name='memo[]' id='memo_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].memo + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control product_time text-right' name='product_time[]' id='product_time_" + flag + "' onkeyup='calculation(" + flag + ");input_comma(this);' onclick='this.select();' onblur='calculationTotal(" + flag + ");' value='" + json[i].product_time + "' readonly /></td>";
					tag += "<td class='align-middle'><a href='#' id='btn_" + flag + "' type='button' onclick=\"serialnocdFlag(" + flag + ");serial_no_reg('" + flag + "', '" + json[i].uid + "', '" + json[i].fid + "', '" + json[i].item_cd + "','" + json[i].item_nm + "','" + json[i].standard1 + "')\">선택</a></td>";
					tag += "</tr>";
		
					$(opener.document).find("#workorder_item tbody").append(tag);
					$(opener.document).find("#flag").val(Number(flag) + 1);
				}
			}

			$(opener.location).attr("href", "javascript:calculationTotal();"); 
			self.close();
		}
		
	);
}


//-->
</script>
<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<!-- 테이블 -->
			<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" />
				<input type="hidden" name="controller" id="controller" value="groupware" />
				<input type="hidden" name="action" id="action" value="registEleSettlement" />
				<input type="hidden" name="where" id="where" value="<?=$where?>" />
				<input type="hidden" name="page" id="page" value="<?=$page?>" />
				<div class="row" style="padding-bottom:3px">
					<div class="col-xs-5" style="float:right">
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
				</div>
			<table id="simple-table" class="table  table-bordered table-hover">
				<tr><th class="center" style="background-color:#f1f1f1"><input type="checkbox" name="chkAll" onClick="javascript:checkAll();" /></th>
					<th class="center" style="background-color:#f1f1f1">작업지시서일자</th>
					<th class="center" style="background-color:#f1f1f1">납품처명</th>
					<th class="center" style="background-color:#f1f1f1">담당자</th>
					<th class="center" style="background-color:#f1f1f1">납기일자</th>
					<th class="center" style="background-color:#f1f1f1">품목코드</th>
					<th class="center" style="background-color:#f1f1f1">품목</th>
					<th class="center" style="background-color:#f1f1f1">수 량	</th>
				</tr>
					<?
					while($t = mysql_fetch_object($result)) {
						//echo $t->work_cd;
						$sql = "select * from erp_work_item where work_cd='".$t->work_cd."' order by seq asc";
						$w = mysql_fetch_object(mysql_query($sql));
						//echo  $w->process;
						
					?>
				<tr><td class='center'><input type="checkbox" name="checkbox[]" id="checkbox" value="<?=$t->uid?>" /></td>
					<td class="center"><?=$t->work_cd?></th>
					<td class="center"><?=$t->account_nm?></th>
					<td class="center"><?=$t->manager?></th>
					<td class="center"><?=$t->deadline_dt?></th>
					<td class="center"><?=$w->item_cd?></th>
					<td class="center"><?=$w->item_nm?></th>
					<td class="center"><?=$t->cntTotal?></th>
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