<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">영업관리</a>
				</li>
				<li class="active">견적서 등록</li>
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
					견적서 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						고객의 기본정보를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="sales" />
						<input type="hidden" name="action" id="action" value="registEstimate" />
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">견적서코드</th>
								<td class="col-xs-5">
									<input type="text" name="estimate_cd" id="estimate_cd" readonly />
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">최종견적서</th>
								<td class="col-xs-5">
									<label>
										<input type="radio" class="ace" name="final" id="final" value="y" checked />
										<span class="lbl"> 예</span>
									</label>

									<label>
										<input type="radio" class="ace" name="final" id="final" value="n" />
										<span class="lbl"> 아니오</span>
									</label>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">견적일자</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="estimate_dt" id="estimate_dt" type="text" data-date-format="yyyy-mm-dd" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">거래처</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="account_cd" id="account_cd" />
												<input type="text" name="account_nm" id="account_nm" />
												<span class="input-group-addon btn-purple" id="id-btn-dialog1">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">담당자</th>
								<td class="col-xs-5"><input type="text" name="manager" id="manager" /> * 거래처 담당자</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">출하창고</th>
								<td class="col-xs-5">
									<select name="warehouse_cd" id="warehouse_cd">
										<option>출하창고 선택</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">거래유형</th>
								<td class="col-xs-5">
									<select name="tax_type" id="tax_type" onchange="tax_calculation(this.value)">
										<option value="1">부가세율 적용</option>
										<option value="2">부가세율 미적용</option>
									</select>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">통화</th>
								<td class="col-xs-5">
									<select name="currency" id="currency">
										<option value="1">내자</option>
										<option value="2">달러</option>
										<option value="3">바트</option>
										<option value="4">엔화</option>
										<option value="5">위안</option>
										<option value="6">유로</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">프로젝트</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="project_cd" id="project_cd" readonly />
												<input type="text" name="project_nm" id="project_nm" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog2">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">참조</th>
								<td class="col-xs-5"><input type="text" name="refer" id="refer" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">결제조건</th>
								<td class="col-xs-5"><input type="text" name="payment_condition" id="payment_condition" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">유효기간</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="validity_dt" id="validity_dt" type="text" data-date-format="yyyy-mm-dd" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">첨부</th>
								<td colspan="3" class="col-xs-11"><input type="file" name="attach" id="attach" /></td>
							</tr>
						</table>
						
						<a class="btn btn-xs btn-inverse" onclick="addTr()">품목추가</a>
						<table id="product" class="table  table-bordered table-hover" style="margin-top:10px">
							<thead>
								<tr>
									<th class="detail-col center" style="background-color:#f1f1f1"></th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">품목코드</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">품목명</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">규격</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">수량</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">단가</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">공급가액</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">부가세</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">합계금액</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">로트번호</th>
								</tr>
							</thead>
							<tbody>
								<tr class="item1">
									<td class="center"><i class='delBtn fa fa-check fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" name="item_cd[]" id="item_cd_1" onclick="itemFlag(1)"  placeholder="품목선택을 하시려면 클릭하세요" readonly /></td>
									<td><input type="text" class="form-control" name="item_nm[]" id="item_nm_1" readonly /></td>
									<td><input type="text" class="form-control" name="unit[]" id="unit_1" readonly /></td>
									<td><input type="text" class="form-control cnt" name="cnt[]" id="cnt_1" onkeyup="calculation(1)" /></td>
									<td><input type="text" class="form-control" name="pur_unit_price[]" id="pur_unit_price_1" readonly /></td>
									<td><input type="text" class="form-control unit_price" name="unit_price[]" id="unit_price_1" onkeyup="calculation(1)" /></td>
									<td><input type="text" class="form-control tax" name="tax[]" id="tax_1" readonly /></td>
									<td><input type="text" class="form-control total_price" name="total_price[]" id="total_price_1" readonly /></td>
									<td><input type="text" class="form-control" name="lot_no[]" id="lot_no_1" readonly /></td>
								</tr>
								<tr class="item2">
									<td class="center"><i class='delBtn fa fa-check fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" name="item_cd[]" id="item_cd_2" onclick="itemFlag(2)" placeholder="품목선택을 하시려면 클릭하세요" readonly /></td>
									<td><input type="text" class="form-control" name="item_nm[]" id="item_nm_2" readonly /></td>
									<td><input type="text" class="form-control" name="unit[]" id="unit_2" readonly /></td>
									<td><input type="text" class="form-control cnt" name="cnt[]" id="cnt_2" onkeyup="calculation(2)" /></td>
									<td><input type="text" class="form-control" name="pur_unit_price[]" id="pur_unit_price_2" readonly /></td>
									<td><input type="text" class="form-control unit_price" name="unit_price[]" id="unit_price_2" onkeyup="calculation(2)" /></td>
									<td><input type="text" class="form-control tax" name="tax[]" id="tax_2" readonly /></td>
									<td><input type="text" class="form-control total_price" name="total_price[]" id="total_price_2" readonly /></td>
									<td><input type="text" class="form-control" name="lot_no[]" id="lot_no_2" readonly /></td>
								</tr>
								<tr class="item3">
									<td class="center"><i class='delBtn fa fa-check fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" name="item_cd[]" id="item_cd_3" onclick="itemFlag(3)" placeholder="품목선택을 하시려면 클릭하세요" readonly /></td>
									<td><input type="text" class="form-control" name="item_nm[]" id="item_nm_3" readonly /></td>
									<td><input type="text" class="form-control" name="unit[]" id="unit_3" readonly /></td>
									<td><input type="text" class="form-control cnt" name="cnt[]" id="cnt_3" onkeyup="calculation(3)" /></td>
									<td><input type="text" class="form-control" name="pur_unit_price[]" id="pur_unit_price_3" readonly /></td>
									<td><input type="text" class="form-control unit_price" name="unit_price[]" id="unit_price_3" onkeyup="calculation(3)" /></td>
									<td><input type="text" class="form-control tax" name="tax[]" id="tax_3" readonly /></td>
									<td><input type="text" class="form-control total_price" name="total_price[]" id="total_price_3" readonly /></td>
									<td><input type="text" class="form-control" name="lot_no[]" id="lot_no_3" readonly /></td>
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
						등록
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

<input type="hidden" name="flag" id="flag" value="4" />
<input type="hidden" name="itemFlag" id="itemFlag" value="" />

<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function(){
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$("textarea").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getProject();
	getAccount();
	getWarehouse();
	getItem();
	createEstimateCode();


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

function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#flag").val(nextFlag);
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
				//$("#total_num").html(json[0].total_num);
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

function postItem(item_cd,item_nm,unit,pur_unit_price,unit_price,lot_no){
	var arr = [];
	$.each($(".item_cd") , function () {
		arr.push($(this).val());
		/*
		if($(this).val() == item_cd) {
			alert("이미 선택한 품목입니다");
		} else {
			var flag = $("#itemFlag").val();
			$("#item_cd_" + flag).val(item_cd);
			$("#item_nm_" + flag).val(item_nm);
			$("#unit_" + flag).val(unit);
			$("#pur_unit_price_" + flag).val(pur_unit_price);
			$("#unit_price_" + flag).val(unit_price);
		}*/
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
					tag += "<td><a href='#' onclick=\"postAccount('" + json[i].account_cd + "','" + json[i].account_nm + "','" + json[i].manager + "')\">" + json[i].account_cd + "</a></td>";
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