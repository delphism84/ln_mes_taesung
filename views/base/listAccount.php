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
				<li class="active">거래처 리스트</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					거래처 리스트
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 거래처 리스트를 보여드립니다.
					</small>
					<a href="#" class="btn btn-xs btn-app radius-4">
						<i class="ace-icon fa fa-cog"></i>
					</a>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div>
						<div>
							<div class="widget-header">
								<div class="col-xs-3" style="float:left">
									<select id="per" onchange="getAccount(1)">
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
									<select class="" onchange="setAccount(this.value)">
										<option value="all">전체</option>
										<option value="매출">매출거래처</option>
										<option value="매입">매입거래처</option>
									</select>
								</div>

								<div class="col-xs-6" style="float:right">
									<div class="col-xs-4"  style="float:right">
										<div class="input-group">						
											<input type="text" class="form-control search-query" placeholder="거래처명" name="search_txt" id="search_txt" />
											<span class="input-group-btn">
												<button type="button" class="btn btn-purple btn-sm" onclick="search()">
													<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
													Search
												</button>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="widget-body">
								<div class="widget-main no-padding">
									<table id="account_list" class="table table-bordered table-striped">
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
												<th><i class="ace-icon fa fa-caret-right blue"></i> 구분</th>
												<th><i class="ace-icon fa fa-caret-right blue"></i> 거래처명</th>
												<th><i class="ace-icon fa fa-caret-right blue"></i> 거래처코드</th>
												<th><i class="ace-icon fa fa-caret-right blue"></i> 대표자</th>
												<th><i class="ace-icon fa fa-caret-right blue"></i> 회사전화</th>
												<th><i class="ace-icon fa fa-caret-right blue"></i> 회사팩스</th>
												<th><i class="ace-icon fa fa-caret-right blue"></i> 이메일</th>
												<th><i class="ace-icon fa fa-caret-right blue"></i> 등록일</th>
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
										<button class="btn btn-info" type="button" onclick="location.href = 'index.php?controller=base&action=inputPageAccount' ">
											<i class="ace-icon fa fa-check"></i>
											거래처등록
										</button>
										<? if($_SESSION['login_level'] >= 99) { ?>
										<button class="btn btn-danger" type="button" onclick="deleteSelect()">
											<i class="ace-icon fa fa-undo"></i>
											선택삭제
										</button>
										<?}?>
									</div>
								</div>
							</div>
						</div>
					</div>
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>


<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="where" id="where" value=" where 1=1" />
<input type="hidden" name="check_uids" id="check_uids" />

<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	var page = $("#page").val();
	getAccount(page);

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

// 검색
function search(){
	var txt = $("#search_txt").val();
	$("#where").val(" where account_nm like '%" + txt + "%' ");
	getAccount(1);
}

// 거래처 구분으로 거래처 리스트 가져오기
function setAccount(val) {
	$("#page").val(1);
	if(val == "all") {
		$("#where").val("");
	} else {
		$("#where").val(" where account_gb='" + val + "'");
	}
	getAccount(1);
}

// 거래처 리스트 가져오기
function getAccount(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/base.php",{"page":page, "mode":"getAccount", "rpp" : rpp, "adjacents" : adjacents, "where": where},
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
					tag += "<td>" + json[i].account_gb + "</td>";
					tag += "<td><a href='index.php?controller=base&action=modifyPageAccount&uid=" + json[i].uid + "'>" + json[i].account_nm + "</a></td>";
					tag += "<td>" + json[i].account_cd + "</td>";
					tag += "<td>" + json[i].owner + "</td>";
					tag += "<td>" + json[i].corp_phone + "</td>";
					tag += "<td>" + json[i].corp_fax + "</td>";
					tag += "<td>" + json[i].corp_email + "</td>";
					tag += "<td>" + json[i].create_dt + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_list tbody").html(tag);

			var table = "erp_account";
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
	if(confirm("선택하신 거래처 정보를 삭제하시겠습니까? 다른 데이터와 연동된 거래처 정보는 삭제되지 않습니다.")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectAccount&table=erp_account&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/account.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getAccount(1);
				}
			}
		});
	}
}
</script>

<script type="text/javascript">
	jQuery(function($) {		
		$.mask.definitions['~']='[+-]';
		$('.input-mask-date').mask('99/99/9999');
		$('.input-mask-phone').mask('(999) 999-9999');
		$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
		$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})

		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
			
		$('.input-daterange').datepicker({autoclose:true});
			
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
		
		$('#modal-form input[type=file]').ace_file_input({
			style:'well',
			btn_choose:'Drop files here or click to choose',
			btn_change:null,
			no_icon:'ace-icon fa fa-cloud-upload',
			droppable:true,
			thumbnail:'large'
		})
				
		$('#modal-form').on('shown.bs.modal', function () {
			if(!ace.vars['touch']) {
				$(this).find('.chosen-container').each(function(){
					$(this).find('a:first-child').css('width' , '210px');
					$(this).find('.chosen-drop').css('width' , '210px');
					$(this).find('.chosen-search input').css('width' , '200px');
				});
			}
		})
				
		$(document).one('ajaxloadstart.page', function(e) {
			autosize.destroy('textarea[class*=autosize]')		
			$('.limiterBox,.autosizejs').remove();
			$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
		});	
	});
</script>