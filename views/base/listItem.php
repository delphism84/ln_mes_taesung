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
				<li class="active">품목 리스트</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					품목 리스트
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 품목 리스트를 보여드립니다.
					</small>
					<button class="btn btn-white btn-info btn-bold" onclick="ExcelDown()">
						<i class="ace-icon fa fa-file-excel-o bigger-120 blue"></i>
						엑셀다운
					</button>
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
							<select class="" onchange="setItem(this.value)">
								<option value="all">전체</option>
								<option value="component">자재</option>
								<option value="semi_product">반제품</option>
								<option value="product">완제품</option>
							</select>
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
									<option value="item_nm">품목명</option>
									<option value="item_cd">품목코드</option>
									<option value="item_group_nm">그룹명</option>
								</select>
							</div>
						</div>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="item_list" class="table table-bordered table-striped table-condensed">
								<thead class="thin-border-bottom">
									<tr>
										<? if($_SESSION['login_level'] >= 99) { ?>
										<th class="detail-col center">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>
										<? } ?>	
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 이미지</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 구분</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 그룹명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 재질</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 단위</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 바코드</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 입고단가</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 출고단가</th>
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
								<button class="btn btn-info" type="button" onclick="location.href = 'index.php?controller=base&action=inputPageItem' ">
									<i class="ace-icon fa fa-check"></i>
									품목등록
								</button>
								<?
								if($_SESSION['login_level'] >= 99) { ?>
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
	getItem(page);

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

//엑셀다운
function ExcelDown(){
	location.href="views/items/allocationDayExcel.php?where="+$("#where").val();
}

// 검색
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	if(search_choice == "item_nm") {
		$("#where").val(" where item_nm like '%" + txt + "%' ");
	} else if(search_choice == "item_cd") {
		$("#where").val(" where item_cd like '%" + txt + "%' ");
	} else if(search_choice == "item_group_nm") {
		$("#where").val(" where item_group_nm like '%" + txt + "%' ");
	}
	getItem(1);
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
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					if($.trim(json[i].img) != "" && $.trim(json[i].img) != "none") 	tag += "<td class='center'><a href='#' onclick='location.href = \"index.php?controller=base&action=modifyPageItem&uid=" + json[i].uid + "\"'><img src='attach/" + json[i].img + "' style='width:60px;' /></a></td>";
					else 	tag += "<td class='center'><a href='#' onclick='location.href = \"index.php?controller=base&action=modifyPageItem&uid=" + json[i].uid + "\"'><img src='assets/images/noimg.gif' style='width:60px;' /></a></td>";
					tag += "<td>" + gb + "</a></td>";
					tag += "<td><a href='#' onclick='location.href = \"index.php?controller=base&action=modifyPageItem&uid=" + json[i].uid + "\"'>" + json[i].item_cd + "</a></td>";
					tag += "<td>" + json[i].item_nm + "</a></td>";
					tag += "<td>" + json[i].item_group_nm + "</td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].material + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					tag += "<td>" + json[i].barcode + "</td>";
					tag += "<td>" + json[i].pur_unit_price + "</td>";
					tag += "<td>" + json[i].unit_price + "</td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='12' class='center'>등록된 품목이 없습니다.";
				tag += "</td>";
				tag += "</tr>";
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
	if(confirm("선택하신 품목 정보를 삭제하시겠습니까? 다른 데이터와 연동된 품목 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectItem&table=erp_item&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/item.php",
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