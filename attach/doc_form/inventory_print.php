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

if ($start_date !="" || $end_date !=""){
	$search_sql=" and (replace(basic_date,'/','') between '" .$start_date ."' and '" .$end_date ."')";
}
If (!Empty($srch_type) && !Empty($srch_word)){
$sech_link=$sech_link ."&srch_type=" .$srch_type;
$sech_link=$sech_link ."&srch_word=" .$srch_word;
$search_sql = $search_sql ." and " .$srch_type ." like '%" .$srch_word ."%'";
}

//'테이블명
$table_name="inventory";
//'fild_name=" where mem_sn="
//'recd_value="'" .memberCsn ."' "
$fild_name=" where itemnm !='' ";
//$fild_name=" ";
//If ($memberClevel=="3" ){
	//$recd_value=" (mem_sn='" .$memberCsn ."' or (group_sn='" .$memberCuser_group_sn ."' ))";
//	$recd_value=" (mem_sn='" .$memberCsn ."' or (group_sn='" .$memberCuser_group_sn ."' ))";
//}else{
	//$recd_value=" (mem_sn='" .$memberCsn ."'or (group_sn='" .$memberCuser_group_sn ."' ))";
//	$recd_value=" (mem_sn='" .$memberCsn ."'or (group_sn='" .$memberCuser_group_sn ."' ))";
//}

//'소팅 목록
$sortitem_basic="product_id";
//Dim sortitem_list(1)
$sortitem_list[0]="product_id";
//'sortitem_list(1)="daily_date"
$sortitem_list[1]="regdate";


//''''''''''''''''''''''''''''''''''''''''
$pagesize=$pagesize;
$page=$page;

if (empty($pagesize)) $pagesize=3000;
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
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>자재관리 조회 : 기초자료</title>
<link href="/weberp/css/reset.css" rel="stylesheet" type="text/css" media="all">
<link href="/weberp/css/common.css" rel="stylesheet" type="text/css" media="all">
<script> 
window.onload = function(){
	window.print();
}
</script> 
</head>
<body>
	<div class='font-undefined ' style='width: 835px; '>
		<div class="contents" style="margin: 33px 5px 20px 5px;">
			<div class=title>재고현황</div>
		</div>
	</div>
	<DIV style="WIDTH: 834px" class="right"><?=date('Y/m/d')?> </DIV>
		<table style="WIDTH: 834px" border="0" cellspacing="0" cellpadding="0" class="board401">
		   <colgroup>
			<col width="160" />
			<col width="224" />
			<col width="80" />
			<col width="80" />
			<col width="80" />
			<col width="100" />
			<col width="80" />
		   </colgroup>
		   <thead>
			<tr>
				<th>품목코드</th>
				<th>품목명</th>				
				<th>규격</th>
				<th>총재고수량</th>						
				<th>입고단가</th>
				<th>금액</th>
				<th>사진</th>
			</tr>
		   </thead>
		   <tbody>
		   <?
			$search_sql = $search_sql .$chk_search;
			$sql = "Select * From  " .$table_name .$fild_name .$recd_value .$search_sql ." order by " .$sort .$mode .$limit;;
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
				$in_unitprice_sum = $in_unitprice_sum + $in_unitprice;
				$total_sum  =  $total_sum + ($stock_amount_sum * $in_unitprice_sum);
			?>
				 <tr>						
					<td ><?=$itemcd?></td>
					<td><?=$itemnm?></td>
					<td><?=$standard?></td>
					<td class="right" <?if($stock_amount < 0) echo "style='background:#ffd9d9'"?>><?=number_format($stock_amount)?></td>
					<td class="right"><?=number_format($in_unitprice)?></td>
					<td class="right"><?=number_format(($stock_amount*$in_unitprice))?></td>
					<td class="center"><span class="tdPic tdPic_custom"><img src="<?=$image_filename_link?>" alt="제품사진"></span></td>
				 </tr>
				 <?
			$ct++;

				If (!$result) echo "<tr id='list_line'><td colspan='" .$colspan ."'></td></tr>";
			}
			}else{
			?>
				<tr>
				<td colspan="<?=$colspan?>" class="centered">
				<p>검색된 결과가 없습니다</p>
				</td>
				</tr>
			<?
			}
			?>
			<tr><th scope="col" class="cate_bg" colspan=3>합계</th>
				<th class="right"><?=number_format($stock_amount_sum)?></th>
				<th class="right"><?=number_format($in_unitprice_sum)?></th>
				<th class="right"><?=number_format($total_sum)?></th>
				<th></th>
			</tr>	
			</tbody>
		</table>
		<div class="timeBox"><?=date('Y/m/d H:m:s')?></div>
		<div class='pageBox'>
			<? include_once("../inc/pageing.php"); // 기본 파일?>
		</div>
</body>
</html>
