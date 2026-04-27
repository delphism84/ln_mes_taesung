<?
extract($_POST);
extract($_GET);
$folder = "yeonam";
?>
<!DOCTYPE html>
<html lang="en">
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
						<? if($_SESSION['login_level'] >= 100) { ?><a href="index.php?controller=config&action=initialization" class="btn btn-minier btn-danger" style="margin-top:10px">데이터초기화</a><?}?>
						<a href="clear.php" class="btn btn-minier btn-danger" style="margin-top:10px">테스트데이터초기화</a>
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
						<a href="index.php?controller=pages&action=home">
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

							<li class="<? if($action == "listPageItem" || $action == "inputPageItem" || $action == "modifyPageItem" || $action == "listPageItemClassify" || $action == "listPageItemGroup") echo "open"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=base&action=listPageItem">
									<i class="menu-icon fa fa-caret-right"></i>
									품목 관리
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listPageItemClassify") echo "active"; ?>">
										<a href="index.php?controller=base&action=listPageItemClassify">
											<i class="menu-icon fa fa-caret-right"></i>
											품목구분 관리
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageItemGroup") echo "active"; ?>">
										<a href="index.php?controller=base&action=listPageItemGroup">
											<i class="menu-icon fa fa-caret-right"></i>
											품목그룹 관리
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageItem" || $action == "inputPageItem" || $action == "modifyPageItem") echo "active"; ?>">
										<a href="index.php?controller=base&action=listPageItem">
											<i class="menu-icon fa fa-caret-right"></i>
											품목 관리
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>

							<li class="<? if($action == "listPageAccount" || $action == "inputPageAccount" || $action == "modifyPageAccount" || $action == "listPageAccountClassify") echo "open"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=base&action=listPageAccount">
									<i class="menu-icon fa fa-caret-right"></i>
									거래처 관리
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listPageAccountClassify") echo "active"; ?>">
										<a href="index.php?controller=base&action=listPageAccountClassify">
											<i class="menu-icon fa fa-caret-right"></i>
											거래처구분 관리
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageAccount" || $action == "inputPageAccount" || $action == "modifyPageAccount") echo "active"; ?>">
										<a href="index.php?controller=base&action=listPageAccount">
											<i class="menu-icon fa fa-caret-right"></i>
											거래처 관리
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>

							<li class="<? if($action == "listPageDepartment") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageDepartment">
									<i class="menu-icon fa fa-caret-right"></i>
									부서 관리
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPagePosition") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPagePosition">
									<i class="menu-icon fa fa-caret-right"></i>
									직위 관리
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageEmployee" || $action == "inputPageEmployee" || $action == "modifyPageEmployee") echo "open"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=base&action=listPageEmployee">
									<i class="menu-icon fa fa-caret-right"></i>
									사원 관리
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
							<li class="<? if($action == "listPageWarehouse") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageWarehouse">
									<i class="menu-icon fa fa-caret-right"></i>
									창고 관리
								</a>
								<b class="arrow"></b>
							</li>
							
							<?
							//require_once("assets/menu/yeonam_base_menu.php");
							?>

							<li class="<? if($action == "listPageProcess") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageProcess">
									<i class="menu-icon fa fa-caret-right"></i>
									공정 관리
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageMachine") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageMachine">
									<i class="menu-icon fa fa-caret-right"></i>
									생산기기(팀) 관리
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageDefectReason") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageDefectReason">
									<i class="menu-icon fa fa-caret-right"></i>
									불량사유 관리
								</a>
								<b class="arrow"></b>
							</li>


							<li class="<? if($action == "listPageQcItem" || $action == "listPageQcClassify") echo "open"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=base&action=listPageQcClassify">
									<i class="menu-icon fa fa-caret-right"></i>
									검사항목 관리
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listPageQcClassify") echo "active"; ?>">
										<a href="index.php?controller=base&action=listPageQcClassify">
											<i class="menu-icon fa fa-caret-right"></i>
											검사구분 관리
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageQcItem") echo "active"; ?>">
										<a href="index.php?controller=base&action=listPageQcItem">
											<i class="menu-icon fa fa-caret-right"></i>
											검사항목 관리
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>

							<li class="<? if($action == "listPageProject" || $action == "inputPageProject" || $action == "modifyPageProject") echo "active"; ?>">
								<a href="index.php?controller=base&action=listPageProject">
									<i class="menu-icon fa fa-caret-right"></i>
									프로젝트 관리
								</a>
								<b class="arrow"></b>
							</li>

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
							<li class="<? if($action == "listPageOrderReport" || $action == "inputPageOrderReport" || $action == "modifyPageOrderReport") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageOrderReport">
									<i class="menu-icon fa fa-caret-right"></i>
									거래명세서
									<b class="menu-icon fa fa-caret-right"></b>
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageEstimate" || $action == "inputPageEstimate" || $action == "modifyPageEstimate") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageEstimate">
									<i class="menu-icon fa fa-caret-right"></i>
									견적관리
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageOrder" || $action == "inputPageOrder" || $action == "modifyPageOrder") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageOrder">
									<i class="menu-icon fa fa-caret-right"></i>
									수주(주문)관리
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageOrderShipment" || $action == "inputPageOrderShipment") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageOrderShipment">
									<i class="menu-icon fa fa-caret-right"></i>
									출하관리
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageAs" || $action == "inputPageAs" || $action == "modifyPageAs") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageAs">
									<i class="menu-icon fa fa-caret-right"></i>
									AS관리
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageAccountReceivable" || $action == "inputPageAccountReceivable" || $action == "modifyPageAccountReceivable") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageAccountReceivable">
									<i class="menu-icon fa fa-caret-right"></i>
									미수금관리
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageSalesPlan" || $action == "inputPageSalesPlan" || $action == "modifyPageSalesPlan") echo "active"; ?>">
								<a href="index.php?controller=sales&action=listPageSalesPlan">
									<i class="menu-icon fa fa-caret-right"></i>
									매출계획
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 설계관리 
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<!--<li class="<? if($controller == "cosmo") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">
								설계관리
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<? if($action == "listPagePlanBook" || $action == "inputPagePlanBook" || $action == "modifyPagePlanBook") echo "active"; ?>">
								<a href="index.php?controller=cosmo&action=listPagePlanBook">
									<i class="menu-icon fa fa-caret-right"></i>
									설계대장
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageSupplyPlan" || $action == "inputPageSupplyPlan" || $action == "modifyPageSupplyPlan") echo "active"; ?>">
								<a href="index.php?controller=cosmo&action=listPageSupplyPlan">
									<i class="menu-icon fa fa-caret-right"></i>
									물량설계서
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageAcc" || $action == "inputPageAcc" || $action == "modifyPageAcc") echo "active"; ?>">
								<a href="index.php?controller=cosmo&action=listPageAcc">
									<i class="menu-icon fa fa-caret-right"></i>
									악세서리
								</a>
								<b class="arrow"></b>
							</li>
							<? if($menu->bom_menu == "y" && $menu->bom_menu == "y") {?>
							<li class="<? if($action == "listPageBom" || $action == "inputPageBom") echo "active"; ?>">
								<a href="index.php?controller=cosmo&action=listPageBom">
									<i class="menu-icon fa fa-caret-right"></i>
									BOM(소요량)
								</a>
								<b class="arrow"></b>
							</li>
							<?}?>
						</ul>
					</li>-->

<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 생산관리
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<li class="<? if($controller == "production") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> 생산관리 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<? if($action == "listPageBom" || $action == "inputPageBom") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageBom">
									<i class="menu-icon fa fa-caret-right"></i>
									BOM(소요량)
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "calBom") echo "active"; ?>">
								<a href="index.php?controller=production&action=calBom">
									<i class="menu-icon fa fa-caret-right"></i>
									BOM(소요량) 계산
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageOutsourcing" || $action == "inputPageOutsourcing" || $action == "modifyPageOutsourcing") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageOutsourcing">
									<i class="menu-icon fa fa-caret-right"></i>
									외주공정관리
								</a>
								<b class="arrow"></b>
							</li>
							
							<li class="<? if($action == "listPageWorkPlanBom" || $action == "viewPageWorkPlanBom" || $action == "listPageWorkPlan" || $action == "viewPageWorkPlan") echo "active"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=base&action=inputPageExcel">
									<i class="menu-icon fa fa-caret-right"></i>
									생산계획<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listPageWorkPlanBom") echo "active"; ?>">
										<a href="index.php?controller=production&action=listPageWorkPlanBom">
											<i class="menu-icon fa fa-caret-right"></i>
											생산계획 소요자재 현황
										</a>
										<b class="arrow"></b>
									</li>	
									<li class="<? if($action == "listPageWorkPlan") echo "active"; ?>">
										<a href="index.php?controller=production&action=listPageWorkPlan">
											<i class="menu-icon fa fa-caret-right"></i>
											생산계획
										</a>
										<b class="arrow"></b>
									</li>
									<li class="<? if($action == "viewPageWorkPlan") echo "active"; ?>">
										<a href="index.php?controller=production&action=viewPageWorkPlan">
											<i class="menu-icon fa fa-caret-right"></i>
											생산계획표
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>												
							
							<li class="<? if($action == "listPageStandbyWork" || $action == "listPageWork"  || $action == "currentWorkState") echo "active"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=base&action=inputPageExcel">
									<i class="menu-icon fa fa-caret-right"></i>
									작업지시<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listPageStandbyWork") echo "active"; ?>">
										<a href="index.php?controller=production&action=listPageStandbyWork">
											<i class="menu-icon fa fa-caret-right"></i>
											작업지시 대기
										</a>
										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageWork") echo "active"; ?>">
										<a href="index.php?controller=production&action=listPageWork">
											<i class="menu-icon fa fa-caret-right"></i>
											작업지시서
										</a>
										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "currentWorkState") echo "active"; ?>">
										<a href="index.php?controller=production&action=currentWorkState">
											<i class="menu-icon fa fa-caret-right"></i>
											작업현황판
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>

							<li class="<? if($action == "listPageQc") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageQc">
									<i class="menu-icon fa fa-caret-right"></i>
									품질관리(QC)
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageDefective") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageDefective">
									<i class="menu-icon fa fa-caret-right"></i>
									불량관리
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageManpower") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageManpower">
									<i class="menu-icon fa fa-caret-right"></i>
									라인 가동률
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<? if($action == "listPageMold") echo "active"; ?>">
								<a href="index.php?controller=production&action=listPageMold">
									<i class="menu-icon fa fa-caret-right"></i>
									금형관리
								</a>
								<b class="arrow"></b>
							</li>	
							
							<!--<li class="<? if($action == "listproductionCostManage" ) echo "active"; ?>">
								<a href="index.php?controller=production&action=listproductionCostManage">
									<i class="menu-icon fa fa-caret-right"></i>
									생산원가관리
								</a>
								<b class="arrow"></b>
							</li>-->
							<!--<li class="<? if($action == "listCostManagement" ) echo "active"; ?>">
								<a href="index.php?controller=production&action=listCostManagement">
									<i class="menu-icon fa fa-caret-right"></i>
									프로젝트별원가관리
								</a>
								<b class="arrow"></b>
							</li>-->
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 외주관리 
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<li class="<? if($controller == "purchase") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> 외주관리 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<? if($action == "listPagePurchaseDemand" || $action == "inputPagePurchaseDemand" || $action == "modifyPagePurchaseDemand") echo "active"; ?>">
								<a href="index.php?controller=purchase&action=listPagePurchaseDemand">
									<i class="menu-icon fa fa-caret-right"></i>
									외주등록
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageOrderPlan" || $action == "inputPageOrderPlan" || $action == "modifyPageOrderPlan") echo "active"; ?>">
								<a href="index.php?controller=purchase&action=listPageOrderPlan">
									<i class="menu-icon fa fa-caret-right"></i>
									발주계획
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPagePurchase") echo "active"; ?>">
								<a href="index.php?controller=purchase&action=listPageOrderDraft">
									<i class="menu-icon fa fa-caret-right"></i>
									발주서
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageOrderDraftItem" || $action == "listPageBarcodePurchaseItem") echo "active"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=purchase&action=listPageOrderDraftItem">
									<i class="menu-icon fa fa-caret-right"></i>
									구매(입고)
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listPageOrderDraftItem") echo "active"; ?>">
										<a href="index.php?controller=purchase&action=listPageOrderDraftItem">
											<i class="menu-icon fa fa-caret-right"></i>
											구매(입고 - PC)
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageItemInout") echo "active"; ?>">
										<a href="index.php?controller=purchase&action=listPageBarcodePurchaseItem">
											<i class="menu-icon fa fa-caret-right"></i>
											구매(입고 - 바코드)
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="<? if($action == "listPageAmountPayable") echo "active"; ?>">
								<a href="index.php?controller=purchase&action=listPageAmountPayable">
									<i class="menu-icon fa fa-caret-right"></i>
									미지급금관리
								</a>
								<b class="arrow"></b>
							</li>
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
							<li class="<? if($action == "listPagePurchaseDemand" || $action == "inputPagePurchaseDemand" || $action == "modifyPagePurchaseDemand") echo "active"; ?>">
								<a href="index.php?controller=purchase&action=listPagePurchaseDemand">
									<i class="menu-icon fa fa-caret-right"></i>
									구매요청
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageOrderPlan" || $action == "inputPageOrderPlan" || $action == "modifyPageOrderPlan") echo "active"; ?>">
								<a href="index.php?controller=purchase&action=listPageOrderPlan">
									<i class="menu-icon fa fa-caret-right"></i>
									발주계획
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPagePurchase") echo "active"; ?>">
								<a href="index.php?controller=purchase&action=listPageOrderDraft">
									<i class="menu-icon fa fa-caret-right"></i>
									발주서
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageOrderDraftItem" || $action == "listPageBarcodePurchaseItem") echo "active"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=purchase&action=listPageOrderDraftItem">
									<i class="menu-icon fa fa-caret-right"></i>
									구매(입고)
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listPageOrderDraftItem") echo "active"; ?>">
										<a href="index.php?controller=purchase&action=listPageOrderDraftItem">
											<i class="menu-icon fa fa-caret-right"></i>
											구매(입고 - PC)
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageItemInout") echo "active"; ?>">
										<a href="index.php?controller=purchase&action=listPageBarcodePurchaseItem">
											<i class="menu-icon fa fa-caret-right"></i>
											구매(입고 - 바코드)
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="<? if($action == "listPageAmountPayable") echo "active"; ?>">
								<a href="index.php?controller=purchase&action=listPageAmountPayable">
									<i class="menu-icon fa fa-caret-right"></i>
									미지급금관리
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 재고관리
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<li class="<? if($controller == "items") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-th-large"></i>
							<span class="menu-text"> 재고관리 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<? if($action == "listPageShipment") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageShipment">
									<i class="menu-icon fa fa-caret-right"></i>
									출하지시서
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageWarehouseStock") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageWarehouseStock">
									<i class="menu-icon fa fa-caret-right"></i>
									창고재고관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageStockPrice") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageStockPrice">
									<i class="menu-icon fa fa-caret-right"></i>
									단가관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageStock") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageStock">
									<i class="menu-icon fa fa-caret-right"></i>
									재고현황
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageRelease" || $action == "viewPageRelease" || $action == "listPageItemInout") echo "active"; ?>">
								<a class="dropdown-toggle" href="index.php?controller=items&action=listPageRelease">
									<i class="menu-icon fa fa-caret-right"></i>
									자재출고관리
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="<? if($action == "listPageRelease" || $action == "viewPageRelease") echo "active"; ?>">
										<a href="index.php?controller=items&action=listPageRelease">
											<i class="menu-icon fa fa-caret-right"></i>
											출고요청서 (PC)
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageBarcodeReleaseItem") echo "active"; ?>">
										<a href="index.php?controller=items&action=listPageBarcodeReleaseItem">
											<i class="menu-icon fa fa-caret-right"></i>
											출고 (바코드)
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
							<li class="<? if($action == "listPageBarcode") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageBarcode">
									<i class="menu-icon fa fa-caret-right"></i>
									바코드관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageRealStock") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageRealStock">
									<i class="menu-icon fa fa-caret-right"></i>
									재고실사
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageSafetyStock") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageSafetyStock">
									<i class="menu-icon fa fa-caret-right"></i>
									안전재고관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageLotNo" || $action == "viewPageLotNo") echo "active"; ?>">
								<a href="index.php?controller=items&action=listPageLotNo">
									<i class="menu-icon fa fa-caret-right"></i>
									Lot No 추적
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 그룹웨어
<!----------------------------------------------------------------------------------------------------------------------------------------------------->					
					<li class="<? if($controller == "groupware") echo "active open"; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-newspaper-o"></i>
							<span class="menu-text"> 그룹웨어 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<? if($action == "listPageEleSettlementLine" || $action == "inputPageEleSettlementLine" || $action == "listPageMyEleSettlement" || $action == "inputPageEleSettlement" || $action == "listPageEleSettlement" || $action == "viewPageEleSettlement" || $action == "listPageDocument" || $action == "inputPageDocument" || $action ="modifyPageEleSettlement") echo "active"; ?>">
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
											결재라인관리
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageMyEleSettlement" || $action == "inputPageEleSettlement" || $action = "modifyPageEleSettlement") echo "active"; ?>">
										<a href="index.php?controller=groupware&action=listPageMyEleSettlement">
											<i class="menu-icon fa fa-caret-right"></i>
											내 기안함
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageEleSettlement" || $action == "viewPageEleSettlement") echo "active"; ?>">
										<a href="index.php?controller=groupware&action=listPageEleSettlement">
											<i class="menu-icon fa fa-caret-right"></i>
											결재리스트
										</a>

										<b class="arrow"></b>
									</li>

									<li class="<? if($action == "listPageDocument" || $action == "inputPageDocument") echo "active"; ?>">
										<a href="index.php?controller=groupware&action=listPageDocument">
											<i class="menu-icon fa fa-caret-right"></i>
											문서양식관리
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="<? if($action == "listPageSpendingResolution" || $action == "inputPageSpendingResolution" || $action == "modifyPageSpendingResolution") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageSpendingResolution">
									<i class="menu-icon fa fa-caret-right"></i>
									지출결의서
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageCrm" || $action == "inputPageCrm" || $action == "modifyPageCrm") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageCrm">
									<i class="menu-icon fa fa-caret-right"></i>
									고객관리(CRM)
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageBoard" || $action == "inputPageBoard" || $action == "modifyPageBoard") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageBoard">
									<i class="menu-icon fa fa-caret-right"></i>
									업무공유
								</a>
								<b class="arrow"></b>
							</li>
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
							<li class="<? if($action == "listPageEmpWorkLeave") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageEmpWorkLeave">
									<i class="menu-icon fa fa-caret-right"></i>
									출퇴근관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageFile" || $action == "inputPageFile" || $action == "modifyPageFile") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageFile">

									<i class="menu-icon fa fa-caret-right"></i>
									파일보관함
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPagePublicThing" || $action == "inputPagePublicThing" || $action == "modifyPagePublicThing") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPagePublicThing">
									<i class="menu-icon fa fa-caret-right"></i>
									공용품관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageCar" || $action == "inputPageCar" || $action == "modifyPageCar") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageCar">
									<i class="menu-icon fa fa-caret-right"></i>
									차량관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<? if($action == "listPageInstallation" || $action == "inputPageInstallation" || $action == "modifyPageInstallation") echo "active"; ?>">
								<a href="index.php?controller=groupware&action=listPageInstallation">
									<i class="menu-icon fa fa-caret-right"></i>
									시설관리
								</a>
								<b class="arrow"></b>
							</li>
							<!--<li class="<? if($action == "listPageError" || $action == "inputPageError") echo "active"; ?>">
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
							</li>-->
						</ul>
					</li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>