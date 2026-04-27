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
					<a href="#">회계</a>
				</li>
				<li class="active">고정자산</li>
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
					고정자산유형등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						고정자산유형등록
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="accounting" />
						<input type="hidden" name="action" id="action" value="registFixedAssetsTypePopInsert" />
						<input type="hidden" name="uid" id="uid" value="" />
						<input type="hidden" name="totalprice" id="totalprice" value="" />
						
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">유형코드</th>
								<td class="col-xs-10">
									<input type="text" class="form-control " name="fat_cd" id="fat_cd" />
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">유형명</th>
								<td class="col-xs-10">
									<input type="text" class="form-control " name="fat_nm" id="fat_nm" />
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">자산계정</th>
								<td class="col-xs-10">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="asset_ac_cd" id="asset_ac_cd" readonly />
												<input type="text" name="asset_ac_nm" id="asset_ac_nm" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog6">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">감가상각충당금계정</th>
								<td class="col-xs-10">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="allowance_depreciation_cd" id="allowance_depreciation_cd" readonly />
												<input type="text" name="allowance_depreciation_nm" id="allowance_depreciation_nm" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog7">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">감가상각비계정</th>
								<td class="col-xs-10">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="depreciation_cost_cd" id="depreciation_cost_cd" readonly />
												<input type="text" name="depreciation_cost_nm" id="depreciation_cost_nm" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog8">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">상각방법</th>
								<td class="col-xs-10">
									<input name="depreciable_type" id="depreciable_type" type="radio" checked="checked" value="1"><label for="depreciable_type" data-cid="depreciable_type" data-role="widget-focus">정액법</label>&nbsp;<input name="depreciable_type" id="depreciable_type" type="radio" value="2"><label for="depreciable_type" data-cid="depreciable_type" data-role="widget-focus">정률법</label>
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">내용연수단위</th>
								<td class="col-xs-10">
									<input name="service_life_unit" id="service_life_unit" type="radio" checked="checked" value="1"><label for="service_life_unit" data-cid="service_life_unit" data-role="widget-focus">년</label>&nbsp;<input name="service_life_unit" id="service_life_unit" type="radio" value="2"><label for="service_life_unit" data-cid="service_life_unit" data-role="widget-focus">월</label>
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">내용연수</th>
								<td class="col-xs-10" colspan=3>
									<input type="text" class="form-control text-right" name="service_life" id="service_life" style="width:350px" placeholder="0" />
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">잔존가치</th>
								<td class="col-xs-10">
									<input type="text" class="form-control text-right" name="salvage_value" id="salvage_value" onkeyup="calculation()" style="width:350px" placeholder="0" />
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">사용중단여부</th>
								<td class="col-xs-10">
									<input name="use_yn" id="use_yn" type="radio" checked="checked" value="1"><label for="use_yn" data-cid="use_yn" data-role="widget-focus">사용</label>&nbsp;<input name="use_yn" id="use_yn" type="radio" value="0"><label for="use_yn" data-cid="use_yn" data-role="widget-focus">중단</label>
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
						<table id="account_code_list1" class="table  table-bordered table-hover">
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

<div id="dialog-message2" class="dialog-view hide">
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
						<table id="account_code_list2" class="table  table-bordered table-hover">
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

<div id="dialog-message3" class="dialog-view hide">
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
						<table id="account_code_list3" class="table  table-bordered table-hover">
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

<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getAccountCode_1();
	getAccountCode_2();
	getAccountCode_3();
	createFixedAssetsTypetCd();

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

function createFixedAssetsTypetCd(){
	var data_string = "mode=FixedAssetsTypetCd";
	$.ajax({
		type : "post",
		url : "ajax/fixedasset.php",
		data : data_string,
		success : function(str) {
			$("#fat_cd").val(str);
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

function postAccountCode_1(code,name){
	$("#dialog-message1").dialog("close");
	$("#asset_ac_cd").val(code);
	$("#asset_ac_nm").val(name);
	//}
}
function postAccountCode_2(code,name){
	$("#dialog-message2").dialog("close");
	$("#allowance_depreciation_cd").val(code);
	$("#allowance_depreciation_nm").val(name);
	//}
}

function postAccountCode_3(code,name){
	$("#dialog-message3").dialog("close");
	$("#depreciation_cost_cd").val(code);
	$("#depreciation_cost_nm").val(name);
	//}
}

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

function tax_calculation(slip_gubun){
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
			if(slip_gubun == 1) {
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
function calculation() {
	var service_life	= $("#service_life").val(); 
	var salvage_value		= $("#salvage_value").val();
	
	$("#service_life").val(Num2Money(service_life));
	$("#salvage_value").val(Num2Money(salvage_value));
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



function getAccountCode_1() {
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
					//if(json[i].aci_cd == "purchase") var clas = "매입";
					//else var clas = "매출";
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccountCode_1('" + json[i].aci_cd + "','" + json[i].aci_nm + "')\">[" + json[i].aci_cd + "] " + json[i].aci_nm + "</a></td>";
					tag += "<td>" + json[i].search_box + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_code_list1 tbody").html(tag);

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

function getAccountCode_2() {
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
					//if(json[i].aci_cd == "purchase") var clas = "매입";
					//else var clas = "매출";
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccountCode_2('" + json[i].aci_cd + "','" + json[i].aci_nm + "')\">[" + json[i].aci_cd + "] " + json[i].aci_nm + "</a></td>";
					tag += "<td>" + json[i].search_box + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_code_list2 tbody").html(tag);

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

function getAccountCode_3() {
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
					//if(json[i].aci_cd == "purchase") var clas = "매입";
					//else var clas = "매출";
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccountCode_3('" + json[i].aci_cd + "','" + json[i].aci_nm + "')\">[" + json[i].aci_cd + "] " + json[i].aci_nm + "</a></td>";
					tag += "<td>" + json[i].search_box + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_code_list3 tbody").html(tag);

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


function formSubmit(){
	alert('저장')
	$("#frm").submit();
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
				
	$( "#id-btn-dialog6" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 500,
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

	$( "#id-btn-dialog7" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message2" ).removeClass('hide').dialog({
			width : 500,
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

		$( "#id-btn-dialog8" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message3" ).removeClass('hide').dialog({
			width : 500,
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