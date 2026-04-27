<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);
?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">매출전표</a>
				</li>
				<li class="active">매출전표 등록</li>
			</ul><!-- /.breadcrumb -->

			<div class="nav-search" id="nav-search">
				<form class="form-search">
					<span class="input-icon">
						<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
						<i class="ace-icon fa fa-search nav-search-icon"></i>
					</span>
				</form>
			</div><!-- /.nav-search -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					매출전표 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						매출전표를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="accounting" />
						<input type="hidden" name="action" id="action" value="registSalesStatementInsert" />
						<input type="hidden" name="statement_ca" id="statement_ca" value="" />
						<input type="hidden" name="totalprice" id="totalprice"  />
						<input type="hidden" name="totaltax" id="totaltax" />
						<input type="hidden" name="dialogid" id="dialogid" />
						
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">전표일자</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="statement_dt" id="statement_dt" type="text" value="<?=date('Y/m/d')?>" data-date-format="yyyy/mm/dd" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">부서코드</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="department_cd" id="department_cd" readonly />
												<input type="text" name="department_nm" id="department_nm" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog5">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">프로젝트코드</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="project_cd" id="project_cd" readonly />
												<input type="text" name="project_nm" id="project_nm" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog6">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">거래처</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="account_cd" id="account_cd" />
												<input type="text" name="account_nm" id="account_nm" />
												<span class="input-group-addon btn-purple" id="id-btn-dialog7">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">부가세유형</th>
								<td class="col-xs-5">
									<select name="vattype" id="vattype">
										<option value="1">세금계산서</option>
										<option value="2">영세율</option>
										<option value="3">계산서</option>
										<option value="4">소매매출</option>
										<option value="5">수출</option>
										<option value="6">카드매출</option>
										<option value="7">계산서(고정자산)</option>
										<option value="8">세.계(고정자산)</option>
										<option value="9">소매(면세)</option>
										<option value="10">카드매출(면세)</option>
										<option value="11">현금영수증(면세)</option>
										<option value="12">현금영수증</option>
										<option value="13">매입자발행세금계산서</option>
										<option value="14">영세율(기타)</option>
										<option value="15">기타매출</option>
									</select>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">예정누락</th>
								<td class="col-xs-5">
									<input name="tax_deduct" id="tax_deduct" type="radio" checked="checked" value="0"><label for="tax_deduct" data-cid="tax_deduct" data-role="widget-focus">정상</label>&nbsp;<input name="tax_deduct" id="tax_deduct" type="radio" value="1"><label for="tax_deduct" data-cid="tax_deduct" data-role="widget-focus">예정누락</label>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">세금계산서구분</th>
								<td class="col-xs-11" colspan=3>
									<select name="invoiceType" id="invoiceType">
										<option value="1">종이(세금)계산서</option>
										<option value="2">전자(세금)계산서-신규</option>
										<option value="3">기재사항착오정정</option>
										<option value="4">공급가액변동</option>
										<option value="5">환입</option>
										<option value="6">계약의해제</option>
										<option value="7">내국신용장개설</option>
										<option value="8">착오에의한이중발행</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">적요</th>
								<td class="col-xs-8" colspan=3><input type="text" name="summary" id="summary" class="form-control" /></td>
							</tr>
						</table>
						
						<a class="btn btn-xs btn-inverse" onclick="addTr()">삽입</a>
						<table id="statement" class="table  table-bordered table-hover" style="margin-top:10px">
							<thead>
								<tr>
									<th class="center " style="background-color:#f1f1f1;width:30px"></th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">계정코드</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">매출계정</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">공급가액</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">부가세</th>
									<th class="center col-xs-6" style="background-color:#f1f1f1">적요</th>
								</tr>
							</thead>
							<tbody>
								<tr class="item1">
									<td class="center"><i class='delBtn fa fa-minus-square fa-1x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><input type="text" class="form-control id-btn-dialog aci_cd" name="aci_cd[]" id="aci_cd_1"  onclick="acicdFlag(1)"  placeholder="계정코드" readonly /></td>
									<td><input type="text" class="form-control aci_nm" name="aci_nm[]" id="aci_nm_1" readonly /></td>
									<td><input type="text" class="form-control text-right" name="supply_price[]" id="supply_price_1" onkeyup="calculation(1)" /></td>
									<td><input type="text" class="form-control text-right" name="tax[]" id="tax_1"  /></td>
									<td><input type="text" class="form-control " name="remark[]" id="remark_1"  /></td>
								</tr>
								<tr class="item2">
									<td class="center"><i class='delBtn fa fa-minus-square fa-1x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><input type="text" class="form-control id-btn-dialog aci_cd" name="aci_cd[]" id="aci_cd_2" onclick="acicdFlag(2)" placeholder="계정코드" readonly /></td>
									<td><input type="text" class="form-control aci_nm" name="aci_nm[]" id="aci_nm_2" readonly /></td>
									<td><input type="text" class="form-control text-right" name="supply_price[]" id="supply_price_2" onkeyup="calculation(2)" /></td>
									<td><input type="text" class="form-control text-right" name="tax[]" id="tax_2"  /></td>
									<td><input type="text" class="form-control " name="remark[]" id="remark_2"  /></td>
								</tr>
								<tr class="item3">
									<td class="center"><i class='delBtn fa fa-minus-square fa-1x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><input type="text" class="form-control id-btn-dialog aci_cd" name="aci_cd[]" id="aci_cd_3" onclick="acicdFlag(3)" placeholder="계정코드" readonly /></td>
									<td><input type="text" class="form-control aci_nm" name="aci_nm[]" id="aci_nm_3" readonly /></td>
									<td><input type="text" class="form-control text-right" name="supply_price[]" id="supply_price_3" onkeyup="calculation(3)" /></td>
									<td><input type="text" class="form-control text-right" name="tax[]" id="tax_3"  /></td>
									<td><input type="text" class="form-control " name="remark[]" id="remark_3"  /></td>
								</tr>
								<tr class="item4">
									<td class="center"><i class='delBtn fa fa-minus-square fa-1x' aria-hidden='true' onclick='delTr(this)'></i></td>
									<td><input type="text" class="form-control id-btn-dialog aci_cd" name="aci_cd[]" id="aci_cd_4" onclick="acicdFlag(4)" placeholder="계정코드" readonly /></td>
									<td><input type="text" class="form-control aci_nm" name="aci_nm[]" id="aci_nm_4" readonly /></td>
									<td><input type="text" class="form-control text-right" name="supply_price[]" id="supply_price_4" onkeyup="calculation(4)" /></td>
									<td><input type="text" class="form-control text-right" name="tax[]" id="tax_4"  /></td>
									<td><input type="text" class="form-control " name="remark[]" id="remark_4"  /></td>
								</tr>
								<tr>
									<th class="center " style="background-color:#f1f1f1;height:30px"><SPAN></SPAN></th>
									<th class="center col-xs-2" style="background-color:#f1f1f1"><SPAN></SPAN></th>
									<th class="center col-xs-2" style="background-color:#f1f1f1"><SPAN></SPAN></th>
									<th class="center col-xs-2" style="background-color:#f1f1f1"><SPAN class="supply_price_Total"></SPAN></th>
									<th class="center col-xs-2" style="background-color:#f1f1f1"><SPAN class="tax_Total"></SPAN></th>
									<th class="center col-xs-6" style="background-color:#f1f1f1"><SPAN class="remarkAmount "></SPAN></th>
								</tr>
							</tbody>
						</table>

						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">(-)지급수수료</th>
								<td class="col-xs-10">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="receiptfee_cd" id="receiptfee_cd" value="8319" readonly />
												<input type="text" name="receiptfee_nm" id="receiptfee_nm" value="지급수수료(판)" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog8">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												&nbsp;<input type="text" name="receiptfee_price" id="receiptfee_price" value="0" class="text-right" />
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">(-)입금된계좌번호</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="bank_num" id="bank_num" readonly />
												<input type="text" name="bank_name" id="bank_name" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog9">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												&nbsp;<input type="text" name="receiptbank_num" id="receiptbank_num" value="0" class="text-right" />
											</div>
										</span>
									</div>
								</td>

							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">외상매출금</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="accountsrecev_cd" id="accountsrecev_cd" value="1089" readonly />
												<input type="text" name="accountsrecev_nm" id="accountsrecev_nm" value="외상매출금" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog100">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
												&nbsp;<input type="text" name="accounts_recev_price" id="accounts_recev_price" class="text-right" readonly/>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">세금계산서등록 세부내역</th>
								<td class="col-xs-8" colspan=3>
								<button class="btn btn-link btn-xs" type="button" onclick="tax_invoice_reg('0','s','0')">
									<i class="ace-icon fa fa-search icon-on-right bigger-80"></i>
									세부내역
								</button>
									
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div><!-- /.row -->
			
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-minus-square bigger-110"></i>
						저장
					</button>

					<button class="btn " type="button" onclick="ㅁ()">
						<i class="ace-icon fa fa-minus-square bigger-110"></i>
						닫기
					</button>

					<button class="btn" type="reset">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록가기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<input type="hidden" name="flag" id="flag" value="4" />
<input type="hidden" name="acicdFlag" id="acicdFlag" value="" />
<input type="hidden" name="accountcdFlag" id="accountcdFlag" value="" />
<input type="hidden" name="slipgubunFlag" id="slipgubunFlag" value="" />


<div id="dialog-message1" class="dialog-view hide">
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="col-xs-12">
						<div class="col-xs-3" style="float:left">
							거래처 검색
						</div>
						<div class="col-xs-8" style="float:right">
							<div class="col-xs-12"  style="float:right">
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
						</div>
					</div>
					<div style="clear:both"></div>
					<div style="margin-top:10px">
						<table id="account_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="col-xs-2 center" style="background-color:#f1f1f1">거래처구분</th>
									<th class="col-xs-5 center" style="background-color:#f1f1f1">거래처코드</th>
									<th class="col-xs-5 center" style="background-color:#f1f1f1">거래처명</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
			</div>
		</div>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->


<div id="dialog-message2" class="dialog-view hide">
	<table id="project_list" class="table table-bordered">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">프로젝트코드</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">프로젝트명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<div id="dialog-message3" class="dialog-view hide">
	<select name="item_gb" id="item_gb">
		<option>전체</option>
		<option value="component">자재</option>
		<option value="semi_product">반제품</option>
		<option value="product" selected>완제품</option>
	</select>
	<table id="item_list" class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-1 center" style="background-color:#f1f1f1">구분</th>
				<th class="col-xs-3 center" style="background-color:#f1f1f1">품목코드</th>
				<th class="col-xs-4 center" style="background-color:#f1f1f1">품목명</th>
				<th class="col-xs-4 center" style="background-color:#f1f1f1">규격</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<div id="dialog-message4" class="dialog-view hide">
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="col-xs-12">
						<div class="col-xs-3" style="float:left">
							계정코드검색
						</div>
						<!-- <div class="col-xs-4" style="float:left">
						<select class="form-control" onchange="setAccountCode(this.value)">
							<option value="cd">계정코드</option>
							<option value="nm">계정명</option>
						</select>
						</div> -->
						<div class="col-xs-8" style="float:right">
							<div class="col-xs-12"  style="float:right">
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
						</div>
					</div>
					<div style="clear:both"></div>
					<div style="margin-top:10px">
						<table id="account_code_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="col-xs-6 center" style="background-color:#f1f1f1">[계정코드] 계정명</th>
									<th class="col-xs-6 center" style="background-color:#f1f1f1">검색창내용</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
			</div>
		</div>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<div id="dialog-message1" class="hide">
	<table id="department_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">부서코드</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">부서명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<div id="dialog-message6" class="dialog-view hide">
	<table id="project_list" class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">프로젝트코드</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">프로젝트명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<div id="dialog-message7" class="dialog-view hide">
	<table id="account_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-2 center" style="background-color:#f1f1f1">거래처구분</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">거래처코드</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">거래처명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<div id="dialog-message8" class="dialog-view hide">
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="col-xs-12">
						<div class="col-xs-3" style="float:left">
							계정코드검색
						</div>
						<!-- <div class="col-xs-4" style="float:left">
						<select class="form-control" onchange="setAccountCode(this.value)">
							<option value="cd">계정코드</option>
							<option value="nm">계정명</option>
						</select>
						</div> -->
						<div class="col-xs-8" style="float:right">
							<div class="col-xs-12"  style="float:right">
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
						</div>
					</div>
					<div style="clear:both"></div>
					<div style="margin-top:10px">
						<table id="account_code_list_1" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="col-xs-6 center" style="background-color:#f1f1f1">[계정코드] 계정명</th>
									<th class="col-xs-6 center" style="background-color:#f1f1f1">검색창내용</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
			</div>
		</div>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->
									
<div id="dialog-message9" class="dialog-view hide">
	<table id="bank_list" class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">계좌번호</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">계좌명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:99%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">세금계산서내역등록</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="tax_invoice_reg_frame" frameborder="0" width="99%" height="670" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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

<!-- Table Tr Add ------------------------------------------------------------------------------------------------------->
<script>
function addTr(){
	var currentFlag = $("#flag").val();
	var tag = "";
	
	tag += "<tr class='item" + currentFlag + "'>";
	tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-1x' aria-hidden='true' onclick='delTr(this)'></i></td>";
	tag += "<td><input type='text' class='form-control id-btn-dialog aci_cd' name='aci_cd[]' id='aci_cd_" + currentFlag + "' onclick='acicdFlag(" + currentFlag + ")'  placeholder='계정코드' readonly /></td>";
	tag += "<td><input type='text' class='form-control aci_nm' name='aci_nm[]' id='aci_nm_" + currentFlag + "' readonly /></td>";
	tag += "<td><input type='text' class='form-control supply_price' name='supply_price[]' id='supply_price_" + currentFlag + "' onkeyup='calculation(" + currentFlag + ")' readonly /></td>";
	tag += "<td><input type='text' class='form-control tax' name='tax[]' id='tax_" + currentFlag + "' readonly/></td>";
	tag += "<td><input type='text' class='form-control' name='remark[]' id='remark_" + currentFlag + "'  /></td>";
	tag += "<td><input type='text' class='form-control' name='writer[]' id='writer_" + currentFlag + "'  /></td>";
	tag += "</tr>";
	$("#statement").append(tag);
	
	var nextFlag = Number(currentFlag) + 1;
	$("#flag").val(nextFlag);
}

function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#flag").val(nextFlag);
}
</script>
<!----------------------------------------------------------------------------------------------------------------------->
<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getProject();
	getAccount();
	getDepartment(1);
	getBank();
	getAccountCode();
	getAccountCodeReceipt();
	createStatementCa();
	//slipTypeNow();

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

function createStatementCa(){
	var data_string = "mode=createStatementCa";
	$.ajax({
		type : "post",
		url : "ajax/statement.php",
		data : data_string,
		success : function(str) {
			$("#statement_ca").val(str);
		}
	});
}



function acicdFlag(flag) {
	$("#acicdFlag").val(flag);
}

function accountcdFlag(flag) {
	$("#accountcdFlag").val(flag);
}
function slipgubunFlag(flag) {
	$("#slipgubunFlag").val(flag);
}
function self_close()
{	
	parent.$.modal.close();
}
/*
function close_popup()
{	
	$.modal.close();
}*/
function close_popup()
{	
	//$.dialog.close();
	$("#dialog-message1").dialog("close");
	$("#dialog-message2").dialog("close");
	$("#dialog-message3").dialog("close");
	$("#dialog-message4").dialog("close");
	$("#dialog-message5").dialog("close");
}

//-----------------------------------------------------------------------
// 기  능 : 숫자를 금액 형식으로
//-----------------------------------------------------------------------
function Num2Money(number){

	number		=	Money2Num(number);

	if(isNaN(number))			return number;
	if(parseFloat(number)==0)	return 0;
	if(!number)					return "";
	var strint="";
	var strfloat="";
	var tmp;
	var ans="";
	var isfloat=false;
	var minus=false;
	var result='';

	if(number.indexOf("-")>-1){
		minus=true;
		number=number.replace('-','');
	}

	if(number.indexOf(".")==-1) strint=number;
	else {
		isfloat=true;
		strint=number.substring(0,number.indexOf("."));
		if(parseInt(strint,10)==0)	strint = '0';
		strfloat=number.substring(number.indexOf("."),number.length);
	}

	if(!isNaN(strint) && strint!=""){
		strint	=	String(parseInt(strint,10));
	}

	var num=strint.split("");

	tmp=num.reverse();

	for(a=0;a<tmp.length;a++) {
		if(!(a%3) && a!=0) { ans+=",";  }
		ans+=tmp[a];
	}

	tmp=ans.split("").reverse();
	ans="";

	for(a=0;a<tmp.length;a++){ ans+=tmp[a];}

	for(a=0;a<2;a++)
		if(ans.charAt(0)=="0" || ans.charAt(0)==",") ans=ans.substring(1,ans.length);

	result=ans+strfloat;

	if(isfloat==true){
		var lastchar=result.substr(result.length-1,1);
		while (lastchar == '0' || lastchar == '.'){
			result = result.substr(0,result.length-1);
			if (lastchar == '.'){break;}
			lastchar=result.substr(result.length-1,1);
		}
	}

	var tmpresult = parseFloat(Money2Num(result));

	if(tmpresult>0 && tmpresult<1){
		result = '0'+result;
	}

	return	(minus==true) ? '-'+result : result
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

function calcDebtorTotal(Obj,flag) {
	if ($(Obj).attr('readonly'))
		return;
	var Debtor = Money2Num($(Obj).parent().parent().find("input[name='debtor[]']").val());
	var Creditor = Money2Num($(Obj).parent().parent().find("input[name='creditor[]']").val());
	debtorTotalPrice(flag);
	//creditorTotalPrice(flag);
}

function calcCreditorTotal(Obj,flag) {
	if ($(Obj).attr('readonly'))
		return;
	var Debtor = Money2Num($(Obj).parent().parent().find("input[name='debtor[]']").val());
	var Creditor = Money2Num($(Obj).parent().parent().find("input[name='creditor[]']").val());
	
	//debtorTotalPrice(flag);
	creditorTotalPrice(flag);
}

function debtorTotalPrice(flag) {
	
	if ($("input[name='debtor[]']").length > 0) {
		var debtorTotal = 0;

		$("input[name='debtor[]']").each(function () {
			var debtor = Money2Num($(this).val());
			if (debtor != "" && !isNaN(debtor))
				debtorTotal = debtorTotal + parseInt(debtor, 10);
		});

		$(".debtorTotal").html(Num2Money(debtorTotal));
		$("#creditor_" + flag).val("0");
		
		var dcTotalPriceRe = (removeComma($(".debtorTotal").text()) -removeComma($(".creditorTotal").text()));
		//alert(dcTotalPriceRe)
		$(".remarkAmount").html(Num2Money(dcTotalPriceRe));
		$("#accounts_recev_price").val(Num2Money(dcTotalPriceRe));
		//alert(removeComma($(".debtorTotal").text()))
		$("#totalprice").val(removeComma($(".debtorTotal").text()));
	}
	$("input[name='debtor[]']").each(function () {
		$(this).val(Num2Money($(this).val()));
	});


}

function creditorTotalPrice(flag) {
	
	if ($("input[name='creditor[]']").length > 0) {
		var creditorTotal = 0;

		$("input[name='creditor[]']").each(function () {
			var creditor = Money2Num($(this).val());
			if (creditor != "" && !isNaN(creditor))
				creditorTotal = creditorTotal + parseInt(creditor, 10);
		});
		$(".creditorTotal").html(Num2Money(creditorTotal));
		$("#debtor_" + flag).val("0");

		var dcTotalPriceRe = (removeComma($(".debtorTotal").text()) -removeComma($(".creditorTotal").text()));
		//alert(dcTotalPriceRe)
		$(".remarkAmount").html(Num2Money(dcTotalPriceRe));
		$("#accounts_recev_price").val(Num2Money(dcTotalPriceRe));
	}
	$("input[name='creditor[]']").each(function () {
		$(this).val(Num2Money($(this).val()));
	});
}



function slipType(flag){
var type = $("select[name=type]").val();
var slip_type = $("#slip_gubun_" + flag +" option:selected").val();

	if (slip_type=="1"){
		$("#creditor_" + flag).prop('readonly', true);
		$("#debtor_" + flag).prop('readonly', false);
	}else if (slip_type=="2"){
		$("#debtor_" + flag).prop('readonly', true);
		$("#creditor_" + flag).prop('readonly', false);
		
	}else if (slip_type=="3"){
		$("#creditor_" + flag).prop('readonly', true);
		$("#debtor_" + flag).prop('readonly', false);
	}else if (slip_type=="4"){
		$("#debtor_" + flag).prop('readonly', true);
		$("#creditor_" + flag).prop('readonly', false);
	}
}
function slipTypeNow(flag){
	var slip_type1 = $("#slip_gubun_1 option:selected").val();
	var slip_type2 = $("#slip_gubun_2 option:selected").val();
	var slip_type3 = $("#slip_gubun_3 option:selected").val();
	var slip_type4 = $("#slip_gubun_4 option:selected").val();
	
	$("input[name='debtor[]']").prop('readonly', false);
	$("input[name='creditor[]']").prop('readonly', true);
	/*
	if (slip_type1=="1"){
		$("#creditor_1").prop('readonly', true);
		$("#debtor_1").prop('readonly', false);
	}
	if (slip_type2=="1"){
		$("#debtor_" + flag).prop('readonly', true);
		$("#creditor_" + flag).prop('readonly', false);
	}
	if (slip_type3=="3"){
		$("#creditor_" + flag).prop('readonly', true);
		$("#debtor_" + flag).prop('readonly', false);
	}
	if (slip_type4=="4"){
		$("#debtor_" + flag).prop('readonly', true);
		$("#creditor_" + flag).prop('readonly', false);
	}
	*/
}

function tax_calculation(slip_gubun){
	var cnt = new Array();
	var supply_price = new Array();
	var tax = new Array();
	var hap = new Array();

	var re_supply_price = new Array();
	var re_tax = new Array();
	var total = new Array();
	var values = 0;

	$.each($(".cnt") , function () {
		cnt.push(removeComma($(this).val()));
	});

	$.each($(".supply_price") , function () {
		supply_price.push(removeComma($(this).val()));
	});

	$.each($(".tax") , function () {
		tax.push(removeComma($(this).val()));
	});

	for(var i = 0 ; i < cnt.length ; i++) {
		if(cnt[i] > 0) {
			values = Number(cnt[i]) * Number(supply_price[i]);

			// 부가세적용
			if(slip_gubun == 1) {
				var supply_price = values/1.1;
				var cal_tax = values-supply_price;
				var re_hap = values + cal_tax;
				
				re_supply_price.push(supply_price);
				re_tax.push(cal_tax);
				total.push(Number(re_hap));
			} else { // 부가세 미적용
				var re_hap = supply_price[i];
				var cal_tax = 0;

				re_supply_price.push(re_hap);
				re_tax.push(cal_tax);
				total.push(re_hap * cnt[i]);
			}
		}
	}

	for (var i = 0 ; i < cnt.length ; i++)
	{
		if(removeComma(total[i]) > 0) {
			$(".tax").eq(i).val(Math.round(re_tax[i]));
			$(".total_price").eq(i).val(commaSplit(Math.round(total[i])));
		}
	}
}

// 공급가액 계산
function calculation(flag) {
	var tax_type = $("#vattype option:selected").val();
//	var cnt = $("#cnt_" + flag).val();
//	var pur_supply_price = $("#pur_supply_price_" + flag).val();
	var supply_price = $("#supply_price_" + flag).val();
//	var values = Number(removeComma(cnt)) * Number(removeComma(supply_price));
	var values = Number(removeComma(supply_price));

	// 부가세적용 1 4 6 8 12 13
	if(tax_type == 1 || tax_type == 4  || tax_type == 6  || tax_type == 8  || tax_type == 12  || tax_type == 13) {
		var supply_price = parseInt(values)/10;
		//var tax = parseInt(values) - parseInt(supply_price);
		var tax = parseInt(supply_price);

		//$("#supply_price_" + flag).val(commaSplit(Math.round(values + tax)));
	} else {
		var tax = 0;
		//$("#supply_price_" + flag).val(commaSplit(Math.round(values + tax)));
	}
	//$("#supply_price_" + flag).val(Num2Money(supply_price));
	$("#tax_" + flag).val(commaSplit(Math.round(tax)));
		

	if ($("input[name='supply_price[]']").length > 0) {
	
		var supply_price_Total = 0;
		var tax_Total = 0;

		$("input[name='supply_price[]']").each(function () {
			var supply_price = Money2Num($(this).val());
			if (supply_price != "" && !isNaN(supply_price))
				supply_price_Total = supply_price_Total + parseInt(supply_price, 10);
		});

		$("input[name='tax[]']").each(function () {
			var tax = Money2Num($(this).val());
			if (tax != "" && !isNaN(tax))
				tax_Total = tax_Total + parseInt(tax, 10);
		});

		$(".supply_price_Total").html(Num2Money(supply_price_Total));
		$(".tax_Total").html(Num2Money(tax_Total));
		
		var utTotalPriceRe = (parseInt(removeComma($(".supply_price_Total").text())) + parseInt(removeComma($(".tax_Total").text())));
		//alert(dcTotalPriceRe)
		$(".remarkAmount").html(Num2Money(utTotalPriceRe));
		$("#accounts_recev_price").val(Num2Money(utTotalPriceRe));
		$("#totalprice").val(removeComma($(".supply_price_Total").text()));
		$("#totaltax").val(removeComma($(".tax_Total").text()));
	}
	$("input[name='supply_price[]']").each(function () {
		$(this).val(Num2Money($(this).val()));
	});

}

function createItemGroupCode(){
	var data_string = "mode=createItemGroupCode";

	$.ajax({
		type : "post",
		url : "ajax/ajax.php",
		data : data_string,
		success : function(str) {
			$("#sub_item_group_cd").val(str);
		}
	});	
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

function getDepartment(page) {
	var rpp = 15;
	var adjacents = 4;
	var page = page;
	var tag = "";

	$.getJSON("ajax/department.php",{"page":page, "mode":"getDepartment", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postDepartmentData('" + json[i].uid + "','" + json[i].department_nm + "')\">" + json[i].department_nm + "</a></td>";
					tag += "</tr>";
				}
			}

			$("#department_list tbody").html(tag);

			var table = "erp_department";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function getProject() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;

	$.getJSON("ajax/groupware.php",{"page":page, "mode":"getProject", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postProject('" + json[i].project_cd + "','" + json[i].project_nm + "')\">" + json[i].project_cd + "</a></td>";
					tag += "<td>" + json[i].project_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#project_list tbody").html(tag);

			var table = "erp_project";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function getAccountCode() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var aci_cd = $("#aci_cd").val();

	$.getJSON("ajax/account_code.php",{"page":page, "mode":"get_account_code", "rpp" : rpp, "adjacents" : adjacents, "where":search, "aci_cd":aci_cd},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccountCode('" + json[i].aci_cd + "','" + json[i].aci_nm + "')\">[" + json[i].aci_cd + "] " + json[i].aci_nm + "</a></td>";
					tag += "<td>" + json[i].search_box + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_code_list tbody").html(tag);

			var table = "erp_account_code";
			if(aci_cd == "" || aci_cd == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and aci_cd='"  + aci_cd + "'";
			}

			//getPaging(table,where,rpp,adjacents);
		}
	);
}

function getAccountCodeReceipt() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var aci_cd = $("#aci_cd").val();

	$.getJSON("ajax/account_code.php",{"page":page, "mode":"get_account_code", "rpp" : rpp, "adjacents" : adjacents, "where":search, "aci_cd":aci_cd},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccountCodeReceipt('" + json[i].aci_cd + "','" + json[i].aci_nm + "')\">[" + json[i].aci_cd + "] " + json[i].aci_nm + "</a></td>";
					tag += "<td>" + json[i].search_box + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_code_list_1 tbody").html(tag);

			var table = "erp_account_code";
			if(aci_cd == "" || aci_cd == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and aci_cd='"  + aci_cd + "'";
			}

			//getPaging(table,where,rpp,adjacents);
		}
	);
}

// 계좌 리스트 가져오기
function getBank(){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var warehouse_gb = $("#warehouse_gb").val();

	$.getJSON("ajax/bank.php",{"page":page, "mode":"get_bank_list", "rpp" : rpp, "adjacents" : adjacents, "where":search, "warehouse_gb":warehouse_gb},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td class='center'>" + json[i].bank_num + "</td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postBanks('" + json[i].bank_num + "','" + json[i].bank_name + "') \">" + json[i].bank_name + "</a></td>";
					tag += "</tr>";
				}
			}
			
			$("#bank_list tbody").html(tag);

			var table = "erp_bank_list";
			var where = "";
			//if(account_gb == "" || account_gb == "all") {
			//	var where = $("#where").val();
			//} else {
			//	var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			//}

			getPaging(table,where,rpp,adjacents);
		}
	);
}


function postItem(aci_cd,aci_nm,account_cd,pur_supply_price,supply_price,lot_no){
	var arr = [];
	$.each($(".aci_cd") , function () {
		arr.push($(this).val());
			/*
			if($(this).val() == aci_cd) {
				alert("이미 선택한 품목입니다");
			} else {
				var flag = $("#acicdFlag").val();
				$("#aci_cd_" + flag).val(aci_cd);
				$("#aci_nm_" + flag).val(aci_nm);
				$("#unit_" + flag).val(unit);
				$("#pur_supply_price_" + flag).val(pur_supply_price);
				$("#supply_price_" + flag).val(supply_price);
			}*/
	});
	var idx = jQuery.inArray(aci_cd, arr);
	if(idx >= 0) {
		//alert("동일 품목을 이미 선택하셨습니다");
	} else {
		var flag = $("#acicdFlag").val();
		$("#aci_cd_" + flag).val(aci_cd);
		$("#aci_nm_" + flag).val(aci_nm);
		$("#account_cd_" + flag).val(account_cd);
		$("#pur_supply_price_" + flag).val(pur_supply_price);
		$("#supply_price_" + flag).val(supply_price);
		$("#lot_no_" + flag).val(lot_no);
	}
}

// 거래처 리스트 가져오기
function getAccount(){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var account_gb = $("#account_gb").val();
 
	$.getJSON("ajax/account.php",{"page":page, "mode":"getAccount", "rpp" : rpp, "adjacents" : adjacents, "where":search, "account_gb":account_gb},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					if(json[i].account_gb == "purchase") var clas = "매입";
					else var clas = "매출";
					
					tag += "<tr>";
					tag += "<td class='center'>" + clas + "</td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccount('" + json[i].account_cd + "','" + json[i].account_nm + "')\">" + json[i].account_cd + "</a></td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_list tbody").html(tag);

			var table = "erp_account";
			var where = "";
			//if(account_gb == "" || account_gb == "all") {
			//	var where = $("#where").val();
			//} else {
			//	var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			//}

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 거래처 리스트 가져오기
function getWarehouse(){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var warehouse_gb = $("#warehouse_gb").val();

	$.getJSON("ajax/warehouse.php",{"page":page, "mode":"getWarehouse", "rpp" : rpp, "adjacents" : adjacents, "where":search, "warehouse_gb":warehouse_gb},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].warehouse_cd + "'>" + json[i].warehouse_nm + "</option>";
				}
			}

			$("#warehouse_cd").append(tag);
		}
	);
}

// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getAccount(page);
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

// 검색
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	if(search_choice == "account_nm") {
		$("#where").val(" where 1=1 and account_nm like '%" + txt + "%' ");
	} else if(search_choice == "account_cd") {
		$("#where").val(" where 1=1 and account_cd like '%" + txt + "%' ");
	}
	getAccount(1);
}

function postAccountCode(aci_cd,aci_nm){
	$("#dialog-message4").dialog("close");
	var arr = [];
	$.each($(".aci_cd") , function () {
		arr.push($(this).val());
	});
	var idx = jQuery.inArray(aci_cd, arr);
	//if(idx >= 0) {
	//	alert("동일 계정을 이미 선택하셨습니다");
	//} else {
		var flag = $("#acicdFlag").val();
		$("#aci_cd_" + flag).val(aci_cd);
		$("#aci_nm_" + flag).val(aci_nm);
	//}
}

function postAccount(code,name,manager) {
	$("#dialog-message7").dialog("close");
	$("#account_cd").val(code);
	$("#account_nm").val(name);
}

function postDepartmentData(cd,nm) {
	$("#dialog-message5").dialog("close");
	$("#department_cd").val(cd);
	$("#department_nm").val(nm);
}


function postProject(code,name) {
	$("#dialog-message6").dialog("close");
	$("#project_cd").val(code);
	$("#project_nm").val(name);
}

function postAccountCodeReceipt(code,name){
	$("#dialog-message8").dialog("close");
	$("#receiptfee_cd").val(code);
	$("#receiptfee_nm").val(name);
	//}
}
function postBanks(code,name){
	$("#dialog-message9").dialog("close");
	$("#bank_num").val(code);
	$("#bank_name").val(name);
	//}
}

function formSubmit(){
	alert('저장')
	$("#frm").submit();
}
function closePopup()
{
	window.parent.closeModal('<?=$dialogid?>');
	window.parent.location.reload();

}
window.closeModal = function(obj) {
	$("#"+obj).modal( 'hide' );
}
</script>

<!----------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-phone').mask('(999) 999-9999');
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
				
	$( ".id-btn-dialog1" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>거래처검색</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

				
	$( "#id-btn-dialog2" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message2" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>프로젝트 리스트</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	$( document).on('click',".id-btn-dialog", function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message4" ).removeClass('hide').dialog({
			width : 700,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>계정코드검색</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	$( "#id-btn-dialog5" ).on('click', function(e) {
		e.preventDefault();
		var dialog = $( "#dialog-message5" ).removeClass('hide').dialog({
			width : 300,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>부서 리스트</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	$( "#id-btn-dialog6" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message6" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>프로젝트 리스트</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});
	
	$( "#id-btn-dialog7" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message7" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>거래처 리스트</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});
	

	$( "#id-btn-dialog8" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message8" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>계정코드검색</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	$( "#id-btn-dialog9" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message9" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>계좌 리스트</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
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
});
</script>
<!----------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
<!--
	function tax_invoice_reg(cidx, type, arprice)
	{
	$("#id-btn-dialog1").modal({
		show: true,
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});
	var arprice = removeComma($("#accounts_recev_price").val());
	var url = "index.php?controller=accounting&action=registTaxInvoicePop&statement_no="+cidx+"&pop=Y&statement_type="+type+"&arprice="+arprice;
	//var url = "./views/accounting/card/cardcompany_remark_list_pop.php?&gid="+cidx+"&pop=Y&ddd="+cidx;
	$("#tax_invoice_reg_frame").attr("src", url);
	}

	function tax_invoice_modiy(cidx, type, arprice)
	{
	$("#id-btn-dialog2").modal({
		show: true,
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	var url = "index.php?controller=accounting&action=modifyTaxInvoicePop&statement_no="+cidx+"&pop=Y&statement_type="+type+"&arprice="+arprice;
	//var url = "./views/accounting/card/cardcompany_remark_list_pop.php?&gid="+cidx+"&pop=Y&ddd="+cidx;
	$("#tax_invoice_modify_frame").attr("src", url);
	}

	function close_popup()
	{	
		$.modal.close();
		$("#tax_invoice_reg_frame").attr("src", "about:blank");
	}
//-->
</script>