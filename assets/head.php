<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>태성 ERP SYSTEM</title>

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
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.php" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							<?=getCorpNm();?>
						</small>
						<a href="logout.php" class="btn btn-minier btn-danger" style="margin-top:10px">로그아웃</a>
						<a href="leave.php" class="btn btn-minier btn-danger" style="margin-top:10px">퇴근</a>
						<? if($_SESSION['login_level'] >= 99) { ?><a href="initialization.php" class="btn btn-minier btn-danger" style="margin-top:10px">데이터초기화</a><?}?>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="grey dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-tasks"></i>
								<span class="badge badge-grey">4</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-check"></i>
									4 Tasks to complete
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Software Update</span>
													<span class="pull-right">65%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:65%" class="progress-bar"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Hardware Upgrade</span>
													<span class="pull-right">35%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:35%" class="progress-bar progress-bar-danger"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Unit Testing</span>
													<span class="pull-right">15%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:15%" class="progress-bar progress-bar-warning"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Bug Fixes</span>
													<span class="pull-right">90%</span>
												</div>

												<div class="progress progress-mini progress-striped active">
													<div style="width:90%" class="progress-bar progress-bar-success"></div>
												</div>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										See tasks with details
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important">8</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									8 Notifications
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
														New Comments
													</span>
													<span class="pull-right badge badge-info">+12</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<i class="btn btn-xs btn-primary fa fa-user"></i>
												Bob just signed up as an editor ...
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
														New Orders
													</span>
													<span class="pull-right badge badge-success">+8</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
														Followers
													</span>
													<span class="pull-right badge badge-info">+11</span>
												</div>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										See all notifications
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="green dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
								<span class="badge badge-success">5</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									5 Messages
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Alex:</span>
														Ciao sociis natoque penatibus et auctor ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>a moment ago</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Susan:</span>
														Vestibulum id ligula porta felis euismod ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>20 minutes ago</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Bob:</span>
														Nullam quis risus eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>3:15 pm</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Kate:</span>
														Ciao sociis natoque eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>1:33 pm</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Fred:</span>
														Vestibulum id penatibus et auctor  ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>10:09 am</span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="inbox.html">
										See all messages
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/images/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?=$_SESSION['login_nm']?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="#">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success" onclick="location.href = 'index.php?controller=config&action=inputPageMenu' ">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info" onclick="location.href = 'index.php?controller=config&action=inputPageInfo' ">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning" onclick="location.href = 'index.php?controller=config&action=dataBackup' ">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger" onclick="location.href = 'index.php?controller=config&action=inputPageConfig' ">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info" onclick="location.href = '' "></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger" onclick="location.href = '' "></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li>
						<a href="#">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 기초등록 
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<?
$sql = "select * from erp_menu";
$menu = mysql_fetch_object(mysql_query($sql));

$sql = "select * from erp_authority where emp_id='".$_SESSION['login_id']."'";
$auth = mysql_fetch_object(mysql_query($sql));
?>
					<li class="<? if($controller == "base") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								기준정보관리
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
						<ul class="submenu">
							
							<? if($menu->item_menu == "y" && $menu->item_menu == "y") {?>
							<li class="<? if($action == "listPageItem" || $action == "inputPageItem" || $action == "modifyPageItem") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageItem">
									<i class="menu-icon fa fa-caret-right"></i>
									품목관리
									<b class="menu-icon fa fa-caret-right"></b>
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							
							<? if($menu->account_menu == "y" && $menu->account_menu == "y") {?>
							<li class="<? if($action == "listPageAccount" || $action == "inputPageAccount" || $action == "modifyPageAccount") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageAccount">
									<i class="menu-icon fa fa-caret-right"></i>
									거래처관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->department_menu == "y" && $menu->department_menu == "y") {?>
							<li class="<? if($action == "listPageDepartment") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageDepartment">
									<i class="menu-icon fa fa-caret-right"></i>
									부서관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->position_menu == "y" && $menu->position_menu == "y") {?>
							<li class="<? if($action == "listPagePosition") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPagePosition">
									<i class="menu-icon fa fa-caret-right"></i>
									직위관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->employee_menu == "y" && $menu->employee_menu == "y") {?>
							<li class="<? if($action == "listPageEmployee" || $action == "inputPageEmployee" || $action == "modifyPageEmployee") echo "open"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=base&action=listPageEmployee">
									<i class="menu-icon fa fa-caret-right"></i>
									사원관리
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listPageEmployee") echo "active"; ?>">
										<a href="index.php?controller=base&action=listPageEmployee">
											<i class="menu-icon fa fa-caret-right"></i>
											사원리스트
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "inputPageEmployee" || $action == "modifyPageEmployee") echo "active"; ?>">
										<a href="index.php?controller=base&action=inputPageEmployee">
											<i class="menu-icon fa fa-caret-right"></i>
											사원등록
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<?}?>

							<? if($menu->warehouse_menu == "y" && $menu->warehouse_menu == "y") {?>
							<li class="<? if($action == "listPageWarehouse") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageWarehouse">
									<i class="menu-icon fa fa-caret-right"></i>
									창고등록
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->process_menu == "y" && $menu->process_menu == "y") {?>
							<li class="<? if($action == "listPageProcess") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageProcess">
									<i class="menu-icon fa fa-caret-right"></i>
									공정등록
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->machine_menu == "y" && $menu->machine_menu == "y") {?>
							<li class="<? if($action == "listPageMachine") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageMachine">
									<i class="menu-icon fa fa-caret-right"></i>
									생산기기등록
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							<? if($menu->machine_menu == "y" && $menu->machine_menu == "y") {?>
							<li class="<? if($action == "listPageDefectReason") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageDefectReason">
									<i class="menu-icon fa fa-caret-right"></i>
									불량유형 관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							<? if($menu->project_menu == "y" && $menu->project_menu == "y") {?>
							<li class="<? if($action == "listPageProject" || $action == "inputPageProject" || $action == "modifyPageProject") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageProject">
									<i class="menu-icon fa fa-caret-right"></i>
									프로젝트관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->excel_menu == "y" && $menu->excel_menu == "y") {?>
							<li class="<? if($action == "inputPageExcel" || $action == "downloadPageExcel") echo "active"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=base&action=inputPageExcel">
									<i class="menu-icon fa fa-caret-right"></i>
									엑셀자료등록<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "inputPageExcel") echo "active"; ?>">
										<a href="index.php?controller=base&action=inputPageExcel">
											<i class="menu-icon fa fa-caret-right"></i>
											엑셀자료등록
										</a>
									</li>

									<li class="<? if($action == "downloadPageExcel") echo "active"; ?>">
										<a href="index.php?controller=base&action=downloadPageExcel">
											<i class="menu-icon fa fa-caret-right"></i>
											엑셀자료보관
										</a>
									</li>
								</ul>
							</li>
							<?}?>
							<? if($menu->project_menu == "y" && $menu->project_menu == "y") {?>
							<li class="<? if($action == "listLotNo" || $action == "inputPageProject" || $action == "modifyPageProject") echo "active"; ?>">
								<a href="index.php?controller=base&action=listLotNo">
									<i class="menu-icon fa fa-caret-right"></i>
									LOT-NO 관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listStandardCode" || $action == "inputPageProject" || $action == "modifyPageProject") echo "active"; ?>">
								<a href="index.php?controller=base&action=listStandardCode">
									<i class="menu-icon fa fa-caret-right"></i>
									규격 코드 관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 영업관리 
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<li class="<? if($controller == "sales") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">
								영업관리
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<? if($menu->trade_menu == "y" && $menu->trade_menu == "y") {?>
							<li class="<? if($action == "listPageOrderReport" || $action == "inputPageOrderReport" || $action == "modifyPageOrderReport") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageOrderReport">
									<i class="menu-icon fa fa-caret-right"></i>
									거래명세서
									<b class="menu-icon fa fa-caret-right"></b>
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->estimate_menu == "y" && $menu->estimate_menu == "y") {?>
							<li class="<? if($action == "listPageEstimate" || $action == "inputPageEstimate" || $action == "modifyPageEstimate") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageEstimate">
									<i class="menu-icon fa fa-caret-right"></i>
									견적관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->order_menu == "y" && $menu->order_menu == "y") {?>
							<li class="<? if($action == "listPageOrder" || $action == "inputPageOrder" || $action == "modifyPageOrder") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageOrder">
									<i class="menu-icon fa fa-caret-right"></i>
									수주(주문)관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->shipment_menu == "y" && $menu->shipment_menu == "y") {?>
							<li class="<? if($action == "listPageOrderShipment" || $action == "inputPageOrderShipment") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageOrderShipment">
									<i class="menu-icon fa fa-caret-right"></i>
									출하관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->as_menu == "y" && $menu->as_menu == "y") {?>
							<li class="<? if($action == "listPageAs" || $action == "inputPageAs" || $action == "modifyPageAs") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageAs">
									<i class="menu-icon fa fa-caret-right"></i>
									AS관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->receive_menu == "y" && $menu->receive_menu == "y") {?>
							<li class="<? if($action == "listPageAccountReceivable" || $action == "inputPageAccountReceivable" || $action == "modifyPageAccountReceivable") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageAccountReceivable">
									<i class="menu-icon fa fa-caret-right"></i>
									미수금관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->sale_plan_menu == "y" && $menu->sale_plan_menu == "y") {?>
							<li class="<? if($action == "listPageSalesPlan" || $action == "inputPageSalesPlan" || $action == "modifyPageSalesPlan") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageSalesPlan">
									<i class="menu-icon fa fa-caret-right"></i>
									매출계획
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 구매관리 
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<li class="<? if($controller == "purchase") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> 구매관리 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<? if($menu->demand_menu == "y" && $menu->demand_menu == "y") {?>
							<li class="<? if($action == "listPagePurchaseDemand" || $action == "inputPagePurchaseDemand" || $action == "modifyPagePurchaseDemand") echo "active"; ?>">
								<a href="index.php?controller=purchase&action=listPagePurchaseDemand">
									<i class="menu-icon fa fa-caret-right"></i>
									구매요청
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->purchase_plan_menu == "y" && $menu->purchase_plan_menu == "y") {?>
							<li class="<? if($action == "listPagePurchasePlan" || $action == "inputPagePurchasePlan" || $action == "modifyPagePurchasePlan") echo "active"; ?>">
								<a href="index.php?controller=purchase&action=listPagePurchasePlan">
									<i class="menu-icon fa fa-caret-right"></i>
									발주계획
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->purchase_menu == "y" && $menu->purchase_menu == "y") {?>
							<!-- <li class="<? if($action == "listPagePurchase") echo "active"; ?>">
								<a href="index.php?controller=purchase&action=listPagePurchase">
									<i class="menu-icon fa fa-caret-right"></i>
									발주서
								</a>
								<b class="arrow"></b>
							</li> -->
							<?}?>

							<? if($menu->purchase_menu == "y" && $menu->purchase_menu == "y") {?>
							<li class="<? if($action == "listPurchaseOrder") echo "active"; ?>">
								<a href="index.php?controller=purchase&action=listPurchaseOrder">
									<i class="menu-icon fa fa-caret-right"></i>
									발주서
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->purchase_item_menu == "y" && $menu->purchase_item_menu == "y") {?>
							<li class="<? if($action == "listPagePurchaseItem" || $action == "listWarehousingItem" || $action == "listPageBarcodePurchaseItem" || $action == "registPagePurchaseItemBarcodeIn") echo "active"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=purchase&action=listPagePurchaseItem">
									<i class="menu-icon fa fa-caret-right"></i>
									구매(입고)
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<!-- <li class="<? if($action == "listPagePurchaseItem") echo "active"; ?>">
										<a href="index.php?controller=purchase&action=listPagePurchaseItem">
											<i class="menu-icon fa fa-caret-right"></i>
											구매조회(입고 - PC)
										</a>

										<b class="arrow"></b>
									</li> -->
									<li class="<? if($action == "listWarehousingItem") echo "active"; ?>">
										<a href="index.php?controller=purchase&action=listWarehousingItem">
											<i class="menu-icon fa fa-caret-right"></i>
											구매등록(입고 - PC)
										</a>

										<b class="arrow"></b>
									</li>
									<!-- <li class="<? if($action == "listPageBarcodePurchaseItem") echo "active"; ?>">
										<a href="index.php?controller=purchase&action=listPageBarcodePurchaseItem">
											<i class="menu-icon fa fa-caret-right"></i>
											구매(입고 - 바코드)
										</a>

										<b class="arrow"></b>
									</li> 
									<li class="<? if($action == "registPagePurchaseItemBarcodeIn") echo "active"; ?>">
										<a href="index.php?controller=purchase&action=registPagePurchaseItemBarcodeIn">
											<i class="menu-icon fa fa-caret-right"></i>
											구매입고 - 바코드
										</a>

										<b class="arrow"></b>
									</li>
									-->
								</ul>
							</li>
							<?}?>

							<? if($menu->amount_menu == "y" && $menu->amount_menu == "y") {?>
							<li class="<? if($action == "listPageAccountPavable" || $action == "inputPageAmountPavable" || $action == "modifyPageAmountPavable") echo "active"; ?>">
								<a href="index.php?controller=purchase&action=listPageAccountPavable">
									<i class="menu-icon fa fa-caret-right"></i>
									미지급금관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 생산관리
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<li class="<? if($controller == "production") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cogs"></i>
							<span class="menu-text"> 생산관리 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<? if($menu->bom_menu == "y" && $menu->bom_menu == "y") {?>
							<li class="<? if($action == "listPageBom" || $action == "inputPageBom") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageBom">
									<i class="menu-icon fa fa-caret-right"></i>
									BOM
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->bom_cal_menu == "y" && $menu->bom_cal_menu == "y") {?>
							<li class="<? if($action == "calBom") echo "active"; ?>">
								<a href="index.php?controller=production&action=calBom">
									<i class="menu-icon fa fa-caret-right"></i>
									BOM(소요량) 계산
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->outsourcing_menu == "y" && $menu->outsourcing_menu == "y") {?>
							<li class="<? if($action == "listPageOutsourcing" || $action == "inputPageOutsourcing" || $action == "modifyPageOutsourcing") echo "active"; ?>">
								<a href="index.php?controller=production&action=inputPageOutsourcing">
									<i class="menu-icon fa fa-caret-right"></i>
									외주공장관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<!--<li class="<? if($action == "listPageProductionPrice" || $action == "inputPageProductionPrice" || $action == "modifyPageProductionPrice") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageProductionPrice">
									<i class="menu-icon fa fa-caret-right"></i>
									원가관리
								</a>
								<b class="arrow"></b>
							</li>-->

							<? if($menu->workplan_menu == "y" && $menu->workplan_menu == "y") {?>
							<li class="<? if($action == "listPageWorkPlan" || $action == "inputPageWorkPlan" || $action == "modifyPageWorkPlan") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageWorkPlan">
									<i class="menu-icon fa fa-caret-right"></i>
									생산계획
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->workplan_bom_menu == "y" && $menu->workplan_bom_menu == "y") {?>
							<li class="<? if($action == "listPageWorkPlanBom" || $action == "viewPageWorkPlanBom") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageWorkPlanBom">
									<i class="menu-icon fa fa-caret-right"></i>
									생산계획별 소요 자재 현황 조회
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>														

							<!-- <? if($menu->work_menu == "y" && $menu->work_menu == "y") {?>
							<li class="<? if($action == "listPageWork" || $action == "inputPageWork" || $action == "modifyPageWork") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageWork">
									<i class="menu-icon fa fa-caret-right"></i>
									작업지시서
								</a>
								<b class="arrow"></b>
							</li>
							<?}?> -->
							<? if($menu->work_menu == "y" && $menu->work_menu == "y") {?>
							<li class="<? if($action == "listPageWorkOrder" || $action == "inputPageWorkOrder" || $action == "modifyPageWorkOrder") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageWorkOrder">
									<i class="menu-icon fa fa-caret-right"></i>
									작업지시서
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							<? if($menu->work_menu == "y" && $menu->work_menu == "y") {?>
							<li class="<? if($action == "listPageProductionInto" ) echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageProductionInto">
									<i class="menu-icon fa fa-caret-right"></i>
									생산입고
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							
							<!--	
							<? if($menu->qc_menu == "y" && $menu->qc_menu == "y") {?>
							<li class="<? if($action == "listPageQc") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageQc">
									<i class="menu-icon fa fa-caret-right"></i>
									품질관리(QC)
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							
<!-- 							<? if($menu->defective_menu == "y" && $menu->defective_menu == "y") {?> -->
<!-- 							<li class="<? if($action == "listPageDefective") echo "active"; ?>"> -->
<!-- 								<a href="index.php?controller=production&action=listPageDefective"> -->
<!-- 									<i class="menu-icon fa fa-caret-right"></i> -->
<!-- 									불량관리 -->
<!-- 								</a> -->
<!-- 								<b class="arrow"></b> -->
<!-- 							</li> -->
<!-- 							<?}?> -->

							<? if($menu->defective_menu == "y" && $menu->defective_menu == "y") {?>
							<li class="<? if($action == "listProductPerfReports") echo "active"; ?>">
								<a href="index.php?controller=production&action=listProductPerfReports">
									<i class="menu-icon fa fa-caret-right"></i>
									생산실적처리(Press)
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->defective_menu == "y" && $menu->defective_menu == "y") {?>
							<li class="<? if($action == "listProductPerfPlate") echo "active"; ?>">
								<a href="index.php?controller=production&action=listProductPerfPlate">
									<i class="menu-icon fa fa-caret-right"></i>
									생산실적관리(도금)
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							
							<? if($menu->defective_menu == "y" && $menu->defective_menu == "y") {?>
							<li class="<? if($action == "listPagePPReportsClean") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPagePPReportsClean">
									<i class="menu-icon fa fa-caret-right"></i>
									생산실적관리(세척)
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							
							<? if($menu->defective_menu == "y" && $menu->defective_menu == "y") {?>
							<li class="<? if($action == "listPagePPReportsPacking") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPagePPReportsPacking">
									<i class="menu-icon fa fa-caret-right"></i>
									생산실적관리(검사/포장)
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->defective_menu == "y" && $menu->defective_menu == "y") {?>
							<li class="<? if($action == "listLotNoManagementReport") echo "active"; ?>">
								<a href="index.php?controller=production&action=listLotNoManagementReport">
									<i class="menu-icon fa fa-caret-right"></i>
									LOT 관리대장
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->defective_menu == "y" && $menu->defective_menu == "y") {?>
							<li class="<? if($action == "listPagePPReportsPrint") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPagePPReportsPrint">
									<i class="menu-icon fa fa-caret-right"></i>
									공정이동표출력
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 재고관리
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<li class="<? if($controller == "items") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pie-chart"></i>
							<span class="menu-text"> 재고관리 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
<!-- 							<? if($menu->stock_menu == "y" && $menu->stock_menu == "y") {?> -->
<!-- 							<li class="<? if($action == "listPageStock") echo "active"; ?>"> -->
<!-- 								<a href="index.php?controller=items&action=listPageStock"> -->
<!-- 									<i class="menu-icon fa fa-caret-right"></i> -->
<!-- 									재고현황 -->
<!-- 								</a> -->
<!-- 								<b class="arrow"></b> -->
<!-- 							</li> -->
<!-- 							<?}?> -->

							<? if($menu->warehouse_stock_menu == "y" && $menu->warehouse_stock_menu == "y") {?>
							<li class="<? if($action == "listPageWarehouseStock") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageWarehouseStock">
									<i class="menu-icon fa fa-caret-right"></i>
									창고별재고관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
					<!--
							<? if($menu->price_menu == "y" && $menu->price_menu == "y") {?>
							<li class="<? if($action == "listPageStockPrice") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageStockPrice">
									<i class="menu-icon fa fa-caret-right"></i>
									단가관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
					-->
							<? if($menu->release_menu == "y" && $menu->release_menu == "y") {?>
							<li class="<? if($action == "listPageReleaseRequest" || $action == "inputPageReleaseRequestPop" || $action == "modifyPageReleaseRequestPop" || $action == "listPageBarcodeReleaseItem" || $action == "listPageItemInout" || $action == "registPageReleaseItemBarcodeOut") echo "active"; ?>">
								<a class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									자재출고관리
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listPageReleaseRequest" || $action == "inputPageReleaseRequestPop" || $action == "modifyPageReleaseRequestPop" ) echo "active"; ?>">
										<a href="index.php?controller=items&action=listPageReleaseRequest">
											<i class="menu-icon fa fa-caret-right"></i>
											출고요청서 (PC)
										</a>

										<b class="arrow"></b>
									</li>

									<!-- <li class="<? if($action == "listPageBarcodeReleaseItem") echo "active"; ?>">
										<a href="index.php?controller=items&action=listPageBarcodeReleaseItem">
											<i class="menu-icon fa fa-caret-right"></i>
											출고 (바코드)
										</a>

										<b class="arrow"></b>
									</li> -->

									<li class="<? if($action == "registPageReleaseItemBarcodeOut") echo "active"; ?>">
										<a href="index.php?controller=items&action=registPageReleaseItemBarcodeOut">
											<i class="menu-icon fa fa-caret-right"></i>
											바코드출고
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageItemInout") echo "active"; ?>">
										<a href="index.php?controller=items&action=listPageItemInout">
											<i class="menu-icon fa fa-caret-right"></i>
											자재수불부
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<?}?>

							<? if($menu->barcode_menu == "y" && $menu->barcode_menu == "y") {?>
							<li class="<? if($action == "listPageBarcode") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageBarcode">
									<i class="menu-icon fa fa-caret-right"></i>
									바코드관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->real_stock_menu == "y" && $menu->real_stock_menu == "y") {?>
							<li class="<? if($action == "listPageRealStock") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageRealStock">
									<i class="menu-icon fa fa-caret-right"></i>
									재고조정
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							
							<? if($menu->safety_menu == "y" && $menu->safety_menu == "y") {?>
							<li class="<? if($action == "listPageSafetyStock") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageSafetyStock">
									<i class="menu-icon fa fa-caret-right"></i>
									안전재고관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							<? //if($menu->safety_menu == "y" && $menu->safety_menu == "y") {?>
							<li class="<? if($action == "listPageLotNo" || $action == "viewPageLotNo") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageLotNo">
									<i class="menu-icon fa fa-caret-right"></i>
									Lot No 추적
								</a>
								<b class="arrow"></b>
							</li>
							<?//}?>

							<!--<li class="<? if($action == "listPageMold" || $action == "inputPageMold") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageMold">
									<i class="menu-icon fa fa-caret-right"></i>
									금형관리
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageScrap" || $action == "inputPageScrap" || $action == "modifyPageScrap") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageScrap">
									<i class="menu-icon fa fa-caret-right"></i>
									파지관리
								</a>
								<b class="arrow"></b>
							</li>-->
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 설비관리
<!----------------------------------------------------------------------------------------------------------------------------------------------------->					<!--
					<li class="<? if($controller == "facilities") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-tachometer" aria-hidden="true"></i>
							<span class="menu-text"> 설비관리 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<? if($menu->qc_menu == "y" && $menu->qc_menu == "y") {?>
							<li class="<? if($action == "listPageFacilityManagement") echo "active"; ?>">
								<a href="index.php?controller=facilities&action=listPageFacilityManagement">
									<i class="menu-icon fa fa-caret-right"></i>
									설비가동관리(보전)
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							<? if($menu->qc_menu == "y" && $menu->qc_menu == "y") {?>
							<li class="<? if($action == "listPageFacilityManagement") echo "active"; ?>">
								<a href="index.php?controller=facilities&action=listPageFacilityManagement">
									<i class="menu-icon fa fa-caret-right"></i>
									설비점검·수리이력
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							<? if($menu->qc_menu == "y" && $menu->qc_menu == "y") {?>
							<li class="<? if($action == "listPageFacilityManagement") echo "active"; ?>">
								<a href="index.php?controller=facilities&action=listPageFacilityManagement">
									<i class="menu-icon fa fa-caret-right"></i>
									설비등록
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
						</ul>
					</li>
				-->
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 금형관리
<!----------------------------------------------------------------------------------------------------------------------------------------------------->					
					<li class="<? if($controller == "mold") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-gavel" aria-hidden="true"></i>
							<span class="menu-text"> 금형관리 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<? if($menu->qc_menu == "y" && $menu->qc_menu == "y") {?>
							<li class="<? if($action == "registPageMold") echo "active"; ?>">
								<a href="index.php?controller=mold&action=registPageMold">
									<i class="menu-icon fa fa-caret-right"></i>
									금형등록
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							<? if($menu->qc_menu == "y" && $menu->qc_menu == "y") {?>
							<li class="<? if($action == "listPageMoldRepair") echo "active"; ?>">
								<a href="index.php?controller=mold&action=listPageMoldRepair">
									<i class="menu-icon fa fa-caret-right"></i>
									금형 점검·수리이력
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							<? if($menu->qc_menu == "y" && $menu->qc_menu == "y") {?>
							<li class="<? if($action == "registPageMoldHits") echo "active"; ?>">
								<a href="index.php?controller=mold&action=registPageMoldHits">
									<i class="menu-icon fa fa-caret-right"></i>
									금형타수관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 회계
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!--
					<li class="<? if($controller == "accounting") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> 회계 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">

							<li class="<? if(($controller == "accounting" && ($action == "registPartReg" || $action == "inputPageAccounting" || $action == "creditcard_regist" || $action == "bank_regist" || $action == "registPrintApproval" || $action == "cardCompany_regist" || $action == "listPageAccountingCode" || $action == "contract_regist")) || ($controller == "employee" && ($action == "listPageDepartment" || $action == "inputPageEmployee")) || ($controller == "sales" &&($action == "listPageAccount" )) || ($controller == "groupware" &&($action == "listPageProject" || $action == "listPageEleSettlementLine" ))) echo "active open"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=accounting&action=registPartReg">
								   <i class="menu-icon fa fa-caret-right"></i>
								   기초등록
								   <b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
								
									<li class="<? if($action == "registPartReg" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=registPartReg">
											<i class="menu-icon fa fa-caret-right"></i>
											회사등록/회계연도
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "inputPageAccounting" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=inputPageAccounting">
											<i class="menu-icon fa fa-caret-right"></i>
											기초잔액입력
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "creditcard_regist" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=creditcard_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											신용카드등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "bank_regist" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=bank_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											통장계좌등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "registPrintApproval" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=registPrintApproval">
											<i class="menu-icon fa fa-caret-right"></i>
											인쇄용결재라인등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "listPageEleSettlementLine" ) echo "active"; ?>">
										<a href="index.php?controller=groupware&action=listPageEleSettlementLine">
											<i class="menu-icon fa fa-caret-right"></i>
											결재라인등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "cardCompany_regist" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=cardCompany_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											카드사등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "listPageAccountingCode" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=listPageAccountingCode">
											<i class="menu-icon fa fa-caret-right"></i>
											계정코드등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "listPageAccountingCode" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=listPageAccountingCodeTree">
											<i class="menu-icon fa fa-caret-right"></i>
											계정코드등록(Tree)
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="<? if($controller == "accounting" && ($action == "listGeneralStatement" || $action == "listSalesStatement" || $action == "listPurchaseStatement")) echo "active open"; ?>">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									매입매출거래

									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listGeneralStatement" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=listGeneralStatement">
											<i class="menu-icon fa fa-caret-right"></i>
											일반전표
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "listSalesStatement" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=listSalesStatement">
											<i class="menu-icon fa fa-caret-right"></i>
											매출전표
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "listPurchaseStatement" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=listPurchaseStatement">
											<i class="menu-icon fa fa-caret-right"></i>
											매입전표
										</a>
										<b class="arrow"></b>
									</li>
									
								</ul>
							</li>
							<li class="<? if($controller == "accounting" && ($action == "registDepositReport" || $action == "registCustomerDeposit" || $action == "registSpendingResolution" || $action == "registSpendingResolution" || $action == "registPurchaseDeposit" )) echo "active open"; ?>">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									현금거래

									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
								<li class="<? if($controller == "accounting" && ($action == "registDepositReport" || $action == "registCustomerDeposit" )) echo "active open"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=accounting&action=registDepositReport">
								   <i class="menu-icon fa fa-caret-right"></i>
								   현금예금입금
								   <b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
									<ul class="submenu">
									
										<li class="<? if($action == "registDepositReport" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=registDepositReport">
												<i class="menu-icon fa fa-caret-right"></i>
												입금보고서
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "registCustomerDeposit" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=registCustomerDeposit">
												<i class="menu-icon fa fa-caret-right"></i>
												매출처입금
											</a>
											<b class="arrow"></b>
										</li>
									</ul>
								</li>

								<li class="<? if($controller == "accounting" && ($action == "registSpendingResolution" || $action == "registPurchaseDeposit" )) echo "active open"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=accounting&action=registSpendingResolution">
								   <i class="menu-icon fa fa-caret-right"></i>
								   현금예금출금
								   <b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
									<ul class="submenu">
									
										<li class="<? if($action == "registSpendingResolution" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=registSpendingResolution">
												<i class="menu-icon fa fa-caret-right"></i>
												지출결의서
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "registPurchaseDeposit" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=registPurchaseDeposit">
												<i class="menu-icon fa fa-caret-right"></i>
												매입처출금
											</a>
											<b class="arrow"></b>
										</li>
									</ul>
								</li>
								</ul>
							</li>

							<li class="<? if($controller == "accounting" && ($action == "registGeneralReceipts" || $action == "registCardSalesSlips" || $action == "registSettleAccPrepayments" || $action == "listDressingSettlement" || $action == "registEtcDeposit")) echo "active open"; ?>">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									비현금거래

									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "registGeneralReceipts" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=registGeneralReceipts">
											<i class="menu-icon fa fa-caret-right"></i>
											일반영수증
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "registCardSalesSlips" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=registCardSalesSlips">
											<i class="menu-icon fa fa-caret-right"></i>
											신용카드전표
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "registSettleAccPrepayments" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=registSettleAccPrepayments">
											<i class="menu-icon fa fa-caret-right"></i>
											가지급금정산서
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "listDressingSettlement" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=listDressingSettlement">
											<i class="menu-icon fa fa-caret-right"></i>
											결산전표처리
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "registEtcDeposit" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=registEtcDeposit">
											<i class="menu-icon fa fa-caret-right"></i>
											기타
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="<? if($controller == "accounting" && ($action == "listFixedAssets" || $action == "registFixedAssetsIncrement" || $action == "registFixedAssetsDecrease" || $action == "listFixedAssetsStatement" || $action == "listFixedAssetsType" || $action == "listFixedAssetsCode" || $action == "listFixedAssets" || $action == "registDepreciationCost")) echo "active open"; ?>">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									고정자산
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">									
									<li class="<? if($action == "listFixedAssets" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=listFixedAssets">
											<i class="menu-icon fa fa-caret-right"></i>
											고정자산대장
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "registFixedAssetsIncrement" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=registFixedAssetsIncrement">
											<i class="menu-icon fa fa-caret-right"></i>
											고정자산증가
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "registFixedAssetsDecrease" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=registFixedAssetsDecrease">
											<i class="menu-icon fa fa-caret-right"></i>
											고정자산감소
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "listFixedAssetsStatement" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=listFixedAssetsStatement">
											<i class="menu-icon fa fa-caret-right"></i>
											고정자산전표조회
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "listFixedAssetsType" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=listFixedAssetsType">
											<i class="menu-icon fa fa-caret-right"></i>
											고정자산유형등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "listFixedAssetsCode" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=listFixedAssetsCode">
											<i class="menu-icon fa fa-caret-right"></i>
											고정자산코드등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "registDepreciationCost" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=registDepreciationCost">
											<i class="menu-icon fa fa-caret-right"></i>
											감사상각비등록
										</a>
										<b class="arrow"></b>
									</li>

									
								</ul>
							</li>
							<li class="<? if($controller == "accounting" && ($action == "listAccountingSearch" || $action == "listAccountingPrint" )) echo "active open"; ?>">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									전표관리

									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listAccountingSearch" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=listAccountingSearch">
											<i class="menu-icon fa fa-caret-right"></i>
											전표조회/수정
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "listAccountingPrint" ) echo "active"; ?>">
										<a href="index.php?controller=accounting&action=listAccountingPrint">
											<i class="menu-icon fa fa-caret-right"></i>
											전표인쇄
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="<? if($controller == "accounting" && ($action == "listGeneralLedgerAccount" || $action == "listCustomerAccountLedger" || $action == "listPurchaseSalesLedger"|| $action == "listCashBook"|| $action == "listJournal"|| $action == "listDailyMonthlyAccount"|| $action == "listTransactionalBillTable" || $action == "listCompoundTrialBalance" || $action == "listStatementFinancialPosition" || $action == "listIncomeStatement"|| $action == "listCostSpecification"|| $action == "listAccountStatement" || $action == "listFundsJournal" || $action == "listCostBenefitAnalysis" || $action == "listCostAnalysis" || $action == "listFundsJournal"  )) echo "active open"; ?>">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									출력물관리

									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
								<li class="<? if($controller == "accounting" && ($action == "listGeneralLedgerAccount" || $action == "listCustomerAccountLedger" || $action == "listPurchaseSalesLedger"|| $action == "listCashBook"|| $action == "listJournal"|| $action == "listDailyMonthlyAccount"|| $action == "listTransactionalBillTable" )) echo "active open"; ?>">
									<a class="dropdown-toggle" href="index.php?controller=accounting&action=listGeneralLedgerAccount">
									   <i class="menu-icon fa fa-caret-right"></i>
									   <span style='font-weight:bold'>장부관리</span>
									   <b class="arrow fa fa-angle-down"></b>
									</a>

									<b class="arrow"></b>
									<ul class="submenu">
										<li class="<? if($action == "listGeneralLedgerAccount" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listGeneralLedgerAccount">
												<i class="menu-icon fa fa-caret-right"></i>
												계정별원장
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "listCustomerAccountLedger" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listCustomerAccountLedger">
												<i class="menu-icon fa fa-caret-right"></i>
												거래처별원장
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "listPurchaseSalesLedger" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listPurchaseSalesLedger">
												<i class="menu-icon fa fa-caret-right"></i>
												매입/매출장
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "listCashBook" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listCashBook">
												<i class="menu-icon fa fa-caret-right"></i>
												현금출납장
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "listJournal" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listJournal">
												<i class="menu-icon fa fa-caret-right"></i>
												분개장
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "listDailyMonthlyAccount" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listDailyMonthlyAccount">
												<i class="menu-icon fa fa-caret-right"></i>
												일/월계표
											</a>
											<b class="arrow"></b>
										</li>
										
										<li class="<? if($action == "listTransactionalBillTable" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listTransactionalBillTable">
												<i class="menu-icon fa fa-caret-right"></i>
												거래처거래내역조회
											</a>
											<b class="arrow"></b>
										</li>
									</ul>
								</li>

								<li class="<? if($controller == "accounting" && ($action == "listCompoundTrialBalance" || $action == "listStatementFinancialPosition" || $action == "listIncomeStatement"|| $action == "listCostSpecification"|| $action == "listAccountStatement" || $action == "listFundsJournal" || $action == "listCostBenefitAnalysis" || $action == "listCostAnalysis" || $action == "listFundsJournal" )) echo "active open"; ?>">
									<a class="dropdown-toggle" href="index.php?controller=accounting&action=listCompoundTrialBalance">
									   <i class="menu-icon fa fa-caret-right"></i>
									   경영자료
									   <b class="arrow fa fa-angle-down"></b>
									</a>

									<b class="arrow"></b>
									<ul class="submenu">
										<li class="<? if($action == "inputPageInstallation" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listCompoundTrialBalance">
												<i class="menu-icon fa fa-caret-right"></i>
												합계잔액시산표
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "inputPageInstallation" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listStatementFinancialPosition">
												<i class="menu-icon fa fa-caret-right"></i>
												재무상태표
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "inputPageInstallation" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listIncomeStatement">
												<i class="menu-icon fa fa-caret-right"></i>
												손익계산서
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "inputPageInstallation" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listCostSpecification">
												<i class="menu-icon fa fa-caret-right"></i>
												원가명세서
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "inputPageInstallation" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listAccountStatement">
												<i class="menu-icon fa fa-caret-right"></i>
												계정명세서
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "inputPageInstallation" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listFundsJournal">
												<i class="menu-icon fa fa-caret-right"></i>
												자금일보
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "inputPageInstallation" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listCostBenefitAnalysis">
												<i class="menu-icon fa fa-caret-right"></i>
												월별손익분석
											</a>
											<b class="arrow"></b>
										</li>
										<li class="<? if($action == "inputPageInstallation" ) echo "active"; ?>">
											<a href="index.php?controller=accounting&action=listCostAnalysis">
												<i class="menu-icon fa fa-caret-right"></i>
												월별원가분석
											</a>
											<b class="arrow"></b>
										</li>
										
									</ul>
								</li>
								</ul>
							</li>
								
								
							</li>
						</ul>
					</li>

<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 인사/급여
<!----------------------------------------------------------------------------------------------------------------------------------------------------->			<!--	
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file-o" aria-hidden="true"></i>
							<span class="menu-text"> 인사/급여 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<? if($controller == "salary" && ($action == "registSalaryItme" || $action == "registDeclarationItem" || $action == "listPayCheck"|| $action == "listPayrollBook"|| $action == "listPrintPaySlip" )) echo "active open"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=salary&action=registSalaryItme">
									<i class="menu-icon fa fa-caret-right"></i>
									급여관리
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "registSalaryItme" ) echo "active"; ?>">
										<a href="index.php?controller=salary&action=registSalaryItme">
											<i class="menu-icon fa fa-caret-right"></i>
											수당항목
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "registDeclarationItem" ) echo "active"; ?>">
										<a href="index.php?controller=salary&action=registDeclarationItem">
											<i class="menu-icon fa fa-caret-right"></i>
											공재항목
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPayCheck" ) echo "active"; ?>">
										<a href="index.php?controller=salary&action=listPayCheck">
											<i class="menu-icon fa fa-caret-right"></i>
											급여입력
										</a>

										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "listPayrollBook" ) echo "active"; ?>">
										<a href="index.php?controller=salary&action=listPayrollBook">
											<i class="menu-icon fa fa-caret-right"></i>
											급여대장
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "listPrintPaySlip" ) echo "active"; ?>">
										<a href="index.php?controller=salary&action=listPrintPaySlip">
											<i class="menu-icon fa fa-caret-right"></i>
											명세서인쇄
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="">
								<a class="dropdown-toggle" href="index.php?controller=employee&action=listPageEmployee">
									<i class="menu-icon fa fa-caret-right"></i>
									일용직관리
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="index.php?controller=employee&action=listPageDailyWorker">
											<i class="menu-icon fa fa-caret-right"></i>
											일용직 리스트
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="index.php?controller=employee&action=inputPageDailyWorker">
											<i class="menu-icon fa fa-caret-right"></i>
											일용직 등록
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="index.php?controller=employee&action=inputPageEmployee">
											<i class="menu-icon fa fa-caret-right"></i>
											일용직 노무시간 등록
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
						</ul>
				</li>

<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 그룹웨어
<!----------------------------------------------------------------------------------------------------------------------------------------------------->			<!--		
					<li class="<? if($controller == "groupware") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-newspaper-o"></i>
							<span class="menu-text"> 그룹웨어 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<? if($menu->ele_menu == "y" && $menu->ele_menu == "y") {?>
							<li class="<? if($action == "listPageEleSettlementLine" || $action == "inputPageEleSettlementLine" || $action == "listPageMyEleSettlement" || $action == "inputPageEleSettlement" || $action == "listPageEleSettlement") echo "active"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=groupware&action=inputPageEleSettlement">
									<i class="menu-icon fa fa-caret-right"></i>
									전자결재
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listPageEleSettlementLine" || $action == "inputPageEleSettlementLine") echo "active"; ?>">
										<a href="index.php?controller=groupware&action=listPageEleSettlementLine">
											<i class="menu-icon fa fa-caret-right"></i>
											결재라인
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageMyEleSettlement" || $action == "inputPageEleSettlement") echo "active"; ?>">
										<a href="index.php?controller=groupware&action=listPageMyEleSettlement">
											<i class="menu-icon fa fa-caret-right"></i>
											내 기안함
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageEleSettlement" || $action == "modifyPageEleSettlement") echo "active"; ?>">
										<a href="index.php?controller=groupware&action=listPageEleSettlement">
											<i class="menu-icon fa fa-caret-right"></i>
											결재리스트
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<?}?>

							<? if($menu->crm_menu == "y" && $menu->crm_menu == "y") {?>
							<li class="<? if($action == "listPageCrm" || $action == "inputPageCrm" || $action == "modifyPageCrm") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageCrm">
									<i class="menu-icon fa fa-caret-right"></i>
									고객관리(CRM)
								</a>
								<b class="arrow"></b>
								
							</li>
							<?}?>

							<? if($menu->board_menu == "y" && $menu->board_menu == "y") {?>
							<li class="<? if($action == "listPageBoard" || $action == "inputPageBoard" || $action == "modifyPageBoard") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageBoard">
									<i class="menu-icon fa fa-caret-right"></i>
									업무공유
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->schedule_menu == "y" && $menu->schedule_menu == "y") {?>
							<li class="<? if($action == "listPageSchedule" || $action == "inputPageSchedule" || $action == "listPageScheduleMonth" || $action == "listPageScheduleWeek" || $action == "listPageScheduleDay") echo "active"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=groupware&action=listPageSchedule">
									<i class="menu-icon fa fa-caret-right"></i>
									일정관리
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listPageSchedule" || $action == "inputPageSchedule") echo "active"; ?>">
										<a href="index.php?controller=groupware&action=listPageSchedule">
											<i class="menu-icon fa fa-caret-right"></i>
											일정등록
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageScheduleMonth") echo "active"; ?>">
										<a href="index.php?controller=groupware&action=listPageScheduleMonth">
											<i class="menu-icon fa fa-caret-right"></i>
											월간일정
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageScheduleWeek") echo "active"; ?>">
										<a href="index.php?controller=groupware&action=listPageScheduleWeek">
											<i class="menu-icon fa fa-caret-right"></i>
											주간일정
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageScheduleDay") echo "active"; ?>">
										<a href="index.php?controller=groupware&action=listPageScheduleDay">
											<i class="menu-icon fa fa-caret-right"></i>
											일간일정
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<?}?>

							<? if($menu->leave_menu == "y" && $menu->leave_menu == "y") {?>
							<li class="<? if($action == "listPageEmpWorkLeave") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageEmpWorkLeave">
									<i class="menu-icon fa fa-caret-right"></i>
									출퇴근관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->file_menu == "y" && $menu->file_menu == "y") {?>
							<li class="<? if($action == "listPageFile" || $action == "inputPageFile" || $action == "modifyPageFile") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageFile">

									<i class="menu-icon fa fa-caret-right"></i>
									파일보관함
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->goods_menu == "y" && $menu->goods_menu == "y") {?>
							<li class="<? if($action == "listPagePublicThing" || $action == "inputPagePublicThing" || $action == "modifyPagePublicThing") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPagePublicThing">
									<i class="menu-icon fa fa-caret-right"></i>
									공용품관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->car_menu == "y" && $menu->car_menu == "y") {?>
							<li class="<? if($action == "listPageCar" || $action == "inputPageCar" || $action == "modifyPageCar") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageCar">
									<i class="menu-icon fa fa-caret-right"></i>
									차량관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>

							<? if($menu->installation_menu == "y" && $menu->installation_menu == "y") {?>
							<li class="<? if($action == "listPageInstallation" || $action == "inputPageInstallation" || $action == "modifyPageInstallation") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageInstallation">
									<i class="menu-icon fa fa-caret-right"></i>
									시설관리
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
							<li class="<? if($action == "listPageError" || $action == "inputPageError") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageError">
									<i class="menu-icon fa fa-caret-right"></i>
									오류신고
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageItem" || $action == "inputPageVersion") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageVersion">
									<i class="menu-icon fa fa-caret-right"></i>
									버전관리
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>