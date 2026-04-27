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
					<a href="#">금형관리</a>
				</li>
				<li class="active">금형점검·수리이력</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					금형점검·수리이력
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						금형점검·수리이력에 대한 리스트를 보여드립니다.
					</small>
				</h1>
			</div>
			<div class="space-6"></div>
			<!--// 서브제목과 라인 -->
			<div class="row">
				<div class="col-xs-12">
					<div class="widget-header">
						<div class="col-xs-6" style="float:left">
							<select id="per" onchange="getMoldList(1)">
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
						<div class="col-xs-6" style="float:right">
							<div class="col-xs-6"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="금형명&금형코드" name="search_txt" id="search_txt" />
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
				</div>
			</div>


			<div class="widget-header widget-header-flat">
				<h4 class="widget-title smaller">
					<i class="ace-icon fa fa-bars smaller-90"></i>
					금형리스트
				</h4>
			</div>
			<div class="row">
				<div class="col-xs-12">	
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="mold_list" class="table table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr>
										<th class="detail-col center" style="width:2%">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>
										<th class="" style="width:7%"><i class="ace-icon fa fa-caret-right blue"></i> 금형코드</th>
										<th class="" style="width:7%"><i class="ace-icon fa fa-caret-right blue"></i> 금형명</th>
										<th class="" style="width:7%"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
										<th class="" style="width:7%"><i class="ace-icon fa fa-caret-right blue"></i> 모델</th>
										<th class="" style="width:7%"><i class="ace-icon fa fa-caret-right blue"></i> 금형그룹</th>
										<th class="" style="width:7%"><i class="ace-icon fa fa-caret-right blue"></i> 금형위치</th>
										<th class="" style="width:10%" nowrap><i class="ace-icon fa fa-caret-right blue"></i> 유효타수</th>
										<th class="" style="width:10%" nowrap><i class="ace-icon fa fa-caret-right blue"></i> 실적누적타수</th>
										<th class="" style="width:10%" nowrap><i class="ace-icon fa fa-caret-right blue"></i> 유효타수(잔량)</th>
										<th class="" style="width:5%"><i class="ace-icon fa fa-caret-right blue"></i> 사용률%</th>
										<th class="" style="width:7%"><i class="ace-icon fa fa-caret-right blue"></i> 금형유형</th>
										<th class="" style="width:7%"><i class="ace-icon fa fa-caret-right blue"></i> 금형등급</th>
										<th class="" style="width:7%"><i class="ace-icon fa fa-caret-right blue"></i> 금형상태</th>
									</tr>
								</thead>
								<tbody></tbody>
								<tfoot style="background-color: #eeeeee;">
									<tr>
										<th class="col-xs-6 text-center" colspan="7" >합계</th>
										<th style="col-xs-12 text-right" class="text-right">0</th>
										<th class="text-right">0</th>
										<th class="text-right">0</th>
										<th class="text-right">0</th>
										<th align="right"  colspan="3"></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-12">	
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="mold" />
						<input type="hidden" name="action" id="action" value="insertPageMold" />
						<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />
						<input type="hidden" name="uid" id="uid" value="" />
						<div class="space-6"></div>
						<div class="widget-header widget-header-flat" style="border-top:1px #ddd solid;">
							<div class="form-inline">
								<div class="form-group">
									<h4 class="widget-title smaller">
										<i class="ace-icon fa fa-pencil-square-o smaller-90"></i>
										수리이력
									</h4>
								</div>
								<div class="form-group pull-right" style="padding: 5px 5px 5px 5px">	
									<button class="btn btn-info btn-xs" type="button" onclick="mold_repair_reg('0','0');">
										<i class="ace-icon fa fa-check"></i>
										신규 등록
									</button>
									<? if($_SESSION['login_level'] >= 99) { ?>
									<button class="btn btn-danger btn-xs" type="button" onclick="deleteSelect()">
										<i class="ace-icon fa fa-undo"></i>
										선택삭제
									</button>
									<?}?>
								</div>
							</div>
						</div>
						<div class="space-6"></div>
						<div class="row">
							<div class="col-xs-12">
								<div class="tab-content">
									<div id="items" class="tab-pane fade in active">
										<div class="widget-body">
											<div class="widget-main no-padding">
												<table id="mold_repair_list" class="table  table-bordered table-hover" style="margin-top:10px">
													<thead class="thin-border-bottom">
														<tr>
															<th class="detail-col center" style="width:2%">
																<label class="pos-rel">
																	<input type="checkbox" class="ace" id="checkedAll" />
																	<span class="lbl"></span>
																</label>
															</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1" nowrap>수리번호</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1">시작일자</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1">종료일자</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1">수리유형</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1;">수리구분</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1;">수리내용</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1">공장</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1">공정</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1">거래처</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1">수리담당자</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1">상태</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1">수정</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td colspan='13' class='center'>등록된 금형 타수 상세 내역이 없습니다.</td>
														</tr>
													</tbody>
													<tfoot style="background-color: #eeeeee;">
														<tr>
															<th class="col-xs-10 text-center" colspan="11">합계</th>
															<th class="text-right">0</th>
															<th class=""></th>
														</tr>
													</tfoot>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</form>
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-12">	
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="mold" />
						<input type="hidden" name="action" id="action" value="insertPageMold" />
						<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />
						<input type="hidden" name="uid" id="uid" value="" />
						<div class="space-6"></div>
						<div class="widget-header widget-header-flat" style="border-top:1px #ddd solid;">
							<h4 class="widget-title smaller">
								<i class="ace-icon fa fa-pencil-square-o smaller-90"></i>
								수리품목
							</h4>
						</div>
						<div class="space-6"></div>
						<div class="row">
							<div class="col-xs-12">
								<div class="tab-content">
									<div id="items" class="tab-pane fade in active">
										<div class="widget-body">
											<div class="widget-main no-padding">
												<table id="mold_repair_item_list" class="table  table-bordered table-hover" style="margin-top:10px">
													<thead class="thin-border-bottom">
														<tr>
															<th class="detail-col center" style="width:2%">
																<label class="pos-rel">
																	<input type="checkbox" class="ace" id="checkedAll" />
																	<span class="lbl"></span>
																</label>
															</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1">품목코드</th>
															<th class="center col-xs-3" style="background-color:#f1f1f1">품목명</th>
															<th class="center col-xs-2" style="background-color:#f1f1f1">규격</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1">단위</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1;">재질</th>
															<th class="center col-xs-1" style="background-color:#f1f1f1">수리수량</th>
															<th class="center col-xs-3" style="background-color:#f1f1f1">비고</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td colspan='14' class='center'>등록된 금형 타수 상세 내역이 없습니다.</td>
														</tr>
													</tbody>
													<tfoot style="background-color: #eeeeee;">
														<tr>
															<th class="col-xs-6 text-center" colspan="6">합계</th>
															<th class="text-right"><span class="cntTotal"></span></th>
															<th class=""></th>
														</tr>
													</tfoot>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						<div class="space-6"></div>
					</form>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-xs-12">
					<div class="clearfix form-actions" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
							<div class="col-xs-6 right" style="text-align:right">
								<button class="btn btn-info" type="button" onclick="formSubmit()">
									<i class="ace-icon fa fa-check"></i>
									<span id="text2">저장</span>
								</button>
								<? if($_SESSION['login_level'] >= 99) { ?>
								<button class="btn btn-danger" type="button" onclick="deleteSelect()">
									<i class="ace-icon fa fa-undo"></i>
									선택삭제
								</button>
								<?}?>
								<button class="btn " type="button" onclick="excelSelect()">
									<i class="ace-icon fa fa-undo"></i>
									excle
								</button>
							</div>
						</div>
					</div>
				</div>
			</div> -->
		</div>
	</div>
</div>

<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="check_uids" id="check_uids" />

<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">금형수리내역등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="product_output_reg_frame" frameborder="0" width="99%" height="550" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
                 <h4 class="modal-title">금형점검·수리이력 수정</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="mold_reqpir_modify_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">생산실적처리인쇄</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="product_output_print_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
<div id="id-btn-dialog4" class="modal fade" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title"></h4>

            </div>
            <div class="modal-body">
				<iframe name="mold_frame" id="mold_frame" src="" frameborder="0" width="99%" height="100%" marginwidth="0" marginheight="0" scrolling="yes"></iframe>
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

<div id="id-btn-dialog5" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">실적처리관리</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="product_perf_report_view_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	var page = $("#page").val();
	getMoldList(page);
	createMoldCode();
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
function search() {
	var txt = $("#search_txt").val();
	$("#where").val(" where mold_nm like '%" + txt + "%' or mold_cd like '%" + txt + "%'");
	getMoldList(1);
}



// 금형코드 자동생성
function createMoldCode(){
	
	var data_string = "mode=createMoldCode";

	$.ajax({
		type : "post",
		url : "../../ajax/mold.php",
		data : data_string,
		success : function(str) {
			$("#mold_cd").val(str);
		}
	});	
}

//콤마찍기
function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}
 
//콤마풀기
function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}
 
//값 입력시 콤마찍기
function inputNumberFormat(obj) {
    obj.value = comma(uncomma(obj.value));
}
/* 숫자만 입력받기 */
function fn_press(event, type) {
	if(type == "numbers") {
		if(event.keyCode < 48 || event.keyCode > 57) return false;
		//onKeyDown일 경우 좌, 우, tab, backspace, delete키 허용 정의 필요
	}
}
/* 한글입력 방지 */
function fn_press_han(obj)
{
	//좌우 방향키, 백스페이스, 딜리트, 탭키에 대한 예외
	if(event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39
	|| event.keyCode == 46 ) return;
	obj.value = obj.value.replace(/[\a-zA-Zㄱ-ㅎㅏ-ㅣ가-힣]/g, '');
}

function centerOpenWindow(theURL, winName, width, height, fstate, scrollbars){ 
	var features = " width=" + width ; 
	features += ", height=" + height ; 
	var state = ""; 
	var scrollbars = "yes"; 
	var res_w = ( $(window).width() - width ) / 2; 
	var res_h = ( $(window).height() - height ) / 2; 
	if ( window.screenLeft >= window.screen.width ) { 
		res_w = window.screen.width + res_w; 
	} 
	if (fstate == "") { // 옵션 
		state = features + ", left=" + res_w + ", top=" + res_h + ", scrollbars=yes";
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ", top=" + res_h + ", scrollbars=yes";
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 

// 금형 리스트 가져오기
function getMoldList(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/mold.php",{"page":page, "mode":"getMoldHitList", "rpp" : rpp, "adjacents" : adjacents, "where" : where},
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
					tag += "<td><a href='javascript:void(0);'  onclick=\"getMoldRepairList('" + json[i].mold_cd +"')\" >" + json[i].mold_cd + "</a></td>";
					tag += "<td>" + json[i].mold_nm + "</a></td>";
					tag += "<td>" + json[i].m_unit + "</a></td>";
					tag += "<td>" + json[i].m_model + "</a></td>";
					tag += "<td>" + json[i].mold_group_nm + "</a></td>";
					tag += "<td>" + json[i].mold_location_nm + "</a></td>";
					tag += "<td class='text-right'>" + json[i].valid_hit_count + "</a></td>";
					tag += "<td class='text-right'>" + json[i].valid_hit_be_count + "</a></td>";

					if(Number(removeComma(json[i].valid_hit_rest_count)) < 0){
						var valid_hit_rest_count_css = "style='color:red'"; 
						var valid_hit_rate_css = "style='color:red'";
						var valid_hit_rest_count2 = 0; //추가 2018.10.15

					}else{
						var valid_hit_rest_count_css = ""
						var valid_hit_rate_css = ""; 
						var valid_hit_rest_count2 = json[i].valid_hit_rest_count; //추가 2018.10.15
					}

					//금형 유효타수 잔량
					tag += "<td class='text-right valid_hit_rest_count' "+valid_hit_rest_count_css+" id='valid_hit_rest_count'>" + valid_hit_rest_count2 + "</td>"; //수정 2018.10.15

					tag += "<td class='text-right valid_hit_rate' "+valid_hit_rate_css+" id='valid_hit_rate'>" + json[i].valid_hit_rate + "</td>";

					tag += "<td>" + json[i].mold_type_nm + "</a></td>";
					tag += "<td>" + json[i].mold_class_nm + "</a></td>";
					tag += "<td>" + json[i].mold_state_nm + "</a></td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='12' class='center' style='height:20px'> 등록된 금형 데이터가 없습니다. </td>";
				tag += "</tr>";
			}

			$("#mold_list tbody").html(tag);

			var table = "erp_mold";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 금형 수리 상세정보 가져오기
function getMoldRepairList(mcode){

	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/mold.php",{"page":page, "mode":"getMoldRepairList", "rpp" : rpp, "adjacents" : adjacents, "where" : where, "mcode" : mcode},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr class='no-padding'>";
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					tag += "<td nowrap><a href='javascript:void(0);'  onclick='getMoldRepairItemList(" + json[i].uid +")' >" + json[i].mold_repair_cd + "</a></td>";
					tag += "<td nowrap>" + json[i].start_dt + "</td>";
					tag += "<td nowrap>" + json[i].end_dt + "</td>";
					tag += "<td class='center' nowrap>" + json[i].repair_type + "</td>";
					tag += "<td class='center' nowrap>" + json[i].repair_gb + "</td>";
					tag += "<td nowrap>" + json[i].repair_content + "</td>";
					tag += "<td nowrap>" + json[i].warehouse_nm + "</td>";
					tag += "<td nowrap>" + json[i].process_nm + "</td>";
					tag += "<td nowrap>" + json[i].account_nm + "</td>";
					tag += "<td class='center' nowrap>" + json[i].emp_nm+ "</td>";
					tag += "<td class='center'>" + json[i].state+ "</td>";
					tag += "<td class='center row-no-padding' ><a href='javascript:void(0);' class='btn btn-link btn-xs' onclick='moldRepairItem_modify(" + json[i].uid +")'><i class='ace-icon fa fa-pencil-square-o bigger-150'></i></a></td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='14' class='center' style='height:20px'> 등록된 금형 타수 상세 내역이 없습니다.</td>";
				tag += "</tr>";
			}

			$("#mold_repair_list tbody").html(tag);

			var table = "erp_mold_repair";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 금형 수리 부품정보 가져오기
function getMoldRepairItemList(uid){

	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/mold.php",{"page":page, "mode":"getMoldRepairItemList", "rpp" : rpp, "adjacents" : adjacents, "where" : where, "uid" : uid},
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
					tag += "<td><a href='javascript:void(0);'  onclick='product_p_reports_modiy(" + json[i].uid +")' >" + json[i].item_cd + "</a></td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					tag += "<td>" + json[i].material + "</td>";
					tag += "<td class='text-right'>" + json[i].cnt + "</td>";
					tag += "<td>" + json[i].remark + "</td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='9' class='center' style='height:20px'> 등록된 금형 타수 상세 내역이 없습니다.</td>";
				tag += "</tr>";
			}
			$(".cntTotal").html(0);
			$("#mold_repair_item_list tbody").html(tag);

			var table = "erp_mold_repair_item";
			getPaging(table,where,rpp,adjacents);
		}
	);
}


// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getMoldList(page);
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

function calculationTotal(flag) {
	var cntTotal = 0;
	$("input[name='cnt[]']").each(function () {
		var cnt = removeComma(this.value);
		if ($("input[name='cnt[]']").length > 0 && !isNaN(cnt)){
			 cntTotal += Number(removeComma(this.value));
		}
	});

		$(".cntTotal").html(Num2Money(cntTotal));
}

function removeComma(n) {  // 콤마제거
	if ( typeof n == "undefined" || n == null || n == "" ) {
		return "";
	}
	var txtNumber = '' + n;
	return txtNumber.replace(/(,)/g, "");
}

// 선택 삭제
function deleteSelect(){
	if(confirm("선택하신 금형데이터를 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectMold&table=erp_mold&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/mold.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAll").prop('checked',false);
					getMoldList(1);
				}
			}
		});
	}
}

function formSubmit(){
	    var f  = frm;
        var $f = jQuery(f);
        var $b = jQuery(this);
        var $t, t;
        var result = true;
		var updatePageMold	= $("#action").val();
		var uid				= $("#uid").val();

        $f.find("input, select, textarea").each(function(i) {
            $t = jQuery(this);

            if($t.prop("required")) {
                if(!jQuery.trim($t.val())) {
                    t = jQuery("label[for='"+$t.attr("id")+"']").text();
                    result = false;
                    $t.focus();
                    //alert(t+" 필수 입력입니다.");
					alert(t);
                    return false;
                }
            }
        });
		//alert(result)
        if(!result){
            return false;
		}else{
			if (uid!="" && updatePageMold=="updatePageMold")
			{
			var result = confirm('금형 데이터를 수정하시겠습니까?'); 
				if(result) { 
					$("#frm").submit(); 
				} else {
					return false;
				}
			}else{
				$("#frm").submit();
			}
		}

}


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
			todayHighlight: true,
			language: "kr"
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
	function mold_repair_reg(cidx, acd)
	{
	$("#id-btn-dialog1").modal({
		show: true,
		title : "금형수리내역등록",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=mold&action=registPageMoldRepair&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogID=id-btn-dialog1";
	$("#product_output_reg_frame").attr("src", url);
	}
			
	function moldRepairItem_modify(uid)
	{
	$("#id-btn-dialog2").modal({
		show: true,
		title : "금형점검·수리이력 수정",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	
	//$(".modal-title").html(tt);
	var url = "index.php?controller=mold&action=modifyPageMoldRepair&pop=Y&uid="+uid+"&dialogID=id-btn-dialog2";
	$("#mold_reqpir_modify_frame").attr("src", url);
	}

	function product_p_reports_modiy(uid)
	{
	$("#id-btn-dialog5").modal({
		show: true,
		title : "실적처리관리",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	
	var url = "index.php?controller=production&action=viewPageproductPerfReports&pop=Y&uid="+uid+"&dialogID=id-btn-dialog5";
	$("#product_perf_report_view_frame").attr("src", url);
	}
	
	function moldPopup(src)
	{
	$("#id-btn-dialog4").modal({
		show: true,
		title : "생산설비가동",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	
	$('.modal-dialog').draggable();
	
	if (src=="1"){
		var src_url="views/popup/warehouseListPutAny.php?";
		$(".modal-title").html('공장검색');
		$('.modal-dialog').css({ height:"400px", width:"500px" }).show();
		var height="400px";
	}else if (src=="2"){
		var src_url="views/popup/processListPutAny.php?";
		$(".modal-title").html('공정검색');
		$('.modal-dialog').css({ height:"400px", width:"400px" }).show();
		var height="400px";
	}else if (src=="3"){
		var src_url="views/popup/warehouseListPutAny.php?cd=workings_cd&nm=workings_nm";
		$(".modal-title").html('작업장검색');
		$('.modal-dialog').css({ height:"400px", width:"400px" }).show();
		var height="400px";
	}else if (src=="4"){
			var src_url="views/popup/machineListPutAny.php?";
		$(".modal-title").html('설비검색');
		$('.modal-dialog').css({ height:"400px", width:"800px" }).show();
		var height="400px";
	}else if (src=="5"){
			var src_url="views/popup/departmentListPut.php?";
		$(".modal-title").html('부서검색');
		$('.modal-dialog').css({ height:"400px", width:"400px" }).show();
		var height="400px";
	}else if (src=="6"){
			var src_url="views/popup/employeeListPutAny.php?";
		$(".modal-title").html('사원검색');
		$('.modal-dialog').css({ height:"400px", width:"700px" }).show();
		var height="400px";
	}else if (src=="7"){
			var src_url="views/popup/employeeListPutAny.php?cd=manager_cd&nm=manager_nm";
		$(".modal-title").html('담당자검색');
		$('.modal-dialog').css({ height:"400px", width:"700px" }).show();
		var height="400px";
	}else if (src=="8"){
			var src_url="views/popup/moldGroupList.php?";
		$(".modal-title").html('금형그룹검색');
		$('.modal-dialog').css({ height:"400px", width:"500px" }).show();
		var height="400px";
	}else if (src=="9"){
			var src_url="views/popup/createMoldGroup.php?";
		$(".modal-title").html('금형그룹등록');
		$('.modal-dialog').css({ height:"230px", width:"500px" }).show();
		var height="230px";
	}else if (src=="10"){
			var src_url="views/popup/moldLocationList.php?";
		$(".modal-title").html('금형위치검색');
		$('.modal-dialog').css({ height:"500px", width:"500px" }).show();
		var height="500px";
	}else if (src=="11"){
			var src_url="views/popup/createMoldLocation.php?";
		$(".modal-title").html('금형위치등록');
		$('.modal-dialog').css({ height:"230px", width:"500px" }).show();
		var height="200px";
	}else if (src=="12"){
			var src_url="views/popup/moldTypeList.php?";
		$(".modal-title").html('금형유형검색');
		$('.modal-dialog').css({ height:"500px", width:"500px" }).show();
		var height="500px";
	}else if (src=="13"){
			var src_url="views/popup/createMoldType.php?";
		$(".modal-title").html('금형유형등록');
		$('.modal-dialog').css({ height:"230px", width:"500px" }).show();
		var height="200px";
	}else if (src=="14"){
			var src_url="views/popup/moldDivideList.php?";
		$(".modal-title").html('금형구분검색');
		$('.modal-dialog').css({ height:"200px", width:"500px" }).show();
		var height="500px";
	}else if (src=="15"){
			var src_url="views/popup/createMoldDivide.php?";
		$(".modal-title").html('금형구분등록');
		$('.modal-dialog').css({ height:"200px", width:"500px" }).show();
		var height="200px";
	}else if (src=="16"){
			var src_url="views/popup/moldClassList.php?";
		$(".modal-title").html('금형등급검색');
		$('.modal-dialog').css({ height:"500px", width:"500px" }).show();
		var height="500px";
	}else if (src=="17"){
			var src_url="views/popup/createMoldClass.php?";
		$(".modal-title").html('금형등급등록');
		$('.modal-dialog').css({ height:"200px", width:"500px" }).show();
		var height="200px";
	}else if (src=="18"){
			var src_url="views/popup/moldStateList.php?";
		$(".modal-title").html('금형상태검색');
		$('.modal-dialog').css({ height:"500px", width:"500px" }).show();
		var height="500px";
	}else if (src=="19"){
			var src_url="views/popup/createMoldState.php?";
		$(".modal-title").html('금형상태등록');
		$('.modal-dialog').css({ height:"200px", width:"500px" }).show();
		var height="200px";
	}else if (src=="20"){  
			var src_url="views/popup/contractAccountList.php?";
		$(".modal-title").html('계약거래처');
		$('.modal-dialog').css({ height:"500px", width:"500px" }).show();
		var height="500px";
	}else if (src=="21"){
			var src_url="views/popup/productAccountList.php?";
		$(".modal-title").html('제작거래처');
		$('.modal-dialog').css({ height:"500px", width:"500px" }).show();
		var height="500px";	
	}else if (src=="22"){
			var src_url="views/popup/ownerAccountList.php?";
		$(".modal-title").html('소유거래처');
		$('.modal-dialog').css({ height:"200px", width:"500px" }).show();
		var height="500px";	
	}else{
		$('.modal-dialog').css({ height:"200px", width:"500px" }).show();
	}
	
	var url = src_url+"&pop=Y&dialogID=id-btn-dialog4";
	
	$("#mold_frame").attr("src", url).attr('height', height);
	}

	function facilityManagement_print(uid)
	{
	$("#id-btn-dialog3").modal({
		show: true,
		title : "실적처리인쇄",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	
	var url = "index.php?controller=production&action=facilityManagementPrint&pop=Y&uid="+uid+"&dialogID=id-btn-dialog3";
	$("#product_output_print_frame").attr("src", url);
	}

	function close_popup()
	{	
		$.modal.close();
		$("#product_output_reg_frame").attr("src", "about:blank");
	}
	function closePopup()
	{
		window.parent.closeModal('<?=$dialogID?>');
		window.parent.location.reload();
	}
	window.closeModal = function(obj) {
		$("#"+obj).modal( 'hide' );
	}

//-->
</script>
<script language="javascript" type="text/javascript">  
<!--  
function openWin(uid){  
	window.open("views/production/printFacilityManagement.php?uid="+uid, "실적처리", "width=1024px, height=900, toolbar=no, menubar=no, scrollbars=yes, resizable=no" ); 
}  
//-->  
</script>  
  
<script language="javascript" type="text/javascript">  
<!--  
function openWinPrint(uid){  
    window.open("/views/accounting/doc_form/print/product_output_print.php?uid="+uid, "전표인쇄", "width=800, height=700, toolbar=no, menubar=no, scrollbars=yes, resizable=yes" );  
}  
//-->  
</script> 