<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<!--
					<div>
						<form name="classifyFrm" id="classifyFrm">
							<input type="hidden" name="mode" id="mode" value="registQcClassify" />	
							<input type="hidden" name="classify_uid" id="classify_uid" />
							<input type="button" class="btn btn-xs" value="검사구분명" style="margin-bottom:4px"/><input type="text" name="classify_nm" id="classify_nm" validation="yes" err="검사구분명을 입력하세요" /> 
							<input type="button" class="btn btn-xs" value="삭제가능여부" style="margin-bottom:4px"/>
							<input name="delete_ok" id="delete_ok" value="y" class="ace ace-switch ace-switch-5" type="checkbox" /><span class="lbl" style="position:relative; top:5px"></span>
							<input type="button" class="btn btn-xs btn-inverse" id="btnClassifySubmit" value="생성 및 수정" style="margin-bottom:4px" />
							<button type="button" class="btn btn-success btn-xs" onclick="refresh()" style="margin-bottom:4px">
								<span class="fa fa-refresh icon-on-right bigger-110"></span>
							</button>
						</form>
					</div>
					-->
					
					<div>					
						<div class="col-xs-12">
							
							<div class="widget-main no-padding">
								<?
								if($_SESSION['login_level'] >= 99) {
									echo "<div style='float:left'>";
									echo "<input type='button' class='btn btn-xs btn-pink' value='검사구분' />";
									echo "</div>";
									echo "<div style='float:right'>";
									//echo "<input type='button' class='btn btn-xs btn-danger' value='선택삭제' data-toggle='modal' data-target='#confirm-delete' />";
									echo "</div>";

									$this->table("classify_tb","검사구분명");
								} else {
									echo "<div style='float:left'>";
									echo "<input type='button' class='btn btn-xs btn-pink' value='검사구분' />";
									echo "</div>";

									$this->noCheckTable("classify_tb","검사구분명");
								}
								?>
							</div>
						</div>
						
						<div class="col-xs-12">
							<form name="frm" id="frm">
								<input type="hidden" name="mode" id="mode" value="registQcItem" />
								<input type="hidden" name="uid" id="uid" />
								<input type="hidden" name="fid" id="fid" />

								<!--
								<div><input type="button" class="btn btn-xs btn-pink" value="검사항목 등록" /></div>
								<table class="table table-bordered">
									<tr>
										<? $this->th("검사명", "", "width:150px") ?>
										<td><input type="text" name="qc_nm" id="qc_nm" /></td>
									</tr>
									<tr>
										<? $this->th("나열순서") ?>
										<td><input type="text" name="seq" id="seq" /></td>
									</tr>
									<tr>
										<? $this->th("결과입력방법") ?>
										<td><input type="radio" name="qc_type" id="qc_type" value="radio" /> 라디오버튼 <input type="radio" name="qc_type" id="qc_type" value="input" /> 입력필드 <input type="radio" name="qc_type" id="qc_type" value="check" /> 체크박스
										</td>
									</tr>
									<tr>
										<? $this->th("유형텍스트") ?>
										<td><input type="text" name="qc_type_txt" id="qc_type_txt" />
									</tr>
									<tr>
										<? $this->th("설명문구") ?>
										<td><input type="text" class="form-control" name="txt" id="txt" />
									</tr>
								</table>
								

								<div style="text-align:center">
									<button class="btn btn-info" type="button" id="btnSubmit">
										<i class="ace-icon fa fa-check bigger-110"></i>
										<span id="btnSubmitTxt">검사항목 등록</span>
									</button>
									<button class="btn btn-default" type="button" onclick="formClear()">
										<i class="ace-icon fa fa-check bigger-110"></i>
										새로고침
									</button>
								</div>
								-->
							</form>
						</div>
						

						<div class="col-xs-12">
							<?
							if($_SESSION['login_level'] >= 99) {
								echo "<div style='float:left'>";
								echo "<input type='button' class='btn btn-xs btn-pink' value='검사항목' />";
								echo "</div>";
								echo "<div style='float:right'>";
								//echo "<input type='button' class='btn btn-xs btn-danger' value='선택삭제' onclick='deleteQcItem()' />";
								echo "</div>";

								//$this->table2("qc_item_tb","검사명=>2,나열순서=>1,결과입력방법=>1,유형텍스트=>2,설명문구");
							} else {
								echo "<div style='float:left'>";
								echo "<input type='button' class='btn btn-xs btn-pink' value='검사항목' />";
								echo "</div>";

								//$this->noCheckTable2("qc_item_tb","검사명=>2,나열순서=>1,결과입력방법=>1,유형텍스트=>2,설명문구");
							}
							?>


							<table class="table table-bordered table-striped" id="qc_item_tb">
								<thead>
									<tr>
										<th class="detail-col center">
											<label class="pos-rel">
												<input type="checkbox" class="ace" id="checkedAll" />
												<span class="lbl"></span>
											</label>
										</th>
										<th class="detail-col center">
											검사명
										</th>
										<th class="detail-col center">
											나열순서
										</th>
										<th class="detail-col center">
											결과입력방법
										</th>
										<th class="detail-col center">
											유형텍스트
										</th>
										<th class="detail-col center">
											설명문구
										</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="6" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
function refresh() {
	$("#classify_nm").val("");
	$("#classify_uid").val("");
	$("#uid").val("");
	$("#fid").val("");
	//$("#page").val(1);
	//$("#where")val("");
	formClear();
	getData();
}

$(document).ready(function(){
	// 특수문자 입력 방지
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	
	getData();

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
	

	$("#checkedAll2").click(function(){
		if($("#checkedAll2").prop('checked')) {
			$(".chk2").each(function(){
				$(this).prop("checked",true);
			});
		} else {
			$(".chk2").each(function(){
				$(this).prop("checked",false);
			});
		}
	});


	// 검사구분 등록
	$("#btnClassifySubmit").click(function (event) {
		if(check("classifyFrm")) {
			event.preventDefault();
			var form = $('#classifyFrm')[0];
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
				timeout: 5000,
				success: function (data) {
					getData();
					$("#classify_nm").val("");
					$("#classify_uid").val("");
					$("#fid").val("");
					$("#btnClassifySubmit").prop("disabled", false);

				},
				error: function (e) {
					$("#btnClassifySubmit").prop("disabled", false);

				}
			});
		}
	});
	
	// 검사항목 등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
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
				timeout: 5000,
				success: function (data) {
					//getData();
					getQcItemList();
					$("#qc_nm").val("");
					$("#seq").val("");
					$("#qc_type_txt").val("");
					$("#txt").val("");
					$("#btnSubmit").prop("disabled", false);

				},
				error: function (e) {
					$("#btnSubmit").prop("disabled", false);

				}
			});
		}
	});
});


//==================================================
// 선택항목삭제
//==================================================
function deleteQcItem() {
	$(".chk2").each(function(){
		if($(this).prop('checked')) {
			var new_uid = $("#check_uids2").val() + "," + $(this).val();
			$("#check_uids2").val(new_uid);
		}
	});
	
	if($("#check_uids2").val() == "") {
		showAlert("삭제할 검사항목을 선택하세요");
		return;
	}

	var parameter = {"mode" : "deleteQcItem", "uids" : $("#check_uids2").val()};
	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		async : false,
		success : function(){
			$("#checkedAll2").prop('checked',false);
			$("#check_uids2").val("");
			getQcItemList();
			//formClear();
		}
	});
}

//==================================================
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("qc_classify");
	hideModal("confirm-delete");
}

//==================================================
// 생산팀 가져오기
//==================================================
function getData(){
	var tag = "";
	var parameter = {"mode" : "getQcClassifyList"};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr onclick=\"toggle(this); postUid(" + json[i].uid + ", '" + json[i].classify_nm + "', '" + json[i].delete_ok + "')\" style='cursor:pointer'>";
					
					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>
					
					tag += "<td>" + json[i].classify_nm + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='2' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}

			tag += "<tr><td colspan='2'></td></tr>";
			$("#classify_tb tbody").html(tag);
		}
	);
}

//==================================================
// 선택 팀 처리
//==================================================
function postUid(uid, classify_nm, delete_ok) {
	$("#classify_uid").val(uid);
	$("#fid").val(uid);
	$("#classify_nm").val(classify_nm);
	if(delete_ok == "y") {
		$("#delete_ok").prop("checked",true);
	} else {
		$("#delete_ok").prop("checked",false);
	}
	getQcItemList();
}

//==================================================
// 상품테이블 선택 아이템 TR 색상 바꾸기
//==================================================
function toggle(it) {
	$("#classify_tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

function qc_toggle(it) {
	$("#qc_item_tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}


function getQcItemList() {
	var tag = "";
	var parameter = {"mode" : "getQcItemList", "fid" : $("#fid").val()};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for (var i = 0 ; i < json.length ; i++)
			{
				tag += "<tr onclick=\"qc_toggle(this); postData(" + json[i].uid + ", '" + json[i].qc_nm + "', '" + json[i].seq + "', '" + json[i].qc_type + "', '" + json[i].qc_type_txt + "', '" + json[i].txt + "')\" style='cursor:pointer'>";

				<? if($_SESSION['login_level'] >= 99) { ?>
				tag += "<td class='center'>";
				tag += "<label class='pos-rel'>";
				tag += "<input type='checkbox' class='ace flat chk2' value='" + json[i].uid + "' />";
				tag += "<span class='lbl'></span>";
				tag += "</label>";
				tag += "</td>";
				<?}?>

				tag += "<td>" + json[i].qc_nm + "(" + json[i].uid + ")</td>";
				tag += "<td>" + json[i].seq + "</td>";
				tag += "<td>" + json[i].qc_type + "</td>";
				tag += "<td>" + json[i].qc_type_txt + "</td>";
				tag += "<td>" + json[i].txt + "</td>";
				tag += "</tr>";
			}
		} else {
			tag = "<tr><td colspan='6' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#qc_item_tb tbody").html(tag);
	});
}

function postData(uid, qc_nm, seq, qc_type, qc_type_txt, txt) {
	$("#uid").val(uid);
	$("#qc_nm").val(qc_nm);
	$("#seq").val(seq);
	$('input[name="qc_type"]:radio[value="' + qc_type + '"]').prop('checked',true);
	$("#qc_type_txt").val(qc_type_txt);
	$("#txt").val(txt);
	$("#btnSubmitTxt").html("검사항목 수정");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#fid").val("");
	$("#uid").val("");
	$("#btnSubmitTxt").html("검사항목 등록");
	$("#frm")[0].reset();
}
</script>