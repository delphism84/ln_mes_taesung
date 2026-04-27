<?
require_once("library/caseby.php");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-12">
						<div><input type="button" class="btn btn-xs btn-pink" value="용차 리스트" /></div>
						<table class="table table-bordered table-striped" id="tb">
							<thead>
								<tr>
									<th class="detail-col center">
										<label class="pos-rel">
											<input type="checkbox" class="ace" id="checkedAll" />
											<span class="lbl"></span>
										</label>
									</th>
									<th class="detail-col center">
										차량번호
									</th>
									<th class="detail-col center">
										차종/적재량
									</th>
									<th class="detail-col center">
										차주
									</th>
									<th class="detail-col center">
										회사명
									</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<!--
						<? $this->noCheckTable("tb","차량번호=>2,차종/적재량=>4,차주=>2,회사명=>4"); ?>
						-->
						<? $this->paging() ?>
					</div>
					
					<div class="col-xs-12">
						<!--
						<div style="height:280px">
							<form id='frm'>								
								<input type="hidden" name="mode" id="mode" value="registRentcarCost" />
								<input type="hidden" name="fid" id="fid" />
								<input type="hidden" name="uid" id="uid" />
								<!--
								<div><input type="button" class="btn btn-xs btn-pink" value="요금등록" /></div>
								<table class="table table-bordered">
									<tr>
										<? $this->th("출발지","","width:100px;") ?>
										<td><input type="text" class="form-control" name="start_area" id="start_area" /></td>
									</tr>
									<tr>
										<? $this->th("도착지") ?>
										<td><input type="text" class="form-control" name="end_area" id="end_area" /></td>
									</tr>
									<tr>
										<? $this->th("요금") ?>
										<td><input type="text" class="form-control" name="cost" id="cost" /></td>
									</tr>
								</table>
								
							</form>
							
							<div class="col-md-12 center">
								<button class="btn btn-info" type="button" id="btnSubmit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									<span id="btnSubmitTxt">요금 등록</span>
								</button>
								<button class="btn btn-default" type="button" onclick="formClear()">
									<i class="ace-icon fa fa-check bigger-110"></i>
									새로고침
								</button>
							</div>
							
						</div>
						-->
						
						<div>
							<?
							if($_SESSION['login_level'] >= 99) {
								echo "<div style='float:left'><input type='button' class='btn btn-xs btn-pink' value='요금정보' /></div>";
								//echo "<div style='float:right'><input type='button' class='btn btn-xs btn-danger' value='선택삭제' data-toggle='modal' data-target='#confirm-delete' /></div>";
								$this->table("cost_tb","출발지,도착지,요금");
							} else {
								echo "<div style='float:left'><input type='button' class='btn btn-xs btn-pink' value='요금정보' /></div>";
								$this->table("cost_tb","출발지,도착지,요금");
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="16" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

function refresh() {
	$("#per").val(10);
	$("#search_classify").val(0);
	$("#search_txt").val("");
	$("#where").val("");
	$("#page").val(1);
	getData(1);
}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );


	var page = $("#page").val();
	getData(page);

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

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			event.preventDefault();
			var form = $('#frm')[0];
			var data = new FormData(form);S
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
					getRentcarCostList($("#fid").val());
					formClear();
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
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("rentcar_cost");
	hideModal("confirm-delete");
	getRentcarCostList($("#fid").val());
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#btnSubmitTxt").text("용차 등록");
}

//==================================================
// 선택된 품목 테이블 선택된 TR 색상 바꾸기
//==================================================
function toggle(it) {
	$("#tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}


//==================================================
// 품목리스트
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getRentcarList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postCar(" + json[i].uid + ");\" style='cursor:pointer'>";
					tag += "<td>" + json[i].car_no + "</td>";
					tag += "<td>" + json[i].classify + " / " + json[i].ton + "</td>";
					tag += "<td>" + json[i].owner + "</td>";
					tag += "<td>" + json[i].corp_nm + "</td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "rentcar";
			getPaging(table, $("#where").val(), $("#per").val(), 4);
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function postCar(uid) {
	$("#fid").val(uid);
	getRentcarCostList(uid);
}

function getRentcarCostList(uid) {
	var tag = "";
	var parameter = {"mode" : "getRentcarCostList", "uid" : uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			for (var i = 0 ; i < json.length ; i++)
			{
				tag += "<tr>";

				<? if($_SESSION['login_level'] >= 99) { ?>
				tag += "<td class='center'>";
				tag += "<label class='pos-rel'>";
				tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
				tag += "<span class='lbl'></span>";
				tag += "</label>";
				tag += "</td>";
				<?}?>

				tag += "<td>" + json[i].start_area + "</td>";
				tag += "<td>" + json[i].end_area + "</td>";
				tag += "<td>" + json[i].cost + "</td>";
				tag += "</tr>";
			}			
		} else {
			tag = "<tr><td colspan='4' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
		}

		$("#cost_tb tbody").html(tag);
	});
}


//==================================================
// 검색
//==================================================
function search(){
	var search_choice = $("#search_classify option:selected").val();
	if(search_choice == 0) {
		showAlert("검색구분을 선택하세요");
		return false;
	}

	var txt = $("#search_txt").val();

	if(txt == "") {
		showAlert("검색어를 입력하세요");
		return false;
	}

	$("#where").val(" where " + search_choice + " like '%" + txt + "%'");
	getData(1);
}
</script>