<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">인사/급여</a>
				</li>
				<li class="active">급여관리</li>
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
					급여입력
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						급여입력.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<!-- 테이블 -->
					<table id="pay_check_list" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th class="text-center" style="width:20px">
									<span class="form-checkbox"><input name="chkAll" class="" type="checkbox" ><label class="" name="chkAll"></label></span>
								</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">귀속년월</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">구분</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">급여대장명칭</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">지급일</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">지급연월</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">사전작업</th>
								<th class="col-xs-2 center" style="background-color:#f1f1f1">급여계산(인원)</th>
								<th class="col-xs-2 center" style="background-color:#f1f1f1">급여대장</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">지급총액</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">상여지급률(액)</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div><!-- /.row -->
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
					<div class="col-xs-6 right" style="text-align:right">
						<!-- <button class="btn btn-info" type="button" onclick="location.href = 'index.php?controller=sales&action=inputPagestatement' "> -->
						<button class="btn btn-info" type="button" onclick="payCheck_reg('0','0')">
							<i class="ace-icon fa fa-check"></i>
							등록
						</button>
						&nbsp; &nbsp; &nbsp;
						<button class="btn btn-danger" type="button" onclick="copySelect()">
							<i class="ace-icon fa fa-undo"></i>
							선택삭제
						</button>

						&nbsp; &nbsp; &nbsp;
						<button class="btn btn-danger" type="button" onclick="deleteSelect()">
							<i class="ace-icon fa fa-undo"></i>
							선택삭제
						</button>
					</div>
				</div>
			</div>
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="search_txt" id="search_txt" value="" />
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="account_type" id="account_type" value="" />



<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:50%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">급여정보입력</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="payCheck_reg_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
    <div class="modal-dialog modal-lg" style="width:50%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">급여정보입력</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="payCheck_modify_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
    <div class="modal-dialog modal-lg" style="width:50%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header3">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">금액직접입력</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="payCheckEmp_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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


		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

<script>
$(document).ready(function(){
	var page = $("#page").val();
	get_pay_check(page);
	
	$("#check-all").click(function(){
		if($(this).is(":checked")) $(".chk").attr("checked",true);
		else $(".chk").attr("checked",false);
	});
});

function get_pay_check(page){
	var table = "erp_pay_check";
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();
	var page = page;
	var search = $("#where").val();
	var pay_gubun = $("#pay_gubun").val();

	$.getJSON("ajax/pay_check.php",{"page":page, "mode":"getPayCheck", "rpp" : rpp, "adjacents" : adjacents, "where":search, "pay_gubun":pay_gubun, "search_choice" : search_choice, "txt" : txt, "table" : table},
		function(json){
			if(json != null) {
				$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td>";
					tag += "<input type='checkbox' class='chk flat' name='table_records' value='" + json[i].uid + "'>";
					tag += "</td>";
					tag += "<td class='left'><a href='javascript:void(0);'  onclick='payCheck_modiy(" + json[i].uid + ");'>" + json[i].pay_check_dt + " - "+json[i].pay_check_ca + "</a></td>";
					tag += "<td class='center'>" + json[i].pay_gubun + "</td>";
					tag += "<td class='center'>" + json[i].paydes + "</td>";
					tag += "<td class='center'>" + json[i].paydate + "</td>";
					tag += "<td class='center'>" + json[i].lastday + "</td>";
					tag += "<td class='center'><a href='javascript:void(0);'  onclick='payCheckEmp_input(" + json[i].uid + ",\"" + json[i].pay_check_dt + "\"," + json[i].pay_check_ca + ",\"" + json[i].lastday + "\");'>금액 직접입력</a></td>";
					tag += "<td class='center'>[<a href='index.php?controller=salary&action=registsalaryCodeRemarkPop&uid=" + json[i].uid + "'>전체계산</a>] [<a href='index.php?controller=salary&action=registsalaryCodeRemarkPop&uid=" + json[i].uid + "'>개인별계산</a>]</td>";
					tag += "<td class='center'>[<a href='index.php?controller=salary&action=registsalaryCodeRemarkPop&uid=" + json[i].uid + "'>조회</a>] [<a href='index.php?controller=salary&action=registsalaryCodeRemarkPop&uid=" + json[i].uid + "'>명세서</a>] [<a href='index.php?controller=salary&action=registsalaryCodeRemarkPop&uid=" + json[i].uid + "'>확정</a>] [<a href='index.php?controller=salary&action=registsalaryCodeRemarkPop&uid=" + json[i].uid + "'>삭제</a>]</td>";
					tag += "<td class='center'>" + json[i].totalpayamount + "</td>";
					tag += "<td class='center'>" + json[i].payrate + "(" + json[i].payrateflag + ")</td>";
					tag += "</tr>";
				}
			} else{
					tag += "<tr>";
					tag += "<td class='center' colspan='11'>등록된 급여 데이터가 없습니다.</td>";
					tag += "</tr>";
			}

			$("#pay_check_list tbody").html(tag);
		
			var table = "erp_pay_check";
			if(pay_gubun == 0) {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and pay_gubun="  + pay_gubun;
			}
			var rpp = 10;
			var adjacents = 4;
			get_paging(table,where,rpp,adjacents);
		}
	);
}

function set_page(page){
	$("#page").val(page);
	get_account_code(page);
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

		var dataString = "mode=delete_data&table=erp_account_code&uids=" + $("#chk_uids").val();
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
	get_account_code(1);
}

function set_account(val) {
	$("#page").val(1);
	$("#account_type").val(val);
	get_account_code(1);
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
<!--
	  //$("#id-btn-dialog3").show(); 
	  var url = "";

	  $('#id-btn-dialog1').attr('src', url);
	  $("#id-btn-dialog1").draggable({
      handle: "#modal-header1"
});
	  $('#id-btn-dialog2').attr('src', url);
	  $("#id-btn-dialog2").draggable({
      handle: "#modal-header2"
});
	  $('#id-btn-dialog3').attr('src', url);
	  $("#id-btn-dialog3").draggable({
      handle: "#modal-header3"
});
//-->
</script>
<style type="text/css">
.modal
{
    overflow: hidden;
}
.modal-dialog{
    margin-right: 0;
    margin-left: 0;
}	
</style>

<script type="text/javascript">
<!--
	function payCheck_reg(cidx, acd)
	{
	$("#id-btn-dialog1").modal({
		show: true,
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=salary&action=registPayCheckPop&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogid=id-btn-dialog1";
	//var url = "./views/salary/card/cardcompany_remark_list_pop.php?&gid="+cidx+"&pop=Y&ddd="+cidx;
	$("#payCheck_reg_frame").attr("src", url);
	}

	function payCheck_modiy(uid)
	{
	$("#id-btn-dialog2").modal({
		show: true,
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	var url = "index.php?controller=salary&action=modifyPayCheckPop&uid="+uid+"&pop=Y&dialogid=id-btn-dialog2";
	//var url = "./views/salary/card/cardcompany_remark_list_pop.php?&gid="+cidx+"&pop=Y&ddd="+cidx;
	$("#payCheck_modify_frame").attr("src", url);
	}

	function payCheckEmp_input(uid, dt, ca, ld)
	{
	$("#id-btn-dialog3").modal({
		show: true,
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	var url = "index.php?controller=salary&action=listPayMemberPop&uid="+uid+"&pop=Y&pay_check_dt="+dt+"&pay_check_ca="+ca+"&lastday="+ld+"&dialogid=id-btn-dialog3";
	//var url = "./views/salary/card/cardcompany_remark_list_pop.php?&gid="+cidx+"&pop=Y&ddd="+cidx;
	$("#payCheckEmp_frame").attr("src", url);
	}

	function close_popup()
	{	
		$.modal.close();
		$("#payCheck_reg_frame").attr("src", "about:blank");
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