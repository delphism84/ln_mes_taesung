<?
session_start();

require_once('connection.php');
require_once('library/function.php');

mysql_query("truncate table erp_order");
mysql_query("truncate table erp_order_item");
mysql_query("truncate table erp_stock");
mysql_query("truncate table erp_stock_inout");
mysql_query("truncate table erp_bom");
mysql_query("truncate table erp_estimate");
mysql_query("truncate table erp_estimate_item");
mysql_query("truncate table erp_purchase");
mysql_query("truncate table erp_purchase_demand");
mysql_query("truncate table erp_purchase_demand_item");
mysql_query("truncate table erp_qc");
mysql_query("truncate table erp_project");
mysql_query("truncate table erp_release");
mysql_query("truncate table erp_work");
mysql_query("truncate table erp_workplan");
mysql_query("truncate table erp_workplan_item");
mysql_query("truncate table erp_work_item");
mysql_query("truncate table erp_item");
mysql_query("truncate table erp_reason");
mysql_query("truncate table erp_defective");
mysql_query("truncate table erp_approval");
mysql_query("truncate table erp_approval_check");

header("Location:index.php");
?>