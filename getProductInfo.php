<?
mysql_connect("localhost","neblog","since1970","neblog") or die ("Connect Error");
mysql_select_db("neblog");

$json_data = $_POST['jsondata'];
$array = json_decode($json_data, true);

foreach($array as $key => $value) {
	switch($key) {
		case "barcode" : $barcode = $value ; break;
		default : echo "error" ; break;
	}
}

// AS ¼³Ä¡
$query = "select * from ots_installation where barcode = '$barcode'";
$t = @mysql_fetch_object(@mysql_query($query));


$query = "select * from ots_product where barcode = '$barcode'";
$t2 = @mysql_fetch_object(@mysql_query($query));

//if($t2->uid != "") {
	echo "{
		'barcode' : '$barcode',
		'product_code' : '$t2->product_code',
		'product_name' : '$t2->product_name',
		'photo' : 'http://neblog.co.kr/testup/$t->photo',
		'current_cnt' : 70
		
	}";
//} else {
// echo "none";
//}
?>
