

<div class="main-content">
	<div class="main-content-inner">

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					구매요청서
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="purchase" />
						<input type="hidden" name="action" id="action" value="registPurchaseDemand" />
						<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />

						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">구매요청코드</th>
								<td class="col-xs-5">
									<input type="text" name="purchase_cd" id="purchase_cd" value="<?=$t->purchase_cd?>" readonly />
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">수주(주문)서</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="order_cd" id="order_cd" value="<?=$t->order_cd?>" readonly />
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">프로젝트</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="project_cd" id="project_cd" value="<?=$t->project_cd?>" readonly />
												<input type="text" name="project_nm" id="project_nm" value="<?=$t->project_nm?>" readonly />
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">입고창고</th>
								<td class="col-xs-5">
									<select name="warehouse_cd" id="warehouse_cd">
										<option>입고창고 선택</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">희망입고일</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input name="purchase_dt" id="purchase_dt" type="text" data-date-format="yyyy-mm-dd" value="<?=substr($t->purchase_dt,0,10)?>" />
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
									<textarea id="memo" name="memo" class="form-control"><?=$t->memo?></textarea>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">첨부</th>
								<td colspan="3" class="col-xs-11">
									<div>
										<?
											if($t->attach != "") echo "<a href='attach/$t->attach'>$t->attach</a>";
										?>
									</div>
								</td>
							</tr>
						</table>
						
						<table id="product" class="table  table-bordered table-hover" style="margin-top:10px">
							<thead>
								<tr>
									<th class="detail-col center" style="background-color:#f1f1f1"></th>
									<th class="center col-xs-3" style="background-color:#f1f1f1">품목코드</th>
									<th class="center col-xs-3" style="background-color:#f1f1f1">품목명</th>
									<th class="center col-xs-3" style="background-color:#f1f1f1">규격</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">구매수량</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">입고단가</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">합계금액</th>
								</tr>
							</thead>
							<tbody>
								<tr class="item1">
									<td class="center"><i class='delBtn fa fa-check fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" name="item_cd[]" id="item_cd_1" onclick="itemFlag(1)"  placeholder="품목선택을 하시려면 클릭하세요" readonly /></td>
									<td><input type="text" class="form-control" name="item_nm[]" id="item_nm_1" readonly /></td>
									<td><input type="text" class="form-control" name="standard[]" id="standard_1" readonly /></td>
									<td><input type="text" class="form-control cnt" name="cnt[]" id="cnt_1" onkeyup="calculation(1)" /></td>
									<td><input type="text" class="form-control" name="pur_unit_price[]" id="pur_unit_price_1" readonly /></td>
									<td><input type="text" class="form-control total_price" name="total_price[]" id="total_price_1" readonly /></td>
								</tr>
								<tr class="item2">
									<td class="center"><i class='delBtn fa fa-check fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" name="item_cd[]" id="item_cd_2" onclick="itemFlag(2)" placeholder="품목선택을 하시려면 클릭하세요" readonly /></td>
									<td><input type="text" class="form-control" name="item_nm[]" id="item_nm_2" readonly /></td>
									<td><input type="text" class="form-control" name="standard[]" id="standard_2" readonly /></td>
									<td><input type="text" class="form-control cnt" name="cnt[]" id="cnt_2" onkeyup="calculation(2)" /></td>
									<td><input type="text" class="form-control" name="pur_unit_price[]" id="pur_unit_price_2" readonly /></td>
									<td><input type="text" class="form-control total_price" name="total_price[]" id="total_price_2" readonly /></td>
								</tr>
								<tr class="item3">
									<td class="center"><i class='delBtn fa fa-check fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" name="item_cd[]" id="item_cd_3" onclick="itemFlag(3)" placeholder="품목선택을 하시려면 클릭하세요" readonly /></td>
									<td><input type="text" class="form-control" name="item_nm[]" id="item_nm_3" readonly /></td>
									<td><input type="text" class="form-control" name="standard[]" id="standard_3" readonly /></td>
									<td><input type="text" class="form-control cnt" name="cnt[]" id="cnt_3" onkeyup="calculation(3)" /></td>
									<td><input type="text" class="form-control" name="pur_unit_price[]" id="pur_unit_price_3" readonly /></td>
									<td><input type="text" class="form-control total_price" name="total_price[]" id="total_price_3" readonly /></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div><!-- /.row -->

			
			
			
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<input type="hidden" name="flag" id="flag" value="1" />
<input type="hidden" name="itemFlag" id="itemFlag" value="" />
<input type="hidden" name="sub_warehouse_cd" id="sub_warehouse_cd" value="<?=$t->warehouse_cd?>" />

<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
function addTr(){
	var currentFlag = $("#flag").val();
	var tag = "";
	
	tag += "<tr class='item" + currentFlag + "'>";
	tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
	tag += "<td><input type='text' class='form-control id-btn-dialog item_cd' name='item_cd[]' id='item_cd_" + currentFlag + "' onclick='itemFlag(" + currentFlag + ")'  placeholder='품목선택을 하시려면 클릭하세요' readonly /></td>";
	tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + currentFlag + "' readonly /></td>";
	tag += "<td><input type='text' class='form-control' name='unit[]' id='unit_" + currentFlag + "' readonly /></td>";
	tag += "<td><input type='text' class='form-control cnt' name='cnt[]' id='cnt_" + currentFlag + "' onkeyup='calculation(" + currentFlag + ")' /></td>";
	tag += "<td><input type='text' class='form-control' name='pur_unit_price[]' id='pur_unit_price_" + currentFlag + "' readonly /></td>";
	tag += "<td><input type='text' class='form-control total_price' name='total_price[]' id='total_price_" + currentFlag + "' readonly /></td>";
	tag += "</tr>";
	$("#product").append(tag);
	
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


<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getOrder();
	getProject();
	getWarehouse();
	getItem();
	getPurchaseDemandItem();


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

function getPurchaseDemandItem(){
	var uid = $("#uid").val();
	var currentFlag = $("#flag").val();
	var tag = "";

	$.getJSON("ajax/purchase.php",{"mode":"getPurchaseDemandItem", "uid" : uid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					if(i < 3) {
						$("#item_cd_" + currentFlag).val(json[i].item_cd);
						$("#item_nm_" + currentFlag).val(json[i].item_nm);
						$("#standard_" + currentFlag).val(json[i].standard);
						$("#cnt_" + currentFlag).val(json[i].cnt);
						$("#pur_unit_price_" + currentFlag).val(json[i].pur_unit_price);
						$("#total_price_" + currentFlag).val(json[i].total_price);
					} else {
						tag += "<tr class='item" + currentFlag + "'>";
						tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
						tag += "<td><input type='text' class='form-control id-btn-dialog item_cd ' name='item_cd[]' id='item_cd_" + currentFlag + "' onclick='viewModal(), itemFlag(" + currentFlag + ")'  placeholder='품목선택을 하시려면 클릭하세요' readonly /></td>";
						tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + currentFlag + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control' name='unit[]' id='unit_" + currentFlag + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control cnt' name='cnt[]' id='cnt_" + currentFlag + "' onkeyup='calculation(" + currentFlag + ")' /></td>";
						tag += "<td><input type='text' class='form-control' name='pur_unit_price[]' id='pur_unit_price_" + currentFlag + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control total_price' name='total_price[]' id='total_price_" + currentFlag + "' readonly /></td>";
						tag += "</tr>";
						$("#product").append(tag);
					}
					
					currentFlag = Number(currentFlag) + 1;
					
				}
				var nextFlag = Number(currentFlag) + 1;
				$("#flag").val(nextFlag);
			} else {
				$("#flag").val("4");
			}
		}
	);
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
	var pur_unit_price = $("#pur_unit_price_" + flag).val();
	var unit_price = $("#unit_price_" + flag).val();
	var values = Number(removeComma(cnt)) * Number(removeComma(unit_price));

	// 부가세적용
	if(tax_type == 1) {
		var supply_price = values/1.1;
		var tax = values-supply_price;

		$("#total_price_" + flag).val(commaSplit(Math.round(values + tax)));
	} else {
		var tax = 0;
		$("#total_price_" + flag).val(commaSplit(Math.round(values + tax)));
	}
	$("#tax_" + flag).val(commaSplit(Math.round(tax)));
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
					tag += "<td><a href='#' onclick=\"postItem('" + json[i].item_cd + "','" + json[i].item_nm + "','" + json[i].unit + "','" + json[i].pur_unit_price + "','" + json[i].unit_price + "','" + json[i].lot_no + "')\">" + json[i].item_cd + "</a></td>";
					tag += "<td>" + json[i].item_nm + "</td>";
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

// 주문서번호 붙이기
function postOrder(order_cd) {
	$("#order_cd").val(order_cd);
	getOrderOne(order_cd);
	
}


function postItem(item_cd,item_nm,unit,pur_unit_price,unit_price,lot_no){
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
		$("#pur_unit_price_" + flag).val(pur_unit_price);
		$("#unit_price_" + flag).val(unit_price);
		$("#lot_no_" + flag).val(lot_no);
	}
}

// 거래처 리스트 가져오기
function getOrder(){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;

	$.getJSON("ajax/order.php",{"page":page, "mode":"getOrder", "rpp" : rpp, "adjacents" : adjacents},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postOrder('" + json[i].order_cd + "')\">" + json[i].order_cd + "</a></td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "<td>" + json[i].create_dt + "</td>";
					tag += "</tr>";
				}
			}

			$("#order_list tbody").html(tag);

			var table = "erp_order";
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
	var warehouse_cd = $("#sub_warehouse_cd").val();

	$.getJSON("ajax/warehouse.php",{"page":page, "mode":"getWarehouse", "rpp" : rpp, "adjacents" : adjacents, "where":search, "warehouse_gb":warehouse_gb},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					if(warehouse_cd == json[i].warehouse_cd) var selected = "selected";
					else var selected = "";
					tag += "<option value='" + json[i].warehouse_cd + "' " + selected + ">" + json[i].warehouse_nm + "</option>";
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
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>주문서 리스트</h4></div>",
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
			width : 500,
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