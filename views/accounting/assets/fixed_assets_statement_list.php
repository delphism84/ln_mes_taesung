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
					<a href="#">회계</a>
				</li>
				<li class="active">고정자산</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					고정자산전표조회
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						고정자산전표조회
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="col-xs-12">
						<!-- <div class="col-xs-1" style="float:left">
							<select class="form-control" onchange="setAccount(this.value)">
								<option value="all">전체</option>
								<option value="sales">매출거래처</option>
								<option value="purchase">매입거래처</option>
							</select>
						</div> -->
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
									<option value="fac_nm">자산명</option>
									<option value="asset_ac_nm">자산계정명</option>
								</select>
							</div>
						</div>
					</div>
					
					<div style="clear:both"></div>

					<div style="margin-top:10px">
						<table id="fixed_assets_statement_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="detail-col center" style="background-color:#f1f1f1">
										<label class="pos-rel">
											<input type="checkbox" class="ace" id="checkedAll" />
											<span class="lbl"></span>
										</label>
									</th>
									<th class="col-xs-1 center" style="background-color:#f1f1f1">일자-No</th>
									<th class="col-xs-1 center" style="background-color:#f1f1f1">구분</th>
									<th class="col-xs-1 center" style="background-color:#f1f1f1">자산명</th>
									<th class="col-xs-1 center" style="background-color:#f1f1f1">자산계정명</th>
									<th class="col-xs-1 center" style="background-color:#f1f1f1">수량</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">원가</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">처분금액</th>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">적요</th>
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
						<button class="btn btn-info" type="button" onclick="fixedAssetsStatement_reg('0','0')">
							<i class="ace-icon fa fa-check"></i>
							전표등록
						</button>

						&nbsp; &nbsp; &nbsp;
						<button class="btn btn-danger" type="button" onclick="deleteSelect()">
							<i class="ace-icon fa fa-undo"></i>
							선택삭제
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
                 <h4 class="modal-title">고정자산내역등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="fixedAssetsStatement_reg_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
                 <h4 class="modal-title">고정자산내역등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="fixedAssetsStatement_modify_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
<input type="hidden" name="check_gids" id="check_gids" />

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
<script>
$(document).ready(function(){
	var page = $("#page").val();
	getFixedAssetsStatement(page);

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

function getFixedAssetsStatement(page){
	var table = "erp_fixed_assets_statement";
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();
	var page = page;
	var search = $("#where").val();
	var account_gb = $("#account_gb").val();

	$.getJSON("ajax/fixedasset.php",{"page":page, "mode":"getFixedAssetsStatement", "rpp" : rpp, "adjacents" : adjacents, "where":search, "account_gb":account_gb, "search_choice" : search_choice, "txt" : txt, "table" : table},
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
					tag += "<td class='center' ><a href='javascript:void(0);'  onclick='fixedAssetsStatement_modiy(" + json[i].uid + "," + json[i].statement_dt + ", " + json[i].statement_ca + ")' >" + json[i].statement_dt + "-" + json[i].statement_ca + "</a></td>";
					tag += "<td class='center'>" + json[i].invoiceType + "</td>";
					tag += "<td class='center'>" + json[i].fac_nm + "</td>";
					tag += "<td class='center'>" + json[i].asset_ac_nm + "</td>";
					tag += "<td class='center'>" + commaSplit(json[i].qty) + "</td>";
					tag += "<td class='text-right'>" + commaSplit(json[i].cost) + "</td>";
					tag += "<td class='text-right'>" + commaSplit(json[i].disposal_price) + "</td>";
					tag += "<td class='center'>" + json[i].remark + "</td>";

					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
					tag += "<td colspan=10 class='center'>등록된 고정자산전표가 없습니다.";
					tag += "</td>";
				tag += "</tr>";
			}

			$("#fixed_assets_statement_list tbody").html(tag);

			var table = "erp_fixed_assets_statement";
			if(account_gb == "" || account_gb == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			}

			if(search_choice == "fac_nm") {
				var where = $("#where").val(" where 1=1 and fac_nm like '%" + txt + "%' ");
			} else if(search_choice == "asset_ac_nm") {
				var where = $("#where").val(" where 1=1 and asset_ac_nm like '%" + txt + "%' ");
			}

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getAccount(page);
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
	if(confirm("선택하신 전표 정보를 삭제하시겠습니까? 다른 데이터와 연동된 전표 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_gid = $("#check_gids").val() + "," + $(this).val();
				$("#check_gids").val(new_gid);
			}
		});

		var dataString = "mode=deleteSelectFixedAssetsStatement&table=erp_fixed_assets_statement&gids=" + $("#check_gids").val();
		$.ajax({
			type : "post",
			url : "ajax/fixedasset.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getFixedAssetsStatement(1);
				}
			}
		});
	}
}

// 검색
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	if(search_choice == "fac_nm") {
		$("#where").val(" where 1=1 and fac_nm like '%" + txt + "%' ");
	} else if(search_choice == "asset_ac_nm") {
		$("#where").val(" where 1=1 and asset_ac_nm like '%" + txt + "%' ");
	}
	getFixedAssetsStatement(1);
}

// 거래처 구분으로 거래처 리스트 가져오기
function setAccount(val) {
	$("#page").val(1);
	$("#account_gb").val(val);
	getAccount(1);
}
</script>
<script language="javascript" type="text/javascript">  
<!--  
function openWinPrint(id){  
    window.open("/views/accounting/doc_form/print/statement_print.php?id="+id, "전표인쇄", "width=800, height=700, toolbar=no, menubar=no, scrollbars=yes, resizable=yes" );  
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
	function fixedAssetsStatement_reg(cidx, acd)
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
	var url = "index.php?controller=accounting&action=registFixedAssetsStatementPop&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogid=id-btn-dialog1";
	$("#fixedAssetsStatement_reg_frame").attr("src", url);
	}

	function fixedAssetsStatement_modiy(uid, dt, ca)
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

	var url = "index.php?controller=accounting&action=modifyFixedAssetsStatementPop&uid="+uid+"&pop=Y&statement_dt="+dt+"&statement_ca="+ca+"&dialogid=id-btn-dialog2";
	$("#fixedAssetsStatement_modify_frame").attr("src", url);
	}

	function close_popup()
	{	
		$.modal.close();
		$("#fixedAssetsStatement_reg_frame").attr("src", "about:blank");
	}

	window.closeModal = function(obj) {
	$("#"+obj).modal( 'hide' );
	}
//-->
</script>