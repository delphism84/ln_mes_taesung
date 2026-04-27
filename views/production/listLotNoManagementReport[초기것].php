<?
$title = "LOT NO 관리 대장";

session_start();
extract($_POST);
extract($_GET);

$where = "";
if ($search_process_gb == ""){ 
	$where .= " where process_gb='1공장'" ;
}else{
	$where .= " where process_gb='".$search_process_gb."'" ;
}


if ($search_process_gb != "" && $search_choice != "" && $search_txt!= ""){ 
	if($search_choice == "lot_no_nm") {
		$wheres .= " and lot_no_nm like '%".$search_txt."%'";
	} else if($search_choice == "account_cd") {
		$wheres .= " and item_nm like '%".$search_txt."%'";
	}
}

	$sql = "select production_dt, faulty_qty1 from erp_product_perf_repost where process_cd='".$aaaa."'";
		//echo $sql."<BR>"; 
	$t0 = mysql_fetch_object(mysql_query($sql));




	$query = "select * from erp_process".$where;
//	echo  $query;
	$result = mysql_query($query) or die (mysql_error());

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
					<a href="#">생산관리</a>
				</li>
				<li class="active">LOT 관리대장</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					LOT 관리대장 
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 LOT 관리대장을 등록,조회 하실 수 있습니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="widget-header">
						<form name="frm" id="frm" method="post" action="index.php" />
						<input type="hidden" name="controller" id="controller" value="production" />
						<input type="hidden" name="uid" id="uid" value="<?=$uid?>" />
						<input type="hidden" name="action" id="action" value="listLotNoManagementReport" />
						<input type="hidden" name="process_uid" id="process_uid" />

						<div class="col-xs-4" style="float:right">
							<div class="col-xs-6" style="float:left">
								<div class="row">
									<div class="input-group">
										<div class="col-xs-5">
											<select name="process_gb" id="process_gb" class="form-control" onchange="postProcessGb(this.value)">
												<option value="1공장">1공장</option>
												<option value="2공장">2공장</option>
												<option value="연태공장">연태공장</option>
											</select>
										</div>
										<div class="left col-xs-6 layer" >
											<select name="process_cd" id="process_cd" onchange="postProcessNm(this.value)" class="form-control"><option value="0">공정전체</option></select>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-xs-6" style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="LOT_NO 검색" name="search_txt" id="search_txt" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="search()">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											검색
										</button>
									</span>
								</div>
							</div>
						</div>
						</form>
					</div>
					<div class="row">
					  <div class="col-md-5"><h4>원재료 LOT NO : <?=$search_choice?></h4></div>
					  <div class="col-md-5 col-md-offset-2"><h4>모델명 : SHILD CAN     품번 : 3PRB00057A</h4></div>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="item_list" class="table table-striped table-bordered table-hover" >
								<thead class="thin-border-bottom">
									<tr>
										<th class="col-xs-1 center no-padding" style="background-color:#eeeeee" >
											구매입고일
										</th>
										<?	$cnt="1";
											$i = 0;
											while($t = mysql_fetch_object($result)) {

												$list[$i]['process_cd'] = $t->process_cd;
												$list[$i]['process_nm'] = $t->process_nm;
										?>
										<th class="col-xs-1 no-padding ">
											<table class="table table-bordered no-padding" style="height:50px;background-color:#eeeeee">
											<thead class="thin-border-bottom no-padding">
												<TR>
												<th class=" center" colspan='2'  style="background-color:#eeeeee"><?=$t->process_nm?></th>
												</TR>
												<TR>
												<th class="col-xs-5 center"  style="background-color:#eeeeee">생산날짜</th><th class="col-xs-6 center"  style="background-color:#eeeeee">불량수량/양품수량</th>
												</TR>
											</thead>
											</table>
										</th>
										<?	$i++;
											$cnt++;
										}				
										?>
										<th class="col-xs-1 center no-padding" style="background-color:#eeeeee" >
											출하일
										</th>
										<th class="col-xs-1 center no-padding"  style="background-color:#eeeeee">
											비고
										</th>
									</tr>
								</thead>
								<tbody>

									<tr>
											<td class="col-xs-1 center" style="color:red">2017.01.28
											</td>
										<?for($i=0; $i<$cnt-1 ; $i++){?>
										<td class="col-xs-1 no-padding" >
											<table class="table table-bordered no-padding" style="height:25px;">
											<thead class="thin-border-bottom no-padding">
												
												<?if ($list[$i]['process_cd']=="P01"){
												$sql = "select production_dt, faulty_qty1 from erp_product_perf_repost where process_cd='".$list[$i]['process_cd']."'";
												//echo $sql."<BR>"; 
												$t0 = mysql_fetch_object(mysql_query($sql));
												
												?>
												<TR>
												<th class="col-xs-5 center">2018.10.01</th><th class="col-xs-6 center">1/5</th>
												</TR>
												<?}else{?>
												<TR>
												<th class="col-xs-5 center">2018.10.01</th><th class="col-xs-6 center">1/5</th>
												</TR>	
												<?}?>
											</thead>
											</table>
										</td>
										<?}?>
										<td class="col-xs-1 center " >2017.01.28
										</td>
										<td class="col-xs-1 center ">&nbsp;
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					
					<div class="clearfix form-actions" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
							<? if($_SESSION['login_level'] >= 99) { ?>
							<div class="col-xs-6 right" style="text-align:right">
								<button class="btn btn-danger" type="button" onclick="deleteSelect()">
									<i class="ace-icon fa fa-undo"></i>
									선택삭제
								</button>
							</div>
							<?}?>
						</div>
					</div>

<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>

			
			
<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

		</div>
	</div>
</div>


<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="searchTxt" id="searchTxt" value="" />
<input type="hidden" name="where" id="where" value=" where item_gb!='component'" />
<input type="hidden" name="item_gb" id="item_gb" value="" />
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />

<!-- basic script ------------------------------------------------------------------------------------------------------->

<?
require_once ("assets/include_script.php");
?>
<script type="text/javascript">
<!--
	/***************/
	//$('.show-details-btn').on('click', function(e) {
	$( document).on('click',".show-details-btn", function(e) {
		e.preventDefault();
		//var page = $("#page").val();
		//getLotno(page);
		$(this).closest('tr').next().toggleClass('open');
		$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
	});
	/***************/
//-->
</script>
<!----------------------------------------------------------------------------------------------------------------------->
<script>
$(document).ready(function(){
	var page = $("#page").val();
	//getItem(page);
	var process_gb = $("#process_gb option:selected").val();
	getPostProcessNm(process_gb)
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

function getPostProcessNm(gb){
	var tag = "<option value='0'>공정전체</option>";
	$.getJSON("ajax/production.php",{"mode":"getPostProcessNm", "process_gb" : gb},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].process_nm + "</option>";
				}
			}
			$("#process_cd").html(tag);
		}
	);
}

function postProcessGb(gb){
	getPostProcessNm(gb);
}

function postProcessNm(uid){
	$("#process_uid").val(uid);
}

// 검색
function search2(){
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

function search(){
if($("#search_process_gb").val()==""){
		alert("공장을 선텍하세요");
		$("#search_process_gb").focus();
		return false;
	}

	if($("#search_choice").val()==""){
		alert("검색필드를 선택하세요");
		$("#search_choice").focus();
		return false;
	}
	
	if($("#search_txt").val()==""){
		alert("검색어를 입력하세요 ");
		$("#search_txt").focus();
		return false;
	}
	$("#frm").submit();
}

// 거래처 리스트 가져오기
function getItem(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/production.php",{"page":page, "mode":"getItem", "rpp" : rpp, "adjacents" : adjacents, "where": where},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					switch(json[i].item_gb) {
						case "component" : var item_gb = "자재"; break;
						case "semi_product" : var item_gb = "반제품"; break;
						case "product" : var item_gb = "완제품"; break;
						default : var item_gb = "미구분"; break;
					} 

					if(json[i].item_gb != "component") { // 원자재는 BOM 이 없으므로
						tag += "<tr>";
						<? if($_SESSION['login_level'] >= 99) { ?>
						tag += "<td class='center'>";
						tag += "<label class='pos-rel'>";
						tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
						tag += "<span class='lbl'></span>";
						tag += "</label>";
						tag += "</td>";
						<?}?>
						tag += "<td>" + item_gb + "</td>";
						tag += "<td class='center'>";
							tag += "<div class='action-buttons'>";
								tag += "<a href='#' class='green bigger-140 show-details-btn' title='Show Details'>";
									tag += "<i class='ace-icon fa fa-angle-double-down'></i>";
									tag += "<span class='sr-only'>Details</span>";
								tag += "</a>";
							tag += "</div>";
						tag += "</td>";
						tag += "<td>" + json[i].item_cd + "</td>";
						tag += "<td>" + json[i].item_nm + "</td>";
						tag += "<td>" + json[i].standard1 + "</td>";
						tag += "<td>" + json[i].standard2 + "</td>";
						tag += "<td>" + json[i].standard3 + "</td>";
						tag += "<td>" + json[i].cnt + "</td>";
						tag += "<td></td>";
						tag += "<td><input type='button' class='btn btn-xs' value='BOM등록' onclick='bom(" + json[i].uid + ")' /></td>";
						tag += "</tr>";

						tag += "<tr class='detail-row'>";
						tag += "<td colspan='8'>";
							tag += "<div class='table-detail'>";
								tag += "<div class='row'>";
									tag += "<div class='widget-body'>";
									tag += "<div class='widget-main no-padding'>";
										tag += "<table id='item_list' class='table  table-bordered table-striped'>";
											tag += "<thead class='thin-border-bottom'>";
												tag += "<tr>";
													tag += "<? if($_SESSION['login_level'] >= 99) { ?>";
													tag += "<th class='detail-col center'>";
														tag += "<label class='pos-rel'>";
															tag += "<input type='checkbox' class='ace' id='checkedAll' />";
															tag += "<span class='lbl'></span>";
														tag += "</label>";
													tag += "</th>";
													tag += "<?}?>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 구분</th>";
													tag += "<th class='col-xs-2'><i class='ace-icon fa fa-caret-right blue'></i> 품목코드</th>";
													tag += "<th class='col-xs-2'><i class='ace-icon fa fa-caret-right blue'></i> 품목명</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 규격</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 규격</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 규격</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 원재료갯수</th>";
													tag += "<th class='col-xs-2'><i class='ace-icon fa fa-caret-right blue'></i> 파일관리</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> BOM등록</th>";
												tag += "</tr>";
											tag += "</thead>";
											tag += "<tbody></tbody>";
										tag += "</table>";
									tag += "</div>";
								tag += "</div>";
								tag += "</div>";
							tag += "</div>";
						tag += "</td>";
					tag += "</tr>";

					}
				}
			}

			$("#item_list tbody").html(tag);

			var table = "erp_item";
			getPaging(table,where,rpp,adjacents);
		}
	);
}


// 거래처 리스트 가져오기
function getLotno(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/production.php",{"page":page, "mode":"getItem", "rpp" : rpp, "adjacents" : adjacents, "where": where},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					switch(json[i].item_gb) {
						case "component" : var item_gb = "자재"; break;
						case "semi_product" : var item_gb = "반제품"; break;
						case "product" : var item_gb = "완제품"; break;
						default : var item_gb = "미구분"; break;
					} 

					if(json[i].item_gb != "component") { // 원자재는 BOM 이 없으므로
						tag += "<tr>";
						<? if($_SESSION['login_level'] >= 99) { ?>
						tag += "<td class='center'>";
						tag += "<label class='pos-rel'>";
						tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
						tag += "<span class='lbl'></span>";
						tag += "</label>";
						tag += "</td>";
						<?}?>
						tag += "<td>" + item_gb + "</td>";
						tag += "<td class='center'>";
							tag += "<div class='action-buttons'>";
								tag += "<a href='#' class='green bigger-140 show-details-btn' title='Show Details'>";
									tag += "<i class='ace-icon fa fa-angle-double-down'></i>";
									tag += "<span class='sr-only'>Details</span>";
								tag += "</a>";
							tag += "</div>";
						tag += "</td>";
						tag += "<td>" + json[i].item_cd + "</td>";
						tag += "<td>" + json[i].item_nm + "</td>";
						tag += "<td>" + json[i].standard1 + "</td>";
						tag += "<td>" + json[i].standard2 + "</td>";
						tag += "<td>" + json[i].standard3 + "</td>";
						tag += "<td>" + json[i].cnt + "</td>";
						tag += "<td></td>";
						tag += "<td><input type='button' class='btn btn-xs' value='BOM등록' onclick='bom(" + json[i].uid + ")' /></td>";
						tag += "</tr>";
					}
				}
			}

			$("#item_list tbody").html(tag);

			var table = "erp_item";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

function bom(uid) {
	location.href = "index.php?controller=production&action=inputPageBom&uid=" + uid;
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
	if(confirm("선택하신 BOM 정보를 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectBom&table=erp_item&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/production.php",
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

// 거래처 구분으로 거래처 리스트 가져오기
function setItem(val) {
	var item_gb = $("#item_gb option:selected").val();

	if(item_gb == "all") {
		$("#where").val(" where item_gb<>'component'");
	} else {
		$("#where").val(" where item_gb='" + val + "'");
	} 
	getItem(1);
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