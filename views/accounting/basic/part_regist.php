

<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">기초등록</a>
				</li>
				<li class="active">회사등록/회계연도 등록</li>
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
					회사등록/회계연도 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						고객의 기본정보를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="sales" />
						<input type="hidden" name="action" id="action" value="registEstimate" />
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">회계연도코드</th>
								<td class="col-xs-5">
									
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="gisu" id="gisu" style="width:40px"/>기 <input class=" date-picker" name="s_dt" id="s_dt" type="text" data-date-format="yyyy-mm-dd" value=<?=date('Y')."-01-01"?> style="width:90px">
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span> ~ <input class=" date-picker" name="e_dt" id="e_dt" type="text" data-date-format="yyyy-mm-dd" value=<?=date('Y')."-12-31"?> style="width:90px">
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
												<span style="padding-left:25px;color:blue"></span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">회사명</th>
								<td class="col-xs-5">
									<input type="text" name="name" id="name" />
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">구분</th>
								<td class="col-xs-5">
									<label>
										<input type="radio" name="busi_div" id="busi_div" onclick="showhideData(this.value)" value="A">
										<span class="lbl"> 법인</span>
									</label>

									<label>
										<input type="radio" name="busi_div" id="busi_div" onclick="showhideData(this.value)" value="B" checked>
										<span class="lbl"> 개인</span>
									</label>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">사업자등록번호</th>
								<td class="col-xs-5">
									<input type="text"  name="busino1" id="busino1" style="width:40px;text-align:center;" value="" maxlength="3" onKeyUp="moveBusi(this,'busino2')" >
									-
									<input type="text"  name="busino2" id="busino2" style="width:30px;text-align:center;" value="" maxlength="2" onKeyUp="moveBusi(this,'busino3')">
									-
									<input type="text"  name="busino3" id="busino3" style="width:50px;text-align:center;" value="" maxlength="5" onKeyUp="moveBusi(this,'tax_type')">
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">대표자</th>
								<td class="col-xs-5"><input type="text" name="ceoname" id="ceoname" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1"  id="td_b1" style="display:none">과세유형</th>
								<td class="col-xs-5" id="td_b2" style="display:none" class="th4">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<select name="tax_type"  id="tax_type">
													<option value="A">일반</option>
													<option value="B">간이</option>
													<option value="C">면세</option>
												</select>&nbsp;전환일
												<input class=" date-picker" name="tax_type_date" id="tax_type_date" type="text" data-date-format="yyyy-mm-dd" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1" id="td_a1" style="display:none" class="th3">법인등록번호</th>
								<td class="col-xs-5" id="td_a2" style="display:none" class="th4"><input type="text"  name="company_no" id="company_no" class="noline00" value=""></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">대표자주민번호</th>
								<td class="col-xs-5">
									<input type="text" name="ceo_jumin" id="ceo_jumin" />
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">전화번호</th>
								<td class="col-xs-5">
									<input type="text" name="tel" id="tel" />
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">팩스번호</th>
								<td class="col-xs-5">
									<input type="text" name="fax" id="fax" />
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">업태</th>
								<td class="col-xs-5"><input type="text" name="uptae" id="uptae" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">종목</th>
								<td class="col-xs-5"><input type="text" name="jongmok" id="jongmok" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">개업연월일</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="open_date" id="open_date" type="text" data-date-format="yyyy-mm-dd" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">이메일</th>
								<td class="col-xs-5">
									<input type="text" name="email" id="email" />
									<input type="hidden" name="branch" value="N">(전자세금계산서발행용)
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">주업종코드(F2)</th>
								<td class="col-xs-5"><input type="text" name="busi_code" id="busi_code" value="" onKeyUp="viewCommPop(this,'upjong_code','C')" /> <span id="busi_name"></span></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">국세환급금계좌(F2)</th>
								<td class="col-xs-11" colspan=3>
									코드<input type="text" name="bank_code" id="bank_code" onKeyUp="viewCommPop(this,'bank_code','D')" /> <input type="text" id="bank_name" style="width:100px" class="noline4" value=""/> 지점<input type="text" name="bank_branch" id="bank_branch" />  계좌번호<input type="text" name="bank_num" id="bank_num" />
								</td>
								
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">주소</th>
								<td class="col-xs-5" colspan="3">
									<div class="input-group">
										<input type="text" class="form-control search-query" placeholder="우편번호" name="zipcode" id="zipcode" readonly />
										<span class="input-group-btn">
											<button type="button" class="btn btn-purple btn-sm" onclick="sample6_execDaumPostcode(1)">
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
												Search
											</button>
										</span>
									</div>
									<div style="margin-top:5px">
										<input type="text" class="form-control search-query" placeholder="주소" name="address" id="address" />
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">관할세무서(F2)</th>
								<td class="col-xs-11" colspan=3>
									<input type="text" name="taxoffice_code" id="taxoffice_code"  onKeyUp="viewCommPop(this,'tax_office','')" /> 
								</td>
								
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">첨부</th>
								<td colspan="3" class="col-xs-11"><input type="file" name="attach" id="attach" /></td>
							</tr>
						</table>

					</form>
				</div>
			</div><!-- /.row -->

			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						등록
					</button>

					&nbsp; &nbsp; &nbsp;
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
<input type="text" name="itemFlag" id="itemFlag" value="" />

<div id="dialog-message1" class="dialog-view hide">
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

<div id="dialog-message2" class="dialog-view hide">
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
				document.getElementById('corp_zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('corp_address').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('corp_address').focus();
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
<!----------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
<!--
	function showhideData(v){
	if(v=="B"){
		$('#td_a1').hide();
		$('#td_a2').hide();
		$('#td_b1').show();
		$('#td_b2').show();
	}else{
		$('#td_a1').show();
		$('#td_a2').show();
		$('#td_b1').hide();
		$('#td_b2').hide();
	}
}

//숫자만.
  function onlyNumber(){
	  
	if((event.keyCode<48)||(event.keyCode>57)){
		return false;
	}
		
  }
//-->
</script>
<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getProject();
	getAccount();
	getItem();
	showhideData('B');


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

function createEstimateCode(){
	var data_string = "mode=createEstimateCode";
	$.ajax({
		type : "post",
		url : "ajax/estimate.php",
		data : data_string,
		success : function(str) {
			$("#estimate_cd").val(str);
		}
	});
}

function itemFlag(flag) {
	$("#itemFlag").val(flag);
}

function tax_calculation(tax_type){
	var cnt = new Array();
	var unit_price = new Array();
	var tax = new Array();
	var hap = new Array();

	var re_unit_price = new Array();
	var re_tax = new Array();
	var total = new Array();
	var values = 0;

	$.each($(".cnt") , function () {
		cnt.push(removeComma($(this).val()));
	});

	$.each($(".unit_price") , function () {
		unit_price.push(removeComma($(this).val()));
	});

	$.each($(".tax") , function () {
		tax.push(removeComma($(this).val()));
	});

	for(var i = 0 ; i < cnt.length ; i++) {
		if(cnt[i] > 0) {
			values = Number(cnt[i]) * Number(unit_price[i]);

			// 부가세적용
			if(tax_type == 1) {
				var supply_price = values/1.1;
				var cal_tax = values-supply_price;
				var re_hap = values + cal_tax;
				
				re_unit_price.push(supply_price);
				re_tax.push(cal_tax);
				total.push(Number(re_hap));
			} else { // 부가세 미적용
				var re_hap = unit_price[i];
				var cal_tax = 0;

				re_unit_price.push(re_hap);
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
	var tax_type = $("#tax_type option:selected").val();
	var cnt = $("#cnt_" + flag).val();
	var pur_unit_price = $("#pur_unit_price_" + flag).val();
	var unit_price = $("#unit_price_" + flag).val();
	var values = Number(removeComma(cnt)) * Number(removeComma(unit_price));

	// 부가세적용
	if(tax_type == 1) {
		var supply_price = values/1.1;
		var tax = values-supply_price;

		$("#total_price_" + flag).val(commaSplit(Math.round(values + tax)));
	} else {
		var tax = 0;
		$("#total_price_" + flag).val(commaSplit(Math.round(values + tax)));
	}
	$("#tax_" + flag).val(commaSplit(Math.round(tax)));
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

function getItem() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;

	$.getJSON("ajax/item.php",{"page":page, "mode":"getItem", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					switch(json[i].item_gb) {
						case "product" : var item_gb = "완제품"; break;
						case "semi_product" : var item_gb = "반제품"; break;
						case "component" : var item_gb = "자재"; break;
					}
					tag += "<tr>";
					tag += "<td>" + item_gb + "</td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postItem('" + json[i].item_cd + "','" + json[i].item_nm + "','" + json[i].standard + "','" + json[i].pur_unit_price + "','" + json[i].unit_price + "','" + json[i].lot_no + "')\">" + json[i].item_cd + "</a></td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "</tr>";
				}
			}

			$("#item_list tbody").html(tag);

			var table = "erp_item";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function postItem(item_cd,item_nm,standard,pur_unit_price,unit_price,lot_no){
	var arr = [];
	$.each($(".item_cd") , function () {
		arr.push($(this).val());
			/*
			if($(this).val() == item_cd) {
				alert("이미 선택한 품목입니다");
			} else {
				var flag = $("#itemFlag").val();
				$("#item_cd_" + flag).val(item_cd);
				$("#item_nm_" + flag).val(item_nm);
				$("#unit_" + flag).val(unit);
				$("#pur_unit_price_" + flag).val(pur_unit_price);
				$("#unit_price_" + flag).val(unit_price);
			}*/
	});
	var idx = jQuery.inArray(item_cd, arr);
	if(idx >= 0) {
		alert("동일 품목을 이미 선택하셨습니다");
	} else {
		var flag = $("#itemFlag").val();
		$("#item_cd_" + flag).val(item_cd);
		$("#item_nm_" + flag).val(item_nm);
		$("#standard_" + flag).val(standard);
		$("#pur_unit_price_" + flag).val(pur_unit_price);
		$("#unit_price_" + flag).val(unit_price);
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
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccount('" + json[i].account_cd + "','" + json[i].account_nm + "','" + json[i].manager + "')\">" + json[i].account_cd + "</a></td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_list tbody").html(tag);

			var table = "erp_account";
			if(account_gb == "" || account_gb == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			}

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

function postAccount(code,name,manager) {
	if(manager != 'null') $("#manager").val(manager);
	else $("#manager").val("");
	$("#account_cd").val(code);
	$("#account_nm").val(name);
}

function postProject(code,name) {
	$("#project_cd").val(code);
	$("#project_nm").val(name);
}

function formSubmit(){
	if(!check_str($("#gisu").val(),"회계기수")) return false;
	$('gisu').focus();
	if(!check_str($("#name").val(),"회사명")) return false;
	$("#frm").submit();
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
				
	$( "#id-btn-dialog1" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
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

				
	$( "#id-btn-dialog2" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message2" ).removeClass('hide').dialog({
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

	$( document).on('click',".id-btn-dialog", function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message3" ).removeClass('hide').dialog({
			width : 700,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>품목 리스트</h4></div>",
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