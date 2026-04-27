<?
// 작업지시서 & 구매요청서 요청
mysql_connect("localhost","neblog","since1970","neblog") or die ("Connect Error");
mysql_select_db("neblog");

$json_data = $_POST['jsondata'];
$array = json_decode($json_data, true);

foreach($array as $key => $value) {
	switch($key) {
		case "mode" : 
			switch($value) {
				case "in" :
					$query = "select pu_idx,prod_no from porder";
					$result = mysql_query($query);
					while($t = mysql_fetch_object($result)) {
						$arr .= "{'pu_idx' : '$t->pu_idx', 'prod_no' : '$t->prod_no'},";
					}

					echo $arr;
				break;

				case "out" :
					$query = "select num,ord_no from work_orders";
					$result = mysql_query($qurey);
					while($t = mysql_fetch_object($result)) {
						$arr .= "{'num' : '$t->num', 'ord_no' : '$t->ord_no'},";
					}

					echo $arr;
				break;
			}
		break;

		default : echo "error" ; break;
	}
}
?>