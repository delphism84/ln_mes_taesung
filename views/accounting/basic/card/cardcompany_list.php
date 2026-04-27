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
					카드사리스트
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 카드사 리스트를 보여드립니다.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<!-- 테이블 -->
					<table id="cardcompany_list" class="table  table-bordered table-hover">
						<thead>
							<tr> 
								<th class="text-center" style="width:20px">
									<span class="form-checkbox"><input name="chkAll" class="" type="checkbox" ><label class="" name="chkAll"></label></span>
								</th>
								<th class="col-xs-2 center" style="background-color:#f1f1f1">카드사코드</th>
								<th class="col-xs-2 center" style="background-color:#f1f1f1">카드사명</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">계좌번호</th>
								<th class="col-xs-2 center" style="background-color:#f1f1f1">계정명(계정코드)</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">수수료율</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">사용</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">검색창내용</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">적요</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div><!-- /.row -->
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<div class="col-xs-6"><span id="paging_area"></span></div>
					<div class="col-xs-6">
						<button class="btn btn-info" type="button" id="btn-footer-Change" onclick="cardcompany_reg()">
							<i class="ace-icon fa fa-check"></i>
							신규
						</button>
						<button class="btn btn-info" type="button" id="btn-footer-New">
							<i class="ace-icon fa fa-check"></i>
							변경
						</button>
						<button class="btn btn-info" type="button" id="btn-footer-SelectedDelete">
							<i class="ace-icon fa fa-check"></i>
							선택삭제
						</button>
					</div>
				</div>
			</div><!-- // submit -->
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
	get_cardcompany(page);
	
	$("#check-all").click(function(){
		if($(this).is(":checked")) $(".chk").attr("checked",true);
		else $(".chk").attr("checked",false);
	});
});

function get_cardcompany(page){
	var tag = "";
	var txt = $("#search_txt").val();
	var page = $("#page").val();
	var search = $("#where").val();
	var account_type = $("#account_type").val();

	//$("#customer_list tbody").remove();

/*
NO
[계정코드]계정명
계정
대차구분
계정종류
평가구분
사용구분
적요
*/

	$.getJSON("ajax/cardcompany.php",{"page":page, "mode":"get_cardcompany", "where":search, "account_type":account_type},
		function(json){
			if(json != null) {
				$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td>";
					tag += "<input type='checkbox' class='chk flat' name='table_records' value='" + json[i].idx + "'>";
					tag += "</td>";
					tag += "<td class='left'><a href='javascript:void(0);'  onclick='cardcompany_mod(" + json[i].idx + "," + json[i].card_ccode + ");'>" + json[i].card_ccode + "</a></td>";
					tag += "<td class='center'><a href='javascript:void(0);'  onclick='cardcompany_reg(" + json[i].idx + "," + json[i].card_ccode + ");'>" + json[i].card_cname + "</a></td>";
					tag += "<td class='center'><a href='javascript:void(0);'  onclick='cardcompany_reg(" + json[i].idx + "," + json[i].card_ccode + ");'>" + json[i].card_cnum + "</a></td>";
					tag += "<td class='center'>" + json[i].aci_nm + "(" + json[i].aci_cd + ")</td>";
					tag += "<td class='center'>" + json[i].com_rate + "</td>";
					tag += "<td class='center'>" + json[i].use_yn + "</td>";
					tag += "<td class='center'>" + json[i].search_box + "</td>";
					tag += "<td class='center'>" + json[i].re_mark + "</td>";
					tag += "</tr>";
				}
			} 

			$("#cardcompany_list tbody").html(tag);
		
			var table = "erp_cardcompany";
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
	get_cardcompany(page);
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

		var dataString = "mode=delete_data&table=erp_cardcompany&uids=" + $("#chk_uids").val();
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
	get_cardcompany(1);
}

function set_account(val) {
	$("#page").val(1);
	$("#account_type").val(val);
	get_cardcompany(1);
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

<!-- <div class="side-menu" id="sideMenu">
    <menu>
        <ul class="nav nav-tabs nav-stacked">
            <li><a href="#myModal" data-backdrop="false" data-toggle="modal">Click Me</a>
            </li>
        </ul>
    </menu>
</div> -->
<div id="id-btn-dialog3" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">적요리스트</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="remarkList_frame" frameborder="0" width="99%" height="300" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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

<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog" style="width:800px">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">카드사등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="cardcompanyReg_frame" frameborder="0" width="99%" height="500" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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


<div id="id-btn-dialog2" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">카드사수정</h4>
            </div>
            <div class="modal-body">
                <p><iframe src="" id="cardcompanyMod_frame" frameborder="0" width="99%" height="500" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
	function remark_view(cidx, acd)
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
	var url = "index.php?controller=accounting&action=listAccountingCodeRemarkPop&idx="+cidx+"&pop=Y&aci_cd="+acd;
	//var url = "./views/accounting/card/cardcompany_remark_list_pop.php?&uid="+cidx+"&pop=Y&ddd="+cidx;
	$("#remarkList_frame").attr("src", url);
}
function close_popup()
{	
	$.modal.close();
	$("#oremarkList_frame").attr("src", "about:blank");
}
//-->
</script>

<script type="text/javascript">
<!--
	function cardcompany_reg(cidx, acd)
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
	var url = "index.php?controller=accounting&action=registCardCompanyPop&idx="+cidx+"&pop=Y&aci_cd="+acd;
	//var url = "./views/accounting/card/cardcompany_remark_list_pop.php?&uid="+cidx+"&pop=Y&ddd="+cidx;
	$("#cardcompanyReg_frame").attr("src", url);
}
function close_popup()
{	
	$.modal.close();
	$("#cardcompanyReg_frame").attr("src", "about:blank");
}
//-->
</script>

<script type="text/javascript">
<!--
	function cardcompany_mod(cidx, acd)
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
	var url = "index.php?controller=accounting&action=modifyAccountingCodePop&idx="+cidx+"&pop=Y&aci_cd="+acd;
	//var url = "./views/accounting/card/cardcompany_remark_list_pop.php?&uid="+cidx+"&pop=Y&ddd="+cidx;
	$("#cardcompanyMod_frame").attr("src", url);
}
function close_popup()
{	
	$.modal.close();
	$("#cardcompanyMod_frame").attr("src", "about:blank");
}
//-->
</script>