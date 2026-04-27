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
				<li class="active">LOT 관리대장</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					LOT 관리대장 
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 LOT 관리대장을 등록,조회 하실 수 있습니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="widget-header">
						<div class="col-xs-6" style="float:left">
							<select id="per" onchange="getItem(1)">
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
							<select onchange="setItem(this.value)">
								<option value="all">전체</option>
								<option value="semi_product">반제품</option>
								<option value="product">완제품</option>
							</select>
						</div>

						<div class="col-xs-6" style="float:right">
							<div class="col-xs-4"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="Search..." name="search_txt" id="search_txt" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="search()">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											Search
										</button>
									</span>
								</div>
							</div>
							<div style="float:right">
								<select class="form-control" name="search_choice" id="search_choice">
									<option value="item_nm">품목명</option>
									<option value="item_cd">품목코드</option>
									<option value="item_group_nm">그룹명</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="item_list" class="table  table-bordered table-striped">
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
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 구분</th>
										<th class="detail-col">Details</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 원재료갯수</th>
										<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 파일관리</th>
										<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> BOM등록</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>

							<div class="row">
									<div class="col-xs-12">
										<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th class="center">
														<label class="pos-rel">
															<input type="checkbox" class="ace" />
															<span class="lbl"></span>
														</label>
													</th>
													<th class="detail-col">Details</th>
													<th>Domain</th>
													<th>Price</th>
													<th class="hidden-480">Clicks</th>

													<th>
														<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
														Update
													</th>
													<th class="hidden-480">Status</th>

													<th></th>
												</tr>
											</thead>

											<tbody>
												<tr>
													<td class="center">
														<label class="pos-rel">
															<input type="checkbox" class="ace" />
															<span class="lbl"></span>
														</label>
													</td>
													<td class="center">
														<div class="action-buttons">
															<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
																<i class="ace-icon fa fa-angle-double-down"></i>
																<span class="sr-only">Details</span>
															</a>
														</div>
													</td>

													<td>
														<a href="#">ace.com</a>
													</td>
													<td>$45</td>
													<td class="hidden-480">3,330</td>
													<td>Feb 12</td>

													<td class="hidden-480">
														<span class="label label-sm label-warning">Expiring</span>
													</td>

													<td>
														<div class="hidden-sm hidden-xs btn-group">
															<button class="btn btn-xs btn-success">
																<i class="ace-icon fa fa-check bigger-120"></i>
															</button>

															<button class="btn btn-xs btn-info">
																<i class="ace-icon fa fa-pencil bigger-120"></i>
															</button>

															<button class="btn btn-xs btn-danger">
																<i class="ace-icon fa fa-trash-o bigger-120"></i>
															</button>

															<button class="btn btn-xs btn-warning">
																<i class="ace-icon fa fa-flag bigger-120"></i>
															</button>
														</div>

														<div class="hidden-md hidden-lg">
															<div class="inline pos-rel">
																<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
																	<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
																</button>

																<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																	<li>
																		<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																			<span class="blue">
																				<i class="ace-icon fa fa-search-plus bigger-120"></i>
																			</span>
																		</a>
																	</li>

																	<li>
																		<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																			<span class="green">
																				<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																			</span>
																		</a>
																	</li>

																	<li>
																		<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																			<span class="red">
																				<i class="ace-icon fa fa-trash-o bigger-120"></i>
																			</span>
																		</a>
																	</li>
																</ul>
															</div>
														</div>
													</td>
												</tr>

												<tr class="detail-row">
													<td colspan="8">
														<div class="table-detail">
															<div class="row">
																<div class="widget-body">
																<div class="widget-main no-padding">
																	<table id="item_list" class="table  table-bordered table-striped">
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
																				<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 구분</th>
																				<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목코드</th>
																				<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 품목명</th>
																				<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
																				<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
																				<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 규격</th>
																				<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> 원재료갯수</th>
																				<th class="col-xs-2"><i class="ace-icon fa fa-caret-right blue"></i> 파일관리</th>
																				<th class="col-xs-1"><i class="ace-icon fa fa-caret-right blue"></i> BOM등록</th>
																			</tr>
																		</thead>
																		<tbody></tbody>
																	</table>
																</div>
															</div>
															</div>
														</div>
													</td>
												</tr>

												<tr>
													<td class="center">
														<label class="pos-rel">
															<input type="checkbox" class="ace" />
															<span class="lbl"></span>
														</label>
													</td>

													<td class="center">
														<div class="action-buttons">
															<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
																<i class="ace-icon fa fa-angle-double-down"></i>
																<span class="sr-only">Details</span>
															</a>
														</div>
													</td>

													<td>
														<a href="#">pro.com</a>
													</td>
													<td>$55</td>
													<td class="hidden-480">4,250</td>
													<td>Jan 21</td>

													<td class="hidden-480">
														<span class="label label-sm label-success">Registered</span>
													</td>

													<td>
														<div class="hidden-sm hidden-xs btn-group">
															<button class="btn btn-xs btn-success">
																<i class="ace-icon fa fa-check bigger-120"></i>
															</button>

															<button class="btn btn-xs btn-info">
																<i class="ace-icon fa fa-pencil bigger-120"></i>
															</button>

															<button class="btn btn-xs btn-danger">
																<i class="ace-icon fa fa-trash-o bigger-120"></i>
															</button>

															<button class="btn btn-xs btn-warning">
																<i class="ace-icon fa fa-flag bigger-120"></i>
															</button>
														</div>

														<div class="hidden-md hidden-lg">
															<div class="inline pos-rel">
																<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
																	<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
																</button>

																<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																	<li>
																		<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																			<span class="blue">
																				<i class="ace-icon fa fa-search-plus bigger-120"></i>
																			</span>
																		</a>
																	</li>

																	<li>
																		<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																			<span class="green">
																				<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																			</span>
																		</a>
																	</li>

																	<li>
																		<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																			<span class="red">
																				<i class="ace-icon fa fa-trash-o bigger-120"></i>
																			</span>
																		</a>
																	</li>
																</ul>
															</div>
														</div>
													</td>
												</tr>

												<tr class="detail-row">
													<td colspan="8">
														<div class="table-detail">
															<div class="row">
																<div class="col-xs-12 col-sm-2">
																	<div class="text-center">
																		<img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="assets/images/avatars/profile-pic.jpg" />
																		<br />
																		<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
																			<div class="inline position-relative">
																				<a class="user-title-label" href="#">
																					<i class="ace-icon fa fa-circle light-green"></i>
																					&nbsp;
																					<span class="white">Alex M. Doe</span>
																				</a>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="col-xs-12 col-sm-7">
																	<div class="space visible-xs"></div>

																	<div class="profile-user-info profile-user-info-striped">
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Username </div>

																			<div class="profile-info-value">
																				<span>alexdoe</span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Location </div>

																			<div class="profile-info-value">
																				<i class="fa fa-map-marker light-orange bigger-110"></i>
																				<span>Netherlands, Amsterdam</span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Age </div>

																			<div class="profile-info-value">
																				<span>38</span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Joined </div>

																			<div class="profile-info-value">
																				<span>2010/06/20</span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Last Online </div>

																			<div class="profile-info-value">
																				<span>3 hours ago</span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> About Me </div>

																			<div class="profile-info-value">
																				<span>Bio</span>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="col-xs-12 col-sm-3">
																	<div class="space visible-xs"></div>
																	<h4 class="header blue lighter less-margin">Send a message to Alex</h4>

																	<div class="space-6"></div>

																	<form>
																		<fieldset>
																			<textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
																		</fieldset>

																		<div class="hr hr-dotted"></div>

																		<div class="clearfix">
																			<label class="pull-left">
																				<input type="checkbox" class="ace" />
																				<span class="lbl"> Email me a copy</span>
																			</label>

																			<button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
																				Submit
																				<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
																			</button>
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div><!-- /.span -->
								</div><!-- /.row -->
					<div class="clearfix form-actions" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
							<? if($_SESSION['login_level'] >= 99) { ?>
							<div class="col-xs-6 right" style="text-align:right">
								<button class="btn btn-danger" type="button" onclick="deleteSelect()">
									<i class="ace-icon fa fa-undo"></i>
									선택삭제
								</button>
							</div>
							<?}?>
						</div>
					</div>

<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>

			
			
<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

<!-- PAGING AND SUBMIT AREA BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

		</div>
	</div>
</div>


<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="searchTxt" id="searchTxt" value="" />
<input type="hidden" name="where" id="where" value=" where item_gb!='component'" />
<input type="hidden" name="item_gb" id="item_gb" value="" />
<!-- 체크된 항목들을 삭제하기 위한 입력필드 -->
<input type="hidden" name="check_uids" id="check_uids" />

<!-- basic script ------------------------------------------------------------------------------------------------------->

<?
require_once ("assets/include_script.php");
?>
<script type="text/javascript">
<!--
	/***************/
	//$('.show-details-btn').on('click', function(e) {
	$( document).on('click',".show-details-btn", function(e) {
		e.preventDefault();
		//var page = $("#page").val();
		//getLotno(page);
		$(this).closest('tr').next().toggleClass('open');
		$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
	});
	/***************/
//-->
</script>
<!----------------------------------------------------------------------------------------------------------------------->
<script>
$(document).ready(function(){
	var page = $("#page").val();
	getItem(page);

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
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	if(search_choice == "item_nm") {
		$("#where").val(" where item_nm like '%" + txt + "%' ");
	} else if(search_choice == "item_cd") {
		$("#where").val(" where item_cd like '%" + txt + "%' ");
	} else if(search_choice == "item_group_nm") {
		$("#where").val(" where item_group_nm like '%" + txt + "%' ");
	}
	getItem(1);
}

// 거래처 리스트 가져오기
function getItem(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/production.php",{"page":page, "mode":"getItem", "rpp" : rpp, "adjacents" : adjacents, "where": where},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					switch(json[i].item_gb) {
						case "component" : var item_gb = "자재"; break;
						case "semi_product" : var item_gb = "반제품"; break;
						case "product" : var item_gb = "완제품"; break;
						default : var item_gb = "미구분"; break;
					} 

					if(json[i].item_gb != "component") { // 원자재는 BOM 이 없으므로
						tag += "<tr>";
						<? if($_SESSION['login_level'] >= 99) { ?>
						tag += "<td class='center'>";
						tag += "<label class='pos-rel'>";
						tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
						tag += "<span class='lbl'></span>";
						tag += "</label>";
						tag += "</td>";
						<?}?>
						tag += "<td>" + item_gb + "</td>";
						tag += "<td class='center'>";
							tag += "<div class='action-buttons'>";
								tag += "<a href='#' class='green bigger-140 show-details-btn' title='Show Details'>";
									tag += "<i class='ace-icon fa fa-angle-double-down'></i>";
									tag += "<span class='sr-only'>Details</span>";
								tag += "</a>";
							tag += "</div>";
						tag += "</td>";
						tag += "<td>" + json[i].item_cd + "</td>";
						tag += "<td>" + json[i].item_nm + "</td>";
						tag += "<td>" + json[i].standard1 + "</td>";
						tag += "<td>" + json[i].standard2 + "</td>";
						tag += "<td>" + json[i].standard3 + "</td>";
						tag += "<td>" + json[i].cnt + "</td>";
						tag += "<td></td>";
						tag += "<td><input type='button' class='btn btn-xs' value='BOM등록' onclick='bom(" + json[i].uid + ")' /></td>";
						tag += "</tr>";

						tag += "<tr class='detail-row'>";
						tag += "<td colspan='8'>";
							tag += "<div class='table-detail'>";
								tag += "<div class='row'>";
									tag += "<div class='widget-body'>";
									tag += "<div class='widget-main no-padding'>";
										tag += "<table id='item_list' class='table  table-bordered table-striped'>";
											tag += "<thead class='thin-border-bottom'>";
												tag += "<tr>";
													tag += "<? if($_SESSION['login_level'] >= 99) { ?>";
													tag += "<th class='detail-col center'>";
														tag += "<label class='pos-rel'>";
															tag += "<input type='checkbox' class='ace' id='checkedAll' />";
															tag += "<span class='lbl'></span>";
														tag += "</label>";
													tag += "</th>";
													tag += "<?}?>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 구분</th>";
													tag += "<th class='col-xs-2'><i class='ace-icon fa fa-caret-right blue'></i> 품목코드</th>";
													tag += "<th class='col-xs-2'><i class='ace-icon fa fa-caret-right blue'></i> 품목명</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 규격</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 규격</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 규격</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> 원재료갯수</th>";
													tag += "<th class='col-xs-2'><i class='ace-icon fa fa-caret-right blue'></i> 파일관리</th>";
													tag += "<th class='col-xs-1'><i class='ace-icon fa fa-caret-right blue'></i> BOM등록</th>";
												tag += "</tr>";
											tag += "</thead>";
											tag += "<tbody></tbody>";
										tag += "</table>";
									tag += "</div>";
								tag += "</div>";
								tag += "</div>";
							tag += "</div>";
						tag += "</td>";
					tag += "</tr>";

					}
				}
			}

			$("#item_list tbody").html(tag);

			var table = "erp_item";
			getPaging(table,where,rpp,adjacents);
		}
	);
}


// 거래처 리스트 가져오기
function getLotno(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/production.php",{"page":page, "mode":"getItem", "rpp" : rpp, "adjacents" : adjacents, "where": where},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					switch(json[i].item_gb) {
						case "component" : var item_gb = "자재"; break;
						case "semi_product" : var item_gb = "반제품"; break;
						case "product" : var item_gb = "완제품"; break;
						default : var item_gb = "미구분"; break;
					} 

					if(json[i].item_gb != "component") { // 원자재는 BOM 이 없으므로
						tag += "<tr>";
						<? if($_SESSION['login_level'] >= 99) { ?>
						tag += "<td class='center'>";
						tag += "<label class='pos-rel'>";
						tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
						tag += "<span class='lbl'></span>";
						tag += "</label>";
						tag += "</td>";
						<?}?>
						tag += "<td>" + item_gb + "</td>";
						tag += "<td class='center'>";
							tag += "<div class='action-buttons'>";
								tag += "<a href='#' class='green bigger-140 show-details-btn' title='Show Details'>";
									tag += "<i class='ace-icon fa fa-angle-double-down'></i>";
									tag += "<span class='sr-only'>Details</span>";
								tag += "</a>";
							tag += "</div>";
						tag += "</td>";
						tag += "<td>" + json[i].item_cd + "</td>";
						tag += "<td>" + json[i].item_nm + "</td>";
						tag += "<td>" + json[i].standard1 + "</td>";
						tag += "<td>" + json[i].standard2 + "</td>";
						tag += "<td>" + json[i].standard3 + "</td>";
						tag += "<td>" + json[i].cnt + "</td>";
						tag += "<td></td>";
						tag += "<td><input type='button' class='btn btn-xs' value='BOM등록' onclick='bom(" + json[i].uid + ")' /></td>";
						tag += "</tr>";
					}
				}
			}

			$("#item_list tbody").html(tag);

			var table = "erp_item";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

function bom(uid) {
	location.href = "index.php?controller=production&action=inputPageBom&uid=" + uid;
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getItem(page);
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
	if(confirm("선택하신 BOM 정보를 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectBom&table=erp_item&uids=" + $("#check_uids").val();
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
					getItem(1);
				}
			}
		});
	}
}

// 거래처 구분으로 거래처 리스트 가져오기
function setItem(val) {
	var item_gb = $("#item_gb option:selected").val();

	if(item_gb == "all") {
		$("#where").val(" where item_gb<>'component'");
	} else {
		$("#where").val(" where item_gb='" + val + "'");
	} 
	getItem(1);
}
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-phone').mask('(999) 999-9999');
	$('.input-mask-mobile').mask('(999) 9999-9999');
	$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
	$(".input-mask-product").mask("a*-999-a999",{
		placeholder:" ",completed:
			function(){
				alert("You typed the following: "+this.val());
			}
	});

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
			$(this).find('.chosen-container').each(
				function(){
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
<!-- // basic script ------------------------------------------------------------------------------------------------------->