<?
require_once("controllers/functions_controller.php");

class ErpController extends Functions {
	
	private $now;

	public function __construct() {
		$this->now = date("Y-m-d H:i:s");

		require_once('include/db_define.php');
		$this->Mysql_DB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	}
	
	public function __destruct()
	{

	}
	
	public function __get($name)
	{
		return $this->$name;
	}
    
	public function __set($name, $value)
	{
		$this->$name = $value;
	}
/************************************************************************************************************************************************************************************************
:: 대쉬보드
*************************************************************************************************************************************************************************************************/
	// 대쉬보드
	public function home(){
		require_once ('views/pages/home.php');
	}
	
	// 에러페이지
	public function error(){
		require_once ("views/pages/error.php");
	}
/******************************************************************************************************
:: 환경설정
******************************************************************************************************/		
	// 사원등록 페이지
	public function inputPageConfig() {
		$t = Dba::get("1","config");
		require_once ("views/config/erp_createConfig.php");
	}

	public function inputPageInfo() {
		$t = Dba::get(1,"info");
		require_once ("views/config/erp_createInfor.php");
	}

	
	

	// 사원등록 실행
	public function registInfo(){
		$sql = "select * from erp_info";
		$this->query($sql);
		$corp = $this->fetch();

		$fileAttach = $this->upload('sign');
		if($fileAttach == "none") {
			$fileAttach = $corp->sign;
		}

		if($corp->corp_nm != "") {
			$data = array(
				"table" => "erp_info",
				"where" => "uid=1",
				"corp_nm" => $_POST['corp_nm'],
				"business_no" => $_POST['business_no'],
				"owner" => $_POST['owner'],
				"telephone" => $_POST['telephone'],
				"fax" => $_POST['fax'],
				"address" => $_POST['address'],
				"corp_type" => $_POST['corp_type'],
				"corp_event" => $_POST['corp_event'],
				"sign" => $fileAttach,
				"admin" => $_POST['admin']
			);
			$result = $this->update($data);
		} else {
			$data = array(
				"table" => "erp_info",
				"corp_nm" => $_POST['corp_nm'],
				"corp_nm" => $_POST['corp_nm'],
				"business_no" => $_POST['business_no'],
				"owner" => $_POST['owner'],
				"telephone" => $_POST['telephone'],
				"fax" => $_POST['fax'],
				"address" => $_POST['address'],
				"corp_type" => $_POST['corp_type'],
				"corp_event" => $_POST['corp_event'],
				"sign" => $fileAttach,
				"admin" => $_POST['admin']
			);	
			$result = $this->insert($data);
		}

		$this->movePage("config","inputPageInfo");
	}

	public function dataBackup() {
		require_once ("views/config/erp_dataBackup.php");
	}

	public function inputPageMenu() {
		$t = Dba::get(1,"menu");
		require_once ("views/config/erp_createMenu.php");
	}

	public function registMenu(){
		$config = new Config;
		if($_POST['uid'] != "") {
			$data = array (
				"table" => "erp_menu",
				"where" => "uid=".$_POST['uid'],
				"item_menu" => $_POST['item_menu'],
				"account_menu" => $_POST['account_menu'],
				"department_menu" => $_POST['department_menu'],
				"position_menu" => $_POST['position_menu'],
				"employee_menu" => $_POST['employee_menu'],
				"warehouse_menu" => $_POST['warehouse_menu'],
				"process_menu" => $_POST['process_menu'],
				"machine_menu" => $_POST['machine_menu'],
				"project_menu" => $_POST['project_menu'],
				"excel_menu" => $_POST['excel_menu'],
				"trade_menu" => $_POST['trade_menu'],
				"estimate_menu" => $_POST['estimate_menu'],
				"order_menu" => $_POST['order_menu'],
				"shipment_menu" => $_POST['shipment_menu'],
				"as_menu" => $_POST['as_menu'],
				"receive_menu" => $_POST['receive_menu'],
				"sale_plan_menu" => $_POST['sale_plan_menu'],
				"demand_menu" => $_POST['demand_menu'],
				"purchase_plan_menu" => $_POST['purchase_plan_menu'],
				"purchase_menu" => $_POST['purchase_menu'],
				"purchase_item_menu" => $_POST['purchase_item_menu'],
				"amount_menu" => $_POST['amount_menu'],
				"bom_menu" => $_POST['bom_menu'],
				"bom_cal_menu" => $_POST['bom_cal_menu'],
				"outsourcing_menu" => $_POST['outsourcing_menu'],
				"workplan_menu" => $_POST['workplan_menu'],
				"workplan_bom_menu" => $_POST['workplan_bom_menu'],
				"work_menu" => $_POST['work_menu'],
				"qc_menu" => $_POST['qc_menu'],
				"defective_menu" => $_POST['defective_menu'],
				"warehouse_stock_menu" => $_POST['warehouse_stock_menu'],
				"price_menu" => $_POST['price_menu'],
				"stock_menu" => $_POST['stock_menu'],
				"release_menu" => $_POST['release_menu'],
				"barcode_menu" => $_POST['barcode_menu'],
				"real_stock_menu" => $_POST['real_stock_menu'],
				"safety_menu" => $_POST['safety_menu'],
				"ele_menu" => $_POST['ele_menu'],
				"crm_menu" => $_POST['crm_menu'],
				"board_menu" => $_POST['board_menu'],
				"schedule_menu" => $_POST['schedule_menu'],
				"leave_menu" => $_POST['leave_menu'],
				"file_menu" => $_POST['file_menu'],
				"goods_menu" => $_POST['goods_menu'],
				"car_menu" => $_POST['car_menu'],
				"installation_menu" => $_POST['installation_menu']
			);
			$config->update($data);
		} else {
			$data = array (
				"table" => "erp_menu",
				"item_menu" => $_POST['item_menu'],
				"account_menu" => $_POST['account_menu'],
				"department_menu" => $_POST['department_menu'],
				"position_menu" => $_POST['position_menu'],
				"employee_menu" => $_POST['employee_menu'],
				"warehouse_menu" => $_POST['warehouse_menu'],
				"process_menu" => $_POST['process_menu'],
				"machine_menu" => $_POST['machine_menu'],
				"project_menu" => $_POST['project_menu'],
				"excel_menu" => $_POST['excel_menu'],
				"trade_menu" => $_POST['trade_menu'],
				"estimate_menu" => $_POST['estimate_menu'],
				"order_menu" => $_POST['order_menu'],
				"shipment_menu" => $_POST['shipment_menu'],
				"as_menu" => $_POST['as_menu'],
				"receive_menu" => $_POST['receive_menu'],
				"sale_plan_menu" => $_POST['sale_plan_menu'],
				"demand_menu" => $_POST['demand_menu'],
				"purchase_plan_menu" => $_POST['purchase_plan_menu'],
				"purchase_menu" => $_POST['purchase_menu'],
				"purchase_item_menu" => $_POST['purchase_item_menu'],
				"amount_menu" => $_POST['amount_menu'],
				"bom_menu" => $_POST['bom_menu'],
				"bom_cal_menu" => $_POST['bom_cal_menu'],
				"outsourcing_menu" => $_POST['outsourcing_menu'],
				"workplan_menu" => $_POST['workplan_menu'],
				"workplan_bom_menu" => $_POST['workplan_bom_menu'],
				"work_menu" => $_POST['work_menu'],
				"qc_menu" => $_POST['qc_menu'],
				"defective_menu" => $_POST['defective_menu'],
				"warehouse_stock_menu" => $_POST['warehouse_stock_menu'],
				"price_menu" => $_POST['price_menu'],
				"stock_menu" => $_POST['stock_menu'],
				"release_menu" => $_POST['release_menu'],
				"barcode_menu" => $_POST['barcode_menu'],
				"real_stock_menu" => $_POST['real_stock_menu'],
				"safety_menu" => $_POST['safety_menu'],
				"ele_menu" => $_POST['ele_menu'],
				"crm_menu" => $_POST['crm_menu'],
				"board_menu" => $_POST['board_menu'],
				"schedule_menu" => $_POST['schedule_menu'],
				"leave_menu" => $_POST['leave_menu'],
				"file_menu" => $_POST['file_menu'],
				"goods_menu" => $_POST['goods_menu'],
				"car_menu" => $_POST['car_menu'],
				"installation_menu" => $_POST['installation_menu']
			);
			$config->insert($data);
		}
		$this->movePage("config","inputPageMenu");
	}

	public function frmInitialization() {
		require_once("views/config/frmInitialization.php");
	}

	public function frmMenuSetting(){
		require_once("views/config/frmMenuSetting.php");
	}
/************************************************************************************************************************************************************************************************
:: 기준정보관리
*************************************************************************************************************************************************************************************************/

//------------------------------------------------------------------------- 품목관리 -----------------------------------------------------------------------------------------------------------//
	// 품목구분관리
	public function frmItemClassify() {
		require_once("views/base/frmItemClassify.php");
	}

	// 품목그룹관리
	public function frmItemGroup() {
		require_once("views/base/frmItemGroup.php");
	}

	// 품목 제조공정관리 base
	public function frmItemProcess() {
		require_once("views/base/frmItemProcess.php");
	}

	// 품목매입처관리 base
	public function frmItemBuyer() {
		require_once("views/base/frmItemBuyer.php");
	}

	// 2차 품목 단가
	public function frmItemCost() {
		require_once("views/base/frmItemCost.php");
	}
	
	// 2차 품목등록
	public function frmItem() {
		require_once("views/base/frmItem.php");
	}

	// 거래처 구분관리
	public function frmAccountClassify() {
		require_once("views/base/frmAccountClassify.php");
	}

	// 거래처 관리
	public function frmAccount() {
		require_once("views/base/frmAccount.php");
	}

	// 부서관리
	public function frmDepartment() {
		require_once("views/base/frmDepartment.php");
	}

	// 직위관리
	public function frmPosition() {
		require_once("views/base/frmPosition.php");
	}

	// 사원관리
	public function frmEmployee() {
		require_once("views/base/frmEmployee.php");
	}

	// 창고관리
	public function frmWarehouse() {
		require_once("views/base/frmWarehouse.php");
	}

	// 공정관리
	public function frmProcess() {
		require_once("views/base/frmProcess.php");
	}

	// 생산설비 관리
	public function frmMachine() {
		require_once("views/base/frmMachine.php");
	}

	// 생산팀 관리
	public function frmTeam() {
		require_once("views/base/frmTeam.php");
	}

	// 프로젝트 관리
	public function frmProject() {
		require_once("views/base/frmProject.php");
	}

	// 용차 관리
	public function frmRentcar() {
		require_once("views/base/frmRentcar.php");
	}
	
	// 엑셀등록
	public function frmExcel() {
		require_once("views/base/frmExcel.php");
	}
	
	// 용차요금
	public function frmRentcarCost() {
		require_once("views/base/frmRentcarCost.php");
	}
/************************************************************************************************************************************************************************************************
:: 수주,영업관리
*************************************************************************************************************************************************************************************************/
	// 2차 견적서
	public function frmEstimate() {
		require_once("views/sales/frmEstimate.php");
	}

	// 2차 수주서
	public function frmObtainOrder() {
		require_once("views/sales/frmObtainOrder.php");
	}

	// 2차 출하지시서
	public function frmObtainOrderShipment() {
		require_once("views/sales/frmObtainOrderShipment.php");
	}

	// AS
	public function frmAs() {
		require_once("views/sales/frmAs.php");
	}
/************************************************************************************************************************************************************************************************
:: 생산관리
*************************************************************************************************************************************************************************************************/
	// 2차 생산계획
	public function frmProductSchedule() {
		require_once("views/production/frmProductSchedule.php");
	}

	// 월간 생산계획표
	public function frmWorkPlan() {
		require_once("views/production/frmWorkPlan.php");
	}

	// 주간 생산계획표
	public function frmWorkPlanWeek() {
		require_once("views/production/frmWorkPlanWeek.php");
	}

	// 작업지시서
	public function frmWorkOrder() {
		require_once("views/production/frmWorkOrder.php");
	}

	// 작업지시 현황
	public function frmWorkCurrentState() {
		require_once("views/production/frmWorkCurrentState.php");		
	}

	// 작업일보
	public function frmWorkDaily() {
		require_once("views/production/frmWorkDaily.php");
	}

	// 생산현황일보
	public function frmWorkProductDaily() {
		require_once("views/production/frmWorkProductDaily.php");
	}

	// 생산실적 등록
	public function frmWorkProductDailyRegist() {
		require_once("views/production/frmWorkProductDailyRegist.php");
	}

	// 생산현황
	public function frmMonthProductState() {
		require_once("views/production/frmMonthProductState.php");
	}
/************************************************************************************************************************************************************************************************
:: 품질관리
*************************************************************************************************************************************************************************************************/
	// 불량사유관리
	public function frmFaultyReason() {
		require_once("views/qc/frmFaultyReason.php");
	}

	// 2차 품질관리
	public function frmQc() {
		require_once("views/qc/frmQc.php");
	}

	// 검사구분관리
	public function frmQcClassify() {
		require_once("views/qc/frmQcClassify.php");
	}

	// 불량유형관리
	public function frmFaultyType(){
		require_once("views/qc/frmFaultyType.php");
	}

	// 불량관리
	public function frmFaultyChart(){
		require_once("views/qc/frmFaultyChart.php");
	}

	// 불량현황
	public function frmFaultyStatus(){
		require_once("views/qc/frmFaultyStatus.php");
	}
/************************************************************************************************************************************************************************************************
:: 외주,사급관리
*************************************************************************************************************************************************************************************************/
	// 외주요청
	public function frmOutsourcingRequest() {
		require_once("views/outsourcing/frmOutsourcingRequest.php");
	}
	// 외주관리
	public function frmOutsourcing(){
		require_once("views/outsourcing/frmOutsourcing.php");
	}

	// 외주품목관리
	public function frmOutsourcingItem(){
		require_once("views/outsourcing/frmOutsourcingItem.php");
	}

	// 사급자재관리
	public function frmBringinMaterial() {
		require_once("views/outsourcing/frmBringinMaterial.php");
	}

	// 사급자재구매관리
	public function frmBringinMaterialPurchase() {
		require_once("views/outsourcing/frmBringinMaterialPurchase.php");
	}

	// 사급자재출고관리
	public function frmBringinMaterialRelease() {
		require_once("views/outsourcing/frmBringinMaterialRelease.php");
	}

	// 외주품목입고관리
	public function frmOutsourcingItemPurchase() {
		require_once("views/outsourcing/frmOutsourcingItemPurchase.php");
	}

	// 외주창고관리
	public function frmOutsourcingWarehouse() {
		require_once("views/outsourcing/frmOutsourcingWarehouse.php");
	}
/************************************************************************************************************************************************************************************************
:: 구매,입고관리
*************************************************************************************************************************************************************************************************/
	// 간편 구매요청
	public function frmEasyPurchase(){
		require_once("views/purchase/frmEasyPurchase.php");
	}	
/************************************************************************************************************************************************************************************************
:: 출고,출하관리
*************************************************************************************************************************************************************************************************/
	// 출고요청서
	public function frmRelease() {
		require_once("views/release/frmRelease.php");
	}

	// 자재수불부
	public function frmInOut() {
		require_once("views/release/frmInOut.php");
	}

	public function frmShipmentOrder() {
		require_once("views/release/frmShipmentOrder.php");
	}
/************************************************************************************************************************************************************************************************
:: 재고관리
*************************************************************************************************************************************************************************************************/
	// 재고현황
	public function frmCurrentStock() {
		require_once("views/items/frmCurrentStock.php");
	}

	// 2차 창고재고관리
	public function frmWarehouseStock() {
		require_once("views/items/frmWarehouseStock.php");
	}

	// 안전재고관리
	public function frmSafetyStock() {
		require_once("views/items/frmSafetyStock.php");
	}

	// 바코드관리
	public function frmBarcode() {
		require_once("views/items/frmBarcode.php");
	}

	// 재공재고 관리
	public function frmProcessStock() {
		require_once("views/items/frmProcessStock.php");
	}

	// 재고실사
	public function frmStock() {
		require_once("views/items/frmStock.php");
	}

	// 불출재고(공정투입전)
	public function frmReleaseWarehouse() {
		require_once("views/items/frmReleaseWarehouse.php");
	}
/************************************************************************************************************************************************************************************************
:: 인사.급여관리
*************************************************************************************************************************************************************************************************/
	// 급여관리
	public function frmWage() {
		require_once("views/wage/frmWage.php");
	}
	
	// 일용직관리
	public function frmDayLabor() {
		require_once("views/wage/frmDayLabor.php");
	}

	// 근태관리
	public function frmCommute() {
		require_once("views/wage/frmCommute.php");
	}
/************************************************************************************************************************************************************************************************
:: 그룹웨어
*************************************************************************************************************************************************************************************************/
	// 업무공유
	public function frmBoard() {
		require_once("views/groupware/frmBoard.php");
	}

	// 파일보관함
	public function frmFile() {
		require_once("views/groupware/frmFile.php");
	}

	// 계정과목관리
	public function frmAccountSubject() {
		require_once("views/groupware/frmAccountSubject.php");
	}
	
	// 일정등록
	public function frmSchedule() {
		require_once("views/groupware/frmSchedule.php");
	}

	// 지출결의서
	public function frmSpendingResolution() {
		require_once("views/groupware/frmSpendingResolution.php");
	}

	// 결재라인
	public function frmApprovalLine() {
		require_once("views/groupware/frmApprovalLine.php");
	}

	// 내기안함
	public function frmMyApproval(){
		require_once("views/groupware/frmMyApproval.php");
	}

	// 결재리스트
	public function frmApproval() {
		require_once("views/groupware/frmApproval.php");
	}

	// 기안서작성
	public function frmRegistApproval(){
		require_once("views/groupware/frmRegistApproval.php");
	}

	// 기안서수정
	public function frmModifyApproval(){
		require_once("views/groupware/frmModifyApproval.php");
	}

	// 문서양식관리
	public function frmApprovalDocument() {
		require_once("views/groupware/frmApprovalDocument.php");
	}

	// 기안서 보기
	public function frmViewApproval(){
		require_once("views/groupware/frmViewApproval.php");
	}
	
	// 출퇴근관리
	public function frmManInOut() {
		require_once("views/wage/frmCommute.php");
	}
/************************************************************************************************************************************************************************************************
:: 회계
*************************************************************************************************************************************************************************************************/

	// 업체별 세부매입 현황
	public function frmAccountPurchase() {
		require_once("views/accounting/frmAccountPurchase.php");
	}

	// 품목별 발주 현황
	public function frmItemOrder() {
		require_once("views/accounting/frmItemOrder.php");
	}

	// 기간별 발주 현황
	public function frmPeriodOrder() {
		require_once("views/accounting/frmPeriodOrder.php");
	}

	// 발주서 처리
	public function frmOrderProcess(){
		require_once("views/accounting/frmOrderProcess.php");
	}

	// 업체별 발주현황
	public function frmAccountOrder() {
		require_once("views/accounting/frmAccountOrder.php");
	}

	// 기간별 매입현황
	public function frmPeriodPurchase() {
		require_once("views/accounting/frmPeriodPurchase.php");
	}

	// 매입처리
	public function frmPurchaseProcess() {
		require_once("views/accounting/frmPurchaseProcess.php");
	}

	// 업체별 매입순위표
	public function frmAccountPurchaseChart() {
		require_once("views/accounting/frmAccountPurchaseChart.php");
	}

	// 품목별 세부입고 현황
	public function frmItemDetailIn() {
		require_once("views/accounting/frmItemDetailIn.php");
	}



	// 거래명세서
	public function frmTransaction() {
		require_once("views/accounting/frmTransaction.php");
	}

	// 업체별 세부판매현황
	public function frmAccountSales() {
		require_once("views/accounting/frmAccountSales.php");
	}

	// 품목별 세부판매현황
	public function frmItemSales() {
		require_once("views/accounting/frmItemSales.php");		
	}

	// 기간별 판매현황
	public function frmPeriodSales() {
		require_once("views/accounting/frmPeriodSales.php");
	}

	// 업체별 판매순위표
	public function frmAccountSalesChart() {
		require_once("views/accounting/frmAccountSalesChart.php");
	}

	// 년,월 판매집계표
	public function frmSalesChart() {
		require_once("views/accounting/frmSalesChart.php");
	}



	// 환경설정
	public function frmConfig(){
		require_once("views/config/frmConfig.php");
	}

	// 미수금
	public function frmReceivables(){
		require_once("views/accounting/frmReceivables.php");		
	}

	// 미지급금
	public function frmPayable(){
		require_once("views/accounting/frmPayable.php");
	}




















	// 사원접근권한 등록
	public function registAuthority(){
		$sql = "select uid from erp_authority where emp_id='".$_POST['emp_id']."'";
		$t = @mysql_fetch_object(mysql_query($sql));

		if(isset($t->uid)) {
			$data = array (
				"table" => "erp_authority",
				"where" => "emp_id='".$_POST['emp_id']."'",
				"item_menu" => $_POST['item_menu'],
				"account_menu" => $_POST['account_menu'],
				"department_menu" => $_POST['department_menu'],
				"position_menu" => $_POST['position_menu'],
				"employee_menu" => $_POST['employee_menu'],
				"warehouse_menu" => $_POST['warehouse_menu'],
				"process_menu" => $_POST['process_menu'],
				"machine_menu" => $_POST['machine_menu'],
				"project_menu" => $_POST['project_menu'],
				"excel_menu" => $_POST['excel_menu'],
				"trade_menu" => $_POST['trade_menu'],
				"estimate_menu" => $_POST['estimate_menu'],
				"order_menu" => $_POST['order_menu'],
				"shipment_menu" => $_POST['shipment_menu'],
				"as_menu" => $_POST['as_menu'],
				"receive_menu" => $_POST['receive_menu'],
				"sale_plan_menu" => $_POST['sale_plan_menu'],
				"demand_menu" => $_POST['demand_menu'],
				"purchase_plan_menu" => $_POST['purchase_plan_menu'],
				"purchase_menu" => $_POST['purchase_menu'],
				"purchase_item_menu" => $_POST['purchase_item_menu'],
				"amount_menu" => $_POST['amount_menu'],
				"bom_menu" => $_POST['bom_menu'],
				"bom_cal_menu" => $_POST['bom_cal_menu'],
				"outsourcing_menu" => $_POST['outsourcing_menu'],
				"workplan_menu" => $_POST['workplan_menu'],
				"workplan_bom_menu" => $_POST['workplan_bom_menu'],
				"work_menu" => $_POST['work_menu'],
				"qc_menu" => $_POST['qc_menu'],
				"defective_menu" => $_POST['defective_menu'],
				"warehouse_stock_menu" => $_POST['warehouse_stock_menu'],
				"price_menu" => $_POST['price_menu'],
				"stock_menu" => $_POST['stock_menu'],
				"release_menu" => $_POST['release_menu'],
				"barcode_menu" => $_POST['barcode_menu'],
				"real_stock_menu" => $_POST['real_stock_menu'],
				"safety_menu" => $_POST['safety_menu'],
				"ele_menu" => $_POST['ele_menu'],
				"crm_menu" => $_POST['crm_menu'],
				"board_menu" => $_POST['board_menu'],
				"schedule_menu" => $_POST['schedule_menu'],
				"leave_menu" => $_POST['leave_menu'],
				"file_menu" => $_POST['file_menu'],
				"goods_menu" => $_POST['goods_menu'],
				"car_menu" => $_POST['car_menu'],
				"installation_menu" => $_POST['installation_menu']
			);
			$this->update($data);
		} else {
			$data = array (
				"table" => "erp_authority",
				"emp_id" => $_POST['emp_id'],
				"item_menu" => $_POST['item_menu'],
				"account_menu" => $_POST['account_menu'],
				"department_menu" => $_POST['department_menu'],
				"position_menu" => $_POST['position_menu'],
				"employee_menu" => $_POST['employee_menu'],
				"warehouse_menu" => $_POST['warehouse_menu'],
				"process_menu" => $_POST['process_menu'],
				"machine_menu" => $_POST['machine_menu'],
				"project_menu" => $_POST['project_menu'],
				"excel_menu" => $_POST['excel_menu'],
				"trade_menu" => $_POST['trade_menu'],
				"estimate_menu" => $_POST['estimate_menu'],
				"order_menu" => $_POST['order_menu'],
				"shipment_menu" => $_POST['shipment_menu'],
				"as_menu" => $_POST['as_menu'],
				"receive_menu" => $_POST['receive_menu'],
				"sale_plan_menu" => $_POST['sale_plan_menu'],
				"demand_menu" => $_POST['demand_menu'],
				"purchase_plan_menu" => $_POST['purchase_plan_menu'],
				"purchase_menu" => $_POST['purchase_menu'],
				"purchase_item_menu" => $_POST['purchase_item_menu'],
				"amount_menu" => $_POST['amount_menu'],
				"bom_menu" => $_POST['bom_menu'],
				"bom_cal_menu" => $_POST['bom_cal_menu'],
				"outsourcing_menu" => $_POST['outsourcing_menu'],
				"workplan_menu" => $_POST['workplan_menu'],
				"workplan_bom_menu" => $_POST['workplan_bom_menu'],
				"work_menu" => $_POST['work_menu'],
				"qc_menu" => $_POST['qc_menu'],
				"defective_menu" => $_POST['defective_menu'],
				"warehouse_stock_menu" => $_POST['warehouse_stock_menu'],
				"price_menu" => $_POST['price_menu'],
				"stock_menu" => $_POST['stock_menu'],
				"release_menu" => $_POST['release_menu'],
				"barcode_menu" => $_POST['barcode_menu'],
				"real_stock_menu" => $_POST['real_stock_menu'],
				"safety_menu" => $_POST['safety_menu'],
				"ele_menu" => $_POST['ele_menu'],
				"crm_menu" => $_POST['crm_menu'],
				"board_menu" => $_POST['board_menu'],
				"schedule_menu" => $_POST['schedule_menu'],
				"leave_menu" => $_POST['leave_menu'],
				"file_menu" => $_POST['file_menu'],
				"goods_menu" => $_POST['goods_menu'],
				"car_menu" => $_POST['car_menu'],
				"installation_menu" => $_POST['installation_menu']
			);
			$this->insert($data);
		}
		$t = Dba::get($_POST['emp_uid'],"employee");
		require_once ("views/base/erp_modifyEmployee.php");
	}
//----------------------------------------------------------------------- 창고관리 ---------------------------------------------------------------------------------------------------------//
	// 창고 리스트 페이지
	public function listPageWarehouse() {
		require_once ("views/base/erp_createWarehouse.php");
	}
//----------------------------------------------------------------------- 공정관리 ---------------------------------------------------------------------------------------------------------//
	// 공정 리스트 페이지
	public function listPageProcess() {
		require_once ("views/base/erp_createProcess.php");
	}
//----------------------------------------------------------------------- 생산기계관리 -----------------------------------------------------------------------------------------------------//
	// 생산기기 리스트 페이지
	public function listPageMachine() {
		require_once ("views/base/erp_createMachine.php");
	}
//----------------------------------------------------------------------- 생산팀관리 -----------------------------------------------------------------------------------------------------//
	public function createPageTeam() {
		require_once("views/base/erp_createTeam.php");
	}
//----------------------------------------------------------------------- 불량사유관리 -----------------------------------------------------------------------------------------------------//
	public function listPageDefectReason() {
		require_once ("views/qc/erp_createDefectReason.php");
	}
//----------------------------------------------------------------------- 검사관리 ---------------------------------------------------------------------------------------------------------//
	// 검사항목관리
	public function listPageQcItem() {
		require_once ("views/qc/erp_createQcItem.php");
	}
	
	// 검사구분관리
	public function listPageQcClassify() {
		require_once ("views/qc/erp_createQcClassify.php");
	}
//----------------------------------------------------------------------- 용차관리 ---------------------------------------------------------------------------------------------------------//
	public function listPageRentCar() {
		require_once ("views/base/erp_listRentCar.php");
	}

	public function inputPageRentCar() {
		require_once ("views/base/erp_createRentCar.php");
	}

	public function modifyPageRentCar() {
		$t = Dba::get($_GET['uid'],"rentcar");
		require_once ("views/base/erp_modifyRentCar.php");
	}

	public function registRentCar() {
		$data = array (
			"table" => "erp_rentcar",
			"owner" => $_POST['owner'],
			"corp_reg_no" => $_POST['corp_reg_no'],
			"corp_nm" => $_POST['corp_nm'],
			"corp_condition" => $_POST['corp_condition'],
			"corp_event" => $_POST['corp_event'],
			"corp_phone" => $_POST['corp_phone'],
			"mobile" => $_POST['mobile'],
			"corp_fax" => $_POST['corp_fax'],
			"email" => $_POST['email'],
			"corp_zipcode" => $_POST['corp_zipcode'],
			"corp_address" => $_POST['corp_address'],
			"car_no" => $_POST['car_no'],
			"classification" => $_POST['classification'],
			"ton" => $_POST['ton'],
			"bank" => $_POST['bank'],
			"account_holder" => $_POST['account_holder'],
			"account" => $_POST['account']
		);
		$this->insert($data);
		$this->movePage("base","listPageRentCar");
	}

	public function updateRentCar() {
		$data = array (
			"table" => "erp_rentcar",
			"where" => "uid=".$_POST['uid'],
			"owner" => $_POST['owner'],
			"corp_reg_no" => $_POST['corp_reg_no'],
			"corp_nm" => $_POST['corp_nm'],
			"corp_condition" => $_POST['corp_condition'],
			"corp_event" => $_POST['corp_event'],
			"corp_phone" => $_POST['corp_phone'],
			"mobile" => $_POST['mobile'],
			"corp_fax" => $_POST['corp_fax'],
			"email" => $_POST['email'],
			"corp_zipcode" => $_POST['corp_zipcode'],
			"corp_address" => $_POST['corp_address'],
			"car_no" => $_POST['car_no'],
			"classification" => $_POST['classification'],
			"ton" => $_POST['ton'],
			"bank" => $_POST['bank'],
			"account_holder" => $_POST['account_holder'],
			"account" => $_POST['account']
		);
		$this->update($data);
		$this->movePage("base","listPageRentCar");
	}

	public function listPageRentCost() {
		require_once ("views/base/erp_createRentCost.php");
	}
//----------------------------------------------------------------------- 프로젝트관리 ---------------------------------------------------------------------------------------------------------//
	// 프로젝트 리스트 페이지
	public function listPageProject() {
		require_once ("views/base/erp_listProject.php");
	}

	// 프로젝트 등록 페이지
	public function inputPageProject() {
		require_once ("views/base/erp_createProject.php");
	}

	// 프로젝트 등록 실행
	public function registProject() {
		//$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_project",
			"project_nm" => $_POST['project_nm'],
			"emp_id" => $_POST['emp_id'],
			"account_cd" => $_POST['account_cd'],
			"classification" => $_POST['classification'],
			"start_dt" => $_POST['start_dt'],
			"end_dt" => $_POST['end_dt']
		);

		$this->insert($data);
		$fid = $this->get_insert_id();
		
		if(isset($_FILES['attach'])){
			foreach($_FILES['attach']['tmp_name'] as $key => $tmp_name)
			{
				$file_name = $_FILES['attach']['name'][$key];
				$file_size =$_FILES['attach']['size'][$key];
				$file_tmp =$_FILES['attach']['tmp_name'][$key];
				$file_type=$_FILES['attach']['type'][$key];  
				
				if($file_name != "") {
					move_uploaded_file($file_tmp,"attach/".time().$file_name);
					$nf = time().$file_name;
					$attach_data = array (
						"table" => "erp_project_attach",
						"fid" => $fid,
						"attach" => $nf
					);
					$this->insert($attach_data);
				}
			}
		} 
		$this->movePage("base","listPageProject");
	}

	// 프로젝트 수정 페이지
	public function modifyPageProject() {
		$t = Dba::get($_GET['uid'],"project");
		require_once ("views/base/erp_modifyProject.php");
	}

	// 프로젝트 수정 실행
	public function updateProject() {
		$data = array(
			"table" => "erp_project",
			"where" => "uid=".$_POST['uid'],
			"project_nm" => $_POST['project_nm'],
			"emp_id" => $_POST['emp_id'],
			"account_cd" => $_POST['account_cd'],
			"classification" => $_POST['classification'],
			"start_dt" => $_POST['start_dt'],
			"end_dt" => $_POST['end_dt']
		);

		$this->update($data);
		$fid = $this->get_insert_id();

		if(isset($_FILES['attach'])){
			foreach($_FILES['attach']['tmp_name'] as $key => $tmp_name)
			{
				$file_name = $_FILES['attach']['name'][$key];
				$file_size =$_FILES['attach']['size'][$key];
				$file_tmp =$_FILES['attach']['tmp_name'][$key];
				$file_type=$_FILES['attach']['type'][$key];  
				
				if($file_name != "") {
					move_uploaded_file($file_tmp,"attach/".time().$file_name);
					$nf = time().$file_name;
					$attach_data = array (
						"table" => "erp_project_attach",
						"fid" => $fid,
						"attach" => $nf
					);
					$this->insert($attach_data);
				}
			}
		} 
		$this->movePage("base","listPageProject");
	}
//----------------------------------------------------------------------- 엑셀업로드 ---------------------------------------------------------------------------------------------------------//
	public function inputPageExcel() {
		require_once ("views/base/erp_createExcel.php");
	}
	
	/*
	public function registExcel() {
		extract($_POST);
		//error_reporting(E_ALL);
		//ini_set("display_errors", 1);
		ini_set("memory_limit", -1);
		error_reporting(E_ALL ^ E_NOTICE);
		require_once $_SERVER['DOCUMENT_ROOT']. '/library/PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
		echo ('<meta http-equiv="content-type" content="text/html; charset=utf-8">');

		// 저장될 디비 테이블명
		$TABLE_NAME = $table_name;
		// 저장될 디렉토리
		$upfile_dir = $_SERVER['DOCUMENT_ROOT']."/attach/excel";
		//CSV데이타 추출시 한글깨짐방지
		setlocale(LC_CTYPE, 'ko_KR.eucKR'); // CSV 한글 깨짐 문제
		//장시간 데이터 처리될경우
		set_time_limit(0);

		$upfile_name = $_FILES['attach']['name']; // 파일이름
		$upfile_type = $_FILES['attach']['type']; // 확장자
		$upfile_size = $_FILES['attach']['size']; // 파일크기
		$upfile_tmp  = $_FILES['attach']['tmp_name']; // 임시 디렉토리에 저장된 파일명

		//확장자 확인
		if(preg_match("/(\.(xls|XLS))$/i",$upfile_name)) { //|xlsx|XLSX
		} else {
			echo ("<script>window.alert('업로드를 할수 없는 파일 입니다.\\n\\r확장자가 [xls]인 경우만 업로드가 가능합니다.'); history.go(-1) </script>");
			exit;
		}

		if ($upfile_name){
		//폴더내에 동일한 파일이 있는지 검사하고 있으면 삭제
			if (file_exists("{$upfile_dir}/{$upfile_name}") ) { unlink("{$upfile_dir}/{$upfile_name}"); }
			if ( strlen($upfile_size) < 7 ) {
				$filesize = sprintf("%0.2f KB", $upfile_size/100000);
			} else{
				$filesize = sprintf("%0.2f MB", $upfile_size/100000000);
			}
			 
			if (move_uploaded_file($upfile_tmp,"{$upfile_dir}/{$upfile_name}")) {
			} else {
				echo ("<script>window.alert('디렉토리에 복사실패'); history.go(-1) </script>");
				exit;
			}
			chmod("{$upfile_dir}/{$upfile_name}",0777); 
			//chown("{$upfile_dir}/{$upfile_name}",'nobody'); 
		}
		
		$filepath = "{$upfile_dir}/{$upfile_name}";
		try {

			$filetype = PHPExcel_IOFactory::identify($filepath);
			$reader = PHPExcel_IOFactory::createReader($filetype);
			$php_excel = $reader->load($filepath);

			$sheet = $php_excel->getSheet(0);           // 첫번째 시트
			$maxRow = $sheet->getHighestRow();          // 마지막 라인
			$maxColumn = $sheet->getHighestColumn();    // 마지막 칼럼

			$target = "A"."2".":"."$maxColumn"."$maxRow";
			$lines = $sheet->rangeToArray($target, NULL, TRUE, FALSE);
			
			//echo sizeof($lines);
			$this->begin();
			// 라인수 만큼 루프
			foreach ($lines as $key => $line) {
				$col = 0;
				$item = array(
					"A"=>$line[$col++],   // 첫번째 칼럼
					"B"=>$line[$col++],   // 두번쨰 칼럼
					"C"=>$line[$col++],   // 세번쨰 칼럼
					"D"=>$line[$col++],   // 네번쨰 칼럼
					"E"=>$line[$col++],   // 다섯번쨰 칼럼
					"F"=>$line[$col++],   // 여섯번쨰 칼럼
					"G"=>$line[$col++],   // 일곱번쨰 칼럼
					"H"=>$line[$col++],   // 여덟번쨰 칼럼
					"I"=>$line[$col++],   // 아홉번쨰 칼럼
					"J"=>$line[$col++],   // 열번쨰 칼럼
					"K"=>$line[$col++],   // 열한번쨰 칼럼
					"L"=>$line[$col++],   // 열두번쨰 칼럼
					"M"=>$line[$col++],   // 열세번쨰 칼럼
					"N"=>$line[$col++],   // 열네번쨰 칼럼
					"O"=>$line[$col++],   // 열다섯번쨰 칼럼
					"P"=>$line[$col++],   // 열다섯번쨰 칼럼
					"Q"=>$line[$col++],   // 열다섯번쨰 칼럼
				);

				//print_r($item["A"] .",". $item["B"].",". $item["C"].",". $item["D"].",". $item["E"].",". $item["F"] ."<br/>");

				switch ($_POST['excel_gb']) {
					case "building":	
						$classification = trim(addslashes(strip_tags($item["A"])));		
						$name = trim(addslashes(strip_tags($item["B"])));	
						$gu = strtoupper(trim(addslashes(strip_tags($item["C"]))));	
						$dong = trim(addslashes(strip_tags($item["D"])));
						$address = trim(addslashes(strip_tags($item["E"])));
						$phone = trim(addslashes(strip_tags($item["F"])));
						

						if($gu != "" && $dong != "") {
							switch($classification) {
								case "다중" : $classify = 1; break;
								case "다가구" : $classify = 2; break;
							}
							$sql = "select * from gu where name='".$gu."'";
							$this->query($sql);
							$gu_uid = $this->fetch();

							$sql = "select * from dong where name='".$dong."'";
							$this->query($sql);
							$dong_uid = $this->fetch();

							$sql = "select * from building where gu=".$gu_uid->uid." and dong=".$dong_uid->uid." and name='".$name."'";
							$this->query($sql);

							if($this->get_rows() < 1) {

								$data = array(
									"table" => "building",
									"name" => $name,
									"classify" => $classify,
									"city" => 1,
									"gu" => $gu_uid->uid,
									"dong" => $dong_uid->uid,
									"address" => $address,
									"phone" => $phone
								);
								$this->insert($data);
							}
						}
					break;

				
				}			
			}
			$this->commit();
		} 
		catch (exception $e) {
			$this->rollback();
			echo '엑셀파일을 읽는도중 오류가 발생하였습니다.';
		}
		

		unlink("{$upfile_dir}/{$upfile_name}");
		$this->movePage("base","inputPageExcel");
	}
	*/

	public function registExcel() {
		extract($_POST);

		ini_set("memory_limit", -1);
		error_reporting(E_ALL ^ E_NOTICE);
		require_once $_SERVER['DOCUMENT_ROOT']."/library/excel_reader2.php";
		echo ('<meta http-equiv="content-type" content="text/html; charset=utf-8">');

		// 저장될 디비 테이블명
		$TABLE_NAME = $table_name;
		// 저장될 디렉토리
		$upfile_dir = $_SERVER['DOCUMENT_ROOT']."/attach/excel";
		//CSV데이타 추출시 한글깨짐방지
		setlocale(LC_CTYPE, 'ko_KR.eucKR'); // CSV 한글 깨짐 문제
		//장시간 데이터 처리될경우
		set_time_limit(0);

		$upfile_name = $_FILES['attach']['name']; // 파일이름
		$upfile_type = $_FILES['attach']['type']; // 확장자
		$upfile_size = $_FILES['attach']['size']; // 파일크기
		$upfile_tmp  = $_FILES['attach']['tmp_name']; // 임시 디렉토리에 저장된 파일명

		//확장자 확인
		if(preg_match("/(\.(xls|XLS))$/i",$upfile_name)) { //|xlsx|XLSX
		} else {
			echo ("<script>window.alert('업로드를 할수 없는 파일 입니다.\\n\\r확장자가 [xls]인 경우만 업로드가 가능합니다.'); history.go(-1) </script>");
			exit;
		}
		if ($upfile_name){
		//폴더내에 동일한 파일이 있는지 검사하고 있으면 삭제
			if (file_exists("{$upfile_dir}/{$upfile_name}") ) { unlink("{$upfile_dir}/{$upfile_name}"); }
			if ( strlen($upfile_size) < 7 ) {
				$filesize = sprintf("%0.2f KB", $upfile_size/100000);
			} else{
				$filesize = sprintf("%0.2f MB", $upfile_size/100000000);
			}
			 
			if (move_uploaded_file($upfile_tmp,"{$upfile_dir}/{$upfile_name}")) {
			} else {
				echo ("<script>window.alert('디렉토리에 복사실패'); history.go(-1) </script>");
				exit;
			}
			chmod("{$upfile_dir}/{$upfile_name}",0777); 
			//chown("{$upfile_dir}/{$upfile_name}",'nobody'); 
		}

		$excel = new Spreadsheet_Excel_Reader("{$upfile_dir}/{$upfile_name}");
		$excel->setOutputEncoding('UTF-8');

		// 엑셀 첫번째 sheet 행 개수
		$rowcount = $excel->rowcount($sheet_index=0);
		$missDataCnt = 0; //중복된 데이터 카운트
		$counts=0;
		$first_num=0;
		$last_num=0;
		
		$this->begin();
		for($i=2 ;$i<=$rowcount; $i++){
			switch ($_POST['excel_gb']) {
				case "item":	
					$classification = trim(addslashes(strip_tags($excel->val($i,1))));		
					$item_group_cd = trim(addslashes(strip_tags($excel->val($i,2))));	
					$item_cd = strtoupper(trim(addslashes(strip_tags($excel->val($i,3)))));	
					$item_nm = trim(addslashes(strip_tags($excel->val($i,4))));
					$unit = trim(addslashes(strip_tags($excel->val($i,5))));
					$standard = trim(addslashes(strip_tags($excel->val($i,6))));
					$warehouse_nm = trim(addslashes(strip_tags($excel->val($i,7))));
					$delivery_period = $this->replaceComma(trim(addslashes(strip_tags($excel->val($i,8)))));
					$stock_cnt = $this->replaceComma(trim(addslashes(strip_tags($excel->val($i,9)))));
					$safety_stock_cnt = $this->replaceComma(trim(addslashes(strip_tags($excel->val($i,10)))));
					$purchase_price = $this->replaceComma(trim(addslashes(strip_tags($excel->val($i,11)))));
					$sale_price = $this->replaceComma(trim(addslashes(strip_tags($excel->val($i,12)))));
					$barcode = trim(addslashes(strip_tags($excel->val($i,13))));

					if(empty($item_cd)) $item_cd = $pre.mt_rand(100000000,999999999);
					if(empty($barcode)) $barcode = $item_cd;
					
					$item_cd = str_replace("'","",$item_cd);
					$item_cd = str_replace('"',"",$item_cd);
					$item_nm = str_replace("'","",$item_nm);
					$item_nm = str_replace('"',"",$item_nm);
					$unit = str_replace('"',"",$unit);
					$unit = str_replace('"',"",$unit);
					$standard = str_replace('"',"",$standard);
					$standard = str_replace('"',"",$standard);

					$classification = $this->getItemClassificationCd($classification);
					if(empty($classification)) $classification = 0;

					$data = array (
						"table" => "erp_item",
						"classification" => $classification,
						"item_cd" => $item_cd,
						"item_nm" => $item_nm,
						"unit" => $unit,
						"standard" => $standard,
						"delivery_period" => $delivery_period,
						"stock_cnt" => $stock_cnt,
						"safety_stock_cnt" => $safety_stock_cnt,
						"barcode" => $barcode
					);
					$result = $this->insert($data);	
					
					if(!$result) $this->rollback();

					$gid = $this->getUid();
					$warehouse_cd = $this->getWarehouseCd($warehouse_nm);

					if($stock_cnt > 0) $fid = $this->stockIn($gid, $stock_cnt, $warehouse_cd);		
					$this->registReason($gid, $fid, $stock_cnt, 0, "기준정보등록");
					$this->registPrice($gid, $fid, $purchase_price, $sale_price);
				break;

				case "bom":	
					$item_cd = strtoupper(trim(addslashes(strip_tags($excel->val($i,1)))));		
					$item_nm = trim(addslashes(strip_tags($excel->val($i,2))));	
					$standard = trim(addslashes(strip_tags($excel->val($i,3))));	
					$unit = trim(addslashes(strip_tags($excel->val($i,4))));
					$cnt = $this->replaceComma(trim(addslashes(strip_tags($excel->val($i,5)))));

					$item_cd = str_replace("'","",$item_cd);
					$item_cd = str_replace('"',"",$item_cd);
					$item_nm = str_replace("'","",$item_nm);
					$item_nm = str_replace('"',"",$item_nm);
					$unit = str_replace('"',"",$unit);
					$unit = str_replace('"',"",$unit);
					$standard = str_replace('"',"",$standard);
					$standard = str_replace('"',"",$standard);
					
					if($cnt == 0) {
						$sql = "select uid from erp_item where item_cd='".$item_cd."' and standard='".$standard."'";
						$this->query($sql);
						$item = $this->fetch();
						$_SESSION['fid'] = $item->uid;
					} else {
						$data = array (
							"table" => "erp_bom",
							"fid" => $_SESSION['fid'],
							"item_cd" => $item_cd,
							"item_nm" => $item_nm,
							"standard" => $standard,
							"unit" => $unit,
							"cnt" => $cnt
						);
						$this->insert($data);
					}						
				break;

				case "employee":
					$emp_cd = trim(addslashes(strip_tags($excel->val($i,1))));		
					$emp_nm = trim(addslashes(strip_tags($excel->val($i,2))));	
					$emp_id = trim(addslashes(strip_tags($excel->val($i,3))));	
					$emp_pwd = trim(addslashes(strip_tags($excel->val($i,4))));
					$sex = trim(addslashes(strip_tags($excel->val($i,5))));
					$emp_mobile = trim(addslashes(strip_tags($excel->val($i,6))));
					$big_department = trim(addslashes(strip_tags($excel->val($i,7))));
					$middle_department = trim(addslashes(strip_tags($excel->val($i,8))));
					$small_department = trim(addslashes(strip_tags($excel->val($i,9))));
					$position = trim(addslashes(strip_tags($excel->val($i,10))));
					$join_dt = trim(addslashes(strip_tags($excel->val($i,11))));
					$email = trim(addslashes(strip_tags($excel->val($i,12))));

					$data = array (
						"table" => "erp_employee",
						"classification" => "work",
						"emp_cd" => $emp_cd,
						"emp_nm" => $emp_nm,
						"emp_id" => $emp_id,
						"emp_pwd" => $emp_pwd,
						"sex" => $sex,
						"big_department_cd" => $this->getBigDepartmentCd($big_department),
						"middle_department_cd" => $this->getMiddleDepartmentCd($middle_department),
						"small_department_cd" => $this->getSmallDepartmentCd($small_department),
						"position_cd" => $this->getPositionCd($position),
						"emp_email" => $email,
						"join_dt" => $join_dt,
						"emp_mobile" => $emp_mobile
					);
					$this->insert($data);							
				break;

				case "account":	
					//$now = date("Y-m-d H:i:s");
					$classification = trim(addslashes(strip_tags($excel->val($i,1))));		
					$account_cd = trim(addslashes(strip_tags($excel->val($i,2))));	
					$account_nm = trim(addslashes(strip_tags($excel->val($i,3))));	
					$owner = trim(addslashes(strip_tags($excel->val($i,4))));
					$owner_mobile = trim(addslashes(strip_tags($excel->val($i,5))));
					$corp_reg_no = trim(addslashes(strip_tags($excel->val($i,6))));
					$corp_condition = trim(addslashes(strip_tags($excel->val($i,7))));
					$corp_event = trim(addslashes(strip_tags($excel->val($i,8))));
					$corp_phone = trim(addslashes(strip_tags($excel->val($i,9))));
					$corp_fax = trim(addslashes(strip_tags($excel->val($i,10))));
					$corp_email = trim(addslashes(strip_tags($excel->val($i,11))));
					$manager = trim(addslashes(strip_tags($excel->val($i,12))));
					$corp_zipcode = trim(addslashes(strip_tags($excel->val($i,13))));
					$corp_address = trim(addslashes(strip_tags($excel->val($i,14))));
					$account_id = trim(addslashes(strip_tags($excel->val($i,15))));
					$account_pwd = trim(addslashes(strip_tags($excel->val($i,16))));

					$classification = $this->getAccountClassificationCd($classification);

					$data = array (
						"table" => "erp_account",
						"classification" => $classification,
						"account_cd" => "A-".$account_cd,
						"account_nm" => $account_nm,
						"owner" => $owner,
						"owner_mobile" => $owner_mobile,
						"corp_reg_no" => $corp_reg_no,
						"corp_condition" => $corp_condition,
						"corp_event" => $corp_event,
						"corp_phone" => $corp_phone,
						"corp_fax" => $corp_fax,
						"corp_email" => $corp_email,
						"manager" => $manager,
						"corp_zipcode" => $corp_zipcode,
						"corp_address" => $corp_address,
						"account_id" => $account_id,
						"account_pwd" => $account_pwd
					);
					$this->insert($data);							
				break;
			}
		}
		$this->commit();
		
		switch($_POST['excel_gb']) {
			case "item" : 
				$movePage = "listPageItem"; 
				$con = "base";
			break;
			case "employee" : 
				$movePage = "listPageEmployee"; 
				$con = "base";
			break;
			case "bom" : 
				$movePage = "listPageBom"; 
				$con = "production";
			break;
			case "account" : 
				$movePage = "listPageAccount"; 
				$con = "base";
			break;
		}

		unlink("{$upfile_dir}/{$upfile_name}");
		$this->movePage($con,$movePage);
	}

	public function downloadPageExcel() {
		require_once ("views/base/erp_downloadExcel.php");
	}



/************************************************************************************************************************************************************************************************
:: 영업관리
*************************************************************************************************************************************************************************************************/
/******************************************************************************************************
:: (영업관리) 견적관리
******************************************************************************************************/
	// 견적서 리스트 페이지
	public function listPageEstimate(){
		require_once ("views/sales/erp_listEstimate.php");
	}

	// 견적서 등록 페이지
	public function inputPageEstimate(){
		require_once ("views/sales/erp_createEstimate.php");
	}
	
	// 견적서 등록 실행
	public function registEstimate() {
		$fileAttach = $this->upload('attach');

		if($_POST['final'] == "y") {
			$data = array (
				"table" => "erp_estimate",
				"where" => "estimate_cd='".$_POST['estimate_cd']."'",
				"final" => 'n'
			);
			$this->update($data);
		}

		$data = array(
			"table" => "erp_estimate",
			"estimate_cd" => $_POST['estimate_cd'],
			"estimate_dt" => $_POST['estimate_dt'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"obtain_account_cd" => $_POST['obtain_account_cd'],
			"obtain_account_nm" => $_POST['obtain_account_nm'],
			"sales_emp_id" => $_POST['sales_emp_id'],
			"sales_emp_nm" => $_POST['sales_emp_nm'],
			"manager" => $_POST['manager'],
			"tax_type" => $_POST['tax_type'],
			"currency" => $_POST['currency'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"payment_condition" => $_POST['payment_condition'],
			"delivery_dt" => $_POST['delivery_dt'],
			"attach" => $fileAttach,
			"final" => $_POST['final'],
			"used" => "n",
			"emp_id" => $_SESSION['login_id'],
			"approval" => "n",
			"delivery_zipcode" => $_POST['delivery_zipcode'],
			"delivery_address" => $_POST['delivery_address'],
			"create_dt" => $this->now
		);

		
		$this->insert($data);
		$fid = $this->get_insert_id();

		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard = $_POST['standard'];
		$cnt = $_POST['cnt'];		
		$sale_price = $_POST['sale_price'];
		$tariff = $_POST['tariff'];
		$adjustments = $_POST['adjustments'];
		$supply_price = $_POST['supply_price'];
		$tax = $_POST['tax'];
		$total_price = $_POST['total_price'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_estimate_item",
					"fid" => $fid,
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"cnt" => $this->replaceComma($cnt[$key]),					
					"sale_price" => $this->replaceComma($sale_price[$key]),
					"tariff" => $tariff[$key],
					"adjustments" => $this->replaceComma($adjustments[$key]),
					"supply_price" => $this->replaceComma($supply_price[$key]),
					"tax" => $this->replaceComma($tax[$key]),
					"total_price" => $this->replaceComma($total_price[$key])
				);
				$this->insert($data);
			}
		}

		$this->movePage("sales","listPageEstimate");
	}
	
	// 견적서 수정 페이지
	public function modifyPageEstimate(){
		$t = Dba::get($_GET['uid'],"estimate");
		require_once ("views/sales/erp_modifyEstimate.php");
	}

/******************************************************************************************************
:: (영업관리) 수주관리
******************************************************************************************************/	
	// 수주 리스트 페이지
	public function listPageObtainOrder(){
		require_once ("views/sales/erp_listObtainOrder.php");
	}
	
	// 수주 등록 페이지
	public function inputPageObtainOrder(){
		require_once ("views/sales/erp_createObtainOrder.php");
	}
	
	// 수주서 등록 실행
	public function registObtainOrder() {
		$fileAttach = $this->upload('attach');
		$data = array(
			"table" => "erp_order",
			"order_cd" => $_POST['order_cd'],
			"estimate_cd" => $_POST['estimate_cd'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"obtain_account_cd" => $_POST['obtain_account_cd'],
			"obtain_account_nm" => $_POST['obtain_account_nm'],
			"sales_emp_id" => $_POST['sales_emp_id'],
			"sales_emp_nm" => $_POST['sales_emp_nm'],
			"manager" => $_POST['manager'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"tax_type" => $_POST['tax_type'],
			"currency" => $_POST['currency'],
			"project_cd" => $_POST['project_cd'],
			"project_nm" => $_POST['project_nm'],
			"refer" => $_POST['refer'],
			"payment_condition" => $_POST['payment_condition'],
			"delivery_dt" => $_POST['delivery_dt'],
			"attach" => $fileAttach,
			"state" => "plan",
			"receivable" => "y",
			"receivable_price" => 0,
			"emp_id" => $_SESSION['login_id'],
			"delivery_zipcode" => $_POST['delivery_zipcode'],
			"delivery_address" => $_POST['delivery_address'],
			"create_dt" => $this->now
		);

		$this->insert($data);
		$fid = $this->get_insert_id();

		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard = $_POST['standard'];
		$cnt = $_POST['cnt'];		
		$sale_price = $_POST['sale_price'];
		$tariff = $_POST['tariff'];
		$adjustments = $_POST['adjustments'];
		$supply_price = $_POST['supply_price'];
		$tax = $_POST['tax'];
		$total_price = $_POST['total_price'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_order_item",
					"fid" => $fid,
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"cnt" => $this->replaceComma($cnt[$key]),
					"out_cnt" => 0,
					"remain_cnt" => $this->replaceComma($cnt[$key]),
					"sale_price" => $this->replaceComma($sale_price[$key]),
					"tariff" => $tariff[$key],
					"adjustments" => $this->replaceComma($adjustments[$key]),
					"supply_price" => $this->replaceComma($supply_price[$key]),
					"tax" => $this->replaceComma($tax[$key]),
					"total_price" => $this->replaceComma($total_price[$key]),
					"state" => "plan",
					"shipment" => "n"
				);
				$this->insert($data);
			}
		}

		// 사용된 견적서는 사용처리 한다
		if(!empty($_POST['estimate_uid'])) {
			$data = array (
				"table" => "erp_estimate",
				"where" => "uid=".$_POST['estimate_uid'],
				"used" => "y"
			);
			
			$this->update($data);
		}

		// 미수금액 처리
		$sql = "select sum(total_price) as total_price from erp_order_item where fid=".$fid;
		$this->query($sql);
		$t = $this->fetch($sql);

		$data = array (
			"table" => "erp_order",
			"where" => "uid=".$fid,
			"receivable_price" => $t->total_price
		);
		$this->update($data);

		$this->movePage("sales","listPageObtainOrder");
	}
	
	// 수주서 수정 페이지
	public function modifyPageObtainOrder(){
		$t = Dba::get($_GET['uid'],"order");
		require_once ("views/sales/erp_modifyObtainOrder.php");
	}
	
	// 수주서 수정 실행
	public function updateObtainOrder(){
		if($_POST['reorder'] == "y") {
			$fileAttach = $this->upload('attach');
			$order_cd = $this->createReorderCode();
			$data = array(
				"table" => "erp_order",
				"order_cd" => $order_cd,
				"estimate_cd" => $_POST['estimate_cd'],
				"account_cd" => $_POST['account_cd'],
				"account_nm" => $_POST['account_nm'],
				"obtain_account_cd" => $_POST['obtain_account_cd'],
				"obtain_account_nm" => $_POST['obtain_account_nm'],
				"sales_emp_id" => $_POST['sales_emp_id'],
				"sales_emp_nm" => $_POST['sales_emp_nm'],
				"manager" => $_POST['manager'],
				"warehouse_cd" => $_POST['warehouse_cd'],
				"tax_type" => $_POST['tax_type'],
				"currency" => $_POST['currency'],
				"project_cd" => $_POST['project_cd'],
				"project_nm" => $_POST['project_nm'],
				"refer" => $_POST['refer'],
				"payment_condition" => $_POST['payment_condition'],
				"delivery_dt" => $_POST['delivery_dt'],
				"attach" => $fileAttach,
				"state" => "plan",
				"receivable" => "y",
				"receivable_price" => 0,
				"emp_id" => $_SESSION['login_id'],
				"delivery_zipcode" => $_POST['delivery_zipcode'],
				"delivery_address" => $_POST['delivery_address'],
				"create_dt" => $this->now
			);

			$this->insert($data);
			$fid = $this->get_insert_id();

			$item_cd = $_POST['item_cd'];
			$item_nm = $_POST['item_nm'];
			$standard = $_POST['standard'];
			$cnt = $_POST['cnt'];		
			$sale_price = $_POST['sale_price'];
			$tariff = $_POST['tariff'];
			$adjustments = $_POST['adjustments'];
			$supply_price = $_POST['supply_price'];
			$tax = $_POST['tax'];
			$total_price = $_POST['total_price'];

			foreach($item_cd as $key => $val) {
				if($val != "") {
					$data = array(
						"table" => "erp_order_item",
						"fid" => $fid,
						"item_cd" => $val,
						"item_nm" => $item_nm[$key],
						"standard" => $standard[$key],
						"cnt" => $this->replaceComma($cnt[$key]),
						"out_cnt" => 0,
						"remain_cnt" => $this->replaceComma($cnt[$key]),
						"sale_price" => $this->replaceComma($sale_price[$key]),
						"tariff" => $tariff[$key],
						"adjustments" => $this->replaceComma($adjustments[$key]),
						"supply_price" => $this->replaceComma($supply_price[$key]),
						"tax" => $this->replaceComma($tax[$key]),
						"total_price" => $this->replaceComma($total_price[$key]),
						"state" => "plan"
					);
					$this->insert($data);
				}
			}

			// 사용된 견적서는 사용처리 한다
			if(!empty($_POST['estimate_uid'])) {
				$data = array (
					"table" => "erp_estimate",
					"where" => "uid=".$_POST['estimate_uid'],
					"used" => "y"
				);
				
				$this->update($data);
			}

			// 미수금액 처리
			$sql = "select sum(total_price) as total_price from erp_order_item where fid=".$fid;
			$this->query($sql);
			$t = $this->fetch($sql);

			$data = array (
				"table" => "erp_order",
				"where" => "uid=".$fid,
				"receivable_price" => $t->total_price
			);
			$this->update($data);
		} else {

			$fileAttach = $this->upload('attach');
			$data = array(
				"table" => "erp_order",
				"where" => "uid=".$_POST['uid'],
				"order_cd" => $_POST['order_cd'],
				"estimate_cd" => $_POST['estimate_cd'],
				"account_cd" => $_POST['account_cd'],
				"obtain_account_cd" => $_POST['obtain_account_cd'],
				"sales_emp_id" => $_POST['sales_emp_id'],
				"manager" => $_POST['manager'],
				"warehouse_cd" => $_POST['warehouse_cd'],
				"tax_type" => $_POST['tax_type'],
				"currency" => $_POST['currency'],
				"project_cd" => $_POST['project_cd'],
				"refer" => $_POST['refer'],
				"payment_condition" => $_POST['payment_condition'],
				"delivery_dt" => $_POST['delivery_dt'],
				"attach" => $fileAttach,
				"state" => "plan",
				"receivable" => "y",
				"receivable_price" => 0,
				"emp_id" => $_SESSION['login_id']
			);
			$this->update($data);
			
			$sql = "delete from erp_order_item where fid=".$_POST['uid'];
			$this->query($sql);

			$item_cd = $_POST['item_cd'];
			$item_nm = $_POST['item_nm'];
			$standard = $_POST['standard'];
			$cnt = $_POST['cnt'];		
			$sale_price = $_POST['sale_price'];
			$tariff = $_POST['tariff'];
			$adjustments = $_POST['adjustments'];
			$supply_price = $_POST['supply_price'];
			$tax = $_POST['tax'];
			$total_price = $_POST['total_price'];

			foreach($item_cd as $key => $val) {
				if($val != "") {
					$data = array(
						"table" => "erp_order_item",
						"fid" => $_POST['uid'],
						"item_cd" => $val,
						"item_nm" => $item_nm[$key],
						"standard" => $standard[$key],
						"cnt" => $this->replaceComma($cnt[$key]),
						"out_cnt" => 0,
						"remain_cnt" => $this->replaceComma($cnt[$key]),
						"sale_price" => $this->replaceComma($sale_price[$key]),
						"tariff" => $tariff[$key],
						"adjustments" => $this->replaceComma($adjustments[$key]),
						"supply_price" => $this->replaceComma($supply_price[$key]),
						"tax" => $this->replaceComma($tax[$key]),
						"total_price" => $this->replaceComma($total_price[$key]),
						"state" => "plan"
					);
					$this->insert($data);
				}
			}
		}

		
		$this->movePage("sales","listPageObtainOrder");
	}

	
	// 출하지시서 입력페이지
	public function inputPageShipment() {
		require_once ("views/sales/erp_createShipment.php");
	}
//=================================================================================================================	
	// 소요량 계산
	public function checkBom($fid) {
		$query = "select * from erp_bom where fid=".$fid;
		$result = mysql_query($query);
		if(@mysql_num_rows($result) > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getBomCnt($uid){
		$query = "select cnt from erp_bom where uid=".$uid;
		$result = mysql_query($query);
		if($result) {
			$t = @mysql_fetch_object($result);
			return $t->cnt;
		} else {
			return 0;
		}
	}

	public function getStock($item_cd, $standard1, $standard2, $standard3) {
		$query = "select remain_cnt from erp_stock where item_cd='" . $item_cd ."' and standard1='" . $standard1 ."' and standard2='" . $standard2 ."' and standard3='" . $standard3 ."'";
		$result = mysql_query($query);
		while($t = mysql_fetch_object($result)) {
			$remain_cnt = $remain_cnt + $t->remain_cnt;
		}
		return $remain_cnt;
	}
//========================================================================================================================
	

	public function listPageAs() {
		require_once("views/sales/erp_listAs.php");
	}

	public function inputPageAs() {
		require_once("views/sales/erp_createAs.php");
	}

	public function modifyPageAs() {
		$t = Dba::get($_GET['uid'],"as");
		require_once("views/sales/erp_modifyAs.php");
	}

	public function registAs() {
		$phone = $this->convertMobileNumber($_POST['phone']);
		$data = array(
			"table" => "erp_as",
			"accept_dt" => $_POST['accept_dt'],
			"state" => $_POST['state'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"account_manager" => $_POST['account_manager'],
			"email" => $_POST['email'],
			"phone" => $phone,
			"item_cd" => $_POST['item_cd'],
			"item_nm" => $_POST['item_nm'],
			"faulty" => $_POST['faulty'],
			"memo" => $_POST['memo'],
			"as_result" => $_POST['as_result'],
			"processing" => $_POST['processing'],
			"processing_cost" => $_POST['processing_cost'],
			"emp_id" => $_POST['emp_id'],
			"emp_nm" => $_POST['emp_nm'],
			"create_dt" => $this->now
		);

		$this->insert($data);

		$this->movePage("sales","listPageAs");
	}

	public function updateAs(){
		$data = array(
			"table" => "erp_as",
			"where" => "uid=".$_POST['uid'],
			"accept_dt" => $_POST['accept_dt'],
			"state" => $_POST['state'],
			"account_cd" => $_POST['account_cd'],
			"account_nm" => $_POST['account_nm'],
			"account_manager" => $_POST['account_manager'],
			"email" => $_POST['email'],
			"phone" => $_POST['phone'],
			"item_cd" => $_POST['item_cd'],
			"item_nm" => $_POST['item_nm'],
			"faulty" => $_POST['faulty'],
			"memo" => $_POST['memo'],
			"as_result" => $_POST['as_result'],
			"processing" => $_POST['processing'],
			"processing_cost" => $_POST['processing_cost'],
			"emp_id" => $_POST['emp_id'],
			"emp_nm" => $_POST['emp_nm']
		);

		$this->update($data);

		$this->movePage("sales","listPageAs");
	}
/******************************************************************************************************
:: (영업관리) 출하 관리
******************************************************************************************************/
	// 출하 리스트
	public function listPageObtainOrderShipment() {
		require_once("views/sales/erp_listObtainOrderShipment.php");
	}
	
	// 출하지시
	public function inputPageObtainOrderShipment(){
		$t = Dba::get($_GET['uid'],"order");
		require_once("views/sales/erp_createObtainOrderShipment.php");
	}

	// 출하지시서 등록
	public function registObtainOrderShipment() {
		// 출하지시되었음을 기록한다
		$data = array(
			"table" => "erp_order",
			"where" => "order_cd='".$_POST['order_cd']."'",
			"state" => "shipment"
		);
		$this->update($data);

		$data = array(
			"table" => "erp_shipment",
			"fid" => $_POST['uid'],
			"order_cd" => $_POST['order_cd'],
			"account_cd" => $_POST['account_cd'],
			"manager" => $_POST['manager'],
			"telephone" => $_POST['telephone'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"delivery_dt" => $_POST['delivery_dt'],
			"zipcode" => $_POST['zipcode'],
			"address" => $_POST['address'],
			"state" => 'order',
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $this->now
		);
		$this->insert($data);
		$fid = $this->get_insert_id();

		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard = $_POST['standard'];
		$shipment_cnt = $_POST['shipment_cnt'];		

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_shipment_item",
					"fid" => $fid,
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"shipment_cnt" => $this->replaceComma($shipment_cnt[$key]),
					"remain_shipment_cnt" => $this->replaceComma($shipment_cnt[$key]),
					"state" => "order"
				);
				$this->insert($data);
			}
		}
		$this->movePage("sales","listPageObtainOrderShipment");
	}
/******************************************************************************************************
:: (영업관리) 미수금 관리
******************************************************************************************************/
	// 미수금관리
	public function listPageOutstanding() {
		require_once("views/sales/erp_listOutstanding.php");
	}
/******************************************************************************************************
:: (영업관리) 매출계획 관리
******************************************************************************************************/
	// 매출계획 리스트
	public function listPageSalesPlan(){
		require_once("views/sales/erp_listSalesPlan.php");
	}

	// 매출계획등록 페이지
	public function inputPageSalesPlan() {
		require_once ("views/sales/erp_createSalesPlan.php");
	}

	// 매출계획등록
	public function registSalesPlan() {
		$date = $_POST['year']."-".$_POST['month']."-01";
		$data = array(
			"table" => "erp_salesplan",
			"account_cd" => $_POST['account_cd'],
			"emp_id" => $_POST['sales_emp_id'],
			"expectation_dt" => $date
		);

		
		$this->insert($data);
		$fid = $this->get_insert_id();

		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard = $_POST['standard'];
		$cnt = $_POST['cnt'];		
		$sale_price = $_POST['sale_price'];
		$tariff = $_POST['tariff'];
		$adjustments = $_POST['adjustments'];
		$supply_price = $_POST['supply_price'];
		$tax = $_POST['tax'];
		$total_price = $_POST['total_price'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_salesplan_item",
					"fid" => $fid,
					"item_cd" => $val,
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"cnt" => $this->replaceComma($cnt[$key]),					
					"sale_price" => $this->replaceComma($sale_price[$key]),
					"tariff" => $tariff[$key],
					"adjustments" => $this->replaceComma($adjustments[$key]),
					"supply_price" => $this->replaceComma($supply_price[$key]),
					"tax" => $this->replaceComma($tax[$key]),
					"total_price" => $this->replaceComma($total_price[$key])
				);
				$this->insert($data);
			}
		}

		$this->movePage("sales","listPageSalesPlan");
	}
/************************************************************************************************************************************************************************************************
:: 생산관리
*************************************************************************************************************************************************************************************************/
	// BOM
	public function listPageBom() {
		require_once ("views/production/erp_listBom.php");
	}

	// 작업목록
	public function listPageWorkSheet() {
		//require_once ("views/production/listWorkSheet.php");
		require_once ("views/production/erp_listWorkSheet.php");
	}
	
	// 실적등록페이지
	public function inputPageWorkSheet() {
		require_once ("views/production/erp_createWorkSheet.php");
	}


	
	// BOM 계산
	public function calBom() {
		require_once ("views/production/erp_calBom.php");
	}

	public function inputPageBom() {
		require_once ("views/production/erp_createBom.php");
	}


	public function registBom(){
		// 기존 등록된 BOM 삭제
		$sql = "delete from erp_bom where fid=".$_POST['uid'];
		$this->query($sql);

		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$unit = $_POST['unit'];
		$standard = $_POST['standard'];
		$cnt = $_POST['cnt'];
		
		
		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array (
					"table" => "erp_bom",
					"fid" => $_POST['uid'],
					"item_cd" => $item_cd[$key],
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"unit" => $unit[$key],
					"cnt" => $cnt[$key]
				);
				$this->insert($data);
			}
		}

		$this->movePage("production","listPageBom");
		
	}
	
	// 작업지시 대기 리스트
	public function listPageStandbyWork() {
		require_once ("views/production/erp_listStandbyWork.php");
	}

	// 작업지시서 리스트
	public function listPageWork() {
		require_once ("views/production/erp_listWork.php");
	}

	// 작업지시서 리스트
	public function listPageWork2() {
		require_once ("views/production/erp_listWork2.php");
	}
	
	// 생산계획 리스트 화면
	public function listPageWorkPlan() {
		require_once ("views/production/erp_listWorkPlan.php");
	}
	
	// 작업지시서 등록
	public function inputPageWork(){
		$t = Dba::get($_GET['uid'],"order");
		require_once ("views/production/erp_createWork.php");
	}

	// 생산계획서 등록
	public function inputPageWorkPlan(){
		require_once("views/production/erp_createWorkPlan.php");
	}



	// 실적등록
	public function registWork(){
		// 해당주문에 대한 상태값을 작업종료로 바꾼다.
		// 전체 생산이 안되었을 경우의 값도 넣어주어야 차후에 추가 생산지시를 할 수 있다.
		$sql = "update erp_order set state='qc' where order_cd='".$_POST['order_cd']."'";
		$this->query($sql);

		// 작업종료
		$sql = "update erp_work set state='complete' where uid=".$_POST['fid'];
		$this->query($sql);

		$data = array (
			"table" => "erp_work_report",
			"where" => "fid=".$_POST['fid'],
			"work_cnt" => $_POST['correct_cnt'],
			"defective_cnt" => $_POST['incorrect_cnt'],
			"work_end_time" => $this->now
		);
		$this->update($data);

		// 투입공수 처리
		$man = $_POST['manpower'];
		$working = $_POST['working'];

		//- 작업시작시간구하기
		$sql = "select uid, work_start_time from erp_work_report where fid=".$_POST['fid'];
		$report = @mysql_fetch_object(mysql_query($sql));

		//- 작업종료시간 구하기
		//- 실 작업시간
		foreach($man as $key => $val) {
			if($val != "") {
				if($working[$key] == "y") {
					// 실작업시간
					$b = new DateTime($report->work_end_time);
					$c = new DateTime($report->work_start_time);
					$real_work_time = $b->getTimestamp() - $c->getTimestamp();
				
					$data = array (
						"table" => "erp_manpower",
						"fid" => $report->uid,
						"machine_nm" => $man[$key],
						"process_cd" => $_POST['process_cd'],
						"process_nm" => $this->getCompareName("erp_process", "process_nm", "uid", $_POST['process_cd']),
						"item_cd" => $_POST['process_item_cd'],
						"item_nm" => $_POST['work_item_nm'],
						"standard" => $_POST['process_standard'],
						"work_start_time" => $report->work_start_time,
						"work_end_time" => $this->now,
						"total_work_time" => $real_work_time
					);
					$this->insert($data);
				}
			}
		}

		// 생산품 입고처리
		/*
		$sql = "select * from erp_item where item_cd='".$_POST['process_item_cd']."' and standard='".$_POST['process_standard']."'";
		$this->query($sql);
		$item = $this->fetch();
		
		//// 입고 시킬 창고도 찾아야 한다.
		$sql = "select warehouse_cd from erp_order where order_cd='".$_POST['order_cd']."'";
		$order = @mysql_fetch_object(mysql_query($sql));

		// 적격 상품에 대한 입고 처리
		$fid = $this->stockIn($item->uid, $_POST['correct_cnt'], $order->warehouse_cd);
		$this->registReason($item->uid, $fid, $_POST['correct_cnt'], 0, "생산입고");
		// 불량품에 대한 입고 처리를 어떻게 할 것인지도 필요하다.
		*/
		
		// qc 전달
		$data = array(
			"table" => "erp_qc",
			"fid" => $_POST['fid'],
			"item_cd" => $_POST['process_item_cd'],
			"item_nm" => $_POST['work_item_nm'],
			"standard" => $_POST['process_standard'],
			"order_cnt" => $_POST['correct_cnt'],
			"state" => "ready",
			"warehouse_cd" => $order->warehouse_cd,
			"create_dt" => $this->now
		);
		$this->insert($data);

		// 투입자재
		$in_item_cd = $_POST['in_item_cd'];
		$in_item_nm = $_POST['in_item_nm'];
		$in_item_standard = $_POST['in_item_standard'];
		$bom_cnt = $_POST['bom_cnt'];
		$in_cnt = $_POST['in_cnt'];

		foreach($in_item_cd as $key => $val) {
			if($val != "") {
				// 투입된 수량 만큼 erp_stock 에서 가져온다 (lot_no 때문에)
				$sql = "select a.uid, a.remain_cnt, a.fid, b.stock_cnt from erp_stock a, (select * from erp_item where item_cd='".$in_item_cd[$key]."' and standard='".$in_item_standard[$key]."') b where a.fid=b.uid and a.used='n' order by a.uid asc";
				//echo $sql."====";
				$this->query($sql);
				
				$remain_cnt = 0;
				$cnt = $in_cnt[$key];

				while($t = $this->fetch()) {
					//echo $t->uid."===";
					$remain_cnt = $remain_cnt + $t->remain_cnt;

					if($remain_cnt > $cnt) { // 크다면

						$remain_cnt = $remain_cnt - $cnt;
						$sql = "update erp_stock set out_cnt=".$cnt.", remain_cnt=".$remain_cnt." where uid=".$t->uid;
						//echo $sql."====";
						$this->query($sql);
						$this->registReason($item->uid, $t->uid, 0, $cnt, "생산불출");

						$data = array (
							"table" => "erp_in_item",
							"fid" => $_POST['fid'],
							"item_cd" => $in_item_cd[$key],
							"item_nm" => $in_item_nm[$key],
							"standard" => $in_item_standard[$key],
							"bom_cnt" => $bom_cnt[$key],
							"in_cnt" => $cnt,
							"lotno" => $t->lot_no
						);
						$this->insert($data);
						
						$new_cnt = $t->stock_cnt-$cnt;
						$sql = "update erp_item set stock_cnt=".$new_cnt." where item_cd='".$in_item_cd[$key]."' and standard='".$in_item_standard[$key]."'";
						//echo $sql."====";
						$this->sub_query($sql);
						break;

					} else if($remain_cnt == $cnt) { // 같다면

						$remain_cnt = $remain_cnt - $cnt;
						$sql = "update erp_stock set out_cnt=".$cnt.", remain_cnt=0, used='y' where uid=".$t->uid;
						//echo $sql."====";
						$this->query($sql);
						$this->registReason($item->uid, $t->uid, 0, $cnt, "생산불출");

						$data = array (
							"table" => "erp_in_item",
							"fid" => $_POST['fid'],
							"item_cd" => $in_item_cd[$key],
							"item_nm" => $in_item_nm[$key],
							"standard" => $in_item_standard[$key],
							"bom_cnt" => $bom_cnt[$key],
							"in_cnt" => $cnt,
							"lotno" => $t->lot_no
						);
						$this->insert($data);
						
						$new_cnt = $t->stock_cnt-$cnt;
						$sql = "update erp_item set stock_cnt=".$new_cnt." where item_cd='".$in_item_cd[$key]."' and standard='".$in_item_standard[$key]."'";
						//echo $sql."====";
						$this->sub_query($sql);
						break;
					} else { // 적다면
						$sql = "update erp_stock set out_cnt=".$remain_cnt.", remain_cnt=0, used='y' where uid=".$t->uid;
						//echo $sql."====";
						$this->query($sql);
						$this->registReason($item->uid, $t->uid, 0, $remain_cnt, "생산불출");
						
						$data = array (
							"table" => "erp_in_item",
							"fid" => $_POST['fid'],
							"item_cd" => $in_item_cd[$key],
							"item_nm" => $in_item_nm[$key],
							"standard" => $in_item_standard[$key],
							"bom_cnt" => $bom_cnt[$key],
							"in_cnt" => $remain_cnt,
							"lotno" => $t->lot_no
						);
						$this->insert($data);
						
						$new_cnt = $t->stock_cnt-$remain_cnt;
						$sql = "update erp_item set stock_cnt=".$new_cnt." where item_cd='".$in_item_cd[$key]."' and standard='".$in_item_standard[$key]."'";
						//echo $sql."====";
						$this->sub_query($sql);

						$cnt = $cnt - $t->remain_cnt;

						$sql = "select * from erp_stock a, (select * from erp_item where item_cd='".$in_item_cd[$key]."' and standard='".$in_item_standard[$key]."') b where a.fid=b.uid and a.used='n' and a.uid > $t->uid order by a.uid asc";
						//echo $sql;
						$this->query($sql);
					}
				}
			}
		}

		// 불량실적등록
		$defective = $_POST['defective'];
		$defect_cnt = $_POST['defect_cnt'];
		$defect_process = $_POST['defect_process'];
		$defect_item_cd = $_POST['defect_item_cd'];
		$defect_item_nm = $_POST['defect_item_nm'];
		$defect_item_standard = $_POST['defect_item_standard'];
		$memo = $_POST['memo'];

		foreach($defective as $key => $val) {
			if($val != "") {
				$data = array (
					"table" => "erp_defective",
					"product_fid" => $_POST['fid'],
					"qc_fid" => 0,
					"item_cd" => $_POST['order_item_cd'],
					"item_nm" => $_POST['work_item_nm'],
					"standard" => $_POST['process_standard'],
					"defect_item_cd" => $defect_item_cd[$key],
					"defect_item_nm" => $defect_item_nm[$key],
					"defect_item_standard" => $defect_item_standard[$key],
					"defective" => $defective[$key],
					"defect_cnt" => $defect_cnt[$key],
					"defect_process" => $defect_process[$key],
					"memo" => $memo[$key]
				);
				//var_dump($data);
				$this->insert($data);
			}
		}

		$this->movePage("production","listPageWorkSheet");
	}
	
	// qc
	public function inputPageQc() {
		require_once ("views/production/erp_createQc.php");
	}

	// 생산계획 등록 처리
	public function registWorkPlan(){
		//$now = date("Y-m-d H:i:s");
		$workplan_cd = "PL-".time();
		$data = array(
			"table" => "erp_workplan",
			"order_cd" => $_POST['order_no'],
			"title" => $_POST['title'],
			"work_gb" => $_POST['work_gb'],
			"workplan_cd" => $workplan_cd,
			"start_dt" => $_POST['start_dt'],
			"end_dt" => $_POST['end_dt'],
			"used" => "n",
			"create_dt" => $this->now
		);

		$this->insert($data);
		
		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard = $_POST['standard'];
		$cnt = $_POST['cnt'];
		$work_start_dt = $_POST['work_start_dt'];
		$work_end_dt = $_POST['work_end_dt'];
		$order_cd = $_POST['order_cd'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_workplan_item",
					"workplan_cd" => $workplan_cd,
					"item_cd" => $item_cd[$key],
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"cnt" => $this->replaceComma($cnt[$key]),
					"work_start_dt" => $work_start_dt[$key],
					"work_end_dt" => $work_end_dt[$key],
					"order_cd" => $order_cd[$key]
				);
				$this->insert($data);
			}
		}

		$this->movePage("production","listPageWorkPlan");
	}
	
	// 생산계획 수정
	public function updateWorkPlan() {
		//$now = date("Y-m-d H:i:s");
		$workplan_cd = "PL-".time();
		$data = array(
			"table" => "erp_workplan",
			"where" => "uid=".$_POST['uid'],
			"title" => $_POST['title'],
			"work_gb" => $_POST['work_gb'],
			"workplan_cd" => $workplan_cd,
			"start_dt" => $_POST['start_dt'],
			"end_dt" => $_POST['end_dt'],
			"create_dt" => $this->now
		);

		$this->update($data);
		
		$sql = "delete * from erp_workplan_item where workplan_cd='".$_POST['workplan_cd']."'";
		mysql_query($sql);

		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard = $_POST['standard'];
		$cnt = $_POST['cnt'];
		$work_start_dt = $_POST['work_start_dt'];
		$work_end_dt = $_POST['work_end_dt'];
		$order_cd = $_POST['order_cd'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_workplan_item",
					"workplan_cd" => $workplan_cd,
					"item_cd" => $item_cd[$key],
					"item_nm" => $item_nm[$key],
					"standard" => $standard[$key],
					"cnt" => $this->replaceComma($cnt[$key]),
					"work_start_dt" => $work_start_dt[$key],
					"work_end_dt" => $work_end_dt[$key],
					"order_cd" => $order_cd[$key]
				);
				$this->insert($data);
			}
		}

		$this->movePage("production","listPageWorkPlan");
	}
	
	
	public function listPageQc(){
		require_once("views/qc/erp_listQc.php");
	}

	// 불량관리
	public function listPageDefective(){
		require_once("views/qc/erp_listDefective.php");
	}

	// 생산계획 수정 페이지
	public function modifyPageWorkPlan(){
		$t = Dba::get($_GET['uid'],"workplan");
		require_once ("views/production/erp_modifyWorkPlan.php");
	}
	
	// 생산계획별 소요자재 현황 조회 리스트 페이지
	public function listPageWorkPlanBom() {
		require_once ("views/production/erp_listWorkPlanBom.php");
	}

	public function viewPageWorkPlanBom() {
		$t = Dba::get($_GET['uid'],"workplan");
		require_once ("views/production/erp_viewWorkPlanBom.php");
	}

	// 원가관리
	public function listPageProductionPrice() {
		require_once ("views/production/erp_listProductionPrice.php");
	}

	// 설비가동률
	public function listPageManpower() {
		require_once ("views/production/erp_listManpower.php");
	}
	
	// 품질관리 결과 등록
	public function registQcReport() {
		// 입고 창고 찾기
		$sql = "select * from erp_qc where uid=".$_POST['uid'];
		$this->query($sql);
		$qc = $this->fetch();
		
		$sql = "select * from erp_work where uid=".$qc->fid;
		$this->query($sql);
		$work = $this->fetch();

		$sql = "select * from erp_order where order_cd='".$work->order_cd."'";
		$this->query($sql);
		$warehouse = $this->fetch();

		// order 의 상태를 변경
		$sql = "update erp_order set state='warehousing' where uid=".$warehouse->uid;
		$this->query($sql);

		// 먼저 erp_qc 의 상태값을 변경한다
		$sql = "update erp_qc set state='complete' where uid=".$_POST['uid'];
		$this->query($sql);

		// report
		$data = array(
			"table" => "erp_qc_report",
			"fid" => $_POST['uid'],
			"test_dt" => date("Y-m-d H:i:s"),
			"emp_id" => $_SESSION['login_id'],
			"item_cd" => $_POST['item_cd'],
			"standard" => $_POST['standard'],
			"order_cnt" => $_POST['order_cnt'],
			"conformity_cnt" => $_POST['conformity_cnt'],
			"nonconformity_cnt" => $_POST['nonconformity_cnt'],
			"lot_no" => $this->getLotNo()
		);

		$this->insert($data);
		$fid = $this->get_insert_id();

		// 적격 상품에 대한 입고 처리
		$sql = "select * from erp_item where item_cd='".$_POST['item_cd']."' and standard='".$_POST['standard']."'";
		$this->query($sql);
		$item = $this->fetch();

		$sid = $this->stockIn($item->uid, $_POST['conformity_cnt'], $warehouse->warehouse_cd);
		$this->registReason($item->uid, $sid, $_POST['conformity_cnt'], 0, "생산입고");

		$qc_nm = $_POST['qc_nm'];
		$cnt = $_POST['cnt'];

		foreach($cnt as $key => $val) {
			if($val != 0) {
				$data = array(
					"table" => "erp_qc_item_report",
					"fid" => $fid,
					"qc_nm" => $qc_nm[$key],
					"cnt" => $val
				);
				$this->insert($data);
				
				// 부적격사유 등록
				$data = array (
					"table" => "erp_defective",
					"product_fid" => 0,
					"qc_fid" => $fid,
					"item_cd" => $_POST['item_cd'],
					"item_nm" => $this->getCompareName("erp_item", "item_nm", "item_cd", $_POST['item_cd']),
					"standard" => $_POST['standard'],
					"defect_item_cd" => $_POST['item_cd'],
					"defect_item_nm" => $this->getCompareName("erp_item", "item_nm", "item_cd", $_POST['item_cd']),
					"defect_item_standard" => $_POST['standard'],
					"defective" =>  $qc_nm[$key],
					"defect_cnt" => $val,
					"defect_process" => "QC",
					"memo" => ""
				);

				$this->insert($data);
			}
		}

		$this->movePage("production","listPageQc");
	}

	public function registQcItem() {
		var_dump($_POST);
	}

	public function viewPageOrderStock() {
		require_once ("views/production/erp_viewOrderStock.php");
	}
/************************************************************************************************************************************************************************************************
:: 구매관리
*************************************************************************************************************************************************************************************************/
public function listPagePurchase() {
		require_once ("views/purchase/erp_listPurchase.php");
	}

	public function listPagePurchaseDemand() {
		require_once ("views/purchase/erp_listPurchaseDemand.php");
	}

	public function listPageAccountWarehousing() {
		require_once ("views/purchase/erp_listAccountWarehousing.php");
	}

	public function listPageItemWarehousing() {
		require_once ("views/purchase/erp_listItemWarehousing.php");
	}

	public function inputPageAccountWarehousing() {
		$t = Dba::get($_GET['uid'],"order_draft");
		require_once ("views/purchase/erp_createAccountWarehousing.php");
	}

	// 구매요청서 입력 페이지
	public function inputPagePurchaseDemand(){
		require_once ("views/purchase/erp_createPurchaseDemand.php");
	}

	// 발주계획 리스트 페이지
	public function listPageOrderPlan() {
		require_once ("views/purchase/erp_listOrderPlan.php");
	}

	// 발주계획 확정등록 페이지
	public function inputPageOrderDraft() {
		require_once ("views/purchase/erp_createOrderDraft.php");
	}

	// 발주서 등록
	public function registOrderDraft() {
		$uid = $_POST['uid'];
		$item_cd = $_POST['item_cd'];
		$standard = $_POST['standard'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$purchase_price = $_POST['purchase_price'];
		$total_price = $_POST['total_price'];
		$account_cd = $_POST['account_cd'];
		$warehouse_cd = $_POST['warehouse_cd'];

		$data = array (
			"table" => "erp_order_draft_plan",
			"where" => "uid=".$_POST['fid'],
			"state" => "order"
		);

		$this->update($data);

		// 발주계획서 상태값 변경
		foreach($uid as $key => $val) {
			$data = array(
				"table" => "erp_purchase_demand",
				"where" => "uid=".$val,
				"state" => "order"
			);
			$this->update($data);
		}
		

		$sql = "
			create TEMPORARY TABLE tem_draft (
				item_cd varchar(50),
				item_nm varchar(50),
				standard varchar(50),
				unit varchar(50),
				barcode varchar(50),
				cnt int(11),
				purchase_price int(11),
				total_price int(11),
				account_cd varchar(50),
				warehouse_cd varchar(50),
				state varchar(50)
			) CHARACTER SET utf8 COLLATE utf8_general_ci;
		";
		mysql_query($sql) or die (mysql_error());

		// 발주서 등록
		foreach($item_cd as $key => $val) {
			$data = array (
				"table" => "tem_draft",
				"item_cd" => $val,
				"standard" => $standard[$key],
				"unit" => $unit[$key],
				"barcode" => $this->getBarcode($val, $standard[$key]),
				"cnt" => $this->replaceComma($cnt[$key]),
				"purchase_price" => $this->replaceComma($purchase_price[$key]),
				"total_price" => $this->replaceComma($total_price[$key]),
				"account_cd" => $account_cd[$key],
				"warehouse_cd" => $warehouse_cd[$key],
				"state" => "order"
			);
			$this->insert($data);
		}

		$sql = "select account_cd, sum(total_price) as total_price from tem_draft group by account_cd";
		$this->query($sql);
		
		// 그룹생성을 위한
		$sql = "select max(gid) as gid from erp_purchase";
		$this->sub_query($sql);
		$gid = $this->sub_fetch();
		if($gid->gid == "") $group = 1;
		else $group = $gid->gid + 1;

		while($t = $this->fetch()) {
			$data = array (
				"table" => "erp_purchase",
				"gid" => $group,
				"account_cd" => $t->account_cd,
				"total_price" => $t->total_price,
				"payable" => "y",
				"payable_price" => $t->total_price,
				"payment" => 0,
				"create_dt" => date("Y-m-d H:i:s")
			);
			$this->insert($data);
		}
		
		$item_cd = $_POST['item_cd'];
		$standard = $_POST['standard'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$purchase_price = $_POST['purchase_price'];
		$total_price = $_POST['total_price'];
		$account_cd = $_POST['account_cd'];
		$warehouse_cd = $_POST['warehouse_cd'];

		// 발주서 등록
		foreach($item_cd as $key => $val) {
			$sql = "select uid from erp_purchase where gid=".$group." and account_cd='".$account_cd[$key]."'";
			$this->query($sql);
			$purchase = $this->fetch();

			$data = array (
				"table" => "erp_order_draft",
				"fid" => $purchase->uid,
				"item_cd" => $val,
				"standard" => $standard[$key],
				"unit" => $unit[$key],
				"barcode" => $this->getBarcode($val, $standard[$key]),
				"cnt" => $this->replaceComma($cnt[$key]),
				"purchase_price" => $this->replaceComma($purchase_price[$key]),
				"total_price" => $this->replaceComma($total_price[$key]),
				"account_cd" => $account_cd[$key],
				"warehouse_cd" => $warehouse_cd[$key],
				"state" => "order",
				"create_dt" => $this->now
			);
			$this->insert($data);
		}

		$sql = "drop table tem_draft";
		$this->query($sql);

		$this->movePage("purchase","listPageOrderDraft");
	}

	// 발주리스트
	public function listPageOrder() {
		require_once ("views/purchase/erp_listOrder.php");
	}
	
	// 구매요청 등록
	public function registPurchaseDemand() {
		$data = array(
			"table" => "erp_purchase",
			"purchase_cd" => $this->createCode("purchase_cd", "erp_purchase"),
			"title" => $_POST['title'],
			"purchase_type" => $_POST['purchase_type'],
			"order_cd" => $_POST['order_cd'],
			"work_cd" => $_POST['work_cd'],
			"big_department_cd" => $_POST['big_department_cd'],
			"middle_department_cd" => $_POST['middle_department_cd'],
			"small_department_cd" => $_POST['small_department_cd'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"delivery_dt" => $_POST['delivery_dt'],
			"emp_id" => $_POST['emp_id'],
			"state" => "demand",
			"payable" => "y",
			"payable_price" => 0,
			"payment" => 0,
			"approval" => "n",
			"create_dt" => $this->now
		);
		$this->insert($data);
		$fid = $this->get_insert_id();
		
		/*
		$sql = "update erp_order set state='buying' where uid=".$_POST['fid'];
		$this->query($sql);

		// 해당 주문품목에 대한 자재구매요청 상태값 변경
		$sql = "update erp_order_item set draft='y' where uid=".$_POST['uid'];
		$this->query($sql);
		*/

		$item_cd = $_POST['item_cd'];
		$standard = $_POST['standard'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$purchase_price = $_POST['purchase_price'];

		foreach($item_cd as $key => $val) {
			if(!empty($val)) {
				$total_price = $this->replaceComma($cnt[$key]) * $this->replaceComma($purchase_price[$key]);
				$data = array(
					"table" => "erp_purchase_item",
					"fid" => $fid,
					"item_cd" => $item_cd[$key],
					"standard" => $standard[$key],
					"unit" => $unit[$key],
					"cnt" => $this->replaceComma($cnt[$key]),
					"purchase_price" => $this->replaceComma($purchase_price[$key]),
					"total_price" => $this->replaceComma($total_price),
					"state" => "demand"
				);
				$this->insert($data);
			}
		}

		$this->movePage("purchase","listPagePurchaseDemand");
	}
	
	// 구매요청서 수정
	public function updatePurchaseDemand() {
		$data = array(
			"table" => "erp_purchase",
			"where" => "uid=".$_POST['uid'],
			"title" => $_POST['title'],
			"purchase_type" => $_POST['purchase_type'],
			"order_cd" => $_POST['order_cd'],
			"work_cd" => $_POST['work_cd'],
			"big_department_cd" => $_POST['big_department_cd'],
			"middle_department_cd" => $_POST['middle_department_cd'],
			"small_department_cd" => $_POST['small_department_cd'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"delivery_dt" => $_POST['delivery_dt'],
			"emp_id" => $_POST['emp_id'],
			"state" => "demand",
			"payable" => "y",
			"payable_price" => 0,
			"payment" => 0,
			"approval" => "n"
		);
		$this->update($data);
		$fid = $_POST['uid'];

		// 아이템 삭제
		$sql = "delete from erp_purchase_item where fid=".$fid;
		$this->query($sql);
		
		$item_cd = $_POST['item_cd'];
		$standard = $_POST['standard'];
		$unit = $_POST['unit'];
		$cnt = $_POST['cnt'];
		$purchase_price = $_POST['purchase_price'];

		foreach($item_cd as $key => $val) {
			if(!empty($val)) {
				$total_price = $this->replaceComma($cnt[$key]) * $this->replaceComma($purchase_price[$key]);
				$data = array(
					"table" => "erp_purchase_item",
					"fid" => $fid,
					"item_cd" => $item_cd[$key],
					"standard" => $standard[$key],
					"unit" => $unit[$key],
					"cnt" => $this->replaceComma($cnt[$key]),
					"purchase_price" => $this->replaceComma($purchase_price[$key]),
					"total_price" => $this->replaceComma($total_price),
					"state" => "demand"
				);
				$this->insert($data);
			}
		}

		$this->movePage("purchase","listPagePurchaseDemand");
	}

	// 구매요청서 수정 페이지
	public function modifyPagePurchaseDemand(){
		$t = Dba::get($_GET['uid'],"purchase");
		require_once ("views/purchase/erp_modifyPurchaseDemand.php");
	}

	// 구매요청서 수정 페이지
	public function viewPagePurchaseDemand(){
		$t = Dba::get($_GET['purchase_cd'],"purchase_demand");
		require_once ("views/purchase/erp_viewPurchaseDemand.php");
	}

	public function inputPagePurchase() {
		require_once ("views/purchase/erp_createPurchase.php");
	}

	// 발주계획서 리스트 페이지
	public function listPagePurchasePlan(){
		require_once ("views/purchase/erp_listPurchasePlan.php");
	}

	// 발주계획서 등록 페이지
	public function inputPagePurchasePlan() {
		require_once ("views/purchase/erp_createPurchasePlan.php");
	}

	// 발주계획서 수정 페이지
	public function modifyPagePurchasePlan() {
		require_once ("views/purchase/erp_modifyPurchasePlan.php");
	}
	
	// 바코드 입고 페이지
	public function listPageBarcodeWarehousing() {
		require_once ("views/purchase/erp_listBarcodeWarehousing.php");
	}

	// 미지급금 리스트
	public function listPageAccountPavable(){
		require_once ("views/purchase/erp_listAccountPavable.php");
	}
/************************************************************************************************************************************************************************************************
:: 재고관리
*************************************************************************************************************************************************************************************************/
// 창고재고 페이지
	public function listPageWarehouseStock(){
		require_once ("views/items/erp_listWarehouseStock.php");
	}

	public function listPageStock() {
		require_once ("views/items/erp_listStock.php");
	}

	public function modifyPageStock() {
		$t = Dba::get($_GET['uid'],"stock");
		require_once ("views/items/erp_modifyItem.php");
	}
	
	// 안전재고관리 리스트 페이지
	public function listPageSafetyStock() {
		require_once ("views/items/erp_listSafetyStock.php");
	}

	// 단가관리
	public function listPageStockPrice(){
		require_once ("views/items/erp_listStockPrice.php");
	}

	// 재고실사
	public function listPageRealStock() {
		require_once ("views/items/erp_listRealStock.php");
	}

	// 바코드 리스트
	public function listPageBarcode() {
		require_once ("views/items/erp_listBarcode.php");
	}

	public function inputPageBarcode() {
		$t = Dba::get($_GET['uid'],"item");
		require_once ("views/items/erp_createBarcode.php");
	}

	public function updateBarcode(){
		$data = array (
			"table" => "erp_item",
			"where" => "uid=".$_POST['uid'],
			"in_barcode" => $_POST['in_barcode'],
			"barcode" => $_POST['barcode']
		);

		$this->update($data);
		$this->listPageBarcode();
	}

	// 출고요청리스트
	public function listPageRelease(){
		require_once("views/items/erp_listRelease.php");
	}

	// 출고요청 상세 페이지
	public function modifyPageRelease() {
		$t = Dba::get($_GET['uid'],"release");
		require_once ("views/items/erp_modifyRelease.php");
	}

	// 자재수불부
	public function listPageItemInout() {
		require_once ("views/items/erp_listItemInout.php");
	}

	// 바코드 출고
	public function listPageBarcodeRelease() {
		require_once ("views/items/erp_listBarcodeRelease.php");
	}

	// Lot No 추적
	public function listPageLotNo() {
		require_once ("views/items/erp_listLotNo.php");
	}

	public function viewPageLotNo() {
		require_once ("views/items/erp_viewLotNo.php");
	}

	// 출하등록
	public function registShipment() {
		$cost = $this->replaceComma($_POST['cost']);
		$data = array(
			"table" => "erp_shipment_report",
			"fid" => $_POST['uid'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"shipment_dt" => $_POST['shipment_dt'],
			"shipment_reason" => $_POST['shipment_reason'],
			"emp_id" => $_SESSION['login_id'],
			"account_cd" => $_POST['account_cd'],
			"rent_uid" => $_POST['rent_uid'],
			"zipcode" => $_POST['zipcode'],
			"address" => $_POST['address'],
			"start_position" => $_POST['start_position'],
			"end_position" => $_POST['end_position'],
			"cost" => $_POST['cost']
		);

		$this->insert($data);

		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard = $_POST['standard'];
		$cnt = $_POST['cnt'];

		foreach($item_cd as $key => $val) {
			if($val != "") {
				// 출하잔여 수량을 구하기 위하여 출하지시수량을 가져온다
				$sql = "select uid, shipment_cnt, remain_shipment_cnt from erp_shipment_item where item_cd='".$val."' and standard='".$standard[$key]."' and fid=".$_POST['uid'];
				$this->query($sql);
				$shipment = $this->fetch();
				
				$remain_cnt = $shipment->remain_shipment_cnt - $cnt[$key];

				if($remain_cnt > 0) { // 잔여출하수량이 남았다면
					$state = "shipmenting";
				} else if($remain_cnt == 0) { // 잔여출하수량이 남지 않았다면
					$state = "complete";
				}
				
				$sql = "update erp_shipment_item set remain_shipment_cnt=".$remain_cnt.", state='".$state."' where uid=".$shipment->uid;
				$this->query($sql);
				$sql = "update erp_shipment set state='".$state."' where uid=".$_POST['uid'];
				$this->query($sql);

				// 수주상태도 변경한다
				$sql = "select order_cd from erp_shipment where uid=".$_POST['uid'];
				$this->query($sql);
				$order = $this->fetch();
				$sql = "update erp_order set state='".$state."' where order_cd='".$order->order_cd."'";
				$this->query($sql);

				// 출고를 위한 품목의 유니크 번호 획득
				$sql = "select uid from erp_item where item_cd='".$val."' and standard='".$standard[$key]."'";
				$this->query($sql);
				$item = $this->fetch();

				// 출하품목 선입선출처리
				$fid = $this->firstInFirstOut($item->uid, $_POST['warehouse_cd'], $cnt[$key]);
				// 출하사유 등록
				$this->registReason($item->uid, 0, 0, $cnt[$key], "출하");
			}
		}

		$this->movePage("items","listPageShipment");
	}
/************************************************************************************************************************************************************************************************
:: 그룹웨어
*************************************************************************************************************************************************************************************************/
// 결재 리스트
	public function inputPageApproval(){
		require_once ('views/groupware/erp_createApproval.php');
	}

	public function inputPageApprovalLine(){
		require_once ("views/groupware/erp_createApprovalLine.php");
	}

	public function viewPageApproval() {
		$t = Dba::get($_GET['uid'],"approval");
		require_once ("views/groupware/erp_viewApproval.php");
	}

	public function viewPageMyApproval() {
		$t = Dba::get($_GET['uid'],"approval");
		require_once ("views/groupware/erp_viewMyApproval.php");
	}
	
	public function download() {
		require_once ("attach/".$_GET['file']);
	}


	public function listPageApprovalLine() {
		require_once ("views/groupware/erp_listApprovalLine.php");
	}
	
	// 결재라인 등록
	public function registApprovalLine() {
		if($_POST['uid'] == "") {
			$data = array(
				"table" => "erp_approval_line",
				"approval_nm" => $_POST['approval_nm'],
				"emp_id" => $_SESSION['login_id']
			);
			$this->insert($data);
			$fid = $this->getUid();
			$i = 1;
			foreach($_POST['to'] as $key=>$value) {
				$data = array(
					"table" => "erp_approval_emp",
					"fid" => $fid,
					"emp_id" => $value,
					"seq" => $i
				);
				$this->insert($data);
				$i++;
			}
		} else {
			$data = array(
				"table" => "erp_approval_line",
				"where" => "uid=".$_POST['uid'],
				"approval_nm" => $_POST['approval_nm'],
				"emp_id" => $_SESSION['login_id']
			);
			$this->update($data);

			$sql = "delete from erp_approval_emp where fid=".$_POST['uid'];
			$this->query($sql);

			$i = 1;
			foreach($_POST['to'] as $key=>$value) {
				$data = array(
					"table" => "erp_approval_emp",
					"fid" => $_POST['uid'],
					"emp_id" => $value,
					"seq" => $i
				);
				$this->insert($data);
				$i++;
			}
		}
		$this->movePage("groupware","listPageApprovalLine");
	}
	
	// 결재라인수정
	public function modifyPageApprovalLine() {
		$t = Dba::get($_GET['uid'],"approval_line");
		require_once ("views/groupware/erp_modifyApprovalLine.php");
	}
	
	// 기안등록
	public function registApproval(){
		$fileAttach = $this->upload('attach');
		$data = array(
			"table" => "erp_approval",
			"approval_cd" => $_POST['approval_cd'],
			"title" => $_POST['title'],
			"approval_line" => $_POST['approval_uid'],
			"refer" => $_POST['emp_id'],
			"comment" => $_POST['comment'],
			"purchase_cd" => $_POST['purchase_cd'],
			"estimate_cd" => $_POST['estimate_cd'],
			"spending_cd" => $_POST['spending_cd'],
			"shipment_cd" => $_POST['shipment_cd'],
			"attach" => $fileAttach,
			"document" => $_POST['document'],
			"state" => "stay",
			"big_department_cd" => $_POST['big_department_cd'],
			"middle_department_cd" => $_POST['middle_department_cd'],
			"small_department_cd" => $_POST['small_department_cd'],
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $this->now
		);
		
		$this->insert($data);
		$fid = $this->getUid();
		
		$this->registApprovalCheck($fid,$_POST['approval_uid']);
		$this->movePage("groupware","listPageMyApproval");

	}

	// 기안수정
	public function updateApproval(){
		// 넘어온 uid 를 가지고 해당 기안서가 return 또는 hold 였나 확인
		$sql = "select state erp_approval where uid=".$_POST['uid'];
		$this->query($sql);
		$approval = $this->fetch();

		if($approval->state == "return") {
			$sql = "update erp_approval_check set sign='n' where fid=".$_POST['uid'];
			$this->query($sql);
		}

		$fileAttach = $this->upload('attach');
		$data = array(
			"table" => "erp_approval",
			"where" => "uid=".$_POST['uid'],
			"title" => $_POST['title'],
			"approval_line" => $_POST['approval_uid'],
			"refer" => $_POST['emp_id'],
			"comment" => $_POST['comment'],
			"purchase_cd" => $_POST['purchase_cd'],
			"estimate_cd" => $_POST['estimate_cd'],
			"spending_cd" => $_POST['spending_cd'],
			"shipment_cd" => $_POST['shipment_cd'],
			"attach" => $fileAttach,
			"document" => $_POST['document'],
			"state" => "stay",
			"big_department_cd" => $_POST['big_department_cd'],
			"middle_department_cd" => $_POST['middle_department_cd'],
			"small_department_cd" => $_POST['small_department_cd'],
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $this->now
		);
		
		$this->update($data);
		$fid = $_POST['uid'];
		
		$this->registApprovalCheck($fid,$_POST['approval_uid']);
		$this->movePage("groupware","listPageMyApproval");

	}

	// 기안 결재자 등록
	public function registApprovalCheck($fid,$approval_uid){
		try {
			$sql = "delete from erp_approval_check where fid=".$fid;
			$this->query($sql);
		} catch (Exception $e) {}

		$sql = "select * from erp_approval_emp where fid=". $approval_uid;
		$this->query($sql);
		while($t = $this->fetch()) {
			$data = array(
				"table" => "erp_approval_check",
				"fid" => $fid,
				"emp_id" => $t->emp_id,
				"sign" => "n",
				"seq" => $t->seq,
				"sign_dt" => ""
			);

			$this->insert($data);
		}
	}

	// 계정과목관리
	public function inputPageAccountSubject() {
		require_once ("views/groupware/erp_createAccountSubject.php");
	}

	public function listPageApproval(){
		require_once("views/groupware/erp_listApproval.php");
	}
	
	// 나의 기안함
	public function listPageMyApproval(){
		require_once("views/groupware/erp_listMyApproval.php");
	}

	public function modifyPageApproval() {
		$t = Dba::get($_GET['uid'],"approval");
		require_once ("views/groupware/erp_modifyApproval.php");
	}

	
	// 파일리스트
	public function listPageFile(){
		require_once("views/groupware/erp_listFile.php");
	}

	// 파일등록 페이지
	public function inputPageFile() {
		require_once("views/groupware/erp_createFile.php");
	}
	
	// 파일등록
	public function registFile() {
		$fileAttach = $this->upload('attach');

		if($_POST['uid'] != "") {
			$data = array(
				"table" => "erp_file",
				"where" => "uid=".$_POST['uid'],
				"title" => $_POST['title'],
				"classification" => $_POST['classification'],
				"attach" => $fileAttach,
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => $this->now
			);
			$this->update($data);
		} else {
			$data = array(
				"table" => "erp_file",
				"title" => $_POST['title'],
				"classification" => $_POST['classification'],
				"attach" => $fileAttach,
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => $this->now
			);
			$this->insert($data);
		}

		$this->movePage("groupware","listPageFile");
	}
	
	public function modifyPageFile() {
		$t = Dba::get($_GET['uid'],"file");
		require_once ("views/groupware/erp_modifyFile.php");
	}

	// 업무공유 리스트
	public function listPageBoard(){
		require_once("views/groupware/erp_listBoard.php");
	}

	// 업무공유 페이지
	public function inputPageBoard() {
		require_once("views/groupware/erp_createBoard.php");
	}
	
	// 업무공유 등록
	public function registBoard() {
		if(empty($_POST['uid'])) {
			$fileAttach = $this->upload('attach');
			$data = array(
				"table" => "erp_board",
				"title" => $_POST['title'],
				"classification" => $_POST['classification'],
				"comment" => $_POST['comment'],
				"attach" => $fileAttach,
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => $this->now
			);

			$this->insert($data);
		} else {
			$data = array(
				"table" => "erp_board",
				"where" => "uid=".$_POST['uid'],
				"title" => $_POST['title'],
				"classification" => $_POST['classification'],
				"comment" => $_POST['comment'],
				"emp_id" => $_SESSION['login_id'],
				"create_dt" => $this->now
			);

			$this->update($data);
		}
		$this->movePage("groupware","listPageBoard");
	}

	// 업무공유 내용보기
	public function modifyPageBoard() {
		$t = Dba::get($_GET['uid'],"board");
		require_once ("views/groupware/erp_modifyBoard.php");
	}

	// 공용품 리스트
	public function listPagePublicThing(){
		require_once("views/groupware/erp_listPublicThing.php");
	}

	// 공용품 페이지
	public function inputPagePublicThing() {
		require_once("views/groupware/erp_createPublicThing.php");
	}
	
	// 공용품 등록
	public function registPublicThing() {
		$fileAttach = $this->upload('attach');

		$in = explode("-",$_POST['in_dt']);
		$in_time = mktime(0,0,0,$in[1],$in[2],$in[0]);

		switch($_POST['change_classification']) {
			case "day" :
				$alarm_dt = $in_time + ($_POST['change_day'] * 86400);
			break;

			case "week" :
				$alarm_dt = $in_time + ($_POST['change_day'] * 86400 * 7);
			break;

			case "month" :
				$alarm_dt = $in_time + ($_POST['change_day'] * 86400 * 30);
			break;

			case "year" :
				$alarm_dt = $in_time + ($_POST['change_day'] * 86400 * 365);
			break;
		}

		$alarm = date("Y-m-d",$alarm_dt);
		
		if($_POST['uid'] != "") {
			$data = array(
				"table" => "erp_public_thing",
				"where" => "uid=".$_POST['uid'],
				"item_nm" => $_POST['item_nm'],
				"classification" => $_POST['classification'],
				"in_dt" => $_POST['in_dt'],
				"change_day" => $_POST['change_day'],
				"change_classification" => $_POST['change_classification'],
				"alarm_dt" => $alarm,
				"charge_id" => $_POST['emp_id'],
				"charge_nm" => $_POST['emp_nm'],
				"attach" => $fileAttach,
				"create_dt" => $this->now
			);
			$this->update($data);
		} else {
			$data = array(
				"table" => "erp_public_thing",
				"item_nm" => $_POST['item_nm'],
				"classification" => $_POST['classification'],
				"in_dt" => $_POST['in_dt'],
				"change_day" => $_POST['change_day'],
				"change_classification" => $_POST['change_classification'],
				"alarm_dt" => $alarm,
				"charge_id" => $_POST['emp_id'],
				"charge_nm" => $_POST['emp_nm'],
				"attach" => $fileAttach,
				"create_dt" => $this->now
			);
			$this->insert($data);
		}

		$this->movePage("groupware","listPagePublicThing");

	}

	public function modifyPagePublicThing(){
		$t = Dba::get($_GET['uid'],"public_thing");
		require_once("views/groupware/erp_modifyPublicThing.php");
	}

	// 차량 리스트
	public function listPageCar(){
		require_once("views/groupware/erp_listCar.php");
	}

	// 차량 리스트
	public function modifyPageCar(){
		$t = Dba::get($_GET['uid'],"car");
		require_once("views/groupware/erp_modifyCar.php");
	}

	// 차량등록 페이지
	public function inputPageCar() {
		require_once("views/groupware/erp_createCar.php");
	}
	
	// 차량 등록 실행
	public function registCar() {

		if($_POST['uid'] != "") {
			$data = array(
				"table" => "erp_car",
				"where" => "uid=".$_POST['uid'],
				"car_no" => $_POST['car_no'],
				"classification" => $_POST['classification'],
				"in_dt" => $_POST['in_dt'],
				"charge_id" => $_POST['emp_id'],
				"charge_nm" => $_POST['emp_nm']
			);
			$this->update($data);
		} else {
			$data = array(
				"table" => "erp_car",
				"car_no" => $_POST['car_no'],
				"classification" => $_POST['classification'],
				"in_dt" => $_POST['in_dt'],
				"charge_id" => $_POST['emp_id'],
				"charge_nm" => $_POST['emp_nm']
			);
			$this->insert($data);
		}

		$this->movePage("groupware","listPageCar");
	}

	public function listPageSchedule(){
		require_once("views/groupware/erp_listSchedule.php");
	}

	// 월간일정
	public function listPageScheduleMonth(){
		require_once("views/groupware/erp_listScheduleMonth.php");
	}

	//주간일정
	public function listPageScheduleWeek(){
		require_once("views/groupware/erp_listScheduleWeek.php");
	}

	//일간일정
	public function listPageScheduleDay(){
		require_once("views/groupware/erp_listScheduleDay.php");
	}
	
	// 일정등록
	public function inputPageSchedule(){
		require_once("views/groupware/erp_createSchedule.php");
	}

	// 일정상세
	public function modifyPageSchedule() {
		$t = Dba::get($_GET['uid'],"schedule");
		require_once("views/groupware/erp_modifySchedule.php");
	}
	
	// 일정등록
	public function registSchedule() {
		if(!empty($_POST['uid'])) {
			$data = array(
				"table"=>"erp_schedule",
				"where"=>"uid=".$_POST['uid'],
				"title"=>$_POST['title'],
				"anniversary"=>$_POST['anniversary'],
				"classification"=>$_POST['classification'],
				"name"=>$_POST['name'],
				"schedule_dt"=>$_POST['schedule_dt'],
				"schedule_tm"=>$_POST['schedule_tm'],
				"place"=>$_POST['place'],
				"importance"=>$_POST['importance'],
				"memo"=>$_POST['memo'],
				"emp_id"=>$_SESSION['login_id']
			);
			$this->update($data);
		} else {
			$data = array(
				"table"=>"erp_schedule",
				"title"=>$_POST['title'],
				"anniversary"=>$_POST['anniversary'],
				"classification"=>$_POST['classification'],
				"name"=>$_POST['name'],
				"schedule_dt"=>$_POST['schedule_dt'],
				"schedule_tm"=>$_POST['schedule_tm'],
				"place"=>$_POST['place'],
				"importance"=>$_POST['importance'],
				"memo"=>$_POST['memo'],
				"emp_id"=>$_SESSION['login_id']
			);
			$this->insert($data);
		}

		$this->movePage("groupware","listPageSchedule");
	}

	// 출퇴근관리
	public function listPageEmpWorkLeave(){
		require_once("views/groupware/erp_listEmpWorkLeave.php");
	}

	// 업무공유 리스트
	public function listPageVersion(){
		require_once("views/groupware/erp_listVersion.php");
	}

	// 업무공유 페이지
	public function inputPageVersion() {
		require_once("views/groupware/erp_createVersion.php");
	}
	
	// 업무공유 등록
	public function registVersion() {
		//$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_version",
			"target" => $_POST['target'],
			"title" => $_POST['title'],
			"version" => $_POST['version'],
			"version_code" => $_POST['version_code'],
			"comment" => $_POST['comment'],
			"create_dt" => $this->now
		);

		$this->insert($data);

		$this->movePage("groupware","listPageVersion");

	}

	
	public function listPageError(){
		require_once("views/groupware/erp_listError.php");
	}

	// 업무공유 페이지
	public function inputPageError() {
		require_once("views/groupware/erp_createError.php");
	}
	
	// 업무공유 등록
	public function registError() {
		//$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_error",
			"account" => $_POST['account'],
			"title" => $_POST['title'],
			"comment" => $_POST['comment'],
			"create_dt" => $this->now
		);

		$this->insert($data);

		$this->movePage("groupware","listPageError");

	}

	// 출하지시서
	public function listPageShipment() {
		require_once("views/items/erp_listShipment.php");
	}

	// 출하 등록
	public function inputPageShipmentOrder() {
		require_once ("views/items/erp_createShipment.php");
	}

	// 미지급금
	public function listPageAmountPayable() {
		require_once("views/purchase/erp_listAmountPayable.php");
	}

	// 외주공정 리스트
	public function listPageOutsourcing() {
		require_once("views/outsourcing/erp_listOutsourcing.php");
	}

	// 외주공정 등록
	public function inputPageOutsourcing() {
		require_once("views/outsourcing/erp_createOutsourcing.php");
	}

	// 바코드로 입고된 상품을 등록
	public function registBarcodePuchaseItem() {
		$uid = $_POST['uid'];
		$item_cd = $_POST['item_cd'];
		$standard = $_POST['standard'];
		$cnt = $_POST['cnt'];
		$warehouse = $_POST['warehouse'];

		foreach($uid as $key => $val) {
			if($val == "") { // 구매요청서에 없는 품목이 주문이 되었다면
				$sql = "select uid from erp_item where item_cd='".$item_cd[$key]."' and standard='".$standard[$key]."'";
				$this->query($sql);
				$item = $this->fetch();

				$sql = "select purchase_price from erp_item_price where gid=".$item->uid;
				$this->query($sql);
				$price = $this->fetch();

				// 입고된 물품 입고처리
				$fid = $this->stockIn($item->uid, $cnt[$key], $warehouse[$key]);	
				$this->registReason($item->uid, $fid, $cnt[$key], 0, "구매입고");
				$this->registPrice($item->uid, $fid, $price->purchase_price,0);
			} else {
				$sql = "select uid from erp_item where item_cd='".$item_cd[$key]."' and standard='".$standard[$key]."'";
				$this->query($sql);
				$item = $this->fetch();

				$sql = "select purchase_price from erp_item_price where gid=".$item->uid;
				$this->query($sql);
				$price = $this->fetch();

				// 입고된 물품 입고처리
				$fid = $this->stockIn($item->uid, $cnt[$key], $warehouse[$key]);	
				$this->registReason($item->uid, $fid, $cnt[$key], 0, "구매입고");
				$this->registPrice($item->uid, $fid, $price->purchase_price,0);

				// 입고 완료 처리
				$sql = "update erp_order_draft_item set state='complete' where uid=".$val;
				$this->query($sql);

				$sql = "select fid from erp_order_draft_item where uid=".$val;
				$this->query($sql);
				$draft = $this->fetch();

				// 발주서를 입고완료 처리해야 한다
				$sql = "select * from erp_order_draft_item where state='ready' and fid=".$draft->fid;
				$this->query($sql);

				if($this->get_rows() < 1) {
					$sql = "update erp_order_draft set state='complete' where uid=".$draft->fid;
					$this->query($sql);
				}
			}
		}

		$this->movePage("purchase","listPageBarcodeWarehousing");
	}

	// 금형
	public function listPageMold() {
		require_once("views/production/erp_listMold.php");
	}

	public function inputPageMold() {
		require_once("views/production/erp_createMold.php");
	}

	public function registMold() {
		$data = array (
			"table" => "erp_mold",
			"a" => $_POST['a'],
			"b" => $_POST['b'],
			"c" => $_POST['c'],
			"d" => $_POST['d'],
			"e" => $_POST['e'],
			"f" => $_POST['f'],
			"g" => $_POST['g'],
			"h" => $_POST['h'],
			"i" => $_POST['i'],
			"j" => $_POST['j'],
			"k" => $_POST['k'],
			"l" => $_POST['l'],
			"m" => $_POST['m'],
			"n" => $_POST['n'],
			"o" => $_POST['o'],
			"p" => $_POST['p'],
			"q" => $_POST['q'],
			"r" => $_POST['r'],
			"s" => $_POST['s'],
			"account_cd" => $_POST['account_cd'],
		);
		$this->insert($data);
		$this->movePage("production","listPageMold");
	}

	public function modifyPageMold() {
		$t = Dba::get( $_GET['uid'], "mold" );
		require_once("views/production/erp_modifyMold.php");
	}

	public function updateMold() {
		$data = array (
			"table" => "erp_mold",
			"where" => "uid=".$_POST['uid'],
			"a" => $_POST['a'],
			"b" => $_POST['b'],
			"c" => $_POST['c'],
			"d" => $_POST['d'],
			"e" => $_POST['e'],
			"f" => $_POST['f'],
			"g" => $_POST['g'],
			"h" => $_POST['h'],
			"i" => $_POST['i'],
			"j" => $_POST['j'],
			"k" => $_POST['k'],
			"l" => $_POST['l'],
			"m" => $_POST['m'],
			"n" => $_POST['n'],
			"o" => $_POST['o'],
			"p" => $_POST['p'],
			"q" => $_POST['q'],
			"r" => $_POST['r'],
			"s" => $_POST['s'],
			"account_cd" => $_POST['account_cd'],
		);
		$this->update($data);
		$this->movePage("production","listPageMold");
	}

	// 작업현황판
	public function currentWorkState() {
		require_once("views/production/erp_currentWorkState.php");
	}

	// 외주발주 등록 실행
	public function registOutsourcing() {
		$data = array(
			"table" => "erp_outsourcing",
			"work_cd" => $_POST['work_cd'],
			"order_cd" => $_POST['order_cd'],
			"release_type" => $_POST['release_type'],
			"account_cd" => $_POST['account_cd'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"expectation_warehousing_dt" => $_POST['expectation_warehousing_dt'],
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $this->now
		);

		
		$this->insert($data);
		$fid = $this->get_insert_id();
		
		// 작업지시품목
		$out_item_cd = $_POST['out_item_cd'];
		$out_standard = $_POST['out_standard'];
		$out_cnt = $_POST['out_cnt'];		

		foreach($out_item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_outsourcing_item",
					"fid" => $fid,
					"item_cd" => $val,
					"standard" => $out_standard[$key],
					"cnt" => $out_cnt[$key]
				);
				$this->insert($data);
			}
		}
		
		// 출고품목
		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard = $_POST['standard'];
		$cnt = $_POST['cnt']; // 소요량
		$purchase_price = $_POST['purchase_price'];
		$sale_price = $_POST['sale_price'];
		$release_cnt = $_POST['release_cnt'];
		$current_cnt = $_POST['current_cnt'];
		$purchase_cnt = $_POST['purchase_cnt'];

		// 출고요청서
		$data = array(
			"table" => "erp_release",
			"release_cd" => $this->createCode("release_cd", "erp_release"),
			"work_cd" => $_POST['work_cd'],
			"warehouse_cd" => "",
			"release_type" => "외주불출",
			"title" => $this->getCompareName("erp_account", "account_nm", "account_cd", $_POST['account_cd'])." 외주생산 불출요청",
			"state" => "demand",
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $this->now
		);
		
		$this->insert($data);
		$fid = $this->get_insert_id();

		// 출고품목
		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_release_item",
					"fid" => $fid,
					"item_cd" => $val,
					"standard" => $standard[$key],
					"cnt" => $this->replaceComma($release_cnt[$key]),		
					"remain_cnt" => $this->replaceComma($release_cnt[$key]),	
					"purchase_price" => $this->replaceComma($purchase_price[$key]),
					"sale_price" => $this->replaceComma($sale_price[$key])
				);
				$this->insert($data);
			}
		}
		
		$this->movePage("production","listPageOutsourcing");
	}

	// 외주발주 수정 실행
	public function updateOutsourcing() {
		$data = array(
			"table" => "erp_outsourcing",
			"where" => "uid=".$_POST['uid'],
			"work_cd" => $_POST['work_cd'],
			"order_cd" => $_POST['order_cd'],
			"release_type" => $_POST['release_type'],
			"account_cd" => $_POST['account_cd'],
			"warehouse_cd" => $_POST['warehouse_cd'],
			"expectation_warehousing_dt" => $_POST['expectation_warehousing_dt'],
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $this->now
		);

		
		$this->update($data);
		$fid = $_POST['uid'];
		
		// 작업지시품목
		$out_item_cd = $_POST['out_item_cd'];
		$out_standard = $_POST['out_standard'];
		$out_cnt = $_POST['out_cnt'];		
		
		$sql = "delete from erp_outsourcing_item where fid=".$fid;
		$this->query($sql);

		foreach($out_item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_outsourcing_item",
					"fid" => $fid,
					"item_cd" => $val,
					"standard" => $out_standard[$key],
					"cnt" => $out_cnt[$key]
				);
				$this->insert($data);
			}
		}
		
		// 출고품목
		$item_cd = $_POST['item_cd'];
		$item_nm = $_POST['item_nm'];
		$standard = $_POST['standard'];
		$cnt = $_POST['cnt']; // 소요량
		$purchase_price = $_POST['purchase_price'];
		$sale_price = $_POST['sale_price'];
		$release_cnt = $_POST['release_cnt'];
		$current_cnt = $_POST['current_cnt'];
		$purchase_cnt = $_POST['purchase_cnt'];
		
		$sql = "select uid from erp_release where work_cd='".$_POST['work_cd']."'";
		$this->query($sql);
		$release = $this->fetch();

		$sql = "delete from erp_release where uid=".$release->uid;
		$this->query($sql);

		$sql = "delete from erp_release_item where fid=".$release->uid;
		$this->query($sql);

		// 출고요청서
		$data = array(
			"table" => "erp_release",
			"release_cd" => $this->createCode("release_cd", "erp_release"),
			"work_cd" => $_POST['work_cd'],
			"warehouse_cd" => "",
			"release_type" => "외주불출",
			"title" => $this->getCompareName("erp_account", "account_nm", "account_cd", $_POST['account_cd'])." 외주생산 불출요청",
			"state" => "demand",
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $this->now
		);
		
		$this->insert($data);
		$fid = $this->get_insert_id();

		// 출고품목
		foreach($item_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_release_item",
					"fid" => $fid,
					"item_cd" => $val,
					"standard" => $standard[$key],
					"cnt" => $this->replaceComma($release_cnt[$key]),	
					"remain_cnt" => $this->replaceComma($release_cnt[$key]),	
					"purchase_price" => $this->replaceComma($purchase_price[$key]),
					"sale_price" => $this->replaceComma($sale_price[$key])
				);
				$this->insert($data);
			}
		}
		
		$this->movePage("production","listPageOutsourcing");
	}

	// 외주수정
	public function modifyPageOutsourcing() {
		$t = Dba::get($_GET['uid'], "outsourcing");
		require_once ("views/outsourcing/erp_modifyOutsourcing.php");
	}

	// 출고요청서 상세
	public function viewPageRelease() {
		require_once ("views/items/erp_viewRelease.php");
	}

	// 생산계획표
	public function viewPageWorkPlan() {
		require_once ("views/production/erp_viewWorkPlan.php");
	}

	// 결재문서양식 리스트
	public function listPageDocument() {
		require_once ("views/groupware/erp_listDocument.php");
	}

	// 결재문서양식 등록 페이지
	public function inputPageDocument() {
		require_once ("views/groupware/erp_createDocument.php");
	}

	// 결재양식문서 등록
	public function registDocument() {
		$now = date("Y-m-d H:i:s");
		$data = array (
			"table" => "erp_document",
			"classification" => $_POST['classification'],
			"title" => $_POST['title'],
			"comment" => $_POST['comment'],
			"emp_id" => $_SESSION['login_id'],
			"create_dt" => $now
		);
		//var_dump($data);
		$this->insert($data);
		$this->movePage("groupware","listPageDocument");
	}

	// 결재양식문서 수정
	public function modifyPageDocument() {
		$t = Dba::get($_GET['uid'], "document");
		require_once ("views/groupware/erp_modifyDocument.php");
	}

	// 결재양식문서 수정
	public function updateDocument() {
		$now = date("Y-m-d H:i:s");
		$data = array (
			"table" => "erp_document",
			"where" => "uid=".$_POST['uid'],
			"classification" => $_POST['classification'],
			"title" => $_POST['title'],
			"comment" => $_POST['comment'],
			"emp_id" => $_SESSION['login_id']
		);
		//var_dump($data);
		$this->update($data);
		$this->movePage("groupware","listPageDocument");
	}

	// 지출결의서 리스트
	public function listPageSpendingResolution() {
		require_once ("views/groupware/erp_listSpendingResolution.php");
	}

	// 지출결의서 등록
	public function inputPageSpendingResolution() {
		require_once ("views/groupware/erp_createSpendingResolution.php");
	}

	// 지출결의서 등록
	public function registSpending() {
		$account_uid = $_POST['account_uid'];
		$account_subject = $_POST['account_subject'];
		$expense_dt = $_POST['expense_dt'];
		$expense_memo = $_POST['expense_memo'];
		$account = $_POST['account'];
		$cost = $_POST['cost'];
		$supply_cost = $_POST['supply_cost'];
		$tax = $_POST['tax'];
		$payment = $_POST['payment'];
		$memo = $_POST['memo'];
		$arr = array();

		$data = array(
			"table" => "erp_spending_resolution",
			"spending_cd" => $_POST['spending_cd'],
			"big_department_cd" => $_POST['big_department_cd'],
			"middle_department_cd" => $_POST['middle_department_cd'],
			"small_department_cd" => $_POST['small_department_cd'],
			"emp_id" => $_POST['emp_id'],
			"draft_dt" => $_POST['draft_dt'],
			"title" => $_POST['title'],
			"spending_dt" => $_POST['spending_dt'],
			"account_cd" => $_POST['account_cd'],
			"bank" => $_POST['bank'],
			"account" => $_POST['account_number'],
			"account_holder" => $_POST['account_holder'],
			"unit" => $_POST['unit'],
			"total_price" => $this->replaceComma($_POST['total_price']),
			"spending_condition" => $_POST['spending_condition'],
			"approval" => "n",
			"foreign_nm" => $_POST['foreign_nm'],
			"foreign_address" => $_POST['foreign_address'],
			"foreign_phone" => $_POST['foreign_phone'],
			"foreign_bank" => $_POST['foreign_bank'],
			"foreign_bank_branch" => $_POST['foreign_bank_branch'],
			"foreign_account" => $_POST['foreign_account'],
			"foreign_swift_bic_cd" => $_POST['foreign_swift_bic_cd']
		);
		$this->insert($data);
		$fid = $this->get_insert_id();

		foreach($account_uid as $key => $val) {
			$data = array(
				"table" => "erp_spending_resolution_data",
				"fid" => $fid,
				"account_uid" => $val,
				"account_subject" => $account_subject[$key],
				"expense_dt" => $expense_dt[$key],
				"expense_memo" => $expense_memo[$key],
				"cost" => $this->replaceComma($cost[$key]),
				"supply_cost" => $this->replaceComma($supply_cost[$key]),
				"tax" => $this->replaceComma($tax[$key]),
				"memo" => $memo[$key]
			);
			$this->insert($data);
			$sfid = $this->get_insert_id();
			array_push($arr, $sfid);
		}
		
		foreach($_FILES['attach']['tmp_name'] as $key => $val) {
			$file_name = $_FILES['attach']['name'][$key];
			$file_size =$_FILES['attach']['size'][$key];
			$file_tmp =$_FILES['attach']['tmp_name'][$key];
			$file_type=$_FILES['attach']['type'][$key];  
				
			move_uploaded_file($file_tmp,"attach/".time().$file_name);
			if($file_name != "") $nf = time().$file_name; else $nf = "";
			$attach_data = array (
				"table" => "erp_spending_resolution_attach",
				"fid" => $arr[$key],
				"attach" => $nf
			);
			$this->insert($attach_data);
		}
		$this->movePage("groupware","listPageSpendingResolution");
	}

	// 지출결의서 수정
	public function modifyPageSpendingResolution() {
		require_once ("views/groupware/erp_modifySpendingResolution.php");
	}

	// 지출결의서 등록
	public function updateSpending() {
		$sql = "select uid from erp_spending_resolution_data where fid=".$_POST['uid'];
		$this->query($sql);
		while($t = $this->fetch()) {
			// 첨부파일이 등록되어있고 첨부파일이 선택이 되지 않은 경우를 대비해야 함
			$sql = "delete from erp_spending_resolution_attach where fid=".$t->uid;
			@mysql_query($sql);
			$sql = "delete from erp_spending_resolution_data where uid=".$t->uid;
			@mysql_query($sql);	
		}
		

		$account_uid = $_POST['account_uid'];
		$expense_dt = $_POST['expense_dt'];
		$expense_memo = $_POST['expense_memo'];
		$account = $_POST['account'];
		$cost = $_POST['cost'];
		$supply_cost = $_POST['supply_cost'];
		$tax = $_POST['tax'];
		$payment = $_POST['payment'];
		$memo = $_POST['memo'];
		$ori_attach = $_POST['ori_attach'];
		$arr = array();

		$data = array(
			"table" => "erp_spending_resolution",
			"where" => "uid=".$_POST['uid'],
			"big_department_cd" => $_POST['big_department_cd'],
			"middle_department_cd" => $_POST['middle_department_cd'],
			"small_department_cd" => $_POST['small_department_cd'],
			"emp_id" => $_POST['emp_id'],
			"draft_dt" => $_POST['draft_dt'],
			"title" => $_POST['title'],
			"spending_dt" => $_POST['spending_dt'],
			"account_cd" => $_POST['account_cd'],
			"bank" => $_POST['bank'],
			"account" => $_POST['account_number'],
			"account_holder" => $_POST['account_holder'],
			"unit" => $_POST['unit'],
			"total_price" => $this->replaceComma($_POST['total_price']),
			"spending_condition" => $_POST['spending_condition'],
			"foreign_nm" => $_POST['foreign_nm'],
			"foreign_address" => $_POST['foreign_address'],
			"foreign_phone" => $_POST['foreign_phone'],
			"foreign_bank" => $_POST['foreign_bank'],
			"foreign_bank_branch" => $_POST['foreign_bank_branch'],
			"foreign_account" => $_POST['foreign_account'],
			"foreign_swift_bic_cd" => $_POST['foreign_swift_bic_cd']
		);
		$this->update($data);
		$fid = $_POST['uid'];

		foreach($account_uid as $key => $val) {
			$data = array(
				"table" => "erp_spending_resolution_data",
				"fid" => $fid,
				"account_uid" => $val,
				"account_subject" => $account_subject[$key],
				"expense_dt" => $expense_dt[$key],
				"expense_memo" => $expense_memo[$key],
				"cost" => $this->replaceComma($cost[$key]),
				"supply_cost" => $this->replaceComma($supply_cost[$key]),
				"tax" => $this->replaceComma($tax[$key]),
				"memo" => $memo[$key]
			);
			$this->insert($data);
			$sfid = $this->get_insert_id();
			array_push($arr, $sfid);
		}
		
		foreach($_FILES['attach']['tmp_name'] as $key => $val) {
			$file_name = $_FILES['attach']['name'][$key];
			$file_size =$_FILES['attach']['size'][$key];
			$file_tmp =$_FILES['attach']['tmp_name'][$key];
			$file_type=$_FILES['attach']['type'][$key];  
				
			move_uploaded_file($file_tmp,"attach/".time().$file_name);
			if($file_name != "") {
				$nf = time().$file_name;
			} else {
				if($ori_attach[$key] != "") $nf = $ori_attach[$key]; else $nf = "";
			}
			$attach_data = array (
				"table" => "erp_spending_resolution_attach",
				"fid" => $arr[$key],
				"attach" => $nf
			);
			$this->insert($attach_data);
		}

		$this->movePage("groupware","listPageSpendingResolution");
	}
	


	

	







	// 2차 구매요청서
	public function frmPurchase() {
		require_once("views/purchase/frmPurchase.php");
	}

	// 2차 발주서
	public function frmOrder() {
		require_once("views/purchase/frmOrder.php");
	}



	// 2차 입고
	public function frmWarehousing() {
		require_once("views/purchase/frmWarehousing.php");
	}


}
?>