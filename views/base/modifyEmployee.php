<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">기준정보관리</a>
				</li>
				<li class="active">사원등록</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					사원 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						사원정보를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12 tabbable">
					<!-- PAGE CONTENT BEGINS -->
					<ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
						<li class="active">
							<a data-toggle="tab" href="#faq-tab-1">
								<i class="blue ace-icon fa fa-question-circle bigger-120"></i>
								사원정보
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#faq-tab-2">
								<i class="green ace-icon fa fa-user bigger-120"></i>
								접근권한설정
							</a>
						</li>
					</ul>

					<div class="tab-content no-border padding-24">
						<div id="faq-tab-1" class="tab-pane fade in active">
							<form id="frm" method="post" action="index.php">
								<input type="hidden" name="controller" id="controller" value="base" />
								<input type="hidden" name="action" id="action" value="updateEmployee" />
								<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />
								<input type="hidden" name="ori_img" id="ori_img" value="<?=$t->img?>" />
								<input type="hidden" name="big_uid" id="big_uid" />
								<input type="hidden" name="middle_uid" id="middle_uid" />
								<input type="hidden" name="small_uid" id="small_uid" />
								<!-- 테이블 -->
								<table id="simple-table" class="table  table-bordered table-hover">
									<tr>
										<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 공장구분</th>
										<td class="col-xs-5" colspan="3">
											<label>
												<input type="radio" class="ace" name="process_gb" id="process_gb" value="1공장" checked/>
												<span class="lbl"> 1공장</span>
											</label>

											<label>
												<input type="radio" class="ace" name="process_gb" id="process_gb" value="2공장" />
												<span class="lbl"> 2공장</span>
											</label>

											<label>
												<input type="radio" class="ace" name="process_gb" id="process_gb" value="연태공장" />
												<span class="lbl"> 연태공장</span>
											</label>
										</td>
									</tr>
									<tr>
										<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 사원번호</th>
										<td class="col-xs-5"><input type="text" class="" name="emp_cd" id="emp_cd" value="<?=$t->emp_cd?>" readonly /></td>
										<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 사원명</th>
										<td class="col-xs-5"><input type="text" name="emp_nm" id="emp_nm" value="<?=$t->emp_nm?>" /></td>
									</tr>
									
									<tr>
										<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 사원 ID</th>
										<td class="col-xs-5"><input type="text" name="emp_id" id="emp_id" value="<?=$t->emp_id?>" /></td>
										<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 사원 PASSWORD</th>
										<td class="col-xs-5"><input type="password" name="emp_pwd" id="emp_pwd" value="<?=$t->emp_pwd?>" /></td>
									</tr>
									<tr>
										<th class="col-xs-1" style="background-color:#f1f1f1">성별</th>
										<td class="col-xs-5">
											<label>
												<input type="radio" class="ace" name="sex_gb" id="sex_gb" value="m" <? if($t->sex_gb == "m") echo "checked"; ?> />
												<span class="lbl"> 남성</span>
											</label>

											<label>
												<input type="radio" class="ace" name="sex_gb" id="sex_gb" value="w" <? if($t->sex_gb == "w") echo "checked"; ?> />
												<span class="lbl"> 여성</span>
											</label>
										</td>
										<th class="col-xs-1" style="background-color:#f1f1f1">주민등록번호</th>
										<td class="col-xs-5"><input type="text" class=" input-mask-registno" name="regist_no" id="regist_no" value="<?=$t->regist_no?>" /></td>
									</tr>
									<tr>
										<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 휴대전화</th>
										<td class="col-xs-5">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-phone"></i>
												</span>

												<input class="" type="text" name="emp_mobile" id="emp_mobile" value="<?=$t->emp_mobile?>" />
											</div>
										</td>
										<th class="col-xs-1" style="background-color:#f1f1f1">자택전화</th>
										<td class="col-xs-5">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-phone"></i>
												</span>

												<input class=" input-mask-telephone" type="text" name="emp_telephone" id="emp_telephone" value="<?=$t->emp_telephone?>" />
											</div>
										</td>
									</tr>
									<tr>
										<th class="col-xs-1" style="background-color:#f1f1f1">Email</th>
										<td class="col-xs-5" colspan="3"><input type="text" class="" name="emp_email" id="emp_email" value="<?=$t->emp_emial?>" /></td>
									</tr>
									<tr>
										<th class="col-xs-1" style="background-color:#f1f1f1">입사일자</th>
										<td class="col-xs-5">
											<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="join_dt" id="join_dt" value="<?=substr($t->join_dt,0,10)?>" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
										</td>
										<th class="col-xs-1" style="background-color:#f1f1f1">퇴사일자</th>
										<td class="col-xs-5">
											<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="resign_dt" id="resign_dt" value="<?=substr($t->resign_dt,0,10)?>" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
										</td>
									</tr>
									<tr>
										<th class="col-xs-1" style="background-color:#f1f1f1">부서</th>
										<td class="col-xs-5">
											<select name="big_department_cd" id="big_department_cd" onchange="postBigDepartment(this.value)"><option value="0">부서선택</option></select>
											<select name="middle_department_cd" id="middle_department_cd" onchange="postMiddleDepartment(this.value)"><option value="0">부서선택</option></select>
											<select name="small_department_cd" id="small_department_cd" onchange="postSmallDepartment(this.value)"><option value="0">부서선택</option></select>
										</td>
										<th class="col-xs-1" style="background-color:#f1f1f1">직위</th>
										<td class="col-xs-5">
											<div class="input-group">
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input type="hidden" name="position_cd" id="position_cd" value="<?=$t->position_cd?>" readonly />
														<input type="text" name="position_nm" id="position_nm" value="<?=$t->position_nm?>" onclick="centerOpenWindow('views/popup/positionList.php', '직위리스트', 300, 500)" readonly />
														<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="centerOpenWindow('views/popup/positionList.php', '직위리스트', 300, 500)">
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
														</span>
													</div>
												</span>
											</div>
										</td>
									</tr>
									<tr>
										<th class="col-xs-1" style="background-color:#f1f1f1">주소</th>
										<td class="col-xs-5" colspan="3">
											<div class="input-group">
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input type="text" placeholder="우편번호" name="emp_zipcode" id="emp_zipcode" value="<?=$t->emp_zipcode?>" style='width:100px' readonly />
														<span class="input-group-addon btn-purple" style="cursor:pointer" onclick="sample6_execDaumPostcode(1)">
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
														</span>
													</div>
												</span>
											</div>
											<div style="margin-top:5px">
												<input type="text" class=" search-query" placeholder="주소" name="emp_address" id="emp_address" value="<?=$t->emp_address?>" style='width:400px'/>
											</div>
										</td>
									</tr>
									<tr>
										<th class="col-xs-1" style="background-color:#f1f1f1">사진</th>
										<td class="col-xs-5" colspan="3">
											<?
											if($t->img != "") echo "<img src='attach/$t->img' style='width:50px; height:50px' />";
											?>
											<input type="file" class="" name="img" id="img" />
										</td>
									</tr>
								</table>
							</form>
							<!-- submit -->
							<div class="clearfix form-actions center">
								<div class="col-md-12">
									<button class="btn btn-info" type="button" onclick="formSubmit()">
										<i class="ace-icon fa fa-check bigger-110"></i>
										등록
									</button>

									&nbsp; &nbsp; &nbsp;
									<button class="btn" type="reset" onclick="location.href = 'index.php?controller=base&action=listPageEmployee' ">
										<i class="ace-icon fa fa-undo bigger-110"></i>
										목록 돌아가기
									</button>
								</div>
							</div><!-- // submit -->
						</div>

						<div id="faq-tab-2" class="tab-pane fade">
							<form name="frm2" id="frm2" method="post" action="index.php">
								<input type="hidden" name="controller" id="controller" value="base" />
								<input type="hidden" name="action" id="action" value="registAuthority" />
								<input type="hidden" name="emp_id" id="emp_id" value="<?=$t->emp_id?>" />
								<input type="hidden" name="emp_uid" id="emp_uid" value="<?=$t->uid?>" />
								
								<h4>기준정보관리</h4>
								<table id="simple-table" class="table table-bordered table-bordered">
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 품목관리</th>
										<td class="col-xs-2">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>

									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 거래처관리</th>
										<td class="col-xs-2">
											<input name="account_menu" id="account_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->account_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 부서관리</th>
										<td class="col-xs-2">
											<input name="department_menu" id="department_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->department_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 직위관리</th>
										<td class="col-xs-2">
											<input name="position_menu" id="position_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->position_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 사원관리</th>
										<td class="col-xs-2">
											<input name="employee_menu" id="employee_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->employee_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 창고등록</th>
										<td class="col-xs-2">
											<input name="warehouse_menu" id="warehouse_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->warehouse_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 공정등록</th>
										<td class="col-xs-2">
											<input name="process_menu" id="process_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->process_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 생산기기등록</th>
										<td class="col-xs-2">
											<input name="machine_menu" id="machine_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->machine_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 프로젝트관리</th>
										<td class="col-xs-2">
											<input name="project_menu" id="project_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->project_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 엑셀자료등록</th>
										<td class="col-xs-2">
											<input name="excel_menu" id="excel_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->excel_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
								</table>

								<h4>영업관리</h4>
								<table id="simple-table" class="table table-bordered table-bordered">
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 거래명세서</th>
										<td class="col-xs-2">
											<input name="trade_menu" id="trade_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->trade_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 견적관리</th>
										<td class="col-xs-2">
											<input name="estimate_menu" id="estimate_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->estimate_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 수주(주문)관리</th>
										<td class="col-xs-2">
											<input name="order_menu" id="order_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->order_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 출하관리</th>
										<td class="col-xs-2">
											<input name="shipment_menu" id="shipment_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->shipment_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> AS관리</th>
										<td class="col-xs-2">
											<input name="as_menu" id="as_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->as_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 미수금관리</th>
										<td class="col-xs-2">
											<input name="receive_menu" id="receive_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->receive_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 매출계획</th>
										<td class="col-xs-2">
											<input name="sale_plan_menu" id="sale_plan_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->sale_plan_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
								</table>

								<h4>구매관리</h4>
								<table id="simple-table" class="table table-bordered table-bordered">
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 구매요청</th>
										<td class="col-xs-2">
											<input name="demand_menu" id="purchase_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->demand_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 발주계획</th>
										<td class="col-xs-2">
											<input name="purchase_plan_menu" id="purchase_plan_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->purchase_plan_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 발주서</th>
										<td class="col-xs-2">
											<input name="purchase_menu" id="purchase_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->purchase_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 구매(입고)</th>
										<td class="col-xs-2">
											<input name="purchase_item_menu" id="purchase_item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->purchase_item_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 미지급금관리</th>
										<td class="col-xs-2">
											<input name="amount_menu" id="amount_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->amount_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
								</table>

								<h4>생산관리</h4>
								<table id="simple-table" class="table table-bordered table-bordered">
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> BOM(소요량)</th>
										<td class="col-xs-2">
											<input name="bom_menu" id="bom_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->bom_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> BOM(소요량) 계산</th>
										<td class="col-xs-2">
											<input name="bom_cal_menu" id="bom_cal_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->bom_cal_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 외주공장관리</th>
										<td class="col-xs-2">
											<input name="outsourcing_menu" id="outsourcing_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->outsourcing_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 생산계획</th>
										<td class="col-xs-2">
											<input name="workplan_menu" id="workplan_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->workplan_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 생산계획별 소요 자재 현황 조회</th>
										<td class="col-xs-2">
											<input name="workplan_bom_menu" id="workplan_bom_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->workplan_bom_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 작업지시서</th>
										<td class="col-xs-2">
											<input name="work_menu" id="work_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->work_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 품질관리(QC)</th>
										<td class="col-xs-2">
											<input name="qc_menu" id="qc_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->qc_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 불량관리</th>
										<td class="col-xs-2">
											<input name="defective_menu" id="defective_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->defective_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
								</table>

								<h4>재고관리</h4>
								<table id="simple-table" class="table table-bordered table-bordered">
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 창고재고관리</th>
										<td class="col-xs-2">
											<input name="warehouse_stock_menu" id="warehouse_stock_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->warehouse_stock_menu == "y") echo "checked"; ?> /><span class="lbl"></span>		
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 단가관리</th>
										<td class="col-xs-2">
											<input name="price_menu" id="price_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->price_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 재고현황</th>
										<td class="col-xs-2">
											<input name="stock_menu" id="stock_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->stock_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 자재출고관리</th>
										<td class="col-xs-2">
											<input name="release_menu" id="release_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->release_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 바코드관리</th>
										<td class="col-xs-2">
											<input name="barcode_menu" id="barcode_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->barcode_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 재고실사</th>
										<td class="col-xs-2">
											<input name="real_stock_menu" id="real_stock_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->real_stock_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 안전재고관리</th>
										<td class="col-xs-2">
											<input name="safety_menu" id="safety_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->safety_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
								</table>

								<h4>그룹웨어</h4>
								<table id="simple-table" class="table table-bordered table-bordered">
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 전자결재</th>
										<td class="col-xs-2">
											<input name="ele_menu" id="ele_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->ele_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 고객관리(CRM)</th>
										<td class="col-xs-2">
											<input name="crm_menu" id="crm_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->crm_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 업무공유</th>
										<td class="col-xs-2">
											<input name="board_menu" id="board_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->board_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 일정관리</th>
										<td class="col-xs-2">
											<input name="schedule_menu" id="schedule_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->schedule_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 출퇴근관리</th>
										<td class="col-xs-2">
											<input name="leave_menu" id="leave_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->leave_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 파일보관함</th>
										<td class="col-xs-2">
											<input name="file_menu" id="file_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->file_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 공용품관리</th>
										<td class="col-xs-2">
											<input name="goods_menu" id="goods_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->goods_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 차량관리</th>
										<td class="col-xs-2">
											<input name="car_menu" id="car_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->car_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
									<tr>
										<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 시설관리</th>
										<td class="col-xs-2">
											<input name="installation_menu" id="installation_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->installation_menu == "y") echo "checked"; ?> /><span class="lbl"></span>			
										</td>
										<td class="col-xs-8">
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 읽기</span>
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 쓰기</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 수정</span>	
											<input name="item_menu" id="item_menu" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->item_menu == "y") echo "checked"; ?> /><span class="lbl"> 삭제</span>	
										</td>
									</tr>
								</table>
							</form>
							<!-- submit -->
							<div class="clearfix form-actions center">
								<div class="col-md-12">
									<button class="btn btn-info" type="button" onclick="formSubmit2()">
										<i class="ace-icon fa fa-check bigger-110"></i>
										등록
									</button>

									&nbsp; &nbsp; &nbsp;
									<button class="btn" type="reset" onclick="location.href = 'index.php?controller=base&action=listPageEmployee' ">
										<i class="ace-icon fa fa-undo bigger-110"></i>
										목록 돌아가기
									</button>
								</div>
							</div><!-- // submit -->
						</div>
					</div>
				</div>
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<!-- // 우편번호 찾기 ------------------------------------------------------------------------------------------------------->
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
function sample6_execDaumPostcode(obj) {
	new daum.Postcode({
		oncomplete: function(data) {
			// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = ''; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
			if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
				fullAddr = data.roadAddress;
			} else { // 사용자가 지번 주소를 선택했을 경우(J)
				fullAddr = data.jibunAddress;
			}

			// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
			if(data.userSelectedType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}
			
			if(obj == 1) {
				// 우편번호와 주소 정보를 해당 필드에 넣는다.
				document.getElementById('emp_zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('emp_address').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('emp_address').focus();
			} else {
				// 우편번호와 주소 정보를 해당 필드에 넣는다.
				document.getElementById('company_zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('company_address1').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('company_address2').focus();
			}
		}
	}).open();
 }
 </script>
<!-- // 우편번호 찾기 ------------------------------------------------------------------------------------------------------->


<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	getBigDepartment();
});

function centerOpenWindow(theURL, winName, width, height, fstate, scrollbars){ 
	var features = "width=" + width ; 
	features += ",height=" + height ; 
	var state = ""; 
	var scrollbars = "yes";
	var res_w = ( $(window).width() - width ) / 2; 
	var res_h = ( $(window).height() - height ) / 2; 
	if ( window.screenLeft >= window.screen.width ) { 
		res_w = window.screen.width + res_w; 
	} 
	if (fstate == "") { // 옵션 
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 


// 거래처 리스트 가져오기
function getBigDepartment(){
	var tag = "<option value='0'>부서선택</option>";
	var sel = "";

	$.getJSON("ajax/base.php",{"mode":"getBigDepartment"},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					try
					{
						if(json[i].uid == "<?=$t->big_department_cd?>") {
							sel = "selected";
							$("#big_uid").val(json[i].uid);
							getMiddleDepartment();
						} else {
							sel = "";
						}
					}
					catch (e){}
					tag += "<option value='" + json[i].uid + "' " + sel + ">" + json[i].department_nm + "</option>";
				}
			}

			$("#big_department_cd").html(tag);
		}
	);
}

function getMiddleDepartment(){
	var fid = $("#big_uid").val();
	var tag = "<option value='0'>부서선택</option>";
	var sel = "";

	$.getJSON("ajax/base.php",{"mode":"getMiddleDepartment", "fid" : fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					try
					{
						if(json[i].uid == "<?=$t->middle_department_cd?>") {
							sel = "selected";
							$("#middle_uid").val(json[i].uid);
							getSmallDepartment();
						} else {
							sel = "";
						}
					}
					catch (e){}
					tag += "<option value='" + json[i].uid + "' " + sel + ">" + json[i].department_nm + "</option>";
				}
			}

			$("#middle_department_cd").html(tag);
		}
	);
}

function getSmallDepartment(){
	var fid = $("#middle_uid").val();
	var tag = "<option value='0'>부서선택</option>";
	var sel = "";

	$.getJSON("ajax/base.php",{"mode":"getSmallDepartment", "fid" : fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					try
					{
						if(json[i].uid == "<?=$t->small_department_cd?>") {
							sel = "selected";
						} else {
							sel = "";
						}
					}
					catch (e){}
					tag += "<option value='" + json[i].uid + "' " + sel + ">" + json[i].department_nm + "</option>";
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

function formSubmit(){
	if(!check_str($("#emp_cd").val(),"사원코드")) return false;
	if(!check_str($("#emp_nm").val(),"사원명")) return false;
	if(!check_str($("#emp_id").val(),"사원아이디")) return false;
	if(!check_str($("#emp_pwd").val(),"사원비밀번호")) return false;
	//if(!check_str($("#emp_mobile").val(),"휴대전화")) return false;

	$("#frm").submit();
}

function formSubmit2() {
	$("#frm2").submit();
}
</script>

<!----------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-mobile').mask('(999) 9999-9999');
	$('.input-mask-telephone').mask('(999) 999-9999');
	$('.input-mask-registno').mask('999999-9999999');
	$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
	$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});

	//override dialog's title function to allow for HTML titles
	$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
		_title: function(title) {
			var $title = this.options.title || '&nbsp;'
			if( ("title_html" in this.options) && this.options.title_html == true )
				title.html($title);
			else title.text($title);
		}
	}));
	
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
});
</script>
<!----------------------------------------------------------------------------------------------------------------------->