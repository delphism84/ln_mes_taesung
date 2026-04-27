<?
session_start();

extract($_POST);
extract($_GET);

require_once("controllers/erp_controller.php");

function call($controller, $action) {
	require_once("controllers/override_controller.php");

	$override = new OverrideController;
	$override->{$action}();
}

$controllers = array(
	'config' => array (
		'inputPageConfig',
		'inputPageInfo',
		'registConfig',
		'registInfo',
		'dataBackup',
		'inputPageMenu',
		'registMenu',
		'frmInitialization',
		'frmConfig',
		'frmMenuSetting'
	),
	'pages' => array (
		'home',
		'error',
		'login',
		'logout',
		'loging'
	),
	'base' => array (
		'frmItemProcess',
		'frmItem',
		'frmEmployee',
		'frmProject',
		'frmItemBuyer',
		'frmItemCost',
		'frmItemClassify',
		'frmItemGroup',
		'frmAccountClassify',
		'frmAccount',
		'frmDepartment',
		'frmPosition',
		'frmWarehouse',
		'frmProcess',
		'frmMachine',
		'frmTeam',
		'frmRentcar',
		'frmRentcarCost',
		'frmExcel'
	),
	'sales' => array (
		'frmEstimate',
		'frmObtainOrder',
		'frmObtainOrderShipment',
		'frmAs'
	),
	'production' => array (
		'frmProductSchedule',
		'frmWorkPlan',
		'frmWorkOrder',
		'frmWorkDaily',
		'frmWorkPlanWeek',
		'frmWorkCurrentState',
		'frmWorkProductDaily',
		'frmWorkProductDailyRegist',
		'frmMonthProductState'
	),
	'qc' => array (
		'frmQc',
		'frmFaultyReason',
		'frmQcClassify',
		'frmFaultyType',
		'frmFaultyChart',
		'frmFaultyStatus'
	),
	'purchase' => array (
		'registBarcodePuchaseItem',
		'frmPurchase',
		'frmOrder',
		'frmWarehousing',
		'frmEasyPurchase'
	),
	'release' => array(
		'frmRelease',
		'frmInOut',
		'frmShipmentOrder'
	),
	'items' => array (
		'frmWarehouseStock',
		'frmSafetyStock',
		'frmCurrentStock',
		'frmBarcode',
		'frmProcessStock',
		'frmStock',
		'frmReleaseWarehouse'
	),
	'groupware' => array (
		'frmBoard',
		'frmFile',
		'frmAccountSubject',
		'frmSchedule',
		'frmSpendingResolution',
		'frmApprovalLine',
		'frmMyApproval',
		'frmApproval',
		'frmApprovalDocument',
		'frmRegistApproval',
		'frmModifyApproval',
		'frmViewApproval',
		'frmManInOut'
	),
	'outsourcing' => array (
		'frmOutsourcing',
		'frmOutsourcingItem',
		'frmBringinMaterial',
		'frmBringinMaterialPurchase',
		'frmBringinMaterialRelease',
		'frmOutsourcingItemPurchase',
		'frmOutsourcingWarehouse',
		'frmOutsourcingRequest'
	),
	'accounting' => array(
		'frmAccountPurchase',
		'frmItemOrder',
		'frmPeriodOrder',
		'frmOrderProcess',
		'frmAccountOrder',
		'frmPeriodPurchase',
		'frmPurchaseProcess',
		'frmAccountPurchaseChart',
		'frmItemDetailIn',

		'frmTransaction',
		'frmAccountSales',
		'frmItemSales',
		'frmPeriodSales',
		'frmAccountSalesChart',
		'frmSalesChart',
		'frmReceivables',
		'frmPayable'
	),
	'wage' => array(
		'frmWage',
		'frmDayLabor',
		'frmCommute'
	),
	'client' => array(
		'registPageMold',
		'listPageMoldRepair',
		'registPageMoldHits'
	)
);

if (array_key_exists($controller, $controllers)) {
	if (in_array($action, $controllers[$controller])) {
		if($_SESSION['login_id'] == "") call('pages', 'login');
		call($controller, $action);
	} else {
		if($_SESSION['login_id'] != "") call('pages', 'home');
		else call('pages', 'login');
	}
} else {
	call('pages', 'error');
}
?>