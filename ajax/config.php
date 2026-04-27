<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

#--------------------------------------------------------------------------------------------
//테이블 검사 (db에 해당 테이블이 생성 되어있나 확인한다. 없다면 false 반환
#--------------------------------------------------------------------------------------------
function isTable($str,$dbname){
	$result=mysql_list_tables($dbname) or die (mysql_error());
	$i=0;
	
	$arr = array();

	while ($i < mysql_num_rows($result)) {
		if($str==mysql_tablename ($result, $i)) array_push($arr,"true");
		else array_push($arr,"false");
		$i++;
	}

	//var_dump($arr);
	if(in_array("true",$arr)) return true;
	else return false;
}

switch($mode) {
	// 데이터 백업
	case "backup" :
		$table = array();
		array_push($table, "erp_account");
		array_push($table, "erp_admin");
		array_push($table, "erp_approval");
		array_push($table, "erp_approval_check");
		array_push($table, "erp_as");
		array_push($table, "erp_authority");
		array_push($table, "erp_board");
		array_push($table, "erp_bom");
		array_push($table, "erp_car");
		array_push($table, "erp_car_accident");
		array_push($table, "erp_car_drive");
		array_push($table, "erp_car_service");
		array_push($table, "erp_config");
		array_push($table, "erp_counsel");
		array_push($table, "erp_customer");
		array_push($table, "erp_daily_worker");
		array_push($table, "erp_defective");
		array_push($table, "erp_department_big");
		array_push($table, "erp_department_middle");
		array_push($table, "erp_department_small");
		array_push($table, "erp_ele_settlement_emp");
		array_push($table, "erp_ele_settlement_line");
		array_push($table, "erp_employee");
		array_push($table, "erp_estimate");
		array_push($table, "erp_estimate_item");
		array_push($table, "erp_error");
		array_push($table, "erp_file");
		array_push($table, "erp_info");
		array_push($table, "erp_installation");
		array_push($table, "erp_item");
		array_push($table, "erp_item_group");
		array_push($table, "erp_machine");
		array_push($table, "erp_menu");
		array_push($table, "erp_order");
		array_push($table, "erp_order_item");
		array_push($table, "erp_position");
		array_push($table, "erp_process");
		array_push($table, "erp_project");
		array_push($table, "erp_project_attach");
		array_push($table, "erp_public_thing");
		array_push($table, "erp_purchase");
		array_push($table, "erp_purchase_demand");
		array_push($table, "erp_purchase_demand_item");
		array_push($table, "erp_qc");
		array_push($table, "erp_reason");
		array_push($table, "erp_release");
		array_push($table, "erp_schedule");
		array_push($table, "erp_standard");
		array_push($table, "erp_stock");
		array_push($table, "erp_stock_inout");
		array_push($table, "erp_version");
		array_push($table, "erp_warehouse");
		array_push($table, "erp_warehouse_release");
		array_push($table, "erp_work");
		array_push($table, "erp_workplan");
		array_push($table, "erp_workplan_item");
		array_push($table, "erp_work_item");
		array_push($table, "erp_work_leave");

		for($i = 0 ; $i < sizeof($table) ; $i++) {		
			$tb = "back_".$table[$i];

			if(!isTable($tb,"jebul")) {
				$sql = "create table back_".$table[$i]." select * from ".$table[$i];
			} else {
				$sql = "TRUNCATE TABLE back_".$table[$i];
				mysql_query($sql) or die (mysql_error());
				$sql = "insert into back_".$table[$i]." select * from ".$table[$i];
			}
			//echo $sql;
			mysql_query($sql) or die (mysql_error());
		}

		echo "success";
	break;
	
	// 데이터 복원
	case "restore" :
		$table = array();
		array_push($table, "erp_account");
		array_push($table, "erp_admin");
		array_push($table, "erp_approval");
		array_push($table, "erp_approval_check");
		array_push($table, "erp_as");
		array_push($table, "erp_authority");
		array_push($table, "erp_board");
		array_push($table, "erp_bom");
		array_push($table, "erp_car");
		array_push($table, "erp_car_accident");
		array_push($table, "erp_car_drive");
		array_push($table, "erp_car_service");
		array_push($table, "erp_config");
		array_push($table, "erp_counsel");
		array_push($table, "erp_customer");
		array_push($table, "erp_daily_worker");
		array_push($table, "erp_defective");
		array_push($table, "erp_department_big");
		array_push($table, "erp_department_middle");
		array_push($table, "erp_department_small");
		array_push($table, "erp_ele_settlement_emp");
		array_push($table, "erp_ele_settlement_line");
		array_push($table, "erp_employee");
		array_push($table, "erp_estimate");
		array_push($table, "erp_estimate_item");
		array_push($table, "erp_error");
		array_push($table, "erp_file");
		array_push($table, "erp_info");
		array_push($table, "erp_installation");
		array_push($table, "erp_item");
		array_push($table, "erp_item_group");
		array_push($table, "erp_machine");
		array_push($table, "erp_menu");
		array_push($table, "erp_order");
		array_push($table, "erp_order_item");
		array_push($table, "erp_position");
		array_push($table, "erp_process");
		array_push($table, "erp_project");
		array_push($table, "erp_project_attach");
		array_push($table, "erp_public_thing");
		array_push($table, "erp_purchase");
		array_push($table, "erp_purchase_demand");
		array_push($table, "erp_purchase_demand_item");
		array_push($table, "erp_qc");
		array_push($table, "erp_reason");
		array_push($table, "erp_release");
		array_push($table, "erp_schedule");
		array_push($table, "erp_standard");
		array_push($table, "erp_stock");
		array_push($table, "erp_stock_inout");
		array_push($table, "erp_version");
		array_push($table, "erp_warehouse");
		array_push($table, "erp_warehouse_release");
		array_push($table, "erp_work");
		array_push($table, "erp_workplan");
		array_push($table, "erp_workplan_item");
		array_push($table, "erp_work_item");
		array_push($table, "erp_work_leave");

		for($i = 0 ; $i < sizeof($table) ; $i++) {
			$sql = "TRUNCATE TABLE ".$table[$i];
			mysql_query($sql) or die (mysql_error());
			$sql = "insert into ".$table[$i]." select * from back_".$table[$i];
			mysql_query($sql) or die (mysql_error());
		}

		echo "success";
	break;
}
?>