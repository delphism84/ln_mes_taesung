<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dth/xhtml1-transitional.dtd>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>계정과목 및 적요</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<link rel="stylesheet" type="text/css" href="/common.css" />
<style type="text/css">
body{margin:0;padding:0;}
.th1 {width:68px;padding-left:10px;text-align:left;}
.th2{}

.summary1 th, .summary2 th, .info th{ border:1px solid #878787;background:#969696;color:#FFF;}
.summary1 td, .summary2 td, .info td { border:1px solid #dbdbdb;background:#FFF;}
.summary1 th, .summary2 th{font-weight:normal;height:20px;}
.summary1, .summary2 {overflow:auto;height:192px;width:324px;}
.summary1, .summary2{margin-top:10px;}
.button {text-align:center; padding-top:5px;}
.sth1{width:50px;}
.sth2{width:250px;}

#ajx_div{left:0px; top:8px; }
</style>
<!-- <script type="text/javascript" src="http://erp.ssabu.net/config/jquery-1.11.2.js"></script> -->
<!-- <script language="JavaScript" src="http://erp.ssabu.net/config/common.js"></script> -->
<!-- <script language="JavaScript" src="http://erp.ssabu.net/config/ShowHideLayer.js"></script>
<script type="text/javascript" src="http://erp.ssabu.net/config/CheckDate.js"></script>
<script type="text/javascript" src="http://erp.ssabu.net/config/httpRequest.js"></script> -->
<script type="text/javascript">
function openAccountBefore(obj){

	if(document.getElementById("chr")){
		var chk = document.getElementById("chr").options[$('chr').selectedIndex].text;
		if(chk.match('차감')){
			openAccountCode(obj);
		}
	}
}
function zip_win(psdiv) {
	var window_left = 280;
	var window_top = 140;
	window.open("/common/zipcode.html?step=1","zip_win",'scrollbars=yes,width=420,height=250,status=no,,top=' + window_top + ',left=' + window_left + '');
}

function writesubmit(){
	//if(!confirm('저장 하시겠습니까?')){
	//	return;
	//}
	document.summarywrite.action='?mode=end';
	document.summarywrite.submit();
}

function delsubmit(){
	if(currD && currN){
		if(!$('uid'+currD+'_'+currN)){
			window.alert('수정,삭제 불가 항목입니다.');
			return false;
		}
		if(!confirm('삭제 하시겠습니까?')){
			return;
		}
		var uid=$('uid'+currD+'_'+currN).value;
		location.href='?mode=del&uid='+uid;
	}else{
		window.alert('삭제할 항목을 선택하세요.');
		return false;
	}
}

var currN='';
var currD='';
function selRows(d,no){
	if(currN && currD){
		ChangeColumnColor($('tr'+currD+'_'+currN),'#FFFFFF');
	}
	ChangeColumnColor($('tr'+d+'_'+no),'#b7e2e8');
	currN=no;
	currD=d;
}

function changeModi(modi,uid){
	if(modi=='1'){
		var Nmodi='';
	}else{
		var Nmodi='1';
	}
	location.href='?mode=change&modi='+Nmodi+'&uid='+uid;
}

function resetRelName(){
	if($('rel').value==''){
		$('rel_name').value='';
	}
}

function openAccountCode(o){
	openCommAccountCode(o);
	$('ajxEnter').addEventListener("click",inputAccount);//확인(Enter)버튼 이벤트주기
}

function openCommAccountCode(k){
	if(event.keyCode==13 || event.keyCode==113){//f2
		curr_acc_input=k.id;
		var params='account_ledger='+account_ledger+'&formid='+curr_acc_input+'&CBcode=&CMcode=&CScode=&Scode=';
		if(event.keyCode==13){
			params+='&keyword='+encodeURIComponent(k.value);
		}
		sendRequest("/fa/ajx/account_code_range.html", params, openCommAccountCodeResult, "GET");	
	}
}
function openCommAccountCodeResult(){
	if (httpRequest.readyState == 4) {
		if (httpRequest.status == 200) {
			var resultHtml = httpRequest.responseText;	
			var html=resultHtml.split(':');
			if(html[0]==1){
				$(curr_acc_input).value=html[1];
				$(curr_acc_input+'_name').value=html[2];
				if(accNextF)$(accNextF).focus();
			}else{
				$('ajx_content').innerHTML=resultHtml;
				showhideDisplay('ajx_div','inline');
				$('accName_1').focus();//검색결과 첫째라인 포커스
			}
		}
	}
}


function inputAccount(){
	var no=currPopno;
	var c=$('acc_code_'+no).value;
	var v=$('accName_'+no).value;
	$('rel').value=c;	
	$(curr_acc_input+'_name').value=v;

	showhideDisplay('ajx_div','none');	
	//$('sclient').focus();
}


var PSkind='';
function openAccountListCode(o,accKind){
	if(event.keyCode!=38 && event.keyCode!=40){
		if(accKind){
			for(var i=1; i<=6; i++){
				if($('acck_'+i))$('acck_'+i).style.color='#000';
			}
			var arrAK=accKind.split('|');
			if($('acck_'+arrAK[1]))$('acck_'+arrAK[1]).style.color='blue';
		}
		$('acc_search').innerHTML="<div style='margin:100px 0 0 150px'><img src='/img/ajax_loader_small.gif'></div>";
		var params='mode=list&account_ledger='+account_ledger+'&prevMode='+$('prevMode').value+'&formid='+curr_acc_input+'&CBcode=&CMcode=&CScode=&Scode=';
		if(accKind)params+='&accKind='+accKind;
		if(PSkind)params+='&PSkind='+PSkind;//이익잉여금
		if(o){
			params+='&keyword='+encodeURIComponent(o.value);
		}
		sendRequest("/fa/ajx/account_code_range.html", params, openAccountListCodeResult, "GET");	
	}
}
function openAccountListCodeResult(){
	if (httpRequest.readyState == 1 || httpRequest.readyState == 2 || httpRequest.readyState == 3) {
		//$('acc_search').innerHTML="<div style='margin:100px 0 0 100px'><img src='/img/ajax_loader_small.gif'></div>";
	} else if (httpRequest.readyState == 4) {
		if (httpRequest.status == 200) {
			var resultHtml = httpRequest.responseText;	
			$('acc_search').innerHTML=resultHtml;
			if(currPopno && $('accName_'+currPopno)){
				$('accName_'+currPopno).focus();
			}else{
				$('accName_1').focus();//첫째라인포커스
			}
		}
	}
}
</script>
</head>


<body bgcolor="#FFFFFF" text="#000000">

<form name="summarywrite" method="post">
<div class="info">
	<table>
		<tr>
			<th class="th1">계정과목</th>
			<td class="th2">
				<input type="text" name="code" id="code" class="line4" style="width:60px;background:#f3f4f6;text-align:center;" value="" readOnly>
				<input type="text" name="accName" id="accName" class="line4" style="width:150px;background:#FFFFFF;" value="" >
			</td>
		</tr>
		<tr>
			<th class="th1">성격</th>
			<td class="th2">
				<input type="text" name="chrName" id="chrName" class="line4" style="width:60px;background:#f3f4f6;" value="" readOnly>
				<input type="hidden" name="chr" value="">
			</td>
		</tr>
		<tr>
			<th class="th1">관계코드</th>
			<td class="th2">
				<input type="text" name="rel" id="rel" class="line4" style="width:60px;background:#f3f4f6;text-align:center;" value=""  onkeyDown="openAccountBefore(this)">
				<input type="text" name="rel_name" id="rel_name" class="line4" style="width:150px;background:#FFFFFF;" value="" readOnly readOnly onFocus='this.blur()'>
			</td>
		</tr>
		<tr>
			<th class="th1">영문명</th>
			<td class="th2">
				<input type="text" name="engName" id="engName" class="line4" style="width:218px;background:#FFFFFF;" value="" >
			</td>
		</tr>
		<!--tr>
			<th class="th1">사용구분</th>
			<td class="th2">
				<input type="radio" name="hidden" value="N" >사용
				<input type="radio" name="hidden" value="Y" >미사용
			</td>
		</tr-->
	</table>
</div>

<div class="summary1">
	<table>
		<tr>
			<th class="sth1">No</th>
			<th class="sth2">현금적요</th>
		</tr>
<tr>
			<td><input type='text' name='no1_1' id='no1_1' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary1_1' id='summary1_1' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no1_2' id='no1_2' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary1_2' id='summary1_2' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no1_3' id='no1_3' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary1_3' id='summary1_3' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no1_4' id='no1_4' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary1_4' id='summary1_4' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no1_5' id='no1_5' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary1_5' id='summary1_5' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no1_6' id='no1_6' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary1_6' id='summary1_6' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no1_7' id='no1_7' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary1_7' id='summary1_7' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no1_8' id='no1_8' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary1_8' id='summary1_8' class='noline4' style='width:248px;'></td>			
		</tr>	</table>
</div>
<input type="hidden" name="numrow1" value="9">
<input type="hidden" name="DCDiv1" value="C">

<div class="summary2">
	<table>
		<tr>
			<th class="sth1">No</th>
			<th class="sth2">대체적요</th>
		</tr>
<tr>
			<td><input type='text' name='no2_1' id='no2_1' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary2_1' id='summary2_1' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no2_2' id='no2_2' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary2_2' id='summary2_2' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no2_3' id='no2_3' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary2_3' id='summary2_3' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no2_4' id='no2_4' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary2_4' id='summary2_4' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no2_5' id='no2_5' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary2_5' id='summary2_5' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no2_6' id='no2_6' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary2_6' id='summary2_6' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no2_7' id='no2_7' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary2_7' id='summary2_7' class='noline4' style='width:248px;'></td>			
		</tr><tr>
			<td><input type='text' name='no2_8' id='no2_8' class='noline4' style='width:48px;text-align:center;'></td>
			<td><input type='text' name='summary2_8' id='summary2_8' class='noline4' style='width:248px;'></td>			
		</tr>	</table>
</div>

<div class="button">
	<input type="button" value="저장" onClick="writesubmit()">
	<input type="button" value="적요삭제" onClick="delsubmit()">
</div>

<input type="hidden" name="numrow2" value="9">
<input type="hidden" name="DCDiv2" value="T">
<input type="hidden" name="uid" id="uid" value="">
<input type="hidden" name="accCode" id="accCode" value="">
<input type="hidden" name="selno" id="selno" value="">
</form>

<div id="ajx_div">
	<div id="ajx_content"></div>
	<div id="ajxModiMent"></div>
	<div class="ajx_but">
		<input type="button" style="display:none" id="ajxEnter2">
		<input type="button" value="확인(Enter)" id="ajxEnter">
		<input type="button" value="취소(Esc)" id="ajxCancel" onClick="showhideDisplay('ajx_div','none')">	</div>
</div>

<div id="loadimg" style="display:none;"><img src="/img/ajax-loader.gif"></div><script>

document.onkeydown = function() {  
	if (event.keyCode == 27) {
		showhideDisplay('ajx_div','none');	
		$('rel').focus();

	}
};
</script>
</body>
</html>

