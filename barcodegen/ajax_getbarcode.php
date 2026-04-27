<?
include_once("../common.php"); // 기본 파일
include_once("../inc/dbconfig.php"); 
include_once("../inc/func.php");  // 함수 파일
//header("Content-type: text/html; charset=UTF-8"); 
if (!$is_member){
	goto_url("/login.php");
	exit;
}
$rst = 0;
$query = " select * from product where barcode = '".$barcode."' and barcode is not null ";
$result = mysql_query($query) or die();
$rs = mysql_fetch_array($result);

if($rs[product_id]){
	$rst = 1;
}
?>
{"rst" : "<?=$rst?>", "product" : "<?=$rs[itemnm]?>", "itemcd" : "<?=$rs[itemcd]?>", "in_unitprice" : "<?=$rs[in_unitprice]?>", "out_unitprice" : "<?=$rs[out_unitprice]?>", "barcode" : "<?=$barcode?>"}

