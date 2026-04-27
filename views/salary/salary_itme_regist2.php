<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">인사/급여</a>
				</li>
				<li class="active">급여관리</li>
			</ul><!-- /.breadcrumb -->

			<div class="nav-search" id="nav-search">
				<form class="form-search">
					<span class="input-icon">
						<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
						<i class="ace-icon fa fa-search nav-search-icon"></i>
					</span>
				</form>
			</div><!-- /.nav-search -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					수당항목등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						수당항목등록
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->
	<div class="row">
		<div class="col-xs-12">	
		<form name="form1" id="frm" method="post" action="index.php">
		<input type="hidden" name="controller" id="controller" value="accounting" />
		<input type="hidden" name="action" id="action" value="registGeneralStatementInsert" />
		<input name="hidFavSeq" id="hidFavSeq" type="hidden">
		
			<div class="row">
				<div class="col-xs-12 text-center"><h3>수당항목등록</h3></div>
			</div> 

            <div id="row">  
                <div class="col-xs-6 text-left"><img width="16" height="9" align="absmiddle" alt="" src="/ECMain/ECount.Common/images/icon_noti.gif">사용하지 않는 코드는 표시순서를 0으로 입력 바랍니다.</div>
                <div class="col-xs-6 text-right">
					<p class="float_right"> <!-- 오른쪽 검색--> 
                        <!-- <input name="input" class="btn_redS" id="Button1" onclick="copy_reload();" type="button" value="2016년 수당 복사"> -->
                        <select name="yy_t" id="yy_t">
							<option value="2024">2024</option>
							<option value="2023">2023</option>
							<option value="2022">2022</option>
							<option value="2021">2021</option>
                            <option value="2020">2020</option>
		                    <option value="2019">2019</option>
		                    <option selected="selected" value="2017">2017</option>
		                    <option value="2016">2016</option>
		                    <option value="2015">2015</option>
		                    <option value="2014">2014</option>
		                    <option value="2013">2013</option>
		                    <option value="2012">2012</option>
		                    <option value="2011">2011</option>
		                    <option value="2010">2010</option>
                        </select>
                        <input name="btnSearch" class="btn_searchS" id="btnSearch" onclick="yy_reload();" type="button" value="검색">
                    </p>  
                </div>
			</div>		

                <table id="simple-table" class="table  table-bordered table-hover">
					<colgroup>
					<col style="width: 140px;">
					<col style="width: 60px;">
					<col style="width: 45px;">
					<col style="width: 45px;">
					<col style="width: 110px;">
					<col style="width: 50px;">
					<col style="width: 140px;">
					<col style="width: 170px;">
					<col style="width: 40px;">
					<col style="width: 80px;">
					<col style="width: 100px;">
                    <thead>
                        <tr>
                            <th class="center">수당명</th>
                            <th class="center">표시순서</th>
                            <th class="center">고정급<br>상여</th>
                            <th class="center">변동급<br>상여</th>
                            <th class="center">근무기록<a onclick="Message('daily');" href="#"><img width="14" height="13" alt="" src="/ECMain/ECount.Common/images/icon_q.gif"></a></th>
                            <th class="center">배율<a onclick="Message('rate');" href="#"><img width="14" height="13" alt="" src="/ECMain/ECount.Common/images/icon_q.gif"></a></th>
                            <th class="center">비과세<a onclick="Message('nontax');" href="#"><img width="14" height="13" alt="" src="/ECMain/ECount.Common/images/icon_q.gif"></a></th>
                            <th class="center">계산식<a onclick="Message('calc');" href="#"><img width="14" height="13" alt="" src="/ECMain/ECount.Common/images/icon_q.gif"></a></th>
                            <th class="center">계산항목</th>
                            <th class="center">계산내역</th>
                            <th class="center">근태(휴가)코드</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>[01] <input name="a_des_1" class="bluebox" id="a_des_1" style="width:110px; background-color: rgb(239, 247, 253);" onfocus="this.select();nextfield ='a_sort_1';"  type="text" maxlength="20" value="기본급"></td>
                            <td class="center"><input name="a_sort_1" class="text-right" id="a_sort_1" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_1';"  type="text" maxlength="2" value="1"></td>
                            <td class="center"><input name="a_bonus_1" class="checkbox" id="a_bonus_1" onfocus="this.select();nextfield ='a_bonus1_1';"  type="checkbox" checked="checked" value="1"></td><td class="center"><input name="a_bonus1_1" class="checkbox" id="a_bonus1_1" onfocus="this.select();nextfield ='a_daily_1';"  type="checkbox" checked="checked" value="1"></td>
							<td>
								<select name="a_daily_1" class="center" id="a_daily_1" style="width:105px;" onfocus="nextfield ='a_rate_1';" onchange="fnSetValue(this.value,'1');">
									<option selected="selected" value="0">고정</option>
									<option value="1">변동(일)</option>
									<option value="2">변동(시간)</option>
									<option value="3">변동(지급률)</option>
								</select>
							</td>
							<td class="center"><input name="a_rate_1" class="text-right" id="a_rate_1" style="width: 40px;" onkeyup="text_check('a_rate_1','5');" onfocus="this.select();nextfield ='a_nontax_cd_1';"  type="text" maxlength="5" value="0"></td>
							<td class="center"><input name="a_nontax_1" id="a_nontax_1" type="hidden" value="00"><input name="a_nontax_cd_1" class="bluebox" id="a_nontax_cd_1" style="width: 40px;" ondblclick="search_code('1', '1', 'double');" onfocus="this.select();nextfield ='calc1_1';"  onchange="search_code('1', '1', '');" type="text" value="000"> <input name="a_nontax_des_1" class="default" id="a_nontax_des_1" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
							<td class="center">
								<select name="calc1_1" id="calc1_1" style="width: 80px;" onfocus="nextfield ='calc2_1';">
									<option selected="selected" value="01">원</option>
									<option value="10">십원</option>
									<option value="21">소수점1</option>
									<option value="22">소수점2</option>
								</select>  
								<select name="calc2_1" id="calc2_1" style="width: 80px;" onfocus="nextfield ='calc_flag_1';">
									<option selected="selected" value="R">반올림</option>
									<option value="C">절상</option>
									<option value="F">절사</option>
								</select>
							</td>
							<td class="center"><input name="calc_flag_1" class="checkbox" id="calc_flag_1" onclick="check_click('1')" onfocus="nextfield ='attend_cd1';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_1" disabled="disabled" class="link-gray-none" id="calc_des_1" style="width: 56px;" onclick="cal('01','1');" href="#">계산내역</a></td>
							<td class="center"><input name="attend_cd1" class="bluebox" id="attend_cd1" style="width: 35px;" ondblclick="search_code('2', '1', 'double');" onfocus="this.select();nextfield ='a_des_2';"  onchange="search_code('2', '1', '');" type="text" value=""> <input name="attend_des1" class="default" id="attend_des1" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun1" id="attend_gubun1" type="hidden" value=""></td>
						</tr>
						<tr>
							<td>[02] <input name="a_des_2" class="default" id="a_des_2" style="width:110px;" onfocus="this.select();nextfield ='a_sort_2';"  type="text" maxlength="20" value="야근수당"></td>
							<td class="center"><input name="a_sort_2" class="text-right" id="a_sort_2" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_2';"  type="text" maxlength="2" value="2"></td>
                            <td class="center"><input name="a_bonus_2" disabled="" class="checkbox" id="a_bonus_2" onfocus="this.select();nextfield ='a_bonus1_2';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_2" class="checkbox" id="a_bonus1_2" onfocus="this.select();nextfield ='a_daily_2';"  type="checkbox" value="1"></td>
							<td>
								<select name="a_daily_2" class="center" id="a_daily_2" style="width:105px;" onfocus="nextfield ='a_rate_2';" onchange="fnSetValue(this.value,'2');">
									<option value="0">고정</option>
									<option value="1">변동(일)</option>
									<option selected="selected" value="2">변동(시간)</option>
									<option value="3">변동(지급률)</option>
								</select>
							</td>
                            <td class="center"><input name="a_rate_2" class="text-right" id="a_rate_2" style="width: 40px;" onkeyup="text_check('a_rate_2','5');" onfocus="this.select();nextfield ='a_nontax_cd_2';"  type="text" maxlength="5" value="1"></td><td class="center"><input name="a_nontax_2" id="a_nontax_2" type="hidden" value="00"><input name="a_nontax_cd_2" class="bluebox" id="a_nontax_cd_2" style="width: 40px;" ondblclick="search_code('1', '2', 'double');" onfocus="this.select();nextfield ='calc1_2';"  onchange="search_code('1', '2', '');" type="text" value="O01"> <input name="a_nontax_des_2" class="default" id="a_nontax_des_2" style="width: 120px;" type="text" readonly="readonly" value="야간근로수당"></td>
							<td class="center">
								<select name="calc1_2" id="calc1_2" style="width: 80px;" onfocus="nextfield ='calc2_2';">
									<option selected="selected" value="01">원</option>
									<option value="10">십원</option>
									<option value="21">소수점1</option>
									<option value="22">소수점2</option>
								</select>  
								<select name="calc2_2" id="calc2_2" style="width: 80px;" onfocus="nextfield ='calc_flag_2';">
								
								
									<option selected="selected" value="R">반올림</option>
									<option value="C">절상</option>
									<option value="F">절사</option>
								</select>
							</td>
							<td class="center"><input name="calc_flag_2" class="checkbox" id="calc_flag_2" onclick="check_click('2')" onfocus="nextfield ='attend_cd2';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_2" disabled="disabled" class="link-gray-none" id="calc_des_2" style="width: 56px;" onclick="cal('02','2');" href="#">계산내역</a></td>
							<td class="center"><input name="attend_cd2" class="bluebox" id="attend_cd2" style="width: 35px;" ondblclick="search_code('2', '2', 'double');" onfocus="this.select();nextfield ='a_des_3';"  onchange="search_code('2', '2', '');" type="text" value=""> <input name="attend_des2" class="default" id="attend_des2" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun2" id="attend_gubun2" type="hidden" value=""></td>
						</tr>    
						<tr>
							<td>[03] <input name="a_des_3" class="default" id="a_des_3" style="width:110px;" onfocus="this.select();nextfield ='a_sort_3';"  type="text" maxlength="20" value="주말근무수당"></td>
							<td class="center"><input name="a_sort_3" class="text-right" id="a_sort_3" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_3';"  type="text" maxlength="2" value="3"></td>
							<td class="center"><input name="a_bonus_3" disabled="" class="checkbox" id="a_bonus_3" onfocus="this.select();nextfield ='a_bonus1_3';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_3" class="checkbox" id="a_bonus1_3" onfocus="this.select();nextfield ='a_daily_3';"  type="checkbox" value="1"></td>
							<td>
								<select name="a_daily_3" class="center" id="a_daily_3" style="width:105px;" onfocus="nextfield ='a_rate_3';" onchange="fnSetValue(this.value,'3');">
									<option value="0">고정</option>
									<option value="1">변동(일)</option>
									<option selected="selected" value="2">변동(시간)</option>
									<option value="3">변동(지급률)</option>
								</select>
							</td>
							<td class="center"><input name="a_rate_3" class="text-right" id="a_rate_3" style="width: 40px;" onkeyup="text_check('a_rate_3','5');" onfocus="this.select();nextfield ='a_nontax_cd_3';"  type="text" maxlength="5" value="1"></td><td class="center"><input name="a_nontax_3" id="a_nontax_3" type="hidden" value="00"><input name="a_nontax_cd_3" class="bluebox" id="a_nontax_cd_3" style="width: 40px;" ondblclick="search_code('1', '3', 'double');" onfocus="this.select();nextfield ='calc1_3';"  onchange="search_code('1', '3', '');" type="text" value="000"> <input name="a_nontax_des_3" class="default" id="a_nontax_des_3" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
							<td class="center">
								<select name="calc1_3" id="calc1_3" style="width: 80px;" onfocus="nextfield ='calc2_3';">
									<option selected="selected" value="01">원</option>
									<option value="10">십원</option>
									<option value="21">소수점1</option>
									<option value="22">소수점2</option>
								</select>  
								<select name="calc2_3" id="calc2_3" style="width: 80px;" onfocus="nextfield ='calc_flag_3';">
									<option selected="selected" value="R">반올림</option>
									<option value="C">절상</option>
									<option value="F">절사</option>
								</select>
							</td>
                            <td class="center"><input name="calc_flag_3" class="checkbox" id="calc_flag_3" onclick="check_click('3')" onfocus="nextfield ='attend_cd3';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_3" disabled="disabled" class="link-gray-none" id="calc_des_3" style="width: 56px;" onclick="cal('03','3');" href="#">계산내역</a></td>
							<td class="center"><input name="attend_cd3" class="bluebox" id="attend_cd3" style="width: 35px;" ondblclick="search_code('2', '3', 'double');" onfocus="this.select();nextfield ='a_des_4';"  onchange="search_code('2', '3', '');" type="text" value=""> <input name="attend_des3" class="default" id="attend_des3" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun3" id="attend_gubun3" type="hidden" value=""></td>
						</tr>    
						<tr>
							<td>[04] <input name="a_des_4" class="default" id="a_des_4" style="width:110px;" onfocus="this.select();nextfield ='a_sort_4';"  type="text" maxlength="20" value="연차수당"></td>
                            
                            
                            <td class="center"><input name="a_sort_4" class="text-right" id="a_sort_4" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_4';"  type="text" maxlength="2" value="4"></td>
                            
                            <td class="center"><input name="a_bonus_4" disabled="" class="checkbox" id="a_bonus_4" onfocus="this.select();nextfield ='a_bonus1_4';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_4" class="checkbox" id="a_bonus1_4" onfocus="this.select();nextfield ='a_daily_4';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_4" class="center" id="a_daily_4" style="width:105px;" onfocus="nextfield ='a_rate_4';" onchange="fnSetValue(this.value,'4');">
                                        <option value="0">고정</option>
                                        <option selected="selected" value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_4" class="text-right" id="a_rate_4" style="width: 40px;" onkeyup="text_check('a_rate_4','5');" onfocus="this.select();nextfield ='a_nontax_cd_4';"  type="text" maxlength="5" value="1"></td><td class="center"><input name="a_nontax_4" id="a_nontax_4" type="hidden" value="00"><input name="a_nontax_cd_4" class="bluebox" id="a_nontax_cd_4" style="width: 40px;" ondblclick="search_code('1', '4', 'double');" onfocus="this.select();nextfield ='calc1_4';"  onchange="search_code('1', '4', '');" type="text" value="Q01"> <input name="a_nontax_des_4" class="default" id="a_nontax_des_4" style="width: 120px;" type="text" readonly="readonly" value="출산.보육수당"></td>
                                <td class="center">
                                    <select name="calc1_4" id="calc1_4" style="width: 80px;" onfocus="nextfield ='calc2_4';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_4" id="calc2_4" style="width: 80px;" onfocus="nextfield ='calc_flag_4';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_4" class="checkbox" id="calc_flag_4" onclick="check_click('4')" onfocus="nextfield ='attend_cd4';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_4" disabled="disabled" class="link-gray-none" id="calc_des_4" style="width: 56px;" onclick="cal('04','4');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd4" class="bluebox" id="attend_cd4" style="width: 35px;" ondblclick="search_code('2', '4', 'double');" onfocus="this.select();nextfield ='a_des_5';"  onchange="search_code('2', '4', '');" type="text" value=""> <input name="attend_des4" class="default" id="attend_des4" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun4" id="attend_gubun4" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[05] <input name="a_des_5" class="default" id="a_des_5" style="width:110px;" onfocus="this.select();nextfield ='a_sort_5';"  type="text" maxlength="20" value="출산보육수당"></td>
                            
                            
                            <td class="center"><input name="a_sort_5" class="text-right" id="a_sort_5" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_5';"  type="text" maxlength="2" value="5"></td>
                            
                            <td class="center"><input name="a_bonus_5" class="checkbox" id="a_bonus_5" onfocus="this.select();nextfield ='a_bonus1_5';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_5" class="checkbox" id="a_bonus1_5" onfocus="this.select();nextfield ='a_daily_5';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_5" class="center" id="a_daily_5" style="width:105px;" onfocus="nextfield ='a_rate_5';" onchange="fnSetValue(this.value,'5');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_5" class="text-right" id="a_rate_5" style="width: 40px;" onkeyup="text_check('a_rate_5','5');" onfocus="this.select();nextfield ='a_nontax_cd_5';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_5" id="a_nontax_5" type="hidden" value="00"><input name="a_nontax_cd_5" class="bluebox" id="a_nontax_cd_5" style="width: 40px;" ondblclick="search_code('1', '5', 'double');" onfocus="this.select();nextfield ='calc1_5';"  onchange="search_code('1', '5', '');" type="text" value="Q01"> <input name="a_nontax_des_5" class="default" id="a_nontax_des_5" style="width: 120px;" type="text" readonly="readonly" value="출산.보육수당"></td>
                                <td class="center">
                                    <select name="calc1_5" id="calc1_5" style="width: 80px;" onfocus="nextfield ='calc2_5';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_5" id="calc2_5" style="width: 80px;" onfocus="nextfield ='calc_flag_5';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_5" class="checkbox" id="calc_flag_5" onclick="check_click('5')" onfocus="nextfield ='attend_cd5';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_5" disabled="disabled" class="link-gray-none" id="calc_des_5" style="width: 56px;" onclick="cal('05','5');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd5" class="bluebox" id="attend_cd5" style="width: 35px;" ondblclick="search_code('2', '5', 'double');" onfocus="this.select();nextfield ='a_des_6';"  onchange="search_code('2', '5', '');" type="text" value=""> <input name="attend_des5" class="default" id="attend_des5" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun5" id="attend_gubun5" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[06] <input name="a_des_6" class="default" id="a_des_6" style="width:110px;" onfocus="this.select();nextfield ='a_sort_6';"  type="text" maxlength="20" value="부양가족수당"></td>
                            
                            
                            <td class="center"><input name="a_sort_6" class="text-right" id="a_sort_6" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_6';"  type="text" maxlength="2" value="6"></td>
                            
                            <td class="center"><input name="a_bonus_6" class="checkbox" id="a_bonus_6" onfocus="this.select();nextfield ='a_bonus1_6';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_6" class="checkbox" id="a_bonus1_6" onfocus="this.select();nextfield ='a_daily_6';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_6" class="center" id="a_daily_6" style="width:105px;" onfocus="nextfield ='a_rate_6';" onchange="fnSetValue(this.value,'6');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_6" class="text-right" id="a_rate_6" style="width: 40px;" onkeyup="text_check('a_rate_6','5');" onfocus="this.select();nextfield ='a_nontax_cd_6';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_6" id="a_nontax_6" type="hidden" value="00"><input name="a_nontax_cd_6" class="bluebox" id="a_nontax_cd_6" style="width: 40px;" ondblclick="search_code('1', '6', 'double');" onfocus="this.select();nextfield ='calc1_6';"  onchange="search_code('1', '6', '');" type="text" value="000"> <input name="a_nontax_des_6" class="default" id="a_nontax_des_6" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_6" id="calc1_6" style="width: 80px;" onfocus="nextfield ='calc2_6';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_6" id="calc2_6" style="width: 80px;" onfocus="nextfield ='calc_flag_6';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_6" class="checkbox" id="calc_flag_6" onclick="check_click('6')" onfocus="nextfield ='attend_cd6';" type="checkbox" checked="checked" value="1"></td><td class="center"><a name="calc_des_6" class="link-blue" id="calc_des_6" style="width: 56px;" onclick="cal('06','6');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd6" class="bluebox" id="attend_cd6" style="width: 35px;" ondblclick="search_code('2', '6', 'double');" onfocus="this.select();nextfield ='a_des_7';"  onchange="search_code('2', '6', '');" type="text" value=""> <input name="attend_des6" class="default" id="attend_des6" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun6" id="attend_gubun6" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[07] <input name="a_des_7" class="default" id="a_des_7" style="width:110px;" onfocus="this.select();nextfield ='a_sort_7';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_7" class="text-right" id="a_sort_7" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_7';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_7" class="checkbox" id="a_bonus_7" onfocus="this.select();nextfield ='a_bonus1_7';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_7" class="checkbox" id="a_bonus1_7" onfocus="this.select();nextfield ='a_daily_7';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_7" class="center" id="a_daily_7" style="width:105px;" onfocus="nextfield ='a_rate_7';" onchange="fnSetValue(this.value,'7');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_7" class="text-right" id="a_rate_7" style="width: 40px;" onkeyup="text_check('a_rate_7','5');" onfocus="this.select();nextfield ='a_nontax_cd_7';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_7" id="a_nontax_7" type="hidden" value="00"><input name="a_nontax_cd_7" class="bluebox" id="a_nontax_cd_7" style="width: 40px;" ondblclick="search_code('1', '7', 'double');" onfocus="this.select();nextfield ='calc1_7';"  onchange="search_code('1', '7', '');" type="text" value="H03"> <input name="a_nontax_des_7" class="default" id="a_nontax_des_7" style="width: 120px;" type="text" readonly="readonly" value="차량유지비 "></td>
                                <td class="center">
                                    <select name="calc1_7" id="calc1_7" style="width: 80px;" onfocus="nextfield ='calc2_7';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_7" id="calc2_7" style="width: 80px;" onfocus="nextfield ='calc_flag_7';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_7" class="checkbox" id="calc_flag_7" onclick="check_click('7')" onfocus="nextfield ='attend_cd7';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_7" disabled="disabled" class="link-gray-none" id="calc_des_7" style="width: 56px;" onclick="cal('07','7');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd7" class="bluebox" id="attend_cd7" style="width: 35px;" ondblclick="search_code('2', '7', 'double');" onfocus="this.select();nextfield ='a_des_8';"  onchange="search_code('2', '7', '');" type="text" value=""> <input name="attend_des7" class="default" id="attend_des7" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun7" id="attend_gubun7" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[08] <input name="a_des_8" class="default" id="a_des_8" style="width:110px;" onfocus="this.select();nextfield ='a_sort_8';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_8" class="text-right" id="a_sort_8" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_8';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_8" class="checkbox" id="a_bonus_8" onfocus="this.select();nextfield ='a_bonus1_8';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_8" class="checkbox" id="a_bonus1_8" onfocus="this.select();nextfield ='a_daily_8';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_8" class="center" id="a_daily_8" style="width:105px;" onfocus="nextfield ='a_rate_8';" onchange="fnSetValue(this.value,'8');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_8" class="text-right" id="a_rate_8" style="width: 40px;" onkeyup="text_check('a_rate_8','5');" onfocus="this.select();nextfield ='a_nontax_cd_8';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_8" id="a_nontax_8" type="hidden" value="00"><input name="a_nontax_cd_8" class="bluebox" id="a_nontax_cd_8" style="width: 40px;" ondblclick="search_code('1', '8', 'double');" onfocus="this.select();nextfield ='calc1_8';"  onchange="search_code('1', '8', '');" type="text" value="000"> <input name="a_nontax_des_8" class="default" id="a_nontax_des_8" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_8" id="calc1_8" style="width: 80px;" onfocus="nextfield ='calc2_8';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_8" id="calc2_8" style="width: 80px;" onfocus="nextfield ='calc_flag_8';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_8" class="checkbox" id="calc_flag_8" onclick="check_click('8')" onfocus="nextfield ='attend_cd8';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_8" disabled="disabled" class="link-gray-none" id="calc_des_8" style="width: 56px;" onclick="cal('08','8');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd8" class="bluebox" id="attend_cd8" style="width: 35px;" ondblclick="search_code('2', '8', 'double');" onfocus="this.select();nextfield ='a_des_9';"  onchange="search_code('2', '8', '');" type="text" value=""> <input name="attend_des8" class="default" id="attend_des8" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun8" id="attend_gubun8" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[09] <input name="a_des_9" class="default" id="a_des_9" style="width:110px;" onfocus="this.select();nextfield ='a_sort_9';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_9" class="text-right" id="a_sort_9" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_9';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_9" class="checkbox" id="a_bonus_9" onfocus="this.select();nextfield ='a_bonus1_9';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_9" class="checkbox" id="a_bonus1_9" onfocus="this.select();nextfield ='a_daily_9';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_9" class="center" id="a_daily_9" style="width:105px;" onfocus="nextfield ='a_rate_9';" onchange="fnSetValue(this.value,'9');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_9" class="text-right" id="a_rate_9" style="width: 40px;" onkeyup="text_check('a_rate_9','5');" onfocus="this.select();nextfield ='a_nontax_cd_9';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_9" id="a_nontax_9" type="hidden" value="00"><input name="a_nontax_cd_9" class="bluebox" id="a_nontax_cd_9" style="width: 40px;" ondblclick="search_code('1', '9', 'double');" onfocus="this.select();nextfield ='calc1_9';"  onchange="search_code('1', '9', '');" type="text" value="000"> <input name="a_nontax_des_9" class="default" id="a_nontax_des_9" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_9" id="calc1_9" style="width: 80px;" onfocus="nextfield ='calc2_9';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_9" id="calc2_9" style="width: 80px;" onfocus="nextfield ='calc_flag_9';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_9" class="checkbox" id="calc_flag_9" onclick="check_click('9')" onfocus="nextfield ='attend_cd9';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_9" disabled="disabled" class="link-gray-none" id="calc_des_9" style="width: 56px;" onclick="cal('09','9');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd9" class="bluebox" id="attend_cd9" style="width: 35px;" ondblclick="search_code('2', '9', 'double');" onfocus="this.select();nextfield ='a_des_10';"  onchange="search_code('2', '9', '');" type="text" value=""> <input name="attend_des9" class="default" id="attend_des9" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun9" id="attend_gubun9" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[10] <input name="a_des_10" class="default" id="a_des_10" style="width:110px;" onfocus="this.select();nextfield ='a_sort_10';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_10" class="text-right" id="a_sort_10" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_10';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_10" class="checkbox" id="a_bonus_10" onfocus="this.select();nextfield ='a_bonus1_10';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_10" class="checkbox" id="a_bonus1_10" onfocus="this.select();nextfield ='a_daily_10';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_10" class="center" id="a_daily_10" style="width:105px;" onfocus="nextfield ='a_rate_10';" onchange="fnSetValue(this.value,'10');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_10" class="text-right" id="a_rate_10" style="width: 40px;" onkeyup="text_check('a_rate_10','5');" onfocus="this.select();nextfield ='a_nontax_cd_10';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_10" id="a_nontax_10" type="hidden" value="00"><input name="a_nontax_cd_10" class="bluebox" id="a_nontax_cd_10" style="width: 40px;" ondblclick="search_code('1', '10', 'double');" onfocus="this.select();nextfield ='calc1_10';"  onchange="search_code('1', '10', '');" type="text" value="000"> <input name="a_nontax_des_10" class="default" id="a_nontax_des_10" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_10" id="calc1_10" style="width: 80px;" onfocus="nextfield ='calc2_10';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_10" id="calc2_10" style="width: 80px;" onfocus="nextfield ='calc_flag_10';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_10" class="checkbox" id="calc_flag_10" onclick="check_click('10')" onfocus="nextfield ='attend_cd10';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_10" disabled="disabled" class="link-gray-none" id="calc_des_10" style="width: 56px;" onclick="cal('10','10');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd10" class="bluebox" id="attend_cd10" style="width: 35px;" ondblclick="search_code('2', '10', 'double');" onfocus="this.select();nextfield ='a_des_11';"  onchange="search_code('2', '10', '');" type="text" value=""> <input name="attend_des10" class="default" id="attend_des10" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun10" id="attend_gubun10" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[11] <input name="a_des_11" class="default" id="a_des_11" style="width:110px;" onfocus="this.select();nextfield ='a_sort_11';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_11" class="text-right" id="a_sort_11" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_11';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_11" class="checkbox" id="a_bonus_11" onfocus="this.select();nextfield ='a_bonus1_11';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_11" class="checkbox" id="a_bonus1_11" onfocus="this.select();nextfield ='a_daily_11';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_11" class="center" id="a_daily_11" style="width:105px;" onfocus="nextfield ='a_rate_11';" onchange="fnSetValue(this.value,'11');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_11" class="text-right" id="a_rate_11" style="width: 40px;" onkeyup="text_check('a_rate_11','5');" onfocus="this.select();nextfield ='a_nontax_cd_11';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_11" id="a_nontax_11" type="hidden" value="00"><input name="a_nontax_cd_11" class="bluebox" id="a_nontax_cd_11" style="width: 40px;" ondblclick="search_code('1', '11', 'double');" onfocus="this.select();nextfield ='calc1_11';"  onchange="search_code('1', '11', '');" type="text" value="000"> <input name="a_nontax_des_11" class="default" id="a_nontax_des_11" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_11" id="calc1_11" style="width: 80px;" onfocus="nextfield ='calc2_11';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_11" id="calc2_11" style="width: 80px;" onfocus="nextfield ='calc_flag_11';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_11" class="checkbox" id="calc_flag_11" onclick="check_click('11')" onfocus="nextfield ='attend_cd11';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_11" disabled="disabled" class="link-gray-none" id="calc_des_11" style="width: 56px;" onclick="cal('11','11');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd11" class="bluebox" id="attend_cd11" style="width: 35px;" ondblclick="search_code('2', '11', 'double');" onfocus="this.select();nextfield ='a_des_12';"  onchange="search_code('2', '11', '');" type="text" value=""> <input name="attend_des11" class="default" id="attend_des11" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun11" id="attend_gubun11" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[12] <input name="a_des_12" class="default" id="a_des_12" style="width:110px;" onfocus="this.select();nextfield ='a_sort_12';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_12" class="text-right" id="a_sort_12" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_12';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_12" class="checkbox" id="a_bonus_12" onfocus="this.select();nextfield ='a_bonus1_12';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_12" class="checkbox" id="a_bonus1_12" onfocus="this.select();nextfield ='a_daily_12';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_12" class="center" id="a_daily_12" style="width:105px;" onfocus="nextfield ='a_rate_12';" onchange="fnSetValue(this.value,'12');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_12" class="text-right" id="a_rate_12" style="width: 40px;" onkeyup="text_check('a_rate_12','5');" onfocus="this.select();nextfield ='a_nontax_cd_12';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_12" id="a_nontax_12" type="hidden" value="00"><input name="a_nontax_cd_12" class="bluebox" id="a_nontax_cd_12" style="width: 40px;" ondblclick="search_code('1', '12', 'double');" onfocus="this.select();nextfield ='calc1_12';"  onchange="search_code('1', '12', '');" type="text" value="000"> <input name="a_nontax_des_12" class="default" id="a_nontax_des_12" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_12" id="calc1_12" style="width: 80px;" onfocus="nextfield ='calc2_12';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_12" id="calc2_12" style="width: 80px;" onfocus="nextfield ='calc_flag_12';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_12" class="checkbox" id="calc_flag_12" onclick="check_click('12')" onfocus="nextfield ='attend_cd12';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_12" disabled="disabled" class="link-gray-none" id="calc_des_12" style="width: 56px;" onclick="cal('12','12');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd12" class="bluebox" id="attend_cd12" style="width: 35px;" ondblclick="search_code('2', '12', 'double');" onfocus="this.select();nextfield ='a_des_13';"  onchange="search_code('2', '12', '');" type="text" value=""> <input name="attend_des12" class="default" id="attend_des12" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun12" id="attend_gubun12" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[13] <input name="a_des_13" class="default" id="a_des_13" style="width:110px;" onfocus="this.select();nextfield ='a_sort_13';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_13" class="text-right" id="a_sort_13" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_13';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_13" class="checkbox" id="a_bonus_13" onfocus="this.select();nextfield ='a_bonus1_13';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_13" class="checkbox" id="a_bonus1_13" onfocus="this.select();nextfield ='a_daily_13';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_13" class="center" id="a_daily_13" style="width:105px;" onfocus="nextfield ='a_rate_13';" onchange="fnSetValue(this.value,'13');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_13" class="text-right" id="a_rate_13" style="width: 40px;" onkeyup="text_check('a_rate_13','5');" onfocus="this.select();nextfield ='a_nontax_cd_13';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_13" id="a_nontax_13" type="hidden" value="00"><input name="a_nontax_cd_13" class="bluebox" id="a_nontax_cd_13" style="width: 40px;" ondblclick="search_code('1', '13', 'double');" onfocus="this.select();nextfield ='calc1_13';"  onchange="search_code('1', '13', '');" type="text" value="000"> <input name="a_nontax_des_13" class="default" id="a_nontax_des_13" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_13" id="calc1_13" style="width: 80px;" onfocus="nextfield ='calc2_13';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_13" id="calc2_13" style="width: 80px;" onfocus="nextfield ='calc_flag_13';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_13" class="checkbox" id="calc_flag_13" onclick="check_click('13')" onfocus="nextfield ='attend_cd13';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_13" disabled="disabled" class="link-gray-none" id="calc_des_13" style="width: 56px;" onclick="cal('13','13');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd13" class="bluebox" id="attend_cd13" style="width: 35px;" ondblclick="search_code('2', '13', 'double');" onfocus="this.select();nextfield ='a_des_14';"  onchange="search_code('2', '13', '');" type="text" value=""> <input name="attend_des13" class="default" id="attend_des13" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun13" id="attend_gubun13" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[14] <input name="a_des_14" class="default" id="a_des_14" style="width:110px;" onfocus="this.select();nextfield ='a_sort_14';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_14" class="text-right" id="a_sort_14" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_14';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_14" class="checkbox" id="a_bonus_14" onfocus="this.select();nextfield ='a_bonus1_14';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_14" class="checkbox" id="a_bonus1_14" onfocus="this.select();nextfield ='a_daily_14';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_14" class="center" id="a_daily_14" style="width:105px;" onfocus="nextfield ='a_rate_14';" onchange="fnSetValue(this.value,'14');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_14" class="text-right" id="a_rate_14" style="width: 40px;" onkeyup="text_check('a_rate_14','5');" onfocus="this.select();nextfield ='a_nontax_cd_14';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_14" id="a_nontax_14" type="hidden" value="00"><input name="a_nontax_cd_14" class="bluebox" id="a_nontax_cd_14" style="width: 40px;" ondblclick="search_code('1', '14', 'double');" onfocus="this.select();nextfield ='calc1_14';"  onchange="search_code('1', '14', '');" type="text" value="000"> <input name="a_nontax_des_14" class="default" id="a_nontax_des_14" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_14" id="calc1_14" style="width: 80px;" onfocus="nextfield ='calc2_14';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_14" id="calc2_14" style="width: 80px;" onfocus="nextfield ='calc_flag_14';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_14" class="checkbox" id="calc_flag_14" onclick="check_click('14')" onfocus="nextfield ='attend_cd14';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_14" disabled="disabled" class="link-gray-none" id="calc_des_14" style="width: 56px;" onclick="cal('14','14');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd14" class="bluebox" id="attend_cd14" style="width: 35px;" ondblclick="search_code('2', '14', 'double');" onfocus="this.select();nextfield ='a_des_15';"  onchange="search_code('2', '14', '');" type="text" value=""> <input name="attend_des14" class="default" id="attend_des14" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun14" id="attend_gubun14" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[15] <input name="a_des_15" class="default" id="a_des_15" style="width:110px;" onfocus="this.select();nextfield ='a_sort_15';"  type="text" maxlength="20" value="식대"></td>
                            
                            
                            <td class="center"><input name="a_sort_15" class="text-right" id="a_sort_15" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_15';"  type="text" maxlength="2" value="7"></td>
                            
                            <td class="center"><input name="a_bonus_15" class="checkbox" id="a_bonus_15" onfocus="this.select();nextfield ='a_bonus1_15';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_15" class="checkbox" id="a_bonus1_15" onfocus="this.select();nextfield ='a_daily_15';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_15" class="center" id="a_daily_15" style="width:105px;" onfocus="nextfield ='a_rate_15';" onchange="fnSetValue(this.value,'15');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_15" class="text-right" id="a_rate_15" style="width: 40px;" onkeyup="text_check('a_rate_15','5');" onfocus="this.select();nextfield ='a_nontax_cd_15';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_15" id="a_nontax_15" type="hidden" value="00"><input name="a_nontax_cd_15" class="bluebox" id="a_nontax_cd_15" style="width: 40px;" ondblclick="search_code('1', '15', 'double');" onfocus="this.select();nextfield ='calc1_15';"  onchange="search_code('1', '15', '');" type="text" value="P01"> <input name="a_nontax_des_15" class="default" id="a_nontax_des_15" style="width: 120px;" type="text" readonly="readonly" value="식대"></td>
                                <td class="center">
                                    <select name="calc1_15" id="calc1_15" style="width: 80px;" onfocus="nextfield ='calc2_15';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_15" id="calc2_15" style="width: 80px;" onfocus="nextfield ='calc_flag_15';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_15" class="checkbox" id="calc_flag_15" onclick="check_click('15')" onfocus="nextfield ='attend_cd15';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_15" disabled="disabled" class="link-gray-none" id="calc_des_15" style="width: 56px;" onclick="cal('15','15');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd15" class="bluebox" id="attend_cd15" style="width: 35px;" ondblclick="search_code('2', '15', 'double');" onfocus="this.select();nextfield ='a_des_16';"  onchange="search_code('2', '15', '');" type="text" value=""> <input name="attend_des15" class="default" id="attend_des15" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun15" id="attend_gubun15" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[16] <input name="a_des_16" class="default" id="a_des_16" style="width:110px;" onfocus="this.select();nextfield ='a_sort_16';"  type="text" maxlength="20" value="차량유지비"></td>
                            
                            
                            <td class="center"><input name="a_sort_16" class="text-right" id="a_sort_16" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_16';"  type="text" maxlength="2" value="8"></td>
                            
                            <td class="center"><input name="a_bonus_16" class="checkbox" id="a_bonus_16" onfocus="this.select();nextfield ='a_bonus1_16';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_16" class="checkbox" id="a_bonus1_16" onfocus="this.select();nextfield ='a_daily_16';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_16" class="center" id="a_daily_16" style="width:105px;" onfocus="nextfield ='a_rate_16';" onchange="fnSetValue(this.value,'16');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_16" class="text-right" id="a_rate_16" style="width: 40px;" onkeyup="text_check('a_rate_16','5');" onfocus="this.select();nextfield ='a_nontax_cd_16';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_16" id="a_nontax_16" type="hidden" value="00"><input name="a_nontax_cd_16" class="bluebox" id="a_nontax_cd_16" style="width: 40px;" ondblclick="search_code('1', '16', 'double');" onfocus="this.select();nextfield ='calc1_16';"  onchange="search_code('1', '16', '');" type="text" value="H03"> <input name="a_nontax_des_16" class="default" id="a_nontax_des_16" style="width: 120px;" type="text" readonly="readonly" value="차량유지비 "></td>
                                <td class="center">
                                    <select name="calc1_16" id="calc1_16" style="width: 80px;" onfocus="nextfield ='calc2_16';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_16" id="calc2_16" style="width: 80px;" onfocus="nextfield ='calc_flag_16';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_16" class="checkbox" id="calc_flag_16" onclick="check_click('16')" onfocus="nextfield ='attend_cd16';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_16" disabled="disabled" class="link-gray-none" id="calc_des_16" style="width: 56px;" onclick="cal('16','16');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd16" class="bluebox" id="attend_cd16" style="width: 35px;" ondblclick="search_code('2', '16', 'double');" onfocus="this.select();nextfield ='a_des_17';"  onchange="search_code('2', '16', '');" type="text" value=""> <input name="attend_des16" class="default" id="attend_des16" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun16" id="attend_gubun16" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[17] <input name="a_des_17" class="default" id="a_des_17" style="width:110px;" onfocus="this.select();nextfield ='a_sort_17';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_17" class="text-right" id="a_sort_17" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_17';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_17" class="checkbox" id="a_bonus_17" onfocus="this.select();nextfield ='a_bonus1_17';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_17" class="checkbox" id="a_bonus1_17" onfocus="this.select();nextfield ='a_daily_17';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_17" class="center" id="a_daily_17" style="width:105px;" onfocus="nextfield ='a_rate_17';" onchange="fnSetValue(this.value,'17');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_17" class="text-right" id="a_rate_17" style="width: 40px;" onkeyup="text_check('a_rate_17','5');" onfocus="this.select();nextfield ='a_nontax_cd_17';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_17" id="a_nontax_17" type="hidden" value="00"><input name="a_nontax_cd_17" class="bluebox" id="a_nontax_cd_17" style="width: 40px;" ondblclick="search_code('1', '17', 'double');" onfocus="this.select();nextfield ='calc1_17';"  onchange="search_code('1', '17', '');" type="text" value="000"> <input name="a_nontax_des_17" class="default" id="a_nontax_des_17" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_17" id="calc1_17" style="width: 80px;" onfocus="nextfield ='calc2_17';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_17" id="calc2_17" style="width: 80px;" onfocus="nextfield ='calc_flag_17';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_17" class="checkbox" id="calc_flag_17" onclick="check_click('17')" onfocus="nextfield ='attend_cd17';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_17" disabled="disabled" class="link-gray-none" id="calc_des_17" style="width: 56px;" onclick="cal('17','17');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd17" class="bluebox" id="attend_cd17" style="width: 35px;" ondblclick="search_code('2', '17', 'double');" onfocus="this.select();nextfield ='a_des_18';"  onchange="search_code('2', '17', '');" type="text" value=""> <input name="attend_des17" class="default" id="attend_des17" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun17" id="attend_gubun17" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[18] <input name="a_des_18" class="default" id="a_des_18" style="width:110px;" onfocus="this.select();nextfield ='a_sort_18';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_18" class="text-right" id="a_sort_18" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_18';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_18" class="checkbox" id="a_bonus_18" onfocus="this.select();nextfield ='a_bonus1_18';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_18" class="checkbox" id="a_bonus1_18" onfocus="this.select();nextfield ='a_daily_18';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_18" class="center" id="a_daily_18" style="width:105px;" onfocus="nextfield ='a_rate_18';" onchange="fnSetValue(this.value,'18');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_18" class="text-right" id="a_rate_18" style="width: 40px;" onkeyup="text_check('a_rate_18','5');" onfocus="this.select();nextfield ='a_nontax_cd_18';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_18" id="a_nontax_18" type="hidden" value="00"><input name="a_nontax_cd_18" class="bluebox" id="a_nontax_cd_18" style="width: 40px;" ondblclick="search_code('1', '18', 'double');" onfocus="this.select();nextfield ='calc1_18';"  onchange="search_code('1', '18', '');" type="text" value="000"> <input name="a_nontax_des_18" class="default" id="a_nontax_des_18" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_18" id="calc1_18" style="width: 80px;" onfocus="nextfield ='calc2_18';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_18" id="calc2_18" style="width: 80px;" onfocus="nextfield ='calc_flag_18';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_18" class="checkbox" id="calc_flag_18" onclick="check_click('18')" onfocus="nextfield ='attend_cd18';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_18" disabled="disabled" class="link-gray-none" id="calc_des_18" style="width: 56px;" onclick="cal('18','18');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd18" class="bluebox" id="attend_cd18" style="width: 35px;" ondblclick="search_code('2', '18', 'double');" onfocus="this.select();nextfield ='a_des_19';"  onchange="search_code('2', '18', '');" type="text" value=""> <input name="attend_des18" class="default" id="attend_des18" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun18" id="attend_gubun18" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[19] <input name="a_des_19" class="default" id="a_des_19" style="width:110px;" onfocus="this.select();nextfield ='a_sort_19';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_19" class="text-right" id="a_sort_19" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_19';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_19" class="checkbox" id="a_bonus_19" onfocus="this.select();nextfield ='a_bonus1_19';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_19" class="checkbox" id="a_bonus1_19" onfocus="this.select();nextfield ='a_daily_19';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_19" class="center" id="a_daily_19" style="width:105px;" onfocus="nextfield ='a_rate_19';" onchange="fnSetValue(this.value,'19');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_19" class="text-right" id="a_rate_19" style="width: 40px;" onkeyup="text_check('a_rate_19','5');" onfocus="this.select();nextfield ='a_nontax_cd_19';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_19" id="a_nontax_19" type="hidden" value="00"><input name="a_nontax_cd_19" class="bluebox" id="a_nontax_cd_19" style="width: 40px;" ondblclick="search_code('1', '19', 'double');" onfocus="this.select();nextfield ='calc1_19';"  onchange="search_code('1', '19', '');" type="text" value="000"> <input name="a_nontax_des_19" class="default" id="a_nontax_des_19" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_19" id="calc1_19" style="width: 80px;" onfocus="nextfield ='calc2_19';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_19" id="calc2_19" style="width: 80px;" onfocus="nextfield ='calc_flag_19';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_19" class="checkbox" id="calc_flag_19" onclick="check_click('19')" onfocus="nextfield ='attend_cd19';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_19" disabled="disabled" class="link-gray-none" id="calc_des_19" style="width: 56px;" onclick="cal('19','19');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd19" class="bluebox" id="attend_cd19" style="width: 35px;" ondblclick="search_code('2', '19', 'double');" onfocus="this.select();nextfield ='a_des_20';"  onchange="search_code('2', '19', '');" type="text" value=""> <input name="attend_des19" class="default" id="attend_des19" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun19" id="attend_gubun19" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[21] <input name="a_des_21" class="default" id="a_des_21" style="width:110px;" onfocus="this.select();nextfield ='a_sort_21';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_21" class="text-right" id="a_sort_21" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_21';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_21" class="checkbox" id="a_bonus_21" onfocus="this.select();nextfield ='a_bonus1_21';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_21" class="checkbox" id="a_bonus1_21" onfocus="this.select();nextfield ='a_daily_21';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_21" class="center" id="a_daily_21" style="width:105px;" onfocus="nextfield ='a_rate_21';" onchange="fnSetValue(this.value,'21');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_21" class="text-right" id="a_rate_21" style="width: 40px;" onkeyup="text_check('a_rate_21','5');" onfocus="this.select();nextfield ='a_nontax_cd_21';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_21" id="a_nontax_21" type="hidden" value="00"><input name="a_nontax_cd_21" class="bluebox" id="a_nontax_cd_21" style="width: 40px;" ondblclick="search_code('1', '21', 'double');" onfocus="this.select();nextfield ='calc1_21';"  onchange="search_code('1', '21', '');" type="text" value="000"> <input name="a_nontax_des_21" class="default" id="a_nontax_des_21" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_21" id="calc1_21" style="width: 80px;" onfocus="nextfield ='calc2_21';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_21" id="calc2_21" style="width: 80px;" onfocus="nextfield ='calc_flag_21';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_21" class="checkbox" id="calc_flag_21" onclick="check_click('21')" onfocus="nextfield ='attend_cd21';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_21" disabled="disabled" class="link-gray-none" id="calc_des_21" style="width: 56px;" onclick="cal('21','21');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd21" class="bluebox" id="attend_cd21" style="width: 35px;" ondblclick="search_code('2', '21', 'double');" onfocus="this.select();nextfield ='a_des_22';"  onchange="search_code('2', '21', '');" type="text" value=""> <input name="attend_des21" class="default" id="attend_des21" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun21" id="attend_gubun21" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[22] <input name="a_des_22" class="default" id="a_des_22" style="width:110px;" onfocus="this.select();nextfield ='a_sort_22';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_22" class="text-right" id="a_sort_22" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_22';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_22" class="checkbox" id="a_bonus_22" onfocus="this.select();nextfield ='a_bonus1_22';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_22" class="checkbox" id="a_bonus1_22" onfocus="this.select();nextfield ='a_daily_22';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_22" class="center" id="a_daily_22" style="width:105px;" onfocus="nextfield ='a_rate_22';" onchange="fnSetValue(this.value,'22');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_22" class="text-right" id="a_rate_22" style="width: 40px;" onkeyup="text_check('a_rate_22','5');" onfocus="this.select();nextfield ='a_nontax_cd_22';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_22" id="a_nontax_22" type="hidden" value="00"><input name="a_nontax_cd_22" class="bluebox" id="a_nontax_cd_22" style="width: 40px;" ondblclick="search_code('1', '22', 'double');" onfocus="this.select();nextfield ='calc1_22';"  onchange="search_code('1', '22', '');" type="text" value="000"> <input name="a_nontax_des_22" class="default" id="a_nontax_des_22" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_22" id="calc1_22" style="width: 80px;" onfocus="nextfield ='calc2_22';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_22" id="calc2_22" style="width: 80px;" onfocus="nextfield ='calc_flag_22';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_22" class="checkbox" id="calc_flag_22" onclick="check_click('22')" onfocus="nextfield ='attend_cd22';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_22" disabled="disabled" class="link-gray-none" id="calc_des_22" style="width: 56px;" onclick="cal('22','22');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd22" class="bluebox" id="attend_cd22" style="width: 35px;" ondblclick="search_code('2', '22', 'double');" onfocus="this.select();nextfield ='a_des_23';"  onchange="search_code('2', '22', '');" type="text" value=""> <input name="attend_des22" class="default" id="attend_des22" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun22" id="attend_gubun22" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[23] <input name="a_des_23" class="default" id="a_des_23" style="width:110px;" onfocus="this.select();nextfield ='a_sort_23';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_23" class="text-right" id="a_sort_23" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_23';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_23" class="checkbox" id="a_bonus_23" onfocus="this.select();nextfield ='a_bonus1_23';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_23" class="checkbox" id="a_bonus1_23" onfocus="this.select();nextfield ='a_daily_23';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_23" class="center" id="a_daily_23" style="width:105px;" onfocus="nextfield ='a_rate_23';" onchange="fnSetValue(this.value,'23');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_23" class="text-right" id="a_rate_23" style="width: 40px;" onkeyup="text_check('a_rate_23','5');" onfocus="this.select();nextfield ='a_nontax_cd_23';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_23" id="a_nontax_23" type="hidden" value="00"><input name="a_nontax_cd_23" class="bluebox" id="a_nontax_cd_23" style="width: 40px;" ondblclick="search_code('1', '23', 'double');" onfocus="this.select();nextfield ='calc1_23';"  onchange="search_code('1', '23', '');" type="text" value="000"> <input name="a_nontax_des_23" class="default" id="a_nontax_des_23" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_23" id="calc1_23" style="width: 80px;" onfocus="nextfield ='calc2_23';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_23" id="calc2_23" style="width: 80px;" onfocus="nextfield ='calc_flag_23';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_23" class="checkbox" id="calc_flag_23" onclick="check_click('23')" onfocus="nextfield ='attend_cd23';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_23" disabled="disabled" class="link-gray-none" id="calc_des_23" style="width: 56px;" onclick="cal('23','23');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd23" class="bluebox" id="attend_cd23" style="width: 35px;" ondblclick="search_code('2', '23', 'double');" onfocus="this.select();nextfield ='a_des_24';"  onchange="search_code('2', '23', '');" type="text" value=""> <input name="attend_des23" class="default" id="attend_des23" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun23" id="attend_gubun23" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[24] <input name="a_des_24" class="default" id="a_des_24" style="width:110px;" onfocus="this.select();nextfield ='a_sort_24';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_24" class="text-right" id="a_sort_24" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_24';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_24" class="checkbox" id="a_bonus_24" onfocus="this.select();nextfield ='a_bonus1_24';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_24" class="checkbox" id="a_bonus1_24" onfocus="this.select();nextfield ='a_daily_24';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_24" class="center" id="a_daily_24" style="width:105px;" onfocus="nextfield ='a_rate_24';" onchange="fnSetValue(this.value,'24');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_24" class="text-right" id="a_rate_24" style="width: 40px;" onkeyup="text_check('a_rate_24','5');" onfocus="this.select();nextfield ='a_nontax_cd_24';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_24" id="a_nontax_24" type="hidden" value="00"><input name="a_nontax_cd_24" class="bluebox" id="a_nontax_cd_24" style="width: 40px;" ondblclick="search_code('1', '24', 'double');" onfocus="this.select();nextfield ='calc1_24';"  onchange="search_code('1', '24', '');" type="text" value="000"> <input name="a_nontax_des_24" class="default" id="a_nontax_des_24" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_24" id="calc1_24" style="width: 80px;" onfocus="nextfield ='calc2_24';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_24" id="calc2_24" style="width: 80px;" onfocus="nextfield ='calc_flag_24';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_24" class="checkbox" id="calc_flag_24" onclick="check_click('24')" onfocus="nextfield ='attend_cd24';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_24" disabled="disabled" class="link-gray-none" id="calc_des_24" style="width: 56px;" onclick="cal('24','24');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd24" class="bluebox" id="attend_cd24" style="width: 35px;" ondblclick="search_code('2', '24', 'double');" onfocus="this.select();nextfield ='a_des_25';"  onchange="search_code('2', '24', '');" type="text" value=""> <input name="attend_des24" class="default" id="attend_des24" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun24" id="attend_gubun24" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[25] <input name="a_des_25" class="default" id="a_des_25" style="width:110px;" onfocus="this.select();nextfield ='a_sort_25';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_25" class="text-right" id="a_sort_25" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_25';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_25" class="checkbox" id="a_bonus_25" onfocus="this.select();nextfield ='a_bonus1_25';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_25" class="checkbox" id="a_bonus1_25" onfocus="this.select();nextfield ='a_daily_25';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_25" class="center" id="a_daily_25" style="width:105px;" onfocus="nextfield ='a_rate_25';" onchange="fnSetValue(this.value,'25');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_25" class="text-right" id="a_rate_25" style="width: 40px;" onkeyup="text_check('a_rate_25','5');" onfocus="this.select();nextfield ='a_nontax_cd_25';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_25" id="a_nontax_25" type="hidden" value="00"><input name="a_nontax_cd_25" class="bluebox" id="a_nontax_cd_25" style="width: 40px;" ondblclick="search_code('1', '25', 'double');" onfocus="this.select();nextfield ='calc1_25';"  onchange="search_code('1', '25', '');" type="text" value="000"> <input name="a_nontax_des_25" class="default" id="a_nontax_des_25" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_25" id="calc1_25" style="width: 80px;" onfocus="nextfield ='calc2_25';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_25" id="calc2_25" style="width: 80px;" onfocus="nextfield ='calc_flag_25';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_25" class="checkbox" id="calc_flag_25" onclick="check_click('25')" onfocus="nextfield ='attend_cd25';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_25" disabled="disabled" class="link-gray-none" id="calc_des_25" style="width: 56px;" onclick="cal('25','25');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd25" class="bluebox" id="attend_cd25" style="width: 35px;" ondblclick="search_code('2', '25', 'double');" onfocus="this.select();nextfield ='a_des_26';"  onchange="search_code('2', '25', '');" type="text" value=""> <input name="attend_des25" class="default" id="attend_des25" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun25" id="attend_gubun25" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[26] <input name="a_des_26" class="default" id="a_des_26" style="width:110px;" onfocus="this.select();nextfield ='a_sort_26';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_26" class="text-right" id="a_sort_26" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_26';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_26" class="checkbox" id="a_bonus_26" onfocus="this.select();nextfield ='a_bonus1_26';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_26" class="checkbox" id="a_bonus1_26" onfocus="this.select();nextfield ='a_daily_26';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_26" class="center" id="a_daily_26" style="width:105px;" onfocus="nextfield ='a_rate_26';" onchange="fnSetValue(this.value,'26');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_26" class="text-right" id="a_rate_26" style="width: 40px;" onkeyup="text_check('a_rate_26','5');" onfocus="this.select();nextfield ='a_nontax_cd_26';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_26" id="a_nontax_26" type="hidden" value="00"><input name="a_nontax_cd_26" class="bluebox" id="a_nontax_cd_26" style="width: 40px;" ondblclick="search_code('1', '26', 'double');" onfocus="this.select();nextfield ='calc1_26';"  onchange="search_code('1', '26', '');" type="text" value="000"> <input name="a_nontax_des_26" class="default" id="a_nontax_des_26" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_26" id="calc1_26" style="width: 80px;" onfocus="nextfield ='calc2_26';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_26" id="calc2_26" style="width: 80px;" onfocus="nextfield ='calc_flag_26';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_26" class="checkbox" id="calc_flag_26" onclick="check_click('26')" onfocus="nextfield ='attend_cd26';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_26" disabled="disabled" class="link-gray-none" id="calc_des_26" style="width: 56px;" onclick="cal('26','26');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd26" class="bluebox" id="attend_cd26" style="width: 35px;" ondblclick="search_code('2', '26', 'double');" onfocus="this.select();nextfield ='a_des_27';"  onchange="search_code('2', '26', '');" type="text" value=""> <input name="attend_des26" class="default" id="attend_des26" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun26" id="attend_gubun26" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[27] <input name="a_des_27" class="default" id="a_des_27" style="width:110px;" onfocus="this.select();nextfield ='a_sort_27';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_27" class="text-right" id="a_sort_27" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_27';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_27" class="checkbox" id="a_bonus_27" onfocus="this.select();nextfield ='a_bonus1_27';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_27" class="checkbox" id="a_bonus1_27" onfocus="this.select();nextfield ='a_daily_27';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_27" class="center" id="a_daily_27" style="width:105px;" onfocus="nextfield ='a_rate_27';" onchange="fnSetValue(this.value,'27');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_27" class="text-right" id="a_rate_27" style="width: 40px;" onkeyup="text_check('a_rate_27','5');" onfocus="this.select();nextfield ='a_nontax_cd_27';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_27" id="a_nontax_27" type="hidden" value="00"><input name="a_nontax_cd_27" class="bluebox" id="a_nontax_cd_27" style="width: 40px;" ondblclick="search_code('1', '27', 'double');" onfocus="this.select();nextfield ='calc1_27';"  onchange="search_code('1', '27', '');" type="text" value="000"> <input name="a_nontax_des_27" class="default" id="a_nontax_des_27" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_27" id="calc1_27" style="width: 80px;" onfocus="nextfield ='calc2_27';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_27" id="calc2_27" style="width: 80px;" onfocus="nextfield ='calc_flag_27';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_27" class="checkbox" id="calc_flag_27" onclick="check_click('27')" onfocus="nextfield ='attend_cd27';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_27" disabled="disabled" class="link-gray-none" id="calc_des_27" style="width: 56px;" onclick="cal('27','27');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd27" class="bluebox" id="attend_cd27" style="width: 35px;" ondblclick="search_code('2', '27', 'double');" onfocus="this.select();nextfield ='a_des_28';"  onchange="search_code('2', '27', '');" type="text" value=""> <input name="attend_des27" class="default" id="attend_des27" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun27" id="attend_gubun27" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[28] <input name="a_des_28" class="default" id="a_des_28" style="width:110px;" onfocus="this.select();nextfield ='a_sort_28';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_28" class="text-right" id="a_sort_28" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_28';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_28" class="checkbox" id="a_bonus_28" onfocus="this.select();nextfield ='a_bonus1_28';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_28" class="checkbox" id="a_bonus1_28" onfocus="this.select();nextfield ='a_daily_28';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_28" class="center" id="a_daily_28" style="width:105px;" onfocus="nextfield ='a_rate_28';" onchange="fnSetValue(this.value,'28');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_28" class="text-right" id="a_rate_28" style="width: 40px;" onkeyup="text_check('a_rate_28','5');" onfocus="this.select();nextfield ='a_nontax_cd_28';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_28" id="a_nontax_28" type="hidden" value="00"><input name="a_nontax_cd_28" class="bluebox" id="a_nontax_cd_28" style="width: 40px;" ondblclick="search_code('1', '28', 'double');" onfocus="this.select();nextfield ='calc1_28';"  onchange="search_code('1', '28', '');" type="text" value="000"> <input name="a_nontax_des_28" class="default" id="a_nontax_des_28" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_28" id="calc1_28" style="width: 80px;" onfocus="nextfield ='calc2_28';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_28" id="calc2_28" style="width: 80px;" onfocus="nextfield ='calc_flag_28';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_28" class="checkbox" id="calc_flag_28" onclick="check_click('28')" onfocus="nextfield ='attend_cd28';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_28" disabled="disabled" class="link-gray-none" id="calc_des_28" style="width: 56px;" onclick="cal('28','28');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd28" class="bluebox" id="attend_cd28" style="width: 35px;" ondblclick="search_code('2', '28', 'double');" onfocus="this.select();nextfield ='a_des_29';"  onchange="search_code('2', '28', '');" type="text" value=""> <input name="attend_des28" class="default" id="attend_des28" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun28" id="attend_gubun28" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[29] <input name="a_des_29" class="default" id="a_des_29" style="width:110px;" onfocus="this.select();nextfield ='a_sort_29';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_29" class="text-right" id="a_sort_29" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_29';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_29" class="checkbox" id="a_bonus_29" onfocus="this.select();nextfield ='a_bonus1_29';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_29" class="checkbox" id="a_bonus1_29" onfocus="this.select();nextfield ='a_daily_29';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_29" class="center" id="a_daily_29" style="width:105px;" onfocus="nextfield ='a_rate_29';" onchange="fnSetValue(this.value,'29');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_29" class="text-right" id="a_rate_29" style="width: 40px;" onkeyup="text_check('a_rate_29','5');" onfocus="this.select();nextfield ='a_nontax_cd_29';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_29" id="a_nontax_29" type="hidden" value="00"><input name="a_nontax_cd_29" class="bluebox" id="a_nontax_cd_29" style="width: 40px;" ondblclick="search_code('1', '29', 'double');" onfocus="this.select();nextfield ='calc1_29';"  onchange="search_code('1', '29', '');" type="text" value="000"> <input name="a_nontax_des_29" class="default" id="a_nontax_des_29" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_29" id="calc1_29" style="width: 80px;" onfocus="nextfield ='calc2_29';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_29" id="calc2_29" style="width: 80px;" onfocus="nextfield ='calc_flag_29';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_29" class="checkbox" id="calc_flag_29" onclick="check_click('29')" onfocus="nextfield ='attend_cd29';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_29" disabled="disabled" class="link-gray-none" id="calc_des_29" style="width: 56px;" onclick="cal('29','29');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd29" class="bluebox" id="attend_cd29" style="width: 35px;" ondblclick="search_code('2', '29', 'double');" onfocus="this.select();nextfield ='a_des_30';"  onchange="search_code('2', '29', '');" type="text" value=""> <input name="attend_des29" class="default" id="attend_des29" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun29" id="attend_gubun29" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[30] <input name="a_des_30" class="default" id="a_des_30" style="width:110px;" onfocus="this.select();nextfield ='a_sort_30';"  type="text" maxlength="20" value=""></td>
                            
                            
                            <td class="center"><input name="a_sort_30" class="text-right" id="a_sort_30" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='a_bonus_30';"  type="text" maxlength="2" value="0"></td>
                            
                            <td class="center"><input name="a_bonus_30" class="checkbox" id="a_bonus_30" onfocus="this.select();nextfield ='a_bonus1_30';"  type="checkbox" value="1"></td><td class="center"><input name="a_bonus1_30" class="checkbox" id="a_bonus1_30" onfocus="this.select();nextfield ='a_daily_30';"  type="checkbox" value="1"></td>
                                <td>
                                    <select name="a_daily_30" class="center" id="a_daily_30" style="width:105px;" onfocus="nextfield ='a_rate_30';" onchange="fnSetValue(this.value,'30');">
                                        <option selected="selected" value="0">고정</option>
                                        <option value="1">변동(일)</option>
                                        <option value="2">변동(시간)</option>
                                        <option value="3">변동(지급률)</option>
                                    </select>
                                </td>
                            <td class="center"><input name="a_rate_30" class="text-right" id="a_rate_30" style="width: 40px;" onkeyup="text_check('a_rate_30','5');" onfocus="this.select();nextfield ='a_nontax_cd_30';"  type="text" maxlength="5" value="0"></td><td class="center"><input name="a_nontax_30" id="a_nontax_30" type="hidden" value="00"><input name="a_nontax_cd_30" class="bluebox" id="a_nontax_cd_30" style="width: 40px;" ondblclick="search_code('1', '30', 'double');" onfocus="this.select();nextfield ='calc1_30';"  onchange="search_code('1', '30', '');" type="text" value="000"> <input name="a_nontax_des_30" class="default" id="a_nontax_des_30" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
                                <td class="center">
                                    <select name="calc1_30" id="calc1_30" style="width: 80px;" onfocus="nextfield ='calc2_30';">
                                        <option selected="selected" value="01">원</option>
                                        <option value="10">십원</option>
                                        <option value="21">소수점1</option>
                                        <option value="22">소수점2</option>
                                    </select>  
                                    <select name="calc2_30" id="calc2_30" style="width: 80px;" onfocus="nextfield ='calc_flag_30';">
                                    
                                    
                                        <option selected="selected" value="R">반올림</option>
                                        <option value="C">절상</option>
                                        <option value="F">절사</option>
                                    </select>
                                </td>
                            <td class="center"><input name="calc_flag_30" class="checkbox" id="calc_flag_30" onclick="check_click('30')" onfocus="nextfield ='attend_cd30';" type="checkbox" value="1"></td><td class="center"><a name="calc_des_30" disabled="disabled" class="link-gray-none" id="calc_des_30" style="width: 56px;" onclick="cal('30','30');" href="#">계산내역</a></td>
                                <td class="center"><input name="attend_cd30" class="bluebox" id="attend_cd30" style="width: 35px;" ondblclick="search_code('2', '30', 'double');" onfocus="this.select();nextfield ='a_des_31';"  onchange="search_code('2', '30', '');" type="text" value=""> <input name="attend_des30" class="default" id="attend_des30" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun30" id="attend_gubun30" type="hidden" value=""></td>
                                
                            
                        </tr>    
                    
                        <tr>
                            <td>[20] <input name="a_des_20" class="bluebox" id="a_des_20" style="width:110px;" onfocus="this.select();nextfield ='a_sort_20';"  type="text" maxlength="20" value="상여"></td>
                            
                            
                            <td class="center"><input name="a_sort_20" class="text-right" id="a_sort_20" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();nextfield ='calc1_20';"  type="text" maxlength="2" value="20"></td>
                            
                            <td class="center"><input name="a_bonus_20" id="a_bonus_20" type="hidden" value="0"></td>
                            <td class="center"><input name="a_bonus1_20" id="a_bonus1_20" type="hidden" value="0"></td>
                            <td class="center"><input name="a_daily_20" id="a_daily_20" type="hidden" value="0"></td>
                            <td class="center"><input name="a_rate_20" id="a_rate_20" type="hidden" value="0"></td>
                            <td class="center"><input name="a_rate_20" id="a_nontax_20" type="hidden" value="00"></td>
                            <td class="center"><input name="calc1_20" id="calc1_20" type="hidden" value="01"><input name="calc2_20" id="calc2_20" type="hidden" value="R"></td>
                            <td class="center"><input name="calc_flag_20" id="calc_flag_20" type="hidden" value="0"></td>
                            <td class="center"><input name="calc_des20" id="calc_des20" type="hidden" value="계산내역"></td>
                            <td class="center"></td>
                            
                        </tr>    
                    
                    </tbody>
                </table>
   
                <br><br><br><br>
            </div> <!-- //contents-->
            <div class="footerBG">
				<span class="btn blue-inverse"><input name="btnSave" id="btnSave" onclick="fnSave();" type="button" value="저장(F8)"></span>   
			</div>
		<input name="hidRow" id="hidRow" type="hidden" value="30">
		</form>

	</div>
	</div><!-- /.row -->

			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-minus-square bigger-110"></i>
						저장
					</button>

					<button class="btn " type="button" onclick="ㅁ()">
						<i class="ace-icon fa fa-minus-square bigger-110"></i>
						닫기
					</button>

					<button class="btn" type="reset">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록가기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<input type="hidden" name="flag" id="flag" value="4" />
<input type="hidden" name="acicdFlag" id="acicdFlag" value="" />
<input type="hidden" name="accountcdFlag" id="accountcdFlag" value="" />
<input type="hidden" name="slipgubunFlag" id="slipgubunFlag" value="" />

<div id="dialog-message1" class="hide">
	<table id="department_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">부서코드</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">부서명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<div id="dialog-message2" class="dialog-view hide">
	<table id="project_list" class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">프로젝트코드</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">프로젝트명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->


<div id="dialog-message3" class="dialog-view hide">
	<table id="account_list" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="col-xs-2 center" style="background-color:#f1f1f1">거래처구분</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">거래처코드</th>
				<th class="col-xs-5 center" style="background-color:#f1f1f1">거래처명</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<div id="dialog-message4" class="dialog-view hide">
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="col-xs-12">
						<div class="col-xs-3" style="float:left">
							계정코드검색
						</div>
						<!-- <div class="col-xs-4" style="float:left">
						<select class="form-control" onchange="setAccountCode(this.value)">
							<option value="cd">계정코드</option>
							<option value="nm">계정명</option>
						</select>
						</div> -->
						<div class="col-xs-8" style="float:right">
							<div class="col-xs-12"  style="float:right">
								<div class="input-group">						
									<input type="text" class="form-control search-query" placeholder="Search..." name="search_txt" id="search_txt" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-purple btn-sm" onclick="search()">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											Search
										</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
					<div style="margin-top:10px">
						<table id="account_code_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="col-xs-6 center" style="background-color:#f1f1f1">[계정코드] 계정명</th>
									<th class="col-xs-6 center" style="background-color:#f1f1f1">검색창내용</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
			</div>
		</div>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->


<div id="dialog-message5" class="dialog-view hide">
	<table id="card_list" class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-4 center" style="background-color:#f1f1f1">카드번호</th>
				<th class="col-xs-3 center" style="background-color:#f1f1f1">카드명</th>
				<th class="col-xs-3 center" style="background-color:#f1f1f1">구분</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->

<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getProject();
	getAccount();
	getDepartment(1);
	getAccountCode();
	//createCustomerDepositCa();
	getCard();
	//slipTypeNow();

	$("#checkedAll").click(function(){
		if($("#checkedAll").prop('checked')) {
			$(".chk").each(function(){
				$(this).prop("checked",true);
			});
		} else {
			$(".chk").each(function(){
				$(this).prop("checked",false);
			});
		}
	});
});

function createCustomerDepositCa(){
	var data_string = "mode=createCustomerDepositCa";
	$.ajax({
		type : "post",
		url : "ajax/cash.php",
		data : data_string,
		success : function(str) {
			$("#card_sales_slips_ca").val(str);
		}
	});
}

function getDepartment(page) {
	var rpp = 15;
	var adjacents = 4;
	var page = page;
	var tag = "";

	$.getJSON("ajax/department.php",{"page":page, "mode":"getDepartment", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postDepartmentData('" + json[i].uid + "','" + json[i].department_nm + "')\">" + json[i].uid + "</a></td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postDepartmentData('" + json[i].uid + "','" + json[i].department_nm + "')\">" + json[i].department_nm + "</a></td>";
					tag += "</tr>";
				}
			}

			$("#department_list tbody").html(tag);

			var table = "erp_department";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function acicdFlag(flag) {
	$("#acicdFlag").val(flag);
}

function accountcdFlag(flag) {
	$("#accountcdFlag").val(flag);
}
function slipgubunFlag(flag) {
	$("#slipgubunFlag").val(flag);
}
function self_close()
{	
	parent.$.modal.close();
}
/*
function close_popup()
{	
	$.modal.close();
}*/

function postDepartmentData(cd,nm) {
	$("#dialog-message1").dialog("close");
	$("#department_cd").val(cd);
	$("#department_nm").val(nm);
}
function postProject(code,name) {
	$("#dialog-message2").dialog("close");
	$("#project_cd").val(code);
	$("#project_nm").val(name);
}
function postAccount(code,name,manager) {
	$("#dialog-message3").dialog("close");
	$("#account_cd").val(code);
	$("#account_nm").val(name);
}

function postAccountCode(code,name){
	$("#dialog-message4").dialog("close");
	$("#aci_cd").val(code);
	$("#aci_nm").val(name);
	//}
}
function postBanks(code,name){
	$("#dialog-message5").dialog("close");
	$("#bank_num").val(code);
	$("#bank_name").val(name);
	//}
}
function postCards(code,name){
	$("#dialog-message5").dialog("close");
	$("#card_no").val(code);
	$("#card_nm").val(name);
	//}
}

function close_popup()
{	
	//$.dialog.close();
	$("#dialog-message1").dialog("close");
	$("#dialog-message2").dialog("close");
	$("#dialog-message3").dialog("close");
	$("#dialog-message4").dialog("close");
	$("#dialog-message5").dialog("close");
}

//-----------------------------------------------------------------------
// 기  능 : 숫자를 금액 형식으로
//-----------------------------------------------------------------------
function Num2Money(number){

	number		=	Money2Num(number);

	if(isNaN(number))			return number;
	if(parseFloat(number)==0)	return 0;
	if(!number)					return "";
	var strint="";
	var strfloat="";
	var tmp;
	var ans="";
	var isfloat=false;
	var minus=false;
	var result='';

	if(number.indexOf("-")>-1){
		minus=true;
		number=number.replace('-','');
	}

	if(number.indexOf(".")==-1) strint=number;
	else {
		isfloat=true;
		strint=number.substring(0,number.indexOf("."));
		if(parseInt(strint,10)==0)	strint = '0';
		strfloat=number.substring(number.indexOf("."),number.length);
	}

	if(!isNaN(strint) && strint!=""){
		strint	=	String(parseInt(strint,10));
	}

	var num=strint.split("");

	tmp=num.reverse();

	for(a=0;a<tmp.length;a++) {
		if(!(a%3) && a!=0) { ans+=",";  }
		ans+=tmp[a];
	}

	tmp=ans.split("").reverse();
	ans="";

	for(a=0;a<tmp.length;a++){ ans+=tmp[a];}

	for(a=0;a<2;a++)
		if(ans.charAt(0)=="0" || ans.charAt(0)==",") ans=ans.substring(1,ans.length);

	result=ans+strfloat;

	if(isfloat==true){
		var lastchar=result.substr(result.length-1,1);
		while (lastchar == '0' || lastchar == '.'){
			result = result.substr(0,result.length-1);
			if (lastchar == '.'){break;}
			lastchar=result.substr(result.length-1,1);
		}
	}

	var tmpresult = parseFloat(Money2Num(result));

	if(tmpresult>0 && tmpresult<1){
		result = '0'+result;
	}

	return	(minus==true) ? '-'+result : result
}
//-----------------------------------------------------------------------
// 기  능 : 금액을 숫자 형식으로
//-----------------------------------------------------------------------
function Money2Num(money) {
	if(money == undefined)	return false;
	var moneyString		=	new String;
	moneyString			=	money.toString();
	while (moneyString.indexOf(',') > -1){
		moneyString	=	moneyString.replace(',','');
	}
	if(isNaN(moneyString)){
		return false;
	}else{
		return moneyString;
	}
}


function tax_calculation(slip_gubun){
	var cnt = new Array();
	var unit_price = new Array();
	var tax = new Array();
	var hap = new Array();

	var re_unit_price = new Array();
	var re_tax = new Array();
	var total = new Array();
	var values = 0;

	$.each($(".cnt") , function () {
		cnt.push(removeComma($(this).val()));
	});

	$.each($(".unit_price") , function () {
		unit_price.push(removeComma($(this).val()));
	});

	$.each($(".tax") , function () {
		tax.push(removeComma($(this).val()));
	});

	for(var i = 0 ; i < cnt.length ; i++) {
		if(cnt[i] > 0) {
			values = Number(cnt[i]) * Number(unit_price[i]);

			// 부가세적용
			if(slip_gubun == 1) {
				var supply_price = values/1.1;
				var cal_tax = values-supply_price;
				var re_hap = values + cal_tax;
				
				re_unit_price.push(supply_price);
				re_tax.push(cal_tax);
				total.push(Number(re_hap));
			} else { // 부가세 미적용
				var re_hap = unit_price[i];
				var cal_tax = 0;

				re_unit_price.push(re_hap);
				re_tax.push(cal_tax);
				total.push(re_hap * cnt[i]);
			}
		}
	}

	for (var i = 0 ; i < cnt.length ; i++)
	{
		if(removeComma(total[i]) > 0) {
			$(".tax").eq(i).val(Math.round(re_tax[i]));
			$(".total_price").eq(i).val(commaSplit(Math.round(total[i])));
		}
	}
}

// 공급가액 계산
function calculation() {
	var amount	= $("#amount").val(); 
	var fee		= $("#fee").val();
	
	$("#amount").val(Num2Money(amount));
	$("#fee").val(Num2Money(fee));
}


function createItemGroupCode(){
	var data_string = "mode=createItemGroupCode";

	$.ajax({
		type : "post",
		url : "ajax/ajax.php",
		data : data_string,
		success : function(str) {
			$("#sub_item_group_cd").val(str);
		}
	});	
}

function commaSplit(n) {// 콤마 나누는 부분
    var txtNumber = '' + n;
    var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
    var arrNumber = txtNumber.split('.');
    arrNumber[0] += '.';
    do {
        arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
    }
    while (rxSplit.test(arrNumber[0]));
    if(arrNumber.length > 1) {
        return arrNumber.join('');
    } else {
        return arrNumber[0].split('.')[0];
    }
}

function removeComma(n) {  // 콤마제거
    if ( typeof n == "undefined" || n == null || n == "" ) {
        return "";
    }
    var txtNumber = '' + n;
    return txtNumber.replace(/(,)/g, "");
}

function getProject() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;

	$.getJSON("ajax/groupware.php",{"page":page, "mode":"getProject", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postProject('" + json[i].project_cd + "','" + json[i].project_nm + "')\">" + json[i].project_cd + "</a></td>";
					tag += "<td>" + json[i].project_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#project_list tbody").html(tag);

			var table = "erp_project";
			var where = "";

			getPaging(table,where,rpp,adjacents);
		}
	);
}

function getAccountCode() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var aci_cd = $("#aci_cd").val();

	$.getJSON("ajax/account_code.php",{"page":page, "mode":"get_account_code", "rpp" : rpp, "adjacents" : adjacents, "where":search, "aci_cd":aci_cd},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					//if(json[i].aci_cd == "purchase") var clas = "매입";
					//else var clas = "매출";
					
					tag += "<tr>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccountCode('" + json[i].aci_cd + "','" + json[i].aci_nm + "')\">[" + json[i].aci_cd + "] " + json[i].aci_nm + "</a></td>";
					tag += "<td>" + json[i].search_box + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_code_list tbody").html(tag);

			var table = "erp_account_code";
			if(aci_cd == "" || aci_cd == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and aci_cd='"  + aci_cd + "'";
			}

			//getPaging(table,where,rpp,adjacents);
		}
	);
}


function postItem(aci_cd,aci_nm,account_cd,pur_unit_price,unit_price,lot_no){
	var arr = [];
	$.each($(".aci_cd") , function () {
		arr.push($(this).val());
			/*
			if($(this).val() == aci_cd) {
				alert("이미 선택한 품목입니다");
			} else {
				var flag = $("#acicdFlag").val();
				$("#aci_cd_" + flag).val(aci_cd);
				$("#aci_nm_" + flag).val(aci_nm);
				$("#unit_" + flag).val(unit);
				$("#pur_unit_price_" + flag).val(pur_unit_price);
				$("#unit_price_" + flag).val(unit_price);
			}*/
	});
	var idx = jQuery.inArray(aci_cd, arr);
	if(idx >= 0) {
		//alert("동일 품목을 이미 선택하셨습니다");
	} else {
		var flag = $("#acicdFlag").val();
		$("#aci_cd_" + flag).val(aci_cd);
		$("#aci_nm_" + flag).val(aci_nm);
		$("#account_cd_" + flag).val(account_cd);
		$("#pur_unit_price_" + flag).val(pur_unit_price);
		$("#unit_price_" + flag).val(unit_price);
		$("#lot_no_" + flag).val(lot_no);
	}
}

// 거래처 리스트 가져오기
function getAccount(){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var account_gb = $("#account_gb").val();
 
	$.getJSON("ajax/account.php",{"page":page, "mode":"getAccount", "rpp" : rpp, "adjacents" : adjacents, "where":search, "account_gb":account_gb},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					if(json[i].account_gb == "purchase") var clas = "매입";
					else var clas = "매출";
					
					tag += "<tr>";
					tag += "<td class='center'>" + clas + "</td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccount('" + json[i].account_cd + "','" + json[i].account_nm + "')\">" + json[i].account_cd + "</a></td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_list tbody").html(tag);

			var table = "erp_account";
			var where = "";
			//if(account_gb == "" || account_gb == "all") {
			//	var where = $("#where").val();
			//} else {
			//	var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			//}

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 거래처 리스트 가져오기
function getWarehouse(){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var warehouse_gb = $("#warehouse_gb").val();

	$.getJSON("ajax/warehouse.php",{"page":page, "mode":"getWarehouse", "rpp" : rpp, "adjacents" : adjacents, "where":search, "warehouse_gb":warehouse_gb},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].warehouse_cd + "'>" + json[i].warehouse_nm + "</option>";
				}
			}

			$("#warehouse_cd").append(tag);
		}
	);
}

// 계좌 리스트 가져오기
function getBank(){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var warehouse_gb = $("#warehouse_gb").val();

	$.getJSON("ajax/bank.php",{"page":page, "mode":"get_bank_list", "rpp" : rpp, "adjacents" : adjacents, "where":search, "warehouse_gb":warehouse_gb},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td class='center'>" + json[i].bank_num + "</td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postBanks('" + json[i].bank_num + "','" + json[i].bank_name + "') \">" + json[i].bank_name + "</a></td>";
					tag += "</tr>";
				}
			}
			
			$("#bank_list tbody").html(tag);

			var table = "erp_bank_list";
			var where = "";
			//if(account_gb == "" || account_gb == "all") {
			//	var where = $("#where").val();
			//} else {
			//	var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			//}

			getPaging(table,where,rpp,adjacents);
		}
	);
}

// 계좌 리스트 가져오기
function getCard(){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var warehouse_gb = $("#warehouse_gb").val();

	$.getJSON("ajax/card.php",{"page":page, "mode":"getCard", "rpp" : rpp, "adjacents" : adjacents, "where":search, "warehouse_gb":warehouse_gb},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td class='center'><a href='javascript:void(0);'  onclick=\"postCards('" + json[i].card_num + "','" + json[i].card_name + "') \">" + json[i].card_num + "</td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postCards('" + json[i].card_num + "','" + json[i].card_name + "') \">" + json[i].card_name + "</a></td>";
					tag += "<td class='center'><a href='javascript:void(0);'  onclick=\"postCards('" + json[i].card_num + "','" + json[i].card_name + "') \">" + json[i].card_type + "</td>";
					tag += "</tr>";
				}
			}
			
			$("#card_list tbody").html(tag);

			var table = "erp_creditcard";
			var where = "";
			//if(account_gb == "" || account_gb == "all") {
			//	var where = $("#where").val();
			//} else {
			//	var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			//}

			getPaging(table,where,rpp,adjacents);
		}
	);
}


// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getAccount(page);
}

// 페이징 가져오기
function getPaging(table,where,rpp,adjacents){
	var data_string = "page=" + $("#page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents;

	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#paging_area").html(str);
		}
	});
}

// 검색
function search(){
	var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();

	if(search_choice == "account_nm") {
		$("#where").val(" where 1=1 and account_nm like '%" + txt + "%' ");
	} else if(search_choice == "account_cd") {
		$("#where").val(" where 1=1 and account_cd like '%" + txt + "%' ");
	}
	getAccount(1);
}


function formSubmit(){
	alert('저장')
	$("#frm").submit();
}

</script>

<!----------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
jQuery(function($) {
	$.mask.definitions['~']='[+-]';
	$('.input-mask-date').mask('99/99/9999');
	$('.input-mask-phone').mask('(999) 999-9999');
	$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
	$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});

	//override dialog's title function to allow for HTML titles
	$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
		_title: function(title) {
			var $title = this.options.title || '&nbsp;'
			if( ("title_html" in this.options) && this.options.title_html == true )
				title.html($title);
			else title.text($title);
		}
	}));
				
	$( "#id-btn-dialog1" ).on('click', function(e) {
		e.preventDefault();
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 300,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>부서 리스트</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

				
	$( "#id-btn-dialog2" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message2" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>프로젝트 리스트</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	$( "#id-btn-dialog3" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message3" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>거래처 리스트</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	$( "#id-btn-dialog4" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message4" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>계정코드검색</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	$( "#id-btn-dialog5" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message5" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>카드번호검색</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "Cancel",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}
			]
		});
	});

	
	//datepicker plugin
	//link
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	})
	//show datepicker when clicking on the icon
	.next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
			
	//or change it into a date range picker
	$('.input-daterange').datepicker({autoclose:true});
			
			
	//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
	$('input[name=date-range-picker]').daterangepicker({
		'applyClass' : 'btn-sm btn-success',
		'cancelClass' : 'btn-sm btn-default',
		locale: {
			applyLabel: 'Apply',
			cancelLabel: 'Cancel',
		}
	})
	.prev().on(ace.click_event, function(){
		$(this).next().focus();
	});
			
	$('#timepicker1').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#timepicker1').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
				
	if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
		 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
		 icons: {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar',
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down',
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			today: 'fa fa-arrows ',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		}
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
});
</script>
<!----------------------------------------------------------------------------------------------------------------------->


 <script type="text/javascript">    
    <!--
        var objDHtml = null;  //모달창 전역 객체 선언

        window.onload = function() {    
            $("#a_des_1").get(0).focus();
            $("#form1").attr("action", fnSetUrlPath("EPG003M_SAVE.aspx", "ec_req_sid"));
        }

        function yy_reload() {        
            var yy_t = $("#yy_t option:selected").val();

            self.location = fnSetUrlPath("EPG003M.aspx?yy_t=" + yy_t, "ec_req_sid");            
        }

        function search_code(gubun, phase, key_type) {
            var Year = 2017;
            var Code;
            
            if (gubun == "1")
            {
                objName = $("#a_nontax_des_"+phase);
                strName = objName.val();
                objCode = $("#a_nontax_cd_"+phase);
                strCode = objCode.val();
                objNextBox = $("#calc1_"+phase);

                Code = objCode.get(0).value;
                objCode.get(0).value = "";
                objName.get(0).value = "";
                
                if (strCode == "")
                    objName.val("");

                if (strCode.length > 0 || key_type == "double") {                             
                    strArgs = "";
                            
                    if (key_type == "")
                        strArgs += "Param=" + encodeURIComponent(Code) + "&";
                    else
                        strArgs += "Param=&";

                    strArgs += "Year=" + encodeURIComponent(Year) + "&";                            
                    objDHtml = dhtmlPopUpOriginal("../CM/EP/EP005P.aspx" + "?" + strArgs, "비과세검색", "450", "400");
                }
                else {
                    objName.get(0).value = "";
                    objCode.get(0).value = "";
                }
            }
            else
            {
                if ($("#a_daily_"+phase).get(0).value != "1" && $("#a_daily_"+phase).get(0).value != "2")
                {
                    alert("[근무기록] 기준이 [시간]이나 [일]로 설정된 수당만 근태(휴가)코드와 연동할 수 있습니다.");
                    $("#attend_des"+phase).get(0).value = "";
                    $("#attend_cd"+phase).get(0).value = "";
                    return false;
                }
                else
                {
                    objName = $("#attend_des"+phase);
                    strName = objName.val();
                    objCode = $("#attend_cd"+phase);
                    strCode = objCode.val();
                    objGubun = $("#attend_gubun"+phase);
                    
                    var nextfield;
                    
                    if (30 == Number(phase))                
                        nextfield = "#attend_des"+phase;
                    else
                        nextfield = "#a_des_"+(Number(phase) + 1);
                    
                    if (key_type != "double")
                    {
                        strCode = objCode.get(0).value;
                        if (strCode == "")
                        {
                            objName.get(0).value = "";
                            objGubun.get(0).value = "";
                            return;
                        }
                    }
                    else
                        strCode = "";
                    
                    if (key_type != "double")
                    {
                        objCode.get(0).value = "";
                        objName.get(0).value = "";
                        objGubun.get(0).value = "";
                    }
                    
                    fnGetData("Type=VACATION&KeyWord=" + encodeURIComponent(strCode) + "&CallType=" + $("#a_daily_"+phase).get(0).value, "EPG003P_03.aspx", "근태검색", "450", "400", nextfield);                    
                }
            }
        }
        
        function fnGetData(strData, strSearchUrl, strTitle, strWidth, strHeight, strNextF) {            
            $.ajax({
                type: "POST",
                dataType: "text",                
                url: fnSetUrlPath("../CM2/CM2_DATA.aspx", "ec_req_sid"),
                data: strData,
                error: function(errorMsg) {
                    alert("ERROR:" + errorMsg);
                },
                success: function(returnXml) {
                    var dom = parseXML(returnXml);
                    var objResultXml = $(dom).find("RESULT");
                    var strTypes = $(dom).find("TYPE").text();

                    if (objResultXml.length == 1) {
                        //결과 값이 1개일때
                        strName = $(objResultXml).find("NAME").text();
                        strCode = $(objResultXml).find("CODE").text();
                        strGubun = $(objResultXml).find("GUBUN").text();

                        objName.get(0).value = strName;
                        objCode.get(0).value = strCode;
                        objGubun.get(0).value = strGubun;
                        
                        $(strNextF).focus();
                    }
                    else {
                        //검색창 열기
                        objDHtml = dhtmlPopUpOriginal(strSearchUrl + "?" + strData, strTitle, strWidth, strHeight)
                        objNextBox = $(strNextF);
                    }
                }
            });            
        }

        function check_click(num){        
            var flag = $("#calc_flag_" + num);
            var des = $("#calc_des_" + num);
            
            if( flag.get(0).checked == true ){
                des.get(0).disabled = false;
                des.attr("class","link-blue");
            }
            else{
                des.get(0).disabled = true;
                des.attr("class","link-gray-none");
            }           
        }
        
        function  copy_reload(){        
            var yy_t = $("#yy_t option:selected").val()
            var msgstr = "복사시 복구 불가능합니다.\n\n복사하겠습니까?";
          
            if(confirm(msgstr)){           
                self.location = fnSetUrlPath("EPG003M.aspx?yy_t=" + yy_t + "&flag=C", "ec_req_sid");
            }
        }
        
        function Message(gubun){        
            switch(gubun){            
                case "daily":
                    alert("월정액: 사원등록/수정 > 급여지급사항에 입력된 월정액수당\n\n일(日): 사원등록/수정 > 급여 지급사항의 일급수당 * 해당월 근무기록 일수 * 배율\n\n시간: 사원등록/수정 > 급여 지급사항의 시급수당 * 해당월 근무기록 시간 * 배율\n\n※근무기록은[근무기록확정] 에서 작성된 해당월 근무기록을 바탕으로 계산됩니다.");
                    break;            
                case "rate":
                    alert("[근무기록] 기준이 [시간]이나 [일]로 설정된 수당항목 계산시 적용할 배율을 입력합니다.\n기본값은 1입니다. 0을 입력할 경우 수당이 계산되지 않습니다.");
                    break;            
                case "calc":
                    alert("근무기록 기준이 시간이나 일로 설정된 수당만 해당됩니다.");
                    break;            
                case "nontax":
                     objDHtml = dhtmlPopUpOriginal("../EPG/EPG003P_02.aspx", "비과세", "771", "700");
                    break;            
                default:            
                    break;            
            }        
        }

        //저장
        function fnSave() {
            if ("W" == "R") {
                alert('읽기 권한자는 사용할 수 없는 기능입니다.\n\n마스터에게 문의 바랍니다.');
                return false;
            }
            else if ("W" == "U") {
                alert('수정 권한이 없습니다.');
                return false;
            }

            var row = 30;
            var i = 1;
            var strInsachk = "N";
            var sortCount = 0;

            for (i ; i <= row; i++) {            
                var obj0 = $("#a_sort_" + i);
                var obj1 = $("#a_des_" + i);
                var obj2 = $("#a_rate_" + i); 
                var obj3 = $("#a_nontax_cd_" + i);

                if(obj0.get(0).value == "") {
                    obj0.get(0).value = 0;
                }

                if(obj0.get(0).value != 0) {            
                    sortCount++;
                }

                if((obj0.get(0).value != 0) && (obj1.get(0).value == "")) {
                    alert("명칭을 입력 바랍니다.");
                    obj1.get(0).focus();
                    return false;
                }
                var vChk = fnValidCheck(obj1.get(0), true);  //특수문자 ',  \, ", ∬,  Em대쉬 체크                   
                    if (vChk == false) {obj1.focus();  return false; } 
            
                if(obj2.get(0).value >= 1000) {                
                    alert("배율은 999.99를 초과할 수 없습니다.");
                    obj2.get(0).focus();
                    return false;
                }
                
                if(obj0.get(0).value > row) {                               
                    var value =  "표시순서는 30까지만 지정할 수 있습니다.";                
                    alert(value);                    
                    obj0.get(0).focus();
                    return false;
                }
                    
                if (isNaN(obj0.get(0).value)) {                
                    alert("숫자만 입력 가능합니다.");
                    obj0.get(0).focus();
                    return false;
                }

                if (i != 20 && obj3.get(0).value == "T01" && strInsachk == "Y" ) {
                    alert("사원등록/수정 > 세무정보 에서 감면코드로 T01을 사용하는 사원이 있습니다. \r\n한 명이라도 사용중이면 T01코드를 선택할 수 없습니다.");
                    return false;
                }
            }

            if(sortCount == 0)
            {
                alert("수당항목의 표시순서를 확인 바랍니다.");
                $("#a_sort_1").focus();
                return false;
            }
           
            $("#form1").get(0).submit();
        }

        function Click_F8() {
            if ("W" == "R") {
                alert('읽기 권한자는 사용할 수 없는 기능입니다.\n\n마스터에게 문의 바랍니다.');
                return false;
            }
            else if ("W" == "U" && "" == "M") {
                alert('수정 권한이 없습니다.');
                return false;
            }

            var row = 30;
            var i = 1;

            for (i ; i <= row; i++) {                
                var obj0 = $("#a_sort_" + i);
                var obj1 = $("#a_des_" + i);
                
                if(obj0.get(0).value == "") {
                    obj0.get(0).value = 0;
                }

                if((obj0.get(0).value != 0) && (obj1.get(0).value == "")) {
                    alert("명칭을 입력 바랍니다.");
                    obj1.get(0).focus();
                    return false;
                }

                if(obj0.get(0).value > row) {                    
                    var value = "표시순서는 30까지만 지정할 수 있습니다.";  
                    alert(value);                    
                    obj0.get(0).focus();
                    return false;
                }
            }

            fnSave(); 
        }
        
        function cal(acode, num) 
        {         
            var flag = $("#calc_flag_" + num);

            if( flag.get(0).checked == true ){    
                var Yyt = 2017;                          
                strArgs = "yy_t=" + encodeURIComponent(Yyt) + "&ad_cd="  + encodeURIComponent(acode) + "&ad_gubun=A";        
                //objDHtml = dhtmlPopUpOriginal("../EPG/EPG003P_01.ASPX" + "?" + strArgs, "계산내역등록", "450", "600");
                gfnPopUp("../EPG/EPG003P_01.ASPX" + "?" + strArgs, "계산내역등록", "yes", "550", "600");
            }
        } 
        
        function fnSetValue(gubun, id) {        
            if (gubun != "1" && gubun != "2") {           
                $("#attend_cd" + id).get(0).value = "";
                $("#attend_des" + id).get(0).value = "";
                $("#attend_gubun" + id).get(0).value = "";
            }
        }

        function fnLogPop(wdate) {
            dhtmlPopUpOriginal("/ECMain/CM3/CM100P_31.aspx?wdate=" + encodeURIComponent(wdate) , "이력", "450", "300");
            return false;
        }
        //-->
    </script>    