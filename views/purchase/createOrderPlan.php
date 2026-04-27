

<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">생산관리</a>
				</li>
				<li class="active">생산계획</li>
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
					생산계획 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						생산계획을 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="production" />
						<input type="hidden" name="action" id="action" value="registWorkPlan" />
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">생산유형</th>
								<td class="col-xs-11" colspan="3">
									<select name="work_gb" id="work_gb">
										<option value="정기생산">정기생산</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">생산기간</th>
								<td class="col-xs-11" colspan="3">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="start_dt" id="start_dt" type="text" data-date-format="yyyy-mm-dd" placeholder="시작일" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span> -
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="end_dt" id="end_dt" type="text" data-date-format="yyyy-mm-dd" placeholder="종료일" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">적요</th>
								<td class="col-xs-11" colspan="3">
									<input type="text" class="form-control" name="title" id="title" />
								</td>
							</tr>
						</table>
						
						<a class="btn btn-xs btn-inverse" id="id-btn-dialog1">구매요청서 가져오기</a>
						<a class="btn btn-xs btn-info" id="id-btn-dialog2">생산계획서에서 품목가져오기</a>
						<table id="product" class="table  table-bordered table-hover" style="margin-top:10px">
							<thead>
								<tr>
									<th class="detail-col center" style="background-color:#f1f1f1"></th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">품목코드</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">품목명</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">규격</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">생산수량</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">착수예정</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">종료예정</th>
									<th class="center col-xs-3" style="background-color:#f1f1f1">수주(주문)서 코드</th>
								</tr>
							</thead>
							<tbody>
								<tr class="item1">
									<td class="center"><i class='delBtn fa fa-check fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" name="item_cd[]" id="item_cd_1" onclick="itemFlag(1)"  placeholder="품목선택을 하시려면 클릭하세요" readonly /></td>
									<td><input type="text" class="form-control" name="item_nm[]" id="item_nm_1" readonly /></td>
									<td><input type="text" class="form-control" name="standard[]" id="standard_1" readonly /></td>
									<td><input type="text" class="form-control cnt" name="cnt[]" id="cnt_1" onkeyup="calculation(1)" /></td>
									<td>
										<input class=" date-picker" name="work_start_dt[]" id="work_start_dt_1" type="text" data-date-format="yyyy-mm-dd" />
									</td>
									<td>
										<input class=" date-picker" name="work_end_dt[]" id="work_end_dt_1" type="text" data-date-format="yyyy-mm-dd" />
									</td>
									<td><input type="text" class="form-control tax" name="order_cd[]" id="order_cd_1" /></td>
								</tr>
								<tr class="item2">
									<td class="center"><i class='delBtn fa fa-check fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" name="item_cd[]" id="item_cd_2" onclick="itemFlag(2)" placeholder="품목선택을 하시려면 클릭하세요" readonly /></td>
									<td><input type="text" class="form-control" name="item_nm[]" id="item_nm_2" readonly /></td>
									<td><input type="text" class="form-control" name="standard[]" id="standard_2" readonly /></td>
									<td><input type="text" class="form-control cnt" name="cnt[]" id="cnt_2" onkeyup="calculation(2)" /></td>
									<td>
										<input class=" date-picker" name="work_start_dt[]" id="work_start_dt_2" type="text" data-date-format="yyyy-mm-dd" />
									</td>
									<td>
										<input class=" date-picker" name="work_end_dt[]" id="work_end_dt_2" type="text" data-date-format="yyyy-mm-dd" />
									</td>
									<td><input type="text" class="form-control tax" name="order_cd[]" id="order_cd_2" /></td>
								</tr>
								<tr class="item3">
									<td class="center"><i class='delBtn fa fa-check fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" name="item_cd[]" id="item_cd_3" onclick="itemFlag(3)" placeholder="품목선택을 하시려면 클릭하세요" readonly /></td>
									<td><input type="text" class="form-control" name="item_nm[]" id="item_nm_3" readonly /></td>
									<td><input type="text" class="form-control" name="stanard[]" id="standard_3" readonly /></td>
									<td><input type="text" class="form-control cnt" name="cnt[]" id="cnt_3" onkeyup="calculation(3)" /></td>
									<td>
										<input class=" date-picker" name="work_start_dt[]" id="work_start_dt_3" type="text" data-date-format="yyyy-mm-dd" />
									</td>
									<td>
										<input class=" date-picker" name="work_end_dt[]" id="work_end_dt_3" type="text" data-date-format="yyyy-mm-dd" />
									</td>
									<td><input type="text" class="form-control tax" name="order_cd[]" id="order_cd_3"  /></td>
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

<input type="hidden" name="flag" id="flag" value="1" />
<input type="text" name="itemFlag" id="itemFlag" value="" />

<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$("textarea").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getOrder();
	getProject();
	getWarehouse();
	getItem();
	createPurchaseCode();


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


	var page = $("#page").val();
	getItem();
	getOrder();
});

function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#flag").val(nextFlag);
}

function itemFlag(flag) {
	$("#itemFlag").val(flag);
}

// 품목리스트 가져오기
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
					}
					tag += "<tr>";
					tag += "<td>" + item_gb + "</td>";
					tag += "<td><a href='#' onclick=\"postItem('" + json[i].item_cd + "','" + json[i].item_nm + "','" + json[i].standard + "')\">" + json[i].item_cd + "</a></td>";
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

function getOrder() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;

	$.getJSON("ajax/order.php",{"page":page, "mode":"getOrder", "rpp" : rpp, "adjacents" : adjacents},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"getOrderItem(" + json[i].uid + ",'" + json[i].order_cd + "')\">" + json[i].order_cd + "</a></td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "<td>" + json[i].delivery_dt + "</td>";
					tag += "</tr>";
				}
			}

			$("#order_list tbody").html(tag);

			var table = "erp_order";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function getOrderItem(uid,order_cd){
	var currentFlag = $("#flag").val();
	var tag = "";

	$.getJSON("ajax/order.php",{"mode":"getOrderItem", "uid" : uid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					if(i < 3) {
						$("#item_cd_" + currentFlag).val(json[i].item_cd);
						$("#item_nm_" + currentFlag).val(json[i].item_nm);
						$("#standard_" + currentFlag).val(json[i].standard);
						$("#cnt_" + currentFlag).val(json[i].cnt);
						$("#order_cd_" + currentFlag).val(order_cd);
					} else {
						tag += "<tr class='item" + currentFlag + "'>";
						tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
						tag += "<td><input type='text' class='form-control id-btn-dialog item_cd ' name='item_cd[]' id='item_cd_" + currentFlag + "' onclick='viewModal(), itemFlag(" + currentFlag + ")'  placeholder='품목선택을 하시려면 클릭하세요' readonly /></td>";
						tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + currentFlag + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control' name='unit[]' id='unit_" + currentFlag + "' readonly /></td>";
						tag += "<td><input type='text' class='form-control cnt' name='cnt[]' id='cnt_" + currentFlag + "' value='" + json[i].cnt + "' /></td>";
						tag += "<td></td>";
						tag += "<td></td>";
						tag += "<td><input type='text' value='" + order_cd + "' /></td>";
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

function postItem(item_cd,item_nm,standard,pur_unit_price,unit_price,lot_no){
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
		$("#standard_" + flag).val(standard);
	}
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

function postOrder(uid,code) {
	$("#estimate_uid").val(uid);
	$("#estimate_cd").val(code);
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