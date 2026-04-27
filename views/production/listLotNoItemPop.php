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
						<!-- <div class="col-xs-2" style="float:left">
							<select id="per" onchange="getItem(1)">
								<option value="10">10개씩 보기</option>
								<option value="15">15개씩 보기</option>
								<option value="20">20개씩 보기</option>
								<option value="25">25개씩 보기</option>
								<option value="30">30개씩 보기</option>
								<option value="35">35개씩 보기</option>
								<option value="40">40개씩 보기</option>
								<option value="45">45개씩 보기</option>
								<option value="50">50개씩 보기</option>
								<option value="all">전체 보기</option>
							</select>
						</div> -->
						<div class="col-xs-12" style="float:right">
							<div class="col-xs-4"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="Search..." name="search_txt" id="search_txt" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="search()">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											Search
										</button>
									</span>
								</div>
							</div>
							<div style="float:right" class="col-xs-2">
								<select class="form-control" name="search_choice" id="search_choice">
									<option value="item_cd">품목명</option>
									<option value="lot_no_cd">로트No</option>
									
								</select>
							</div>
						</div>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="lot_no_list" class="table table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr>
										<? if($_SESSION['emp_level'] >= 99) { ?>
										<th class="detail-col center">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>		
										<? } ?>	
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 시리얼/로트No</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 규격명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 단가</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 창고</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 입고일</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<div class="clearfix col-xs-12" style="text-align:center;padding-top:10px"><span id="paging_area"></span></div>
					<div class="clearfix form-actions" style="margin-top:0px">
						<div class="col-xs-12">
							
						</div>
					</div>
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /.modal -->
<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="where" id="where" value="" />
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />


<?
require_once ("assets/include_script.php");
?>


<!----------------------------------------------------------------------------------------------------------------------->
<script>
$(document).ready(function(){
	var page = $("#page").val();
	getLotNo(page);

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
	getLotNo(1);
}

// 품목구분 품목 리스트 가져오기
function setItem(val) {
	$("#page").val(1);
	if(val == "all") {
		$("#where").val("");
	} else {
		$("#where").val(" where item_gb='" + val + "'");
	}
	getLotNo(1);
}

function getLotNo(page) {
	var rpp = 10;
	var adjacents = 4;
	var tag = "";
	var page = page;
	var search = $("#where").val();
	var lot_no_cd = $("#lot_no_cd").val();
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();
	var item_cd = "<?=$item_cd?>";
	var standard = "<?=$standard?>";

	$.getJSON("ajax/lot_no.php",{"page":page, "mode":"get_item_lot_no2", "rpp" : rpp, "adjacents" : adjacents, "where":search, "search_choice" : search_choice, "txt" : txt, "item_cd" : item_cd, "standard" : standard},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					<? if($_SESSION['emp_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					tag += "<td><a href='javascript:void(0);'  onclick=\"postLotNo('" + json[i].lot_no_cd + "','" + json[i].item_nm + "','" + json[i].warehousing_dt + "')\">" + json[i].lot_no_cd + "</a></td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postLotNo('" + json[i].lot_no_cd + "','" + json[i].item_nm + "','" + json[i].warehousing_dt + "')\">" + json[i].item_nm + "</a></td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					//tag += "<td >" + json[i].material + "</td>";
					tag += "<td class='text-right' nowrap>" + json[i].unit_price + "</td>";
					//tag += "<td class='text-right' nowrap>" + json[i].supply_price + "</td>";
					tag += "<td>" + json[i].warehouse_nm + "</td>";
					tag += "<td>" + json[i].warehousing_dt + "</td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='8' class='text-center'>등록된 로트No가 없습니다.</td>";
				tag += "</tr>";
			}

			$("#lot_no_list tbody").html(tag);

			var table = "erp_warehousing_lot_no";
			//if(lot_no_cd == "" ) {
			//	var where = "";
			//} else {
			//	//var where = $("#where").val() + " and lot_no_cd='"  + search_txt + "'";
			//	var where = $("#where").val();
			//}
			var where = " where 1=1";
			where += " and item_cd='"+item_cd+"' and standard1='"+standard+"'"; //구매 입고에서 부여된 LOT_NO를 가져오기 위한 
			if(txt != "") {
				if(search_choice == "lot_no_cd") {
					where += " and lot_no_cd like '%"+txt+"%'";
				} else if($search_choice == "item_cd") {
					where += " and item_cd like '%"+txt+"%'";
				}else{
					where += " and item_nm like '%"+txt+"%'";
				}
			}

			getPaging(table,escape(where),rpp,adjacents);
		}
	);
}

function postLotNo(lnc,lnn,dt){
	
	var flag = window.parent.$("#lotnocdFlag").val();
	var arr = [];
	var lotno = [];

	$.each(window.parent.$("#lot_no_cd_") , function () {
		arr.push($(this).val());
	});
	for(var i = 0 ; i <= arr.length ; i++) {
		lotno.push(arr[i]);
	}
	var check = lotno;
	var idx = jQuery.inArray(check, lotno);
	if(idx >= 0) {
		alert("동일 로트NO를 이미 선택하셨습니다");
	} else {	
		var flag = flag;
		window.parent.$("#lot_no_cd_" + flag).val(lnc);
		window.parent.$("#regdate_item_" + flag).val(dt);
		window.parent.$("#regdate_" + flag).val(dt);
		window.parent.$("#lotnocdFlag").val(Number(flag) + 1);
	}
	window.parent.$("#id-btn-dialog2").modal( 'hide' );
	//window.parent.$("#id-btn-dialog1").dialog("close");
	//window.parent.closeModal('#id-btn-dialog1');
	//$(opener.document).find("#id-btn-dialog1").dialog("close");
	//window.parent.closeModal('".$dialogID."');
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getLotNo(page);
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

		var dataString = "mode=deleteSelectLotno&table=erp_lot_no&uids=" + $("#check_uids").val();
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
	function close_popup()
	{	
		$.modal.close();
		$("#lot_no_reg_frame").attr("src", "about:blank");
	}
	function closePopup()
	{
		window.parent.closeModal('<?=$dialogid?>');
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