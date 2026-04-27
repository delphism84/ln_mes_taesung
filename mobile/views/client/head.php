<?
extract($_POST);
extract($_GET);
include "connection2.php";

$sql = "select * from company";
$result = mysql_query($sql);
$company = mysql_fetch_object($result);


?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>ERP SYSTEM</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />


		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="assets/css/chosen.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-colorpicker.min.css" />
		<link rel="stylesheet" href="assets/css/jquery-ui.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/common.css" />

		<!-- Page styles -->
		<link type='text/css' href='assets/css/demo.css' rel='stylesheet' media='screen' />
		<!-- Contact Form CSS files -->
		<link type='text/css' href='assets/css/basic.css' rel='stylesheet' media='screen' />
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>


		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="assets/css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="assets/css/style.css"> <!-- Resource style -->
		<script src="assets/js/modernizr.js"></script> <!-- Modernizr -->

		<script src="assets/js/jquery-2.1.1.js"></script>
		<script src="assets/js/velocity.min.js"></script>
		<script src="assets/js/main.js"></script> <!-- Resource jQuery -->

		<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	</head>
	<style>
		button{
			border:none
		}
	</style>
	<body class="no-skin common">
	<table class="wrap_com" ><tr><td> 
		<table class="wrap_box1"><tr><td>	
			<!-- btn_01 메뉴오픈하는 버튼 -->
			<button class="btn_01"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span></button>			
			<p class="logo01" onclick="location.href='index.php'">(주)태성</p>					
			<? if($action !="frmWorkCurrentState" AND $action !="frmFaultyChart" AND $action !="frmBringinMaterialPurchase" AND $action !="frmBringinMaterialRelease" AND $action !="frmOutsourcingWarehouse"
			AND $action !="frmPurchase" AND $action !="frmWarehouseStock" AND $action !="frmProcessStock" AND $action !="frmBarcode" AND $action !="frmBoard" AND $action !="frmSchedule" AND $action !="frmFile" AND $action !="frmWorkPlan" AND $action !="home") {?>
				<button class="search_pop"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
			<?}?>
		</td></tr></table>
		<table><tr><td>
		<div>
			<table><tr><td>
				<div>
					<!--슬라이드메뉴-->
					<div class="menu" style="z-index:9999; position:fixed; top:0;">
						<!--상단 -->					
						<div class="top_menu">	
							<div class="top_menu_left">
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
							</div>
							<div class="top_menu_right">
								<span><?=$_SESSION['login_nm']?>님</span>
								<span onclick="javascript:location.href='logout.php'" >로그아웃</span>	
								<span class="glyphicon glyphicon-remove btn_04" aria-hidden="true"></span>
							</div>							
						</div>
						<!--메뉴-->
						<div class="cont_menu" style="overflow-y: scroll;">								
							<div class="cont_menu_left">
								<ul class="main_menu">
									<!-- 기준정보관리 시작 -->								
									<li class="main_menu01">
										<a href="#a">
											<span class="glyphicon glyphicon-phone" aria-hidden="true"></span> 기준정보관리
										</a>
										<ul class="sub_menu sub_menu01">
											<li class="sub_menu01">
												<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmItem'">
													<span class="glyphicon glyphicon-minus" aria-hidden="true">품목관리</span>												
												</a>	
												<!--
												<ul class="sub_menu02 ">												
													<li>
														<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmItemClassify'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>품목구분 관리</a>
													</li>
													
													<li> 
														<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmItemGroup'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>품목그룹 관리</a>
													</li>
													
													<li>
														<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmItemBuyer'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>품목 매입처관리</a>
													</li>
													
													<li>
														<a href="#a"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>거래처별 품목단가관리</a>
													</li>
													
													<li>
														<a href="#a"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>품목 제조공정 관리</a>
													</li>
													
													
													<li>
														<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmItem'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>품목 관리</a>
													</li>												
												</ul>
												-->
											</li>	
											<!--
											<li class="sub_menu01">
												<a href="#a"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>거래처 관리 <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
												<ul class="sub_menu02">
													<li>
														<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmAccountClassify'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>거래처구분 관리</a>
													</li>
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmAccount'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>거래처 관리</a>
													</li>
												</ul>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmDepartment'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>부서 관리</a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmPosition'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>직위 관리</a>
											</li>
											<li class="sub_menu01">
												<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmEmployee'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>사원 관리</a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmWarehouse'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>창고 관리</a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmProcess'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>공정 관리</a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmMachine'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>생산설비 관리</a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmTeam'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>생산팀 관리</a>
											</li>
											<li class="sub_menu01">
												<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmProject'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>프로젝트 관리</a>
											</li>
											<li class="sub_menu01">
												<a href="#a"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>용차 관리 <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
												<ul class="sub_menu02">
													<li>
														<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmRentcar'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>용차관리</a>
													</li>
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmRentcarCost'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>요금관리</a>
													</li>
												</ul>
											</li>
											<li class="sub_menu01">
												<a href="#a" onclick="location.href='../mobile/index.php?controller=base&action=frmExcel'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>엑셀자료등록</a>
											</li>
											-->
										</ul>
									</li>								
									<!-- 기준정보관리 끝 -->

									<!-- 수주 / 영업관리 시작 -->
									<li class="main_menu01">
										<a href="#a">
											<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> 수주/영업관리
										</a>									
										<ul class="sub_menu">
											<li>
												<a href="#a"  onclick="location.href='../mobile/index.php?controller=sales&action=frmEstimate'"><span class="glyphicon glyphicon-minus" aria-hidden="true">견적관리</span></a>
											</li>
											<li>	
												<a href="#a" onclick="location.href='../mobile/index.php?controller=sales&action=frmObtainOrder'"><span class="glyphicon glyphicon-minus" aria-hidden="true">수주관리</span></a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=sales&action=frmObtainOrderShipment'"><span class="glyphicon glyphicon-minus" aria-hidden="true">출하지시관리</span></a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=sales&action=frmAs'"><span class="glyphicon glyphicon-minus" aria-hidden="true">AS관리</span></a>
											</li>
										</ul>
									</li>
									<!-- 수주 / 영업관리 시작 -->

									<!-- 생산관리 시작 -->
									<li class="main_menu01">
										<a href="#a">
											<span class="glyphicon glyphicon-retweet" aria-hidden="true"></span> 생산관리
										</a>
										<ul class="sub_menu">
											<li class="sub_menu01">
												<a href="#a"><span class="glyphicon glyphicon-minus" aria-hidden="true">생산계획</span> <b class="glyphicon glyphicon-chevron-down" aria-hidden="true"></b></a>
												<ul class="sub_menu02">
													<li>
														<a href="#a" onclick="location.href='../mobile/index.php?controller=production&action=frmWorkPlan'"><span class="glyphicon glyphicon-minus" aria-hidden="true">월간생산계획표</span></a>
													</li>
													<!--
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=production&action=frmWorkPlanWeek'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>주간 생산계획표</a>
													</li>
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=production&action=frmProductSchedule'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>생산계획</a>
													</li>
													-->
												</ul>
											</li>
											<!--
											<li class="sub_menu01">
												<a href="#a" onclick="location.href='../mobile/index.php?controller=production&action=frmWorkOrder'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>작업지시서 관리</a>
											</li>
											-->
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=production&action=frmWorkCurrentState'"><span class="glyphicon glyphicon-minus" aria-hidden="true">작업지시현황</span></a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=production&action=frmWorkDaily'"><span class="glyphicon glyphicon-minus" aria-hidden="true">작업일보</span></a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=production&action=frmWorkProductDailyRegist'"><span class="glyphicon glyphicon-minus" aria-hidden="true">생산실적등록</span></a>
											</li>
											<!--
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=production&action=frmMonthProductState'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>생산현황</a>
											</li>
											-->
										</ul>
									</li>
									<!-- 생산관리 끝 -->

									<!-- 품질관리 시작 -->
									<li class="main_menu01">
										<a href="#a">
											<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 품질관리 
										</a>
										<ul class="sub_menu">
											<!--
											<li class="sub_menu01">
												<a href="#a" onclick="location.href='../mobile/index.php?controller=qc&action=frmQcClassify'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>검사항목 관리</a>
											</li>
											-->
											<li class="sub_menu01">
												<a href="#a" onclick="location.href='../mobile/index.php?controller=qc&action=frmQc'"><span class="glyphicon glyphicon-minus" aria-hidden="true">품질관리(QC)</span></a>
											</li>
											<!--
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=qc&action=frmFaultyType'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>불량유형관리</a>
											</li>
											-->
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=qc&action=frmFaultyChart'"><span class="glyphicon glyphicon-minus" aria-hidden="true">불량관리</span></a>
											</li>
											<!--
											<li>
												<a href="#a"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>불량현황</a>
											</li>
											-->
										</ul>
									</li>
									<!-- 품질관리 끝 -->


									<!-- 외주 / 사급관리 시작 -->
									<li class="main_menu01">
										<a href="#a">
											<span class="glyphicon glyphicon-share" aria-hidden="true"></span> 외주/사급관리 
										</a>
										<ul class="sub_menu">
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=outsourcing&action=frmOutsourcingRequest'"><span class="glyphicon glyphicon-minus" aria-hidden="true">외주요청</span></a>
											</li>
											<!--
											<li>
												<a href="#a"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>외주품목관리</a>
											</li>
											-->
											<!--
											<li>
												<a href="#a"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>사급자재관리</a>
											</li>
											-->
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=outsourcing&action=frmOutsourcing'"><span class="glyphicon glyphicon-minus" aria-hidden="true">외주발주관리</span></a>
											</li>
										
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=outsourcing&action=frmOutsourcingItemPurchase'"><span class="glyphicon glyphicon-minus" aria-hidden="true">외주품목입고현황</span></a>
											</li>
											<!--
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=outsourcing&action=frmBringinMaterialRelease'"><span class="glyphicon glyphicon-minus" aria-hidden="true">사급자재출고관리</span></a>
											</li>
											-->
											<li class="sub_menu01">
												<a href="#a" onclick="location.href='../mobile/index.php?controller=outsourcing&action=frmOutsourcingWarehouse'"><span class="glyphicon glyphicon-minus" aria-hidden="true">외주창고관리</span></a>
											</li>
										</ul>
									</li>
									<!-- 외주 / 사급관리 끝 -->
									<!-- 구매 / 입고관리 시작 -->
									<li class="main_menu01">
										<a href="#a">
											<span class="glyphicon glyphicon-save-file" aria-hidden="true"></span> 구매/입고관리 
										</a>
										<ul class="sub_menu">
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=purchase&action=frmPurchase'"><span class="glyphicon glyphicon-minus" aria-hidden="true">구매요청</span></a>
											</li>
											<!--
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=purchase&action=frmEasyPurchase'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>간편구매요청</a>
											</li>
											-->
											<li class="sub_menu01">
												<a href="#a" onclick="location.href='../mobile/index.php?controller=purchase&action=frmOrder'"><span class="glyphicon glyphicon-minus" aria-hidden="true">발주서</span></a>
											</li>
											<!--
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=purchase&action=frmWarehousing'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>입고</a>
											</li>
											-->
										</ul>
									</li>
									<!-- 구매 / 입고관리 끝 -->

									<!-- 출고 / 출하관리 시작 -->
									<li class="main_menu01">
										<a href="#a">
											<span class="glyphicon glyphicon-export" aria-hidden="true"></span> 출고/출하관리 
										</a>
										<ul class="sub_menu">
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=release&action=frmShipmentOrder'"><span class="glyphicon glyphicon-minus" aria-hidden="true">출하지시서</span></a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=release&action=frmRelease'"><span class="glyphicon glyphicon-minus" aria-hidden="true">출고요청서</span></a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=release&action=frmInOut'"><span class="glyphicon glyphicon-minus" aria-hidden="true">자재수불부</span></a>
											</li>
											<!--
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=release&action=frmShipmentOrder'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Lot No 추적</a>
											</li>
											-->
										</ul>       
									</li>
									<!-- 출고 / 출하관리 끝 -->

									<!-- 재고관리 시작 -->
									<li class="main_menu01">
										<a href="#a">
											<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> 재고관리
										</a>
										<ul class="sub_menu">
											<li class="sub_menu01">
												<a href="#a" onclick="location.href='../mobile/index.php?controller=items&action=frmWarehouseStock'"><span class="glyphicon glyphicon-minus" aria-hidden="true">창고재고관리</span></a>                   
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=items&action=frmCurrentStock'"><span class="glyphicon glyphicon-minus" aria-hidden="true">재고현황</span></a>
											</li>
											<!--
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=items&action=frmWarehouseStock'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>불출재고(공정투입전)</a>
											</li>
											-->
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=items&action=frmProcessStock'"><span class="glyphicon glyphicon-minus" aria-hidden="true">재공재고현황</span></a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=items&action=frmBarcode'"><span class="glyphicon glyphicon-minus" aria-hidden="true">바코드관리</span></a>
											</li>
											<!--
											<li class="sub_menu01">
												<a href="#a" onclick="location.href='../mobile/index.php?controller=items&action=frmStock'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>재고실사</a>                       
											</li>
											-->
											<!--
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=items&action=frmWarehouseStock'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>안전재고관리</a>
											</li>
											-->
										</ul>
									</li>
									<!-- 재고관리 끝 -->

									<!-- 인사 / 급여관리 시작 -->
									<!--
									<li class="main_menu01">
										<a href="#a" style="color: #302928;"><span class="glyphicon glyphicon-folder-open icon_bakccolor" aria-hidden="true" style="color: #302928;"></span> 인사 / 급여관리 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
										<ul class="sub_menu">
											
											<li class="sub_menu01">
												<a href="#a" onclick="location.href='../mobile/index.php?controller=wage&action=frmWage'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>급여관리</a>                   
											</li>
											
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=wage&action=frmDayLabor'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>일용직관리</a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=wage&action=frmCommute'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>근태관리</a>
											</li>                                        
										</ul>
									</li>
									-->
									<!-- 인사 / 급여관리 끝 -->

									<!-- 그룹웨어 시작 -->
									<!--
									<li class="main_menu01">
										<a href="#a">
											<span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span> 그룹웨어
										</a>
										<ul class="sub_menu">
											<!--
											<li class="sub_menu01">
											<a href="#a"><span class="glyphicon glyphicon-minus" aria-hidden="true">전자결재</span> <b class="glyphicon glyphicon-chevron-down" aria-hidden="true"></b></a>
												<ul class="sub_menu02">
													<li>
														<a href="#a" onclick="location.href='../mobile/index.php?controller=groupware&action=frmApprovalLine'"><span class="glyphicon glyphicon-minus" aria-hidden="true">결재라인관리</span></a>
													</li>												
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=groupware&action=frmMyApproval'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>내 기안함</a>
													</li>
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=groupware&action=frmApproval'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>결재리스트</a>
													</li>
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=groupware&action=frmApprovalDocument'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>문서양식관리</a>
													</li>
												</ul>
											</li>
											-->
											<!--
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=groupware&action=frmSpendingResolution'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>지출결의서</a>
											</li>
											
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=groupware&action=frmAccountSubject'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>계정과목관리</a>
											</li>
											-->
											<!--
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=groupware&action=frmBoard'"><span class="glyphicon glyphicon-minus" aria-hidden="true">업무일지</span></a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=groupware&action=frmManInOut'"><span class="glyphicon glyphicon-minus" aria-hidden="true">출퇴근관리</span></a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=groupware&action=frmSchedule'"><span class="glyphicon glyphicon-minus" aria-hidden="true">일정관리</span></a>
											</li>
											<li>
												<a href="#a" onclick="location.href='../mobile/index.php?controller=groupware&action=frmFile'"><span class="glyphicon glyphicon-minus" aria-hidden="true">파일보관함</span></a>
											</li>                               
										</ul>
									</li>
									-->
									<!-- 그룹웨어 끝 -->
								
									<!-- 경영지원 시작 -->		
									<!--
									<li class="main_menu01">
										<a href="#a">
											<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> 경영지원 
										</a>
										<ul class="sub_menu">
											<li class="sub_menu01">
												<a href="#a">
													<span class="glyphicon glyphicon-minus" aria-hidden="true">매입</span>
													<b class="glyphicon glyphicon-chevron-down" aria-hidden="true"></b>
												</a>
												<ul class="sub_menu02">													
													<li>
														<a href="#a" onclick="location.href='../mobile/index.php?controller=accounting&action=frmAccountPurchase'"><span class="glyphicon glyphicon-minus" aria-hidden="true">업체별매입현황</span></a>
													</li>
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=accounting&action=frmItemOrder'"><span class="glyphicon glyphicon-minus" aria-hidden="true">품목별매입현황</span></a>
													</li>
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=accounting&action=frmPeriodOrder'"><span class="glyphicon glyphicon-minus" aria-hidden="true">기간별매입현황</span></a>
													</li>
													<!--
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=accounting&action=frmAccountPurchaseChart'"><span class="glyphicon glyphicon-minus" aria-hidden="true">업체별매입순위표</span></a>
													</li>
													-->
													<!--
												</ul>
											</li>  
											<li class="sub_menu01">
												<a href="#a">
													<span class="glyphicon glyphicon-minus" aria-hidden="true">회계</span>
													<b class="glyphicon glyphicon-chevron-down" aria-hidden="true"></b>
												</a>
												<ul class="sub_menu02">
													<li>
														<a href="#a" onclick="location.href='../mobile/index.php?controller=accounting&action=frmReceivables'"><span class="glyphicon glyphicon-minus" aria-hidden="true">미수금내역</span></a>
													</li>
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=accounting&action=frmPayable'"><span class="glyphicon glyphicon-minus" aria-hidden="true">미지급금내역</span></a>
													</li>                           
												</ul>
											</li>  
											<li class="sub_menu01">
												<a href="#a">
													<span class="glyphicon glyphicon-minus" aria-hidden="true">판매</span>
													<b class="glyphicon glyphicon-chevron-down" aria-hidden="true"></b>
												</a>
												<ul class="sub_menu02">
													<li>
														<a href="#a" onclick="location.href='../mobile/index.php?controller=accounting&action=frmAccountSales'"><span class="glyphicon glyphicon-minus" aria-hidden="true">업체별판매현황</span></a>
													</li>
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=accounting&action=frmItemSales'"><span class="glyphicon glyphicon-minus" aria-hidden="true">품목별판매현황</span></a>
													</li>
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=accounting&action=frmPeriodSales'"><span class="glyphicon glyphicon-minus" aria-hidden="true">기간별판매현황</span></a>
													</li>
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=accounting&action=frmAccountSalesChart'"><span class="glyphicon glyphicon-minus" aria-hidden="true">업체별판매순위표</span></a>
													</li>
													<!--
													<li>  
														<a href="#a" onclick="location.href='../mobile/index.php?controller=accounting&action=frmSalesChart'"><span class="glyphicon glyphicon-minus" aria-hidden="true">년,월판매집계표(업체)</span></a>
													</li>
													-->
													<!--
												</ul>
											</li>									
											<!-- 경영지원 끝 -->										
										</ul>
									</li>
								</ul>
							</div>					
						</div>				
					</div>         
				</div>                        
			</td></tr></table>       
			</div>
			</td></tr></table>

	<!-- 설정 pop -->
	<div class="set">
		<div class="set-top-box">
			<!-- btn_05 설정 닫기 버튼 -->
			<button class="btn_05"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			<input type="button" value="환경설정 저장" onclick="formSubmit()" />
		</div>
		<div class="set-content-box">
			<form name="frm" id="frm">
				<input type="hidden" name="mode" id="mode" value="registConfig" />
				<table id="simple-table" style="width:100%;" class="set-table">
					<tr>
						<td class="col-xs-10" style="vertical-align:middle">
							<p> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 작업강제 시작</p>
							<input name="compulsionWork" id="compulsionWork" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->compulsionWork == "y") echo "checked"; ?> /><span class="lbl"></span>
							<span class="blue">* 생산라인에서 투입자재가 없어도 강제로 작업을 시작하게 합니다.</span>
						</td>
					</tr>
					<tr>					
						<td class="col-xs-10" style="vertical-align:middle">
							<p> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 자동입고</p>
							<input name="autoIn" id="autoIn" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->autoIn == "y") echo "checked"; ?> /><span class="lbl"></span>
							<span class="blue">* 구매발주서 작성과 동시에 자동입고 처리를 합니다</span>
						</td>
					</tr>
					<tr>					
						<td class="col-xs-10" style="vertical-align:middle">
							<p> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 자동 생산불출</p>
							<input name="autoRelease" id="autoRelease" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->autoRelease == "y") echo "checked"; ?> /><span class="lbl"></span>
							<span class="blue">* 작업지시서 작성과 동시에 자동 원자재불출 처리를 합니다</span>
						</td>
					</tr>
					<tr>
						<td class="col-xs-10" style="vertical-align:middle">
							<p> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 자동 생산원자재 투입</p>
							<input name="autoItemMinus" id="autoItemMinus" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->autoItemMinus == "y") echo "checked"; ?> /><span class="lbl"></span>
							<span class="blue">* 생산작업완료시 자동으로 품목제조공정별 소요자재의 수량만큼 자재를 삭감합니다.</span>
						</td>
					</tr>
				</table>			
			</form>
		</div>
	</div>
	<!-- 설정 pop -->

<script>
	function formSubmit(){
		var parameter = $("#frm").serialize();
		$.ajax({
			type : "post",
			data : parameter,
			url : "ajax.php",
			success : function(){
				showAlert("환경설정을 등록하였습니다");
			}
		});
	}
</script>		
			
<script type="text/javascript">
	$(function(){
		$('.btn_01').click(function(){
			$('.menu').css('left','0');			
			$('.slide_menu_pop').css('right','-50%');
		});
		$('.btn_04').click(function(){
			$('.menu').css('left','-100%');
		});
	});
</script>

<script type="text/javascript">
	$(function(){
		$('.btn_02').click(function(){
			$('.set').css('right','0');
			$('.menu').css('left','-100%');
		})
		$('.btn_05').click(function(){
			$('.set').css('right','-100%');

		})
	})
</script>

<script type="text/javascript">
	$(".main_menu01 a").click(function() {
		$(this).next().slideToggle("fast").parent().siblings().children("ul").hide();
		return false;
	});
</script>

<script>
	$(function(){
		$('.sub_menu li a').click(function(){
			$(this).css('color','red')
		})
	})
</script>