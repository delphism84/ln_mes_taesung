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
					공재항목등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						공재항목등록
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
				<div class="col-xs-12 text-center"><h3>공재항목등록</h3></div>
			</div> 

            <div id="row">  
                <div class="col-xs-6 text-left"><img width="16" height="9" align="absmiddle" alt="" src="/ECMain/ECount.Common/images/icon_noti.gif">사용하지 않는 코드는 표시순서를 0으로 입력 바랍니다.</div>
                <div class="col-xs-6 text-right">
					<p class="float_right"> <!-- 오른쪽 검색--> 
                       <input name="input" class="btn_redS" id="Button1" onclick="copy_reload();" type="button" value="2016년 공제 복사">
                        <select name="yy_t" id="yy_t">
                        
                            <option selected="selected" value="2017">2017</option>
                        
                            <option value="2016">2016</option>
                        
                            <option value="2015">2015</option>
                        
                            <option value="2014">2014</option>
                        
                            <option value="2013">2013</option>
                        
                            <option value="2012">2012</option>
                        
                            <option value="2011">2011</option>
                        
                            <option value="2010">2010</option>
                        
                            <option value="2009">2009</option>
                        
                            <option value="2008">2008</option>
                        
                            <option value="2007">2007</option>
                        
                            <option value="2006">2006</option>
                        
                            <option value="2005">2005</option>
                        
                            <option value="2004">2004</option>
                        
                            <option value="2003">2003</option>
                        
                            <option value="2002">2002</option>
                        
                            <option value="2001">2001</option>
                        
                            <option value="2000">2000</option>
                        
                            <option value="1999">1999</option>
                        
                        </select>
                        <input name="btnSearch" class="btn_searchS" id="btnSearch" onclick="yy_reload();" type="button" value="검색">
                    </p>  
                </div>
			</div>		

                <table id="statement_list" class="table  table-bordered table-hover">
                    <colgroup><col width="19%"><col width="6%"><col width="16%"><col width="16%"><col width="18%"><col width="4%"><col width="7%"><col width="">
                    <thead>
                        <tr>
                            <th>공제명칭</th>
                            <th>표시순서</th>
                            <th>계정코드<br></th>
                            <th>거래처코드</th>                            
                            
                            <th>계산식</th>
                            <th class="font_s">계산항목</th>
                            <th>계산내역</th>
                            <th>비고</th>
                        </tr>
                    </thead>
                    <tbody>    
                        
                        <tr>
                            <td>[01] <input name="d_des_0" class="default" id="d_des_0" style="width: 96px;" onfocus="this.select();nextfield='d_sort_0';" type="text" maxlength="20" value="소득세"></td>
        
                            <td><input name="d_sort_0" class="default right" id="d_sort_0" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_0';" onblur="BlurColor(this);" type="text" maxlength="2" value="1"></td>

                            <td class="center"><input name="gye_code_0" class="bluebox" id="gye_code_0" style="width: 28%;" onkeyup="text_check('gye_code_0','20');" ondblclick="search_code('0', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_0';" onblur="BlurColor2(this);" onchange="search_code('0', '');" type="text" value="2549"> <input name="gye_des_0" class="default" id="gye_des_0" style="width: 60%;" onfocus="nextfield='cust_0';" type="text" readonly="readonly" value="예수금"></td>

                            <td class="center"><input name="cust_0" class="bluebox" id="cust_0" style="width: 28%;" onkeyup="text_check('cust_0','40');" ondblclick="search_code('0', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_0';" onblur="BlurColor2(this);" onchange="search_code('0', '', 'cust');" type="text" value=""> <input name="cust_name_0" class="default" id="cust_name_0" style="width: 60%;" onfocus="nextfield='calc1_0';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_0" id="calc1_0" onfocus="nextfield='calc2_0';">
                                <option value="01">원</option>
                                <option selected="selected" value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_0" id="calc2_0" onfocus="nextfield='d_des_1';">
                                <option value="R">반올림</option>
                                <option value="C">절상</option>
                                <option selected="selected" value="F">절사</option>
                            </select></td>
                        
                            <td class="center"><input name="calc_flag_0" id="calc_flag_0" type="hidden" value="0"></td>
                        
                           <td><input name="calc_des_0" id="calc_des_0" type="hidden"></td> 
                    
         
                            <td>
                                소득세 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[02] <input name="d_des_1" class="default" id="d_des_1" style="width: 96px;" onfocus="this.select();nextfield='d_sort_1';" type="text" maxlength="20" value="주민세"></td>
        
                            <td><input name="d_sort_1" class="default right" id="d_sort_1" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_1';" onblur="BlurColor(this);" type="text" maxlength="2" value="2"></td>

                            <td class="center"><input name="gye_code_1" class="bluebox" id="gye_code_1" style="width: 28%;" onkeyup="text_check('gye_code_1','20');" ondblclick="search_code('1', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_1';" onblur="BlurColor2(this);" onchange="search_code('1', '');" type="text" value="2549"> <input name="gye_des_1" class="default" id="gye_des_1" style="width: 60%;" onfocus="nextfield='cust_1';" type="text" readonly="readonly" value="예수금"></td>

                            <td class="center"><input name="cust_1" class="bluebox" id="cust_1" style="width: 28%;" onkeyup="text_check('cust_1','40');" ondblclick="search_code('1', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_1';" onblur="BlurColor2(this);" onchange="search_code('1', '', 'cust');" type="text" value=""> <input name="cust_name_1" class="default" id="cust_name_1" style="width: 60%;" onfocus="nextfield='calc1_1';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_1" id="calc1_1" onfocus="nextfield='calc2_1';">
                                <option value="01">원</option>
                                <option selected="selected" value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_1" id="calc2_1" onfocus="nextfield='d_des_2';">
                                <option value="R">반올림</option>
                                <option value="C">절상</option>
                                <option selected="selected" value="F">절사</option>
                            </select></td>
                        
                            <td class="center"><input name="calc_flag_1" id="calc_flag_1" type="hidden" value="0"></td>
                        
                           <td><input name="calc_des_1" id="calc_des_1" type="hidden"></td> 
                    
         
                            <td>
                                지방소득세 = 소득세 * 10% 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[03] <input name="d_des_2" class="default" id="d_des_2" style="width: 96px;" onfocus="this.select();nextfield='d_sort_2';" type="text" maxlength="20" value="국민연금"></td>
        
                            <td><input name="d_sort_2" class="default right" id="d_sort_2" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_2';" onblur="BlurColor(this);" type="text" maxlength="2" value="3"></td>

                            <td class="center"><input name="gye_code_2" class="bluebox" id="gye_code_2" style="width: 28%;" onkeyup="text_check('gye_code_2','20');" ondblclick="search_code('2', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_2';" onblur="BlurColor2(this);" onchange="search_code('2', '');" type="text" value="2549"> <input name="gye_des_2" class="default" id="gye_des_2" style="width: 60%;" onfocus="nextfield='cust_2';" type="text" readonly="readonly" value="예수금"></td>

                            <td class="center"><input name="cust_2" class="bluebox" id="cust_2" style="width: 28%;" onkeyup="text_check('cust_2','40');" ondblclick="search_code('2', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_2';" onblur="BlurColor2(this);" onchange="search_code('2', '', 'cust');" type="text" value=""> <input name="cust_name_2" class="default" id="cust_name_2" style="width: 60%;" onfocus="nextfield='calc1_2';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_2" id="calc1_2" onfocus="nextfield='calc2_2';">
                                <option value="01">원</option>
                                <option selected="selected" value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_2" id="calc2_2" onfocus="nextfield='d_des_3';">
                                <option value="R">반올림</option>
                                <option value="C">절상</option>
                                <option selected="selected" value="F">절사</option>
                            </select></td>
                        
                            <td class="center"><input name="calc_flag_2" id="calc_flag_2" type="hidden" value="0"></td>
                        
                           <td><input name="calc_des_2" id="calc_des_2" type="hidden"></td> 
                    
         
                            <td>
                                국민연금<a onclick="alert('국민연금\n\n[기본사항등록] > [사원등록/수정]에서 등록된\n\n보수월액의 4.5% 공제합니다.');" href="#"> <img width="14" height="13" alt="" src="/ECMain/ECount.Common/images/icon_q.gif"></a>  
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[04] <input name="d_des_3" class="default" id="d_des_3" style="width: 96px;" onfocus="this.select();nextfield='d_sort_3';" type="text" maxlength="20" value="건강보험"></td>
        
                            <td><input name="d_sort_3" class="default right" id="d_sort_3" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_3';" onblur="BlurColor(this);" type="text" maxlength="2" value="4"></td>

                            <td class="center"><input name="gye_code_3" class="bluebox" id="gye_code_3" style="width: 28%;" onkeyup="text_check('gye_code_3','20');" ondblclick="search_code('3', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_3';" onblur="BlurColor2(this);" onchange="search_code('3', '');" type="text" value="2549"> <input name="gye_des_3" class="default" id="gye_des_3" style="width: 60%;" onfocus="nextfield='cust_3';" type="text" readonly="readonly" value="예수금"></td>

                            <td class="center"><input name="cust_3" class="bluebox" id="cust_3" style="width: 28%;" onkeyup="text_check('cust_3','40');" ondblclick="search_code('3', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_3';" onblur="BlurColor2(this);" onchange="search_code('3', '', 'cust');" type="text" value=""> <input name="cust_name_3" class="default" id="cust_name_3" style="width: 60%;" onfocus="nextfield='calc1_3';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_3" id="calc1_3" onfocus="nextfield='calc2_3';">
                                <option value="01">원</option>
                                <option selected="selected" value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_3" id="calc2_3" onfocus="nextfield='d_des_4';">
                                <option value="R">반올림</option>
                                <option value="C">절상</option>
                                <option selected="selected" value="F">절사</option>
                            </select></td>
                        
                            <td class="center"><input name="calc_flag_3" id="calc_flag_3" type="hidden" value="0"></td>
                        
                           <td><input name="calc_des_3" id="calc_des_3" type="hidden"></td> 
                    
         
                            <td>
                                건강보험<a onclick="alert('건강보험\n\n[기본사항등록] > [사원등록/수정]에서 등록된\n\n보수월액의 3.06%를 공제합니다.\n\n[장기요양보험료]2010.01귀속분 부터 건강보험료납부액의 6.55%를 추가 공제합니다.');" href="#"> <img width="14" height="13" alt="" src="/ECMain/ECount.Common/images/icon_q.gif"></a> 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[05] <input name="d_des_4" class="default" id="d_des_4" style="width: 96px;" onfocus="this.select();nextfield='d_sort_4';" type="text" maxlength="20" value="고용보험"></td>
        
                            <td><input name="d_sort_4" class="default right" id="d_sort_4" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_4';" onblur="BlurColor(this);" type="text" maxlength="2" value="5"></td>

                            <td class="center"><input name="gye_code_4" class="bluebox" id="gye_code_4" style="width: 28%;" onkeyup="text_check('gye_code_4','20');" ondblclick="search_code('4', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_4';" onblur="BlurColor2(this);" onchange="search_code('4', '');" type="text" value="2549"> <input name="gye_des_4" class="default" id="gye_des_4" style="width: 60%;" onfocus="nextfield='cust_4';" type="text" readonly="readonly" value="예수금"></td>

                            <td class="center"><input name="cust_4" class="bluebox" id="cust_4" style="width: 28%;" onkeyup="text_check('cust_4','40');" ondblclick="search_code('4', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_4';" onblur="BlurColor2(this);" onchange="search_code('4', '', 'cust');" type="text" value=""> <input name="cust_name_4" class="default" id="cust_name_4" style="width: 60%;" onfocus="nextfield='calc1_4';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_4" id="calc1_4" onfocus="nextfield='calc2_4';">
                                <option value="01">원</option>
                                <option selected="selected" value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_4" id="calc2_4" onfocus="nextfield='d_des_5';">
                                <option value="R">반올림</option>
                                <option value="C">절상</option>
                                <option selected="selected" value="F">절사</option>
                            </select></td>
                        
                            <td class="center"><input name="calc_flag_4" id="calc_flag_4" type="hidden" value="0"></td>
                        
                           <td><input name="calc_des_4" id="calc_des_4" type="hidden"></td> 
                    
         
                            <td>
                                고용보험<a onclick="alert('고용보험\n\n[기본사항등록] > [사원등록/수정]에서 등록된\n\n보수월액의 2011.3월귀속까지 0.45%,\n\n2011.4월귀속부터 2013.6월귀속까지 0.55%\n\n2013.7월 귀속부터는 0.65% 공제합니다.');" href="#"> <img width="14" height="13" alt="" src="/ECMain/ECount.Common/images/icon_q.gif"></a> 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[06] <input name="d_des_5" class="default" id="d_des_5" style="width: 96px;" onfocus="this.select();nextfield='d_sort_5';" type="text" maxlength="20" value="연말정산"></td>
        
                            <td><input name="d_sort_5" class="default right" id="d_sort_5" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_5';" onblur="BlurColor(this);" type="text" maxlength="2" value="6"></td>

                            <td class="center"><input name="gye_code_5" class="bluebox" id="gye_code_5" style="width: 28%;" onkeyup="text_check('gye_code_5','20');" ondblclick="search_code('5', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_5';" onblur="BlurColor2(this);" onchange="search_code('5', '');" type="text" value="2549"> <input name="gye_des_5" class="default" id="gye_des_5" style="width: 60%;" onfocus="nextfield='cust_5';" type="text" readonly="readonly" value="예수금"></td>

                            <td class="center"><input name="cust_5" class="bluebox" id="cust_5" style="width: 28%;" onkeyup="text_check('cust_5','40');" ondblclick="search_code('5', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_5';" onblur="BlurColor2(this);" onchange="search_code('5', '', 'cust');" type="text" value=""> <input name="cust_name_5" class="default" id="cust_name_5" style="width: 60%;" onfocus="nextfield='calc1_5';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_5" id="calc1_5" onfocus="nextfield='calc2_5';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_5" id="calc2_5" onfocus="nextfield='calc_flag_5';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_5" class="checkbox" id="calc_flag_5" onclick="check_click2(this.checked,5,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_6';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_5" class="link-gray-none" id="calc_des_5" style="width: 56px;" onclick="cal('06','5');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[07] <input name="d_des_6" class="default" id="d_des_6" style="width: 96px;" onfocus="this.select();nextfield='d_sort_6';" type="text" maxlength="20" value="사우회비"></td>
        
                            <td><input name="d_sort_6" class="default right" id="d_sort_6" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_6';" onblur="BlurColor(this);" type="text" maxlength="2" value="7"></td>

                            <td class="center"><input name="gye_code_6" class="bluebox" id="gye_code_6" style="width: 28%;" onkeyup="text_check('gye_code_6','20');" ondblclick="search_code('6', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_6';" onblur="BlurColor2(this);" onchange="search_code('6', '');" type="text" value="2549"> <input name="gye_des_6" class="default" id="gye_des_6" style="width: 60%;" onfocus="nextfield='cust_6';" type="text" readonly="readonly" value="예수금"></td>

                            <td class="center"><input name="cust_6" class="bluebox" id="cust_6" style="width: 28%;" onkeyup="text_check('cust_6','40');" ondblclick="search_code('6', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_6';" onblur="BlurColor2(this);" onchange="search_code('6', '', 'cust');" type="text" value=""> <input name="cust_name_6" class="default" id="cust_name_6" style="width: 60%;" onfocus="nextfield='calc1_6';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_6" id="calc1_6" onfocus="nextfield='calc2_6';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_6" id="calc2_6" onfocus="nextfield='calc_flag_6';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_6" class="checkbox" id="calc_flag_6" onclick="check_click2(this.checked,6,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_7';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_6" class="link-gray-none" id="calc_des_6" style="width: 56px;" onclick="cal('07','6');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[08] <input name="d_des_7" class="default" id="d_des_7" style="width: 96px;" onfocus="this.select();nextfield='d_sort_7';" type="text" maxlength="20" value="공제항목 추가가능"></td>
        
                            <td><input name="d_sort_7" class="default right" id="d_sort_7" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_7';" onblur="BlurColor(this);" type="text" maxlength="2" value="8"></td>

                            <td class="center"><input name="gye_code_7" class="bluebox" id="gye_code_7" style="width: 28%;" onkeyup="text_check('gye_code_7','20');" ondblclick="search_code('7', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_7';" onblur="BlurColor2(this);" onchange="search_code('7', '');" type="text" value="2549"> <input name="gye_des_7" class="default" id="gye_des_7" style="width: 60%;" onfocus="nextfield='cust_7';" type="text" readonly="readonly" value="예수금"></td>

                            <td class="center"><input name="cust_7" class="bluebox" id="cust_7" style="width: 28%;" onkeyup="text_check('cust_7','40');" ondblclick="search_code('7', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_7';" onblur="BlurColor2(this);" onchange="search_code('7', '', 'cust');" type="text" value=""> <input name="cust_name_7" class="default" id="cust_name_7" style="width: 60%;" onfocus="nextfield='calc1_7';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_7" id="calc1_7" onfocus="nextfield='calc2_7';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_7" id="calc2_7" onfocus="nextfield='calc_flag_7';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_7" class="checkbox" id="calc_flag_7" onclick="check_click2(this.checked,7,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_8';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_7" class="link-gray-none" id="calc_des_7" style="width: 56px;" onclick="cal('08','7');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[09] <input name="d_des_8" class="default" id="d_des_8" style="width: 96px;" onfocus="this.select();nextfield='d_sort_8';" type="text" maxlength="20" value="기타공제4"></td>
        
                            <td><input name="d_sort_8" class="default right" id="d_sort_8" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_8';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_8" class="bluebox" id="gye_code_8" style="width: 28%;" onkeyup="text_check('gye_code_8','20');" ondblclick="search_code('8', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_8';" onblur="BlurColor2(this);" onchange="search_code('8', '');" type="text" value=""> <input name="gye_des_8" class="default" id="gye_des_8" style="width: 60%;" onfocus="nextfield='cust_8';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_8" class="bluebox" id="cust_8" style="width: 28%;" onkeyup="text_check('cust_8','40');" ondblclick="search_code('8', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_8';" onblur="BlurColor2(this);" onchange="search_code('8', '', 'cust');" type="text" value=""> <input name="cust_name_8" class="default" id="cust_name_8" style="width: 60%;" onfocus="nextfield='calc1_8';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_8" id="calc1_8" onfocus="nextfield='calc2_8';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_8" id="calc2_8" onfocus="nextfield='calc_flag_8';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_8" class="checkbox" id="calc_flag_8" onclick="check_click2(this.checked,8,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_9';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_8" class="link-gray-none" id="calc_des_8" style="width: 56px;" onclick="cal('09','8');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[10] <input name="d_des_9" class="default" id="d_des_9" style="width: 96px;" onfocus="this.select();nextfield='d_sort_9';" type="text" maxlength="20" value="기타공제5"></td>
        
                            <td><input name="d_sort_9" class="default right" id="d_sort_9" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_9';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_9" class="bluebox" id="gye_code_9" style="width: 28%;" onkeyup="text_check('gye_code_9','20');" ondblclick="search_code('9', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_9';" onblur="BlurColor2(this);" onchange="search_code('9', '');" type="text" value=""> <input name="gye_des_9" class="default" id="gye_des_9" style="width: 60%;" onfocus="nextfield='cust_9';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_9" class="bluebox" id="cust_9" style="width: 28%;" onkeyup="text_check('cust_9','40');" ondblclick="search_code('9', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_9';" onblur="BlurColor2(this);" onchange="search_code('9', '', 'cust');" type="text" value=""> <input name="cust_name_9" class="default" id="cust_name_9" style="width: 60%;" onfocus="nextfield='calc1_9';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_9" id="calc1_9" onfocus="nextfield='calc2_9';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_9" id="calc2_9" onfocus="nextfield='calc_flag_9';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_9" class="checkbox" id="calc_flag_9" onclick="check_click2(this.checked,9,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_10';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_9" class="link-gray-none" id="calc_des_9" style="width: 56px;" onclick="cal('10','9');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[11] <input name="d_des_10" class="default" id="d_des_10" style="width: 96px;" onfocus="this.select();nextfield='d_sort_10';" type="text" maxlength="20" value="기타공제6"></td>
        
                            <td><input name="d_sort_10" class="default right" id="d_sort_10" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_10';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_10" class="bluebox" id="gye_code_10" style="width: 28%;" onkeyup="text_check('gye_code_10','20');" ondblclick="search_code('10', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_10';" onblur="BlurColor2(this);" onchange="search_code('10', '');" type="text" value=""> <input name="gye_des_10" class="default" id="gye_des_10" style="width: 60%;" onfocus="nextfield='cust_10';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_10" class="bluebox" id="cust_10" style="width: 28%;" onkeyup="text_check('cust_10','40');" ondblclick="search_code('10', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_10';" onblur="BlurColor2(this);" onchange="search_code('10', '', 'cust');" type="text" value=""> <input name="cust_name_10" class="default" id="cust_name_10" style="width: 60%;" onfocus="nextfield='calc1_10';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_10" id="calc1_10" onfocus="nextfield='calc2_10';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_10" id="calc2_10" onfocus="nextfield='calc_flag_10';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_10" class="checkbox" id="calc_flag_10" onclick="check_click2(this.checked,10,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_11';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_10" class="link-gray-none" id="calc_des_10" style="width: 56px;" onclick="cal('11','10');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[12] <input name="d_des_11" class="default" id="d_des_11" style="width: 96px;" onfocus="this.select();nextfield='d_sort_11';" type="text" maxlength="20" value="기타공제7"></td>
        
                            <td><input name="d_sort_11" class="default right" id="d_sort_11" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_11';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_11" class="bluebox" id="gye_code_11" style="width: 28%;" onkeyup="text_check('gye_code_11','20');" ondblclick="search_code('11', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_11';" onblur="BlurColor2(this);" onchange="search_code('11', '');" type="text" value=""> <input name="gye_des_11" class="default" id="gye_des_11" style="width: 60%;" onfocus="nextfield='cust_11';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_11" class="bluebox" id="cust_11" style="width: 28%;" onkeyup="text_check('cust_11','40');" ondblclick="search_code('11', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_11';" onblur="BlurColor2(this);" onchange="search_code('11', '', 'cust');" type="text" value=""> <input name="cust_name_11" class="default" id="cust_name_11" style="width: 60%;" onfocus="nextfield='calc1_11';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_11" id="calc1_11" onfocus="nextfield='calc2_11';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_11" id="calc2_11" onfocus="nextfield='calc_flag_11';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_11" class="checkbox" id="calc_flag_11" onclick="check_click2(this.checked,11,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_12';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_11" class="link-gray-none" id="calc_des_11" style="width: 56px;" onclick="cal('12','11');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[13] <input name="d_des_12" class="default" id="d_des_12" style="width: 96px;" onfocus="this.select();nextfield='d_sort_12';" type="text" maxlength="20" value="기타공제8"></td>
        
                            <td><input name="d_sort_12" class="default right" id="d_sort_12" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_12';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_12" class="bluebox" id="gye_code_12" style="width: 28%;" onkeyup="text_check('gye_code_12','20');" ondblclick="search_code('12', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_12';" onblur="BlurColor2(this);" onchange="search_code('12', '');" type="text" value=""> <input name="gye_des_12" class="default" id="gye_des_12" style="width: 60%;" onfocus="nextfield='cust_12';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_12" class="bluebox" id="cust_12" style="width: 28%;" onkeyup="text_check('cust_12','40');" ondblclick="search_code('12', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_12';" onblur="BlurColor2(this);" onchange="search_code('12', '', 'cust');" type="text" value=""> <input name="cust_name_12" class="default" id="cust_name_12" style="width: 60%;" onfocus="nextfield='calc1_12';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_12" id="calc1_12" onfocus="nextfield='calc2_12';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_12" id="calc2_12" onfocus="nextfield='calc_flag_12';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_12" class="checkbox" id="calc_flag_12" onclick="check_click2(this.checked,12,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_13';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_12" class="link-gray-none" id="calc_des_12" style="width: 56px;" onclick="cal('13','12');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[14] <input name="d_des_13" class="default" id="d_des_13" style="width: 96px;" onfocus="this.select();nextfield='d_sort_13';" type="text" maxlength="20" value="기타공제9"></td>
        
                            <td><input name="d_sort_13" class="default right" id="d_sort_13" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_13';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_13" class="bluebox" id="gye_code_13" style="width: 28%;" onkeyup="text_check('gye_code_13','20');" ondblclick="search_code('13', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_13';" onblur="BlurColor2(this);" onchange="search_code('13', '');" type="text" value=""> <input name="gye_des_13" class="default" id="gye_des_13" style="width: 60%;" onfocus="nextfield='cust_13';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_13" class="bluebox" id="cust_13" style="width: 28%;" onkeyup="text_check('cust_13','40');" ondblclick="search_code('13', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_13';" onblur="BlurColor2(this);" onchange="search_code('13', '', 'cust');" type="text" value=""> <input name="cust_name_13" class="default" id="cust_name_13" style="width: 60%;" onfocus="nextfield='calc1_13';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_13" id="calc1_13" onfocus="nextfield='calc2_13';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_13" id="calc2_13" onfocus="nextfield='calc_flag_13';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_13" class="checkbox" id="calc_flag_13" onclick="check_click2(this.checked,13,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_14';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_13" class="link-gray-none" id="calc_des_13" style="width: 56px;" onclick="cal('14','13');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[15] <input name="d_des_14" class="default" id="d_des_14" style="width: 96px;" onfocus="this.select();nextfield='d_sort_14';" type="text" maxlength="20" value="기타공제10"></td>
        
                            <td><input name="d_sort_14" class="default right" id="d_sort_14" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_14';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_14" class="bluebox" id="gye_code_14" style="width: 28%;" onkeyup="text_check('gye_code_14','20');" ondblclick="search_code('14', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_14';" onblur="BlurColor2(this);" onchange="search_code('14', '');" type="text" value=""> <input name="gye_des_14" class="default" id="gye_des_14" style="width: 60%;" onfocus="nextfield='cust_14';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_14" class="bluebox" id="cust_14" style="width: 28%;" onkeyup="text_check('cust_14','40');" ondblclick="search_code('14', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_14';" onblur="BlurColor2(this);" onchange="search_code('14', '', 'cust');" type="text" value=""> <input name="cust_name_14" class="default" id="cust_name_14" style="width: 60%;" onfocus="nextfield='calc1_14';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_14" id="calc1_14" onfocus="nextfield='calc2_14';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_14" id="calc2_14" onfocus="nextfield='calc_flag_14';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_14" class="checkbox" id="calc_flag_14" onclick="check_click2(this.checked,14,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_15';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_14" class="link-gray-none" id="calc_des_14" style="width: 56px;" onclick="cal('15','14');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[16] <input name="d_des_15" class="default" id="d_des_15" style="width: 96px;" onfocus="this.select();nextfield='d_sort_15';" type="text" maxlength="20" value="기타공제11"></td>
        
                            <td><input name="d_sort_15" class="default right" id="d_sort_15" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_15';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_15" class="bluebox" id="gye_code_15" style="width: 28%;" onkeyup="text_check('gye_code_15','20');" ondblclick="search_code('15', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_15';" onblur="BlurColor2(this);" onchange="search_code('15', '');" type="text" value=""> <input name="gye_des_15" class="default" id="gye_des_15" style="width: 60%;" onfocus="nextfield='cust_15';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_15" class="bluebox" id="cust_15" style="width: 28%;" onkeyup="text_check('cust_15','40');" ondblclick="search_code('15', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_15';" onblur="BlurColor2(this);" onchange="search_code('15', '', 'cust');" type="text" value=""> <input name="cust_name_15" class="default" id="cust_name_15" style="width: 60%;" onfocus="nextfield='calc1_15';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_15" id="calc1_15" onfocus="nextfield='calc2_15';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_15" id="calc2_15" onfocus="nextfield='calc_flag_15';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_15" class="checkbox" id="calc_flag_15" onclick="check_click2(this.checked,15,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_16';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_15" class="link-gray-none" id="calc_des_15" style="width: 56px;" onclick="cal('16','15');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[17] <input name="d_des_16" class="default" id="d_des_16" style="width: 96px;" onfocus="this.select();nextfield='d_sort_16';" type="text" maxlength="20" value="기타공제12"></td>
        
                            <td><input name="d_sort_16" class="default right" id="d_sort_16" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_16';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_16" class="bluebox" id="gye_code_16" style="width: 28%;" onkeyup="text_check('gye_code_16','20');" ondblclick="search_code('16', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_16';" onblur="BlurColor2(this);" onchange="search_code('16', '');" type="text" value=""> <input name="gye_des_16" class="default" id="gye_des_16" style="width: 60%;" onfocus="nextfield='cust_16';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_16" class="bluebox" id="cust_16" style="width: 28%;" onkeyup="text_check('cust_16','40');" ondblclick="search_code('16', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_16';" onblur="BlurColor2(this);" onchange="search_code('16', '', 'cust');" type="text" value=""> <input name="cust_name_16" class="default" id="cust_name_16" style="width: 60%;" onfocus="nextfield='calc1_16';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_16" id="calc1_16" onfocus="nextfield='calc2_16';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_16" id="calc2_16" onfocus="nextfield='calc_flag_16';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_16" class="checkbox" id="calc_flag_16" onclick="check_click2(this.checked,16,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_17';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_16" class="link-gray-none" id="calc_des_16" style="width: 56px;" onclick="cal('17','16');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[18] <input name="d_des_17" class="default" id="d_des_17" style="width: 96px;" onfocus="this.select();nextfield='d_sort_17';" type="text" maxlength="20" value="기타공제13"></td>
        
                            <td><input name="d_sort_17" class="default right" id="d_sort_17" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_17';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_17" class="bluebox" id="gye_code_17" style="width: 28%;" onkeyup="text_check('gye_code_17','20');" ondblclick="search_code('17', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_17';" onblur="BlurColor2(this);" onchange="search_code('17', '');" type="text" value=""> <input name="gye_des_17" class="default" id="gye_des_17" style="width: 60%;" onfocus="nextfield='cust_17';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_17" class="bluebox" id="cust_17" style="width: 28%;" onkeyup="text_check('cust_17','40');" ondblclick="search_code('17', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_17';" onblur="BlurColor2(this);" onchange="search_code('17', '', 'cust');" type="text" value=""> <input name="cust_name_17" class="default" id="cust_name_17" style="width: 60%;" onfocus="nextfield='calc1_17';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_17" id="calc1_17" onfocus="nextfield='calc2_17';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_17" id="calc2_17" onfocus="nextfield='calc_flag_17';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_17" class="checkbox" id="calc_flag_17" onclick="check_click2(this.checked,17,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_18';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_17" class="link-gray-none" id="calc_des_17" style="width: 56px;" onclick="cal('18','17');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[19] <input name="d_des_18" class="default" id="d_des_18" style="width: 96px;" onfocus="this.select();nextfield='d_sort_18';" type="text" maxlength="20" value="기타공제14"></td>
        
                            <td><input name="d_sort_18" class="default right" id="d_sort_18" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_18';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_18" class="bluebox" id="gye_code_18" style="width: 28%;" onkeyup="text_check('gye_code_18','20');" ondblclick="search_code('18', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_18';" onblur="BlurColor2(this);" onchange="search_code('18', '');" type="text" value=""> <input name="gye_des_18" class="default" id="gye_des_18" style="width: 60%;" onfocus="nextfield='cust_18';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_18" class="bluebox" id="cust_18" style="width: 28%;" onkeyup="text_check('cust_18','40');" ondblclick="search_code('18', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_18';" onblur="BlurColor2(this);" onchange="search_code('18', '', 'cust');" type="text" value=""> <input name="cust_name_18" class="default" id="cust_name_18" style="width: 60%;" onfocus="nextfield='calc1_18';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_18" id="calc1_18" onfocus="nextfield='calc2_18';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_18" id="calc2_18" onfocus="nextfield='calc_flag_18';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                         
                            <td class="center"><input name="calc_flag_18" class="checkbox" id="calc_flag_18" onclick="check_click2(this.checked,18,'2');" onfocus="FocusColor(this);this.select();nextfield='d_des_19';" type="checkbox" value="1"></td>
                                 
                        
                        <td class="center"><a name="calc_des_18" class="link-gray-none" id="calc_des_18" style="width: 56px;" onclick="cal('19','18');" href="#">계산내역</a></td>
                    
         
                            <td>
                                 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[20] <input name="d_des_19" class="default" id="d_des_19" style="width: 96px;" onfocus="this.select();nextfield='d_sort_19';" type="text" maxlength="20" value="장기요양"></td>
        
                            <td><input name="d_sort_19" class="default right" id="d_sort_19" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_19';" onblur="BlurColor(this);" type="text" maxlength="2" value="5"></td>

                            <td class="center"><input name="gye_code_19" class="bluebox" id="gye_code_19" style="width: 28%;" onkeyup="text_check('gye_code_19','20');" ondblclick="search_code('19', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_19';" onblur="BlurColor2(this);" onchange="search_code('19', '');" type="text" value="2549"> <input name="gye_des_19" class="default" id="gye_des_19" style="width: 60%;" onfocus="nextfield='cust_19';" type="text" readonly="readonly" value="예수금"></td>

                            <td class="center"><input name="cust_19" class="bluebox" id="cust_19" style="width: 28%;" onkeyup="text_check('cust_19','40');" ondblclick="search_code('19', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_19';" onblur="BlurColor2(this);" onchange="search_code('19', '', 'cust');" type="text" value=""> <input name="cust_name_19" class="default" id="cust_name_19" style="width: 60%;" onfocus="nextfield='calc1_19';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_19" id="calc1_19" onfocus="nextfield='calc2_19';">
                                <option value="01">원</option>
                                <option selected="selected" value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_19" id="calc2_19" onfocus="nextfield='d_des_20';">
                                <option value="R">반올림</option>
                                <option value="C">절상</option>
                                <option selected="selected" value="F">절사</option>
                            </select></td>
                        
                            <td class="center"><input name="calc_flag_19" id="calc_flag_19" type="hidden" value="0"></td>
                        
                           <td><input name="calc_des_19" disabled="" class="link-gray-none" id="calc_des_19" type="hidden"></td> 
                    
         
                            <td>
                                장기요양보험<a onclick="alert('장기요양보험2010.01귀속분 부터 건강보험료납부액의 6.55%를 추가 공제합니다.');" href="#"> <img width="14" height="13" alt="" src="/ECMain/ECount.Common/images/icon_q.gif"></a> 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[21] <input name="d_des_20" class="default" id="d_des_20" style="width: 96px;" onfocus="this.select();nextfield='d_sort_20';" type="text" maxlength="20" value="연말정산"></td>
        
                            <td><input name="d_sort_20" class="default right" id="d_sort_20" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_20';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_20" class="bluebox" id="gye_code_20" style="width: 28%;" onkeyup="text_check('gye_code_20','20');" ondblclick="search_code('20', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_20';" onblur="BlurColor2(this);" onchange="search_code('20', '');" type="text" value=""> <input name="gye_des_20" class="default" id="gye_des_20" style="width: 60%;" onfocus="nextfield='cust_20';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_20" class="bluebox" id="cust_20" style="width: 28%;" onkeyup="text_check('cust_20','40');" ondblclick="search_code('20', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_20';" onblur="BlurColor2(this);" onchange="search_code('20', '', 'cust');" type="text" value=""> <input name="cust_name_20" class="default" id="cust_name_20" style="width: 60%;" onfocus="nextfield='calc1_20';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_20" id="calc1_20" onfocus="nextfield='calc2_20';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_20" id="calc2_20" onfocus="nextfield='d_des_21';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                        
                            <td class="center"><input name="calc_flag_20" id="calc_flag_20" type="hidden" value="0"></td>
                        
                           <td><input name="calc_des_20" id="calc_des_20" type="hidden"></td> 
                    
         
                            <td>
                                연말정산<a onclick="alert('이카운트를 통해 계산한 연말정산 공제/환급액을 가져옵니다.');" href="#"> <img width="14" height="13" alt="" src="/ECMain/ECount.Common/images/icon_q.gif"></a> 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[22] <input name="d_des_21" class="default" id="d_des_21" style="width: 96px;" onfocus="this.select();nextfield='d_sort_21';" type="text" maxlength="20" value="건강보험정산"></td>
        
                            <td><input name="d_sort_21" class="default right" id="d_sort_21" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_21';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_21" class="bluebox" id="gye_code_21" style="width: 28%;" onkeyup="text_check('gye_code_21','20');" ondblclick="search_code('21', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_21';" onblur="BlurColor2(this);" onchange="search_code('21', '');" type="text" value=""> <input name="gye_des_21" class="default" id="gye_des_21" style="width: 60%;" onfocus="nextfield='cust_21';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_21" class="bluebox" id="cust_21" style="width: 28%;" onkeyup="text_check('cust_21','40');" ondblclick="search_code('21', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_21';" onblur="BlurColor2(this);" onchange="search_code('21', '', 'cust');" type="text" value=""> <input name="cust_name_21" class="default" id="cust_name_21" style="width: 60%;" onfocus="nextfield='calc1_21';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_21" id="calc1_21" onfocus="nextfield='calc2_21';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_21" id="calc2_21" onfocus="nextfield='d_des_22';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                        
                            <td class="center"><input name="calc_flag_21" id="calc_flag_21" type="hidden" value="0"></td>
                        
                           <td><input name="calc_des_21" id="calc_des_21" type="hidden"></td> 
                    
         
                            <td>
                                건강보험정산<a onclick="alert('건강보험정산분을 별도의 공제항목으로 사용할 경우에 표시순서를 입력하여 사용합니다. 공제금액은 직접 입력해야 합니다.');" href="#"> <img width="14" height="13" alt="" src="/ECMain/ECount.Common/images/icon_q.gif"></a> 
                            </td>
        
                        </tr>     
                        <tr>
                            <td>[23] <input name="d_des_22" class="default" id="d_des_22" style="width: 96px;" onfocus="this.select();nextfield='d_sort_22';" type="text" maxlength="20" value="장기요양정산"></td>
        
                            <td><input name="d_sort_22" class="default right" id="d_sort_22" style="width: 36px;" onkeypress="num_check();" onfocus="FocusColor(this);this.select();nextfield='gye_code_22';" onblur="BlurColor(this);" type="text" maxlength="2" value="0"></td>

                            <td class="center"><input name="gye_code_22" class="bluebox" id="gye_code_22" style="width: 28%;" onkeyup="text_check('gye_code_22','20');" ondblclick="search_code('22', 'double');" onfocus="FocusColor(this);this.select();nextfield='cust_22';" onblur="BlurColor2(this);" onchange="search_code('22', '');" type="text" value=""> <input name="gye_des_22" class="default" id="gye_des_22" style="width: 60%;" onfocus="nextfield='cust_22';" type="text" readonly="readonly" value=""></td>

                            <td class="center"><input name="cust_22" class="bluebox" id="cust_22" style="width: 28%;" onkeyup="text_check('cust_22','40');" ondblclick="search_code('22', 'double', 'cust');" onfocus="FocusColor(this);this.select();nextfield='calc1_22';" onblur="BlurColor2(this);" onchange="search_code('22', '', 'cust');" type="text" value=""> <input name="cust_name_22" class="default" id="cust_name_22" style="width: 60%;" onfocus="nextfield='calc1_22';" type="text" readonly="readonly" value=""></td>
                            
                        
                        <td class="center">
                            <select name="calc1_22" id="calc1_22" onfocus="nextfield='calc2_22';">
                                <option selected="selected" value="01">원</option>
                                <option value="10">십원</option>
                                <option value="21">소수점1</option>
                                <option value="22">소수점2</option>
                            </select>
                            <select name="calc2_22" id="calc2_22" onfocus="nextfield='d_des_23';">
                                <option selected="selected" value="R">반올림</option>
                                <option value="C">절상</option>
                                <option value="F">절사</option>
                            </select></td>
                        
                            <td class="center"><input name="calc_flag_22" id="calc_flag_22" type="hidden" value="0"></td>
                        
                           <td><input name="calc_des_22" id="calc_des_22" type="hidden"></td> 
                    
         
                            <td>
                                장기요양정산<a onclick="alert('장기요양보험정산분을 별도의 공제항목으로 사용할 경우에 표시순서를 입력하여 사용합니다. 공제금액은 직접 입력해야 합니다.');" href="#"> <img width="14" height="13" alt="" src="/ECMain/ECount.Common/images/icon_q.gif"></a> 
                            </td>
        
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

            $("#d_des_0").get(0).focus();   
            $("#form1").attr("action", fnSetUrlPath("EPG004M_SAVE.aspx", "ec_req_sid"));

//            function getCookie( name ){
//                var nameOfcookie = name + "=";
//                var x = 0;
//                while ( x <= document.cookie.length )
//                {
//                    var y = (x+nameOfcookie.length);
//                    if ( document.cookie.substring( x, y ) == nameOfcookie ) {
//                        if ( (endOfcookie=document.cookie.indexOf( ";", y )) == -1 )
//                            endOfcookie = document.cookie.length;
//                            return unescape( document.cookie.substring( y, endOfcookie ) );
//                        }
//                    x = document.cookie.indexOf( " ", x ) + 1;
//                    if ( x == 0 )
//                        break;
//                }
//                return "";
//            }

//            if ( getCookie( "EPG_NOTICE3_POP_G1080" ) != "done" )
//            {
//                window.open('EPG_NOTICE3_POP.aspx','pop','width=620, height=520');
//            }
         

            //for( s=5 ; s<20 ; s++) {
            //    obj = $("#adjust_"+s);
            //    obj1 = $("#calc_flag_"+s);
            //    f_disabled(obj.get(0).checked,s)
            //}

            for( s=5 ; s<20 ; s++) {
                obj = $("#calc_flag_"+s);
                obj1 = $("#calc_des_"+s);
                f_disabled1(obj.get(0).checked);
            }
              
            for( s=5 ; s<20 ; s++) {
                obj = $("#calc_flag_"+s);
                obj1 = $("#calc_des_"+s);
                    
                if( obj.get(0).checked == true ){
                    obj1.get(0).disabled = false;
                    obj1.attr("class","link-blue");
                }
                else{
                    obj1.get(0).disabled = true;
                    obj1.attr("class","link-gray-none");
                }                
            }
        }

        function yy_reload() {
            var yy_t = $("#yy_t option:selected").val()
            self.location = fnSetUrlPath("EPG004M.aspx?yy_t=" + yy_t, "ec_req_sid");
        }

        function search_code(phase, key_type, flag) {            
            if (flag == 'cust') {
                objName = $("#cust_name_" + phase);
                strName = objName.val();
                objCode = $("#cust_" + phase);
                strCode = objCode.val();
                objNextBox = $("#calc1_" + phase);

                if (key_type == "double")
                    strCode = "";

                if (strCode == "")                
                    objDHtml = dhtmlPopUpOriginal("../CM/CM022P.aspx?Type=CUSTCM&KeyWord=" + encodeURIComponent(strCode) + "&CLASS_TYPE=A&GYECODE=''&PROD_SEARCH=9&ACC002_FLAG=Y&CallType=101&empflag=N&iotype=00&ChkFlag=A&hidNextFocus=Y&Trx_type=''", "거래처검색", "500", "500");
                
                else  
                    fnGetData("Type=CUSTCM&KeyWord=" + encodeURIComponent(strCode) + "&CLASS_TYPE=A&GYECODE=''&PROD_SEARCH=9&ACC002_FLAG=Y&CallType=101&empflag=N&iotype=00&ChkFlag=A&hidNextFocus=Y&Trx_type=''", "../CM/CM022P.aspx", "거래처검색", "500", "500", "#calc1_" + phase);
            }            
            else {
                var Code;

                objName = $("#gye_des_" + phase);
                strName = objName.val();
                objCode = $("#gye_code_" + phase);
                strCode = objCode.val();
                objNextBox = $("#d_sort_" + phase);

                Code = objCode.get(0).value;
                objCode.get(0).value = "";
                objName.get(0).value = "";

                if (strCode == "")
                    objName.val("");

                if (strCode.length > 0 || key_type == "double") {

                    strArgs = "";
                    strArgs += "TYPE=GYECODECM&"

                    if (key_type == "")
                        strArgs += "KeyWord=" + encodeURIComponent(Code) + "&";
                    else
                        strArgs += "KeyWord=&";
                    strArgs += "KeyWordType=5&";
                    strArgs += "CallType=0&";
                    strArgs += "GYECODE=&";

                    objDHtml = dhtmlPopUpOriginal("../CM/CM007P.aspx" + "?" + strArgs, "계정코드", "400", "500");
                }

                else {
                    objName.get(0).value = "";
                    objCode.get(0).value = "";
                }
            }
        }

        //ajax 호출 함수
        function fnGetData(strData, strSearchUrl, strTitle, strWidth, strHeight, strNext, strGubun) { 
            $.ajax({
                type: "POST",
                async: false,                
                url: fnSetUrlPath(strGubun == 'VERSION' ? strSearchUrl:"/ECMain/EBD/EBD002M_DATA.aspx","ec_req_sid"),
                data: strData,
                error: function(errorMsg) {
                    alert('에러발생'+"\nfnGetData:" + errorMsg);                    
                },
                success: function(returnXml) {        
                    var dom = parseXML(returnXml);
                    var objResultXml = $(dom).find("RESULT");
                    var strTypes = $(dom).find("TYPE").text();

                    if (strTypes == "VERSION")
                    {
                        version_flag = $(dom).find("VERSION_FLAG").text();
                    }
                    else
                    {
                        if (objResultXml.length == 0 && $("#chk_cust").get(0).checked && strTypes == "CUSTCM"){
		                    $("#io_cust").focus();
		                    objCode.get(0).value = strCode;
		                    return false;
		                }else if (objResultXml.length == 1) {            
                            //결과 값이 1개일때
                            if (strTypes == "ACCTCM" || strTypes == "CUSTCM" || strTypes == "REMARKCM" || strTypes == "SITEDEPTCM" || strTypes == "SITEPJTCM" || strTypes == "USERITEMCM") {
                                objDHtml = dhtmlPopUpOriginal(strSearchUrl + "?" + strData, strTitle, strWidth, strHeight);
                                objNextBox = $(strNext);
					        }
                            else {
                                strName = $(objResultXml).find("NAME").text();
                                strCode = $(objResultXml).find("CODE").text();
                
                                switch (strGubun) {                                    
                                    case "CUST":
                                        strForeignFlag = $(objResultXml).find("ForeignFlag").text();
                                        objForeignFlag.get(0).value = strForeignFlag;  
                                        break;                        
                                }

                                if(objForeignFlag != null)
                                {
                                    strForeignFlag = $(objResultXml).find("ForeignFlag").text();
                                     if(strForeignFlag !="")
                                        objForeignFlag.get(0).value = strForeignFlag;
                                }
                    
                                objName.get(0).value = strName;
                                objCode.get(0).value = strCode;
                                $(strNext).get(0).focus();
                                if (objDHtml)
                                    objDHtml.close();
                            }
                        }
                        else {
                            //검색창 열기
                            objNextBox = $(strNext);
                            objDHtml = dhtmlPopUpOriginal(strSearchUrl + "?" + strData, strTitle, strWidth, strHeight);
                        }
                    }
                }
            });
        }

        function medi() {

            if ($("#medi_flag").get(0).value == "Y") {
                alert('MSG02166');
            } else {
                nW0("/Pay_New/Wact521F_Medi.asp?", "장기요양보험료정리", "no", "500", "415");
            }

        }

        function check_click2(chk, num, flag) {
        
            //if($("#calc_flag_" + num).get(0).checked == true && $("#adjust_" + num).get(0).checked==false){
            if($("#calc_flag_" + num).get(0).checked == true) {
                $("#calc_des_" + num).attr("class","link-blue");
            }
            else{
                $("#calc_des_" + num).attr("class","link-gray-none");
            }
             
//            if (flag == "1") {
//                obj = $("#adjust_" + num);
//                obj1 = $("#calc_flag_" + num);
//                obj2 = $("#calc_des_" + num);
//                
//                $("#adjust_"+num).removeAttr("onfocus");

//                if(chk == true){               
//                    $("#adjust_"+num).bind("focus", function() {
//                        nextfield = "d_des_"+(num+1);
//                    });
//                
//                    $("#adjust_"+num).focus();                
//                }                
//                else{                
//                    $("#adjust_"+num).bind("focus", function() {
//                        nextfield = "calc_flag_"+num;
//                    });
//                
//                    $("#adjust_"+num).focus();                                
//            }

//            f_disabled(chk, num);

//            } else {
//                obj = $("#calc_flag_" + num);
//                obj1 = $("#calc_des_" + num);
//                f_disabled1(chk);
//            }

            obj = $("#calc_flag_" + num);
            obj1 = $("#calc_des_" + num);
            f_disabled1(chk);
        }
        
        function f_disabled(gubun,num){

            if (gubun==true) {
                obj1.get(0).disabled = true;
                if (obj1.get(0).checked){
                    obj2 = $("#calc_des_"+num);
                    obj2.get(0).disabled = true;                
                }
            }else{
                obj1.get(0).disabled = false;
                if (obj1.get(0).checked){
                    obj2 = $("#calc_des_"+num);
                    obj2.get(0).disabled = false;               
                }
            }           
        }

        function f_disabled1(gubun) {

            if (gubun == true ) {
                obj1.get(0).disabled = false;
            } else {
                obj1.get(0).disabled = true;
            }
        }
        
        function cal(acode, num){   
        
            if($("#calc_flag_" + num).get(0).checked == true){          
                var Yyt = 2017;                          
                strArgs = "yy_t=" + encodeURIComponent(Yyt) + "&ad_cd="  + encodeURIComponent(acode) + "&ad_gubun=D";        
                //objDHtml = dhtmlPopUpOriginal("../EPG/EPG003P_01.ASPX" + "?" + strArgs, "계산내역등록", "450", "600");  
                 gfnPopUp("../EPG/EPG003P_01.ASPX" + "?" + strArgs, "계산내역등록", "yes", "550", "600"); 
            }          
        }

        function  copy_reload(){        
            var yy_t = $("#yy_t option:selected").val()
            var msgstr = "복사시 복구 불가능합니다.\n\n복사하겠습니까?";
          
            if(confirm(msgstr)){           
                self.location = fnSetUrlPath("EPG004M.aspx?yy_t=" + yy_t + "&flag=C", "ec_req_sid");
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
            
            var chk = 0;
            var sortCount = 0;
            
	        for (i=0; i<=22; i++) 
		    {
			    obj0 = $("#d_sort_"+i);
			    obj1 = $("#d_des_"+i);
			    //obj2 = $("#adjust_"+i);
			    
			    if (obj0.get(0).value == "") 
			    {
				    obj0.get(0).value = 0;
			    }

                if(obj0.get(0).value != 0)
                {
                    sortCount++;
                }

			    if ($("#d_sort_0").get(0).value == 0 || $("#d_sort_1").get(0).value == 0)
			    {
				    alert("소득세 및 지방소득세는 필수항목이므로 표시순서에 0을 입력할 수 없습니다.");
				    $("#d_sort_0").get(0).focus();
				    return false;
			    }
			    if (i > 1 && obj0.get(0).value == $("#d_sort_0").get(0).value)
			    {
				    alert("소득세와 표시순서가 중복되는 항목이 있습니다. 확인 바랍니다.");
				    obj0.get(0).focus();
				    return false;
			    }
			    if (i > 1 && obj0.get(0).value == $("#d_sort_1").get(0).value)
			    {
				    alert("지방소득세와 표시순서가 중복되는 항목이 있습니다. 확인 바랍니다.");
				    obj0.get(0).focus();
				    return false;
			    }
			    if ((obj0.get(0).value != 0)&&(obj1.get(0).value == "")) 
			    {
				    alert("명칭을 입력 바랍니다.");
				    obj1.get(0).focus();
				    return false;
			    }
                var vChk = fnValidCheck(obj1.get(0), true);  //특수문자 ',  \, ", ∬,  Em대쉬 체크                   
                    if (vChk == false) {obj1.focus();  return false; } 
            
			    if (obj0.get(0).value > 23) 
			    {
				    alert("표시순서는 23까지만 지정할 수 있습니다.");
				    obj0.get(0).focus();
				    return false;
			    }
			    //if (obj2.get(0).checked) 
			    //{
				//    chk = chk + 1;
			    //}

                if (isNaN(obj0.get(0).value))
                {
                    alert("숫자만 입력 가능합니다.");
                    obj0.get(0).focus();
                    return false;
                }

	        }	
	        //if (chk > 1) 
		    //{
			//    alert("연말정산 공제항목은 1개만 선택할 수 있습니다.");
			//    return false;
		    //}
            
            if(sortCount == 0)
            {
                alert("수당항목의 표시순서를 확인 바랍니다.");
                $("#d_sort_0").focus();
                return false;
            }  
		    
		    $("#form1").get(0).submit();
        }
        
        function Click_F8() {
            
            if ("W" == "R") {
                alert('읽기 권한자는 사용할 수 없는 기능입니다.\n\n마스터에게 문의 바랍니다.');
                return false;
            }
            else if ("W" == "U") {
                alert('수정 권한이 없습니다.');
                return false;
            }
            
            var chk = 0;
            
	        for (i=0; i<=22; i++) 
		    {
			    obj0 = $("#d_sort_"+i);
			    obj1 = $("#d_des_"+i);
			    //obj2 = $("#adjust_"+i);
			    
			    if (obj0.get(0).value == "") 
			    {
				    obj0.get(0).value = 0;
			    }
			    if ($("#d_sort_0").get(0).value == 0 || $("#d_sort_1").get(0).value == 0)
			    {
				    alert("소득세 및 지방소득세는 필수항목이므로 표시순서에 0을 입력할 수 없습니다.");
				    $("#d_sort_0").get(0).focus();
				    return false;
			    }
			    if (i > 1 && obj0.get(0).value == $("#d_sort_0").get(0).value)
			    {
				    alert("소득세와 표시순서가 중복되는 항목이 있습니다. 확인 바랍니다.");
				    obj0.get(0).focus();
				    return false;
			    }
			    if (i > 1 && obj0.get(0).value == $("#d_sort_1").get(0).value)
			    {
				    alert("지방소득세와 표시순서가 중복되는 항목이 있습니다. 확인 바랍니다.");
				    obj0.get(0).focus();
				    return false;
			    }
			    if ((obj0.get(0).value != 0)&&(obj1.get(0).value == "")) 
			    {
				    alert("명칭을 입력 바랍니다.");
				    obj1.get(0).focus();
				    return false;
			    }
			    if (obj0.get(0).value > 23) 
			    {
				    alert("표시순서는 23까지만 지정할 수 있습니다.");
				    obj0.get(0).focus();
				    return false;
			    }
			    //if (obj2.get(0).checked) 
			    //{
				//   chk = chk + 1;
			    //}
	        }	
	        //if (chk > 1) 
		    //{
			//    alert("연말정산 공제항목은 1개만 선택할 수 있습니다.");
			//    return false;
		    //}  

            fnSave();             
        }
        
//        function ex(acode)
//        {
//            var acode2 = parseInt(acode) + 1;
//            
//            if($("#adjust_"+acode).get(0).checked == true){            
//                $("#adjust_"+acode)
//                .bind("focus", function() {
//                    nextfield = "d_des_"+ acode2;
//                    FocusColor(this);
//                    this.select();
//                })                
//            }
//            else{
//            
//               $("#adjust_"+acode)
//                .bind("focus", function() {
//                    nextfield = "calc_flag_"+ acode;
//                    FocusColor(this);
//                    this.select();
//                })            
//            }            
//        }            
        
        function fnLogPop(wdate) {
            dhtmlPopUpOriginal("/ECMain/CM3/CM100P_31.aspx?wdate=" + encodeURIComponent(wdate) , "이력", "450", "300");
            return false;
        }    
    //-->    
    </script>