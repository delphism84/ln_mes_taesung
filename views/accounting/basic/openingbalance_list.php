<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">회계1</a>
				</li>
				<li class="active">기초잔액입력</li>
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
					기초잔액입력

					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						재무제표별 기초잔액입력
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<form method="post" action="" id="form1">
						<div class="aspNetHidden">
							<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="F2A94615" />
						</div>
						<div id="wrap">
							<div class="new-title">
								<div><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>재무제표별기초잔액입력</div>
							</div><!--endof 타이틀바-->
							<table id="contract_list" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th class="col-xs-1 center" style="background-color:#f1f1f1">재무제표</th><!--LBL02433-->
										<td style="background-color:#ffffff">
											<input type="radio" id="rbBS" name="rbGubun" onclick="fnSelect();" value="BS"  checked="checked" />재무상태표<br />
											<input type="radio" id="rbPL" name="rbGubun" onclick="fnSelect();" value="PL" />손익계산서<br />
											<input type="radio" id="rbCOST" name="rbGubun" onclick="fnSelect();" value="COST" />원가명세서
										</td>
									</tr>
									<tr>
										
										<th class="col-xs-1 center" style="background-color:#f1f1f1">부서</th>
										<td class="col-xs-5"style="background-color:#ffffff">
											<div class="input-group">
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input type="text" name="site" id="txtSiteCd" size="20"/>
														<span class="input-group-addon btn-purple" id="id-btn-dialog1">
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
														</span>
														<span>&nbsp;</span>
														<input type="text" name="site_des" id="txtSiteDes" style="width:100px;" value="" class="grayleft"  readonly />
													</div>
												</span>
											</div>
										</td>
									</tr>
									<tr>
										
										<th class="col-xs-1 center" style="background-color:#f1f1f1">프로젝트</th>
										<td class="col-xs-5" style="background-color:#ffffff">
											<div class="input-group">
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input type="text" name="pjt_cd" id="pjt_cd" size="20"/>
														<span class="input-group-addon btn-purple" id="id-btn-dialog2">
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
														</span>
														<span>&nbsp;</span>
														<input id="pjt_des" type="text" name="pjt_des" class="grayleft" value="" size="30" readonly="readonly" style="width:100px;"/>
													</div>
												</span>
											</div>
										</td>
									</tr>
									<tr>
										<th class="col-xs-1 center" style="background-color:#f1f1f1">기초잔액입력월</th>
										<td style="background-color:#ffffff"><span class="Pink_strong"><label id="lblYYMM">2011년 12월</label></span>&nbsp;&nbsp;<a href="#" name="id-btn-dialog3" id="id-btn-dialog3" >기초잔액입력월변경</a></td>
									</tr>
										<input type="hidden" name="yymm" id="yymm" value="201112" />
										<input type="hidden" name="sum_type" id="sum_type" value="1" />
								</thead>
							</table>
							<div class="">
								<input type="button" name="btnInput" class="btn btn-primary" id="Button1" onclick="sendit();" value='신규' />
								<!-- <button type="submit" class="btn btn-primary">신규</button> -->
							</div><!-- /.footerBG -->
						</div> <!--/.wap end--> 
							<input type="hidden" id="hidSearchXml" name="hidSearchXml" />
							<input type="hidden" name="hidFavSeq" id="hidFavSeq"/>
					</form>
				</div>
			</div><!-- /.row -->

	</div>
</div><!-- /.main-content -->
	<style type="text/css">
		.modal-header {
		padding: 2px 5px;
		border-bottom: 1px solid #eee;
		background-color: #0480be;
		-webkit-border-top-left-radius: 6px;
		-webkit-border-top-right-radius: 6px;
		-moz-border-radius-topleft: 6px;
		-moz-border-radius-topright: 6px;
		border-top-left-radius: 6px;
		border-top-right-radius: 6px;
		}
	</style>
	<!-- 모달 팝업 -->
	<div class="modal fade" id="mySite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header" style="height:30px;background-color:#0080c0;">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h5 class="modal-title" id="myModalLabel">부서</h5>
	      </div>
	      <div class="modal-body">
			<iframe src="/views/accounting/basic/openingbalance_site_p.php" style ="width:100%;height:300px" scrolling="yes" frameborder="0"></iframe>
	      </div>
	      <!-- <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
	      </div> -->
	    </div>
	  </div>
	</div>

	<!-- 모달 팝업 -->
	<div class="modal fade" id="myPjt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	  <div class="modal-dialog">
	    <div class="modal-content" >
	      <div class="modal-header" style="height:30px;back;background-color:#0080c0;">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h5 class="modal-title" id="myModalLabel">부서</h5>
	      </div>
	      <div class="modal-body">
			<iframe src="/views/accounting/basic/openingbalance_site_p.php" style ="width:100%;height:300px" scrolling="yes" frameborder="0"></iframe>
	      </div>
	      <!-- <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
	      </div> -->
	    </div>
	  </div>
	</div>

	<!-- 모달 팝업 -->
	<div class="modal fade" id="myBasicmoney" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	  <div class="modal-dialog">
	    <div class="modal-content" >
	      <div class="modal-header" style="height:30px;back;background-color:#0080c0;">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h5 class="modal-title" id="myModalLabel">기초잔액연월변경</h5>
	      </div>
	      <div class="modal-body">
			<iframe src="/views/accounting/basic/openingbalance_basicmoney_p.php" style ="width:100%;height:300px" scrolling="yes" frameborder="0"></iframe>
	      </div>
	      <!-- <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
	      </div> -->
	    </div>
	  </div>
	</div>

<div id="dialog-message" class="hide">
	<table id="site_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-2 center" style="background-color:#f1f1f1">구분</th>
				<th class="col-xs-3 center" style="background-color:#f1f1f1">거래처명</th>
				<th class="col-xs-3 center" style="background-color:#f1f1f1">거래처코드</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<div id="dialog-message1" class="hide">
	<table id="item_group_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">품목그룹코드</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">품목그룹명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<div id="dialog-message2" class="hide">
	<h5 class="modal-title" id="myModalLabel">기초잔액연월변경</h5>
	<table class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-4 center" style="background-color:#f1f1f1">설립일자</th>
				<td>1999.01.01</td>
			</tr>
			<tr>
				<th class="col-xs-4 center" style="background-color:#f1f1f1">기초잔액입력 월</th>
				<td>2011.12</td>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div></div>
	<table class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-4 center" style="background-color:#f1f1f1">변경연월(월말)</th>
				<td><input type="text" name="sub_item_group_cd" id="sub_item_group_cd" readonly /></td>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<h5 class="modal-title" id="myModalLabel">기존에 2011년 12월로 입력된 기초잔액은 삭제됩니다.</h5>
</div><!-- #dialog-message -->

<!----------------------------------------------------------------------------------------------------------------------->
<!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/common.js"></script>
<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/jquery.inputlimiter.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<!-- page specific plugin scripts -->
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getDepartment(page);
	getItemGroup();
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

function createItemGroupCode(){
	var data_string = "mode=createItemGroupCode";

	$.ajax({
		type : "post",
		url : "ajax/ajax.php",
		data : data_string,
		success : function(str) {
			$("#sub_item_group_cd").val(str);
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

function getItemGroup(page) {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = page;

	$.getJSON("ajax/item.php",{"page":page, "mode":"getItemGroup", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postItemGroupData('" + json[i].item_group_cd + "','" + json[i].item_group_nm + "')\">" + json[i].item_group_nm + "</a></td>";
					tag += "<td>" + json[i].item_group_cd + "</td>";
					tag += "</tr>";
				}
			}

			$("#item_group_list tbody").html(tag);

			var table = "erp_item_group";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function getWarehouse() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = page;

	$.getJSON("ajax/warehouse.php",{"page":page, "mode":"getWarehouse", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postWarehouseData('" + json[i].warehouse_cd + "','" + json[i].warehouse_nm + "')\">" + json[i].warehouse_cd + "</a></td>";
					tag += "<td>" + json[i].warehouse_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#warehouse_list tbody").html(tag);

			var table = "erp_warehouse";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 거래처 리스트 가져오기
function getDepartment(page){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	//var search_choice = $("#search_choice option:selected").val();
	//var txt = $("#search_txt").val();
	var page = page;
	var search = $("#where").val();
	var department_gb = $("#department_gb").val();

	$.getJSON("ajax/department.php",{"page":page, "mode":"getDepartment", "rpp" : rpp, "adjacents" : adjacents, "where":search, "department_gb":department_gb},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					if(json[i].department_gb == "purchase") var clas = "매입";
					else var clas = "매출";
					
					tag += "<tr>";
					tag += "<td class='center'>" + clas + "</td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postData('" + json[i].department_cd + "','" + json[i].department_nm + "')\">" + json[i].department_nm + "</a></td>";
					tag += "<td>" + json[i].department_cd + "</td>";
					tag += "</tr>";
				}
			}

			$("#site_list tbody").html(tag);

			var table = "erp_department";
			if(department_gb == "" || department_gb == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and department_gb='"  + department_gb + "'";
			}

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getDepartment(page);
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

// 검색
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	if(search_choice == "department_nm") {
		$("#where").val(" where 1=1 and department_nm like '%" + txt + "%' ");
	} else if(search_choice == "department_cd") {
		$("#where").val(" where 1=1 and department_cd like '%" + txt + "%' ");
	}
	getDepartment(1);
}

// 거래처 구분으로 거래처 리스트 가져오기
function setDepartment(val) {
	$("#page").val(1);
	$("#department_gb").val(val);
	getDepartment(1);
}

function postData(code,name) {
	$("#department_cd").val(code);
	$("#department_nm").val(name);
}

function postItemGroupData(code,name) {
	$("#item_group_cd").val(code);
	$("#item_group_nm").val(name);
}

function postWarehouseData(code,name) {
	$("#warehouse_cd").val(code);
	$("#warehouse_nm").val(name);
}


function formSubmit(){
	var data_string = "mode=checkItemCode&item_cd=" + $("#item_cd").val() + "&unit=" + $("#unit").val();
	$.ajax({
		type : "post",
		url : "ajax/item.php",
		data : data_string,
		success : function (str) {
			if(str == "false") {
				alert("중복된 품목코드와 규격을 가진 품목이 존재합니다");
				return false;
			} else {
				$("#frm").submit();
			}
		}
	});
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
				
	$( "#id-btn-dialog1" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>부서검색</h4></div>",
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

				
	$( "#id-btn-dialog2" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>품목그룹 리스트</h4></div>",
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

				
	$( "#id-btn-dialog3" ).on('click', function(e) {
		e.preventDefault();
		createItemGroupCode();	
		var dialog = $( "#dialog-message2" ).removeClass('hide').dialog({
			width : 500,
			height : 330,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>기초잔액연월변경</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "닫기",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "변경",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						registItemGroup();
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	$( "#id-btn-dialog4" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message3" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>창고 리스트</h4></div>",
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