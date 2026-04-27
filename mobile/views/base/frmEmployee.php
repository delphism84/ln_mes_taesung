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
						<div style="float:left">
							
							<!-- <select name="big_department_cd" id="big_department_cd" onchange="getMiddleDepartment()" style="height:35px"></select>
							<select name="middle_department_cd" id="middle_department_cd" onchange="getSmallDepartment()" style="height:35px"><option value="0">==선택==</option></select>
							<select name="small_department_cd" id="small_department_cd" style="height:35px"><option value="0">==선택==</option></select>
							<input type="button"  class="btn btn-xs btn-success" value="검색" onclick="search_department()" style="height:35px; margin-bottom:3px" /> -->
						</div>
						<div>
							<div class="input-group">
								<input type="text" class=" search-query" name="search_txt" id="search_txt" style="height:35px; width:100%;"/>
								<!-- <select name="search_classify" id="search_classify" style="float:right; height:35px">
									<option value="0">=검색구분=</option>
									<option value="emp_cd">사원코드</option>
									<option value="emp_id">사원아이디</option>
									<option value="emp_nm">사원명</option>
								</select>&nbsp;									 -->
								<span class="input-group-btn">										
									<button type="button" class="btn btn-purple btn-sm" onclick="search()" style="height:35px">
										<span class="fa fa-search icon-on-right bigger-110"></span>
									</button>
									<button type="button" class="btn btn-success btn-sm" onclick="refresh()" style="height:35px">
										<span class="fa fa-refresh icon-on-right bigger-110"></span>
									</button>
									<!--
									<button type="button" class="btn btn-danger btn-sm" style="height:35px" data-toggle="modal" data-target="#confirm-delete" >
										<span class="fa fa-trash icon-on-right bigger-110"></span>
									</button>
									-->
								</span>
							</div>
						</div>
						<input type="button" class="btn btn-xs btn-pink" value="사원 리스트" style="height:35px; margin-top:10px;" />
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
										사원번호
									</th>
									<th class="detail-col center">
										사원명
									</th>
									<th class="detail-col center">
										성별
									</th>
									<th class="detail-col center">
										부서
									</th>
									<th class="detail-col center">
										직급
									</th>
									<th class="detail-col center">
										휴대전화
									</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<? $this->paging() ?>
						<!--
						<? $this->table("tb","사원번호,사원명,성별,부서,직급,휴대전화,이메일,권한설정"); ?>
						-->
						
					</div>
					<!--
					<div class="col-xs-12" style="border:1px solid #ccc; height:100%; overflow: scroll; overflow-x: hidden; padding-top:10px">
						<div>
							<form id='frm'>
								<input type="hidden" name="mode" id="mode" value="registEmployee" />
								<input type="hidden" name="uid" id="uid" />
								<input type="hidden" name="old_img" id="old_img" />
								<input type="hidden" name="check_emp_cd" id="check_emp_cd" value="n" />
								<input type="hidden" name="check_emp_id" id="check_emp_id" value="n" />
								<div>
									<div><input type="button" class="btn btn-xs btn-pink" value="사원등록" /></div>
									<table class="table table-bordered">
										<tr>
											<? $this->th("사원번호") ?>
											<td class="col-xs-8"><input type="text" name="emp_cd" id="emp_cd" onkeyup="checkEmpCd(this.value)" /> <span id="emp_cd_help"></span></td>
										</tr>
										<tr>
											<? $this->th("사원명") ?>
											<td class="col-xs-8"><input type="text" name="emp_nm" id="emp_nm" /></td>
										</tr>
										<tr>
											<? $this->th("아이디") ?>
											<td class="col-xs-8"><input type="text" name="emp_id" id="emp_id" validation="yes" err="아이디를 입력하세요" onkeyup="checkEmpId(this.value)" /> <span id="emp_id_help"></span></td>
										</tr>
										<tr>
											<? $this->th("비밀번호") ?>
											<td class="col-xs-8"><input type="password" name="emp_pwd" id="emp_pwd" validation="yes" err="비밀번호를 입력하세요"/></td>
										</tr>
										<tr>
											<? $this->th("성별") ?>
											<td class="col-xs-8">
												<input type="radio" name="gender" id="gender" value="남성" checked /> 남성
												<input type="radio" name="gender" id="gender" value="여성" /> 여성
											</td>
										</tr>
										<tr>
											<? $this->th("주민등록번호") ?>
											<td class="col-xs-8"><input type="text" name="regist_no" id="regist_no" /></td>
										</tr>
										<tr>
											<? $this->th("휴대전화") ?>
											<td class="col-xs-8"><input type="text" name="mobile" id="mobile" /></td>
										</tr>
										<tr>
											<? $this->th("자택전화") ?>
											<td class="col-xs-8"><input type="text" name="telephone" id="telephone" /></td>
										</tr>
										<tr>
											<? $this->th("Email") ?>
											<td class="col-xs-8"><input type="text" name="email" id="email" /></td>
										</tr>
										<tr>
											<? $this->th("월평균보수") ?>
											<td class="col-xs-8"><input type="text" class="onlynum comma" name="pay" id="pay" /></td>
										</tr>
										<tr>
											<? $this->th("4대보험") ?>
											<td class="col-xs-8">
												<input type="checkbox" name="national_pension" id="national_pension" value="y" /> 국민연금
												<input type="checkbox" name="emp_insure" id="emp_insure" value="y" /> 고용보험
												<input type="checkbox" name="health_insure" id="health_insure" value="y" /> 건강보험
												<input type="checkbox" name="long_term_care" id="long_term_care" value="y" /> 장기요양보험
											</td>
										</tr>
										<tr>
											<? $this->th("입사일자") ?>
											<td class="col-xs-8">
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="join_dt" id="join_dt" />
														<span class="input-group-addon">
															<i class="fa fa-calendar bigger-110"></i>
														</span>
													</div>
												</span>
											</td>
										</tr>
										<tr>
											<? $this->th("퇴사일자") ?>
											<td class="col-xs-8">
												<span class="input-icon input-icon-right">
													<div class="input-group">
														<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="resign_dt" id="resign_dt" />
														<span class="input-group-addon">
															<i class="fa fa-calendar bigger-110"></i>
														</span>
													</div>
												</span>
											</td>
										</tr>
										<tr>
											<? $this->th("부서") ?>
											<td class="col-xs-8">
												<?=$this->createDbSelectBox("department_middle","department_nm","m_middle_department_cd","postSmallDepartment");?>
												<?=$this->createDbSelectBox("department_small","department_nm","m_small_department_cd");?>
											</td>
										</tr>
										<tr>
											<? $this->th("직위") ?>
											<td class="col-xs-8">
												<?=$this->createDbSelectBox("position","position_nm","position_cd");?>
											</td>
										</tr>
										<tr>
											<? $this->th("주소") ?>
											<td class="col-xs-8">
												<div class="input-group">
													<input type="text" class="form-control search-query" placeholder="우편번호" name="emp_zipcode" id="emp_zipcode" readonly />
													<span class="input-group-btn">
														<button type="button" class="btn btn-purple btn-sm" onclick="sample6_execDaumPostcode(1)">
															<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
															Search
														</button>
													</span>
												</div>
												<div style="margin-top:5px">
													<input type="text" class="form-control search-query" placeholder="주소" name="emp_address" id="emp_address" />
												</div>
											</td>
										</tr>
										<tr>
											<? $this->th("사진") ?>
											<td class="col-xs-8">
												<div id="upDiv" style="display:none"><img id="uploadImg" src="" style="width:30px; height:30px;" /></div>
												<input type="file" name="img" id="img" />
											</td>
										</tr>
									</table>
								</div>
								<div class="col-md-12 center">
									<button class="btn btn-info" type="button" id="btnSubmit">
										<i class="ace-icon fa fa-check bigger-110"></i>
										<span id="btnSubmitTxt">사원 등록</span>
									</button>
									<button class="btn btn-default" type="button" onclick="formClear()">
										<i class="ace-icon fa fa-check bigger-110"></i>
										새로고침
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				-->
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="userAuthModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="width:1400px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">[<span id="userNm"></span>] 권한설정</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:735px; overflow:scroll; overflow-x:hidden">
				<form name="userAuthFrm" id="userAuthFrm">
					<input type="hidden" name="mode" id="mode" value="registAuthority" />
					<input type="hidden" name="user" id="user" />
							
					<div><input type="button" class="btn btn-xs btn-pink" value="기준정보관리" /></div>
					<table id="simple-table" class="table table-bordered table-bordered">
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 품목구분관리</th>
							<td class="col-xs-2">								
								<select name="frmItemClassify" id="frmItemClassify">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 품목그룹관리</th>
							<td class="col-xs-2">								
								<select name="frmItemGroup" id="frmItemGroup">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 품목매입처관리</th>
							<td class="col-xs-2">								
								<select name="frmItemBuyer" id="frmItemBuyer">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 거래처별품목단가관리</th>
							<td class="col-xs-2">								
								<select name="frmItemCost" id="frmItemCost">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>			
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 품목제조공정관리</th>
							<td class="col-xs-2">								
								<select name="frmItemProcess" id="frmItemProcess">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 품목관리</th>
							<td class="col-xs-2">								
								<select name="frmItem" id="frmItem">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 거래처구분관리</th>
							<td class="col-xs-2">								
								<select name="frmAccountClassify" id="frmAccountClassify">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 거래처관리</th>
							<td class="col-xs-2">								
								<select name="frmAccount" id="frmAccount">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 부서관리</th>
							<td class="col-xs-2">								
								<select name="frmDepartment" id="frmDepartment">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 직위관리</th>
							<td class="col-xs-2">								
								<select name="frmPosition" id="frmPosition">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 사원관리</th>
							<td class="col-xs-2">								
								<select name="frmEmployee" id="frmEmployee">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 창고관리</th>
							<td class="col-xs-2">								
								<select name="frmWarehouse" id="frmWarehouse">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 공정관리</th>
							<td class="col-xs-2">								
								<select name="frmProcess" id="frmProcess">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 생산설비관리</th>
							<td class="col-xs-2">								
								<select name="frmMachine" id="frmMachine">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 생산팀관리</th>
							<td class="col-xs-2">								
								<select name="frmTeam" id="frmTeam">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 프로젝트관리</th>
							<td class="col-xs-2">								
								<select name="frmProject" id="frmProject">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 용차관리</th>
							<td class="col-xs-2">								
								<select name="frmRentcar" id="frmRentcar">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 요금관리</th>
							<td class="col-xs-2">								
								<select name="frmRentcarCost" id="frmRentcarCost">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 엑셀자료등록</th>
							<td class="col-xs-2" colspan="5">								
								<select name="frmExcel" id="frmExcel">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
					</table>

					<div><input type="button" class="btn btn-xs btn-pink" value="수주.영업관리" /></div>
					<table id="simple-table" class="table table-bordered table-bordered">
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 견적관리</th>
							<td class="col-xs-2">								
								<select name="frmEstimate" id="frmEstimate">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 수주관리</th>
							<td class="col-xs-2">								
								<select name="frmObtainOrder" id="frmObtainOrder">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 출하지시관리</th>
							<td class="col-xs-2">								
								<select name="frmObtainOrderShipment" id="frmObtainOrderShipment">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> A/S관리</th>
							<td class="col-xs-2" colspan="5">								
								<select name="frmAs" id="frmAs">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
					</table>

					<div><input type="button" class="btn btn-xs btn-pink" value="생산관리" /></div>
					<table id="simple-table" class="table table-bordered table-bordered">
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 월간생산계획표</th>
							<td class="col-xs-2">								
								<select name="frmWorkPlan" id="frmWorkPlan">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 주간생산계획표</th>
							<td class="col-xs-2">								
								<select name="frmWorkPlanWeek" id="frmWorkPlanWeek">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 수주생산계획</th>
							<td class="col-xs-2">								
								<select name="frmProductSchedule" id="frmProductSchedule">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 작업지시서관리</th>
							<td class="col-xs-2">								
								<select name="frmWorkOrder" id="frmWorkOrder">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 작업지시현황</th>
							<td class="col-xs-2">								
								<select name="frmWorkCurrentState" id="frmWorkCurrentState">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 작업일보</th>
							<td class="col-xs-2">								
								<select name="frmWorkDaily" id="frmWorkDaily">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
					</table>

					<div><input type="button" class="btn btn-xs btn-pink" value="품질관리" /></div>
					<table id="simple-table" class="table table-bordered table-bordered">
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 검사항목관리</th>
							<td class="col-xs-2">								
								<select name="frmQcClassify" id="frmQcClassify">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 품질관리(QC)</th>
							<td class="col-xs-2">								
								<select name="frmQc" id="frmQc">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 불량관리</th>
							<td class="col-xs-2"></td>
						</tr>
					</table>

					<div><input type="button" class="btn btn-xs btn-pink" value="외주.사급관리" /></div>
					<table id="simple-table" class="table table-bordered table-bordered">
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 외주요청</th>
							<td class="col-xs-2">								
								<select name="frmOutsourcingRequest" id="frmOutsourcingRequest">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 외주품목관리</th>
							<td class="col-xs-2">								
								<select name="frmOutsourcingItem" id="frmOutsourcingItem">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 사급자재관리</th>
							<td class="col-xs-2">								
								<select name="frmBringinMaterial" id="frmBringinMaterial">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 외주발주관리</th>
							<td class="col-xs-2">								
								<select name="frmOutsourcing" id="frmOutsourcing">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 사급자재구매관리</th>
							<td class="col-xs-2">								
								<select name="frmBringinMaterialPurchase" id="frmBringinMaterialPurchase">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 외주품목입고현황</th>
							<td class="col-xs-2">								
								<select name="frmOutsourcingItemPurchase" id="frmOutsourcingItemPurchase">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 사급자재출고관리</th>
							<td class="col-xs-2">								
								<select name="frmBringinMaterialRelease" id="frmBringinMaterialRelease">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 외주창고관리</th>
							<td class="col-xs-2" colspan="3">								
								<select name="frmOutsourcingWarehouse" id="frmOutsourcingWarehouse">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
					</table>

					<div><input type="button" class="btn btn-xs btn-pink" value="구매.입고관리" /></div>
					<table id="simple-table" class="table table-bordered table-bordered">
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 구매요청</th>
							<td class="col-xs-2">								
								<select name="frmPurchase" id="frmPurchase">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 간편구매요청</th>
							<td class="col-xs-2">								
								<select name="frmEasyPurchase" id="frmEasyPurchase">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 발주서</th>
							<td class="col-xs-2">								
								<select name="frmOrder" id="frmOrder">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 입고</th>
							<td class="col-xs-2" colspan="5">								
								<select name="frmWarehousing" id="frmWarehousing">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
					</table>

					<div><input type="button" class="btn btn-xs btn-pink" value="출고.출하관리" /></div>
					<table id="simple-table" class="table table-bordered table-bordered">
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 출하지시서</th>
							<td class="col-xs-2">								
								<select name="frmShipmentOrder" id="frmShipmentOrder">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 출고요청서</th>
							<td class="col-xs-2">								
								<select name="frmRelease" id="frmRelease">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 자재수불부</th>
							<td class="col-xs-2">								
								<select name="frmInOut" id="frmInOut">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> Lot No 추적</th>
							<td class="col-xs-2" colspan="5"></td>
						</tr>
					</table>

					<div><input type="button" class="btn btn-xs btn-pink" value="재고관리" /></div>
					<table id="simple-table" class="table table-bordered table-bordered">
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 창고재고관리</th>
							<td class="col-xs-2">								
								<select name="frmWarehouseStock" id="frmWarehouseStock">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 재고현황</th>
							<td class="col-xs-2">								
								<select name="frmCurrentStock" id="frmCurrentStock">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 불출재고현황</th>
							<td class="col-xs-2">								
								<select name="frmReleaseWarehouse" id="frmReleaseWarehouse">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 재공재고현황</th>
							<td class="col-xs-2">								
								<select name="frmProcessStock" id="frmProcessStock">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 바코드관리</th>
							<td class="col-xs-2">								
								<select name="frmBarcode" id="frmBarcode">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 재고실사</th>
							<td class="col-xs-2">								
								<select name="frmStock" id="frmStock">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 안전재고관리</th>
							<td class="col-xs-2" colspan="5">								
								<select name="frmSafetyStock" id="frmSafetyStock">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
					</table>

					<div><input type="button" class="btn btn-xs btn-pink" value="그룹웨어" /></div>
					<table id="simple-table" class="table table-bordered table-bordered">
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 결재라인관리</th>
							<td class="col-xs-2">								
								<select name="frmApprovalLine" id="frmApprovalLine">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 내기안함</th>
							<td class="col-xs-2">								
								<select name="frmMyApproval" id="frmMyApproval">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 결재리스트</th>
							<td class="col-xs-2">								
								<select name="frmApproval" id="frmApproval">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 문서양식관리</th>
							<td class="col-xs-2">								
								<select name="frmApprovalDocument" id="frmApprovalDocument">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 지출결의서</th>
							<td class="col-xs-2">								
								<select name="frmSpendingResolution" id="frmSpendingResolution">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 계정과목관리</th>
							<td class="col-xs-2">								
								<select name="frmAccountSubject" id="frmAccountSubject">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 업무공유</th>
							<td class="col-xs-2">								
								<select name="frmBoard" id="frmBoard">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 일정관리</th>
							<td class="col-xs-2">								
								<select name="frmSchedule" id="frmSchedule">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
							<th class="col-xs-2" style="font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 파일보관함</th>
							<td class="col-xs-2">								
								<select name="frmFile" id="frmFile">
									<option value="a">접근불가</option>
									<option value="b">읽기</option>
									<option value="c">읽기/쓰기</option>
									<option value="d">읽기/쓰기/삭제</option>
								</select>
							</td>
						</tr>
					</table>

					<div><input type="button" class="btn btn-xs btn-pink" value="경영지원" /></div>
					<table id="simple-table" class="table table-bordered table-bordered">
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-primary" id="btnAuthSubmit">권한설정</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="12" />
<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

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
				document.getElementById('corp_zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('corp_address').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('corp_address').focus();
			}
		}
	}).open();
 }
 </script>

<script>
// $(document).keypress(function(e) {
// 	if(e.which === 13) search();
// });


function userAuth(emp_id, emp_nm){
	$("#user").val(emp_id);
	$("#userNm").html(emp_nm);
	
	var parameter = {"mode" : "getUserAuth", "emp_id" : emp_id};
	$.getJSON("ajax.php",{"parameter" : parameter},function(json){
		$("#frmItemClassify").val(json.frmItemClassify);
		$("#frmItemGroup").val(json.frmItemGroup);
		$("#frmItemBuyer").val(json.frmItemBuyer);
		$("#frmItemCost").val(json.frmItemCost);
		$("#frmItemProcess").val(json.frmItemProcess);
		$("#frmItem").val(json.frmItem);
		$("#frmAccountClassify").val(json.frmAccountClassify);
		$("#frmAccount").val(json.frmAccount);
		$("#frmDepartment").val(json.frmDepartment);
		$("#frmPosition").val(json.frmPosition);
		$("#frmEmployee").val(json.frmEmployee);
		$("#frmWarehouse").val(json.frmWarehouse);
		$("#frmProcess").val(json.frmProcess);
		$("#frmMachine").val(json.frmMachine);
		$("#frmTeam").val(json.frmTeam);
		$("#frmProject").val(json.frmProject);
		$("#frmRentcar").val(json.frmRentcar);
		$("#frmRentcarCost").val(json.frmRentcarCost);
		$("#frmExcel").val(json.frmExcel);
		$("#frmEstimate").val(json.frmEstimate);
		$("#frmObtainOrder").val(json.frmObtainOrder);
		$("#frmObtainOrderShipment").val(json.frmObtainOrderShipment);
		$("#frmAs").val(json.frmAs);
		$("#frmWorkPlan").val(json.frmWorkPlan);
		$("#frmWorkPlanWeek").val(json.frmWorkPlanWeek);
		$("#frmProductSchedule").val(json.frmProductSchedule);
		$("#frmWorkOrder").val(json.frmWorkOrder);
		$("#frmWorkCurrentState").val(json.frmWorkCurrentState);
		$("#frmWorkDaily").val(json.frmWorkDaily);
		$("#frmQcClassify").val(json.frmQcClassify);
		$("#frmQc").val(json.frmQc);
		$("#frmOutsourcingRequest").val(json.frmOutsourcingRequest);
		$("#frmOutsourcingItem").val(json.frmOutsourcingItem);
		$("#frmBringinMaterial").val(json.frmBringinMaterial);
		$("#frmOutsourcing").val(json.frmOutsourcing);
		$("#frmBringinMaterialPurchase").val(json.frmBringinMaterialPurchase);
		$("#frmOutsourcingItemPurchase").val(json.frmOutsourcingItemPurchase);
		$("#frmBringinMaterialRelease").val(json.frmBringinMaterialRelease);
		$("#frmOutsourcingWarehouse").val(json.frmOutsourcingWarehouse);
		$("#frmPurchase").val(json.frmPurchase);
		$("#frmEasyPurchase").val(json.frmEasyPurchase);
		$("#frmOrder").val(json.frmOrder);
		$("#frmWarehousing").val(json.frmWarehousing);
		$("#frmShipmentOrder").val(json.frmShipmentOrder);
		$("#frmRelease").val(json.frmRelease);
		$("#frmInOut").val(json.frmInOut);
		$("#frmWarehouseStock").val(json.frmWarehouseStock);
		$("#frmCurrentStock").val(json.frmCurrentStock);
		$("#frmReleaseWarehouse").val(json.frmReleaseWarehouse);
		$("#frmProcessStock").val(json.frmProcessStock);
		$("#frmBarcode").val(json.frmBarcode);
		$("#frmStock").val(json.frmStock);
		$("#frmSafetyStock").val(json.frmSafetyStock);
		$("#frmApprovalLine").val(json.frmApprovalLine);
		$("#frmMyApproval").val(json.frmMyApproval);
		$("#frmApproval").val(json.frmApproval);
		$("#frmApprovalDocument").val(json.frmApprovalDocument);
		$("#frmSpendingResolution").val(json.frmSpendingResolution);
		$("#frmAccountSubject").val(json.frmAccountSubject);
		$("#frmBoard").val(json.frmBoard);
		$("#frmSchedule").val(json.frmSchedule);		
		$("#frmFile").val(json.frmFile);

		showModal('userAuthModal');
	});
	
}

function refresh() {
	// $("#big_department_cd").val(0);
	// $("#middle_department_cd").val(0);
	// $("#small_department_cd").val(0);
	// $("#search_classify").val(0);
	$("#search_txt").val("");
	$("#where").val("");
	$("#page").val(1);
	getData(1);
}

$(document).on("keyup",".comma",
	function(){
		$(this).number(true);
	}
);

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );


	$("#emp_id_help").html("");

	var page = $("#page").val();
	getBigDepartment();
	postBigDepartment();
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

	$("#classify").on('change', function() {
		if($("#classify option:selected").val() == 0) {
			$("#search_txt").val("");
			$("#where").val("");
			getData(1);
		}
	});

	// 사원등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			if($("#uid").val() == "") {
				if($("#check_emp_cd").val() == "n") {
					showAlert("중복된 사원번호가 존재합니다");
					return;
				}

				if($("#check_emp_id").val() == "n") {
					showAlert("중복된 사원아이디가 존재합니다");
					return;
				}
			}

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
					getData(1);
					formClear();
					$("#uid").val("");
					$("#old_img").val("");
					$("#check_emp_cd").val("n");
					$("#check_emp_id").val("n");
					$("#btnSubmit").prop("disabled", false);

				},
				error: function (e) {
					$("#btnSubmit").prop("disabled", false);

				}
			});
		}
	});

	// 사원등록
	$("#btnAuthSubmit").click(function (event) {
		if(check("userAuthFrm")) {

			event.preventDefault();
			var form = $('#userAuthFrm')[0];
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
					showAlert("권한을 설정하였습니다");
					hideModal("userAuthModal");
				},
				error: function (e) {
					$("#btnSubmit").prop("disabled", false);
				}
			});
		}
	});

});

//==================================================
// 부서별 검색
//==================================================
function search_department() {
	var big = $("#big_department_cd option:selected").val();
	var middle = $("#middle_department_cd option:selected").val();
	var small = $("#small_department_cd option:selected").val();
	var where = "";

	if(big != 0 && big != "all") where += "where big_department_cd=" + big;
	if(middle != 0 && middle != "all") where += " and middle_department_cd=" + middle;
	if(small != 0 && small != "all") where += " and small_department_cd=" + small;

	$("#where").val(where);
	getData(1);
}

//==================================================
// 대부서 가져오기
//==================================================
function getBigDepartment(){
	var tag = "<option value='all'>부서선택</option>";
	var parameter = {"mode" : "getBigDepartment"};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}

			$("#big_department_cd").html(tag);
		}
	);
}

//==================================================
// 중부서 가져오기
//==================================================
function getMiddleDepartment(){
	var tag = "<option value='all'>부서선택</option>";
	var parameter = {"mode" : "getMiddleDepartment", "fid" : $("#big_department_cd option:selected").val()};
	$.getJSON("ajax.php", {"parameter" : parameter},
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

//==================================================
// 소부서 가져오기
//==================================================
function getSmallDepartment(){
	var tag = "<option value='all'>부서선택</option>";
	var parameter = {"mode" : "getSmallDepartment", "fid" : $("#middle_department_cd option:selected").val()};
	$.getJSON("ajax.php", {"parameter" : parameter},
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

//==================================================
// 사원등록용 대부서 가져오기
//==================================================
function postBigDepartment(){
	var parameter = {"mode" : "getBigDepartment"};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				postMiddleDepartment(json[i].uid);
			}
		}
	);
}

//==================================================
// 사원등록용 중부서 가져오기
//==================================================
function postMiddleDepartment(big){
	var tag = "<option value='all'>부서선택</option>";
	var parameter = {"mode" : "getMiddleDepartment", "fid" : big};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}

			$("#m_middle_department_cd").html(tag);
		}
	);
}

//==================================================
// 사원등록용 소부서 가져오기
//==================================================
function postSmallDepartment(middle){
	var tag = "<option value='all'>부서선택</option>";
	var parameter = {"mode" : "getSmallDepartment", "fid" : middle};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}
			$("#m_small_department_cd").html(tag);
		}
	);
}
//==================================================
// 사원번호 중복검사
//==================================================
function checkEmpCd(v) {
	if($("#uid").val() == "") {
		var parameter = {"mode" : "checkEmpCd", "emp_cd" : v};
		$.ajax({
			type : "post",
			data : parameter,
			url : "ajax.php",
			success : function(str) {
				if(str == "success") {
					$("#emp_cd_help").html("<span style='color:blue'>사용가능</span>");
					$("#check_emp_cd").val("y");
				} else {
					$("#emp_cd_help").html("<span style='color:red'>사용불가능</span>");
					$("#check_emp_cd").val("n");
				}
			}
		});
	}
}

//==================================================
// 사원아이디 중복검사
//==================================================
function checkEmpId(v) {
	if($("#uid").val() == "") {
		var parameter = {"mode" : "checkEmpId", "emp_id" : v};
		$.ajax({
			type : "post",
			data : parameter,
			url : "ajax.php",
			success : function(str) {
				if(str == "success") {
					$("#emp_id_help").html("<span style='color:blue'>사용가능</span>");
					$("#check_emp_id").val("y");
				} else {
					$("#emp_id_help").html("<span style='color:red'>사용불가능</span>");
					$("#check_emp_id").val("n");
				}
			}
		});
	}
}

//==================================================
// 모달 삭제
//==================================================
$('#confirm-delete').on('show.bs.modal', function(e) {
	//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$(this).find('.btn-ok').attr("href", "javascript:selectDelete();");
});

function selectDelete() {
	deleteSelect("employee");
	hideModal("confirm-delete");
}

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#frm")[0].reset();
	$("#btnSubmitTxt").text("사원 등록");
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
// 사원리스트 가져오기
//==================================================
function getData(page){
	var tag = "";
	var parameter = {"mode" : "getEmployeeList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick=\"toggle(this); postEmployee(" + json[i].uid + ", '" + json[i].emp_cd + "', '" + json[i].emp_nm + "', '" + json[i].emp_id + "', '" + json[i].emp_pwd + "', '" + json[i].gender + "', '" + json[i].regist_no + "', '" + json[i].mobile + "', '" + json[i].telephone + "', '" + json[i].email + "', '" + json[i].join_dt + "', '" + json[i].resign_dt + "', " + json[i].middle_department_cd + ", " + json[i].small_department_cd + ", '" + json[i].position_cd + "', '" + json[i].zipcode + "', '" + json[i].address + "', '" + json[i].img + "', " + json[i].pay + ", '" + json[i].national_pension + "', '" + json[i].emp_insure + "', '" + json[i].health_insure + "', '" + json[i].long_term_care + "');\" style='cursor:pointer'>";

					<? if($_SESSION['login_level'] >= 99) { ?>
					tag += "<td class='center'>";
					tag += "<label class='pos-rel'>";
					tag += "<input type='checkbox' class='ace flat chk' value='" + json[i].uid + "' />";
					tag += "<span class='lbl'></span>";
					tag += "</label>";
					tag += "</td>";
					<?}?>

					tag += "<td>" + json[i].emp_cd + "</td>";
					tag += "<td>" + json[i].emp_nm + "</td>";
					tag += "<td>" + json[i].gender + "</td>";
					tag += "<td>" + json[i].department + "</td>";
					tag += "<td>" + json[i].position_nm + "</td>";
					tag += "<td>" + json[i].mobile + "</td>";
					//tag += "<td>" + json[i].email + "</td>";
					//tag += "<td><input type='button' class='btn btn-xs btn-inverse' value='권한설정' onclick=\"userAuth('" + json[i].emp_id + "', '" + json[i].emp_nm + "')\" /></td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='11' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			//alert(tag);
			$("#tb tbody").html(tag);

			var table = "employee";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//==================================================
// 선택한 품목 처리
//==================================================
function postEmployee(uid, emp_cd, emp_nm, emp_id, emp_pwd, gender, regist_no, mobile, telephone, email, join_dt, resign_dt, middle_department_cd, small_department_cd, position_cd, zipcode, address, img, pay, national_pension, emp_insure, health_insure, long_term_care) {
	$("#emp_cd_help").html("");
	$("#emp_id_help").html("");
	$("#uid").val(uid);
	$("#emp_cd").val(emp_cd);
	$("#emp_cd").attr("readonly", true);
	$("#emp_nm").val(emp_nm);
	$("#emp_id").val(emp_id);
	$("#emp_id").attr("readonly", true);
	$("#emp_pwd").val(emp_pwd);

	$('input:radio[name=gender][value=' + gender + ']').prop("checked", true);
	$("#regist_no").val(regist_no);

	$("#mobile").val(mobile);

	$("#telephone").val(telephone);
	$("#email").val(email);
	$("#join_dt").val(join_dt);
	$("#resign_dt").val(resign_dt);
	$("#m_middle_department_cd").val(middle_department_cd);
	$("#m_small_department_cd").val(small_department_cd);
	$("#position_cd").val(position_cd);
	$("#zipcode").val(zipcode);
	$("#address").val(address);
	$("#pay").val(pay);

	if(national_pension != "y") $("input:checkbox[id='national_pension']").prop("checked", false);  
	else $("input:checkbox[id='national_pension']").prop("checked", true);    

	if(emp_insure != "y") $("input:checkbox[id='emp_insure']").prop("checked", false);  
	else $("input:checkbox[id='emp_insure']").prop("checked", true);    

	if(health_insure != "y") $("input:checkbox[id='health_insure']").prop("checked", false);  
	else $("input:checkbox[id='health_insure']").prop("checked", true);    

	if(long_term_care != "y") $("input:checkbox[id='long_term_care']").prop("checked", false);  
	else $("input:checkbox[id='long_term_care']").prop("checked", true);    

	if(img != "none") {
		$("#upDiv").css("display","block");
		$("#uploadImg").attr("src","attach/" + img);
		$("#old_img").val(img);
	} else {
		$("#upDiv").css("display","none");
	}

	$("#btnSubmitTxt").text("사원 수정");
}
//==================================================
// 품목코드 확인
//==================================================
function checkCode(modal_nm) {
	if($("#item_cd").val() == "") {
		showAlert("품목코드가 생성이 되어있지 않습니다.<br>품목코드 생성 후 진행하세요"); 
	} else {
		$("#p_item_cd").val($("#item_cd").val());
		showModal(modal_nm);
	}
}

//==================================================
// 규격 등록
//==================================================
function registStandard(modal_nm) {
	var parameter = {"mode" : "registStandard", "item_cd" : $("#p_item_cd").val(), "standard" : $("#p_standard").val()}
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(str) {
			if(str == "success") {
				$("#p_item_cd").val("");
				$("#p_standard").val("");
				hideModal(modal_nm);
			} else if(str == "dupp") {
				hideModal(modal_nm);
				showAlert("해당 품목코드 값을 가진 품목규격이 이미 존재합니다");
			}
		}
	});
}

//==================================================
// 규격 가져오기
//==================================================
function viewStandard(modal_nm) {
	var tag = "";
	var parameter = {"mode" : "getStandard", "item_cd" : $("#item_cd").val()};
	$.getJSON("ajax.php", {"parameter" : parameter},
		function(json) {
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++) {
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postData('" + json[i].standard + "','" + modal_nm + "')\">" + json[i].standard + "</a></td>";
					tag += "</tr>";
				}
			} else {
				tag = "<tr><td style='text-align:center; font-weight:bold; color:red;'>데이터가 존재하지 않습니다</td></tr>";
			}

			$("#standard_tb tbody").html(tag);
			showModal(modal_nm);
		}
	);
}

//==================================================
// 선택한 규격 처리
//==================================================
function postData(standard, modal_nm) {
	$("#standard").val(standard);
	hideModal(modal_nm);
}

//==================================================
// 품목코드 생성
//==================================================
function createCode(classify) {
	var parameter = {"mode" : "createItemCode", "classify" : classify};

	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		success : function(str) {
			$("#item_cd").val(str);
			$("#barcode").val(str);
		}
	});
}

//==================================================
// TR 삭제
//==================================================
function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#flag").val(nextFlag);
}

//==================================================
// 검색
//==================================================
function search(){
	var type = 1;

	if(type == 1){
		var search_txt = $("#search_txt").val();
		if(search_txt == ""){
			showAlert("검색어를 입력하세요");
			return false;
		}
		$("#where").val("where emp_cd like '@" + search_txt + "@' or emp_id like '@" + search_txt + "@' or emp_nm like '@" + search_txt + "@'");
	}

	$("#page").val(1);
	getData(1);
}

//==================================================
// 품목구분 품목 리스트 가져오기
//==================================================
function setItem(val) {
	$("#page").val(1);
	if(val == 0) $("#where").val("");
	else $("#where").val(" where classification=" + val);
	getData(1);
}
</script>