<?
extract($_POST);
extract($_GET);

switch($controller) {
	case "config" :					$controller_txt = "환경설정";				break;
	case "base" :						$controller_txt = "기준정보관리";			break;
	case "sales" :						$controller_txt = "수주.영업관리";				break;
	case "production" :					$controller_txt = "생산관리";				break;
	case "qc" :							$controller_txt = "품질관리";				break;
	case "outsourcing" :				$controller_txt = "외주.사급관리";				break;
	case "purchase" :					$controller_txt = "구매.입고관리";				break;
	case "release" :					$controller_txt = "출고.출하관리";				break;
	case "items" :					$controller_txt = "재고관리";				break;
	case "groupware" :					$controller_txt = "그룹웨어";				break;
	case "accounting" :					$controller_txt = "경영지원";				break;
	case "wage" :					$controller_txt = "인사.급여관리";				break;
}

switch($action) {
	/* 환경설정 */
	case "inputPageInfo" :				$action_txt = "회사정보 관리";				break;
	/* 기준정보관리 */
	case "frmItemClassify" :				$action_txt = "<span style='color:red; font-weight:bold'>품목 구분 관리</span>";				break;
	case "frmItemGroup" :				$action_txt = "<span style='color:red; font-weight:bold'>품목 그룹 관리</span>";				break;
	case "frmItemBuyer" :				$action_txt = "<span style='color:red; font-weight:bold'>품목 매입처 관리</span>";				break;
	case "frmItemCost" :				$action_txt = "<span style='color:red; font-weight:bold'>품목 단가 관리</span>";				break;
	case "frmItemProcess" :				$action_txt = "<span style='color:red; font-weight:bold'>품목 제조공정 관리</span>";			break;
	case "frmItem" :					$action_txt = "<span style='color:red; font-weight:bold'>품목 관리</span>";					break;
	case "frmAccountClassify" :			$action_txt = "<span style='color:red; font-weight:bold'>거래처 구분 관리</span>";				break;
	case "frmAccount" :				$action_txt = "<span style='color:red; font-weight:bold'>거래처 관리</span>";				break;
	case "frmDepartment" :				$action_txt = "<span style='color:red; font-weight:bold'>부서 관리</span>";				break;
	case "frmPosition" :				$action_txt = "<span style='color:red; font-weight:bold'>직위 관리</span>";				break;
	case "frmEmployee" :				$action_txt = "<span style='color:red; font-weight:bold'>사원 관리</span>";				break;
	case "frmWarehouse" :				$action_txt = "<span style='color:red; font-weight:bold'>창고 관리</span>";				break;
	case "frmProcess" :					$action_txt = "<span style='color:red; font-weight:bold'>공정 관리</span>";				break;
	case "frmMachine" :				$action_txt = "<span style='color:red; font-weight:bold'>생산설비 관리</span>";				break;
	case "frmTeam" :				$action_txt = "<span style='color:red; font-weight:bold'>생산팀 관리</span>";				break;
	case "frmProject" :				$action_txt = "<span style='color:red; font-weight:bold'>프로젝트 관리</span>";				break;
	case "frmRentcar" :				$action_txt = "<span style='color:red; font-weight:bold'>용차 관리</span>";				break;
	/* 수주.영업관리 */
	case "frmEstimate" :				$action_txt = "<span style='color:red; font-weight:bold'>견적관리</span>";				break;
	case "frmObtainOrder" :				$action_txt = "<span style='color:red; font-weight:bold'>수주관리</span>";				break;
	case "frmObtainOrderShipment" :		$action_txt = "<span style='color:red; font-weight:bold'>출하지시관리</span>";			break;
	case "frmAs" :						$action_txt = "<span style='color:red; font-weight:bold'>AS관리</span>";				break;
	/* 생산관리 */
	case "frmWorkPlan" :				$action_txt = "<span style='color:red; font-weight:bold'>월간생산계획표</span>";			break;
	case "frmWorkCurrentState" :		$action_txt = "<span style='color:red; font-weight:bold'>작업지시현황</span>";			break;
	case "frmWorkDaily" :				$action_txt = "<span style='color:red; font-weight:bold'>작업일보</span>";				break;
	case "frmWorkProductDailyRegist" :	$action_txt = "<span style='color:red; font-weight:bold'>생산실적</span>";				break;
	/* 품질관리 */
	case "frmQc" :						$action_txt = "<span style='color:red; font-weight:bold'>품질관리(QC)</span>";			break;
	case "frmFaultyChart" :				$action_txt = "<span style='color:red; font-weight:bold'>불량관리</span>";				break;
	/* 외주.사급관리 */
	case "frmOutsourcingRequest" :		$action_txt = "<span style='color:red; font-weight:bold'>외주요청</span>";				break;
	case "frmOutsourcing" :		$action_txt = "<span style='color:red; font-weight:bold'>외주발주관리</span>";					break;
	case "frmBringinMaterialPurchase" :	$action_txt = "<span style='color:red; font-weight:bold'>사급자재구매관리</span>";			break;
	case "frmOutsourcingItemPurchase" :	$action_txt = "<span style='color:red; font-weight:bold'>외주품목입고현황</span>";			break;
	case "frmBringinMaterialRelease" :	$action_txt = "<span style='color:red; font-weight:bold'>사급자재출고관리</span>";			break;
	case "frmOutsourcingWarehouse" :	$action_txt = "<span style='color:red; font-weight:bold'>외주창고관리</span>";			break;
	/* 구매.입고관리 */
	case "frmPurchase" :				$action_txt = "<span style='color:red; font-weight:bold'>구매요청</span>";			break;
	case "frmOrder" :					$action_txt = "<span style='color:red; font-weight:bold'>발주서</span>";			break;
	/* 출고.출하관리 */
	case "frmShipmentOrder" :			$action_txt = "<span style='color:red; font-weight:bold'>출하지지서</span>";		break;
	case "frmRelease" :					$action_txt = "<span style='color:red; font-weight:bold'>출고요청서</span>";		break;
	case "frmInOut" :					$action_txt = "<span style='color:red; font-weight:bold'>자재수불부</span>";		break;
	/* 재고관리 */
	case "frmWarehouseStock" :			$action_txt = "<span style='color:red; font-weight:bold'>창고재고관리</span>";		break;
	case "frmCurrentStock" :			$action_txt = "<span style='color:red; font-weight:bold'>재고현황</span>";			break;
	case "frmProcessStock" :			$action_txt = "<span style='color:red; font-weight:bold'>재공재고현황</span>";		break;
	case "frmBarcode" :					$action_txt = "<span style='color:red; font-weight:bold'>바코드관리</span>";		break;
	/* 그룹웨어 */
	case "frmBoard" :					$action_txt = "<span style='color:red; font-weight:bold'>업무일지</span>";			break;
	case "frmManInOut" :				$action_txt = "<span style='color:red; font-weight:bold'>출퇴근관리</span>";		break;
	case "frmSchedule" :				$action_txt = "<span style='color:red; font-weight:bold'>일정관리</span>";			break;
	case "frmFile" :					$action_txt = "<span style='color:red; font-weight:bold'>파일보관함</span>";		break;
	case "listPageItem" :				$action_txt = "품목 관리";					break;
	case "inputPageItem" :				$action_txt = "품목 등록";					break;
	case "modifyPageItem" :				$action_txt = "품목 수정";					break;
	case "listPageAccount" :				$action_txt = "거래처 관리";				break;
	case "listPageAccountClassify" :			$action_txt = "거래처 구분 관리";			break;
	case "inputPageAccount" :			$action_txt = "거래처 등록";				break;
	case "modifyPageAccount" :			$action_txt = "거래처 수정";				break;
	case "listPageDepartment" :			$action_txt = "부서 관리";					break;
	case "listPagePosition" :				$action_txt = "직위 관리";					break;
	case "listPageEmployee" :				$action_txt = "사원 관리";					break;
	case "inputPageEmployee" :			$action_txt = "사원정보 등록";				break;
	case "modifyPageEmployee" :			$action_txt = "사원정보 수정";				break;
	case "listPageWarehouse" :			$action_txt = "창고 관리";					break;
	case "listPageProcess" :				$action_txt = "공정 관리";					break;
	case "listPageMachine" :				$action_txt = "생산기기(팀) 관리";			break;
	case "listPageDefectReason" :			$action_txt = "불량사유 관리";				break;
	case "listPageQcClassify" :				$action_txt = "검사구분 관리";				break;
	case "listPageQcItem" :				$action_txt = "검사항목 관리";				break;
	case "listPageRentCar" :				$action_txt = "용차리스트";				break;
	case "inputPageRentCar" :			$action_txt = "용차등록";					break;
	case "modifyPageRentCar" :			$action_txt = "용차수정";					break;
	case "listPageRentCost" :				$action_txt = "요금관리";					break;
	case "listPageProject" :				$action_txt = "프로젝트 관리";				break;
	case "inputPageProject" :				$action_txt = "프로젝트 등록";				break;
	case "modifyPageProject" :			$action_txt = "프로젝트 수정";				break;
	case "inputPageExcel" :				$action_txt = "EXCEL 등록";				break;
	case "downloadPageExcel" :			$action_txt = "EXCEL 다운로드";				break;
	case "createItemProcess" :			$action_txt = "품목제조공정관리";			break;
	case "createPageItemBuyer" :			$action_txt = "품목 매입처 관리";			break;
	case "createPageItemProcess" :			$action_txt = "품목 제조공정 관리";			break;

	

	/* 영업관리 */
	case "listPageOrderReport" :			$action_txt = "거래명세서";				break;
	case "listPageEstimate" :				$action_txt = "견적관리";					break;
	case "inputPageEstimate" :			$action_txt = "견적서 등록";				break;
	case "modifyPageEstimate" :			$action_txt = "견적서 수정";				break;
	case "listPageOrder" :				$action_txt = "발주리스트";				break;
	case "inputPageObtainOrder" :			$action_txt = "수주등록";					break;
	case "listPageOrderShipment" :			$action_txt = "출하관리";					break;
	case "listPageAs" :					$action_txt = "AS관리";					break;
	case "inputPageAs" :				$action_txt = "AS등록";					break;
	case "modifyPageAs" :				$action_txt = "AS수정";					break;
	case "listPageAccountReceivable" :		$action_txt = "미수금관리";				break;
	case "listPageSalesPlan" :				$action_txt = "매출계획";					break;
	case "inputPageSalesPlan" :			$action_txt = "매출계획등록";				break;
	case "listPageObtainOrder" :			$action_txt = "수주(주문)관리";				break;
	case "listPageObtainOrderShipment" :		$action_txt = "출하관리";					break;
	case "inputPageObtainOrderShipment" :	$action_txt = "출하지시";					break;
	case "listPageOutstanding" :			$action_txt = "미수금관리";				break;

	/* 생산관리 */
	case "listPageBom" :				$action_txt = "BOM(소요량) 리스트";			break;
	case "inputPageBom" :				$action_txt = "BOM(소요량) 등록";			break;
	case "calBom" :					$action_txt = "BOM(소요량) 계산";			break;
	case "listPageOutsourcing" :			$action_txt = "외주공정관리";				break;
	case "inputPageOutsourcing" :			$action_txt = "외주공정등록";				break;
	case "modifyPageOutsourcing" :			$action_txt = "외주공정수정";				break;
	case "listPageWorkPlanBom" :			$action_txt = "생산계획 소요자재 현황";		break;
	case "viewPageOrderStock" :			$action_txt = "생산계획 소요자재 현황";		break;
	case "listPageWorkPlan" :				$action_txt = "생산계획";					break;
	case "listPageStandbyWork" :			$action_txt = "작업지시 대기";				break;
	case "listPageWork" :				$action_txt = "작업지시서";				break;
	case "listPageQc" :					$action_txt = "품질관리(QC)";				break;
	case "listPageDefective" :				$action_txt = "불량관리";					break;
	case "listPageManpower" :			$action_txt = "라인가동률";				break;
	case "listPageMold" :				$action_txt = "금형리스트";				break;
	case "inputPageMold" :				$action_txt = "금형등록";					break;
	case "modifyPageMold" :				$action_txt = "금형수정";					break;
	case "currentWorkState" :				$action_txt = "작업현황판";				break;
	case "viewPageWorkPlan" :			$action_txt = "생산계획표";				break;
	case "inputPageQc" :				$action_txt = "품질관리(QC)";				break;

	/* 구매관리 */
	case "listPagePurchaseDemand" :		$action_txt = "구매요청";					break;
	case "listPageOrderPlan" :				$action_txt = "발주계획";					break;
	case "listPageOrderDraft" :			$action_txt = "발주서";					break;
	case "listPageOrderDraftItem" :			$action_txt = "구매입고";					break;
	case "listPageAmountPayable" :			$action_txt = "미지급금관리";				break;
	case "listPageBarcodePurchaseItem" :		$action_txt = "구매입고(BARCODE)";			break;
	case "modifyPagePurchaseDemand" :		$action_txt = "구매요청수정";				break;
	case "listPageItemWarehousing" :		$action_txt = "품목별입고";				break;

	/* 재고관리 */
	case "listPageShipment" :				$action_txt = "출하지시서";				break;
	case "listPageWarehouseStock" :		$action_txt = "창고재고관리";				break;
	case "listPageStockPrice" :			$action_txt = "단가관리";					break;
	case "listPageStock" :				$action_txt = "재고현황";					break;
	case "listPageRelease" :				$action_txt = "자재출고요청서";				break;
	case "listPageItemInout" :				$action_txt = "자재수불부";				break;
	case "listPageBarcode" :				$action_txt = "바코드관리";				break;
	case "listPageRealStock" :				$action_txt = "재고실사";					break;
	case "listPageSafetyStock" :			$action_txt = "안전재고관리";				break;
	case "listPageLotNo" :				$action_txt = "Lot No 추적";				break;
	case "listPageBarcodeReleaseItem" :		$action_txt = "출고(BARCODE)";				break;
	case "viewPageRelease" :				$action_txt = "자재출고";					break;
	case "listPageBarcodeRelease" :			$action_txt = "자재출고 (BARCODE)";			break;
	case "inputPageShipmentOrder" :		$action_txt = "출하등록";					break;

	/* 그룹웨어 */
	case "listPageApprovalLine" :			$action_txt = "결재라인";					break;
	case "inputPageApprovalLine" :			$action_txt = "결재라인등록";				break;
	case "modifyPageApprovalLine" :		$action_txt = "결재라인수정";				break;
	case "listPageMyApproval" :			$action_txt = "내기안함";					break;
	case "inputPageApproval" :			$action_txt = "기안서등록";				break;
	case "modifyPageApproval" :			$action_txt = "기안서수정";				break;
	case "listPageApproval" :				$action_txt = "결재리스트";				break;
	case "viewPageMyApproval" :			$action_txt = "기안서보기";				break;
	case "viewPageApproval" :			$action_txt = "기안서";					break;
	case "listPageDocument" :			$action_txt = "문서양식관리";				break;
	case "inputPageDocument" :			$action_txt = "문서양식등록";				break;
	case "modifyPageDocument" :			$action_txt = "문서양식수정";				break;
	case "listPageCrm" :				$action_txt = "고객관리";					break;
	case "inputPageCrm" :				$action_txt = "고객등록";					break;
	case "listPageBoard" :				$action_txt = "업무공유";					break;
	case "inputPageBoard" :				$action_txt = "공유업무등록";				break;
	case "listPageSchedule" :				$action_txt = "일정리스트";				break;
	case "inputPageSchedule" :			$action_txt = "일정등록";					break;
	case "listPageScheduleMonth" :			$action_txt = "월간일정";					break;
	case "listPageScheduleWeek" :			$action_txt = "주간일정";					break;
	case "listPageScheduleDay" :			$action_txt = "일간일정";					break;
	case "listPageEmpWorkLeave" :			$action_txt = "출퇴근관리";				break;
	case "listPageFile" :					$action_txt = "파일보관함";				break;
	case "inputPageFile" :				$action_txt = "파일등록";					break;
	case "listPagePublicThing" :			$action_txt = "공용품관리";				break;
	case "inputPagePublicThing" :			$action_txt = "공용품등록";				break;
	case "listPageCar" :					$action_txt = "차량관리";					break;
	case "inputPageCar" :				$action_txt = "차량등록";					break;
	case "modifyPageCar" :				$action_txt = "차량이력등록";				break;
	case "listPageInstallation" :			$action_txt = "시설물관리";				break;
	case "inputPageInstallation" :			$action_txt = "시설물등록";				break;
	case "listPageSpendingResolution" :		$action_txt = "지출결의서";				break;
	case "inputPageSpendingResolution" :		$action_txt = "지출결의서등록";				break;
	case "modifyPageSpendingResolution" :	$action_txt = "지출결의서수정";				break;
	case "modifyPageEleSettlement" :		$action_txt = "기안서수정";				break;
	case "inputPageAccountSubject" :		$action_txt = "계정과목관리"; $helper = "지출결의서에 사용할 계정과목을 등록하세요";			break;	

	/* 인사.급여관리 */
	case "frmWage" :			$action_txt = "급여관리";					break;

	/* 경영지원 */
	case "frmAccountPurchase" :	$action_txt = "<span style='color:red; font-weight:bold'>업체별매입현황</span>";			break;
	case "frmItemOrder" :		$action_txt = "<span style='color:red; font-weight:bold'>품목별매입현황</span>";			break;
	case "frmPeriodOrder" :		$action_txt = "<span style='color:red; font-weight:bold'>기간별매입현황</span>";			break;
	case "frmReceivables" :		$action_txt = "<span style='color:red; font-weight:bold'>미수금내역</span>";			break;
	case "frmPayable" :			$action_txt = "<span style='color:red; font-weight:bold'>미지급금내역</span>";			break;
	case "frmAccountSales" :	$action_txt = "<span style='color:red; font-weight:bold'>업체별판매현황</span>";			break;
	case "frmItemSales" :		$action_txt = "<span style='color:red; font-weight:bold'>품목별판매현황</span>";			break;
	case "frmPeriodSales" :		$action_txt = "<span style='color:red; font-weight:bold'>기간별판매현황</span>";			break;
	case "frmAccountSalesChart" :	$action_txt = "<span style='color:red; font-weight:bold'>업체별판매순위표</span>";	break;
}
?>