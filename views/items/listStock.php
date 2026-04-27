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
				<li class="active">재고현황</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					재고현황
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
						<div class="col-xs-6" style="float:left">
							<select id="per" onchange="getStock(1)">
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
									<option value="item_cd">품목코드</option>
									<option value="item_nm">품목명</option>
								</select>
							</div>
						</div>
						
					</div>
					
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="item_list" class="table  table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 재질</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 단위</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 총재고수량</th>
										<!--
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 입고단가</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 금액</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 이미지</th>
										-->
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<div class="clearfix form-actions center" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-12 center"><span id="paging_area"></span></div>
						</div>
					</div>

<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>


<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="where" id="where" value=" group by item_cd, standard1" />
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
	var page = $("#page").val();
	getStock(page);

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
	var txt = $("#search_txt").val();
	var field = $("#search_choice").val();
	
	//$("#where").val(" where "+field+" like '%" + txt + "%' ");
	var where = $("#where").val();
	$("#where").val(where + " having " + field + " like '%" + txt + "%'");
	getStock(1);
}

// 거래처 리스트 가져오기
function getStock(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	
	$.getJSON("ajax/stock.php",{"page":page, "mode":"getStock", "rpp" : rpp, "adjacents" : adjacents, "where" : $("#where").val() },
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td><a href='#' onclick='stock_inout_pop(\""+ json[i].item_cd +"\",\""+ json[i].standard1 +"\")'>" + json[i].item_cd + "</a></td>";
					tag += "<td><a href='#' onclick='stock_inout_pop(\""+ json[i].item_cd +"\",\""+ json[i].standard1 +"\")'>" + json[i].item_nm + "</a></td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].material + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					if( json[i].remain_cnt < 0){
						tag += "<td style='text-align:right;background-color:#ffc1c1'>" + json[i].remain_cnt + "</td>";
					}else{
						tag += "<td style='text-align:left'>" + json[i].remain_cnt + "</td>";
					}
					//tag += "<td style='text-align:right'>" + json[i].p_price + "</td>";
					//tag += "<td style='text-align:right'>" + json[i].total_price + "</td>";
					//if($.trim(json[i].img) != "") tag += "<td class='center'><a href='#' onclick='location.href = \"index.php?controller=base&action=modifyPageItem&uid=" + json[i].uid + "\"'><img src='attach/" + json[i].img + "' style='width:80px;' /></a></td>";
					//else 	tag += "<td class='center'><a href='#' onclick='location.href = \"index.php?controller=base&action=modifyPageItem&uid=" + json[i].uid + "\"'><img src='assets/images/noimg.gif' style='width:80px;' /></a></td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr><td class='center' colspan='9'>등록된 재고가 없습니다.";
				tag += "</td></tr>";
			}

			$("#item_list tbody").html(tag);

			var table = "erp_stock";
			getPaging(table, $("#where").val() ,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getStock(page);
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
	if(confirm("선택하신 창고재고 정보를 삭제하시겠습니까? 다른 데이터와 연동된 창고재고 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectStock&table=erp_stock&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/stock.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getStock(1);
				}
			}
		});
	}
}

	function stock_inout_pop(cd,st)	//재고수불부 화면 띄우기
	{
	$("#id-btn-dialog1").modal({
		show: true,
		title : "재고수불부",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=items&action=listPageStockInoutPop&itemcd="+cd+"&standard="+st+"&pop=Y&dialogID=id-btn-dialog1";
	$("#stock_inout_list_frame").attr("src", url);
	}
			
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