<div class="main-content" style="overflow-x:hidden; overflow-y:auto;">
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
							<button class="btn btn-info btn-xs" type="button" onclick="formSubmit()">
								<i class="ace-icon fa fa-check"></i>
								<span id="text1">저장</span>
							</button>
							<? if($_SESSION['login_level'] >= 99) { ?>
							<button class="btn btn-danger btn-xs" type="button" onclick="deleteSelect()">
								<i class="ace-icon fa fa-undo"></i>
								선택삭제
							</button>
							<?}?>
							<button class="btn btn-success btn-xs" type="button" onclick="javascript:location.reload()">
								<i class="ace-icon fa fa-check"></i>
								<span id="text1">신규등록</span>
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
			<div class="widget-header widget-header-flat">
				<h4 class="widget-title smaller">
					<i class="ace-icon fa fa-bars smaller-90"></i>
					상세검색
				</h4>
			</div>
			<div class="row">
				<div class="col-xs-3">	
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table id="mold_list" class="table table-bordered table-striped">
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
										<th class="col-xs-6"><i class="ace-icon fa fa-caret-right blue"></i> 금형명</th>
									</tr>
								</thead>
								<tbody style="border-bottom: 1px solid #dddddd"></tbody>
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
					<input type="hidden" name="uid" id="uid" value="" />
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-pencil-square-o smaller-90"></i>
							금형기본정보
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table class="table table-bordered table-striped no-padding table-condensed" >
								<thead class="thin-border-bottom">
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 금형코드</th>
									<td class="col-xs-3">
										<input name="mold_cd" id="mold_cd" type="text" required /> 자동생성<label for="mold_cd" style="display:none;">금형코드를 입력하세요.</label>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 공장</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="warehouse_cd" id="warehouse_cd" readonly />
													<input type="text" name="warehouse_nm" id="warehouse_nm" onclick="moldPopup('1')" required readonly /> <label for="warehouse_nm" style="display:none;">공장을 입력하세요.</label>
													<span class="input-group-addon btn-purple" onclick="moldPopup('1')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 길이</th>
									<td class="col-xs-3">
										<input type="text" name="m_length" id="m_length" class="text-right" onkeydown="fn_press_han(this);"/>
										<select name="m_length_unit" id="m_length_unit">
											<option value="MM">MM</option>
											<option value="CM" selected>CM</option>
											<option value="KM">KM</option>
										</select>
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 금형명</th>
									<td class="col-xs-3">
										<input name="mold_nm" id="mold_nm" type="text" required/><label for="mold_nm" style="display:none;">금형명을 입력하세요.</label>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 공정</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="process_cd" id="process_cd" readonly />
													<input type="text" name="process_nm" id="process_nm" onclick="moldPopup('2')" required readonly /><label for="process_nm" style="display:none;">공정을 입력하세요.</label>
													<span class="input-group-addon btn-purple" onclick="moldPopup('2')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 폭</th>
									<td class="col-xs-3">
										<input type="text" name="m_width" id="m_width"  class="text-right" onkeydown="fn_press_han(this);"/>
										<select name="m_width_unit" id="m_width_unit">
											<option value="MM">MM</option>
											<option value="CM" selected>CM</option>
											<option value="KM">KM</option>
										</select>
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 규격</th>
									<td class="col-xs-3">
										<input name="m_unit" id="m_unit" type="text" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 작업장</th>
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
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 높이</th>
									<td class="col-xs-3">
										<input type="text" name="m_height" id="m_height" class="text-right" onkeydown="fn_press_han(this);"/>
										<select name="m_height_unit" id="m_height_unit">
											<option value="MM">MM</option>
											<option value="CM" selected>CM</option>
											<option value="KM">KM</option>
										</select>
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 모델</th>
									<td class="col-xs-3">
										<input name="m_model" id="m_model" type="text" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 설비</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="machine_cd" id="machine_cd" readonly />
													<input type="text" name="machine_nm" id="machine_nm" onclick="moldPopup('4')" required readonly />  <label for="machine_nm" style="display:none;">설비를 입력하세요.</label>
													<span class="input-group-addon btn-purple" onclick="moldPopup('4')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 경도</th>
									<td class="col-xs-3">
										<input type="text" name="m_pressure" id="m_pressure" class="text-right" onkeydown="fn_press_han(this);"/>
										<select name="m_pressure_unit" id="m_pressure_unit">
											<option value="MG" selected>MG</option>
											<option value="KG">KG</option>
											<option value="KT">KT</option>
										</select>
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 금형그룹</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="mold_group_cd" id="mold_group_cd" readonly />
													<input type="text" name="mold_group_nm" id="mold_group_nm" required readonly/> <label for="mold_group_nm" style="display:none;">금형그룹을 입력하세요.</label>
													<span class="input-group-addon btn-purple" onclick="moldPopup('8')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
													<span class="input-group-addon btn-danger" onclick="moldPopup('9')">
														<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 부서</th>
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
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 중량</th>
									<td class="col-xs-3">
										<input type="text" name="m_weight" id="m_weight" class="text-right" onkeydown="fn_press_han(this);"/>
										<select name="m_weight_unit" id="m_weight_unit">
											<option value="MG" selected>MG</option>
											<option value="KG">KG</option>
											<option value="KT">KT</option>
										</select>
									</td>
								</tr>
								
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 금형위치</th>
									<td class="col-xs-3">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="mold_location_cd" id="mold_location_cd" readonly />
												<input type="text" name="mold_location_nm" id="mold_location_nm" required readonly/> <label for="mold_location_nm" style="display:none;">금형위치를 입력하세요.</label>
												<span class="input-group-addon btn-purple" onclick="moldPopup('10')">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												<span class="input-group-addon btn-danger" onclick="moldPopup('11')">
													<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 사원</th>
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
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 재질</th>
									<td class="col-xs-3">
										<input type="text" name="m_material" id="m_material" />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 금형유형</th>
									<td class="col-xs-3">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="mold_type_cd" id="mold_type_cd" readonly />
												<input type="text" name="mold_type_nm" id="mold_type_nm" required readonly/> <label for="mold_type_nm" style="display:none;">금형유형를 입력하세요.</label>
												<span class="input-group-addon btn-purple" onclick="moldPopup('12')">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												<span class="input-group-addon btn-danger" onclick="moldPopup('13')">
													<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 담당자</th>
									<td class="col-xs-3">
										<div class="input-group">
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input type="hidden" name="manager_cd" id="manager_cd" readonly />
													<input type="text" name="manager_nm" id="manager_nm" onclick="moldPopup('7')" required readonly /> <label for="manager_nm" style="display:none;">담당자를 입력하세요.</label>
													<span class="input-group-addon btn-purple" onclick="moldPopup('7')">
														<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> CAVITA</th>
									<td class="col-xs-3">
										<input type="text" name="CAVITA" id="CAVITA" class="text-right" />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 금형구분</th>
									<td class="col-xs-3">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="mold_divide_cd" id="mold_divide_cd" readonly />
												<input type="text" name="mold_divide_nm" id="mold_divide_nm" required readonly/> <label for="mold_divide_nm" style="display:none;">금형구분를 입력하세요.</label>
												<span class="input-group-addon btn-purple" onclick="moldPopup('14')">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												<span class="input-group-addon btn-danger" onclick="moldPopup('15')">
													<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 관리번호</th>
									<td class="col-xs-3">
										<input type="text" name="m_manage_number" id="m_manage_number"  />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 유효타수</th>
									<td class="col-xs-3">
										<input type="text" name="valid_hit_count" id="valid_hit_count" class="text-right" onkeyup='input_comma(this);' required /> <label for="valid_hit_count" style="display:none;">유효타수를 입력하세요.</label>
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 금형등급</th>
									<td class="col-xs-3">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="mold_class_cd" id="mold_class_cd" readonly />
												<input type="text" name="mold_class_nm" id="mold_class_nm" required readonly/> <label for="mold_class_nm" style="display:none;">금형등급을 입력하세요.</label>
												<span class="input-group-addon btn-purple" onclick="moldPopup('16')">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												<span class="input-group-addon btn-danger" onclick="moldPopup('17')">
													<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 도면번호</th>
									<td class="col-xs-3">
										<input type="text" name="drawing_number" id="drawing_number"  />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 환산계수</th>
									<td class="col-xs-3">
										<input type="text" name="conversion_factor" id="conversion_factor" class="text-right" onkeydown="fn_press_han(this);" />
									</td>
								</tr>
								
								<tr>

									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 금형상태</th>
									<td class="col-xs-3">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="mold_state_cd" id="mold_state_cd" readonly />
												<input type="text" name="mold_state_nm" id="mold_state_nm" required readonly/> <label for="mold_state_nm" style="display:none;">금형상태를 입력하세요.</label>
												<span class="input-group-addon btn-purple" onclick="moldPopup('18')">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												<span class="input-group-addon btn-danger" onclick="moldPopup('19')">
													<i class="ace-icon fa fa-plus icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 사용여부</th>
									<td class="col-xs-3">
										<label class="pl-1">
											<input name="use_yn" id="use_yn" class="ace ace-switch ace-switch-5" type="checkbox"  value='Y' type="checkbox" />
											<span class="lbl"></span>
										</label>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 입력구분</th>
									<td class="col-xs-3">
										<input type="text" name="p_input_gubun" id="p_input_gubun"  />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 비고</th>
									<td class="col-xs-11" colspan="5">
										<textarea id="remark" name="remark" class="form-control"></textarea>
									</td>
								</tr>
								</thead>
							</table>
						</div>
					</div>
					<div class="space-6"></div>
					<div class="widget-header widget-header-flat" style="border-top: 1px solid #dddddd">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-pencil-square-o  smaller-90"></i>
							금형제작정보
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<table class="table table-bordered table-striped no-padding table-condensed">
								<thead class="thin-border-bottom">
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 계약거래처</th>
									<td class="col-xs-3">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="contract_account_cd" id="contract_account_cd" readonly />
												<input type="text" name="contract_account_nm" id="contract_account_nm" onclick="moldPopup('20')" readonly />
												<span class="input-group-addon btn-purple" onclick="moldPopup('20')">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 제작거래처</th>
									<td class="col-xs-3">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="product_account_cd" id="product_account_cd" readonly />
												<input type="text" name="product_account_nm" id="product_account_nm" onclick="moldPopup('21')" required readonly/> <label for="product_account_nm" style="display:none;">제작거래처를 입력하세요.</label>
												<span class="input-group-addon btn-purple" onclick="moldPopup('21')">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 소유거래처</th>
									<td class="col-xs-3">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="owner_account_cd" id="owner_account_cd" readonly />
												<input type="text" name="owner_account_nm" id="owner_account_nm" onclick="moldPopup('22')" readonly />
												<span class="input-group-addon btn-purple" onclick="moldPopup('22')">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 계약일자</th>
									<td class="col-xs-3">
										<div>
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" name="contract_dt" id="contract_dt" type="text" value=<?=date('Y/m/d')?> data-date-format="yyyy/mm/dd" readonly/>
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 제작일자</th>
									<td class="col-xs-3">
										<div>
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" name="product_dt" id="product_dt" type="text" value=<?=date('Y/m/d')?> data-date-format="yyyy/mm/dd" required readonly/> <label for="product_dt" style="display:none;">제작일자를 입력하세요.</label>
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 자산번호</th>
									<td class="col-xs-3">
										<input type="text" name="assets_number" id="assets_number" />
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 계약금액</th>
									<td class="col-xs-3">
										<input type="text" name="contract_price" id="contract_price" class="text-right" onkeyup="input_comma(this)"/>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i>제작금액</th>
									<td class="col-xs-3">
										<input type="text" name="product_price" id="product_price" class="text-right" onkeyup="input_comma(this)" required /> <label for="product_price" style="display:none;">제작금액을 입력하세요.</label>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 내용년수</th>
									<td class="col-xs-3">
										<input type="text" name="durable_years" id="durable_years" class="text-right" required /> <label for="durable_years" style="display:none;">내용년수를 입력하세요.</label>
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 계약수명</th>
									<td class="col-xs-3">
										<input type="text" name="contract_life" id="contract_life" class="text-right" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 제작수명</th>
									<td class="col-xs-3">
										<input type="text" name="product_life" id="product_life" class="text-right" required /> <label for="product_life" style="display:none;">제작수명을 입력하세요.</label>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 폐기일자</th>
									<td class="col-xs-3">
										<div>
											<span class="input-icon input-icon-right">
												<div class="input-group">
													<input class=" date-picker" name="scrap_dt" id="scrap_dt" type="text" value=<?=date('Y/m/d')?> data-date-format="yyyy/mm/dd"  readonly /> 
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</span>
										</div>
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 계약번호</th>
									<td class="col-xs-3">
										<input type="text" name="contract_number" id="contract_number" />
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 제작번호</th>
									<td class="col-xs-3">
										<input type="text" name="product_number" id="product_number"  required /> <label for="product_number" style="display:none;">제작번호를 입력하세요.</label>
									</td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 폐기번호</th>
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
											금형부품
											<span class="badge badge-danger item">0</span>
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#moldrepair">
											금형이력
											<span class="badge badge-danger repair">0</span>
										</a>
									</li>

									<li class="dropdown">
										<a data-toggle="tab" href="#fileimage">
											도면문서/이미지 &nbsp;
											<span class="badge badge-danger files">0</span>
										</a>
									</li>
								</ul>

								<div class="tab-content">
									<div id="items" class="tab-pane fade in active">
										<div class="widget-body">
											<div class="widget-main no-padding">
												<div class="input-group col-xs-12 left" style="text-align:left">
													<!-- <button class="btn btn-success btn-xs" type="button" onclick="centerOpenWindow('views/popup/moldItemInsert.php', '금형부품리스트', 1000, 250)"> -->
													<button class="btn btn-success btn-xs" type="button" onclick="mold_item_reg()">
														<i class="ace-icon fa fa-check"></i>
														<span id="text1">품목등록</span> 
													</button>
													<!-- <button class="btn btn-info btn-xs" type="button" onclick="formItemSubmit()">
														<i class="ace-icon fa fa-check"></i>
														<span id="text1">저장</span>
													</button> -->
													<button class="btn btn-danger btn-xs" type="button" onclick="deleteSelectItem()">
														<i class="ace-icon fa fa-undo"></i>
														선택삭제
													</button>
												</div>
												<form name="frmMold" id="frmMold" method="post" action="index.php" enctype="multipart/form-data">
												<input type="hidden" name="controller" id="controller" value="mold" />
												<input type="hidden" name="action" id="action" value="insertPageMoldItem" />
												<input type="hidden" name="mode" id="mode" value="insertPageMoldItem" />
												<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />
												<input type="hidden" name="fid" id="fid" value="<?=$uid?>" />
												<input type="hidden" name="m_cd" id="m_cd" value="" />
												<div class="row top5"> </div>
												<table id="mold_item_list" class="table  table-bordered table-hover " style="margin-top:10px;border-top: 1px solid #dddddd">
												<thead class="thin-border-bottom">
													<tr>
														<? if($_SESSION['login_level'] >= 99) { ?>
														<th class="detail-col center">
															<label class="pos-rel">
																<input type="checkbox" class="ace" id="checkedAllItem" />
																<span class="lbl"></span>
															</label>
														</th>
														<?}?>
														<th class="center col-xs-1" style="background-color:#f1f1f1">품목코드</th>
														<th class="center col-xs-3" style="background-color:#f1f1f1">품목명</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">규격</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">재질</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">단위</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">수량</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">유효타수</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1;">품목구분</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1;">품목그룹</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">비고</th>
													</tr>
												</thead>
												<tbody style="border-bottom: 1px solid #dddddd">
													<tr>
													<td colspan='11' class='center'>등록된 금형품목이 없습니다.</td>
													</tr>
												</tbody>
												<tfoot >
												<tfoot>
												</table>
												</form>	
											</div>
										</div>
									</div>

									<div id="moldrepair" class="tab-pane fade">
										<div class="widget-body">
											<div class="widget-main no-padding">
												<div class="input-group col-xs-12 left" style="text-align:left">
													<!-- <button class="btn btn-danger btn-xs" type="button" onclick="deleteSelectRepair()">
														<i class="ace-icon fa fa-undo"></i>
														선택삭제
													</button> -->
												</div>
												<form name="frmMoldHis" id="frmMoldHis" method="post" action="index.php" enctype="multipart/form-data">
												<input type="hidden" name="controller" id="controller" value="mold" />
												<input type="hidden" name="action" id="action" value="insertPageMoldRepair" />
												<input type="hidden" name="mode" id="mode" value="insertPageMoldRepair" />
												<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />
												<input type="hidden" name="fid" id="fid" value="<?=$uid?>" />
												<div class="row top5"> </div>
												<table id="mold_repair_list" class="table  table-bordered table-hover " style="margin-top:10px;border-top: 1px solid #dddddd">
												<thead class="thin-border-bottom">
													<tr>
														<? if($_SESSION['login_level'] >= 99) { ?>
														<th class="detail-col center">
															<label class="pos-rel">
																<input type="checkbox" class="ace" id="checkedAllItem" />
																<span class="lbl"></span>
															</label>
														</th>
														<?}?>
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
													</tr>
												</thead>
												<tbody style="border-bottom: 1px solid #dddddd">
													<tr>
													<td colspan='11' class='center'>등록된 금형품목이 없습니다.</td>
													</tr>
												</tbody>
												<tfoot >
												<tfoot>
												</table>
												</form>	
											</div>
										</div>
									</div>

									<div id="fileimage" class="tab-pane fade">
										<div class="widget-body">
											<div class="widget-main no-padding">
												<div class="input-group col-xs-12 left" style="text-align:left">
													<button class="btn btn-success btn-xs" type="button" onclick="mold_file_reg()">
														<i class="ace-icon fa fa-check"></i>
														<span id="text1">파일등록</span>
													</button>
													<button class="btn btn-danger btn-xs" type="button" onclick="deleteSelectFile()">
														<i class="ace-icon fa fa-undo"></i>
														선택삭제
													</button>
												</div>
												<form name="frmMoldfile" id="frmMoldfile" method="post" action="index.php" enctype="multipart/form-data">
												<input type="hidden" name="controller" id="controller" value="mold" />
												<input type="hidden" name="action" id="action" value="insertPageMoldItem" />
												<input type="hidden" name="mode" id="mode" value="insertPageMoldItem" />
												<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />
												<input type="hidden" name="fid" id="fid" value="<?=$uid?>" />
												<div class="row top5"> </div>
												<table id="mold_file_list" class="table  table-bordered table-hover " style="margin-top:10px;border-top: 1px solid #dddddd">
												<thead class="thin-border-bottom">
													<tr>
														<? if($_SESSION['login_level'] >= 99) { ?>
														<th class="detail-col center">
															<label class="pos-rel">
																<input type="checkbox" class="ace" id="checkedAllFile" />
																<span class="lbl"></span>
															</label>
														</th>
														<?}?>
														<th class="center col-xs-3" style="background-color:#f1f1f1">파일/이미지명</th>
														<th class="center col-xs-2" style="background-color:#f1f1f1">파일/이미지코드</th>
														<th class="center col-xs-2" style="background-color:#f1f1f1">파일/이미지구분</th>
														<th class="center col-xs-2" style="background-color:#f1f1f1">비고</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">출력</th>
														<th class="center col-xs-1" style="background-color:#f1f1f1">파일등록</th>
													</tr>
												</thead>
												<tbody style="border-bottom: 1px solid #dddddd">
													<tr>
													<td colspan='11' class='center'>등록된 금형품목이 없습니다.</td>
													</tr>
												</tbody>
												<tfoot >
												<tfoot>
												</table>
												</form>	
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
					<div class="space-6"></div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="clearfix form-actions" style="margin-top:0px">
							<div class="col-md-12">
								<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
								<div class="col-xs-6 right" style="text-align:right">
									<button class="btn btn-info btn-xs" type="button" onclick="formSubmit()">
										<i class="ace-icon fa fa-check"></i>
										<span id="text2">저장</span>
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
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="flag" id="flag" value="1" />
<input type="hidden" name="page" id="page" value="1" />
<!-- <input type="hidden" name="where" id="where" value=" where used='n'" /> -->
<input type="hidden" name="check_uids" id="check_uids" />

<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:60%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">금형 파일/이미지 등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="mold_file_reg_frame" frameborder="0" width="99%" height="450" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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
    <div class="modal-dialog modal-sm" style="width:60%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">금형부품등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="product_output_modify_frame" frameborder="0" width="99%" height="160" marginwidth="0" marginheight="0" scrolling="no"></iframe></p>
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


<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	var page = $("#page").val();
	var uid = $("#uid").val();
	getMoldList(page);
	createMoldCode();
	//getMoldItemList(uid);
	//getMoldFileList(uid);
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

	$("#checkedAllItem").click(function(){
		if($("#checkedAllItem").prop('checked')) {
			$(".chkitem").each(function(){
				$(this).prop("checked",true);
			});
		} else {
			$(".chkitem").each(function(){
				$(this).prop("checked",false);
			});
		}
	});

	$("#checkedAllFile").click(function(){
		if($("#checkedAllFile").prop('checked')) {
			$(".chkfile").each(function(){
				$(this).prop("checked",true);
			});
		} else {
			$(".chkfile").each(function(){
				$(this).prop("checked",false);
			});
		}
	});
});

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
	var uid = $("#uid").val();
	var mold_cd = $("#mold_cd").val();
	if ((winName=="금형부품리스트" || winName=="금형파일리스트") && uid=="")
	{
		alert("좌측 금형 목록에서 금형을 선택하세요.")
			return false;
	}
	
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
	var win = window.open(theURL+"?uid="+uid+"&mold_cd="+mold_cd,winName,state); 
	win.focus(); 
} 

// 금형 리스트 가져오기
function getMoldList(page){
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();

	$.getJSON("ajax/mold.php",{"page":page, "mode":"getMoldList", "rpp" : rpp, "adjacents" : adjacents, "where" : where},
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
					tag += "<td><a href='javascript:void(0);'  onclick='getMoldData(" + json[i].uid +")' >" + json[i].mold_cd + "</a></td>";
					tag += "<td>" + json[i].mold_nm + "</a></td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='3' class='center' style='height:20px'> 등록된 금형 데이터가 없습니다. </td>";
				tag += "</tr>";
			}

			$("#mold_list tbody").html(tag);

			var table = "erp_mold";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 금형 상세정보 가져오기
function getMoldData(uid){
	$("#action").val("updatePageMold");
	$("#uid").val(uid);

	$("#text1").text('수정');
	$("#text2").text('수정');
	$.getJSON("ajax/mold.php",{"mode":"getMoldData", "uid" : uid},
		function(json){
			if(json != null) {
				for( var key in json ) {
					
					if (key=="use_yn"){
						//$("#"+key+" option:selected").val(json['use_yn']);
						//$('input:checkbox[id="use_yn"]').is(":checked") == true
						$("#use_yn").prop('checked',true);
					}else if (key=="m_length_unit"){
						$("#m_length_unit").val(json['m_length_unit']).prop("selected", true);
					}else if (key=="m_width_unit"){
						$("#m_width_unit").val(json['m_width_unit']).prop("selected", true);
					}else if (key=="m_height_unit"){
						$("#m_height_unit").val(json['m_height_unit']).prop("selected", true);
					}else if (key=="m_pressure_unit"){
						$("#m_pressure_unit").val(json['m_pressure_unit']).prop("selected", true);
					}else if (key=="m_weight_unit"){
						$("#m_weight_unit").val(json['m_weight_unit']).prop("selected", true);
					}else{
						$("#"+key).val(json[key])
					}
				}
				getMoldItemList(uid);
				getMoldRepairList();
				getMoldFileList(uid);
			}
		}
	);
}

// 금형부품 리스트 가져오기
function getMoldItemList(uid){

	var flag = $("#flag").val();
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();
	//var uid = $("#uid").val();
	var tax_type = $("#tax_type option:selected").val();

	$.getJSON("ajax/mold.php",{"page":page, "mode":"getMoldItemList", "rpp" : rpp, "adjacents" : adjacents, "where" : where, "uid" : uid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chkitem' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].material + "</td>";
					tag += "<td>" + json[i].unit + "</td>";
					tag += "<td class='text-right'>" + json[i].cnt + "</td>";
					tag += "<td class='text-right'>" + json[i].valid_item_hit_cnt + "</td>";
					tag += "<td>" + json[i].item_gb + "</td>";
					tag += "<td>" + json[i].item_group_nm + "</td>";
					tag += "<td>" + json[i].remark + "</td>";
					tag += "</tr>";
					flag = Number(flag) + 1;
					$("#flag").val(flag);
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='12' class='center' style='height:20px'> 등록된 금형부품 데이터가 없습니다. </td>";
				tag += "</tr>";
			}
			$(".item").text(json[0].total_num);

			$("#mold_item_list tbody").html(tag);

			var table = "erp_mold_item";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 금형 수리 상세정보 가져오기
function getMoldRepairList(){

	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();
	var mcode = $("#mold_cd").val();
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
					tag += "<td nowrap>" + json[i].repair_type + "</td>";
					tag += "<td nowrap>" + json[i].repair_gb + "</td>";
					tag += "<td nowrap>" + json[i].repair_content + "</td>";
					tag += "<td nowrap>" + json[i].warehouse_nm + "</td>";
					tag += "<td nowrap>" + json[i].process_nm + "</td>";
					tag += "<td nowrap>" + json[i].account_nm + "</td>";
					tag += "<td nowrap>" + json[i].emp_nm+ "</td>";
					tag += "<td>" + json[i].state+ "</td>";
					tag += "</tr>";
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='14' class='center' style='height:20px'> 등록된 금형 타수 상세 내역이 없습니다.</td>";
				tag += "</tr>";
			}
			$(".repair").text(json[0].total_num);
			$("#mold_repair_list tbody").html(tag);

			var table = "erp_mold_repair";
			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 금형파일 리스트 가져오기
function getMoldFileList(uid){
	
	var flag = $("#flag").val();
	var rpp = $("#per").val();
	var adjacents = 4;
	var tag = "";
	var page = page;
	var where = $("#where").val();
	//var uid = $("#uid").val();

	$.getJSON("ajax/mold.php",{"page":page, "mode":"getMoldFileList", "rpp" : rpp, "adjacents" : adjacents, "where" : where, "uid" : uid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chkfile' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					tag += "<td>" + json[i].real_file_nm + "</td>";
					tag += "<td>" + json[i].file_cd + "</td>";
					tag += "<td><input type='text' class='form-control file_gb' name='file_gb[]' id='file_gb_" + flag + "' onblur='insertFileGB("+json[i].uid+","+flag+");' onclick='this.select();' value='"+json[i].file_gb+"' required /></td>";
					tag += "<td>" + json[i].etc + "</td>";
					if($.trim(json[i].image)=="assets/images/images.png"){
					tag += "<td class='center'><img src='"+ json[i].image +"' alt='제품사진' style='width:30px;'></td>";
					}else{
					tag += "<td class='center'><span class='tdPic tdPic_custom'><a class='fancybox' href='"+ json[i].image +"' ><img src='"+ json[i].image +"' alt='제품사진' style='width:30px;height:30px'></a></span></td>";
					}
					tag += "<td class='center'><a href='/assets/download.php?module=file&downtype=moldfile&realname="+json[i].file_nm+"&downfile="+json[i].file_nm+"'>다운로드</a></td>";
					tag += "</tr>";
					flag = Number(flag) + 1;
					$("#flag").val(flag);
				}
			}else{
				tag += "<tr>";
				tag += "<td colspan='12' class='center' style='height:20px'> 등록된 금형부품 데이터가 없습니다. </td>";
				tag += "</tr>";
			}
			$(".files").text(json[0].total_num);

			$("#mold_file_list tbody").html(tag);

			var table = "erp_mold_item";
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

// 금형 부품 선택 삭제
function deleteSelectItem(){
		var uid	= $("#uid").val();
		$(".chkitem").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		if ($("#check_uids").val()=="")
		{
			alert('삭제할 데이터를 하나 이상 선택하세요.')
			return false;
		}
	if(confirm("선택하신 금형부품 데이터를 삭제하시겠습니까?")) {

		var dataString = "mode=deleteSelectMoldItem&table=erp_mold_item&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/mold.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAllItem").prop('checked',false);
					getMoldItemList(uid);
				}
			}
		});
	}
}

// 금형 파일 선택 삭제
function deleteSelectFile(){
		var uid	= $("#uid").val();
		$(".chkfile").each(function(){
			if($(this).prop('checked')) {
				var new_uid = $("#check_uids").val() + "," + $(this).val();
				$("#check_uids").val(new_uid);
			}
		});

		if ($("#check_uids").val()=="")
		{
			alert('삭제할 파일 이미지를 하나 이상 선택하세요.')
			return false;
		}
	if(confirm("선택하신 금형 파일 이지미를 삭제하시겠습니까?")) {

		var dataString = "mode=deleteSelectMoldFile&table=erp_mold_files&uids=" + $("#check_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/mold.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {
					$("#checkedAllFile").prop('checked',false);
					getMoldFileList(uid);
				}
			}
		});
	}
}

// 금형 파일 파일/이미지구분 넣기
function insertFileGB(uid,flag){
		var file_gb	= $("#file_gb_"+flag).val();
		if (file_gb =="")
		{
			alert('파일 이미지 구분을 이미지를 입력 하세요.')
			return false;
		}
		var dataString = "mode=insertFileGb&table=erp_mold_files&uid=" +uid+"&file_gb=" + file_gb;
		$.ajax({
			type : "post",
			url : "ajax/mold.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") {
					alert(str);
				} else {

				}
			}
		});
}


function formSubmit(){
	    var f  = "#frm";
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

function delTr(flag){
	var tag=""; 
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	//if(nextFlag < 4) {} else $("#flag").val(nextFlag);
	$("#flag").val(nextFlag);

	if(nextFlag==1){
		tag += "<tr>";
		tag += "<td colspan='12' class='center' style='height:20px'> 등록된 금형부품 데이터가 없습니다. </td>";
		tag += "</tr>";
		$("#mold_item tbody").html(tag);
	}
}

function formItemSubmit(){
	    var f  = "#frmMold";
        var $f = jQuery(f);
        var $b = jQuery(this);
        var $t, t;
        var result = true;
		//var updatePageMold	= $("#action").val();
		var fid				= $("#uid").val();

		if (fid=="")
		{
			alert('금형코드를 등록 후 금형 품목을 입력하세요.');
			return false
		}
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
		//	if (uid!="" && updatePageMold=="updatePageMold")
		//	{
			//var result = confirm('금형 데이터를 수정하시겠습니까?'); 
		//		if(result) { 
		//			$("#frmMold").submit(); 
		//		} else {
		//			return false;
		//		}
		//	}else{
		//	alert($("input[name=item_cd[]]").length);
			if($("#flag").val() <= 1 || $("#flag").val() == "") {
				alert("품목을 하나 이상 추가 하세요");
				return false;
			}

			if(!frm_submit($('input[name="item_cd[]"]'),"품목코드")) return false;
			if(!frm_submit($('input[name="cnt[]"]'),"수량")) return false;
			var result = confirm('금형부품을 등록 하시겠습니까?'); 
				if(result) {
					//$("#frmMold").attr("target", "hiddenIframe");
					//$("#frmMold").submit(); 
					insertMoldItem(fid);
				} else {
					return false;
				}
		//	}
		}
}
function frm_submit(f,t) {
	  var ret = true;
	  $(f).each(function(idx, item) {
		if(!$(item).val() || $(item).val()=="0") {
		  ret = false;
		  alert(t+"을 입력 하세요");
		  //$("span").text(t+"을 입력 하세요").show().fadeOut(1000);
		  $(item).focus();
		  return false;
		}
	  });
	  return ret;
	}
//금형부품 등록
function insertMoldItem(fid) {
		var mold_cd = $("#mold_cd").val();
		$("#m_cd").val(mold_cd);
		var params = $("form[name=frmMold]").serialize();
		$.ajax({
			type : "post",
			data : params,
			contentType: 'application/x-www-form-urlencoded; charset=UTF-8', 
			url : "../../ajax/mold.php?mode=insertPageMoldItem",
			success : function(str) {
				getMoldItemList(fid);
				//alert(str)
				//var str = str.split("/");
				//$("#delivery_zipcode").val(str[0]);
				//$("#delivery_address").val(str[1]);
			}
		});
	//}
}

//-----------------------------------------------------------------------
// 기  능 : 금액을 숫자 형식으로
//-----------------------------------------------------------------------
function Money2Num(money) {
	if(money == undefined)	return false;
	var moneyString		=	new String;
	moneyString			=	money.toString();
	while (moneyString.indexOf(',') > -1){
		moneyString	=	moneyString.replace(',','');
	}
	if(isNaN(moneyString)){
		return false;
	}else{
		return moneyString;
	}
}
function commaSplit(n) {// 콤마 나누는 부분
	var txtNumber = '' + n;
	var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
	var arrNumber = txtNumber.split('.');
	arrNumber[0] += '.';
	do {
		arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
	}
	while (rxSplit.test(arrNumber[0]));
	if(arrNumber.length > 1) {
		return arrNumber.join('');
	} else {
		return arrNumber[0].split('.')[0];
	}
}

function removeComma(n) {  // 콤마제거
	if ( typeof n == "undefined" || n == null || n == "" ) {
		return "";
	}
	var txtNumber = '' + n;
	return txtNumber.replace(/(,)/g, "");
}
function input_comma(sfield) 
	{
		if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) 
			|| (event.keyCode == 188) || (event.keyCode == 190) || (event.keyCode == 110) || (event.keyCode == 8) || (event.keyCode == 46))
		{			
			sfield.value = remove_comma(sfield);
			money = sfield.value;
			var tmpH="";
			if(money.charAt(0)=="-")
			{
				tmpH=money.substring(0,1);
				money=money.substring(1,money.length);
			}
		
			for (; money.indexOf("-") != -1 ;) 
			{ 
				money = money.replace("-","")
			}
		
			belowzero = "";
			if (check_dot(money)==true)
			{
				arr = money.split(".");
				money = arr[0];		
				belowzero = "." + arr[1];    
			}
			
			len = money.length ;
			result ="";
			for (i=0; i < len;i++)
			{
				comma="";
				schar = money.charAt(i);
				where = len - 1 - i;
				if ( ( where % 3 == 0) && (len > 3) && ( where != 0 )) 
				{
					comma = ",";	
				}
				result = result +   schar + comma ;
			}
			if(tmpH)
			{
 				result = tmpH + result;
	 		}

			sfield.value = result + belowzero;			
			
	   	}	
		return true;
	}

	function remove_comma(sfield)
	{
		money = sfield.value;
		var arr;
		arr = money.split(",");
		len = arr.length;	
		result = "";
		for (k=0; k < len; k++) 
		{
			result = result + arr[k];
		}
		return result;
	}	

	function check_dot(v_value)
	{
		v_len= v_value.length;
		for (var i=0; i< v_len; i++) 
		{
			schar = v_value.charAt(i);
			if (schar == "." )
			{
				return true;
			}
		}
		return false;
	}
		
	function onlyNumber() //onKeyPress 이벤트 기준
	{ 
  		if ( ((event.keyCode < 48) || (57 < event.keyCode) && (188 != event.keyCode)) && (45 != event.keyCode) 
  			&& (190 != event.keyCode) && (110 != event.keyCode) && (109 != event.keyCode) && (46 != event.keyCode)) 
  		{
  			event.returnValue=false;
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
	function mold_file_reg()
	{
	var uid = $("#uid").val();
	if (uid=="")
	{
		alert("좌측 금형 목록에서 금형을 선택하세요.")
		return false;
	}
	$("#id-btn-dialog1").modal({
		show: true,
		title : "금형등록",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var url = "index.php?controller=mold&action=registPageMoldFile&uid="+uid+"&pop=Y&dialogID=id-btn-dialog1";
	$("#mold_file_reg_frame").attr("src", url);
	}
			
	function mold_item_reg()
	{
	var uid = $("#uid").val();
	if (uid=="")
	{
		alert("금형등록 후 금형 부품을 등록하실 수 있습니다.\n좌측 금형 목록에서 금형을 선택하세요.")
		return false;
	}
	var mold_cd = $("#mold_cd").val();

	$("#id-btn-dialog2").modal({
		show: true,
		title : "금형부품등록",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	
	//$(".modal-title").html(tt);
	$('.modal-dialog').draggable();
	var url = "index.php?controller=mold&action=registPageMoldItem&pop=Y&uid="+uid+"&mold_cd="+mold_cd+"&mode=getMoldItemList&dialogID=id-btn-dialog2";
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
		$("#mold_file_reg_frame").attr("src", "about:blank");
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
