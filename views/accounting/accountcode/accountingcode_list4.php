<?
/*
거래처 관련 Ajax 처리 페이지
*/

session_start();

//require_once('../../../connection.php');
//require_once('../library/json.php');
//require_once('../library/function.php');

//$json = new Services_JSON();

extract($_POST);
extract($_GET);

		$where = " where 1=1";
		
		if($account_gb == "all") {
			$where .= "";
		} else if($account_gb == "purchase") {
			$where .= " and account_gb='purchase'";
		} else if($account_gb == "sales") {
			$where .= " and account_gb='sales'";
		} else {
			$where .= "";
		}
		
		if($txt != "") {
			if($search_choice == "account_nm") {
				$where .= " and account_nm like '%".$txt."%'";
			} else if($search_choice == "account_cd") {
				$where .= " and account_cd like '%".$txt."%'";
			}
		}

		$query = "select * from erp_account".$where;
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = $rpp;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  

		$query = "select count(*) from erp_account".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_account".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		echo $query."<BR>" ;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['account_gb'] = $t->account_gb;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['owner'] = $t->owner;
			$re[$i]['corp_phone'] = $t->corp_phone;
			$re[$i]['corp_fax'] = $t->corp_fax;
			$re[$i]['corp_email'] = $t->corp_email;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}
		echo  "ere => ".$re;

		//echo $json->encode($re);

switch($mode) {
	// 거래처 리스트 가져오기
	case "getAccount" :
		$where = " where 1=1";
		
		if($account_gb == "all") {
			$where .= "";
		} else if($account_gb == "purchase") {
			$where .= " and account_gb='purchase'";
		} else if($account_gb == "sales") {
			$where .= " and account_gb='sales'";
		} else {
			$where .= "";
		}
		
		if($txt != "") {
			if($search_choice == "account_nm") {
				$where .= " and account_nm like '%".$txt."%'";
			} else if($search_choice == "account_cd") {
				$where .= " and account_cd like '%".$txt."%'";
			}
		}

		$query = "select * from erp_account".$where;
		$total_num = @mysql_num_rows(@mysql_query($query));

		$page = (is_numeric($page)) ? $page : 1; 
		$rpp = $rpp;  # record/page 
		$adjacents = $adjacents; # 양 옆에 표시될 페이지 수  

		$query = "select count(*) from erp_account".$where;
		$query = mysql_query($query); 
		list($total) = mysql_fetch_row($query); 
		$query = "select * from erp_account".$where." order by uid desc  limit ".($page-1)*$rpp.", ".$rpp;
		$result = mysql_query($query);

		$i = 0;
		$ct = 1;

		while($t = @mysql_fetch_object($result)) {
			$no = $rpp * ($page-1) + $ct;
			$re[$i]['total_num'] = $total_num;
			$re[$i]['no'] = $no;
			$re[$i]['uid'] = $t->uid;
			$re[$i]['account_gb'] = $t->account_gb;
			$re[$i]['account_cd'] = $t->account_cd;
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['owner'] = $t->owner;
			$re[$i]['corp_phone'] = $t->corp_phone;
			$re[$i]['corp_fax'] = $t->corp_fax;
			$re[$i]['corp_email'] = $t->corp_email;
			$re[$i]['create_dt'] = substr($t->create_dt,0,10);
			$i++;
			$ct++;
		}

		echo $json->encode($re);
	break;
	
	// 선택항목 삭제 => 다른 DB랑 연계되어 있으면 삭제 처리 하지 말아야 함...
	case "deleteSelectAccount" :
		$array_uid = explode(",",$uids);
		for($i = 0 ; $i <= sizeof($array_uid) ; $i++) {
			$query = "delete from erp_account where uid=".$array_uid[$i];
			mysql_query($query);
		}

		echo "success";
	break;
}
?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">Forms</a>
				</li>
				<li class="active">Form Elements</li>
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
					계약리스트
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 계약의 리스트를 보여드립니다.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

				<link rel="stylesheet" type="text/css" href="http://erp.ssabu.net/common.css" />
				<style type="text/css">
				.left{float:left;}
				.left_content th, .center_head th{ border:1px solid #878787;background:#969696;color:#FFF;height:20px;}
				.left_content td, .center_content td{border:1px solid #dbdbdb;}
				.left_content td{padding:3px 10px 3px 10px;}
				.center_content td{height:16px;}

				.center, .right{float:left;margin-left:10px;}
				.right{position:absolute;left:615px;top:48px;}
				.th5{width:25px;text-align:center;padding:0;margin:0;}
				.th1{width:40px;text-align:center;}
				.th2{width:130px;}
				.th3{width:82px;}
				.th4{width:90px;}
				.center_content{overflow:auto;height:514px;width:400px;}
				.center_content a:hover{text-decoration:none;}

				.top_ment{color:#FFF;position:absolute;left:510px;top:15px;}
				</style>
				<script type="text/javascript" src="http://erp.ssabu.net/config/jquery-1.11.2.js"></script>
				<script language="JavaScript" src="http://erp.ssabu.net/config/common.js"></script>
				<script language="JavaScript" src="http://erp.ssabu.net/config/ShowHideLayer.js"></script>
				<script type="text/javascript" src="http://erp.ssabu.net/config/CheckDate.js"></script>


				<div class="comm_top">
					<ul>
						<li style="padding-left:17px;padding-top:10px;"><img src="/fa/Images/comm/logo.png"></li>
						<li class="comm_top_bg"><span class="comm_title_text">계정과목 및 적요</span></li>
					</ul>
				</div>
				<div class="contents" style="margin-top: 35.88px; margin-bottom: 42.13px;">
					<div id="titleContents"></div>
					<table class="table table-bordered ">
						<colgroup>
							<col style="width: 150px;">
							<col>
						</colgroup>
						<tbody>
						</tbody>
					</table>
					<div class="wrapper">
						<table class="table table-bordered table-hover table-list " id="grid-main" style="width: 100%;">
							<colgroup>
							<col class="col-xs-1" style="width: 24px;" >
							<col class="col-xs-1" style="width: 380px;" >
							<col class="col-xs-1" style="width: 60px;" >
							<col class="col-xs-1" style="width: 60px;" >
							<col class="col-xs-1" style="width: 58px;" >
							<col class="col-xs-1" style="width: 58px;" >
							<col class="col-xs-1" style="width: 58px;" >
							<col class="col-xs-1" style="width: 50px;" >
							</colgroup>
							<thead>
								<tr>
									<th class=" text-center  valign-middle  " columnid="CHK_H">
									<span class="form-checkbox"><input name="chkAll" class="" type="checkbox" ><label class="" name="chkAll"></label></span>
									</th>
									<th class=" text-center  valign-middle  " ><span el-zid="c-2"></span>[계정코드]계정명</th>
									<th class=" text-center  valign-middle  " ><span el-zid="c-3"></span>계정</th>
									<th class=" text-center  valign-middle  " ><span el-zid="c-4"></span>대차구분</th>
									<th class=" text-center  valign-middle  " ><span el-zid="c-5"></span>계정종류</th>
									<th class=" text-center  valign-middle  " ><span el-zid="c-6"></span>평가구분</th>
									<th class=" text-center  valign-middle  " ><span el-zid="c-7"></span>사용구분</th>
									<th class=" text-center  valign-middle  " ><span el-zid="c-8"></span>적요</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center " >&nbsp;</td>
									<td class="text-left valign-middle indent1 " ><span><span style="padding-left: 4px; font-weight: bolder;">[0000] 최상위</span></span></td>
									<td class="text-center valign-middle  " ><a class="" href="#" >추가</a></td>
									<td class="text-center valign-middle " ><span>&nbsp;</span></td>
									<td class="text-center valign-middle " ><span>&nbsp;</span></td>
									<td class="text-center valign-middle " ><span>&nbsp;</span></td>
									<td class="text-center valign-middle " ><span>&nbsp;</span></td>
								</tr>
								<tr >
									<td class="text-center valign-middle  "><span class="form-checkbox "><input name="chkItem" class="" type="checkbox" ><label class=""></label></span></td>
									<td class="text-left valign-middle "><span class="list-inline" class="text-uline-no text-default text-uline-no tree-arrow open  " ></span><a class="" href="#" ><span style="padding-left: 4px; font-weight: bolder;">[1010] 자산</span></a></td>
									<td class="text-center valign-middle  " >추가</a></td>
									<td class="text-center valign-middle " ><span>자산</span></td><td class="text-center valign-middle " ><span>해당없음</span></td>
									<td class="text-center valign-middle " ><span>&nbsp;</span></td>
								</tr>
								<tr>
									<td class="text-center valign-middle  "><span class="form-checkbox "><input name="chkItem" class="" type="checkbox" ><label class=""></label></span></td>
									<td class="text-left valign-middle " ></span><a class="" href="#" ><span style="padding-left: 4px; font-weight: bolder;">[1011] 유동자산</span></a></td>
									<td class="text-center valign-middle  " ><a class="" href="#" >추가</a></td>
									<td class="text-center valign-middle " ><span>차변</span></td><td class="text-center valign-middle " ><span>자산</span></td>
									<td class="text-center valign-middle " ><span>해당없음</span></td><td class="text-center valign-middle " ><span>&nbsp;</span></td>
									<td class="text-center valign-middle " ><span>&nbsp;</span></td>
								</tr>
								<tr>
									<td class="text-center event-target "><span class="form-checkbox form-checkbox-text-no"><input name="chkItem" class="event-target" type="checkbox" ><label class="event-target"></label></span></td>
									<td class="font-12px text-left valign-middle event-target indent3 " ><span class="text-uline-no text-default text-uline-no tree-arrow open event-target " ></span><a class="event-target" href="#" ><span style="padding-left: 4px; font-weight: bolder;">[1012] 당좌자산</span></a></td>
									<td class="font-12px text-center valign-middle event-target " ><a class="event-target" href="#" >추가</a></td><td class="font-12px text-center valign-middle " ><span>차변</span></td>
									<td class="font-12px text-center valign-middle "><span>자산</span></td>
									<td class="font-12px text-center valign-middle "><span>해당없음</span></td>
									<td class="font-12px text-center valign-middle "><span>&nbsp;</span></td>
									<td class="font-12px text-center valign-middle "><span>&nbsp;</span></td></tr>
							</thead>
						</table>
						<div class="wrapper-toolbar " style="width: 100%; display: none;">
							<div class="pull-left"></div>
							<div class="pull-right text-right"></div>
						</div>
						<div class="table-clone-top position-fixed" style="left: 0px; top: -74.87px; width: 100%; padding-top: 0px; padding-left: 5px; visibility: visible; z-index: 3;" >
							<div style="width: 100%;">
								<div style="width: 100%;">
								<table class="table table-bordered table-hover table-list " id="grid-fixedtop" style="width: 100%;">
									<colgroup>
									<col class="col-xs-1 " style="width: 24px;" >
									<col class="col-xs-1 " style="width: 380px;">
									<col class="col-xs-1 " style="width: 60px;">
									<col class="col-xs-1 " style="width: 60px;">
									<col class="col-xs-1 " style="width: 58px;">
									<col class="col-xs-1 " style="width: 58px;">
									<col class="col-xs-1 " style="width: 58px;">
									<col class="col-xs-1 " style="width: 50px;">
									</colgroup>
									<thead>
										<tr class="tr-target" style="height: 31px;">
											<th class=" text-center  valign-middle "><span class="form-checkbox"><input name="chkAll" class="" type="checkbox"><label class="" name="chkAll"></label></span></th>
											<th class=" text-center  valign-middle " ><span></span>[계정코드]계정명</th>
											<th class=" text-center  valign-middle " ><span></span>계정</th>
											<th class=" text-center  valign-middle " ><span></span>대차구분</th>
											<th class=" text-center  valign-middle " ><span></span>계정종류</th>
											<th class=" text-center  valign-middle " ><span></span>평가구분</th>
											<th class=" text-center  valign-middle " ><span></span>사용구분</th>
											<th class=" text-center  valign-middle " ><span></span>적요</th>
										</tr>
									</thead>
								</table>
								</div>
							</div>
						</div>
					</div>
					<div class="wrapper-toolbar ">
						<div class="pull-left">
							<button class="btn btn-primary" id="btn-footer-New" >신규</button>
							<button class="btn btn-default" id="btn-footer-Change" >변경</button>
							<button class="btn btn-default" id="btn-footer-SelectedDelete" >선택삭제</button> 
							<button class="btn btn-default" id="btn-footer-Excel" >Excel</button>
						</div>
						<div class="pull-right"></div>
					</div>
				</div>
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="search_txt" id="search_txt" value="" />
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="account_type" id="account_type" value="" />

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

<script>
$(document).ready(function(){
	var page = $("#page").val();
	get_contract(page);
	
	$("#check-all").click(function(){
		if($(this).is(":checked")) $(".chk").attr("checked",true);
		else $(".chk").attr("checked",false);
	});
});

function get_contract(page){
	var tag = "";
	var txt = $("#search_txt").val();
	var page = $("#page").val();
	var search = $("#where").val();
	var account_type = $("#account_type").val();

	//$("#customer_list tbody").remove();

/*
NO
계약일자
만기일자
계약자
피보험자
상품구분
보험사
보험료
*/

	$.getJSON("ajax/contract.php",{"page":page, "mode":"get_contract", "where":search, "account_type":account_type},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td>";
					tag += "<input type='checkbox' class='chk flat' name='table_records' value='" + json[i].uid + "'>";
					tag += "</td>";
					tag += "<td><a href='index.php?controller=contract&action=contract_view&uid=" + json[i].uid + "'>" + json[i].join_date + "</a></td>";
					tag += "<td>" + json[i].end_date + "</td>";
					tag += "<td>" + json[i].policyholder + "</td>";
					tag += "<td>" + json[i].insurant + "</td>";
					tag += "<td>" + json[i].ins_div + "</td>";
					tag += "<td>" + json[i].ins_company + "</td>";
					tag += "<td>" + json[i].payment + "</td>";
					tag += "</tr>";
				}
			} 

			$("#contract_list tbody").html(tag);
		
			var table = "contract";
			if(account_type == 0) {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and account_type="  + account_type;
			}
			var rpp = 10;
			var adjacents = 4;
			get_paging(table,where,rpp,adjacents);
		}
	);
}

function set_page(page){
	$("#page").val(page);
	get_contract(page);
}

function get_paging(table,where,rpp,adjacents){
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

function delete_select(){
	if(confirm("선택하신 거래처 정보를 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).is(":checked")) {
				var new_uid = $("#chk_uids").val() + "," + $(this).val();
				$("#chk_uids").val(new_uid);
			}
		});

		var dataString = "mode=delete_data&table=contract&uids=" + $("#chk_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/ajax.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") alert(str);
				else location.reload();
			}
		});
	} else {
		location.reload();
	}
}

function excel_regist(){
	$("#excel_frm").submit();
}

function search(){
	var txt = $("#search_txt").val();
	$("#where").val(" where 1=1 and (name like '%" + txt + "%' or owner like '%" + txt + "%' or product like '%" + txt + "%')");
	get_contract(1);
}

function set_account(val) {
	$("#page").val(1);
	$("#account_type").val(val);
	get_contract(1);
}
</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/chosen.jquery.min.js"></script>
		<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/daterangepicker.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
			
			
			
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
						$(this).find('.chosen-container').each(function(){
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
<script type="text/javascript">
function inputSupply(c,n){
	var fid='';	
	if(fid==''){//거래처정보
		openSupplyWrite(c);
	}else{
		if(fid=='clientname'){//전표입력창
			opener.$(fid).value=n;
			var d=fid.split('_');
			if(d[1]){
				opener.$('client_'+d[1]).value=c;
			}else{
				opener.$('client').value=c;
			}
		}else{
			opener.$(fid).value=c;
			opener.$(fid+'name').innerHTML=n;
		}
		
		window.close();
	}
}

function openSupplyWrite(c){
	OpenWindow('supply_reg.html?uid='+c,'MainSupplyReg','510','290','0','410','no');
}

function goSearch(){
	location.href='?fid=&keyword='+$('keyword').value;
}
function goSearch_ent(){
	if(event.keyCode==13){
		goSearch();
	}
}

var currN='';
function goDetail(code,n){
	if(currN!='')ChangeColumnColor($('tr_'+currN),'#FFFFFF');
	ChangeColumnColor($('tr_'+n),'#b7e2e8');
	summary_detail.location.href='account_reg.html?code='+code+'&selno='+n;
	currN=n;
}

var currno='';
function goLoc(code,no){
	if(currno!='')ChangeColumnColor($('Ltr_'+currno),'#FFFFFF');
	ChangeColumnColor($('Ltr_'+no),'#b7e2e8');
	location.href='javascript:void(0);' +code;
	currno=no;
}

function setSave(CBno,app,systemcode){
	var params='form/ajx/balance_settle_set.html?mode=acc_save&syy=2017&CBno='+CBno+'&app='+app;
	//alert(params);
	$J.ajax({
		url: params,
		async: true,
		success:function(data){
			/*
			if(data && app=='N'){
				var ment='';
				var no='';
				switch(data){
					case '500' : ment='제조'; no=0; break;
					case '600' : ment='공사'; no=1; break;
					case '650' : ment='분양'; no=2; break;
					case '700' : ment='임대'; no=3; break;
					case '750' : ment='운송'; no=4; break;
				}
				window.alert(data+'번대('+ment+')의 전표가 입력되어 있습니다.\n확인하시기 바랍니다.');
				return;
			}else{
				if(app=='Y'){
					$('use_'+CBno).innerHTML="<font onClick=\"setSave('"+CBno+"','N','"+systemcode+"')\">(사용 여)<font>";
					$('S_'+systemcode).checked=true;
				}else{
					$('use_'+CBno).innerHTML="<font onClick=\"setSave('"+CBno+"','Y','"+systemcode+"')\" style='color:blue'>(사용 부)<font>";
					$('S_'+systemcode).checked=false;
				}
				chk_Scode(systemcode);
			}
			*/

				if(app=='Y'){
					$('use_'+CBno).innerHTML="<font onClick=\"setSave('"+CBno+"','N','"+systemcode+"')\">(사용 여)<font>";
					$('S_'+systemcode).checked=true;
				}else{
					$('use_'+CBno).innerHTML="<font onClick=\"setSave('"+CBno+"','Y','"+systemcode+"')\" style='color:blue'>(사용 부)<font>";
					$('S_'+systemcode).checked=false;
				}
				chk_Scode(systemcode);
		}
	});
}

function chk_all(){
	var Lnum=$('Lnum').value;
	for(var i=1; i<Lnum; i++){
		var systemcode=$('systemcode_'+i).value;
		if($('S_'+systemcode)){
			if($('chkall').checked==false){
				$('S_'+systemcode).checked=false;			
			}else{
				$('S_'+systemcode).checked=true;
			}
		}
	}

	var num=$('numrow').value;
	for(var i=1; i<num; i++){
		if($('chk_'+i)){
			if($('chkall').checked==false){
				$('chk_'+i).checked=false;			
			}else{
				var accName=$('td_accName_'+i).innerHTML;
				if(accName.indexOf('사용자설정계정과목')==-1)$('chk_'+i).checked=true;
			}
		}
	}
}

function chk_Scode(scode){
	var num=$('numrow').value;
	for(var i=1; i<num; i++){
		if($('chk_'+i)){
			var syscode=$('Scode_'+i).value;
			if(syscode==scode){
				if($('S_'+scode).checked==false){
					$('chk_'+i).checked=false;			
				}else{
					var accName=$('td_accName_'+i).innerHTML;
					if(accName.indexOf('사용자설정계정과목')==-1)$('chk_'+i).checked=true;
				}
			}
		}
	}
}

function writesubmit(){
	if(!confirm('사용여부를 저장 하시겠습니까?')){
		return;
	}
	document.acc_hidden.action='?mode=end';
	document.acc_hidden.submit();
}
</script>
