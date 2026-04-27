<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>인퍼스 JERP v1.0</title>

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
							(주) 연암
						</small>
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
									Jason
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
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="active">
						<a href="index.html">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 영업관리 
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								영업관리
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									거래명세서
									<b class="menu-icon fa fa-caret-right"></b>
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=sales&action=createEstimateSheet">
									<i class="menu-icon fa fa-caret-right"></i>
									견적관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=sales&action=createOrderSheet">
									<i class="menu-icon fa fa-caret-right"></i>
									수주관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="elements.html">
									<i class="menu-icon fa fa-caret-right"></i>
									출하관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=sales&action=listPageAccount">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='color:red'>거래처관리</span>
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="elements.html">
									<i class="menu-icon fa fa-caret-right"></i>
									AS관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="elements.html">
									<i class="menu-icon fa fa-caret-right"></i>
									미수금관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="elements.html">
									<i class="menu-icon fa fa-caret-right"></i>
									매출계획
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 구매관리 
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> 구매관리 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="tables.html">
									<i class="menu-icon fa fa-caret-right"></i>
									견적요청
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="jqgrid.html">
									<i class="menu-icon fa fa-caret-right"></i>
									발주계획
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="tables.html">
									<i class="menu-icon fa fa-caret-right"></i>
									발주서
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="jqgrid.html">
									<i class="menu-icon fa fa-caret-right"></i>
									구매(입고)
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="jqgrid.html">
									<i class="menu-icon fa fa-caret-right"></i>
									미지급금관리
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 생산관리
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> 생산관리 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="index.php?controller=production&action=listPageBom">
									<i class="menu-icon fa fa-caret-right"></i>
									BOM(소요량)
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=production&action=listPageProcess">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='color:red'>공정관리</span>
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=customer&action=customer_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									외주공장관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=customer&action=customer_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									원가관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=customer&action=customer_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									작업지시서
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=customer&action=customer_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									품질관리(QC)
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=customer&action=customer_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									불량관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=customer&action=customer_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									자재출고관리
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 재고관리
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> 재고관리 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="index.php?controller=items&action=listPageStock">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='color:red'>창고재고관리</span>
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=items&action=listPageItem">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='color:red'>품목관리</span>
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=counsel&action=counsel_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									단가관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=counsel&action=counsel_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									재고현황
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=counsel&action=counsel_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									바코드관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=counsel&action=counsel_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									재고실사
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=items&action=listPageSafetyStock">
									<i class="menu-icon fa fa-caret-right"></i>
									안전재고관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=items&action=listPageWarehouse">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='color:red'>창고관리</span>
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 회계
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> 회계 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="index.php?controller=contract&action=contract_list">
									<i class="menu-icon fa fa-caret-right"></i>
									기초등록
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=contract&action=contract_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									매출매입거래
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=contract&action=contract_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									현금거래관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=contract&action=contract_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									고정자산관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=contract&action=contract_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									전표관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=contract&action=contract_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									출력물관리
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 회계2
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> 회계1 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a class="dropdown-toggle" href="index.php?controller=accounting&action=inputPageAccounting">
								   <i class="menu-icon fa fa-caret-right"></i>
								   <span style='font-weight:bold'>기초등록</span>
								   <b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
								
									<li class="">
										<a href="index.php?controller=accounting&action=inputPageAccounting">
											<i class="menu-icon fa fa-caret-right"></i>
											회사등록/회계연도
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=sales&action=listPageAccount">
											<i class="menu-icon fa fa-caret-right"></i>
											거래처등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=accounting&action=inputPageAccounting">
											<i class="menu-icon fa fa-caret-right"></i>
											기초잔액입력
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=accounting&action=creditcard_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											신용카드등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=accounting&action=bank_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											통장계좌등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=employee&action=listPageDepartment">
											<i class="menu-icon fa fa-caret-right"></i>
											부서등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											프로젝트등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=accounting&action=registPrintApproval">
											<i class="menu-icon fa fa-caret-right"></i>
											인쇄용결재라인등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											결재라인등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											카드사등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											사원등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=accounting&action=listPageAccountingCode">
											<i class="menu-icon fa fa-caret-right"></i>
											계정코드등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											각종코드변경
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='font-weight:bold'> 전표관리 </span>

									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="index.php?controller=contract&action=contract_list">
											<i class="menu-icon fa fa-caret-right"></i>
											전표조회/수정
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											일반전표입력
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											매출전표입력
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											매입전표입력
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											전표계정설정
										</a>
										<b class="arrow"></b>
									</li>
									
								</ul>
							</li>
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='font-weight:bold'> 고정자산 </span>
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											고정자산등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_list">
											<i class="menu-icon fa fa-caret-right"></i>
											고정자산유형등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											자산코드등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											감사상각비등록
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											고정자산대장
										</a>
										<b class="arrow"></b>
									</li>
									
								</ul>
							</li>
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='font-weight:bold'> 재무재표 </span>
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="index.php?controller=contract&action=contract_list">
											<i class="menu-icon fa fa-caret-right"></i>
											재무상태표
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											손익계산서
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											원가명세서
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											계정명세서
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											합계잔액시산표
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											기말재고입력
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											이익잉여금처분계산서
										</a>
										<b class="arrow"></b>
									</li>
									
								</ul>
							</li>
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='font-weight:bold'> 장부관리 </span>
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="index.php?controller=contract&action=contract_list">
											<i class="menu-icon fa fa-caret-right"></i>
											계정별원장
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											계정별거래처별원장
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											매입/매출장
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											현금출납장
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											분개장
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											일/월계표
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											월별손익분석
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											월별원가분석
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											거래처거래내역조회
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='font-weight:bold'> 결산전표처리 </span>

									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="index.php?controller=contract&action=contract_list">
											<i class="menu-icon fa fa-caret-right"></i>
											결산자료입력
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											잔액조정입력
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											-잔액실사조회
										</a>
										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="index.php?controller=contract&action=contract_regist">
											<i class="menu-icon fa fa-caret-right"></i>
											-잔액조정조회
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 인사/급여
<!----------------------------------------------------------------------------------------------------------------------------------------------------->					
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> 인사/급여 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="index.php?controller=document&action=document_list">
									<i class="menu-icon fa fa-caret-right"></i>
									급여관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a class="dropdown-toggle" href="index.php?controller=employee&action=listPageEmployee">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='color:red'>인사관리</span>
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="index.php?controller=employee&action=listPageEmployee">
											<i class="menu-icon fa fa-caret-right"></i>
											사원리스트
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="index.php?controller=employee&action=inputPageEmployee">
											<i class="menu-icon fa fa-caret-right"></i>
											사원등록
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="">
								<a href="index.php?controller=employee&action=listPageDepartment">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='color:red'>부서관리</span>
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=employee&action=listPagePosition">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='color:red'>직위관리</span>
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=document&action=document_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									일용직관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=document&action=document_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									근태관리
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- // 그룹웨어
<!----------------------------------------------------------------------------------------------------------------------------------------------------->					
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> 그룹웨어 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="index.php?controller=groupware&action=inputPageGroupware">
									<i class="menu-icon fa fa-caret-right"></i>
									전자결재
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=document&action=document_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									고객관리(CRM)
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=document&action=document_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									업무공유
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=document&action=document_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									일정관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=document&action=document_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									출퇴근관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=groupware&action=listPageProject">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style='color:red'>프로젝트 관리</span>
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=document&action=document_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									파일보관함
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=document&action=document_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									공용품관리
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="index.php?controller=document&action=document_regist">
									<i class="menu-icon fa fa-caret-right"></i>
									차량관리
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