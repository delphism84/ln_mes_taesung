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

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<!-- 테이블 -->
					<table id="contract_list" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">NO</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">계약일자</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">만기일자</th>
								<th class="col-xs-2 center" style="background-color:#f1f1f1">계약자</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">피보험자</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">상품구분</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">보험사</th>
								<th class="col-xs-1 center" style="background-color:#f1f1f1">보험료</th>
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
						<button class="btn btn-info" type="button">
							<i class="ace-icon fa fa-check"></i>
							Submit
						</button>

						&nbsp; &nbsp; &nbsp;
						<button class="btn" type="reset">
							<i class="ace-icon fa fa-undo"></i>
							Reset
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