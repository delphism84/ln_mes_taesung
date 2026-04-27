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
				<li class="active">품질관리(QC)</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					품질관리(QC)
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						품질검사 리스트를 보여드립니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="widget-header">
						<div class="col-xs-6" style="float:left">
							<select id="per" onchange="getQc(1)">
								<option value="10">10개씩 보기</option>
								<option value="15">15개씩 보기</option>
								<option value="20">20개씩 보기</option>
								<option value="25">25개씩 보기</option>
								<option value="30">30개씩 보기</option>
								<option value="35">35개씩 보기</option>
								<option value="40">40개씩 보기</option>
								<option value="45">45개씩 보기</option>
								<option value="50">50개씩 보기</option>
								<option value="all">전체 보기</option>
							</select>
						</div>
					</div>
					
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="qc_list" class="table  table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr>
										<? if($_SESSION['login_level'] >= 99) { ?>
										<th rowspan="2" class="detail-col center">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>
										<?}?>
										<th rowspan="2" class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 지시서코드</th>
										<!--<th rowspan="2" class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>-->
										<th rowspan="2" class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
										<th rowspan="2" class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
										<th rowspan="2" class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
										<th rowspan="2" class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
										<th rowspan="2" class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 입고창고</th>
										<th rowspan="2" class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 검사지시수량</th>
										<th colspan="4" class="col-xs-4"><i class="ace-icon fa fa-caret-right blue"></i> 검사</th>
									</tr>
									<tr>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 적격 수량</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 부적격 수량</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 불량사유</th>
										<th><i class="ace-icon fa fa-caret-right blue"></i> 등록</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<div class="clearfix form-actions center" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
							<div class="col-xs-6 right" style="text-align:right">
								<? if($_SESSION['login_level'] >= 99) { ?>
								<button class="btn btn-danger" type="button" onclick="deleteSelect()">
									<i class="ace-icon fa fa-undo"></i>
									선택삭제
								</button>
								<?}?>
							</div>
						</div>
					</div>
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>

<div id="dialog-message1" class="dialog-view hide">
	<table id="account_list" class="table  table-bordered table-hover">
		<tr>
			<th class="col-xs-2 center" style="background-color:#f1f1f1">수량</th>
			<td class="col-xs-5 center"><input type="text" id="cnt" name="cnt" /></td>
		</tr>
	</table>
</div><!-- #dialog-message -->

<input type="hidden" name="page" id="page" value="1" />
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />
<input type="hidden" name="uid" id="uid" />
<input type="hidden" name="where" id="where" value=" where state != 'complete'" />


<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function(){
	var page = $("#page").val();
	getQc(page);

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

// 거래처 리스트 가져오기
function getQc(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/production.php",{"page":page, "mode":"getQc", "rpp" : rpp, "adjacents" : adjacents, "where" : where},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
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
					tag += "<td><a href='index.php?controller=production&action=inputPageWork&uid=" + json[i].uid + "'>" + json[i].work_cd + "</a></td>";
					//tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].standard2 + "</td>";
					tag += "<td>" + json[i].standard3 + "</td>";
					tag += "<td>" + json[i].warehouse_nm + "</td>";
					tag += "<td style='text-align:right'>" + json[i].order_cnt + "</td>";
					tag += "<td style='text-align:right'><input type='text' id='pass_" + i + "' onkeyup='cal(" + i + "," + json[i].order_cnt + ")' /></td>";
					tag += "<td style='text-align:right'><input type='text' id='faulty_" + i + "' onkeyup='recal(" + i + "," + json[i].order_cnt + ")' /></td>";
					tag += "<td><select id='faulty_reason_" + i + "'><option value='0'>불량사유</option><option value='접촉불량'>접촉불량</option><option value='파손'>파손</option><option value='규격미달'>규격미달</option><option value='기타'>기타</option></select></td>";
					tag += "<td><input type='button' class='btn btn-xs' value='검사결과등록' onclick=\"setUid(" + i + "," + json[i].uid + "," + json[i].order_cnt + ",'" + json[i].warehouse_cd + "')\" /></td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='12' class='center' style='height:20px'> 등록된 품질관리 리스트가 없습니다. </td>";
				tag += "</tr>";
			}

			$("#qc_list tbody").html(tag);

			var table = "erp_qc";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

function setUid(i, uid, order_cnt, warehouse_cd) {
	var pass = $("#pass_" + i).val();
	var faulty_cnt = Number(order_cnt) - Number(pass);
	$("#faulty_" + i).val(faulty_cnt);
	var faulty = $("#faulty_" + i).val();
	var faulty_reason = $("#faulty_reason_" + i + " option:selected").val();

	if(Number(faulty) > 0) {
		if(faulty_reason == 0) {
			alert("불량사유를 선택하세요");
			return false;
		} else {
			var dataString = "mode=registWorkIn&uid=" + uid + "&order_cnt=" + order_cnt + "&pass=" + pass + "&faulty=" + faulty + "&faulty_reason=" + faulty_reason + "&warehouse_cd=" + warehouse_cd;
			$.ajax({
				type : "post",
				data : dataString,
				url : "ajax/production.php",
				success : function(str) {
					if(str == "success") getQc(1);
					else alert(str);
				}
			});
		}
	} else {
		var dataString = "mode=registWorkIn&uid=" + uid + "&order_cnt=" + order_cnt + "&pass=" + pass + "&faulty=" + faulty + "&faulty_reason=" + faulty_reason;
		$.ajax({
			type : "post",
			data : dataString,
			url : "ajax/production.php",
			success : function(str) {
				if(str == "success") getQc(1);
				else alert(str);
			}
		});
	}
}

function cal(i, order_cnt){
	var pass = $("#pass_" + i).val();
	var faulty_cnt = Number(order_cnt) - Number(pass);
	$("#faulty_" + i).val(faulty_cnt);
}

function recal(i, order_cnt){
	var faulty = $("#faulty_" + i).val();
	var pass_cnt = Number(order_cnt) - Number(faulty);
	$("#pass_" + i).val(pass_cnt);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getQc(page);
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
	if(confirm("선택하신 검사 정보를 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectQc&table=erp_estimate&uids=" + $("#check_uids").val();
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
					getQc(1);
				}
			}
		});
	}
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