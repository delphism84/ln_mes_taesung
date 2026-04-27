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
				<li class="active">금형등록관리</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					금형등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						금형등록 관리에 대한 리스트를 보여드립니다.
					</small>
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="col-md-12">
					<div style="float:right">
						<div class="input-group col-xs-12 right" style="text-align:right">
							<button class="btn btn-info btn-xs" type="button" onclick="facilityManagement_reg('0','0')">
								<i class="ace-icon fa fa-check"></i>
								저장
							</button>
							<? if($_SESSION['login_level'] >= 99) { ?>
							<button class="btn btn-danger btn-xs" type="button" onclick="deleteSelect()">
								<i class="ace-icon fa fa-undo"></i>
								선택삭제
							</button>
							<?}?>
							<button class="btn btn-xs" type="button" onclick="excelSelect()">
								<i class="ace-icon fa fa-undo"></i>
								excle
							</button>
						</div>
					</div>
					</div>
				</div>
			</div>
			<div class="space-6"></div>
			<!--// 서브제목과 라인 -->
			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div class="widget-header">
						<div class="col-xs-6" style="float:left">
							<select id="per" onchange="getFacilityManagement(1)">
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
							<div class="col-xs-4"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="품목명" name="search_txt" id="search_txt" />
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
			<div class="row">
				<div class="col-xs-3">	
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="facility_management_list" class="table table-bordered table-striped">
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
										<th class="col-xs-5"><i class="ace-icon fa fa-caret-right blue"></i> 금형코드</th>
										<th class="col-xs-5"><i class="ace-icon fa fa-caret-right blue"></i> 금형명</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="vspace-6-sm"></div>
				<div class="col-xs-9">	
				<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
					<input type="hidden" name="controller" id="controller" value="mold" />
					<input type="hidden" name="action" id="action" value="insertPageMold" />
					<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />
					<input type="hidden" name="cntTotal" id="cntTotal" value="" />
					<input type="hidden" name="addCntTotal" id="addCntTotal" value="" />
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-bars smaller-90"></i>
							금형기본정보
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table class="table table-bordered table-striped no-padding table-condensed" >
								<thead class="thin-border-bottom">
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">금형코드</th>
									<td class="col-xs-3">
										<input name="mold_cd" id="mold_cd" type="text" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">공장</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="warehouse_cd" id="warehouse_cd" readonly />
													<input type="text" name="warehouse_nm" id="warehouse_nm" onclick="moldPopup('1')" readonly />
													<span class="input-group-addon btn-purple" onclick="moldPopup('1')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">길이</th>
									<td class="col-xs-3">
										<input type="text" name="m_length" id="m_length"  />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">금형명</th>
									<td class="col-xs-3">
										<input name="mold_nm" id="mold_nm" type="text" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">공정</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="process_cd" id="process_cd" readonly />
													<input type="text" name="process_nm" id="process_nm" onclick="moldPopup('2')" readonly />
													<span class="input-group-addon btn-purple" onclick="moldPopup('2')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">폭</th>
									<td class="col-xs-3">
										<input type="text" name="m_width" id="m_width"  />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">규격</th>
									<td class="col-xs-3">
										<input name="m_unit" id="m_unit" type="text" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">작업장</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="workings_cd" id="workings_cd" readonly />
													<input type="text" name="workings_nm" id="workings_nm" onclick="moldPopup('3')" readonly />
													<span class="input-group-addon btn-purple" onclick="moldPopup('3')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">높이</th>
									<td class="col-xs-3">
										<input type="text" name="m_height" id="m_height"  />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">모델</th>
									<td class="col-xs-3">
										<input name="m_model" id="m_model" type="text" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">설비</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="machine_cd" id="machine_cd" readonly />
													<input type="text" name="machine_nm" id="machine_nm" onclick="moldPopup('4')" readonly />
													<span class="input-group-addon btn-purple" onclick="moldPopup('4')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">경도</th>
									<td class="col-xs-3">
										<input type="text" name="m_pressure" id="m_pressure"  />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">금형그룹</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="mold_group_cd" id="mold_group_cd" readonly />
													<input type="text" name="mold_group_nm" id="mold_group_nm" />
													<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/productGroupList.php', '품목그룹리스트', 500, 500,'','auto')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
													<span class="input-group-addon btn-danger" onclick="centerOpenWindow('views/popup/createProductGroup.php', '품목그룹리스트', 500, 300)">
														<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">부서</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="department_cd" id="department_cd" readonly />
													<input type="text" name="department_nm" id="department_nm" onclick="moldPopup('5')" readonly />
													<span class="input-group-addon btn-purple" onclick="moldPopup('5')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">중량</th>
									<td class="col-xs-3">
										<input type="text" name="m_weight" id="m_weight"  />
									</td>
								</tr>
								
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">금형위치</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="mold_location_cd" id="mold_location_cd" readonly />
													<input type="text" name="mold_location_nm" id="mold_location_nm" onclick="moldPopup('5')" readonly />
													<span class="input-group-addon btn-purple" onclick="moldPopup('5')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">사원</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="emp_id" id="emp_id" readonly />
													<input type="text" name="emp_nm" id="emp_nm" onclick="moldPopup('6')" readonly />
													<span class="input-group-addon btn-purple" onclick="moldPopup('6')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">재질</th>
									<td class="col-xs-3">
										<input type="text" name="m_material" id="m_material"  />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">금형유형</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="mold_type_cd" id="mold_type_cd" readonly />
													<input type="text" name="mold_type_nm" id="mold_type_nm" />
													<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/productGroupList.php', '품목그룹리스트', 500, 500,'','auto')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
													<span class="input-group-addon btn-danger" onclick="centerOpenWindow('views/popup/createProductGroup.php', '품목그룹리스트', 500, 300)">
														<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">담당자</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="manager_cd" id="manager_cd" readonly />
													<input type="text" name="manager_nm" id="manager_nm" onclick="moldPopup('7')" readonly />
													<span class="input-group-addon btn-purple" onclick="moldPopup('7')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">CAVITA</th>
									<td class="col-xs-3">
										<input type="text" name="CAVITA" id="CAVITA"  />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">금형구분</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="mod_divide_cd" id="mold_divide_cd" readonly />
													<input type="text" name="mold_divide_nm" id="mold_divide_nm" />
													<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/productGroupList.php', '품목그룹리스트', 500, 500,'','auto')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
													<span class="input-group-addon btn-danger" onclick="centerOpenWindow('views/popup/createProductGroup.php', '품목그룹리스트', 500, 300)">
														<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">관리번호</th>
									<td class="col-xs-3">
										<input type="text" name="m_manage_number" id="m_manage_number"  />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">유효타수</th>
									<td class="col-xs-3">
										<input type="text" name="valid_hit_count" id="valid_hit_count"  />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">금형등급</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="mold_class_cd" id="mold_class_cd" readonly />
													<input type="text" name="mold_class_nm" id="mold_class_nm" />
													<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/productGroupList.php', '품목그룹리스트', 500, 500,'','auto')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
													<span class="input-group-addon btn-danger" onclick="centerOpenWindow('views/popup/createProductGroup.php', '품목그룹리스트', 500, 300)">
														<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">도면번호</th>
									<td class="col-xs-3">
										<input type="text" name="drawing_number" id="drawing_number"  />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">환산계수</th>
									<td class="col-xs-3">
										<input type="text" name="conversion_factor " id="conversion_factor "  />
									</td>
								</tr>
								
								<tr>

									<th class="col-xs-1" style="background-color:#f1f1f1">금형상태</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="mold_state_cd" id="mold_state_cd" readonly />
													<input type="text" name="mold_state_nm" id="mold_state_nm" />
													<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/productGroupList.php', '품목그룹리스트', 500, 500,'','auto')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
													<span class="input-group-addon btn-danger" onclick="centerOpenWindow('views/popup/createProductGroup.php', '품목그룹리스트', 500, 300)">
														<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">사용여부</th>
									<td class="col-xs-3">
										<label class="pl-1">
											<input name="use_yn" id="use_yn" class="ace ace-switch ace-switch-5" type="checkbox"  value='Y' type="checkbox" />
											<span class="lbl"></span>
										</label>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">입력구분</th>
									<td class="col-xs-3">
										<input type="text" name="p_input_gubun" id="p_input_gubun"  />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">비고</th>
									<td class="col-xs-11" colspan="5">
										<textarea id="remark" name="remark" class="form-control"></textarea>
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">이미지첨부</th>
									<td class="col-xs-11" colspan="5" >
										<input type="file" name="attach" id="attach" style='margin:5px 5px 5px 5px'/>
										<input type="file" name="attach" id="attach" style='margin:5px 5px 5px 5px'/>
										<input type="file" name="attach" id="attach" style='margin:5px 5px 5px 5px'/>
									</td>
								</tr>
								</thead>
							</table>
						</div>
					</div>
					<div class="space-6"></div>
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-bars smaller-90"></i>
							금형제작정보
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table class="table table-bordered table-striped no-padding table-condensed">
								<thead class="thin-border-bottom">
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">계약거래처</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="contract_account_cd" id="contract_account_cd" readonly />
													<input type="text" name="contract_account_nm" id="contract_account_nm" />
													<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/productGroupList.php', '품목그룹리스트', 500, 500,'','auto')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
													<span class="input-group-addon btn-danger" onclick="centerOpenWindow('views/popup/createProductGroup.php', '품목그룹리스트', 500, 300)">
														<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">제작거래처</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="product_account_cd" id="product_account_cd" readonly />
													<input type="text" name="product_account_nm" id="product_account_nm" />
													<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/productGroupList.php', '품목그룹리스트', 500, 500,'','auto')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
													<span class="input-group-addon btn-danger" onclick="centerOpenWindow('views/popup/createProductGroup.php', '품목그룹리스트', 500, 300)">
														<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">소유거래처</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="owner_account_cd" id="owner_account_cd" readonly />
													<input type="text" name="owner_account_nm" id="owner_account_nm" />
													<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/productGroupList.php', '품목그룹리스트', 500, 500,'','auto')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
													<span class="input-group-addon btn-danger" onclick="centerOpenWindow('views/popup/createProductGroup.php', '품목그룹리스트', 500, 300)">
														<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">계약일자</th>
									<td class="col-xs-3">
										<div>
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" name="contract_dt" id="contract_dt" type="text" value=<?=date('Y/m/d')?> data-date-format="yyyy/mm/dd" />
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">제작일자</th>
									<td class="col-xs-3">
										<div>
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" name="product_dt" id="product_dt" type="text" value=<?=date('Y/m/d')?> data-date-format="yyyy/mm/dd" />
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">자산번호</th>
									<td class="col-xs-3">
										<input type="text" name="assets_number" id="assets_number" />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">계약금액</th>
									<td class="col-xs-3">
										<input type="text" name="contract_price" id="contract_price" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">제작금액</th>
									<td class="col-xs-3">
										<input type="text" name="product_price" id="product_price" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">내용년수</th>
									<td class="col-xs-3">
										<input type="text" name="durable_years" id="durable_years" />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">계약수명</th>
									<td class="col-xs-3">
										<input type="text" name="contract_life" id="contract_life" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">제작수명</th>
									<td class="col-xs-3">
										<input type="text" name="product_life" id="product_life" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">폐기일자</th>
									<td class="col-xs-3">
										<div>
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" name="scrap_dt" id="scrap_dt" type="text" value=<?=date('Y/m/d')?> data-date-format="yyyy/mm/dd" />
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">계약번호</th>
									<td class="col-xs-3">
										<input type="text" name="contract_number" id="contract_number" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">제작번호</th>
									<td class="col-xs-3">
										<input type="text" name="product_number" id="product_number" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1">폐기번호</th>
									<td class="col-xs-3">
										<input type="text" name="scrap_number" id="scrap_number" />
									</td>
								</tr>
								</thead>
							</table>
						</div>
					</div>
					</form>

					<div class="space-6"></div>
					<div class="row">
						<div class="col-xs-12">
							<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active">
										<a data-toggle="tab" href="#items">
											<i class="green ace-icon fa fa-home bigger-120"></i>
											구성품목
											<span class="badge badge-danger">14</span>
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#moldhistory">
											금형이력
											<span class="badge badge-danger">4</span>
										</a>
									</li>

									<li class="dropdown">
										<a data-toggle="tab" href="#fileimage">
											파일/이미지 &nbsp;
											<span class="badge badge-danger">34</span>
										</a>
									</li>
								</ul>

								<div class="tab-content">
									<div id="items" class="tab-pane fade in active">
										<!-- <div class="widget-header widget-header-flat">
											<h4 class="widget-title smaller">
												<i class="ace-icon fa fa-bars smaller-90"></i>
												구성품목
											</h4>
										</div> -->
										<div class="widget-body">
											<div class="widget-main no-padding">
												<table id="warehousing_item" class="table  table-bordered table-hover" style="margin-top:10px">
												<thead>
													<tr>
														<th class="detail-col center" style="background-color:#f1f1f1"></th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">금형코드</th>
														<th class="center col-xs-2" style="background-color:#f1f1f1">금형명</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">제작일</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">등록일</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1;">공정</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1;">설비</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">금형유형</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">금형상태</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">담당자</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">유효타수</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">사용여부</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td colspan='14' class='center'>등록된 품목이 없습니다.</td>
													</tr>
												</tbody>
												<tfoot>
													
												<tfoot>			
											</table>
											</div>
										</div>
									</div>

									<div id="moldhistory" class="tab-pane fade">
										<!-- <div class="widget-header widget-header-flat">
											<h4 class="widget-title smaller">
												<i class="ace-icon fa fa-bars smaller-90"></i>
												금형이력정보
											</h4>
										</div> -->
										<div class="widget-body">
											<div class="widget-main no-padding">
												<table id="warehousing_item" class="table  table-bordered table-hover" style="margin-top:10px">
												<thead>
													<tr>
														<th class="detail-col center" style="background-color:#f1f1f1"></th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">금형코드</th>
														<th class="center col-xs-2" style="background-color:#f1f1f1">금형명</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">제작일</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">등록일</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1;">공정</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1;">설비</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">금형유형</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">금형상태</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">담당자</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">유효타수</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">사용여부</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td colspan='14' class='center'>등록된 품목이 없습니다.</td>
													</tr>
												</tbody>
												<tfoot>
													
												<tfoot>			
											</table>
											</div>
										</div>
									</div>

									<div id="fileimage" class="tab-pane fade">
										<!-- <div class="widget-header widget-header-flat">
											<h4 class="widget-title smaller">
												<i class="ace-icon fa fa-bars smaller-90"></i>
												파일/이미지
											</h4>
										</div> -->
										<div class="widget-body">
											<div class="widget-main no-padding">
												<table id="warehousing_item" class="table  table-bordered table-hover" style="margin-top:10px">
												<thead>
													<tr>
														<th class="detail-col center" style="background-color:#f1f1f1"></th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">금형코드</th>
														<th class="center col-xs-2" style="background-color:#f1f1f1">금형명</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">제작일</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">등록일</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1;">공정</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1;">설비</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">금형유형</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">금형상태</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">담당자</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">유효타수</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">사용여부</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td colspan='14' class='center'>등록된 품목이 없습니다.</td>
													</tr>
												</tbody>
												<tfoot>
													
												<tfoot>			
											</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->

					<div class="space-6"></div>
					
					<div class="space-6"></div>
				</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="clearfix form-actions" style="margin-top:0px">
						<div class="col-md-12">
							<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
							<div class="col-xs-6 right" style="text-align:right">
								<button class="btn btn-info" type="button" onclick="facilityManagement_reg('0','0')">
									<i class="ace-icon fa fa-check"></i>
									저장
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
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="page" id="page" value="1" />
<!-- <input type="hidden" name="where" id="where" value=" where used='n'" /> -->
<input type="hidden" name="check_uids" id="check_uids" />

<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:70%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">생산설비가동등록</h4>

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
                 <h4 class="modal-title">생산설비가동수정</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="product_output_modify_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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

<!-- /.modal -->
<div id="id-btn-dialog4" class="modal fade" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title"></h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="mold_frame" frameborder="0" width="99%" height="370" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
	getFacilityManagement(page);

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

// 설비가동 리스트 가져오기
function getFacilityManagement(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/facilities.php",{"page":page, "mode":"getFacilityManagement", "rpp" : rpp, "adjacents" : adjacents, "where" : where},
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
					tag += "<td><a href='javascript:void(0);'  onclick='facilityManagement_modiy(" + json[i].uid +")' >" + json[i].facilities_dt + "</a></td>";
					tag += "<td>" + json[i].day_gubun + "</a></td>";
					tag += "<td>" + json[i].machine_cd + "</a></td>";
					tag += "<td>" + json[i].machine_nm + "</a></td>";
					tag += "<td>"+ json[i].model_no + "</a></td>";
					tag += "<td class='text-right'>"+ json[i].office_hours + "</a></td>";
					tag += "<td class='text-right'>" + json[i].f_work_tm + "</td>";
					tag += "<td class='text-right'>" + json[i].f_off_tm + "</td>";
					tag += "<td >" + json[i].f_off_type + "</td>";
					tag += "<td class='text-right'>" + json[i].operation_rate + "%</td>";
					tag += "<td class='text-right'>" + json[i].p_content + "</td>";
					tag += "<td class='center'>" + json[i].a_content + "</td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='13' class='center' style='height:20px'> 등록된 설비가동 데이터가 없습니다. </td>";
				tag += "</tr>";
			}

			$("#facility_management_list tbody").html(tag);

			var table = "erp_facility_management";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getFacilityManagement(page);
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
	if(confirm("선택하신 실적처리 정보를 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		var dataString = "mode=deleteSelectFacilityManagement&table=erp_facility_management&uids=" + $("#check_uids").val();
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
					getFacilityManagement(1);
				}
			}
		});
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
	function facilityManagement_reg(cidx, acd)
	{
	$("#id-btn-dialog1").modal({
		show: true,
		title : "생산설비가동",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=facilities&action=registPageFacilityManagement&idx="+cidx+"&pop=Y&aci_cd="+acd+"&dialogID=id-btn-dialog1";
	$("#product_output_reg_frame").attr("src", url);
	}
			
	function facilityManagement_modiy(uid)
	{
	$("#id-btn-dialog2").modal({
		show: true,
		title : "생산설비가동",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	//$(".modal-title").html(tt);
	var url = "index.php?controller=facilities&action=modifyPageFacilityManagement&pop=Y&uid="+uid+"&dialogID=id-btn-dialog2";
	$("#product_output_modify_frame").attr("src", url);
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
	}else if (src=="2"){
		var src_url="views/popup/processListPutAny.php?";
		$(".modal-title").html('공정검색');
		$('.modal-dialog').css({ height:"400px", width:"400px" }).show();
	}else if (src=="3"){
		var src_url="views/popup/warehouseListPutAny.php?cd=workings_cd&nm=workings_nm";
		$(".modal-title").html('작업장검색');
		$('.modal-dialog').css({ height:"400px", width:"400px" }).show();
	}else if (src=="4"){
			var src_url="views/popup/machineListPutAny.php?";
		$(".modal-title").html('설비검색');
		$('.modal-dialog').css({ height:"400px", width:"800px" }).show();
	}else if (src=="5"){
			var src_url="views/popup/departmentListPut.php?";
		$(".modal-title").html('부서검색');
		$('.modal-dialog').css({ height:"400px", width:"800px" }).show();
	}else if (src=="6"){
			var src_url="views/popup/employeeListPutAny.php?";
		$(".modal-title").html('사원검색등록');
		$('.modal-dialog').css({ height:"400px", width:"700px" }).show();
	}else if (src=="7"){
			var src_url="views/popup/employeeListPutAny.php?cd=workings_cd&nm=workings_nm";
		$(".modal-title").html('담당자검색');
		$('.modal-dialog').css({ height:"400px", width:"700px" }).show();
	}else if (src=="1"){
			var src_url="views/popup/warehouseListPut.php";
		$(".modal-title").html('공장등록');
		$('.modal-dialog').css({ height:"200px", width:"400px" }).show();
	}else if (src=="1"){
			var src_url="views/popup/warehouseListPut.php";
		$(".modal-title").html('공장등록');
		$('.modal-dialog').css({ height:"200px", width:"400px" }).show();
	}else if (src=="1"){
			var src_url="views/popup/warehouseListPut.php";
		$(".modal-title").html('공장등록');
		$('.modal-dialog').css({ height:"200px", width:"400px" }).show();
	}else if (src=="1"){
			var src_url="views/popup/warehouseListPut.php";
		$(".modal-title").html('공장등록');
		$('.modal-dialog').css({ height:"200px", width:"400px" }).show();
	}else if (src=="1"){
			var src_url="views/popup/warehouseListPut.php";
		$(".modal-title").html('공장등록');
		$('.modal-dialog').css({ height:"200px", width:"400px" }).show();
	}else if (src=="1"){
			var src_url="views/popup/warehouseListPut.php";
		$(".modal-title").html('공장등록');
		$('.modal-dialog').css({ height:"200px", width:"400px" }).show();
	}else{
		$('.modal-dialog').css({ height:"200px", width:"800px" }).show();
	}
	
	var url = src_url+"&pop=Y&dialogID=id-btn-dialog4";
	
	$("#mold_frame").attr("src", url);
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