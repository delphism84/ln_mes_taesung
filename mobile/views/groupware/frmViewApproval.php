<?
require_once("library/caseby.php");
$sql = "select * from approval where uid=".$_GET['uid'];
$this->query($sql);
$app = $this->fetch();

$sql = "select line_nm from approval_line where uid=".$app->approval_line;
$this->query($sql);
$line = $this->fetch();
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12" style="padding-top:10px">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm">						
                        <input type="hidden" name="mode" id="mode" value="registApproval" />
                        <input type="hidden" name="uid" id="uid" value="<?=$_GET['uid']?>" />
						<input type="hidden" name="big_uid" id="big_uid" value="<?=$_SESSION['big_department']?>" />
						<input type="hidden" name="middle_uid" id="middle_uid" value="<?=$_SESSION['middle_department']?>" />
						<input type="hidden" name="small_uid" id="small_uid" value="<?=$_SESSION['small_department']?>" />
						<textarea style="display:none" name="content" id="content"></textarea>

						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">문서번호</th>
								<td class="col-xs-5"><?=$app->approval_cd?></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">기안제목</th>
								<td class="col-xs-5"><?=$app->title?></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">결재자</th>
								<td class="col-xs-5"><?=$line->line_nm?></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">참조자</th>
								<td class="col-xs-5"><?=$app->refer?></td>
							</tr>							
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">견적서</th>
								<td><?=nl2br($app->estimate_txt)?></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">구매요청서</th>
								<td><?=nl2br($app->purchase_txt)?></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">출하지시서</th>
								<td><?=nl2br($app->shipment_txt)?></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">지출결의서</th>
								<td><?=nl2br($app->spending_txt)?></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">첨부파일</th>
								<td colspan="3" class="col-xs-11"><?=$app->attach?></td>
							</tr>
							<tr>
								<td colspan="4"><?=$app->comment?></td>
							</tr>
						</table>
					</form>
				</div>
			</div><!-- /.row -->

			
			
			<!-- submit -->
			<div class="clearfix center">
				<div class="col-md-12">
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=groupware&action=frmMyApproval' ">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록돌아가기
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 결재라인 모달창 -->
<div class="modal fade" id="approvalLineModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">결재라인</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:300px; overflow:hidden; overflow-y:scroll">				
				<table class="table table-bordered" id="approvalLineTb">
					<thead>
						<tr>
							<th>결재라인명</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>				
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">					
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 견적서 모달창 -->
<div class="modal fade" id="estimateModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:800px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">견적서</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:400px">
				<table class="table table-bordered" id="estimateTb">
					<thead>
						<tr>
							<th>견적서코드</th>
							<th>거래처</th>
							<th>영업담당</th>
							<th>견적일자</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 구매요청서 모달창 -->
<div class="modal fade" id="purchaseModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:800px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">구매요청서</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:400px; overflow:hidden; overflow-y:scroll">
				<table class="table table-bordered" id="purchaseTb">
					<thead>
						<tr>
							<th>품번</th>
							<th>품명</th>
							<th>규격</th>
							<th>단위</th>
							<th>요청수량</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">					
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 출하지시서 모달창 -->
<div class="modal fade" id="shipmentModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:800px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">출하지시서</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:400px; overflow:hidden; overflow-y:scroll">
				<table class="table table-bordered" id="shipmentTb">
					<thead>
						<tr>
							<th>수주코드</th>
							<th>거래처</th>
							<th>품번</th>
							<th>품명</th>
							<th>출하지시수량</th>
							<th>상차일</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">					
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 지출결의서 모달창 -->
<div class="modal fade" id="spendingModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:800px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">지출결의서</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:400px; overflow:hidden; overflow-y:scroll">
				<table class="table table-bordered" id="spendingTb">
					<thead>
						<tr>
							<th>문서번호</th>
							<th>지출내용</th>
							<th>금액</th>
							<th>기안일</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">					
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
// 결재라인 모달 열기	
function viewApprovalLineModal(){
	showModal('approvalLineModal');
}

// 결재라인 가져오기
function getApprovalLine() {
	var tag = "";
	var parameter = {"mode" : "getApprovalLineList"};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json){
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr onclick=\"postApprovalLine(" + json[i].uid + ",'" + json[i].line_nm + "')\" style='cursor:pointer'>";
				tag += "<td>" + json[i].line_nm + "</td>";
				tag += "</tr>";
			}

			$("#approvalLineTb tbody").html(tag);
		}
	});
}

function postApprovalLine(uid, line_nm) {
	$("#approval_uid").val(uid);
	$("#approval_nm").val(line_nm);
	hideModal('approvalLineModal');
}

// 견적서 모달
function viewEstimateModal(){
	showModal('estimateModal');
}

// 견적서 가져오기
function getEstimate() {
	var tag = "";
	var where = "where state='견적'";
	var parameter = {"mode" : "getEstimateList", "page" : 1, "rpp" : 100, "where" : where};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json){
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr onclick=\"postEstimate(" + json[i].uid + ", '" + json[i].estimate_cd + "', '" + json[i].account_nm + "')\")\" style='cursor:pointer'>";
				tag += "<td>" + json[i].estimate_cd + "</td>";
				tag += "<td>" + json[i].account_nm + "</td>";
				tag += "<td>" + json[i].sales_emp_nm + "</td>";
				tag += "<td>" + json[i].estimate_dt + "</td>";
				tag += "</tr>";
			}

			$("#estimateTb tbody").html(tag);
		}
	});
}

function postEstimate(uid, estimate_cd, txt){
	var pcd = $("#estimate_cd").val();

	if(pcd.length == 0) pcd = estimate_cd;
	else pcd = pcd + "," + estimate_cd;

	var ptxt = $("#estimate_txt").val();
	txt = ptxt + txt + " [" + estimate_cd + "]\r\n";

	$("#estimate_cd").val(pcd);
	$("#estimate_txt").val(txt);

	hideModal('estimateModal');
}

// 구매요청서 모달
function viewPurchaseModal(){
	showModal('purchaseModal');
}

// 구매요청서 가져오기
function getPurchase() {
	var tag = "";
	var where = "where approval='n'";
	var parameter = {"mode" : "getPurchaseList", "page" : 1, "rpp" : 100, "where" : where};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json){
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr onclick=\"postPurchase('" + json[i].purchase_cd + "', '" + json[i].title + "')\" style='cursor:pointer'>";
				tag += "<td>" + json[i].item_cd + "</td>";
				tag += "<td>" + json[i].item_nm + "</td>";
				tag += "<td>" + json[i].standard + "</td>";
				tag += "<td>" + json[i].unit + "</td>";
				tag += "<td>" + json[i].cnt + "</td>";				
				tag += "</tr>";
			}

			$("#purchaseTb tbody").html(tag);
		}
	});
}

function postPurchase(purchase_cd,txt) {			
	var pcd = $("#purchase_cd").val();
	if(pcd.length == 0) pcd = purchase_cd;
	else pcd = pcd + "," + purchase_cd;
	
	var ptxt = $("#purchase_txt").val();
	txt = ptxt + txt + " [" + purchase_cd + "]\r\n";

	$("#purchase_cd").val(pcd);
	$("#purchase_txt").val(txt);

	hideModal('purchaseModal');
}

// 출하지시서 모달
function viewShipmentModal() {
	showModal('shipmentModal');
}

// 출하지시서 가져오기
function getShipment() {
	var tag = "";
	var where = "where approval='n'";
	var parameter = {"mode" : "getShipmentList", "page" : 1, "rpp" : 100, "where" : where};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json){
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr onclick=\"postShipment('" + json[i].obtain_order_cd + "', '" + json[i].account_nm + "')\" style='cursor:pointer'>";
				tag += "<td>" + json[i].obtain_order_cd + "</td>";
				tag += "<td>" + json[i].account_nm + "</td>";
				tag += "<td>" + json[i].item_cd + "</td>";
				tag += "<td>" + json[i].item_nm + "</td>";
				tag += "<td>" + json[i].cnt + "</td>";	
				tag += "<td>" + json[i].shipment_dt + "</td>";				
				tag += "</tr>";
			}

			$("#shipmentTb tbody").html(tag);
		}
	});
}

function postShipment(shipment_cd, txt){
	var pcd = $("#shipment_cd").val();
	if(pcd.length == 0) pcd = shipment_cd;
	else pcd = pcd + "," + shipment_cd;
	
	var ptxt = $("#shipment_txt").val();
	txt = ptxt + txt + " [" + shipment_cd + "]\r\n";

	$("#shipment_cd").val(pcd);
	$("#shipment_txt").val(txt);

	hideModal('shipmentModal');
}

// 지출결의서 모달
function viewSpendingModal() {
	showModal('spendingModal');
}

// 지출결의서 가져오기
function getSpending() {
	var tag = "";
	var where = "where approval='n'";
	var parameter = {"mode" : "getSpendingResolutionList", "page" : 1, "rpp" : 100, "where" : where};
	$.getJSON("ajax.php",{"parameter" : parameter}, function(json){
		if(json != null) {
			for(var i = 0 ; i < json.length ; i++){
				tag += "<tr onclick=\"postSpending('" + json[i].spending_cd + "', '" + json[i].title + "')\" style='cursor:pointer'>";
				tag += "<td>" + json[i].spending_cd + "</td>";
				tag += "<td>" + json[i].title + "</td>";
				tag += "<td>" + json[i].total_price + "</td>";
				tag += "<td>" + json[i].spending_dt + "</td>";				
				tag += "</tr>";
			}

			$("#spendingTb tbody").html(tag);
		}
	});
}

function postSpending(spending_cd, txt){
	var pcd = $("#spending_cd").val();
	if(pcd.length == 0) pcd = spending_cd;
	else pcd = pcd + "," + spending_cd;
	
	var ptxt = $("#shipment_txt").val();
	txt = ptxt + txt + " [" + spending_cd + "]\r\n";

	$("#spending_cd").val(pcd);
	$("#spending_txt").val(txt);

	hideModal('spendingModal');
}




$(document).ready(function(){
	//createApprovalCode();
	getApprovalLine();
	getEstimate();
	getPurchase();
	getShipment();
	getSpending();

	// 기안등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			var ContentFromEditor = CKEDITOR.instances.comment.getData();
			$("#content").val(ContentFromEditor);

			event.preventDefault();
			var form = $('#frm')[0];
			var data = new FormData(form);
			data.append("CustomField", "This is some extra data, testing");
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "ajax.php",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {					
					showAlert("기안서를 상신하였습니다");
					$("#btnSubmit").prop("disabled", false);

				},
				error: function (e) {
					$("#btnSubmit").prop("disabled", false);

				}
			});
		}
	});
});

// 견적코드 생성
function createApprovalCode(){
	var parameter = {"mode" : "createApprovalCode"};
	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		success : function(str) {
			$("#approval_cd").val(str);
		}
	});
}

function changeTemplate(uid) {
	if(uid == "" || uid == null ) return;
	CKEDITOR.instances.comment.setData('');

	//var content = getTemplateContent("T", templateId);
	var parameter = {"mode" : "getTemplete", "uid" : uid};
	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		dataType : "html",
		success : function(json) {
			CKEDITOR.instances.comment.setData(json);
		}
	});
	return false;
}


// 부서 가져오기
function getMiddleDepartment(){
	var tag = "<option value='0'>부서선택</option>";
	var parameter = {"mode" : "getMiddleDepartment", "fid" : $("#big_uid").val()};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}

			$("#middle_department_cd").html(tag);
		}
	);
}

function getSmallDepartment(){
	var tag = "<option value='0'>부서선택</option>";
	var parameter = {"mode" : "getSmallDepartment", "fid" : $("#middle_uid").val()};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}
			$("#small_department_cd").html(tag);
		}
	);
}

function postBigDepartment(uid){
	$("#big_uid").val(uid);
	getMiddleDepartment();
	$("#department_small_list tbody").html("");
}

function postMiddleDepartment(uid){
	$("#middle_uid").val(uid);
	getSmallDepartment();
}

function postSmallDepartment(uid){
	$("#small_uid").val(uid);
}
</script>