<div class="main-content">
	<div class="main-content-inner">
		<!-- 페이지 상단 Location -->
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li class="active">전표관리</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					전표조회/수정
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						전표조회/수정
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="col-xs-12">
						<div class="col-xs-1" style="float:left">
							<select class="form-control" onchange="setAccount(this.value)">
								<option value="all">전체</option>
								<option value="sales">매출거래처</option>
								<option value="purchase">매입거래처</option>
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
									<option value="statement_dt">전표번호</option>
									<option value="account_nm">거래처명</option>
									<option value="account_cd">거래처코드</option>
								</select>
							</div>
						</div>
					</div>
					
					<div style="clear:both"></div>
					
					<div style="margin-top:10px">
						<table id="accounting_search_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="detail-col center" style="background-color:#f1f1f1">
										<label class="pos-rel">
											<input type="checkbox" class="ace" id="checkedAll" />
											<span class="lbl"></span>
										</label>
									</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">전표번호</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">거래유형</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">금액</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">거래처명</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">적요</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">전표</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>

<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>

			
			
<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
					<div class="col-xs-6 right" style="text-align:right">
						<!-- <button class="btn btn-info" type="button" onclick="location.href = 'index.php?controller=sales&action=inputPagestatement' "> -->
						<button class="btn btn-info" type="button" onclick="statement_reg('0','0')">
							<i class="ace-icon fa fa-check"></i>
							전표등록
						</button>
						&nbsp;
						<button class="btn btn-danger" type="button" onclick="deleteSelect()">
							<i class="ace-icon fa fa-undo"></i>
							선택삭제
						</button>
						&nbsp;
						<button class="btn " type="button" onclick="excelSelect()">
							<i class="ace-icon fa fa-undo"></i>
							excle
						</button>
					</div>
				</div>
			</div>
<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

		</div>
	</div>
</div>
<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">전표</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="statement_reg_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">전표</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="statement_modify_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
<input type="hidden" name="searchTxt" id="searchTxt" value="" />
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="account_gb" id="account_gb" value="" />
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />

<?
require_once ("assets/include_script.php");
?>
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
<script>
$(document).ready(function(){
	var page = $("#page").val();
	getStatement(page);

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

function commaSplit(n) {// 콤마 나누는 부분
    var txtNumber = '' + n;
    var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
    var arrNumber = txtNumber.split('.');
    arrNumber[0] += '.';
    do {
        arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
    }
    while (rxSplit.test(arrNumber[0]));
    if(arrNumber.length > 1) {
        return arrNumber.join('');
    } else {
        return arrNumber[0].split('.')[0];
    }
}

// 거래처 리스트 가져오기
function getStatement(page){
	var table = "erp_statement";
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();
	var page = page;
	var search = $("#where").val();
	var account_gb = $("#account_gb").val();

	$.getJSON("ajax/statement.php",{"page":page, "mode":"getStatement", "rpp" : rpp, "adjacents" : adjacents, "where":search, "account_gb":account_gb, "search_choice" : search_choice, "txt" : txt, "table" : table},
		function(json){
			if(json != null) {
				$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					tag += "<td class='center' ><a href='javascript:void(0);'  onclick='statement_modiy(" + json[i].uid + "," + json[i].statement_no + ",\"" + json[i].statement_dt + "\", " + json[i].statement_ca + ",\"" + json[i].trade_type_code + "\",\"" + json[i].trade_type + "\")' >" + json[i].statement_dt + "-" + json[i].statement_ca + "</a></td>";
					if (json[i].trade_type_code =="G" ){
						tag += "<td class='center' >" + json[i].trade_type + "</td>";
					}else if (json[i].trade_type_code =="S" )	{
						tag += "<td class='center' style='color:#ff0000;'>" + json[i].trade_type + "</td>";
					}else if (json[i].trade_type_code =="P" )	{
						tag += "<td class='center' style='color:#0000ff;'>" + json[i].trade_type + "</td>";	
					}else{
						tag += "<td class='center'>" + json[i].trade_type + "</td>";
					}
					tag += "<td class='center'>" + commaSplit(json[i].total_amount) + "</td>";
					tag += "<td class='center'>" + json[i].account_nm + "</td>";
					tag += "<td class='center'>" + json[i].remark + "</td>";
					tag += "<td class='center'><a href='javascript:void(0);'  onclick='javascript:openWinPrint(" + json[i].uid + ");'>인쇄</a></td>";

					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
					tag += "<td colspan=10 class='center'>등록된 전표 리스트가 없습니다.";
					tag += "</td>";
				tag += "</tr>";
			}

	
			$("#accounting_search_list tbody").html(tag);

			if(account_gb == "" || account_gb == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			}

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getStatement(page);
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
		$(".chk input:checked").each(function(){
		  var checked = $(this).attr("checked"); // 체크된 값만을 불러 들인다.

		  if(checked==true){
		   $(this).next().remove(); //span내용지우기
		   $(this).remove();   //checkbox 지우기
		  }
		 });



	if(confirm("선택하신 전표 정보를 삭제하시겠습니까? 다른 데이터와 연동된 전표 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				//alert($(this).val())
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				//alert(new_uid)
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectStatement_s&table=erp_statement&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/statement.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getStatement(1);
				}
			}
		});
	}
}

// 검색
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();
	
	if(search_choice == "statement_dt") {
		var strArray=txt.split('-');
		var sorted_arr = strArray.slice().sort();

		if (strArray.length ==1){
			$("#where").val(" where 1=1 and statement_dt like '%" + strArray[0] + "%'");
		}else{
			$("#where").val(" where 1=1 and statement_dt ='" + strArray[0] + "' and statement_no='" + strArray[1] + "' ");
		}
	
	}else if(search_choice == "account_nm") {
		$("#where").val(" where 1=1 and account_nm like '%" + txt + "%' ");
	} else if(search_choice == "account_cd") {
		$("#where").val(" where 1=1 and account_cd like '%" + txt + "%' ");
	}
	
	getStatement(1);
}

// 거래처 구분으로 거래처 리스트 가져오기
function setAccount(val) {
	$("#page").val(1);
	$("#account_gb").val(val);
	getStatement(1);
}
</script>
<script type="text/javascript">
<!--
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
				
		//chosen plugin inuide a modal will have a zero width because the select element is originally hidden
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
	function statement_reg(cidx, acd)
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
	var url = "index.php?controller=accounting&action=registGeneralStatementPop&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogid=id-btn-dialog1";
	$("#statement_reg_frame").attr("src", url);
	}

	function statement_modiy(uid, mid, dt, ca, tp, tt)
	{
	$("#id-btn-dialog2").modal({
		show: true,
		title : "전표",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	$(".modal-title").html(tt);
	
	if (tp=="S"){
		var action  ="modifySalesStatementPop";
		var id = "&uid="+uid+"&sid="+mid;
	}else if (tp=="P"){
		var action  ="modifyPurchaseStatementPop";
		var id = "&uid="+uid+"&pid="+mid;
	}else if (tp=="G"){
		var action  ="modifyGeneralStatementPop";
		var id = "&uid="+uid+"&gid="+mid;
	}else{
		var action  ="modifyStatementPop";
		var id = "&uid="+mid;
	}

	var url = "index.php?controller=accounting&action="+action+ id+"&pop=Y&statement_dt="+dt+"&statement_ca="+ca+"&tp="+tp+"&dialogid=id-btn-dialog2";
	//var url = "http://localhost/index.php?controller=accounting&action=modifySalesStatementPop&sid=7&pop=Y&statement_dt=2017/11/02&statement_ca=7&tp=S"
	$("#statement_modify_frame").attr("src", url);
	}

	function close_popup()
	{	
		$.modal.close();
		$("#statement_reg_frame").attr("src", "about:blank");
	}
//-->
</script>
<script language="javascript" type="text/javascript">  
<!--  
function openWinPrint(uid){  
    window.open("/views/accounting/doc_form/print/statement_print.php?uid="+uid, "전표인쇄", "width=800, height=700, toolbar=no, menubar=no, scrollbars=yes, resizable=yes" );  
}  
//-->  
</script> 
