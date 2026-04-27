<?
include_once("../common.php"); // 기본 파일
include_once("../inc/dbconfig.php"); 
include_once("../inc/func.php");  // 함수 파일
//include_once("../lib/barcode.lib.php");  // 바코드 함수 파일
//include_once("../inc/barcode.gd.php");  // 바코드 함수 파일
//header("Content-type: text/html; charset=UTF-8"); 
if (!$is_member){
goto_url("/login.php");
exit;
}
?>
<?

$searchType = $searchType;

$chk_search = "";

If ($searchType == 1){
	$daily_process =$daily_process;
	$chk_process =$chk_process;
	if ($chk_process=="on") $chk_search = " and (ckind like '%" .$daily_process. "%')"; // ' 기업구분  
}

$search_item=$search_item;
$start_date=$start_date;
$end_date=$end_date;

if ($search_item !=""){
	switch($search_item){
	Case "all":
	$sech_link=$sech_link ."&search_item=" .$search_item ."&start_date=" .$start_date;
	//$search_sql=" and (itemnm like '%" .$start_date ."%' or itemnm like '%" .$start_date ."%' or itemnm like '%" .$start_date ."%' or itemnm like '%" .$start_date ."%')";
	break;
	Case "regdate":
	$sech_link=$sech_link ."&search_item=" .$search_item ."&start_date=" .$start_date ."&end_date=" .$end_date;
	//$search_sql=" and (" .$search_item ." between '" .$start_date ." 00:00:00' and '" .$end_date ." 23:59:59')";
	$wdate_value="regdate";
	break;
	default:
	$sech_link=$sech_link ."&search_item=" .$search_item ."&start_date=" .$start_date;
	$search_sql=" and " .$search_item ." like '%" .$start_date ."%' ";
	$wdate_value="";
	break;
	}
}

$search_word_field=$search_word_field;
$search_word_a=$search_word_a;
$search_word_b=$search_word_b;

If (!Empty($search_word_a)){
$sech_link=$sech_link ."&search_word_field=" .$search_word_field;
$sech_link=$sech_link ."&search_word_a=" .$search_word_a;
$sech_link=$sech_link ."&search_word_b=" .$search_word_b;
//'search_sql=search_sql ." and LEFT(" .search_word_field .",1) between '" .search_word_a ."' and '" .search_word_b ."'";
//$search_sql=$search_sql ." and LEFT(" .$search_word_field .",1) >= '" .$search_word_a ."' and LEFT(" .$search_word_field .",1) < '" .$search_word_b ."'";
}

//if (($start_date && $end_date ) && $srch_word ==""){
	//$sech_link=$sech_link ."&start_date=" .$start_date ."&end_date=" .$end_date;
	//$search_sql=" and (replace(left(regdate,10),'-','') between '" .$start_date ."' and '" .$end_date ."')";
//}else{
	$sech_link=$sech_link ."";
	$search_sql="";
//}

If (!Empty($srch_type) && !Empty($srch_word)){
$sech_link=$sech_link ."&srch_type=" .$srch_type;
$sech_link=$sech_link ."&srch_word=" .trim($srch_word);
$search_sql = $search_sql ." and " .$srch_type ." like '%" .trim($srch_word)."%'";
}

//'테이블명
$table_name="inventory_inout";
//'fild_name=" where mem_sn="
//'recd_value="'" .memberCsn ."' "
$fild_name=" where itemcd ='".$num."'";
//$fild_name=" ";
//If ($memberClevel=="3" ){
	//$recd_value=" (mem_sn='" .$memberCsn ."' or (group_sn='" .$memberCuser_group_sn ."' ))";
//	$recd_value=" (mem_sn='" .$memberCsn ."' or (group_sn='" .$memberCuser_group_sn ."' ))";
//}else{
	//$recd_value=" (mem_sn='" .$memberCsn ."'or (group_sn='" .$memberCuser_group_sn ."' ))";
//	$recd_value=" (mem_sn='" .$memberCsn ."'or (group_sn='" .$memberCuser_group_sn ."' ))";
//}

//$recd_value=" GROUP BY itemcd, pjt_name";

//'소팅 목록
$sortitem_basic="idx";
//Dim sortitem_list(1)
$sortitem_list[0]="idx";
//'sortitem_list(1)="daily_date"
$sortitem_list[1]="regdate";


//''''''''''''''''''''''''''''''''''''''''
$pagesize=$pagesize;
$page=$page;

if (empty($pagesize)) $pagesize=20;
if (empty($page)) $page=1;

$pagesize =floor($pagesize);
$page     =floor($page);

//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''소트 기준 결정
$sortitem	= $sortitem;
$ctn		= count($sortitem_list)-1;
$sort		= $sortitem_basic;
For ($i = 0; $i<= $ctn; $i++){
	If ($sortitem == $sortitem_list[$i]) $sort=$sortitem;
}
//'''''''''''''''''''''''''''''''''''''소트대상에대한 정렬방법결정(내림차순 오름차순)
$sortflg=$sortflg;
if ($sortflg =="") $sortflg=1;
if ($sortflg ){
	$mode = " desc";
}else{
	$mode ="";
}

$search_sql = $search_sql .$chk_search. " GROUP BY itemcd, pjt_name";

//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''공통 링크
$link_page ="pagesize=" .$pagesize .$sech_link ."&sortitem=" .$sort ."&sortflg=" .$sortflg;

$sql = "Select COUNT(*) as cnd From " .$table_name .$fild_name .$recd_value .$search_sql;
//echo $sql;
//''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''' 전체 페이지 수 얻기
	$result = mysql_query($sql);

	If (!$result){ 
		$recordcount = 0;
	}else{ 
		$row = mysql_fetch_array($result);
		$recordcount = $row['cnd'];
	}
	
	$recordcount=floor($recordcount);

	If (($recordcount / $pagesize) == floor($recordcount/$pagesize)){
		$PageCount = floor($recordcount / $pagesize);
	}else{
		$PageCount = floor($recordcount / $pagesize) + 1;
	}

	$pstart=($page-1)*$pagesize;
	
	$limit = " limit $pstart, $pagesize";

//'검색 결과 보여주기
$search_result="<font color='#666666'><b>Total : " .$recordcount ."</b></font> | <font color='#FF9933'><b>" .$page ."/" .$PageCount ."</b></font>";
//''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
$now_page = floor($pagesize) * ceil($page);
if (floor($Page) == floor($PageCount)) $now_page = $recordcount;
$colspan=14;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>자재관리 조회 : 기초자료</title>
<link href="/weberp/css/reset.css" rel="stylesheet" type="text/css" media="all">
<link href="/weberp/css/layout_min.css" rel="stylesheet" type="text/css" media="all">
<link href="/weberp/css/common.css" rel="stylesheet" type="text/css" media="all">
<link type="text/css" rel="stylesheet" href="/weberp/css/bom/style.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="/weberp/css/fancybox/jquery.fancybox.css?v=2.1.5" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="/weberp/js/jquery.js" ></script>
<script type="text/javascript" src="/weberp/js/common.js" ></script>
<script type="text/javascript" src="/weberp/js/jquery/common.js" ></script>
<script type="text/javascript" src="/weberp/js/jquery.modal.js"></script>
<script type="text/javascript" src="/weberp/js/jquery.topmenu.js"></script>
<script type="text/javascript" src="/weberp/js/popup.js"></script>
<script type="text/javascript" src="/weberp/js/placeholder.js"></script>
<script type="text/javascript" src="/weberp/js/myfunction.js"></script>
<script type="text/javascript" src="/weberp/js/jquery-ui.js" ></script>
<script type="text/javascript" src="/weberp/js/jquery-ui-cal.js" ></script>
<script type="text/javascript" src="./ajaxResult.js"></script>
<script type="text/javascript" src="/weberp/js/fancybox/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript" src="/weberp/js/fancybox/fancybox_custom.js"></script>
<script type="text/javascript">
var f='';
var fm='';
var g_start_date = '';
var g_end_date = '';
var g_record = '';
$(document).ready(function(){
	f = document.contFrm;
    //fm = document.main;
    //달력바인딩.
    
    //var first_date = "<?=$start_date?>" != "" ? "<?=$start_date?>" : format_date_first();
	var first_date = "<?=$start_date?>" != "" ? "<?=$start_date?>" : "<?=date(Ym01)?>";
	$("#start_date").val(first_date);
	set_start_date(first_date);
	var cur_date = "<?=$end_date?>" != "" ? "<?=$end_date?>" : format_date();
	$("#end_date").val(cur_date);
	set_end_date(cur_date);
	
    $('#start_date').datepicker({
        onSelect: function(seldate, inst) {
            set_start_date(seldate);
        }
    });
    $('#end_date').datepicker({
        onSelect: function(seldate, inst) {
            set_end_date(seldate);
        }
    });
    //search(1);
});

function get_date_str(yyyymmdd) {

	if( yyyymmdd.length != 8 )	return '';
	
	var date_str='';
	if($("#date_type_y").is(":checked") == true) {
		date_str = yyyymmdd.substring(0, 4);
	}
	else if($("#date_type_m").is(":checked") == true) {
		date_str = yyyymmdd.substring(0, 6);
	}
	else {
		date_str = yyyymmdd;
	}
	return date_str;
}

function set_start_date(yyyymmdd) {
	if( yyyymmdd.length != 8 )	return;

	g_start_date=yyyymmdd;
	var date_str = get_date_str(yyyymmdd);
	$("#start_date").val(date_str);
}

function set_end_date(yyyymmdd) {
	if( yyyymmdd.length != 8 )	return;

	g_end_date=yyyymmdd;
	var date_str = get_date_str(yyyymmdd);
	$("#end_date").val(date_str);
}

function change_date_type(dtype) {
	var sdate_str = get_date_str(g_start_date);
	$("#start_date").val(sdate_str);

	var edate_str = get_date_str(g_end_date);
	$("#end_date").val(edate_str);
}
function get_start_date_for_search() {

	if( g_start_date.length != 8 )	return '';
	
	var date_str='';
	if($("#date_type_y").is(":checked") == true) {
		date_str = g_start_date.substring(0, 4) + '0101';
	}
	else if($("#date_type_m").is(":checked") == true) {
		date_str = g_start_date.substring(0, 6) + '01';
	}
	else {
		date_str = g_start_date;
	}
	return date_str;
}

function get_end_date_for_search() {
	if( g_end_date.length != 8 )	return '';
	
	var date_str='';
	if($("#date_type_y").is(":checked") == true) {
		date_str = g_end_date.substring(0, 4) + '1231';
	}
	else if($("#date_type_m").is(":checked") == true) {
		date_str = g_end_date.substring(0, 6) + '31';
	}
	else {
		date_str = g_end_date;
	}
	return date_str;
}

function search_onchange(index)
{
	var sel = $("#select_Srch3");
	var selectedVal = sel.val();
	//alert(selectedVal);
	switch(selectedVal)
	{
		case 'KH':
		case 'AG':
		case 'KS':
		case 'DS':
		case 'DN':
		case 'SA':
			//$("#srch_word").attr('disabled', true);
			break;
		default:
			$("#srch_word").attr('disabled', false);
			break;
	}
}

function btn_search_name()
{
	if(f.srch_type.value=="")
	{
		alert('조건을 선택하십시요.');return;
	}
	if(f.srch_word.disabled==false)
	{
		var srch_type= $.trim($("select[name=srch_type]").val());

		if(srch_type == '' || srch_type == 'ord_no' || srch_type == 'cust_name' || srch_type == 'emp_name' || srch_type == 'prod_des' || srch_type == 'prod_cd' )
		{
			var srch_word = $.trim(f.srch_word.value);
			if( srch_word.length < 2)
			{
				alert('2자 이상입력하십시요.');
				f.srch_word.focus();
				return;
			}
		}
	}

	f.page_idx.value = 1;
	f.srch_sord_type.value = 4;

	var fm = $("#contFrm");
	fm.attr("method", "post");
	fm.attr("action", "state_project_detail.php");
	//$("#state").val("update");
	fm.submit();
	//go_search_name();
}

//function go_page(page_idx)
//{
//	f.page_idx.value=page_idx;
//	go_search_name();
//}

function go_search_name()
{

	f.mode.value = "m_srch_name";
	//f.submit();return;
	$("#id_list_body").empty();
	$.ajax({
    type: 'post'
    , url: 'esti_order_proc.php'
    , data: $("#contFrm").serialize()
    , datatype: 'json'
    , success: function(data) {
      var resultHtml = search_estimate_list_by_term(data.list);
      $("#id_list_body").html(resultHtml);
      $("#pagingArea").html(data.paginghtml);
    }
    , error: function(data, status, err) {
      alert("조회 에러!"+data+err);
    }
    , complete: function() {}
  });
}

function update_amount(no, item, porder, project, per_cost)
{
	/*
	alert(no);
	alert(item);
	alert(porder);
	alert(project);
	alert(per_cost);
	*/
	var stock_amount = $("#stock_amount_"+no).text(); 
	var amount = $("#stock_amount_change"+no).val();
	//amount = Math.abs(amount);
	var proc_amount = parseInt(stock_amount) + parseInt(amount);

	if (amount != 0){
		if(proc_amount < 0){
			alert("현재 남아있는 재고수량보다 많은 수량을 뺄 수 없습니다.");
			return false;
		}else{
			if (confirm("재고수량을 수정 하시겠습니까?") == true){    //확인
				var reason_value = $("#reason"+no).val();
				var r_date_value = $("#r_date"+no).val();
				
				if(amount < 0) {
					var inout = "minus";
				} else {
					var inout = "plus";
				}
				
				var param = "type="+ inout +"&item="+item+"&porder="+porder+"&project="+project+"&reason=재고조정&cnt="+amount+"&per_cost="+per_cost;
				$.ajax({
					type: 'post'
					, url: '../lib/update_amount.php'
					, data: param
					, success: function(data) {

						if(data == "success") {
							//alert('재고수량이 변경 되었습니다.');
							var a = $("#stock_amount_"+no).text(proc_amount);
							var b = $("#stock_amount_change"+no).val();
							var c = parseInt(a) + parseInt(b);

							//$("#stock_amount_"+no).text(b);
							$("#stock_amount_change"+no).val('0');
							alert('재고수량이 변경되었습니다.');
							return;
						} else {
							alert('재고수량이 변경되지 않았습니다.');
							return;
						}
					}
				 });
			}else{
				return;
			}
		}
	}
}

function btn_search_term()
{
	if(contFrm.start_date.value==''||contFrm.end_date.value=='')
	{
		alert('날짜를 선택하십시요.');return;
	}
	if(contFrm.start_date.value>contFrm.end_date.value)
	{
		alert('종료일자를 시작일보다 크게 선택하십시요.');return;
	}
	// var date_type = $(':radio[name="date_type"]:checked').val();
	// if(date_type=='y' || date_type=='m')
	// {
		// alert('월/년으로 검색시 시스템에 부하가 발생합니다.');
	// }
	
	contFrm.page_idx.value = 1;
	contFrm.srch_sord_type.value = 4;
	var f = $("#contFrm");
		f.attr("method", "post");
		f.attr("action", "state_project_detail.php");
		//$("#state").val("update");
		f.submit();
	//go_search_term();
}

function go_search_term()
{
	f.mode.value = "m_srch_term";
	//f.submit();return;
	$("#id_list_body").empty();
	$.ajax({
    type: 'post'
    , url: 'esti_order_proc.php'
    , data: $("#contFrm").serialize()
    , datatype: 'json'
    , success: function(data) {
      
      var resultHtml = search_estimate_list_by_term(data.list);
      $("#id_list_body").html(resultHtml);
      $("#pagingArea").html(data.paginghtml);
      
    }
    , error: function(data, status, err) {
      alert("조회 에러!"+data+err);
    }
    , complete: function() {}
  });
}


/****
 * 이미지 등록해 놓고 자재 데이터를 등록안한 경우 저장된 이미지 삭제 
 */
function noSaveItemImageDelete() {
	var param = "imode=chkimgdel";
	$.ajax({
        type: 'post'
        , url: 'ajax_base02_image.php'
        , data: param
        , datatype: 'json'
        , success: function(data) {
        }
        , error: function(data, status, err) {
        	alert("삭제 에러!");
        }
        , complete: function() {}
    });
}

function go_page(pageno)
{
	$("#srch_page").val(pageno);
	var f = $("#main");
	f.attr("method", "post");
	f.attr("action", "state_project_detail.php");
	f.submit();
}

function search_page()
{
	var srchWord = $.trim($("#srch_word").val());
	if(srchWord=='')
	{
		alert("검색어를 입력하십시요.");return;
	}
	go_page(1);
}

function itemView(p_id) {
	var f = $("#main");
	f.attr("method", "post");
	f.attr("action", "base02_regist.php");
	$("#mode").val("updt");
	$("#p_id").val(p_id);
	f.submit();
}
function stock_print(num)
{
	var start_date = $("#start_date").val();
	var end_date = $("#end_date").val();
	var param = "?num="+num+"&start_date="+start_date+"&end_date="+end_date;

	var url='';
	url = "/weberp/doc_form/stock_state_detail_print.php" + param;
	var popwin = window.open(url, 'stock_print', 'width=1000, height=900, scrollbars=yes, resizable=yes');
	
}
/*
프로젝트 찾기
*/
function srchGubun(Obj){
	$("#srch_word").attr('disabled', false);
	if(Obj.value=="pjt_cd"){
		$("#srch_word").css("display","none");
		$("#search_pjt").css("display","inline");
	}else{
		$("#srch_word").css("display","inline");
		$("#search_pjt").css("display","none");
	}

}
function setPjtInfo(code, name)
{
	$("#srch_word").val(code);
	$("#pjt_name").val(name);
}
function close_popup()
{
	$.modal.close();
}
function searchPJ()
{
	$("#projectList_layer").modal({
		show: true,
		clickClose: false,
		closeText: '',
		showClose: false    
	});
	var url = "/weberp/base/project_list.php";
	$("#projectList_frame").attr("src", url);
}


 $(function() {
    $( "#calendar" ).datepicker();
	  //옵션  : 매개변수값 2번째가 옵션의 타입이며 3번째 항목은 옵션에 대한 설정 값
      $( "#calendar" ).datepicker( "option", "dateFormat", "yyyy-mm-dd" ); //데이터 포맷으로 날짜의 반환 타입을 지정
      $( "#calendar" ).datepicker( "option", "showAnim", "slideDown" );      //달력의 표시 형태
  });
</script>
<script>
	$(document).ready(function() {

		// 체크 박스 모두 체크
		$("#checkAll").click(function() {
			if($(this).is(":checked")){
				$("input[name='chk[]']:checkbox").each(function() {
					$(this).attr("checked", true);
				});
			}else{
				$("input[name='chk[]']:checkbox").each(function() {
					$(this).attr("checked", false);
				});
			}
		});

		// 서버에서 받아온 데이터 체크하기 (콤마로 받아온 경우)
		$("#updateChecked").click(function() {
			var splitCode = $("#splitCode").val().split(",");
			for (var idx in splitCode) {
				$("input[name=box][value=" + splitCode[idx] + "]").attr("checked", true);
			}
		});

	});

	function drop_multi(){
		checked		= checked_check();
		if(checked==""){
			alert("선택 항목이 없습니다.");
			return;
		}

		if(confirm("선택하신 항목을 삭제 하겠습니다.")==false){
			return;			
		}

		//return;	
		document.getElementById("state").value		= "drop_multi";
		document.contFrm.action = "inventory_proc.php";
		document.contFrm.submit();
	}

	// submit 폼체크
	function flist_submit(){
		checked		= checked_check();
		if(checked==""){
			alert("선택 항목이 없습니다.");
			return false;
		}

		if(confirm("선택하신 항목을 일괄 수정 하시겠습니다.")==false){
			return false;			
		}
		return true;
	}

	function checked_check(){
		var checked = []
		$("input[name='chk[]']:checked").each(function () {
			checked.push(parseInt($(this).val()));
		});
		return checked;
	}

	function one_delete(no, depth){
		if(confirm("선택하신 항목을 삭제 하겠습니다.\n[하위 분류가 있으면 같이 삭제 됩니다. \n주위:복구 할 수 없습니다.]")==false){
			return;			
		}
		document.location.href = "<?=$PHP_SELF?>?mode=drop&no="+no+"&depth="+depth+"&refer=<?=$refer?>";

	}
	function reason_input(cidx)
		{
		$("#reason_layer").modal({
			show: true,
			clickClose: false,
			closeText: '',
			showClose: false    
		});
		var url = "/weberp/stock/reason_reg_pop.php?mode=modify&cidx="+cidx;
		$("#stockList_frame").attr("src", url);
		}
	// 선택한 게시물 삭제
	function select_delete(form,name,url) {
		var f = eval("document."+form);
		str = "삭제";
		if (!check_confirm(form,str,name))
			return;
		if (!confirm("선택한 자료를 정말 "+str+" 하시겠습니까?\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
			return;
		f.state.value="delete";	
		f.POST
		f.action = url;
		f.submit();
	}

	
function onlyNumber(obj) { 
	$(obj).keyup(function(){ 
		$(this).val($(this).val().replace(/[^0-9]/g,"")); 
	}); 
}
    </script>
</head>

<body>
<form name="contFrm" id="contFrm" method="post" action="">
<input type="hidden" name="srch_approve_type" value="1">
<input type="hidden" name="srch_sord_type" value="4">
<input type="hidden" name="mode" value="">
<input type="hidden" name="page_idx" value="">
<input type="hidden" name="hidChkValues" id="hidChkValues" value="" />
<input type="hidden" name="hidChkAll" id="hidChkAll" value="" />
<input type="hidden" name="state" id="state" />

   <div id="conWrap">
            <div class="search" style="padding:5px 5px 5px 5px">
                <fieldset>
                   <legend>프로젝트 재고 수량 관리 검색</legend>
                      <span> 
                          <!-- <select class="select" id="select_Srch2" name="srch_type" onchange="srchGubun(this)"> -->
						  <select class="select" id="select_Srch2" name="srch_type" >
							  <option value="itemnm"<?=$srch_type == "itemnm" ? " selected" : " "?>>품목명</option>
                              <option value="itemcd"<?=$srch_type == "itemcd" ? " selected" : " "?>>품목코드</option>
							  <option value="pjt_name"<?=$srch_type == "pjt_name" ? " selected" : " "?>>프로젝트명</option>
                              <option value="pjt_cd"<?=$srch_type == "pjt_cd" ? " selected" : " "?>>프로젝트코드</option>
							  <option value="standard"<?=$srch_type == "standard" ? " selected" : " "?>>규격</option>
                              <option value="in_unitprice"<?=$srch_type == "in_unitprice" ? " selected" : " "?>>금액</option> 
                          </select>
                      </span>    
                    <span><input name="srch_word" id="srch_word" maxlength="20" type="text" class="inpt1 w150" value="<?=$srch_word?>"></span>
					<!-- <span id="search_pjt" style="display:none;">
						<input name="pjt_name" id="pjt_name" type="text" class="inpt1 w200" value="" ondblclick="searchPJ();"><img src="/img/btn_search.jpg" alt="btn_search" ondblclick="searchPJ();">
					</span> -->
                    <span class="button1"><a href="javascript:btn_search_name();" title="검색">검색</a></span>
                </fieldset>
            </div><!---//search -->
            <!--자재관리 조회 리스트-->
            <div class="tblArea">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board hover">
                   <colgroup>
                   	<col width="50" />
                    <col width="100" />
					<col width="150" />
                    <col width="auto" />
                    <col width="100" />
                    <col width="80" />
					<col width="80" />
                    <col width="100" />
					<col width="100" />
                   </colgroup>
                   <thead>
                    <tr>
						<th>번호</th>
						<th>품목코드</th>
						<th>품목명</th>
						<th>프로젝트명</th>
						<th>규격</th>
						<th>총재고수량</th>
						<th>입고단가(원)</th>
						<th>총금액</th>
						<th>사진</th>
                    </tr>
                   </thead>
                   <tbody>
				   <?
					$sql = "Select * From  " .$table_name .$fild_name .$recd_value .$search_sql ." order by " .$sort .$mode .$limit;
					//echo $sql; 
					$result = mysql_query($sql);
					//$cnt = mysql_num_rows($result);
					if ($result){
					$ct=1;

					while ($item = mysql_fetch_array($result)){	

					$no = $pagesize * ($page-1) + $ct;
					
						$idx			=$item["idx"];
						$inout_no = $item['inout_no'];
						$itemcd			=$item["itemcd"];
						$itemnm			=$item["itemnm"];
						$in_unitprice	=$item["in_unitprice"];
						$in_qty			=$item["in_qty"];
						$out_qty		=$item["out_qty"];
						$wh_amount		=$item["wh_amount"];
						$tot_amount		=$item["tot_amount"];
						$remain_amount	=$item["remain_amount"];
						$cust_type		=$item["custom_code"];
						$custom_name	=$item["custom_name"];
						$pjt_cd			=$item["pjt_cd"];
						$pjt_name		=$item["pjt_name"];
					
						if ($image_filename==""){
							$image_filename_link = "/weberp/img/images.png";
						}else
						{
							$image_filename_link = "/weberp/dataHome/product/".$image_filename;
						}

					if($bankcd != ""){
						$bankyn = "등록";
					}else{
						$bankyn = "미등록";
					}
					
					if($customer_status == "1"){
						$customer_status_text = "거래";
					}else{
						$customer_status_text = "정지";
					}

					If (strlen($address) > 50){
									$address = mb_strimwidth($address, '0', '23', '..', 'utf-8');
								}else{
									$address = $address;
								}
					
						$remain_amount_sum += $remain_amount;
						$in_unitprice_sum += $in_unitprice;
						$total_sum  +=  ($remain_amount_sum * $in_unitprice_sum);



					$sqls = "Select reason, r_date From  inventory_inout where itemcd='".$itemcd."' and reason <>'' order by idx desc limit 0, 1" ;
					//echo $sqls; 
					$results = mysql_query($sqls);
					//$cnt = mysql_num_rows($result);
					if ($results){
					$row = mysql_fetch_array($results);
					$reason_value=$row['reason'];
					$r_date_value=$row['r_date'];
					if ($r_date_value==""){
						$r_date_value=date('Y-m-d');
					}
					}
					//mb_substr($pjt_name,0,10,'utf-8');


					//프로젝트별 총 재고 수량 계산
					//$query = "select sum(in_qty) as ins, sum(out_qty) as outs from inventory_inout where itemcd='".$itemcd."' and regdate < LAST_DAY('".$before."' - interval 1 month)";
					$query = "select sum(in_qty) as ins, sum(out_qty) as outs from inventory_inout where itemcd='".$itemcd."' and pjt_cd='".$pjt_cd."'  ";
					//echo $query;
					$result_amt = mysql_query($query);
					if($result_amt) $ts= mysql_fetch_object($result_amt);
						if($ts) {
							$remain_p_t_amount = $ts->ins - $ts->outs;
							$remain_p_t_amount = number_format($remain_p_t_amount); 
						} else {
							$remain_p_t_amount = "0";
						}
					?>
                    	 <tr>
	                        <td class="center"><?=$no?></td>							
	                        <td class="center"><a href="javascript:stock_print('<?=$itemcd?>');" title="히스토리" ><strong><?=$itemcd?></strong></a></td>
	                        <td class="center"><?=$itemnm?></td>
							<td class="left" title ="<?=$pjt_name?>"><!-- <iframe src="../barcode/sample_php/sample-gd.php?itemcd=<?=$itemcd?>" id="barcodeIFrame" name="barcodeIFrame" frameborder="0" width="320px" height="50px" scrolling="no"></iframe> --><?=$pjt_name?>
							<br>(<?=$pjt_cd?>)
							</td>
	                        <td class="center"><?=$standard?></td>
							<td class="center"><span id="stock_amount_<?=$ct?>"><?=$remain_p_t_amount?></span></td><!-- onkeydown="onlyNumber(this)" -->
	                        <td class="center"><a style="font-weight:bold" href="javascript:stock_detail_view('<?=$itemcd?>','<?=$itemnm?>','<?=$start_date?>','<?=$end_date?>');" id="in_unitprice<?=$ct?>"><?=number_format($in_unitprice)?></a></td>
							<td class="center"><?=number_format($in_unitprice * $remain_amount)?></td>
	                        <td class="center"><span class="tdPic tdPic_custom"><a class='fancybox' href="<?=$image_filename_link?>" ><img src="<?=$image_filename_link?>" alt="제품사진"></a></span></td>
	                     </tr>
						 <?
					$ct++;

						If (!$result) echo "<tr id='list_line'><td colspan='" .$colspan ."'></td></tr>";
					}
					unset($reason_value);
					}if ($ct==1){
					?>
						<tr>
						<td colspan="<?=$colspan?>" class="center">
						<p>검색된 결과가 없습니다</p>
						</td>
						</tr>
					<?
					}
					?>
			</tbody>
              </table>
					<div class='pageBox'>
						<? include_once("../inc/pageing.php"); // 기본 파일?>
					  </div>
		            </div><!---//tblArea -->

        </div><!---//rightSection-->
     </div><!---//contents -->
   </div><!---//conWrap -->
 </div><!---//wrapper -->

 
 <div id="custBuyPopId" class="popLayer101">
		<div class="popContainer">		
      <h3>재고상세내역 : <span id="head_code"></span></h3>
			<span class="closePop"><a href="#custBuyPopId"  title="닫기" rel="modal:close"><img src="../img/pop_close.gif" alt="닫기"></a></span>
			<div class="popConts br_none">
				<iframe src="" id="custBuyPopIFrame" name="custBuyPopIFrame" frameborder="0" width="100%" height="660px" scrolling="no"></iframe>
		  </div><!---//popConts-->
		</div><!---//popContainer-->
 </div>

  
  <!--사유작성-->
  <div id="layer3" class="popLayer103">
	<div class="popContainer2">		
        <div class="popPhoto">
			<img src="../img/@sample.jpg" alt="제품이미지">
		</div>
        <span class="closePop rollover"><a href="#"  title="닫기" class="cbtn"><img src="../img/pop_close2.png" alt="닫기"></a></span>
	</div>
  </div><!--//layer3:사유작성-->
</body>
</html>
