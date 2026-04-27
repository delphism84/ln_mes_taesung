

<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">재고관리</a>
				</li>
				<li class="active">바코드 등록</li>
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
					품목 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						취급하시는 품목의 정보를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php"  enctype="multipart/form-data" />
						<input type="hidden" name="controller" id="controller" value="items" />
						<input type="hidden" name="action" id="action" value="updateBarcode" />
						<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />

						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">품목코드</th>
								<td class="col-xs-5"><input type="text" class="form-control" name="item_cd" id="item_cd" value="<?=$t->item_cd?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">품목명</th>
								<td class="col-xs-5"><input type="text" class="form-control"name="item_nm" id="item_nm" value="<?=$t->item_nm?>" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">단위</th>
								<td class="col-xs-5"><input type="text" name="unit" id="unit" value="<?=$t->unit?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">규격</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="standard" id="standard" value="<?=$t->standard?>" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog5">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												<span class="input-group-addon btn-danger" id="id-btn-dialog6">
													<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">최소구매(생산)단위</th>
								<td class="col-xs-5"><input type="text" name="min_pur_unit" id="min_pur_unit" value="<?=$t->min_pur_unit?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">입고창고</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="warehouse_cd" id="warehouse_cd" value="<?=$t->warehouse_cd?>" readonly />
												<input type="text" name="warehouse_nm" id="warehouse_nm" value="<?=$t->warehouse_nm?>" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog4">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">구매처</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="account_cd" id="account_cd" value="<?=$t->account_cd?>" readonly />
												<input type="text" name="account_nm" id="account_nm" value="<?=$t->account_nm?>" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog1">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">조달기간</th>
								<td class="col-xs-5"><input type="text" name="delivery_period" id="delivery_period" value="<?=$t->delivery_period?>" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">
									기초재고수량 
									<a href="#" class="tooltip-info" title="" data-original-title="현재 재고량을 입력하시면 됩니다">
										<i class="fa fa-question-circle" aria-hidden="true"></i>
									</a>
								</th>
								<td class="col-xs-5"><input type="text" class="onlynum" name="base_stock_cnt" id="base_stock_cnt" value="<?=$t->base_stock_cnt?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">안전재고수량</th>
								<td class="col-xs-5"><input type="text" class="onlynum" name="safety_stock_cnt" id="safety_stock_cnt" value="<?=$t->safety_stock_cnt?>" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">품목구분</th>
								<td class="col-xs-5">
									<select name="item_gb" id="item_gb">
										<option>선택</option>
										<option value="component" <? if($t->item_gb == "component") echo "selected"; ?>>자재</option>
										<option value="semi_product" <? if($t->item_gb == "semi_product") echo "selected"; ?>>반제품</option>
										<option value="product" <? if($t->item_gb == "product") echo "selected"; ?>>완제품</option>
									</select>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">품목그룹</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="item_group_cd" id="item_group_cd" value="<?=$t->item_group_cd?>" readonly />
												<input type="text" name="item_group_nm" id="item_group_nm" value="<?=$t->item_group_nm?>" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog2">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												<span class="input-group-addon btn-danger" id="id-btn-dialog3">
													<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">입고단가</th>
								<td class="col-xs-5"><input type="text" name="pur_unit_price" id="pur_unit_price" value="<?=$t->pur_unit_price?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">출고단가</th>
								<td class="col-xs-5"><input type="text" name="unit_price" id="unit_price" value="<?=$t->unit_price?>" /></td>
							</tr>
<?
$url = "https://www.barcodesinc.com/generator/image.php?code=".$t->in_barcode."&style=196&type=C128B&width=167&height=70&xres=1&font=3";
$in_img = "<img src='$url'>";

$url = "https://www.barcodesinc.com/generator/image.php?code=".$t->barcode."&style=196&type=C128B&width=167&height=70&xres=1&font=3";
$out_img = "<img src='$url'>";
?>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">입고바코드</th>
								<td class="col-xs-5">
									<?=$in_img?>
									<input type="text" class="form-control" name="in_barcode" id="in_barcode" value="<?=$t->in_barcode?>" />
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">출고바코드</th>
								<td class="col-xs-5">
									<?=$out_img?>
									<input type="text" class="form-control" name="barcode" id="barcode" value="<?=$t->barcode?>" />
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">이미지</th>
								<td class="col-xs-11" colspan="3"><input type="file" class="form-control" name="img" id="img" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div><!-- /.row -->

			
			
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						품목등록
					</button>

					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=items&action=listPageItem' ">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						품목리스트
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<div id="dialog-message1" class="hide">
	<table id="account_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-2 center" style="background-color:#f1f1f1">구분</th>
				<th class="col-xs-3 center" style="background-color:#f1f1f1">거래처명</th>
				<th class="col-xs-3 center" style="background-color:#f1f1f1">거래처코드</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<div id="dialog-message2" class="hide">
	<table id="item_group_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">품목그룹코드</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">품목그룹명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<div id="dialog-message3" class="hide">
	<table class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-2 center" style="background-color:#f1f1f1">품목그룹코드</th>
				<td><input type="text" name="sub_item_group_cd" id="sub_item_group_cd" readonly /></td>
			</tr>
			<tr>
				<th class="col-xs-3 center" style="background-color:#f1f1f1">품목그룹명</th>
				<td><input type="text" name="sub_item_group_nm" id="sub_item_group_nm" /></td>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<div id="dialog-message4" class="hide">
	<table id="warehouse_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">창고코드</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">창고명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<div id="dialog-message5" class="hide">
	<table id="standard_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-12 center" style="background-color:#f1f1f1">규격명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<div id="dialog-message6" class="hide">
	<table class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-2 center" style="background-color:#f1f1f1">품목코드</th>
				<td><input type="text" name="sub_item_cd" id="sub_item_cd" readonly /></td>
			</tr>
			<tr>
				<th class="col-xs-3 center" style="background-color:#f1f1f1">규격명</th>
				<td><input type="text" name="sub_standard" id="sub_standard" /></td>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->
<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getAccount(page);
	getItemGroup();
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
});

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

function registItemGroup() {
	var dataString = "mode=registItemGroup&item_group_cd=" + $("#sub_item_group_cd").val() + "&item_group_nm=" + $("#sub_item_group_nm").val();
	$.ajax({
		type : "post",
		url : "ajax/item.php",
		data : dataString,
		success : function(str) {
			if(str == "success") getItemGroup(1);
			$(document).dialog( "close" );
		}
	});
}

function getStandard() {
	var tag = "";
	var item_cd = $("#item_cd").val();

	$.getJSON("ajax/item.php",{"mode":"getStandard","item_cd":item_cd},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postStandard('" + json[i].standard + "')\">" + json[i].standard + "</a></td>";
					tag += "</tr>";
				}
			}

			$("#standard_list tbody").html(tag);
		}
	);
}

function postStandard(standard) {
	$("#standard").val(standard);
}

// 품목 규격 등록하기
function registItemStandard() {
	var data_string = "mode=registItemStandard&item_cd=" + $("#sub_item_cd").val() + "&standard=" + $("#sub_standard").val();
	$.ajax({
		type : "post",
		url : "ajax/item.php",
		data : data_string,
		success : function (str) {
			if(str == "success") alert("규격을 등록하였습니다");
		}
	});
}

function getItemGroup(page) {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = page;

	$.getJSON("ajax/item.php",{"page":page, "mode":"getItemGroup", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postItemGroupData('" + json[i].item_group_cd + "','" + json[i].item_group_nm + "')\">" + json[i].item_group_nm + "</a></td>";
					tag += "<td>" + json[i].item_group_cd + "</td>";
					tag += "</tr>";
				}
			}

			$("#item_group_list tbody").html(tag);

			var table = "erp_item_group";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function getWarehouse() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = page;

	$.getJSON("ajax/warehouse.php",{"page":page, "mode":"getWarehouse", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postWarehouseData('" + json[i].warehouse_cd + "','" + json[i].warehouse_nm + "')\">" + json[i].warehouse_cd + "</a></td>";
					tag += "<td>" + json[i].warehouse_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#warehouse_list tbody").html(tag);

			var table = "erp_warehouse";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 거래처 리스트 가져오기
function getAccount(page){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	//var search_choice = $("#search_choice option:selected").val();
	//var txt = $("#search_txt").val();
	var page = page;
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
					tag += "<td><a href='#' onclick=\"postData('" + json[i].account_cd + "','" + json[i].account_nm + "')\">" + json[i].account_nm + "</a></td>";
					tag += "<td>" + json[i].account_cd + "</td>";
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

// 거래처 구분으로 거래처 리스트 가져오기
function setAccount(val) {
	$("#page").val(1);
	$("#account_gb").val(val);
	getAccount(1);
}

function postData(code,name) {
	$("#account_cd").val(code);
	$("#account_nm").val(name);
}

function postItemGroupData(code,name) {
	$("#item_group_cd").val(code);
	$("#item_group_nm").val(name);
}

function postWarehouseData(code,name) {
	$("#warehouse_cd").val(code);
	$("#warehouse_nm").val(name);
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
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>품목그룹 리스트</h4></div>",
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

				
	$( "#id-btn-dialog3" ).on('click', function(e) {
		e.preventDefault();
		createItemGroupCode();	
		var dialog = $( "#dialog-message3" ).removeClass('hide').dialog({
			width : 500,
			height : 230,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>품목그룹 추가</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "창닫기",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "등록",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						registItemGroup();
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	$( "#id-btn-dialog4" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message4" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>창고 리스트</h4></div>",
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

	$( "#id-btn-dialog5" ).on('click', function(e) {
		e.preventDefault();
		getStandard();
		var dialog = $( "#dialog-message5" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>규격 리스트</h4></div>",
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

				
	$( "#id-btn-dialog6" ).on('click', function(e) {
		e.preventDefault();
		var item_cd = $("#item_cd").val();
		$("#sub_item_cd").val(item_cd);
		var dialog = $( "#dialog-message6" ).removeClass('hide').dialog({
			width : 500,
			height : 230,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>규격추가</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "창닫기",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "등록",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						registItemStandard();
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