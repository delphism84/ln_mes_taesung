<?
include_once("../../common.php"); // 기본 파일
include_once("../../inc/dbconfig.php"); 
include_once("../../inc/func.php");  // 함수 파일
header("Content-type: text/html; charset=UTF-8"); 
if (!$is_member){
goto_url("/login.php");
exit;
}

//echo "project_code=".$project_code."<BR>";
if ($project_code==""){
	$sql="Select * From project where state = '진행' order by project_name ASC limit 0, 1";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$projectCode=$row['project_code'];
	$projectName=$row['project_name'];
	$project_code = $projectCode;
}else{
	$project_code = $project_code;
}
//echo "project_code=".$project_code."<BR><BR>";
$sql="Select * From project where project_code='".$project_code."' limit 0, 1";
$result = mysql_query($sql);
$rows = mysql_fetch_array($result);
$projectCode=$rows['project_code'];
$projectName=$rows['project_name'];
$tdate1=$rows['tdate1'];
$tdate2=$rows['tdate2'];
$current_prod_qty=$rows['current_prod_qty'];
$target_prod_qty=$rows['target_prod_qty'];


$sql="Select ord_no From work_orders where pjt_cd='".$project_code."' limit 0, 1";
$result = mysql_query($sql);
$row_w = mysql_fetch_array($result);
$ord_no=$row_w['ord_no'];


if ($current_prod_qty ==""){
	$current_prod_qty_value = erp_cnt_is('work_ordersSub',$ord_no,'ord_no','qty');
}else{
	$current_prod_qty_value = $current_prod_qty;
}

if ($target_prod_qty ==""){
	$target_prod_qty_value = erp_cnt_is('work_ordersSub',$ord_no,'ord_no','prod_qty');
}else{
	$target_prod_qty_value = $target_prod_qty;
}

$sqls="Select * From results_to_plan where project_code='".$project_code."' limit 0, 1";
$results = mysql_query($sqls);
if (!$results) {
	die('Query failed: ' . mysql_error());
}
$property	 = mysql_fetch_array($results);
$rtp_sn		 =$property['rtp_sn'];
$member_id	 =$property['member_id'];
$member_name =$property['member_name'];
$ru_project_code =$property['project_code'];
$project_name=$property['project_name'];
$in_ma_cost=$property['in_ma_cost'];
$out_ma_cost=$property['out_ma_cost'];
$direct_ma_cost=$property['direct_ma_cost'];
$indirect_ma_cost=$property['indirect_ma_cost'];
$total_ma_cost=$property['total_ma_cost'];
$in_ma_cost_plan=number_format($property['in_ma_cost_plan']);
$out_ma_cost_plan=number_format($property['out_ma_cost_plan']);
$direct_ma_cost_plan=number_format($property['direct_ma_cost_plan']);
$indirect_ma_cost_plan=number_format($property['indirect_ma_cost_plan']);
$total_ma_cost_plan=number_format($property['total_ma_cost_plan']);
$in_ma_cost_results=number_format($property['in_ma_cost_results']);
$out_ma_cost_results=number_format($property['out_ma_cost_results']);
$direct_ma_cost_results=number_format($property['direct_ma_cost_results']);
$indirect_ma_cost_results=number_format($property['indirect_ma_cost_results']);
$total_ma_cost_results=number_format($property['total_ma_cost_results']);
$in_ma_cost_gap=number_format($property['in_ma_cost_gap']);
$out_ma_cost_gap=number_format($property['out_ma_cost_gap']);
$direct_ma_cost_gap=number_format($property['direct_ma_cost_gap']);
$indirect_ma_cost_gap=number_format($property['indirect_ma_cost_gap']);
$total_ma_cost_gap=number_format($property['total_ma_cost_gap']);
$in_ma_cost_detail=$property['in_ma_cost_detail'];
$out_ma_cost_detail=$property['out_ma_cost_detail'];
$direct_ma_cost_detail=$property['direct_ma_cost_detail'];
$indirect_ma_cost_detail=$property['indirect_ma_cost_detail'];
$total_ma_cost_detail=$property['total_ma_cost_detail'];
$direct_labor_cost=$property['direct_labor_cost'];
$indirect_labor_cost=$property['indirect_labor_cost'];
$man_labor_cost=number_format($property['man_labor_cost']);
$total_labor_cost=number_format($property['total_labor_cost']);
$direct_labor_cost_plan=number_format($property['direct_labor_cost_plan']);
$indirect_labor_cost_plan=number_format($property['indirect_labor_cost_plan']);
$man_labor_cost_plan=number_format($property['man_labor_cost_plan']);
$total_labor_cost_plan=number_format($property['total_labor_cost_plan']);
$direct_labor_cost_results=number_format($property['direct_labor_cost_results']);
$indirect_labor_cost_results=number_format($property['indirect_labor_cost_results']);
$man_labor_cost_results=number_format($property['man_labor_cost_results']);
$total_labor_cost_results=number_format($property['total_labor_cost_results']);
$direct_labor_cost_gap=number_format($property['direct_labor_cost_gap']);
$indirect_labor_cost_gap=number_format($property['indirect_labor_cost_gap']);
$man_labor_cost_gap=number_format($property['man_labor_cost_gap']);
$total_labor_cost_gap=number_format($property['total_labor_cost_gap']);
$direct_labor_cost_detail=$property['direct_labor_cost_detail'];
$indirect_labor_cost_detail=$property['indirect_labor_cost_detail'];
$man_labor_cost_detail=$property['man_labor_cost_detail'];
$total_labor_cost_detail=$property['total_labor_cost_detail'];
$processing_cost=number_format($property['processing_cost']);
$testing_cost=number_format($property['testing_cost']);
$service_cost=number_format($property['service_cost']);
$total_direct_cost=number_format($property['total_direct_cost']);
$processing_cost_plan=number_format($property['processing_cost_plan']);
$testing_cost_plan=number_format($property['testing_cost_plan']);
$service_cost_plan=number_format($property['service_cost_plan']);
$total_direct_cost_plan=number_format($property['total_direct_cost_plan']);
$processing_cost_results=number_format($property['processing_cost_results']);
$testing_cost_results=number_format($property['testing_cost_results']);
$service_cost_results=number_format($property['service_cost_results']);
$total_direct_cost_results=number_format($property['total_direct_cost_results']);
$processing_cost_gap=number_format($property['processing_cost_gap']);
$testing_cost_gap=number_format($property['testing_cost_gap']);
$service_cost_gap=number_format($property['service_cost_gap']);
$total_direct_cost_gap=number_format($property['total_direct_cost_gap']);
$processing_cost_detail=$property['processing_cost_detail'];
$testing_cost_detail=$property['testing_cost_detail'];
$service_cost_detail=$property['service_cost_detail'];
$total_direct_cost_detail=$property['total_direct_cost_detail'];
$indirect_labor_law=$property['indirect_labor_law'];
$indirect_cost_law=$property['indirect_cost_law'];
$indirect_labor_law_plan=number_format($property['indirect_labor_law_plan']);
$indirect_cost_plan=number_format($property['indirect_cost_plan']);
$indirect_labor_law_results=number_format($property['indirect_labor_law_results']);
$indirect_cost_results=number_format($property['indirect_cost_results']);
$indirect_labor_law_gap=number_format($property['indirect_labor_law_gap']);
$indirect_cost_gap=number_format($property['indirect_cost_gap']);
$indirect_labor_law_detail=$property['indirect_labor_law_detail'];
$indirect_cost_detail=$property['indirect_cost_detail'];
$manufacturing_cost=$property['manufacturing_cost'];
$manufacturing_cost_plan=number_format($property['manufacturing_cost_plan']);
$manufacturing_cost_results=number_format($property['manufacturing_cost_results']);
$manufacturing_cost_gap=number_format($property['manufacturing_cost_gap']);
$manufacturing_cost_detail=$property['manufacturing_cost_detail'];
$management_cost=$property['management_cost'];
$management_cost_plan=number_format($property['management_cost_plan']);
$management_cost_results=number_format($property['management_cost_results']);
$management_cost_gap=number_format($property['management_cost_gap']);
$management_cost_detail=$property['management_cost_detail'];
$profits_cost=$property['profits_cost'];
$profits_cost_plan=number_format($property['profits_cost_plan']);
$profits_cost_results=number_format($property['profits_cost_results']);
$profits_cost_gap=number_format($property['profits_cost_gap']);
$profits_cost_detail=$property['profits_cost_detail'];
$tot_production_cost=$property['tot_production_cost'];
$tot_production_cost_plan=number_format($property['tot_production_cost_plan']);
$tot_production_cost_results=number_format($property['tot_production_cost_results']);
$tot_production_cost_gap=number_format($property['tot_production_cost_gap']);
$tot_production_cost_detail=$property['tot_production_cost_detail'];

//-재료비시작------------------------------------------------------------------------------------------------------------------------------------------------------------
//국내재료비 금액 및 비율 직접비계
$tot_direct_ma_cost = conv_num($in_ma_cost) + conv_num($out_ma_cost);
$tot_direct_ma_cost = number_format($tot_direct_ma_cost);

if ($tot_direct_ma_cost == ""){
	$direct_ma_cost = $direct_ma_cost;
}else
{
	$direct_ma_cost = $tot_direct_ma_cost;
}

//재료비 직접 국내 재료비 계획 계
$direct_ma_cost_plan_sum = conv_num($in_ma_cost_plan) + conv_num($out_ma_cost_plan);
$direct_ma_cost_plan_sum = number_format($direct_ma_cost_plan_sum);
if ($direct_ma_cost_plan_sum == ""){
	$direct_ma_cost_plan = $direct_ma_cost_plan;
}else
{
	$direct_ma_cost_plan = $direct_ma_cost_plan_sum;
}


//재료비 직접 국내 재료비 실적 -> 재료비 및 외주가공비 불러오기
$sql_sum="Select sum(CAST(REPLACE(TotalAmount,',','') as DECIMAL(10,0))) as TotalAmounts From porder where basic_date !='' and pjt_cd='".$project_code."' ";
//echo $sql_sum."<BR>";
$result_sum = mysql_query($sql_sum);
$row_s = mysql_fetch_array($result_sum);
$TotalAmount_results = $row_s['TotalAmounts'];

//$TotalAmount_results."<BR>";
//if ($TotalAmount_results ==""){
	$in_ma_cost_results = number_format($TotalAmount_results);
//}


//재료비 직접 국내 재료비 실적 계
$direct_ma_cost_results_sum = conv_num($in_ma_cost_results) + conv_num($out_ma_cost_results);
$direct_ma_cost_results_sum = number_format($direct_ma_cost_results_sum);
if ($direct_ma_cost_results == ""){
	$direct_ma_cost_results = $direct_ma_cost_results;
}else
{
	$direct_ma_cost_results = $direct_ma_cost_results_sum;
}


//재료비 직접 국내재료비 차이
$in_ma_cost_gap_hap = conv_num($in_ma_cost_results) + conv_num($in_ma_cost_plan);
$in_ma_cost_gap_hap = number_format($in_ma_cost_gap_hap);
if ($in_ma_cost_gap == ""){
	$in_ma_cost_gap = $in_ma_cost_gap_hap;
}else
{
	$in_ma_cost_gap = $in_ma_cost_gap_hap;
}


//재료비 직접 국내재료비 차이 계
$direct_ma_cost_gap_sum = conv_num($in_ma_cost_gap) + conv_num($out_ma_cost_gap);
$direct_ma_cost_gap_sum = number_format($direct_ma_cost_gap_sum);
if ($direct_ma_cost_gap_sum == ""){
	$direct_ma_cost_gap = $direct_ma_cost_gap;
}else
{
	$direct_ma_cost_gap = $direct_ma_cost_gap_sum;
}

//재료비 간접재료비 계획
$indirect_ma_cost_plan_sum = ((conv_num($in_ma_cost_plan) + conv_num($total_labor_cost_plan)) * $indirect_ma_cost)/100;
$indirect_ma_cost_plan_sum = number_format($indirect_ma_cost_plan_sum);
if ($indirect_ma_cost_plan_sum == ""){
	$indirect_ma_cost_plan = $indirect_ma_cost_plan;
}else
{
	$indirect_ma_cost_plan = $indirect_ma_cost_plan_sum;
}

//재료비 간접재료비 실적
$indirect_ma_cost_results_sum = ((conv_num($in_ma_cost_results) + conv_num($total_labor_cost_results))*$indirect_ma_cost)/100;
$indirect_ma_cost_results_sum = number_format($indirect_ma_cost_results_sum);
if ($indirect_ma_cost_results_sum == ""){
	$indirect_ma_cost_results = $indirect_ma_cost_results;
}else
{
	$indirect_ma_cost_results = $indirect_ma_cost_results_sum;
}

//재료비 간접재료비 차이
$indirect_ma_cost_gap_sum = conv_num($indirect_ma_cost_results) - conv_num($indirect_ma_cost_plan);
$indirect_ma_cost_gap_sum = number_format($indirect_ma_cost_gap_sum);
if ($indirect_ma_cost_gap_sum == ""){
	$indirect_ma_cost_gap = $indirect_ma_cost_gap;
}else
{
	$indirect_ma_cost_gap = $indirect_ma_cost_gap_sum;
}

//재료비계 계획
$total_ma_cost_plan_sum = conv_num($indirect_ma_cost_plan) + conv_num($direct_ma_cost_plan);
$total_ma_cost_plan_sum = number_format($total_ma_cost_plan_sum);
if ($total_ma_cost_plan_sum == ""){
	$total_ma_cost_plan = $total_ma_cost_plan;
}else
{
	$total_ma_cost_plan = $total_ma_cost_plan_sum;
}


//재료비계 실적 계
$total_ma_cost_results_sum = conv_num($indirect_ma_cost_results) + conv_num($direct_ma_cost_results);
$total_ma_cost_results_sum = number_format($total_ma_cost_results_sum);
if ($total_ma_cost_results == ""){
	$total_ma_cost_results = $total_ma_cost_results;
}else
{
	$total_ma_cost_results = $total_ma_cost_results_sum;
}

//재료비계 실적 계
$total_ma_cost_gap_sum = conv_num($indirect_ma_cost_gap) + conv_num($direct_ma_cost_gap);
$total_ma_cost_gap_sum = number_format($total_ma_cost_gap_sum);
if ($total_ma_cost_gap == ""){
	$total_ma_cost_gap = $total_ma_cost_gap;
}else
{
	$total_ma_cost_gap = $total_ma_cost_gap_sum;
}

//-재료비끝------------------------------------------------------------------------------------------------------------------------------------------------------------


//-노무비시작------------------------------------------------------------------------------------------------------------------------------------------------------------

//직접 노부비 계획
$direct_labor_cost_plan_sum = $direct_labor_cost * conv_num($man_labor_cost_plan);
$direct_labor_cost_plan_sum = number_format($direct_labor_cost_plan_sum);
if ($direct_labor_cost_plan == ""){
	$direct_labor_cost_plan = $direct_labor_cost_plan;
}else
{
	$direct_labor_cost_plan = $direct_labor_cost_plan_sum;
}

//투입공수 실적
$sql_sum="Select sum(TotalTime) as TotalTimes from daily_report where worker !='' and work_date !='' and pjt_cd='".$project_code."' ";

$result_sum = mysql_query($sql_sum);
$row_t = mysql_fetch_array($result_sum);
$TotalTimes_results = $row_t['TotalTimes'];
$man_labor_cost_results_db = number_format($TotalTimes_results);

if ($man_labor_cost_results == ""){
	$man_labor_cost_results = $man_labor_cost_results_db;
}else
{
	$man_labor_cost_results = $man_labor_cost_results;
}


//직접 노부비 실적
$direct_labor_cost_results_sum = $direct_labor_cost * conv_num($man_labor_cost_results);
$direct_labor_cost_results_sum = number_format($direct_labor_cost_results_sum);
if ($direct_labor_cost_results == ""){
	$direct_labor_cost_results = $direct_labor_cost_results;
}else
{
	$direct_labor_cost_results = $direct_labor_cost_results_sum;
}

//직접 노부비 차이
$direct_labor_cost_gap_sum = conv_num($direct_labor_cost_results) - conv_num($direct_labor_cost_plan);
$direct_labor_cost_gap_sum = number_format($direct_labor_cost_gap_sum);
if ($direct_labor_cost_gap == ""){
	$direct_labor_cost_gap = $direct_labor_cost_gap;
}else
{
	$direct_labor_cost_gap = $direct_labor_cost_gap_sum;
}


//간접 노부비 계획
$indirect_labor_cost_plan_sum = (conv_num($direct_labor_cost_plan) * $indirect_labor_cost)/100;
$indirect_labor_cost_plan_sum = number_format($indirect_labor_cost_plan_sum);
if ($indirect_labor_cost_plan == ""){
	$indirect_labor_cost_plan = $indirect_labor_cost_plan;
}else
{
	$indirect_labor_cost_plan = $indirect_labor_cost_plan_sum;
}

//간접 노부비 실적
$indirect_labor_cost_results_sum = ((conv_num($direct_labor_cost_results) * $indirect_labor_cost))/100;
$indirect_labor_cost_results_sum = number_format($indirect_labor_cost_results_sum);
if ($indirect_labor_cost_results == ""){
	$indirect_labor_cost_results = $indirect_labor_cost_results;
}else
{
	$indirect_labor_cost_results = $indirect_labor_cost_results_sum;
}

/*
//간접 노부비 차이
$indirect_labor_cost_gap_sum = conv_num($indirect_labor_cost_results) * conv_num($indirect_labor_cost_plan);
$indirect_labor_cost_gap_sum = number_format($indirect_labor_cost_gap_sum);
if ($indirect_labor_cost_gap == ""){
	$indirect_labor_cost_gap = $indirect_labor_cost_gap;
}else
{
	$indirect_labor_cost_gap = $indirect_labor_cost_gap_sum;
}
*/
//간접 노부비 차이
$indirect_labor_cost_gap_sum = conv_num($indirect_labor_cost_results) - conv_num($indirect_labor_cost_plan);
$indirect_labor_cost_gap_sum = number_format($indirect_labor_cost_gap_sum);
if ($indirect_labor_cost_gap == ""){
	$indirect_labor_cost_gap = $indirect_labor_cost_gap;
}else
{
	$indirect_labor_cost_gap = $indirect_labor_cost_gap_sum;
}

//노부비 투입인력 차이

$man_labor_cost_gap_sum = conv_num($man_labor_cost_results) - conv_num($man_labor_cost_plan);
$man_labor_cost_gap_sum = number_format($man_labor_cost_gap_sum);
if ($man_labor_cost_gap == ""){
	$man_labor_cost_gap = $man_labor_cost_gap;
}else
{
	$man_labor_cost_gap = $man_labor_cost_gap_sum;
}

//노부비 계획 계
$total_labor_cost_plan_sum = conv_num($indirect_labor_cost_plan) + conv_num($direct_labor_cost_plan);
$total_labor_cost_plan_sum = number_format($total_labor_cost_plan_sum);
if ($total_labor_cost_plan == ""){
	$total_labor_cost_plan = $total_labor_cost_plan;
}else
{
	$total_labor_cost_plan = $total_labor_cost_plan_sum;
}

//노부비 실적 계
$total_labor_cost_results_sum = conv_num($indirect_labor_cost_results) + conv_num($direct_labor_cost_results);
$total_labor_cost_results_sum = number_format($total_labor_cost_results_sum);
if ($total_labor_cost_results == ""){
	$total_labor_cost_results = $total_labor_cost_results;
}else
{
	$total_labor_cost_results = $total_labor_cost_results_sum;
}

//노부비 차이 계
$total_labor_cost_gap_sum = conv_num($total_labor_cost_results) - conv_num($total_labor_cost_plan);
$total_labor_cost_gap_sum = number_format($total_labor_cost_gap_sum);
if ($total_labor_cost_gap == ""){
	$total_labor_cost_gap = $total_labor_cost_gap;
}else
{
	$total_labor_cost_gap = $total_labor_cost_gap_sum;
}

//-노무비끝------------------------------------------------------------------------------------------------------------------------------------------------------------

//-직접경비 시작------------------------------------------------------------------------------------------------------------------------------------------------------------

//직접경비 외주가공비 불러오기
$sql_sum1="Select sum(used) as money From expenses a join expenses_detail b on a.detail_key = b.detail_key where project_code='".$project_code."' and type='외주가공비' ";
$result_sum1 = mysql_query($sql_sum1);
$row_s1 = mysql_fetch_array($result_sum1);
$money_results1 = $row_s1['money'];
$processing_cost_results_sum = number_format($money_results1);
if ($processing_cost_results == ""){
	$processing_cost_results = $processing_cost_results;
}else
{
	$processing_cost_results = $processing_cost_results_sum;
}

//직접경비 시험검사비 불러오기
$sql_sum2="Select sum(used) as money From expenses a join expenses_detail b on a.detail_key = b.detail_key where project_code='".$project_code."' and type='시험검사비' ";
//echo $sql_sum."<BR>";
$result_sum2 = mysql_query($sql_sum2);
$row_s2 = mysql_fetch_array($result_sum2);
$TotalAmount_results2 = $row_s2['money'];
$testing_cost_results_sum = number_format($TotalAmount_results2);
if ($testing_cost_results == ""){
	$testing_cost_results = $testing_cost_results;
}else
{
	$testing_cost_results = $testing_cost_results_sum;
}

//직접경비 외주용역비 불러오기
$sql_sum3="Select sum(used) as money From expenses a join expenses_detail b on a.detail_key = b.detail_key where project_code='".$project_code."' and type='외주용역비' ";
//echo $sql_sum3."<BR>";
$result_sum3 = mysql_query($sql_sum3);
$row_s3 = mysql_fetch_array($result_sum3);
$TotalAmount_results3 = $row_s3['money'];
$service_cost_results_sum = number_format($TotalAmount_results3);
if ($service_cost_results == ""){
	$service_cost_results = $service_cost_results;
}else
{
	$service_cost_results = $service_cost_results_sum;
}

//직접경비 외주가공비 차이
$processing_cost_gap_sum = conv_num($processing_cost_results) - conv_num($processing_cost_plan);
$processing_cost_gap_sum = number_format($processing_cost_gap_sum);
if ($processing_cost_gap == ""){
	$processing_cost_gap = $processing_cost_gap;
}else
{
	$processing_cost_gap = $processing_cost_gap_sum;
}


//직접경비 시험검사비 차이
$testing_cost_gap_sum = conv_num($testing_cost_results) - conv_num($testing_cost_plan);
$testing_cost_gap_sum = number_format($testing_cost_gap_sum);
if ($testing_cost_gap == ""){
	$testing_cost_gap = $testing_cost_gap;
}else
{
	$testing_cost_gap = $testing_cost_gap_sum;
}

//직접경비 외주용역비 차이
$service_cost_gap_sum = conv_num($service_cost_results) - conv_num($service_cost_plan);
$service_cost_gap_sum = number_format($service_cost_gap_sum);
if ($service_cost_gap == ""){
	$service_cost_gap = $service_cost_gap;
}else
{
	$service_cost_gap = $service_cost_gap_sum;
}

  
//직접경비 계획 계
$total_direct_cost_plan_sum = conv_num($processing_cost_plan) + conv_num($testing_cost_plan) + conv_num($service_cost_plan);
$total_direct_cost_plan_sum = number_format($total_direct_cost_plan_sum);
if ($total_direct_cost_plan == ""){
	$total_direct_cost_plan = $total_direct_cost_plan;
}else
{
	$total_direct_cost_plan = $total_direct_cost_plan_sum;
}


//직접경비 실적 계
$total_direct_cost_results_sum = conv_num($processing_cost_results) + conv_num($testing_cost_results) + conv_num($service_cost_results);
$total_direct_cost_results_sum = number_format($total_direct_cost_results_sum);
if ($total_direct_cost_results == ""){
	$total_direct_cost_results = $total_direct_cost_results;
}else
{
	$total_direct_cost_results = $total_direct_cost_results_sum;
}

//직접경비 차이 계
$total_direct_cost_gap_sum = conv_num($total_direct_cost_results) - conv_num($total_direct_cost_plan);
$total_direct_cost_gap_sum = number_format($total_direct_cost_gap_sum);
if ($total_direct_cost_gap == ""){
	$total_direct_cost_gap = $total_direct_cost_gap;
}else
{
	$total_direct_cost_gap = $total_direct_cost_gap_sum;
}




//-직접경비끝------------------------------------------------------------------------------------------------------------------------------------------------------------

//-노무비법------------------------------------------------------------------------------------------------------------------------------------------------------------
//노무비법 계획
$indirect_labor_law_plan_sum = ($indirect_labor_law * conv_num($total_labor_cost_plan))/100;
$indirect_labor_law_plan_sum = number_format($indirect_labor_law_plan_sum);
if ($indirect_labor_law_plan == ""){
	$indirect_labor_law_plan = $indirect_labor_law_plan;
}else
{
	$indirect_labor_law_plan = $indirect_labor_law_plan_sum;
}


//노무비법 실적
$indirect_labor_law_results_sum = ($indirect_labor_law * conv_num($total_labor_cost_results))/100;
$indirect_labor_law_results_sum = number_format($indirect_labor_law_results_sum);

if ((conv_num($indirect_labor_law_results) == conv_num($indirect_labor_law_results_sum))){
	$indirect_labor_law_results = $indirect_labor_law_results;
}else{
	$indirect_labor_law_results = $indirect_labor_law_results_sum;
}

//노무비법 차이
$indirect_labor_law_gap_sum = conv_num($indirect_labor_law_results) - conv_num($indirect_labor_law_plan);
$indirect_labor_law_gap_sum = number_format($indirect_labor_law_gap_sum);
if ($indirect_labor_law_gap == ""){
	$indirect_labor_law_gap = $indirect_labor_law_gap;
	
}else{
	$indirect_labor_law_gap = $indirect_labor_law_gap_sum;
}
//-노무비법------------------------------------------------------------------------------------------------------------------------------------------------------------


//-원가법------------------------------------------------------------------------------------------------------------------------------------------------------------
//원가법 계획

$indirect_cost_plan_sum = ((conv_num($total_labor_cost_plan)+conv_num($direct_ma_cost_plan)) * $indirect_cost_law)/100 ;
$indirect_cost_plan_sum = number_format($indirect_cost_plan_sum);
if ($indirect_cost_plan == ""){
	$indirect_cost_plan = $indirect_cost_plan;
}else
{
	$indirect_cost_plan = $indirect_cost_plan_sum;
}

//원가법 실적
$indirect_cost_results_sum = ((conv_num($total_labor_cost_results)+conv_num($direct_ma_cost_results)) * $indirect_cost_law)/100;
$indirect_cost_results_sum = number_format($indirect_cost_results_sum);
if ($indirect_cost_results == ""){
	$indirect_cost_results = $indirect_cost_results;
}else
{
	$indirect_cost_results = $indirect_cost_results_sum;
}

//원가법 차이
$indirect_cost_gap_sum = conv_num($indirect_cost_results) - conv_num($indirect_cost_plan);
$indirect_cost_gap_sum = number_format($indirect_cost_gap_sum);
if ($indirect_cost_gap == ""){
	$indirect_cost_gap = $indirect_cost_gap;
}else
{
	$indirect_cost_gap = $indirect_cost_gap_sum;
}
//-원가법끝------------------------------------------------------------------------------------------------------------------------------------------------------------


$direct_ma_cost_results_hap = $TotalAmount_results - $out_ma_cost_results;
$direct_ma_cost_results = number_format($direct_ma_cost_results_hap);


//제조원가 계획
$tot_manufacturing_cost_plan = conv_num($total_ma_cost_plan) + conv_num($total_labor_cost_plan) + conv_num($total_direct_cost_plan) + conv_num($indirect_labor_law_plan) + conv_num($indirect_cost_plan);
$tot_manufacturing_cost_plan = number_format($tot_manufacturing_cost_plan);

//제조원가 실적
$tot_manufacturing_cost_results = conv_num($total_ma_cost_results) + conv_num($total_labor_cost_results) + conv_num($total_direct_cost_results) + conv_num($indirect_labor_law_results) + conv_num($indirect_cost_results);
$tot_manufacturing_cost_results = number_format($tot_manufacturing_cost_results);

//제조원가 차이
$tot_manufacturing_cost_gap = conv_num($tot_manufacturing_cost_results) -  conv_num($tot_manufacturing_cost_plan);
$tot_manufacturing_cost_gap = number_format($tot_manufacturing_cost_gap);


//일반 관리비 계획
$management_cost_plan_sum = (conv_num($tot_manufacturing_cost_plan) * $management_cost)/100;
$management_cost_plan_sum = number_format($management_cost_plan_sum);
if ($management_cost_plan == ""){
	$management_cost_plan = $management_cost_plan;
}else
{
	$management_cost_plan = $management_cost_plan_sum;
}

//일반 관리비 실적
$management_cost_results_sum = (conv_num($tot_manufacturing_cost_results) * $management_cost)/100;
$management_cost_results_sum = number_format($management_cost_results_sum);
if ($management_cost_results == ""){
	$management_cost_results = $management_cost_results;
}else
{
	$management_cost_results = $management_cost_results_sum;
}


//일반 관리비 차이
$management_cost_gap_sum = conv_num($management_cost_results) - conv_num($management_cost_plan);
$management_cost_gap_sum = number_format($management_cost_gap_sum);
if ($management_cost_gap == ""){
	$management_cost_gap = $management_cost_gap;
}else
{
	$management_cost_gap = $management_cost_gap_sum;
}


//이윤 계획
$profits_cost_plan_sum = (((conv_num($tot_manufacturing_cost_plan) + conv_num($management_cost_plan)) * conv_num($profits_cost))/100)-24894;
$profits_cost_plan_sum = number_format($profits_cost_plan_sum);
if ($profits_cost_plan == ""){
	$profits_cost_plan = $profits_cost_plan;
}else
{
	$profits_cost_plan = $profits_cost_plan_sum;
}

//이윤 실적
$profits_cost_results_sum = (((conv_num($tot_manufacturing_cost_results) + conv_num($management_cost_results)) * conv_num($profits_cost))/100);
$profits_cost_results_sum = number_format($profits_cost_results_sum);
if ($profits_cost_results == ""){
	$profits_cost_results = $profits_cost_results;
}else
{
	$profits_cost_results = $profits_cost_results_sum;
}


//이윤 차이
$profits_cost_gap_sum = conv_num($profits_cost_results) - conv_num($profits_cost_plan);
$profits_cost_gap_sum = number_format($profits_cost_gap_sum);
if ($profits_cost_gap == ""){
	$profits_cost_gap = $profits_cost_gap;
}else
{
	$profits_cost_gap = $profits_cost_gap_sum;
}


//총원가 계획
$tot_production_cost_plan_sum = conv_num($tot_manufacturing_cost_plan) + conv_num($management_cost_plan) + conv_num($profits_cost_plan);
$tot_production_cost_plan_sum = number_format($tot_production_cost_plan_sum);
if ($tot_production_cost_plan == ""){
	$tot_production_cost_plan = $tot_production_cost_plan;
}else
{
	$tot_production_cost_plan = $tot_production_cost_plan_sum;
}

//총원가 실적
$tot_production_cost_results_sum = conv_num($tot_manufacturing_cost_results) + conv_num($management_cost_results) + conv_num($profits_cost_results);
$tot_production_cost_results_sum = number_format($tot_production_cost_results_sum);
if ($tot_production_cost_results == ""){
	$tot_production_cost_results = $tot_production_cost_results;
}else
{
	$tot_production_cost_results = $tot_production_cost_results_sum;
}


//총원가 차이
$tot_production_cost_gap_sum = conv_num($tot_production_cost_results) - conv_num($tot_production_cost_plan);
$tot_production_cost_gap_sum = number_format($tot_production_cost_gap_sum);
if ($tot_production_cost_gap == ""){
	$tot_production_cost_gap = $tot_production_cost_gap;
}else
{
	$tot_production_cost_gap = $tot_production_cost_gap_sum;
}
//$projectName = iconv('euc-kr', 'utf-8', $projectName);
$excelFileName = $projectName." 계획대비 실적";
$excelFileName = iconv('UTF-8', 'EUC-KR', $excelFileName);
function utf2euc($str) { return iconv("euc-kr","UTF-8", $str); }
header( "Content-type: application/vnd.ms-excel; charset=utf-8" );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
header( "Pragma: public" );
header( "Content-Disposition: attachment; filename=".$excelFileName.".xls" );
$projectName = utf2euc($projectName);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>기초자료 : 프로젝트관리</title>
<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

	<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">.
					  <a name="Print_Area"><span style="font-weight:bold;font-size:24pt;"><?=$projectName?> 계획 대비 실적</span></a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">.
					  ○계약기간 : <?=$tdate1?> - <?=$tdate2?>(<?=number_format($target_prod_qty_value)?>대) - 현재 조립대수 <?=number_format($current_prod_qty_value)?>대.</div>	
				 </div>
				<div class="row">
					<div style="text-align:right">(단위 : 원)</div>
				</div>
				<div class="row">
		   		<form name="contFrm" id="contFrm" method="post" action="">
				<input type="hidden" name="rtp_sn" value="<?=$rtp_sn?>">
				<table class="table table-bordered" border=1>
					 <col  width=100>
					 <col  width=50>
					 <col  width=150>
					 <col  width=150>
					 <col  width=150>
					 <col  width=150>
					 <col  width=150>
					 <col  width=auto>
					 <tr class="success" />
					  <th colspan=3 >구&nbsp;&nbsp; </span>분&nbsp;&nbsp;&nbsp;&nbsp;</th>
					  <th >금액 및 비율</th>
					  <th>계획</th>
					  <th>실적</th>
					  <th>차이</th>
					  <th>차이내역</th>
					 </tr>
					 <tr  >
					  <th rowspan=5 style="font-weight:bold">재료비</th>
					  <th rowspan=3  style="font-weight:bold">직<br>접</th>
					  <th style="font-weight:bold">·국내재료비</th>
					  <td><?=round($in_ma_cost, 2);?></td>
					  <td><?=$in_ma_cost_plan?></td>
					  <td><?=$in_ma_cost_results?></td>
					  <td><?=$in_ma_cost_gap?></td>
					  <td><?=$in_ma_cost_detail?></td>
					 </tr>
					 <tr >
					  <th style="font-weight:bold">·수입재료비</th>
					  <td><?=round($out_ma_cost, 2);?></td>
					  <td><?=$out_ma_cost_plan?></td>
					  <td><?=$out_ma_cost_results?></td>
					  <td><?=$out_ma_cost_gap?></td>
					  <td><?=$out_ma_cost_detail?></td>
					 </tr>
					 <tr  >
					  <th style="font-weight:bold">계</th>
					  <td ><?=round($direct_ma_cost, 2);?></td>
					  <td><?=$direct_ma_cost_plan?></td>
					  <td><?=$direct_ma_cost_results?></td>
					  <td><?=$direct_ma_cost_gap?></td>
					  <td><?=$direct_ma_cost_detail?></td>
					 </tr>
					 <tr  >
					  <th colspan=2 style="font-weight:bold">간접재료비</th>
					  <td ><?=round($indirect_ma_cost, 2);?>%</td>
					  <td><?=$indirect_ma_cost_plan?></td>
					  <td><?=$indirect_ma_cost_results?></td>
					  <td><?=$indirect_ma_cost_gap?></td>
					  <td><?=$indirect_ma_cost_detail?></td>
					 </tr>
					 <tr >
					  <th colspan=2 style="font-weight:bold">재료비 계</th>
					  <td><?=round($total_ma_cost, 2);?></td>
					  <td><?=$total_ma_cost_plan?></td>
					  <td><?=$total_ma_cost_results?></td>
					  <td><?=$total_ma_cost_gap?></td>
					  <td><?=$total_ma_cost_detail?></td>
					 </tr>
					 <tr  >
					  <th rowspan=4  style="font-weight:bold">노무비</th>
					  <th colspan=2 style="font-weight:bold">직접노무비</th>
					  <td ><?=round($direct_labor_cost, 2);?></td>
					  <td ><?=$direct_labor_cost_plan?></td>
					  <td ><?=$direct_labor_cost_results?></td>
					  <td><?=$direct_labor_cost_gap?></td>
					  <td><?=$direct_labor_cost_detail?></td>
					 </tr>
					 <tr  >
					  <th colspan=2 style="font-weight:bold">간접노무비</th>
					  <td><?=round($indirect_labor_cost, 2);?>%</td>
					  <td><?=$indirect_labor_cost_plan?></td>
					  <td><?=$indirect_labor_cost_results?></td>
					  <td><?=$indirect_labor_cost_gap?></td>
					  <td><?=$indirect_labor_cost_detail?></td>
					 </tr>
					 <tr  >
					  <th colspan=2 style="font-weight:bold">투입인력(M/H)</th>
					  <td><?=round($man_labor_cost, 2);?></td>
					  <td><?=$man_labor_cost_plan?></td>
					  <td><?=$man_labor_cost_results?></td>
					  <td><?=$man_labor_cost_gap?></td>
					  <td><?=$man_labor_cost_detail?></td>
					 </tr>
					 <tr  >
					  <th colspan=2 style="font-weight:bold">계</th>
					  <td><?=round($total_labor_cost, 2);?></td>
					  <td><?=$total_labor_cost_plan?></td>
					  <td><?=$total_labor_cost_results?></td>
					  <td><?=$total_labor_cost_gap?></td>
					  <td ><?=$total_labor_cost_detail?></td>
					 </tr>
					 <tr  >
					  <th rowspan=4  style="font-weight:bold">직접경비</th>
					  <th rowspan=4 style="font-weight:bold">직<br>접</th>
					  <th style="font-weight:bold">외주가공비</th>
					  <td><?=round($processing_cost, 2);?></td>
					  <td><?=$processing_cost_plan?></td>
					  <td><?=$processing_cost_results?></td>
					  <td><?=$processing_cost_gap?></td>
					  <td><?=$processing_cost_detail?></td>
					 </tr>
					 <tr  >
					  <th style="font-weight:bold">시험검사비</th>
					  <td><?=round($testing_cost, 2);?></td>
					  <td><?=$testing_cost_plan?></td>
					  <td><?=$testing_cost_results?></td>
					  <td><?=$testing_cost_gap?></td>
					  <td><?=$testing_cost_detail?></td>
					 </tr>
					 <tr  >
					  <th style="font-weight:bold">외주용역비<font></th>
					  <td><?=round($service_cost, 2);?></td>
					  <td><?=$service_cost_plan?></td>
					  <td><?=$service_cost_results?></td>
					  <td><?=$service_cost_gap?></td>
					  <td><?=$service_cost_detail?></td>
					 </tr>
					 <tr  >
					  <th  style="font-weight:bold">계</th>
					  <td><?=round($total_direct_cost, 2);?></td>
					  <td><?=$total_direct_cost_plan?></td>
					  <td><?=$total_direct_cost_results?></td>
					  <td><?=$total_direct_cost_gap?></td>
					  <td><?=$total_direct_cost_detail?></td>
					 </tr>
					 <tr  >
					  <th rowspan=2  style="font-weight:bold"><span>간접경비<span></th>
					  <th colspan=2 style="font-weight:bold">노무비법</th>
					  <td ><?=round($indirect_labor_law, 2);?>%</td>
					  <td ><?=$indirect_labor_law_plan?></td>
					  <td ><?=$indirect_labor_law_results?></td>
					  <td ><?=$indirect_labor_law_gap?></td>
					  <td ><?=$indirect_labor_law_detail?></td>
					 </tr>
					 <tr  >
					  <th colspan=2 style="font-weight:bold">원가법</th>
					  <td ><?=round($indirect_cost_law, 2);?>%</td>
					  <td ><?=$indirect_cost_plan?></td>
					  <td ><?=$indirect_cost_results?></td>
					  <td ><?=$indirect_cost_gap?></td>
					  <td ><?=$indirect_cost_detail?></td>
					 </tr>
					 <tr  >
					  <th colspan=3 style="font-weight:bold">제조원가</th>
					  <td><?=round($manufacturing_cost, 2);?></td>
					  <td><?=$tot_manufacturing_cost_plan?></td>
					  <td><?=$tot_manufacturing_cost_results?></td>
					  <td ><?=$tot_manufacturing_cost_gap?></td>
					  <td ><?=$manufacturing_cost_detail?></td>
					 </tr>
					 <tr >
					  <th colspan=3 style="font-weight:bold">일반관리비</th>
					  <td><?=round($management_cost, 2);?>%</td>
					  <td><?=$management_cost_plan?></td>
					  <td><?=$management_cost_results?></td>
					  <td ><?=$management_cost_gap?></td>
					  <td><?=$management_cost_detail?></td>
					 </tr>
					 <tr >
					  <th colspan=3 style="font-weight:bold">이&nbsp;&nbsp;&nbsp;
					  </span>윤</th>
					  <td><?=round($profits_cost, 2);?>%</td>
					  <td><?=$profits_cost_plan?></td>
					  <td><?=$profits_cost_results?></td>
					  <td ><?=$profits_cost_gap?></td>
					  <td><?=$profits_cost_detail?></td>
					 </tr>
					 <tr >
					  <th colspan=3 style="font-weight:bold">총원가</th>
					  <td ><?=round($tot_production_cost, 2);?></td>
					  <td ><?=$tot_production_cost_plan?></td>
					  <td ><?=$tot_production_cost_results?></td>
					  <td><?=$tot_production_cost_gap?></td>
					  <td><?=$tot_production_cost_detail?></td>
					 </tr>
				</table>
				</form>
		</div>
  </div>
</body>
</html>
