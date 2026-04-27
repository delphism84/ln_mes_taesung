<?
include_once("../common.php"); // 기본 파일
include_once("../inc/dbconfig.php"); 
include_once("../inc/func.php");  // 함수 파일
//header("Content-type: text/html; charset=UTF-8"); 
if (!$is_member){
goto_url("/login.php");
exit;
}
?>
<?

$searchType = $searchType;
$itemnm		= $num;
$chk_search = "";

If ($searchType == 1){
	$daily_process =$daily_process;
	$chk_process =$chk_process;
	if ($chk_process=="on") $chk_search = " and (ckind like '%" .$daily_process. "%')"; // ' 기업구분  
}

$search_item=$search_item;
$search_txt=$search_txt;
$search_txt_01=$search_txt_01;

if ($search_item !=""){
	switch($search_item){
	Case "all":
	$sech_link=$sech_link ."&search_item=" .$search_item ."&search_txt=" .$search_txt;
	$search_sql=" and (itemnm like '%" .$search_txt ."%' or itemnm like '%" .$search_txt ."%' or itemnm like '%" .$search_txt ."%' or itemnm like '%" .$search_txt ."%')";
	break;
	Case "regdate":
	$sech_link=$sech_link ."&search_item=" .$search_item ."&search_txt=" .$search_txt ."&search_txt_01=" .$search_txt_01;
	$search_sql=" and (" .$search_item ." between '" .$search_txt ." 00:00:00' and '" .$search_txt_01 ." 23:59:59')";
	$wdate_value="regdate";
	break;
	default:
	$sech_link=$sech_link ."&search_item=" .$search_item ."&search_txt=" .$search_txt;
	$search_sql=" and " .$search_item ." like '%" .$search_txt ."%' ";
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
$search_sql=$search_sql ." and LEFT(" .$search_word_field .",1) >= '" .$search_word_a ."' and LEFT(" .$search_word_field .",1) < '" .$search_word_b ."'";
}

if (($start_date !="" || $end_date !="") && Empty($srch_word)){
	$search_sql=" and (replace(left(regdate,10),'-','') between '" .$start_date ."' and '" .$end_date ."')";
}
If (!Empty($srch_type) && !Empty($srch_word)){
$sech_link=$sech_link ."&srch_type=" .$srch_type;
$sech_link=$sech_link ."&srch_word=" .$srch_word;
$search_sql = $search_sql ." and " .$srch_type ." like '%" .$srch_word ."%'";
}

//'테이블명
$table_name="inventory_inout";
//'fild_name=" where mem_sn="
//'recd_value="'" .memberCsn ."' "
$basic_date = date("Y/m")."/01";
$fild_name=" where itemcd ='" .$itemnm ."' and basic_date >= '".$basic_date."'";
//$fild_name=" ";
//If ($memberClevel=="3" ){
	//$recd_value=" (mem_sn='" .$memberCsn ."' or (group_sn='" .$memberCuser_group_sn ."' ))";
//	$recd_value=" (mem_sn='" .$memberCsn ."' or (group_sn='" .$memberCuser_group_sn ."' ))";
//}else{
	//$recd_value=" (mem_sn='" .$memberCsn ."'or (group_sn='" .$memberCuser_group_sn ."' ))";
//	$recd_value=" (mem_sn='" .$memberCsn ."'or (group_sn='" .$memberCuser_group_sn ."' ))";
//}

//'소팅 목록
$sortitem_basic="idx";
//Dim sortitem_list(1)
$sortitem_list[0]="idx";
//'sortitem_list(1)="daily_date"
$sortitem_list[1]="regdate";


//''''''''''''''''''''''''''''''''''''''''
$pagesize=$pagesize;
$page=$page;

if (empty($pagesize)) $pagesize=30;
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
	$mode = " ASC";
}else{
	$mode ="";
}


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
$colspan=7;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="robots" content="noindex,nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<link type='text/css' rel='stylesheet'href='http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_base.css?v=20150114122238' /><span></span>
<link type="text/css" rel="stylesheet" href="http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_layout.css?2016011202" />
<link type="text/css" rel="stylesheet" href="http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_rpt_print.css?2015070601" /> 
<link href="/weberp/css/reset.css" rel="stylesheet" type="text/css" media="all">
<link href="/weberp/css/common.css" rel="stylesheet" type="text/css" media="all">
 </head>
<body>
<div id="wrap">

<!-- ***** 서치버튼 시작 **** -->
    <div class="print-search-fixed">
		<div class="print-search-layer">
			<!-- 검색창 -->					
			<div class="print-search-con">							
				
<script src="/ECMain/ECount.Common/Javascript/LoadProgressbar.js?2016021701" type="text/javascript"></script>
<script src="/ECMain/ECount.Common/Javascript/Util.js?2016021701" type="text/javascript"></script>
<script src="/ECMain/ECount.Common/Javascript/ECount.Common.Selectbox.Input.js?2016021701" type="text/javascript"></script>
<script type="text/javascript">
<!--
	
function changeSNStatusType(value) {
    //bind items
    $('#ddlSNStatusType2').find('option').remove().end().append('<option value="9999">전체=====================</option>'); //All
    if (value == "0")
    {
        $('#ddlSNStatusType2').append('<option value="2">구매</option>'); //Purchases
        $('#ddlSNStatusType2').append('<option value="42">생산입고</option>'); //Goods Receipt
        $('#ddlSNStatusType2').append('<option value="31">창고이동</option>'); //Location Trans.
        $('#ddlSNStatusType2').append('<option value="32">생산불출</option>'); //Goods Issued
        $('#ddlSNStatusType2').append('<option value="62">불량-품목대체(정상품목)</option>'); //Product Defect – Disassemble (Normal Item)
    }
    else if (value == "1")
    {
        $('#ddlSNStatusType2').append('<option value="-1">판매</option>'); //Sales
        $('#ddlSNStatusType2').append('<option value="-47">생산소모</option>'); //Goods Receipt - Consumed
        $('#ddlSNStatusType2').append('<option value="-31">창고이동</option>'); //Location Trans.
        $('#ddlSNStatusType2').append('<option value="-32">생산불출</option>'); //Goods Issued
        $('#ddlSNStatusType2').append('<option value="-59">자가사용</option>'); //Internal Use
        $('#ddlSNStatusType2').append('<option value="-52">불량-품목대체(불량품목)</option>'); //Product Defect – Disassemble (Defect Item) (02)
        $('#ddlSNStatusType2').append('<option value="-51">불량-폐기</option>'); //Product Defect – Dispose (01)
        $('#ddlSNStatusType2').append('<option value="-58">재고조정</option>'); //Inv. Adj.
    }
    else if (value == "2")
    {
        $('#ddlSNStatusType2').append('<option value="AS">A/S</option>'); //A/S
        $('#ddlSNStatusType2').append('<option value="71">품질검사요청</option>'); //Quality Inspection Request
        $('#ddlSNStatusType2').append('<option value="72">품질검사</option>'); //Quality Inspection
        $('#ddlSNStatusType2').append('<option value="53">불량-정상사용</option>'); //Product Defect – Normal Use (03)
    }

    //Syn data to other tab
    $('#ddlSNStatusType2_basic').find('option').remove();
    $('#ddlSNStatusType2_basic').append($("#ddlSNStatusType2 > option").clone());

    //Set default item
    $('#ddlSNStatusType2').val('9999');
    $('#ddlSNStatusType2_basic').val('9999');
}
//Use for Rpt 791 Business Trip 
function fnEnterSubmit(event) {
var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
if(keyCode == 13)
	frmSearchData(-1, true);
}

//-->
</script>

    <form id="frmSearch" name="frmSearch" method="post" action="/ECMain/ESZ/ESZ003R.aspx?ec_req_sid=00JbDuK7Cm8P">
         <!--cjy -->      
        <div class="new-title">
        <div class='title-leftarea page-bookmark' onclick='javascript:fnFavorityPopupOpen("재고수불부 I","E040702","1287","215","");'>재고수불부 I</div> 
		    <div class="title-rightarea">
                <span class="btn-setting" onclick="fnShowOption(); return false;"></span>
                <ul class="option_box_new" >
                    
                    
                      
						<li><a onclick="javascript:fnPopTemplate();">양식</a></li>	
						
                                            
                        <li><a onclick="javascript:gfnPopUp1('/ECMain/CM3/CM100P_24.aspx?FORM_GUBUN=SM623&FORM_SER=1&NetFlag=N&FIRST_FLAG=N','CM100P_14','Y','400' ,'390');" >검색항목설정</a></li>
                    
                </ul>
            </div>
            
        </div>
        <!-- cjy 삭제이력조회--> 
        
    <fieldset>
        <legend><span class="title">판매조회 조건입력</span></legend>
        <div class="H_5px">
        
        </div>
 
 <div id="contents"> 
        
    <div class="nav_tab p_t4px" >
        <ul>
            <li id="tab1" class="nav_tabon"><a href="#"  onclick="MM_showHideLayers1(1);TabChangeFocus();"><span>기본</span></a></li>
            <li id="tab2"><a href="#"  onclick="MM_showHideLayers1(2);TabChangeFocus();"><span>전체</span></a></li>
        </ul>
   </div>
    <div class="search-button">
    

        <span class="btn blue-inverse"><input name="btnSearch" onclick="frmSearchData(-1, true);" type="button" id="btnSearch" onkeydown=""  value="검색(F8)" /></span>
    
        <label class="select_top">
    
        <select name="ddlFormSer" id="ddlFormSer"  onclick="fnEtcChkSer();" >
    
    
            <option  value="99999"selected>출력물</option>
    
            <option  value="0">현황</option>
    
    </select>
    
    </label>
    
    </div><!-- endof [search_btnpart] 검색버튼 -->
            
            
    </div>
    </fieldset>
    <input type="hidden" id="hidSearchXml" name="hidSearchXml" />
    <input type="hidden" name="hidFavSeq" id="hidFavSeq"/>
    
    <input type="hidden" id="hidSearchXml2" name="hidSearchXml2" value=""/>
    
    <input type="hidden" id="NEWFLAG" name="NEWFLAG" value="" /><!--센터 오픈시  제거해야함-->
    <input type="hidden" id="hidFmType" name="hidFmType" value="" />
    <input type="hidden" id="hidGubun" name="hidGubun" value="" />
    <input type="hidden" id="hidAFlag" name="hidAFlag" value="" />
    <input type="hidden" id="hidPageGubun" name="hidPageGubun" value="" />
     <input type="hidden" id="strListType" name="strListType" value="" />
    <input type="hidden" id="strListFlag" name="strListFlag" value="" />
     <input type="hidden" id="strSort" name="strSort" value="" />
    <input type="hidden" id="strSearchCode" name="strSearchCode" value="" />
    <input type="hidden" id="strSortAd" name="strSortAd" value="" />
    <input type="hidden" id="hidPFlag" name="hidPFlag" value="T" />
    <input type="hidden" id="hidSaleGubun" name="hidSaleGubun" value="" />
    <input type="hidden" id="hidPrev" name="hidPrev" value="" />
    <input type="hidden" id="hfButtonCnt" value="0" />
    <input type="hidden" id="hidTabGubun" name="hidTabGubun" value="1" />
    <input type="hidden" id="hidTabFirsts" name="hidTabFirsts" value="ddlSYear|ddlSYear" />

    <input type="hidden" name="hidGroupDisplay" id="hidGroupDisplay" value="">
	<input type="hidden" name="hidGroupBasicDisplay" id="hidGroupBasicDisplay" value="">

<input type="hidden" id="hidEyymm" name="hidEyymm" />
<input type="hidden" id="hidAccCloseCheckDate" name="hidAccCloseCheckDate" />
<input type="hidden" id="hidListYnSearch" name="hidListYnSearch" value="N" />

<input type="hidden" id="hidStetOrderFlag" name="hidStetOrderFlag" value="N"/>
</form>

 			
            </div>

			<span class="btn-print-search" onclick="fnShowSearch2(this); return false;"></span>
		</div>        
	</div>
    
    <!-- 이중추가버튼 -->
    <div class="dual-btn-fixed">
	    <div class="dual-btn-area p-print-btn">
		    <div class="float_left">           
                    
<? if ($_GET['mobile'] && $_GET['mobile'] == "true") { ?>
				<span class="btn gray"><input type="button" id="btnExcel" onclick="history.go(-1); " value="Back" /></span>
<? } else { ?>
                <span class="btn blue-inverse"><input type="button" id="btnPrint" value="인쇄" onclick="printURL2(''); return false;" /></span>
                <span class="btn gray"><input type="button" id="btnExcel" onclick="ExcelPageMovement('/ECMain/ESZ/ESZ003E.aspx');" value="Excel" /></span>                      
                <span class="btn gray"><input type="button" id="btnPreview" value="미리보기" onclick="getPreviewPrint2(); return false;" /></span>                
<? } ?>

            </div>            
	    </div>
    </div>
     
<!-- ***** 서치버튼 끝 **** -->

<!-- ***** 작업영역 시작 **** -->    

<!-- ***** 프린트 시작 ***** -->
<div id="idPrint" class="P_45px">
    <div id="contents" style="width:650px;">
        
                    <div id="print_title">
                        <ul>
                            <li > <table width='650px' border='0' cellspacing='0' cellpadding='0'>    <tr> <td align='center'> <table> <tr> <td align='center' class='bigtitle'>재고수불부 I</td> </tr> </table> </td> </tr> </table> </li>
                        </ul>
                    </div>
                    
                    <br />
					<?
						$search_sql = $search_sql .$chk_search;
						$sql = "Select * From  " .$table_name .$fild_name .$recd_value .$search_sql ." order by " .$sort .$mode .$limit;
						//echo $sql; 
						$result = mysql_query($sql);
						//$cnt = mysql_num_rows($result);
						if ($result){
						$ct=1;

						while ($item = mysql_fetch_array($result)){
							$no = $pagesize * ($page-1) + $ct;			
							$product_id=$item["product_id"];
							$user_group_sn=$item["user_group_sn"];
							$mem_sn=$item["mem_sn"];
							$itemcd=$item["itemcd"];
							$grpcd=$item["grpcd"];
							$itemnm=$item["itemnm"];
							$unit=$item["unit"];
							$standard=$item["standard"];
							$in_unitprice=$item["in_unitprice"];
							$out_unitprice=$item["out_unitprice"];
							$in_qty=$item["in_qty"];
							$out_qty=$item["out_qty"];
							$stock_amount=$item["stock_amount"];
							$cust_type=$item["cust_type"];
							$custom_name=$item["custom_name"];
							$image_filename=$item["image_filename"];
							$imageUpload=$item["imageUpload"];
							$regdate=$item["regdate"];
							$moddate=$item["moddate"];
						
							$image_filename_link = product_files_view($itemcd);

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
						$stock_amount_sum = $stock_amount_sum + $stock_amount;
						$in_qty_sum += $in_qty;
						$out_qty_sum += $out_qty;
						if($ct==1){
					?>
                    <div id="divContainer" class="container H_35px">
                        <p class="float_left">회사명 : (주)코메스타
                                 / <?=$item['itemnm']?>
                        </p>
                        <p class="float_right">
                            <?=date('Y-m')?>-01 ~ <?=date('Y-m-d')?>
                            
                        </p>   
                    </div>
                        <table class="p_table" summary="">
                        <col width="11%" /><col width="" /><col width="21%" /><col width="13%" /><col width="13%" /><col width="13%" /><col width="15%" />
						<thead>
							<th class="p_th">날짜</th> <!--날 짜-->
							<th class="p_th">거래처</th><!--거래처-->
							<th class="p_th">적요</th><!--적요-->
							<th class="p_th">입고수량</th><!--입고수량-->
							<th class="p_th">출고수량</th><!--출고수량-->
							<th class="p_th">재고수량</th><!--재고수량-->
							<th class="p_th">변경사유</th><!--변경사유-->
						</thead>
						<tbody>
                        <tr>
                            <td class="p_td p_redC" colspan="5"><strong>전월이월</strong></td>
                            <td class="p_td right">
							<?
								$query = "select stock_amount from inventory_inout where itemcd='".$itemcd."' and basic_date < '".$basic_date."' order by idx desc limit 0,1";
								//echo $query;
								$rst = mysql_query($query);	

								while($rs = mysql_fetch_array($rst)){
							?>
							<strong><?=$rs['stock_amount']?></strong>
							<?}?>
							</td>
							<td class="p_td right"></td>
                        </tr>
						<?}?>						
                        <tr>
                            <td class="p_td center"><?=$item['basic_date']?></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr><?=$item['custom_name']?></nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right"><?=$item['in_unitprice']?></td>
                            <td class="p_td right"><?=$item['out_unitprice']?></td>
                            <td class="p_td right"><?=$item['stock_amount']?></td>
							<td class="p_td right"><?=$item['reason']?></td>
                        </tr>
						<?
					$ct++;
					
						If (!$result) echo "<tr id='list_line'><td colspan='" .$colspan ."'></td></tr>";
					}
					}if ($ct==1){
					?>
						<tr>
						<td colspan="<?=$colspan?>" class="centered" style="height:20pt">
						<p>등록된 이력 결과가 없습니다</p>
						</td>
						</tr>
					<?
					}
					?>
                                    <tr class="p_graybgB"> 
                                        <td class="p_td center" colspan="3">누계</td>
                                        <td class="p_td right"><?=$stock_amount_sum?></td>
                                        <td class="p_td right"><?=$stock_amount_sum?></td>                                        
                                        <td class="p_td right"><?=$stock_amount_sum?></td>
										<td class="p_td right"></td>
                                    </tr>

                            </tbody>
                        </table>
                    <div class="container H_2px">
                      <p class="float_left">[P. 1]</p>
                      <p class="float_right"><?=date('Y-m-d h:m:i')?></p>
                    </div>
            </tbody>
        </table>
        
    </div><!-- //contents -->
</div> <!-- //idPrint -->

 </div> <!-- //wrap -->

<iframe name="ifrmExcel" style="width:0px; height:0px"></iframe> 
</body>
</html>