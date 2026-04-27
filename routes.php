<?
session_start();

extract($_POST);
extract($_GET);

function call($controller, $action) {

	require_once('controllers/' . $controller . '_controller.php');

	switch($controller) {
		// 환경설정
		case "config" :
			require_once ("models/config.php");
			$controller = new ConfigController();
		break;

		// 홈페이지
		case "pages" :
			require_once ("models/pages.php");
			$controller = new PagesController();
		break;

		// 홈페이지
		case "base" :
			require_once ("models/base.php");
			$controller = new BaseController();
		break;
		
		// 영업관리
		case "sales" :
			require_once ("models/sales.php");
			$controller = new SalesController();
		break;
		
		// 재고관리
		case "items" :
			require_once("models/items.php");
			$controller = new ItemsController();
		break;
		
		// 그룹웨어
		case "groupware" :
			require_once("models/groupware.php");
			$controller = new GroupwareController();
		break;
		
		// 인사/급여
		case "employee" :
			require_once("models/employee.php");
			$controller = new EmployeeController();
		break;
		
		// 생산관리
		case "production" :
			require_once("models/production.php");
			$controller = new ProductionController();
		break;

		// 구매관리
		case "purchase" :
			require_once("models/purchase.php");
			$controller = new PurchaseController();
		break;

		// 금형 관리
		case "facilities" :
			require_once("models/facilities.php");
			$controller = new FacilitiesController();
		break;

		// 금형 관리
		case "mold" :
			require_once("models/mold.php");
			$controller = new MoldController();
		break;

		// 회계1
		case "accounting" :
			require_once("models/accounting.php");
			$controller = new AccountingController();
		break;

		// 급여
		case "salary" :
			require_once("models/salary.php");
			$controller = new SalaryController();
		break;
	}

	$controller->{$action}();
}

$controllers = array(
	'config' => array (
		'inputPageConfig',
		'inputPageInfo',
		'registConfig',
		'registInfo',
		'dataBackup',
		'inputPageMenu',
		'registMenu'
	),
	'pages' => array (
		'home',
		'error',
		'login',
		'logout',
		'loging'
	),
	'base' => array (
		/* 품목관리 */
		'listPageItem',
		'inputPageItem',
		'registItem',
		'modifyPageItem',
		'updateItem',
		/* 거래처관리 */
		'listPageAccount',
		'inputPageAccount',
		'registAccount',
		'modifyPageAccount',
		'updateAccount',
		/* 부서관리 */
		'listPageDepartment',
		'registDepartment',
		
		'listPageDepartmentN',
		'registDepartmentN',

		/* 직위관리 */
		'listPagePosition',
		'inputPagePosition',
		'registPosition',
		'modifyPagePosition',
		'updatePosition',
		/* 사원관리 */
		'listPageEmployee',
		'inputPageEmployee',
		'registEmployee',
		'modifyPageEmployee',
		'updateEmployee',
		'registAuthority',
		/* 창고관리 */
		'listPageWarehouse',
		'inputPageWarehouse',
		'registWarehouse',
		'modifyPageWarehouse',
		'updateWarehouse',
		/* 공정관리 */
		'listPageProcess',
		'inputPageProcess',
		'registProcess',
		'modifyPageProcess',
		'updateProcess',
		/* 생산기기관리 */
		'listPageMachine',
		'inputPageMachine',
		'registMachine',
		'modifyPageMachine',
		'updateMachine',
		/* 프로젝트관리 */
		'listPageProject',
		'inputPageProject',
		'registProject',
		'modifyPageProject',
		'updateProject',
		/* 엑셀업로드 */
		'inputPageExcel',
		'registExcel',
		'insertExcel',
		'downloadPageExcel',
		/* 로트번호 관리 */
		'listLotNo',
		'registLotNo',
		'registLotNoInput',
		'modifyLotNo',
		'inputLotNo',
		'updateLotNo',
		'listLotNoPop',
		'listLotNoPop2',
		'listLotNoPop3',

		/* 규격 코드화 관리 */
		'listStandardCode',
		'registStandardCode',
		'modifyStandardCode',
		'inputStandardCode',
		'updateStandardCode',

		'listPageWarehousePop',//창고리스트 팝업
		'registSafetyStock', //안전재고 창고별 등록
		'inputItemSafetyStock',
		
		/* serial NO 관리 */
		'listPageSerialNo',
		'listPageSerialNoPop',
		'registPageSerialNo',
		'modifyPageSerialNo',
		'inputPageSerialNo',
		'updatePageSerialNo',

		/* 설비등록 */
		'listPageFacilities',
		'registPageFacilities',
		'modifyPageFacilities',
		'inputPageFacilities',
		'updatePageFacilities',

		'listPageDefectReason'//불량사유 관리
	),
	'sales' => array (
		'inputPageEstimate',
		'updatePageEstimate',
		'registPageEstimatePop',
		'modifyPageEstimatePop',
		'inputPageOrder',
		'updatePageOrder',
		'registPageOrderPop',
		'modifyPageOrderPop',
		'listPageOrder',
		'inputPageAccount',
		'registAccount',
		'listPageAccount',
		'modifyPageAccount',
		'updateAccount',
		'inputPageShipment',
		'registEstimate',
		'updateEstimate',
		'listPageEstimate',
		'modifyPageEstimate',
		'registEstimateItem',

		'registOrderItem',
		//'registPurchaseDemand',
		//'registPurchaseDemandItem',
		'listPageAs',
		'inputPageAs',
		'modifyPageAs',
		'registAs',
		'updateAs',
		'listPageOrderReport',
		'listPageOrderShipment',
		'inputPageOrderShipment',
		'updatePageOrderShipment',
		/* 미수금관리 */
		'listPageAccountReceivable',
		'listPageSalesPlan',
		'inputPageSalesPlan',
		'modifyPageSalesPlan',
		'registPageOrderShipment',
		'modifyPageOrderShipment',
		'registPageOrderShipmentPop',
		'modifyPageOrderShipmentPop',  //출하지지서
		'viewPageOrderShipment'  //출하지지서
	),
	'items' => array (
		'listPageWarehouse',
		'inputPageWarehouse',
		'registWarehouse',
		'inputPageItem',
		'modifyPageWarehouse',
		'updateWarehouse',
		'registItem',
		'registStock',
		'modifyPageItem',
		'updateItem',
		'listPageItem',
		'listPageStock',
		'listPageSafetyStock',
		'listPageWarehouseStock',
		'listPageStockPrice',
		'listPageRealStock',
		'listPageBarcode',
		'inputPageBarcode',
		'updateBarcode',
		/* 출고관리 */
		'listPageRelease',
		'modifyPageRelease',
		'listPageWarehouseRelease',
		/*자재수불부*/
		'listPageItemInout',
		'listPageBarcodeReleaseItem',
		/* 로트넘버 추적 */
		'listPageLotNo',
		'viewPageLotNo',
		/* 금형관리 */
		'listPageMold',
		'inputPageMold',
		'listPageScrap',
		'listPageStockInoutPop',
		'listPageReleaseRequest',
		'registPageReleaseRequestPop',
		'modifyPageReleaseRequestPop',
		'inputReleaseRequest',
		'inputReleaseRequestItem',
		'updateReleaseRequest',
		'updateReleaseRequestItem',
		'releaseRequestPrint',
		'listWarehousePop',
		'registPageReleaseItemBarcodeOut',//바코드 출고리스트
		'outReleaseRequestBarcodeOut',//바코드 출고등록
		'inputReleaseRequestBarcodeOut'
	),
	'groupware' => array (
		'inputPageEleSettlement',
		'inputPageProject',
		'registProject',
		'listPageProject',
		'registProjectAttach',
		'inputPageEleSettlementLine',
		'registEleSettlementLine',
		'registEleSettlementEmp',
		'listPageEleSettlementLine',
		'registApproval',
		'listPageEleSettlement',
		'registEleSettlement',
		'modifyPageEleSettlement',
		'listPageMyEleSettlement',
		'inputPageMachine',
		'registMachine',
		'listPageMachine',
		'inputPageFile',
		'registFile',
		'listPageFile',
		'listPageBoard',
		'inputPageBoard',
		'registBoard',
		'listPagePublicThing',
		'inputPagePublicThing',
		'registPublicThing',
		'listPageCar',
		'inputPageCar',
		'registCar',
		'modifyPageCar',
		'modifyPageProject',
		'download',
		'updateProject',
		'inputPageCrm',
		'listPageCrm',
		'modifyPageCrm',
		'registCustomer',
		'updateCustomer',
		'registCounsel',
		'listPageScheduleMonth',
		'listPageScheduleWeek',
		'listPageScheduleDay',
		'inputPageSchedule',
		'modifyPageSchedule',
		'registSchedule',
		'listPageSchedule',
		'listPageEmpWorkLeave',
		'listPageInstallation',
		'inputPageInstallation',
		'registInstallation',
		'listPageVersion',
		'inputPageVersion',
		'registVersion',
		'listPageError',
		'inputPageError',
		'registError'
	),
	'employee' => array (
		'inputPageEmployee',
		'registEmployee',
		'listPageDepartment',
		'inputPageDepartment',
		'registDepartment',
		'modifyPageDepartment',
		'updateDepartment',
		'listPagePosition',
		'inputPagePosition',
		'registPosition',
		'modifyPagePosition',
		'updatePosition',
		'listPageEmployee',
		'modifyPageEmployee',
		'updateEmployee',
		'inputPageDailyWorker',
		'registDailyWorker',
		'modifyPageDailyWorker',
		'updateDailyWorker',
		'listPageDailyWorker'
	),
	'production' => array (
		'inputPageProcess',
		'listPageProcess',
		'modifyPageProcess',
		'registProcess',
		'updateProcess',
		'listPageBom',
		'inputPageBom',
		'registBom',
		'modifyPageBom',
		'listPageWorkPlan',
		'inputPageWork',
		'listPageWorkOrder',
		'registPageWorkOrderPop',
		'modifyPageWorkOrderPop',
		'inputPageWorkOrder',
		'updatePageWorkOrder',
		'registPageWorkPlan',
		'modifyPageWorkPlan',
		'registWorkPlan',
		'registWorkPlanItem',
		'listPageWork',
		'registWork',
		'inputWork',
		'updateWork',
		'updateWorkItem',
		'listPageQc',
		'listPageDefective',
		'updateWorkPlan',
		'registWorkItem',
		'calBom',
		'listPageWorkPlanBom',
		'viewPageWorkPlanBom',
		'inputPageOutsourcing',
		'listPageProductionPrice',
		'listProductPerfReports',   //테성 솔루텍 실적관리
		'registProductPerfReports', //테성 솔루텍 실적관리
		'registProductPerfReportsInsert',
		'registProductPerfReportsUpdate',
		'modifyProductPerfReports',
		'productPerfReportsInsert',
		'productPerfReportsUpdate',
		'getProductPerfReports',
		'productPerfReportsLotNoInsert',
		'productPerfReportsPrint',
		'viewPageproductPerfReports',

		//생산실적관리 (도금)
		'listProductPerfPlate',
		'registProductPerfPlate',
		'inputPagePlate',
		'modifyProductPerfPlate',
		

		//세척 생산 실적 등록
		'listPagePPReportsClean',
		'registPagePPReportsClean',
		'modifyPagePPReportsClean',
		'inputPagePPReportsClean',
		'updatePagePPReportsClean',

		//포장 생산 실적 등록
		'listPagePPReportsPacking',
		'registPagePPReportsPacking',
		'modifyPagePPReportsPacking',
		'inputPagePPReportsPacking',
		'updatePagePPReportsPacking',

		'listLotNoManagementLedger',
		'listLotNoManagementReport',
		'modifyPageWork',
		'listLotNoItem',
		'listLotNoItem2',	   //원자재 출고후 투입대기
		'listPageProductOutput',   //테성 솔루텍 개인별 담당 실적관리
		'registpageProductOutput',
		'modifypageProductOutput',
		'inputProductOutput',
		'inputProductOutputItem',
		'updateProductOutput',
		'updateProductOutputItem',
		'listPagegWorkOrder',
		
		//공정이동표출력
		'listPagePPReportsPrint',
		'registPagePPReportsPrint',
		'modifyPagePPReportsPrint',
		'viewPagePPReportsPrint',
		'inputPagePPReportsPrint',
		'updatePagePPReportsPrint',

		'registPageWorkPlanPop',
		'modifyPageWorkPlanPop',
		'inputPageWorkPlan',
		'updatePageWorkPlan',

		//생산입고
		'listPageProductionWearing',
		'registPageProductionWearing',
		'modifyPageProductionWearing',
		'inputPageProductionWearing',
		'updatePageProductionWearing',
		
		 
		//작업일보
		'listPageWorkDailyReport',
		'registPageWorkDailyReportPop',
		'modifyPageWorkDailyReportPop',
		'inputPageWorkDailyReport',
		'updatePageWorkDailyReport',

		//생산입고
		'listPageProductionInto',
		'registPageProductionIntoPop',
		'modifyPageProductionIntoPop',
		'inputPageProductionInto',
		'updatePageProductionInto'

	),
	'purchase' => array (
		'listPagePurchaseDemand',
		'inputPagePurchaseDemand',
		'registPurchaseDemand',
		'registPurchaseDemandItem',
		'modifyPagePurchaseDemand',
		'viewPagePurchaseDemand',
		'listPagePurchase',
		'listPagePurchaseItem',
		'listPagePurchasePlan',
		'inputPagePurchasePlan',
		'modifyPagePurchasePlan',
		'updatePurchaseDemand',
		'listPageBarcodePurchaseItem',
		'registPagePurchaseItemBarcodeIn', //구매입고
		'inputWarehousingItemBarcodeIn',
		/* 미지급금 */
		'listPageAccountPavable',

		/*발주서 NEW*/
		'listPurchaseOrder',
		'listPurchaseOrderItem',
		'registPurchaseOrderItem',
		'modifyPurchaseOrderItem',
		'registPagePurchaseOrderPop',
		'modifyPagePurchaseOrderPop',
		'inputPurchaseOrderItem',
		'updatePurchaseOrderItem',

		/*구매입고*/
		'listWarehousingItem',
		'registWarehousingItem',
		'modifyWarehousingItem',
		'registPageWarehousingPop',
		'modifyPageWarehousingPop',
		'inputWarehousingItem',
		'updateWarehousingItem',
		'registPagePurchaseDemandPop',
		'modifyPagePurchaseDemandPop',
		'viewPageWarehousingItem'
	),
	'facilities' => array (						
		'listPageFacilityManagement',
		'registPageFacilityManagement',
		'modifyPageFacilityManagement',
		'insertPageFacilityManagement',
		'updatePageFacilityManagement'
	),
	'mold' => array (		//금형관리				
		//금형등록
		'listPageMold',   //금형현황
		'iframePageMold',
		'viewPageMold',
		'registPageMold',
		'modifyPageMold',
		'insertPageMold',
		'updatePageMold',
		'registPageMoldItem',//금형부품등록
		'insertPageMoldItem',//금형부품등록
		'registPageMoldFile',//금형파일등록
		'insertPageMoldFile',//금형파일등록
		
		//금형 점검·수리이력
		'listPageMoldRepair',
		'registPageMoldRepair',
		'modifyPageMoldRepair',
		'insertPageMoldRepair',
		'updatePageMoldRepair',

		//금형타수관리
		'ViewPageMoldHits',
		'registPageMoldHits',
		'modifyPageMoldHits',
		'insertPageMoldHits',
		'updatePageMoldHits'

	),
	'accounting' => array (
		'inputPageAccounting',
		'listPageDepartment',
		'inputPageDepartment',
		'registDepartment',
		'modifyPageDepartment',
		'listPageAccountingCode',
		'listPageAccountingCodeTree',
		'listPageAccountingCodePop',
		'inputPageAccountingCode',
		'registAccountingCode',
		'registAccountingCodePop',
		'accountingCodeInsert',
		'accountingCodeUpdate',
		'modifyAccountingCodePop',
		'listAccountingCodeRemarkPop',
		'modifyAccountingCodeRemarkPop',
		'registAccountingCodeRemarkPop',
		'accountingCodeRemarkInsert',
		'accountingCodeRemarkUpdate',
		'listAccountingCodeSearchPop',
		'creditcard_regist',
		'registCreditCardPop',
		'registCreditCardInsert',
		'modifyCreditCardPop',
		'bank_regist',
		'registBankPop',
		'registBankInsert',
		'modifyBankPop',
		'registPrintApproval', 
		'registPrintAppLineInsert',
		'registPrintAppLineUpdate',
		'printAppLineInsert',
		'registCardCompanyInsert',
		'registCardCompanyUpdate',
		'cardCompany_regist',
		'registCardCompanyPop',
		'listGeneralStatement',            //일반전표
		'registGeneralStatementPop',
		'listSalesStatement',              //매출전표
		'registSalesStatementPop',
		'listPurchaseStatement',           //매입전표
		'registPurchaseStatementPop',
		'registGeneralStatementInsert',
		'registSalesStatementInsert',
		'registPurchaseStatementInsert',
		'registGeneralStatementUpdate',
		'registSalesStatementUpdate',
		'registPurchaseStatementUpdate',
		'registStatement',
		'registStatementItem',
		'modifyGeneralStatementPop',   //일반전표
		'modifySalesStatementPop',     //매출전표
		'modifyPurchaseStatementPop',  //매입전표 
		'purchaseSalesStatementPop',
		'printGeneralstatement',
		'printSalesstatement',
		'printPurchasestatement',
		'StatementChaMax',
		'StatementChaMaxNum',
		'getGeneralStatement',
		'getSalesStatement',
		'getPurchaseStatement',
		'registPartReg',                   //회사정보 및 회계 년도//
		'registTaxInvoicePop',
		'modifyTaxInvoicePop',
		'registTaxInvoiceInsert',
		'registTaxInvoiceUpdate',
		'getTaxInvoice',
		'registDepositReport',
		'registDepositReportInsert',
		'registDepositReportUpdate',
		'registCustomerDeposit',
		'registCustomerDepositInsert',
		'registCustomerDepositUpdate',
		'registSpendingResolution',
		'registSpendingResolutionInsert',
		'registSpendingResolutionUpdate',
		'registPurchaseDeposit',
		'registPurchaseDepositInsert',
		'registPurchaseDepositUpdate',
		'modifyDepositReportPop',
		'modifyCustomerDepositPop',
		'modifySpendingResolutionPop',
		'modifyPurchaseDepositPop',
		'registGeneralReceipts',
		'registGeneralReceiptsInsert',
		'registGeneralReceiptsUpdate',
		'registCardSalesSlips',
		'registCardSalesSlipsInsert',
		'registCardSalesSlipsUpdate',
		'registSettleAccPrepayments',
		'registSettleAccPrepaymentsInsert',
		'registSettleAccPrepaymentsUpdate',
		'listDressingSettlement',
		'registDressingSettlement',
		'registDressingSettlementInsert',
		'registDressingSettlementUpdate',
		'registEtcDeposit',
		'registEtcDepositInsert',
		'registEtcDepositUpdate',
		'listFixedAssets',
		'registFixedAssets',
		'registFixedAssetsInsert',
		'registFixedAssetsUpdate',
		'listFixedAssetsStatement',
		'registFixedAssetsStatementPop',
		'modifyFixedAssetsStatementPop',
		'registFixedAssetsStatementInsert',
		'registFixedAssetsStatementUpdate',
		'listFixedAssetsCode',
		'registFixedAssetsCodePop',
		'registFixedAssetsCodePopInsert',
		'registFixedAssetsCodePopUpdate',
		'modifyFixedAssetsCodePop',
		'listFixedAssetsType',
		'registFixedAssetsTypePop',
		'registFixedAssetsTypePopInsert',
		'registFixedAssetsTypePopUpdate',
		'modifyFixedAssetsTypePop',
		'registFixedAssetsIncrement',
		'registFixedAssetsIncrementInsert',
		'registFixedAssetsIncrementUpdate',
		'registFixedAssetsDecrease',
		'registFixedAssetsDecreaseInsert',
		'registFixedAssetsDecreaseUpdate',
		'registDepreciationCost',  //감가상각비 등록

		'listAccountingSearch',
		'listAccountingPrint',
		
		//출력물 관리
		'listGeneralLedgerAccount',		//계정별 원장
		'listCustomerAccountLedger',	//거래처별원장
		'listPurchaseSalesLedger',		//매입 매출장
		'listCashBook',					//현금 출납장
		'listJournal',					//분개장
		'listDailyMonthlyAccount',		//일/월계표
		'listTransactionalBillTable',	//거래처별 거래내역

		'listCompoundTrialBalance',			//합계잔액시산표
		'listStatementFinancialPosition',	//재무상태표
		'listIncomeStatement',				//손익계산서
		'listCostSpecification',			//원가명세서
		'listFundsJournal',					//자금일보
		'listAccountStatement',	                //계정명세서
		'listCostBenefitAnalysis',			//월별손익분석
		'viewCostBenefitAnalysis',
		'listCostAnalysis'					//월별원가분석

	),
	'salary' => array (						
		'registSalaryItme',					//수당항목등록 
		'registSalaryItmeInsert',
		'registSalaryItmeUpdate',

		'registDeclarationItem',            //공재항목
		'registDeclarationItmeInsert',
		'registDeclarationItmeUpdate',

		'listPayCheck',						//급여계산
		'registPayCheckPop',				//급여계산		
		'modifyPayCheckPop',
		'registPayCheckInsert',
		'registPayCheckUpdate',
		'listPayMemberPop',
		'registPayMemberPop',
		'registPayMemberInsert',
		'registPayMemberUpdate',
		'modifyPayMember',

		'listPayrollBook',					//급여대장
		'listPrintPaySlip',						//급여명세서 인쇄
		'paySlipHistoryTable',              //급여내역 상세
		'salaryItmeInsert'

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