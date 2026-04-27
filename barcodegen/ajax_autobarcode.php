
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
if($state == "입고"){
	$query = " select count(*) as cnt from barcode_list where itemcd = '".$itemcd."' and barcode is not null ";
	$result = mysql_query($query) or die();
	$rs = mysql_fetch_array($result);
	$idx = $rs[cnt]+1;
	$subbarcode = $barcode."-@".$idx;

	$query = " insert into barcode_list set 
										barcode = '".$subbarcode."',"
									 ." itemcd = '".$itemcd."',"
									 ." state = '".$state."',"
									 ." regdate = now()";
	$result2 = mysql_query($query) or die();
	if($result2){
		$rst = 1;
	}
}else if($state == "출고"){
	$query = " select barcode from barcode_list where itemcd = '".$itemcd."' and barcode is not null and state = '입고' order by num asc limit 0,1 ";
	$result = mysql_query($query) or die();
	$rs = mysql_fetch_array($result);

	$query = " update barcode_list set state='".$state."', outdate=now()  where barcode = '".$rs[barcode]."'";
	$result2 = mysql_query($query) or die();
	if($result2){
		$rst = 1;
	}
}else if($state == "출고품목등록"){
	$query = " select count(*) as cnt from barcode_list where itemcd = '".$itemcd."' and barcode is not null ";
	$result = mysql_query($query) or die();
	$rs = mysql_fetch_array($result);
	$idx = $rs[cnt]+1;
	$subbarcode = $barcode."-@".$idx;

	$query = " insert into barcode_list set 
										barcode = '".$subbarcode."',"
									 ." itemcd = '".$itemcd."',"
									 ." state = '출고',"
									 ." regdate = now(),"
									 ." outdate = now()";
	$result2 = mysql_query($query) or die();
	if($result2){
		$rst = 1;
	}
}
?>
{"rst" : "<?=$rst?>", "barcode" : "<?=$barcode?>"}