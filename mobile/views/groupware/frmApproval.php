<?
require_once("library/caseby.php");
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
					<a href="#"><?=$controller_txt?></a>
				</li>
				<li class="active"><?=$action_txt?></li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1><?=$action_txt?></h1>
			</div>
			<!--// 서브제목과 라인 -->			
			<div class="col-xs-12">
				<div class="widget-body">
					<div class="widget-main no-padding" >
						<ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab" style="padding:0; border:none;">
							<li class="active">
								<a data-toggle="tab" href="#faq-tab-1" onclick="change('a')">
									<i class="blue ace-icon fa fa-question-circle bigger-120"></i>
									결재대기문서
								</a>
							</li>
							<li class="">
								<a data-toggle="tab" href="#faq-tab-2" onclick="change('b')">
									<i class="blue ace-icon fa fa-question-circle bigger-120"></i>
									결재진행문서
								</a>
							</li>
							<li class="">
								<a data-toggle="tab" href="#faq-tab-3" onclick="change('c')">
									<i class="blue ace-icon fa fa-question-circle bigger-120"></i>
									결재종결문서
								</a>
							</li>
							<li class="">
								<a data-toggle="tab" href="#faq-tab-4" onclick="change('d')">
									<i class="blue ace-icon fa fa-question-circle bigger-120"></i>
									결재반려문서
								</a>
							</li>
							<li class="">
								<a data-toggle="tab" href="#faq-tab-5" onclick="change('e')">
									<i class="blue ace-icon fa fa-question-circle bigger-120"></i>
									결재보류문서
								</a>
							</li>
						</ul>
						
					
						<table id="tb" class="table  table-bordered table-striped" style="margin-top:10px;">
							<thead class="thin-border-bottom">
								<tr>
									<th class="detail-col center">
										<label class="pos-rel">
											<input type="checkbox" class="ace" id="checkedAll" />
											<span class="lbl"></span>
										</label>
									</th>
									<th><i class="ace-icon fa fa-caret-right blue"></i> 문서번호</th>
									<th><i class="ace-icon fa fa-caret-right blue"></i> 제목</th>
									<th><i class="ace-icon fa fa-caret-right blue"></i> 기안부서</th>
									<th><i class="ace-icon fa fa-caret-right blue"></i> 기안자</th>
									<th><i class="ace-icon fa fa-caret-right blue"></i> 기안일</th>
									<th><i class="ace-icon fa fa-caret-right blue"></i> 결재상태</th>
									<th><i class="ace-icon fa fa-caret-right blue"></i> 인쇄</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>

<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="per" id="per" value="10" />
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="state" id="state" value="a" />
<input type="hidden" name="check_uids" id="check_uids" />

<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	var page = $("#page").val();
	getApproval(page);

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

function change(value) {
	switch(value) {
		case "a" : $("#state").val("a"); break;
		case "b" : $("#state").val("b"); break;
		case "c" : $("#state").val("c"); break;
		case "d" : $("#state").val("d"); break;
		case "e" : $("#state").val("e"); break;
	}

	getApproval(1);
}

// 거래처 리스트 가져오기
function getApproval(page){

	var tag = "";
	var parameter = {"mode" : "getApprovalList", "page" : page, "rpp" : $("#per").val(), "where" : $("#where").val(), "state" : $("#state").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++) {
					if(json[i].state == "stay") var state = "대기중";
					else if(json[i].state == "ing") var state = "진행중";
					else if(json[i].state == "complete") var state = "결재완료";

					tag += "<tr>";
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					tag += "<td><a href='#' onclick='checkApproval(" + json[i].uid + ")'>" + json[i].approval_cd + "</a></td>";
					tag += "<td><a href='#' onclick='checkApproval(" + json[i].uid + ")'>" + json[i].title + "</a></td>";
					tag += "<td>" + json[i].middle_department + "-" + json[i].small_department + "</td>";
					tag += "<td>" + json[i].emp_nm + "</td>";
					tag += "<td>" + json[i].create_dt + "</td>";
					tag += "<td>" + state + "</td>";
					tag += "<td></td>";
					tag += "</tr>";
				}
			} else {
				tag += "<tr><td colspan='8' style='text-align:center; color:red'><br />데이터가 존재하지 않습니다<br /><br /></td></tr>";
			}
			
			tag += "<tr><td colspan='8'></td></tr>";

			$("#tb tbody").html(tag);

			var table = "erp_approval";
			getPaging(table, $("#where").val(), $("#per").val(), 4);
		}
	);
}

function checkApproval(uid) {
	var parameter = {"mode" : "checkApproval", "uid" : uid};
	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		success : function(str) {
			if(str == "impossible") {
				alert("해당 문서를 보실 자격이 없습니다");
				return false;
			} else if(str == "possible") {
				location.href = "index.php?controller=groupware&action=viewPageApproval&uid=" + uid;
			}
		}
	});
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getApproval(page);
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
</script>

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