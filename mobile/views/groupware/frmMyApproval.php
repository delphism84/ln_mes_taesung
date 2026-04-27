<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">			
			<div class="col-xs-12" style="padding-top:10px;">
				<ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab" style="padding:0; border:none">
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
				<table id="ele_settelement_list" class="table  table-bordered table-striped" style="margin-top:10px;">
					<thead class="thin-border-bottom">
						<tr>
							<th class="detail-col center">
								<label class="pos-rel">
									<input type="checkbox" class="ace" id="checkedAll" />
									<span class="lbl"></span>
								</label>
							</th>
							<th><i class="ace-icon fa fa-caret-right blue"></i> 기안서코드</th>
							<th><i class="ace-icon fa fa-caret-right blue" ></i> 기안서명</th>
							<th><i class="ace-icon fa fa-caret-right blue"></i> 결재라인</th>
							<th><i class="ace-icon fa fa-caret-right blue"></i> 기안일</th>
							<th><i class="ace-icon fa fa-caret-right blue"></i> 수정</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			</div>
			<div class="clearfix center" style="margin-top:0px">				
				<div style="text-align:left"><span id="paging_area"></span></div>
				<!--
				<div style="text-align:right">
					<button class="btn btn-info" type="button" onclick="location.href = 'index.php?controller=groupware&action=frmRegistApproval' ">
						<i class="ace-icon fa fa-check"></i>
						기안등록
					</button>						
					<button class="btn btn-danger" type="button" onclick="deleteSelect()">
						<i class="ace-icon fa fa-undo"></i>
						선택삭제
					</button>
				</div>
				-->
			</div>
		</div>
	</div>
</div>


<input type="hidden" name="state" id="state" value="stay" />
<input type="hidden" name="per" id="per" value="14" />
<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
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
		case "a" : 
			$("#where").val(" where emp_id='<?=$_SESSION[login_id]?>' and state='stay'"); 
			$("#state").val("stay");
		break;
		
		case "b" : 
			$("#where").val(" where emp_id='<?=$_SESSION[login_id]?>' and state='ing'"); 
			$("#state").val("ing");
		break;
		
		case "c" : 
			$("#where").val(" where emp_id='<?=$_SESSION[login_id]?>' and state='complete'"); 
			$("#state").val("complete");
		break;
		
		case "d" : 
			$("#where").val(" where emp_id='<?=$_SESSION[login_id]?>' and state='return'"); 
			$("#state").val("return");
		break;
		
		case "e" : 
			$("#where").val(" where emp_id='<?=$_SESSION[login_id]?>' and state='hold'"); 
			$("#state").val("hold");
		break;
	}

	getApproval(1);
}

// 거래처 리스트 가져오기
function getApproval(page){
	var tag = "";
	var parameter = {"mode" : "getMyApproval", "page" : page, "rpp" : $("#per").val(), "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++) {
					tag += "<tr>";
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					tag += "<td><a href='index.php?controller=groupware&action=frmViewApproval&uid=" + json[i].uid + "'>" + json[i].approval_cd + "</a></td>";
					tag += "<td><a href='index.php?controller=groupware&action=frmViewApproval&uid=" + json[i].uid + "'>" + json[i].title + "</a></td>";
					tag += "<td>" + json[i].line + "</td>";
					tag += "<td>" + json[i].create_dt + "</td>";
					if($("#state").val() == "stay" || $("#state").val() == "return") tag += "<td><input type='button' class='btn btn-xs btn-success' value='수정' onclick=\"location.href = 'index.php?controller=groupware&action=frmModifyApproval&uid=" + json[i].uid + "'\" /></td>";
					else tag += "<td><input type='button' class='btn btn-xs btn-danger' value='수정불가' /></td>";
					tag += "</tr>";
				}
			} else {
				tag += "<tr><td colspan='6' style='text-align:center; color:red'><br />데이터가 존재하지 않습니다<br /><br /></td></tr>";
			}

			$("#ele_settelement_list tbody").html(tag);

			var table = "approval";
			getPaging(table, $("#where").val(), $("#per").val(), 4);
		}
	);
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

// 선택 삭제
function deleteSelect(){
	if(confirm("선택하신 기안서를 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var parameter = {"mode" : "deleteSelect", "table" : "approval", "uids" : $("#check_uids").val()};
		$.ajax({
			type : "post",
			url : "ajax.php",
			data : parameter,
			async : false,
			success : function(){
				$("#checkedAll").prop('checked',false);
				getApproval(1);
			}
		});
	}
}

// 거래처 구분으로 거래처 리스트 가져오기
function setState(val) {
	if(val == "all") $("#where").val("");
	else $("#where").val(" and state='" + val + "'");
	getApproval(1);
}
</script>