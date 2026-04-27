<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>용차관리</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">      
  </head>
  <body class="common" style="overflow: hidden;">
	<table class="wrap_com" style="width: 100%; height: 100%;"><tr><td> 
		<table class="wrap_box1"><tr><td><!--탑-->
			<!--메뉴버튼01-->
			<button class="btn_01"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span></button>
			<!--메뉴버튼04-->
			<button class="btn_04"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span></button>
			<div class="logo01">
				<a href="main.php">로고</a>
			</div>
			<!--설정버튼-->
			<button class="btn_02"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></button>
			<button class="btn_05"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></button>
		</td></tr></table>
		<table class="wrap_box2"><tr><td>
			<div style="width: 100%; height: 100%; overflow-y: scroll;" class="common_box">
				<table style="width: 100%; height: 100%; background-color: #fff;"><tr><td>
					<div style="width: 100%; height: 100%;" class="wrap_box_float">
						<!--=====================================내용===============================================-->
						<div class="top_title">
							<ul>
								<li>Home</li>
								<li>></li>
								<li>기준정보관리</li>
								<li>></li>
								<li style="color:#d15b47">용차 관리</li>
							</ul>
						</div>
						
						<div class="search_box box_after">
							<button class="title_box">
								<span>용차 리스트</span>
							</button>
							<span class="floatright">
								<button class="enrollment_btn" data-toggle="modal" data-target="#registration_pop">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</button>
								<button class="delete">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
								</button>								
							</span>		
						</div>
						
						<div class="general_box">
							<!-- jquery_tap01 표 클릭할때 색상 표시 제이쿼리 클래스 -->
							<table class="general_table jquery_tap01">
								<thead>
									<tr>
										<th class="checkbox_middle">
											<input type="checkbox"/>
										</th>
										<th class="paddingleft">
											차량번호
										</th>
										<th class="paddingleft">
											차종 / 적재량
										</th>
										<th class="paddingleft">
											차주
										</th>
										<th class="paddingleft">
											회사명
										</th>										
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="checkbox_middle">
											<input type="checkbox"/>
										</td>
										<td class="paddingleft">
											차량번호
										</td>
										<td class="paddingleft">
											차종 / 적재량
										</td>
										<td class="paddingleft">
											차주
										</td>
										<td class="paddingleft">
											회사명
										</td>										
									</tr>
								</tbody>
							</table>
						</div>
						<div class="page_number_box margintop">
							<ul>
								<li><span class="glyphicon glyphicon-backward" aria-hidden="true"></span></li>
								<li><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span></li>
								<li class="on">1</li>
								<li>2</li>
								<li>3</li>
								<li>4</li>
								<li>5</li>
								<li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></li>
								<li><span class="glyphicon glyphicon-forward" aria-hidden="true"></span></li>
							</ul>
						</div>



						


						



						<!-- 검색 팝업 품목 리스트 -->
						<div class="modal fade" id="search01" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="search_wrap_box box_after">
									<div class="search_body">
										<div>
											<select class="select_box">
												<option>==선택==</option>
											</select>
										</div>
										<div class="margintop">
											<input type="search"/ class="full_size" placeholder="프로젝트 리스트 검색">
											<button class="pop_search_btn">
												<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
											</button>
										</div>					
									</div>
									<div class="floatright">
										<button type="button" class="close_btn" data-dismiss="modal">닫기</button>
									</div>
								</div>
							</div>
						</div>

						<!-- 검색(품목 등록) 팝업 품목 리스트 -->
						<div class="modal fade" id="search02" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:9999">
							<div class="modal-dialog">
								<div class="search_wrap_box box_after">
									<div class="pop_head">
										<h4>품목규격 리스트</h4>
									</div>
									<div class="search_body">					
										<table class="enrollment_table margintop">
											<tr>
												<th>
													품목규격
												</th>
											</tr>
											<tr>
												<td>
													<span class="data_text">데이터가 존재하지 않습니다</span>
												</td>
											</tr>
										</table>
									</div>
									<div class="floatright">										
										<button type="button" class="close_btn" data-dismiss="modal">
											<span>닫기</span>
										</button>
									</div>
								</div>
							</div>
						</div>
						
						<!-- 프로젝트 등록 -->
						<div class="modal fade" id="registration_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="search_wrap_box box_after">
									<div class="pop_head">
										<h4>용차 등록</h4>
									</div>
									<div class="search_body">
										<span class="table_pop_backcolor">
											<span>용차 기본정보</span>
										</span>
										<table class="enrollment_table ">
											<tr>
												<th>
													차주
												</th>
												<td>
													<input type="text"/ class="full_size">
												</td>
											</tr>
											<tr>
												<th>
													사업자등록번호
												</th>
												<td>
													<input type="text"/ class="full_size">
												</td>
											</tr>											
											<tr>
												<th>
													회사명
												</th>
												<td>
													<input type="text"/ class="full_size">
												</td>
											</tr>
											<tr>
												<th>
													업태 / 종목
												</th>
												<td>
													<input type="text"/ class="full_size" style="width:40%;" placeholder="업태"> / <input type="text"/ class="full_size" style="width:40%;" placeholder="종목">
												</td>
											</tr>
											<tr>
												<th>
													전화
												</th>
												<td>
													<input type="text"/ class="full_size">
												</td>
											</tr>
											<tr>
												<th>
													휴대폰
												</th>
												<td>
													<input type="text"/ class="full_size">
												</td>
											</tr>
											<tr>
												<th>
													팩스
												</th>
												<td>
													<input type="text"/ class="full_size">
												</td>
											</tr>
											<tr>
												<th>
													이메일
												</th>
												<td>
													<input type="text"/ class="full_size">
												</td>
											</tr>
											<tr>
												<th>
													주소
												</th>
												<td>
													<input type="text"/class="full_size" style="width:70%;">
													<button class="search_btn">
														<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
													</button>	
													<input type="text"/class="full_size margintop">											
												</td>
											</tr>
											<tr>
												<th>
													차량번호
												</th>
												<td>
													<input type="text"/ class="full_size">
												</td>
											</tr>
											<tr>
												<th>
													차종
												</th>
												<td>
													<select class="full_size" style="width:35%;">
														<option>대형</option>
													</select>
													<input type="text"/ class="full_size" style="width:40%;">
													<span>톤</span>
												</td>
											</tr>
											<tr>
												<th>
													은행<br>
													예금주
												</th>
												<td>
													<input type="text"/class="full_size" placeholder="KB국민은행">														
													<input type="text"/class="full_size margintop" placeholder="예금주">
												</td>
											</tr>
											<tr>
												<th>
													계좌번호
												</th>
												<td>
													<input type="text"/ class="full_size">
												</td>
											</tr>											
										</table>										
									</div>
									<div class="floatright">
										<button class="creation_btn">
											<span>용차등록</span>
										</button>
										<button class="newly_btn">
											<span>새로고침</span>
										</button>
										<button class="close_btn" data-dismiss="modal">
											<span>닫기</span>
										</button>
									</div>
								</div>
							</div>
						</div>
						<!--=====================================내용===============================================-->




            <!--슬라이드메뉴-->
             <div class="menu">
                <!--상단-->
                <table class="top_menu"><tr><td>
                <div class="top_menu_left">
                  <div class="users_icon">
                    <div class="in_users_icon">
                      <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    </div>   
                  </div>
                </div>
                <table class="top_menu_right"><tr><td>
                  <span class="user_name"><b>정태준</b> 님<br> 환영합니다 <button class="logout" onclick="location.href='login.html'"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> 로그아웃</button></span>
                </td></tr></table>
                </td></tr></table>
                <!--메뉴-->
                <div class="cont_menu" style="overflow-y: scroll;">
                  <ul class="main_menu">

                    <!-- 기준정보관리 시작 -->
                    <li class="main_menu01">
                      <a href="#a" style="color: #65c9c1"><span class="glyphicon glyphicon-phone icon_bakccolor" aria-hidden="true" style="color: #65c9c1"></span> 기준정보관리 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
                      <ul class="sub_menu sub_menu01">
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>품목관리 <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                          <ul class="sub_menu02 ">
                            <li>
                              <a href="#a" onclick="location.href='frmItemClassify.php'"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>품목구분 관리</a>
                            </li>
                            <li> 
                              <a href="#a" onclick="location.href='frmItemGroup.php'"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>품목그룹 관리</a>
                            </li>
                            <li>
                              <a href="#a" onclick="location.href='frmItemBuyer.php'"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>품목 매입처관리</a>
                            </li>
                            <li>
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>거래처별 품목단가관리</a>
                            </li>
                            <li>
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>품목 제조공정 관리</a>
                            </li>
                            <li>
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>품목 관리</a>
                            </li>
                          </ul>
                        </li>
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>거래처 관리 <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                          <ul class="sub_menu02">
                            <li>
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>거래처구분 관리</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>거래처 관리</a>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>부서 관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>직위 관리</a>
                        </li>
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>사원 관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>창고 관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>공정 관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>생산설비 관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>생산팀 관리</a>
                        </li>
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>프로젝트 관리</a>
                        </li>
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>용차 관리 <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                          <ul class="sub_menu02">
                            <li>
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>용차관리</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>요금관리</a>
                            </li>
                          </ul>
                        </li>
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>엑셀자료등록</a>
                        </li>
                      </ul>
                    </li>
                    <!-- 기준정보관리 끝 -->

                    <!-- 수주 / 영업관리 시작 -->
                    <li class="main_menu01">
                      <a href="#a" style="color: #2981c8"><span class="glyphicon glyphicon-edit icon_bakccolor" aria-hidden="true" style="color: #2981c8"></span> 수주 / 영업관리 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
                      <ul class="sub_menu">
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>견적관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>수주관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>출하지시관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>AS관리</a>
                        </li>
                      </ul>
                    </li>
                    <!-- 수주 / 영업관리 시작 -->

                    <!-- 생산관리 시작 -->
                    <li class="main_menu01">
                      <a href="#a" style="color: #c371f7"><span class="glyphicon glyphicon-tasks icon_bakccolor" aria-hidden="true" style="color: #c371f7"></span> 생산관리 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
                      <ul class="sub_menu">
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>생산계획 <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                          <ul class="sub_menu02">
                            <li>
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>월간 생산계획표</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>주간 생산계획표</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>생산계획</a>
                            </li>
                          </ul>
                        </li>
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>작업지시서 관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>작업지시 현황</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>작업일보</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>생산실적등록</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>생산현황</a>
                        </li>
                      </ul>
                    </li>
                    <!-- 생산관리 끝 -->

                    <!-- 품질관리 시작 -->
                    <li class="main_menu01">
                      <a href="#a" style="color: #e8799c"><span class="glyphicon glyphicon-tasks icon_bakccolor" aria-hidden="true" style="color: #e8799c"></span> 품질관리 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
                      <ul class="sub_menu">
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>검사항목 관리</a>
                        </li>
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>품질관리(QC)</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>불량유형관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>불량관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>불량현황</a>
                        </li>
                      </ul>
                    </li>
                    <!-- 품질관리 끝 -->


                    <!-- 외주 / 사급관리 시작 -->
                    <li class="main_menu01">
                      <a href="#a" style="color: #c9a246"><span class="glyphicon glyphicon-th-list icon_bakccolor" aria-hidden="true" style="color: #c9a246"></span> 외주 / 사급관리 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
                      <ul class="sub_menu">
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>외주요청</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>외주품목관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>사급자재관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>외주발주관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>사급자재구매관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>외주품목입고현황</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>사급자재출고관리</a>
                        </li>
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>외주창고관리</a>
                        </li>
                      </ul>
                    </li>
                    <!-- 외주 / 사급관리 끝 -->

                    <!-- 구매 / 입고관리 시작 -->
                    <li class="main_menu01">
                      <a href="#a" style="color: #e8cdbd"><span class="glyphicon glyphicon-th-list icon_bakccolor" aria-hidden="true" style="color: #e8cdbd"></span> 구매 / 입고관리 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
                      <ul class="sub_menu">
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>구매요청</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>간편구매요청</a>
                        </li>
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>발주서</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>입고</a>
                        </li>
                      </ul>
                    </li>
                    <!-- 구매 / 입고관리 끝 -->

                    <!-- 출고 / 출하관리 시작 -->
                    <li class="main_menu01">
                      <a href="#a" style="color: #547261"><span class="glyphicon glyphicon-th-large icon_bakccolor" aria-hidden="true" style="color: #547261"></span> 출고 / 출하관리 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
                      <ul class="sub_menu">
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>출하지시서</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>출고요청서</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>자재수불부</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>Lot No 추적</a>
                        </li> 
                      </ul>       
                    </li>
                    <!-- 출고 / 출하관리 끝 -->

                    <!-- 재고관리 시작 -->
                    <li class="main_menu01">
                      <a href="#a" style="color: #FF60A6;"><span class="glyphicon glyphicon-folder-open icon_bakccolor" aria-hidden="true" style="color: #FF60A6;"></span> 재고관리 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
                      <ul class="sub_menu">
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>창고재고관리</a>                   
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>재고현황</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>불출재고(공정투입전)</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>재공 재고현황</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>바코드관리</a>
                        </li>
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>재고실사</a>                       
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>안전재고관리</a>
                        </li>                        
                      </ul>
                    </li>
                    <!-- 재고관리 끝 -->

                    <!-- 인사 / 급여관리 시작 -->
                    <li class="main_menu01">
                      <a href="#a" style="color: #dce5f3;"><span class="glyphicon glyphicon-folder-open icon_bakccolor" aria-hidden="true" style="color: #dce5f3;"></span> 인사 / 급여관리 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
                      <ul class="sub_menu">
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>급여관리</a>                   
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>일용직관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>근태관리</a>
                        </li>                                        
                      </ul>
                    </li>
                    <!-- 인사 / 급여관리 끝 -->

                    <!-- 그룹웨어 시작 -->
                    <li class="main_menu01">
                      <a href="#a" style="color: #b97354;"><span class="glyphicon glyphicon-folder-open icon_bakccolor" aria-hidden="true" style="color: #b97354;"></span> 그룹웨어 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
                      <ul class="sub_menu">
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>전자결재 <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                          <ul class="sub_menu02">
                            <li>
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>결재라인관리</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>내 기안함</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>결재리스트</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>문서양식관리</a>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>지출결의서</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>계정과목관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>업무일지</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>출퇴근관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>일정관리</a>
                        </li>
                        <li>
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>파일보관함</a>
                        </li>                                        
                      </ul>
                    </li>
                    <!-- 그룹웨어 끝 -->

                    <!-- 회계 시작 -->
                    <li class="main_menu01">
                      <a href="#a" style="color: #5e717a;"><span class="glyphicon glyphicon-folder-open icon_bakccolor" aria-hidden="true" style="color: #5e717a;"></span> 회계 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
                      <ul class="sub_menu">
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>매입 <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                          <ul class="sub_menu02">
                            <li>
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>업체별 매입현황</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>품목별 매입현황</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>기간별 매입현황</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>업체별 매입순위표</a>
                            </li>
                          </ul>
                        </li>  
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>미수급 / 미지급금 관리 <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                          <ul class="sub_menu02">
                            <li>
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>미수금 내역</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>미지급금 내역</a>
                            </li>                           
                          </ul>
                        </li>  
                        <li class="sub_menu01">
                          <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>판매 <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                          <ul class="sub_menu02">
                            <li>
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>업체별 판매현황</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>품목별 판매현황</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>기간별 판매현황</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>업체별 판매순위표</a>
                            </li>
                            <li>  
                              <a href="#a"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>년, 월 판매 집계표 (업체)</a>
                            </li>                           
                          </ul>
                        </li>                                   
                      </ul>
                    </li>
                    <!-- 그룹웨어 끝 -->

                  </ul>
                </div>                
            </div>

            <div class="set"><!--슬라이드설정-->
                
            </div>






          









          </div>                        
          </td></tr></table>       
        </div>
      </td></tr></table>

   
    <table class="wrap_box3"><tr><td><!--저작권-->
      <p style="color: #A4A4A4;"><b style="margin-right: 10px;">ERMES</b> v1.0 © 2016-2018 </p>
    </td></tr></table>
    </td></tr></table>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>   
    <script src="js/bootstrap.min.js"></script>

    <!--메뉴-->
    <script type="text/javascript">
      $(function(){
        $('.btn_01').click(function(){
          $('.menu').css('left','0')
          $('.btn_01').css('display','none')
          $('.btn_04').css('display','block')
          $('.set').css('right','-100%')
        })
        $('.btn_04').click(function(){
          $('.menu').css('left','-100%')
          $('.btn_04').css('display','none')
          $('.btn_01').css('display','block')
        })
      })
    </script>


    <!--설정-->
    <script type="text/javascript">
      $(function(){
        $('.btn_02').click(function(){
          $('.set').css('right','0')
          $('.btn_02').css('display','none')
          $('.btn_05').css('display','block')
          $('.menu').css('left','-100%')
        })
        $('.btn_05').click(function(){
          $('.set').css('right','-100%')
          $('.btn_05').css('display','none')
          $('.btn_02').css('display','block')
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
		$('.jquery_tap01 tbody tr').click(function(){
			$('.jquery_tap01 tbody tr').removeClass('widthtd');
			$(this).addClass('widthtd')
		})
	})
    </script>

    <script>
	$(function(){
		$('.jquery_tap02 tbody tr').click(function(){
			$('.jquery_tap02 tbody tr').removeClass('widthtd');
			$(this).addClass('widthtd')
		})
	})
    </script>


     <script>
	$(function(){
		$('.jquery_tap03 tbody tr').click(function(){
			$('.jquery_tap03 tbody tr').removeClass('widthtd');
			$(this).addClass('widthtd')
		})
	})
    </script>





  </body>
</html>