<?
include_once("../common.php"); // 기본 파일
include_once("../inc/dbconfig.php"); 
include_once("../inc/func.php");  // 함수 파일
header("Content-type: text/html; charset=UTF-8"); 
if (!$is_member){
goto_url("/login.php");
exit;
}
$colspan = "6";
?>

<?
$sh["rPath"]	= "..";
//include_once($sh["rPath"]."/_common.php");
//include_once("./admin_auth_check.php");
//$DB			= new database;
$data		= $_POST;

//echo $data[porder_date];
//exit;
$referer	=  prevpage();
$table		= "inventory_inout";

$query = "SELECT count(*) as cnt FROM ".$table." where left(inout_no,10) ='".$_POST['basic_date']."'";
//echo $query."<BR>";

$result = mysql_query($query);
if ($result){
	$row	= mysql_fetch_array($result);			

	$cnt	= $row['cnt'];
	//echo $cnt."<BR>";
	$cntplus = $cnt + 1;
	//echo $cntplus."<BR><BR>";
}
//exit;
$data[puord_no]				= $data['basic_date']."-".$cntplus;

//post가 아니면 차단.
if(strcmp($_SERVER[REQUEST_METHOD], "POST")){
	js_alert_back('잘못된 접근입니다. 다시 시도해 주세요.');
	exit;
}
$count = count($data['barcode']);

for ($i=0; $i<$count; $i++){

	if ($data['is_pd'][$i] != 0 && $data['is_pd'][$i] != ""){		
		if($state == "out_barcode"){
			echo "puord_no : ".$data[puord_no]."itemcd : ".$data['itemcd'][$i]." // qty : ".$data['qty'][$i]." // out_unitprice : ".$data['out_unitprice'][$i]." // 0 // product :".$data['product'][$i]." // wh_cd : ".$data['wh_cd'][$i]." // wh_name : ".$data['wh_name'][$i];
			echo $data[puord_no],$data['basic_date'],$data['itemcd'][$i],$data['product'][$i],'바코드출고','','','0',$data['out_unitprice'][$i],'0',$data['qty'][$i],$data['wh_cd'],$data['wh_name'];
			inventory_insert_is($data['itemcd'][$i],$data['qty'][$i],'0',$data['out_unitprice'][$i],$data['product'][$i],$data['wh_cd'][$i],$data['wh_name'][$i]);
			inventory_inout_insert_is($data[puord_no],$data['basic_date'],$data['itemcd'][$i],$data['product'][$i],'바코드출고','','','0','0',$data['out_unitprice'][$i],$data['qty'][$i],$data['wh_cd'],$data['wh_name']); //재고관리 출고 기록 insert
			//echo "inventory_inout res // puord_no :".$data[puord_no]." / basic_date :".$data['basic_date']." / itemcd :".$data['itemcd'][$i]."product :".$data['product'][$i],'바코드출고 , , , 0, / out_unitprice : '.$data['out_unitprice'][$i]." / qty : ".$data['qty'][$i]." / wh_cd : ".$data['wh_cd']."/ wh_name".$data['wh_name'];
		} else {
			//echo "itemcd : ".$data['itemcd'][$i]." // qty : ".$data['qty'][$i]." // in_unitprice : ".$data['in_unitprice'][$i]." // 0 // product :".$data['product'][$i]." // wh_cd : ".$data['wh_cd'][$i]." // wh_name : ".$data['wh_name'][$i];
			//inventory_insert_is($data['itemcd'][$i],$data['qty'][$i],$data['in_unitprice'][$i],'0',$data['product'][$i],$data['wh_cd'][$i],$data['wh_name'][$i]);
			//inventory_inout_insert_is($data[puord_no],$data['basic_date'],$data['itemcd'][$i],$data['product'][$i],'바코드입고','','',$data['in_unitprice'][$i],$data['qty'][$i],'0','0',$data['wh_cd'],$data['wh_name']); //재고관리 입고 기록 insert
		}
		
	}
}

//goto_url($referer);

?>