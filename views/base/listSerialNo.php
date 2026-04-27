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
					<a href="#">기준정보관리</a>
				</li>
				<li class="active">Lot-no 관리</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					로트No 관리
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 로트No를 보여드립니다.
					</small>
					<a href="#" class="btn btn-xs btn-app radius-4">
						<i class="ace-icon fa fa-cog"></i>
					</a>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div class="widget-header">
						<div class="col-xs-2" style="float:left">
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
							<!-- <select class="" onchange="setItem(this.value)">
								<option value="all">전체</option>
								<option value="component">자재</option>
								<option value="semi_product">반제품</option>
								<option value="product">완제품</option>
							</select> -->
						</div>
						<div class="col-xs-6" style="float:right">
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
							<div style="float:right">
								<select class="form-control" name="search_choice" id="search_choice">
									<option value="lot_no_cd">로트No</option>
									<option value="item_cd">품목명</option>
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
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 시리얼/로트No</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 규격명</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 유효기한</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 상세내역</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<div class="clearfix form-actions" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
							<div class="col-xs-6 right" style="text-align:right">
								<button class="btn btn-info" type="button" onclick="lot_no_reg('0','0')">
									<i class="ace-icon fa fa-check"></i>
									Lot No 등록
								</button>
								<?
								if($_SESSION['emp_level'] >= 99) {
								?>
								<button class="btn btn-danger" type="button" onclick="deleteSelect()">
									<i class="ace-icon fa fa-undo"></i>
									선택삭제
								</button>
								<?
								}
								?>
							</div>
						</div>
					</div>
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>
<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:30%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">로트No등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="lot_no_reg_frame" frameborder="0" width="99%" height="350" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
<div id="id-btn-dialog2" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:30%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">로트No수정</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="lot_no_modify_frame" frameborder="0" width="99%" height="350" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
<div id="id-btn-dialog3" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">실적처리인쇄</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="lot_no_print_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
	getItem(1);
}

function getLotNo(page) {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = page;
	var search = $("#where").val();
	var lot_no_cd = $("#lot_no_cd").val();
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	$.getJSON("ajax/lot_no.php",{"page":page, "mode":"get_lot_no", "rpp" : rpp, "adjacents" : adjacents, "where":search, "search_choice" : search_choice, "txt" : txt},
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
					tag += "<td><a href='#' onclick='lot_no_modiy(" + json[i].uid + ")'>" + json[i].lot_no_cd + "</a></td>";
					tag += "<td><a href='#' onclick='lot_no_modiy(" + json[i].uid + ")'>" + json[i].lot_no_nm + "</a></td>";
					tag += "<td></td>";
					tag += "<td>" + json[i].regdate + "</a></td>";
					tag += "<td><a href='javascript:void(0);' onclick=\"postLotNo('" + json[i].lot_no_cd + "','" + json[i].lot_no_nm + "')\">보기</a></td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='6' class='text-center'>등록된 로트No 가 없습니다.</td>";
				tag += "</tr>";
			}

			$("#lot_no_list tbody").html(tag);

			var table = "erp_lot_no";
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
// 품목가져오기
function getItem(page){
	var rpp = $("#per").val();
	var adjacents = 5;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/item.php",{"page":page, "mode":"getItem", "rpp" : rpp, "adjacents" : adjacents, "where": where},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					switch(json[i].item_gb) {
						case "component" :
							var gb = "자재";
						break;

						case "semi_product" :
							var gb = "반제품";
						break;

						case "product" :
							var gb = "완제품";
						break;
					}
					tag += "<tr>";
					<? if($_SESSION['emp_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					tag += "<td><a href='#' onclick='location.href = \"index.php?controller=base&action=modifyPageItem&uid=" + json[i].uid + "\"'>" + json[i].lot_no_cd + "</a></td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "<td><a href='#' onclick='location.href = \"index.php?controller=base&action=modifyPageItem&uid=" + json[i].uid + "\"'>" + json[i].lot_no_dt + "</a></td>";
					tag += "<td>" + json[i].item_group_nm + "</td>";
					tag += "</tr>";
				}
			}
			
			//tag += "<tr><td colspan='10'></td></tr>";
			$("#item_list tbody").html(tag);

			var table = "erp_item";
			getPaging(table,where,rpp,adjacents);
		}
	);
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
	var url = "index.php?controller=base&action=registLotNo&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogid=id-btn-dialog1";
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
	
	var url = "index.php?controller=base&action=modifyLotNo&uid="+uid+"&pop=Y&dialogid=id-btn-dialog2";
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
	
	var url = "index.php?controller=production&action=productPerfReportsPrint&pop=Y&uid="+uid+"&dialogid=id-btn-dialog3";
	$("#lot_no_print_frame").attr("src", url);
	}

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