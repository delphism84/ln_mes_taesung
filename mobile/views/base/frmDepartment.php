<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div>
						<div class="col-xs-12">
							<input type="hidden" name="big_uid" id="big_uid" />
							<input type="hidden" name="middle_uid" id="middle_uid" />
							<input type="hidden" name="small_uid" id="small_uid" />
							<input type="hidden" name="big_max_seq" id="big_max_seq" />
							<input type="hidden" name="middle_max_seq" id="middle_max_seq" />
							<input type="hidden" name="small_max_seq" id="small_max_seq" />

							<!-- 테이블 -->
							<div><input type="button" class="btn btn-xs btn-pink" value="회사" /></div>
							<!--
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<? $this->th("회사명"); ?>
									<td><input type="text" class="form-control" name="big_department_nm" id="big_department_nm" /></td>
								</tr>
								<tr>
									<? $this->th("출력순서"); ?>
									<td>
										<input type="text" class="onlynum" name="big_seq" id="big_seq" /> 
										<input type="button" class="btn btn-xs btn-inverse" value="생성 및 수정" onclick="registBigDepartment()" />
										<button type="button" class="btn btn-success btn-xs" onclick="big_refresh()">
											<span class="fa fa-refresh icon-on-right bigger-110"></span>
										</button>
										<? if($_SESSION['login_level'] >= 99) { ?>
										<button type="button" class="btn btn-danger btn-xs" onclick="deleteBigDepartment()">
											<span class="fa fa-trash icon-on-right bigger-110"></span>
										</button>
										<?}?>
									</td>
								</tr>
							</table>
							-->
							<div class="widget-main no-padding">
								<table class="table table-bordered" id="department_big_list">
									<thead>
										<tr>
											<th class="detail-col center">
												회사명
											</th>
											<th class="detail-col center">
												출력순서
											</th>											
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<!--
								<? $this->table("department_big_list", "회사명=>8,출력순서=>2", "no")?>
								-->
							</div>
						</div>
						<div class="col-xs-12" style="margin-top:10px;">
							<div><input type="button" class="btn btn-xs btn-pink" value="부서" /></div>
							<!--
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<? $this->th("부서명"); ?>
									<td><input type="text" class="form-control" name="middle_department_nm" id="middle_department_nm" /></td>
								</tr>
								<tr>
									<? $this->th("출력순서"); ?>
									<td>
										<input type="text" class="onlynum" name="middle_seq" id="middle_seq" /> 
										<input type="button" class="btn btn-xs btn-inverse" value="생성 및 수정" onclick="registMiddleDepartment()" />
										<button type="button" class="btn btn-success btn-xs" onclick="middle_refresh()">
											<span class="fa fa-refresh icon-on-right bigger-110"></span>
										</button>
										<? if($_SESSION['login_level'] >= 99) { ?>
										<button type="button" class="btn btn-danger btn-xs" onclick="deleteMiddleDepartment()">
											<span class="fa fa-trash icon-on-right bigger-110"></span>
										</button>
										<?}?>									
									</td>
								</tr>
							</table>
							-->
							<div class="widget-main no-padding">
								<table class="table table-bordered" id="department_middle_list">
									<thead>
										<tr>											
											<th class="detail-col center">
												부서명
											</th>
											<th class="detail-col center">
												출력순서
											</th>											
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<!--
								<? $this->table("department_middle_list", "부서명=>8,출력순서=>2", "no"); ?>
								-->
							</div>
						</div>
						<div class="col-xs-12" style="margin-top:10px;">
							<div><input type="button" class="btn btn-xs btn-pink" value="하위부서" /></div>
							<!--
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<? $this->th("하위부서명"); ?>
									<td><input type="text" class="form-control" name="small_department_nm" id="small_department_nm" /></td>
								</tr>
								<tr>
									<? $this->th("출력순서"); ?>
									<td>
										<input type="text" class="onlynum" name="small_seq" id="small_seq" />
										<input type="button" class="btn btn-xs btn-inverse" value="생성 및 수정" onclick="registSmallDepartment()" />
										<button type="button" class="btn btn-success btn-xs" onclick="small_refresh()">
											<span class="fa fa-refresh icon-on-right bigger-110"></span>
										</button>
										<? if($_SESSION['login_level'] >= 99) { ?>
										<button type="button" class="btn btn-danger btn-xs" onclick="deleteSmallDepartment()">
											<span class="fa fa-trash icon-on-right bigger-110"></span>
										</button>
										<?}?>
									</td>
								</tr>
							</table>
							-->
							<div class="widget-main no-padding">
								<table class="table table-bordered" id="department_small_list">
									<thead>
										<tr>											
											<th class="detail-col center">
												하위부서
											</th>
											<th class="detail-col center">
												출력순서
											</th>											
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<!--
								<? $this->table("department_small_list", "하위부서명=>8,출력순서=>2", "no"); ?>
								-->
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
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
function big_refresh() {
	$("#big_department_nm").val("");
	$("#big_seq").val("");
	$("#big_uid").val("");
}

function middle_refresh() {
	$("#middle_department_nm").val("");
	$("#middle_seq").val("");
	$("#middle_uid").val("");
}

function small_refresh() {
	$("#small_department_nm").val("");
	$("#small_seq").val("");
	$("#small_uid").val("");
}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	getBigDepartment();
});

//==================================================
// 대부서 가져오기
//==================================================
function getBigDepartment(){
	var tag = "";
	var parameter = {"mode":"getBigDepartment"};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postBigDepartment(" + json[i].uid + ",'" + json[i].department_nm + "'," + json[i].seq + ")\">" + json[i].department_nm + "</a></td>";
					tag += "<td>" + json[i].seq + "</td>";
					tag += "</tr>";

					$("#big_max_seq").val(json[i].seq);
				}
			} else {
				tag = "<tr><td colspan='2' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}

			$("#department_big_list tbody").html(tag);
		}
	);
}

//==================================================
// 중부서 가져오기
//==================================================
function getMiddleDepartment(){
	var tag = "";
	var parameter = {"mode" : "getMiddleDepartment", "fid" :  $("#big_uid").val()}
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postMiddleDepartment(" + json[i].uid + ",'" + json[i].department_nm + "'," + json[i].seq + ")\">" + json[i].department_nm + "</a></td>";
					tag += "<td>" + json[i].seq + "</td>";
					tag += "</tr>";

					$("#middle_max_seq").val(json[i].seq);
				}
			} else {
				tag = "<tr><td colspan='2' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}

			$("#department_middle_list tbody").html(tag);
		}
	);
}

//==================================================
// 소부서 가져오기
//==================================================
function getSmallDepartment(){
	var fid = $("#middle_uid").val();
	var tag = "";
	var parameter = {"mode" : "getSmallDepartment", "fid" :  $("#middle_uid").val()}

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postSmallDepartment(" + json[i].uid + ",'" + json[i].department_nm + "'," + json[i].seq + ")\">" + json[i].department_nm + "</a></td>";
					tag += "<td>" + json[i].seq + "</td>";
					tag += "</tr>";

					$("#small_max_seq").val(json[i].seq);
				}
			} else {
				tag = "<tr><td colspan='2' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}

			$("#department_small_list tbody").html(tag);
		}
	);
}

//==================================================
// 선택 대부서 처리
//==================================================
function postBigDepartment(uid,name,seq){
	$("#big_uid").val(uid);
	$("#big_seq").val(seq);
	$("#big_department_nm").val(name);
	getMiddleDepartment();
	$("#department_small_list tbody").html("");
}

//==================================================
// 선택 중부서 처리
//==================================================
function postMiddleDepartment(uid,name,seq){
	$("#middle_uid").val(uid);
	$("#middle_seq").val(seq);
	$("#middle_department_nm").val(name);
	getSmallDepartment();
}

//==================================================
// 선택 소부서 처리
//==================================================
function postSmallDepartment(uid,name,seq){
	$("#small_uid").val(uid);
	$("#small_seq").val(seq);
	$("#small_department_nm").val(name);
}

//==================================================
// 대부서 등록
//==================================================
function registBigDepartment() {
	if($("#big_department_nm").val() == "") {
		showAlert("회사명을 입력하세요");
		return;
	}

	if($("#big_seq").val() == "") $("#big_seq").val(Number($("#big_max_seq").val()) + 1);

	var parameter = {"mode" : "registBigDepartment", "department_nm" : $("#big_department_nm").val(), "seq" : $("#big_seq").val(), "uid" : $("#big_uid").val()};

	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function() {
			getBigDepartment();
			$("#big_uid").val("");
			$("#big_department_nm").val("");
			$("#big_seq").val("");
			$("#big_uid").val("");
		}
	});
}

//==================================================
// 중부서 등록
//==================================================
function registMiddleDepartment() {
	if($("#middle_department_nm").val() == "") {
		showAlert("부서명을 입력하세요");
		return;
	}
	if($("#middle_seq").val() == "") $("#middle_seq").val(Number($("#middle_max_seq").val()) + 1);

	var parameter = {"mode" : "registMiddleDepartment", "department_nm" : $("#middle_department_nm").val(), "seq" : $("#middle_seq").val(), "fid" : $("#big_uid").val(), "uid" : $("#middle_uid").val()};

	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function() {
			getMiddleDepartment();
			$("#middle_uid").val("");
			$("#middle_department_nm").val("");
			$("#middle_seq").val("");
			$("#middle_uid").val("");
		}
	});
}

//==================================================
// 소부서 등록
//==================================================
function registSmallDepartment() {
	if($("#small_department_nm").val() == "") {
		showAlert("하위부서명을 입력하세요");
		return;
	}
	if($("#small_seq").val() == "") $("#small_seq").val(Number($("#small_max_seq").val()) + 1);

	var parameter = {"mode" : "registSmallDepartment", "department_nm" : $("#small_department_nm").val(), "seq" : $("#small_seq").val(), "fid" : $("#middle_uid").val(), "uid" : $("#small_uid").val()};

	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function() {
			getSmallDepartment();
			$("#small_uid").val("");
			$("#small_department_nm").val("");
			$("#small_seq").val("");
			$("#small_uid").val("");
		}
	});
}

//==================================================
// 대부서 삭제
//==================================================
function deleteBigDepartment(){
	if($("#big_uid").val() == "") {
		showAlert("회사를 선택하세요");
		return;
	}
	var parameter = {"mode" : "deleteBigDepartment", "uid" : $("#big_uid").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "son") {
				showAlert("하위 카테고리를 먼저 삭제하시고 진행하세요");
				return false;
			} else {
				$("#big_department_nm").val("");
				$("#big_seq").val("");
				$("#big_uid").val("");
				getBigDepartment();
			}
		}
	});
}

//==================================================
// 중부서 삭제
//==================================================
function deleteMiddleDepartment(){
	if($("#middle_uid").val() == "") {
		showAlert("부서를 선택하세요");
		return;
	}
	var parameter = {"mode" : "deleteMiddleDepartment", "uid" : $("#middle_uid").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "son") {
				showAlert("하위 카테고리를 먼저 삭제하시고 진행하세요");
				return false;
			} else {
				$("#middle_department_nm").val("");
				$("#middle_seq").val("");
				$("#middle_uid").val("");
				getMiddleDepartment();
			}
		}
	});
}

//==================================================
// 소부서 삭제
//==================================================
function deleteSmallDepartment(){
	if($("#small_uid").val() == "") {
		showAlert("하위부서를 선택하세요");
		return;
	}
	var parameter = {"mode" : "deleteSmallDepartment", "uid" : $("#small_uid").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function() {
			$("#small_department_nm").val("");
			$("#small_seq").val("");
			$("#small_uid").val("");
			getSmallDepartment();
		}
	});
}
</script>