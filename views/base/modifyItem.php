<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">기준정보관리</a>
				</li>
				<li class="active">품목등록</li>
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
					품목등록
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
						<input type="hidden" name="controller" id="controller" value="base" />
						<input type="hidden" name="action" id="action" value="updateItem" />
						<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />

						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="fa fa-check red" aria-hidden="true"></i> 품목구분</th>
								<td class="col-xs-5">
									<select name="item_gb" id="item_gb" >
									<!-- <select name="item_gb" id="item_gb" onclick="createCode(this.value)"> -->
										<option value="0">선택</option>
										<option value="component" <? if($t->item_gb == "component") echo "selected"; ?>>자재</option>
										<option value="semi_product" <? if($t->item_gb == "semi_product") echo "selected"; ?>>반제품</option>
										<option value="product" <? if($t->item_gb == "product") echo "selected"; ?>>완제품</option>
									</select> <span style="color:#438eb9">* 품목구분을 선택하시면 자동으로 품목코드가 생성이 됩니다</span>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">품목그룹</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="item_group_cd" id="item_group_cd" value="<?=$t->item_group_cd?>" readonly />
												<input type="text" name="item_group_nm" id="item_group_nm" value="<?=$t->item_group_nm?>" onclick="centerOpenWindow('views/popup/productGroupList.php', '품목그룹리스트', 500, 500)" readonly />
												<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/productGroupList.php', '품목그룹리스트', 500, 500,'','auto')">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												<span class="input-group-addon btn-danger" onclick="centerOpenWindow('views/popup/createProductGroup.php', '품목그룹리스트', 500, 300)">
													<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="fa fa-check red" aria-hidden="true"></i> 품목코드</i></th>
								<td class="col-xs-5">
									<input type="text" validation="yes" err="품목코드를 입력하세요" name="item_cd" id="item_cd" value="<?=$t->item_cd?>" readonly /> <input type="button" value="중복확인" id="ajax_request"/> 
									<div id="loadtext" style="font-color:red;padding:5px 5px 5px 5px"></div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="fa fa-check red" aria-hidden="true"></i> 품목명</th>
								<td class="col-xs-5"><input type="text" validation="yes" err="품목명을 입력하세요" name="item_nm" id="item_nm" value="<?=$t->item_nm?>" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="fa fa-check red" aria-hidden="true"></i> 단위</th>
								<td class="col-xs-5">
									<select name="unit" id="unit">
										<option value="ea" <? if($t->unit == "ea") echo "selected"; ?>>ea</option>
										<option value="kg" <? if($t->unit == "kg") echo "selected"; ?>>kg</option>
										<option value="g" <? if($t->unit == "g") echo "selected"; ?>>g</option>
										<option value="m" <? if($t->unit == "m") echo "selected"; ?>>m</option>
										<option value="km" <? if($t->unit == "km") echo "selected"; ?>>km</option>
										<option value="roll" <? if($t->unit == "roll") echo "selected"; ?>>roll</option>
										<option value="box" <? if($t->unit == "box") echo "selected"; ?>>box</option>
									</select>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="fa fa-check red" aria-hidden="true"></i>규격</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" validation="yes" err="규격을 입력하세요" name="standard1" id="standard1" value="<?=$t->standard1?>" />
												<span class="input-group-addon btn-purple" onclick="searchStandard1()">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												<span class="input-group-addon btn-danger" onclick="centerOpenWindow('views/popup/createStandard1.php', '품목규격', 500, 300)">
													<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="fa fa-check red" aria-hidden="true"></i>재질</th>
								<td class="col-xs-5" >
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="material" id="material" onclick="searchMaterial()" value="<?=$t->material?>"  />
												<span class="input-group-addon btn-purple" onclick="searchMaterial()">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												<span class="input-group-addon btn-danger" onclick="centerOpenWindow('views/popup/createMaterial.php', '재질', 500, 300)">
													<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="fa fa-check blue" aria-hidden="true"></i> 생산공정
								<span class="help-button" data-rel="tooltip" data-trigger="hover" data-placement="right" title="생산공정을 입력합니다. 품목구분이 제품 또는 반제품인 경우에만 생산공정을 입력합니다.">?</span>
								</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="process_cd" id="process_cd" value="<?=$t->process_cd?> "readonly />
												<input type="hidden" name="ranking" id="ranking" value="<?=$t->ranking?>" readonly />
												<input type="text" name="process_nm" id="process_nm" onclick="ProductProcess()" value="<?=$t->process_nm?>" readonly />
												<span class="input-group-addon btn-purple" onclick="ProductProcess()">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												<span class="input-group-addon btn-danger" onclick="centerOpenWindow('views/popup/productProcessList.php?mode=reg', '생산공정', 600, 400)">
													<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="fa fa-check red" aria-hidden="true"></i> 최소구매<br />(생산)단위</th>
								<td class="col-xs-5"><input type="text" validation="yes" err="최소구매(생산)단위를 입력하세요" name="min_pur_unit" id="min_pur_unit" value="<?=$t->min_pur_unit?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="fa fa-check red" aria-hidden="true"></i> 입고창고</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="warehouse_cd" id="warehouse_cd" value="<?=$t->warehouse_cd?>" readonly />
												<input type="text" validation="yes" err="입고창고를 입력하세요" name="warehouse_nm" id="warehouse_nm" value="<?=$t->warehouse_nm?>" onclick="centerOpenWindow('views/popup/warehouseList.php', '품목규격', 500, 300)" readonly />
												<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/warehouseList.php', '입고창고', 500, 300)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1;">구매처(판매처)</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="account_cd" id="account_cd" value="<?=$t->account_cd?>" readonly />
												<input type="text" name="account_nm" id="account_nm" value="<?=$t->account_nm?>" onclick="centerOpenWindow('views/popup/accountList.php', '거래처리스트', 600, 500)" readonly />
												<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/accountList.php', '거래처리스트', 600, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1;">조달기간</th>
								<td class="col-xs-5"><input type="text" name="delivery_period" id="delivery_period" value="<?=$t->delivery_period?>" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1;">
									<i class="fa fa-check red" aria-hidden="true"></i> 기초재고수량 
									<span class="help-button" data-rel="tooltip" data-trigger="hover" data-placement="right" title="현재의 재고수량을 입력하시면 됩니다">?</span>
								</th>
								<td class="col-xs-5"><input type="text" class="onlynum text-right" name="base_stock_cnt" id="base_stock_cnt" value="<?=$t->base_stock_cnt?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1;"><i class="fa fa-check red" aria-hidden="true"></i> 안전재고수량</th>
								<td class="col-xs-5">
								<?
								if($_SESSION['auto_safety_stock'] == "0" || $_SESSION['auto_safety_stock'] == "1"){?>
								<input type="text" class="onlynum text-right" validation="yes" err="안전재고수량을 입력하세요" name="safety_stock_cnt" id="safety_stock_cnt" value="<?=$t->safety_stock_cnt?>"/>
								<?}else if($_SESSION['auto_safety_stock'] == "2"){?>
								<a href="#" id="safety_stock" onclick='safety_stock_reg()' class="btn btn-info btn-sm">창고별지정</a>
								<?}?>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">입고단가</th>
								<td class="col-xs-5"><input type="text" class="onlynum text-right" name="pur_unit_price" id="pur_unit_price" value="<?=round($t->pur_unit_price,2);?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">출고단가</th>
								<td class="col-xs-5"><input type="text" class="onlynum text-right" name="unit_price" id="unit_price" value="<?=round($t->unit_price,2);?>"/></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">입고바코드</th>
								<td class="col-xs-5"><input type="text" class="form-control" name="in_barcode" id="in_barcode" value="<?=$t->in_barcode?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">출고바코드</th>
								<td class="col-xs-5"><input type="text" class="form-control" name="barcode" id="barcode" value="<?=$t->barcode?>" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">이미지</th>
								<td class="col-xs-11" colspan="3">
									<?
									if($t->img != "" && $t->img != "none") echo "<img src='attach/".$t->img."' style='width:80px;height:40px' /><br>";
									?>
									<input type="file" name="img" id="img" />
								</td>
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
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=base&action=listPageItem' ">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						품목리스트
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<!----------------------------------------------------------------------------------------------------------------------->

<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:30%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">창고별안전재고등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="safety_stock_reg_frame" frameborder="0" width="99%" height="370" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
<?
require_once ("assets/include_script.php");
?>


<!----------------------------------------------------------------------------------------------------------------------->

<script>
function searchStandard1() {
	var item_cd = $("#item_cd").val();
	centerOpenWindow('views/popup/standard1List.php?item_cd=' + item_cd, '품목규격', 500, 300);
}
function searchMaterial() {
	var item_cd = $("#item_cd").val();
	centerOpenWindow('views/popup/materialList.php?item_cd=' + item_cd, '품목재질', 500, 300);
}
function ProductProcess() {
	var process_cd = $("#process_cd").val();
	centerOpenWindow('views/popup/productProcessList.php?process_cd=' + process_cd, '생산공정', 600, 400);
}


function centerOpenWindow(theURL, winName, width, height, fstate, scrollbars){ 
	var features = "width=" + width ; 
	features += ",height=" + height ; 
	var state = ""; 
	var scrollbars = "yes"; 
	var res_w = ( $(window).width() - width ) / 2; 
	var res_h = ( $(window).height() - height ) / 2; 
	if ( window.screenLeft >= window.screen.width ) { 
		res_w = window.screen.width + res_w; 
	} 
	if (fstate == "") { // 옵션 
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 

function createCode(item_gb) {
	var data_string = "mode=createItemCode&item_gb=" + item_gb;

	$.ajax({
		type : "post",
		url : "ajax/base.php",
		data : data_string,
		success : function(str) {
			$("#item_cd").val(str);
			$("#barcode").val(str);
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

function formSubmit(){
	if(check("frm")) {
		if($("#item_gb option:selected").val() == "0") {
			alert("품목구분을 선택하세요");
			return false;
		} 
		
		if($("#item_gb option:selected").val() == "component" && $("#account_cd").val() == "") {
			alert("구매처를 선택하세요");
			return false;
		}
					
		if($("#item_gb option:selected").val() != "component" && $("#unit_price").val() == "") {
			alert("반제품 또는 완제품은 출고단가를 입력하셔야 합니다");
			return false;
		}

		$("#frm").submit();
	}
}

$("#ajax_request").click(function(){

	var item_cd = $('#item_cd').val();
	if (item_cd =="")
	{
		alert("아이템 코드를 입력하세요.")
		$('#item_cd').focus();
		return false;
	}
	$.ajax({
	type: "POST",
	url: "../../ajax/itemCodeCheck.php", 
	data: "item_cd="+ item_cd+"&mode=getItemCd",
	cache: false,
	success: function(data){
		$("#loadtext").html(data); 
	}
	});
});s

function cp(txt) {
	$("#barcode").val(txt);
}
</script>
<script>
function number_format(data)
{
    var tmp = '';
    var number = '';
    var cutlen = 3;
    var comma = ',';
    var i;

    var sign = data.match(/^[\+\-]/);
    if(sign) {
        data = data.replace(/^[\+\-]/, "");
    }

    len = data.length;
    mod = (len % cutlen);
    k = cutlen - mod;
    for (i=0; i<data.length; i++)
    {
        number = number + data.charAt(i);

        if (i < data.length - 1)
        {
            k++;
            if ((k % cutlen) == 0)
            {
                number = number + comma;
                k = 0;
            }
        }
    }

    if(sign != null)
        number = sign+number;

    return number;
}

$(function() {
    $("input#base_stock_cnt, input#safety_stock_cnt").on("keyup", function() {
        var val = String(this.value.replace(/[^0-9]/g, ""));

        if(val.length < 1)
            return false;

        this.value = number_format(val);
    });
});
</script>
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
	
	$('[data-rel=tooltip]').tooltip({container:'body'});
	$('[data-rel=popover]').popover({container:'body'});
				
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

<script>
	
function lotnocdFlag(flag) {
	$("#lotnocdFlag").val(flag);
}


function getLotNo(page) {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = page;
	var search = $("#where").val();
	var lot_no_cd = $("#lot_no_cd").val();

	$.getJSON("ajax/lot_no.php",{"page":page, "mode":"get_lot_no", "rpp" : rpp, "adjacents" : adjacents, "where":search, "lot_no_cd":lot_no_cd},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					//if(json[i].lot_no_cd == "purchase") var clas = "매입";
					//else var clas = "매출";
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postLotNo('" + json[i].lot_no_cd + "','" + json[i].lot_no_nm + "')\">" + json[i].lot_no_cd + "</a></td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postLotNo('" + json[i].lot_no_cd + "','" + json[i].lot_no_nm + "')\">" + json[i].lot_no_nm + "</a></td>";
					tag += "</tr>";
				}
			}

			$("#lot_no_list tbody").html(tag);

			var table = "erp_lot_no";
			if(lot_no_cd == "" || lot_no_cd == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and lot_no_cd='"  + lot_no_cd + "'";
			}

			getPaging(table,where,rpp,adjacents);
		}
	);
}
function postLotNo(lnc,lnn){
	$("#dialog-message").dialog("close");
	var arr = [];
	$.each($("#lot_no_cd") , function () {
		arr.push($(this).val());
	});
	var idx = jQuery.inArray(lnc, arr);
	//if(idx >= 0) {
	//	alert("동일 계정을 이미 선택하셨습니다");
	//} else {
		
		var flag = $("#lotnocdFlag").val();
		$("#lot_no_cd_" + flag).val(lnc);
		$("#lot_no_nm_" + flag).val(lnn);
	//}
}

function registLotNo(){
	if(!check_str($("#lot_no_cd").val(),"로트넘버 항목코드")) return false;
	if(!check_str($("#lot_no_nm").val(),"로트넘버 항목명")) return false;

	//var dataString = "mode=registLotNo&uid=" + $("#uid").val() + "&lot_no_cd=" + $("#lot_no_cd").val() + "&lot_no_nm=" + $("#lot_no_nm").val();
	var dataString = "mode=registLotNo&lot_no_cd=" + $("#lot_no_cd").val() + "&lot_no_nm=" + $("#lot_no_nm").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/lot_no.php",
		success : function(str) {
			if(str == "success") {
				//getPosition();
				$("#lot_no_cd").val("");
				$("#lot_no_nm").val("");
			} else {
				alert(str);
			}
		}
	});
}

function safety_stock_reg(cidx)
{
	var item_cd = $("#item_cd").val();
	var item_nm = $("#item_nm").val();

	if (item_cd=="")
	{
		alert('품목코드를 입력하세요.')
		$("#item_cd").focus();
		return false;
	}

	$("#id-btn-dialog1").modal({
		resizable: false,
		width: '320',
		modal: true,
		show: true,
		title : "창고별안전재고등록",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	var url = "index.php?controller=base&action=registSafetyStock&idx="+cidx+"&item_cd="+item_cd+"&item_nm="+item_nm+"&pop=Y&dialogID=id-btn-dialog1";
	$("#safety_stock_reg_frame").attr("src", url);
}

	function close_popup()
	{	
		$.modal.close();
		$("#standard_code_reg_frame").attr("src", "about:blank");
	}
	function closePopup()
	{
		window.parent.closeModal('<?=$dialogID?>');
		window.parent.location.reload();
	}
	window.closeModal = function(obj) {
		alert(obj)
		$("#"+obj).modal( 'hide' );
	}

//-->
</script>