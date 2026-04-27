<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);

?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div class="widget-header">
						<h4> 품목 : <?=$item_nm?>[<?=$item_cd?>]</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
												<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="base" />
						<input type="hidden" name="action" id="action" value="inputItemSafetyStock" />
						<input type="hidden" name="dialogID" id="dialogID" value="<?=$_GET['dialogID']?>" />
						<input type="hidden" name="item_nm" id="item_nm" value="<?=$_GET['item_nm']?>" />
						<input type="hidden" name="item_cd" id="item_cd" value="<?=$_GET['item_cd']?>" />
							<div class="row" style='float:right;padding:5px 5px 5px 5px'>
								<div class="col-xs-12">
									<div class="input-group">
									<input type="text" name="stock_cnt" id="stock_cnt" class='form-control input-small allownumericwithoutdecimal' style='height:30px;width:100px;margin-right:5px'>
									<button class="btn btn-white btn-danger btn-sm" style='height:30px;' type="button" onclick="stockCntPut()">
									<i class="ace-icon fa fa-check"></i>
									적용
									</button>
									</div>
								</div>
							</div>
							
							<table id="safety_stock_list" class="table table-bordered table-striped" style='border-top: 1px solid #dddddd'>
								<thead class="thin-border-bottom">
									<tr>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 창고코드</th>
										<th class="col-xs-4"><i class="ace-icon fa fa-caret-right blue"></i> 창고명</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 안전재고수량</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
							</form>
						</div>
					</div>
					<div class="clearfix col-xs-12" style="text-align:left"><span id="paging_area"></span></div>
					<div class="clearfix form-actions" style="margin-top:0px">
						<div class="col-xs-12">
							<div class="col-xs-12" style="text-align:center">
								<button class="btn btn-info" type="button" onclick="formSubmit()">
									<i class="ace-icon fa fa-check"></i>
									저장
								</button>
								<button class="btn" type="reset" onclick="window.parent.closeModal('<?=$dialogID?>');">
									<i class="ace-icon fa fa-undo bigger-110"></i>
									닫기
								</button>
							</div>
						</div>
					</div>
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="where" id="where" value="" />
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />
<input type="hidden" name="flag" id="flag" value="1" />

<?
require_once ("assets/include_script.php");
?>


<!----------------------------------------------------------------------------------------------------------------------->
<script>
$(document).ready(function(){
	var page = $("#page").val();
	getSafetyStock(page);

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

$(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
     $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

 $(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
});

function stockCntPut()
{
	var stock_cnt=$("#stock_cnt").val()
	if (stock_cnt=="")
	{
		alert('수량을 입력력하세요')
		$("#stock_cnt").focus();
		return false;
	}
	
	$('input[name="safety_stock_cnt[]"]').val(stock_cnt);

}

$("#stock_cnt").click(function() {
	var stock_cnt=$("#stock_cnt").val()
	$('input[name="safety_stock_cnt[]"]').val(stock_cnt);
});

function formSubmit(){
	
	alert($('input[name="warehouse_cd[]"]'))
	if(!frm_submit($('input[name="warehouse_cd[]"]'),"창고코드")) return false;
	if(!frm_submit($('input[name="warehouse_nm[]"]'),"창고명")) return false;
	if(!frm_submit($('input[name="safety_stock_cnt[]"]'),"안전재고수량")) return false;

	$("#frm").submit();
}

function frm_submit(f,t) {
	  var ret = true;
	  $(f).each(function(idx, item) {
		if(!$(item).val() || $(item).val()=="0") {
		  ret = false;
		  alert(t+"을 입력 하세요");
		  $(item).focus();
		  return false;
		}
	  });
	  return ret;
	}

// 검색
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	if (txt=="")
	{	alert('검색어를 입력하세요.')
		return
	}
	if(search_choice == "lot_no_cd") {
		$("#where").val(" where lot_no_cd like '%" + txt + "%' ");
	} else if(search_choice == "item_cd") {
		$("#where").val(" where item_cd like '%" + txt + "%' ");
	}
	getSafetyStock(1);
}


// 품목구분 품목 리스트 가져오기
function setItem(val) {
	$("#page").val(1);
	if(val == "all") {
		$("#where").val("");
	} else {
		$("#where").val(" where item_gb='" + val + "'");
	}
	getItem(1);
}

function getSafetyStock(page) {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = page;
	var Flag = $("#flag").val();
	var item_cd = $("#item_cd").val();

	$.getJSON("ajax/stock.php",{"page":page, "mode":"getSafetyStock", "rpp" : rpp, "adjacents" : adjacents, "item_cd" : item_cd},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postSafetyStock('" + json[i].warehouse_cd + "','" + json[i].warehouse_nm + "')\">" + json[i].warehouse_cd + "</a></td>";
					tag += "<td>" + json[i].warehouse_nm + "</a></td>";
					tag += "<td><input type='text' class='form-control text-right' style='height:25px' name='safety_stock_cnt[]' id='safety_stock_cnt_" + Flag + "' onclick='this.select();' value='" + json[i].safety_stock_cnt + "'/>";
					tag += "<input type='hidden' name='warehouse_cd[]'  id='warehouse_cd_" + Flag + "' value='" + json[i].warehouse_cd + "'/>";
					tag += "<input type='hidden' name='warehouse_nm[]'  id='warehouse_nm_" + Flag + "' value='" + json[i].warehouse_nm + "'/>";
					tag += "<input type='hidden' name='warehouse_gb[]'  id='warehouse_gb_" + Flag + "' value='" + json[i].warehouse_gb + "'/>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='6' class='text-center'>등록된 로트No 가 없습니다.</td>";
				tag += "</tr>";
			}

			$("#safety_stock_list tbody").html(tag);

			var table = "erp_item_safety_stock";
			if(lot_no_cd == "" || lot_no_cd == "all") {
				var where = $("#where").val();
			} else {
				//var where = $("#where").val() + " and lot_no_cd='"  + search_txt + "'";
				var where = $("#where").val();
			}
			getPaging(table,escape(where),rpp,adjacents);
		}
	);
}

function postSafetyStock(lnc,lnn){
	
	var flag = window.parent.$("#SafetyStockcdFlag").val();
	var arr = [];
	var SafetyStock = [];

	$.each(window.parent.$("#lot_no_cd") , function () {
		arr.push($(this).val());
	});
	for(var i = 0 ; i <= arr.length ; i++) {
		SafetyStock.push(arr[i]);
	}
	var check = SafetyStock;
	var idx = jQuery.inArray(check, SafetyStock);
	if(idx >= 0) {
		alert("동일 로트NO를 이미 선택하셨습니다");
	} else {	
		var flag = flag;
		window.parent.$("#lot_no_cd_" + flag).val(lnc);
		window.parent.$("#lot_no_nm_" + flag).val(lnn);

		window.parent.$("#SafetyStockcdFlag").val(Number(flag) + 1);
	}
	window.parent.$("#id-btn-dialog1").modal( 'hide' );
	//window.parent.$("#id-btn-dialog1").dialog("close");
	//window.parent.closeModal('#id-btn-dialog1');
	//$(opener.document).find("#id-btn-dialog1").dialog("close");
	//window.parent.closeModal('".$dialogID."');
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getItem(page);
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

// 선택 삭제
function deleteSelect(){
	if(confirm("선택하신 Lot No 정보를 삭제하시겠습니까? 다른 데이터와 연동된 품목 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectSafetyStock&table=erp_lot_no&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/lot_no.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getItem(1);
				}
			}
		});
	}
}
</script>
<script type="text/javascript">
<!--
	function lot_no_reg(cidx, acd)
	{
	$("#id-btn-dialog1").modal({
		show: true,
		title : "로트No등록",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=base&action=registSafetyStock&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogID=id-btn-dialog1";
	$("#lot_no_reg_frame").attr("src", url);
	}
			
	function lot_no_modiy(uid)
	{
	$("#id-btn-dialog2").modal({
		show: true,
		title : "로트No수정",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	
	var url = "index.php?controller=base&action=modifySafetyStock&uid="+uid+"&pop=Y&dialogID=id-btn-dialog2";
	$("#lot_no_modify_frame").attr("src", url);
	}
	
	function lot_no_print(uid)
	{
	$("#id-btn-dialog3").modal({
		show: true,
		title : "구매입고등록",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	
	var url = "index.php?controller=production&action=productPerfReportsPrint&pop=Y&uid="+uid+"&dialogID=id-btn-dialog3";
	$("#lot_no_print_frame").attr("src", url);
	}

	function close_popup()
	{	
		$.modal.close();
		$("#lot_no_reg_frame").attr("src", "about:blank");
	}
	function closePopup()
	{
		window.parent.closeModal('<?=$dialogID?>');
		window.parent.location.reload();
	}
	window.closeModal = function(obj) {
		$("#"+obj).modal( 'hide' );
	}

//-->
</script>
<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-phone').mask('(999) 999-9999');
	$('.input-mask-mobile').mask('(999) 9999-9999');
	$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
	$(".input-mask-product").mask("a*-999-a999",{
		placeholder:" ",completed:
			function(){
				alert("You typed the following: "+this.val());
			}
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

	/////////
	$('#modal-form input[type=file]').ace_file_input({
		style:'well',
		btn_choose:'Drop files here or click to choose',
		btn_change:null,
		no_icon:'ace-icon fa fa-cloud-upload',
		droppable:true,
		thumbnail:'large'
	})

	//chosen plugin inside a modal will have a zero width because the select element is originally hidden
	//and its width cannot be determined.
	//so we set the width after modal is show
	$('#modal-form').on('shown.bs.modal', function () {
		if(!ace.vars['touch']) {
			$(this).find('.chosen-container').each(
				function(){
					$(this).find('a:first-child').css('width' , '210px');
					$(this).find('.chosen-drop').css('width' , '210px');
					$(this).find('.chosen-search input').css('width' , '200px');
				});
		}
	})

	/**
	//or you can activate the chosen plugin after modal is shown
	//this way select element becomes visible with dimensions and chosen works as expected
	$('#modal-form').on('shown', function () {
	$(this).find('.modal-chosen').chosen();
	})
	*/

	$(document).one('ajaxloadstart.page', function(e) {
		autosize.destroy('textarea[class*=autosize]')
		$('.limiterBox,.autosizejs').remove();
		$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
	});
});
</script>
<!-- // basic script ------------------------------------------------------------------------------------------------------->