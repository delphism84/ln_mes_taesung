<?
$sql = "select * from erp_warehouse";
$result = mysql_query($sql);
while($t = mysql_fetch_object($result)) {
	$warehouse .= "<option value='".$t->warehouse_cd."'>".$t->warehouse_nm."</option>";
}
?>
<div class="main-content">
	<div class="main-content-inner">
		<!-- 페이지 상단 Location -->
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#">재고관리</a>
				</li>
				<li class="active">창고재고관리</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					창고재고관리
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						창고별 재고현황을 보여드립니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

		<div class="widget-header">
			<div class="row">
				<div class="col-xs-12" style="height:750px;">
					<div class="col-xs-2" style="margin-top:5px; border:1px solid #ccc; height:100%; overflow: scroll; overflow-x: hidden; padding-top:10px">
						<div><input type="button" class="btn btn-xs btn-pink" value="창고 리스트" /></div>
						<table id="warehouse_list" class="table  table-bordered table-striped">
							<thead class="thin-border-bottom">
								<tr>
									<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue" ></i> 창고명</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<div class="col-xs-10" style="margin-top:5px; border:1px solid #ccc; height:100%;overflow: scroll;">
						<div style="height:750px; padding-top:10px">
							<div style="float:left">
								<input type="button" class="btn btn-xs btn-pink" value="품목 리스트" />
							</div>
							<table id="item_list" class="table  table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 재질</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 단위</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 총재고수량</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> LOT_NO</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 재고조정</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
							
						</div>
					</div>
				</div>
			</div>
		</div>

<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="warehouse_click" id="warehouse_click" value="" />


<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="where" id="where" value=" group by warehouse_cd,item_cd,standard1,lot_no" />
<input type="hidden" name="warehouse" id="warehouse"  />
<input type="hidden" name="check_uids" id="check_uids" />
<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:80%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">재고수불부</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="stock_inout_list_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function(){
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
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

//==================================================
// 창고 리스트 가져오기
//==================================================
function getWarehouse(){

	var tag = "";
	$.getJSON("ajax/warehouse.php",{ "mode":"getWarehouse" },
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr onclick=\"toggle(this); getStock(" + json[i].warehouse_cd + ");\" style='cursor:pointer'>";					
					tag += "<td>" + json[i].warehouse_nm + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='3' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#warehouse_list tbody").html(tag);
		}
	);

}

//==================================================
// 선택된 품목 테이블 선택된 TR 색상 바꾸기
//==================================================
function toggle(it) {
	$("#warehouse_list tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

// 창고별 품목 리스트 가져오기
function getStock( warehouse_cd ){
	$("#warehouse_click").val(warehouse_cd);

	var tag = "";
	var warehouse = "<?=$warehouse?>";
	$.getJSON("ajax/stock.php",{ "mode":"getWarehouseStock2", "warehouse_cd" : warehouse_cd },
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td>" + json[i].item_cd + "</td>";

					if(json[i].item_nm != null){
						tag += "<td>" + json[i].item_nm + "</td>";
					}else{
						tag += "<td></td>";
					}
					tag += "<td><input type='hidden' name='warehouse_cd' id='warehouse_cd_" + i + "' value='"+ json[i].warehouse_cd +"'/><input type='hidden' name='warehouse_nm' id='warehouse_nm_" + i + "' style='width:230px;border-color:LightCoral;' value='"+ json[i].warehouse_nm +"' readonly/>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].material + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					
					tag += "<td style='text-align:center;color:SeaGreen  ;'><b>" + json[i].remain_cnt + "<B></td>";
					tag += "<td style='text-align:left'>" + json[i].lot_no + "</td>";
					
					tag += "<td><input type='text' name='new_cnt' id='new_cnt_" + i + "' style='width:100px' /> <input type='button' class='btn btn-xs btn-warning' value='반영' onclick=\"modifyCnt('" + json[i].warehouse_cd + "','" + json[i].item_cd + "','" + json[i].standard1 + "'," + i + ",'" + json[i].lot_no + "','" + json[i].remain_cnt + "')\"/></td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr><td class='center' colspan='9'>등록된 재고가 없습니다.</td></tr>";
			}
			
			$("#item_list tbody").html(tag);
		
//			var table = "erp_stock_inout";
//			getPaging(table,where,rpp,adjacents);

		}
	);
}

// 재고수량 변경
function modifyCnt( warehouse_cd, item_cd, standard, i, lot_no, remain_cnt ){

	var warehouse_nm = $("#warehouse_nm_" + i).val();
	var new_cnt = $("#new_cnt_" + i).val();

	if(new_cnt == "") {
		alert("재고 조정 수량을 입력하세요");
		$("#new_cnt_" + i).focus();
		return false;
	}
	var dataString = "mode=modifyStock2&warehouse_cd=" + warehouse_cd + "&item_cd=" + item_cd + "&standard1=" + encodeURIComponent(standard) + "&new_cnt=" + removeComma(new_cnt)+ "&warehouse_nm=" + encodeURIComponent(warehouse_nm) + "&lot_no=" + lot_no + "&remain_cnt=" + removeComma(remain_cnt);
	//dataString = URLencode(dataString);

	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/item.php",
		success : function(str) {
			//alert(str);
			if(str == "success") {
				getStock($("#warehouse_click").val());
			}
		}
	});
}

function removeComma(n) {  // 콤마제거
    if ( typeof n == "undefined" || n == null || n == "" ) {
        return "";
    }
    var txtNumber = '' + n;
    return txtNumber.replace(/(,)/g, "");
}

// 페이지 세트
//function setPage(page){
//	$("#page").val(page);
//	getStock(page);
//}
//
//// 페이징 가져오기
//function getPaging(table,where,rpp,adjacents){
//	var data_string = "page=" + $("#page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents;
//
//	$.ajax({
//		type : "post",
//		url : "_get_paging.php",
//		data : data_string,
//		success : function(str) {
//			$("#paging_area").html(str);
//		}
//	});
//}

// 선택 삭제
//function deleteSelect(){
//	if(confirm("선택하신 창고재고 정보를 삭제하시겠습니까? 다른 데이터와 연동된 창고재고 정보는 삭제되지 않습니다.")) {
//		$(".chk").each(function(){
//			if($(this).prop('checked')) {
//				var new_uid = $("#check_uids").val() + "," + $(this).val();
//				$("#check_uids").val(new_uid);
//			}
//		});
//
//		var dataString = "mode=deleteSelectStock&table=erp_stock&uids=" + $("#check_uids").val();
//		$.ajax({
//			type : "post",
//			url : "ajax/stock.php",
//			data : dataString,
//			async : false,
//			success : function(str){
//				if(str.trim() != "success") {
//					alert(str);
//				} else {
//					$("#checkedAll").prop('checked',false);
//					getStock(1);
//				}
//			}
//		});
//	}
//}
</script>

<!-- inline scripts related to this page -->
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