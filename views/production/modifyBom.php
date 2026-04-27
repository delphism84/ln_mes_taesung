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
				<li class="active">BOM 등록</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					BOM 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						BOM 정보를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->

					<form id="frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="production" />
						<input type="hidden" name="action" id="action" value="registBom" />
						<input type="text" name="uid" id="uid" value="<?=$_GET['uid']?>" />
						<div>
							<!-- 테이블 -->
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">상위품목</th>
									<td class="col-xs-5"><span id="item_nm"><?=$t->item_nm?></span></td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 생산수량</th>
									<td class="col-xs-5"><input type="text" class="form-control" name="process_cd" id="process_cd" value="1" /></td>
								</tr>
							</table>
						</div>

						<div>
							<a class="btn btn-xs btn-inverse" onclick="addTr()">품목추가</a>
							<table id="product" class="table  table-bordered table-hover" style="margin-top:10px">
								<tr>
									<th class="detail-col center" style="background-color:#f1f1f1"></th>
									<th class="col-xs-2" style="background-color:#f1f1f1">품목코드</th>
									<th class="col-xs-2" style="background-color:#f1f1f1">품목명</th>
									<th class="col-xs-2" style="background-color:#f1f1f1">규격</th>
									<th class="col-xs-2" style="background-color:#f1f1f1">단위</th>
									<th class="col-xs-4" style="background-color:#f1f1f1">소요수량</th>
								</tr>
								<tr class="item1">
									<td class="center"><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true'></i></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" id="item_cd_1" name="item_cd[]" onclick="itemFlag(1)" /></td>
									<td><input type="text" class="form-control" id="item_nm_1" name="item_nm[]" /></td>
									<td><input type="text" class="form-control" id="standard_1" name="standard[]" /></td>
									<td><input type="text" class="form-control" id="unit_1" name="unit[]" /></td>
									<td><input type="text" class="form-control" id="cnt_1" name="cnt[]" /></td>
								</tr>
								<tr class="item2">
									<td class="center"><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true'></i></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" id="item_cd_2" name="item_cd[]" onclick="itemFlag(2)" /></td>
									<td><input type="text" class="form-control" id="item_nm_2" name="item_nm[]" /></td>
									<td><input type="text" class="form-control" id="standard_2" name="standard[]" /></td>
									<td><input type="text" class="form-control" id="unit_2" name="unit[]" /></td>
									<td><input type="text" class="form-control" id="cnt_2" name="cnt[]" /></td>
								</tr>
								<tr class="item3">
									<td class="center"><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true'></i></td>
									<td><input type="text" class="form-control id-btn-dialog item_cd" id="item_cd_3" name="item_cd[]" onclick="itemFlag(3)" /></td>
									<td><input type="text" class="form-control" id="item_nm_3" name="item_nm[]" /></td>
									<td><input type="text" class="form-control" id="standard_3" name="standard[]" /></td>
									<td><input type="text" class="form-control" id="unit_3" name="unit[]" /></td>
									<td><input type="text" class="form-control" id="cnt_3" name="cnt[]" /></td>
								</tr>
							</table>
						</div>
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
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=sales&action=listAccount' ">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록 돌아가기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->


<input type="hidden" name="flag" id="flag" value="4" />
<input type="text" name="itemFlag" id="itemFlag" value="" />

<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->

<div id="dialog-message" class="dialog-view hide">
	<table id="item_list" class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-2 center" style="background-color:#f1f1f1">품목구분</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">품목코드</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">품목명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<?
require_once ("assets/include_script.php");
?>

<!-- Table Tr Add ------------------------------------------------------------------------------------------------------->
<script>
$(document).ready(function(){
	getItem();
	getItemName();
});

function getItemName() {
	var dataString = "mode=getItemName&uid=" + $("#uid").val();
	$.ajax({
		type : "post",
		url : "ajax/production.php",
		data : dataString,
		success : function(str) {
			$("#item_nm").html(str);
		}
	});
}

function addTr(){
	var currentFlag = $("#flag").val();
	var tag = "";
	
	tag += "<tr class='item" + currentFlag + "'>";
	tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
	tag += "<td><input type='text' class='form-control id-btn-dialog item_cd' name='item_cd[]' id='item_cd_" + currentFlag + "' onclick='itemFlag(" + currentFlag + ")'  placeholder='품목선택을 하시려면 클릭하세요' readonly /></td>";
	tag += "<td><input type='text' class='form-control' id='item_nm_" + currentFlag + "' name='item_nm[]' /></td>";
	tag += "<td><input type='text' class='form-control' id='standard_" + currentFlag + "' name='standard[]' /></td>";
	tag += "<td><input type='text' class='form-control' id='unit_" + currentFlag + "' name='unit[]' /></td>";
	tag += "<td><input type='text' class='form-control' id='cnt_" + currentFlag + "' name='cnt[]' /></td>";
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

function itemFlag(flag) {
	$("#itemFlag").val(flag);
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
					tag += "<td><a href='#' onclick=\"postItem('" + json[i].item_cd + "','" + json[i].item_nm + "','" + json[i].standard + "','" + json[i].unit + "')\">" + json[i].item_cd + "</a></td>";
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

function postItem(item_cd,item_nm,standard,unit){
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

function formSubmit() {
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
	
	
	// 품목 팝업
	$( document).on('click',".id-btn-dialog" , function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
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