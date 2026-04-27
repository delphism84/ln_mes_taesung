<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);
?>

<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="production" />
						<input type="hidden" name="action" id="action" value="updatePageWorkPlan" />
						<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />
						<input type="hidden" name="workplan_cd" id="workplan_cd" value="<?=$t->workplan_cd?>" />
						<input type="hidden" name="cntTotal" id="cntTotal" />
						<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />

						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">생산유형</th>
								<td class="col-xs-11" colspan="3">
									<select name="work_gb" id="work_gb">
										<option value="정기생산" <? if($t->work_gb == "정기생산") echo "selected"; ?>>정기생산</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">생산계획일자</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="workplan_dt" id="workplan_dt" type="text" data-date-format="yyyy/mm/dd" placeholder="생성일자" value="<?=substr($t->workplan_dt,0,10)?>" readonly/>
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 수주(주문)코드</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="order_uid" id="order_uid" value="<?=$t->order_uid?>" readonly />
												<input type="text" name="order_cd" id="order_cd" onclick="centerOpenWindow('views/popup/orderList.php', '수주서 리스트',600, 500)" value="<?=$t->order_cd?>" readonly />
												<span class="input-group-addon btn-purple" onclick="centerOpenWindow('views/popup/orderList.php', '수주서 리스트', 600, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">제목</th>
								<td class="col-xs-11" colspan="3">
									<input type="text" class="form-control" name="title" id="title" value="<?=$t->title?>"/>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right red"></i> 납품처</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="account_cd" id="account_cd" value="<?=$t->account_cd?>" readonly />
												<input type="text" name="account_nm" id="account_nm" onclick="centerOpenWindow('views/popup/accountList.php', '거래처리스트', 600, 500)" value="<?=$t->account_nm?>" readonly />
												<span class="input-group-addon btn-purple"  style="cursor:pointer" onclick="centerOpenWindow('views/popup/accountList.php', '거래처리스트', 600, 500)">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 담당자</th>
								<td class="col-xs-5"><input type="text" name="manager" id="manager" value="<?=$t->manager?>" /> * 거래처 담당자</td>
							</tr>
							<!-- <tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">수주(주문)코드</th>
								<td class="col-xs-11" colspan="3"><input type="text" class="form-control" name="order_no" id="order_no"  value="<?=$t->order_cd?>" readonly /></td>
							</tr> -->
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">생산계획기간</th>
								<td class="col-xs-11" colspan="3">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="start_dt" id="start_dt" type="text" data-date-format="yyyy-mm-dd" value="<?=substr($t->start_dt,0,10)?>" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
										ㅡ
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="end_dt" id="end_dt" type="text" data-date-format="yyyy-mm-dd" value="<?=substr($t->end_dt,0,10)?>" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<!--
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">적요</th>
								<td class="col-xs-11" colspan="3">
									<input type="text" class="form-control" name="title" id="title" value="<?=$t->title?>" />
								</td>
							</tr>
							-->
						</table>
						
						<a class="btn btn-xs btn-success" onclick="centerOpenWindow('views/popup/planItemList.php?mode=modify', '품목리스트', 800, 500)">품목선택</a>
						<!-- <a class="btn btn-xs btn-info" onclick="centerOpenWindow('views/popup/orderList.php', '견적서리스트', 600, 500)"">수주(주문)서에서 품목가져오기</a> -->
						<table id="product" class="table  table-bordered table-hover" style="margin-top:10px">
							<thead>
								<tr>
									<th class="detail-col center" style="background-color:#f1f1f1"></th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">품목코드</th>
									<th class="center col-xs-3" style="background-color:#f1f1f1">품목명</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1">규격</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">재질</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">단위</th>
									<th class="center col-xs-1" style="background-color:#f1f1f1">생산수량</th>
									<th class="center col-xs-2" style="background-color:#f1f1f1;">생산공장</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th class="center" style="background-color:#f1f1f1"></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN class="cntTotal"></SPAN></th>
									<th class="center col-xs-1" style="background-color:#f1f1f1"><SPAN>&nbsp;</SPAN></th>
								</tr>
							<tfoot>			
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
					<button class="btn" type="reset" onclick="window.parent.closeModal('<?=$dialogID?>');">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						닫기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<div id="id-btn-dialog1" class="modal fade" >
    <div class="modal-dialog modal-lg" style="width:40%">
        <div class="modal-content" >
            <div class="modal-header" id="modal-header1">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">창고 검색</h4>

            </div>
            <div class="modal-body">
                <p><iframe src="" id="warehouse_cd_reg_frame" frameborder="0" width="99%" height="370" marginwidth="0" marginheight="0" scrolling="yes"></iframe></p>
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

<input type="hidden" name="flag" id="flag" value="1" />
<input type="hidden" name="warehouse_cdFlag" id="warehouse_cdFlag" value="1" />
<input type="hidden" name="inspectionFlag" id="inspectionFlag" value="1" />

<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	getWorkPlanItem();
});

function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var flag = $("#flag").val();
	flag = Number(flag) - 1;
	if(flag < 1) {} else $("#flag").val(flag);
}

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
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars="+ scrollbars; 
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars="+ scrollbars; 
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 


function getOrderItem(){
	var order_cd = $("#order_cd").val();
	var order_uid = $("#order_uid").val();

	$("#order_no").val(order_cd);
	var flag = $("#flag").val();
	var tag = "";

	$.getJSON("ajax/order.php",{"mode":"getOrderItem", "uid" : order_uid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag = "";
					tag += "<tr class='item" + flag + "'>";
					tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
					tag += "<td><input type='text' class='form-control id-btn-dialog item_cd ' name='item_cd[]' id='item_cd_" + flag + "' value='" + json[i].item_cd + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "' value='" + json[i].item_nm + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control standard1' name='standard1[]' id='standard1_" + flag + "' value='" + json[i].standard1 + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control material' name='material[]' id='material_" + flag + "' value='" + json[i].material + "' /></td>";
					tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + json[i].unit + "' /></td>";
					tag += "<td><input type='text' class='form-control cnt text-right' name='cnt[]' id='cnt_" + flag + "' value='" + json[i].cnt + "' /></td>";
					tag += "<td><input type='text' class='form-control warehouse_nm' name='warehouse_nm[]' id='warehouse_nm_" + flag + "' value='" + json[i].warehouse_nm + "' onclick='warehouse_cdFlag(" + flag + ");warehouse_cd_reg(" + flag + ")' readonly  /><input type='hidden' name='warehouse_cd[]' id='warehouse_cd_" + flag + "' value='" + json[i].warehouse_cd + "' readonly/></td>";
					tag += "</tr>";
					$("#product").append(tag);

					flag = Number(flag) + 1;
					$("#flag").val(flag);
				}
			}else{
				tag += "<tr><td colspan='8'>등록된 생산 계획기 없습니다.<td></tr>";
			}
		calculationTotal()
		}
	);
}

function getWorkPlanItem(){
	var workplan_cd = $("#workplan_cd").val();
	var uid = $("#uid").val();
	
	$("#flag").val("1");
	var flag = $("#flag").val();
	$("#product tbody").remove();
	var tag = "";

	$.getJSON("ajax/production.php",{"mode":"getWorkPlanItem", "uid":uid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag = "";
					tag += "<tr class='item" + flag + "'>";
					tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
					tag += "<td><input type='text' class='form-control id-btn-dialog item_cd ' name='item_cd[]' id='item_cd_" + flag + "' value='" + json[i].item_cd + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='item_nm[]' id='item_nm_" + flag + "'  value='" + json[i].item_nm + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='standard1[]' id='standard1_" + flag + "'  value='" + json[i].standard1 + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' name='material[]' id='material_" + flag + "'  value='" + json[i].material + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control unit' name='unit[]' id='unit_" + flag + "' value='" + json[i].unit + "' readonly/></td>";
					tag += "<td><input type='text' class='form-control cnt text-right' name='cnt[]' id='cnt_" + flag + "'  value='" + json[i].cnt + "' /></td>";
					tag += "<td><input type='text' class='form-control warehouse_nm' name='warehouse_nm[]' id='warehouse_nm_" + flag + "' value='" + json[i].warehouse_nm + "' onclick='warehouse_cdFlag(" + flag + ");warehouse_cd_reg(" + flag + ")' readonly  /><input type='hidden' name='warehouse_cd[]' id='warehouse_cd_" + flag + "' value='" + json[i].warehouse_cd + "' readonly/></td>";
					tag += "</tr>";
					$("#product").append(tag);

					flag = Number(flag) + 1;
					$("#flag").val(flag);
				}
			}
		calculationTotal();
		}
	);
}

function  calculationTotal() {
	var cntTotal = 0;
	$("input[name='cnt[]']").each(function () {
		var cnt = removeComma(this.value);

		if ($("input[name='cnt[]']").length > 0 && !isNaN(cnt)){
			 cntTotal += Number(removeComma(this.value));
		}
	});

	$(".cntTotal").html(Num2Money(cntTotal));
}

function warehouse_cdFlag(flag) {
	$("#warehouse_cdFlag").val(flag);
}

function warehouse_cd_reg(cidx)
{
	$("#id-btn-dialog1").modal({
		show: true,
		title : "LOT-NO 검색",
		clickClose: false,
		closeText: '',
		showClose: false,
		hide:function() {
			console.log('hide');
		}
	});

	var url = "views/popup/warehouseListPut.php?idx="+cidx+"&pop=Y&dialogID=id-btn-dialog1";
	$("#warehouse_cd_reg_frame").attr("src", url);
}

function formSubmit(){
	if(!check_str($("#title").val(),"생산계획명")) return false;
	if(!check_str($("#start_dt").val(),"생산기간 시작일")) return false;
	if(!check_str($("#end_dt").val(),"생산기간 종료일")) return false;


	var workPlan_dt = $("#workPlan_dt").val();
	var account_cd = $("#account_cd").val();
	var account_nm = $("#account_nm").val();
	//var deadline_dt = $("#deadline_dt").val();
	//var warehouse_cd = $("#warehouse_cd option:selected").val();
	var item_nm = $("#item_nm_1").val();
	
	var order_cnt = $("input[name='cnt[]']").length;
	$('input[name="cnt[]"]').each(function() // $('input[name^="nm"]').each(function() 
	{ 
    //alert($(this).val()); 
	}); 
	
	
	if(workPlan_dt == "") {
		alert("생산계획 일자를 입력하세요");
		$("#workPlan_dt").focus();
		return false;
	}
	if(account_nm == "") {
		alert("납품처를 입력하세요");
		$("#account_nm").focus();
		return false;
	}
	/*
	if(deadline_dt == "") {
		alert("납기일자를 입력하세요");
		$("#deadline_dt").focus();
		return false;
	}
	*/

	if($(".cntTotal").text() == 0 || $(".cntTotal").text() == "") {
		alert("품목을 하나 이상 추가 하세요");
		return false;
	}

	if(!frm_submit($('input[name="cnt[]"]'),"수량")) return false;

	$("#cntTotal").val($(".cntTotal").html());

	$("#frm").submit();
}

function frm_submit(f,t) {
	  var ret = true;
	  $(f).each(function(idx, item) {
		if(!$(item).val() || $(item).val()=="0") {
		  ret = false;
		  alert(t+"을 입력 하세요");
		  $(item).focus();
		  return false;
		}
	  });
	  return ret;
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
	
	// 견적서 팝업
	$( "#id-btn-dialog1" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>수주(주문)서 리스트</h4></div>",
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



	// 품목 팝업
	$( document).on('click',".id-btn-dialog" , function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message2" ).removeClass('hide').dialog({
			width : 800,
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