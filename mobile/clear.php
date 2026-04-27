<?
session_start();
include "connection2.php";

$table = array();
array_push($table, "orders");
array_push($table, "orders_item");
array_push($table, "order_waiting");
array_push($table, "purchase");
//array_push($table, "bringin_material");
//array_push($table, "in_item");
//array_push($table, "item_account");
//array_push($table, "item_cost");
//array_push($table, "item_process");
//array_push($table, "outsourcing_item");
array_push($table, "work");
array_push($table, "estimate");
array_push($table, "estimate_item");
array_push($table, "qc");
array_push($table, "work_station");
array_push($table, "work_down");
array_push($table, "in_out");
array_push($table, "work_initem");
array_push($table, "lot_no");
array_push($table, "orders_item");
array_push($table, "orders");
array_push($table, "obtain_order");
array_push($table, "after_service");
array_push($table, "obtain_order_item");
array_push($table, "releases");
array_push($table, "safety_stock");
array_push($table, "lot_no_process");
array_push($table, "real_input_item");
array_push($table, "faulty");
array_push($table, "shipment");
array_push($table, "schedule");
array_push($table, "releases_warehouse");
array_push($table, "outsourcing_request");
array_push($table, "temp_item_process");
array_push($table, "temp_in_item");
array_push($table, "work_daily");
array_push($table, "work_daily_item");
array_push($table, "payable");
array_push($table, "payable_item");
array_push($table, "receivables");
array_push($table, "receivables_item");
//array_push($table, "outsourcing_item");

$sql = "select * from warehouse";
$result = mysql_query($sql);
while($t = mysql_fetch_object($result)){
	$warehouse = "warehouse_".$t->uid;
	array_push($table, $warehouse);
}


$sql = "select * from account where outsourcing='y'";
$result = mysql_query($sql);
while($t = @mysql_fetch_object($result)){
	$warehouse = "account_warehouse_".$t->uid;
	array_push($table, $warehouse);
}

$sql = "select * from process";
$result = mysql_query($sql);
while($t = @mysql_fetch_object($result)){
	$warehouse = "process_warehouse_".$t->uid;
	array_push($table, $warehouse);
}

for($i = 0 ; $i < sizeof($table) ; $i++) {
	$sql = "TRUNCATE TABLE ".$table[$i];
	@mysql_query($sql) or die (mysql_error());
}

header("Location:index.php");
?>