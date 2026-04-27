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
					<a href="#">기준정보관리</a>
				</li>
				<li class="active">불량유형관리</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1><?=$action_txt?></h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div>
						<input type="hidden" name="uid" id="uid" />
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">검사유형</th>
								<td class="col-xs-2"><input type='radio' name='type' id='type' value="1" checked> 수입검사 <input type='radio' name='type' id='type' value='2'> 공정검사 <input type='radio' name='type' id='type' value='3'> 출하검사</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량유형코드</th>
								<td class="col-xs-2"><input type="text" name="defect_cd" id="defect_cd" style="width:80%" /> 
								<th class="col-xs-1" style="background-color:#f1f1f1">불량유형명</th>
								<td class="col-xs-4"><input type="text" name="defect_nm" id="defect_nm" style="width:80%" /> 
								<button class="btn btn-xs btn-inverse" type="button" onclick="registDefectReason()">
									<i class="ace-icon fa fa-check"></i>
									<span class='save'>생성</span>
								</button>
								<!-- <input type="button" class="btn btn-xs btn-inverse" value="생성 및 수정" onclick="registDefectReason()" /> -->
								</td>
							</tr>
						</table>
					</div>
					<div>
						<div class="widget-main no-padding">
							<table id="defect_list" class="table table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr>
										<? if($_SESSION['login_level'] >= 99) { ?>
										<th class="detail-col center">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>
										<?}?>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 검사유형</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 불량유형코드</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 불량유형명</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<? if($_SESSION['login_level'] >= 99) { ?>
					<div class="clearfix form-actions center" style="margin-top:0px">
						<div class="col-md-12 center">
							<button class="btn btn-danger" type="button" onclick="deleteSelect()">
								<i class="ace-icon fa fa-undo"></i> 선택삭제
							</button>
						</div>
					</div>
					<?}?>
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>


<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="check_uids" id="check_uids" />

<?
require_once ("assets/include_script.php");
?>

<script>
$(document).keypress(function(e) {
	if(e.which === 13) registDefectReason();
});

$(document).ready(function(){
	var page = $("#page").val();
	<? if($_SESSION['auto_code'] == "y") { ?>createDefectCode(); <?}?>
	createDefectCode();
	getDefectReason(page);

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

// 사원 코드 자동생성
function createDefectCode() {
	var data_string = "mode=createDefectCode";
	$.ajax({
		type : "post",
		url : "ajax/base.php",
		data : data_string,
		success : function(str) {
			
			$("#defect_cd").val(str);
		}
	});
}

// 불량유형 리스트 가져오기
function getDefectReason(page){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = page;

	$.getJSON("ajax/base.php",{"page":page, "mode":"getDefectReason", "rpp" : rpp, "adjacents" : adjacents},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					tag += "<td>" + json[i].type_text + "</td>";
					tag += "<td><a href='#' onclick=\"postReason(" + json[i].uid + ",'" + json[i].type + "','" + json[i].defect_nm + "')\">" + json[i].defect_cd + "</a></td>";
					tag += "<td><a href='#' onclick=\"postReason(" + json[i].uid + ",'" + json[i].type + "','" + json[i].defect_nm + "')\">" + json[i].defect_nm + "</a></td>";
					tag += "</tr>";
				}
			}
			tag += "<tr><td colspan='3'></td></tr>";
			$("#defect_list tbody").html(tag);
		}
	);
}


// 선택 삭제
function deleteSelect(){
	if(confirm("선택하신 불량유형 정보를 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		console.log($('#check_uids').val());

		var parameter = {"mode" : "deleteSelect", "table" : "erp_defect_reason", "uids" : $("#check_uids").val()};
		$.ajax({
			type : "post",
			url : "ajax.php",
			data : parameter,
			async : false,
			success : function(){
				$("#checkedAll").prop('checked',false);
				getDefectReason();
			}
		});
	}
}

function postReason(uid, type, reason) {
	$("#uid").val(uid);
	$("input:radio[name='type']:radio[value='"+type+"']").prop("checked", true); // 선택하기
	$("#reason").val(reason);
	$(".save").text('수정');
}

function registDefectReason(){
	if(!check_str($("#defect_nm").val(),"불량유형")) return false;
	//var type = $("#type option:selected").val();
	var type = $("input[type=radio][name=type]:checked").val()

	var parameter = {"mode" : "registDefectReason", "uid" : $("#uid").val(), "type" : type, "reason" : $("#reason").val(), "defect_cd" : $("#defect_cd").val(), "defect_nm" : $("#defect_nm").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax/base.php",
		success : function(str) {
			if(str.trim() == "success") {
				getDefectReason();
				$("#reason").val("");
			} else alert(str);
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